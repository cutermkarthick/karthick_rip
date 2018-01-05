<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: quoteClass.php
// Maintains the class for Quotes
// Revision: v1.0
//====================================

include_once('classes/loginClass.php');

class part_bom {

    var  $partnum,
         $part_unit,
         $rm_spec,
         $req_rm_qty,
         $rm_units;

    // Constructor definition
    function part_bom() {
        $this->partnum = '';
        $this->part_unit = '';
        $this->rm_spec = '';
        $this->req_rm_qty = '';
        $this->rm_units = '';
    }

    // Property get and set
    function getpartnum() {
           return $this->partnum;
    }

    function setpartnum ($partnum) {
           $this->partnum = $partnum;
    }

    function getpart_unit() {
           return $this->part_unit;
    }

    function setpart_unit ($part_unit) {
           $this->part_unit = $part_unit;
    }
    function getrm_spec() {
           return $this->rm_spec;
    }

    function setrm_spec ($rm_spec) {
           $this->rm_spec = $rm_spec;
    }

    function getreq_rm_qty() {
           return $this->req_rm_qty;
    }

    function setreq_rm_qty ($req_rm_qty) {
           $this->req_rm_qty = $req_rm_qty;
    }
    function getrm_units() {
           return $this->rm_units;
    }

    function setrm_units ($rm_units) {
           $this->rm_units = $rm_units;
    }

    function addpart_bom() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'part_bom' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

         $partnum = "'" . $this->partnum . "'";
         $part_unit = "'" . $this->part_unit . "'";
         $rm_spec = "'" . $this->rm_spec . "'";
         $req_rm_qty = "'" . $this->req_rm_qty . "'";
         $rm_units = "'" . $this->rm_units . "'";

        $sql = "select * from part_bom where partnum = $partnum";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                    part_bom
                           (recnum,
                            partnum,
                            part_unit,
                            rm_spec,
                            req_rm_qty,
                            rm_units)
                     VALUES
                           ($objid,
                            $partnum,
                            $part_unit,
                            $rm_spec,
                            $req_rm_qty,
                            $rm_units)";
        //echo $sql;
           $result = mysql_query($sql);

           $sql = 'commit';
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to part_bom didn't work..Please report to Sysadmin. " . mysql_error());
         }
    else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("partnum " . $partnum . " already exists. ");
         }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'part_bom'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
        //echo " <br>objid: $objid<br>";
         return $objid;
     }

     function getallpart_boms() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();


           $sql= "select recnum, partnum,
                            part_unit,
                            rm_spec,
                            req_rm_qty,
                            rm_units
                    from part_bom";

       //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

     function getpart_bom($part_bomrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

           $sql= "select recnum,partnum,
                            part_unit,
                            rm_spec,
                            rm_units,
                            req_rm_qty
                    from part_bom where recnum=$part_bomrecnum";

       //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }


     function updatepart_bom($part_bomrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

         $partnum = "'" . $this->partnum . "'";
         $part_unit = "'" . $this->part_unit . "'";
         $rm_spec = "'" . $this->rm_spec . "'";
         $req_rm_qty = "'" . $this->req_rm_qty . "'";
         $rm_units = "'" . $this->rm_units . "'";

        $sql = "UPDATE part_bom SET
                     partnum=$partnum,
                     part_unit=$part_unit,
                     rm_spec=$rm_spec,
                     req_rm_qty=$req_rm_qty,
                     rm_units=$rm_units
        	    WHERE
                    recnum = $part_bomrecnum";
   // echo $sql;
        $result = mysql_query($sql);

        $sql = 'commit';
        $result = mysql_query($sql);
        if(!$result) die("part_bom update failed...Please report to SysAdmin. " . mysql_error());
        }



} // End quoteclass definition

