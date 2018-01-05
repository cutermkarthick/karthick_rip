<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Sep 15,2010                  =
// Filename: fair.php                          =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Displays list of wo fair entries            =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];
$_SESSION['pagename'] = 'fairUpdate';
$page = "QA: Fair";
//////session_register('pagename');
$rec = $_REQUEST['recnum'];

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/fairClass.php');
include_once('classes/displayClass.php');

$newfair = new fair;
$newdisplay = new display;

$result = $newfair->getfairDetails($rec);
$myrow = mysql_fetch_row($result);
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/fair.js"></script>

<html>
<head>
<title>Fair</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processFair.php' method='GET' enctype='multipart/form-data'>
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
			<table width=100% border=0 cellpadding=0 cellspacing=0>
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0>
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
	    <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellpadding=6 cellspacing=0>
  <tr>
<td>
	</td></tr>
	<tr><td>
<table width=100% border=0>
  <tr>
  <td><span class="pageheading"><b>Edit FAIR</b></td>
  </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
        <tr  bgcolor="#FFFFFF">
            <td bgcolor="#FFFFFF"><span class="tabletext"><b>PRN</b></td>
            <td><span class="tabletext"><input type="text" id="crn"  name="crn" size=11% style=";background-color:#DDDDDD;"  readonly="readonly" value="<?php echo $myrow[1]?>"></td>
            <td><span class="tabletext"><b>WO</b></td>
            <td><span class="tabletext"><input type="text"  name="wo" value="<?php echo $myrow[2] ?>" size=10% style=";background-color:#DDDDDD;" readonly="readonly"></td>
            <tr bgcolor="#FFFFFF">
            <td bgcolor="#FFFFFF"><span class="tabletext"><b>Cofc</b></td>
            <td><span class="tabletext"><input type="text"  name="cofc" value="<?php echo $myrow[3] ?>" size=10% style="background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="tabletext"><b>WO Date</b></td>
            <?php
              if($myrow[4] != '0000-00-00' && $myrow[4] != '' && $myrow[4] != 'NULL')
              {
                $datearr = split('-', $myrow[4]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $wodate=date("M j, Y",$x);
		      }
		      else
              {
                $wodate="";
		      }
            ?>
            <td><span class="tabletext"><input type="text"  name="wodate" value="<?php echo $wodate?>" size=12% style="background-color:#DDDDDD;" readonly="readonly"></td>
            <tr  bgcolor="#FFFFFF">
            <td><span class="tabletext"><b>Type</b></td>
               <td><span class="tabletext"><input type="text"  name="type" value="<?php echo $myrow[5] ?>" size=12% style="background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="tabletext"><b>NC</b></td>
            <td><span class="tabletext"><input type="text"  name="nc" value="<?php echo $myrow[6] ?>" size=7%></td>
            <tr  bgcolor="#FFFFFF">
            <input type="hidden" id="stat_flag" name="stat_flag"  value="0">
            <td><span class="tabletext"><b>Status</b></td>
             <?php $selected = 'selected';
             $disabled = '';
             if($myrow[7] != '' && $myrow[7] != 'NULL')
             {
               $disabled = 'disabled';
               echo "<input type=\"hidden\" name=\"stat\"  value=\"$myrow[7]\">";
               echo "<input type=\"hidden\" name=\"stat_flag\"  value=\"1\">";
             }
             ?>
            <td><select id="stat" name="stat" <?php echo $disabled ?>>
            <option selected <?php echo $myrow[7] ?>>
            <option value="NC" <?php if($myrow[7] == 'NC') echo $selected?>>NC</option>
            <option value="APPROVED" <?php if($myrow[7] == 'APPROVED') echo $selected?>>APPROVED</option>
            <option value="CUST APPROVED" <?php if($myrow[7] == 'CUST APPROVED') echo $selected?>>CUST APPROVED</option>
            <option value="REFAIR" <?php if($myrow[7] == 'REFAIR') echo $selected?>>REFAIR</option>
            <option value="DELTA FAIR" <?php if($myrow[7] == 'DELTA FAIR') echo $selected?>>DELTA FAIR</option>
            </select></td>
            <td><span class="tabletext"><b>Remarks</b></td>
            <td><textarea name="remarks" rows="2" cols="40" value="<?php echo $myrow[8]?>"><?php echo $myrow[8]?></textarea></td>
        </tr>
            <input type="hidden"  name="recnum"  value="<?php echo $myrow[0]?>">
</table>
      </table>
  <!--     <td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
                <tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr> -->

        </table>
        <table border=0 cellpadding=0 cellspacing=0 width=100% >
							<tr>
								<td align=left>


								</td>
							</tr>
   <td><span class="tabletext">
            <input type="submit"
            style="color=#0066CC;background-color:#DDDDDD;width=130;"
            value="Submit" name="submit" onclick="javascript: return check_req_fields();">
              <INPUT TYPE="RESET"
        style="color=#0066CC;background-color:#DDDDDD;width=130;"
        VALUE="Reset" onclick="javascript: putfocus()"></td>
						</table>

      </FORM>
</body>
</html>

