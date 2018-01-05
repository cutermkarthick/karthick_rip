<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: dispatchClass.php
// Application: WMS
// Revision: v1.0
//====================================

include_once('loginClass.php');

class dispatch {

    var $relnotenum,
        $disp_date,
        $disp_desc,
        $disp2cust,
        $via,
        $refno,
        $crn,
        $remarks,
        $status,
        $create_date,
        $mod_date,
        $delivery,
        $invoice,
        $schdate,
        $schqty,
		   $type,
	   	$expinvnum;


    // Constructor definition
    function dispatch() 
	{
        $this->relnotenum = '';
        $this->disp_date = '';
        $this->disp2cust = '';
        $this->disp_desc = '';
        $this->via = '';
        $this->refno = '';
        $this->crn = '';
        $this->remarks = '';
        $this->status = '';
        $this->create_date = '';
        $this->delivery = '';
        $this->invoice = '';
        $this->schdate = '';
        $this->schqty = '';
		$this->type = '';
		$this->expinvnum='';
	}

    // Property get and set
    function getrelnotenum() {
           return $this->relnotenum;
    }

    function setrel_note ($rel_note) {
           $this->relnotenum= $rel_note;
    }
    function getdisp_date() {
           return $this->disp_date;
    }

    function setdisp_date ($disp_date) {
           $this->disp_date = $disp_date;
    }
    function getdisp2cust() {
           return $this->disp2cust;
    }

    function setdisp2cust ($disp2cust) {
           $this->disp2cust = $disp2cust;
    }
    function getdispdesc() {
           return $this->disp_desc;
    }

    function setdispdesc ($dispdesc) {
           $this->disp_desc = $dispdesc;
    }

    function getvia() {
           return $this->via;
    }
    function setvia($via) {
           $this->via = $via;
    }
    function getrefno() {
           return $this->refno;
    }
    function setrefno ($refno) {
           $this->refno = $refno;
    }
    function getcrn() {
           return $this->crn;
    }
    function setcrn ($crn) {
           $this->crn = $crn;
    }
    function getremarks() {
           return $this->remarks;
    }
    function setremarks ($remarks) {
           $this->remarks = $remarks;
    }
    function getstatus() {
           return $this->status;
    }
    function setstatus ($status) {
           $this->status = $status;
    }
    function getcreate_date() {
           return $this->create_date;
    }

    function setcreate_date ($create_date) {
           $this->create_date = $create_date;
    }
    function getmod_date() {
           return $this->mod_date;
    }

    function setmod_date ($mod_date) {
           $this->mod_date = $mod_date;
    }
    function setdelivery ($del) {
           $this->delivery = $del;
    }
    function setinvoice ($invoice) {
           $this->invoice = $invoice;
    }
    function setschdate ($schdate) {
           $this->schdate = $schdate;
    }
    function setschqty ($schqty) {
           $this->schqty = $schqty;
    }
	function gettype() {
           return $this->type;
    }
    function settype ($type) {
           $this->type= $type;
    }
    function setexpinvnum ($expinvnum) {
           $this->expinvnum= $expinvnum;
    }
   
function addDispatch() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'dispatch' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $c = "C";
        $relnotenum=$c.$objid;
        $disp_date="'" . $this->disp_date . "'" ;
        $disp_desc="'" . $this->disp_desc . "'";
        $disp2cust="'" . $this->disp2cust . "'";
        $via="'" . $this->via . "'";
        $refno="'" . $this->refno . "'";
        $crn="'" . $this->crn . "'";
        $remarks = "'" . $this->remarks . "'";
        //$dispstatus=$this->dispstatus;
        $create_date="'" . $this->create_date . "'";
        $mod_date="'" . $this->mod_date . "'";
        $delivery_to="'" . $this->delivery . "'";
        $invoice_to="'" . $this->invoice . "'";
        $schdate="'" . $this->schdate . "'"?"'" . $this->schdate . "'":"0000-00-00";
        $schqty="'" . $this->schqty . "'";
		$type="'" . $this->type . "'";
        $expinvnum="'". $this->expinvnum ."'";
		$userid = "'".$_SESSION['user']."'";
    $siteid = "'".$_SESSION['siteid']."'";

        $sql = "select * from dispatch where relnotenum = '".$relnotenum."'";
        $result = mysql_query($sql);
        //echo $sql;
        if (!(mysql_fetch_row($result))) {
        $sql = "INSERT INTO dispatch (recnum,
                                relnotenum,
                                disp_date,
                                disp_desc,
                                disp2customer,
                                via,
                                refno,
                                crn,
                                remarks,
                                status,
                                create_date,
                                modified_date,
                                deliver_to,
                                invoice_to,
                                schdate,
                                schqty,
                                formatnum,
                                formatrev,
								type,
								expinvnum,
								created_by,
                siteid)
                        VALUES ($objid,
                                '$relnotenum',
                                $disp_date,
                                $disp_desc,
                                $disp2cust,
                                $via,
                                $refno,
                                $crn,
                                $remarks,
                                'Open',
                                curdate(),
                                curdate(),
                                $delivery_to,
                                $invoice_to,
                                $schdate,
                                $schqty,
                                'F4200',
                                'Rev 3 dt Aug 16, 2013: Email and CRN # modifications',
								$type,
								$expinvnum,
								$userid,
                $siteid)";
         // echo "$sql";
          $result = mysql_query($sql);
          // Test to make sure query worked
          if(!$result) die("Insert to Dispatch didn't work..Please report to Sysadmin. " . mysql_error());

          }
          else {
                echo "<table border=1><tr><td><font color=#FF0000>";
               die("Release Note ID " . $relnotenum . " already exists. ");
               echo "</td></tr></table>";
          }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'dispatch'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work for Dispatch..Please report to Sysadmin. " . mysql_error());
        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for Dispatch Insert..Please report to Sysadmin. " . mysql_error());
        return $objid;
     }
   function updateDispatch($disprecnum) 
   {   
         //echo 'in updateclass';
        //$porecnum = "'" . $inpporecnum . "'";
        $dispatchrecnum = "'" . $disprecnum . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $relnotenum = "'" . $this->relnotenum . "'";
        $disp_date = "'" . $this->disp_date . "'";
        $disp_desc = "'" . $this->disp_desc . "'";
        $disp2cust = "'" . $this->disp2cust . "'";
        $via = "'" . $this->via . "'";
        $refno = "'" . $this->refno . "'";
        $crn = "'" . $this->crn . "'";
        $remarks = "'" . $this->remarks . "'";
        $status = "'" . $this->status . "'";
        $create_date = "'" . $this->create_date . "'";
        $mod_date = "'" . $this->mod_date . "'";
        $delivery_to = "'" . $this->delivery . "'";
        $invoice_to = "'" . $this->invoice . "'";
        $schdate="'" . $this->schdate . "'";
        $schqty="'" . $this->schqty . "'";
		$type="'" . $this->type . "'";
        $expinvnum="'". $this->expinvnum ."'";
		$userid = "'".$_SESSION['user']."'";
        
        $sql = "update dispatch set relnotenum = $relnotenum,
                              disp_date = $disp_date,
                              disp_desc = $disp_desc,
                              disp2customer = $disp2cust,
                              via = $via,
                              refno = $refno,
                              crn = $crn,
                              remarks = $remarks,
                              status = $status,
                              modified_date= curdate(),
                              deliver_to = $delivery_to,
                              invoice_to = $invoice_to,
                              schdate = $schdate,
                              schqty = $schqty,
							  type = $type,
							  formatnum = 'F4200',
                              formatrev = 'Rev 2 dt Jun 29, 2012: Upg Cert from B to C',
                              expinvnum=$expinvnum,
							  modified_by=$userid
                        where recnum = $dispatchrecnum ";
           // echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to Dispatch didn't work..Please report to Sysadmin. " . mysql_error());

     }
     
     function getdispatchDetails($disprecnum) 
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select d.recnum,d.relnotenum,d.disp_date,
                       d.disp_desc,
                       c.name,d.via,d.refno,
                       d.create_date, d.modified_date,
                       d.disp2customer,
                       d.crn,
                       c.addr1, c.addr2,
                       c.city, c.state, c.zipcode,
                       c.country, c.phone,
                       d.remarks,
                       d.status,
                       d.deliver_to,
                       d.invoice_to,
                       c.baddr1,
                       c.baddr2,
                       c.bcity,
                       c.bstate,
                       c.bzipcode,
                       c.bcountry,
                       c.saddr1,
                       c.saddr2,
                       c.scity,
                       c.sstate,
                       c.szipcode,
                       c.scountry,
                       d.schdate,
                       (de.schedule_qty-de.disp_qty),
					   d.type,
					   d.formatnum,
					   d.formatrev,d.expinvnum,
					   de.schedule_qty
                 from  company c,dispatch d
				 left join delivery_sch de on de.crnnum=d.crn and de.schedule_date=d.schdate
                 where d.recnum = $disprecnum and
                       c.recnum = d.disp2customer";
         // echo '+++++++++++++++++'.$sql;  
        $result = mysql_query($sql);
        if(!$result) die("........Access to Dispatch....... failed...Please report to SysAdmin. " . mysql_error());
        return $result;
     }
    function getdispatch($cond,$argoffset,$sort1,$arglimit)
	{
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $offset= $argoffset;
         $limit= $arglimit;
         $wcond = $cond;
         $siteid = $_SESSION['siteid'];
         $usertype = $_SESSION['usertype'];
         $userid="'". $_SESSION['user']."'";
         $siteval = "d.siteid = '".$siteid."'";
if($usertype == 'EMPL')
{
         $sql = "select d.recnum,
                        d.relnotenum,
                        d.disp_date,
                        c.name,
                        dl.wonum,
                        dl.dispatch_qty,
                        d.status,
			            d.crn,
                        d.type,
						dl.partnum,
						dl.partname
                  FROM dispatch d, dispatch_line_items dl, company c
                  where $wcond and
                        d.recnum = dl.link2dispatch and
                        c.recnum = d.disp2customer and $siteval
                  order by d.recnum limit $offset, $limit";

 }else
 {
      $sql ="select d.recnum, 
                    d.relnotenum,
                   d.disp_date,
                   c.name,
                   dl.wonum,
                   dl.dispatch_qty,
                   d.status,
                   d.crn,
                   d.type,
                   dl.partnum
            FROM dispatch d,
                 dispatch_line_items dl, 
                 company c,
                 user u ,
                 contact cont
           where $wcond and 
                 d.recnum = dl.link2dispatch and
                  c.recnum = d.disp2customer and 
                  cont.recnum = u.user2contact and 
                  cont.contact2company = c.recnum and 
                  u.userid = $userid order by d.recnum limit $offset, $limit";


  // echo "$sql";

 }     
        $result = mysql_query($sql);
        if(!$result) die("getdispatch query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }

     function getdispatchCount($cond,$argoffset,$arglimit)
       {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $siteid = $_SESSION['siteid'];
         $siteval = "d.siteid = '".$siteid."'";
        $sql = "select count(d.recnum) as numrows
                  FROM dispatch d,dispatch_line_items dl
                  where $wcond and 
                  d.recnum = dl.link2dispatch and $siteval limit $offset, $limit";
       $newlogin = new userlogin;
       $newlogin->dbconnect();
      //echo $sql;
        $result  = mysql_query($sql) or die('dispatch count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
       return $numrows;
       }

//Added New Function	


function getdispatch4export($cond)
	{
         $newlogin = new userlogin;
         $newlogin->dbconnect();
      
         $sql = "select 
                        d.relnotenum,
						d.crn,
                        d.disp_date,
						dl.wonum,
						dl.custpo_num,
						sum(dl.dispatch_qty),
						dl.grnnum,
                        c.name,
                        d.type
                  FROM dispatch d, dispatch_line_items dl, company c
                  where $cond and
                        d.recnum = dl.link2dispatch and
                        c.recnum = d.disp2customer
				  group by d.relnotenum
				  order by d.relnotenum";

        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getdispatch4export query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }  
function getwotreatment($prn)
  {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
      
         $sql = "select recnum,wonum,crn_num,treatment                       
                 FROM work_order
                  where crn_num = '$prn'";

        echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getdispatch4export query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }  



   function getallcofc($crn_num,$type)
  {
          $newlogin = new userlogin;
          $newlogin->dbconnect();
      
     if ($type == "Treated")
      {
         $type = "'Post Process'" ."," . "'ManufactureforAssembly'";
         $cond ="(d.type IN(" . $type ."))" ;
      }
     
     else if ($type == 'Untreated')
     {
         $type = "ManufactureOnly";
         $cond ="d.type = '$type'" ;
    }
     
     else if ($type == 'Assembly')
     {
          $type = "Assembly";
          $cond ="d.type = '$type'" ;
      }

          $sql = "select d.cofcnum,
                  d.crnnum,
                d.cofcdate,
                d.company,
                d.ponum,
                d.grnnum,
                d.wonum,
                d.dispatchqty
                from dispatch d
                where 
                $cond and
                d.crnnum='$crn_num' and
                d.cofcnum not in 
                (select cofc_num from cust_invoice_line_items)";
echo $sql;
        $result = mysql_query($sql)  or die('getallcofc  query failed');
        return $result;


  }

	 
 } //end of class defination