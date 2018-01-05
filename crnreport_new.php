<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = August 12, 2009              =
// Filename: crnreport.php                     =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 WMS                          =
// Displays CRN Stock Summary list.            =
//==============================================

session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];
$_SESSION['pagename'] = 'reports';
$page = "Reports";
//////session_register('pagename');

// First include the class definition
include_once('classes/reportClass.php');
include_once('classes/displayClass.php');

$newdisplay = new display;
$newreport = new report;
$rowsPerPage = 1000;
$crn=$_REQUEST['crn'];
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

$userrole = $_SESSION['userrole'];
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<html>
<head>
<title>PRN Stock Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<form action='crnreport_new.php' method='post' enctype='multipart/form-data'>
<?php

include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
  <tr>
    <td>
      <table width=100% border=0 cellspacing="0" cellpadding="0">
          <tr>
            <td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
            <td align="right">&nbsp;
            <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
            </tr>
      </table>
      <table width=100% border=0 cellpadding=0 cellspacing=0  >
        <tr><td></td></tr>
        <tr>
          <td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
      <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0>
     <tr><td>
    </tr>
  <tr>
<td>
</td></tr>
<tr><td valign="top">

<table valign="top" width="100%" border=0 class="stdtable1">
<tr>
<td valign='top'><span class="pageheading"><b>PRN Report (New)</b></td>
<td colspan=160>&nbsp;</td>
</tr>
</table>

<table valign="top" width="100%" align="center" border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr bgcolor="#F5F6F5">
<td align="center" colspan=7><span class="heading"><b>Search Criteria</b></td></tr>
<tr>
<td valign='top' bgcolor="#FFFFFF"><span class="tabletext"><b>PRN:</b>&nbsp;
<input type="text" size=15% name="crn" value="<?echo $_REQUEST['crn'] ?>">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="button"><b>
<button name="submit" value="Get" class="stdbtn btn_blue" style="background-color:#2d3e50">Get</button>
<!-- <input type="submit" name="submit" value="Get"> -->
</b></td>
</tr>
</table>

<table valign="top" width="100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
<td valign='top'>
<?php
if($crn!='')
{
?>
<table align="top" style="table-layout: fixed"  border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
    <td><span class="tabletext">
                          <a href="crnstock_new_exp.php?crn=<?php echo $crn ?>">Export To Excel</td>
</tr>
</table>
<table class="stdtable" align="top" style="table-layout: fixed;width:50%!important" style="border:1px solid #000000;" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
<thead>
<th class="head0" style="width:63px" ><span class="tabletext" align='center'><b>PRN</b></th>
<th class="head1" style="width:41px"><span class="tabletext" align='center'><b>Part<br> Number&nbsp;</b></th>
<th class="head0" style="width:71px"><span class="tabletext" align='center'><b>WO<br> Process</b></th>
<th class="head1" style="width:16px"><span class="tabletext" align='center'><b>WIP</b></th>
<th class="head0" style="width:43px"><span class="tabletext" align='center'><b>Post <br>Process</b></th>
<!--<th class="head0" width="40px"><span class="tabletext" align='center'><b>DN<br>Bal</b></th>
<th class="head1" width="50px"><span class="tabletext" align='center'><b>DN<br>Bal(store)</b></th>-->
<th class="head1" style="width:28px"><span class="tabletext" align='center'><b>FG<br>Stock</b></th>
<th class="head0" style="width:35px"><span class="tabletext" align='center'><b>GRN<br>Stock</b></th>
<th class="head1" style="width:36px"><span class="tabletext" align='center'><b>GRN<br>Stock<br>(Quar)</b></td>
<th class="head0" style="width:70px"><span class="tabletext" align='center'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RMPO<br>&nbsp;&nbsp;&nbsp;(po#/qty/<br>&nbsp;&nbsp;&nbsp;&nbsp;Duedate)</b></th>
</tr>
<!--</table>
<table  class="stdtable" style="width:67%!important" border=1 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">-->


<?php
$cond='';
if($crn!='')
{
$cond='and w.crn_num like '."'".$crn."%'";
$cond1='where w.crn_num like '."'".$crn."%'";
}
else
{
$cond='';
$cond1=''.$cond;
}

$total=0;
$total4dis=0;
$total4grn=0;
$totalgrn_quar=0;
$totalbalance=0;
$totalbalance_quar=0;
$totaldn_qty=0;
$totalrecd_qty=0;
$totalrmpoqty=0;
$total_recd4stores=0;
 $woprocarr = array("Assembly","Untreated","Treated");
// print_r($woprocarr);
$procarray = array();
$crnarray = array($procarray);
$rmpoarray = array();
$ft = 1;
$compqty = 0;
$dispqty = 0;
$dnbal = 0;
$fg = 0;
$wip = 0;

$dnbal_st=0;

$treat = $newreport->gettype4crn($cond1,$crn);
$result = $newreport->getstock4crnnew($cond1,$crn,$woprocarr,$treat);
while($myrow4stock=mysql_fetch_row($result))
{
    if ($ft == 1)
    {
         $prevcrndb = $myrow4stock[0];
    }
    if ($ft != 1 && $prevcrndb != $myrow4stock[0])
    {
             $procarray = array();
               $prevcrndb = $myrow4stock[0];
               $fg_close = 0;
         //$dnbalst = 0;
    }
      //$crndb = $myrow4stock[0];
      $proc = $myrow4stock[1];
      //echo $proc."---**----";
    $compqty = $myrow4stock[2];
    $dispqty = $myrow4stock[3];
    $dnbal = $myrow4stock[4];
    $fg = $myrow4stock[5];
    $wip = $myrow4stock[6];
    $cond = $myrow4stock[7];
    $dnbalst = $myrow4stock[8];

    //echo "<br>proc is $dnbalst<br>";
   $procarray[$proc][2] = $fg;
   $procarray[$proc][0] = $wip;
   $procarray[$proc][1] = $dnbal;
   $procarray[$proc][3] = $dnbal_st;


         if($cond == 'Closed')
         {
                   
           // echo $fg."---close---<br>";
           $total4dis += $fg;
           $fg_close= $fg;
           $totaldn_qty += $dnbal;
           $total += $wip;

           // echo $total . " " . $wip;

         }
         else
    {
       
      if($fg!=0)
       {
      
                $procarray[$proc][2] = $fg+$fg_close;
                //echo $fg."---open---<br>";
                $total4dis += $fg;
                 $dnbal_st=0;
        }
       if($fg==0)
        {
               $dnbal_st = $myrow4stock[8]-$myrow4stock[2];

        }
          $procarray[$proc][0] = $wip;
          $procarray[$proc][1] = $dnbal;
          $procarray[$proc][3] = $dnbal_st;
          $procarray[$proc][2] = $fg;

          $total += $wip;
          $totaldn_qty += $dnbal;
     
          $total_recd4stores +=  $dnbal_st;
          //echo "<br>$crn--------$dnbalst<br>";
         // echo "<br>qty is $wip<br>";
     }

    // $procarray[$proc][0] = $wip;
     $crnarray[$prevcrndb]=$procarray;
      $ft = 0;
}
//var_dump($crnarray);
//var_dump($rmpoarray);

// Get GRN stock
$result = $newreport->getgrnqty4crnnew($crn);
while($mygrn=mysql_fetch_row($result))
{
      $crndb = $mygrn[3];
      $grnqtm=$mygrn[0];
      $grnqtyused = $mygrn[1];
      $qty_ret=  $mygrn[4];
      $grnquar = $mygrn[2];
     // echo $grnquar."-**---";
    $grnbal = $grnqtm - $grnqtyused+$qty_ret;
    $grnarray[$crndb][0] = $grnbal;
    $grnarray[$crndb][1] = $grnquar;
    $total4grn += $grnbal;
    $totalgrn_quar += $grnquar;
}
//var_dump($grnarray);

$dnst=0;
$bg = 0;

$result = $newreport->getallCRN4report($cond1,$crn);
while($myrow4crn=mysql_fetch_row($result))
{

$part_num=wordwrap($myrow4crn[3],10,"<br>\n");
if ($bg == 1)
{
  $bgcolor = '"#EEEFFF"';
  $bg = 0;
}
else if ($bg == 0)
{
  $bgcolor = '"#FFFFFF"';
  $bg = 1;
}
printf('<tr bgcolor=%s valign="top">
        <td align="center" style="width:63px" ><a href="javascript:ShowDetails(\'%s\')"><span class="tabletext"><font color="red">%s</font></td>
        <td align="center" width="41px"><span class="tabletext">%s</td>',$bgcolor,$myrow4crn[1],$myrow4crn[1],$part_num);

foreach ($woprocarr as $proc)
{

 
   if ($proc != 'Assembly')
  {
    printf("<tr bgcolor=%s><td></td><td></td>",$bgcolor);
    }
   $openflag=0;
   $crninp = $myrow4crn[1];
   /* if($proc == 'Manufacture Only')
    {

      $proc1 = 'Untreated';

    }
    else if($proc == 'With Treatment')
    {
  //echo $woprocarr . " " .$proc;
       $proc1 = 'Treated';
    //    echo $woprocarr . " " .$proc;
    }
    else
    {

      $proc1 = 'Assembly';
    }*/
    $proc = wordwrap($proc,12,"<br>\n",true);

   
   printf('<td  width="71px" align="center" bgcolor=%s><span class="tabletext">%s</td>',$bgcolor,$proc);
   $wip= $crnarray[$crninp][$proc][0] ;

   $wip = $wip ? $wip : "&nbsp";
   printf('<td  width="16px" align="center" bgcolor=%s><span class="tabletext">%s</td>',$bgcolor,$wip);
   $dn = $crnarray[$crninp][$proc][1];
   $dn = $dn ? $dn : "&nbsp";
   $dnst = $crnarray[$crninp][$proc][3];
   $dnst = $dnst ? $dnst : "&nbsp";
   if($proc == 'Treated')
   {
     // echprint_r($procarray);o "reached" . $proc1 ;
      // echo "reached" . $dn ;
      printf('<td  width="43px" align="center" bgcolor=%s><span class="tabletext">%s</td>',$bgcolor,$dn);

/*      printf('<td  width="50px" align="center" bgcolor=%s><span class="tabletext">%s</td>',$bgcolor,$dnst);*/
   }
   else
  {

       printf('<td  width="43px" align="center" bgcolor=%s><span class="tabletext">&nbsp</td>',$bgcolor);
    /*   printf('<td  width="80px" align="center" bgcolor=%s><span class="tabletext">&nbsp</td>',$bgcolor);*/
  }
   $fg = $crnarray[$crninp][$proc][2];

/*echo "reached".$fg;
   echo $fg."---fg---<br>";*/
   $fg = $fg ? $fg : "&nbsp";
// echo $fg."---fg---<br>";  


   printf('<td  width="28px" align="center" bgcolor=%s><span class="tabletext">%s</td>',$bgcolor,$fg);
   $grnstock = $grnarray[$crninp][0];
   $grnstockquar = $grnarray[$crninp][1];

 /*echo "<pre>";
   print_r($grnarray);*/
      //echo $grnstock."--***---".$grnstockquar."---<br>";
   if($proc == 'Untreated')
   {
      printf('<td align="center" width="27px" bgcolor=%s><span class="tabletext">%s </td>',$bgcolor,$grnstock);
      printf('<td align="center" width="27px" bgcolor=%s><span class="tabletext">%s </td>',$bgcolor,$grnstockquar);
   }
   else
  {
       printf('<td  width="27px" align="center" bgcolor=%s><span class="tabletext">&nbsp</td>',$bgcolor);
       printf('<td  width="27px" align="center" bgcolor=%s><span class="tabletext">&nbsp</td>',$bgcolor);
  }
    $result4rmpo=$newreport->get_rmpotqty($myrow4crn[1]);
   
    $myrmpo=mysql_fetch_row($result4rmpo);
    if($proc1 == 'Untreated' &&  $myrmpo != '')
    {
     $end_date='';$duedate='';
     if($myrmpo[7] != '0000-00-00' && $myrmpo[7] != '' && $myrmpo[7] != 'NULL')
     {
       $duedate=$myrmpo[7] ;
     }else if($myrmpo[6] != '0000-00-00' && $myrmpo[6] != '' && $myrmpo[6] != 'NULL')
     {
        $duedate=$myrmpo[6] ;
     }else
     {
        $duedate=$myrmpo[0] ;
     }
// echo "===$duedate<br>" ;
     if($duedate != '0000-00-00' && $duedate != '' && $duedate != 'NULL')
     {
        $date_arr=split('-',$duedate) ;
        $year=$date_arr[0];
        $month=$date_arr[1];
        $day=$date_arr[2];
        $d = mktime(0,0,0,$month,$day,$year);
        if($myrmpo[4]=='SEA')
        {
          $end_date = date('M j, Y',strtotime('+60 days',$d));
        }
         if($myrmpo[4]=='AIR')
        {
         $end_date = date('M j, Y',strtotime('+20 days',$d));
         }
          // echo $end_date.'date---<br>'.$myrmpo[4].'<br>';
       }

       $rmpoqty=$myrmpo[5];
//}
       printf('<td align="center" width="36px" bgcolor=%s><span class="tabletext">%s/<br>%s/<br>%s </td>',$bgcolor,$myrmpo[1],$rmpoqty,$end_date);
        $totalrmpoqty += $rmpoqty;
//printf('</td>');
       }
       else
        {
          printf('<td align="center" width="36px" bgcolor=%s><span class="tabletext">&nbsp;</td>',$bgcolor);
        }
 } // for loop ends here

}

printf('<tr bgcolor="#F5F6F5">
        <td width="130px"><span class="tabletext"><b>%s</b></td>
    <td align="center" width="102px"><span class="tabletext"><b>%s</b></td>
    <td align="center" width="75px"><span class="tabletext"><b>%s</b></td>
        <td align="center" width="44px"><span class="tabletext"><b>%d</b></td>
         <td align="center" width="40px"><span class="tabletext"><b>%d</b></td>
       <td align="center" width="40px"><span class="tabletext"><b>%d</b></td>
       <td align="center" width="40px"><span class="tabletext"><b>%d</b></td>
        <td align="center" width="40px"><span class="tabletext"><b>%d</b></td>
        <td align="center" width="80px"><span class="tabletext"><b>%d</b></td></tr>',
        'Total','&nbsp;','&nbsp;',
        $total,
        $totaldn_qty,
        $total4dis,
        $total4grn,
        $totalgrn_quar,
        $totalrmpoqty);

?>
</table>
<?php
}
?>
</td>
<br>
<td valign='top'>
<table width="200px"  border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF" >
<tr  bgcolor="#FFFFFF">
<td valign='top'>
<div id='cust'>
</td>
<tr>
</table>
</td></tr>
</table>
</td></tr>
</table>


<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->
</table>
</table>
</table>
</table>
</FORM>
</body>
</html>