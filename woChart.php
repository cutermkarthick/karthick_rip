<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = March 15,2005                =
// Filename: boardReport.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Dashboard                                   =
// Modified on Feb 19,2008 by Suresh           =
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
include_once('classes/userClass.php');
include_once('classes/loginClass.php');
include('classes/reportClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$username = $_SESSION['user'];
$newreport = new report;
$newdisp = new display;
$arMonths='';

?>

<?php
       $i=1;
       $j=1;
       $k=1;
$arMonths1='';
$arMonths='';
$flagb=0;
$flagm=0;
$flags=0;
$x=0;

$arMonths =  array(1 =>"Jan","Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep","Oct","Nov","Dec");
$arYears =  array(1 =>"2005","2006","2007", "2008", "2009","2010","2011","2012","2013","2014","2015");

//Getting arguments for year

if (isset($_REQUEST['fromyear']))
   {
   $fromargyear = $_REQUEST['fromyear'];
   }
else
   {

    $ar4fromyear=date("Y");
    $curmon=(int)date("m");
    $bmonth=$curmon - 6;
        if($bmonth<0)
        {
        $ar4fromyear=$ar4fromyear-1;
        }
        $fromargyear = $ar4fromyear;

    }

//echo "fromyear-" . $fromargyear ;

if (isset($_REQUEST['toyear'])) {
   $toargyear = $_REQUEST['toyear'];
}
else {
    $toargyear = date("Y");
}

//echo "toyear-" . $toargyear ;



if (isset($_REQUEST['frommonth']))
{
   $frommonth = $_REQUEST['frommonth'];
}
else
{
  $argcurmonth=(int)date("m");
  $argb6month = $argcurmonth - 5;

    if ($argb6month<0)
    {
        $l= 12 + $argb6month;
        $frommonth = $l;
    }
    elseif($argb6month==0)
    {
        $frommonth = $argb6month+12;
    }
    else
        $frommonth = $argb6month;
}

//echo "from-month" . $frommonth ;

if (isset($_REQUEST['tomonth'])) {
   $tomonth = $_REQUEST['tomonth'];
}
else {
   $curmonth=(int)date("m");
   $tomonth = $curmonth;
}
//echo "to-month" . $tomonth ;

    $month=$frommonth;
    $argyear=$fromargyear;
    $actualtomonth = $tomonth;
    $actualtoyear= $toargyear;
    $tomonth=$tomonth+1;

     if($tomonth==13)
     {
      $tomonth=($tomonth)%12;
      $toargyear=$toargyear+1;
     }


  while( $month != $tomonth or $argyear != $toargyear)

    {
        //echo "month-" . $month . " - " . $argyear . "<br>" ;
            $resultb = $newreport->getbookdates($arMonths[$month],$argyear);
	        $results = $newreport->getsheduledates($arMonths[$month],$argyear);
	        if(!$myrowb = mysql_fetch_row($resultb))
	            $x=0;
	        else
	            $x=$myrowb[0];
	        if ($flagb == 0)
	        {
		       $arScores1=$x;
		       $flagb=1;
	        }
	        else
	        {
		        $arScores1 = $arScores1 . "," . $x;

	        }
	        if(!$myrows = mysql_fetch_row($results))
	            $x=0;
	        else
	            $x=$myrows[0];
	        if ($flagb==0)
	        {
		        $arScores1=$x;
		        $flagb=1;
	        }
	        else
	        {
		        $arScores1 = $arScores1 . "," . $x;
	        }
	        if($flags == 0)
	        {
		        $arMonths1 = $arMonths[$month] . $argyear;
		        $flags=1;
	        }
	        else
	        {
		        $arMonths1 .= "," . $arMonths[$month] . $argyear;
	        }


           if( $month==12)
              {
              $argyear++;
              }
               $month=($month+1);
           if( $month>12)
              {
               $month=($month)%12;
              }

      }

         $flagb=0;
         $flagm=0;
         $flags=0;
         $x=0;
         for ($i = 1; $i <= 12; $i++) {
         	$resultb = $newreport->getopenBoards($arMonths[$i]);
          	$results = $newreport->getopenSockets($arMonths[$i]);
           	if(!$myrowb = mysql_fetch_row($resultb))
            	   $x=0;
          	else
           	       $x=$myrowb[0];
          	if ($flagb == 0)
	        {
		           $arScores2=$x;
		           $flagb=1;
	        }
	        else
	        {
		           $arScores2 = $arScores2 . "," . $x;

	        }
	        if(!$myrows = mysql_fetch_row($results))
	               $x=0;
	        else
	               $x=$myrows[0];
	        if ($flagb==0)
	        {
		            $arScores2=$x;
		            $flagb=2;
	        }
	        else
	        {
		            $arScores2 = $arScores2 . "," . $x;
	        }
	        if($flags == 0)
	        {
		            $arMonths2 = $arMonths[$i];
		            $flags=1;
	        }
	        else
	        {
		            $arMonths2 .= "," . $arMonths[$i];
	        }
    }


for ($i = 1; $i <= 12; $i++) {
    if($arMonths[$frommonth]== $arMonths[$i])
       $from= $arMonths[$i];
    }
for ($i = 1; $i <= 12; $i++) {
    if($arMonths[$actualtomonth]== $arMonths[$i])
       $to= $arMonths[$i];
    }


?>

<script language="javascript" src="scripts/dashboard.js"></script>
<script language="javascript" src="scripts/mouseover.js"></script>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>Dashboard</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0" onLoad = "parentChart('<?php echo $arMonths1;?>','<?php echo $arScores1;?>','<?php echo $arMonths2;?>','<?php echo $arScores2;?>')"><form name=chartForm>
<?php
include('header1.html');
?>

     <form action='dashboard.php' method='post'>

<table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr>
        					<td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        					<td align="right"><a href="chPassword.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/chpwd_mo.gif',1)"><img name="Image15" border="0" src="images/chpwd.gif"></a>
       					<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        				 </tr>
			</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr><td>

	</td></tr>
	<tr>
	<td>
<?php $newdisp->dispLinks(''); ?>

<table width=100% border=0 cellpadding=0 cellspacing=0  >

			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF">

<table width=100% border=0 cellpadding=6 cellspacing=0  >
       <tr><td><span class="heading"><b>Dashboard</b></td>
       </tr>
</table>
 <HR>

<!------------------------------------------------------------------------->

 <table width=100% border=0 cellpadding=6 cellspacing=0>

        <tr bgcolor="#DFDEDF">


         <td width=5%><span class="labeltext"><p align="left">From</p></font></td>
         <td width=5%><span class="labeltext"><span class="labeltext"><select name="frommonth" size="1" width="100">

                        <OPTION value='1'>Jan</OPTION>
                        <OPTION value='2'>Feb</OPTION>
                        <OPTION value='3'>Mar</OPTION>
                        <OPTION value='4'>Apr</OPTION>
                        <OPTION value='5'>May</OPTION>
                        <OPTION value='6'>Jun</OPTION>
                        <OPTION value='7'>Jul</OPTION>
                        <OPTION value='8'>Aug</OPTION>
                        <OPTION value='9'>Sep</OPTION>
                        <OPTION value='10'>Oct</OPTION>
                        <OPTION value='11'>Nov</OPTION>
                        <OPTION value='12'>Dec</OPTION></select>
          </td>

          <td width=5%><span class="heading"><b>Year</b></td>
            <td width=3%><span class="tabletext"><select name="fromyear" size="1" >
                        <OPTION>2005</OPTION>
                        <OPTION>2006</OPTION>
                        <OPTION>2007</OPTION>
                        <OPTION>2008</OPTION>
                        <OPTION>2009</OPTION>
                        <OPTION>2010</OPTION>
                        <OPTION>2011</OPTION>
                        <OPTION>2012</OPTION>
                        <OPTION>2013</OPTION>
                        <OPTION>2014</OPTION>
                        <OPTION>2015</OPTION>
                        <OPTION>2016</OPTION></select>

      <!--
             <?php

                  for ($i = 1; $i <= 6; $i++) {
                    $resultb = $newreport->getbookdates4year($arYears[$i]);
                       while ($myrow = mysql_fetch_row($resultb)) {
	                      printf('<option value=%s>%s',
                            $myrow[1],$myrow[1]);

                        }
                   }

             ?>
             </select>
        -->
            </td>


         <td width=5%><span class="labeltext"><p align="left">To</p></font></td>
         <td width=5%><span class="labeltext"><span class="labeltext"><select name="tomonth" size="1" width="100">

                        <OPTION value='1'>Jan</OPTION>
                        <OPTION value='2'>Feb</OPTION>
                        <OPTION value='3'>Mar</OPTION>
                        <OPTION value='4'>Apr</OPTION>
                        <OPTION value='5'>May</OPTION>
                        <OPTION value='6'>Jun</OPTION>
                        <OPTION value='7'>Jul</OPTION>
                        <OPTION value='8'>Aug</OPTION>
                        <OPTION value='9'>Sep</OPTION>
                        <OPTION value='10'>Oct</OPTION>
                        <OPTION value='11'>Nov</OPTION>
                        <OPTION value='12'>Dec</OPTION></select>
          </td>

       <td width=5%><span class="heading"><b>Year</b></td>
            <td width=3%><span class="tabletext"><select name="toyear" size="1" >
                        <OPTION>2005</OPTION>
                        <OPTION>2006</OPTION>
                        <OPTION>2007</OPTION>
                        <OPTION>2008</OPTION>
                        <OPTION>2009</OPTION>
                        <OPTION>2010</OPTION>
                        <OPTION>2011</OPTION>
                        <OPTION>2012</OPTION>
                        <OPTION>2013</OPTION>
                        <OPTION>2014</OPTION>
                        <OPTION>2015</OPTION>
                        <OPTION>2016</OPTION></select>

       <!--
             <?php

                  for ($i = 1; $i <= 6; $i++) {
                    $resultb = $newreport->getbookdates4year($arYears[$i]);
                       while ($myrow = mysql_fetch_row($resultb)) {
	                      printf('<option value=%s>%s',
                            $myrow[1],$myrow[1]);

                        }
                   }

             ?>
             </select>
        -->
            </td>

            <td><span class="tabletext"><input type="submit"
                      style="color=#0066CC;background-color:#DDDDDD;width=100;"
                      value="Go" name="submit"></td>
        </tr>

<!---------------------------------------------------------------------------->

</table>
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr><td>
<table width=50% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php //echo "$arScores1<br>$arStudents"; ?>
<tr bgcolor="FFFFFF">

<td width = "400"><span class="labeltext">Open/Closed Orders from <?php echo $from . " " .$fromargyear ?> to  <?php echo $to . " " . $toargyear?>

          &nbsp;
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Open  <img name="Image7" border="0" width="10" src="images/Red.jpg">&nbsp;
        Closed  <img name="Image7" border="0" width="10" src="images/Blue.jpg">

<div id=theChart >

</div></td>
</table>
<td >&nbsp;</td>
<td>





<!--
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php //echo "$arScores1<br>$arStudents"; ?>
<tr bgcolor="FFFFFF"><td width = "400"><span class="labeltext">Open Board/Socket Orders Jan-Jun 2007 &nbsp;
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     Board  <img name="Image7" border="0" width="10" src="images/Red.jpg">&nbsp;
     Socket <img name="Image7" border="0" width="10" src="images/Blue.jpg">

<div id=theChart1 >

</div></td>
</tr>
</table>

 -->




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