<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = April 03, 2007               =
// Filename: new_enquiry.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of enquiries                   =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: ../login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$_SESSION['pagename'] = 'newenquiry';
$page = "CRM: Enquiry";
//session_register('pagename');

// First include the class definition
include('classes/loginClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$date = date('Y-m-d');
?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="../scripts/mouseover.js"></script>
<script language="javascript" src="scripts/enquiry.js"></script>



<html>
<head>
<title>Enquiry Stage</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');
?>
<table width=100% border=0 cellpadding=6 cellspacing=0  >
 <!-- <tr>
  <td><span class="pageheading"><b>Enquiry Form</b></td>
  </tr>
 -->

<form action='processEnquiry.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Enquiry Details</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
            <td><span class="tabletext"><input type="text" name="name" size=30 style="background-color:#DDDDDD" readonly="readonly" value=""><img src="images/bu-getcustomer.gif" alt="Get Customer" onclick="GetAllCustomers()">
            <input type="hidden" name="companyrecnum" id="companyrecnum" value="">
            </td>

            <td><span class="labeltext"><p align="left">ID</p></font></td>
            <td><span class="tabletext"><input type="text" name="cust_id" id="cust_id" size=30 value=""></td>
        </tr>

        <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Number</p></font></td>
            <td><span class="tabletext"><input type="text" name="partnum" size=30 style="background-color:#DDDDDD" readonly="readonly" value=""><img src="images/bu-getcustomer.gif" alt="Get Customer" onclick="getallpartnum()"></td>
            <td><span class="labeltext"><p align="left">Part Description</p></font></td>
            <td><span class="tabletext"><input type="text" name="partdesc" size=30 value=""></td>
           

        </tr>
        
        <tr bgcolor="#FFFFFF">
<!--             <td><span class="labeltext"><p align="left">Date</p></font></td>
            <td><span class="tabletext"><input type="text" name="enq_date" id="enq_date" size=20 value="" readonly="readonly" style="background-color:#DDDDDD;">
            <img src="images/bu-getdate.gif" alt="Get Enq Date" onclick="GetDate('enq_date')"></td> -->
             <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RT Quotation<br> No</p></font></td>
            <td><span class="tabletext"><input type="text" name="rtquot_no" size=30 value=""></td>
            <td><span class="labeltext"><p align="left">RT Quotation<br>
             Date</p></font></td>
            <td><span class="tabletext"><input type="text" name="rtquot_date" id="rtquot_date" size=20 value="" readonly="readonly" style="background-color:#DDDDDD;">
                                 <img src="images/bu-getdate.gif" alt="Get rtquot_date" onclick="GetDate('rtquot_date')"></td>
        </tr>

         <tr bgcolor="#FFFFFF">
           
            <td><span class="labeltext">Risk Involved</font></td>
            <td colspan="3"><span class="tabletext"><input type="text" name="risk_involv" size=50% value=""></td>

        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Risk Details</td>
            <td colspan="3"><textarea id="risk_details" name="risk_details" rows="3" style=";background-color:#FFFFF;" cols="45" value=""></textarea></td>
            </tr>

          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Status</font></td>
            <td><span class="tabletext"><input type="text" name="status" id="status" size=20 style="background-color:#DDDDDD"  readonly="readonly" value="">
            <select name="status_val" id="status_val" onchange="selectstatus()">
            <option value="select">Please Speicfy</option>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
            </select>
            </td>

            <td><span class="labeltext">Qty</font></td>
            <td><span class="tabletext"><input type="text" name="qty" size=30 value=""></td>
        </tr> 


        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Created By</font></td>
            <td><span class="tabletext"><input type="text" name="created_by" id="created_by" size=20 style="background-color:#DDDDDD"  readonly="readonly" value="<?php echo $userid?>">
            </td>
           <td><span class="labeltext">Created Date</font></td>
            <td><span class="tabletext"><input type="text" name="crdate" id="crdate" size=20 style="background-color:#DDDDDD"  readonly="readonly" value="<?php echo $date?>">
            </td>
        </tr> 


        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Approved</font></td>
            <td><span class="tabletext"><input type="checkbox"  name="chk1"  onclick="JavaScript:toggleValue('approval',chk1,'<?php echo $date ?>','<?php echo $userid?>');">
            <input type="hidden" name="approval" value="" id="approval">
            <input type="hidden" name="approved_by" value="" id="approved_by">
            </td>
           <td><span class="labeltext">Approved Date</font></td>
            <td><span class="tabletext"><input type="text" name="app_date" id="app_date" size=20 style="background-color:#DDDDDD"  readonly="readonly" value="">
            </td>
        </tr> 

                <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Remarks</td>
            <td colspan="3"><textarea id="remarks" name="remarks" rows="3" style=";background-color:#FFFFF;" cols="45" value=""></textarea></td>
            </tr>
		</table>

<span class="labeltext"><input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()">

      </FORM>
</table>
</body>
</html>
