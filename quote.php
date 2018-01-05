<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: quote1.php                        =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Displays quotes                             =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'quote';
//session_register('pagename');

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/quoteClass.php');
include_once('classes/displayClass.php');
$newQuote = new quote;
$newdisplay = new display;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>

<html>
<head>
<title>Quote</title>
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

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>List of Quotes</b></td>
    </tr>

<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr  bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Quote</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Date</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Sales Person</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Company</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Description</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Excel file</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>RFQ ID</b></td>

        </tr>


<?php


            $result = $newQuote->getQuotes();
        while ($myrow = mysql_fetch_row($result)) {
   	       printf('<tr bgcolor="#FFFFFF"><td ><span class="tabletext">
                           <a href="quoteDetails.php?typenum=%s&quotetype=%s&quoterecnum=%s">%s</td>

                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext">%s</td>
                          <td><span class="tabletext"><a href=%s>%s</a></td>
                          <td><span class="tabletext">%s</td>',
		         $myrow[8],$myrow[7],$myrow[6],$myrow[0],
                         $myrow[5],
                         $myrow[9].' '.$myrow[10],
                         $myrow[1],
                         $myrow[2],
                          "quotes/" . $myrow[3],$myrow[3],
                         $myrow[4]);

              printf('</td></tr>');
        }
?>

</table>

        <tr>


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


</table>



</body>
</html>