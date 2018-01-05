<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Dec 28, 2017                 =
// Filename: getpartnum4supplier.php           =
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

include('classes/suppenquiryClass.php');
$newsuppenquiry = new suppenquiry; 

?>

<body onLoad="self.focus()">
  <form>
  <br>
    Please select appropriate Customer</b>
  <br>

  <tr>&nbsp</tr>

  <?php
   $result = $newsuppenquiry->getallpartnum4supplier();
  ?>

  <tr>&nbsp</tr>
  <tr>
    <br>
    <td><span class="tabletext">
      <select name="partnum" size="1">
        <option selected>Please Specify</option>
        <?php 
        while ($myrow = mysql_fetch_row($result)) 
        {

          printf('<option value= %s|%s>%s</option>',  $myrow[1],$myrow[2],$myrow[1]);
       }
      ?>
     </select>
    </td>
  </tr>

  <script language=javascript>
  function SubmitCust() 
  {
    var ind = document.forms[0].partnum.selectedIndex;
    window.opener.Setpartnum(document.forms[0].partnum[ind].value);
    if (ind == 0) 
    { 
      alert("Please select a Supplier");
      return false;
    }
    self.close();
  }
  </script>

<input type=button value="Submit" onclick=" javascript: return SubmitCust()">
</form>

</html>

