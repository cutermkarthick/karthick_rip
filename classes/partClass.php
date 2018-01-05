<?

//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: partClass.php
// Maintains the class for Parts
// Revision: v1.0
//====================================
include_once('loginClass.php');

class part {

    var $part_used_recnum,
        $part_used_num,
        $part_used_qty,
        $socket_pn,
        $socket_pn_qty,
        $lid_pn,
        $lid_pn_qty,
        $other_pn1,
        $other_pn1_qty,
        $other_pn2,
        $other_pn2_qty,
        $other_pn3,
        $other_pn3_qty,
        $contact_pn,
        $contact_pn_qty,
        $part_used2type,
        $part_used_descr,
        $recnum,
        $part_num,
        $part_desc,
        $mfr,
        $domain,
        $category,
        $type,
        $subtype,
        $units,
        $price,
        $store_qty,
        $status;


    // Constructor definition
    function part() {
        $this->part_used_recnum = '';
        $this->part_used_num = '';
        $this->part_used_qty = '';
        $this->socket_pn = '';
        $this->socket_pn_qty = '';
        $this->lid_pn = '';
        $this->lid_pn_qty = '';
        $this->other_pn1 = '';
        $this->other_pn1_qty = '';
        $this->other_pn2 = '';
        $this->other_pn2_qty = '';
        $this->other_pn3 = '';
        $this->other_pn3_qty = '';
        $this->contact_pn = '';
        $this->contact_pn_qty = '';
        $this->part_used2part_master = '';
        $this->part_used2type = '';
        $this->part_used_descr = '';
        $this->recnum = '';
        $this->part_num = '';
        $this->part_desc = '';
        $this->mfr = '';
        $this->domain = '';
        $this->category = '';
        $this->type = '';
        $this->subtype = '';
        $this->units = '';
        $this->price = '';
        $this->store_qty = '';
        $this->status = '';
    }

    function getpu2pm () {
           return $this->part_used2part_master;
    }
    function setpu2pm ($reqpu2pm) {
           $this->part_used2part_master = $reqpu2pm;
    }

    function getpu2type () {
           return $this->part_used2type;
    }
    function setpu2type ($reqpu2type) {
           $this->part_used2type = $reqpu2type;
    }

    function gettype () {
           return $this->type;
    }
    function settype ($reqtype) {
           $this->type = $reqtype;
    }

    function getsubtype () {
           return $this->subtype;
    }
    function setsubtype ($reqsubtype) {
           $this->subtype = $reqsubtype;
    }

    function getpartused () {
           return $this->part_used_num;
    }
    function setpartused ($reqpartused) {
           $this->part_used_num = $reqpartused;
    }
    function getsocketpn () {
           return $this->socket_pn;
    }
    function setsocketpn ($reqsocketpn) {
           $this->socket_pn = $reqsocketpn;
    }
    function getsocketpnqty () {
           return $this->socketpnqty;
    }
    function setsocketpnqty ($reqsocketpnqty) {
           $this->socketpnqty = $reqsocketpnqty;
    }
    function getlidpn () {
           return $this->lid_pn;
    }
    function setlidpn ($reqlidpn) {
           $this->lid_pn = $reqlidpn;
    }
    function getlidpnqty () {
           return $this->lidpnqty;
    }
    function setlidpnqty ($reqlidpnqty) {
           $this->lidpnqty = $reqlidpnqty;
    }
    function getcotactpn () {
           return $this->contact_pn;
    }
    function setcontactpn ($reqcontactpn) {
           $this->contact_pn = $reqcontactpn;
    }
    function getcontactpnqty () {
           return $this->contactpnqty;
    }
    function setcontactpnqty ($reqcontactpnqty) {
           $this->contactpnqty = $reqcontactpnqty;
    }
    function getotherpn1 () {
           return $this->other_pn1;
    }
    function setotherpn1 ($reqotherpn1) {
           $this->other_pn1 = $reqotherpn1;
    }
    function getotherpn1qty () {
           return $this->otherpn1;
    }
    function setotherpn1qty ($reqotherpn1qty) {
           $this->otherpn1qty = $reqotherpn1qty;
    }
    function getotherpn2 () {
           return $this->other_pn2;
    }
    function setotherpn2 ($reqotherpn2) {
           $this->other_pn2 = $reqotherpn2;
    }
    function getotherpn2qty () {
           return $this->otherpn2;
    }
    function setotherpn2qty ($reqotherpn2qty) {
           $this->otherpn2qty = $reqotherpn2qty;
    }
    function getotherpn3 () {
           return $this->other_pn3;
    }
    function setotherpn3 ($reqotherpn3) {
           $this->other_pn3 = $reqotherpn3;
    }
    function getotherpn3qty () {
           return $this->otherpn3;
    }
    function setotherpn3qty ($reqotherpn3qty) {
           $this->otherpn3qty = $reqotherpn3qty;
    }



     function getBoardPartMaster($partnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
       $partnumber = "'" . $partnum . "'";
       $sql = "select part_num, part_desc from part_master where type = 'Board';";
       $result = mysql_query($sql);
       return $result;

     }

     function getSocketPartMaster($partnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
       $partnumber = "'" . $partnum . "'";
       $sql = "select part_num, part_desc from part_master where type = 'Socket'";
       $result = mysql_query($sql);
       return $result;

     }

    function getAllSocketPartMasters()
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
       $sql = "select recnum,part_num, part_desc from part_master where type = 'Socket'";
       $result = mysql_query($sql);
       return $result;

    }

    function getAllBoardPartMasters()
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
       $sql = "select recnum,part_num, part_desc from part_master where type = 'Board'";
       $result = mysql_query($sql);
       return $result;

    }

    function VerifyPart($partnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $pnum = "'" . $partnum . "'";
       $sql = "select part_num from part_master where trim(part_num) = $pnum";
       $result = mysql_query($sql);
       if(!$result) die("Error in partClass:Verifypart failed. " . mysql_error());
       $myrow = mysql_fetch_row($result);

       if ($myrow[0] != '') {
          return 'Yes';
       }
       else { return 'No'; }

    }

    function addPartUsed() {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select nxtnum from seqnum where tablename = 'part_used' for update";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crdate = "'" . date("y-m-d") . "'";

        $partused = "'" . $this->part_used_num . "'";
        $type = "'" . $this->type . "'";
        $subtype = "'" . $this->subtype . "'";
        $pu2type = $this->part_used2type;

        $sql = "INSERT INTO part_used 	(recnum,
                                         part_used_num,
        				 type,
                                         subtype,
    					 part_used2type)
                    		VALUES ($objid,
                                        $partused,
        				$type,
                                        $subtype,
    					$pu2type
   					)";
//       echo "<br>sql statement is " . $sql;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Error in partClass:Insert to part_used didn't work. " . mysql_error());

        $sql = "update seqnum set nxtnum = $objid where tablename = 'part_used'";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum update for part_used didn't work. " . mysql_error());
        return $objid;

     }
    function addSocketPartUsed($inppartnum, $inppartqty, $inpsubtype) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select nxtnum from seqnum where tablename = 'part_used' for update";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crdate = "'" . date("y-m-d") . "'";

        $partnum = "'" . $inppartnum . "'";
        $partqty = "'" . $inppartqty . "'";
        $type = "'Socket'";
        $subtype = "'" . $inpsubtype . "'";
        $pu2type = $this->part_used2type;

        if ($partnum != '') {
             $sql = "INSERT INTO part_used 	(recnum,
                                         part_used_num,
                                         qty,
        				 type,
                                         subtype,
    					 part_used2type)
                    		VALUES ($objid,
                                        $partnum,
                                        $partqty,
        				$type,
                                        $subtype,
    					$pu2type
   					)";
             $result = mysql_query($sql);
        // Test to make sure query worked
            if(!$result) die("Error in partClass:Insert to part_used for $subtype didn't work. " . mysql_error());

            $sql = "update seqnum set nxtnum = $objid where tablename = 'part_used'";
            $result = mysql_query($sql);

        // Test to make sure query worked
            if(!$result) die("Seqnum update for part_used didn't work. " . mysql_error());
            return $objid;
        }

     }


    function updSocketPartUsed($inprecnum, $inppartnum, $inppartqty) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $partnum = "'" . $inppartnum . "'";
        $partqty = $inppartqty;
        $partrecnum = $inprecnum;
        $sql = "update part_used
                       set
                           qty = $partqty,
                           part_used_num = $partnum
                       where recnum = $partrecnum";
           $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           echo "PartClass Error: Update of Socket Part failed for $partnum failed.. " . mysql_error();
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Please report to Sysadmin. ");
        }

     }



    function addPartMaster($pnum,$inptype) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select nxtnum from seqnum where tablename = 'part_master' for update";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crdate = "'" . date("y-m-d") . "'";
        $type = "'" . $inptype . "'";
        $partnum = "'" . $pnum . "'";
        $sql = "select count(*) from part_master where part_num = $partnum";
        $result = mysql_query($sql);
        if(!$result) die("Access to Part master failed. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        if ($myrow[0] == 0) {
           $sql = "INSERT INTO part_master	(recnum,part_num,type)
                                  VALUES ($objid, $partnum, $type)";
           }
        else die("Part number already used....Please try a different one");

        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Error: Insert to part master failed. " . mysql_error());

        $sql = "update seqnum set nxtnum = $objid where tablename = 'part_master'";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum update for part_master failed. " . mysql_error());
     }

//  Added the following function to take care of part master entry during
//   WO updates to partnum
    function addPartMaster4upd($pnum,$inptype) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select nxtnum from seqnum where tablename = 'part_master' for update";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crdate = "'" . date("y-m-d") . "'";
        $type = "'" . $inptype . "'";
        $partnum = "'" . $pnum . "'";
        $sql = "select count(*) from part_master where part_num = $partnum";
        $result = mysql_query($sql);
        if(!$result) die("Access to Part master failed. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        if ($myrow[0] == 0) {
           $sql = "INSERT INTO part_master	(recnum,
                                         part_num,
        				 type)
                    		VALUES ($objid,
                                        $partnum,
                                        $type
   					)";
           $result = mysql_query($sql);
         // Test to make sure query worked
           if(!$result) die("Error: Insert to part master failed. " . mysql_error());

           $sql = "update seqnum set nxtnum = $objid where tablename = 'part_master'";
           $result = mysql_query($sql);

          // Test to make sure query worked
          if(!$result) die("Seqnum update for part_master failed. " . mysql_error());
        }
     }

    function updBoardPartUsed($inprecnum, $inppartnum, $inppartqty) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $partnum = "'" . $inppartnum . "'";
        $partqty = "'" . $inppartqty . "'";
        $partrecnum = $inprecnum;
        $sql = "update part_used
                       set
                           qty = $partqty,
                           part_used_num = $partnum
                       where recnum = $partrecnum and
                             type = 'Board'";
//echo "$sql";
           $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           echo "PartClass Error: Update of Board partnum failed.. " . mysql_error();
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Please report to Sysadmin. ");
        }

     }


} // End Part class definition

