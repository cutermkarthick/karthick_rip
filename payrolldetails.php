<?php 
	
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'payrollsummary';
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

$recnum = $_REQUEST['recnum'];
$cond = '';
$result = $newpayroll->getpayroll_details($recnum);
$myrow = mysql_fetch_assoc($result);

?>

<html>
<head>
<title>Pay Roll Master</title>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/payroll.js"></script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
<form action='process_payroll.php' method='post' enctype='multipart/form-data'>
<?php

 include('header.html');

?>

<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>Payroll Master</b></span></td>
    </tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
  	<tr bgcolor="#DDDEDD">
    	<td colspan=4><span class="heading"><center><b>Payroll Master</b></center></span></td>
        <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='edit_payrollmaster.php?recnum=<?php echo $myrow['recnum']?>'" value="Edit Payroll Master" >  
    </tr>


    <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">ID</p></span></td>
        <td><span class="tabletext"><?php echo $myrow['id']?></span></td>
         <td><span class="labeltext"><p align="left">Name</p></span></td>
        <td><span class="tabletext"><?php echo $myrow['name']?></span></td>
    </tr>

    <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Basic Salary</p></span></td>
        <td><span class="tabletext"><?php echo $myrow['basic_salary']?></span></td>
         <td><span class="labeltext"><p align="left">HRA</p></span></td>
        <td><span class="tabletext"><?php echo $myrow['hra']?></span></td>
    </tr>

    <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">TA</p></span></td>
        <td><span class="tabletext"><?php echo $myrow['ta']?></span></td>
         <td><span class="labeltext"><p align="left">SA</p></span></td>
        <td><span class="tabletext"><?php echo $myrow['sa']?></span></td>
    </tr>

    <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Increment</p></span></td>
        <td><span class="tabletext"><?php echo $myrow['increment']?></span></td>
         <td><span class="labeltext"><p align="left">Join Date</p></span></td>
        <td><span class="tabletext"><?php echo $myrow['join_date']?></span></td>
    </tr>

    <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Role</p></span></td>
        <td><span class="tabletext"><?php echo $myrow['role']?></span></td>
         <td><span class="labeltext"><p align="left">Grade</p></span></td>
        <td><span class="tabletext"><?php echo $myrow['grade']?></span></td>
    </tr>


</table>




