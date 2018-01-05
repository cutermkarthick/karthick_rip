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

$_SESSION['pagename'] = 'newfeedback';
$page = "CRM: Cust Feedback";
//session_register('pagename');

// First include the class definition
include('classes/loginClass.php');


$newlogin = new userlogin;
$newlogin->dbconnect();

$parameters_arr =  array("ON TIME DELIVERY","PRODUCT QUALITY","REJECTION/REWORK","PACKING AND DISPATCH","COMMUNICATION WITH CUSTOMER","RESPONSE TO CUSTOMER REQUIREMENTS","ATTENDING CUSTOMER COMPLAINT","SERVICE QUALITY","LENDING A HELPING HAND DURING CRISIS TIME","OVERALL IMPRESSION WITH SN ENGINEERING");


?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="../scripts/mouseover.js"></script>
<script language="javascript" src="scripts/customer.js"></script>



<html>
<head>
<title>Customer</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');
?>
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<form action='processFeedback.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<tr bgcolor="#DDDEDD">
<td colspan=5><span class="heading"><center><b>CUSTOMER FEEDBACK REGISTER FORM</b></center></td></tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><span class='asterisk'>*</span>Customer</font></td>
            <td><span class="tabletext"><input type="text" name="name" size=30 value="<?php echo $userid ?>"></td>
            <td align="center"><span class="labeltext"><span class='labeltext'>MKT/F/08 ISSUE NO:01 REV NO:00</font></td>
            <td><span class="labeltext">DATE:<td><span class="tabletext"><input type="text" name="crdate" id="crdate" size=10% style="background-color:#DDDDDD" readonly="readonly" value=""><img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('crdate')"></td>
        </tr>
        </table>
        <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
        <tr bgcolor="#FFFFFF">
         <td colspan="2"><span class="labeltext1"><p align="left">Dear Sir,<br/>
            We are  very  much  thankful  to  you  for  having  placed  your  valuable  orders  on  us.Please  continue  to  place  your  valuable  orders  on  us. We  request  you  to  give  your   feed back  of  our  supplies  of  last  <input type="text" name="last_date" id="last_date" size=10% value="" readonly="readonly" style="background-color:#DDDDDD;">
            <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('last_date')">. Months ( From: <input type="text" name="fdate" id="fdate" size=10% value="" readonly="readonly" style="background-color:#DDDDDD;">
            <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('fdate')"> To:<input type="text" name="tdate" id="tdate" size=10% value="" readonly="readonly" style="background-color:#DDDDDD;">
            <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('tdate')"> ) by  answering  the  questionnaire, which will enable us to  improve our efficiency towards  the  Product  Quality,  Delivery,  Response  etc.</p></td>
        </tr>
</table>

 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >       
   <tr bgcolor="#FFFFFF">
            <td align="center"><span class="labeltext">Sl No.</span></font></td>
            <td><span class="labeltext">Parameters</span></font></td>
            <td><span class="labeltext">Ranking</span></font></td>
            <td><span class="labeltext">Remarks</span></font></td>
        </tr>

<?
$i=1;
 foreach ($parameters_arr as $value) 
 {

  $parameters ="parameters".$i;
  $ranking ="ranking".$i;
  $remarks ="remarks".$i;

   echo "<tr bgcolor=\"#FFFFFF\">";
   echo "<td align=\"center\"><span class=\"tabletext\">$i</span></font></td>";
   echo "<td><span class=\"tabletext\"><input type=\"hidden\" name=\"$parameters\" id=\"$parameters\" size=40 style=\"background-color:#DDDDDD\" readonly=\"readonly\" value=\"$value\">$value</span></td>";

  echo "<td ><span class=\"tabletext\"><select name=\"$ranking\" id=\"$ranking\">";

    for ($m=1; $m<=10; $m++)
    {
        
            echo "<option value=$m>$m</option>";
        
    }

  echo "</select>";

   // echo "<td align=\"center\"><span class=\"tabletext\"><input type=\"text\" name=\"$ranking\" id=\"$ranking\" size=10 value=''></span></font></td>";
   echo "<td><span class=\"tabletext\"><textarea id=\"$remarks\" name=\"$remarks\" rows=\"3\" cols=\"30\" value=''></textarea></span></font></td>";
    echo "</tr>";

$i++;
 }
 ?>

<input type="hidden" name="index" id="index" value="<?php echo $i?>">

<!-- 
 <tr bgcolor="#FFFFFF">
            <td><span class="tabletext">2.</span></font></td>
            <td><span class="tabletext">PRODUCT QUALITY</span></font></td>
            <td><span class="tabletext"><input type="text" name="ranking2" size=10 value=""></span></font></td>
            <td><span class="tabletext"><textarea id="remarks2" name="remarks2" rows="3" cols="30" value=""></textarea></span></font></td>
        </tr>


 <tr bgcolor="#FFFFFF">
            <td><span class="tabletext">3.</span></font></td>
            <td><span class="tabletext">REJECTION/REWORK</span></font></td>
            <td><span class="tabletext"><input type="text" name="ranking3" size=10 value=""></span></font></td>
            <td><span class="tabletext"><textarea id="remarks3" name="remarks3" rows="3" cols="30" value=""></textarea></span></font></td>
        </tr>


   <tr bgcolor="#FFFFFF">
            <td><span class="tabletext">4.</span></font></td>
            <td><span class="tabletext">PACKING AND DISPATCH</span></font></td>
            <td><span class="tabletext"><input type="text" name="ranking4" size=10 value=""></span></font></td>
            <td><span class="tabletext"><textarea id="remarks4" name="remarks4" rows="3" cols="30" value=""></textarea></span></font></td>
        </tr>


   <tr bgcolor="#FFFFFF">
            <td><span class="tabletext">5.</span></font></td>
            <td><span class="tabletext">COMMUNICATION WITH CUSTOMER
</span></font></td>
            <td><span class="tabletext"><input type="text" name="ranking5" size=10 value=""></span></font></td>
            <td><span class="tabletext"><textarea id="remarks5" name="remarks5" rows="3" cols="30" value=""></textarea></span></font></td>
        </tr>
   <tr bgcolor="#FFFFFF">
            <td><span class="tabletext">6.</span></font></td>
            <td><span class="tabletext">RESPONSE TO CUSTOMER REQUIREMENTS</span></font></td>
            <td><span class="tabletext"><input type="text" name="ranking6" size=10 value=""></span></font></td>
            <td><span class="tabletext"><textarea id="remarks6" name="remarks6" rows="3" cols="30" value=""></textarea></span></font></td>
        </tr>
   <tr bgcolor="#FFFFFF">
            <td><span class="tabletext">7.</span></font></td>
            <td><span class="tabletext">ATTENDING CUSTOMER COMPLAINT
</span></font></td>
            <td><span class="tabletext"><input type="text" name="ranking7" size=10 value=""></span></font></td>
            <td><span class="tabletext"><textarea id="remarks7" name="remarks7" rows="3" cols="30" value=""></textarea></span></font></td>
        </tr>


     <tr bgcolor="#FFFFFF">
            <td><span class="tabletext">8.</span></font></td>
            <td><span class="tabletext">SERVICE QUALITY</span></font></td>
            <td><span class="tabletext"><input type="text" name="ranking8" size=10 value=""></span></font></td>
            <td><span class="tabletext"><textarea id="remarks8" name="remarks8" rows="3" cols="30" value=""></textarea></span></font></td>
        </tr>


       <tr bgcolor="#FFFFFF">
            <td><span class="tabletext">9.</span></font></td>
            <td><span class="tabletext">LENDING A HELPING HAND DURING CRISIS TIME
</span></font></td>
            <td><span class="tabletext"><input type="text" name="ranking9" size=10 value=""></span></font></td>
            <td><span class="tabletext"><textarea id="remarks9" name="remarks9" rows="3" cols="30" value=""></textarea></span></font></td>
        </tr>


       <tr bgcolor="#FFFFFF">
            <td><span class="tabletext">10.</span></font></td>
            <td><span class="tabletext">OVERALL IMPRESSION WITH SN ENGINEERING</span></font></td>
            <td><span class="tabletext"><input type="text" name="ranking10" size=10 value=""></span></font></td>
            <td><span class="tabletext"><textarea id="remarks10" name="remarks10" rows="3" cols="30" value=""></textarea></span></font></td>
        </tr>
 -->
        <tr bgcolor="#FFFFFF">
        <td colspan="4"><span class="labeltext">NOTE: PLEASE GRADE US IN THE RANKING COLUMN AGAINST EACH PARAMETER IN 10 POINT SCALE. 10 IS MAXIMUM RATING AND 1 IS MINIMUM RATING</span></td>
        </tr>
</table>

<span class="labeltext"><input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()">

      </FORM>

</body>
</html>
