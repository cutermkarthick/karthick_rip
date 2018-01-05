<?

include_once('loginClass.php');
class empconfig { 
	var $company,
		$companyrecnum,
		$shift_group,
		$start_hour,
		$start_min,
		$end_hour,
		$end_min,
		$userrecnum;

	function empconfig() { 
		$this->company = "";
		$this->companyrecnum = "";
		$this->shift_group = "";
		$this->start_hour = "";
		$this->start_min = "";
		$this->end_hour = "";
		$this->end_min = "";
	}

	public function setcompany($company)
	{	
	  	$this->company = $company;
	}

	public function setcompanyrecnum($companyrecnum)
	{	
		$this->companyrecnum = $companyrecnum;
	}

	public function setshift_group($shift_group)
	{	
		$this->shift_group = $shift_group;
	}

	public function setstart_hour($start_hour)
	{	
		$this->start_hour = $start_hour;
	}

	public function setstart_min($start_min)
	{	
		$this->start_min = $start_min;
	}

	public function setend_hour($end_hour)
	{	
		$this->end_hour = $end_hour;
	}

	public function setend_min($end_min)
	{	
		$this->end_min = $end_min;
	}

	public function addEmpConfig()
	{
		$newlogin = new userlogin;
       	$newlogin->dbconnect();

       	$shift_group = "'". $this->shift_group ."'";
       	$start_hour = "'". $this->start_hour ."'";
       	$start_min = "'". $this->start_min ."'";
       	$end_hour = "'". $this->end_hour ."'";
       	$end_min = "'". $this->end_min ."'";
       	$companyrecnum = "'". $this->companyrecnum ."'";
       	$created_by = "'" . $_SESSION['user'] ."'";

       	$company = $this->company;

       	$sql = "select * from employee_config 
       	 		where link2company = $companyrecnum and
       	 		 		shift = $shift_group";
       	// echo "$sql <br>"; exit;
       	$result = mysql_query($sql);
       	if (!(mysql_fetch_row($result))) {
       		 $sql1 = "INSERT INTO employee_config(
       		 						shift,
       		 						start_hour,
       		 						start_min,
       		 						end_hour,
       		 						end_min,
       		 						link2company,
       		 						status,
       		 						created_date,
       		 						created_by
       		 					 ) 
       		 			VALUES(
       		 						$shift_group,
       		 						$start_hour,
       		 						$start_min,
       		 						$end_hour,
       		 						$end_min,
       		 						$companyrecnum,
       		 						'Active',
       		 						NOW(),
       		 						$created_by) ";
       		
       		$result1 = mysql_query($sql1);
       		if(!$result1) die("Insert to Employee didn't work. " . mysql_error());

       	}
       	else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Company " . $company . " and Shfit ". $shift_group ." already exists. ");
            echo "</td></tr></table>";
         }
	}

	public function getEmpConfig4sa()
	{
		$newlogin = new userlogin;
       	$newlogin->dbconnect();

       	$sql = "select e.recnum,
       				   e.shift,
       				   e.start_hour,
       				   e.start_min,
       				   e.end_hour,
       				   e.end_min,
       				   c.name
       			from employee_config e, company c
       			where c.recnum = e.link2company";
       	// echo "$sql";;
       	$result = mysql_query($sql);
       	return $result;
	}
	public function getEmpConfig_details($recnum)
	{
		$newlogin = new userlogin;
       	$newlogin->dbconnect();

       	$sql = "select e.recnum,
       				   e.shift,
       				   e.start_hour,
       				   e.start_min,
       				   e.end_hour,
       				   e.end_min,
       				   c.name,
       				   e.link2company
       			from employee_config e, company c
       			where c.recnum = e.link2company and
       				  e.recnum=$recnum";
       	// echo "$sql";;
       	$result = mysql_query($sql);
       	return $result;
	}

	public function UpdateEmpConfig($recnum)
	{
		$newlogin = new userlogin;
       	$newlogin->dbconnect();

       	$start_hour = "'". $this->start_hour ."'";
       	$start_min = "'". $this->start_min ."'";
       	$end_hour = "'". $this->end_hour ."'";
       	$end_min = "'". $this->end_min ."'";

       	$sql = "update employee_config set
       					start_hour=$start_hour,
       					start_min=$start_min,
       					end_hour=$end_hour,
       					end_min=$end_min
       			where recnum = $recnum";
       	// echo "$sql"; exit;
       	$result = mysql_query($sql);
       	return $result;

	}
}

?>