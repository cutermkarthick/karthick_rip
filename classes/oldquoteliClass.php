<?
//====================================
// Author: FSI
// Date-written = July 5, 2005 Jerry George
// Filename: QuoteliClass.php
// Revision: v1.0
//====================================

include_once('loginClass.php');

class Quoteli{

    var
     $item,
     $itemdesc,
     $quantity,
     $rate,
     $amount,
     $link2quote;

    // Constructor definition
    function Quoteli() {
        $this->item = '';
        $this->itemdesc = '';
        $this->quantity = '';
        $this->rate = '';
        $this->amount = '';
        $this->link2quote = '';
     }

    // Property get and set
    function getitem() {
           return $this->item;
    }

    function setitem ($reqitem) {

           $this->item = $reqitem;
    }


    function getitemdesc() {
           return $this->itemdesc;
    }
    function setitemdesc ($reqitemdesc) {
           $this->itemdesc = $reqitemdesc;
    }

    function getquantity() {
           return $this->quantity;
    }

    function setquantity ($reqquantity) {
           $this->quantity = $reqquantity;
    }
    function getrate() {
           return $this->rate;
    }

    function setrate ($reqrate) {
           $this->rate = $reqrate;
    }
    function getamount() {
           return $this->amount;
    }

    function setamount ($reqamount) {
           $this->amount = $reqamount;
    }

    function getlink2quote() {
           return $this->link2quote;
    }

    function setlink2quote ($reqlink2quote) {
           $this->link2quote = $reqlink2quote;
    }

    function addQI() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'quote_li' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for Quote Line Items ..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crdate = "'" . date("y-m-d") . "'";
        $item = "'" . $this->item . "'";
        $item_desc = "'" . $this->itemdesc . "'";
        $quantity = $this->quantity;
        $rate = $this->rate;
        $amount = $this->amount;
        $link2quote = $this->link2quote;
//echo "link2quote:$link2quote<br>";
        $sql = "INSERT INTO quote_li(recnum, item,item_desc, quantity, rate,amount, link2quote)
	  VALUES ($objid, $item,$item_desc, $quantity,$rate,$amount, $link2quote)";
//echo "$sql";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to Quote Line Items didn't work..Please report to Sysadmin. " . mysql_error());
        }
        $sql = "update seqnum set nxtnum = $objid where tablename = 'quote_li'";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for Quote Line Items.Please report to Sysadmin. " . mysql_error());
        }
     }

    function updateQI($recnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $item = "'" . $this->item . "'";
        $item_desc = "'" . $this->itemdesc . "'";
        $quantity = "'" . $this->quantity . "'";
        $rate = "'" . $this->rate . "'";
        $amount = $this->amount;

        $sql = "update quote_li
                          set item = $item,
                              item_desc = $item_desc,
                              quantity = $quantity,
                              rate = $rate,
                              amount = $amount
                      where recnum = $recnum";
          //  echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to Quote didn't work..Please report to Sysadmin. " . mysql_error());
     }


     function getQI($inprecnum) {
        $recnum =$inprecnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select recnum,item,item_desc,
                       quantity,rate,amount
                   from quote_li
                   where link2quote = $recnum";
        $result = mysql_query($sql);
        return $result;
     }


     function deleteQI($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $recnum =$inprecnum;
        $sql = "delete from quote_li where recnum = $recnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Quote Line Items Items failed...Please report to SysAdmin. " . mysql_error());
      }

} // End Quote Line Items class definition