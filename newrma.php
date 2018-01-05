<?php
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'newrma';
$page="Support: New RMA";
//session_register('pagename');
// First include the class definition
include('classes/rmaClass.php');
include('classes/displayClass.php');
$newrma = new rma;
$newdisp = new display;
?>
<html>
<head>
<title>New RMA</title>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/rma.js"></script>
<script language="javascript" src="scripts/sr.js"></script>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
 <form action='processrma.php' method='post' enctype='multipart/form-data'>
<?php
	include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
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
 -->								<td bgcolor="#FFFFFF">
									<table width=100% border=0 cellpadding=6 cellspacing=0  >
										<tr><td>
											 <table width=100% border=0>
												<tr>
													  <td><span class="pageheading"><b>New RMA</b></td>

    												</tr>
										     	 </table>
										</td></tr>

										<tr>
											<td>
												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
      	         										<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
                                                                       <tr bgcolor="#FFFFFF"  >

            	      																<td><span class="labeltext"><p align="left">RMA#</p></td>
           	      																<td><input type="text" name="rmaid" size=15 value=""></td>
																	<td><span class="labeltext"><p align="left">Received  Date</p></td>
      		            															<td><input type="text" name="recive_date"
  		             																style="background-color:#DDDDDD;"
                   	              																readonly="readonly" size=15 value="">
																	   <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('recive_date')">

														</tr>
																<tr bgcolor="#FFFFFF"  >
																	<td><span class="labeltext"><p align="left">Sch Due Date</p></font></td>
      		            															<td><input type="text" name="sch_due_date"
  		             																style="background-color:#DDDDDD;"
                   	              																readonly="readonly" size=15 value="">
																		 <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('sch_due_date')">
            																	</td>
            																	<td><span class="labeltext"><p align="left">Actual Completion Date</p></font></td>
          			  														<td><input type="text" name="act_comp_date"
                   		 															style="background-color:#DDDDDD;"
                 		  	 														readonly="readonly" size=15 value="">
																		<img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('act_comp_date')">
            																	</td>

																</tr>
														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Work Order Information</b></center></td></tr>
														<tr bgcolor="#FFFFFF"  >
       			  														<td><span class="labeltext"><p align="left">Work Order No&nbsp;</p></font></td>
          			  														<td><input type="text" name="wonum"
               			    							 								style="background-color:#DDDDDD;"
              			    										 			 		readonly="readonly" size=15 value="">
																		<img src="images/bu_getwo.gif" alt="Get Wo No" onclick="GetWoNo()"></td>
           			  															<input type="hidden" name="worecnum" value="0">
																		<input type="hidden" name="designer1" value="0">
        			   									 					<td><span class="labeltext"><p align="left">Company</p></font></td>
          			 							 							<td><input type="text" name="company1"
               			    															 style="background-color:#DDDDDD;"
            			     															readonly="readonly" size=20value="">
												          			 		</td>

														</tr>
														<tr bgcolor="#FFFFFF"  >
       			  														<td ><span class="labeltext"><p align="left">Contact&nbsp;</p></td>
           		               									 						<td><input type="text" name="con"
                           																	style="background-color:#DDDDDD;"
                    																	readonly="readonly" size=15 value="">
																		</td>
               																		<input type="hidden" name="contactrecnum1">
		                 														<td><span class="labeltext"><p align="left">Email</p></font></td>
          			 							 							<td><input type="text" name="em" style="background-color:#DDDDDD;"
                        		 															readonly="readonly" size=20 value=""></td>


														</tr><tr bgcolor="#FFFFFF"  >

        			   									 					<td><span class="labeltext"><p align="left">Designer</p></font></td>
          			 							 							<td><input type="text" name="des"
               			    															 style="background-color:#DDDDDD;"
            			     															readonly="readonly" size=15 value="">
												          			 		</td><td colspan=2>&nbsp;</td>

														</tr>
														 <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Customer Information</b></center></td></tr>

       		<tr bgcolor="#FFFFFF"  >
        			    <td><span class="labeltext"><p align="left">Customer</p></font></td>
                      			 <td><input type="text" name="company"
            				    style=";background-color:#DDDDDD;"
                 			   readonly="readonly" size=15 value="">

				<img src="images/bu-getcustomer.gif" alt="Get Customer" onclick="GetAllCustomers()">
            				<input type="hidden" name="companyrecnum" value="0">

            			    </td>
            	 		   <td><span class="labeltext"><p align="left">Phone</p></font></td>
            			  <td><input type="text" name="phone" style="background-color:#DDDDDD;"
                              		   readonly="readonly" size=20 value=""></td>
  		  </tr>
     	                  <tr bgcolor="#FFFFFF"  >
            			 <td><span class="labeltext"><p align="left">Contact</p></font></td>
           		                <td><input type="text" name="contact"
                           		style="background-color:#DDDDDD;"
                    		readonly="readonly" size=15 value="">

				<img src="images/bu-getcontact.gif" alt="Get Contact" onclick="GetContact()">

               			<input type="hidden" name="contactrecnum" value="0">
		                 </td>
            			<td><span class="labeltext"><p align="left">Email</p></font></td>
          			  <td><input type="text" name="email" style="background-color:#DDDDDD;"
                        		 readonly="readonly" size=20 value=""></td>
        		</tr>
     <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Owner Information</b></center></td></tr>

       		 <tr bgcolor="#FFFFFF"  >
          			 <td><span class="labeltext"><p align="left">Owner</p></font></td>
                 		  <td colspan=1><input type="text" name="contact1"
                          			 style="background-color:#DDDDDD;"
                   			 readonly="readonly" size=15 value="">
				<img src="images/bu-getowner.gif" alt=="Assign Employees" onclick="GetAllEmps()">
				<input type="hidden" name="empnum" value="0">
            			</td>
   		                 <td colspan=3>&nbsp;</td>
		</tr>
<tr bgcolor="#FFFFFF"  >
            			<td><span class="labeltext"><p align="left">Phone</p></font></td>
            			<td><input type="text" name="phone1" style="background-color:#DDDDDD;"
                            		  readonly="readonly" size=15 value=""></td>
 		                <td><span class="labeltext"><p align="left">Email</p></font></td>
            			<td><input type="text" name="email1" style="background-color:#DDDDDD;"
                   		  readonly="readonly" size=20 value=""></td>
      		</tr>
																	<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Items Returned</b></center></td></tr>
																<tr>
									            								<td bgcolor="#EEEFEE" colspan=2><span class="heading"><b><center> Part #</center></b></td>
									            								<td bgcolor="#EEEFEE" colspan=2><span class="heading"><b><center>Quantity</center></b></td>
											  					</tr>
																	<tr><td bgcolor="#FFFFFF" colspan=2><center><input type="text" name="part1" size=20 value=""></td>
									            								<td bgcolor="#FFFFFF" colspan=2><center><input type="text" name="qty1" size=20 value=""></td></tr>
																	<tr><td bgcolor="#FFFFFF"  colspan=2><center><input type="text" name="part2" size=20 value=""></td>
									            								<td bgcolor="#FFFFFF"  colspan=2><center><input type="text" name="qty2" size=20 value=""></td></tr><tr>
																	<td bgcolor="#FFFFFF"  colspan=2><center><input type="text" name="part3" size=20 value=""></td>
									            								<td bgcolor="#FFFFFF"  colspan=2><center><input type="text" name="qty3" size=20 value=""></td></tr>
																	<tr><td bgcolor="#FFFFFF"  colspan=2><center><input type="text" name="part4" size=20 value=""></td>
									            								<td bgcolor="#FFFFFF"  colspan=2><center><input type="text" name="qty4" size=20 value=""></td></tr>
																	<tr><td bgcolor="#FFFFFF"  colspan=2><center><input type="text" name="part5" size=20 value=""></td>
									            								<td bgcolor="#FFFFFF"  colspan=2><center><input type="text" name="qty5" size=20 value=""></td></tr>
																	<tr><td bgcolor="#FFFFFF"  colspan=2><center><input type="text" name="part6" size=20 value=""></td>
									            								<td bgcolor="#FFFFFF"  colspan=2><center><input type="text" name="qty6" size=20 value=""></td></tr>

                                                        <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Reason for Return</b></center></td></tr>
        														 <tr bgcolor="#FFFFFF"  >
           			 												<td colspan=4><textarea name="reason4return" rows="6" cols="88%" value=""></textarea></td>
														</tr>
														<tr bgcolor="#FFFFFF" >
          													 				<td><span class="labeltext"><p align="left">Our mistake </p></td>
                 		  														<td ><input type="checkbox" name="omistake" value=""></td>
          			 														<td ><span class="labeltext"><p align="left">Customer Mistake </p></td>
                 		  														<td ><input type="checkbox" name="cmistake" value=""></td>

														</tr>
														<tr bgcolor="#FFFFFF" >
       			 														<td><span class="labeltext"><p align="left">Solution No</p></font></td>
          			 									 					<td><input type="text" name="solnum"
               			    					 										style="background-color:#DDDDDD;"
              			      															readonly="readonly" size=15 value="0">
																		<img src="images/bu-getsolnid.gif" alt="Get Sol No" onclick="GetSolNo()"></td>
           			 									 						<input type="hidden" name="solrecnum" value="0">
																	<td colspan=2>&nbsp;</td>

														</tr>
														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Solution Description</b></center></td></tr>
        														<tr bgcolor="#FFFFFF">
           											 				<td colspan=4><textarea name="sol_desc" rows="6" cols="88%" value=""></textarea></td>
														</tr>
														<tr bgcolor="#FFFFFF" >
       			 														<td ><span class="labeltext"><p align="left">Cost To us </p></font></td>
                 		 									 					<td ><input type="text" name="cost2us" value=""></td>
          									 								<td><span class="labeltext"><p align="left">Cost To Customer </p></font></td>
                 		 									 					<td ><input type="text" name="cost2cust" value=""></td>
														</tr>
														<tr bgcolor="#FFFFFF" >
          											 						<td ><span class="labeltext"><p align="left"> Requote&nbsp;</p></td>
                 		  														<td ><input type="checkbox" name="requote" value=""></td>
          			 														<td><span class="labeltext"><p align="left">Reorder </p></td>
                 		 									 					<td ><input type="checkbox" name="reorder" value=""></td>

														</tr>
														<tr bgcolor="#FFFFFF" >
          											 						<td ><span class="labeltext"><p align="left">Design &nbsp;&nbsp;</p></td>
                 		  														<td ><input type="checkbox" name="design" value=""></td>
          																	<td><span class="labeltext"><p align="left">Mfg </p></td>
                 		 									 					<td ><input type="checkbox" name="mfg" value=""></td>

														</tr>
														<tr bgcolor="#FFFFFF" >
          			 														<td ><span class="labeltext"><p align="left"> Assembly</p></td>
                 		  														<td ><input type="checkbox" name="assemply" value=""></td><td colspan=2>&nbsp;</td>

														</tr>
														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Corrective Action</b></center></td></tr>
        														<tr bgcolor="#FFFFFF"  >
           			 												<td colspan=4><textarea name="error_desc" rows="6" cols="88%" value=""></textarea></td>
														</tr>



        </table>
	</td>
    </tr>



</table>

</td>
			<!-- 	<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>
 -->
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