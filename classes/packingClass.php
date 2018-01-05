<?php
  include("classes/loginClass.php");
  
  class packing
  {
  
    var
      $companyrecnum,
      $podate ,
      $ponum,
      $wonum,
      $descr,
      $order_qty,
      $qty_disp,
      $qty_bal,
      $cim_invoice,
      $remarks,
      $pack_date,
      $no_packing,
      $type_packing,
      $transportation,
      $link2invoice,
      $tot_net_wt,
	  $packingnum,
      $gross_wt;
   
   function packing() {
        $this->companyrecnum = '';
        $this->podate = '';
        $this->ponum = '';
        $this->wonum = '';
        $this->descr = '';
        $this->order_qty = '';
        $this->qty_disp = '';
        $this->qty_bal = '';
        $this->cim_invoice = '';
        $this->remarks = '';
        $this->pack_date = '';
        $this->no_packing = '';
        $this->type_packing= '';
        $this->transportation= '';
        $this->link2invoice= '';
        $this->tot_net_wt= '';
        $this->gross_wt= '';
		$this->packingnum='';

    }
    
    function getcompanyrecnum() {
           return $this->companyrecnum;
    }
    function setcompanyrecnum ($companyrecnum) {
           $this->companyrecnum = $companyrecnum;
    }

    function getpodate() {
           return $this->podate;
    }
    function setpodate($podate) {
           $this->podate = $podate;
    }

    function getponum() {
           return $this->ponum;
    }
    function setponum ($ponum) {
           $this->ponum = $ponum;
    }

    function getwonum() {
           return $this->wonum;
    }
    function setwonum ($wonum) {
           $this->wonum = $wonum;
    }

    function getdescr() {
           return $this->descr;
    }
    function setdescr($descr) {
           $this->descr = $descr;
    }

    function getorder_qty() {
           return $this->order_qty;
    }
    function setorder_qty ($order_qty) {
           $this->order_qty = $order_qty;
    }

    function getqty_disp() {
           return $this->qty_disp;
    }
    function setqty_disp ($qty_disp) {
           $this->qty_disp = $qty_disp;
    }
    
    function getqty_bal() {
           return $this->qty_bal;
    }
    function setqty_bal ($qty_bal) {
           $this->qty_bal = $qty_bal;
    }

    function getcim_invoice() {
           return $this->cim_invoice;
    }
    function setcim_invoice ($cim_invoice) {
           $this->cim_invoice = $cim_invoice;
    }
    
    function getno_packing() {
           return $this->no_packing;
    }
    function setno_packing ($no_packing) {
           $this->no_packing = $no_packing;
    }
    
    function getremarks() {
           return $this->remarks;
    }
    function setremarks ($remarks) {
           $this->remarks = $remarks;
    }
    
    function getpack_date() {
           return $this->pack_date;
    }
    function setpack_date ($pack_date) {
           $this->pack_date = $pack_date;
    }
    
    function gettype_packing() {
           return $this->type_packing;
    }
    function settype_packing ($type_packing) {
           $this->type_packing = $type_packing;
    }
    
    function gettransportation() {
           return $this->transportation;
    }
    function settransportation ($transportation) {
           $this->transportation = $transportation;
    }

    function setlink2invoice ($link2invoice) {
           $this->link2invoice = $link2invoice;
    }
     function settot_net_wt ($tot_net_wt) {
           $this->tot_net_wt = $tot_net_wt;
    }
     function setgross_wt ($gross_wt) {
           $this->gross_wt = $gross_wt;
    }
    function setpackingnum ($packingnum) {
           $this->packingnum = $packingnum;
    }

    function addpacking() {
       //echo "I am here";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'packing' for update";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv1");
                     die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
                     }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $prefix = "P";
		$strrecnum=sprintf("%05d",$objid);
        //$packingnum=$prefix.$strrecnum;
        $companyrecnum = "'" . $this->companyrecnum . "'";
        $podate = $this->podate?"'" . $this->podate . "'":'0000-00-00';
        $ponum = "'" . $this->ponum . "'";
        $wonum= "'" . $this->wonum . "'";
        $packingnum=  $this->packingnum;
        $descr = "'" . $this->descr. "'";
	    $order_qty = "'" . $this->order_qty. "'";
        $qty_disp = "'" . $this->qty_disp. "'";
        $qty_bal = "'" . $this->qty_bal. "'";
        $cim_invoice = "'" . $this->cim_invoice. "'";
        $remarks = "'" . $this->remarks. "'";
        $pack_date = $this->pack_date?"'" . $this->pack_date. "'":'0000-00-00';
        $no_packing = $this->no_packing ? $this->no_packing : 0;
        $type_packing = "'" . $this->type_packing. "'";
        $transportation = "'" . $this->transportation . "'";
        $link2invoice = $this->link2invoice;
        $tot_net_wt = $this->tot_net_wt ? $this->tot_net_wt : 0.0;
        $gross_wt = $this->gross_wt ? $this->gross_wt : 0.0;
        
        $sql = "select * from packing where recnum = $objid";
       // echo $sql;
        $result = mysql_query($sql);
        
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        packing
                            (
                            recnum,
							ponum,
							podate,
							wonum,
							descr,
							order_qty,
							qty_dispatch,
					        qty_balance,
                            cim_invoice,
                            remarks,
                            pack_date,
                            no_packings,
                            type_packing,
                            transportation,
                            link2company,
                            packingnum,
                            link2invoice,
                            formrev,
                            tot_net_wt,
                            gross_wt
                            )
                    VALUES
                            (
                            $objid,
							$ponum,
							$podate,
							$wonum,
							$descr,
							$order_qty,
							$qty_disp,
					        $qty_bal,
                            $cim_invoice,
                            $remarks,
                            $pack_date,
                            $no_packing,
                            $type_packing,
                            $transportation,
                            $companyrecnum,
                            '$packingnum',
                            $link2invoice,
                            'F9014 Rev 00 dt August 15, 2011;' ,
                            $tot_net_wt,
                            $gross_wt
                            )";
           //echo "\n" . $sql;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Insert to packing didn't work..Please report to Sysadmin. " . mysql_error());
                        }
         }
         else {
              //header("Location:errorMessage.php?validate=Inv3");
              die("Packing ID " . $objid . " already exists. ");
              }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'packing'";
        //echo $sql;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv4");
                     die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
                     }
        return $objid;
     }
     
     function getpackingdetails($recnum)
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();

       $sql="select p.recnum,p.ponum,p.wonum,p.podate,p.transportation,p.order_qty,p.qty_dispatch,p.qty_balance,
                    p.descr,c.name,p.pack_date,p.no_packings,p.type_packing, p.cim_invoice,p.link2company,
                    p.remarks,p.packingnum,p.link2invoice,p.formrev,
                    c.saddr1,c.saddr2,c.scity,c.state,c.zipcode,p.tot_net_wt,p.gross_wt
                  from packing p,company c 
                  where p.recnum=$recnum and
                     p.link2company=c.recnum";
       //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;
     }
     
       function getpackdetails4summary($cond,$argoffset,$arglimit)
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $offset = $argoffset;
        $limit = $arglimit;
       $sql="select p.recnum,p.ponum,p.wonum,p.podate,p.transportation,p.order_qty,p.qty_dispatch,p.qty_balance,
                    p.descr,c.name,p.pack_date,p.no_packings,p.type_packing, p.cim_invoice,p.link2company,p.remarks,p.packingnum,p.link2invoice
                    from packing p,company c
                         where p.link2company=c.recnum and
                               $cond
                         order by p.recnum desc
                          limit $offset, $limit";
       //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;
     }
     
        function getpackdetails4summarycount($cond,$argoffset,$arglimit)
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $offset = $argoffset;
        $limit = $arglimit;
       $sql="select count(*) as numrows
                           from packing p,company c
                         where p.link2company=c.recnum and
                               $cond
                               limit $offset, $limit";
       //echo "\n" . $sql;
        $result  = mysql_query($sql) or die('getpackdetails4summary count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
         return $numrows;
     }
     
      function updatepacking($recnum) {
       //echo "I am here";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $companyrecnum = "'" . $this->companyrecnum . "'";
        $podate = $this->podate?"'" . $this->podate . "'":'0000-00-00';
        $ponum = "'" . $this->ponum . "'";
        $wonum= "'" . $this->wonum . "'";
        $packingnum= "'" . $this->packingnum . "'";
        $descr = "'" . $this->descr. "'";
	    $order_qty = "'" . $this->order_qty. "'";
        $qty_disp = "'" . $this->qty_disp. "'";
        $qty_bal = "'" . $this->qty_bal. "'";
        $cim_invoice = "'" . $this->cim_invoice. "'";
        $remarks = "'" . $this->remarks. "'";
        $pack_date = $this->pack_date?"'" . $this->pack_date. "'":'0000-00-00';
        $no_packing = $this->no_packing;
        $type_packing = "'" . $this->type_packing. "'";
        $transportation = "'" . $this->transportation . "'";
        $link2invoice = $this->link2invoice;
        $tot_net_wt = $this->tot_net_wt ? $this->tot_net_wt : 0.0;
        $gross_wt = $this->gross_wt ? $this->gross_wt : 0.0;
        $sql = "UPDATE packing SET
                    ponum = $ponum,
                    podate = $podate,
                    wonum = $wonum,
                    descr=$descr,
                    order_qty=$order_qty,
                    qty_dispatch=$qty_disp,
                    qty_balance=$qty_bal,
                    cim_invoice=$cim_invoice,
                    remarks=$remarks,
                    pack_date=$pack_date,
                    no_packings=$no_packing,
                    type_packing=$type_packing,
                    transportation=$transportation,
                    link2company= $companyrecnum,
                    link2invoice=$link2invoice,
                    tot_net_wt=$tot_net_wt,
                    gross_wt=$gross_wt,
					packingnum=$packingnum
                   	WHERE
                    recnum = $recnum";
        // echo $sql;
         $result = mysql_query($sql);
          if(!$result)
           {
	      $sql = "rollback";
	      $result = mysql_query($sql);
	      die("Update to packing failed ..Please report to Sysadmin. " . mysql_error());
           }
         $sql = "commit";
         $result = mysql_query($sql);
         if(!$result)
         {
	       $sql = "rollback";
	       $result = mysql_query($sql);
	       die("Commit Failed for packing..Please report to Sysadmin. " . mysql_errno());
         }
        }
        
        function getallcustinvoice($companyrecnum)
        {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $offset = $argoffset;
         $limit = $arglimit;
          $sql="select i.invnum,i.recnum,i.invdate  from invoice i
                         where i.inv2customer=$companyrecnum";
      // echo "\n" . $sql;
              $result = mysql_query($sql);
              return $result;
        }
        
         function deletePacking($pacrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from packing where recnum = $pacrecnum";
        $result = mysql_query($sql);
        if(!$result)
                     {
                      //header("Location:errorMessage.php?validate=Inv6");
                      die("Delete for Packing failed...Please report to SysAdmin. " . mysql_error());
                     }
      }
      
       function deletepackingli($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $recnum =$inprecnum;
        $sql = "delete from packingli where link2packing = $recnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Line Items failed...Please report to SysAdmin. " . mysql_error());
      }
      
       function deletepackingqtyliflag($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $recnum =$inprecnum;
        $sql = "delete from packing_qtyli where link2packing = $recnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Line Items failed...Please report to SysAdmin. " . mysql_error());
      }


  
 }
?>
