<?
//====================================
// Author: FSI
// Date-written = Feb 26, 2007
// Filename:mmClass.php
// Maintains the class for material movements
// Revision: v1.0
//====================================

include_once('loginClass.php');

class mm {

var
	$line_num,
	$qty_drawn,
	$drawn_by,
	$drawn_date,
	$issued_by,
	$issued_date,
	$recd_by,
	$sl_from,
	$sl_to,
	$accepted,
	$rejected,
	$returned,
	$notes,
    $link2wo,
    $link2notes;

    // Constructor definition
    function mm() {
        $this->line_num= '';
        $this->qty_drawn = '';
        $this->drawn_by = '';
        $this->drawn_date = '';
        $this->issued_by = '';
        $this->issued_date = '';
        $this->recd_by = '';
        $this->sl_from = '';
        $this->sl_to = '';
        $this->accepted= '';
        $this->rejected= '';
        $this->returned= '';
        $this->notes= '';
        $this->link2wo = '';
        $this->link2notes = '';
     }
    function getline_num() {
           return $this->line_num;
    }

    function setline_num ($line_num) {

           $this->line_num = $line_num;
    }

    function getqty_drawn() {
           return $this->qty_drawn;
    }

    function setqty_drawn($qty_drawn) {
           $this->qty_drawn = $qty_drawn;
    }


    function getdrawn_by() {
           return $this->drawn_by;
    }

    function setdrawn_by ($drawn_by) {
           $this->drawn_by = $drawn_by;
    }

    function getissued_by() {
           return $this->issued_by;
    }

    function setissued_by ($issued_by) {
           $this->issued_by = $issued_by;
    }
    function getrecd_by() {
           return $this->recd_by;
    }

    function setrecd_by ($recd_by) {
           $this->recd_by = $recd_by;
    }

    function getsl_from() {
           return $this->sl_from;
    }

    function setsl_from($sl_from) {

           $this->sl_from = $sl_from;
    }

    function getsl_to() {
           return $this->sl_to;
    }

    function setsl_to($sl_to) {
           $this->sl_to = $sl_to;
    }


    function getaccepted() {
           return $this->accepted;
    }

    function setaccepted ($accepted) {
           $this->accepted = $accepted;
    }

    function getrejected() {
           return $this->rejected;
    }

    function setrejected ($rejected) {
           $this->rejected = $rejected;
    }
    function getreturned() {
           return $this->returned;
    }

    function setreturned ($returned) {
           $this->returned = $returned;
    }


	 function getlink2wo() {
           return $this->link2wo;
    }

    function setlink2wo($link2wo) {
           $this->link2wo = $link2wo;
    }

    function getnotes() {
           return $this->notes;
    }

    function setnotes ($notes) {
           $this->notes = $notes;
    }

    function getlink2notes() {
           return $this->link2notes;
    }

    function setlink2notes ($link2notes) {
           $this->link2notes = $link2notes;
    }
    
    function getdrawn_date() {
           return $this->drawn_date;
    }

    function setdrawn_date($drawn_date) {
           $this->drawn_date = $drawn_date;
    }
    
    function getissued_date() {
           return $this->issued_date;
    }

    function setissued_date ($issued_date) {
           $this->issued_date = $issued_date;
    }

    function addmm() {
//        $newlogin = new userlogin;
//        $newlogin->dbconnect();
//        $sql = "start transaction";
//        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'mm' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for mm..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        
        //echo $objid;

        $line_num = "'" . $this->line_num . "'";
        
        if($this->qty_drawn != '')
        {
          $qty_drawn = "'" . $this->qty_drawn . "'";
        }
        else
        {
          $qty_drawn = 'NULL';
        }
        
        $drawn_by = "'" . $this->drawn_by . "'";
        
        if($this->drawn_date != '')
        {
          $drawn_date = "'" . $this->drawn_date . "'";
        }
        else
        {
          $drawn_date = 'NULL';
        }
        
        $issued_by = "'" . $this->issued_by . "'";
        
        if($this->issued_date != '')
        {
          $issued_date = "'" . $this->issued_date . "'";
        }
        else
        {
          $issued_date = 'NULL';
        }
        
        $recd_by = "'" . $this->recd_by . "'";
        $sl_from  = "'" . $this->sl_from . "'";
        $sl_to  = "'" . $this->sl_to . "'";
        $accepted = "'" . $this->accepted . "'";
        $rejected  = "'" . $this->rejected . "'";
        $returned  = "'" . $this->returned . "'";
        $notes  = "'" . $this->notes . "'";
        $link2wo = $this->link2wo;
        
        if($this->link2notes != '')
        {
          $link2notes = $this->link2notes;
        }
        else
        {
          $link2notes = 'NULL';
        }

        $sql = "INSERT INTO mm (recnum, line_num, qty_drawn, drawn_by, issued_by,
                       recd_by,sl_from,sl_to,accepted,rejected,returned,notes,link2wo, drawn_date, issued_date)
                VALUES ($objid, $line_num, $qty_drawn, $drawn_by,  $issued_by,
                       $recd_by,$sl_from,$sl_to,$accepted,$rejected,$returned,$notes,$link2wo,$drawn_date,$issued_date)";
    // echo $sql;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to mm didn't work..Please report to Sysadmin. " . mysql_error());
        }
         $sql = "update seqnum set nxtnum = $objid where tablename = 'mm'";
   // echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for mm..Please report to Sysadmin. " . mysql_error());
        }
     }

    function updatemm($recnum) {


        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $line_num = "'" . $this->line_num . "'";
        $qty_drawn = "'" . $this->qty_drawn . "'";
        $drawn_by = "'" . $this->drawn_by . "'";
        $drawn_date = "'" . $this->drawn_date . "'";
        $issued_by = "'" . $this->issued_by . "'";
        $issued_date = "'" . $this->issued_date . "'";
        $recd_by = "'" . $this->recd_by . "'";
        $sl_from  = "'" . $this->sl_from . "'";
        $sl_to  = "'" . $this->sl_to . "'";
        $accepted = "'" . $this->accepted . "'";
        $rejected  = "'" . $this->rejected . "'";
        $returned  = "'" . $this->returned . "'";
        $notes  = "'" . $this->notes . "'";

        $link2notes = $this->link2notes;

        $sql = "update mm
                          set line_num = $line_num,
                              qty_drawn = $qty_drawn,
                              drawn_by = $drawn_by,
                              issued_by= $issued_by,
                              recd_by = $recd_by,
                              sl_to = $sl_to,
                              sl_from = $sl_from,
                              accepted = $accepted,
                              rejected = $rejected,
                              returned = $returned,
                              notes = $notes,
                              drawn_date = $drawn_date,
                              issued_date = $issued_date
                        where recnum = $lirecnum";

     if($lirecnum==13) {
                   //   echo "sql  :  " . $sql;
     }

  // echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to mm didn't work..Please report to Sysadmin. " . mysql_error());

     }

     function getmm($inprecnum) {
        $worecnum = $inprecnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select line_num, qty_drawn, drawn_by,
                       issued_by, recd_by, sl_from, sl_to, accepted,
                       rejected,returned,notes,recnum,drawn_date,issued_date
                   from mm
                   where link2wo = $worecnum";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

    function deletemm($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $recnum =$inprecnum;
        $sql = "delete from mm where recnum = $recnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for mm  failed...Please report to SysAdmin. " . mysql_error());
      }

 }// End so class definition
