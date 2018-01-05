<?php
session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$ecorecnum = $_SESSION['recnum'];

$_SESSION['pagename'] = 'updateeco'; 
//////session_register('pagename');
// First include the class definition 
include_once('classes/loginClass.php');
include('classes/ecoClass.php'); 
include('classes/supportClass.php'); 
include('classes/displayClass.php'); 
$newdisp = new display; 
$newsupp = new support; 
$neweco = new eco;
$newlogin = new userlogin;
$newlogin->dbconnect();

?>
<html>
<head>
<title>Edit ECO</title>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/eco.js"></script>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
 <form action='processeco.php' method='post' enctype='multipart/form-data'>
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
					<?php $newdisp->dispLinks(''); 
	$result=$neweco->getecos4prntUpd($ecorecnum);
	$myrow = mysql_fetch_row($result);
	$result1=$newsupp->getcontacts4support($ecorecnum,'ECO');
	$myrow1=mysql_fetch_row($result1);
	$result4=$newsupp->getwonum4support($ecorecnum,'ECO');
	$myrow4=mysql_fetch_row($result4);
	$result5=$newsupp->getsolnum4support($ecorecnum,'ECO');
	$myrow5=mysql_fetch_row($result5);
?>
						<table width=100% border=0 cellpadding=0 cellspacing=0  >
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/spacer.gif " width="6"></td>
								<td bgcolor="#FFFFFF">
									<table width=100% border=0 cellpadding=6 cellspacing=0  >
										<tr><td>
											 <table width=100% border=0>
												<tr>
													  <td><span class="pageheading"><b>Edit ECO</b></td>
													
    												</tr>
										     	 </table>
										</td></tr>

										<tr>
											<td>
												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
													
        														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
      	         													<tr bgcolor="#FFFFFF"  >
            	      																<td><span class="labeltext"><p align="left">ECO #</p></font></td>
           	      																<td ><span class="labeltext"><?php echo "$myrow[1]";?></td>
																	<input type="hidden" name="econum" value="<?php echo "$myrow[1]";?>">
																	<td><span class="labeltext"><p align="left">Doc Date</p></font></td>
      		            															<td><input type="text" name="doc_date" 
  		             																style="background-color:#DDDDDD;" 
                   	              																readonly="readonly" size=15 value="<?php echo "$myrow[2]";?>">
																		<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDocDate()">	
            																	</td>
																
														</tr>
														<tr bgcolor="#FFFFFF"  >
						           		            									<td><span class="labeltext"><p align="left">Sch Due Date</p></font></td>
      		            															<td><input type="text" name="sch_date" 
  		             																style="background-color:#DDDDDD;" 
                   	              																readonly="readonly" size=15 value="<?php echo "$myrow[3]";?>">
																		<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetSchDueDate()">	
            																	</td>
            																	<td><span class="labeltext"><p align="left">Actual Completion Date</p></font></td>
          			  														<td><input type="text" name="due_date" 
                   		 															style="background-color:#DDDDDD;" 
                 		  	 														readonly="readonly" size=15 value="<?php echo "$myrow[4]";?>">
																		<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetRecDate()">	
            																	</td>
																
														</tr>
														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Work Order Information</b></center></td></tr>														</tr>
<tr bgcolor="#FFFFFF"  >
<?php
$result3=$neweco->getwonum4eco($myrow4[0]);
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
            			     															readonly="readonly" size=20 value="<?php echo "$myrow3[1]";?>">
												          			 		</td>
		  														
														</tr>
														<tr bgcolor="#FFFFFF"  >
       			  														<td ><span class="labeltext"><p align="left">Contact&nbsp;</p></td>
           		               									 						<td><input type="text" name="con" 
                           																	style="background-color:#DDDDDD;" 
                    																	readonly="readonly" size=15 value="<?php echo "$myrow3[2]" . "$myrow3[3]";?>">																	
																		</td>
               																		<input type="hidden" name="contactrecnum1">
		                 														<td><span class="labeltext"><p align="left">Email</p></font></td>
          			 							 							<td><input type="text" name="em" style="background-color:#DDDDDD;"
                        		 															readonly="readonly" size=20 value="<?php echo "$myrow3[4]";?>"></td>
																
										      				
														</tr>
														<tr bgcolor="#FFFFFF"  ><td><span class="labeltext"><p align="left">Designer</p></font></td>
          			 							 							<td><input type="text" name="des" 
               			    															 style="background-color:#DDDDDD;" 
            			     															readonly="readonly" size=15 value="<?php echo "$myrow3[5]" . "$myrow3[6]";?>">
												          			 		</td><td colspan=2>&nbsp;</td>
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
                           									   						readonly="readonly" size=15 value="<?php echo "$myrow1[1]";?>">
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
                    								     							readonly="readonly" size=15 value="<?php echo  "$myrow1[5]";?>"></td>
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
														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Reason for Return</b></center></td></tr>
<tr bgcolor="#FFFFFF" >
          													 				<td colspn=2><span class="labeltext"><p align="left">Our mistake&nbsp;&nbsp;&nbsp;&nbsp; </p></td>
																	<?php if($myrow[7]=='y') {
                 		  														           echo "<td ><input type=\"checkbox\" name=\"omistake\" value=\"\" checked></td>";}
																	else {
																	           echo"<td ><input type=\"checkbox\" name=\"omistake\" value=\"\" ></td>"; }?>
																	<td ><span class="labeltext"><p align="left">Customer Change Request </p></font></td>
          			 														<?php if($myrow[8]=='y') {
                 		  														           echo "<td ><input type=\"checkbox\" name=\"cmistake\" value=\"\" checked></td>";}
																	else {
																	           echo"<td ><input type=\"checkbox\" name=\"cmistake\" value=\"\" ></td>"; }?>
                 		  														
																
														</tr>
														<tr bgcolor="#FFFFFF" >
          													 				<td ><span class="labeltext"><p align="left">Tester Type</p></font></td>
                 		  														<td ><input type="text" name="tester_type" value="<?php echo "$myrow[5]";?>"></td>
          			 														<td ><span class="labeltext"><p align="left">Tester Model </p></font></td>
                 		  														<td ><input type="text" name="tester_model" value="<?php echo "$myrow[6]";?>"></td>
																
														</tr>
        														 
														

														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>PCB Issue </b></center></td></tr>
        														<tr bgcolor="#FFFFFF" >
          													 				<td ><span class="labeltext"><p align="left">Gerber </p></font></td>
                 		  														<td ><input type="text" name="greber" size=15 value="<?php echo "$myrow[9]";?>"></td>
          			 														<td ><span class="labeltext"><p align="left">Layer # </p></font></td>
                 		  														<td ><input type="text" name="layer" size=15 value="<?php echo "$myrow[10]";?>"></td>
																
														</tr>
														 <tr bgcolor="#FFFFFF" >
          													 				<td ><span class="labeltext"><p align="left">Schematic </p></font></td>
                 		  														<td ><input type="text" name="schematic" size=15 value="<?php echo "$myrow[11]";?>"></td>
          			 														<td ><span class="labeltext"><p align="left">Sheet #</p></font></td>
                 		  														<td ><input type="text" name="sheet" size=15 value="<?php echo "$myrow[12]";?>"></td>
																
														</tr>
														<tr bgcolor="#FFFFFF" >
          													 				<td colspan=2 ><span class="labeltext"><p align="left">Remake the boards</p></font></td>
                 		  														<td ><input type="text" name="remake_board" size=15 value="<?php echo "$myrow[13]";?>"></td>
          			 														<td >&nbsp;</td>
                 		  														
																
														</tr>
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Socket Issue </b></center></td></tr>
														<tr bgcolor="#FFFFFF" >
          													 				<td><span class="labeltext"><p align="left">Footprint  </p></font></td>
                 		  														<td><input type="text" name="footprint" value="<?php echo "$myrow[14]";?>"></td>
          			 														<td ><span class="labeltext"><p align="left">Drawing #</p></font></td>
                 		  														<td ><input type="text" name="drawing" value="<?php echo "$myrow[15]";?>"></td>
																
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
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Error Description</b></center></td></tr>
        														<tr bgcolor="#FFFFFF">
           											 				<td colspan=4><textarea name="error_desc" rows="6" cols="88%" value=""><?php echo "$myrow[16]";?></textarea></td>
														</tr>
														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Short Term Solution Description</b></center></td></tr>
        														<tr bgcolor="#FFFFFF">
           											 				<td colspan=4><textarea name="sht_sol_desc" rows="6" cols="88%" value=""><?php echo "$myrow[17]";?></textarea></td>
														</tr >

<tr bgcolor="#FFFFFF"  >
            	      																<td colspan=2><span class="labeltext"><p align="left">Engineering Approval</p></font></td>
           	      																<td ><input type="text" name="sht_eng_app" size=15 value="<?php echo "$myrow[18]";?>"></td><td>&nbsp;</td>
</tr>	<tr bgcolor="#FFFFFF"  >
																	<td colspan=2><span class="labeltext"><p align="left">Approval Date</p></font></td>
      		            															<td colspan=2><input type="text" name="sht_app_date" 
  		             																style="background-color:#DDDDDD;" 
                   	              																readonly="readonly" size=15 value="<?php echo "$myrow[19]";?>">
																		<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetDesDate()">	
            																	</td>
																
            															
														</tr>
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Long Term Solution Description</b></center></td></tr>
        														<tr bgcolor="#FFFFFF">
           											 				<td colspan=4><textarea name="lng_sol" rows="6" cols="88%" value=""><?php echo "$myrow[20]";?></textarea></td>
														</tr>
														<tr bgcolor="#FFFFFF"  >
            	      																<td colspan=2><span class="labeltext"><p align="left">Engineering Approval</p></font></td>
           	      																<td ><input type="text" name="lng_eng_app" size=15 value="<?php echo "$myrow[21]";?>"></td><td>&nbsp;</td>
</tr><tr bgcolor="#FFFFFF"  >							
																	<td colspan=2><span class="labeltext"><p align="left">Approval Date</p></font></td>
      		            															<td colspan=2><input type="text" name="lng_app_date" 
  		             																style="background-color:#DDDDDD;" 
                   	              																readonly="readonly" size=15 value="<?php echo "$myrow[22]";?>">
																		<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetAssyDate()">	
            																	</td>
																            															
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