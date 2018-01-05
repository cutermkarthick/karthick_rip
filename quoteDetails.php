<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2006                =
// Filename: quoteDetails.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Quotes Details                              =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'quoteDetails';
$page = "CRM: Quote";
//session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/quoteClass.php');
include('classes/quoteliClass.php');
include('classes/displayClass.php');


$newlogin = new userlogin;
$newlogin->dbconnect();

$newQuote = new quote;
$quoteli = new quoteli;
$newdisplay = new display;

if (isset($_REQUEST['mail']))
{
    $mail=$_REQUEST['mail'];
}
else {
    $mail='';
}
if (isset($_REQUEST['quoterecnum']))
{
	$quoterecnum=$_REQUEST['quoterecnum'];
	$_SESSION['quoterecnum'] = $quoterecnum;
	//session_register('quoterecnum');
}

$quoterecnum =$_SESSION['quoterecnum'] ;
$userid = $_SESSION['user'];

$myQI = $quoteli->getQI($quoterecnum);
$result = $newQuote->getQuote($quoterecnum);
$myrow = mysql_fetch_row($result);
$revisionnum = $newQuote->getRevnum($quoterecnum);
$myQ2 = $quoteli->getQI($quoterecnum);
$Q2= mysql_fetch_row($myQ2);

?>

 <?php
 //email address of cutsomer- to address added 0n 12/10/2006

      $sql = "select email from employee
                     where role = 'SU'";

      $result3 = mysql_query($sql);
      $my = mysql_fetch_row($result3);

      $toaddr= $my[0];
      $fromaddr= "info@fluentsoft.com";

 //details to be sent as body
      $details= "<br>\n "."Quote Id :" .$myrow[0] . "<br>\n "."Terms :" .$myrow[7] . "<br>\n "."Customer :" .$myrow[2] ."<br>\nSales Person :" . $myrow[12].' '.$myrow[13]."<br>\n "."Quote Description :" .$myrow[3]."<br>\n "."Quote Date :" .$myrow[1]."<br>\n "."Delivery Date :" .$myrow[6]."<br>\n "."RFQ ID :" .$myrow[5]."<br>\n "."Comments :" .$myrow[10]."<br>\n "."Line item:" .$Q2[1]."<br>\n "."Description:" .$Q2[2]."<br>\n "."Qty:" .$Q2[3]."<br>\n "."Unit Price:" .$Q2[4]."<br>\n "."Total:" .$Q2[5];

  //sending mails

    if ( $mail=='new'){

       $to ="$toaddr" ;
       $from = $fromaddr;
       $subject = "test mails";
       $message = "$details";

              $success = mail($to, $subject, $message, "From:$from");
              if ($success)
                 echo "The email to $to from $from was successfully sent";
              else
                  echo "An error occurred when sending the email to $to from $from";
       }
               /*
                if (@mail($to, $subject, $message, "From:$from"))
                    echo "The email to $to from $from was successfully sent";
                else
                    echo "An error occurred when sending the email to $to from $from";
               */

 ?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/salesquote.js"></script>
<html>
<head>
<title>Quote Details</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
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

<?php    $newdisplay->dispLinks('');?>

</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6">

<tr>
<td ><span class="pageheading"><b>Quote Details</b><td colspan=200></td>

<td >
       <input type="hidden" name="quoterecnum" value="<?php echo $quoterecnum ?>">
</td>

<td bgcolor="#FFFFFF" rowspan=2 align="right">
<input type= "button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px" value="Print" onclick="javascript: printquoteDetails(<?php echo $quoterecnum ?>)">

<?php


    if($myrow[27] == '')
    {
    ?>

       
             <INPUT TYPE="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onclick="location.href='processSalesorder.php?quoterecnum=<?php echo $quoterecnum ?>'" VALUE="Convert to Sales" ALT="submit" NAME="submit">

    <?php
    }
    ?>


<input type="button" class="stdbtn btn_blue" style="padding:2px;float:right;margin-right:5px" onclick="location.href='quoteDetails.php?mail=new&quoterecnum=<?php echo $quoterecnum ?>'"  value="Send Mail">

  <?php
    if($myrow[27] == ''){
        ?>
        <input type="button" class="stdbtn btn_blue" style="padding:2px;float:right;margin-right:5px" onclick="location.href='quoteRevise.php?quoterecnum=<?php echo $quoterecnum ?>&revisionnum=<?php echo $revisionnum ?>'"  value="Revise">

          <!-- <a href ="quoteRevise.php?quoterecnum=<?php echo $quoterecnum ?>&revisionnum=<?php echo $revisionnum ?>" ><img name="Image8" border="0" src="images/bu_revise.gif" ></a> -->

     <?php }
 ?>

 <?php
    if($myrow[27] == ''){
        ?>

           <?php
            if($myrow[26] == '' || $myrow[26] == 'Not Locked'){
           ?>
<input id="a" type="button" class="stdbtn btn_blue" style="padding:2px;float:right;margin-right:5px" onclick="location.href='quoteDetailsEdit.php?quoterecnum=<?php echo $quoterecnum ?>'"  value="Edit Quote">
            <!-- <a id="a" href ="quoteDetailsEdit.php?quoterecnum=<?php echo $quoterecnum ?>" ><img name="Image16" border="0" src="images/eq.gif" ></a> -->

           <?php }

           ?>


 <?php }
 ?>

</tr>
  </tr>

 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable">
 <tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Quote Header</b></center></td></tr>
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Quote ID</p></font></td>
            <input type="hidden" name="salesperson"><td><span class="tabletext"><?php echo $myrow[0]?></td>
            <td><span class="labeltext"><p align="left">Terms</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[7]?></td>
             <input type="hidden" name="quoteid" value="<?php echo  $myrow[0]?>">
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Customer</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[2]?></td>
             <td><span class="labeltext"><p align="left">Sales Person</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow[12].' '.$myrow[13]?></td>
             <input type="hidden" name="companyrecnum" value="<?php echo  $myrow[17]?>">
             <input type="hidden" name="salespersonrecnum" value="<?php echo  $myrow[15]?>">
             <input type="hidden" name="quoterecnum" value="<?php echo  $quoterecnum?>">
             <input type="hidden" name="currency" value="<?php echo  $myrow[11]?>">
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Quote Description</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow[3]?></td>
            <input type="hidden" name="desc" value="<?php echo  $myrow[3]?>">
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Quote Date</p></font></td>
            <td><span class="tabletext">
            <?php
            $d=substr($myrow[1],8,2);
            $m=substr($myrow[1],5,2);
            $y=substr($myrow[1],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
           // echo "$date";
            ?>

            </td>
            <td><span class="labeltext"><p align="left">Delivery Date</p></font></td>
            <td><span class="tabletext">
             <?php
            $d=substr($myrow[6],8,2);
            $m=substr($myrow[6],5,2);
            $y=substr($myrow[6],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
           // $date=date("F j, Y",$x);
            $date=date("M j, Y",$x);
            //echo "$date";
            ?>

            </td>
            <input type="hidden" name="delivarydate" value="<?php echo  $myrow[6]?>">
            <input type="hidden" name="quotedate" value="<?php echo  $myrow[1]?>">
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">RFQ ID</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[5]?></td>
           <td style='vertical-align: middle'><span class="labeltext"><p align="left">Excel File</td>
           <td><span class="tabletext"><?php echo $myrow[4]?>
           </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Comments</p></font></td>
            <td><span class="tabletext"><?php echo  $myrow[10]?></td>
            <input type="hidden" name="comments" value="<?php echo  $myrow[10]?>">
            <td><span class="labeltext"><p align="left">BOM</p></font></td>
            <td><span class="tabletext"><?php echo  $myrow[22] ?></td>

       </tr>
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Lock Stutus</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo  $myrow[26]?></td>


       </tr>

  <?php
     if($myrow[27] == 'Converted to Sales Order'){
       ?>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Status</p></font></td>
              <td colspan=3 align "right" class="tabletext"><b><?php echo  "Converted to Sales Order"?></b>
  <input type="hidden" name="status" value="<?php echo  $myrow[27]?>">
            </td>
        <?php }
    ?>
        </tr>

    <?php
     if($myrow[28] == 'Emailed to the Customer contact'){
       ?>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Mail Status</p></font></td>
              <td colspan=3 align "right" class="tabletext"><b><?php echo  "Emailed to the Customer contact"?></b>
    <input type="hidden" name="status" value="<?php echo  $myrow[28]?>">
            </td>
        <?php }
    ?>
   </table>
    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable">
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b> Line Items</b></center></td>
</tr>
<tr>

<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable" >
  <thead>
<th class="head0" bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Items</center></b></td>
<th class="head1" bgcolor="#EEEFEE" width=30%><span class="heading"><b><center>Description</center></b></td>
<th class="head0" bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Qty</center></b></td>
<th class="head1" bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Unit Price</center></b></td>
<th class="head0" bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Total</center></b></td>
</tr>
</thead>
<?php
      $i = 1;
      while ($QI = mysql_fetch_row($myQI))
      {
	printf('<tr bgcolor="#FFFFFF">');

	$line_num="line_num" . $i;
	$item_desc="item_desc" . $i;
	$qty="qty" . $i;
	$price="price" . $i;
	$amount="amount" . $i;

	echo "<td align=\"center\"><span class=\"tabletext\">$QI[1]</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$QI[2]</td>";
	echo "<td align=\"center\"><span class=\"tabletext\">$QI[3]</td>";
    printf('<td align="right"><span class="tabletext">%s %.2f</td>',$myrow[11],$QI[4]);
	printf('<td align="right"><span class="tabletext">%s %.2f</td>',$myrow[11],$QI[5]);
	printf('</tr>');
	$i++;

?>
 <input type="hidden" name="<?php echo $line_num ?>" value="<?php echo  $QI[1]?>">
 <input type="hidden" name="<?php echo $qty ?>" value="<?php echo  $QI[3]?>">
 <input type="hidden" name="<?php echo $item_desc ?>" value="<?php echo  $QI[2]?>">
 <input type="hidden" name="<?php echo $price ?>" value="<?php echo  $QI[4]?>">
 <input type="hidden" name="<?php echo $amount ?>" value="<?php echo  $QI[5]?>">
<?php
    }
?>
 <tr>
  </tr>




       <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr>
         <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
          <td align="right"><span class="pageheading"><b></b></td><td width="14.5%"></td></tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Gross Total</p></font></td>
            <td align="right"><span class="tabletext">
            <?php

             printf('%s %.2f</td>',$myrow[11],$myrow[16]);

            ?>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Tax</p></font></td>
            <td align="right"><span class="tabletext">
            <?php

             printf('%s %.2f</td>',$myrow[11],$myrow[18]);

            ?>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Labor</p></font></td>
            <td align="right"><span class="tabletext">
            <?php

             printf('%s %.2f</td>',$myrow[11],$myrow[20]);

            ?>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Shipping</p></font></td>
            <td align="right"><span class="tabletext">
            <?php

             printf('%s %.2f</td>',$myrow[11],$myrow[19]);

            ?>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Misc</p></font></td>
            <td align="right"><span class="tabletext">
            <?php

             printf('%s %.2f</td>',$myrow[11],$myrow[21]);

            ?>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Total Due</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
             $totaldue=$myrow[16]+$myrow[18]+$myrow[19]+$myrow[20]+$myrow[21];
             printf('%s %.2f</td>',$myrow[11],$totaldue);

            ?>
        </tr>

            <input type="hidden" name= "tax" value="<?php echo  $myrow[18]?>">
            <input type="hidden" name="labor" value="<?php echo  $myrow[20]?>">
            <input type="hidden" name="shipping" value="<?php echo  $myrow[19]?>">

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

</table>
</body>
</html>
