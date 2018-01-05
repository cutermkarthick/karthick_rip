<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: workflowClass.php
// Maintains the class for Workflow
// Revision: v1.0
// Modifications History
//====================================

include_once('loginClass.php');

class workflow {

    var $recnum,
        $stage,
        $type,
        $doctype,
        $status,
        $apprtype,
        $apprby,
        $dept,
        $email_list,
        $allowcustdisp,
        $allowprinting,
        $allowreporting,
        $created_by,
        $createdate,
        $modified_by,
        $modified_date,
        $custstatusdisp,
        $est_time,
        $act_status,
        $est_cost,
        $dependency,
        $sec_respose,
        $process,
        $when_process,
        $currency,
        $primary_respose;

   // Constructor definition
    function workflow() {
        $this->recnum = '';
        $this->stage = '';
        $this->dept = '';
        $this->type = '';
        $this->doctype = '';
        $this->status = '';
        $this->dept = '';
        $this->apprtype = '';
        $this->apprby = '';
        $this->email_list = '';
        $this->allowcustdisp = '';
        $this->allowprinting = '';
        $this->allowreporting = '';
        $this->created_by = '';
        $this->createdate = '';
        $this->modified_by = '';
        $this->modified_date = '';
        $this->custstatusdisp = '';
        $this->est_time = '';
        $this->act_status= '';
        $this->est_cost= '';
        $this->dependency = '';
        $this->sec_respose = '';
        $this->process = '';
        $this->when_process = '';
        $this->currency = '';
        $this->primary_respose = '';
    }

    // Property get and set
    function getstage() {
           return $this->stage;
    }

    function setstage ($reqstage) {
           $this->stage = $reqstage;
    }

    function gettype() {
           return $this->type;
    }

    function settype ($req_type) {
           $this->type = $req_type;
    }
    function getdoctype() {
           return $this->doctype;
    }

    function setdoctype ($req_doctype) {
           $this->doctype = $req_doctype;
    }

    function getstatus() {
           return $this->status;
    }

    function setstatus ($req_status) {
           $this->status = $req_status;
    }

    function getdept() {
           return $this->dept;
    }

    function setdept ($req_dept) {
           $this->dept = $req_dept;
    }

    function getemaillist() {
           return $this->emaillist;
    }

    function setemaillist ($req_emaillist) {
           $this->emaillist = $req_emaillist;
    }
    function getapprtype() {
           return $this->apprtype;
    }

    function setapprtype ($req_apprtype) {
           $this->apprtype = $req_apprtype;
    }

    function getapprby() {
           return $this->apprby;
    }

    function setapprby ($req_apprby) {
           $this->apprby = $req_apprby;
    }
    function getallowcustdisp() {
           return $this->allowcustdisp;
    }

    function setallowcustdisp ($req_allowcustdisp) {
           $this->allowcustdisp = $req_allowcustdisp;
    }
    function getallowprintdisp() {
           return $this->allowprinting;
    }

    function setallowprintdisp ($req_allowprinting) {
           $this->allowprinting = $req_allowprinting;
    }
    function getallowreportdisp() {
           return $this->allowreporting;
    }

    function setallowreportdisp ($req_allowreporting) {
           $this->allowreporting = $req_allowreporting;
    }
    function getcuststatusdisp() {
           return $this->custstatusdisp;
    }

    function setcuststatusdisp ($req_custstatusdisp) {
           $this->custstatusdisp = $req_custstatusdisp;
    }
    function getest_time() {
           return $this->est_time;
    }

    function setest_time ($req_est_time) {
           $this->est_time = $req_est_time;
    }
    function getact_status() {
           return $this->act_status;
    }

    function setact_status ($req_act_status) {
           $this->act_status = $req_act_status;
    }
    function getest_cost() {
           return $this->est_cost;
    }

    function setest_cost ($req_est_cost) {
           $this->est_cost = $req_est_cost;
    }

    function getdependency() {
           return $this->dependency;
    }

    function setdependency ($req_dependency) {
           $this->dependency = $req_dependency;
    }

    function setsec_respose ($sec_respose) {
           $this->sec_respose = $sec_respose;
    }
    function setprocess ($process) {
           $this->process = $process;
    }
    function setwhen_process ($when_process) {
           $this->when_process = $when_process;
    }

      function setcurrency($currency) {
           $this->currency = $currency;
    }


    function getcurrency($currency) {
           return $this->currency;
    }


    function setprimary_respose ($primary_respose) {
           $this->primary_respose = $primary_respose;
    }

    function getprimary_respose($primary_respose) {
           return $this->primary_respose;
    }




    function addWFStage() {
        $userid = "'" . $_SESSION['user'] . "'";
        $siteid= "'" . $_SESSION['siteid'] . "'";
        $sql = "select nxtnum from seqnum where tablename = 'work_flow_config' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access for Workflow Config didn't work. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crdate = "'" . date("y-m-d") . "'";
        $stage = $this->stage;
        $dept = "'" . $this->dept . "'";
        $type = "'" . $this->type . "'";
        $doctype = "'" . $this->doctype . "'";
        $status = "'" . $this->status . "'";
        $emaillist = "'" . $this->emaillist . "'";
        $apprtype = "'" . $this->apprtype . "'";
        $apprby = "'" . $this->apprby . "'";
        $allowcustdisp = "'" . $this->allowcustdisp . "'";
        $allowprinting = "'" . $this->allowprinting . "'";
        $allowreporting = "'" . $this->allowreporting . "'";
        $custstatusdisp = "'" . $this->custstatusdisp . "'";
        $est_time=$this->est_time;
        $act_status ="'" . $this->act_status . "'";
        $est_cost=$this->est_cost;
        $dependency= "'" .$this->dependency."'" ;

        $sec_respose ="'" . $this->sec_respose . "'";
        $process ="'" . $this->process . "'";
        $when_process ="'" . $this->when_process . "'";
        $primary_respose ="'" . $this->primary_respose . "'";

        if($dependency == '')
         {
         $dependency = "'" . "'";
         }

         $currency= "'" .$this->currency."'" ;
        $sql = "select * from work_flow_config where stage = $stage and type = $type";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO work_flow_config
                         (recnum, stage, dept, type, doc_type,
                          status, email_list, appr_type, approval_by,
                          allow_cust_disp, allow_print_disp, allow_report_disp,
                          create_date, cust_status_disp,est_time,act_status,est_cost,dependency,siteid, secondary_responsibility, process, when_process,created_by,currency,
                          primary_responsibility)
                        VALUES
                             ($objid, $stage, $dept, $type, $doctype,
                              $status, $emaillist, $apprtype, $apprby,
                              $allowcustdisp, $allowprinting, $allowreporting,
                              $crdate, $custstatusdisp,'$est_time',$act_status,$est_cost,$dependency,$siteid,$sec_respose,$process,$when_process,$userid,$currency,$primary_respose
                   )";
      // echo   $sql;exit;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to Work Flow Config didn't work. " . mysql_error());
         }
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Stage " . $stage . " already exists. ");
            echo "</td></tr></table>";
         }

         $sql = "update seqnum set nxtnum = $objid where tablename = 'work_flow_config'";
         $result = mysql_query($sql);
         // Test to make sure query worked
         if(!$result) die("Seqnum update for Workflow Config didn't work. " . mysql_error());

     }

    function updateWFStage($stage,$type) {
        $userid = "'" . $_SESSION['user'] . "'";
        $crdate = "'" . date("y-m-d") . "'";
        $stage = "'" . $this->stage . "'";
        $dept = "'" . $this->dept . "'";
        $type = "'" . $this->type . "'";
        $doctype = "'" . $this->doctype . "'";
        $status = "'" . $this->status . "'";
        $apprtype = "'" . $this->apprtype . "'";
        $apprby = "'" . $this->apprby . "'";
        $emaillist = "'" . $this->emaillist . "'";
        $allowcustdisp = "'" . $this->allowcustdisp . "'";
        $allowprinting = "'" . $this->allowprinting . "'";
        $allowreporting = "'" . $this->allowreporting . "'";
        $custstatusdisp = "'" . $this->custstatusdisp . "'";
        $est_time=$this->est_time;
        $act_status ="'" . $this->act_status . "'";
        $est_cost=$this->est_cost;
        $dependency=$this->dependency ;

        $sec_respose ="'" . $this->sec_respose . "'";
        $process ="'" . $this->process . "'";
        $when_process ="'" . $this->when_process . "'";
        $primary_respose ="'" . $this->primary_respose . "'";
        if($dependency == '')
         {
         $dependency = "'" . "'";
         }
         else
         {
          $dependency="'" .$this->dependency."'" ;
         }

        $sql = "update work_flow_config set
                                dept = $dept,
                                status = $status,
                                doc_type = $doctype,
                                email_list = $emaillist,
                                appr_type = $apprtype,
                                allow_cust_disp  = $allowcustdisp,
                                allow_print_disp  = $allowprinting,
                                allow_report_disp  = $allowreporting,
                                approval_by = $apprby,
                                cust_status_disp = $custstatusdisp,
                          		  est_time='$est_time',
              								  act_status=$act_status,
              								  est_cost=$est_cost,
                                dependency=$dependency,
                                secondary_responsibility=$sec_respose,
                                process=$process,
                                when_process=$when_process,
                                primary_responsibility=$primary_respose
                                where stage = $stage and type = $type";

// echo $sql;exit;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to Workflow Config didn't work. " . mysql_error());
     }



     function getWF($inptype,$inpdoctype) {
        $userid = "'" . $_SESSION['user'] . "'";
        $type = "'" . $inptype . "'";
        $doctype = "'" . $inpdoctype . "'";
        $pagename = $_SESSION['pagename'] ;
        if($pagename == 'wodetailsEntry')
        {
             $sql = "select stage, type, dept, status, recnum,
                            allow_cust_disp, allow_print_disp,
                            allow_report_disp, cust_status_disp,est_time,dependency,
                            secondary_responsibility,process,
                            when_process,email_list,stage,
                            primary_responsibility
                       from work_flow_config
                       where type = 'Aerowings' and
                             doc_type = $doctype
              	             and act_status='Active' and
              	             stage <10000
                             ORDER by stage";
        }
        else
        {
          $sql = "select stage, type, dept, status, recnum,  allow_cust_disp, allow_print_disp,
                          allow_report_disp, cust_status_disp,est_time,dependency,
                          secondary_responsibility,process,when_process,email_list,stage,
                          primary_responsibility
                  from work_flow_config
                  where type = 'Ripple' and
                         doc_type = $doctype
                         and act_status='Active' and
                         stage <10000
                  ORDER by stage";


        }
        // echo $sql;
        $result = mysql_query($sql);
        return $result;

     }

    function getcountWF($inptype,$inpdoctype) {
      $newlogin = new userlogin;
      $newlogin->dbconnect();

        $userid = "'" . $_SESSION['user'] . "'";
        $type = "'" . $inptype . "'";
        $doctype = "'" . $inpdoctype . "'";
             $sql = "select count(*) as numrows
                       from work_flow_config
                       where type = $type and
              	              act_status='Active' and
              	              stage <10000 and
                             doc_type = $doctype";
            // echo "$sql <br>";
        $result  = mysql_query($sql);
        if (!$result) {
         die('Work Flow count query failed'); 
        }

         
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;
}
     function getWFtyperec($inptype,$inprecnum) {
        $userid = "'" . $_SESSION['user'] . "'";
        $type = "'" . $inptype . "'";
        $recnum = $inprecnum;
        $sql = "select type, stage, dept, status, recnum,
                       appr_type, approval_by,doc_type,
                       email_list, allow_cust_disp, allow_print_disp,
                       allow_report_disp, cust_status_disp,est_time,
                       act_status,est_cost, dependency,
                       secondary_responsibility, process, when_process,
                       currency,primary_responsibility
                    from work_flow_config
                    where type = $type and
                          recnum = $recnum
                    ORDER by stage";
        $result = mysql_query($sql);
        return $result;

     }
     function getWFdoc() {
        $userid = "'" . $_SESSION['user'] . "'";
        $siteid = $_SESSION['siteid'];
        $siteval = "siteid = '".$siteid."'";
        $sql = "select distinct type, doc_type from work_flow_config where act_status='Active' and $siteval";
        $result = mysql_query($sql);
        return $result;

     }


     function getWFdoccount ($cond,$argoffset,$arglimit) {
        $userid = "'" . $_SESSION['user'] . "'";
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $type = "'" . $inptype . "'";

        if ($_SESSION['usertype'] == 'EMPL')
        {
           if ($_SESSION['userrole'] == 'SU')
           {

               $sql = "select count(distinct type)
                       from work_flow_config where act_status='Active'
                       limit $offset, $limit";
           }
        }

        $result  = mysql_query($sql) or die('WO count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];

        return $numrows;

     }

     function getWFdetails($inptype)
      {
        $userid = "'" . $_SESSION['user'] . "'";
        $type = "'" . $inptype . "'";
        $siteid = $_SESSION['siteid'];
        $siteval = "siteid = '".$siteid."'";
        $sql = "select type, stage, dept, status,
                       recnum, appr_type, approval_by,
                       doc_type,email_list,allow_cust_disp,
                       allow_print_disp,
                       allow_report_disp, cust_status_disp,est_time,act_status,est_cost, dependency,
                       secondary_responsibility,
                       primary_responsibility
                       from work_flow_config
                       where type = $type and
                            stage < 10000 and $siteval
                             ORDER by stage";

                             // echo $sql;
        $result = mysql_query($sql);
        return $result;

     }

     function getcuststatdisp($inptype,$inpstatus)
     {
        $userid = "'" . $_SESSION['user'] . "'";
        $type = "'" . $inptype . "'";
        $status = "'" . $inpstatus . "'";
        $sql = "select cust_status_disp
                    from work_flow_config
                    where type = $type
           	             and act_status='Active'
                             and status = $status";
        $result = mysql_query($sql);
        return $result;
     }



     function getWF4crn($crn,$inpdoctype) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = "'" . $_SESSION['user'] . "'";
        
        $doctype = "'" . $inpdoctype . "'";
             $sql = "select stage, type, dept, status, recnum,
                            allow_cust_disp, allow_print_disp,
                            allow_report_disp, cust_status_disp,est_time,dependency,
                            secondary_responsibility,process,
                            when_process,email_list,stage,
                            primary_responsibility
                       from work_flow_config
                       where type = '$crn' and
                             doc_type = 'WO'
                             and act_status='Active' and
                             stage <10000
                             ORDER by stage";

                              // echo $sql;
        $result = mysql_query($sql);
        return $result;

     }

    function getcountWF4crn($crn,$doctype) {
  $newlogin = new userlogin;
        $newlogin->dbconnect();

        $userid = "'" . $_SESSION['user'] . "'";
        
             $sql = "select count(*) as numrows
                       from work_flow_config
                       where type = '$crn' and
                              act_status='Active' and
                              stage <10000 and
                             doc_type = '$doctype'";


                             //echo $sql;
        $result  = mysql_query($sql) or die('Work Flow count query failed'. mysql_error());
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;
}


     function getallemployes() 
     {

        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select recnum, fname, 
                       lname, status,dept
                       from employee
                       ORDER by recnum";

                              // echo $sql;
        $result = mysql_query($sql);
        return $result;

     }



} // End work flow class definition
