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

$_SESSION['pagename'] = 'edit_fitting';
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
$fittingrecnum=$_REQUEST['fittingrecnum'];
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


										<tr><td>
										       <table width=100% border=0>
          	                                   <tr>
												<td><span class="pageheading"><b>Edit Fitting Data</b></td>
											<!--	<td colspan=150>&nbsp;</td>
											         	<td align=right><a href ="new_operator_data.php"><img name="Image8" border="0" src="images/bu_newreview.gif"></a>
												</td> -->
              	                               </tr>
										      </table>

<table width=99% border=0 cellpadding=0 cellspacing=0>
<tr>
<td align=center>

<table width=100% border=0 cellpadding=0 cellspacing=0  >

	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
  <!--  <tr>
        <td><span class="pageheading"><b>Operator Data Form</b></td>
    </tr>  -->

     <form action='processfitting_data.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=84% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Fitting Data Header</b></center></td>
        </tr>
 <table width=84% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

 <?php
     $result=$newoperator->getops();
     $result1 = $newfitting->getfitting_data($fittingrecnum);
     $myrow=mysql_fetch_assoc($result1);
 ?>
        <tr bgcolor="#FFFFFF">

            <td width=10% ><span class="labeltext"><p align="left">Operator </p></font></td>
            <td width=10%><span class="labeltext"><p align="left">Date</p></font></td>
            <td width=10%><span class="labeltext"><p align="left">Shift</p></font></td>
            <td width=10% ><span class="labeltext"><p align="left">Assigning<br>time/piece </p></font></td>
            <td width=10%><span class="labeltext"><p align="left">Qty Assigned</p></font></td>
            <td width=10%><span class="labeltext"><p align="left">Qty Produced</p></font></td>
            <td width=10% ><span class="labeltext"><p align="left">Rejection </p></font></td>


        <tr bgcolor="#FFFFFF">

            <td width=10% rowspan=2><select name="operator">
                                <?php
                                   while($row = mysql_fetch_row($result))
                                   {
                                     echo "<option value='$row[0] $row[1]'> $row[0] $row[1]";
                                   }
                                ?>
                                   </select></td>
            <td><span class="tabletext"><input type="text" name="date" size=8 value="<?php echo $myrow['date'] ?>">
            <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('date')"></td>
            <td><span class="tabletext"><input type="text" name="shift" size=3 value="<?php echo $myrow['shift'] ?>"></td>
            <td><span class="tabletext"><input type="text" name="time_per_piece" size=8 value="<?php echo $myrow['time_per_piece'] ?>"></td>
            <td><span class="tabletext"><input type="text" name="qty_assigned" size=3 value="<?php echo $myrow['qty_assigned'] ?>"></td>
            <td><span class="tabletext"><input type="text" name="qty_produced" size=8 value="<?php echo $myrow['qty_produced'] ?>"></td>
            <td><span class="tabletext"><input type="text" name="rejection" size=3 value="<?php echo $myrow['rejection'] ?>"></td>
            <input type="hidden" name="fittingrecnum" size=3 value="<?php echo $fittingrecnum ?>">

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

</td></tr></table>
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
						<table border = 0 cellpadding=0 cellspacing=0 width=100% >
							<tr>
								<td align=left>

							</td>
							</tr>
						</table>
		</body>
</html>
