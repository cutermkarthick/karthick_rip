<?php
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
//$invnum=$_REQUEST['invnum'];
include('classes/invoiceClass.php');
$newinv = new invoice;
?>

<body onLoad="self.focus()">
</body>
<form>
<br>
Please select appropriate Invoice</b>
<br>
        <tr>&nbsp</tr>
<?php
   $result = $newinv->getallinvoice4shipping($invnum);
?>

        <link rel="stylesheet" href="style.css">
<html>
<head>
    <title>Invoice(s)</title>
</head>
<body onload=self.focus()>

<form action='getCIM.php' method='post' enctype='multipart/form-data'>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<table>
<tr><td><span class="pageheading"><b>Invoice</b></td></tr>
<tr><td>
<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=6px bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=8px bgcolor="#EEEFEE"><span class="tabletext"><b>Invoice#</b></td>
            <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>Invoice Date</b></td>
            <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>Customer</b></td>
            <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>Ship To</b></td>
            <td width=5px bgcolor="#EEEFEE"><span class="tabletext"><b>Precarriage <br>By</b></td>
		    <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>Precarrier<br>receipt</b></td>
			<td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>Country Of<br>Final<br> Destination</b></td>
		    <td width=5px bgcolor="#EEEFEE"><span class="tabletext"><b>Vessel</b></td>
            <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>Port Of <br>Loading</b></td>
            <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>Port Of<br>Discharge</b></td>

       </tr>
</table>
<div style="width:987px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php
      while ($myrow = mysql_fetch_row($result))
	  {

?>
    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=6px><input type="radio" name="invoice"   id="invoice" value="<?php echo $myrow[0]."|".$myrow[1]."|".$myrow[2]."|".$myrow[15]."|".$myrow[19]."|".$myrow[5]."|".$myrow[6]."|".$myrow[9]."|".$myrow[10]."|".$myrow[11]."|".$myrow[12]."|".$myrow[24]."|".$myrow[4];?>"></td>
                          <td width=8px><span class="tabletext"><?php echo $myrow[1] ?></td>
                          <td width=10px><span class="tabletext"><?php echo $myrow[2] ?></td>
	                      <td width=10px><span class="tabletext"><?php echo wordwrap($myrow[15],"15","<br>\n",true) ?></td>
                          <td width=10px><span class="tabletext"><?php echo wordwrap($myrow[19],"15","<br>\n",true) ?></td>
                          <td width=5px><span class="tabletext"><?php echo $myrow[5] ?></td>
			              <td width=10px><span class="tabletext"><?php echo $myrow[6] ?></td>
			              <td width=10px><span class="tabletext"><?php echo $myrow[9] ?></td>
			              <td width=5px><span class="tabletext"><?php echo $myrow[10] ?></td>
			              <td width=10px><span class="tabletext"><?php echo $myrow[11] ?></td>
                          <td width=10px><span class="tabletext"><?php echo $myrow[12] ?></td>

       </td></tr>
<?php
      }
?>
</table>
 </div>



<script language=javascript>
function Submitinvoice(etype){
 var flag=0;
 var user_input;
 //alert(document.forms[0].invoice.length);
//alert(user_input);
//alert(ctype);
if(document.forms[0].invoice.length)
{
 for (i=0;i<document.forms[0].invoice.length;i++) {
	if (document.forms[0].invoice[i].checked) {
		user_input = document.forms[0].invoice[i].value;
		flag=1;
	}
}
}
else if(document.forms[0].invoice.checked)
{
  user_input = document.forms[0].invoice.value;
  flag = 1;
}
if(flag == 0)
{
  alert('Please select appropriate Invoice before submitting');
  self.close();
}
//alert(user_input);
window.opener.SetInvoice(user_input,etype);
self.close();}


</script>

<input type=button value="Submit" onclick=" javascript: return Submitinvoice(window.name)">
</form>

</html>
