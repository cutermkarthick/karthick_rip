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

$_SESSION['pagename'] = 'mc_master_details';
//////session_register('pagename');

// First include the class definition
include('classes/loginClass.php');
include('classes/displayClass.php');
include('classes/mc_masterClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newdisplay = new display;
$newmc_master = new mc_master;

$mc_masterrecnum = $_REQUEST['mc_masterrecnum'];

$result = $newmc_master->getmc_master_data($mc_masterrecnum);
$myrow = mysql_fetch_assoc($result);

$result1 = $newmc_master->getstage_data($mc_masterrecnum);


?>


<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/review.js"></script>



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
        <td align=right><a href='edit_mc_master.php?mc_masterrecnum=<?php echo $mc_masterrecnum ?>'><img src='images/bu-edit.gif' border=0></a></td>
    </tr>


     <form action='processmc_master.php' method='post' enctype='multipart/form-data'>
<tr>
<td colspan=2>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Machine Master Header</b></center></td>

        </tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

        <tr bgcolor="#FFFFFF">

           <!-- <td width=8% rowspan=2><span class="labeltext"><p align="left"><span class='asterisk'>*</span>ID </p></font></td>
            <td width=10% rowspan=2><span class="labeltext"><p align="left">Name </p></font></td> -->
            <td width=10% rowspan=2><span class="labeltext"><p align="left">PRN#</p></font></td>
           <!-- <td width=6% rowspan=2><span class="labeltext"><p align="left">Cost/Hr </p></font></td> -->
            <td width=6% rowspan=2><span class="labeltext"><p align="left">QTY </p></font></td>
            <td width=6% rowspan=2><span class="labeltext"><p align="left">Setup Time </p></font></td>
            <td width=10%><span class="labeltext"><p align="center">Time stages</p></font></td>
            <?php
             $i=1;
             while($i<=16)
             {
            ?>
            <td width=3%><span class="labeltext"><p align="left"><?php echo $i ?></p></font></td>
            <?php
             $i++;
            }
            ?>
        </tr>
        <tr bgcolor="#FFFFFF">
           <td width=10%><span class="labeltext1"><p align="center">Setting Time(Hrs)</p></font></td>
           <?php
           $x=1;

           while($myrow1 = mysql_fetch_assoc($result1))
           {

                     $running_time1[] = $myrow1['running_time'];
                     $setting_time1[] = $myrow1['setting_time'];
                     $running_time_mins1[] = $myrow1['running_time_mins'];
                     $setting_time_mins1[] = $myrow1['setting_time_mins'];

                     $stage_num[] = $myrow1['stage_num'];
           }

           while($x<=16)
           {
            $setting_time = 'setting_time' . $x;
         ?>

            <td><span class="tabletext">
           <?php if(isset($stage_num[0]))
                        {
                             $y = 0;
                             foreach($stage_num as $val)
                              {
                                 //echo $val. ' and ' . $x;
                                  if($val == $x)
                                  {
                                    //echo 'hi';
                                    if($setting_time1[$y] == 0)
                                      echo '';
                                    else
                                      echo "$setting_time1[$y] h ";
                                      
                                    echo $setting_time_mins1[$y]? "$setting_time_mins1[$y] m" : '';

                                  }
                                  $y++;
                              }
                         }
             ?></td>
         <?php
            $x++;
           }
         ?>

        </tr>
         <tr bgcolor="#FFFFFF">
          <!--  <td><span class="tabletext"><?php// echo $myrow['mc_id'] ?></td>
            <td><span class="tabletext"><?php// echo $myrow['mc_name'] ?></td> -->
            <td><span class="tabletext"><?php echo $myrow['crn_num'] ?></td>
          <!--  <td><span class="tabletext"><?php// echo $myrow['mc_cost_per_hour'] ?></td>-->
            <td><span class="tabletext"><?php echo $myrow['qty'] ?></td>
            <td><span class="tabletext"><?php echo $myrow['setup_time'] ?></td>
            <td width=10%><span class="labeltext1"><p align="center">Running Time(Hrs)</p></font></td>
         <?php
           $x=1;

           while($x<=16)
           {
            $running_time = 'running_time' . $x;
         ?>

            <td><span class="tabletext">
           <?php if(isset($stage_num[0]))
                        {
                             $y = 0;
                             foreach($stage_num as $val)
                              {
                                 //echo $val. ' and ' . $x;
                                  if($val == $x)
                                  {
                                    //echo 'hi';
                                    if($running_time1[$y] == 0)
                                       echo '';
                                    else
                                       echo "$running_time1[$y] h ";
                                    echo $running_time_mins1[$y]? "$running_time_mins1[$y] m":'';
                                  }
                                  $y++;
                              }
                         }
             ?></td>
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


      </FORM>
</table>
</body>
</html>
