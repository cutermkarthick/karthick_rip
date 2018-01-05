<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = April 18, 2005               =
// Filename: caseDetails.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
if ( !isset($_REQUEST['recnum']))
{
     header ( "Location: login.php" );
}
$caserecnum=$_REQUEST['recnum'];
$_SESSION['caserecnum'] = $caserecnum;
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'casedetails'; 
//////session_register('pagename');

// First include the class definition 

include('classes/userClass.php'); 
include_once('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/casesClass.php');
$newdisp = new display;
$newcase = new cases;
$newlogin = new userlogin;
$newlogin->dbconnect();

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/cases.js"></script>
<html>
<head>
<title>Case Details</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" rightmargin="0">
<form action='processCase.php' method='post' enctype='multipart/form-data'>
<table width=100% cellspacing="0" cellpadding="0" border="0">
<td>
<?php
	include('header.html');
?>
</td></tr>
<tr><td>
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;
	<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a>
</td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr><td>

<?php
	$newdisp->dispLinks(''); 
	$result = $newcase->getCaseDetails($caserecnum); 
	$myrow = mysql_fetch_row($result);
?>

</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr><td>
<span class="pageheading"><b>Case Details</b></td>
</td></tr>
<tr><td>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#FFFFFF">
    <td><span class="labeltext">Customer</td>
    <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?>
    </td>
    <td><span class="labeltext">Case #</td>
    <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[11] ?></td>
<tr bgcolor="#FFFFFF">
   <td><span class="labeltext">Date</td>
   <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[5] ?></td>
    <td><span class="labeltext">Age</td>
    <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[12] ?></td>
</tr>
<tr bgcolor="#FFFFFF">
    <td><span class="labeltext">Status</td>
    <td colspan=3><span class="tabletext"><input type="text" name="status" size=15  value="<?php echo $myrow[8] ?>"
        <span class="tabletext"><select name="statusval" size="1" width="100" onchange="onSelectStatus()">
        <option value>Please Specify
        <option value>WIP
        <option value>On Hold
        <option value>Closed
        <option value>Cancelled
        <option value>Reopen
        </select>
    </td>

</tr>
<tr bgcolor="#DDDEDD">
    <td colspan=4><span class="heading"><b>Existing Notes</b></td>
</tr>
<?php
            $result = $newcase->getNotes($caserecnum);
            printf('<tr bgcolor="#FFFFFF"><td colspan=6><textarea name="notes" rows="6" cols="100" readonly="readonly">');
            while ($mynotes = mysql_fetch_row($result)) {
                  printf("\n");
                  printf("********Added by $mynotes[2] on $mynotes[0]*******");
                  printf("\n");
                  printf($mynotes[1]);
                  printf("   \n");
            }
        
?>
        </textarea></td>
        </tr> 

<tr bgcolor="#DDDEDD">
    <td colspan=4><span class="heading"><b>Add Notes</b></td>
</tr>
<tr bgcolor="#FFFFFF">
   <td colspan=4><textarea name="newnotes" rows="3" cols="72" value=""></textarea></td>
</tr> 
<tr bgcolor="#DDDEDD">
    <td colspan=4><span class="heading"><b>Existing Action Items</b></td>
</tr>
<?php
            $result = $newcase->getAINotes($caserecnum);
            printf('<tr bgcolor="#FFFFFF"><td colspan=6><textarea name="notes" rows="6" cols="100" readonly="readonly">');
            while ($mynotes = mysql_fetch_row($result)) {
                  printf("\n");
                  printf("********Added by $mynotes[2] on $mynotes[0]*******");
                  printf("\n");
                  printf($mynotes[1]);
                  printf("   \n");
            }
        
?>
        </textarea></td>
        </tr>

<tr bgcolor="#DDDEDD">
    <td colspan=4><span class="heading"><b>Add Action Items</b></td>
</tr>
<tr bgcolor="#FFFFFF">
   <td colspan=4><textarea name="newais" rows="3" cols="72" value=""></textarea></td>
</tr> 
<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">
</table>

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
        <span class="tabletext"><input type="submit" 
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                    <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">
        
</FORM>
</td>
</tr></table>
</form>
</body>
</html>
