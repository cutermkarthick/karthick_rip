<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: deliverClass.php
// Application: WMS
// Revision: v1.0
//====================================

include_once('loginClass.php');

class dn {
var $sent_to,
    $deliver_to,
    $crn,
    $deliver_date,
    $ponum,
    $podate,
    $poline_num,
    $wonum,
    $untreated_partnum,
    $treated_partnum,
    $part_iss,
    $drg_iss,
    $cos,
    $mtl_spec,
    $grn_num,
    $batch_num,
    $qty,
    $remarks,
    $status,
    $poqty;

// Constructor definition
function dn() {
    $this->sent_to = '';
    $this->deliver_to = '';
    $this->crn = '';
    $this->deliver_date = '';
    $this->ponum = '';
    $this->podate = '';

    $this->poline_num = '';
    $this->poqty = '';
    $this->wonum = '';
    $this->untreated_partnum = '';
    $this->treated_partnum = '';
    $this->part_iss = '';
    $this->drg_iss = '';

    $this->cos = '';
    $this->mtl_spec = '';
    $this->grn_num = '';
    $this->batch_num = '';
    $this->qty = '';  
    $this->remarks = '';
    $this->status = '';
}

// Property get and set
function getstatus() {
       return $this->status;
}
function setstatus($req_status) {
       $this->status= $req_status;
}

function getremarks() {
       return $this->remarks;
}
function setremarks($req_remarks) {
       $this->remarks= $req_remarks;
}

function getsent_to() {
       return $this->sent_to;
}
function setsent_to($req_sent) {
       $this->sent_to= $req_sent;
}
function getdeliver_to() {
       return $this->deliver_to;
}
function setdeliver_to($req_deliver_to) {
       $this->deliver_to= $req_deliver_to;
}
function getcrn() {
       return $this->crn;
}
function setcrn ($req_crn) {
       $this->crn = $req_crn;
}
function getdeliver_date() {
       return $this->deliver_date;
}
function setdeliver_date ($req_deliver_date) {
       $this->deliver_date = $req_deliver_date;
}
function getponum() {
       return $this->ponum;
}
function setponum($req_ponum) {
       $this->ponum = $req_ponum;
}

function getpodate() {
       return $this->podate;
}
function setpodate ($req_podate) {
       $this->podate = $req_podate;
}


function getpoline_num() {
       return $this->poline_num;
}
function setpoline_num($req_poline_num) {
       $this->poline_num = $req_poline_num;
}

function getwonum() {
       return $this->wonum;
 }
function setwonum($req_wonum) {
       $this->wonum = $req_wonum;
 }

function getuntreated_partnum() {
       return $this->untreated_partnum;
}
function setuntreated_partnum($req_untreated_partnum) {
       $this->untreated_partnum = $req_untreated_partnum;
}

function gettreated_partnum() {
       return $this->treated_partnum;
}
function settreated_partnum($req_treated_partnum) {
       $this->treated_partnum = $req_treated_partnum;
}

function getpart_iss() {
       return $this->part_iss;
}
function setpart_iss($req_part_iss) {
       $this->part_iss = $req_part_iss;
}
function getdrg_iss() {
       return $this->drg_iss;
}

function setdrg_iss($req_drg_iss) {
       $this->drg_iss = $req_drg_iss;
}

function getcos() {
       return $this->cos;
}
function setcos($req_cos) {
       $this->cos = $req_cos;
}

function getmtl_spec() {
       return $this->mtl_spec;
}
function setmtl_spec($req_mtl_spec) {
       $this->mtl_spec = $req_mtl_spec;
}

function getgrn_num() {
       return $this->grn_num;
}
function setgrn_num($req_grn_num) {
       $this->grn_num = $req_grn_num;
}

function getbatch_num() {
       return $this->batch_num;
}
function setbatch_num($req_batch_num) {
       $this->batch_num = $req_batch_num;
}

function getqty() {
       return $this->qty;
}
function setqty($req_qty) {
       $this->qty = $req_qty;
}

function getpo_qty() {
       return $this->poqty;
}
function setpo_qty($req_poqty) {
       $this->poqty = $req_poqty;
}


 function addDeliver()
 {
    $newlogin = new userlogin;
    $newlogin->dbconnect();      
    $sql = "select nxtnum from seqnum where tablename = 'delivery_note' for update";
    
    $result = mysql_query($sql);
    if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
    $myrow = mysql_fetch_row($result);
    $seqnum = $myrow[0];
    $objid = $seqnum + 1;
    $prefix = "DN";
    $strrecnum=sprintf("%03d",$objid);
    $dnnum=$prefix.$strrecnum;
    $crn="'" . $this->crn . "'";
    $sent_to="'" . $this->sent_to . "'" ;
    $deliver_to="'" . $this->deliver_to . "'";
    $deliver_date=$this->deliver_date?"'" . $this->deliver_date . "'":'0000-00-00';
  	$ponum="'" . $this->ponum . "'";
    $podate=$this->podate?"'" . $this->podate . "'":'0000-00-00';
    $poline_num="'" . $this->poline_num . "'";
    $wonum="'" . $this->wonum . "'";
    $untreated_partnum="'" . $this->untreated_partnum . "'";
    $treated_partnum="'" . $this->treated_partnum . "'";
    $part_iss="'" . $this->part_iss . "'";
    $drg_iss="'" . $this->drg_iss . "'";
    $cos="'" . $this->cos . "'";
    $mtl_spec="'" . $this->mtl_spec . "'";
    $grn_num="'" . $this->grn_num . "'";
    $batch_num="'" . $this->batch_num . "'";
    $qty="'" . $this->qty . "'";
    $remarks="'" . $this->remarks . "'";
    $status="'" . $this->status . "'";
    $poqty="'" . $this->poqty . "'";
    $siteid="'" . $_SESSION['siteid'] . "'";
    $sql_type = "select * from delivery_note where crn=$crn";
    $result_type = mysql_query($sql_type);
    if(mysql_num_rows($result_type) > 0)
    {
     $type = "'" . 'Regular' . "'";
    }
    else
    {
     $type = "'" . 'FAI' . "'";
    }
  
    $sql = "INSERT INTO delivery_note(
             recnum,
		          dnnum,
              sent_treat_to,
              treat_deliver_to,
              crn,
              deliver_date,
              ponum,
              podate,
	           poline_num,
        		 wonum,
        		 untreated_partnum,
        		 treated_partnum,
        		 part_iss,
        		 drg_iss,
        		 cos,
        		 mtl_spec,
        		 grn_num,
        		 batch_num,
        		 qty,
             formatnum,
             formatrev,
             remarks,
             status,
             poqty,
             type,
             siteid)
                    VALUES
             ($objid,
        		'$dnnum',
        		$sent_to,
            $deliver_to,
            $crn,
            $deliver_date,
            $ponum,
            $podate,
            $poline_num,
		        $wonum,
            $untreated_partnum,
            $treated_partnum,
            $part_iss,
            $drg_iss,
            $cos,
           $mtl_spec,
		        $grn_num,
            $batch_num,
            $qty	,
            'F8201',
            'Rev 1 Dt Jun 29, 2012 - Upg cert from AS9100 B to AS9100 C',
	         	$remarks,
            $status,
            $poqty,
            $type,
            $siteid)";
      // echo $sql;
      $result = mysql_query($sql);
      if($result!='')
      {
          $sql = "update work_order set dnnum = '$dnnum' 
                         where wonum = $wonum";
            $result = mysql_query($sql);
       // Test to make sure query worked
       if(!$result) die("Update to work_order didn't work..Please report to Sysadmin. " . mysql_error());
         // echo $sql;exit;
      }
      if(!$result) die("Insert to DN didn't work..Please report to Sysadmin. " . mysql_error());   
     $sql = "update seqnum set nxtnum = $objid where tablename = 'delivery_note'";
      $result = mysql_query($sql);
      // Test to make sure query worked
      if(!$result) die("Seqnum insert query didn't work for DN..Please report to Sysadmin. " . mysql_error());
  return $objid;
 }
 
function getdeliverDetails($delrecnum) {
    $newlogin = new userlogin;
    $newlogin->dbconnect();

    $sql = "select d.recnum, d.dnnum, d.sent_treat_to, 
            d.treat_deliver_to, d.crn, d.deliver_date, 
            d.ponum, d.podate, d.poline_num, d.wonum, 
            d.untreated_partnum, d.treated_partnum, 
            d.part_iss, d.drg_iss, d.cos, d.mtl_spec, 
            d.grn_num, d.batch_num, d.qty, d.formatnum, 
            d.formatrev, d.remarks, d.status, d.poqty, 
            d.type, w.acc4dn from delivery_note d, work_order w 
            where  d.wonum=w.wonum and  d.recnum = $delrecnum";

  //   $sql = "select  d.recnum,    
  //               d.dnnum, 
  //                   d.sent_treat_to,
  //                   d.treat_deliver_to,
		// 		d.crn,
		// 		d.deliver_date,
		// 		d.ponum,
		// 		d.podate,
		// 		d.poline_num,
		// 		d.wonum,
		// 		d.untreated_partnum,
		// 		d.treated_partnum,
		// 		d.part_iss,
		// 		d.drg_iss,
		// 		d.cos,
		// 		d.mtl_spec,
		// 		d.grn_num,
		// 		d.batch_num,
		// 		d.qty,
		// 		d.formatnum,
		// 		d.formatrev,
		// 		d.remarks,
  //                   d.status,
  //                   d.poqty,
  //                   d.type,
  //                   w.acc4dn,
		// 		sppoli.price
  //            from delivery_note d,
		//            work_order w,
		// 		   assypo sppo,
		// 		   assypo_line_items sppoli
  //            where d.recnum = $delrecnum and 
  //              d.wonum=w.wonum and
	 // sppoli.link2assyPo = sppo.recnum and
  //                    (trim((substr(d.ponum,1,instr(d.ponum,'Amnd')-1)) = trim(sppo.assyPonum)) or d.ponum = sppo.assyPonum) and 
	 // d.crn = sppoli.crnNum and
  //        d.poline_num = sppoli.lineNum";
    // echo '+++++++++++++++++'.$sql;exit;
    $result = mysql_query($sql);
    if(!$result) die("........Access to Deliver Note....... failed...Please report to SysAdmin. " . mysql_error());
    return $result;
 }

function updateDeliver($delrecnum) { 
    $delrecnum = "'" . $delrecnum . "'";
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $sql = "start transaction";

    $sent_to="'" . $this->sent_to . "'" ;
    $deliver_to="'" . $this->deliver_to . "'";
    $crn="'" . $this->crn . "'";
$deliver_date=$this->deliver_date?"'" . $this->deliver_date . "'":'0000-00-00';
$ponum="'" . $this->ponum . "'";
$podate=$this->podate?"'" . $this->podate . "'":'0000-00-00';	
$poline_num="'" . $this->poline_num . "'";
$wonum="'" . $this->wonum . "'"; 
$untreated_partnum="'" . $this->untreated_partnum . "'";
$treated_partnum="'" . $this->treated_partnum . "'";
$part_iss="'" . $this->part_iss . "'"; 
$drg_iss="'" . $this->drg_iss . "'";
$cos="'" . $this->cos . "'";
$mtl_spec="'" . $this->mtl_spec . "'"; 
$grn_num="'" . $this->grn_num . "'";
    $batch_num="'" . $this->batch_num . "'";
$qty="'" . $this->qty . "'";     
$remarks="'" . $this->remarks . "'";  
    $status="'" . $this->status . "'";
    $poqty="'" . $this->poqty . "'";
    
    $sql_type = "select * from delivery_note where crn=$crn and recnum != $delrecnum ";
    //echo $sql_type;
    $result_type = mysql_query($sql_type);
    if(mysql_num_rows($result_type) > 0)
    {
     $type = "'" . 'Regular' . "'";
    }
    else
    {
     $type = "'" . 'FIA' . "'";
    }
    $sql = "update delivery_note set		                      
                          sent_treat_to = $sent_to,
                          treat_deliver_to = $deliver_to,
                          crn = $crn,
                          deliver_date = $deliver_date,
                          ponum = $ponum,
	                  podate = $podate,
                          poline_num = $poline_num,
                          wonum = $wonum,
                          untreated_partnum = $untreated_partnum,
                          treated_partnum = $treated_partnum,
	                  part_iss = $part_iss,
                          drg_iss = $drg_iss,
                          cos = $cos,
	                  mtl_spec = $mtl_spec,
	                  grn_num = $grn_num,
                          batch_num = $batch_num,
                          qty = $qty,
                      remarks = $remarks,
                          status = $status,
                          poqty = $poqty,
                          type = $type
           where recnum = $delrecnum ";
       //echo "$sql";
       $result = mysql_query($sql);
       // Test to make sure query worked
       if(!$result) die("Update to Deliver didn't work..Please report to Sysadmin. " . mysql_error());
 }
 
 function getdeliverSummary($cond,$argoffset,$arglimit)
 {
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     $offset= $argoffset;
     $limit= $arglimit;
     $wcond = $cond;
     $siteid = $_SESSION['siteid'];
     $siteval = "d.siteid = '".$siteid."'";
     //echo $wcond;

$sql = "select d.recnum,    
d.dnnum,
d.sent_treat_to,
d.treat_deliver_to,
d.crn,
d.deliver_date,
d.ponum,
d.podate,
d.poline_num,
d.wonum,
d.untreated_partnum,
d.treated_partnum,
d.part_iss,
d.drg_iss,
d.cos,
d.mtl_spec,
d.grn_num,
d.batch_num,
d.qty,
d.status,
d.type,
sum(dli.qty_recd),
sum(dli.qty_acc),
sum(dli.qty_rej),
sum(dli.qty_rewqa)
FROM delivery_note d	
left join delivery_note_li dli on 
dli.link2delivery = d.recnum 
where $wcond and $siteval
group by d.recnum
order by d.recnum limit $offset,$limit";
    // echo "$sql";exit;
    $result = mysql_query($sql);
    if(!$result) die("getdeliverSummary query failed..Please report to Sysadmin. " . mysql_error());
    return $result;

 }
 
 function getdeliverSummaryCount($cond,$argoffset,$arglimit) {

    $wcond = $cond;
    $offset = $argoffset;
    $limit = $arglimit;
     $siteid = $_SESSION['siteid'];
     $siteval = "d.siteid = '".$siteid."'";
    $sql = "select count(*) as numrows
        FROM delivery_note d
            where $wcond and $siteval
             order by d.recnum";
    $newlogin = new userlogin;
    $newlogin->dbconnect();

    $result  = mysql_query($sql) or die('assypo count query failed');
    $row     = mysql_fetch_array($result, MYSQL_ASSOC);
    $numrows = $row['numrows'];
    return $numrows;

}

 function getVendors() {
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     $offset= $argoffset;
     $limit= $arglimit;
     $wcond = $cond;
     //echo $wcond;
     $siteid = $_SESSION['siteid'];
     $siteval = "siteid = '".$siteid."'";

     $sql = "select recnum, name
             from company where type = 'VEND' and $siteval order by name";

    // echo "$sql";
    $result = mysql_query($sql);
    if(!$result) die("getVendors query failed..Please report to Sysadmin. " . mysql_error());
    return $result;

 }
function getwos4dn($cond)
{
   $newlogin = new userlogin;
   $newlogin->dbconnect();
   $sql = "select w.wonum,m.secondary_partname,m.partnum,
                m.attachments,m.drg_issue, m.cos,
                  w.rm_spec,w.grnnum,w.batchnum,w.comp_qty,
		      w.qty-w.dn_qty_recd,w.dn_qty_recd
        from master_data m,wo_part_status wps, work_order w
            where w.link2masterdata = m.recnum and
          w.treatment = 'With Treatment' and
		wps.link2wo = w.recnum and
		wps.stage = 'DN' and
            $cond
            group by w.wonum
            order by w.recnum asc";
   //echo $sql;
   $result = mysql_query($sql);
   return $result;

}

function getwos4dnwo($cond)
{
   $newlogin = new userlogin;
   $newlogin->dbconnect();
   $siteid = $_SESSION['siteid'];
   $siteval = "w.siteid = '".$siteid."'";
   
   $sql = "select w.wonum,
                m.secondary_partname,
                m.partnum, 
               m.attachments,
               m.drg_issue, 
               m.cos, 
               w.rm_spec,
               w.grnnum,
               w.batchnum,
               w.qty 
         from master_data m, 
              wo_part_status wps,
              work_order w
        where $cond and w.link2masterdata = m.recnum 
        and wps.link2wo = w.recnum and w.`condition` ='closed' 
        and (wps.stage = 'fi' or wps.stage = 'final') and $siteval and w.treatment = 'Treated' 
     group by w.wonum order by w.recnum asc";

   // $sql = "select w.wonum,m.secondary_partname,m.partnum,
    //             m.attachments,m.drg_issue, m.cos,
   //                w.rm_spec,w.grnnum,w.batchnum,w.acc4dn,
		   //    w.qty-w.dn_qty_recd,w.dn_qty_recd
     //    from master_data m, wo_part_status wps,work_order w
     //    left join delivery_note dn on w.wonum=dn.wonum and dn.status = 'Open'
   //          where w.link2masterdata = m.recnum and
    //       w.treatment = 'With Treatment' and
    //       wps.link2wo = w.recnum and
    //       (wps.stage = 'DN'||wps.stage = 'dn') and
   //          $cond and
   //          dn.wonum is null and
   //          w.`condition` ='Open' and
   //          (CASE WHEN (w.woclassif = 'Rework') THEN w.approval = 'yes' ELSE TRUE END)
   //          group by w.wonum
   //          order by w.recnum asc";
   
        // echo $sql;exit;
   $result = mysql_query($sql);
   return $result;

}

function getwos4dnwo_prev($cond)
{
   $newlogin = new userlogin;
   $newlogin->dbconnect();
$sql = "select w.wonum,m.secondary_partname,m.partnum,
        m.attachments,m.drg_issue, m.cos,
        w.rm_spec,w.grnnum,w.batchnum,w.acc4dn,
        w.qty-w.dn_qty_recd,w.dn_qty_recd
        from master_data m, wo_part_status wps,work_order w
        left join delivery_note dn on w.wonum=dn.wonum and dn.status = 'Open'
        where w.link2masterdata = m.recnum and
        w.treatment = 'With Treatment' and
        wps.link2wo = w.recnum and
        (wps.stage = 'DN'||wps.stage = 'dn') and
        $cond and
        dn.wonum is NULL 
        group by w.wonum
        order by w.recnum asc";
   //echo $sql;
   $result = mysql_query($sql);
   return $result;

}


function getpo_num($crn)
{
   $newlogin = new userlogin;
   $newlogin->dbconnect();
   $sql = "select a.assyPonum,al.lineNum,a.podate,al.qty,a.amnd_no
           from assypo a,assypo_line_items al
           where a.recnum=al.link2assyPo 
	         and al.crnNum='$crn'
	         and a.status = 'Open'
           order by a.assyPonum";
   // echo $sql;
   $result = mysql_query($sql);
   return $result;

}

function getaddress($company)
{
   $newlogin = new userlogin;
   $newlogin->dbconnect();
   $sql = "select addr1, addr2, city
                state, zipcode, country
           from company 
           where name = '$company'";
   //echo $sql;
   $result = mysql_query($sql);
   return $result;

}

function getdnsum4po($ponum,$linenum)
{
   $newlogin = new userlogin;
   $newlogin->dbconnect();
   $sql = "select sum(dn.qty) from delivery_note dn
           where dn.ponum like '$ponum%'
           and dn.poline_num='$linenum'
           and dn.status != 'Cancelled'
           group by substring_index(ponum, ' ',1),dn.poline_num";
   // echo $sql;
   $result = mysql_query($sql);
   return $result;
}

function getdnsum4po_old($ponum,$linenum)
{
   $newlogin = new userlogin;
   $newlogin->dbconnect();
   $sql = "select sum(dn.qty) from delivery_note dn
           where dn.ponum like '$ponum%'
           and dn.poline_num='$linenum'
           and dn.status != 'Cancelled'
           group by dn.ponum,dn.poline_num";
   //echo $sql;
   $result = mysql_query($sql);
   return $result;
}
function getpoqty($ponum,$linenum)
{
   $newlogin = new userlogin;
   $newlogin->dbconnect();
   $sql = "select al.qty
           from assypo a,assypo_line_items al
           where a.recnum=al.link2assyPo
           and a.assyPonum='$ponum'
           and al.lineNum='$linenum'
           and a.status != 'Cancelled'";
   // echo $sql;
   $result = mysql_query($sql);
   return $result;
}
function updatewodnnum($wonum)
{
   $newlogin = new userlogin;
   $newlogin->dbconnect();
   $sql = "update work_order set dnnum = '$dnnnum'
           where wonum = $wonum";
   // echo $sql;exit;
   $result = mysql_query($sql);
   return $result;
}
function getwocrns4dn()
{
   $newlogin = new userlogin;
   $newlogin->dbconnect();
   $siteid = $_SESSION['siteid'];
   $siteval = "w.siteid = '".$siteid."'";
   $sql = "select distinct(w.crn_num) from work_order w, wo_part_status wps where w.recnum = wps.link2wo and  (wps.stage = 'fi' or wps.stage = 'final') and w.treatment = 'Treated' and w.`condition` = 'Closed' and $siteval";
   // echo $sql;
   $result = mysql_query($sql);
   return $result;

}

} //end of the class

