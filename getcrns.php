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

include('classes/mc_masterClass.php');
$newmcm = new mc_master;

?>

<body onLoad="self.focus()">
</body>
<form>

<br>
Please select appropriate PRN#</b>
<br>

        <tr>&nbsp;</tr>

<?php
   $result = $newmcm->getcrns();
?>

        <tr>&nbsp;</tr>
        <tr>
            <br>
            <td><span class="tabletext"><select name="crn" size="1">
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
function Submitcrn() {
var ind = document.forms[0].crn.selectedIndex;
window.opener.Setcrn(document.forms[0].crn[ind].text,document.forms[0].crn[ind].value);
if (ind == 0)
{ alert("Please select a Customer");
  return false;
}

self.close();
}
</script>

<input type=button value="Submit" onclick=" javascript: return Submitcrn()">
</form>

</html>

