<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">
<tr>
      <td colspan=11><span class="heading"><center><b>Master data Details</b></center></td>
</tr>


<?php
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
 $result = $newwo->getlink2masterdata($worecnum);
 $myrec =  mysql_fetch_row($result);
 $link2masterdata = $myrec[0];

 $resultmd = $newMD->getmasterdata4wo($link2masterdata);
 $mymd = mysql_fetch_row($resultmd);
 
 if($myrow[34] == 0)
  {
    $mps_rev = $mymd[16];
  }
 else
  {
    $mps_rev = $myrow[35];
  }

?>

<tr bgcolor="#FFFFFF">



        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext"><p align="left">Host Ref No.</p></font></td>
            <td colspan=2 width=25%><span class="tabletext"><input type="text"  style="background-color:#DDDDDD;" id="CIM_refnum" name="CIM_refnum" size=20 value="<?php echo $mymd[9] ?>" readonly='readonly'>
            <?php
            if($dept !='QA' && $dept != 'PPC4' && $dept != 'PPC5' && $dept != 'Purchasing')
            {
            ?>
                                        <img src='images/bu-get.gif' name='cim' onclick='GetCIM("<?php echo 'CIM_refnum' ?>")'></td></td>
            <?php
            }
            ?>
            <td colspan=2><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td colspan=2><input type="text" name="partname"  style="background-color:#DDDDDD;" size=20 value="<?php echo $mymd[1] ?>" readonly='readonly'>

                          <input type="hidden" name="link2masterdata" value="<?php echo $link2masterdata?>">
                           <input type="hidden" name="link2mps" value="<?php echo $myrow[34]; ?>">
                           <div id="crn_prev_stat"></div>
            </td>
        </tr>
		<tr bgcolor="#FFFFFF">
		     <td colspan=2><span class="labeltext"><p align="left">Treatment</p></font></td>
<?
	// Commented the following line on June 13, 2011 temporarily since PPC wanted update capability on Treatment dropdown 
	// So changed the check to != dummy which will be true for Manufacture and Treatment
	 // if ($myrow[40] != 'With Treatment')
	  if ($myrow[40] != 'dummy' && ($dept == 'PPC' || $dept == 'PPC5' || $dept == 'PPC4' ))
	  {
	?>
			 <td colspan=5><input type="text" name="treatment"  id="treatment" style="background-color:#DDDDDD;" size=20 
			 value="<?php echo $myrow[40]?>" readonly='readonly'>
             <select id="treatmentsel" name="treatmentsel" onchange='GetTreatment();' disabled>
                   <option value="Manufacture Only" >Manufacture Only</option>
                   <option value="With Treatment"  >With Treatment</option>
              </select>
            </td>
	<?php
	  }
	  else
	  {
	?>
			 <td colspan=5><input type="text" name="treatment"  id="treatment" style="background-color:#DDDDDD;" size=20 
			 value="<?php echo $myrow[40]?>" readonly='readonly'>
             <input type='hidden' name='treatmentsel' id='treatmentsel' value=''>
	<?php
	  }
?>
         </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext"><p align="left">Part No.</p></font></td>
            <td colspan=2 width=25%> <input type="text" name="partnum" id="partnum"  style="background-color:#DDDDDD;" size=20 value="<?php echo $mymd[4] ?>" readonly='readonly'></td>
            <td colspan=2><span class="labeltext"><p align="left">RM by Host</p></font></td>
            <td colspan=2><input type="text" name="RM_by_CIM"  style="background-color:#DDDDDD;" size=20 value="<?php echo $mymd[5] ?>" readonly='readonly'></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext"><p align="left">Project</p></font></td>
            <td colspan=2 width=25%><input type="text" name="project"  style="background-color:#DDDDDD;" size=20 value="<?php echo $mymd[6] ?>" readonly='readonly'></td>
            <td colspan=2><span class="labeltext"><p align="left">Part Iss/Attachments</p></font></td>
            <td colspan=2><input type="text" name="attachments" id="attachments" style="background-color:#DDDDDD;" size=20 value="<?php echo $mymd[7] ?>" readonly='readonly'></td>
        </tr>

        <!--<tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td colspan=2 width=25%><input type="hidden" name="rm_type"  style="background-color:#DDDDDD;" size=20 value="<?php echo $mymd[11] ?>" readonly='readonly'></td>
            <td colspan=2><span class="labeltext"><p align="left">RM Specification</p></font></td>
            <td colspan=2><input type="hidden" name="rm_spec"  style="background-color:#DDDDDD;" size=20 value="<?php echo $mymd[12] ?>" readonly='readonly'></td>
        </tr>-->
        
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext"><p align="left">MPS#</p></font></td>
            <td colspan=2><input type="text" name="mps_num" id="mps_num" style="background-color:#DDDDDD;" size=20 value="<?php echo $mymd[17] ?>" readonly='readonly'></td>
            <td colspan=2><span class="labeltext"><p align="left">MPS Rev</p></font></td>
            <td colspan=2 width=25%><input type="text" name="mps_rev" id="mps_rev" style="background-color:#DDDDDD;" size=20 value="<?php echo $mps_rev ?>" readonly='readonly'></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext"><p align="left">Drawing#</p></font></td>
            <td colspan=2><input type="text" name="drawing_num"  style="background-color:#DDDDDD;" size=20 value="<?php echo $mymd[18] ?>" readonly='readonly'></td>
            <td colspan=2><span class="labeltext"><p align="left">DRG Issue</p></font></td>
            <td colspan=2><input type="text" name="drg_issue"  id="drg_issue" style="background-color:#DDDDDD;" size=20 value="<?php echo $mymd[10] ?>" readonly='readonly'></td>
        </tr>
        

        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext"><p align="left">RM by Customer</p></font></td>
            <td colspan=2 width=25%><input type="text" name="RM_by_customer"  style="background-color:#DDDDDD;" size=20 value="<?php echo $mymd[8] ?>" readonly='readonly'></td>
            <td colspan=2><span class="labeltext"><p align="left">COS</p></font></td>
            <td colspan=2 width=25%><input type="text" name="cos"  id="cos" style="background-color:#DDDDDD;" size=20 value="<?php echo $mymd[19] ?>" readonly='readonly'></td>

        </tr>

        <tr bgcolor="#FFFFFF">
            <td colspan=2 rowspan=3><span class="labeltext"><p align="left">Required Unit Size of RM</p></font></td>
            <td colspan=2 width=25%><span class="labeltext"><p align="left">Dim 1</p></font></td>
            <td colspan=4><input type="text" name="rm_dim1"  style="background-color:#DDDDDD;" size=20 value="<?php echo $mymd[13] ?>" readonly='readonly'></td>
         </tr>
         <tr bgcolor="#FFFFFF">
            <td colspan=2 width=25%><span class="labeltext"><p align="left">Dim 2</p></font></td>
            <td colspan=4><input type="text" name="rm_dim2"  style="background-color:#DDDDDD;" size=20 value="<?php echo $mymd[14] ?>" readonly='readonly'></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2 width=25%><span class="labeltext"><p align="left">Dim 3</p></font></td>
            <td colspan=4><input type="text" name="rm_dim3"  style="background-color:#DDDDDD;" size=20 value="<?php echo $mymd[15] ?>" readonly='readonly'></td>
        </tr>


    <input type="hidden" name="mdproc" id="mdproc" value="mdedit">

