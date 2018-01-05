<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2004                 =
// Filename: printSr.php                       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Printing Sr                                 =
// Date-modified: November 30, 2006            =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}


// Includes
include_once('classes/loginClass.php');
include('classes/srClass.php');
include('classes/workorderClass.php');
include('classes/supportClass.php');

/*$typenum = $_REQUEST['typenum'];
if ( !isset ( $typenum ) )
{
     header ( "Location: login.php" );

}*/
$srrecnum = $_REQUEST['srrecnum'];
if ( !isset ( $srrecnum) )
{
     header ( "Location: login.php" );

}
//$_SESSION['typenum'] = $typenum;
$_SESSION['srrecnum'] = $srrecnum;
////////session_register('typenum');
$userid = $_SESSION['user'];
$newsupp=new support;
$newlogin = new userlogin;
$newlogin->dbconnect();

$newsr = new sr;
	$result=$newsr->getsrs4prntUpd($srrecnum);
	$myrow = mysql_fetch_row($result);
	$result1=$newsupp->getcontacts4support($srrecnum,'SR');
	$myrow1=mysql_fetch_row($result1);
	$result4=$newsupp->getwonum4support($srrecnum,'SR');
	$myrow4=mysql_fetch_row($result4);
	$result5=$newsupp->getsolnum4support($srrecnum,'SR');
	$myrow5=mysql_fetch_row($result5);

?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>

<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Service Request</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>

<table width=630 border=1 rules=none>

        <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">SR Num</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[1]";?></p></font></td>
	        <td><span class="labeltext"><p align="left">SR Title</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[2]";?></p></font></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Drawing Rev</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[3]";?></p></font></td>
            <td><span class="labeltext"><p align="left">Reported By</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[4]";?></p></font></td>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Due Date</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[5]";?></p></font></td>
            <td><span class="labeltext"><p align="left">Received Date</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[6]";?></p></font></td>
        </tr>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Priority</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[7]";?></p></font></td>
            <td><span class="labeltext"><p align="left">Status</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[8]";?></p></font></td>
        </tr>
         <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left">Doc Date</p></font></td>
         <td><span class="tabletext"><p align="left"><?php echo "$myrow[9]";?></p></font></td>
         <td><span class="labeltext"><p align="left">Solution No</p></font></td>
         <td><span class="tabletext"><p align="left"><?php echo "$myrow5[1]";?></p></font></td>
        </tr>
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Work Order Information</b></center></td>

<?php
$result3=$newsr->getwonum4sr($myrow4[0]);
$myrow3=mysql_fetch_row($result3);
?>
        <tr bgcolor="#FFFFFF">
		    <td><span class="labeltext"><p align="left">Work Order No&nbsp;</p></font></td>
            <td><span class="tabletext"><?php echo "$myrow3[0]";?>
        	<td><span class="labeltext"><p align="left">Company</p></font></td>
          	<td><span class="tabletext"><?php echo "$myrow3[1]";?> </td>
		</tr>
		<tr bgcolor="#FFFFFF">
       		<td ><span class="labeltext"><p align="left">Contact&nbsp;</p></td>
           	<td><span class="tabletext"><?php echo "$myrow3[2]" . "$myrow3[3]";?></td>
		    <td><span class="labeltext"><p align="left">Email</p></font></td>
          	<td><span class="tabletext"><?php echo "$myrow3[4]";?></td>
		</tr>
		<tr bgcolor="#FFFFFF">
        	<td><span class="labeltext"><p align="left">Designer</p></font></td>
          	<td><span class="tabletext"><?php echo "$myrow3[5]" . "$myrow3[6]";?></td><td colspan=2>&nbsp;</td>
		</tr>
       <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Customer Information</b></center></td></tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Customer</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo  "$myrow1[0]";?></p></font></td>
            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow1[1]";?></p></font></td>
        </tr>
          <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">Contact</p></font></td>
             <td><span class="tabletext"><p align="left"><?php echo  $myrow1[2] . "  " . $myrow1[3];?></p></font></td>
             <td><span class="labeltext"><p align="left">Email</p></font></td>
             <td><span class="tabletext"><p align="left"><?php echo  "$myrow1[5]";?></p></font></td>
        </tr>
       <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Owner Information</b></center></td></tr>
       <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left">Owner</p></font></td>
           <td><span class="tabletext"><p align="left"><?php echo  $myrow1[6] . $myrow1[7];?></p></font></td>
           <td colspan=3>&nbsp;</td>
       </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo  "$myrow1[8]";?></p></font></td>
            <td><span class="labeltext"><p align="left">Email</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo  "$myrow1[9]";?></p></font></td>
        </tr>
       <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Error Description</b></center></td></tr>
         <tr bgcolor="#FFFFFF">
         <td colspan=4><span class="tabletext"><p align="left"><?php echo  "$myrow[10]";?></p></font>
      </td>
        </tr>

      </FORM>
     </table>
    </td>
</tr>
</table>



</body>
</html>
