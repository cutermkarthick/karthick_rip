<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: rusocket.php                      =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Socket RU display                           =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'rusocket'; 
//////session_register('pagename');

// First include the class definition 
include_once('classes/loginClass.php');
include('classes/socketClass.php');
include('classes/workorderClass.php');

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
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>

<html>
<head>
<title>Socket</title>
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
        <td align="right">
        <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        
    </tr>
</table>


<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr><td>
	
	</td></tr>
	<tr>
	<td>
<?php $newsocket->dispLinks(); ?>
        <?php $newwo->UpdNotes($worecnum,$typenum,'Socket'); ?>
        <?php $newsocket->dispSignOff($typenum,$mySocket[8],$mySocket[9],$mySocket[11]); ?>
</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

		

			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF">

<table width=100% border=0 cellspacing="1" cellpadding="6">
    <tr>
        <td align="left"><span class="pageheading"><b>Socket Work Order Details</b></td>
    </tr>
    </tr>
    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>    
<?php

            printf('<tr bgcolor="#DDDEDD"><td colspan=6><span class="heading"><center><b>General Information</b></center></td></tr>
                      <tr bgcolor="#FFFFFF"><td colspan=2><span class="tabletext"><b>Customer</b></td>
                          <td><span class="tabletext">%s</td>
                          <td colspan=2><span class="tabletext"><b>Work Order</b></td>
                          <td><span class="tabletext">%s</td>
                      </tr>
                      <tr bgcolor="#FFFFFF"><td colspan=2><span class="tabletext"><b>Description</b></td>
                          <td colspan=4><span class="tabletext">%s</td>
                      </tr>
                      <tr bgcolor="#FFFFFF"> 
                          <td colspan=2><span class="tabletext"><b>Quote #</b></td>
                          <td><span class="tabletext">%s</td>
                          <td colspan=2><span class="tabletext"><b>PO#</b></td>
                          <td><span class="tabletext">%s</td>
                      </tr>

                      ',
		      $myrow[2],$myrow[0],$myrow[7],$myrow[4],$myrow[3]);

                    printf('<tr bgcolor="#DDDEDD">
                        <td colspan=3><span class="heading"><center><b>Billing Address</b></center></td>
                        <td colspan=3><span class="heading"><b><center>Shipping Address</center></b></td>
                     </tr>
                      <tr bgcolor="#FFFFFF">
                          <td colspan=3><span class="tabletext">%s %s</td>
                          <td colspan=3><span class="tabletext">%s %s</td>
                      </tr>
                      <tr bgcolor="#FFFFFF">
                          <td colspan=3><span class="tabletext">%s %s</td>
                          <td colspan=3><span class="tabletext">%s %s</td>
                     
                      </tr>
                      <tr bgcolor="#FFFFFF">
                          <td colspan=3><span class="tabletext">%s %s</td>
                          <td colspan=3><span class="tabletext">%s %s</td>
                      </tr>

                      ',
		      $myaddr[6],$myaddr[7],$myaddr[12],$myaddr[13],$myaddr[8],$myaddr[9],
                      $myaddr[14],$myaddr[15],$myaddr[10],$myaddr[11],$myaddr[16],$myaddr[17]);
?>

                   
                     <tr bgcolor="#DDDEDD"><td colspan=6><span class="heading"><center><b>Timeline & Owner</b></center></td>
                     </tr>
                      <tr bgcolor="#FFFFFF">
                          <td colspan=2><span class="tabletext"><b>Footprint Due</b></td>
                          <td><span class="tabletext"><?php if ($mySocket[7] != '0000-00-00') echo $mySocket[7] ?></td>
                          <td colspan=2><span class="tabletext"><b>Footprint Complete</b></td>
                          <td><span class="tabletext"><?php if ($mySocket[8] != '0000-00-00') echo $mySocket[8] ?></td>
                      </tr>
                      <tr bgcolor="#FFFFFF">
                          <td colspan=2><span class="tabletext"><b>Mfg. Due</b></td>
                          <td><span class="tabletext"><?php if ($mySocket[10] != '0000-00-00') echo $mySocket[10] ?></td>
                          <td colspan=2><span class="tabletext"><b>Mfg. Complete</b></td>
                          <td><span class="tabletext"><?php if ($mySocket[11] != '0000-00-00') echo $mySocket[11] ?></td>
                      </tr>
                      <tr>
                          <td colspan=2><span class="tabletext"><b>Designer</b></td>
                          <td><span class="tabletext"><?php echo $myrow[12]," ", $myrow[13] ?></td>
                          <td colspan=2><span class="tabletext"><b>Customer Signoff</b></td>
                          <td><span class="tabletext"><?php if ($mySocket[9] != '0000-00-00') echo $mySocket[9] ?></td>
                      </tr>

                      <tr bgcolor="#FFFFFF">
                          <td colspan=2><span class="tabletext"><b>Sch Due Date</b></td>
                          <td><span class="tabletext"><?php if ($mySocket[17] != '0000-00-00') echo $mySocket[17] ?></td>
                          <td colspan=2><span class="tabletext"><b>Actual Ship Date</b></td>
                          <td><span class="tabletext"><?php if ($mySocket[18] != '0000-00-00') echo $mySocket[18] ?></td>
                      </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=6><span class="heading"><center><b>Approvals</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext"><p align="left">FP Signoff by</p></font></td>
            <td><span class="tabletext"><?php echo $mySocket[13] ?></td>

            <td colspan=2><span class="labeltext"><p align="left">Customer Signoff by</p></td>
            <td><span class="tabletext"><?php echo $mySocket[14] ?></td>

        </tr>


        <tr bgcolor="#FFFFFF">

            <td colspan=2><span class="labeltext"><p align="left">Mfg Signoff by</p></td>
            <td><span class="tabletext"><?php echo $mySocket[12] ?></td>
            <td colspan=2>&nbsp</td><td>&nbsp</td>
        </tr>

<?php

            printf('<tr bgcolor="#DDDEDD"><td colspan=6><span class="heading"><center><b>Contact Details</b></center></td></tr>
                      <tr bgcolor="#FFFFFF"><td colspan=2><span class="tabletext"><b>Contact</b></td>
                          <td><span class="tabletext">%s %s<br>%s</td>
                          <td colspan=2><span class="tabletext"><b>Phone</b></td>
                          <td><span class="tabletext">%s</td>
                      </tr>',
                    $myrow[8],$myrow[9],$myrow[11],$myrow[10]);
            printf('<tr bgcolor="#DDDEDD"><td colspan=6><span class="heading"><center><b>Socket Information</b></center></td></tr>
                      <tr bgcolor="#FFFFFF"><td width=70><span class="tabletext"><b>Device</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Socket PN</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Qty</b></td>
                          <td width=130><span class="tabletext">%s</td>
                      </tr>
                      <tr bgcolor="#FFFFFF"><td width=130><span class="tabletext"><b>Contacts</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Lid PN</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Qty</b></td>
                          <td width=130><span class="tabletext">%s</td>
                      </tr>

                      <tr bgcolor="#FFFFFF"><td width=130><span class="tabletext"><b>Body Size</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Other PN 1</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Qty</b></td>
                          <td width=130><span class="tabletext">%s</td>
                      </tr>
                      <tr bgcolor="#FFFFFF"><td width=130><span class="tabletext"><b>Pitch</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Other PN 2</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Qty</b></td>
                          <td width=130><span class="tabletext">%s</td>
                      </tr>
                      <tr bgcolor="#FFFFFF"><td width=130><span class="tabletext"><b>Contact Type</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Other PN 3</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Qty</b></td>
                          <td width=130><span class="tabletext">%s</td>
                      </tr>
                      <tr bgcolor="#FFFFFF"><td width=130><span class="tabletext"><b>Match FP</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Contact PN</b></td>
                          <td width=130><span class="tabletext">%s</td>
                          <td width=130><span class="tabletext"><b>Qty</b></td>
                          <td width=130><span class="tabletext">%s</td>
                      </tr>
 
                      ',
		$mySocket[0],$partarr[0],$partarr[1],$mySocket[1],$partarr[2],$partarr[3],
                $mySocket[2],$partarr[4],$partarr[5],$mySocket[3],$partarr[6],$partarr[7],
                $mySocket[4],$partarr[8],$partarr[9],$mySocket[5],$partarr[10],$partarr[11]);



            printf('<tr bgcolor="#DDDEDD"><td colspan=6><span class="heading"><center><b>Process Steps</b></center></td></tr>');
            $arr = split(",",$mySocket[15]);
            printf('<tr bgcolor="#FFFFFF"><td colspan=6><span class="tabletext">1. %s</tr>',$arr[0]);
            printf('<tr bgcolor="#FFFFFF"><td colspan=6><span class="tabletext">2. %s</tr>',$arr[1]);
            printf('<tr bgcolor="#FFFFFF"><td colspan=6><span class="tabletext">3. %s</tr>',$arr[2]);
            printf('<tr bgcolor="#FFFFFF"><td colspan=6><span class="tabletext">4. %s</tr>',$arr[3]);

         
            printf('<tr bgcolor="#DDDEDD"><td colspan=6><span class="heading"><center><b>Special Instructions</b></center></td></tr>');
            printf('<tr bgcolor="#FFFFFF"><td colspan=6><span class="tabletext">%s</tr>',$mySocket[17]);
            printf('<tr bgcolor="#DDDEDD"><td colspan=6><span class="heading"><center><b>Engineering Notes</b></center></td></tr>');
            $result = $newwo->getNotes($worecnum);
            printf('<tr bgcolor="#FFFFFF"><td colspan=6><textarea name="notes" rows="6" cols="89">');
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
      

        <tr>

            
        </tr>
        </table>
</td>				<td width="6"><img src="images/spacer.gif " width="6"></td>
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
