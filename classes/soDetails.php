<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = July 20, 2006                =
// Filename: soDetails.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Salesorder Details                          =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'soDetails';
session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/salesorderClass.php');
include('classes/soliClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$newsalesorder = new salesorder;
$soli = new soli;
$newdisplay = new display;

$salesorderrecnum = $_REQUEST['salesorderrecnum'];
$userid = $_SESSION['user'];

$myQI = $soli->getQI($salesorderrecnum);
$result = $newsalesorder->getSalesorder($salesorderrecnum);
$myrow = mysql_fetch_row($result);
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/salesorder.js"></script>

<html>
<head>
<title>Customer PO Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
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
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
<td><span class="pageheading"><b>Customer PO Details</b>	</td>
          <td bgcolor="#FFFFFF" rowspan=2 align="right"><input type= "image" name="Delete" src="images/bu-print.gif" value="Print" onclick="javascript: printsoDetails(<?php echo $salesorderrecnum ?>)">
          <a href ="edit_so.php?salesorderrecnum=<?php echo $salesorderrecnum ?>" ><img name="Image8" border="0" src="images/eso.gif" ></a>
</td>
  </tr>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<?php
?>
 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Customer PO Details</b></center></td></tr>
</td>
    <tr bgcolor="#FFFFFF">
            <td ><span class="labeltext">Cust PO</td>
            <td ><span class="tabletext"><?php echo $myrow[16] ?></td>
            <td><span class="labeltext">Customer</td>
            <td ><span class="tabletext"><?php echo $myrow[1]?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Description</font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[3]?></td>
     </tr>

        </tr>

     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order Date</font></td>
            <td ><span class="tabletext">
            <?php
              $datearr = split('-', $myrow[5]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
            //$date=date("F jS Y",$x);
            echo "$date";
            ?>
            </td>
            <td><span class="labeltext">Order/Quote Ref</font></td>
            <td ><span class="tabletext"><?php echo $myrow[39] ?></td>
      </tr>

   <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">PO Attachment(1)</td>
            <td ><span class="tabletext"><?php echo $myrow[35] ?></td>
            <td><span class="labeltext">PO Attachment(2)</td>
            <td ><span class="tabletext"><?php echo $myrow[36] ?></td>
    </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Contract Review Ref No.</td>
            <td ><span class="tabletext"><?php echo $myrow[42] ?></td>
            <td><span class="labeltext">Special Instruction</font></td>
            <td><textarea name="special_instruction" rows="6"
			      style="background-color:#DDDDDD;"
                    readonly="readonly"
			      cols="45"><?php echo $myrow[7] ?></textarea></td>           
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Contact Information</b></center></td>
        </tr>
      <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Contact</p></font></td>
            <td colspan=3><span class="tabletext"><p align="left"><?php echo $myrow[37] ?></td>
            </td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Email</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo $myrow[29]?></td>
            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo $myrow[38]?></td>
        </tr>
        <tr bgcolor="#DDDEDD">
           <td colspan=10><span class="heading"><center><b>Amendments</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
           <td colspan=10>
             <span class="tabletext"><p align="left">
                <?php $result = $newsalesorder->getamendment($salesorderrecnum);
                      while($row = mysql_fetch_array($result))
                      {
                         echo "******* added on $row[cr_date] *********<br>";
                         echo "        $row[amendment]<br><br>";
                      }
                ?>
           </td>
        </tr>
    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
</table>
    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD">
<td><span class="heading"><center><b> Line Items</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b><center>Item No.</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Part Name</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Part Num</center></b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>RM Type</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>RM Spec</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>UOM</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Dia</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Length</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Width</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Thickness</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Grain Flow</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Max Ruling</center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Alt Spec</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Drg Iss</center></b></td>
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Hc Drg Iss</center></b></td>-->
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Part Iss/Attach</center></b></td>
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Hc Part Iss/Attach</center></b></td> -->
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>PO Cos</center></b></td>-->
<!--<td bgcolor="#EEEFEE"><span class="heading"><b><center>Hc Cos</center></b></td>-->
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Model Issue</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>Qty</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>Unit Price</center></b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b><center>Amount</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>RM Unit Price</center></b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b><center>RM Amount</center></b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b><center>M/C Unit Price</center></b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b><center>M/C Amount</center></b></td>
</tr>
<?php
 $i = 1;
      while ($QI = mysql_fetch_row($myQI))
      {
	printf('<tr bgcolor="#FFFFFF">');
	$line_num = $QI[0];
	$qty = $QI[2];
	$item_desc = $QI[1];
    $partnum = $QI[6];
    $rmtype = $QI[7];
    $rmspec = $QI[8];
    $partiss = $QI[9];
   // $hcpartiss = $QI[16];
    $po_cos = $QI[15];
  //  $hc_cos = $QI[18];
    $model_iss = $QI[16];
    $drgiss = $QI[10];
  //  $hcdrgiss = $QI[15];
	$price = $QI[3];
	$amount = $QI[4];
	$rmprice = $QI[11];
	$rmamount = $QI[12];
	$mcprice = $QI[13];
	$mcamount = $QI[14];
    $uom = $QI[17];
    $dia = $QI[18];
    $length = $QI[19];
    $width = $QI[20];
    $thickness = $QI[21];
    $gf = $QI[22];
    $maxruling = $QI[23];
    $altspec = $QI[24];

	echo "<td align=\"center\"><span class=\"tabletext\">$line_num</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$item_desc</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$partnum</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$rmtype</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$rmspec</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$uom</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$dia</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$length</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$width</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$thickness</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$gf</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$maxruling</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$altspec</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$drgiss</td>";
   // echo "<td align=\"center\"><span class=\"tabletext\">$hcdrgiss</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$partiss</td>";
   // echo "<td align=\"center\"><span class=\"tabletext\">$hcpartiss</td>";
   // echo "<td align=\"center\"><span class=\"tabletext\">$po_cos</td>";
   // echo "<td align=\"center\"><span class=\"tabletext\">$hc_cos</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$model_iss</td>";
    echo "<td align=\"center\"><span class=\"tabletext\">$qty</td>";
	printf('<td align="right"><span class="tabletext">%s %.2f</td>',$myrow[30],$price);
	printf('<td align="right"><span class="tabletext">%s %.2f</td>',$myrow[30],$amount);
	printf('<td align="right"><span class="tabletext">%s %.2f</td>',$myrow[30],$rmprice);
	printf('<td align="right"><span class="tabletext">%s %.2f</td>',$myrow[30],$rmamount);
	printf('<td align="right"><span class="tabletext">%s %.2f</td>',$myrow[30],$mcprice);
	printf('<td align="right"><span class="tabletext">%s %.2f</td>',$myrow[30],$mcamount);
	printf('</tr>');

	printf('</tr>');
	$i++;
	?>
 <?php
    }

?>
<tr bgcolor="#EEEFEE">
            <td colspan=18><span class="labeltext"><p align="right">Total</p></font></td>
            <td align="right"><span class="labeltext">
            <?php
            	
            	printf('%s %.2f</td>',$myrow[30],$myrow[17]);
            
            ?>
            <td>&nbsp</td>
            <td align="right"><span class="labeltext">
            <?php
            	
            	printf('%s %.2f</td>',$myrow[30],$myrow[43]);
            
            ?>
            <td>&nbsp</td>
            <td align="right"><span class="labeltext">
            <?php
            	
            	printf('%s %.2f</td>',$myrow[30],$myrow[44]);
            
            ?>

        </tr>


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
      </FORM>
</table>
</body>
</html>
