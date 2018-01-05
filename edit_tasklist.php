<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = September 20, 2006           =
// Filename:  edit_tasklist.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Edition for tasklist                        =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'edittasklist';
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/tasklistClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$newdisplay = new display;
if (isset($_REQUEST['tasklistrecnum']))
{
	$tasklistrecnum=$_REQUEST['tasklistrecnum'];
}

$newtask= new tasklist;
$newdisplay = new display;

$result = $newtask->getasklist($tasklistrecnum);
$myrow = mysql_fetch_row($result);
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/tasklist.js"></script>

<html>
<head>
<title>Edit Tasklist</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processTasklist.php' method='post' >
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
	  <td>
		<table width=100% border=0 cellspacing="0" cellpadding="0">
   			<tr>
        	  <td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        		<td align="right">&nbsp;
       		   	<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        	 </tr>
		</table>
	<table width=100% border=0 cellpadding=0 cellspacing=0  >
   <tr><td></td></tr>
  <tr><td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr>
<td>
	<table width=100% border=0>
        <td><span class="pageheading"><b>Edit Tasks</b></td>
           <td colspan=20>&nbsp;</td>
	       <td bgcolor="#FFFFFF" align="right"><input type= "image" name="Delete" src="images/bu-delete.gif" value="Get" onclick="javascript: return ConfirmDelete()">
	    </td>
    </table>
<table border=0 bgcolor="#DFDEDF" width=100% >
    <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Tasklist edition for  <?php echo $myrow[10]?> </b></center></td>
    </tr>
   <table width=100% border=0 cellpadding=2 cellspacing=1 bgcolor="#DFDEDF" >
  <input type="hidden" name="taskdate">
  <input type="hidden" name="tasklistrecnum" value="<?php echo $tasklistrecnum ?>">
       <tr bgcolor="#FFFFFF">
           	<td bgcolor="#EEEFEE"><span class="labeltext"><p align="center">Time</p></font></td>
            <td bgcolor="#EEEFEE"><span class="labeltext"><p align="left">Tasks</p></font></td>
         </tr>

         <tr bgcolor="#FFFFFF">
           	<td bgcolor="#EEEFEE"><span class="labeltext"><p align="center">10.00</p></font></td>
            <td><input type="text" name="task1" size=50 value="<?php echo $myrow[2]?>"></td>
         </tr>

       <tr bgcolor="#FFFFFF">
           	<td bgcolor="#EEEFEE"><span class="labeltext"><p align="center">11.00</p></font></td>
            <td><input type="text" name="task2" size=50 value="<?php echo $myrow[3]?>"></td>
        </tr>

		 <tr bgcolor="#FFFFFF">
           	<td bgcolor="#EEEFEE"><span class="labeltext"><p align="center">12.00</p></font></td>
            <td><input type="text" name="task3" size=50 value="<?php echo $myrow[4]?>"></td>
         </tr>

 	    <tr bgcolor="#FFFFFF">
           <td bgcolor="#EEEFEE"><span class="labeltext"><p align="center">13.00</p></font></td>
           <td><input type="text" name="task4" size=50 value="<?php echo $myrow[5]?>"></td>
        </tr>

 		<tr bgcolor="#FFFFFF">
           	<td bgcolor="#EEEFEE"><span class="labeltext"><p align="center">14.00</p></font></td>
            <td><input type="text" name="task5" size=50 value="<?php echo $myrow[6]?>"></td>
           </tr>

        <tr bgcolor="#FFFFFF">
           	<td bgcolor="#EEEFEE"><span class="labeltext"><p align="center">15.00</p></font></td>
            <td><input type="text" name="task6" size=50 value="<?php echo $myrow[7]?>"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
           	<td bgcolor="#EEEFEE"><span class="labeltext"><p align="center">16.00</p></font></td>
            <td><input type="text" name="task7" size=50 value="<?php echo $myrow[8]?>"></td>
           </tr>

        <tr bgcolor="#FFFFFF">
           	<td bgcolor="#EEEFEE"><span class="labeltext"><p align="center">17.00</p></font></td>
            <td><input type="text" name="task8" size=50 value="<?php echo $myrow[9]?>"></td>
        </tr>
       <input type="hidden" name="deleteflag" value="">
    </td>
</tr>
   </table>
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
        <input type="hidden" name="leadsrecnum" value="<?php echo $leadsrecnum; ?>">
        <span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit">
                    <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">
 </FORM>
</table>
</body>
</html>