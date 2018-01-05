<?php
//==============================================
// Author: FSI                                 =
// Date-written = April , 2010                 =
// Filename: dnEntry.php                       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Allows entry of Dispatchs                   =
//==============================================

session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
  header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'assyReviewEntry';
$page= "CRM: Assy Review";


include('classes/companyClass.php');
include('classes/vendPartClass.php');

$company = new company;
$newVend = new vendPart;

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/assy_review.js"></script>

<html>
  <head>
    <title>New Contract Review for Assembly Order</title>
  </head>

  <body leftmargin="0"topmargin="0" marginwidth="0">
    <form action='assyReviewProcess.php' method='POST' enctype='multipart/form-data'>
    <?php
      include('header.html');
    ?>

    <td><span class="pageheading"><b>New Contract Review for Assembly Order</b></td>
    </tr>
    </table>

    <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
      <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
      <tr>
        <td>
          <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
            <tr bgcolor="#FFFFFF">
              <td width='20%'>
                <span class="labeltext"><p align="left"><span class='asterisk'>*</span>Assembly Review#</p></span>
              </td>
              <td width='20%'><input type="text" name="cust_ponum"  size=20 value=""></td>
              <?php
                $result_cust = $company->getAllCustomers();
              ?>
              <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></span></td>
              <td><input type="text" name="customer" id="customer"  style="background-color:#DDDDDD;"  readonly="readonly" size=20 value=""><img src="images/bu-getcustomer.gif" alt="Get Customer" onclick="GetAllCustomers()">
              </td>
              <input type="hidden" name="companyrecnum" id="companyrecnum" value="<?php echo $companyrecnum ?>">
            </tr>

            <tr bgcolor="#FFFFFF">
              <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO Date</p></span></td>
              <td><input type="text" id="po_date" name="po_date" style=";background-color:#DDDDDD;"	readonly="readonly" size=10 value="">
              <img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('po_date')"></td>
              <td><span class="labeltext"><p align="left">Line Items in PO</p></span></td>
              <td><input type="text" name="po_li" id="po_li" size=20 value=""></td>
            </tr>


            <tr bgcolor="#FFFFFF">
              <td><span class="labeltext"><p align="left">Review Ref</p></span></td>
              <td><input type="text" name="review_ref" id="review_ref"  size=20 value=""></td>
              <td><span class="labeltext"><p align="left">Review Date</p></span></td>
              <td><input type="text" id="review_date" name="review_date" style=";background-color:#DDDDDD;"	readonly="readonly" size=10 value="">
              <img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('review_date')"></td>
            </tr>

            <tr bgcolor="#FFFFFF">
              <td><span class="labeltext"><span class='asterisk'>* </span>Special Instruction</span></td>
              <td colspan=4><textarea name="special_instruction" id="special_instruction" rows="4" cols="45" value=""></textarea></td>
            </tr>

            <tr bgcolor="#FFFFFF">
              <td><span class="labeltext"><p align="left">Contact Person</p></span></td>
              <td><input type="text" name="contact" id="contact"  size=15 value=""></td>
              <td><span class="labeltext"><p align="left">Email</p></span></td>
              <td><input type="text" name="email_id" id="email_id"  size=20 value=""></td>
            </tr>

            <tr bgcolor="#FFFFFF">
              <td><span class="labeltext"><p align="left">Order for</p></span></td>
              <td><input type="text" name="order_for" id="order_for"  size=15 value=""></td>
              <td><span class="labeltext"><p align="left">Order Type</p></span></td>
              <td><input type="text" name="ord_type" id="ord_type"  size=20 value=""></td>
            </tr>

            <tr bgcolor="#FFFFFF">
              <td><span class="labeltext"><p align="left">Ammendment No</p></span></td>
              <td><input type="text" name="amendment" id="amendment"  size=20 value=""></td>
              <td><span class="labeltext"><p align="left">Ammendment Date</p></span></td>
              <td><input type="text" id="amnd_date" name="amnd_date" style=";background-color:#DDDDDD;"	readonly="readonly" size=10 value="">
              <img src="images/bu-getdateicon.gif" alt="Get Date"  onclick="GetDate('amnd_date')"></td>
            </tr>

            <tr bgcolor="#FFFFFF">
              <td><span class="labeltext"><p align="left">Quote Ref</p></span></td>
              <td><input type="text" name="quote_ref" id="quote_ref"  size=20 value=""></td>
              <td><span class="labeltext"><p align="left">Agreements</p></span></td>
              <td><input type="text" name="agr" id="agr"  size=20 value=""></td>
            </tr>

            <tr bgcolor="#FFFFFF">
              <td><span class="labeltext"><p align="left">Project</p></span></td>
              <td><input type="text" name="project" id="project"  size=20 value=""></td>
              <td colspan=2></td>
            </tr>

          </table>
        </td>
      </tr>

      <tr bgcolor="#FFFFFF">
        <td bgcolor="#DDDEDD" colspan=16><span class="heading"><center><b>Line Items</b></center></span></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" colspan=16><span class="heading"><p>Please Enter Line # & Qty before GET CIM</p></span></td>
      </tr>

      <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
        <tr bgcolor="#FFFFFF"><td colspan=16><a href="javascript:addRow('myTable',document.forms[0].maxrecnum.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
      </table>

      <div style="width:100%;overflow-x:scroll">
        <table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable">
          <tr>
            <td class="head0" width=3%><span class="heading"><b>Line</b></span></td>
            <td class="head0" width=4%><span class="heading"><b>Qty</b></span></td>
            <td class="head1" width=12%><span class="heading"><b>PRN</b></span></td>
            <td class="head0" width=10%><span class="heading"><b> Assy Part#</b></span></td>
            <td class="head1" width=13%><span class="heading"><b>Assy Description</b></span></td>
            <td class="head0" width=10%><span class="heading"><b> Part#</b></span></td>
            <td class="head1" width=13%><span class="heading"><b>Description</b></span></td>
            <!-- <td class="head0" width=5%><span class="heading"><b>BOM Ref</b></span></td>
            <td class="head1" width=5%><span class="heading"><b>BOM Iss</b></span></td> -->
            <td class="head0" width=8%><span class="heading"><b>Part Iss</b></span></td>
            <td class="head1" width=8%><span class="heading"><b>Cos Iss</b></span></td>
            <td class="head0" width=8%><span class="heading"><b>Model Iss</b></span></td>
            <td class="head1" width=8%><span class="heading"><b>Drg Iss</b></span></td>
            <td class="head1" width=5%><span class="heading"><b>Unit Price</b></span></td>
            <td class="head0" width=10%><span class="heading"><b>Total Price</b></span></td>
          </tr>
          <?php
          $i=0;
          $fl = 0;
          $result4bom = $newVend->getbom2Parts();
          while($row=mysql_fetch_row($result4bom))
          {
            if($fl == 0)
            {
              $bom_arr  = $row[1].'|'.$row[2].'|'.$row[3];
              $fl=1;
            }
            else
              $bom_arr .= '*'.$row[1].'|'.$row[2].'|'.$row[3];
          }
          $num_bom = mysql_num_rows($result4bom);

          while ($i<6)
          {
            printf('<tr bgcolor="#FFFFFF">');
            $linenumber="line_num" . $i;
            $crn="crn" . $i;
            $crn_check="crn_check" . $i;
            $assy_partnum="assy_partnum" . $i;
            $assy_desc="assy_desc" . $i;
            $bom="bom" . $i;
            $bomnum="bomnum" . $i;
            $bom_iss="bom_iss" . $i;
            $qty="qty" . $i;
            $price="price" . $i;
            $tot_price="tot_price" . $i;
            $partnum="partnum" . $i;
            $description="description" . $i ;
            $part_iss="part_iss" . $i;
            $cos_iss="cos_iss" . $i;
            $model_iss="model_iss" . $i ;
            $drg_iss="drg_iss" . $i ;
            $pcrn="pcrn" . $i;

        	echo "<input type=\"hidden\" id=\"$pcrn\" name=\"$pcrn\" size=\"5%\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" value=\"\">";
          echo "<td><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"   value=\"\" size=\"3%\"></td>";
          echo "<td><input type=\"text\" id=\"$qty\" name=\"$qty\"  size=\"5%\" value=\"\">";
          echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\"   size=\"10%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"> 
                <img src=\"images/bu-get.gif\" onclick=\"GetCrn4asyrevli('$i')\"></td>";
          
          echo "<td><input type=\"text\" id=\"$assy_partnum\" name=\"$assy_partnum\"   size=\"22%\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"></td>";
          echo "<td><input type=\"text\" id=\"$assy_desc\" name=\"$assy_desc\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  size=\"30%\" value=\"\"></td>";
          echo "<td><input type=\"text\" id=\"$partnum\" name=\"$partnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  size=\"22%\" value=\"\"></td>";
          echo "<td><input type=\"text\" id=\"$description\" name=\"$description\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"   size=\"30%\" value=\"\"></td>";
          // echo "<input type=\"hidden\" id=\"$bom\" name=\"$bom\" value=\"\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" >";
          // echo "<input type=\"hidden\" id=\"$bom_iss\" name=\"$bom_iss\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"\">";
            echo "<td><input type=\"text\" id=\"$part_iss\" name=\"$part_iss\"  size=\"8%\" value=\"\">";
            echo "<td><input type=\"text\" id=\"$cos_iss\" name=\"$cos_iss\"  size=\"8%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$model_iss\" name=\"$model_iss\"  size=\"8%\" value=\"\">";
            echo "<td><input type=\"text\" id=\"$drg_iss\" name=\"$drg_iss\"  size=\"8%\" value=\"\"></td>";
            
            echo "<td><input type=\"text\" id=\"$price\" name=\"$price\"  size=\"6%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$tot_price\" name=\"$tot_price\"  style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"8%\" value=\"\"></td>";
            echo "<input type=\"hidden\" id=\"$bomnum\" name=\"$bomnum\"  value=\"\">";
            echo "<input type=\"hidden\" id=\"$crn_check\" name=\"$crn_check\" value=\"\">";
            printf('</tr>');

            $i++;
          }
        ?>

          <input type="hidden" name="maxrecnum" id="maxrecnum" value="<?php echo $i ?>">
          <input type="hidden" name="bom_details" id="bom_details" value="<?php echo $bom_arr?>">
        </table>
      </div>

      <input type="hidden" name="page" id="page" value="new">
      </tr>
    </table>
  </td>
</table>

<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr><td align=left></td></tr>
</table>

<span class="tabletext">
  <input type="submit"   style="color=#0066CC;background-color:#DDDDDD;"  value="Submit" name="submit" onclick="javascript: return check_req_fields()">
  <input type="RESET" style="color=#0066CC;background-color:#DDDDDD;" value="Reset" onclick="javascript: putfocus()">
</span>

</form>
</body>
</html>
