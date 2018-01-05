<?
//====================================
// Author: FSI
// Date-written = April 04, 2007
// Filename: reviewClass.php
// Maintains the class for review
// Revision: v1.0  OWT
//====================================

include_once('loginClass.php');

class fitting {
    var
    $operator,
    $date,
    $shift,
    $time_per_piece,
    $qty_assigned,
    $qty_produced,
    $rejection,
    $time_wasted;

    // Constructor definition
    function fitting() {
        $this->operator = '';
        $this->date = '';
        $this->shift = '';
        $this->time_per_piece = '';
        $this->qty_assigned = '';
        $this->qty_produced = '';
        $this->rejection = '';
        $this->time_wasted = '';
     }

    function getoperator() {
           return $this->operator;
    }
    function setoperator ($operator) {
           $this->operator = $operator;
    }

    function getdate() {
           return $this->date;
    }
    function setdate($date) {
           $this->date = $date;
    }

    function getshift() {
           return $this->shift;
    }
    function setshift ($shift) {
           $this->shift = $shift;
    }

    function gettime_per_piece() {
           return $this->time_per_piece;
    }
    function settime_per_piece($time_per_piece) {
           $this->time_per_piece = $time_per_piece;
    }

    function getqty_assigned() {
           return $this->qty_assigned;
    }
    function setqty_assigned($qty_assigned) {
           $this->qty_assigned = $qty_assigned;
    }

    function getqty_produced() {
           return $this->qty_produced;
    }
    function setqty_produced($qty_produced) {
           $this->qty_produced = $qty_produced;
    }

    function getrejection() {
           return $this->rejection;
    }
    function setrejection($rejection) {
           $this->rejection = $rejection;
    }

    function gettime_wasted() {
           return $this->time_wasted;
    }
    function settime_wasted($time_wasted) {
           $this->time_wasted= $time_wasted;
    }

   function addfitting() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
       /* $sql = "select nxtnum from seqnum where tablename = 'contract_review' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1; */

        $operator  = "'" . $this->operator . "'";
        $date = "'" . $this->date . "'";
        $shift = "'" . $this->shift . "'";
        $time_per_piece = "'" . $this->time_per_piece . "'";
        $qty_assigned = "'" . $this->qty_assigned . "'";
        $qty_produced = "'" . $this->qty_produced . "'";
        $rejection = "'" . $this->rejection . "'";


        $sql = "select * from fitting where operator = $operator and date=$date and shift=$shift";
           $result = mysql_query($sql);
           if (!(mysql_fetch_row($result)))
           {
            $sql = "INSERT INTO
                        fitting
                            (
                             operator,
                             date,
                             shift,
                             time_per_piece,
                             qty_assigned,
                             qty_produced,
                             rejection
                            )
                    VALUES
                            (
                             $operator,
                             $date,
                             $shift,
                             $time_per_piece,
                             $qty_assigned,
                             $qty_produced,
                             $rejection
                            )";
              $result = mysql_query($sql);

           // Test to make sure query worked
              if(!$result) die("Insert to fitting didn't work..Please report to Sysadmin. " . mysql_error());
           }
            else
            {
                echo "<table border=1><tr><td><font color=#FF0000>";
               die("Operator " . $operator . "with" . $date . 'and' . $shift ." already exists. ");
               echo "</td></tr></table>";
            }
        /*    $sql = "update seqnum set nxtnum = $objid where tablename = 'contract_review'";
            $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work for Enquiry..Please report to Sysadmin. " . mysql_error());
       */
        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for fitting Insert..Please report to Sysadmin. " . mysql_error());
        return;
     }


     function getfittings() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,
                        operator,
                        date,
                        shift,
                        time_per_piece,
                        qty_assigned,
                        qty_produced,
                        rejection
                  FROM fitting order by operator,date,shift";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;

     }

     function getfitting_data($fittingrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,
                        operator,
                        date,
                        shift,
                        time_per_piece,
                        qty_assigned,
                        qty_produced,
                        rejection
                  FROM fitting where recnum=$fittingrecnum";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;

     }

     function updatefitting($fittingrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $operator  = "'" . $this->operator . "'";
        $date = "'" . $this->date . "'";
        $shift = $this->shift;
        $time_per_piece = $this->time_per_piece;
        $qty_assigned = $this->qty_assigned;
        $qty_produced = $this->qty_produced;
        $rejection = $this->rejection;

       $sql = "UPDATE fitting SET
                    operator = $operator,
                    date = $date,
                    shift = $shift,
                    time_per_piece = $time_per_piece,
                    qty_assigned = $qty_assigned,
                    qty_produced = $qty_produced,
                    rejection = $rejection
        	WHERE
                    recnum = $fittingrecnum";
// echo $sql;
        $result = mysql_query($sql);

        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv5");
                     die("fitting update failed...Please report to SysAdmin. " . mysql_error());
                     }
        }



} // End invoice class definition

