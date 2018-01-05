<?
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'printPacking';
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
      if($myrow['podate'] != '0000-00-00' && $myrow['podate'] != '' && $myrow['podate']!= 'NULL')
      {
              $datearr = split('-', $myrow['podate']);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
       $x=mktime(0,0,0,$m,$d,$y);
       $podate=date("M j, Y",$x);
      }
      else
      {
        $podate = '';
      }
      if($myrow['pack_date'] != '0000-00-00' && $myrow['pack_date'] != '' && $myrow['pack_date']!= 'NULL')
      {
              $datearr = split('-', $myrow['pack_date']);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
       $x=mktime(0,0,0,$m,$d,$y);
       $packdate=date("M j, Y",$x);
      }
      else
      {
        $packdate = '';
      }

?>
<link rel="stylesheet" href="style.css">
<style type="text/css">
<!--
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.style6 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #000000;
	font-size: 10px;
}
.style14 {font-size: 11; font-weight: bold; }
.style16 {font-size: 11; font-weight: bold; }
-->
</style>
<head>
<title></title>
</head>
<?php
include('header.html');
?>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">
<tr bgcolor="#DDDEDD">
<td ><span class="labeltext"><center><b><A HREF="javascript:window.print()">Packing List</A></b></center></td></tr>


<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=15%><span class="labeltext"><p align="left"><span class="labeltext">Customer</p></font></td>
<td colspan=3><span class="style6"><?php echo $myrow['name'] ?></td>
                    <input type="hidden" name="companyrecnum" id="companyrecnum"></td>
</td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=15%>&nbsp</td>
<td colspan=3><span class="style6"><?php echo $myrow['saddr1'] . " " . $myrow['saddr2']?></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=15%>&nbsp</td>
<td colspan=3><span class="style6"><?php echo $myrow['scity'] . " " . $myrow['state'] . " " . $myrow['zipcode'] ?></td>
</tr>
<?php
if ($myrow["name"] != 'Ellanef Manufacturing Corporation')
{
?>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=15%><span class="labeltext"><p align="left">PO #</p></td>
<td><span class="style6"><?php echo $myrow['ponum'] ?></td>
<td width=15%><span class="labeltext"><p align="left">PO Date</p></td>
<td><span class="style6"><?php echo $podate ?>
</td>
</tr>
<?php
}
else
{
?>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=15%><span class="labeltext"><p align="left">PO Date</p></td>
<td colspan=3><span class="style6"><?php echo $podate ?>
</td>
</tr>
<?php
}
?>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=20%><span class="labeltext"><p align="left">Work Order #</p></td>
<td><span class="style6"><?php echo $myrow['wonum'] ?></td>
<td colspan=2></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td colspan=4>&nbsp;</td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=20%><span class="labeltext"><p align="left">Item Description</p></td>
<td colspan=3><span class="style6"><?php echo $myrow['descr'] ?></td>
</table>
<?php
if ($myrow["name"] == 'Ellanef Manufacturing Corporation')
{
?>

<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width="7%"><span class="labeltext"><p align="left">Ponum</p></td>
<td width="7%"><span class="labeltext"><p align="left">Order Qty.</p></td>
<td width="7%"><span class="labeltext"><p align="left">Qty This<br>Shipment</p></td>
<td width="7%"><span class="labeltext"><p align="left">Bal Qty To Be <br>Dispatch</p></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
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

	 echo(' <tr class="bgcolor2" bordercolor="#CCCCCC" >');
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


<?php
}
?>


<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=20%><span class="labeltext"><p align="left">CIM Invoice No.</p></td>
<td><span class="style6"><?php print(preg_replace("/,/","/",$myrow['cim_invoice'])) ?></td>
<td width=20%><span class="labeltext"><p align="left">Packing List Date</p></td>
<td><span class="style6"><?php echo $packdate ?>
</td>
</tr>
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=15% colspan=2><span class="labeltext"><p align="left">No. Of Packings</p></td>
<td width=45% colspan=2><span class="labeltext"><p align="left">Type Of Packing And Contents</p></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=15% colspan=2><span class="style6"><b><center><?php echo $myrow['no_packings'] ?></center></b></td>
<td width=45% colspan=2><span class="style6"><?php echo $myrow['type_packing'] ?></td>
</tr>
</table>
</table>

<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
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
	      $totnumboxes = 0;

	  while($myrowli=mysql_fetch_row($resultli))
	  {

	    echo('<tr class="bgcolor2" bordercolor="#CCCCCC" >');
            $totnettwt += $myrowli[5];
            $totgrosstwt += $myrowli[6];
            $totnumboxes+= $myrowli[8];

           //$remarks="remarks".$x;
			echo "
			<td width=5%><span class=\"style6\">$myrowli[1]</p></font></td>
		   <td width=7%><span class=\"style6\">$myrowli[2] </p></font></td>
		   <td width=7%><span class=\"style6\">$myrowli[3] </p></font></td>
		   <td width=7%><span class=\"style6\">$myrowli[4]</p></font></td>
			<td width=7%><span class=\"style6\">$myrowli[5]</p></font></td>
            <td width=7%><span class=\"style6\">$myrowli[6] </p></font></td>
            <td width=7%><span class=\"style6\">$myrowli[8] </p></font></td>

     </tr> ";
    	//<td width=30%><span class=tabletext>
		   //<p align=left><b><input name=$remarks type=text size=50></b></p></font></td>
	$x++;
    }
			echo "
			<td colspan=4 align=\"right\"><span class=\"labeltext\"><b>Total</b></p></font></td>
			<td width=7%><span class=\"style6\"><b>$totnettwt</b></font></td>
             <td width=7%><span class=\"style6\"><b>$totgrosstwt</b></font></td>
		     <td width=7%><span class=\"style6\"><b>$totnumboxes</b></font></td>
               ";

?>

</table>
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">
<?php
if ($myrow['name'] != 'Goodrich Aerospace')
{
?>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=19%><span class="labeltext">
            <p align="left">Remarks</p></font></td>
<td width=45%><span class="style6">
<p align=left><?php echo $myrow['remarks'] ?></p></font></td>
</tr>
<?php
}
?>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=20%><span class="labeltext"><p align="left">Transportation By:</p></td>
<td><span class="style6"><?php echo $myrow['transportation'] ?></span></td></tr>
</table>
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
    <td width=50%><span class="style6">Beneficiary</p></font></td>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
    <td width=50%><span class="style6"><b>CIM TOOLS PRIVATE LIMITED</b></font></td>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
    <td width=50%><span class="style6">PLOT No. 467-469, Site No. 1D, 12th Cross</font></td>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
    <td width=50%><span class="style6"><p align="left">4th Phase, Peenya Industrial Area</font></td>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
    <td width=50%><span class="style6">Bangalore - 560058, INDIA.</font></td>
 </tr>
</table>
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td colspan=4><span class="labeltext">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
            <td colspan=2><span class="labeltext">&nbsp</td>
            <td colspan=2 align="right"><span class="labeltext">Authorised Signatory</td>
        </tr>

</table>
</td>
</tr>
</table>

</table>
</FORM>
</body>
</html>


