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
$_SESSION['pagename'] = 'vendpoupd'; 
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
        					<td align="right"><a href="chPassword.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/chpwd_mo.gif',1)"><img name="Image15" border="0" src="images/chpwd.gif"></a>
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
											         	<td bgcolor="#FFFFFF" align="center"><input type= "image" name="Print" src="images/bu-delete.gif" value="Get" onclick="javascript: return ConfirmDelete()">
												</td>
    											</tr>
										      </table>
										</td></tr>

										<tr>
											<td>								<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
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
            <td width=190><span class="labeltext"><p align="left">PO Date</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[1] ?></td>
            <td width=190><span class="labeltext"><p align="left">PO #</p></font></td>
            <td width=190><span class="tabletext"><?php echo $myrow[0] ?></td>
        </tr>
            <input type="hidden"  name="podate" value="<?php echo $myrow[1] ?>">
          <input type="hidden"  name="ponum" value="<?php echo $myrow[0] ?>">
        <tr bgcolor="#FFFFFF" >
            <td width=190><span class="labeltext"><p align="left">WO #</p></font></td>
            <td width=190><span class="tabletext"><?php echo $myrow[5] ?></td>
            <td width=190><span class="labeltext"><p align="left">Status</p></font></td>
            <td width=200><span class="tabletext"><?php echo $myrow[7] ?>
            </td>

        </tr>
            <input type="hidden"  name="wonum" value="<?php echo $myrow[5] ?>">
            <input type="hidden"  name="status" value="<?php echo $myrow[7] ?>">
        <tr bgcolor="#FFFFFF" >
            <td width=190><span class="labeltext"><p align="left">PO Desc</p></font></td>
            <td colspan=8><span class="tabletext"><?php echo $myrow[2] ?></td>
        </tr>
            <input type="hidden"  name="desc" value="<?php echo $myrow[2] ?>">
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

    								    									$i = 0; 
      								  									$result = $newLI->getLI($porecnum);
    							    										while ($myLI = mysql_fetch_row($result)) {
       							     										 $i = $i + 1;
   								          									$line[$i] = $myLI;

									       								 }
    								    									while ($i < 10) {
       								     									$i = $i + 1;
        									    								$line[$i] = $myLI;
   																	}
             																?>

    										   						<tr bgcolor="#FFFFFF">
           										 							<td><input type="text" name="line_num1" size=5% value="<?php echo $line[1][0] ?>"></td>
       													     				<td><input type="text" name="item_name1"  size=10% value="<?php echo $line[1][1] ?>"></td>
       								     									<td><input type="text" name="item_desc1"  size=20% value="<?php echo $line[1][2] ?>"></td>
        									    								<td><input type="text" name="qty1"  size=5% value="<?php echo $line[1][3] ?>"></td>
           									 								<td><input type="text" name="due_date1" 
            								       								 		style="background-color:#DDDDDD;" 
              										     						 		readonly="readonly"   size=10% value="<?php echo $line[1][4] ?>">
																		<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDueDate('duedate1')">	
           								  										
        										    							</td>
         									   								<td><input type="text" name="rate1"   size=10% value="<?php printf('%.2f',$line[1][5]); ?>"></td>
        											    						<td><input type="text" name="amount1" style=";background-color:#DDDDDD;" 
       									             									readonly="readonly"   size=10% value="<?php printf('%.2f',$line[1][6]); ?>">
																	</td>
      												  				</tr>
                											   				<tr bgcolor="#FFFFFF">
       											     						<td><input type="text" name="line_num2" size=5% value="<?php echo $line[2][0] ?>"></td>
       											     						<td><input type="text" name="item_name2"  size=10% value="<?php echo $line[2][1] ?>"></td>
       								    									<td><input type="text" name="item_desc2"  size=20% value="<?php echo $line[2][2] ?>"></td>
       											     						<td><input type="text" name="qty2"  size=5% value="<?php echo $line[2][3] ?>"></td>
       												     					<td><input type="text" name="due_date2" 
      															             			style="background-color:#DDDDDD;" 
         													           					readonly="readonly"   size=10%  value="<?php echo $line[2][4] ?>">
         											    							<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDueDate('duedate2')">	
          																	  </td>
          								  									  <td><input type="text" name="rate2"   size=10% value="<?php printf('%.2f',$line[2][5]); ?>"></td>
          											  						  <td><input type="text" name="amount2" style=";background-color:#DDDDDD;" 
         													           					readonly="readonly"   size=10% value="<?php printf('%.2f',$line[2][6]); ?>">
																	  </td>
    								   								 </tr>
      											 					 <tr bgcolor="#FFFFFF">
      									      								<td><input type="text" name="line_num3" size=5% value="<?php echo $line[3][0] ?>"></td>
        										    							<td><input type="text" name="item_name3"  size=10% value="<?php echo $line[3][1] ?>"></td>
         						   											<td><input type="text" name="item_desc3"  size=20% value="<?php echo $line[3][2] ?>"></td>
        									   								<td><input type="text" name="qty3"  size=5% value="<?php echo $line[3][3] ?>"></td>
        									    								<td><input type="text" name="due_date3" 
          							          											style="background-color:#DDDDDD;" 
         									         									 readonly="readonly"   size=10% value="<?php echo $line[3][4] ?>">
       											      							<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDueDate('duedate3')">	
      								    									 </td>
       															     		  <td><input type="text" name="rate3"   size=10% value="<?php printf('%.2f',$line[3][5]); ?>"></td>
           										 							  <td><input type="text" name="amount3" style=";background-color:#DDDDDD;" 
               										     								readonly="readonly"    size=10% value="<?php printf('%.2f',$line[3][6]); ?>">
																	  </td>
      								  								 </tr>
                  										  					 <tr bgcolor="#FFFFFF">
       								    									 <td><input type="text" name="line_num4" size=5% value="<?php echo $line[4][0] ?>"></td>
     							       										<td><input type="text" name="item_name4"  size=10% value="<?php echo $line[4][1] ?>"></td>
     								       									<td><input type="text" name="item_desc4"  size=20% value="<?php echo $line[4][2] ?>"></td>
     									       								<td><input type="text" name="qty4"  size=5% value="<?php echo $line[4][3] ?>"></td>
     									       								<td><input type="text" name="due_date4" 
     									               									style="background-color:#DDDDDD;" 
         									         									 readonly="readonly"   size=10% value="<?php echo $line[4][4] ?>">
     											        							<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDueDate('duedate4')">	
         									   								</td>
          										  							 <td><input type="text" name="rate4"   size=10% value="<?php printf('%.2f',$line[4][5]); ?>"></td>
          										  							  <td><input type="text" name="amount4" style=";background-color:#DDDDDD;" 
          									          									readonly="readonly"   size=10% value="<?php printf('%.2f',$line[4][6]); ?>">
																	  </td>
       													 			</tr>
      									  							<tr bgcolor="#FFFFFF">
        									    								<td><input type="text" name="line_num5" size=5% value="<?php echo $line[5][0] ?>"></td>
       									     								<td><input type="text" name="item_name5"  size=10% value="<?php echo $line[5][1] ?>"></td>
        								   									 <td><input type="text" name="item_desc5"  size=20% value="<?php echo $line[5][2] ?>"></td>
      									     								 <td><input type="text" name="qty5"  size=5% value="<?php echo $line[5][3] ?>"></td>
    										       							<td><input type="text" name="due_date5" 
           										        								 style="background-color:#DDDDDD;" 
          									         									 readonly="readonly"   size=10% value="<?php echo $line[5][4] ?>">
         										    								<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDueDate('duedate5')">	
        										   							</td>
            																	<td><input type="text" name="rate5"   size=10% value="<?php printf('%.2f',$line[5][5]); ?>"></td>
       											  						 <td><input type="text" name="amount5" style=";background-color:#DDDDDD;" 
          											         							 readonly="readonly"   size=10% value="<?php printf('%.2f',$line[5][6]); ?>">
																	</td>
     										  						</tr>
   											   					 <tr bgcolor="#FFFFFF">
     										       							<td><input type="text" name="line_num6" size=5% value="<?php echo $line[6][0] ?>"></td>
      											      						<td><input type="text" name="item_name6"  size=10% value="<?php echo $line[6][1] ?>"></td>
       										     							<td><input type="text" name="item_desc6"   size=20% value="<?php echo $line[6][2] ?>"></td>
      										     							<td><input type="text" name="qty6"  size=5% value="<?php echo $line[6][3] ?>"></td>
       											    						<td><input type="text" name="due_date6" 
        											            							style="background-color:#DDDDDD;" 
   											                						 readonly="readonly"   size=10% value="<?php echo $line[6][4] ?>">
  												          						<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDueDate('duedate6')">	
      								      									</td>
      								      									<td><input type="text" name="rate6"   size=10% value="<?php printf('%.2f',$line[6][5]); ?>"></td>
     										     							 <td><input type="text" name="amount6" style=";background-color:#DDDDDD;" 
  										                							  readonly="readonly"   size=10% value="<?php printf('%.2f',$line[6][6]); ?>">
																	</td>
 										     						 </tr>

  										     						 <tr bgcolor="#FFFFFF">
  											        						 <td><input type="text" name="line_num7" size=5% value="<?php echo $line[7][0] ?>"></td>
   										        							 <td><input type="text" name="item_name7"  size=10% value="<?php echo $line[7][1] ?>"></td>
     									       								 <td><input type="text" name="item_desc7"  size=20% value="<?php echo $line[7][2] ?>"></td>
      										      							 <td><input type="text" name="qty7"  size=5% value="<?php echo $line[7][3] ?>"></td>
     													      				<td><input type="text" name="due_date7" 
       								            										style="background-color:#DDDDDD;" 
         								           										readonly="readonly"   size=10% value="<?php echo $line[7][4] ?>">
     										       								<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDueDate('duedate7')">	
										            							</td>
								            									<td><input type="text" name="rate7"   size=10%  value="<?php printf('%.2f',$line[7][5]); ?>"></td>
									            								<td><input type="text" name="amount7" style=";background-color:#DDDDDD;" 
 												                 					 readonly="readonly"   size=10% value="<?php printf('%.2f',$line[7][6]); ?>">
																	</td>
  								      								</tr>

 										     						 <tr bgcolor="#FFFFFF">
  											      						    <td><input type="text" name="line_num8" size=5% value="<?php echo $line[8][0] ?>"></td>
  									          								    <td><input type="text" name="item_name8"  size=10% value="<?php echo $line[8][1] ?>"></td>
   									       								    <td><input type="text" name="item_desc8"   size=20% value="<?php echo $line[8][2] ?>"></td>
   								        									    <td><input type="text" name="qty8"  size=5% value="<?php echo $line[8][3] ?>"></td>
   										         							    <td><input type="text" name="due_date8" 
  										                  							style="background-color:#DDDDDD;" 
  																	                  readonly="readonly"   size=10% value="<?php echo $line[8][4] ?>">
   										         								<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDueDate('duedate8')">	
   										       							     </td>
     								       									      <td><input type="text" name="rate8"   size=10% value="<?php printf('%.2f',$line[8][5]); ?>"></td>
     							       										     <td><input type="text" name="amount8" style=";background-color:#DDDDDD;" 
       								            									       readonly="readonly"  size=10%  value="<?php printf('%.2f',$line[8][6]); ?>">
      									 							 </tr>
      									  							<tr bgcolor="#FFFFFF">
          									  								<td><input type="text" name="line_num9" size=5% value="<?php echo $line[9][0] ?>"></td>
           											 						<td><input type="text" name="item_name9"  size=10% value="<?php echo $line[9][1] ?>"></td>
         										  							<td><input type="text" name="item_desc9"  size=20%  value="<?php echo $line[9][2] ?>"></td>
         										   							<td><input type="text" name="qty9"  size=5% value="<?php echo $line[9][3] ?>"></td>
          									 								<td><input type="text" name="due_date9" 
           											         							style="background-color:#DDDDDD;" 
         									          									readonly="readonly"   size=10% value="<?php echo $line[9][4] ?>">
        											    							<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDueDate('duedate9')">	
        										   							 </td>
        										    							<td><input type="text" name="rate9"   size=10% value="<?php printf('%.2f',$line[9][5]); ?>"></td>
      										     							<td><input type="text" name="amount9" style=";background-color:#DDDDDD;" 
       								             										readonly="readonly"   size=10% value="<?php printf('%.2f',$line[9][6]); ?>">
																	</td>
     									  							</tr>

      											   					<tr bgcolor="#FFFFFF">
      		        
      										        							<td colspan=6><span class="tabletext"><b>Total</b></td>
      													      				 <td colspan=2><span class="tabletext">$<?php printf('%.2f',$myrow[6]); ?></td>
<tr>
															<input type="hidden" name="activeval" value="<?php echo $myrow[7] ?>">
															<input type="hidden" name="vendrecnum" value="<?php echo $myrow[8] ?>">
															<input type="hidden" name="porecnum" value="<?php echo $myrow[9] ?>">
															<input type="hidden" name="prev_line_num1" value="<?php echo $line[1][0] ?>">
															<input type="hidden" name="prev_line_num2" value="<?php echo $line[2][0] ?>">
															<input type="hidden" name="prev_line_num3" value="<?php echo $line[3][0] ?>">
															<input type="hidden" name="prev_line_num4" value="<?php echo $line[4][0] ?>">
															<input type="hidden" name="prev_line_num5" value="<?php echo $line[5][0] ?>">
															<input type="hidden" name="prev_line_num6" value="<?php echo $line[6][0] ?>">
															<input type="hidden" name="prev_line_num7" value="<?php echo $line[7][0] ?>">
															<input type="hidden" name="prev_line_num8" value="<?php echo $line[8][0] ?>">
															<input type="hidden" name="prev_line_num9" value="<?php echo $line[9][0] ?>">
															<input type="hidden" name="lirecnum1" value="<?php echo $line[1][7] ?>">
															<input type="hidden" name="lirecnum2" value="<?php echo $line[2][7] ?>">
															<input type="hidden" name="lirecnum3" value="<?php echo $line[3][7] ?>">
															<input type="hidden" name="lirecnum4" value="<?php echo $line[4][7] ?>">
															<input type="hidden" name="lirecnum5" value="<?php echo $line[5][7] ?>">
															<input type="hidden" name="lirecnum6" value="<?php echo $line[6][7] ?>">
															<input type="hidden" name="lirecnum7" value="<?php echo $line[7][7] ?>">
															<input type="hidden" name="lirecnum8" value="<?php echo $line[8][7] ?>">
															<input type="hidden" name="lirecnum9" value="<?php echo $line[9][7] ?>">
															<input type="hidden" name="deleteflag" value="">
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
        <span class="tabletext"><input type="submit" 
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">

					</FORM>
		</body>
</html>



