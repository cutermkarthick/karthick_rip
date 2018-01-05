<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: getRM.php                         =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Popup for selecting RM                      =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$crn = $_REQUEST['crn'];
$companyrecnum = $_REQUEST['crecnum'];
$type = $_REQUEST['type'];

include('classes/dispatchliClass.php');
$newdli = new dispatch_line_items;
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>All Dispatches</title>
</head>
<body onload=self.focus()>

<form action='getwo4dc.php' method='post' enctype='multipart/form-data'>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >

<table>
<tr><td><span class="pageheading"><b>Dispatch</b></td></tr>
<tr><td>
<?php
      if($type != 'Treated')
	  {?>
	<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=5% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=6% bgcolor="#EEEFEE"><span class="tabletext"><b>WO#</b></td>
            <td width=18% bgcolor="#EEEFEE"><span class="tabletext"><b>Part #</b></td>
            <td width=7% bgcolor="#EEEFEE"><span class="tabletext"><b>GRN Num</b></td>
            <td width=12% bgcolor="#EEEFEE"><span class="tabletext"><b>Cust<br>PO Num</b></td>
            <td width=5% bgcolor="#EEEFEE"><span class="tabletext"><b>PO Qty</b></td>
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>WO Comp <br> Date</b></td>
            <td width=4% bgcolor="#EEEFEE"><span class="tabletext"><b>WO<br>Qty</b></td>
            <td width=4% bgcolor="#EEEFEE"><span class="tabletext"><b>Acc<br>Qty</b></td>
            <td width=7% bgcolor="#EEEFEE"><span class="tabletext"><b>Dispatch<br>UTD</b></td>
            <td width=23% bgcolor="#EEEFEE"><span class="tabletext"><b>Company</b></td>
       </tr>
</table>
<div style="width:987px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?
      if ($type == 'Untreated')
	  {
		         $result = $newdli->getwos4dispatch($crn,$companyrecnum);
      }
	  else if ($type == 'Assembly')
	  {
		         $result = $newdli->getWoforassy($crn,$companyrecnum);

      }
       else if ($type == 'Kit' )
	  {
		         $result = $newdli->getWoforassy4kit($crn,$companyrecnum);

      }
   /*   else if ($type == 'Manufacture for Assembly')
	  {
		    $result = $newdli->getassymfrwos4dispatch($crn,$companyrecnum);
	  }*/
  /*  else if ($type == 'Treated')
    {
        $result = $newdli->getWo4post($crn,$companyrecnum);
    }*/

       while ($myrow = mysql_fetch_row($result)) {
   


?>

    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=5%><input type="radio" name="dispatch"   value="<?php echo $myrow[1]."|".$myrow[2]."|".$myrow[3]."|".$myrow[4]."|".$myrow[5]."|".$myrow[6]."|".$myrow[7]."|".$myrow[8]."|".$myrow[9]."|".$myrow[10]."|".$myrow[11]."|".$myrow[12]."|".$myrow[13]."|".$myrow[14]."|".$myrow[15]."|".$myrow[16]."|".$myrow[17]."|" .$myrow[19]."|".$myrow[20]."|".$myrow[21]?>"></td>
	<td width=6% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
                          <td width=18%><span class="tabletext"><?php echo $myrow[2] ?></td>
                          <td width=7%><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td width=12%><span class="tabletext"><?php echo wordwrap($myrow[4],10,"<br/>\n",true) ?></td>
                          <td width=5%><span class="tabletext"><?php echo $myrow[5] ?></td>
                          <td width=8%><span class="tabletext"><?php echo $myrow[6] ?></td>
                          <td width=4%><span class="tabletext"><?php echo $myrow[7] ?></td>
                          <td width=4%><span class="tabletext"><?php echo $myrow[8] ?></td>
                          <td width=7%><span class="tabletext"><?php echo $myrow[9] ?></td>
                          <td width=23%><span class="tabletext"><?php echo wordwrap($myrow[10],10,"<br/>\n",true) ?></td>

              </td></tr>
<?php
        }
	  }else if($type == "Treated")
    {

      ?>
<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=5% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=6% bgcolor="#EEEFEE"><span class="tabletext"><b>WO#</b></td>
            <td width=18% bgcolor="#EEEFEE"><span class="tabletext"><b>Part #</b></td>
            <td width=7% bgcolor="#EEEFEE"><span class="tabletext"><b>GRN Num</b></td>
            <td width=12% bgcolor="#EEEFEE"><span class="tabletext"><b>Cust<br>PO Num</b></td>
            <td width=5% bgcolor="#EEEFEE"><span class="tabletext"><b>PO Qty</b></td>
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>WO Comp <br> Date</b></td>
            <td width=4% bgcolor="#EEEFEE"><span class="tabletext"><b>WO<br>Qty</b></td>
            <td width=4% bgcolor="#EEEFEE"><span class="tabletext"><b>Acc<br>Qty</b></td>
            <td width=7% bgcolor="#EEEFEE"><span class="tabletext"><b>Dispatch<br>UTD</b></td>
            <td width=23% bgcolor="#EEEFEE"><span class="tabletext"><b>Company</b></td>
       </tr>
</table>
<div style="width:987px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php


$result = $newdli->getWo4post($crn,$companyrecnum);

while ($myrow = mysql_fetch_row($result)) {
  ?>
    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=5%><input type="radio" name="dispatch"   value="<?php echo $myrow[1]."|".$myrow[2]."|".$myrow[3]."|".$myrow[4]."|".$myrow[5]."|".$myrow[6]."|".$myrow[7]."|".$myrow[8]."|".$myrow[9]."|".$myrow[10]."|".$myrow[11]."|".$myrow[12]."|".$myrow[13]."|".$myrow[14]."|".$myrow[15]."|".$myrow[16]."|".$myrow[17]."|" .$myrow[19]."|".$myrow[20]."|".$myrow[21]?>"></td>
  <td width=6% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
                          <td width=18%><span class="tabletext"><?php echo $myrow[2] ?></td>
                          <td width=7%><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td width=12%><span class="tabletext"><?php echo wordwrap($myrow[4],10,"<br/>\n",true) ?></td>
                          <td width=5%><span class="tabletext"><?php echo $myrow[5] ?></td>
                          <td width=8%><span class="tabletext"><?php echo $myrow[6] ?></td>
                          <td width=4%><span class="tabletext"><?php echo $myrow[7] ?></td>
                          <td width=4%><span class="tabletext"><?php echo $myrow[8] ?></td>
                          <td width=7%><span class="tabletext"><?php echo $myrow[9] ?></td>
                          <td width=23%><span class="tabletext"><?php echo wordwrap($myrow[10],10,"<br/>\n",true) ?></td>

              </td></tr>
<?
} 
}
 else
 {  ?>
	   <table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr bgcolor="#FFCC00">
            <td width=5% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=5% bgcolor="#EEEFEE"><span class="tabletext"><b>WO#</b></td>
			<td width=6% bgcolor="#EEEFEE"><span class="tabletext"><b>Supplier<br>WO#</b></td>
            <td width=13% bgcolor="#EEEFEE"><span class="tabletext"><b>Part #</b></td>
            <td width=7% bgcolor="#EEEFEE"><span class="tabletext"><b>GRN Num</b></td>
            <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Cust<br>PO Num</b></td>
            <td width=5% bgcolor="#EEEFEE"><span class="tabletext"><b>PO Qty</b></td>
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>WO Comp<br>Date</b></td>
            <td width=3% bgcolor="#EEEFEE"><span class="tabletext"><b>WO<br>Qty</b></td>
            <td width=3% bgcolor="#EEEFEE"><span class="tabletext"><b>Acc<br>Qty</b></td>
            <td width=6% bgcolor="#EEEFEE"><span class="tabletext"><b>Dispatch<br>UTD</b></td>
            <td width=15% bgcolor="#EEEFEE"><span class="tabletext"><b>Company</b></td>
       </tr>
</table>
<div style="width:987px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?

	   $result = $newdli->getwos4treat($crn,$companyrecnum);
       while ($myrow = mysql_fetch_row($result)) {


       $disputd = '';
       $result_disputd = $newdli->getdisputd4treat($myrow[1],$myrow[18]);
       $myrow_disp =  mysql_fetch_row($result_disputd);
       $disputd = $myrow_disp[9];
       if($disputd == '')
       {
         $disputd = 0;
       }
	   $acc_qty=($myrow[19] - $myrow[21]);	
	   $remain_qty=($acc_qty-$disputd);
	   if($remain_qty>0)
	   { 
?>      
       
		<tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=5%><input type="radio" name="dispatch"   value="<?php echo $myrow[1]."|".$myrow[2]."|".$myrow[3]."|".$myrow[4]."|".$myrow[5]."|".$myrow[6]."|".$myrow[7]."|".$myrow[19]."|".$disputd."|".$myrow[10]."|".$myrow[11]."|".$myrow[12]."|".$myrow[13]."|".$myrow[14]."|".$myrow[15]."|".$myrow[16]."|".$myrow[17]."|".$myrow[18]."|".$myrow[20]?>"></td>
						  <td width=5% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
						  <td width=6%><span class="tabletext"><?php echo wordwrap($myrow[18],8,"<br/>\n",true)?></td>
                          <td width=13%><span class="tabletext"><?php echo $myrow[2] ?></td>
                          <td width=7%><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td width=10%><span class="tabletext"><?php echo wordwrap($myrow[4],12,"<br/>\n",true) ?></td>
                          <td width=5%><span class="tabletext"><?php echo $myrow[5] ?></td>
                          <td width=8%><span class="tabletext"><?php echo $myrow[6] ?></td>
                          <td width=3%><span class="tabletext"><?php echo $myrow[7] ?></td>
                          <td width=3%><span class="tabletext"><?php echo ($myrow[19] - $myrow[21])?></td>
                          <td width=6%><span class="tabletext"><?php echo $disputd ?></td>
                          <td width=15%><span class="tabletext"><?php echo wordwrap($myrow[10],10,"<br/>\n",true) ?></td>

        </td></tr>
<?php
        }
	   }
	  }
?>

</table>
 </div>

<script language=javascript>
function SubmitCIM(ctype){
 var flag=0;
 var user_input;
 //alert(document.forms[0].dispatch.length);
//alert(user_input);
//alert(ctype);
if(document.forms[0].dispatch.length)
{
 for (i=0;i<document.forms[0].dispatch.length;i++) {
	if (document.forms[0].dispatch[i].checked) {
		user_input = document.forms[0].dispatch[i].value;
		flag=1;
	}
}
}
else if(document.forms[0].dispatch.checked)
{
  user_input = document.forms[0].dispatch.value;
  flag = 1;
}
if(flag == 0)
{
  alert('Please select appropriate WO# before submitting');
  self.close();
}
window.opener.Setwo4dc(user_input,ctype);
self.close();


}

</script>

<input type=button value="Submit" onclick=" javascript: return SubmitCIM(window.name)">
</form>
</body>
</html>

