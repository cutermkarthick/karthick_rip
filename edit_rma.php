<?php
session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$rmarecnum = $_SESSION['recnum'];
//echo "$rmarecnum";
$_SESSION['pagename'] = 'rmaupdate'; 
//////session_register('pagename');
// First include the class definition 
include_once('classes/loginClass.php');
include('classes/rmaclass.php'); 
include('classes/rmaitemsClass.php'); 
 include('classes/supportClass.php'); 
 include('classes/displayClass.php'); 
$newitems_ret = new rmaitems; 
$newrma = new rma;
$newlogin = new userlogin;
$newsupp = new support; 
$newdisp = new display; 
$newlogin->dbconnect();

?>
<html>
<head>
<title>Edit RMA</title>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/rma.js"></script>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
 <form action='processrma.php?rmarecnum=<?php echo $rmarecnum;?>' method='post' enctype='multipart/form-data'>
<?php
	include('header.html');
	$result=$newrma->getrmas4prntUpd($rmarecnum);
	$myrow = mysql_fetch_row($result);
	$result1=$newsupp->getcontacts4support($rmarecnum,'RMA');
	$myrow1=mysql_fetch_row($result1);
	$result4=$newsupp->getwonum4support($rmarecnum,'RMA');
	$myrow4=mysql_fetch_row($result4);
	$result5=$newsupp->getsolnum4support($rmarecnum,'RMA');
	$myrow5=mysql_fetch_row($result5);


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
					<?php $newdisp->dispLinks(''); ?>
						<table width=100% border=0 cellpadding=0 cellspacing=0  >
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/spacer.gif " width="6"></td>
								<td bgcolor="#FFFFFF">
									<table width=100% border=0 cellpadding=6 cellspacing=0  >
										<tr><td>
											 <table width=100% border=0>
												<tr>
													  <td><span class="pageheading"><b>Edit RMA</b></td>
													
    												</tr>
										     	 </table>
										</td></tr>

										<tr>
											<td>
												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
													
        														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
      	         													<tr bgcolor="#FFFFFF"  >
            	      																<td><span class="labeltext"><p align="left">RMA#</p></font></td><input type=hidden name="rmaid" value="<?php echo "$myrow[1]";?>">
           	      																<td ><span class="labeltext"><?php echo "$myrow[1]";?></td>
																	<td><span class="labeltext"><p align="left">Received  Date</p></font></td>
      		            															<td><input type="text" name="recive_date" 
  		             																style="background-color:#DDDDDD;" 
                   	              																readonly="readonly" size=15 value="<?php echo "$myrow[2]";?>">
																		<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetRecDate()">	
            																	</td>
																
            															
														</tr>
														<tr bgcolor="#FFFFFF"  >
						           		            									<td><span class="labeltext"><p align="left">Sch Due Date</p></font></td>
      		            															<td><input type="text" name="sch_due_date" 
  		             																style="background-color:#DDDDDD;" 
                   	              																readonly="readonly" size=15 value="<?php echo "$myrow[3]";?>">
																		<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetSchDueDate()">	
            																	</td>
            																	<td><span class="labeltext"><p align="left">Actual Completion Date</p></font></td>
          			  														<td><input type="text" name="act_comp_date" 
                   		 															style="background-color:#DDDDDD;" 
                 		  	 														readonly="readonly" size=15 value="<?php echo "$myrow[4]";?>">
																		<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDocDate()">	
            																	</td>
																
													<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Work Order Information</b></center></td></tr>														</tr>
<tr bgcolor="#FFFFFF"  >
<?php
$result3=$newrma->getwonum4rma($myrow4[0]);
$myrow3=mysql_fetch_row($result3); 
?>

       			  														<td><span class="labeltext"><p align="left">Work Order No&nbsp;</p></font></td>
          			  														<td><input type="text" name="wonum" 
               			    							 								style="background-color:#DDDDDD;" 
              			    										 			 		readonly="readonly" size=15 value="<?php echo "$myrow3[0]";?>">
																		<img src="images/bu_getwo.gif" alt="Get Wo No" onclick="GetWoNo()"></td>
           			  															<input type="hidden" name="worecnum" value="<?php echo "$myrow4[0]";?>">
																		<input type="hidden" name="designer1" value="0">
        			   									 					<td><span class="labeltext"><p align="left">Company</p></font></td>
          			 							 							<td><input type="text" name="company1" 
               			    															 style="background-color:#DDDDDD;" 
            			     															readonly="readonly" size=20 value="<?php echo "$myrow3[2]";?>">
												          			 		</td>
		  														
														</tr>
														<tr bgcolor="#FFFFFF"  >
       			  														<td ><span class="labeltext"><p align="left">Contact&nbsp;</p></td>
           		               									 						<td><input type="text" name="con" 
                           																	style="background-color:#DDDDDD;" 
                    																	readonly="readonly" size=15 value="<?php echo "$myrow3[3]" . "$myrow3[4]";?>">																	
																		</td>
               																		<input type="hidden" name="contactrecnum1">
		                 														<td><span class="labeltext"><p align="left">Email</p></font></td>
          			 							 							<td><input type="text" name="em" style="background-color:#DDDDDD;"
                        		 															readonly="readonly" size=20 value="<?php echo "$myrow3[5]";?>"></td>
																
										      				<input type="hidden" name="des" value="">
														</tr>

              										 				<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Customer Information</b></center></td></tr>
            									  					<tr bgcolor="#FFFFFF"  >
          											 				<td><span class="labeltext"><p align="left">Customer</p></font></td>
                    											   			<td><input type="text" name="company" 
                  									  						style=";background-color:#DDDDDD;" 
                  								  							readonly="readonly" size=15 value="<?php echo  "$myrow1[0]";?>">
																<img src="images/bu-getcustomer.gif" alt="Get Customer" onclick="GetAllCustomers()">
        								    								<input type="hidden" name="companyrecnum" value="<?php echo "$myrow1[10]";?>">
         										  					 </td>
          								  							<td><span class="labeltext"><p align="left">Phone</p></font></td>
           									 						<td><input type="text" name="phone" style="background-color:#DDDDDD;"
                           									   						readonly="readonly" size=20 value="<?php echo "$myrow1[1]";?>">
															</td>
         										 				</tr>
             														<tr bgcolor="#FFFFFF"  >
           										  					<td><span class="labeltext"><p align="left">Contact</p></font></td>
                      									 					<td><input type="text" name="contact" 
                  									         						style="background-color:#DDDDDD;" 
                						  									  readonly="readonly" size=15 value="<?php echo  $myrow1[2] . "  " . $myrow1[3];?>">
																<img src="images/bu-getcontact.gif" alt="Get Contact" onclick="GetContact()">
            								  								 <input type="hidden" name="contactrecnum" value="<?php echo "$myrow1[11]";?>">

            															</td>

            															<td><span class="labeltext"><p align="left">Email</p></font></td>
           										 					<td><input type="text" name="email" style="background-color:#DDDDDD;"
                    								     							readonly="readonly" size=20 value="<?php echo  "$myrow1[5]";?>"></td>
      													 	 </tr>
              										 				<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Owner Information</b></center></td></tr>       <tr bgcolor="#FFFFFF"  >
														<tr bgcolor="#FFFFFF"  >
          										 					<td><span class="labeltext"><p align="left">Owner</p></font></td>
                     											  			<td colspan=1><input type="text" name="contact1" 
                          										 					style="background-color:#DDDDDD;" 
                 									  						 readonly="readonly" size=15 value="<?php echo  $myrow1[6] . $myrow1[7];?>">
																<img src="images/bu-getemployee.gif" alt=="Assign Employees" onclick="GetAllEmps()">
																<input type="hidden" name="empnum" value="<?php echo "$myrow1[12]";?>">
            															</td>
															<td colspan=3>&nbsp;</td>
           									 					</tr>
       												  		<tr bgcolor="#FFFFFF"  >
            															<td><span class="labeltext"><p align="left">Phone</p></font></td>
            															<td><input type="text" name="phone1" style="background-color:#DDDDDD;"
                  									           						 readonly="readonly" size=15 value="<?php echo  "$myrow1[8]";?>"></td>
 
        											    				<td><span class="labeltext"><p align="left">Email</p></font></td>
         												   			<td><input type="text" name="email1" style="background-color:#DDDDDD;"
									                         						readonly="readonly" size=20 value="<?php echo  "$myrow1[9]";?>">
															</td>
										        				</tr>
      													<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Items Returned</b></center></td></tr>
														
																<tr>
									            								<td bgcolor="#EEEFEE" colspan=2><span class="heading"><b><center> Part #</center></b></td>
									            								<td bgcolor="#EEEFEE" colspan=2><span class="heading"><b><center>Quantity</center></b></td>
											  					</tr>

																	<?php
        															$result6 = $newitems_ret ->getrmaitems($rmarecnum);
       											 				

													$i=1;
													while($i<=6)			
													{
															while ($myreturn = mysql_fetch_row($result6)) 
												    	 		{	
																//echo "i am inside inner while loop";
																printf('<tr bgcolor="#FFFFFF">');
																$part="part" . $i;
																$qty="qty" . $i;
																$prevpart="prevpart" . $i;
																//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
																echo "<td  colspan=2 bgcolor=\"#FFFFFF\"><span class=\"tabletext\"><center><input type=\"text\"  name=\"$part\"  value=\"$myreturn[2]\" size=15></td>";
																echo "<input type=\"hidden\" name=\"$prevpart\" value=\"$myreturn[0]\">";
																echo "<td colspan=2 bgcolor=\"#FFFFFF\"><span class=\"tabletext\"><center><input type=\"text\" name=\"$qty\" size=15 value=\"$myreturn[3]\"></td>";
																printf('</tr>');
																$i++; 
															}
															
																//echo "i am in outside while loop";  
																printf('<tr bgcolor="#FFFFFF">');
																$part="part" . $i;
																$qty="qty" . $i;
																$prevpart="prevpart" . $i;
																//echo "<br>$linenumber<br>$itemname<br>$itemdesc<br>$qty<br>$rate<br>$duedate<br>";
																echo "<td  colspan=2 bgcolor=\"#FFFFFF\"><span class=\"tabletext\"><center><input type=\"text\"  name=\"$part\"  value=\"\" size=15></td>";
																echo "<input type=\"hidden\" name=\"$prevpart\" value=\"\">";
																echo "<td colspan=2 bgcolor=\"#FFFFFF\"><span class=\"tabletext\"><center><input type=\"text\" name=\"$qty\" size=15 value=\"\"></td>";
																printf('</tr>');
																$i++; 
												       	 }          												
  
													?>
														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Reason for Return</b></center></td></tr>
        														 <tr bgcolor="#FFFFFF"  >
           			 												<td colspan=4><textarea name="reason4return" rows="6" cols="88%" value=""><?php echo "$myrow[5]";?></textarea></td>
														</tr>
														<tr bgcolor="#FFFFFF" >
          													 				<td colspn=2><span class="labeltext"><p align="left">Our mistake&nbsp;&nbsp;&nbsp;&nbsp; </p></td>
																	<?php if($myrow[6]=='y') {
                 		  														           echo "<td ><input type=\"checkbox\" name=\"omistake\" value=\"\" checked></td>";}
																	else {
																	           echo"<td ><input type=\"checkbox\" name=\"omistake\" value=\"\" ></td>"; }?>
          			 														<td ><span class="labeltext"><p align="left">Customer Mistake </p></td>
																	<?php if($myrow[7]=='y') {
                 		  														           echo "<td ><input type=\"checkbox\" name=\"cmistake\" value=\"\" checked></td>";}
																	else {
																	           echo"<td ><input type=\"checkbox\" name=\"cmistake\" value=\"\" ></td>"; }?>
                 		  														
																
														</tr>
														<tr bgcolor="#FFFFFF" >
       			 														<td><span class="labeltext"><p align="left">Solution No</p></font></td>
          														  	<td colspan=3><input type="text" name="solnum" 
               			  									  				 style="background-color:#DDDDDD;" 
              			     													readonly="readonly" size=20 value="<?php echo "$myrow5[1]";?>">
           			 									 				<img src="images/bu-getsolnid.gif" alt="Get Sol No" onclick="GetSolNo()">
          																<input type="hidden" name="solrecnum" value=<?php echo "$myrow5[0]";?>>
           			 												</td>
																
														</tr>

														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Solution Description</b></center></td></tr>
        														<tr bgcolor="#FFFFFF">
           											 				<td colspan=4><textarea name="sol_desc" rows="6" cols="88%" value=""><?php echo "$myrow[8]";?></textarea></td>
														</tr>
														<tr bgcolor="#FFFFFF" >
       			 														<td ><span class="labeltext"><p align="left">Cost To us </p></font></td>
																	       <td ><input type="text" name="cost2us" value="<?php echo "$myrow[9]";?>" ></td>
																	<td><span class="labeltext"><p align="left">Cost To Customer </p></font></td>
																	        <td ><input type="text" name="cost2cust" value="<?php echo "$myrow[10]";?>" ></td>
																
                 		 									 					
																
														</tr>  
														<tr bgcolor="#FFFFFF" >
          											 						<td ><span class="labeltext"><p align="left"> Requote&nbsp;</p></td>
																	<?php if($myrow[11]=='y') {
                 		  														           echo "<td ><input type=\"checkbox\" name=\"requote\" value=\"\" checked></td>";}
																	else {
																	           echo"<td ><input type=\"checkbox\" name=\"requote\" value=\"\" ></td>"; }?>
                 		  														
          			 														<td><span class="labeltext"><p align="left">Reorder </p></td>
																	<?php if($myrow[12]=='y') {
                 		  														           echo "<td ><input type=\"checkbox\" name=\"reorder\" value=\"\" checked></td>";}
																	else {
																	           echo"<td ><input type=\"checkbox\" name=\"reorder\" value=\"\" ></td>"; }?>
                 		 									 					
																
														</tr>			
															<tr bgcolor="#FFFFFF" >
          											 						<td ><span class="labeltext"><p align="left">Design &nbsp;&nbsp;</p></td>
																	<?php if($myrow[13]=='y') {
                 		  														           echo "<td ><input type=\"checkbox\" name=\"design\" value=\"\" checked></td>";}
																	else {
																	           echo"<td ><input type=\"checkbox\" name=\"design\" value=\"\" ></td>"; }?>
                 		  														
          																	<td><span class="labeltext"><p align="left">Mfg &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
																	<?php if($myrow[14]=='y') {
                 		  														           echo "<td ><input type=\"checkbox\" name=\"mfg\" value=\"\" checked></td>";}
																	else {
																	           echo"<td ><input type=\"checkbox\" name=\"mfg\" value=\"\" ></td>"; }?>
                 		 									 					
        																
														</tr>			
														
														<tr bgcolor="#FFFFFF" >
          			 														<td ><span class="labeltext"><p align="left"> Assembly</p></td>
																	<?php if($myrow[15]=='y') {
                 		  														           echo "<td ><input type=\"checkbox\" name=\"assemply\" value=\"\" checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";}
																	else {
																	           echo"<td ><input type=\"checkbox\" name=\"assemply\" value=\"\" ></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; }?>
                 		  														
          			 													<td colspan=2>&nbsp;</td>
														</tr> 
														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Corrective Action</b></center></td></tr>
        														<tr bgcolor="#FFFFFF"  >
           			 												<td colspan=4><textarea name="error_desc" rows="6" cols="88%" value=""><?php echo "$myrow[16]";?></textarea></td>
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

        <br> 
        <span class="tabletext"><input type="submit" 
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                    <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">
        
      </FORM>
</table>



</body>
</html>