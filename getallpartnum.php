<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Oct 26, 2006                 =
// Filename: getallpartnum.php                 =
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
 $vendrecnum=$_REQUEST['vendrecnum'];
?>
 <script language=javascript>
function SubmitComp(ctype) {
//alert(ctype);
var ind = document.f.company.selectedIndex;
if (ctype == 'mfrpn')
  {
    //alert(document.f.company.value);
    window.opener.Setparts(document.f.company.value);
    self.close();
  }
if (ctype == 'mfrpn1')
  {
   //alert(document.f.company.value);
    window.opener.Setparts1(document.f.company.value);
    self.close();
  }
if (ctype == 'mfrpn2')
  {
    window.opener.Setparts2(document.f.company.value);
    self.close();
  }
if (ctype == 'mfrpn3')
  {
    window.opener.Setparts3(document.f.company.value);
    self.close();
  }
if (ctype == 'mfrpn4')
  {
    window.opener.Setparts4(document.f.company.value);
    self.close();
  }
if (ctype == 'mfrpn5')
  {
    window.opener.Setparts5(document.f.company.value);
    self.close();
  }
if (ctype == 'mfrpn6')
  {
    window.opener.Setparts6(document.f.company.value);
    self.close();
  }
if (ctype == 'mfrpn7')
  {
    window.opener.Setparts7(document.f.company.value);
    self.close();
  }
if (ctype == 'mfrpn8')
  {
    window.opener.Setparts8(document.f.company.value);
    self.close();
  }
if (ctype == 'mfrpn9')
  {
    window.opener.Setparts9(document.f.company.value);
    self.close();
  }

if (ctype == 'mfrpn10')
  {
    window.opener.Setparts10(document.f.company.value);
    self.close();
  }
if (ctype == 'mfrpn11')
  {
    window.opener.Setparts11(document.f.company.value);
    self.close();
  }
if (ctype == 'mfrpn12')
  {
    window.opener.Setparts12(document.f.company.value);
    self.close();
  }
if (ctype == 'mfrpn13')
  {
    window.opener.Setparts13(document.f.company.value);
    self.close();
  }
if (ctype == 'mfrpn14')
  {
    window.opener.Setparts14(document.f.company.value);
    self.close();
  }
self.close();
}
</script>

<body onload=self.focus()>
<br>
Please select appropriate Parts#</b>
<br>
<?php
   $result = $newVend->getParts($vendrecnum);

?>
 	<form name="f" action="getallpartnum.php" method="POST">

        <tr>&nbsp</tr>
        <tr>
            <br>
            <td><span class="tabletext"><select name="company" size="1">
             <option selected>Please Specify
             <?php
                 while ($myrow = mysql_fetch_row($result)) {
              printf('<option value= %s|%s|%s>%s',
                            $myrow[2],$myrow[0],$myrow[1],$myrow[2]);
                 }
             ?>
             </select>
            </td>
        </tr>

<input type=button value="Submit" onclick=" javascript: return SubmitComp(window.name)">
</html>