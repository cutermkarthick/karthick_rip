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
if ( !isset ( $_REQUEST['ponum']) )
{
     header ( "Location: login.php" );
    
}
$ponum = $_REQUEST['ponum'];
$_SESSION['ponum'] = $ponum; 
//////session_register('ponum');


// First include the class definition 

include('classes/poClass.php'); 
include('classes/liClass.php'); 
$newPO = new po; 
$newLI = new po_line_items; 
$result = $newPO->getPODetails($ponum);
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
$remarks_p=wordwrap($myrow["remarks"],122,"<br/>",true);
$amend_notes=wordwrap($myrow["amendment_notes"],100,"<br/>",true);
$amendment_notes=trim($myrow["amendment_notes"]);
$terms=wordwrap($myrow["terms"],100,"<br/>",true);
$remarks=$myrow["remarks"];
$linecount = 13;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/po.js"></script>
<html>
<head>
<title></title>
</head>
<?php
$title = 'Purchase Order';
?>
<tr><td><font style="Arial" size=5 color="#000000"><center><b><A HREF="javascript:window.print()"><?php echo $title ?></A></b></center></td</tr>
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=327px><span class="heading"><left><b>From</b></left></td>
<td width=326px><span class="heading"><center><b>PO Info</b></center></td>
<td width=327px><span class="heading"><b><left>Order To</left></b></td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC">

 <td   bgcolor="#F5F6F5" width=323px><span class="heading">Fluentsoft Inc.</td>
<td   bgcolor="#F5F6F5" width=323px><span class="labeltext"><center>PO No.:&nbsp <?php echo $myrow["ponum"] ?></center></td>
<td   bgcolor="#F5F6F5" width=323px><span class="heading"><?php echo $myrow["name"]?></td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=323px><span class="tabletext">472 , Keer Plaza, Basaveswaranagar, Bangalore 560079.  INDIA</td>
<td width=323px>&nbsp</td>
<td width=323px><span class="tabletext"><?php echo $myrow["addr1"] . " " . $myrow["addr2"]; ?></td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td width=323px><span class="tabletext">Phone: 91-80-41171382/83   FAX: 91-80-41171381    email:info@fluentsoft.com</td>
<td width=323px><span class="labeltext"><center>PO Date:&nbsp<?php echo $date ?></center></td>
<td width=323px><span class="tabletext"><?php echo $myrow["city"] . " " . $myrow["state"]. " " . $myrow["zipcode"]; ?></td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<!-- <td width=323px><span class="tabletext">Phone: 91-80-41171382/83   FAX: 91-80-41171381    email:info@fluentsoft.com</td> -->
<!-- <td width=323px><span class="tabletext">Phone: +91 80 41171382, Fax: +91 80 41171381</td> -->
<td width=323px><span class="tabletext">IE Code: 0797004271. VAT: 29720060144.</td>
<td width=323px>&nbsp</td>
<td width=323px><span class="tabletext"><?php echo $myrow["country"]; ?></td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<!-- <td width=323px><span class="tabletext">Phone: +91 80 41171382, Fax: +91 80 41171381</td> -->
<!-- <td width=323px><span class="tabletext">IE Code: 0797004271. VAT: 29720060144.</td> -->
<td width=323px><span class="tabletext">CST: 73176485</td> 

<td width=323px>&nbsp</td>
<td width=323px><span class="tabletext">Phone: <?php echo $myrow["phone"] ?></td>
</tr>

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<!-- <td width=323px><span class="tabletext">IE Code: 0797004271. VAT: 29720060144.</td> -->
<!-- <td width=323px><span class="tabletext">CST: 73176485</td>  -->
<td width=323px>&nbsp</td>
<td width=323px>&nbsp</td>
<td width=323px><span class="tabletext">Fax: <?php echo $myrow["fax"] ?></td>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<!-- <td width=323px><span class="tabletext">CST: 73176485</td>  -->
<td width=323px>&nbsp</td>
<td width=323px>&nbsp</td>
</tr>
</table>
</td>
<tr><td>
 <table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC">
			<td  width=323px><span class="labeltext"><p align="left">Amendment No.</p></font></td>
            <td  width=323px><span class="tabletext"><?php echo $myrow["amendment_num"] ?></td>
            <td  width=323px><span class="labeltext"><p align="left">Amendment Date</p></font></td>
            <?php
              // echo"to--- ".$myrow["podate"];
              if($myrow["amendmentdate"] !='' && $myrow["amendmentdate"] !='0000-00-00' && $myrow["amendmentdate"] != 'null'){
              $datearr = split('-', $myrow["amendmentdate"]);
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
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td colspan=17><pre><?php print $amendment_notes?></pre></td>
</tr>
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td colspan=17><span class=\"tabletext\"><pre><?php echo $terms?></pre></td>
</tr>
</td></tr> </table>
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC">
<td bgcolor="#FFFFFF" colspan=17 border=1><span class="tabletext"><b><center>Please quote each line item of the purchase order in invoice and CofC and dispatch as per line item only.
</center></b></td>
</tr> </table>
</td></tr>
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rules=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td bgcolor="#EEEFEE"><span class="heading"><b>Ln</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Mtl<br>Type</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Mtl<br> Spec</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>RM Condn</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>UOM</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Dia</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Length</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Width</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Thick</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>GF</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Max<br>Ruling<br>Dim</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>No. of<br>Units</b></td>

			 <td bgcolor="#EEEFEE"><span class="heading"><b>Measuring <br>Unit</b></td>

            <td bgcolor="#EEEFEE"><span class="heading"><b>Nos.<br> req</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Del<br>Date</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Del<br>By</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Rate</b></td>
            <td bgcolor="#EEEFEE" align="right"><span class="heading"><b>Amount</b></td>

       </tr>

<?php
        $nbsp= "&nbsp;";
        $i = 0;
        $result = $newLI->getLI($ponum);
        while ($myLI = mysql_fetch_assoc($result)) {
            if($myLI["duedate"] != '' && $myLI["duedate"] != '0000-00-00')
               {
                 $datearr = split('-', $myLI["duedate"]);
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
            $due=wordwrap($date,6,"<br />\n");
            if($myLI["accepted_date"] != '0000-00-00' && $myLI["accepted_date"] != '' && $myLI["accepted_date"] != 'NULL')
            {
              $datearr = split('-', $myLI["accepted_date"]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $accdate=date("M j, Y",$x);
            }
           else
            {
              $accdate = '';
            }
            //echo "$date";
            $line_num = $myLI["line_num"];
            $item_name = $myLI["item_name"];
            $item_desc = $myLI["item_desc"];
            $qty = $myLI["qty"];
            $crn = $myLI["crn"];
            $material_ref = $myLI["material_ref"];
	    $material_spec = $myLI["material_spec"];
            if ($material_ref == 'PART')
            {
               $material_spec = $material_spec . " " . $item_name; 
	       $material_spec = wordwrap($material_spec,10,"<br />\n");
   
            }
            else
            {
		$material_spec = wordwrap($myLI["material_spec"],10,"<br />\n");
            }
            $material_ref = wordwrap($myLI["material_ref"],10,"<br />\n");
            $dia ="";
            $thick="";
            $width = $myLI["width"];
            $length = $myLI["length"];
             if (trim($length) == "")
            {
                $dia = $myLI['thick'];
            }
            else
            {
                $thick = $myLI['thick'];
            }
            $dia = $dia ? $dia : $nbsp;
            $thick = $thick ? $thick : $nbsp;
            $width = $width ? $width : $nbsp;
            $delvby = $myLI["delv_by"];
            $qty_per_meter = $myLI["qty_per_meter"];
            $no_of_meterages = $myLI["no_of_meterages"];
            $uom = $myLI["uom"];
            $maxruling = wordwrap($myLI["maxruling"],7,"<br />\n");
            $maxruling = $maxruling ? $maxruling : $nbsp;
            $grainflow =  wordwrap($myLI["grainflow"],10,"<br />\n");
            $grainflow = $grainflow ? $grainflow : $nbsp;
            $no_of_lengths = $myLI["no_of_lengths"];
            $crn = $myLI["crn"];
            $condition = wordwrap($myLI["condition"],10,"<br />\n");
            $condition = $condition ? $condition : $nbsp;

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
			 <table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rules=all bordercolor="#000000">
             <tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td bgcolor="#EEEFEE"><span class="heading"><b>Ln</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Mtl<br>Type</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Mtl<br> Spec</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>RM Condn</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>UOM</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Dia</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Length</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Width</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Thick</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>GF</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Max<br>Ruling<br>Dim</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Mtrs<br> req</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Nos.<br> req</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Del<br>Dt</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Del<br>By</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Rate</b></td>
            <td bgcolor="#EEEFEE" align="right"><span class="heading"><b>Amount</b></td>

       </tr>
<?php
			}
			$linecount++;

			$lnarr=split('-',$line_num);
			//echo $line_num."--**--".$lnarr[1]."---<br>";
			if($lnarr[1]=='')
			{

				    if(strtoupper($uom) == 'MM')
							$no_units_req='Mts';
						else if(strtoupper($uom) == 'INCHES')
							$no_units_req='Ft';
						else
							$no_units_req='';

            echo '<tr class="bgcolor2" bordercolor="#CCCCCC">';
            echo "<td><span class=\"tabletext\">$line_num</td>" ;
            echo "<td><span class=\"tabletext\">$material_ref</td>";
            echo "<td><span class=\"tabletext\">$material_spec</td>";
            echo "<td><span class=\"tabletext\">$condition</td>";
            echo "<td><span class=\"tabletext\">$uom</td>";
            echo "<td><span class=\"tabletext\">$dia</td>";
            echo "<td><span class=\"tabletext\">$width</td>";
            echo "<td><span class=\"tabletext\">$length</td>";
            echo "<td><span class=\"tabletext\">$thick</td>";
            echo "<td><span class=\"tabletext\">$grainflow</td>";
            echo "<td><span class=\"tabletext\">$maxruling</td>";
            echo "<td><span class=\"tabletext\">$no_of_meterages</td>";

			 echo "<td><span class=\"tabletext\">$no_units_req</td>";


            echo "<td><span class=\"tabletext\">$no_of_lengths</td>";
            echo "<td><span class=\"tabletext\">$due</td>";
            echo "<td><span class=\"tabletext\">$delvby</td>";
            printf('<td><span class="tabletext">%s %.2f</td>',$myrow["currency"],$myLI["rate"]);
            printf('<td align="right"><span class="tabletext">%s %.2f</td>',$myrow["currency"],$myLI["amount"]);

			}

        }
?>

          <tr>
          <tr class="bgcolor2" bordercolor="#CCCCCC" >
              <td bgcolor="#FFFFFF" colspan=17 align="right"><span class="tabletext"><b>Total</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["poamount"]); ?></td>
          </tr>
          <tr class="bgcolor2" bordercolor="#CCCCCC" >
              <td bgcolor="#FFFFFF" colspan=17 align="right"><span class="tabletext"><b>Tax</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["tax"]);  ?></td>
          </tr>
          <tr class="bgcolor2" bordercolor="#CCCCCC" >
              <td bgcolor="#FFFFFF" colspan=17 align="right"><span class="tabletext"><b>Shipping</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["shipping"]); ?></td>
          </tr>
          <tr class="bgcolor2" bordercolor="#CCCCCC" >
              <td bgcolor="#FFFFFF" colspan=17 align="right"><span class="tabletext"><b>Labor</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["labor"]); ?></td>
          </tr>
          <tr class="bgcolor2" bordercolor="#CCCCCC" >
              <td bgcolor="#FFFFFF" colspan=17 align="right"><span class="tabletext"><b>Total Due</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><b><?php printf('%s %.2f',$myrow["currency"],$myrow["total_due"]); ?></b></td>
          </tr>
          <tr class="bgcolor2" bordercolor="#CCCCCC" >
              <td bgcolor="#FFFFFF" colspan=18 border=none><span class="tabletext"><b><center>This Order is approved electronically, hence no signature is required</center></b></td>
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

<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td colspan=1><span class="labeltext"><p align="center">Terms & Conditions</p></font></td>
</tr>
<tr class="bgcolor2" bordercolor="#CCCCCC" >
<td colspan=17><span class=\"tabletext\"><pre><?php echo $remarks?></pre></td>
</tr>
</table>
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >
            <td colspan=2><span class="labeltext"><?php printf('%s',$myrow["formatnum"]);?></td>
            <td colspan=4><span class="labeltext"><?php printf('%s',$myrow["formatrev"]);?></td>
            <td colspan=11><span class="labeltext">&nbsp;</td>
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



 
