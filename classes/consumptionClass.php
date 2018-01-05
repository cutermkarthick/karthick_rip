<?php
//====================================
// Author: FSI
// Date-written = Apr 23, 2012
// Filename: consumptionClass.php
// Maintains the class for Consumption
//====================================
include_once('loginClass.php');
class consumption
{
var
 $crnnum,
 $grnnum,
 $grndate,
 $ponum,
 $description,
 $qtyrecd,
 $qtyused,
 $closingbal,
 $qtyrecdwt,
 $qtyconswt,
 $wastage,
 $create_date,
 $status,
 $invnum,
 $bond_num,
 $prevbondnum,
 $bonddate,
 $be_num,
 $bedate,
 $invdate,
 $cofcnum,
 $company,
 $rmtype,
 $uom,
 $invamt,$qty,$currency,$qty_rej,$wonum,$rej,$rework,$inv_assessval,$inv_dutyamt,$be_rmtype;

 function consumption()
 {
   $this->crnnum =  '';
   $this->grnnum = '';
   $this->grndate =  '';
   $this->ponum =  '';
   $this->description =  '';
   $this->qtyrecd =  '';
   $this->qtyused =  '';
   $this->closingbal =  '';
   $this->qtyrecdwt =  '';
   $this->qtyconswt =  '';
   $this->wastage =  '';
   $this->status =  '';
   $this->create_date =  '';
   $this->invnum =  '';
   $this->bond_num =  '';
   $this->prevbondnum =  '';
   $this->bonddate =  '';
   $this->be_num =  '';
   $this->bedate =  '';
   $this->invamt =  '';
   $this->assessval =  '';
   $this->cifval =  '';
   $this->dutyamt =  '';
   $this->invdate =  '';
   $this->cofcnum =  '';
   $this->company =  '';
   $this->rmtype =  '';
   $this->uom =  '';
   $this->invamt =  '';
   $this->qty =  '';
   $this->currency =  '';
   $this->qty_rej =  '';
   $this->inv_assessval =  '';
   $this->inv_dutyamt =  '';
   $this->be_rmtype =  '';
}

 function setcrnnum($crnnum) {
           $this->crnnum = $crnnum;
    }

   function setgrnnum($grnnum) {
           $this->grnnum = $grnnum;
    }

    function setstatus($status) {
           $this->status = $status;
    }
   function setgrndate($grndate) {
           $this->grndate = $grndate;
    }
   function setponum($ponum) {
           $this->ponum = $ponum;
    }

     function setdescription($description) {
           $this->description = $description;
    }

    function setqtyrecd($qtyrecd) {
           $this->qtyrecd = $qtyrecd;
    }

     function setqtyused($qtyused) {
           $this->qtyused = $qtyused;
    }

    function setcreate_date($create_date) {
           $this->create_date = $create_date;
    }

    function setclosingbal($closingbal) {
           $this->closingbal = $closingbal;
    }

    function setqtyrecdwt($qtyrecdwt) {
           $this->qtyrecdwt = $qtyrecdwt;
    }

     function setqtyconswt($qtyconswt) {
           $this->qtyconswt = $qtyconswt;
    }
    function setwastage($wastage) {
           $this->wastage = $wastage;
    }

     function setinvnum($invnum) {
           $this->invnum = $invnum;
    }

    function setbond_num($bond_num) {
           $this->bond_num = $bond_num;
    }

    function setbe_num($be_num) {
           $this->be_num = $be_num;
    }

    function setinvdate($invdate) {
           $this->invdate = $invdate;
    }
    function setcofcnum($cofcnum) {
           $this->cofcnum = $cofcnum;
    }
     function setrmtype($rmtype) {
           $this->rmtype = $rmtype;
    }
     function setuom($uom) {
           $this->uom = $uom;
    }
    function setcompany($company) {
           $this->company = $company;
    }
    function setbonddate($bonddate) {
           $this->bonddate = $bonddate;
    }
	function setbedate($bedate) {
           $this->bedate= $bedate;
    }
	function setdutyamt($dutyamt) {
           $this->dutyamt = $dutyamt;
    }
    function setassessval($assessval) {
           $this->assessval = $assessval;
    }
    function setcifval($cifval) {
           $this->cifval = $cifval;
    }
    function setinvamt($invamt) {
           $this->invamt = $invamt;
    }
   function setprevbondnum($prevbondnum) {
           $this->prevbondnum = $prevbondnum;
    }
    function setprevbenum($prevbenum) {
           $this->prevbenum = $prevbenum;
    }
    function setqty($qty) {
           $this->qty = $qty;
    }
    function setcurrency($currency) {
           $this->currency = $currency;
    }
    function setqty_rej($qty_rej) {
           $this->qty_rej = $qty_rej;
    }
    function setinv_assessval($inv_assessval) {
           $this->inv_assessval = $inv_assessval;
    }
    
    function setinv_dutyamt($inv_dutyamt) {
           $this->inv_dutyamt = $inv_dutyamt;
    }
     function setbe_rmtype($be_rmtype) {
           $this->be_rmtype = $be_rmtype;
    }

     function getwoqty4grn($grnnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql2 = "select wo.wonum,wo.book_date,sum(wps.acc),sum(wps.rework),
                        sum(wps.rej),sum(wps.ret),wo.qty ,sum(wo.qty)
                 from work_order wo
                 left join wo_part_status wps on ((wps.link2wo = wo.recnum) and
                       (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi'))

                 where
                       wo.grnnum = '$grnnum' and
                       wo.`condition` !='Cancelled'
                  group by wo.grnnum
                  order by wo.wonum";
        //echo $sql2;
        $result2 = mysql_query($sql2);
        if(!$result2) die("getwoqty4grn failed..Please report to Sysadmin. " . mysql_error());
        return $result2;
      }

       function getgrndets4edit($grnnum) {
         //echo $grnnum."*--*--*-";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "select recnum, invoice_num, grnnum, grn_date, ponum, description,
                        qty_recd, qty_cons, create_date, modified_date, crn, status,
                        closingbal, invoice_date, cofc_num, bond_num, be_num, grnwonum,
                        company, rmtype, uom, bonddate, bedate, assessval, cifval,
                        dutyamt, invamt, qty, currency, qty_rej, parentgrnnum,
                        expinvnum, inv_assessval, inv_dutyamt
                        from consumption where recnum='$grnnum' group by grnnum
                    ";
        //echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getgrndets4edit failed..Please report to Sysadmin. " . mysql_error());
        return $result1;
      }
      //bond_num,be_num,invoice_num,
      function getgrndets4report($cond,$offset,$rowsPerPage) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "select
		                     invoice_num,
							 grnnum,
							 grn_date,
							 ponum,
							 description,
							 qty_recd,
							 qty_cons,
							 create_date,
							 modified_date,
							 crn,
							 status,
							 closingbal,
							 invoice_date,
							 cofc_num,
							 bond_num,
							 be_num,
							 grnwonum,
							 company,
							 rmtype,
							 uom,
							 bonddate,
							 bedate,
							 assessval,
							 cifval,
							 dutyamt,
							 invamt,recnum,qty,currency,qty_rej,parentgrnnum,expinvnum,inv_assessval,inv_dutyamt
		                     from consumption g
		                     where $cond
							 order by bond_num,be_num,invoice_num,grnnum,cofc_num
							 limit $offset,$rowsPerPage";
//echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getgrndets4report failed..Please report to Sysadmin. " . mysql_error());
        return $result1;
      }
      
       function getdetailsforrmreport($cond,$offset,$rowsPerPage) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "select
		                     invoice_num,
							 grnnum,
							 grn_date,
							 ponum,
							 description,
							 qty_recd,
							 qty_cons,
							 create_date,
							 modified_date,
							 crn,
							 status,
							 closingbal,
							 invoice_date,
							 cofc_num,
							 bond_num,
							 be_num,
							 grnwonum,
							 company,
							 rmtype,
							 uom,
							 bonddate,
							 bedate,
							 assessval,
							 cifval,
							 dutyamt,
							 invamt,recnum,sum(qty) as qty,currency,qty_rej,
                             parentgrnnum,expinvnum,inv_assessval,
                             inv_dutyamt,be_rmtype
		                     from consumption g
		                     where $cond
		                     group by bond_num,be_num
							 order by bond_num,be_num
							 limit $offset,$rowsPerPage";
//echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getgrndets4report failed..Please report to Sysadmin. " . mysql_error());
        return $result1;
      }
      
      function getrmdets4count($cond,$offset,$rowsPerPage) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "select count(*) as numrows
                       from consumption
                       where
                     $cond group by bond_num,be_num";
        //echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        //if(!$result1) die("getgrndets4count failed..Please report to Sysadmin. " . mysql_error());
       //$row     = mysql_fetch_array($result1, MYSQL_ASSOC);
        //$numrows = $row['numrows'];
         //echo $numrows;
         return $result1;
      }

      function getgrndets4count($cond,$offset,$rowsPerPage) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "select count(*) as numrows
                       from consumption
                       where
                     $cond";
        //echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getgrndets4count failed..Please report to Sysadmin. " . mysql_error());
        $row     = mysql_fetch_array($result1, MYSQL_ASSOC);
        $numrows = $row['numrows'];
         //echo $numrows;
         return $numrows;
      }

     function getqty4rmcrn($crnnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql2 = "select rm.unitrmwt,rm.unitfgwt,rm.recnum
                        from rmmaster rm
                             where
                                  rm.crnnum = '$crnnum' and
                                  rm.rm_status !='Inactive'
                                  group by rm.crnnum";
        //echo $sql2;
        $result = mysql_query($sql2);
        if(!$result) die("getqty4rmcrn failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
      }

      function getrmpodets($ponum,$crnnum,$line_num) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql2 = "select concat(pli.material_ref,'  ',pli.material_spec,'  ',pli.length,'x',pli.width,'x',pli.thick ,'',pli.uom)
                        from po p,po_line_items pli
                             where
                                  pli.link2po=p.recnum and
                                  p.ponum='$ponum' and
                                  pli.crn='$crnnum'
                                  group by p.ponum";
        //echo $sql2;//and pli.line_num='$linenum'
        $result = mysql_query($sql2);
        if(!$result) die("getrmpodets failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
      }


       function getgrndets4excel($cond) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "select  g.recnum,
		                             g.grnnum,g.batch_num, sum(gli.qty_to_make) as qtm,
                         g.crn,g.invoice_num,g.cimponum,g.recieved_date,g.rmpolinenum,cn.status
                       from grn_li gli,grn g
                            left join consumption cn on cn.grnnum=g.grnnum
                       where
                     g.recnum = gli.link2grn and
		             g.grntype != 'Quarantined' and
		             g.status != 'Closed' and
		             g.status != 'Cancelled' and
		             g.status != 'Pending' and
                    (gli.amendlinenum = ''  or gli.amendlinenum is null or gli.amendlinenum = 0 )and
                    $cond
                       group by g.grnnum order by g.recieved_date ";
        //echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getgrndets4report failed..Please report to Sysadmin. " . mysql_error());
        return $result1;
      }

      function addconsumption($recnum)
     {
        $sql = "select nxtnum from seqnum where tablename = 'consumption' for update";
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
        $grnnum= "'" . $this->grnnum . "'";
        $ponum= "'" . $this->ponum . "'";
        $description= "'" . $this->description . "'";
        $status= "'" . $this->status . "'";
        $qtyrecd= $this->qtyrecd?$this->qtyrecd:0.0;
        $grndate = $this->grndate?"'" . $this->grndate . "'":'0000-00-00';
        $qtyused= $this->qtyused?$this->qtyused:0;
        $qtyrecdwt= $this->qtyrecdwt?$this->qtyrecdwt:0.0;
        $qtyconswt= $this->qtyconswt?$this->qtyconswt:0.0;
        $closingbal= $this->closingbal?$this->closingbal:0.0;
        $wastage= $this->wastage?$this->wastage:0.0;
        $status= "'" . $this->status . "'";
        $invnum= "'" . $this->invnum . "'";
        $inv_num= $this->invnum;
        $create_date = $this->create_date?"'" . $this->create_date . "'":'0000-00-00';
        $bond_num= "'" . $this->bond_num . "'";
        $be_num= "'" . $this->be_num . "'";
        $invdate = $this->invdate?"'" . $this->invdate . "'":'0000-00-00';
        $cofcnum= "'" . $this->cofcnum . "'";
        $company= "'" . $this->company . "'";
        $rmtype= "'" . $this->rmtype . "'";
        $uom= "'" . $this->uom . "'";
        $invamt= $this->invamt?$this->invamt:0.0;
        $currency= "'" . $this->currency . "'";
        $qty_rej= $this->qty_rej?$this->qty_rej:0.0;
        $status= "'" . $this->status . "'";
        $inv_assessval= $this->inv_assessval?$this->inv_assessval:0;
        $inv_dutyamt=$this->inv_dutyamt?$this->inv_dutyamt:0;
        $sql = "select * from consumption where grnnum = $grnnum";
       // echo $sql;
        $result = mysql_query($sql);
        $resultex = mysql_query($sql);
        $myrowres=mysql_fetch_row($resultex);

        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        consumption
                            (
                            recnum,
                            crn,
                            invoice_num,
                            grnnum,
                            grn_date,
                            ponum,
                            description,
                            qty_recd,
                            qty_cons,
                            qty_recdwt,
                            qty_conswt,
                            wastage,
                            create_date,
                            status,
                            closingbal,
                            invoice_date,
                            cofc_num,
                            company,
                            rmtype,
                            uom,
                            invamt,currency,qty_rej
                            )
                            VALUES
                            (
                            $objid,
                            $crnnum,
                            $invnum,
                            $grnnum,
                            $grndate,
                            $ponum,
                            $description,
                            $qtyrecd,
                            $qtyused,
                            $qtyrecdwt,
                            $qtyconswt,
                            $wastage,
                            now(),
                            $status,
                            $closingbal,
                            $invdate,
                            $cofcnum,
                            $company,
                            $rmtype,
                            $uom,
                            $invamt,$currency ,$qty_rej
                           )";
            //echo $sql;
             $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Insert to consumption didn't work..Please report to Sysadmin. " . mysql_error());
                        }

                         $sql = "update seqnum set nxtnum = $objid where tablename = 'consumption'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv4");
                     die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
                     }

         }
         else {    //echo $invnum."---------$myrowres[0]";
                    if($inv_num !='NIL' && $inv_num !='-' && $inv_num !='')
                    {
                      $sql = "update consumption set
                            modified_date=now(),
                            bond_num=$bond_num,
                            be_num=$be_num,
                            invamt=$invamt,
                            currency=$currency
                            where invoice_num=$invnum and
                            company=$company
                            ";
                    }else
                    {
                          $sql = "update consumption
                                         set
                                         modified_date=now(),
                                         bond_num=$bond_num,
                                         be_num=$be_num,
                                         invamt=$invamt,
                                         currency=$currency
                                         where recnum=$recnum";

                    }

              // echo $sql;
               $result = mysql_query($sql);
           // Test to make sure query worked
                       if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Update to consumption didn't work..Please report to Sysadmin. " . mysql_error());
                        }
              }


     }

     function getcofcdets4grn($cofcnum)
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql="select sum(dli.dispatch_qty),d.relnotenum
                    from dispatch d,dispatch_line_items dli
                         where d.relnotenum='$cofcnum' and dli.link2dispatch=d.recnum
                         group by d.relnotenum
                         order by (d.relnotenum+0)";
                         //echo $sql;
       $result=mysql_query($sql);
       return $result;
     }
      function getbond4edit($bondnum) {
         //echo $grnnum."*--*--*-";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
       $sql1 = "select
		                     invoice_num,
							 grnnum,
							 grn_date,
							 ponum,
							 description,
							 qty_recd,
							 qty_cons,
							 create_date,
							 modified_date,
							 crn,
							 status,
							 closingbal,
							 invoice_date,
							 cofc_num,
							 bond_num,
							 be_num,
							 grnwonum,
							 company,
							 rmtype,
							 uom,
							 bonddate,
							 bedate,
							 assessval,
							 cifval,
							 dutyamt,
							 invamt,qty,recnum,currency,qty_rej,expinvnum,inv_assessval
		                     from consumption g
						where bond_num = '$bondnum' and (parentgrnnum ='' or parentgrnnum is null)
						order by grnnum
                       ";
        //echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getbond4edit failed..Please report to Sysadmin. " . mysql_error());
        return $result1;
      }

      function upd4bond() {
         //echo $grnnum."*--*--*-";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
		$bondnum= $this->bond_num;
		$prevbondnum= $this->prevbondnum;
		$bonddate= $this->bonddate?$this->bonddate:'0000-00-00';
		$status= "'" . $this->status . "'";
        $sql = "update consumption
		                   set
                            bond_num='$bondnum',
                            bonddate='$bonddate',
                            status=$status
                            where bond_num='$prevbondnum'
                            ";
          //echo $sql;
          $result = mysql_query($sql);
	  }
      function getbe4edit($benum) {
         //echo $grnnum."*--*--*-";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
       $sql1 = "select
		                     invoice_num,
							 grnnum,
							 grn_date,
							 ponum,
							 description,
							 qty_recd,
							 qty_cons,
							 create_date,
							 modified_date,
							 crn,
							 status,
							 closingbal,
							 invoice_date,
							 cofc_num,
							 bond_num,
							 be_num,
							 grnwonum,
							 company,
							 rmtype,
							 uom,
							 bonddate,
							 bedate,
							 assessval,
							 cifval,
							 dutyamt,
							 invamt,qty,currency,qty_rej,expinvnum,be_rmtype
		                     from consumption g
					  where be_num = '$benum'
					  order by grnnum
                       ";
        //echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getbe4edit failed..Please report to Sysadmin. " . mysql_error());
        return $result1;
      }

      function upd4be() {
         //echo $grnnum."*--*--*-";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
		$benum= $this->be_num;
		$prevbenum= $this->prevbenum;
		$be_rmtype= $this->be_rmtype;
		$bedate= $this->bedate?$this->bedate:'0000-00-00';
		$assessval= $this->assessval?$this->assessval:0;
		$cifval= $this->cifval?$this->cifval:0;
		$dutyamt= $this->dutyamt?$this->dutyamt:0;
        $sql = "update consumption
		                   set
                            be_num='$benum',
                            bedate='$bedate',
							assessval = '$assessval',
							cifval = '$cifval',
							dutyamt = '$dutyamt',
							be_rmtype='$be_rmtype'
                            where be_num='$prevbenum'
                            ";
         // echo $sql;
          $result = mysql_query($sql);
	  }

	  function getgrndets4export($cond) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "select
		                     invoice_num,
							 grnnum,
							 grn_date,
							 ponum,
							 description,
							 qty_recd,
							 qty_cons,
							 create_date,
							 modified_date,
							 crn,
							 status,
							 closingbal,
							 invoice_date,
							 cofc_num,
							 bond_num,
							 be_num,
							 grnwonum,
							 company,
							 rmtype,
							 uom,
							 bonddate,
							 bedate,
							 assessval,
							 cifval,
							 dutyamt,
							 invamt,currency,qty,qty_rej,parentgrnnum,expinvnum,inv_assessval,inv_dutyamt
		                     from consumption g
		                     where $cond
							 order by grnnum";
       // echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getgrndets4report failed..Please report to Sysadmin. " . mysql_error());
        return $result1;
      }

function getconsumptiondets4grn($invnum)
{
  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $sql="select c.bond_num,c.bonddate,c.be_num,c.bedate,c.invamt,c.assessval,c.cifval,c.dutyamt,c.currency
               from consumption c
                    where c.invoice_num='$invnum'" ;
                   // echo $sql;
  $result = mysql_query($sql);
  if(!$result) die("getconsumptiondets4grn failed..Please report to Sysadmin. " . mysql_error());
  return $result;
}

function getgrndets4upload($grnnum)
{
  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $sql="select g.invoice_num,g.invoice_date,gli.qty_to_make,
                      g.grnnum,g.recieved_date,g.cimponum,g.raw_mat_spec,c.name,g.raw_mat_type,g.crn,gli.qty,gli.dim1,gli.dim2,gli.dim3,g.grntype
               from grn g,grn_li gli,company c
                    where
                          g.grnnum='$grnnum' and
                          g.link2vendor=c.recnum and
                          gli.link2grn=g.recnum and
                          (gli.amendlinenum = ''  or gli.amendlinenum is null or gli.amendlinenum = 0 )" ;
                         // echo $sql;
  $result = mysql_query($sql);
  if(!$result) die("getgrndets4upload failed..Please report to Sysadmin. " . mysql_error());
  return $result;
}

 function getdispatcdets4grn($grnnum)
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql="select sum(dli.dispatch_qty) as dqty,d.relnotenum
                    from dispatch d,dispatch_line_items dli
                         where dli.grnnum='$grnnum' and dli.link2dispatch=d.recnum
                         and d.status !='Cancelled'
                         group by d.relnotenum
                         order by (d.relnotenum+0)";
                         //echo $sql;
       $result=mysql_query($sql);
       return $result;
     }              // g.invoice_num='0058280' and                                   g.grnnum='E02333' and

         function getallgrn4consupdate()
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select g.invoice_num,g.invoice_date,gli.qty_to_make,
                      g.grnnum,g.recieved_date,g.cimponum,g.raw_mat_spec,c.name,g.raw_mat_type,g.crn,
                      gli.qty,gli.dim1,gli.dim2,gli.dim3,g.grntype
                      from grn_li gli,grn g,company c
                           where gli.link2grn=g.recnum and
             	                 g.status = 'Cancelled' and
             	                 g.recieved_date  between '2010-01-01' and '2050-03-25' and
				                 g.link2vendor=c.recnum and
                                 g.grnnum !=' C00499' and
                                  g.grnnum='F01196' and
                                 (gli.amendlinenum = ''  or gli.amendlinenum is null or gli.amendlinenum = 0 )
                                  order by g.grnnum";
       // echo "$sql <br>";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("getallgrn4consupdate didn't work for consumption. " . mysql_error());
        return $result;

     }

     function updateconsumptionreg4spec($grnnum,$rmspec,$uom)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "update consumption set
                            description='$rmspec',
                            uom='$uom'
                            where grnnum = '$grnnum'";
               //echo $sql;
               $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
           {  //header("Location:errorMessage.php?validate=Inv2");
              die("updateconsumptionreg4spec for consumption update didn't work..Please report to Sysadmin. " . mysql_error());
           }
     }

        function getallrmdetails($crn)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select r.rm_dia,r.length ,r.width,r.thickness
                      from rmmaster r
                           where r.rm_status ='Active' and
                           r.rm_altrm='Primary Spec' and
                           r.crnnum='$crn'";
       // echo "$sql <br>";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("getallgrn4consupdate didn't work. " . mysql_error());
       return $result;

     }
   //((w.treatment = 'Manufacture Only' ||w.treatment = '' || w.treatment is null) and
					   //(wo_p.stage='FINAL' || wo_p.stage='FI' || wo_p.stage='final' || wo_p.stage='Fi')) ||
                      //(w.treatment = 'With Treatment' and (wo_p.stage='PostDN' || wo_p.stage='DN')))
    function getworej4consupdate($grnnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select sum(wo_p.rej) as reject,sum(wo_p.rework),sum(wo_p.hold)
                      from wo_part_status wo_p,work_order w
                      where
                      wo_p.link2wo=w.recnum and
                      w.grnnum='$grnnum' and
                      w.`condition` !='Cancelled' and
                      w.`condition` !='Hold' and
	                 (wo_p.stage='FINAL' || wo_p.stage='FI' || wo_p.stage='final' || wo_p.stage='Fi')";
      //  echo "Here:$sql";
        $result  = mysql_query($sql) or die('getworej4cofc query failed');
        return $result;
    }

     function updateconsumptionreg4rejqty($rej_qty,$grnnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $rej_qty=$rej_qty?$rej_qty:0.0;
        //echo $rej_qty."in class";
        $sql = "update consumption set
                            qty_rej =$rej_qty
                            where grnnum = '$grnnum'";
               //echo $sql."<br>";
               $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
           {  //header("Location:errorMessage.php?validate=Inv2");
              die("updateconsumptionreg4rejqty for consumption update didn't work..Please report to Sysadmin. " . mysql_error());
           }
     }


     function consumptionUpdate4restore($grnnum,$invoice_num,$invoice_date,$qtyrecd,$crn,$grndate,$rmspec,$company,$rmtype,$uom,$qty,$qty_rej,$bond_num,$bonddate,$be_num,$bedate,$assessval,$cifval,$dutyamt,$invamt,$invcurrency)
     {
        $sql = "select nxtnum from seqnum where tablename = 'consumption' for update";
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
        $crn = "'" . $crn . "'";
        $grnnum= "'" . $grnnum . "'";
        $description= "'" . $rmspec . "'";
        $qtyrecd= $qtyrecd?$qtyrecd:0.0;
        $grndate = $grndate?"'" . $grndate . "'":'0000-00-00';
        $invoice_num= "'" . $invoice_num . "'";
        $create_date = $create_date?"'" . $create_date . "'":'0000-00-00';
        $invoice_date = $invoice_date?"'" . $invoice_date . "'":'0000-00-00';
        $rmtype= "'" . $rmtype . "'";
        $company= "'" . $company . "'";
        $uom = "'" . $uom . "'";
        $qty= $qty?$qty:0.0;
        $qty_rej= $qty_rej?$qty_rej:0.0;
        $bonddate = $bonddate?"'" . $bonddate. "'":"'0000-00-00'";
        $bedate = $bedate?"'" . $bedate . "'":"'0000-00-00'";
        $assessval= $assessval?$assessval:0.0;
        $cifval= $cifval?$cifval:0.0;
        $dutyamt= $dutyamt?$dutyamt:0.0;
        $invamt= $invamt?$invamt:0.0;
        $bond_num= "'" . $bond_num . "'";
        $be_num = "'" . $be_num . "'";
        $invcur= "'" . $invcurrency . "'";
        //$qty_rew= $qty_rew?$qty_rew:0.0;
        //$wonum= "'" . $wonum . "'";
        $sql = "select * from consumption where grnnum = $grnnum";
       // echo $sql;
        $result = mysql_query($sql);

        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        consumption
                            (
                            recnum,
                            crn,
                            invoice_num,
                            grnnum,
                            grn_date,
                            description,
                            qty_recd,
                            create_date,
                            invoice_date,
                            rmtype,company,uom,qty,qty_rej,bonddate, bedate, assessval, cifval, dutyamt, invamt,
                            be_num,bond_num,currency
                            )
                           select
                            $objid,
                            g.crn,
                            g.invoice_num,
                            g.grnnum,
                            g.recieved_date,
                            $description,
                            $qtyrecd,
                            now(),
                            g.invoice_date,
                            g.raw_mat_type,c.name,$uom,$qty,$qty_rej,$bonddate,$bedate,$assessval,$cifval,
                            $dutyamt,$invamt,$be_num,$bond_num,$invcur
                            from grn_li gli,grn g,company c
                            where gli.link2grn=g.recnum and
							           g.link2vendor=c.recnum and
									   g.grnnum = $grnnum
				                 group by g.grnnum";
            // echo $sql."<br>";
             $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Insert to consumption didn't work..Please report to Sysadmin. " . mysql_error());
                        }

                         $sql = "update seqnum set nxtnum = $objid where tablename = 'consumption'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv4");
                     die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
                     }

         }
         else {
                      $sql = "update consumption set
                            crn =$crn,
                            invoice_num=$invoice_num,
                            grn_date=$grndate,
                            description=$description,
                            qty_recd=$qtyrecd,
                            create_date=now(),
                            modified_date=now(),
                            invoice_date=$invoice_date,
                            rmtype=$rmtype,
                            company=$company,
                            uom=$uom,
                            qty=$qty,
                            qty_rej=$qty_rej,
                            be_num=$be_num,
                            bedate=$bedate,
							assessval = $assessval,
							cifval = $cifval,
							dutyamt = $dutyamt,
							bond_num=$bond_num,
                            bonddate=$bonddate
                            where grnnum = $grnnum";
              // echo $sql;
               $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Update to Consumption for grn didn't work..Please report to Sysadmin. " . mysql_error());
                        }
              }


     }

     function consumptionUpdate4restoredispatch($grnnum,$invoice_num,$invoice_date,$qtyrecd,$crn,$grndate,$rmspec,$company,$rmtype,$uom,$qty,$qty_rej,$disp_recnum,$disp_qty,$bond_num,$bonddate,$be_num,$bedate,$assessval,$cifval,$dutyamt,$invamt,$invcurrency)
     {
        $sql = "select nxtnum from seqnum where tablename = 'consumption' for update";
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
        $crn = "'" . $crn . "'";
        $grnnum= "'" . $grnnum . "'";
        $description= "'" . $rmspec . "'";
        $qtyrecd= $qtyrecd?$qtyrecd:0.0;
        $grndate = $grndate?"'" . $grndate . "'":'0000-00-00';
        $invoice_num= "'" . $invoice_num . "'";
        $create_date = $create_date?"'" . $create_date . "'":'0000-00-00';
        $invoice_date = $invoice_date?"'" . $invoice_date . "'":'0000-00-00';
        $rmtype= "'" . $rmtype . "'";
        $company= "'" . $company . "'";
        $uom = "'" . $uom . "'";
        $qty= $qty?$qty:0.0;
        $qty_rej= $qty_rej?$qty_rej:0.0;
        $qtycons= $disp_qty?$disp_qty:0.0;
        $closingbal=$qtyrecd-$qtycons;
        $bonddate = $bonddate?"'" . $bonddate. "'":'0000-00-00';
        $bedate = $bedate?"'" . $bedate . "'":'0000-00-00';
        $assessval= $assessval?$assessval:0.0;
        $cifval= $cifval?$cifval:0.0;
        $dutyamt= $dutyamt?$dutyamt:0.0;
        $invamt= $invamt?$invamt:0.0;
        $bond_num= "'" . $bond_num . "'";
        $be_num = "'" . $be_num . "'";
        $invcur= "'" . $invcurrency . "'";
       //$wonum= "'" . $wonum . "'";
        //$qty_rew= $qty_rew?$qty_rew:0.0;

           $sql = "insert into consumption
                           (recnum,
                            crn,
                            invoice_num,
                            grnnum,
                            grn_date,
                            description,
                            qty_recd,
                            qty_cons,
                            create_date,
                             closingbal,
                            invoice_date,
                            cofc_num,company,rmtype,uom,qty,qty_rej,bonddate, bedate, assessval, cifval, dutyamt, invamt,
                            be_num,bond_num,currency)
                            values($objid,$crn,$invoice_num,$grnnum,$grndate,$description,$qtyrecd,
                            $qtycons,now(),$closingbal,$invoice_date,'$disp_recnum',$company,$rmtype,$uom,$qty,$qty_rej,
                            $bonddate,$bedate,$assessval,$cifval,$dutyamt,$invamt,$be_num,$bond_num,$invcur)";
            // echo $sql."<br>";
             $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Insert to consumption for consumption cofc update didn't work..Please report to Sysadmin. " . mysql_error());
                        }

                         $sql = "update seqnum set nxtnum = $objid where tablename = 'consumption'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv4");
                     die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
                     }

     }
     
     function getdispatch4update($grnnum)
     {

       $newlogin = new userlogin;
        $newlogin->dbconnect();
        $grn=trim($grnnum);
        $sql = "select dli.link2dispatch,sum(dli.dispatch_qty),d.relnotenum,d.expinvnum
		                      from dispatch_line_items dli, dispatch d
							  where dli.grnnum='$grn' and
							               d.recnum = dli.link2dispatch and
										   d.status != 'Cancelled'
                        group by dli.link2dispatch
                        order by d.relnotenum";
       //echo "$sql <br>";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("getdispatch4update didn't work for consumption. " . mysql_error());
       return $result;
     }

     function getbond4export($bondnum) {
         //echo $grnnum."*--*--*-";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
       $sql1 = "select
		                     invoice_num,
							 grnnum,
							 grn_date,
							 ponum,
							 description,
							 qty_recd,
							 qty_cons,
							 create_date,
							 modified_date,
							 crn,
							 status,
							 closingbal,
							 invoice_date,
							 cofc_num,
							 bond_num,
							 be_num,
							 grnwonum,
							 company,
							 rmtype,
							 uom,
							 bonddate,
							 bedate,
							 assessval,
							 cifval,
							 dutyamt,
							 invamt,qty,recnum,currency,qty_rej
		                     from consumption g
						where bond_num = '$bondnum' and (parentgrnnum ='' or parentgrnnum is null)
						group by bond_num,be_num,grnnum
						order by bond_num,be_num,invoice_num,grnnum
                       ";
        //echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getbond4edit failed..Please report to Sysadmin. " . mysql_error());
        return $result1;
      }
      //and g.recieved_date >'2011-10-30'
   	  function getdiscrepancydets($cond,$offset,$rowsPerPage) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "select g.grnnum,g.recieved_date,g.invoice_num,g.invoice_date,g.raw_mat_type,g.raw_mat_spec,gli.uom,
                        sum(gli.qty_to_make) as qtm,g.crn
                        from grn_li gli,grn g
                             left join consumption c on c.grnnum=g.grnnum
                             where c.grnnum is null and
                                   gli.link2grn=g.recnum and
                                   $cond and g.status !='Cancelled'and
                                  (gli.amendlinenum = ''  or gli.amendlinenum is null or gli.amendlinenum = 0 )
                                   group by g.grnnum
                                   order by g.grnnum
                                   limit $offset,$rowsPerPage";
       // echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getdiscrepancydets failed..Please report to Sysadmin. " . mysql_error());
        return $result1;
      }

        function getdiscrepancy4count($cond,$offset,$rowsPerPage)
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "select count(*) as numrows
                       from grn_li gli,grn g left join consumption c on c.grnnum=g.grnnum
                             where c.grnnum is null and
                                   gli.link2grn=g.recnum and
                                   $cond and g.status !='Cancelled' and
                                  (gli.amendlinenum = ''  or gli.amendlinenum is null or gli.amendlinenum = 0 )
                                   group by g.grnnum

                     ";
       // echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getgrndets4count failed..Please report to Sysadmin. " . mysql_error());
        //$row     = mysql_fetch_array($result1, MYSQL_ASSOC);
         //$numrows = $row['numrows'];
         //echo $numrows;
         return $result1;
      }

   	  function getdiscrepancycofcdets($cond,$offset,$rowsPerPage)
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "select d.relnotenum,d.disp_date,sum(dli.dispatch_qty) as dqty ,d.crn ,dli.grnnum
                        from dispatch d
                             left join consumption c on c.cofc_num=d.relnotenum
                             left join dispatch_line_items dli on dli.link2dispatch=d.recnum
                             where c.cofc_num is null  and dli.grnnum !='-' and dli.grnnum !=''
                             and dli.grnnum is not null and d.status !='Cancelled' and $cond
                                   group by d.relnotenum
                                   order by d.relnotenum
                                   limit $offset,$rowsPerPage";
        //echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getdiscrepancycofcdets failed..Please report to Sysadmin. " . mysql_error());
        return $result1;
    }

        function getdiscrepancycofc4count($cond,$offset,$rowsPerPage)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "select count(*) as numrows
                       from dispatch d
                       left join consumption c on c.cofc_num=d.relnotenum
                              left join dispatch_line_items dli on dli.link2dispatch=d.recnum
                             where c.cofc_num is null  and dli.grnnum !='-' and dli.grnnum !=''
                             and dli.grnnum is not null and d.status !='Cancelled' and $cond
                                   group by d.relnotenum";
       // echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getgrndets4count failed..Please report to Sysadmin. " . mysql_error());
        return $result1;
   }

      function getdets4datadiscrepancy($grnnum)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "select g.invoice_num,g.invoice_date,gli.qty_to_make,
                        g.grnnum,g.recieved_date,g.cimponum,g.raw_mat_spec,'',g.raw_mat_type,g.crn,gli.qty,gli.dim1,
                        gli.dim2,gli.dim3,g.grntype,g.status
                        from grn_li gli,grn g
                             where
                                   gli.link2grn=g.recnum and
                                   g.grnnum='$grnnum' and g.status !='Cancelled'and
                                  (gli.amendlinenum = ''  or gli.amendlinenum is null or gli.amendlinenum = 0 )";
       // echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getdets4datadiscrepancy failed..Please report to Sysadmin. " . mysql_error());
        return $result1;
   }

    function getcons4discrepancy($cond,$offset,$rowsPerPage) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "select
		                     invoice_num,
							 grnnum,
							 grn_date,
							 ponum,
							 description,
							 qty_recd,
							 qty_cons,
							 create_date,
							 modified_date,
							 crn,
							 status,
							 closingbal,
							 invoice_date,
							 cofc_num,
							 bond_num,
							 be_num,
							 grnwonum,
							 company,
							 rmtype,
							 uom,
							 bonddate,
							 bedate,
							 assessval,
							 cifval,
							 dutyamt,
							 invamt,recnum,qty,currency,qty_rej
		                     from consumption g
		                     where $cond
		                     group by grnnum
		                     order by grnnum
		                     limit $offset,$rowsPerPage";
//echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getgrndets4discrepancy--- failed..Please report to Sysadmin. " . mysql_error());
        return $result1;
      }
      
       function getcons4grncofc() {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "select
							 g.grnnum,
             				 g.qty_recd,
							 g.qty_cons,
							 g.crn,
							 g.cofc_num
		                     from consumption g
		                     order by grnnum,crn,cofc_num";
//echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getgrndets4discrepancy--- failed..Please report to Sysadmin. " . mysql_error());
        return $result1;
      }

       function getgrndets4countdisc($cond,$offset,$rowsPerPage) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "select count(*) as numrows
                       from consumption
                       where
                     $cond
                     group by grnnum
                     ";
       // echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getgrndets4count failed..Please report to Sysadmin. " . mysql_error());
       // $row     = mysql_fetch_array($result1, MYSQL_ASSOC);
       // $numrows = $row['numrows'];
        // echo $numrows;
         return $result1;
      }


    function getdiscrepancycofcdets4data()
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "select d.relnotenum,d.disp_date,sum(dli.dispatch_qty) as dqty,d.crn ,dli.grnnum
                        from dispatch d,dispatch_line_items dli
                                   left join grn g on dli.grnnum=g.grnnum
                                   where d.status !='Cancelled' and dli.link2dispatch=d.recnum  and
                                   g.recieved_date between '2010-01-01' and '2012-08-30'
                                   group by d.relnotenum
                                   order by dli.grnnum,d.crn,d.relnotenum";
        //echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getdiscrepancycofcdets failed..Please report to Sysadmin. " . mysql_error());
        return $result1;
    }
    



    function getwodets4mcons($grnnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select recnum as rec, wonum as wonum
	                         from consumption
	                           where 	grnnum = '$grnnum' order by wonum";
       // echo "Here:$sql";
        $result  = mysql_query($sql) or die('getgrnmwodet4cons query failed');
        //$row     = mysql_fetch_array($result, MYSQL_ASSOC);
        //$rec = $row['rec'];

       return $result;
    }

      function getwonuminfo($grnnum,$wonum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select recnum as rec, wonum as cofcnum
	                         from consumption
	                           where 	grnnum = '$grnnum' and
                                        wonum='$wonum'";
        //echo "Here:$sql";
        $result  = mysql_query($sql) or die('getcofcnuminfo query failed');
        //$row     = mysql_fetch_array($result, MYSQL_ASSOC);
        //$rec = $row['rec'];

       return $result;
    }

     function updatewoconsumption($wonum,$recnum)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $closingbal=$qty_recd-$qty_total;
        $qty_total=$qty_total?$qty_total:0.0;
       // $qty_rej=$qty_rej?$qty_rej:0.0;
        $sql = "update consumption set
                            wonum='$wonum',
                            modified_date=now()
                            where recnum=$recnum
                            ";
                         // echo $sql;
               $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Update to consumption for consumption(WO) didn't work..Please report to Sysadmin. " . mysql_error());
                        }
   }
   
   function getcons4discrepancy4cofc($cond,$offset,$rowsPerPage) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "select
		                     invoice_num,
							 grnnum,
							 grn_date,
							 ponum,
							 description,
							 qty_recd,
							 qty_cons,
							 create_date,
							 modified_date,
							 crn,
							 status,
							 closingbal,
							 invoice_date,
							 cofc_num,
							 bond_num,
							 be_num,
							 grnwonum,
							 company,
							 rmtype,
							 uom,
							 bonddate,
							 bedate,
							 assessval,
							 cifval,
							 dutyamt,
							 invamt,recnum,qty,currency,qty_rej
		                     from consumption g
		                     where $cond
		                     order by grnnum,crn,cofc_num
		                     limit $offset,$rowsPerPage";
//echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getgrndets4discrepancy--- failed..Please report to Sysadmin. " . mysql_error());
        return $result1;
      }

function getcofc4countdisc($cond,$offset,$rowsPerPage) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "select count(*) as numrows
                       from consumption
                       where
                     $cond
                     ";
        //echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getgrndets4count failed..Please report to Sysadmin. " . mysql_error());
        $row     = mysql_fetch_array($result1, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        // echo $numrows;
         return $numrows;
      }

function deletefromconsumption($dispnum,$grnnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "delete from consumption where cofc_num='$dispnum' and grnnum='$grnnum'";
       // echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("deletefromconsumption failed..Please report to Sysadmin. " . mysql_error());

      }

function getdispatch4assyupdate() {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "select d.recnum,dli.wonum,sum(dli.dispatch_qty),d.expinvnum,d.type
                        from dispatch d,dispatch_line_items dli
                             where dli.link2dispatch=d.recnum
                                   and (d.type='Assembly' || d.type='Kit')
                                   group by dli.recnum order by dli.wonum";
       // echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getdispatch4assyupdate for consumption failed..Please report to Sysadmin. " . mysql_error());
        return $result1;
      }
      
      function getwo4assyliwo($assywonum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "select ali.grn,ali.bom_type,ali.qty,ali.crn_num4li
                        from assywo_li ali,assy_wo a
                             where ali.link2assywo=a.recnum and a.assy_wonum='$assywonum'";
        echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getwo4assyliwo for consumption failed..Please report to Sysadmin. " . mysql_error());
        return $result1;
      }
      
      function getgrn4wo($wonum)
      {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql1 = "select w.grnnum,w.wonum
                        from work_order w
                             where w.wonum='$wonum' and
                                   w.`condition` !='Cancelled' and  w.`condition` !='Hold'";
       // echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getgrn4wo for consumption failed..Please report to Sysadmin. " . mysql_error());
        return $result1;
      }
      //

     function getallgrn4assyconsupdate($grnnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select g.invoice_num,g.invoice_date,gli.qty_to_make,
                      g.grnnum,g.recieved_date,g.cimponum,g.raw_mat_spec,c.name,g.raw_mat_type,g.crn,gli.qty,gli.dim1,gli.dim2,gli.dim3,g.grntype
                      from grn_li gli,grn g,company c
                           where gli.link2grn=g.recnum and
             	                 g.status != 'Cancelled' and
                                 g.recieved_date  between '2010-01-01' and '2050-12-30' and
				                 g.link2vendor=c.recnum and
                                 g.grnnum !=' C00499' and
                                (gli.amendlinenum = ''  or gli.amendlinenum is null or gli.amendlinenum = 0 ) and g.grnnum='$grnnum'
                                  order by g.grnnum";
        //echo "$sql <br>";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("getallgrn4assyconsupdate didn't work for consumption. " . mysql_error());
        return $result;

     }
     
 function getdispatchassy4update($assywonum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $grn=trim($grnnum);
        $sql = "select dli.link2dispatch,sum(dli.dispatch_qty),d.relnotenum,d.expinvnum
		                      from dispatch_line_items dli, dispatch d
							  where dli.wonum='$assywonum' and
							               d.recnum = dli.link2dispatch and
										   d.status != 'Cancelled'
                        group by dli.link2dispatch";
       // echo "$sql <br>";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("getdispatch4update didn't work for consumption. " . mysql_error());
        return $result;
     }
     
     function deletegrns4consumption($grnnum)
     {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $grn=trim($grnnum);
        $sql = "delete from consumption where grnnum='$grnnum' ";
       // echo "$sql <br>";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("getdispatch4update didn't work for consumption. " . mysql_error());
       return $result;
     }
/*


*/
      function getallgrns4parentgrn()
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $grn=trim($grnnum);
        $sql = "select g.grnnum,g.parentgrnnum
                      from grn g
                           where
             	                 g.status != 'Cancelled' and
             	                 g.recieved_date  between '2010-01-01' and '2020-08-30' and
                                 g.grnnum !=' C00499' and
                                 (g.parentgrnnum !='' and g.parentgrnnum is not null)
                                  order by g.grnnum";
       //echo "$sql <br>";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("getdispatch4update didn't work for consumption. " . mysql_error());
        return $result;
     }
     
       function updateconsumption4parentgrn($grnnum,$pgrnnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $grn=trim($grnnum);
        $sql = "update consumption set
                            modified_date=now(),
                            parentgrnnum=''
                            where grnnum='$grnnum'";
       // echo "$sql <br>";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("updateconsumption4parentgrn didn't work for consumption. " . mysql_error());
        return $result;
     }
     
      function getdispqty4wo($wonum,$cofcnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select sum(dli.dispatch_qty) as qty
                      from dispatch_line_items dli,dispatch d
	                           where dli.wonum = '$wonum' and
                                     d.relnotenum='$cofcnum' and
                                     dli.link2dispatch=d.recnum";
        //echo "Here:$sql";
        $result  = mysql_query($sql) or die('getgrnmcofcdet4cons query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $qty = $row['qty'];
        return $qty;
    }

  function update_expinvnum($cofcnum,$expinvnum)
  {
    $newlogin = new userlogin;
        $newlogin->dbconnect();
        $grn=trim($grnnum);
        $sql = "update consumption set
                            modified_date=now(),
                            expinvnum='$expinvnum'
                            where cofc_num='$cofcnum'";
        echo "$sql <br>";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("update_expinvnum didn't work for consumption. " . mysql_error());
  }
  
    function getdupgrns()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select cofc_num,grnnum,count(recnum) as cnt
                      from consumption
                           group by grnnum,cofc_num
                           having cnt >1;";
        //echo "Here:$sql";
        $result  = mysql_query($sql) or die('getdupgrns query failed');
        return $result;
    }
    
    function getgrn4conspgrn()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select c.grnnum,c.parentgrnnum
                     from consumption c,grn g,grn_li gli where gli.link2grn=g.recnum
                     and  (gli.noofpieces is null || gli.noofpieces =''|| gli.noofpieces =0)
                     and c.grnnum=g.grnnum and c.parentgrnnum !='' and c.parentgrnnum is not null";
        //echo "Here:$sql";
        $result  = mysql_query($sql) or die('getdupgrns query failed');
        return $result;
    }
     
    function getbondsummary4export()
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
       $sql1 = "select distinct
							 bond_num,
							 bonddate,
                             status
							 from consumption
						where (status like '%' or status is null or status = '')
						order by bond_num, bonddate
                       ";
        //echo "$sql1<br>";
        $result1 = mysql_query($sql1);
        if(!$result1) die("getbond4edit failed..Please report to Sysadmin. " . mysql_error());
        return $result1;
	}
}
?>
