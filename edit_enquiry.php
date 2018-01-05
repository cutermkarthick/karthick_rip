<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = april 03, 2007               =
// Filename: edit_enquiry.php                  =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Allows editing of enquiry  details          =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: ../login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'editenquiry';
$page = "CRM: Enquiry";
//session_register('pagename');

// First include the class definition
include('classes/enquiryClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newenquiry = new enquiry;
$newdisplay = new display;

$enquiryrecnum = $_REQUEST['enquiryrecnum'];

$result = $newenquiry->getenquiry($enquiryrecnum);
$myrow = mysql_fetch_assoc($result);

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/enquiry.js"></script>
<html>
<head>
<title>Edit Enquiry</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
    <form action='processEnquiry.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>

 <table width=100% border=0>
	<td width="100%"><span class="pageheading"><b>Edit Enquiry Deatils</b></td>
    <td colspan=20>&nbsp;</td>
	<td bgcolor="#FFFFFF" align="right"><input type= "image" name="Delete" src="images/bu-delete.gif" value="Get" onclick="javascript: return ConfirmDelete()">
	</td>
    </table>

  <tr>
<td>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6 class="stdtable1">

        <?php
         if($myrow['enq_date'] != '0000-00-00' && $myrow['enq_date'] != '')
         {
            $d=substr($myrow["enq_date"],8,2);
            $m=substr($myrow["enq_date"],5,2);
            $y=substr($myrow["enq_date"],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $enqdate=date("M j, Y",$x);
          }
          else
          {
            $enqdate ='';
          }

          if($myrow['rtquot_date'] != '0000-00-00' && $myrow['rtquot_date'] != '')
         {
            $d=substr($myrow["rtquot_date"],8,2);
            $m=substr($myrow["rtquot_date"],5,2);
            $y=substr($myrow["rtquot_date"],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $rtquotdate=date("M j, Y",$x);
          }
          else
          {
            $rtquotdate ='';
          }
          ?>


        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Enquiry Details</b></center></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
            <td><span class="tabletext"><input type="text" name="name" size=30 style="background-color:#DDDDDD" readonly="readonly" value="<?php echo $myrow['name']?>"><img src="images/bu-getcustomer.gif" alt="Get Customer" onclick="GetAllCustomers()">
            <input type="hidden" name="companyrecnum" id="companyrecnum" value="<?php echo $myrow['link2cust']?>">
            </td>

            <td><span class="labeltext"><p align="left">ID</p></font></td>
            <td><span class="tabletext"><input type="text" name="cust_id" id="cust_id" size=30 value="<?php echo $myrow['id']?>"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Number</p></font></td>
            <td><span class="tabletext"><input type="text" name="partnum" size=30 style="background-color:#DDDDDD" readonly="readonly" value="<?php echo $myrow['partnum']?>"><img src="images/bu-getcustomer.gif" alt="Get Customer" onclick="getallpartnum()"></td>
            <td><span class="labeltext"><p align="left">Part Description</p></font></td>
            <td><span class="tabletext"><input type="text" name="partdesc" size=30 value="<?php echo $myrow['partdesc']?>"></td>
           

        </tr>
        
        <tr bgcolor="#FFFFFF">
<!--             <td><span class="labeltext"><p align="left">Date</p></font></td>
            <td><span class="tabletext"><input type="text" name="enq_date" id="enq_date" size=20 value="" readonly="readonly" style="background-color:#DDDDDD;">
            <img src="images/bu-getdate.gif" alt="Get Enq Date" onclick="GetDate('enq_date')"></td> -->
             <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>RT Quotation<br> No</p></font></td>
            <td><span class="tabletext"><input type="text" name="rtquot_no" size=30 value="<?php echo $myrow['rtquot_no']?>"></td>
            <td><span class="labeltext"><p align="left">RT Quotation<br>Date</p></font></td>
            <td><span class="tabletext"><input type="text" name="rtquot_date" id="rtquot_date" size=20 value="<?php echo $myrow['rtquot_date']?>" readonly="readonly" style="background-color:#DDDDDD;">
            <img src="images/bu-getdate.gif" alt="Get rtquot_date" onclick="GetDate('rtquot_date')"></td>
        </tr>

         <tr bgcolor="#FFFFFF">
           
            <td><span class="labeltext">Risk Involved</font></td>
            <td colspan="3"><span class="tabletext"><input type="text" name="risk_involv" size=50% value="<?php echo $myrow['risk_involv']?>"></td>

        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Risk Details</td>
            <td colspan="3"><textarea id="risk_details" name="risk_details" rows="3" style=";background-color:#FFFFF;" cols="45"><?php echo $myrow['risk_details']?>"</textarea></td>
            </tr>

          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Status</font></td>
            <td><span class="tabletext"><input type="text" name="status" id="status" size=20 style="background-color:#DDDDDD"  readonly="readonly" value="<?php echo $myrow['status']?>">
            <select name="status_val" id="status_val" onchange="selectstatus()">
            <option value="select">Please Speicfy</option>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
            </select>
            </td>

            <td><span class="labeltext">Qty</font></td>
            <td><span class="tabletext"><input type="text" name="qty" size=30 value="<?php echo $myrow['qty']?>"></td>
        </tr> 


        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Created By</font></td>
            <td><span class="tabletext"><input type="text" name="created_by" id="created_by" size=20 style="background-color:#DDDDDD"  readonly="readonly" value="<?php echo $myrow['created_by']?>">
            </td>
           <td><span class="labeltext">Created Date</font></td>
            <td><span class="tabletext"><input type="text" name="crdate" id="crdate" size=20 style="background-color:#DDDDDD"  readonly="readonly" value="<?php echo $myrow['created_date']?>">
            </td>
        </tr> 
<tr bgcolor="#FFFFFF">
<?
   $date = date('Y-m-d');
if($myrow["approved"] == 'yes')
{
   $checked1="checked";

   ?>

    <td><span class="labeltext">Approved</font></td>
            <td><span class="tabletext"><input type="checkbox" <?php echo $checked1 ?> disabled name="chk1"  onclick="JavaScript:toggleValue('approval',chk1,'<?php echo $date ?>','<?php echo $userid?>');">
            <input type="hidden" name="approval" value="<?php echo $myrow['approved']?>" id="approval">
<?
}
else
{
?>
 <td><span class="labeltext">Approved</font></td>
            <td><span class="tabletext"><input type="checkbox" name="chk1"  onclick="JavaScript:toggleValue('approval',chk1,'<?php echo $date ?>','<?php echo $userid?>');">
            <input type="hidden" name="approval" value="<?php echo $myrow['approved']?>" id="approval">


<?
}
?>   
            <input type="hidden" name="approved_by" value="<?php echo $myrow['approved_by']?>" id="approved_by">
            </td>
           <td><span class="labeltext">Approved Date</font></td>
            <td><span class="tabletext"><input type="text" name="app_date" id="app_date" size=20 style="background-color:#DDDDDD"  readonly="readonly" value="<?php echo $myrow['approved_date']?>">
            </td>
        </tr> 

                <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Remarks</td>
            <td colspan="3"><textarea id="remarks" name="remarks" rows="3" style=";background-color:#FFFFF;" cols="45"><?php echo $myrow['remarks']?></textarea></td>
            </tr>


       
        
             <input type="hidden" name="enquiryrecnum" value="<?php echo $enquiryrecnum ?>">
             <input type="hidden" name="deleteflag" value="">

</table>
</table>

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
                     style="color=#0066CC;background-color:#DDDDDD;width=100;"
                     VALUE="Reset" onclick="javascript: putfocus()">

					</FORM>
		</body>
</html>
