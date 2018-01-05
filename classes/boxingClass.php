<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: dispatchClass.php
// Application: WMSgetBoxDetails
// Revision: v1.0
//====================================

include_once('loginClass.php');

class boxing {

    var $ponum,
        $partnum,
        $wonum;



    // Constructor definition
    function boxing() {
    
        $this->ponum = '';
        $this->partnum = '';
        $this->batchno = '';
    }

    // Property get and set
    function getponum() {
           return $this->ponum;
    }

    function setponum ($reqponum) {
           $this->ponum= $reqponum;
    }
    function getpartnum() {
           return $this->partnum;
    }

    function setpartnum ($reqpart) {
           $this->partnum = $reqpart;
    }
    function getbatchno() {
           return $this->batchno;
    }

    function setbatchno($reqbatch) {
           $this->batchno = $reqbatch;
    }
    function getbox() {
           return $this->box;
    }

    function setbox($reqbox) {
           $this->box = $reqbox;
    }

    function getqty() {
           return $this->qty;
    }
    function setqty($reqqty) {
           $this->qty = $reqqty;
    }
    function getpsn() {
           return $this->psn;
    }
    function setpsn ($reqpsn) {
           $this->psn = $reqpsn;
    }
    
     function getwo() {
           return $this->wonum;
    }
    function setwo($reqwo) {
           $this->wonum = $reqwo;
    }
    
    function getcofc() {
           return $this->cofc;
    }
    function setcofc($reqcofc) {
           $this->cofc = $reqcofc;
    }

   function addBox() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $po="'" . $this->ponum . "'" ;
        $batch="'" . $this->batchno . "'";
        $part="'" . $this->partnum . "'";
        $box="'" . $this->box . "'";
        $qty="'" . $this->qty . "'";
        $psn="'" . $this->psn . "'";
        $wo="'" . $this->wonum . "'";
        $cofc="'" . $this->cofc . "'";
        
        $sql = "INSERT INTO box (box,
                                 psn,
                                 ponum,
                                 qty,
                                 batchnum,
                                 wonum,
                                 partnum,
                                 cofc)
                        VALUES ($box,
                                $psn,
                                $po,
                                $qty,
                                $batch,
                                $wo,
                                $part,
                                $cofc)";
           //echo "$sql";
          $result = mysql_query($sql);
          // Test to make sure query worked
          if(!$result) die("Insert to Box didn't work..Please report to Sysadmin. " . mysql_error());
          
        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for Box Insert..Please report to Sysadmin. " . mysql_error());
        //return $objid;
     }

   function updateBox($boxrecnum)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        
        $po="'" . $this->ponum . "'" ;
        $batch="'" . $this->batchno . "'";
        $part="'" . $this->partnum . "'";
        $box="'" . $this->box . "'";
        $qty="'" . $this->qty . "'";
        $psn="'" . $this->psn . "'";
        $wo="'" . $this->wonum . "'";

        $sql = "update box set box = $box,
                                psn = $psn,
                                ponum = $po,
                                qty = $qty,
                                batchnum = $batch,
                                wonum = $wo,
                                partnum =$part
                              where recnum=$boxrecnum";
          // echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to Box didn't work..Please report to Sysadmin. " . mysql_error());

     }
     
	function getCofcs_bk($cond,$argoffset,$arglimit)
    {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $offset = $argoffset;
         $limit = $arglimit;
         $sql = "select d.relnotenum,d.disp_date,dli.dispatch_qty,
		                         dli.custpo_num,dli.partnum,d.crn,b.wonum as bw,dli.wonum,                    
								 b.box,b.qty               
		               from dispatch d,                  
		                       dispatch_line_items dli 
				               left join box b on (dli.wonum=b.wonum)                
		               where d.recnum=dli.link2dispatch                 
		                            and $cond                 
		               order by d.disp_date, d.relnotenum, dli.wonum
                       limit $offset, $limit";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("get Cofc for Box failed..Please report to Sysadmin. " . mysql_error());
        return $result;
    }

	function getCofcs($cond,$argoffset,$arglimit)
    {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $offset = $argoffset;
         $limit = $arglimit;
         $sql = "(select d.relnotenum as dlrelnote,d.disp_date as ddate,dli.dispatch_qty,
		                         dli.custpo_num,dli.partnum,d.crn,b.wonum as bw,
								 dli.wonum as dliwo,                    
								 b.box,b.qty,d.recnum  as drec         
		               from dispatch_line_items dli ,
					            dispatch d,
								box b
		               where d.recnum=dli.link2dispatch and
					              d.relnotenum=b.cofc and
								  dli.wonum = b.wonum and
								  d.status = 'Open' and
		                           $cond)
					   UNION
					   (select d.relnotenum as dlrelnote,d.disp_date as ddate,dli.dispatch_qty,
		                         dli.custpo_num,dli.partnum,d.crn,b.wonum as bw,
								 dli.wonum as dliwo,                   
								 b.box,b.qty, d.recnum as drec              
		               from dispatch_line_items dli ,
					            dispatch d
								left join box b on b.cofc = d.relnotenum
		               where d.recnum=dli.link2dispatch and
					               b.cofc is NULL and
								   d.status = 'Open' and
		                           $cond)              
		               order by drec, dliwo
                       limit $offset, $limit";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("get Cofc for Box failed..Please report to Sysadmin. " . mysql_error());
        return $result;
    }
    
    function getcofccount($cond,$argoffset,$arglimit)
    {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sql = "select count(*) as numrows                              
		               from dispatch_line_items dli ,
					            dispatch d,
								box b
		               where d.recnum=dli.link2dispatch and
					              d.relnotenum=b.cofc and
								  dli.wonum = b.wonum and
								  d.status = 'Open' and
		                           $cond";
		//echo $sql;
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $result  = mysql_query($sql) or die('Box count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows1 = $row['numrows'];
	  // echo "here:";
	     $sql = "select count(*) as numrows     
		               from dispatch_line_items dli ,
					            dispatch d
								left join box b on b.cofc = d.relnotenum
		               where d.recnum=dli.link2dispatch and
					               b.cofc is NULL and
								   d.status = 'Open' and
		                           $cond";
	    //echo $sql;
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $result  = mysql_query($sql) or die('Box count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows2 = $row['numrows'];
		$numrows = $numrows1+$numrows2;
        return $numrows;

   }
     
     function updated_box_psn($psn,$box)
	 {
         $psn="PSN".$psn;
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "update box set psn='$psn' where box='$box'";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("update BOX for PSN failed..Please report to Sysadmin. " . mysql_error());
        //return $result;
     }

     function getcofc4boxing($cofc)
    {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select d.relnotenum,d.disp_date,dli.dispatch_qty,
                        dli.wonum,dli.custpo_num,dli.partnum,dli.batchNo,dli.psn,d.crn from dispatch d,
                  dispatch_line_items dli
                  where d.recnum=dli.link2dispatch
                        and d.relnotenum='$cofc'
                  order by d.relnotenum";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("get Cofc for Boxing failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }
     
     function getBoxDetails($cofc)
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select b.recnum,b.box,b.psn,dli.custpo_num,b.qty,dli.batchNo,b.wonum,dli.partnum,b.cofc,d.crn
                      from box b,dispatch d,dispatch_line_items dli
                       where b.cofc='$cofc'                         
					   and b.wonum=dli.wonum                       
					   and d.recnum=dli.link2dispatch                   
					   group by b.recnum";
        //echo "$sql";
       $result = mysql_query($sql);
       if(!$result) die("get Box details failed..Please report to Sysadmin. " . mysql_error());
       return $result;
     }
     
     function getPrevBox($cofc,$wo)
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select b.qty,b.box,b.wonum from box b
               where b.cofc='$cofc'                 
			   and b.wonum='$wo'";
        //echo "$sql";
       $result = mysql_query($sql);
       if(!$result) die("get Prev Box details failed..Please report to Sysadmin. " . mysql_error());
       return $result;
     }
     
 } //end of class defination
