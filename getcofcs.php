<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = june 08,2009                 =
// Filename: getcofc.php                       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
//                                             =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
// First include the class definition
$wonum = $_REQUEST['wonum'];
//echo $wonum;

include_once('classes/displayClass.php');
include_once('classes/nc4qaclass.php');
$newnc = new nc4qa;

?>

<link rel="stylesheet" href="style.css">

<html>
<head>
<title>C of C No</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='getcofcs.php' method='post' enctype='multipart/form-data'>
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
<tr><td><span class="pageheading"><b>Dispatch Details</b></td></tr>
<tr><td>
<table style="table-layout: fixed" width=580px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=50px bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=80px bgcolor="#EEEFEE"><span class="tabletext"><b>Relnotenum</b></td>
            <td width=90px bgcolor="#EEEFEE"><span class="tabletext"><b>Dispatch Date</b></td>
            <td width=150px bgcolor="#EEEFEE"><span class="tabletext"><b>Customer</b></td>
            <td width=80px bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
            <td width=60px bgcolor="#EEEFEE"><span class="tabletext"><b>WO #</b></td>
       </tr>
</table>
<div style="width:600px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=580px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
    <input type="hidden" name="advlicno">
	   <input type="hidden" name="advlicrecnum">

<?php
       $result = $newnc->getcofcs($wonum);
        while ($myrow = mysql_fetch_row($result)) {
?>

    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=50px><input type="radio" name="cofc"   value="<?php echo $myrow[0];?>"></td>
	      <td width=80px  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[0] ?></td>
                          <td width=90px><span class="tabletext"><?php echo $myrow[1] ?></td>
                          <td width=150px><span class="tabletext"><?php echo wordwrap($myrow[2],20,"<br>\n",true) ?></td>
                          <td width=80px><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td width=60px><span class="tabletext"><?php echo $myrow[4] ?></td>
              </td></tr>
<?php
        }
?>

</table>
 </div>
<script langauge="javascript">

function Submitcofc(ctype){
 var flag=0;
 var length_flag=0;
for (i=0;i<document.forms[0].cofc.length;i++) {
	 if (document.forms[0].cofc[i].checked) {
        //alert('inside');
		user_input = document.forms[0].cofc[i].value;
		flag=1;
	}
 }


if(flag == 0 && document.forms[0].cofc.checked)
{
  	user_input = document.forms[0].cofc.value;
}
else if(flag == 0)
{
   alert('Please select appropriate Relnotenum before submitting');
   self.close();
}

window.opener.Setcofc(user_input,ctype);
self.close();}

</script>
<input type=button value="Submit" onclick=" javascript: return Submitcofc(window.name)">
      </FORM>
</td></tr>
</table>
<table border = 0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align=left>
</td>
</tr></table>
</body>
</html>
