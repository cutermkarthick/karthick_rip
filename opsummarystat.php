<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Oct 9, 2013                  =
// Filename: opsummarystat.php                 =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 WMS                          =
// Displays Operator Summary stats             =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
//////session_register('pagename');

// First include the class definition
include_once('classes/reportClass.php');
include_once('classes/displayClass.php');

$newdisplay = new display;
$newQA = new report;

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/qa4efficiency.js"></script>
<html>
<head>
<title>Operator Summary Stats</title>
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
     <tr><td>
		</tr>
  <tr>
<td>



<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr  bgcolor="#FFCC00">
            <td align="center"  bgcolor="#EEEFEE"><span class="tabletext"><b>Operator</b></td>
            <td align="center"  bgcolor="#EEEFEE"><span class="tabletext"><b>Emp Code</b></td>
            <td align="center"  bgcolor="#EEEFEE"><span class="tabletext"><b>PRNs worked</b></td>
            <td align="center"  bgcolor="#EEEFEE"><span class="tabletext"><b>Qty Produced</b></td>
            <td align="center"  bgcolor="#EEEFEE"><span class="tabletext"><b>PRNs rejected</b></td>
            <td align="center"  bgcolor="#EEEFEE"><span class="tabletext"><b>Qty Rejected</b></td>
        </tr>

<?php
         $prevoper = '';
         $result = $newQA->getopsummarystats();
         while($myrow=mysql_fetch_row($result))
         {
              if (is_null($myrow[1]))
			  {
  	               printf('<tr bgcolor="#FFFFFF">
                          <td align="center"><span class="tabletext">%s</td>
                          <td align="center"><span class="tabletext">%s</td>
                          <td align="center"><span class="tabletext">%s</td>
                          <td align="center"><span class="tabletext">%s</td>
                          <td align="center"><span class="tabletext">%s</td>
                          <td align="center"><span class="tabletext">%s</td>
                          ',
                          $myrow[0],
		          $myrow[4],
                          $numcrns,
                          $myrow[2],
		          $numrejcrns,
                          $myrow[3]
                         );
                     printf('</td></tr>');
					 $numcrns = 0;
					 $numrejcrns = 0;
			   }
			   else
			   {
			      $numcrns++;
			      if ($myrow[3] > 0)
			      {
				      //echo "<br>here in numrej = $myrow[3] and name = $myrow[0]";
				      $numrejcrns++;
			      }
		       }
        }
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
        <table border = 0 cellpadding=0 cellspacing=0 width=100% >
							<tr>
								<td align=left>

<?php



?>
								</td>
							</tr>


						</table>
</body>
</html >

