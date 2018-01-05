<?php
//====================================
// Author: FSI
// Date-written = Dec 07, 2006
// Filename: invoiceClass.php
// Maintains the class for invoice
// Revision: v1.0  OWT
//====================================

include_once('loginClass.php');

class arform {
    var
   $exchange_rate,
   $gross_weight,
   $fob_words,
   $link2invoice,
   $link2ship,
   $ar3anum,
   $ar3adate,
   $nopackage,
   $duty_inwords,
   $tot_qty,
   $tot_amt,
   $tot_payableamt,
   $tot_amt_rs,
   $linenumber,
	$marknum,
	$statnum,
	$qty,
	$usd,
	$rate,
    $amtusd,
    $remarks,
    $datew,
    $link2arform,$create_date,
    $vatsubtotal ;

    // Constructor definition
    function arform() {

   $this->exchange_rate =  '';
   $this->gross_weight =  '';
   $this->fob_words =  '';
   $this->link2invoice =  '';
   $this->link2ship =  '';
   $this->ar3anum =  '';
   $this->ar3adate =  '';
   $this->nopackage =  '';
   $this->duty_inwords =  '';
   $this->tot_qty =  '';
   $this->tot_amt =  '';
   $this->tot_payableamt =  '';
   $this->tot_amt_rs =  '';
   $this->linenumber =  '';
	$this->marknum =  '';
	$this->statnum =  '';
	$this->qty =  '';
	$this->usd =  '';
	$this->rate =  '';
    $this->amtusd =  '';
    $this->remarks =  '';
    $this->datew  =  '';
    $this->link2arform  =  '';
    $this->create_date  =  '';
    $this->vatsubtotal  =  '';

    }


    function setexchange_rate ($exchange_rate) {
           $this->exchange_rate = $exchange_rate;
    }

    function setgross_weight($gross_weight) {
           $this->gross_weight = $gross_weight;
    }
    function setfob_words($fob_words) {
           $this->fob_words = $fob_words;
    }

    function setduty_words($duty_inwords) {
           $this->duty_inwords= $duty_inwords;
    }
    function setlink2invoice ($link2invoice) {
           $this->link2invoice = $link2invoice;
    }

    function setlink2ship ($link2ship) {
           $this->link2ship = $link2ship;
    }

    function settot_qty($tot_qty) {
           $this->tot_qty=$tot_qty;
    }
    function settot_amt ($tot_amt) {
           $this->tot_amt = $tot_amt;
    }

    function settot_payableamt($tot_payableamt) {
            $this->tot_payableamt=$tot_payableamt;
    }
    function settot_amt_rs($tot_amt_rs) {
           $this->tot_amt_rs = $tot_amt_rs;
    }

    function setar3anum($ar3anum) {
           $this->ar3anum=$ar3anum;
    }
    function setar3adate ($ar3adate) {
           $this->ar3adate = $ar3adate;
    }

    function setlinenum($linenumber) {
           $this->linenumber = $linenumber;
    }
    function setmarknum($marknum) {
           $this->marknum = $marknum;
    }

    function setstatnum ($statnum) {
           $this->statnum = $statnum;
    }

    function setqty($qty) {
           $this->qty=$qty;
    }
    function setusd ($usd) {
           $this->usd = $usd;
    }

    function setrate($rate) {
            $this->rate=$rate;
    }
    function setamtusd($amtusd) {
           $this->amtusd = $amtusd;
    }

    function setremarks($remarks) {
           $this->remarks=$remarks;
    }
    
     function setdatew($datew) {
           $this->datew=$datew;
    }
      function setlink2arform($link2arform) {
           $this->link2arform=$link2arform;
    }
    function setnopackage($nopackage) {
           $this->nopackage=$nopackage;
    }
    function setcreatedate($create_date) {
           $this->create_date=$create_date;
    }

			 
    function setvatsubtotal($vatsubtotal) {
           $this->vatsubtotal = $vatsubtotal;
    }


    function addarform() {
       //echo "I am here";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'arform' for update";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv1");
                     die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
                     }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum +1;
        //$ar3num=$seqnum -22 +1;
        //echo$seqnum."---------***".$objid."------";
        $prefix = "AR3A";
        //$suffix = "/12-13";
        //$suffix = "/14-15";
       // $suffix = "/15-16";
        $suffix = "/16-17";
        $ar3num=$seqnum - 168 +1;


	$strrecnum=sprintf("%d",$ar3num);
        $ar3anum=$prefix.$strrecnum.$suffix;
        
         $exchange_rate = $this->exchange_rate?$this->exchange_rate:0.0;
         $gross_weight = $this->gross_weight?$this->gross_weight:0.0;
         $tot_payableamt = $this->tot_payableamt?$this->tot_payableamt:0.0;
         $tot_amt_rs = $this->tot_amt_rs?$this->tot_amt_rs:0.0;
         $tot_amt = $this->tot_amt?$this->tot_amt:0.0;
         $tot_qty = $this->tot_qty?$this->tot_qty:0;
         $ar3adate=  $this->ar3adate?"'" . $this->ar3adate . "'":'0000-00-00';
         //$ar3anum =  "'" . $this->ar3anum . "'";
         $link2invoice =$this->link2invoice;
         $fob_words =  "'" . $this->fob_words . "'";
         $duty_inwords =  "'" . $this->duty_inwords . "'";
         $nopackage = "'" . $this->nopackage . "'";
         $link2ship   = $this->link2ship;
         $vatsubtotal= $this->vatsubtotal ? $this->vatsubtotal : 0;

        $sql = "select * from arform where recnum = $objid";
        //echo $sql;
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        arform
                            (
                            recnum,
							link2invoice,
							ar3anum,
							ar3adate,
							exchangerate,
							valueinwords,
					        dutyinwords,
                            totalrupees,
                            totalusd,
                            totqty,
                            numpkgs,
                            grosswt,
                            total_payableamt,
                            create_date,
							link2ship,
              vatsubtotal
                            )
                    VALUES
                            (
                            $objid,
 							$link2invoice,
							'$ar3anum',
							$ar3adate,
                            $exchange_rate,
					        $fob_words,
                            $duty_inwords,
                            $tot_amt_rs,
                            $tot_amt,
                            $tot_qty,
                            $nopackage,
                            $gross_weight,
							$tot_payableamt,
                             now(),
							 $link2ship,
               $vatsubtotal
                            )";
            //echo "\n" . $sql;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Insert to arform didn't work..Please report to Sysadmin. " . mysql_error());
                        }
         }
         else {
              //header("Location:errorMessage.php?validate=Inv3");
              die("AR3A" . $objid . " already exists. ");
              }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'arform'";
       // echo $sql;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv4");
                     die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
                     }
        return $objid;
     }

     function addarformli()
     {
      $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'arform_line_items' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for LI..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        
        $linenum = $this->linenumber;
        $marknum =" ' ". $this->marknum . " ' ";
        $qty = $this->qty?$this->qty:0;
        $statnum =" ' ".  $this->statnum . " ' ";
		$usd = $this->usd? $this->usd:0.0;
        $rate =" ' ". $this->marknum . " ' ";
        $remarks =" ' ". $this->remarks . " ' ";
        $datew=  $this->datew?"'" . $this->datew . "'":'0000-00-00';
		$amtusd = $this->amtusd? $this->amtusd:0.0;
		$link2arform = $this->link2arform;
		
		
        $sql = "INSERT INTO arform_line_items (
		                        recnum,
								line_num,
								marknum,
								statcode,
								qty,
								warehousedate ,
								 valueusd,
								 rate,
								 payableusd,
								  remarks,
							   link2arform)
                            VALUES (
							   $objid,
							   $linenum,
							   $marknum,
							   $statnum,
							   $qty,
							   $datew,
							   $usd,
							   $rate,
							   $amtusd,
							   $remarks,
             				   $link2arform)";
       // echo $sql;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to LI didn't work..Please report to Sysadmin. " . mysql_error());
        }
         $sql = "update seqnum set nxtnum = $objid where tablename = 'arform_line_items'";
   // echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for arform_line_items..Please report to Sysadmin. " . mysql_error());
        }
     }

    function updatearformli($recnum) {
        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        
        $linenum = $this->linenumber;
        $marknum =" ' ". $this->marknum . " ' ";
        $qty = $this->qty?$this->qty:0;
        $statnum =" ' ".  $this->statnum . " ' ";
		$usd = $this->usd? $this->usd:0.0;
        $rate =" ' ". $this->marknum . " ' ";
        $remarks =" ' ". $this->remarks . " ' ";
        $datew=  $this->datew?"'" . $this->datew . "'":'0000-00-00';
		$amtusd = $this->amtusd? $this->amtusd:0.0;
		$link2arform = $this->link2arform;

        $sql = "update arform_line_items
                          set   line_num=$linenum,
								marknum=$marknum,
								statcode=$statnum,
								qty=$qty ,
								warehousedate=$datew ,
							    valueusd=$usd,
							    rate=$rate,
						        payableusd=$amtusd,
						        remarks=$remarks,
							    link2arform=$link2arform    
                        where recnum = $recnum";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("updateshippingli  didn't work..Please report to Sysadmin. " . mysql_error());

     }


     function customeraddress($invoicerecnum) {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select c.name, c.id,
               c.baddr1, c.baddr2, c.bcity, c.bstate,c.bzipcode,c.bcountry,
               c.saddr1, c.saddr2, c.scity, c.sstate, c.szipcode, c.scountry , i.recnum , i.inv2customer
               FROM invoice i, company c
            where c.recnum = i.inv2customer
            and   i.recnum = $invoicerecnum";

//echo "$sql";
       $result = mysql_query($sql);
       if(!$result) die("Failed to get customer address...Please report to SysAdmin. " . mysql_error());
       return $result;
     }

     function getinvoices() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select i.recnum,
		                          i.invnum,
								  i.invdate,
								  i.duedate,
								  i.invdesc,
								  i.terms,
								  i.total,
								  i.status,
								  c.name,
								  i.custpo_num,
								  i.currency,
								  i.fob_or_candf,
								  i.totaldue
                         from invoice i,
						          company c
                         where c.recnum = i.inv2customer";

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;

     }


     function getInvoiceDetails($invoicerecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

       $sql = " select
                            i.recnum,
							i.invnum,
							i.invdate,
							i.duedate,
							i.invdesc,
							i.terms,
							i.currency,
							i.exporter,
							i.consignee,
					        i.precarriageby,
                            i.precarrierreceipt,
                            i.packages,
                            i.countryoforigin,
                            i.countryoffinaldest,
                            i.vessel,
                            i.portofloading,
                            i.portofdischarge,
							i.subtotal,
							i.finaldest,
							i.total,
							i.status,
							i.custpo_num,
							c.name,
							c.baddr1,
							c.bcity,
							c.bcountry,
							c.saddr1,
							c.scity,
							c.scountry,
							i.totaldue,
							i.fob_or_candf,
							i.inv2customer,
							c.saddr2,
							c.addr1,
							c.addr2,
							c.city,
							c.country,
							c.state,
							c.zipcode
                     from invoice i,
					          company c
                    where c.recnum = i.inv2customer and
                                i.recnum = $invoicerecnum";

       //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

     function updatearform($recnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $exchange_rate = $this->exchange_rate?$this->exchange_rate:0.0;
         $gross_weight = $this->gross_weight?$this->gross_weight:0.0;
         $tot_payableamt = $this->tot_payableamt?$this->tot_payableamt:0.0;
         $tot_amt_rs = $this->tot_amt_rs?$this->tot_amt_rs:0.0;
         $tot_amt = $this->tot_amt?$this->tot_amt:0.0;
         $tot_qty = $this->tot_qty?$this->tot_qty:0;
         $ar3adate=  $this->ar3adate?"'" . $this->ar3adate . "'":'0000-00-00';
         $ar3anum =  "'" . $this->ar3anum . "'";
         $link2invoice =$this->link2invoice;
         $fob_words =  "'" . $this->fob_words . "'";
         $duty_inwords =  "'" . $this->duty_inwords . "'";
         $nopackage = "'" . $this->nopackage . "'";
         $link2ship =$this->link2ship;
         $create_date=  $this->create_date?"'" . $this->create_date . "'":'0000-00-00';
        // $vatsubtotal= $this->vatsubtotal ;
         $vatsubtotal= $this->vatsubtotal ? $this->vatsubtotal : 0;
         $sql = "UPDATE arform SET
                     		link2invoice=$link2invoice,
         					ar3anum=$ar3anum,
							ar3adate=$ar3adate,
							exchangerate=$exchange_rate,
							valueinwords=$fob_words,
					        dutyinwords=$duty_inwords,
                            totalrupees=$tot_amt_rs,
                            totalusd=$tot_amt,
                            totqty=$tot_qty ,
                            numpkgs=$nopackage,
                            grosswt=$gross_weight,
                            total_payableamt=$tot_payableamt,
                            create_date=$create_date,
                            modified_date=now(),
							link2ship=$link2ship,
              vatsubtotal=$vatsubtotal
        	WHERE
                    recnum = $recnum";
        //echo $sql;
        $result = mysql_query($sql);

        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv5");
                     die("arform update failed...Please report to SysAdmin. " . mysql_error());
                     }
        }


    function deleteInvoice($invoicerecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from invoice where recnum = $invoicerecnum";
        $result = mysql_query($sql);
        if(!$result)
                     {
                      //header("Location:errorMessage.php?validate=Inv6");
                      die("Delete for Invoice failed...Please report to SysAdmin. " . mysql_error());
                     }
      }


	function getallinvoice()
	{
   $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select
                            i.recnum,
							i.invnum,
							i.invdate,
							i.duedate,
							i.currency,
					        i.precarriageby,
                            i.precarrierreceipt,
                            i.packages,
                            i.countryoforigin,
                            i.countryoffinaldest,
                            i.vessel,
                            i.portofloading,
                            i.portofdischarge,
							i.finaldest,
							i.total,
							c.name,
							c.baddr1,
							c.bcity,
							c.bcountry,
							c.saddr1,
							c.scity,
							c.scountry,
							i.totaldue,
							i.fob_or_candf,
							i.inv2customer
                     from invoice i,
					          company c
                    where c.recnum = i.inv2customer";

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;


	}
	function getinvoice4ship($recnum)
	{
   $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select
                            i.recnum,
							i.invnum,
							i.invdate,
							i.duedate,
							i.currency,
					        i.precarriageby,
                            i.precarrierreceipt,
                            i.packages,
                            i.countryoforigin,
                            i.countryoffinaldest,
                            i.vessel,
                            i.portofloading,
                            i.portofdischarge,
							i.finaldest,
							i.total,
							c.name,
							c.baddr1,
							c.bcity,
							c.bcountry,
							c.saddr1,
							c.scity,
							c.scountry,
							i.totaldue,
							i.fob_or_candf,
							i.inv2customer
                     from invoice i,
					          company c
                    where c.recnum = i.inv2customer and
                    i.recnum=$recnum";

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;


	}

	function getar4summary($cond,$argoffset,$arglimit)
	{
	  $newlogin = new userlogin;
      $newlogin->dbconnect();
      $offset = $argoffset;
        $limit = $arglimit;
      $sql = "select ar.recnum,
	                             ar.link2invoice,
								 ar.ar3anum,
								 ar.ar3adate,
								 ar.exchangerate,
								 ar.valueinwords,
								 ar.dutyinwords,
								 ar.totalrupees,
								 ar.totalusd,
								 ar.totqty,
								 ar.numpkgs,
								 ar.grosswt,
								 ar.total_payableamt,
								 ar.create_date,
								 ar.modified_date,
								 ar.link2ship,
	                             c.name as exporter
	                          from arform ar, company c 
							  where 
							  ar.link2ship = c.recnum and
							  $cond 
	                          order by ar.recnum 
							   limit $offset,$limit ";

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;
	}

		function getar4summarycount($cond,$argoffset,$arglimit)
	{
	  $newlogin = new userlogin;
      $newlogin->dbconnect();
      $offset = $argoffset;
        $limit = $arglimit;
      $sql = "select count(*) as numrows from arform ar where $cond limit $offset,$limit";

       // echo "\n" . $sql;
        $result  = mysql_query($sql) or die('getar4summarycount count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
         return $numrows;
	}

	function getarformlidetails($recnum)
	{
	 $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select * from arform_line_items where link2arform=$recnum";

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;
	}
		function getarformlidetails4print($recnum)
	{
  	 $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select arli.*,ar.*,i.invnum,i.invdate,i.precarriageby from invoice i,arform_line_items arli
      left join arform ar on arli.link2arform=ar.recnum and ar.recnum=$recnum
       where ar.link2invoice=i.recnum";

       // echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;
	}
	

		function getar_formlidetails($recnum)
	{
	  $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select * from arform where recnum=$recnum";

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;
	}

	function getinvlidet4ar($invnum)
	{
	  $newlogin = new userlogin;
      $newlogin->dbconnect();

      $sql = "select concat(il.cimpartnum, ' ',il.descr),il.qty,il.line_amount,i.invnum, i.subtotal, i.vatsubtotal
             from invoice_line_items il,invoice i
                  where il.link2invoice=i.recnum and
                        i.invnum='$invnum'";

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;

	}
	function getpackingslip()
	{
	   $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select p.packingnum
             from packing p";

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;

    }
	function getpackinglidet($ponum)
	{
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select pli.line_num ,pli.length,pli.width,pli.thickness,p.ponum,
                     p.tot_net_wt,p.gross_wt,p.no_packings,p.type_packing
                     from packingli pli,packing p
                          where pli.link2packing=p.recnum and
                                p.packingnum='$ponum'";

       //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;

	}
	
	function getardetails($recnum)
	{
	  $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select  ar.recnum,
	                             ar.link2invoice,
								 ar.ar3anum,
								 ar.ar3adate,
								 ar.exchangerate,
								 ar.valueinwords,
								 ar.dutyinwords,
								 ar.totalrupees,
								 ar.totalusd,
								 ar.totqty,
								 ar.numpkgs,
								 ar.grosswt,
								 ar.total_payableamt,
								 ar.create_date,
								 ar.modified_date,
								 ar.link2ship,
	                             c.name,
								 c.saddr1,
								 c.saddr2,
								 c.scity,
								 c.sstate,
								 c.szipcode,
								 c.scountry,
                 ar.vatsubtotal
	                      from arform ar, company c
	                      where ar.recnum=$recnum and
						              ar.link2ship = c.recnum";

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;
	}

	/*	function getinvlidet4shipping($invnum)
	{
	  $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select il.cimpartnum,il.qty,il.line_amount,i.invnum
             from invoice_line_items il,invoice i
                  where il.link2invoice=i.recnum and
                        i.invnum='$invnum'";

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;

	} */

function convert_number($number)
{
	//echo "<br>Number is $number";
    if (($number < 0) || ($number > 999999999))
    {
    throw new Exception("Number is out of range");
    }

    $Gn = floor($number / 100000);  /* Lakhs (giga) */
    $number -= $Gn * 100000;
    $kn = floor($number / 1000);     /* Thousands (kilo) */
    $number -= $kn * 1000;
    $Hn = floor($number / 100);      /* Hundreds (hecto) */
    $number -= $Hn * 100;
    $Dn = floor($number / 10);       /* Tens (deca) */
    $n = $number % 10;               /* Ones */

    $res = "";

    if ($Gn)
    {
        $res .= $this->convert_number($Gn) . " Lakhs";
    }

    if ($kn)
    {
        $res .= (empty($res) ? "" : " ") .
            $this->convert_number($kn) . " Thousand";
    }

    if ($Hn)
    {
        $res .= (empty($res) ? "" : " ") .
            $this->convert_number($Hn) . " Hundred";
    }

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six",
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen",
        "Nineteen");
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty",
        "Seventy", "Eigthy", "Ninety");

    if ($Dn || $n)
    {
        if (!empty($res))
        {
            $res .= " and ";
        }

        if ($Dn < 2)
        {
            $res .= $ones[$Dn * 10 + $n];
        }
        else
        {
            $res .= $tens[$Dn];

            if ($n)
            {
                $res .= "-" . $ones[$n];
            }
        }
    }

    if (empty($res))
    {
        $res = "zero";
    }

    return $res;
}
function num2words( $num ){
    $ZERO = "zero";
    $MINUS = "minus";
    $lowName = array(
          /* zero is shown as "" since it is never used in combined forms */
          /* 0 .. 19 */
          "", "one", "two", "three", "four", "five",
          "six", "seven", "eight", "nine", "ten",
          "eleven", "twelve", "thirteen", "fourteen", "fifteen",
          "sixteen", "seventeen", "eighteen", "nineteen");

    $tys = array(
          /* 0, 10, 20, 30 ... 90 */
          "", "", "twenty", "thirty", "forty", "fifty",
          "sixty", "seventy", "eighty", "ninety");

    $groupName = array(
          /* We only need up to a quintillion, since a long is about 9 * 10 ^ 18 */
          /* American: unit, hundred, thousand, million, billion, trillion, quadrillion, quintillion */
          "", "hundred", "thousand", "million", "billion",
          "trillion", "quadrillion", "quintillion");

    $divisor = array(
          /* How many of this group is needed to form one of the succeeding group. */
          /* American: unit, hundred, thousand, million, billion, trillion, quadrillion, quintillion */
          100, 10, 1000, 1000, 1000, 1000, 1000, 1000) ;

    $num = str_replace(",","",$num);
    $num = number_format($num,2,'.','');
    $cents = substr($num,strlen($num)-2,strlen($num)-1);
    $num = (int)$num;

    $s = "";

    if ( $num == 0 ) $s = $ZERO;
    $negative = ($num < 0 );
    if ( $negative ) $num = -$num;

    // Work least significant digit to most, right to left.
    // until high order part is all 0s.
    for ( $i=0; $num>0; $i++ ) {
        $remdr = (int)($num % $divisor[$i]);
        $num = $num / $divisor[$i];
        // check for 1100 .. 1999, 2100..2999, ... 5200..5999
        // but not 1000..1099,  2000..2099, ...
        // Special case written as fifty-nine hundred.
        // e.g. thousands digit is 1..5 and hundreds digit is 1..9
        // Only when no further higher order.
        if ( $i == 1 /* doing hundreds */ && 1 <= $num && $num <= 5 ){
            if ( $remdr > 0 ){
                $remdr += $num * 10;
                $num = 0;
            } // end if
        } // end if
        if ( $remdr == 0 ){
            continue;
        }
        $t = "";
        if ( $remdr < 20 ){
            $t = $lowName[$remdr];
        }
        else if ( $remdr < 100 ){
            $units = (int)$remdr % 10;
            $tens = (int)$remdr / 10;
            $t = $tys [$tens];
            if ( $units != 0 ){
               $t .= "-" . $lowName[$units];
            }
        }else {
            $t = $inWords($remdr);
        }
        $s = $t . " " . $groupName[$i] . " "  . $s;
        $num = (int)$num;
    } // end for
    $s = trim($s);
    if ( $negative ){
        $s = $MINUS . " " . $s;
    }

    //$s .= " and Paise $cents";
    $s .= "";


    return $s;
} // end inWords

		function getallinvoice4ar($invnum,$customer)
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
		if ($invnum == '')
        {
			$sql = "select
                            i.recnum,
							i.invnum,
							i.invdate,
							i.duedate,
							i.currency,
					        i.precarriageby,
                            i.precarrierreceipt,
                            i.packages,
                            i.countryoforigin,
                            i.countryoffinaldest,
                            i.vessel,
                            i.portofloading,
                            i.portofdischarge,
							i.finaldest,
							i.total,
							c.name,
							c.baddr1,
							c.bcity,
							c.bcountry,
							c.saddr1,
							c.scity,
							c.scountry,
							i.totaldue,
							i.fob_or_candf,
							i.inv2customer,
							i.dcnum,
							i.dcdate
                     from invoice i,
					          company c
                    where c.recnum = i.inv2customer and
                          c.recnum = $customer and
					           i.invnum like '%'
					order by i.recnum";
		}
		else {
              $sql = "select
                            i.recnum,
							i.invnum,
							i.invdate,
							i.duedate,
							i.currency,
					        i.precarriageby,
                            i.precarrierreceipt,
                            i.packages,
                            i.countryoforigin,
                            i.countryoffinaldest,
                            i.vessel,
                            i.portofloading,
                            i.portofdischarge,
							i.finaldest,
							i.total,
							c.name,
							c.baddr1,
							c.bcity,
							c.bcountry,
							c.saddr1,
							c.scity,
							c.scountry,
							i.totaldue,
							i.fob_or_candf,
							i.inv2customer,
							i.dcnum,
							i.dcdate
                     from invoice i,
					          company c
                    where c.recnum = i.inv2customer and
					           i.invnum like '$invnum%'
					order by i.recnum";
		}

        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;


	}


} // End invoice class definition
?>
