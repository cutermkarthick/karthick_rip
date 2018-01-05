<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 10, 2010                 =
// Filename: getwo4dn.php                      =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Popup for selecting board designers         =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
include('classes/dnClass.php');
$newdn = new dn;
$crn=$_REQUEST['crn'];
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>All CIM Ref Nos</title>
</head>
<body onload=self.focus()>
<form>
<br>
Please select appropriate PRN No.</b>
<br>
<br>
<?php
/*
$cond="m.CIM_refnum='".$crn."'";*/
$result = $newdn->getwocrns4dn();
?>
<!-- <div style="width:100%;overflow:scroll;"> -->
        <table style="table-layout: fixed" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr  bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
                               </tr>
<!-- </table>
<div style="width:100%; height:250; overflow:scroll;">
<table style="table-layout: fixed" width=50% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" > -->
             <?php
                 while ($myrow = mysql_fetch_row($result)) {

              /*  echo "<pre>";
                print_r($myrow);*/

                  ?>
                 
                <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=5%><input type="radio" name="wocrn"   value="<?php echo $myrow[0]?>"></td>

                 <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[0] ?></td>
                          
                                   </td></tr>
                                 
             <?php
                //printf('<option value= %s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s>%s  |  %s  |  %s',
                  //          $myrow[0]."|".$myrow[1]."|".$myrow[2]."|".$myrow[3]."|".$myrow[4]."|".$myrow[5]."|".
                    //        $myrow[6]."|".$myrow[7]."|".$myrow[8]."|".$myrow[9]."|".$myrow[10]."|".$myrow[11]."|".$myrow[12]."|".
                      //      $myrow[13]."|".$myrow[14]."|".$myrow[15]."|".$myrow[16]."|".$myrow[17]."|".$myrow[18]."|".$myrow[9]."|".$myrow[1]."|".$myrow[4]);
                 }
             ?>
             
            </td>
        </tr>
</table>
  <!-- </div> -->
<script language=javascript>
function SubmitCIM(etype) {
 //alert('hi');
  /* var ind = document.forms[0].CIM.selectedIndex;*/
 //  alert(ind);
 //  alert(document.forms[0].CIM[ind].value);

  var flag=0;
 var user_input;
 //alert(document.forms[0].dispatch.length);
//alert(user_input);
//alert(ctype);
if(document.forms[0].wocrn.length)
{
 for (i=0;i<document.forms[0].wocrn.length;i++) {
  if (document.forms[0].wocrn[i].checked) {
    user_input = document.forms[0].wocrn[i].value;
     // alert(user_input);
    flag=1;
  }
}
}
else if(document.forms[0].wocrn.checked)
{
  user_input = document.forms[0].wocrn.value;
 
  flag = 1;
}
if(flag == 0)
{
  alert('Please select appropriate PRN# before submitting');
  self.close();
}
window.opener.Setwocrn_dn(user_input,etype);
self.close();


}
 /*  window.opener.Setwo_dn(document.forms[0].CIM[ind].text,document.forms[0].CIM[ind].value,etype);
   self.close();*/


</script>

<input type=button value="Submit" onclick=" javascript: return SubmitCIM(window.name)">
</form>
</body>
</html>

