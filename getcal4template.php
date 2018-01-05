<?php

//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: allcalendar.php
// Calendar for setting dates.
// Revision: v1.0
//====================================


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

$index='';
if (isset($_REQUEST['index']))
{
	$index = $_REQUEST['index'];
}

?>

<script language=javascript>
function SubmitDate(ctype) {

    window.opener.SetDate4template(document.f.eventdate.value,document.f.index.value);
    self.close();
}
</script>

<html>
<head>
    <title>Date Menu: Add New Event</title>
<style type="text/css">

.tcell { font-size: 10pt; }

</style>


</head>
<body bgcolor="#FFFFFF" link="#0000CC" vlink="#0000CC">
<BODY onBlur="window.focus()">

    <? 
mk_drawCalendar($m,$y,$index); ?>

</td></tr></table>

<blockquote>
<table><tr><td valign="top">

	<form name="f" action="getcal4template.php" method="POST">

	<tr><td><b>Event Date: </b></td><td><input type=text name="eventdate" value="" size=12> <font size=2>mm/dd/yyyy</font></td></tr>	
	<input type="hidden" name="index" value="<?php echo "$index"?>">
	<tr><td><input type=button value="Submit" onclick=" javascript:SubmitDate(window.name)"></td></tr>
	</table></td></tr></table></form>

</td><td width=25 nowrap><br></td>
<td valign="top">


</blockquote>




</html>


</body>
</html>

<?

//*********************************************************
// DRAW CALENDAR
//*********************************************************
/*
    Draws out a calendar (in html) of the month/year
    passed to it date passed in format mm-dd-yyyy 
*/
function mk_drawCalendar($m,$y,$index)
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
    <tr><th width="20"><a href="getcal4template.php?index=<?php echo $index ?>&m=<?=(($m-1)<1) ? 12 : $m-1 ?>&y=<?=(($m-1)<1) ? $y-1 : $y ?>">&lt;&lt;</a></th>
    <th><font size=2><?="$month $y"?></font></th>
    <th width="20"><a href="getcal4template.php?index=<?php echo $index ?>&m=<?=(($m+1)>12) ? 1 : $m+1 ?>&y=<?=(($m+1)>12) ? $y+1 : $y ?>">&gt;&gt;</a></th>
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
        print "<a href=\"#\" onClick=\"document.f.eventdate.value='$y-$m-$d';\">$d</a>";
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

