<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 21, 2007                 =
// Filename: printqualityplanDetails.php       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// print Quality Plan Details                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'grndetails';
//////session_register('pagename');

// First include the class definition

include('classes/grnclass.php');
include('classes/displayClass.php');
include('classes/userClass.php');
include('classes/grncofcclass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newgrn = new grn;
$newdisplay = new display;
$newcofc=new cofc;
$grnrecnum = $_REQUEST['grnrecnum'];


$result = $newgrn->getgrn($grnrecnum);
$myrow = mysql_fetch_row($result);
$grnli = $newgrn->getgrnli($grnrecnum);
$cofc=$newcofc->getcofc($grnrecnum);

$result2 = $newgrn->getgrn($grnrecnum);
$myrow2 = mysql_fetch_row($result2);

$result3 = $newgrn->getgrn_issue($grnrecnum);
?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>
<!--<div style='overflow:scroll; width:100%; height:700'>-->
<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">GRN</A></b></center></td></tr>
</table>

<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>GRN Header</b></center></td>
        </tr>
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

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
            <td><span class="labeltext"><p align="left">No. of Pieces</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[10] ?></td>
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
             if($myrow[15] != '' && $myrow[15] != '0000-00-00')
             {
              $d=substr($myrow[15],8,2);
              $m=substr($myrow[15],5,2);
              $y=substr($myrow[15],0,4);
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
            <td><span class="labeltext"><p align="left">MGP/DC No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[18] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">COC Ref#</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[26] ?></td>
            <td><span class="labeltext"><p align="left">CIM PO Num</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[30] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">RM by Host</p></font></td>
             <td><span class="tabletext"><?php echo $myrow[28] ?></td>
            <td><span class="labeltext"><p align="left">RM by Cust</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[29] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">PRN</p></font></td>
             <td><span class="tabletext"><?php echo $myrow[36] ?></td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
        </tr>

<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Unit RM Size</b></center></td>
</tr>

<tr bgcolor="#FFFFFF">


<table id="myTable" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Seq No.</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim1<br>Length</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim2<br>Width/ID</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim3<br>Thickness/OD</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Wos Assigned</center></b></td>
   <td bgcolor="#EEEFEE" colspan=3><span class="heading"><b><center>Qty Left</center></b></td>
</tr>

<?php

  while ($myrow = mysql_fetch_row($grnli))
  {
?>
      <tr>
      <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[0] ? $myrow[0] : ' ' ?></td>
      <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[1] ? $myrow[1] : ' ' ?></td>
      <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[2] ? $myrow[2] : ' ' ?></td>
      <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[3] ? $myrow[3] : ' ' ?></td>
      <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[4] ? $myrow[4] : ' ' ?></td>
      <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow[5] ? $myrow[5] : ' ' ?></td>
      <td bgcolor="#FFFFFF" align=center colspan=3><span class="tabletext"><?php echo $myrow[6] ? $myrow[6] : ' ' ?></td>
      </tr>
<?php
  }
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

             if($ncdate != '' && $ncdate != '0000-00-00')
             {
              $d=substr($ncdate,8,2);
              $m=substr($ncdate,5,2);
              $y=substr($ncdate,0,4);
              $x=mktime(0,0,0,$m,$d,$y);
              $date1=date("M j, Y",$x);
             }
             else
             {
               $date1 = '';
             }
        
?>

 <tr bgcolor="#DDDEDD">
<td align="center" colspan=8><span class="heading"><b>Validation of Certificate of Compliance by RM Supplier</b></span></td>

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
		 <td width=35%><span class="labeltext"><p align="left">Dimensional Inspection</p></td>
	<td width=5%> <b><?php if($dimenssion==1){?><input name="dimensional" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($dimenssion==2){?><input name="dimensional" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($dimenssion==3){?><input name="dimensional" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=35%> <span class="labeltext"><p align="left">NDT Procedures correct,where applicable</p></td>
	<td width=5%> <b><?php if($ndt==1){?><input name="ndt" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($ndt==2){?><input name="ndt" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($ndt==3){?><input name="ndt" type="radio" value="1" checked="checked"><? }?></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=35%><span class="labeltext"><p align="left">Visual Examination for Omission of Damages</p></td>
	<td width=5%> <b><?php if($visual==1){?><input name="visual" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($visual==2){?><input name="visual" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($visual==3){?><input name="visual" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=35%> <span class="labeltext"><p align="left">Is Grain Flow Mentioned</p></td>
	<td width=5%> <b><?php if($grain==1){?><input name="grain" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($grain==2){?><input name="grain" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($grain==3){?><input name="grain" type="radio" value="1" checked="checked"><? }?></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Mechanical Properties verified against Standered</p></td>
	<td width=5%> <b><?php if($mech==1){?><input name="mechanical" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($mech==2){?><input name="mechanical" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($mech==3){?><input name="mechanical" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=30%> <span class="labeltext"><p align="left">Conductivity</p></td>
	<td width=5%> <b><?php if($conductivity==1){?><input name="conductivity" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($conductivity==2){?><input name="conductivity" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($conductivity==3){?><input name="conductivity" type="radio" value="1" checked="checked"><? }?></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Chemical Properties verified against Standered</p></td>
	<td width=5%> <b><?php if($chemical==1){?><input name="chemical" type="radio" value="1" checked="checked"></b><? }?></td>
	<td width=5%> <b><?php if($chemical==2){?><input name="chemical" type="radio" value="1" checked="checked"></b><? }?></b></td>
	<td width=5%> <b><?php if($chemical==3){?><input name="chemical" type="radio" value="1" checked="checked"></b><? }?></b></td>
	<td width=30%> <span class="labeltext"><p align="left">Hardness</p></td>
	<td width=5%> <b><?php if($hardness==1){?><input name="hardness" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($hardness==2){?><input name="hardness" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($hardness==3){?><input name="hardness" type="radio" value="1" checked="checked"><? }?></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Quantity received agrees with Certification</p></td>
	<td width=5%> <b><?php if($quantity==1){?><input name="quantity" type="radio" value="1" checked="checked"></b><? }?></td>
	<td width=5%> <b><?php if($quantity==2){?><input name="quantity" type="radio" value="1" checked="checked"></b><? }?></b></td>
	<td width=5%> <b><?php if($quantity==3){?><input name="quantity" type="radio" value="1" checked="checked"></b><? }?></b></td>
	<td width=30%> <span class="labeltext"><p align="left">Temper</p></td>
	<td width=5%> <b><?php if($temper==1){?><input name="temper" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($temper==2){?><input name="temper" type="radio" value="1" checked="checked"><? }?></b></td>
	<td width=5%> <b><?php if($temper==3){?><input name="temper" type="radio" value="1" checked="checked"><? }?></b></td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Serialization Requirements?</p></td>
<td width=10% colspan="2"><span class="labeltext"><p align="left">Customer Serialization</p></td>
	
	 <td  width="%"><span class="labeltext"><?php if($cus==1){?>Yes<input name="cus" type="radio" value="1" checked="checked" ><? }?><br>
  <span class="labeltext"><?php if($cus==2){?>No &nbsp;<input name="cus" type="radio" value="1" checked="checked" ><? }?></td>

	<td width=30%><span class="labeltext"><p align="left">CIM Serialization
	<span class="labeltext">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($cus==3){?>Yes<input name="cus" type="radio" value="1" checked="checked" ><? }?>
	<span class="labeltext"><?php if($cus==4){?>No<input name="cim" type="hidden" value="2" checked="checked"><input name="cus" type="radio" value="1" checked="checked" ><? }?>
	</p></td>
	<td width=8% colspan="2"> <span class="labeltext"><p align="left">Serialization not Required</p></td>
	<td width=3%> <b><?php if($cus==5){?><input name="cus" type="radio" value="1" checked="checked" ><? }?></b></td>
		</tr><input name="not" type="hidden" value="5" >
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">If yes Mention Serial No. </p></td>
	<td width=5% colspan=2> <span class="labeltext"><p align="left">From </p></td>
	<td width=5%> <span class="tabletext"><p align="left"><?  echo $from?>  </p></td>
	<td width=20% colspan=4> <span class="labeltext"><p align="left">To </b> <span class="tabletext"><?  echo $to?>  </p></td>
	
	  
		</tr>
		<tr bgcolor="#DDDEDD">
<td align="center" colspan=8><span class="heading"><b>Non-Conformance</b></span></td>

        </tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30%><span class="labeltext"><p align="left">Are any Non Conformance Observed</p></td>
	<td width=6%> <span class="labeltext"><b><?php if($noncon==1){?>Yes</b></span>
	<input name="conformance" type="radio" value="1" checked="checked"><? }?></td>
	<td width=5% colspan=2> <b><span class="labeltext"><b><?php if($noncon==2){?>No</b></span>
	<input name="conformance" type="radio" value="1" checked="checked"><? }?></b></span>
	
	</b></td>
	
	<td width=5% colspan=4 align=top><b><span class="labeltext">NCR Ref No.</b> <span class="tabletext"><?  echo $ncref?>  </span><br>
	<span class="labeltext">NCR Date</b> <span class="tabletext"><?  echo $date1?>  </span>
     &nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr bgcolor="#FFFFFF">
		 <td width=30% colspan=4><span class="labeltext"><p align="left">Is the Observed Non-Conformance communicated to the respective authorities</p></td>
	<td colspan=6> <b><span class="labeltext"><?php if($comm==1){?>Yes<input name="comm" type="radio" value="1" checked="checked"><? }?></b>
	<span class="labeltext"><?php if($comm==1){?>No<input name="comm" type="radio" value="1" checked="checked"><? }?> <b></b></td>
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
<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">
             <td align=center><span class="labeltext">Line Num</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">WO Num</font></td>
             <td align=center><span class="labeltext">WO Date</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Issued</font></td>

             <td bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Accepted</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Rejected</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">QTY Returned</font></td>
             <td bgcolor="#FFFFFF" align=center><span class="labeltext">Balance</font></td>
        </tr>
   <?php
       while($myrow3 = mysql_fetch_row($result3))
       {
   ?>
        <tr bgcolor="#FFFFFF">
             <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow3[9] ?></td>
             <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow3[3] ?></td>
             <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow3[1] ?></td>
             <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow3[2] ?></td>

             <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow3[4] ?></td>
             <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow3[5] ?></td>
             <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow3[6] ?></td>
             <td align=center><span class="tabletext"><?php echo $myrow3[7] ?></td>
         </tr>

   <?php
       }
   ?>



          <tr bgcolor="#FFFFFF">
       <td width=100% colspan=8>
         <table width=100% border=3 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
           <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><?php echo $myrow2[31] ?></td>
             <td><span class="labeltext">Rev No : <?php echo $myrow2[32] ?></td>
             <td align=center><span class="labeltext"></td>
           </tr>
         </table>
        </td>
     </tr>

</table>
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
 <!--</div>-->
</body>
</html>
