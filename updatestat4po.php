<?php
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

include('classes/liClass.php');
$newLI = new po_line_items;
$prevponum = '';
$firsttime = 1;
$flag = 0;
$resultset1= $newLI->getallpolidetails4postat();
while($myresult1=mysql_fetch_assoc($resultset1))
{

     if ($firsttime == 1)
     {
               $firsttime = 0;
	       $prevponum = $myresult1['ponum'];
               $currponum = $prevponum;
	       echo "<br>====================================================";
	       echo "<br>PO num is " . $myresult1['ponum'];
     }

     if ($prevponum != $myresult1['ponum'])
     {
         if ($flag == 0) 
	 {
               $newLI->updatestat4po($prevponum);
         }
	 else 
	 {
               $flag = 0;
         }
	 echo "<br>====================================================";
	 echo "<br>PO num is " . $myresult1['ponum'];
         $prevponum = $myresult1['ponum'];
	 $currponum = $prevponum;
     }
     echo"<BR>status for crn " .  $myresult1['crn'] . " is " .$myresult1['listat'];
     if ($myresult1['listat'] != 'Close')
     {
            $flag = 1;
     }
}
if ($flag == 0) 
{
           $newLI->updatestat4po($prevponum);
}
echo "<br>====================================================";

?>
