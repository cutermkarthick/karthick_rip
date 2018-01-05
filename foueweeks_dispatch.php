<?php
//===========================
// Author: FSI                                           
// Date-written = August 12, 2009              
// Filename: crnreport.php                         
// Copyright of Badari Mandyam, FluentSoft 
// Revision: v1.0 WMS                               
// Displays CRN Stock Summary list.            
//===========================

session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
//////////session_register('pagename');

// First include the class definition
include_once('classes/reportClass.php');
include_once('classes/helperClass.php');
include_once('classes/displayClass.php');

$newdisplay = new display;
$newreport = new report;
$newhelper = new helper;
$rowsPerPage = 10;
$crn_disp=$_REQUEST['crn_disp'];
$ftrigger=$_REQUEST['ftrigger'];



if (!isset($_REQUEST['ftrigger']) or 
     $ftrigger == '' or
   ($ftrigger != 'ALL' && 
    $ftrigger != 'all' && 
    $ftrigger != 'TREAT' &&
    $ftrigger != 'treat' && 
    $ftrigger != 'WO' && 
    $ftrigger != 'wo' && 
    $ftrigger != 'RMPO'))
    $ftrigger = 'rmpo';
// by default we show first page
$pageNum = 1;
$crnarr = array();
$crnonlyarr = array();

$dispcrnarr = array();
$dispcrnarr1 = array();
// poarr stores the key as order date (60 days subtracted from sch date)
$poarr = array();
// podtarr stores the sch date with order date as key needed for printing
$podtarr = array();
// wotrigarr stores the key as wo create date 
// (60 days subtracted from sch date)
$wotrigarr = array();
// wodtarr stores the sch date with wo create date as key 
//  needed for printing
$wodtarr = array();

// treattrigarr stores the key as wo create date 
// (60 days subtracted from sch date)
$treattrigarr = array();
// wodtarr stores the sch date with wo create date as key 
//  needed for printing
$treatdtarr = array();

/*$schweekarr = array('2015-07-20','2015-07-27',
           '2015-08-03','2015-08-10','2015-08-17','2015-08-24','2015-08-31',
           '2015-09-07','2015-09-14','2015-09-21','2015-09-28','2015-10-05',
           '2015-10-12','2015-10-19','2015-10-26','2015-11-02','2015-11-09',
           '2015-11-16','2015-11-23','2015-11-30','2015-12-07','2015-12-14',
           '2015-12-21','2015-12-28'
           );
*/
$schweekarr = array();

// Create the work-week(52 weeks from today) array starting from 
// run date week's beginning Monday
$wwbegindate1= date("Y-m-d", strtotime('monday this week'));
$wwbegindate= date("Y-m-d", strtotime('monday this week'));
array_push($schweekarr,$wwbegindate);
$newdate = date("Y-m-d", strtotime($wwbegindate . "+7 day"));
for ($x = 0; $x <= 4; $x++) {
    $newdate = date("Y-m-d", strtotime($wwbegindate . "+7 day"));
  array_push($schweekarr,$newdate);
  $wwbegindate = $newdate;
} 
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>

<table  width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
<td colspan=7 align="center" bgcolor="#00DDFF"><span class="heading"><b>FOUR WEEKS PENDING DISPATCH</b></td>
</tr>
<tr>
<td align="center" colspan=7><span class="heading"><b>Search Criteria</b></td>
</tr>

<tr>
 <td valign='top' bgcolor="#FFFFFF"><span class="labeltext"><b>PRN:</b>&nbsp;
<input type="text" size=10% name="crn_disp" id="crn_disp" value="<?echo $_REQUEST['crn_disp'] ?>">
<img src="images/bu-get.gif" value="Get"
onclick="javascript: get4weekspendingdisp('pending_dispatch')"></b></b></td>
</tr>

<tr bgcolor='#FFFFFF'><td>
<?php



$crnkarray = array();
$partnumarray = array();
$bufferarray = array();

  
$lobresult = $newreport->getpenddelivery_sch4weeks($crn_disp);
        
while($mylobrow=mysql_fetch_row($lobresult))
{
          $crn1 = $mylobrow[0];
           $date = $mylobrow[1];             
           $qty = $mylobrow[2];
           $partnum = $mylobrow[3];
           $buffer = $mylobrow[4];

   
          $datedi  = date("Y-m-d", strtotime($wwbegindate1 . "+7 day"));
            
        // echo $datedi . "  " . $wwbegindate1 ."<BR>" ;
      if ($newhelper->dateDiff('-', $date, $datedi ) <0)
         {
          // echo $crn1 .  "--" . $qty ."<Br>";                        
         $crnarr[$crn1][$wwbegindate1]
          += $qty;

        }
      else 
      { 

        $crnarr[$crn1][$date] = $qty;

      }
        $crndispyarr[$crn1] = $crn1;
        $partnumarr[$crn1] = $partnum;
        $bufferarr[$crn1] = $buffer;
      
}

?>
<table align="top"   style="table-layout: fixed;width:100%;"  style="border:1px solid #000000;" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<thead>
<tr bgcolor="#FFCC00">
<td width="50px"  align="center" bgcolor="#EEEFEE"><span class="labeltext" align="center"><b>PRN</b></td>
<td width="50px"  align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>Part#</b></td>

<?php
$ft = 0;

for ($z=0;$z<=4;$z++) 
{ 
  
    $date1 = $schweekarr[$z];
  $datearr = split('-', $date1);
    $d=$datearr[2];
    $m=$datearr[1];
    $y=$datearr[0];
    $x=mktime(0,0,0,$m,$d,$y);
  if ($ft == 0)
  {
       $schdate1=date("M j, Y",$x);
      echo "<td align=\"center\" width=\"70px\" bgcolor=\"#00DDFF\" align=\"left\"><span class=\"schtext\" ><b>WW<br/>starting<br> $schdate1<br>(Potential Backlog)</b></td>";
      $schdateb = $date1 ;
    }
  else
  {
       $schdate1=date("M j, Y",$x);
      echo "<td align=\"center\" width=\"50px\" bgcolor=\"#00DDFF\" align=\"left\"><span class=\"schtext\" ><b>WW<br/>starting<br> $schdate1</b></td>";
    }
  $ft = 1;
}


  $i = 0;
  $suffix = '';
?>
</tr>
 </thead>
</table>
<div style="width:100%; height:100; overflow-y:auto; hidden;border:" class="stdtable">
<table align="top"   style="table-layout: fixed;width:100%;"   style="border:1px solid #000000;" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<thead>


<?php

foreach ($crndispyarr as $crn) 
{
  $crnflag = 0;
    $partnum = $partnumarr[$crn];
    $buffer = $bufferarr[$crn];
    $colorval2 ="style=background-color:#00DDFF" ;
    $crnarrval = explode("-", $crn);
    $crnval = $crnarrval[0];
  

    printf('<tr bgcolor="#FFFFFF" >
      <td bgcolor="#FFFFFF" align="center" width="50px" %s><span class="labeltext"><font color="black">%s</font></td>
      <td bgcolor="#FFFFFF" align="center" width="50px" ><span class="labeltext">%s</td>
      ',
    $colorval2,$crn,$partnum);


   
  
for ($j=0; $j<=4; $j++) 
{

    
    $data = '';
    $thisweek = $j;
    $nextweek = $thisweek+1;
    $fromdate = $schweekarr[$thisweek];
      $todate = $schweekarr[$nextweek];
           
     $flag =  0; 
      foreach ($crnarr as $key => $value) 
      {
    
      foreach ($value as $dispdate => $data1) 
      {

        
         $data=''; 
        
     
      if($key ==  $crn)
        { 
         if (check_in_range($fromdate, $todate, $dispdate))
     {
               
                    $data = $data1 ;
           
          echo "<td width=\"70px\" align=\"center\"><span class=\"labeltext\">$data</td>";
                $flag = 1 ;
            
     }
    

    
   }  
        
  
    
  }
}


 if($flag != 1)
{
  //echo "<br/>".$crn." " .$fromdate. " ".$todate." ".$dispdate ." ".$data1." ".$flag. "<br/>";
        
  echo "<td width=\"50px\" align=\"center\"></td>";
}


}

}

function check_in_range($start_date, $end_date, $date_from_user)
{
  // Convert to timestamp
  $start_ts = strtotime($start_date);
  $end_ts = strtotime($end_date);
  $user_ts = strtotime($date_from_user);

 // Check that user date is between start & end
 

  return (($user_ts >= $start_ts) && ($user_ts < $end_ts));
}
?>
</thead>
</table>
</div>
