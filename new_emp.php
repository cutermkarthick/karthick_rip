<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: new_emp.php                       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Allows entry of new employees               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'newemp';
$page= "Employee";
////////session_register('pagename');

// First include the class definition

include('classes/empClass.php');
include('classes/companyClass.php');
include('classes/displayClass.php');
$newEmp = new emp;
$newCompany = new company;
$newdisplay = new display;


?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/emp.js"></script>


<html>
<head>
<title>New Employee</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
     <form action='processEmp.php' method='post' enctype='multipart/form-data'>
<?php
    include('header.html');
?>

             <td><span class="pageheading"><b>New Employee</b></td>

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
            <td><span class="labeltext"><p align="left">Employee Type</p></font></td>
            <td><span class="tabletext">
              <input type="text" name="emp_type" id="emp_type" value="" style="
              background-color:#DDDDDD;" readonly="readonly">
              <select name="emp_type_sel" id="emp_type_sel" onchange="EmpTypeSelection()">
                <option value="Please Select" disabled selected>Please Select</option>
                <option value="Permanent">Permanent</option>
                <option value="Contract">Contract</option>
              </select></span>
            </td>
            <td></td>
            <td></td>
          </tr>

          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Company</p></font></td>
            <td><input type="text" name="company"
                    style=";background-color:#DDDDDD;"
                    readonly="readonly" size=30 value="FSI">
             <!-- <img src="images/bu-getcompany.gif" alt="Get Company" onclick="GetEmployer()"> -->
             <input type="hidden" name="companyrecnum" value="1">
            </td>
            <td><span class="labeltext"><p align="left">Employee Code</p></font></td>
            <td><span class="tabletext"><input type="text" name="empcode" id="empcode" size=30 value=""></td>
          </tr>
          
            <tr bgcolor="#FFFFFF" >
              <td><span class="labeltext"><p align="left">Expiry Date</p></span></td>
              <td><span class="tabletext">
                <input type="text" name="emp_expiry_date" id="emp_expiry_date" value=""
                 style="background-color:#DDDDDD;" readonly="readonly"></span>
                <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('emp_expiry_date')">
              </td>
              <td><span class="labeltext"><p align="left">Secondary Company</p></span></td>
              <td><input type="text" name="secondary_company" style="background-color:#DDDDDD;"
                readonly="readonly" size=30 value="">
               <img src="images/bu-getcompany.gif" alt="Get Company" onclick="getAllSubsidiaries()"><input type="hidden" name="custrecnum" id="custrecnum">
               <!-- getallsubsidiaries.php -->
              </td>
            </tr>
          
            <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">First Name</p></font></td>
            <td><input type="text" name="fname" size=30 value=""></td>
            <td><span class="labeltext"><p align="left">Last Name</p></font></td>
            <td><span class="tabletext"><input type="text" name="lname" size=30 value=""></td>



        </tr>
            <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Salutation</p></font></td>
            <td><span class="tabletext"><select name="salutation" size="1" width="100">
             <option selected>Mr.
             <option value>Ms.
            </select><input type="hidden" name="salval">
            </td>
            <td><span class="labeltext"><p align="left">Title</p></font></td>
            <td><span class="tabletext"><input type="text" name="title" size=30 value=""></td>
         </tr>

             <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Role</p></font></td>
            <td><span class="tabletext"><select name="role" size="1" width="100">
             <option value>SU
             <option value>RU
             <option value>SA
             <option value>SALES
             <option value>SALES PERSON
             <option value>SALES MANAGER
             <option value>AE
             <option value>PE
             <option value>OP
             <option value>FF
             <option value>CF
            </select><input type="hidden" name="roleval">
            </td>

            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><span class="tabletext"><input type="text" name="phone" size=30 value=""></td>

        </tr>

            <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Email</p></font></td>
            <td><span class="tabletext"><input type="text" name="email" size=30 value=""></td>

            <td><span class="labeltext"><p align="left">Address 1</p></font></td>
            <td><span class="tabletext"><input type="text" name="address1" size=30 value=""></td>
        </tr>
            <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Address 2</p></font></td>
            <td><span class="tabletext"><input type="text" name="address2" size=30 value=""></td>

            <td><span class="labeltext"><p align="left">City</p></font></td>
            <td><span class="tabletext"><input type="text" name="city" size=30 value=""></td>
        </tr>
            <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">State</p></font></td>
            <td><span class="tabletext"><input type="text" name="state" size=30 value=""></td>

            <td><span class="labeltext"><p align="left">Zipcode</p></font></td>
            <td><span class="tabletext"><input type="text" name="zipcode" size=30 value=""></td>
        </tr>
           <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Country</p></font></td>
            <td><span class="tabletext"><input type="text" name="country" size=30 value=""></td>
            <td><span class="labeltext"><p align="left">Status</p></font></td>
            <td><span class="tabletext"><select name="active" size="1" width="100">
             <option selected>Active
             <option value>Inactive
             <option value>Obsolete
            </select> <input type="hidden" name="activeval">
            </td>
        </tr>
        </tr>
            <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Department</p></font></td>
            <td colspan=3><span class="tabletext"><input type="text" name="department" size=30 value=""></td>

        </tr>
                    </table><!-- 
                                            </td>
                                        </tr>
                                        </tr>
                                    </table>
                                </td>
                                <td width="6"><img src="images/spacer.gif " width="6"></td>
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
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus1()">

                    </FORM>
        </body>
</html>
