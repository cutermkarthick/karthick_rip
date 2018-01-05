<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: getboarddes.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Popup for selecting board designers         =
//==============================================
session_start();
header("Cache-control: private"); 
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$userrecnum=   $_SESSION['userrecnum']; 
$worecnum=$_REQUEST['worecnum'];
//echo "$worecnum";
include_once('classes/userClass.php'); 
include_once('classes/loginClass.php'); 
include('classes/workorderClass.php');
$newlogin = new userlogin;
$newlogin->dbconnect();
$newwo = new workorder; 
if (isset ( $_REQUEST['submit'] ) )
{
     //header ( "Location: login.php" );
echo "i am set";
$notes=$_REQUEST['notes'];
$numrows = $newwo->countBookmark($userrecnum);
if($numrows<=5)
$newwo-> insertBookmark($notes,$worecnum,$userrecnum);
else
{?>
<script language=javascript>
alert("You Have Allready BookMarked 5 Work Orders");
self.close();
</script>
<?php 
}?>
<script language=javascript>
self.close();
</script>
<?php
}
?>
<html>
<head>
    <title>Book Marking</title>
</head>
<body onload=self.focus()>
<form>
Book Mark</b>
<?php
   //$result = $newemp->getBoardDes();
?>
<tr bgcolor="#FFFFFF"><td colspan=4><textarea name="notes" rows="12" cols="30">  </textarea>      </tr>
<input type="hidden" name="worecnum" value="<?php echo "$worecnum";?>">
</script>
<input type=submit name="submit" value="Submit">
</form>
</body>
</html>

