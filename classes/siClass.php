<?
//====================================
// Author: FSI
// Date-written = Feb 26, 2007
// Filename:mmClass.php
// Maintains the class for material movements
// Revision: v1.0
//====================================



class stage_insp {

var

    $link2wo,
    $remarks,
    $qc_sign,
	$stagenum,
    $fqc_sign,
    $fremarks,
    $prodn_sign,
    $premarks;

    // Constructor definition
    function stage_insp() {
    
        $this->stagenum = '';
        $this->qc_sign = '';
        $this->link2wo = '';
        $this->remarks = '';
        
        $this->fqc_sign = '';
        $this->fremarks = '';
        $this->prodn_sign = '';
        $this->premarks = '';
    }
    
    function getstagenum() {
           return $this->stagenum;
    }

    function setstagenum($stagenum) {

           $this->stagenum = $stagenum;
    }

    function getqc_sign() {
           return $this->qc_sign;
    }

    function setqc_sign($qc_sign) {

           $this->qc_sign = $qc_sign;
    }

    function getlink2wo() {
           return $this->link2wo;
    }

    function setlink2wo ($link2wo) {
           $this->link2wo = $link2wo;
    }
    function getremarks() {
           return $this->remarks;
    }

    function setremarks ($remarks) {
           $this->remarks = $remarks;
    }
    
    
    function getfqc_sign() {
           return $this->fqc_sign;
    }

    function setfqc_sign ($fqc_sign) {
           $this->fqc_sign = $fqc_sign;
    }
    
    function getfremarks() {
           return $this->fremarks;
    }

    function setfremarks ($fremarks) {
           $this->fremarks = $fremarks;
    }
    
    function getprodn_sign() {
           return $this->prodn_sign;
    }

    function setprodn_sign ($prodn_sign) {
           $this->prodn_sign = $prodn_sign;
    }
    
    function getpremarks() {
           return $this->premarks;
    }

    function setpremarks ($premarks) {
           $this->premarks = $premarks;
    }

    function addsi() {

//        $sql = "start transaction";
//        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'stage_insp' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for stage_insp..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

        $stagenum = $this->stagenum;
        $qc_sign = "'". $this->qc_sign . "'";
        $link2wo = $this->link2wo;
        $remarks = "'" . $this->remarks . "'";
        
        $fqc_sign = "'" . $this->fqc_sign . "'";
        $fremarks =  "'" . $this->fremarks . "'";
        $prodn_sign = "'" . $this->prodn_sign . "'";
        $premarks =  "'" . $this->premarks . "'";

        $sql = "INSERT INTO stage_insp (recnum, seqnum, qc_sign, link2wo, remarks, fqc_sign, fremarks, prodn_sign, premarks)
               VALUES ($objid, $stagenum, $qc_sign, $link2wo, $remarks, $fqc_sign, $fremarks, $prodn_sign, $premarks)";
     //echo $sql;
        $result = mysql_query($sql);
        

        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to satge_insp didn't work..Please report to Sysadmin. " . mysql_error());
        }
         $sql = "update seqnum set nxtnum = $objid where tablename = 'stage_insp'";
   // echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for stage_insp..Please report to Sysadmin. " . mysql_error());
        }

    }

    function updatesi($recnum, $seqnum) {
        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $stagenum = $this->stagenum;
        $qc_sign = "'". $this->qc_sign . "'";
        $link2wo = $this->link2wo;
        $remarks = "'" . $this->remarks . "'";
        
        $fqc_sign = "'" . $this->fqc_sign . "'";
        $fremarks =  "'" . $this->fremarks . "'";
        $prodn_sign = "'" . $this->prodn_sign . "'";
        $premarks =  "'" . $this->premarks . "'";

        $sql = "update stage_insp
                          set
                             qc_sign = $qc_sign,
                             remarks = $remarks,
                             fqc_sign = $fqc_sign,
                             fremarks = $fremarks,
                             prodn_sign = $prodn_sign,
                             premarks = $premarks
                       where link2wo = $lirecnum and seqnum=$seqnum";
   //echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to fid didn't work..Please report to Sysadmin. " . mysql_error());

     }

     function getsi($inprecnum) {
        $worecnum = $inprecnum;

        $sql = "select qc_sign, remarks, fqc_sign, fremarks, prodn_sign, premarks
                   from stage_insp
                   where link2wo = $worecnum";
     // echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

    function deletefid($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $recnum =$inprecnum;
        $sql = "delete from fid where recnum = $recnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for fid failed...Please report to SysAdmin. " . mysql_error());
      }

 }// End so class definition
