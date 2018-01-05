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

//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/companyClass.php');
include('classes/quoteClass.php');
include('classes/quoteliClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');
include('classes/leadsClass.php');
$newpage = new page;
$newLead = new leads;
$newdisplay = new display;
$newCustomer = new company;

$result = $newLead->getLead($leadsrecnum);
$myrow = mysql_fetch_row($result);

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

<table width=100% cellspacing="0" cellpadding="0" border="0">
	<tr>
	  <td>

	<table width=100% border=0 cellpadding=0 cellspacing=0  >
   <tr><td></td></tr>
  <tr><td>

</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >


        <table width=100% border=0 cellpadding=0 cellspacing=0  >

  <td>

       <form action='lead_upload.php' method='post' enctype='multipart/form-data'>
<tr>
<td>

<table border=0 bgcolor="#DFDEDF" width=100% >
            <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Edit Leads details</b></center></td>
           </tr>
   <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr bgcolor="#FFFFFF" width=100%>
           	       <td><span class="labeltext"><p align="left">Lead Name</p></font></td>
            	  <td colspan=3><input type="text" name="name" size=25 value="<?php echo $myrow[2]?>">
                   </td>
                  <td ><span class="labeltext"><p align="left">Company</p></font></td>
            	  <td colspan=3><input type="text" name="company" size=25 value="<?php echo $myrow[6]?>">
                   </td>
		  </tr>
		  <tr bgcolor="#FFFFFF" width=100%>
                <td><span class="labeltext"><p align="left">Lead Source</p></font></td>
                <td colspan=3><span class="labeltext"><input type="text" name="source" size="15" value="<?php echo $myrow[1] ?>">
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
            			<td colspan=3><input type="text" name="title" size=25 value="<?php echo $myrow[3]?>">
                   </td>
		  </tr>
 			   <tr bgcolor="#FFFFFF">
           		  <td><span class="labeltext"><p align="left">Email</p></font></td>
            	      <td colspan=3><input type="text" name="email" size=25 value="<?php echo $myrow[5]?>">
                   </td>
                  <td><span class="labeltext"><p align="left"> Phone</p></font></td>
            	       <td colspan=3><input type="text" name="phone" size=25 value="<?php echo $myrow[4]?>">
                  </td>
           </tr>
           </tr>
 			   <tr bgcolor="#FFFFFF">
           		  <td><span class="labeltext"><p align="left">Industry Segment</p></font></td>
            	      <td colspan=3><input type="text" name="industry_segment" size=25 value="<?php echo $myrow[7]?>">
                   </td>
                  <td><span class="labeltext"><p align="left"> Product Interest</p></font></td>
            	       <td colspan=3><input type="text" name="product_interest" size=25 value="<?php echo $myrow[8]?>">
                  </td>
           </tr>

 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
   <tr bgcolor="#FFFFFF">
        <td colspan=3><span class="labeltext"><p align="left">Primary</p></font></td>


 <?php
    if($myrow[9] =='Yes'){
     ?>
     <td colspan=3><span class="labeltext">Yes<input type="radio" name="primary_lead" value="<?php echo $myrow[9]?>" checked>
     <span class="labeltext">No<input type="radio" name="primary_lead" value="No"
     <input type="hidden" name="primary_lead" >
     </td>
 <?php }
    else if($myrow[9] =='No'){
      ?>
      <td colspan=3><span class="labeltext">No<input type="radio" name="primary_lead" value="<?php echo $myrow[9]?>" checked>
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
   </table>
</table>
</td>


  </table>


        <input type="hidden" name="leadsrecnum" value="<?php echo $leadsrecnum; ?>">
        <span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                    <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">
 </FORM>


</body>
</html>