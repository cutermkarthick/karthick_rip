<?php
//==============================================
// Author: FSI                                 =
// Date-written = April , 2010                 =
// Filename: dnEntry.php                       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Allows entry of Dispatchs                   =
//==============================================
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'postcontractEntry';
$page= "CRM: Post Contract Review";
//////session_register('pagename');

// First include the class definition
//include('classes/contract_reviewClass.php');

include('classes/displayClass.php');
include('classes/assyReviewClass.php');
include('classes/companyClass.php');
include('classes/bomClass.php');
include('classes/vendPartClass.php');
$newassyReview = new assyReview;
$newdisp = new display;
$company = new company;
$bom = new bom;
$newVend = new vendPart;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/assy_review.js"></script>

<html>
<head>
<title>Post Contract Review for Assembly Order</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
<form action='contractreviewProcess.php' method='POST' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td></td></tr>
<tr>
<td>
<?php
$newdisp->dispLinks('');
?> -->
<!-- <table width=100% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr><td>
<table width=100% border=0>
<tr> -->
<td><span class="pageheading"><b>Post Contract Review for Assembly Order</b></td>
</tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
<tr><td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<td width='20%'><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Assembly Review#</p></font></td>
<td width='20%'><input type="text" name="cust_ponum"  size=20 value=""></td>
<!-- <?php
$result_cust = $company->getAllCustomers();
?>
<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
<td><select id="customer" name="customer">
<option selected>Select</option>
<?php
while($myrow_cust = mysql_fetch_row($result_cust))
{
  printf('<option value= %s>%s',$myrow_cust[0],$myrow_cust[1]);
}
?>
</select></td>
</tr> -->


<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Wo No:</p></font></td>
<td><input type="text" id="wonum" name="wonum"
			 size=10 value="">
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Drg No:</p></font></td>
<td colspan="4"><input type="text" name="drg_no" id="drg_no" size=20 value=""></td>
</span></tr>



</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"></span>Section</p></font></td>
<td><input type="text" name="section1" id="section1"  size=5 value=""></td>
<td><span class="labeltext"><p align="left"></span>Material Spec</p></font></td>
<td><input type="text" id="material_spec" name="material_spec"
       size=10 value="">
<td><span class="labeltext"><p align="left"></span>Check List</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
</td>

<td><span class="labeltext"><p align="left"></span>Risks identified<p></font></td>
<td><input type="text" id="risk_identi1" name="risk_identi1"
       size=10 value="">


<td><span class="labeltext"><p align="left"></span>RPN<p></font></td>
<td><input type="text" id="rpn1" name="rpn1"
       size=10 value="">

       <td><span class="labeltext"><p align="left"></span>Risk Register Entry No<p></font></td>
<td><input type="text" id="risk_reg1" name="risk_reg1"
       size=10 value="">

              <td><span class="labeltext"><p align="left"></span>Identified by<p></font></td>
<td><input type="text" id="identi_by1" name="identi_by1"
       size=10 value="">


              <td><span class="labeltext"><p align="left"></span>Reviewed<p></font></td>
<td><input type="text" id="review1" name="review1"
       size=10 value="">


</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"></span>Material</p></font></td>
<td colspan="3"><input type="text" id="material" name="material"
       size=10 value="">
</span></td>

<td><span class="labeltext"><p align="left"></span>Exact match</p></font></td>
<?
$i=1;
while($i<= 6)
{
      $exact_match = "exact_match".$i;
?>
       <td><input type="checkbox" name="<?php echo $exact_match?>" id="<?php echo $exact_match?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
<td colspan="10"></td>
</tr>
<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>Equivalent Accepted</p></font></td>
<?
$i=1;
while($i<= 6)
{
      $eq_acc = "eq_acc".$i;
?>
       <td><input type="checkbox" name="<?php echo $eq_acc?>" id="<?php echo $eq_acc?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
<td colspan="10"></td>

</tr>


<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>Alternative needs Cust approval</p></span></font></td>

<?
$i=1;
while($i<= 6)
{
      $alt_custapp = "alt_custapp".$i;
?>
       <td><input type="checkbox" name="<?php echo $alt_custapp?>" id="<?php echo $alt_custapp?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
<td colspan="10"></td>
</tr>

<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>RM size</p></font></td>

<?
$i=1;
while($i<= 6)
{
      $rm_size = "rm_size".$i;
?>
       <td><input type="checkbox" name="<?php echo $rm_size?>" id="<?php echo $rm_size?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
<td colspan="10"></td>

</span></tr>


<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>Grain direction</p></font></td>
<?
$i=1;
while($i<= 6)
{
      $grain_dir = "grain_dir".$i;
?>
       <td><input type="checkbox" name="<?php echo $grain_dir?>" id="<?php echo $grain_dir?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
<td colspan="10"></td>
</span></tr>





<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"></span>Section</p></font></td>
<td><input type="text" name="section2" id="section2"  size=5 value=""></td>
<td><span class="labeltext"><p align="left"></span>Purchase Approval</p></font></td>
<td><input type="text" id="purch_app" name="purch_app"
       size=10 value="">
<td><span class="labeltext"><p align="left"></span>Check List</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
</td>

<td><span class="labeltext"><p align="left"></span>Risks identified<p></font></td>
<td><input type="text" id="risk_identi2" name="risk_identi2"
       size=10 value=""></td>


<td><span class="labeltext"><p align="left"></span>RPN<p></font></td>
<td><input type="text" id="rpn2" name="rpn2"
       size=10 value="">

       <td><span class="labeltext"><p align="left"></span>Risk Register Entry No<p></font></td>
<td><input type="text" id="risk_reg2" name="risk_reg2"
       size=10 value="">

              <td><span class="labeltext"><p align="left"></span>Identified by<p></font></td>
<td><input type="text" id="identi_by2" name="identi_by2"
       size=10 value="">


              <td><span class="labeltext"><p align="left"></span>Reviewed<p></font></td>
<td><input type="text" id="reviewe2" name="reviewe2"
       size=10 value="">


</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"></span>Supplier</p></font></td>
<td colspan="3"><input type="text" id="supplier" name="supplier" size=10 value="">
</span></td>

<td><span class="labeltext"><p align="left"></span>Supplier Approved</p></font></td>
<?
$i=1;
while($i<= 6)
{
      $supp_app = "supp_app".$i;
?>
       <td><input type="checkbox" name="<?php echo $supp_app?>" id="<?php echo $supp_app?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
<td colspan="10"></td>
</span>
</tr>
<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>Cust approval avl req</p></font></td>
<?
$i=1;
while($i<= 6)
{
      $cust_app = "cust_app".$i;
?>
       <td><input type="checkbox" name="<?php echo $cust_app?>" id="<?php echo $cust_app?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
<td colspan="10"></td>

</span></tr>


<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>Import restriction</p></font></td>
<?
$i=1;
while($i<= 6)
{
      $imp_restr = "imp_restr".$i;
?>
       <td><input type="checkbox" name="<?php echo $imp_restr?>" id="<?php echo $imp_restr?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
<td colspan="10"></td>

</span></tr>

<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>Mill cert required</p></font></td>
<?
$i=1;
while($i<= 6)
{
      $milcert_req = "milcert_req".$i;
?>
       <td><input type="checkbox" name="<?php echo $milcert_req?>" id="<?php echo $milcert_req?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
<td colspan="10"></td>

</span></tr>


<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>AS approved</p></font></td>
<?
$i=1;
while($i<= 6)
{
      $as_app = "as_app".$i;
?>
       <td><input type="checkbox" name="<?php echo $as_app?>" id="<?php echo $as_app?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
 <td colspan="10"></td>
</span></tr>



<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"></span>Section</p></font></td>
<td><input type="text" name="section3" id="section3"  size=5 value=""></td>
<td><span class="labeltext"><p align="left"></span>Special processes Approval reference
</p></font></td>
<td><input type="text" id="special_process" name="special_process"
       size=10 value="">
<td><span class="labeltext"><p align="left"></span>Check List</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
</td>

<td><span class="labeltext"><p align="left"></span>Risks identified<p></font></td>
<td><input type="text" id="risk_identi3" name="risk_identi3"
       size=10 value=""></td>


<td><span class="labeltext"><p align="left"></span>RPN<p></font></td>
<td><input type="text" id="rpn3" name="rpn3"
       size=10 value="">

       <td><span class="labeltext"><p align="left"></span>Risk Register Entry No<p></font></td>
<td><input type="text" id="risk_reg3" name="risk_reg3"
       size=10 value="">

              <td><span class="labeltext"><p align="left"></span>Identified by<p></font></td>
<td><input type="text" id="identi_by3" name="identi_by3"
       size=10 value="">


              <td><span class="labeltext"><p align="left"></span>Reviewed<p></font></td>
<td><input type="text" id="reviewe3" name="reviewe3"
       size=10 value="">


</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"></span>Source</p></font></td>
<td colspan="3"><input type="text" id="source" name="source"
       size=10 value="">
</span></td>

<td><span class="labeltext"><p align="left"></span>Supplier Approved</p></font></td>
<?
$i=1;
while($i<= 6)
{
      $app_supp = "app_supp".$i;
?>
       <td><input type="checkbox" name="<?php echo $app_supp?>" id="<?php echo $app_supp?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
         <td colspan="10"></td>
</span>
</tr>
<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>Process approved
</p></font></td>
<?
$i=1;
while($i<= 6)
{
      $process_app = "process_app".$i;
?>
       <td><input type="checkbox" name="<?php echo $process_app?>" id="<?php echo $process_app?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>

</span></tr>


<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>Import restriction</p></font></td>
<?
$i=1;
while($i<= 6)
{
      $restr_imp = "restr_imp".$i;
?>
       <td><input type="checkbox" name="<?php echo $restr_imp?>" id="<?php echo $restr_imp?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>

</span></tr>

<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>Cert required</p></font></td>
<?
$i=1;
while($i<= 6)
{
      $cert_req = "cert_req".$i;
?>
       <td><input type="checkbox" name="<?php echo $cert_req?>" id="<?php echo $cert_req?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>

</span></tr>


<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>NADCAP approved
</p></font></td>
<?
$i=1;
while($i<= 6)
{
      $nadcap_app = "nadcap_app".$i;
?>
       <td><input type="checkbox" name="<?php echo $nadcap_app?>" id="<?php echo $nadcap_app?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
 <td colspan="10"></td>
</span></tr>




<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"></span>Section</p></font></td>
<td><input type="text" name="section4" id="section4"  size=5 value=""></td>
<td><span class="labeltext"><p align="left"></span>Production
Machine
</p></font></td>
<td><input type="text" id="product_machine" name="product_machine"
       size=10 value="">
<td><span class="labeltext"><p align="left"></span>Check List</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
</td>

<td><span class="labeltext"><p align="left"></span>Risks identified<p></font></td>
<td><input type="text" id="risk_identi4" name="risk_identi4"
       size=10 value=""></td>


<td><span class="labeltext"><p align="left"></span>RPN<p></font></td>
<td><input type="text" id="rpn4" name="rpn4"
       size=10 value="">

       <td><span class="labeltext"><p align="left"></span>Risk Register Entry No<p></font></td>
<td><input type="text" id="risk_reg4" name="risk_reg4"
       size=10 value="">

              <td><span class="labeltext"><p align="left"></span>Identified by<p></font></td>
<td><input type="text" id="identi_by4" name="identi_by4"
       size=10 value="">


              <td><span class="labeltext"><p align="left"></span>Reviewed<p></font></td>
<td><input type="text" id="reviewe4" name="reviewe4"
       size=10 value="">


</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"></span>Process
</p></font></td>
<td colspan="3"><input type="text" id="material" name="material"
       size=10 value="">
</span></td>

<td><span class="labeltext"><p align="left"></span>Size
</p></font></td>
<?
$i=1;
while($i<= 6)
{
      $size = "size".$i;
?>
       <td><input type="checkbox" name="<?php echo $size?>" id="<?php echo $size?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
         <td colspan="10"></td>
</span>
</tr>
<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>Accuracy
</p></font></td>
<?
while($i<= 6)
{
      $accuracy = "accuracy".$i;
?>
       <td><input type="checkbox" name="<?php echo $accuracy?>" id="<?php echo $accuracy?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
<td colspan="10"></td>
</span></tr>


<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>Surface finish
</p></font></td>
<?
while($i<= 6)
{
      $surface = "surface".$i;
?>
       <td><input type="checkbox" name="<?php echo $surface?>" id="<?php echo $surface?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
        <td colspan="10"></td>

</span></tr>

<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>Tools 
</p></font></td>
<?
while($i<= 6)
{
      $tools = "tools".$i;
?>
       <td><input type="checkbox" name="<?php echo $tools?>" id="<?php echo $tools?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
       <td colspan="10"></td>

</span></tr>


<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>Program

</p></font></td>
<?
while($i<= 6)
{
      $program = "program".$i;
?>
       <td><input type="checkbox" name="<?php echo $program?>" id="<?php echo $program?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
 <td colspan="10"></td>
</span></tr>

<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>Capacity
</p></font></td>
<?
while($i<= 6)
{
      $capacity = "capacity".$i;
?>
       <td><input type="checkbox" name="<?php echo $capacity?>" id="<?php echo $capacity?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
 <td colspan="10"></td>
</span></tr>



<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"></span>Section</p></font></td>
<td><input type="text" name="section1" id="section1"  size=5 value=""></td>
<td><span class="labeltext"><p align="left"></span>Measurement/Quality

</p></font></td>
<td><input type="text" id="material_spec" name="material_spec"
       size=10 value="">
<td><span class="labeltext"><p align="left"></span>Check List</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
</td>

<td><span class="labeltext"><p align="left"></span>Risks identified<p></font></td>
<td><input type="text" id="material_spec" name="material_spec"
       size=10 value=""></td>


<td><span class="labeltext"><p align="left"></span>RPN<p></font></td>
<td><input type="text" id="material_spec" name="material_spec"
       size=10 value="">

       <td><span class="labeltext"><p align="left"></span>Risk Register Entry No<p></font></td>
<td><input type="text" id="material_spec" name="material_spec"
       size=10 value="">

              <td><span class="labeltext"><p align="left"></span>Identified by<p></font></td>
<td><input type="text" id="material_spec" name="material_spec"
       size=10 value="">


              <td><span class="labeltext"><p align="left"></span>Reviewed<p></font></td>
<td><input type="text" id="material_spec" name="material_spec"
       size=10 value="">


</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"></span>Measurability of parameters

</p></font></td>
<td colspan="3"><input type="text" id="material" name="material"
       size=10 value="">
</span></td>

<td><span class="labeltext"><p align="left"></span>CMM/special requirement</p></font></td>
<?
while($i<= 6)
{
     $special_req = "special_req".$i;
?>
       <td><input type="checkbox" name="<?php echo $special_req?>" id="<?php echo $special_req?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>        <td colspan="10"></td>

</span></tr>


<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>Customer Q Plan
</p></font></td>
<?
while($i<= 6)
{
     $customer_plan = "customer_plan".$i;
?>
       <td><input type="checkbox" name="<?php echo $customer_plan?>" id="<?php echo $customer_plan?>"
       size=10 value=""></td>
       
<?
$i++;
}
?> 
        <td colspan="10"></td>

</span></tr>

<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>Sample size
 </p></font></td>
<?
while($i<= 6)
{
     $sample_size = "sample_size".$i;
?>
       <td><input type="checkbox" name="<?php echo $sample_size?>" id="<?php echo $sample_size?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
       <td colspan="10"></td>

</span></tr>


<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>FAI req
</p></font></td>
<?
while($i<= 6)
{
     $fai_req = "fai_req".$i;
?>
       <td><input type="checkbox" name="<?php echo $fai_req?>" id="<?php echo $fai_req?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
 <td colspan="10"></td>
</span></tr>

<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>PDI
</p></font></td>
<?
while($i<= 6)
{
     $pdi = "pdi".$i;
?>
       <td><input type="checkbox" name="<?php echo $pdi?>" id="<?php echo $pdi?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
 <td colspan="10"></td>
</span></tr>

<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>Standard availability
</p></font></td>
<?
while($i<= 6)
{
     $std_avail = "std_avail".$i;
?>
       <td><input type="checkbox" name="<?php echo $std_avail?>" id="<?php echo $std_avail?>"
       size=10 value=""></td>
       
<?
$i++;
}
?>
 <td colspan="10"></td>
</span></tr>



<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"></span>Section</p></font></td>
<td><input type="text" name="section1" id="section1"  size=5 value=""></td>
<td><span class="labeltext"><p align="left"></span>Others


</p></font></td>
<td><input type="text" id="material_spec" name="material_spec"
       size=10 value="">
<td><span class="labeltext"><p align="left"></span>Check List</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
<td><span class="labeltext"><p align="left"></span>Tick</p></font></td>
</td>

<td><span class="labeltext"><p align="left"></span>Risks identified<p></font></td>
<td><input type="text" id="material_spec" name="material_spec"
       size=10 value=""></td>


<td><span class="labeltext"><p align="left"></span>RPN<p></font></td>
<td><input type="text" id="material_spec" name="material_spec"
       size=10 value="">

       <td><span class="labeltext"><p align="left"></span>Risk Register Entry No<p></font></td>
<td><input type="text" id="material_spec" name="material_spec"
       size=10 value="">

              <td><span class="labeltext"><p align="left"></span>Identified by<p></font></td>
<td><input type="text" id="material_spec" name="material_spec"
       size=10 value="">


              <td><span class="labeltext"><p align="left"></span>Reviewed<p></font></td>
<td><input type="text" id="material_spec" name="material_spec"
       size=10 value="">


</tr>
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left"></span>Miscellaneous


</p></font></td>
<td colspan="3"><input type="text" id="material" name="material"
       size=10 value="">
</span></td>
<td><span class="labeltext"><p align="left"></span>RM store space
</p></font></td>
<?
while($i<= 6)
{
     $rm_store_space = "rm_store_space".$i;
?>
       <td><input type="checkbox" name="<?php echo $rm_store_space?>" id="<?php echo $rm_store_space?>" size=10 value=""></td>
       
<?
$i++;
}
?>
        <td colspan="10"></td>

</span></tr>


<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>Shelf life

</p></font></td>
<?
while($i<= 6)
{
     $rm_store_space = "rm_store_space".$i;
?>
       <td><input type="checkbox" name="<?php echo $rm_store_space?>" id="<?php echo $rm_store_space?>" size=10 value=""></td>
       
<?
$i++;
}
?>
        <td colspan="10"></td>

</span></tr>

<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>Cutting feasibility
</p></font></td>
<?
while($i<= 6)
{
     $cutting_feas = "cutting_feas".$i;
?>
       <td><input type="checkbox" name="<?php echo $cutting_feas?>" id="<?php echo $cutting_feas?>" size=10 value=""></td>
       
<?
$i++;
}
?>
       <td colspan="10"></td>

</span></tr>


<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>Special coolant req
</p></font></td>
<?
while($i<= 6)
{
     $special_coolant_req = "special_coolant_req".$i;
?>
       <td><input type="checkbox" name="<?php echo $special_coolant_req?>" id="<?php echo $special_coolant_req?>" size=10 value=""></td>
       
<?
$i++;
}
?>
 <td colspan="10"></td>
</span></tr>

<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>Packing feasibility
</p></font></td>
<?
while($i<= 6)
{
     $packing_feas = "packing_feas".$i;
?>
       <td><input type="checkbox" name="<?php echo $packing_feas?>" id="<?php echo $packing_feas?>" size=10 value=""></td>
       
<?
$i++;
}
?>
 <td colspan="10"></td>
</span></tr>

<tr bgcolor="#FFFFFF"><td colspan="4">
<td><span class="labeltext"><p align="left"></span>logistics feasibility</p></font></td>
<?
while($i<= 6)
{
     $logic_feas = "logic_feas".$i;
?>
       <td><input type="checkbox" name="<?php echo $logic_feas?>" id="<?php echo $logic_feas?>" size=10 value=""></td>
       
<?
$i++;
}
?>
 <td colspan="10"></td>
</span></tr>


</table>


</table>
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align=left>
</td>
</tr>
</table>
<span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">

</FORM>
</body>
</html>
