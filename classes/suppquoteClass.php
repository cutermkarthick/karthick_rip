<?php
//====================================
// Author: FSI
// Date-written = Dec 28, 2017
// Filename: suppquoteClass.php
// Maintains the class for Quotes
// Revision: v1.0
//====================================

include_once('loginClass.php');

class suppquote {

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


    function suppquote() 
    {
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


    function setid ($reqid) 
    {
      $this->Id = $reqid;
    }

    function setcreatedate ($req_createdate) 
    {
      $this->createDate = $req_createdate;
    }


    function setquote_date ($req_quote_date) 
    {
      $this->quote_date = $req_quote_date;
    }

    function setcompany ($reqcompany) 
    {
      $this->Company = $reqcompany;
    }

    function setowner ($reqowner) 
    {
      $this->owner = $reqowner;
    }

    function setdesc ($reqdesc) 
    {
      $this->Desc = $reqdesc;
    }

    function setexcelfile ($reqexcelfile) 
    {
      $this->excel_file = $reqexcelfile;
    }

    function setrfqid ($rfqid) 
    {
      $this->rfqId = $rfqid;
    }

    function setdelivarydate ($delivarydate) 
    {
      $this->delivarydate= $delivarydate;
    }

    function setterms ($terms) 
    {
      $this->terms = $terms;
    }

    function setquote2type ($quote2type) {
      $this->quote2type = $quote2type;
    }

    function setquotetype ($quotetype) 
    {
      $this->quotetype = $quotetype;
    }

    function setcomments ($comments) 
    {
      $this->comments = $comments;
    }

    function setsalesperson ($inpsalesperson) 
    {
      $this->salesperson = $inpsalesperson;
    }

    function setmail2customer ($mail2customer) 
    {
      $this->mail2customer = $mail2customer;
    }

    function setconvert2sales ($convert2sales) 
    {
      $this->convert2sales = $convert2sales;
    }

    function setcurrency ($reqcurrency) 
    {
      $this->currency = $reqcurrency;
    }

    function setquote2company ($quote2company) 
    {
      $this->quote2company = $quote2company;
    }

    function setgrosstotal ($grosstotal) 
    {
      $this->grosstotal = $grosstotal;
    }

    function settax ($tax) 
    {
      $this->tax = $tax;
    }

    function setshipping ($shipping) 
    {
      $this->shipping = $shipping;
    }

    function setlabor ($labor) 
    {
      $this->labor = $labor;
    }

    function setmisc ($misc) 
    {
      $this->misc = $misc;
    }

    function settotal_due ($total_due) 
    {
      $this->total_due = $total_due;
    }

    function setlink2bom ($link2bom) 
    {
      $this->link2bom = $link2bom;
    }
    function setrevisionnum($revisionnum) 
    {
      $this->revisionnum = $revisionnum;
    }
    function getrevisionnum() 
    {
      $this->revisionnum = $revisionnum;
    }
    function setparentquoteid($parentquoteid) 
    {
      $this->parentquoteid = $parentquoteid;
    }
    function getparentquoteid() 
    {
      $this->parentquoteid = $parentquoteid;
    }

    function setlockstatus($lockstatus) 
    {
      $this->lockstatus = $lockstatus;
    }

    function getquotessearch($cond,$argoffset,$arglimit,$sort1,$quotecond,$quoteOperator,$quoteVal) 
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      $wcond = $cond;
      $offset = $argoffset;
      $limit = $arglimit;
      $sortorder = $sort1;
      $matchCond ='';

      if($quotecond != '' || $quotecond != null) 
      {
        if($quoteOperator == 'equal') {
          $matchCond="and q.".$quoteVal . "='" . $quotecond ."'";
        }
        else if($quoteOperator == 'like'){
          $matchCond="and q.". $quoteVal . " LIKE '" . $quotecond ."%'";
        }
      }

      $sql = "select q.id, q.company, q.descr, q.excelfile, q.rfqid,
                     q.quote_date, q.recnum, q.quotetype, q.quote2type, e.fname,
                     e.lname, q.convert2sales, q.quote_grosstotal, q.currency,
                     q.mail2customer, q.tax, q.labor, q.shipping, q.misc,
                     b.bomnum, q.lockstatus
              from supplier_quote q
              LEFT OUTER JOIN bom b ON (q.link2bom = b.recnum)
              LEFT OUTER JOIN employee e ON (q.quote2employee = e.recnum)
              where $wcond $matchCond
              ORDER by $sortorder limit $offset, $limit";
      // echo "$sql <br>";        
      $result = mysql_query($sql);
      return $result;
    }

    function getSuppQuoteCount($cond)
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      $wcond = $cond;
      $sql = "select count(*) as numrows
              from supplier_quote q where  $wcond ";
      // echo "$sql <br>";
      $result  = mysql_query($sql) or die('Supp quote count query failed');
      $row     = mysql_fetch_array($result, MYSQL_ASSOC);
      $numrows = $row['numrows'];
      return $numrows;
    }

    function addQuote() 
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      $sql = "start transaction";
      $result = mysql_query($sql);
   
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
      else 
      {
        $link2bom = $this->link2bom;
      }

      $total_due = "'" . $this->total_due . "'";
      $revisionnum = $this->revisionnum;
      if ($revisionnum == 0) {
        $parentquoteid =  $id ;
      }
      else 
      {
        $parentquoteid = "'" . $this->parentquoteid . "'";
      }

      if ($this->lockstatus == '' )
      {
        $lockstatus = 'Not Locked';
      }
      else 
      {
        $lockstatus = "'" . $this->lockstatus . "'";
      }

      $sql = "select * from quote where id = $id";
      $result = mysql_query($sql);
      if (!(mysql_fetch_row($result))) {
        $sql = "INSERT INTO supplier_quote
                            (id,
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
                            ($id,
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

        if(!$result){
          die("Insert to Quote didn't work..Please report to Sysadmin. " . mysql_error());
        }else{
          $objid = mysql_insert_id();
          return $objid;
        } 
      }
      else 
      {
        echo "<table border=1><tr><td><font color=#FF0000>";
        die("Supplier Quote ID " . $id . " already exists. ");
      }
    }

    function getSupplierQuote($quoterecnum) 
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select
                    q.id,
                    q.quote_date,
                    q.company,
                    q.descr,
                    q.excelfile,
                    q.rfqid,
                    q.delivarydate,
                    q.terms,
                    q.quote2type,
                    q.quotetype ,
                    q.comments,
                    q.currency,
                    e.fname,
                    e.lname,
                    e.email,
                    q.quote2employee,
                    q.quote_grosstotal,
                    q.quote2company,
                    q.tax,
                    q.labor,
                    q.shipping,
                    q.misc,
                    b.bomnum,
                    b.recnum,
                    q.parent_quote_id,
                    q.revise_num,
                    q.lockstatus,
                    q.convert2sales,
                    q.mail2customer
                FROM supplier_quote q
                LEFT OUTER JOIN bom b ON (q.link2bom = b.recnum)
                LEFT OUTER JOIN employee e ON (q.quote2employee = e.recnum)
                where  q.recnum = $quoterecnum";
      // echo "$sql";
      $result = mysql_query($sql);
      return $result;
    }

    function getRevnum($inpquoterecnum)
    { 
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      $thisquoterecnum = $inpquoterecnum;
      $sql = "select parent_quote_id from supplier_quote where recnum = $inpquoterecnum";
      $resquoteid =  mysql_query($sql);
      $quoteid = mysql_fetch_row($resquoteid);
      $thisquoteid = "'". $quoteid[0] . "'";

      $sql = "select max(revise_num) from supplier_quote where parent_quote_id = $thisquoteid";
      $resrevnum = mysql_query($sql);
      $revnum = mysql_fetch_row($resrevnum);
      return $revnum[0]+1;
    }

    function updateQuote($quoterecnum) 
    {
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

      if ($link2bom == '') 
      {
        $link2bom=0;
      }
      $total_due = "'" . $this->total_due . "'";
      $lockstatus = "'" . $this->lockstatus . "'";

        $sql = "UPDATE supplier_quote SET
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
      // echo "$sql <br>"; exit;
      $result = mysql_query($sql);
      if(!$result) die("Quote update failed...Please report to SysAdmin. " . mysql_error());
    }

}
?>