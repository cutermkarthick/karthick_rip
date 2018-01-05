<?php
//===============================
// Author: FSI                                 
// Date-written = June 19, 2008                
// Filename: prodshift_record.php              
// Copyright (C) FluentSoft Inc.               
// Contact bmandyam@fluentsoft.com             
// Revision: v1.0 WMS                          
// Displays Production Shiftwise record m/c wise                 
//===============================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
//sessio_register('pagename');
$dept=$_SESSION['department'];
$page ="Reports"
;
include_once('classes/loginClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage = 30000;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
	//echo "i am set";
    $pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
    $totpages = $_REQUEST['totpages'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

// Month-to-date computation 
date_default_timezone_set('Asia/Calcutta');
$todate1 = date("Y-m-d");


$today = split('-',$todate1);
$days = $today[2]-1;
$fromdate1 = date("Y-m-d",strtotime("-$days days"));
//echo "Fromdate is $fromdate1";

// First include the class definition

include('classes/reportClass.php');
include('classes/displayClass.php');
$newreport = new report;
$newdisplay = new display;
?>

<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="bootstrap-chosen.css">
<style type="text/css">
    
    .chosen-container-multi
    {
      width: 400px !important;
    }


</style>

<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>


<html>
<head>
<title>Production Report</title>
</head>
<?php
if($dept=='Operator' || $dept == 'opf')
{
?>
<body leftmargin="0"topmargin="0" marginwidth="0" onload="javascript:createTab('reports');toggle_visibility()">
<?php
 }
/* else
 {*/
 ?>
<body leftmargin="0"topmargin="0" marginwidth="0" >
 <?php
 include('header.html');
 // }

 ?>

<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
  <tr>
    <td>

    <table width=100% border=0 cellspacing="0" cellpadding="0">
     <?php
  if($dept!='Operator')
  {
  ?>
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
 </tr>
<?php
 }
 ?>

 </table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td></td></tr>
<tr>
<td>

<!--     </tr>
<tr><td></td></tr>
<tr>
<td> -->

<!-- <?php
//echo $dept."--*---";
if($dept=='Operator' || $dept == 'opf')
{
 include('header.html');
 include('header2.html');




}else
{

 $newdisplay ->dispLinks('');
}
?>
</td></tr>

<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0>

<tr>
	<td> -->


  <table width=100% border=0 >
  <?php
  if($dept=='Operator')
  {
  ?>
   <tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
 </tr>
 <?php
 }
 ?>

  
  
   <tr><td align="center"><span class="heading"><b>Production Record</b></span></td>
    <tr><td>
 
   </td></tr>
    </tr>
   </table>
   <tr>
<td>
<?php

?>
  <form action="prodshift_record.php" method="post"  enctype="multipart/form-data">


 <select id="machine"  name="machine[]" multiple size=10 >
<option name ="" value="" disabled="disabled">Please Select</option>
 <?php 
    
    $mc_detail_arr = array();
    $machines_arr = array();
    $mcarry = array();


    $check_machine = 0;
    $machine = $newreport->get_machine();

    ?>
     <option value="ALL" <?php echo $s;?> > ALL</option>
     <option value="Fitting" <?php echo $s;?> > Fitting</option>
    <?php 

    while($myrow = mysql_fetch_array($machine))
    {  
       
        $mc = $myrow[0];
        $machines_arr[$mc][] = $myrow[0];
        $string = str_replace("-", "", $mc);
        $machines_arr[$mc][] = strtolower((preg_replace('/[^A-Za-z0-9\-]/', '', $string)));

     ?>

      
        <option value="<?php echo $myrow[0]; ?>" <?php (in_array($myrow[0], $mcarry) ? 'selected="selected"' : '') ?> ><?php echo $myrow[0]; ?></option>

  
       
    <?php }  


    ?>

     </select> 


    <input type="hidden" value="<?php echo $myrow[0]; ?>" name="<?php echo $myrow[0]; ?>">
     <input type="submit" value="Search" style="position: absolute; margin-left:15px;" > 
</form>


  <?php  

    if (isset($_POST['machine'])) {
      
    $check_machine = 1;

 
    $machines = $_POST['machine'];

    if ($machines)
    {
        foreach ($machines as $value)
        {
            array_push($mcarry,$value);
        }
    }

  foreach ($mcarry as $key => $mc) 
  {
      

          if (isset($mc)) {

            if ($mc == 'ALL') {
              $check_machine = 0;
              break;
            }
            else
            {
              $check_machine = 1;
            }

          $machine_name = $mc;
      
          $string = str_replace("-", "", $machine_name);
          $mac_nam = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
          $add_mac = strtolower($mac_nam).'d';
          $mc4name = strtolower($mac_nam);


           
   ?>


<div id="<?php echo $add_mac; ?>">
<table id="<?php echo $machine_name;?>" width=1100px border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
        <tr>
        <td colspan=16 align="center" bgcolor="#00DDFF"><span class="heading"><b><?php echo $machine_name; ?></b></td>
        </tr>
        <tr>
         <td colspan=16 align="center" bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="f<?php echo $mc4name; ?>" name="f<?php echo $mc4name; ?>" size=10 value="<?php echo $fromdate1;$d1=$fromdate1; $d2=$todate1;?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">

         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('f<?php echo $mc4name; ?>')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="t<?php echo $mc4name; ?>" name="t<?php echo $mc4name; ?>" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
<?php
//$d1=$fromdate1;
//$d2=$todate1;

 if($d1 != '' && $d1 != '0000-00-00')
               {
                 $datearr = split('-', $d1);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $create_date=date("M j, Y",$x);
               }
else
               {
                 $create_date = '';
               }
              

$var2str = "d_f".(string)$mac_nam;
$$var2str = $create_date;

$machines_arr[$machine_name][] = $$var2str;

if($d2 != '' && $d2 != '0000-00-00')
               {
                 $datearr = split('-', $d2);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $create_date=date("M j, Y",$x);
               }
else
               {
                 $create_date = '';
               }
$to_dt = "d_t".(string)$mac_nam;               
$$to_dt = $create_date;
$machines_arr[$machine_name][] = $$to_dt;

$d1=0;$d2=0;
//$d_fBMV601=$fromdate1;$d_tBMV601=$todate1 
?>
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('t<?php echo $mc4name; ?>')">
         <b>&nbsp;&nbsp;CRN &nbsp;&nbsp;</b>
         <input type="text" id="crn$mc4name" name="crn$mc4name" size=10 value="">
         <b>&nbsp;&nbsp;Shift &nbsp;&nbsp;</b>
         <input type="text" id="shift$mc4name" name="shift$mc4name" size=10 value="">
         <b>&nbsp;&nbsp;Stage &nbsp;&nbsp;</b>
         <input type="text" id="stage$mc4name" name="stage$mc4name" size=10 value=""> 
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getprodrec('<?php echo $machine_name; ?>','<?php echo strtolower($add_mac); ?>','<?php echo $mc4name; ?>','f<?php echo $mc4name; ?>','t<?php echo $mc4name; ?>','crn$mc4name','stage$mc4name','shift$mc4name')">  
            <img name="Image8" border="0" src="images/export.gif" onclick="javascript: excel4prodshift('<?php echo strtolower($machine_name); ?>','<?php echo strtolower($add_mac); ?>','<?php echo $mc4name; ?>','f<?php echo $mc4name; ?>','t<?php echo $mc4name; ?>','crn$mc4name','stage$mc4name','shift$mc4name')" style="cursor: pointer;">       
         </td>
        </tr>

<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
?>
        <tr>
            <td bgcolor="#FFFFCC" width=100px><span class="heading"><b>Date</b></td>
            <td bgcolor="#FFFFCC" width=60px><span class="heading"><b>Shift</b></td>
            <td bgcolor="#FFFFCC" width=140px><span class="heading"><b>Operator</b></td>
            <td bgcolor="#FFFFCC" width=90px><span class="heading"><b>PRN</b></td>
            <td bgcolor="#FFFFCC" width=90px><span class="heading"><b>WO</b></td>
            <td bgcolor="#FFFFCC" width=60px><span class="heading"><b>Qty</b></td>
            <td bgcolor="#FFFFCC" width=60px><span class="heading"><b>Stage</b></td>
            <td bgcolor="#FFFFCC" width=60px><span class="heading"><b>Rej Qty</b></td>
            <td bgcolor="#FFFFCC" width=60px><span class="heading"><b>Rew Qty</b></td>
            <td bgcolor="#FFFFCC" width=120px><span class="heading"><b>Setting Time</b></td>
            <td bgcolor="#FFFFCC" width=120px><span class="heading"><b>Running Time</b></td>

            <td bgcolor="#FFFFCC" width=120px><span class="heading"><b>Inspection Time</b></td>
            <td bgcolor="#FFFFCC" width=120px><span class="heading"><b>Maintenance Time</b></td>
            <td bgcolor="#FFFFCC" width=120px><span class="heading"><b>Breakdown Time</b></td>
            <td bgcolor="#FFFFCC" width=160px><span class="heading"><b>Others</b></td>
            <td bgcolor="#FFFFCC" width=160px><span class="heading"><b>Comments</b></td>


        </tr>



<?php

   
    $totalQty = "totalQuantity_".(string)$mac_nam;               
    $$totalQty = 0;

    $rejectQty = "rejectQuantity_".(string)$mac_nam;               
    $$rejectQty = 0;
    // $totalQuantity_BMV601 = 0;  
    // $rejectQuantity_BMV601 = 0; 
    $totalQuantity=0;
    $rejectQuantity=0;



        $result = $newreport->get_prodrecord($machine_name,$cond);
        while ($myrow = mysql_fetch_row($result)) 
        {
          // echo "<pre>"; print_r($myrow); exit;

              if($myrow[1] != '0000-00-00' && $myrow[1] != '' && $myrow[1] != 'NULL')
              {
                  $datearr = split('-', $myrow[1]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $date1=date("M j, Y",$x);
              }
              else
              {
                  $date1 = '';
              }
            $totalQuantity = $totalQuantity + $myrow[6];
            $rejectQuantity = $rejectQuantity + $myrow[15];
 
           // echo "<tr><td>$totalQuantity</td></tr>";
          

?>
            <tr>

              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $date1 ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[4] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[5] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[6] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[7] ?></td>
             <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[15] ?></td>
             <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[23] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[8] ." h " .  $myrow[9] . " m " ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[10] ." h " .  $myrow[11] . " m " ?></td>
  
            
<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[18] ." h " .  $myrow[19] . " m " ?></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[20] ." h " .  $myrow[21] . " m " ?></td>
   <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[16] ." h " .  $myrow[17] . " m " ?></td>

              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[12] ." h " .  $myrow[13] . " m " ?></td>
   <!--<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[22] ?></span>-->
               </td>

              <td bgcolor="#FFFFFF"><span class="tabletext"><textarea rows="2" cols="30" 
                       style="background-color:#DDDDDD;" readonly="readonly"><?php echo $myrow[14] ?></textarea>
               </td>

            </tr>
<?php 
         } 

        $totalQty = "totalQuantity_".(string)$mac_nam;               
        $$totalQty = $totalQuantity;

        $rejectQty = "rejectQuantity_".(string)$mac_nam;               
        $$rejectQty = $rejectQuantity;

        $machines_arr[$machine_name][] = $totalQuantity;
        $machines_arr[$machine_name][] = $rejectQuantity;
        // $machines_arr[$machine_name][] = $date1;
        /*echo "<pre>";
        print_r($machines_arr);
*/

         // $totalQuantity_BMV601 = $totalQuantity;
         // $rejectQuantity_BMV601 = $rejectQuantity;
      // echo "<tr><td>SADFADFA $rejectQuantity</td></tr>";


      echo "<td ></td><td></td><td></td><td></td><td bgcolor=\"#FFFFFF\"><span class=\"tabletext\"> <b>Total Qty:</b></td><td id='tQ".$mcname."' bgcolor=\"#FFFFFF\" ><span class=\"tabletext\">$totalQuantity</td>";

      echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\"> <b>Total Rej<br>Qty:</b></td><td id='tQ1".$mcname."' bgcolor=\"#FFFFFF\" ><span class=\"tabletext\">$rejectQuantity</td>";

       echo "</tr>";
       echo "</table>";

       echo "</div>";

// echo"<pre>";
// print_r($mc_detail_arr);
  } 
?>
  </table>
  <br>

<?php 

  

      

} }
    
  if( $check_machine == 0)
  {

     $machine = $newreport->get_machine();

    while($myrow = mysql_fetch_array($machine))
    { 
        
          $machine_name = $myrow[0];
      
          $string = str_replace("-", "", $machine_name);
          $mac_nam = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
          $add_mac = strtolower($mac_nam).'d';
          $mc4name = strtolower($mac_nam);


   ?>


<div id="<?php echo $add_mac; ?>" >
<table id="<?php echo $mc4name;?>" width=1100px border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable" >
        <tr>
        <td colspan=16 align="center" bgcolor="#00DDFF"><span class="heading"><b><?php echo $machine_name; ?></b></td>
        </tr>
        <tr>
         <td colspan=16 align="center" bgcolor="#FFFFFF"><span class="labeltext"><b>From &nbsp&nbsp</b>
         <input type="text" id="f<?php echo $mc4name; ?>" name="f<?php echo $mc4name; ?>" size=10 value="<?php echo $fromdate1;$d1=$fromdate1; $d2=$todate1;?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">

         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('f<?php echo $mc4name; ?>')">
          <span class="labeltext"><b>&nbsp;&nbsp;To</b>
         <input type="text" id="t<?php echo $mc4name; ?>" name="t<?php echo $mc4name; ?>" size=10 value="<?php echo $todate1 ?>"
          style="background-color:#DDDDDD;" readonly="readonly"
          onkeypress="javascript: return checkenter(event)">
<?php
//$d1=$fromdate1;
//$d2=$todate1;

 if($d1 != '' && $d1 != '0000-00-00')
               {
                 $datearr = split('-', $d1);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $create_date=date("M j, Y",$x);
               }
else
               {
                 $create_date = '';
               }
              

$var2str = "d_f".(string)$mac_nam;
$$var2str = $create_date;

$machines_arr[$machine_name][] = $$var2str;


if($d2 != '' && $d2 != '0000-00-00')
               {
                 $datearr = split('-', $d2);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $create_date=date("M j, Y",$x);
               }
else
               {
                 $create_date = '';
               }
$to_dt = "d_t".(string)$mac_nam;               
$$to_dt = $create_date;
$machines_arr[$machine_name][] = $$to_dt;
 
$d1=0;$d2=0;
//$d_fBMV601=$fromdate1;$d_tBMV601=$todate1 
?>
         <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('t<?php echo $mc4name; ?>')">
         <b>&nbsp;&nbsp;CRN &nbsp;&nbsp;</b>
         <input type="text" id="crn$mc4name" name="crn$mc4name" size=10 value="">
         <b>&nbsp;&nbsp;Shift &nbsp;&nbsp;</b>
         <input type="text" id="shift$mc4name" name="shift$mc4name" size=10 value="">
         <b>&nbsp;&nbsp;Stage &nbsp;&nbsp;</b>
         <input type="text" id="stage$mc4name" name="stage$mc4name" size=10 value=""> 
         <input type="image" name="Submit" src="images/bu-get.gif" value="Get"
            onclick="javascript: getprodrec('<?php echo $machine_name; ?>','<?php echo strtolower($add_mac); ?>','<?php echo $mc4name; ?>','f<?php echo $mc4name; ?>','t<?php echo $mc4name; ?>','crn$mc4name','stage$mc4name','shift$mc4name')">  
            <img name="Image8" border="0" src="images/export.gif" onclick="javascript: excel4prodshift('<?php echo strtolower($machine_name); ?>','<?php echo strtolower($add_mac); ?>','<?php echo $mc4name; ?>','f<?php echo $mc4name; ?>','t<?php echo $mc4name; ?>','crn$mc4name','stage$mc4name','shift$mc4name')" style="cursor: pointer;">       
         </td>
        </tr>

<?php
        $cond = "op.st_date >= '$fromdate1' and op.st_date <= '$todate1'";
?>
        <tr>
            <td bgcolor="#FFFFCC" width=100px><span class="heading"><b>Date</b></td>
            <td bgcolor="#FFFFCC" width=60px><span class="heading"><b>Shift</b></td>
            <td bgcolor="#FFFFCC" width=140px><span class="heading"><b>Operator</b></td>
            <td bgcolor="#FFFFCC" width=90px><span class="heading"><b>PRN</b></td>
            <td bgcolor="#FFFFCC" width=90px><span class="heading"><b>WO</b></td>
            <td bgcolor="#FFFFCC" width=60px><span class="heading"><b>Qty</b></td>
            <td bgcolor="#FFFFCC" width=60px><span class="heading"><b>Stage</b></td>
            <td bgcolor="#FFFFCC" width=60px><span class="heading"><b>Rej Qty</b></td>
            <td bgcolor="#FFFFCC" width=60px><span class="heading"><b>Rew Qty</b></td>
            <td bgcolor="#FFFFCC" width=120px><span class="heading"><b>Setting Time</b></td>
            <td bgcolor="#FFFFCC" width=120px><span class="heading"><b>Running Time</b></td>

            <td bgcolor="#FFFFCC" width=120px><span class="heading"><b>Inspection Time</b></td>
            <td bgcolor="#FFFFCC" width=120px><span class="heading"><b>Maintenance Time</b></td>
            <td bgcolor="#FFFFCC" width=120px><span class="heading"><b>Breakdown Time</b></td>
            <td bgcolor="#FFFFCC" width=160px><span class="heading"><b>Others</b></td>
            <td bgcolor="#FFFFCC" width=160px><span class="heading"><b>Comments</b></td>


        </tr>



<?php

   
    $totalQty = "totalQuantity_".(string)$mac_nam;               
    $$totalQty = 0;

    $rejectQty = "rejectQuantity_".(string)$mac_nam;               
    $$rejectQty = 0;
    // $totalQuantity_BMV601 = 0;  
    // $rejectQuantity_BMV601 = 0; 
    $totalQuantity=0;
    $rejectQuantity=0;

   


        $result = $newreport->get_prodrecord($machine_name,$cond);
        while ($myrow = mysql_fetch_row($result)) 
        {
          // echo "<pre>"; print_r($myrow); exit;

              if($myrow[1] != '0000-00-00' && $myrow[1] != '' && $myrow[1] != 'NULL')
              {
                  $datearr = split('-', $myrow[1]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $date1=date("M j, Y",$x);
              }
              else
              {
                  $date1 = '';
              }
              $totalQuantity = $totalQuantity + $myrow[6];
              $rejectQuantity = $rejectQuantity + $myrow[15];
           // echo "<tr><td>$totalQuantity</td></tr>";


?>
            <tr>

              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $date1 ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[4] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[5] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[6] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[7] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[15] ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[23] ?></td>              
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[8] ." h " .  $myrow[9] . " m " ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[10] ." h " .  $myrow[11] . " m " ?></td>
              
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[18] ." h " .  $myrow[19] . " m " ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[20] ." h " .  $myrow[21] . " m " ?></td>
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[16] ." h " .  $myrow[17] . " m " ?></td>
              <!--<td bgcolor="#FFFFFF"><span class="tabletext"><span class="tabletext"><?php echo $myrow[22] ?></span>-->
              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[12] ." h " .  $myrow[13] . " m " ?></td>

              </td>

              <td bgcolor="#FFFFFF"><span class="tabletext"><textarea rows="2" cols="30" 
                       style="background-color:#DDDDDD;" readonly="readonly"><?php echo $myrow[14] ?></textarea>
               </td>

            </tr>
<?php 
         } 

        $totalQty = "totalQuantity_".(string)$mac_nam;               
        $$totalQty = $totalQuantity;

        $rejectQty = "rejectQuantity_".(string)$mac_nam;               
        $$rejectQty = $rejectQuantity;


        $machines_arr[$machine_name][] = $totalQuantity;
        $machines_arr[$machine_name][] = $rejectQuantity;
         // $totalQuantity_BMV601 = $totalQuantity;
         // $rejectQuantity_BMV601 = $rejectQuantity;
      // echo "<tr><td>SADFADFA $rejectQuantity</td></tr>";


      echo "<td ></td><td></td><td></td><td></td><td bgcolor=\"#FFFFFF\"><span class=\"tabletext\"> <b>Total Qty:</b></td><td id='tQ".$mcname."' bgcolor=\"#FFFFFF\" ><span class=\"tabletext\">$totalQuantity</td>";

      echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\"> <b>Total Rej<br>Qty:</b></td><td id='tQ1".$mcname."' bgcolor=\"#FFFFFF\" ><span class=\"tabletext\">$rejectQuantity</td>";

       echo "</tr>";
       echo "</table>";
       echo "</div>";

?>
      </table>
</br>


 <?php } } ?>





<table border=1 cellpadding=0 cellspacing=0  align="center" class="stdtable" >

<tr><td colspan=5 bgcolor="#00DDFF" align="center"><span class="Welcome"><b>Total Quantity Machine-wise</b></td></tr>
    <tr > 
      <td bgcolor="#FFFFCC" align="center"><span class="heading"><span class="Welcome"><b>M/C Name</b></td>
      <td bgcolor="#FFFFCC" align="center"><span class="Welcome"><b>Qty Prod</b></td>
  		<td bgcolor="#FFFFCC" width=15% align="center"><span class="Welcome"><b>Qty Rej</b></td>
      <td bgcolor="#FFFFCC" width=25% align="center"><span class="Welcome"><b>From&nbsp;&nbsp;&nbsp;</b></td>
      <td bgcolor="#FFFFCC" width=25% align="center"><span class="Welcome"><b>To&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
    </tr>

<?php 
    



 
   foreach ($machines_arr as $key => $mc_detail) 
    { 

   
      ?>

        <tr>
       <td align="center"><span class="heading"><?php echo $mc_detail[0];?></td>
       <td id="val<?php echo $mc_detail['0']?>" align=center><span class="tabletext"><?php echo $mc_detail[4];?></td>
       <td id="val1<?php echo $mc_detail['0']?>" align=center><span class="tabletext"><?php echo $mc_detail[5];?></td>
       <td id="tf<?php echo $mc_detail['1']?>" class="tabletext" align="center"><span class="tabletext"><?php echo $mc_detail[2];?></td></td>
       <td id="tt<?php echo $mc_detail['1']?>" class="tabletext" align="center"><span class="tabletext"><?php echo $mc_detail[3];?></td></td>
     </tr> 



   <?php }
   ?>  

     

</table>
<!-- </td>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr>
 -->


</table>
</table>
</div>

<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
	<td align=left>
  <?php
//  Added on Dec 6,04 for paging

$numrows = 10;

// how many pages we have when using paging?
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
    $prev = " <a href=\"stockgrn_status.php\">[Prev]</a> ";

    $first = " <a href=\"stockgrn_status.php\">[First Page]</a> ";
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
  $next = " <a href=\"stockgrn_status.php\">[Next]</a> ";

  $last = " <a href=\"stockgrn_status.php\">[Last Page]</a> ";
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
// End additions on Dec 6,04

?>
</td>
</tr></table>

</body>
</html>
