<?
//=========================================================
// Author: FSI                                            =
// Date-written = March 21 , 2007                         =
// Filename: processdeviationliClass.php                  =
// Maintains the class for process deviation Line items   =
// Revision: v1.0                                         =
//=========================================================

include_once('loginClass.php');

class procdeviationli {

    var
     $sl_num,
     $description,
     $signature,
     $link2procdev;

    // Constructor definition
    function invoiceli() {
        $this->sl_num = '';
        $this->description = '';
        $this->signature = '';
        $this->link2procdev = '';
     }
    function getsl_num() {
           return $this->sl_num;
    }
    function setsl_num($sl_num) {

           $this->sl_num = $sl_num;
    }

    function getdescription() {
           return $this->description;
    }
    function setdescription($description) {
           $this->description = $description;
    }

    function getsignature() {
           return $this->signature;
    }
    function setsignature($signature) {
           $this->signature = $signature;
    }

    function getlink2procdev() {
           return $this->link2procdev;
    }

    function setlink2procdev($link2procdev) {
           $this->link2procdev = $link2procdev;
    }

    function addProcdeviationli() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'proc_deviation_li' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for process deviation line items..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $sl_num = "'" . $this->sl_num . "'";
        $description = "'" . $this->description . "'";
        $signature = "'" . $this->signature . "'";
        $link2procdev = "'" . $this->link2procdev . "'";

        $sql = "INSERT INTO proc_deviation_li (recnum, sl_num, description,signature,link2procdev)
                                       VALUES ($objid, $sl_num, $description,$signature,$link2procdev)";
    //echo $sql;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to process deviation line items didn't work..Please report to Sysadmin. " . mysql_error());
        }
         $sql = "update seqnum set nxtnum = $objid where tablename = 'proc_deviation_li'";
   // echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for invoice line items..Please report to Sysadmin. " . mysql_error());
        }
     }

    function updateProcdeviationli($recnum) {
        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $sl_num = "'" . $this->sl_num . "'";
        $description = "'" . $this->description . "'";
        $signature = "'" . $this->signature . "'";
        $link2procdev = "'" . $this->link2procdev . "'";

        $sql = "update proc_deviation_li
                          set sl_num = $sl_num,
                              description = $description,
                              signature = $signature,
                              link2procdev = $link2procdev
                        where recnum = $lirecnum";
        // echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to proces deviation line items  didn't work..Please report to Sysadmin. " . mysql_error());

     }
     function getProcdeviationli($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $recnum =$inprecnum;

        $sql = "select sl_num, description,signature,link2procdev, recnum
                   from proc_deviation_li
                   where link2procdev = $recnum";
      // echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

    function deleteProcdeviationli($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $recnum =$inprecnum;
        $sql = "delete from proc_deviation_li where recnum = $recnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Line Items failed...Please report to SysAdmin. " . mysql_error());
      }

 }// End Process deviation line items class definition
