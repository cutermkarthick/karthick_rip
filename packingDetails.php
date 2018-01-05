<?
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'packingdetails';
//////session_register('pagename');

include('classes/packingClass.php');
include('classes/packingliClass.php');
include('classes/displayClass.php');
$newPO = new packing;
$newli = new packingli;
$newdisp = new display;
$recnum=$_REQUEST['recnum'];
$result=$newPO->getpackingdetails($recnum);
$myrow=mysql_fetch_assoc($result);
//$myrowli=$newli->getpackinglidetails($recnum);
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/packing.js"></script>
<html>
<head>
<title>Packing Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<!--<form  action='processPacking.php' method='post' enctype='multipart/form-data'>-->
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
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
?>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif" width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr><td>
<table width=100% border=0>
<tr>
<td bgcolor="#FFFFFF" align="right">
          <a href ="packingEdit.php?recnum=<?php echo $recnum ?>" ><img name="Image8" border="0" src="images/editpacking.gif" ></a>
          <input type= "image" name="Print" src="images/bu-print.gif" value="Print" onClick="javascript: printpacking(<?php echo $recnum ?>)">
          <a href="exportPacking.php?recnum=<?echo $_REQUEST['recnum']?>"><img name="Image8" border="0" src="images/export.gif" ></a></td>

</td>
</tr>
<tr>
<td><span class="pageheading"><b>Packing Details</b></td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr>  </table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
<td><span class="labeltext"><?php echo $myrow['name'] ?></td>
                    <input type="hidden" name="companyrecnum" id="companyrecnum"></td>
</td>
<td width=15%><span class="labeltext"><p align="left">Packing No.</p></td>
<td ><span class="tabletext"><?php echo $myrow['packingnum'] ?></td>

</tr>
<tr bgcolor="#FFFFFF">
<!--<td width=15%><span class="labeltext"><p align="left">PO #</p></td>
<td ><span class="tabletext"><?php echo $myrow['ponum'] ?></td>-->
<?php
if($myrow['podate'] !='0000-00-00' && $myrow['podate'] !='')
{
  $datearr=split('-',$myrow['podate']);
  $d= $datearr[2];
  $m=$datearr[1];
  $y=$datearr[0];
  $x=mktime(0,0,0,$m,$d,$y);
  $podate=date("M j, Y",$x);
}
else
{
  $podate='';
}
if($myrow['pack_date'] !='0000-00-00' && $myrow['pack_date'] !='')
{
  $datearr=split('-',$myrow['pack_date']);
  $d= $datearr[2];
  $m=$datearr[1];
  $y=$datearr[0];
  $x=mktime(0,0,0,$m,$d,$y);
  $pdate=date("M j, Y",$x);
}
else
{
  $pdate='';
}


?>
<td width=15%><span class="labeltext"><p align="left">PO Date</p></td>
<td colspan=3><span class="tabletext"><?php echo $podate ?>
</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">CIM Invoice No.</p></td>
<td ><span class="tabletext"><?php echo $myrow['cim_invoice'] ?></td>
<td width=15%><span class="labeltext"><p align="left">Work Order #</p></td>
<td ><span class="tabletext"><?php echo $myrow['wonum'] ?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Item Description</p></td>
<td colspan=3><span class="tabletext"><?php echo $myrow['descr'] ?></td>
</tr>
</table>
<br>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<td width="7%"><span class="labeltext"><p align="left">Ponum</p></td>
<td width="7%"><span class="labeltext"><p align="left">Order Qty.</p></td>
<td width="7%"><span class="labeltext"><p align="left">Qty This<br>Shipment</p></td>
<td width="7%"><span class="labeltext"><p align="left">Bal Qty To Be <br>Dispatch</p></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width="7%"><span class="tabletext"><?php echo $myrow['ponum'] ?></td>
<td width="7%"><span class="tabletext"><?php echo $myrow['order_qty'] ?></td>
<td width="7%"><span class="tabletext"><?php echo $myrow['qty_dispatch'] ?></td>
<td width="7%"><span class="tabletext"><?php echo $myrow['qty_balance'] ?></td>
</tr>

<?
$resultqtyli=$newli->getpackingqtylidetails($recnum);
	  $i=1; $flag_qty=0;

     if($flag_qty==0)
     {
     while($myrowqtyli=mysql_fetch_row($resultqtyli))
     {

	 echo(' <tr bgcolor="#FFFFFF">');
       //$remarks="remarks".$x;

       echo "<td width=7%><span class=tabletext>$myrowqtyli[2]</td>";

		   echo "<td width=7%><span class=tabletext>
		   $myrowqtyli[3]</td>";
		   echo "<td width=7%><span class=tabletext>
		   $myrowqtyli[4]</font></td>";
			echo "<td width=7%><span class=tabletext>
		$myrowqtyli[5]</td>";

     printf('</tr>');
    		$i++;
		   }
      $flag=1;
    }

?>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">

<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Packing List Dated:</p></td>
<td colspan=3><span class="tabletext"><?php echo $pdate ?>
</td>
</tr>
</table>
<br>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">No. Of Packings</p></td>
<td width=45%><span class="labeltext"><p align="left">Type Of Packing And Contents</p></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="tabletext"><b><?php echo $myrow['no_packings'] ?></b></td>
<td width=45%><span class="tabletext"><?php echo $myrow['type_packing'] ?></td>
</tr>
</table>
<br>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 id="tablemm">
<tr>
            <td colspan=18><span class="heading"><center><b>Packing Details</b></center></td>
        </tr>
		  <tr bgcolor="#FFFFFF">
		 <td width="5%"><span class="heading">
           <p align="left"><b>Seq</b></p></font></td>

		   		<td width="7%"><span class="heading">
		   <p align="left"><b>Length<br>(In Inches)</b></p></font></td>

             <td width="7%"><span class="heading">
		   <p align="left"><b>Width<br>(In Inches)</b></p></font></td>

		   	<td width="7%"><span class="heading">
		   <p align="left"><b>Thickness<br>(In Inches)</b></p></font></td>

		     <td width="7%"><span class="heading">
            <p align="left"><b>Nett Weight</b></p></font></td>

            <td width="7%"><span class="heading">
            <p align="left"><b>Total Weight</b></p></font></td>

	            <td width="7%"><span class="heading">
            <p align="left"><b>No. of Boxes</b></p></font></td>

           </tr>
<?
	  $x=1;
	  $resultli=$newli->getpackinglidetails($recnum);
	            $totnettwt = 0;
          $totgrosstwt = 0;

	  while($myrowli=mysql_fetch_row($resultli))
	  {
            $totnettwt += $myrowli[5];
            $totgrosstwt += $myrowli[6];

	 echo(' <tr bgcolor="#FFFFFF">');
       //$remarks="remarks".$x;
			echo "
			<td width=5%><span class=tabletext>
           <p align=left>$myrowli[1]</p></font></td>
		   <td width=7%><span class=tabletext>
		   <p align=left>$myrowli[2] </p></font></td>
		   <td width=7%><span class=tabletext>
		   <p align=left>$myrowli[3] </p></font></td>
		   <td width=7%><span class=tabletext>
		   <p align=left>$myrowli[4]</p></font></td>
			<td width=7%><span class=tabletext>
			<p align=left>$myrowli[5]</p></font></td>
             <td width=7%><span class=tabletext>
			<p align=left>$myrowli[6] </p></font></td>
            <td width=7%><span class=tabletext>
			<p align=left>$myrowli[8] </p></font></td>


     </tr> ";
    	//<td width=30%><span class=tabletext>
		   //<p align=left><b><input name=$remarks type=text size=50></b></p></font></td>
	$x++;
    }
				echo "<tr>
			<td colspan=4 align=\"right\"><span class=labeltext><b>Total&nbsp&nbsp</b></font></td>
			<td><span class=tabletext><b>$totnettwt</b></font></td>
             <td><span class=tabletext><b>$totgrosstwt</b></font></td></tr>
               ";
    echo "<input type=\"hidden\" name=\"index\" id=\"index\" value=$x>";
    echo "<input type=\"hidden\" name=\"curindex\" id=\"curindex\" value=$x>";

?>

</table>
<br>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<td width=19%><span class="labeltext">
            <p align="left">Remarks</p></font></td>
<td width=45%><span class=tabletext>
<p align=left><?php echo $myrow['remarks'] ?></p></font></td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=15%><span class="labeltext"><p align="left">Transportation By:</p></td>
<td><span class="tabletext"><?php echo $myrow['transportation'] ?></span></td></tr>
</table>
</td>
 <table border=3 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
            <td colspan=2><span class="labeltext"><?php echo $myrow["formrev"] ?></td>
            <td colspan=2><span class="labeltext">CIMTOOLS PRIVATE LIMITED</td>
        </tr>

</table>
		<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>
		</table>
      </FORM>
</table>
</body>
</html>

