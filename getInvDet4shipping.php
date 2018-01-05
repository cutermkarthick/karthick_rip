<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: getboarddes.php                   =
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

include('classes/shippingClass.php');
$newinv = new shipping;
$invnum=$_REQUEST['invnum'];
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>Invoice Number</title>
</head>
<body onLoad="self.focus()">
</body>
<form action='getInvDet4shipping.php' method='post' enctype='multipart/form-data'>

<?php
   $result = $newinv->getinvlidet4shipping($invnum);

?>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<table>
<tr><td><span class="pageheading"><b>Invoice</b></td></tr>
<tr><td>
<table style="table-layout: fixed" width=200 border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=5px bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>Invnum</b></td>
		<!--	<td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Currency</b></td>
			<td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Price</b></td>
		    <td width=20% bgcolor="#EEEFEE"><span class="tabletext"><b>Valid From</b></td>
            <td width=20% bgcolor="#EEEFEE"><span class="tabletext"><b>Valid To</b></td>
            <td width=20% bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></td> -->

       </tr>
</table>
<div style="width:250px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=200 border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

             <?php
             $user_input="";
                         while ($myrow = mysql_fetch_row($result))
                 {

                     $user_input =$myrow[0]."|".$myrow[1]."|".$myrow[2]."||" .$user_input;


             ?>

            <?php
                 }
                 //echo $user_input;

             ?>
                           <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=5px><input type="radio" name="crn"   id="crn" value="<?php echo $user_input ?>"></td>
                   <td width=10px><span class="tabletext"><?php echo $invnum ?></td>

            </td>
        </tr>
        </table>
 </div>

<script language=javascript>
function Submitinvoice(etype) {
 var flag=0;
 var user_input;
if(document.forms[0].crn.length)
{
 for (i=0;i<document.forms[0].crn.length;i++) {
	if (document.forms[0].crn[i].checked) {
		user_input = document.forms[0].crn[i].value;
		flag=1;
	}
}
}
else if(document.forms[0].crn.checked)
{
  user_input = document.forms[0].crn.value;
  flag = 1;
}
if(flag == 0)
{
  alert('Please select appropriate CRN before submitting');
  self.close();
}
//alert(user_input);
window.opener.SetInvoice4pack(user_input);
self.close();
}


</script>

<input type=button value="Submit" onclick=" javascript: return Submitinvoice(window.name,'<?php echo $user_input ?>')">
</form>

</html>
