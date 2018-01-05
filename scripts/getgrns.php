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
include('classes/grnclass.php');
$newgrn = new grn;

$rm_type = $_REQUEST['rm_type'];
$rm_spec = $_REQUEST['rm_spec'];
$crn = $_REQUEST['crn'];
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
   $result = $newgrn->getallgrns($crn);
?>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<table>
<tr><td><span class="pageheading"><b>CIM</b></td></tr>
<tr><td>
<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=5% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>GRN</b></td>
            <td width=20% bgcolor="#EEEFEE"><span class="tabletext"><b>Batch Num</b></td>
            <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Qty</b></td>
			 <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Received<br/> Date</b></td>
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
            <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Raw Mat<br/>  Type</b></td>
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>Raw Mat<br/>  Spec</b></td>
            <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>GRN Type</b></td>		
       </tr>
</table>
<div style="width:987px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php
      $i=0;
   while ($myrow = mysql_fetch_row($result))
   {
        $ret_qty = 0;
                     $retqtyres = $newgrn->get_woretqty($myrow[1]);
                     $total=0;
                     $retqtyrow = mysql_fetch_row($retqtyres);
                     $ret_qty = $retqtyrow[1];
                     $grnnum = "'" . $myrow[1] . "'";					
                     $grnli = $newgrn->getgrnli($myrow[0]);					

                 while($myrowli = mysql_fetch_row($grnli))
                 {
                 if($myrowli[17] =='')
                 {
                  $total = $total + $myrowli[9];                  
                  }
                 }

                     if (isset($grnarr[$grnnum])) 
                     {
                        $qty = $total - $grnarr[$grnnum] + $ret_qty;						
                     }
                     else 
                     {
                        $qty = $total;                  
                     }					 
                     if ($qty > 0)
	                 {
						 if($flag ==0)
						 {
							 $older_grn=$myrow[1];
							 $flag=1;
						 }
						 $received_date=date('M d,Y',strtotime($myrow[8]));
?>
    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=5%><input type="radio" name="grn"   
	value="<?php echo $myrow[1] ."|".$myrow[2]."|".$qty."|".$myrow[4]."|".$myrow[5]."|".$myrow[6]."|".$myrow[7]?>"></td>
	      <td width=8% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
                          <td width=20%><span class="tabletext"><?php echo $myrow[2] ?></td>
                          <td width=10%><span class="tabletext"><?php echo $qty ?></td>
						   <td width=10%><span class="tabletext"><?php echo $received_date ?></td>
                          <td width=8%><span class="tabletext"><?php echo $myrow[4] ?></td>
                          <td width=10%><span class="tabletext"><?php echo $myrow[5] ?></td>
                          <td width=8%><span class="tabletext"><?php echo $myrow[6] ?></td>
                          <td width=10%><span class="tabletext"><?php echo $myrow[7] ?></td>						
       </td></tr>
	   <input type='hidden' name='recnum_<?=$i?>' id='recnum_<?=$i?>' value='<?=$myrow[0]?>'>
<?php
$i++;
      }

   }
?>
 </td>
 </tr>
<input type='hidden' name='check' id='check' value='<?=$older_grn?>'>
</table>
 </div>

<script language=javascript>
function SubmitGRN(etype){
 var flag=0;
 var user_input;
if(document.forms[0].grn.length)
{
 for (i=0;i<document.forms[0].grn.length;i++) {
	if (document.forms[0].grn[i].checked) {
		user_input = document.forms[0].grn[i].value;
		grnrecnum = document.getElementById('recnum_'+i).value;
		flag=1;
	}
}
}
else if(document.forms[0].grn.checked)
{
  user_input = document.forms[0].grn.value;
  flag = 1;
}
if(flag == 0)
{
  alert('Please select appropriate CRN before submitting');
  self.close();
}
//alert(user_input);
//window.opener.SetCIM(user_input,etype);


var older_grn = document.forms[0].check.value;
//window.opener.Setgrn(user_input,grnrecnum,older_grn);
window.opener.Setgrn(user_input,grnrecnum);
self.close();}
</script>
<input type=button value="Submit" onclick=" javascript: return SubmitGRN(window.name)">
</form>
</body>
</html>

