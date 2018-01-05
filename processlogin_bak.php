<?php

//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2004                 =
// Filename: processLogin.php                  =
// Copyright (C) FluentSoft Inc.               =
// Revision: v1.0 OMS                          =
// Process the Login page                      =
//==============================================
$pagename = $_REQUEST['pagename'];

if ($pagename == "login") 
{
  if ( !isset ( $_POST['userName'] ) )
  {
       header ( "Location: login.php" );
  }
  if ( !isset ( $_POST['userPassword'] ) )
  {
       header ( "Location: login.php" );
  }
  if ( !isset ( $_POST['siteid'] ) )
  {
       header ( "Location: login.php" );
  }

  $userName = $_POST['userName'];
$userPassword = $_POST['userPassword'];
$siteid = $_POST['siteid'];
}
// First include the class definition
include_once('classes/loginClass.php');
include_once('classes/userClass.php');

include_once('classes/empClass.php');
include_once('classes/companyClass.php');


// $ipaddr=$_REQUEST['ipaddr'];


// Next, create an instance of the class
$newLogin = new userlogin;
$newUser = new user;
$newemp = new emp;
$newCompany = new Company;

//	$userName == 'venkanna' || $userName == 'nuthanhr'))
// if (($ipaddr != '115.248.178.121' &&  
//      $ipaddr != '122.166.45.146' &&
//      $ipaddr != '127.0.0.1') &&
//     ( $userName == 'ppc' || $userName == 'shantala' || 
// 	$userName == 'venkanna' || $userName == 'nuthanhr'))
// {
//      header("Location:login.php");
// }

if ($pagename == "login") 

{
// Get the user type
$type = $newLogin->verifyPassword($userName, $userPassword, $siteid);

// Get the user role
 $role = $newLogin->startingPage($userName);
 //echo $role;
// Call the function to get the user recnum
 $userrecnum = $newLogin->getUserRecnum($userName);
 
 $department = $newemp->getEmpDept($userPassword);


 //echo "Type is $type\n";
 
//session_save_path("/home/virtual/dciapp.com/tmp");
//ini_set("session.save_handler",files);
// Register session key with the value
   session_start();
   $_SESSION['user'] = $userName;
//   //////session_register('user');
   $_SESSION['userrole'] = $role;
//   //////session_register('role');
   $_SESSION['usertype'] = $type;
//   //////session_register('usertype');
   $_SESSION['userrecnum'] = $userrecnum;
//   //////session_register('userrecnum');
//   session_write_close();
   $_SESSION['department'] =  $department;
   $_SESSION['siteid'] =  $siteid;
   
 //echo   $userName."----***";

// Insert into log
  $newUser->insertLog($userName, $_SESSION['user'],'Logged In');

if ($type == 'EMPL') {

   if ($department == 'Purchasing' && $role=='SU')
   {
        require('po.php');
   }
   else if ($department == 'Purchasing' && $role=='RU')
   {
        require('dispatchSummary.php');
   }

   else if ($department == 'Accounts' && $userName !='acccons')
   {
        require('reports.php');
   }
   else if ($department == 'CAD') {
        require('viewsalesorder.php' );
   }
   else if ($department == 'Sumant') {
        require('salesorder.php' );
   }
   else if ($role == 'SALES') {
        require('quote1.php' );
   }
   else if ($role == 'SA') {
        require('users.php' );
   }
   else if ($department == 'QAAPP' || $department == 'ENGAPP' || $department == 'PRODNAPP')
   {
        require('viewsalesorder.php');
   }
   else if ($department == 'Operator') {
        require('prodnEntry.php' );        
   }
   else if ($department == 'Shopfloor')
   {
        require('machine_data.php');
   }
   else if ($department == 'Sales')
   {
        require('menu.php');
   }
   else if ($department == 'PPC' || $department == 'Production'
            || $department == 'QA' || $department == 'Stores'|| $department == 'Assembly'|| $department == 'PPC1' ||$department == 'PPC4'||$department == 'PPC2'
            ||$department == 'PPC3' || $department == 'PPC5'||$department == 'PPC6')
   {
        require('menu.php');
   }
   else if ($department == 'Packing')
   {
        require('boxing.php');
   }
    else if ($department == 'Fitting')
   {
        require('womilestonerep.php');
   }
   else if($userName=='Production1')
   {
       require('womilestonerep.php');
   }
   else if($userName=='accounts')
   {
       require('invoiceSummary.php');
   }

//    else {
//         require('login.php' );
//    }
// }

   else if ($department == 'SP' && $role=='RU')
   {
        require('assypoSummary.php');
   }
   else if ($department == 'VIEW' && $role=='RU')
   {
        require('reports.php');
   }

   else {
        require('login.php' );
   }

}
else if ($type == 'CUST') {

  
        require('worderSummary.php');
   }
else if ($type == 'VEND') {
        require('mtltrksummary.php');
   }
   
else if ($type == 'CF') {
        require('mtltrksummary.php');
   }

else if ($type == 'FF') {
        require('mtltrksummary.php');
   }
   
    else 
    {

        header("Location:login.php"); 

    }


}

else if($pagename == "signup")
{
    
    $userName = $_POST['userName'];
    $password = $_POST['userName'];
    $email = $_POST['email'];
    $company = $_POST['company'];
    $phone = $_REQUEST['phone'];
    $typeval = "EMPL";

    $newUser->setloginid($userName);
    $newUser->settype($typeval);
    $newUser->setpassword(md5($password));

    $usercheck = 0;
    $acccheck = 0;

    $sql = "start transaction";
    $result = mysql_query($sql);
    $newUser->addUser();
    $sql = "commit";
    $result = mysql_query($sql);
    if(!$result) 
    {
        die("Commit failed for New User..Please report to Sysadmin. " . mysql_error());
    }
    else
    {
        $usercheck = 1;
    }

    $newCompany->setemail($email);
    $newCompany->setname($company);
    $newCompany->setphone($phone);

    $sql = "start transaction";
    $result = mysql_query($sql);
    $newCompany->addAccount();
    $sql = "commit";
    $result = mysql_query($sql);
    if(!$result)
    {
        die("Commit failed for New Account..Please report to Sysadmin. " . mysql_error());
    }
    else 
    {
        $acccheck = 1;
    }

    if ($usercheck == 1 && $acccheck == 1) 
    {
        echo "success"; exit;
    }
    else
    {
        echo "failed"; exit;
    }
    

    header("Location:login.php"); 

 
}
?>
