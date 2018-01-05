<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2004                 =
// Filename: board.php                         =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Board details                               =
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
include('classes/capacity_planclass.php');


$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'capacity_plan_details';
//////session_register('pagename');
$newlogin = new userlogin;
$newlogin->dbconnect();
$newdisplay = new display;
$newCP = new capacity_plan;
$capacity_planrecnum = $_REQUEST['capacity_planrecnum'];
$result = $newCP->getcapacity_plan($capacity_planrecnum);
$myrow = mysql_fetch_row($result);

?>
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/capacity_plan.js"></script>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>Capacity Plan</title>
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
    $newdisplay->dispLinks('');
?>
</td></tr>
</table>

<table width=100% border=0 cellpadding=0 cellspacing=0  >

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	 <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0>
    <tr>
        <td><span class="pageheading"><b>Capacity Plan</b></td>
        <td align=right><a href ="edit_capacity_plan.php?capacity_planrecnum=<?php echo $capacity_planrecnum ?>" ><img name="Image8" border="0" src="images/bu-edit.gif" ></a>
               <input type= "image" name="Print" src="images/bu-print.gif" value="Print" onclick="javascript: printcapacity_plan(<?php echo $capacity_planrecnum ?>)">
            </td>
    </tr>


     <form action='processcapacity_plan.php' method='post' enctype='multipart/form-data'>
<tr>
<td colspan=2>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Capacity Plan Header</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">Machine ID</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow[1] ?></td>
            <td width=25%><span class="labeltext"><p align="left">Available Capacity</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow[2] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Used capacity</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[3] ?></td>
            <td><span class="labeltext"><p align="left">Unused capacity</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[4] ?>
        </tr>

</table>
</table>

      </FORM>


  <table border=0 bgcolor="#FFFFFF" width=100%  cellspacing=1 cellpadding=3>
   <tr>
    <td>

 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

     <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
      <tr>


      </tr></table>
        </table>


</td>
				<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>

		</table>

      </FORM>


</table>

</body>
</html>
