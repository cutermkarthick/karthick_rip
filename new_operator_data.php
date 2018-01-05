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

$_SESSION['pagename'] = 'new_operator_data';
//////session_register('pagename');

// First include the class definition
include('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/operatorClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$op = new operator();

?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/review.js"></script>
<script language="javascript" src="scripts/woentry.js"></script>



<html>
<head>
<title>Operator data</title>
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
        <td><span class="pageheading"><b>Operator Data Form</b></td>
    </tr>


     <form action='processoperator_data.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Operator Data Header</b></center></td>
        </tr>
 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

 <?php

     $result = $op->getops();
     $result1 = $op->getmcs();
 ?>
        <tr bgcolor="#FFFFFF">
            <td width=8%><span class="labeltext"><p align="left"><span class='asterisk'>*</span>M/C Name </p></font></td>
            <td width=10% ><span class="labeltext"><p align="left">Operator </p></font></td>
            <td width=10%><span class="labeltext"><p align="left">WO#</p></font></td>
            <td width=10%><span class="labeltext"><p align="left">PRN#</p></font></td>
            <td width=10%><span class="labeltext"><p align="left">QTY </p></font></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td width=8% rowspan=2><select name="mc_name">
                                   <?php
                                   while($row1 = mysql_fetch_row($result1))
                                   {
                                     echo "<option value='$row1[0]'> $row1[0]";
                                   }
                                ?>
                                   </select></td>
            <td width=10% rowspan=2><select name="oper_name">
                                <?php
                                   while($row = mysql_fetch_row($result))
                                   {
                                     echo "<option value='$row[0] $row[1]'> $row[0] $row[1]";
                                   }
                                ?>
                                   </select></td>
            <td><span class="tabletext"><input type="text" name="wo_num" size=8 value="" style="background-color:#DDDDDD;"
                    readonly="readonly">
                   <img src='images/getwo.gif' name='cim' onclick='Getwo_crn("<?php echo 'wo_num' ?>")'>
                   </td>
            <td><span class="tabletext"><input type="text" name="crn" size=8 value="" style="background-color:#DDDDDD;"
                    readonly="readonly"></td>
            <td><span class="tabletext"><input type="text" name="qty" size=3 value=""></td>
        </tr>


        </table>
        <br>
        
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">

            <td width=8% rowspan=2><span class="labeltext"><p align="left">Date</p></font></td>
            <td width=5% rowspan=2><span class="labeltext"><p align="left">Shift</p></font></td>
            <td width=2%><span class="labeltext"><p align="left">Stage</p></font></td>
             <?php
               $i=1;
               while($i<=16)
               {
             ?>
                  <td><span class="labeltext"><p align="left"><?php echo $i ?></p></font></td>
             <?php
                $i++;
               }
             ?>
           </p></font></td>

        </tr>
        <tr bgcolor="#FFFFFF">
         <td class="labeltext1">Setting Time(mins)</td>
          <?php
           $x=1;
           while($x<=16)
           {
            $setting_time = 'setting_time' . $x;
         ?>

            <td><span class="tabletext"><input type="text" name="<?php echo $setting_time ?>" size=2 value=""></td>
         <?php
            $x++;
           }
         ?>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td rowspan=5><span class="tabletext"><input type="text" name="st_date" size=8 value="">
               <img src="images/bu-getdateicon.gif" alt="Get BookDate" onclick="GetDate('st_date')"></td>
            <td rowspan=5><span class="tabletext"><input type="text" name="shift" size=5 value=""></td>
            <td class="labeltext1">Running Time(mins)</td>
         <?php
           $x=1;
           while($x<=16)
           {
            $running_time = 'running_time' . $x;
         ?>

            <td><span class="tabletext"><input type="text" name="<?php echo $running_time ?>" size=2 value=""></td>
         <?php
            $x++;
           }
         ?>

        </tr>

        <tr bgcolor="#FFFFFF">
          <td class='labeltext1'>Idle Time(mins)</td>
          <?php
           $x=1;
           while($x<=16)
           {
            $idle_time = 'idle_time' . $x;
          ?>

            <td><span class="tabletext"><input type="text" name="<?php echo $idle_time ?>" size=2 value=""></td>
          <?php
            $x++;
           }
          ?>
        </tr>
        
         <tr bgcolor="#FFFFFF">
          <td class='labeltext1'>Qty. Produced</td>
          <?php
           $x=1;
           while($x<=16)
           {
            $qty = 'qty' . $x;
          ?>

            <td><span class="tabletext"><input type="text" name="<?php echo $qty ?>" size=2 value=""></td>
          <?php
            $x++;
           }
          ?>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td class='labeltext1'>Sl No. From:</td>
          <?php
           $x=1;
           while($x<=16)
           {
            $sl_from = 'sl_from' . $x;
          ?>

            <td><span class="tabletext"><input type="text" name="<?php echo $sl_from ?>" size=2 value=""></td>
          <?php
            $x++;
           }
          ?>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td class='labeltext1'>Sl No. to:</td>
          <?php
           $x=1;
           while($x<=16)
           {
            $sl_to = 'sl_to' . $x;
          ?>

            <td><span class="tabletext"><input type="text" name="<?php echo $sl_to ?>" size=2 value=""></td>
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
