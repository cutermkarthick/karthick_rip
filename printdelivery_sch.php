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
include('classes/delivery_schClass.php');


$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'delivery_sch';
$page = "MES: delivery_sch";
//////session_register('pagename');
$newlogin = new userlogin;
$newlogin->dbconnect();
$newdelivery_sh = new deliverye_sch;
$rowsPerPage =100;
$dept = $_SESSION['department'];
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
<title>Print Delivery Schedule</title>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0">
<?php
include('header.html');
?>
<table width=630 border=0>
<tr><td><font style="Arial" size=3><center><b>
   <A HREF="javascript:window.print()">DELIVERY SCHEDULE</A></b></center></td</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>

</td></tr>
</table>

<table width=100% border=0 cellpadding=0 cellspacing=0  >
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr>
<td><span class="pageheading"><b>Delivery Schedule</b></td>
</tr>
<tr>
<td>

<tr><td>
</td></tr></table>

<table border=0 bgcolor="#FFFFFF" width=100%  cellspacing=1 cellpadding=3>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable">
  <thead>
<tr>
<th class="head0" width='10%'><span class="tabletext"><b>PRN #</b></th>
<th class="head1" width='15%'><span class="tabletext"><b>Partnumber</b></th>
<th class="head0" width='20%'><span class="tabletext"><b>Scheduled Date</b></th>
<th class="head1" width='10%'><span class="tabletext"><b>Scheduled Qty</b></th>
<th class="head0" width='20%'><span class="tabletext"><b>Time Required</b></th>
<th class="head1" width='10%'><span class="tabletext"><b>Status</b></th>
</tr>
</thead>
<?php

    $result = $newdelivery_sh->getdelivery_sch_summary($cond,$offset,$rowsPerPage);
    while ($myrow = mysql_fetch_row($result))
    {
     $remarks=wordwrap($myrow[4],105,"\n",true);
     $hours = floor($myrow[5] / 60);
     $mins = intval($myrow[5] % 60);
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
     <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1]?></td>
     <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[7]?></td>
     <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $sch_date?></td>
     <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
     <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[5] ?></td>
     <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[6] ?></td>
     </tr>
<?php
    }

?>
</table>
</table>
</body>
</html>
