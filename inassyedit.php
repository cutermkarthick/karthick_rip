<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 id="tablemmid" class="stdtable">
 <tr>
 	<thead>
            <td colspan=13><span class="heading"><center><b>Part Status</b></center></td>
        </tr>
		<tr bgcolor="#FFFFFF">
            <td colspan=13><span class="heading"><a href="javascript:addRowprtstat('tablemmid',document.forms[0].indexmm.value)"> <img src="images/bu-addrow.gif" border="0"></a></td>
        <tr>
		 <th class="head0" width="3%"><span class="tabletext">
           <p align="left"><b>Seq</b></p></font></th>
		   		<th class="head1" width="7%"><span class="tabletext">
		   <p align="left"><b>Stage</b></p></font></th>
            <th class="head0" width="3%"><span class="tabletext">
           <p align="left"><b>From<br /> Sl.No.</b></p></font></th>
			<th class="head1" width="5%"><span class="tabletext">
		   <p align="left"><b>To<br /> Sl.No.</b></p></font></th>
			<th class="head0" width="8%"><span class="tabletext">
		   <p align="left"><b>Sampling<br /> Sl.No.</b></p></font></th>
		   <th class="head1" width="7%"><span class="tabletext">
		   <p align="left"><b>Accept</b></p></font></th>
			<th class="head0" width="7%"><span class="tabletext">
		   <p align="left"><b>Rework</b></p></font></th>
			
			<th class="head1" width="7%"><span class="tabletext">
		   <p align="left"><b>Reject</b></p></font></th>
			<th class="head0" width="7%"><span class="tabletext">
		   <p align="left"><b>Ret</b></p></font></th>
		   
		   <th class="head1" width="25%"><span class="tabletext">
		    <p align="left"><b>Date</b></p></font></th>

		   <th class="head0" width="15%"><span class="tabletext">
		   <p align="left"><b>Insp.No</b></p></font></th>
	
			<th class="head1" width="15%"><span class="tabletext">
		   <p align="left"><b>Signoff</b></p></font></th>
			<th class="head0" width="30%"><span class="tabletext">
		   <p align="left"><b>Remarks</b></p></font></th>
	 </tr>
	</thead>
	 <?php
	 $dept=$_SESSION['department'];
	$assyworecnum=$_REQUEST['assyworecnum'];
	 $resultin = $newinassy->getinassy($assyworecnum);
$row=mysql_fetch_object($resultin);
$x=1; //echo $dept."-------------------";
while($row!=NULL)
{
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
         $rem=strip_tags($row->remarks); 
		// echo $rem; 
			$seq=$row->line_num;
			if($seq==0)
			{
			$seq="";
			}

  ?>
  
  <?php
         if($dept !='QA')
         {
            echo "
			<td width=7%><span class=tabletext>
    <p align=left><b><input name=$mmline_num id=$mmline_num type=text size=4 value='$seq' ></b></p></font</td>";
  		   echo "<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$stage type=text  size=4 value='$row->stage' id=$stage></b></p></font></td> ";
		   
		echo "	<td width=5%><span class=tabletext>
           <p align=left><b><input name=$from size=4 type=text value='$row->fromsl' ></b></p></font></td> ";
		   
		   echo "<input type=hidden name=$intlirecnum value='$row->link2assywo'> ";
				echo "<input type=hidden name=$recno value='$row->recno'>";
		echo "	<td width=7%><span class=tabletext>
			
		   <p align=left><b><input name=$to type=text size=4 value='$row->tosl' ></b></p></font></td> ";
		   
		echo "	<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$sampling type=text size=8 value='$row->samplingsl' ></b></p></font</td> ";
		   
			
		echo "	<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$accept id=$accept size=4 type=text value='$row->acc' ></b></p></font></td> ";
		   
     	   echo "<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$rework id=$rework type=text size=4 value='$row->rework' ></b></p></font></td> ";
		   
			echo "<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$reject id=$reject type=text size=4 value='$row->rej' ></b></p></font></td> ";
		   
		echo "<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$returns id=$returns type=text size=4 value='$row->ret' ></b></p></font></td> ";


  		echo"<td><input type=\"text\" id=\"$date\"  name=\"$date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
        size=\"10%\" value=\"$row->st_date\"><img src=\"images/bu-getdateicon.gif\" alt=\"GetDate\"
        onclick=\"GetDate('$date')\"></td>";


          echo" <td width=15%><span class=tabletext>
		   <p align=left><b><input name=$inspno id=$inspno type=text size=20 value='$row->inspnum' ></b></p></font></td> ";
		   
		echo"	<td width=%15><span class=tabletext>
		   <p align=left><b><input name=$signoff id=$signoff type=text size=20 value='$row->signoff' ></b></p></font></td> ";
		   
			echo"<td width=30%><span class=tabletext>
		   <p align=left><b><input name=$remarks type=text size=50 value='$rem' ></b></p></font></td>";
		   

       }
       else
       {

            echo "
			<td width=7%><span class=tabletext>
    <p align=left><b><input name=$mmline_num id=$mmline_num type=text size=4 style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value='$seq' ></b></p></font</td>";
  		   echo "<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$stage type=text style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  size=4 value='$row->stage' id=$stage></b></p></font></td> ";

		echo "	<td width=5%><span class=tabletext>
           <p align=left><b><input name=$from size=4 type=text style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value='$row->fromsl' ></b></p></font></td> ";

		   echo "<input type=hidden name=$intlirecnum value='$row->link2assywo'> ";
				echo "<input type=hidden name=$recno value='$row->recno'>";
		echo "	<td width=7%><span class=tabletext>

		   <p align=left><b><input name=$to type=text size=4 style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value='$row->tosl' ></b></p></font></td> ";

		echo "	<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$sampling type=text size=8 style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value='$row->samplingsl' ></b></p></font</td> ";


		echo "	<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$accept id=$accept size=4 type=text style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value='$row->acc' ></b></p></font></td> ";

     	   echo "<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$rework id=$rework type=text size=4 style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value='$row->rework' ></b></p></font></td> ";

			echo "<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$reject id=$reject type=text size=4 style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value='$row->rej' ></b></p></font></td> ";

		echo "<td width=7%><span class=tabletext>
		   <p align=left><b><input name=$returns id=$returns type=text size=4  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value='$row->ret' ></b></p></font></td> ";


  		echo"<td><input type=\"text\" id=\"$date\"  name=\"$date\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"
        size=\"10%\" value=\"$row->st_date\"></td>";


          echo" <td width=15%><span class=tabletext>
		   <p align=left><b><input name=$inspno id=$inspno type=text size=20 style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value='$row->inspnum' ></b></p></font></td> ";

		echo"	<td width=%15><span class=tabletext>
		   <p align=left><b><input name=$signoff id=$signoff type=text size=20 style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value='$row->signoff' ></b></p></font></td> ";

			echo"<td width=30%><span class=tabletext>
		   <p align=left><b><input name=$remarks type=text size=50  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value='$rem' ></b></p></font></td>";
	}
  printf('</tr>');


	$x++;
	$row=mysql_fetch_object($resultin);
    }


    echo "<input type=\"hidden\" name=\"indexmm\" value=$x>";
   echo "<input type=\"hidden\" name=\"curindex\" value=$x>";
?>


<input type="hidden" name="inproc" value="inedit"> 
</table>
