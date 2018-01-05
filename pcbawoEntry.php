<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Apr 3, 2005                  =
// Filename: pcbawoEntry.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Allows PCBA WO entry.                       =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'pcbawoEntry'; 
//////session_register('pagename');
// First include the class definition 
include('classes/userClass.php'); 
include('classes/workorderClass.php'); 
include('classes/boardClass.php'); 
include('classes/empClass.php'); 
include('classes/companyClass.php'); 
include('classes/workflowClass.php'); 
include('classes/displayClass.php');
$newBoard = new board; 
$newCustomer = new company; 
$newdisp = new display;
$result = $newCustomer->getAllCustomers();
$newEmp = new emp; 
$employees = $newEmp->getAllEmps();
$newWF = new workflow; 
$wf = $newWF->getWF('PCBA','WO');
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/board.js"></script>

<html>
<head>
<title>PCBA Wo Entry</title>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" rightmargin="0">
<table width=100% cellspacing="0" cellpadding="0" border="0">

<tr><td>
<?php
include('header.html');
?>
</td></tr>
<tr><td>
<table width=100% cellspacing="0" cellpadding="6" border="0">

<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
    <tr>
 
        <td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        <td align="right">&nbsp;
        <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        
    </tr>
</table>


<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr><td>
	
	</td></tr>
	<tr>
	<td>
<?php $newdisp->dispLinks(''); ?></td>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

		

			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF">

<table width=100% border=0 cellspacing="1" cellpadding="6">


    <tr>
        <td><span class="pageheading"><b>New PCBA Work Order</b></td>
    </tr>


    <tr>
        <td>
<form action='processPCBAorder.php' method='post' enctype='multipart/form-data'>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">*Customer</p></font></td>
           
            <td  colspan=3><input type="text" name="company" 
                    style=";background-color:#DDDDDD;" 
                    readonly="readonly" size=25 value="">

             <img src="images/bu-getcustomer.gif" alt="Get Customer"                                                   onclick="GetAllCustomers()">
            </td>
            
	<input type="hidden" name="companyrecnum"></td>
        
</tr>

        <tr bgcolor="#FFFFFF">
       
            <td><span class="labeltext"><p align="left">Description</p></font></td>
            <td colspan=3><input type="text" name="descr" size=90 value=""></td>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">*WO #</p></font></td>
            <td><span class="tabletext"><input type="text" name="wonum" size=13 value=""></td>
            <td><span class="labeltext"><p align="left">*Part</p></font></td>
           
            <td><input type="text" name="part" 
                    style=";background-color:#DDDDDD;" 
                    readonly="readonly" size=18 value="">
             <img src="images/bu-setpartnum.gif" alt="Set Partnum"                                                   onclick="VerifyPart(document.forms[0].part.value)">
            </td>
            
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">*PO #</p></font></td>
            <td><input type="text" name="ponum" size=25 value=""></td>

            <td><span class="labeltext"><p align="left">*Quote #</p></font></td>
            <td><span class="tabletext"><input type="text" name="quotenum" size=12 value=""></td>

 
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Quantity</p></font></td>
            <td><span class="tabletext"><input type="text" name="qty" size=15 value=""></td>

            <td><span class="labeltext"><p align="left">Ref Spec</p></td>
            <td><input type="text" name="ref_spec" size=30 value=""></td>
        </tr>
        <tr  bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">Reorder</td>
             <td><input type="radio" name="reordercb" value=""</td>
            <td><span class="labeltext"><p align="left">*Designer</p></font></td>
           
            <td><input type="text" name="owner" 
                            style=";background-color:#DDDDDD;" 
                    readonly="readonly" size=18 value="">
             <img src="images/bu-getemployee.gif" alt="Get Employee"                                                 
                        onclick="GetAllEmps()">
            </td>
        </tr>
        <input type="hidden" name="reorder">        
	<input type="hidden" name="emprecnum">

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>*Contact Information</b></center></td>
        </tr>
        
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Contact</p></font></td>
           
            <td colspan=3><input type="text" name="contact" 
                           style="background-color:#DDDDDD;" 
                    readonly="readonly" size=25 value="">
             <img src="images/bu-getcontact.gif" alt="Get COntact"                                                   onclick="GetContact()">
	<input type="hidden" name="contactrecnum">            

</td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><input type="text" name="phone" style="background-color:#DDDDDD;"
                              readonly="readonly" size=20 value=""></td>
 
            <td><span class="labeltext"><p align="left">Email</p></font></td>
            <td><input type="text" name="email" style="background-color:#DDDDDD;"
                         readonly="readonly" size=30 value=""></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Board Information</b></center></td>
        </tr>

        <tr bgcolor="#FFFFFF"><td><span class="labeltext"><b>Board Type</b></td>
            <td><input type="text" name="board_type" size=30 value=""></td>
            <td><span class="labeltext"><b>Number of Layers</b></td>
            <td><input type="text" name="layers" size=30 value=""></td>
        </tr>

        <tr bgcolor="#FFFFFF"><td><span class="labeltext"><b>Tester</b></td>
            <td><input type="text" name="tester" size=30 value=""></td>
            <td><span class="labeltext"><b>Board Size</b></td>
            <td><input type="text" name="board_size" size=30 value=""></td>
        </tr>

        <tr bgcolor="#FFFFFF"><td><span class="labeltext"><b>Device</b></td>
            <td><input type="text" name="device" size=30 value=""></td>
            <td><span class="labeltext"><b>Board Impedance</b></td>
            <td><input type="text" name="impedance" size=30 value=""></td>
        </tr>

        <tr bgcolor="#FFFFFF"><td><span class="labeltext"><b>Pin/Pkg</b></td>
            <td><input type="text" name="pin_pkg" size=30 value=""></td>
            <td><span class="labeltext"><b>Board Thickness</b></td>
            <td><input type="text" name="thickness" size=30 value=""></td>
        </tr>

        <tr bgcolor="#FFFFFF"><td><span class="labeltext"><b>Socket</b></td>
            <td><input type="text" name="socket" size=30 value=""></td>
            <td><span class="labeltext"><b>Material</b></td>
            <td><input type="text" name="material" size=30 value=""></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><b>Handler</b></td>
            <td><input type="text" name="handler" size=30 value=""></td>
            <td><span class="labeltext"><b>Sites</b></td>
            <td><input type="text" name="sites" size=30 value=""></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Process Steps</b></center></td>
        </tr>

        <tr bgcolor="#FFFFFF"><td><span class="labeltext"><b>Step1</b></td>
            <td colspan=3><input type="text" name="pstep1" size=80 value=""></td>
        </tr>

        <tr bgcolor="#FFFFFF"><td><span class="labeltext"><b>Step2</b></td>
            <td colspan=3><input type="text" name="pstep2" size=80 value=""></td>
        </tr>

        <tr bgcolor="#FFFFFF"><td><span class="labeltext"><b>Step3</b></td>
            <td colspan=3><input type="text" name="pstep3" size=80 value=""></td>
        </tr>

        <tr bgcolor="#FFFFFF"><td><span class="labeltext"><b>Step4</b></td>
            <td colspan=3><input type="text" name="pstep4" size=80 value=""></td>
        </tr>


        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Special Instructions</b></center></td>
        </tr>


        <tr bgcolor="#FFFFFF">
            <td colspan=4><textarea name="spec_instrns" rows="6" cols="89" value=""></textarea></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Timeline & Owner</b></center></td>
        </tr>

        <tr bgcolor="#FFFFFF">

            <td><span class="tabletext"><p align="left"><b>Sch Due Date</b></p></font></td>
            <td><input type="text" name="sch_due_date" 
                    style="background-color:#DDDDDD;" 
                    readonly="readonly" size=18 value="">
             <img src="images/bu-getdate.gif" alt="Get SchDueDate" onclick="GetSchDueDate()">
            </td>
            <td><span class="tabletext"><p align="left"><b>Actual Ship Date</b></p></font></td>
            <td><input type="text" name="act_ship_date" 
                    style="background-color:#DDDDDD;" 
                    readonly="readonly" size=18 value="">
             <img src="images/bu-getdate.gif" alt="Get ActShipDate"  onclick="GetActShipDate()">
            </td>

        </tr>

        <tr bgcolor="#FFFFFF">

	<tr  bgcolor="#FFFFFF">
            <td colspan=2 bgcolor="#EEEFEE"><span class="heading"><b>Milestone</b></td>
	    <td bgcolor="#EEEFEE"><span class="heading"><b>Scheduled Date</b></td>
	    <td bgcolor="#EEEFEE"><span class="heading"><b><center>Owner</center></b></td>
        </tr>
	
<?php
        while ($myrow = mysql_fetch_row($wf)) {
?>
          <tr  bgcolor="#FFFFFF">
            <td colspan=2><span class="heading"><?php echo $myrow[3] ?></td>
            <td><input type="text" name="<?php echo $myrow[3] ?>" style="background-color:#DDDDDD;" 
                           readonly="readonly" size=20 value="">
              <img src="images/bu-getdate.gif" alt="Get Date" onclick='GetDate("<?php echo $myrow[3] ?>")'>
            </td>
<?php 
          if ($myrow[2] != 'Cust') {
?>
            <td><input type="text" name="<?php echo $myrow[3],'_owner' ?>" style=";background-color:#DDDDDD;" 
                           readonly="readonly" size=20 value="">
               <img src="images/bu-getemployee.gif" alt="Get Owner" onclick='GetOwner("<?php echo $myrow[3],'_owner' ?>")'>
            </td>
                 <input type="hidden" name="<?php echo $myrow[3],'_ownerrecnum' ?>" value="">   
<?php 
          } 
          else {

?>        
            <td colspan=3><input type="text" name="contacttl" 
                           style="background-color:#DDDDDD;" 
                    readonly="readonly" size=20 value="">
             <img src="images/bu-getcontact.gif" alt="Get COntact"                                                  
                    onclick='GetC("contacttl)'>
            </td>
<?php 
          } 

?>                           
          </tr>

<?php 
        }
?>
        </tr>

       
    </td>

           
        </tr>


         <input type="hidden" name="wotype" size=15 value="PCBA">
 
         <input type="hidden" name="pagename" size=15 value="pcbawoEntry">

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