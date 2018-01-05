<?php

//==============================================
// Author: FSI                                 =
// Date-written: Dec 27, 2017                  =
// Filename: ProcessMenu.php                   =
// Copyright (C) FluentSoft Inc.               =
// Revision: v1.0 OMS                          =
// Process the Login page                      =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
  header ( "Location:login.php" );
}

$dept = $_REQUEST['dept'];
$urole = $_REQUEST['urole'];
$menus = $_REQUEST['menus'];
$page = $_REQUEST['page'];
$userid = $_SESSION['user'];

include('classes/menuClass.php'); 
$newmenu = new menu;

$newmenu->setdept($dept);
$newmenu->setuserrole($urole);
$newmenu->setmenus($menus);
$newmenu->setcreated_by($userid);

if ($page == "New") {
	$result = $result = $newmenu->AddMenus4Dept();
	echo $result; exit;
}
else if($page == "Edit"){
	$recnum = $_REQUEST['recnum'];
	$result = $result = $newmenu->UpdateMenus4Dept($recnum);
	echo $result; exit;
}


echo "<pre>";
print_r($_REQUEST); exit;


