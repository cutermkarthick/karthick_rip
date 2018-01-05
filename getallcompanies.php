<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: getcustomers.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Popup for selecting customers               =
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
Please select appropriate Customer</b>
<br>

        <tr>&nbsp</tr>

<?php
   $result = $newcust->getCos4Contact();

?>

        <tr>&nbsp</tr>
        <tr>
            <br>
            <td><span class="tabletext"><select name="customer" size="1">
             <option selected>Please Specify
             <?php 
                 while ($myrow = mysql_fetch_row($result)) {

	             printf('<option value= %s>%s|%s',
                            $myrow[0],$myrow[1],$myrow[3]);

               }
             ?>
             </select>
            </td>
        </tr>

<script language=javascript>
function SubmitCust() {
var ind = document.forms[0].customer.selectedIndex;
window.opener.SetCustomer(document.forms[0].customer[ind].text,document.forms[0].customer[ind].value);
if (ind == 0) 
{ alert("Please select a Customer");
  return false;
}
self.close();
}
</script>

<input type=button value="Submit" onclick=" javascript: return SubmitCust()">
</form>

</html>

