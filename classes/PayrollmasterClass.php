<?php 
include_once('loginClass.php');
class Payroll_master {

		var $name,
		  	$id,
		  	$basic,
		  	$ta,
		  	$hra,
		  	$sa,
		  	$increment,
		  	$join_date,
        $role,
        $grade;
 
  	function Payroll_master() 
	{
		  $this->name = '';
	  	$this->id = '';
	  	$this->basic = '';
	  	$this->hra = '';
	  	$this->ta = '';
	  	$this->sa = '';
	  	$this->increment = '';
	  	$this->join_date= '';
      $this->role= '';
      $this->grade= '';
	}	

	function setname($name) 
	{
        $this->name = $name;
    }

    function setid($id) 
	{
        $this->id = $id;
    }

    function setbasic($basic) 
	{
        $this->basic = $basic;
    }

    function sethra($hra) 
	{
        $this->hra = $hra;
    }

    function setsa($sa) 
	{
        $this->sa = $sa;
    }

    function setta($ta) 
	{
        $this->ta = $ta;
    }

    function setincrement($increment) 
	{
        $this->increment = $increment;
    }

    function setjoin_date($join_date) 
	{
        $this->join_date = $join_date;
    }

    function getid()
    {
      return $this->id;
    }

    function getname()
    {
      return $this->name;
    }

    function getbasic()
    {
      return $this->basic;
    }

    function gethra()
    {
      return $this->hra;
    }

    function getta()
    {
      return $this->ta;
    }

    function getsa()
    {
      return $this->sa;
    }

    function getincrement()
    {
      return $this->increment;
    }

    function getjoin_date()
    {
      return $this->join_date;
    }
     function getrole()
    {
      return $this->role;
    }
     function getgrade()
    {
      return $this->grade;
    }

        function setrole($role) 
  {
        $this->role = $role;
    }

        function setgrade($grade) 
  {
        $this->grade = $grade;
    }
	function addnewpayroll_master()
	{

	  $newlogin = new userlogin;
    $newlogin->dbconnect();

		$name = "'" . $this->name . "'";
		$id = "'" . $this->id. "'";
		$basic = "'" . $this->basic. "'";
		$hra = "'" . $this->hra . "'";
		$ta = "'" . $this->ta . "'";
		$sa = "'" . $this->sa . "'";
		$increment = "'" . $this->increment . "'";
		$join_date = "'" . $this->join_date . "'";
		$siteid = "'" . $_SESSION['siteid'] . "'";
    $role = "'" . $this->role . "'";
    $grade = "'" . $this->grade . "'";
    
    $sql = "select nxtnum from seqnum where tablename = 'payroll_master' for update";
    //echo $sql;
    $result = mysql_query($sql);
    $myrow = mysql_fetch_row($result);
    $seqnum = $myrow[0];
    $objid = $seqnum + 1;
		$sql ="INSERT into payroll_master(recnum,
    									name,
    									id,
    									basic_salary,
    									hra,
    									ta,
    									sa,
    									increment,
    									join_date,
    									siteid,
                      role,
                      grade)
    							values($objid,
    								   $name,
    								   $id,
    								   $basic,
    								   $hra,
    								   $ta,
    								   $sa,
    								   $increment,
    								   $join_date,
    								   $siteid,
                       $role,
                       $grade)";
		// echo "$sql <br>"; exit;
		$result = mysql_query($sql);
		 if(!$result) die("payroll Entry query didn't work for task..Please report to Sysadmin. " . mysql_error());

		   $sql = "update seqnum set nxtnum = $objid where tablename = 'payroll_master'";
        $result = mysql_query($sql);
	    if(!$result)
	    {
			 $sql = "rollback";
			 $result = mysql_query($sql);
			 die("Seqnum insert for work order didn't work...Please report to Sysadmin. " . mysql_errno());
	    }

		return mysql_insert_id();

	}



    function getallpayroll_master()
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      session_start();
      $offset= $argoffset;
      $limit= $arglimit;
      $siteid = $_SESSION['siteid'];
      $siteval = " siteid = '".$siteid."'";

      $sql = "select recnum, id, name, 
                     basic_salary, hra, sa,
                     ta,increment,join_date,
                     role,grade
              from payroll_master 
              where $siteval
              order by recnum";
      //echo "$sql <br>";
      $result = mysql_query($sql);
      $payroll = array();
      while($rows = mysql_fetch_assoc($result))
      {
        $payroll[] = $rows;
      }
      return $payroll;

   }

   function get_total4payroll()
   {
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $offset= $argoffset;
         $limit= $arglimit;
         $siteid = $_SESSION['siteid'];
         // echo "siteid " .$siteid;
         $siteval = "where siteid = '".$siteid."'";

         $sql = "select count(*) as numrows
                        from payroll_master
                        $siteval";
         // echo "$sql <br>";
         $result = mysql_query($sql);
         $rows = mysql_fetch_assoc($result);
         return $rows["numrows"];

   }

	function getallpayroll($argoffset,$arglimit)
	{
		$newlogin = new userlogin;
        $newlogin->dbconnect();

        $offset= $argoffset;
        $limit= $arglimit;
        $siteid = $_SESSION['siteid'];
        $siteval = "where siteid = '".$siteid."'";

        $sql = "select recnum, id, name, basic_salary, hra, sa, 
                       ta,increment,join_date,role,grade   
          		from payroll_master $siteval
        		order by recnum
                limit $offset, $limit ";
        // echo "$sql <br>";
        $result = mysql_query($sql);
        return $result;

	}	

	function getpayroll_details($recnum)
	{
		$newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select recnum, id, name, basic_salary, hra, sa,
                       ta,increment,join_date,role,grade   
          		from payroll_master 
        		where recnum = $recnum 
        		";

       	// echo "$sql";

        $result = mysql_query($sql);
        return $result;
	}


	function updatepayroll_master($recnum) {
        
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $id = "'" . $this->id . "'";
        $name = "'" . $this->name . "'";
        $basic=  $this->basic ;
        $hra = "'" . $this->hra . "'";
        $join_date = "'" . $this->join_date . "'";
		    $ta = "'" . $this->ta . "'";
        $sa = "'" . $this->sa . "'";
        $increment = "'" . $this->increment . "'";
        $role = "'" . $this->role. "'";
        $grade = "'" . $this->grade . "'";
        
        
        $sql = "update payroll_master set
                                      id = $id,
                                      name = $name,
                                      basic_salary = $basic,
                                      hra = $hra,
                                      sa = $sa,
                                      ta = $ta,
                                      increment = $increment,
                                      join_date = $join_date,
                                      role = $role,
                                      grade = $grade
                                  where recnum = $recnum";

      // echo "<br>$sql<br>";exit;
        //echo $sql;
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Update of Payroll Master failed..Please report to Sysadmin " . mysql_error());

     }


function getmsterid()
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $siteid = $_SESSION['siteid'];
        $siteval = "where siteid = '".$siteid."'";

        $sql = "select recnum, id, name   
              from payroll_master $siteval
            order by recnum";
        // echo "$sql <br>";
        $result = mysql_query($sql);
        return $result;

  } 


}



?>