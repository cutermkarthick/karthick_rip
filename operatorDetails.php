<?php
//==============================================
// Author: FSI                                 =
// Date-written = april 04, 2007               =
// Filename: new_review.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of reviews                     =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
  header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$userrole = $_SESSION['userrole'];

$_SESSION['pagename'] = 'operator_details';
//////session_register('pagename');

// First include the class definition
include('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/operatorClass.php');
include_once('classes/empClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$oper_name = $_REQUEST['oper_name'];
$mc_name = $_REQUEST['mc_name'];
$crn = $_REQUEST['crn_num'];
$dept=$_SESSION['department'];
$page = "PRODN: Operator";
$newdisplay = new display;
$newoperator = new operator;
$newEmp = new emp();
$result = $newoperator->getoperator_data($oper_name,$mc_name,$crn);
//$myrow = mysql_fetch_assoc($result);

$result2 = $newoperator->getmcs();


$cond1 = "o.oper_name like '%'";
$cond2 = "(to_days(`o`.st_date)-to_days('1582-01-01') > 0 ||
                    `o`.st_date = '0000-00-00' ||
                    `o`.st_date = 'NULL' ) and
           (to_days(`o`.st_date)-to_days('2050-12-31') < 0 ||
                    `o`.st_date = '0000-00-00' ||
                    `o`.st_date = 'NULL')";
$cond3 = "o.mc_name like '%'";
$cond5 = "o.crn like '%'";
$oper1='like';
$oper2='like';
$sort1='st_date';
$oper3='like';

 if ( isset ( $_REQUEST['operator'] ) )
{
     $operator = $_REQUEST['operator'];
     if ( isset ( $_REQUEST['oper_oper'] ) ) {
          $oper1 = $_REQUEST['oper_oper'];
     }
     else {
         $oper1 = 'like';
     }
     if ($oper1 == 'like') {
         $final_operator = "'" . $_REQUEST['operator'] . "%" . "'";
     }
     else {
         $final_operator = "'" . $_REQUEST['operator'] . "'";
     }

     $cond1 = "o.oper_name " . $oper1 . " " . $final_operator;

}


if ( isset ( $_REQUEST['name'] ) )
{
     $name_match = $_REQUEST['name'];
     if ( isset ( $_REQUEST['name_oper'] ) ) {
          $oper2 = $_REQUEST['name_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $final_name = "'" . $_REQUEST['name'] . "%" . "'";
     }
     else {
         $final_name = "'" . $_REQUEST['name'] . "'";
     }

     $cond3 = "o.mc_name " . $oper2 . " " . $final_name;

}


if ( isset ( $_REQUEST['status'] ) )
{	        	
	 if($_REQUEST['status'] == 'select')
	{
      $status_match = 'select'; 
	  $cond4 = "(o.status like '%' || o.status is NULL )";
    }
	else{
	  $status_match = "'".$_REQUEST['status']."'"; 
	 $cond4 = 'o.status = '.$status_match;
	}
}
else
{
 $status_match = 'select'; 
$cond4 = "(o.status like '%' || o.status is NULL )";
}



 if ( isset ( $_REQUEST['sortCond'] ) )
  {
    $sort1 = $_REQUEST['sortCond'];
    if ($sort1=='Descending')
         $sort1= "`o`.st_date Desc" ;
         else
        $sort1= "`o`.st_date" ;
   }


 if ( isset ( $_REQUEST['date1'] ) || isset ( $_REQUEST['date2'] ) )
  {
     $date1_match = $_REQUEST['date1'];
     $date2_match = $_REQUEST['date2'];
     if ( isset ( $_REQUEST['date1']) &&  $_REQUEST['date1'] != '' )
     {
          $date1 = $_REQUEST['date1'];
          $cond21 = "to_days(`o`.st_date) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond21 = "(to_days(`o`.st_date)-to_days('1582-01-01') > 0 || `o`.st_date = 'NULL' || `o`.st_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['date2'] )  &&  $_REQUEST['date2'] != '')
     {
          $date2 = $_REQUEST['date2'];
          $cond22 = "to_days(`o`.st_date) " . "< to_days('" . $date2 . "')";
     }
     else
     {
          $cond22 = "(to_days(`o`.st_date)-to_days('2050-12-31') < 0 || `o`.st_date = 'NULL' || `o`.st_date = '0000-00-00')";
     }
     $cond2 = $cond21 . ' and ' . $cond22;

}
else
{
     $date1_match = '';
     $date2_match = '';
}
if ( isset ( $_REQUEST['crn_num'] ) )
{
     $crn = $_REQUEST['crn_num'];
     if ( isset ( $_REQUEST['crn_oper'] ) ) {
          $oper3 = $_REQUEST['crn_oper'];
     }
     else {
         $oper3 = 'like';
     }
     if ($oper3 == 'like') {
         $final_crn = "'" . $_REQUEST['crn_num'] . "%" . "'";
     }
     else {
         $final_crn = "'" . $_REQUEST['crn_num'] . "'";
     }

     $cond5 = "o.crn " . $oper3 . " " . $final_crn;

}
$cond =  $cond1 . ' and ' . $cond2 . ' and ' . $cond3. ' and ' . $cond4. ' and ' . $cond5;
// echo $cond;
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
?>
<input type="hidden"  name="total_prev_mins" id="total_prev_mins" size=3 value="<?echo $total_prev_mins;?>">

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/operator.js"></script>
<!--<script language="javascript" src="scripts/woentry.js"></script>-->


<html>
<head>
<title>Operator data</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr>
        					<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        					<td align="right">&nbsp;
       					<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        				 </tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0>
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0>

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=1>
  <!--  <tr>
        <td><span class="pageheading"><b>Operator Data Form</b></td>
        <td align=right><a href='edit_operator_data.php?operatorrecnum=<?php echo $operatorrecnum ?>'><img src='images/bu-edit.gif' border=0></a></td>
    </tr> -->

<tr>

<!------------------------------------------search records---------------------------------------------->

 <tr><td>
          <tr><td><span class="heading"><i>Please click on the Operator Name to Edit/Delete</i></td></tr>
		</tr>
  <tr>
<td>

<form action='operatorDetails.php?scompany=$company_match&company_oper=$oper&sortfld1=$sort1&scompanyfl=$where1' method='post' enctype='multipart/form-data'>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
  <tr>
	<td bgcolor="#F5F6F5" colspan="7"><span class="heading"><b><center>Search Criteria</center></b></td>
    <td bgcolor="#FFFFFF" rowspan=3 align="center">
	
<button class="stdbtn btn_blue" style="background-color:#2d3e50;" onClick="javascript: return searchsort_fields()" >Get</button>
<input type="button" class="stdbtn btn_blue" style="float:right;padding:6px;margin-right:5px;" onClick="location.href='operatorEntry.php'" value="New" > 
  <!-- <input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()"> -->
	</td>
 </tr>
 <tr>

<td bgcolor="#FFFFFF"><span class="labeltext">

Operator:

</td>


<td bgcolor="#FFFFFF"><span class="tabletext"><select name="oper_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['oper_oper'] ) ){
          $check2 = $_REQUEST['oper_oper'];

                   if ($check2 =='like'){
?>
    	            <option value>=
	                <option  selected>like
<?php
                    }else{
?>
                    <option  selected>=
	                <option>like

 <?php
                    }
   }else{
?>
 	<option  selected>like
	<option value>=
 <?PHP
  }
 ?>
</select></td>



<?php
 $operator='';
 if (isset($_REQUEST['operator'])) {
 $operator= $_REQUEST['operator'];
 }
?>

<td bgcolor="#FFFFFF"><input type="text" name="operator" size=15 value="<?php echo  $operator ?>" ></td>

		<td  bgcolor="#FFFFFF"><span class="labeltext"><b>Date:  From &nbsp;&nbsp;</b>
        <input type="text" name="date1" size=10 value="<?php echo $date1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("date1")'></td>
         <td bgcolor="#FFFFFF" colspan=3><span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="date2" size=10 value="<?php echo $date2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("date2")'>
       </td>


<tr>
  <td bgcolor="#FFFFFF"><span class="labeltext">M/C Name:</td>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="name_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['name_oper'] ) ){
          $check2 = $_REQUEST['name_oper'];

                   if ($check2 =='like'){
?>
    	            <option value>=
	                <option  selected>like
<?php
                    }else{
?>
                    <option  selected>=
	                <option>like

 <?php
                    }
   }else{
?>
 	<option  selected>like
	<option value>=
 <?PHP
  }
 ?>
</select></td>

<td bgcolor="#FFFFFF"><input type="text" name="name" size=15 value="<?php echo  $name_match ?>" ></td>
<td bgcolor="#FFFFFF" >
<span class="labeltext">Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<?$stat=array('Pending','Approved','Cancelled');?>
<select name="status">
<option value="select">All</option>
<?php
for($i=0;$i<count($stat);$i++){	
if($stat[$i]==$_REQUEST['status']){
?>
<option selected value="<? echo $stat[$i]?>">
<?echo $stat[$i] ?> </option>
<?
}
else{
?>
<option value="<? echo $stat[$i]?>">
<?echo $stat[$i]; ?> </option>
<?php
}
}
?>
</select>
</td>
<td bgcolor="#FFFFFF"><span class="labeltext">

CRN #:

</td>


<td bgcolor="#FFFFFF"><span class="tabletext"><select name="crn_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['crn_oper'] ) ){
          $check2 = $_REQUEST['crn_oper'];

                   if ($check2 =='like'){
?>
    	            <option value>=
	                <option  selected>like
<?php
                    }else{
?>
                    <option  selected>=
	                <option>like

 <?php
                    }
   }else{
?>
 	<option  selected>like
	<option value>=
 <?PHP
  }
 ?>
</select></td>



<?php
 $crn='';
 if (isset($_REQUEST['crn_num'])) {
 $crn= $_REQUEST['crn_num'];
 }
?>

<td bgcolor="#FFFFFF"><input type="text" name="crn_num" size=15 value="<?php echo  $crn ?>" ></td>

</tr>


	</table>
	</td></tr>
<!-------------------------------------end of search records---------------------------------------->

<td colspan=2>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#FFFFFF" class="stdtable">
      <tr bgcolor="#DFDEDF">
            <td colspan=4><span class="heading"><center><b>Operator Details</b></center></td>

        </tr>
 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable" >

 <?php

     $oper_oper='';
     $opercond='';
         if ( isset( $_REQUEST['oper_oper'] ) ){
          $oper_oper = $_REQUEST['oper_oper'];
         }

         if ( isset ( $_REQUEST['operator'] ) ){
          $opercond = $_REQUEST['operator'];
         }

     $op = new operator();
     $result3 = $op->getops();
     $result = $newoperator->getoperator_data1($cond,$offset,$rowsPerPage,$sort1);     
     ?>
     <thead>
            <tr>
            <th class="head0" width=8%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>M/C Name </p></font></th>
            <th class="head1" width=10%><span class="labeltext"><p align="left">Operator </p></font></th>
            <th class="head0" width=10%><span class="labeltext"><p align="left">Date </p></font></th>
            <th class="head1" width=4%><span class="labeltext"><p align="left">Shift </p></font></th>
            <th class="head0" width=6%><span class="labeltext"><p align="left">PRN</p></font></th>
            <th class="head1" width=6%><span class="labeltext"><p align="left">WO No.</p></font></th>
            <th class="head0" width=8%><span class="labeltext"><p align="left">Stage </p></font></th>
            <th class="head1" width=8%><span class="labeltext"><p align="left">Setting <br>Time</p></font></th>
            <th class="head0" width=8%><span class="labeltext"><p align="left">Running <br>Time</p></font></th>
            <th class="head1" width=8%><span class="labeltext"><p align="left">Idle <br>Time</p></font></th>
		    <th class="head0" width=8%><span class="labeltext"><p align="left">B/down <br>Time</p></font></th>
            <th class="head1" width=6%><span class="labeltext"><p align="left">Qty</p></font></th>
            <th class="head0"th class="head0" width=6%><span class="labeltext"><p align="left">Rej Qty</p></font></th>
            <th class="head1" width=8%><span class="labeltext"><p align="left">Sl. From</p></font></th>
            <th class="head0" width=8%><span class="labeltext"><p align="left">Sl. To</p></font></th>
			<th class="head1" width=8%><span class="labeltext"><p align="left">Status</p></font></th>

        </tr>
      </thead>

    <?php
    //$myrow = mysql_fetch_assoc($result);
       while($myrow = mysql_fetch_assoc($result))
       {
          /*if(is_array($myrow))
            echo '<br>hi<br>';
          $arr = explode(',',$myrow);

             echo '<br>'.$arr[0][0]. '<br>';  */
          $operatorrecnum = $myrow["recnum"];
          $setting_time = $newoperator->getsetting_time1($operatorrecnum);
          $running_time = $newoperator->getrunning_time1($operatorrecnum);
          $idle_time = $newoperator->getidle_time1($operatorrecnum);
          $qty = $newoperator->getqty1($operatorrecnum);
          $sl_from = $newoperator->getsl_from1($operatorrecnum);
          $sl_to = $newoperator->getsl_to1($operatorrecnum);
          $setting_time_mins = $newoperator->getsetting_time_mins1($operatorrecnum);
          $running_time_mins = $newoperator->getrunning_time_mins1($operatorrecnum);
          $idle_time_mins = $newoperator->getidle_time_mins1($operatorrecnum);
          
          if($myrow['st_date'] != '0000-00-00' && $myrow['st_date'] != '' && $myrow['st_date'] != 'NULL')
          {
              $datearr = split('-', $myrow['st_date']);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $date=date("M j, Y",$x);
          }
          else
          {
              $date = '';
          }

          $today = date("Y-m-d");
          $date_parts1=explode('-', $myrow['st_date']);
          $start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
          $date_parts2=explode('-', $today);
          $end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
          $diff = $end_date - $start_date;	  	
		  //echo $userrole.'====='.$dept;

    ?>

        <tr bgcolor="#FFFFFF">
            <td width=8%><span class="tabletext"><?php echo $myrow['mc_name'] ?> </td>
            <td width=10%><span class="tabletext">
             <?php
               if ($diff < 3 || $myrow['st_date'] == '' ||
                    $myrow['st_date'] == '0000-00-00' || $userrole == 'SU' || $dept == 'PPC1')
               {
             ?>
            <a href='edit_operator_data.php?operatorrecnum=<?php echo $operatorrecnum ?>'><?php echo $myrow['oper_name'] ?></a>
            <?php
               }
              else
                 echo $myrow['oper_name'];
            ?>

            </td>

            <td><span class="tabletext"><?php echo $date ?></td>
            <td><span class="tabletext"><?php echo $myrow['shift'] ?></td>
            <td><span class="tabletext"><?php echo $myrow['crn'] ?></td>
            <td><span class="tabletext"><?php echo $myrow['wo_num'] ?></td>
            <td><span class="tabletext"><?php echo $myrow['stage_num'] ?></td>
            <td><span class="tabletext"><?php echo $myrow['setting_time']? "$myrow[setting_time] h " : '';echo $myrow['setting_time_mins']? "$myrow[setting_time_mins] m" : ''; ?></td>
            <td><span class="tabletext"><?php echo $myrow['running_time']? "$myrow[running_time] h " : '';echo $myrow['running_time_mins']? "$myrow[running_time_mins] m": ''; ?></td>
            <td><span class="tabletext"><?php echo $myrow['idle_time']? "$myrow[idle_time] h ": '';echo $myrow['idle_time_mins']? "$myrow[idle_time_mins] m": ''; ?></td>
		     <td><span class="tabletext"><?php echo $myrow['breakdown_time']? "$myrow[breakdown_time] h ": '';echo $myrow['breakdown_time_mins']? "$myrow[breakdown_time_mins] m": ''; ?></td>
            <td><span class="tabletext"><?php echo $myrow['qty']? $myrow['qty'] : ''; ?></td>
            <td><span class="tabletext"><?php echo $myrow['qty_rej']? $myrow['qty_rej'] : ''; ?></td>
            <td><span class="tabletext"><?php echo $myrow['sl_from']? $myrow['sl_from'] : ''; ?></td>
            <td><span class="tabletext"><?php echo $myrow['sl_to']? $myrow['sl_to'] : ''; ?></td>
            <td><span class="tabletext"><?php echo $myrow['status'] ?></td>
   <?php
       }
      ?>
      </table>
 <table border=0 cellpadding=0 cellspacing=0 width=100% >
							<tr>
								<td align=left>

<?php

//Additions on Dec 29 04 by Jerry George to implement pagination

$numrows = $newoperator->getoperCount($cond,$offset,$rowsPerPage);
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
    $prev = " <a href=\"operatorDetails.php?page=$page&totpages=$totpages&cim=$cim_match&customer=$cust_match&sortfld1=$sort1&operator=$operator&name=$name_match&status=$status_match&date1=$date1_match&date2=$date2_match&crn_num=$crn\">[Prev]</a> ";

    $first = " <a href=\"operatorDetails.php?page=1&totpages=$totpages&cim=$cim_match&customer=$cust_match&sortfld1=$sort1&operator=$operator&name=$name_match&status=$status_match&date1=$date1_match&date2=$date2_match&crn_num=$crn\">[First Page]</a> ";
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
    $next = " <a href=\"operatorDetails.php?page=$page&totpages=$totpages&cim=$cim_match&customer=$cust_match&sortfld1=$sort1&operator=$operator&name=$name_match&status=$status_match&date1=$date1_match&date2=$date2_match&crn_num=$crn\">[Next]</a> ";

    $last = " <a href=\"operatorDetails.php?page=$totpages&totpages=$totpages&cim=$cim_match&customer=$cust_match&sortfld1=$sort1&operator=$operator&name=$name_match&status=$status_match&date1=$date1_match&date2=$date2_match&crn_num=$crn\">[Last Page]</a> ";
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
 </form>

<br>

	</td>
    </tr>
    


</table>

</td>
	

		</table>

</table>
</body>
</html>
