<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr  bgcolor="#DDDEDD"><td colspan=13>
<table border=1 bgcolor="#000000" width=100% cellspacing=1 cellpadding=4>
        <tr class="bgcolor2">
            <td colspan=14><span class="heading"><center><b>Material Movement Details</b></center></td>
        </tr>

        <tr class="bgcolor2">
<td><span class="heading"><b><center>Sl.No</center></b></td>
<td><span class="heading"><b><center>Qty Drawn</center></b></td>
<td><span class="heading"><b><center>Drown By</center></b></td>
<td><span class="heading"><b><center>Drawn Date</center></b></td>
<td><span class="heading"><b><center>Issued By</center></b></td>
<td><span class="heading"><b><center>Issued Date</center></b></td>
<td colspan=2><span class="heading"><b><center>Recd By</center></b></td>
<td><span class="heading"><b><center>From Sl.No</center></b></td>
<td><span class="heading"><b><center>To Sl.No</center></b></td>
<td><span class="heading"><b><center>Accepted</center></b></td>
<td><span class="heading"><b><center>Rejected</center></b></td>
<td><span class="heading"><b><center>Returned</center></b></td>
<td><span class="heading"><b><center>Notes</center></b></td>
</tr>

<?php
    $resultmm = $newmm->getmm($worecnum);
	while ($mymm = mysql_fetch_row($resultmm))
	{

      if($mymm[12] != '0000-00-00' && $mymm[12] != '' && $mymm[12] != 'NULL')
      {
       $d=substr($mymm[12],8,2);
       $m=substr($mymm[12],5,2);
       $y=substr($mymm[12],0,4);
       $x=mktime(0,0,0,$m,$d,$y);
       $date1=date("M j, Y",$x);
      }
      else
      {
        $date1 = '';
      }

      if($mymm[13] != '0000-00-00' && $mymm[13] != '' && $mymm[13] != 'NULL')
      {
       $d=substr($mymm[13],8,2);
       $m=substr($mymm[13],5,2);
       $y=substr($mymm[13],0,4);
       $x=mktime(0,0,0,$m,$d,$y);
       $date2=date("M j, Y",$x);
      }
      else
      {
        $date2 = '';
      }
	
      printf('<tr class="bgcolor2">
            <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
            <td colspan=2><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>
	        <td><span class="tabletext">%s</td>',
        $mymm[0],$mymm[1],$mymm[2],$date1,$mymm[3],$date2,$mymm[4],$mymm[5],
        $mymm[6],$mymm[7],$mymm[8],$mymm[9],$mymm[10]);
	         printf('</tr>');
	}
?>

</table>
</td></tr>
