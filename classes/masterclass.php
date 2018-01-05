<?
//====================================
// Author: FSI
// Date-written = march 22, 2007
// Filename: masterclass.php
// Maintains the class for master sheet
// Revision: v1.0
//====================================

include_once('loginClass.php');

class master {

    var $recnum,
        $refnum,
        $issue_date,
        $partnum,
        $revnum,
        $partname,
        $revdate,
        $attachments,
        $drg_issue,
        $customer,
        $project,
        $material_type,
        $material_sp,
        $backup_cd_num,
        $part_type,
        $cim_ref_num,
        $approved_by,
        $prepared_by;

    // Constructor definition
    function master() {
        $this->recnum = '';
        $this->refnum = '';
        $this->issue_date = '';
        $this->partnum = '';
        $this->revnum = '';
        $this->partname = '';
        $this->revdate = '';
        $this->attachments = '';
        $this->drg_issue = '';

        $this->customer = '';
        $this->project = '';
        $this->material_type = '';
        $this->material_sp = '';
        
        $this->backup_cd_num = '';
        $this->part_type = '';
        $this->cim_ref_num = '';
        $this->approved_by = '';
        $this->prepared_by = '';
     }

    // Property get and set
     function getrecnum() {
           return $this->getrecnum;
    }
    function setrecnum ($req_recnum) {
           $this->recnum = $req_recnum;
    }

    function getrefnum() {
           return $this->refnum;
    }

    function setrefnum ($reqrefnum) {
           $this->refnum = $reqrefnum;
    }
    function getissuedate() {
           return $this->issue_date;
    }

    function setissuedate ($reqissuedate) {
           $this->issue_date = $reqissuedate;
    }
    function getpartnum() {
           return $this->partnum;
    }

    function setpartnum ($reqpartnum) {
           $this->partnum = $reqpartnum;
    }

    function getrevnum() {
           return $this->revnum;
    }
    function setrevnum ($reqrevnum) {
           $this->revnum = $reqrevnum;
    }
    function getpartname() {
           return $this->partname;
    }
    function setpartname ($reqpartname) {
           $this->partname = $reqpartname;
    }

    function getrevdate() {
           return $this->revdate;
    }

    function setrevdate ($reqrevdate) {
           $this->revdate = $reqrevdate;
    }
    function getattachments() {
           return $this->attachments;
    }

    function setattachments ($reqattachments) {
           $this->attachments = $reqattachments;
    }

    function setdrgissue ($reqdrgissue) {
           $this->drg_issue = $reqdrgissue;
    }
    function getdrgissue() {
             return $this->drg_issue;
    }

    function setcustomer ($reqcustomer) {
           $this->customer = $reqcustomer;
    }
    function getcustomer() {
             return $this->customer;
    }

    function setproject ($reqproject) {
           $this->project = $reqproject;
    }
    function getproject() {
             return $this->project;
    }

    function setmaterialtype ($reqmaterialtype) {
           $this->material_type = $reqmaterialtype;
    }

    function getmaterialtype() {
             return $this->material_type;
    }


    function getmaterialsp() {
           return $this->material_sp;
    }

    function setmaterialsp ($reqmaterialsp) {
           $this->material_sp = $reqmaterialsp;
    }
    
    function getbackupcdnum() {
           return $this->backup_cd_num;
    }

    function setbackupcdnum ($reqbackupcdnum) {
           $this->backup_cd_num = $reqbackupcdnum;
    }
    function getparttype() {
           return $this->part_type;
    }

    function setparttype ($reqparttype) {
           $this->part_type = $reqparttype;
    }
    function getcimrefnum() {
           return $this->cim_ref_num;
    }

    function setcimrefnum ($reqcimrefnum) {
           $this->cim_ref_num = $reqcimrefnum;
    }
    function getapprovedby() {
           return $this->approved_by;
    }

    function setapprovedby ($reqapprovedby) {
           $this->approved_by = $reqapprovedby;
    }
    function getpreparedby() {
           return $this->prepared_by;
    }

    function setpreparedby ($reqpreparedby) {
           $this->prepared_by = $reqpreparedby;
    }
        function addmaster() {
       //echo "I am here";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'master' for update";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result)die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $refnum = "'" . $this->refnum . "'";
        $issue_date = "'" . $this->issue_date . "'";
        $partnum = "'" . $this->partnum . "'";
        $revnum = "'" . $this->revnum . "'";
        $partname = "'" . $this->partname . "'";
        $revdate = "'" . $this->revdate . "'";
        $attachments = "'" . $this->attachments . "'";
        $drg_issue =  "'" . $this->drg_issue . "'";
        $customer = "'" . $this->customer . "'";
        $project = "'" . $this->project . "'";
        $material_type = "'" . $this->material_type . "'";
        $material_sp = "'" . $this->material_sp . "'";
        $backup_cd_num = "'" . $this->backup_cd_num . "'";
        $part_type = "'" . $this->part_type . "'";
        $cim_ref_num = "'" . $this->cim_ref_num . "'";
        $approved_by = "'" . $this->approved_by . "'";
        $prepared_by = "'" . $this->prepared_by . "'";

        $sql = "select * from master where recnum = $objid";
       // echo $sql;
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
        $sql = "INSERT INTO master(refnum, issue_date, partnum, revnum, partname, revdate, attachments, drg_issue, customer, project, material_type, material_sp, backup_cd_num, part_type, cim_ref_num, approved_by, prepared_by,recnum)
                  VALUES ($refnum, $issue_date, $partnum, $revnum, $partname, $revdate, $attachments, $drg_issue, $customer, $project, $material_type, $material_sp, $backup_cd_num, $part_type, $cim_ref_num, $approved_by, $prepared_by, $objid)";
           $sql = "INSERT INTO
                        master
                            (
                            recnum,refnum, issue_date, partnum, revnum, partname, revdate, attachments, drg_issue, customer, project, material_type, material_sp, backup_cd_num, part_type, cim_ref_num, approved_by, prepared_by
                            )
                    VALUES
                            (
                            $objid,$refnum, $issue_date, $partnum, $revnum, $partname, $revdate, $attachments, $drg_issue, $customer, $project, $material_type, $material_sp, $backup_cd_num, $part_type, $cim_ref_num, $approved_by, $prepared_by
                            )";
       //echo "\n" . $sql;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)die("Insert to process master sheet didn't work..Please report to Sysadmin. " . mysql_error());
         }
         else {
              die("Process Master ID " . $objid . " already exists. ");
              }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'master'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result)die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());

        return $objid;
     }

 

     function getmasters($cond,$argsort1,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;
        if($sortorder=='')
         $sortorder="m.refnum desc";

             $sql = "select m.refnum,m.issue_date,m.partnum,m.partname,m.revnum,m.revdate,m.attachments,m.drg_issue,m.customer,m.project,m.material_type,m.material_sp,m.recnum from master m where $wcond ORDER by $sortorder limit $offset, $limit";
//echo "$sql";
             $result = mysql_query($sql);
             return $result;
}

    function getmasterdetails($inpmastrecnum) {
        $mastrecnum = "'" . $inpmastrecnum . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select m.refnum,m.issue_date,m.partnum,m.partname,m.revnum,m.revdate,m.attachments,m.drg_issue,m.customer,m.project,m.material_type,m.material_sp,m.recnum from master m where m.recnum = $mastrecnum";
       //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Access to master details failed...Please report to SysAdmin. " . mysql_error());
        return $result;
    }
    
    function updatemaster($inpmastrecnum) {

        $masterrecnum = "'" . $inpmastrecnum . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        
        $refnum = "'" . $this->refnum . "'";
        $issue_date = "'" . $this->issue_date . "'" ;
        $partnum = "'" . $this->partnum . "'";
        $revnum = "'" . $this->revnum . "'";
        $partname = "'" . $this->partname . "'";
        $revdate = "'" . $this->revdate . "'";
        $attachments = "'" . $this->attachments . "'";
        $drg_issue =  "'" . $this->drg_issue . "'";
        $customer = "'" . $this->customer . "'";
        $project = "'" . $this->project . "'";
        $material_type = "'" . $this->material_type . "'";
        $material_sp = "'" . $this->material_sp . "'";
        $backup_cd_num = "'" . $this->backup_cd_num . "'";
        $part_type = "'" . $this->part_type . "'";
        $cim_ref_num = "'" . $this->cim_ref_num . "'";
        $approved_by = "'" . $this->approved_by . "'";
        $prepared_by = "'" . $this->prepared_by . "'";

         $sql = "update master set refnum = $refnum,
                              issue_date = $issue_date,
                              partnum = $partnum,
                              revnum = $revnum,
                              partname = $partname,
                              revdate = $revdate,
                              attachments = $attachments,
                              drg_issue = $drg_issue,
                              customer = $customer,
                              project = $project,
                              material_type = $material_type,
                              material_sp = $material_sp,
                              backup_cd_num = $backup_cd_num,
                              part_type = $part_type,
                              cim_ref_num = $cim_ref_num,
                              approved_by = $approved_by,
                              prepared_by = $prepared_by
                        where recnum = $masterrecnum";
                        //echo $sql;

           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to master didn't work..Please report to Sysadmin. " . mysql_error());

     }


     function getmasterCount($cond,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
             $sql = "select count(*) as numrows
                     from master m where  $wcond limit $offset, $limit";
       $newlogin = new userlogin;
       $newlogin->dbconnect();
//echo "$sql";
$result  = mysql_query($sql) or die('Emp count query failed');
$row     = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];
//echo $numrows;
return $numrows;
}



} // End Master class definition
