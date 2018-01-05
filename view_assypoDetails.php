<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: view_assypoDetails.php            =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Displays Assypo Detals                      =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
if ( !isset ( $_REQUEST['delrecnum']) )
{
   header ( "Location: login.php" );
}
$delrecnum = $_REQUEST['delrecnum'];
$_SESSION['pagename'] = 'view_assypoDetails';
//////session_register('pagename');

// First include the class definition

include('classes/assypoClass.php');
include('classes/assypoliClass.php');
include('classes/displayClass.php');
$newassyPo = new assyPo;
$newdisplay = new display;
$newLI = new assypo_line_items;
$result = $newassyPo->getassyPoDetails($delrecnum);
$myrow = mysql_fetch_assoc($result);

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/assypo.js"></script>
<script language="javascript" type="text/javascript" >
function readOnlyCheckBox() {
   return false;
}
</script>
<html>
<head>
<title>Assembly Po Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
       <tr>
          <td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
          <td align="right">&nbsp;
          <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
       </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>

<?php  $newdisplay->dispLinks(''); ?>

</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
<td><span class="pageheading"><b>SP PO Details</b></td>

  </tr>


<tr bgcolor="#DDDEDD"><td colspan=5><span class="heading"><center><b>SP PO Details</b></center></td></tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#FFFFFF">
  <td width=50% bgcolor="#F5F6F5"><span class="heading"><center><b>From</b></center></td>
  <td bgcolor="#F5F6F5"><span class="heading"><b><center>Order To</center></b></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="tabletext">CIMTools Pvt Ltd.</td>
<td><span class="tabletext"><?php echo $myrow["name"]?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="tabletext">Plot No. 467-469, Site No. 1D,</td>
<td><span class="tabletext"><?php echo $myrow["addr1"] . " " . $myrow["addr2"]; ?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="tabletext">12th Cross, 4th Phase,PIA</td>
<td><span class="tabletext"><?php echo $myrow["city"] . " " . $myrow["state"]. " " . $myrow["zipcode"]; ?></td>
</tr>
<tr bgcolor="#FFFFFF">
<td><span class="tabletext">Bangalore 560 058, Karnataka- INDIA.</td>
<td><span class="tabletext"><?php echo $myrow["country"]; ?></td>
</tr>
</table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
    <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext">SP Po No.</font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["assyPonum"]?></td>
            <td width=20%><span class="labeltext">Po Date.</font></td>
       <?php
            if($myrow["podate"] != '0000-00-00' && $myrow["podate"] != '' && $myrow["podate"] != 'NULL')
              {
                $datearr = split('-', $myrow["podate"]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $podate=date("M j, Y",$x);
	          }
	       else
           {
                $podate="";
	       }
	      ?>
            <td width=20%><span class="tabletext"><?php echo $podate ?></td>
     </tr>
      <tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext">Create Date</font></td>
             <?php
            if($myrow["create_date"] != '0000-00-00' && $myrow["create_date"] != '' && $myrow["create_date"] != 'NULL')
              {
                $datearr = split('-', $myrow["create_date"]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $crdate=date("M j, Y",$x);
	          }
	       else
           {
                $crdate="";
	       }
	      ?>
            <td width=20%><span class="tabletext"><?php echo $crdate?></td>
            <td width=20%><span class="labeltext">Modified Date.</font></td>
       <?php
            if($myrow["modified_date"] != '0000-00-00' && $myrow["modified_date"] != '' && $myrow["modified_date"] != 'NULL')
              {
                $datearr = split('-', $myrow["modified_date"]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $mdate=date("M j, Y",$x);
	          }
	       else
           {
                $mdate="";
	       }
	      ?>
            <td width=20%><span class="tabletext"><?php echo $mdate ?></td>
     </tr>

      	<tr bgcolor="#FFFFFF">
			 <?php
            $checked="checked";
            ?>
            <td width=20%><span class="labeltext"><p align="left">Approval</p></font></td>
            <td width=20%><span class="tabletext"><input type="checkbox" <?php echo $myrow["approval"] == 'yes'?$checked:"" ?> onClick="return readOnlyCheckBox()"/></td>
           <td width=20%><span class="labeltext"><p align="left">Approval Date</p></font></td>
            <?php
             // echo"to--- ".$myrow["approvaldate"];
              if($myrow["approval_date"] !='' && $myrow["approval_date"] !='0000-00-00' && $myrow["approvaldate"] != 'null'){
              $datearr = split('-', $myrow["approval_date"]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $apdate=date("M j, Y",$x);
            }
            else
              $apdate='';
            //echo "$date1";
            ?>
            <td width=20%><span class="tabletext"><?php echo $apdate ?></td>
			</tr>
<tr bgcolor="#FFFFFF">
   <td width=20%><span class="labeltext">Approval By</font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow["approval_by"]?></td>
</tr>
			<tr bgcolor="#FFFFFF">
			<td width=20%><span class="labeltext"><p align="left">Amendment No.</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["amnd_no"] ?></td>
            <td width=20%><span class="labeltext"><p align="left">Amendment Date</p></font></td>
            <?php
              // echo"to--- ".$myrow["podate"];
              if($myrow["amnd_date"] !='' && $myrow["amnd_date"] !='0000-00-00' && $myrow["amnd_date"] != 'null'){
              $datearr = split('-', $myrow["amnd_date"]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
            $x=mktime(0,0,0,$m,$d,$y);
            $amnddate=date("M j, Y",$x);
           }
           else{
            $amnddate='';
           }
           // echo "$date";
            ?>
            <td width=20%><span class="tabletext"><?php echo $amnddate ?></td>

        </tr>
        	<?
              $amend_notes=wordwrap($myrow["amnd_notes"],100,"\n",true);
             ?>
			<tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Amendment Notes</p></font></td>
            <td width=20%><span class="tabletext"><textarea  name="amendment_notes" id="amendment_notes" rows="3"
                          style="background-color:#DDDDDD;" readonly="readonly"
			              cols="50" value=""><?php echo $amend_notes." \n"?></textarea></td>
            <td width=20%><span class="labeltext"><p align="left">PO Desc</p></font></td>
            <td width=20%><span class="tabletext"><?php echo $myrow["po_desc"] ?></td>
			</tr>

			<?
              $terms=wordwrap($myrow["terms"],100,"\n",true);
             ?>
			<tr bgcolor="#FFFFFF">
            <td width=20%><span class="labeltext"><p align="left">Header</p></font></td>
            <td width=20%><span class="tabletext"><textarea  name="terms" rows="2"
                          style="background-color:#DDDDDD;" readonly="readonly"
			              cols="50" value=""><?php echo $terms." \n"?></textarea></td>
		 <?php
            //echo"++++".$myrow["status"];
           if($myrow["status"]=="Pending")
           {
             $color = '"#FF0000"';
           }
           else if(($myrow["status"]=="Open")||($myrow["status"]=="open"))
           {
             $color = '"#00FF00"';
           }
           else if ($myrow["status"]=="Cancelled")
           {
              $color = '"#FFEABD"';
           }
            else if ($myrow["status"]=="Issued")
           {
              $color = '"#FFDADA"';
           }
           else
           {
              $color = '"#FFC89F"';
           }
         ?>
            <td width=20%><span class="labeltext"><p align="left">Status</p></font></td>
            <td width=20% bgcolor=<?php echo $color ?>><span class="tabletext"><b><?php echo $myrow["status"] ?></b></td>
			</tr>
            <?
              $remarks=wordwrap($myrow["remarks"],100,"\n",true);
             ?>
		<tr bgcolor="#FFFFFF">
           <td width=20%><span class="labeltext"><p align="left">Remarks</p></font></td>
           <td width=20%><span class=\"tabletext\"><textarea  name="remarks" rows="3"
                          style="background-color:#DDDDDD;" readonly="readonly"
			              cols="50" value=""><?php echo $remarks." \n" ?></textarea></td>
              <td colspan=3 ></td>
</tr>
        </tr>

    </table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr bgcolor="#DDDEDD">
<td colspan=15><span class="heading"><center><b>Line Items</b></center></td>
</tr>
       <tr>
            <td bgcolor="#EEEFEE" width=3%><span class="heading"><b>Line</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>PRN</b></td>
            <td bgcolor="#EEEFEE" width=8%><span class="heading"><b>Part# Before<br>NDT/SP</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Part# After<br>SP</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Partname</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>PartIss<br>Iss</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Drg</b></td>
            <td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Mtl Spec</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Mtl Type</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>COS</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Qty</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Price</b></td>
            <td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Extended Price</b></td>
       </tr>

<?php
        $currency = $myrow["currency"];
        $i = 0;
        $result = $newLI->getLI($delrecnum);
        while ($myLI = mysql_fetch_assoc($result)) {


            //echo "$date";
            $line_num = $myLI["lineNum"];
            $crnNum = $myLI["crnNum"];
            $pripartNum = $myLI["priPartNum"];
            $secpartNum = $myLI["secPartNum"];
            //echo'seccP='.$secpartNum;
            $partName = $myLI["partName"];
            $partIss = $myLI["partIss"];
            $drg = $myLI["drg"];
            $mtlSpec = $myLI["mtlSpec"];
            $mtlType = $myLI["mtlType"];
            //$rmCondition = $myLI["rmCondition"];
            $qty = $myLI["qty"];
            $price =  $myLI["price"];
            $extPrice = $myLI["extPrice"];
            $cos = $myLI["cos"];
            //$delvby = $myLI["delv_by"];
              $i = $i + 1;
              
	     echo"<tr><td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$line_num</td>" ;
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$crnNum</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$pripartNum</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$secpartNum</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partName</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partIss</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$drg</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$mtlSpec</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$mtlType</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cos</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$qty</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$currency $price</td>";
             echo"<td bgcolor=\"#FFFFFF\" align='right'><span class=\"tabletext\">$currency  $extPrice</td>";

        }
?>

   <tr>
              <td bgcolor="#FFFFFF" colspan=12 align="right"><span class="tabletext"><b>Total</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["poamount"]); ?></td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" colspan=12 align="right"><span class="tabletext"><b>Tax</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["tax"]);  ?></td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" colspan=12 align="right"><span class="tabletext"><b>Shipping</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["shipping"]); ?></td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" colspan=12 align="right"><span class="tabletext"><b>Labor</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["labour"]); ?></td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" colspan=12 align="right"><span class="tabletext"><b>Total Due</b></td>
              <td align="right" bgcolor="#FFFFFF"><span class="tabletext"><?php printf('%s %.2f',$myrow["currency"],$myrow["total_due"]); ?></td>
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
</body>
</html>
