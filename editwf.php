<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: boardwoEntry.php                  =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Allows editing of company details           =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
if ( !isset ( $_REQUEST['wftype'] ) )
{
     header ( "Location: login.php" );
    
}
$wftype = $_REQUEST['wftype'];
if ( !isset ( $_REQUEST['wfrecnum'] ) )
{
     header ( "Location: login.php" );
    
}
$wfrecnum = $_REQUEST['wfrecnum'];
$_SESSION['pagename'] = 'editwf'; 
$page ="Work Flow";
//////session_register('pagename');

// First include the class definition 
include('classes/workflowClass.php'); 
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$newWF = new workflow;
$newdisplay = new display;
$result = $newWF->getWFtyperec($wftype,$wfrecnum);
$myrow = mysql_fetch_row($result);
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/workflow.js"></script>
<html>
<head>
<title>Edit Workflow Stage</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
    <form action='processWF.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
	<td>
	<table width=100% border=0 cellspacing="0" cellpadding="0">
   	<tr> 
        <td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        <td align="right">&nbsp;
       	<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        </tr>
	</table>
	<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr><td></td></tr>
	<tr>
	<td>
<?php $newdisplay->dispLinks(''); ?>
	<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr bgcolor="DEDFDE">
	<td width="6"><img src="images/spacer.gif " width="6"></td>
	<td bgcolor="#FFFFFF">
	<table width=100% border=0 cellpadding=6 cellspacing=0  >
	<tr><td> -->
	 <table width=100% border=0>
	<tr>
        <td width="50%"><span class="pageheading"><b>Edit WorkFlow Stage</b></td>
	</td>
	</tr>
	</table>
	</td></tr>
	<tr>
	<td>
  	<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
    <input type="hidden" name ="pagename" id="pagename" value ="editwf">
        <tr bgcolor="#FFFFFF">
            <td bgcolor="#FFFFFF"><span class="labeltext"><p align="left">Stage</p></font></td>
            <td bgcolor="#FFFFFF"><span class="tabletext"><input type="text" name="stage"
                    style="background-color:#DDDDDD;width=180;" 
                    readonly="readonly" value="<?php echo $myrow[1] ?>"></td>
                    
             <td bgcolor="#FFFFFF"><span class="labeltext"><p align="left">Type</p></font></td>
            <td bgcolor="#FFFFFF"><span class="tabletext"><input type="text" name="type"
                    style="background-color:#DDDDDD;width=180;"
                    readonly="readonly" value="<?php echo $myrow[0] ?>"></td>
        </tr>

        <tr>
            <td bgcolor="#FFFFFF"><span class="labeltext"><p align="left">Doc Type</p></font></td>
            <td bgcolor="#FFFFFF"><span class="tabletext"><input type="text" name="doctype"
                    style="background-color:#DDDDDD;width=180;" 
                    readonly="readonly" value="<?php echo $myrow[7] ?>"></td>
                    
            <td bgcolor="#FFFFFF"><span class="labeltext"><p align="left">Dept</p></font></td>
            <td bgcolor="#FFFFFF"><input type="text" name="dept" style="width=180;" value="<?php echo $myrow[2] ?>"</td>
        </tr>

        <tr>
            <td bgcolor="#FFFFFF"><span class="labeltext"><p align="left">Status</p></font></td>
            <td bgcolor="#FFFFFF"><input type="text" name="status" style="width=180;" value="<?php echo $myrow[3] ?>"</td>
            
            <td bgcolor="#FFFFFF"><span class="labeltext"><p align="left">Approval Type</p></font></td>
            <td bgcolor="#FFFFFF"><input type="text" name="apprtype" style="width=180;" value="<?php echo $myrow[5] ?>"</td>
        </tr>

        <tr>
            <td bgcolor="#FFFFFF"><span class="labeltext"><p align="left">Approval By</p></font></td>
            <td bgcolor="#FFFFFF"><input type="text" name="apprby" style="width=180;" value="<?php echo $myrow[6] ?>"</td>
            
            <td bgcolor="#FFFFFF"><span class="labeltext"><p align="left">Email List</p></font></td>
            <td bgcolor="#FFFFFF"><input type="text" name="emaillist" style="width=180;" value="<?php echo $myrow[8] ?>"</td>
        </tr>

        <tr bgcolor="#FFFFFF">
           <td bgcolor="#FFFFFF"><span class="labeltext"><p align="left">Allow Customer Display (Y/N)</p></font></td>
           <td><input type="text" name="allowcustdisp" style="width=180;" value="<?php echo $myrow[9] ?>"></td>
           
           <td bgcolor="#FFFFFF"><span class="labeltext"><p align="left">Allow Printing (Y/N)</p></font></td>
           <td><input type="text" name="allowprintdisp" style="width=180;" value="<?php echo $myrow[10] ?>"></td>
        </tr>	

        <tr bgcolor="#FFFFFF">
           <td bgcolor="#FFFFFF"><span class="labeltext"><p align="left">Allow Reporting (Y/N)</p></font></td>
           <td><input type="text" name="allowreportdisp" style="width=180;" value="<?php echo $myrow[11] ?>"></td>
           
           <td bgcolor="#FFFFFF"><span class="labeltext"><p align="left">Customer Status Display</p></font></td>
           <td ><input type="text" name="custstatusdisp" style="width=180;" value="<?php echo $myrow[12] ?>"></td>
        </tr>	

        <tr bgcolor="#FFFFFF">
           <td bgcolor="#FFFFFF"><span class="labeltext"><p align="left">Estimated Time</p></font></td>
           <td ><input type="text" name="est_time" style="width=180;" value="<?php echo $myrow[13] ?>" maxlength="3"  onKeyup="javascript:validate(est_time)"></td>
           
           <td ><span class="labeltext"><p align="left">Estimated Cost</p></font></td>
<td ><input type="text" name="est_cost" maxlength="3"  style="width=180;" value="<?php echo $myrow[15] ?>"  onKeyup="javascript:validate(est_cost)"></td>
        </tr>	

<tr bgcolor="#FFFFFF">
 <td ><span class="labeltext"><p align="left">Active</p></font></td>
<td ><span class="heading"><select name="act_status" size="1" width="180">
<option selected><?php echo $myrow[14] ?>
<option value>Active
<option value>Inactive
<option value>Obsolete
</select>
<input type="hidden" name="activeval">
</td>

<td ><span class="labeltext"><p align="left">Dependency</p></font></td>
<td ><input type="text" name="dependency" maxlength="15"  style="width=180;" value="<?php echo $myrow[16] ?>" onKeyup=" "></td>
</tr>

<tr bgcolor="#FFFFFF">
  <td ><span class="labeltext"><p align="left">Secondary Resposibility</p></span></td>
  <td  ><input type="text" name="sec_respose"  value="<?php echo $myrow[17] ?>"></td>

   <td><span class="labeltext"><p align="left">Primary Resposibility</p></span></td>
  <td><input type="text" name="primary_respose"  value="<?php echo $myrow[21] ?>"></td>

  
</tr>

<tr bgcolor="#FFFFFF">
  <td ><span class="labeltext"><p align="left">When Process</p></span></td>
  <td ><input type="text" name="when_process" value="<?php echo $myrow[19] ?>"></td>
  
  <td ><span class="labeltext"><p align="left">Process</p></span></td>
  <td><input type="text" name="process"  value="<?php echo $myrow[18] ?>"></td>
</tr>

 
 									 				
        												</table>
											</td>
										</tr>
																			</table>
								</td>
								<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
							</tr>
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/box-left-bottom.gif"></td>
								<td><img src="images/spacer.gif " height="6"></td>
								<td width="6"><img src="images/box-right-bottom.gif"></td>
							</tr>
						</table> -->
						<table border = 0 cellpadding=0 cellspacing=0 width=100% >
							<tr>
								<td align=left>   
								</td>
							</tr>
						</table>
        <span class="labeltext"><input type="submit" 
                     style="color=#0066CC;background-color:#DDDDDD;width=100;"
                     value="Submit" name="submit" onclick="javascript: return upd_check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=100;"
                     VALUE="Reset" onclick="javascript: putfocus()">
            

					</FORM>
		</body>
</html>


