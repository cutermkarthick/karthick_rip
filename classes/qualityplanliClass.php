<?
//====================================================
// Author: FSI                                       =
// Date-written = March 20 , 2007                    =
// Filename: qualityplanliClass.php                  =
// Maintains the class for Quality Plan Line items   =
// Revision: v1.0                                    =
//====================================================

include_once('loginClass.php');

class qualityplanli {

    var
     $sl_num,
     $drawing_dim,
     $measuring_istrument,
     $samplesize,
     $remarks,
     $link2qualityplan;

    // Constructor definition
    function invoiceli() {
        $this->sl_num = '';
        $this->drawing_dim = '';
        $this->measuring_istrument = '';
        $this->samplesize = '';
        $this->remarks = '';
        $this->link2qualityplan = '';
     }
    function getsl_num() {
           return $this->sl_num;
    }
    function setsl_num($sl_num) {

           $this->sl_num = $sl_num;
    }

    function getdrawing_dim() {
           return $this->drawing_dim;
    }
    function setdrawing_dim($drawing_dim) {
           $this->drawing_dim = $drawing_dim;
    }

    function getmeasuring_istrument() {
           return $this->measuring_istrument;
    }
    function setmeasuring_istrument($measuring_istrument) {
           $this->measuring_istrument = $measuring_istrument;
    }

    function getsamplesize() {
           return $this->samplesize;
    }
    function setsamplesize ($samplesize) {
           $this->samplesize = $samplesize;
    }

    function getremarks() {
           return $this->remarks;
    }
    function setremarks ($remarks) {
           $this->remarks = $remarks;
    }

    function getlink2qualityplan() {
           return $this->link2qualityplan;
    }

    function setlink2qualityplan($link2qualityplan) {
           $this->link2qualityplan = $link2qualityplan;
    }

    function addQualityplanli() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'quality_plan_line_items' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for quality plan line items..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $sl_num = "'" . $this->sl_num . "'";
        $drawing_dim = "'" . $this->drawing_dim . "'";
        $measuring_istrument = "'" . $this->measuring_istrument . "'";
        $samplesize = "'" . $this->samplesize . "'";
        $remarks = "'" . $this->remarks . "'";
        $link2qualityplan = "'" . $this->link2qualityplan . "'";

        $sql = "INSERT INTO quality_plan_line_items (recnum, sl_num,drawing_dim,
                      measuring_istrument,samplesize, remarks, link2qualityplan)
                 VALUES ($objid, $sl_num, $drawing_dim,$measuring_istrument,
                       $samplesize, $remarks, $link2qualityplan)";
    //echo $sql;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to quality plan line items didn't work..Please report to Sysadmin. " . mysql_error());
        }
         $sql = "update seqnum set nxtnum = $objid where tablename = 'quality_plan_line_items'";
   // echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for invoice line items..Please report to Sysadmin. " . mysql_error());
        }
     }

    function updateQualityplanli($recnum) {
        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $sl_num = "'" . $this->sl_num . "'";
        $drawing_dim = "'" . $this->drawing_dim . "'";
        $measuring_istrument = "'" . $this->measuring_istrument . "'";
        $samplesize = "'" . $this->samplesize . "'";
        $remarks = "'" . $this->remarks . "'";
        $link2qualityplan = "'" . $this->link2qualityplan . "'";

        $sql = "update quality_plan_line_items
                          set sl_num = $sl_num,
                              drawing_dim = $drawing_dim,
                              measuring_istrument = $measuring_istrument,
                              samplesize = $samplesize,
                              remarks = $remarks,
                              link2qualityplan = $link2qualityplan
                        where recnum = $lirecnum";
        // echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to quality plan line items  didn't work..Please report to Sysadmin. " . mysql_error());

     }
     function getQualityplanli($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $recnum =$inprecnum;

        $sql = "select sl_num,drawing_dim,measuring_istrument,samplesize, remarks, link2qualityplan, recnum
                   from quality_plan_line_items
                   where link2qualityplan = $recnum";
      // echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

    function deleteQualityplanli($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $recnum =$inprecnum;
        $sql = "delete from quality_plan_line_items where recnum = $recnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Line Items failed...Please report to SysAdmin. " . mysql_error());
      }

 }// End invoice line items class definition
