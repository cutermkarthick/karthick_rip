<?php
//==============================================
// Author: FSI                                 =
// Date-written =  Mar 20, 2007                =
// Filename: qualityplanSummary.php            =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Displays list of Quality Plan.              =
//==============================================
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'fitting_summary';
//////session_register('pagename');

//Following code added to implement search,sort  and Pagination on Dec 29-04 by Jerry George

$cond = "name like '%'";
$sort1='name';
$select='name';
$worec='';
$where1='';
$oper='like';
if ( isset ( $_REQUEST['competitor'] ))
{
     $company_match = $_REQUEST['competitor'];
   if ($company_match!='')
{

     if ( isset ( $_REQUEST['competitor_oper'] ) )
    {
   	  $oper = $_REQUEST['competitor_oper'];
    }
    else
    {
    	 $oper = 'like';
    }
    if ($oper == 'like')
    {
    	$competitor = "'" . $_REQUEST['competitor'] . "%" . "'";
    }
    else
    {
 	    $competitor = "'" . $_REQUEST['competitor'] . "'";
    }
    $where1 =$_REQUEST['competitorfl'];
    $select=$_REQUEST['competitorfl'];
    $cond = $where1 . " " . $oper . " " . $competitor;
}

else
$cond="name like '%'";
}
 else
{
 	$company_match = '';
 }

if ( isset ( $_REQUEST['sortfld1'] ) )
{
	 $sort1 = $_REQUEST['sortfld1'];
}

// how many rows to show per page
$rowsPerPage = 10;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
    $pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
    $totpages = $_REQUEST['totpages'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

// First include the class definition
include('classes/operatorClass.php');
include('classes/fittingClass.php');
include_once('classes/displayClass.php');
$newdisplay = new display;
$newoperator = new operator;
$newfitting = new fitting;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/fitting.js"></script>

<html>
<head>
<title>Fitting data Summary</title>
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
        					<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/logout_mo.gif',1)"><img name="Image15" border="0" src="images/logout.gif"></a></td>
    				</tr>
     			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
						<?php $newdisplay->dispLinks(''); ?>
						<table width=100% border=0 cellpadding=0 cellspacing=0  >
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/spacer.gif " width="6"></td>
								<td bgcolor="#FFFFFF">
									<table width=100% border=0 cellpadding=6 cellspacing=0  >
                <tr><td><span class="heading"><i>Please click on the Operator link to Edit</i></td></tr>
									<tr><td>
								<!--	<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
										<tr>
											<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
											<td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></td>
											<td bgcolor="#FFFFFF" rowspan=2 align="center">
												<input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()">
											</td>
										</tr>
										<tr>
											<td bgcolor="#FFFFFF"><span class="tabletext"><select name="scomp" size="1" width="50">
												<?php if($select=='id'){?>
             												<option selected>id
             												<option value>name<?php }else {?>
             												<option selected>name
             												<option value>id<?php }?>
             							 					</select>
        							 				</td>
        											<td bgcolor="#FFFFFF"><span class="tabletext"><select name="competitor_oper" size="1" width="50">
             												<?php if($oper=='like'){?>
            												<option selected>like
												<option value>=<?php }else {?>
             												<option selected>=
												<option value>like<?php }?>
        											</td>
											<td bgcolor="#FFFFFF"><input type="text" name="competitor" size=20 value="<?php echo $company_match ?>" onkeypress="javascript: return checkenter(event)"></td>
											<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
											<td bgcolor="#FFFFFF" colspan=3><span class="tabletext"><select name="sort1" size="1" width="100">
             												<option selected>name
            												</select>
												<input type="hidden" name="sortfld1">
												<input type="hidden" name="competitorfl">
												<input type="hidden" name="competitor_oper">
       							 				</td>
										</tr>
									</table>  -->
									</td></tr>
										<tr><td>
										       <table width=100% border=0>
          	                                   <tr>
												<td><span class="pageheading"><b>Fitting Data Summary</b></td>
											<!--	<td colspan=150>&nbsp;</td>
											         	<td align=right><a href ="new_operator_data.php"><img name="Image8" border="0" src="images/bu_newreview.gif"></a>
												</td> -->
              	                               </tr>
										      </table>
                                 <div style="overflow: scroll; width: 800px; height: 140px;">
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
<table width=99% border=0 cellpadding=0 cellspacing=0 align=center valign=middle>
<tr>
<td align=center>
<fieldset>
<legend>
  <span class="pageheading"><b> Fitting Data Entry Form </b></span>
</legend>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
  <!--  <tr>
        <td><span class="pageheading"><b>Operator Data Form</b></td>
    </tr>  -->

     <form action='processfitting_data.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Fitting Data Header</b></center></td>
        </tr>
 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

 <?php

     $result = $newoperator->getops();
     $result1 = $newoperator->getmcs();
 ?>
        <tr bgcolor="#FFFFFF">

            <td width=10%><span class="labeltext"><p align="left">Operator </p></font></td>
            <td width=10%><span class="labeltext"><p align="left">Date</p></font></td>
            <td width=10%><span class="labeltext"><p align="left">Shift</p></font></td>
            <td width=10%><span class="labeltext"><p align="left">Assigning<br>time/piece </p></font></td>
            <td width=10%><span class="labeltext"><p align="left">Qty Assigned</p></font></td>
            <td width=10%><span class="labeltext"><p align="left">Qty Produced</p></font></td>
            <td width=10%><span class="labeltext"><p align="left">Rejection </p></font></td>


        <tr bgcolor="#FFFFFF">

            <td width=10% rowspan=2><select name="operator">
                                <?php
                                   while($row = mysql_fetch_row($result))
                                   {
                                     echo "<option value='$row[0] $row[1]'> $row[0] $row[1]";
                                   }
                                ?>
                                   </select></td>
            <td><span class="tabletext"><input type="text" name="date" size=8 value=""><img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('date')"></td>
            <td><span class="tabletext"><input type="text" name="shift" size=3 value=""></td>
            <td><span class="tabletext"><input type="text" name="time_per_piece" size=8 value=""></td>
            <td><span class="tabletext"><input type="text" id="qty_assigned" name="qty_assigned" size=8 value=""></td>
            <td><span class="tabletext"><input type="text" id="qty_produced" name="qty_produced" size=8 value="" onblur="comp_values()"></td>
            <td><span class="tabletext"><input type="text" name="rejection" size=8 value="" onblur="comp_values1()"></td>

        </tr>


        </table>

	</td>
    </tr>

</table>
<span class="labeltext"><input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()">

      </FORM>

</table>

</fieldset>
</td></tr></table>

</td>
								<td width="6"><img src="images/spacer.gif " width="6"></td>
							</tr>
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/box-left-bottom.gif"></td>
								<td><img src="images/spacer.gif " height="6"></td>
								<td width="6"><img src="images/box-right-bottom.gif"></td>
							</tr>
						</table>
						<table border = 0 cellpadding=0 cellspacing=0 width=100% >
							<tr>
								<td align=left>

<?php

//Additions on Dec 29 04 by Jerry George to implement pagination
 $numrows=10;
//$numrows = $newcompetitor->getcompetitorCount($cond,$offset, $rowsPerPage);
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);
//echo "$maxPage</br>";
if (!isset($_REQUEST['page']))
{
//   echo "page is set";
    $totpages = $maxPage;
}

//echo "total pages :$totpages</br>";
$self = $_SERVER['PHP_SELF'];

// creating 'previous' and 'next' link
// plus 'first page' and 'last page' link

// print 'previous' link only if we're not
// on page one
if ($pageNum > 1)
{
    $page = $pageNum - 1;
    $prev = " <a href=\"qualityplanSummary.php?page=$page&totpages=$totpages&qualityplanSummary=$company_match&scompanyfl=$where1&competitor_oper=$oper\">[Prev]</a> ";

    $first = " <a href=\"qualityplanSummary.php?page=1&totpages=$totpages&qualityplanSummary=$company_match&competitorfl=$where1&competitor_oper=$oper\">[First Page]</a> ";
}
else
{
    $prev  = ' [Prev] ';       // we're on page one, don't enable 'previous' link
    $first = ' [First Page] '; // nor 'first page' link
}

// print 'next' link only if we're not
// on the last page
if ($pageNum < $totpages)
{
    $page = $pageNum + 1;
    $next = " <a href=\"qualityplanSummary.php?page=$page&totpages=$totpages&competitor=$company_match&competitorfl=$where1&competitor_oper=$oper\">[Next]</a> ";

    $last = " <a href=\"qualityplanSummary.php?page=$totpages&totpages=$totpages&competitor=$company_match&competitorfl=$where1&competitor_oper=$oper\">[Last Page]</a> ";
}
else
{
    $next = ' [Next] ';      // we're on the last page, don't enable 'next' link
    $last = ' [Last Page] '; // nor 'last page' link
}
if($totpages!=0)
{
//$pageNum=0;
// print the page navigation link
echo "<span class=\"labeltext\">" . $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$totpages</strong> pages " . $next . $last;
}
else
echo "<span class=\"labeltext\"><align=\"center\">No matching records found";
// End additions on Dec 29,04

?>
								</td>
							</tr>
						</table>
		</body>
</html>
