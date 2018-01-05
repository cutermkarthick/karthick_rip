<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = aug 23,2016                  =
// Filename: taskEntry.php                =
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
$_SESSION['pagename']='taskEntry';
$pagename=$_SESSION['pagename'];


// echo $invtcount;exit;
//////session_register('pagename');
?>

<html>
<head>
    <title>Task Entry</title>

</head>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/dashboard.js"></script>
<form action='processTask.php' method='post' enctype='multipart/form-data'>
<b>Enter Details For <?php echo $xsaction ?></b><br>
<br>

<table width=100% border=0 cellpadding=3 cellspacing=1  bgcolor="#DFDEDF" >
<!-- <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Task No</p></font></td>
            <td><input type="text" name="ref_type" value=""></td>
</tr> -->
<tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left">Task Name</p></font></td>
           <td><input type="text" name="task_name" id="task_name" value=""></td>
</tr>

<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Created Date</p></font></td>
             <td><input type="text" name="taskcreate_date" id="taskcreate_date" style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["amnd_date"] ?>">
  <img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('taskcreate_date')"></td>
</tr>
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Completed Date</p></font></td>
             <td><input type="text" name="taskcomp_date" id="taskcomp_date" style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["amnd_date"] ?>">
  <img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('taskcomp_date')"></td>
</tr>

<td bgcolor="#FFFFFF" colspan=5>
<span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="submit" name="submit" onclick="javascript: return check_req_fields()">
           <input type="hidden" name="pagename"  id="pagename" value="taskentry"> 
             </td>
</form>
</html>

