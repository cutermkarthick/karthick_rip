<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 20, 2007                 =
// Filename: qualityplanDetails.php            =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Quality Plan Details                        =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];
$_SESSION['pagename'] = 'final_insp_details';
//////session_register('pagename');
$page = "QA: Final Insp";

$final_insprecnum = $_REQUEST['final_insprecnum'];

include('classes/Final_insp_reportClass.php');
include('classes/Final_insp_reportliClass.php');
include('classes/displayClass.php');

$newdisplay = new display;
$newFIR = new final_insp_report;
$newLI = new final_insp_reportli;

$result = $newFIR->getFinal_insp($final_insprecnum);
$myrow = mysql_fetch_assoc($result);
$myFI = $newLI->getLI($final_insprecnum);
$myFI1= $newLI->getLI($final_insprecnum);
$myFI2 = $newLI->getLI($final_insprecnum);

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/final_insp.js"></script>

<html>
<head>
<title>Final Inspection Report Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
       <tr>
          <td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
          <td align="right">&nbsp;
          <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
       </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>

<?php  $newdisplay->dispLinks(''); ?>

</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
<td><span class="pageheading"><b>Final Inspection Report Details</b><td colspan=250></td>
    <td bgcolor="#FFFFFF" rowspan=2 align="right">
      <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='edit_final_insp.php'" value="Edit" >
          <!-- <a href ="edit_final_insp.php?final_insprecnum=<?php echo $final_insprecnum ?>" ><img name="Image8" border="0" src="images/bu_editfinal.gif" ></a> -->
          <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="javascript: printfinal_insp(<?php echo $final_insprecnum ?>)" value="Print" >
         <!--  <input type= "image" name="Print" src="images/bu-print.gif" value="Print" onclick="javascript: printfinal_insp(<?php echo $final_insprecnum ?>)"> -->
</td>
  </tr>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6 class="stdtable1">
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>

  <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">

        <?php
      if($myrow['billdate'] != '0000-00-00' && $myrow['billdate'] != '' && $myrow['billdate'] != 'NULL')
      {
              $datearr = split('-', $myrow['billdate']);
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
      if($myrow['approved_date'] != '0000-00-00' && $myrow['approved_date'] != '' && $myrow['approved_date'] != 'NULL')
      {
              $datearr = split('-', $myrow['approved_date']);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
         $x=mktime(0,0,0,$m,$d,$y);
         $appdate=date("M j, Y",$x);
      }
      else
      {
        $appdate = '';
      }    

        ?>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Id No.</p></font></td>
            <td colspan=4><span class="tabletext"><?php printf("%05d", $myrow['recnum'])?></td>
         </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Host Ref Num.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['refnum']?></td>
             <td><span class="labeltext"><p align="left">WO No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['wonum']?></td>

        </tr>

        <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left">Customer</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['customer']?>
            </td>
            <td><span class="labeltext"><p align="left">PO No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['ponum']?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['partname']?></td>
            <td><span class="labeltext"><p align="left">Part No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['partnum']?>
            </td>
        </tr>
        
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Bill No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['billnum']?></td>
            <td><span class="labeltext"><p align="left">Bill Date</p></font></td>
            <td><span class="tabletext"><?php echo $date?></td>
        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Issue</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['issue']?></td>
            <td><span class="labeltext"><p align="left">Report No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['reportnum']?></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Page.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['page']?></td>
            <td><span class="labeltext"><p align="left">Qty.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow['qty']?></td>
        </tr>


      </table>

 <br>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
   <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Sl No.</center></b></td>
   <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>DRG Sheet</center></b></td>
   <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>DIM Map</center></b></td>
   <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Dimensions Main View</center></b></td>
   <td bgcolor="#EEEFEE" colspan=3><span class="heading"><b><center>Actual Dimensions</center></b></td>
   <td bgcolor="#EEEFEE" rowspan=2><span class="heading"><b><center>Accept/Reject</center></b></td>
</tr>

 <tr>

<?php

     $i = 1;
    while ($FI = mysql_fetch_assoc($myFI))
    {
      if($i == 1)
      {

      $slnum1 = $FI['slnum1'];
      $slnum2 = $FI['slnum2'];
      $slnum3 = $FI['slnum3'];


     echo "<td bgcolor=\"#EEEFEE\" width=15%><span class=\"heading\"><b>Sl No:&nbsp;</b> $slnum1</td>";
     echo "<td bgcolor=\"#EEEFEE\" width=15%><span class=\"heading\"><b>Sl No:&nbsp;</b> $slnum2</td>";
     echo "<td bgcolor=\"#EEEFEE\" width=15%><span class=\"heading\"><b>Sl No:&nbsp;</b> $slnum3</td>";

     }
     $i++;
   }
?>

</tr>

<?php
 $i = 1;
    while ($FI = mysql_fetch_assoc($myFI1))
    {

	printf('<tr bgcolor="#FFFFFF">');
	
    $slno = $FI["slno"];
	$sheet = $FI["sheet"];
	$map = $FI["map"];
    $main_view = $FI["main_view"];
    $actual_dim1 = $FI["actual_dim1"];
    $actual_dim2 = $FI["actual_dim2"];
    $actual_dim3 = $FI["actual_dim3"];
    $accpt_reject = $FI["accpt_reject"];

	echo "<td align=\"left\"><span class=\"tabletext\">$slno</td>";
	echo "<td align=\"left\" width=15%><span class=\"tabletext\">$sheet</td>";
	echo "<td align=\"left\" width=15%><span class=\"tabletext\">$map</td>";
	echo "<td align=\"left\" width=15%><span class=\"tabletext\">$main_view</td>";
    echo "<td align=\"left\" width=15%><span class=\"tabletext\">$actual_dim1</td>";
    echo "<td align=\"left\" width=15%><span class=\"tabletext\">$actual_dim2</td>";
    echo "<td align=\"left\" width=15%><span class=\"tabletext\">$actual_dim3</td>";
    echo "<td align=\"left\" width=15%><span class=\"tabletext\">$accpt_reject</td>";
	printf('</tr>');


	$i++;
    }

?>



<?php

$i=1;

   while ($FI = mysql_fetch_assoc($myFI2))
   {
     if($i ==1)
     {

      if($FI['insp_date1'] != '0000-00-00' && $FI['insp_date1'] != '' && $FI['insp_date1'] != 'NULL')
      {
              $datearr = split('-', $FI['insp_date1']);
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
      if($FI['insp_date2'] != '0000-00-00' && $FI['insp_date2'] != '' && $FI['insp_date2'] != 'NULL')
      {
              $datearr = split('-', $FI['insp_date2']);
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

      if($FI['insp_date3'] != '0000-00-00' && $FI['insp_date3'] != '' && $FI['insp_date3'] != 'NULL')
      {
              $datearr = split('-', $FI['insp_date3']);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
         $x=mktime(0,0,0,$m,$d,$y);
         $date3=date("M j, Y",$x);
      }
      else
      {
        $date3 = '';
      }


?>



       <tr bgcolor="#FFFFFF">
            <td align=centre colspan=4><span class="labeltext"><p align="centre">Inspected By:</p></font></td>
            <td><span class="tabletext"><?php echo $FI['insp_by1']?></td>
            <td><span class="tabletext"><?php echo $FI['insp_by2']?></td>
            <td colspan=2><span class="tabletext"><?php echo $FI['insp_by3']?></td>
        </tr>

       <tr bgcolor="#FFFFFF">
            <td align=centre colspan=4><span class="labeltext"><p align="centre">Inspected Date:</p></font></td>
            <td><span class="tabletext"><?php echo $date1?></td>
            <td><span class="tabletext"><?php echo $date2?></td>
            <td colspan=2><span class="tabletext"><?php echo $date3?></td>
       </tr>

<?php
   }
   $i++;
}
?>
     <tr bgcolor="#FFFFFF">
           <td align=centre colspan=4><span class="labeltext"><p align="centre">Approved By:</p></td>
           <td colspan=4><span class="tabletext"><?php echo $myrow['approved_by']?></td>
     </tr>
     
     <tr bgcolor="#FFFFFF">
           <td align=centre colspan=4><span class="labeltext"><p align="centre">Approved Date:</p></td>
           <td colspan=4><span class="tabletext"><?php echo $appdate?></td>
     </tr>


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
