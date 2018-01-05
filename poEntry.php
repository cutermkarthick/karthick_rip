<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: boardwoEntry.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Allows Board WO entry.                      =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];

// First include the class definition 
include('classes/userClass.php'); 
include('classes/workorderClass.php'); 
include('classes/boardClass.php'); 
include('classes/empClass.php'); 
include('classes/companyClass.php'); 
$newCustomer = new company; 
$result = $newCustomer->getAllCustomers();
$newEmp = new emp; 
$employees = $newEmp->getAllEmps();
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/board.js"></script>

<html>
<head>
<title>Board Wo Entry</title>
</head>


<?php
include('header.html');
?>

<table cellspacing="2" cellpadding="20" border="0">

<tr><td>
<table width=780 border=0>
    <tr>
        <td colspan=2><span class="heading"><b>Welcome <?php echo $userid?></b></td>
        <td colspan=9 align="right" width="7%"><a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image10','','images/logout_mo.gif',1)"><img name="Image10" border="0" src="images/logout.gif"></a></td>
    </tr>

<tr>
    <td width="7%"><a href="worderSummary.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image9','','images/order_mo.gif',1)"><img name="Image9" border="0" src="images/order.gif"></a></td><td></td>
</td>
</table>
    <table>


    <tr>
        <td><span class="pageheading"><b>New Board Work Order</b></td>
    </tr>
    

     <form action='processBoardorder.php' method='post' enctype='multipart/form-data'>

  
      <table border=2 BORDERCOLOR="#FFCC00" width=780>

        <tr bgcolor="#FFCC00">
            <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
        </tr>
        
        <tr>
            <td><span class="labeltext"><p align="left">Customer</p></font></td>
           
            <td  colspan=3><input type="text" name="company" 
                    style=";background-color:#DDDDDD;" 
                    readonly="readonly" size=30 value="">
             <input type=button name="btntype" 
                      style="color=#0066CC;background-color:#DDDDDD;width=130;"
                      value="Get Customer" onclick="GetAllCustomers()">
            </td>
            <td><input type="hidden" name="companyrecnum"></td>
        </tr>
        <tr>
       
            <td><span class="labeltext"><p align="left">Description</p></font></td>
            <td colspan=3><input type="text" name="descr" size=90 value=""></td>
        <tr>
            <td><span class="labeltext"><p align="left">Work Order #</p></font></td>
            <td><span class="tabletext"><input type="text" name="wonum" size=15 value=""></td>
            <td><span class="labeltext"><p align="left">Part</p></font></td>
           
            <td><input type="text" name="part" 
                    style=";background-color:#DDDDDD;" 
                    readonly="readonly" size=20 value="">
             <input type=button name="btntype" 
                      style="color=#0066CC;background-color:#DDDDDD;width=95;"
                      value="Set Partnum" onclick="VerifyPart(document.forms[0].part.value)">
            </td>
            
        </tr>
        <tr>
            <td><span class="labeltext"><p align="left">PO #</p></font></td>
            <td><input type="text" name="ponum" size=30 value=""></td>

            <td><span class="labeltext"><p align="left">Quote #</p></font></td>
            <td><span class="tabletext"><input type="text" name="quotenum" size=15 value=""></td>

 
        </tr>
        <tr>
            <td><span class="labeltext"><p align="left">Quantity</p></font></td>
            <td><span class="tabletext"><input type="text" name="qty" size=15 value=""></td>

            <td><span class="labeltext"><p align="left">Ref Spec</p></td>
            <td><input type="text" name="ref_spec" size=30 value=""></td>
        </tr>
        

        <tr bgcolor="#FFCC00">
            <td colspan=4><span class="heading"><center><b>Timeline & Owner</b></center></td>
        </tr>
        <tr>
            <td><span class="labeltext"><p align="left">Design Due</p></font></td>
            <td><input type="text" name="des_due" 
                    style="background-color:#DDDDDD;" 
                    readonly="readonly" size=20 value="">
             <input type=button name="btntype" 
                      style="color=#0066CC;background-color:#DDDDDD;width=95;"
                      value="Get Date" onclick="GetDesDate()">
            </td>

            <td><span class="labeltext"><p align="left">Designer</p></font></td>
           
            <td><input type="text" name="owner" 
                            style=";background-color:#DDDDDD;" 
                    readonly="readonly" size=20 value="">
             <input type=button name="btntype" 
                       style="color=#0066CC;background-color:#DDDDDD;width=95;"
                       value="Get Employee" onclick="GetAllEmps()">
            </td>


        </tr>
        <tr>
            <td><span class="tabletext"><p align="left"><b>Assembly Required</b></p></font></td>
            <td><span class="tabletext"><select name="assyrequired" size="1">
             <option selected>Yes
             <option value>No
              </select>
            </td>

            <td><span class="labeltext"><p align="left">Assembly Due</p></font></td>
            <td><input type="text" name="assy_due" 
                    style="background-color:#DDDDDD;" 
                    readonly="readonly" size=20 value="">
             <input type=button name="btntype" 
                      style="color=#0066CC;background-color:#DDDDDD;width=95;"
                      value="Get Date" onclick="GetAssyDate()">
            </td>

        </tr>

        <tr>
            <td><span class="labeltext"><p align="left">Fab Due</p></font></td>
            <td><input type="text" name="fab_due" 
                    style="background-color:#DDDDDD;" 
                    readonly="readonly" size=20 value="">
             <input type=button name="btntype" 
                      style="color=#0066CC;background-color:#DDDDDD;width=95;"
                      value="Get Date" onclick="GetFabDate()">
            </td>
            <td><span class="tabletext"><p align="left"><b>Sch Due Date</b></p></font></td>
            <td><input type="text" name="sch_due_date" 
                    style="background-color:#DDDDDD;" 
                    readonly="readonly" size=20 value="">
             <input type=button name="btntype" 
                      style="color=#0066CC;background-color:#DDDDDD;width=95;"
                      value="Get Date" onclick="GetSchDueDate()">
            </td>

            <td><input type="hidden" name="emprecnum"></td>
        </tr>


        <tr bgcolor="#FFCC00">
            <td colspan=4><span class="heading"><center><b>Contact Information</b></center></td>
        </tr>
        <tr>
            <td><span class="labeltext"><p align="left">Contact</p></font></td>
           
            <td colspan=3><input type="text" name="contact" 
                           style="background-color:#DDDDDD;" 
                    readonly="readonly" size=30 value="">
             <input type=button name="btntype" 
                       style="color=#0066CC;background-color:#DDDDDD;width=130;"
                  value="Get Contact" onclick="GetContact()";
            </td>
            <td><input type="hidden" name="contactrecnum"></td>
        </tr>
        <tr>
            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><input type="text" name="phone" style="background-color:#DDDDDD;"
                              readonly="readonly" size=20 value=""></td>
 
            <td><span class="labeltext"><p align="left">Email</p></font></td>
            <td><input type="text" name="email" style="background-color:#DDDDDD;"
                         readonly="readonly" size=30 value=""></td>
        </tr>

        <tr bgcolor="#FFCC00">
            <td colspan=4><span class="heading"><center><b>Board Information</b></center></td>
        </tr>
        <tr><td><span class="labeltext"><b>Board Type</b></td>
            <td><input type="text" name="board_type" size=30 value=""></td>
            <td><span class="labeltext"><b>Number of Layers</b></td>
            <td><input type="text" name="layers" size=30 value=""></td>
        </tr>
        <tr><td><span class="labeltext"><b>Tester</b></td>
            <td><input type="text" name="tester" size=30 value=""></td>
            <td><span class="labeltext"><b>Board Size</b></td>
            <td><input type="text" name="board_size" size=30 value=""></td>
        </tr>
        <tr><td><span class="labeltext"><b>Device</b></td>
            <td><input type="text" name="device" size=30 value=""></td>
            <td><span class="labeltext"><b>Board Impedance</b></td>
            <td><input type="text" name="impedance" size=30 value=""></td>
        </tr>
        <tr><td><span class="labeltext"><b>Pin/Pkg</b></td>
            <td><input type="text" name="pin_pkg" size=30 value=""></td>
            <td><span class="labeltext"><b>Board Thickness</b></td>
            <td><input type="text" name="thickness" size=30 value=""></td>
        </tr>
        <tr><td><span class="labeltext"><b>Socket</b></td>
            <td><input type="text" name="socket" size=30 value=""></td>
            <td><span class="labeltext"><b>Material</b></td>
            <td><input type="text" name="material" size=30 value=""></td>
        </tr>
        <tr>
            <td><span class="labeltext"><b>Handler</b></td>
            <td><input type="text" name="handler" size=30 value=""></td>
            <td><span class="labeltext"><b>Sites</b></td>
            <td><input type="text" name="sites" size=30 value=""></td>
        </tr>
        <tr bgcolor="#FFCC00">
            <td colspan=4><span class="heading"><center><b>Process Steps</b></center></td>
        </tr>
        <tr><td><span class="labeltext"><b>Step1</b></td>
            <td colspan=3><input type="text" name="pstep1" size=80 value=""></td>
        </tr>
        <tr><td><span class="labeltext"><b>Step2</b></td>
            <td colspan=3><input type="text" name="pstep2" size=80 value=""></td>
        </tr>
        <tr><td><span class="labeltext"><b>Step3</b></td>
            <td colspan=3><input type="text" name="pstep3" size=80 value=""></td>
        </tr>
        <tr><td><span class="labeltext"><b>Step4</b></td>
            <td colspan=3><input type="text" name="pstep4" size=80 value=""></td>
        </tr>

        <tr bgcolor="#FFCC00">
            <td colspan=4><span class="heading"><center><b>Special Instructions</b></center></td>
        </tr>
        <tr>
            <td colspan=4><textarea name="spec_instrns" rows="6" cols="92" value=""></textarea></td>
        </tr>

         <input type="hidden" name="wotype" size=15 value="Board">
 
         <input type="hidden" name="pagename" size=15 value="boardwoEntry">
        </table>

        <br> 
        <span class="tabletext"><input type="submit" 
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                    <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">
        
      </FORM>



        </td>
    </tr>
    </table>
    </td>
</tr>
</table>



    </td>
</tr>
<tr>
    <td height="1"></td>
    <td></td>
</tr>


</table>


</body>
</html>