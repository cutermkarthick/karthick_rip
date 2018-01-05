<?
//====================================
// Author: FSI
// Date-written = July 5, 2005 Jerry George
// Filename: QuoteliClass.php
// Revision: v1.0
//====================================

include_once('loginClass.php');

class final_insp_reportli{

    var
     $slno,
     $sheet,
     $map,
     $main_view,
     $slnum1,
     $slnum2,
     $slnum3,
     $actual_dim1,
     $actual_dim2,
     $actual_dim3,
     $accpt_reject,
     $insp_by1,
     $insp_by2,
     $insp_by3,
     $insp_date1,
     $insp_date2,
     $insp_date3,
     $link2final_insp;

    // Constructor definition
    function final_insp_reportli() {
        $this->slno = '';
        $this->sheet = '';
        $this->map = '';
        $this->main_view = '';
        $this->slnum1 = '';
        $this->slnum2 = '';
        $this->slnum3 = '';
        $this->actual_dim1 = '';
        $this->actual_dim2 = '';
        $this->actual_dim3 = '';
        $this->accpt_reject = '';
        $this->insp_by1 = '';
        $this->insp_by2 = '';
        $this->insp_by3 = '';
        $this->insp_date1 = '';
        $this->insp_date2 = '';
        $this->insp_date3 = '';
        $this->link2final_insp = '';

     }

    // Property get and set
    function getslno() {
           return $this->slno;
    }

    function setslno ($slno) {

           $this->slno = $slno;
    }


    function getsheet() {
           return $this->sheet;
    }
    function setsheet ($sheet) {
           $this->sheet = $sheet;
    }

    function getmap() {
           return $this->map;
    }

    function setmap ($map) {
           $this->map = $map;
    }
    function getmain_view() {
           return $this->main_view;
    }

    function setmain_view ($main_view) {
           $this->main_view = $main_view;
    }
    function getslnum1() {
           return $this->slnum1;
    }

    function setslnum1 ($slnum1) {
           $this->slnum1 = $slnum1;
    }

    function getslnum2() {
           return $this->slnum2;
    }

    function setslnum2 ($slnum2) {
           $this->slnum2 = $slnum2;
    }

    function getslnum3() {
           return $this->slnum3;
    }

    function setslnum3 ($slnum3) {
           $this->slnum3 = $slnum3;
    }

    function getactual_dim1() {
           return $this->actual_dim1;
    }

    function setactual_dim1 ($actual_dim1) {
           $this->actual_dim1 = $actual_dim1;
    }

    function getactual_dim2() {
           return $this->actual_dim2;
    }

    function setactual_dim2 ($actual_dim2) {
           $this->actual_dim2 = $actual_dim2;
    }

    function getactual_dim3() {
           return $this->actual_dim3;
    }

    function setactual_dim3 ($actual_dim3) {
           $this->actual_dim3 = $actual_dim3;
    }

    function getaccpt_reject() {
           return $this->accpt_reject;
    }

    function setaccpt_reject ($accpt_reject) {
           $this->accpt_reject = $accpt_reject;
    }

    function getinsp_by1() {
           return $this->insp_by1;
    }

    function setinsp_by1 ($insp_by1) {
           $this->insp_by1 = $insp_by1;
    }

     function getinsp_by2() {
           return $this->insp_by2;
    }

    function setinsp_by2 ($insp_by2) {
           $this->insp_by2 = $insp_by2;
    }

    function getinsp_by3() {
           return $this->insp_by3;
    }

    function setinsp_by3 ($insp_by3) {
           $this->insp_by3 = $insp_by3;
    }

    function getinsp_date1() {
           return $this->insp_date1;
    }

    function setinsp_date1 ($insp_date1) {
           $this->insp_date1 = $insp_date1;
    }

    function getinsp_date2() {
           return $this->insp_date2;
    }

    function setinsp_date2 ($insp_date2) {
           $this->insp_date2 = $insp_date2;
    }

    function getinsp_date3() {
           return $this->insp_date3;
    }

    function setinsp_date3 ($insp_date3) {
           $this->insp_date3 = $insp_date3;
    }

    function getlink2final_insp() {
           return $this->link2final_insp;
    }

    function setlink2final_insp ($link2final_insp) {
           $this->link2final_insp = $link2final_insp;
    }

    function addLI() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'final_insp_lineitems' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for final insp Line Items ..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        
        
        $slno = $this->slno ;
        $sheet = $this->sheet ;
        $map = "'" . $this->map . "'";
        $main_view = "'" . $this->main_view . "'";
        $slnum1 = $this->slnum1 ?  $this->slnum1 :0;
        $slnum2 = $this->slnum2 ?  $this->slnum2 :0;
        $slnum3 = $this->slnum3 ?  $this->slnum3 :0;
        $actual_dim1 = "'" . $this->actual_dim1 . "'" ;
        $actual_dim2 = "'" . $this->actual_dim2 . "'" ;
        $actual_dim3 = "'" . $this->actual_dim3 . "'" ;
        $accpt_reject = "'" . $this->accpt_reject . "'" ;
        $insp_by1 = "'" . $this->insp_by1 . "'" ;
        $insp_by2 = "'" . $this->insp_by2 . "'" ;
        $insp_by3 = "'" . $this->insp_by3 . "'" ;
        $insp_date1 = "'" . $this->insp_date1 . "'" ;
        $insp_date2 = "'" . $this->insp_date2 . "'" ;
        $insp_date3 = "'" . $this->insp_date3 . "'" ;
        $link2final_insp = $this->link2final_insp ;

//echo "link2quote:$link2quote<br>";
        $sql = "INSERT INTO final_insp_lineitems(recnum,
                                                 slno,
                                                 sheet,
                                                 map,
                                                 main_view,
                                                 slnum1,
                                                 slnum2,
                                                 slnum3,
                                                 actual_dim1,
                                                 actual_dim2,
                                                 actual_dim3,
                                                 accpt_reject,
                                                 insp_by1,
                                                 insp_by2,
                                                 insp_by3,
                                                 insp_date1,
                                                 insp_date2,
                                                 insp_date3,
                                                 link2final_insp)
	                                   VALUES    ($objid,
                                                  $slno,
                                                  $sheet,
                                                  $map,
                                                  $main_view,
                                                  $slnum1,
                                                  $slnum2,
                                                  $slnum3,
                                                  $actual_dim1,
                                                  $actual_dim2,
                                                  $actual_dim3,
                                                  $accpt_reject,
                                                  $insp_by1,
                                                  $insp_by2,
                                                  $insp_by3,
                                                  $insp_date1,
                                                  $insp_date2,
                                                  $insp_date3,
                                                  $link2final_insp)";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) {
          $sql = "roolback";
          $result = mysql_query($sql);
           die("Insert to Final Insp Line Items didn't work..Please report to Sysadmin. " . mysql_error());
        }
        $sql = "update seqnum set nxtnum = $objid where tablename = 'final_insp_lineitems'";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for final Insp Line Items.Please report to Sysadmin. " . mysql_error());
        }
     }

    function updateLI($recnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $slno = $this->slno ;
        $sheet = $this->sheet ;
        $map = "'" . $this->map . "'";
        $main_view = "'" . $this->main_view . "'";
        $slnum1 = $this->slnum1 ;
        $slnum2 = $this->slnum2 ;
        $slnum3 = $this->slnum3 ;
        $actual_dim1 = "'" . $this->actual_dim1 . "'" ;
        $actual_dim2 = "'" . $this->actual_dim2 . "'" ;
        $actual_dim3 = "'" . $this->actual_dim3 . "'" ;
        $accpt_reject = "'" . $this->accpt_reject . "'" ;
        $insp_by1 = "'" . $this->insp_by1 . "'" ;
        $insp_by2 = "'" . $this->insp_by2 . "'" ;
        $insp_by3 = "'" . $this->insp_by3 . "'" ;
        $insp_date1 = "'" . $this->insp_date1 . "'" ;
        $insp_date2 = "'" . $this->insp_date2 . "'" ;
        $insp_date3 = "'" . $this->insp_date3 . "'" ;

        $sql = "update final_insp_lineitems
                                 set slno = $slno,
                                     sheet = $sheet,
                                     map = $map,
                                     main_view = $main_view,
                                     slnum1 = $slnum1,
                                     slnum2 = $slnum2,
                                     slnum3 = $slnum3,
                                     actual_dim1 = $actual_dim1,
                                     actual_dim2 = $actual_dim2,
                                     actual_dim3 = $actual_dim3,
                                     accpt_reject = $accpt_reject,
                                     insp_by1 = $insp_by1,
                                     insp_by2 = $insp_by2,
                                     insp_by3 = $insp_by3,
                                     insp_date1 = $insp_date1,
                                     insp_date2 = $insp_date2,
                                     insp_date3 =$insp_date3
                      where recnum = $recnum";
           // echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to final insp line items didn't work..Please report to Sysadmin. " . mysql_error());
     }


     function getLI($final_insprecnum) {
        $recnum =$final_insprecnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select recnum,
                       slno,
                       sheet,
                       map,
                       main_view,
                       slnum1,
                       slnum2,
                       slnum3,
                       actual_dim1,
                       actual_dim2,
                       actual_dim3,
                       accpt_reject,
                       insp_by1,
                       insp_by2,
                       insp_by3,
                       insp_date1,
                       insp_date2,
                       insp_date3,
                       link2final_insp
                   from final_insp_lineitems
                   where link2final_insp = $recnum";
        $result = mysql_query($sql);
        return $result;
     }


     function deleteLI($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $recnum =$inprecnum;
        $sql = "delete from final_insp_lineitems where recnum = $inprecnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for final insp Line Items Items failed...Please report to SysAdmin. " . mysql_error());
      }

} // End Quote Line Items class definition
