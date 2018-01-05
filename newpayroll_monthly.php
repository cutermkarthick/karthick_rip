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

include_once('classes/payrollmonthlyClass.php');
$newpayroll = new Payroll_monthly;

?>
<html>
<head>
<title>Pay Roll</title>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/payroll.js"></script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
<form action='processpayroll_monthly.php' method='post' enctype='multipart/form-data'>
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
        <td width=25%><span class="tabletext">
        <?php $result = $newpayroll->getmsterid();?>
        <select name="empid" id="empid" onchange="javascript:getpayroll_name()">
        <option value="select">Select</option>
        <? while($myrow = mysql_fetch_row($result))
           {
       
               echo "<option value='$myrow[0]|$myrow[1]|$myrow[2]'>$myrow[1]";
          
            }
            ?>
            <input type="hidden" id="emp_id" name="emp_id" size=10 value="">
        </select>

            
        <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Name</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="emp_name" name="emp_name" size=10 value="" style="background-color:#DDDDDD;"
                    readonly="readonly"></span></td>
	</tr>

	<tr bgcolor="#FFFFFF">
        <td width=25%><span class="labeltext"><p align="left">Hrs Worked</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="hrswork" name="hrswork" size=20 value="" ></span></td>
        <td width=25%><span class="labeltext"><p align="left">OT</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="ot" name="ot" size=20 value="" ></span></td>
        	</span>
       	</td>
	</tr>

	<tr bgcolor="#FFFFFF">
        <td width=25%><span class="labeltext"><p align="left">Gross Salary</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="gross_salary" name="gross_salary" size=20 value="" ></span>
        <td width=25%><span class="labeltext"><p align="left">TDS</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="tds" name="tds" size=20 value=""></span>      	</td>
	</tr>

	<tr bgcolor="#FFFFFF">
        <td width=25%><span class="labeltext"><p align="left">Net Salary</p></span></td>
        <td width=25%><span class="tabletext"><input type="text" id="net_salary" name="net_salary" size=20 value="" ></span></td>
        <td width=25%><span class="labeltext"><p align="left">Date</p></span></td>
        <td width=25%><span class="tabletext">
            <input type="text" id="date" name="date" size=10 value="" style="background-color:#DDDDDD;"
                    readonly="readonly">
               <img src="images/bu-getdateicon.gif" alt="Get JoinDate" onClick="GetDate('date')">
            </span></td>
	</tr>

	
</table>
	
	<input type="hidden" name="pagename" id="pagename" value="newpayroll_monthly">
    <input type="hidden" name="link2paymaster" id="link2paymaster" value="">


	<input type="submit" style="color=#0066CC;background-color:#DDDDDD;width=130;" value="Submit" name="submit" onclick="javascript: return check_req_fields()">

    <input type="RESET" style="color=#0066CC;background-color:#DDDDDD;width=130;" value="Reset" onclick="javascript: putfocus()">

</form>
</body>
</html>

