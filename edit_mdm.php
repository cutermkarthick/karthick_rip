<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2006                =
// Filename: quoteDetailsEntry.php             =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new quotes                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'edit_mdm';
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/mdmclass.php');
include('classes/displayClass.php');


$newlogin = new userlogin;
$newlogin->dbconnect();


$newdisplay = new display;
$newmdm = new mdm;

$mdmrecnum = $_REQUEST['mdmrecnum'];
$result = $newmdm->getmdm($mdmrecnum);
$myrow = mysql_fetch_row($result);


?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mdm.js"></script>


<html>
<head>
<title>New MDM</title>
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

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>New MDM</b></td>
    </tr>


     <form action='processmdm.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>MDM Header</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>CIM Ref Num.</p></font></td>
            <td width=25%><span class="tabletext"><input type="text" name="refnum" size=20 value="<?php echo $myrow[1] ?>"></td>
            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part No.</p></font></td>
            <td width=25%><input type="text" name="partnum" size=20 value="<?php echo $myrow[2] ?>"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Name</p></font></td>
            <td><input type="text" name="partname" size=20 value="<?php echo $myrow[3] ?>"></td>
            <td><span class="labeltext"><p align="left">DRG Issue</p></font></td>
            <td><input type="text" name="drg_issue" size=20 value="<?php echo $myrow[4] ?>">
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Attachments</p></font></td>
            <td><input type="file" name="attachments" size=20 value="<?php echo $myrow[5] ?>"></td>
            <td><span class="labeltext"><p align="left">Raw Material Type</p></font></td>
            <td><input type="text" name="raw_mat_type" size=20 value="<?php echo $myrow[9] ?>"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Raw Material Spec</p></font></td>
            <td><input type="text" name="raw_mat_spec" size=20 value="<?php echo $myrow[10] ?>"></td>
            <td><span class="labeltext"><p align="left">Maching Cycle Time</p></font></td>
            <td><input type="text" name="maching_cycle_time" size=20 value="<?php echo $myrow[11] ?>"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Fitting Cycle Time</p></font></td>
            <td><input type="text" name="filtering_cycle_time" size=20 value="<?php echo $myrow[12] ?>"></td>
            <td><span class="labeltext"><p align="left">Inopectun Cycle Time</p></font></td>
            <td><input type="text" name="inopectun_cycle_time" size=20 value="<?php echo $myrow[13] ?>"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Type</p></font></td>
            <td><input type="text" name="part_type" size=20 value="<?php echo $myrow[14] ?>"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
            <td><input type="text" name="customer" size=20 value="<?php echo $myrow[15] ?>"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Project</p></font></td>
            <td colspan=3><input type="text" name="project" size=20 value="<?php echo $myrow[16] ?>"></td>
        </tr>

<input type="hidden" name="action" value="edit">
<input type="hidden" name="mdmrecnum" value="<?php echo $mdmrecnum ?>">
<?php
 //echo "quotetype:$quotetype";
//$wotype="test2";
// $ctrls=$newpage->createjs4quote("Quote",$quotetype) ;
 //$ctrls=$newpage->createctrls("Quote",$quotetype) ;
//echo "$ctrls";
?>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Unit RM Size</b></center></td>
</tr>

<!--<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>-->
<tr bgcolor="#FFFFFF">


<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim1</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim2</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Dim3</center></b></td>
</tr>
<tr>
   <td bgcolor="#FFFFFF" align=center><input type="text" name="dim1" size=10 value="<?php echo $myrow[6] ?>"></td>
   <td bgcolor="#FFFFFF" align=center><input type="text" name="dim2" size=10 value="<?php echo $myrow[7] ?>"></td>
   <td bgcolor="#FFFFFF" align=center><input type="text" name="dim3" size=10 value="<?php echo $myrow[8] ?>"></td>
</tr>

</table>
	</td>
    </tr>


    </td>

     <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

         <tr bgcolor="#FFFFFF">


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
