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
$crn_disp=$_REQUEST['crn_disp'];

$first_day_of_week = date('Y-m-d', strtotime('Last Monday', time()));
$last_day_of_week = date('Y-m-d', strtotime('Next Sunday', time()));
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>

<table  width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
<td colspan=6 align="center" bgcolor="#bababa"><span class="heading"><b>This Week Dispatch</b></td>
</tr>
<tr>
<tr>
<td valign='top' bgcolor="#FFFFFF" ><span class="labeltext"><b>PRN:</b>&nbsp;
<input type="text" size=15% name="crn_disp" id="crn_disp" value="<?echo $_REQUEST['crn_disp'] ?>"></td>
<td  bgcolor='#FFFFFF'> <img src="images/bu-get.gif" value="Get" onclick="javascript: getthis_week_disp_report('this_week_disp')"></td>
</tr>
</table>

<table  width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<?php
if($crn_disp!='')
{?>
<tr>
<thead>
<th  width='20px' class="head0"><span class="tabletext" align='center'><b>PRN</b></th>
<th  width='20px'  class="head1"><span class="tabletext" align='center'><b>Sch Due Date</b></th>
<th   width='20px' class="head0"><span class="tabletext" align='center'><b>FG</b></th>
<th   width='20px' class="head1"><span class="tabletext" align='center'><b>Sch Qty</b></th>
<th   width='20px' class="head0"><span class="tabletext" align='center'><b>Disp</b></th>
<th   width='20px' class="head1"><span class="tabletext" align='center'><b>BALANCE</b></th>
</tr>
<tr bgcolor="#FFFFFF">
<?php.
$cond="d.crnnum like '".$crn_disp."%' and d.schedule_date between'".$first_day_of_week."' and '".$last_day_of_week."' and w.crn_num=d.crnnum";
$result = $newreport->get_thisweekdisp($cond);
$balance=0;
while($myrow=mysql_fetch_row($result))
{
	       $sch_date=date('M d, Y',strtotime($myrow[2]));	            
            if($prevcrn == $myrow[1])
	        {
		      $balance=$balance-$myrow[3];
			  $crn='';
			  $fg='';
			}
			else
	        {
			$fg=$myrow[4]-($myrow[5]+$myrow[6]);
			$balance=$fg-$myrow[3];
			$crn=$myrow[1];		
			}
		   printf('<tr bgcolor="#FFFFFF">
           <td width="20px" align="center"><span class="tabletext">%s</td>',$crn);
		   printf('<td width="20px" align="center"><span class="tabletext">%s</td>',$sch_date);
		   printf('<td width="20px" align="center"><span class="tabletext">%s</td>',$fg); 		
		   printf('<td width="20px" align="center"><span class="tabletext">%s</td>',$myrow[3]);	
		     printf('<td width="20px" align="center"><span class="tabletext">%s</td>',$myrow[5]);			
		   if($balance < 0)
		   {
		         printf('<td bgcolor="#ff6600" align="center" width="20px"><span class="tabletext">%s</td></tr>',$balance);  
	     	} 
		   else
		   {
		        printf('<td width="20px" align="center"><span class="tabletext">%s</td></tr>',$balance); 
		    }
		   $prevcrn=$myrow[1];
}
}?>
</table>