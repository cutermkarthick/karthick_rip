<?
//====================================
// Author: FSI
// Date-written = march 23, 2007
// Filename: dataliClass.php
// Maintains the class for data sheet Line items
// Revision: v1.0
//====================================

include_once('loginClass.php');

class datasheet_line_items {

    var
     $linenum,
     $tool_details,
     $tool_length,
     $speed,
     $feed,
     $opn_desc,
     $cnc_pgm_name,
     $est_time,
     $link2ds;



    // Constructor definition
    function datasheet_line_items() {
        $this->linenum = '';
        $this->tool_details = '';
        $this->tool_length = '';
        $this->speed = '';
        $this->feed = '';
        $this->opn_desc = '';
        $this->cnc_pgm_name = '';
        $this->est_time = '';
        $this->link2ds = '';
     }

// Property get and set
    function getlinenum() {
           return $this->linenum;
    }

    function setlinenum ($reqlinenum) {

           $this->linenum = $reqlinenum;
    }

    function gettool_details() {
           return $this->tool_details;
    }

    function settool_details ($reqtooldetails) {
           $this->tool_details = $reqtooldetails;
    }

    function gettool_length() {
           return $this->tool_length;
    }
    function settool_length ($reqtoollength) {
           $this->tool_length = $reqtoollength;
    }

    function getspeed() {
           return $this->speed;
    }

    function setspeed ($reqspeed) {
           $this->speed = $reqspeed;
    }
    function getfeed() {
           return $this->feed;
    }

    function setfeed ($reqfeed) {
           $this->feed = $reqfeed;
    }
    function getopn_desc() {
           return $this->opn_desc;
    }

    function setopn_desc ($reqopndesc) {
           $this->opn_desc = $reqopndesc;
    }

    function getcnc_pgm_name() {
           return $this->cnc_pgm_name;
    }

    function setcnc_pgm_name ($reqcncpgmname) {
           $this->cnc_pgm_name = $reqcncpgmname;
    }

    function getest_time() {
           return $this->est_time;
    }

    function setest_time($reqest_time) {
           $this->est_time = $reqest_time;
    }
    
    function getlink2ds() {
           return $this->link2ds;
    }

    function setlink2ds ($reqlink2ds) {
           $this->link2ds = $reqlink2ds;
    }




    function addLI() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'datasheet_line_items' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for dataLi..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        //$crdate = "'" . date("y-m-d") . "'";

        
        $linenum =  $this->linenum ;
        $tool_details = "'" . $this->tool_details . "'";
        $tool_length =  $this->tool_length ;
        $speed = $this->speed;
        $feed = $this->feed ;
        $opn_desc = "'" . $this->opn_desc . "'";
        $cnc_pgm_name = "'" . $this->cnc_pgm_name . "'";
        $est_time = "'" . $this->est_time . "'";
        $link2ds = $this->link2ds;
        
        $sql = "INSERT INTO datasheet_line_items (recnum, linenum, tool_details, tool_length, speed, feed, opn_desc, cnc_pgm_name, link2ds, est_time)
               VALUES ($objid, $linenum, $tool_details, $tool_length, $speed, $feed, $opn_desc, $cnc_pgm_name, $link2ds, $est_time)";
       // echo $sql;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to LI didn't work..Please report to Sysadmin. " . mysql_error());
        }
        $sql = "update seqnum set nxtnum = $objid where tablename = 'datasheet_line_items'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for datasheet_line_items..Please report to Sysadmin. " . mysql_error());
        }
        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Commit failed for datasheet_line_items Insert..Please report to Sysadmin. " . mysql_error());
        }
     }

    function updateLI($recnum) {
        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $linenum =  $this->linenum ;
        $tool_details = "'" . $this->tool_details . "'";
        $tool_length =  $this->tool_length ;
        $speed = $this->speed;
        $feed = $this->feed ;
        $opn_desc = "'" . $this->opn_desc . "'";
        $cnc_pgm_name = "'" . $this->cnc_pgm_name . "'";
        $est_time = "'" . $this->est_time . "'";


        $sql = "update datasheet_line_items
                          set linenum = $linenum,
                              tool_details = $tool_details,
                              tool_length = $tool_length,
                              speed = $speed,
                              feed = $feed,
                              opn_desc = $opn_desc,
                              cnc_pgm_name = $cnc_pgm_name,
                              est_time = $est_time
                        where recnum = $lirecnum";

           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to data sheet li didn't work..Please report to Sysadmin. " . mysql_error());

     }


     function getLI($inpdsrecnum) {
        $dsrecnum = "'" . $inpdsrecnum . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select d.linenum, d.tool_details, d.tool_length,
                       d.speed, d.feed, d.opn_desc, d.cnc_pgm_name, d.recnum, d.est_time
                   from datasheet_line_items d
                   where link2ds = $dsrecnum";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }


     function deleteLI($inplirecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $lirecnum = "'" . $inplirecnum . "'";
        $sql = "delete from po_line_items where recnum = $lirecnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Line Items failed...Please report to SysAdmin. " . mysql_error());
      }

} // End masterliclass definition


