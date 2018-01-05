<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 28, 2013                =
// Filename: getgrns.php                       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Popup for selecting GRNS                    =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}


$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'getgrns.php';
include('classes/grnclass.php');
$newgrn = new grn;

$rm_type = $_REQUEST['rm_type'];
$rm_spec = $_REQUEST['rm_spec'];
$crn = $_REQUEST['crn'];
$woclassif = $_REQUEST['woclassif'];
//echo $woclassif."-----<br>";
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>Please select appropriate GRN#</title>
</head>
<body onload=self.focus()>

<form action='getCIM.php' method='post' enctype='multipart/form-data'>
<?php  
   $grnarr = array();
   $result1 = $newgrn->getwoqty4grn();
   while ($myrow = mysql_fetch_row($result1)) {
        $grnnum = "'" . $myrow[0] . "'";
        $grnarr[$grnnum] = $myrow[1];
   }
   $result = $newgrn->getallgrns($crn,$woclassif);
?>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<table>
<tr><td><span class="pageheading"><b>PRN</b></td></tr>
<tr><td>
<table style="table-layout: fixed" width=970px  border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=60px bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=100px bgcolor="#EEEFEE"><span class="tabletext"><b>GRN</b></td>
            <td width=100px bgcolor="#EEEFEE"><span class="tabletext"><b>Batch Num</b></td>
            <td width=50px bgcolor="#EEEFEE"><span class="tabletext"><b>Qty</b></td>
			 <td width=100px bgcolor="#EEEFEE"><span class="tabletext"><b>Received<br/> Date</b></td>
            <td width=80px bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
            <td width=100px bgcolor="#EEEFEE"><span class="tabletext"><b>Raw Mat<br/>  Type</b></td>
            <td width=100px bgcolor="#EEEFEE"><span class="tabletext"><b>Raw Mat<br/>  Spec</b></td>
            <td width=100px bgcolor="#EEEFEE"><span class="tabletext"><b>GRN Type</b></td>		
       </tr>
<!-- </table>
<div style="width:987px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF"  -->
<?php    
      $i=0;
   while ($myrow = mysql_fetch_row($result))
   {
      
   $qty_ret = $myrow[11];
   $qty_used = $myrow[10];
   $qty = ($myrow[3]-$qty_used)+$qty_ret;
                     
?>
    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=60px><input type="radio" name="grn"   id="grn"
	value="<?php echo $myrow[1] ."|".$myrow[2]."|".$qty."|".$myrow[4]."|".$myrow[5]."|".$myrow[6]."|".$myrow[7]?>"></td>
	      <td width=100px bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
                          <td width=100px><span class="tabletext"><?php echo $myrow[2] ?></td>
                          <td width=50px><span class="tabletext"><?php echo $qty ?></td>
						   <td width=100px><span class="tabletext"><?php echo $received_date ?></td>
                          <td width=80px><span class="tabletext"><?php echo $myrow[4] ?></td>
                          <td width=100px><span class="tabletext"><?php echo $myrow[5] ?></td>
                          <td width=100px><span class="tabletext"><?php echo $myrow[6] ?></td>
                          <td width=100px><span class="tabletext"><?php echo $myrow[7] ?></td>						
       </td></tr>
	   <input type='hidden' name='recnum_<?=$i?>' id='recnum_<?=$i?>' value='<?=$myrow[0]?>'>
<?php
$i++;
      

   }
?>
 </td>
 </tr>
<input type='hidden' name='check' id='check' value='<?=$older_grn?>'>
<input type='hidden' name='crn' id='crn' value='<?=$crn?>'>
</table>
 </div>

<script language=javascript>
function SubmitGRN(etype,gc){
 // alert("in script");
 var flag=0;
 var user_input;
 // alert("in script here");
 crn = document.forms[0].crn.value;;
 
 var len = parseInt(gc);
 var fifocheck = 0;
 // alert(len);
 //alert("in submit "+crn);
 //alert("grn length is :"+gc);
//alert("flag is ="+flag);
// if(document.forms[0].i.length)
if(len > 1)
{
 // alert("gc > 0");
 for (i=0;i<len;i++) {
                  // alert("here in for");
	if (document.forms[0].grn[i].checked) {
		user_input = document.forms[0].grn[i].value;
		grnrecnum = document.getElementById('recnum_'+i).value;
                  // alert("here in if");
		flag=1;
		if (i == 0)
			fifocheck = 1;
	}
   }
}
else if(len == 1)
{
                  // alert("here in len = 1");
		user_input = document.forms[0].grn.value;
		grnrecnum = document.getElementById('recnum_0').value;
    // alert(user_input);
                  //alert("here in len = 1"+grnrecnum);
		flag=1;
		fifocheck = 1;

}
else if(document.forms[0].grn.checked)
{
                  //alert("otherwise here");
  user_input = document.forms[0].grn.value;
  flag = 1;
}
else {

  flag = 0;
}
if(flag == 0)
{
  alert('Please select appropriate PRN before submitting');
  self.close();
}

if(fifocheck == 0 && 
	(crn != '18-376B' &&
     crn != '18-377B' && 
     crn != '35-021' && 
     crn != '18-378B' &&
     crn != '18-380B' &&
     crn != '18-381B'))
{
  alert('Please select first available GRN');
  self.close();
}
else
{

    window.opener.Setgrn(user_input,grnrecnum);

}
// alert("After set");
   self.close();
}
</script>
<input type=button value="Submit" onclick=" javascript: return SubmitGRN(window.name,<?php echo $i ?>)">
</form>
</body>
</html>

