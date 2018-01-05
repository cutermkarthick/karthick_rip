<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: edit_quote.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com
// Revision: v1.0 OMS                          =
// Allows editing of quotes                    =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'editquote'; 
//session_register('pagename');
$quoteid = $_REQUEST['quoteid'];

// First include the class definition 
include('classes/userClass.php'); 
include_once('classes/quoteClass.php'); 
include_once('classes/displayClass.php'); 
$newQuote = new quote; 
$newdisp = new display; 

// First include the class definition 

$result = $newQuote->getQuote($quoteid);
$myrow = mysql_fetch_row($result);
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/quote.js"></script>

<html>
<head>
<title>Edit Quote</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr> 
        					<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        <td colspan=9 align="right" width="7%"><a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image20','','images/logout_mo.gif',1)"><img name="Image20" border="0" src="images/logout.gif"></a></td>
        				 </tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisp->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >

<form action='quote_upload.php' method='post' enctype='multipart/form-data'>

<tr>        <td><span class="pageheading"><b>Edit Quote</b></td>
       
</tr>
    
<tr>
<td>
  												
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
         
     
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Quote ID</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[0] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Quote Description</p></font></td>
            <td><input type="text" name="desc" size=30 value="<?php echo $myrow[2] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Quote Date</p></font></td>
            <td><input type="text" name="quotedate" 
                    style="background-color:#DDDDDD;" 
                    readonly="readonly" size=20 value="<?php echo $myrow[5] ?>">
             <img src="images/bu-getdate.gif" alt="Get QuoteDueDate"                                                   onclick="GetQuoteDate()">
            </td>

        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Company</p></font></td>
            <td><input type="text" name="company" 
                    style=";background-color:#DDDDDD;" 
                    readonly="readonly" size=20 value="<?php echo $myrow[1] ?>">
             <img src="images/bu-getcustomer.gif" alt="Get Customer"                                                   onclick="GetAllCustomers()">
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">RFQ ID</p></font></td>
            <td><input type="text" name="rfqid" size=30 value="<?php echo $myrow[4] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Excel File</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[3] ?>
                                           
        </tr>
         <input type="hidden" size=30 name="quoteid" value="<?php echo $myrow[0] ?>">
         <input type="hidden" size=30 name="deleteflag" value="">
        </tr>
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

        <br> 
        <span class="tabletext"><input type="submit" 
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                    <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">
        
      </FORM>
</table>



</body>
</html>