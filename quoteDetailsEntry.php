<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2006                =
// Filename: quoteDetailsEntry.php             =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new quotes                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$_SESSION['pagename'] = 'newquote';
$page = "CRM: Quote";
//session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/companyClass.php');
include('classes/quoteClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newpage = new page;
$newQuote = new quote;
$newdisplay = new display;
$newCustomer = new company;

if(isset($_REQUEST['quoteid']))
	$quoteid=$_REQUEST['quoteid'];
else
	$quoteid='';
if(isset($_REQUEST['quotedate']))
	$quotedate=$_REQUEST['quotedate'];
else
	$quotedate='';
if(isset($_REQUEST['company']))
	$company=$_REQUEST['company'];
else
	$company='';
if(isset($_REQUEST['companyrecnum']))
	$companyrecnum=$_REQUEST['companyrecnum'];
else
	$companyrecnum='';
if(isset($_REQUEST['desc']))
	$desc=$_REQUEST['desc'];
else
	$desc='';
if(isset($_REQUEST['delivarydate']))
	$delivarydate=$_REQUEST['delivarydate'];
else
	$delivarydate='';

if(isset($_REQUEST['terms']))
	$terms=$_REQUEST['terms'];
else
	$terms='';
if(isset($_REQUEST['rfqid']))
	$rfqid=$_REQUEST['rfqid'];
else
	$rfqid='';
if(isset($_REQUEST['quotetypeval']))
	$quotetype=$_REQUEST['quotetypeval'];
else
	$quotetype='';
if(isset($_FILE['excelfile']['name']))
	$excelfile = $_FILE['excelfile']['name'];
else
	$excelfile ='';
if(isset($_REQUEST['comments']))
	$comments=$_REQUEST['comments'];
else
	$comments='';
if(isset($_REQUEST['salesperson']))
	$salesperson=$_REQUEST['salesperson'];
else
	$salesperson='';

if(isset($_REQUEST['salespersonrecnum']))
	$salespersonrecnum=$_REQUEST['salespersonrecnum'];
else
	$salesperson='';
	
$lockstatus="Not Locked" ;

?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/salesquote.js"></script>


<html>
<head>
<title>New Quote</title>
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
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>New Quote</b></td>
    </tr>


     <form action='processGenericQuote.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Quote Header</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Quote ID</p></font></td>
            <td><span class="tabletext"><input type="text" name="quoteid" size=20 value="<?php echo  $quoteid ?>"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Quote Date</p></font></td>
             <td><input type="text" name="quotedate"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo  $quotedate ?>">
             <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('quotedate')">
            </td>
        </tr>
        <input type="hidden" name="revisionnum" value="0">
        <input type="hidden" name="parentquoteid" value="">
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>

            <td><input type="text" name="company"
                    style=";background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo  $company ?>">
             <img src="images/bu-getcustomer.gif" alt="Get Customer"                                                   onclick="GetAllCustomers()">
            </td>

            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Delivery Date</p></font></td>
            <td><input type="text" name="delivarydate"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo  $delivarydate ?>">
            <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('delivarydate')">

            </td>

            <input type="hidden" name="companyrecnum" value="<?php echo $companyrecnum ?>">
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Quote Description</p></font></td>
            <td><input type="text" name="desc" size=36 value="<?php echo  $desc ?>"></td>
             <td><span class="labeltext"><p align="left">Currency</p></font></td>
             <td><span class="labeltext"><select name="currency" size="1" width="100">
             <option selected>$ </option>
             <option value>Rs </option>
             </select>
             </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Sales Person</p></font></td>
            <td><input type="text" name="salesperson"
                            style=";background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo  $salesperson ?>">
             <img src="images/bu-getemployee.gif" alt="Get Employee" onclick='GetAllEmps()'>
            </td>
             <input type="hidden" name="salespersonrecnum" value="<?php echo $salespersonrecnum ?>">
            <td><span class="labeltext"><p align="left">Terms</p></font></td>
            <td><input type="text" name="terms" size=36 value="<?php echo  $terms ?>"></td>

        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">RFQ ID</p></font></td>
            <td><span class="tabletext"><input type="text" name="rfqid" size=20  value="<?php echo  $rfqid ?>"></td>
           <td style='vertical-align: middle'><span class="labeltext"><p align="left">Excel File</td>
           <td><span class="tabletext"><input type="file" name="excelfile" value="<?php echo $excelfile?>"
             src="images/bu-browse.gif">
           </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Comments</p></font></td>
            <td><span class="tabletext"><input type="text" name="comments" size=50  value=""></td>
            <td><span class="labeltext"><p align="left">Get BOM&nbsp;</p></font></td>
            <td><input type="text" name="bomnum" style="background-color:#DDDDDD;" readonly="readonly" size=12 value="" >
	                  <img id="s" src="images/bu-getbom.gif" alt="Get BOM No" onclick="GetBomNo()">
            </td>
           <input type="hidden" name="bomrecnum" value="0">
           <input type="hidden" name="lockstatus" value="<?php echo  $lockstatus ?>">
        </tr>
<input type="hidden" name="quotetype" value="<?php echo  $quotetype ?>">
<input type="hidden" name="action" value="new">
<?php
 //echo "quotetype:$quotetype";
//$wotype="test2";
// $ctrls=$newpage->createjs4quote("Quote",$quotetype) ;
 //$ctrls=$newpage->createctrls("Quote",$quotetype) ;
//echo "$ctrls";
?>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Quote Line Items</b></center></td>
</tr>
<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">
<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
<tr bgcolor="#FFFFFF">


<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Item</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Description</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Unit Price</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Total</center></b></td>
 <tr>

<?php

      $i=1;
      while ($i<=5)
     {
	printf('<tr bgcolor="#FFFFFF">');
	$item="item" . $i;
	$itemdesc="item_desc" . $i;
	$quantity="quantity" . $i;
	$rate="rate" . $i;
	$amount="amount" . $i;
	echo "<td><span class=\"tabletext\"><input type=\"text\"  name=\"$item\"  value=\"\" size=\"10%\"></td>";
	echo "<td><input type=\"text\" name=\"$itemdesc\" size=\"60%\" value=\"\"></td>";
    echo "<td><input type=\"text\" name=\"$quantity\" size=\"10%\" value=\"\"></td>";
	echo "<td><input type=\"text\" name=\"$rate\" size=\"10%\" value=\"\"></td>";
	echo "<td><input type=\"text\" name=\"$amount\" style=\"background-color:#DDDDDD;\"
		  		readonly=\"readonly\" size=\"10%\" value=\"\"></td>";
	printf('</tr>');
	$i++;
    }
echo "<input type=\"hidden\" name=\"index\" value=$i>";

?>

        </table>
	</td>
    </tr>

     <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
          <td align="right"><span class="pageheading"><b></b></td><td width="12%"></td></tr>


         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Tax</p></font></td>
            <td colspan=3><input type="text" name="tax" size=10 value=""></td>
        </tr>

       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Shipping</p></font></td>
            <td colspan=3><input type="text" name="shipping" size=10 value=""></td>
        </tr>

      <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Labor</p></font></td>
            <td colspan=3><input type="text" name="labor" size=10 value=""></td>
        </tr>
      <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Misc</p></font></td>
            <td colspan=3><input type="text" name="misc" size=10 value=""></td>
        </tr>


 </tr>

</table>

</td>
		<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr> -->

		</table>
<span class="labeltext"><input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()">

      </FORM>
</table>
</body>
</html>
