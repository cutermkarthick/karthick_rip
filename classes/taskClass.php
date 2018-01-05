<?
//====================================
// Author: FSI
// Date-written = April 06, 2010
// Filename: projectClass.php
// Application: Project_management
// Revision: v1.0
//====================================

include_once('loginClass.php');
include_once('../config.php');

class task {
    var $task_id,
        $task_name,
        $category,
        $desc,
        $status,
    		$notes,
    		$customer_notes,
        $priority,
        $start_date,
        $finish_date,
        $assigned_user,
        $estimate_hours,
        $estimate_mins;

// Constructor definition
function task()
{
  $this->task_id = '';
  $this->task_name = '';
  $this->category = '';
  $this->desc = '';
  $this->status = '';   
	$this->notes='';
	$this->customer_notes='';
  $this->priority ='';
  $this->start_date ='';
  $this->finish_date ='';
  $this->assigned_user ='';
  $this->estimate_hours ='';
  $this->estimate_mins ='';
}
function gettask_id() {
           return $this->task_id;
}
function settask_id($req_task_id) {
           $this->task_id= $req_task_id;
}

function gettask_name() {
           return $this->task_name;
}
function settask_name($req_task_name) {
           $this->task_name= $req_task_name;
}

function getcategory() {
           return $this->category;
}
function setcategory($req_category) {
           $this->category= $req_category;
}

function getdesc() {
           return $this->desc;
}
function setdesc($req_desc) {
           $this->desc= $req_desc;
}

function getstatus() {
           return $this->status;
}
function setstatus($req_status) {
           $this->status= $req_status;
}
function getnotes() {
           return $this->notes;
}
function setnotes($req_notes) {
           $this->notes= $req_notes;
}

function getcustomer_notes() {
           return $this->customer_notes;
}
function setcustomer_notes($req_customer_notes) {
           $this->customer_notes= $req_customer_notes;
}

function getpriority() {
           return $this->priority;
}
function setpriority($priority) {
           $this->priority= $priority;
}


function getstart_date() {
           return $this->start_date;
}
function setstart_date($start_date) {
           $this->start_date= $start_date;
}



function getfinish_date() {
           return $this->finish_date;
}
function setfinish_date($finish_date) {
           $this->finish_date= $finish_date;
}

function setassigned_user($assigned_user) {
  $this->assigned_user= $assigned_user;
}

function setestimate_hours($estimate_hours) {
  $this->estimate_hours= $estimate_hours;
}

function setestimate_mins($estimate_mins) {
  $this->estimate_mins= $estimate_mins;
}

function gettask_details($cond) 
{
  $newlogin = new userlogin;
  $newlogin->dbconnect();
  //$newLogin= userlogin::singleton();       
  $wcond = $cond;
  //echo $wcond;
  $siteid = $_SESSION['siteid'];
  $sql = "select  t.recnum,
	                t.task_id,
      						t.task_name,
      						t.category,
      						t.`desc`,
      						t.status,
                  t.priority,
                  t.start_date,
                  t.finish_date,
                  u.userid,
                  u.recnum as userrecnum,
                  t.estimate_hours,
                  t.estimate_mins,
                  t.started_date,
                  t.act_complete_date,
                  e.empid,
                  e.phone					
          from  tasks t, user u, employee e
                $wcond and
                t.userrecnum = u.recnum and
                u.user2employee = e.recnum and
                t.siteid = '$siteid'
          order by recnum";
  // echo "$sql";
  $result = mysql_query($sql);
  if(!$result) die("getTaskDetails query failed..Please report to Sysadmin. " . mysql_error());
  return $result;
}
  function addTask($recnum_project)
  {
    //$newLogin= userlogin::singleton();
    $newlogin = new userlogin;
    $newlogin->dbconnect();	
		 
    $task_id ="'" . $this->task_id . "'";
    $task_name = "'" . $this->task_name . "'";         
		$category =  "'".$this->category ."'";			 
		$desc ="'" .$this->desc . "'";
    $status = "'" . $this->status . "'";      
    $priority = "'" . $this->priority . "'"; 
    $start_date = "'" . $this->start_date . "'"; 
    $finish_date = "'" . $this->finish_date . "'"; 
    $user = $_SESSION['user'] ;
    $assigned_user = "'" . $this->assigned_user . "'"; 
    $estimate_hours = "'" . $this->estimate_hours . "'"; 
		$estimate_mins = "'" . $this->estimate_mins . "'"; 
    $siteid = "'".$_SESSION['siteid']."'";

	  $sql = "select * from tasks where task_id = $task_id";
    $result = mysql_query($sql);
    if (!(mysql_fetch_row($result))) {
		  $sql = "INSERT INTO tasks														
               (task_id,task_name,category,`desc`,status,link2project,
                created_by,created_date,priority,start_date,finish_date,
                userrecnum, estimate_hours, estimate_mins,siteid)
               VALUES 
			   ($task_id,$task_name,$category,$desc,$status,$recnum_project,
          '$user',curdate(),$priority,$start_date,$finish_date,
          $assigned_user, $estimate_hours, $estimate_mins, $siteid)";
	     //echo $sql; exit;

		}
    else
		{
      echo "<table border=1><tr><td><font color=#FF0000>";
      die("Task ID# " . $task_id . " already exists. ");
      echo "</td></tr></table>";
    }
	     

    $result = mysql_query($sql);
    if(!$result) die("Insert to Task didn't work..Please report to Sysadmin. " . mysql_error());

    $tk_split = explode('-', $this->task_id);
    $taskid = $tk_split[1];

    $sql1 = "update seqnum set nxtnum = $taskid where tablename = 'tasks'";
    mysql_query($sql1);
  }

   function UpdateTask($recnum_task,$recnum_project)
   {
    $newlogin = new userlogin;
        $newlogin->dbconnect();
     //$newLogin= userlogin::singleton();       
    
		 $task_id ="'" .$this->task_id . "'";
         $task_name = "'" . $this->task_name . "'";         
		 $category =  "'".$this->category ."'";			 
		 $desc ="'" .$this->desc . "'";
         $status = "'" . $this->status . "'"; 
         $priority = "'" . $this->priority . "'"; 
         $start_date = "'" . $this->start_date . "'"; 
         $finish_date = "'" . $this->finish_date . "'";         


         $user = $_SESSION['user'] ;      		
		
		 $sql = "update tasks set 		         
				       task_id=$task_id,
					   task_name=$task_name,
					   category=$category,
					   `desc`=$desc,
					   status=$status,
             modified_date =curdate(),
             modified_by='$user',
             priority=$priority,
             start_date =$start_date,
             finish_date=$finish_date 				   
				where recnum=$recnum_task and 
					  link2project=$recnum_project";
		
		// echo $sql; exit;
		$result = mysql_query($sql);
 		// Test to make sure query worked
		if(!$result) die("Update to Task didn't work..Please report to Sysadmin. " . mysql_error());
    }
	 function getlast_Task() {
      // $newLogin= userlogin::singleton();      

         $sql = "select recnum,
		                task_id						
                  FROM tasks                   
                  order by recnum DESC limit 1";
       //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getProjectDetails query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }
	  function getNote($note2task,$note2project) {
      $newlogin = new userlogin;
        $newlogin->dbconnect();
        //$newLogin= userlogin::singleton();            
		
         $sql = "select n.create_date, n.notes, u.userid					
                 FROM tasknotes n,user u
				  where n.notes2task=$note2task and  
				        n.notes2project=$note2project and
						n.notes2user=u.recnum";
       //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getNotes query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }
	  function getCustNote($note2task,$note2project) {
      $newlogin = new userlogin;
        $newlogin->dbconnect();
        //$newLogin= userlogin::singleton();            
		
         $sql = "select c.create_date, c.cust_notes, u.userid					
                 FROM customer_notes c,user u
				  where c.notes2task=$note2task and  
				        c.notes2project=$note2project and
						c.notes2user=u.recnum";
       //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getNotes query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }
	  function InsertNotes($recnum_task,$recnum_project)
      {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
      //$newLogin= userlogin::singleton();
      	 $userrecnum = $_SESSION['userrecnum'];		

		      $notes ="'" .$this->notes . "'";

		    $sql = "INSERT INTO tasknotes														
               (`notes`,create_date,notes2task,notes2project,notes2user)
               VALUES 
			   ($notes,curdate(),$recnum_task,$recnum_project,$userrecnum)";
	    // echo $sql;
         $result = mysql_query($sql);
         // Test to make sure query worked
         if(!$result) die("Insert to Notes didn't work..Please report to Sysadmin. " . mysql_error());
     }
	  function InsertCustNotes($recnum_task,$recnum_project)
      {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
      //$newLogin= userlogin::singleton(); 
      	 $userrecnum = $_SESSION['userrecnum'];		

		 $customer_notes ="'" .$this->customer_notes . "'";

		 $sql = "INSERT INTO customer_notes														
               (cust_notes,create_date,notes2task,notes2project,notes2user)
               VALUES 
			   ($customer_notes,curdate(),$recnum_task,$recnum_project,$userrecnum)";
	     //echo $sql;
         $result = mysql_query($sql);
         // Test to make sure query worked
         if(!$result) die("Insert to CustNotes didn't work..Please report to Sysadmin. " . mysql_error());
     }


  public function gettask_uniqueid()
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();

    $sql = "select nxtnum from seqnum where tablename = 'tasks'";
    $result = mysql_query($sql);
    $myrow = mysql_fetch_row($result);
    $id = $myrow[0]+1;
    $tasks_id = 'TK-'.$id;
    return $tasks_id;

  }

  public function gettaks_checkInOut($taskid)
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();

    $sql = "select pt.recnum,pt.empid,pt.date,
                   pt.siteid,pt.checkInOut,
                   pt.Lat,pt.Lon
            from payroll_trans pt
            where pt.TaskId = '$taskid' 
            order by pt.recnum asc      
              ";
    // echo "$sql <br>";
    $result = mysql_query($sql);
    return $result;

  }

    public function gettask_duration($taskid)
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      $siteid = $_SESSION['siteid'];
      $siteval = "pms.siteid = '".$siteid."'";

      $sql = "select pt.recnum,pt.empid,pt.date,
                     pt.siteid,pt.checkInOut
              from payroll_trans pt
              where pt.TaskId = '$taskid' 
              order by pt.recnum asc";

      $result = mysql_query($sql);
      return $result;
    }

    public function getEmpid4task($recnum)
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      $sql = "select u.userid,e.empid
              from user u, employee e
              where u.recnum=$recnum and
                    u.user2employee = e.recnum";
      $result = mysql_query($sql);
      $myrow = mysql_fetch_row($result);
      return $myrow[0];
    }

    public function getMobileIdToken($userrecnum)
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      $sql = "select d.DeviceId,d.DeviceToken
              from devices d
              where d.Link2User=$userrecnum";
      $result = mysql_query($sql);
      $devices=array();
      while($myrow = mysql_fetch_row($result))
      {
        $devices[]=$myrow[1];
      }
      return $devices;
    }

    


}