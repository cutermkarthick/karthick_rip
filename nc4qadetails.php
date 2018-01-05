<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2006                =
// Filename: nc4qadetails.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Displays QA NC Details                      =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$_SESSION['pagename'] = 'new_nc4qa';
$page="QA: NC";
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/nc4qaclass.php');
include('classes/displayClass.php');


$newlogin = new userlogin;
$newlogin->dbconnect();


$newdisplay = new display;
$newnc = new nc4qa;

$nc4qarecnum = $_REQUEST['nc4qarecnum'];

$result = $newnc->getqanc($nc4qarecnum);

$myrow = mysql_fetch_row($result);


?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/nc4qa.js"></script>


<html>
<head>
<script language="javascript" type="text/javascript">
function readOnlyRadio() {
   return false;
}

</script>
<title>QA NC Details</title>
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
 <table width=100% border=0 cellpadding=6 cellspacing=0>
    <tr>
        <td >
        <table width=100% border=0 cellpadding=6 cellspacing=0>
        <tr>
        <td ><span class="pageheading"><b>NC Details</b>
        <td bgcolor="#FFFFFF" align="right">
<?php
 if($dept == 'Sales' || $dept == 'QA' || $dept == 'PPC2')
 {?>
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='edit_nc4qa.php?nc4qarecnum=<?php echo $nc4qarecnum;?>'" value="Edit NC" >
 <!-- <a href ="edit_nc4qa.php?nc4qarecnum=<?php echo $nc4qarecnum ?>"><img name="Image8" border="0" src="images/edit_nc.gif" ></a> -->
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="javascript: printnc4qa(<?php echo $nc4qarecnum ?>)" value="Print" >
<!-- <input type= "image" name="Print" src="images/bu-print.gif" value="Print" onclick="javascript: printnc4qa(<?php echo $nc4qarecnum ?>)"> -->
</td>
<?
 }
 else if($dept == 'Production' && $myrow[40] !='Closed')
 {
 ?>
 <a href ="edit_nc4qa.php?nc4qarecnum=<?php echo $nc4qarecnum ?>"><img name="Image8" border="0" src="images/edit_nc.gif" ></a>
</td>
<?php
 }
 else if($dept == 'PPC1' || $dept == 'PPC2')
 {?>
<input type= "image" name="Print" src="images/bu-print.gif" value="Print" onclick="javascript: printnc4qa(<?php echo $nc4qarecnum ?>)">
</td>
 <?}?>
        </tr>
       </table>

    </tr>

<tr>
<td>
<table width=100% border=0 cellpadding=6 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>NC Header</b></center></td>

</td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">

        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">Id No.</p></font></td>
             <td width=25%><span class="tabletext"><?php printf("%05d", $myrow[0]) ?></td>
             <td width=25%><span class="labeltext"><p align="left">Create Date</p></font></td>
             <?php
             if($myrow[30] != '0000-00-00' && $myrow[30] != '' && $myrow[30] != 'NULL')
            {
              $datearr = split('-', $myrow[30]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $cr_date=date("M j, Y",$x);
            }
           else
           {
              $cr_date = '';
           }
          // echo  $myrow[30];
          ?>

             <td width=25%><span class="tabletext"><?php echo $cr_date ?></td>
         </tr>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Stage #</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[46] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">WO No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[11] ?></td>
            <td width=25%><span class="labeltext"><p align="left">Host Ref Num.</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow[1] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">WO Type</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[44] ?></td>
            <td width=25%><span class="labeltext"><p align="left">DN #</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow[45] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[3] ?></td>
            <td><span class="labeltext"><p align="left">Batch No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[4] ?>
            </td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[5] ?></td>
            <td><span class="labeltext"><p align="left">Matl. Spec</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[6] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">Customer</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow[2] ?></td>
            <td><span class="labeltext"><p align="left">Qty</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[8] ?></td>
        </tr>
        
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">PO No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[9] ?></td>
            <td><span class="labeltext"><p align="left">Part Sl No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[10] ?></td>
        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Issue & PS</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[7] ?></td>
            <td><span class="labeltext"><p align="left">DC No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[12] ?></td>
        </tr>

         <tr bgcolor="#FFFFFF">
          <?php 
            if($myrow[13] != '0000-00-00' && $myrow[13] != '' && $myrow[13] != 'NULL')
            {
              $datearr = split('-', $myrow[13]);
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
           if($myrow[34] != '0000-00-00' && $myrow[34] != '' && $myrow[34] != 'NULL' && $myrow[34] != '0')
            {
              $datearr = split('-', $myrow[34]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $custncdate=date("M j, Y",$x);
            }
           else
           {
              $custncdate = '';
           }
  ?>
            <td><span class="labeltext"><p align="left">DC Date</p></font></td>
            <td><span class="tabletext"><?php echo $date1 ?></td>
            <td><span class="labeltext"><p align="left">C of C No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[29] ?></td>
        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Supervisor Name</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[31] ?></td>
            <td><span class="labeltext"><p align="left">Operator Name</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[32] ?></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Cust NC#</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[33] ?></td>
            <td><span class="labeltext"><p align="left">Cust NC Date</p></font></td>
            <td><span class="tabletext"><?php echo $custncdate ?></td>
        </tr>

		    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">RM Cost</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[39].' '.$myrow[38] ?></td>
            <td><span class="labeltext"><p align="left">Status</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[40]?></td>
			</tr>

			<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Machine Name</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[48] ?></td>
			<td><span class="labeltext"><p align="left">Created By</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[49] ?></td>
			</tr>

       <tr bgcolor="#FFFFFF">
       <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>Remarks/Attachment:</b><br>
       <span class="tabletext"> <?php echo $myrow[35] ?>
       </td>
       </tr>



<!--<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>-->
<tr bgcolor="#FFFFFF">


<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
 <tr bgcolor="#DDDEDD">
    <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">ERROR TYPE</td>
    <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">CAUSE</td>
     <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">STAGE</td>
     <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">DISPOSITION</td>
   </tr>
   <td bgcolor="#FFFFFF" width=20%><span class="labeltext">DIMENSIONAL DEVIATION</td>
   <?php

   $checked1="";
   
   if($myrow[15] == 'yes'){
   $checked1="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked1 ?> name="dim_deviation" onClick="return readOnlyRadio()"></td>
   <td bgcolor="#FFFFFF" width=20%><span class="labeltext">MAN</td>
    <?php

   $checked2="";

   if($myrow[16] == 'yes'){
   $checked2="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked2 ?>  name="man" onClick="return readOnlyRadio()"></td>
   <td bgcolor="#FFFFFF"  width=20%><span class="labeltext">IN PROCESS</td>
   <?php

   $checked3="";

   if($myrow[17] == 'yes'){
   $checked3="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked3 ?> name="inprocess" onClick="return readOnlyRadio()"></td>
 <td bgcolor="#FFFFFF"  width=20%><span class="labeltext">ACCEPTED</td>
   <?php

   $checked3="";

   if($myrow[41] == 'yes'){
   $checked3="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked3 ?> name="accepted" onClick="return readOnlyRadio()"></td>

</tr>
<tr>
  <td bgcolor="#FFFFFF"><span class="labeltext">MATERIAL DEVIATION</td>
  <?php

   $checked4="";

   if($myrow[18] == 'yes'){
   $checked4="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked4 ?>  name="mat_deviation" onClick="return readOnlyRadio()"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">MACHINE</td>
   <?php

   $checked5="";

   if($myrow[19] == 'yes'){
   $checked5="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked5 ?> name="machine" onClick="return readOnlyRadio()"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">FINAL INSPECTION</td>
   <?php

   $checked6="";

   if($myrow[20] == 'yes'){
   $checked6="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked6 ?> name="final_insp" onClick="return readOnlyRadio()"></td>
 <td bgcolor="#FFFFFF"  width=20%><span class="labeltext">REJECTED</td>
   <?php

   $checked3="";

   if($myrow[42] == 'yes'){
   $checked3="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked3 ?> name="rejected" onClick="return readOnlyRadio()"></td>

</tr>
<tr>
  <td bgcolor="#FFFFFF"><span class="labeltext">OTHER DEVIATION</td>
  <?php

   $checked7="";

   if($myrow[21] == 'yes'){
   $checked7="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked7 ?> name="other_deviation" onClick="return readOnlyRadio()"></td>

   <td bgcolor="#FFFFFF"><span class="labeltext">METHOD</td>
   <?php

   $checked8="";

   if($myrow[22] == 'yes'){
   $checked8="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked8 ?> name="method" onClick="return readOnlyRadio()"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">CUSTOMER END</td>
   <?php

   $checked9="";

   if($myrow[23] == 'yes'){
   $checked9="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked9 ?> name="cust_end" onClick="return readOnlyRadio()"></td>
 <td bgcolor="#FFFFFF"  width=20%><span class="labeltext">QUARANTINED</td>
   <?php

   $checked3="";

   if($myrow[43] == 'yes'){
   $checked3="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked3 ?> name="quarantined" onClick="return readOnlyRadio()"></td>

</tr>

<tr>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
 <td bgcolor="#FFFFFF"  width=20%><span class="labeltext">REWORK</td>
   <?php

   $checked3="";

   if($myrow[47] == 'yes'){
   $checked3="checked";
   }
   ?>
  <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked3 ?> name="rework" onClick="return readOnlyRadio()"></td>

</tr>

<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Brief Description of Non Conformance:</b><br>
    <span class="tabletext"> <?php echo wordwrap($myrow[24],100,"<br />\n"); ?>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Root Cause:</b><br>
    <span class="tabletext"> <?php echo wordwrap($myrow[25],100,"<br />\n"); ?>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Corrective Action:</b><br>
    <span class="tabletext"><?php echo wordwrap($myrow[26],100,"<br />\n"); ?>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Preventive Action:</b><br>
    <span class="tabletext"><?php echo wordwrap($myrow[27],100,"<br />\n"); ?>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Effectiveness:</b><br>
    <span class="tabletext"> <?php echo wordwrap($myrow[28],100,"<br />\n"); ?>
    </td>
</tr>
</table>
	</td>
    </tr>


    </td>

     <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">

         <tr bgcolor="#FFFFFF">


        </tr>


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

</table>
</body>
</html>
