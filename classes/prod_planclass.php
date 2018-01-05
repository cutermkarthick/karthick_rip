<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: quoteClass.php
// Maintains the class for Quotes
// Revision: v1.0
//====================================

include_once('loginClass.php');

class prod_plan {

    var  $partnum,
         $customer,
         $description,
         $target,
         $start_date,
         $end_date,
         $status;

    // Constructor definition
    function prod_plan() {
        $this->partnum = '';
        $this->customer = '';
        $this->description = '';
        $this->target = '';
        $this->start_date = '';
        $this->end_date = '';
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

     function getstart_date() {
           return $this->start_date;
    }

    function setstart_date ($start_date) {
           $this->start_date = $start_date;
    }

    function getend_date() {
           return $this->end_date;
    }

    function setend_date ($end_date) {
           $this->end_date = $end_date;
    }

     function getstatus() {
           return $this->status;
    }

    function setstatus ($status) {
           $this->status = $status;
    }

    function addprod_plan() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'production_plan' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

         $partnum = "'" . $this->partnum . "'";
         $customer = "'" . $this->customer . "'";
         $description = "'" . $this->description . "'";
         $target = "'" . $this->target . "'";
         $start_date = "'" . $this->start_date . "'";
         $end_date = "'" . $this->end_date . "'";
         $status = "'" . $this->status . "'";

        $sql = "select * from production_plan where partnum = $partnum";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                    production_plan
                           (recnum,
                            partnum,
                            customer,
                            description,
                            target,
                            start_date,
                            end_date,
                            status)
                     VALUES
                           ($objid,
                            $partnum,
                            $customer,
                            $description,
                            $target,
                            $start_date,
                            $end_date,
                            $status)";
        //echo $sql;
           $result = mysql_query($sql);

           $sql = 'commit';
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to production_plan didn't work..Please report to Sysadmin. " . mysql_error());
         }
    else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("partnum " . $partnum . " already exists. ");
         }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'production_plan'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
        //echo " <br>objid: $objid<br>";
         return $objid;
     }

     function getallprod_plans() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();


           $sql= "select recnum, partnum,
                                 customer,
                                 description,
                                 target,
                                 start_date,
                                 end_date,
                                 status
                    from production_plan";

       //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

     function getprod_plan($prod_planrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();


           $sql= "select recnum,
                         partnum,
                         customer,
                         description,
                         target,
                         start_date,
                         end_date,
                         status
                    from production_plan where recnum=$prod_planrecnum";

       //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }


     function updateprod_plan($prod_planrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

         $partnum = "'" . $this->partnum . "'";
         $customer = "'" . $this->customer . "'";
         $description = "'" . $this->description . "'";
         $target = "'" . $this->target . "'";
         $start_date = "'" . $this->start_date . "'";
         $end_date = "'" . $this->end_date . "'";
         $status = "'" . $this->status . "'";

        $sql = "UPDATE production_plan SET
                     partnum=$partnum,
                     customer=$customer,
                     description=$description,
                     target=$target,
                     start_date=$start_date,
                     end_date=$end_date,
                     status=$status
        	    WHERE
                    recnum = $prod_planrecnum";
   // echo $sql;
        $result = mysql_query($sql);

        $sql = 'commit';
        $result = mysql_query($sql);
        if(!$result) die("production_plan update failed...Please report to SysAdmin. " . mysql_error());
        }


} // End quoteclass definition

