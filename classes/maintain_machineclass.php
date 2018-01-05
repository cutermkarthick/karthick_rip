<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: quoteClass.php
// Maintains the class for Quotes
// Revision: v1.0
//====================================

include_once('loginClass.php');

class maintain_machine {

    var  $machineid,
         $purpose,
         $task,
         $task_time,
         $cost,
         $currency;

    // Constructor definition
    function maintain_machine() {
        $this->machineid = '';
        $this->purpose = '';
        $this->task = '';
        $this->task_time = '';
        $this->cost = '';
        $this->currency = '';
    }

    // Property get and set
    function getmachineid() {
           return $this->machineid;
    }

    function setmachineid ($machineid) {
           $this->machineid = $machineid;
    }

    function getpurpose() {
           return $this->purpose;
    }

    function setpurpose ($purpose) {
           $this->purpose = $purpose;
    }
    function gettask() {
           return $this->task;
    }

    function settask ($task) {
           $this->task = $task;
    }
    
    function gettask_time() {
           return $this->task_time;
    }

    function settask_time ($task_time) {
           $this->task_time = $task_time;
    }
    function getcost() {
           return $this->cost;
    }

    function setcost ($cost) {
           $this->cost = $cost;
    }
    function getcurrency() {
           return $this->currency;
    }

    function setcurrency ($currency) {
           $this->currency = $currency;
    }

    function addmaintain_machine() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'maintain_machine' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

         $machineid = "'" . $this->machineid . "'";
         $purpose = "'" . $this->purpose . "'";
         $task = "'" . $this->task . "'";
         $task_time = "'" . $this->task_time . "'";
         $cost = "'" . $this->cost . "'";
         $currency = "'" . $this->currency . "'";

        $sql = "select * from maintain_machine where machineid = $machineid";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                    maintain_machine
                           (recnum,
                            machineid,
                            purpose,
                            task,
                            task_time,
                            cost,
                            currency)
                     VALUES
                           ($objid,
                            $machineid,
                            $purpose,
                            $task,
                            $task_time,
                            $cost,
                            $currency)";
        //echo $sql;
           $result = mysql_query($sql);

           $sql = 'commit';
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to maintain_machine didn't work..Please report to Sysadmin. " . mysql_error());
         }
    else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Machineid " . $machineid . " already exists. ");
         }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'maintain_machine'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
        //echo " <br>objid: $objid<br>";
         return $objid;
     }

     function getmaintain_machines() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();


           $sql= "select recnum, machineid, purpose, task, task_time,currency, cost
                    from maintain_machine";

       //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

     function getmaintain_machine($maintain_machinerecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();


           $sql= "select recnum, machineid, purpose, task, task_time,currency, cost
                    from maintain_machine where recnum=$maintain_machinerecnum";

       //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }


     function updatemaintain_machine($maintain_machinerecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

         $machineid = "'" . $this->machineid . "'";
         $purpose = "'" . $this->purpose . "'";
         $task = "'" . $this->task . "'";
         $task_time = "'" . $this->task_time . "'";
         $cost = "'" . $this->cost . "'";
         $currency = "'" . $this->currency . "'";

        $sql = "UPDATE maintain_machine SET
                     machineid=$machineid,
                     purpose=$purpose,
                     task=$task,
                     task_time=$task_time,
                     cost=$cost,
                     currency=$currency
        	    WHERE
                    recnum = $maintain_machinerecnum";
   // echo $sql;
        $result = mysql_query($sql);

        $sql = 'commit';
        $result = mysql_query($sql);
        if(!$result) die("final_insp_report update failed...Please report to SysAdmin. " . mysql_error());
        }



} // End quoteclass definition

