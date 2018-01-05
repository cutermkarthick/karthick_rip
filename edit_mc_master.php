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

$_SESSION['pagename'] = 'edit_mc_master';
$dept = $_SESSION['department'];
$page = "CRM: Time Master";
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
//echo $mc_masterrecnum;

$result = $newmc_master->getmc_master_data($mc_masterrecnum);
$myrow = mysql_fetch_assoc($result);

$result1 = $newmc_master->getstage_data($mc_masterrecnum);
$result2 = $newmc_master->getstage_data4total_hrs($mc_masterrecnum);
$myrow2 = mysql_fetch_assoc($result2);
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mc_master.js"></script>



<html>
<head>
<title>Time Master</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">

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
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>
<?php
$newdisplay->dispLinks(''); 
?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0  >
 <tr>
 <td><span class="pageheading"><b>Time Master Form</b></td>
 </tr>


<form action='processmc_master.php' method='post' enctype='multipart/form-data'>
<tr>
<td>
<input type='hidden' name='link2master_data' value='<?echo $myrow4mps_rev['link2master_data']; ?>'>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" style="border:1px solid" class="stdtable1" >
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Time Master</b></center></td>
        </tr>
	
<table width=80% style="border:1px solid" cellpadding=3 cellspacing=1>
        <tr>
          <td colspan=15>
           <table width=100% style="border:1px solid" cellpadding=0 cellspacing=1 bordercolor="black">
           <td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>PRN</b></font></td>
           <td style=";background-color:#FFFFFF;"><span class="tabletext"><input type="text" name="crn_num" 
		   style=";background-color:#DDDDDD;" readonly size=8 value='<?php printf("%s", $myrow['crn_num'])?>'>
           </tr></table>
          </td>
        <td colspan=6>&nbsp</td>
        <td colspan=3>

            <table width=90% style="border:1px solid" cellpadding=0 cellspacing=1 bordercolor="black">
            <tr>
			<td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>Mps Revision </b></font></td>			
            <td width=45px style=";background-color:#FFFFFF;"><span class="tabletext"><input type="text" align="right" name="mps_revision" style="Border:none;background-color:#DDDDDD;" size=3  readonly="readonly" value="<?php printf("%s", $myrow['mps_revision']); ?>"><b>
			</table>
            </td>       
       
		
          <td colspan=15>
				<input type="hidden" name="mc_masterrecnum" size=5 value="<?php echo $mc_masterrecnum?>"></td></td>
          <td colspan=3>
           <table width=90% style="border:1px solid" cellpadding=3 cellspacing=1 bordercolor="black">
            <td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>Total Run Time</b></font></td><td  style=";background-color:#DDDDDD;"><span class="tabletext"><font color="red"><b>
            <?php
             $total_mins = (($myrow2['tot_runtime'] * 60) + $myrow2['tot_runtime_mins']);
             $total_hrs = ($total_mins / 60);
             $total_mins1 = ($total_mins % 60);
             printf("%d", $total_hrs);
             printf("%s%02d",":", $total_mins1);
             ?></b></font></td>
          </table>
        </td>
  

        <td colspan=6>&nbsp</td>
        <td colspan=3>
        
         <table width=90% style="border:1px solid" cellpadding=3 cellspacing=1 bordercolor="black">
            <tr><td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>Total Setting Time</b></font></td><td  style=";background-color:#DDDDDD;"><span class="tabletext"><font color="red"><b><?php
             $total_mins = (($myrow2['tot_settime'] * 60) + $myrow2['tot_settime_mins']);
             $total_hrs = ($total_mins / 60);
             $total_mins1 = ($total_mins % 60);
            printf("%d", $total_hrs);
            printf("%s%02d",":", $total_mins1);
            ?></b></font></td>
          </table>
          </td>
          <td colspan=6>&nbsp</td>
          <td colspan=3>

          <table width=90%  style="border:1px solid" cellpadding=0 cellspacing=1  bordercolor="black">
            <tr><td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>Bench  Time</b></font></td>
             <td width=45px style=";background-color:#FFFFFF;"><span class="tabletext"><font color="red"><input type="text" align="right" name="fitting_time_hrs" maxlength=2  style="width:50%;Border:none" size=3   value="<?php  printf("%02d", $myrow['fitting_time_hrs']); ?>"></font><b>:</b>
			                            <input type="text" name="fitting_time_mins" maxlength=2  style="width:50%;Border:none" size=3  value="<?php printf("%02d",$myrow['fitting_time_mins']);?>">

          </table>
        </td>
        <td colspan=6>&nbsp</td>
        <td colspan=3>

            <table width=90% style="border:1px solid" cellpadding=0 cellspacing=1 bordercolor="black">
            <tr>
			<td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>Inspection Time</b></font></td>
            <td width=45px style=";background-color:#FFFFFF;"><span class="tabletext"><input type="text" align="right" name="insp_time_hrs" maxlength=2 style="width:50%;Border:none" size=3 value="<?php printf("%02d", $myrow['insp_time_hrs']); ?>"><b>:</b>
			<input type="text" name="insp_time_mins" maxlength=2 style=";Border:none" size=3 value="<?php printf("%02d",$myrow['insp_time_mins']); ?>">
             </table>
        </td>        
         </tr>
          </table>
         <table width=80% border=0 cellpadding=3 cellspacing=1>
         <tr>
         <td colspan=1>
            <table width=25% style="border:1px solid;cellsapcing:1px" cellpadding=0  bordercolor="black">
            <tr><td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>From Date</b></font>
            <input type="text" name="fromdate" size=12 value="<?php echo $myrow['from_date']?>" style=";background-color:#DDDDDD;" readonly="readonly"><img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('fromdate')"></td>
              <td style=";background-color:#DDDDDD;"><span class="tabletext"><font color="0000ff"><b>To Date</b></font>
                <input type="text" name="todate" size=12 value="<?php echo $myrow['to_date']?>" style=";background-color:#DDDDDD;" readonly="readonly"><img src="images/bu-getdateicon.gif" alt="Get Date" onclick="GetDate('todate')"></td>

            </table>
          </td>
         </tr>
        </table>


        <table width=80% style="border:1px solid" cellpadding=3 cellspacing=1 rows=all cols=all class="stdtable">

         <tr>
             <td width=1%><span class="tabletext"><i>Qty</i></td>
             <td rowspan=3><span class="tabletext"><i>Stage Details</i></td>
             <td width=1%><p align="center"><span class="tabletext"><i>Stages</i></p></td>
           <?php
              $i=1;
             while($i<=24)
             {
            ?>
            <td width=10% ><span class="labeltext"><p align="left"><?php echo $i ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></font></td>
            <?php
             $i++;
            }

?>       </tr>
         <tr>
         <td width=1%><span class="tabletext"><input type="text" name="qty" size=5 value="1" style=";background-color:#DDDDDD;" readonly="readonly"></td>
         <td width=1%><span class="labeltext1"><p align="center"><i>Setting Time</i></p></font></td>
       <?php
           $x=1;
           while($myrow1 = mysql_fetch_assoc($result1))
           {

                     $running_time1[] = $myrow1['running_time'];
                     $setting_time1[] = $myrow1['setting_time'];
                     $running_time_mins1[] = $myrow1['running_time_mins'];
                     $setting_time_mins1[] = $myrow1['setting_time_mins'];
                     $stage_cost1[] = $myrow1['cost'];
                     $stage_num[] = $myrow1['stage_num'];
           }

           while($x<=24)
           {

                $setting_time = 'setting_time' . $x;
                $setting_time_mins = 'setting_time_mins' . $x;
             ?>
             <td width=30px><span class="tabletext"><input type="text" name="<?php echo $setting_time ?>" style="width:50%;Border:none" maxlength=2 size=3 value="<?php if(isset($stage_num[0]))
                        {
                             $y = 0;
                             foreach($stage_num as $val)
                              {
                                 //echo $val. ' and ' . $x;
                                  if($val == $x)
                                  {
                                    //echo 'hi';
                                    if (isset($setting_time1[$y]))
                                    {
                                     printf("%02d", $setting_time1[$y]);
                                    }
                                    else if ($setting_time1[$y] == '')
                                  {
                                    //echo $y;
                                     printf("%02d","0");

                                  }
                                  }
                                  $y++;
                              }
                         }
             ?>"><b>:</b>
                                        <input type="text"  name="<?php echo $setting_time_mins ?>" style="width:50%;Border:none" maxlength=2 size=3 value="<?php if(isset($stage_num[0]))
                        {
                             $y = 0;
                             foreach($stage_num as $val)
                              {
                                 //echo $val. ' and ' . $x;
                                  if($val == $x)
                                  {
                                    //echo 'hi';
                                    if (isset($setting_time_mins1[$y]))
                                    {
                                      printf("%02d", $setting_time_mins1[$y]);
                                    }
                                    else if ($setting_time_mins1[$y] == '')
                                    {
                                      printf("%02d","0");

                                    }

                                  }
                                  $y++;
                              }
                         }
             ?>"></td>
           <?php
            $x++;
            }
            unset($setting_time1);
            unset($setting_time_mins1);
           ?>



          </tr><tr bgcolor="#FFFFFF">
		  <?
		  if($dept != 'PPC1')
		  {?>
         <td width=1%><span class="tabletext"><font color="339933"><i>Val/pc</i></font></td>
		 <?}else
		 {?>
			 <td width='1%'>&nbsp</td>
		 <?}?>
            <td width=1%><span class="labeltext1"><p align="center"><i>Running Time</i></p></font></td>
         <?php
           $x=1;
           while($x<=24)
           {
                $running_time = 'running_time' . $x;
                $running_time_mins = 'running_time_mins' . $x;
             ?>
             <td width=30px><span class="tabletext"><input type="text"  name="<?php echo $running_time ?>" style="width:50%;Border:none" maxlength=2 size=3 value="<?php if(isset($stage_num[0]))
                        {
                             $y = 0;
                             foreach($stage_num as $val)
                              {
                                 //echo $val. ' and ' . $x;
                                  if($val == $x)
                                  {
                                    //echo 'hi';
                                     if (isset($running_time1[$y]))
                                     {
                                       printf("%02d", $running_time1[$y]);

                                     }
                                     else
                                     {
                                       printf("%02d","0");
                                     }

                                  }
                                  $y++;
                              }
                         }
             ?>"><b>:</b>
                                        <input type="text"  name="<?php echo $running_time_mins ?>" style="width:50%;Border:none" maxlength=2 size=3 value="<?php if(isset($stage_num[0]))
                        {
                             $y = 0;
                             foreach($stage_num as $val)
                              {
                                 //echo $val. ' and ' . $x;
                                  if($val == $x)
                                  {
                                    //echo 'hi';
                                     if (isset($running_time_mins1[$y]))
                                     {
                                       printf("%02d", $running_time_mins1[$y]);

                                     }
                                     else
                                     {
                                       printf("%02d","0");
                                     }
                                  }
                                  $y++;
                              }
                         }
             ?>"></td>
        <?php
            $x++;
           }
           unset($running_time1);
           unset($running_time_mins1);
         ?></tr>

          <?
           if($dept != 'PPC1')
		  {?>			
			<tr bgcolor="#FFFFFF">			
            <td width=1%><span class="tabletext"><input type="text" name="valperpart" size=5  value="<?php echo $myrow['val_per_part'] ?>"></td>			
       <?php
            print('<td width=1% style="border:0px">&nbsp;</td>');
            print('<td width=1%><span class="labeltext1"><p align="center"><font color="339933"><i>Stage Cost</i></font></p></td>');

            $x=1;
            while($x<=24)
            {
              $stage_cost = 'stage_cost' . $x;
             ?>
               <td><span class="tabletext"><input type="text" name="<?php echo $stage_cost ?>"  size=3 value="<?php if(isset($stage_num[0]))
                        {
                             $y = 0;
                             foreach($stage_num as $val)
                              {
                                 //echo $val. ' and ' . $x;
                                  if($val == $x)
                                  {
                                    //echo 'hi';
                                    echo $stage_cost1[$y];

                                  }
                                  $y++;
                              }
                         }
  ?>">
                                        </td>
             <?php
            $x++;
           }?>
		</tr>
		<?}
		/*
		else
		{?>
 <tr bgcolor="#FFFFFF">
 <td width=1%>&nbsp;</td>
 <td width=1%>&nbsp;</td>
<td width=1%><span class="labeltext1"><p align="center">&nbsp;</p></td>
<td colspan=24 >&nbsp;</td>

 </tr>
<?}*/?>
      <tr bgcolor="#99FFFF" height=10px><td  border="0" colspan=27 ><span class="heading"></td></tr>

        </table>
		
	</td>
    </tr>

</table>

</td>
<!-- 		<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr> -->

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
