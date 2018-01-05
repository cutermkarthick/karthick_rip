<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: getemployer.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Popup for selecting employer                =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];

include('classes/companyClass.php'); 
$newcompany = new company; 

if (isset($_REQUEST['emp_type'])) {
    $emp_type = $_REQUEST['emp_type'];
}
else {
   $emp_type = "" ;
}

?>


<body onload=self.focus()>
<form>

<br>
Please select appropriate Company</b>
<br>
<?php
   $result = $newcompany->getAllHosts($emp_type);

?>

        <tr>&nbsp</tr>
        <tr>
            <br>
            <td><span class="tabletext"><select name="company" size="1">
             <option selected>Please Specify
             <?php 
                 while ($myrow = mysql_fetch_row($result)) {
	             printf('<option value= %s>%s',
                            $myrow[0],$myrow[1]);
                 }
             ?>
             </select>
            </td>
        </tr>

<script language=javascript>
function SubmitComp() {
var ind = document.forms[0].company.selectedIndex;
window.opener.SetCompany(document.forms[0].company[ind].text,document.forms[0].company[ind].value);
if (ind == 0) 
{ alert("Please select a Company");
  return false;
}
self.close();
}
</script>

<input type=button value="Submit" onclick=" javascript: return SubmitComp()">
</form>
</html>

