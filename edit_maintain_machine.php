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
$_SESSION['pagename'] = 'edit_maintain_machine';
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
<script language="javascript" src="scripts/datasheet.js"></script>
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
    </tr>


     <form action='processmaintain_machine.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Machine Master Data Header</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Machine ID</p></font></td>
            <td><span class="tabletext"><input type="text" name="machineid" size=20 value="<?php echo $myrow[1] ?>"></td>
            <td><span class="labeltext"><p align="left">Purpose</p></font></td>
            <td><input type="text" name="purpose" size=40 value="<?php echo $myrow[2] ?>"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Task</p></font></td>
            <td><input type="text" name="task" size=20 value="<?php echo $myrow[3] ?>"></td>
            <td><span class="labeltext"><p align="left">Task Time</p></font></td>
            <td><input type="text" name="task_time" size=20 value="<?php echo $myrow[4] ?>">
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Currency</p></font></td>
            <td><select name="currency">
                         <?php if($myrow[5]=='$')
                               {
                         ?>
                          <option selected>$
                          <option>Rs
                         <?php }
                               else
                               {
                         ?>
                         <option>$
                         <option selected>Rs
                         <?php }

                         ?>
                               
                          </select></td>
            <td><span class="labeltext"><p align="left">Cost/hr</p></font></td>
            <td><input type="text" name="cost" size=20 value="<?php echo $myrow[6] ?>"></td>
        </tr>
  <input type="hidden" name="maintain_machinerecnum" value="<?php echo $maintain_machinerecnum ?>">

</table>
</table>
<span class="labeltext"><input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()">

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
