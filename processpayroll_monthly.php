<?php 

	session_start();
	header("Cache-control: private");

	include_once('classes/payrollmonthlyClass.php');
	$newpayroll = new payroll_monthly;

  	if ($_POST) 
  	{
  		
	  	$id = $_POST['emp_id'];
	  	$hrs_worked = $_POST['hrswork'];
	  	$ot = $_POST['ot'];
	  	$gross_salary = $_POST['gross_salary'];
	  	$tds = $_POST['tds'];
	  	$net_salary = $_POST['net_salary'];
	  	$date = $_POST['date'];
	  	$pagename = $_POST['pagename'];
	  	$masterrecnum = $_REQUEST['link2paymaster'];

	  	if ($pagename == 'newpayroll_monthly' )
		{
			$newpayroll->setid($id);
			$newpayroll->sethrs_worked($hrs_worked);
			$newpayroll->setot($ot);
			$newpayroll->setgross_salary($gross_salary);
			$newpayroll->settds($tds);
			$newpayroll->setnet_salary($net_salary);
			$newpayroll->setdate($date);
			$newpayroll->setlink2paymaster($masterrecnum);
			
			$recnum = $newpayroll->addnewpayroll_monthly();

		}
		else if ($pagename == 'editpayroll_master' )
		{
			$newpayroll->setname($name);
			$newpayroll->setid($id);
			$newpayroll->setbasic($basic);
			$newpayroll->sethra($hra);
			$newpayroll->setsa($sa);
			$newpayroll->setta($ta);
			$newpayroll->setincrement($increment);
			$newpayroll->setjoin_date($join_date);
			
			// echo "<pre>";
			// print_r($_POST);
			$newpayroll->updatepayroll_master($payrecnum);

		}

		header("Location: payrollmonthly_Summary.php");
	}
  	else
  	{	
        
  		$empid = $_REQUEST['empid'];
		$month = $_REQUEST['month'];
		$year = $_REQUEST['year'];

		$result = $newpayroll->getpayroll_master($empid, $month, $year);
  		$myrow = mysql_fetch_assoc($result);
  		
  		$monthly_salary = $myrow['basic_salary'] + $myrow['hra'] + $myrow['ta'] + $myrow['ta'] +  $myrow['increment'] ;


  		$result_payroll_trans = $newpayroll->getpayroll_trans_monthly_details($empid,$month,$year);

  		$days_arr = array();
  		$month_arr = array();
  		$prev_date = '';
        $prev_status = 1;
  		$i = 0;
  		$j = 0;
  		$k = 0;
  		while ($myptli = mysql_fetch_row($result_payroll_trans)) 
        {       
        	$date_split = explode(' ', $myptli[2]);
        	$date = $date_split[0];

        	if ($prev_date != $date) 
        	{
        		
        		if ($myptli[4] == 1) {
        			$i++;
        			$month_arr[$date][$i] = array('checkin' => $myptli[2],'checkout' => '', 'break' => '', 'hrs_worked' =>'')	;
        		}
        		else if($myptli[4] == 0){

        		}
        		else if($myptli[4] == 2){

        		}
        	}
        	else
        	{	
        		
        		if ($myptli[4] == 1) {
        			$month_arr[$date][$i]['checkin'] = $myptli[2];
        		}
        		if($myptli[4] == 0){
                    if ($prev_status != 2) 
                    {
                        $month_arr[$date][$i]['checkout'] = $myptli[2];
                        $checkin_dt = $month_arr[$date][$i]['checkin'];

                        $datetime1 = new DateTime($checkin_dt);
                        $datetime2 = new DateTime($myptli[2]);
                        $interval = $datetime1->diff($datetime2);
                        $elapsed = $interval->format('%h|%i|%s');
                        $month_arr[$date][$i]['hrs_worked'] = $elapsed;
                        $month_arr[$date][$i]['checkin'] = $month_arr[$date][$i]['checkin'];
                        
                    }
                    else
                    {   
                        $month_arr[$date][$i]['checkout'] = $myptli[2];
                        $month_arr[$date][$i]['break'] = $month_arr[$date][$i]['break'];
                        $elapsed = '0|0|0';
                        $month_arr[$date][$i]['hrs_worked'] = $elapsed;
                    }
        			
        			$i++;
        		}
        		else if($myptli[4] == 2){
        			$month_arr[$date][$i]['break'] = $myptli[2];
        			$checkin_dt = $month_arr[$date][$i]['checkin'];

        			$datetime1 = new DateTime($checkin_dt);
					$datetime2 = new DateTime($myptli[2]);
					$interval = $datetime1->diff($datetime2);
					$elapsed = $interval->format('%h|%i|%s');
                    $month_arr[$date][$i]['hrs_worked'] = $elapsed;
					
        			$i++;
        		}

        	}

        	$prev_date = $date;
            $prev_status = $myptli[4];
        	$j++;
        }

        $totalhrs = 0;
        $totalsec_mins = 0;
        foreach ($month_arr as $dkey => $daysval) {
        	
        	foreach ($daysval as $key => $value) {
        		$hrs_worked_split = explode('|', $value['hrs_worked']);
        		$hrs = $hrs_worked_split[0];
        		$mins = $hrs_worked_split[1];
        		$secs = $hrs_worked_split[2];

        		$min2sec = ($mins * 60) + $secs;
        		$totalsec_mins += $min2sec;
        		$totalhrs += $hrs;
        	}
        }

        $totalsecs = $totalsec_mins;
		$hours = floor($totalsecs / 3600);
		$minutes = floor(($totalsecs / 60) % 60);
		$seconds = $totalsecs % 60;

		$hours_worked = $totalhrs + $hours;
		$mins_worked = $minutes;
		$secs_worked = $seconds;

        // echo "<br>total hrs $totalhrs <br>";
        // echo "total sec $totalsec_mins <br>";
        // echo "hours_worked  $hours_worked <br>";
        // echo "mins_worked  $mins_worked <br>";
        // echo "secs_worked  $secs_worked <br>";
        // echo "monthly_salary  $monthly_salary <br>";
        // echo "<pre>";
        // print_r($month_arr);
        // echo "inside get"; exit;
        


        $monthly_working_hrs = 168;
        $ot = 0;
        $tds = 0;
        $gross_salary = (($monthly_salary/$monthly_working_hrs) * ($hours_worked + $ot));
        $net_salary  = ($gross_salary - $tds);
        $date = date('Y-m-d');

        $newpayroll->setid($empid);
		$newpayroll->sethrs_worked($hours_worked);
		$newpayroll->setot($ot);
		$newpayroll->setgross_salary($gross_salary);
		$newpayroll->settds($tds);
		$newpayroll->setnet_salary($net_salary);
		$newpayroll->setdate($date);

		$check_payroll_monthly = $newpayroll->check_payroll_monthly($empid,$month,$year);

		$numrows = mysql_num_rows($check_payroll_monthly);
		
		if ($numrows == 0) {
			$recnum = $newpayroll->addnewpayroll_monthly();
		}
		else{
			$recnum = $newpayroll->updatepayroll_monthly($empid,$month,$year);
		}

		

		header("Location: payrollmonthly_Details.php?empid=$empid&month=$month&year=$year");
		
  	}	

	
?>