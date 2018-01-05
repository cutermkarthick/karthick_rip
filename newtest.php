<?php session_start();
	header("Cache-control: private"); ?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mfg.js"></script>

<html>
<head>
<title>test</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processGeneric.php' method='post' enctype='multipart/form-data'>
<?php 
	
	include('header.html');$_SESSION['pagename'] = 'newpage'; 
	//////session_register('pagename'); 
		         ?> 
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome </b></td>
<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td></td></tr>
<tr>
<td>
<?php
		          include('classes/displayClass.php'); 
		          $newdisp = new display;
	$newdisp->dispLinks(); 
	?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
<tr><td><span class="heading"><b>test</b></td></tr>
<tr>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b></b></center></td>
	        </tr><tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>w</b></center></td>
	        </tr><tr bgcolor="#FFFFFF" width=100%><td><span class="labeltext"><p align="left">date</p></font></td>
			    <td><input type="text" name="string1" 
                    			style="background-color:#DDDDDD;" 
                   			 readonly="readonly" size=12 value="">
             				<img src="images/bu-getdate.gif" alt="string1" onclick="GetDate4template(string1)">
			     </td><td colspan=2>&nbsp;</td></tr>

</table>
<input type="hidden" name="action" value="new">
<input type="hidden" name="type" value="test">
</td>
type  :test<br>action  :new    <br>pagename:newtest.php
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
<td align=left>   
</td>
</tr>
</table>

<span class="tabletext"><input type="submit" 
            style="color=#0066CC;background-color:#DDDDDD;width=130;"
            value="Submit" name="submit" onclick="javascript: return check_req_fields()">
             <INPUT TYPE="RESET"
                 style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()">
</FORM>
</body>
</html>

