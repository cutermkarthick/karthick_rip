<?php
//==============================================
// Author: FSI                                 =
// Date-written = Apr 30, 2010                 =
// Filename: assyReviewSummary.php             =
// Copyright of Fluent Technologies            =
// Revision: v1.0 WMS                          =
// Displays list of Dispatchs.                 =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'assyReviewSummary4View';
//////session_register('pagename');

//////session_register('pagename');

// First include the class definition
include_once('classes/userClass.php');
include('classes/assyReviewClass.php');
include_once('classes/displayClass.php');
include_once('classes/salesorderClass.php');
$newsalesorder = new salesorder;
$newassyReview = new assyReview;
$newdisplay = new display;

$cond0 = " cust_ponum like '%'";
$cond1 =  "(to_days(po_date)-to_days('1582-01-01') > 0 ||
                   po_date = '0000-00-00' ||
                   po_date = 'NULL' ) and
           (to_days(po_date)-to_days('2050-12-31') < 0 ||
                    po_date = '0000-00-00' ||
                    po_date = 'NULL')";

$cond = $cond0 . ' and ' . $cond1;

if ( isset ( $_REQUEST['final_cust_po'] ) )
{
    $finalcust_po_match = $_REQUEST['final_cust_po'];
    $final_cust_po = "'" . $_REQUEST['final_cust_po'] . "%" . "'";
    $cond0 = "cust_ponum like " . $final_cust_po;
}
else {
     $finalcust_po_match = '';
}



if ( isset ( $_REQUEST['ddate1'] ) || isset ( $_REQUEST['ddate2'] ) )
{
     $ddate1_match = $_REQUEST['ddate1'];
     $ddate2_match = $_REQUEST['ddate2'];
     if ( isset ( $_REQUEST['ddate1']) &&  $_REQUEST['ddate1'] != '' )
     {
          $date1 = $_REQUEST['ddate1'];
          $cond21 = "to_days(po_date) " . ">= to_days('" . $date1 . "')";
     }
     else
     {
          $cond21 = "(to_days(po_date)-to_days('1582-01-01') > 0 || po_date = 'NULL' || po_date = '0000-00-00')";
     }

     if ( isset ( $_REQUEST['ddate2'] )  &&  $_REQUEST['ddate2'] != '')
     {
          $date2 = $_REQUEST['ddate2'];
          $cond22 = "to_days(po_date) " . "<= to_days('" . $date2 . "')";
     }
     else
     {
          $cond22 = "(to_days(po_date)-to_days('2050-12-31') < 0 || po_date = 'NULL' || po_date = '0000-00-00')";
     }
     $cond1 = $cond21 . ' and ' . $cond22;
}
else
{
     $ddate1_match = '';
     $ddate2_match = '';
}



$cond = $cond0 . ' and ' . $cond1;
//echo $cond;

$userrole = $_SESSION['userrole'];

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
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/assy_review.js"></script>

<html>
<head>
<title>Assembly Reiew Summary</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='assyReviewSummary4View.php' method='post' enctype='multipart/form-data'>
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
          <tr><td><span class="heading"><i>Please click on the Assy Review # link for Details and Edit</i></td></tr>
		</tr>
  <tr>
<td>

<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
  <tr>
	<td bgcolor="#F5F6F5" colspan="13"><span class="heading"><b><center>Search Criteria</center></b></td>
    <td bgcolor="#FFFFFF" rowspan=3 align="center">
	<input type= "image" name="submit" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields()">


<input type="hidden" name="rel_oper">
<input type="hidden" name="wo_oper">
	</td>
  </tr>
<tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Assembly Review# &nbsp;
</b>
<input type="text" name="final_cust_po" size=15 value="<?php echo $finalcust_po_match ?>" onkeypress="javascript: return checkenter(event)">
</td>

<td colspan=12 bgcolor="#FFFFFF"><span class="labeltext"><b>PO Date:  From &nbsp&nbsp</b>
        <input type="text" name="ddate1" id="ddate1" size=10 value="<?php echo $ddate1_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("ddate1")'>
         <span class="labeltext"><b>&nbsp;&nbsp;To</b>
        <input type="text" name="ddate2" id="ddate2"  size=10 value="<?php echo $ddate2_match ?>"
         onkeypress="javascript: return checkenter(event)">
        <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("ddate2")'>
</td>
</tr>

</table>
<tr><td>
<table width=100% border=0>
<tr>
<td><span class="pageheading"><b>List of Contract Review</b></td>

  <!--<td align="right"><a href ="assyReviewNew.php"><img name="Image8" border="0" src="images/new.gif"></a>
  </td> -->
  </tr>
</table>


<table style="table-layout: fixed" width=1540px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr  bgcolor="#FFCC00">
            <td align="center" bgcolor="#EEEFEE" width=28px><span class="tabletext"><b>Sl.#</b></td>
            <td align="center" bgcolor="#EEEFEE" width=125px><span class="tabletext"><b>Company Name</b></td>
            <td align="center" bgcolor="#EEEFEE" width=110px><span class="tabletext"><b>Cust PO</b></td>
		    <td align="center" bgcolor="#EEEFEE" width=75px><span class="tabletext"><b>Status</b></td>
		    <td align="center" bgcolor="#EEEFEE" width=30px><span class="tabletext"><b>Eng<br>App</b></td>
            <td align="center" bgcolor="#EEEFEE" width=30px><span class="tabletext"><b>QA<br>App</b></td>
            <td align="center" bgcolor="#EEEFEE" width=98px><span class="tabletext"><b>Order Date</b></td>
            <td align="center" bgcolor="#EEEFEE" width=160px><span class="tabletext"><b>Assy<br>Part No</b></td>
			<td align="center" bgcolor="#EEEFEE" width=70px><span class="tabletext"><b>PRN</b></td>
			<td align="center" bgcolor="#EEEFEE" width=30px><span class="tabletext"><b>Ln</b></td>
            <td align="center" bgcolor="#EEEFEE" width=70px><span class="tabletext"><b>PO Qty</b></td>
            <!--<td align="center" bgcolor="#EEEFEE" width=102px><span class="tabletext"><b>PO Amount</b></td>-->
            <td align="center" bgcolor="#EEEFEE" width=80px><span class="tabletext"><b>WO No.</b></td>
            <td align="center" bgcolor="#EEEFEE" width=70px><span class="tabletext"><b>WO<br>Qty</b></td>
            <td align="center" bgcolor="#EEEFEE" width=70px><span class="tabletext"><b>Acc<br>Qty</b></td>
            <td align="center" bgcolor="#EEEFEE" width=70px><span class="tabletext"><b>QA<br>Rej</b></td>
            <td align="center" bgcolor="#EEEFEE" width=70px><span class="tabletext"><b>Cust<br>Rej</b></td>
		    <td align="center" bgcolor="#EEEFEE" width=70px><span class="tabletext"><b>Ret</b></td>
            <td align="center" bgcolor="#EEEFEE" width=150px><span class="tabletext"><b>Bal Qty<br>(Pre Dispatch)</b></td>
            <td align="center" bgcolor="#EEEFEE" width=70px><span class="tabletext"><b>Disp<br>Qty</b></td>
            <td align="center" bgcolor="#EEEFEE" width=70px><span class="tabletext"><b>Bal Qty</b></td>
            <!--<td align="center" bgcolor="#EEEFEE" width=115px><span class="tabletext"><b>Bal Amt</b></td> -->
</table>
<div style="width:1588px; height:400; overflow:auto;border:" id="dataList">

<table style="table-layout: fixed" width=1540px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<?php


           $result = $newassyReview->getassyReviewSummary($cond);

       //$result = $newsalesorder-> getso($cond,$sort1,$offset,$rowsPerPage);
       $prevnum = '#';
       $prev_partnum = '';
       $c = 0;
       $tot=0;
       $totamount = 0;
       $flag = 0;
       $balqty = 0;
       $balamount = 0;
       $prev_linenum = '';   $balpqty ="";    $preln='#'; $b_pqty=""; $b_dqty=0;  $preln4amt='#'; $b_amtqty=0;
       $disp_qty="";
       while ($myrow = mysql_fetch_row($result))
       {
           $balamount = 0;
           	$assycrn = substr($myrow[21],2,2);
           	if($assycrn =='A-')
           	{
           $result4dispatch = $newsalesorder->getdispatch_qty($myrow[14]);
	       $myrow4dispatch =  mysql_fetch_row($result4dispatch);
           if ($myrow4dispatch[1] == '')
           {
               $dispqty = 0;
           }
           else {

                $dispqty = $myrow4dispatch[1];
           }
           }
           //echo $myrow[13]."****----------*********";
           $curr = $myrow[7] . " ";
	       $c=+1;
	       if($myrow[3] !='0000-00-00' && $myrow[3] !='')
	       {
	         $datearr = split('-', $myrow[3]);
             $d=$datearr[2];
             $m=$datearr[1];
             $y=$datearr[0];
             $x=mktime(0,0,0,$m,$d,$y);
             $date=date("M j, Y",$x);
	       }else
	       {
	          $date='';
	       }

           $company_name=wordwrap($myrow[1],18,"<br/>\n",true);
          // echo $flag."===glg<br>";
           if ($flag == 0)
           {
               $prevnum = $myrow[0];
               //$prev_partnum = $myrow[11];

               $pprice = $myrow[17];
               //echo $pprice."--22--".$myrow[12]."<br>";
               $balqty = $myrow[12];
			   $status = $myrow[18];
               printf('<tr bgcolor="#FFFFFF">');
               $altflag=0;

              /* if ($status == 'Open')
				   {
                       printf('<td width=115px align="right"><span class="tabletext"><b>%s %.2f</b></td>',
                        $myrow[7],$balamount);
			        }
				    else
					 {
						  echo '<td width=115px></td>';
					 }   */

           //        $tot += $balamount;
                  /* if ($altflag == 1)
                   {
                     printf('</td></tr><tr bgcolor="#FFFFFF">');
                     $altflag=0;
                   }
                   else
                   {
                     printf('</td></tr><tr bgcolor="#00DDFF">');
                     $altflag=1;
                   }  */
               printf('<td width=28px align="center"><span class="tabletext"><a href="assyReviewDetails4View.php?recnum=%s">%s</td>
                       <td width=125px align="center"><span class="tabletext">%s</td>
                       <td width=110px align="center"><span class="tabletext">%s</td>
					   <td width=75px align="center"><span class="tabletext">%s</td>
					   <td width=30px align="center"><span class="tabletext">%s</td>
					   <td width=30px align="center"><span class="tabletext">%s</td>
                       <td width=98px align="left"><span class="tabletext">%s</td>',
                       $myrow[0],
					   $myrow[0],
					   $company_name,
                       $myrow[4],
                 $myrow[18],
                 $myrow[28],
                 $myrow[27],
                       $date);

           }
           if ($flag == 1)
           {  // echo $prevnum."--33-".$myrow[0]."<br>";
             if ($prevnum != $myrow[0])
             {
				 /*if ($status == 'Open')
				 {    //echo $pprice ."===-111--====". $myrow[17]."=====$balqty<br>";
				     $ln_arr=split('-',$myrow[22]);

                     if($ln_arr[1]=='')
                     {   //echo $balqty."---==in loop1-----$pprice<br>";
                        $balamount =   $balqty * $pprice;
                     }


     			 }
				 else {
					        $balamount = 0;
				 }
				   if ($status == 'Open')
				   {
                       printf('<td width=115px align="right"><span class="tabletext"><b>%s %.2f</b></td>',
                        $myrow[7],$balamount);
			        }
				    else
					 {
						  echo '<td width=115px></td>';
					 }  */

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
                   $pcurr = '$';
                   $pamount = $myrow[16];
        //           $totamount += $pamount;
                   $pprice = $myrow[17];
                   $balqty = $pqty - $dispqty;
				   $status = $myrow[18];
                   printf('<td width=28px align="center"><span class="tabletext"><a href="assyReviewDetails4View.php?recnum=%s">%s</td>
                       <td width=125px align="center"><span class="tabletext">%s</td>
                       <td width=110px align="center"><span class="tabletext">%s</td>
					   <td width=75px align="center"><span class="tabletext">%s</td>
					   <td width=30px align="center"><span class="tabletext">%s</td>
					   <td width=30px align="center"><span class="tabletext">%s</td>
                       <td width=98px align="left"><span class="tabletext">%s</td>',
                       $myrow[0],$myrow[0],
                       $company_name,
                       $myrow[4],
	                   $myrow[18],
	                   $myrow[28],
	                   $myrow[27],
                       $date);

              }


             else
             {     // echo $prev_partnum."===-====".$myrow[11]."<br>";
                 if ($prev_partnum != $myrow[11] )
                 {
				/* if ($status == 'Open')
				 {      //echo"$myrow[22]===HERE---<br>";
				 $lnArr=split('-',$myrow[22]);
                     if($lnArr[1]=='')
                     {

                        if($lnArr[1]=='')
                     {   //echo $preln4amt."----lnp---$lnArr[0]<br>";
                       if($lnArr[0]==$preln4amt)
                       { //echo $b_pqty."---in id---";
                         $balqty4amt=$b_amtqty- $dispqty;
                          //echo $balqty4amt."---==in loop2-----$b_amtqty<br>";
                         $balamount =   $balqty4amt * $myrow[17] ;
                       }else
                       { $preln4amt=$myrow[22];
                         $balqty4amt=$myrow[12] - $dispqty;
                         $b_amtqty=$myrow[12] - $dispqty;
                         //echo $balqty4amt."---==in loop2-----$pqty<br>";
                         $balamount =   $balqty4amt * $myrow[17] ;
                       }


                     }

                     }


				 }
				 else {
					        $balamount = 0;
				 }
                 //   $prev_partnum = $myrow[11];
				 	if ($status == 'Open')
				   {
                       printf('<td width=115px align="right"><span class="tabletext"><b>%s %.2f</b></td>',
                        $myrow[7],$balamount);
			        }
					else
					 {
						  echo '<td width=115px></td>';
					 } */
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
                    printf('<td width=28px align="center"><span class="tabletext"></td>
                       <td width=125px align="center"><span class="tabletext"></td>
                       <td width=110px align="center"><span class="tabletext"></td>
                       <td width=75px align="left"><span class="tabletext"></td>
                       <td width=30px align="center"><span class="tabletext"></td>
					   <td width=30px align="center"><span class="tabletext"></td>
					   <td width=98px align="left"><span class="tabletext"></td>
                     ');
                  }
                 if ($prev_partnum == $myrow[11])
                 {

                 /* if ($status == 'Open')
				 {      //echo"$myrow[22]===HERE---<br>";
				 $lnArr=split('-',$myrow[22]);
                     if($lnArr[1]=='')
                     {

                        if($lnArr[1]=='')
                     {  // echo $preln4amt."----lnp4---$lnArr[0]<br>";
                       if($lnArr[0]==$preln4amt)
                       { //echo $b_pqty."---in id---";
                         $balqty4amt=$b_amtqty- $dispqty;
                          //echo $balqty4amt."---==in loop4-----$b_amtqty<br>";
                         $balamount =   $balqty4amt * $myrow[17] ;
                       }else
                       { $preln4amt=$myrow[22];
                         $balqty4amt=$myrow[12] - $dispqty;
                         $b_amtqty=$myrow[12] - $dispqty;
                         //echo $balqty4amt."---==in loop3-----$pqty<br>";
                         $balamount =   $balqty4amt * $myrow[17] ;
                       }


                     }

                     }


				 }
				 else {
					        $balamount = 0;
				 } */
                      //echo"$lnArr[1]---$balamount <br>";
                //    printf('<tr bgcolor="#FFFFFF">');

                   if ($altflag == 1)
                   {
                     printf('</td></tr><tr bgcolor="#00DDFF">');
                   }
                   else
                   {
                     printf('</td></tr><tr bgcolor="#FFFFFF">');
                   }
                    printf('<td width=28px align="center"><span class="tabletext"></td>
                       <td width=125px align="center"><span class="tabletext"></td>
                       <td width=110px align="center"><span class="tabletext"></td>
                       <td width=75px align="left"><span class="tabletext"></td>
                       <td width=30px align="center"><span class="tabletext"></td>
					   <td width=30px align="center"><span class="tabletext"></td>
					   <td width=98px align="left"><span class="tabletext"></td>
                     ');
                  }
              }
            }
                  //$wotype4rej=$newsalesorder->getwotype4rej($myrow[14]);
            //echo$wotype4rej."<br>";
                  $cust_rejqty=0;$rejqty=0;$retqty=0;
                  $result4assyrejqty = $newassyReview->getrej_qty4assy($myrow[14]);
                  $myrow4assyrejqty =  mysql_fetch_row($result4assyrejqty);
                  $rejqty = $myrow4assyrejqty[0];
                  $retqty=$myrow4assyrejqty[1];

                //echo $rejqty."------";

			    $cust_rejqty = $myrow4rejqty[2];


			//echo"$prev_partnum++++++++++$myrow[11]-------$prev_linenum=======$myrow[23]******";
            if ($prev_partnum!=$myrow[11] || $prev_linenum != $myrow[22])
            {
           // echo $myrow[21]."in else-----".$myrow[22];
                     $lnarr=split('-',$myrow[22]);
                     //if($lnarr[1]=='')
                     //{
                      $prevnum = $myrow[0];
                      $prev_partnum = $myrow[11];
                      $partnum = $myrow[11];
                      $pqty = $myrow[12];
                      $pcurr = '$';
                      $pamount = $myrow[16];
                      $totamount = $totamount + $myrow[16];
                      $pprice = $myrow[17];
                      $balqty = $myrow[12];
                      $prev_linenum=$myrow[22];
                      $lnarr=split('-',$myrow[22]);
                     if($lnarr[1]=='')
                     {  // echo $preln."----lnp---<br>";
                       if($lnarr[0]==$preln)
                       { //echo $b_pqty."---in id---";
                         $balpqty=$b_pqty-$myrow[13]+$rejqty+$retqty+$cust_rejqty;
                         $balQty_disp=$b_dqty - $dispqty + $cust_rejqty ;
                         $disp_qty=$dispqty;
                       }else
                       { $preln=$myrow[22];
                         $balpqty=$pqty-$myrow[13]+$rejqty+$retqty+$cust_rejqty;
                         $b_pqty=$pqty-$myrow[13]+$rejqty+$retqty+$cust_rejqty;
                         $balQty_disp=$balqty - $dispqty + $cust_rejqty ;
                         $b_dqty=$balqty - $dispqty + $cust_rejqty ;
                         $disp_qty=$dispqty;
                       }


                     }else
                     {
                      $balQty_disp="";
                      $balpqty="";
                      $disp_qty="";

                     }

                        printf("<td width=160px align=\"left\"><span class=\"tabletext\">%s</td>
					    <td width=70px align=\"left\"><span class=\"tabletext\">%s</td>
                        <td width=30px align=\"left\"><span class=\"tabletext\">%s</td>
						<td width=70px align=\"left\"><span class=\"tabletext\">%s</td>

                        <td width=80px align=\"left\"><span class=\"tabletext\">%s</td>
                        <td width=70px align=\"left\"><span class=\"tabletext\">%s</td>
                        <td width=70px align=\"left\"><span class=\"tabletext\">%s</td>
                        <td width=70px align=\"left\"><span class=\"tabletext\">%d</td>
						<td width=70px align=\"left\"><span class=\"tabletext\">%d</td>
						<td width=70px align=\"left\"><span class=\"tabletext\">%d</td>
                        <td width=150px align=\"left\"><span class=\"tabletext\">%s</td>
                        <td width=70px align=\"left\"><span class=\"tabletext\">%s</td>
                        <td width=70px align=\"left\"><span class=\"tabletext\">%s</td>
                        ",
                        $partnum,
						wordwrap($myrow[21],8,"<br>\n",true),
						$myrow[22],
                        $pqty,

                        $myrow[14],
                        $myrow[13],
                        $myrow[15],
                        $rejqty,
                        $cust_rejqty,
						$retqty,
                        $balpqty,
                        $disp_qty,
                        $balQty_disp
                      );


                       $cust_bal=$pqty-$myrow[13]+$rejqty+$retqty+$cust_rejqty;
                      // echo $balpqty."===1bal===<br>"       ;

                    if ($status == 'Open')
				 {      //echo"$myrow[22]===HERE---<br>";
				     $lnArr=split('-',$myrow[22]);
                     if($lnArr[1]=='')
                     {

                        if($lnArr[1]=='')
                     {   //echo $preln4amt."----lnp---$lnArr[0]<br>";
                       if($lnArr[0]==$preln4amt)
                       { //echo $b_pqty."---in id---";
                         $balqty4amt=$b_amtqty- $dispqty;
                          //echo $balqty4amt."---==in loop2-----$b_amtqty<br>";
                         $balamount =   $balqty4amt * $myrow[17] ;
                       }else
                       { $preln4amt=$myrow[22];
                         $balqty4amt=$myrow[12] - $dispqty;
                         $b_amtqty=$myrow[12] - $dispqty;
                         //echo $balqty4amt."---==in loop2-----$pqty<br>";
                         $balamount =   $balqty4amt * $myrow[17] ;
                       }


                     }

                     }


				 }
				 else {
					        $balamount = 0;
				 }

               /*  if($flag==0)
				 {
				    if($altflag==0)
				    {
				      $color="#FFFFFF" ;
				    }else
				    {

				     $color="#00DDFF" ;
				    }
				    if($lnArr[1]=='')
				 {
                   	if ($status == 'Open' && $lnArr[0]==$preln4amt)
				   {
                       printf('<td width=115px align="right"><span class="tabletext"><b>%s %.2f</b></td>',
                        $myrow[7],$balamount);
                        //echo "<td bgcolor='$color' width=115px></td>";
			        }
					else
					 {
						  echo "<td bgcolor='$color' width=115px></td>";
					 }
			   } else
			   {
			       echo "<td bgcolor='$color' width=115px></td>";

			   }

				 }
                 else
				 {
				   // echo $flag."<br>";
				   if($altflag==0)
				    {
				      $color="#FFFFFF" ;
				    }else
				    {

				     $color="#00DDFF" ;
				    }
				    //if($prevnum != $myrow[0])
				    //{

				    //}
                    if($lnArr[1]=='')
				    {
                   	  if ($status == 'Open' && $lnArr[0]==$preln4amt)
				      {
                       printf('<td width=115px align="right"><span class="tabletext"><b>%s %.2f</b></td>',
                        $myrow[7],$balamount);
			          }
					  else
					   {
						  echo "<td bgcolor='$color' width=115px></td>";
					   }
			       } else
			        {
			             echo "<td bgcolor='$color' width=115px></td>";

			         }

				 }  */


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
                      $pcurr = '$';
                      $pamount = $myrow[16];
                      $totamount = $totamount + $myrow[16];
                      $pprice = $myrow[17];
                      $balqty = $myrow[12];
                      $prev_linenum = $myrow[22];



                    printf("<td width=160px align=\"left\"><span class=\"tabletext\">%s</td>
					    <td width=70px align=\"left\"><span class=\"tabletext\">%s</td>
						<td width=30px align=\"left\"><span class=\"tabletext\">%s</td>
                        <td width=70px align=\"left\"><span class=\"tabletext\">%s</td>

                        <td width=80px align=\"left\"><span class=\"tabletext\">%s</td>
                        <td width=70px align=\"left\"><span class=\"tabletext\">%s</td>
                        <td width=70px align=\"left\"><span class=\"tabletext\">%s</td>
                        <td width=70px align=\"left\"><span class=\"tabletext\">%d</td>
						<td width=70px align=\"left\"><span class=\"tabletext\">%d</td>
						<td width=70px align=\"left\"><span class=\"tabletext\">%d</td>
                        <td width=150px align=\"left\"><span class=\"tabletext\">%d</td>
                        <td width=70px align=\"left\"><span class=\"tabletext\">%s</td>
                        <td width=70px align=\"left\"><span class=\"tabletext\">%s</td>
                        ",
                        $partnum,
      	                wordwrap($myrow[21],8,"<br>\n",true),
						$myrow[22],
                        $pqty,

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
                     //echo $cust_bal."===2===<br>"       ;
               }

              else
             {
                      if($lnarr[1]=='')
                     {
                        $balpqty=$cust_bal-$myrow[13]+$rejqty+$retqty+$cust_rejqty;
                        $balQty_disp=$balpqty - $dispqty + $cust_rejqty ;
                        //echo $cust_bal."----==---1----";
                     }else
                     {
                      $balQty_disp="";
                      $balpqty="";
                     }
                 //if($lnarr[1]=='')
                // {
                 $fmt = '%s %.2f';
                 // $partnum = $myrow[11];
                 $partnum = '';
                 $pqty = $myrow[12];
                 $pcurr = '$';
                 $pamount = $myrow[16];
                 $prev_partnum = $myrow[11];
                 $prev_linenum=$myrow[22];
                 $pcurr = '$';
                 $pamount = $myrow[16];
                 if ($pamount == 0)
                 { //echo "H---E---R---E";
                   $pamount = '';
                   $pcurr = '';
                   $fmt = "%s";
                 }

                  printf("<td width=160px align=\"left\"><span class=\"tabletext\"></td>
				        <td width=70px align=\"left\"><span class=\"tabletext\"></td>
                        <td width=30px align=\"left\"><span class=\"tabletext\"></td>
                        <td width=70px align=\"left\"><span class=\"tabletext\"></td>

                        <td width=80px align=\"left\"><span class=\"tabletext\">%s</td>
                        <td width=70px align=\"left\"><span class=\"tabletext\">%s</td>
                        <td width=70px align=\"left\"><span class=\"tabletext\">%d</td>
						<td width=70px align=\"left\"><span class=\"tabletext\">%d</td>
						<td width=70px align=\"left\"><span class=\"tabletext\">%d</td>
                        <td width=70px align=\"left\"><span class=\"tabletext\">%d</td>
                        <td width=150px align=\"left\"><span class=\"tabletext\">%s</td>
                        <td width=70px align=\"left\"><span class=\"tabletext\">%s</td>
						<td width=70px align=\"left\"><span class=\"tabletext\">%s</td>
                        ",

                        $myrow[14],
                        $myrow[13],
                        $myrow[15],
                        $rejqty,
                        $cust_rejqty,
						$retqty,
                        $balpqty,
                        $disp_qty,
                        $balQty_disp
                      );

                         //echo $cust_bal."----==---222----";
                       $cust_bal = $cust_bal-$myrow[13]+$rejqty+$retqty+$cust_rejqty;

                       //echo $balamount."===3===<br>"       ;
                       //echo "<br>".$cust_bal."last--";

                }

             }

                $balqty = $balqty - $dispqty + $cust_rejqty;
                $flag = 1;
		        $tot += $balamount;
        }
		$tot=floatval($tot);
		//echo $pprice."p-r--i--c--e".$balqty."<br>";
        $balamount =  $balqty * $pprice;
        //echo $balamount."--**---<br>";

        if ($flag != 0)
        {      //echo"HERE----";
        printf('<td width=110px align="right"><span class="tabletext"><b>%s %.2f</b></td>',
                   $pcurr,$balamount);
        }
        $totamount=floatval($totamount);
        $tot += $balamount;
        printf('</td></tr>');
//if($c!=0)
//{
?>
<!--<tr bgcolor="#FFFFFF">
<td align="center" colspan=8><span class="tabletext">&nbsp</td>
<td align="left"><span class="tabletext"><strong><b>Total </strong><b></td>
<td align="right"><span class="tabletext"><strong><?php //echo "$pcurr ";printf('%.2f',$totamount)?><b></strong></td>
<td align="center" colspan=9><span class="tabletext">&nbsp</td>
<td align="right"><span class="tabletext"><strong><?php //echo "$pcurr ";printf('%.2f',$tot)?><b></strong></td>
</tr>  -->
<?php
//}
?>
</table>
      </table>
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

<?php

//Additions on Dec 29 04 by Jerry George to implement pagination

//$numrows = $newassyReview->getassyReviewSummaryCount($cond,$offset,$rowsPerPage);
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
    $prev = " <a href=\"assyReviewSummary4View.php?page=$page&totpages=$totpages&final_cust_po=$finalcust_po_match&ddate1=$ddate1_match&ddate2=$ddate2_match\">[Prev]</a> ";

    $first = " <a href=\"assyReviewSummary4View.php?page=1&totpages=$totpages&final_cust_po=$finalcust_po_match&ddate1=$ddate1_match&ddate2=$ddate2_match\">[First Page]</a> ";
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
    $next = " <a href=\"assyReviewSummary4View.php?page=$page&totpages=$totpages&final_cust_po=$finalcust_po_match&ddate1=$ddate1_match&ddate2=$ddate2_match\">[Next]</a> ";

    $last = " <a href=\"assyReviewSummary4View.php?page=$totpages&totpages=$totpages&final_cust_po=$finalcust_po_match&ddate1=$ddate1_match&ddate2=$ddate2_match\">[Last Page]</a> ";
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
