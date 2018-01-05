<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: quoteClass.php
// Maintains the class for Quotes
// Revision: v1.0
//====================================

include_once('loginClass.php');

class partwise_req {

    var  $partnum,
         $customer,
         $description,
         $target,
         $achieved,
         $balance,
         $due_date,
         $status;

    // Constructor definition
    function partwise_req() {
        $this->partnum = '';
        $this->customer = '';
        $this->description = '';
        $this->target = '';
        $this->achieved = '';
        $this->balance = '';
        $this->due_date = '';
        $this->status = '';
    }

    // Property get and set
    function getpartnum() {
           return $this->partnum;
    }

    function setpartnum ($partnum) {
           $this->partnum = $partnum;
    }

    function getcustomer() {
           return $this->customer;
    }

    function setcustomer ($customer) {
           $this->customer = $customer;
    }
    function getdescription() {
           return $this->description;
    }

    function setdescription ($description) {
           $this->description = $description;
    }

    function gettarget() {
           return $this->target;
    }

    function settarget ($target) {
           $this->target = $target;
    }
    
     function getachieved() {
           return $this->achieved;
    }

    function setachieved ($achieved) {
           $this->achieved = $achieved;
    }

    function getbalance() {
           return $this->balance;
    }

    function setbalance ($balance) {
           $this->balance = $balance;
    }
    
     function getdue_date() {
           return $this->due_date;
    }

    function setdue_date ($due_date) {
           $this->due_date = $due_date;
    }

    function getstatus() {
           return $this->status;
    }

    function setstatus ($status) {
           $this->status = $status;
    }


    function addpartwise_req() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'partwise_req' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

         $partnum = "'" . $this->partnum . "'";
         $customer = "'" . $this->customer . "'";
         $description = "'" . $this->description . "'";
         $target = "'" . $this->target . "'";
         $achieved = "'" . $this->achieved . "'";
         $balance = "'" . $this->balance . "'";
         $due_date = "'" . $this->due_date . "'";
         $status = "'" . $this->status . "'";

        $sql = "select * from partwise_req where partnum = $partnum";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                    partwise_req
                           (recnum,
                            partnum,
                            customer,
                            description,
                            target,
                            achieved,
                            balance,
                            due_date,
                            status)
                     VALUES
                           ($objid,
                            $partnum,
                            $customer,
                            $description,
                            $target,
                            $achieved,
                            $balance,
                            $due_date,
                            $status)";
        //echo $sql;
           $result = mysql_query($sql);

           $sql = 'commit';
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to partwise_req didn't work..Please report to Sysadmin. " . mysql_error());
         }
    else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("partnum " . $partnum . " already exists. ");
         }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'partwise_req'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
        //echo " <br>objid: $objid<br>";
         return $objid;
     }

     function getallpartwise_reqs() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();


           $sql= "select recnum, partnum,
                            customer,
                            description,
                            target,
                            achieved,
                            balance
                    from partwise_req";

       //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

     function getpartwise_req($partwise_reqrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();


           $sql= "select recnum,
                            partnum,
                            customer,
                            description,
                            target,
                            achieved,
                            balance,
                            due_date,
                            status
                    from partwise_req where recnum=$partwise_reqrecnum";

       //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }


     function updatepartwise_req($partwise_reqrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

         $partnum = "'" . $this->partnum . "'";
         $customer = "'" . $this->customer . "'";
         $description = "'" . $this->description . "'";
         $target = "'" . $this->target . "'";
         $achieved = "'" . $this->achieved . "'";
         $balance = "'" . $this->balance . "'";
         $due_date = "'" . $this->due_date . "'";
         $status = "'" . $this->status . "'";

        $sql = "UPDATE partwise_req SET
                     partnum=$partnum,
                     customer=$customer,
                     description=$description,
                     target=$target,
                     achieved=$achieved,
                     balance=$balance,
                     due_date=$due_date,
                     status=$status
        	    WHERE
                    recnum = $partwise_reqrecnum";
   // echo $sql;
        $result = mysql_query($sql);

        $sql = 'commit';
        $result = mysql_query($sql);
        if(!$result) die("partwise_req update failed...Please report to SysAdmin. " . mysql_error());
        }



} // End quoteclass definition

