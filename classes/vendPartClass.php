<?

//====================================
// Author: FSI
// Date-written = May 27, 2005
// Filename: vendPartClass.php
// Maintains the class for Vendor Parts
// Revision: v1.0
//====================================

include_once('loginClass.php');

class vendPart {

    var $partnum,
        $mfr_partnum,
        $digikey_partnum,
        $serial,
        $mfr,
        $rate,
        $min_qty,
        $lead_time,
        $lead_unit,
        $part_desc,
        $value,
        $inventory_cnt,
        $link2vendor,
        $ptype,
        $partiss,
        $drgno,
        $drgiss,
        $ref_type,
        $ref_num,
        $type1,
        $inv_date,
        $inv_num,
        $rece_date,
        $qty,
        $inv_value,
        $crn,
        $mc_name,
        $status,
        $clbal,
        $receby;

    // Constructor definition

    function vendPart() {
        $this->partnum = '';
        $this->mfr_partnum = '';
        $this->digikey_partnum = '';
        $this->serial = '';
        $this->mfr = '';
        $this->rate = '';
        $this->lead_time = '';
        $this->lead_unit = '';
        $this->value = '';
        $this->inventory_cnt = '';
        $this->link2vendor = '';
        $this->min_qty = '';
        $this->part_desc = '';
        $this->ptype = '';
        $this->partiss = '';
        $this->drgno = '';
        $this->drgiss = '';
        $this->ref_num = '';
        $this->ref_type = '';
        $this->type1 = '';
        $this->inv_date = '';
        $this->inv_num = '';
        $this->rece_date = '';
        $this->rece_by = '';
        $this->qty = '';
        $this->inv_value = '';
        $this->crn = '';
        $this->mc_name = '';
        $this->status = '';
        $this->clbal = '';

    }

    function getpartnum () {
           return $this->partnum;
    }
    function setpartnum ($reqpartnum) {
           $this->partnum = $reqpartnum;
    }

    function getdigikey_partnum () {
           return $this->digikey_partnum;
    }
    function setdigikey_partnum ($reqdigikey_partnum) {
           $this->digikey_partnum = $reqdigikey_partnum;
    }

    function getmfr_partnum () {
           return $this->mfr_partnum;
    }
    function setmfr_partnum ($reqmfr_partnum) {
           $this->mfr_partnum = $reqmfr_partnum;
    }

    function getserial () {
           return $this->serial;
    }
    function setserial ($reqserial) {
           $this->serial = $reqserial;
    }
    function getmfr () {
           return $this->mfr;
    }
    function setmfr ($reqmfr) {
           $this->mfr = $reqmfr;
    }
    function getrate () {
           return $this->rate;
    }
    function setrate ($reqrate) {
           $this->rate = $reqrate;
    }
    function getlead_time () {
           return $this->lead_time;
    }
    function setlead_time ($reqlead_time) {
           $this->lead_time = $reqlead_time;
    }
    function getlead_unit () {
           return $this->lead_unit;
    }
    function setlead_unit ($reqlead_unit) {
           $this->lead_unit = $reqlead_unit;
    }
    function getvalue () {
           return $this->value;
    }
    function setvalue ($reqvalue) {
           $this->value = $reqvalue;
    }
    function getinventory_cnt () {
           return $this->inventory_cnt;
    }
    function setinventory_cnt ($reqinventory_cnt) {
           $this->inventory_cnt = $reqinventory_cnt;
    }
    function getlink2vendor () {
           return $this->link2vendor;
    }
    function setlink2vendor ($reqlink2vendor) {
           $this->link2vendor = $reqlink2vendor;
    }

    function getmin_qty () {
           return $this->min_qty;
    }
    function setmin_qty ($reqmin_qty) {
           $this->min_qty = $reqmin_qty;
    }
    function getpart_desc () {
           return $this->part_desc;
    }
    function setpart_desc ($reqpart_desc) {
           $this->part_desc = $reqpart_desc;
    }
    function gettype () {
           return $this->type;
    }
    function setptype ($reqptype) {
           $this->ptype = $reqptype;
    }
    function getpartiss() {
           return $this->partiss;
    }
    function setpart_iss($reqprtiss) {
           $this->partiss = $reqprtiss;
    }
    function getdrgno() {
           return $this->drgno;
    }
    function setdrg_no($reqdrgno) {
           $this->drgno = $reqdrgno;
    }
    function getdrgiss() {
           return $this->drgiss;
    }
    function setdrg_iss($reqdrgiss) {
           $this->drgiss = $reqdrgiss;
    }

    function getref_num() {
           return $this->ref_num;
    }
    function setref_num($reqref_num) {
           $this->ref_num = $reqref_num;
    }
        function getref_type() {
           return $this->reft_ype;
    }
    function setref_type($reqref_type) {
           $this->ref_type = $reqref_type;
    }
        function getqty() {
           return $this->qty;
    }
    function setqty($reqqty) {
           $this->qty = $reqqty;
    }

        function gettype1() {
           return $this->type1;
    }
    function settype1($reqtype1) {
           $this->type1 = $reqtype1;
    }

        function getinv_date() {
           return $this->inv_date;
    }
    function setinv_date($reqinv_date) {
           $this->inv_date = $reqinv_date;
    }

        function getinv_num() {
           return $this->inv_num;
    }
    function setinv_num($reqinv_num) {
           $this->inv_num = $reqinv_num;
    }

        function getrece_date() {
           return $this->rece_date;
    }
    function setrece_date($reqrece_date) {
           $this->rece_date = $reqrece_date;
    }

        function getrece_by() {
           return $this->rece_by;
    }
    function setrece_by($reqrece_by) {
           $this->rece_by = $reqrece_by;
    }
       function getinv_value() {
           return $this->inv_value;
    }
    function setinv_value($reqinv_value) {
           $this->inv_value = $reqinv_value;
    }
     function getcrn() {
           return $this->crn;
    }
    function setcrn($reqcrn) {
           $this->crn = $reqcrn;
    }
       function getmc_name() {
           return $this->mc_name;
    }
    function setmc_name($reqmc_name) {
           $this->mc_name = $reqmc_name;
    }
     function getstatus() {
           return $this->status;
    }
    function setstatus($reqstatus) {
           $this->status = $reqstatus;
    }
     function getclbal() {
           return $this->clbal;
    }
    function setclbal($reqclbal) {
           $this->clbal = $reqclbal;
    }

 function addPart()
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);

        $sql = "select nxtnum from seqnum where tablename = 'vend_part_master' for update";
        $result = mysql_query($sql);

        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);

        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $partnum = "'" . $this->partnum . "'";
        $mfr_partnum = "'" . $this->mfr_partnum . "'";
        $digikey_partnum = "'" . $this->digikey_partnum . "'";
        $serial ="'" . $this->serial . "'";
        $mfr = "'" . $this->mfr . "'";
        $rate = $this->rate;
        $min_qty = $this->min_qty;
        $lead_time=$this->lead_time;
        $lead_unit= "'" . $this->lead_unit . "'";
        $part_desc= "'" . $this->part_desc . "'";
        $value= "'" . $this->value . "'";
        $inventory_cnt= $this->inventory_cnt;
        $link2vendor=$this->link2vendor;
        $ptype= "'" . $this->ptype . "'";
        $drgnum= "'" . $this->drgno . "'";
        $drgiss= "'" . $this->drgiss . "'";
        $partiss= "'" . $this->partiss . "'";
        $siteid= "'" . $_SESSION['siteid']. "'";

        $sql = "select * from vend_part_master where partnum = $partnum";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result)))
           {
            $sql = "INSERT INTO
		      vend_part_master (recnum, partnum, mfr_partnum , digikey_partnum,serial, mfr, rate,min_qty,lead_time,lead_unit,part_desc,value,inventory_cnt,link2vendor,create_date,ptype,part_iss,drg_no,drg_iss,siteid)
                  VALUES
		          ($objid, $partnum, $mfr_partnum,$digikey_partnum,$serial, $mfr,$rate,$min_qty,$lead_time,$lead_unit,$part_desc,$value,0,$link2vendor,curdate(),$ptype,$partiss,$drgnum,$drgiss,$siteid)";
//echo "$sql";
              $result = mysql_query($sql);

        // Test to make sure query worked
         if(!$result) die("Vend part insert query didn't work for vend_part_master..Please report to Sysadmin. " . mysql_error());
           }
            else
            {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Partnum " . $partnum . " already exists. ");
            echo "</td></tr></table>";
            }
        $sql = "update seqnum set nxtnum = $objid where tablename = 'vend_part_master'";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work for vend_part_master..Please report to Sysadmin. " . mysql_error());
        $sql = "commit";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Commit failed for vend_part_master Insert..Please report to Sysadmin. " . mysql_error());
        return $objid;
     }

    function updatePart($inppartrecnum) {
        $partrecnum =$inppartrecnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $partnum = "'" . $this->partnum . "'";
        $mfr_partnum = "'" . $this->mfr_partnum . "'";
        $digikey_partnum = "'" . $this->digikey_partnum . "'";
        $serial ="'" . $this->serial . "'";
        $mfr = "'" . $this->mfr . "'";
        $rate = $this->rate;
        $min_qty = $this->min_qty;
        $lead_time=$this->lead_time;
        $lead_unit= "'" . $this->lead_unit . "'";
        $part_desc= "'" . $this->part_desc . "'";
        $value= "'" . $this->value . "'";
        $inventory_cnt= $this->inventory_cnt;
        $link2vendor=$this->link2vendor;
        $ptype= "'" . $this->ptype . "'";
        $drgnum= "'" . $this->drgno . "'";
        $drgiss= "'" . $this->drgiss . "'";
        $partiss= "'" . $this->partiss . "'";

        $sql = "UPDATE vend_part_master SET
	              partnum =$partnum,
                              mfr_partnum = $mfr_partnum,
                              digikey_partnum = $digikey_partnum,
                              serial = $serial,
                              mfr = $mfr,
                              rate = $rate,
                              min_qty = $min_qty,
                              lead_time = $lead_time,
	                          lead_unit=$lead_unit,
	                          part_desc= $part_desc,
	                          value=$value,
	                          inventory_cnt=$inventory_cnt,
	                          link2vendor=$link2vendor,
	                          ptype=$ptype,
	                          part_iss=$partiss,
	                          drg_no=$drgnum,
	                          drg_iss=$drgiss
                   WHERE
	             recnum = $partrecnum";
          $result = mysql_query($sql);
           //   echo "$sql<br>";
           // Test to make sure query worked
           if(!$result) die("Update to vend_part_master didn't work..Please report to Sysadmin. " . mysql_error());

     }


     function getParts($vendrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT
		 p.*,c.name
                   FROM
                   vend_part_master p, company c
                   WHERE
		           c.recnum = p.link2vendor  and
                   p.link2vendor=" . $vendrecnum;
//echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Access to vend_part_master failed...Please report to SysAdmin. " . mysql_error());
        return $result;
     }

//9-11-2006 bom2parts
     function getbom2Parts() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
        $siteval = "siteid = '".$siteid."'";
        $sql = "SELECT
		           b.*
                   FROM bom b where $siteval";
        // echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Access to vend_part_master failed...Please report to SysAdmin. " . mysql_error());
        return $result;
     }

//1-12-2006 function for whereusedparts

     function whereusedparts($partrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT  distinct bomnum,bomdescr
                FROM bom b,bom_line_items bli, vend_part_master p
                where bli.link2parts = p.recnum and
                      bli.link2bom = b.recnum and
                      p.recnum=" . $partrecnum;
       //echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Access to vend_part_master failed...Please report to SysAdmin. " . mysql_error());
        return $result;
     }

    function getPartsort($cond,$argsort1,$argoffset,$arglimit)
    {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder = $argsort1;
      //  if($sortorder=='')
        $siteid = $_SESSION['siteid'];
        $siteval = "v.siteid ='".$siteid."'";
            $sortorder=$argsort1;

       $sql = "SELECT
		 v.*,c.name
                  FROM
		vend_part_master v, company c
                  WHERE
		$wcond and c.recnum = v.link2vendor and 
    $siteval
	  ORDER BY
		 $sortorder limit $offset, $limit";
// echo "$sql";
       $result = mysql_query($sql);
       return $result;
    }

//6-12-2006 function for Report
function Partsort4Report($cond,$argsort1,$argoffset,$arglimit)
    {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder = $argsort1;
        if($sortorder=='')
            $sortorder=$argsort1;

       $sql = "SELECT
		 v.*,c.name
                  FROM
		vend_part_master v, company c
                  WHERE
		$wcond and c.recnum = v.link2vendor and
		v.inventory_cnt < v.min_qty

      ORDER BY
		 $sortorder limit $offset, $limit";
//echo "$sql";
       $result = mysql_query($sql);
       return $result;
    }

    function getPartcount($cond,$argoffset, $arglimit)
    {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $siteid = $_SESSION['siteid'];
        $siteval = "v.siteid ='".$siteid."'";
        $sql = "SELECT
	               count(*) as numrows
	   FROM
	              vend_part_master v, company c
                   WHERE
	              $wcond and c.recnum = v.link2vendor and $siteval";
//echo "$sql";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $result  = mysql_query($sql) or die(' Vend Part count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;

}


    function getPartDetails($inppartrecnum)
    {
        $partrecnum =$inppartrecnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT
		 b.*,c.name
                   FROM
		 vend_part_master b, company c
                   WHERE
		 c.recnum = b.link2vendor
	       and b.recnum=$partrecnum";
	    // echo $sql;exit;
        $result = mysql_query($sql);
        if(!$result) die("Access to vend_part_master details failed...Please report to SysAdmin. " . mysql_error());
        return $result;
    }
    function getPart()
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
        $siteval = "v.siteid = '".$siteid."'";
        $sql = "SELECT v.partnum,v.part_iss,v.part_desc,v.drg_no,v.drg_iss,c.name
                from vend_part_master v,company c
                where c.recnum=v.link2vendor and $siteval";
	    // echo $sql; 
        $result = mysql_query($sql);
        if(!$result) die("Access to vend_part_master details failed...Please report to SysAdmin. " . mysql_error());
        return $result;
    }
    
    function increaseInv($qty)
    {
        $partrecnum=$_SESSION['partrecnum'];
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT inventory_cnt FROM vend_part_master WHERE recnum=$partrecnum";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $qty=$myrow[0]+$qty;
        $sql = "UPDATE vend_part_master SET inventory_cnt=$qty WHERE recnum=$partrecnum";
        $result = mysql_query($sql);
        if(!$result) die("Access to vend_part_master details failed...Please report to SysAdmin. " . mysql_error());
        return $result;

    }
 function decreaseInv($qty)
    {
        $partrecnum=$_SESSION['partrecnum'];
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT inventory_cnt FROM vend_part_master WHERE recnum=$partrecnum";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $qty=$myrow[0]-$qty;
        $sql = "UPDATE vend_part_master SET inventory_cnt=$qty WHERE recnum=$partrecnum";
        $result = mysql_query($sql);
        if(!$result) die("Access to vend_part_master details failed...Please report to SysAdmin. " . mysql_error());
        return $result;
       }

 function addinventory()
 {
        $ref_type="'" . $this->ref_type . "'";
        $ref_num="'" . $this->ref_num . "'";
        $type1= $this->type1 ;
        $inv_date="'" . $this->inv_date . "'";
        $inv_num="'" . $this->inv_num . "'";
        $rece_date="'" . $this->rece_date . "'";
        $rece_by="'" . $this->rece_by . "'";
        $inv_value="'" . $this->inv_value . "'";
        $crn="'" . $this->crn . "'";
        $mc_name="'" . $this->mc_name . "'";
        $status="'" . $this->status . "'";
        $cl_date="'" . $this->cl_date . "'";
        $qty= $this->qty ;
        $partrecnum=$_SESSION['partrecnum'];
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'inventory'";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];

        $objid = $seqnum + 1;
        $sql = "select inventory_cnt from vend_part_master where recnum = $partrecnum";
        // echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("Inventory cnt access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $invcnt = $myrow[0];
        $opbal = $invcnt;



// echo $type1;exit;
       if ($type1 == 'Receipts')
        {
     
            $clbal = $invcnt + $qty;
       
        }
        else if($type1 == 'Issues' && $invcnt >0)
        {
            $clbal = $invcnt - $qty;
        
         }
          $type1="'". $this->type1."'" ;
 
      
       $sql = "INSERT INTO
       inventory (recnum,type,qty,ref_type,ref_num,link2vendpart,create_date,invoice_date,invoice_no,receive_date,received_by,opbal,clbal,invoice_value,crn,mc_name,status,closing_date)
                          VALUES
      ($objid,$type1,$qty,$ref_type,$ref_num,$partrecnum,curdate(),$inv_date,$inv_num,$rece_date,$rece_by,$opbal,$clbal,$inv_value,$crn,$mc_name,$status,$cl_date)";

// echo $sql;exit;
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Vend part insert query didn't work for Inventory..Please report to Sysadmin. " . mysql_error());

        $sql = "UPDATE seqnum SET nxtnum = $objid WHERE tablename = 'inventory'";
        $result = mysql_query($sql);
        $sql = "commit";
        $result = mysql_query($sql);

        // Test to make sure query worked
      if(!$result) die("Seqnum insert query didn't work for equip_part_master..Please report to Sysadmin. " . mysql_error());

}

function getInventory($recnum)
  {
  $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select 
                i.recnum,
                i.receive_date,
                i.type,
                i.qty,
                i.ref_num,
                i.ref_type,
                i.invoice_date,
                i.invoice_no,
                i.clbal,
                i.create_date,
                i.received_by,
                i.invoice_value,
                i.crn,
                i.mc_name,
                i.status,
                i.closing_date
                from inventory i
                where
                i.link2vendpart = $recnum order by create_date";
    

      // echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("Access to Inventory failed...Please report to SysAdmin. " . mysql_error());
        return $result;
  }





  function getInventoryIssues($recnum)
  {
  $newlogin = new userlogin;
  $newlogin->dbconnect();
        $sql = "select 
                i.recnum,
                i.receive_date,
                i.type,
                i.qty,
                i.ref_num,
                i.ref_type,
                i.invoice_date,
                i.invoice_no,
                i.clbal,
                i.create_date,
                i.received_by,
                i.invoice_value,
                i.crn,
                i.mc_name,
                i.status,
                i.closing_date
                from inventory i
                where
                i.recnum = $recnum order by create_date";
    

      // echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("Access to Inventory failed...Please report to SysAdmin. " . mysql_error());
        return $result;
  }

    function updateinventory($recnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $ref_type="'" . $this->ref_type . "'";
        $ref_num="'" . $this->ref_num . "'";
        $type1="'". $this->type1."'" ;
        $rece_by="'" . $this->rece_by . "'";
        $crn="'" . $this->crn . "'";
        $mc_name="'" . $this->mc_name . "'";
        $status= $this->status;
        $clbal = $this->clbal;
        $qty= $this->qty ;
        $date ="'" . date('Y-m-d') . "'"; 

       
      if($status == 'Active')
{

  $status = "'". $this->status."'";
   $clbal = $qty + $clbal;

        $sql = "UPDATE inventory SET
                ref_type =$ref_type,
                              ref_num = $ref_num,
                              type = $type1,
                              received_by = $rece_by,
                              qty=$qty,
                              crn = $crn,
                              mc_name = $mc_name,
                           
                              status = $status,
                            clbal=$clbal,
                            closing_date = $date
                            
                   WHERE
               recnum = $recnum";
               // echo $sql;exit;
          $result = mysql_query($sql);


        }else 
        {

  $status = "'". $this->status."'";

   $sql = "UPDATE inventory SET
                ref_type =$ref_type,
                              ref_num = $ref_num,
                              type = $type1,
                              received_by = $rece_by,
                              qty=$qty,
                              crn = $crn,
                              mc_name = $mc_name,
                             status = $status,
                            clbal=$clbal,
                            closing_date = $date
                            
                   WHERE
               recnum = $recnum";
               // echo $sql;exit;
          $result = mysql_query($sql);
       }
           //   echo "$sql<br>";
           // Test to make sure query worked
           if(!$result) die("Update to vend_part_master didn't work..Please report to Sysadmin. " . mysql_error());

     }
} // End Part class definition
