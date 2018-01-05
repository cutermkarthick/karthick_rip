<?
//====================================
// Author: FSI
// Date-written = july 04, 2007
// Filename: nc4storesClass.php
// Maintains the class for nc4stores
//====================================

include_once('loginClass.php');

class mdm {
    var
       $refnum,
       $partnum,
       $partname,
       $drg_issue,
       $attachments,
       $dim1,
       $dim2,
       $dim3,
       $raw_mat_type,
       $raw_mat_spec,
       $maching_cycle_time,
       $filtering_cycle_time,
       $inopectun_cycle_time,
       $part_type,
       $customer,
       $project;

    // Constructor definition
    function mdm() {
        $this->refnum = '';
        $this->partnum = '';
        $this->partname = '';
        $this->drg_issue = '';
        $this->attachments = '';
        $this->dim1 = '';
        $this->dim2 = '';
        $this->dim3 = '';
        $this->raw_mat_type = '';
        $this->raw_mat_spec = '';
        $this->maching_cycle_time = '';
        $this->filtering_cycle_time = '';
        $this->inopectun_cycle_time = '';
        $this->part_type = '';
        $this->customer = '';
        $this->project = '';
     }

    function getrefnum() {
           return $this->refnum;
    }
    function setrefnum ($refnum) {
           $this->refnum = $refnum;
    }

    function getpartnum() {
           return $this->partnum;
    }
    function setpartnum($partnum) {
           $this->partnum = $partnum;
    }

    function getpartname() {
           return $this->partname;
    }
    function setpartname ($partname) {
           $this->partname = $partname;
    }

    function getdrg_issue() {
           return $this->drg_issue;
    }
    function setdrg_issue($drg_issue) {
           $this->drg_issue = $drg_issue;
    }

    function getattachments() {
           return $this->attachments;
    }
    function setattachments($attachments) {
           $this->attachments = $attachments;
    }

    function getdim1() {
           return $this->dim1;
    }
    function setdim1 ($dim1) {
           $this->dim1 = $dim1;
    }

    function getdim2() {
           return $this->dim2;
    }
    function setdim2($dim2) {
           $this->dim2 = $dim2;
    }

    function getdim3() {
           return $this->dim3;
    }
    function setdim3 ($dim3) {
           $this->dim3 = $dim3;
    }

    function getraw_mat_type() {
           return $this->raw_mat_type;
    }
    function setraw_mat_type($raw_mat_type) {
           $this->raw_mat_type = $raw_mat_type;
    }

      function getraw_mat_spec() {
           return $this->raw_mat_spec;
    }

    function setraw_mat_spec ($raw_mat_spec) {
           $this->raw_mat_spec = $raw_mat_spec;
    }

    function getmaching_cycle_time() {
           return $this->maching_cycle_time;
    }

    function setmaching_cycle_time($maching_cycle_time) {
           $this->maching_cycle_time = $maching_cycle_time;
    }

    function getfiltering_cycle_time() {
           return $this->filtering_cycle_time;
    }

    function setfiltering_cycle_time ($filtering_cycle_time) {
           $this->filtering_cycle_time = $filtering_cycle_time;
    }

    function getinopectun_cycle_time() {
           return $this->inopectun_cycle_time;
    }

    function setinopectun_cycle_time($inopectun_cycle_time) {
           $this->inopectun_cycle_time = $inopectun_cycle_time;
    }

    function getpart_type() {
           return $this->part_type;
    }

    function setpart_type($part_type) {
           $this->part_type = $part_type;
    }


    function getcustomer() {
           return $this->customer;
    }

    function setcustomer ($customer) {
           $this->customer = $customer;
    }

    function getproject() {
           return $this->project;
    }

    function setproject($project) {
           $this->project = $project;
    }

       function addmdm() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'mdm' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

         $refnum = "'" . $this->refnum . "'";
         $partnum = "'" . $this->partnum . "'";
         $partname = "'" . $this->partname . "'";
         $drg_issue = "'" . $this->drg_issue . "'";
         $attachments = "'" . $this->attachments . "'";
         $dim1 = "'" . $this->dim1 . "'";
         $dim2 = "'" . $this->dim2 . "'";
         $dim3 = "'" . $this->dim3 . "'";
         $raw_mat_type = "'" . $this->raw_mat_type . "'";
         $raw_mat_spec = "'" . $this->raw_mat_spec . "'";
         $maching_cycle_time = "'" . $this->maching_cycle_time . "'";
         $filtering_cycle_time = "'" . $this->filtering_cycle_time . "'";
         $inopectun_cycle_time = "'" . $this->inopectun_cycle_time . "'";
         $part_type = "'" . $this->part_type . "'";
         $customer = "'" . $this->customer . "'";
         $project = "'" . $this->project . "'";

        $sql = "select * from mdm where refnum = $refnum";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {

           $sql = "INSERT INTO
                        mdm
                           (recnum,
                            refnum,
                            partnum,
                            partname,
                            drg_issue,
                            attachments,
                            dim1,
                            dim2,
                            dim3,
                            raw_mat_type,
                            raw_mat_spec,
                            maching_cycle_time,
                            filtering_cycle_time,
                            inopectun_cycle_time,
                            part_type,
                            customer,
                            project)
                     VALUES
                           ($objid,
                            $refnum,
                            $partnum,
                            $partname,
                            $drg_issue,
                            $attachments,
                            $dim1,
                            $dim2,
                            $dim3,
                            $raw_mat_type,
                            $raw_mat_spec,
                            $maching_cycle_time,
                            $filtering_cycle_time,
                            $inopectun_cycle_time,
                            $part_type,
                            $customer,
                            $project)";
        //echo $sql;
           $result = mysql_query($sql);

           $sql = "commit";
           $result = mysql_query($sql);

           // Test to make sure query worked
           if(!$result) die("Insert to mdm didn't work..Please report to Sysadmin. " . mysql_error());
         }
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Ref Num " . $refnum . " already exists. ");
         }

        $sql = "start transaction";
        $result = mysql_query($sql);

        $sql = "update seqnum set nxtnum = $objid where tablename = 'mdm'";
        $result = mysql_query($sql);

        $sql = "commit";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
        //echo " <br>objid: $objid<br>";
         return $objid;
     }

     function getmdms() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,refnum,partnum,partname,drg_issue,attachments
                  FROM mdm";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;

     }


     function getmdm($mdmrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = " select recnum,
                        refnum,
                        partnum,
                        partname,
                        drg_issue,
                        attachments,
                        dim1,
                        dim2,
                        dim3,
                        raw_mat_type,
                        raw_mat_spec,
                        maching_cycle_time,
                        filtering_cycle_time,
                        inopectun_cycle_time,
                        part_type,
                        customer,
                        project
            FROM mdm
            where recnum = $mdmrecnum";
//echo $sql;
        $result = mysql_query($sql);

        return $result;
     }

     function updatemdm($mdmrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

         $refnum = "'" . $this->refnum . "'";
         $partnum = "'" . $this->partnum . "'";
         $partname = "'" . $this->partname . "'";
         $drg_issue = "'" . $this->drg_issue . "'";
         $attachments = "'" . $this->attachments . "'";
         $dim1 = "'" . $this->dim1 . "'";
         $dim2 = "'" . $this->dim2 . "'";
         $dim3 = "'" . $this->dim3 . "'";
         $raw_mat_type = "'" . $this->raw_mat_type . "'";
         $raw_mat_spec = "'" . $this->raw_mat_spec . "'";
         $maching_cycle_time = "'" . $this->maching_cycle_time . "'";
         $filtering_cycle_time = "'" . $this->filtering_cycle_time . "'";
         $inopectun_cycle_time = "'" . $this->inopectun_cycle_time . "'";
         $part_type = "'" . $this->part_type . "'";
         $customer = "'" . $this->customer . "'";
         $project = "'" . $this->project . "'";

       $sql = "UPDATE mdm SET
                    refnum = $refnum,
                    partnum = $partnum,
                    partname = $partname,
                    drg_issue = $drg_issue,
                    raw_mat_type = $raw_mat_type,
                    raw_mat_spec = $raw_mat_spec,
                    dim1 = $dim1,
                    dim2 = $dim2,
                    dim3 = $dim3,
                    raw_mat_type = $raw_mat_type,
                    raw_mat_spec = $raw_mat_spec,
                    maching_cycle_time = $maching_cycle_time,
                    filtering_cycle_time = $filtering_cycle_time,
                    inopectun_cycle_time = $inopectun_cycle_time,
                    part_type = $part_type,
                    customer = $customer,
                    project = $project

        	WHERE
                    recnum = $mdmrecnum";
        //echo $sql;
        $result = mysql_query($sql);

        $sql = "commit";
        $result = mysql_query($sql);

        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv5");
                     die("mdm update failed...Please report to SysAdmin. " . mysql_error());
                     }
        }


    function deletemdm($mdmrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from mdm where recnum = $mdmrecnum";
        $result = mysql_query($sql);

        $sql = "commit";
        $result = mysql_query($sql);

        if(!$result)
                     {
                      //header("Location:errorMessage.php?validate=Inv6");
                      die("Delete for mdm failed...Please report to SysAdmin. " . mysql_error());
                     }
      }

} // End invoice class definition

