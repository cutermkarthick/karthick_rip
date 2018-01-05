<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 5, 2005                 =
// Filename: getQuote.php                      =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
//            Coded By  Jerry George           =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
// First include the class definition

include_once('classes/userClass.php');
include_once('classes/salesorderClass.php');
include_once('classes/displayClass.php');
$newso = new salesorder;

?>

<link rel="stylesheet" href="style.css">


<html>
<head>
<title>Sales Order</title>

</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='getquote.php' method='post' enctype='multipart/form-data'>
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
<tr><td><span class="pageheading"><b>List of Sales Orders</b></td></tr>
<tr><td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
<td bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
<td  bgcolor="#EEEFEE"><span class="tabletext"><b>SO#</b></td>
<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Date</b></td>
<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Resell#</b></td>
 <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Description</b></td>
<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Cust PO</b></td>
<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Cust Name</b></td>
</tr>
</table>
<div style="overflow: scroll; width: 550px; height: 245px;">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
	   <input type="hidden" name="sonum">
	   <input type="hidden" name="sorecnum">


<?php
       $result = $newso->getSalesorders();
        while ($myrow = mysql_fetch_row($result)) {
?>
                     <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF"><input type="radio" name="solutions"   value="<?php echo $myrow[0] ;?>" onclick="javascript :setvalues(<?php echo "$myrow[0],'$myrow[5]'";?>)"></td>

	      <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[5] ?></td>
                          <td><span class="tabletext"><?php echo $myrow[26] ?></td>
                          <td><span class="tabletext"><?php echo $myrow[16] ?></td>
                          <td><span class="tabletext"><?php echo $myrow[27] ?></td>
                          <td><span class="tabletext"><?php echo $myrow[4] ?></td>
                          <td><span class="tabletext"><?php echo $myrow[28] ?></td>

              </td></tr>
<?php
        }
?>

</table>
 </div>
<script langauge="javascript">
function setvalues(inpsorecnum,inpsonum)
{

var sorecnum=inpsorecnum;
var sonum=inpsonum;

//alert(sonum);
document.forms[0].sorecnum.value=sorecnum;
document.forms[0].sonum.value=sonum;
//alert(document.forms[0].quoterecnum.value);
//alert(document.forms[0].quotenum.value);
}



function SubmitReason(ctype) {

window.opener.SetSONo(document.forms[0].sorecnum.value,document.forms[0].sonum.value);
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
