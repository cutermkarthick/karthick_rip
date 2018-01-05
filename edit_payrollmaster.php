<?php 
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'payrollsummary';

include_once('classes/PayrollmasterClass.php');
$newpayroll = new payroll_master;

$recnum = $_REQUEST['recnum'];
$result = $newpayroll->getpayroll_details($recnum);
$myrow = mysql_fetch_assoc($result);
$page="ELM: Master";
?>
<html>
<head>
<title>Pay Roll</title>
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
    </tr>
	
    <tr bgcolor="#FFFFFF">
        <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Emp Id</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="empid" name="empid" size=20 value="<?php echo $myrow['id']?>" style="background-color:#DDDDDD;"
                    readonly="readonly"></span></td>
        <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Name</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="name" name="name" size=10 value="<?php echo $myrow['name']?>" style="background-color:#DDDDDD;"
                    readonly="readonly"></span></td>
	</tr>

	<tr bgcolor="#FFFFFF">
        <td width=25%><span class="labeltext"><p align="left">Basic Salary</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="basic" name="basic" size=20 value="<?php echo $myrow['basic_salary']?>" ></span></td>
        <td width=25%><span class="labeltext"><p align="left">HRA</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="hra" name="hra" size=20 value="<?php echo $myrow['hra']?>" style="background-color:#DDDDDD;"
                    readonly="readonly"></span></td>
        	</span>
       	</td>
	</tr>

	<tr bgcolor="#FFFFFF">
        <td width=25%><span class="labeltext"><p align="left">TA</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="ta" name="ta" size=20 value="<?php echo $myrow['ta']?>" style="background-color:#DDDDDD;"
                    readonly="readonly" ></span>
        <td width=25%><span class="labeltext"><p align="left">SA</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="sa" name="sa" size=20 value="<?php echo $myrow['sa']?>" style="background-color:#DDDDDD;"
                    readonly="readonly"></span></td>
	</tr>

	<tr bgcolor="#FFFFFF">
        <td width=25%><span class="labeltext"><p align="left">Increment</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="increment" name="increment" size=20 value="<?php echo $myrow['increment']?>"></span></td>
        <td width=25%><span class="labeltext"><p align="left">Join Date</p></span></td>
        <td width=25%><span class="tabletext">
            <input type="text" id="jdate" name="jdate" size=10 value="<?php echo $myrow['join_date']?>" style="background-color:#DDDDDD;"
                    readonly="readonly">
               <!-- <img src="images/bu-getdateicon.gif" alt="Get JoinDate" onClick="GetDate('jdate')"> -->
            </span></td>
	</tr>

    <tr bgcolor="#FFFFFF">
        <td width=25%><span class="labeltext"><p align="left">Role</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="role" name="role" size=20 value="<?php echo $myrow['role']?>" style="background-color:#DDDDDD;"
                    readonly="readonly" ></span>
        <td width=25%><span class="labeltext"><p align="left">Grade</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="grade" name="grade" size=20 value="<?php echo $myrow['grade']?>" style="background-color:#DDDDDD;"
                    readonly="readonly"></span></td>
    </tr>

	
</table>
	
	<input type="hidden" name="pagename" id="pagename" value="editpayroll_master">
    <input type="hidden" name="recnum" id="recnum" value="<?php echo $myrow['recnum']?>">

	<input type="submit" style="color=#0066CC;background-color:#DDDDDD;width=130;" value="Submit" name="submit" onclick="javascript: return check_req_fields()">

    <input type="RESET" style="color=#0066CC;background-color:#DDDDDD;width=130;" value="Reset" onclick="javascript: putfocus()">

</form>
</body>
</html>

