<?

//====================================
// Author: FSI
// Date-written = May 27, 2005
// Filename: vendPartClass.php
// Maintains the class for Vendor Parts
// Revision: v1.0
//====================================

include_once('loginClass.php');

class taskEntry {

    var $taskid,
        $taskname,
        $taskcreate_date,
        $taskcompleted_date;

    // Constructor definition

    function taskEntry() {
        $this->taskid = '';
        $this->taskname = '';
        $this->taskcreate_date = '';
        $this->taskcompleted_date = '';
        
    }

    function gettaskid () {
           return $this->taskid;
    }
    function settaskid ($reqtaskid) {
           $this->taskid = $reqtaskid;
    }

    function gettaskname () {
           return $this->taskname;
    }
    function settaskname ($reqtaskname) {
           $this->taskname = $reqtaskname;
    }

   function gettaskcreate_date () {
           return $this->taskcreate_date;
    }
    function settaskcreate_date ($reqtaskcreate_date) {
           $this->taskcreate_date = $reqtaskcreate_date;
    }

    function gettaskcompleted_date () {
           return $this->taskcompleted_date;
    }
    function settaskcompleted_date ($reqtaskcompleted_date) {
           $this->taskcompleted_date = $reqtaskcompleted_date;
    }
    
 function addTask()
    {

      // echo $taskcreate_date;exit;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);

        $sql = "select nxtnum from seqnum where tablename = 'task' for update";
        $result = mysql_query($sql);

        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);

        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $taskid = "'" . $this->taskid . "'";
        $taskname = "'" . $this->taskname . "'";
        $taskcreate_date = "'" . $this->taskcreate_date . "'";
        $taskcompleted_date ="'" . $this->taskcompleted_date . "'";
        $sql = "select * from task where task_id = $objid";
        // echo $sql;
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result)))
           {
            $sql = "INSERT INTO
		      task (recnum, task_id, task_name ,taskcreate_date,taskcomp_date)
                  VALUES
		          ($objid, $objid, $taskname,$taskcreate_date,$taskcompleted_date)";
// echo "$sql";exit;
              $result = mysql_query($sql);

        // Test to make sure query worked
         if(!$result) die("Task Entry query didn't work for task..Please report to Sysadmin. " . mysql_error());
           }
            
        $sql = "update seqnum set nxtnum = $objid where tablename = 'task'";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work for vend_part_master..Please report to Sysadmin. " . mysql_error());
        $sql = "commit";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Commit failed for vend_part_master Insert..Please report to Sysadmin. " . mysql_error());
        return $objid;
     }

     function getTasks()
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select * from task order by taskcreate_date desc";
// echo "$sql";
        $result = mysql_query($sql);
       
        // Test to make sure query worked
        if(!$result) die("Access to task failed...Please report to SysAdmin. " . mysql_error());
        return $result;
     }

    function getTasksDetails($taskrecnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select * from task where recnum = $taskrecnum";
// echo "$sql";exit; 
        $result = mysql_query($sql);
       
        // Test to make sure query worked
        if(!$result) die("Access to task failed...Please report to SysAdmin. " . mysql_error());
        return $result;
     }


function UpdateTask($taskrecnum)
{
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $taskname = "'" . $this->taskname . "'";
    $taskcreate_date = "'" . $this->taskcreate_date . "'";
    $taskcompleted_date ="'" . $this->taskcompleted_date . "'";

     $sql = "update task set task_name = $taskname,
                         taskcreate_date = $taskcreate_date,
                         taskcomp_date = $taskcompleted_date
                          where recnum = $taskrecnum";
                          // echo $sql;exit;

      $result = mysql_query($sql);

       if(!$result) die("Update  to task failed...Please report to SysAdmin. " . mysql_error());
        return $result;





  


}

} // End Part class definition
