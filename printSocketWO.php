<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: printSocketWO.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Displays Print Socket WO details.           =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];

// First include the class definition 

include_once('classes/loginClass.php');
include('classes/socketClass.php');
include('classes/workorderClass.php');
include('classes/datesClass.php');


if ( !isset ( $_REQUEST['typenum'] ) )
{
     header ( "Location: login.php" );
    
}
$typenum = $_REQUEST['typenum'];

if ( !isset ( $_REQUEST['worecnum']) )
{
     header ( "Location: login.php" );
    
}
$worecnum = $_REQUEST['worecnum'];
$_SESSION['typenum'] = $typenum; 
$_SESSION['worecnum'] = $worecnum; 
//////session_register('typenum');
$newlogin = new userlogin;
$newlogin->dbconnect();
$newsocket = new socket; 
$newwo = new workOrder; 

$result = $newsocket->getGenInfo($worecnum);
$myrow = mysql_fetch_row($result);
$result = $newsocket->getAddrInfo($worecnum);
$myaddr = mysql_fetch_row($result);
$result = $newsocket->getSocketDetails($typenum); 
$mySocket = mysql_fetch_row($result);
$partarr = $newsocket->getParts($typenum); 
$newDates = new dates; 
$timeline = $newDates->getdates('WO', $worecnum,'Socket');
?>
<link rel="stylesheet" href="style.css">


<html>
<head>
<title>Socket</title>
</head>



<table width=630 border=0>
<tr><td><font style="Arial" size=5 color="#000000"><font face="Arial"><center><b><A HREF="javascript:window.print()">Socket Work Order</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>
  
<table width=630 border=1 rules=none>
<?php

            
            printf('<tr><td colspan=6><font face="Arial" size=4><center><b>General Information</b></center></td></tr>
                      <tr><td colspan=2><span class="tabletext"><b>Customer</b></td>
                          <td><span class="tabletext">%s</td>
                          <td colspan=2><span class="tabletext"><b>Work Order</b></td>
                          <td><span class="tabletext">%s</td>
                      </tr>
                      <tr><td colspan=2><span class="tabletext"><b>Description</b></td>
                          <td colspan=4><span class="tabletext">%s</td>
                      </tr>
                      <tr> 
                          <td colspan=2><span class="tabletext"><b>Quote #</b></td>
                          <td><span class="tabletext">%s</td>
                          <td colspan=2><span class="tabletext"><b>PO#</b></td>
                          <td><span class="tabletext">%s</td>
                      </tr>

                      ',
		      $myrow[2],$myrow[0],$myrow[7],$myrow[4],$myrow[3]);

                    printf('
                        <td colspan=3><font style="Arial"><center><b>Billing Address</b></center></td>
                        <td colspan=3><font style="Arial"><center><b>Shipping Address</center></b></td>
                     </tr>
                      <tr>
                          <td colspan=3><span class="tabletext">%s &nbsp; %s</td>
                          <td colspan=3><span class="tabletext">%s&nbsp; %s</td>
                      </tr>
                      <tr>
                          <td colspan=3><span class="tabletext">%s&nbsp; %s</td>
                          <td colspan=3><span class="tabletext">%s&nbsp; %s</td>
                     
                      </tr>
                      <tr>
                          <td colspan=3><span class="tabletext">%s&nbsp; %s</td>
                          <td colspan=3><span class="tabletext">%s&nbsp; %s</td>
                      </tr>

                      ',
		      $myaddr[6],$myaddr[7],$myaddr[12],$myaddr[13],$myaddr[8],$myaddr[9],
                      $myaddr[14],$myaddr[15],$myaddr[10],$myaddr[11],$myaddr[16],$myaddr[17]);
?>

          </table>
       <table border=1 width=630 rules=all frame=box>
        <tr bgcolor="#DDDEDD">
            <td colspan=5><center><b>Timeline & Owner</b></center></td>
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
                     <td><span class="heading"><b><i><?php echo $mytl[1] ?></i></b></td>
                     <td><span class="heading"><?php if ($mytl[2] != '0000-00-00') echo $mytl[2] ?></td>
                     <td><span class="heading"><?php if ($mytl[4] != '0000-00-00') echo $mytl[4] ?></td>
<?php 
                  if ($mytl[10] != 'Cust')
                  {
?>
                      <td><span class="heading"><?php echo $mytl[12] ?></td>
<?php    
                  }   
                  else 
                  {
?>
                      <td><span class="heading"><?php echo $mytl[14] ?></td>

<?php  
                  }
?>
<?php 
                 if ($mytl[10] != 'Cust') 
                 {
?>
                     <td><span class="heading"><?php echo $mytl[16] ?></td>
<?php        
                 } 
                 else 
                 {
?>
                     <td><span class="heading"><?php echo $mytl[18] ?></td>

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

            printf('<tr><td colspan=6><font style="Arial"><center><b>Contact Details</b></center></td></tr>
                      <tr><td colspan=2><span class="tabletext"><b>Contact</b></td>
                          <td><span class="tabletext">%s %s<br>%s</td>
                          <td colspan=2><span class="tabletext"><b>Phone</b></td>
                          <td><span class="tabletext">%s</td>
                      </tr>',
                    $myrow[8],$myrow[9],$myrow[11],$myrow[10]);
?>
          </table>
          <table border=1 width=630 rules=none>

<?php
            printf('<tr><td colspan=6><font style="Arial" size=4><center><b>Socket Information</b></center></td></tr>
                      <tr><td width=70><span class="tabletext"><b>Device</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Socket PN</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Qty</b></td>
                          <td width=130><span class="tabletext">%s</td>
                      </tr>
                      <tr><td width=130><span class="tabletext"><b>Contacts</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Lid PN</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Qty</b></td>
                          <td width=130><span class="tabletext">%s</td>
                      </tr>

                      <tr><td width=130><span class="tabletext"><b>Body Size</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Other PN 1</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Qty</b></td>
                          <td width=130><span class="tabletext">%s</td>
                      </tr>
                      <tr><td width=130><span class="tabletext"><b>Pitch</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Other PN 2</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Qty</b></td>
                          <td width=130><span class="tabletext">%s</td>
                      </tr>
                      <tr><td width=130><span class="tabletext"><b>Contact Type</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Other PN 3</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Qty</b></td>
                          <td width=130><span class="tabletext">%s</td>
                      </tr>
                      <tr><td width=130><span class="tabletext"><b>Match FP</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Contact PN</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Qty</b></td>
                          <td width=130><span class="tabletext">%s</td>
                      </tr>
                      <tr><td><span class="tabletext"><b>Estimated Cost</b></td>
                          <td><span class="tabletext">%s</td>
                      </tr>
 
                      ',
		$mySocket[0],$partarr[0],$partarr[1],$mySocket[1],$partarr[3],$partarr[4],
                $mySocket[2],$partarr[6],$partarr[7],$mySocket[3],$partarr[9],$partarr[10],
                $mySocket[4],$partarr[12],$partarr[13],$mySocket[5],$partarr[15],$partarr[16],
                $mySocket[6]);

?>
          </table>
          <table border=1 width=630 rules=none>
<?php
            printf('<tr><td colspan=6><center><b>Process Steps</b></center></td></tr>');
            $arr = split(",",$mySocket[15]);
            printf(' <tr>&nbsp</tr>');
            printf('<tr><td colspan=6><span class="tabletext">1. %s</tr>',$arr[0]);
            printf('<tr><td colspan=6><span class="tabletext">2. %s</tr>',$arr[1]);
            printf('<tr><td colspan=6><span class="tabletext">3. %s</tr>',$arr[2]);
            printf('<tr><td colspan=6><span class="tabletext">4. %s</tr>',$arr[3]);
?>
          </table>
          <table border=1 width=630 rules=none>
<?php
         
            printf('<tr><td colspan=6><center><b>Special Instructions</b></center></td></tr>');
            printf('<tr><td colspan=4><span class="tabletext">&nbsp</tr>');
            printf('<tr><td colspan=6><span class="tabletext">%s</tr>',$mySocket[17]);
        
?>
        </textarea></td>
        </tr> 
        
          </table>
            <table border=0 width=630>

            <tr><td colspan=4><center><b>Approvals</b></center></td></tr>
            <tr>&nbsp</tr>
            <tr>&nbsp</tr>
            <tr><td>Sales</td><td>Engineering</td><td>&nbsp;&nbsp;&nbsp;&nbsp;QB</td><td>&nbsp;&nbsp;&nbsp;&nbsp;QA</td></tr>
            <tr><td>_________</td><td>_________</td><td>_________</td><td>_________</td></tr>
            <tr><td>_________</td><td>_________</td><td>_________</td><td>_________</td></tr>
             
        </tr>
        </table>

 

      </FORM>



     </table>
    </td>
</tr>
</table>



</body>
</html>
