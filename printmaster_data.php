<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 21, 2007                 =
// Filename: printqualityplanDetails.php       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// print Quality Plan Details                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'mdDetails';
//////session_register('pagename');

// First include the class definition

include('classes/masterdataClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newmasterdata = new masterdata;
$newdisplay = new display;

$masterdatarecnum = $_REQUEST['masterdatarecnum'];

$result = $newmasterdata->getmasterdata($masterdatarecnum);
$myrow = mysql_fetch_assoc($result);

$result4mps = $newmasterdata->getmasterdata_mps($masterdatarecnum);

?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>

<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Master Data</A></b></center></td</tr>
<tr><td>&nbsp</td></tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Master Data Details</b></center></td></tr>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
 <tr bgcolor="#FFFFFF"></tr>

         <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">CIM Ref No.</p></font></td>
            <td colspan=3><span class="tabletext"><span class="tabletext"><?php echo $myrow["CIM_refnum"] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow["partname"] ?>
            </td>
            <td><span class="labeltext"><p align="left">Customer</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["customer"] ?>
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["partnum"] ?></td>
            <td><span class="labeltext"><p align="left">RM by CIM</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["RM_by_CIM"] ?>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Secondary Part Num</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["secondary_partname"] ?></td>
            <td><span class="labeltext"><p align="left">Attachments</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["attachments"] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">RM by Customer</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["RM_by_customer"] ?></td>
            <td><span class="labeltext"><p align="left">DRG Issue</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["drg_issue"] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["rm_type"] ?></td>
            <td><span class="labeltext"><p align="left">RM Specification</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["rm_spec"] ?></td>
        </tr>
        
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">COS</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["cos"] ?></td>
           <td><span class="labeltext"><p align="left">Maxruling</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["maxruling"] ?></td>
         </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Grainflow</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["grainflow"] ?></td>
            <td><span class="labeltext"><p align="left">Project</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["project"] ?></td>
         </tr>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Control(Machine Name)</p></font></td>
             <td ><span class="tabletext"><?php echo $myrow["machine_name"] ?></td>
            <td><span class="labeltext"><p align="left">Rev Status</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["revstat"] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left">Condition</p></font></td>
           <?php
            $condition = wordwrap($myrow["condition"],10,"<br />\n");
           ?>
            <td><span class="tabletext"><?php echo $condition ?></td>
            <td colspan=2>&nbsp;</td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td rowspan=3><span class="labeltext"><p align="left">Required Unit Size of RM</p></font></td>
            <td ><span class="labeltext"><p align="left">Dim 1</p></font></td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["rm_dim1"] ?></td>
         </tr>
         <tr bgcolor="#FFFFFF">
            <td ><span class="labeltext"><p align="left">Dim 2</p></font></td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["rm_dim2"] ?></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Dim 3</p></font></td>
            <td colspan=2><span class="tabletext"><?php echo $myrow["rm_dim3"] ?></td>
        </tr>
       <tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>MPS</b></center></td>
</tr>
<tr bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
<td width=10% bgcolor="#EEEFEE"><span class="heading"><b><center>Line number</center></b></td>
<td width=20% bgcolor="#EEEFEE"><span class="heading"><b><center>Mps Rev</center></b></td>
<td width=20% bgcolor="#EEEFEE"><span class="heading"><b><center>Rev Status</center></b></td>
<td width=20% bgcolor="#EEEFEE"><span class="heading"><b><center>Rev Date</center></b></td>
<td width=25% bgcolor="#EEEFEE"><span class="heading"><b><center>Control(Machine Name)</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Remarks</center></b></td>
</tr>
<?php
  while($myrow4mps = mysql_fetch_row($result4mps))
  {
?>
      <tr>
      <td width=10% bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow4mps[1] ?></td>
	  <td width=20% bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow4mps[2] ?></td>
	  <td width=20% bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow4mps[5] ?></td>
	  <td width=20% bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow4mps[6] ?></td>
      <td width=25% bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow4mps[3] ?></td>
      <td bgcolor="#FFFFFF" align=center><span class="tabletext"><?php echo $myrow4mps[4] ?></td>
      </tr>
<?php
  }
?>
</tr>

</table>


</body>
</html>
