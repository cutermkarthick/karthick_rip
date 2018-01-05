<?php
//==============================================
// Author: FSI                                 =
// Date-written = July 20, 2006                =
// Filename: new_leads.php                     =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new leads                   =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$_SESSION['pagename'] = 'summary';
$page = "CRM: Summary";
//session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/companyClass.php');
include('classes/leadsClass.php');
include('classes/displayClass.php');
$newLeads = new leads;
$newdisplay = new display;
$newCustomer = new company;

?>



<html>
<head>



<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/leads.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>New Lead</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">


</div>
<form action='processleads.php' method='post' >
<?php
include('header.html');
?>

      <td bgcolor="#FFFFFF">

        <table width=100% border=0 cellpadding=6 cellspacing=0  >
     <tr>
        <td><span class="pageheading"><b>  </b></td>
     </tr>
  
<table width=100% border=0>
<div class="contenttitle radiusbottom0">
<h2><span>Dashboard
<!-- 
  <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='import_salesleads.php'" value="Import" >

	<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='export_salesleads.php?stage=<?echo $sval?>&country=<?echo $country?>&industry=<?echo $industry?>&product=<?echo $product?>&precent=<?echo $precent?>'" value="Export" >

		<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='new_leads.php'" value="New Leads" > -->
</h2>
</span>
</td>
</tr>
</table>

<table style="table-layout: fixed;width:100%"  border=0 cellpadding=3 cellspacing=1 class="stdtable" >
	
	<thead>
<tr> <img src="images/button1.jpg" alt="banner" width="100%" height="40px"/>
<!-- <th  style="width:168px;" class="head0"><span class="tabletext"><b>Leads</b></th>
<th  style="width:168px;"  class="head1"><span class="tabletext"><b>Connected Lead</b></th>
<th  style="width:168px;" class="head0"><span class="tabletext"><b>Meeting</b></th>
<th  style="width:168px;" class="head0"><span class="tabletext"><b>Enquiry</b></th>
<th  style="width:168px;" class="head1"><span class="tabletext"><b>Request for Proposal</b></th>
<th  style="width:160px;" class="head1"><span class="tabletext"><b>Negotiation</b></th>
 --></thead>
 </tr>

</table>

<div style="width:101%; height:350; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed;width:100%" border=0 cellpadding=3 cellspacing=1 class="stdtable">

<?php
$result = $newLeads->getAllleads();

while ($row = mysql_fetch_assoc($result)) {
	//print_r($row);

if($row['contacted_date']!='0000-00-00'||$row['contacted_date']!='')
{
	$d=substr($row['contacted_date'],8,2);
    $m=substr($row['contacted_date'],5,2);
    $y=substr($row['contacted_date'],0,4);
    $x=mktime(0,0,0,$m,$d,$y);
    $contacted_date=date("M j Y",$x);

}
else
{
	$contacted_date='';
}
if($row['meeting_date']!='0000-00-00'||$row['meeting_date']!='')
{
	$d=substr($row['meeting_date'],8,2);
    $m=substr($row['meeting_date'],5,2);
    $y=substr($row['meeting_date'],0,4);
    $x=mktime(0,0,0,$m,$d,$y);
    $meeting_date=date("M j, Y",$x);

}
else
{
	$meeting_date='';
}
if($row['create_date']!='0000-00-00'||$row['create_date']!='')
{
	$d=substr($row['create_date'],8,2);
    $m=substr($row['create_date'],5,2);
    $y=substr($row['create_date'],0,4);
    $x=mktime(0,0,0,$m,$d,$y);
    $create_date=date("M j, Y",$x);

}
else
{
	$create_date='';
}
if($row['proposal_date']!='0000-00-00'||$row['proposal_date']!='')
{
	$d=substr($row['proposal_date'],8,2);
    $m=substr($row['proposal_date'],5,2);
    $y=substr($row['proposal_date'],0,4);
    $x=mktime(0,0,0,$m,$d,$y);
    $proposal_date=date("M j, Y",$x);

}
else
{
	$proposal_date='';
}
if($row['negotiate_date']!='0000-00-00'||$row['negotiate_date']!='')
{
	$d=substr($row['negotiate_date'],8,2);
    $m=substr($row['negotiate_date'],5,2);
    $y=substr($row['negotiate_date'],0,4);
    $x=mktime(0,0,0,$m,$d,$y);
    $negotiate_date=date("M j, Y",$x);

}
else
{
	$negotiate_date='';
}        
$name=wordwrap($row['name'], 20, "<br />\n");
//echo $name.",".$contacted_date;
if($row['opp_stagenum']>=150)
{
	$lead=$name;$contacted=$contacted_date;$meet=$meeting_date;$enq=$create_date;
	$proposal=$proposal_date;$negotiate=$negotiate_date;
}
else if($row['opp_stagenum'] == 140)
 {
	
	$lead=$row['name'];$contacted=$contacted_date;$meet=$meeting_date;$enq=$create_date;
	$proposal=$proposal_date;$negotiate='';
 }
 else if($row['opp_stagenum']>100 && $row['opp_stagenum']<=130)
 {
	
	$lead=$row['name'];$contacted=$contacted_date;$meet=$meeting_date;$enq=$create_date;
	$proposal='';$negotiate='';
 }
 else if($row['stage_num']>=60 && ($row['opp_stagenum']=='' || $row['oppstagenum']==0))
 {
	
	$lead=$row['name'];$contacted=$contacted_date;$meet=$name."-".$meeting_date;$enq='';
	$proposal='';$negotiate='';
 }
else if($row['stage_num']<60 && $row['stage_num']>=20 && ($row['opp_stagenum']=='' || $row['oppstagenum']==0))
 {
	
	$lead=$row['name'];$contacted=$row['name']."-".$contacted_date;$meet='';$enq='';
	$proposal='';$negotiate='';
 }
 else if(($row['stage_num']==10 || $row['stage_num']=='')&& ($row['opp_stagenum']=='' || $row['oppstagenum']==0))
 {
 $lead=$name;$contacted='';$meet='';$enq='';
	$proposal='';$negotiate='';	
 }
//echo "here".$contacted;
// else if($row['stage'] == "Contacted")
// {
//   $bgcolor = "#D3D3D3"; 
// }
// else if($row['stage'] == 'Interacted')
// {
//    $bgcolor = "#FFFF00"; 
// }else if($row['stage'] == 'Interest')
// {
//   $bgcolor = "#00FFFF"; 
// }
// else
// {
//   $bgcolor = "#FFFFFF";  
// }


// $company1= wordwrap($row["company"],20,"<br>",true);
// $name1= wordwrap($row["name"],15,'<br>',true);
// $email1= wordwrap($row["email"],15,'<br>',true);
// $industry_segment1= wordwrap($row["industry_segment"],15,'<br>',true);
printf('<tr>
<td align="center" style="width:190px;"><span class="tabletext">%s</td>
<td align="center" style="width:165px;"><span class="tabletext">%s</td>
<td align="center" style="width:163px;"><span class="tabletext">%s</td>
<td align="center" style="width:165px;"><span class="tabletext">%s</td>
<td align="center" style="width:165px;"><span class="tabletext">%s</td>
<td align="center" style="width:163px;"><span class="tabletext">%s</td>
',
$lead,
$contacted,
$meet,
$enq,
$proposal,
$negotiate);
printf('</td></tr>');
$i++;}
?>


</table>
</div>
