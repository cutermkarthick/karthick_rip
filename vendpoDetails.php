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
     header ( "Location: login.php" );
    
}

$porecnum = $_REQUEST['porecnum'];
$_SESSION['porecnum'] = $porecnum; 
$_SESSION['popage'] = 'vendpodetails'; 
//////session_register('popage');


// First include the class definition 

include('classes/poClass.php'); 
include('classes/liClass.php'); 
include('classes/displayClass.php'); 
$newdisp = new display; 
$newPO = new po; 
$newLI = new po_line_items; 
$result = $newPO->getPODetails($porecnum);
$myrow = mysql_fetch_row($result);

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/po.js"></script>

<html>
<head>
<title>PO Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr> 
        					<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        					<td align="right"><a href="chPassword.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/chpwd_mo.gif',1)"><img name="Image15" border="0" src="images/chpwd.gif"></a>
       					<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        				 </tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
<?php 
   $newdisp->dispLinks($myrow[7]); 
?>
						<table width=100% border=0 cellpadding=0 cellspacing=0  >
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/spacer.gif " width="6"></td>
								<td bgcolor="#FFFFFF">
									<table width=100% border=0 cellpadding=6 cellspacing=0  >
										<tr><td>
										       <table width=100% border=0>
											<tr>
												<td colspan=3><span class="pageheading"><b>PO Details</b></td>
												<td bgcolor="#FFFFFF" colspan=9 align="right"><input type= "image" name="Print" src="images/bu-print.gif" value="Get" onclick='javascript: printPO("<?php echo $porecnum ?>")'>
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
             <td  bgcolor="#F5F6F5" width=50%><span class="heading"><center><b>Vendor</b></center></td>
            <td bgcolor="#F5F6F5" width=50%><span class="heading"><b><center>Ship To</center></b></td>
       </tr>
        <tr bgcolor="#FFFFFF">
  <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF" width=50%><span class="tabletext"><?php echo $myrow[3]?></td>
            <td  bgcolor="#FFFFFF" width=50%><span class="tabletext">CIMTools India</td>
       </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF" width=50%><span class="tabletext">&nbsp</td>
            <td  bgcolor="#FFFFFF" width=50%><span class="tabletext">Peenya</td>
       </tr>
        <tr bgcolor="#FFFFFF">
            <td width=50%><span class="tabletext">&nbsp</td>
            <td width=50%><span class="tabletext">Bangalore, India</td>
       </tr>
      </table>
     
 <br>
     <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
         <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">PO Date</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow[1] ?></td>
            <td width=20%><span class="labeltext"><p align="left">PO #</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow[0] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">PO Desc</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow[2] ?></td>
            <td width=20%><span class="labeltext"><p align="left">WO #</p></font></td>
            <td width=20%><span class="tabletext"><a href="worder_det.php?typenum=<?php echo $myrow[12] ?>&wotype=<?php echo $myrow[11] ?>&worecnum=<?php echo $myrow[10] ?>"><?php echo $myrow[5] ?></a></td>
            </td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td width=20%  
            <td bgcolor="#EEEFEE" ><span class="labeltext"><p align="left">Status</p></font></td>
            <td width=200><span class="tabletext"><?php echo $myrow[7] ?>
            </td>
	<td colspan=140>&nbsp;</td>
        </tr>
</table>
 <br>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Ln</b></td>
            <td bgcolor="#EEEFEE"2><span class="heading"><b>ITEM</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Description</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Qty Per Year</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Material Ref</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Material Spec</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Thick/Dia</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Width</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Length</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Qty Per <br>Meter/Billet</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>No of Meterages<br>required or<br>No of Lengths</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Due</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Rate</b></td>
            <td bgcolor="#EEEFEE" align="right"><span class="heading"><b>Amount</b></td>

       </tr>

<?php

        $i = 0;
        
        $result = $newPO->getPODetails($porecnum);
        $myrow = mysql_fetch_assoc($result);
        
        $result = $newLI->getLI($porecnum);
        while ($myLI = mysql_fetch_assoc($result)) {

           if($myLI["duedate"] != '' && $myLI["duedate"] != '0000-00-00' && $myLI["duedate"] != 'NULL')
           {
            $d=substr($myLI["duedate"],8,2);
            $m=substr($myLI["duedate"],5,2);
            $y=substr($myLI["duedate"],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
           }
           else
           {
             $date = '';
           }
            //echo "$date";
            $line_num = $myLI["line_num"];
            $item_name = $myLI["item_name"];
            $item_desc = $myLI["item_desc"];
            $qty = $myLI["qty"];
            $material_ref = $myLI["material_ref"];
            $material_spec = $myLI["material_spec"];
            $thick = $myLI["thick"];
            $width = $myLI["width"];
            $length = $myLI["length"];
            $qty_per_meter = $myLI["qty_per_meter"];
            $no_of_meterages = $myLI["no_of_meterages"];


              $i = $i + 1;
	     echo"<tr><td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$line_num</td>" ;
                         echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\">$item_name</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$item_desc</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$material_ref</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$material_spec</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$thick</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$width</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$length</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty_per_meter</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$no_of_meterages</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$date</td>";
                         printf('<td bgcolor="#FFFFFF"><span class="tabletext">Rs %.2f</td>',$myLI["rate"]);
                         printf('<td align="right" bgcolor="#FFFFFF"><span class="tabletext">Rs %.2f</td>',$myLI["amount"]);

        }
?>

          <tr>
          <tr>
              <td bgcolor="#FFFFFF" colspan=13 align="right"><span class="tabletext"><b>Total</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('Rs %.2f',$myrow["poamount"]); ?></td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" colspan=13 align="right"><span class="tabletext"><b>Tax</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('Rs %.2f',$myrow["tax"]);  ?></td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" colspan=13 align="right"><span class="tabletext"><b>Shipping</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('Rs %.2f',$myrow["shipping"]); ?></td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" colspan=13 align="right"><span class="tabletext"><b>Labor</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('Rs %.2f',$myrow["labor"]); ?></td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" colspan=13 align="right"><span class="tabletext"><b>Total Due</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('Rs %.2f',$myrow["total_due"]); ?></td>
          </tr>
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
						<table border = 0 cellpadding=0 cellspacing=0 width=100% >
							<tr>
								<td align=left>   

								</td>
							</tr>
						</table>
					</FORM>
		</body>
</html>
