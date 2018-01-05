<?php

include_once('loginClass.php');
class price
{
 var
    $crnnum,
   $cimpartname,
   $status,
   $currency,
   $price,
   $validf,
   $validt,
   $remarks,
   $create_date,
   $type,
   $partname,
    $link2customer;
   
   function price() {

   $this->crnnum =  '';
   $this->cimpartname = '';
   $this->status =  '';
   $this->currency =  '';
   $this->price =  '';
   $this->validf =  '';
   $this->validt =  '';
   $this->remarks =  '';
   $this->create_date =  '';
   $this->type =  '';
   $this->partname =  '';
   $this->link2customer =  '';
   }
   
    function setcrnnum($crnnum) {
           $this->crnnum = $crnnum;
    }

   function setcimpartname($cimpartname) {
           $this->cimpartname = $cimpartname;
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

     function setvalidf($validf) {
           $this->validf = $validf;
    }

    function setvalidt($validt) {
           $this->validt = $validt;
    }

     function setremarks($remarks) {
           $this->remarks = $remarks;
    }
    
    function setcreate_date($create_date) {
           $this->create_date = $create_date;
    }
    
    function settype($type) {
           $this->type = $type;
    }
    
    function setpartname($partname) {
           $this->partname = $partname;
    }
    
     function setlink2customer($link2customer) {
           $this->link2customer = $link2customer;
    }


  function getprice($cond,$argoffset,$arglimit) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $offset = $argoffset;
        $limit = $arglimit;
        $sql = "select 
		                    p.recnum,
		                    p.crn,
							p.partnum,
							p.status,
							p.price_valid_from,
							p.price_valid_to,
							p.price,
							p.currency,
							p.type,
                            p.descr,
                            p.partname,
                            c.name,
                            p.link2customer
                        from price p ,company c where $cond and
                        p.link2customer=c.recnum
						order by recnum limit $offset, $limit";
       // echo $sql;
        $result = mysql_query($sql);
        return $result;

     }
     function getpricecount($cond,$argoffset,$arglimit) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $offset = $argoffset;
        $limit = $arglimit;
        $sql = "select
                      count(*) as numrows
                        from price p ,company c where $cond and
                        p.link2customer=c.recnum
                               limit $offset, $limit";
       //echo "\n" . $sql;
        $result  = mysql_query($sql) or die('getpackdetails4summary count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
         return $numrows;

     }
     
     function getprice4details($recnum,$custrecnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select
		                    p.recnum,
		                    p.crn,
							p.partnum,
							p.status,
							p.price_valid_from,
							p.price_valid_to,
							p.price,
							p.currency,
							p.create_date,
							p.type,
                            p.descr,
                            p.partname,
                            p.formrev,
                            c.name,
                            p.link2customer
                        from price p ,company c where p.recnum=$recnum and  p.link2customer=c.recnum
						order by recnum";
       // echo $sql;
        $result = mysql_query($sql);
        return $result;

     }
     
     /*function getprice4invoice($custporecnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select
                            cli.crnnum,
							cli.cimpartnum,
                            cli.qty,
                            cli.price
                        from custpo_line_items cli,custpo c
                        where cli.link2custpo=c.recnum and c.recnum=$custporecnum
						";
        echo $sql;
        $result = mysql_query($sql);
        return $result;

     } */
     
function getprice4invoice($custrecnum,$invdate) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select crn,partnum,partname,price,type
                       from price
                            where link2customer=$custrecnum and
                                  to_days(price_valid_from) <= to_days('$invdate') and 
                                  to_days(price_valid_to) >= to_days('$invdate')
                       order by crn ";
        // echo $sql;
        $result = mysql_query($sql);
        return $result;

     }
     
     function addPrice()
     {
        $sql = "select nxtnum from seqnum where tablename = 'price' for update";
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
         $cimpartname =  "'" . $this->cimpartname . "'";
        $status =  "'" . $this->status . "'";
        $currency = "'" . $this->currency . "'";
        $price = $this->price?$this->price:0.0;
        $validf = $this->validf?"'" . $this->validf . "'":'0000-00-00';
       $validt = $this->validt? "'" . $this->validt . "'":'0000-00-00';
       $remarks =  "'" . $this->remarks . "'";
       $type =  "'" . $this->type . "'";
       $link2customer =$this->link2customer;
       $partname ="'" . $this->partname . "'";
       $sql = "select * from price where recnum = $objid";
       // echo $sql;
       //recnum, crn, partnum, descr, currency, price, status, price_valid_from, price_valid_to, create_date, modified_date
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        price
                            (
                            recnum,
							crn,
							partnum,
							descr,
							currency,
							price,
					        status,
                            price_valid_from,
                            price_valid_to,
                            create_date,
                            type,
                            partname,
                            formrev,
                            link2customer)
                            VALUES
                            (
                            $objid,
                            $crnnum,
							$cimpartname,
							$remarks,
							$currency,
							$price,
					        $status,
                            $validf,
                            $validt,
                           now(),
                           $type,
                           $partname,
                           'F7000 Rev 00 dt August 04, 2011;',
                           $link2customer
                           )";
                          //echo $sql;
             $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Insert to price didn't work..Please report to Sysadmin. " . mysql_error());
                        }
         }
         else {
              //header("Location:errorMessage.php?validate=Inv3");
              die("Price ID " . $objid . " already exists. ");
              }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'price'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv4");
                     die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
                     }
        return $objid;
     }
     
     function updatePrice($recnum)
     {

       $crnnum = "'" . $this->crnnum . "'";
       $cimpartname =  "'" . $this->cimpartname . "'";
       $status =  "'" . $this->status . "'";
       $currency = "'" . $this->currency . "'";
       $price = $this->price?$this->price:0.0;
       $validf = $this->validf?"'" . $this->validf . "'":'0000-00-00';
       $validt = $this->validt? "'" . $this->validt . "'":'0000-00-00';
       $remarks =  "'" . $this->remarks . "'";
       $type =  "'" . $this->type . "'";
       $create_date = $this->create_date? "'" . $this->create_date . "'":'0000-00-00';
       $partname ="'" . $this->partname . "'";
       $link2customer =$this->link2customer;

           $sql = "UPDATE price SET
                     		crn=$crnnum,
							partnum=$cimpartname,
							status=$status,
							price=$price,
							currency=$currency,
					        price_valid_from=$validf,
                            price_valid_to=$validt,
                            descr=$remarks,
                            create_date=$create_date,
                            modified_date=now(),
                            type=$type,
                            partname=$partname,
                            link2customer=$link2customer
                            where recnum=$recnum";
                           //echo $sql;
             $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("update to price didn't work..Please report to Sysadmin. " . mysql_error());
                        }

     }
     
     function getcrn4custpo($custrecnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select
		                p.recnum,
		                p.crn,
				p.partnum,
				p.status,
				p.price_valid_from,
				p.price_valid_to,
				p.price,
				p.currency,
				p.type,
                            p.descr,
                            p.partname
                        from price p
                        where link2customer=$custrecnum and
                              (CURDATE() <= p.price_valid_to and CURDATE() >= p.price_valid_from)
			order by p.crn ";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;

     }


}
?>
