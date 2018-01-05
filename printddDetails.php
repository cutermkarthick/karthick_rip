<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr  bgcolor="#DDDEDD"><td colspan=13>
<table border=1 bgcolor="#000000" width=100% cellspacing=1 cellpadding=4>
        <tr class="bgcolor1">
            <td colspan=12><span class="heading"><center><b>Dispatch Details</b></center></td>
        </tr>
<tr class="bgcolor1">
<td><span class="heading"><b><center>Line No.</center></b></td>
<td><span class="heading"><b><center>PO No.</center></b></td>
<td><span class="heading"><b><center>Comp Sl No</center></b></td>
<td><span class="heading"><b><center>Batch No.</center></b></td>
<td><span class="heading"><b><center>Qty</center></b></td>
<td><span class="heading"><b><center>RM Gate Pass No.</center></b></td>
<td><span class="heading"><b><center>RM Gate Pass Date</center></b></td>
<td><span class="heading"><b><center>Our D.C No</center></b></td>
<td><span class="heading"><b><center>Our D.C date</center></b></td>
<td><span class="heading"><b><center>INSPN report</center></b></td>
<td><span class="heading"><b><center>Insp Approval</center></b></td>
<td><span class="heading"><b><center>QC Head Approval</center></b></td>
</tr>

<?php
       $i = 0;
          $resultdd = $newdd->getdisp_det($worecnum);
	while ($mydd = mysql_fetch_row($resultdd))
	{
           if($mydd["7"] != '0000-00-00' && $mydd["7"] != '' && $mydd["7"] != NULL)
           {
            $d=substr($mydd["7"],8,2);
            $m=substr($mydd["7"],5,2);
            $y=substr($mydd["7"],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date1=date("M j, Y",$x);
           }
           else
           {
             $date1 = '';
           }

           if($mydd["9"] != '0000-00-00' && $mydd["9"] != '' && $mydd["9"] != NULL)
           {
            $d=substr($mydd["9"],8,2);
            $m=substr($mydd["9"],5,2);
            $y=substr($mydd["9"],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date2=date("M j, Y",$x);
           }
           else
           {
             $date2 = '';
           }

    printf('<tr class="bgcolor1"">
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
        $mydd[1],$mydd[2],$mydd[3],$mydd[4],$mydd[5],$mydd[6],
        $date1,$mydd[8],$date2,$mydd[10],$mydd[11],$mydd[12]);
	         printf('</tr>');
     $i++;
	}

   while ($i < 5) {
    printf('<tr><td><span class="tabletext">&nbsp</td>
	        <td><span class="tabletext">&nbsp</td>
	        <td><span class="tabletext">&nbsp</td>
	        <td><span class="tabletext">&nbsp</td>
            <td><span class="tabletext">&nbsp</td>
	        <td><span class="tabletext">&nbsp</td>
	        <td><span class="tabletext">&nbsp</td>
            <td><span class="tabletext">&nbsp</td>
            <td><span class="tabletext">&nbsp</td>
	        <td><span class="tabletext">&nbsp</td>
            <td><span class="tabletext">&nbsp</td>
            <td><span class="tabletext">&nbsp</td></tr>');
     $i++;

   }
?>
</table>
</td></tr>
