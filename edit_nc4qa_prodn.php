<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2006                =
// Filename: quoteDetailsEntry.php             =
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

$_SESSION['pagename'] = 'edit_nc4qa_prodn';
//////session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/nc4qaclass.php');
include('classes/displayClass.php');

$dept = $_SESSION['department'];

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newnc = new nc4qa;

$nc4qarecnum = $_REQUEST['nc4qarecnum'];

$result = $newnc->getqanc($nc4qarecnum);
$myrow =  mysql_fetch_row($result);



?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/nc4qa.js"></script>



<html>
<head>
<script language="javascript" type="text/javascript">
function readOnlyCheckBox() {
   return false;
}

</script>
<title>Edit NC for production</title>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0">

<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
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

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0>
    <tr>
        <td><span class="pageheading"><b>Edit NC</b></td>
    </tr>


     <form action='processnc4qa.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>NC Header</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Id No.</p></font></td>
            <td colspan=3><input type="text" name="idnum" size=20 value="<?php printf("%05d", $myrow[0]) ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
         </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>WO No.</p></font></td>
            <td><input type="text" name="wonum" size=20 value="<?php echo $myrow[11] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
               </td>
            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>CIM Ref Num.</p></font></td>
            <td width=25%><span class="tabletext"><input type="text" name="refnum" size=20 value="<?php echo $myrow[1] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Customer</p></font></td>
            <td width=25%><input type="text" name="customer" size=20 value="<?php echo $myrow[2] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
             <input type="hidden" name="custrecnum"></td>
             <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>PO No.</p></font></td>
            <td><input type="text" name="ponum" size=20 value="<?php echo $myrow[9] ?>"  style=";background-color:#DDDDDD;" readonly="readonly">
              <input type="hidden" name="porecnum">
                </td>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part Name</p></font></td>
            <td><input type="text" name="partname" size=20 value="<?php echo $myrow[3] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Part No.</p></font></td>
            <td><input type="text" name="partnum" size=20 value="<?php echo $myrow[5] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Batch No.</p></font></td>
            <td><input type="text" id="bachnum" name="bachnum" size=20 value="<?php echo $myrow[4] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
            </td>
            <td><span class="labeltext"><p align="left">Matl. Spec</p></font></td>
            <td><input type="text" name="matl_spec" size=20 value="<?php echo $myrow[6] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Issue & PS</p></font></td>
            <td><input type="text" name="issues_ps" size=20 value="<?php echo $myrow[7] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left">Qty</p></font></td>
            <td><input type="text" name="qty" size=20 value="<?php echo $myrow[8] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>


         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Sl No.</p></font></td>
            <td><input type="text" name="part_sl_num" size=20 value="<?php echo $myrow[10] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
            <td><span class="labeltext"><p align="left">DC No.</p></font></td>
            <td><input type="text" name="dcnum" size=20 value="<?php echo $myrow[12] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">DC Date</p></font></td>
            <td><input type="text" name="dcdate" size=20 value="<?php echo $myrow[13] ?>" style=";background-color:#DDDDDD;" readonly="readonly">
                </td>
            <td><span class="labeltext"><p align="left">C of C No.</p></font></td>
            <td><input type="text" name="cofcnum" size=20 value="<?php echo $myrow[29] ?>" style=";background-color:#DDDDDD;" readonly="readonly"></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">ITraceability Rec No.</p></font></td>
            <td colspan=3><input type="text" name="traceability_recnum" size=20 value="<?php echo $myrow[14] ?>" style=";background-color:#DDDDDD;" readonly="readonly">

        </tr>

<input type="hidden" name="action" value="edit">
<input type="hidden" name="nc4qarecnum" value="<?php echo $nc4qarecnum ?>">


<tr bgcolor="#FFFFFF">


<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
   <td bgcolor="#FFFFFF" width=20%><span class="labeltext">DIMENSIONAL DEVIATION</td>
   <?php

   $checked1="";

   if($myrow[15] == 'yes'){
   $checked1="checked";
   }
   ?>

   <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $checked1 ?> name="chk1"  onClick="return readOnlyCheckBox()">
                         <input type="hidden" name="dim_deviation" value="<?php echo $myrow[15]?>" id="dim_deviation"></td>
   <td bgcolor="#FFFFFF" width=20%><span class="labeltext">MAN</td>
   <?php

   $checked2="";

   if($myrow[16] == 'yes'){
   $checked2="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $checked2 ?> name="chk2" onClick="return readOnlyCheckBox()">
                         <input type="hidden" name="man"  value="<?php echo $myrow[16]?>" id="man"></td>
   <td bgcolor="#FFFFFF"  width=20%><span class="labeltext">IN PROCESS</td>
    <?php

   $checked3="";

   if($myrow[17] == 'yes'){
   $checked3="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $checked3 ?> name="chk3" onClick="return readOnlyCheckBox()">
                         <input type="hidden" name="inprocess"  value="<?php echo $myrow[17]?>"  id="inprocess"></td>
</tr>
<tr>
  <td bgcolor="#FFFFFF"><span class="labeltext">MATERIAL DEVIATION</td>
  <?php

   $checked4="";

   if($myrow[18] == 'yes'){
   $checked4="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $checked4 ?> name="chk4" onClick="return readOnlyCheckBox()">
                         <input type="hidden" name="mat_deviation"  value="<?php echo $myrow[18]?>"  id="mat_deviation"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">MACHINE</td>
   <?php

   $checked5="";

   if($myrow[19] == 'yes'){
   $checked5="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $checked5 ?> name="chk5" onClick="return readOnlyCheckBox()">
                         <input type="hidden" name="machine"  value="<?php echo $myrow[19]?>"  id="machine"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">FINAL INSPECTION</td>
   <?php

   $checked6="";

   if($myrow[20] == 'yes'){
   $checked6="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $checked6 ?> name="chk6" onClick="return readOnlyCheckBox()">
                         <input type="hidden" name="final_insp"  value="<?php echo $myrow[20]?>" id="final_insp"></td>
</tr>
<tr>
  <td bgcolor="#FFFFFF"><span class="labeltext">OTHER DEVIATION</td>
  <?php

   $checked7="";

   if($myrow[21] == 'yes'){
   $checked7="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $checked7 ?> name="chk7" onClick="return readOnlyCheckBox()">
                         <input type="hidden" name="other_deviation"  value="<?php echo $myrow[21]?>"  id="other_deviation"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">METHOD</td>
   <?php

   $checked8="";

   if($myrow[22] == 'yes'){
   $checked8="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $checked8 ?> name="chk8" onClick="return readOnlyCheckBox()">
                         <input type="hidden" name="method"  value="<?php echo $myrow[22]?>"  id="method"></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">CUSTOMER END</td>
   <?php

   $checked9="";

   if($myrow[23] == 'yes'){
   $checked9="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $checked9 ?> name="chk9" onClick="return readOnlyCheckBox()">
                         <input type="hidden" name="cust_end"  value="<?php echo $myrow[23]?>" id="cust_end"></td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>Breif Description of Non Conformance:</b><br>
    <textarea name="description" rows=6 cols=60 value="<?php echo $myrow[24] ?>" style=";background-color:#DDDDDD;" readonly="readonly"><?php echo $myrow[24] ?></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>Root Cause:</b><br>
    <textarea name="root_cause" rows=6 cols=60  value="<?php echo $myrow[25] ?>"><?php echo $myrow[25]?></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>Corrective Action:</b><br>
    <textarea name="corrective_action" rows=6 cols=60 value="<?php echo $myrow[26] ?>"><?php echo $myrow[26]?></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>Preventive Action:</b><br>
    <textarea name="preventive_action" rows=6 cols=60 style=";background-color:#DDDDDD;" value="<?php echo $myrow[27] ?>" readonly="readonly"><?php echo $myrow[27] ?></textarea>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>Effectiveness:</b><br>
    <textarea name="effectiveness" rows=6 cols=60 style=";background-color:#DDDDDD;" value="<?php echo $myrow[28] ?>" readonly="readonly"><?php echo $myrow[28] ?></textarea>
    </td>
</tr>
</table>
	</td>
    </tr>


    </td>

     <tr bgcolor="#FFFFFF">
       <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

         <tr bgcolor="#FFFFFF">


        </tr>


</table>

</td>
		<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>

		</table>
<span class="labeltext"><input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()">

      </FORM>
</table>
</body>
</html>
