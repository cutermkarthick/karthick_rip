<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: quoteClass.php
// Maintains the class for Quotes
// Revision: v1.0
//====================================

include_once('loginClass.php');

class stage_insp_report {

    var  $refnum,
         $opnnum,
         $partnum,
         $batch_qty,
         $partname,
         $sheet,
         $remarks,
         $tr_no,
         $rev_no,
         $revdate;

    // Constructor definition
    function stage_insp_report() {
        $this->refnum = '';
        $this->opnnum = '';
        $this->partnum = '';
        $this->batch_qty = '';
        $this->partname = '';
        $this->sheet = '';
        $this->remarks = '';
        $this->tr_no = '';
        $this->rev_no = '';
        $this->revdate = '';

    }

    // Property get and set
    function getrefnum() {
           return $this->refnum;
    }

    function setrefnum ($refnum) {
           $this->refnum = $refnum;
    }

    function getopnnum() {
           return $this->opnnum;
    }

    function setopnnum ($opnnum) {
           $this->opnnum = $opnnum;
    }
    function getpartnum() {
           return $this->partnum;
    }

    function setpartnum ($partnum) {
           $this->partnum = $partnum;
    }

    function getbatch_qty() {
           return $this->batch_qty;
    }

    function setbatch_qty ($batch_qty) {
           $this->batch_qty = $batch_qty;
    }
    
    function getpartname() {
           return $this->partname;
    }

    function setpartname ($partname) {
           $this->partname = $partname;
    }

    function getsheet() {
           return $this->sheet;
    }

    function setsheet ($sheet) {
           $this->sheet = $sheet;
    }
    
     function getremarks() {
           return $this->remarks;
    }

    function setremarks ($remarks) {
           $this->remarks = $remarks;
    }
    
     function gettr_no() {
           return $this->tr_no;
    }

    function settr_no ($tr_no) {
           $this->tr_no = $tr_no;
    }
    
     function getrev_no() {
           return $this->rev_no;
    }

    function setrev_no ($rev_no) {
           $this->rev_no = $rev_no;
    }
    
     function getrevdate() {
           return $this->revdate;
    }

    function setrevdate ($revdate) {
           $this->revdate = $revdate;
    }



     function addStage_insp() {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'stage_insp_report' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        
        $refnum = "'" . $this->refnum . "'";
        $opnnum =  "'" . $this->opnnum . "'";
        $partnum =  "'" . $this->partnum . "'";
        $batch_qty = "'" . $this->batch_qty . "'";
        $partname =  "'" . $this->partname . "'";
        $sheet =  "'" . $this->sheet . "'";
        $remarks = "'" . $this->remarks . "'";
        $tr_no = "'" . $this->tr_no . "'";
        $rev_no = "'" . $this->rev_no . "'";
        $revdate = "'" . $this->revdate . "'";

        $sql = "select * from stage_insp_report where refnum = $refnum";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        stage_insp_report
                           (recnum,
                            refnum,
                            opnnum,
                            partnum,
                            batch_qty,
                            partname,
                            sheet,
                            remarks,
                            tr_no,
                            rev_no,
                            revdate)
                    VALUES
                           ($objid,
                            $refnum,
                            $opnnum,
                            $partnum,
                            $batch_qty,
                            $partname,
                            $sheet,
                            $remarks,
                            $tr_no,
                            $rev_no,
                            $revdate)";
        //echo $sql;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to stage_insp_report didn't work..Please report to Sysadmin. " . mysql_error());
         }
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Ref Num " . $refnum . " already exists. ");
         }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'stage_insp_report'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
        //echo " <br>objid: $objid<br>";
         return $objid;
     }

     function getStage_insps($cond,$argoffset,$sort1,$arglimit) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        /* if ($sort1 == 'refnum') {
           $sortorder1 = 'sir.refnum';
        }
           $sortorder = $sortorder1;*/
        $sql= "select sir.recnum, sir.refnum,sir.opnnum, sir.partnum, sir.batch_qty,
                         sir.partname,sir.sheet,sir.remarks,sir.tr_no,sir.rev_no,
                         date_format(sir.revdate,'%d %b %y')
                    from stage_insp_report sir

                   where $wcond
                         limit $offset, $limit";
        
       /* $sql = "SELECT
                  recnum,
                  refnum,
                  opnnum,
                  partnum,
                  batch_qty,
                  partname,
                  sheet,
                  remarks,
                  tr_no,
                  rev_no,
                  revdate
                FROM stage_insp_report";   */
      // echo $sql;
        $result = mysql_query($sql);
        return $result;

     }
     
     function getStage_insp($stage_insprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT
                  recnum,
                  refnum,
                  opnnum,
                  partnum,
                  batch_qty,
                  partname,
                  sheet,
                  remarks,
                  tr_no,
                  rev_no,
                  revdate
                FROM stage_insp_report where recnum = $stage_insprecnum";
      // echo $sql;
        $result = mysql_query($sql);
        return $result;

     }


     function updateStage_insp($stage_insprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $refnum = "'" . $this->refnum . "'";
        $opnnum =  "'" . $this->opnnum . "'";
        $partnum =  "'" . $this->partnum . "'";
        $batch_qty = "'" . $this->batch_qty . "'";
        $partname =  "'" . $this->partname . "'";
        $sheet =  "'" . $this->sheet . "'";
        $remarks = "'" . $this->remarks . "'";
        $tr_no = "'" . $this->tr_no . "'";
        $rev_no = "'" . $this->rev_no . "'";
        $revdate = "'" . $this->revdate . "'";

        $sql = "UPDATE stage_insp_report SET
                    refnum = $refnum,
                    opnnum = $opnnum,
                    partnum = $partnum,
            	    batch_qty=$batch_qty,
            	    partname =$partname,
            	    sheet = $sheet,
            	    remarks =$remarks,
            	    tr_no = $tr_no,
            	    rev_no = $rev_no,
            	    revdate = $revdate
        	WHERE
                    recnum = $stage_insprecnum ";
   // echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("stage_insp_report update failed...Please report to SysAdmin. " . mysql_error());
        }


     function deletestage_insp($refnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from stage_insp_report where refnum = '$refnum'";
        $result = mysql_query($sql);
        if(!$result) die("Delete for stage insp failed...Please report to SysAdmin. " . mysql_error());
      }


   //Function for pagination coded by Jerry George 30 Dec -04
  function getstage_inspCount($cond,$argoffset,$arglimit)
    {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
             $sql = "select count(*) as numrows
                                      from stage_insp_report sir where  $wcond limit $offset, $limit";
       $newlogin = new userlogin;
       $newlogin->dbconnect();
  // echo "$sql";
    $result  = mysql_query($sql) or die('quote count query failed');
    $row     = mysql_fetch_array($result, MYSQL_ASSOC);
    $numrows = $row['numrows'];
    return $numrows;
    }

} // End quoteclass definition

