<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable1">

<tr  bgcolor="#DDDEDD">
<thead>
<td colspan=20>
<table border=1 bgcolor="#000000" width=100% cellspacing=1 cellpadding=4 class="stdtable">
        <tr class="bgcolor2">
            <td colspan=20><span class="heading"><center><b>Part Status</b></center></td>
        </tr>

<tr>

<th class="head0"><span class="heading" width="4%" ><b><center> Seq</center></b></th>
<th class="head1"><span class="heading" width="4%"><b><center>Stage</center></b></th>
<th class="head0"><span class="heading" width="4%"><b><center>From Sl.No</center></b></th>
<th class="head1"><span class="heading" width="4%"><b><center>To Sl.No</center></b></th>
<th class="head1"><span class="heading" width="4%"><b><center>Sampling<br>Sl.No.</center></b></th>
<th class="head0"><span class="heading" width="4%"><b><center>Accept</center></b></th>
<th class="head1"><span class="heading" width="4%"><b><center>Rework</center></b></th>
<th class="head0"><span class="heading" width="4%"><b><center>Reject</center></b></th>
<th class="head1"><span class="heading" width="4%"><b><center>NC</center></b></th>
<th class="head0"><span class="heading" width="4%"><b><center>Returns</center></b></th>
<th class="head1"><span class="heading" width="4%"><b><center>Hold</center></b></th>
<th class="head0"><span class="heading" width="10%"><b><center>Date</center></b></th>
<th class="head1"><span class="heading" width="15%"><b><center>Insp No</center></b></th>
<th class="head0"><span class="heading" width="15%"><b><center>Signoff</center></b></th>
<th class="head1"><span class="heading" width="40%"><b><center>Remarks</center></b></th>

</tr>

<?
 $resultin = $newin->getin($worecnum);
$row=mysql_fetch_object($resultin);
$c=1;
$count=15;
while($row!=NULL)
{
 $from=$row->fromsl;
$seq=$row->line_num;
if($seq==0)
{
$seq="";
}
if($row->st_date != '' && $row->st_date != '0000-00-00')
               {
                 $datearr = split('-', $row->st_date);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $date1=date("M j, Y",$x);
               }
               else
               {
                 $date1 = '';
               }
echo ("<tr class=bgcolor2>
            <td width=4%><span class=tabletext> $seq </td>
			<td width=4%><span class=tabletext>$row->stage</td>
		
			
			<td width=4%><span class=tabletext> $from </td>
			<td width=4%><span class=tabletext>$row->tosl</td>
			<td width=4%><span class=tabletext>$row->samplingsl</td>
			
			<td width=4%><span class=tabletext>$row->acc</td>
			<td width=4%><span class=tabletext>$row->rework</td>
			<td width=4%><span class=tabletext>$row->rej</td>
			<td width=4%><span class=tabletext>$row->ncnum</td>
			<td width=4%><span class=tabletext>$row->ret</td>
			<td width=4%><span class=tabletext>$row->hold</td>
			<td width=10%><span class=tabletext>$date1</td>
			
			<td width=15%><span class=tabletext>$row->inspnum</td>
			<td width=15%><span class=tabletext>$row->signoff</td>
			<td width=40%><span class=tabletext>$row->remarks</td>");
	         printf('</tr>');
	
	$c=$c+1;
	$row=mysql_fetch_object($resultin);
	}?>

</table>
</td></tr>
