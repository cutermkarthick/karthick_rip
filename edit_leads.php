<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2006                =
// Filename: edit_leads.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows editing of leads                     =
//==============================================
 session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

if (!isset($_SESSION['userrole']))
{
     header ( "Location: login.php" );
}

if (isset($_REQUEST['leadsrecnum']))
{
	$leadsrecnum=$_REQUEST['leadsrecnum'];
  }
else
{
          header ( "Location: login.php" );
}
$_SESSION['pagename'] = 'editleads';
$page = "CRM: Leads";
$dept = $_SESSION['department'];

//session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/displayClass.php');
include('classes/leadsClass.php');

$newLead = new leads;
$newdisplay = new display;
$result = $newLead->getLead($leadsrecnum);
$myrow = mysql_fetch_assoc($result)
//$myrow = mysql_fetch_row($result);

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/leads.js"></script>

<html>
<head>
<title>Edit Lead</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processleads.php' method='post' >
<?php
	include('header.html');
?>
<td bgcolor="#FFFFFF">
		<table width=100% border=0 cellpadding=3 cellspacing=0 class="stdtable1"  >
		<tr><td>
	<table width=100% border=0>
        <td><span class="pageheading"><b>Edit Leads</b></td>
           
	       <!-- <td bgcolor="#FFFFFF" align="right"><input type= "image" name="Delete" src="images/bu-delete.gif" value="Get" onclick="javascript: return ConfirmDelete()">
	    </td> -->
    </table>

<table border=0 bgcolor="#DFDEDF" width=100% >
            <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
           </tr>
   <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

	<tr bgcolor="#FFFFFF" width=100%>
        <td><span class="labeltext"><p align="left">Lead Name</p></font></td>
        <td><input type="text" name="name" size=30 value="<?php echo $myrow["name"]?>"></td>
        <td ><span class="labeltext"><p align="left">Company</p></font></td>
        <td><input type="text" name="company" size=30 value="<?php echo $myrow["company"]?>"></td>
	</tr>
	<!--<tr bgcolor="#FFFFFF" width=100%>
         <td><span class="labeltext"><p align="left">Lead#</p></font></td>
        <td><input type="text" name="leadsnum" size=30 value="<?php echo $myrow["leadsnum"]?>"></td> 
        <td><span class="labeltext"><p align="left">Opportunity#</p></font></td>
        <td  colspan=3><input type="text" name="oppnum" size=30 value="<?php echo $myrow["leadsnum"]?>"></td>
	</tr>-->
	<tr bgcolor="#FFFFFF" width=100%>
        <td><span class="labeltext"><p align="left">Lead Source</p></font></td>
        <td><span class="labeltext"><input type="text" name="source" size="15" value="<?php echo $myrow["source"] ?>">
                <span class="tabletext"><select name="source1" size="1" width="100" onchange="onSelectsource()">
             	    <option selected>Cold Call  </option>
             	    <option value>Existing customer</option>
            	    <option value>Self Generated </option>
            	    <option value>Employee</option>
            	    <option value>Partner </option>
                	<option value>PR/Quote</option>
            		<option value>Direct Mail</option>
            		<option value>Conference</option>
            		<option value>Trade Show</option>
            		<option value>Web Site</option>
            		<option value>Email</option>
            		<option value>Word of Month</option>
            		<option value>Other</option>
           		 </select>
            <td ><span class="labeltext"><p align="left">Title</p></font></td>
            <td><input type="text" name="title" size=30 value="<?php echo $myrow["title"]?>"></td>
		  </tr>
 			<tr bgcolor="#FFFFFF">
           		<td><span class="labeltext"><p align="left">Email</p></font></td>
            	<td><input type="text" name="email" id="email" size=30 value="<?php echo $myrow["email"]?>"></td>
                <td><span class="labeltext"><p align="left"> Phone</p></font></td>
            	<td><input type="text" name="phone" size=30 value="<?php echo $myrow["phone"]?>"></td>
           </tr>
           </tr>
 		<tr bgcolor="#FFFFFF">
           		<td><span class="labeltext"><p align="left">Industry Segment</p></font></td>
            	<td><input type="text" name="industry_segment" size=30 value="<?php echo $myrow["industry_segment"]?>"></td>
                <td><span class="labeltext"><p align="left"> Product Interest</p></font></td>
            	<td><input type="text" name="product_interest" size=30 value="<?php echo $myrow["product_interest"]?>"></td>
         </tr>
         <tr bgcolor="#FFFFFF" >
         <td><span class="labeltext"><p align="left">Converted to Contact</p></font></td>
         <td><span class="labeltext"><input type="text" name="convert2contact" size="15" value="<?php echo $myrow["convert2contact"] ?>">
                <span class="tabletext"><select name="convert2contact1" size="1" width="100" onchange="onSelectconvert2contact()">
             	    <option selected>No </option>
            		<option value>Yes</option>
           		 </select>
                </td>

                <td><span class="labeltext"><p align="left">Stage</p></font></td>
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
              <OPTION value='Convert to Opportunity|90'>Convert to Opportunity</OPTION>
</select>
              </td>
              <input type="hidden" name="stagenum" id="stagenum" value="<?php echo $myrow['stage_num'] ?>">
          </tr>

      <tr bgcolor="#FFFFFF" width=100%>
        <td><span class="labeltext"><p align="left">Contacted Date</p></font></td>
        <td><input type="text" name="contacted_date" size=30 readonly="readonly" style="background-color:#DDDDDD;" value="<?php echo $myrow["contacted_date"]?>"></td>
        <td ><span class="labeltext"><p align="left">Meeting date</p></font></td>
        <td><input type="text" name="meeting_date" size=30 readonly="readonly" style="background-color:#DDDDDD;" value="<?php echo $myrow["meeting_date"]?>"></td>
  </tr>

            <tr bgcolor="#FFFFFF" >
         <td><span class="labeltext"><p align="left">Percentage</p></font></td>
         <td colspan=6><span class="labeltext"><input type="text" name="percent" id="percent" size="15" value="<?php echo $myrow["percent"] ?>" readonly="readonly" style="background-color:#DDDDDD;">
                <span class="tabletext"><select name="percent_val" id="percent_val" onchange="Getpercent()">
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
          </tr>

          <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Address</b></center></td></tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Address 1</p></font></td>
            <td><input type="text" name="addr1" size=30 value="<?php echo $myrow["addr1"] ?>"</td>
            <td><span class="labeltext"><p align="left">Address2</p></font></td>
            <td><input type="text" name="addr2" size=30 value="<?php echo $myrow["addr2"] ?>"</td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">City</p></font></td>
            <td><input type="text" name="city" size=30 value="<?php echo $myrow["city"] ?>"</td>
            <td><span class="labeltext"><p align="left">State</p></font></td>
            <td><input type="text" name="state" size=30 value="<?php echo $myrow["state"] ?>"</td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Zip</p></font></td>
            <td><input type="text" name="zip" size=30 value="<?php echo $myrow["zip"] ?>"</td>
            <td><span class="labeltext"><p align="left">Country</p></font></td>
            <td><input type="text" name="country" size=30 value="<?php echo $myrow["country"] ?>"</td>
        </tr>

 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
   <tr bgcolor="#FFFFFF">
  <td colspan=3><span class="labeltext"><p align="left">Primary</p></font></td>

 <?php
    if($myrow["primary_lead"] =='Yes'){
     ?>
     <td colspan=3><span class="labeltext">Yes<input type="radio" name="primary_lead" value="<?php echo $myrow["primary_lead"]?>" checked>
     <span class="labeltext">No<input type="radio" name="primary_lead" value="No"
     <input type="hidden" name="primary_lead" >
     </td>
 <?php }
    else if($myrow["primary_lead"] =='No'){
      ?>
      <td colspan=3><span class="labeltext">No<input type="radio" name="primary_lead" value="<?php echo $myrow["primary_lead"]?>" checked>
      <span class="labeltext">Yes<input type="radio" name="primary_lead" value="Yes"
      <input type="hidden" name="primary_lead">
     </td>
 <?php }
    else {
       ?>
           <td><span class="labeltext">Yes<input type="radio" name="primary_lead" value="Yes"
           <td><span class="labeltext">No<input type="radio" name="primary_lead" value="No"
           </td>
 <?php }
    ?>
    </td>
</tr>
          <input type="hidden" name="deleteflag" value="">
          <input type="hidden" name="contacted_date" value="<?php echo $myrow['contacted_date'] ?>">
          <input type="hidden" name="meeting_date" value="<?php echo $myrow['meeting_date'] ?>">
   </table>
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

        <input type="hidden" name="leadsrecnum" value="<?php echo $leadsrecnum; ?>">
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