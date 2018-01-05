<?
//============================================
// Author: FSI
// Date-written = March 20, 2007
// Filename: enquiryClass.php
// Maintains the class for Contract Enquiry
// Revision: v1.0  OMS
//============================================

include_once('classes/loginClass.php');

class feedback {
    var
    $recnum,
    $name,
    $parameters,
    $ranking,
    $remarks,
    $fdate,
    $tdate,
    $last_date,
    $crdate;

    // Constructor definition
    function feedback() {
        $this->recnum = '';
        $this->name = '';
        $this->parameters = '';
        $this->ranking = '';
        $this->remarks = '';
        $this->fdate = '';
        $this->tdate = '';
        $this->last_date = '';
        $this->crdate = '';
   }


    function getrecnum() {
           return $this->recnum;
    }
    function setrecnum ($e_recnum) {
           $this->recnum = $e_recnum;
    }
    function getname() {
           return $this->name;
    }
    function setname($e_name) {
           $this->name = $e_name;
    }

    function getparameters() {
           return $this->parameters;
    }
    function setparameters($parameters) {
           $this->parameters = $parameters;
    }

    function getranking() {
           return $this->ranking;
    }
    function setranking($ranking) {
           $this->ranking = $ranking;
    }

    function getremarks() {
           return $this->remarks;
    }
    function setremarks($remarks) {
           $this->remarks = $remarks;
    }

    function getfdate() {
           return $this->fdate;
    }
    function setfdate($fdate) {
           $this->fdate = $fdate;
    }


    function gettdate() {
           return $this->tdate;
    }
    function settdate($tdate) {
           $this->tdate = $tdate;
    }


    function getlast_date() {
           return $this->last_date;
    }
    function setlast_date($last_date) {
           $this->last_date = $last_date;
    }


    function getcrdate() {
           return $this->crdate;
    }
    function setcrdate($crdate) {
           $this->crdate = $crdate;
    }

    function addcust_feedback() 
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect(); 
         $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'cust_feedback' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;  

        $name = "'" . $this->name . "'";
        $fdate= "'" . $this->fdate . "'";
        $tdate = "'" . $this->tdate. "'";
        $last_date = "'" . $this->last_date. "'";
        $crdate = "'" . $this->crdate. "'";
        $userid = "'" . $_SESSION['user'] . "'";
        $siteid = "'" . $_SESSION['siteid'] . "'";
         $sql = "select * from cust_feedback where recnum = $objid";
        $result = mysql_query($sql);
           if (!(mysql_fetch_row($result)))
           {
        $sql = "INSERT INTO cust_feedback
                            (recnum,name,fdate,todate,created_by,created_date,formrev,siteid,ldate
                            )
                    VALUES ($objid,$name,$fdate,$tdate,$userid,$crdate,'MKT/F/01 Iss No:01.Rev:00',$siteid,$last_date
                            )";

           // echo $sql;
            $result = mysql_query($sql);
       if(!$result) die("Insert to cust_feedback didn't work..Please report to Sysadmin. " . mysql_error());
            }
            else
            {
                echo "<table border=1><tr><td><font color=#FF0000>";
               die("Enquiry ID " . $objid . " already exists. ");
               echo "</td></tr></table>";
            }
            $sql = "update seqnum set nxtnum = $objid where tablename = 'cust_feedback'";
            $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work for BOM..Please report to Sysadmin. " . mysql_error());

        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for BOM Insert..Please report to Sysadmin. " . mysql_error());
        return $objid;
     }
        

     function addcust_feedback_li($customerrecnum) 
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect(); 
        
        
        $parameters= "'" . $this->parameters . "'";
        $ranking = "'" . $this->ranking. "'";
        $remarks = "'" . $this->remarks. "'";
        
        $sql = "INSERT INTO custfeedback_li
                            (parameters,ranking,remarks,link2feedback
                            )
                    VALUES ($parameters,$ranking,$remarks,$customerrecnum)";

           // echo "<br>".$sql."<br>";
            $result = mysql_query($sql);
       if(!$result) die("Insert to addcust_feedback_li didn't work..Please report to Sysadmin. " . mysql_error());
          
        return $result;
     }
        





     function getcustomer() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select cf.recnum,name,parameters,ranking,remarks,created_date,formrev,fdate,todate
                  FROM cust_feedback cf ,custfeedback_li cfli 
                  where cf.recnum = cfli.link2feedback";
        $result = mysql_query($sql);
// echo "$sql";
        return $result;

     }


     
     function updatecustomer($customerrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $name = "'" . $this->name . "'";
        $parameters= "'" . $this->parameters . "'";
        $ranking = "'" . $this->ranking. "'";
        $remarks = "'" . $this->remarks . "'";

       $sql = "UPDATE customer SET
                    name = $name,
                    parameters = $parameters,
                    ranking = $ranking,
            	    remarks= $remarks
                    WHERE
                    recnum = $customerrecnum";
 // echo $sql;exit; 
        $result = mysql_query($sql);

        if(!$result)
                     {
 
                     die("customer update failed...Please report to SysAdmin. " . mysql_error());
                     }
        }


    function deletecustomer($customerrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from customer where recnum = $customerrecnum";
        $result = mysql_query($sql);
        if(!$result)
                     {
                      //header("Location:errorMessage.php?validate=Inv6");
                      die("Delete for customer failed...Please report to SysAdmin. " . mysql_error());
                     }
      }

 
} // End invoice class definition

