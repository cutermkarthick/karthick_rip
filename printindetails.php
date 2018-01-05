
  <table border="0" width="100%" rule=all cellspacing=0 >
<tr bgcolor="#DFDEDF">
  <td colspan=5><span class="heading"><strong>&nbsp;&nbsp;&nbsp; </strong></td>
</tr>
</table>
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rule=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" >

<td><span class="heading" width="4%"><b><center>Stage</center></b></td>
<td><span class="heading" width="4%"><b><center>From Sl.No</center></b></td>
<td><span class="heading" width="4%"><b><center>To Sl.No</center></b></td>
<td><span class="heading" width="4%"><b><center>Samp.<br>Sl.No.</center></b></td>
<td><span class="heading" width="4%"><b><center>Accept<br />
      <b>Qty </b>
</center></b></td>
<td><span class="heading" width="4%"><b><center>Rework<br />
      <b>Qty </b>
</center></b></td>

<td><span class="heading" width="4%"><b><center>Reject<br />
      <b>Qty </b>
</center></b></td>
<td><span class="heading" width="4%"><b><center>
  Returned<br />
  Qty
</center></b></td>
<td><span class="heading" width="4%"><b><center>Insp No</center></b></td>

<td><span class="heading" width="15%"><b><center>Signoff</center></b></td>
<td><span class="heading" width="40%"><b><center>Remarks</center></b></td>
</tr>

<?
 $resultin = $newin->getin($worecnum);
$row=mysql_fetch_object($resultin);
$c=1;
$count=8;
while($row!=NULL)
{
 $from=$row->fromsl;
      if($row->stage == '')
      {
       $row->stage = '&nbsp';
      }
      if($from == '')
      {
       $from = '&nbsp';
      }
      if($row->tosl == '')
      {
       $row->tosl = '&nbsp';
      }
      if($row->samplingsl == '')
      {
       $row->samplingsl = '&nbsp';
      }
      if($row->acc == '')
      {
       $row->acc = '&nbsp';
      }
      if($row->rework == '')
      {
       $row->rework = '&nbsp';
      }
      if($row->rej == '')
      {
       $row->rej = '&nbsp';
      }
      if($row->ret == '')
      {
       $row->ret = '&nbsp';
      }
      if($row->inspnum == '')
      {
       $row->inspnum = '&nbsp';
      }
      if($row->signoff == '')
      {
       $row->signoff = '&nbsp';
      }
      if($row->remarks == '')
      {
       $row->remarks = '&nbsp';
      }
echo ("<tr class=bgcolor2 bordercolor=#CCCCCC>

			<td width=4% height=6%><span class=tabletext>$row->stage</td>
			<td width=4% height=6%><span class=tabletext> $from </td>
			<td width=4% height=6%><span class=tabletext>$row->tosl</td>
			<td width=4% height=6%><span class=tabletext>$row->samplingsl</td>
			<td width=4% height=6%><span class=tabletext>$row->acc</td>
			<td width=4% height=6%><span class=tabletext>$row->rework</td>
			<td width=4% height=6%><span class=tabletext>$row->rej</td>
			<td width=4% height=6%><span class=tabletext>$row->ret</td>

			<td width=15% height=6%><span class=tabletext>$row->inspnum</td>
			<td width=15% height=6%><span class=tabletext>$row->signoff</td>
			<td width=40% height=6%><span class=tabletext>$row->remarks</td>");
	         printf('</tr>');

	$c=$c+1;
	$row=mysql_fetch_object($resultin);
}

$count=$count-$c;
$count=$count+1;
while($count!=0)
{
echo ('<tr class=bgcolor2 bordercolor=#CCCCCC>

		<td width=4%><span class=tabletext>&nbsp;<br></td>
			<td width=4%><span class=tabletext>&nbsp; </td>
			<td width=4%><span class=tabletext>&nbsp;</td>
			<td width=4%><span class=tabletext>&nbsp;</td>
			<td width=4%><span class=tabletext>&nbsp;</td>
			<td width=4%><span class=tabletext>&nbsp;</td>
			<td width=4%><span class=tabletext>&nbsp;</td>
			<td width=4%><span class=tabletext>&nbsp;</td>
			<td width=20%><span class=tabletext>&nbsp;</td>
			<td width=20%><span class=tabletext>&nbsp;</td>
			<td width=30%><span class=tabletext>&nbsp;</td>');
	         printf('</tr>');

	$count=$count-1;
}

?>



   
