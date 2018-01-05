<?php
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: getcalendar.php
// Calendar for setting dates.
// Revision: v1.0
//====================================
session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}

if (isset($_REQUEST['m'])) {
   $m = $_REQUEST['m'];
}
else {
    $m = '';
}
if (isset($_REQUEST['y']))
{
   $y = $_REQUEST['y'];
}
else
{
    $y = '';
}
?>

<script language=javascript>
function SubmitDate(ctype)
{
    // alert('hi1');
    window.opener.SetDate(document.f.eventdate.value,ctype);
    self.close();
}
function setnewdate()
{
	//alert("In setnew");
	var m1=document.getElementById('month').value;
	var y1=document.getElementById('year').value;
	window.location='getcalendar.php?m='+m1+'&y='+y1;}
</script>
<html>
<head>
<title>Date Menu: Add New Event</title>
<style type="text/css">

.tcell { font-size: 10pt; }

</style>
</head>
<body bgcolor="#FFFFFF" link="#0000CC" vlink="#0000CC">

    <? 
mk_drawCalendar($m,$y); ?>
</td></tr></table>

<table border=0 width='100%'>
<tr><td valign="top">
<form name="f" action="getcalendar.php" method="POST">
<tr><td align='left'><b><font size=2>EventDate:</b><input type=text name="eventdate" value="" readonly="readonly" size=12><font size=2>yyyy/mm/dd</font></td></tr>
<tr><td><input type=button value="Submit" onclick=" javascript:SubmitDate(window.name)"></td></tr>
</table></td></tr></table></form>
</td><td width=35 nowrap><br></td>
<td valign="top">
</blockquote>

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
<table cellpadding=2 cellspacing=0 border=1 width='100%' >
<tr><td colspan=7 bgcolor="#3BB9FF">
    <table cellpadding=0 cellspacing=0 border=0 width="100%" bgcolor='#3BB9FF'>
    <tr>
<!--
<th width="20"><a href="getcalendar.php?m=<?=$m ?>&y=<?=$y-1?>" style="color:red">&lt;&lt;</a></th>

    <th width="20"><a href="getcalendar.php?m=<?=(($m-1)<1) ? 12 : $m-1 ?>&y=<?=(($m-1)<1) ? $y-1 : $y ?>">&lt;</a></th>

    <th><font size=2><?="$month $y"?></font></th>
    <th width="20"><a href="getcalendar.php?m=<?=(($m+1)>12) ? 1 : $m+1 ?>&y=<?=(($m+1)>12) ? $y+1 : $y ?>">&gt;</a></th>

    <th width="20"><a href="getcalendar.php?m=<?=$m ?>&y=<?=$y+1?>"style="color:red">&gt;&gt;</a></th>
-->

<td>
<td>
<select name="month" id="month" onChange="javascript:setnewdate()">
<option <?php echo (($m=='01')?"selected":"")?> value="01">January</option>
<option <?php echo (($m=='02')?"selected":"")?> value="02">February</option>
<option <?php echo (($m=='03')?"selected":"")?> value="03">March</option>
<option <?php echo (($m=='04')?"selected":"")?> value="04">April</option>
<option <?php echo (($m=='05')?"selected":"")?> value="05">May</option>
<option <?php echo (($m=='06')?"selected":"")?> value="06">June</option>
<option <?php echo (($m=='07')?"selected":"")?> value="07">July</option>
<option <?php echo (($m=='08')?"selected":"")?> value="08">August</option>
<option <?php echo (($m=='09')?"selected":"")?> value="09">September</option>
<option <?php echo (($m=='10')?"selected":"")?> value="10">October</option>
<option <?php echo (($m=='11')?"selected":"")?> value="11">November</option>
<option <?php echo (($m=='12')?"selected":"")?> value="12">December</option>
</select>
</td>
<td>
<select name="year" id="year" onChange="javascript:setnewdate()">
<option <?php echo (($y=='2005')?"selected":"")?> value="2005">2005</option>
<option <?php echo (($y=='2006')?"selected":"")?> value="2006">2006</option>
<option <?php echo (($y=='2007')?"selected":"")?> value="2007">2007</option>
<option <?php echo (($y=='2008')?"selected":"")?> value="2008">2008</option>
<option <?php echo (($y=='2009')?"selected":"")?> value="2009">2009</option>
<option <?php echo (($y=='2010')?"selected":"")?> value="2010">2010</option>
<option <?php echo (($y=='2011')?"selected":"")?> value="2011">2011</option>
<option <?php echo (($y=='2012')?"selected":"")?> value="2012">2012</option>
<option <?php echo (($y=='2013')?"selected":"")?> value="2013">2013</option>
<option <?php echo (($y=='2014')?"selected":"")?> value="2014">2014</option>
<option <?php echo (($y=='2015')?"selected":"")?> value="2015">2015</option>
<option <?php echo (($y=='2016')?"selected":"")?> value="2016">2016</option>
<option <?php echo (($y=='2017')?"selected":"")?> value="2017">2017</option>
<option <?php echo (($y=='2018')?"selected":"")?> value="2018">2018</option>
<option <?php echo (($y=='2019')?"selected":"")?> value="2019">2019</option>
<option <?php echo (($y=='2020')?"selected":"")?> value="2020">2020</option>
<option <?php echo (($y=='2021')?"selected":"")?> value="2021">2021</option>
<option <?php echo (($y=='2022')?"selected":"")?> value="2022">2022</option>
<option <?php echo (($y=='2023')?"selected":"")?> value="2023">2023</option>
<option <?php echo (($y=='2024')?"selected":"")?> value="2024">2024</option>
<option <?php echo (($y=='2025')?"selected":"")?> value="2025">2025</option>
</select>
</td>
    </tr></table>
</td></tr>
<tr><th width=22 class="tcell">Su</th><th width=22 class="tcell">Mon</th>
    <th width=22 class="tcell">Tue </th><th width=22 class="tcell">Wed</th>
    <th width=22 class="tcell">Thu</th><th width=22 class="tcell">Fri</th>
    <th width=22 class="tcell">Sat</th></tr>
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
</tr>
</table>

<table cellpadding=2 cellspacing=0 border=0 width='100%' >
<tr>
<td align='left'><font size=1>< <b><a href="getcalendar.php?m=<?=(($m-1)<1) ? 12 : $m-1 ?>&y=<?=(($m-1)<1) ? $y-1 : $y ?>">Previous</a></b></font></td>
<td align='center'><font size=1>Click on date above to select</font></td>   
<td align='right'><font size=1>> <b><a href="getcalendar.php?m=<?=(($m+1)>12) ? 1 : $m+1 ?>&y=<?=(($m+1)>12) ? $y+1 : $y ?>">Next</a></b></font></td>
</table>
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

</body>
</html>

