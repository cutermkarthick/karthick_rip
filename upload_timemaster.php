<?php
//==============================================
// Author: FSI                                 =
// Date-written = August 19, 2012                =
// Filename: processmc_master.php              =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Upload Time Master                =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

include('classes/mc_masterClass.php');

// Next, create an instance of the classes required
$newmc_master = new mc_master;


// Read the time master input file
$tminp = "tmentrycsv_usethis1.csv";
$tmfh = fopen($tminp, 'r');
while (!feof ($tmfh)) 
{ 
   $tminpline = fgets($tmfh); 
   $fields = explode(",", $tminpline);
   //var_dump($fields);


    $crn_num = $fields[0];
	$mps_revision = $fields[1];
	if ($mps_revision == '')
	{
         $mps_revision = '00';
	}
    $qty = 1;

   echo "<br>";
   print "<br>crn is $fields[0]";
   print "<br>mps rev is $fields[1]";



    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $result = mysql_query($sql);

    $newmc_master->setcrn_num($crn_num);
    $newmc_master->setqty($qty);
    $newmc_master->setmps_revision($mps_revision);
	$newmc_master->setfromdate("2012-08-01");
	$newmc_master->settodate("2012-08-31");
  
	$sql = "start transaction";
    $mc_masterrecnum = $newmc_master->addmc_master();
    $link2mc_master = $mc_masterrecnum;


// Insert setup time first
	for($i=2;$i<=18;$i++)
    {
		$stage_num = $i - 2 + 1;
        $i++;

	     $running_time  = $fields[$i];
		 if ($running_time != 0 && $running_time != '' && $running_time > 60)
		{
		     $running_time1 = (int) ($running_time / 60);
			 $running_time_mins1 = $running_time % 60;
	     }
		 else
		{
		     $running_time1 = 0;
			 $running_time_mins1 = $running_time;
	     }

		 if ($running_time != 0 && $running_time != '')
		 {
		        $setting_time1 = '1';
			    $setting_time_mins1 = '00';
		 }
         else
		 {
		       $setting_time1 = '0';
			    $setting_time_mins1 = '00';
		  }

         $stage_cost1 = 0;
   
        print "<br>Stage num is $stage_num";
        print "<br>Setting time is $setting_time1";
        print "<br>Setting time mins is $setting_time_mins1";
        print "<br>Running time is $running_time1";
        print "<br>Running time mins is $running_time_mins1";
		print "<br>========================================================================";

   
	     $newmc_master->setrunning_time($running_time1);
	     $newmc_master->setsetting_time($setting_time1);
	     $newmc_master->setrunning_time_mins($running_time_mins1);
	     $newmc_master->setsetting_time_mins($setting_time_mins1);
         $newmc_master->setstage_cost($stage_cost1);
  	     $newmc_master->setstage_num($stage_num);
         $newmc_master->setlink2mc_master($link2mc_master);
         $newmc_master->addstage_data();
	
	}

}
	fclose ($tmfh);

?>
