<?
//====================================
// Author: FSI
//  Date-written = march 22, 2007
// Filename: masterliClass.php
// Maintains the class for PO Line items
// Revision: v1.0
//====================================

include_once('loginClass.php');

class mechproperties {

    var
     $recno,
     $lineno,
     $constituents,
     $standard_min,
     $standard_max,
     $supplier_min,
     $supplier_max,
     $report_lab,
     $remarks,
     $link2testreport;

    // Constructor definition
    function mechproperties() {
        $this->recno = '';
        $this->lineno = '';
        $this->constituents = '';
        $this->standard_min = '';
        $this->standard_max = '';
        $this->supplier_min = '';
        $this->supplier_max = '';
        $this->report_lab = '';
        $this->remarks = '';
        $this->link2testreport = '';
     }

    // Property get and set
    function getlineno() {
           return $this->lineno;
    }

    function setlineno($reqlineno) {

           $this->lineno = $reqlineno;
    }
    
    function getconstituents() {
           return $this->constituents;
    }

    function setconstituents ($reqconstituents) {

           $this->constituents = $reqconstituents;
    }

    function getstandard_min() {
           return $this->standard_min;
    }

    function setstandard_min ($reqstandard_min) {
           $this->standard_min = $reqstandard_min;
    }

    function getstandard_max() {
           return $this->standard_max;
    }
    function setstandard_max ($reqstandard_max) {
           $this->standard_max = $reqstandard_max;
    }

    function getsupplier_min() {
           return $this->supplier_min;
    }

    function setsupplier_min ($reqsupplier_min) {
           $this->supplier_min = $reqsupplier_min;
    }
    function getsupplier_max() {
           return $this->supplier_max;
    }

    function setsupplier_max ($reqsupplier_max) {
           $this->supplier_max = $reqsupplier_max;
    }
    function getreport_lab() {
           return $this->report_lab;
    }

    function setreport_lab ($reqreport_lab) {
           $this->report_lab = $reqreport_lab;
    }

    function getremarks() {
           return $this->remarks;
    }

    function setremarks ($remarks) {
           $this->remarks = $remarks;
    }

    function getlink2testreport() {
           return $this->link2testreport;
    }

    function setlink2testreport ($link2testreport) {
           $this->link2testreport = $link2testreport;
    }

    function addLI4m() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'mechanical_properties_li' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for mechanical properties line items..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

        $lineno = $this->lineno;
        $constituents = "'" .  $this->constituents . "'";
        $standard_min = "'" . $this->standard_min . "'";
        $standard_max = "'" . $this->standard_max . "'";
        $supplier_min = "'" . $this->supplier_min . "'";
        $supplier_max = "'" . $this->supplier_max . "'";
        $report_lab = "'" . $this->report_lab . "'";
        $remarks = "'" . $this->remarks . "'";
        $link2testreport= "'" . $this->link2testreport . "'";

        $sql = "INSERT INTO mechanical_properties_li(recno,
                                                    constituents,
                                                    standard_min,
                                                    standard_max,
                                                    supplier_min,
                                                    supplier_max,
                                                    report_lab,
                                                    remarks,
                                                    link2testreport,
                                                    lineno)
                                           VALUES ($objid,
                                                   $constituents,
                                                   $standard_min,
                                                   $standard_max,
                                                   $supplier_min,
                                                   $supplier_max,
                                                   $report_lab,
                                                   $remarks,
                                                   $link2testreport,
                                                   $lineno)";
//echo "mech" . $sql;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to mechanical properties line items didn't work..Please report to Sysadmin. " . mysql_error());
        }
         $sql = "update seqnum set nxtnum = $objid where tablename = 'mechanical_properties_li'";
   // echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for mechanical properties line items..Please report to Sysadmin. " . mysql_error());
        }
     }

    function updateLI($recnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        
        $lineno =$this->lineno;
        $constituents = "'" . $this->constituents . "'";
        $standard_min = "'" . $this->standard_min . "'";
        $standard_max = "'" . $this->standard_max . "'";
        $supplier_min = "'" . $this->supplier_min . "'";
        $supplier_max = "'" . $this->supplier_max . "'";
        $report_lab = "'" . $this->report_lab . "'";
        $remarks = "'" . $this->remarks . "'";

        $sql = "update mechanical_properties_li set
                              lineno = $lineno,
                              constituents = $constituents,
                              standard_min = $standard_min,
                              standard_max = $standard_max,
                              supplier_min = $supplier_min,
                              supplier_max = $supplier_max,
                              report_lab = $report_lab,
                              remarks = $remarks

                        where recno = $recnum";
 //echo "mech" . $sql;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to mechanical properties didn't work..Please report to Sysadmin. " . mysql_error());

     }


     function getLI($inptrrecnum) {
        $testreportrecnum = "'" . $inptrrecnum . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select constituents,
                       standard_min,
                       standard_max,
                       supplier_min,
                       supplier_max,
                       report_lab,
                       remarks,
                       lineno,
                       recno

                   from mechanical_properties_li
                   where link2testreport = $testreportrecnum";
//echo  $sql;
        $result = mysql_query($sql);
        return $result;
     }


     function deleteLI($inplirecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $lirecnum =  $inplirecnum;
        $sql = "delete from mechanical_properties_li where recno = $lirecnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Line Items failed...Please report to SysAdmin. " . mysql_error());
      }

} // End master line items class definition


