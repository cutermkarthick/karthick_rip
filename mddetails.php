<td colspan=11><span class="heading"><center><b>Master data Details</b></center></td>
</tr>


<?php

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

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 id="tablemd" class="stdtable1">

        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">PRN Ref No.</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $mymd[9] ?></td>
            <td width=25%><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $mymd[1] ?>

        </tr>
        <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left">Treatment</p></font></td>
            <td colspan="3"><span class="tabletext"><?php echo $myrow[40] ?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part No.</p></font></td>
            <td><span class="tabletext"><?php echo $mymd[4] ?></td>
            <td><span class="labeltext"><p align="left">RM by Host</p></font></td>
            <td><span class="tabletext"><?php echo $mymd[5] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Project</p></font></td>
            <td><span class="tabletext"><?php echo $mymd[6] ?></td>
            <td><span class="labeltext"><p align="left">Part Iss/Attachments</p></font></td>
            <td><span class="tabletext"><?php echo $mymd[7] ?></td>
        </tr>


        <!--<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td><span class="tabletext"><?php echo $mymd[11] ?></td>
            <td><span class="labeltext"><p align="left">RM Specification</p></font></td>
            <td><span class="tabletext"><?php echo $mymd[12] ?></td>
        </tr>-->
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">MPS#</p></font></td>
            <td><span class="tabletext"><?php echo $mymd[17] ?></td>
            <td><span class="labeltext"><p align="left">MPS Rev</p></font></td>
            <td><span class="tabletext"><?php echo $mps_rev ?></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Drawing#</p></font></td>
            <td><span class="tabletext"><?php echo $mymd[18] ?></td>
            <td><span class="labeltext"><p align="left">DRG Issue</p></font></td>
            <td><span class="tabletext"><?php echo $mymd[10] ?></td>
        </tr>
        
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">RM by Customer</p></font></td>
            <td><span class="tabletext"><?php echo $mymd[8] ?></td>
            <td><span class="labeltext"><p align="left">COS</p></font></td>
            <td><span class="tabletext"><?php echo $mymd[19] ?></td>

        </tr>


        <tr bgcolor="#FFFFFF">
            <td rowspan=2><span class="labeltext"><p align="left">Required Unit Size of RM</p></font></td>
            <td ><span class="labeltext"><p align="left">Dim 1</p></font></td>
            <td ><span class="labeltext"><p align="left">Dim 2</p></font></td>
            <td><span class="labeltext"><p align="left">Dim 3</p></font></td>
         </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="tabletext"><?php echo $mymd[13] ?></td>
            <td><span class="tabletext"><?php echo $mymd[14] ?></td>
            <td><span class="tabletext"><?php echo $mymd[15] ?></td>
             <input type="hidden" name="link2masterdata" value="<?php echo $link2masterdata?>">
        </tr>

