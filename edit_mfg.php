<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 18,05                   =
// Filename: edit_mfg.php                      =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'edit_mfg';
//////session_register('pagename');

$userid = $_SESSION['user'];
$mfgrecnum=$_SESSION['mfgrecnum'];
//$add =$_REQUEST['submit'];
$i=0;
$max=0;
$cond = "c.name like '%'";
$worec='';

if ( isset ( $_REQUEST['scomp'] ) )
{
     $company_match = $_REQUEST['scomp'];
     if ( isset ( $_REQUEST['company_oper'] ) ) {
          $oper = $_REQUEST['company_oper'];
     }
     else {
         $oper = 'like';
     }
     if ($oper == 'like') {
         $scomp = "'" . $_REQUEST['scomp'] . "%" . "'";
     }
     else {
         $scomp = "'" . $_REQUEST['scomp'] . "'";
     }

     $cond = "c.name " . $oper . " " . $scomp;

}
else {
     $company_match = '';
}
$sort1='wo';
$sort2='wo';
if ( isset ( $_REQUEST['sortfld1'] ) ) {

    $sort1 = $_REQUEST['sortfld1'];
}
if ( isset ( $_REQUEST['sortfld2'] ) ) {
    $sort2 = $_REQUEST['sortfld2'];
}
// First include the class definition

include_once('classes/userClass.php');
include_once('classes/loginClass.php');
include('classes/mfgClass.php');
include('classes/displayclass.php');
$newlogin = new userlogin;
$newlogin->dbconnect();
$username = $_SESSION['user'];
$newmfg = new mfg;
$newdisplay = new display;
// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage = 1;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
    $pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
    $totpages = $_REQUEST['totpages'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mfg.js"></script>

<html>
<head>
<title>Edit MFG Order</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processmfg.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
      $userrole = $_SESSION['userrole'];
      $userid = $_SESSION['user'];
      $usertype = $_SESSION['usertype'];

?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td></td></tr>
<tr>
<td>
<?php $newdisplay->dispLinks('');
$result = $newmfg ->getmfg($mfgrecnum);
$myrow=mysql_fetch_assoc($result);
 ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <td><span class="pageheading"><b>Edit MFG Order</b></td>
    <td colspan=20>&nbsp;</td>
	<td bgcolor="#FFFFFF" align="right"><input type= "image" name="Delete" src="images/bu-delete.gif" value="Get" onclick="javascript: return ConfirmDelete()"></td>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD">
    <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr>

<tr bgcolor="#FFFFFF" width=100%>
    <td><span class="labeltext"><p align="left">*Mfg ID #</p></td>
    <td ><input type="text" size=30  name="mfg_id" value="<?php echo $myrow["mfg_id"] ?>"></td>
    <td><span class="labeltext"><p align="left">*Order Date</p></font></td>
    <td ><input type="text" name="orderdate" style="background-color:#DDDDDD;"
		 readonly="readonly" size=25 value="<?php echo $myrow["orderdate"] ?>">
         <img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDate('orderdate')"></td>
</tr>

<tr bgcolor="#FFFFFF">
    <td><span class="labeltext"><p align="left">Mfg Desc</p></font></td>
    <td colspan=3><input type="text" size=60 name="desc" value="<?php echo $myrow["mfg_desc"] ?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
    <td><span class="labeltext"><p align="left">Company</p></font></td>
    <td colspan=3><input type="text" name="company" style=";background-color:#DDDDDD;"
         readonly="readonly" size=25 value="<?php echo $myrow["name"] ?>">
        <img src="images/bu-getcustomer.gif" alt="Get Customer" onclick="GetAllCustomers()"></td>
	    <input type="hidden" name="companyrecnum" value="<?php echo $myrow["link2company"] ?>"></td>
</tr>
<tr bgcolor="#DDDEDD">
    <td colspan=4><span class="heading"><center><b>*Contact Information</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
    <td><span class="labeltext"><p align="left">Contact</p></font></td>
    <td colspan=3><input type="text" name="contact" style="background-color:#DDDDDD;"
        readonly="readonly" size=25 value="<?php echo $myrow["fname"].' '.$myrow["lname"]?>">
        <img src="images/bu-getcontact.gif" alt="Get COntact" onclick="GetContact()">
	    <input type="hidden" name="contactrecnum"  value="<?php echo $myrow["link2company"] ?>"></td>
</tr>
<tr bgcolor="#FFFFFF">
    <td><span class="labeltext"><p align="left">Phone</p></font></td>
    <td><input type="text" name="phone" style="background-color:#DDDDDD;"
        readonly="readonly" size=20 value="<?php echo $myrow["phone"] ?>"></td>
    <td><span class="labeltext"><p align="left">Email</p></font></td>
    <td><input type="text" name="email" style="background-color:#DDDDDD;"
        readonly="readonly" size=30 value="<?php echo $myrow["email"] ?>"></td>
</tr>
     <input type="hidden" name="deleteflag" value="">
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<tr>
    <td bgcolor="#EEEFEE"><span class="heading"><b>WO</b></td>
    <td bgcolor="#EEEFEE"><span class="heading"><b><center>Company</center></b></td>
    <td bgcolor="#EEEFEE"><span class="heading"><b><center>Designer</center></b></td>
    <td bgcolor="#EEEFEE"><span class="heading"><b><center>Type</center></b></td>
    <td bgcolor="#EEEFEE"><span class="heading"><b><center>Status</center></b></td>
    <td bgcolor="#EEEFEE"><span class="heading"><b><center>Sch Due Date(yymmdd)</center></b></td>
</tr>

<?php


            $result = $newmfg->getwo4mfg($mfgrecnum);
            $flag = 0;
        while ($myrow = mysql_fetch_assoc($result)) {
            if ($flag == 0)
 {
              	      printf('<tr><td  bgcolor="#FFFFFF"><span class="tabletext">%s</td>',
		        $myrow["wonum"]
                        );
              $flag = 1;
?>              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["name"] ?></td>
                <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["initials"] ?></td>
                <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["wotype"] ?></td>
                <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["status"] ?></td>
                <td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow["date_format(w.sch_due_date,'%y-%m-%d')"] != '00-00-00') echo $myrow["date_format(w.sch_due_date,'%y-%m-%d')"] ?></td>
        </tr>
<?php
        }

            else {
              	      printf('<tr><td  bgcolor="#FFFFFF"><span class="tabletext">%s</td>',
		        $myrow["wonum"]
                        );
                     $flag = 0;
?>
                <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["name"] ?></td>
                <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["initials"] ?></td>
                <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["wotype"] ?></td>
                <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow["status"] ?></td>
                <td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow["date_format(w.sch_due_date,'%y-%m-%d')"] != '00-00-00') echo $myrow["date_format(w.sch_due_date,'%y-%m-%d')"] ?></td>
        </tr>
<?php
        }
    }
?>

</table>
</div>

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

        <span class="tabletext">
        <input type="submit" style="color=#0066CC;background-color:#DDDDDD;width=130;"
              value="Submit" name="submit" onclick="javascript: return check_req_fields('')">
        <INPUT TYPE="RESET" style="color=#0066CC;background-color:#DDDDDD;width=130;"
               VALUE="Reset" onclick="javascript: putfocus()">
</FORM>
</body>
</html>



