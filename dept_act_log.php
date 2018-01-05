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
include_once('classes/workorderClass.php');
include_once('classes/displayClass.php');
include_once('classes/datesClass.php');

$newDates = new dates;

$worecnum = $_REQUEST['worecnum'];
$wotype = $_REQUEST['wotype'];


?>

<link rel="stylesheet" href="style.css">


<html>
<head>
<title>Quote</title>

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

<tr><td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
 <td bgcolor="#EEEFEE"><span class="heading"><b>Sl No.</b></td>
 <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Dept</b></td>
 <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Date</b></td>
 <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Approval</b></td>
 <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Task</b></td>

</tr>
</table>
 <div style="overflow: scroll; width: 550px; height: 245px;">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
	   <input type="hidden" name="quotenum">
	   <input type="hidden" name="quoterecnum">

<?php
      $i=1;
       $timeline = $newDates->getdates('WO', $worecnum,$wotype);
        while ($mytl = mysql_fetch_row($timeline)) {
?>
                     <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF"><input type="radio" name="solutions"   value="<?php echo $myrow[0] ;?>" onclick="javascript :setvalues(<?php echo "$myrow[6],'$myrow[0]'";?>)"></td>

	      <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $i ?></td>
                          <td><span class="tabletext"><?php echo $mytl[28] ?></td>
                          <td><span class="tabletext"><?php echo $mytl[4] ?></td>
                          <td><span class="tabletext"><?php echo $mytl[16] ?></td>
                          <td><span class="tabletext"><?php //echo $myrow[3] ?></td>


              </td></tr>
<?php
       $i++;
     }
?>

</table>
 </div>
<script langauge="javascript">
function setvalues(inpquoterecnum,inpquotenum)
{
var quoterecnum=inpquoterecnum;
var quotenum=inpquotenum;

//alert(quotenum);
document.forms[0].quoterecnum.value=quoterecnum;
document.forms[0].quotenum.value=quotenum;
//alert(document.forms[0].quoterecnum.value);
//alert(document.forms[0].quotenum.value);
}



function SubmitReason(ctype) {

window.opener.SetQuoteNo(document.forms[0].quoterecnum.value,document.forms[0].quotenum.value);
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
