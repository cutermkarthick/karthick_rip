<?php
//
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
include('classes/salesorderClass.php');
$newcrn4soli = new salesorder;
//$crn_num=$_REQUEST['crn_num'];
//echo $crn_num."here+++";
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>RM Master</title>
</head>
<body onload=self.focus()>

<form action='getcrn4soli.php' method='post' enctype='multipart/form-data'>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<table>
<tr><td><span class="pageheading"><b>RM Master</b></td></tr>
<tr><td>
<table style="table-layout: fixed" width=1200px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=5px  bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=8px  bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
            <td width=15px bgcolor="#EEEFEE"><span class="tabletext"><b>Part Num</b></td>
            <td width=15px bgcolor="#EEEFEE"><span class="tabletext"><b>Part Name</b></td>
            <td width=10px  bgcolor="#EEEFEE"><span class="tabletext"><b>RM<br>Type</b></td>
            <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>RM<br>Spec</b></td>
            <td width=20 bgcolor="#EEEFEE"><span  class="tabletext"><b>Condition</b></td>
            <td width=8px  bgcolor="#EEEFEE"><span class="tabletext"><b>UOM</b></td>
            <td width=8px  bgcolor="#EEEFEE"><span class="tabletext"><b>DIA</b></td>
            <td width=8px  bgcolor="#EEEFEE"><span class="heading"><b>Length</b></td>
            <td width=8px  bgcolor="#EEEFEE"><span class="heading"><b>Width</b></td>
            <td width=10px  bgcolor="#EEEFEE"><span class="heading"><b>Thickness</b></td>
            <td width=10  bgcolor="#EEEFEE"><span class="heading"><b>Grainflow</b></td>
            <td width=8  bgcolor="#EEEFEE"><span class="heading"><b>Max<br>Ruling</b></td>
            <td width=12  bgcolor="#EEEFEE"><span class="heading"><b>AltSpec</b></td>
         </tr>
</table>
<div style="width:1220px; height:270; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=1200px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php
      $result = $newcrn4soli->getCRN4soli();
      while ($myrow = mysql_fetch_assoc($result))
	  {
       $currency = array("$");
        $rm_price = str_replace($currency, "", $myrow['rm_unitprize']);
	    //echo "zero check---".$myrow['rm_qty_perbill']."<br>";
       if($myrow['rm_qty_perbill'] != 0 && $myrow['rm_qty_perbill'] != '' && $myrow['rm_qty_perbill'] != 'null')
        {
	      $rm_unitcost=$rm_price/$myrow['rm_qty_perbill'];
	    }
	    else
        {
	      $rm_unitcost=$rm_price;
	    }
	    //echo "<br>".number_format($rm_unitcost,2);
	    $unit_rm_cost=number_format($rm_unitcost,2);
        $rm_spec=htmlentities($myrow['rm_spec']);
        $crn_num=htmlentities($myrow['crnnum']);
        $partnum=htmlentities($myrow['partnum']);
        $partname=htmlentities($myrow['partname']);
        $rm_type=htmlentities($myrow['rm_type']);
        $rm_condition=htmlentities($myrow['rm_condition']);
        $rm_dia=htmlentities($myrow['rm_dia']);
        $width=htmlentities($myrow['width']);
        $thickness=htmlentities($myrow['thickness']);
        $length=htmlentities($myrow['length']);
        $rm_grainflow=htmlentities($myrow['rm_grainflow']);
        $rm_mrs=htmlentities($myrow['rm_mrs']);
        $rm_altrm=htmlentities($myrow['rm_altrm']);
        $drg_issue=htmlentities($myrow['drg_issue']);
        $attachments=htmlentities($myrow['attachments']);
        $cost=htmlentities($myrow['cost']);
	$rm_uom=htmlentities($myrow['rm_uom']);

	    //echo $unit_rm_cost;
 ?>
    <tr bgcolor="#FFFFFF">
                          <td width=5 bgcolor="#FFFFFF"><input type="radio" name="crn"   value="<?php echo $crn_num."|".$partnum."|".$partname."|".$rm_type."|".$rm_spec."|".$rm_condition."|".$rm_uom."|".$rm_dia."|".$length."|".$width."|".$thickness."|".$rm_grainflow."|".$rm_mrs."|".$rm_altrm."|".$drg_issue."|".$attachments."|".$cos."|".$unit_rm_cost ?>"></td>
	                      <td width=8 bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['crnnum'] ?></td>
                          <td width=15><span class="tabletext"><?php echo wordwrap($myrow['partnum'] ,10,"<br />\n",true)?></td>
                          <td width=15><span class="tabletext"><?php echo wordwrap($myrow['partname'],10,"<br />\n",true) ?></td>
                          <td width=10><span class="tabletext"><?php echo $myrow['rm_type'] ?></td>
                          <td width=10><span class="tabletext"><?php echo $myrow['rm_spec'] ?></td>
                          <td width=20><span class="tabletext"><?php echo wordwrap($myrow['rm_condition'],20,"<br />\n",true)?></td>
                          <td width=8><span class="tabletext"><?php echo $myrow['rm_uom'] ?></td>
                          <td width=8><span class="tabletext"><?php echo $myrow['rm_dia'] ?></td>
                          <td width=8><span class="tabletext"><?php echo $myrow['length'] ?></td>
                          <td width=8><span class="tabletext"><?php echo $myrow['width'] ?></td>
                          <td width=10><span class="tabletext"><?php echo $myrow['thickness'] ?></td>
                          <td width=10><span class="tabletext"><?php echo $myrow['rm_grainflow'] ?></td>
                          <td width=8><span class="tabletext"><?php echo $myrow['rm_mrs'] ?></td>
                          <td width=12><span class="tabletext"><?php echo $myrow['rm_altrm'] ?></td>
          </td></tr>
<?php
      }
?>
</table>
 </div>


<script language=javascript>
function SubmitCIM(etype){
 var flag=0;
 var user_input;
 //alert(document.forms[0].crn.length);
//alert(user_input);
//alert(etype);
if(document.forms[0].crn.length)
{
 for (i=0;i<document.forms[0].crn.length;i++) {
	if (document.forms[0].crn[i].checked) {
		user_input = document.forms[0].crn[i].value;
		flag=1;
	}
}
}
else if(document.forms[0].crn.checked)
{
  user_input = document.forms[0].crn.value;
  flag = 1;
}
if(flag == 0)
{
  alert('Please select appropriate PRN before submitting');
  self.close();
}
//alert("123"+etype);
window.opener.SetCIM(user_input,etype);
self.close();}


</script>

<input type=button value="Submit" onclick=" javascript: return SubmitCIM(window.name)">
</form>
</body>
</html>

