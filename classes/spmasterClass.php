<?php

include_once('loginClass.php');
class spmaster
{
var
 $crnnum,
 $partnum,
 $aukpartnum,
 $saabpartnum,
 $currency,
 $price,
 $price_valid_from,
 $price_valid_upto,
 $qty,
 $qty_valid_from,
 $qty_valid_upto,
 $totalcost,
 $totalcost_valid_from,
 $totalcost_valid_upto,
 $link2vendor,
 $create_date,
 $status;
 
 function spmaster()
 {
   $this->crnnum =  '';
   $this->partnum = '';
   $this->aukpartnum =  '';
   $this->saabpartnum =  '';
   $this->price =  '';
   $this->currency =  '';
   $this->price_valid_from =  '';
   $this->price_valid_upto =  '';
   $this->qty =  '';
   $this->qty_valid_from =  '';
   $this->qty_valid_upto =  '';
   $this->totalcost =  '';
   $this->totalcost_valid_from =  '';
   $this->totalcost_valid_upto =  '';
   $this->link2vendor =  '';
   $this->create_date =  '';
   $this->status =  '';
 }
 
 function setcrnnum($crnnum) {
           $this->crnnum = $crnnum;
    }

   function setpartnum($partnum) {
           $this->partnum = $partnum;
    }

    function setstatus($status) {
           $this->status = $status;
    }
   function setcurrency($currency) {
           $this->currency = $currency;
    }
   function setprice($price) {
           $this->price = $price;
    }

     function setaukpartnum($aukpartnum) {
           $this->aukpartnum = $aukpartnum;
    }

    function setsaabpartnum($saabpartnum) {
           $this->saabpartnum = $saabpartnum;
    }

     function setprice_valid_from($price_valid_from) {
           $this->price_valid_from = $price_valid_from;
    }

    function setcreate_date($create_date) {
           $this->create_date = $create_date;
    }

    function setprice_valid_upto($price_valid_upto) {
           $this->price_valid_upto = $price_valid_upto;
    }

    function setqty($qty) {
           $this->qty = $qty;
    }

     function setqty_valid_from($qty_valid_from) {
           $this->qty_valid_from = $qty_valid_from;
    }
    function settotalcost_valid_upto($totalcost_valid_upto) {
           $this->totalcost_valid_upto = $totalcost_valid_upto;
    }

     function setqty_valid_upto($qty_valid_upto) {
           $this->qty_valid_upto = $qty_valid_upto;
    }
    function setlink2vendor($link2vendor) {
           $this->link2vendor = $link2vendor;
    }

     function settotalcost($totalcost) {
           $this->totalcost = $totalcost;
    }
    
     function settotalcost_valid_from($totalcost_valid_from) {
           $this->totalcost_valid_from = $totalcost_valid_from;
    }




  function getspmaster($cond,$argoffset,$arglimit)
  {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $offset = $argoffset;
        $limit = $arglimit;
        $sql = "select sp.recnum,sp.crnnum, sp.partnum, sp.aukpartnum, sp.saabpartnum, sp.currency, sp.price, sp.price_valid_from,
                       sp.price_valid_upto, sp.qty, sp.qty_valid_from, sp.qty_valid_upto, sp.totalcost, sp.totalcost_valid_from,
                       sp.totalcost_valid_upto, sp.qty_ss, sp.link2vendor, sp.create_date, sp.status,c.name
                   from spmaster sp,company c
                   where sp.link2vendor=c.recnum and
                         $cond
                   order by sp.crnnum limit $offset, $limit";
       //echo $sql;
        $result = mysql_query($sql);
        return $result;

     }
     function getspmastercount($cond,$argoffset,$arglimit)
  {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $offset = $argoffset;
        $limit = $arglimit;
        $sql = "select count(*) as numrows
                   from spmaster sp,company c
                   where sp.link2vendor=c.recnum and
                         $cond
                   order by sp.recnum limit $offset, $limit";
       //echo $sql;
        $result  = mysql_query($sql) or die('getspmastercount query failed ' . mysql_error());
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
     // echo "<br>$numrows<br>";
        return $numrows;

     }
     
     function getspmasterdetails($recnum)
  {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select sp.recnum,sp.crnnum, sp.partnum, sp.aukpartnum, sp.saabpartnum, sp.currency, sp.price, sp.price_valid_from,
                       sp.price_valid_upto, sp.qty, sp.qty_valid_from, sp.qty_valid_upto, sp.totalcost, sp.totalcost_valid_from,
                       sp.totalcost_valid_upto, sp.qty_ss, sp.link2vendor, sp.create_date, sp.status,c.name
                   from spmaster sp,company c where sp.link2vendor=c.recnum and sp.recnum=$recnum order by sp.recnum";
    //echo $sql;
        $result = mysql_query($sql);
        return $result;

     }
     
      function addSPmaster()
     {
        $sql = "select nxtnum from seqnum where tablename = 'spmaster' for update";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result)
                     {
                      $sql = "rollback";
                      $result = mysql_query($sql);
                      die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
                     }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crnnum = "'" . $this->crnnum . "'";
        $partnum= "'" . $this->partnum . "'";
        $aukpartnum= "'" . $this->aukpartnum . "'";
        $saabpartnum= "'" . $this->saabpartnum . "'";
        $currency= "'" . $this->currency . "'";
        $price= $this->price?$this->price:0.0;
        $price_valid_from = $this->price_valid_from?"'" . $this->price_valid_from . "'":'0000-00-00';
        $price_valid_upto = $this->price_valid_upto?"'" . $this->price_valid_upto . "'":'0000-00-00';
        $qty= $this->qty?$this->qty:0;
        $qty_valid_from = $this->qty_valid_from?"'" . $this->qty_valid_from . "'":'0000-00-00';
        $qty_valid_upto = $this->qty_valid_upto?"'" . $this->qty_valid_upto . "'":'0000-00-00';
        $totalcost= $this->totalcost?$this->totalcost:0.0;
        $totalcost_valid_from = $this->totalcost_valid_from?"'" . $this->totalcost_valid_from . "'":'0000-00-00';
        $totalcost_valid_upto = $this->totalcost_valid_upto?"'" . $this->totalcost_valid_upto . "'":'0000-00-00';
        $link2vendor=$this->link2vendor;
        $status= "'Active'";
        $sql="select * from spmaster where crnnum = $crnnum and status='Active' and link2vendor=$link2vendor";
       // echo $sql;
        $result = mysql_query($sql);
        if(!(mysql_fetch_row($result)))
        {

        $sql = "select * from spmaster where recnum = $objid";
        //echo $sql;
       //recnum, crn, partnum, descr, currency, price, status, price_valid_from, price_valid_to, create_date, modified_date
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        spmaster
                            (
                            recnum,
                            crnnum,
                            partnum,
                            aukpartnum,
                            saabpartnum,
                            currency,
                            price,
                            price_valid_from,
                            price_valid_upto,
                            qty,
                            qty_valid_from,
                            qty_valid_upto,
                            totalcost,
                            totalcost_valid_from,
                            totalcost_valid_upto,
                            link2vendor,
                            create_date,
                            status
                            )
                            VALUES
                            (
                            $objid,
                            $crnnum,
                            $partnum,
                            $aukpartnum,
                            $saabpartnum,
                            $currency,
                            $price,
                            $price_valid_from,
                            $price_valid_upto,
                            $qty,
                            $qty_valid_from,
                            $qty_valid_upto,
                            $totalcost,
                            $totalcost_valid_from,
                            $totalcost_valid_upto,
                            $link2vendor,
                            now(),
                            $status
                           )";
                          //echo $sql;
             $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Insert to spmaster didn't work..Please report to Sysadmin. " . mysql_error());
                        }
         }
         else {
              //header("Location:errorMessage.php?validate=Inv3");
              die("spmaster ID " . $objid . " already exists. ");
              }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'spmaster'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv4");
                     die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
                     }
       }
       else
       {
          echo "<table border=1><tr><td><font color=#FF0000>";
                          die("An Active CRN with CRN# $crnnum already exists. Please Inactivate and proceed." );
                          echo "</td></tr></table>";
       }
        return $objid;
     }
     
      function updatespmaster($recnum)
     {

        $crnnum = "'" . $this->crnnum . "'";
        $partnum= "'" . $this->partnum . "'";
        $aukpartnum= "'" . $this->aukpartnum . "'";
        $saabpartnum= "'" . $this->saabpartnum . "'";
        $currency= "'" . $this->currency . "'";
        $price= $this->price?$this->price:0.0;
        $price_valid_from = $this->price_valid_from?"'" . $this->price_valid_from . "'":'0000-00-00';
        $price_valid_upto = $this->price_valid_upto?"'" . $this->price_valid_upto . "'":'0000-00-00';
        $qty= $this->qty?$this->qty:0;
        $qty_valid_from = $this->qty_valid_from?"'" . $this->qty_valid_from . "'":'0000-00-00';
        $qty_valid_upto = $this->qty_valid_upto?"'" . $this->qty_valid_upto . "'":'0000-00-00';
        $totalcost= $this->totalcost?$this->totalcost:0.0;
        $totalcost_valid_from = $this->totalcost_valid_from?"'" . $this->totalcost_valid_from . "'":'0000-00-00';
        $totalcost_valid_upto = $this->totalcost_valid_upto?"'" . $this->totalcost_valid_upto . "'":'0000-00-00';
        $link2vendor=$this->link2vendor;
        $status= "'" . $this->status . "'";
        $create_date= "'" . $this->create_date . "'";

           $sql = "update spmaster set
                            crnnum=$crnnum,
                            partnum=$partnum,
                            aukpartnum=$aukpartnum,
                            saabpartnum=$saabpartnum,
                            currency=$currency,
                            price=$price,
                            price_valid_from=$price_valid_from,
                            price_valid_upto=$price_valid_upto,
                            qty=$qty,
                            qty_valid_from=$qty_valid_from,
                            qty_valid_upto=$qty_valid_upto,
                            totalcost=$totalcost,
                            totalcost_valid_from=$totalcost_valid_from,
                            totalcost_valid_upto=$totalcost_valid_upto,
                            link2vendor=$link2vendor,
                            create_date=$create_date,
                            status=$status
                            where recnum=$recnum
                            ";
                          //echo $sql;
             $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Update to spmaster didn't work..Please report to Sysadmin. " . mysql_error());
                        }


     }
     
     function getspmasterdet4stat($crn_num,$status,$comprecnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select crnnum,status,recnum
                        from spmaster
                             where crnnum='$crn_num' and
                                   status='$status' and
                                   link2vendor=$comprecnum";
    //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

}
?>
