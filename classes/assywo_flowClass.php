<?
//====================================
// Author: FSI
// Date-written = Dec 06, 2017
// Filename: datesClass.php
// Maintains the class for all dates
// Revision: v1.0
// Modifications History
//====================================

include_once('loginClass.php');

class assywo_flow 
{
	 var $recnum,
        $type,
        $doctype,
        $schdue,
        $revised,
        $completed,
        $link2doc,
        $link2wfconfig,
        $link2owner,
        $link2contact,
        $link2approvedbyowner,
        $link2approvedbycontact,
        $hold_date,
        $release_date,
        $condition,
        $link2dwfconfig,
        $dependency,
        $stagename,
        $stagenum,
        $dept,
        $sec_respose,
        $process,
        $when_process,
        $emaillist,
        $primary_respose;

   // Constructor definition
    function assywo_flow() {
        $this->recnum = '';
        $this->type = '';
        $this->doctype = '';
        $this->schdue = '';
        $this->revised = '';
        $this->completed = '';
        $this->link2doc = '';
        $this->link2wfconfig = '';
        $this->link2owner = '';
        $this->link2approvedbyowner = '';
        $this->link2contact = '';
        $this->link2approvedbycontact = '';
        $this->hold_date = '';
        $this->release_date = '';
        $this->condition = '';
        $this->link2dwfconfig = '';
        $this->dependency = '';
        $this->stagename = '';
        $this->stagenum = '';
        $this->dept = '';
        $this->stagedependency = '';
        $this->sec_respose = '';
        $this->process = '';
        $this->when_process = '';
        $this->emaillist= '';
        $this->primary_respose= '';
    }


    // Property get and set
    function getlink2dwfconfig(){

           return $this->link2dwfconfig;
    }

    function setlink2dwfconfig($link2dwf){

            $this->link2dwfconfig = $link2dwf;
    }

    function getrecnum() {
           return $this->recnum;
    }

    function setrecnum ($reqrecnum) {
           $this->recnum = $reqrecnum;
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
    function getschdue() {
           return $this->schdue;
    }

    function setschdue ($req_schdue) {
           $this->schdue = $req_schdue;
    }

    function getrevised() {
           return $this->revised;
    }

    function setrevised ($req_revised) {
           $this->revised = $req_revised;
    }
    function getcompleted() {
           return $this->completed;
    }

    function setcompleted ($req_completed) {
           $this->completed = $req_completed;
    }

    function getlink2doc() {
           return $this->link2doc;
    }

    function setlink2doc ($req_link2doc) {
           $this->link2doc = $req_link2doc;
    }

    function getlink2wfconfig() {
           return $this->link2wfconfig;
    }

    function setlink2wfconfig ($req_link2wfconfig) {
           $this->link2wfconfig = $req_link2wfconfig;
    }
    function getlink2owner() {
           return $this->link2owner;
    }

    function setlink2owner ($req_link2owner) {
           $this->link2owner = $req_link2owner;
    }
    function getlink2approvedbyowner() {
           return $this->link2approvedbyowner;
    }

    function setlink2approvedbyowner ($req_link2approvedbyowner) {
           $this->link2approvedbyowner = $req_link2approvedbyowner;
    }

    function getlink2contact() {
           return $this->link2contact;
    }

    function setlink2contact ($req_link2contact) {
           $this->link2contact = $req_link2contact;
    }
    function getlink2approvedbycontact() {
           return $this->link2approvedbycontact;
    }

    function setlink2approvedbycontact ($req_link2approvedbycontact) {
           $this->link2approvedbycontact = $req_link2approvedbycontact;
    }
    function gethold_date() {
           return $this->hold_date;
    }

    function sethold_date ($req_hold_date) {
           $this->hold_date = $req_hold_date;
    }

    function getrelease_date() {
           return $this->release_date;
    }

    function setrelease_date ($req_release_date) {
           $this->release_date = $req_release_date;
    }
    function getcondition() {
           return $this->condition;
    }

    function setcondition ($req_condition) {
           $this->condition = $req_condition;
    }
    
    function getdependency() {
           return $this->dependency;
    }

    function setdependency ($req_dependency) {
           $this->dependency = $req_dependency;
    }

    function getstagename() {
           return $this->stagename;
    }

    function setstagename ($req_stagename) {
           $this->stagename = $req_stagename;
    }

    function getstagenum() {
           return $this->stagenum;
    }

    function setstagenum ($req_stagenum) {
           $this->stagenum = $req_stagenum;
    }

    function getdept() {
           return $this->dept;
    }

    function setdept ($dept) {
           $this->dept = $dept;
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
    function getemaillist() {
           return $this->emaillist;
    }

    function setemaillist ($emaillist) {
           $this->emaillist = $emaillist;
    }


   function getprimary_respose() {
           return $this->primary_respose;
    }

    function setprimary_respose ($primary_respose) {
           $this->primary_respose = $primary_respose;
    }

    function addassywo_flow($inpworecnum) 
    {

        $userid = "'" . $_SESSION['user'] . "'";
        $worecnum = $inpworecnum;
        $sql = "select nxtnum from seqnum where tablename = 'assywo_flow' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access for Dates didn't work. " . mysql_error());
        $myrow = mysql_fetch_row($result);

        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crdate = "'" . date("y-m-d") . "'";
        $type = "'" . $this->type . "'";
        $doctype = "'" . $this->doctype . "'";
        $schdue =  $this->schdue ? "'" . $this->schdue  . "'" : '0000-00-00';
        $link2doc = $worecnum;
        $link2wfconfig = $this->link2wfconfig;
        $link2owner = $this->link2owner;
        $link2contact = $this->link2contact;
        $condition = "'" . "NA" . "'";
        $link2dwfconfig = $this->link2dwfconfig;
        $dependency = "'" . $this->dependency . "'";
        $stagename = "'" . $this->stagename . "'";
        $stagenum ="'" .$this->stagenum ."'";
        $dept = "'" . $this->dept . "'";
        $sec_respose = "'" . $this->sec_respose . "'";
        $process = "'" . $this->process . "'";
        $when_process = "'" . $this->when_process . "'";
        $emaillist = "'" . $this->emaillist . "'";
        $primary_respose = "'" . $this->primary_respose . "'";

        $sql = "INSERT INTO assywo_flow
                         (recnum, type, doctype, sch_due,
                          link2wo, link2doc, link2wfconfig, link2owner, 
                          link2contact,`condition`, dependency, 
                          stagename, stagenum, dept,stagedependency,
                          secondary_responsibility, process, when_process,email_list,primary_responsibility)
                        VALUES
                             ($objid, $type, $doctype, $schdue,
                              $worecnum, $link2doc, $link2wfconfig, '$link2owner', $link2contact,$condition,$dependency,$stagename,$stagenum, $dept,
                              $dependency, $sec_respose, $process, $when_process,$emaillist,$primary_respose
                        )";

        // echo "$sql <br>"; exit;
        $result = mysql_query($sql);
        if(!$result) die("Insert to addassywo_flow didn't work. " . mysql_error());

         $sql = "update seqnum set nxtnum = $objid where tablename = 'assywo_flow'";
         $result = mysql_query($sql);
         if(!$result) die("Seqnum update for Dates didn't work. " . mysql_error());
         return $objid;
   	}

   	function getassywo_flow($inpdoctype,$inpdocrecnum) 
    {
      $userid = "'" . $_SESSION['user'] . "'";
      $doctype = "'" . $inpdoctype . "'";

      $recnum = $inpdocrecnum;

      $sql =  "select af.type, af.type, af.sch_due, af.revised, af.completed,
                      af.type, af.link2owner, af.link2contact,
                      af.recnum, af.type, af.type,e1.fname, e1.lname,
                      c1.fname, c1.lname,u1.userid, u1.userid, u2.userid, 
                      u2.userid,af.link2approvedbyowner, 
                      af.link2approvedbycontact,
                      af.type, af.type,af.type,af.condition,af.hold_date,
                      af.release_date,af.link2wfconfig,af.dept,af.dependency,
                      af.stagename,af.stagenum,e1.role, e1.dept, 
                      af.stagedependency,af.secondary_responsibility,
                      af.process,af.when_process,af.primary_responsibility,
                      af.app_flag
                from assywo_flow af
                left outer join employee e1 on af.link2owner = e1.recnum
                left outer join contact c1 on af.link2contact = c1.recnum
                left outer join user u1 on af.link2approvedbyowner = u1.recnum
                left outer join user u2 on  af.link2approvedbycontact = u2.recnum
                where $recnum = af.link2doc  and
                      af.doctype = 'WO' and
                      af.stagenum <= 260
                ORDER by af.stagenum";
      // echo $sql;
      $result = mysql_query($sql);
      return $result;
    }



}