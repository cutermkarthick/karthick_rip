<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 17, 2008                =
// Filename: rmmasterdetails.php               =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// RM Master Details                           =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'qa4efficiencyDetails';
//////session_register('pagename');

// First include the class definition

include('classes/qa4efficiencyClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newQA = new qa4efficiency;
$newdisplay = new display;

$qa4effrecnum = $_REQUEST['qa4effrecnum'];

$result = $newQA->getqadata($qa4effrecnum);
$myrow = mysql_fetch_assoc($result);

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/qa4efficiency.js"></script>

<html>
<head>
<title>QA Efficiency Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
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

<?php  $newdisplay->dispLinks(''); ?>

</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
<td><span class="pageheading"><b>QA Efficiency data</b><td colspan=250></td>
    <td bgcolor="#FFFFFF" rowspan=2 align="right">
   <a href ="qa4efficiencyEdit.php?qa4effrecnum=<?php echo $qa4effrecnum ?>" ><img name="Image8" border="0" src="images/bu-edit.gif" ></a>

</td>
  </tr>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>QA Efficiency Details</b></center></td></tr>


 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
 <tr bgcolor="#FFFFFF"></tr>

         <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">PRN</p></font></td>
            <td><span class="tabletext"><span class="tabletext"><?php echo $myrow["crn"] ?></td>
            <td><span class="labeltext"><p align="left">Release Note</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["relase_note"] ?>
            </td>
        </tr>
  <?php  if($myrow["qa_date"] != '0000-00-00' && $myrow["qa_date"] != '' && $myrow["qa_date"] != 'NULL')
            {
              $datearr = split('-', $myrow["qa_date"]);
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
  ?>
        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">WO#</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow["wonum"] ?></td>
            <td width=25%><span class="labeltext"><p align="left">QA Date</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $date1 ?></td>
        </tr>


        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">Quantity Dispatched</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow["qty_disp"] ?>
            </td>
            <td><span class="labeltext"><p align="left">Inspected By</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["inspected_by"] ?>
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Quantity Accepted</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["qty_accp"] ?></td>
<?php
           $acceptedqty =  $myrow["qty_accp"];
           $dispatchedqty = $myrow["qty_disp"];
           $accepted_rating = round((($acceptedqty/$dispatchedqty)*100));
?>
            <td><span class="labeltext"><p align="left">Accepted Rating</p></font></td>
            <td><span class="tabletext"><?php echo ($accepted_rating).'%' ?></td>
        </tr>


</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

</tr>

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
      </FORM>
</table>
</body>
</html>
