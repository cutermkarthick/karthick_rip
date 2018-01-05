<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Dec 19, 2006                 =
// Filename: getcust4shipping.php            =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Popup for selecting customer shipping address        =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

include('classes/companyClass.php');
$newcust = new company;
?>

<body onLoad="self.focus()">
</body>
<form>

<br>
Please select appropriate Customer for Shipping Address</b>
<br>
        <tr>&nbsp</tr>
<?php
   $result = $newcust->getCustomers4billshipAdrs();
?>

        <tr>&nbsp</tr>
        <tr>
            <br>
            <td><span class="tabletext"><select name="customer" size="1">
             <option selected>Please Specify
             <?php
                 while ($myrow = mysql_fetch_row($result)) {
                       $arg="'" . $myrow[2] . "|" . $myrow[3] . "|" . $myrow[4] . "|" . $myrow[5] . "|" . $myrow[6] . "|" . $myrow[7] . "|" . $myrow[8] . "|" . $myrow[9] . "|" . $myrow[10] . "|" . $myrow[11] . "|" . $myrow[12] . "|" . $myrow[13] . "|" . $myrow[0] . "|" . $myrow[14] . "|" . $myrow[15] . "'";
	                            printf('<option value= %s>%s',$arg, $myrow[1]);
                 }
             ?>
             </select>
            </td>
        </tr>

<script language=javascript>
function SubmitCust() {
var ind = document.forms[0].customer.selectedIndex;
window.opener.SetCust4Shipping(document.forms[0].customer[ind].text,document.forms[0].customer[ind].value);
if (ind == 0)
{ alert("Please select a Customer");
  return false;
}
self.close();
}
</script>

<input type=button value="Submit" onclick=" javascript: return SubmitCust(window.name)">
</form>

</html>
