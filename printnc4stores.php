<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Oct 26, 2009                 =
// Filename: printnc4stores.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new NC stores               =
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
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/companyClass.php');
include('classes/nc4storesClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newnc4stores = new nc4stores;

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
<script language="javascript" src="scripts/nc4stores.js"></script>


<html>
<head>
<title>Print NC Stores Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php 
$title = '<b>NON - CONFORMANCE REPORT <br>IN COMING RAW MATERIAL</b>';
?>

<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td><font style="Arial" size=3 color="#000000"><center><b><A HREF="javascript:window.print()"><?php echo $title ?></A></b></center></td></tr> 
<tr>
<td>
<br>
<table width=100% border=0 cellspacing=1 bgcolor="#DFDEDF" >
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td  bgcolor="#FFFFFF" width=10%><span class="labeltext">REF No:</td>
<td width=30%><span class="tabletext"><?php printf("%s", $myrow[1]) ?></center></td>
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
           }    ?>
 <td   bgcolor="#FFFFFF" width=10%><span class="labeltext">DATE:</td>
<td><span class="tabletext"><?php echo $cdate ?></center></td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=10%><span class="labeltext"><p align="left">Supplier:</p></font></td>
<td  colspan=5><span class="tabletext"><?php echo $myrow[3] ?></td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC">
<td width=10%><span class="labeltext"><p align="left">RM PO No:</p></font></td>
<td width=30%><span class="tabletext"><?php echo $myrow[4] ?></td>
 <td width=10%><span class="labeltext"><p align="left">Receipt Date:</p></font></td>
              <?php  if($myrow[5] != '0000-00-00' && $myrow[5] != '' && $myrow[5] != 'NULL')
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
<td width=30% height=10px><span class="tabletext"><?php echo $receipt_date ?></td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=10%><span class="labeltext"><p align="left">Invoice No:</p></font></td>
<td width=30%><span class="tabletext"><?php echo $myrow[6] ?></td>
<td width=10%><span class="labeltext"><p align="left">BOL/BOE No:</p></font></td>
<td width=30%><span class="tabletext"><?php echo $myrow[7] ?></td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=10%><span class="labeltext"><p align="left">C of C No:</p></font></td>
<td width=80% colspan=5><span class="tabletext"><?php echo $myrow[8] ?></td>
</tr>

</table>
<br/>

<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 rules=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
  <td bgcolor="#FFFFF" width=40%  align="center"><span class="heading"><b>Description</b></td>
    <td bgcolor="#FFFFF" width=5%  align="center"><span class="heading"><b>Yes</b></td>
     <td bgcolor="#FFFFF" width=5%  align="center"><span class="heading"><b>No</b></td>
	   <td bgcolor="#FFFFF" width=40%  align="center"><span class="heading"><b>Description</b></td>
    <td bgcolor="#FFFFF" width=5%  align="center"><span class="heading"><b>Yes</b></td>
     <td bgcolor="#FFFFF" width=5%  align="center"><span class="heading"><b>No</b></td>
   </tr>

  <tr class="bgcolor2" bordercolor="#CCCCCC" >
   <td bgcolor="#FFFFFF"><span class="labeltext">Dimensional Deviation</td>
   <?
   if($myrow[9] == 'Yes')
   {
   $dim_deviation="checked";
   ?>
   <td bgcolor="#FFFFFF" align='center'><input type="checkbox" <?php echo $dim_deviation ?> name="dim_deviation" onClick="return readOnlyRadio()"></td> 
   <td bgcolor="#FFFFFF" align='center'><input type="checkbox" name="dim_deviationn" onClick="return readOnly4Radio()"></td> 
   <?}
   else
   {
	 $dim_deviation="checked";?>
  <td bgcolor="#FFFFFF" align='center'><input type="checkbox" name="dim_deviation" onClick="return readOnlyRadio()"></td> 
  <td bgcolor="#FFFFFF" align='center'><input type="checkbox" <?php echo $dim_deviation ?> name="dim_deviationn" onClick="return readOnly4Radio()"></td> 
   <?} ?>

   <td bgcolor="#FFFFFF"><span class="labeltext">Raw Material Docs/Test Certificates received</td>
  <? 

  if($myrow[12] == 'Yes')
  {
   $raw_material_docs="checked";?>
   <td bgcolor="#FFFFFF" align='center'><input type="checkbox" <?php echo $raw_material_docs ?> name="raw_material_docs" onClick="return readOnlyRadio()"></td> 
   <td bgcolor="#FFFFFF" align='center'><input type="checkbox" name="raw_material_docss" onClick="return readOnly4Radio()"></td> 
   <?}
   else
   {
  $raw_material_docs="checked";  
  ?>
  <td bgcolor="#FFFFFF" align='center'><input type="checkbox" name="raw_material_docs" onClick="return readOnlyRadio()"></td> 
  <td bgcolor="#FFFFFF" align='center'><input type="checkbox" <?php echo $raw_material_docs ?> name="raw_material_docss" onClick="return readOnly4Radio()"></td> 
  <?}?> 
  </tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >

  <td bgcolor="#FFFFFF"><span class="labeltext">Material Spec.Deviation</td>
  <?
  if($myrow[10] == 'Yes'){
   $mat_deviation="checked";
   ?>
   <td bgcolor="#FFFFFF" align='center'><input type="checkbox" <?php echo $mat_deviation ?> name="mat_deviation" onClick="return readOnlyRadio()"></td> 
   <td bgcolor="#FFFFFF" align='center'><input type="checkbox" name="mat_deviationn" onClick="return readOnly4Radio()"></td>
   <?
  }
   else
   {
	$mat_deviation="checked";
	?>
  <td bgcolor="#FFFFFF" align='center'><input type="checkbox" name="mat_deviation" onClick="return readOnlyRadio()"></td> 
  <td bgcolor="#FFFFFF" align='center'><input type="checkbox" <?php echo $mat_deviation ?> name="mat_deviationn" onClick="mat_deviation readOnly4Radio()"></td> 
   <?}?>

   <td bgcolor="#FFFFFF"><span class="labeltext">Specific Marking/Grain Flow Marking Correct</td>
  <?
  if($myrow[13] == 'Yes'){
   $specific_marking="checked";
   ?>
    <td bgcolor="#FFFFFF" align='center'><input type="checkbox" <?php echo $specific_marking ?> name="specific_marking" onClick="return readOnlyRadio()"></td> 
   <td bgcolor="#FFFFFF" align='center'><input type="checkbox" name="specific_markingg" onClick="return readOnly4Radio()"></td>
   <?
   }else
   {
	$specific_marking="checked";?>
   <td bgcolor="#FFFFFF" align='center'><input type="checkbox" name="specific_marking" onClick="return readOnlyRadio()"></td> 
  <td bgcolor="#FFFFFF" align='center'><input type="checkbox" <?php echo $specific_marking ?> name="specific_markingg" onClick="specific_marking readOnly4Radio()"></td> 
   <?}?>				   
 
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
  <td bgcolor="#FFFFFF"><span class="labeltext">Discrepancy in Quantity</td>
 <?
  if($myrow[11] == 'Yes'){
   $descrepency_quantity="checked";
   ?>
    <td bgcolor="#FFFFFF" align='center'><input type="checkbox" <?php echo $descrepency_quantity ?> name="descrepency_quantity" onClick="return readOnlyRadio()"></td> 
   <td bgcolor="#FFFFFF" align='center'><input type="checkbox" name="descrepency_quantityy" onClick="return readOnly4Radio()"></td>
   <?}else
   {
   $descrepency_quantity="checked";?>
   <td bgcolor="#FFFFFF" align='center'><input type="checkbox" name="descrepency_quantity" onClick="return readOnlyRadio()"></td> 
  <td bgcolor="#FFFFFF" align='center'><input type="checkbox" <?php echo $descrepency_quantity ?> name="descrepency_quantityy" onClick="return readOnly4Radio()"></td> 
   <?}?> 						  

   <td bgcolor="#FFFFFF"><span class="labeltext">Other Deviation/Discrepancy</td>
 <?
  if($myrow[14] == 'Yes'){
   $other_deviation="checked";
   ?>
   <td bgcolor="#FFFFFF" align='center'><input type="checkbox" <?php echo $other_deviation ?> name="other_deviation" onClick="return readOnlyRadio()"></td> 
   <td bgcolor="#FFFFFF" align='center'><input type="checkbox" name="other_deviationn" onClick="return readOnly4Radio()"></td>
   <?}
   else
   {
   $other_deviation="checked";?>
  <td bgcolor="#FFFFFF" align='center'><input type="checkbox" name="other_deviation" onClick="return readOnlyRadio()"></td> 
  <td bgcolor="#FFFFFF" align='center'><input type="checkbox" <?php echo $other_deviation ?> name="other_deviationn" onClick="return readOnly4Radio()"></td> 
   <?}?>						   
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >

    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b><u>BRIEF DESCRIPTION OF NON CONFORMANCE:</u></b><br>
     <span class="tabletext"> <?php echo wordwrap($myrow[15],125,"<br />\n"); ?>
    </td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b><u>ROOT CAUSE:</u></b><br>
    <span class="tabletext"> <?php echo wordwrap($myrow[16],125,"<br />\n"); ?>
    </td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b><u>CORRECTIVE ACTION:</u></b><br>
    <span class="tabletext"> <?php echo wordwrap($myrow[17],125,"<br />\n"); ?>
    </td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b><u>PREVENTIVE ACTION:</u></b><br>
    <span class="tabletext"> <?php echo wordwrap($myrow[18],125,"<br />\n"); ?>
    </td>
</tr>
</table>

<br/>
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rules=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
 <td width='20%'><span class="labeltext"><p align="left">NC Raised By</p></font></td>
 <td width='30%'><span class="tabletext"><?php echo $myrow[19] ?></td>
 <td width='10%'><span class="labeltext"><p align="left">NCR Accepted</p></font></td>
 <td width='10%'><span class="tabletext"><?php echo $myrow[20] ?></td>
 <td width='10%'><span class="labeltext"><p align="left">Due On</p></font></td>
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

             <td width=10%><span class="tabletext"><?php echo $due_date ?></td>
 </tr>

 <tr class="bgcolor2" bordercolor="#CCCCCC" >
    <td bgcolor="#FFFFFF" align='center'><span class="heading">Signature of <br> Head Stores<br></td>
    <td width='20%'><span class="labeltext">&nbsp;</td> 
	 <td bgcolor="#FFFFFF" width='10%' align='center' ><span class="heading">Signature of <br> Supplier<br></td>
	 <td width='20%' colspan=3><span class="labeltext">&nbsp;</td> 
   

    </td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b><u>Effectiveness:</u></b><br>
   <span class="tabletext"> <?php echo wordwrap($myrow[22],125,"<br />\n"); ?>
    </td>
</tr>
</table>
<br/>
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rules=all bordercolor="#000000">
        <tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td align='center'><span class="labeltext"><?echo $myrow[23]?></td>       
			 <td align='center'><span class="labeltext"><?echo $myrow[24]?></td>   
            <td colspan=4 align='center'><span class="labeltext"></td>		
        </tr>

		 <tr class="bgcolor2" bordercolor="#CCCCCC" >           
            <td align='center' colspan=6><span class="heading"><b>CIM TOOLS PRIVATE LIMITED</b><br>Plot No. 467-469, Site No. 1D,12th Cross, 4th Phase,Peenya Industrial Area,Bengalure- 560 058,INDIA.<br>Phone: +91 80 41171382, Fax: +91 80 41171381</td>
        </tr>

</table>
	</td>
    </tr>


    </td>

     <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

         <tr bgcolor="#FFFFFF">


        </tr>


</table>

      </FORM>
</table>
</body>
</html>
