<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = September 20, 2006           =
// Filename:  mailDetails.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Mail Details                                =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'mailDetails';
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/emailClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$newdisplay = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>

<html>
<head>
<title>Mail Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="3" border="0">
<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;
<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>
<?php    $newdisplay->dispLinks('');
 ?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">

  <?php
$day=$_REQUEST['day'];
$month=$_REQUEST['month'];
$year=$_REQUEST['year'];
 //echo $day;
 //echo $month;
 //echo $year;
   $tdate = getdate(mktime(0,0,0,$month,$day,$year));
      //echo  $tdate["month"];
     // echo  $tdate["weekday"];

?>
 <table border=0  bgcolor="#EEEFEE" width=100% cellspacing=1 cellpadding=2>
   <tr><td align = "center">
      <?php
if (isset($_REQUEST['m'])) {
   $m = $_REQUEST['m'];
}
else {
    $m = '';
}
if (isset($_REQUEST['y'])) {
   $y = $_REQUEST['y'];
}
else {
    $y = '';
}

?>

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
<BODY onBlur="window.focus()">

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
    <tr><th width="20"><a href="calendar.php?m=<?=(($m-1)<1) ? 12 : $m-1 ?>&y=<?=(($m-1)<1) ? $y-1 : $y ?>">&lt;&lt;</a></th>
    <th><font size=2><?="$month $y"?></font></th>
    <th width="20"><a href="calendar.php?m=<?=(($m+1)>12) ? 1 : $m+1 ?>&y=<?=(($m+1)>12) ? $y+1 : $y ?>">&gt;&gt;</a></th>
    </tr></table>
</td></tr>
<tr><th width=22 class="tcell">Su</th><th width=22 class="tcell">M</th>
    <th width=22 class="tcell">T </th><th width=22 class="tcell">W</th>
    <th width=22 class="tcell">Th</th><th width=22 class="tcell">F</th>
    <th width=22 class="tcell">Sa</th></tr>
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
        print "<td class='tcell'>";
         print "<a href='test9.php?day=$d&month=$m&year=$y'>$d</a>";

        print "</td>\n";

        /*== Saturday end week with </tr> ==*/
        if ($wday==6) { print "</tr>\n"; }

        $wday++;
        $wday = $wday % 7;
        $d++;
    }
?>
</tr></table>
<font size=1>Click on date above to select</font>
<br>

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

   </td>
   <td>

 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
    <tr>

  <td  bgcolor="#DFDEDE" colspan=2><span class="labeltext"><p align="left">
    <?php echo "Task list:" . $tdate["weekday"] . "  ". $day . "  ". $tdate["month"]. "  ".$year?>
     </tr>
    <tr bgcolor="#FFFFFF">
            <td  bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="left">10:00</p></font></td>
            <td><input type="text" name="terms" size=100% value=""></td>
        </tr>
    <tr bgcolor="#FFFFFF">
            <td  bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="left">11:00</p></font></td>
           <td><input type="text" name="terms" size=100% value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="left">12:00</p></font></td>
            <td><input type="text" name="terms" size=100% value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="left">13:00</p></font></td>
            <td><input type="text" name="terms" size=100% value=""></td>
         </tr>
     <tr bgcolor="#FFFFFF">
            <td  bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="left">14:00</p></font></td>
            <td><input type="text" name="terms" size=100% value=""></td>
        </tr>
    <tr bgcolor="#FFFFFF">
            <td  bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="left">15:00</p></font></td>
            <td><input type="text" name="terms" size=100% value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="left">16:00</p></font></td>
            <td><input type="text" name="terms" size=100% value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="left">17:00</p></font></td>
           <td><input type="text" name="terms" size=100% value=""></td>
         </tr>

</table>



</td></tr></table>
      </td>


</td>
  <td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>
		</table>

      </FORM>

</table>

</body>
</html>