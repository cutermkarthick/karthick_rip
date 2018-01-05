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

$_SESSION['pagename'] = 'newleads';
//////session_register('pagename');

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
<script language="javascript" src="scripts/quote.js"></script>

<html>
<head>
<title>New Lead</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processleads.php' method='post' >
<?php
//include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="1" border="0">
	<tr>
	  <td>

	<table width=100% border=0 cellpadding=0 cellspacing=0  >

<?php //$newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

<table border=0 bgcolor="#DFDEDF" width=100% >
            <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
           </tr>
   <table width=100% border=0 cellpadding=0 cellspacing=1 bgcolor="#DFDEDF" >
       <tr bgcolor="#FFFFFF" width=100%>
           	       <td><span class="labeltext"><p align="left">Lead Name</p></font></td>
            			<td colspan=3><input type="text" name="name" size=25 value="">
                   </td>
                  <td ><span class="labeltext"><p align="left">Company</p></font></td>
            	  <td colspan=3><input type="text" name="company" size=25 value="">
                   </td>
		  </tr>


   		  <tr bgcolor="#FFFFFF" width=100%>

                   <td><span class="labeltext"><p align="left">Lead Source</p></font></td>
            	   <td colspan=3><span class="labeltext"><select name="source1" size="1" width="100">
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
            			<td colspan=3><input type="text" name="title1" size=25 value="">
                   </td>
		  </tr>
 			   <tr bgcolor="#FFFFFF">
           		  <td><span class="labeltext"><p align="left">Email</p></font></td>
            	      <td colspan=3><input type="text" name="email" size=25 value="">
                   </td>
                  <td><span class="labeltext"><p align="left"> Phone1</p></font></td>
            	       <td colspan=3><input type="text" name="phone" size=25 value="">
                  </td>
           </tr>
           </tr>
 			   <tr bgcolor="#FFFFFF">
           		  <td><span class="labeltext"><p align="left">Industry Segment</p></font></td>
            	      <td colspan=3><input type="text" name="industry_segment" size=25 value="">
                   </td>
                  <td><span class="labeltext"><p align="left"> Product Interest</p></font></td>
            	       <td colspan=3><input type="text" name="product_interest" size=25 value="">
                  </td>
           </tr>


 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

      <tr bgcolor="#FFFFFF">
           <td style='vertical-align: middle'><span class="labeltext"><p align="left">Primary</td>
           <td><span class="labeltext">Yes<input type="radio" name="primary_lead" value="Yes"
           <td><span class="labeltext">No<input type="radio" name="primary_lead" value="No"
           </td>
      </tr>

   </table>
</table>

</td>



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