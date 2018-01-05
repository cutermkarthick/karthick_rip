<?php 
  
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'attendancesummary';
$page="ELM: Attendance";


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

include_once('classes/empClass.php');
$newEmp = new emp;

if(isset($_REQUEST['empid']))
{
   $empid = $_REQUEST['empid'];
   $cond1 = "e.empid like'" . $empid . "%'";
}
else
{
   $empid = "";
   $cond1 = "e.empid like'%'";
}

$today = date("Y-m-d");

if(isset($_REQUEST['pl_month'])){
$month = $_REQUEST['pl_month'];
$cond2 = "am.month ='" .$month."'"; 
}else{
  $date_split = explode('-', $today);
  $month = $date_split[1];
  $cond2 = "am.month ='" .$month."'";
}

if(isset($_REQUEST['pl_year'])){
  $year = $_REQUEST['pl_year'];
  $cond3 = "am.year ='" .$year."'";
}else{
  $date_split = explode('-', $today);
  $year = $date_split[0];
  $cond3 = "am.year ='" .$year."'";
}

$cond = $cond1.' and '.$cond2.' and '.$cond3;

?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>Attendance</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
<form action='payrollmonthly_Summary.php' method='post' enctype='multipart/form-data'>
<?php

 include('header.html');

?>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
  <td><span class="labeltext"><p align="left">Name</p></span></td>
<td><span class="tabletext"><input type="text" name="empid" id='empid' size=10 value=""></span></td>

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
        <option <?php echo (($month==$m)?"selected":"")?> value="<?php echo $m; ?>"><?php echo $month_names[$m]; ?></option>  
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
    <option <?php echo (($year==$y)?"selected":"")?> value="<?php echo $y; ?>"><?php echo $y; ?></option>  
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
    <h2><span>List Of Attendance Monthly
  
      <!-- <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='newpayroll_monthly.php'" value="New Payroll Monthly " >  --> 
  </div>
</span>
</h2>
</table>
<table width=80% align='center' border=1 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
  <thead>
        <tr>
            <th  class="head0"><b>Eid</b></th>
            <th  class="head1"><b>First Name</b></th>
            <th  class="head0"><b>Last Name</b></th>
            <th  class="head1"><b>Days Worked</b></th>
            <th  class="head0"><b>Hours Worked</b></th>
        </tr>
    </thead>

    <tbody>
      <?php 
       $previd = '';

       $result = $newEmp->getAllEmps4Ams($cond);  

        while ($myrow = mysql_fetch_assoc($result)) 
        {
          
        ?>

          <tr bgcolor="#FFFFFF">
          <td align="center"><span class="tabletext"><a href="attendancemonthly_Details.php?empid=<?php echo $myrow['empid'];?>&month=<?php echo $month?>&year=<?php echo $year;?>"><?php echo $myrow['empid'];  ?></a></span></td>
          <td align="center"><span class="tabletext"><?php echo $myrow['fname'];  ?></span></td>
          <td align="center"><span class="tabletext"><?php echo $myrow['lname'];  ?></span></td>
          <td align="center"><span class="tabletext"><?php echo $myrow['days_come'];  ?></span></td>
          <td align="center"><span class="tabletext"><?php echo $myrow['hours_worked'];  ?></span></td>
          
          
          </tr>

        <?php

        }


      ?>
    </tbody>
</table>
</span>