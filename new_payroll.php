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
        <td width=25%>
            <span class="tabletext"><input type="text" id="empid" name="empid" size=20 value="" style="background-color:#DDDDDD;" readonly="readonly"></span>
            <img src="images/bu-get.gif" name="empid" onclick="GetCIM('empid')"> 
        </td>
        <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Name</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="name" name="name" size=20 value="" style="background-color:#DDDDDD;" readonly="readonly"></span></td>
        <input type="hidden" name="emprecnum" id="emprecnum" value="">
	</tr>

	<tr bgcolor="#FFFFFF">
        <td width=25%><span class="labeltext"><p align="left">Basic Salary</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="basic" name="basic" size=20 value="" ></span></td>
        <td width=25%><span class="labeltext"><p align="left">HRA</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="hra" name="hra" size=20 value="" ></span></td>
        	</span>
       	</td>
	</tr>

	<tr bgcolor="#FFFFFF">
        <td width=25%><span class="labeltext"><p align="left">TA</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="ta" name="ta" size=20 value="" ></span>
        <td width=25%><span class="labeltext"><p align="left">SA</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="sa" name="sa" size=20 value=""></span>      	</td>
	</tr>

	<tr bgcolor="#FFFFFF">
        <td width=25%><span class="labeltext"><p align="left">Increment</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="increment" name="increment" size=20 value="" ></span></td>
        <td width=25%><span class="labeltext"><p align="left">Join Date</p></span></td>
        <td width=25%><span class="tabletext">
            <input type="text" id="jdate" name="jdate" size=10 value="" style="background-color:#DDDDDD;"
                    readonly="readonly">
               <img src="images/bu-getdateicon.gif" alt="Get JoinDate" onClick="GetDate('jdate')">
            </span></td>
	</tr>

    <tr bgcolor="#FFFFFF">
        <td width=25%><span class="labeltext"><p align="left">Role</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="role" name="role" size=20 value="" ></span></td>
        <td width=25%><span class="labeltext"><p align="left">Grade</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="grade" name="grade" size=20 value="" ></span></td>
            </span>
        </td>
    </tr>
	
</table>
	
	<input type="hidden" name="pagename" id="pagename" value="newpayroll_master">

	<input type="submit" style="color=#0066CC;background-color:#DDDDDD;width=130;" value="Submit" name="submit" onclick="javascript: return check_req_fields()">

    <input type="RESET" style="color=#0066CC;background-color:#DDDDDD;width=130;" value="Reset" onclick="javascript: putfocus()">

</form>
</body>
</html>

