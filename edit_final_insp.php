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

$_SESSION['pagename'] = 'edit_final_insp';
$page = "QA: Final Insp";
//////session_register('pagename');


// First include the class definition
include('classes/userClass.php');
include('classes/Final_insp_reportClass.php');
include('classes/Final_insp_reportliClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newFIR = new final_insp_report;
$newLI = new final_insp_reportli;

$final_insprecnum = $_REQUEST['final_insprecnum'];

$result = $newFIR->getFinal_insp($final_insprecnum);
$myrow = mysql_fetch_assoc($result);
$myFI = $newLI->getLI($final_insprecnum);
$myFI1= $newLI->getLI($final_insprecnum);
$myFI2 = $newLI->getLI($final_insprecnum);



?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/final_insp.js"></script>


<html>
<head>
<title>Edit Final Inspection</title>
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
        <td>
        <table width=100% border=0>
	<td width="100%"><span class="pageheading"><b>Edit Final Inspection</b></td>
    <td colspan=20>&nbsp;</td>
    </table>
        </td>
    </tr>


     <form action='processFinal_insp_report.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Final Inspection Header</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Id No.</p></font></td>
            <td><input type="text" name=recnum size=20 value="<?php printf ("%05d",$myrow['recnum'])?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
            <td colspan=2>&nbsp</td>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>WO No.</p></font></td>
            <td><input type="text" name="wonum" size=20 value="<?php echo $myrow['wonum']?>" style=";background-color:#DDDDDD;" readonly="readonly">
                <img src="images/getwo.gif" alt="Get Customer" onclick="Getwo_qa()"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Host Ref Num.</p></font></td>
            <td><span class="tabletext"><input type="text" name="refnum" size=20 value="<?php echo $myrow['refnum']?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
                <input type="hidden" name="final_insprecnum" value="<?php echo $final_insprecnum ?>"></td>
         </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
            <td><input type="text" name="customer" size=20 value="<?php echo $myrow['customer']?>" style=";background-color:#DDDDDD;" readonly="readonly">
                <input type="hidden" name="custrecnum"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO No.</p></font></td>
            <td><input type="text" name="ponum" size=20 value="<?php echo $myrow['ponum']?>" style=";background-color:#DDDDDD;" readonly="readonly">
                <input type="hidden" name="porecnum"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td><input type="text" name="partname" size=20 value="<?php echo $myrow['partname']?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left">Part No.</p></font></td>
            <td><input type="text" name="partnum" size=20 value="<?php echo $myrow['partnum']?>"style=";background-color:#DDDDDD;" readonly="readonly">
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Bill No.</p></font></td>
            <td><input type="text" name="billnum" size=20 value="<?php echo $myrow['billnum']?>"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Bill Date</p></font></td>
            <td><input type="text" name="billdate" size=10 value="<?php echo $myrow['billdate']?>" style=";background-color:#DDDDDD;" readonly="readonly"><img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('billdate')"></td>
        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Issue</p></font></td>
            <td><input type="text" name="issue" size=20 value="<?php echo $myrow['issue']?>"></td>
            <td><span class="labeltext"><p align="left">Report No.</p></font></td>
            <td><input type="text" name="reportnum" size=20 value="<?php echo $myrow['reportnum']?>"></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Page.</p></font></td>
            <td><input type="text" name="page" size=20 value="<?php echo $myrow['page']?>"></td>
            <td><span class="labeltext"><p align="left">Qty.</p></font></td>
            <td><span class="tabletext"><input type="text" name="qty" size=20 value="<?php echo $myrow['qty']?>"></td>
        </tr>

<input type="hidden" name="quotetype" value="<?php echo  $quotetype ?>">
<input type="hidden" name="action" value="edit">
<?php
 //echo "quotetype:$quotetype";
//$wotype="test2";
// $ctrls=$newpage->createjs4quote("Quote",$quotetype) ;
 //$ctrls=$newpage->createctrls("Quote",$quotetype) ;
//echo "$ctrls";
?>
<tr bgcolor="#DDDEDD">
<td colspan=4><span class="heading"><center><b>Final Inspection Line Items</b></center></td>
</tr>

<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
<tr bgcolor="#FFFFFF">


<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
<tr>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Sl</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>DRG</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>DIM</center></b></td>
   <td bgcolor="#EEEFEE"><span class="heading"><b><center>Dimensions</center></b></td>
   <td bgcolor="#EEEFEE" colspan=3><span class="heading"><b><center>Actual Dimensions</center></b></td>
   <td bgcolor="#EEEFEE" width=1><span class="heading"><b><center>Accept/</center></b></td>
</tr>
<tr>

<?php

     $i = 1;
    while ($FI = mysql_fetch_assoc($myFI))
    {
      if($i == 1)
      {


         $slnum1 = $FI['slnum1'];
         $slnum2 = $FI['slnum2'];
         $slnum3 = $FI['slnum3'];


        echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b><center>No.</center></b></td>";
        echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b><center>Sheet</center></b></td>";
        echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b><center>Map</center></b></td>";
        echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b><center>Main View</center></b></td>";
        echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b><span class='asterisk'>*</span>Sl No.</b><input type=\"text\" name=\"slnum1\" size=10 value=\"$slnum1\"></td>";
        echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b>Sl No</b><input type=\"text\" name=\"slnum2\" size=10 value=\"$slnum2\"></td>";
        echo "<td bgcolor=\"#EEEFEE\"><span class=\"heading\"><b>Sl No.</b><input type=\"tex\" name=\"slnum3\" size=10 value=\"$slnum3\"></td>";
        echo "<td bgcolor=\"#EEEFEE\" width=1><span class=\"heading\"><b><center>Reject</center></b></td>";
      }
     $i++;
  }
?>

</tr>

<?php

      $i=1;
     while ($FI = mysql_fetch_assoc($myFI1))
    {
    $slno="slno" . $i;
	$sheet="sheet" . $i;
	$map="map" . $i;
	$main_view="main_view" . $i;
	$actual_dim1="actual_dim1" . $i;
	$actual_dim2="actual_dim2" . $i;
	$actual_dim3="actual_dim3" . $i;
	$accpt_reject="accpt_reject" . $i;
	$prevlinenum="prev_line_num" . $i;
	$lirecnum="lirecnum" . $i;

	printf('<tr bgcolor="#FFFFFF">');
	
	$recnum = $FI['recnum'];
    $sn = $FI["slno"];
	$sht = $FI["sheet"];
	$mp = $FI["map"];
    $mview = $FI["main_view"];
    $act_dim1 = $FI["actual_dim1"];
    $act_dim2 = $FI["actual_dim2"];
    $act_dim3 = $FI["actual_dim3"];
    $accp_rjct = $FI["accpt_reject"];

    echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$sn\">";
    echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$recnum\">";
	echo "<td><span class=\"tabletext\"><input type=\"text\"  name=\"$slno\"  value=\"$sn\" size=\"10\"></td>";
	echo "<td><input type=\"text\" name=\"$sheet\" size=\"10\" value=\"$sht\"></td>";
    echo "<td><input type=\"text\" name=\"$map\" size=\"15\" value=\"$mp\"></td>";
	echo "<td><input type=\"text\" name=\"$main_view\" size=\"10\" value=\"$mview\"></td>";
	echo "<td><input type=\"text\" name=\"$actual_dim1\" size=\"10\" value=\"$act_dim1\"></td>";
    echo "<td><input type=\"text\" name=\"$actual_dim2\" size=\"10\" value=\"$act_dim2\"></td>";
    echo "<td><input type=\"text\" name=\"$actual_dim3\" size=\"10\" value=\"$act_dim3\"></td>";
    echo "<td><input type=\"text\" name=\"$accpt_reject\" size=\"10\" value=\"$accp_rjct\"></td>";
	printf('</tr>');
	$i++;
    }
echo "<input type=\"hidden\" name=\"index\" value=$i>";

?>

        </table>
	</td>
    </tr>

     <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF"  class="stdtable1">

<?php

$i=1;

   while ($FI = mysql_fetch_assoc($myFI2))
   {
     if($i ==1)
     {
     

?>

            <tr bgcolor="#FFFFFF">
            <td align=centre width=45%><span class="labeltext"><p align="centre">Inspected By:</p></font></td>
            <td width='45px'><span class="labeltext"><input type="text" name="insp_by1" size=10 value="<?php echo $FI['insp_by1']?>"></td>
            <td width='45px'><span class="labeltext"><input type="text" name="insp_by2" size=10 value="<?php echo $FI['insp_by2']?>"></td>
            <td width='45px' ><span class="labeltext"><input type="text" name="insp_by3" size=10 value="<?php echo $FI['insp_by3']?>"></td>
             <td width='45px'>&nbsp;</td>
        </tr>

       <tr bgcolor="#FFFFFF">
            <td align=centre width=45%><span class="labeltext"><p align="centre">Inspected Date:</p></font></td>
            <td width='50px'><span class="labeltext"><input type="text" name="insp_date1" size=10  style="background-color:#FFF8C6;" readonly="readonly"value="<?php echo $FI['insp_date1']?>">
                                        <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('insp_date1')"></td>
            <td width='50px'><span class="labeltext"><input type="text" name="insp_date2" size=10  style="background-color:#FFF8C6;" readonly="readonly" value="<?php echo $FI['insp_date2']?>">
                                       <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('insp_date2')"></td>
            <td width='50px'><span class="labeltext"><input type="text" name="insp_date3" size=10  style="background-color:#FFF8C6;" readonly="readonly" value="<?php echo $FI['insp_date3']?>">
                                        <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('insp_date3')"></td>
             <td width='50px'>&nbsp;</td>
       </tr>
       
<?php
   }
   $i++;
}
?>
       <tr bgcolor="#FFFFFF">
                   <td align=centre><span class="labeltext"><p align="centre">Approved By:</p></td>
           <td width='45px'><span class="labeltext"><input type="text" name="approved_by" size=10 value="<?php echo $myrow['approved_by']?>"></td>
            <td width='45px'><span class="labeltext">Approved Date:</td>
            <td width='45px'><span class="labeltext"><input type="text" name="approved_date" size=10  style="background-color:#FFF8C6;" value="<?php echo $myrow['approved_date']?>">
                                      <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('approved_date')"></td>
             <td width='45px'>&nbsp;</td>
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
			</tr>
 -->
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
