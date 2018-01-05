<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = July 2, 2005               =
// Filename: edit_wotype.php                         =
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
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'edit_wotype'; 
//////session_register('pagename');

include('classes/userClass.php'); 
include_once('classes/loginClass.php');
include('classes/displayClass.php'); 
include('classes/pagefieldsClass.php'); 
$newPfields = new pagefields; 
$newdisp = new display;
$recnum=$_REQUEST['recnum'];

$newlogin = new userlogin;
$newlogin->dbconnect();

$result = $newPfields ->getFields($recnum);
$resultg = $newPfields ->getGroups($recnum);
$resultp = $newPfields ->getPname($recnum);
$myrowp = mysql_fetch_row($resultp);

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/wotype.js"></script>
<html>
<head>
<title>New WO Type</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<form  action="processwotype.php" method='post' enctype='multipart/form-data'>

<?php
    include('header.html');
?>
<input type="hidden" name="parent" value="<?php echo "$myrowp[1]";?>">

<table width=100% cellspacing="0" cellpadding="6" border="0">

<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td><span class="welcome"><b>Welcome 	</b></td>
<td align="right">&nbsp;
    <a href="exit.php" onMouseOut="MM_swapImgRestore()"        
    onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0"         src="images/logout.gif"></a>
</td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>
<?php
	$newdisp->dispLinks(''); 
?>
</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#FFFFFF" width=100%>
<td><span class="labeltext"><p align="left">Parent Name</p></td>
<td ><input type="text" size=30  name="pname" value="<?php echo "$myrowp[1]";?>" readonly= "readonly"></td>

<td><span class="labeltext"><p align="left">*Page Name</p></td>
<td ><input type="text" size=30  name="pname" value="<?php echo "$myrowp[0]";?>"></td>

</tr>
<?php
$i=0;$j=1;
while ($myrowg = mysql_fetch_row($resultg))
{
	if($i%2 == 0)
	{
		echo"<tr bgcolor=\"#FFFFFF\" width=100%>";
	}
	echo "<td><span class=\"labeltext\"><p align=\"left\">Group$j</p></td>
	<td ><input type=\"text\" size=30  name=\"grp$j\" value=\"$myrowg[0]\"></td>";
	if($i%2 != 0)
	{
		echo"</tr>";
	}
	$i++; $j++;
}
while ($i < 4)
{
	if($i%2 == 0)
	{
		echo"<tr bgcolor=\"#FFFFFF\" width=100%>";
	}
	echo "<td><span class=\"labeltext\"><p align=\"left\">Group$j</p></td>
	<td ><input type=\"text\" size=30  name=\"grp$j\" value=\"\"></td>";
	if($i%2 != 0)
	{
		echo"</tr>";
	}
	$i++;  $j++;
}
if( $j % 2 == 0 )
{
	echo "<td colspan=2>&nbsp;</td></tr>";
}
?>

<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow4edit('myTable',document.forms[0].index1.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>     												


<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Seq #</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Label</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Controls</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Mandatory</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Group</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Status</center></b></td>
</tr>

<?php
      $i=1;
      while ($myrow = mysql_fetch_row($result)) 
     {	
	printf('<tr bgcolor="#FFFFFF">');
	$seqnum="seqnum" . $i;
	$prevseqnum="prevseqnum" . $i;
	$typerecnum="typerecnum" . $i;
	$lname="lname" . $i;
	$type="type" . $i;
	$typeval="typeval" . $i;
	$mandatory="mandatory" . $i;
	$getbut="getbut" . $i;
	$getbutval="getbutval" . $i;
	$status="status" . $i;
	$statusval="statusval" . $i;
	$group="group" . $i;
	$groupval="groupval" . $i;
	echo "<td align=\"center\"><span class=\"tabletext\"><input type=\"text\"  name=\"$seqnum\"  value=\"$myrow[1]\" size=\"5%\" readonly=\"readonly\"></td>";
	echo "<td align=\"center\"><input type=\"text\" name=\"$lname\" size=\"20%\" value=\"$myrow[2]\"></td>";
	echo "<td align=\"center\"><span class=\"tabletext\"><select name=\"$type\" size=\"1\" width=\"100%\" onchange=\"onSelecttype($i)\">";
	echo "<option selected>$myrow[4]
	          </td>";
	if ($myrow[6] == 'y')
	{
		echo "<td align=\"center\"><span class=\"tabletext\"><input type=\"checkbox\" name=\"$mandatory\" size=13 value=\"\" checked></td>";
	}
	else
	{
		echo "<td align=\"center\"><span class=\"tabletext\"><input type=\"checkbox\" name=\"$mandatory\" size=13 value=\"\" ></td>";
	}
	$k=1;
	$resultg = $newPfields ->getGroups($recnum);
	while ($myrowg = mysql_fetch_row($resultg))
	{
		//echo "myrowg:$myrowg[0]    :myrow:$myrow[7]<br>";
		if($myrowg[0] == $myrow[7])
		{
			//echo "i am here";
			$grpdata="Group" . $k;
			break;
		}
		$k++;
	}
	echo "<td align=\"center\"><span class=\"tabletext\"><select name=\"$group\" size=\"1\" width=\"100\"  onchange=\"onSelectbut($i)\">";
	echo "<option selected>$grpdata
	         <option value>Group1
	         <option value>Group2
	         <option value>Group3
	         <option value>Group4
	          </td>";
	echo "<td align=\"center\"><span class=\"tabletext\"><select name=\"$status\" size=\"1\" width=\"100\"  onchange=\"onSelectbut($i)\">";
	echo "<option selected>$myrow[8]
	         <option value>Active
	         <option value>InActive
	          </td>";

	echo "<input type=\"hidden\" name=\"$typeval\" value=\"Text\">";
	echo "<input type=\"hidden\" name=\"$groupval\" value=\"Group1\">";
	echo "<input type=\"hidden\" name=\"$statusval\" value=\"$myrow[8]\">";
	echo "<input type=\"hidden\" name=\"$typerecnum\" value=\"$myrow[0]\">";
	echo "<input type=\"hidden\" name=\"$prevseqnum\" value=\"$myrow[1]\">";

	printf('</tr>');
	$i++;     
    }    
echo "<input type=\"hidden\" name=\"index1\" value=$i>";
echo "<input type=\"hidden\" name=\"recnum\" value=$recnum>";
?>

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
		</body>
</html>
