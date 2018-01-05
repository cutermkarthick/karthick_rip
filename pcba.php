<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2004                 =
// Filename: pcba.php                          =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// PCBA details                                =
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
include('classes/displayClass.php');
include('classes/datesClass.php');
include('classes/approvalClass.php');

$typenum = $_REQUEST['typenum'];
if ( !isset ( $typenum ) )
{
     header ( "Location: login.php" );
    
}
$worecnum = $_REQUEST['worecnum'];
if ( !isset ( $worecnum ) )
{
     header ( "Location: login.php" );
    
}
$_SESSION['typenum'] = $typenum; 
//////session_register('typenum');
$wotype = 'PCBA';
$_SESSION['wotype'] = $wotype;
//////session_register('wotype');
$_SESSION['worecnum'] = $worecnum; 
//////session_register('worecnum');
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'pcba'; 
//////session_register('pagename');

$newlogin = new userlogin;
$newlogin->dbconnect();
$newboard = new board; 
$newwo = new workOrder; 
$newapproval = new approval; 
$newdisplay = new display; 

$result = $newboard->getGenInfo($worecnum);
$myrow = mysql_fetch_row($result);
$result = $newboard->getAddrInfo($worecnum);
$myaddr = mysql_fetch_row($result);
$result = $newboard->getBoardDetails($typenum); 
$myBoard = mysql_fetch_row($result);
$result = $newboard->getParts($typenum); 
$myParts = mysql_fetch_row($result);
$newDates = new dates; 
$timeline = $newDates->getdates('WO', $worecnum,'PCBA');
?>
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/board.js"></script>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>PCBA</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>

<table width=100% cellspacing="0" cellpadding="6" border="0">

<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
    <tr>
 
        <td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        <td align="right">&nbsp;
        <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        
    </tr>
</table>


<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr><td>
	
	</td></tr>
	<tr>
	<td>
<?php    $newdisplay->dispLinks(''); 
         $newwo->UpdNotes($worecnum,$typenum,'PCBA'); 
         $newapproval->dispApprSignOff('WO', $worecnum, 'PCBA', $typenum); 
?>
</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

		

			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF">

<table width=100% border=0 cellspacing="1" cellpadding="6">
    <tr>
        <td align="left"><span class="pageheading"><b>PCBA Work Order Details</b></td>
        <td align="right">
             <img src="images/bu-print.gif" alt="Print PCBAWO"                                                  
              onclick="javascript: printPCBAWO(<?php echo $typenum,',',$worecnum ?>)">
        </td>
    </tr>

    </tr>
    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<?php

            printf('<tr bgcolor="#DDDEDD"><td colspan=6><span class="heading"><center><b>General Information</b></center></td></tr>
                      <tr bgcolor="#FFFFFF"><td><span class="tabletext"><b>Customer</b></td>
                          <td colspan=2><span class="tabletext">%s</td>
                          <td><span class="tabletext"><b>Work Order</b></td>
                          <td colspan=2><span class="tabletext">%s</td>
                      </tr>
                      <tr bgcolor="#FFFFFF"><td width=200><span class="tabletext"><b>Part Number</b></td>
                          <td colspan=2><span class="tabletext">%s</td>
                          <td><span class="tabletext"><b>PO#</b></td>
                          <td colspan=2><span class="tabletext">%s</td>
                      </tr>
                      <tr  bgcolor="#FFFFFF"><td><span class="tabletext"><b>Description</b></td>
                          <td colspan=5><span class="tabletext">%s</td>
                      </tr>
                      <tr  bgcolor="#FFFFFF">
                          <td><span class="tabletext"><b>Quantity</b></td>
                          <td colspan=2><span class="tabletext">%s</td>
                          <td><span class="tabletext"><b>Quote #</b></td>
                          <td colspan=2><span class="tabletext">%s</td>
                      </tr>
                      <tr  bgcolor="#FFFFFF">
                          <td><span class="tabletext"><b>Reference/Spec</b></td>
                          <td colspan=2><span class="tabletext">%s</td>
                          <td><span class="tabletext"><b>Designer</b></td>
                          <td colspan=2><span class="tabletext">%s %s</td>
                      </tr>
                      ',
		     $myrow[2],$myrow[0],$myParts[0],$myrow[3],$myrow[7],$myBoard[15],
                     $myrow[4],$myBoard[21],$myrow[12],$myrow[13]);

                    printf('<tr  bgcolor="#DDDEDD">
                        <td colspan=3><span class="heading"><center><b>Billing Address</b></center></td>
                        <td colspan=3><span class="heading"><b><center>Shipping Address</center></b></td>
                     </tr>
                      <tr  bgcolor="#FFFFFF">
                          <td colspan=3><span class="tabletext">%s %s</td>
                          <td colspan=3><span class="tabletext">%s %s</td>
                      </tr>
                      <tr  bgcolor="#FFFFFF">
                          <td colspan=3><span class="tabletext">%s %s</td>
                          <td colspan=3><span class="tabletext">%s %s</td>
                     
                      </tr>
                      <tr  bgcolor="#FFFFFF">
                          <td colspan=3><span class="tabletext">%s %s</td>
                          <td colspan=3><span class="tabletext">%s %s</td>
                      </tr>

                      ',
		      $myaddr[6],$myaddr[7],$myaddr[12],$myaddr[13],$myaddr[8],$myaddr[9],
                      $myaddr[14],$myaddr[15],$myaddr[10],$myaddr[11],$myaddr[16],$myaddr[17]);
?>

<?php

            printf('<tr  bgcolor="#DDDEDD"><td colspan=6><span class="heading"><center><b>Contact Details</b></center></td></tr>
                      <tr bgcolor="#FFFFFF"><td><span class="tabletext"><b>Contact</b></td>
                          <td colspan=2><span class="tabletext">%s %s<br>%s</td>
                          <td><span class="tabletext"><b>Phone</b></td>
                          <td colspan=2><span class="tabletext">%s</td>
                      </tr>',
                    $myrow[8],$myrow[9],$myrow[11],$myrow[10]);
            printf('<tr  bgcolor="#DDDEDD"><td colspan=5><span class="heading"><center><b>Board Information</b></center></td></tr>
                      <tr bgcolor="#FFFFFF"><td><span class="tabletext"><b>Board Type</b></td>
                          <td colspan=2><span class="tabletext">%s</td>
                          <td><span class="tabletext"><b>Number of Layers</b></td>
                          <td colspan=2><span class="tabletext">%s</td>
                      </tr>
                      <tr bgcolor="#FFFFFF"><td><span class="tabletext"><b>Tester</b></td>
                          <td colspan=2><span class="tabletext">%s</td>
                          <td><span class="tabletext"><b>Board Size</b></td>
                          <td colspan=2><span class="tabletext">%s</td>
                      </tr>
                      <tr bgcolor="#FFFFFF"><td><span class="tabletext"><b>Device</b></td>
                          <td colspan=2><span class="tabletext">%s</td>
                          <td><span class="tabletext"><b>Board Impedance</b></td>
                          <td colspan=2><span class="tabletext">%s</td>
                      </tr>
                      <tr bgcolor="#FFFFFF"><td><span class="tabletext"><b>Pin/Pkg</b></td>
                          <td colspan=2><span class="tabletext">%s</td>
                          <td><span class="tabletext"><b>Board Thicknesss</b></td>
                          <td colspan=2><span class="tabletext">%s</td>
                      </tr>
                      <tr bgcolor="#FFFFFF"><td><span class="tabletext"><b>Socket</b></td>
                          <td colspan=2><span class="tabletext">%s</td>
                          <td><span class="tabletext"><b>Material</b></td>
                          <td colspan=2><span class="tabletext">%s</td>
                      </tr>
                      <tr bgcolor="#FFFFFF"><td><span class="tabletext"><b>Handler</b></td>
                          <td colspan=2><span class="tabletext">%s</td>
                          <td><span class="tabletext"><b>Sites</b></td>
                          <td colspan=2><span class="tabletext">%s</td>
                      </tr>
 
                      ',
		$myBoard[0],$myBoard[7],$myBoard[1],$myBoard[8],$myBoard[2],$myBoard[9],
                $myBoard[3],$myBoard[10],$myBoard[4],$myBoard[11],$myBoard[5],$myBoard[6]);



            printf('<tr  bgcolor="#DDDEDD"><td colspan=6><span class="heading"><center><b>Process Steps</b></center></td></tr>');
            $arr = split(",",$myBoard[16]);
            printf('<tr  bgcolor="#FFFFFF"><td colspan=6><span class="tabletext">1. %s</tr>',$arr[0]);
            printf('<tr bgcolor="#FFFFFF"><td colspan=6><span class="tabletext">2. %s</tr>',$arr[1]);
            printf('<tr bgcolor="#FFFFFF"><td colspan=6><span class="tabletext">3. %s</tr>',$arr[2]);
            printf('<tr bgcolor="#FFFFFF"><td colspan=6><span class="tabletext">4. %s</tr>',$arr[3]);

         
            printf('<tr  bgcolor="#DDDEDD"><td colspan=6><span class="heading"><center><b>Special Instructions</b></center></td></tr>');
            printf('<tr bgcolor="#FFFFFF"><td colspan=6><span class="tabletext">%s</tr>',$myBoard[23]);
            printf('<tr  bgcolor="#DDDEDD"><td colspan=6><span class="heading"><center><b>Engineering Notes</b></center></td></tr>');
            $result = $newwo->getNotes($worecnum);
            printf('<tr bgcolor="#FFFFFF"><td colspan=6><textarea name="notes" rows="6" cols="100">');
            while ($mynotes = mysql_fetch_row($result)) {
                  printf("\n");
                  printf("********Added by $mynotes[2] on $mynotes[0]*******");
                  printf("\n");
                  printf($mynotes[1]);
                  printf("   \n");
            }
        
?>
        </textarea></td>
        </tr> 

        <tr bgcolor="#DDDEDD">
            <td colspan=6><span class="heading"><center><b>Timeline & Owner</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">

            <td><span class="tabletext"><p align="left"><b>Sch Due Date</b></p></font></td>
            <td colspan=2><input type="text" name="sch_due_date" 
                    style="background-color:#DDDDDD;" 
                    readonly="readonly" size=18 value="<?php if ($myrow[17] != '0000-00-00') echo $myrow[17] ?>">
            </td>
            <td><span class="tabletext"><p align="left"><b>Actual Ship Date</b></p></font></td>
            <td colspan=2><input type="text" name="act_ship_date" 
                    style="background-color:#DDDDDD;" 
                    readonly="readonly" size=18 value="<?php if ($myrow[18] != '0000-00-00') echo $myrow[18] ?>">
            </td>

        </tr>
        <tr  bgcolor="#FFFFFF">
            <td bgcolor="#EEEFEE"><span class="heading"><b>Milestone</b></td>
	    <td bgcolor="#EEEFEE"><span class="heading"><b>Scheduled Date</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Revised Date</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Completed Date</b></td>
	    <td bgcolor="#EEEFEE"><span class="heading"><b><center>Owner</center></b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b><center>Approved by</center></b></td>
        </tr>

<?php
        while ($mytl = mysql_fetch_row($timeline)) {
?>
          <tr  bgcolor="#FFFFFF">
            <td><span class="heading"><b><i><?php echo $mytl[1] ?></i></b></td>
            <td><span class="heading"><?php if ($mytl[2] != '0000-00-00') echo $mytl[2] ?></td>
            <td><span class="heading"><?php if ($mytl[3] != '0000-00-00') echo $mytl[3] ?></td>
            <td><span class="heading"><?php if ($mytl[4] != '0000-00-00') echo $mytl[4] ?></td>
<?php 
            if ($mytl[10] != 'Cust') {
?>
                <td><span class="heading"><?php echo $mytl[12] ?></td>
<?php    
            }   
            else {
?>
                <td><span class="heading"><?php echo $mytl[14] ?></td>

<?php
            }
?>
<?php 
            if ($mytl[10] != 'Cust') {
?>
                <td><span class="heading"><?php echo $mytl[16] ?></td>
<?php      
            } 
            else {
?>
                <td><span class="heading"><?php echo $mytl[18] ?></td>

<?php
            }
?>

          </tr>
<?php 
          } 

?>                           

        <tr>

            
        </tr>
        </table>
</td>
				<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>

		</table>

      </FORM>


</table>


					
</body>
</html>