<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2006                =
// Filename: grn_details.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Displays GRN along with line items          =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'viewGrnDetails';
//////session_register('pagename');
$dept =  $_SESSION['department'];

// First include the class definition
include('classes/userClass.php');
include('classes/grnclass.php');
include('classes/displayClass.php');
include('classes/grncofcclass.php');


$newlogin = new userlogin;
$newlogin->dbconnect();


$newdisplay = new display;
$newgrn = new grn;
$newcofc=new cofc;
$grnrecnum = $_REQUEST['grnrecnum'];
$result = $newgrn->getgrn($grnrecnum);
$myrow = mysql_fetch_row($result);
$grnli = $newgrn->getgrnli($grnrecnum);
$cofc= $newcofc->getcofc($grnrecnum);

$result2 = $newgrn->getgrn($grnrecnum);
$myrow2 = mysql_fetch_row($result2);

$result3 = $newgrn->get_MI_details($myrow[25]);

?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/grn.js"></script>


<html>
<head>
<title>GRN Details</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
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

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>GRN Details</b></td>

       <td bgcolor="#FFFFFF" align="right">
        <input type= "image" name="Print" src="images/bu-print.gif" value="Print" onClick="javascript: printgrn(<?php echo $grnrecnum ?>)">
        </td>
    </tr>
<tr>
<td colspan=2>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>GRN Header</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">

        <tr bgcolor="#FFFFFF">
            <td width="25%"><span class="labeltext"><p align="left">GRN No.</p></font></td>
            <td width="25%"><span class="tabletext"><?php echo $myrow[25] ?></td>
            <td width="25%"><span class="labeltext">Supplier</td>
            <td width="25%"><span class="tabletext"><?php echo "$myrow[23]";?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Raw Material Spec</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[5] ?></td>
            <td><span class="labeltext"><p align="left">Raw Material Code</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[12] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">

            <td><span class="labeltext"><p align="left">Raw Material Type</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[4] ?>
            <td><span class="labeltext"><p align="left">MGP/DC No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[18] ?></td>
        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Invoice No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[13] ?></td>
           <?php
              if($myrow[14] != '0000-00-00' && $myrow[14] != '' && $myrow[14] != 'NULL')
              {
                  $datearr = split('-', $myrow[14]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $date=date("M j, Y",$x);
              }
              else
              {
                 $date = '';
              }
           ?>

            <td><span class="labeltext"><p align="left">Invoice Date</p></font></td>
            <td><span class="tabletext"><?php echo $date ?></td>
        </tr>

         <tr bgcolor="#FFFFFF">
          <?php
              if($myrow[15] != '0000-00-00' && $myrow[15] != '' && $myrow[15] != 'NULL')
              {
                  $datearr = split('-', $myrow[15]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $date1=date("M j, Y",$x);
              }
              else
              {
                 $date1 = '';
              }
          ?>
            <td><span class="labeltext"><p align="left">Test Reports & COC</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[16] ?></td>
            <td><span class="labeltext"><p align="left">Recieved Date</p></font></td>
            <td><span class="tabletext"><?php echo $date1 ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Batch No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[17] ?></td>
            <td><span class="labeltext"><p align="left">Remarks</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[33] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">COC Ref#</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[26] ?></td>
            <td><span class="labeltext"><p align="left">CIM PO Num</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[30] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">RM by CIM</p></font></td>
             <td><span class="tabletext"><?php echo $myrow[28] ?></td>
            <td><span class="labeltext"><p align="left">RM by Cust</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[29] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">GRN Type</p></font></td>
             <td><span class="tabletext"><?php echo $myrow[35] ?></td>
            <td><span class="labeltext"><p align="left">NC Ref#</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[34] ?></td>
        </tr>
         <?php
              if($myrow[38] != '0000-00-00' && $myrow[38] != '' && $myrow[38] != 'NULL')
              {
                  $datearr = split('-', $myrow[38]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $date2=date("M j, Y",$x);
              }
              else
              {
                 $date2 = '';
              }
           ?>
        <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">PRN</p></font></td>
             <td><span class="tabletext"><?php echo $myrow[36] ?></td>
              <td><span class="labeltext"><p align="left">Shipping Date</p></font></td>
             <td><span class="tabletext"><?php echo $date2 ?></td>
        </tr>


          <tr bgcolor="#FFFFFF">
             <td width=20%><span class="labeltext"><p align="left">Status</p></font></td>
            <td bgcolor="#00FF00" width=20%><span class="tabletext"><b><?php echo $myrow[37] ?></b></td>
             <td colspan=2></td>
          </tr>


<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Unit RM Size</b></center></td>
</tr>

<tr bgcolor="#FFFFFF">


<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Seq No.</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>PartNo.</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Desc</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Batchnum</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>UOM</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Exp Dt</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim1<br>L</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim2<br>W/ID</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim3<br>T/OD</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty/Billet</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty Rej</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>QTM</center></b></td>
</tr>

<?php
   $total=0;
  while ($myrow = mysql_fetch_row($grnli))
  {
?>
      <tr>
      <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[0] ? $myrow[0] : ' ' ?></td>
      <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[11] ? $myrow[11] : ' ' ?></td>
      <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[12] ? $myrow[12] : ' ' ?></td>
      <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[13] ? $myrow[13] : ' ' ?></td>
      <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[14] ? $myrow[14] : ' ' ?></td>
      <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[15] ? $myrow[15] : ' ' ?></td>
      <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[1] ? $myrow[1] : ' ' ?></td>
      <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[2] ? $myrow[2] : ' ' ?></td>
      <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[3] ? $myrow[3] : ' ' ?></td>
      <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[4] ? $myrow[4] : ' ' ?></td>
      <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[10] ? $myrow[10] : ' ' ?></td>
      <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[8] ? $myrow[8] : ' ' ?></td>
      <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[9] ? $myrow[9] : ' ' ?></td>
      </tr>
<?php
     $total = $total + $myrow[9];
  }

?>
      <tr bgcolor="#FFFFFF">
      <td colspan=12 align=right class=labeltext>Total Qty</td>
      <td align=center class=tabletext><?php echo $total ?></td>

   </tr>


<?php

 $row=mysql_fetch_object($cofc);
 $dimenssion=$row->dimensional;
 $ndt=$row->ndt;
 $visual=$row->visual;
 $grain=$row->grain;
 $mech=$row->mech;
 $conductivity=$row->conductivity;
 $chemical=$row->chemical;
 $hardness=$row->hardness;
 $quantity=$row->quantity;
 $temper=$row->temper;
 $cus=$row->cusserial;
 $from=$row->frmserial;
 $to=$row->toserial;
 $noncon=$row->noncon;
 $ncref=$row->ncref;
 $ncdate=$row->ncdate;
 $comm=$row->comm;
 $dcomm=$row->dcomm;
 $remarks=$row->remarks;
 $approval=$row->approval;

              if($ncdate != '0000-00-00' && $ncdate != '' && $ncdate != 'NULL')
              {
                  $datearr = split('-', $ncdate);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $date1=date("M j, Y",$x);
              }
              else
              {
                 $date1 = '';
              }
?>
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

 <tr bgcolor="#DDDEDD">
<td align="center" colspan=8><span class="heading"><b>Verification of Certificate of Compliance by RM Supplier</b></span></td>

        </tr>
		 <tr bgcolor="#FFFFFF">
	<td  width=30%> <span class="heading"><b><left>Standard for Verification</left></b></td>
	<td width=70% colspan=7> <span class="heading"><b><left></left></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		<td width=35%><span class="labeltext"><p align="left">Description</p></td>

	<td width=5%> <span class="labeltext"><p align="left">Yes</p></td>
	<td width=5%> <span class="labeltext"><p align="left">No</p></td>
	<td width=5%> <span class="labeltext"><p align="left">N/A</p></td>
	<td width=35%> <span class="labeltext"><p align="left">Description</p></td>
	<td width=5%> <span class="labeltext"><p align="left">Yes</p></td>
	<td width=5%> <span class="labeltext"><p align="left">No</p></td>
	<td width=5%> <span class="labeltext"><p align="left">N/A</p></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=35%><span class="tabletext"><p align="left">Dimensional Inspection</p></td>
	<td width=5%> <b><?php if($dimenssion==1){?><input name="dimensional" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($dimenssion==2){?><input name="dimensional" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($dimenssion==3){?><input name="dimensional" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=35%> <span class="tabletext"><p align="left">NDT Procedures correct,where applicable</p></td>
	<td width=5%> <b><?php if($ndt==1){?><input name="ndt" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($ndt==2){?><input name="ndt" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($ndt==3){?><input name="ndt" type="radio" value="1" checked="checked"><? }?></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=35%><span class="tabletext"><p align="left">Visual Examination for Omission of Damages</p></td>
	<td width=5%> <b><?php if($visual==1){?><input name="visual" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($visual==2){?><input name="visual" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($visual==3){?><input name="visual" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=35%> <span class="tabletext"><p align="left">Is Grain Flow Mentioned</p></td>
	<td width=5%> <b><?php if($grain==1){?><input name="grain" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($grain==2){?><input name="grain" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($grain==3){?><input name="grain" type="radio" value="1" checked="checked"><? }?></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Mechanical Properties verified against Standered</p></td>
	<td width=5%> <b><?php if($mech==1){?><input name="mechanical" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($mech==2){?><input name="mechanical" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($mech==3){?><input name="mechanical" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=30%> <span class="tabletext"><p align="left">Conductivity</p></td>
	<td width=5%> <b><?php if($conductivity==1){?><input name="conductivity" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($conductivity==2){?><input name="conductivity" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($conductivity==3){?><input name="conductivity" type="radio" value="1" checked="checked"><? }?></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Chemical Properties verified against Standered</p></td>
	<td width=5%> <b><?php if($chemical==1){?><input name="chemical" type="radio" value="1" checked="checked"></b><? }?></td>
	<td width=5%> <b><?php if($chemical==2){?><input name="chemical" type="radio" value="1" checked="checked"></b><? }?></b></td>
	<td width=5%> <b><?php if($chemical==3){?><input name="chemical" type="radio" value="1" checked="checked"></b><? }?></b></td>
	<td width=30%> <span class="tabletext"><p align="left">Hardness</p></td>
	<td width=5%> <b><?php if($hardness==1){?><input name="hardness" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($hardness==2){?><input name="hardness" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($hardness==3){?><input name="hardness" type="radio" value="1" checked="checked"><? }?></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Quantity received agrees with Certification</p></td>
	<td width=5%> <b><?php if($quantity==1){?><input name="quantity" type="radio" value="1" checked="checked"></b><? }?></td>
	<td width=5%> <b><?php if($quantity==2){?><input name="quantity" type="radio" value="1" checked="checked"></b><? }?></b></td>
	<td width=5%> <b><?php if($quantity==3){?><input name="quantity" type="radio" value="1" checked="checked"></b><? }?></b></td>
	<td width=30%> <span class="tabletext"><p align="left">Temper</p></td>
	<td width=5%> <b><?php if($temper==1){?><input name="temper" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($temper==2){?><input name="temper" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($temper==3){?><input name="temper" type="radio" value="1" checked="checked"><? }?></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">Serialization Requirements?</p></td>
<td width=10% colspan="2"><span class="tabletext"><p align="left">Customer Serialization</p></td>

	 <td  width="%"><span class="tabletext"><?php if($cus==1){?>Yes<input name="cus" type="radio" value="1" checked="checked" ><? }?><br>
  <span class="labeltext"><?php if($cus==2){?>No &nbsp;<input name="cus" type="radio" value="1" checked="checked" ><? }?></td>

	<td width=30%><span class="tabletext"><p align="left">CIM Serialization
	<span class="tabletext">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($cus==3){?>Yes<input name="cus" type="radio" value="1" checked="checked" ><? }?>
	<span class="tabletext"><?php if($cus==4){?>No<input name="cim" type="hidden" value="2" checked="checked"><input name="cus" type="radio" value="1" checked="checked" ><? }?>
	</p></td>
	<td width=8% colspan="2"> <span class="tabletext"><p align="left">Serialization not Required</p></td>
	<td width=3%> <b><?php if($cus==5){?><input name="cus" type="radio" value="1" checked="checked" ><? }?></b></td>
		</tr><input name="not" type="hidden" value="5" >
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="tabletext"><p align="left">If yes Mention Serial No. </p></td>
	<td width=5% colspan=2> <span class="tabletext"><p align="left">From </p></td>
	<td width=5%> <span class="tabletext"><p align="left"><? echo $from?>  </p></td>
	<td width=20% colspan=1> <span class="tabletext"><p align="left">To</p></td>
	<td width=20% colspan=3> <span class="tabletext"><p align="left"><span class="tabletext"><? echo $to?>  </p></td>

		</tr>
		<tr bgcolor="#DDDEDD">
    <td align="center" colspan=8><span class="heading"><b>Non-Conformance</b></span></td>
    <tr bgcolor="#DDDEDD">
    <td><span class="tabletext">
                          <a href="grndownloadxls.php?grnrecnum=<?php echo $grnrecnum ?>">Export To Excel</td>
     </tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Are any Non Conformance Observed</p></td>
	<td width=6%> <span class="labeltext"><b><?php if($noncon==1){?>Yes</b></span>
	<input name="conformance" type="radio" value="1" checked="checked"><? }?></td>
	<td width=5% colspan=2> <b><span class="labeltext"><b><?php if($noncon==2){?>No</b></span>
	<input name="conformance" type="radio" value="1" checked="checked"><? }?></b></span>

	</b></td>

	<td width=5% align=top><b><span class="labeltext">NCR Ref No.</b> </td>
    <td width=5% align=top><b><span class="tabletext"><?  echo $ncref?></span><br></td>
	<td width=5% align=top><b><span class="labeltext">NCR Date</b> </td>
    <td width=5% align=top><b><span class="tabletext"><?  echo $date1?>  </span></td>
     &nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30% colspan=4><span class="labeltext"><p align="left">Is the Observed Non-Conformance communicated to the respective authorities</p></td>
	<td colspan=6> <b><span class="labeltext"><?php if($comm==1){?>Yes<input name="comm" type="radio" value="1" checked="checked"><? }?></b>
	<span class="labeltext"><?php if($comm==2){?>No<input name="comm" type="radio" value="1" checked="checked"><? }?> <b></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Details of Communication</p></td>
	<td width=5% colspan=12> <span class="tabletext"><?  echo $dcomm?>  </span></td>

		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Additional Notes/Remarks</p></td>
	<td width=5% colspan=7> <span class="tabletext"><?  echo $remarks?>  </span></td>

		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Authorised Signatory With Date<br>
     (Store Department)</p></td>
	<td width=5% colspan=7 class=tabletext><?echo $approval?></td>

		</tr>

</table>
	</td>
    </tr>



     <tr bgcolor="#DDDEDD">
            <td height="34" colspan=8><span class="heading">
              <center><b>Material Issue</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">
             <td align=center><span class="labeltext">Line Num</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">WO Num</font></td>
             <td align=center><span class="labeltext">WO Date</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Issued</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Accepted</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">Rework</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Rejected</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Returned</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">Balance</font></td>
        </tr>
   <?php
       $i=1;
       while($myrow3 = mysql_fetch_row($result3))
       {
            if($myrow3[1] != '0000-00-00' && $myrow3[1] != '' && $myrow3[1] != 'NULL')
            {
              $datearr = split('-', $myrow3[1]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $date1=date("M j, Y",$x);
            }
            else
            {
               $date1 = '';
            }

   ?>
        <tr bgcolor="#FFFFFF">
             <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $i ?></td>
             <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow3[0] ?></td>
             <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $date1 ?></td>
             <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow3[6] ?></td>
             <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow3[2] ?></td>
             <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow3[3] ?></td>
             <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow3[4] ?></td>
             <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow3[5] ?></td>
             <td align=center><span class="tabletext"><?php echo ($total-$myrow3[6]+$myrow3[5]) ?></td>
         </tr>
   <?php
	   $total = $total-$myrow3[6]+$myrow3[5];
       $i++;
       }

   ?>



     <tr bgcolor="#FFFFFF">
       <td width=100% colspan=9>
         <table width=100% border=3 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
           <tr bgcolor="#FFFFFF">
             <td colspan=2><span class="labeltext"><?php echo $myrow2[31] ?></td>
             <td><span class="labeltext">Rev No : <?php echo $myrow2[32] ?></td>
             <td align=center colspan=2><span class="labeltext">&nbsp;</td>
           </tr>
         </table>
        </td>
     </tr>

</table>
</td>
		<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>

		</table>

</table>
</body>
</html>
