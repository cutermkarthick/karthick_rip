<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 18,2008                 =
// Filename: rmeditmaster.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Allows editing of RM Master                 =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'qa4efficiencyEdit';
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
<title>Edit QA Efficiency</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

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
       					<a href="../exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        				 </tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>Edit RM Master</b></td>
    </tr>


     <form action='processqa4efficiency.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Edit QA Efficiency</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PRN</p></font></td>
            <td><span class="tabletext"><input type="text" name="crn" size=20 value="<?php echo $myrow["crn"] ?>"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Release Note</p></font></td>
            <td><input type="text" name="release_note" size=20 value="<?php echo $myrow["relase_note"] ?>">
            </td>
        </tr>
        
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>WO#</p></font></td>
            <td><input type="text" name="wonum" size=20 value="<?php echo $myrow["wonum"] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
                <img src="images/bu_getwo.gif" alt="Get BookDate" onclick="Getwo4qaeff()"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>QA Date</p></font></td>
            <td><input type="text" name="qadate" size=20 value="<?php echo $myrow["qa_date"] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
                <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('qadate')"></td>
         </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Quantity Dispatched</p></font></td>
            <td><input type="text" name="qty_disp" size=20 value="<?php echo $myrow["qty_disp"] ?>">
            </td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Inspected By</p></font></td>
            <td><input type="text" name="insp_by" size=20 value='<?php echo $myrow["inspected_by"] ?>'>
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Quantity Accepted</p></font></td>
            <td><input type="text" name="qty_accp" size=20 value='<?php echo $myrow["qty_accp"] ?>'></td>
<?php
           $acceptedqty =  $myrow["qty_accp"];
           $dispatchedqty = $myrow["qty_disp"];
           $accepted_rating = round((($acceptedqty/$dispatchedqty)*100));
?>
            <td><span class="labeltext"><p align="left">Accepted Rating</p></font></td>
            <td><input type="text" name="accp_rat" size=20 value='<?php echo $accepted_rating.'%' ?>'readonly="readonly"></td>
        </tr>
         <input type='hidden' name='qa4effrecnum' value='<?php echo $qa4effrecnum; ?>'></td>
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
<span class="labeltext"><input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()">

      </FORM>
</table>

</body>
</html>
