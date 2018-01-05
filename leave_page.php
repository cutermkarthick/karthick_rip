<?php 
  
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'attendancesummary';
$page="ELM: Leave";


?>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.8.24/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<html>
<head>
<title>Leave MGMT</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
<?php

 include('header.html');
include_once('classes/leaveClass.php');
$newleave = new leave;
if(isset($_REQUEST['status'])&&isset($_REQUEST['recnum']))
{
    $newleave->updateStatus($_REQUEST['recnum'],$_REQUEST['status']);
}
$myleaves=$newleave->myLeaves($_SESSION['userrecnum']);
$emplLeaves=$newleave->emplLeaves();
?>



<div id="tabs">
  <ul>
    <li><a href="#fragment-1"><span>My Leaves</span></a></li>
    <li><a href="#fragment-2"><span>Employee Leaves</span></a></li>
  </ul>
  <div id="fragment-1">
    
    

    <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px" onClick="location.href='new_leave.php'" value="Request Leave" >
   
    <table width=80% align='center' border=1 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
        <thead>
            <tr>
                <th  class="head0"><b>Id</b></th>
                <th  class="head1"><b>From</b></th>
                <th  class="head0"><b>To</b></th>
                <th  class="head1"><b>Requested On</b></th>
            </tr>
        </thead>
        
            <?php
            $i=0;
            while($row=mysql_fetch_assoc($myleaves))
            {
                
            ?>
            <tr bgcolor="#FFFFFF">
                <td><b><span class="tabletext"><?php echo $row['recnum']?></span></b></td>
                <td><b><span class="tabletext"><?php echo $row['from']?></span></b></td>
                <td><b><span class="tabletext"><?php echo $row['to']?></span></b></td>
                <td><b><span class="tabletext"><?php echo $row['created_date']?></span></b></td >
            </tr>
            <?php
            }
            ?>
       
    
    </table>

  </div>

  <div id="fragment-2">
    <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px" onClick="location.href='new_employee_leave.php'" value="Add Leave" >
    <table width=80% align='center' border=1 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
        <thead>
            <tr>
                <th  class="head0"><b>Id</b></th>
                <th  class="head1"><b>From</b></th>
                <th  class="head0"><b>To</b></th>
                <th  class="head1"><b>Requested On</b></th>
                <th  class="head1"><b>Status</b></th>
                <th  class="head1"></th>
            </tr>
        </thead>
        
            <?php
            $i=0;
            while($row=mysql_fetch_assoc($emplLeaves))
            {
                
            ?>
            <tr bgcolor="#FFFFFF">
                <td><b><span class="tabletext"><a href="employee_leave_details.php?recnum=<?php echo $row['recnum']?>"><?php echo $row['recnum']?></a></span></b></td>
                <td><b><span class="tabletext"><?php echo $row['from']?></span></b></td>
                <td><b><span class="tabletext"><?php echo $row['to']?></span></b></td>
                <td><b><span class="tabletext"><?php echo $row['created_date']?></span></b></td>
                <td><b><span class="tabletext"><?php echo $row['status']?></span></b></td>
                <td><b><span class="tabletext"><a href="leave_page.php?status=1&recnum=<?php echo $row['recnum']?>&epl=1">Approve</a>/<a href="leave_page.php?status=0&recnum=<?php echo $row['recnum']?>&epl=1">Reject</a></span></b></td>
            </tr>
            <?php
            }
            ?>
   
    
    </table>
  </div>
  
</div>
 
<script>
$( "#tabs" ).tabs();
</script>

<?php if(isset($_REQUEST['epl']))
{
    ?>
    <script>
$( "#tabs" ).tabs({ active: 1 });
</script>
<?php
}
?>