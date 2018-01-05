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
$_SESSION['pagename'] = 'view_poDetails';
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
<script language="javascript" type="text/javascript" >
function readOnlyCheckBox() {
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
<td width=50%><span class="tabletext">CIMTools Pvt Ltd.</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=50%><span class="tabletext"><?php echo $myrow["addr1"] . " " . $myrow["addr2"]; ?></td>
<td width=50%><span class="tabletext">Plot No. 467-469, Site No. 1D,</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=50%><span class="tabletext"><?php echo $myrow["city"] . " " . $myrow["state"]. " " . $myrow["zipcode"]; ?></td>
<td width=50%><span class="tabletext">12th Cross, 4th Phase,PIA</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=50%><span class="tabletext"><?php echo $myrow["country"]; ?></td>
<td width=50%><span class="tabletext">Bangalore 560 058, Karnataka- INDIA.</td>
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
			              cols="100" value=""><?php echo $amend_notes." \n"?></textarea></td>
			</tr>

			<?
              $terms=wordwrap($myrow["terms"],100,"\n",true);
             ?>
			<tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Header</p></font></td>
            <td width=20% colspan=5><span class="tabletext"><textarea  name="terms" rows="2"
                          style="background-color:#DDDDDD;" readonly="readonly"
			              cols="100" value=""><?php echo $terms." \n"?></textarea></td>
			</tr>
		<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Remarks</p></font></td>
<td colspan=5><span class=\"tabletext\"><textarea  name="remarks" rows="3"
                          style="background-color:#DDDDDD;" readonly="readonly"
			              cols="110" value=""><?php echo $remarks." \n" ?></textarea></td>
</tr>
</table>
 <br>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Ln</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Mtl Type</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Mtl Spec</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Condition</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>UOM</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Dia</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Length</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Width</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Thickness</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Grainflow</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Maxruling</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>No of<br>Meters req</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>No of<br>Lengths req</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Due</b></td>
	        <td bgcolor="#EEEFEE"><span class="heading"><b>Accepted</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Delv Mode</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Rate</b></td>
            <td bgcolor="#EEEFEE" align="right"><span class="heading"><b>Amount</b></td>
       </tr>

<?php
        $recnum_arr = array();
        $i = 0;
        $result = $newLI->getLI($porecnum);
        while ($myLI = mysql_fetch_assoc($result)) {

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
            if (trim($length) == "") 
            {
                $dia = $myLI['thick'];
            }
            else 
            {
                $thick = $myLI['thick'];
            }
            $qty_per_meter = $myLI["qty_per_meter"];
            $no_of_meterages = $myLI["no_of_meterages"];
            $no_of_lengths = $myLI["no_of_lengths"];
            $crn = $myLI["crn"];
            $maxruling = $myLI["maxruling"];
            $condition = wordwrap($myLI["condition"],5,"<br />\n");


              $i = $i + 1;
	     echo"<tr><td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$line_num</td>" ;
         echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\">$crn</td>";
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
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$accdate</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$delvby</td>";
                         printf('<td bgcolor="#FFFFFF"><span class="tabletext">%s %.2f</td>',$myrow["currency"],$myLI["rate"]);
                         printf('<td align="right" bgcolor="#FFFFFF"><span class="tabletext">%s %.2f</td>',$myrow["currency"],$myLI["amount"]);
      unset($condition);

        }
     //print_r($recnum_arr);
?>

          <tr>
          <tr>
              <td bgcolor="#FFFFFF" colspan=18 align="right"><span class="tabletext"><b>Total</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["poamount"]); ?></td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" colspan=18 align="right"><span class="tabletext"><b>Tax</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["tax"]);  ?></td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" colspan=18 align="right"><span class="tabletext"><b>Shipping</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["shipping"]); ?></td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" colspan=18 align="right"><span class="tabletext"><b>Labor</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["labor"]); ?></td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" colspan=18 align="right"><span class="tabletext"><b>Total Due</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["total_due"]); ?></td>
          </tr>
         <tr>
          
         </tr>
    <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
       <tr>
          <td bgcolor="#E0FFFF" colspan=16 align="center"><span class="heading"><b>Purchasing Allocation</b></td>
       </tr>
       <tr>
            <td bgcolor="#E0FFFF"><span class="heading"><b>Line Num</b></td>
            <td bgcolor="#E0FFFF"><span class="heading"><b>PO Num</b></td>
            <td bgcolor="#E0FFFF"><span class="heading"><b>Material Spec</b></td>
            <td bgcolor="#E0FFFF"><span class="heading"><b>PRN</b></td>
            <td bgcolor="#E0FFFF"><span class="heading"><b>Qty Allocated</b></td>
      </tr>

<?

 $poNum = $myrow["ponum"];
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
 }
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
<tr><td align="center"><span class="tabletext"><b>
If Material is ordered in Meters, the same 
can be supplied in random lengths but each
length not exceeding 3 meters
</b></td>
</tr>
<table border=3 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext"><?php printf('%s',$myrow["formatnum"]); ?></td>
            <td colspan=2><span class="labeltext"><?php printf('%s',$myrow["formatrev"]); ?></td>
            <td colspan=2><span class="labeltext">&nbsp;</td>
        </tr>

</table>
</table>
</FORM>
</body>
</html>
