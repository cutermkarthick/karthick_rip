<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: company.php                       =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Displays list of comapnies.                 =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'newquote1';
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/companyClass.php');
include('classes/quoteClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newPages = new page;
$newQuote = new quote;
$newdisplay = new display;
$newCustomer = new company;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/quote.js"></script>
<script language="javascript" src="scripts/quote1.js"></script>

<html>
<head>
<title>Sales</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='newquote1.php?scompany=$company_match&company_oper=$oper&sortfld1=$sort1&scompanyfl=$where1' method='post' enctype='multipart/form-data'>
<?php
	include('header.html');
?>
<table width=100% cellspacing="1" cellpadding="0" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="8">
    				<tr>
       					 <td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        					<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/logout_mo.gif',1)"><img name="Image15" border="0" src="images/logout.gif"></a></td>
    				</tr>
     			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
						<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>New Quote</b></td>
    </tr>


     <form action='quoteDetailsEntry.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Quote ID</p></font></td>
            <td><span class="tabletext"><input type="text" name="quoteid" size=20 value=""></td>
            <td><span class="labeltext"><p align="left">Quote Date</p></font></td>
            <td><input type="text" name="quotedate"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="">
             <img src="images/bu-getdate.gif" alt="Get QuoteDate"                                                   onclick="GetQuoteDate()">
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Customer</p></font></td>

            <td><input type="text" name="company"
                    style=";background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="">
             <img src="images/bu-getcustomer.gif" alt="Get Customer"                                                   onclick="GetAllCustomers()">
            </td>
            <td><span class="labeltext"><p align="left">Sales Person</p></font></td>
            <td><input type="text" name="salesperson"
                            style=";background-color:#DDDDDD;"
                    readonly="readonly" size=18 value="">
             <img src="images/bu-getemployee.gif" alt="Get Employee" onclick='GetAllEmps()'>
            </td>

            <input type="hidden" name="salespersonrecnum">
            <input type="hidden" name="companyrecnum">
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Quote Description</p></font></td>
            <td colspan=3><input type="text" name="desc" size=36 value=""></td>
        </tr>

        <tr bgcolor="#FFFFFF">

            <td><span class="labeltext"><p align="left">Delivary Date</p></font></td>
            <td><input type="text" name="delivarydate"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=20 value="">
             <img src="images/bu-getdate.gif" alt="Get QuoteDate"                                                   onclick="GetDueDate()">
            </td>
            <td><span class="labeltext"><p align="left">Terms</p></font></td>
            <td><input type="text" name="terms" size=36 value=""></td>

        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">RFQ ID</p></font></td>
            <td><span class="tabletext"><input type="text" name="rfqid" size=20  value=""></td>
           <td style='vertical-align: middle'><span class="labeltext"><p align="left">Excel File</td>
           <td><span class="tabletext"><input type="file" name="excelfile"
             src="images/bu-browse.gif">
           </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Comments</p></font></td>
            <td colspan=3><span class="tabletext"><input type="text" name="comments" size=70  value=""></td>
        </tr>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Select Quote Type</b></td>
<td colspan=3 bgcolor="#FFFFFF"><span class="tabletext"><select name="quotetype" size="1" width="100"  onchange="onSelectparent()">
<?php
	//echo "i am here";
	$result = $newPages->getPages4parent("Quote");
	while ($myrow = mysql_fetch_row($result))
       	{
		echo"<option value>$myrow[1]";
	}
?>
</td>
<input type="hidden" name="quotetypeval" value="Quote">

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
<span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Next" name="submit" onclick="javascript: return setquotetype()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">

      </FORM>
</table>



</body>
</html>