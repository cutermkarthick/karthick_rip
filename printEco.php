<?php
session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$ecorecnum = $_REQUEST['recnum'];
$_SESSION['recnum'] =$ecorecnum; 
$_SESSION['page1'] = 'eco'; 
//////session_register('page1');
// First include the class definition 
include_once('classes/loginClass.php');
include('classes/ecoClass.php'); 
include('classes/supportClass.php'); 
$newsupp = new support; 
$neweco = new eco;
$newlogin = new userlogin;
$newlogin->dbconnect();

?>
<html>
<head>
<title>Print ECO</title>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/eco.js"></script>
</head>



<body leftmargin="0"topmargin="0" marginwidth="0">
<table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr> 
        					<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">ECO Details</A></b></center></td</tr>
        				 </tr>
			</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>
			
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
<?php
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
							
										<tr>
											<td>
												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
													
        														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
      	         													<tr bgcolor="#FFFFFF"  >
            	      																<td><span class="labeltext"><p align="left">ECO #</p></font></td>
           	      																<td ><span class="tabeltext"><?php echo "$myrow[1]";?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
																	<td><span class="labeltext"><p align="left">Doc Date</p></font></td>
      		            															<td><span class="tabeltext"><?php echo "$myrow[2]";?>
            																	</td>
																
														</tr>
														<tr bgcolor="#FFFFFF"  >
						           		            									<td><span class="labeltext"><p align="left">Sch Due Date</p></font></td>
      		            															<td><span class="tabeltext"><?php echo "$myrow[3]";?>
            																	</td>
            																	<td><span class="labeltext"><p align="left">Actual Completion Date</p></font></td>
          			  														<td><span class="tabeltext"><?php echo "$myrow[4]";?></td>
																
														</tr>
														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Work Order Information</b></center></td>

														<?php
$result3=$neweco->getwonum4eco($myrow4[0]);
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
                 		  														<td ><span class="tabeltext"><?php echo "$myrow[5]";?></td>
          			 														<td ><span class="labeltext"><p align="left">Tester Model </p></font></td>
                 		  														<td ><span class="tabeltext"><?php echo "$myrow[6]";?></td>
																
														</tr>
        														 
														

														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>PCB Issue </b></center></td></tr>
        														<tr bgcolor="#FFFFFF" >
          													 				<td ><span class="labeltext"><p align="left">Gerber </p></font></td>
                 		  														<td ><span class="tabeltext"><?php echo "$myrow[9]";?></td>
          			 														<td ><span class="labeltext"><p align="left">Layer # </p></font></td>
                 		  														<td ><span class="tabeltext"><?php echo "$myrow[10]";?></td>
																
														</tr>
														 <tr bgcolor="#FFFFFF" >
          													 				<td ><span class="labeltext"><p align="left">Schematic </p></font></td>
                 		  														<td ><span class="tabeltext"><?php echo "$myrow[11]";?></td>
          			 														<td ><span class="labeltext"><p align="left">Sheet #</p></font></td>
                 		  														<td ><span class="tabeltext"><?php echo "$myrow[12]";?></td>
																
														</tr>
														<tr bgcolor="#FFFFFF" >
          													 				<td colspan=2 ><span class="labeltext"><p align="left">Remark the boards</p></font></td>
                 		  														<td ><span class="tabeltext"><?php echo "$myrow[13]";?></td>
          			 														<td >&nbsp;</td>
                 		  														
																
														</tr>
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Socket Issue </b></center></td></tr>
														<tr bgcolor="#FFFFFF" >
          													 				<td><span class="labeltext"><p align="left">Footprint  </p></font></td>
                 		  														<td><span class="tabeltext"><?php echo "$myrow[14]";?></td>
          			 														<td ><span class="labeltext"><p align="left">Drawing #</p></font></td>
                 		  														<td ><span class="tabeltext"><?php echo "$myrow[15]";?></td>
																
														</tr>
<tr bgcolor="#FFFFFF" >
       			 														<td><span class="labeltext"><p align="left">Solution No</p></font></td>
          														  	<td colspan=3><span class="tabeltext"><?php echo "$myrow1[11]";?>
           			 									 				
           			 												</td>
																
														</tr>
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Error Description</b></center></td></tr>
        														<tr bgcolor="#FFFFFF">
           											 				<td colspan=4><span class="tabeltext"><?php echo "$myrow[16]";?></td>
														</tr>
														<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Short Term Solution Description</b></center></td></tr>
        														<tr bgcolor="#FFFFFF">
           											 				<td colspan=4><?php echo "$myrow[17]";?></td>
														</tr >

<tr bgcolor="#FFFFFF"  >
            	      																<td colspan=2><span class="labeltext"><p align="left">Engineering Approval</p></font></td>
           	      																<td ><span class="tabeltext"><?php echo "$myrow[18]";?></td><td>&nbsp;</td>
</tr>	<tr bgcolor="#FFFFFF"  >
																	<td colspan=2><span class="labeltext"><p align="left">Approval Date</p></font></td>
      		            															<td colspan=2><span class="tabeltext"><?php echo "$myrow[19]";?>
																		            																	</td>
																
            															
														</tr>
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Long Term Solution Description</b></center></td></tr>
        														<tr bgcolor="#FFFFFF">
           											 				<td colspan=4><span class="tabeltext"><?php echo "$myrow[20]";?></td>
														</tr>
														<tr bgcolor="#FFFFFF"  >
            	      																<td colspan=2><span class="labeltext"><p align="left">Engineering Approval</p></font></td>
           	      																<td >   <<span class="tabeltext"><?php echo "$myrow[21]";?></td><td>&nbsp;</td>
</tr><tr bgcolor="#FFFFFF"  >							
																	<td colspan=2><span class="labeltext"><p align="left">Approval Date</p></font></td>
      		            															<td colspan=2><span class="tabeltext"><?php echo "$myrow[22]";?>	
            																	</td>
																            															
														</tr>
														

														

														

														

														

														
														
														
														</table>
	</td>
    </tr>



</table>

</td>
      
</table>



</body>
</html>
