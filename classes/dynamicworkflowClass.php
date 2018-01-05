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

class dynamicworkflow {

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
        $est_cost;

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

    function getrecnum(){
           return $this->recnum;
    }
    function addDWFStage() {
        $userid = "'" . $_SESSION['user'] . "'";
        $sql = "select nxtnum from seqnum where tablename = 'work_flow_config' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access for Dynamic Workflow Config didn't work. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $sql = "select nxtnum from seqnum where tablename = 'dwf_stage_field' for update"; //dwf_stage is not a table its a field within they dynamic_work_flow_config
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access for stage didn't work. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $this->stage = $myrow[0];
        $this->stage = $this->stage + 1;
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
        $sql = "select * from work_flow_config where stage = $stage and type = $type";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO work_flow_config
                         (recnum, stage, dept, type, doc_type,
                          status, email_list, appr_type, approval_by,
                          allow_cust_disp, allow_print_disp, allow_report_disp,
                          create_date, cust_status_disp,est_time,act_status,est_cost)
                        VALUES
                             ($objid, $stage, $dept, $type, $doctype,
                              $status, $emaillist, $apprtype, $apprby,
                              $allowcustdisp, $allowprinting, $allowreporting,
                              $crdate, $custstatusdisp,$est_time,$act_status,$est_cost
                   )";

           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to Dynamic Work Flow Config didn't work. " . mysql_error());
         }
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Stage " . $stage . " already exists. ");
            echo "</td></tr></table>";
         }

         $sql = "update seqnum set nxtnum = $objid where tablename = 'work_flow_config'";
         $result = mysql_query($sql);
         // Test to make sure query worked
         if(!$result) die("Seqnum update for Dynamic Workflow Config didn't work. " . mysql_error());

         $sql = "update seqnum set nxtnum = $this->stage where tablename = 'dwf_stage_field'";
         $result = mysql_query($sql);
         // Test to make sure query worked
         if(!$result) die("Seqnum access for stage didn't work. " . mysql_error());
         $this->recnum = $objid;
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
                                          est_time=$est_time,
                                                                act_status=$act_status,
                                                                est_cost=$est_cost
                        where stage = $stage and type = $type";

           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to Workflow Config didn't work. " . mysql_error());
     }



     function getWF($inptype,$inpdoctype) {
        $userid = "'" . $_SESSION['user'] . "'";
        $type = "'" . $inptype . "'";
        $doctype = "'" . $inpdoctype . "'";
             $sql = "select stage, type, dept, status, recnum,
                            allow_cust_disp, allow_print_disp,
                            allow_report_disp, cust_status_disp,est_time
                       from work_flow_config
                       where type = $type and
                             doc_type = $doctype
                                   and act_status='Active'
                             ORDER by stage";
        $result = mysql_query($sql);
        return $result;

     }

          function getcountWF($inptype,$inpdoctype) {
        $userid = "'" . $_SESSION['user'] . "'";
        $type = "'" . $inptype . "'";
        $doctype = "'" . $inpdoctype . "'";
             $sql = "select count(*) as numrows
                       from work_flow_config
                       where type = $type and
                                    act_status='Active' and
                             doc_type = $doctype";
        $result  = mysql_query($sql) or die('Work Flow count query failed');
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
                       act_status,est_cost
                    from work_flow_config
                    where type = $type and
                          recnum = $recnum
                    ORDER by stage";
        $result = mysql_query($sql);
        return $result;

     }
     function getWFdoc() {
        $userid = "'" . $_SESSION['user'] . "'";
        $sql = "select distinct type, doc_type from work_flow_config where act_status='Active'";
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

     function getWFdetails($inptype) {
        $userid = "'" . $_SESSION['user'] . "'";
        $type = "'" . $inptype . "'";
        $sql = "select type, stage, dept, status, recnum,
                       appr_type, approval_by,doc_type,
                       email_list, allow_cust_disp,allow_print_disp,
                       allow_report_disp, cust_status_disp,est_time,act_status,est_cost
                       from work_flow_config
                       where type = $type
                             ORDER by stage";
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
} // End work flow class definition