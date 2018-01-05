<?
//====================================
// Author: FSI
// Date-written = march 22, 2007
// Filename: masterclass.php
// Maintains the class for master sheet
// Revision: v1.0
//====================================

include_once('loginClass.php');

class data {

    var $opn_ref_no,
        $drg_issue,
        $work_center,
        $opnnum,
        $partnum,
        $attachments,
        $revnum,
        $partname,
        $parttype,
        $revdate,
        $prepared_by,
        $approved_by,
        $issuenum;

    // Constructor definition
    function data() {
        $this->opn_ref_no = '';
        $this->drg_issue = '';
        $this->work_center = '';
        $this->opnnum = '';
        $this->partnum = '';
        $this->attachments = '';
        $this->revnum = '';
        $this->partname = '';
        $this->parttype = '';
        $this->revdate = '';
        $this->prepared_by = '';
        $this->approved_by = '';
        $this->issuenum = '';
    }

    // Property get and set
    function getopn_ref_no() {
           return $this->opn_ref_no;
    }

    function setopn_ref_no ($reqopnrefnum) {
           $this->opn_ref_no = $reqopnrefnum;
    }
    function getdrg_issue() {
           return $this->drg_issue;
    }

    function setdrg_issue ($reqdrgissue) {
           $this->drg_issue = $reqdrgissue;
    }
    function getwork_center() {
           return $this->work_center;
    }

    function setwork_center ($reqwc) {
           $this->work_center = $reqwc;
    }

    function getopnnum() {
           return $this->opnnum;
    }
    function setopnnum ($reqopnnum) {
           $this->opnnum = $reqopnnum;
    }
    function getpartnum() {
           return $this->partnum;
    }
    
    function setpartnum ($reqpartnum) {
           $this->partnum = $reqpartnum;
    }

    function getattachments() {
           return $this->attachments;
    }

    function setattachments ($reqattachments) {
           $this->attachments = $reqattachments;
    }
    
    function getrevnum() {
           return $this->revnum;
    }

    function setrevnum ($reqrevnum) {
           $this->revnum = $reqrevnum;
    }

    function setpartname ($reqpartname) {
           $this->partname = $reqpartname;
    }
    function getpartname() {
             return $this->partname;
    }

    function setparttype ($reqparttype) {
           $this->parttype = $reqparttype;
    }
    function getparttype() {
             return $this->parttype;
    }

    function setrevdate ($reqrevdate) {
           $this->revdate = $reqrevdate;
    }
    function getrevdate() {
             return $this->revdate;
    }

    function setprepared_by ($reqpreparedby) {
           $this->prepared_by = $reqpreparedby;
    }

    function getprepared_by() {
             return $this->prepared_by;
    }


    function getapproved_by() {
           return $this->approved_by;
    }

    function setapproved_by ($reqapprovedby) {
           $this->approved_by = $reqapprovedby;
    }

    function getissuenum() {
           return $this->issuenum;
    }

    function setissuenum ($reqissuenum) {
           $this->issuenum = $reqissuenum;
    }



    function adddata() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'datasheet' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;


        $opn_ref_no = "'" . $this->opn_ref_no . "'";
        $drg_issue = "'" . $this->drg_issue . "'";
        $work_center = "'" . $this->work_center . "'";
        $opnnum = "'" . $this->opnnum . "'";
        $partnum = "'" . $this->partnum . "'";
        $attachments = "'" .  $this->attachments . "'";
        $revnum = "'" . $this->revnum . "'";
        $partname =  "'" . $this->partname . "'";
        $parttype = "'" . $this->parttype . "'";
        $revdate = "'".  $this->revdate . "'" ;
        $prepared_by = "'" . $this->prepared_by . "'";
        $approved_by = "'" . $this->approved_by . "'";
        $issuenum = "'" . $this->issuenum . "'";


        if ($opn_ref_no != "''") {
           $sql = "select * from datasheet where opn_ref_no = $opn_ref_no";
           $result = mysql_query($sql);
           if (!(mysql_fetch_row($result))) {

        $sql = "INSERT INTO datasheet (recnum, opn_ref_no, drg_issue, work_center, opnnum, partnum, attachments, revnum, partname, parttype, revdate, prepared_by, approved_by,issuenum)
                  VALUES ($objid, $opn_ref_no, $drg_issue, $work_center, $opnnum, $partnum, $attachments, $revnum, $partname, $parttype, $revdate, $prepared_by, $approved_by,$issuenum)";
    //echo $sql;
        $result = mysql_query($sql);
           // Test to make sure query worked
              if(!$result) die("Insert to datasheet didn't work..Please report to Sysadmin. " . mysql_error());
            }
            else {
                echo "<table border=1><tr><td><font color=#FF0000>";
               die("Opn Ref Num " . $opn_ref_no . " already exists. ");
               echo "</td></tr></table>";
            }
           }
       else {
              $sql = "INSERT INTO datasheet (recnum, opn_ref_no, drg_issue, work_center, opnnum, partnum, attachments, revnum, partname, parttype, revdate, prepared_by, approved_by, issuenum)
                  VALUES ($objid, $opn_ref_no, $drg_issue, $work_center, $opnnum, $partnum, $attachments, $revnum, $partname, $parttype, $revdate, $prepared_by, $approved_by, $issuenum)";
  //echo "$sql";
              $result = mysql_query($sql);
           // Test to make sure query worked
              if(!$result) die("Insert to datasheet didn't work..Please report to Sysadmin. " . mysql_error());
        }
        $sql = "update seqnum set nxtnum = $objid where tablename = 'datasheet'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work for datasheet..Please report to Sysadmin. " . mysql_error());
        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for datasheet Insert.. Please report to Sysadmin. " . mysql_error());
        return $objid;

}

     function getdatas($cond,$argsort1,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;
        if($sortorder=='')
        $sortorder="d.opn_ref_no desc";

             $sql = "select d.recnum,d.opn_ref_no,d.drg_issue,d.work_center,d.opnnum,d.partnum,d.attachments,d.revnum,d.partname,d.parttype,d.revdate from datasheet d where $wcond ORDER by $sortorder limit $offset, $limit";
	//echo "$sql";
             $result = mysql_query($sql);
             return $result;
}

    function getdatadetails($inpdatarecnum) {
        $datarecnum = "'" . $inpdatarecnum . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select d.recnum,d.opn_ref_no,d.drg_issue,d.work_center,d.opnnum,d.partnum,d.attachments,d.revnum,d.partname,d.parttype,d.revdate,d.prepared_by,d.approved_by,d.issuenum from datasheet d where d.recnum = $datarecnum";
       //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Access to datasheet details failed...Please report to SysAdmin. " . mysql_error());
        return $result;
    }

    function updatedata($inpdatarecnum) {

        $datarecnum = "'" . $inpdatarecnum . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);

        $opn_ref_no = "'" . $this->opn_ref_no . "'";
        $drg_issue = "'" . $this->drg_issue . "'";
        $work_center = "'" . $this->work_center . "'";
        $opnnum = "'" . $this->opnnum . "'";
        $partnum = "'" . $this->partnum . "'";
        $attachments = "'" .  $this->attachments . "'";
        $revnum = "'" . $this->revnum . "'";
        $partname =  "'" . $this->partname . "'";
        $parttype = "'" . $this->parttype . "'";
        $revdate =  "'" . $this->revdate . "'";
        $prepared_by = "'" . $this->prepared_by . "'";
        $approved_by = "'" . $this->approved_by . "'";
        $issuenum =  "'" . $this->issuenum . "'";

         $sql = "update datasheet set opn_ref_no = $opn_ref_no,
                              drg_issue = $drg_issue,
                              work_center = $work_center,
                              opnnum = $opnnum,
                              partnum = $partnum,
                              attachments = $attachments,
                              revnum = $revnum,
                              partname = $partname,
                              parttype = $parttype,
                              revdate = $revdate,
                              prepared_by = $prepared_by,
                              approved_by = $approved_by,
                              issuenum = $issuenum
                        where recnum = $datarecnum";

           // echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to datasheet didn't work..Please report to Sysadmin. " . mysql_error());

     }
     

     function getdatacount($cond,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
             $sql = "select count(*) as numrows
                     from datasheet d where  $wcond limit $offset, $limit";
       $newlogin = new userlogin;
       $newlogin->dbconnect();
//echo "$sql";
$result  = mysql_query($sql) or die('Emp count query failed');
$row     = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];
//echo $numrows;
return $numrows;
}




} // End data class definition
