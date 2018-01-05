<?php
//============================================
// Author: FSI
// Date-written = Dec 28, 2017
// Filename: suppenquiryClass.php
// Maintains the class for Contract Enquiry
// Revision: v1.0  OMS
//============================================

include_once('classes/loginClass.php');
class suppenquiry {
    var
    $recnum,
    $enq_date,
    $companyrecnum,
    $partdesc,
    $partnum,
    $qty,
    $rtquot_date,
    $rtquot_no,
    $risk_involv,
    $risk_details,
    $status,
    $remarks,
    $cust_id,
    $created_by,
    $created_date,
    $approval,
    $approved_by,
    $approved_date,
    $modified_by,
    $modified_date;

    // Constructor definition
    function suppenquiry() 
    {
      $this->recnum = '';
      $this->enq_date = '';
      $this->companyrecnum = '';
      $this->partdesc = '';
      $this->partnum = '';
      $this->qty = '';
      $this->rtquot_date = '';
      $this->rtquot_no = '';
      $this->risk_involv = '';
      $this->rish_details = '';
      $this->status= '';
      $this->remarks = '';
      $this->cust_id = '';
      $this->created_date = '';
      $this->created_by = '';
      $this->approval = '';
      $this->approved_date = '';
      $this->approved_by = '';
      $this->modified_by = '';
      $this->modified_date = '';

    }

    function setrecnum ($e_recnum) {
     	$this->recnum = $e_recnum;
    }

    function setenq_date ($enq_date) {
     	$this->enq_date = $enq_date;
    }
    function setcompanyrecnum($companyrecnum) {
     	$this->companyrecnum = $companyrecnum;
    }

    function setpartdesc($partdesc) {
     	$this->partdesc = $partdesc;
    }

    function setpartnum($partnum) {
     	$this->partnum = $partnum;
    }

    function setrtquot_date($rtquot_date) {
     	$this->rtquot_date= $rtquot_date;
    }

    function setrtquot_no($rtquot_no) {
     	$this->rtquot_no = $rtquot_no;
    }

    function setrisk_involv($risk_involv) {
     	$this->risk_involv= $risk_involv;
    }

    function setrisk_details($risk_details) {
     	$this->risk_details= $risk_details;
    }

    function setstatus($status) {
     	$this->status= $status;
    }

    function setremarks($remarks) {
    	$this->remarks = $remarks;
    }

    function setqty($qty) {
     	$this->qty = $qty;
    }
    function setcust_id($cust_id) {
     	$this->cust_id = $cust_id;
    }
    function setcreated_by($created_by) {
     $this->created_by = $created_by;
    }

    function setcreated_date($created_date) {
     	$this->created_date = $created_date;
    }

    function setapproval($approved) {
     	$this->approved = $approved;
    }

    function setapproved_by($approved_by) {
     	$this->approved_by = $approved_by;
    }

    function setapproved_date($approved_date) {
     	$this->approved_date = $approved_date;
    }

    function setmodified_by($modified_by) {
     $this->modified_by = $modified_by;
    }

    function setmodified_date($modified_date) {
     	$this->modified_date = $modified_date;
    }

    function addSuppEnquiry() 
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect(); 
      
      $enq_date = "'" . ($this->enq_date ? $this->enq_date : '0000-00-00') . "'";
      $companyrecnum = "'" . $this->companyrecnum . "'";
      $partdesc= "'" . $this->partdesc . "'";
      $partnum = "'" . $this->partnum. "'";
      $rtquot_date = "'" . ($this->rtquot_date  ? $this->rtquot_date  : '0000-00-00') . "'";
      $rtquot_no = "'" . $this->rtquot_no . "'";
      $risk_involv = "'" . $this->risk_involv . "'";
      $risk_details = "'" . $this->risk_details . "'";
      $status = "'" . $this->status . "'";
      $remarks = "'" . $this->remarks . "'";
      $qty = "'" . $this->qty . "'";
      $cust_id = "'" . $this->cust_id . "'";
      $created_date ="'" . ($this->created_date  ? $this->created_date  : '0000-00-00') . "'"; 
      $created_by = "'" . $this->created_by . "'";
      $approved = "'" . $this->approved . "'";
      $approved_date = "'" . ($this->approved_date  ? $this->approved_date  : '0000-00-00') . "'";
      $approved_by = "'" . $this->approved_by . "'";
      $siteid = "'" . $_SESSION['siteid'] . "'";

       $sql = "INSERT INTO  supplier_enquiry 
     						(
                  enq_date,link2cust,partdesc,partnum,qty,rtquot_date,rtquot_no,risk_involv,
                  risk_details,status,remarks,id,created_by,created_date,approved,approved_by,
                  approved_date,formrev,siteid
                )
            		VALUES
                (
                  now(),$companyrecnum,$partdesc,$partnum,$qty,$rtquot_date,$rtquot_no,$risk_involv,
                  $risk_details,$status,$remarks,$cust_id,$created_by,$created_date,$approved,$approved_by,
                  $approved_date,'MKT/F/01 Iss No:01.Rev:00 dt:',$siteid
                )";
      // echo "$sql <br>"; exit;
      $result = mysql_query($sql);
      if(!$result) die("Insert to enquiry didn't work..Please report to Sysadmin. " . mysql_error());
      $objid = mysql_insert_id();
			return $objid;
     }
        
    public function getAllSuppEnquirys() 
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
     	$sql = "select en.recnum,enq_date,link2cust,partdesc,partnum,qty,rtquot_date,
     								  rtquot_no,risk_involv,risk_details,en.status,c.name 
						 	from supplier_enquiry en,company c 
						 	where c.recnum = en.link2cust";
      $result = mysql_query($sql);

      return $result;

   	}	

   	public function getenquiry($recnum) 
   	{
      $newlogin = new userlogin;
      $newlogin->dbconnect();

     	$sql = " select en.recnum,enq_date,link2cust,partdesc,partnum,qty,
                       rtquot_date,rtquot_no,risk_involv,risk_details,en.status,
                       en.remarks,formrev,c.name,en.id,created_date,created_by,
                       approved_date,approved_by,approved
            		from supplier_enquiry en,company c 
            		where c.recnum= en.link2cust and 
            		en.recnum = $recnum";
      // echo "$sql <br>";
      $result = mysql_query($sql);
      return $result;
    }

    public function update_suppenquiry($recnum) 
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
        
      $enq_date = "'" . ($this->enq_date ? $this->enq_date : '0000-00-00') . "'";
      $companyrecnum = "'" . $this->companyrecnum . "'";
      $partdesc= "'" . $this->partdesc . "'";
      $partnum = "'" . $this->partnum. "'";
      $rtquot_date = "'" . ($this->rtquot_date  ? $this->rtquot_date  : '0000-00-00') . "'";
      $rtquot_no = "'" . $this->rtquot_no . "'";
      $risk_involv = "'" . $this->risk_involv . "'";
      $risk_details = "'" . $this->risk_details . "'";
      $status = "'" . $this->status . "'";
      $remarks = "'" . $this->remarks . "'";
      $qty = "'" . $this->qty . "'";
      $cust_id = "'" . $this->cust_id . "'";
      $created_by = "'" . $this->created_by . "'";
      $created_date = "'" . $this->created_date . "'";
      $approved = "'" . $this->approved . "'";
      $approved_date = "'" . $this->approved_date . "'";
      $approved_by = "'" . $this->approved_by . "'";
      $modified_by = "'" . $_SESSION['user'] . "'";


     	$sql = "UPDATE supplier_enquiry SET
                link2cust = $companyrecnum,
                enq_date = $enq_date,
                partdesc = $partdesc,
          	    partnum = $partnum,
          	    rtquot_date =$rtquot_date ,
          	    rtquot_no =$rtquot_no,
          	    risk_involv=$risk_involv,
                risk_details = $risk_details ,
                status = $status,
                qty = $qty,
                remarks= $remarks,
                id=$cust_id,
                created_by=$created_by,
                created_date=$created_date,
                approved=$approved,
                approved_date=$approved_date,
                approved_by=$approved_by,
                modified_by = $modified_by,
                modified_date = NOW()
              WHERE
                recnum = $recnum";
			// echo $sql;exit;
      $result = mysql_query($sql);

	    if(!$result)
      {
       	die("Supplier Enquiry update failed...Please report to SysAdmin. " . mysql_error());
     	}
    }

    public function getallpartnum4supplier()
    {
    	$newlogin = new userlogin;
      $newlogin->dbconnect();

      $sql = "select recnum,partnum,part_desc
      				from vend_part_master";
      $result = mysql_query($sql);
      return $result;

    }


}

?>