<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: getallemps.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Popup for selecting employees               =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$rt=$_REQUEST['reasontext'];
$userid = $_SESSION['user'];

include('classes/empClass.php'); 
$newemp = new emp; 
?>

<html>
<head>
    <title>Employees</title>
</head>

<form>

<br>
Please select appropriate employee</b>
<br>
<?php
   if ($rt == 'user') 
   {
      $result = $newemp->getEmps4UserLink();

   }
   else
   {
         $result = $newemp->getAllEmps();
   }
?>

        <tr>&nbsp</tr>
        <tr>
            <br>
            <td><span class="tabletext"><select name="emp" size="1">
             <option selected>Please Specify
             <?php 
                 while ($myrow = mysql_fetch_row($result)) {
	             printf('<option value=%s>%s %s',
                            $myrow[2],$myrow[0], $myrow[1]);
	//echo "$myrow[2]:$myrow[6]:$myrow[7]:$myrow[0]:$myrow[1]";
                 }
             ?>
             </select>
            </td>
        </tr>

<script language=javascript>
function SubmitEmp(etype) {
var ind = document.forms[0].emp.selectedIndex;
if (etype == 'DesSignoff') 
{
   window.opener.SetDesSignoffEmp(document.forms[0].emp[ind].text,document.forms[0].emp[ind].value);
}
if (etype == 'FPSignoff') 
{
   window.opener.SetFPSignoffEmp(document.forms[0].emp[ind].text,document.forms[0].emp[ind].value);
}
if (etype == 'MfgSignoff') 
{
   window.opener.SetMfgSignoffEmp(document.forms[0].emp[ind].text,document.forms[0].emp[ind].value);
}
if (etype == 'AssySignoff') 
{
   window.opener.SetAssySignoffEmp(document.forms[0].emp[ind].text,document.forms[0].emp[ind].value);
}
if (etype == 'FabSignoff') 
{
   window.opener.SetFabSignoffEmp(document.forms[0].emp[ind].text,document.forms[0].emp[ind].value);
}
if (etype == 'Owner') 
{
   window.opener.SetEmp(document.forms[0].emp[ind].text,document.forms[0].emp[ind].value);
}
if (etype == 'Employees') 
{
   window.opener.SetEmp(document.forms[0].emp[ind].text,document.forms[0].emp[ind].value);
}
if (etype == 'Employees1') 
{
   window.opener.SetEmp1(document.forms[0].emp[ind].text,document.forms[0].emp[ind].value);
}

if (ind == 0) 
{ alert("Please select an employee");
  return false;
}
self.close();
}

</script>

<input type=button value="Submit" onclick=" javascript: return SubmitEmp(window.name)">
</form>

</html>

