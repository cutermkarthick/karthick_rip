<?

//====================================
// Author: FSI
// Date-written = May 27, 2005
// Filename: vendPartClass.php
// Maintains the class for Vendor Parts
// Revision: v1.0
//====================================

include_once('loginClass.php');

class newsEntry {

    var $created_by,
        $date,
        $descr;
       

    // Constructor definition

    function taskEntry() {
        $this->created_by = '';
        $this->date = '';
        $this->descr = '';
        // $this->taskcompleted_date = '';
        
    }

    function getcreated_by () {
           return $this->created_by;
    }
    function setcreated_by ($reqcreated_by) {
           $this->created_by = $reqcreated_by;
    }

    function getdate () {
           return $this->date;
    }
    function setdate ($reqdate) {
           $this->date = $reqdate;
    }

   function getdescr () {
           return $this->descr;
    }
    function setdescr ($reqdescr) {
           $this->descr = $reqdescr;
    }

   function addNews()
    {

      // echo $taskcreate_date;exit;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);

        $sql = "select nxtnum from seqnum where tablename = 'News' for update";
        $result = mysql_query($sql);

        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);

        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $created_by = "'" . $this->created_by . "'";
        $date = "'" . $this->date . "'";
        $descr = "'" . $this->descr . "'";
        $sql = "INSERT INTO
		      news (recnum, created_by, date ,descr)
                  VALUES
		          ($objid, $created_by, $date,$descr)";
// echo "$sql";
              $result = mysql_query($sql);

        // Test to make sure query worked
         if(!$result) die("Task Entry query didn't work for task..Please report to Sysadmin. " . mysql_error());
                    
        $sql = "update seqnum set nxtnum = $objid where tablename = 'News'";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work for vend_part_master..Please report to Sysadmin. " . mysql_error());
        $sql = "commit";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Commit failed for vend_part_master Insert..Please report to Sysadmin. " . mysql_error());
        return $objid;
     }




     function getNews() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select * from news order by date desc";
// echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Access to vend_part_master failed...Please report to SysAdmin. " . mysql_error());
        return $result;
     }


} // End Part class definition
