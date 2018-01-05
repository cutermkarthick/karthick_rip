<?
//============================================
// Author: FSI
// Date-written = March 20, 2007
// Filename: enquiryClass.php
// Maintains the class for Contract Enquiry
// Revision: v1.0  OMS
//============================================

include_once('classes/loginClass.php');

class enquiry {
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
    $approved_date;

    // Constructor definition
    function enquiry() {
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

    }


    function getrecnum() {
           return $this->recnum;
    }
    function setrecnum ($e_recnum) {
           $this->recnum = $e_recnum;
    }
    function getenq_date() {
           return $this->enq_date;
    }
    function setenq_date ($enq_date) {
           $this->enq_date = $enq_date;
    }

    function getcompanyrecnum() {
           return $this->companyrecnum;
    }
    function setcompanyrecnum($companyrecnum) {
           $this->companyrecnum = $companyrecnum;
    }

    function getpartdesc() {
           return $this->partdesc;
    }
    function setpartdesc($partdesc) {
           $this->partdesc = $partdesc;
    }

    function getpartnum() {
           return $this->partnum;
    }
    function setpartnum($partnum) {
           $this->partnum = $partnum;
    }

    function getrtquot_date() {
           return $this->rtquot_date;
    }
    function setrtquot_date($rtquot_date) {
           $this->rtquot_date= $rtquot_date;
    }

    function getrtquot_no() {
           return $this->rtquot_no;
    }
    function setrtquot_no($rtquot_no) {
           $this->rtquot_no = $rtquot_no;
    }

    function getrisk_involv() {
           return $this->risk_involv;
    }
    function setrisk_involv($risk_involv) {
           $this->risk_involv= $risk_involv;
    }

    function getrisk_details() {
           return $this->risk_details;
    }
    function setrisk_details($risk_details) {
           $this->risk_details= $risk_details;
    }

    function getstatus() {
           return $this->status;
    }
    function setstatus($status) {
           $this->status= $status;
    }

    function getremarks() {
           return $this->remarks;
    }
    function setremarks($remarks) {
           $this->remarks = $remarks;
    }

    function getqty() {
           return $this->qty;
    }
    function setqty($qty) {
           $this->qty = $qty;
    }


    function getcust_id() {
           return $this->cust_id;
    }
    function setcust_id($cust_id) {
           $this->cust_id = $cust_id;
    }


    function getcreated_by() {
           return $this->created_by;
    }
    function setcreated_by($created_by) {
           $this->created_by = $created_by;
    }



    function getcreated_date() {
           return $this->created_date;
    }
    function setcreated_date($created_date) {
           $this->created_date = $created_date;
    }


    function getapproval() {
           return $this->approved;
    }
    function setapproval($approved) {
           $this->approved = $approved;
    }



    function getapproved_by() {
           return $this->approved_by;
    }
    function setapproved_by($approved_by) {
           $this->approved_by = $approved_by;
    }




    function getapproved_date() {
           return $this->approved_date;
    }
    function setapproved_date($approved_date) {
           $this->approved_date = $approved_date;
    }



    function addenquiry() {
        $newlogin = new userlogin;
        $newlogin->dbconnect(); 
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'enquiry' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        
        
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

         $sql = "select * from enquiry where recnum = $objid";
           $result = mysql_query($sql);
           if (!(mysql_fetch_row($result)))
           {
             $sql = "INSERT INTO
                        enquiry
                            (
                            recnum,enq_date,link2cust,partdesc,partnum,qty,rtquot_date,rtquot_no,risk_involv,risk_details,status,remarks,id,created_by,created_date,approved,approved_by,approved_date,formrev,siteid
                            )
                    VALUES
                            (
                            $objid,now(),$companyrecnum,$partdesc,$partnum,$qty,$rtquot_date,$rtquot_no,$risk_involv,$risk_details,$status,$remarks,$cust_id,$created_by,$created_date,$approved,$approved_by,$approved_date,'MKT/F/01 Iss No:01.Rev:00 dt:',$siteid
                            )";

           // echo $sql;exit;
            $result = mysql_query($sql);

           // Test to make sure query worked
              if(!$result) die("Insert to enquiry didn't work..Please report to Sysadmin. " . mysql_error());
            }
            else
            {
                echo "<table border=1><tr><td><font color=#FF0000>";
               die("Enquiry ID " . $objid . " already exists. ");
               echo "</td></tr></table>";
            }
            $sql = "update seqnum set nxtnum = $objid where tablename = 'enquiry'";
            $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work for BOM..Please report to Sysadmin. " . mysql_error());

        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for BOM Insert..Please report to Sysadmin. " . mysql_error());
        return $objid;
     }
        


     function getenquirys($cond) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select en.recnum,enq_date,link2cust,partdesc,partnum,qty,rtquot_date,rtquot_no,risk_involv,risk_details,en.status,c.name FROM enquiry en,company c where c.recnum = en.link2cust and $cond";
        $result = mysql_query($sql);
// echo "$sql";
        return $result;

     }


     function getenquiry($enquiryrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

       $sql = " select en.recnum,enq_date,link2cust,partdesc,partnum,qty,
                       rtquot_date,rtquot_no,risk_involv,risk_details,en.status,en.remarks,formrev,c.name,en.id,created_date,created_by,approved_date,approved_by,approved
            FROM enquiry en,company c 
            where c.recnum= en.link2cust and en.recnum = $enquiryrecnum";
// echo $sql;
        $result = mysql_query($sql);

        return $result;
     }

     function updateenquiry($enquiryrecnum) {
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

       $sql = "UPDATE enquiry SET
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
                    approved_by=$approved_by
                    WHERE
                    recnum = $enquiryrecnum";
 // echo $sql;exit;
        $result = mysql_query($sql);

        if(!$result)
                     {
 
                     die("enquiry update failed...Please report to SysAdmin. " . mysql_error());
                     }
        }


    function deleteenquiry($enquiryrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from enquiry where recnum = $enquiryrecnum";
        $result = mysql_query($sql);
        if(!$result)
                     {
                      //header("Location:errorMessage.php?validate=Inv6");
                      die("Delete for enquiry failed...Please report to SysAdmin. " . mysql_error());
                     }
      }

 function ftp_copy($source_file,$destination_file)
     {
	$ftp_server='ftp.fluentsoft.com';
	$ftp_user='bmandyam@fluentsoft.com';
	$ftp_password='dci1034';
	$conn_id=ftp_connect($ftp_server);
	$login_result=ftp_login($conn_id,$ftp_user,$ftp_password);
	if (( !$conn_id ) || ( !$login_result ))
	{
		die("FTP connection Failed");
	}
	$upload=ftp_put($conn_id,$destination_file,$source_file,FTP_BINARY);
	ftp_close($conn_id);
	if(!$upload)
	{
		die("FTP copy has failed");
	}
   }
} // End invoice class definition

