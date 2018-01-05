<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: quoteClass.php
// Maintains the class for Quotes
// Revision: v1.0
//====================================

include_once('loginClass.php');

class quote {

    var $Id,
        $Desc,
        $quote_date,
        $createDate,
        $Company,
        $excel_file,
        $owner,
        $rfqId,
        $delivarydate,
        $terms,
        $quote2type,
        $quotetype,
        $comments,
        $salesperson,
        $convert2sales,
        $mail2customer,
        $quote2company,
        $grosstotal,
        $tax,
        $shipping,
        $labor,
        $misc,
        $total_due,
        $currency,
        $revise_num,
        $lockstatus,
        $parent_quote_id;

    // Constructor definition
    function quote() {
        $this->Id = '';
        $this->Desc = '';
        $this->createDate = '';
        $this->quote_date = '';
        $this->Company = '';
        $this->excelfile = '';
        $this->owner = '';
        $this->rfqId = '';
        $this->delivarydate = '';
        $this->terms = '';
        $this->quote2type = '';
        $this->quotetype = '';
        $this->comments = '';
        $this->salesperson = '';
        $this->convert2sales= '';
        $this->mail2customer= '';
        $this->quote2company = '';
        $this->grosstotal= '';
        $this->tax= '';
        $this->shipping= '';
        $this->labor= '';
        $this->misc= '';
        $this->total_due= '';
        $this->link2bom= '';
        $this->revise_num= '';
        $this->parent_quote_id= '';
        $this->lockstatus= '';

    }

    // Property get and set
    function getid() {
           return $this->Id;
    }

    function setid ($reqid) {
           $this->Id = $reqid;
    }

    function getcreatedate() {
           return $this->createDate;
    }

    function setcreatedate ($req_createdate) {
           $this->createDate = $req_createdate;
    }
    function getquote_date() {
           return $this->quote_date;
    }

    function setquote_date ($req_quote_date) {
           $this->quote_date = $req_quote_date;
    }

    function getcompany() {
           return $this->Company;
    }

    function setcompany ($reqcompany) {
           $this->Company = $reqcompany;
    }

    function getowner() {
           return $this->owner;
    }

    function setowner ($reqowner) {
           $this->owner = $reqowner;
    }

    function getdesc() {
           return $this->Desc;
    }

    function setdesc ($reqdesc) {
           $this->Desc = $reqdesc;
    }

    function getexcelfile() {
           return $this->excelfile;
    }

    function setexcelfile ($reqexcelfile) {
           $this->excel_file = $reqexcelfile;
    }

    function getrfqid() {
           return $this->rfqId;
    }

    function setrfqid ($rfqid) {
           $this->rfqId = $rfqid;
    }
    function getdelivarydate() {
           return $this->delivarydate;
    }

    function setdelivarydate ($delivarydate) {
           $this->delivarydate= $delivarydate;
    }
    function getterms() {
           return $this->terms;
    }

    function setterms ($terms) {
           $this->terms = $terms;
    }
    function getquote2type() {
           return $this->quote2type;
    }

    function setquote2type ($quote2type) {
           $this->quote2type = $quote2type;
    }
    function getquotetype() {
           return $this->quotetype;
    }

    function setquotetype ($quotetype) {
           $this->quotetype = $quotetype;
    }
    function getcomments() {
           return $this->comments;
    }

    function setcomments ($comments) {
           $this->comments = $comments;
    }

    function getsalesperson() {
           return $this->salesperson;
    }

    function setsalesperson ($inpsalesperson) {
           $this->salesperson = $inpsalesperson;
    }

    function getmail2customer() {
           return $this->mail2customer;
    }

    function setmail2customer ($mail2customer) {
           $this->mail2customer = $mail2customer;
    }

    function getconvert2sales() {
           return $this->convert2sales;
    }

    function setconvert2sales ($convert2sales) {
           $this->convert2sales = $convert2sales;
    }

    function getcurrency() {
           return $this->currency;
    }

    function setcurrency ($reqcurrency) {
           $this->currency = $reqcurrency;
    }

    function getquote2company() {
           return $this->quote2company;
    }

    function setquote2company ($quote2company) {
           $this->quote2company = $quote2company;
    }
    function getgrosstotal() {
           return $this->grosstotal;
    }

    function setgrosstotal ($grosstotal) {
           $this->grosstotal = $grosstotal;
    }

    function gettax() {
           return $this->tax;
    }

    function settax ($tax) {
           $this->tax = $tax;
    }

    function getshipping() {
           return $this->shipping;
    }

    function setshipping ($shipping) {
           $this->shipping = $shipping;
    }

    function getlabor() {
           return $this->labor;
    }

    function setlabor ($labor) {
           $this->labor = $labor;
    }
    function getmisc() {
           return $this->misc;
    }

    function setmisc ($misc) {
           $this->misc = $misc;
    }
    function gettotal_due() {
           return $this->total_due;
    }

    function settotal_due ($total_due) {
           $this->total_due = $total_due;
    }
    function getlink2bom() {
           return $this->link2bom;
    }

    function setlink2bom ($link2bom) {
           $this->link2bom = $link2bom;
    }
    function setrevisionnum($revisionnum) {
           $this->revisionnum = $revisionnum;
    }
    function getrevisionnum() {
           $this->revisionnum = $revisionnum;
    }
    function setparentquoteid($parentquoteid) {
           $this->parentquoteid = $parentquoteid;
    }
    function getparentquoteid() {
           $this->parentquoteid = $parentquoteid;
    }
        function getlockstatus() {
           return $this->lockstatus;
    }

    function setlockstatus($lockstatus) {
           $this->lockstatus = $lockstatus;
    }

     function addQuote() {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'quote' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crdate = "'" . date("y-m-d") . "'";
        $company = "'" . $this->Company . "'";
        $quote2company=$this->quote2company;
        $rfqid = "'" . $this->rfqId . "'";
        $quote_date = "'" . $this->quote_date . "'";
        $id = "'" . $this->Id . "'";
        $desc = "'" . $this->Desc . "'";
        $excelfile = "'" . $this->excel_file . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $delivarydate = "'" . $this->delivarydate . "'";
        $terms = "'" . $this->terms . "'";
        $quote2type=$this->quote2type;
        $quotetype = "'" . $this->quotetype . "'";
        $comments = "'" . $this->comments . "'";
        $salesperson=$this->salesperson;
        $convert2sales=$this->convert2sales;
        $currency = "'" . $this->currency . "'";


        $grosstotal = "'" . $this->grosstotal . "'";
        $tax = "'" . $this->tax . "'";
        $labor = "'" . $this->labor . "'";
        $shipping = "'" . $this->shipping . "'";
        $misc = "'" . $this->misc . "'";

        if ($this->link2bom == '')
        {
            $link2bom = 0;
        }
        else {
               $link2bom = $this->link2bom;
        }
        $total_due = "'" . $this->total_due . "'";
        $revisionnum = $this->revisionnum;
        if ($revisionnum == 0) {
            $parentquoteid =  $id ;
        }
        else {
            $parentquoteid = "'" . $this->parentquoteid . "'";
        }

        if ($this->lockstatus == '' )
        {
            $lockstatus = 'Not Locked';
        }
        else {
               $lockstatus = "'" . $this->lockstatus . "'";
        }

        $sql = "select * from quote where id = $id";
        // echo $sql;
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        quote
                            (recnum,
                            id,
                            company,
                            descr,
                            excelfile,
                            rfqid,
                            owner_userid,
                            quote_date,
                            creation_date,
                            delivarydate,
                            terms,
                            comments,
                            quote2employee,
                            quote2company,
                            currency,
                            quote_grosstotal,
                            tax,
                            labor,
                            shipping,
                            misc,
                            link2bom,
                            revise_num,
                            parent_quote_id,
                            lockstatus
                            )
                    VALUES
                            ($objid,
                            $id,
                            $company,
                            $desc,
                            $excelfile,
                            $rfqid,
                            $username,
                            $quote_date,
                            $crdate,
                            $delivarydate,
                            $terms,
                            $comments,
                            $salesperson,
                            $quote2company,
                            $currency,
                            $grosstotal,
                            $tax,
                            $labor,
                            $shipping,
                            $misc,
                            $link2bom,
                            $revisionnum,
                            $parentquoteid,
                            $lockstatus
                            )";
        // echo $sql;exit;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to Quote didn't work..Please report to Sysadmin. " . mysql_error());
         }
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Quote ID " . $id . " already exists. ");
         }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'quote'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
        //echo " <br>objid: $objid<br>";
         return $objid;
     }

     function getQuotes() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
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
                  `bom`.`bomnum`
                FROM `quote`
                LEFT OUTER JOIN `bom` ON
                   (`quote`.`link2bom` = `bom`.`recnum`)
                LEFT OUTER JOIN `employee` ON
                (`quote`.`quote2employee` = `employee`.`recnum`)";
      // echo $sql;
        $result = mysql_query($sql);
        return $result;

     }

      function getQuotes1() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userrole = $_SESSION['userrole'];
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
                  `employee`.`email`,
                  `quote`.`tax`,
                  `quote`.`labor`,
                  `quote`.`shipping`,
                  `quote`.`misc`,
                  `quote`.`link2bom`
                FROM `quote`,employee
                WHERE
                 `quote`.`quote2employee` = `employee`.`recnum`
                 AND `employee`.`role` = '$userrole'";
                 // echo $sql;exit;
        $result = mysql_query($sql);
       //echo $sql;
        return $result;

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
     function updateQuote($quoterecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $company = "'" . $this->Company . "'";
        $rfqid = "'" . $this->rfqId . "'";
        $desc = "'" . $this->Desc . "'";
        $quote_date = "'" . $this->quote_date . "'";
        $delivarydate = "'" . $this->delivarydate . "'";
        $terms = "'" . $this->terms . "'";
        $quote2type=$this->quote2type;
        $excelfile = "'" . $this->excel_file . "'";
        $quotetype = "'" . $this->quotetype . "'";
        $comments = "'" . $this->comments . "'";
        $convert2sales= "'" .$this->convert2sales. "'";
        $currency = "'" . $this->currency . "'";
        $salesperson=$this->salesperson ;
        $grosstotal = "'" . $this->grosstotal . "'";
        $tax = "'" . $this->tax . "'";
        $labor = "'" . $this->labor . "'";
        $shipping = "'" . $this->shipping . "'";
        $misc = "'" . $this->misc . "'";
        $link2bom = $this->link2bom;
        if ($link2bom == '') {
            $link2bom=0;
        }
        $total_due = "'" . $this->total_due . "'";
         $lockstatus = "'" . $this->lockstatus . "'";

        $sql = "UPDATE quote SET
                    company = $company,
                    descr = $desc,
                    quote_date = $quote_date,
            	    delivarydate=$delivarydate,
            	    terms =$terms ,
            	    rfqid = $rfqid ,
                    excelfile= $excelfile ,
            	    comments=$comments,
            	    currency=$currency,
            	    quote2employee=$salesperson,
                    quote_grosstotal=$grosstotal,
                    tax=$tax,
                    labor=$labor,
                    shipping=$shipping,
                    misc=$misc,
                    link2bom=$link2bom,
                    lockstatus=$lockstatus
        	WHERE
                    recnum = $quoterecnum ";
   // echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("Quote update failed...Please report to SysAdmin. " . mysql_error());
        }

     function getRevnum($inpquoterecnum)
     {
        $thisquoterecnum = $inpquoterecnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select parent_quote_id from quote where recnum = $inpquoterecnum";
        $resquoteid =  mysql_query($sql);
        $quoteid = mysql_fetch_row($resquoteid);
        $thisquoteid = "'". $quoteid[0] . "'";
        $sql = "select max(revise_num) from quote where parent_quote_id = $thisquoteid";
        $resrevnum = mysql_query($sql);
        $revnum = mysql_fetch_row($resrevnum);
        return $revnum[0]+1;
     }

     function deleteQuote($id) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from quote where id = '$id'";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Quote failed...Please report to SysAdmin. " . mysql_error());
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
// echo "$sql";
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

