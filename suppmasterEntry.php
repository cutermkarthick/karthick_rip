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
$_SESSION['pagename'] = 'suppmasterentry';
$page = "Purchasing: RM Master";

include('classes/displayClass.php');
$newdisplay = new display;

?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/suppmaster.js"></script>

<html>
  <head>
    <title>New Supplier </title>
  </head>

  <body leftmargin="0" topmargin="0" marginwidth="0">
  <?php
    include('header.html');
  ?>

  <td bgcolor="#FFFFFF">
    <form action='processSuppMaster.php' method='post' enctype='multipart/form-data'>
		<table width=100% border=0 cellpadding=6 cellspacing=0  >
      <tr>
        <td><span class="pageheading"><b>New Supplier </b></td>
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
                <td><input type="text" name="supp_name" id="supp_name" size=50 value=""  style="background-color:#DDDDDD;" readonly="readonly">
                <img src="images/bu-getvendor.gif" alt="Get Vendor" onclick="GetAllVendors()">
                <input type="hidden" name="vendrecnum" id="vendrecnum" value=""></td>
              </tr>

              

              <tr bgcolor="#FFFFFF">
                <td width="15%"><span class="labeltext"><p align="left">Contact Name</p></span></td>
                <td><input type="text" name="ctname" size=50 value="" id="ctname" ></td>
              </tr>

              <tr bgcolor="#FFFFFF">
                <td width="15%"><span class="labeltext"><p align="left">Contact Email</p></span></td>
                <td><input type="text" name="ctemail" id="ctemail" size=50 value=""  ></td>
              </tr>

              <tr bgcolor="#FFFFFF">
                <td width="15%"><span class="labeltext"><p align="left">Scope of Approval</p></span></td>
                <td><input type="text" name="scope" id="scope" size=50 value=""  ></td>
              </tr>

              <tr bgcolor="#FFFFFF">
                <td width="15%"><span class="labeltext"><p align="left">Method Type</p></span></td>
                <td><input type="text" name="methodtype" size=50 value="" id="methodtype" ></td>
              </tr>

              <tr bgcolor="#FFFFFF">
                <td width="15%"><span class="labeltext"><p align="left">Extent Control</p></span></td>
                <td><input type="text" name="extent_control" size=50 value="" id="extent_control" ></td>
              </tr>
              
              <tr bgcolor="#FFFFFF">
                <td width="15%"><span class="labeltext"><p align="left">Year of Inspection</p></span></td>
                <td><input type="text" name="inspyear" size=50 value="" id="inspyear" ></td>
              </tr>

              <tr bgcolor="#FFFFFF">
                <td width="15%"><span class="labeltext"><p align="left">Risk Involved</p></span></td>
                <td><input type="text" name="risk_involve" size=50 value="" id="risk_involve" ></td>
              </tr>

            </table>
          </table>    
        </td>
      </tr>
 	  </table>

    <input type="hidden" name="pagename" id="pagename" value="suppmasterentry">

    <span class="labeltext">
      <input type="submit"  style="color=#0066CC;background-color:#DDDDDD;width=130;"  value="Submit" name="submit" onclick="javascript: return check_req_fields()">
      <input type="RESET" style="color=#0066CC;background-color:#DDDDDD;width=130;" value="Reset" onclick="javascript: putfocus()">
    </span>
    </form>
  </table>

</body>
</html>
