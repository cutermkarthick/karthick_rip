<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2005                =
// Filename: addNotes.php                      =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Allows the addition of Notes.               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

if (isset($_REQUEST['opportunityrecnum']))
{
	$opportunityrecnum=$_REQUEST['opportunityrecnum'];
  }
  else if (isset($_SESSION['opportunityrecnum']))
  {

}
$userrecnum = $_SESSION['userrecnum'];

$_SESSION['pagename'] = 'addNotes4opportunity';
$page = "CRM: Opportunity";
//session_register('pagename');
// First include the class definition

include('classes/workorderClass.php');
include('classes/displayClass.php');
$newdisp = new display;
$newwo = new workOrder;


?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/opportunity.js"></script>
<html>
<head>
<title>Add Notes</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>

<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">

<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
    <tr>

        <td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        <td align="right">&nbsp;
        <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>

    </tr>
</table>


<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr><td>

	</td></tr>
	<tr>
	<td>
<?php
     $newdisp->dispLinks('');
?>
</td>

</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td> -->
				<td bgcolor="#FFFFFF">

<table width=100% border=0 cellspacing="1" cellpadding="6">
    <tr>
        <td align="left"><span class="heading"><b>Add Notes</b></td>
    </tr>
<FORM ACTION = "processNotes4opportunity.php" METHOD = "POST">

 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Opportunity Notes</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
             <td colspan=4><textarea name="spec_instrns" rows="3" cols="72" value=""></textarea>
             <input type="hidden" name="opportunityrecnum" value="<?php echo $opportunityrecnum ?>" />

</td>
        </tr>

        </table>
				</td>


		<!-- 		<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td ><img src="images/spacer.gif" height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr> -->



       <table>
       <tr>

                     <span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields4notes()">


      </FORM>

</td></tr>


					</table>






</body>
</html>