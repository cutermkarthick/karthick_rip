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
include('classes/standardclass.php');

$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'standards';
//////session_register('pagename');
$newlogin = new userlogin;
$newlogin->dbconnect();
$newdisplay = new display;
$newstd = new standard;

?>
<script language="javascript" src="scripts/mouseover.js"></script>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>Standards</title>
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
        <td><span class="pageheading"><b>New Standard</b></td>
    </tr>


     <form action='processstandard.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Standard Header</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Name</p></font></td>
            <td><span class="tabletext"><input type="text" name="name" size=20 value=""></td>
            <td><span class="labeltext"><p align="left">Description</p></font></td>
            <td><input type="text" name="description" size=40 value=""></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Upload</p></font></td>
            <td colspan=3><input type="file" name="file" size=20 value=""></td>
        </tr>


<input type="hidden" name="action" value="new">
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
 <div style="overflow: scroll; width: 100%; height: 150px;">
 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>List of Standards</b></center></td>
        </tr>
     <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
      <tr>
	    <td width=7% bgcolor="#EEEFEE"><span class="heading"><b>Seq #</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Name</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>Description</b></td>
        <td bgcolor="#EEEFEE"><span class="heading"><b>File Name</b></td>
      </tr>

<?php

     $result = $newstd->getstandards();

            while ($myrow = mysql_fetch_row($result)) {
           /*   $d=substr($myrow[5],8,2);
              $m=substr($myrow[5],5,2);
              $y=substr($myrow[5],0,4);
              $x=mktime(0,0,0,$m,$d,$y);
              $date=date("M j, Y",$x);    */

   	       printf('<tr bgcolor="#FFFFFF"><td><span class="tabletext">
                           <a href="edit_standards.php?standardsrecnum=%s">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext"><a href="wms/%s">%s</a></td>
                          ',
		                 $myrow[0],$myrow[0],$myrow[1],
                         $myrow[2],
                         '../standards/' . $myrow[3],$myrow[3]);
           printf('</td></tr>');

        }

?>

    </td>
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
