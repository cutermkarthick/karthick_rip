<?
//====================================
// Author: FSI
// Date-written = Feb 26, 2007
// Filename:mmClass.php
// Maintains the class for material movements
// Revision: v1.0
//====================================



class fid {

var
	$line_num,
	$qty_recd,
	$qty_accp,
	$cim_num,
	$dc_qty,
	$insp_report_num,
	$cust_information,
	$remarks,
    $link2wo,
    $cim_date;

    // Constructor definition
    function fid() {
        $this->line_num= '';
        $this->qty_recd = '';
        $this->qty_accp = '';
        $this->cim_num = '';
        $this->dc_qty = '';
        $this->insp_report_num = '';
        $this->cust_information = '';
        $this->remarks= '';
        $this->link2wo= '';
        $this->cim_date= '';
    }
        
    function getline_num() {
           return $this->line_num;
    }

    function setline_num ($line_num) {

           $this->line_num = $line_num;
    }

    function getqty_recd() {
           return $this->qty_recd;
    }

    function setqty_recd($qty_recd) {
           $this->qty_recd = $qty_recd;
    }


    function getqty_accp() {
           return $this->qty_accp;
    }

    function setqty_accp ($qty_accp) {
           $this->qty_accp = $qty_accp;
    }

    function getcim_num() {
           return $this->cim_num;
    }

    function setcim_num ($cim_num) {
           $this->cim_num = $cim_num;
    }
    function getdc_qty() {
           return $this->dc_qty;
    }

    function setdc_qty ($dc_qty) {
           $this->dc_qty = $dc_qty;
    }



    function getinsp_report_num() {
           return $this->insp_report_num;
    }

    function setinsp_report_num($insp_report_num) {

           $this->insp_report_num = $insp_report_num;
    }

    function getcust_information() {
           return $this->cust_information;
    }

    function setcust_information($cust_information) {
           $this->cust_information = $cust_information;
    }


    function getremarks() {
           return $this->remarks;
    }

    function setremarks ($remarks) {
           $this->remarks = $remarks;
    }

    function getlink2wo() {
           return $this->link2wo;
    }

    function setlink2wo ($link2wo) {
           $this->link2wo = $link2wo;
    }
    
    function getcim_date() {
           return $this->cim_date;
    }

    function setcim_date ($cim_date) {
           $this->cim_date = $cim_date;
    }


    function addfid() {

        //echo 'aaa';
//        $sql = "start transaction";
//        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'fid' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for fid..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        
        $line_num =  $this->line_num;
        $qty_recd = "'" . $this->qty_recd . "'";
        $qty_accp = "'" . $this->qty_accp . "'";
        $cim_num = "'" . $this->cim_num . "'";
        $dc_qty = "'" . $this->dc_qty . "'";
        $insp_report_num  = "'" . $this->insp_report_num . "'";
        $cust_information  = "'" . $this->cust_information . "'";
        $remarks = "'" . $this->remarks . "'";
        $link2wo  = $this->link2wo;
        
        if($this->cim_date != '' || $this->cim_date != '0000-00-00')
        {
          $cim_date = "'" . $this->cim_date . "'";
        }
        else
        {
          $cim_date = 'NULL';
        }


        $sql = "INSERT INTO fid (recnum, line_num, qty_recd, qty_accp, cim_num,
                       dc_qty,insp_report_num,cust_information,remarks,link2wo,cim_date)
               VALUES ($objid, $line_num, $qty_recd, $qty_accp,  $cim_num,
                       $dc_qty,$insp_report_num,$cust_information,$remarks,$link2wo,$cim_date)";
     //echo $sql;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to fid didn't work..Please report to Sysadmin. " . mysql_error());
        }
         $sql = "update seqnum set nxtnum = $objid where tablename = 'fid'";
   // echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for fid..Please report to Sysadmin. " . mysql_error());
        }
     }

    function updatefid($recnum) {
        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $line_num =  $this->line_num;
        $qty_recd = "'" . $this->qty_recd . "'";
        $qty_accp = "'" . $this->qty_accp . "'";
        $cim_num = "'" . $this->cim_num . "'";
        $dc_qty = "'" . $this->dc_qty . "'";
        $insp_report_num  = "'" . $this->insp_report_num . "'";
        $cust_information  = "'" . $this->cust_information . "'";
        $remarks = "'" . $this->remarks . "'";
        $cim_date = "'" . $this->cim_date . "'";
        
        $sql = "update fid
                          set line_num = $line_num,
                              qty_recd = $qty_recd,
                              qty_accp = $qty_accp,
                              cim_num= $cim_num,
                              dc_qty = $dc_qty,
                              insp_report_num = $insp_report_num,
                              cust_information = $cust_information,
                              remarks = $remarks,
                              cim_date = $cim_date
                        where recnum = $lirecnum";
  // echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to fid didn't work..Please report to Sysadmin. " . mysql_error());
     }

     function getfid($inprecnum) {
        $worecnum = $inprecnum;

        $sql = "select line_num, qty_recd, qty_accp,
                       cim_num, dc_qty, insp_report_num, cust_information, remarks,
                      recnum, cim_date
                   from fid
                   where link2wo = $worecnum";
//echo $sql;
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
