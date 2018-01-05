<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2004                 =
// Filename: printBoardWO.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Printing Board WO                           =
//==============================================
session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}


// Includes
include_once('classes/loginClass.php');
include('classes/boardClass.php');
include('classes/workorderClass.php');
include('classes/datesClass.php');


$_SESSION['typenum'] = $typenum; 
$_SESSION['worecnum'] = $worecnum; 
 $wotype =$_SESSION['wotype'];
$userid = $_SESSION['user'];

$newlogin = new userlogin;
$newlogin->dbconnect();
$newboard = new board; 
$newwo = new workOrder; 

$result = $newboard->getGenInfo($worecnum);
$myrow = mysql_fetch_row($result);
$result = $newboard->getAddrInfo($worecnum);
$myaddr = mysql_fetch_row($result);
$result = $newboard->getBoardDetails($typenum); 
$myBoard = mysql_fetch_row($result);
$result = $newboard->getParts($typenum); 
$myParts = mysql_fetch_row($result);
$newDates = new dates; 
$timeline = $newDates->getdates('WO', $worecnum,'Board');
?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>



<table width=630 border=0>
<tr><td><font style="Arial" size=5 color="#000000"><center><b><A HREF="javascript:window.print()">Board Work Order</A></b></center></td</tr>
</table>


<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>
   
<table width=630 border=1 rules=none>
<?php
         
              
              printf('<tr><td colspan=4><span class="pheading"><center><b>General Information<b></center></td></tr>
                      <tr>&nbsp</tr>
                      <tr><td width=200><span class="tabletext"><b>Customer</b></td>
                          <td width=200><span class="tabletext">%s</td>
                          <td width=200><span class="tabletext"><b>Work Order</b></td>
                          <td width=200><span class="tabletext">%s</td>
                      </tr>
                      <tr><td width=200><span class="tabletext"><b>Part Number</b></td>
                          <td width=200><span class="tabletext">%s</td>
                          <td width=200><span class="tabletext"><b>PO#</b></td>
                          <td width=200><span class="tabletext">%s</td>
                      </tr>
                      <tr><td><span class="tabletext"><b>Description</b></td>
                          <td colspan=3><span class="tabletext">%s</td>
                      </tr>
                      <tr>
                          <td width=200><span class="tabletext"><b>Quantity</b></td>
                          <td width=200><span class="tabletext">%s</td>
                          <td width=200><span class="tabletext"><b>Quote #</b></td>
                          <td width=200><span class="tabletext">%s</td>
                      </tr>
                      <tr>
                          <td width=200><span class="tabletext"><b>Reference/Spec</b></td>
                          <td width=200><span class="tabletext">%s</td>
                          <td width=200><span class="tabletext"><b>Assembly Required</b></td>
                          <td width=200><span class="tabletext">%s</td>
                      </tr>
                      
                      ',
		     $myrow[2],$myrow[0],$myParts[0],$myrow[3],$myrow[7],$myBoard[15],
                     $myrow[4],$myBoard[21],$myBoard[24],$myBoard[12]);
                    
              printf('<tr>
                    
                        <td colspan=2><span class="heading"><left><b>Billing Address</b></center></td>
                        <td colspan=2><span class="heading"><b><left>Shipping Address</center></b></td>
                        
                     </tr>
                      <tr>
                          
                          <td colspan=2><span class="tabletext">&nbsp;%s &nbsp; %s</td>
                          <td colspan=2><span class="tabletext">&nbsp;%s &nbsp; %s</td>
                     
                      </tr>
                      <tr>
                          
                          <td colspan=2><span class="tabletext">&nbsp;%s &nbsp; %s</td>
                          <td colspan=2><span class="tabletext">%s &nbsp; %s</td>
                     
                      </tr>
                      <tr>
                          
                          <td colspan=2><span class="tabletext">&nbsp;%s &nbsp; %s</td>
                          <td colspan=2><span class="tabletext">&nbsp;%s &nbsp; %s</td>
                     
                      </tr>

                      ',
		      $myaddr[6],$myaddr[7],$myaddr[12],$myaddr[13],$myaddr[8],$myaddr[9],
                      $myaddr[14],$myaddr[15],$myaddr[10],$myaddr[11],$myaddr[16],$myaddr[17]);
?>
 </table>
 <table border=1 width=630 rules=all frame=box>
        <tr bgcolor="#DDDEDD">
            <td colspan=5><span class="pheading2"><center><b>Timeline & Owner</b></center></td>
        </tr>

        <tr  bgcolor="#FFFFFF">
            <td bgcolor="#EEEFEE"><span class="heading"><b>Milestone</b></td>
	    <td bgcolor="#EEEFEE"><span class="heading"><b>Scheduled Date</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Completed Date</b></td>
	    <td bgcolor="#EEEFEE"><span class="heading"><b><center>Owner</center></b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b><center>Approved by</center></b></td>
        </tr>

<?php
        while ($mytl = mysql_fetch_row($timeline)) 
        {
              if ($mytl[22] == 'Y') 
              {
?>
                  <tr  bgcolor="#FFFFFF">
                     <td bgcolor="#FFFFFF"><span class="tabletext"><i><?php echo $mytl[1] ?></i></td>
                     <td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($mytl[2] != '0000-00-00') echo $mytl[2] ?></td>
                     <td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($mytl[4] != '0000-00-00') echo $mytl[4] ?></td>
<?php 
                  if ($mytl[10] != 'Cust')
                  {
?>
                      <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $mytl[12] ?></td>
<?php    
                  }   
                  else 
                  {
?>
                      <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $mytl[14] ?></td>

<?php  
                  }
?>
<?php 
                 if ($mytl[10] != 'Cust') 
                 {
?>
                     <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $mytl[16] ?></td>
<?php        
                 } 
                 else 
                 {
?>
                     <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $mytl[18] ?></td>

<?php
                 }
?>

                </tr>
<?php 
             }
          } 

?>                           
</table>
         <table border=1 width=630 rules=none> 

<?php

            printf('<tr><td colspan=4><span class="pheading2"><center><b>Contact Details</b></center></td></tr>
                      <tr><td><span class="tabletext"><b>Contact</b></td>
                          <td><span class="tabletext">%s %s<br>%s</td>
                          <td><span class="tabletext"><b>Phone</b></td>
                          <td><span class="tabletext">%s</td>
                      </tr>',
                    $myrow[8],$myrow[9],$myrow[11],$myrow[10]);
?>

            </table>
            <table border=1 width=630 rules=none>
<?php
            printf('<tr><td colspan=4><span class="pheading"><center><ul><b>Board Information</b></ul></center></td></tr>
                      <tr>&nbsp</tr>
                      <tr><td><span class="tabletext"><b>Board Type</b></td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext"><b>Number of Layers</b></td>
                          <td><span class="tabletext">%s</td>
                      </tr>
                      <tr><td><span class="tabletext"><b>Tester</b></td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext"><b>Board Size</b></td>
                          <td><span class="tabletext">%s</td>
                      </tr>
                      <tr><td><span class="tabletext"><b>Device</b></td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext"><b>Board Impedance</b></td>
                          <td><span class="tabletext">%s</td>
                      </tr>
                      <tr><td><span class="tabletext"><b>Pin/Pkg</b></td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext"><b>Board Thicknesss</b></td>
                          <td><span class="tabletext">%s</td>
                      </tr>
                      <tr><td><span class="tabletext"><b>Socket</b></td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext"><b>Material</b></td>
                          <td><span class="tabletext">%s</td>
                      </tr>
                      <tr><td><span class="tabletext"><b>Handler</b></td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext"><b>Sites</b></td>
                          <td><span class="tabletext">%s</td>
                      </tr>
 
                      ',
		$myBoard[0],$myBoard[7],$myBoard[1],$myBoard[8],$myBoard[2],$myBoard[9],
                $myBoard[3],$myBoard[10],$myBoard[4],$myBoard[11],$myBoard[5],$myBoard[6]);

?>
            </table>
            <table border=1 width=630 rules=none>
<?php
            printf('<tr><td colspan=4><span class="pheading"><center><ul><b>Process Steps</b></ul></center></td></tr>');
            $arr = split(",",$myBoard[16]);
            printf(' <tr>&nbsp</tr>');
            printf('<tr><td colspan=4><span class="tabletext">1. %s</tr>',$arr[0]);
            printf('<tr><td colspan=4><span class="tabletext">2. %s</tr>',$arr[1]);
            printf('<tr><td colspan=4><span class="tabletext">3. %s</tr>',$arr[2]);
            printf('<tr><td colspan=4><span class="tabletext">4. %s</tr>',$arr[3]);

?>
            </table>
            <table border=1 width=630 rules=none>
<?php
            printf('<tr><td colspan=4><span class="pheading"><center><b><ul>Special Instructions</ul></b></center></td></tr>');
            printf('<tr><td colspan=4><span class="tabletext">&nbsp</tr>');
            printf('<tr><td colspan=4><span class="tabletext">%s</tr>',$myBoard[23]);

        
?>
       </table>

</body>
</html>
