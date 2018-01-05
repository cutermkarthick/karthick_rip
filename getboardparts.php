<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: getboardparts.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Popup for selecting board parts             =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];

include('classes/partClass.php'); 
$inppart = $_REQUEST['partnum'];
$newpart = new part; 
?>


<body onload=self.focus()>
<form>

<br>
Please select appropriate Part</b>
<br>
<?php
   $result = $part->VerifyPart($inppart);
   if ($result == "0") {
      $output = "Part Exists";
   }
   else
   {
       $output = "Part Does not Exist";
   
   }
      

?>

        <tr>&nbsp</tr>
        <tr>
            
            <td><span class="labeltext"><p align="left">Result</p></font></td>
            <td colspan=3><input type="text" name="result" size=90 value="<? echo $output ?>"></td>
        </tr>

<script language=javascript>
function SubmitPart() {
var ind = document.forms[0].part.selectedIndex;
window.opener.SetPart(document.forms[0].part[ind].text,document.forms[0].part[ind].value);
if (ind == 0) 
{ alert("Please select a Part");
  return false;
}
self.close();
}
</script>

<input type=button value="Submit" onclick=" javascript: return SubmitPart()">
</form>
</html>

