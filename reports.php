<?php
//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2010                 =
// Filename: reports.php                       =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Reports                                     =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
// Includes
include_once('classes/loginClass.php');
include('classes/displayClass.php');

$userid = $_SESSION['user'];
// $dept = $_SESSION['department'];
$_SESSION['pagename'] = 'reports';
$page = "Reports";
////session_register('pagename');
$newlogin = new userlogin;
$newlogin->dbconnect();
$newdisplay = new display;
$userrole = $_SESSION['userrole'];
$usertype = $_SESSION['usertype'];
$dept = $_SESSION['department'];




?>
<script language="javascript" src="scripts/mouseover.js"></script>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title>List of Reports</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>

<table border=2 bgcolor="#DFDEDF" align="center" width="100%"  cellspacing=1 cellpadding=3>
  <tr bgcolor="#ECE5B6">
<td align="left" bgcolor="#00DDFF" colspan="3"><span class="heading"><center><b>List of Reports</b></center></td>
</tr>
 <tr bgcolor="#FFFFFF">
 <td colspan="3">
<table width="100%" border=0 style="border:1px solid #000000;"  bgcolor="#DFDEDF" width="400px"  cellspacing=1 cellpadding=3 class="stdtable1">
 
  
  <tr bgcolor="#ECE5B6">
<td align="left" colspan="3"><span class="heading"><center><b>Status reports</b></center></td>
</tr>
  <tr>

  <?if(($userrole == 'RU' || $userrole == 'SU')  && $usertype == 'EMPL')
  {

    ?>
 	<td bgcolor="#FFFFFF"><span class="heading"><b>1</b></td>
        <td bgcolor="#FFFFFF"><span class="heading"><b><a href="dashboard.php">HEARTBEAT</a></b></td>
 	<td bgcolor="#FFFFFF"><span class="heading">Company Pulse at a glance </td> </tr>


<tr>
    <td bgcolor="#FFFFFF"><span class="heading"><b>2</b></td>
        <td bgcolor="#FFFFFF"><span class="heading"><b><a href="crn_status.php">WO Status(Only FI Stage)</a></b></td>
    <td bgcolor="#FFFFFF"><span class="heading">WO Status at a Glance including Accepted &
                Rejected Quantities for matched Partnums between WO and Cust PO</td>
                </tr> 
                 <tr>
    <td bgcolor="#FFFFFF"><span class="heading"><b>3</b></td>
        <td bgcolor="#FFFFFF"><span class="heading"><b><a href="prodshift_record.php">Production Record</a></b></td>
    <td bgcolor="#FFFFFF"><span class="heading">Shows Shiftwise Production Record for each Machine.  </td>
    </tr>

    <tr>
    <td bgcolor="#FFFFFF"><span class="heading"><b>4</b></td>
        <td bgcolor="#FFFFFF"><span class="heading"><b><a href="dispatch_pending.php">Pending Dispatch</a></b></td>
    <td bgcolor="#FFFFFF"><span class="heading">Shows Pending dispatch Report</td>
                </tr> 





 </td></tr>

	  <tr bgcolor="#ECE5B6">
<td align="left" colspan="3"><span class="heading"><center><b>Stock Reports</b></center></td>
</tr>
    <tr>
 	<td bgcolor="#FFFFFF"><span class="heading"><b>5</b></td>
        <td bgcolor="#FFFFFF"><span class="heading"><b><a href="crnreport_new.php">PRN Stock Report</a></b></td>
 	<td bgcolor="#FFFFFF"><span class="heading">Shows PRN-wise Stock Details  </td>
    </tr>
     <tr>
    <td bgcolor="#FFFFFF"><span class="heading"><b>6</b></td>
        <td bgcolor="#FFFFFF"><span class="heading"><b><a href="stockgrn_status.php">Stock Status by GRN</a></b></td>
    <td bgcolor="#FFFFFF"><span class="heading">GRN Stock Status - provides stock status based on
                GRN or RM Spec or RM Type (uses all stage Returns)  </td>
    </tr>


    <tr>
    <td bgcolor="#FFFFFF"><span class="heading"><b>7</b></td>
        <td bgcolor="#FFFFFF"><span class="heading"><b><a href="stockgrn_bo.php">GRN B/O & Cons</a></b></td>
    <td bgcolor="#FFFFFF"><span class="heading">GRN Stock of Bought out and Consummables  </td>
    </tr>


    <tr>
    <td bgcolor="#FFFFFF"><span class="heading"><b>8</b></td>
        <td bgcolor="#FFFFFF"><span class="heading"><b><a href="rmstockbycrn.php">RM Stock Report</a></b></td>
    <td bgcolor="#FFFFFF"><span class="heading">RM Stock  with Cost </td>
    </tr>

	   
	<tr>
 	<td bgcolor="#FFFFFF"><span class="heading"><b>9</b></td>
        <td bgcolor="#FFFFFF"><span class="heading"><b><a href="prnoutlook.php">PRN Outlook</a></b></td>
 	<td bgcolor="#FFFFFF"><span class="heading">PRN - Schedule vs Actual </td>
    </tr>

    <tr>
    <td bgcolor="#FFFFFF"><span class="heading"><b>10</b></td>
        <td bgcolor="#FFFFFF"><span class="heading"><b><a href="grnclbal.php">GRN Clbal</a></b></td>
    <td bgcolor="#FFFFFF"><span class="heading">GRN closing Balance Details</td>
    </tr>
	  <tr bgcolor="#ECE5B6">
<td align="left" colspan="3"><span class="heading"><center><b>Performance reports</b></center></td>
</tr>

	 <tr>
    <td bgcolor="#FFFFFF"><span class="heading"><b>11</b></td>
        <td bgcolor="#FFFFFF"><span class="heading"><b><a href="prodn_performance.php">Machine Utilization Performance</a></b></td>
    <td bgcolor="#FFFFFF"><span class="heading">Shows Performance for each Machine  </td>
    </tr>
<tr>
    <td bgcolor="#FFFFFF"><span class="heading"><b>12</b></td>
        <td bgcolor="#FFFFFF"><span class="heading"><b><a href="product_performance.php">Product Performance-Table</a></b></td>
    <td bgcolor="#FFFFFF"><span class="heading">Compares Actual Running & Setting Times to Master data
             for each WO(only Fi stage in Part Status under the WO).</td>
    </tr>

<tr>
    <td bgcolor="#FFFFFF"><span class="heading"><b>13</b></td>
        <td bgcolor="#FFFFFF"><span class="heading"><b><a href="pendingdisp4weeks.php">Four weeks pending Dispatch</a></b></td>
    <td bgcolor="#FFFFFF"><span class="heading">Shows Four weeks Pending dispatch Report</td>
                </tr> 


   



  
<?}else if(($userrole == 'RU' || $userrole == 'SU')  && $usertype == 'CUST')
{
?>

<tr>
    <td bgcolor="#FFFFFF"><span class="heading"><b>1</b></td>
        <td bgcolor="#FFFFFF"><span class="heading"><b><a href="crn_status.php">WO Status(Only FI Stage)</a></b></td>
    <td bgcolor="#FFFFFF"><span class="heading">WO Status at a Glance including Accepted &
                Rejected Quantities for matched Partnums between WO and Cust PO</td>
                </tr> 

<tr>
    <td bgcolor="#FFFFFF"><span class="heading"><b>1</b></td>
        <td bgcolor="#FFFFFF"><span class="heading"><b><a href="dispatch_pending.php">Pending Dispatch</a></b></td>
    <td bgcolor="#FFFFFF"><span class="heading">Shows Pending dispatch Report</td>
                </tr> 





<?
}
?>


</table>
</form>
</body>
</html>