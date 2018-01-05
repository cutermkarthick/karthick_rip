<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: quoteClass.php
// Maintains the class for Quotes
// Revision: v1.0
//====================================

include_once('loginClass.php');

class process_details {

    var  $partnum,
         $part_tasks,
         $mfg_cycle_time,
         $inspection_time;

    // Constructor definition
    function process_details() {
        $this->partnum = '';
        $this->part_tasks = '';
        $this->mfg_cycle_time = '';
        $this->inspection_time = '';
    }

    // Property get and set
    function getpartnum() {
           return $this->partnum;
    }

    function setpartnum ($partnum) {
           $this->partnum = $partnum;
    }

    function getpart_tasks() {
           return $this->part_tasks;
    }

    function setpart_tasks ($part_tasks) {
           $this->part_tasks = $part_tasks;
    }
    function getmfg_cycle_time() {
           return $this->mfg_cycle_time;
    }

    function setmfg_cycle_time ($mfg_cycle_time) {
           $this->mfg_cycle_time = $mfg_cycle_time;
    }

    function getinspection_time() {
           return $this->inspection_time;
    }

    function setinspection_time ($inspection_time) {
           $this->inspection_time = $inspection_time;
    }


    function addprocess_details() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'process_details' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

         $partnum = "'" . $this->partnum . "'";
         $part_tasks = "'" . $this->part_tasks . "'";
         $mfg_cycle_time = "'" . $this->mfg_cycle_time . "'";
         $inspection_time = "'" . $this->inspection_time . "'";

        $sql = "select * from process_details where recnum = $objid";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                    process_details
                           (recnum,
                            partnum,
                            part_tasks,
                            mfg_cycle_time,
                            inspection_time)
                     VALUES
                           ($objid,
                            $partnum,
                            $part_tasks,
                            $mfg_cycle_time,
                            $inspection_time)";
        //echo $sql;
           $result = mysql_query($sql);

           $sql = 'commit';
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to process_details didn't work..Please report to Sysadmin. " . mysql_error());
         }
    else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("objid " . $objid . " already exists. ");
         }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'process_details'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
        //echo " <br>objid: $objid<br>";
         return $objid;
     }

     function getallprocess_details() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();


           $sql= "select recnum, partnum, part_tasks, mfg_cycle_time, inspection_time
                    from process_details";

       //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

     function getprocess_details($process_detailsrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();


           $sql= "select recnum, partnum, part_tasks, mfg_cycle_time, inspection_time
                    from process_details where recnum=$process_detailsrecnum";

       //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }


     function updateprocess_details($process_detailsrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

         $partnum = "'" . $this->partnum . "'";
         $part_tasks = "'" . $this->part_tasks . "'";
         $mfg_cycle_time = "'" . $this->mfg_cycle_time . "'";
         $inspection_time = "'" . $this->inspection_time . "'";

        $sql = "UPDATE process_details SET
                     partnum=$partnum,
                     part_tasks=$part_tasks,
                     mfg_cycle_time=$mfg_cycle_time,
                     inspection_time=$inspection_time
        	    WHERE
                    recnum = $process_detailsrecnum";
   // echo $sql;
        $result = mysql_query($sql);

        $sql = 'commit';
        $result = mysql_query($sql);
        if(!$result) die("process_details update failed...Please report to SysAdmin. " . mysql_error());
        }



} // End quoteclass definition

