<?php 

	
	session_start();
	header("Cache-control: private");

	if ( !isset ( $_SESSION['user'] ) )
	{
	  header ( "Location: login.php" );
	}

	$userid = $_SESSION['user'];

	include_once('classes/ResourcePlanningClass.php');
	include_once('classes/ResourceRequirementClass.php');
	$newRP = new ResourcePlanning;
	$newRr = new ResourceRequirement;


	$type = $_REQUEST['type'];

	if ($type == "fetch") 
	{

		$firstday = $_REQUEST['firstday'];
		$lastday = $_REQUEST['lastday'];
		$cid=$_REQUEST['cid'];

		// echo "<pre>";
		// print_r($firstday); 
		$resp=array();
		$events = array();
		$events1=array();

		$result=$newRP->getSchduleMonth($firstday,$lastday,$cid);
		$requirement=$newRr->getResourceUploadDetailsMonth($cid,$firstday,$lastday);

		$prevdate = "";
		$prevshift = "";
		$i = 1;
		while ($myevent = mysql_fetch_assoc($result))
		{
			
			if ($prevdate != $myevent['start']) {
				$events[$myevent['start']]['start'] = $myevent['start'];
				$events[$myevent['start']]['shift'][$myevent['shift']] =  $myevent['numrows'];
				
				$stdate = $myevent['start'];
				
			}
			else{
				$events[$stdate]['shift'][$myevent['shift']] =  $myevent['numrows'];

			}
			$prevdate = $myevent['start'];
			$i++;
		}
		$prevdate1 = "";
		$prevshift1 = "";
		$i = 1;
		while ($myevent = mysql_fetch_assoc($requirement))
		{
			
			if ($prevdate1 != $myevent['date']) {
				$events1[$myevent['date']]['start'] = $myevent['date'];
				$events1[$myevent['date']]['shift'][$myevent['shift']] =  $myevent['requirement'];

				$stdate1 = $myevent['date'];
				
			}
			else{
				$events1[$stdate1]['shift'][$myevent['shift']] =  $myevent['requirement'];
			}
			$prevdate1 = $myevent['date'];
			$i++;
		}

		foreach ($events1 as $key => $value) {
			if(!array_key_exists ( $key ,  $events ))
			{
				$events[$key]['start']=$key;
				$events[$key]['shift']= array();
			}
			$events[$key]['requirements']=$value['shift'];
		}
		foreach ($events as $key => $value) {
			if(!$events[$key]['requirements']) $events[$key]['requirements']= array();
			if(!$events[$key]['shift']) $events[$key]['shift']=array();
		}
		echo json_encode($events);
	}

	if ($type == "getevent") 
	{
		$date = $_REQUEST['date'];
		$cid=$_REQUEST['cid'];
		$result = $newRP->getSchduleDay($date,$cid);
		$details = array();

		echo "<table class=\"table table-striped tableBodyScroll\">";
		echo "<thead style=\"display:table;width:100%;\">";
		echo "<tr>";
		echo "<td><span class=\"heading\">Empid </span></td>";
		echo "<td><span class=\"heading\">Name </span></td>";
		echo "<td><span class=\"heading\">Subsidiary </span></td>";
		echo "<td><span class=\"heading\"> Day </span></td>";
		echo "<td><span class=\"heading\"> Day Night </span></td>";
		echo "<td><span class=\"heading\"> Night </span></td>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody style=\"display:block; max-height:300px; overflow-y:scroll; width:100%;table-layout:fixed;\">";
		while ($myrows = mysql_fetch_assoc($result))
		{	
			$details[] = $myrows;

			echo "<tr class=\"tralign\">";
			echo "<td><span class=\"tabletext\">".$myrows['empid']."</span></td>";
			echo "<td><span class=\"tabletext\">".$myrows['fname']."</span></td>";
			echo "<td><span class=\"tabletext\">".$myrows['subsidary']."</span></td>";

			if ($myrows['shift'] == "day") {
				echo "<td><span class=\"tabletext\"><center><img src=\"assets/img/tick-dark-16.png\"></center></span></td>";
			}
			else
			{
				echo "<td><span class=\"tabletext\"></span></td>";
			}

			if ($myrows['shift'] == "day night") {
				echo "<td><span class=\"tabletext\"><center><img src=\"assets/img/tick-dark-16.png\"></center></span></td>";
			}
			else
			{
				echo "<td><span class=\"tabletext\"></span></td>";
			}

			if ($myrows['shift'] == "night") {
				echo "<td><span class=\"tabletext\"><center><img src=\"assets/img/tick-dark-16.png\"></center></span></td>";
			}
			else
			{echo "<td><span class=\"tabletext\"></span></td>";
				
			}

			echo "</tr>";
		}
		echo "</tbody>";
		// echo json_encode($details);

	}


	if ($type == "addevent") 
	{


		echo "<form name=\"EventForm\" id=\"EventForm\" class=\"EventForm\">";
		echo "<table width=100% align='center' border=1 cellpadding=4 cellspacing=1 bgcolor=\"#DFDEDF\" class=\"stdtable1\">
		        <tr bgcolor='#B0C4DE' >
			        <td width=20%><span class=\"pageheading\"><b>New Schdule</b></td>
		        </tr>";

		echo "</table>";

		echo "<table width=100% align='center' border=1 cellpadding=4 cellspacing=1 bgcolor=\"#DFDEDF\" class=\"stdtable1\">";

		echo "<tr bgcolor='#FFFFFF'>
				    <td ><span class=\"labeltext\"><p align=\"left\">Shift Date</p></font></td>
				    <td><input type=\"text\"  name=\"shiftdate\" id=\"shiftdate\" readonly size=15 value=\"\"></td>
				  <tr>";

		echo "<tr bgcolor='#FFFFFF'>
				    <td ><span class=\"labeltext\"><p align=\"left\">Shift </p></font></td>
				    <td><span class=\"labeltext\"><select name=\"shift\" id=\"shift\">
				    		<option value=\"day\">Day</option>
				    		<option value=\"day night\">Day Night</option>
				    		<option value=\"night\">Night</option>
				    </select></span></td>
				  <tr>";

		echo "<tr bgcolor='#FFFFFF'>
				    <td ><span class=\"labeltext\"><p align=\"left\">Subsidiary Company </p></font></td>
				    <td><input type=\"text\" name=\"secondary_company\" id=\"secondary_company\"  size=15 value=\"\" readonly=\"readonly\">
						<button type=\"button\" class=\"btn btn-secondary btn-sm\" onclick=\"GetContractCompanies()\">Get</button>
						<input type=\"hidden\" id=\"custrecnum\" name=\"custrecnum\" value =\"\" >
						</td>
				  <tr>";

		echo "<tr bgcolor='#FFFFFF'>
				    <td ><span class=\"labeltext\"><p align=\"left\">Employee </p></font></td>
				    <td><input type=\"text\" name=\"empname\" id=\"empname\"  size=15 value=\"\" readonly=\"readonly\">
						<button type=\"button\" class=\"btn btn-secondary btn-sm\" onclick=\"GetEmployeeUnderSubsidiary()\">Get</button>
						<input type=\"hidden\" id=\"empid\" name=\"empid\" value =\"\" >
						</td>
				  <tr>";

    echo "</table>";
	  
		echo "</form>";
		// echo json_encode($details);

	}

	if ($type == "SubmitSchevent") {
		
		$shiftdate = $_REQUEST['shiftdate'];
		$shift = $_REQUEST['shift'];
		// $userrecnum = $_REQUEST['userrecnum'];
		$empid = $_REQUEST['empid'];
		$custrecnum = $_REQUEST['custrecnum'];
		$siteid = $_SESSION['siteid'];
		$uploadtype = 'manual';
		

		// $empid = $newRP->getEmpid($userrecnum);
		$sudsidaryid = $custrecnum;

		$newRP->setempid($empid);
    $newRP->setsubsidaryid($sudsidaryid);
    $newRP->setsiteid($siteid);
    // $newRP->setlink2user($userrecnum);
    $newRP->setshift($shift);
		$newRP->setshiftdate($shiftdate);
		$newRP->setuploadtype($uploadtype);

		$result = $newRP->UploadReourceSchdule();
		echo  $result; exit;
		



	}


?>