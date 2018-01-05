<?php
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
include('classes/assywoClass.php');
$newassywo = new assywo;
$crn=$_REQUEST['cim_refnum'];
$type=$_REQUEST['type'];
$crn_type=$_REQUEST['crn_type'];
$qty_wo=$_REQUEST['qty_wo'];
//echo $type;
if($type=='Assembly')
{
  $result = $newassywo->getwos4assycrnwo($crn);

}else
{
    $result = $newassywo->getwos4assywo($crn,$type,$crn_type);
}

?>

<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>Work Order(s)</title>
</head>
<body onload=self.focus()>

<form action='getallwo4assy.php' method='post' enctype='multipart/form-data'>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<table>
<tr><td><span class="pageheading"><b>Work Order</b></td></tr>
<tr><td>
<table style="table-layout: fixed" width=500px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=6px bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=8px bgcolor="#EEEFEE"><span class="tabletext"><b>WO #</b></td>
            <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
            <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>Avail Qty</b></td>
            <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>Dispatch Qty</b></td>
            <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>Qty Used<br>in Assy</b></td>
       </tr>
</table>
<div style="width:520px; height:300; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=500px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php

  while ($myrow = mysql_fetch_row($result))
  {
    // echo $myrow[0] . " " . $myrow[5]; 
    $flagw = 0 ;
	  $dncofcdets="Cofc # :".$myrow[4]." Supp WO# ".$myrow[5]." DN# ".$myrow[6];
    if($type != 'Assembly')
    {
      $result_disputd = $newassywo->getdisputd4treat($myrow[0],$myrow[5]);
      while($myrow_disp =  mysql_fetch_row($result_disputd))
      {
        $flagw = 1 ;
        $wonum       = $myrow_disp[1]  ;
        $compqty     = $myrow_disp[8]  ;
        $dispatchqty = $myrow_disp[9]  ;
        $assy_qty    = $myrow_disp[14]  ;
        $avail_qty = $compqty - $dispatchqty -$assy_qty;
      }
      $dnrecnum = $myrow[9];
      $cofcnum = $myrow[10];
    }
    else
    {
      $disputd = $myrow[8]+$myrow[9];
      $acc_qty = $myrow[7];
      $avail_qty=($acc_qty-$disputd);
      $dispatchval = $myrow[8];
      $assyqty = $myrow[9];
      $wonum = $myrow[0];
      $flagw = 1 ;

    }

  if($flagw == 1)
        {
          ?>
    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=6px><input type="radio" name="wo4assy"   id="wo4assy" value="<?php echo $myrow[0]."|".$myrow[3]."|".$dncofcdets."|".$myrow_disp[15]."|".$avail_qty."|".$dnrecnum . "|" . $cofcnum?>"></td>
                          <td width=8px><span class="tabletext"><?php echo $wonum ?></td>
                          <td width=10px><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td width=10px><span class="tabletext"><?php echo $avail_qty; ?></td>
                          <td width=10px><span class="tabletext"><?php echo $dispatchqty ?></td>
                          <td width=10px><span class="tabletext"><?php echo $assy_qty ?></td>

             </tr>

<?php
}     
     } 
    
?>

</table>
 </div>



<script language=javascript>
function SubmitWO(etype){
 var flag=0;
 var user_input;
 //alert(document.forms[0].wo4assy.length);
//alert(user_input);
//alert(etype);
if(document.forms[0].wo4assy.length)
{
 for (i=0;i<document.forms[0].wo4assy.length;i++) {
	if (document.forms[0].wo4assy[i].checked) {
		user_input = document.forms[0].wo4assy[i].value;
		flag=1;
	}
}
}
else if(document.forms[0].wo4assy.checked)
{
  user_input = document.forms[0].wo4assy.value;
  flag = 1;
}
if(flag == 0)
{
  alert('Please select appropriate WO before submitting');
  self.close();
}
//alert(user_input);
window.opener.SetWo4assy(user_input,etype);
self.close();}


</script>

<input type=button value="Submit" onclick=" javascript: return SubmitWO(window.name)">
</form>

</html>
