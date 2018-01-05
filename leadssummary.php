<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2006                =
// Filename: leadssummary.php                  =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Displays list of Leads.                     =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];
$_SESSION['pagename'] = 'leadssummary';
$page = "CRM: Leads";
//session_register('pagename');
//Following code added to implement search,sort  and Pagination on Dec 29-04 by Jerry George

$cond5 = "name like '%'";
$sort1='name';
$select='name';
$worec='';
$where1='';
$oper='like';



if ( isset ( $_REQUEST['sleads'] ) )
{

     $name = $_REQUEST['sleads'];
     $cond6 = "name like '" . $name .  "%'";
     
}
else
{
  $cond6 = "name like '%'";
}

if ( isset ( $_REQUEST['sortfld1'] ) )
{
$sort1 = $_REQUEST['sortfld1'];
}


if ( isset ( $_REQUEST['stage_val'] ) )
{

     $sval = $_REQUEST['stage_val'];
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

if ( isset ( $_REQUEST['percent_val'] ) )
{

     $percent = $_REQUEST['percent_val'];
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


if(isset($_REQUEST['industry']))
{
  $industry = $_REQUEST['industry'];
if($industry == "all")
{

 $cond3 = "(industry_segment IS NULL or industry_segment  like " . "'%')";  
}
else
{
 $cond3 = "industry_segment = '". $industry . "'";
}
}
else
{
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

// echo "industry " .$industry;
$cond = $cond5 ." and  " .$cond0." and  " .$cond1." and  " .$cond2." and  " .$cond3." and  " .$cond4." and  " .$cond6;

// how many rows to show per page
$rowsPerPage = 10;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
$pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
$totpages = $_REQUEST['totpages'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/leadsClass.php');
include_once('classes/displayClass.php');
$newLeads = new leads;
$newdisplay = new display;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/leads.js"></script>
<html>
<head>
<title>Leads Summary</title>
</head>
<?php
include('header.html');
?>
<form action='leadssummary.php?sleads=$leads_match&leads_oper=$oper&sortfld1=$sort1&sleadsfl=$where1' method='post' enctype='multipart/form-data'>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=3>
<tr><td><span class="heading"><i>Please click on leads to Edit/Delete</i></td></tr>
<tr>
<td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<tr>
<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
<td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></td>
<td bgcolor="#FFFFFF" rowspan=3 align="center">
<button  class="stdbtn btn_blue" style="background-color:#0591e5" onclick="javascript: return searchsort_fields()">Get</button>
</td>
</tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Name</b></td>
<td bgcolor="#FFFFFF"><input type="text" name="sleads" id="sleads" size=20 value="<?php echo $name?>" onkeypress="javascript: return checkenter(event)"></td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>Stage &nbsp</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="tabletext"><select name="stage_val" size="1" width="100">
<?php
      if ($sval == 'Not Contacted')
      {
?>
<OPTION value='Not Contacted' selected>Not Contacted</OPTION>
<OPTION value='First Email'>First Email</OPTION>
<OPTION value='Subsequent Email'>Subsequent Email</OPTION>
<OPTION value='Call'>Call</OPTION>
<OPTION value='Unsubscribe'>Unsubscribe</OPTION>
<OPTION value='All'>All</OPTION></select>
<?php
      }
      else if ($sval == 'First Email')
      {
?>
<OPTION value='Not Contacted' >Not Contacted</OPTION>
<OPTION value='First Email' selected>First Email</OPTION>
<OPTION value='Subsequent Email'>Subsequent Email</OPTION>
<OPTION value='Call'>Call</OPTION>
<OPTION value='Unsubscribe'>Unsubscribe</OPTION>
<OPTION value='All'>All</OPTION></select>
<?php
      }
      else if ($sval == 'Subsequent Email')
      {
?>
<OPTION value='Not Contacted' >Not Contacted</OPTION>
<OPTION value='First Email' >First Email</OPTION>
<OPTION value='Subsequent Email' selected>Subsequent Email</OPTION>
<OPTION value='Call'>Call</OPTION>
<OPTION value='Unsubscribe'>Unsubscribe</OPTION>
<OPTION value='All'>All</OPTION></select>
<?php
      }
      else if ($sval == 'Call')
      {
?>
<OPTION value='Not Contacted' >Not Contacted</OPTION>
<OPTION value='First Email' >First Email</OPTION>
<OPTION value='Subsequent Email' >Subsequent Email</OPTION>
<OPTION value='Call' selected>Call</OPTION>
<OPTION value='Unsubscribe'>Unsubscribe</OPTION>
<OPTION value='All'>All</OPTION></select>
<?php
}
 else if ($sval == 'All')
 {
?>
<OPTION value='All' selected>All</OPTION>
<OPTION value='Not Contacted' >Not Contacted</OPTION>
<OPTION value='First Email' >First Email</OPTION>
<OPTION value='Subsequent Email' >Subsequent Email</OPTION>
<OPTION value='Unsubscribe'>Unsubscribe</OPTION>
<OPTION value='Call'>Call</OPTION></select>

<?php 
} 
else if ($sval == 'Unsubscribe')
{
?>
<OPTION value='All'>All</OPTION>
<OPTION value='Not Contacted' >Not Contacted</OPTION>
<OPTION value='First Email' >First Email</OPTION>
<OPTION value='Subsequent Email' >Subsequent Email</OPTION>
<OPTION value='Unsubscribe' selected>Unsubscribe</OPTION>
<OPTION value='Call'>Call</OPTION></select>
<?php
}
?>
  
</select>
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="tabletext"><select name="sort1" size="1" width="100">
<option selected>name
</select>
<input type="hidden" name="sortfld1">
<input type="hidden" name="sleadsfl">
<input type="hidden" name="leads_oper">
</td>
</tr>

<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Percentage &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp</b><span class="tabletext"><select name="percent_val" size="1" width="100">


<?php
      if ($percent == 0)
      {
?>
<OPTION value='0' selected>0</OPTION>
<OPTION value='10'>10</OPTION>
<OPTION value='20'>20</OPTION>
<OPTION value='30'>30</OPTION>
<OPTION value='40'>40</OPTION>
<OPTION value='50'>50</OPTION>
<OPTION value='60'>60</OPTION>
<OPTION value='70'>70</OPTION>
<OPTION value='80'>80</OPTION>
<OPTION value='90'>90</OPTION>
<OPTION value='100'>100</OPTION>
<?php
      }
      else  if ($percent == 10)
      {
?>
<OPTION value='0'>0</OPTION>
<OPTION value='10' selected>10</OPTION>
<OPTION value='20'>20</OPTION>
<OPTION value='30'>30</OPTION>
<OPTION value='40'>40</OPTION>
<OPTION value='50'>50</OPTION>
<OPTION value='60'>60</OPTION>
<OPTION value='70'>70</OPTION>
<OPTION value='80'>80</OPTION>
<OPTION value='90'>90</OPTION>
<OPTION value='100'>100</OPTION>
<?php
      }
      else  if ($percent == 20)
      {
?>
<OPTION value='0'>0</OPTION>
<OPTION value='10'>10</OPTION>
<OPTION value='20' selected>20</OPTION>
<OPTION value='30'>30</OPTION>
<OPTION value='40'>40</OPTION>
<OPTION value='50'>50</OPTION>
<OPTION value='60'>60</OPTION>
<OPTION value='70'>70</OPTION>
<OPTION value='80'>80</OPTION>
<OPTION value='90'>90</OPTION>
<OPTION value='100'>100</OPTION>
<?php
      }
      else if ($percent == 30)
      {
?>
<OPTION value='0'>0</OPTION>
<OPTION value='10'>10</OPTION>
<OPTION value='20'>20</OPTION>
<OPTION value='30' selected>30</OPTION>
<OPTION value='40'>40</OPTION>
<OPTION value='50'>50</OPTION>
<OPTION value='60'>60</OPTION>
<OPTION value='70'>70</OPTION>
<OPTION value='80'>80</OPTION>
<OPTION value='90'>90</OPTION>
<OPTION value='100'>100</OPTION>
<?php
}
 else  if ($percent == 40)
 {
?>
<OPTION value='0'>0</OPTION>
<OPTION value='10'>10</OPTION>
<OPTION value='20'>20</OPTION>
<OPTION value='30'>30</OPTION>
<OPTION value='40' selected>40</OPTION>
<OPTION value='50'>50</OPTION>
<OPTION value='60'>60</OPTION>
<OPTION value='70'>70</OPTION>
<OPTION value='80'>80</OPTION>
<OPTION value='90'>90</OPTION>
<OPTION value='100'>100</OPTION>

<?php 
} 
else  if ($percent == 50)
{
?>
<OPTION value='0'>0</OPTION>
<OPTION value='10'>10</OPTION>
<OPTION value='20'>20</OPTION>
<OPTION value='30'>30</OPTION>
<OPTION value='40'>40</OPTION>
<OPTION value='50' selected>50</OPTION>
<OPTION value='60'>60</OPTION>
<OPTION value='70'>70</OPTION>
<OPTION value='80'>80</OPTION>
<OPTION value='90'>90</OPTION>
<OPTION value='100'>100</OPTION>
<?php
}

  
  else  if ($percent == 60)
{
?>
<OPTION value='0'>0</OPTION>
<OPTION value='10'>10</OPTION>
<OPTION value='20'>20</OPTION>
<OPTION value='30'>30</OPTION>
<OPTION value='40'>40</OPTION>
<OPTION value='50'>50</OPTION>
<OPTION value='60' selected>60</OPTION>
<OPTION value='70'>70</OPTION>
<OPTION value='80'>80</OPTION>
<OPTION value='90'>90</OPTION>
<OPTION value='100'>100</OPTION>
<?php
}

  
  else  if ($percent == 70)
{
?>
<OPTION value='0'>0</OPTION>
<OPTION value='10'>10</OPTION>
<OPTION value='20'>20</OPTION>
<OPTION value='30'>30</OPTION>
<OPTION value='40'>40</OPTION>
<OPTION value='50'>50</OPTION>
<OPTION value='60'>60</OPTION>
<OPTION value='70' selected>70</OPTION>
<OPTION value='80'>80</OPTION>
<OPTION value='90'>90</OPTION>
<OPTION value='100'>100</OPTION>
<?php
}

  
  else  if ($percent == 80)
{
?>
<OPTION value='0'>0</OPTION>
<OPTION value='10'>10</OPTION>
<OPTION value='20'>20</OPTION>
<OPTION value='30'>30</OPTION>
<OPTION value='40'>40</OPTION>
<OPTION value='50'>50</OPTION>
<OPTION value='60'>60</OPTION>
<OPTION value='70'>70</OPTION>
<OPTION value='80' selected>80</OPTION>
<OPTION value='90'>90</OPTION>
<OPTION value='100'>100</OPTION>
<?php
}

  
  else  if ($percent == 90)
{
?>
<OPTION value='0'>0</OPTION>
<OPTION value='10'>10</OPTION>
<OPTION value='20'>20</OPTION>
<OPTION value='30'>30</OPTION>
<OPTION value='40'>40</OPTION>
<OPTION value='50'>50</OPTION>
<OPTION value='60'>60</OPTION>
<OPTION value='70'>70</OPTION>
<OPTION value='80'>80</OPTION>
<OPTION value='90' selected>90</OPTION>
<OPTION value='100'>100</OPTION>
<?php
}

  
  else  if ($percent == 100)
{
?>
<OPTION value='0'>0</OPTION>
<OPTION value='10'>10</OPTION>
<OPTION value='20'>20</OPTION>
<OPTION value='30'>30</OPTION>
<OPTION value='40'>40</OPTION>
<OPTION value='50'>50</OPTION>
<OPTION value='60'>60</OPTION>
<OPTION value='70'>70</OPTION>
<OPTION value='80'>80</OPTION>
<OPTION value='90'>90</OPTION>
<OPTION value='100' selected>100</OPTION>
<?php
}
?>
  
</select> 


</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Country &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp</b><span class="tabletext">


<?php        
$result=$newLeads->getAllcountry();        
?>
<select name="country">
<!-- <option value="select" selected>Select</option> -->
<option <?php echo ($country=='all')?'selected=selected':'';?> value="all">ALL</option>
<?php
while ($myrow = mysql_fetch_row($result))
{
if($myrow[0]==$_REQUEST['country']){


?>
<option selected value="<? echo $myrow[0]?>">
<?echo $myrow[0]; ?> </option>
<?
}
else
{
 ?>
<option value="<? echo $myrow[0]?>">
<?echo $myrow[0];?> </option>
<?php
}
}
?>
</select>
</span>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>Industry &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp</b><span class="tabletext">

<select name="industry">
<!-- <option value="select">Select</option> -->
<option value='all' <?php echo ($industry == 'all') ? 'selected=selected' : ''; ?>>ALL
<?php        
$result=$newLeads->getAllindustry();        
while ($myrow = mysql_fetch_row($result))
{
if($myrow[0]==$_REQUEST['industry']){
?>
<option selected value="<?php echo $myrow[0]?>">
<?echo $myrow[0]; ?> </option>
<?
}
else
{
 ?>
<option value="<?php echo $myrow[0]?>">
<?echo $myrow[0];?> </option>
<?php
}
}
?>
</select></span>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Product Interest &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp</b><span class="tabletext">


<?php        
$result=$newLeads->getAllproduct();        
?>
<select name="product">
<!-- <option value="select" selected>Select</option> -->
<option  value='all' <?php echo ($product=='all') ? 'selected=selected' : '';?>>ALL</option>
<?php
while ($myrow = mysql_fetch_row($result))
{
if($myrow[0]==$_REQUEST['product']){


?>
<option selected value="<? echo $myrow[0]?>">
<?echo $myrow[0]; ?> </option>
<?
}
else
{
 ?>
<option value="<? echo $myrow[0]?>">
<?echo $myrow[0];?> </option>
<?php
}
}
?>
</select></span>
<td bgcolor="#FFFFFF" colspan="5"></td>
</tr>




<table width=100% border=0>
<div class="contenttitle radiusbottom0">
<h2><span>Leads

  <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='import_salesleads.php'" value="Import" >

	<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='export_salesleads.php?stage=<?echo $sval?>&country=<?echo $country?>&industry=<?echo $industry?>&product=<?echo $product?>&precent=<?echo $precent?>'" value="Export" >

		<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='new_leads.php'" value="New Leads" >
</h2>
</span>
</td>
</tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable" >
	<thead>
<tr>
<th  class="head0" style="width:5%"><span class="tabletext"><b>Sl No</b></th>
<th  class="head0"><span class="tabletext"><b>Name</b></th>
<th  class="head1"><span class="tabletext"><b>Title</b></th>
<th  class="head0"><span class="tabletext"><b>Company</b></th>

<th  class="head0"><span class="tabletext"><b>Industry</b></th>
<th  class="head1"><span class="tabletext"><b>Product Interest</b></th>

<th  class="head1"><span class="tabletext"><b>Email</b></th>
<th  class="head0"><span class="tabletext"><b>Stage</b></th>
<th  class="head1"><span class="tabletext"><b>Country</b></th>
<th  class="head1"><span class="tabletext"><b>%</b></th>

</thead>
<?php
//$result = $newLeads->getleadssearch($cond,$sort1,$offset,$rowsPerPage);
$result = $newLeads->getLeads($cond,$offset,$rowsPerPage);
while ($row = mysql_fetch_assoc($result)) {

if($row['stage'] == "Unsubscribe")
{
	$bgcolor = "#FF0000";
}
else if($row['stage'] == "Contacted")
{
  $bgcolor = "#D3D3D3"; 
}
else if($row['stage'] == 'Interacted')
{
   $bgcolor = "#FFFF00"; 
}else if($row['stage'] == 'Interest')
{
  $bgcolor = "#00FFFF"; 
}
else
{
  $bgcolor = "#FFFFFF";  
}


$company1= wordwrap($row["company"],20,"<br>",true);
$name1= wordwrap($row["name"],15,'<br>',true);
$email1= wordwrap($row["email"],15,'<br>',true);
$industry_segment1= wordwrap($row["industry_segment"],15,'<br>',true);
printf('<tr bgcolor=%s width="5%%"><td align="center" ><span class="tabletext">
<a href="leadsDetails.php?leadsrecnum=%s">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</a></td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>
<td align="center"><span class="tabletext">%s</td>

',
$bgcolor,$row["recnum"],
$row["recnum"],$name1,
$row["title"],
$company1,
$industry_segment1,
$row["product_interest"],
$email1,
$row["stage"],
$row["country"],
$row["percent"]



);
printf('</td></tr>');
}
?>


</table>
</table>
</table>

<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
<td align=left>


<?php

//$numrows=mysql_num_rows($result);

//Additions on Dec 29 04 by Jerry George to implement pagination

$numrows = $newLeads ->getleadsCount($cond,$offset,$rowsPerPage);
// how many pages we have when using paging?
//echo   $numrows;
$maxPage = ceil($numrows/$rowsPerPage);

if (!isset($_REQUEST['page']))
{
$totpages = $maxPage;
}

$self = $_SERVER['PHP_SELF'];

// creating 'previous' and 'next' link
// plus 'first page' and 'last page' link

// print 'previous' link only if we're not
// on page one
if ($pageNum > 1)
{
$page = $pageNum - 1;
$prev = " <a href=\"leadssummary.php?page=$page&totpages=$totpages&sleads=$leads_match&sleadsfl=$where1&leadst_oper=$oper&stage=$stage&country=$country&industry=$industry&product=$product&percent=$percent\">[Prev]</a> ";

$first = " <a href=\"leadssummary.php?page=1&totpages=$totpages&sleads=$leads_match&sleadsfl=$where1&leads_oper=$oper&stage=$stage&country=$country&industry=$industry&product=$product&percent=$percent\">[First Page]</a> ";
}
else
{
$prev  = ' [Prev] ';       // we're on page one, don't enable 'previous' link
$first = ' [First Page] '; // nor 'first page' link
}

// print 'next' link only if we're not
// on the last page
if ($pageNum < $totpages)
{
$page = $pageNum + 1;
$next = " <a href=\"leadssummary.php?page=$page&totpages=$totpages&sleads=$leads_match&sleadsfl=$where1&leads_oper=$oper&stage=$stage&country=$country&industry=$industry&product=$product&percent=$percent\">[Next]</a> ";

$last = " <a href=\"leadssummary.php?page=$totpages&totpages=$totpages&sleads=$leads_match&sleadsfl=$where1&leads_oper=$oper&stage=$stage&country=$country&industry=$industry&product=$product&percent=$percent\">[Last Page]</a> ";
}
else
{
$next = ' [Next] ';      // we're on the last page, don't enable 'next' link
$last = ' [Last Page] '; // nor 'last page' link
}

if($totpages!=0)
{
//$pageNum=0;
// print the page navigation link
echo "<span class=\"labeltext\">" . $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$totpages</strong> pages " . $next . $last;
}
else
echo "<span class=\"labeltext\"><align=\"center\">No matching records found";

// End additions on Dec 29,04


?>
</td>
</tr></table>

</FORM>
</body>
</html >