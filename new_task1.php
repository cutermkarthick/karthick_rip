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

$_SESSION['pagename'] = 'newtask';
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/tasklistClass.php');
include('classes/displayClass.php');
$newtask = new tasklist;
$newdisplay = new display;

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/tasklist.js"></script>

<html>
<head>
<title>New Task</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processTasklist.php' method='post' >
<?php


include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
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
  <tr><td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
   <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
      <td bgcolor="#EEEFEE">
        <table width=100% border=0 cellpadding=6 cellspacing=0  >
  <td>
<tr>
<td>

<?php
if (isset($_REQUEST['m'])) {
   $m = $_REQUEST['m'];
}
else {
    $m = date(" m ");
}
if (isset($_REQUEST['y'])) {
   $y = $_REQUEST['y'];
}
else {
    $y = date(" Y ");
}
   if (isset($_REQUEST['d'])) {
   $d = $_REQUEST['d'];
}
else {
    $d = date(" d ");

}
    //$format = '%d/%m/%Y';
    //$strf = strftime($format);
    //echo "$strf\n";
    //echo  date("d m Y");
        $tdate = getdate(mktime(0,0,0,$m,$d,$y));
         $y= $tdate["year"];
         //echo  $y;
          //echo date("d m Y r");
          //$todayis = date("l, F j, Y, g:i a") ;
        //echo  $todayis;
?>
 <table border=0  bgcolor="#EEEFEE" width=100% cellspacing=1 cellpadding=2>
   <tr><td align = "center">

<script language=javascript>
function SubmitDate(ctype) {
    window.opener.SetDate(document.f.eventdate.value,ctype);
    self.close();
}
</script>


<style type="text/css">

.tcell { font-size: 10pt; }

</style>

<body bgcolor="#FFFFFF" link="#0000CC" vlink="#0000CC">

    <?
mk_drawCalendar($m,$y); ?>

<?

//*********************************************************
// DRAW CALENDAR
//*********************************************************
/*
    Draws out a calendar (in html) of the month/year
    passed to it date passed in format mm-dd-yyyy
*/
function mk_drawCalendar($m,$y)
{
    if ((!$m) || (!$y))
    {
        $m = date("m",mktime());
        $y = date("Y",mktime());

    }

    /*== get what weekday the first is on ==*/
    $tmpd = getdate(mktime(0,0,0,$m,1,$y));
    $month = $tmpd["month"];
    $firstwday= $tmpd["wday"];

    $lastday = mk_getLastDayofMonth($m,$y);

?>
<table cellpadding=2 cellspacing=0 border=1>
<tr><td colspan=7 bgcolor="#CCCCDD">
    <table cellpadding=0 cellspacing=0 border=0 width="100%">
    <tr><th width="33"><a href="new_task.php?m=<?=(($m-1)<1) ? 12 : $m-1 ?>&y=<?=(($m-1)<1) ? $y-1 : $y ?>&d=1">&lt;&lt;</a></th>
    <th><font size=2><?="$month $y"?></font></th>
    <th width="33"><a href="new_task.php?m=<?=(($m+1)>12) ? 1 : $m+1 ?>&y=<?=(($m+1)>12) ? $y+1 : $y ?>&d=1">&gt;&gt;</a></th>
    </tr></table>
</td></tr>
<tr><th width=33 class="tcell">Su</th><th width=33 class="tcell">M</th>
    <th width=33 class="tcell">T </th><th width=33 class="tcell">W</th>
    <th width=33 class="tcell">Th</th><th width=33 class="tcell">F</th>
    <th width=33 class="tcell">Sa</th></tr>
<?  $d = 1;
    $wday = $firstwday;
    $firstweek = true;

    /*== loop through all the days of the month ==*/
    while ( $d <= $lastday)
    {

        /*== set up blank days for first week ==*/
        if ($firstweek) {
            print "<tr>";
            for ($i=1; $i<=$firstwday; $i++)
            { print "<td><font size=2>&nbsp;</font></td>"; }
            $firstweek = false;
        }

        /*== Sunday start week with <tr> ==*/
        if ($wday==0) { print "<tr>"; }

        /*== check for event ==*/
        print "<td class='tcell' align=center>";
         print "<a href='new_task.php?d=$d&m=$m&y=$y'>$d</a>";

        print "</td>\n";

        /*== Saturday end week with </tr> ==*/
        if ($wday==6) { print "</tr>\n"; }

        $wday++;
        $wday = $wday % 7;
        $d++;
    }
?>
</tr></table>

<?
/*== end drawCalendar function ==*/
}
/*== get the last day of the month ==*/
function mk_getLastDayofMonth($mon,$year)
{
    for ($tday=28; $tday <= 31; $tday++)
    {
        $tdate = getdate(mktime(0,0,0,$mon,$tday,$year));
        if ($tdate["mon"] != $mon)
        { break; }
    }
    $tday--;
    return $tday;
}

?>
<script type="text/javascript">
<!--
var dayarray=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday")
var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December")

function getcurrentdate(){
var mydate=new Date()
var year=mydate.getYear()
if (year < 1000)
year+=1900
var day=mydate.getDay()
var month=mydate.getMonth()
var daym=mydate.getDate()
if (daym<10)
daym="0"+daym
var hours=mydate.getHours()
var minutes=mydate.getMinutes()
var seconds=mydate.getSeconds()
var dn="AM"
if (hours>=12)
dn="PM"
if (hours>12){
hours=hours-12
}
if (hours==0)
hours=12
if (minutes<=9)
minutes="0"+minutes
if (seconds<=9)
seconds="0"+seconds

var cdate="<big><font color='gray' face='Arial'><b>"+dayarray[day]+", "+montharray[month]+" "+daym+", "+year+" "+hours+":"+minutes+":"+seconds+" "+dn
+"</b></font></big>"
if (document.all)
document.all.clock.innerHTML=cdate
else
document.write(cdate)
}
if (!document.all)
//getthedate()
function showdate(){
if (document.all)
setInterval("getcurrentdate()",1000)
}
</script>
<font size=2>Click on date above to select</font>
<CENTER><span id="clock" class="labeltext"></span></CENTER><BR>
<body onLoad="showdate()">
</table>

 </td>
   <td>


				<div class="labeltext">
			<div class="labeltext">
				<span class="first"></span>
				<span class="last"></span>
			</div>
			<div style="text-align:center;">

 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
    <tr>
        <td  bgcolor="#DFDEDE" colspan=2><span class="labeltext"><p align="left">
        <?php echo "Task list:" . " " . $tdate["weekday"] .", " . $tdate["mday"] . " ". $tdate["month"]. " , ". $tdate["year"]?>
    </tr>

    <tr bgcolor="#EEEFEE" width=100%>
        <td bgcolor="#EEEFEE" ><span class="labeltext"><p align="left">Subject</p></font></td>
        <td><input type="text" name="task1" size=60 value=""></td>
        <input type="hidden" name="taskdate" value="<?php echo $tdate["mday"] . " ". $tdate["month"]. " , ". $tdate["year"]?>"></td>
    </tr>

 	<tr bgcolor="#EEEFEE">
        <td bgcolor="#EEEFEE"><span class="labeltext"><p align="left">Notes</p></font></td>
        <td colspan=6><textarea name="task7" rows="6" cols="45" value=""></textarea></td></td>
    </tr>

   </table>
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
        <input type="hidden" name="leadsrecnum" value="<?php echo $leadsrecnum; ?>">
        <input type="hidden" name="date" value="<?php echo date("M d Y H:i:s"); ?>">
        <span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit">
                    <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">
 </FORM>
</table>
</body>
</html>