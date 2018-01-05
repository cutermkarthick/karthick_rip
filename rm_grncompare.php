<div id="rm_grn_compare">
<?
include('classes/grnclass.php');
$newgrn = new grn;
$grnrecnum=$_REQUEST['grnrecnum'];
//echo $grnrecnum;
$grnrecnum = $_REQUEST['grnrecnum'];
$result = $newgrn->getgrn($grnrecnum);
$myrowgrn = mysql_fetch_row($result);
$grnli = $newgrn->getgrnli($grnrecnum);
//$myrowgrnli = mysql_fetch_row($grnli);
//echo$myrowgrn[36].'------------------'.$myrowgrn[30].'******************'.$myrowgrnli[16];

?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>RMPO - GRN</title>
</head>
<body onload=self.focus()>

<form action='rm_grncompare.php' method='post' enctype='multipart/form-data'>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF">
<table>
<?php
while($myrowgrnli = mysql_fetch_row($grnli))
{
 $result_po=$newgrn->getpo_details($myrowgrn[30]);

               if($result_po == '')
               {
                   echo "<table border=1><tr><td><font color=#FF0000>";
                   echo "PO Number Does Not Exist" ;
                   echo "</td></tr></table>";
               }
               else
               {
                 $result_crn_line=$newgrn->getcrn_line_num($myrowgrn[36],$myrowgrn[30],$myrowgrnli[16]);
                 if(mysql_num_rows($result_crn_line) > 0)
                 {

?>
<tr><td><span class="pageheading"><b>RM Master Details</b></td></tr>
<tr><td>

<table style="table-layout: fixed" width=800px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
       <tr  bgcolor="#FFCC00">
            <td width=60px bgcolor="#EEEFEE"><span class="tabletext"><b>PO#</b></td>
              <td width=40px bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
             <td width=120px bgcolor="#EEEFEE"><span class="tabletext"><b>Supplier</b></td>
            <td width=80px bgcolor="#EEEFEE"><span class="tabletext"><b>RM Spec</b></td>
            <td width=80px bgcolor="#EEEFEE"><span class="tabletext"><b>RM Type</b></td>
            <td width=20px bgcolor="#EEEFEE"><span class="tabletext"><b>UOM</b></td>
            <td width=30px bgcolor="#EEEFEE"><span class="tabletext"><b>Length</b></td>
            <td width=30px bgcolor="#EEEFEE"><span class="tabletext"><b>Width</b></td>
            <td width=50px bgcolor="#EEEFEE"><span class="tabletext"><b>Thickness</b></td>
            <td width=45px bgcolor="#EEEFEE"><span class="tabletext"><b>PO(unit) <br>Price</b></td>
            <td width=20px bgcolor="#EEEFEE"><span class="tabletext"><b>Qty</b></td>
       </tr>
</table>

<div style="width:1000px; height:265; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=800px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<?php

   $result_rmpo=$newgrn->getrmpoDetails($myrowgrn[36],$myrowgrn[30],$myrowgrnli[16]);
   $myrowpo = mysql_fetch_assoc($result_rmpo);
               if($myrowpo["no_of_meterages"] != '0.00' && $myrowpo["no_of_meterages"] != '0' && $myrowpo["no_of_meterages"] != '' )
                 {
                      $rmpo_qty= $myrowpo["no_of_meterages"];
                      //echo $rmpo_qty."11111";
                 }else
                 {
                     $rmpo_qty= $myrowpo["no_of_lengths"];
                     //echo $rmpo_qty."22222";
                 }
                 $currency = array("$");
                 $po_price = str_replace($currency, "", $myrowpo["rate"]);
                 $cname=wordwrap($myrowpo["name"],25,"<br>\n",true);
                 
?>
<tr bgcolor="#FFFFFF">
                          <td width=60px ><span class="tabletext"><?php echo $myrowpo["ponum"] ?></td>
                          <td width=40px ><span class="tabletext"><?php echo $myrowpo["crn"]?></td>
                           <td width=120px ><span class="tabletext"><?php echo $cname ?></td>
                          <td width=80px><span class="tabletext"><?php echo $myrowpo["material_spec"] ?></td>
                          <td width=80px><span class="tabletext"><?php echo $myrowpo["material_ref"] ?></td>
                          <td width=20px><span class="tabletext"><?php echo $myrowpo["uom"] ?></td>
                          <td width=30px><span class="tabletext"><?php echo $myrowpo["width"] ?></td>
                          <td width=30px><span class="tabletext"><?php echo $myrowpo["length"] ?></td>
                          <td width=50px><span class="tabletext"><?php echo $myrowpo["thick"] ?></td>
                          <td width=45px><span class="tabletext"><?php echo $po_price?></td>
                          <td width=20px><span class="tabletext"><?php echo $rmpo_qty ?></td>


</tr>

       <tr  bgcolor="#FFCC00">
            <td width=60px bgcolor="#EEEFEE"><span class="tabletext"><b>CIM PO#</b></td>
             <td width=40px bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
             <td width=120px bgcolor="#EEEFEE"><span class="tabletext"><b>Supplier</b></td>
            <td width=80px bgcolor="#EEEFEE"><span class="tabletext"><b>RM Spec</b></td>
            <td width=80px bgcolor="#EEEFEE"><span class="tabletext"><b>RM Type</b></td>
            <td width=20px bgcolor="#EEEFEE"><span class="tabletext"><b>UOM</b></td>
            <td width=30px bgcolor="#EEEFEE"><span class="tabletext"><b>Length</b></td>
            <td width=30px bgcolor="#EEEFEE"><span class="tabletext"><b>Width</b></td>
            <td width=50px bgcolor="#EEEFEE"><span class="tabletext"><b>Thickness</b></td>
            <td width=45px bgcolor="#EEEFEE"><span class="tabletext"><b>GRN(unit) <br>Price</b></td>
            <td width=20px bgcolor="#EEEFEE"><span class="tabletext"><b>Qty</b></td>
       </tr>

<?php
                 $count1 =10/100;
                 $count2 = $count1 * $myrowgrnli[1];
                 //echo $count2;
                 $count = round($count2, 0);

                 $final_rmpoqty= $count+$rmpo_qty;
                 //echo $final_rmpoqty."************".$qty1;
                 //echo ($myrmpo['length']."-----".$dim11);
                 //printf('<tr  bgcolor="#FFFFFF">
                 //<td  bgcolor="#FFFFFF" colspan=15 align="center"><span class="heading"><b>GRN Details</b></td></tr>');
                 $cname_grn=wordwrap($myrowgrn[23],25,"<br>\n",true);
                 echo "<td bgcolor=\"#FFFFFF\" width=60px><span class=\"tabletext\">$myrowgrn[30] </td>";
                        echo "<td bgcolor=\"#FFFFFF\" width=40px><span class=\"tabletext\">$myrowgrn[36]</td>";
                 if((trim(strtoupper($myrowpo['link2vendor'])) != trim(strtoupper($myrowgrn[24]))))
                 {
                   echo "<td bgcolor=\"#FF0000\" width=120px><span class=\"tabletext\">$cname_grn</td>";
							 //$match_flag = 1;
                 }
                 else{

                  echo "<td bgcolor=\"#FFFFFF\" width=120px><span class=\"tabletext\">$cname_grn</td>";
                  }
                  

                  if((trim(strtoupper($myrowpo['material_spec'])) != trim(strtoupper($myrowgrn[5]))))
                 {
                   //echo "<table border=1><tr><td><font color=#FF0000>";
                    echo "<td bgcolor=\"#FF0000\" width=80px><span class=\"tabletext\">$myrowgrn[5]</td>";
							 //$match_flag = 1;
                 }
                 else{

                  echo "<td bgcolor=\"#FFFFFF\" width=80px><span class=\"tabletext\">$myrowgrn[5]</td>";
                  }
                   if((trim(strtoupper($myrowpo['material_ref'])) != trim(strtoupper($myrowgrn[4]))))
                 {
                     echo "<td bgcolor=\"#FF0000\" width=80px><span class=\"tabletext\">$myrowgrn[4]</td>";
							 //$match_flag = 1;
                 }
                 else{

                  echo "<td bgcolor=\"#FFFFFF\" width=80px><span class=\"tabletext\">$myrowgrn[4]</td>";
                  }
                  if((trim(strtoupper($myrowpo['uom'])) != trim(strtoupper($myrowgrnli[14]))))
                 {
                   //echo "<table border=1><tr><td><font color=#FF0000>";
                  echo "<td bgcolor=\"#FF0000\" width=20px><span class=\"tabletext\">$myrowgrnli[14]</td>";
							 //$match_flag = 1;
                 }
                 else{

                  echo "<td bgcolor=\"#FFFFFF\" width=20px><span class=\"tabletext\">$myrowgrnli[14]</td>";
                  }
                 if((trim(strtoupper($myrowpo['width'])) != trim(strtoupper($myrowgrnli[2]))))
                 {
                   echo "<td bgcolor=\"#FF0000\" width=30px><span class=\"tabletext\">$myrowgrnli[2]</td>";
							 //$match_flag = 1;
                 }
                 else{

                  echo "<td bgcolor=\"#FFFFFF\" width=30px><span class=\"tabletext\">$myrowgrnli[2]</td>";
                  }
                 if((trim(strtoupper($myrowpo['length'])) != trim(strtoupper($myrowgrnli[3]))))
                 {
                   echo "<td bgcolor=\"#FF0000\" width=30px><span class=\"tabletext\">$myrowgrnli[3]</td>";
							 //$match_flag = 1;
                 }
                 else{

                  echo "<td bgcolor=\"#FFFFFF\" width=30px><span class=\"tabletext\">$myrowgrnli[3]</td>";
                  }

                  if((trim(strtoupper($myrowpo['thick'])) != trim(strtoupper($myrowgrnli[4]))))
                 {
                   echo "<td bgcolor=\"#FF0000\" width=50px><span class=\"tabletext\">$myrowgrnli[4]</td>";
							 //$match_flag = 1;
                 }
                 else{

                  echo "<td bgcolor=\"#FFFFFF\" width=50px><span class=\"tabletext\">$myrowgrnli[4]</td>";
                  }

                 if((trim(strtoupper($myrowpo['rate'])) != trim(strtoupper($myrowgrn[46]))))
                 {
                   //echo "<table border=1><tr><td><font color=#FF0000>";
                    echo "<td bgcolor=\"#FF0000\" width=45px><span class=\"tabletext\">$myrowgrnli[46]</td>";
							 //$match_flag = 1;
                 }
                 else{

                  echo "<td bgcolor=\"#FFFFFF\" width=45px><span class=\"tabletext\">$myrowgrnli[46]</td>";
                  }

                  if($myrowgrnli[1] > $final_rmpoqty )
                 {
                   //echo "<table border=1><tr><td><font color=#FF0000>";
                   echo "<td bgcolor=\"#FF0000\" width=20px><span class=\"tabletext\">$myrowgrnli[1]</td>";
							 //$match_flag = 1;
                 }
                 else{

                  echo "<td bgcolor=\"#FFFFFF\" width=20px><span class=\"tabletext\">$myrowgrnli[1]</td>";
                  }

?>
</table>
<?php

}
else
                {
                  echo "<table border=1><tr><td><font color=#FF0000>";
                   echo"The Crn : $crn with Line Number: $rmpoline_num1 Does Not Exist For Ponum: $cimponum";
                   echo "</td></tr></table>";
                }
}

}

?>
</table>
</div>
