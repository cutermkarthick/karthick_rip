<td colspan=11><span class="heading"><center><b>Master data Details</b></center></td>
</tr>

<?php

 $resultmd = $newMD->getmasterdata4wo($link2masterdata);
 $mymd = mysql_fetch_row($resultmd);

?>
<tr bgcolor="#FFFFFF">

<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 id="tablemd" rules=all>

        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">CIM Ref No.</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $mymd[9] ?></td>
            <td width=25%><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $mymd[1] ?>
            <td><span class="labeltext"><p align="left">Part No.</p></font></td>
            <td><span class="tabletext"><?php echo $mymd[4] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            
            <td><span class="labeltext"><p align="left">RM by CIM</p></font></td>
            <td><span class="tabletext"><?php echo $mymd[5] ?></td>
			<td><span class="labeltext"><p align="left">Project</p></font></td>
            <td><span class="tabletext"><?php echo $mymd[6] ?></td>
            <td><span class="labeltext"><p align="left">Attachments</p></font></td>
            <td><span class="tabletext"><?php echo $mymd[7] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td><span class="tabletext"><?php echo $mymd[11] ?></td>
            <td><span class="labeltext"><p align="left">RM Specification</p></font></td>
            <td><span class="tabletext"><?php echo $mymd[12] ?></td>  
            <td><span class="labeltext"><p align="left">MPS Rev</p></font></td>
            <td><span class="tabletext"><?php echo $mymd[16] ?></td>
		</tr>


        <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left">MPS#</p></font></td>
            <td><span class="tabletext"><?php echo $mymd[17] ?></td>
			<td><span class="labeltext"><p align="left">DRG Issue</p></font></td>
            <td><span class="tabletext"><?php echo $mymd[10] ?></td> 
			<td><span class="labeltext"><p align="left">Drawing#</p></font></td>
            <td><span class="tabletext"><?php echo $mymd[18] ?></td>
        </tr>
        
        
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">RM by Customer</p></font></td>
            <td colspan=5><span class="tabletext"><?php echo $mymd[8] ?></td>

        </tr>


        <tr bgcolor="#FFFFFF">
            <td rowspan=2><span class="labeltext"><p align="left">Required Unit Size of RM</p></font></td>
            <td ><span class="labeltext" ><p align="left">Dim 1</p></font></td>
            <td ><span class="labeltext"><p align="left">Dim 2</p></font></td>
            <td colspan=4><span class="labeltext" ><p align="left">Dim 3</p></font></td>
         </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="tabletext"><?php echo $mymd[13] ?></td>
            <td><span class="tabletext"><?php echo $mymd[14] ?></td>
            <td colspan=4><span class="tabletext"><?php echo $mymd[15] ?></td>
             <input type="hidden" name="link2masterdata" value="<?php echo $link2masterdata?>">
        </tr>
		
		