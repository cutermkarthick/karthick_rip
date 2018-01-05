<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2004                 =
// Filename: workflow                          =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Workflow details                            =
//==============================================
session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}


// Includes
include_once('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/workflowClass.php');


$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'workflow'; 
$page="Work Flow";
//////session_register('pagename');
$newlogin = new userlogin;
$newlogin->dbconnect();
$newdisplay = new display; 
$newWF = new workflow; 

?>
<script language="javascript" src="scripts/mouseover.js"></script>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>List of Workflows</title>
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
<?php    $newdisplay->dispLinks(''); 
?>
</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

		

			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF"> -->

<table width=100% border=0 cellspacing="1" cellpadding="6">
    <tr>
        <td align="left"><span class="pageheading"><b>List of Workflows</b></td>
	<td align=right><a href ="addwfstage.php"><img name="Image8" border="0" src="images/bu-newwf.gif"></a></td>
    </tr>

    </tr>
    <table border=0 bgcolor="#DFDEDF" width=75% cellspacing=1 cellpadding=3 class="stdtable1">

      <tr>
	<td bgcolor="#EEEFEE"><span class="heading"><b>Type</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Parent Type</b></td>
      </tr>	
<?php
      $result = $newWF->getWFdoc(); 

      while ($myrow = mysql_fetch_row($result)) {
?>				
      <tr>

        <td bgcolor="#FFFFFF"><span class="heading"><b><a href="wfdetails.php?wftype=<?php echo $myrow[0] ?>"><?php echo $myrow[0] ?></a></b></td>
 	<td bgcolor="#FFFFFF"><span class="heading"><b><?php echo $myrow[1] ?></b></td>
      </tr>
<?php
      }
?>
        </table>
</td>
	<!-- 			<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr> -->

		</table>

      </FORM>


</table>


					
</body>
</html>