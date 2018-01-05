<?
//====================================================
// Author: FSI                                       =
// Date-written = March 20 , 2007                    =
// Filename: qualityplanliClass.php                  =
// Maintains the class for Quality Plan Line items   =
// Revision: v1.0                                    =
//====================================================

include_once('loginClass.php');

class custdatali {

    var
      $refnum,
      $px,
      $py,
      $pz,
      $mx,
      $my,
      $mz,
      $remarks,
      $link2custdata;

    // Constructor definition
    function custdatali() {
        $this->refnum = '';
        $this->px = '';
        $this->py = '';
        $this->pz = '';
        $this->mx = '';
        $this->my = '';
        $this->mz = '';
        $this->remarks = '';
        $this->link2custdata = '';
    }
    function getrefnum() {
           return $this->refnum;
    }
    function setrefnum($reqrefnum) {

           $this->refnum = $reqrefnum;
    }

    function getpx() {
           return $this->px;
    }
    function setpx($reqpx) {
           $this->px = $reqpx;
    }

    function getpy() {
           return $this->py;
    }
    function setpy($reqpy) {
           $this->py = $reqpy;
    }

    function getpz() {
           return $this->pz;
    }
    function setpz($reqpz) {
           $this->pz = $reqpz;
    }

    function getmx() {
           return $this->mx;
    }
    function setmx ($reqmx) {
           $this->mx = $reqmx;
    }

    function getmy() {
           return $this->my;
    }

    function setmy($reqmy) {
           $this->my = $reqmy;
    }
    
    function getmz() {
           return $this->mz;
    }

    function setmz($reqmz) {
           $this->mz = $reqmz;
    }
    
    function getremarks() {
           return $this->remarks;
    }

    function setremarks($reqremarks) {
           $this->remarks = $reqremarks;
    }
    
    function getlink2custdata() {
           return $this->link2custdata;
    }

    function setlink2custdata($reqlink2custdata) {
           $this->link2custdata = $reqlink2custdata;
    }
    


    function addcustdatali() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'cust_data_lineitems' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for customer data validation line items..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

        $refnum = $this->refnum ;
        $px = $this->px ;
        $py = $this->py ;
        $pz = $this->pz;
        $mx = $this->mx;
        $my = $this->my ;
        $mz = $this->mz;
        $remarks = "'" . $this->remarks . "'";
        $link2custdata = $this->link2custdata ;

        $sql = "INSERT INTO cust_data_lineitems (recnum, refnum, px,
                      py, pz, mx, my, mz, remarks, link2custdata)
                 VALUES ($objid, $refnum, $px, $py, $pz,
                  $mx, $my, $mz, $remarks, $link2custdata)";
    //echo $sql;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to customer data line items didn't work..Please report to Sysadmin." . mysql_error());
        }
        $sql = "update seqnum set nxtnum = $objid where tablename = 'cust_data_lineitems'";
   // echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for line items..Please report to Sysadmin. " . mysql_error());
        }
     }

    function updatecustdatali($recnum) {
        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        
        $refnum = $this->refnum ;
        $px = $this->px ;
        $py = $this->py ;
        $pz = $this->pz;
        $mx = $this->mx;
        $my = $this->my ;
        $mz = $this->mz;
        $remarks = "'" . $this->remarks . "'";

       // echo "link is $link2custdata";

        $sql = "update cust_data_lineitems
                          set refnum = $refnum,
                              px = $px,
                              py = $py,
                              pz = $pz,
                              mx = $mx,
                              my = $my,
                              mz = $mz,
                              remarks = $remarks
                         where recnum = $lirecnum";
        // echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to customer data validation line items  didn't work..Please report to Sysadmin. " . mysql_error());

     }
     function getcustdatali($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $recnum =$inprecnum;

        $sql = "select refnum, px, py, pz, mx, my, mz, remarks, recnum
                   from cust_data_lineitems
                   where link2custdata = $recnum";
      // echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

    function deletecustdatali($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $recnum = $inprecnum;
        $sql = "delete from cust_data_lineitems where recnum = $recnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Line Items failed...Please report to SysAdmin. " . mysql_error());
      }

 }// End invoice line items class definition
