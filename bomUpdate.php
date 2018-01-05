<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Oct 2004                     =
// Filename: poDetails.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
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

$_SESSION['pagename'] = 'poupdate'; 
//////session_register('pagename');


// First include the class definition 

include('classes/poClass.php'); 
include('classes/liClass.php'); 
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
<body leftmargin="0"topmargin="0" margin width="0">
<form action='processPo1.php' method='post' enctype='multipart/form-data'>

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
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
						<?php 
  							 $newPO->dispLinks($myrow[7]); 
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
											         	<td bgcolor="#FFFFFF" align="right"><input type= "image" name="Print" src="images/bu-delete.gif" value="Get" onclick="javascript: return ConfirmDelete()">
												</td>
    											</tr>
										      </table>
										</td></tr>

										<tr>
											<td>
  														<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
  															<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      																 <tr bgcolor="#FFFFFF">
           																	 <td width=50% bgcolor="#EEEFEE" ><span class="heading"><center><b>Vendor</b></center></td>
           										 							 <td width=50% bgcolor="#EEEFEE" ><span class="heading"><b><center>Ship To</center></b></td>
       																  </tr>
        															 </table>
       															<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
		    											   			<tr bgcolor="#FFFFFF">
          													  				<td width=50%><span class="tabletext"><?php echo $myrow[3]?></td>
           																	<td width=50%><span class="tabletext">Dimensions Consulting Inc.</td>
    							  									</tr>
		    									   					<tr bgcolor="#FFFFFF">
    								        									<td width=50%><span class="tabletext">&nbsp</td>
    								       									<td width=50%><span class="tabletext">3350 Scott Blvd., Bldg. 58</td>
    									   							</tr>
    							  									<tr bgcolor="#FFFFFF">
    								        									<td width=50%><span class="tabletext">&nbsp</td>
    									        								<td width=50%><span class="tabletext">Santa Clara, CA 95051</td>
    									  							</tr>
    							 								 </table>
     	 								  						 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
							      								 	<tr bgcolor="#FFFFFF" >
									            								<td width=20%><span class="labeltext"><p align="left">PO Date</p></font></td>
    																       	<td width=40% ><input type="text" name="podate" style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow[1] ?>">
       											      						<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDueDate('podate')">	
																		
           										 							</td>
           										 							<td width=15%><span class="labeltext"><p align="left">PO #</p></font></td>
            																	<td width=20%><span class="tabletext"><input type="text"  name="ponum" value="<?php echo $myrow[0] ?>"></td>
      									 							 </tr>
      										  						<tr bgcolor="#FFFFFF">
         										  							<td width=20%><span class="labeltext"><p align="left">WO #</p></font></td>
           					 												<td width=20%><span class="tabletext"><input type="text"   name="wonum" value="<?php echo $myrow[5] ?>"></td>
        									   								<td width=20%><span class="labeltext"><p align="left">Status</p></font></td>
         								  									 <td width=20%><span class="tabletext"><input type="text" name="status"  value="<?php echo $myrow[7] ?>"
           					 													<span class="tabletext"><select name="postat" size="1" width="20" onchange="onSelectStatus()">
          							  										 	<option selected>Please Specify
           							  											<option value>PRD
           							 										 	<option value>PR
           								  										<option value>PO
          									  									</select>
          																	 </td>
      																  </tr>
      															  	  <tr bgcolor="#FFFFFF">
         									   								<td width=20%><span class="labeltext"><p align="left">PO Desc</p></font></td>
         											   						<td colspan=8><span class="tabletext"><input type="text"   name="desc"  size =75% value="<?php echo $myrow[2] ?>"></td>
     											  					   </tr>
																    <br>

															</table>
										 					<br>
	
								  							<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
     									  							<tr>
      								    									 <td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Line #</b></td>
      									     								<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>ITEM</b></td>
       											    						<td bgcolor="#EEEFEE" width=11%><span class="heading"><b>Description</b></td>
          										  							<td bgcolor="#EEEFEE" width=5%><span class="heading"><b>Qty</b></td>
        										   							<td bgcolor="#EEEFEE" width=15%><span class="heading"><b>Due</b></td>
        							   										<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Rate</b></td>
      								     									<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Amount</b></td>

       																</tr>

																<?php

    								    									/*$i = 0; 
      								  									$result = $newLI->getLI($porecnum);
    							    										while ($myLI = mysql_fetch_row($result)) {
       							     										 $i = $i + 1;
   								          									$line[$i] = $myLI;

									       								 }
    								    									while ($i < 10) {
       								     									$i = $i + 1;
        									    								$line[$i] = $myLI;
   																	}*/
             													$result = $newLI->getLI($porecnum);
													$i=1;$flag=0;
													while($i<=15)			
													{
														if($flag==0)
														{
															while ($myLI = mysql_fetch_row($result))
												    	 		{	
																//echo "i am inside inner while loop";
																printf('<tr bgcolor="#FFFFFF">');
																$linenumber="line_num" . $i;
																$itemname="item_name" . $i;
																$itemdesc="item_desc" . $i;
																$qty="qty" . $i;
																$duedate="due_date" . $i;
																$rate="rate" . $i;
																$amount="amount" . $i;
																$prevlinenum="prev_line_num" . $i;
																$lirecnum="lirecnum" . $i;
																//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
																echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\"  value=\"$myLI[0]\" size=\"3%\"></td>";
																echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[0]\">";
																echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[7]\">";
																echo "<td><input type=\"text\" name=\"$itemname\" size=\"10%\" value=\"$myLI[1]\"></td>";
																echo "<td><input type=\"text\" name=\"$itemdesc\" size=\"20%\" value=\"$myLI[2]\"></td>";
																echo "<td><input type=\"text\" name=\"$qty\" size=\"5%\" value=\"$myLI[3]\"></td>";
																echo "<td><input type=\"text\" name=\"$duedate\"
                   															style=\"background-color:#DDDDDD;\" 
                  													  		readonly=\"readonly\" size=\"10%\" value=\"$myLI[4]\">";
             																?><img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDueDate('<?php echo "$duedate";?>')"><?php
																echo "<td><input type=\"text\" name=\"$rate\" size=\"10%\" value=\"$myLI[5]\"></td>";
																echo "<td><input type=\"text\" name=\"$amount\" style=\"background-color:#DDDDDD;\" 
                  											  				readonly=\"readonly\" size=\"10%\" value=\"$myLI[6]\">";		
																printf('</tr>');
																$i++; 
															}
															$flag=1;    
														}  
														//echo "i am in outside while loop";  
														printf('<tr bgcolor="#FFFFFF">'); 
    														$linenumber="line_num" . $i;
														$itemname="item_name" . $i;
														$itemdesc="item_desc" . $i;
														$qty="qty" . $i;
														$duedate="due_date" . $i;
														$rate="rate" . $i;
														$amount="amount" . $i;
														$prevlinenum="prev_line_num" . $i;
														$lirecnum="lirecnum" . $i;
														//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
														echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$linenumber\"  value=\"\" size=\"3%\"></td>";
														echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"\">";
														echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[7]\">";
														echo "<td><input type=\"text\" name=\"$itemname\" size=\"10%\" value=\"\"></td>";
														echo "<td><input type=\"text\" name=\"$itemdesc\" size=\"20%\" value=\"\"></td>";
														echo "<td><input type=\"text\" name=\"$qty\" size=\"5%\" value=\"\"></td>";
														echo "<td><input type=\"text\" name=\"$duedate\"
                   													style=\"background-color:#DDDDDD;\" 
                  										  			readonly=\"readonly\" size=\"10%\" value=\"\">";
             														?><img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDueDate('<?php echo "$duedate";?>')"><?php
														echo "<td><input type=\"text\" name=\"$rate\" size=\"10%\" value=\"\"></td>";
														echo "<td><input type=\"text\" name=\"$amount\" style=\"background-color:#DDDDDD;\" 
                  										  			readonly=\"readonly\" size=\"10%\" value=\"\">";		
														printf('</tr>');
														$i++;     
												       	 }          												

												?>

      											   					<tr bgcolor="#FFFFFF">
      		        
      										        							<td colspan=6><span class="tabletext"><b>Total</b></td>
      													      				 <td colspan=2><span class="tabletext">$<?php printf('%.2f',$myrow[6]); ?></td>
<tr>
      									    							</tr>
															<input type="hidden" name="activeval" value="<?php echo $myrow[7] ?>">
															<input type="hidden" name="vendrecnum" value="<?php echo $myrow[8] ?>">
															<input type="hidden" name="porecnum" value="<?php echo $myrow[9] ?>">
															<input type="hidden" name="deleteflag" value="">


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
        <span class="tabletext"><input type="submit" 
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">

					</FORM>
		</body>
</html>



