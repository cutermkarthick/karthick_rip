<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = april 04, 2007               =
// Filename: edit_mc_master.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows edit of crn mc_master                =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'new_timemaster';
$dept = $_SESSION['department'];
session_register('pagename');

// First include the class definition
include('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/mc_masterClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newmc_master = new mc_master;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mc_master.js"></script>

<html>
<head>
<title>New Time Master</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

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
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

	<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	     		     <td bgcolor="#FFFFFF">
				<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>New Time Master Form</b></td>
    </tr>


     <form action='processmc_master.php' method='post' enctype='multipart/form-data'>



 <!--<fieldset>
   <legend>
        <span class="pageheading"><b>PRN Cycle Time</b>
  </legend>-->

 <table width=100% border=0 cellpadding=6 cellspacing=0>
  <form action='processmc_master.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>PRN Cycle</b></center></td>
        </tr>
<table width=80% border=0 cellpadding=3 cellspacing=1>
          <tr>
          <td colspan=10>
           <table width=60% border=1 cellpadding=0 cellspacing=1><tr bordercolor="black">
           <td width=45px style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>PRN</b></font</td>
           <td width=50px style=";background-color:#FFFFFF;"><span class="tabletext"><input type="text" name="crn_num" style=";background-color:#DDDDDD;" readonly size=10 value="">
            <img src='images/bu-get.gif' onClick="Getcrns()">
           </tr></table>
          </td>

		  <td colspan=5>
           <table width=60% border=1 cellpadding=0 cellspacing=1><tr bordercolor="black">
           <td width=45px style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>MPS Revision</b></font</td>
           <td width=50px style=";background-color:#FFFFFF;"><span class="tabletext"><input type="text" name="mps_revision" style=";background-color:#FFFFFF;" size=10 value="">           
           </tr></table>
          </td>


          <!--<td><img src='images/bu-get.gif' onClick="Getcrns()">-->
		  <input type="hidden" name="crnrecnum" size=5 value=""></td></td>
          <td colspan=3>
          <table width=50% border=1 cellpadding=0 cellspacing=1 bordercolor="black">
            <tr><td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>Bench  Time</b></font></td>
             <td width=100px style=";background-color:#FFFFFF;"><span class="tabletext"><input type="text" name="fitting_time_hrs" maxlength=2  style="width:50%;Border:none" size=3 value=""><b>:</b>
			                            <input type="text" name="fitting_time_mins" maxlength=2 style="width:50%;Border:none" size=3 value="">

          </table>
        </td>

        <td colspan=6>&nbsp</td>
        <td colspan=3>

            <table width=50% border=1 cellpadding=0 cellspacing=1 bordercolor="black">
            <tr><td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>Inspection Time</b></font></td>
            <td width=120px style=";background-color:#FFFFFF;"><span class="tabletext"><input type="text" name="insp_time_hrs" maxlength=2 style="width:50%;Border:none" size=3 value=""><b>:</b>
			                            <input type="text" name="insp_time_mins" maxlength=2 style="width:50%;Border:none" size=3 value="">

            </table>
          </td>
         </tr>
        </table>


        <table width=80% border=1 cellpadding=3 cellspacing=1 rows=all columns=all>

         <tr>
             <td width=1%><span class="tabletext"><i>Qty</i></td>
             <td rowspan=3><span class="tabletext"><i>Stage<br>Details</i></td>
             <td width=1%><p align="center"><span class="tabletext"><i>Stages</i></p></td>
           <?php
              $i=1;
             while($i<=24)
             {
            ?>
            <td width=1%><span class="labeltext"><p align="left"><?php echo $i ?></p></font></td>
            <?php
             $i++;
            }

?>       </tr>
         <tr>
         <td width=1%><span class="tabletext"><input type="text" name="qty" value="1"style=";background-color:#DDDDDD;" readonly="readonly" size=4></td>
         <td width=1%><span class="labeltext1"><p align="center"><i>Setting Time</i></p></font></td>
       <?php
           $x=1;
           while($x<=24)
           {

                $setting_time = 'setting_time' . $x;
                $setting_time_mins = 'setting_time_mins' . $x;
             ?>
             <td width=30px><span class="tabletext"><input type="text" name="<?php echo $setting_time ?>" style="width:50%;Border:none" maxlength=2 size=3 value=""><b>:</b>
                                        <input type="text" name="<?php echo $setting_time_mins ?>" style="width:50%;Border:none" maxlength=2 size=3 value=""></td>
           <?php
            $x++;
            }
           ?>



          </tr><tr bgcolor="#FFFFFF">

         <td width=1%><span class="tabletext"><font color="339933"><i>Val/<br>pc</i></font></td>
            <td width=1%><span class="labeltext1"><p align="center"><i>Running Time</i></p></font></td>
         <?php
           $x=1;
           while($x<=24)
           {

                $running_time = 'running_time' . $x;
                 $running_time_mins = 'running_time_mins' . $x;
             ?>
             <td width=30px ><span class="tabletext"><input type="text" name="<?php echo $running_time ?>" style="width:50%;Border:none" maxlength=2 size=3 value=""><b>:</b>
                                        <input type="text" name="<?php echo $running_time_mins ?>" style="width:50%;Border:none" maxlength=2 size=3 value=""></td>
        <?php
            $x++;
           }
         ?>

            </tr><tr bgcolor="#FFFFFF">

            <td width=1%><span class="tabletext"><input type="text" name="valperpart" value="" size=5></td>
  <?php
            print('<td width=1% style="border:0px">&nbsp;</td>');
            print('<td width=1%><span class="labeltext1"><p align="center"><font color="339933"><i>Stage Cost</i></font></p></td>');

            $x=1;
            while($x<=24)
            {
              $stage_cost = 'stage_cost' . $x;
             ?>
               <td><span class="tabletext"><input type="text" name="<?php echo $stage_cost ?>" size=3 value="">
                                        </td>
             <?php
            $x++;
           }
         ?>

      <tr bgcolor="#99FFFF" height=10px><td  border="0" colspan=27><span class="heading"></td></tr>


        </table>
	</td>
    </tr>


</table>
  <span class="labeltext"><input type="submit"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                value="Submit" name="submit" onclick="javascript: return check_req_fields()">
                <INPUT TYPE="RESET"
                style="color=#0066CC;background-color:#DDDDDD;width=130;"
                VALUE="Reset" onclick="javascript: putfocus()">
</td>
		<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>
<!--</fieldset>-->

		</table>


      </FORM>


</table>

								</td>
							</tr>
						</table>
		</body>
</html>
