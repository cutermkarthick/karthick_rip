<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = aug 23,2016                  =
// Filename: newsEntry.php                =
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
$xsaction = $_REQUEST['reasontext'];
$userid = $_SESSION['user'];
$_SESSION['pagename']='newsEntry';
$pagename=$_SESSION['pagename'];


// echo $invtcount;exit;
//////session_register('pagename');
?>

<html>
<head>
    <title>News Entry</title>

</head>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/dashboard.js"></script>
<form action='processNews.php' method='post' enctype='multipart/form-data'>
<b>Enter Details For <?php echo $xsaction ?></b><br>
<br>

<table width=100% border=0 cellpadding=3 cellspacing=1  bgcolor="#DFDEDF" >
<!-- <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Task No</p></font></td>
            <td><input type="text" name="ref_type" value=""></td>
</tr> -->
<tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left">Created by</p></font></td>
           <td><input type="text" name="created_by" id="created_by" style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $userid;?>"></td>
</tr>

<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Date</p></font></td>
             <td><input type="text" name="Date" id="Date" style="background-color:#DDDDDD;" readonly="readonly" size=10% value="">
  <img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('Date')"></td>
</tr>
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Description</p></font></td>
             <td><textarea  name="descr" id="descr" cols="27" rows=3 size=20 value="">
  </textarea>
  </td>
</tr>

<td bgcolor="#FFFFFF" colspan=5>
<span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="submit" name="submit" onclick="javascript: return check_req_fields_news()">
            
             </td>
</form>
</html>

