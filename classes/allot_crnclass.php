<?
//====================================
// Author: FSI
// Date-written = july 04, 2007
// Filename: nc4storesClass.php
// Maintains the class for nc4stores
//====================================

include_once('loginClass.php');

class allot_crn {
    var
    $refnum,
    $partnum,
    $partname,
    $attachments,
    $drg_issue;

    // Constructor definition
    function allot_crn() {
        $this->refnum = '';
        $this->partnum = '';
        $this->partname = '';
        $this->attachments = '';
        $this->drg_issue = '';
     }

    function getrefnum() {
           return $this->refnum;
    }
    function setrefnum ($refnum) {
           $this->refnum = $refnum;
    }

    function getpartnum() {
           return $this->partnum;
    }
    function setpartnum($partnum) {
           $this->partnum = $partnum;
    }

    function getpartname() {
           return $this->partname;
    }
    function setpartname ($partname) {
           $this->partname = $partname;
    }

    function getattachments() {
           return $this->attachments;
    }
    function setattachments($attachments) {
           $this->attachments = $attachments;
    }

    function getdrg_issue() {
           return $this->drg_issue;
    }
    function setdrg_issue($drg_issue) {
           $this->drg_issue = $drg_issue;
    }

       function addallot_crn() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'allot_crn' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

         $refnum = "'" . $this->refnum . "'";
         $partnum = "'" . $this->partnum . "'";
         $partname = "'" . $this->partname . "'";
         $attachments = "'" . $this->attachments . "'";
         $drg_issue = "'" . $this->drg_issue . "'";

        $sql = "select * from allot_crn where refnum = $refnum";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {

           $sql = "INSERT INTO
                        allot_crn
                           (recnum,
                            refnum,
                            partnum,
                            partname,
                            attachments,
                            drg_issue)
                     VALUES
                           ($objid,
                            $refnum,
                            $partnum,
                            $partname,
                            $attachments,
                            $drg_issue)";
        //echo $sql;
           $result = mysql_query($sql);
           
           $sql = "commit";
           $result = mysql_query($sql);
           
           // Test to make sure query worked
           if(!$result) die("Insert to allot_crn didn't work..Please report to Sysadmin. " . mysql_error());
         }
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Ref Num " . $refnum . " already exists. ");
         }

        $sql = "start transaction";
        $result = mysql_query($sql);

        $sql = "update seqnum set nxtnum = $objid where tablename = 'allot_crn'";
        $result = mysql_query($sql);
        
        $sql = "commit";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
        //echo " <br>objid: $objid<br>";
         return $objid;
     }

     function getallotcrns() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,refnum,partnum,partname,attachments,drg_issue
                  FROM allot_crn";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;

     }


     function getallotcrn($allot_crnrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = " select recnum,
                       refnum,
                       partnum,
                       partname,
                       attachments,
                       drg_issue
            FROM allot_crn
            where recnum = $allot_crnrecnum";
//echo $sql;
        $result = mysql_query($sql);

        return $result;
     }

     function updateallot_crn($allot_crnrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

         $refnum = "'" . $this->refnum . "'";
         $partnum = "'" . $this->partnum . "'";
         $partname = "'" . $this->partname . "'";
         $attachments = "'" . $this->attachments . "'";
         $drg_issue = "'" . $this->drg_issue . "'";

       $sql = "UPDATE allot_crn SET
                    refnum = $refnum,
                    partnum = $partnum,
                    partname = $partname,
                    attachments = $attachments,
                    drg_issue = $drg_issue

        	WHERE
                    recnum = $allot_crnrecnum";
       // echo $sql;
        $result = mysql_query($sql);
        
        $sql = "commit";
        $result = mysql_query($sql);

        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv5");
                     die("allot_crn update failed...Please report to SysAdmin. " . mysql_error());
                     }
        }


    function deleteallot_crn($allot_crnrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from allot_crn where recnum = $allot_crnrecnum";
        $result = mysql_query($sql);
        
        $sql = "commit";
        $result = mysql_query($sql);
        
        if(!$result)
                     {
                      //header("Location:errorMessage.php?validate=Inv6");
                      die("Delete for allot_crn failed...Please report to SysAdmin. " . mysql_error());
                     }
      }

} // End invoice class definition

