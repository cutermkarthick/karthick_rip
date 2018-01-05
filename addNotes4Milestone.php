<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Feb 1, 2007                  =
// Filename: addNotes4Milestone.php            =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Allows the addition of Notes for Milestone. =
// Coded by : Suresh Devadiga                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$userrecnum = $_SESSION['userrecnum'];
$_SESSION['pagename'] = 'addnotes4milestone';
//////session_register('pagename');
$userrole = $_SESSION['userrole'];
// First include the class definition

include_once('classes/loginClass.php');
include('classes/pageClass.php');
include('classes/pagefieldsClass.php');
include('classes/workorderClass.php');
include('classes/displayClass.php');
include('classes/datesClass.php');
include('classes/approvalClass.php');
include('classes/genericWOClass.php');
include('classes/workflowClass.php');

if ( isset ( $_REQUEST['typenum']) )
{
	 $typenum = $_REQUEST['typenum'];
	$_SESSION['typenum'] = $typenum;
	//////session_register('typenum');
 }
if (isset ( $_REQUEST['worecnum'] ) )
{
	$worecnum = $_REQUEST['worecnum'];
	$_SESSION['worecnum'] = $worecnum;
	//////session_register('worecnum');
}
if (isset ($_REQUEST['wotype'] ) )
{
	$wotype=$_REQUEST['wotype'];
	$_SESSION['wotype'] = $wotype;
	//////session_register('wotype');
}
if (isset ($_REQUEST['wonum'] ) )
{
	$wonum=$_REQUEST['wonum'];
	$_SESSION['wonum'] = $wonum;
	//////session_register('wonum');
}

if ( isset ( $_SESSION['typenum']) )
{
	 $typenum = $_SESSION['typenum'];
 }
if (isset ( $_SESSION['worecnum'] ) )
{
	$worecnum = $_SESSION['worecnum'];
}
if (isset ($_SESSION['wotype'] ) )
{
	$wotype=$_SESSION['wotype'];
}
if (isset ($_SESSION['wonum'] ) )
{
	$wonum=$_SESSION['wonum'];
}

$dept=$_REQUEST['dept'];
$wonum=$_REQUEST['wonum'];

$newlogin = new userlogin;
$newlogin->dbconnect();
$newpage = new page;
$newwo = new workOrder;
$newapproval = new approval;
$newdisplay = new display;
$newgen = new genericWO;

//echo "worecnum:$worecnum<br>";
$result = $newgen->getGenInfo($worecnum);
$myrow = mysql_fetch_row($result);
$result = $newgen->getAddrInfo($worecnum);
$myaddr = mysql_fetch_row($result);
$result = $newpage->getwoDetails($wotype,$myrow[6]);
//$myWo = mysql_fetch_row($result);
$result = $newgen->getParts($typenum);
$myParts = mysql_fetch_row($result);
$newDates = new dates;

$timeline = $newDates->getdates('WO', $worecnum,$wotype);

$result1 = $newwo->attachments($worecnum);
$myrow1 = mysql_fetch_assoc($result1);

?>
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/woentry.js"></script>
<script language="javascript" src="scripts/wo.js"></script>
<link rel="stylesheet" href="style.css">


<html>
<head>
<title>Add Notes</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<FORM ACTION = "processNotes4milestone.php" METHOD = "POST">
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
				<tr>
					<td>


   <?php
         $newdisplay->dispLinks('');
         $newwo->UpdNotes($worecnum,$typenum,$wotype,$wonum);
        //echo "i am here $myrow[22]<br>";
        if($myrow[22] != 'Hold')
        {
         $newapproval->dispApprSignOff('WO', $worecnum, $wotype, $typenum);
        }
    ?>

</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="2">
   <tr>
        <td align="left"><span class="pageheading"><b><?php echo $wotype?> Work Order Details</b></td>
        <td align="right">
             <img src="images/bu-print.gif" alt="Print BoardWO" onclick="javascript: printwoDetails()">
        </td>
    </tr>
  <td align="left"><span class="pageheading"><b>Downloads :  <a href="wodetailsxml.php">XML</a> </b></td>
    </tr>
    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<?php
if ($userrole == 'SU') {
 $ctrls=$newpage->createctrls4SU($worecnum) ;
 echo "$ctrls";
}else if ($userrole == 'DESG_B')
{
 $ctrls=$newpage->createctrls4RU($worecnum) ;
 echo "$ctrls";
}else if ($userrole == 'CUST') {
 $ctrls=$newpage->createctrls4CUST($worecnum) ;
 echo "$ctrls";
}

else if ($userrole == 'SALES') {
 $ctrls=$newpage->createctrls4CUST($worecnum) ;
 echo "$ctrls";
}
else if ($userrole == 'SALES PERSON') {
 $ctrls=$newpage->createctrls4CUST($worecnum) ;
 echo "$ctrls";
}
else if ($userrole == 'SALES MANAJER') {
 $ctrls=$newpage->createctrls4CUST($worecnum) ;
 echo "$ctrls";
}
?>
    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<?php
$ctrls=$newpage->createctrls4display("WorkOrder",$myrow[1],$myrow[6]) ;
 echo  $ctrls;
 ?>


 </table>
 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=4>
<?php
 printf('<tr bgcolor="#DDDEDD"><td colspan=7><span class="heading"><center><b>Attachments</b></center></td></tr>
                      <tr bgcolor="#FFFFFF"><td><span class="tabletext"><b>File1</b></td>
                          <td colspan=2><span class="tabletext"><a href=attachments/%s>%s</td>
                          <td><span class="tabletext"><b>File2</b></td>
                          <td colspan=3><span class="tabletext"><a href=attachments/%s>%s</td>
                      </tr>
                      <tr bgcolor="#FFFFFF"><td width=200><span class="tabletext"><b>File3</b></td>
                          <td colspan=2><span class="tabletext"><a href=attachments/%s>%s</td>
                          <td><span class="tabletext"><b>File4</b></td>
                          <td colspan=3><span class="tabletext"><a href=attachments/%s>%s</td>
                     </tr>',
		              $myrow1["filename1"],$myrow1["filename1"],$myrow1["filename2"],$myrow1["filename2"],$myrow1["filename3"],$myrow1["filename3"],$myrow1["filename4"],$myrow1["filename4"]);

 ?>


</table>
    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=4>
<?php

            printf('<tr  bgcolor="#DDDEDD"><td colspan=9><span class="heading"><center><b>Engineering Notes</b></center></td></tr>');
            $result = $newwo->getNotes($worecnum);
            printf('<tr bgcolor="#FFFFFF"><td colspan=9><textarea name="notes" rows="6" cols="89">');
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
            <td colspan=9><span class="heading"><center><b>Timeline & Owner</b></center></td>
        </tr>
	<tr><td colspan=9>
        <table width=100% border=1 cellpadding=0 cellspacing=0  >

        <tr bgcolor="#FFFFFF">

            <td><span class="tabletext"><p align="left"><b>Sch Due Date</b></p></font></td>
            <td><input type="text" name="sch_due_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php if ($myrow[17] != '0000-00-00') echo $myrow[17] ?>">
            </td>
            <td><span class="tabletext"><p align="left"><b>Revised Ship Date</b></p></font></td>
            <td><input type="text" name="rev_ship_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php if ($myrow[20] != '0000-00-00') echo $myrow[20] ?>">
            </td>
            <td><span class="tabletext"><p align="left"><b>Actual Ship Date</b></p></font></td>
<?php
if ($myrow[18] != '0000-00-00' && $myrow[18] != '')
	$link=$myrow[18];
else
	$link='<span class="tabletext"><p align="left"><b>View Shipment</b></p></font>  '

?>
            <td><a href ="javascript:displayShipment()"><?php echo $link?></a>
            </td>

        </tr>
       </table>
	</tr></td>
        <tr  bgcolor="#FFFFFF">
            <td bgcolor="#EEEFEE"><span class="heading"><b>Department</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Milestone</b></td>
	        <td bgcolor="#EEEFEE"><span class="heading"><b>Scheduled Date</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Revised Date</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Hold</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Completed Date</b></td>
	        <td bgcolor="#EEEFEE"><span class="heading"><b><center>Owner</center></b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b><center>Approved by</center></b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b><center>Notes</center></b></td>
        </tr>
<?php
        while ($mytl = mysql_fetch_row($timeline)) {
?>
          <tr  bgcolor="#FFFFFF">
            <td><span class="heading"><b><i><?php echo $mytl[28] ?></i></b></td>
            <td><span class="heading"><b><i><?php echo $mytl[1] ?></i></b></td>
            <td><span class="heading"><?php if ($mytl[2] != '0000-00-00') echo $mytl[2] ?></td>
            <td><span class="heading"><?php if ($mytl[3] != '0000-00-00') echo $mytl[3] ?></td>
            <td ><span class="heading"><?php echo $mytl[24] ?></td>
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
                <td ><span class="tabletext"><a href ="addNotes4Milestone.php?wonum=<?php echo $wonum ?>&worecnum=<?php echo $worecnum?>&dept=<?php echo $mytl[28]?>" TITLE="Add Notes">Add Notes</td>

<?php
            }
            else {
                    if ($mytl[18] != '')
                    {
?>
                    <td><span class="heading"><?php echo $mytl[18] ?></td>

<?php
                    }
                    else
                    {
?>
                        <td><span class="heading"><?php echo $mytl[16] ?></td>
<?php
                    }
            }
?>
          </tr>
<?php
          }
?>


        </table>
</td>

    <td><img src="images/spacer.gif " height="6"></td>


      <table width=100% border=0 cellpadding=0 cellspacing=0  >
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/spacer.gif " width="6"></td>
								<td bgcolor="#FFFFFF">
									<table width=100% border=0 cellpadding=6 cellspacing=0  >
										<tr><td>

										 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

                                        <?php
                                                   printf('<tr  bgcolor="#DDDEDD"><td colspan=8><span class="heading"><b>Notes for %s Milestone</b></center></td></tr>',$dept);
                                                   $result = $newwo->getNotes4milestone($worecnum,$dept);
                                                   printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes" rows="6" cols="88"  readonly="readonly">');
                                                   while ($mynotes = mysql_fetch_row($result)) {
                                                         printf("\n");
                                                         printf("********Added by $mynotes[2] on $mynotes[0] *********** ");
                                                         printf("\n");
                                                         printf($mynotes[1]);
                                                         printf("   \n");
                                                         }
                                         ?>
                                                         </textarea></td>
                                                         </tr>

            								</table>

                                    	</td></tr>

										<tr>
											<td>
  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
												       <tr bgcolor="#EEEFEE"><span class="heading"><td colspan=4><b>Add Notes</b></center></td></tr>
                                                       <tr bgcolor="#FFFFFF"  >
                                                           <td colspan=4><textarea name="spec_instrns" rows="3" cols="88%" value=""></textarea>
             	                                           <input type="hidden" name="worecnum" value="<?php echo $worecnum ?>" >
             	                                           <input type="hidden" name="dept" value="<?php echo $dept ?>" >
             	                                           <input type="hidden" name="wonum" value="<?php echo $wonum ?>" >
													    </td> </tr>
            									</table>
 											</td>
										 </tr>

         </table>

							<td width="6"><img src="images/spacer.gif " width="6"></td>
      	            </tr>
                           <tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/box-left-bottom.gif"></td>
								<td><img src="images/spacer.gif " height="6"></td>
								<td width="6"><img src="images/box-right-bottom.gif"></td>
							</tr>
      </table>
  </table>

                     <span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields4notes()">


</FORM>
</body>
</html>