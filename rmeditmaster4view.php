<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 17, 2008                =
// Filename: rmmasterdetails.php               =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// RM Master Details                           =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'rmeditmaster4view';
//////session_register('pagename');
$dept=$_SESSION['department'];
$role=$_SESSION['usertype'];
// First include the class definition

include('classes/rmmasterClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$userid = $_SESSION['user'];

$newMD = new rmmaster;
$newdisplay = new display;

$masterdatarecnum = $_REQUEST['masterdatarecnum'];
//echo $masterdatarecnum."======";
$result = $newMD->getrmmasterdata($masterdatarecnum);
$myrow = mysql_fetch_assoc($result);
$result1= $newMD->getnotes($masterdatarecnum);
$mynotes= mysql_fetch_row($result1);
//echo $myrow["rmcode"]."hai";
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/rmmaster.js"></script>

<html>
<head>
<title>Master Data Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='processRMMaster.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
       <tr>
          <td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
          <td align="right">&nbsp;
          <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
       </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>

<?php  $newdisplay->dispLinks(''); ?>

</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
<td><span class="pageheading"><b>RM Master data</b><td colspan=250></td>
    <td bgcolor="#FFFFFF" rowspan=2 align="right">
</td>
  </tr>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>RM Master Data Details</b></center></td></tr>


 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
 <tr bgcolor="#FFFFFF"></tr>


 		 <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">PRN#</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["crnnum"] ?></td>
            <td width=25%><span class="labeltext"><p align="left">Spec Type</font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow["rm_altrm"] ?>
            <input type="hidden" name="spec_val" id="spec_val" value='<?php echo $myrow["rm_altrm"] ?>'>
            </td>
        </tr>
        <tr bgcolor="#FFFFFF">
         	<td><span class="labeltext"><p align="left">RM Spec</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["rm_spec"] ?></td>
            <td><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["rm_type"] ?>
        </tr>

         <tr bgcolor="#FFFFFF">
         	<td><span class="labeltext"><p align="left">RM Condition</p></font></td>
            <td colspan="3"><span class="tabletext"><?php echo $myrow["rm_condition"] ?></td>

        </tr>

        <tr bgcolor="#FFFFFF">
         <td width=25%><span class="labeltext"><p align="left">UOM</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow["rm_uom"] ?>
             <td><span class="labeltext"><p align="left">Dia</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["rm_dia"] ?></td>

        </tr>
        <tr bgcolor="#FFFFFF">
         <td width=25%><span class="labeltext"><p align="left">Length</p></font></td>
            <td width=25%><span class="tabletext"><?php echo $myrow["length"] ?>
            </td>
        <td width=25%><span class="labeltext"><p align="left">Width</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["width"] ?></td>


        </tr>

        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Thickness</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["thickness"] ?></td>
         <td><span class="labeltext"><p align="left">Grainflow</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["rm_grainflow"] ?></td>


        </tr>


        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">LT</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["rm_lt"] ?></td>
        <td><span class="labeltext"><p align="left">ST</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["rm_st"] ?></td>


        </tr>
        <tr bgcolor="#FFFFFF">
         <td><span class="labeltext"><p align="left">Qty/Billet</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["rm_qty_perbill"] ?></td>
        <td><span class="labeltext"><p align="left">MRS</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["rm_mrs"] ?></td>

        </tr>
        <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Unit Price</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["rm_unitprize"] ?></td>
         <td  width=25%><span class="labeltext"><p align="left"><span class='asterisk'></span>Supplier</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["name"] ?></td>

        </tr>
        <?php
                   if($myrow["rm_status"] == 'Inactive')
                   {
                      $color = '"#FF0000"';
                   }
                   else if($myrow["rm_status"] == 'Active')
                       {
                         $color = '"#00FF00"';

                       }
                       else
                       {
                          $color = '"#FFFFFF"';

                       }

        ?>
        <tr bgcolor="#FFFFFF">
          <td width=25%><span class="labeltext"><p align="left">Status</p></font></td>
            <td bgcolor=<?php echo $color ?>><span class="tabletext"><span class="tabletext"><?php echo $myrow["rm_status"] ?></td>
             <input type="hidden" name="rm_status" id="rm_status" value="<?php echo $myrow["rm_status"]?>"></td></td>
          <td colspan="2"></td>
    <!--    <tr bgcolor="#FFFFFF">
          <td width=25%><span class="labeltext"><p align="left">RM Code</p></font></td>
            <td><span class="tabletext"><span class="tabletext"><?php echo $myrow["rmcode"] ?></td>
            <td><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["rm_type"] ?>
         </tr> -->
   <!--     <tr bgcolor="#FFFFFF">
           <td><span class="labeltext"><p align="left">Alt Spec</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["rm_altrm"] ?></td>

            <td colspan="2"><span class="tabletext"></td> -->
        </tr>
        <?php
            $checked="checked";
            if($dept == 'ENGAPP')
            {
        ?>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext">Engineering Approved</td>
            <td bgcolor="#FFFFFF"><input type="checkbox" <?php echo $myrow["enggapproved"] == 'yes'?$checked:"" ?>  id="engineering_approved" name="engineering_approved" onclick="JavaScript:toggleValue('eng_app',this);">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>"></td>
                         <input type="hidden" name="eng_app" value="<?php echo $myrow["enggapproved"]?>" id="eng_app">
                         <input type="hidden" name="masterdatarecnum" id="masterdatarecnum" value="<?php echo $masterdatarecnum?>"></td></td>
                         <input type="hidden" name="eng_app_by" value="<?php echo $myrow["engapprovedby"]?>" id="eng_app_by">
          <td><span class="labeltext">Engineering Approved Date </td>
          <td bgcolor="#FFFFFF"><input type='text' name='eng_app_date' id="eng_app_date" value='<?php echo $myrow["eng_app_date"]?>' style="background-color:#DDDDDD;" readonly="readonly"> </td>


          </tr>

        <?php
          }
        ?>
         <tr bgcolor="#FFFFFF">

        <?php



            printf('<tr  bgcolor="#DDDEDD"><td colspan=12><span class="heading"><center><b>RM Notes</b></center></td></tr>');
            $result2 = $newMD->getNotes($masterdatarecnum);
            printf('<tr bgcolor="#FFFFFF"><td colspan=12><textarea name="notes" rows="6" cols="89" readonly="readonly" style="background-color:#DDDDDD;">');
            while ($mynotes = mysql_fetch_row($result2)) {
                  printf("\n");
                  $d1=$mynotes[0];
                  if($d1 != '' && $d1 != '0000-00-00')
                     {
                		 $datearr = split('-', $d1);
                		 $d=$datearr[2];
                		 $m=$datearr[1];
                 		 $y=$datearr[0];
                 		 $x=mktime(0,0,0,$m,$d,$y);
                 		 $create_date=date("M j, Y",$x);
              		 }
				  else
               		 {
                	     $create_date = '';
              		 }
                  printf("********Added by $userid on $create_date *******");
                  printf("\n");
                  printf($mynotes[1]);
                  printf("   \n");
            }

?>
  </textarea></tr>
</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#FFFFFF">
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

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
				<span class="tabletext"><input type="submit"
      style="color=#0066CC;background-color:#DDDDDD;width=130;"
      value="Submit" name="submit">
      </FORM>
</table>
</body>
</html>
