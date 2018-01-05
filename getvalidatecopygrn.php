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
$pattern="/[$&*\"\'\/\-\s\;\,\:#!.,+]/";
$pattern2="/[$&*\"\'\/\-\s\;\,\:#!,+]/";
$thick_pattern=array('to','-','<');
$crn=$_REQUEST['crn'];
//$length=(preg_replace($pattern2,"", $_REQUEST['length']));
$length=(ereg_replace("[^0-9 .]","", $_REQUEST['length']));
$width=(ereg_replace("[^0-9 .]","", $_REQUEST['width']));
$thickness=(ereg_replace("[^0-9 .]","", $_REQUEST['thickness']));
//$vendrecnum=$_REQUEST['vendrecnum'];
$raw_mat_type=(preg_replace($pattern,"", $_REQUEST['rm_type']));
$raw_mat_spec=(preg_replace($pattern,"", $_REQUEST['rm_spec']));
$partnum=(preg_replace($pattern,"", $_REQUEST['partnum']));
$grntype=$_REQUEST['grntype'];
$line_num=$_REQUEST['line_num'];
//echo$length."111----------<br>";
//$crn=0;
$match_rm =0;
$min_length=0;$min_width=0;$max_length=0;$max_width=0;$min_thickness=0;$max_thickness=0;

                  $resultcrndet=$newgrn->getcrnmasterdetails($crn);
                  $resultprtnum=$newgrn->getcrnpartnum($crn);
                 // $mycrmd=mysql_fetch_assoc($resultcrndet);
                  //$resultrmcrn=$newgrn->getrmdcrnetails($crn);
                  $resultrmdet=$newgrn->getrmdetails($crn);
                  //$myrmdet=mysql_fetch_assoc($resultrmdet);

                     if(mysql_num_rows($resultrmdet)> 0)
                {
                 if(mysql_num_rows($resultrmdet)== 0)
                 {
                    echo "<table border=0><tr><td><font color=#FF0000>";
                    echo("-- Material  Type/Material Spec Don't Match" );
                    echo "</td></tr></table>"; $f11='1';
                    echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }
                 else
                 { //echo $match_rm."t----e----s----t".$myrmdet['rm_type']."+++++++++".$raw_mat_type."**********".$myrmdet['rm_spec']."/////////".$raw_mat_spec;

                    while($myrmdet=mysql_fetch_assoc($resultrmdet))
                    {
                       if((trim(strtoupper((preg_replace($pattern,"", $myrmdet['rm_type'])))) == trim(strtoupper($raw_mat_type)))
                       &&(trim(strtoupper((preg_replace($pattern,"", $myrmdet['rm_spec'])))) == trim(strtoupper($raw_mat_spec))))
                    {
                      $match_rm=1;
                        /* echo "<table border=0><tr><td><font color=#FF0000>";
                        echo("-- Material  Types and Material Specifications Match for". $myrmdet['rm_altrm']."" );
                        echo "</td></tr></table>"; $f11='1';
                        echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>"; */
                 /*       if((trim(strtoupper((preg_replace($pattern,"", $myrmdet['rm_type'])))) != trim(strtoupper($raw_mat_type))))
                    {
                        echo "<table border=0><tr><td><font color=#FF0000>";
                        echo("-- Material  Types  Don't Match for". $myrmdet['rm_altrm']."" );
                        echo "</td></tr></table>"; $f11='1';
                        echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                    }
                    if((trim(strtoupper((preg_replace($pattern,"", $myrmdet['rm_spec'])))) != trim(strtoupper($raw_mat_spec))))
                     {
                         echo "<table border=0><tr><td><font color=#FF0000>";
                         echo("-- Material Specifications Don't match for". $myrmdet['rm_altrm']."" );
                         echo "</td></tr></table>";$f11='1';
                         echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                     } */
                   }

                // echo $match_rm."t----e----s----t222";
                   if($match_rm==0)
                   {
                    if((trim(strtoupper((preg_replace($pattern,"", $myrmdet['rm_type'])))) != trim(strtoupper($raw_mat_type)))
                    ||(trim(strtoupper((preg_replace($pattern,"", $myrmdet['rm_spec'])))) != trim(strtoupper($raw_mat_spec))))
                   {
                      if((trim(strtoupper((preg_replace($pattern,"", $myrmdet['rm_type'])))) != trim(strtoupper($raw_mat_type))))
                   {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- Material  Types  Don't Match for ". $myrmdet['rm_altrm']."" );
                   echo "</td></tr></table>"; $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                   }
                  if((trim(strtoupper((preg_replace($pattern,"", $myrmdet['rm_spec'])))) != trim(strtoupper($raw_mat_spec))))
                     {
                       echo "<table border=0><tr><td><font color=#FF0000>";
                       echo("-- Material Specifications Don't match for". $myrmdet['rm_altrm']."" );
                       echo "</td></tr></table>";$f11='1';
                       echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                     }
                  }
                 }
                 }
               }

                }
                else
                {
                  //echo"";
                  echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("The Entered CRN: $crn Is Not Present In RM Master " );
                   echo "</td></tr></table>"; $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";

                }
                 while($mycrmd=mysql_fetch_assoc($resultcrndet))
                {  //echo$mycrmd['rm_dim1']."-------------$length";
                
                   $final_width= ereg_replace("[^0-9 .]", "", $mycrmd['rm_dim2']);
                   $final_length= ereg_replace("[^0-9 .]", "", $mycrmd['rm_dim1']);
                   $final_thickness= ereg_replace("[^0-9 .]", "", $mycrmd['rm_dim3']);
                   $min_width=$final_width-1;
                   $max_width=$final_width+3;
                   $min_length=$final_length-1;
                   $max_length=$final_length+3;
                   $min_thickness=$final_thickness-1;
                   $max_thickness=$final_thickness+3;
                   $mxup=0;
                   $mxdw=0;

                 if($width !="" && $width != "-" && $width !=0)
                 { //echo"HERE $min_length-----------$max_length";

                  if((trim(strtoupper($length))< trim(strtoupper((preg_replace($pattern2,"", $min_length)))))
                  || (trim(strtoupper((preg_replace($pattern2,"", $max_length)))) < trim(strtoupper($length))))

                 {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- The Entered Length does not match with CRN Master Length " );
                   echo "</td></tr></table>"; $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }

                  if((trim(strtoupper($width))< trim(strtoupper((preg_replace($pattern2,"", $min_width)))))
                  || (trim(strtoupper((preg_replace($pattern2,"", $max_width)))) < trim(strtoupper($width))))
                {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- The Entered Width does not match with CRN Master Width " );
                   echo "</td></tr></table>";$f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }

               /*  if($mycrmd['maxruling'] !="" && $mycrmd['maxruling'] !="-" )
                 {
                   for($th=0;$th<count($thick_pattern);$th++)
                  {           //echo count($thick_ness)."-----------".$thick_ness[$th];
                      $pos = strpos($mycrmd['maxruling'],$thick_pattern[$th]);
                           if($pos === false) {

                           }
                           else
                           {
                             $thicknessarr = split($thick_pattern[$th], $mycrmd['maxruling']);
                             $mxup=ereg_replace("[^0-9 .]", "", $thicknessarr[1]);
                             $mxdw=ereg_replace("[^0-9 .]", "", $thicknessarr[0]);
                           }

                 }
                 if($mxup==0)
                 {
                    $final_maxruling= ereg_replace("[^0-9 .]", "", $mycrmd['maxruling']);
                 if(($thickness< $final_thickness)
                  || ($final_maxruling < $thickness))
                 {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- The Entered Thickness does not match with CRN Master thickness" );
                   echo "</td></tr></table>"; $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }
                 }
                 else
                 {
                  //$minThick=preg_replace("/[^0-9 .]/", '', $mxdw);
                   if(($thickness < $mxdw)
                  || ($mxup < $thickness))
                 {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- The Entered Thickness does not match with RM PO thickness" );
                   echo "</td></tr></table>"; $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }
                 }


                 }
                 else
                 {
                   if(($thickness < $min_thickness)
                  || ($max_thickness < $thickness))
                 {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- The Entered Thickness does not match with CRN Master thickness " );
                   echo "</td></tr></table>"; $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }
                 } */

                 }
                 else
                 {

                   //echo "HERE-----".$mycrmd['maxruling'];
                /* if($mycrmd['maxruling'] !="" && $mycrmd['maxruling'] !="-" )
                 {
                   for($th=0;$th<count($thick_pattern);$th++)
                  {           //echo $mycrmd['maxruling']."-----------".$thick_ness[$th];
                      $pos = strpos($mycrmd['maxruling'],$thick_pattern[$th]);
                           if($pos === false) {

                           }
                           else
                           {
                             $thicknessarr = split($thick_pattern[$th], $mycrmd['maxruling']);
                             $mxup=$thicknessarr[1];
                             $mxdw=$thicknessarr[0];
                           }

                 }
                 if($mxup==0)
                 {
                    $final_maxruling= ereg_replace("[^0-9 .]", "", $mycrmd['maxruling']);
                 if(($thickness < $final_thickness)
                  || ($final_maxruling < $thickness))
                 {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- The Entered Thickness does not match with CRN Master thickness" );
                   echo "</td></tr></table>"; $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }
                 }
                 else
                 {
                  $minThick=preg_replace("/[^0-9 .]/", '', $mxdw);
                   if(($thickness <  $minThick)
                  || ($mxup < $thickness))
                 {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- The Entered Thickness does not match with RM PO thickness" );
                   echo "</td></tr></table>"; $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }
                 }


                 }
                 else
                 {
                   if(($thickness < $min_thickness)
                  || ($max_thickness < $thickness))
                 {
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("-- The Entered Thickness does not match with CRN Master thickness " );
                   echo "</td></tr></table>"; $f11='1';
                   echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";
                 }
                 }  */


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
                   echo "<table border=0><tr><td><font color=#FF0000>";
                   echo("* Validation Complete" );
                   echo "</td></tr></table>";
                   //echo"<input type=\"hidden\" name=\"f11\" id=\"f11\" value='$f11'>";


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
