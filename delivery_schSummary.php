<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: July 18, 2008                 =
// Filename: production_sch.php                =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Board details                               =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}

// Includes
include_once('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/delivery_schClass.php');

$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'delivery_sch';
$page = "MES: delivery Sch";
// $_SESSION['pageval'] = "PPC: delivery Sch";
//////session_register('pagename');
$newlogin = new userlogin;
$newlogin->dbconnect();
$newdisplay = new display;
$newdelivery_sh = new deliverye_sch;
$rowsPerPage =100;
$dept = $_SESSION['department'];
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

if (isset($_REQUEST['crnnum'])) 
{
    $crn=$_REQUEST['crnnum'];  
    $shedule_date=$_REQUEST['shedule_date'];
}
else {
	   $crn = '';
}

 $cond='where';		
       if($_REQUEST['crnnum']=='' && $_REQUEST['schedule_date1']=='' && $_REQUEST['schedule_date2']=='' && $_REQUEST['status_val']=='')
       {
             $sval = 'Open';
	     $cond = "where (status = '" . $sval . "' || status is NULL || status = '')";
       } 
       if($_REQUEST['crnnum']!='')
       {	
		$crnnum = "'" . $_REQUEST['crnnum'] . "%" . "'";
		$cond .= ' crnnum like '.$crnnum;
       }
      if($_REQUEST['schedule_date1']!='' && $_REQUEST['schedule_date2']!='')
      {	
		if($cond!='where'){	
		$schedule_date1 = "'" . $_REQUEST['schedule_date1']  . "'";
        $sdate1= $_REQUEST['schedule_date1'];
        $schedule_date2 = "'" . $_REQUEST['schedule_date2']  . "'";
        $sdate2= $_REQUEST['schedule_date2'];
		$cond .=  ' and '.' schedule_date between '.$schedule_date1 .' and '.$schedule_date2;
		}
		else
		{
        $sdate1= $_REQUEST['schedule_date1'];
        $sdate2= $_REQUEST['schedule_date2'];
		$schedule_date1 = "'" . $_REQUEST['schedule_date1']  . "'";
                $schedule_date2 = "'" . $_REQUEST['schedule_date2']  . "'";
		$cond .= ' schedule_date between '.$schedule_date1.' and '.$schedule_date2;
		}
		}


		if($_REQUEST['schedule_date1']!='' && $_REQUEST['schedule_date2'] =='')
	       {
		$schedule_date2= date("Y-m-d");
		$sdate1= $_REQUEST['schedule_date1'];
		 $sdate2= $_REQUEST['schedule_date2'];
		if($cond!='where'){	
		$schedule_date1 = "'" . $_REQUEST['schedule_date1'] . "'";
                $schedule_date2 = "'" . $schedule_date2. "'";
		$cond .=  ' and '.'schedule_date between '.$schedule_date1 .' and '.$schedule_date2;
		}
		else
		{
        $sdate1= $_REQUEST['schedule_date1'];
		 $sdate2= $_REQUEST['schedule_date2'];
		$schedule_date1 = "'" . $_REQUEST['schedule_date1'] . "'";
                $schedule_date2 = "'" . $schedule_date2 . "'";
		$cond .= ' schedule_date between '.$schedule_date1.' and '.$schedule_date2;
		}
	}

        if($_REQUEST['status_val']!= '')
        {
          	$sval = $_REQUEST['status_val'];  	
           if($cond!='where')
          {	
      		if ($sval == 'Open')
      		{
         		$cond .= " and (status =  '" . $sval . "' || status is NULL || status = '')";
      		}
     		else if ($sval == 'Closed')
      		{
         		$cond .= " and status = '" . $sval . "'" ;
      		}
     		else if ($sval == 'All')
     		{
        		 $cond .= " and (status like '%' || status is NULL)";
      		}   
      		else if ($sval == 'Cancelled')
      		{
         		$cond .= " and  status = '" . $sval . "'" ;
     		} 
            }
            else
            {
                	if ($sval == 'Open')
      		{
         		$cond .= " (status =  '" . $sval . "' || status is NULL || status = '')";
      		}
     		else if ($sval == 'Closed')
      		{
         		$cond .= " status = '" . $sval . "'" ;
      		}
     		else if ($sval == 'All')
     		{
        		 $cond .= " (status like '%' || status is NULL)";
      		}   
      		else if ($sval == 'Cancelled')
      		{
         		$cond .= " status = '" . $sval . "'" ;
     		} 
            }
	}
?>
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/delivery_sch.js"></script>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>Delivery Schedule</title>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0">
<?php
include('header.html');
?>

<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=1  >
<tr>
<td><span class="pageheading"><b>Delivery Schedule</b></td>
</tr>
<form action='delivery_schSummary.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table style="width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Delivery Schedule Header</b></center></td>
</tr>
<table style="width:100%"  border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">PRN #</p></font></td>
<td><span class="tabletext"><input type="text" name="crnnum" size=10 value="<?php echo $_REQUEST['crnnum']?>"></td>

<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sch Date:  From &nbsp&nbsp</b></td>
<td bgcolor="#FFFFFF"><span class="labeltext">
<input type="text" name="schedule_date1" size=10 value="<?php echo $_REQUEST['schedule_date1'];?>"
<input type="hidden" name="schedule_date1" size=10 value="<?php echo $sdate1; ?>"
onkeypress="javascript: return checkenter(event)"><img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("schedule_date1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="schedule_date2" size=10 value="<?php echo $_REQUEST['schedule_date2']; ?>"
        <input type="hidden" name="schedule_date2" size=10 value="<?php echo $sdate2; ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("schedule_date2")'>
<input type="hidden" name="action" value="new">
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Status 
</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="tabletext"><select name="status_val" size="1" width="50">
<?php
      if ($sval == 'Open')
      {
?>
	<option selected='Open'>Open
	<option value='Closed'>Closed
	<option value='Cancelled'>Cancelled
    <option value='All'>All
<?php
      }
      else if ($sval == 'Closed')
      {
?>
	<option selected='Closed'>Closed
	<option value='Open'>Open
	<option value='Cancelled'>Cancelled
    <option value='All'>All
<?php
      }
      else if ($sval == 'Cancelled')
      {
?>
	<option selected='Cancelled'>Cancelled
	<option value='Open'>Open
    <option value='Closed'>Closed
    <option value='All'>All
<?php
      }
      else if ($sval == 'All')
      {
?>
	<option selected='All'>All
	<option value='Open'>Open
    <option value='Closed'>Closed
    <option value='Cancelled'>Cancelled
<?php
}
?>
</select>
</td>
<td>
<span class="labeltext">

<button class="stdbtn btn_blue" style="background-color:#2d3e50;padding:2px;margin-right:2px;" onClick="javascript: return check_req_fields()" >Search</button>
 <button class="stdbtn btn_blue" style="background-color:#2d3e50;padding:2px;margin-right:2px;" onClick="javascript:putfocus()" >Reset</button>
</td>

 <!--  <input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Search" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onClick="javascript: putfocus()"></td> -->
</tr>
</table>
<tr><td>

<table width=100% border=0>
<div class="contenttitle radiusbottom0">
<h2><span>List of Schedules
<?
$status=$_REQUEST['status'];
if($status=='new')
{
echo "<td><font color='green'>Delivery Schedule for PRN #: <font color='red'> ". $_REQUEST['crn']."<font color='green'> and Schedule date:  <font color='red'>". $_REQUEST['sch_date']." </font> Inserted Succesfully.</font></td>";
}
else if($status=='import')
{
echo "<td><font color='green'>The Imported Data Inserted Succesfully.</font></td>";
}
if($dept !='PPC2'&& $dept !='PPC3'&& $dept !='PPC4' && $dept !='PPC5')
{
?>
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;" onClick="location.href='new_delivery_sch.php'" value="New" >
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;" onClick="location.href='delivery_schimport.php'" value="Import" >
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;" onClick="javascript:printdelivery_sch()" value="Print">


<?php
}
?>
</tr>
</table>

</td></tr></table>
<table border=0 bgcolor="#FFFFFF" style="table-layout: fixed;width:100%"  cellspacing=1 cellpadding=3>
<table class="stdtable" style="table-layout: fixed;width:100%" border=0 cellpadding=3 cellspacing=1>
  <thead>
<tr>
<th class="head0" ><span class="tabletext"><b>PRN #</b></td>
<th class="head1" ><span class="tabletext"><b>Customer</b></td>
<th class="head0" ><span class="tabletext"><b>Scheduled Date</b></td>
<th class="head1" ><span class="tabletext"><b>Scheduled Qty</b></td>

<th class="head0" ><span class="tabletext"><b>WO Issue Qty</b></td>
<th class="head1" ><span class="tabletext"><b>Dispatched<br/> UTD Qty</b></td>
<th class="head0" ><span class="tabletext"><b>Time Required</b></td>
<th class="head1" ><span class="tabletext"><b>Status</b></td>
</tr>
</thead>
<!-- </table>

<div style="width:1333px;height:200px;overflow-y:scroll;">
<table class="stdtable" style="table-layout: fixed;width:1320px" border=0 cellpadding=3 cellspacing=1> -->
<!-- <div style="width:100%; height:400; overflow:auto;border:" id="dataList"> -->

<!-- <table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable" > -->
<?php	
    $result = $newdelivery_sh->getdelivery_sch_summary($cond,$offset,$rowsPerPage);
    while ($myrow = mysql_fetch_row($result))
    {

     $remarks=wordwrap($myrow[4],105,"\n",true);
     $hours = floor($myrow[5] / 60);
     $mins = intval($myrow[5] % 60);
    if($hours == '0')
    {
      $req_time = $mins.' Mins';
   }else{
    $req_time = $hours.' hrs '.$mins. '  mins ';
   }
     if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
           {
              $datearr = split('-', $myrow[2]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $sch_date=date("M j, Y",$x);
           }
           else
           {
              $sch_date = '';
           }
?>   <tr bgcolor="#FFCC00">
     <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><a href="delivery_schDetails.php?recnum=<?echo $myrow[0]?>"><?php echo $myrow[1]?></td>
     <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $myrow[7] ?></td>
      <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $sch_date?></td>
     <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $myrow[3] ?></td>
	  <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $myrow[9] ?></td>
     <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $myrow[8] ?></td>
     <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $req_time ?></td>
     <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $myrow[6] ?></td>
     </tr>
<?php
    }

?>
</table>
</table>
</table>

</td>
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->
</table>
        <table border = 0 cellpadding=0 cellspacing=0 width=100% >
							<tr>
								<td align=left>

<?php
$numrows = $newdelivery_sh->getdelivery_schCount($cond,$offset,$rowsPerPage);
//echo $numrows;

   // how many pages we have when using paging?
   $maxPage = ceil($numrows/$rowsPerPage);
//echo "$maxPage</br>";
if (!isset($_REQUEST['page']))
{
//   echo "page is set";
    $totpages = $maxPage;
}

//echo "total pages :$totpages</br>";
$self = $_SERVER['PHP_SELF'];

// creating 'previous' and 'next' link
// plus 'first page' and 'last page' link

// print 'previous' link only if we're not
// on page one
if ($pageNum > 1)
{
    $page = $pageNum - 1;
    $prev = " <a href=\"delivery_schSummary.php?page=$page&totpages=$totpages&schedule_date1=$sdate1&schedule_date2=$sdate2&crnnum=$crn&status_val=$sval\">[Prev]</a> ";

    $first = " <a href=\"delivery_schSummary.php?page=1&totpages=$totpages&schedule_date1=$sdate1&schedule_date2=$sdate2&crnnum=$crn&status_val=$sval\">[First Page]</a> ";
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
    $next = " <a href=\"delivery_schSummary.php?page=$page&totpages=$totpages&schedule_date1=$sdate1&schedule_date2=$sdate2&crnnum=$crn&status_val=$sval\">[Next]</a> ";

    $last = " <a href=\"delivery_schSummary.php?page=$totpages&totpages=$totpages&schedule_date1=$sdate1&schedule_date2=$sdate2&crnnum=$crn&status_val=$sval\">[Last Page]</a> ";
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
							</tr>
						</table>
</FORM>
</table>
</body>
</html>
