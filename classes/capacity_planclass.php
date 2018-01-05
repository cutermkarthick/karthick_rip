<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: quoteClass.php
// Maintains the class for Quotes
// Revision: v1.0
//====================================

include_once('loginClass.php');

class capacity_plan {

    var  $machineid,
         $av_cap,
         $used_cap,
         $unused_cap;

    // Constructor definition
    function capacity_plan() {
        $this->machineid = '';
        $this->av_cap = '';
        $this->used_cap = '';
        $this->unused_cap = '';
    }

    // Property get and set
    function getmachineid() {
           return $this->machineid;
    }

    function setmachineid ($machineid) {
           $this->machineid = $machineid;
    }

    function getav_cap() {
           return $this->av_cap;
    }

    function setav_cap ($av_cap) {
           $this->av_cap = $av_cap;
    }
    function getused_cap() {
           return $this->used_cap;
    }

    function setused_cap ($used_cap) {
           $this->used_cap = $used_cap;
    }

    function getunused_cap() {
           return $this->unused_cap;
    }

    function setunused_cap ($unused_cap) {
           $this->unused_cap = $unused_cap;
    }

    function addcapacity_plan() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'capacity_plan' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

         $machineid = "'" . $this->machineid . "'";
         $av_cap = "'" . $this->av_cap . "'";
         $used_cap = "'" . $this->used_cap . "'";
         $unused_cap = "'" . $this->unused_cap . "'";

        $sql = "select * from capacity_plan where machineid = $machineid";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                    capacity_plan
                           (recnum,
                            machineid,
                            av_cap,
                            used_cap,
                            unused_cap)
                     VALUES
                           ($objid,
                            $machineid,
                            $av_cap,
                            $used_cap,
                            $unused_cap)";
        //echo $sql;
           $result = mysql_query($sql);

           $sql = 'commit';
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to capacity_plan didn't work..Please report to Sysadmin. " . mysql_error());
         }
    else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("machineid " . $machineid . " already exists. ");
         }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'capacity_plan'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
        //echo " <br>objid: $objid<br>";
         return $objid;
     }

     function getallcapacity_plans() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

           $sql= "select recnum, machineid,
                            av_cap,
                            used_cap,
                            unused_cap
                    from capacity_plan";

       //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

     function getcapacity_plan($capacity_planrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

           $sql= "select recnum, machineid,
                            av_cap,
                            used_cap,
                            unused_cap
                    from capacity_plan where recnum=$capacity_planrecnum";

       //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }


     function updatecapacity_plan($capacity_planrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

         $machineid = "'" . $this->machineid . "'";
         $av_cap = "'" . $this->av_cap . "'";
         $used_cap = "'" . $this->used_cap . "'";
         $unused_cap = "'" . $this->unused_cap . "'";

        $sql = "UPDATE capacity_plan SET
                     machineid=$machineid,
                     av_cap=$av_cap,
                     used_cap=$used_cap,
                     unused_cap=$unused_cap
        	    WHERE
                    recnum = $capacity_planrecnum";
   // echo $sql;
        $result = mysql_query($sql);

        $sql = 'commit';
        $result = mysql_query($sql);
        if(!$result) die("capacity_planrecnum update failed...Please report to SysAdmin. " . mysql_error());
        }



} // End quoteclass definition

