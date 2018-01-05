<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 21, 2007                 =
// Filename: printqualityplanDetails.php       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// print Quality Plan Details                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'mdmdetails';
//////session_register('pagename');

// First include the class definition

include('classes/mdmclass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newmdm = new mdm;
$newdisplay = new display;

$mdmrecnum = $_REQUEST['mdmrecnum'];


$result = $newmdm->getmdm($mdmrecnum);
$myrow = mysql_fetch_row($result);


?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>

<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">MDM</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>MDM</b></center></td></tr>

 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
  <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">CIM Ref Num.</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow[1] ?></td>
            <td width=25%><span class="labeltext"><p align="left">Part No.</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow[2] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[3] ?></td>
            <td><span class="labeltext"><p align="left">DRG Issue</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[4] ?>
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Attachments</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[5] ?></td>
            <td><span class="labeltext"><p align="left">Raw Material Type</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[9] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Raw Material Spec</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[10] ?></td>
            <td><span class="labeltext"><p align="left">Maching Cycle Time</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[11] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Fitting Cycle Time</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[12] ?></td>
            <td><span class="labeltext"><p align="left">Inopectun Cycle Time</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[13] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Type</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[14] ?></td>
            <td><span class="labeltext"><p align="left">Customer</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[15] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Project</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[16] ?></td>
        </tr>

<?php
 //echo "quotetype:$quotetype";
//$wotype="test2";
// $ctrls=$newpage->createjs4quote("Quote",$quotetype) ;
 //$ctrls=$newpage->createctrls("Quote",$quotetype) ;
//echo "$ctrls";
?>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Unit RM Size</b></center></td>
</tr>

<!--<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>-->
<tr bgcolor="#FFFFFF">


<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim1</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim2</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim3</center></b></td>
</tr>
<tr>
   <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[6] ?></td>
   <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[7] ?></td>
   <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[8] ?></td>
</tr>


</table>

</body>
</html>
