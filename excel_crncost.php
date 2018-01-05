<?php
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
$crn=$_REQUEST['crn'];

$data .='<html><head><style type="text/css">
.Heading {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9pt; font-style: normal; line-height: normal;
font-weight: font-variant: normal; text-transform: none; color: #000000}

.pageheading {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9pt; font-style: normal; line-height: normal;
font-weight: font-variant: normal; text-transform: none; color: #000000}

.labeltext {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pt; font-style: normal;
line-height: normal; font-weight: bold; font-variant: normal; text-transform: none; color: #000000}

.tabletext {  font-family: Verdana, sans-serif; font-size: 8pt; font-style: normal;
line-height: normal; font-weight: normal; font-variant: normal; text-transform: none; color: #000000}

.linktext {  font-family: Verdana, sans-serif; font-size: 9pt; font-style: normal;
line-height: normal; font-weight: normal; font-variant: normal; text-transform: none; color: #0066CC}

.welcome {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10pt; font-style: normal;
line-height: normal; font-weight: normal; font-variant: normal; text-transform: none; color: #000000}

.customer {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10pt; font-style: normal;
line-height: normal; font-weight: normal; font-variant: normal; text-transform: none; color: #00FFCC}

.ptext {  font-family: Verdana, sans-serif; font-size: 9pt; font-style: normal;
line-height: normal; font-weight: bold; font-variant: normal; text-transform: none; color: #000000}

</style></head>';

include('classes/reportClass.php');
$newreport = new report;


$data .= '<table width="100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF" rules=all>';
$data .= '<tr bgcolor="#FFFFFF">';
$data .= '<td valign="top">';

if($crn!='')
{	
$data .= '<table style="table-layout: fixed" width="700px" style="border:1px solid #000000;" border=1                  cellpadding=3 cellspacing=1 rules=all>';
$data .= '<tr>';
$data .= '<td width="80px" bgcolor="#ECE5B6"><span class="tabletext" align="center"><b>PRN</b></td>';
$data .= '<td width="150px" bgcolor="#ECE5B6"><span class="tabletext" align="center"><b>WO Process</b></td>';
$data .= '<td width="70px" bgcolor="#ECE5B6" align="center"><span class="tabletext" align="center"><b>WO                               Qty<br>(WIP)</b></td>';
$data .= '<td  width="70px" bgcolor="#ECE5B6" align="center"><span class="tabletext"><b>Cost</b></td>';
$data .= '<td width="70px" bgcolor="#ECE5B6" align="center"><span class="tabletext" align="center"><b>FG<br>Stock</b></td>';
$data .= '<td  width="70px" bgcolor="#ECE5B6" align="center"><span class="tabletext"><b>Cost</b></td>';
$data .= '<td width="70px" bgcolor="#ECE5B6" align="center"><span class="tabletext"                                                   align="center"><b>GRN<br>Stock</b></td>';
$data .= '<td  width="70px" bgcolor="#ECE5B6" align="center"><span class="tabletext"><b>Cost</b></td>';
$data .= '</tr>';
$data .= '</table>';

$data .= '<table width="700px" style="border:1px solid #000000;" border=1 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">';
$data .= '<tr bgcolor="#FFFFFF">';
$data .= '<td valign="top" width="79px">';

$cond='';
if($crn!='')
{
$cond='and m.CIM_refnum like '."'".$crn."%'";
$cond1='where m.CIM_refnum like '."'".$crn."%'";
}
else
{
$cond='';
$cond1='';
}
$result = $newreport->getallCRN4all($cond1); 
$total=0;
$total4dis=0;
$total4grn=0;
$totalbalance=0;

$total_cost1_dol=0;
$total_cost1_re=0;
$total_cost1_others=0;
$total_cost2_dol=0;
$total_cost2_re=0;
$total_cost2_others=0;
$total_cost3_dol=0;
$total_cost3_re=0;
$total_cost3_others=0;

$woprocarr = array("Manufacture Only","With Treatment");

while($myrow4crn=mysql_fetch_row($result))
{
$data .= '<table style="table-layout: fixed" width="75px" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">';

$data .= '<tr bgcolor="#FFFFFF" valign="top">';
$data .='<td bgcolor="#FFFFFF"><span class="tabletext">';
$data .= "*".$myrow4crn[1];
$data .= '</td></table>';
$data .= '</td>';

foreach ($woprocarr as $proc) 
{
$data .= '<td valign="top" width="100%" colspan=3>';
$data .= '<table style="table-layout: fixed" width="290px" border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
$data .= '<tr bgcolor="#FFFFFF" valign="top">';
$data .= '<td bgcolor="#FFFFFF" width="150px"><span class="tabletext">' .$proc. '</td>';

$results = $newreport->getallCRN4open($myrow4crn[1],$proc);  
if(mysql_num_rows($results) == '0')
{
$data .= '<td bgcolor="#FFFFFF" align="center" width="70px"><span class="tabletext">&nbsp;</td>';
$data .= '<td bgcolor="#FFFFFF" align="center" width="70px"><span class="tabletext">&nbsp;</td>';
}
while($myrow4=mysql_fetch_row($results))
{  
  $data .= '<td bgcolor="#FFFFFF" width="70px" align="center"><span class="tabletext">';
  $data .=sprintf('%d',$myrow4[2]); 
  $data .='</td>';
  $results_c1 = $newreport->getprice4crn($myrow4crn[1]); 
  while($myrow4c1=mysql_fetch_row($results_c1))
  {
	if($myrow4[2] != '')
	{	
		$soprice = $myrow4c1[1];
		$so_curr = $myrow4c1[2];
		
		$cost1=($myrow4[2]*$myrow4c1[1]);
		$data .= '<td bgcolor="#FFFFFF" width="70px" align="right"><span class="tabletext">';
		$data .=sprintf('%s%s%d',$myrow4c1[2],' ',$cost1); 		
		$data .='</td>';		
		if($myrow4c1[2] == '$')
		{
			$total_cost1_dol = $total_cost1_dol + $cost1;		  
		}
		else if($myrow4c1[2] == 'RS'|| $myrow4c3[1] == 'Rs')
		{
			$total_cost1_re = $total_cost1_re + $cost1;	
		}
		else 
		{
            $total_cost1_others = $total_cost1_others + $cost1;	
		}
	}
	else
	{
     $data .= '<td bgcolor="#FFFFFF" width="70px" align="right"><span class="tabletext">NA</td>';
	}
  }
  $total = $total + $myrow4[2];
}
$data .= '</td></tr>';
$data .= '</table>';
$data .= '</td>';
$data .= '<td valign="top" width="140px" colspan=2>';
$data .= '<table style="table-layout: fixed" width="140px"  border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';

$result4closed = $newreport->getallCRN4closed($myrow4crn[1],$proc); 
if(mysql_num_rows($result4closed) == '0')
{
$data .= '<td bgcolor="#FFFFFF" align="center" width="70px"><span class="tabletext">&nbsp;</td>';
$data .= '<td bgcolor="#FFFFFF" align="center" width="70px"><span class="tabletext">&nbsp;</td>';
}
while($myrow4closed=mysql_fetch_row($result4closed))
{
$data .= '<tr>';
$result1 = $newreport->getallCRNDetails($myrow4closed[0],$myrow4closed[2],$proc); 
$num_rows = mysql_num_rows($result1);
if($num_rows=='0')
{
$data .= '<td bgcolor="#FFFFFF" width="70px" align="center"><span class="tabletext">';
$data .=sprintf('%d',$myrow4closed[2]); 
$data .='</td>';
$cost2=($myrow4closed[2]*$soprice);
$data .= '<td bgcolor="#FFFFFF" width="70px" align="right"><span class="tabletext">';

$data .=sprintf('%s%s%d',$so_curr,' ',$cost2); 
$data .='</td>';
$total4dis = $total4dis + $myrow4closed[2];
if($so_curr == '$')
{
$total_cost2_dol = $total_cost2_dol + $cost2;
}
else if($so_curr == 'RS'|| $myrow4c3[1] == 'Rs')
{
$total_cost2_re = $total_cost2_re + $cost2;
}
else
{
$total_cost2_others = $total_cost2_others + $cost2;
}
}
while($myrow4dispatch=mysql_fetch_row($result1))
{
$data .= '<td bgcolor="#FFFFFF" width="70px" align="center"><span class="tabletext">';
$data .=sprintf('%d',$myrow4dispatch[0]); 
$data .= '</td>';
$total4dis = $total4dis + $myrow4dispatch[0];
$cost2=($myrow4dispatch[0]*$soprice);
$data .= '<td bgcolor="#FFFFFF" width="70px" align="right"><span class="tabletext">';
$data .=sprintf('%s%s%d',$so_curr,' ',$cost2); 
$data .='</td>';
if($so_curr == '$')
{
$total_cost2_dol = $total_cost2_dol + $cost2;
}
else if($so_curr == 'RS'|| $myrow4c3[1] == 'Rs')
{
$total_cost2_re = $total_cost2_re + $cost2;
}
else
{
$total_cost2_others = $total_cost2_others + $cost2;
}
}
$data .= '</td></tr>';
}

$data .= '</table>';
$data .= '</td>';
$data .= '<td valign="top" width="140px" colspan=2>';

$data .= '<table style="table-layout: fixed" width="140px" border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
$data .= '<tr>';
$resultall = $newreport->getCRN($myrow4crn[1],'Regular');
while($myrow4all=mysql_fetch_row($resultall))
{
$result2 = $newreport->getallGRN4Details($myrow4all[2],$myrow4all[0],$myrow4all[1],'Regular');
$num_rows = mysql_num_rows($result2);
if($num_rows=='0')
{
$data .= '<td bgcolor="#FFFFFF" align="center" width="70px"><span class="tabletext">&nbsp;</td>';
$data .= '</td></tr>';
}
while($myrow4grn=mysql_fetch_row($result2))
{
$result4 = $newreport->get_woretqty($myrow4grn[0]);  
$myrow= mysql_fetch_row($result4);
$balance=$myrow[1]+$myrow4grn[2]; 
if ($proc == 'Manufacture Only')
{
$total4grn = $total4grn + $balance;
$totalbalance =$totalbalance+$balance;
}
}
}
if ($proc == 'Manufacture Only')
{
    $data .= '<td bgcolor="#FFFFFF" width="70px" align="center"><span class="tabletext">';
	$data .=sprintf('%d',$totalbalance); 
	$data .='</td>';
	$results_c3 = $newreport->getrate4crn($myrow4crn[1]); 
	$numrows = mysql_num_rows($results_c3);	
    if($numrows=='0')
    {
     $data .= '<td bgcolor="#FFFFFF" align="right" width="70px"><span class="tabletext">&nbsp;</td>';  
    }
    while($myrow4c3=mysql_fetch_row($results_c3))
    {		
	  $cost3=($totalbalance*$myrow4c3[0]);
	   $data .= '<td bgcolor="#FFFFFF" width="70px" align="right"><span class="tabletext">';
	   $data .=sprintf('%s%s%d',$myrow4c3[1],' ',$cost3); 
	  $data .='</td>';	 
	   if($myrow4c3[1] == '$')
	   {
			$total_cost3_dol = $total_cost3_dol + $cost3;
	   }
	   else if($myrow4c3[1] == 'RS'|| $myrow4c3[1] == 'Rs')
	   {
			$total_cost3_re = $total_cost3_re + $cost3;
	   }
	   else 
	   {
			$total_cost3_others = $total_cost3_others + $cost3;
	   }
    }  
}
else
{
    $data .= '<td bgcolor="#FFFFFF" align="right" width="70px"><span class="tabletext">&nbsp;</td>'; 
	$data .= '<td bgcolor="#FFFFFF" align="right" width="70px"><span class="tabletext">&nbsp;</td>';
}
$data .= '</tr>'; 
$totalbalance='&nbsp';
$data .= '</table>';
$data .= '</td></tr>';
$data .= '<tr><td valign="top">';
}
}

$data .= '</table>';
$data .= '<table style="table-layout: fixed" width="700px" style="border:1px solid #000000;"  border=1 cellpadding=3 cellspacing=1 rules=all>';

$data .= '<tr bgcolor="#FFFFFF">';
$data .= '<td width="80px" bgcolor="#FFFFFF"><span class="tabletext"><b>Total</b></td>';
$data .= '<td align="center" width="150px" bgcolor="#FFFFFF"><span class="tabletext">&nbsp;</td>';
$data .= '<td align="center" width="70px" bgcolor="#FFFFFF"><span class="tabletext">';
$data .=sprintf('%d',$total); 
$data .='</td>';
$data .= '<td align="right" width="70px" bgcolor="#FFFFFF"><span class="tabletext">';
$data .=sprintf('%s%d','$ ',$total_cost1_dol); 
$data .='</td>';
$data .= '<td align="center" width="70px" bgcolor="#FFFFFF"><span class="tabletext">';
$data .=sprintf('%d',$total4dis); 
$data .='</td>';
$data .= '<td align="right" width="70px" bgcolor="#FFFFFF"><span class="tabletext">';
$data .=sprintf('%s%d','$ ',$total_cost2_dol); 
$data .='</td>';
$data .= '<td align="center" width="70px" bgcolor="#FFFFFF"><span class="tabletext">';
$data .=sprintf('%d',$total4grn); 
$data .='</td>';
$data .= '<td align="right" width="70px" bgcolor="#FFFFFF"><span class="tabletext">';
$data .=sprintf('%s%d','$ ',$total_cost3_dol); 
$data .='</td>';
$data .= '</tr>';

$data .= '<tr bgcolor="#FFFFFF">';
$data .= '<td width="80px" bgcolor="#FFFFFF"><span class="tabletext">&nbsp;</td>';
$data .= '<td align="center" width="150px" bgcolor="#FFFFFF"><span class="tabletext">&nbsp;</td>';
$data .= '<td align="center" width="70px" bgcolor="#FFFFFF"><span class="tabletext">&nbsp;</td>';
$data .= '<td align="right" width="70px" bgcolor="#FFFFFF"><span class="tabletext">';
$data .=sprintf('%s%d','Rs ',$total_cost1_re);
$data .='</td>';
$data .= '<td align="center" width="70px" bgcolor="#FFFFFF"><span class="tabletext">&nbsp;</td>';
$data .= '<td align="right" width="70px" bgcolor="#FFFFFF"><span class="tabletext">';
$data .=sprintf('%s%d','Rs ',$total_cost2_re);
$data .='</td>';
$data .= '<td align="center" width="70px" bgcolor="#FFFFFF"><span class="tabletext">&nbsp;</td>';
$data .= '<td align="right" width="70px" bgcolor="#FFFFFF"><span class="tabletext">';
$data .=sprintf('%s%d','Rs ',$total_cost3_re);
$data .='</td>';
$data .= '</tr>';

$data .= '<tr bgcolor="#FFFFFF">';
$data .= '<td width="80px" bgcolor="#FFFFFF"><span class="tabletext">&nbsp;</td>';
$data .= '<td align="center" width="150px" bgcolor="#FFFFFF"><span class="tabletext">&nbsp;</td>';
$data .= '<td align="center" width="70px" bgcolor="#FFFFFF"><span class="tabletext">&nbsp;</td>';
$data .= '<td align="right" width="70px" bgcolor="#FFFFFF"><span class="tabletext">';
$data .=sprintf('%s%d','Oth ',$total_cost1_others);
$data .='</td>';
$data .= '<td align="center" width="70px" bgcolor="#FFFFFF"><span class="tabletext">&nbsp;</td>';
$data .= '<td align="right" width="70px" bgcolor="#FFFFFF"><span class="tabletext">';
$data .=sprintf('%s%d','Oth ',$total_cost2_others);
$data .='</td>';
$data .= '<td align="center" width="70px" bgcolor="#FFFFFF"><span class="tabletext">&nbsp;</td>';
$data .= '<td align="right" width="70px" bgcolor="#FFFFFF"><span class="tabletext">';
$data .=sprintf('%s%d','Oth ',$total_cost3_others);
$data .='</td>';
$data .= '</tr>';    

$data .= '</tr>';
$data .= '</table>';
}
$data .= '</tr>';
$data .= '</table>';
header("Content-type: application/x-msdownload",true);
header("Content-Disposition: attachment;filename=CrnCostReport[$crn].xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
