<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2006                =
// Filename: quoteDetailsEdit.php              =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows editing of Quote.                    =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'quoteDetailsEdit';
$page = "CRM: Quote";
//session_register('pagename');
// First include the class definition
include_once('classes/loginClass.php');
include('classes/companyClass.php');
include('classes/userClass.php');
include('classes/quoteClass.php');
include('classes/quoteliClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');
include('classes/empClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$newCustomer = new company;
$newdisp = new display;
$result = $newCustomer->getAllCustomers();
$newEmp = new emp;
$employees = $newEmp->getAllEmps();

 if (isset($_REQUEST['quoterecnum']))
{
	$quoterecnum=$_REQUEST['quoterecnum'];
	$_SESSION['quoterecnum'] = $quoterecnum;
	//session_register('quoterecnum');
}

$userid = $_SESSION['user'];
$newpage = new page;
$newQuote = new quote;
$quoteli = new quoteli;
$newdisplay = new display;
$newCustomer = new company;

//$typenum = $_SESSION['typenum'];
//$quotetype = $_SESSION['quotetype'];
$quoterecnum = $_REQUEST['quoterecnum'];

$QI = $quoteli->getQI($quoterecnum);
$result = $newQuote->getQuote($quoterecnum);
$myrow = mysql_fetch_row($result);

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/salesquote.js"></script>

<html>
<head>
<title>Quote Details Edit</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processGenericQuote.php' method='post' enctype='multipart/form-data'>
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
	<tr>
	  <td>
<?php
  $newdisplay->dispLinks('');
?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
  <tr bgcolor="DEDFDE">
  	<td width="6"><img src="images/spacer.gif " width="6"></td> -->
	<td bgcolor="#FFFFFF">
		<table width=100% border=0 cellpadding=3 cellspacing=0  >
		<tr><td>
	<table width=100% border=0>
        <td><span class="pageheading"><b>Edit Quote</b></td>
           <td colspan=20>&nbsp;</td>
	       <td bgcolor="#FFFFFF" align="right"><input type= "image" name="Delete" src="images/bu-delete.gif" value="Get" onclick="javascript: return ConfirmDelete()">
	    </td>
    <input type="hidden" name="deleteflag" value="">
    </table>
   <tr>
<td>
	<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Quote Header</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Quote ID</p></font></td>
            <td><span class="tabletext"><input type="text" name="quoteid" size=20 style="background-color:#DDDDDD;" 
                       readonly="readonly" value="<?php echo $myrow[0]?>"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Quote Date</p></font></td>
            <td><input type="text" name="quotedate"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo $myrow[1]?>">
              <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('quotedate')">
              <input type="hidden" name="quoterecnum" value="<?php echo $myrow[0] ?>">
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>

            <td><input type="text" name="company"
                    style=";background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo $myrow[2]?>">
             <img src="images/bu-getcustomer.gif" alt="Get Customer" onclick="GetAllCustomers()">
            </td>

            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Sales Person</p></font></td>
            <td><input type="text" name="salesperson"
                            style=";background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo $myrow[12].' '.$myrow[13] ?>">
             <img src="images/bu-getemployee.gif" alt="Get Employee" onclick='GetAllEmps()'>
            </td>

            <input type="hidden" name="salespersonrecnum" value=<?php echo $myrow[15]?>>
            <input type="hidden" name="companyrecnum">
          <input type="hidden" name="parentquoteid" value=<?php echo $myrow[24] ?>>
          <input type="hidden" name="revisionnum" value=0>


        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Quote Description</p></font></td>
            <td><input type="text" name="desc" size=36 value="<?php echo $myrow[3]?>"></td>
             <td><span class="labeltext"><p align="left">Currency</p></font></td>
             <td><span class="labeltext"><input type="text" name="currency" size="12" value="<?php echo $myrow[11]?>">
             <span class="labeltext"><select name="currency1" size="1" width="100" onchange="onSelectcurrency()">
             <option selected>$ </option>
             <option value>Rs </option>
             </select>
             </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Delivery Date</p></font></td>
            <td><input type="text" name="delivarydate"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="<?php echo $myrow[6]?>">
             <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('delivarydate')">
            </td>
            <td><span class="labeltext"><p align="left">Terms</p></font></td>
            <td><input type="text" name="terms" size=36 value="<?php echo $myrow[7]?>"></td>

        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">RFQ ID</p></font></td>
            <td><span class="tabletext"><input type="text" name="rfqid" size=20  value="<?php echo $myrow[5]?>"></td>
           <td style='vertical-align: middle'><span class="labeltext"><p align="left">Excel File</td>
           <td><span class="tabletext"><input type="file" name="excelfile"
             src="images/bu-browse.gif">
           </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Comments</p></font></td>
            <td><span class="tabletext"><input type="text" name="comments" size=70  value="<?php echo  $myrow[10] ?>"></td>
            <td><span class="labeltext"><p align="left">Get BOM&nbsp;</p></font></td>
            <td><input type="text" name="bomnum" style="background-color:#DDDDDD;" readonly="readonly" size=12 value="<?php echo  $myrow[22] ?>" >
	                  <img id="s" src="images/bu-getbom.gif" alt="Get BOM No" onclick="GetBomNo()">
            </td>
           <input type="hidden" name="bomrecnum" value="<?php echo  $myrow[23] ?>">
        </tr>


        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">Quote Type</p></font></td>
          <td><span class="tabletext"><input type="text" name="quotetype" size=20  value="<?php echo $myrow[9]?>"></td>
          <td><span class="labeltext"><p align="left">Status</p></font></td>
          <td><span class="tabletext">
          <input type="text" name="lockstatus" size=20  value="<?php echo $myrow[26]?>">
                                     <span class="labeltext"><select name="lockstatus1" width="100" onchange="onSelectstatus1()">
             <option selected>Not Locked </option>
             <option value>Locked</option>
             </select>
          </tr>
        <input type="hidden" name="quotetypeval" value="board">
        <input type="hidden" name="quotetype1" value="<?php echo $quotetype?>">
        <input type="hidden" name="action" value="edit">
<?php
//echo "$quotetype:$quoterecnum";
// $ctrls=$newpage->createctrls4edit("Quote",$quotetype,$myrow[8]) ;
//echo "$ctrls";

?>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b> Line Items</b></center></td>
</tr>
<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">

<tr bgcolor="#FFFFFF"><td><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a>
<td colspan=4 bgcolor="#FFFFFF"><span class="tabletext">To delete line items - blankout line number</td></tr>

<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Item</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Description</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Qty</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Unit Price</center></b></td>
<td bgcolor="#EEEFEE"><span class="heading"><b><center>Total</center></b></td>
</tr>
<?php
	$i=1;
	while ($myQI = mysql_fetch_row($QI))
 {
		printf('<tr bgcolor="#FFFFFF">');
		$item="item" . $i;
		$itemdesc="item_desc" . $i;
		$quantity="quantity" . $i;
		$rate="rate" . $i;
		$amount="amount" . $i;
		$previtem="previtem" . $i;
		$birecnum="birecnum" . $i;
		echo "<td ><span class=\"tabletext\"><input type=\"text\"  name=\"$item\"  value=\"$myQI[1]\" size=\"10%\"></td>";
		echo "<td><input type=\"text\" name=\"$itemdesc\" size=\"60%\" value=\"$myQI[2]\"></td>";
                echo "<td><input type=\"text\" name=\"$quantity\" size=\"10%\" value=\"$myQI[3]\"></td>";
		printf ('<td><input type="text" name="%s" size="%s" value="%.2f"></td>',$rate,"10%",$myQI[4]);
		echo "<input type=\"hidden\" name=\"$previtem\" value=\"$myQI[1]\">";
		echo "<input type=\"hidden\" name=\"$birecnum\" value=\"$myQI[0]\">";
		printf ('<td><input type="text" name="%s" style="background-color:#DDDDDD;" readonly="readonly" size="%s" value="%.2f"></td>',$amount,"10%",$myQI[5]);
		printf('</tr>');
		$i++;
	}
	//$i--;
	echo "<input type=\"hidden\" name=\"index\" value=$i>";
?>

	</td>
    </tr>
  </table>

       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
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
            <td><p align="right"><input type="text" name="tax" value="<?php echo  $myrow[18] ?>"></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Labor</p></font></td>
            <td><p align="right"><input type="text" name="labor" value="<?php echo  $myrow[20] ?>"></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Shipping</p></font></td>
            <td><p align="right"><input type="text" name="shipping" value="<?php echo  $myrow[19] ?>"></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Misc</p></font></td>
            <td><p align="right"><input type="text" name="misc" value="<?php echo  $myrow[21] ?>"></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="right">Total Due</p></font></td>
            <td align="right"><span class="tabletext">
            <?php
             $totaldue=$myrow[16]+$myrow[18]+$myrow[19]+$myrow[20]+$myrow[21];
             printf('%s %.2f</td>',$myrow[11],$totaldue);
               
            ?>
        </tr>





</table>

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
