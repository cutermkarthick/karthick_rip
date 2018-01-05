<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: socketApproval.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Socket Approval                             =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
if ( !isset ( $_REQUEST['typerecnum'] ) )
{
     header ( "Location: login.php" );
    
}
$_SESSION['pagename'] = 'socketapproval'; 
//////session_register('pagename');
$worecnum = $_SESSION['worecnum'];
$typerecnum = $_REQUEST['typerecnum'];
$type = $_REQUEST['type'];
$custsignoff=$_REQUEST['custsignoff'];
$fpsignoff=$_REQUEST['fpsignoff'];
$mfgsignoff=$_REQUEST['mfgsignoff'];

$userrecnum = $_SESSION['userrecnum'];
$userrole = $_SESSION['userrole'];
$userid = $_SESSION['user'];
$usertype = $_SESSION['usertype'];


// First include the class definition 

include('classes/workorderClass.php');
include('classes/socketClass.php');

$newwo = new workOrder; 
$newsocket = new socket; 

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>

<html>
<head>
<title>Approval</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>

<table width=100% cellspacing="0" cellpadding="6" border="0">

<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
    <tr>
 
        <td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        <td align="right">
        <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        
    </tr>
</table>


<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr><td>
	
	</td></tr>
	<tr>
	<td>
<?php $newsocket->dispLinks(); 
      echo '<img name="Image24" border="0" src="images/approval_mo.gif"></a>';
      echo '<td align="right"><img src="images/box-right-top.gif">';
?>
</td>

</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

		

			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF">

<table width=100% border=0 cellspacing="1" cellpadding="6">
    <tr>
        <td align="left"><span class="heading"><b>Socket WO Approval</b></td>
    </tr>

<FORM ACTION = "processSocketApproval.php" METHOD = "POST">

 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Approvals</b></center></td>
        </tr>
      
<?php 
        if ($usertype == 'CUST') {
                   
           if (($fpsignoff != '' && $fpsignoff != '0000-00-00')  && 
               ($custsignoff == '' || $custsignoff == '0000-00-00')) {
              echo '<tr  bgcolor="#FFFFFF"><td><span class="tabletext">Customer FP Signoff: </td><td><input type="checkbox" name="custsignoff" maxlength="32"></td></tr>';
           }
        }
        if ($usertype == 'EMPL' && $userrole == 'DESG_S') {

              if ($fpsignoff == '' || $fpsignoff == '0000-00-00') {
               echo '<tr bgcolor="#FFFFFF"><td><span class="tabletext">FP Complete: </td><td><input type="checkbox" name="fpcomp"></td></tr>';
              }
        }

        if ($usertype == 'EMPL' && $userrole == 'SU') {

              if ($fpsignoff == '' || $fpsignoff == '0000-00-00') {
               echo '<tr bgcolor="#FFFFFF"><td><span class="tabletext">FP Complete: </td><td><input type="checkbox" name="fpcomp"></td></tr>';
              }

              else if (($mfgsignoff == '' || $mfgsignoff == '0000-00-00') && 
                   ($custsignoff != '' && $custsignoff != '0000-00-00')) {
               echo '<tr bgcolor="#FFFFFF"><td><span class="tabletext">Mfg Complete: </td><td><input type="checkbox" name="mfgcomp"></td></tr>';
              }

          
        }
?>
        
        <tr><td><input type="hidden" name="typerecnum" value="<?php echo $typerecnum ?>" /></td></tr>
        <tr><td><input type="hidden" name="type" value="<?php echo $type ?>" /></td></tr>
        <tr><td><input type="hidden" name="worecnum" value="<?php echo $worecnum ?>" /></td></tr>
</td>
        </tr> 
            
        </table>
				</td>


				<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td ><img src="images/spacer.gif" height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>

	 
 
       <table>
       <tr>
 
        <span class="tabletext"><input type="submit" value="Submit" name="submit">
        
      </FORM>

</td></tr>


					</table>


