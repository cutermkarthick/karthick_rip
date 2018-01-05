<?php
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
include('classes/helperClass.php');
$newwo = new helper;
$wotype=$_REQUEST['wotype'];
?>
<html>
<head>
<title>All WOs</title>
</head>
<body onload=self.focus()>
<form>
<link rel="stylesheet" href="style.css">
<html>
<head>
<title>All WO's</title>
</head>
<body onload=self.focus()>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<table>
<tr><td><span class="pageheading"><b>WO</b></td></tr>
<tr><td>
<table style="table-layout: fixed" width='800px' border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=5% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>

<?php 
if($wotype =='Assy')
{
?>
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>Assy WO#</b></td>   
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>WO</b></td>   
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>Type</b></td>   
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>CRN</b></td>   
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>line num</b></td>   
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>Rew Qty</b></td>   
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>Custend rew qty</b></td>   
<?php
}
else
{
?>
<td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b> WO#</b></td>   
<?php  }?>
      </tr>
</table>
<div style="width:820px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width='800px' border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php
if($wotype == 'Regular')
{
$result = $newwo->getall_wo();
      while ($myrow = mysql_fetch_array($result)) {

        
         ?>
       <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=5%><input type="radio" name="wonum"   value="<?php echo $myrow[0]."|".$myrow[1]."|".$myrow[2]."|".$myrow['supplier']."|".$myrow['raw_mat_spec']."|".$myrow['raw_mat_type']."|".$myrow['raw_mat_code']."|".$myrow['coc_refnum']."|".$myrow['invoice_num']."|".$myrow['invoice_date']."|".$myrow['test_report']."|".$myrow['recieved_date']."|".$myrow['mgp_num']."|".$myrow['batch_num']."|".$myrow['rmbycim']."|".$myrow['rmbycust']."|".$myrow['cimponum']."|".$myrow['rmpolinenum']."|".$myrow['nc_refnum']."|".$myrow['pocrn']."|".$myrow['crn']."|".$myrow['grn_empcode']."|".$myrow['rmpo_date']."|".$myrow['rm_cost']."|".$myrow['remarks']."|".$myrow['grn_empcode']."|".$myrow['grn_date']."|".$myrow['grndateQuar']."|".$myrow['status']."|".$myrow['quarantine_remarks']."|".$myrow['conversion_date']."|".$myrow['conversion_rate']."|".$myrow['balance']."|".$myrow['qty4billet']."|".$myrow['uom']."|".$myrow['id']."|".$myrow['ncnum']."|".$wotype ."|".$myrow['link2vendor'] ."|".$myrow['recnum'] ."|".$myrow['grn'] ."|".$myrow[4] ."|".$myrow['linenum'] ."|".$myrow['partnum'] ."|".$myrow['partdesc'] ."|".$myrow['layoutrefnum'] ."|".$myrow['batchnum']."|".$myrow['mfr_name']."|".$myrow['dim1']."|".$myrow['dim2']."|".$myrow['dim3']."|".$myrow['noofpieces']     ?>"></td>
     <td width=8% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[0] ?></td>                            

<?php } 
}
else
{
$result = $newwo->getAssy_wo();
while ($myrow = mysql_fetch_array($result)) {

  if($myrow[2] =='Manufactured')
  {
    $grnnum = $myrow[7];
  }
  else
  {
    $grnnum = $myrow[5];
  }
  $result1 = $newwo->getAssy_wogrn($grnnum);
  if($result1)
  {
  $myrow1 = mysql_fetch_array($result1) ;       
?>
       <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=5%><input type="radio" name="wonum"   value="<?php echo $myrow[0]."|".$myrow[1]."|".$myrow[2]."|".$myrow1['supplier']."|".$myrow1['raw_mat_spec']."|".$myrow1['raw_mat_type']."|".$myrow1['raw_mat_code']."|".$myrow1['coc_refnum']."|".$myrow1['invoice_num']."|".$myrow1['invoice_date']."|".$myrow1['test_report']."|".$myrow1['recieved_date']."|".$myrow1['mgp_num']."|".$myrow1['batch_num']."|".$myrow1['rmbycim']."|".$myrow1['rmbycust']."|".$myrow1['cimponum']."|".$myrow1['rmpolinenum']."|".$myrow1['nc_refnum']."|".$myrow1['pocrn']."|".$myrow1['crn']."|".$myrow1['grn_empcode']."|".$myrow1['rmpo_date']."|".$myrow1['rm_cost']."|".$myrow1['remarks']."|".$myrow1['grn_empcode']."|".$myrow1['grn_date']."|".$myrow1['grndateQuar']."|".$myrow1['status']."|".$myrow1['quarantine_remarks']."|".$myrow1['conversion_date']."|".$myrow1['conversion_rate']."|".$myrow1['balance']."|".$myrow1['qty4billet']."|".$myrow1['uom']."|".$myrow1['id']."|".$myrow1['ncnum']."|".$wotype ."|".$myrow1['link2vendor'] ."|".$myrow[8] ."|".$myrow1['grn'] ."|".$myrow[4] ."|".$myrow1['linenum'] ."|".$myrow1['partnum'] ."|".$myrow1['partdesc'] ."|".$myrow1['layoutrefnum'] ."|".$myrow1['batchnum']."|".$myrow1['mfr_name']."|".$myrow1['dim1']."|".$myrow1['dim2']."|".$myrow1['dim3']."|".$myrow1['noofpieces']."|".$myrow[5] ."|".$myrow[6] ?>"></td>
     <td width=8% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[0] ?></td>                            

<td width=8% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[5] ?></td>                                               
<td width=8% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>                           
<td width=8% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>                           
<td width=8% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>                           
<td width=8% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[6] ?></td>                           
<td width=8% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[4] ?></td>                           
</tr>
<?php } } } ?>
   

</table>
 </div>



<script language=javascript>
function SubmitCIM(etype) {
var flag=0;
 var user_input;

if(document.forms[0].wonum.length)
{
 var ind = document.forms[0].wonum.selectedIndex;
 for (i=0;i<document.forms[0].wonum.length;i++) {
  if (document.forms[0].wonum[i].checked) {
    user_input = document.forms[0].wonum[i].value;  
    flag=1;
  }
}
}
else if(document.forms[0].wonum.checked)
{
  user_input = document.forms[0].wonum.value;
  flag = 1;
}
if(flag == 0)
{
  alert('Please select appropriate WONUM before submitting');
  self.close();
}
//alert(user_input);
 window.opener.Set_woref(user_input,'',etype);
   self.close();

}
</script>

<input type=button value="Submit" onclick=" javascript: return SubmitCIM(window.name)">
</form>
</body>
</html>