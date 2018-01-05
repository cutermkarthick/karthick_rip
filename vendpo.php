<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: po.php                            =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Displays POs                                =
//==============================================

@session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'vendpo'; 
//////session_register('pagename');

// First include the class definition 
include_once('classes/userClass.php'); 
include_once('classes/poClass.php'); 
include_once('classes/displayClass.php');
$newPO = new po; 
$newdisp = new display; 
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>

<html>
<head>
<title>PO</title>
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
        					<td align="right"><a href="chPassword.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/chpwd_mo.gif',1)"><img name="Image15" border="0" src="images/chpwd.gif"></a>
        					<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
       				 </tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
			<tr><td></td></tr>
			<tr>
				<td>
					<?php $newdisp->dispLinks(''); ?>
					<table width=100% border=0 cellpadding=0 cellspacing=0  >
						<tr bgcolor="DEDFDE">
  							<td width="6"><img src="images/spacer.gif " width="6"></td>
							<td bgcolor="#FFFFFF">
								<table width=100% border=0 cellpadding=6 cellspacing=0  >
								<tr><td><span class="heading"><i>Please click on the PO link for details and to Edit/Delete</i></td></tr>
								<tr>
									<td>
									<tr><td><span class="pageheading"><b>Purchase Orders</b></td></tr>
									<tr><td>
									<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
									        <tr>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Seq #</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>PO #</b></td>
           <td bgcolor="#EEEFEE"><span class="heading"><b>Date</b></td>
           <td bgcolor="#EEEFEE"><span class="heading"><b>Description</b></td>
           <td bgcolor="#EEEFEE"><span class="heading"><b>Amount</b></td>
           <td bgcolor="#EEEFEE"><span class="heading"><b>Status</b></td>
                             
        </tr>
        
<?php

            
            $result = $newPO->getVendPOs($userid); 
        while ($myrow = mysql_fetch_row($result)) {
	      printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext"><a href="vendpoDetails.php?porecnum=%s">%s</td>
                          <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                           <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                           <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                           <td bgcolor="#FFFFFF"><span class="tabletext">$%.2f</td>
                           <td bgcolor="#FFFFFF"><span class="tabletext">%s</td></tr>',
		         $myrow[8],$myrow[8],
                         $myrow[0],
                         $myrow[1],
                         $myrow[2],
                         $myrow[6],
                         $myrow[7]);
              printf('</td></tr>');
        }
?>

</table>


</td></tr>



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


<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
	<td align=left>   
</td>
</tr></table>
</form>
</body>
</html>



