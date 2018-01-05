<?php


session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
    header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'newcontract';
$page="Contract";

$userid = $_SESSION['user'];
$userrecnum = $_SESSION['userrecnum'];



?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/emp.js"></script>


<html>
<head>
<title>New Contract</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
     <form action='ProcessContract.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>

    <table width=100% border=0>
      <tr>
        <td><span class="pageheading"><b>New Contract</b></td>
      </tr>
   	</table>

		</td></tr>
		<tr>
    <td>

    <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
      <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
     	<tr bgcolor="#FFFFFF"  >
    		<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
          
    			<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Company Name</p></span></td>
            <td><input type="text" name="companyname" id="companyname" size="35"></td>
            <td></td>
            <td></td>
        	</tr>

          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Start Date</p></span></td>
            <td><span class="tabletext">
              <input type="text" name="start_date" id="start_date" value=""
               style="background-color:#DDDDDD;" readonly="readonly"></span>
              <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('start_date')">
            </td>
            <td><span class="labeltext"><p align="left">End Date</p></span></td>
            <td><span class="tabletext">
              <input type="text" name="end_date" id="end_date" value=""
               style="background-color:#DDDDDD;" readonly="readonly"></span>
              <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('end_date')">
            </td>
          </tr>

        </table>
      </td>
    </tr>
    </table>
    </td>
  </table>
    <br>  
    <table border = 0 cellpadding=0 cellspacing=0 width=100% >
      <tr>
          <td align=left>
          </td>
      </tr>
  	</table>

    	<span class="tabletext">
    	<input type="submit"   value="Submit" name="Import"  onClick="javascript: return check_req_field4EmpConfig()">
    	<input TYPE="reset" style="color=#0066CC;background-color:#DDDDDD;width=130;" VALUE="Reset" onclick="javascript: putfocus()">

    	</form>
  </body>
</html>
