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

$_SESSION['pagename'] = 'new_operator_data';
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
include_once('classes/displayClass.php');
$newdisplay = new display;
$newoperator = new operator;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/operator.js"></script>

<html>
<head>
<title>operator data Summary</title>
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
       									<tr><td><span class="heading"><i>Please click on the Cust Ord No. link to Edit or Delete</i></td></tr>
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
												 <td width=38%><span class="pageheading"><b>Operator Data Summary</b></td>
                                     		     <td align=left> <a href ="new_operator_data.php"><img name="Image8" border="0" src="images/new.gif"></a>
												 </td>
              	                                </tr>
										      </table>
                                 <div style="overflow: scroll; width: 550px; height: 300px;">
											<table width=100% align=left border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        												<tr>
                                     							<td bgcolor="#EEEFEE"><span class="tabletext"><b>Operator</b></td>
                                                                <td bgcolor="#EEEFEE"><span class="tabletext"><b>M/C Name</b></td>
                                                                <td bgcolor="#EEEFEE"><span class="tabletext"><b>PRN#</b></td>
                                        				</tr>
													<?php
													$newlogin = new userlogin;
													$newlogin->dbconnect();
													$result = $newoperator->getoperators();
	     										  		 while ($myrow = mysql_fetch_assoc($result)) {
	     												 printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext"><a href="operatorDetails.php?oper_name=%s&mc_name=%s&crn=%s"><b>%s</b></td>
                                                                         <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                                                                         <td bgcolor="#FFFFFF"><span class="tabletext">%s</td></tr>  ',
		     									     		               $myrow["oper_name"],$myrow["mc_name"],$myrow["crn"],$myrow["oper_name"],
                                                                           $myrow["mc_name"],
                                                                           $myrow["crn"]);

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
<!--<table width=99% border=0 cellpadding=0 cellspacing=0 align=center valign=middle>
<tr>
<td align=center>
<fieldset>
<legend>
  <span class="pageheading"><b> Operator Data Form </b></span>
</legend>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
   <tr>
        <td><span class="pageheading"><b>Operator Data Form</b></td>
    </tr>

     <form action='processoperator_data.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Operator Data Header</b></center></td>
        </tr>
 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

 <?php

     $result = $newoperator->getops();
     $result1 = $newoperator->getmcs();
 ?>
        <tr bgcolor="#FFFFFF">
            <td width=8%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>M/C Name </p></font></td>
            <td width=10% ><span class="labeltext"><p align="left">Operator </p></font></td>
            <td width=10%><span class="labeltext"><p align="left">PRN#</p></font></td>
            <td width=10%><span class="labeltext"><p align="left">QTY </p></font></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td width=8% rowspan=2><select name="mc_name">
                                   <?php
                                   while($row1 = mysql_fetch_row($result1))
                                   {
                                     echo "<option value='$row1[0]'> $row1[0]";
                                   }
                                ?>
                                   </select></td>
            <td width=10% rowspan=2><select name="oper_name">
                                <?php
                                   while($row = mysql_fetch_row($result))
                                   {
                                     echo "<option value='$row[0] $row[1]'> $row[0] $row[1]";
                                   }
                                ?>
                                   </select></td>
            <td><span class="tabletext"><input type="text" name="crn" size=8 value=""></td>
            <td><span class="tabletext"><input type="text" name="qty" size=3 value=""></td>
        </tr>


        </table>
        <br>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">

            <td width=8% rowspan=2><span class="labeltext"><p align="left">Date</p></font></td>
            <td width=10% rowspan=2><span class="labeltext"><p align="left">Shift</p></font></td>
            <td width=10% colspan=16><span class="labeltext"><p align="center">Running Time Stage </p></font></td>
            <td width=10% rowspan=2 nowrap><span class="labeltext"><p align="left">Qty Rej</p></font></td>
            <td width=10% rowspan=2 nowrap><span class="labeltext"><p align="left">Qty with dev</p></font></td>
            <td width=10% rowspan=2 nowrap><span class="labeltext"><p align="left">Qty Accep</p></font></td>

        </tr>
        <tr bgcolor="#FFFFFF">
          <?php
             $i=1;
             while($i<=16)
             {
          ?>
            <td width=10%><span class="labeltext"><p align="left"><?php echo $i ?></p></font></td>
          <?php
             $i++;
            }
          ?>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="tabletext"><input type="text" name="st_date" size=8 value="">
                <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('st_date')"></td>
            <td><span class="tabletext"><input type="text" name="shift" size=5 value=""></td>

         <?php
           $x=1;
           while($x<=16)
           {
            $running_time = 'running_time' . $x;
         ?>

            <td><span class="tabletext"><input type="text" name="<?php echo $running_time ?>" size=2 value=""></td>
         <?php
            $x++;
           }
         ?>
           <td><span class="tabletext"><input type="text" name="qty_rej" size=3 value=""></td>
           <td><span class="tabletext"><input type="text" name="qty_with_dev" size=3 value=""></td>
           <td><span class="tabletext"><input type="text" name="qty_accepted" size=3 value=""></td>

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
</td></tr></table>  -->

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
/*
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
// End additions on Dec 29,04  */

?>
								</td>
							</tr>
						</table>
		</body>
</html>
