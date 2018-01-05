<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Dec 18, 2017                 =
// Filename: suppmasterEntry.php               =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of new quotes                  =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
  header ( "Location: login.php" );
}

$userid = $_SESSION['user'];
$dept = $_SESSION['department'];
$_SESSION['pagename'] = 'suppmasteredit';
$page = "Purchasing: RM Master";

include('classes/displayClass.php');
include('classes/suppmasterClass.php');
$newdisplay = new display;
$newsuppmaster = new suppmaster;

$recnum = $_REQUEST['recnum'];

$result = $newsuppmaster->GetSuppMasterDetails($recnum);
$myrow = mysql_fetch_assoc($result);
$approved_date = $myrow['approved_date'];
$today =  date('Y-m-d');

?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/suppmaster.js"></script>

<html>
  <head>
    <title>Edit Supplier </title>
  </head>

  <body leftmargin="0" topmargin="0" marginwidth="0">
  <?php
    include('header.html');
  ?>

  <td bgcolor="#FFFFFF">
    <form action='processSuppMaster.php' method='post' enctype='multipart/form-data'>
		<table width=100% border=0 cellpadding=6 cellspacing=0  >
      <tr>
        <td><span class="pageheading"><b>Edit Supplier </b></td>
      </tr>

      
      <tr>
        <td>
          <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
            <tr bgcolor="#DDDEDD">
              <td colspan=4><span class="heading"><center><b>New Supplier </b></center></td>
            </tr>

            <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
              <tr bgcolor="#FFFFFF" >
                <td width="15%" ><span class="labeltext"><p align="left">Supplier</p></span></td>
                <td><input type="text" name="supp_name" id="supp_name" size=50 value="<?php echo $myrow['supplier']?>"  style="background-color:#DDDDDD;" readonly="readonly">
                <img src="images/bu-getvendor.gif" alt="Get Vendor" onclick="GetAllVendors()">
                <input type="hidden" name="vendrecnum" id="vendrecnum" value="<?php echo $myrow['link2supplier']?>"></td>
              </tr>

              

              <tr bgcolor="#FFFFFF">
                <td width="15%"><span class="labeltext"><p align="left">Contact Name</p></span></td>
                <td><input type="text" name="ctname" size=50 value="<?php echo $myrow['contact_person']?>" id="ctname" ></td>
              </tr>

              <tr bgcolor="#FFFFFF">
                <td width="15%"><span class="labeltext"><p align="left">Contact Email</p></span></td>
                <td><input type="text" name="ctemail" id="ctemail" size=50 value="<?php echo $myrow['contact_email']?>"  ></td>
              </tr>

              <tr bgcolor="#FFFFFF">
                <td width="15%"><span class="labeltext"><p align="left">Scope of Approval</p></span></td>
                <td><input type="text" name="scope" id="scope" size=50 value="<?php echo $myrow['scope_approval']?>"  ></td>
              </tr>

              <tr bgcolor="#FFFFFF">
                <td width="15%"><span class="labeltext"><p align="left">Method Type</p></span></td>
                <td><input type="text" name="methodtype" size=50 value="<?php echo $myrow['method_type']?>" id="methodtype" ></td>
              </tr>

              <tr bgcolor="#FFFFFF">
                <td width="15%"><span class="labeltext"><p align="left">Extent Control</p></span></td>
                <td><input type="text" name="extent_control" size=50 value="<?php echo $myrow['extent_control']?>" id="extent_control" ></td>
              </tr>
              
              <tr bgcolor="#FFFFFF">
                <td width="15%"><span class="labeltext"><p align="left">Year of Inspection</p></span></td>
                <td><input type="text" name="inspyear" size=50 value="<?php echo $myrow['inspection_year']?>" id="inspyear" ></td>
              </tr>

              <tr bgcolor="#FFFFFF">
                <td width="15%"><span class="labeltext"><p align="left">Risk Involved</p></span></td>
                <td><input type="text" name="risk_involve" size=50 value="<?php echo $myrow['risk_involve']?>" id="risk_involve" ></td>
              </tr>

              

            </table>
          </table>    

          <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
          
            <tr bgcolor="#FFFFFF">
              <td width="25%"><span class="labeltext"><p align="left">Status</p></span></td>
              <td width="25%">
                <select name="status" id="status" size="1" width="50">
                  <option value="All" <?php if($myrow['status'] == "All" || $status == ""){ echo "selected='selected'";}?>>All</option>
                  <option value="Active" <?php if($myrow['status'] == "Active"){ echo "selected='selected'";}?> >Active</option>
                  <option value="Inactive" <?php if($myrow['status'] == "Inactive"){ echo "selected='selected'";}?> > Inactive</option>
                  <option value="Pending" <?php if($myrow['status'] == "Pending"){ echo "selected='selected'";}?> >Pending</option>
                </select>
              </td>
              <td width="25%"></td>
              <td width="25%"></td>
            </tr> 

            <tr bgcolor="#FFFFFF">
              <td width="25%"><span class="labeltext"><p align="left">Approved</p></span></td>
              <td width="25%">
                <input type="checkbox" name="chckb" id="chckb" size=50 value="<?php echo $myrow['approved']?>" <?php if($myrow['approved'] == "Yes"){echo "checked='checked'";}?> onclick="javascript: selectcheckbox('<?php echo $today ?>', '<?php echo $userid ?>')">
                <input type="hidden" name="approved" id="approved" value="<?php echo $myrow['approved']?>">
                <input type="hidden" name="approved_by" id="approved_by" value="<?php echo $myrow['approved_by']?>">
              </td>
              <td width="25%"><span class="labeltext"><p align="left">Approved Date</p></span></td>
              <td><input type="text" name="approved_date" size=50 value="<?php echo $myrow['approved_date']?>" id="approved_date" style="background-color:#DDDDDD;" readonly="readonly" ></td>
            </tr>
          
            </table>

        </td>
      </tr>
 	  </table>
    <span class="labeltext">
      <input type="submit"  style="color=#0066CC;background-color:#DDDDDD;width=130;"  value="Submit" name="submit" onclick="javascript: return check_req_fields()">
      <input type="RESET" style="color=#0066CC;background-color:#DDDDDD;width=130;" value="Reset" onclick="javascript: putfocus()">
    </span>

    <input type="hidden" name="recnum" id="recnum" value="<?php echo $recnum; ?>">
    <input type="hidden" name="pagename" id="pagename" value="suppmasteredit">

    </form>
  </table>

</body>
</html>
