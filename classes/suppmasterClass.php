<?php
//====================================
// Author: FSI
// Date-written = Dec 18, 2017
// Filename: suppmasterClass.php
// Maintains the class for review
// Revision: v1.0  WMS
//====================================
include_once('classes/loginClass.php');
class suppmaster {
	var $supplier,
			$vendrecnum,
			$ctname,
			$ctemail,
			$scope,
			$methodtype,
			$extent_control,
			$inspyear,
			$risk_involve,
			$status,
			$approved,
			$approved_by,
			$approved_date,
			$created_date,
			$created_by,
			$modified_by,
			$modified_date;

	function suppmaster()
	{
		$this->supplier = '';
		$this->vendrecnum = '';

		$this->ctname = '';
		$this->ctemail = '';
		$this->scope = '';
		$this->methodtype = '';

		$this->extent_control = '';
		$this->inspyear = '';

		$this->risk_involve = '';
		$this->status = '';
		$this->approved = '';
		$this->approved_by = '';

		$this->approved_date = '';
		$this->created_date = '';

		$this->created_by = '';
		$this->modified_by = '';

		$this->modified_date = '';
		
	}


	public function setsupplier($supplier)
	{
		$this->supplier = $supplier;

	}

	public function setvendrecnum($vendrecnum)
	{
		$this->vendrecnum = $vendrecnum;

	}

	public function setctname($ctname)
	{
		$this->ctname = $ctname;

	}

	public function setctemail($ctemail)
	{
		$this->ctemail = $ctemail;

	}

	public function setscope($scope)
	{
		$this->scope = $scope;

	}
	public function setmethodtype($methodtype)
	{
		$this->methodtype = $methodtype;

	}

	public function setextent_control($extent_control)
	{
		$this->extent_control = $extent_control;

	}
	public function setinspyear($inspyear)
	{
		$this->inspyear = $inspyear;

	}
	public function setrisk_involve($risk_involve)
	{
		$this->risk_involve = $risk_involve;

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

	public function setcreated_by($created_by)
	{
		$this->created_by = $created_by;
	}

	public function setcreated_date($created_date)
	{
		$this->created_date = $created_date;
	}

	public function setmodified_by($modified_by)
	{
		$this->modified_by = $modified_by;
	}

	public function setmodified_date($modified_date)
	{
		$this->modified_date = $modified_date;
	}

	public function AddSuppMaster()
	{
		$newlogin = new userlogin;
    $newlogin->dbconnect();


    $sql = "select count(*) as numrows from suppmaster 
    				where link2supplier = $vendrecnum and status= 'Approved'";
    $result = mysql_query($sql);
    $myrow = mysql_fetch_assoc($result);

    $supplier = "'" . $this->supplier . "'";
    $vendrecnum =  $this->vendrecnum ;
    $ctname = "'" . $this->ctname . "'";
    $ctemail = "'" . $this->ctemail . "'";
    $scope = "'" . $this->scope . "'";
    $methodtype = "'" . $this->methodtype . "'";
    $extent_control = "'" . $this->extent_control . "'";
    $inspyear = "'" . $this->inspyear . "'";
    $risk_involve = "'" . $this->risk_involve . "'";
    $status = "Pending";
    $userid = $_SESSION['userid'];
    $created_by = "'" . $userid . "'";

   	if ($myrow['numrows'] == 0) {
    	
    	$sql1 = "insert into suppmaster
    					(supplier,link2supplier,contact_person,contact_email,scope_approval,method_type,
    						extent_control,inspection_year,risk_involve,status,created_by,create_date) values
    					($supplier,$vendrecnum,$ctname,$ctemail,$scope,$methodtype,$extent_control,
    						$inspyear,risk_involve,'$status',$created_by,NOW())";
    	// echo "$sql1 <br>";
    	$result1 = mysql_query($sql1);
    	if(!$result1){
    		die("Insert to RM Master didn't work..Please report to Sysadmin. " . mysql_error());
    	}else{
    		$id = mysql_insert_id();
    		return $id;	
    	} 
    	
    }else{
    	echo "<table border=1><tr><td><font color=#FF0000>";
      die( $supplier . " Already Exists ");
      echo "</td></tr></table>";
    }


	}

	public function GetAllSuppMaster($cond, $argoffset,$arglimit)
	{
		$offset = $argoffset;
    $limit = $arglimit;

    $newlogin = new userlogin;
    $newlogin->dbconnect();

    $sql = "select s.recnum,s.supplier,s.link2supplier,s.contact_person,s.contact_email,s.scope_approval,
    							 s.method_type,s.extent_control,s.inspection_year,s.status,s.approved,
    							 s.approved_by,s.approved_date,c.name,c.addr1,c.addr2,c.city,c.state,c.zipcode
    				from suppmaster s, company c
    				where c.recnum = s.link2supplier and $cond
    				order by recnum 
    				limit $offset, $limit";
    // echo "$sql <br>";
    $result = mysql_query($sql);
    return $result;

	}

	public function GetSuppmasterCount()
	{
		$newlogin = new userlogin;
    $newlogin->dbconnect();

    $sql = "select count(*) as numrows
    				from suppmaster";
    $result  = mysql_query($sql);
    if (!$result) {
     	die('RM Master count query failed');	
     }
     else{
     	$result = mysql_query($sql);
     	$myrow = mysql_fetch_assoc($result);
     	$numrows = $myrow['numrows'];
     	return $numrows;
     } 
     
	}

	public function GetSuppMasterDetails($recnum)
	{
		
    $newlogin = new userlogin;
    $newlogin->dbconnect();

    $sql = "select s.recnum,s.supplier,s.link2supplier,s.contact_person,s.contact_email,s.scope_approval,
    							 s.method_type,s.extent_control,s.inspection_year,s.status,s.approved,
    							 s.approved_by,s.approved_date,c.name,c.addr1,c.addr2,c.city,c.state,c.zipcode,
    							 s.risk_involve
    				from suppmaster s, company c
    				where c.recnum = s.link2supplier and 
    							s.recnum = $recnum";
    // echo "$sql <br>";
    $result = mysql_query($sql);
    return $result;

	}

	public function UpdateSuppMaster($recnum)
	{
		$newlogin = new userlogin;
    $newlogin->dbconnect();

    $supplier = "'" . $this->supplier . "'";
    $vendrecnum =  $this->vendrecnum ;
    $ctname = "'" . $this->ctname . "'";
    $ctemail = "'" . $this->ctemail . "'";
    $scope = "'" . $this->scope . "'";
    $methodtype = "'" . $this->methodtype . "'";
    $extent_control = "'" . $this->extent_control . "'";
    $inspyear = "'" . $this->inspyear . "'";
    $risk_involve = "'" . $this->risk_involve . "'";
    $status = "'" . $this->status . "'";
    $approved = "'" . $this->approved . "'";
    $approved_by = "'" . $this->approved_by . "'";
    $approved_date = "'" . $this->approved_date . "'";
    $userid = $_SESSION['userid'];
    $created_by = "'" . $userid . "'";

    $sql = "update suppmaster set
		    				supplier = $supplier,
		    				link2supplier = $vendrecnum,
		    				contact_person = $ctname,
		    				contact_email = $ctemail,
		    				scope_approval = $scope,
		    				method_type = $methodtype,
		    				extent_control = $extent_control,
		    				risk_involve = $risk_involve,
		    				status = $status,
		    				approved = $approved,
		    				approved_by = $approved_by,
		    				approved_date = $approved_date,
		    				modified_by = '$userid',
		    				modified_date = NOW()
		    		where recnum = $recnum";
		// echo "$sql <br>"; exit;
		$result = mysql_query($sql);
    return $result;

	}

}

?>