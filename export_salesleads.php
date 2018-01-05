<?php
//==============================================
// Author: FSI                                                                      =
// Date-written = June 12, 2013                                           =
// Copyright (C) FluentSoft Inc.                                          =
// Contact bmandyam@fluentsoft.com                               =
// Revision: v1.0 OWT                                                          =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}

// $stage=$_REQUEST['stage'];
// $country=$_REQUEST['country'];
// $industry=$_REQUEST['industry'];
// $product=$_REQUEST['product'];
// $precent=$_REQUEST['percent'];
// echo $dcnum;exit;
if ( isset ( $_REQUEST['stage'] ) )
{

     $sval = $_REQUEST['stage'];
     if ($sval == 'All')
     {
          $cond0 = "(stage IS NULL or stage  like " . "'%')";
     }
     else if ($sval == 'Not Contacted')
     {
         $cond0 = "stage = '". $sval . "'";
     }
     else if ($sval == 'First Email')
     {
       $cond0 = "stage = '". $sval . "'";
     }
     else if ($sval == 'Subsequent Email')
     {
         $cond0 = "stage = '". $sval . "'";
     }
     else if ($sval == 'Call')
     {
         $cond0 = "stage = '". $sval . "'";
     }
     else if ($sval == 'Unsubscribe')
     {
         $cond0 = "stage = '". $sval . "'";
     }
}
else
{
     $sval = 'All';
         $cond0 = "(stage IS NULL or stage  like " . "'%')";
}
if ( isset ( $_REQUEST['percent'] ) )
{

     $percent = $_REQUEST['percent'];
     if ($percent == 0)
     {
          $cond1 = "(percent IS NULL or percent  like " . "'%')";
     }
     else if ($percent == 10)
     {
         $cond1 = "percent = '". $percent . "'";
     }
     else if ($percent == 20)
     {
       $cond1 = "percent = '". $percent . "'";
     }
     else if ($percent == 30)
     {
         $cond1 = "percent = '". $percent . "'";
     }
     else if ($percent == 40)
     {
         $cond1 = "percent = '". $percent . "'";
     }
     else if ($percent == 50)
     {
         $cond1 = "percent = '". $percent . "'";
     }
     else if ($percent == 60)
     {
         $cond1 = "percent = '". $percent . "'";
     }
     else if ($percent == 70)
     {
         $cond1 = "percent = '". $percent . "'";
     }
     else if ($percent == 80)
     {
         $cond1 = "percent = '". $percent . "'";
     }
     else if ($percent == 90)
     {
         $cond1 = "percent = '". $percent . "'";
     }
     else if ($percent == 100)
     {
         $cond1 = "percent = '". $percent . "'";
     }

}
else
{
     $percent = 0;
         $cond1 = "(percent IS NULL or percent  like " . "'%')";
}



if(isset($_REQUEST['country'])){
$country = $_REQUEST['country'];
if($country == "all")
{

 $cond2 = "(country IS NULL or country  like " . "'%')";  
}else
{
 $cond2 = "country = '". $country . "'";
}
}
else{
$country = "all";
$cond2 = "(country IS NULL or country  like " . "'%')";
}


if(isset($_REQUEST['industry'])){
$industry = $_REQUEST['industry'];
if($industry == "all")
{

 $cond3 = "(industry_segment IS NULL or industry_segment  like " . "'%')";  
}else
{
 $cond3 = "industry_segment = '". $industry . "'";
}
}
else{
$industry = "all";
$cond3 = "(industry_segment IS NULL or industry_segment  like " . "'%')";
}

if(isset($_REQUEST['product'])){
$product = $_REQUEST['product'];
if($product == "all")
{

 $cond4 = "(product_interest IS NULL or product_interest  like " . "'%')";  
}else
{
 $cond4 = "product_interest = '". $product . "'";
}
}
else{
$product = "all";
$cond4 = "(product_interest IS NULL or product_interest  like " . "'%')";
}


$cond=$cond0." and  " .$cond1." and  " .$cond2." and  " .$cond3." and  " .$cond4;


$header='';
$data='';
$leadsData="";
// First include the class definition
include_once('classes/loginClass.php');
include_once('classes/leadsClass.php');


$newlogin = new userlogin;
$newLeads = new leads;


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
$data.='<body>';


$curdate = date("Y-m-d");
$datearr = split('-',$curdate);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $cur_date=date("M j, Y",$x);
$title="Leads Details - Exported on  ".$cur_date;

$data.='<table border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td colspan=9 bgcolor="#00DDFF" align="center"><span class="tabletext"><font size="3" ><b>';
$data.=$title.'</b></font>';
$data.='</td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';

$data.='<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">';
$data.='<tr>';
$data.='<td bgcolor="#F3F781" ><span class="heading"><b>Name</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Title</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Company</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Industry</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Product Interest</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Email</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Stage</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Country</b></td>';
$data.='<td bgcolor="#F3F781"><span class="heading"><b>Percent</b></td>';
$data.='</tr>';


$result = $newLeads->getLeadsExport($cond);
if(!empty($result))
{ 
while ($myrow = mysql_fetch_assoc($result))
{ 


$data.='<tr>';
$data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$myrow['name'].'</td>';
$data.='<td bgcolor="#FFFFFF" ><span class="tabletext">'.$myrow['title'].'</td>';
$data.='<td bgcolor="#FFFFFF" ><span class="tabletext">'.$myrow['company'].'</td>';
$data.='<td bgcolor="#FFFFFF" ><span class="tabletext">'.$myrow['industry_segment'].'</td>';
$data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$myrow['product_interest'].'</td>';
//                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty</td>";
$data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$myrow['email'].'</td>';
$data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$myrow['stage'].'</td>';
$data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$myrow['country'].'</td>';
$data.='<td bgcolor="#FFFFFF"><span class="tabletext">'.$myrow['percent'].'</td>';
$data.='</tr>';

}  
}

$data.='</table>';
$data.='</body></html>';


header("Content-type: application/x-msdownload",true);
header("Content-Disposition: attachment; filename=salesleadsDetails.xls",false);
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
?>
