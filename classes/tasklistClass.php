<?
//====================================
// Author: FSI
// Date-written = September 20, 2006
// Filename: tasklistClass.php
// Maintains the class for tasklist
// Revision: v1.0  OWT
//====================================
include_once('loginClass.php');
class tasklist {

    var
        $recnum,
        $link2tasklist_time,
        $link2user,
        $task,
        $task1,
        $task2,
        $task3,
        $task4,
        $task5,
        $task6,
        $task7,
        $task8,
        $date,
        $taskdate,
        $userid,
        $notes_label,
        $event_notes,
        $notes_create_date;
    // Constructor definition
    function tasklist() {
        $this->recnum = '';
        $this->link2tasklist_time = '';
        $this->link2user = '';
        $this->date = '';
        $this->taskdate = '';
        $this->task = '';
        $this->task1 = '';
        $this->task2 = '';
        $this->task3 = '';
        $this->task4 = '';
        $this->task5 = '';
        $this->task6 = '';
        $this->task7 = '';
        $this->task8 = '';
        $this->userid = '';
        $this->notes_label = '';
        $this->event_notes = '';
        $this->notes_create_date = '';
    }

    // Property get and set
    function getdate() {
           return $this->date;
    }

    function setdate ($reqdate) {
           $this->date= $reqdate;
    }
    function gettaskdate() {
           return $this->taskdate;
    }

    function settaskdate ($reqtaskdate) {
           $this->taskdate= $reqtaskdate;
    }
    function getlink2tasklist_time() {
           return $this->link2tasklist_time;
    }
    function setlink2tasklist_time ($reqlink2tasklist_time) {
           $this->link2tasklist_time = $reqlink2tasklist_time;
    }

    function gettask() {
           return $this->task;
    }
    function settask($reqtask) {
           $this->task = $reqtask;
    }

    function gettask1() {
           return $this->task1;
    }
    function settask1 ($reqtask1) {
           $this->task1 = $reqtask1;
    }

    function gettask2() {
           return $this->task2;
    }
    function settask2 ($reqtask2) {
           $this->task2 = $reqtask2;
    }
    function gettask3() {
           return $this->task3;
    }
    function settask3 ($reqtask3) {
           $this->task3 = $reqtask3;
    }
     function settask4 ($reqtask4) {
           $this->task4 = $reqtask4;
    }
    function gettask5() {
           return $this->task5;
    }
    function settask5 ($reqtask5) {
           $this->task5 = $reqtask5;
    }
    function gettask6() {
           return $this->task6;
    }
    function settask6 ($reqtask6) {
           $this->task6 = $reqtask6;
    }
    function gettask7() {
           return $this->task7;
    }
    function settask7 ($reqtask7) {
           $this->task7 = $reqtask7;
    }
    function gettask8() {
           return $this->task8;
    }
    function settask8 ($reqtask8) {
           $this->task8 = $reqtask8;
    }
    function getlink2user() {
           return $this->link2user;
    }
    function setlink2user ($reqlink2user) {
           $this->link2user = $reqlink2user;
    }

   function getuserid() {
           return $this->userid;
    }
    function setuserid ($requserid) {
           $this->userid = $requserid;
    }

    function setevent_date ($notes_create_date) {
           $this->notes_create_date = $notes_create_date;
    }
    function setnotes_label ($notes_label) {
           $this->notes_label = $notes_label;
    }
    function setevent_notes ($event_notes) {
           $this->event_notes = $event_notes;
    }

//***************************************** tasklist*****************************************//
      function addtasklist() {
        //echo "I am here";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'tasklist' for update";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        //echo $seqnum;
        $objid = $seqnum + 1;
        $taskdate = "'" . $this->taskdate . "'";
        //$date = "'" . $this->date . "'";
        $date = "'" . date("Y-m-d-H:i:s") . "'";
        $link2tasklist_time = "'" . $this->link2tasklist_time . "'";
        $link2user  = "'" . $this->link2user  . "'";
        $userid = "'" . $this->userid . "'";
        $task1 = "'" . $this->task1 . "'";
        $task2 = "'" . $this->task2 . "'";
        $task3 = "'" . $this->task3 . "'";
        $task4 = "'" . $this->task4 . "'";
        $task5 = "'" . $this->task5 . "'";
        $task6 = "'" . $this->task6 . "'";
        $task7 = "'" . $this->task7 . "'";
        $task8 = "'" . $this->task8 . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $sql = "select * from tasklist where recnum = $objid";
        // echo $sql;
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        tasklist
                          (
                            recnum,
                            task1,
                            task2,
                            task3,
                            task4,
                            task5,
                            task6,
                            task7,
                            task8,
                            date,
                            taskdate,
                            userid
                            )
                    VALUES
                            (
                            $objid,
                            $task1,
                            $task2,
                            $task3,
                            $task4,
                            $task5,
                            $task6,
                            $task7,
                            $task8,
                            $date,
                            $taskdate,
                            $userid )";
//echo "I am here";
//echo $sql;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("tasklist didn't work..Please report to Sysadmin. " . mysql_error());
        }
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("mail ID " . $objid . " already exists. ");
        }
         $sql = "update seqnum set nxtnum = $objid where tablename = 'tasklist'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
        //echo " <br>objid: $objid<br>";
        return $objid;
     }


     function getasklists() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT
                  recnum,
                  task1,
                  task2,
                  task3,
                  task4,
                  task5,
                  task6,
                  task7,
                  task8,
                  userid ,
                  taskdate,
                  date
                FROM tasklist";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;
     }
     function getasklist($tasklistrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select
                  recnum,
                  userid ,
                  task1,
                  task2,
                  task3,
                  task4,
                  task5,
                  task6,
                  task7,
                  task8,
                  taskdate,
                  date
                FROM tasklist
                  where  tasklist.recnum = $tasklistrecnum";
        $result = mysql_query($sql);
        return $result;
     }

  function updatetasklist($tasklistrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $task1 = "'" . $this->task1 . "'";
        $task2 = "'" . $this->task2 . "'";
        $task3 = "'" . $this->task3 . "'";
        $task4 = "'" . $this->task4 . "'";
        $task5 = "'" . $this->task5 . "'";
        $task6 = "'" . $this->task6 . "'";
        $task7 = "'" . $this->task7 . "'";
        $task8 = "'" . $this->task8 . "'";
         $sql = "UPDATE tasklist SET
                    task1 = $task1,
                    task2 = $task2,
                    task3 = $task3,
            	    task4 = $task4,
            	    task5 = $task5,
            	    task6 = $task6,
            	    task7 = $task7,
                    task8 = $task8
        	WHERE
                    recnum = $tasklistrecnum";
//echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("tasklist update failed...Please report to SysAdmin. " . mysql_error());
        }

     function deletetasklists($tasklistrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from tasklist where recnum = $tasklistrecnum";
        $result = mysql_query($sql);
        if(!$result) die("Delete for tasklist failed...Please report to SysAdmin. " . mysql_error());
      }





     function getAccounts($cond,$argsort1,$argoffset,$arglimit)
      {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;
       $sql = "select recnum,
                  task1,
                  task2,
                  task3,
                  task4,
                  task5,
                  task6,
                  task7,
                  task8,
                  userid ,
                  taskdate,
                  date
                   from tasklist where  $wcond ORDER by $sortorder limit $offset, $limit";
echo "$sql";
       $result = mysql_query($sql);
       return $result;
}

//Function for pagination coded by Jerry George 30 Dec -04
function getcompCount($cond,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
             $sql = "select count(*) as numrows
                     from tasklist where  $wcond limit $offset, $limit";
       $newlogin = new userlogin;
       $newlogin->dbconnect();
//echo "$sql";
       $result  = mysql_query($sql) or die('Emp count query failed');
       $row     = mysql_fetch_array($result, MYSQL_ASSOC);
       $numrows = $row['numrows'];
       return $numrows;
}


//---------------------------------------add notes--------------------------------------------------------------------------------------------------

//Function for addnotes coded by Suresh

function getNotes($inptaskrecnum,$a){
        $newlogin = new userlogin;
        $newlogin->dbconnect();

         $userrole = $_SESSION['userrole'];
         $userid = $_SESSION['user'];
         $userrecnum = $_SESSION['userrecnum'];
         $tasklistrecnum = $inptaskrecnum;
         $task = $a;
                $sql = "select n.create_date, n.notes, u.userid ,n.task
                     from task_notes n, user u, tasklist l
                     where n.notes2task = l.recnum and
                           notes2user = u.recnum and
                           l.recnum = $tasklistrecnum and
                           n.task= '$task' ";

        $result = mysql_query($sql);
        return $result;

     }



 function updNotes($tasklistrecnum,$pagename)
     {
        $userrole = $_SESSION['userrole'];
        $userid = $_SESSION['user'];
        $usertype = $_SESSION['usertype'];
        if ($usertype == 'EMPL') {
           //echo'<a href="addNotes4leads.php?type=' . $pagename . '&tasklistrecnum=' . $leadsrecnum . '" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'Image118\',\'\',\'images/addnotes_mo.gif\',1)"><img name="Image118" border="0" src="images/addnotes.gif" hspace=4></a>';
           //echo '</td></tr><tr width=100% bgcolor="DEDEDF"><td height="10"><img width="50" src="images/spacer.gif" height="1"><td align="right"><img src="images/box-right-top.gif"></td></td></tr>';
        }
    }


 function addNotes($tasklistrecnum,$notes)
    {
        // Connect to database
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $create_date = "'" . date("y-m-d") . "'";
        $userid = $_SESSION['user'];
        $task = "'" . $this->task . "'";
        $userrecnum = $_SESSION['userrecnum'];
        $sql = "select nxtnum from seqnum where tablename = 'task_notes'";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $specinstrns = "'" . $notes . "'";
        $sql = "INSERT INTO task_notes (recnum, notes,notes2task, notes2user,create_date,task )
               VALUES ($objid, $specinstrns, $tasklistrecnum, $userrecnum, $create_date,$task)";
//echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Insert of Notes didn't work. " . mysql_error());

        $sql = "update seqnum set nxtnum = $objid where tablename = 'task_notes'";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert for notes table didn't work. " . mysql_error());

     }



    public function addevent_notes($recnum='')
    {
      
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      $notes_label="'". $this->notes_label ."'";
      $event_notes="'". $this->event_notes ."'";
      $notes_create_date="'". $this->notes_create_date ."'";

        $sql = "INSERT INTO 
                  event_notes
                  (notes_label,
                  notes,
                  create_date,
                  notes2user)
                VALUES ($notes_label,
                  $event_notes,
                  $notes_create_date,
                  $recnum)";
      // echo "$sql <br>"; exit;
      $result = mysql_query($sql);
      return $result;

    }

    function get_eventnotes4SU($notes_create_date)
    { 

      // echo "created_date $notes_create_date <br>"; exit;
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $notes_create_date = "'" . $notes_create_date . "'";

        $sql="select 
                u.userid,
                en.recnum,
                en.notes_label,
                en.notes,
                en.create_date
              from 
                user u, 
                event_notes en
              where 
                en.notes2user = u.recnum and 
                en.create_date= $notes_create_date ";

          // echo "$sql";
          $result = mysql_query($sql);
          return $result;
    }

    function querynotes($inprecnum)
    {
        $sql = "select 
                  notes_label,
                  notes
                from
                  event_notes
                where
                  recnum=$inprecnum";

        $result = mysql_query($sql);
        return $result;
    }


    function get_eventnotes4month($firstday,$lastday)
    { 

      // echo "created_date $notes_create_date <br>"; exit;
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $notes_create_date = "'" . $notes_create_date . "'";

        $sql="select 
                u.userid,
                en.recnum,
                en.notes_label,
                en.notes,
                en.create_date
              from 
                user u, 
                event_notes en
              where 
                en.notes2user = u.recnum ";


            // and  en.create_date BETWEEN '$firstday' AND '$lastday'

          // echo "$sql";
          $result = mysql_query($sql);
          return $result;
    }




} // End tasklist class definition
