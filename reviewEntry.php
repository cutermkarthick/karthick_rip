<table border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" style="width:194%">

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Order Stage Details</b></center></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order Stored in the form of</td>
            <td><span class="tabletext"><input type="text" name="data_store" size=30 value=""></td>
            <td><span class="labeltext">Filename/Path</font></td>
            <td><span class="tabletext"><input type="text" name="path" size=30 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Order Type</td>
            <td><span class="tabletext"><input type="text" name="ordertype" size=30 value=""></td>
             <td><span class="labeltext"><span class='asterisk'>*</span>Contact Person</font></td>
            <td><span class="tabletext"><input type="text" name="person" size=30 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Order for</td>
            <td><span class="tabletext"><input type="text" name="orderfor" size=30 value=""></td>
            <td><span class="labeltext">Attachments</font></td>
            <td><span class="tabletext"><input type="text" name="attachment1" size=30 value=""></td>
        </tr>


        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">No. of Parts</p></font></td>
            <td><span class="tabletext"><input type="text" name="numofparts" size=30 value=""></td>
            <td><span class="labeltext">Classification of Parts</td>
            <td><span class="tabletext"><input type="text" name="parts_class" size=30 value=""></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Raw material supplied by Customer or to be Procured</font></td>
            <td><span class="tabletext"><input type="text" name="rawmaterial" size=30 value=""></td>
            <td><span class="labeltext">Source of Raw Material planned</td>
            <td><span class="tabletext"><input type="text" name="source" size=30 value=""></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Create Date</p></font></td>
            <td><span class="tabletext"><input type="text" name="create_date" size=20 value="" readonly="readonly" style="background-color:#DDDDDD;">
                                 <img src="images/bu-getdate.gif" alt="Get BookDate" onclick="GetDate('create_date')"></td>
            <td><span class="labeltext">Created By</td>
            <td><span class="tabletext"><input type="text" name="created_by" size=30 value="<?php echo $userid ?>" readonly="readonly"></td>
        </tr>
        
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Engineering Approved</td>
            <td><span class="tabletext"><input type="checkbox" name="engineering_approved" id="engineering_approved" disabled onclick="JavaScript:toggleValue('eng_app',this);" />
            <input type="hidden" name="eng_app" value="no" id="eng_app"></td></td>
            <td><span class="labeltext">QA Approved</font></td>
            <td><span class="tabletext"><input type="checkbox" name="qa_approved" id="qa_approved" disabled onclick="JavaScript:toggleValue('qa_app',this);" />
            <input type="hidden" name="qa_app" value="no" id="qa_app"></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Purchase Order Requirements</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any resources required apart from the existing for this order?
                   <br>Provide Details</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="resources" size=90 value=""></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Quality</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are quality requirements clear?
                              <br><b>Is it In-line with Organization or Specific</td>
            <td colspan=2><span class="tabletext"><input type="text" name="qualityreq" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Comments on Specific Requirements</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="saliant" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any additional requirements for quality<br>
                in terms of Resources/Equipment/Infrastructure? Explain.</td>
            <td colspan=2><span class="tabletext"><input type="text" name="aditional_resources" size=90 value=""></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Outsourcing Activity</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Any Outsourcing/Subcontracting activity needs to be planned?<br>
                   If yes, provide details</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="subcontract" size=90 value=""></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Special Processes</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Is there any Special Process involved?<br>If yes, provide details</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="special_process" size=90 value=""></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Delivery Requirements</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are delivery requirements of the Order Clear?</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="delivery_req" size=90 value=""></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=5><span class="heading"><center><b>Risk Analysis</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Do you foresee any Risk as to the requirements of this<br>
                        Order? If YES, state the probable Risk factor</td>
            <td colspan=2><span class="tabletext"><input type="text" name="risk_factors" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Explain the Risk Factor</td>
            <td colspan=2><span class="tabletext"><input type="text" name="explain_risk_factors" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Are any statutory or regulatory requirements applicable?<br>
                            If yes, provide details</font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="requirements" size=90 value=""></td>
        </tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Quotation Details</b></center></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Quote Reference No.</font></td>
            <td><span class="tabletext"><input type="text" name="quotation" size=30 value=""></td>
            <td><span class="labeltext">Quote Sent by</td>
            <td><span class="tabletext"><input type="text" name="quote_sentby" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Details of Quotation/Estimation stored in</td>
            <td colspan=2><span class="tabletext"><input type="text" name="quotation_det_store" size=90 value=""></td>
        </tr>

        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Data Storage</b></center></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Data related to Enquiry stored in</td>
            <td colspan=2><span class="tabletext"><input type="text" name="data_for_enquiry" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Mention the Filename/Path</td>
            <td colspan=2><span class="tabletext"><input type="text" name="enquiry_path" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Data related to Quote stored in</td>
            <td colspan=2><span class="tabletext"><input type="text" name="data_for_quote" size=90 value=""></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext">Mention the Filename/Path</td>
            <td colspan=2><span class="tabletext"><input type="text" name="quote_path" size=90 value=""></td>
        </tr>
