<?php
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: getCrn4Po1.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Popup for selecting CRN                     =
//==============================================
session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$crn = $_REQUEST['crn'];
$order_qty=$_REQUEST['order_qty'];
$vendor=$_REQUEST['vendor'];
$spec_type=$_REQUEST['spec_type'];
$potype=$_REQUEST['potype'];
//echo $potype."check----";
$userid = $_SESSION['user'];
include('classes/soliClass.php');
include('classes/masterdataClass.php');
include('classes/rmmasterClass.php');
include('classes/liClass.php');
$newso = new soli;  //^$&*\"\'
$newMaster = new masterdata;
$newRMmaster= new rmmaster;
$newpo_li=new po_line_items;
//echo preg_replace("/[$&*\"\',+]/", " ", "NA$*A");

?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>All CIM Nos</title>
</head>
<body onload=self.focus()>

<form action='getcrn4Po1.php' method='post' enctype='multipart/form-data'>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
<table>
<?php
 if($potype!='Bought Out' and $potype!='Consummables')
         { // echo"HERE---";
$resultrm = $newpo_li->getRM_masterDetails4po($crn,$vendor,$spec_type);
$numrworm=mysql_num_rows($resultrm);
//echo$numrworm."*******************";
         if($numrworm ==0)
         {
               echo "<table border=0><tr><td><font color=#FF0000>";
               die("Possible causes: No matching Supplier for PRN in RM Master or no spec type for PRN");
               echo "</td></tr></table>";
         }
         else{

?>
<tr><td><span class="pageheading"><b>RM Master Details</b></td></tr>
<tr><td>

<table style="table-layout: fixed" width=1200px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
       <tr  bgcolor="#FFCC00">
            <td width=50px bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=100px bgcolor="#EEEFEE"><span class="tabletext"><b>Cust PO#</b></td>
            <td width=80px bgcolor="#EEEFEE"><span class="tabletext"><b>Supplier</b></td>
            <td width=80px bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
            <td width=80px bgcolor="#EEEFEE"><span class="tabletext"><b>RM Spec</b></td>
            <td width=80px bgcolor="#EEEFEE"><span class="tabletext"><b>RM Type</b></td>
            <td width=50px bgcolor="#EEEFEE"><span class="tabletext"><b>UOM</b></td>
            <td width=40px bgcolor="#EEEFEE"><span class="tabletext"><b>Dia</b></td>
            <td width=50px bgcolor="#EEEFEE"><span class="tabletext"><b>Length</b></td>
            <td width=50px bgcolor="#EEEFEE"><span class="tabletext"><b>Width</b></td>
            <td width=60px bgcolor="#EEEFEE"><span class="tabletext"><b>Thickness</b></td>
            <td width=100px bgcolor="#EEEFEE"><span class="tabletext"><b>Grainflow</b></td>
            <td width=100px bgcolor="#EEEFEE"><span class="tabletext"><b>Maxruling</b></td>
            <td width=50px bgcolor="#EEEFEE"><span class="tabletext"><b>RM <br>Price</b></td>
            <td width=110px bgcolor="#EEEFEE"><span class="tabletext"><b>Spec Type</b></td>
       </tr>
</table>
<div style="width:1217px; height:265; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=1200px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<?php
        $match_flag = 0;


        while ($myrowrm = mysql_fetch_assoc($resultrm))
        {
			$crn=$myrowrm['crnnum'];
		
           $result = $newso->getCrn4Po($crn);
           $myrow = mysql_fetch_row($result);
        //echo$myrow[12]."<br>";
          if($myrow[12] !="Alt Spec1" && $myrow[12] !="Alt Spec2")
          {    //echo"here";
              $altspec="Primary Spec";
          }
          else
          {   //echo"here565555";
             $altspec=$myrow[12];
          }

          //echo$altspec."1234---***";
          //if($myrow[6] != '0.00' && $myrow[7] != '0.00')
          if (($myrowrm["width"] != '0.00' && $myrowrm["width"] != '0' && $myrowrm["width"] != '' && $myrowrm["width"] != '-') &&
	      ($myrowrm["thickness"] != '0.00' && $myrowrm["thickness"]!= '0' && $myrowrm["thickness"] != '' && $myrowrm["thickness"] != '-'))
          {
           $dia = '';
           $length = $myrowrm["length"];
           $width = $myrowrm["width"];
           $thick = $myrowrm["thickness"];
          }
          else
          {
           $dia = $myrowrm["rm_dia"];
           $length = $myrowrm["length"];
           $width = '';
           $thick = '';
          }

          $master_dia = preg_replace("/[$&*\"\',+]/","", $myrowrm["rm_dia"]);
          $master_len = preg_replace("/[$&*\"\',+]/","", $myrowrm["length"]);
          $master_width = preg_replace("/[$&*\"\',+]/","", $myrowrm["width"]);
          $master_thick = preg_replace("/[$&*\"\',+]/","", $myrowrm["thickness"]);
          $master_rmtype = preg_replace("/[$&*\"\',+]/","", $myrowrm["rm_type"]);
          $master_rmspec = preg_replace("/[$&*\"\',+]/","", $myrowrm["rm_spec"]);
          $master_gf = preg_replace("/[$&*\"\',+]/","", $myrowrm["rm_grainflow"]);
          $master_maxrul = preg_replace("/[$&*\"\',+]/","", $myrowrm["rm_mrs"]);
          $master_uom=preg_replace("/[$&*\"\',+]/","", $myrowrm["rm_uom"]);
         // $gf = htmlentities($myrow[8]);
         //$rmcond = htmlentities($myrow[9]);
         
         $gf = htmlentities($myrowrm["rm_grainflow"]);
         $rmcond = htmlentities($myrowrm["rm_condition"]);

         //echo "<br>test==============".$myrowrm["name"]."<br>";
          if($myrowrm["rm_qty_perbill"] !=0 || $myrowrm["rm_qty_perbill"] !='')
          {
          if($master_len !=0)
          {
            $no_length=round(($order_qty/$myrowrm["rm_qty_perbill"]));
            $no_meterages="0.00";
            //echo $no_meterages."length<br>";
          }
          else
          {
             $no_meterages=round(($order_qty/$myrowrm["rm_qty_perbill"]));
             $no_length="0.00";
             //echo "<br>".$no_length."meter<br>";
          }
          $currency = array("$");
          $rm_price = str_replace($currency, "", $myrowrm['rm_unitprize']);
          
         // $rm_Unitprice=$myrowrm['rm_unitprize'];
          //$rm_cost=number_format(($rm_price/$myrowrm["rm_qty_perbill"]),2);
          //echo $rm_price."test---".$myrowrm["rm_qty_perbill"];
         }


?>
    <tr bgcolor="#FFFFFF"><td width=50px bgcolor="#FFFFFF"><input type="radio" name="crn"  value="<?php echo $crn."|".$myrowrm["rm_spec"]."|".$myrowrm["rm_type"]."|".$myrowrm["rm_uom"]."|".$dia."|".$length."|".$width."|".$thick."|".$gf."|".$rmcond."|".$myrowrm["rm_mrs"]."|".$rm_price. "|" .$rm_price."|".$no_length."|".$no_meterages ."|".$myrowrm["rm_altrm"] ."|" . $myrowrm["name"]?>"></td>
	<?
	$supplier=wordwrap($myrowrm["name"],15,"<br>\n",true);
	?>
          <td width=100px bgcolor="#FFFFFF"><span class="tabletext"><?php //echo $myrow[11] ?></td>
                          <td width=80px ><span class="tabletext"><?php echo $supplier ?></td>
                          <td width=80px ><span class="tabletext"><?php echo $crn ?></td>
                          <td width=80px ><span class="tabletext"><?php echo wordwrap($myrowrm["rm_spec"],10,"<br />\n",true)?></td>
                          <td width=80px><span class="tabletext"><?php echo $myrowrm["rm_type"] ?></td>
                          <td width=50px><span class="tabletext"><?php echo $myrowrm["rm_uom"] ?></td>
                          <td width=40px><span class="tabletext"><?php echo $myrowrm["rm_dia"] ?></td>
                          <td width=50px><span class="tabletext"><?php echo $myrowrm["length"] ?></td>
                          <td width=50px><span class="tabletext"><?php echo $myrowrm["width"] ?></td>
                          <td width=60px><span class="tabletext"><?php echo $myrowrm["thickness"] ?></td>
                          <td width=100px><span class="tabletext"><?php echo $myrowrm["rm_grainflow"] ?></td>
                          <td width=100px><span class="tabletext"><?php echo $myrowrm["rm_mrs"] ?></td>
                          <td width=50px><span class="tabletext"><?php echo $rm_price ?></td>
                          <td width=110px><span class="tabletext"><?php echo $myrowrm["rm_altrm"] ?></td>
			</tr>
<?php
       if($myrowrm["rm_altrm"] =="Primary Spec")
       {

        printf('<tr  bgcolor="#FFFFFF">
                 <td  bgcolor="#FFFFFF" colspan=15 align="center"><span class="heading"><b>Cust PO</b></td></tr>');
                 echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp;</td>";
                  echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[11]</td>";
                         echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp;</td>";
                         echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[0]</td>";
						$mat_spec=wordwrap($myrow[1],10,"<br />\n",true);
                        if((trim(strtoupper($master_rmspec)) != trim(strtoupper(preg_replace("/[$&*\"\',+-]/","", $myrow[1]))))){

                             echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$mat_spec</td>";
							 //$match_flag = 1;
                         }
                         else{

                             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$mat_spec</td>";
                         }

                         if((trim(strtoupper($master_rmtype)) != trim(strtoupper((preg_replace("/[$&*\"\',+-]/","", $myrow[2])))))){

                             echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$myrow[2]</td>";
							 //$match_flag = 1;
                         }
                         else{

                             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[2]</td>";
                         }
                         if((trim(strtoupper($master_uom)) != trim(strtoupper((preg_replace("/[$&*\"\',+-]/","", $myrow[3])))))){
                             echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$myrow[3]</td>";
						     //$match_flag = 1;
                         }
                         else{

                             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[3]</td>";
                         }

                         if((trim(strtoupper($master_dia)) != trim(strtoupper((preg_replace("/[$&*\"\',+-]/","", $myrow[4])))))){
                             echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$myrow[4]</td>";
						     //$match_flag = 1;
                         }
                         else{

                             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[4]</td>";
                         }

                         if((trim(strtoupper($master_len)) != trim(strtoupper((preg_replace("/[$&*\"\',+-]/","", $myrow[5])))))){
                             echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$myrow[5]</td>";
						     //$match_flag = 1;
                         }
                         else{

                             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[5]</td>";
                         }

                         if((trim(strtoupper($master_width)) != trim(strtoupper((preg_replace("/[$&*\"\',+-]/","", $myrow[6])))))){
                             echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$myrow[6]</td>";
						     //$match_flag = 1;
                         }
                         else{

                             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[6]</td>";
                         }

                         if((trim(strtoupper($master_thick)) != trim(strtoupper((preg_replace("/[$&*\"\',+-]/","", $myrow[7])))))){
                             echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$myrow[7]</td>";
						     //$match_flag = 1;
                         }
                         else{

                             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[7]</td>";
                         }
                         
                          if((trim(strtoupper($master_gf)) != trim(strtoupper((preg_replace("/[$&*\"\',+-]/","", $myrow[8])))))){
                             echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$myrow[8]</td>";
						     //$match_flag = 1;
                         }
                         else{

                             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[8]</td>";
                         }

                          if((trim(strtoupper($master_maxrul)) != trim(strtoupper((preg_replace("/[$&*\"\',+-]/","", $myrow[10])))))){
                             echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$myrow[10]</td>";
							 //$match_flag = 1;
                         }
                         else{

                             echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[10]</td>";
                         }
                          echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$rm_price</td>";
                           echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[12]</td>";
                            echo "<tr><td bgcolor=\"#FFFFFF\" colspan=15><span class=\"tabletext\">&nbsp;</td></tr>";

   if(preg_match('/[$&*\"\',+-]/',$myrowrm["rm_spec"])||preg_match('/[$&*\"\',+-]/',$myrow[1]))
     {
         $match_flag = 1;
     }
     if(preg_match('/[$&*\"\',+-]/',$myrowrm["rm_type"])||preg_match('/[$&*\"\',+-]/',$myrow[2]))
     {
         $match_flag = 1;
     }
     if(preg_match('/[$&*\"\',+-]/',$myrowrm["rm_uom"])||preg_match('/[$&*\"\',+-]/',$myrow[3]))
     {
         $match_flag = 1;
     }
     if(preg_match('/[$&*\"\',+-]/',$myrowrm["dia"])||preg_match('/[$&*\"\',+-]/',$myrow[4]))
     {
        $match_flag = 1;
     }
     if(preg_match('/[$&*\"\',+-]/',$myrowrm["length"])||preg_match('/[$&*\"\',+]-/',$myrow[5]))
     {
        $match_flag = 1;
     }
     if(preg_match('/[$&*\"\',+-]/',$myrowrm["width"])||preg_match('/[$&*\"\',+-]/',$myrow[6]))
     {
        $match_flag = 1;
     }
     if(preg_match('/[$&*\"\',+-]/',$myrowrm["thickrness"])||preg_match('/[$&*\"\',+-]/',$myrow[7]))
     {
        $match_flag = 1;
     }
     if(preg_match('/[$&*\"\',+-]/',$myrowrm["rm_grainflow"])||preg_match('/[$&*\"\',+-]/',$myrow[8]))
     {
        $match_flag = 1;
     }
     if(preg_match('/[$&*\"\',+-]/',$myrowrm["rm_mrs"])||preg_match('/[$&*\"\',+-]/',$myrow[10]))
     {
        $match_flag = 1;
     }

     }

     }

     }
     }
     else
     {
     //echo"HERE222---";
$result_partmst = $newpo_li->getpart_masterDetails4po($crn,$vendor);
$numrow_prtmst=mysql_num_rows($result_partmst);
//echo$numrworm."*******************";
         if($numrow_prtmst ==0)
         {
               echo "<table border=0><tr><td><font color=#FF0000>";
               die("Possible causes: No matching Supplier for PART# in PART Master");
               echo "</td></tr></table>";
         }
         else{

?>
<tr><td><span class="pageheading"><b>Part Master Details</b></td></tr>
<tr><td>

<table style="table-layout: fixed" width=1100px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
       <tr  bgcolor="#FFCC00">
            <td width=50px bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=80px bgcolor="#EEEFEE"><span class="tabletext"><b>Supplier</b></td>
            <td width=100px bgcolor="#EEEFEE"><span class="tabletext"><b>Part#</b></td>
            <td width=100px bgcolor="#EEEFEE"><span class="tabletext"><b>Manufacture Part#</b></td>
            <td width=50px bgcolor="#EEEFEE"><span class="tabletext"><b>RM <br>Price</b></td>
            <td width=50px bgcolor="#EEEFEE"><span class="tabletext"><b>Type</b></td>
       </tr>
</table>
<div style="width:1110px; height:265; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=1100px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<?php
while($myrow_prtmst = mysql_fetch_assoc($result_partmst))
{
   $no_length=round($order_qty);
   $no_meterages="0.00";
?>
<tr bgcolor="#FFFFFF"><td width=50px bgcolor="#FFFFFF"><input type="radio" name="crn"  value="<?php echo $crn."|".$myrow_prtmst["mfr_partnum"]."|".$myrow_prtmst["rate"]. "|" .$myrow_prtmst["ptype"]. "|" .$no_length. "|" .$no_meterages?>"></td>
                           <td width=80px ><span class="tabletext"><?php echo wordwrap($myrow_prtmst["name"],30,"<br>\n",true )?></td>
                          <td width=100px ><span class="tabletext"><?php echo $crn ?></td>
                          <td width=100px><span class="tabletext"><?php echo $myrow_prtmst["mfr_partnum"] ?></td>
                          <td width=50px><span class="tabletext"><?php echo $myrow_prtmst["rate"] ?></td>
                          <td width=50px><span class="tabletext"><?php echo $myrow_prtmst["ptype"] ?></td></tr>
<?php
}
}
}
?>

</table>
 </div>

<script language=javascript>
function SubmitCIM(etype){
 var flag=0;
 var user_input;
 //alert(document.forms[0].crn.length);
//alert(user_input);
//alert(ctype);
if(document.forms[0].crn.length)
{
 for (i=0;i<document.forms[0].crn.length;i++) {
	if (document.forms[0].crn[i].checked) {
		user_input = document.forms[0].crn[i].value;
		flag=1;
	}
}
}
else if(document.forms[0].crn.checked)
{
  user_input = document.forms[0].crn.value;
  flag = 1;
}
if(flag == 0)
{
  alert('Please select appropriate CRN before submitting');
  self.close();
}
//alert(user_input);
window.opener.SetCrn(user_input,etype,'<?php echo $match_flag?>','<?php echo $potype ?>');
self.close();}

</script>
<input type=button value="Submit" onclick="javascript: return SubmitCIM(window.name)">
</form>
</body>
</html>

