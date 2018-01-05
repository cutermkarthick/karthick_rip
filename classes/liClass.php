<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: liClass.php
// Maintains the class for PO Line items
// Revision: v1.0
//====================================

include_once('loginClass.php');  

class po_line_items { 

    var    
     $linenum,
     $itemname,
     $itemdesc,
     $qty,
     $material_ref,
     $duedate,
     $accepteddate,
     $delvby,
     $rate,
     $amount,
     $link2po,
     $material_spec,
     $thick,
     $width,
     $length,
     $qty_per_meter,
     $no_of_meterages,
     $no_of_lengths,
     $uom,
     $grainflow,
     $ponum,
     $vendor,
     $condition,
     $crn,
     $maxruling,
     $qty_rej,
     $delivery,
     $order_qty,
     $alt_spec,
     $spec_type,
     $layoutrefnum,$status,$qty_recd,$accepted_date,$remarks,$grn_num,$due_date1,$due_date2;
        
    // Constructor definition 
    function li() { 
        $this->linenum = ''; 
        $this->itemname = ''; 
        $this->itemdesc = ''; 
        $this->qty = ''; 
        $this->material_ref = '';
        $this->duedate = ''; 
        $this->accepteddate = ''; 
        $this->delvby = '';
        $this->rate = '';
        $this->amount = '';
        $this->link2po = '';
        $this->material_spec = '';
        $this->thick = '';
        $this->width = '';
        $this->length = '';
        $this->qty_per_meter = '';
        $this->no_of_meterages = '';
        $this->ponum = '';
        $this->vendor = '';
        $this->no_of_lengths = '';
        $this->uom = '';
        $this->grainflow = '';
        $this->condition = '';
        $this->crn = '';
        $this->maxruling = '';
        $this->delivery = '';
        $this->qty_rej = '';
        $this->order_qty = '';
        $this->alt_spec = '';
        $this->spec_type = '';
        $this->layoutrefnum = '';
        $this->status = '';
        $this->qty_recd = '';
        $this->accepted_date = '';
        $this->remarks = '';
        $this->grn_num ='';
        $this->due_date1 ='';
        $this->due_date2 ='';
     } 
     
    // Property get and set
    function getlinenum() {
           return $this->linenum;
    }

    function setlinenum ($reqlinenum) {

           $this->linenum = $reqlinenum;
    }

    function getitemname() {
           return $this->itemname;
    }

    function setitemname ($reqitemname) {
           $this->itemname = $reqitemname;
    }

    function getitemdesc() {
           return $this->itemdesc;
    }
    function setitemdesc ($reqitemdesc) {
           $this->itemdesc = $reqitemdesc;
    }

    function getqty() {
           return $this->qty;
    }

    function setqty ($reqqty) {
           $this->qty = $reqqty;
    }

    function getmaterial_ref() {
           return $this->material_ref;
    }

    function setmaterial_ref ($reqmaterial_ref) {
           $this->material_ref = $reqmaterial_ref;
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

    function getduedate() {
           return $this->duedate;
    }

    function setduedate ($reqduedate) {
           $this->duedate = $reqduedate;
    }
    function setaccepteddate ($reqaccepteddate) {
           $this->accepteddate = $reqaccepteddate;
    }
    function getdelvby() {
           return $this->delvby;
    }

    function setdelvby ($reqdelvby) {
           $this->delvby = $reqdelvby;
    }
    function getlink2po() {
           return $this->link2po;
    }

    function setlink2po ($reqlink2po) {
           $this->link2po = $reqlink2po;
    }
    
    function getmaterial_spec() {
           return $this->material_spec;
    }

    function setmaterial_spec ($material_spec) {
           $this->material_spec = $material_spec;
    }
    function getthick() {
           return $this->thick;
    }

    function setthick ($thick) {
           $this->thick = $thick;
    }

    function getwidth() {
           return $this->width;
    }

    function setwidth ($width) {
           $this->width = $width;
    }
    function getlength() {
           return $this->length;
    }

    function setlength ($length) {
           $this->length = $length;
    }
    
    function getqty_per_meter() {
           return $this->qty_per_meter;
    }

    function setqty_per_meter ($qty_per_meter) {
           $this->qty_per_meter = $qty_per_meter;
    }
    function getno_of_meterages() {
           return $this->no_of_meterages;
    }

    function setno_of_meterages ($no_of_meterages) {
           $this->no_of_meterages = $no_of_meterages;
    }
    
    function getponum() {
           return $this->ponum;
    }

    function setponum ($reqponum) {
           $this->ponum = $reqponum;
    }
    
    function getvendor() {
           return $this->vendor;
    }

    function setvendor ($reqvendor) {
           $this->vendor = $reqvendor;
    }
    function setno_of_lengths ($no_of_lengths) {
           $this->no_of_lengths = $no_of_lengths;
    }
    function setuom ($uom) {
           $this->uom = $uom;
    }
    function setgrainflow ($grainflow) {
           $this->grainflow = $grainflow;
    }
    function setcondition ($cond) {
           $this->condition = $cond;
    }
     function getcondition() {
           return $this->condition;
    }
    
    function setcrn ($crn) {
           $this->crn = $crn;
    }
     function getcrn() {
           return $this->crn;
    }
    function setmaxruling($max) {
           $this->maxruling = $max;
    }
     function getmaxruling() {
           return $this->maxruling;
    }
    function setqtyrej($rej) {
           $this->qty_rej = $rej;
    }
     function getqtyrej() {
           return $this->qty_rej;
    }
    function setdelivery($del) {
           $this->delivery = $del;
    }
     function getdelivery() {
           return $this->delivery;
    }
    
     function setorder_qty($order_qty) {
           $this->order_qty = $order_qty;
    }
     function getorder_qty() {
           return $this->order_qty;
    }
    

     function getalt_spec() {
           return $this->alt_spec;
    }
    function setalt_spec($alt_spec) {
           $this->alt_spec = $alt_spec;
    }
    
     function getspec_type() {
           return $this->spec_type;
    }
    function setspec_type($spec_type) {
           $this->spec_type = $spec_type;
    }
    function setlayoutrefnum($layoutrefnum) {
           $this->layoutrefnum = $layoutrefnum;
    }
    function setstatus($status) {
           $this->status = $status;
    }
     function setqty_recd($qty_recd) {
           $this->qty_recd = $qty_recd;
    }
     function setaccepted_date($accepted_date) {
           $this->accepted_date = $accepted_date;
    }
      function setremarks($remarks) {
           $this->remarks = $remarks;
    }
    function setgrn_num($grn_num) {
           $this->grn_num = $grn_num;
    }
    
    function setdue_date1($due_date1) {
           $this->due_date1 = $due_date1;
    }
    
    function setdue_date2($due_date2) {
           $this->due_date2 = $due_date2;
    }

     function setcim_due1 ($cim_due1) {

           $this->cim_due1 = $cim_due1;
    }
      function setcim_due2 ($cim_due2) {

           $this->cim_due2 = $cim_due2;
    }


    function addLi() { 
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'po_line_items' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for LI..Please report to Sysadmin. " . mysql_error()); 
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crdate = "'" . date("y-m-d") . "'";
        $line_num = "'" . $this->linenum . "'";
        $item_name = "'" . $this->itemname . "'";
        $item_desc = "'" . $this->itemdesc . "'";

        if($this->qty != '' && $this->qty != 'NULL')
        {
          $qty = "'" . $this->qty . "'";
        }
        else
        {
          $qty = 'NULL';
        }

        $material_ref = "'" . $this->material_ref . "'";
        $duedate = $this->duedate ? $this->duedate : "0000-00-00";
        //$duedate = $this->duedate ?  "'" . $this->duedate . "'"   : "0000-00-00";
        $rate = "'" . $this->rate . "'";
        $amount = $this->amount;
        $link2po = $this->link2po;
        $delvby = "'" . $this->delvby . "'";
	    $thick = "'" . $this->thick . "'";
	    $width = "'" . $this->width . "'";
	    $length = "'" . $this->length . "'";
        $material_spec = "'" . $this->material_spec . "'";
        $uom = "'" . $this->uom . "'";
        $no_of_lengths = $this->no_of_lengths ? $this->no_of_lengths : 0;
        $no_of_meterages = $this->no_of_meterages ? $this->no_of_meterages : 0;
        $grainflow = "'" . $this->grainflow . "'";
        $status = "'" . $this->status . "'";
        $due_date1 = $this->due_date1 ?  "'" . $this->due_date1 . "'"   : "0000-00-00";
        $due_date2 = $this->due_date2 ?  "'" . $this->due_date2 . "'"   : "0000-00-00";
        if($this->qty_per_meter != '' && $this->qty_per_meter != 'NULL')
        {
          $qty_per_meter = $this->qty_per_meter;
        }
        else
        {
          $qty_per_meter = 'NULL';
        }

        $ponum = "'" . $this->ponum . "'";
        $link2vendor = "'" . $this->vendor . "'";
        $crn = "'" . $this->crn . "'";
        $condition = "'" . $this->condition . "'";
        $maxruling = "'" . $this->maxruling . "'";
        $del = $this->delivery? $this->delivery : 0;
        $rej = $this->qty_rej? $this->qty_rej : 0;
        $order_qty = $this->order_qty? $this->order_qty : 0;
        $alt_spec = "'" . $this->alt_spec . "'";
        $spec_type = "'" . $this->spec_type . "'";
        $layoutrefnum = "'" . $this->layoutrefnum . "'";
        $accepted_date =$this->accepted_date? "'" . $this->accepted_date . "'": "0000-00-00";
        $qty_recd=$this->qty_recd?$this->qty_recd:0.0;
        $remarks = "'" . $this->remarks . "'";
        $grn_num =  "'" . $this->grn_num . "'";
        
        $sql = "INSERT INTO po_line_items (recnum, line_num, item_name, item_desc, qty, material_ref, 
                                           duedate, rate,
                                           amount, link2po, creation_date,material_spec,thick,width,length,
                                           qty_per_meter,no_of_meterages,delv_by, no_of_lengths,
                                           uom, grainflow,crn,`condition`,maxruling,qty_rej,delivery_time,order_qty,
                                           alt_spec_rm,spec_type,layoutrefnum,status,qty_recd,accepted_date,remarks,grn_num,
                                           due_date1,due_date2)
               VALUES ($objid, $line_num, $item_name, $item_desc, $qty, $material_ref, '$duedate', $rate,
                       $amount, $link2po, $crdate,$material_spec,$thick,$width,$length,$qty_per_meter,
                       $no_of_meterages, $delvby, $no_of_lengths, $uom, $grainflow,$crn,$condition,$maxruling,$rej,
                       $del,$order_qty,$alt_spec,$spec_type,$layoutrefnum,$status,$qty_recd,$accepted_date,$remarks,$grn_num,$due_date1,$due_date2)";
        //echo "$sql";
        $result = mysql_query($sql) or die("Insert to PO LI didn't work..Please report to Sysadmin. " . mysql_error()); ;
        // Test to make sure query worked 
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to LI didn't work..Please report to Sysadmin. " . mysql_error()); 
        }
        $sql = "update seqnum set nxtnum = $objid where tablename = 'po_line_items'";
        $result = mysql_query($sql);
        // Test to make sure query worked 
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for PO..Please report to Sysadmin. " . mysql_error()); 
        }
        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Commit failed for PO Insert..Please report to Sysadmin. " . mysql_error()); 
        }
        
        $sql = "insert into mtl_tracker(recnum, ponum, vendor_name, partnum, qty)
                                       values($objid, $ponum, $link2vendor, $material_ref, $no_of_meterages)";
              $result = mysql_query($sql);
              if(!$result) die("Insert to mtl tracker didn't work..Please report to Sysadmin. " . mysql_error());
        return $objid;
     } 

    function updateLI($recnum) { 
        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $line_num = "'" . $this->linenum . "'";
        $item_name = "'" . $this->itemname . "'";
        $item_desc = "'" . $this->itemdesc . "'";
        if($this->qty != '' && $this->qty != 'NULL')
        {
          $qty = "'" . $this->qty . "'";
        }
        else
        {
          $qty = 'NULL';
        }

        $material_ref = "'" . $this->material_ref . "'";
        $duedate = "'" . $this->duedate . "'"?"'" . $this->duedate . "'":"0000-00-00";
        $delvby = "'" . $this->delvby . "'";
        $rate = "'" . $this->rate . "'";
        $amount = $this->amount;     
        //$accepteddate = $this->accepteddate ? $this->accepteddate : "0000-00-00";       
//	$accepteddate =  $this->accepteddate!= ''?"'" . $this->accepteddate . "'":'0000-00-00';
        $material_spec = "'" . $this->material_spec . "'";
	$thick = "'" . $this->thick . "'";
	$width = "'" . $this->width . "'";
	$length = "'" . $this->length . "'";
        $uom = "'" . $this->uom . "'";
        $no_of_lengths = $this->no_of_lengths ? $this->no_of_lengths : 0;
        $no_of_meterages = $this->no_of_meterages ? $this->no_of_meterages : 0;
        $grainflow = "'" . $this->grainflow . "'";
        if($this->qty_per_meter != '' && $this->qty_per_meter != 'NULL')
        {
          $qty_per_meter = $this->qty_per_meter;
        }
        else
        {
          $qty_per_meter = 'NULL';
        }
        $crn = "'" . $this->crn . "'";
        $condition = "'" . $this->condition . "'";
        $maxruling = "'" . $this->maxruling . "'";
        $del = $this->delivery? $this->delivery : 0;
        $rej = $this->qty_rej? $this->qty_rej : 0;
        $order_qty = $this->order_qty? $this->order_qty : 0;
        $alt_spec = "'" . $this->alt_spec . "'";
        $spec_type="'". $this->spec_type ."'";
        $layoutrefnum="'". $this->layoutrefnum ."'";
        $status = "'" . $this->status . "'";
        $accepted_date =$this->accepted_date?"'".  $this->accepted_date ."'" : "0000-00-00";
        $qty_recd=$this->qty_recd?$this->qty_recd:0.0;
        $remarks = "'" . $this->remarks . "'";
        $grn_num =  "'" . $this->grn_num . "'";
        $due_date1 = $this->due_date1 ?  "'" . $this->due_date1 . "'" : "0000-00-00";
        $due_date2 = $this->due_date2 ?  "'" . $this->due_date2 . "'" : "0000-00-00";
        //echo"<br>".$alt_spec."in CLASS<br>" ;

        $sql = "update po_line_items
                          set line_num = $line_num,
                              item_name = $item_name, 
                              item_desc = $item_desc,
                              qty = $qty,
                              material_ref = $material_ref,
                              duedate = $duedate,
                              delv_by = $delvby,
                              rate = $rate,
                              amount = $amount,
                              material_spec = $material_spec,
                              thick = $thick,
                              width = $width,
                              length = $length,
                              qty_per_meter = $qty_per_meter,
                              no_of_meterages = $no_of_meterages,
                              no_of_lengths = $no_of_lengths,
                              uom = $uom,
                              grainflow = $grainflow,
                              accepted_date = $accepted_date,
                              crn = $crn,
                              `condition` = $condition,
                              maxruling = $maxruling,
                              qty_rej = $rej,
                              delivery_time = $del,
                              order_qty=$order_qty,
                              alt_spec_rm=$alt_spec,
                              spec_type=$spec_type,
                              layoutrefnum=$layoutrefnum,
                              status=$status ,
                              qty_recd=$qty_recd,
                              remarks=$remarks,
                              grn_num=$grn_num,
                              due_date1=$due_date1,
                              due_date2=$due_date2
                        where recnum = $lirecnum";
         // echo $sql;
                           
           $result = mysql_query($sql);
           // Test to make sure query worked 
           if(!$result) die("Update to PO line items didn't work..Please report to Sysadmin. " . mysql_error()); 

     } 


     function getLI($inpporecnum) {
        $porecnum = "'" . $inpporecnum . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select l.line_num, l.item_name, l.item_desc,
                       l.qty, l.duedate, l.rate, l.amount, l.recnum, l.material_ref, l.material_spec,
                       l.thick, l.width, l.length, l.qty_per_meter, l.no_of_meterages, l.delv_by,
                       l.uom, l.grainflow, l.no_of_lengths, l.accepted_date,l.crn,l.condition,l.maxruling,l.qty_rej,
                       l.delivery_time,l.order_qty,l.alt_spec_rm,l.spec_type,l.layoutrefnum ,l.qty_recd ,l.status,
                       l.remarks,l.grn_num,l.due_date1,l.due_date2
                   from po_line_items l
                   where l.link2po = $porecnum order by (l.line_num+0)";
       //echo $sql;
        
        $result = mysql_query($sql);
        return $result;
     }
     
     function getLI4mtltrk($inpponum) {
        $ponum = "'" . $inpponum . "'";
        
        $sql = "select recnum from po where ponum=$ponum";
        //echo $sql;
        
        $result1 = mysql_query($sql);
        $myrow = mysql_fetch_row($result1);
        $porecnum = $myrow[0];
        
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select l.line_num, l.item_name, l.item_desc,
                       l.qty, l.duedate, l.rate, l.amount, l.recnum, l.material_ref, l.material_spec,
                       l.thick as thick, l.width as width, l.length as length, l.qty_per_meter, l.no_of_meterages,
                       p.currency as currency ,l.delv_by, l.no_of_lengths,l.uom, l.grainflow,l.alt_spec_rm
                  from po_line_items l, po p
                  where  l.link2po = p.recnum and 
                         l.link2po = $ponum order by l.recnum";
        // echo $sql;

        $result = mysql_query($sql);
        return $result;
     }
     
     function deleteLI($inplirecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $lirecnum = "'" . $inplirecnum . "'";
        $sql = "delete from po_line_items where recnum = $lirecnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Line Items failed...Please report to SysAdmin. " . mysql_error()); 
      }
      
      function getrm_qty($crn,$alt_spec) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select rm_qty_perbill,length,rm_dia from rmmaster where crnnum='$crn' and rm_altrm='$alt_spec'";
         //echo "$sql";
        $result = mysql_query($sql);
        return $result;
      }
      
      function getRM_masterDetails4po($crn,$vendor,$spec_type) 
      {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
        $siteval = "r.siteid = '".$siteid."'";

        $sql = " select  r.recnum,r.rm_type,r.rm_spec,
                        r.rm_grainflow,r.rm_mrs,r.rm_status,
                        r.length,r.width,r.thickness,
                        r.rm_dia ,rm_uom,r.rm_qty_perbill,
                        r.rm_unitprize,r.rm_altrm,
                        r.rm_condition ,c.name,r.crnnum
                from  rmmaster r ,company c
                where r.crnnum like  '$crn%' and
                      r.link2vendor= $vendor and
                      c.recnum=r.link2vendor and
                      r.rm_altrm='$spec_type' and
                      r.rm_status = 'Active' and $siteval";
        // echo $sql; exit;
        $result = mysql_query($sql);
        return $result;
     }

     function getgrndetails4po($grn_num,$crn,$linenumber,$cimponum)
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();

       $sql = " select g.grnnum,g.cimponum,g.crn,g.rmpolinenum,sum(gli.qty) as qty
                       from grn g,grn_li gli
                            where g.grnnum='$grn_num' and
                                  g.cimponum='$cimponum' and
                                  g.rmpolinenum='$linenumber' and
                                  g.crn='$crn' and
                                  gli.link2grn=g.recnum
                                  group by g.grnnum";
           // echo $sql;
        $result = mysql_query($sql);
        if(!$result)die("getgrndetails4po failed for Poli...". mysql_error())  ;
        return $result;
     
     }
     
     function getqtyrecd4podetails($lnnumber,$porecnum)
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();

       $sql = " select poli.qty_recd,poli.line_num,poli.order_qty
                       from po p,po_line_items poli
                            where poli.link2po=p.recnum and
                                  p.recnum=$porecnum and poli.line_num='$lnnumber'";
            //echo $sql;
        $result = mysql_query($sql);
        if(!$result)die("getqtyrecd4podetails failed for Poli...". mysql_error())  ;
        return $result;

     }

      function getpart_masterDetails4po($partnumber,$linkvendor)
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $siteid = $_SESSION['siteid'];
       $siteval = "v.siteid ='".$siteid."'";

        $sql = "select v.partnum,v.mfr_partnum,v.ptype,v.rate,c.name
                from vend_part_master v,company c where v.partnum='$partnumber' and c.recnum='$linkvendor' and $siteval";
           // echo $sql;
        $result = mysql_query($sql);
        if(!$result)die("getpart_masterDetails4po failed for Poli...". mysql_error())  ;
        return $result;

     }
     
      // For POLI status update.
      //p.ponum in();
     function getallpolidetails()
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();

        $sql = "select li.crn,sum(li.qty_recd) as recdqty,sum(li.no_of_meterages + li.no_of_lengths)as orderqty,li.`status`,li.grn_num,p.ponum ,p.recnum
                       from po_line_items li,po p
                            where li.link2po=p.recnum and
                                   p.status = 'Open' and
                                   p.ponum in (
'TKA-149',
'TKA-150',
'TKA-151'
)
                                   group by p.ponum,li.crn having recdqty>=orderqty order by p.ponum";
            echo $sql;
        $result = mysql_query($sql);
        if(!$result)die("getallpolidetails failed for Poli...". mysql_error())  ;
        return $result;
     }

     
     function getallpolidetails4postat()
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();

        $sql = "select p.ponum as ponum,
		                          p.status as postat,
		                          li.status as listat,
								  crn
		                   from po_line_items li,
						             po p
                            where li.link2po=p.recnum and
                                   p.status = 'Open' and
                                   p.ponum in (
'AMS-216'
)
                          order by p.ponum";
            echo "<br>$sql";
        $result = mysql_query($sql);
        if(!$result)die("getallpolidetails failed for Poli...". mysql_error())  ;
        return $result;
     }


     function updatestat4poli($grnnum,$crn,$recnum)
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();

        $sql = "update po_line_items
                                    set `status`='Close'
                                          where
                                                 link2po=$recnum and
                                                 crn='$crn'";
            echo "<br>$sql";
        $result = mysql_query($sql);
        if(!$result)die("updatestat4poli failed for Poli...". mysql_error())  ;
     }

     function updatestat4po($ponum)
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();

        $sql = "update po
                                    set `status`='Closed'
                                          where
                                                 ponum ='$ponum'";
            echo "<br>$sql";
        $result = mysql_query($sql);
        //if(!$result)die("updatestat4poli failed for Poli...". mysql_error())  ;
     }

     function getlidates($recnum)
  {
    $query=" select duedate,
            due_date1,
            due_date2,
            accepted_date,
            cim1_approval,
            cim2_approval
        from po_line_items
        where
            recnum ='$recnum'";
    $result=mysql_query($query);
    return $result;
  }

   function updateLIDates($recnum) 
    {
       $newlogin = new userlogin;
           $newlogin->dbconnect();

       $due_date1 = $this->due_date1 ?  "'" . $this->due_date1 . "'" : "0000-00-00";
           $due_date2 = $this->due_date2 ?  "'" . $this->due_date2 . "'" : "0000-00-00";
       $accepted_date =$this->accepted_date?"'".  $this->accepted_date ."'" : "0000-00-00";
       $duedate = "'" . $this->duedate . "'"?"'" . $this->duedate . "'":"0000-00-00";
       $cim_due1 = "'" . $this->cim_due1 ."'";
       $cim_due2 = "'" . $this->cim_due2 . "'";

      $sql = "update po_line_items
                    set duedate=$duedate,
                       due_date1=$due_date1,
                       due_date2=$due_date2,
                       accepted_date=$accepted_date,
                       cim1_approval=$cim_due1,
                       cim2_approval=$cim_due2
                     where
                           recnum ='$recnum'";
          //echo "<br>$sql";
           $result = mysql_query($sql);
           if(!$result)die("updateLIDates failed for Poli...". mysql_error())  ;
   }

     

} // End po class definition 


