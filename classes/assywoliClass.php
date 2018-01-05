<?
//================================================
// Author: FSI
// Date-written = April 27,2010
// Filename: bomClass.php
// Maintains the class for BOMs
// Revision: v1.0
//================================================

include_once('loginClass.php');

class assywo_li {

    var $linenum,
        $itemno,
        $partno,
        $issue,
        $descr,
        $qty,
        $qty_wo,
        $uom,
        $grn,
        $link2assywo,
        $expdate,
        $remarks,
        $qty_rew,
        $qty_rej,
        $crn_num4li,
        $type,$qty_ret,$qty_acc,$pcrn_num,$crn_type,
        $qtm,
        $rmponum,
        $rmpo_linenum,
        $rmpocost,
        $qainsp_app,
        $qainsp_appdate,
        $qainsp_appby,
        $ncrnum;

    // Constructor definition
    function assywo_li() {
        $this->linenum = '';
        $this->itemno = '';
        $this->partno = '';
        $this->issue = '';
        $this->descr = '';
        $this->qty = '';
        $this->qty_wo = '';
        $this->uom = '';
        $this->grn = '';
        $this->link2assywo = '';
        $this->expdate = '';
        $this->remarks = '';
        $this->qty_rew = '';
        $this->qty_rej = '';
        $this->crn_num4li='';
        $this->type='';
        $this->qty_ret = '';
        $this->qty_acc = '';
        $this->pcrn_num = '';
        $this->crn_type = '';
        $this->qtm = '';

        $this->rmponum = '';
        $this->rmpo_linenum = '';
        $this->rmpocost = '';
        $this->qainsp_app = '';
        $this->qainsp_appdate = '';
        $this->qainsp_appby = '';
        $this->ncrnum_li = '';
     }

    // Property get and set
    function getlinenum() {
           return $this->linenum;
    }

    function setlinenum($reqlinenum) {
           $this->linenum = $reqlinenum;
    }
    function getitemno() {
           return $this->itemno;
    }

    function setitemno($reqitemno) {
           $this->itemno = $reqitemno;
    }

    function getpartno() {
           return $this->partno;
    }

    function setpartno($reqpartno) {
           $this->partno = $reqpartno;
    }

    function getissue() {
           return $this->issue;
    }
    function setissue($reqissue) {
           $this->issue = $reqissue;
    }
    function getdescr() {
           return $this->descr ;
    }
    function setdescr($reqdescr) {
           $this->descr = $reqdescr;
    }

    function getqty() {
           return $this->qty;
    }

    function setqty ($reqqty) {
           $this->qty = $reqqty;
    }
    function getwo_qty() {
           return $this->wo_qty;
    }

    function setwo_qty($reqwo_qty) {
           $this->qty_wo = $reqwo_qty;
    }
     function getuom() {
           return $this->uom;
    }

    function setuom($requom) {
           $this->uom = $requom;
    }

    function getgrn() {
           return $this->grn;
    }

    function setgrn ($reqgrn) {
           $this->grn = $reqgrn;
    }

    function getlink2assywo() {
           return $this->link2assywo;
    }

    function setlink2assywo($reqlink2assywo) {
           $this->link2assywo = $reqlink2assywo;
    }

    function getexpdate() {
           return $this->expdate;
    }

    function setexpdate ($reqexpdate) {
           $this->expdate = $reqexpdate;
    }

    function getremarks() {
           return $this->remarks;
    }

    function setremarks($reqremarks) {
           $this->remarks = $reqremarks;
    }
    function setqty_rew($qty_rew) {
           $this->qty_rew = $qty_rew;
    }
    
    function setqty_rej($qty_rej) {
           $this->qty_rej = $qty_rej;
    }

    function setcrn_num4li($crn_num4li) {
           $this->crn_num4li = $crn_num4li;
    }
    function settype($type)
    {
      $this->type=$type;

    }
     function setqty_ret($qty_ret) {
           $this->qty_ret = $qty_ret;
    }
    function setqty_acc($qty_acc) {
           $this->qty_acc = $qty_acc;
    }
    
    function setpcrn_num($pcrn_num) {
           $this->pcrn_num = $pcrn_num;
    }
    function setcrn_type($crn_type) {
           $this->crn_type = $crn_type;
    }


    function setworecnum($worecnum)
  {
           $this->worecnum = $worecnum;
    }

function setcofc_num($cofc_num)
  {
           $this->cofc_num = $cofc_num;
    }
  function setsupplier_wo($supplier_wo) 
  {
           $this->supplier_wo = $supplier_wo;
    }
 function setqtm($qtm) {
           $this->qtm = $qtm;
    }
     function getqtm($qtm) {
           return $this->qtm;
    }

    function setrmponum($rmponum) {
      $this->rmponum = $rmponum;
    }

    function setrmpo_linenum($rmpo_linenum) {
      $this->rmpo_linenum = $rmpo_linenum;
    }

    function setrmpocost($rmpocost) {
      $this->rmpocost = $rmpocost;
    }

    function setqainsp_app($qainsp_app) {
      $this->qainsp_app = $qainsp_app;
    }

    function setqainsp_appdate($qainsp_appdate) {
      $this->qainsp_appdate = $qainsp_appdate;
    }

    function setqainsp_appby($qainsp_appby) {
      $this->qainsp_appby = $qainsp_appby;
    }

    function setncrnum_li($ncrnum_li) {
      $this->ncrnum_li = $ncrnum_li;
    }

    function addAssywo_li($cust_ponum)
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $linenum = "'" . $this->linenum . "'";
        $itemno = "'" . $this->itemno . "'";
        $partno = "'" . $this->partno . "'";
        $issue = "'" . $this->issue . "'";
        $qty = $this->qty?$this->qty:0;
        $qty_wo =$this->qty_wo?$this->qty_wo:0;
        $uom ="'" . $this->uom . "'";
        $grn = "'" . $this->grn . "'";
        $link = $this->link2assywo;
        $expdate=  $this->expdate?"'" .$this->expdate."'":'0000-00-00';
        $remarks= "'" . $this->remarks . "'";
        $descr = "'" . $this->descr . "'";
        $qty_rew =$this->qty_rew?$this->qty_rew:0;
        $qty_rej =$this->qty_rej?$this->qty_rej:0;
        $crn_num4li= "'" . $this->crn_num4li . "'";
        $type="'" . $this->type . "'";
        $qty_ret =$this->qty_ret?$this->qty_ret:0;
        $qty_acc =$this->qty_acc?$this->qty_acc:0;
        $pcrn_num=  "'" . $this->pcrn_num . "'";
        $crn_type=  "'" . $this->crn_type . "'";

        $rmponum=  "'" . $this->rmponum . "'";
        $rmpo_linenum=  "'" . $this->rmpo_linenum . "'";
        $rmpocost=  "'" . $this->rmpocost . "'";
        $ncrnum=  "'" . $this->ncrnum_li . "'";
        $supplier_wo=  "'" . $this->supplier_wo . "'";
        $cofc_num=  "'" . $this->cofc_num . "'";

         $sql = "INSERT INTO
		  	          assywo_li(linenum, itemno, partnum, issue, qty, qty_wo,uom,grn,
                      link2assywo,exp_date,remarks,descr,crn_num4li,bom_type,qty_ret,qty_acc,pcrn_num,
                      crn_type,pcustponum,rmponum,rmpo_linenum,rmpo_cost,ncrnum,cofc_num,suppier_wo)
                         VALUES
			         ($linenum, $itemno, $partno, $issue,$qty,$qty_wo,$uom,$grn,
                      $link,$expdate,$remarks,$descr,$crn_num4li,$type,$qty_ret,$qty_acc,$pcrn_num,
                      $crn_type,'$cust_ponum',$rmponum,$rmpo_linenum,$rmpocost,$ncrnum,$cofc_num,$supplier_wo)";
         // echo $sql;
         $result = mysql_query($sql);

           // Test to make sure query worked
         if(!$result) die("Insert to Assy WO Li didn't work..Please report to Sysadmin. " . mysql_error());

        // Test to make sure query worked
        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for Assy WO Li Insert..Please report to Sysadmin. " . mysql_error());
     }

    function updateAssywo_li($inrecnum,$custponum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $linenum = "'" . $this->linenum . "'";
        $itemno = "'" . $this->itemno . "'";
        $partno = "'" . $this->partno . "'";
        $issue = "'" . $this->issue . "'";
        $qty = $this->qty?$this->qty:0;
        $qty_wo = $this->qty_wo?$this->qty_wo:0;
        $uom ="'" . $this->uom . "'";
        $grn = "'" . $this->grn . "'";
        $link2assy_wo= "'" . $this->link2assywo . "'";
        $expdate= $this->expdate?"'" . $this->expdate . "'":'0000-00-00';
        $remarks= "'" . $this->remarks . "'";
        $qty_rew =$this->qty_rew?$this->qty_rew:0;
        $qty_rej =$this->qty_rej?$this->qty_rej:0;
        $crn_num4li= "'" . $this->crn_num4li . "'";
        $type="'" . $this->type . "'";
        $qty_ret =$this->qty_ret?$this->qty_ret:0;
        $qty_acc =$this->qty_acc?$this->qty_acc:0;
         $pcrn_num=  "'" . $this->pcrn_num . "'";
         $crn_type=  "'" . $this->crn_type . "'";

        $rmponum=  "'" . $this->rmponum . "'";
        $rmpo_linenum=  "'" . $this->rmpo_linenum . "'";
        $rmpocost=  "'" . $this->rmpocost . "'";

        $qainsp_app=  "'" . $this->qainsp_app . "'";
        $qainsp_appdate=  "'" . $this->qainsp_appdate . "'";
        $qainsp_appby=  "'" . $this->qainsp_appby . "'";


        $sql = "update assywo_li set
                  linenum = $linenum,
                  itemno = $itemno,
                  partnum = $partno,
                  issue = $issue,
                  qty = $qty,
                  qty_wo = $qty_wo,
                  uom  = $uom,
                  grn = $grn,
                  link2assywo = $link2assy_wo,
                  exp_date = $expdate,
                  remarks = $remarks,
                  qty_rew=$qty_rew,
                  qty_rej=$qty_rej,
                  crn_num4li=$crn_num4li,
                  bom_type=$type,
                  qty_ret=$qty_ret,
                  qty_acc=$qty_acc,
                  pcrn_num=  $pcrn_num,
                  crn_type=  $crn_type,
                  pcustponum='$custponum',
                  rmponum= $rmponum,
                  rmpo_linenum= $rmpo_linenum,
                  rmpo_cost= $rmpocost,
                  qaapproved = $qainsp_app,
                  qaapproved_date = $qainsp_appdate,
                  qaapproved_by = $qainsp_appby

               where recnum = $inrecnum";
      //echo $sql;
           $result = mysql_query($sql);

           // Test to make sure query worked
           if(!$result) die("Update to Assy WO Li didn't work..Please report to Sysadmin. " . mysql_error());
     }

    function get_assy_Li($link2assywo)
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select ali.recnum,ali.linenum,ali.itemno,ali.partnum,ali.issue,
                       ali.qty,ali.qty_wo,ali.uom,ali.grn,ali.link2assywo,
                       ali.exp_date,ali.remarks,ali.descr ,ali.qty_rew,ali.qty_rej ,ali.crn_num4li,ali.bom_type,
                       ali.qty_ret,ali.qty_acc,ali.pcrn_num,ali.crn_type,ali.rmponum,ali.rmpo_linenum,
                       ali.rmpo_cost,ali.qaapproved_by,ali.qaapproved_date,ali.ncrnum,ali.cofc_num,
                       ali.supplier_wo
                FROM assywo_li ali
                where ali.link2assywo=$link2assywo
                order by ali.recnum";
       // echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("Access to Assy WO failed...Please report to SysAdmin. " . mysql_error());
       // echo $result;
        return $result;
     }
 function getdnrecnum4assyli($grn)
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select dn.recnum,dn.wonum
                FROM delivery_note dn,delivery_note_li dli
                where dn.recnum=dli.link2delivery
                and dn.wonum = $grn";
       // echo $sql;
        $result = mysql_query($sql);
         if(!$result) die("Access to Assy WO failed...Please report to SysAdmin. " . mysql_error());
        return $result;
             
        
     }

//function to get only BOMs where bomnum=partnum
    function getBOM4parts()
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select b.recnum,b.bomnum, b.bomdate,c.name,b.bomdescr, b.type, b.bomamount
                  from
	                  bom b, company c
                  where
	            c.recnum = b.bom2customer and
                b.bomnum=b.partnum";
        $result = mysql_query($sql);
        if(!$result) die("Access to BOM failed...Please report to SysAdmin. " . mysql_error());
   // echo $result;
        return $result;
     }

    function getBOM_summary($cond,$argoffset,$arglimit)
    {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;

       $sql = "select b.recnum,b.bomnum,b.bom_issue,b.crn,b.assy_partnum
                 from bom b where $wcond limit $offset, $limit";
      //echo "$sql";
       $result = mysql_query($sql);
       return $result;
    }

    function getBOMcount($cond,$argoffset, $arglimit)
    {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;

        $sql = "select count(*) as numrows from bom b
                        where $wcond limit $offset, $limit";
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $result  = mysql_query($sql) or die('BOM count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;

    }


    function getBOMDetails($inpbomrecnum)
    {
        $bomrecnum = "'" . $inpbomrecnum . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select b.bomnum, b.type, b.bomdescr,
                   b.bomdate, b.bomamount,b.status,c.name, e1.fname,e2.fname,b.recnum,b.bom2customer,b.bom2aeowner,
                   b.bom2seowner,b.link2wo,w.wonum,b.link2quote,q.id,e1.lname,e2.lname,b.makebuy,b.workcenter
                     from bom b, company c,employee e1,employee e2
                       left join quote q on
                           b.link2quote = q.recnum
                       left join work_order w on
                           b.link2wo = w.recnum

               where c.recnum = b.bom2customer
                    and   e1.recnum = b.bom2aeowner
	                and  e2.recnum=b.bom2seowner
	                and b.recnum=$bomrecnum";
        $result = mysql_query($sql);
        if(!$result) die("Access to BOM details failed...Please report to SysAdmin. " . mysql_error());
        return $result;

    }

     function ftp_copy($source_file,$destination_file)
     {
	$ftp_server='ftp.fluentsoft.com';
	$ftp_user='bmandyam@fluentsoft.com';
	$ftp_password='dci1034';
	$conn_id=ftp_connect($ftp_server);
	$login_result=ftp_login($conn_id,$ftp_user,$ftp_password);
	if (( !$conn_id ) || ( !$login_result ))
	{
		die("FTP connection Failed");
	}
	$upload=ftp_put($conn_id,$destination_file,$source_file,FTP_BINARY);
	ftp_close($conn_id);
	if(!$upload)
	{
		die("FTP copy has failed");
	}

    }

    function deleteAssyli($assyrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from assywo_li where link2assywo = $assyrecnum";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Assy Li failed...Please report to SysAdmin. " . mysql_error());
      }
     function getassyqty4wo($wonum)
     {
       $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select assy_qty as assyqty from work_order where wonum='$wonum'";
       // echo $sql;
        $result  = mysql_query($sql) or die("getassyqty4wo query for assy li failed". mysql_error());
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $assyqty = $row['assyqty'];
        return $assyqty;
     }

      function getkitqty4dn($dnrecnum)
     {
       $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select kit_qty as kitqty from delivery_note_li where link2delivery='$dnrecnum'";
       // echo $sql;
        $result  = mysql_query($sql) or die("getassyqty4wo query for assy li failed". mysql_error());
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $kitqty = $row['kitqty'];
        return $kitqty;
     }
       function getassyqty4dn($dnrecnum)
     {
       $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select assy_qty as assyqty from delivery_note_li where link2delivery='$dnrecnum'";
       // echo $sql;
        $result  = mysql_query($sql) or die("getassyqty4wo query for assy li failed". mysql_error());
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $assyqtyy = $row['assyqty'];
        return $assyqty;
     }
     
     function getassyqty4kitwo($wonum)
     {
       $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select kit_qty as assyqty from assy_wo where assy_wonum='$wonum'";
       // echo $sql;
        $result  = mysql_query($sql) or die("getassyqty4kitwo query for assy li failed". mysql_error());
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $assyqty = $row['assyqty'];
        return $assyqty;
     }
        function updatework_order($wonum,$assywonum,$assy_qty)
      {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "update work_order set assy_wonum='$assywonum',assy_qty=$assy_qty where wonum='$wonum'";
        // echo $sql;exit;
        $result = mysql_query($sql);
        if(!$result) die("Update for WO failed...Please report to SysAdmin. " . mysql_error());
      }

      function updatedelivery_note4kit($dnrecnum,$assywonum,$assy_qty)
      {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "update delivery_note_li set assy_wonum='$assywonum',kit_qty=$assy_qty where link2delivery='$dnrecnum'";
        // echo $sql;exit;
        $result = mysql_query($sql);
        if(!$result) die("Update for WO failed...Please report to SysAdmin. " . mysql_error());
      }
       function updatedelivery_note($dnrecnum,$assywonum,$assy_qty)
      {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "update delivery_note_li set assy_wonum='$assywonum',assy_qty=$assy_qty where link2delivery='$dnrecnum'";
        // echo $sql."<br>";
        $result = mysql_query($sql);
        if(!$result) die("Update for WO failed...Please report to SysAdmin. " . mysql_error());
      }
      
        function updateassywork_order($assywonum,$assy_qty)
      {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $assy_qty=$assy_qty?$assy_qty:0;
        $sql = "update assy_wo set kit_qty=$assy_qty where assy_wonum='$assywonum'";
        //echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("Update for ASSYWO failed...Please report to SysAdmin. " . mysql_error());
      }
      
       function getassy_qty4wo($wonum)
     {
       $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select sum(ali.qty_wo) as assyqty from assywo_li ali where ali.grn='$wonum'";
       // echo $sql;
        $result  = mysql_query($sql) or die("getassyqty4wo query for assy li failed". mysql_error());
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $assyqty = $row['assyqty'];
        return $assyqty;
     }

      function getassy_qty4dn($wonum)
     {
       $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select sum(ali.qty_wo) as assyqty from assywo_li ali where ali.grn='$wonum'";
       // echo $sql;
        $result  = mysql_query($sql) or die("getassyqty4wo query for assy li failed". mysql_error());
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $assyqty = $row['assyqty'];
        return $assyqty;
     }
function getassyqty4wps($recno)
     {
       $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select qtyused_in_assy as assyqty from wo_part_status where recno='$recno'";
       //  echo $sql;
        $result  = mysql_query($sql) or die("getassyqty4wo query for assy li failed". mysql_error());
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $assyqty = $row['assyqty'];
        return $assyqty;
     }


      function getassy_qty4woret($wonum)
      {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql1 = "select sum(ali.qty_ret) as assyqty from assywo_li ali where ali.grn='$wonum'";
        $result1 = mysql_query($sql1) or die("getassy_qty4wo query for assy li failed". mysql_error());
        $row1    = mysql_fetch_array($result1);
        $assyqty = $row1['assyqty'];

        return $assyqty;
   }
  function getassy_qty4worew($wonum)
      {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql1 = "select sum(ali.qty_rew) as qtyrewval from assywo_li ali where ali.grn='$wonum'";
      $result1 = mysql_query($sql1) or die("getrework quyantity query for assy li failed". mysql_error());
      $row1    = mysql_fetch_array($result1);
      $qtyrewval = $row1['qtyrewval'];
      return $qtyrewval;
    }

      function getassy_qty4worej($wonum)
      {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql1 = "select sum(ali.qty_rej) as qtyrejval from assywo_li ali where ali.grn='$wonum'";
      $result1 = mysql_query($sql1) or die("getrework quyantity query for assy li failed". mysql_error());
      $row1    = mysql_fetch_array($result1);
      $qtyrejval = $row1['qtyrejval'];
      return $qtyrejval;
    }


    function updaterewqtyforwo($grn1, $rewqty)
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql    = "update work_order set rework_qty = $rewqty where wonum = '$grn1' ";
      // echo $sql;exit;
      $result = mysql_query($sql) or die("Unable to update the rework quantity in work order". mysql_error());
            
    }
function updaterejqtyforwo($grn1, $rejqty)
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql    = "update work_order set rej_qty = $rejqty where wonum = '$grn1' ";
      $result = mysql_query($sql) or die("Unable to update the reject quantity in work order". mysql_error());
            
    }
    function updaterejqtyfordn($dnrecnum, $rejqty)
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql    = "update delivery_note_li set rej_qty = $rejqty where link2delivery = '$dnrecnum' ";
      $result = mysql_query($sql) or die("Unable to update the reject quantity in work order". mysql_error());
            
    }

    function updaterewqtyfordn($dnrecnum, $rewqty)
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql    = "update delivery_note_li set rework_qty = $rewqty where link2delivery = '$dnrecnum' ";

      // echo $sql;exit;
      $result = mysql_query($sql) or die("Unable to update the rework quantity in delivery_note_li". mysql_error());
            
    }
   
   function getgrnwoqty($grnnum)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select g.qty_used as qty_used,g.recnum
                from grn g
             where g.grnnum='$grnnum'";

        $result  = mysql_query($sql) or die('getgrnretqty failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $qty_used = $row['qty_used'];
        return $qty_used;
    }

      function getwoqty4grn($grnnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql2 = "select (sum(w.qty)) as qty_used
                       from work_order w where w.`condition` !='WO Cancelled'  and w.grnnum='$grnnum'
                       group by w.grnnum";
        //echo $sql2;
        $result2 = mysql_query($sql2);
        if(!$result2) die("getwoqty4grn failed..Please report to Sysadmin. " . mysql_error());
        $row     = mysql_fetch_array($result2, MYSQL_ASSOC);
        $qty_used = $row['qty_used'];
     // echo "<br>$numrows<br>";
        return $qty_used;
      }

      function updategrn4woqty($qty,$grn)
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $qty=$qty?$qty:0;

       $sql1 = "update grn g
               set g.qty_used=$qty
                where g.grnnum='$grn' ";
                   
         $result1 = mysql_query($sql1);
         if(!$result1)
           {
           die("Update return qty for GRN didn't work..Please report to Sysadmin. " . mysql_error());
           }
    }
     function updateqtyused_grn($qty)
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $qty=$qty?$qty:0;
       $grn = "'" . $this->grn . "'";

       $sql1 = "update grn g
               set g.qty_used=$qty
                where g.grnnum=$grn";
         $result1 = mysql_query($sql1);
         if(!$result1)
           {
           die("Update return qty for GRN didn't work..Please report to Sysadmin. " . mysql_error());
           }
    }

       function updateretqtyfromgrn($grn1, $qty_ret1)
      {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql1      = "Update grn set qty_ret = $qty_ret1 where grnnum = '$grn1' " ;
        $result1    = mysql_query($sql1) or die("Could not update qty_ret for work order in grn table". mysql_error());
      }


    function updateretqtyforwo($grn1, $retqty)
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql    = "update work_order set ret_qty = $retqty where wonum = '$grn1' ";

      // echo $sql;
      $result = mysql_query($sql) or die("Unable to update the return quantity in work order". mysql_error());
            
    }

      
    function updateretqtyfordn($dnrecnum, $retqty)
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql    = "update delivery_note_li set ret_qty = $retqty where link2delivery = '$dnrecnum' ";
      // echo $sql;exit;
      $result = mysql_query($sql) or die("Unable to update the return quantity in work order". mysql_error());
            
    }
function updaterejqtyforbo($grn1,$qty_rej)
      {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql1      = "Update grn set qty_rej = $qty_rej where grnnum = '$grn1' " ;
        $result1    = mysql_query($sql1) or die("Could not update qty_rej for bo in grn table". mysql_error());
      }   

/*
       function updateretqtyfromgrn($grn1, $qty_ret1)
      {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql1      = "Update grn set qty_ret = $qty_ret1 where grnnum = '$grn1' " ;
        $result1    = mysql_query($sql1) or die("Could not update qty_ret for work order in grn table". mysql_error());
      }*/
 
 function addgrnIss4assywo($assywonum,$clbal,$opbal)
 {

     $newlogin = new userlogin;
     $newlogin->dbconnect();
     $wousdqty=$wousdqty?$wousdqty:0;
    $sql = "select nxtnum from seqnum where tablename = 'grn_issue' for update";
    //echo $sql;
    $result = mysql_query($sql);
    $myrow = mysql_fetch_row($result);
    $seqnum = $myrow[0];
    $objid = $seqnum + 1;
    // $opbal = $this->qtm;
    $qty4wo = $this->qty_wo;
    $grnnum= "'". $this->grn ."'";
    $assywonum= "'". $assywonum ."'";
    $condition = "'" . 'Open' . "'";
           
     $sql = "insert into grn_issue( recno,iss_date,opbal,qty4wo,clbal,grnnum,wonum,wo_status) 
                   values($objid,now(),$opbal,$qty4wo,$clbal,$grnnum,$assywonum,$condition)";
                             // echo $sql."<br>";exit;
        $result = mysql_query($sql);
       if(!$result)
      {
        die("insert into grn_issue didn't work..Please report to Sysadmin. " . mysql_error());
       }

     $sql = "update seqnum set nxtnum = $objid where tablename = 'grn_issue'";
     $result = mysql_query($sql);
  if(!$result)
  {
     $sql = "rollback";
     $result = mysql_query($sql);
     die("Seqnum insert for work order didn't work...Please report to Sysadmin. " . mysql_errno());
  }
 }


 function getqtm4grnissassy($grnnum){
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select g.recnum,gli.qty_to_make as qtm,g.qty_used
                from grn g, grn_li gli
             where g.recnum = gli.link2grn and g.grnnum='$grnnum'";
       // echo "<br>$sql";exit;
        $result  = mysql_query($sql) or die('getgrnretqty failed');
        $row= mysql_fetch_array($result, MYSQL_ASSOC);
        $qtm = $row['qtm'];
        return $qtm;
 }


   function getgrnIssue4assywo($wonum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql2 = "select g.clbal
                       from grn_issue g where  g.wonum='$wonum'";
        // echo $sql2;exit;
        $result2 = mysql_query($sql2);
        if(!$result2) die("getclbal4grn failed..Please report to Sysadmin. " . mysql_error());
        $row     = mysql_fetch_row($result2);
        $clbal = $row[0];
     // echo "<br>$ret_qty<br>";exit;
        return $clbal;
      } 

function addgrniss4cancel($clbal,$wonum,$status)
 {
     $newlogin = new userlogin;
     $newlogin->dbconnect();
    $sql = "select nxtnum from seqnum where tablename = 'grn_issue' for update";
    //echo $sql;
    $result = mysql_query($sql);
    $myrow = mysql_fetch_row($result);
    $seqnum = $myrow[0];
    $objid = $seqnum + 1;
    $qty4wo = $this->qty_wo;
    $grnnum = "'". $this->grn."'";
    $condition = "'". $status ."'";
    $clbal1 = $clbal+$qty4wo;
    $opbal =  $clbal;

   
     $sql = "insert into grn_issue( recno,iss_date,opbal,qty4wo,clbal,grnnum,wonum,wo_status) 
                   values($objid,now(),$opbal,$qty4wo,$clbal1,$grnnum,'$wonum',$condition)";
                             // echo $sql."<br>";exit;
        $result = mysql_query($sql);
       if(!$result)
      {
        die("insert into grn_issue didn't work..Please report to Sysadmin. " . mysql_error());
       }

     $sql = "update seqnum set nxtnum = $objid where tablename = 'grn_issue'";
     $result = mysql_query($sql);
  if(!$result)
  {
     $sql = "rollback";
     $result = mysql_query($sql);
     die("Seqnum insert for work order didn't work...Please report to Sysadmin. " . mysql_errno());
  }
 }


} // End Assy Li class definition
