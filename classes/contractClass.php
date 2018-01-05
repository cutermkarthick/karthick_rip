<?php 

/**
* 
*/
include_once('loginClass.php');

class contract
{
	var $companyname,
			$start_date,
			$end_date,
			$status,
			$approved,
			$approved_by,
			$approved_date;

	function contract()
	{
		$this->companyname = '';
		$this->start_date = '';
		$this->end_date = '';
		$this->status = '';
		$this->approved = '';
		$this->approved_by = '';
		$this->approved_date = '';
	}

	public function setcompanyname($companyname)
	{
		$this->companyname = $companyname;
	}

	public function setstart_date($start_date)
	{
		$this->start_date = $start_date;
	}

	public function setend_date($end_date)
	{
		$this->end_date = $end_date;
	}

	public function setstatus($status)
	{
		$this->status = $status;
	}

	public function setapproved($approved)
	{
		$this->approved = $approved;
	}

	public function setapproved_by($approved_by)
	{
		$this->approved_by = $approved_by;
	}

	public function setapproved_date($approved_date)
	{
		$this->approved_date = $approved_date;
	}

	public function AddContract()
	{
		$newlogin = new userlogin;
   	$newlogin->dbconnect();

   	$sql = "select nxtnum from seqnum where tablename = 'contract'";
   	$result = mysql_query($sql);
    if(!$result) die("Seqnum access for Company didn't work. " . mysql_error());

    $myrow = mysql_fetch_row($result);
    $seqnum = $myrow[0];
    $objid = $seqnum + 1;
    $id = "'" . "CR" . $objid . "'";

    $sql = "select * from company where id = $id";
    $result = mysql_query($sql);

    $companyname = "'" . $this->companyname . "'";
    $start_date = "'" . $this->start_date . "'";
    $end_date = "'" . $this->end_date . "'";
    $userid = "'" . $_SESSION['user'] . "'";

    if (!(mysql_fetch_row($result))) {
    	$sql = "insert into contract(
    							name,
    							id,
    							start_date,
    							end_date,
    							status,
    							created_by,
    							created_date)
    					values(
    							$companyname,
    							$id,
    							$start_date,
    							$end_date,
    							'Pending',
    							$userid,
    							NOW())";

    	$result = mysql_query($sql);
    	if (!$result) {
    		die("Insert Contract  didn't work. " . mysql_error());
    	}else{
    		$insertid = mysql_insert_id();
    		
    	}

    }
    else{
    	echo "<table border=1><tr><td><font color=#FF0000>";
      die("Contract Id " . $id . " already exists. ");
      echo "</td></tr></table>";
    }

    $sql = "update seqnum set nxtnum = $objid where tablename = 'contract'";
   	$result = mysql_query($sql);
   	if(!$result) die("Seqnum update for Contract didn't work. " . mysql_error());	

   	return $insertid;
	}

	public function getContracts()
	{
		$newlogin = new userlogin;
   	$newlogin->dbconnect();

   	$sql = "select recnum,
   								 name,
   								 id,
   								 status,
   								 start_date,
   								 end_date,
   								 created_by,
   								 created_date,
   								 modified_by,
   								 modified_date,
   								 approved,
   								 approved_by,
   								 approved_date
   					from contract
   					order by recnum desc";
   	$result = mysql_query($sql);
   	return $result;
	}

	public function getContractDetails($recnum)
	{
		$newlogin = new userlogin;
   	$newlogin->dbconnect();

   	$sql = "select recnum,
   								 name,
   								 id,
   								 status,
   								 start_date,
   								 end_date,
   								 created_by,
   								 created_date,
   								 modified_by,
   								 modified_date,
   								 approved,
   								 approved_by,
   								 approved_date
   					from contract
   					where recnum = $recnum";
   	$result = mysql_query($sql);
   	return $result;
	}

	public function UpdateContract($recnum)
	{
		$newlogin = new userlogin;
   	$newlogin->dbconnect();

   	$companyname = "'" . $this->companyname . "'";
    $start_date = "'" . $this->start_date . "'";
    $end_date = "'" . $this->end_date . "'";
    $status = "'" . $this->status . "'";
    $approved = "'" . $this->approved . "'";
    $approved_by = "'" . $this->approved_by . "'";
    $approved_date = "'" . $this->approved_date . "'";
    $userid = "'" . $_SESSION['user'] . "'";

   	$sql = "update contract set
   								name = $companyname,
   								start_date = $start_date,
   								end_date = $end_date,
   								status = $status,
   								approved = $approved,
   								approved_by = $approved_by,
   								approved_date = $approved_date,
   								modified_by = $userid,
   								modified_date = NOW()
   					where recnum = $recnum";
   	// echo "$sql <br>"; exit;
   	$result = mysql_query($sql);
   	return $result;
	}

}

?>