<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: quoteClass.php
// Maintains the class for Quotes
// Revision: v1.0
//====================================

include_once('loginClass.php');

class final_insp_report {

    var  $refnum,
         $qty,
         $customer,
         $wonum,
         $partnum,
         $billnum,
         $billdate,
         $partname,
         $ponum,
         $issue,
         $reportnum,
         $page,
         $approved_by,
         $approved_date;

    // Constructor definition
    function final_insp_report() {
        $this->refnum = '';
        $this->qty = '';
        $this->customer = '';
        $this->wonum = '';
        $this->partnum = '';
        $this->billnum = '';
        $this->billdate = '';
        $this->partname = '';
        $this->ponum = '';
        $this->issue = '';
        $this->reportnum = '';
        $this->page = '';
        $this->approved_by = '';
        $this->approved_date = '';

    }

    // Property get and set
    function getrefnum() {
           return $this->refnum;
    }

    function setrefnum ($refnum) {
           $this->refnum = $refnum;
    }

    function getqty() {
           return $this->qty;
    }

    function setqty ($qty) {
           $this->qty = $qty;
    }
    function getcustomer() {
           return $this->customer;
    }

    function setcustomer ($customer) {
           $this->customer = $customer;
    }

    function getwonum() {
           return $this->wonum;
    }

    function setwonum ($wonum) {
           $this->wonum = $wonum;
    }

    function getpartnum() {
           return $this->partnum;
    }

    function setpartnum ($partnum) {
           $this->partnum = $partnum;
    }

    function getbillnum() {
           return $this->billnum;
    }

    function setbillnum ($billnum) {
           $this->billnum = $billnum;
    }

     function getbilldate() {
           return $this->billdate;
    }

    function setbilldate ($billdate) {
           $this->billdate = $billdate;
    }

     function getpartname() {
           return $this->partname;
    }

    function setpartname ($partname) {
           $this->partname = $partname;
    }

     function getponum() {
           return $this->ponum;
    }

    function setponum ($ponum) {
           $this->ponum = $ponum;
    }

     function getissue() {
           return $this->issue;
    }

    function setissue ($issue) {
           $this->issue = $issue;
    }
    
    function getreportnum() {
           return $this->reportnum;
    }

    function setreportnum ($reportnum) {
           $this->reportnum = $reportnum;
    }
    
    function getpage() {
           return $this->page;
    }

    function setpage ($page) {
           $this->page = $page;
    }
    
    function getapproved_by() {
           return $this->approved_by;
    }

    function setapproved_by ($approved_by) {
           $this->approved_by = $approved_by;
    }
    
    function getapproved_date() {
           return $this->approved_date;
    }

    function setapproved_date ($approved_date) {
           $this->approved_date = $approved_date;
    }

    function addFinal_insp() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'final_insp_report' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        
         $refnum = "'" . $this->refnum . "'";
         $qty = "'" . $this->qty . "'";
         $customer = "'" . $this->customer . "'";
         $wonum = "'" . $this->wonum . "'";
         $partnum = "'" . $this->partnum . "'";
         $billnum = "'" . $this->billnum . "'";
         $billdate = "'" . $this->billdate . "'";
         $partname = "'" . $this->partname . "'";
         $ponum = "'" . $this->ponum . "'";
         $issue = "'" . $this->issue . "'";
         $reportnum = "'" . $this->reportnum . "'";
         $page = "'" . $this->page . "'";
         $approved_by = "'" . $this->approved_by . "'";
         $approved_date = "'" . $this->approved_date . "'";
         $siteid = "'" . $_SESSION['siteid'] . "'";

           $sql = "INSERT INTO
                        final_insp_report
                           (recnum,
                            refnum,
                            qty,
                            customer,
                            wonum,
                            partnum,
                            billnum,
                            billdate,
                            partname,
                            ponum,
                            issue,
                            reportnum,
                            page,
                            approved_by,
                            approved_date,
                            siteid)
                     VALUES
                           ($objid,
                            $refnum,
                            $qty,
                            $customer,
                            $wonum,
                            $partnum,
                            $billnum,
                            $billdate,
                            $partname,
                            $ponum,
                            $issue,
                            $reportnum,
                            $page,
                            $approved_by,
                            $approved_date,
                            $siteid)";
        //echo $sql;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to final_insp_report didn't work..Please report to Sysadmin. " . mysql_error());


        $sql = "update seqnum set nxtnum = $objid where tablename = 'final_insp_report'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
        //echo " <br>objid: $objid<br>";
         return $objid;
     }

     function getFinal_insps($cond,$argoffset,$sort1,$arglimit) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $siteid = $_SESSION['siteid'];
        $siteval = "fir.siteid = '".$siteid."'";

           $sql= "select fir.recnum, fir.refnum, fir.customer,
                         fir.wonum, fir.ponum,
                         fir.billdate,
                         fir.approved_date,
                         fir.partnum
                    from final_insp_report fir
                    where $wcond and $siteval
                         limit $offset, $limit";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

     function getFinal_insp($final_insprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT
                  recnum,
                  refnum,
                  qty,
                  customer,
                  wonum,
                  partnum,
                  billnum,
                  billdate,
                  partname,
                  ponum,
                  issue,
                  reportnum,
                  page,
                  approved_by,
                  approved_date
                FROM final_insp_report where recnum = $final_insprecnum";
      // echo $sql;
        $result = mysql_query($sql);
        return $result;

     }
     function getwos4qa()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select m.recnum,m.partname,m.wonum,m.partnum,
                      m.CIM_refnum,w.wonum,w.po_num,c.name
                      from master_data m, work_order w ,company c
                      where
                           w.wo2customer=c.recnum and
                           w.link2masterdata = m.recnum";
       $result = mysql_query($sql);
       return $result;

    }

      function getfinal_inspCount($cond,$argoffset,$arglimit)
    {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;


        $siteid = $_SESSION['siteid'];
        $siteval = "siteid = '".$siteid."'";
             $sql = "select count(*) as numrows
                                      from final_insp_report
                                       where $siteval
                                        limit $offset, $limit";
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       //echo "$sql";
       $result  = mysql_query($sql) or die('final insp report count query failed');
       $row     = mysql_fetch_array($result, MYSQL_ASSOC);
       $numrows = $row['numrows'];
       return $numrows;
    }



     function getQuote($quoterecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select
                    id,
                    quote_date,
                    company,
                    descr,
                    excelfile,
                    rfqid,
                    delivarydate,
                    terms,
                    quote2type,
                    quotetype ,
                    comments,
                    currency,
                  `employee`.`fname`,
                  `employee`.`lname`,
                  `employee`.`email`,
		           quote2employee,
                   quote_grosstotal,
                   quote2company,
                   tax,
                   labor,
                   shipping,
                   misc,
                  `bom`.`bomnum`,
                  `bom`.`recnum`,
                   parent_quote_id,
                   revise_num,
                   lockstatus,
                   convert2sales,
                   mail2customer
                FROM `quote`
                LEFT OUTER JOIN `bom` ON
                   (`quote`.`link2bom` = `bom`.`recnum`)
                LEFT OUTER JOIN `employee` ON
                (`quote`.`quote2employee` = `employee`.`recnum`)
                  where  quote.recnum = $quoterecnum";
//echo "$sql";
        $result = mysql_query($sql);
        return $result;
     }
     function updateFinal_insp($final_insprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

         $refnum = "'" . $this->refnum . "'";
         $qty = "'" . $this->qty . "'";
         $customer = "'" . $this->customer . "'";
         $wonum = "'" . $this->wonum . "'";
         $partnum = "'" . $this->partnum . "'";
         $billnum = "'" . $this->billnum . "'";
         $billdate = "'" . $this->billdate . "'";
         $partname = "'" . $this->partname . "'";
         $ponum = "'" . $this->ponum . "'";
         $issue = "'" . $this->issue . "'";
         $reportnum = "'" . $this->reportnum . "'";
         $page = "'" . $this->page . "'";
         $approved_by = "'" . $this->approved_by . "'";
         $approved_date = "'" . $this->approved_date . "'";

        $sql = "UPDATE final_insp_report SET
                     refnum = $refnum,
                     qty = $qty,
                     customer = $customer,
                     wonum = $wonum,
                     partnum = $partnum,
                     billnum = $billnum,
                     billdate = $billdate,
                     partname = $partname,
                     ponum = $ponum,
                     issue = $issue,
                     reportnum = $reportnum,
                     page = $page,
                     approved_by = $approved_by,
                     approved_date = $approved_date
        	   WHERE
                    recnum = $final_insprecnum ";
   // echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("final_insp_report update failed...Please report to SysAdmin. " . mysql_error());
        }


     function deletefinal_insp($refnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from final_insp_report where refnum = '$refnum'";
        $result = mysql_query($sql);
        if(!$result) die("Delete for final insp failed...Please report to SysAdmin. " . mysql_error());
      }

     function updateStatus($quotenum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "update quote set convert2sales='Converted to Sales Order' where recnum = $quotenum";
        $result = mysql_query($sql);
        if(!$result) die("Update for Quote failed...Please report to SysAdmin. " . mysql_error());
      }

     function getStatus($quotenum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select  convert2sales from quote where recnum = $quotenum";
        $result = mysql_query($sql);
        if(!$result) die("Update for Quote failed...Please report to SysAdmin. " . mysql_error());
        return $result;
      }

      function updatemailStatus($quotenum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "update quote set mail2customer='Emailed to the Customer contact' where recnum = $quotenum";
        $result = mysql_query($sql);
        if(!$result) die("Update for Quote failed...Please report to SysAdmin. " . mysql_error());
      }


     function getmailStatus($quotenum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select  mail2customer from quote where recnum = $quotenum";
        $result = mysql_query($sql);
        if(!$result) die("Update for Quote failed...Please report to SysAdmin. " . mysql_error());
        return $result;
      }

    function updatelockStatus($quotenum) {
        $lockstatus = "'" . $this->lockstatus . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "update quote set lockstatus =$lockstatus where recnum = $quotenum";
        $result = mysql_query($sql);
        if(!$result) die("Update for Quote failed...Please report to SysAdmin. " . mysql_error());
      }


     function getlockStatus1($quotenum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select lockstatus from quote where recnum = $quotenum";
        $result = mysql_query($sql);
        if(!$result) die("query for Quote failed...Please report to SysAdmin. " . mysql_error());
        return $result;
      }


    function ftp_copy($source_file,$destination_file)
     {
	    $ftp_server='ftp.fluentsoft.com';
	    $ftp_user='bmandyam@fluentsoft.com';
	    $ftp_password='dci1034';
	    $conn_id=ftp_connect($ftp_server);
	    $login_result=ftp_login($conn_id,$ftp_user,$ftp_password);
	    if (( !$conn_id ) || ( !$login_result ))
	    {
		    die("FTP connection Failed");
	    }
	    $upload=ftp_put($conn_id,$destination_file,$source_file,FTP_BINARY);
	    ftp_close($conn_id);
	    if(!$upload)
	    {
		    die("FTP copy has failed");
	    }

      }
 //Function for search/sort coded by Jerry George 30 Dec -04
  function getquotessearch($cond,$argoffset,$arglimit,$sort1,$quotecond,$quoteOperator,$quoteVal) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder = $sort1;

        $matchCond ='';
    if($quotecond != '' || $quotecond != null) {
          if($quoteOperator == 'equal') {
                $matchCond="and `quote`.".$quoteVal . "='" . $quotecond ."'";
          }else if($quoteOperator == 'like'){

                $matchCond="and `quote`.". $quoteVal . " LIKE '" . $quotecond ."%'";
          }
     }

                  $sql = "SELECT
                  `quote`.`id`,
                  `quote`.`company`,
                  `quote`.`descr`,
                  `quote`.`excelfile`,
                  `quote`.`rfqid`,
                  `quote`.`quote_date`,
                  `quote`.`recnum`,
                  `quote`.`quotetype`,
                  `quote`.`quote2type`,
                  `employee`.`fname`,
                  `employee`.`lname`,
                  `quote`.`convert2sales`,
                  `quote`.`quote_grosstotal`,
                  `quote`.`currency`,
                  `quote`.`mail2customer`,
                  `quote`.`tax`,
                  `quote`.`labor`,
                  `quote`.`shipping`,
                  `quote`.`misc`,
                  `bom`.`bomnum`,
                  `quote`.`lockstatus`

                FROM `quote`
                LEFT OUTER JOIN `bom` ON
                   (`quote`.`link2bom` = `bom`.`recnum`)
                LEFT OUTER JOIN `employee` ON
                (`quote`.`quote2employee` = `employee`.`recnum`)
                 where $wcond $matchCond
                ORDER by $sortorder limit $offset, $limit";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;
     }
   //Function for pagination coded by Jerry George 30 Dec -04
  function getquoteCount($cond,$argoffset,$arglimit)
    {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
             $sql = "select count(*) as numrows
                                      from quote where  $wcond limit $offset, $limit";
       $newlogin = new userlogin;
       $newlogin->dbconnect();
//echo "$sql";
    $result  = mysql_query($sql) or die('quote count query failed');
    $row     = mysql_fetch_array($result, MYSQL_ASSOC);
    $numrows = $row['numrows'];
    return $numrows;
    }

} // End quoteclass definition

