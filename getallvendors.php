<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Sep 20, 2004                 =
// Filename: getallvendors.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Popup for selecting Vendor                  =
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
?>


<body onload=self.focus()>
<form>

<br>
Please select appropriate Supplier</b>
<br>
<?php
   $result = $newcompany->getAllVendors();

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
window.opener.SetVendor(document.forms[0].company[ind].text,document.forms[0].company[ind].value);
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
