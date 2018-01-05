<?php
//==============================================
// Author: FSI                                 =
// Date-written = Jan 21, 2013                 =
// Filename: getalldn4dc.php                   =
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
// First include the class definition

include('classes/userClass.php');
include('classes/dispatchClass.php');
$newDispatch = new dispatch;

$prn=$_REQUEST['prn'];
$result=$newDispatch->getwotreatment($prn);
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
<title>DN</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
$myrow = mysql_fetch_row($result);
?>
<input type="text" name="treatment" id="treatment" style=";background-color:#DDDDDD;"   readonly="readonly" size=20 value="<?= $myrow[3] ?>">

</body>
</html>
