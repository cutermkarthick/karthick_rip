<?
//====================================
// Author: FSI
//  Date-written = march 22, 2007
// Filename: masterliClass.php
// Maintains the class for PO Line items
// Revision: v1.0
//====================================

include_once('loginClass.php');

class master_line_items {

    var
     $linenum,
     $opnnum,
     $opn_desc,
     $work_center,
     $opn_ref_no,
     $revnum,
     $link2master;

    // Constructor definition
    function li() {
        $this->linenum = '';
        $this->opnnum = '';
        $this->opn_desc = '';
        $this->work_center = '';
        $this->opn_ref_no = '';
        $this->revnum = '';
        $this->link2master = '';
     }

    // Property get and set
    function getlinenum() {
           return $this->linenum;
    }

    function setlinenum ($reqlinenum) {

           $this->linenum = $reqlinenum;
    }

    function getopnnum() {
           return $this->opnnum;
    }

    function setopnnum ($reqopnnum) {
           $this->opnnum = $reqopnnum;
    }

    function getopndesc() {
           return $this->opn_desc;
    }
    function setopndesc ($reqopndesc) {
           $this->opn_desc = $reqopndesc;
    }

    function getworkcenter() {
           return $this->work_center;
    }

    function setworkcenter ($reqworkcenter) {
           $this->work_center = $reqworkcenter;
    }
    function getopnrefno() {
           return $this->opn_ref_no;
    }

    function setopnrefno ($reqopnrefno) {
           $this->opn_ref_no = $reqopnrefno;
    }
    function getrevnum() {
           return $this->revnum;
    }

    function setrevnum ($reqrevnum) {
           $this->revnum = $reqrevnum;
    }

    function getlink2master() {
           return $this->link2master;
    }

    function setlink2master ($link2master) {
           $this->link2master = $link2master;
    }

    function addLI() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'master_line_items' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for master process sheet line items..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $linenum =  $this->linenum ;
        $opnnum =  $this->opnnum ;
        $opn_desc = "'" . $this->opn_desc . "'";
        $work_center = "'" . $this->opn_ref_no . "'";
        $opn_ref_no = "'" . $this->opn_ref_no . "'";
        $revnum = "'" . $this->revnum . "'";
        $link2master = $this->link2master ;

        $sql = "INSERT INTO master_line_items(recnum, opnnum,opn_desc,
                      work_center,opn_ref_no, revnum, link2master)
                 VALUES ($objid, $opnnum, $opn_desc,$work_center,
                       $opn_ref_no, $revnum, $link2master)";
    //echo $sql;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to master  process sheet line items didn't work..Please report to Sysadmin. " . mysql_error());
        }
         $sql = "update seqnum set nxtnum = $objid where tablename = 'master_line_items'";
   // echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for invoice line items..Please report to Sysadmin. " . mysql_error());
        }
     }

    function updateLI($recnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $opnnum =  $this->opnnum ;
        $opn_desc = "'" . $this->opn_desc . "'";
        $work_center = "'" . $this->work_center . "'";
        $opn_ref_no = "'" . $this->opn_ref_no . "'";
        $revnum = "'" . $this->revnum . "'";

        $sql = "update master_line_items set
                              opnnum = $opnnum,
                              opn_desc = $opn_desc,
                              work_center = $work_center,
                              opn_ref_no = $opn_ref_no,
                              revnum = $revnum
                        where recnum = $recnum";
                    //  echo $sql;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to Master didn't work..Please report to Sysadmin. " . mysql_error());

     }


     function getLI($inpmastrecnum) {
        $masterrecnum = "'" . $inpmastrecnum . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select opnnum, opn_desc,work_center, opn_ref_no,revnum,recnum
                   from master_line_items
                   where link2master = $masterrecnum";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }


     function deleteLI($inplirecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $lirecnum = "'" . $inplirecnum . "'";
        $sql = "delete from master_line_items where recnum = $lirecnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Line Items failed...Please report to SysAdmin. " . mysql_error());
      }

} // End master line items class definition


