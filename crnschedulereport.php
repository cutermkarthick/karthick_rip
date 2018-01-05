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
$_SESSION['pagename'] = 'reports';
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
<title>PRN Schedule</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<form action='crnschedulereport.php' method='post' enctype='multipart/form-data'>
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
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	    <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0>
     <tr><td>
		</tr>
  <tr>
<td>
</td></tr>
<tr><td valign="top">

<table valign="top" width="100%" border=0>
<tr>
<td valign='top'><span class="pageheading"><b>PRN Schedule</b></td>
<td colspan=160>&nbsp;</td>
</tr>
</table>

<table valign="top" width="100%" align="center" border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#F5F6F5">
<td align="center" colspan=7><span class="heading"><b>Search Criteria</b></td></tr>
<tr>
<td valign='top' bgcolor="#FFFFFF"><span class="labeltext"><b>PRN:</b>&nbsp;
<input type="text" size=15% name="crn" value="<?echo $_REQUEST['crn'] ?>">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="button"><b><input type="submit" name="submit" value="Get"></b></td>
</tr>
</table>



<table align="top" style="table-layout: fixed" width="650px" border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF">
<tr bgcolor="#FFFFFF">
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>LEGEND:</b></td>
<td width="20px" height="20px" bgcolor="#00FF00"><span class="labeltext" align='center'>&nbsp</td>
<td width="55px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>Safe</b></td>
<td width="20px" bgcolor="#FFFF00"><span class="labeltext" align='center'>&nbsp</td>
<td width="90px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>Borderline</b></td>
<td width="20px" bgcolor="#00DDFF"><span class="labeltext" align='center'>&nbsp</td>
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>Qty from PO</b></td>
<td width="20px" bgcolor="#FF0000"><span class="labeltext" align='center'>&nbsp</td>
<td width="70px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>Danger</b></td>
<td width="20px" bgcolor="#FFA500"><span class="labeltext" align='center'>&nbsp</td>
<td width="100px" bgcolor="#FFFFFF"><span class="labeltext" align='center'><b>Partial</b></td>
 </tr>
</table>
<table align="top" style="table-layout: fixed" width="900px" style="border:1px solid #000000;" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFCC00">
<td  align="center" bgcolor="#EEEFEE"><span class="labeltext" align="center"><b>PRN</b></td>
<td align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>Customer</b></td>
<td align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>Sch Date</b></td>
<td align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>Qty Req</b></td>
<td align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>WO</b></td>
<td align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>GRN</b></td>
<td align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>Qty Alloc</b></td>
<td align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>Balance</b></td>
<td align="center" bgcolor="#EEEFEE"><span class="labeltext"><b>PO Qty</b></td>

<?php
   $fgflag = 0;
   $grnflag = 0;
   if($crn!='')
   {

     $fgarr = array();
     $grnarr = array();
     
     //$crnonlyarr = array();
     $fgstockresult = $newreport->getfgstock($crn);
     while($myfgstockrow=mysql_fetch_row($fgstockresult))
     {
       $fgqty = $myfgstockrow[1];
	   $cid = $myfgstockrow[0];
       $fgarr[$crn][$cid] = $qty;
	 }
     $fgqty = 0;
     $grnstockresult = $newreport->getgrnstock($crn);
     while($mygrnstockrow=mysql_fetch_row($grnstockresult))
     {
       $grnqty = $mygrnstockrow[1];
	   //echo "<br>grnqty is $grnqty";
       $grnarr[$crn] = $grnqty;
	 }
  //print_r($grnarr);
     $lobresult = $newreport->getlob($crn);
     if(mysql_num_rows($lobresult) != 0)
     {
	  while($mylobrow=mysql_fetch_row($lobresult))
	  {
?>
<tr>
 <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $mylobrow[0] ?></td>
 <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $mylobrow[1] ?></td>
 <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $mylobrow[2] ?></td>
 <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $mylobrow[3] ?></td>
<?php
/*
         if (array_key_exists($crn,$fgarr)) 
		 {
	         $fgqty = $fgarr[$crn];
             if ($fgqty > $mylobrow[3]) 
			 {
				 $allocqty = $mylobrow[3];
				 $fgqtybal = $fgqty - $mylobrow[3];
                 $fgarr[$crn] = $fgqtybal;
				 $fgflag = 1;
			 }
		 }
*/
$bgcolor = "#FFFFFF";
         if ($fgflag != 1) {
		    if (array_key_exists($crn,$grnarr)) 
		    {
	           $grnqty = $grnarr[$crn];
			   //echo "<br>grnqty is $grnqty";
               if ($grnqty > 0) 
			   {
				 if ($grnqty >= $mylobrow[3])
				 {
					 $allocqty = $mylobrow[3];
					 $grnqtybal = $grnqty - $allocqty;
					 $bgcolor = "#00FF00";
					 $balqty = 0;
                 }
				 else
				 {
					 $allocqty = $grnqty;
					 $grnqtybal = 0;
					 $bgcolor = "#FFA500";
					 $balqty = $mylobrow[3] - $allocqty;
                 }					
				 
                 $grnarr[$crn] = $grnqtybal;
				 //echo "<br>grnqtybal is $grnqtybal";
				 $grnflag = 1;
			   }
			   else 
			   {
				    $bgcolor = "#FF0000";
                    $balqty = $mylobrow[3];
			   }
		    }
	     }

?>
 <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $fgqty ?></td>
 <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $grnqty ?></td>
 <td bgcolor="<?php echo $bgcolor ?>"><span class="tabletext"><?php echo $allocqty ?></td>
 <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $balqty ?></td>
 <td bgcolor="#FFFFFF"><span class="tabletext">&nbsp</td>

</tr>
<?php
	$allocqty = 0;
    $grnqty = 0;
	$fgqty = 0;	
	$balqty = 0;
	$grnflag = 0;
	$fgflag = 0;
      }
  }
}
?>

</td></tr>
</table>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr>
</table>
</table>
</table>
</table>
</FORM>
</body>
</html>
