<?php 

/**
* 
*/
include_once('loginClass.php');
class ResourcePlanning 
{
	var $uploadname,
      $uploadsize,
      $userid,
      $uploadtype,
      $link2upload,
      $link2user,
      $shift,
      $shiftdate,
      $subsidaryid,
      $empid,
      $siteid;

	function ResourcePlanning()
	{
		$this->uploadname = "";
    $this->uploadsize = "";
    $this->userid = "";
    $this->link2user = "";
    $this->uploadtype = "";
    $this->link2upload = "";
    $this->shift = "";
    $this->shiftdate = "";
    $this->subsidaryid = "";
    $this->empid = "";
    $this->siteid = "";
	}

  public function setempid($empid)
  {
    $this->empid = $empid;
  }
  public function setsiteid($siteid)
  {
    $this->siteid = $siteid;
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
  public function setshift($shift)
  {
    $this->shift = $shift;
  }
  public function setshiftdate($shiftdate)
  {
    $this->shiftdate = $shiftdate;
  }
  public function setsubsidaryid($subsidaryid)
  {
    $this->subsidaryid = $subsidaryid;
  }

	public function getSchduleMonth($start,$end,$cid)
	{
		$newlogin = new userlogin;
    $newlogin->dbconnect();


    $sql = "select count(*) as numrows,
    							 shiftdate as start,
    							 shift
    				from resource_schdule
    				where shiftdate between '$start' and '$end' and subsidary='$cid'
    				group by shiftdate,shift";
      //echo "$sql <br>";
    $result = mysql_query($sql);
    return $result;

	}

  public function getSchduleDay($startdate,$cid)
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();

    $sql = "select rs.recnum,
                   rs.parent_company,
                   rs.subsidary,
                   rs.empid,
                   rs.shiftdate,
                   rs.shift,
                   rs.link2user,
                   e.fname
            from resource_schdule rs, employee e
            where rs.shiftdate = '$startdate' and
                  e.empid = rs.empid and subsidary='$cid'";
    // echo "$sql <br>";
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

    $sql ="insert into resource_upload(
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

  public function UploadReourceSchdule($value='')
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();

  
    
    $empid = "'" . $this->empid . "'";
    $siteid = "'" . $this->siteid . "'";
    $subsidaryid = "'" . $this->subsidaryid . "'";
    $link2user = "'" . $this->link2user . "'";
    $shift = "'" . $this->shift . "'";
    $shiftdate = "'" . $this->shiftdate . "'";
    $uploadtype = "'" . $this->uploadtype . "'";
    $link2upload = $this->link2upload ;
    $userid = $_SESSION['user'];

    $sql1 = "select empid from resource_schdule
            where shiftdate = $shiftdate and
                  shift = $shift and
                  subsidary = $subsidaryid and
                  empid = $empid";
    
    $result1 = mysql_query($sql1);
    if (!(mysql_fetch_row($result1)))
    {

      $sql = "insert into resource_schdule (
                    parent_company,
                    subsidary,
                    empid,
                    shift,
                    shiftdate,
                    created_date,
                    created_by,
                    link2resourceupload,
                    insert_type
                  )values(
                    $siteid,
                    $subsidaryid,
                    $empid,
                    $shift,
                    $shiftdate,
                    NOW(),
                    '$userid',
                    '$link2upload',
                    $uploadtype
                  )";
      // echo "$sql <br>"; exit;
      $result = mysql_query($sql);
      return $result;
    }
    else
    {
     
      $msg = "Already Exits";
      return $msg;
    }

  }

  public function getResourceUpload()
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();

    $sql = "select recnum,
                   upload_name,
                   upload_size,
                   upload_date,
                   upload_by
            from resource_upload";
    // echo "$sql <br>";
    $result = mysql_query($sql);
    return $result;
  }

  public function getResourceUploadDetails($recnum)
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();

    $sql = "select recnum,
                   upload_name,
                   upload_size,
                   upload_date,
                   upload_by
            from resource_upload
            where recnum = $recnum";
    // echo "$sql <br>";
    $result = mysql_query($sql);
    return $result;
  }

  public function getResourceUploadLIDetails($recnum)
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();

    $sql = "select  rs.recnum,
                    rs.parent_company,
                    rs.subsidary,
                    rs.empid,
                    rs.shift,
                    rs.shiftdate,
                    rs.created_date,
                    rs.created_by
            from resource_schdule rs
            where rs.link2resourceupload = $recnum";
    // echo "$sql <br>";
    $result = mysql_query($sql);
    return $result;
  }

  public function getEmpid($userrecnum)
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();

    $sql = "select u.userid,e.empid 
            from user u, employee e
            where u.user2employee = e.recnum and
                  u.recnum = $userrecnum";

    // echo "$sql <br>";
    $result = mysql_query($sql);
    $myrow = mysql_fetch_assoc($result);
    $empid = $myrow['empid'];
    return $empid;

  }

  public function getSubsidaryId($custrecnum)
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();

    $sql = "select c.id,c.name 
            from company c
            where c.recnum = $custrecnum";

    // echo "$sql <br>";
    $result = mysql_query($sql);
    $myrow = mysql_fetch_assoc($result);
    $id = $myrow['id'];
    return $id;

  }

  public function GetEmployeeResource($shiftdate)
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();

    $sql = "SELECT e.recnum,e.empid,e.fname,e.lname
            FROM employee e
            WHERE NOT EXISTS (select null from resource_schdule rs where rs.shiftdate = '$shiftdate' and e.empid = rs.empid)
            AND NOT EXISTS (select null from leave_mgt l where  l.empid = e.empid and (l.`from` <= '$shiftdate' and l.`to` >= '$shiftdate' ) );";

    $result = mysql_query($sql);
    return $result;

  }
  public function GetEmployeeUnderSubsidaryCompany($shiftdate,$cid)
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();

    $sql = "SELECT e.recnum,e.empid,e.fname,e.lname
            FROM employee e
            WHERE NOT EXISTS (select null from resource_schdule rs where rs.shiftdate = '$shiftdate' and e.empid = rs.empid)
            AND NOT EXISTS (select null from leave_mgt l where  l.empid = e.empid and (l.`from` <= '$shiftdate' and l.`to` >= '$shiftdate' ) )
            and e.subsidarycompany='$cid';";

    $result = mysql_query($sql);
    return $result;

  }


}

?>