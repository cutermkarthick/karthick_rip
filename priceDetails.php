<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: new_invoice.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new invoice                 =
//==============================================

session_start();
header("Cache-control: private");
/*
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
*/
$_SESSION['pagename'] = 'pricedetails';
$userid = $_SESSION['user'];
$page = "Invoice: Price";
//////session_register('pagename');

// First include the class definition
include_once('classes/loginClass.php');
include('classes/priceClass.php');
include('classes/displayClass.php');
$newprice = new price;
$newdisplay = new display;
$recnum=$_REQUEST['ipricerecnum'];
$custrecnum=$_REQUEST['custrecnum'];
$result = $newprice->getprice4details($recnum,$custrecnum);
$myrow = mysql_fetch_assoc($result);
$fdate=$myrow["price_valid_from"];
 if($fdate != '0000-00-00' && $fdate!= '' && $fdate != 'NULL')
 {
   $datearr = split('-', $fdate);
   $d=$datearr[2];
   $m=$datearr[1];
   $y=$datearr[0];
   $x=mktime(0,0,0,$m,$d,$y);
   $fromdate=date("M j, Y",$x);
 }
 else
 {
  $fromdate = '';
 }
$tdate=$myrow["price_valid_to"];
if($tdate != '0000-00-00' && $tdate!= '' && $tdate != 'NULL')
{
 $datearr = split('-', $tdate);
 $d=$datearr[2];
 $m=$datearr[1];
 $y=$datearr[0];
 $x=mktime(0,0,0,$m,$d,$y);
 $todate=date("M j, Y",$x);
}
 else
{
 $todate = '';
}

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/price.js"></script>

<html>
<head>
<title>Price Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
 <!--    <form action='invoiceProcess.php' method='post' enctype='multipart/form-data'>-->
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
       				<a href="exit.php" onMouseOut="MM_swapImgRestore()"
                       onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        		</tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
				<td>
				<?php
   				     $newdisplay->dispLinks('');
   				     

				?>
		<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr bgcolor="DEDFDE">
	<td width="6"><img src="images/spacer.gif " width="6"></td>
 <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellspacing=4 >
	<tr><td> -->
 <table width=100% border=0>
	<td width="100%"><span class="pageheading"><b>Price Details</b></td>
	      <td bgcolor="#FFFFFF" align="right">
 <a href ="priceEdit.php?ipricerecnum=<?php echo $recnum ?>&custrecnum=<?php echo $custrecnum ?>"><img name="Image8" border="0" src="images/editprice.gif" ></a></td>
 <td bgcolor="#FFFFFF" align="right"><input type= "image" name="Print" src="images/bu-print.gif" value="Print" onClick="javascript: printprice(<?php echo $recnum ?>)">
</td>
    </table>
  <tr>
<td>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6 class="stdtable">
 <tr bgcolor="#DDDEDD">
    <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
        </tr>
       <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
                <tr bgcolor="#FFFFFF">
                <td><span class="labeltext"><p align="left">Customer</p></font></td>
                <td ><span class="tabletext"><?php echo $myrow["name"] ?></td>
            		<td width= 16% ><span class="labeltext"><p align="left">CIM Number</p></font></td>
            		<td ><span class="tabletext"><?php echo $myrow["crn"] ?></td>
            		</tr>
              <tr bgcolor="#FFFFFF">
              <td><span class="labeltext"><p align="left"><b>CIM Partname</b></p></font></td>
                    <td><span class="tabletext"><?php echo $myrow["partname"] ?></td>
            		<td><span class="labeltext"><p align="left"><b>CIM Partnum</b></p></font></td>
                    <td><span class="tabletext"><?php echo $myrow["partnum"] ?></td>
     			</tr>
                    <tr bgcolor="#FFFFFF" colspan=3>
                 	<td><span class="labeltext"><p align="left">Valid From</p></font></td>
            		<td><span class="tabletext"><?php echo $fromdate ?>
                    </td>
            		<td><span class="labeltext"><p align="left">Valid To</p></font></td>
            		<td><span class="tabletext"><?php echo $todate ?>
                    </td>
                  </tr>
                  <tr bgcolor="#FFFFFF" colspan=3>
            		<td><span class="labeltext"><p align="left">Price</p></td>
            		<td><span class="tabletext"><?php echo $myrow["currency"] ." ". $myrow["price"] ?></td>
            		<td><span class="labeltext"><p align="left">Type</p></td>
            		<td><span class="tabletext"><?php echo $myrow["type"]?></td>
            		</tr>
            	<tr bgcolor="#FFFFFF" colspan=3>
                <td><span class="labeltext"><p align="left">Status</p></font></td>
               <td colspan=3><span class="tabletext"><?php echo $myrow["status"] ?></td>
     			 </tr>
     			 <tr bgcolor="#FFFFFF" colspan=3>
                <td><span class="labeltext"><p align="left">Remarks</p></font></td>
               <td colspan=3><span class="tabletext"><?php echo $myrow["descr"] ?></td>
     			 </tr>


        </table>
  </td>
  <table border=3 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
            <td colspan=2><span class="labeltext"><?php echo $myrow["formrev"] ?></td>
            <td colspan=2><span class="labeltext">CIMTOOLS PRIVATE LIMITED</td>
        </tr>

</table>
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr> -->
		</table>
      </FORM>
</table>
</body>
</html>
