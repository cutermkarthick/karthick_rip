<?
//====================================
// Author: FSI
// Date-written = July 5, 2005 Jerry George
// Filename: QuoteliClass.php
// Revision: v1.0
//====================================

include_once('loginClass.php');

class stage_insp_reportli{

    var
     $linenum,
     $normal_dim,
     $slno1,
     $slno2,
     $slno3,
     $slno4,
     $slno5,
     $measured_dim1,
     $measured_dim2,
     $measured_dim3,
     $measured_dim4,
     $measured_dim5,
     $verified_by,
     $insp_by1,
     $insp_by2,
     $insp_by3,
     $insp_by4,
     $insp_by5,
     $shift1,
     $shift2,
     $shift3,
     $shift4,
     $shift5,
     $date1,
     $date2,
     $date3,
     $date4,
     $date5,
     $link2stage_insp;

    // Constructor definition
    function stage_insp_reportli() {
        $this->linenum = '';
        $this->normal_dim = '';
        $this->slno1 = '';
        $this->slno2 = '';
        $this->slno3 = '';
        $this->slno4 = '';
        $this->slno5 = '';
        $this->measured_dim1 = '';
        $this->measured_dim2 = '';
        $this->measured_dim3 = '';
        $this->measured_dim4 = '';
        $this->measured_dim5 = '';
        $this->verified_by = '';
        $this->insp_by1 = '';
        $this->insp_by2 = '';
        $this->insp_by3 = '';
        $this->insp_by4 = '';
        $this->insp_by5 = '';
        $this->shift1 = '';
        $this->shift2 = '';
        $this->shift3 = '';
        $this->shift4 = '';
        $this->shift5 = '';
        $this->date1 = '';
        $this->date2 = '';
        $this->date3 = '';
        $this->date4 = '';
        $this->date5 = '';
        $this->link2stage_insp = '';

     }

    // Property get and set
    function getlinenum() {
           return $this->linenum;
    }

    function setlinenum ($linenum) {

           $this->linenum = $linenum;
    }


    function getnormal_dim() {
           return $this->normal_dim;
    }
    function setnormal_dim ($normal_dim) {
           $this->normal_dim = $normal_dim;
    }

    function getslno1() {
           return $this->slno1;
    }

    function setslno1 ($slno1) {
           $this->slno1 = $slno1;
    }
    function getslno2() {
           return $this->slno2;
    }

    function setslno2 ($slno2) {
           $this->slno2 = $slno2;
    }
    function getslno3() {
           return $this->slno3;
    }

    function setslno3 ($slno3) {
           $this->slno3 = $slno3;
    }
    
    function getslno4() {
           return $this->slno4;
    }

    function setslno4 ($slno4) {
           $this->slno4 = $slno4;
    }

    function getslno5() {
           return $this->slno5;
    }

    function setslno5 ($slno5) {
           $this->slno5 = $slno5;
    }
    
    function getmeasured_dim1() {
           return $this->measured_dim1;
    }

    function setmeasured_dim1 ($measured_dim1) {
           $this->measured_dim1 = $measured_dim1;
    }
    
    function getmeasured_dim2() {
           return $this->measured_dim2;
    }

    function setmeasured_dim2 ($measured_dim2) {
           $this->measured_dim2 = $measured_dim2;
    }
    
    function getmeasured_dim3() {
           return $this->measured_dim3;
    }

    function setmeasured_dim3 ($measured_dim3) {
           $this->measured_dim3 = $measured_dim3;
    }
    
    function getmeasured_dim4() {
           return $this->measured_dim4;
    }

    function setmeasured_dim4 ($measured_dim4) {
           $this->measured_dim4 = $measured_dim4;
    }
    
    function getmeasured_dim5() {
           return $this->measured_dim5;
    }

    function setmeasured_dim5 ($measured_dim5) {
           $this->measured_dim5 = $measured_dim5;
    }
    
     function getverified_by() {
           return $this->verified_by;
    }

    function setverified_by ($verified_by) {
           $this->verified_by = $verified_by;
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
    
    function getinsp_by4() {
           return $this->insp_by4;
    }

    function setinsp_by4 ($insp_by4) {
           $this->insp_by4 = $insp_by4;
    }
    
    function getinsp_by5() {
           return $this->insp_by5;
    }

    function setinsp_by5 ($insp_by5) {
           $this->insp_by5 = $insp_by5;
    }
    
    function getshift1() {
           return $this->shift1;
    }

    function setshift1 ($shift1) {
           $this->shift1 = $shift1;
    }
    
    function getshift2() {
           return $this->shift2;
    }

    function setshift2 ($shift2) {
           $this->shift2 = $shift2;
    }
    
    function getshift3() {
           return $this->shift3;
    }

    function setshift3 ($shift3) {
           $this->shift3 = $shift3;
    }
    
    function getshift4() {
           return $this->shift4;
    }

    function setshift4 ($shift4) {
           $this->shift4 = $shift4;
    }
    
    function getshift5() {
           return $this->shift5;
    }

    function setshift5 ($shift5) {
           $this->shift5 = $shift5;
    }
    
    function getdate1() {
           return $this->date1;
    }

    function setdate1 ($date1) {
           $this->date1 = $date1;
    }
    function getdate2() {
           return $this->date2;
    }

    function setdate2 ($date2) {
           $this->date2 = $date2;
    }
    function getdate3() {
           return $this->date3;
    }

    function setdate3 ($date3) {
           $this->date3 = $date3;
    }
    function getdate4() {
           return $this->date4;
    }

    function setdate4 ($date4) {
           $this->date4 = $date4;
    }
    function getdate5() {
           return $this->date5;
    }

    function setdate5 ($date5) {
           $this->date5 = $date5;
    }
    
    function getlink2stage_insp() {
           return $this->link2stage_insp;
    }

    function setlink2stage_insp ($link2stage_insp) {
           $this->link2stage_insp = $link2stage_insp;
    }

    function addLI() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'stage_insp_lineitems' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for stageinsp Line Items ..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        
        $linenum = $this->linenum ;
        $normal_dim = "'" . $this->normal_dim . "'";
        $slno1 = $this->slno1 ;
        $slno2 = $this->slno2 ;
        $slno3 = $this->slno3 ;
        $slno4 = $this->slno4 ;
        $slno5 = $this->slno5 ;
        $measured_dim1 = "'" . $this->measured_dim1 . "'" ;
        $measured_dim2 = "'" . $this->measured_dim2 . "'" ;
        $measured_dim3 = "'" . $this->measured_dim3 . "'" ;
        $measured_dim4 = "'" . $this->measured_dim4 . "'" ;
        $measured_dim5 = "'" . $this->measured_dim5 . "'" ;
        $verified_by = "'" . $this->verified_by . "'";
        $insp_by1 = "'" . $this->insp_by1 . "'" ;
        $insp_by2 = "'" . $this->insp_by2 . "'" ;
        $insp_by3 = "'" . $this->insp_by3 . "'" ;
        $insp_by4 = "'" . $this->insp_by4 . "'" ;
        $insp_by5 = "'" . $this->insp_by5 . "'" ;
        $shift1 = "'" . $this->shift1 . "'";
        $shift2 = "'" . $this->shift2 . "'" ;
        $shift3 = "'" . $this->shift3 . "'" ;
        $shift4 = "'" . $this->shift4 . "'" ;
        $shift5 = "'" . $this->shift5 . "'" ;
        $date1 = "'" . $this->date1 . "'" ;
        $date2 = "'" . $this->date2 . "'" ;
        $date3 = "'" . $this->date3 . "'" ;
        $date4 = "'" . $this->date4 . "'" ;
        $date5 = "'" . $this->date5 . "'" ;
        $link2stage_insp =  $this->link2stage_insp ;
        
//echo "link2quote:$link2quote<br>";
        $sql = "INSERT INTO stage_insp_lineitems(recnum,
                                     linenum,
                                     normal_dim,
                                     slno1,
                                     slno2,
                                     slno3,
                                     slno4,
                                     slno5,
                                     measured_dim1,
                                     measured_dim2,
                                     measured_dim3,
                                     measured_dim4,
                                     measured_dim5,
                                     verified_by,
                                     insp_by1,
                                     insp_by2,
                                     insp_by3,
                                     insp_by4,
                                     insp_by5,
                                     shift1,
                                     shift2,
                                     shift3,
                                     shift4,
                                     shift5,
                                     date1,
                                     date2,
                                     date3,
                                     date4,
                                     date5,
                                     link2stage_insp)
	                      VALUES    ($objid,
                                     $linenum,
                                     $normal_dim,
                                     $slno1,
                                     $slno2,
                                     $slno3,
                                     $slno4,
                                     $slno5,
                                     $measured_dim1,
                                     $measured_dim2,
                                     $measured_dim3,
                                     $measured_dim4,
                                     $measured_dim5,
                                     $verified_by,
                                     $insp_by1,
                                     $insp_by2,
                                     $insp_by3,
                                     $insp_by4,
                                     $insp_by5,
                                     $shift1,
                                     $shift2,
                                     $shift3,
                                     $shift4,
                                     $shift5,
                                     $date1,
                                     $date2,
                                     $date3,
                                     $date4,
                                     $date5,
                                     $link2stage_insp)";
     // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to Stage Insp Line Items didn't work..Please report to Sysadmin. " . mysql_error());
        }
        $sql = "update seqnum set nxtnum = $objid where tablename = 'stage_insp_lineitems'";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for stage Insp Line Items.Please report to Sysadmin. " . mysql_error());
        }
     }

    function updateLI($recnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $linenum = $this->linenum ;
        $normal_dim = "'" . $this->normal_dim . "'";
        $slno1 = $this->slno1 ;
        $slno2 = $this->slno2 ;
        $slno3 = $this->slno3 ;
        $slno4 = $this->slno4 ;
        $slno5 = $this->slno5 ;
        $measured_dim1 = "'" . $this->measured_dim1 . "'" ;
        $measured_dim2 = "'" . $this->measured_dim2 . "'" ;
        $measured_dim3 = "'" . $this->measured_dim3 . "'" ;
        $measured_dim4 = "'" . $this->measured_dim4 . "'" ;
        $measured_dim5 = "'" . $this->measured_dim5 . "'" ;
        $verified_by = "'" . $this->verified_by . "'";
        $insp_by1 = "'" . $this->insp_by1 . "'" ;
        $insp_by2 = "'" . $this->insp_by2 . "'" ;
        $insp_by3 = "'" . $this->insp_by3 . "'" ;
        $insp_by4 = "'" . $this->insp_by4 . "'" ;
        $insp_by5 = "'" . $this->insp_by5 . "'" ;
        $shift1 = "'" . $this->shift1 . "'";
        $shift2 = "'" . $this->shift2 . "'" ;
        $shift3 = "'" . $this->shift3 . "'" ;
        $shift4 = "'" . $this->shift4 . "'" ;
        $shift5 = "'" . $this->shift5 . "'" ;
        $date1 = "'" . $this->date1 . "'" ;
        $date2 = "'" . $this->date2 . "'" ;
        $date3 = "'" . $this->date3 . "'" ;
        $date4 = "'" . $this->date4 . "'" ;
        $date5 = "'" . $this->date5 . "'" ;

        $sql = "update stage_insp_lineitems
                                 set linenum = $linenum,
                                     normal_dim = $normal_dim,
                                     slno1 = $slno1,
                                     slno2 = $slno2,
                                     slno3 = $slno3,
                                     slno4 = $slno4,
                                     slno5 = $slno5,
                                     measured_dim1 = $measured_dim1,
                                     measured_dim2 = $measured_dim2,
                                     measured_dim3 = $measured_dim3,
                                     measured_dim4 = $measured_dim4,
                                     measured_dim5 = $measured_dim5,
                                     verified_by = $verified_by,
                                     insp_by1 = $insp_by1,
                                     insp_by2 = $insp_by2,
                                     insp_by3 = $insp_by3,
                                     insp_by4 = $insp_by4,
                                     insp_by5 = $insp_by5,
                                     shift1 = $shift1,
                                     shift2 = $shift2,
                                     shift3 = $shift3,
                                     shift4 = $shift4,
                                     shift5 = $shift5,
                                     date1 = $date1,
                                     date2 = $date2,
                                     date3 = $date3,
                                     date4 = $date4,
                                     date5 = $date5
                      where recnum = $recnum";
           // echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to stage insp line items didn't work..Please report to Sysadmin. " . mysql_error());
     }


     function getLI($stage_insprecnum) {
        $recnum =$stage_insprecnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select recnum,
                       linenum,
                       normal_dim,
                       slno1,
                       slno2,
                       slno3,
                       slno4,
                       slno5,
                       measured_dim1,
                       measured_dim2,
                       measured_dim3,
                       measured_dim4,
                       measured_dim5,
                       verified_by,
                       insp_by1,
                       insp_by2,
                       insp_by3,
                       insp_by4,
                       insp_by5,
                       shift1,
                       shift2,
                       shift3,
                       shift4,
                       shift5,
                       date1,
                       date2,
                       date3,
                       date4,
                       date5
                   from stage_insp_lineitems
                   where link2stage_insp = $recnum";
        $result = mysql_query($sql);
        return $result;
     }


     function deleteLI($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $recnum =$inprecnum;
        $sql = "delete from stage_insp_lineitems where recnum = $inprecnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for stage insp Line Items Items failed...Please report to SysAdmin. " . mysql_error());
      }

} // End Quote Line Items class definition
