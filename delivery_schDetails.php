<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 29, 2010                =
// Filename: delivery_schDetails.php           =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Displays Delivery Sch Details               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$_SESSION['pagename'] = 'delivery_sch';
$page = "MES: delivery Sch";
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/delivery_schClass.php');
include('classes/displayClass.php');


$newlogin = new userlogin;
$newlogin->dbconnect();


$newdisplay = new display;
$newdelivery_sh = new deliverye_sch;

$recnum = $_REQUEST['recnum'];
$cond='where recnum='.$recnum;
$result = $newdelivery_sh->getdelivery_sch_dets($cond);
$myrow = mysql_fetch_row($result);
$remarks=wordwrap($myrow[4],105,"\n",true);

if($myrow[2] != '0000-00-00' && $myrow[2] != '' && $myrow[2] != 'NULL')
           {
              $datearr = split('-', $myrow[2]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $sch_date=date("M j, Y",$x);
           }
           else
           {
              $sch_date = '';
           }
$hours = floor($myrow[5] / 60);
$mins = intval($myrow[5] % 60);
if($hours == '0')
{
$req_time = $mins.' Mins';
}else{
$req_time = $hours.' hrs '.$mins. '  mins ';
}

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/nc4qa.js"></script>


<html>
<head>
</script>
<title>Delivery Schedule Details</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

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
       					<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        				 </tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
	     		     <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0>
    <tr>
        <td >
        <table width=100% border=0 cellpadding=6 cellspacing=0>
        <tr>
        <td><span class="pageheading"><b>Delivery Schedule Details</b></td>
<?
$status=$_REQUEST['status'];
if($status=='edit')
{
    echo "<td><font color='green'>Delivery Schedule for PRN#: <font color='red'> ". $myrow[1]."</font> Updated successfully.</font></td>";
}
$checkif18=explode('-',$myrow[1]);
if(($dept !='QA' && $dept !='PPC2' && $dept !='PPC3' && $dept !='PPC4' && $dept != 'PPC5'))
{
?>
<td bgcolor="#FFFFFF" align="right">
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='edit_delivery_sch.php?recnum=<?php echo $recnum ?>'" value="Edit" >
  <!-- <a href ="edit_delivery_sch.php?recnum=<?php echo $recnum ?>"><img name="Image8" border="0" src="images/bu-edit.gif" ></a> -->
</td>
<?php
}
if(($dept == 'PPC5' && $checkif18[0] == '18'))
{
?>
<td bgcolor="#FFFFFF" align="right"><a href ="edit_delivery_sch.php?recnum=<?php echo $recnum ?>"><img name="Image8" border="0" src="images/bu-edit.gif" ></a></td>
<?php
}
?>
<!--<td bgcolor="#FFFFFF" align="right"><a href ="edit_delivery_sch.php?recnum=<?php echo $recnum ?>"><img name="Image8" border="0" src="images/bu-edit.gif" ></a></td> -->
</tr>
</table>
</tr>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable" bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">          
          <td  width='20%'><span class="labeltext"><p align="left">Scheduled Qty</p></font></td>
            <td width='30%'><span class="tabletext"><?php echo $myrow[3] ?></td>   
           <td  width='20%'><span class="labeltext"><p align="left">Dispatch UTD</p></font></td>
            <td width='30%'><span class="tabletext"><?php echo $myrow[8] ?></td>
        </tr>
   <tr bgcolor="#FFFFFF">

  <td width='20%'><span class="labeltext"><p align="left">PRN.</p></font></td>
            <td width='30%'><span class="tabletext"><?php echo $myrow[1] ?></td>
             <td  width='20%'><span class="labeltext"><p align="left">Partnumber</p></font></td>
            <td width='30%'><span class="tabletext"><?php echo $myrow[7] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Scheduled Date</p></font></td>
            <td ><span class="tabletext"><?php echo $sch_date ?></td>           
 <td><span class="labeltext"><p align="left">Time Required</p></font></td>
            <td><span class="tabletext"><?php echo $req_time ?></td>

</tr>
  <tr bgcolor="#FFFFFF">
  <td><span class="labeltext"><p align="left">Status</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[6] ?></td>
            <td><span class="labeltext"><p align="left">Customer</p></font></td>
            <td  colspan=3><span class="tabletext"><?php echo $myrow[9] ?></td>
</tr> 
      <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Remarks.</p></font></td>
            <td colspan=3><span class=\"tabletext\"><textarea  name="remarks" rows="3"
                          style="background-color:#DDDDDD;" readonly="readonly"
			              cols="100" value=""><?php echo $remarks." \n" ?></textarea></td>
            </td>
        </tr>
       



</table></table>
</td>
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr> -->

</table>

</table>
</body>
</html>
