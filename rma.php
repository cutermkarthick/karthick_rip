<?php
session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$rmarecnum = $_REQUEST['recnum'];
$_SESSION['recnum'] = $rmarecnum; 
$_SESSION['pagename'] = 'rma'; 
//////session_register('pagename');
// First include the class definition 
include_once('classes/loginClass.php');
include('classes/rmaclass.php'); 
include('classes/rmaitemsClass.php'); 
 include('classes/supportClass.php'); 
 include('classes/displayClass.php'); 
$newitems_ret = new rmaitems; 
$newrma = new rma;
$newdisp = new display;
$newlogin = new userlogin;
$newsupp = new support; 
$newlogin->dbconnect();

?>
<html>
<head>
<title>RMA Details</title>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/rma.js"></script>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
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
					<?php $newdisp->dispLinks($rmarecnum); ?>
						<table width=100% border=0 cellpadding=0 cellspacing=0  >
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/spacer.gif " width="6"></td>
								<td bgcolor="#FFFFFF">
									<table width=100% border=0 cellpadding=6 cellspacing=0  >
										<tr><td>
											 <table width=100% border=0>
												<tr>
													  <td><span class="pageheading"><b>RMA Details</b></td>
													  <td align=right><input type= "image" name="Delete" src="images/bu-print.gif" value="Print" onclick="javascript: printRMA(<?php echo $rmarecnum ?>)"></td>
													
    												</tr>
										     	 </table>
										</td></tr>

										<tr>
											<td>
												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
													
        														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
      	         													<tr bgcolor="#FFFFFF"  >
            	      																<td  ><span class="labeltext"><p align="left">RMA#</td>
           	      																<td ><span class="tabeltext"><?php echo "$myrow[1]";?></td>
																	<td ><span class="labeltext"><p align="left">Received Date</td>
      		            															<td > <span class="tabeltext"><?php echo "$myrow[2]";?>																		
            																	</td>
																
            															
														</tr>
<tr bgcolor="#FFFFFF"  >
						           		            									<td ><span class="labeltext"><p align="left">Sch Due Date</p></font></td>
      		            															<td ><span class="tabeltext"><?php echo "$myrow[3]";?>
            																	</td>
            																	<td  ><span class="labeltext"><p align="left">Actual Completion Date</p></font></td>
          			  														<td ><span class="tabeltext"><?php echo "$myrow[4]";?>
            																	</td>
																
														</tr>
													<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Work Order Information</b></center></td>

														<?php
$result3=$newrma->getwonum4rma($myrow4[0]);
$myrow3=mysql_fetch_row($result3); 
?>
<tr bgcolor="#FFFFFF"  >
																<td><span class="labeltext"><p align="left">Work Order No&nbsp;</p></font></td>
          			  														<td><span class="tabeltext"><?php echo "$myrow3[0]";?>																		
        			   									 					<td><span class="labeltext"><p align="left">Company</p></font></td>
          			 							 							<td><span class="tabeltext"><?php echo "$myrow3[1]";?>
												          			 		</td>
		  														
														</tr>
														<tr bgcolor="#FFFFFF"  >
       			  														<td ><span class="labeltext"><p align="left">Contact&nbsp;</p></td>
           		               									 						<td><span class="tabeltext"><?php echo "$myrow3[2]" . "$myrow3[3]";?></td>
               																		
		                 														<td><span class="labeltext"><p align="left">Email</p></font></td>
          			 							 							<td><span class="tabeltext"><?php echo "$myrow3[4]";?></td>
																
										      				
														</tr>
														<tr bgcolor="#FFFFFF"  >

        			   									 					<td><span class="labeltext"><p align="left">Designer</p></font></td>
          			 							 							<td><span class="tabeltext"><?php echo "$myrow3[5]" . "$myrow3[6]";?></td><td colspan=2>&nbsp;</td>
																	


														</tr>
       <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Customer Information</b></center></td></tr>
        
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Customer</p></font></td>
           <td><span class="tabletext"><p align="left"><?php echo  "$myrow1[0]";?></p></font></td>
           <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow1[1]";?></p></font></td>
        </tr>
          <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">Contact</p></font></td>
             <td><span class="tabletext"><p align="left"><?php echo  $myrow1[2] . "  " . $myrow1[3];?></p></font></td>
             <td><span class="labeltext"><p align="left">Email</p></font></td>
             <td><span class="tabletext"><p align="left"><?php echo  "$myrow1[5]";?></p></font></td>
        </tr>
       <tr bgcolor="#EEEFEE"><span class="heading"><td colspan=4><center><b>Owner Information</b></center></td></tr>

    <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left">Owner</p></font></td>
          <td><span class="tabletext"><p align="left"><?php echo  $myrow1[6] . $myrow1[7];?></p></font></td>
<td colspan=3>&nbsp;</td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Phone</p></font></td>
             <td><span class="tabletext"><p align="left"><?php echo  "$myrow1[8]";?></p></font></td>
             <td><span class="labeltext"><p align="left">Email</p></font></td>
              <td><span class="tabletext"><p align="left"><?php echo  "$myrow1[9]";?></p></font></td>
      </tr>
      
														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Items Returned</b></center></td></tr>
														
															
																<tr>
									            								<td bgcolor="#EEEFEE" colspan=2><span class="heading"><b><center> Part #</b></td>
									            								<td bgcolor="#EEEFEE" colspan=2><span class="heading"><b><center>Quantity</b></td>
											  					</tr>

																	<?php

        $i = 0;
        $result6 = $newitems_ret ->getrmaitems($rmarecnum);
        while ($myreturn = mysql_fetch_row($result6)) {
              $i = $i + 1;
	      printf('<tr><td bgcolor="#FFFFFF" colspan=2><center><span class="tabletext">%s</td>
                          <td bgcolor="#FFFFFF" colspan=2><center><span class="tabletext">%s</td></tr>
                       ',
	          $myreturn[2],
                          $myreturn[3]);
        }
?>
			
</tr>
														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Reason for Return</b></center></td></tr>
        														 <tr bgcolor="#FFFFFF"  >

														</tr>
<tr bgcolor="#FFFFFF" >
          													 				<td ><span class="labeltext"><p align="left">Our mistake </p></td>
																	<?php if($myrow[6]=='y') {
                 		  														           echo "<td><input type=\"checkbox\" name=\"omistake\" value=\"\" checked></td>";}
																	else {
																	           echo"<td ><input type=\"checkbox\" name=\"omistake\" value=\"\" ></td>"; }?>
          			 														<td ><span class="labeltext"><p align="left">Customer Mistake </p></td>
																	<?php if($myrow[7]=='y') {
                 		  														           echo "<td><input type=\"checkbox\" name=\"cmistake\" value=\"\" checked></td>";}
																	else {
																	           echo"<td ><input type=\"checkbox\" name=\"cmistake\" value=\"\" ></td>"; }?>
                 		  														
																
														</tr>
<tr bgcolor="#FFFFFF" >
       			 														<td><span class="labeltext"><p align="left">Solution No</p></font></td>
          			 									 					<td><span class="labeltext"><?php echo "$myrow5[1]";?></td><td colspan=2>&nbsp;</td>
																		
           			 									 						<input type="hidden" name="solrecnum" value="0">
																
														</tr>
														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Solution Description</b></center></td></tr>
        														<tr bgcolor="#FFFFFF">
           											 				<td colspan=4><span class="labeltext" ><?php echo "$myrow[8]";?></td>
														</tr>
<tr bgcolor="#FFFFFF" >
       			 														<td ><span class="labeltext"><p align="left">Cost To us </p></font></td>
																	<td ><span class="tabeltext"><?php echo "$myrow[9]";?></td>
                		 									 					<td ><span class="labeltext"><p align="left">Cost To Customer </p></font></td>
																	<td ><span class="tabeltext"><?php echo "$myrow[10]";?></td>
               		  														
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
                 		  														
          																	<td><span class="labeltext"><p align="left">Mfg </p></td>
																	<?php if($myrow[14]=='y') {
                 		  														           echo "<td ><input type=\"checkbox\" name=\"mfg\" value=\"\" checked></td>";}
																	else {
																	           echo"<td ><input type=\"checkbox\" name=\"mfg\" value=\"\" ></td>"; }?>
                 		 									 					
        																
														</tr>
<tr bgcolor="#FFFFFF" >
          			 														<td ><span class="labeltext"><p align="left"> Assembly</p></td>
																	<?php if($myrow[15]=='y') {
                 		  														           echo "<td ><input type=\"checkbox\" name=\"assemply\" value=\"\" checked></td>";}
																	else {
																	           echo"<td ><input type=\"checkbox\" name=\"assemply\" value=\"\" ></td>"; }?>
                 		  														
          			 													<td colspan=2>&nbsp;</td>
														</tr> 
														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Corrective Action</b></center></td></tr>
        														<tr bgcolor="#FFFFFF"  >
           			 												<td colspan=4><span class="tabeltext"><?php echo "$myrow[16]";?></td>
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
														