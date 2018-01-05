<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 19, 2008                =
// Filename: crn_status.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Displays WO Status report                   =
//==============================================

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

// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage = 10;

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

// counting the offset
//$offset = ($pageNum - 1) * $rowsPerPage;
$offset = 2000;
include('classes/reportClass.php');
include('classes/displayClass.php');

$newreport = new report;
$newdisplay = new display;
$timer=100;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>
<script language="javascript" src="scripts/jquery.js"></script>
<html>
<head>
<!--<META HTTP-EQUIV="Refresh"
CONTENT="120">    -->
<title>WO Milestone Report</title>
<style>
frame {
font:12px arial;
width:200;
height:400;
border:none;
overflow:scroll;
border:1px solid black;
padding:5;
}
</style>
<script language="javascript">
i = 0
refreshcount = 0;
var speed = 3
function scroll() {
i = i + speed
var div = document.getElementById("news")
div.scrollTop = i
if (i > div.scrollHeight - 160) {i = 0;refreshBlock();}
t1=setTimeout("scroll()",15) ;

}
function refreshBlock()
    {  var st= document.forms[0].rb_stage.value;
	    refreshcount++;
		if (refreshcount == 20)
		{
            $('#news').load("getmilestone.php?stage="+st);
		    refreshcount = 0;
		}
    }
</script>

</head>
<body leftmargin="0"topmargin="0" marginwidth="0" onload="scroll()">
<?php
include('header.html');

?>
<form action='womilestonerep.php' method='get' enctype='multipart/form-data'>
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
 </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td></td></tr>
<tr>
<td>
<?php 
$newdisplay->dispLinks(''); 
?>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="8"></td>
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
<td width="6"><img src="images/spacer.gif " width="8"></td>
</tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr>
	<td>
  <table width=100% border=0 >
   <tr><td><span class="heading"><b>WO Milestone Report</b></td>
   <tr><td align="center">
<?php
     $selectedstage ='';
     $stagearray = array();
	 $stagearray[200] = "Stores - WO Received";
     $stagearray[210] = "Production - Docs Received";
     $stagearray[220] = "Production - Received Material";
	 $stagearray[230] = "Production - Stage Insp Done";
	 $stagearray[240] = "Production - Fitting";
	 $stagearray[250] = "QA -  Received FG";
	 $stagearray[260] = "QA- FI Completed";
	 $stagearray[270] = "PPC - FG Received";

	   $selected_stage = $_GET['rbstage'];
      // echo $selected_stage."===--===";
	 if ($selected_stage != '')
	 {
		   $arrindex = $selected_stage;
		   $selected_stagedesc = $stagearray[$arrindex];
	       echo "<span class=\"milestonetext\">Selected stage is $selected_stagedesc";
	 }
    else
	 {
	       echo "<span class=\"milestonetext\">No Stage has been selected";
	 }
?>

</td></tr>
    </tr>
   </table>
<tr><td>
<table style="table-layout: fixed" width=1210px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
           <tr>
            <td colspan=3 align="center" bgcolor="#EEEFEE"><span class="heading"><b>Please select a stage </b></td>
			<td  bgcolor="#EEEFEE" align="center"><input type="radio" name="rbstage" value="200"></td>
            <td  bgcolor="#EEEFEE" align="center"><input type="radio" name="rbstage" value="210"></td>
            <td  bgcolor="#EEEFEE" align="center"><input type="radio" name="rbstage" value="220"></td>
            <td  bgcolor="#EEEFEE" align="center"><input type="radio" name="rbstage" value="230"></td>
            <td  bgcolor="#EEEFEE" align="center"><input type="radio" name="rbstage" value="240"></td>
            <td  bgcolor="#EEEFEE" align="center"><input type="radio" name="rbstage" value="250"></td>
            <td  bgcolor="#EEEFEE" align="center"><input type="radio" name="rbstage" value="260"></td>
            <td  bgcolor="#EEEFEE" align="center"><input type="radio" name="rbstage" value="270"></td>
            <td bgcolor="#EEEFEE"  align="center"><span class="tabletext">
            <input type="submit" name="Get" src="images/bu-get.gif" value="Get"></tr>
        <tr>
            <td align=center bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></td>
            <td align=center bgcolor="#EEEFEE"><span class="heading"><b>WO #</b></td>
            <td align=center bgcolor="#EEEFEE"><span class="heading"><b>WO Dt</b></td>
            <td align=center bgcolor="#FFFF00"><span class="heading"><b>Stores</b></td>
	        <td align=center colspan=4  bgcolor="#FFA500"><span class="heading"><b>Production</b></td>
            <td align=center colspan=2 bgcolor="#00FF7F"><span class="heading"><b>QA</b></td>
            <td align=center colspan=2 bgcolor="#00FFFF"><span class="heading"><b>PPC</b>
            <input type="hidden" name="rb_stage" value="<?php echo $selected_stage  ?>"></td>
           </tr>
           <tr>
            <td bgcolor="#EEEFEE"><span class="heading"><b></b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b></b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b></b></td>
            <td  bgcolor="#FFFF00"><span class="heading"><b>WO Received</b></td>
            <td bgcolor="#FFA500"><span class="heading"><b>Docs received</b></td>
            <td bgcolor="#FFA500"><span class="heading"><b>Received<br>Material</b></td>
	        <td bgcolor="#FFA500"><span class="heading"><b>Stage<br>Insp_Done</b></td>
            <td bgcolor="#FFA500"><span class="heading"><b>Fitting</b></td>
            <td bgcolor="#00FF7F"><span class="heading"><b>Received FG</b></td>
            <td bgcolor="#00FF7F"><span class="heading"><b>FI Completed</b></td>
            <td bgcolor="#00FFFF"><span class="heading"><b>FG Received</b></td>
            <td bgcolor="#00FFFF"><span class="heading"><b>WO_Closed</b></td>
           </tr>
           </table>

<div style="width:1220px; height:550; overflow:auto;border:"  class="frame" id="news">
<table style="table-layout: fixed" width=1210px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php
    $i=0;     
    $prev_wo="#";
    $image_tick='<img name="Imaget" width=20px height=20px border="0" src="images/tick.gif">';
   $result=$newreport->getWoapproveStatus($cond,$offset,$rowsPerPage);
   $bg = 0;
   $ft = 1;
   $st200='';
   $st210='';
   $st220='';
   $st230='';
   $st240='';
   $st250='';
   $st260='';
   $st270='';
   $st280='';
   while($myrow=mysql_fetch_row($result)) 
   {
	   if ($ft == 1)
	   {
	       $prevwo = $myrow[0];
               $prevcrn = $myrow[6];
	       $prevwodt = $myrow[7];
	       $prevpriority = $myrow[8];
	   }
	   if ($ft != 1 && $prevwo != $myrow[0])
	   {

	        $st = '';
		if ($selected_stage != '')
		{
				$nextstage = $selected_stage + 10;
				if ($selected_stage == '240')
				{
                    $nextstage = $selected_stage + 10;
					$selected_stage = $selected_stage - 10;
				}
				if ($selected_stage == '230')
				{
                    $nextstage = $selected_stage + 20;
				}
				$nextstgchk = "st" . $nextstage;
			    $stcheck = "st" . $selected_stage;
		    }
			
		if ($$stcheck != '' && $$nextstgchk == '')
		{
		    if ($bg == 1)
                    {
	                 $bgcolor = "#DDDEEE";
	                 $bg = 0;
                    }
                    else if ($bg == 0)
                    {
	                $bgcolor = "#FFFFFF";
	                $bg = 1;
                    }	
                    if ($prevpriority == 'P1')
                    {
                       $bgcolor = "#FF0000";
                    }

		    if($prevwodt != '0000-00-00' && $prevwodt != '' && $prevwodt != 'NULL')
                    {
                     $datearr = split('-', $prevwodt);
                     $d=$datearr[2];
                     $m=$datearr[1];
                     $y=$datearr[0];
                     $x=mktime(0,0,0,$m,$d,$y);
                     $bookdate=date("M j, Y",$x);
                  }
                 else
                 {
                    $bookdate = '';
                 }
                 echo "<tr bgcolor=\"$trcolor\"><td bgcolor=\"$bgcolor\"><span class=\"milestonetext\">$prevcrn</td>
                    <td bgcolor=\"$bgcolor\"><span class=\"milestonetext\">$prevwo</td>
				    <td bgcolor=\"$bgcolor\"><span class=\"milestonetext\">$bookdate</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st200</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st210</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st220</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st230</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st240</td>";
			   echo "<td bgcolor=\"$bgcolor\"align=\"center\"><span class=\"milestonetext\">$st250</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st260</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st270</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st280</td>";
			   $st200='';
               $st210='';
               $st220='';
               $st230='';
               $st240='';
               $st250='';
               $st260='';
               $st270='';
               $st280='';
		   }
			$prevwo = $myrow[0];
	        $prevcrn = $myrow[6];
		    $prevwodt = $myrow[7];
		    $prevpriority = $myrow[8];

	   }
	   if ($myrow[4] != '' && $myrow[4] != '0000-00-00')
	   {
		   $stage= $image_tick;
       }
	   else
	   {
		   $stage= '';
       }
	  $stagenum = "st" . $myrow[1];
         $$stagenum = $stage;
	  $ft = 0;
   }
            if ($bg == 1)
            {
	             $bgcolor = "#EEEFFF";
	             $bg = 0;
             }
            else if ($bg == 0)
            {
	            $bgcolor = "#FFFFFF";
	            $bg = 1;
            }
                    if ($myrow[8] == 'P1')
                    {
                       $bgcolor = "#FF0000";
                    }

 			$st = '';
			if ($selected_stage != '')
		    {
				$nextstage = $selected_stage + 10;
				if ($selected_stage == '240')
				{
                    $nextstage = $selected_stage + 10;
					$selected_stage = $selected_stage - 10;
				}
				if ($selected_stage == '230')
				{
                    $nextstage = $selected_stage + 20;
				}
				$nextstgchk = "st" . $nextstage;
			    $stcheck = "st" . $selected_stage;
		    }
			
			if ($$stcheck != '' && $$nextstgchk == '')
		   {
			  	 if ($bg == 1)
                {
	                 $bgcolor = "#DDDEEE";
	                 $bg = 0;
                 }
                else if ($bg == 0)
                {
	                $bgcolor = "#FFFFFF";
	                $bg = 1;
                }
                    if ($prevpriority == 'P1')
                    {
                       $bgcolor = "#FF0000";
                    }
	       if($prevwodt != '0000-00-00' && $prevwodt != '' && $prevwodt != 'NULL')
               {
                   $datearr = split('-', $prevwodt);
                   $d=$datearr[2];
                   $m=$datearr[1];
                   $y=$datearr[0];
                   $x=mktime(0,0,0,$m,$d,$y);
                   $bookdate=date("M j, Y",$x);
                }
               else
               {
                  $bookdate = '';
               }
               echo "<tr bgcolor=\"$trcolor\"><td bgcolor=\"$bgcolor\"><span class=\"milestonetext\">$prevcrn</td>
                    <td bgcolor=\"$bgcolor\"><span class=\"milestonetext\">$prevwo</td>
				    <td bgcolor=\"$bgcolor\"><span class=\"milestonetext\">$bookdate</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st200</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st210</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st220</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st230</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st240</td>";
			   echo "<td bgcolor=\"$bgcolor\"align=\"center\"><span class=\"milestonetext\">$st250</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st260</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st270</td>";
			   echo "<td bgcolor=\"$bgcolor\" align=\"center\"><span class=\"milestonetext\">$st280</td>";
			   $st200='';
               $st210='';
               $st220='';
               $st230='';
               $st240='';
               $st250='';
               $st260='';
               $st270='';
               $st280='';
		   }
?>
</table>
</td></tr>
</table>
</td>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr>
</table>


<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
	<td align=left>

</td>
</tr></table>
</form>
</body>
</html>

