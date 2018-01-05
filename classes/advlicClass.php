<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: advliClass.php
// Application: WMS
// Revision: v1.0
//====================================

include_once('loginClass.php');

class advlic {

    var  $advlic_no,
         $lic_date;

    // Constructor definition
    function advlic() {
        $this->advlic_no = '';
        $this->lic_date = '';
        $this->from_date = '';
        $this->to_date = '';
        
     }

    // Property get and set
    function getadvlic_no() {
           return $this->advlic_no;
    }

    function setadvlic_no ($advlicno) {
           $this->advlic_no = $advlicno;
    }
    function getdate() {
           return $this->lic_date;
    }

    function setadvlic_date ($advlicdate) {
           $this->lic_date = $advlicdate;
    }
    
    function getfromdate() {
           return $this->from_date;
    }

    function setfromdate ($fromdate) {
           $this->from_date = $fromdate;
    }
    function gettodate() {
           return $this->to_date;
    }

    function settodate ($todate) {
           $this->to_date = $todate;
    }


    function addadvlic() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'advlic' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        //$crdate = "'" . date("y-m-d") . "'";
        $advlicno = "'" . $this->advlic_no . "'";
        $date = "'" . $this->lic_date . "'";
        $from_date = "'" . $this->from_date . "'";
        $to_date = "'" . $this->to_date . "'";
        //$tax=($this->tax == '')? 0:$this->tax;



           $sql = "select * from adv_lic where adv_license = $advlicno";
           $result = mysql_query($sql);
           if (!(mysql_fetch_row($result))) {
              $sql = "INSERT INTO adv_lic (recnum, adv_license, lic_date, from_date, to_date)
                  VALUES ($objid, $advlicno, $date,$from_date, $to_date )";
              //echo "$sql";
              $result = mysql_query($sql);
           // Test to make sure query worked
              if(!$result) die("Insert to adv_lic didn't work..Please report to Sysadmin. " . mysql_error());

            }
           else {
                echo "<table border=1><tr><td><font color=#FF0000>";
               die("Adv License No " . $advlicno . " already exists. ");
               echo "</td></tr></table>";
            }



        $sql = "update seqnum set nxtnum = $objid where tablename = 'advlic'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work for adv_lic..Please report to Sysadmin. " . mysql_error());
        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for advlic Insert..Please report to Sysadmin. " . mysql_error());
        return $objid;
     }

    function updateadvlic($inadvlicrecnum) {

        $advlicrecnum = "'" . $inadvlicrecnum . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $advlicno = "'" . $this->advlic_no . "'";
        $date = "'" . $this->lic_date . "'";
        $from_date = "'" . $this->from_date . "'";
        $to_date = "'" . $this->to_date . "'";


        $sql = "update adv_lic set adv_license = $advlicno,
                              lic_date = $date,
                              from_date = $from_date,
                              to_date = $to_date

                        where recnum = $advlicrecnum";

           //echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to adv_lic didn't work..Please report to Sysadmin. " . mysql_error());

     }
     

      function getadvlicDetails($inadvlicrecnum) {
        $advlicrecnum = "'" . $inadvlicrecnum . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select adv_license,lic_date,from_date,to_date
                 from adv_lic
               where recnum = $advlicrecnum";

       //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Access to advlic details failed...Please report to SysAdmin. " . mysql_error());
        return $result;

     }
     
     function getlic4summary($cond,$argoffset,$arglimit) {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $offset= $argoffset;
         $limit= $arglimit;
         $wcond = $cond;
         //echo $wcond;

         $sql = "select adv.recnum,
                        adv.adv_license,
                        adv.lic_date,
                        advli.partnum,
                        advli.partname,
                        advli.crn
                  FROM adv_lic adv, advlic_li advli
                  where $wcond and
                        adv.recnum = advli.link2adv
                  order by adv.recnum limit $offset, $limit";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getadvlic4summary query failed..Please report to Sysadmin. " . mysql_error());
        return $result;

     }
     function getadvlicCount($cond,$argoffset,$arglimit)
       {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sql = "select count(adv.recnum) as numrows
                  FROM adv_lic adv,advlic_li advli
                  where $wcond and
                  adv.recnum = advli.link2adv limit $offset, $limit";
       $newlogin = new userlogin;
       $newlogin->dbconnect();
      //echo $sql;
        $result  = mysql_query($sql) or die('advlic count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
       return $numrows;
       }







} // End po class definition
