<?
include_once('classes/reportClass.php');
$newreport = new report;
$crn=$_REQUEST['crn'];
$result3 = $newreport->getCRNNo($crn,'Regular');
?>
<div id="grnQty">
 <table width="70px" align="center" style="border:1px solid #000000;" cellpadding=4 cellspacing=2 border=1 rules=all class="stdtable">
 <tr bgcolor="#F5F6F5">
 <thead>
 <td align="center" colspan=2><span class="pageheading"><b>GRN Details</b></td>
 <td align="center"><a href="javascript:hidegrndetails('<?php echo $crn ?>')"><img src="images/Arrow-double-up.png" alt="Hide Details" border=0></a></td>
 </tr>
 <tr>
 <th class="head0"><span class="tabletext"><b>GRN #</b></th>
 <th class="head1"><span class="tabletext"><b>Qty Make</b></th>
 <th class="head0"><span class="tabletext"><b>Available <br>Qty</b></th>
 </tr>
 <?
 while($myrow4CRN = mysql_fetch_row($result3))
 {
 $result2 = $newreport->getallGRN4Details($crn,$myrow4CRN[0],$myrow4CRN[1],'Regular');
 while($myrow4grn = mysql_fetch_row($result2))
 {
 
 ?>
 <td><span class="tabletext"><?echo $myrow4CRN[0];?></td>
 <td><span class="tabletext"><?echo $myrow4grn[1];?></td>
 <td><span class="tabletext"><?echo $myrow4grn[2] ;?></td>
 </tr>
 <?

 }
}?>
</table>
</div>

