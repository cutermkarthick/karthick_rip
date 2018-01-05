<?
//====================================
// Author: FSI
// Date-written = April 27,2010
// Filename: bomli_opnClass.php
// Maintains the class for BOM Bought Line items
// Revision: v1.0
//====================================

include_once('loginClass.php');

class bomli_op {

   var
     $opn,
     $stn,
     $op_descr,
     $signoff,
     $remarks,
     $link2bom;


    // Constructor definition
    function bomli_op() {
        $this->opn = '';
        $this->stn = '';
        $this->descr = '';
        $this->signoff = '';
        $this->remarks = '';
        $this->link2bom = '';
     }

    // Property get and set
    function getopn() {
           return $this->opn;
    }

    function setopn($reqopn) {
           $this->opn = $reqopn;
    }

    function getstn() {
           return $this->stn;
    }

    function setstn ($reqstn) {
           $this->stn = $reqstn;
    }

    function getdescr() {
           return $this->descr;
    }
    function setdescr ($reqdescr) {
           $this->descr = $reqdescr;
    }

    function getsignoff() {
           return $this->signoff;
    }
    function setsignoff($reqsignoff) {
           $this->signoff = $reqsignoff;
    }
    function getremarks() {
           return $this->remarks;
    }
    function setremarks($reqremarks) {
           $this->remarks = $reqremarks;
    }
    function getlink2bom() {
           return $this->link2bom;
    }
    function setlink2bom($reqlink2bom) {
           $this->link2bom = $reqlink2bom;
    }


    function addLi() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'bom_op_desc' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for BOM OPN..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $op = "'" . $this->opn . "'";
        $stn = "'" . $this->stn . "'";
        $op_descr = "'" . $this->descr . "'";
        $signoff = "'" . $this->signoff . "'";
        $remarks = "'" . $this->remarks . "'";
        $link2bom = $this->link2bom;

        $sql = "INSERT INTO bom_op_desc (recnum, opn_num, stn, oper_desc, signoff, remarks,link2bom)
                                    VALUES ($objid, $op, $stn, $op_descr, $signoff, $remarks,$link2bom)";
        //echo $sql;
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to BOM OPN  didn't work..Please report to Sysadmin. " . mysql_error());
        }
        $sql = "update seqnum set nxtnum = $objid where tablename = 'bom_op_desc'";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert didn't work for BOM OPN..Please report to Sysadmin. " . mysql_error());
        }

        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Commit failed for BOM OPN Insert..Please report to Sysadmin. " . mysql_error());
        }
     }

    function updateLI($recnum) {
        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        
        $op = "'" . $this->opn . "'";
        $stn = "'" . $this->stn . "'";
        $op_descr = "'" . $this->descr . "'";
        $signoff = "'" . $this->signoff . "'";
        $remarks = "'" . $this->remarks . "'";

        $sql = "update bom_op_desc
                set  opn_num = $op,
                     stn = $stn,
                     oper_desc = $op_descr,
                     signoff = $signoff,
                     remarks = $remarks
                where recnum = $lirecnum";
           //echo $sql;
           $result = mysql_query($sql);

           // Test to make sure query worked
           if(!$result) die("Update to BOM OPN didn't work..Please report to Sysadmin. " . mysql_error());

     }


     function getLI($link) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select recnum,opn_num, stn, oper_desc, signoff,remarks
                   from bom_op_desc
                   where link2bom = $link";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }



     function deleteLI($inplirecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $lirecnum = $inplirecnum;
        $sql = "delete from bom_op_desc where recnum = $lirecnum";

        $result = mysql_query($sql);
        if(!$result) die("Delete for BOM OPN failed...Please report to SysAdmin. " . mysql_error());
      }


} // End bomli_opnClass class definition
