<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = april 03, 2007               =
// Filename: enquiryDetails.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Enquiry Details                             =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: ../login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'enquiryDetails';
$page = "CRM: Enquiry";
//session_register('pagename');

// First include the class definition

include('classes/enquiryClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newenquiry = new enquiry;
$newdisplay = new display;

$enquiryrecnum = $_REQUEST['enquiryrecnum'];
// echo $enquiryrecnum;exit;
$result = $newenquiry->getenquiry($enquiryrecnum);
$myrow = mysql_fetch_assoc($result);

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/enquiry.js"></script>

<html>
<head>
<title>Enquiry Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
<td><span class="pageheading"><b>Enquiry Details</b><td colspan=250></td>
    <td bgcolor="#FFFFFF" rowspan=2 align="right">

        <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;" onClick="location.href='edit_enquiry.php?enquiryrecnum=<?php echo $enquiryrecnum ?>'" value="Edit Enquiry" >
          <!-- <a href ="edit_enquiry.php?enquiryrecnum=<?php echo $enquiryrecnum ?>" ><img name="Image8" border="0" src="images/bu_editenquiry.gif" ></a> -->
          <input type= "button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;" value="Print" onclick="javascript: printenquiryDetails(<?php echo $enquiryrecnum ?>)">
</td>
  </tr>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>


 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">


<?php

if ($myrow['enq_date'] != '0000-00-00') 
{
            $d=substr($myrow['enq_date'],8,2);
            $m=substr($myrow['enq_date'],5,2);
            $y=substr($myrow['enq_date'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $enq_date=date("M j, Y",$x);
}
else {
          $enq_date = '';
}
if ($myrow['rtquot_date'] != '0000-00-00') 
{
            $d=substr($myrow['rtquot_date'],8,2);
            $m=substr($myrow['rtquot_date'],5,2);
            $y=substr($myrow['rtquot_date'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $rtquot_date=date("M j, Y",$x);
}
else {
          $rtquot_date = '';
}

?>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Enquiry Details</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext">Customer</td>
            <td width=25%><span class="tabletext"><?php echo $myrow["name"] ?></td>
            <td width=25%><span class="labeltext">ID</td>
            <td width=25%><span class="tabletext"><?php echo $myrow["id"] ?></td>
         </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Partnum</font></td>
            <td><span class="tabletext"><?php echo $myrow["partnum"] ?></td>
            <td><span class="labeltext">Part Description</td>
            <td><span class="tabletext"><?php echo $myrow["partdesc"] ?></td>
         </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">RT Quotation No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['rtquot_no'] ?></td>
            <td><span class="labeltext">RT Quotation Date</p></font></td>
            <td><span class="tabletext"><?php echo $rtquot_date ?></td>
        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Risk Involved</td>
            <td colspan="3"><span class="tabletext"><?php echo $myrow["risk_involv"] ?></td>
            
        </tr>
        <tr bgcolor="#FFFFFF">

        <td><span class="labeltext">Risk Details</font></td>
            <td colspan="3"><textarea style="background-color:#DDDDDD;"  readonly="readonly" rows=2 cols=30><?php echo $myrow["risk_details"] ?></textarea></td>
            
        </tr>
  
           <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Status</td>
            <td><span class="tabletext"><?php echo $myrow["status"] ?></td>
            <td><span class="labeltext">Qty</font></td>
            <td><span class="tabletext"><?php echo $myrow["qty"] ?></td>
         </tr>

             <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Created By</td>
            <td><span class="tabletext"><?php echo $myrow["created_by"] ?></td>
            <td><span class="labeltext">Created Date</font></td>
            <td><span class="tabletext"><?php echo $myrow["created_date"] ?></td>
         </tr>


             <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Approved By</td>
            <td><span class="tabletext"><?php echo $myrow["approved_by"] ?></td>
            <td><span class="labeltext">Approved Date</font></td>
            <td><span class="tabletext"><?php echo $myrow["approved_date"] ?></td>
         </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Remarks</td>
            <td><textarea style="background-color:#DDDDDD;"  readonly="readonly" rows=2 cols=30><?php echo $myrow["remarks"] ?></textarea></td>
            <td colspan="2"></td>
            
        </tr>


        
</table>
<table border=3 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
            <td colspan=2><span class="labeltext"><?php echo $myrow["formrev"] ?></td>
            <td colspan=2><span class="labeltext">FLUENTERP</td>
        </tr>
 
</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

</tr>

</table>

 </td>

		</table>
      </FORM>
</table>
</body>
</html>
