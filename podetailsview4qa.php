<?php
//
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
if ( !isset ( $_REQUEST['porecnum']) )
{
//echo "i am not set in podetails";
   header ( "Location: login.php" );
}

$cond = "c.name like '%'";
$rowsPerPage = 6;
$pageNum = 1;
$offset = ($pageNum - 1) * $rowsPerPage;
$porecnum = $_REQUEST['porecnum'];
$_SESSION['porecnum'] = $porecnum;
//////session_register('porecnum');
//echo "$porecnum";
$_SESSION['pagename'] = 'poviewdetails';
//////session_register('pagename');


// First include the class definition
include('classes/poClass.php');
include('classes/liClass.php');
include('classes/displayClass.php');
include('classes/purchasing_allocClass.php');
$newPO = new po;
$newdisplay = new display;
$newLI = new po_line_items;
$newpurch = new purchasing_alloc;
$result = $newPO->getPODetails($porecnum);
$myrow = mysql_fetch_assoc($result);
/* echo "i am 12 :$myrow[12]";
 echo "i am 11 :$myrow[11]";
 echo "i am 10 :$myrow[10]";*/
 $remarks=wordwrap($myrow["remarks"],105,"\n",true);
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/po.js"></script>
<script language="javascript" type="text/javascript">
function readOnlyCheckBox() {
//alert('sss');
   return false;
}
</script>

<html>
<head>
<title>PO Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');?>
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
<?php
   $newdisplay->dispLinks('');
?>
						<table width=100% border=0 cellpadding=0 cellspacing=0  >
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/spacer.gif " width="6"></td>
								<td bgcolor="#FFFFFF">
									<table width=100% border=0 cellpadding=6 cellspacing=0  >
										<tr><td>
										       <table width=100% border=0>

											<tr>

                                            <td align="left"><span class="pageheading"><b>PO Details</b></td>

                                                                            <td bgcolor="#FFFFFF" rowspan=2 align="right">

                   <?php
                            if($myrow['status']=="Open" && $myrow['approval']=="yes"){
                    ?>
                                                 <input type= "image" name="Print" src="images/bu-print.gif" value="Get" onclick='javascript: printPO4view("<?php echo $porecnum ?>")'>
                    <?php
                    }
                   ?>
                                                    </td>
    											</tr>
										      </table>
										</td></tr>

										<tr>
											<td>
  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
												         <tr bgcolor="#FFFFFF">

  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
     <form>
            <td  bgcolor="#F5F6F5" width=50%><span class="heading"><center><b>Supplier</b></center></td>
            <td bgcolor="#F5F6F5" width=50%><span class="heading"><b><center>Ship To</center></b></td>
       </tr>
        <tr bgcolor="#FFFFFF">

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<td width=50%><span class="tabletext"><?php echo $myrow["name"]?></td>
<td width=50%><span class="tabletext">Fluent Technologies.</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=50%><span class="tabletext"><?php echo $myrow["addr1"] . " " . $myrow["addr2"]; ?></td>
<td width=50%><span class="tabletext">#472, 2ND FLOOR,KEER PLAZA,</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=50%><span class="tabletext"><?php echo $myrow["city"] . " " . $myrow["state"]. " " . $myrow["zipcode"]; ?></td>
<td width=50%><span class="tabletext">ABOVE AXIS BANK, 80 FEET MAIN ROAD</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=50%><span class="tabletext"><?php echo $myrow["country"]; ?></td>
<td width=50%><span class="tabletext">Bangalore 560 079, Karnataka- INDIA.</td>
</tr>
</table>
 <br>
     <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
         <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">PO Date</p></font></td>
            <?php
              // echo"to--- ".$myrow["podate"];
              $datearr = split('-', $myrow["podate"]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
           // echo "$date";
            ?>
            <td width=20%><span class="tabletext"><?php echo $date ?></td>
            <td width=20%><span class="labeltext"><p align="left">PO #</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["ponum"] ?></td>

        </tr>
        <?php
            //echo"++++".$myrow["status"];
           if($myrow["status"]=="Pending")
           {
             $color = '"#FF0000"';
           }
           else if(($myrow["status"]=="Open")||($myrow["status"]=="open"))
           {
             $color = '"#00FF00"';
           }
           else if ($myrow["status"]=="Cancelled")
           {
              $color = '"#FFEABD"';
           }
            else if ($myrow["status"]=="Issued")
           {
              $color = '"#FFDADA"';
           }
           else
           {
              $color = '"#FFC89F"';
           }
         ?>
           <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">PO Desc</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["podescr"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Status</p></font></td>
            <td bgcolor=<?php echo $color ?> width=20%><span class="tabletext"><b><?php echo $myrow["status"] ?></b></td>

			</tr>
			<tr bgcolor="#FFFFFF">
			 <?php
            $checked="checked";
            ?>
            <td width=20%><span class="labeltext"><p align="left">Approval</p></font></td>
            <td width=20%><span class="tabletext"><input type="checkbox" <?php echo $myrow["approval"] == 'yes'?$checked:"" ?> onClick="return readOnlyCheckBox()"/></td>
           <td width=20%><span class="labeltext"><p align="left">Approval Date</p></font></td>
            <?php
             // echo"to--- ".$myrow["approvaldate"];
              if($myrow["approvaldate"] !='' && $myrow["approvaldate"] !='0000-00-00' && $myrow["approvaldate"] != 'null'){
              $datearr = split('-', $myrow["approvaldate"]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
            $x=mktime(0,0,0,$m,$d,$y);
            $date1=date("M j, Y",$x);
            }
            else
            $date1='';
            //echo "$date1";
            ?>
            <td width=20%><span class="tabletext"><?php echo $date1 ?></td>
			</tr>

			<tr bgcolor="#FFFFFF">
			<td width=20%><span class="labeltext"><p align="left">Amendment No.</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["amendment_num"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Amendment Date</p></font></td>
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
            <td width=20%><span class="tabletext"><?php echo $date2 ?></td>

        </tr>
        	<?
              $amend_notes=wordwrap($myrow["amendment_notes"],100,"\n",true);
             ?>
			<tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Amendment Notes</p></font></td>
            <td width=20% colspan=5><span class="tabletext"><textarea  name="amendment_notes" id="amendment_notes" rows="3"
                          style="background-color:#DDDDDD;" readonly="readonly"
			              cols="110" value=""><?php echo $amend_notes." \n"?></textarea></td>
			</tr>

			<?
              $terms=wordwrap($myrow["terms"],100,"\n",true);
             ?>
			<tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Header</p></font></td>
            <td width=20% colspan=5><span class="tabletext"><textarea  name="terms" rows="2"
                          style="background-color:#DDDDDD;" readonly="readonly"
			              cols="110" value=""><?php echo $terms." \n"?></textarea></td>
			</tr>
		<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Remarks</p></font></td>
<td colspan=5><span class=\"tabletext\"><textarea  name="remarks" rows="3"
                          style="background-color:#DDDDDD;" readonly="readonly"
			              cols="110" value=""><?php echo $remarks." \n" ?></textarea></td>
</tr>
<tr bgcolor="#FFFFFF">
<td colspan=1><span class="labeltext"><p align="left">Communication</p></font></td>
<?php
$comm = $myrow["communication"];
($comm == 10)?$checked='checked':$checked='';
echo "<td colspan=8><span class=\"tabletext\"><input type=\"radio\" name=\"communication\" value=\"10\" $checked onclick=\"return readOnlyCheckBox()\">10";
($comm == 20)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp<input type=\"radio\" name=\"communication\" value=\"20\" $checked onclick=\"return readOnlyCheckBox()\">20";
($comm == 30)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;<input type=\"radio\" name=\"communication\" value=\"30\" $checked onclick=\"return readOnlyCheckBox()\">30";
($comm == 40)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp<input type=\"radio\" name=\"communication\" value=\"40\" $checked onclick=\"return readOnlyCheckBox()\">40";
($comm == 50)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp<input type=\"radio\" name=\"communication\" value=\"50\" $checked onclick=\"return readOnlyCheckBox()\">50";
($comm == 60)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp<input type=\"radio\" name=\"communication\" value=\"60\" $checked onclick=\"return readOnlyCheckBox()\">60";
($comm == 70)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp<input type=\"radio\" name=\"communication\" value=\"70\" $checked onclick=\"return readOnlyCheckBox()\">70";
($comm == 80)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp<input type=\"radio\" name=\"communication\" value=\"80\" $checked onclick=\"return readOnlyCheckBox()\">80";
($comm == 90)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp<input type=\"radio\" name=\"communication\" value=\"90\" $checked onclick=\"readOnlyCheckBox()\">90";
($comm == 100)?$checked='checked':$checked='';
echo "&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp<input type=\"radio\" name=\"communication\" value=\"100\" $checked onclick=\"return readOnlyCheckBox()\">100</td>";
?>
</table>
<br>
<table border = 1 cellpadding=0 cellspacing=0 width=100%>
<tr><td align="center"><span class="tabletext"><b>
Please quote each line item of the purchase order in invoice and CofC and dispatch as per line item only.
</b></td>
</tr></table>
 <br>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor='#FFFFFF'>
<td colspan=23></td>
<td bgcolor="#A0C544" colspan=3 align='center'><span class="heading"><b>Compliance</b></td>
<td bgcolor="#659EC7" align='center' colspan=3><span class="heading"><b>Rating</b></td>

</tr>
            <tr>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Ln</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Layout Ref#</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Delivery<br>Time</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Qty<br>Rej</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Spec Type</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Order<br>Qty</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Mtl Type</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Mtl Spec</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Con</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>UOM</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Dia</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Length</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Width</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Thickness</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>GF</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Max</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>No of<br>Mtr req</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>No of<br>Len req</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Due</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Qty Recd</b></td>
	        <td bgcolor="#EEEFEE"><span class="heading"><b>Acc</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Delv Mode</b></td>

            <td bgcolor="#A0C544"><span class="heading"><b>Quality</b></td>
            <td bgcolor="#A0C544"><span class="heading"><b>Delivery</b></td>
            <td bgcolor="#A0C544"><span class="heading"><b>Comm</b></td>

        <td bgcolor="#659EC7" width=4%><span class="heading"><b>Quality</b></td>
	    <td bgcolor="#659EC7" width=4%><span class="heading"><b>Delivery</b></td>
       <td bgcolor="#659EC7" width=4%><span class="heading"><b>Comm</b></td>
       <td bgcolor="#EEEFEE"><span class="heading"><b>Status</b></td>
            <!--<td bgcolor="#EEEFEE"><span class="heading"><b>Rate</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Amt</b></td>-->
       	    </tr>

<?php
        $recnum_arr = array();
        $i = 0;
        $netqus=0;
        $netdels=0;
        $netcomms=0;
        $result = $newLI->getLI($porecnum);
        $num_rows=mysql_num_rows($result);
        while ($myLI = mysql_fetch_assoc($result)) {
        $orderQty=$var = number_format($myLI["order_qty"],2);

	   if($myLI["duedate"] != '0000-00-00' && $myLI["duedate"] != '' && $myLI["duedate"] != 'NULL')
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
            $qty_ordered = 0;
            //echo "$date";
            $recnum_arr[] = $myLI["recnum"];
            $line_num = $myLI["line_num"];
            $item_name = $myLI["item_name"];
            $item_desc = $myLI["item_desc"];
            $qty = $myLI["qty"];
            $delvby = $myLI["delv_by"];
            $uom = $myLI["uom"];
            $grainflow = $myLI["grainflow"];
            $material_ref = $myLI["material_ref"];
            $material_spec = $myLI["material_spec"];
            $dia ="";
            $thick="";
            $width = $myLI["width"];
            $length = $myLI["length"];
            $layoutrefnum=$myLI["layoutrefnum"];
            if (trim($length) == "")
            {
                $dia = $myLI['thick'];
            }
            else
            {
                $thick = $myLI['thick'];
            }
            $qty_per_meter = $myLI["qty_per_meter"];
            $no_of_meterages = number_format($myLI["no_of_meterages"],2);
            $no_of_lengths = number_format($myLI["no_of_lengths"],2);

            $crn = $myLI["crn"];
            $maxruling = $myLI["maxruling"];
            $condition = wordwrap($myLI["condition"],5,"<br />\n");
            $qtyrej = ($myLI["qty_rej"] != 'NULL')?$myLI["qty_rej"]:0;
            if($myLI["delivery_time"] == 1)
            {
              $del = 'On Time';
              $del_rating = '100%';
            }
            else if($myLI["delivery_time"] == 2)
            {
              $del = '<<br>7 days late';
              $del_rating = '66.67%';
            }
            else if($myLI["delivery_time"] == 3)
            {
              $del = '><br>7 days late';
              $del_rating = '33.33%';
            }
            else
            {
              $del = '';
            }
            $qty_ordered = ($no_of_meterages+$no_of_lengths);

            $quality = ((($qty_ordered - $qtyrej)/$qty_ordered)*100);
            $order_qty=$myLI["order_qty"];
            $alt_spec=$myLI["alt_spec_rm"];
            $spec_type=$myLI["spec_type"];
            $qty_recd=$myLI["qty_recd"];
            $li_status=$myLI["status"];

         $i = $i + 1;
	     echo"<tr><td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$line_num</td>";
	     echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$layoutrefnum</td>";
         echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\">$del</td>";
         echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\">$qtyrej</td>";
          echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\">$spec_type</td>";
         echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\">$crn</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$orderQty</td>";
         //                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$material_ref</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$material_spec</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$condition</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$uom</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$dia</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$width</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$length</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$thick</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$grainflow</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$maxruling</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$no_of_meterages</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$no_of_lengths</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$date</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty_recd</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$accdate</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$delvby</td>";
                         printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext">%.2f%s</td>',$quality,'%');
                         printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext">%.2f%s</td>',$del_rating,'%');
                         printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext">%.2f%s</td>',$comm,'%');

                         $netqu=($quality*0.6);
			             $netdel=($del_rating*0.3);
                         $netcomm=($comm*0.1);
                         printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext">%.2f</td>',$netqu);
                         printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext">%.2f</td>',$netdel);
                         printf('<td bgcolor="#FFFFFF" align="right"><span class="tabletext">%.2f</td>',$netcomm);
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$li_status</td>";

                        // printf('<td bgcolor="#FFFFFF"><span class="tabletext">%s %.2f</td>',$myrow["currency"],$myLI["rate"]);
                        // printf('<td align="right" bgcolor="#FFFFFF"><span class="tabletext">%s %.2f</td>',$myrow["currency"],$myLI["amount"]);
         		 unset($condition);
$netqus = $netqus+$netqu;
$netdels =$netdels+ $netdel;
$netcomms =$netcomms+ $netcomm;
}     //print_r($recnum_arr);
?>
        <tr bgcolor='#FFFFFF'>
        <td colspan=24 align="right"><span class="tabletext"><b>Average</b></td>
        <?
	$netquality=$netqus/$num_rows;
	$netdelivery=$netdels/$num_rows;
        $netcommunication=$netcomms/$num_rows;
	$nettotal = ($netquality+$netdelivery+$comm);
	?>
	<td align=right><span class="tabletext" ><?php printf('%.2f',$netquality); ?></td>
	<td align=right><span class="tabletext"><?php printf('%.2f',$netdelivery); ?></td>
        <td align=right><span class="tabletext"><?php printf('%.2f',$netcommunication); ?></td>
        <td colspan=3></td>
          </tr>
         <tr bgcolor='#FFFFFF'>
             <td colspan=23 align="right"><span class="tabletext"><b>Total,pts</b></td>
<td colspan=3 align="right"><span class="tabletext" ><?php printf('%.2f',$nettotal); ?></td>
 <td colspan=4></td>
</tr>

        <!-- <tr bgcolor='#FFFFFF'>
   <td bgcolor="#FFFFFF"  align="right" colspan=30><span class="tabletext"><b>Total</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["poamount"]); ?></td>
</tr>

         <tr bgcolor='#FFFFFF'>
              <td bgcolor="#FFFFFF" align="right" colspan=30><span class="tabletext"><b>Tax</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["tax"]);  ?></td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" colspan=30 align="right"><span class="tabletext"><b>Shipping</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["shipping"]); ?></td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" colspan=30 align="right"><span class="tabletext"><b>Labor</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["labor"]); ?></td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" colspan=30 align="right"><span class="tabletext"><b>Total Due</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["total_due"]); ?></td>
          </tr>
         <tr>
           <td bgcolor="#FFFFFF" colspan=32 align="left">
                   <a href ="purchasingUpdate.php?porecnum=<?php echo $porecnum ?>"><img name="Image8" border="0" src="images/bu-edit.gif"></a></td>
         </tr> -->
 <!--   <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
       <tr>
          <td bgcolor="#E0FFFF" colspan=16 align="center"><span class="heading"><b>Purchasing Allocation</b></td>
       </tr>
       <tr>
            <td bgcolor="#E0FFFF"><span class="heading"><b>Line Num</b></td>
            <td bgcolor="#E0FFFF"><span class="heading"><b>PO Num</b></td>
            <td bgcolor="#E0FFFF"><span class="heading"><b>Material Spec</b></td>
            <td bgcolor="#E0FFFF"><span class="heading"><b>PRN</b></td>
            <td bgcolor="#E0FFFF"><span class="heading"><b>Qty Allocated</b></td>
      </tr> -->

<?

/* $poNum = $myrow["ponum"];
 //echo 'ponum='.$poNum;
 foreach($recnum_arr as $link2poli)
 {
   $result4pur = $newpurch->getpurchDetails($link2poli,$poNum);
    while ($mypur = mysql_fetch_assoc($result4pur)) {


            //echo "$date";
            $line_Num =  $mypur["linenum"];
            $ponum = $mypur["ponum"];
            $qty_alloc = $mypur["qty_allocated"];
            $crn = $mypur["crn"];
            $mat_spec = $mypur["mat_spec"];


                 echo"<tr><td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$line_Num</td>" ;
                 echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$ponum</td>";
                 echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$mat_spec</td>";
                 echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$crn</td>";
                 echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty_alloc</td>";
        }
 } */
 ?>
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

<table border = 1 cellpadding=0 cellspacing=0 width=100%>

<table border=3 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext"><?php printf('%s',$myrow["formatnum"]); ?></td>
            <td colspan=2><span class="labeltext"><?php printf('%s',$myrow["formatrev"]); ?></td>
            <td colspan=2><span class="labeltext">CIMTOOLS PRIVATE LIMITED</td>
        </tr>

</table>
</table>
</FORM>
</body>
</html>
