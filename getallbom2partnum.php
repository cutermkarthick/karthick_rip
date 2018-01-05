<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Nov 10, 2006                 =
// Filename: getallbom2partnum.php             =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Popup for selecting partnum                 =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

include('classes/vendPartClass.php');
include('classes/displayClass.php');
$newVend = new vendPart;
$newdisplay = new display;

?>

<body onload=self.focus()>
<br>
Please select appropriate BOM#</b>
<br>
<?php
   $result = $newVend->getbom2Parts();

?>
  <form name="f" action="getallbom2partnum.php" method="POST">
        <tr>&nbsp</tr>
        <tr>
            <br>
            <td><span class="tabletext"><select name="company" size="1">
             <option selected>Please Specify
             <?php
                 while ($myrow = mysql_fetch_row($result)) {

                
              printf('<option value= %s|%s|%s|%s|%s>%s',
                          $myrow[3],$myrow[4],$myrow[5],$myrow[6], $myrow[0],$myrow[1]);
                 }
             ?>
             </select>
            </td>
        </tr>
<script language=javascript>
function SubmitComp() {
var ind = document.forms[0].company.selectedIndex;
window.opener.Setparts(document.forms[0].company[ind].text,document.forms[0].company[ind].value,document.forms[0].company[ind].value);
if (ind == 0)
{ alert("Please select a Company");
  return false;
}
self.close();
}
</script>
<input type=button value="Submit" onclick=" javascript: return SubmitComp()">
</html>