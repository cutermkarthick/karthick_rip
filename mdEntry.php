<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 id="tablemd" class="stdtable1"> 

<input type="hidden" name="caserecnum" value="<?php echo $caserecnum ?>">

<tr>
      <td colspan=11><span class="heading"><center><b>Master data Details</b></center></td>
</tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">PRN</p></font></td>
            <td><span class="tabletext"><input type="text"  style="background-color:#DDDDDD;" id="CIM_refnum" name="CIM_refnum" size=20 value="" readonly='readonly'>
                                        <img src='images/bu-get.gif' name='cim' onclick='GetCIM("<?php echo 'CIM_refnum' ?>")'></td>
            <td><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td><input type="text" name="partname"  style="background-color:#DDDDDD;" size=20 value="" readonly='readonly'>
                          <input type="hidden" name="link2masterdata" value="">
                           <input type="hidden" name="link2mps" value="">
                           <div id="crn_prev_stat"></div>
            </td>
        </tr>
		<tr bgcolor="#FFFFFF">
		     <td><span class="labeltext"><p align="left">Process</p></font></td>
			 <td colspan=18><input type="text" name="treatment"  id="treatment" style="background-color:#DDDDDD;" size=20 value="" readonly='readonly'>
         <input type='hidden' name='treatmentsel' id='treatmentsel' value=''>
             </td>

         </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part No.</p></font></td>
            <td><input type="text" name="partnum" id="partnum" style="background-color:#DDDDDD;" size=20 value="" readonly='readonly'></td>
            <td><span class="labeltext"><p align="left">RM by Host</p></font></td>
            <td><input type="text" name="RM_by_CIM"  style="background-color:#DDDDDD;" size=20 value="" readonly='readonly'></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Project</p></font></td>
            <td><input type="text" name="project"  style="background-color:#DDDDDD;" size=20 value="" readonly='readonly'></td>
            <td><span class="labeltext"><p align="left">Part Iss/Attachments</p></font></td>
            <td><input type="text" name="attachments" id="attachments" style="background-color:#DDDDDD;" size=20 value="" readonly='readonly'></td>
        </tr>

       <!-- <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td><input type="text" name="rm_type"  style="background-color:#DDDDDD;" size=20 value="" readonly='readonly'></td>
            <td><span class="labeltext"><p align="left">RM Specification</p></font></td>
            <td><input type="text" name="rm_spec"  style="background-color:#DDDDDD;" size=20 value="" readonly='readonly'></td>
        </tr> -->
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">MPS#</p></font></td>
            <td><input type="text" name="mps_num"  id="mps_num" style="background-color:#DDDDDD;" size=20 value="" readonly='readonly'></td>
            <td><span class="labeltext"><p align="left">MPS Rev</p></font></td>
            <td><input type="text" name="mps_rev" id="mps_rev" style="background-color:#DDDDDD;" size=20 value="" readonly='readonly'></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
              <td><span class="labeltext"><p align="left">Drawing#</p></font></td>
            <td><input type="text" name="drawing_num"  style="background-color:#DDDDDD;" size=20 value="" readonly='readonly'></td>
            <td><span class="labeltext"><p align="left">DRG Issue</p></font></td>
            <td><input type="text" name="drg_issue" id="drg_issue" style="background-color:#DDDDDD;" size=20 value="" readonly='readonly'></td>
        </tr>
        
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">RM by Customer</p></font></td>
            <td><input type="text" name="RM_by_customer"  style="background-color:#DDDDDD;" size=20 value="" readonly='readonly'></td>
           <td><span class="labeltext"><p align="left">COS</p></font></td>
           <td><input type="text" name="cos" id="cos" style="background-color:#DDDDDD;" size=20 value="" readonly='readonly'></td>
        </tr>


        <tr bgcolor="#FFFFFF">
            <td rowspan=2><span class="labeltext"><p align="left">Required Unit Size of RM</p></font></td>
            <td ><span class="labeltext"><p align="left">Dim 1</p></font></td>
            <td ><span class="labeltext"><p align="left">Dim 2</p></font></td>
            <td><span class="labeltext"><p align="left">Dim 3</p></font></td>

         </tr>
         <tr bgcolor="#FFFFFF">
            <td><input type="text" name="rm_dim1"  style="background-color:#DDDDDD;" size=20 value="" readonly='readonly'></td>
            <td><input type="text" name="rm_dim2"  style="background-color:#DDDDDD;" size=20 value="" readonly='readonly'></td>
            <td><input type="text" name="rm_dim3"  style="background-color:#DDDDDD;" size=20 value="" readonly='readonly'></td>
        </tr>

    <input type="hidden" name="mdproc" id="mdproc" value="mdentry">

