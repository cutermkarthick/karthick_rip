<?php 
include_once('loginClass.php');
class Attendance {
  var $userrecnum,
      $mobile,
      $empid,
      $stage,
      $type,
      $lat,
      $lon,
      $status,
      $siteid,
      $time,
      $from,
      $to,
      $start_hour,
      $start_min,
      $end_hour,
      $end_min,
      $uploadname,
      $uploadsize,
      $userid,
      $uploadtype,
      $link2upload,
      $setsubsidaryid;

	function Attendance()
	{
    $this->userrecnum = "";
    $this->mobile = "";
    $this->empid = "";
    $this->stage = "";
    $this->type = "";
    $this->lat = "";
    $this->lon = "";
    $this->status = "";
    $this->siteid = "";
    $this->time = "";
    $this->from = "";
    $this->to = "";
    $this->start_hour = "";
    $this->start_min = "";
    $this->end_hour = "";
    $this->end_min = "";
    $this->uploadname = "";
    $this->uploadsize = "";
    $this->userid = "";
    $this->userrecnum = "";
    $this->uploadtype = "";
    $this->link2upload = "";
		$this->setsubsidaryid = "";
	}

  public function setuserrecnum($userrecnum)
  {
    $this->userrecnum = $userrecnum;
  }

  public function setmobile($mobile)
  {
    $this->mobile = $mobile;
  }
  public function setempid($empid)
  {
    $this->empid = $empid;
  }
  public function setstage($stage)
  {
    $this->stage = $stage;
  }
  public function settype($type)
  {
    $this->type = $type;
  }
  public function setlat($lat)
  {
    $this->lat = $lat;
  }
  public function setlon($lon)
  {
    $this->lon = $lon;
  }
  public function setstatus($status)
  {
    $this->status = $status;
  }
  public function setsiteid($siteid)
  {
    $this->siteid = $siteid;
  }
  public function settime($time)
  {
    $this->time = $time;
  }
  public function setfrom($from)
  {
    $this->from = $from;
  }
  public function setto($to)
  {
    $this->to = $to;
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

  public function setuploadname($uploadname)
  {
    $this->uploadname = $uploadname;
  }

  public function setuploadsize($uploadsize)
  {
    $this->uploadsize = $uploadsize;
  }

  public function setlink2user($link2user)
  {
    $this->link2user = $link2user;
  }
  public function setuserid($userid)
  {
    $this->userid = $userid;
  }
  public function setuploadtype($uploadtype)
  {
    $this->uploadtype = $uploadtype;
  }
  public function setlink2upload($link2upload)
  {
    $this->link2upload = $link2upload;
  }
  public function setsubsidaryid($subsidaryid)
  {
    $this->subsidaryid = $subsidaryid;
  }


  	function getattendance_monthly($argoffset,$arglimit,$month,$year,$cond)
  	{
	    $newlogin = new userlogin;
	    $newlogin->dbconnect();

	    $offset= $argoffset;
	    $limit= $arglimit;
	    $siteid = $_SESSION['siteid'];
	    $siteval = "pms.siteid = '".$siteid."'";

   		 $sql = "select pms.id as empid,pms.basic_salary, pms.name,pms.join_date,
                   		am.recnum,am.days_come
	            from payroll_master pms left join attendance_monthly am on pms.id =  am.empid and substr(am.date,6,2) = $month and substr(am.date,1,4) = $year
	            where $siteval  and pms.name like'%' 
	            order by pms.recnum
	            limit $offset, $limit";

	    // echo "$sql <br>";
	    $result = mysql_query($sql);
	    return $result;
  	}

  	public function getAttendance_monthly_details($empid,$month,$year)
  	{
      	$newlogin = new userlogin;
      	$newlogin->dbconnect();

      	$siteid = $_SESSION['siteid'];
      	$siteval = "pms.siteid = '".$siteid."'";

      	$sql = "select a.recnum,
                       a.empid,
                       a.date,
                       a.siteid,
                       a.checkInOut,
                       a.Lat,
                       a.Lon,
                       e.shift_group,
                       ec.start_hour,
                       ec.start_min,
                       ec.end_hour,
                       ec.end_min
                from attendance a, employee e, employee_config ec
                where a.empid = '$empid' and
                	  e.empid = a.empid and 
                	  ec.shift = e.shift_group and
                    substr(a.date,6,2) = $month and substr(a.date,1,4) = $year 
                order by a.recnum asc ";

      	// echo "$sql <br>";
      	$result = mysql_query($sql);
      	return $result;
  	}

  	function getAllEmps4Ams($empid)  
  	{
	    $newlogin = new userlogin;
	    $newlogin->dbconnect();
	    $siteid = $_SESSION['siteid'];
	    $siteval = "e.siteid = '".$siteid."'";
	    $sql =  "select e.fname, e.lname, e.recnum, e.role,
                    e.empid, e.title, e.phone, e.email,
                    e.status,e.shift_group,c.name,e.shift_group,
                    ec.start_hour,ec.start_min,ec.end_hour,ec.end_min,
                    a.days_come,a.date,a.hours_worked 
              from  company c, employee e
              left join employee_config ec on ec.shift = e.shift_group
              left join attendance_monthly a on a.empid = e.empid
              where
	                  e.employee2company = c.recnum and
	                  e.status = 'Active' and 
	                  e.empid = '$empid' and
	                  $siteval";
	    // echo "$sql <br>";
	    $result = mysql_query($sql);
	    return $result;

  	}

  	public function getAttendanceDaysCount($empid,$month,$year)
  	{
  		$newlogin = new userlogin;
	    $newlogin->dbconnect();

  		$sql = "select a.recnum,a.empid,a.date,
  						  substr(a.date,9,2)as start_date,
  						  substr(a.date,6,2)as month,
  						  substr(a.date,1,4) as year 
  				   from attendance a
  				   where empid = '$empid' and
  				   		 substr(a.date,6,2) = $month and substr(a.date,1,4) = $year
  				   	group by a.empid, year, month, start_date ";
  		
	    $result = mysql_query($sql);
	    return $result;
  	}

  	public function CheckMonthlyAttendance($empid,$month,$year)
  	{
  		$newlogin = new userlogin;
	    $newlogin->dbconnect();

	    $sql ="select recnum,empid,mobile,date,
	    			  days_come,month,year
	    		from attendance_monthly
	    		where empid = '$empid' and
	    			  substr(date,6,2) = $month and substr(date,1,4) = $year";
	    $result = mysql_query($sql);
	    $numrows = mysql_num_rows($result);
	    return $numrows;

  	}

  	public function InsertMonthlyAttendance($empid,$month,$year,$count)
  	{
  		$newlogin = new userlogin;
	    $newlogin->dbconnect();
	    $siteid = $_SESSION['siteid'];
	    $sql = "insert into attendance_monthly(
	    					empid,
	    					date,
	    					month,
	    					year,
	    					siteid,
	    					days_come)
	    		values(
	    				'$empid',
	    				NOW(),
	    				'$month',
	    				'$year',
	    				'$siteid',
	    				$count
	    				)";

	   	$result = mysql_query($sql);
	    return $result;
  	}

  	public function UpdateMonthlyAttendance($empid,$month,$year,$count)
  	{
  		$newlogin = new userlogin;
	    $newlogin->dbconnect();

	    $sql = "update attendance_monthly set
	    				days_come = $count
	    		where empid = '$empid' and
	    			  substr(date,6,2) = $month and substr(date,1,4) = $year";
	    $result = mysql_query($sql);
	    return $result;
  	}

    public function UploadAttendance()
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      $time = "'" . $this->time . "'";
      $stage = $this->stage ;
      $link2upload = $this->link2upload ;
      $empid = "'" . $this->empid . "'";
      $siteid = "'" . $this->siteid . "'";
      $uploadtype = "'" . $this->uploadtype . "'";
      $subsidaryid = "'" . $this->subsidaryid . "'";

      $sql ="insert into attendance(
                    date,
                    checkInOut,
                    empid,
                    siteid,
                    insert_type,
                    link2upload,
                    subsidaryid)
              values(
                    $time,
                    $stage,
                    $empid,
                    $siteid,
                    $uploadtype,
                    $link2upload,
                    $subsidaryid)";

      // echo "$sql <br>";  exit;
      $result = mysql_query($sql);
      return $result;

    }

    public function InsertUploadDetails()
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      $uploadname = "'" . $this->uploadname . "'";
      $uploadsize = "'" . $this->uploadsize . "'";
      $userid = "'" . $this->userid . "'";
      $link2user = "'" . $this->link2user . "'";

      $sql ="insert into attendance_upload(
                    upload_name,
                    upload_size,
                    upload_by,
                    link2user,
                    upload_date)
              values(
                    $uploadname,
                    $uploadsize,
                    $userid,
                    $link2user,
                    NOW())";

      // echo "$sql <br>";  exit;
      $result = mysql_query($sql);
      $insertid = mysql_insert_id();
      return $insertid;

    }

    public function getUploadAttendance()
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      $sql = "select recnum,
                     upload_name,
                     upload_size,
                     upload_date,
                     upload_by
              from attendance_upload";
      // echo "$sql <br>";
      $result = mysql_query($sql);
      return $result;

    }

    public function getUploadDetails($recnum)
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      $sql = "select recnum,
                     upload_name,
                     upload_size,
                     upload_date,
                     upload_by
              from attendance_upload
              where recnum = $recnum";
      // echo "$sql <br>";
      $result = mysql_query($sql);
      return $result;
    }

    public function getUploadLIDetails($recnum)
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      $sql = "select a.recnum,
                     a.empid,
                     a.date,
                     a.siteid,
                     a.checkInOut,
                     a.Lat,
                     a.Lon,
                     a.subsidaryid
              from attendance a
              where a.link2upload = $recnum";
      // echo "$sql <br>";
      $result = mysql_query($sql);
      return $result;
    }

}