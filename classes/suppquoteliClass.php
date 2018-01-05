<?
//====================================
// Author: FSI
// Date-written = Dec 5, 2017 Jerry George
// Filename: suppquoteliClass.php
// Revision: v1.0
//====================================

include_once('loginClass.php');

class suppQuoteli{

    var
     $item,
     $itemdesc,
     $quantity,
     $rate,
     $amount,
     $link2quote;

    function suppQuoteli() {
      $this->item = '';
      $this->itemdesc = '';
      $this->quantity = '';
      $this->rate = '';
      $this->amount = '';
      $this->link2quote = '';
     }


    function setitem ($reqitem) 
    {
      $this->item = $reqitem;
    }

    function setitemdesc ($reqitemdesc) 
    {
      $this->itemdesc = $reqitemdesc;
    }

    function setquantity ($reqquantity) 
    {
      $this->quantity = $reqquantity;
    }

    function setrate ($reqrate) 
    {
      $this->rate = $reqrate;
    }

    function setamount ($reqamount) 
    {
      $this->amount = $reqamount;
    }

    function setlink2quote ($reqlink2quote) 
    {
      $this->link2quote = $reqlink2quote;
    }

    function addQI() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);

        $crdate = "'" . date("y-m-d") . "'";
        $item = "'" . $this->item . "'";
        $item_desc = "'" . $this->itemdesc . "'";
        $quantity = $this->quantity;
        $rate = $this->rate;
        $amount = $this->amount;
        $link2quote = $this->link2quote;

        $sql = "INSERT INTO supplier_quote_li(item,item_desc, quantity, rate,amount, link2quote)
	              VALUES ($item,$item_desc, $quantity,$rate,$amount, $link2quote)";

        $result = mysql_query($sql);
        if(!$result) {
          $sql = "rollback";
          $result = mysql_query($sql);
          die("Insert to Quote Line Items didn't work..Please report to Sysadmin. " . mysql_error());
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

        $sql = "update supplier_quote_li
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
                   from supplier_quote_li
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