<table border=0 bgcolor="#DFDEDF" style="width:100%" cellspacing=1 cellpadding=3 class="stdtable">
<tr>
<td colspan=18><span class="heading"><center><b>Part Status</b></center></td>
</tr>

<tr bgcolor="#FFFFFF">
<?php
$dept=$_SESSION['department'];

if($dept == 'QA' || $dept == 'Sales'  )
{?>
<td colspan=20><span class="heading"><a href="javascript:addRow4int('tablemm',document.forms[0].indexmm.value)"> <img src="images/bu-addrow.gif" border="0"></a></td>
<?php
}

?>
</table>
<div style="width:100%height:200px; overflow-x: scroll;">
<table border=0 bgcolor="#DFDEDF" style="width:100%" cellspacing=1 cellpadding=3 id="tablemm" class="stdtable">
<tr>
<thead>
<th class="head0" style="width:3%"><span class="tabletext">
<p align="left"><b>Seq</b></p></font></td>
<th class="head1" style="width:7%"><span class="tabletext">
<p align="left"><b>Stage</b></p></font></td>

<th class="head0" width="7%"><span class="tabletext">

<p align="left"><b>From<br /> Sl.No.</b></p></font></td>
<th class="head1" width="5%"><span class="tabletext">
<p align="left"><b>To<br />Sl.No.</b></p></font></td>
<th class="head0" width="8%"><span class="tabletext">
<p align="left"><b>Sampling<br /> Sl.No.</b></p></font></td>
<th class="head1" width="7%"><span class="tabletext">
<p align="left"><b>Accept</b></p></font></td>
<th class="head0" width="7%"><span class="tabletext">
<p align="left"><b>Rework</b></p></font></td>			
<th class="head1" width="7%"><span class="tabletext">
<p align="left"><b>Reject</b></p></font></td>
<th class="head0" width="7%"><span class="tabletext">
<p align="left"><b>NC</b></p></font></td>
<th class="head1" width="7%"><span class="tabletext">
<p align="left"><b>Ret</b></p></font></td>

<th class="head0" width="7%"><span class="tabletext">
<p align="left"><b>Hold</b></p></font></td>

<th class="head1" width="25%"><span class="tabletext">
<p align="left"><b>Date</b></p></font></td>


<th class="head0" width="15%"><span class="tabletext">
<p align="left"><b>Insp.No</b></p></font></td>

<th class="head1" width="15%"><span class="tabletext">
<p align="left"><b>Signoff</b></p></font></td>
<th class="head0" width="30%"><span class="tabletext">
<p align="left"><b>Remarks</b></p></font></td>
</tr>

<?php
$resultin = $newin->getin($worecnum);
$resultnc=$newin->getncstat($worecnum);
echo"<input type=\"hidden\" name=ncstat id=ncstat type=text size=4 value='$resultnc'>";
$row=mysql_fetch_object($resultin);
$x=1;
while($row!=NULL)
{
//$myresultnc=mysql_fetch_row($resultnc);
echo(' <tr bgcolor="#FFFFFF">');
$mmline_num="mmline_num".$x;
$from="from".$x;
$to="to".$x;
$sampling="sampling".$x;
$rework="rework".$x;
$accept="accept".$x;
$reject="reject".$x;
$returns="returns".$x;
$inspno="inspno".$x;
$stage="stage".$x;
$date="date" .$x;
$signoff="signoff".$x;
$remarks="remarks".$x;
$intlirecnum="intlirecnum" . $x;
$recno="recno".$x;
$dn="dn".$x;
$dn_sent="dn_sent".$x;
$dn_recv="dn_recv".$x;
$cofc_num="cofc_num".$x;
$supplier_wo="supplier_wo".$x;
$ncnum="ncnum".$x;
$hold="hold".$x;
$ncstat="ncstat".$x;
$prev_ret="prev_ret".$x;
$rem=strip_tags($row->remarks);
// echo $rem; 
$seq=$row->line_num;
if($seq==0)
{
$seq="";
}
/*	if($seq != 0 && $row->ncnum !='')
{     //echo $seq;
$resultnc=$newin->getncstat($worecnum,$row->ncnum);
} */


echo"<input type=\"hidden\" name=$ncstat id=$ncstat type=text size=4 value='$resultnc'>
<input name=$prev_ret id=$prev_ret type=hidden size=4  value='$row->ret'>";
//if($row->stage!='PostDN' && $dept !='PPC'){
//if(($row->stage!='PostDN' && ($dept !='QA' || $dept =='PPC') &&( $row->stage!='FINAL'&& $row->stage!='FI' && $row->stage!='fi' && $row->stage!='final' && $row->stage!='Fi')))

if($row->stage!='PostDN' && ($dept == 'Sales'   || 
($dept == 'PPC5' && 
( $myrow[0] == '30371' || $myrow[0] == '30468'
|| $myrow[0] == '30471' || $myrow[0] == '30482'  
|| $myrow[0] == '30486' || $myrow[0] == '30489'

|| $myrow[0] == '28875' || $myrow[0] == '29847'
|| $myrow[0] == '29848' || $myrow[0] == '29888'
|| $myrow[0] == '29890' || $myrow[0] == '29892'
|| $myrow[0] == '30048' || $myrow[0] == '30050'
|| $myrow[0] == '30560' || $myrow[0] == '30562'

|| $myrow[0] == '30563' || $myrow[0] == '30565'
|| $myrow[0] == '30566' || $myrow[0] == '30572'
|| $myrow[0] == '30574' || $myrow[0] == '30577'

|| $myrow[0] == '29674' || $myrow[0] == '29675'
|| $myrow[0] == '29678' || $myrow[0] == '29679'
|| $myrow[0] == '29681' || $myrow[0] == '29682'
|| $myrow[0] == '30426' 
|| $myrow[0] == '28393' 


)  )))
{
echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$mmline_num id=$mmline_num type=text size=4 value='$seq'></b></p></font</td>";
echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$stage type=text  size=5 value='$row->stage' id=$stage></b></p></font></td> ";
echo "<td width=5%><span class=tabletext>
<p align=left><b><input name=$from size=4 type=text value='$row->fromsl' ></b></p></font></td> ";
echo "<input type=hidden name=$intlirecnum value='$row->link2wo'> ";
echo "<input type=hidden name=$recno value='$row->recno'>";
echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$to type=text size=4 value='$row->tosl' ></b></p></font></td> ";
echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$sampling type=text size=8 value='$row->samplingsl' ></b></p></font</td> ";


echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$accept id=$accept size=4 type=text value='$row->acc' ></b></p></font></td> ";
echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$rework id=$rework type=text size=4 value='$row->rework' ></b></p></font></td> ";
echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$reject id=$reject type=text size=4 value='$row->rej' ></b></p></font></td> ";


echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$ncnum id=$ncnum type=text size=4 value='$row->ncnum'></b></p></font></td> ";
echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$returns id=$returns type=text size=4  value='$row->ret'></b></p></font></td> ";
echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$hold id=$hold type=text size=4  value='$row->hold'></b></p></font></td> ";

echo"<td><input type=\"text\" id=\"$date\"  name=\"$date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
size=\"10%\" value=\"$row->st_date\"><img src=\"images/bu-getdateicon.gif\" alt=\"GetDate\"
onclick=\"GetDate('$date')\"></td>";

//echo "<td width=7%><span class=tabletext> <p align=left><b><input name=$returns id=$returns type=text size=4 value='$row->ret' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></b></p></font></td> ";

echo" <td width=15%><span class=tabletext>
<p align=left><b><input name=$inspno id=$inspno type=text size=20 value='$row->inspnum' ></b></p></font></td> ";
echo" <td width=%15><span class=tabletext>
<p align=left><b><input name=$signoff id=$signoff type=text size=20 value='$row->signoff' ></b></p></font></td> ";
echo"<td width=30%><span class=tabletext>
<p align=left><b><input name=$remarks type=text size=50 value='$rem' ></b></p></font></td>";
}
else{
echo "
<td width=7%><span class=tabletext>
<p align=left><b><input name=$mmline_num id=$mmline_num type=text size=4 value='$seq'style=\"background-color:#DDDDDD;\" readonly=\"readonly\" ></b></p></font</td>";
echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$stage type=text  size=5 value='$row->stage' id=$stage style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></b></p></font></td> ";


echo "<td width=5%><span class=tabletext>
<p align=left><b><input name=$from size=4 type=text value='$row->fromsl' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></b></p></font></td> ";
echo "<input type=hidden name=$intlirecnum value='$row->link2wo'> ";
echo "<input type=hidden name=$recno value='$row->recno'>";
echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$to type=text size=4 value='$row->tosl' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></b></p></font></td> ";
echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$sampling type=text size=8 value='$row->samplingsl' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></b></p></font</td> ";
/* if(($dept =='PPC' &&( $row->stage=='FINAL'|| $row->stage=='FI' || $row->stage=='fi' || $row->stage=='final' || $row->stage=='Fi')))
{
echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$accept id=$accept size=4 type=text value='$row->acc' ></b></p></font></td> ";
echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$rework id=$rework type=text size=4 value='$row->rework' ></b></p></font></td> ";

}
else
{ */
//echo $myrow[40] .'---------------'.$myrow[22].'----------'.$_SESSION['department'];
echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$accept id=$accept size=4 type=text value='$row->acc' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></b></p></font></td> ";
echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$rework id=$rework type=text size=4 value='$row->rework' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></b></p></font></td> ";   

echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$reject id=$reject type=text size=4 value='$row->rej' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></b></p></font></td> ";


//if($dept =='QA' || (($dept =='PPC' &&( $row->stage=='FINAL'|| $row->stage=='FI' || $row->stage=='fi' || $row->stage=='final' || $row->stage=='Fi'))))|| $dept =='PPC4' || $dept =='PPC5'
if($dept =='QA'|| $dept =='Purchasing')
{
echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$ncnum id=$ncnum type=text size=4 value='$row->ncnum' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></b></p></font></td> ";

}
else
{
echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$ncnum id=$ncnum type=text size=4 value='$row->ncnum'></b></p></font></td> ";

}
/*if(($dept =='PPC' &&( $row->stage=='FINAL'|| $row->stage=='FI' || $row->stage=='fi' || $row->stage=='final' || $row->stage=='Fi')))
{

echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$returns id=$returns type=text size=4  value='$row->ret' ></b></p></font></td> ";
}else
{ */
echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$returns id=$returns type=text size=4  value='$row->ret' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></b></p></font></td> ";

// }
//echo "<td width=7%><span class=tabletext> <p align=left><b><input name=$returns id=$returns type=text size=4 value='$row->ret' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></b></p></font></td> ";
echo "<td width=7%><span class=tabletext>
<p align=left><b><input name=$hold id=$hold type=text size=4  value='$row->hold' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></b></p></font></td> ";

echo"<td><input type=\"text\" id=\"$date\"  name=\"$date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
size=\"10%\" value=\"$row->st_date\"></td>";
echo" <td width=15%><span class=tabletext>
<p align=left><b><input name=$inspno id=$inspno type=text size=20 value='$row->inspnum' style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></b></p></font></td> ";
echo"<td width=%15><span class=tabletext>
<p align=left><b><input name=$signoff id=$signoff type=text size=20 value='$row->signoff'style=\"background-color:#DDDDDD;\" readonly=\"readonly\" ></b></p></font></td> ";
echo"<td width=30%><span class=tabletext>
<p align=left><b><input name=$remarks type=text size=50 value='$rem'style=\"background-color:#DDDDDD;\" readonly=\"readonly\" ></b></p></font></td>";

}
printf('</tr>');

$x++;
$row=mysql_fetch_object($resultin);
}


echo "<input type=\"hidden\" name=\"indexmm\" id=\"indexmm\" value=$x>";
echo "<input type=\"hidden\" name=\"curindex\" id=\"curindex\" value=$x>";
?>


<input type="hidden" name="inproc" value="inedit"> 
</table>
</div>