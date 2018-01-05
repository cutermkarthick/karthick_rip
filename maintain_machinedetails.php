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
include('classes/maintain_machineClass.php');


$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'maintain_machine_details';
//////session_register('pagename');
$newlogin = new userlogin;
$newlogin->dbconnect();
$newdisplay = new display;
$newMM = new maintain_machine;
$maintain_machinerecnum = $_REQUEST['maintain_machinerecnum'];
$result = $newMM->getmaintain_machine($maintain_machinerecnum);
$myrow = mysql_fetch_row($result);

?>
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/maintain_machine.js"></script>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>maintain machine master data</title>
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
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>Maintain Machine Master Data</b></td>
        <td align=right><a href ="edit_maintain_machine.php?maintain_machinerecnum=<?php echo $maintain_machinerecnum ?>" ><img name="Image8" border="0" src="images/bu-edit.gif" ></a>
          <input type= "image" name="Print" src="images/bu-print.gif" value="Print" onclick="javascript: printmaintain_machine(<?php echo $maintain_machinerecnum ?>)">
        </td>
    </tr>


     <form action='processmaintain_machine.php' method='post' enctype='multipart/form-data'>
<tr>
<td colspan=2>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Machine Master Data Header</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">Machine ID</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow[1] ?></td>
            <td width=25%><span class="labeltext"><p align="left">Purpose</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow[2] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Task</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[3] ?></td>
            <td><span class="labeltext"><p align="left">Task Time</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[4] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
           <!-- <td><span class="labeltext"><p align="left">Currency</p></font></td>
            <td><select name="currency">
                          <option selected>$
                          <option>Rs
                          </select></td>    -->
            <td><span class="labeltext"><p align="left">Cost/hr</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[5]. ' ' ?><?php echo $myrow[6] ?></td>
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
