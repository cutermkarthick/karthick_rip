<?php
//
//==============================================
// Author: FSI                                 
// Date-written = Aug 9, 2008              
// Filename: verifycustpo.php           
// Copyright of Badari Mandyam, FluentSoft     
// Revision: v1.0 OMS                          
// Allows verification of Cust PO with Order Stage   
//==============================================

session_start();
header("Cache-control: private");
/*
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
*/
$_SESSION['pagename'] = 'verifypohdr';
//////session_register('pagename');

// First include the class definition
include('classes/custpoverifyClass.php');
include('classes/displayClass.php');
$newCustpoverify= new custpoverify;
$newdisplay = new display;
if (isset($_REQUEST['ponum']))
{
    $ponum = $_REQUEST['ponum'];
}
else {
    $ponum="";
}
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>

<html>
<head>
<title>Verify Cust PO</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='verifypohdr.php' method='post' enctype='multipart/form-data'>
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
<tr>
<td>
<?php
   $newdisplay->dispLinks('');

?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr><td>
<table width=100% border=0>
<tr>
<td><span class="pageheading"><b>Verification Cust PO</b></td>
</tr>
</table>
</td></tr>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Order Stage vs Cust PO</b></center></td></tr>
<tr bgcolor="#FFFFFF"  >
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<tr bgcolor="#FFFFFF">
    <td><span class="labeltext"><p align="left">PO #</p></font></td>
    <td><input type="text" name="ponum" size=20 value="<?php echo $ponum ?>"></td>
</tr>
</table>
<table>

<?php
  if ($ponum != '') 
  {

  
?>
<table>
<tr bgcolor="#DDDEDD">
<td><span class="heading"><center><b>Order Stage Header</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b><center>Amendment Num</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Amendment Date</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Special Instrns</center></b></td>

</tr>
<?php

  $myrevhdr = $newCustpoverify->revhdr($ponum);
  while ($revhdr = mysql_fetch_row($myrevhdr))
  {
	printf('<tr bgcolor="#FFFFFF">');
        echo "<td align=\"center\"><span class=\"tabletext\">$revhdr[0]</td>";
        echo "<td align=\"center\"><span class=\"tabletext\">$revhdr[1]</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$revhdr[2]</td>";

	printf('</tr>');
  }

?>
</table>

<table>
<tr bgcolor="#DDDEDD">
<td><span class="heading"><center><b>Cust PO Line Items</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b><center>Amendment Num</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Amendment Date</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Special Instrns</center></b></td>

</tr>
<?php

  $mysohdr = $newCustpoverify->sohdr($ponum);
  $myrevhdr = $newCustpoverify->revhdr($ponum);
  while (($sohdr = mysql_fetch_row($mysohdr)) && ($revhdr = mysql_fetch_row($myrevhdr)))
  {
	printf('<tr bgcolor="#FFFFFF">');
        if ($revhdr[0] != $sohdr[0])
        {
           echo "<td bgcolor=\"FF0000\" align=\"center\"><span class=\"tabletext\">$sohdr[0]</td>";
        }
        else {
           echo "<td align=\"center\"><span class=\"tabletext\">$sohdr[0]</td>"; 
        }
        if ($revhdr[1] != $sohdr[1])
        {
           echo "<td bgcolor=\"FF0000\" align=\"center\"><span class=\"tabletext\">$sohdr[1]</td>";
        }
        else {
           echo "<td align=\"center\"><span class=\"tabletext\">$sohdr[1]</td>"; 
        }
        if ($revhdr[2] != $sohdr[2])
        {
           echo "<td bgcolor=\"FF0000\" align=\"center\"><span class=\"tabletext\">$sohdr[2]</td>";
        }
        else {
           echo "<td align=\"center\"><span class=\"tabletext\">$sohdr[2]</td>"; 
        }
	printf('</tr>');
  }
}
?>
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
<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
<td align=left>
</td>
</tr>
</table>
<span class="tabletext"><input type="submit"
              style="color=#0066CC;background-color:#DDDDDD;width=130;"
              value="Submit" name="submit">
       <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">
</FORM>
</body>
</html>
