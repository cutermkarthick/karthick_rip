<?php 

/**
* 
*/
include_once('loginClass.php');
class ResourceRequirement 
{
	var $customercompanyid,
      $shift,
      $shiftdate,
      $reqcount,
      $upload_date;

	function ResourceRequirement()
	{
		$this->customercompanyid = "";
    $this->shift = "";
    $this->shiftdate = "";
    $this->reqcount = "";
    $this->upload_date="";
	}

  public function setcustomercompanyid($id)
  {
    $this->customercompanyid = $id;
  }
  public function setshift($shf)
  {
    $this->shift = $shf;
  }
  public function setshiftdate($sd)
  {
    $this->shiftdate = $sd;
  }
  public function setreqcount($rc)
  {
    $this->reqcount = $rc;
  }
  public function setupload_date($ud)
  {
    $this->upload_date = $ud;
  }
	

  public function Insertrequirements()
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();

    $customercompanyid = "'" . $this->customercompanyid . "'";
    $date = "'" . $this->shiftdate. "'";
    $shift = "'" . $this->shift. "'";
    $reqcount =  $this->reqcount;
    $sql ="insert into resource_requirement(
                  customercompanyid,
                  date,
                  shift,
                  requirement,
                  upload_date)
            values(
                  $customercompanyid,
                  $date,
                  $shift,
                  $reqcount,
                  NOW())";

    $result = mysql_query($sql);
    $insertid = mysql_insert_id();

     
    return $insertid;

  }

  public function getResourceSummary()
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $sql="select customercompanyid,upload_date,count(*) as line from resource_requirement 
    group by  customercompanyid,upload_date order by upload_date desc ";
    $result = mysql_query($sql);
    return $result;
  }
  public function getResourceUploadDetails($cmpid,$date)
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $sql="select * from resource_requirement 
    where customercompanyid='$cmpid' and upload_date='$date' order by date desc ";
    //echo $sql;
    $result = mysql_query($sql);
    return $result;
  }
  public function getResourceUploadDetailsMonth($cmpid,$fday,$lday)
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $sql="select * from resource_requirement 
    where customercompanyid='$cmpid' and upload_date>='$fday' and upload_date<='$lday' ";
    //echo $sql;
    $result = mysql_query($sql);
    return $result;
  }

}

?>