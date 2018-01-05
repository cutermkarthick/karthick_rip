<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: liClass.php
// Maintains the class for PO Line items
// Revision: v1.0
//====================================

include_once('loginClass.php');

class purchasing_alloc {

    var
     $linenum,
     $material_spec,
     $cim,
     $qty_allocated,
     $poNum,
     $link2poli;


    // Constructor definition
    function purchasing_alloc() {
        $this->linenum = '';
        $this->material_spec = '';
        $this->cim = '';
        $this->qty_allocated = '';
        $this->poNum = '';
        $this->link2poli = '';
     }

    // Property get and set
    function getlinenum() {
           return $this->linenum;
    }

    function setlinenum ($reqlinenum) {

           $this->linenum = $reqlinenum;
    }

    function getmat_spec() {
           return $this->material_spec;
    }

    function setmat_spec ($reqitemname) {
           $this->material_spec = $reqitemname;
    }

    function getcim() {
           return $this->cim;
    }
    function setcim ($reqcim) {
           $this->cim = $reqcim;
    }

    function getqty() {
           return $this->qty_allocated;
    }

    function setqty ($reqqty) {
           $this->qty_allocated = $reqqty;
    }

    function getponum() {
           return $this->poNum;
    }

    function setponum ($reqpo) {
           $this->poNum = $reqpo;
    }
    
    function getpoli() {
           return $this->link2poli;
    }

    function setpoli ($reqpoli) {
           $this->link2poli = $reqpoli;
    }


    function addpurchasing() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'purchasing_alloc' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for LI..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $line_num = "'" . $this->linenum . "'";
        $mat_spec = "'" . $this->material_spec . "'";
        $crn = "'" . $this->cim . "'";
        $ponum = "'" . $this->poNum . "'";
        $qty =  "'" . $this->qty_allocated . "'";
        $linktopoli =  "'" . $this->link2poli . "'";


        $sql = "INSERT INTO purchasing_alloc (recnum, linenum, mat_spec, crn, qty_allocated, ponum,
                                           link2poli)
               VALUES ($objid, $line_num, $mat_spec, $crn, $qty, $ponum, $linktopoli)";
        //echo "$sql";
        $result = mysql_query($sql) or die("Insert to Purchasing Allocation didn't work..Please report to Sysadmin. " . mysql_error()); ;
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to LI didn't work..Please report to Sysadmin. " . mysql_error());
        }
        $sql = "update seqnum set nxtnum = $objid where tablename = 'purchasing_alloc'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for Purchasing..Please report to Sysadmin. " . mysql_error());
        }
        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Commit failed for PO Insert..Please report to Sysadmin. " . mysql_error());
        }
     }

    function updateLI($recnum) {
        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $line_num = "'" . $this->linenum . "'";
        $mat_spec = "'" . $this->material_spec . "'";
        $crn = "'" . $this->cim . "'";
        $qty =  "'" . $this->qty_allocated . "'";



        $sql = "update purchasing_alloc
                          set linenum = $line_num,
                              mat_spec = $mat_spec,
                              crn = $crn,
                              qty_allocated = $qty
                        where recnum = $lirecnum";
           //echo $sql;

           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to Purchasing Allocation didn't work..Please report to Sysadmin. " . mysql_error());

     }


     function getpurchDetails($link2poli,$ponumber) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select recnum,linenum,mat_spec,crn,
                       qty_allocated, ponum
                   from purchasing_alloc
                   where link2poli = $link2poli and ponum = '$ponumber' order by recnum";
        //echo $sql;

        $result = mysql_query($sql);
        return $result;
     }



     function deleteLI($inplirecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $lirecnum = "'" . $inplirecnum . "'";
        $sql = "delete from po_line_items where recnum = $lirecnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Line Items failed...Please report to SysAdmin. " . mysql_error());
      }

} // End po class definition


