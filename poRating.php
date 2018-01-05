<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 02, 2010                =
// Filename: poRating.php                      =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Displays Po Rating report.                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ("Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
//////session_register('pagename');

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/reportClass.php');
include_once('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$poreport = new report;
$newdisplay = new display;

$rowsPerPage = 3000;

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
$cond0 = "c.name like '%'";
$cond1 = "((to_days(po.podate)-to_days('1582-01-01') > 0 ||
                    po.podate = '0000-00-00' ||
                    po.podate is NULL) and
           (to_days(po.podate)-to_days('2050-12-31') < 0 ||
                    po.podate = '0000-00-00' ||
                    po.podate is NULL))";

$cond = $cond0;

$oper1='like';
$oper2='like';
$oper3='like';

$qval = 'Q2';
$yval = '2010';


if ( isset ( $_REQUEST['final_name'] ) )
{
     $finalname_match = $_REQUEST['final_name'];
     if ( isset ( $_REQUEST['name_oper'] ) ) {
          $oper1 = $_REQUEST['name_oper'];
     }
     else {
         $oper1 = 'like';
     }
     if ($oper1 == 'like') {
         $final_name = "'" . $_REQUEST['final_name'] . "%" . "'";
     }
     else {
         $final_name = "'" . $_REQUEST['final_name'] . "'";
     }

     $cond0 = "c.name " . $oper1 . " " . $final_name;

}
else
{
     $finalname_match = '';
}



/*if ( isset ( $_REQUEST['pdate1'] ) || isset ( $_REQUEST['pdate2'] ) )
{
     $date1_match = $_REQUEST['pdate1'];
     $date2_match = $_REQUEST['pdate2'];
     if ( isset ( $_REQUEST['pdate1']) &&  $_REQUEST['pdate2'] != '' )
     {
          $date1 = $_REQUEST['pdate1'];
          $cond21 = "to_days(po.podate) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond21 = "(to_days(po.podate)-to_days('1582-01-01') > 0 || po.podate is NULL || po.podate = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['pdate2'] )  &&  $_REQUEST['pdate2'] != '')
     {
          $date2 = $_REQUEST['pdate2'];
          $cond22 = "to_days(po.podate) " . "< to_days('" . $date2 . "')";
     }
     else
     {
          $cond22 = "(to_days(po.podate)-to_days('2050-12-31') < 0 || po.podate is NULL || po.podate = '0000-00-00')";
     }
     $cond2 = $cond21 . ' and ' . $cond22;

}
else
{
     $date1_match = '';
     $date2_match = '';
}*/

if(isset($_REQUEST['quarter_val']))
{
 $qval = $_REQUEST['quarter_val'];
}
//echo $qval;
if(isset($_REQUEST['year_val']))
{
 $yval = $_REQUEST['year_val'];
}

if($qval == 'Q1')
{
  $quarter = '1';
  $cur_quarter = array(1,2,3);
  $prev_quarter = array(10,11,12);
}
else if($qval == 'Q2')
{
  $quarter = '2';
  $cur_quarter = array(4,5,6);
  $prev_quarter = array(1,2,3);
}
else if($qval == 'Q3')
{
  $quarter = '3';
  $cur_quarter = array(7,8,9);
  $prev_quarter = array(4,5,6);
}
else if($qval == 'Q4')
{
  $quarter = '4';
  $cur_quarter = array(10,11,12);
  $prev_quarter = array(7,8,9);
}
//print_r($cur_quarter);

/*if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];

}*/

$cond = $cond0;

$userrole = $_SESSION['userrole'];
$dept = $_SESSION['department'];

//echo $cond;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>

<html>
<head>
<title>PO Rating Report</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='poRating.php' method='post' enctype='multipart/form-data'>
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
			<table width=100% border=0 cellpadding=0 cellspacing=0>
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	    <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0>
     <tr><td>
		</tr>
  <tr>
<td>


<table width=70% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
  <tr>
	<td bgcolor="#F5F6F5" colspan="20"><span class="heading"><b><center>Search & Sort Criteria</center></b></td>
    <td bgcolor="#FFFFFF" rowspan=3 align="center">
	<input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()">
	</td>
  </tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Supplier</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><select name="name_oper" size="1" width="50">
<?php
   if ( isset ( $_REQUEST['name_oper'] ) ){
          $check2 = $_REQUEST['name_oper'];

                   if ($check2 =='like'){
?>
    	            <option value>=
	                <option selected>like
<?php
                    }else{
?>
                    <option selected>=
	                <option value>like

 <?php
                    }
   }else{
?>
 	<option selected>like
	<option value>=
 <?PHP
  }
 ?>
</select></td>

<td bgcolor="#FFFFFF"><input type="text" name="final_name" size=25 value="<?php echo $finalname_match ?>" onkeypress="javascript: return checkenter(event)">
</td>


<!--<td colspan=22 bgcolor="#FFFFFF"><span class="labeltext"><b>PO Date:  From</b>
        <input type="text" name="pdate1" size=10 value="<?php echo $date1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("pdate1")'>
         <span class="labeltext"><b>&nbsp;To</b>
        <input type="text" name="pdate2" size=10 value="<?php echo $date2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("pdate2")'>
</td>-->
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Quarter</b></td>
<td bgcolor="#FFFFFF"><span class="tabletext"><select id="quarter_val" name="quarter_val" size="1" width="100">
<?php
      if ($qval == 'Q1')
      {
?>
	<option value='Q1' selected>Q1
	<option value='Q2'>Q2
	<option value='Q3'>Q3
    <option value='Q4'>Q4
<?php
      }
      else if ($qval == 'Q2')
      {
?>
	<option value='Q2' selected>Q2
	<option value='Q1'>Q1
	<option value='Q3'>Q3
    <option value='Q4'>Q4
<?php
      }
      else if ($qval == 'Q3')
      {
?>
	<option value='Q3' selected>Q3
	<option value='Q1'>Q1
    <option value='Q2'>Q2
    <option value='Q4'>Q4
<?php
      }
      else if ($qval == 'Q4')
      {
?>
	<option value='Q4' selected>Q4
	<option value='Q1'>Q1
    <option value='Q2'>Q2
    <option value='Q3'>Q3

<?php
      }
?>
</select>
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Year</b></td>
<td bgcolor="#FFFFFF" colspan=14><span class="tabletext"><select id="year_val" name="year_val" size="1" width="100">
<?php
      if ($yval == '2010')
      {
?>
	<option value='2010' selected>2010
	<option value='2007'>2007
	<option value='2008'>2008
    <option value='2009'>2009
<?php
      }
      else if ($yval == '2009')
      {
?>
	<option value='2009' selected>2009
	<option value='2010'>2010
	<option value='2008'>2008
    <option value='2007'>2007
<?php
      }
      else if ($yval == '2008')
      {
?>
	<option value='2008' selected>2008
	<option value='2007'>2007
    <option value='2009'>2009
    <option value='2010'>2010
<?php
      }
      else if ($yval == '2007')
      {
?>
	<option value='2007' selected>2007
	<option value='2008'>2008
    <option value='2009'>2009
    <option value='2010'>2010

<?php
      }

?>
</select>
</td>
</tr>
	</table>
	</td></tr>
	<tr><td>
<table width=100% border=0>
  <tr>
  <td><span class="pageheading"><b>PO Rating Report</b></td>
  </td>
  </tr>
</table>
<table  width=50% cellpadding=3 border=1 cellspacing=1>
<?php
$sup_result = $poreport->getSupp($cond);

      if($quarter == '1')
      {
        $prev = '4';
        $cur = $quarter;
        $prevyear = ($yval-1);
        $curyear = $yval;
      }
      else
      {
        $prev = ($quarter-1);
        $cur = $quarter;
        $prevyear = $yval;
        $curyear = $yval;
      }

      printf('<tr bgcolor="#FFFFFF">');
      printf('<td bgcolor="#ADDFFF"><span class="tabletext"><b>%s</b></td>','Supplier');
      printf('<td bgcolor="#ADDFFF"><span class="tabletext"><b>%s</b></td>','Rating');
      //printf('<td bgcolor="#ADDFFF" colspan=1 align="center"><span class="tabletext"><b>%s:%s%s</b></td>',$prevyear,'Q',$prev);
      printf('<td bgcolor="#ADDFFF" colspan=1 align="center"><span class="tabletext"><b>%s:%s%s</b></td>',$curyear,'Q',$cur);
      printf('</tr>');
     $company_arr = array('AMI Metals');
     $rating_arr = array();
     $prev_supp = '#';
     $prev_comp = '#';
     $dup_arr = array();
     $counter = 0;
    while($myrow_sup = mysql_fetch_row($sup_result)) //for each supplier
    {
     foreach($company_arr as $cname)
     {
      if(stristr($myrow_sup[1],$cname))
      {
        //echo $myrow_sup[1].'<br>';
       if(!stristr($myrow_sup[1],$prev_comp))
       {
         if($counter > 0)
         {
           $rating_arr[$prev_comp] = $qty_ordered . "|". $qty_rej . "|" . $delivery . "|" . $delivery_count . "|" . $comm . "|" . $comm_count;
         }
         $qty_ordered = 0;
         $qty_rej = 0;
         $quality = 0;
         $delivery = 0;
         $delivery_count = 0;
         $comm = 0;
         $comm_count = 0;
        //Quality Rating
         $prev_qua_result = $poreport->get_rating($prev,$prevyear,$myrow_sup[0]);
         $myrow_quality = mysql_fetch_row($prev_qua_result);
         $qty_ordered = ($myrow_quality[3]+$myrow_quality[4]);
         $qty_rej = ($myrow_quality[5] != 'NULL')?$myrow_quality[5]:0;

         //Delivery Rating
         $cur_del_result = $poreport->get_rating($cur,$curyear,$myrow_sup[0]);
         $myrow_del = mysql_fetch_row($cur_del_result);
         $result_numrows = $poreport->get_numRows($cur,$curyear,$myrow_sup[0]);
         $numrows =  mysql_fetch_row($result_numrows);
         $delivery_count += $numrows[0];
         $delivery = ($myrow_del[6] != 'NULL' && $myrow_del[6] != '')?$myrow_del[6]:0;

         //Comm Rating
         $cur_com_result = $poreport->get_rating($cur,$curyear,$myrow_sup[0]);
         $myrow_comm = mysql_fetch_row($cur_com_result);
         $result_numrows =  $poreport->get_numRows_com($cur,$curyear,$myrow_sup[0]);
         $numrows =  mysql_fetch_row($result_numrows);
         $comm_count += $numrows[0];
         $comm = ($myrow_comm[8] != 'NULL' && $myrow_comm[8] != '')?$myrow_comm[8]:0;
       }
      else
      {
        //Quality Rating
        $prev_qua_result = $poreport->get_rating($prev,$prevyear,$myrow_sup[0]);
        $myrow_quality = mysql_fetch_row($prev_qua_result);
        $qty_ordered += ($myrow_quality[3]+$myrow_quality[4]);
        $qty_rej += ($myrow_quality[5] != 'NULL')?$myrow_quality[5]:0;

        //Delivery Rating
        $cur_del_result = $poreport->get_rating($cur,$curyear,$myrow_sup[0]);
        $myrow_del = mysql_fetch_row($cur_del_result);
        $result_numrows = $poreport->get_numRows($cur,$curyear,$myrow_sup[0]);
        $numrows =  mysql_fetch_row($result_numrows);
        $delivery_count += $numrows[0];
        $delivery += ($myrow_del[6] != 'NULL' && $myrow_del[6] != '')?$myrow_del[6]:0;

        //Comm Rating
        $cur_com_result = $poreport->get_rating($cur,$curyear,$myrow_sup[0]);
        $myrow_comm = mysql_fetch_row($cur_com_result);
        $result_numrows =  $poreport->get_numRows_com($cur,$curyear,$myrow_sup[0]);
        $numrows =  mysql_fetch_row($result_numrows);
        $comm_count += $numrows[0];
        $comm += ($myrow_comm[8] != 'NULL' && $myrow_comm[8] != '')?$myrow_comm[8]:0;
       }
       $dup_arr[] = $myrow_sup[1];
       $prev_comp = $cname;
       $counter++;
      }
     }
    }
   if($prev_comp != "#")
   {
    $rating_arr[$prev_comp] = $qty_ordered . "|". $qty_rej . "|" . $delivery . "|" . $delivery_count . "|" . $comm . "|" . $comm_count;
   }
   $counter=0;
   mysql_data_seek($sup_result,0);
    //print_r($rating_arr).'<br>';
    //print_r($dup_arr).'<br>';
    while($myrow_sup = mysql_fetch_row($sup_result)) //for each supplier
    {
      if(!in_array($myrow_sup[1],$dup_arr))
      {
       //echo '<br>'.$myrow_sup[1].'<br>';
       if($prev_supp != $myrow_sup[1])
       {
        if($counter > 0)
        {
          $rating_arr[$prev_supp] = $qty_ordered . "|". $qty_rej . "|" . $delivery . "|" . $delivery_count . "|" . $comm . "|" . $comm_count;
        }
        $qty_ordered = 0;
        $qty_rej = 0;
        $quality = 0;
        $delivery = 0;
        $delivery_count = 0;
        $comm = 0;
        $comm_count = 0;
       //Quality Rating
        $prev_qua_result = $poreport->get_rating($prev,$prevyear,$myrow_sup[0]);
        $myrow_quality = mysql_fetch_row($prev_qua_result);
        $qty_ordered = ($myrow_quality[3]+$myrow_quality[4]);
        $qty_rej = ($myrow_quality[5] != 'NULL')?$myrow_quality[5]:0;

        //Delivery Rating
        $cur_del_result = $poreport->get_rating($cur,$curyear,$myrow_sup[0]);
        $myrow_del = mysql_fetch_row($cur_del_result);
        $result_numrows = $poreport->get_numRows($cur,$curyear,$myrow_sup[0]);
        $numrows =  mysql_fetch_row($result_numrows);
        $delivery_count += $numrows[0];
        $delivery = ($myrow_del[6] != 'NULL' && $myrow_del[6] != '')?$myrow_del[6]:0;

        //Comm Rating
        $cur_com_result = $poreport->get_rating($cur,$curyear,$myrow_sup[0]);
        $myrow_comm = mysql_fetch_row($cur_com_result);
        $result_numrows =  $poreport->get_numRows_com($cur,$curyear,$myrow_sup[0]);
        $numrows =  mysql_fetch_row($result_numrows);
        $comm_count += $numrows[0];
        $comm = ($myrow_comm[8] != 'NULL' && $myrow_comm[8] != '')?$myrow_comm[8]:0;
      }
      else
      {
        //Quality Rating
        $prev_qua_result = $poreport->get_rating($prev,$prevyear,$myrow_sup[0]);
        $myrow_quality = mysql_fetch_row($prev_qua_result);
        $qty_ordered += ($myrow_quality[3]+$myrow_quality[4]);
        $qty_rej += ($myrow_quality[5] != 'NULL')?$myrow_quality[5]:0;

        //Delivery Rating
        $cur_del_result = $poreport->get_rating($cur,$curyear,$myrow_sup[0]);
        $myrow_del = mysql_fetch_row($cur_del_result);
        $result_numrows = $poreport->get_numRows($cur,$curyear,$myrow_sup[0]);
        $numrows =  mysql_fetch_row($result_numrows);
        $delivery_count += $numrows[0];
        $delivery += ($myrow_del[6] != 'NULL' && $myrow_del[6] != '')?$myrow_del[6]:0;

        //Comm Rating
        $cur_com_result = $poreport->get_rating($cur,$curyear,$myrow_sup[0]);
        $myrow_comm = mysql_fetch_row($cur_com_result);
        $result_numrows =  $poreport->get_numRows_com($cur,$curyear,$myrow_sup[0]);
        $numrows =  mysql_fetch_row($result_numrows);
        $comm_count += $numrows[0];
        $comm += ($myrow_comm[8] != 'NULL' && $myrow_comm[8] != '')?$myrow_comm[8]:0;
      }
       $prev_supp = $myrow_sup[1];
       $counter++ ;
     }

    }//end of while
   if($prev_supp != "#")
   {
     $rating_arr[$prev_supp] = $qty_ordered . "|" . $qty_rej . "|" . $delivery . "|" . $delivery_count . "|" . $comm . "|" . $comm_count;
   }
   // print_r($rating_arr);
   ksort($rating_arr);
   foreach($rating_arr as $key => $supplier)
   {
       $supp_arr = explode("|",$supplier);
       $qty_ord = $supp_arr[0];
       $qty_rej = $supp_arr[1];
       $del = $supp_arr[2];
       $delcount = $supp_arr[3];
       $com = $supp_arr[4];
       $comcount = $supp_arr[5];
       $quality = 0;
       $delivery = 0;
       $communication = 0;
       printf('<tr bgcolor="#FFFFFF">');
       printf('<td bgcolor="#EEEFEE"><span class="tabletext"><b>%s</b></td>',$key);
       printf('<td bgcolor="#FFFFFF"><span class="tabletext"><b>%s</b></td>','Quality');

       if($qty_ord != 0)
       {
           //echo 'ord'.$qty_ordered .'<br>';
           //echo 'rej'.$qty_rej;
          $quality = ((($qty_ord-$qty_rej)/$qty_ord)*100);
          $quality = ($quality*0.6);
          printf('<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%.2f</td>',$quality);
       }
       else
       {
           printf('<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>','&nbsp');
       }
       printf('</tr>');
       printf('<tr bgcolor="#FFFFFF">');
       printf('<td bgcolor="#FFFFFF"><span class="tabletext"><b></b></td>');
       printf('<td bgcolor="#FFFFFF"><span class="tabletext"><b>%s</b></td>','Delivery');
       if($delcount != 0 && $del!=0)
       {
          $delivery = round($del/$delcount);
          if($delivery == 1)
          {
             $delivery = 100;
          }
          else if($delivery == 2)
          {
             $delivery = 66.67;
          }
          else if($delivery == 3)
          {
             $delivery = 33.33;
          }
          $delivery = ($delivery*0.3);
          printf('<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%.2f</td>',$delivery);
       }
       else
       {
          printf('<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>','&nbsp');
       }

       printf('</tr>');
       printf('<tr bgcolor="#FFFFFF">');
       printf('<td bgcolor="#FFFFFF"><span class="tabletext"><b></b></td>');
       printf('<td bgcolor="#FFFFFF"><span class="tabletext"><b>%s</b></td>','Comm');

        if($comcount != 0)
        {
          //echo $count;
          //echo '<br>';
          //echo $myrow_comm[8];
          $communication = (($com/$comcount)*0.1);
           printf('<td bgcolor="#FFFFFF" align="center"><span class="tabletext">%.2f</td>',$communication);
        }
        else
        {
           printf('<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>','&nbsp');
        }
       printf('</tr>');
       printf('<tr bgcolor="#FFFFFF">');
       printf('<td bgcolor="#FFFFFF"><span class="tabletext"><b></b></td>');
       printf('<td bgcolor="#EEEFEE" align="right"><span class="tabletext"><b>%s</b></td>','Total');
       $grand_total = ($quality + $delivery + $communication);
       if($grand_total != 0)
       {
         printf('<td bgcolor="#EEEFEE" align="center"><span class="tabletext">%.2f</td>',$grand_total);
       }
       else
       {
         printf('<td bgcolor="#EEEFEE"><span class="tabletext">%s</td>','&nbsp');
       }
    }
?>
</tr>
</td>
</tr>
</table>
</td>
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
        <table border=0 cellpadding=0 cellspacing=0 width=100%>
							<tr>
								<td align=left>

<?php
   //$numrows = $ncreport->getporat_Count($cond,$offset,$rowsPerPage);
    $numrows=10;
   // how many pages we have when using paging?
   $maxPage = ceil($numrows/$rowsPerPage);
//echo "$maxPage</br>";
if (!isset($_REQUEST['page']))
{
//  echo "page is set";
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
    //$prev = " <a href=\"poRating.php?page=$page&totpages=$totpages&final_cofc=$cofc_match&final_refno=$finalref_match&sdate1=$date1_match&sdate2=$date2_match\">[Prev]</a> ";

    //$first = " <a href=\"poRating.php?page=1&totpages=$totpages&final_cofc=$cofc_match&final_refno=$finalref_match&sdate1=$date1_match&sdate2=$date2_match\">[First Page]</a> ";
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
    //$next = " <a href=\"poRating.php?page=$page&totpages=$totpages&final_cofc=$cofc_match&final_refno=$finalref_match&sdate1=$date1_match&sdate2=$date2_match\">[Next]</a> ";

    //$last = " <a href=\"poRating.php?page=$totpages&totpages=$totpages&final_cofc=$cofc_match&final_refno=$finalref_match&sdate1=$date1_match&sdate2=$date2_match\">[Last Page]</a> ";
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
//echo "<span class=\"labeltext\">" . $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$totpages</strong> pages " . $next . $last;
}
else
//echo "<span class=\"labeltext\"><align=\"center\">No matching records found";
// End additions on Dec 29,04
?>

</td>
</tr>
</table>
</FORM>
</body>
</html>

