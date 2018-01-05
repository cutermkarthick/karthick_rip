<?php
session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'newsr';
$page = "Support: New SR";
//session_register('pagename');
//$pagename=$_SESSION['page'];
//echo "$pagename";
// First include the class definition 
include('classes/srClass.php');
include('classes/displayClass.php'); 
$newdisp = new display;
$newsr = new sr;
?>

<html>
<head>
<title>New SR</title>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/sr.js"></script>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
     <form action='processsr.php' method='post' enctype='multipart/form-data'>
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
  								<td width="6"><img src="images/spacer.gif " width="6"></td>-->
								<td bgcolor="#FFFFFF">
 					<table width=100% border=0 cellpadding=6 cellspacing=0  >
										<tr><td>
											 <table width=100% border=0>
												<tr>
													  <td><span class="pageheading"><b>New Service Request</b></td>
    												</tr>
										     	 </table>
										</td></tr>

										<tr>
											<td>
  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
												        <tr bgcolor="#FFFFFF"  >

<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr>
      	         <tr bgcolor="#FFFFFF"  >
         	    	  
            	      <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>SR Num</p></font></td>
           	      <td colspan=><input type="text" name="srnum" size=20 value=""></td>
   	      <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>SR Title</p></font></td>
        	      <td colspan=1><input type="text" name="title" size=20 value=""></td>
	      </tr>
       	         <tr bgcolor="#FFFFFF"  >
       		            
    		            <td><span class="labeltext"><p align="left">Drawing Rev</p></font></td>
      		           <td colspan=1><input type="text" name="drawing" size=20 value=""></td>
			 <td><span class="labeltext"><p align="left">Reported By</p></font></td>
           		           <td><span class="tabletext"><select name="repoted" size="1" width="50">
        		           	<option selected>CUSTOMER
       		          	<option value>COMPANY
          		         	</select>
       		          	<input type="hidden" name="reportedval">
		</tr>
	         
														
        	          <tr bgcolor="#FFFFFF"  >
           		            <td><span class="labeltext"><p align="left">Due Date</p></font></td>
      		            <td><input type="text" name="due_date"
  		             style="background-color:#DDDDDD;" 
                   	              readonly="readonly" size=20 value="">
			<img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('due_date')">


            			</td>
            			<td><span class="labeltext"><p align="left">Received Date</p></font></td>
          			  <td><input type="text" name="rec_date"
                   		 	style="background-color:#DDDDDD;"
                 		  	 readonly="readonly" size=20 value="">
				<img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('rec_date')">
            			</td>
	        </tr>  <tr bgcolor="#FFFFFF"  >
         		  <td><span class="labeltext"><p align="left">Priority</p></font></td>
               		  <td><span class="tabletext"><select name="priority" size="1" width="50">
   	     	       <option selected>HIGH
         		      <option value>LOW
         		      <option value>MEDIUM
       		      </select>
       		     <input type="hidden" name="priorityval">
	                 </td>

	                <td><span class="labeltext"><p align="left">Status</p></font></td>
         		 <td><span class="tabletext"><select name="srstatus" size="1" width="75">
            			 <option selected>OPEN
             			<option value>CANCEL
             			<option value>CLOSE
             			<option value>IN PROGRESS
             			<option value>ON HOLD
            			 </select>
         			<input type="hidden" name="srstatusval">
		  </tr>
		    <tr bgcolor="#FFFFFF"  >
       			  <td><span class="labeltext"><p align="left">Doc Date</p></font></td>
          			  <td><input type="text" name="doc_date"
               			     style="background-color:#DDDDDD;" 
              			      readonly="readonly" size=20 value="">
				<img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('doc_date')">
           			 </td>
       			  <td><span class="labeltext"><p align="left">Solution No</p></font></td>
          			  <td><input type="text" name="solnum" 
               			     style="background-color:#DDDDDD;" 
              			      readonly="readonly" size=20 value="">
			<img src="images/bu-getsolnid.gif" alt="Get Sol No" onclick="GetSolNo()">
           			  <input type="hidden" name="solrecnum" value="0">

           			 </td>

		  </tr>
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Work Order Information</b></center></td>
														<tr bgcolor="#FFFFFF"  >

       			  														<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Work Order No&nbsp;</p></font></td>
          			  														<td><input type="text" name="wonum" 
               			    							 								style="background-color:#DDDDDD;" 
              			    										 			 		readonly="readonly" size=20 value="">
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
       			  														<td ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Contact&nbsp;</p></td>
           		               									 						<td><input type="text" name="con" 
                           																	style="background-color:#DDDDDD;" 
                    																	readonly="readonly" size=20 value="">																	
																		</td>
               																		<input type="hidden" name="contactrecnum1">
		                 														<td><span class="labeltext"><p align="left">Email</p></font></td>
          			 							 							<td><input type="text" name="em" style="background-color:#DDDDDD;"
                        		 															readonly="readonly" size=20 value=""></td>
																
										      				
														</tr>
       <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b><span class='asterisk'>*</span>Customer Information</b></center></td>
</tr>
        
       		<tr bgcolor="#FFFFFF"  >
        			    <td><span class="labeltext"><p align="left">Customer</p></font></td>
                      			 <td><input type="text" name="company" 
            				    style=";background-color:#DDDDDD;" 
                 			   readonly="readonly" size=20 value="">

				<img src="images/bu-getcustomer.gif" alt="Get Customer" onclick="GetAllCustomers()">
            				<input type="hidden" name="companyrecnum">

            			    </td>
            	 		   <td><span class="labeltext"><p align="left">Phone</p></font></td>
            			  <td><input type="text" name="phone" style="background-color:#DDDDDD;"
                              		   readonly="readonly" size=20 value=""></td>
  		  </tr>
     	                  <tr bgcolor="#FFFFFF"  >
            			 <td><span class="labeltext"><p align="left">Contact</p></font></td>
           		                <td><input type="text" name="contact" 
                           		style="background-color:#DDDDDD;" 
                    		readonly="readonly" size=20 value="">

				<img src="images/bu-getcontact.gif" alt="Get Contact" onclick="GetContact()">

               			<input type="hidden" name="contactrecnum">
		                 </td>
            			<td><span class="labeltext"><p align="left">Email</p></font></td>
          			  <td><input type="text" name="email" style="background-color:#DDDDDD;"
                        		 readonly="readonly" size=20 value=""></td>
        		</tr>
     <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Owner Information</b></center></td>
</tr>
         	
       		 <tr bgcolor="#FFFFFF"  >
          			 <td><span class="labeltext"><p align="left">Owner</p></font></td>
                 		  <td colspan=1><input type="text" name="contact1" 
                          			 style="background-color:#DDDDDD;" 
                   			 readonly="readonly" size=20 value="">
				<img src="images/bu-getowner.gif" alt=="Assign Employees" onclick="GetAllEmps()">
				<input type="hidden" name="empnum">
            			</td>
   		                 <td colspan=3>&nbsp;</td>
		</tr>
        		 <tr bgcolor="#FFFFFF"  >
            			<td><span class="labeltext"><p align="left">Phone</p></font></td>
            			<td><input type="text" name="phone1" style="background-color:#DDDDDD;"
                            		  readonly="readonly" size=20 value=""></td>
 		                <td><span class="labeltext"><p align="left">Email</p></font></td>
            			<td><input type="text" name="email1" style="background-color:#DDDDDD;"
                   		  readonly="readonly" size=20 value=""></td>
      		</tr>
       <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Error Description</b></center></td>
</tr>

        		</tr>
        		 <tr bgcolor="#FFFFFF"  >
           			 <td colspan=4><textarea name="error_desc" rows="6" cols="88%" value=""></textarea></td>
        		</tr>
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
						<table border = 0 cellpadding=0 cellspacing=0 width=100%>
							<tr>
								<td align=left>   
  											</td>
							</tr>
						</table>
        <span class="labeltext"><input type="submit" 
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">

					</FORM>
		</body>
</html>
