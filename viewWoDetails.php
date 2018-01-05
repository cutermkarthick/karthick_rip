<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2005                 =
// Filename: woDetails.php                     =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Workorder details                           =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
// Includes
include_once('classes/loginClass.php');
include('classes/workorderClass.php');
include('classes/displayClass.php');
include('classes/datesClass.php');
include('classes/approvalClass.php');
include('classes/workflowClass.php');
include('classes/operatorClass.php');

        include('classes/inClass.php');
	    include('classes/fidClass.php');
        include('classes/irmClass.php');
        include('classes/siClass.php');
        include('classes/masterdataClass.php');
        include('classes/ddClass.php');
        include('classes/mmClass.php');

        $newfid = new fid;
        $newirm = new irm;
        $newsi = new stage_insp;
        $newMD = new masterdata;
        $newdd = new dd;
        $newmm = new mm;
        $newpo = new operator;
	    $newin = new in;


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

if ( !isset ( $_REQUEST['dept'] ) )
{
      $dept='';
}
else

    $dept=$_REQUEST['dept'];


if (isset($_REQUEST['position']))
{
    $position=$_REQUEST['position'];
}
else {
    $position='';
}

$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'viewWoDetails';
//////session_register('pagename');
$userrole = $_SESSION['userrole'];
$dept = $_SESSION['department'];
//echo '<br>dept is' . $dept . '<br>';

$newlogin = new userlogin;
$newlogin->dbconnect();
$newwo = new workOrder;
$newapproval = new approval;
$newdisplay = new display;

//echo "worecnum:$worecnum<br>";
$result = $newwo->getGenInfo($worecnum);
$myrow = mysql_fetch_row($result);
$result = $newwo->getAddrInfo($worecnum);
$myaddr = mysql_fetch_row($result);
$result = $newwo->getwoDetails2($wotype,$myrow[6]);
//$myWo = mysql_fetch_row($result);
$result = $newwo->getParts($typenum);
$myParts = mysql_fetch_row($result);
$newDates = new dates;

$timeline = $newDates->getdates('WO', $worecnum,$wotype);
$result1 = $newwo->attachments($worecnum);
$myrow1 = mysql_fetch_assoc($result1);
$months=array( 'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec' );

?>
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/woentry.js"></script>
<script language="javascript" src="scripts/wo.js"></script>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title><?php echo $wotype?> WO</title>
</head>

       <?php
            if ( $position=='bottom')
            {
            ?>
            <body leftmargin="0"topmargin="0" marginwidth="0" onLoad="javascript:doscroll();">
       <?php
            }
       ?>


<body leftmargin="0"topmargin="0" marginwidth="0">

<FORM ACTION = "processNotes4milestone.php" METHOD = "POST" enctype='multipart/form-data'>

<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;
<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>

<?php
         $newdisplay->dispLinks('');
         //$newwo->UpdNotes($worecnum,$typenum,$wotype,$wonum);
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
             <img src="images/bu-print.gif" alt="Print BoardWO" onClick="javascript: printwoDetails()">
        </td>
    </tr>
<!--  <td align="left"><span class="pageheading"><b>Downloads :  <a href="wodetailsxml.php">XML</a> </b></td>-->
    </tr>
    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<?php

$newlogin = new userlogin;
$newlogin->dbconnect();
$newwo = new workOrder;

$result = $newwo->getGenInfo($worecnum);
$myrow = mysql_fetch_row($result);
$result = $newwo->getAddrInfo($worecnum);
$myaddr = mysql_fetch_row($result);

      if($myrow[19] != '0000-00-00' && $myrow[19] != '' && $myrow[19] != 'NULL')
      {
              $datearr = split('-', $myrow[19]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
       $x=mktime(0,0,0,$m,$d,$y);
       $date1=date("M j, Y",$x);
      }
      else
      {
        $date1 = '';
      }
      if($myrow[4] != '0000-00-00' && $myrow[4] != '' && $myrow[4] != 'NULL')
      {
              $datearr = split('-', $myrow[4]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
       $x=mktime(0,0,0,$m,$d,$y);
       $date2=date("M j, Y",$x);
      }
      else
      {
        $date2 = '';
      }
//echo "i am here";
        $html ='';
		$remark = wordwrap($myrow[33],90,"\n");
	        echo  "<tr bgcolor=\"#DDDEDD\"><td colspan=6><span class=\"heading\"><center><b>General Information</b></center></td></tr>
                      <tr bgcolor=\"#FFFFFF\"><td width=25%><span class=\"tabletext\"><b>Customer</b></td>
                          <td  width=25%><span class=\"tabletext\">$myrow[2]</td>
                          <td colspan=2 width=25%><span class=\"tabletext\"><b>Work Order</b></td>
                          <td colspan=2 width=25%><span class=\"tabletext\"><b>";

                printf("%05d",$myrow[0]);
				if($myrow[38] > 0)
				{
					$woqty = $myrow[38];
                    $amndqty = $myrow[27];
				}
                if($myrow[38]  == 0 || $myrow[38] == 'null' || $myrow[38] == '')
				{
					$woqty = $myrow[27];
                    $amndqty = 0;
				}
            if($myrow[36] != '0000-00-00' && $myrow[36] != '' && $myrow[36] != 'NULL')
            {
				 $datearr1 = split('-', $myrow[36]);
				 $month=$datearr1[1];
				 $year=$datearr1[0];
				 $day=$datearr1[2];
				 $amenddate=$months[$month-1].' '.$day.','.$year;
            }

                echo "</b></td></tr>

	                  <tr bgcolor=\"#FFFFFF\">
                          <td><span class=\"tabletext\"><b>Cust PO#</b></td>
                          <td><span class=\"tabletext\">$myrow[3]</td>
                          <td colspan=2><span class=\"tabletext\"><b>Work Order Date</b></td>
                          <td colspan=2><span class=\"tabletext\">$date1</td>
                      </tr>

                      <tr  bgcolor=\"#FFFFFF\">

					  <td><span class=\"tabletext\"><b>Customer PO date</b></td>
                          <td><span class=\"tabletext\">$date2</td>
					<td colspan=2><span class=\"tabletext\"><b>Work Order Qty</b></td>
                          <td colspan=2><span class=\"tabletext\">$woqty</td>
                      </tr>

                      <tr  bgcolor=\"#FFFFFF\">
                          <td><span class=\"tabletext\"><b>Customer PO Qty</b></td>
                          <td><span class=\"tabletext\">$myrow[28]</td>
                          <td colspan=2><span class=\"tabletext\"><b>Treatment</b></td>
                          <td colspan=2><span class=\"tabletext\">$myrow[40]</td>
                      </tr>
                      <tr  bgcolor=\"#FFFFFF\">
                          <td><span class=\"tabletext\"><b>GRN#</b></td>
                          <td><span class=\"tabletext\">$myrow[26]</td>
                          <td colspan=2><span class=\"tabletext\"><b>Batch Num</b></td>
                          <td colspan=2><span class=\"tabletext\">$myrow[29]</td>
                      </tr>
                       <tr  bgcolor=\"#FFFFFF\">
                          <td><span class=\"tabletext\"><b>Work Order Type</b></td>
                          <td><span class=\"tabletext\">$myrow[30]</td>
                          <td colspan=2><span class=\"tabletext\"><b>Work Order Ref#</b></td>
                          <td colspan=2><span class=\"tabletext\">$myrow[31]</td>
                      </tr>

					     <tr  bgcolor=\"#FFFFFF\">
                          <td><span class=\"tabletext\"><b>Amendment Qty</b></td>
                          <td><span class=\"tabletext\">$amndqty</td>
                          <td colspan=2><span class=\"tabletext\"><b>Amendment Date</b></td>
                          <td colspna=2><span class=\"tabletext\">$amenddate</td>
                      </tr>
					     <tr  bgcolor=\"#FFFFFF\">
                          <td><span class=\"tabletext\"><b>Amendment Notes</b></td>
                          <td><textarea name=\"remarks\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\" rows=2 cols=30>$myrow[37]</textarea></td>
                       <td colspan=2><span class=\"tabletext\"><b>Remarks</b></td>
                       <td colspan=2><textarea name=\"remarks\" style=\"background-color:#DDDDDD;\"  readonly=\"readonly\" rows=3 cols=35>$remark</textarea></td>
                      </tr>

  </table>

    ";
?>

   </td></tr>
      <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=4>

<?php
 $result = $newwo->getlink2masterdata($worecnum);
 $myrec =  mysql_fetch_row($result);
 $link2masterdata = $myrec[0];

   if($link2masterdata != '')
   {
      include("mddetails.php");
   }
?>



<?php
 /*printf('<tr bgcolor="#DDDEDD"><td colspan=7><span class="heading"><center><b>Attachments</b></center></td></tr>
                      <tr bgcolor="#FFFFFF"><td width=250><span class="tabletext"><b>File1</b></td>
                          <td width=250><span class="tabletext"><a href=attachments/%s>%s</td>
                          <td width=250><span class="tabletext"><b>File2</b></td>
                          <td width=250><span class="tabletext"><a href=attachments/%s>%s</td>
                      </tr>
                      <tr bgcolor="#FFFFFF"><td width=250><span class="tabletext"><b>File3</b></td>
                          <td width=250><span class="tabletext"><a href=attachments/%s>%s</td>
                          <td width=250><span class="tabletext"><b>File4</b></td>
                          <td width=250><span class="tabletext"><a href=attachments/%s>%s</td>
                     </tr>',
		              $myrow1["filename1"],$myrow1["filename1"],$myrow1["filename2"],$myrow1["filename2"],$myrow1["filename3"],$myrow1["filename3"],$myrow1["filename4"],$myrow1["filename4"]);*/

 ?>


</table>
<table border=0 bgcolor="#DFDEDF" width=100% >
<?php



            printf('<tr  bgcolor="#DDDEDD"><td colspan=12><span class="heading"><center><b>Engineering Notes</b></center></td></tr>');
            $result = $newwo->getNotes($worecnum);
            printf('<tr bgcolor="#FFFFFF"><td colspan=12><textarea name="notes" rows="6" cols="89">');
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

    <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Production Status</b></center></td>

        </tr>
 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">
        <!--   <td width=8%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>M/C Name </p></font></td>
            <td width=8%><span class="labeltext"><p align="left">Operator </p></font></td>
            <td width=8%><span class="labeltext"><p align="left">PRN#</p></font></td>

            <td width=10%><span class="labeltext"><p align="left">Date </p></font></td>
            <td width=8%><span class="labeltext"><p align="left">Shift </p></font></td> -->



        <td width='10%'class="labeltext">Stage</td>
          <?php

             $i=1;
             while($i<=16)
             {
          ?>
              <td width=4%><span class="labeltext"><p align="left"><?php echo $i ?></p></font></td>
          <?php
              $i++;
             }
          ?>
        </tr>
    <?php

       $prod_result = $newwo->get_prod_status($myrow[0]);
       // $myprod = mysql_fetch_assoc($prod_result);


          //$myprod = mysql_fetch_assoc($prod_result);
          //$operatorrecnum = $myprod["recnum"];
          $setting_time = $newwo->getsetting_time($myrow[0]);
          $running_time = $newwo->getrunning_time($myrow[0]);
          $idle_time = $newwo->getidle_time($myrow[0]);

          $qty = $newwo->getqty1($myrow[0]);
         /* $sl_from = $newpo->getsl_from1($operatorrecnum);
          $sl_to = $newpo->getsl_to1($operatorrecnum); */

       /*   $stage_data = $newwo->getstage_datas($operatorrecnum);

        while($mystage = mysql_fetch_assoc($stage_data))
       {  */
    ?>
        <tr bgcolor="#FFFFFF">
         <!--  <td width=8% rowspan=6><span class="tabletext"><?php// echo $myprod['mc_name'] ?> </td>
            <td width=8% rowspan=6><span class="tabletext"><?php// echo $myprod['oper_name'] ?></td>
            <td rowspan=6><span class="tabletext"><?php //echo $myprod['crn'] ?></td>

           <?php
           /* $d=substr($myprod['st_date'],8,2);
            $m=substr($myprod['st_date'],5,2);
            $y=substr($myprod['st_date'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);      */
           ?>
            <td rowspan=6><span class="tabletext"><?php //echo $date ?></td>
            <td rowspan=6><span class="tabletext"><?php // echo $myprod['shift'] ?></td> -->


          <td class="labeltext1">Setting Time(mins)</td>
         <?php
           $x=1;
           $rt=1;
           $it=1;

       /*   while($myrow1 = mysql_fetch_assoc($mystage))
           {

                     $stage1[] = $myrow1['setting_time'];

                     $stage_num1[] = $myrow1['stage_num'];
           }  */


          while($myrow1 = mysql_fetch_assoc($setting_time))
           {
                 //echo $myrow1['setting_time'] . '<br>';
                 //echo $myrow1['stage_num'] . '<br>';
                     $setting_time1[] = $myrow1['setting_time'];
                     $setting_time_mins1[] = $myrow1['setting_time_mins'];

                     $stage_num1[] = $myrow1['stage_num'];
           }

           while($myrow2 = mysql_fetch_assoc($running_time))
           {

                     $running_time1[] = $myrow2['running_time'];
                     $running_time_mins1[] = $myrow2['running_time_mins'];

                     $stage_num2[] = $myrow2['stage_num'];
           }

           while($myrow3 = mysql_fetch_assoc($idle_time))
           {

                     $idle_time1[] = $myrow3['idle_time'];
                     $idle_time_mins1[] = $myrow3['idle_time_mins'];

                     $stage_num3[] = $myrow3['stage_num'];
           }

           while($myrow4 = mysql_fetch_assoc($qty))
           {

                     $qty1[] = $myrow4['qty'];

                     $stage_num4[] = $myrow4['stage_num'];
           }

         /*  while($myrow5 = mysql_fetch_assoc($sl_from))
           {

                     $sl_from1[] = $myrow5['sl_from'];

                     $stage_num5[] = $myrow5['stage_num'];
           }

           while($myrow6 = mysql_fetch_assoc($sl_to))
           {

                     $sl_to1[] = $myrow6['sl_to'];

                     $stage_num6[] = $myrow6['stage_num'];
           }     */

           while($x<=16)
           {

         ?>

            <td><span class="tabletext">
             <?php
                             $y = 0;
                            if(count($stage_num1) != 0)
                            {
                             foreach($stage_num1 as $val)
                             {
                                 //echo $val. ' and ' . $x;
                                  if($val == $x)
                                  {
                                    //echo 'hi';
                                    $setting_time = $setting_time1[$y] * 60;
                                    $setting_time += $setting_time_mins1[$y];
                                    if($setting_time == 0 || $setting_time == '')
                                      echo '';
                                    else
                                      echo $setting_time . ' m';
                                     // printf("%.2f",$setting_time1[$y]);
                                  }
                                  $y++;
                             }
                            }
             ?></td>

             <?php
            $x++;
           }
           unset($stage_num1);
           unset($setting_time1);
           unset($setting_time_mins1);
           unset($setting_time);


         ?>

        </tr>
        <tr bgcolor="#FFFFFF">
        <td class='labeltext1'>Running Time(mins)</td>
          <?php
            $rt=1;
            while($rt<=16)
            {

         ?>

            <td><span class="tabletext">
             <?php
                             $y = 0;
                             if(count($stage_num2) != 0)
                             {
                             foreach($stage_num2 as $val)
                             {
                                 //echo $val. ' and ' . $x;
                                  if($val == $rt)
                                  {
                                    $running_time = $running_time1[$y] * 60;
                                    $running_time += $running_time_mins1[$y];
                                    if($running_time == 0 || $running_time == '')
                                      echo '';
                                    else
                                      echo $running_time . ' m';

                                      //printf("%.2f",$running_time1[$y]);
                                  }
                                  $y++;
                             }
                            }
             ?></td>

             <?php
               $rt++;
             }
             unset($stage_num2);
             unset($running_time1);
             unset($running_time_mins1);
             unset($running_time);
          ?>

        </tr>
        <tr bgcolor="#FFFFFF">
        <td class='labeltext1'>Idle Time(mins)</td>

            <?php
             $it=1;
             while($it<=16)
             {

         ?>

            <td><span class="tabletext">
             <?php
                             $y = 0;
                             if(count($stage_num3) != 0)
                             {
                             foreach($stage_num3 as $val)
                             {
                                 //echo $val. ' and ' . $x;
                                  if($val == $it)
                                  {
                                    $idle_time = $idle_time1[$y] * 60;
                                    $idle_time += $idle_time_mins1[$y];
                                    if($idle_time == 0 || $idle_time == '')
                                      echo '';
                                    else
                                      echo $idle_time . ' m';
                                  }
                                  $y++;
                             }
                            }
             ?></td>

             <?php
               $it++;
             }
               unset($stage_num3);
               unset($idle_time1);
          ?>
        </tr>


        <tr bgcolor="#FFFFFF">
        <td class='labeltext1'>Qty Produced</td>

            <?php
             $q=1;
             while($q<=16)
             {
              $qty = 'qty' . $q;
            ?>

            <td><span class="tabletext">
             <?php
                             $y = 0;
                             if(count($stage_num4) != 0)
                             {
                             foreach($stage_num4 as $val)
                             {
                                 //echo $val. ' and ' . $x;
                                  if($val == $q)
                                  {
                                    //echo 'hi';
                                    if($qty1[$y] == 0)
                                      echo '';
                                    else
                                      echo $qty1[$y];

                                  }
                                  $y++;
                             }
                            }
             ?></td>

             <?php
               $q++;
             }
               unset($stage_num4);
               unset($qty1);
          ?>
        </tr>
       <!--
        <tr bgcolor="#FFFFFF">
        <td class='labeltext1'>Sl No. From:</td>

            <?php
             $sf=1;
             while($sf<=16)
             {
            $sl_from = 'sl_from' . $sf;
         ?>

            <td><span class="tabletext">
             <?php
                             $y = 0;
                             if(count($stage_num5) != 0)
                             {
                             foreach($stage_num5 as $val)
                             {
                                 //echo $val. ' and ' . $x;
                                  if($val == $sf)
                                  {
                                    //echo 'hi';
                                    if($sl_from1[$y] == 0)
                                      echo '';
                                    else
                                      echo $sl_from1[$y];

                                  }
                                  $y++;
                             }
                            }
             ?></td>

             <?php
               $sf++;
             }
               unset($stage_num5);
               unset($sl_from1);
          ?>
        </tr>

        <tr bgcolor="#FFFFFF">
        <td class='labeltext1'>Sl No. To:</td>

            <?php
             $st=1;
             while($st<=16)
             {
            $sl_to = 'sl_to' . $st;
         ?>

            <td><span class="tabletext">
             <?php
                             $y = 0;
                             if(count($stage_num6) != 0)
                             {
                             foreach($stage_num6 as $val)
                             {
                                 //echo $val. ' and ' . $x;
                                  if($val == $st)
                                  {
                                    //echo 'hi';
                                    if($sl_to1[$y] == 0)
                                      echo '';
                                    else
                                      echo $sl_to1[$y];

                                  }
                                  $y++;
                             }
                            }
             ?></td>

             <?php
               $st++;
             }
               unset($stage_num6);
               unset($sl_to1);
          ?>
        </tr>      -->


      <?php
      // }
      ?>


        </table>


    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<?php

        include("indetails.php");
		//include("irmDetails.php");
       // include("mmdetails.php");
       // include("siDetails.php");
       // include("fidDetails.php");
       // include("ddDetails.php");
?>

  <!-- <tr><td align='right' colspan=13> <a href="javascript:act_log(<?php //echo $worecnum?>,<?php //echo "'".$wotype."'"?>)"><img src='images/approval.gif' border=0></a>&nbsp;&nbsp;&nbsp;&nbsp;</td><tr>-->
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr bgcolor="#DDDEDD">
            <td colspan=12><table width=100% border=0 bgcolor="#000000">


        <tr class='bgcolor4'>
            <td colspan=13><span class="heading"><center><b>Timeline & Owner</b></center></td>
        </tr>
	<tr><td colspan=13>
        <table width=100% border=0 cellspacing=1 cellpadding=4 bgcolor="#000000">

        <tr class='bgcolor4' border=0>
       <?php
        if($myrow[17] != '' && $myrow[17] != '0000-00-00' && $myrow[17] != 'NULL')
            {
              $datearr = split('-', $myrow[17]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
             $x=mktime(0,0,0,$m,$d,$y);
             $date1=date("M j, Y",$x);

            }
            else
            {
             $date1 = '';
            }

            if($myrow[20] != '' && $myrow[20] != '0000-00-00' && $myrow[20] != 'NULL')
            {
              $datearr = split('-', $myrow[20]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
             $x=mktime(0,0,0,$m,$d,$y);
             $date2=date("M j, Y",$x);
            }
            else
            {
             $date2 = '';
            }

            if($myrow[18] != '' && $myrow[18] != '0000-00-00' && $myrow[18] != 'NULL')
            {
              $datearr = split('-', $myrow[18]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
             $x=mktime(0,0,0,$m,$d,$y);
             $date3=date("M j, Y",$x);
            }
            else
            {
             $date3 = '';
            }
        ?>

            <td><span class="tabletext"><p align="left"><b>Sch Due Date</b></p></font></td>
            <td><input type="text" name="sch_due_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php if ($myrow[17] != '0000-00-00') echo $date1 ?>">
            </td>
            <td><span class="tabletext"><p align="left"><b>Revised Completed Date</b></p></font></td>
            <td><input type="text" name="rev_ship_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php if ($myrow[20] != '0000-00-00') echo $date2 ?>">
            </td>
            <td><span class="tabletext"><p align="left"><b>Date Code</b></p></font></td>
            <td><input type="text" name="actual_ship_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php if ($myrow[18] != '0000-00-00') echo $date3 ?>">
            </td>


<?php
/*
if ($myrow[18] != '0000-00-00' && $myrow[18] != '')
	$link=$myrow[18];
else
	$link='<span class="tabletext"><p align="left"><b>View Shipment</b></p></font>  '
 */
?>
    <!--        <td><a href ="javascript:displayShipment()"><?php // echo $link?></a>
            </td>   -->

        </tr>
       </table>


        <tr class='bgcolor4' WIDTH="100%">
            <td WIDTH=13%><span class="heading"><b>Department</b></td>
            <td WIDTH=4%><span class="heading"><b>Seq#</b></td>
            <td WIDTH=21%><span class="heading"><b>Milestone</b></td>
            <td WIDTH=4%><span class="heading"><b>Dep#</b></td>
	        <td WIDTH=9%><span class="heading"><b>Sch Date</b></td>
            <td WIDTH=9%><span class="heading"><b>Revised Date</b></td>

            <td WIDTH=9%><span class="heading"><b>Completed Date</b></td>
	        <td WIDTH=9%><span class="heading"><b><center>Owner</center></b></td>
            <td WIDTH=11%><span class="heading"><b><center>Approved by</center></b></td>
            <td WIDTH=6%><span class="heading"><b><center>Notes</center></b></td>
            <td WIDTH=9%><span class="heading"><b><center>Ref Num.</center></b></td>
        </tr>

         <?php
        $department = "";
        $i=0;

        $t=0;
        $x=0;

        while ($mytl = mysql_fetch_row($timeline)) {

             if($mytl[28] != $department)
             {
               $t++;

               if($i == 1)
               {
                $i = 0;
               }
               else if ($i == 0)
               {
                $i = 1;
               }

               $stagenum = $mytl[31];

             }

         ?>

           <tr  <?php if ($i == 1){ echo "class='bgcolor3'";}  else { echo "class='bgcolor4'";}?> ID="mytable<?php echo $t ?>">
            <td WIDTH=13%><span class="heading"><b><i><?php

                                      if($mytl[28] != $department){

                                                         ?>
                                        <span><a href="javascript:showTable('mytable<?php  echo $t+1; ?>')"> + </a>/ <a href="javascript:hideTable('mytable<?php  echo ++$t; ?>')">-</a></span>


                                                        <?php echo $mytl[28];


                                                        } ?></i></b></td>

            <td WIDTH=4%><span class="heading"><?php echo $mytl[31] ?></td>
            <td WIDTH=21%><span class="heading"><?php echo $mytl[30] ?></td>
            <td WIDTH=4%><span class="heading"><?php echo $mytl[34] ?></td>

            <?php

            if($mytl[2] != '' && $mytl[2] != '0000-00-00' && $mytl[2] != 'NULL')
            {
              $datearr = split('-', $mytl[2]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $date1=date($d.'-'.$m.'-'.$y);
            }
            else
            {
             $date1 = '';
            }

            if($mytl[3] != '' && $mytl[3] != '0000-00-00' && $mytl[3] != 'NULL')
            {
              $datearr = split('-', $mytl[3]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $date2=date($d.'-'.$m.'-'.$y);
            }
            else
            {
             $date2 = '';
            }

            if($mytl[4] != '' && $mytl[4] != '0000-00-00' && $mytl[4] != 'NULL')
            {
              $datearr = split('-', $mytl[4]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $date3=date($d.'-'.$m.'-'.$y);
            }
            else
            {
             $date3 = '';
            }
           // echo "$date";
          ?>


            <td WIDTH=9%><span class="heading"><?php if ($mytl[2] != '0000-00-00') echo $date1 ?></td>
            <td WIDTH=9%><span class="heading"><?php if ($mytl[3] != '0000-00-00') echo $date2 ?></td>

            <td WIDTH=9%><span class="heading"><?php if ($mytl[4] != '0000-00-00') echo $date3 ?></td>

<?php
            if ($mytl[10] != 'Cust') {
?>
                <td WIDTH=9%><span class="heading"><?php echo $mytl[12] ?></td>

<?php
            }
            else {
?>
                <td WIDTH=9%><span class="heading"><?php echo $mytl[14] ?></td>

<?php
            }
?>
<?php
            if ($mytl[10] != 'Cust') {
?>
                <td WIDTH=11%><span class="heading"><?php
                                          if(($mytl[29] == '' && $mytl[16] == '' && $userrole == 'SU') || ($mytl[29] == '' && $mytl[16] == '' && $userrole == 'RU' && $mytl[28] == $dept)) {
                                          ?>
                                           <a href="processApproval.php?worecnum=<?php echo $worecnum ?>&wfrecnum=<?php echo $mytl[9] ?>&drecnum=<?php echo $mytl[8] ?>&typerecnum=<?php echo $typenum ?>&nextstatus=<?php echo $mytl[30] ?>&stagenum=<?php echo $mytl[31] ?>"><img src="images/bu_approval.gif" border=0>  </a>

                                          <?php
                                               }else if($mytl[29] == '' && $mytl[16] == '' && $userrole == 'RU' && $mytl[28] != $mytl[33]){
                                          ?>

                                          <?php
                                                //echo 'dep' .  $mytl[29];
                                               // echo '<br>id' .  $mytl[16];
                                               // echo '<br>depment' .  $mytl[28];
                                               // echo '<br>dept' .  $dept;
                                          //echo $mytl[28]; echo $mytl[33] ?><img src="images/bu_approval.gif" border=0>

                                          <?php

                                              }

                                          ?>

                                          <?php echo $mytl[16] ?></td>

                <td  WIDTH=6%><span class="tabletext"><a href="woDetails.php?wonum=<?php echo $wonum ?>&position=bottom&worecnum=<?php echo $worecnum?>&dept=<?php echo $mytl[1]?>&rownum=<?php echo $id?>&stagenum=<?php echo $mytl[31]?>" TITLE="Add Notes">Notes</td>
                 <td><span class="heading"><? //php echo $mytl[29] ?></td>
<?php
            }
            else {
                    if ($mytl[18] != '')
                    {
?>
                    <td WIDTH=9%><span class="heading"><?php echo $mytl[18] ?></td>

<?php
                    }
                    else
                    {
?>
                        <td WIDTH=9%><span class="heading"><?php echo $mytl[16] ?></td>
<?php
                    }
            }
?>
        </tr>


 <?php
          $department= $mytl[28];

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


        <?php
                  if($dept=='')
                    {

                    }

                      else
                      {

                            $dept=$_REQUEST['dept'];
                            $stagenum = $_REQUEST['stagenum'];

                     ?>

										 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

                                        <?php
                                                   printf('<tr  bgcolor="#DDDEDD"><td colspan=8><span class="heading"><b>Notes for %s Milestone(stage # : %s)</b></center></td></tr>',$dept,$stagenum);
                                                   $result = $newwo->getNotes4milestone($worecnum,$dept);
                                                   printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes" rows="6" cols="88"  readonly="readonly">');
                                                   while ($mynotes = mysql_fetch_row($result)) {
                                                         printf("\n");
                                                         printf("********Added by $mynotes[2] on $mynotes[0]*********** ");
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
                                                           <input type="hidden" name="position" value="<?php echo "bottom" ?>" >
                                                        </td> </tr>
            									</table>
 											</td>
										 </tr>
                           <?php
                        }
                       ?>
         </table>
<table border=3 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
            <td colspan=2><span class="labeltext"><?php echo $myrow[32] ?></td>
            <td colspan=2><span class="labeltext">&nbsp;</td>
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
      </td></tr>



      </table>
  </table>
            <?php
                  if($dept =='')
                    {
                    ?>

                   <?php

                   }
                   else{
                 ?>
                     <span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onClick="javascript: return check_req_fields4notes()">
                   <?php
                  }
                  ?>
</FORM>
</body>
</html>
