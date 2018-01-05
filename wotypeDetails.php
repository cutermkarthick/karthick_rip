<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = July 2, 2005                 =
// Filename: wotypeDetails.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
//==============================================
session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'edit_wotype'; 
$page = "Template";
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
<title>Template Details</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
    include('header.html');
?>


<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr>
<td><span class="pageheading"><b>Details</b></td>
<td colspan=10>&nbsp;</td>
<?php 

echo "<td align=\"right\">  
<a href =\"edit_wotype.php?recnum=$recnum\"><img name=\"Image8\" border=\"0\" src=\"images/bu-edit.gif\"></a>
<input type= \"image\" name=\"Print\" src=\"images/bu-view.gif\" value=\"View Template\" 
       onclick=\"javascript:viewTemplate('$myrowp[1]','$myrowp[0]')\">";
?>
           
</tr>

</table>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable1">
<tr bgcolor="#FFFFFF" width=100%>
<td><span class="labeltext"><p align="left">Parent Name</p></td>
<td><span class="tabletext"><p align=\"left\"><?php echo $myrowp[1] ?></p></td>
<td><span class="labeltext"><p align="left">Page Name</p></td>
<td><span class="tabletext"><p align=\"left\"><?php echo $myrowp[0] ?></p></td>

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
	<td ><span class=\"tabletext\">$myrowg[0]</td>";
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
	<td <span class=\"labeltext\">&nbsp;</td>";
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


<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
<thead>
<td class="head0"><span class="heading"><b><center>Seq #</center></b></td>
<td class="head1"><span class="heading"><b><center>Label</center></b></td>
<td class="head0"><span class="heading"><b><center>Controls</center></b></td>
<td class="head1"><span class="heading"><b><center>Mandatory</center></b></td>
<td class="head0"><span class="heading"><b><center>Group</center></b></td>
<td class="head1"><span class="heading"><b><center>Status</center></b></td>
</tr>

<?php
      $i=1;
      while ($myrow = mysql_fetch_row($result)) 
     {	
	printf('<tr bgcolor="#FFFFFF">');
	$mandatory="mandatory" . $i;
	echo "<td align=\"center\"><span class=\"tabletext\">$myrow[1]</td>";
	echo "<td align=\"left\"><span class=\"labeltext\">$myrow[2]</td>";
	echo "<td align=\"left\"><span class=\"tabletext\">$myrow[4]
	          </td>";
	if ($myrow[6] == 'y')
	{
		echo "<td align=\"center\"><span class=\"tabletext\"><input type=\"checkbox\" name=\"$mandatory\" disabled size=13 value=\"\" checked></td>";
	}
	else
	{
		echo "<td align=\"center\"><span class=\"tabletext\"><input type=\"checkbox\" name=\"$mandatory\" disabled  size=13 value=\"\" ></td>";
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
	echo "<td align=\"center\"><span class=\"tabletext\">$grpdata
	         
	          </td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$myrow[8]
	          </td>";

	printf('</tr>');
	$i++;     
    }    
echo "<input type=\"hidden\" name=\"recnum\" value=$recnum>";
?>

</table>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3> 


</td></tr>

</table>
</td>

</table>
		</body>
</html>
