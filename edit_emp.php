<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: edit_emp.php                      =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Allows editing of employee details          =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'editemp';
$page="Employee";
////////session_register('pagename');
$empid = $_REQUEST['empid'];
$emp_type = $_REQUEST['emp_type'];

// First include the class definition
include('classes/empClass.php');
include('classes/companyClass.php');
include('classes/displayClass.php');
$newEmp = new emp;
$newdisplay = new display;
$result = $newEmp->getEmp($empid,$emp_type);
$myrow = mysql_fetch_row($result);
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/emp.js"></script>


<html>
<head>
<title>Edit Employee</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
     <form action='processEmp.php' method='post' enctype='multipart/form-data'>
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
<?php
   $newdisplay->dispLinks('');

?>
                        <table width=100% border=0 cellpadding=0 cellspacing=0  >
                            <tr bgcolor="DEDFDE">
                                <td width="6"><img src="images/spacer.gif " width="6"></td>
                                <td bgcolor="#FFFFFF">
                                    <table width=100% border=0 cellpadding=6 cellspacing=0  >
                                        <tr><td> -->
                                             <table width=100% border=0>
                                                <tr>
                                                    <td><span class="pageheading"><b>Edit Employee</b></td>

                                                    </tr>
                                                 </table>
                                        </td></tr>
                                        <tr>
                                            <td>
                                              <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
                                                        <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
                                                                       <tr bgcolor="#FFFFFF"  >
                                                <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
                                                        <tr bgcolor="#FFFFFF">

            <td><span class="labeltext"><p align="left">Employee ID</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[4] ?></td>
            <td><span class="labeltext"><p align="left">Company</p></font></td>
            <td><input type="text" name="company"
                    style=";background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo $myrow[15] ?>">
            <img src="images/bu-getcompany.gif" alt="Get Company"                                                   onclick="GetEmployer()"><input type="hidden" name="companyrecnum">
            </td>

        </tr>




        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Employee Type</p></font></td>
            <td><span class="tabletext">
              <input type="text" name="emp_type" id="emp_type" value="<?php echo $myrow[21]; ?>" style="
              background-color:#DDDDDD;" readonly="readonly">
              <select name="emp_type_sel" id="emp_type_sel" onchange="EmpTypeSelection()">
                <option value="Please Select" disabled >Please Select</option>
                <option value="Permanent" <?php if($myrow[21] == "Permanent" || $myrow[21] == ""){ echo "selected='selected'";}?>>Permanent</option>
                <option value="Contract" <?php if($myrow[21] == "Contract" ){ echo "selected='selected'";}?> >Contract</option>
              </select></span>
            </td>
            <td></td>
            <td></td>
          </tr>

          
            <tr bgcolor="#FFFFFF" >
              <td><span class="labeltext"><p align="left">Expiry Date</p></span></td>
              <td><span class="tabletext">
                <input type="text" name="emp_expiry_date" id="emp_expiry_date" value="<?php echo $myrow[23]; ?>"
                 style="background-color:#DDDDDD;" readonly="readonly"></span>
                <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('emp_expiry_date')">
              </td>
              <td><span class="labeltext"><p align="left">Secondary Company</p></span></td>
              <td><input type="text" name="secondary_company" style="background-color:#DDDDDD;"
                readonly="readonly" size=30 value="<?php echo $myrow[24]; ?>">
               <img src="images/bu-getcompany.gif" alt="Get Company" onclick="GetCustomer()"><input type="hidden" name="custrecnum" id="custrecnum" value="<?php echo $myrow[22]; ?>">
              </td>
            </tr>


          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">First Name</p></font></td>
            <td><input type="text" name="fname" size=20 value="<?php echo $myrow[0] ?>"></td>
            <td><span class="labeltext"><p align="left">Last Name</p></font></td>
            <td><input type="text" name="lname" size=20 value="<?php echo $myrow[1] ?>"></td>
        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Salutation</p></font></td>
             <td><span class="tabletext"><input type="text" name="salu" size=15  value="<?php echo $myrow[16] ?>"
            <span class="tabletext"><select name="sal" size="1" width="100" onchange="onSelectSal()">
             <option value="Mr." <?php if($myrow[16] == "Mr." ){echo "selected='selected'";} ?>>Mr.
             <option value="Ms." <?php if($myrow[16] == "Ms." ){echo "selected='selected'";} ?>>Ms.
             </select>
            </td>
            <td><span class="labeltext"><p align="left">Title</p></font></td>
            <td><input type="text" name="title" size=20 value="<?php echo $myrow[5] ?>"><input type="hidden" name="salval" value="<?php echo $myrow[16] ?>"></td>
         </tr>

          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Role</p></font></td>
            <td><span class="tabletext"><input type="text" name="rolename" size=15  value="<?php echo $myrow[3] ?>"
            <span class="tabletext"><select name="role" size="1" width="100" onchange="onSelectRole()">
             <option value>Please Specify
             <option value>SU
             <option value>RU
             <option value>DESG_S
             <option value>DESG_B
             <option value>SA
             <option value>SALES
             <option value>SALES PERSON
             <option value>SALES MANAGER
             <option value>OP
             <option value>FF
             <option value>CF
            </select>
            </td>

            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><input type="text" name="phone" size=20 value="<?php echo $myrow[6] ?>"> <input type="hidden" name="roleval" value="<?php echo $myrow[3] ?>"></td>
        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Email</p></font></td>
            <td><input type="text" name="email" size=20 value="<?php echo $myrow[7] ?>"</td>
            <td><span class="labeltext"><p align="left">Address 1</p></font></td>
            <td><input type="text" name="address1" size=20 value="<?php echo $myrow[8] ?>"</td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Address 2</p></font></td>
            <td><input type="text" name="address2" size=20 value="<?php echo $myrow[9] ?>"</td>

            <td><span class="labeltext"><p align="left">City</p></font></td>
            <td><input type="text" name="city" size=20 value="<?php echo $myrow[10] ?>"</td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">State</p></font></td>
           <td><input type="text" name="state" size=20 value="<?php echo $myrow[11] ?>"</td>
            <td><span class="labeltext"><p align="left">Zipcode</p></font></td>
            <td><input type="text" name="zipcode" size=20 value="<?php echo $myrow[12] ?>"</td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Country</p></font></td>
            <td><input type="text" name="country" size=20 value="<?php echo $myrow[14] ?>"</td>
            <td><span class="tabletext"><p align="left"><b>Status</b></p></font></td>
            <td><span class="tabletext"><input type="text" name="status" size=15  value="<?php echo $myrow[13] ?>"
            <span class="tabletext"><select name="active" size="1" width="40" onchange="onSelectStatus()">
             <option value="Active" <?php if($myrow[13] == "Active" ){echo "selected='selected'";} ?> >Active
             <option value="Inactive" <?php if($myrow[13] == "Inactive" ){echo "selected='selected'";} ?> >Inactive
             <option value="Obsolete" <?php if($myrow[13] == "Obsolete" ){echo "selected='selected'";} ?> >Obsolete
            </select>
                        <input type="hidden" name="activeval" value="<?php echo $myrow[13] ?>">
                        <input type="hidden" name="empid" value="<?php echo $empid ?>">
                        <input type="hidden" name="deleteflag" value="">

            </td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Department</p></font></td>
           <td ><input type="text" name="department" size=20 value="<?php echo $myrow[17] ?>"</td>
           <td><span class="labeltext"><p align="left">Employee Code</p></font></td>
           <td><span class="tabletext"><input type="text" name="empcode" id="empcode" size=30 value="<?php echo $myrow[18] ?>"></td>


        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Shift</p></span></td>
            <td >
                <select name="shift_group" id="shift_group" >
                    <option value="general" <?php if($myrow[19] == "general" || $myrow[19] == ""){echo "selected='selected'";} ?>>General</option>
                    <option value="day" <?php if($myrow[19] == "day" ){echo "selected='selected'";} ?>>Day</option>
                    <option value="daynight" <?php if($myrow[19] == "daynight" ){echo "selected='selected'";} ?>>Day Night</option>
                    <option value="night" <?php if($myrow[19] == "night" ){echo "selected='selected'";} ?>>Night</option>
                </select>
            <td><span class="labeltext"><p align="left">Subscription Type</p></span></td>
            <td>
              <select name="subscription_type" id="subscription_type" >
                    <option value="tms" <?php if($myrow[20] == "tms" || $myrow[19] == ""){echo "selected='selected'";} ?>>TMS</option>
                    <option value="ams" <?php if($myrow[20] == "ams" ){echo "selected='selected'";} ?>>AMS</option>
                    <option value="both" <?php if($myrow[20] == "both" ){echo "selected='selected'";} ?>>BOTH</option>
                </select>
            </td>
        </tr>

                                                        </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                               <!--  <td width="6"><img src="images/spacer.gif " width="6"></td>
                            </tr>
                            <tr bgcolor="DEDFDE">
                                <td width="6"><img src="images/box-left-bottom.gif"></td>
                                <td><img src="images/spacer.gif " height="6"></td>
                                <td width="6"><img src="images/box-right-bottom.gif"></td>
                            </tr> -->
                        </table>
                        <table border = 0 cellpadding=0 cellspacing=0 width=100% >
                            <tr>
                                <td align=left>
                                </td>
                            </tr>
                        </table>
        <span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">

                    </FORM>
        </body>
</html>
