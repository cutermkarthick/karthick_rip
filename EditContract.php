<?php


session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
    header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'editcontract';
$page="Contract";

$userid = $_SESSION['user'];
$userrecnum = $_SESSION['userrecnum'];
$recnum = $_REQUEST['recnum'];

include('classes/contractClass.php');
$newContract = new contract;

$result = $newContract->getContractDetails($recnum);
$myrow = mysql_fetch_assoc($result);

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/contract.js"></script>


<html>
<head>
<title>Edit Contract</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
     <form action='ProcessContract.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>

    <table width=100% border=0>
      <tr>
        <td><span class="pageheading"><b>Edit Contract</b></td>
      </tr>
   	</table>

		</td></tr>
		<tr>
    <td>

    <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
      <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
     	<tr bgcolor="#FFFFFF"  >
    		<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
          
    			<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Company Name</p></span></td>
            <td><input type="text" name="companyname" id="companyname" size="35" value="<?php echo $myrow['name']; ?>"></td>
            <td><span class="labeltext"><p align="left">ID</p></span></td>
            <td><input type="text" name="contractid" id="contractid" size="20" style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow['id']; ?>"></td>
        	</tr>

          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Start Date</p></span></td>
            <td><span class="tabletext">
              <input type="text" name="start_date" id="start_date" value="<?php echo $myrow['start_date']; ?>"
               style="background-color:#DDDDDD;" readonly="readonly"></span>
              <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('start_date')">
            </td>
            <td><span class="labeltext"><p align="left">End Date</p></span></td>
            <td><span class="tabletext">
              <input type="text" name="end_date" id="end_date" value="<?php echo $myrow['end_date']; ?>"
               style="background-color:#DDDDDD;" readonly="readonly"></span>
              <img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('end_date')">
            </td>
          </tr>

          

          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Approved</p></span></td>
            <td><input type="checkbox" name="approved_check" id="approved_check" size="20"  <?php if($myrow['approved'] == "yes"){ echo "checked='checked'"; }?> onclick="SelectApproval();"></td>
            <input type="hidden" name="approved" id="approved"  value="<?php echo $myrow['approved']; ?>">
            <input type="hidden" name="approved_by" id="approved_by"  value="<?php echo $myrow['approved_by']; ?>">
            <input type="hidden" name="today" id="today"  value="<?php echo date("Y-m-d"); ?>">
            <input type="hidden" name="userid" id="userid"  value="<?php echo $userid; ?>">
            <td><span class="labeltext"><p align="left">Approved Date</p></span></td>
            <td><input type="text" name="approved_date" id="approved_date" size="20" style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow['approved_date']; ?>"></td>
          </tr>

          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Status</p></span></td>
            <td><input type="text" name="status" id="status" size="20" value="<?php echo $myrow['status']; ?>" style="background-color:#DDDDDD;" readonly="readonly">
            <select name="select_status" id="select_status" onchange="SelectStatus();">
              <option value="Open" <?php if($myrow['status'] == "Open") {echo "selected='selected'";}?> >Open</option>
              <option value="Pending" <?php if($myrow['status'] == "Pending") {echo "selected='selected'";}?> >Pending</option>
              <option value="Cancelled" <?php if($myrow['status'] == "Cancelled") {echo "selected='selected'";}?> >Cancelled</option>
            </select>

            </td>
            <td></td>
            <td></td>
          </tr>

          <input type="hidden" name="recnum" id="recnum" value="<?php echo $recnum; ?>">

        </table>
      </td>
    </tr>
    </table>
    </td>
  </table>
    <br>  
    <table border = 0 cellpadding=0 cellspacing=0 width=100% >
      <tr>
          <td align=left>
          </td>
      </tr>
  	</table>

    	<span class="tabletext">
    	<input type="submit"   value="Submit" name="Import"  onClick="javascript: return check_req_field4EmpConfig()">
    	<input TYPE="reset" style="color=#0066CC;background-color:#DDDDDD;width=130;" VALUE="Reset" onclick="javascript: putfocus()">

    	</form>
  </body>
</html>
