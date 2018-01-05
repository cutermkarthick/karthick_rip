<?php
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
include('classes/mc_capacityClass.php');
$newmc_capacity = new mc_capacity;
$result = $newmc_capacity->getmc_capacitys('');
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>MC Capacity</title>
</head>
<body onload=self.focus()>

<form action='get_machine.php' method='post' enctype='multipart/form-data'>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<table>
<tr><td><span class="pageheading"><b>MC Capacity</b></td></tr>
<tr><td>
<table style="table-layout: fixed" width=500px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=6px bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=8px bgcolor="#EEEFEE"><span class="tabletext"><b>MC#</b></td>
            <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>MC Name</b></td>
       </tr>
</table>
<div style="width:520px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=500px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php
while ($myrow = mysql_fetch_row($result))
{
  ?>
    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=6px><input type="radio" name="mc_id"   id="mc_id" value="<?php echo $myrow[0]."|".$myrow[1]."|".$myrow[2]."|".$myrow[4]?>"></td>
                          <td width=8px><span class="tabletext"><?php echo $myrow[1] ?></td>
                          <td width=10px><span class="tabletext"><?php echo $myrow[2] ?></td>
     </tr>
<?php
}
?>
</table>
 </div>



<script language=javascript>
function SubmitMC(etype){
 var flag=0;
 var user_input;
if(document.forms[0].mc_id.length)
{
 for (i=0;i<document.forms[0].mc_id.length;i++) {
	if (document.forms[0].mc_id[i].checked) {
		user_input = document.forms[0].mc_id[i].value;
		flag=1;
	}
}
}
else if(document.forms[0].mc_id.checked)
{
  user_input = document.forms[0].mc_id.value;
  flag = 1;
}
if(flag == 0)
{
  alert('Please select appropriate WO before submitting');
  self.close();
}
//alert(user_input);
window.opener.Set_machine(user_input,etype);
self.close();}
</script>
<input type=button value="Submit" onclick=" javascript: return SubmitMC(window.name)">
</form>
</html>
