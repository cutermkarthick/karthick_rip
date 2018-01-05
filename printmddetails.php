<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>
<script script language="javascript" type="text/javascript">
   function toggleValue(divid,chk)
{

 if(chk.checked)
 {
  if(document.getElementById(divid).value == "yes")
  {
    document.getElementById(divid).value="no";
    chk.checked=false;
  }
  else
  {
   document.getElementById(divid).value="yes";
  }
 }
 else
 {
   document.getElementById(divid).value="no";
 }

}
</script>
<table border="0" width="100%" rule=all cellspacing=0 >
<tr bgcolor="#DFDEDF">
  <td><span class="heading"><center>&nbsp;
  </center></td>
</tr>
</table>

<?php
 include('classes/mc_masterClass.php');
 $mc_master = new mc_master;
 $resultmd = $newMD->getmasterdata4wo($link2masterdata);
 $mymd = mysql_fetch_row($resultmd);
 $resultgrn=$newMD->getgrndet4wo($grn_num);
 $mygrn=mysql_fetch_row($resultgrn);
 if($myrow[34] == 0)
  {
    $mps_rev = $mymd[16];
  }
 else
  {
    $mps_rev = $myrow[35];
  }
  $partiss = htmlspecialchars($mymd[7]);
  $drgiss = htmlspecialchars($mymd[10]);
?>
<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=0 rule=all>
 <tr><td align="left" valign="top" width=40%><table width="100%" border="1" cellpadding="0" cellspacing="0" rule="all">
   <tr>
     <td width="36%">
         <p align="left" class="style1">PRN REF NO</p>
         </font></td>
     <td class="style1"><?php echo $mymd[9] ?>&nbsp;</td>
   </tr>
   <tr>
     <td>
         <p align="left" class="style1">PROJECT</p>
         </font></td>
     <td class="style1"><?php echo $mymd[6] ?>&nbsp;</td>
   </tr>
   <tr>
     <td>
         <p align="left" class="style1">PART NO </p>
         </font></td>
     <td class="style1"><?php echo $mymd[4] ?>&nbsp;</td>
   </tr>
   <tr>
     <td>
         <p align="left" class="style1">PART NAME </p>
         </font></td>
     <td class="style1"><?php echo $mymd[1] ?>&nbsp; </td>
   </tr>
   <tr>
     <td>
         <p align="left" class="style1">Part Iss/ATTACH</p>
         </font></td>
     <td class="style1"><?php echo $partiss ?>&nbsp; </td>
   </tr>
 </table></td>
   <td width=2%>&nbsp;</td>
   <td align="left" valign="top" width=35%><table width="100%"  border="1" cellpadding="0" cellspacing="0" class="style1" rule="all">
    <!-- <tr>
       <td width="25%">
           <p align="left">RM TYPE</p>
         </font></td>
       <td colspan="3" align="left"><?php //echo $mymd[11] ?>&nbsp;</td>
     </tr>
     <tr>
       <td>RM SPEC </td>
       <td colspan="3" align="left"><?php //echo $mymd[12] ?></td>
     </tr>-->
     <tr>
       <td>
           <p align="left">RM by </p>
         </font></td>
       <td colspan="5" align="left"><?php if($mymd[5]!=''){$a="checked";}if($mymd[8]!=''){$b="checked";} ?>&nbsp;
         <label>
         <input type="checkbox" name="checkbox" id="checkbox" value="checkbox" <?php echo $a?> onclick="toggleValue('rmcim',this)"/>
         <input type="hidden" name="rmcim" id="rmcim" value="<?php echo $a ?>"/>
         Host         </label>
         <input type="checkbox" name="checkbox2" id="checkbox2" value="checkbox" <?php echo $b?>  onclick="toggleValue('rmcust',this)"/>
         <input type="hidden" name="rmcust" id="rmcust" value="<?php echo $b?>"/>
         Customer</td>
       </tr>

     <tr>
       <td rowspan="2">
           <p align="left">Req RM Unit Size</p>
         </font></td>
       <td width="20%" align="left" >
           <p align="left">Dim 1</p>
         </font></td>
       <td width="20%" >
           <p align="left">Dim 2</p>
         </font></td>
       <td width="20%" >
           <p align="left">Dim 3</p>
         </font></td>
         <td width="20%" >
           <p align="left">GF</p>
         </font></td>
         <td width="20%" >
           <p align="left">MRS</p>
         </font></td>

     </tr>

     <tr bgcolor="#FFFFFF">
       <td align="left"><?php echo $mymd[13] ?>&nbsp;</td>
       <td><?php echo $mymd[14] ?>&nbsp;</td>
       <td><?php echo $mymd[15] ?>&nbsp;</td>
       <td><?php echo htmlentities($mymd[20]) ?>&nbsp;</td>
       <td><?php echo htmlentities($mymd[21]) ?>&nbsp;</td>

       <input type="hidden" name="link2masterdata" value="<?php echo $link2masterdata?>" />
     </tr>
     <tr>
       <td rowspan="2">
           <p align="left">GRN DIM</p>
         </font></td>
       <td width="20%" align="left" >
           <p align="left">Dim 1</p>
         </font></td>
       <td width="20%" >
           <p align="left">Dim 2</p>
         </font></td>
       <td width="20%" >
           <p align="left">Dim 3</p>
         </font></td>
          </tr>
     <tr bgcolor="#FFFFFF">
       <td align="left"><?php echo $mygrn[0] ?>&nbsp;</td>
       <td><?php echo $mygrn[1] ?>&nbsp;</td>
       <td><?php echo $mygrn[2] ?>&nbsp;</td>
            <input type="hidden" name="link2masterdata" value="<?php echo $link2masterdata?>" />
     </tr>
   </table></td>
   <td width=2%>&nbsp;</td>
   <td width=20%><table width="100%" border="1" cellpadding="0" cellspacing="0" class="style1" rule="all">
     <tr>
       <td width="56%">
           <p align="left">Dwg#</p>
         </font></td>
       <td width="44%"><?php echo $mymd[18] ?>&nbsp;</td>
     </tr>
     <tr>
       <td>
           <p align="left">DWG Issue</p>
         </font></td>
       <td><?php echo $drgiss ?>&nbsp;</td>
     </tr>
     <tr>
       <td>
           <p align="left">MPS#</p>
         </font></td>
       <td><?php echo $mymd[17] ?>&nbsp;</td>
     </tr>
     <tr>
       <td>
           <p align="left">MPS Rev</p>
         </font></td>
       <td><?php echo $mps_rev ?>&nbsp;</td>
     </tr>
     <tr>
       <td>
           <p align="left">COS</p>
         </font></td>
       <td><?php echo $mymd[19] ?>&nbsp;</td>
     </tr>

   </table></td>
</table>
</td>
 <?php
 $match_flag = "";
    if((trim(strtoupper($mygrn[0])) != trim(strtoupper($mymd[13])))){

                             //echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$myrow[1]</td>";
							 $match_flag = ";Difference in Dimensions";
                         }


                        else if((trim(strtoupper($mygrn[1])) != trim(strtoupper($mymd[14])))){


							 $match_flag = "Difference in Dimensions";
                         }

                      else  if((trim(strtoupper($mygrn[2])) != trim(strtoupper($mymd[15])))){

						     $match_flag = "Difference in Dimensions";
                         }

    $type_remarks = $myrow[42];
  	echo "</table><table width=100% border=0 cellspacing=0 cellpadding=0 rules=\"none\">";
    echo "<tr bordercolor=#FFFFFF height=10><td></td></tr><tr bordercolor=#FFFFFF><td align=\"center\" colspan=13><span class=\"tabletext\"><b>Note: $type_remarks  $match_flag</b></td></tr></table>";
 ?>
 </table>
<br>
 <table width=100% border=1  cellspacing=0 rows=all cols=all>
         <tr>
             <td width=1%><p align="center"><span class="tabletext"><i>Stages</i></p></td>
           <?php
              $iter=0;
              $i=1;
             while($i<=24)
             {
              if($i%2 != 0)
              {
               ?>
               <td width=1%><span class="labeltext"><p align="center"><?php echo $i ?></p></font></td>
               <?php
              }
/*
              else
              {
              ?>
              <td width=1%><span class="labeltext"><p align="center"><?php echo "" ?></p></font></td>
             <?php
              }
*/
             $i++;
            }
            $result4time_master = $mc_master->gettime_master4woprint($mymd[9],$mps_rev,$myrow[19]);

           while($myrow4time_master = mysql_fetch_assoc($result4time_master))
           {
                     //echo $myrow1['stage_num'];
                     $running_time1[$myrow4time_master['stage_num']] = $myrow4time_master['running_time'];
                     $setting_time1[$myrow4time_master['stage_num']] = $myrow4time_master['setting_time'];
                     $running_time_mins1[$myrow4time_master['stage_num']] = $myrow4time_master['running_time_mins'];
                     $setting_time_mins1[$myrow4time_master['stage_num']] = $myrow4time_master['setting_time_mins'];
                     //echo $myrow1['cost'] . ',';

           }
           //mysql_free_result($result1);

  ?>       </tr>
         <tr>
         <td><span class="labeltext1"><p align="center"><i>Set Time</i></p></font></td>
  <?php
           $x=1;
           while($x<=24)
           {
              if($x%2 != 0)
              {
                 echo '<td align="center" width=1%><span class="tabletext">';
                 if (isset($setting_time1[$x]))
                 {
                    printf("%d", $setting_time1[$x]);
                 }
                 else
                 {
                    printf("%d","0");

                 }

                 if (isset($setting_time_mins1[$x]))
                 {
                    printf("%s%02d",":", $setting_time_mins1[$x]);
                 }
                 else
                 {
                    printf("%s%02d",":","0");

                 }
                 echo "</td>";

             }
/*
             else
             {
                echo '<td bgcolor="#DFDEDF" align="center" width=1%><span class="tabletext"></td>';
             }
*/
             $x++;
            }
           unset($setting_time1);
           unset($setting_time_mins1);

           if ($iter == 0)
           {
             echo '</tr><tr bgcolor="#FFFFFF">';
           }
           else
           {
               echo '</tr><tr bgcolor="#FFFFFF">';
           }
         ?>

            <td><span class="labeltext1"><p align="center"><i>Run Time</i></p></font></td>
         <?php
           $x=1;
           while($x<=24)
           {
              if($x%2 != 0)
              {
                 echo '<td align="center" width=1% bgcolor="#FFFFFF"><span class="tabletext">';
                 if (isset($running_time1[$x]))
                 {
                     printf("%d", $running_time1[$x]);
                     //echo "$running_time1[$x]". " h ";
                 }
                 else
                 {
                     printf("%d","0");
                 }

                 if (isset($running_time_mins1[$x]))
                 {
                     printf("%s%02d",":", $running_time_mins1[$x]);
                     //echo "$running_time_mins1[$x]" . " m ";
                 }
                 else
                 {
                     printf("%s%02d",":","0");
                     //echo "0 m";
                 }
                 echo "</td>";
              }
/*
             else
             {
                echo '<td bgcolor="#DFDEDF" align="center" width=1%><span class="tabletext"></td>';
             }
*/              
                $x++;
            }
           unset($running_time1);
           unset($running_time_mins1);

   ?>
