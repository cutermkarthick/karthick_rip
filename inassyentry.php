
<table class="stdtable1" border=0 bgcolor="#DFDEDF" cellspacing=1 cellpadding=3 id="tablemmid">
 <tr>
        <thead>
            <td colspan=13><span class="heading"><center><b>Part Status</b></center></td>
        </tr>
	<!-- 	<tr bgcolor="#FFFFFF">
            <td colspan=13><span class="heading"><a href="javascript:addRowprtstat('tablemmid',document.forms[0].indexmm.value)"> <img src="images/bu-addrow.gif" border="0"></a></td>
        </tr> -->
		  <tr>
		 <th class="head0" width="7%"><span class="tabletext">
           <p align="left"><b>Seq</b></p></font></td>
		   		<th class="head1" width="7%"><span class="tabletext">
		   <p align="left"><b>Stage</b></p></font></td>
            <th class="head0" width="3%"><span class="tabletext">
           <p align="left"><b>From<br /> Sl.No.</b></p></font></td>
			<th class="head1" width="5%"><span class="tabletext">
		   <p align="left"><b>To<br /> Sl.No.</b></p></font></td>
			<th class="head0" width="7%"><span class="tabletext">
		   <p align="left"><b>Sampling<br /> Sl.No.</b></p></font></td>
		   <th class="head1" width="7%"><span class="tabletext">
		   <p align="left"><b>Accept</b></p></font></td>
			<th class="head0" width="7%"><span class="tabletext">
		   <p align="left"><b>Rework</b></p></font></td>
			
			<th class="head1" width="7%"><span class="tabletext">
		   <p align="left"><b>Reject</b></p></font></td>
			<th class="head0" width="7%"><span class="tabletext">
		   <p align="left"><b>Ret</b></p></font></td>
		   <th class="head1" width="10%"><span class="tabletext">
		   <p align="left"><b>Date</b></p></font></td>

		   
		   <th class="head0" width="15%"><span class="tabletext">
		   <p align="left"><b>Insp.No</b></p></font></td>
	
			<th class="head1" width="15%"><span class="tabletext">
		   <p align="left"><b>Signoff</b></p></font></td>
			<th class="head0" width="30%"><span class="tabletext">
		   <p align="left"><b>Remarks</b></p></font></td>
	 </tr>
	  <?
	  $x=1;
	  while($x<=1)
	  {
	  
	 echo(' <tr bgcolor="#FFFFFF">');
	 $mmline_num="mmline_num" . $x;
	 $from="from".$x;
	 $to="to".$x;
	 $sampling="sampling".$x;
	 $rework="rework".$x;
	 $accept="accept".$x;
	 $reject="reject".$x;
	 $returns="returns".$x;
	 $date="date".$x;
	 $inspno="inspno".$x;
	 $stage="stage".$x;
	 $signoff="signoff".$x;
	 $remarks="remarks".$x;
            
			echo "
			<td width=7%><span class=tabletext>
           <p align=left><b><input name=$mmline_num id=$mmline_num type=text size=4></b></p></font></td>
		   <td width=7%><span class=tabletext>
		   <p align=left><b><input name=$stage id=$stage type=text size=3 value='FI' style='background-color#DDDDDD' readonly='readonly'> </b></p></font></td>
			<td width=7%><span class=tabletext>
           <p align=left><b><input name=$from type=text size=4></b></p></font></td>
			<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$to type=text size=4></b></p></font></td>
			<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$sampling type=text size=8></b></p></font></td>
			<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$accept id=$accept type=text size=4></b></p></font></td>
			<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$rework id=$rework type=text size=4></b></p></font></td>
			
			<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$reject id=$reject type=text size=4></b></p></font></td>
		   <td width=7%><span class=tabletext>
		   <p align=left><b><input name=$returns id=$returns type=text size=4 ></b></p></font></td>
		   
           <td><input type=\"text\" id=\"$date\"  name=\"$date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
           size=\"10%\" value=\"$row->date\"><img src=\"images/bu-getdateicon.gif\" alt=\"GetDate\"
           onclick=\"GetDate('$date')\"> </td>
            
			<td width=15%><span class=tabletext>
		   <p align=left><b><input name=$inspno id=$inspno type=text size=20></b></p></font></td>
		   
			
			<td width=15%><span class=tabletext>
		   <p align=left><b><input name=$signoff id=$signoff type=text size=20></b></p></font></td>
			<td width=30%><span class=tabletext>
		   <p align=left><b><input name=$remarks type=text size=50></b></p></font></td>
	 </tr> ";

	$x++;
    }
    echo "<input type=\"hidden\" name=\"indexmm\" value=$x>";
     echo "<input type=\"hidden\" name=\"curindex\" value=$x>";

?>
<input type="hidden" name="inproc" value="inentry"> 
</table>

