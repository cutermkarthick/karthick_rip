<?php 
	
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'payrollsummary';
$page="ELM: Monthly";


$month_names = array('01' => 'Jan',
                      '02' => 'Feb',
                      '03' => 'Mar',
                      '04' => 'Apr',
                      '05' => 'May',
                      '06' => 'June',
                      '07' => 'July',
                      '08' => 'Aug',
                      '09' => 'Sep',
                      '10' => 'Oct',
                      '11' => 'Nov',
                      '12' => 'Dec');


$rowsPerPage = 100;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
    $pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
    $totpages = $_REQUEST['totpages'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

include_once('classes/payrollmonthlyClass.php');
$newpayroll = new payroll_monthly;

if(isset($_REQUEST['name']))
{
   $name = $_REQUEST['name'];
   $cond1 = "pms.name like'" . $name . "%'";
}
else
{
   $name = "";
   $cond1 = "pms.name like'%'";
}

$today = date("Y-m-d");

if(isset($_REQUEST['pl_month'])){

$frm = $_REQUEST['pl_month'];
}else{
// $frm = "";
$date_split = explode('-', $today);
$frm = $date_split[1];
}

if(isset($_REQUEST['pl_year'])){
$to = $_REQUEST['pl_year'];
}else{
// $to = "";
$date_split = explode('-', $today);
$to = $date_split[0];
}

$cond = $cond1;

?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>Pay Roll</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
<form action='payrollmonthly_Summary.php' method='post' enctype='multipart/form-data'>
<?php

 include('header.html');

?>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
  <td><span class="labeltext"><p align="left">Name</p></span></td>
<td><span class="tabletext"><input type="text" name="name" id='name' size=10 value=""></span></td>

<td  bgcolor="#FFFFFF" width='40%'><span class="labeltext"><b>Month &nbsp&nbsp</b></span>
    <select name="pl_month" id="pl_month"> 
      <option value="select" disabled="disabled" >Select</option>
      <?php 
      for ($m=1; $m < 13 ; $m++) 
      { 
      if ($m < 10) 
      {
        $m = "0".$m;
      }
      ?>
        <option <?php echo (($frm==$m)?"selected":"")?> value="<?php echo $m; ?>"><?php echo $month_names[$m]; ?></option>  
      <?php
      }
      ?>
      
  </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    


<span class="heading"><b>Year</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<select name="pl_year" id="pl_year" >
  <option value="select" disabled="disabled" >Select</option>
  <?php 
  for ($y=2010; $y < 2021 ; $y++) 
  {?>
    <option <?php echo (($to==$y)?"selected":"")?> value="<?php echo $y; ?>"><?php echo $y; ?></option>  
  <?php
  }
  ?>
  </select>
&nbsp;&nbsp;&nbsp;&nbsp;
</td>
<td bgcolor="#FFFFFF"><span class="labeltext">
<input type="submit" name="Submit"  value="Get" onclick="javascript: return searchsort_fields()">
<!-- <button class="stdbtn btn_blue" style="background-color:#2d3e50" onClick="javascript: return searchsort_fields()"  name = "Submit" value = 'Get'>Get</button> -->
</td>
<table width=100% border=0>
  <div class="contenttitle radiusbottom0">
  	<h2><span>List Of Payroll Monthly
  
  		<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='newpayroll_monthly.php'" value="New Payroll Monthly " >	
  </div>
</span>
</h2>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable" >
  <thead>
        <tr>
            <th  class="head0"><b>id</b></th>
            <th  class="head1"><b>Name</b></th>
            <th  class="head0"><b>Join Date</b></th>
            <th  class="head1"><b>Hrs Worked</b></th>
            <th  class="head0"><b>OT</b></th>
            <th  class="head1"><b>Gross Salary</b></th>
            <th  class="head0"><b>TDS</b></th>
           	<th  class="head1"><b>Net Salary</b></th>
            <th  class="head0"><b>Process Date</b></th>
            
        </tr>
  	</thead>

  	<tbody>
  		<?php 
       $previd = '';
    //  if(isset($_REQUEST['Submit']))
    // {

       $result = $newpayroll->getallpayroll_monthly($offset,$rowsPerPage,$frm,$to,$cond);  

  			while ($myrow = mysql_fetch_assoc($result)) 
  			{
        
  				//$gross = ($myrow['pay'] * $myrow['dayswork']) + ($myrow['otrate'] * $myrow['othrs']) + $myrow['allow'];

				 //  if ($gross>=50000)
				 //   $tax = $gross * .15;
				 //  if ($gross>=30000 && $gross <=49999)
				 //   $tax = $gross * .10;
				 //  if ($gross>=10000 && $gross <=29999)
				 //   $tax = $gross * .05;
				 //  if ($gross>=5000 && $gross <=9999)
				 //   $tax = $gross * .03;
				 //  if ($gross < 5000)
					// $tax = 0;
          if($myrow['join_date'] != '' && $myrow['join_date'] != '0000-00-00')
          {
          $datearr = split('-', $myrow['join_date']);
          $d=$datearr[2];
          $m=$datearr[1];
          $y=$datearr[0];
          $x=mktime(0,0,0,$m,$d,$y);
          $join_date=date("M j, Y",$x);
          }
          else
          {
          $join_date = '';
          }

          if($myrow['date'] != '' && $myrow['date'] != '0000-00-00')
          {
          $datearr = split('-', $myrow['date']);
          $d=$datearr[2];
          $m=$datearr[1];
          $y=$datearr[0];
          $x=mktime(0,0,0,$m,$d,$y);
          $process_date=date("M j, Y",$x);
          }
          else
          {
          $process_date = '';
          }
				// $totdeduct = $tax + $myrow['advances'] + $myrow['insurance'];
  		// 		$netpay = $gross - $totdeduct;
         
  			?>

  			  <tr>
  				<td align="center"><span class="tabletext"><a href="payrollmonthly_Details.php?empid=<?php echo $myrow['empid'];?>&month=<?php echo $frm?>&year=<?php echo $to;?>"><?php echo $myrow['empid'];  ?></a></span></td>
  				<td align="center"><span class="tabletext"><?php echo $myrow['name'];  ?></span></td>
          <td align="center"><span class="tabletext"><?php echo $join_date;  ?></span></td>
  				<td align="center"><span class="tabletext"><?php echo $myrow['hrs_worked'];  ?></span></td>
  				<td align="center"><span class="tabletext"><?php echo $myrow['ot'];  ?></span></td>
  				<td align="center"><span class="tabletext"><?php echo $myrow['gross_salary'];  ?></span></td>
  				<td align="center"><span class="tabletext"><?php echo $myrow['tds'];  ?></span></td>
  				<td align="center"><span class="tabletext"><?php echo $myrow['net_salary'];  ?></span></td>
          <td align="center"><span class="tabletext"><?php echo $process_date;  ?></span></td>
  				
  				</tr>

  			<?php

  			}
// }

  		?>
  	</tbody>

</span>