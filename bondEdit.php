<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Apr 23, 2012                 =
// Filename: consumptionEdit.php               =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Edit stock consumption                      =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'consumptioreport';
//////session_register('pagename');
$bondnum=$_REQUEST['bondnum'];
// First include the class definition
include_once('classes/userClass.php');
//include_once('classes/reportClass.php');
include_once('classes/displayClass.php');
include_once('classes/consumptionClass.php');

//$newlogin = new userlogin;
//$newlogin->dbconnect();

//$newreport = new report;
$newconsumption = new consumption;
$newdisplay = new display;

$result = $newconsumption->getbond4edit($bondnum);
$result_bnd = $newconsumption->getbond4edit($bondnum);
//$myrow = mysql_fetch_row($result);

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>

<html>
<head>
<title>Stock Consumption Edit</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
     <form action='bondProcess.php' method='post' enctype='multipart/form-data'>
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
       				<a href="exit.php" onMouseOut="MM_swapImgRestore()"
                       onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        		</tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
				<td>
				<?php
   				     $newdisplay->dispLinks('');
				?>
		<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr bgcolor="DEDFDE">
	<td width="6"><img src="images/spacer.gif " width="6"></td>
 <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellspacing=4 >
	<tr><td>
 <table width=100% border=0>
	<td width="100%"><span class="pageheading"><b>Bond Edit</b></td>
	<td><a href="exportBondregister.php?bondnum=<?php echo $bondnum ?>"><img name="Image8" border="0" src="images/export.gif" ></a>
</td>
    </table>

  <tr>
<td>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
 <tr bgcolor="#DDDEDD">
    <td colspan=4><span class="heading"><center><b>Bond Information</b></center></td>
        </tr>
</table>
<?php
           $flag = 0;
	       $prevgrnnum="#";  $closingbal=0;
           $close_bal=0; $qty_recd=0;$qty_cons=0;$wastage=0;

            while ($myrow_bnd = mysql_fetch_array($result_bnd))
			{
				if ($flag ==0 )
			    {
					$flag = 1;

?>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
        <tr  bgcolor="#FFFFFF">
              <td><span class="labeltext"><p align="left"><b>BOND #</p></font></td>
      		<td><input type="text" name="bond_num"  id="bond_num"
        size=20 value="<?php echo $myrow_bnd['bond_num'] ?>" >
                </td>
		<input type="hidden" name="prevbondnum" id="prevbondnum" value="<?php echo $myrow_bnd['bond_num'] ?>"></td>
                <td><span class="labeltext"><p align="left"><b>Bond Date</p></font></td>
            		<td><input type="text" name="bonddate"  id="bonddate"
                               size=20 value="<?php echo $myrow_bnd['bonddate'] ?>" style="background-color:#DDDDDD;" readonly="readonly">

                               <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("bonddate")'>
                    </td>

                  </tr>
                  <tr  bgcolor="#FFFFFF">
                    			<td><span class="labeltext"><p align="left">Status</p></font></td>
    <td colspan=3><span class="tabletext"><input type="text" name="status" id="status"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow_bnd[10] ?>"

	<span class="tabletext"><select name="consstat" size="1" onchange="onSelectStatus(this)">
 	<option selected>Please Specify
	<option value="Open">Open
	<option value="Closed">Closed
	</select></td>
                  </tr>
<?php
				}
				}
?>
</table>
      <table style="table-layout: fixed" width=1785px border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
      <tr>
         <td width="70px"  bgcolor="#EEEFEE"><span class="tabletext"><b>BE #</b></td>
			<td width="60px"  bgcolor="#EEEFEE"><span class="tabletext"><b>BE<br>Dt</b></td>
			<td   width="60px" bgcolor="#EEEFEE"><span class="tabletext"><b>Assess.<br>Value</b></td>
			<td   width="60px" bgcolor="#EEEFEE"><span class="tabletext"><b>CIF<br>Value</b></td>
			<td  width="60px"  bgcolor="#EEEFEE"><span class="tabletext"><b>Duty<br>Amount</b></td>
		    <td  width="70px" bgcolor="#EEEFEE"><span class="tabletext"><b>Invoice #</b></td>
            <td  bgcolor="#EEEFEE" width="60px"><span class="tabletext"><b>Inv Dt</b></td>
            <td  width="80px" bgcolor="#EEEFEE"><span class="tabletext"><b>Inv Amt</b></td>
            <td width="70px" bgcolor="#EEEFEE"><span class="tabletext"><b>Export<br>Invoice#</b></td>
            <td  bgcolor="#EEEFEE" width="125px"><span class="tabletext"><b>Supplier</b></td>
			<td  bgcolor="#EEEFEE" width="60px"><span class="tabletext"><b>GRN #</b></td>
            <td  bgcolor="#EEEFEE" width="60px"><span class="tabletext"><b>GRN Dt</b></td>
            <td  bgcolor="#EEEFEE" width="60px"><span class="tabletext"><b>PRN #</b></td>
            <td  bgcolor="#EEEFEE" width="125px"><span class="tabletext"><b>RM Spec</b></td>
            <td  bgcolor="#EEEFEE" width="80px"><span class="tabletext"><b>RM Type</b></td>
             <td width="30px" bgcolor="#EEEFEE"><span class="tabletext"><b>UOM</b></td>
             <td width="30px" bgcolor="#EEEFEE"><span class="tabletext"><b>Qty</b></td>
            <td  width="30px" bgcolor="#EEEFEE"><span class="tabletext"><b>Qty <br>Recd</b></td>
            <td  width="30px" bgcolor="#EEEFEE"><span class="tabletext"><b>Qty <br>Rej</b></td>
            <td width="50px" bgcolor="#EEEFEE"><span class="tabletext"><b>Cofc #</b></td>
            <td width="30px" bgcolor="#EEEFEE"><span class="tabletext"><b>Cofc<br>Qty</b></td>
            <td width="30px"  bgcolor="#EEEFEE"><span class="tabletext"><b>Clo<br>Bal</b></td>
            </tr>
             </table>
<div style="width:1805px; height:400; overflow:auto;border:" id="dataList">

<table style="table-layout: fixed" width=1785px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<?php
//recnum, invoice_num, grnnum, grn_date, ponum, description, qty_recd, qty_cons, create_date, modified_date, crn,
// status, closingbal, invoice_date, cofc_num, bond_num, be_num, grnwonum, company, rmtype, uom
                    while ($myrow = mysql_fetch_array($result))
                   {
                    if($myrow['grn_date'] != '0000-00-00' && $myrow['grn_date'] != 'NULL' && $myrow['grn_date'] != '')
                    {
                     $datearr = split('-', $myrow['grn_date']);
                     $d=$datearr[2];
                     $m=$datearr[1];
                     $y=$datearr[0];
                     $x=mktime(0,0,0,$m,$d,$y);
                     $gdate=date("M j, Y",$x);
                     }
                     else
                     {
                     $gdate = '';
                     }
                     
                     if($myrow['invoice_date'] != '0000-00-00' && $myrow['invoice_date'] != 'NULL' && $myrow['invoice_date'] != '')
                    {
                     $datearr = split('-', $myrow['invoice_date']);
                     $d=$datearr[2];
                     $m=$datearr[1];
                     $y=$datearr[0];
                     $x=mktime(0,0,0,$m,$d,$y);
                     $idate=date("M j, Y",$x);
                     }
                     else
                     {
                     $idate = '';
                     }
                    //echo $prevgrnnum."----111----".$myrow[2]."----------<br>";
                    if($prevgrnnum!=$myrow['grnnum'])
                    { 
						$prevgrnnum=$myrow['grnnum'];
                        $close_bal=$myrow['qty_recd']-($myrow['qty_cons']+$myrow['qty_rej']);
                        $closingbal=$close_bal;
                        //echo $close_bal."----in----<br>";
                      
                    }
					else
                    {//echo $closingbal."----222----".$close_bal."----------$myrow[7]<br>";
                      $closingbal= $closingbal-$myrow['qty_cons'];
                    }
                     //echo $closingbal."----1222----".$close_bal;
   
?>
        <tr bgcolor="#FFFFFF">
        <td width="70px"><span class="tabletext"><?php echo $myrow['be_num'] ?></td>
        <td width="60px"><span class="tabletext"><?php echo $myrow['bedate'] ?></td>
        <td width="60px"><span class="tabletext"><?php echo $myrow['assessval'] ?></td>
	    <td width="60px"><span class="tabletext"><?php echo $myrow['cifval'] ?></td>
        <td width="60px"><span class="tabletext"><?php echo $myrow['dutyamt'] ?></td>
		<td width="70px"><span class="tabletext"><?php echo $myrow['invoice_num'] ?></td>
		<td width="60px"><span class="tabletext"><?php echo $myrow['invoice_date'] ?></td>
		<td width="80px"><span class="tabletext"><?php echo $myrow['currency']." ".$myrow['invamt'] ?></td>
		<td width="70px"><span class="tabletext"><?php echo $myrow['expinvnum'] ?></td>
        <td width="125px"><span class="tabletext"><?php echo $myrow['company'] ?></td>
        <td width="60px"><span class="tabletext"><?php echo $myrow['grnnum'] ?></td>
        <td width="60px"><span class="tabletext"><?php echo $myrow['grn_date'] ?></td>
        <td width="60px"><span class="tabletext"><?php echo $myrow['crn'] ?></td>
        <td width="125px"><span class="tabletext"><?php echo wordwrap($myrow['description'],15,"<br>\n",true) ?></td>
        <td width="80px"><span class="tabletext"><?php echo $myrow['rmtype'] ?></td>
		<td width="30px"><span class="tabletext"><?php echo $myrow['uom'] ?></td>
		<td width="30px"><span class="tabletext"><?php echo number_format ($myrow['qty'],2 ) ?></td>
        <td width="30px"><span class="tabletext"><?php echo $myrow['qty_recd'] ?></td>
        <td width="30px"><span class="tabletext"><?php echo $myrow['qty_rej'] ?></td>
        <td width="50px"><span class="tabletext"><?php echo $myrow['cofc_num'] ?></td>
        <td width="30px"><span class="tabletext"><?php echo $myrow['qty_cons'] ?></td>
        <td width="30px"><span class="tabletext"><?php echo $closingbal ?></td>
        </tr>
<?php
			}
?>
            </table>
        </td></tr>
</table>
  </td>
 <td width="6"><img src="images/spacer.gif " width="6"></td>
	<tr bgcolor="DEDFDE">
  		<td width="6"><img src="images/box-left-bottom.gif"></td>
		<td><img src="images/spacer.gif " height="6"></td>
		<td width="6"><img src="images/box-right-bottom.gif"></td>
	</tr>
 </table>
               <span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                  style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">
</FORM>
</body>
</html>
