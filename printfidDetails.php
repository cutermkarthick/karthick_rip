<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 rules=all>

<tr  bgcolor="#DDDEDD"><td colspan=13>
<table border=1 bgcolor="#000000" width=100% cellspacing=1 cellpadding=4>
        <tr class="bgcolor2">
            <td colspan=13><span class="heading"><center><b>Final Inspection and Dispatch Details</b></center></td>
        </tr>
        <tr class="bgcolor2">
<td><span class="heading"><b><center>Sl.No</center></b></td>
<td><span class="heading"><b><center>Qty. Recd. for Final Inspection</center></b></td>
<td><span class="heading"><b><center>Qty Accp.</center></b></td>
<td colspan=2><span class="heading"><b><center>CIM DC No.</center></b></td>
<td><span class="heading"><b><center>CIM DC Date</center></b></td>
<td colspan=2><span class="heading"><b><center>DC Qty.</center></b></td>
<td><span class="heading"><b><center>Inspection Report No.</center></b></td>
<td colspan=2><span class="heading"><b><center>Any Information from Customer</center></b></td>
<td colspan=2><span class="heading"><b><center>Remarks</center></b></td>
</tr>

<?php
   $i = 0;
   $resultfid = $newfid->getfid($worecnum);
   while ($myfid = mysql_fetch_row($resultfid))
   {
     if($myfid["9"] != '0000-00-00' && $myfid["9"] != '' && $myfid["9"] != NULL)
     {
      $d=substr($myfid["9"],8,2);
      $m=substr($myfid["9"],5,2);
      $y=substr($myfid["9"],0,4);
      $x=mktime(0,0,0,$m,$d,$y);
      $date1=date("M j, Y",$x);
     }
     else
     {
       $date1 = '';
     }

      printf('<tr class="bgcolor2">
            <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td colspan=2><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
            <td colspan=2><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td colspan=2><span class="tabletext">%s</td>
            <td colspan=2><span class="tabletext">%s</td>',
        $myfid[0],$myfid[1],$myfid[2],$myfid[3],$date1,$myfid[4],$myfid[5],
        $myfid[6],$myfid[7]);
	         printf('</tr>');
     $i++;
  }
  while ($i < 5) {
      printf('<tr><td><span class="tabletext">&nbsp</td>
	        <td><span class="tabletext">&nbsp</td>
	        <td><span class="tabletext">&nbsp</td>
	        <td colspan=2><span class="tabletext">&nbsp</td>
	        <td><span class="tabletext">&nbsp</td>
            <td colspan=2><span class="tabletext">&nbsp</td>
	        <td><span class="tabletext">&nbsp</td>
	        <td colspan=2><span class="tabletext">&nbsp</td>
            <td colspan=2><span class="tabletext">&nbsp</td></tr>');
      $i++;
}
?>

</table>
</td></tr>
