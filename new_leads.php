<?php
//==============================================
// Author: FSI                                 =
// Date-written = July 20, 2006                =
// Filename: new_leads.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new leads                   =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$_SESSION['pagename'] = 'newleads';
$page = "CRM: Leads";
//session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/companyClass.php');
include('classes/leadsClass.php');
include('classes/displayClass.php');
$newQuote = new leads;
$newdisplay = new display;
$newCustomer = new company;

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/leads.js"></script>

<html>
<head>
<title>New Lead</title>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0">
<form action='processleads.php' method='post' >
<?php
include('header.html');
?>

      <td bgcolor="#FFFFFF">

        <table width=100% border=0 cellpadding=6 cellspacing=0  >
     <tr>
        <td><span class="pageheading"><b> New Lead </b></td>
     </tr>
  <td>

<tr>
<td>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6 class="stdtable1">
   <tr bgcolor="#EEEFEE">
        <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
  </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF"  class="stdtable1">
       <tr bgcolor="#FFFFFF" colspan=3>
         <td><span class="labeltext"><p align="left">Lead Name</p></font></td>
         <td><span class="labeltext"><input type="text" name="name" size=30  value=""></td>
         <td><span class="labeltext"><p align="left">Company</font></td>
         <td><span class="labeltext"><input type="text" name="company" size=30  value=""></td>
       </tr>
     <!--   <tr bgcolor="#FFFFFF" colspan=3>
         <td><span class="labeltext"><p align="left">Leads#</p></font></td>
         <td><span class="labeltext"><input type="text" name="leadsnum" size=30  value=""></td>
         <td><span class="labeltext"><p align="left">Opportunity#</font></td>
         <td><span class="labeltext"><input type="text" name="oppnum" size=30  value=""></td>
       </tr> -->
       <tr bgcolor="#FFFFFF" width=100%>
         <td><span class="labeltext"><p align="left">Lead Source</p></font></td>
         <td><span class="labeltext"><span class="labeltext"><select name="source" size="1" width="100">
             	        <OPTION selected value=''>--None--</OPTION>
                        <OPTION value='Cold Call'>Cold Call</OPTION>
                        <OPTION value='Existing Customer'>Existing Customer</OPTION>
                        <OPTION value='Self Generated'>Self Generated</OPTION>
                        <OPTION value='Employee'>Employee</OPTION>
                        <OPTION value='Partner'>Partner</OPTION>
                        <OPTION value='Public Relations'>Public Relations</OPTION>
                        <OPTION value='Direct Mail'>Direct Mail</OPTION>
                        <OPTION value='Conference'>Conference</OPTION>
                        <OPTION value='Trade Show'>Trade Show</OPTION>
                        <OPTION value='Web Site'>Web Site</OPTION>
                        <OPTION value='Word of mouth'>Word of mouth</OPTION>
                        <OPTION value='Email'>Email</OPTION>
                        <OPTION value='Other'>Other</OPTION></select>
                   </td>

            <td ><span class="labeltext"><p align="left">Title</p></font></td>
            <td><span class="labeltext"><input type="text" name="title" id="title" size=30 value=""></td>
		</tr>
       <tr bgcolor="#FFFFFF" colspan=3>
         <td><span class="labeltext"><p align="left">Email</p></font></td>
         <td><span class="labeltext"><input type="text" name="email" 
         id="email" size=30  value=""></td>
         <td><span class="labeltext"><p align="left">Phone</font></td>
         <td><span class="labeltext"><input type="text" name="phone" size=30  value=""></td>
       </tr>
       <tr bgcolor="#FFFFFF" colspan=3>
         <td><span class="labeltext"><p align="left">Industry Segment</p></font></td>
         <td><span class="labeltext"><input type="text" name="industry_segment" size=30  value=""></td>
         <td><span class="labeltext"><p align="left">Product Interest</font></td>
         <td><span class="labeltext"><input type="text" name="product_interest" id="product_interest" size=30  value="" readonly="readonly" style="background-color:#DDDDDD;">
         <select name="product" id="product" onchange="Getproduct()">
<OPTION value='Select'>Select</OPTION>
<OPTION value='ERP'>ERP</OPTION>
<OPTION value='CRM'>CRM</OPTION>
<OPTION value='Mobile Apps'>Mobile Apps</OPTION>
<OPTION value='Custom App'>Custom App</OPTION>
</select>

        </td>

       </tr>
      <tr bgcolor="#FFFFFF" >
         <td><span class="labeltext"><p align="left">Converted to Contact</p></font></td>
         <td><span class="labeltext"><span class="labeltext"><select name="convert2contact" size="1" width="100">
                        <OPTION value='No'>No</OPTION>
                        <OPTION value='Yes'>Yes</OPTION></select>
                   </td>
<td><span class="labeltext"><p align="left">Percentage</p></font></td>
<td colspan=3><input type="text" name="percent" id="percent" readonly="readonly" style="background-color:#DDDDDD;" size=10%>
<select name="percent_val" id="percent_val" onchange="Getpercent()">
<OPTION value='Select'>Select</OPTION>
<OPTION value='0'>0</OPTION>
<OPTION value='10'>10</OPTION>
<OPTION value='20'>20</OPTION>
<OPTION value='30'>30</OPTION>
<OPTION value='40'>40</OPTION>
<OPTION value='50'>50</OPTION>
<OPTION value='60'>60</OPTION>
<OPTION value='70'>70</OPTION>
<OPTION value='80'>80</OPTION>
<OPTION value='90'>90</OPTION>
<OPTION value='100'>100</OPTION>
</select>

        </td>



</td>
</tr>
 <tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"><span class="asterisk">*</span> Stage</p></font></td>
         <td><span class="labeltext"><input type="text" name="stage"  id="stage" size="15" value="<?php echo $myrow["stage"] ?>" readonly="readonly" style="background-color:#DDDDDD;">
                <span class="tabletext"><select name="stage_val" id="stage_val" onchange="Getstage()">
              <OPTION value='Select'>Select</OPTION>
              <OPTION value='Not Contacted|10'>Not Contacted</OPTION>
              <OPTION value='First Email|20'>First Email</OPTION>
              <OPTION value='Subsequent Email|30'>Subsequent Email</OPTION>
              <OPTION value='Call|40'>Call</OPTION>
               <OPTION value='Unsubscribe|50'>Unsubscribe</OPTION>
               <OPTION value='Meeting|60'>Meeting</OPTION>
              <OPTION value='Interacted|70'>Interacted</OPTION>
              <OPTION value='Interest|80'>Interest</OPTION>
</select>
              </td>
              <input type="hidden" name="stagenum" id="stagenum" value="<?php echo $myrow['stage_num'] ?>">
          <td><span class="labeltext"><p align="left">Notes</p></font></td>
<td><textarea name="spec_instrns" id="spec_instrns" rows=2 cols=30 ></textarea>

</td>
</tr>

		</tr>
      <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Address</b></center></td></tr>
	    <tr bgcolor="#FFFFFF">
     	<td><span class="labeltext"><p align="left">Address1</p></font></td>
     	<td><span class="labeltext"><input type="text" name="addr1" size=30  value=""></td>
     	<td><span class="labeltext"><p align="left">Address2</p></font></td>
     	<td><span class="labeltext"><input type="text" name="addr2" size=30  value=""></td>
	</tr>
    <tr bgcolor="#FFFFFF">
       <td><span class="labeltext"><p align="left">City</p></font></td>
       <td><span class="labeltext"><input type="text" name="city" size=30  value=""></td>
       <td><span class="labeltext"><p align="left">State</p></font></td>
       <td><span class="labeltext"><input type="text" name="state" size=30  value=""></td>
    </tr>
    <tr bgcolor="#FFFFFF">
       <td><span class="labeltext"><p align="left">Zip</p></font></td>
       <td><span class="labeltext"><input type="text" name="zip" size=30  value=""></td>
       <td><span class="labeltext"><p align="left">Country</p></font></td>
       <td><span class="labeltext"><input type="text" name="country" size=30  value=""></td>
       </tr>



     <table width=100% border=0 cellpadding=2 cellspacing=2 bgcolor="#DFDEDF" class="stdtable1">
      <tr bgcolor="#FFFFFF">
           <td style='vertical-align: middle'><span class="labeltext"><p align="left">Primary</td>
           <td><span class="labeltext">Yes<input type="radio" name="primary_lead" value="Yes"
           <td><span class="labeltext">No<input type="radio" name="primary_lead" value="No">
           </td>
      </tr>
      </table>
      <input type="hidden" name="contacted_date" value="">
          <input type="hidden" name="meeting_date" value="">
</table>
</td>
<!-- 		<td width="6"><img src="images/spacer.gif " width="6"></td>
  	</tr>
		<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
		</tr> -->

		</table>

        <span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                    <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">
 </FORM>
</table>
</body>
</html>