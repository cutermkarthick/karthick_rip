<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: advlicDetails.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Displays Adv lic                            =
//==============================================

session_start();
header("Cache-control: private");
//echo 'Userindetails=' .$_SESSION['user'];
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
//echo 'recnum='.$_REQUEST['advlicrecnum'];
if ( !isset ( $_REQUEST['advlicrecnum']) )
{
//echo "i am not set in podetails";
   header ( "Location: login.php" );

}

$advlicrecnum = $_REQUEST['advlicrecnum'];
$_SESSION['advlicrecnum'] = $advlicrecnum;
//////session_register('advlicrecnum');
$_SESSION['pagename'] = 'advlicDetails';
//////session_register('pagename');


// First include the class definition

include('classes/advlicClass.php');
include('classes/advlicliClass.php');
include('classes/displayClass.php');
$newadv = new advlic;
$newdisplay = new display;
$newLI = new advlic_line_items;
$result = $newadv->getadvlicDetails($advlicrecnum);
$myrow = mysql_fetch_assoc($result);
/* echo "i am 12 :$myrow[12]";
 echo "i am 11 :$myrow[11]";
 echo "i am 10 :$myrow[10]";*/
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/advlic.js"></script>

<html>
<head>
<title>Adv License Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');?>
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
<?php
   $newdisplay->dispLinks('');
?>
						<table width=100% border=0 cellpadding=0 cellspacing=0  >
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/spacer.gif " width="6"></td>
								<td bgcolor="#FFFFFF">
									<table width=100% border=0 cellpadding=6 cellspacing=0  >
										<tr><td>
										       <table width=100% border=0>

											<tr>

                                            <td align="left"><span class="pageheading"><b>Adv License Details</b></td>

                                                <td bgcolor="#FFFFFF" rowspan=2 align="right">
                   <a href ="advlicEdit.php?advlicrecnum=<?php echo $advlicrecnum ?>" ><img name="Image8" border="0" src="images/bu-edit.gif" ></a>
                                                 <input type= "image" name="Print" src="images/bu-print.gif" value="Get" onclick='javascript: printPO("<?php echo $porecnum ?>")'>
                                                    </td>


    											</tr>
    										<!--<tr><td align="left"><span class="labeltext">All Dimensions in mm unless otherwise specified	</td></tr>-->
										      </table>
										</td></tr>

										<tr>
											<td>
  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
												         <tr bgcolor="#FFFFFF">

  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
     <form>

       </tr>
        <tr bgcolor="#FFFFFF">


 <br>
 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF">
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr></table>
     <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
         <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Adv License #</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["adv_license"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">License Date</p></font></td>
            <?php

              if($myrow["lic_date"] != '0000-00-00' && $myrow["lic_date"] != '' && $myrow["lic_date"] != 'NULL')
              {
                  $datearr = split('-', $myrow["lic_date"]);
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
            ?>
            <td width=20%><span class="tabletext"><?php echo $date ?></td>

        </tr>
         <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">From</p></font></td>
            <?php

              if($myrow["from_date"] != '0000-00-00' && $myrow["from_date"] != '' && $myrow["from_date"] != 'NULL')
              {
                  $datearr = split('-', $myrow["from_date"]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $fromdate=date("M j, Y",$x);
              }
              else
              {
                 $fromdate = '';
              }
            ?>
            <td width=20%><span class="tabletext"><?php echo $fromdate ?></td>
            <td width=20%><span class="labeltext"><p align="left">To</p></font></td>
            <?php

              if($myrow["to_date"] != '0000-00-00' && $myrow["to_date"] != '' && $myrow["to_date"] != 'NULL')
              {
                  $datearr = split('-', $myrow["to_date"]);
                  $d=$datearr[2];
                  $m=$datearr[1];
                  $y=$datearr[0];
                  $x=mktime(0,0,0,$m,$d,$y);
                  $todate=date("M j, Y",$x);
              }
              else
              {
                 $todate = '';
              }
            ?>
            <td width=20%><span class="tabletext"><?php echo $todate ?></td>

        </tr>


   </table>
 <br>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#DDDEDD">
<td colspan=15><span class="heading"><center><b>Line Items</b></center></td>
</tr>
       <tr>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Ln</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Partnum</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Partname</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>R.M Spec</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>R.M Size</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Qty to Make</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Qty to Import</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>BE No</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Assessment Value</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>CIF Value</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Rate</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Tariff</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Wastage</b></td>
       </tr>

<?php

        $i = 0;
        $result = $newLI->getLI($advlicrecnum);
        while ($myLI = mysql_fetch_assoc($result)) {


            //echo "$date";
            $line_num = $myLI["line_num"];
            //$item_num = $myLI["item_num"];
            $partnum = $myLI["partnum"];
            $partname = $myLI["partname"];
            $rm_size  = $myLI["rm_size"];
            $rm_spec =  $myLI["rm_spec"];
            $crn = $myLI["crn"];
            $qty2make = $myLI["qty2make"];
            $qtyimp = $myLI["qty_imp"];
            $beno = $myLI["be_no"];
            $assmnt_value = $myLI["assessmnt_value"];
            $cif_value = $myLI["cif_value"];
            $rate =  $myLI["rate"];
            $tariff = $myLI["tariff"];
            $wastage = $myLI["wastage"];


              $i = $i + 1;
	     echo"<tr><td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$line_num</td>" ;
         //echo"<td bgcolor=\"#FFFFFF\" ><span class=\"tabletext\">$item_name</td>";
         //                echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty</td>";
                         //echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$item_num</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partnum</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partname</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$rm_spec</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$crn</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$rm_size</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty2make</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qtyimp</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$beno</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$assmnt_value</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cif_value</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$rate</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$tariff</td>";
                         echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$wastage</td>";

        }
?>


											</table>
 											</td>
										</tr>
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
</body>
</html>
