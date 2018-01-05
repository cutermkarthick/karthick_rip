<?
//====================================
// Author: FSI
// Date-written = April 06, 2010
// Filename: projectClass.php
// Application: Project_management
// Revision: v1.0
//====================================

include_once('loginClass.php');

class project {
    var $project,
        $desc,
        $start_date,
        $closed_date,
        $manager,
        $req,
		$category,
		$technology,
		$platform,
        $siteid,
        $companyrecnum;

// Constructor definition
function project()
{
        $this->project = '';
        $this->desc = '';
        $this->start_date = '';
        $this->closed_date = '';
        $this->manager = '';
        $this->req = '';
		$this->category = '';
		$this->technology = '';
		$this->platform = '';
        $this->siteid = '';
        $this->companyrecnum = '';
}
 // Property get and set
	function getproject() {
           return $this->project;
    }
    function setproject($req_project) {
           $this->project= $req_project;
    }

	function getdesc() {
           return $this->desc;
    }
    function setdesc($req_desc) {
           $this->desc= $req_desc;
    }

	function getstart_date() {
           return $this->start_date;
    }
    function setstart_date($req_start_date) {
           $this->start_date= $req_start_date;
    }
	function getclosed_date() {
           return $this->closed_date;
    }
    function setclosed_date($req_closed_date) {
           $this->closed_date= $req_closed_date;
    }

	function getmanager() {
           return $this->manager;
    }
    function setmanager($req_manager) {
           $this->manager= $req_manager;
    }

	function getreq() {
           return $this->req;
    }
    function setreq($req_req) {
           $this->req= $req_req;
    }

	function getcategory() {
           return $this->category;
    }
    function setcategory($req_category) {
           $this->category= $req_category;
    }

	function gettechnology() {
           return $this->technology;
    }
    function settechnology($req_technology) {
           $this->technology= $req_technology;
    }

	function getplatform() {
           return $this->platform;
    }
    function setplatform($req_platform) {
           $this->platform= $req_platform;
    }

    function getsiteid() {
           return $this->siteid;
    }
    function setsiteid($siteid) {
           $this->siteid= $siteid;
    }

    function setcompanyrecnum($companyrecnum) {
           $this->companyrecnum= $companyrecnum;
    }

	 function getprojectSummary($cond,$argoffset,$arglimit) {
         $newlogin = new userlogin;
        $newlogin->dbconnect();
        
         $offset= $argoffset;
         $limit= $arglimit;
         $wcond = $cond;
		 $userName = $_SESSION['user'];
		 $role = $_SESSION['role'];
         $siteid = $_SESSION['siteid'];
         $usertype = $_SESSION['usertype'];
    		 if ($role == 'SU')
    		 {
    			 $manager = "%";
    		 }
    		 else 
    		 {
    			 $manager = "$userName%";
    		 }		

             if($usertype =='host')
             {
                $cond ='';

             }
             else
             {
                $cond ="and siteid = '$siteid'" ;

             }

         $sql = "select p.recnum,
    		                p.project,
            						p.`desc`,
            						p.start_date,
            						p.closed_date,
            						p.manager,
            						p.req,
            						p.category,
            						p.technology,
            						p.platform,
                        c.name
                    FROM project p,company c
                    where  $wcond     
                    and c.id = '$siteid'  and
                    p.siteid = '$siteid'
                    order by recnum limit $offset,$limit";
                  // echo $sql; 


        $result = mysql_query($sql);
        if(!$result) die("getProjectSummary query failed..Please report to Sysadmin. " . mysql_error());
        return $result;

     }
	 function getprojectSummaryCount($cond,$argoffset,$arglimit) {
$newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $wcond = $cond;
         $offset = $argoffset;
        $limit = $arglimit;
        $siteid = $_SESSION['siteid'];

        $sql = "select count(*) as numrows
                  FROM project
                  where $wcond and
                    siteid = '$siteid'
                  order by recnum limit $offset,$limit";
				 // echo $sql;
       

        $result  = mysql_query($sql) or die('Project count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;

    }
	 function getproject_details($cond) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
             
         $wcond = $cond;
         //echo $wcond;
		 $userName = $_SESSION['user'];
		 $role = $_SESSION['role'];
     $usertype = $_SESSION['usertype'];
    		 if ($role == 'SU')
		 {
			 $manager = "%";
		 }
		 else 
		 {
			 $manager = "$userName%";
       
		 }		

     $siteid = $_SESSION['siteid'];

     //and manager like '$manager'
         $sql = "select p.recnum,
    		                p.project,
            						p.`desc`,
            						p.start_date,
            						p.closed_date,
            						p.manager,
            						p.req,
            						p.category,
            						p.technology,
            						p.platform,
                        c.name,
                        c.id,
                        p.link2company
                  FROM project p,company c 
				  $wcond  and p.siteid = '$siteid'
                  
                  order by p.recnum";
      // echo "$sql"; 
        $result = mysql_query($sql);
        if(!$result) die("getProjectDetails query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }
	  function addProject()
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        
         $project ="'" .$this->project . "'";
         $desc = "'" . $this->desc . "'";         
    		 $start_date =  "'".$this->start_date ."'";			 
    		 $closed_date =$this->closed_date ? $this->closed_date : '0000-00-00';
         $manager = "'" . $this->manager . "'";         
    		 $req =  "'".$this->req ."'";
    		 $category ="'" .$this->category . "'";
         $technology = "'" . $this->technology . "'";         
         $platform =  "'".$this->platform ."'";
         $companyrecnum =  "'".$this->companyrecnum ."'";
         // $siteid =  "'".$this->siteid ."'";
         $user = $_SESSION['user'] ;
         $siteid = "'".$_SESSION['siteid']."'";
		 
		 $sql = "INSERT INTO project														
               (project,`desc`,start_date,closed_date,
			   manager,req,category,technology,
			   platform,link2company,siteid)
               VALUES 
			   ($project,$desc,$start_date,'$closed_date',$manager,$req,$category,$technology,
			   $platform,$companyrecnum, $siteid)";
         $result = mysql_query($sql);
         // Test to make sure query worked
         if(!$result) die("Insert to Project didn't work..Please report to Sysadmin. " . mysql_error());
  }
   function Updateproject($recnum)
   {
      $newlogin = new userlogin;
        $newlogin->dbconnect();
           
    
		 $project ="'" .$this->project . "'";
         $desc = "'" . $this->desc . "'";         
		 $start_date =  "'".$this->start_date ."'";			 
		 $closed_date ="'" .$this->closed_date . "'";
         $manager = "'" . $this->manager . "'";         
		 $req =  "'".$this->req ."'";
		 $category ="'" .$this->category . "'";
         $technology = "'" . $this->technology . "'";         
		 $platform =  "'".$this->platform ."'";
         $companyrecnum =  "'".$this->companyrecnum ."'";
         //$siteid =  "'".$this->siteid ."'";

         $user = $_SESSION['user'] ;
		 $sql = "update project set 		         
				       project=$project,
					   `desc`=$desc,
					   start_date=$start_date,
					   closed_date=$closed_date,
					   manager=$manager,
					   req=$req,
					   category=$category,
					   technology=$technology,
					   platform=$platform,
             link2company=$companyrecnum
                         
                         
					   where recnum=$recnum";
		//echo $sql;
		$result = mysql_query($sql);
 		// Test to make sure query worked
		if(!$result) die("Update to Project didn't work..Please report to Sysadmin. " . mysql_error());
    }
	 function getlast_project() {
       $newlogin = new userlogin;
        $newlogin->dbconnect();
              

         $sql = "select recnum,
		                project						
                  FROM project                   
                  order by recnum DESC limit 1";
       //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getProjectDetails query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }

}