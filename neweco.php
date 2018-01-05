<?php
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$solrecnum=0;
$_SESSION['pagename'] = 'neweco';
$page="Support: New ECO";
//session_register('pagename');
// First include the class definition
include('classes/ecoClass.php');
include('classes/displayClass.php');
$newdisp = new display;
$neweco = new eco;
?>
<html>
<head>
<title>New eco</title>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/eco.js"></script>
<script language="javascript" src="scripts/sr.js"></script>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
 <form action='processeco.php' method='post' enctype='multipart/form-data'>
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
													  <td><span class="pageheading"><b>New ECO</b></td>

    												</tr>
										     	 </table>
										</td></tr>

										<tr>
											<td>
												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >

        														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
      	         													<tr bgcolor="#FFFFFF"  >
            	      																<td><span class="labeltext"><p align="left">ECO #</p></font></td>
           	      																<td ><input type="text" name="econum" size=15 value=""></td>
																	<td><span class="labeltext"><p align="left">Doc Date</p></font></td>
      		            															<td><input type="text" name="doc_date"
  		             																style="background-color:#DDDDDD;"
                   	              																readonly="readonly" size=15 value="">
																		<img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('doc_date')">
            																	</td>

														</tr>
														<tr bgcolor="#FFFFFF"  >
						           		            									<td><span class="labeltext"><p align="left">Sch Due Date</p></font></td>
      		            															<td><input type="text" name="sch_date"
  		             																style="background-color:#DDDDDD;"
                   	              																readonly="readonly" size=15 value="">
																		<img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('sch_date')">
            																	</td>
            																	<td><span class="labeltext"><p align="left">Actual Completion Date</p></font></td>
          			  														<td><input type="text" name="due_date"
                   		 															style="background-color:#DDDDDD;"
                 		  	 														readonly="readonly" size=15 value="">
																	   <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('due_date')">
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
            			     															readonly="readonly" size=20 value="">
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

														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Reason for Return</b></center></td></tr>

														<tr bgcolor="#FFFFFF" >
          													 				<td ><span class="labeltext"><p align="left">Our mistake </p></font></td>
                 		  														<td ><input type="checkbox" name="omistake" value=""></td>
          			 														<td ><span class="labeltext"><p align="left">Customer Change Request </p></font></td>
                 		  														<td ><input type="checkbox" name="cmistake" value=""></td>

														</tr>
														<tr bgcolor="#FFFFFF" >
          													 				<td ><span class="labeltext"><p align="left">Tester Type</p></font></td>
                 		  														<td ><input type="text" name="tester_type" value=""></td>
          			 														<td ><span class="labeltext"><p align="left">Tester Model </p></font></td>
                 		  														<td ><input type="text" name="tester_model" value=""></td>

														</tr>
														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>PCB Issue </b></center></td></tr>
        														<tr bgcolor="#FFFFFF" >
          													 				<td ><span class="labeltext"><p align="left">Gerber </p></font></td>
                 		  														<td ><input type="text" name="greber" size=15 value=""></td>
          			 														<td ><span class="labeltext"><p align="left">Layer # </p></font></td>
                 		  														<td ><input type="text" name="layer" size=15 value=""></td>

														</tr>
														 <tr bgcolor="#FFFFFF" >
          													 				<td ><span class="labeltext"><p align="left">Schematic </p></font></td>
                 		  														<td ><input type="text" name="schematic" size=15 value=""></td>
          			 														<td ><span class="labeltext"><p align="left">Sheet #</p></font></td>
                 		  														<td ><input type="text" name="sheet" size=15 value=""></td>

														</tr>
														<tr bgcolor="#FFFFFF" >
          													 				<td colspan=2 ><span class="labeltext"><p align="left">Remake the boards</p></font></td>
                 		  														<td ><input type="text" name="remake_board" size=15 value=""></td>
          			 														<td >&nbsp;</td>


														</tr>
                                                    <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Socket Issue </b></center></td></tr>
														<tr bgcolor="#FFFFFF" >
          													 				<td><span class="labeltext"><p align="left">Footprint  </p></font></td>
                 		  														<td><input type="text" name="footprint" value=""></td>
          			 														<td ><span class="labeltext"><p align="left">Drawing #</p></font></td>
                 		  														<td ><input type="text" name="drawing" value=""></td>

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
                                                    <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Error Description</b></center></td></tr>
        														<tr bgcolor="#FFFFFF">
           											 				<td colspan=4><textarea name="error_desc" rows="6" cols="88%" value=""></textarea></td>
														</tr>
														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Short Term Solution Description</b></center></td></tr>
        														<tr bgcolor="#FFFFFF">
           											 				<td colspan=4><textarea name="sht_sol_desc" rows="6" cols="88%" value=""></textarea></td>
														</tr >

                                                                    <tr bgcolor="#FFFFFF"  >
            	      																<td colspan=2><span class="labeltext"><p align="left">Engineering Approval</p></font></td>
           	      																<td ><input type="text" name="sht_eng_app" size=15 value=""></td><td>&nbsp;</td>
                                                                    </tr>	<tr bgcolor="#FFFFFF"  >
																	<td colspan=2><span class="labeltext"><p align="left">Approval Date</p></font></td>
      		            															<td colspan=2><input type="text" name="sht_app_date"
  		             																style="background-color:#DDDDDD;"
                   	              																readonly="readonly" size=15 value="">
																		<img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('sht_app_date')">
            																	</td>


														</tr>
                                                        <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Long Term Solution Description</b></center></td></tr>
        														<tr bgcolor="#FFFFFF">
           											 				<td colspan=4><textarea name="lng_sol" rows="6" cols="88%" value=""></textarea></td>
														</tr>
														<tr bgcolor="#FFFFFF"  >
            	      																<td colspan=2><span class="labeltext"><p align="left">Engineering Approval</p></font></td>
           	      																<td ><input type="text" name="lng_eng_app" size=15 value=""></td><td>&nbsp;</td>
                                                        </tr><tr bgcolor="#FFFFFF"  >
																	<td colspan=2><span class="labeltext"><p align="left">Approval Date</p></font></td>
      		            															<td colspan=2><input type="text" name="lng_app_date"
  		             																style="background-color:#DDDDDD;"
                   	              																readonly="readonly" size=15 value="">
																		<img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('lng_app_date')">
            																	</td>

														</tr>












														</table>
	</td>
    </tr>



</table>

</td>
				<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr> -->

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