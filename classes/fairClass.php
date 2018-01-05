<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: fairClass.php
// Application: WMS
// Revision: v1.0
//====================================

include_once('loginClass.php');

class fair{

    var $crn,
        $wo,
        $cofc,
        $wo_date,
        $type,
        $nc,
        $status,
        $link2wo,
        $mpsrev,
        $remarks;


    // Constructor definition
    function fair() {
        $this->crn = '';
        $this->wo = '';
        $this->wo_date = '';
        $this->type = '';
        $this->cofc = '';
        $this->nc = '';
        $this->status = '';
        $this->link2wo = '';
        $this->mpsrev = '';
        $this->remarks = '';
    }

    // Property get and set
    function getcrn() {
           return $this->crn;
    }

    function setcrn ($reqcrn) {
           $this->crn= $reqcrn;
    }
    function getwo() {
           return $this->wo;
    }

    function setwo($reqwo) {
           $this->wo = $reqwo;
    }
    function getwodate() {
           return $this->wodate;
    }

    function setwodate($reqwodate) {
           $this->wodate = $reqwodate;
    }
    function gettype() {
           return $this->type;
    }

    function settype ($reqtype) {
           $this->type = $reqtype;
    }

    function getnc() {
           return $this->nc;
    }
    function setnc($reqnc) {
           $this->nc = $reqnc;
    }
    function getstat() {
           return $this->status;
    }
    function setstat($reqst) {
           $this->status = $reqst;
    }
    
    function getcofc() {
           return $this->cofc;
    }
    function setcofc($reqcfc) {
           $this->cofc = $reqcfc;
    }
    
    function getlink2wo() {
           return $this->link2wo;
    }
    
    function setlink2wo($reqlink) {
           $this->link2wo = $reqlink;
    }
    
    function getmpsrev() {
           return $this->mpsrev;
    }

    function setmpsrev($reqmps) {
           $this->mpsrev = $reqmps;
    }
    
    function getremarks() {
           return $this->remarks;
    }

    function setremarks($reqremarks) {
           $this->remarks = $reqremarks;
    }

   function addFair() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $crn="'" . $this->crn . "'" ;
        $wonum="'" . $this->wo . "'";
        $wodate="'" . $this->wodate . "'";
        $type = "'" . $this->type . "'";
        $wolink = $this->link2wo;
        $mps_rev = "'" . $this->mpsrev . "'";
        $siteid= "'" . $_SESSION['siteid']. "'";
        //echo $sql;
        $sql = "INSERT INTO fair (crn,
                                wonum,
                                wo_date,
                                type,
                                link2wo,
                                mps_rev,
                                siteid)
                        VALUES ($crn,
                                $wonum,
                                $wodate,
                                $type,
                                $wolink,
                                $mps_rev,
                                $siteid)";
          //echo "$sql";
          $result = mysql_query($sql);
          // Test to make sure query worked
          if(!$result) die("Insert to Fair didn't work..Please report to Sysadmin. " . mysql_error());

        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for Dispatch Insert..Please report to Sysadmin. " . mysql_error());
     }
   function updateFair($recnum)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $type = "'" . $this->type . "'";
        $nc = "'" . $this->nc . "'";
        $status = "'" . $this->status . "'";
        $remarks = "'" . $this->remarks . "'";

        $sql = "update fair set nc = $nc,
                              status = $status,
                              remarks = $remarks
                        where recnum = $recnum";
          // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Update to Fair didn't work..Please report to Sysadmin. " . mysql_error());
    }
    
    function updateFair_cofc($crn,$wo)
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $cofc = "'" . $this->cofc . "'";
        $sql = "update fair set cofc = $cofc
                        where fair.crn = '$crn'
                        and fair.wonum = '$wo'";
          // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Update to Fair Cofc didn't work..Please report to Sysadmin. " . mysql_error());
    }
    
     function get_prev_fair_details($crn)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select fa.type,fa.status,fa.mps_rev from fair fa
                            where fa.crn = '$crn'
                     order by fa.recnum desc limit 1";
       // echo $sql;
        $result = mysql_query($sql);
        if(!$result) die(".......get Previous Fair Details....... failed...Please report to SysAdmin. " . mysql_error());
        return $result;
     }
     
     function get_prev_fairs($crn)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select * from fair fa
                   where fa.crn = '$crn'
                   and fa.type = 'FAIR'
                   and fa.status != 'APPROVED'";
       // echo $sql;
        $result = mysql_query($sql);
        if(!$result) die(".......get Previous Fair....... failed...Please report to SysAdmin. " . mysql_error());
        return $result;
     }

     function getfairDetails($recnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select  fa.recnum,
                        fa.crn,
                        fa.wonum,
                        fa.cofc,
                        fa.wo_date,
                        fa.type,
                        fa.nc,
			            fa.status,
			            fa.remarks
                  FROM fair fa
                  where fa.recnum=$recnum";
        //echo '+++++++++++++++++'.$sql;
        $result = mysql_query($sql);
        if(!$result) die(".......get Fair Details....... failed...Please report to SysAdmin. " . mysql_error());
        return $result;
     }

    function getFairs($cond,$argoffset,$arglimit)
	{
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $offset = $argoffset;
         $limit = $arglimit;
         $siteid = $_SESSION['siteid'];
         $siteval = "fa.siteid = '".$siteid."'";
         $sql = "select fa.recnum,
                        fa.crn,
                        fa.wonum,
                        fa.cofc,
                        fa.wo_date,
                        fa.type,
                        fa.nc,
			            fa.status
                  FROM fair fa
                  where $cond and $siteval
                  order by fa.recnum
                  limit $offset, $limit";

       // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getFairs query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }
     
       function getFairscount($cond)
	{
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $siteid = $_SESSION['siteid'];
         $siteval = "fa.siteid = '".$siteid."'";
         $sql = "select count(*) as numrows
                  FROM fair fa
                  where $cond and $siteval
                  order by fa.recnum";

       // echo "$sql";
         $result  = mysql_query($sql) or die(' getFairscount query failed'. mysql_error());

         $rows=mysql_fetch_array($result,MYSQL_ASSOC);
         $numrows = $rows['numrows'];
         //echo $numrows."---------------<br>";
         return $numrows;
     }
     

   function get_prev_fair_details_new($crn,$revnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select fa.type,fa.status,fa.mps_rev from fair fa
                            where fa.crn = '$crn' and
                                  fa.mps_rev='$revnum'
                     order by fa.recnum desc limit 1";
        // echo $sql;
        $result = mysql_query($sql);
        if(!$result) die(".......get Previous Fair Details....... failed...Please report to SysAdmin. " . mysql_error());
        return $result;
     }
     function get_prev_work_order($crn)
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql="select w.approval from work_order w,master_data m
             where w.link2masterdata=m.recnum and m.CIM_refnum='$crn'";
       //echo $sql;
       $result = mysql_query($sql);
       if(!$result) die("getFairs query failed..Please report to Sysadmin. " . mysql_error());
       return $result;

     }

     function getlat_wo($crn,$num_prev)
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql="select fa.wonum,fa.crn
            from fair fa
                 where fa.crn='$crn'
                 order by fa.recnum limit 2,$num_prev";
       //echo $sql;
       $result = mysql_query($sql);
       if(!$result) die("getlat_wo query failed..Please report to Sysadmin. " . mysql_error());
       return $result;

     }

} //end of class defination
