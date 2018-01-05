<script language="javascript" src="scripts/grn.js"></script>
<form action='getvalidategrn.php' method='post' enctype='multipart/form-data'>
<table>
<tr>
<td>
<?

include('classes/grnclass.php');
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>Validation</title>
</head>
<body>
<table width=100% border=0 cellpadding=4 cellspacing=1 >
<tr><td>
<?
$newgrn = new grn;
$pattern="/[$&*\"\'\/\\-\\s\;\,\:#!.,+]/";
$pattern2="/[$&*\"\'\/\\-\\s\;\,\:#!,+]/";
$thick_pattern=array('to','-','<');
$crn=$_REQUEST['crn'];
$cimponum=(str_replace("and","&",$_REQUEST['po_num']));
//$me=str_replace("and","&","iandme");
//echo$cimponum."-here";
$rmpoline_num1=$_REQUEST['po_line_num'];
$grn_qty=$_REQUEST['grn_qty'];
$length=(preg_replace($pattern2,"", $_REQUEST['length']));
$width=(preg_replace($pattern2,"", $_REQUEST['width']));
$thickness=(preg_replace($pattern2,"", $_REQUEST['thickness']));
$rm_cost=(preg_replace($pattern2,"", $_REQUEST['rm_cost']));
$uom1 =(preg_replace($pattern,"", $_REQUEST['uom']));
$vendrecnum=$_REQUEST['vendrecnum'];
$raw_mat_type=(preg_replace($pattern,"", $_REQUEST['rm_type']));
$raw_mat_spec=(preg_replace($pattern,"", $_REQUEST['rm_spec']));
$rm_currency=$_REQUEST['currency'];
$grntype=$_REQUEST['grntype'];
$grn_num=$_REQUEST['grn_num'];
$amend_line=$_REQUEST['amendline'];
$partnum=(preg_replace($pattern,"", $_REQUEST['partnum']));
//echo$partnum."----------";
$min_length=0;$min_width=0;$max_length=0;$max_width=0;$min_thick=0;$max_thick=0;$powidth=0.0;$pothickness=0.0;
            if($cimponum != '' && $grntype!="Boughtout")
             {
               $result_po=$newgrn->getpo_details($cimponum);
               $tot_grn_qty=$newgrn->getpogrndetails($cimponum,$crn,$grn_num);
                //echo $grn_qty;
               $final_grn_qty= $tot_grn_qty+$grn_qty;

               if($result_po == '')
               {
                   echo "<table border=1><tr><td><font color=#FF0000>";
                   echo("-- PO Number Does Not Exist" );
                   echo "</td></tr></table>";
                   $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
               }
               else
               {
                 $result_crn_line=$newgrn->getcrn_line_num($crn,$cimponum,$rmpoline_num1);
                 if(mysql_num_rows($result_crn_line) > 0)
                 {
                   $resultprtnum=$newgrn->getcrnpartnum($crn);
                  //echo(preg_replace("/[$&*\"\'\/\ ,+]/","", $resultprtnum))."<br>";
                   $result_rmpo=$newgrn->getrmpoDetails($crn,$cimponum,$rmpoline_num1);
                   $myrmpo=mysql_fetch_assoc($result_rmpo);
                                  //echo preg_replace("/[$&*\"\'\/\ ,+]/","", $myrmpo['uom'])."------------------".$uom1;
                 if($myrmpo["no_of_meterages"] != '0.00' && $myrmpo["no_of_meterages"] != '0' && $myrmpo["no_of_meterages"] != '' )
                 {
                      $rmpo_qty= $myrmpo["no_of_meterages"];
                      //echo $rmpo_qty."11111";
                 }else
                 {
                     $rmpo_qty= $myrmpo["no_of_lengths"];
                     //echo $rmpo_qty."22222";
                 }
                 $count1 =10/100;
                 $count2 = $count1 * ($tot_grn_qty);
                 //echo $count2;
                 $count = round($count2, 0);

                 $final_rmpoqty= $count+$rmpo_qty;
                 //echo $raw_mat_spec."------------".(preg_replace("/[$&*\"\'\/\\-\ ,+]/","", $myrmpo['material_spec']));
                // echo $final_rmpoqty."************".$count."------------".$final_grn_qty;
                 //echo ($myrmpo['length']."111-----".$length);
                 //echo $myrmpo['width']."2222---------------".$width;
                 if((trim(strtoupper($myrmpo['link2vendor'])) != trim(strtoupper($vendrecnum))))
                 {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo ("-- Suppliers Are Different" );
                   echo "</td></tr></table>";$f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }
                  if((trim(strtoupper((preg_replace($pattern,"", $myrmpo['material_ref'])))) != trim(strtoupper($raw_mat_type))))
                 {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- Material  Types  Don't Match" );
                   echo "</td></tr></table>"; $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }
                  if((trim(strtoupper((preg_replace($pattern,"", $myrmpo['material_spec'])))) != trim(strtoupper($raw_mat_spec))))
                 {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- Material Specifications Don't match" );
                   echo "</td></tr></table>";$f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }
                  if((trim(strtoupper((preg_replace($pattern2,"", $myrmpo['rate'])))) != trim(strtoupper($rm_cost))))
                 {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- RMPO COSTS are different" );
                   echo "</td></tr></table>"; $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }
/*
                  else if((trim(strtoupper($myrmpo['currency'])) != trim(strtoupper($rm_currency))))
                 {
                   echo "<table border=1><tr><td><font color=#FF0000>";
                   echo("Currency Is Different" );
                   echo "</td></tr></table>"; $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }
*/
                   if($myrmpo['length'] == 'STD' || $myrmpo['length'] == 'std')
                   {
                      $powidth='0.01'  ;
                      //echo $powidth."--1--if--loop---".$myrmpo['length']."<br>";
                   }
                   else
                   {
                      $powidth=$myrmpo['length'];
                      //echo $powidth."--2--else--loop---".$myrmpo['length'];
                   }

                 /*  if($myrmpo['thick'] == 'STD' || $myrmpo['thick'] == 'std')
                   {
                      $pothickness='0.01'  ;
                      //echo $powidth."--1--if--loop---".$myrmpo['length']."<br>";
                   }
                   else
                   {
                      $pothickness=$myrmpo['thick'];
                      //echo $powidth."--2--else--loop---".$myrmpo['length'];
                   } */
                   
                 if($myrmpo['length'] != "" && $myrmpo['length'] != "-" && $myrmpo['length'] != "NA" && $myrmpo['length'] != 0)
                 {
                   $final_width= ereg_replace("[^0-9 .]", "", $powidth);
                   $final_length= ereg_replace("[^0-9 .]", "", $myrmpo['width']);
                   $final_thickness= ereg_replace("[^0-9 .]", "", $pothickness);
                   //echo $final_width."po---width---<br>";
                   $min_width=$final_width-1;
                   $max_width=$final_width+3;
                   $min_length=$final_length-1;
                   $max_length=$final_length+3;
                   $min_thickness=$final_thickness-1;
                   $max_thickness=$final_thickness+3;
                   $mxup=0;
                   $mxdw=0;
                   //echo $min_thickness."t------e-----s-----t-----minlen".$min_width."--------------$length---------------".$myrmpo['length']."<br>";

                   //echo $max_thickness."t------e-----s-----t-----maxlen".$max_width."--------------".$width;
                  if((trim(strtoupper($width))< trim(strtoupper((preg_replace($pattern2,"", $min_width)))))
                  || (trim(strtoupper((preg_replace($pattern2,"", $max_width)))) < trim(strtoupper($width))))

                 {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- The Entered Width does not match with RM PO Width" );
                   echo "</td></tr></table>"; $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }
                 if((trim(strtoupper($length))< trim(strtoupper((preg_replace($pattern2,"", $min_length)))))
                  || (trim(strtoupper((preg_replace($pattern2,"", $max_length)))) < trim(strtoupper($length))))
                 {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- The Entered Length does not match with RM PO Length" );
                   echo "</td></tr></table>";$f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }
				 /*
                 if($myrmpo['maxruling'] != "-" && $myrmpo['maxruling'] !="")
                 {
                  if((trim(strtoupper($thickness))< trim(strtoupper((preg_replace($pattern,"", $myrmpo['thick'])))))
                  || (trim(strtoupper((preg_replace($pattern,"", $myrmpo['maxruling'])))) < trim(strtoupper($thickness))))
                 {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- The Entered Thickness does not match with RM PO thickness" );
                   echo "</td></tr></table>"; $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }
                 }
                 else
                 {
                    if((trim(strtoupper($thickness))< trim(strtoupper((preg_replace($pattern,"", $min_thickness)))))
                  || (trim(strtoupper((preg_replace($pattern,"", $max_thickness)))) < trim(strtoupper($thickness))))

                 {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- The Entered Thickness does not match with RM PO thickness" );
                   echo "</td></tr></table>"; $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }
                 
                 }
				 */
               }
               else
               {
                   $min_thickness=$myrmpo['thick']-1;
                   $max_thickness=$myrmpo['thick']+3;
                  /* if((trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $myrmpo['length'])))) != trim(strtoupper($width))))
                 {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- The Entered Width does not match with RM PO Width" );
                   echo "</td></tr></table>"; $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }*/
                 /*if((trim(strtoupper((preg_replace("/[$&*\"\'\/\ ,+]/","", $myrmpo['width'])))) != trim(strtoupper($length))))
                 {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- The Entered Length does not match with RM PO Length" );
                   echo "</td></tr></table>";$f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 } */
                 /*
                 if($myrmpo['maxruling'] != "-" && $myrmpo['maxruling'] !="")
                 {    $final_maxruling= ereg_replace("[^0-9]", "", $myrmpo['maxruling']);
                     //echo"$final_maxruling-------------";
                  if((trim(strtoupper($thickness))< trim(strtoupper((preg_replace($pattern,"", $myrmpo['thick'])))))
                  || (trim(strtoupper((preg_replace($pattern,"", $final_maxruling)))) < trim(strtoupper($thickness))))
                 {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- The Entered Thickness does not match with RM PO thickness" );
                   echo "</td></tr></table>"; $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }
                 }
                 else
                 {

                   if((trim(strtoupper($thickness))< trim(strtoupper((preg_replace($pattern,"", $min_thickness)))))
                  || (trim(strtoupper((preg_replace($pattern,"", $max_thickness)))) < trim(strtoupper($thickness))))
                 {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- The Entered Thickness does not match with RM PO thickness" );
                   echo "</td></tr></table>"; $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }

                 }
             */
               }
                  if((trim(strtoupper((preg_replace($pattern,"", $myrmpo['uom'])))) != trim(strtoupper($uom1))) )
                 {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- UOM Does not match with RM PO" );
                   echo "</td></tr></table>"; $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }
                  if($final_grn_qty > $final_rmpoqty)
                 {
					 // echo("$final_grn_qty in qty check $final_rmpoqty");
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- Entered QTY more than the RMPO QTY" );
                   echo "</td></tr></table>"; $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }
                 if($grntype=='Consummables')
                 {
                     if((trim(strtoupper((preg_replace($pattern,"", $resultprtnum)))) != trim(strtoupper($partnum))))
                   {
                     echo "<table border=0><tr><td><font color=#FF0000>";
                     echo("-- Partnumber Does not match with the MasterData Partnumber" );
                     echo "</td></tr></table>"; $f11='1';
                     echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                   }
                 }

                }
                else
                {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- The Crn : $crn with Line Number: $rmpoline_num1 Does Not Exist For Ponum: $cimponum" );
                   echo "</td></tr></table>"; $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                }
              }
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("* Validation Complete" );
                   echo "</td></tr></table>";
                   //echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
             }
             else
             {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("* Validation Not Required" );
                   echo "</td></tr></table>";$f11='0';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
             }

?>

</td>
</tr>
</table>
<script language=javascript>
function SubmitMessage(etype){
 var flag=0;
 var user_input;
window.opener.Setvalidate_flag(<?php echo $f11 ?>);
self.close();}

</script>
<table>
<tr bgcolor='#FFFFFF'>
<td valign='bottom' align='center' colspan=2>
<span class="labeltext"><input type="button"
                     style="color=#0066CC;background-color:#DDDDDD;width=80;"
                     value="OK" name="submit" onClick="javascript: return SubmitMessage(window.name)">
</td>
</tr>
</table>
</form>
</body>
</html>
