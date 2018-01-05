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
$benum=$_REQUEST['benum'];
//echo $benum."---------";
// First include the class definition
include_once('classes/userClass.php');
//include_once('classes/reportClass.php');
include_once('classes/displayClass.php');
include_once('classes/consumptionClass.php');
$newconsumption = new consumption;
$newdisplay = new display;

$result = $newconsumption->getbe4edit($benum);
$result_be = $newconsumption->getbe4edit($benum);

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/report.js"></script>

<html>
<head>
<script language="javascript" type="text/javascript">
function calccifvalue() {
var assesable_value=document.getElementById('assessval').value;
var cifvalue=((assesable_value*100)/101);
//alert(cifvalue);
document.getElementById('cifval').value=(cifvalue.toFixed(2));
}


</script>
<title>BE Edit</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
     <form action='beProcess.php' method='post' enctype='multipart/form-data'>
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
	<td width="100%"><span class="pageheading"><b>BILL OF Entry Edit</b></td>
    </table>

  <tr>
<td>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
 <tr bgcolor="#DDDEDD">
    <td colspan=4><span class="heading"><center><b>BE Information</b></center></td>
        </tr>
</table>
<?php
           $flag = 0;
            while ($myrow_be = mysql_fetch_array($result_be))
			{
				if ($flag ==0 )
			    {
					$flag = 1;

?>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
        <tr  bgcolor="#FFFFFF">
              <td><span class="labeltext"><p align="left"><b>BOND #</p></font></td>
      		<td><input type="text" name="bond_num"  id="bond_num"
			                 style="background-color:#DDDDDD;" readonly="readonly"
                                    size=20 value="<?php echo $myrow_be['bond_num'] ?>" >
                </td>
                <td><span class="labeltext"><p align="left"><b>Bond Date</p></font></td>
            		<td><input type="text" name="bonddate"  id="bonddate"
					           style="background-color:#DDDDDD;" readonly="readonly"
                               size=20 value="<?php echo $myrow_be['bonddate'] ?>">
                    </td>
		</tr>
	    <tr  bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left"><b>BE #</p></font></td>
      		<td><input type="text" name="be_num"  id="be_num"
        size=20 value="<?php echo $myrow_be['be_num'] ?>" >
                </td>
		<input type="hidden" name="prevbenum" id="prevbenum" value="<?php echo $myrow_be['be_num'] ?>"></td>
                <td><span class="labeltext"><p align="left"><b>BE Date</p></font></td>
            		<td><input type="text" name="bedate"  id="bedate"
                               size=20 value="<?php echo $myrow_be['bedate'] ?>" style="background-color:#DDDDDD;" readonly="readonly">
                               <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("bedate")'>
                    </td>
		</tr>
			    <tr  bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left"><b>Assesable Value</p></font></td>
      		<td><input type="text" name="assessval"  id="assessval"
        size=20 value="<?php echo $myrow_be['assessval'] ?>" onblur="calccifvalue();" >
                </td>

                <td><span class="labeltext"><p align="left"><b>CIF Value</p></font></td>
            		<td><input type="text" name="cifval"  id="cifval"
                               size=20 style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow_be['cifval'] ?>">
                    </td>
		</tr>
       <tr  bgcolor="#FFFFFF">		
	                 <td><span class="labeltext"><p align="left"><b>Duty Amount</p></font></td>
            		<td><input type="text" name="dutyamt"  id="dutyamt"
                               size=20 value="<?php echo $myrow_be['dutyamt'] ?>">
                    </td>
         <td><span class="labeltext"><p align="left"><b>RM Type</p></font></td>
            		<td><input type="text" name="be_rmtype"  id="be_rmtype"
                               size=20 value="<?php echo $myrow_be['be_rmtype'] ?>">
                    </td>

                  </tr>

<?php
			}
			}
?>
</table>
      <table style="table-layout: fixed" width=1495px border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
      <tr>
      <td  width="70px" bgcolor="#EEEFEE"><span class="tabletext"><b>Invoice #</b></td>
            <td  bgcolor="#EEEFEE" width="50px"><span class="tabletext"><b>Inv Dt</b></td>
            <td  width="70px" bgcolor="#EEEFEE"><span class="tabletext"><b>Inv Amt</b></td>
            <td width="50px" bgcolor="#EEEFEE"><span class="tabletext"><b>Export<br>Invoice#</b></td>
            <td  bgcolor="#EEEFEE" width="105px"><span class="tabletext"><b>Supplier</b></td>
			<td  bgcolor="#EEEFEE" width="50px"><span class="tabletext"><b>GRN #</b></td>
            <td  bgcolor="#EEEFEE" width="50px"><span class="tabletext"><b>GRN Dt</b></td>
            <td  bgcolor="#EEEFEE" width="60px"><span class="tabletext"><b>PRN #</b></td>
            <td  bgcolor="#EEEFEE" width="95px"><span class="tabletext"><b>RM Spec</b></td>
            <td  bgcolor="#EEEFEE" width="80px"><span class="tabletext"><b>RM Type</b></td>
             <td width="30px" bgcolor="#EEEFEE"><span class="tabletext"><b>UOM</b></td>
             <td width="30px" bgcolor="#EEEFEE"><span class="tabletext"><b>Qty</b></td>
            <td  width="20px" bgcolor="#EEEFEE"><span class="tabletext"><b>Qty <br>Recd</b></td>
            <td  width="20px" bgcolor="#EEEFEE"><span class="tabletext"><b>Qty <br>Rej</b></td>
            <td width="50px" bgcolor="#EEEFEE"><span class="tabletext"><b>Cofc #</b></td>
            <td width="20px" bgcolor="#EEEFEE"><span class="tabletext"><b>Cofc<br>Qty</b></td>
            <td width="20px"  bgcolor="#EEEFEE"><span class="tabletext"><b>Clo<br>Bal</b></td>
              </tr>
             </table>
<div style="width:1515px; height:400; overflow:auto;border:" id="dataList">

<table style="table-layout: fixed" width=1495px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<?php
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
 <td width="70px"><span class="tabletext"><?php echo $myrow['invoice_num'] ?></td>
		<td width="50px"><span class="tabletext"><?php echo $myrow['invoice_date'] ?></td>
		<td width="70px"><span class="tabletext"><?php echo $myrow['currency']." ".$myrow['invamt'] ?></td>
		<td width="50px"><span class="tabletext"><?php echo $myrow['expinvnum'] ?></td>
        <td width="105px"><span class="tabletext"><?php echo $myrow['company'] ?></td>
        <td width="50px"><span class="tabletext"><?php echo $myrow['grnnum'] ?></td>
        <td width="50px"><span class="tabletext"><?php echo $myrow['grn_date'] ?></td>
        <td width="60px"><span class="tabletext"><?php echo $myrow['crn'] ?></td>
        <td width="95px"><span class="tabletext"><?php echo wordwrap($myrow['description'],15,"<br>\n",true) ?></td>
        <td width="80px"><span class="tabletext"><?php echo $myrow['rmtype'] ?></td>
		<td width="30px"><span class="tabletext"><?php echo $myrow['uom'] ?></td>
		<td width="30px"><span class="tabletext"><?php echo number_format ($myrow['qty'],2 ) ?></td>
        <td width="20px"><span class="tabletext"><?php echo $myrow['qty_recd'] ?></td>
        <td width="20px"><span class="tabletext"><?php echo $myrow['qty_rej'] ?></td>
        <td width="50px"><span class="tabletext"><?php echo $myrow['cofc_num'] ?></td>
        <td width="20px"><span class="tabletext"><?php echo $myrow['qty_cons'] ?></td>
        <td width="20px"><span class="tabletext"><?php echo $closingbal ?></td>
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
