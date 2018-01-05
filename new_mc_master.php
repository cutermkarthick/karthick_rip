<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = april 04, 2007               =
// Filename: new_review.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Allows entry of reviews                     =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'new_mc_master';
//////session_register('pagename');

// First include the class definition
include('classes/loginClass.php');
include('classes/displayClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;

?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mc_master.js"></script>



<html>
<head>
<title>Machine Master</title>
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
        <td><span class="pageheading"><b>Machine Master Form</b></td>
    </tr>


     <form action='processmc_master.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Machine Master Header</b></center></td>
        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">
            <td width=8% rowspan=2><span class="labeltext"><p align="left"><span class='asterisk'>*</span>ID </p></font></td>
            <td width=10% rowspan=2><span class="labeltext"><p align="left">Name </p></font></td>
            <td width=10% rowspan=2><span class="labeltext"><p align="left">PRN# </p></font></td>
            <td width=10% rowspan=2><span class="labeltext"><p align="left">Cost/Hr </p></font></td>
            <td width=10% rowspan=2><span class="labeltext"><p align="left">QTY </p></font></td>
            <td width=10% rowspan=2><span class="labeltext"><p align="left">Setup Time </p></font></td>
            <td width=10%><span class="labeltext"><p align="center">Time stages </p></font></td>
          <?php
            $i=1;
            while($i<=16)
            {
          ?>
             <td width=10%><span class="labeltext"><p align="left"><?php echo $i ?></p></font></td>
          <?php
             $i++;
            }
          ?>

        </tr>
        <tr bgcolor="#FFFFFF">
           <td width=10%><span class="labeltext1"><p align="center">Setting Time(Hrs) </p></font></td>
         <?php
           $x=1;
           while($x<=16)
           {
            $setting_time = 'setting_time' . $x;
            $setting_time_mins = 'setting_time_mins' . $x;
         ?>

            <td><span class="tabletext">HH:<input type="text" name="<?php echo $setting_time ?>" size=3 value=""><br>
                                        MM:<input type="text" name="<?php echo $setting_time_mins ?>" size=3 value=""></td>
         <?php
            $x++;
           }
         ?>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="tabletext"><input type="text" name="mc_id" size=3 value=""></td>
            <td><span class="tabletext"><input type="text" name="mc_name" size=5 value=""></td>
            <td><span class="tabletext"><input type="text" name="crn_num" size=5 value="">
                <img src='images/bu-get.gif' onClick="Getcrns()">
				<input type="hidden" name="crnrecnum" size=5 value=""></td>
            <td><span class="tabletext"><input type="text" name="mc_cost_per_hour" size=3 value=""></td>
            <td><span class="tabletext"><input type="text" name="qty" size=3 value=""></td>
            <td><span class="tabletext"><input type="text" name="setup_time" size=3 value=""></td>
            <td width=10%><span class="labeltext1"><p align="center">Running Time(Hrs) </p></font></td>
         <?php
           $x=1;

           while($x<=16)
           {
            $running_time = 'running_time' . $x;
            $running_time_mins = 'running_time_mins' . $x;
         ?>

            <td><span class="tabletext">HH:<input type="text" name="<?php echo $running_time ?>" size=3 value=""><br>
                                        MM:<input type="text" name="<?php echo $running_time_mins ?>" size=3 value=""></td>
         <?php
            $x++;
           }
         ?>
            

        </tr>


        </table>
	</td>
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
