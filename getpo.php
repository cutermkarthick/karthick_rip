<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Feb 14, 2007                 =
// Filename: getpo.php                         =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
//            Coded By  Suresh Devadiga        =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
// First include the class definition

include_once('classes/userClass.php');
include_once('classes/poClass.php');
include_once('classes/displayClass.php');
$newPO = new po;

?>

<link rel="stylesheet" href="style.css">


<html>
<head>
<title>PO</title>

</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='getpo.php' method='post' enctype='multipart/form-data'>
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >

<table>
<tr><td><span class="pageheading"><b>Purchase Orders</b></td></tr>
<tr><td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=10% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=9% bgcolor="#EEEFEE"><span class="tabletext"><b>PO #</b></td>
            <td width=15% bgcolor="#EEEFEE"><span class="tabletext"><b>Date</b></td>
            <td width=20% bgcolor="#EEEFEE"><span class="tabletext"><b>Vendor Name</b></td>
            <td width=20% bgcolor="#EEEFEE"><span class="tabletext"><b>Description</b></td>
            <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Amount</b></td>
            <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></td>
       </tr>
</table>
 <div style="overflow: scroll; width: 550px; height: 245px;">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
	   <input type="hidden" name="ponum">
	   <input type="hidden" name="porecnum">

<?php
       $result = $newPO->getPOs();
        while ($myrow = mysql_fetch_row($result)) {
?>

    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=11%><input type="radio" name="solutions"   value="<?php echo $myrow[0] ;?>" onclick="javascript :setvalues(<?php echo "$myrow[11],'$myrow[0]'";?>)"></td>
	      <td bgcolor="#FFFFFF" width=10% ><span class="tabletext"><?php echo $myrow[0] ?></td>
                          <td width=15%><span class="tabletext"><?php echo $myrow[1] ?></td>
                          <td width=20%><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td width=20%><span class="tabletext"><?php echo $myrow[2] ?></td>
                          <td width=10%><span class="tabletext"><?php echo $myrow[6] ?></td>
                          <td width=10%><span class="tabletext"><?php echo $myrow[7] ?></td>

              </td></tr>
<?php
        }
?>

</table>
 </div>
<script langauge="javascript">
function setvalues(inpporecnum,inpponum)
{
var porecnum=inpporecnum;
var ponum=inpponum;

//alert(ponum);
document.forms[0].porecnum.value=porecnum;
document.forms[0].ponum.value=ponum;
//alert(document.forms[0].porecnum.value);
//alert(document.forms[0].ponum.value);
}



function SubmitReason(ctype) {

window.opener.SetPONo(document.forms[0].porecnum.value,document.forms[0].ponum.value);
self.close();}

</script>
<input type=button value="Submit" onclick=" javascript: return SubmitReason(window.name)">
      </FORM>
</td></tr>
</table>
</table>
<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
<td align=left>
</td>
</tr></table>
</body>
</html>
