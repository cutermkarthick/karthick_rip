<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = July 10, 2006                =
// Filename: salesorder.php                    =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Displays list of Salesorder.                =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];
$usertype = $_SESSION['usertype'];
$_SESSION['pagename'] = 'salesorder';

$page = "CRM: Sales Order";
// $_SESSION['pageval'] = "Sales: Cust PO";
// //////session_register('pagename');
// if ($dept != 'Sales')
// {
//      header("Location:login.php");
// }
$userrole = $_SESSION['userrole'];
 //echo   $userrole;
//Following code added to implement search,sort  and Pagination on Dec 29-04 by Jerry George
$wcond = "company.name like '". $_SESSION[cname]."'";
$cond1 = "sales_order.po_num like '%'";
$cond2 = "soli.crn_num like '%'";
$sort1='name';
$select='name';
$worec='';
$where1='';
$oper='like';
$oper1='like';
$oper2='like';
if ( !isset ( $_SESSION['cname'] ) )
{
     $_SESSION[cname]=$_REQUEST['cname'];

}
//echo $_SESSION[cname];
if ( isset ( $_REQUEST['cname'] ))
{


  $_SESSION[cname]=$_REQUEST['cname'];
   // echo $_SESSION['cname'];
	$count=$
   $cname_match =$_SESSION[cname];
   if ($cname_match!='')
{

     if ( isset ( $_REQUEST['salesorder_oper'] ) )
    {
   	  $oper = "like";
    }
    else
    {
    	 $oper = 'like';
    }
    if ($oper == 'like')
    {
    	 $cname = "'" . $_SESSION[cname] . "%" . "'";
    }
     else
     {
 	 $cname = "'" . $_SESSION[cname] . "'";
     }
     $wcond = "company.name " . $oper .  " " . $cname;
}
else
{
$wcond="company.name like '". $_SESSION[cname]."%'  and soli.partnum like '".$_REQUEST['partnumber']."%' and soli.crn_num like '".$_REQUEST['final_crnnum']."%' and sales_order.po_num like '".$_REQUEST['final_ponum']."%' ";
}

 }else
{
 	$cname_match = '';
}
if ( isset ( $_REQUEST['sortfld1'] ) )
{
	 $sort1 = $_REQUEST['sortfld1'];
}
$partnumber=$_REQUEST['partnumber'];
$crnnum=$_REQUEST['final_crnnum'];
$ponum=$_REQUEST['final_ponum'];
if($_SESSION[cname]=='select'  && ($partnumber!='' || $crnnum !='' || $ponum !=''))
{
//echo "am here";
$wcond="soli.partnum like '".$_REQUEST['partnumber']."%'and soli.crn_num like '".$_REQUEST['final_crnnum']."%'and sales_order.po_num like '".$_REQUEST['final_ponum']."%' ";
}
if(($partnumber==''|| $crnnum =='' || $ponum =='' )&& $cname_match!='')
{
$wcond="company.name like '". $_SESSION[cname]."'";
}

if(isset ($_REQUEST['status'] ) )
{

     $sval = $_REQUEST['status'];

      if ($sval== 'Open')
      {

         $cond0 = "(sales_order.status = '" . $sval . "' || sales_order.status is NULL || sales_order.status = '')";
      }
     else if ($sval == 'Closed')
      {
         $cond0 = "sales_order.status = '" . $sval . "'" ;
      }
      else if ($sval == 'Pending')
      {
         $cond0 = "sales_order.status = '" . $sval . "'" ;
      }
     else if ($sval == 'All')
      {
         $cond0 = "(sales_order.status like '%' || sales_order.status is NULL)";
      }
       else if ($sval == 'Cancelled')
      {
         $cond0 = "sales_order.status = '" . $sval . "'" ;
      }
}
else
{
     $sval = 'Open';
     $cond0 = "(sales_order.status = '" . $sval . "' || sales_order.status is NULL || sales_order.status = '')";
}
if ( isset ( $_REQUEST['final_ponum'] ) )
{
     $ponum_match = $_REQUEST['final_ponum'];
     if ( isset ( $_REQUEST['ponum_oper'] ) ) {
          $oper1 = $_REQUEST['ponum_oper'];
     }
     else {
         $oper1 = 'like';
     }
     if ($oper1 == 'like') {
         $final_ponum = "'" . $_REQUEST['final_ponum'] . "%" . "'";
     }
     else {
         $final_ponum = "'" . $_REQUEST['final_ponum'] . "'";
     }

     $cond1 = "sales_order.po_num " . $oper1 . " " . $final_ponum;
}
else
{
     $ponum_match = '';
}
/*if ( isset ( $_REQUEST['final_crnnum'] ) )
{
     $crnnum_match = $_REQUEST['final_crnnum'];
     if ( isset ( $_REQUEST['crnnum_oper'] ) ) {
          $oper1 = $_REQUEST['crnnum_oper'];
     }
     else {
         $oper2 = 'like';
     }
     if ($oper2 == 'like') {
         $final_crnnum = "'" . $_REQUEST['final_crnnum'] . "%" . "'";
     }
     else {
         $final_crnnum = "'" . $_REQUEST['final_crnnum'] . "'";
     }

     $cond2 = "so_line_items.crn_num " . $oper2 . " " . $final_crnnum;
}
else
{
     $crnnum_match = '';
} */
//echo '$cond0='.$cond0;

$cond = $cond0 . ' and ' . $wcond ;
//echo "this".$cond;
// how many rows to show per page
$rowsPerPage = 1000;

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

//echo $wcond;
// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;


// First include the class definition
include_once('classes/userClass.php');
include_once('classes/salesorderClass.php');
include_once('classes/displayClass.php');
include('classes/quoteClass.php');
include('classes/quoteliClass.php');
$newsalesorder = new salesorder;
$newdisplay = new display;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/salesorder.js"></script>
<html><head>
<title>Customer PO</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='salesorder.php?salesorder=$cname_match&salesorder_oper=$oper&sortfld1=$sort1&salesorderfl=$where1' method='post' enctype='multipart/form-data'>
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
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?> -->
<!-- </td></tr> -->
<table width=100% border=0 cellpadding=0 cellspacing=0  >
  <tr><td width="6"><img src="images/spacer.gif " width="6"></td>
	    <td bgcolor="#FFFFFF">
   <table width=100% border=0 cellpadding=6 cellspacing=0  >
      <td><span class="heading"><i>Please click on Sl. # to Edit/Delete</i></td></tr>
      <tr> <td>
      <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<td bgcolor="#F5F6F5" colspan=6><span class="heading"><b><center>Search Criteria</center></b></td>
<td rowspan=3 align="center" bgcolor="#FFFFFF">
<button class="stdbtn btn_blue" style="background-color:#0591e5" onClick="javascript: return searchsort_fields()" >Get</button>
</td>
</tr>
<tr>

<td colspan=2 bgcolor="#FFFFFF" ><span class="heading"><b>Company</b>
<?php
           $res=$newsalesorder->getcompany();
?>
<select name="cname">
<option value="select">Select</option>
<?
        $flag = 0;
	$row1=mysql_fetch_object($res);
	while($row1!=NULL)
	{
	        $name=$row1->name;
		if($_SESSION[cname]==$row1->name)
		{
			$status="selected";
		}
		else
		{
			$status="false";
		}
?>
<option value="<? echo $row1->name;?>"
<?php
                echo $status ?>>

<?

                   echo $row1->name;
?>
</option>
<?
		$row1=mysql_fetch_object($res);
          }
?>
</select></td>
<td colspan=1 align="left" bgcolor="#FFFFFF"><span class="labeltext"><span class="Heading"><strong>Part</strong></span><strong># &nbsp;
  <label>
  <input name="partnumber" type="text" id="partnumber" value="<?php echo $partnumber?>" size="20">
  </label>
</strong></td>
<td  colspan=3 align="left" bgcolor="#FFFFFF"><span class="labeltext"><span class="Heading"><strong>PRN</strong></span><strong>#
  <label>
  <input name="final_crnnum" type="text" id="final_crnnum" value="<?php echo $crnnum?>" size="20">
  </label>
</strong></td>

						<input type="hidden" name="count" value="0">
												<input type="hidden" name="sortfld1">
												<input type="hidden" name="salesorderfl">
										  <input type="hidden" name="salesorder_oper">
                                        									 	</td>

</tr>
<tr>
<td bgcolor="#FFFFFF" colspan=2><span class="labeltext"><b>Status = &nbsp;</b>
<span class="tabletext"><select name="status" size="1">
<?php
      if ($sval == 'Open')
      {
?>
	<option selected value='Open'>Open
	<option value='Pending'>Pending
	<option value='All'>All
	<option value='Closed'>Closed
    <option value='Cancelled'>Cancelled
<?php
      }
      else if ($sval == 'Closed')
      {
?>
	<option selected value='Closed'>Closed
	<option value='Open'>Open
	<option value='Pending'>Pending
	<option value='All'>All
    <option value='Cancelled'>Cancelled
<?php
      }
      else if ($sval == 'All')
      {
?>
	<option selected value='All'>All
	<option value='Open'>Open
	<option value='Pending'>Pending
	<option value='Closed'>Closed
    <option value='Cancelled'>Cancelled
<?php
      }
      else if ($sval == 'Cancelled')
      {
?>
	<option selected value='Cancelled'>Cancelled
	<option value='Open'>Open
	<option value='Pending'>Pending
	<option value='All'>All
    <option value='Closed'>Closed
<?php
      }
      else if ($sval == 'Pending')
      {
?>
	<option selected value='Pending'>Pending
	<option value='Open'>Open
	<option value='Cancelled'>Cancelled
	<option value='All'>All
    <option value='Closed'>Closed
<?php
      }
?>
</select>
</td>

<td bgcolor="#FFFFFF" colspan=3><span class="labeltext"><b>Cust PO</b>
<span class="tabletext"><select name="ponum_oper" size="1" width="25">
<?php
   if ( isset ( $_REQUEST['ponum_oper'] ) ){
          $check2 = $_REQUEST['ponum_oper'];

                   if ($check2 =='like'){
?>
    	            <option value>=
	                <option selected>like
<?php
                    }else{
?>
                    <option selected>=
	                <option value >like

 <?php
                    }
   }else{
?>
 	<option selected>like
	<option value>=
 <?PHP
  }
 ?>
</select>
<input type="text" name="final_ponum" size=10 value="<?php echo $ponum_match ?>" >
</td>
<td td bgcolor="#FFFFFF" colspan=1>&nbsp;</td>

</tr>
<td bgcolor="#FFFFFF" colspan=5>&nbsp;</td>
<td bgcolor="#FFFFFF" colspan=5><span class="pageheading">* = Po Bal(poqty-woqty+rejqty+retqty)</span><span class="pageheading" >** = Disp Bal(poqty-dispqty)</span></td>



						</table>
						</td></tr>
						<tr><td>

 <table width=100% border=0>
	<div class="contenttitle radiusbottom0">
  <h2 class="table"><span>List of Salesorder: <?php echo $_SESSION[cname];?> 
<?
  if($usertype != 'CUST')
  {
    ?>
    <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;"  onClick="location.href='new_so.php'" value="New Sales Order" ></h2></span>
 <? }?>
 
</div>  

</table>

<table  style="width:100%" border=0 cellpadding=3 cellspacing=1 class="stdtable" >
<thead>
<tr>
<th class="head0" style="width:10px" >Sl.#</th>
<!-- <th class="head1">Company Name</th> -->
<th class="head0">Cust PO</th>
<th class="head1">Status</th>
<th class="head0"><b>Order Date</b></th>
<th class="head1"><b>Part No</b></th>
<th class="head0"><b>PRN</b></th>
<th class="head1"><b>Ln</b></th>
<th class="head0"><b>PO Qty</b></th>
<th class="head1"><b>PO Amount</b></th>
<th class="head0"><b>WO No.</b></th>
<th class="head1"><b>WO<br>Qty</b></th>
<th class="head0"><b>Acc<br>Qty</b></th>
<th class="head1"><b>QA<br>Rej</b></th>
<th class="head0"><b>Cust<br>Rej</b></th>
<th class="head1"><b>Ret</b></th>
<th class="head0"><b>Po Bal*</b></th>
<th class="head1"><b>Disp<br>Qty</b></th>
<th class="head0"><b>Disp Bal**</b></th>
<th class="head1"><b>Bal Amt</b></th>
<tr>
</thead>
<!-- </table>
<div style="width:1850px; height:400; overflow:auto;border:" id="dataList">

<table style="width:1848px" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable" > -->
<?php

       if ($dept == 'Sumant')
       {
	   $result=$newsalesorder->getso4goodrich($cond);
       }
       else
       {
           $result = $newsalesorder->getSalesorders($cond);
       }




       //$result = $newsalesorder-> getso($cond,$sort1,$offset,$rowsPerPage);
       $prevnum = '';
       $prev_partnum = '';
       $c = 0;
       $tot=0;
       $totamount = 0;
       $flag = 0;
       $balqty = 0;
       $balamount = 0;
       $prev_linenum = '';
       while ($myrow = mysql_fetch_row($result))
       {


                   $balamount = 0;
           $result4dispatch = $newsalesorder->getdispatch_qty($myrow[14]);
	       $myrow4dispatch =  mysql_fetch_row($result4dispatch);
           if ($myrow4dispatch[1] == '')
           {
               $dispqty = 0;
           }
           else {

                $dispqty = $myrow4dispatch[1];
           }           
           $curr = $myrow[7] . " ";
	       $c=+1;
         if($myrow[10] != '0000-00-00' && $myrow[10] != '')
         {
           $datearr = split('-', $myrow[10]);
           $d=$datearr[2];
           $m=$datearr[1];
           $y=$datearr[0];
           $x=mktime(0,0,0,$m,$d,$y);
           $date=date("M j, Y",$x);
          }
          else
          {
            $date='';
          }


      // echo"<br>$prev_partnum++++++++++$myrow[11]-------$prev_linenum=======$myrow[23]******<br>";
          // $company_name=wordwrap($myrow[1],18,"<br/>\n",true);
		   $cust_po=wordwrap($myrow[4],15,"<br/>\n",true);
           if ($flag == 0)
           {
               $prevnum = $myrow[0];
               //$prev_partnum = $myrow[11];
               $pprice = $myrow[17];
               $balqty = $myrow[12];
			   $status = $myrow[18];
               printf('<tr bgcolor="#FFFFFF">');
               $altflag=0;
               printf('<td width="2%%" align="center"><span class="tabletext"><a href="so_review_details.php?salesorderrecnum=%s">%s</td>
                       
                       <td width="5%%" align="center"><span class="tabletext">%s</td>
					             <td width="5%%" align="center"><span class="tabletext"><b>%s</b></td>
                       <td width="5%%" align="center"><span class="tabletext">%s</td>',
                       $myrow[0],
					   $myrow[0],
					   
                       $cust_po,
		               $myrow[18],
                       $date);
           }
           if ($flag == 1)
           {
             if ($prevnum != $myrow[0])
             {
				 if ($status == 'Open')
				 {
                        $balamount =  $balqty * $pprice;
				 }
				 else {
					        $balamount = 0;
				 }
				   if ($status == 'Open')
				   {
                       printf('<td width="5%%" align="center"><span class="tabletext"><b>%s %.2f</b></td>',
                        $myrow[7],$balamount);
			        }
				    else
					 {
						  echo '<td width="5%%"></td>';
					 }

           //        $tot += $balamount;
                   if ($altflag == 1)
                   {
                     printf('</td></tr><tr bgcolor="#FFFFFF">');
                     $altflag=0;
                   }
                   else
                   {
                     printf('</td></tr><tr bgcolor="#00DDFF">');
                     $altflag=1;
                   }
                //   $prevnum = $myrow[0];
               //    $prev_partnum = $myrow[11];
                   $partnum = $myrow[11];
                   $pqty = $myrow[12];
                   $pcurr = $myrow[7];
                   $pamount = $myrow[16];
        //           $totamount += $pamount;
                   $pprice = $myrow[17];
                   $balqty = $pqty - $dispqty;
				   $status = $myrow[18];
                   printf('<td width="5%%" align="center"><span class="tabletext"><a href="so_review_details.php?salesorderrecnum=%s">%s</td>
                      
                       <td width="5%%" align="center"><span class="tabletext">%s</td>
					   <td width="5%%" align="center"><span class="tabletext"><b>%s</b></td>
                       <td width="5%%" align="center"><span class="tabletext">%s</td>',
                       $myrow[0],$myrow[0],
                       
                       $cust_po,
	                   $myrow[18],
                       $date);

              }


             else
             {
                 if ($prev_partnum != $myrow[11])
                 {
				 if ($status == 'Open')
				 {
                        $balamount =  $balqty * $pprice;
				 }
				 else {
					        $balamount = 0;
				 }
                 //   $prev_partnum = $myrow[11];
				 	if ($status == 'Open')
				   {
                       printf('<td width="5%%" align="center"><span class="tabletext"><b>%s %.2f</b></td>',
                        $myrow[7],$balamount);
			        }
					else
					 {
						  echo '<td width="5%%">&nbsp;</td>';
					 }
          //          $tot += $balamount;
                    printf('</td></tr>');
                  //  printf('<tr bgcolor="#FFFFFF">');
                   if ($altflag == 1)
                   {
                     printf('</td></tr><tr bgcolor="#00DDFF">');

                   }
                   else
                   {
                     printf('</td></tr><tr bgcolor="#FFFFFF">');

                   }
                    printf('<td width="5%%" align="center"><span class="tabletext"></td>
                       <td width="5%%" align="center"><span class="tabletext"></td>
                       <td width="5%%" align="center"><span class="tabletext"></td>
                       <td width="7%%" align="center"><span class="tabletext"></td>
					   <td width="5%%" align="center"><span class="tabletext"></td>
                     ');
                  }
                 if ($prev_partnum == $myrow[11])
                 {
                    printf('<td></td>');
                //    printf('<tr bgcolor="#FFFFFF">');
                   if ($altflag == 1)
                   {
                     printf('</td></tr><tr bgcolor="#00DDFF">');
                   }
                   else
                   {
                     printf('</td></tr><tr bgcolor="#FFFFFF">');
                   }
                    printf('<td width="5%%" align="center"><span class="tabletext"></td>
                       <td width="5%%" align="center"><span class="tabletext"></td>
                       <td width="5%%" align="center"><span class="tabletext"></td>
                       <td width="7%%" align="center"><span class="tabletext"></td>
					             <td width="5%%" align="center"><span class="tabletext"></td>
                     ');
                  }
              }
            }
            $wotype4rej=$newsalesorder->getwotype4rej($myrow[14]);
            //echo$wotype4rej."<br>";
            $cust_rejqty=0;$rejqty=0;$retqty=0;
            if($wotype4rej=='With Treatment')
            {
                $result4rejqty4treat = $newsalesorder->getrej_qty4treat($myrow[14]);
                $myrow4rejqty4treat =  mysql_fetch_row($result4rejqty4treat);
                $cust_rejqty = $myrow4rejqty4treat[2];
                $result4rejqty = $newsalesorder->getrej_qty($myrow[14]);
                $myrow4rejqty =  mysql_fetch_row($result4rejqty);
                $rejqty = $myrow4rejqty[0];
			    $retqty=$myrow4rejqty[1];
			    $cust_rejqty = $myrow4rejqty[2];
            }
            else
            {
                $result4rejqty = $newsalesorder->getrej_qty($myrow[14]);
                $myrow4rejqty =  mysql_fetch_row($result4rejqty);
                $rejqty = $myrow4rejqty[0];
			    $retqty=$myrow4rejqty[1];
			    $cust_rejqty = $myrow4rejqty[2];
            }

			// echo"<br>$prev_partnum++++++++++$myrow[11]-------$prev_linenum=======$myrow[23]******<br>";
            if ($prev_partnum!=$myrow[11] && $prev_linenum != $myrow[21])
            {

              // echo "<br>".$prev_partnum ."  " .$myrow[11]."<br>";
              // echo "<br>".$prev_linenum ."  " .$myrow[21]."<br>";
                      // echo $cust_bal."in else-----<br>";
                      $prevnum = $myrow[0];
                      $prev_partnum = $myrow[11];
                      $partnum = $myrow[11];
                      $pqty = $myrow[12];
                      $pcurr = $myrow[7];
                      $pamount = $myrow[16];
                      $totamount = $totamount + $myrow[16];
                      $pprice = $myrow[17];
                      $balqty = $myrow[12];
                      $prev_linenum=$myrow[23];



                        printf("<td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
					    <td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
						<td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\">%s %.2f</td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\">%d</td>
						<td width=5%% align=\"center\"><span class=\"tabletext\">%d</td>
						<td width=5%% align=\"center\"><span class=\"tabletext\">%d</td>
                        <td width=7%% align=\"center\"><span class=\"tabletext\">%d</td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
                        ",
                        $partnum,
						$myrow[20],
						$myrow[21],
                        $pqty,
                        $pcurr,$pamount,
                        $myrow[14],
                        $myrow[13],
                        $myrow[15],
                        $rejqty,
                        $cust_rejqty,
						$retqty,
                        $pqty-$myrow[13]+$rejqty+$retqty+$cust_rejqty,
                        $dispqty,
                        $balqty - $dispqty + $cust_rejqty
                      );
                       $cust_bal=$pqty-$myrow[13]+$rejqty+$retqty+$cust_rejqty;
             }
             else
             {
               //echo $cust_bal."<br>";
             //echo "<br>".$prevnum."in else+++++<br>";
             
               if ($prevnum != $myrow[0])
               {
                     $prevnum = $myrow[0];
                      $prev_partnum = $myrow[11];
                      $partnum = $myrow[11];
                      $pqty = $myrow[12];
                      $pcurr = $myrow[7];
                      $pamount = $myrow[16];
                      $totamount = $totamount + $myrow[16];
                      $pprice = $myrow[17];
                      $balqty = $myrow[12];
                      $prev_linenum = $myrow[23];

                    printf("<td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
					    <td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
						<td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\">%s %.2f</td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\">%d</td>
						<td width=5%% align=\"center\"><span class=\"tabletext\">%d</td>
						<td width=5%% align=\"center\"><span class=\"tabletext\">%d</td>
                        <td width=7%% align=\"center\"><span class=\"tabletext\">%d</td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
                        ",
                        $partnum,
						$myrow[22],
						$myrow[21],
                        $pqty,
                        $pcurr,$pamount,
                        $myrow[14],
                        $myrow[13],
                        $myrow[15],
                        $rejqty,
                        $cust_rejqty,
						$retqty,
                        $pqty-$myrow[13]+$rejqty+$retqty+$cust_rejqty,
                        $dispqty,
                        $balqty - $dispqty + $cust_rejqty
                      );
                      $cust_bal=$pqty-$myrow[13]+$rejqty+$retqty+$cust_rejqty;

               }

              else
             {
             //echo $cust_bal."in else****";
                 $fmt = '%s %.2f';
                 // $partnum = $myrow[11];
                 $partnum = '';
                 $pqty = $myrow[12];
                 $pcurr = $myrow[7];
                 $pamount = $myrow[16];
                 $prev_partnum = $myrow[11];
                 $prev_linenum=$myrow[23];
                 $pcurr = $myrow[7];
                 $pamount = $myrow[16];
                 if ($pamount == 0)
                 {
                   $pamount = '';
                   $pcurr = '';
                   $fmt = "%s";
                 }

                  printf("<td width=5%% align=\"center\"><span class=\"tabletext\"></td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\"></td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\"></td>
						<td width=5%% align=\"center\"><span class=\"tabletext\"></td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\">%d</td>
						<td width=5%% align=\"center\"><span class=\"tabletext\">%d</td>
						<td width=5%% align=\"center\"><span class=\"tabletext\">%d</td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\">%d</td>
                        <td width=7%% align=\"center\"><span class=\"tabletext\">%s</td>
                        <td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
						<td width=5%% align=\"center\"><span class=\"tabletext\">%s</td>
                        ",
                        $myrow[14],
                        $myrow[13],
                        $myrow[15],
                        $rejqty,
                        $cust_rejqty,
					            	$retqty,
                        $cust_bal-$myrow[13]+$rejqty+$retqty+$cust_rejqty,
                        $dispqty,
                        $balqty - $dispqty + $cust_rejqty
                      );
                       $cust_bal = $cust_bal-$myrow[13]+$rejqty+$retqty+$cust_rejqty;                      
                }
             }

                $balqty = $balqty - $dispqty + $cust_rejqty;
                $flag = 1;
		        $tot += $balamount;
        }
		$tot=floatval($tot);
        $balamount =  $balqty * $pprice;
        if ($flag != 0)
        {
        printf('<td width=5%% align="right"><span class="tabletext"><b>%s %.2f</b></td>',$pcurr,$balamount);
        }
        $totamount=floatval($totamount);
        $tot += $balamount;
        printf('</td></tr>');
if($c!=0)
{
?>
<tr bgcolor="#FFFFFF">
<td align="center" colspan=7><span class="tabletext">&nbsp</td>
<td align="left"><span class="tabletext"><strong><b>Total </strong><b></td>
<td align="right"><span class="tabletext"><strong><?php echo "$pcurr ";printf('%.2f',$totamount)?><b></strong></td>
<td align="center" colspan=9><span class="tabletext">&nbsp</td>
<td align="right"><span class="tabletext"><strong><?php echo "$pcurr ";printf('%.2f',$tot)?><b></strong></td>
</tr>
<?php
}
?>
</table>
           </table>
         <td width="6"><img src="images/spacer.gif " width="6"></td>
      </tr>
                

        </table>
<table border = 0 cellpadding=0 cellspacing=0 width=100%>
              <tr>
                <td align="left">

<?php

//Additions on Dec 29 04 by Jerry George to implement pagination

//$numrows = $newsalesorder->getsoCount($cond,$offset,$rowsPerPage);
// how many pages we have when using paging?
$numrows=8;
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
    $prev = " <a href=\"salesorder.php?page=$page&totpages=$totpages&salesorder=$cname_match&salesorder_oper=$oper\">[Prev]</a> ";

    $first = " <a href=\"salesorder.php?page=1&totpages=$totpages&salesorder=$cname_match&salesorder_oper=$oper\">[First Page]</a> ";
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
    $next = " <a href=\"salesorder.php?page=$page&totpages=$totpages&salesorder=$cname_match&salesorder_oper=$oper\">[Next]</a> ";

    $last = " <a href=\"salesorder.php?page=$totpages&totpages=$totpages&salesorder=$cname_match&salesorder_oper=$oper\">[Last Page]</a> ";
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
      </FORM>
</body>
</html>
