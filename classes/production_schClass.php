<?
//====================================
// Author: FSI
// Date-written = July 18, 2008
// Filename: production_schclass.php
// Maintains the class for Production Schedule
// Revision: v1.0
//====================================

include_once('classes/loginClass.php');

class production_sch {

    var  $crnnum,
         $quantity,
         $due_date,
         $est_start_date;

    // Constructor definition
    function production_sch() {
        $this->crnnum = '';
        $this->quantity = '';
        $this->book_date = '';
    }

    // Property get and set
    function getcrnnum() {
           return $this->crnnum;
    }

    function setcrnnum ($crnnum) {
           $this->crnnum = $crnnum;
    }

    function getquantity() {
           return $this->quantity;
    }

    function setquantity ($quantity) {
           $this->quantity = $quantity;
    }
    function getbook_date() {
           return $this->book_date;
    }

    function setbook_date ($book_date) {
           $this->book_date = $book_date;
    }
    function getdue_date() {
           return $this->due_date;
    }

    function setdue_date ($due_date) {
           $this->due_date = $due_date;
    }

    function addprod_sch() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'production_sch' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        
		$crntnum = "'" . $this->crnnum . "'";
        $partnum = "'" . $this->partnum . "'";
        $quantity = "'" . $this->quantity . "'";
		$book_date = "'" . $this->book_date . "'";
        $due_date = "'" . $this->due_date . "'";
        $est_start_date = "'" . $this->est_start_date . "'";

        $sql = "select * from standard where recnum = $objid";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        production_sch
                           (recnum,
							crnnum,
                            partnum,
                            quantity,
							book_date,
                            due_date,
                            est_start_date)
                     VALUES
                           ($objid,
							$crnnum
                            $partnum,
                            $quantity,
							$bookdate
                            $due_date,
                            $est_start_date
							$)";
        //echo $sql;
           $result = mysql_query($sql);

           $sql = 'commit';
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to production_sch didn't work..Please report to Sysadmin. " . mysql_error());
         }
    else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("recnum " . $objid . " already exists. ");
         }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'production_sch'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
        //echo " <br>objid: $objid<br>";
         return $objid;
     }

     function getschedule_details($crn,$quantity) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $crnnum = "'" . $crn . "'";
        $qty = $quantity;

        $sql= "select m.crn_num,
		              sum(((setting_time*60) + setting_time_mins)) as st, 
                      sum(((running_time*60) + running_time_mins)*$qty) as rt,
					  md.rm_type, md.rm_spec, curdate()
                from mc_stage_master msm, 
					 mc_master m,
					 master_data md
                where msm.link2mc_master = m.recnum and 
                      m.crn_num = $crnnum and
                      md.CIM_refnum = m.crn_num
                group by m.crn_num";

        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }


} // End production schedule definition

