<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = March 15,2005                =
// Filename: boardReport.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Board report                                =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
//////session_register('pagename');

// First include the class definition
include('classes/operatorClass.php');
include('classes/fittingClass.php');
include_once('classes/displayClass.php');
$newdisplay = new display;
$newoperator = new operator;
$newfitting = new fitting;

$newlogin = new userlogin;
$newlogin->dbconnect();



?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/review.js"></script>



<html>
<head>
<title>Operator data</title>
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
        					<td align="right">&nbsp;
       					<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        				 </tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >


     <form action='processoperator_data.php' method='post' enctype='multipart/form-data'>
<tr>
<td colspan=2>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

  <table width=100% border=0>
                                              <tr>
												<td><span class="pageheading"><b>Fitting Data Summary</b></td>
											<!--	<td colspan=150>&nbsp;</td>
											         	<td align=right><a href ="new_operator_data.php"><img name="Image8" border="0" src="images/bu_newreview.gif"></a>
												</td> -->
              	                               </tr>
										      </table>
                                 <div style="overflow: scroll; width: 800px; height: 330px;">
											<table width=100% align=left border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        												<tr>

                        <!--  <td bgcolor="#EEEFEE"><span class="tabletext"><b>Operator</b></td>
                                                                <td bgcolor="#EEEFEE"><span class="tabletext"><b>M/C Name</b></td>
                                                                <td bgcolor="#EEEFEE"><span class="tabletext"><b>PRN#</b></td>-->
                             <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>Operator </p></font></td>
                             <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>Date</p></font></td>
                             <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>Shift</p></font></td>
                             <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>Assigning<br>time/piece </p></font></td>
                             <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>Qty Assigned</p></font></td>
                             <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>Qty Produced</p></font></td>
                             <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>Rejection </p></font></td>
                             <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>Time Wasted</p></font></td>
                             <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><p align="left"><b>Efficiency</p></font></td>

        												</tr>
													<?php
													$newlogin = new userlogin;
													$newlogin->dbconnect();
													$result = $newfitting->getfittings();
	     										  		 while ($myrow = mysql_fetch_assoc($result)) {
	     										  		 $eff=(($myrow["qty_produced"]-$myrow["rejection"])/$myrow["qty_assigned"])*100;

                                                         $t1 = $myrow["qty_assigned"];
                                                         $t2 = $myrow["qty_produced"];
                                                         $t3 = $myrow["rejection"];
                                                         $time_wasted = ($t1-($t2-$t3)) * $myrow["time_per_piece"];
	     												 printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext"><a href="edit_fitting.php?fittingrecnum=%s"><b>%s</b></td>
                                                                         <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                                                                         <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                                                                         <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                                                                         <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                                                                         <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                                                                         <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                                                                         <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                                                                         <td bgcolor="#FFFFFF"><span class="tabletext">%.2f</td></tr>  ',
		     									     		               $myrow["recnum"],$myrow["operator"],
                                                                           $myrow["date"],
                                                                           $myrow["shift"],
                                                                           $myrow["time_per_piece"],
                                                                           $myrow["qty_assigned"],
                                                                           $myrow["qty_produced"],
                                                                           $myrow["rejection"],
                                                                           $time_wasted,
                                                                           $eff
                                                                           );

                                                                      	printf('</td></tr>');
        													}
  											 		/* Free resultset */
  													 mysql_free_result($result);
													  /* Closing connection */
  													$newlogin->dbdisconnect();
            	                              ?>
											               </table>
 											</td>
										</tr>
									</table>
        </div>

</td>
		<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>

		</table>
<!--<span class="labeltext"><input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()"> -->

      </FORM>
</table>
</body>
</html>
