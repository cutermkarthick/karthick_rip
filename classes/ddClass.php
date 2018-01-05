<?
//====================================
// Author: FSI
// Date-written = Feb 26, 2007
// Filename:mmClass.php
// Maintains the class for material movements
// Revision: v1.0
//====================================



class dd {

var
	$recnum,
	$line_num,
    $pur_ord_num,
    $comp_ser_num,
    $batch_num,
    $qty,
    $gate_pass_num,
    $gate_pass_date,
    $dc_num,
    $dc_date,
    $inspn_report,
    $insp_approval,
    $qchead_approval,
    $link2wo;

    // Constructor definition
    function dd() {
        $this->line_num= '';
        $this->pur_ord_num = '';
        $this->comp_ser_num = '';
        $this->batch_num = '';
        $this->qty = '';
        $this->gate_pass_num = '';
        $this->gate_pass_date = '';
        $this->dc_num= '';
        $this->dc_date= '';
        $this->inspn_report = '';
        $this->insp_approval= '';
        $this->qchead_approval= '';
        $this->link2wo= '';
    }

    function getline_num() {
           return $this->line_num;
    }

    function setline_num ($line_num) {

           $this->line_num = $line_num;
    }

    function getpur_ord_num() {
           return $this->pur_ord_num;
    }

    function setpur_ord_num($pur_ord_num) {
           $this->pur_ord_num = $pur_ord_num;
    }


    function getcomp_ser_num() {
           return $this->comp_ser_num;
    }

    function setcomp_ser_num ($comp_ser_num) {
           $this->comp_ser_num = $comp_ser_num;
    }

    function getbatch_num() {
           return $this->batch_num;
    }

    function setbatch_num ($batch_num) {
           $this->batch_num = $batch_num;
    }
    function getqty() {
           return $this->qty;
    }

    function setqty ($qty) {
           $this->qty = $qty;
    }

    function getgate_pass_num() {
           return $this->gate_pass_num;
    }

    function setgate_pass_num($gate_pass_num) {

           $this->gate_pass_num = $gate_pass_num;
    }

    function getgate_pass_date() {
           return $this->gate_pass_date;
    }

    function setgate_pass_date($gate_pass_date) {
           $this->gate_pass_date = $gate_pass_date;
    }


    function getdc_num() {
           return $this->dc_num;
    }

    function setdc_num ($dc_num) {
           $this->dc_num = $dc_num;
    }

    function getdc_date() {
           return $this->dc_date;
    }

    function setdc_date ($dc_date) {
           $this->dc_date = $dc_date;
    }
    
    function getinspn_report() {
           return $this->inspn_report;
    }

    function setinspn_report ($inspn_report) {
           $this->inspn_report = $inspn_report;
    }
    
    function getinsp_approval() {
           return $this->insp_approval;
    }

    function setinsp_approval ($insp_approval) {
           $this->insp_approval = $insp_approval;
    }
    
    function getqchead_approval() {
           return $this->qchead_approval;
    }

    function setqchead_approval ($qchead_approval) {
           $this->qchead_approval = $qchead_approval;
    }
    
    function getlink2wo() {
           return $this->link2wo;
    }

    function setlink2wo ($link2wo) {
           $this->link2wo = $link2wo;
    }

    function add_disp_det() {

        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'dd' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for dd..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        
        $line_num =  $this->line_num;
        $pur_ord_num = "'" . $this->pur_ord_num . "'";
        $comp_ser_num = "'" . $this->comp_ser_num . "'";
        $batch_num = "'" . $this->batch_num . "'";
        $qty = "'" . $this->qty . "'";
        $gate_pass_num  = "'" . $this->gate_pass_num . "'";
        
        if($this->gate_pass_date != '' || $this->gate_pass_date != '0000-00-00')
        {
          $gate_pass_date  = "'" . $this->gate_pass_date . "'";
        }
        else
        {
          $gate_pass_date  = 'NULL';
        }
        
        $dc_num = "'" . $this->dc_num . "'";
        
        if($this->dc_date != '' || $this->dc_date != '0000-00-00')
        {
          $dc_date  = "'" . $this->dc_date . "'";
        }
        else
        {
          $dc_date  = 'NULL';
        }
        
        $inspn_report  = "'" . $this->inspn_report . "'";
        $insp_approval  = "'" . $this->insp_approval . "'";
        $qchead_approval = "'" . $this->qchead_approval . "'";
        $link2wo  = $this->link2wo;


        $sql = "INSERT INTO dd (recnum,
                                 line_num,
                                 pur_ord_num,
                                 comp_ser_num,
                                 batch_num,
                                 qty,
                                 gate_pass_num,
                                 gate_pass_date,
                                 dc_num,
                                 dc_date,
                                 inspn_report,
                                 insp_approval,
                                 qchead_approval,
                                 link2wo)
                         VALUES ($objid,
                                 $line_num,
                                 $pur_ord_num,
                                 $comp_ser_num,
                                 $batch_num,
                                 $qty,
                                 $gate_pass_num,
                                 $gate_pass_date,
                                 $dc_num,
                                 $dc_date,
                                 $inspn_report,
                                 $insp_approval,
                                 $qchead_approval,
                                 $link2wo)";
    // echo $sql;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to dd didn't work..Please report to Sysadmin. " . mysql_error());
        }
         $sql = "update seqnum set nxtnum = $objid where tablename = 'dd'";
   // echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for dd..Please report to Sysadmin. " . mysql_error());
        }
     }

    function updatedisp_det($recnum) {
        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $line_num =  $this->line_num;
        $pur_ord_num = "'" . $this->pur_ord_num . "'";
        $comp_ser_num = "'" . $this->comp_ser_num . "'";
        $batch_num = "'" . $this->batch_num . "'";
        $qty = "'" . $this->qty . "'";
        $gate_pass_num  = "'" . $this->gate_pass_num . "'";
        $gate_pass_date  = "'" . $this->gate_pass_date . "'";
        $dc_num = "'" . $this->dc_num . "'";
        $dc_date = "'" . $this->dc_date . "'";
        $inspn_report  = "'" . $this->inspn_report . "'";
        $insp_approval  = "'" . $this->insp_approval . "'";
        $qchead_approval = "'" . $this->qchead_approval . "'";

        $sql = "update dd
                          set line_num = $line_num,
                              pur_ord_num = $pur_ord_num,
                              comp_ser_num = $comp_ser_num,
                              batch_num= $batch_num,
                              qty = $qty,
                              gate_pass_num = $gate_pass_num,
                              gate_pass_date = $gate_pass_date,
                              dc_num = $dc_num,
                              dc_date = $dc_date,
                              inspn_report = $inspn_report,
                              insp_approval = $insp_approval,
                              qchead_approval = $qchead_approval
                        where recnum = $lirecnum";
  // echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to dd didn't work..Please report to Sysadmin. " . mysql_error());

     }

     function getdisp_det($inprecnum) {
        $worecnum = $inprecnum;

        $sql = "select recnum,
                       line_num,
                       pur_ord_num,
                       comp_ser_num,
                       batch_num,
                       qty,
                       gate_pass_num,
                       gate_pass_date,
                       dc_num,
                       dc_date,
                       inspn_report,
                       insp_approval,
                       qchead_approval,
                       link2wo
                   from dd
                   where link2wo = $worecnum";
//echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

    function deletedisp_det($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $recnum =$inprecnum;
        $sql = "delete from dd where recnum = $recnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for dd failed...Please report to SysAdmin. " . mysql_error());
      }

 }// End dd class definition
