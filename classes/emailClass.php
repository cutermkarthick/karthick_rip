<?
//====================================
// Author: FSI
// Date-written = September 20, 2006
// Filename: emailClass.php
// Maintains the class for emails
// Revision: v1.0  OWT
//====================================
include_once('loginClass.php');
class email {

    var
        $to_addrs,
        $cc_addrs,
        $bcc_addrs,
        $from_addr,
        $subject,
        $body,
        $userid,
        $create_date;
    // Constructor definition
    function email() {
        $this->to_addrs = '';
        $this->cc_addrs = '';
        $this->bcc_addrs = '';
        $this->from_addr = '';
        $this->subject = '';
        $this->body = '';
        $this->userid = '';
        $this->create_date = '';
    }

    // Property get and set
    function getto_addrs() {
           return $this->to_addrs;
    }
    function setto_addrs ($reqto_addrs) {
           $this->to_addrs = $reqto_addrs;
    }

    function getcc_addrs() {
           return $this->cc_addrs;
    }
    function setcc_addrs ($reqcc_addrs) {
           $this->cc_addrs = $reqcc_addrs;
    }
    function getbcc_addrs() {
           return $this->bcc_addrs;
    }
    function setbcc_addrs ($reqbcc_addrs) {
           $this->bcc_addrs = $reqbcc_addrs;
    }
    function getfrom_addr() {
           return $this->from_addr;
    }
    function setfrom_addr ($reqfrom_addr) {
           $this->from_addr = $reqfrom_addr;
    }
    function getbody() {
           return $this->body;
    }
    function setbody ($reqbody) {
           $this->body = $reqbody;
    }
    function getuserid() {
           return $this->userid;
    }
    function setuserid ($requserid) {
           $this->userid = $requserid;
    }
    function getcreate_date() {
           return $this->create_date;
    }
    function setcreate_date ($reqcreate_date) {
           $this->create_date = $reqcreate_date;
    }
    function getsubject() {
           return $this->subject;
    }
    function setsubject ($reqsubject) {
           $this->subject = $reqsubject;
    }

//***************************************** email*****************************************//
      function addmails() {
       //echo "I am here";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'email' for update";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $create_date = "'" . date("y-m-d") . "'";
        $to_addrs = "'" . $this->to_addrs . "'";
        $cc_addrs  = "'" . $this->cc_addrs  . "'";
        $bcc_addrs  = "'" . $this->bcc_addrs  . "'";
        $from_addr  = "'" . $this->from_addr  . "'";
        $subject  = "'" . $this->subject  . "'";
        $body  = "'" . $this->body  . "'";
        $userid = "'" . $this->userid . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $sql = "select * from email where rec_num = $objid";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        email
                            (
                            recnum,
                            to_addrs,
                            cc_addrs,
                            bcc_addrs,
                            from_addr,
                            subject,
                            body,
                            userid,
                            create_date
                            )
                    VALUES
                            (
                            $objid,
                            $to_addrs ,
                            $cc_addrs ,
                            $bcc_addrs ,
                            $from_addr,
                            $subject,
                            $body ,
                            $userid ,
                            $create_date )";
//echo "I am here";
//echo $sql;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Sending email didn't work..Please report to Sysadmin. " . mysql_error());
         }
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("mail ID " . $objid . " already exists. ");
         }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'email'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
//echo " <br>objid: $objid<br>";
return $objid;
     }

     function getmails() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT
                  recnum,
                  to_addrs ,
                  cc_addrs ,
                  bcc_addrs ,
                  from_addr,
                  subject,
                  body ,
                  userid ,
                  create_date
                FROM email";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;

     }
     function getemail($emailrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select
                  recnum,
                  to_addrs ,
                  cc_addrs ,
                  bcc_addrs ,
                  from_addr,
                  subject,
                  body ,
                  userid ,
                  create_date
                FROM `email`
                  where  email.recnum = $emailrecnum";
        $result = mysql_query($sql);

        return $result;
     }

     function updateemail($emailrecnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $to_addrs = "'" . $this->to_addrs . "'";
        $cc_addrs = "'" . $this->cc_addrs . "'";
        $bcc_addrs = "'" . $this->bcc_addrs . "'";
        $from_addr = "'" . $this->from_addr . "'";
        $body = "'" . $this->body . "'";
        $subject = "'" . $this->subject . "'";
        $userid = "'" . $this->userid . "'";
        $username = "'" . $_SESSION["user"] . "'";

        $sql = "UPDATE email SET
                    to_addrs = $to_addrs,
                    cc_addrs = $cc_addrs,
                    bcc_addrs = $bcc_addrs,
                  from_addr=$from_addr,
                  body =$body ,
                  subject =$subject ,
                  userid=$userid
          WHERE
                    recnum = $emailrecnum ";
//echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("email update failed...Please report to SysAdmin. " . mysql_error());
        }

 function deleteEmail($emailrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from email where recnum = $emailrecnum";
        $result = mysql_query($sql);
        if(!$result) die("Delete for email failed...Please report to SysAdmin. " . mysql_error());
      }

 function sendWOEmail($inpwonum) {
        $wonum = $inpwonum;
        $sql = "select email from employee
                     where role = 'SU'";
        $result = mysql_query($sql);
        if(!$result) die(" Email - New WO Status email failed..Please report to Sysadmin " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $to = $myrow[0];
        while ($myrow = mysql_fetch_row($result)) {
             $to = $myrow[0] . "," . $to;
        }
        $from = 'donotreply@dci-us.com';
        $subject = "'" . "New Work Order Entered:" . $wonum . "'";
        $message = "'" . "New Work Order Entered:" . $wonum . "'";
//        mail($to,$subject,$message);
        if (@mail($to, $subject, $message, "From:$from")) { }
        else {
          echo('<tr><td>New wO Email could not be sent.Please report to sysadmin</td></tr>');
        }
      }

function sendWOStatusEmail($inpworecnum,$inpwostatus) {
        $worecnum = $inpworecnum;
        $wostatus = $inpwostatus;

        $sql = "select wonum from work_order where recnum = $worecnum";
        $result = mysql_query($sql);
        if(!$result) die(" Email - WO access failed..Please report to Sysadmin " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $wonum = $myrow[0];
        $sql = "select email from employee
                     where role = 'SU'";
        $result = mysql_query($sql);
        if(!$result) die("Status Email - SU access failed..Please report to Sysadmin " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $to = $myrow[0];
        while ($myrow = mysql_fetch_row($result)) {
             $to = $myrow[0] . "," . $to;
        }

//===============Added this for customer email =============
        $sql = "select c.email
                            from work_order w, contact c
                            where  c.recnum = w.wo2contact and
                                   w.recnum = $worecnum";
        $result = mysql_query($sql);
        if(!$result) die(" Status Email - Contact access failed..Please report to Sysadmin " . mysql_error());
        while ($myrow = mysql_fetch_row($result)) {
             $to = $myrow[0] . "," . $to;
        }
        $sql = "select c.email
                            from work_order w, contact c
                            where  c.contact2company = w.wo2customer and
                                   c.role = 'SU' and
                                   w.recnum = $worecnum";
        $result = mysql_query($sql);
        if(!$result) die(" Status Email - Contact SU access failed..Please report to Sysadmin " . mysql_error());
        while ($myrow = mysql_fetch_row($result)) {
             $to = $myrow[0] . "," . $to;
        }
//==========================================================

        $from = 'donotreply@dci-us.com';
        $subject = "'" . "Work Order: " . $wonum . ":" . $wostatus .  "'";
        $message = "'" . "Work Order: " . $wonum . " is at " . $wostatus .  "'";
//        mail($to,$subject,$message);
        if (@mail($to, $subject, $message, "From:$from")) { }
        else {
          echo('<tr><td>Status Email could not be sent.Please report to sysadmin</td></tr>');
        }
      }


  //===============Added this for Change Ship Date email =============

  function sendShipchngEmail($inpwonum,$prevdate,$currdate) {
          $wonum = $inpwonum;
        $to = '';
        $sql = "select c.email
                            from work_order w, contact c
                            where  c.recnum = w.wo2contact and
                                   w.wonum = '$wonum'";
        $result = mysql_query($sql);
        if(!$result) die(" New WO Email - Contact access failed..Please report to Sysadmin " . mysql_error());
        while ($myrow = mysql_fetch_row($result)) {
             $to = $myrow[0] . "," . $to;
        }
 //        $from = 'donotreply@dci-us.com';
//        $cc = 'aubrey@dci-us.com';
        $header = "From:donotreply@dci-us.com";
        $header .= "\ncc:aubrey@dci-us.com";
        $subject = "'" . "Change in ship Date" . "'";
        $message = "'" . "Ship Date:" . $prevdate . "Changed To " . $currdate . "with our WO# " . $wonum . "'";
//        mail($to,$subject,$message);
        if (@mail($to, $subject, $message, $header)) { }
        else {
          echo('<tr><td>Change in Ship Date Email  to Customer could not be sent.Please report to sysadmin</td></tr>');
        }
        }

          //===============Added this for Ship Date email =============

  function sendShipEmail($inpwonum,$sdate) {
          $wonum = $inpwonum;
        $to = '';
        $sql = "select c.email
                            from work_order w, contact c
                            where  c.recnum = w.wo2contact and
                                   w.wonum = '$wonum'";
        $result = mysql_query($sql);
        if(!$result) die(" New WO Email - Contact access failed..Please report to Sysadmin " . mysql_error());
        while ($myrow = mysql_fetch_row($result)) {
             $to = $myrow[0] . "," . $to;
        }
        $sql = "select c.email
                            from work_order w, contact c
                            where  c.contact2company = w.wo2customer and
                                   c.role = 'SU' and
                                   w.wonum = '$wonum'";
        $result = mysql_query($sql);
        if(!$result) die(" New WO Email - Contact SU access failed..Please report to Sysadmin " . mysql_error());
        while ($myrow = mysql_fetch_row($result)) {
             $to = $myrow[0] . "," . $to;
        }
//        $from = 'donotreply@dci-us.com';
        $subject = "'" . "Ship Date" . "'";
        $message = "'" . "Ship Date is  : " . $sdate . "with our WO# " . $wonum . "'";
//          mail($to,$subject,$message);
        if (@mail($to, $subject, $message)) { }
        else {
          echo('<tr><td>Ship Date Email  to Customer could not be sent.Please report to sysadmin</td></tr>');
        }
        }
//==========================================================


     function sendWOStatusEmail1($inpwonum,$inpwostatus) {
        $wonum = $inpworecnum;
        $wostatus = $inpwostatus;

        $sql = "select email from employee
                     where role = 'SU'";
        $result = mysql_query($sql);
        if(!$result) die(" Email - Status WO access failed..Please report to Sysadmin " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $to = $myrow[0];
        while ($myrow = mysql_fetch_row($result)) {
             $to = $myrow[0] . "," . $to;
        }
        $from = 'donotreply@dci-us.com';
        $subject = "'" . "Work Order: " . $wonum . ":" . $wostatus .  "'";
        $message = "'" . "Work Order: " . $wonum . " is at " . $wostatus .  "'";
//        mail($to,$subject,$message);
        if (@mail($to, $subject, $message, "From:$from")) { }
        else {
          echo('<tr><td>Status1 Email could not be sent.Please report to sysadmin</td></tr>');
        }
      }

     function custEmail($wonum,$text) {

        $userid = "'" . $_SESSION['user'] . "'";
        $to = '';
        $sql = "select c.email from user u, contact c
                     where u.userid = $userid and
                           u.user2contact = c.recnum";
        $result = mysql_query($sql);
        if(!$result) die("Customer Email Contact access failed..Please report to Sysadmin " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $from = "'" . $myrow[0] . "'";
        $sql = "select email from employee
                     where role = 'SU'";
        $result = mysql_query($sql);
        if(!$result) die(" Customer Email Emp access failed.Please report to Sysadmin " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $to = $myrow[0];
        while ($myrow = mysql_fetch_row($result)) {
             $to = $myrow[0] . "," . $to;
        }
//        $to = oms@dci.com
        $subject = "'" . "Customer Email about WO:" . $wonum . "'";
        $message = "'" . "$text" . "'";
//        mail($to,$subject,$message);
        if (@mail($to, $subject, $message, "From:$from")) { }
        else {
          echo('<tr><td>Unable to send Email.Please report to sysadmin</td></tr>');
        }
      }

} // End email class definition