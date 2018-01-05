<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Oct 2004                     =
// Filename: poUpdate.php                      =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Displays PO for update                      =
//==============================================

    session_start();
    header("Cache-control: private");
    if ( !isset ( $_SESSION['user'] ) )
    {
       header ( "Location: login.php" );
    }
    $userid = $_SESSION['user'];
    if ( !isset ( $_SESSION['porecnum'] ) )
    {
     header ( "Location: login.php" );
    }
    $porecnum = $_SESSION['porecnum'];
    $cond = "c.name like '%'";
    $rowsPerPage = 6;
    $pageNum = 1;
    $offset = ($pageNum - 1) * $rowsPerPage;
    $_SESSION['pagename'] = 'purchasingUpdate';
    //////session_register('pagename');

// First include the class definition

    include('classes/poClass.php');
    include('classes/liClass.php');
    include('classes/displayClass.php');
    include('classes/purchasing_allocClass.php');
    $newdisp = new display;
    $newPO = new po;
    $newLI = new po_line_items;
    $newpurch = new purchasing_alloc;

    $result = $newPO->getPODetails($porecnum);
    $myrow = mysql_fetch_assoc($result);

    $result1 = $newPO->getPODetails($porecnum);
    $myrow1 = mysql_fetch_row($result1);

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/po.js"></script>

<html>
<head>
<title>PO Update</title>
</head>
<body leftmargin="0"topmargin="0" margin width="0">
<form action='processPo.php' method='post' enctype='multipart/form-data'>

<?php
    include('header.html');
?>
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
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td></td></tr>
<tr>
<td>
<?php
	$newdisp->dispLinks('');
?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr><td>
<table width=100% border=0>
<tr>
<td colspan=2><span class="pageheading"><b>PO Details</b></td>
<td colspan=20>&nbsp;</td>
</tr>
</table>
</td></tr>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<td width=50% bgcolor="#EEEFEE" ><span class="heading"><center><b>Supplier</b></center></td>
<td width=50% bgcolor="#EEEFEE" ><span class="heading"><b><center>Ship To</center></b></td>
<input type="hidden" name="activeval" value="<?php echo $myrow1[7] ?>">
<input type="hidden" name="vendrecnum" value="<?php echo $myrow1[8] ?>">
<input type="hidden" name="vendor" value="<?php echo $myrow["name"] ?>">
<input type="hidden" name="porecnum" value="<?php echo $myrow1[9] ?>">
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<td width=50%><span class="tabletext"><?php echo $myrow["name"]?></td>
<td width=50%><span class="tabletext">CIMTools Pvt Ltd.</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=50%><span class="tabletext">&nbsp</td>
<td width=50%><span class="tabletext">Peenya</td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=50%><span class="tabletext">&nbsp</td>
<td width=50%><span class="tabletext">Bangalore, India.</td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF" >
<td width=20%><span class="labeltext"><p align="left">PO Date</p></font></td>
<td width=40% ><input type="text" name="podate" style="Border:none;" readonly="readonly" size=10% value="<?php echo $myrow["podate"] ?>">
	</td>
<td width=15%><span class="labeltext"><p align="left">PO #</p></font></td>
 <td width=20%><span class="tabletext"><input type="text"  name="ponum" value="<?php echo $myrow["ponum"] ?>" style="Border:none;" readonly="readonly" ></td>
 <input type="hidden" name="ponum" style="Border:none;" value="<?php echo $myrow["ponum"] ?>">
 </tr>
 <tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">PO Desc</p></font></td>
<td ><span class="tabletext"><input type="text"   name="desc" style="Border:none;"  size =40% value="<?php echo $myrow["podescr"] ?>"></td>
<td><span class="labeltext"><p align="left">Currency</p></font></td>
<td><span class="tabletext"><input type="text" name="currency"
              style="Border:none;" readonly="readonly"  value="<?php echo $myrow["currency"] ?>"
	<span class="tabletext">
 </td>
</tr>
<tr bgcolor="#FFFFFF">
<td width=20%><span class="labeltext"><p align="left">Status</p></font></td>
<td colspan=3><span class="tabletext"><input type="text" name="status"
                style="Border:none" readonly="readonly"  value="<?php echo $myrow["status"] ?>"
	<span class="tabletext">
 </td>
 </tr>
 <br>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td colspan=14><span class="heading"><center><b>Line Items</b></center></td>
<tr bgcolor="#FFFFFF">
<tr>
<td bgcolor="#EEEFEE" width=3%><span class="heading"><b>Line</b></td>
<!--<td bgcolor="#EEEFEE" width=13%><span class="heading"><b>RM Code</b></td>-->
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>RM Type</b></td>
<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>RM Spec</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>UOM</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Dia</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Length</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Width</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Thick</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Grain Flow</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>No of Meters req</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>No of Lengths req</b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b>Due Date</b></td>
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Delv By</b></td>
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Accepted Date</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Rate</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Amount</b></td></tr>
<?php
        $poNum = $myrow["ponum"];
        $link2poli_arr = array();
  		$result = $newLI->getLI($porecnum);
		$i=1;$flag=0;
        $j=1;
				while ($myLI = mysql_fetch_row($result))
	  	 		{
					//echo "i am inside inner while loop";
					printf('<tr bgcolor="#FFFFFF">');
					$linenumber="line_num" . $i;
					$itemname="rmcode" . $i;
					$itemdesc="item_desc" . $i;
					$qty="qty" . $i;
					$material_ref="material_ref" . $i;
					$material_spec="material_spec" . $i;
					$uom="uom" . $i;
					$dia="dia" . $i;
					$thick="thick" . $i;
					$width="width" . $i;
				    $len="len" . $i;
					$grainflow="grainflow" . $i;
					$qty_per_meter="qty_per_meter" . $i;
					$no_of_meterages="no_of_meterages" . $i;
					$no_of_lengths="no_of_lengths" . $i;
					$duedate="due_date" . $i;
                    $delvby="delvby" . $i;
                    $del="del" . $i;
					$accepted_date="accepted_date" . $i;
					$rate="rate" . $i;
					$amount="amount" . $i;
					$prevlinenum="prev_line_num" . $i;
					$lirecnum="lirecnum" . $i;

					$dia1 = "";
					$thick1 = "";
					$length1 =  $myLI[12];
					 if (trim($length1) == "")
                     {
                        $dia1 = $myLI[10];
                     }
                     else
                     {
                        $thick1 = $myLI[10];
                     }
                     
     	            echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[0]\">";
					echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[7]\">";

					//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
					echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\" style=\"Border:none;\" value=\"$myLI[0]\" size=\"2%\"></td>";

                    $link2poli_arr[] = $myLI[7];
                    $spec=str_replace(".","",$myLI[9]);
                    $spec1=str_replace(" ","",$spec);
                    $spec2=str_replace("-","",$spec1);
                    $link=$myLI[0];
                    echo "<input type=\"hidden\" name=\"$link\" value=\"$myLI[7]\">";
?>
						<!--<img src="images/bu-get.gif" alt="Get RMCode"  onclick="GetRM('<?php echo "$i";?>')">-->
<?php
					echo "<td><input type=\"text\" name=\"$material_ref\" style=\"Border:none;\" size=\"10%\" value=\"$myLI[8]\"></td>";
					echo "<td><input type=\"text\" name=\"$material_spec\" style=\"Border:none;\" size=\"10%\" value=\"$myLI[9]\"></td>";
					echo "<td><input type=\"text\" name=\"$uom\" style=\"Border:none;\" size=\"5%\" value=\"$myLI[16]\"></td>";
					echo "<td><input type=\"text\" name=\"$dia\" style=\"Border:none;\" size=\"5%\" value='$dia1'></td>";
                    echo "<td><input type=\"text\" name=\"$width\" style=\"Border:none;\" size=\"5%\" value='$myLI[11]'></td>";
                    echo "<td><input type=\"text\" name=\"$len\" style=\"Border:none;\" size=\"5%\"  value='$myLI[12]'></td>";
                    echo "<td><input type=\"text\" name=\"$thick\" style=\"Border:none;\" size=\"5%\"  value='$thick1'></td>";
					echo "<td><input type=\"text\" name=\"$grainflow\" style=\"Border:none;\" size=\"5%\" value='$myLI[17]'></td>";
                   // echo "<td><input type=\"text\" name=\"$qty_per_meter\" size=\"5%\" value=\"$myLI[13]\"></td>";
                    echo "<td><input type=\"text\" name=\"$no_of_meterages\" style=\"Border:none;\" size=\"5%\" value=\"$myLI[14]\"></td>";
					 echo "<td><input type=\"text\" name=\"$no_of_lengths\" style=\"Border:none;\" size=\"5%\" value=\"$myLI[18]\"></td>";
					echo "<td><input type=\"text\" name=\"$duedate\"
                   			style=\"Border:none;\"
                  	  		readonly=\"readonly\" size=\"8%\" value=\"$myLI[4]\">";
echo "<td>
     <span class=\"tabletext\"><input type=\"text\" name=\"$delvby\" style=\"Border:none;\" readonly=\"readonly\" size=\"4%\" value=\"$myLI[15]\"
	<span class=\"tabletext\">
 </td>";

                    echo "<td><input type=\"text\" name=\"$accepted_date\"
                   			style=\"Border:none;\"
                  	  		readonly=\"readonly\" size=\"8%\" value=\"$myLI[19]\">";
					echo "<td><input type=\"text\" name=\"$rate\" style=\"Border:none;\" size=\"10%\" value=\"$myLI[5]\"></td>";
					echo "<td><input type=\"text\" name=\"$amount\" style=\"Border:none;\"
                  			readonly=\"readonly\" size=\"10%\" value=\"$myLI[6]\">";
					printf('</tr>');
					$i++;
					$j++;
				}
				echo "<input type=\"hidden\" name=\"poli_index\" value=\"$j\">";
   	//print_r($link2poli_arr);

?>
<tr bgcolor="#FFFFFF">
<td colspan=15 align="right"><span class="tabletext"><b>Total</b></td>
<td><span class="tabletext" align=right><?php printf('%s %.2f',$myrow["currency"],$myrow["poamount"]); ?></td>
<tr>
<tr bgcolor="#FFFFFF">
<td colspan=15 align="right"><span class="tabletext"><b>Tax</b></td>
<td><span class="tabletext"><input type='text' name='tax' style="Border:none;" value='<?php printf('%.2f',$myrow["tax"]); ?>'></td>
<tr>
<tr bgcolor="#FFFFFF">
<td colspan=15 align="right"><span class="tabletext"><b>Shipping</b></td>
<td><span class="tabletext"><input type='text' name='shipping' style="Border:none;" value='<?php printf('%.2f',$myrow["shipping"]); ?>'></td>
<tr>
<tr bgcolor="#FFFFFF">
<td colspan=15 align="right"><span class="tabletext"><b>Labor</b></td>
<td><span class="tabletext"><input type='text' name='labor' style="Border:none;" value='<?php printf('%.2f',$myrow["labor"]); ?>'></td>
<tr>
<tr bgcolor="#FFFFFF">
<td colspan=15 align="right"><span class="tabletext"><b>Total Due</b></td>
<td><span class="tabletext" align=right><?php printf('%s %.2f',$myrow["currency"],$myrow["total_due"]); ?></td>
<tr>
</tr>
<input type="hidden" name="deleteflag" value="">
</table>
</td>
</tr>
<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#E0FFFF">
<td colspan=11><span class="heading"><center><b>Purchasing Allocation</b></center></td>
<tr>
<td bgcolor="#E0FFFF"><span class="heading"><b>Line Num</b></td>
<td bgcolor="#E0FFFF"><span class="heading"><b>Material Spec</b></td>
<td bgcolor="#E0FFFF"><span class="heading"><b>PRN</b></td>
<td bgcolor="#E0FFFF"><span class="heading"><b>Qty Allocated</b></td>
<?php

		$i=1;$flag=0;
		while($i<=3)
		{
			if($flag==0)
			{
              foreach($link2poli_arr as $link2poli)
              {
               $result4pur = $newpurch->getpurchDetails($link2poli,$poNum);
				while ($mypur = mysql_fetch_row($result4pur))
	  	 		{
					printf('<tr bgcolor="#FFFFFF">');
					$linenumber="linenum" . $i;

					$mat_spec="mat_spec" . $i;
					$crn="crn" . $i;
					$qty_allocated="qty_allocated" . $i;
					$prevlinenum="prev_line_num" . $i;
					$lirecnum="lirecnum" . $i;


                    echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$mypur[1]\">";
					echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$mypur[0]\">";

					echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"$mypur[1]\" size=\"4%\"></td>";
					echo "<td><input type=\"text\" id=\"$mat_spec\" name=\"$mat_spec\"  size=\"18%\" value=\"$mypur[2]\"></td>";
					echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$mypur[3]\"><img src=\"images/bu-get.gif\" alt=\"Get CIM\"  onclick=\"GetCIM( '$i')\"></td>";
					echo "<td><input type=\"text\" id=\"$qty_allocated\" name=\"$qty_allocated\" size=\"16%\" value=\"$mypur[4]\"></td>";
					printf('</tr>');

					$i++;
				}
               }
				$flag=1;
			}

			printf('<tr bgcolor="#FFFFFF">');
                 	$linenumber="linenum" . $i;
					$mat_spec="mat_spec" . $i;
					$crn="crn" . $i;
					$qty_allocated="qty_allocated" . $i;
					$prevlinenum="prev_line_num" . $i;
					$lirecnum="lirecnum" . $i;


            echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"\">";
			echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"\">";


		    echo "<td ><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\" name=\"$linenumber\"  value=\"\" size=\"4%\"></td>";
	        //echo "<td><input type=\"text\" id=\"$itemnum\" name=\"$itemnum\" size=\"10%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$mat_spec\" name=\"$mat_spec\"  size=\"18%\" value=\"\"></td>";
             echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  size=\"10%\" value=\"\"><img src=\"images/bu-get.gif\" alt=\"Get CIM\"  onclick=\"GetCIM('$i')\"></td>";
            echo "<td><input type=\"text\" id=\"$qty_allocated\" name=\"$qty_allocated\" size=\"16%\" value=\"\"></td>";
            printf('</tr>');
			$i++;
          }
          echo "<input type=\"hidden\" name=\"index\" value=$i>";

?>
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
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align=left>
</td>
</tr>
</table>
<span class="tabletext">
   <input type="submit"
   style="color=#0066CC;background-color:#DDDDDD;width=130;"
   value="Submit" name="submit" onclick="javascript: return check_req_fields()">
   <INPUT TYPE="RESET"
   style="color=#0066CC;background-color:#DDDDDD;width=130;"
   VALUE="Reset" onclick="javascript: putfocus()">
</FORM>
</body>
</html>
