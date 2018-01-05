<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2008                =
// Filename: new_nc4qa.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new quotes                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$recnum=$_REQUEST['recnum'];

$_SESSION['pagename'] = 'nc4stores_details';
$page="Stores: NC";
//////session_register('pagename');
$dept = $_SESSION['department'];
// First include the class definition
include('classes/userClass.php');
include('classes/companyClass.php');
include('classes/nc4storesClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newnc4stores = new nc4stores;
$newdisplay = new display;
$result = $newnc4stores->getnc4storesDetails($recnum);
$myrow = mysql_fetch_row($result);
?>
<script language="javascript" type="text/javascript">
function readOnlyRadio() {	
   return false;
}
function readOnly4Radio() {	
	return false;
}

</script>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/nc4stores.js"></script>


<html>
<head>
<title>NC Stores Details</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr>
        					<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        					<td align="right">&nbsp;
       					<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        				 </tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr>
<td>
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr>
<td><span class="pageheading"><b>NC Details</b></td>
 <td bgcolor="#FFFFFF" align="right">
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='edit_nc4stores.php?recnum=<?php echo $recnum ?>'" value="Edit NC" >
  <!-- <a href ="edit_nc4stores.php?recnum=<?php echo $recnum ?>"><img name="Image8" border="0" src="images/edit_nc.gif" ></a> -->
  <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="javascript: printnc4stores(<?php echo $recnum ?>)" value="Print" >
 <!-- <input type= "image" name="Print" src="images/bu-print.gif" value="Print" onclick="javascript: printnc4stores(<?php echo $recnum ?>)"> -->
</td>
</tr>
</table>
</tr>

<form action='processnc4stores.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>NC For Stores Header</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">

        <tr bgcolor="#FFFFFF">
		    <td><span class="labeltext"><p align="left">Id No.</p></font></td>
            <td width=25%><span class="tabletext"><?php printf("%05d", $myrow[0]) ?></td>
           <td><span class="labeltext"><p align="left">REF No.</p></font></td>
            <td width=25%><span class="tabletext"><?php printf("%s", $myrow[1]) ?></td>
			</tr>
      <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">Date</p></font></td>
            <?php  if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
            {
              $datearr = split('-', $myrow[2]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $cdate=date("M j, Y",$x);
            }
           else
           {
              $cdate = '';
           }          
          ?>

             <td width=25%><span class="tabletext"><?php echo $cdate ?></td>
        
              <td><span class="labeltext"><p align="left">Supplier</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[3] ?></td>
			</tr>
			<tr bgcolor="#FFFFFF">
              <td><span class="labeltext"><p align="left">RM PO No.</p></font></td>
             <td><span class="tabletext"><?php echo $myrow[4] ?></td>
             </td>        
          <td><span class="labeltext"><p align="left">Receipt Date</p></font></td>
              <?php 
			 if($myrow[5] != '0000-00-00' && $myrow[5] != '' && $myrow[5] != 'NULL')
            {
              $datearr = split('-', $myrow[5]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $receipt_date=date("M j, Y",$x);
            }
           else
           {
              $receipt_date = '';
           }          
          ?>

             <td width=25%><span class="tabletext"><?php echo $receipt_date ?></td>
			 </tr>

             <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">Invoice No.</p></font></td>
             <td><span class="tabletext"><?php echo $myrow[6] ?></td>       
             <td><span class="labeltext"><p align="left">BOL/BOE No.</p></font></td>
             <td><span class="tabletext"><?php echo $myrow[7] ?></td>
			 </tr>

             <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">C of C No.</p></font></td>
             <td colspan=3><span class="tabletext"><?php echo $myrow[8] ?></td>
             </tr>

		<tr bgcolor="#FFFFFF"><td colspan='6' height='20px'>
		</td></tr>

<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
    <tr bgcolor="#DDDEDD">
  <td bgcolor="#FFFFF" width=30%  align="center"><span class="labeltext">Description</td>
    <td bgcolor="#FFFFF" width=10%  align="center"><span class="labeltext">Yes</td>
     <td bgcolor="#FFFFF" width=10%  align="center"><span class="labeltext">No</td>
	   <td bgcolor="#FFFFF" width=30%  align="center"><span class="labeltext">Description</td>
    <td bgcolor="#FFFFF" width=10%  align="center"><span class="labeltext">Yes</td>
     <td bgcolor="#FFFFF" width=10%  align="center"><span class="labeltext">No</td>
   </tr>

    <tr bgcolor="#FFFFFF">
   <td bgcolor="#FFFFFF" width=20%><span class="labeltext">Dimensional Deviation</td>
   <?
   if($myrow[9] == 'Yes')
   {
   $dim_deviation="checked";
   ?>
   <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $dim_deviation ?> name="dim_deviation" onClick="return readOnlyRadio()"></td> 
   <td bgcolor="#FFFFFF" align='center'><input type="radio" name="dim_deviationn" onClick="return readOnly4Radio()"></td> 
   <?}
   else
   {
	 $dim_deviation="checked";?>
  <td bgcolor="#FFFFFF" align='center'><input type="radio" name="dim_deviation" onClick="return readOnlyRadio()"></td> 
  <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $dim_deviation ?> name="dim_deviationn" onClick="return readOnly4Radio()"></td> 
   <?} ?>

   <td bgcolor="#FFFFFF" width=20%><span class="labeltext">Raw Material Docs/Test Certificates received</td>
  <? 

  if($myrow[12] == 'Yes')
  {
   $raw_material_docs="checked";?>
   <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $raw_material_docs ?> name="raw_material_docs" onClick="return readOnlyRadio()"></td> 
   <td bgcolor="#FFFFFF" align='center'><input type="radio" name="raw_material_docss" onClick="return readOnly4Radio()"></td> 
   <?}
   else
   {
  $raw_material_docs="checked";  
  ?>
  <td bgcolor="#FFFFFF" align='center'><input type="radio" name="raw_material_docs" onClick="return readOnlyRadio()"></td> 
  <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $raw_material_docs ?> name="raw_material_docss" onClick="return readOnly4Radio()"></td> 
  <?}?> 
  </tr>

<tr>

  <td bgcolor="#FFFFFF"><span class="labeltext">Material Spec. Deviation</td>
  <?
  if($myrow[10] == 'Yes'){
   $mat_deviation="checked";
   ?>
   <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $mat_deviation ?> name="mat_deviation" onClick="return readOnlyRadio()"></td> 
   <td bgcolor="#FFFFFF" align='center'><input type="radio" name="mat_deviationn" onClick="return readOnly4Radio()"></td>
   <?
  }
   else
   {
	$mat_deviation="checked";
	?>
  <td bgcolor="#FFFFFF" align='center'><input type="radio" name="mat_deviation" onClick="return readOnlyRadio()"></td> 
  <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $mat_deviation ?> name="mat_deviationn" onClick="mat_deviation readOnly4Radio()"></td> 
   <?}?>

   <td bgcolor="#FFFFFF"><span class="labeltext">Specific Marking/Grain Flow Marking Correct</td>
  <?
  if($myrow[13] == 'Yes'){
   $specific_marking="checked";
   ?>
    <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $specific_marking ?> name="specific_marking" onClick="return readOnlyRadio()"></td> 
   <td bgcolor="#FFFFFF" align='center'><input type="radio" name="specific_markingg" onClick="return readOnly4Radio()"></td>
   <?
   }else
   {
	$specific_marking="checked";?>
   <td bgcolor="#FFFFFF" align='center'><input type="radio" name="specific_marking" onClick="return readOnlyRadio()"></td> 
  <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $specific_marking ?> name="specific_markingg" onClick="specific_marking readOnly4Radio()"></td> 
   <?}?>				   
 
</tr>
<tr>
  <td bgcolor="#FFFFFF"><span class="labeltext">Discrepancy in Quantity</td>
 <?
  if($myrow[11] == 'Yes'){
   $descrepency_quantity="checked";
   ?>
    <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $descrepency_quantity ?> name="descrepency_quantity" onClick="return readOnlyRadio()"></td> 
   <td bgcolor="#FFFFFF" align='center'><input type="radio" name="descrepency_quantityy" onClick="return readOnly4Radio()"></td>
   <?}else
   {
   $descrepency_quantity="checked";?>
   <td bgcolor="#FFFFFF" align='center'><input type="radio" name="descrepency_quantity" onClick="return readOnlyRadio()"></td> 
  <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $descrepency_quantity ?> name="descrepency_quantityy" onClick="specific_marking readOnly4Radio()"></td> 
   <?}?> 						  

   <td bgcolor="#FFFFFF"><span class="labeltext">Other Deviation/Discrepancy</td>
 <?
  if($myrow[14] == 'Yes'){
   $other_deviation="checked";
   ?>
   <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $other_deviation ?> name="other_deviation" onClick="return readOnlyRadio()"></td> 
   <td bgcolor="#FFFFFF" align='center'><input type="radio" name="other_deviationn" onClick="return readOnly4Radio()"></td>
   <?}
   else
   {
   $other_deviation="checked";?>
  <td bgcolor="#FFFFFF" align='center'><input type="radio" name="other_deviation" onClick="return readOnlyRadio()"></td> 
  <td bgcolor="#FFFFFF" align='center'><input type="radio" <?php echo $other_deviation ?> name="other_deviationn" onClick="return readOnly4Radio()"></td> 
   <?}?>
						   
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>BRIEF DESCRIPTION OF NON CONFORMANCE:</b><br>
     <span class="tabletext"> <?php echo wordwrap($myrow[15],100,"<br />\n"); ?>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>Root Cause:</b><br>
    <span class="tabletext"> <?php echo wordwrap($myrow[16],100,"<br />\n"); ?>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>Corrective Action:</b><br>
    <span class="tabletext"> <?php echo wordwrap($myrow[17],100,"<br />\n"); ?>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>Preventive Action:</b><br>
    <span class="tabletext"> <?php echo wordwrap($myrow[18],100,"<br />\n"); ?>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
 <td><span class="labeltext"><p align="left">NC Raised By</p></font></td>
 <td><span class="tabletext"><?php echo $myrow[19] ?></td>
 <td><span class="labeltext"><p align="left">NC Accepted By</p></font></td>
 <td><span class="tabletext"><?php echo $myrow[20] ?></td>
 <td><span class="labeltext"><p align="left">Due On</p></font></td>
 <?php  if($myrow[21] != '0000-00-00' && $myrow[21] != '' && $myrow[21] != 'NULL')
            {
              $datearr = split('-', $myrow[21]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $due_date=date("M j, Y",$x);
            }
           else
           {
              $due_date = '';
           }          
          ?>

             <td width=25%><span class="tabletext"><?php echo $due_date ?></td>
 </tr>

<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>Effectiveness:</b><br>
   <span class="tabletext"> <?php echo wordwrap($myrow[22],100,"<br />\n"); ?>
    </td>
</tr>
</table>
	</td>
    </tr>


    </td>

     <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >

         <tr bgcolor="#FFFFFF">


        </tr>

<!-- <input type="hidden" name="recnum" id="recnum" value="<?php echo $recnum?>"> -->
</table>

</td>
	<!-- 	<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr> -->

		</table>


      </FORM>
</table>
</body>
</html>
