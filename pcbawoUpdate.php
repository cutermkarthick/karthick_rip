<?php

//====================================
// Author: FSI
// Date-written = April 3,05
// Filename: pcbawoUpdate.php
// Allows updates to PCBA Work Orders.
// Revision: v1.0
//====================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$typenum = $_SESSION['typenum'];
$worecnum = $_SESSION['worecnum'];
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'pcbawoUpdate'; 
//////session_register('pagename');

// First include the class definition 
include('classes/userClass.php'); 
include('classes/workorderClass.php'); 
include('classes/boardClass.php'); 
include('classes/empClass.php'); 
include('classes/companyClass.php'); 
include('classes/datesClass.php'); 
include('classes/displayClass.php');
$newdisp = new display;
$newCompany = new company; 
$result = $newCompany->getAllCustomers();
$newEmp = new emp; 
$employees = $newEmp->getAllEmps();
$newboard = new board; 
$newwo = new workOrder; 
$result = $newboard->getGenInfo($worecnum);
$myrow = mysql_fetch_row($result);
$result = $newboard->getBoardDetails($typenum); 
$myBoard = mysql_fetch_row($result);
$result = $newboard->getParts($typenum); 
$myParts = mysql_fetch_row($result);
$newDates = new dates; 
$timeline = $newDates->getdates('WO', $worecnum, 'PCBA');
?>

<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/board.js"></script>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>PCBA WO Update</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>

     <form action='processPCBAorder.php' method='post' enctype='multipart/form-data'>

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
<?php    $newdisp->dispLinks(''); ?>
</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

		

			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF">

<table width=100% border=0 cellspacing="1" cellpadding="6">
    <tr>
        <td><span class="pageheading"><b>Edit PCBA Work Order</b></td>
    </tr>
    

    </tr>
    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#DDDEDD">
            <td colspan=6><span class="heading"><center><b>General Information</b></center></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext"><p align="left">Customer</p></font></td>
           
            <td colspan=4><input type="text" name="company" 
                    style=";background-color:#DDDDDD;" 
                    readonly="readonly" size=30 value="<?php echo $myrow[2] ?>">
             <img src="images/bu-getcustomer.gif" alt="Get Customer"                                                   onclick="GetAllCustomers()">
            </td>
            <input type="hidden" name="companyrecnum" value="<?php echo $myrow[14] ?>">
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Work Order #</p></font></td>
            <td colspan=2><span class="tabletext"><?php echo $myrow[0] ?></td>
        
            <td><span class="labeltext"><p align="left">Description</p></font></td>
            <td colspan=2><input type="text" name="descr" size=30 value='<?php echo $myrow[7] ?>'></td>
        </tr>
              <input type="hidden" name="wonum" value="<?php echo $myrow[0] ?>">
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part</p></font></td>
            <td colspan=2><span class="tabletext"><?php echo $myParts[0] ?></td>
            <td><span class="labeltext"><p align="left">Quantity</p></font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="qty" size=15 value="<?php echo $myBoard[15] ?>"></td>
        </tr>
               <input type="hidden" name="partrecnum" value="<?php echo $myParts[1] ?>">
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">PO #</p></font></td>
            <td colspan=2><input type="text" name="ponum" size=30 value="<?php echo $myrow[3] ?>"></td>

            <td><span class="labeltext"><p align="left">Quote #</p></font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="quotenum" size=15 value="<?php echo $myrow[4] ?>"></td>

 
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Design Owner</p></font></td>
           
            <td colspan=2><input type="text" name="owner" 
                            style=";background-color:#DDDDDD;" 
                    readonly="readonly" size=18 value="<?php echo $myrow[13] . ' ' . $myrow[12]?>">
             <img src="images/bu-getemployee.gif" alt="Get Employee"                                                   onclick="GetAllEmps()">
            </td>
            <td><span class="labeltext"><p align="left">Ref Spec</p></td>
            <td colspan=2><input type="text" name="ref_spec" size=30 value="<?php echo $myBoard[21] ?>"></td>
        </tr>


            <input type="hidden" name="emprecnum" value="<?php echo $myrow[16] ?>">
        
        <tr bgcolor="#DDDEDD">
            <td colspan=6><span class="heading"><center><b>Contact Information</b></center></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext"><p align="left">Contact</p></font></td>
           
            <td colspan=4><input type="text" name="contact" 
                           style="background-color:#DDDDDD;" 
                    readonly="readonly" size=18 value="<?php echo $myrow[8] . ' ' . $myrow[9]?>">
             <img src="images/bu-getcontact.gif" alt="Get COntact"                                                   onclick="GetContact()">
            </td>
            <input type="hidden" name="contactrecnum" value="<?php echo $myrow[15] ?>">
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><input type="text" name="phone" style="background-color:#DDDDDD;"
                              readonly="readonly" size=20 value="<?php echo $myrow[10] ?>"></td>
 
            <td colspan=2><span class="labeltext"><p align="left">Email</p></font></td>
            <td><input type="text" name="email" style="background-color:#DDDDDD;"
                         readonly="readonly" size=30 value="<?php echo $myrow[11] ?>"></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=6><span class="heading"><center><b>Board Information</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF"><td colspan=2><span class="labeltext"><b>Board Type</b></td>
            <td><input type="text" name="board_type" size=30 value="<?php echo $myBoard[0]?>"></td>
            <td colspan=2><span class="labeltext"><b>Number of Layers</b></td>
            <td><input type="text" name="layers" size=30 value="<?php echo $myBoard[7]?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF"><td colspan=2><span class="labeltext"><b>Tester</b></td>
            <td><input type="text" name="tester" size=30 value="<?php echo $myBoard[1]?>"></td>
            <td colspan=2><span class="labeltext"><b>Board Size</b></td>
            <td><input type="text" name="board_size" size=30 value='<?php echo $myBoard[8]?>'></td>
        </tr>
        <tr bgcolor="#FFFFFF"><td colspan=2><span class="labeltext"><b>Device</b></td>
            <td><input type="text" name="device" size=30 value="<?php echo $myBoard[2]?>"></td>
            <td colspan=2><span class="labeltext"><b>Board Impedance</b></td>
            <td><input type="text" name="impedance" size=30 value="<?php echo $myBoard[9]?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF"><td colspan=2><span class="labeltext"><b>Pin/Pkg</b></td>
            <td><input type="text" name="pin_pkg" size=30 value="<?php echo $myBoard[3]?>"></td>
            <td colspan=2><span class="labeltext"><b>Board Thickness</b></td>
            <td><input type="text" name="thickness" size=30 value='<?php echo $myBoard[10]?>'></td>
        </tr>
        <tr bgcolor="#FFFFFF"><td colspan=2><span class="labeltext"><b>Socket</b></td>
            <td><input type="text" name="socket" size=30 value="<?php echo $myBoard[4]?>"></td>
            <td colspan=2><span class="labeltext"><b>Material</b></td>
            <td><input type="text" name="material" size=30 value="<?php echo $myBoard[11]?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext"><b>Handler</b></td>
            <td><input type="text" name="handler" size=30 value="<?php echo $myBoard[5]?>"></td>
            <td colspan=2><span class="labeltext"><b>Sites</b></td>
            <td><input type="text" name="sites" size=30 value="<?php echo $myBoard[6]?>"></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=6><span class="heading"><center><b>Process Steps</b></center></td>
        </tr>
        <?php $arr = split(",",$myBoard[16]); ?>
        <tr bgcolor="#FFFFFF"><td colspan=2><span class="labeltext"><b>Step1</b></td>
            <td colspan=4><input type="text" name="pstep1" size=80 value="<?php echo$arr[0] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF"><td colspan=2><span class="labeltext"><b>Step2</b></td>
            <td colspan=4><input type="text" name="pstep2" size=80 value="<?php echo $arr[1] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF"><td colspan=2><span class="labeltext"><b>Step3</b></td>
            <td colspan=4><input type="text" name="pstep3" size=80 value="<?php echo $arr[2] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF"><td colspan=2><span class="labeltext"><b>Step4</b></td>
            <td colspan=4><input type="text" name="pstep4" size=80 value="<?php echo $arr[3] ?>"></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=6><span class="heading"><center><b>Special Instructions</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=6><input type="text" name="spec_instrns" size=120 value="<?php echo $myBoard[23] ?>"></textarea></td>
        </tr>


        <tr bgcolor="#DDDEDD">
            <td colspan=6><span class="heading"><center><b>Timeline & Owner</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">

            <td><span class="tabletext"><p align="left"><b>Sch Due Date</b></p></font></td>
            <td colspan=2><input type="text" name="sch_due_date" 
                    style="background-color:#DDDDDD;" 
                    readonly="readonly" size=18 value="<?php if ($myrow[17] != '0000-00-00') echo $myrow[17] ?>">
             <img src="images/bu-getdate.gif" alt="Get SchDueDate" onclick="GetSchDueDate()">
            </td>
            <td><span class="tabletext"><p align="left"><b>Actual Ship Date</b></p></font></td>
            <td colspan=2><input type="text" name="act_ship_date" 
                    style="background-color:#DDDDDD;" 
                    readonly="readonly" size=18 value="<?php if ($myrow[18] != '0000-00-00') echo $myrow[18] ?>">
             <img src="images/bu-getdate.gif" alt="Get ActShipDate"  onclick="GetActShipDate()">
            </td>

        </tr>
        <tr  bgcolor="#FFFFFF">
            <td bgcolor="#EEEFEE"><span class="heading"><b>Milestone</b></td>
	    <td bgcolor="#EEEFEE"><span class="heading"><b>Scheduled</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Revised</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Completed</b></td>
	    <td bgcolor="#EEEFEE"><span class="heading"><b>Owner</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Approved by</b></td>
        </tr>

<?php
        while ($mytl = mysql_fetch_row($timeline)) {
?>
          <tr bgcolor="#FFFFFF">
            <td width="18%"><span class="heading"><b><i><?php echo $mytl[1] ?></i></b></td>
            <td width="16%"><input type="text" name="<?php echo $mytl[1],'_sch' ?>" style="background-color:#DDDDDD;" 
                           readonly="readonly" size=12 value="<?php if ($mytl[2] != '0000-00-00') echo $mytl[2] ?>">
              <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("<?php echo $mytl[1],'_sch' ?>")'>
            </td>
            <td width="14%"><input type="text" name="<?php echo $mytl[1],'_rev' ?>" style="background-color:#DDDDDD;" 
                           readonly="readonly" size=12 value="<?php if ($mytl[3] != '0000-00-00') echo $mytl[3] ?>">
              <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("<?php echo $mytl[1],'_rev' ?>")'>
            </td>
            <td width="16%"><input type="text" name="<?php echo $mytl[1],'_com' ?>" style="background-color:#DDDDDD;" 
                           readonly="readonly" size=12 value="<?php if ($mytl[4] != '0000-00-00') echo $mytl[4] ?>">
              <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("<?php echo $mytl[1],'_com' ?>")'>
            </td>

<?php 
          if ($mytl[10] != 'Cust') {
?>
            <td width="18%"><input type="text" name="<?php echo $mytl[1],'_owner' ?>" style=";background-color:#DDDDDD;" 
                           readonly="readonly" size=15 value="<?php echo $mytl[12] ?>">
               <img src="images/bu-ownericon.gif" alt="Get Owner" onclick='GetOwner("<?php echo $mytl[1],'_owner' ?>")'>
            </td>
            <td width="18%"><input type="text" name="<?php echo $mytl[1],'_appr' ?>" style=";background-color:#DDDDDD;" 
                           readonly="readonly" size=15 value="<?php echo $mytl[16] ?>">
               <img src="images/bu-ownericon.gif" alt="Get Owner" onclick='GetApprUser("<?php echo $mytl[1],'_appr' ?>")'>
            </td>
                 <input type="hidden" name="<?php echo $mytl[1],'_ownerrecnum' ?>" value="<?php echo $mytl[6] ?>">   
                 <input type="hidden" name="<?php echo $mytl[1],'_apprrecnum' ?>" value="<?php echo $mytl[19] ?>"> 
<?php 
          } 
          else {

?>        
            <td width="18%"><input type="text" name="contacttl" style=";background-color:#DDDDDD;" 
                           readonly="readonly" size=15 value="<?php echo $myrow[9] ?>">
               
            </td>
            <td width="18%"><input type="text" name="<?php echo $mytl[1],'_apprc' ?>" style=";background-color:#DDDDDD;" 
                           readonly="readonly" size=15 value="<?php echo $mytl[18] ?>">
               <img src="images/bu-ownericon.gif" alt="Get Contact" onclick='GetC("<?php echo $mytl[1],'_apprc' ?>")'>
            </td>
                 <input type="hidden" name="<?php echo $mytl[1],'_apprcrecnum' ?>" value="<?php echo $mytl[20] ?>"> 
<?php 
          } 

?>                           

                  
          </tr>
                 <input type="hidden" name="<?php echo $mytl[1],'_datesrecnum' ?>" value="<?php echo $mytl[8] ?>">
   
                 

<?php 
          } 

?>                           

        <tr>

         <input type="hidden" name="wotype" size=15 value="PCBA">
         <input type="hidden" name="boardrecnum" size=15 value="<?php echo $typenum ?>">
         <input type="hidden" name="pagename" size=15 value="pcbawoUpdate">
         <input type="hidden" name="worecnum" value="<?php echo $worecnum ?>">
         <input type="hidden" name="deleteflag" value="">
 



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