<?
//====================================
// Author: FSI
// Date-written = Dec 27, 2017
// Filename: menuClass.php
// Maintains the class for Assypo Line items
// Revision: v1.0
//====================================

include_once('loginClass.php');

class menu {
	var $dept,
			$userrole,
			$menus,
			$status,
			$siteid,
			$created_by,
			$created_date,
			$modified_by,
			$modified_date;
	function menu()
	{
		$this->dept = "";
		$this->userrole = "";
		$this->menus = "";
		$this->status = "";
		$this->siteid = "";
		$this->created_by = "";
		$this->created_date = "";
		$this->modified_by = "";
		$this->modified_date = "";
	}

	public function setdept($dept)
	{
		$this->dept = $dept;
	}

	public function setuserrole($userrole)
	{
		$this->userrole = $userrole;
	}

	public function setmenus($menus)
	{
		$this->menus = $menus;
	}

	public function setcreated_by($created_by)
	{
		$this->created_by = $created_by;
	}

	public function GetMenus4Dept($dept,$userrole)
	{
		$newlogin = new userlogin;
    $newlogin->dbconnect();

    $sql = "select recnum,dept,userrole,menus,status,siteid
    				from menu
    				where dept = '$dept'";
   	// echo "$sql <br>"; exit;
    $result = mysql_query($sql);
    return $result;

	}

	public function GetAllMenus()
	{
		$newlogin = new userlogin;
    $newlogin->dbconnect();

    $sql = "select recnum,dept,userrole,menus,status,siteid,
    								created_by,created_date
    				from menu
    				where status = 'Active'
    				order by recnum asc";

    $result = mysql_query($sql);
    return $result;
	}

	public function AddMenus4Dept()
	{
		$newlogin = new userlogin;
    $newlogin->dbconnect();

    $dept = "'" .$this->dept ."'";
    $userrole = "'" .$this->userrole ."'";
    $menus = "'" .$this->menus ."'";
    $status = "'" .$this->status ."'";
    $created_by = "'" .$this->created_by ."'";
    $created_date = "'" .$this->created_date ."'";
    $modified_by = "'" .$this->modified_by ."'";
    $modified_date = "'" .$this->modified_date ."'";

    $sql = "select recnum,dept,userrole,status,siteid
    				from menu
    				where dept = $dept and
    							userrole = $userrole";

    $result = mysql_query($sql);
    $numrows = mysql_num_rows($result);

    if ($numrows == 0) {
    	$sql1 = "insert into menu(dept,userrole,menus,status,created_by,created_date)values
    						($dept,$userrole,$menus,'Active',$created_by,NOW())";
    }else if($numrows > 0){
    	$sql1 = "update menu set 
    									menus = $menus,
    									modified_by = $created_by,
    									modified_date = NOW()
    						where dept = $dept and
    									userrole = $userrole";
    }

    $result1 = mysql_query($sql1);
    if (!$result1) {
    	$resonse = "Failed";
    }
    else{
    	$resonse = "Success";
    }

    return $resonse;
	}

	public function GetMenusDeatils($recnum)
	{
		$newlogin = new userlogin;
    $newlogin->dbconnect();

    $sql = "select recnum,dept,userrole,menus,status,siteid
    				from menu
    				where recnum = $recnum";
   	// echo "$sql <br>"; exit;
    $result = mysql_query($sql);
    return $result;

	}

	public function UpdateMenus4Dept($recnum)
	{
		$newlogin = new userlogin;
    $newlogin->dbconnect();

    $dept = "'" .$this->dept ."'";
    $userrole = "'" .$this->userrole ."'";
    $menus = "'" .$this->menus ."'";
    $status = "'" .$this->status ."'";
    $created_by = "'" .$this->created_by ."'";
    $created_date = "'" .$this->created_date ."'";
    $modified_by = "'" .$this->modified_by ."'";
    $modified_date = "'" .$this->modified_date ."'";

    $sql = "update menu set 
    									menus = $menus,
    									modified_by = $created_by,
    									modified_date = NOW()
    						where recnum = $recnum";
    // echo "$sql <br>"; exit;
    $result = mysql_query($sql);
    if (!$result) {
    	$resonse = "Failed";
    }
    else{
    	$resonse = "Success";
    }

    return $resonse;
	}

}

