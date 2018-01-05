<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Dec 8, 2006                  =
// Filename: invoiceDetails.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// invoice Details                             =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'invoicedetails';
////////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/custinvoiceClass.php');
include('classes/custinvoiceliClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newinvoice = new custinvoice;
$newLI = new custinvoiceli;
$newdisplay = new display;
$invoicerecnum = $_REQUEST['invoicerecnum'];
$result = $newinvoice->getinvoicedetails($invoicerecnum);
$myrow = mysql_fetch_assoc($result);
$result1 = $newLI->getinvoiceli($invoicerecnum);
$fobcf=$myrow["fob_or_candf"];
?>
<link rel="stylesheet" href="style.css">

<html>
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
.style17 {font-size: 12; font-weight: bold; }
-->
</style>
<head>
<title></title>
</head>
<?php
include('header.html');
?>

<table border="0" width="100%" bgcolor="#DDDDDD" rules="all" cellspacing="0">

<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading">
<center><b><A HREF="javascript:window.print()">Bill of Sale</A></b></center></td></tr>

         <?php
            $d=substr($myrow["invdate"],8,2);
            $m=substr($myrow["invdate"],5,2);
            $y=substr($myrow["invdate"],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $invdate=date("M j, Y",$x);
           // echo "$date";
          ?>
<table border=1 bgcolor="#FFFFFF" width=100% cellpadding=4 cellspacing=1 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
    <td width=50%><span class="style6">Exporter</p></font></td>
    <td width=50%><span class="style6">Invoice No, & Date</p></font></td>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
    <td width=50%><span class="style6"><b>CIM TOOLS PRIVATE LIMITED</b></font></td>
    <td width=50%><span class="style6"><b><?php printf("%6d %s %s ",$myrow["invnum"],"dated:", $invdate); ?></b></td>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
    <td width=50%><span class="style6">PLOT No. 467-469, Site No. 1D, 12th Cross</font></td>
    <td width=50%><span class="style6">Buyers Order Nos. & Date: Please refer below</font></td>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
    <td width=50%><span class="style6"><p align="left">4th Phase, Peenya Industrial Area</font></td>
    <td width=50%><span class="style6">CIN: U29199KA1997PTC021886</td>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
    <td width=50%><span class="style6">Bangalore - 560058, INDIA.</font></td>
    <td width=50%><span class="style6">IEC No. 0797004271 & TIN: 29720060144</td>
 </tr>
</table>
<table border=1 bgcolor="#FFFFFF" width=100% cellpadding=4 cellspacing=1 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td  bgcolor="#F5F6F5" width=50%><span class="heading"><center><b>Bill To</b></center></td>
   <td bgcolor="#F5F6F5" width=50%><span class="heading"><b><center>Ship To</center></b></td>

<table border=1 bgcolor="#FFFFFF" width=100% cellpadding=4 cellspacing=1 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td  bgcolor="#FFFFFF" width=50%><span class="style6"><?php echo $myrow["name"] ?></td>
            <td  bgcolor="#FFFFFF" width=50%><span class="style6"><?php echo $myrow["sname"] ?></td>
       </tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td  bgcolor="#FFFFFF" width=50%><span class="style6"><?php echo $myrow["baddr1"] . " " . $myrow["baddr2"]?></td>
            <td  bgcolor="#FFFFFF" width=50%><span class="style6"><?php echo $myrow["saddr1"] .  " " . $myrow["saddr2"]?></td>
       </tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td  bgcolor="#FFFFFF" width=50%><span class="style6"><?php echo $myrow["bcity"] .  " " . $myrow["bstate"] . $myrow["bzipcode"] ?></td>
            <td  bgcolor="#FFFFFF" width=50%><span class="style6"><?php echo $myrow1["scity"] .  " " . $myrow["sstate"] . $myrow["szipcode"]?></td>
       </tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td  bgcolor="#FFFFFF" width=50%><span class="style6"><?php echo $myrow["bcountry"]?></td>
            <td  bgcolor="#FFFFFF" width=50%><span class="style6"><?php echo $myrow["scountry"]?></td>
       </tr>

   </table>

<table border=1 bgcolor="#FFFFFF" width=100% cellpadding=4 cellspacing=1 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >

 <?php
		if($myrow["duedate"] != '0000-00-00' && $myrow["duedate"]!= '' && $myrow["duedate"] != 'NULL')
                {
                    $datearr = split('-', $myrow["duedate"]);
                    $d=$datearr[2];
                    $m=$datearr[1];
                    $y=$datearr[0];
                    $x=mktime(0,0,0,$m,$d,$y);
                    $duedate=date("M j, Y",$x);
               }
              else
              {
                   $duedate = '';
              }
              $currency = $myrow["currency"];
            ?>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td width=20%><span class="labeltext"><p align="left">Pre-Carriage by</p></font></td>
            <td width=20%><span class="style6"><?php echo $myrow["precarriageby"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Pre-carrier Place of Receipt</p></font></td>
            <td width=20%><span class="style6"><p align="left"><?php echo  $myrow["precarrierreceipt"] ?></td>
            </td>
		</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td width=20%><span class="labeltext"><p align="left">Country of Origin</p></font></td>
            <td width=20%><span class="style6"><?php echo $myrow["countryoforigin"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Country of Final Destination</p></font></td>
            <td width=20%><span class="style6"><p align="left"><?php echo $myrow["countryoffinaldest"] ?></td>
            </td>
		</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td width=20%><span class="labeltext"><p align="left">Vessel</p></font></td>
            <td width=20%><span class="style6"><?php echo $myrow["vessel"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Port of Loading</p></font></td>
            <td width=20%><span class="style6"><p align="left"><?php echo $myrow["portofloading"] ?></td>
            </td>
        </tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td width=20%><span class="labeltext">Port of Discharge</font></td>
            <td width=20%><span class="style6"><?php echo $myrow["portofdischarge"] ?></td>
            <td width=20%><span class="labeltext">Terms</td>
            <td width=20%><span class="style6"><?php echo $myrow["terms"] ?></td>
            </td>
        </tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td width=20%><span class="labeltext">Due Date</td>
            <td width=20%><span class="style6"><?php echo $duedate ?></td>
            <td width=20%>&nbsp</td>
            <td width=20%>&nbsp</td>
        </tr>
</table>
<?php
if ($myrow["name"] != 'Goodrich Aerospace')
{
?>
<table border=1 bgcolor="#FFFFFF" width=100% cellpadding=4 cellspacing=1 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
                <td><span class="labeltext"><p align="left">Remarks</p></font></td>
                <td><span class="tabletext"><pre><?php echo $myrow["remarks"] ?></pre></td></tr>
                </table>
</table>

<?php
}
?>
<!--<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF"  bordercolor="#000000">
<tr bgcolor="#FFFFFF">
<table border="1" width="100%" bgcolor="#FFFFFF" rules="all" cellspacing="0" >-->
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<?php
if ($myrow["name"] == 'Goodrich Aerospace')
{
?>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>Ln No.</center></b></td>
<?php
}
?>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>CRN</center></b></td>
<td bgcolor="#EEEFEE" width=15%><span class="heading"><b><center>Part No.</center></b></td>
<td bgcolor="#EEEFEE" width=17%><span class="heading"><b><center>Part Name</center></b></td>
<?php
if ($myrow["name"] != 'Goodrich Aerospace')
{
?>
     <td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>CofC</center></b></td>
<?php
}
if ($myrow["name"] == 'Goodrich Aerospace')
{
?>
<td bgcolor="#EEEFEE" width=15%><span class="heading"><b><center>Raw Mtl.</center></b></td>
<td bgcolor="#EEEFEE" width=17%><span class="heading"><b><center>Tariff Sch</center></b></td>
<td bgcolor="#EEEFEE" width=17%><span class="heading"><b><center>Packaging<br>(inches)</center></b></td>

<?php
}
?>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>PO #</center></b></td>
<?php
if ($myrow["name"] == 'Gardner Aerospace Burnley Limited' || $myrow["name"] == 'Gardner Aerospace - ILKESTON Limited'
        || $myrow["name"] == 'Gardner Aerospace-Derby(ILC)' || $myrow["name"] == 'Gardner Aerospace-Hull Limited'
        || $myrow["name"] == 'Gardner Aerospace-Burnley Ltd'
 )
{
?>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>PO LN.#</center></b></td>
<?php
}
?>

<?php
if ($myrow["name"] == 'MAGELLAN AEROSPACE,WINNIPEG')
{
?>
<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>Sch PO</center></b></td>
<?php
}
?>

<td bgcolor="#EEEFEE" width=5%><span class="heading"><b><center>Qty</center></b></td>
<td bgcolor="#EEEFEE" width=7%><span class="heading"><b><center>Price<br><?php echo $currency ?></center></b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b><center>Amount <?php echo $fobcf ?><br><?php echo $currency ?></center></b></td>
</tr>
<?php
     $currency = $myrow["currency"];
     $i = 1;
     
      while ($li = mysql_fetch_assoc($result1))
      {

	$line_num = $li["line_num"];
	$crnnum = $li["crnnum"];
    $partnum = $li["cimpartnum"];
	$cofc = $li["cofc_num"];
	$ponum = $li["custpo_num"];
	$descr = $li["descr"];
    $descr = wordwrap($descr,25,"<br />\n");
	$rawmtl = $li["rawmtl"];
	$noofpackages = $li["noofpackages"];
	$packaging = $li["packaging"];
	$tariffsch = $li["tariff_schedule"];
	$qty = $li["qty"];
	$price = $li["price"];
	$amount = $li["line_amount"];
	$type = $li["type"];
    $polinenum = $li["polinenum"];
    $schpo = $li["schpo"];

	if ($myrow["name"] == 'Magellan Aerospace Bournemouth'  and $type == 'Untreated')
   {
        $partnum = "PI " . $partnum;
   }
	if (($myrow["name"] == 'Magellan Aerospace Wrexham'  || $myrow["name"] == 'Magellan Aerospace Wrexham (Fabrications Div)')
		 and $type == 'Untreated')
	{
        $partnum =  $partnum . " 01";
    }

    echo ("<tr class=bgcolor2 bordercolor=#CCCCCC>");


   if ($myrow["name"] == 'Goodrich Aerospace')
   {
	echo "<td align=\"center\"><span class=\"tabletext\">$line_num</td>";
   }

	echo "<td align=\"center\"><span class=\"tabletext\">$crnnum</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$partnum</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$descr</td>";
   if ($myrow["name"] != 'Goodrich Aerospace')
   {
       echo "<td align=\"center\"><span class=\"tabletext\">$cofc</td>";
   }

    if ($myrow["name"] == 'Goodrich Aerospace')
   {
      	echo "<td align=\"center\"><span class=\"tabletext\">$rawmtl</td>";
	    echo "<td align=\"center\"><span class=\"tabletext\">$tariffsch</td>";
	    echo "<td align=\"center\"><span class=\"tabletext\">$packaging</td>";

   }
 	echo "<td align=\"center\"><span class=\"tabletext\">$ponum</td>";
 if ($myrow["name"] == 'Gardner Aerospace Burnley Limited' || $myrow["name"] == 'Gardner Aerospace - ILKESTON Limited'
        || $myrow["name"] == 'Gardner Aerospace-Derby(ILC)' || $myrow["name"] == 'Gardner Aerospace-Hull Limited'
        || $myrow["name"] == 'Gardner Aerospace-Burnley Ltd'
    )
   {
    echo "<td align=\"center\"><span class=\"tabletext\">$polinenum &nbsp</td>";
   }
   if ($myrow["name"] == 'MAGELLAN AEROSPACE,WINNIPEG')
   {
       echo "<td align=\"center\"><span class=\"tabletext\">$schpo</td>";
   }
	echo "<td align=\"center\"><span class=\"tabletext\">$qty</td>";
    printf('<td align="right"><span class="tabletext">%.2f</td>',$price);
	printf('<td align="right"><span class="tabletext">%.2f</td>',$amount);
	printf('</tr>');
	printf('</tr>');
	$i++;
    }
    while ($i < 16)
	{

        echo ("<tr class=bgcolor2 bordercolor=#CCCCCC>");
        if ($myrow["name"] == 'Goodrich Aerospace')
        {
	       echo "<td>&nbsp;</td>";
        }
    	echo "<td>&nbsp;</td>";
	    echo "<td>&nbsp;</td>";
	   echo "<td>&nbsp;</td>";
       if ($myrow["name"] != 'Goodrich Aerospace')
       {
         echo "<td>&nbsp;</td>";
       }

      if ($myrow["name"] == 'Goodrich Aerospace')
      {
           echo "<td>&nbsp;</td>";	    
           echo "<td>&nbsp;</td>";	
	       echo "<td>&nbsp;</td>";	
      }
 	  echo "<td>&nbsp;</td>";	
	  echo "<td>&nbsp;</td>";	
      echo "<td>&nbsp;</td>";	
	  echo "<td>&nbsp;</td>";
      if ($myrow["name"] == 'Gardner Aerospace Burnley Limited' || $myrow["name"] == 'Gardner Aerospace - ILKESTON Limited'
        || $myrow["name"] == 'Gardner Aerospace-Derby(ILC)' || $myrow["name"] == 'Gardner Aerospace-Hull Limited'
        || $myrow["name"] == 'Gardner Aerospace-Burnley Ltd'
      )
     {
       echo "<td>&nbsp;</td>";
     }	
     if ($myrow["name"] == 'MAGELLAN AEROSPACE,WINNIPEG')     {
       echo "<td>&nbsp;</td>";
     }

		printf('</tr>');
		$i++;
    }
	$subtotal=$myrow['total']+$myrow['advance_amount'];	
?>

<table border=1 bgcolor="#FFFFFF" width=100% cellpadding=4 cellspacing=1 rule=all bordercolor="#000000">
  <td align="right"><span class="pageheading"><b></b></td><td width="11%"></td></tr>

  <?php 
  if($myrow["name"] !='MAHINDRA AEROSTRUCTURES PVT. LTD' && $myrow["name"] !='Aerostructures Assemblies India Pvt.Ltd' && $myrow["name"] !='Dynamatic Technologies Limited' )
  {
  ?>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td><span class="labeltext"><p align="right">Sub Total </p></font></td>
            <td align="right"><span class="tabletext"><b>
            <?php
            	printf('%s %.2f',$currency,$subtotal);
             ?></b>
        </tr>
  <?php }?>
<?php
if($myrow['advance_info'] !='')
{
?>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td align="right"><span class="tabletext"><?=$myrow['advance_info']?></font>
</td>
<td align="right"><span class="tabletext"><b>
<?php
      	printf('%s %.2f',$currency,$myrow['advance_amount']);
?>
 </tr>
<?
}
?>

<?php
$customername =$myrow["name"] ;
if($customername =='MAHINDRA AEROSTRUCTURES PVT. LTD')
{
?>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td><span class="labeltext"><p align="right">Sub Total </p></font></td>
            <td align="right"><span class="tabletext"><b>
            <?php
            	printf('%s %.2f',$currency,$myrow["subtotal"]);
            //printf('%s%.2f</td>',$myrow[30],$myrow[21]); ?></b>
        </tr>
		
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td align="right"><span class="tabletext"><b>Excise (12.5%)</b></font>
</td>
<td align="right"><span class="tabletext"><b>
<?php
      	printf('%.2f',$myrow['excise']);
?>
 </tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td align="right"><span class="tabletext"><b>Subtotal(W/EXC)</b></font>
</td>
<td align="right"><span class="tabletext"><b>
<?php
      	printf('%.2f',$myrow['excsubtotal']);
?>
 </tr> 
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td align="right"><span class="tabletext"><b>Vat (14.5%)</b></font>
</td>
<td align="right"><span class="tabletext"><b>
<?php
      	printf('%.2f',$myrow['vat']);
?>
 </tr>
 

<?
}

if($customername =='Aerostructures Assemblies India Pvt.Ltd')
{
?>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td><span class="labeltext"><p align="right">Sub Total </p></font></td>
            <td align="right"><span class="tabletext"><b>
            <?php
            	printf('%s %.2f',$currency,$myrow["subtotal"]);
            //printf('%s%.2f</td>',$myrow[30],$myrow[21]); ?></b>
        </tr>
		
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td align="right"><span class="tabletext"><b>Vat (14.5%)</b></font>
</td>
<td align="right"><span class="tabletext"><b>
<?php
      	printf('%.2f',$myrow['vat']);
?>
 </tr>
 

<?
}

if($customername =='Dynamatic Technologies Limited')
{
?>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td><span class="labeltext"><p align="right">Sub Total </p></font></td>
            <td align="right"><span class="tabletext"><b>
            <?php
              printf('%s %.2f',$currency,$myrow["subtotal"]);
            //printf('%s%.2f</td>',$myrow[30],$myrow[21]); ?></b>
        </tr>
    
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td align="right"><span class="tabletext"><b>Service Tax(14%)</b></font>
  
</td>
<td align="right"><span class="tabletext"><b>
<?php
        printf('%s %.2f',$currency,$myrow['service_tax']);
?>
 </tr>
 <tr class="bgcolor2" bordercolor="#CCCCCC" >
<td align="right"><span class="tabletext"><b>Swach Bhart Cess(0.5%)</b></font>
  
</td>
<td align="right"><span class="tabletext"><b>
<?php
        printf('%s %.2f',$currency,$myrow['cess1']);
?>
 </tr>
 <tr class="bgcolor2" bordercolor="#CCCCCC" >
<td align="right"><span class="tabletext"><b>Krishi Kalyan Cess(0.5%)</b></font>
  
</td>
<td align="right"><span class="tabletext"><b>
<?php
        printf('%s %.2f',$currency,$myrow['cess2']);
?>
 </tr>
<?
}
?>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td><span class="labeltext"><p align="right">Total </p></font></td>
            <td align="right"><span class="tabletext"><b>
            <?php
            	printf('%s %.2f',$currency,$myrow['total']);
            //printf('%s%.2f</td>',$myrow[30],$myrow[21]); ?></b>
        </tr>


    </table> </td>

<table border=1 bgcolor="#FFFFFF" width=100% cellpadding=4 cellspacing=1 rule=all bordercolor="#000000">

	   <tr bgcolor="#FFFFFF">
            <td colspan=11><span class="style6">
			We declare that this invoice shows the actual price of the goods described
            and that all particulars are true and correct.
			</td>
        </tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td colspan=11><span class="style6"><center>
			This is an electronically generated copy and hence does not require signature.
			</center>
			</td>
        </tr>
</table>
<table border=1 bgcolor="#FFFFFF" width=100% cellpadding=4 cellspacing=1 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td colspan=4><span class="style6">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
            <td colspan=2><span class="style6">&nbsp</td>
            <td colspan=2 align="right"><span class="style6">Authorised Signatory</td>
        </tr>

</table>
</td>
</tr>
</table>

</table>
</FORM>
</body>
</html>
