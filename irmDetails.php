<tr  bgcolor="#DDDEDD"><td colspan=13>
<table border=1 bgcolor="#000000" width=100% cellspacing=1 cellpadding=4 rules='all'>
        <tr class="bgcolor1">
            <td colspan=13><span class="heading"><center><b>Incoming Raw Material Details</b></center></td>
        </tr>
        <tr class="bgcolor1">
<td rowspan=2><span class="heading"><b><center>Sl.No</center></b></td>
<td rowspan=2><span class="heading"><b><center>Purchase Order<br>Number</center></b></td>
<td rowspan=2><span class="heading"><b><center>PO Qty.</center></b></td>
<td rowspan=2><span class="heading"><b><center>MGP/DC No.</center></b></td>
<td rowspan=2><span class="heading"><b><center>MGP/DC Date</center></b></td>
<td colspan=4><span class="heading"><b><center>Received RM Dimensions</center></b></td>
<td rowspan=2><span class="heading"><b><center>Qty. to make</center></b></td>
<td rowspan=2><span class="heading"><b><center>Customer Batch<br>Number</center></b></td>
<td rowspan=2><span class="heading"><b><center>Customer WO Number</center></b></td>
<td rowspan=2><span class="heading"><b><center>RM Inspected by and<br>Remarks if any</center></b></td>
</tr>

<tr class="bgcolor1">
<td ><span class="heading"><b><center>Dim1</center></b></td>
<td ><span class="heading"><b><center>Dim2</center></b></td>
<td ><span class="heading"><b><center>Dim3</center></b></td>
<td><span class="heading"><b><center>Qty.</center></b></td>
</tr>

<?php

          $resultirm = $newirm->getirm($worecnum);
	while($myirm = mysql_fetch_row($resultirm))
	{

     if($myirm["13"] != '0000-00-00' && $myirm["13"] != '' && $myirm["13"] != 'NULL')
     {
      $d=substr($myirm["13"],8,2);
      $m=substr($myirm["13"],5,2);
      $y=substr($myirm["13"],0,4);
      $x=mktime(0,0,0,$m,$d,$y);
      $date1=date("M j, Y",$x);
     }
     else
     {
      $date1 = '';
     }
	
      printf('<tr class="bgcolor1">
            <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
            <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>',
        $myirm[0],$myirm[1],$myirm[2],$myirm[3],$date1,$myirm[4],$myirm[5],
        $myirm[6],$myirm[7],$myirm[8],$myirm[9],$myirm[10],$myirm[11]);
	         printf('</tr>');
	}
?>

</table>
</td>
