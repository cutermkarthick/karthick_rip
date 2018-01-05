<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: new_invoice.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new invoice                 =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];

$userrole = $_SESSION['userrole'];
$_SESSION['pagename'] = 'spmasteredit';
//////session_register('pagename');

// First include the class definition
include_once('classes/loginClass.php');
include('classes/spmasterClass.php');
include('classes/displayClass.php');

$newspmaster = new spmaster;
$newdisplay = new display;

$recnum=$_REQUEST['recnum'];

$result = $newspmaster->getspmasterdetails($recnum);
$myrow = mysql_fetch_assoc($result);

if($myrow['qty_valid_from'] != '' && $myrow['qty_valid_from'] != '0000-00-00')
               {
                 $datearr = split('-', $myrow['qty_valid_from']);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $qvfdate=date("M j, Y",$x);
               }
               else
               {
                 $qvfdate = '';
               }

               if($myrow['qty_valid_upto'] != '' && $myrow['qty_valid_upto'] != '0000-00-00')
               {
                 $datearr = split('-', $myrow['qty_valid_upto']);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $qvtdate=date("M j, Y",$x);
               }
               else
               {
                 $qvtdate = '';
               }
               if($myrow['price_valid_from'] != '' && $myrow['price_valid_from'] != '0000-00-00')
               {
                 $datearr = split('-', $myrow['price_valid_from']);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $pfdate=date("M j, Y",$x);
               }
               else
               {
                 $pfdate = '';
               }

               if($myrow['price_valid_upto'] != '' && $myrow['price_valid_upto'] != '0000-00-00')
               {
                 $datearr = split('-', $myrow['price_valid_upto']);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $ptdate=date("M j, Y",$x);
               }
               else
               {
                 $ptdate = '';
               }
               if($myrow['totalcost_valid_from'] != '' && $myrow['totalcost_valid_from'] != '0000-00-00')
               {
                 $datearr = split('-', $myrow['totalcost_valid_from']);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $tfdate=date("M j, Y",$x);
               }
               else
               {
                 $tfdate = '';
               }
               if($myrow['totalcost_valid_upto'] != '' && $myrow['totalcost_valid_upto'] != '0000-00-00')
               {
                 $datearr = split('-', $myrow['totalcost_valid_upto']);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $ttdate=date("M j, Y",$x);
               }
               else
               {
                 $ttdate = '';
               }
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/spmaster.js"></script>

<html>
<head>
<title>SPMaster Edit</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0" onload="getmaststat()">
     <form action='spmasterProcess.php' method='post' enctype='multipart/form-data' >
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
	<td width="100%"><span class="pageheading"><b>SPMaster Edit</b></td>
    </table>
  <tr>
<td>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
 <tr bgcolor="#DDDEDD">
    <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
        </tr>
       <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >

                <tr bgcolor="#FFFFFF">
                <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Supplier</p></font></td>
          <td ><input type="text" name="company" id="company" style=";background-color:#DDDDDD;"
                    readonly="readonly" size=40 value="<?php echo $myrow["name"] ?>">
                    <input type="hidden" name="companyrecnum" id="companyrecnum" value="<?php echo $myrow["link2vendor"] ?>"></td>
                    <input type="hidden" name="recnum" id="recnum" value="<?php echo $myrow["recnum"] ?>">
                   <input type="hidden" name="create_date" id="create_date" value="<?php echo $myrow["create_date"] ?>"></td>
                   <input type="hidden" name="pagename" id="pagename" value="editspmaster"></td>

                   <td colspan=2></td>

                   </tr>
                   <tr bgcolor="#FFFFFF">
              <td width= 16% ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>CRN #</p></font></td>
            		<td ><span class="labeltext"><input type="text" name="crnnum" id="crnnum" size=30 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow["crnnum"] ?>"></td>
                    <td><span class="tabletext"><p align="left"><b><span class='asterisk'>*</span>Partnumber</b></p></font></td>
                    <td><input type="text" name="partnum"  id="partnum" size=30 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow["partnum"] ?>"> </td>
     			</tr>
     			<tr bgcolor="#FFFFFF">
     			<?php
     			if($myrow["saabpartnum"]=='' && $myrow["status"]=='Active')
     			{
     			?>
     			<td width= 16% ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>SAAB Partnumber</p></font></td>
            		<td ><span class="labeltext"><input type="text" name="saabpartnum" id="saabpartnum" size=30 value="<?php echo $myrow["saabpartnum"] ?>"></td>
     			<?php
     			}
     			else
     			{
     			?>
     			<td width= 16% ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>SAAB Partnumber</p></font></td>
            		<td ><span class="labeltext"><input type="text" name="saabpartnum" id="saabpartnum" size=30 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow["saabpartnum"] ?>"></td>
     			<?php
     			}
     			?>
     			<?php
     			if($myrow["aukpartnum"]==''&& $myrow["status"]=='Active')
     			{
     			?>
                   <td><span class="tabletext"><p align="left"><b><span class='asterisk'>*</span>AUK Partnumber</b></p></font></td>
                    <td><input type="text" name="aukpartnum"  id="aukpartnum" size=30 value="<?php echo $myrow["aukpartnum"] ?>"> </td>
     			<?php
     			}
     			else
     			{
     			?>
                   <td><span class="tabletext"><p align="left"><b><span class='asterisk'>*</span>AUK Partnumber</b></p></font></td>
                    <td><input type="text" name="aukpartnum"  id="aukpartnum" size=30 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow["aukpartnum"] ?>"> </td>
     			<?php
     			}
     			?>


            	<!--	<td width= 16% ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>SAAB Partnumber</p></font></td>
            		<td ><span class="labeltext"><input type="text" name="saabpartnum" id="saabpartnum" size=30 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow["saabpartnum"] ?>"></td>
                    <td><span class="tabletext"><p align="left"><b><span class='asterisk'>*</span>AUK Partnumber</b></p></font></td>
                    <td><input type="text" name="aukpartnum"  id="aukpartnum" size=30 style="background-color:#DDDDDD;"
                               readonly="readonly" value="<?php echo $myrow["aukpartnum"] ?>"> </td> -->
     			</tr>
     			<tr bgcolor="#FFFFFF" colspan=3>
                 	<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Qty</p></font></td>
            		<td><input type="text" name="qty"  id="qty"
                               style="background-color:#DDDDDD;"
                               readonly="readonly" size=15 value="<?php echo $myrow["qty"] ?>">
                    </td>
              <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Validity for Qty</p></font></td>
            		<td><input type="text" name="qty_valid_from"  id="qty_valid_from"
                                size=20 value="<?php echo $myrow["qty_valid_from"] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
                                <span class="labeltext">TO</span> <input type="text" name="qty_valid_upto"  id="qty_valid_upto"
                                size=20 value="<?php echo $myrow["qty_valid_upto"] ?>"style=";background-color:#DDDDDD;" readonly="readonly">
                </td>
                  </tr>

                  <tr bgcolor="#FFFFFF" colspan=3>
            		<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Price</p></font></td>
            		<td><span class="labeltext"><input type="text" name="price" id="price" size=15  value="<?php echo $myrow["price"] ?>">
                    <span class="tabletext">
		          <select name="currency" id="currency"  width=2>
		            <?
		            $currency=array('$','Rs','GBP','Euro');
					for($j=0;$j<count($currency);$j++){

					if($currency[$j] == $myrow["currency"]){?>
					<option selected value="<? echo $currency[$j]?>"><?echo $currency[$j]; ?>
					</option>
					<?}
					else{?>
                    <option value="<? echo $currency[$j]?>"><?echo $currency[$j]; ?>
					</option>
					<?}
					}?>

        </td>
         <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Validity for Price</p></font></td>
            		<td><input type="text" name="price_valid_from"  id="price_valid_from"
                                size=20 value="<?php echo $myrow["price_valid_from"] ?>"style=";background-color:#DDDDDD;" readonly="readonly">

                <span class="labeltext">TO</span> <input type="text" name="price_valid_upto"  id="price_valid_upto"
                                size=20 value="<?php echo $myrow["price_valid_upto"] ?>"style=";background-color:#DDDDDD;" readonly="readonly">
                </td>
            </tr>
            	<tr bgcolor="#FFFFFF" colspan=3>
                 	<td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Total Cost</p></font></td>
            		<td><input type="text" name="totalcost"  id="totalcost"
                               style="background-color:#DDDDDD;"
                               readonly="readonly" size=15 value="<?php echo $myrow["totalcost"] ?>">
                    </td>
              <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Validity for Total Cost</p></font></td>
            		<td><input type="text" name="totalcost_valid_from"  id="totalcost_valid_from"
                                size=20 value="<?php echo $myrow["totalcost_valid_from"] ?>"style=";background-color:#DDDDDD;" readonly="readonly">

                <span class="labeltext">TO </span><input type="text" name="totalcost_valid_upto"  id="totalcost_valid_upto"
                                size=20 value="<?php echo $myrow["totalcost_valid_upto"] ?>"style=";background-color:#DDDDDD;" readonly="readonly">
                </td>
                  </tr>
             <tr bgcolor="#FFFFFF" colspan=3>
              <td><span class="labeltext"><p align="left">Status</p></font></td>
            <td colspan=3><span class="tabletext"><input type="text" name="status" id="status"
                         readonly="readonly"  style=";background-color:#DDDDDD;" value="<?php echo $myrow["status"] ?>">
                         <span class="tabletext"><select name="spstatus" id="spstatus" size="1" width="10" onchange="onSelectStatus(this);getmaststat()">
              <option value='Select'>Please Specify</option>
	            <option value='Active'>Active</option>
	            <option value='Inactive'>Inactive</option>
	            </select>
             <div id="spmasterstatus">
             
             </div>
            </td>
     			 </tr>

        </table>
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
