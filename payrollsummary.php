<?php 
	
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'payrollsummary';
// $page="Payroll: Master";
$page="ELM: Master";
	

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

include_once('classes/PayrollmasterClass.php');
$newpayroll = new payroll_master;

$cond = '';
$result = $newpayroll->getallpayroll($offset,$rowsPerPage);


?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>Pay Roll</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
<form action='nc4qa_summary.php' method='post' enctype='multipart/form-data'>
<?php

 include('header.html');

?>
<table width=100% border=0>
  <div class="contenttitle radiusbottom0">
  	<h2><span>List Of Payroll Master
  
  		<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='new_payroll.php'" value="New Payroll Master " >	
  </div>
</span>
</h2>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable" >
  <thead>
        <tr>
            <th  class="head0"><b>id</b></th>
            <th  class="head1"><b>Name</b></th>
            <th  class="head0"><b>Basic salary</b></th>
            <th  class="head1"><b>HRA</b></th>
            <th  class="head0"><b>TA</b></th>
            <th  class="head1"><b>SA</b></th>
           	<th  class="head0"><b>Increment</b></th>
            <th  class="head1"><b>Join Date</b></th>
            <th  class="head1"><b>Role</b></th>
            <th  class="head1"><b>Grade</b></th>
        </tr>
  	</thead>

  	<tbody>
  		<?php 

  			while ($myrow = mysql_fetch_assoc($result)) 
  			{
  				$gross = ($myrow['pay'] * $myrow['dayswork']) + ($myrow['otrate'] * $myrow['othrs']) + $myrow['allow'];

				  if ($gross>=50000)
				   $tax = $gross * .15;
				  if ($gross>=30000 && $gross <=49999)
				   $tax = $gross * .10;
				  if ($gross>=10000 && $gross <=29999)
				   $tax = $gross * .05;
				  if ($gross>=5000 && $gross <=9999)
				   $tax = $gross * .03;
				  if ($gross < 5000)
					$tax = 0;
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
				$totdeduct = $tax + $myrow['advances'] + $myrow['insurance'];
  				$netpay = $gross - $totdeduct;

  			?>

  			<tr>
  				<td align="center"><span class="tabletext"><a href="payrolldetails.php?recnum=<?php echo $myrow['recnum'];  ?>"><?php echo $myrow['id'];  ?></a></span></td>
  				<td align="center"><span class="tabletext"><?php echo $myrow['name'];  ?></span></td>
  				<td align="center"><span class="tabletext"><?php echo $myrow['basic_salary'];  ?></span></td>
  				<td align="center"><span class="tabletext"><?php echo $myrow['hra'];  ?></span></td>
  				<td align="center"><span class="tabletext"><?php echo $myrow['ta'];  ?></span></td>
  				<td align="center"><span class="tabletext"><?php echo $myrow['sa'];  ?></span></td>
  				<td align="center"><span class="tabletext"><?php echo $myrow['increment'];  ?></span></td>
  				<td align="center"><span class="tabletext"><?php echo $join_date;  ?></span></td>
          <td align="center"><span class="tabletext"><?php echo $myrow['role'];  ?></span></td>
          <td align="center"><span class="tabletext"><?php echo $myrow['grade'];  ?></span></td>
  				</tr>

  			<?php
  			}


  		?>
  	</tbody>

</span>