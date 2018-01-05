<?
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
//////session_register('pagename');

include_once('classes/loginClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
include('classes/reportClass.php');
$newreport = new report;
$crn=$_REQUEST['crn'];
$start_date=$_REQUEST['frm'];
$end_date=$_REQUEST['to'];
?>
<table  width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDFDF">
<tr>
<td colspan=8 align="center" bgcolor="#00DDFF"><span class="heading"><b>PRN PERFORMANCE</b></td>
</tr>
<td valign='top' bgcolor="#FFFFFF" width='15%'><span class="tabletext"><b>PRN:</b>&nbsp;
<input type="text" size=10% name="crn" id="crn" value="<?echo $_REQUEST['crn'] ?>"></td>
<td  bgcolor="#FFFFFF" colspan=7><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="frm" name="frm" size=10 value="<?php echo $start_date ?>"
          style="background-color:#DDDDDD;" >
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('frm')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="to" name="to" size=10 value="<?php echo $end_date ?>"
          style="background-color:#DDDDDD;" >
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('to')">   
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/bu-get.gif" value="Get" 
            onclick="javascript: getcrn_report('customerdiv')"></td>
</tr>

<tr bgcolor="#FFFFFF">
<td valign='top' colspan=8>
<?php
if($crn!='' && $start_date!='' && $end_date!='')
{?>
<tr bgcolor="#FFCC00">
<td  width='10px' rowspan=3 align='center' bgcolor="#66cc33"><span class="tabletext" align='center'><b>PRN</b></td>
<td  width='20px' colspan=3 align='center' bgcolor="#3399ff"><span class="tabletext" align='center'><b>WORK ORDER</b></td>
<td   width='20px' colspan=4 align='center' bgcolor="#FFA500"><span class="tabletext" align='center'><b>NC</b></td>
</tr>
<tr>
<td  bgcolor="#3399ff" width='20px' align='center'><span class="tabletext" ><b>Book Date</b></td>
<td  bgcolor="#3399ff" width='10px' align='center'><span class="tabletext"><b>Qty</b></td>
<td bgcolor="#3399ff" width='10px' align='center'><span class="tabletext"><b>Acc</b></td>
<td  bgcolor="#FFA500" width='10px' align='center'><span class="tabletext"><b>Qty<br></b></td>
<td  bgcolor="#FFA500" width='10px' align='center'><span class="tabletext"><b>FI<br></b></td>
<td  bgcolor="#FFA500" width='10px' align='center'><span class="tabletext"><b>Inpro<br></b></td>
<td  bgcolor="#FFA500" width='10px' align='center'><span class="tabletext"><b>Cust Rej.<br></b></td>
</tr>
<tr bgcolor="#FFFFFF">
<?php
$cond='';
$start_array=explode('-',$start_date);
$start_year=$start_array[0];
$start_month=$start_array[1];
$end_array=explode('-',$end_date);
$end_year=$end_array[0];
$end_month=$end_array[1];
if($start_year == $end_year)
{
   for($j=$start_month;$j<=$end_month;$j++)
   {
		   $monthName = date("F", mktime(0, 0, 0, $j, 10));
		   $Date=$monthName.','.$start_year;	
		   if(intval($j) <=9)
		    $j='0'.intval($j);
           $cond1="w.crn_num like '$crn%' and w.book_date like '$start_year-$j%'";
		   $result3 = $newreport->check_4_FI_INSP($cond1);
		   $myrow4qty=mysql_fetch_row($result3);
		  
   		if($myrow4qty[6]!='')
	   {
	    printf('<tr bgcolor="#FFFFFF">
        <td width="20px" align="center"><span class="tabletext">%s</td>',$myrow4qty[6]);
		printf('<td width="20px" align="center"><span class="tabletext">%s</td>',$Date);
		printf('<td width="10px" align="center"><span class="tabletext">%s</td>
        <td width="10px" align="center"><span class="tabletext">%s</td>',$myrow4qty[0],$myrow4qty[1]); 
		printf('<td width="10px" align="center"><span class="tabletext">%s</td>',$myrow4qty[7]);
		printf('<td width="10px" align="center"><span class="tabletext">%s</td>',$myrow4qty[3]);
		printf('<td width="10px" align="center"><span class="tabletext">%s</td>',$myrow4qty[4]);
		printf('<td width="10px" align="center"><span class="tabletext">%s</td></tr>',$myrow4qty[5]);
	   }
   }
}
if($start_year != $end_year)
{	
  $end_month1=12;
  for($m=$start_year ;$m<=$end_year;$m++)
  {
      $end_month1=($m==$end_year)?$end_month:12;
      for($n=$start_month;$n<=$end_month1;$n++)
      {
        $monthName = date("F", mktime(0, 0, 0, $n, 10));
		$Date=$monthName.', '.$m;
		if(intval($n) <=9)
			   $n='0'.intval($n);
        $cond1="w.crn_num like '$crn%'and w.book_date like '$m-$n%'";    	

		 $result3 = $newreport->check_4_FI_INSP($cond1);
		  $myrow4qty=mysql_fetch_row($result3);

		if($myrow4qty[6]!='')
	    {
		printf('<tr bgcolor="#FFFFFF">
        <td width="20px"><span class="tabletext">%s</td>',$myrow4qty[6]);
		printf('<td width="20px"><span class="tabletext">%s</td>',$Date);
		printf('<td width="10px"><span class="tabletext">%s</td>
        <td width="10px"><span class="tabletext">%s</td>',$myrow4qty[0],$myrow4qty[1]); 
		printf('<td width="10px"><span class="tabletext">%s</td>',$myrow4qty[7]);
		printf('<td width="10px"><span class="tabletext">%s</td>',$myrow4qty[3]);
		printf('<td width="10px"><span class="tabletext">%s</td>',$myrow4qty[4]);
		printf('<td width="10px"><span class="tabletext">%s</td></tr>',$myrow4qty[5]);
	   }
     }
     $start_month=1;	     
  }
}
}?>
</tr>
</table>