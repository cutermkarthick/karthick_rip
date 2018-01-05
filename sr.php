<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: June 10, 2005 by Jerry George =
// Filename: sr.php                            =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Board details                               =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}


// Includes
include_once('classes/loginClass.php');
include('classes/srClass.php');
include('classes/supportClass.php');
include('classes/displayClass.php');

/*$typenum = $_REQUEST['typenum'];
if ( !isset ( $typenum ) )
{
     header ( "Location: login.php" );

}*/
$srrecnum = $_REQUEST['recnum'];
if ( !isset ( $srrecnum ) )
{
     header ( "Location: login.php" );

}
$_SESSION['pagename'] = 'sr';
//////session_register('pagename');
$_SESSION['srrecnum'] = $srrecnum;
//////session_register('typenum');
$userid = $_SESSION['user'];

$newlogin = new userlogin;
$newlogin->dbconnect();
$newdisp = new display;
$newsr = new sr;
$newsupp=new support;

/*$result = $newboard->getGenInfo($worecnum);
$myrow = mysql_fetch_row($result);
$result = $newboard->getAddrInfo($worecnum);
$myaddr = mysql_fetch_row($result);
$result = $newboard->getBoardDetails($typenum);
$myBoard = mysql_fetch_row($result);
$result = $newboard->getParts($typenum);
$myParts = mysql_fetch_row($result);*/
?>
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/sr.js"></script>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>SR</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr>
        			<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        			<td align="right"><a href="chPassword.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/chpwd_mo.gif',1)"><img name="Image15" border="0" src="images/chpwd.gif"></a>
       					<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        		</tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr><td>
        <?php $newdisp->dispLinks($srrecnum); ?>
        <?php //$newsr->UpdNotes($srrecnum); ?>
        <?php //$newboard->dispSignOff($typenum,$myBoard[18],$myBoard[22],$myBoard[19],$myBoard[20],$myBoard[24]);
	$result=$newsr->getsrs4prntUpd($srrecnum);
	$myrow = mysql_fetch_row($result);
	$result1=$newsupp->getcontacts4support($srrecnum,'SR');
	$myrow1=mysql_fetch_row($result1);
	$result4=$newsupp->getwonum4support($srrecnum,'SR');
	$myrow4=mysql_fetch_row($result4);
	$result5=$newsupp->getsolnum4support($srrecnum,'SR');
	$myrow5=mysql_fetch_row($result5);

?>
						<table width=100% border=0 cellpadding=0 cellspacing=0  >
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/spacer.gif " width="6"></td>
								<td bgcolor="#FFFFFF">
									<table width=100% border=0 cellpadding=6 cellspacing=0  >
										<tr><td>
											 <table width=100% border=0>
												<tr>
													<td align="left"><span class="pageheading"><b>Service Request Details</b></td>
													<td align=right><input type= "image" name="Delete" src="images/bu-print.gif" value="Print" onclick="javascript: printSR(<?php echo $srrecnum ?>)"></td>
    												</tr>
										     </table>
										</td></tr>
										<tr>
											<td>
  	<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
	<tr bgcolor="#FFFFFF"  >
    <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">SR Num</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[1]";?></p></font></td>
	        <td><span class="labeltext"><p align="left">SR Title</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[2]";?></p></font></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Drawing Rev</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[3]";?></p></font></td>
            <td><span class="labeltext"><p align="left">Reported By</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[4]";?></p></font></td>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Due Date</p></font></td>
            <?php
            $d=substr($myrow[5],8,2);
            $m=substr($myrow[5],5,2);
            $y=substr($myrow[5],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
           // echo "$date";
            ?>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[5]";?></p></font></td>
            <td><span class="labeltext"><p align="left">Received Date</p></font></td>
            <?php
            $d=substr($myrow[6],8,2);
            $m=substr($myrow[6],5,2);
            $y=substr($myrow[6],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
           // echo "$date";
            ?>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[6]";?></p></font></td>
        </tr>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Priority</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[7]";?></p></font></td>
            <td><span class="labeltext"><p align="left">Status</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[8]";?></p></font></td>
        </tr>
         <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left">Doc Date</p></font></td>
          <?php
            $d=substr($myrow[9],8,2);
            $m=substr($myrow[9],5,2);
            $y=substr($myrow[9],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
           // echo "$date";
            ?>
         <td><span class="tabletext"><p align="left"><?php echo "$myrow[9]";?></p></font></td>
         <td><span class="labeltext"><p align="left">Solution No</p></font></td>
         <td><span class="tabletext"><p align="left"><?php echo "$myrow5[1]";?></p></font></td>

         </tr>
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Work Order Information</b></center></td>
<?php
$result3=$newsr->getwonum4sr($myrow4[0]);
$myrow3=mysql_fetch_row($result3);
?>
<tr bgcolor="#FFFFFF"  >
 <td><span class="labeltext"><p align="left">Work Order No&nbsp;</p></font></td>
 <td><span class="tabletext"><?php echo "$myrow3[0]";?>
 <td><span class="labeltext"><p align="left">Company</p></font></td>
 <td><span class="tabletext"><?php echo "$myrow3[1]";?>
 </td>
 </tr>

<tr bgcolor="#FFFFFF"  >
<td ><span class="labeltext"><p align="left">Contact&nbsp;</p></td>
<td><span class="tabletext"><?php echo "$myrow3[2]" . "$myrow3[3]";?></td>
<td><span class="labeltext"><p align="left">Email</p></font></td>
<td><span class="tabletext"><?php echo "$myrow3[4]";?></td>
</tr>

<tr bgcolor="#FFFFFF"  >
<td><span class="labeltext"><p align="left">Designer</p></font></td>
<td><span class="tabletext"><?php echo "$myrow3[5]" . "$myrow3[6]";?></td><td colspan=2>&nbsp;</td>
</tr>
    <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Customer Information</b></center></td></tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Customer</p></font></td>
           <td><span class="tabletext"><p align="left"><?php echo  "$myrow1[0]";?></p></font></td>
           <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow1[1]";?></p></font></td>
        </tr>
          <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">Contact</p></font></td>
             <td><span class="tabletext"><p align="left"><?php echo  $myrow1[2] . "  " . $myrow1[3];?></p></font></td>
             <td><span class="labeltext"><p align="left">Email</p></font></td>
             <td><span class="tabletext"><p align="left"><?php echo  "$myrow1[5]";?></p></font></td>
        </tr>
       <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Owner Information</b></center></td></tr>

    <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left">Owner</p></font></td>
          <td><span class="tabletext"><p align="left"><?php echo  $myrow1[6] . $myrow1[7];?></p></font></td>
<td colspan=3>&nbsp;</td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Phone</p></font></td>
             <td><span class="tabletext"><p align="left"><?php echo  "$myrow1[8]";?></p></font></td>
             <td><span class="labeltext"><p align="left">Email</p></font></td>
              <td><span class="tabletext"><p align="left"><?php echo  "$myrow1[9]";?></p></font></td>
      </tr>
       <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Error Description</b></center></td></tr>
         <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="tabletext"><p align="left"><?php echo  "$myrow[10]";?></p></font>
</td>
        </tr>


<?php


            printf('<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Error Notes</b></center></td></tr>');
//echo "recnum   :$srrecnum";
            $result = $newsupp->getNotes($srrecnum,'sr');
            printf('<tr><td colspan=4 bgcolor="#FFFFFF"><textarea name="notes" rows="6" cols="88">');
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


											               </table>
 											</td>
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
						<table border = 0 cellpadding=0 cellspacing=0 width=100%>
							<tr>
								<td align=left>
  											</td>
							</tr>
						</table>

					</FORM>
		</body>
</html>