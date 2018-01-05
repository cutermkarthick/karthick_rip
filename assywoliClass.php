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
        $type,$qty_ret,$qty_acc,$pcrn_num,$crn_type;

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


     function getnc_num() {
           return $this->nc_num;
    }

    function setnc_num($nc_num) {
           $this->nc_num = $nc_num;
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
         $sql = "INSERT INTO
		  	          assywo_li(linenum, itemno, partnum, issue, qty, qty_wo,uom,grn,
                      link2assywo,exp_date,remarks,descr,crn_num4li,bom_type,qty_ret,qty_acc,pcrn_num,crn_type,pcustponum)
                         VALUES
			         ($linenum, $itemno, $partno, $issue,$qty,$qty_wo,$uom,$grn,
                      $link,$expdate,$remarks,$descr,$crn_num4li,$type,$qty_ret,$qty_acc,$pcrn_num,$crn_type,'$cust_ponum')";
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
                   pcustponum='$custponum'
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
                       ali.qty_ret,ali.qty_acc,ali.pcrn_num,ali.crn_type
                FROM assywo_li ali
                where ali.link2assywo=$link2assywo
                order by ali.recnum";
       // echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("Access to Assy WO failed...Please report to SysAdmin. " . mysql_error());
       // echo $result;
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
        function updatework_order($wonum,$assywonum,$assy_qty)
      {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "update work_order set assy_wonum='$assywonum',assy_qty=$assy_qty where wonum='$wonum'";
        echo $sql;exit;
        $result = mysql_query($sql);
        if(!$result) die("Update for WO failed...Please report to SysAdmin. " . mysql_error());
      }


} // End Assy Li class definition
