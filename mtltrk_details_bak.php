<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2004                 =
// Filename: mtltrk.php                        =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Mtl Track Details                           =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}


// Includes
include_once('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/mtl_trackerclass.php');
include('classes/liClass.php');

$usertype = $_SESSION['usertype'];
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'mtltrk_details';
//////session_register('pagename');
$newlogin = new userlogin;
$newlogin->dbconnect();
$newdisplay = new display;
$newMT = new mtl_trk;
$newPO = new po_line_items;

$ponum = $_REQUEST['ponum'];
$result = $newMT->getmtltrk_details($ponum);
$myrow = mysql_fetch_row($result);
$result1 = $newMT->getmtltrk_li($ponum);

?>
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mtltrk.js"></script>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>Material Tracker Details</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
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
?>
</td></tr>
</table>

<table width=100% border=0 cellpadding=0 cellspacing=0  >

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>Material Tracker</b></td>
        <td align=right><a href ="edit_mtltrk.php?ponum=<?php echo $ponum ?>" ><img name="Image8" border="0" src="images/bu-edit.gif" ></a>
           <img src="images/bu-activitylog.gif" alt="Get ActLog"  onclick="javscript:displayActivityLog(<?php echo $ponum ?>)">  
           <input type= "image" name="Print" src="images/bu-print.gif" value="Print" onclick="javascript:printmtltrk(<?php echo "'" . $ponum . "'"?>)">
        </td>
    </tr>


     <form action='' method='post' enctype='multipart/form-data'>
<tr>
<td colspan=2>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Material Tracker Header</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">
            <td colspan=4 bgcolor="#FFFFFF"><span class="labeltext"><p align="center">PO#</p></td>
            <td colspan=5><span class="tabletext"><?php echo $myrow[1] ?></td>
            <td colspan=5 bgcolor="#FFFFFF"><span class="labeltext"><p align="center">Supplier</p></td>
            <td colspan=11><span class="tabletext"><?php echo "$myrow[3]<br>$myrow[4],$myrow[5]<br>$myrow[6]-$myrow[7]<br>ph-$myrow[8]." ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">

            <td colspan=4><span class="labeltext"><p align="center">Host</p></font></td>
            <!--<td class="cnf"><span class="labeltext"><p align="center">C&F</p></font></td>-->
            <td <?php if($usertype == 'VEND' || $usertype == 'EMPL') echo 'colspan=7'; else echo 'colspan=6'; ?>  class="sup"><span class="labeltext"><p align="center"><?php echo $myrow[3]; ?></p></font></td>
            <?php if($usertype == 'EMPL' || $usertype == 'VEND')
            {
            ?>
            <td><span class="labeltext"><p align="center">Host</p></font></td>
            <?php
            }
            ?>
            <td <?php if($usertype == 'FF' || $usertype == 'EMPL') echo 'colspan=4'; else echo 'colspan=3'; ?>    class="ff"><span class="labeltext"><p align="center">Frieght Forwarder</p></font></td>
            <?php if($usertype == 'FF' || $usertype == 'EMPL')
            {
            ?>
            <td><span class="labeltext"><p align="center">Host</p></font></td>
            <?php
            }
            ?>
            <td <?php if($usertype == 'CF' || $usertype == 'EMPL') echo 'colspan=6'; else echo 'colspan=5'; ?>    class="cnf"><span class="labeltext"><p align="center">C&F</p></font></td>
            <?php if($usertype == 'CF' || $usertype == 'EMPL')
            {
            ?>
            <td><span class="labeltext"><p align="center">Host</p></font></td>
            <?php
            }
            ?>
            <td>&nbsp;</td>
        </tr>
       <tr bgcolor="#EEEEEE">
            <td width=6%><span class="labeltext"><p align="center">Line #</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Mtl Spec</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Qty</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Delivery <br>Date</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Inv#</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Inv Date</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Inv Qty</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">P/S #</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">B/L #</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">B/L Date</p></font></td>
            <?php if($usertype == 'VEND' || $usertype == 'EMPL')
            {
            ?>
            <td width=6%><span class="labeltext"><p align="center">Pay Due Dt</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Pay Exp Dt</p></font></td>
            <?php
            }
            ?>
            <td width=6%><span class="labeltext"><p align="center">Pick Dt</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Sail Dt</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">EDA</p></font></td>
            <?php if($usertype == 'FF' || $usertype == 'EMPL')
            {
            ?>
            <td width=6%><span class="labeltext"><p align="center">Pay Due Dt</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Pay Exp Dt</p></font></td>
            <?php
            }
            ?>
            <td width=6%><span class="labeltext"><p align="center">AAD</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Dock No.</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">BOE No.</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Exp Cl Dt</p></font></td>
            <td width=6%><span class="labeltext"><p align="center">Delivery<br>Date</p></font></td>
            <?php if($usertype == 'CF' || $usertype == 'EMPL')
            {
            ?>

            <td width=6% nowrap><span class="labeltext"><p align="center">Pay Due <br>Dt</p></font></td>
            <td width=6% nowrap><span class="labeltext"><p align="center">Pay Exp <br>Dt</p></font></td>
            <?php
            }
            ?>
            <td width=6%>&nbsp;</td>
        </tr>

         <?php

            $i=1;
            $partname = '';
            while ($myLI = mysql_fetch_row($result1)) {
            
            
            $j = 0;
        $result3 = $newPO->getLI4mtltrk($ponum);

        while ($myLI1 = mysql_fetch_assoc($result3)) {
             //echo "hiiiiiiiiiiiii $ponum";

            if($myLI1["duedate"] != '' && $myLI1["duedate"] != '0000-00-00')
            {
			  $datearr = split('-', $myLI1["duedate"]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $due[$j]=date("j M Y",$x);
            }
            else
            {
              $due[$j] = '';
            }
            
              $j++;
         }

            $adv_license_qty = 'adv_license_qty' . $i;
            $invnum ='invnum' . $i;
            $invdate = 'invdate' . $i;
            $invqty ='invqty' . $i;
            $supdel_date ='supdel_date' . $i;
            $paydue_date ='paydue_date' . $i;
            $payexp_date ='payexp_date' . $i;
            $pick_date ='pick_date' . $i;
            $sail_date ='sail_date' . $i;
            $eda ='eda' . $i;
            $aad ='aad' . $i;
            $expclr_date ='expclr_date' . $i;
            $cfdel_date ='cfdel_date' . $i;

            $date2 = $myLI[2];
            if($date2 == '0000-00-00')
            {
               $date2 = '';
            }

            $date4 = $myLI[23];
            if($date4 == '0000-00-00')
            {
               $date4 = '';
            }

            $date5 = $myLI[5];
            if($date5 == '0000-00-00')
            {
               $date5 = '';
            }

            $date6 = $myLI[6];
            if($date6 == '0000-00-00')
            {
               $date6 = '';
            }

            $date7 = $myLI[7];
            if($date7 == '0000-00-00')
            {
               $date7 = '';
            }

            $date8 = $myLI[8];
            if($date8 == '0000-00-00')
            {
               $date8 = '';
            }

            $date9 = $myLI[9];
            if($date9 == '0000-00-00')
            {
               $date9 = '';
            }

            $date10 = $myLI[10];
            if($date10 == '0000-00-00')
            {
               $date10 = '';
            }

            $date11 = $myLI[11];
            if($date11 == '0000-00-00')
            {
               $date11 = '';
            }

            $date12 = $myLI[12];
            if($date12 == '0000-00-00')
            {
               $date12 = '';
            }
            
            $date13 = $myLI[19];
            if($date13 == '0000-00-00')
            {
               $date13 = '';
            }
            
            $date14 = $myLI[20];
            if($date14 == '0000-00-00')
            {
               $date14 = '';
            }
            
            $date15 = $myLI[21];
            if($date15 == '0000-00-00')
            {
               $date15 = '';
            }
            
            $date16 = $myLI[22];
            if($date16 == '0000-00-00')
            {
               $date16 = '';
            }

            $date17 = $myLI[25];
            if($date17 == '0000-00-00')
            {
               $date17 = '';
            }
            
            $date18 = $myLI[26];
            if($date18 == '0000-00-00')
            {
               $date18 = '';
            }
            
            $date19 = $myLI[27];
            if($date19 == '0000-00-00')
            {
               $date19 = '';
            }
            
            $date20 = $myLI[28];
            if($date20 == '0000-00-00')
            {
               $date20 = '';
            }
            
            $date21 = $myLI[29];
            if($date21 == '0000-00-00')
            {
               $date21 = '';
            }


            if($partname != $myLI[15])
            {
            //echo "<table id=\"mtltrk$i\"  width=100% border=0 cellpadding=3 cellspacing=1 bgcolor=\"#DFDEDF\" >";
			echo "<tr bgcolor=\"#FFFFFF\">";
			echo "<td width=6%><span class=\"tabletext\">$myLI[24]</td>";
			echo "<td width=6%><span class=\"labeltext\"><p align=\"center\">$myLI[30]</p></font></td>";
            $myLI[16]=$myLI[16]?$myLI[16]:$myLI[18];
           // echo "<td width=6%><span class=\"tabletext\"><p align=\"center\">$myLI[18]</p></font></td>";
            echo "<td width=6%><span class=\"tabletext\">$myLI[16]</td>";


            echo "<td width=6%><span class=\"tabletext\">$date4</td>";
            echo "<td width=6%><span class=\"tabletext\">$myLI[1]</td>";
            echo "<td width=6%><span class=\"tabletext\">$date2</td>";
            echo "<td width=6%><span class=\"tabletext\">$myLI[3]</td>";
            echo "<td width=6%><span class=\"tabletext\">$date17</td>";
            echo "<td width=6%><span class=\"tabletext\">$date18</td>";
            echo "<td width=6%><span class=\"tabletext\">$date19</td>";

            if($usertype == 'VEND' || $usertype == 'EMPL')
            {
            echo "<td width=6%><span class=\"tabletext\">$date5</td>";
            echo "<td width=6%><span class=\"tabletext\">$date6</td>";
            }
            echo "<td width=6%><span class=\"tabletext\">$date7</td>";
            echo "<td width=6%><span class=\"tabletext\">$date8</td>";
            echo "<td width=6%><span class=\"tabletext\">$date9</td>";
            if($usertype == 'FF' || $usertype == 'EMPL')
            {
            echo "<td width=6%><span class=\"tabletext\">$date13</td>";
            echo "<td width=6%><span class=\"tabletext\">$date14</td>";
            }

            echo "<td width=6%><span class=\"tabletext\">$date10</td>";
            echo "<td width=6%><span class=\"tabletext\">$date20</td>";
            echo "<td width=6%><span class=\"tabletext\">$date21</td>";
            echo "<td width=6%><span class=\"tabletext\">$date11</td>";
            echo "<td width=6%><span class=\"tabletext\">$date12</td>";
            if($usertype == 'CF' || $usertype == 'EMPL')
            {

            echo "<td width=6%><span class=\"tabletext\">$date15</td>";
            echo "<td width=6%><span class=\"tabletext\">$date16</td>";
            }
            //echo "<td width=6%><input type='image' name='Print' src='images/bu-print.gif' value='Print' onclick='javascript:printmtltrkrow(" . $ponum . "," . $myLI[0] .")'></td>";
            }

            else
            {
			echo "<tr bgcolor=\"#FFFFFF\">";
			echo "<td width=6%><span class=\"tabletext\">$myLI[24]</td>";
			echo "<td width=6%><span class=\"labeltext\"><p align=\"center\">$myLI[30]</p></font></td>";
            $myLI[16]=$myLI[16]?$myLI[16]:$myLI[18];
           // echo "<td width=6%><span class=\"tabletext\"><p align=\"center\">$myLI[18]</p></font></td>";
            echo "<td width=6%><span class=\"tabletext\">$myLI[16]</td>";

            echo "<td width=6%><span class=\"tabletext\">$date4</td>";
            echo "<td width=6%><span class=\"tabletext\">$myLI[1]</td>";
            echo "<td width=6%><span class=\"tabletext\">$date2</td>";
            echo "<td width=6%><span class=\"tabletext\">$myLI[3]</td>";
            echo "<td width=6%><span class=\"tabletext\">$date17</td>";
            echo "<td width=6%><span class=\"tabletext\">$date18</td>";
            echo "<td width=6%><span class=\"tabletext\">$date19</td>";
            if($usertype == 'VEND' || $usertype == 'EMPL')
            {
            echo "<td width=6%><span class=\"tabletext\">$date5</td>";
            echo "<td width=6%><span class=\"tabletext\">$date6</td>";
            }
            echo "<td width=6%><span class=\"tabletext\">$date7</td>";
            echo "<td width=6%><span class=\"tabletext\">$date8</td>";
            echo "<td width=6%><span class=\"tabletext\">$date9</td>";
            if($usertype == 'FF' || $usertype == 'EMPL')
            {
            echo "<td width=6%><span class=\"tabletext\">$date13</td>";
            echo "<td width=6%><span class=\"tabletext\">$date14</td>";
            }
            echo "<td width=6%><span class=\"tabletext\">$date10</td>";
            echo "<td width=6%><span class=\"tabletext\">$date20</td>";
            echo "<td width=6%><span class=\"tabletext\">$date21</td>";
            echo "<td width=6%><span class=\"tabletext\">$date11</td>";
            echo "<td width=6%><span class=\"tabletext\">$date12</td>";
            if($usertype == 'CF' || $usertype == 'EMPL')
            {
            echo "<td width=6%><span class=\"tabletext\">$date15</td>";
            echo "<td width=6%><span class=\"tabletext\">$date16</td>";
            }
            //echo "<td width=6%><input type='image' name='Print' src='images/bu-print.gif' value='Print' onclick='javascript:printmtltrkrow(" . $ponum . ',' . $myLI[0] .")'></td>";
           }

            $i++;
            $partname = $myLI[15];
           }
            echo "<input type=\"hidden\" name=\"index\" value=\"$i\">";
       ?>
       </tr>
     <tr bgcolor="#EEEEEE">
</table>
</table>


<?php if($usertype != 'FF' && $usertype != 'CF')
     {
?>


<table width=100% border=0 cellpadding=0 cellspacing=0  >

	<tr>
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>Original PO</b></td>

    </tr>


<tr>
<td colspan=2>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

       <tr>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Ln</b></td>
            <!--<td bgcolor="#EEEFEE"2><span class="heading"><b>RM Code</b></td>-->
            <td bgcolor="#EEEFEE"><span class="heading"><b>Material Ref</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Material Spec</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>UOM</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Dia</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Length</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Width</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Thickness</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Grainflow</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>No. of Meters req</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>No. of Lengths req</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Due</b></td>
	    <td bgcolor="#EEEFEE"><span class="heading"><b>Accepted</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Delv Mode</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Rate</b></td>
            <td bgcolor="#EEEFEE" align="right"><span class="heading"><b>Amount</b></td>

       </tr>
        <?php
        $total = 0;
        $i = 0;
        $ft=0;    
        $result3 = $newPO->getLI4mtltrk($ponum);
        while ($myLI = mysql_fetch_assoc($result3)) {
             if ($ft == 0) {
                $curr = $myLI["currency"];
                $poamount = $myLI["poamount"];
                $ft = 1;
             }
             //echo "hiiiiiiiiiiiii $ponum";

	   if($myLI["duedate"] != '0000-00-00' && $myLI["duedate"] != '' && $myLI["duedate"] != 'NULL')
           {
              $datearr = split('-', $myLI["duedate"]);
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
		   if($myLI["accepted_date"] != '0000-00-00' && $myLI["accepted_date"] != '' && $myLI["accepted_date"] != 'NULL')
           {
              $datearr = split('-', $myLI["accepted_date"]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $accdate=date("M j, Y",$x);
           }
           else
           {
              $accdate = '';
           }
            //echo "$date";
            $line_num = $myLI["line_num"];
            $item_name = $myLI["item_name"];
            $item_desc = $myLI["item_desc"];
            $qty = $myLI["qty"];
            $delvby = $myLI["delv_by"];
            $uom = $myLI["uom"];
            $grainflow = $myLI["grainflow"];
            $material_ref = $myLI["material_ref"];
            $material_spec = $myLI["material_spec"];
            $dia ="";
            $thick="";
            $width = $myLI["width"];
            $length = $myLI["length"];
            if (trim($length) == "") 
            {
                $dia = $myLI['thick'];
            }
            else 
            {
                $thick = $myLI['thick'];
            }

            $qty_per_meter = $myLI["qty_per_meter"];
            $no_of_meterages = $myLI["no_of_meterages"];
            $no_of_lengths = $myLI["no_of_lengths"];


              $i = $i + 1;
	     echo"<tr><td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$line_num</td>" ;
         //echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\">$item_name</td>";
         //                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$material_ref</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$material_spec</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$uom</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$dia</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$width</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$length</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$thick</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$grainflow</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$no_of_meterages</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$no_of_lengths</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$date</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$accdate</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$delvby</td>";
                         printf('<td bgcolor="#FFFFFF"><span class="tabletext">%s %.2f</td>',$myLI["currency"],$myLI["rate"]);
                         printf('<td align="right" bgcolor="#FFFFFF"><span class="tabletext">%s %.2f</td>',$curr,$myLI["amount"]);
                         $total += $myLI["amount"];
        }
?>

          <tr>
          <tr>
              <td bgcolor="#FFFFFF" colspan=15 align="right"><span class="tabletext"><b>Total</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$curr,$total); ?></td>
          </tr>
</span></td></tr>
</table>
</table>
</table>

<?php } ?>




      </FORM>


  <table border=0 bgcolor="#FFFFFF" width=100%  cellspacing=1 cellpadding=3>
   <tr>
    <td>

 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

     <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
      <tr>


      </tr></table>
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

      </FORM>


</table>

</body>
</html>
