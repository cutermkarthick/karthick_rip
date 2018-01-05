<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Feb27,05                     =
// Filename: approval.php                      =
// Copyright of Badari Mandyam, FluentSoft Inc.=
// Revision: v1.0 OMS                          =
// Approvals for WOs                           =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}

if ( !isset ( $_REQUEST['type'] ) )
{
     header ( "Location: login.php" );
    
}
/*
if ( !isset ( $_SESSION['wotype'] ) )
{
     header ( "Location: login.php" );
    
}
if ( !isset ( $_SESSION['worecnum'] ) )
{
     header ( "Location: login.php" );
    
}
*/
if ( !isset ( $_REQUEST['typerecnum'] ) )
{
     header ( "Location: login.php" );
    
}
if ( !isset ( $_REQUEST['nextstage'] ) )
{
     header ( "Location: login.php" );
    
}
if ( !isset ( $_REQUEST['nextstatus'] ) )
{
     header ( "Location: login.php" );
    
}

if ( !isset ( $_REQUEST['wfrecnum'] ) )
{
     header ( "Location: login.php" );
    
}

$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'approval'; 
//////session_register('pagename');

$typerecnum = $_REQUEST['typerecnum'];
$type = $_REQUEST['type'];
$userrecnum = $_SESSION['userrecnum'];
$userrole = $_SESSION['userrole'];
$userid = $_SESSION['user'];
$usertype = $_SESSION['usertype'];
$nextstage = $_REQUEST['nextstage'];
$nextstatus = $_REQUEST['nextstatus'];


$worecnum = $_SESSION['worecnum'];
$wfrecnum = $_REQUEST['wfrecnum'];
$drecnum = $_REQUEST['drecnum'];


// First include the class definition 
include('classes/workorderClass.php');
include('classes/approvalClass.php');
include('classes/displayClass.php');

$newwo = new workOrder; 
$newdisp = new display; 
$newapproval = new approval; 
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
<?php $newdisp->dispLinks('');       
      echo '<img name="Image24" border="0" src="images/approval_mo.gif"></a>';
      echo '<td align="right"><img src="images/box-right-top.gif">';

?>
</td>

</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>

		

			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF">

<table width=100% border=0 cellspacing="1" cellpadding="6">
    <tr>
        <td align="left"><span class="heading"><b><?php echo $_SESSION['wotype'] ?> Work Order Approval For <?php echo $_SESSION['wonum'] ?> </b></td>
    </tr>

    <FORM ACTION = "processApproval.php" METHOD = "POST">
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Approvals</b></center></td>
        </tr>
        
      
<?php 

        echo '<tr bgcolor="#FFFFFF"><td><span class="tabletext">' . $nextstatus . ': </td><td><input type="checkbox" name="approval" maxlength="32"></td></tr>';
?>

        <input type="hidden" name="worecnum" value="<?php echo $worecnum ?>" />
        <input type="hidden" name="type" value="<?php echo $type ?>" />
        <input type="hidden" name="typerecnum" value="<?php echo $typerecnum ?>" />
        <input type="hidden" name="wfrecnum" value="<?php echo $wfrecnum ?>" />
        <input type="hidden" name="nextstatus" value="<?php echo $nextstatus ?>" />
        <input type="hidden" name="drecnum" value="<?php echo $drecnum ?>" />

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
	




