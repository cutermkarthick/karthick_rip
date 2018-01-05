<?php 
include_once('loginClass.php');
class Payroll_monthly {

		var $id,
		  	$hrs_worked,
		  	$ot,
		  	$gross_salary,
		  	$tds,
		  	$net_salary,
		  	$date;
        
 
  	function Payroll_monthly() 
	{
		  $this->id = '';
	  	$this->hrs_worked = '';
	  	$this->ot = '';
	  	$this->gross_salary = '';
	  	$this->tds = '';
	  	$this->net_salary = '';
	  	$this->date= '';
 }	

    function setid($id) 
	{
        $this->id = $id;
    }

    function sethrs_worked($hrs_worked) 
	{
        $this->hrs_worked = $hrs_worked;
    }

    function setot($ot) 
	{
        $this->ot = $ot;
    }

    function setgross_salary($gross_salary) 
	{
        $this->gross_salary = $gross_salary;
    }

    function settds($tds) 
	{
        $this->tds = $tds;
    }

    function setnet_salary($net_salary) 
	{
        $this->net_salary = $net_salary;
    }

    function setdate($date) 
	{
        $this->date = $date;
    }
    function getid()
    {
      return $this->id;
    }

    function gethrs_worked()
    {
      return $this->hrs_worked;
    }

    function getot()
    {
      return $this->ot;
    }

    function getgross_salary()
    {
      return $this->gross_salary;
    }

    function gettds()
    {
      return $this->tds;
    }

    function getnet_salary()
    {
      return $this->net_salary;
    }

    function getdate()
    {
      return $this->date;
    }
	function addnewpayroll_monthly()
	{

	      $newlogin = new userlogin;
        $newlogin->dbconnect();

		$id = "'" . $this->id. "'";
		$hrs_worked = "'" . $this->hrs_worked. "'";
		$ot = "'" . $this->ot . "'";
		$gross_salary = "'" . $this->gross_salary . "'";
		$tds = "'" . $this->tds. "'";
		$net_salary = "'" . $this->net_salary . "'";
		$date = "'" . $this->date . "'";
    $siteid = "'" . $_SESSION['siteid'] . "'";
       
       $sql = "select nxtnum from seqnum where tablename = 'payroll_monthly' for update";
        //echo $sql;
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

		$sql ="INSERT into payroll_monthly(recnum,
									id,
									hrs_worked,
									ot,
									gross_salary,
									tds,
									net_salary,
									date,
                  siteid)
							values($objid,
								   $id,
								   $hrs_worked,
								   $ot,
								   $gross_salary,
								   $tds,
								   $net_salary,
								   $date,
                   $siteid)";
		// echo "$sql <br>"; exit;
		$result = mysql_query($sql);
		 if(!$result) die("payroll Monthly Entry query didn't work for task..Please report to Sysadmin. " . mysql_error());

		   $sql = "update seqnum set nxtnum = $objid where tablename = 'payroll_monthly'";
        $result = mysql_query($sql);
	    if(!$result)
	    {
			 $sql = "rollback";
			 $result = mysql_query($sql);
			 die("Seqnum insert for work order didn't work...Please report to Sysadmin. " . mysql_errno());
	    }

		return mysql_insert_id();

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


  function getallpayroll_monthly($argoffset,$arglimit,$month,$year,$cond)
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();

    $offset= $argoffset;
    $limit= $arglimit;
    $siteid = $_SESSION['siteid'];
    $siteval = "pms.siteid = '".$siteid."'";

    // $sql = "select pm.recnum,pm.id,pm.hrs_worked,pm.ot,
    //                pm.net_salary,pm.date,pms.basic_salary,
    //                pms.name,pms.join_date,pm.gross_salary,
    //                pm.tds   
    //         from payroll_monthly pm ,payroll_master pms 
    //         where pms.id = pm.id and $siteval and 
    //               $cond and substr(pm.date,6,2) = $month and 
    //               substr(pm.date,1,4) = $year
    //         order by pm.recnum
    //         limit $offset, $limit ";

    $sql = "select pms.id as empid,pms.basic_salary, pms.name,pms.join_date,
                   pm.recnum,pm.id,pm.hrs_worked,pm.ot, pm.net_salary,pm.date,
                   pm.gross_salary, pm.tds
            from payroll_master pms left join payroll_monthly pm on pms.id =  pm.id and substr(pm.date,6,2) = $month and substr(pm.date,1,4) = $year
            where $siteval  and pms.name like'%' 
            order by pms.recnum
            limit $offset, $limit";

    // echo "$sql <br>";
    $result = mysql_query($sql);
    return $result;
  } 

  
  function getpayroll_monthly_details($empid)
  {
      $newlogin = new userlogin;
      $newlogin->dbconnect();

        $siteid = $_SESSION['siteid'];
        $siteval = "pms.siteid = '".$siteid."'";

        $sql = "select pm.recnum,pm.id, pm.hrs_worked , pm.ot ,pm.net_salary , pm.date ,pms.basic_salary, pms.name,pms.join_date,pm.gross_salary,pm.tds   
              from payroll_master pms, payroll_monthly pm 
              where $siteval and  pm.id = pms.id and 
                    pm.id = '$empid' and pm.id = pms.id";
        // echo "$sql <br>";
        $result = mysql_query($sql);
        return $result;

  } 

  public function getpayroll_trans_monthly_details($empid,$month,$year)
  {
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      $siteid = $_SESSION['siteid'];
      $siteval = "pms.siteid = '".$siteid."'";

      $sql = "select pt.recnum,
                     pt.empid,
                     pt.date,
                     pt.siteid,
                     pt.checkInOut,
                     pt.Lat,
                     pt.Lon,
                     pt.TaskId
              from payroll_trans pt
              where pt.empid = '$empid' and 
                    substr(pt.date,6,2) = $month and substr(pt.date,1,4) = $year 
              order by pt.recnum asc      
              ";

      // echo "$sql <br>";
      $result = mysql_query($sql);
      return $result;
  }

    function getpayroll_master_details($empid,$month, $year)
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();

        $siteid = $_SESSION['siteid'];
        $siteval = "pms.siteid = '".$siteid."'";

        $sql = "select pms.recnum,
                       pms.id,
                       pms.basic_salary,
                       pms.name,
                       pms.join_date,
                       am.recnum as arecnum,
                       am.empid as empid, 
                       am.days_come,
                       am.date
              from payroll_master pms 
              left join attendance_monthly am on pms.id =  am.empid and substr(am.date,6,2) = $month and substr(am.date,1,4) = $year
              where $siteval and  
                    pms.id = '$empid' ";
         echo "$sql <br>";
        $result = mysql_query($sql);
        return $result;
    }   

    function getpayroll_master($empid,$month, $year)
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();

        $siteid = $_SESSION['siteid'];
        $siteval = "pms.siteid = '".$siteid."'";

        $sql = "select pms.recnum,
                       pms.id,
                       pms.basic_salary,
                       pms.name,
                       pms.join_date,
                       pms.hra,
                       pms.ta,
                       pms.sa,
                       pms.increment
              from payroll_master pms 
              where $siteval and  
                    pms.id = '$empid' ";
        // echo "$sql <br>"; exit;
        $result = mysql_query($sql);
        return $result;
    }

    public function check_payroll_monthly($empid,$month, $year)
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $siteid = $_SESSION['siteid'];
        $siteval = "pm.siteid = '".$siteid."'";

        $sql = "select 
                       pm.recnum,
                       pm.id as pmid, 
                       pm.hrs_worked , 
                       pm.ot ,
                       pm.net_salary , 
                       pm.date ,  
                       pm.tds 
              from payroll_monthly pm 
              where pm.id =  '$empid' and 
                    substr(pm.date,6,2) = $month and substr(pm.date,1,4) = $year and 
                    $siteval ";
        // echo "$sql <br>"; exit;
        $result = mysql_query($sql);
        return $result;
    }

    function updatepayroll_monthly($empid,$month,$year) 
    {
        
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      $id = "'" . $this->id. "'";
      $hrs_worked = "'" . $this->hrs_worked. "'";
      $ot = "'" . $this->ot . "'";
      $gross_salary = "'" . $this->gross_salary . "'";
      $tds = "'" . $this->tds. "'";
      $net_salary = "'" . $this->net_salary . "'";
      $date = "'" . $this->date . "'";
      $siteid = "'" . $_SESSION['siteid'] . "'";
        
        
        $sql = "update payroll_monthly set
                                      id = $id,
                                      hrs_worked = $hrs_worked,
                                      ot = $ot,
                                      gross_salary = $gross_salary,
                                      tds = $tds,
                                      net_salary = $net_salary,
                                      date = $date,
                                      siteid = $siteid
                                  where  id =  '$empid' and 
                    substr(date,6,2) = $month and substr(date,1,4) = $year";

      // echo "<br>$sql<br>";exit;
        //echo $sql;
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Update of Payroll Monthly failed..Please report to Sysadmin " . mysql_error());

    } 


}



?>