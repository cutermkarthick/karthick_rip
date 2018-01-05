<?php

//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: poDetails.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Displays PO                                 =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
if ( !isset ( $_REQUEST['rec']) )
{
     header ( "Location: login.php" );

}
$rec = $_REQUEST['rec'];


// First include the class definition

include('classes/assypoClass.php');
include('classes/assypoliClass.php');
$newPO = new assyPo;
$newLI = new assypo_line_items;
$result = $newPO->getassyPoDetails($rec);
$myrow = mysql_fetch_array($result);
if($myrow["podate"] != '' && $myrow["podate"] != '0000-00-00')
{
    $datearr = split('-', $myrow["podate"]);
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
//$terms=wordwrap($myrow["terms"],122,"<br/>",true);
$terms=$myrow["terms"];
//$remarks=wordwrap($myrow["remarks"],122,"<br/>",true);
$remarks=$myrow["remarks"];
$amnd_notes=$myrow["amnd_notes"];
$linecount = 13;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/assypo.js"></script>
<html>
<head>
<title></title>
</head>
<?php
$title = 'PO ';
?>
<tr><td><font style="Arial" size=5 color="#000000"><center><b><A HREF="javascript:window.print()"><?php echo $title ?></A></b></center></td</tr>
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=327px><span class="heading"><left><b>From</b></left></td>
<td width=326px><span class="heading"><center><b>PO Info</b></center></td>
<td width=327px><span class="heading"><b><left>Order To</left></b></td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC">
<td   bgcolor="#F5F6F5" width=323px><span class="heading">CIM Tools Pvt Ltd.</td>
<td   bgcolor="#F5F6F5" width=323px><span class="labeltext"><center>PO No.:&nbsp <?php echo $myrow["assyPonum"] ?></center></td>
<td   bgcolor="#F5F6F5" width=323px><span class="heading"><?php echo $myrow["name"]?></td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=323px><span class="tabletext">Plot No. 467-469, Site No. 1D,</td>
<td width=323px>&nbsp</td>
<td width=323px><span class="tabletext"><?php echo $myrow["addr1"] . " " . $myrow["addr2"]; ?></td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=323px><span class="tabletext">12th Cross, 4th Phase,Peenya</td>
<td width=323px><span class="labeltext"><center>PO Date:&nbsp<?php echo $date ?></center></td>
<td width=323px><span class="tabletext"><?php echo $myrow["city"] . " " . $myrow["state"]. " " . $myrow["zipcode"]; ?></td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=323px><span class="tabletext">Bangalore 560 058, Karnataka- INDIA.</td>
<td width=323px>&nbsp</td>
<td width=323px><span class="tabletext"><?php echo $myrow["country"]; ?></td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=323px><span class="tabletext">Phone: +91 80 41171382, Fax: +91 80 41171381</td>
<td width=323px>&nbsp</td>
<td width=323px><span class="tabletext">Phone: <?php echo $myrow["phone"] ?></td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=323px><span class="tabletext">IE Code: 0797004271. VAT: 29720060144.</td>
<td width=323px>&nbsp</td>
<td width=323px><span class="tabletext">Fax: <?php echo $myrow["fax"] ?></td>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=323px><span class="tabletext">CST: 73176485</td>
<td width=323px>&nbsp</td>
<td width=323px>&nbsp</td>
</tr>
</table>
</td>
<tr><td>
 <table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6  bordercolor="#000000">
 <tr class="bgcolor2" bordercolor="#CCCCCC">
			<td  width=323px><span class="labeltext"><p align="left">Amendment No.</p></font></td>
            <td  width=323px><span class="tabletext"><?php echo $myrow["amnd_no"] ?></td>
            <td  width=323px><span class="labeltext"><p align="left">Amendment Date</p></font></td>
            <?php
              // echo"to--- ".$myrow["podate"];
              if($myrow["amnd_date"] !='' && $myrow["amnd_date"] !='0000-00-00' && $myrow["amnd_date"] != 'null'){
              $datearr = split('-', $myrow["amnd_date"]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
            $x=mktime(0,0,0,$m,$d,$y);
            $date2=date("M j, Y",$x);
           }
           else{
            $date2='';
           }
           // echo "$date";
            ?>
            <td  width=323px><span class="tabletext"><?php echo $date2 ?></td>

        </tr>
<tr class="bgcolor2" bordercolor="#CCCCCC">
<td colspan=4><?php print $amnd_notes?></td>
</tr>
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td colspan=17><span class=\"tabletext\"><pre><?php echo $terms?></pre></td>
</tr>
</td></tr>
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6  bordercolor="#000000">
<tr width=70% class="bgcolor2" bordercolor="#CCCCCC" >
            <td bgcolor="#EEEFEE"><span class="heading"><b>Ln</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Part #<br>Before NDT/SP</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Part #<br>After SP</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Partname</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>PartIss<br>Iss</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Drg</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Mtl<br>Spec</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Mtl<br>Type</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>COS</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Qty</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Price</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Ext<br>Price</b></td>

       </tr>

<?php
        $nbsp= "&nbsp;";
        $currency = $myrow["currency"];
        $i = 0;
        $result = $newLI->getLI($rec);
        while ($myLI = mysql_fetch_assoc($result)) {
            $line_num = $myLI["lineNum"];
            $crnNum = $myLI["crnNum"];
            $pripartNum = $myLI["priPartNum"];
			$pripartNum1=wordwrap($pripartNum,15,"<br />\n",true);

            $secpartNum = $myLI["secPartNum"];
			$secpartNum1=wordwrap($secpartNum,15,"<br />\n",true);

            //echo'seccP='.$secpartNum;
            $partName = $myLI["partName"];
            $partIss = $myLI["partIss"];
            $drg = $myLI["drg"];
            $mtlSpec = $myLI["mtlSpec"];
            $mtlType = $myLI["mtlType"];
            //$rmCondition = $myLI["rmCondition"];
            $qty = $myLI["qty"];
            $price =  $myLI["price"];
            $extPrice = $myLI["extPrice"];
            $cos = $myLI["cos"];

            $secpartNum = $secpartNum?$secpartNum:$nbsp;
            $partName = $partName?$partName:$nbsp;
			$partName1=wordwrap($partName,15,"<br />\n",true);

            $partIss = $partIss?$partIss:$nbsp;
            $drg = $drg?$drg:$nbsp;
            $mtlSpec = $mtlSpec?$mtlSpec:$nbsp;
       	    $mtlSpec=wordwrap($mtlSpec,15,"<br />\n",true);
            $mtlType = $mtlType?$mtlType:$nbsp;
            //$rmCondition = $myLI["rmCondition"];
            $qty = $qty?$qty:$nbsp;
            $price =  $price?$price:$nbsp;
            $extPrice = $extPrice?$extPrice:$nbsp;
            $cos = $cos?$cos:$nbsp;

            $i = $i + 1;
			$linecount=$linecount+3;
			if ($linecount > 24)
			{
			   echo "<br>";
			   echo '<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">';
               echo '<tr class="bgcolor2" bordercolor="#CCCCCC" >';
               echo '<td colspan=2><span class="labeltext">' . $myrow["formatnum"] . '</td>';
               echo '<td colspan=4><span class="labeltext">' . $myrow["formatrev"] . '</td>';
               echo '<td colspan=11><span class="labeltext">CIM TOOLS PRIVATE LIMITED</td>';
               echo '</tr>';
               echo '</table>';
               echo '<br style="page-break-after:always;">';
			   $linecount = 0;
?>
           <table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6  bordercolor="#000000">
           <tr width=70% class="bgcolor2" bordercolor="#CCCCCC" >
            <td bgcolor="#EEEFEE"><span class="heading"><b>Line</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Part#<br>Before NDT/SP</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Part#<br>After SP</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Partname</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>PartIss <br>Iss</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Drg</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Mtl Spec</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Mtl Type</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>COS</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Qty</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Price</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Extended Price</b></td>

       </tr>
<?php
			}
			$linecount++;
	        echo '<tr class="bgcolor2" bordercolor="#CCCCCC">';
            echo "<td><span class=\"tabletext\">$line_num</td>" ;
            echo "<td><span class=\"tabletext\">$crnNum</td>";
            echo "<td><span class=\"tabletext\">$pripartNum1</td>";
            echo "<td><span class=\"tabletext\">$secpartNum1</td>";
            echo "<td><span class=\"tabletext\">$partName1</td>";
            echo "<td><span class=\"tabletext\">$partIss</td>";
            echo "<td><span class=\"tabletext\">$drg</td>";
            echo "<td><span class=\"tabletext\">$mtlSpec</td>";
            echo "<td><span class=\"tabletext\">$mtlType</td>";
            echo "<td><span class=\"tabletext\">$cos</td>";
            echo "<td><span class=\"tabletext\">$qty</td>";
            echo "<td><span class=\"tabletext\">$currency $price</td>";
            echo "<td><span class=\"tabletext\">$currency  $extPrice</td>";


        }
?>
           <tr>
          <tr class="bgcolor2" bordercolor="#CCCCCC" >
              <td bgcolor="#FFFFFF" colspan=12 align="right"><span class="tabletext"><b>Total</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["poamount"]); ?></td>
          </tr>
          <tr class="bgcolor2" bordercolor="#CCCCCC" >
              <td bgcolor="#FFFFFF" colspan=12 align="right"><span class="tabletext"><b>Tax</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["tax"]);  ?></td>
          </tr>
          <tr class="bgcolor2" bordercolor="#CCCCCC" >
              <td bgcolor="#FFFFFF" colspan=12 align="right"><span class="tabletext"><b>Shipping</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["shipping"]); ?></td>
          </tr>
          <tr class="bgcolor2" bordercolor="#CCCCCC" >
              <td bgcolor="#FFFFFF" colspan=12 align="right"><span class="tabletext"><b>Labor</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["labour"]); ?></td>
          </tr>
          <tr class="bgcolor2" bordercolor="#CCCCCC" >
              <td bgcolor="#FFFFFF" colspan=12 align="right"><span class="tabletext"><b>Total Due</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><b><?php printf('%s %.2f',$myrow["currency"],$myrow["total_due"]); ?></b></td>
          </tr>


<tr>
<?php
            $linecount=$linecount+6;
			if ($linecount > 24)
			{
			   echo "<br>";
			   echo '<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">';
               echo '<tr class="bgcolor2" bordercolor="#CCCCCC" >';
               echo '<td colspan=2><span class="labeltext">' . $myrow["formatnum"] . '</td>';
               echo '<td colspan=4><span class="labeltext">' . $myrow["formatrev"] . '</td>';
               echo '<td colspan=11><span class="labeltext">CIM TOOLS PRIVATE LIMITED</td>';
               echo '</tr>';
               echo '</table>';
               echo '<br style="page-break-after:always;">';
			   $linecount = 0;
?>
<?php
     }
?>
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">

<tr class="bgcolor2" bordercolor="#CCCCCC">
<td colspan=1><span class="labeltext"><p align="center">Terms & Conditions</p></font></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC">
<td colspan=17><span class=\"tabletext\"><pre><?php echo $remarks?></pre></td>
</tr>
</table>
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC">
            <td colspan=2><span class="labeltext"><?php printf('%s',$myrow["formatnum"]);?></td>
            <td colspan=4><span class="labeltext"><?php printf('%s',$myrow["formatrev"]);?></td>
            <td colspan=11><span class="labeltext">FLUENTWMS</td>
</tr>
</table>
</table>

</td>
</tr>
</table>
</td>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>

</table>

</FORM>

</td>
</tr>

</table>


</body>
</html>




