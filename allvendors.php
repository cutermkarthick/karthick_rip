<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Oct 26, 2006                 =
// Filename: allvendors.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
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

 <script language=javascript>
function SubmitComp1(ctype) {
if (ctype == 'mfr')
  {
    window.opener.SetVendor(document.f.company.value);
    self.close();
  }
if (ctype == 'mfr1')
  {
    window.opener.SetVendor1(document.f.company.value);
    self.close();
  }
if (ctype == 'mfr2')
  {
    window.opener.SetVendor2(document.f.company.value);
    self.close();
  }
if (ctype == 'mfr3')
  {
    window.opener.SetVendor3(document.f.company.value);
    self.close();
  }
if (ctype == 'mfr4')
  {
    window.opener.SetVendor4(document.f.company.value);
    self.close();
  }
if (ctype == 'mfr5')
  {
    window.opener.SetVendor5(document.f.company.value);
    self.close();
  }
if (ctype == 'mfr6')
  {
     window.opener.SetVendor6(document.f.company.value);
     self.close();
  }
if (ctype == 'mfr7')
  {
    window.opener.SetVendor7(document.f.company.value);
    self.close();
  }
if (ctype == 'mfr8')
  {
    window.opener.SetVendor8(document.f.company.value);
    self.close();
  }
if (ctype == 'mfr9')
  {
    window.opener.SetVendor9(document.f.company.value);
    self.close();
  }

if (ctype == 'mfr10')
  {
    window.opener.SetVendor10(document.f.company.value);
    self.close();
  }
if (ctype == 'mfr11')
  {
    window.opener.SetVendor11(document.f.company.value);
    self.close();
  }
if (ctype == 'mfr12')
  {
    window.opener.SetVendor12(document.f.company.value);
    self.close();
  }
if (ctype == 'mfr13')
  {
    window.opener.SetVendor13(document.f.company.value);
    self.close();
  }
if (ctype == 'mfr14')
  {
    window.opener.SetVendor14(document.f.company.value);
    self.close();
  }
  if (ctype == 'mfr15')
  {
    window.opener.SetVendor15(document.f.company.value);
    self.close();
  }
  if (ctype == 'mfr16')
  {
    window.opener.SetVendor16(document.f.company.value);
    self.close();
  }
  if (ctype == 'mfr17')
  {
    window.opener.SetVendor17(document.f.company.value);
    self.close();
  }
  if (ctype == 'mfr18')
  {
    window.opener.SetVendor18(document.f.company.value);
    self.close();
  }
  if (ctype == 'mfr19')
  {
    window.opener.SetVendor19(document.f.company.value);
    self.close();
  }
  if (ctype == 'mfr20')
  {
    window.opener.SetVendor20(document.f.company.value);
    self.close();
  }
self.close();
}
</script>
<body onload=self.focus()>


<br>
Please select appropriate Vendor</b>
<br>
<?php
   $result = $newcompany->getAllVendors();

?>
   	<form name="f" action="allvendors.php" method="POST">
        <tr>&nbsp</tr>
        <tr>
            <br>
            <td><span class="tabletext"><select name="company" size="1">
             <option selected>Please Specify
             <?php
                 while ($myrow = mysql_fetch_row($result)) {
              printf('<option value=%s|%s>%s',
                            $myrow[1], $myrow[0],$myrow[1]);
                 }
             ?>
             </select>
            </td>
        </tr>

<input type=button value="Submit" onclick=" javascript: return SubmitComp1(window.name)">

</html>