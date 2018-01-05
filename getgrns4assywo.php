<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 17, 2013                =
// Filename: getgrn4assywo.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Popup for selecting GRN                     =
//==============================================

session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
include('classes/assywoClass.php');
$newassywo = new assywo;
$partnum=$_REQUEST['partnum'];
$type=$_REQUEST['type'];

$result = $newassywo->getgrns4assywo($partnum);
   $grnarr = array();
   $result1 = $newassywo->getassywoqty4grn();
   while ($myrow = mysql_fetch_row($result1)) 
   {
        $grnnum = "'" . $myrow[0] . "'";
        $grnarr[$grnnum] = $myrow[1];
   }
   $pattern="/[$&*\"\'\/\\-\\s\;\,\:#!.,+]/";
//print_r($grnarr);
 if($type=='Consummables')
 {
   $result_type = $newassywo->getallgrns4cons($type);
 }
 else
 {
 $result_part = $newassywo->getallgrns4assy($partnum);
 }
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>All GRN's</title>
</head>
<body onload=self.focus()>
<form>

<table width=100% border=0	 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td><span class="pageheading"><b>GRN</b></td></tr>
<tr><td>
	<table style="table-layout: fixed" width=800px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
        <td width=6% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
        <td width=7% bgcolor="#EEEFEE"><span class="tabletext"><b>GRN</b></td>
        <td width=12% bgcolor="#EEEFEE"><span class="tabletext"><b>Batch<br>#</b></td>
        <td width=7% bgcolor="#EEEFEE"><span class="tabletext"><b>Qty</b></td>
        <td width=7% bgcolor="#EEEFEE"><span class="tabletext"><b>PRN<br>Num</b></td>
        <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>Raw Mat<br>Type</b></td>
        <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>Raw Mat<br>Spec</b></td>
        <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Expiry<br>Date</b></td>
       </tr>
</table>
<div style="width:820px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=800px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?
        if($type !='Consummables')
               {
                 while ($myrow = mysql_fetch_row($result_part) )
                  {					 

					  if($myrow[9] !='0000-00-00')
						 {
						 $exp_date=date('M d,Y',strtotime($myrow[9]));

             
						 }
						 else
						 {
						  $exp_date='';
						 }
           
					 $part_num =(preg_replace($pattern,"", $_REQUEST['partnum']));
           $partnumber=(preg_replace($pattern,"", $myrow[7]));

           

                  // echo $myrow[8]."*--*-**-*-$part_num ---- $partnumber<br>";
                  if(($part_num == $partnumber))
                  {
                     $ret_qty = 0;
                     $retqtyres = $newassywo->get_woretqty($myrow[1]);
                     $total=0; $i=0;
                     $retqtyrow = mysql_fetch_row($retqtyres);
                     $ret_qty = $retqtyrow[1];
                     $grnnum = "'" . $myrow[1] . "'";
                     $grnli = $newassywo->getgrnli($myrow[0]);

                 while($myrowli = mysql_fetch_row($grnli))
                 {
                   if($myrowli[17] =='')
                 {

                  $total = $total + $myrowli[9];
                  //echo"---------------<br>" .$total."----------------<br>".$myrowli[9];
                  }
                 }

                     if (isset($grnarr[$grnnum]))
                     {
                        $qty = $total - $grnarr[$grnnum] + $ret_qty;
                        //echo $qty."------------";
                     }
                     else
                     {
                        $qty = $total;
                        //echo $qty."****************";
                     }

                     // echo "qty $qty <br>";

                    

                     // echo $qty;exit;
					 if ($qty > 0)
	                 {
?>

    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=6%><input type="radio" id="crn"  name="crn"   value="<?php echo $myrow[1] . "|" . $myrow[2] . "|" . $qty . "|" . $myrow[4]. "|" . $myrow[5]. "|" . $myrow[6]. "|" . $myrow[9] ?>"></td>
	<td width=7% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
    <td width=12%><span class="tabletext"><?php echo $myrow[2] ?></td>
    <td width=7%><span class="tabletext"><?php echo $qty ?></td>
    <td width=7%><span class="tabletext"><?php echo wordwrap($myrow[4],10,"<br>\n",true) ?></td>
    <td width=8%><span class="tabletext"><?php echo wordwrap($myrow[5],10,"<br>\n",true) ?></td>
     <td width=8%><span class="tabletext"><?php echo wordwrap($myrow[6],8,"<br>\n",true) ?></td>
     <td width=10%><span class="tabletext"><?php echo $exp_date ?></td>
      </tr>
<?php
        }
	 }
                  }
                  }
                  else
                  {
                  while ($myrow = mysql_fetch_row($result_type) )
                  {
                  //echo $myrow[8]."2222----";


                
                   $part_num =(preg_replace($pattern,"", $_REQUEST['partnum']));
                   $partnumber=(preg_replace($pattern,"", $myrow[7]));
                   //echo $myrow[8]."*--*-**-*-";
                  //if(($part_num == $partnumber))
                  //{



                     $ret_qty = 0;
                     $retqtyres = $newassywo->get_woretqty($myrow[1]);
                     $total=0; $i=0;
                     $retqtyrow = mysql_fetch_row($retqtyres);
                     $ret_qty = $retqtyrow[1];
                     $grnnum = "'" . $myrow[1] . "'";
                     $grnli = $newassywo->getgrnli($myrow[0]);

                 while($myrowli = mysql_fetch_row($grnli))
                 {
                   if($myrowli[17] =='')
                 {

                  $total = $total + $myrowli[9];
                  //echo"---------------<br>" .$total."----------------<br>".$myrowli[9];
                  }
                 }

                     if (isset($grnarr[$grnnum]))
                     {
                        $qty = $total - $grnarr[$grnnum] + $ret_qty;
                        //echo $qty."------------";
                     }
                     else
                     {
                        $qty = $total;
                        //echo $qty."****************";
                     }
                     if ($qty > 0)
	                 {
						 if($myrow[8] !='0000-00-00')
						 {
						 $exp_date=date('M d,Y',strtotime($myrow[8]));
						 }
						 else
						 {
						  $exp_date='';
						 }
						 ?>
						 <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=6%><input type="radio" id="crn"  name="crn"   value="<?php echo $myrow[1] . "|" . $myrow[2] . "|" . $qty . "|" . $myrow[4]. "|" . $myrow[5]. "|" . $myrow[6]. "|" . $myrow[8]  ?>"></td>
	<td width=7% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
    <td width=12%><span class="tabletext"><?php echo $myrow[2] ?></td>
    <td width=7%><span class="tabletext"><?php echo $qty ?></td>
    <td width=7%><span class="tabletext"><?php echo wordwrap($myrow[4],10,"<br>\n",true) ?></td>
    <td width=8%><span class="tabletext"><?php echo wordwrap($myrow[5],10,"<br>\n",true) ?></td>
     <td width=5%><span class="tabletext"><?php echo wordwrap($myrow[6],8,"<br>\n",true) ?></td>
     <td width=10%><span class="tabletext"><?php echo $exp_date ?></td>

      </tr>
 <?}
}
}
?>
</table>

 </div>
<script language=javascript>
function Submitgrn(etype) {
var flag=0;
 var user_input;
 //alert(document.forms[0].crn.length);
//alert(user_input);
//alert(ctype);
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
  alert('Please select appropriate CRN before submitting');
  self.close();
}
window.opener.SetGRN(user_input,'',etype);
self.close();
}
</script>
</table>
<br/>
<input type=button value="Submit" onclick="javascript: return Submitgrn(window.name)">
</form>
</html>