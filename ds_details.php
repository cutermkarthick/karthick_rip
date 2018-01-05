<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = march 20, 2007               =
// Filename: masterDetails.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Displays Master Details                     =
//                                             =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'ds_details';
//////session_register('pagename');

$dsrecnum = $_REQUEST['datarecnum'];

include('classes/dataClass.php');
include('classes/dataliClass.php');
include('classes/displayClass.php');

$newdisplay = new display;
$newDT = new data;
$newLI = new datasheet_line_items;
//$newLI = new master_line_items;

$result = $newDT->getdatadetails($dsrecnum);
$myrow = mysql_fetch_assoc($result);


?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/datasheet.js"></script>
<script language="javascript" src="scripts/mouseover.js"></script>

<html>
<head>
<title>Data Sheet Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
	<form >
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
    				<tr>
 	        				<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid;?></b></td>
        					<td align="right">&nbsp;<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
       				 </tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
			<tr><td></td></tr>
			<tr>
				<td>
			<?php $newdisplay->dispLinks(''); ?>
     		<table width=100% border=0 cellpadding=0 cellspacing=0  >
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/spacer.gif " width="6"></td>
								<td bgcolor="#FFFFFF">
									<table width=100% border=0 cellpadding=6 cellspacing=0  >
										<tr><td>
										       <table width=100% border=0>
											<tr>
												<td><span class="pageheading"><b>data Sheet Details</b></td>
                                                 <td>&nbsp;</td>
											         	<td bgcolor="#FFFFFF" rowspan=2 align="right">
											         	
											         	<a href ="edit_ds.php?dsrecnum=<?php echo $dsrecnum ?>" ><img name="Image8" border="0" src="images/bu_editdatamodel.gif" ></a>
                                                        <input type= "image" name="Print" src="images/bu-print.gif" value="Print" onclick="javascript: printdatasheet(<?php echo $dsrecnum ?>)">
												</td>
    											</tr>
										      </table>
										</td></tr>

										<tr>
											<td>
  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
												         <tr bgcolor="#FFFFFF">

  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
     <form>
            <td  bgcolor="#F5F6F5" width=100%><span class="heading"><center><b>Data Sheet</b></center></td>

       </tr>
        <tr bgcolor="#FFFFFF">
  <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <?php
            $d=substr($myrow['revdate'],8,2);
            $m=substr($myrow['revdate'],5,2);
            $y=substr($myrow['revdate'],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            $date=date("M j, Y",$x);
           // echo "$date";
          ?>
  
       <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF" width=25%><span class="labeltext">Opn Ref No.</td>
            <td  bgcolor="#FFFFFF" width=25%><span class="tabletext"><?php echo $myrow['opn_ref_no']?></td>
            <td  bgcolor="#FFFFFF" width=25%><span class="labeltext">Drg Issue</td>
            <td  bgcolor="#FFFFFF" width=25%><span class="tabletext"><?php echo $myrow['drg_issue']?></td>
       </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Work centre</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['work_center']?></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Opn No.</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['opnnum']?></td>
       </tr>
        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Part Number</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['partnum']?></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Attachments</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['attachments']?></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Rev No.</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['revnum']?></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Part Name</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['partname']?></td>
       </tr>

        <tr bgcolor="#FFFFFF">
            <td  bgcolor="#FFFFFF"><span class="labeltext">Part type</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow['parttype']?></td>
            <td  bgcolor="#FFFFFF"><span class="labeltext">Rev date</td>
            <td  bgcolor="#FFFFFF"><span class="tabletext"><?php echo $date?></td>
       </tr>
       
       <tr bgcolor="#FFFFFF">
            <td width="15%" bgcolor="#FFFFFF"><span class="tabletext"><b>Prepared By</b></td>
            <td bgcolor="#FFFFFF" width="10%"><span class="tabletext"><?php echo $myrow['prepared_by']?> </td>
            <td bgcolor="#FFFFFF" width="10%"><span class="tabletext"><b>Approved By</b></td>
            <td bgcolor="#FFFFFF" width="10%"><span class="tabletext"><?php echo $myrow['approved_by']?></td>
       </tr>
       
       <tr bgcolor="#FFFFFF">
            <td bgcolor="#FFFFFF" width="10%"><span class="tabletext"><b>Issue NO.</b></td>
            <td bgcolor="#FFFFFF" width="10%"><span class="tabletext"><?php echo $myrow['issuenum']?></td>
            <td bgcolor="#FFFFFF" width="10%"><span class="tabletext"><b>Sheet</b></td>
            <td bgcolor="#FFFFFF" width="10%"><span class="tabletext"></td>
       </tr>
       
       <tr bgcolor="#FFFFFF">
             <td bgcolor="#FFFFFF" width="10%"><span class="tabletext"><b>Total Time</b></td>
             <td bgcolor="#FFFFFF" width="10%" colspan=3><span class="tabletext"></td>
       </tr>

      </table>

 <br>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

    <tr bgcolor="#DDDEDD">
        <td colspan=15><span class="heading"><center><b>Data Sheet Line Items</b></center></td>
       </tr>
         <input type="hidden" name="datarecnum" value="<?php echo $dsrecnum ?>">


       <tr>
            <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b>linenum</b></td>
            <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b>tool_details</b></td>
            <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b>tool_length</b></td>
            <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b>speed</b></td>
            <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b>feed</b></td>
            <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b>opn_desc</b></td>
            <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b>cnc_pgm_name</b></td>
            <td bgcolor="#EEEFEE" colspan=2><span class="heading"><b>Est Time</b></td>


       </tr>

<?php



        $i = 0;
        $result = $newLI->getLI($dsrecnum);
        while ($myLI = mysql_fetch_assoc($result)) {

              $i = $i + 1;
	      printf('<tr><td colspan=2 bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                          <td bgcolor="#FFFFFF" colspan=2><span class="tabletext">%s</td>
                          <td bgcolor="#FFFFFF" colspan=2><span class="tabletext">%s</td>
                          <td bgcolor="#FFFFFF" colspan=2><span class="tabletext">%s</td>
                          <td bgcolor="#FFFFFF" colspan=2><span class="tabletext">%s</td>
                          <td bgcolor="#FFFFFF" colspan=2><span class="tabletext">%s</td>
                          <td bgcolor="#FFFFFF" colspan=2><span class="tabletext">%s</td>
                          <td bgcolor="#FFFFFF" colspan=2><span class="tabletext">%s</td>

                       ',
		                  $myLI["linenum"],
                          $myLI["tool_details"],
                          $myLI["tool_length"],
                          $myLI["speed"],
                          $myLI["feed"],
                          $myLI["opn_desc"],
                          $myLI["cnc_pgm_name"],
                          $myLI["est_time"]);
        }

?>


		   	</table>
	</td>
	</tr>
       <tr>
           <td> </td>
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
						<table border = 0 cellpadding=0 cellspacing=0 width=100% >
							<tr>
								<td align=left>

								</td>
							</tr>
						</table>
					</FORM>
		</body>
</html>
