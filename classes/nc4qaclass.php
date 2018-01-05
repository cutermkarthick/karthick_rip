<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: quoteClass.php
// Maintains the class for Quotes
// Revision: v1.0
//====================================

include_once('loginClass.php');

class nc4qa {

    var   $refnum,
          $customer,
          $partname,
          $bachnum,
          $partnum,
          $matl_spec,
          $issues_ps,
          $qty,
          $ponum,
          $part_sl_num,
          $wonum,
          $dcnum,
          $dcdate,
          $traceability_recnum,
          $dim_deviation,
          $man,
          $inprocess,
          $mat_deviation,
          $machine,
          $final_insp,
          $other_deviation,
          $method,
          $cust_end,
          $description,
          $root_cause,
          $corrective_action,
          $preventive_action,
          $effectiveness,
          $cofcnum,
          $create_date,
          $super_name,
          $oper_name,
          $cust_nc_no,
          $cust_ncdate,
          $remarks,
		  $rm_cost,
		  $currency,
		  $status,
          $accepted,
          $rejected,
          $quarantined,
		  $rework,
		$source,
          $wotype,
          $dnnum,
		  $stagenum,
		  $mc_name,
		  $created_by;


    // Constructor definition
    function nc4qa() {
        $this->refnum = '';
        $this->customer = '';
        $this->partname = '';
        $this->bachnum = '';
        $this->partnum = '';
        $this->matl_spec = '';
        $this->issues_ps = '';
        $this->qty = '';
        $this->ponum = '';
        $this->part_sl_num = '';
        $this->wonum = '';
        $this->dcnum = '';
        $this->dcdate = '';
        $this->cofcnum = '';
        $this->traceability_recnum = '';
        $this->dim_deviation= '';
        $this->man= '';
        $this->inprocess= '';
        $this->mat_deviation = '';
        $this->machine= '';
        $this->final_insp= '';
        $this->other_deviation= '';
        $this->method= '';
        $this->cust_end= '';
        $this->description= '';
        $this->root_cause= '';
        $this->corrective_action= '';
        $this->preventive_action= '';
        $this->effectiveness= '';
        $this->create_date= '';
        $this->super_name= '';
        $this->oper_name= '';
        $this->cust_nc_no= '';
        $this->cust_ncdate= '';
        $this->remarks= '';
		$this->rm_cost= '';
		$this->currency= '';
		$this->status = '';
		$this->accepted = '';
		$this->rejected = '';
		$this->quarantined = '';
		$this->rework = '';
		$this->wotype = '';
		$this->dnnum = '';
		$this->stagenum = '';
		$this->mc_name='';
		$this->created_by='';
		$this->source='';

    }

    // Property get and set

   function setsource($source)
	{
		$this->source = $source;
	}
function getsource()
{
	return $this->source;
}
    function getrefnum() {
           return $this->refnum;
    }

    function setrefnum ($refnum) {
           $this->refnum = $refnum;
    }

    function getcustomer() {
           return $this->customer;
    }

    function setcustomer ($customer) {
           $this->customer = $customer;
    }
    function getpartname() {
           return $this->partname;
    }

    function setpartname ($partname) {
           $this->partname = $partname;
    }

    function getbachnum() {
           return $this->bachnum;
    }

    function setbachnum ($bachnum) {
           $this->bachnum = $bachnum;
    }

    function getpartnum() {
           return $this->partnum;
    }

    function setpartnum ($partnum) {
           $this->partnum = $partnum;
    }

    function getmatl_spec() {
           return $this->matl_spec;
    }

    function setmatl_spec ($matl_spec) {
           $this->matl_spec = $matl_spec;
    }

    function getissues_ps() {
           return $this->issues_ps;
    }

    function setissues_ps ($issues_ps) {
           $this->issues_ps = $issues_ps;
    }

    function getqty() {
           return $this->qty;
    }

    function setqty ($qty) {
           $this->qty = $qty;
    }
    function getponum() {
           return $this->ponum;
    }

    function setponum ($ponum) {
           $this->ponum= $ponum;
    }
    function getpart_sl_num() {
           return $this->part_sl_num;
    }

    function setpart_sl_num ($part_sl_num) {
           $this->part_sl_num = $part_sl_num;
    }
    function getwonum() {
           return $this->wonum;
    }

    function setwonum ($wonum) {
           $this->wonum = $wonum;
    }
    function getdcnum() {
           return $this->dcnum;
    }

    function setdcnum ($dcnum) {
           $this->dcnum = $dcnum;
    }
    function getdcdate() {
           return $this->dcdate;
    }

    function setdcdate ($dcdate) {
           $this->dcdate = $dcdate;
    }
    function getcreate_date() {
           return $this->create_date;
    }

    function setcreate_date ($crdate) {
           $this->create_date = $crdate;
    }

    function gettraceability_recnum() {
           return $this->traceability_recnum;
    }

    function settraceability_recnum ($traceability_recnum) {
           $this->traceability_recnum = $traceability_recnum;
    }

    function getdim_deviation() {
           return $this->dim_deviation;
    }

    function setdim_deviation ($dim_deviation) {
           $this->dim_deviation = $dim_deviation;
    }

    function getman() {
           return $this->man;
    }

    function setman ($man) {
           $this->man = $man;
    }

    function getinprocess() {
           return $this->inprocess;
    }

    function setinprocess ($inprocess) {
           $this->inprocess = $inprocess;
    }

    function getmat_deviation() {
           return $this->mat_deviation;
    }

    function setmat_deviation ($mat_deviation) {
           $this->mat_deviation = $mat_deviation;
    }
    function getmachine() {
           return $this->machine;
    }

    function setmachine ($machine) {
           $this->machine = $machine;
    }

    function getfinal_insp() {
           return $this->final_insp;
    }

    function setfinal_insp ($final_insp) {
           $this->final_insp = $final_insp;
    }

    function getother_deviation() {
           return $this->other_deviation;
    }

    function setother_deviation ($other_deviation) {
           $this->other_deviation = $other_deviation;
    }

    function getmethod() {
           return $this->method;
    }

    function setmethod ($method) {
           $this->method = $method;
    }
    function getcust_end() {
           return $this->cust_end;
    }

    function setcust_end ($cust_end) {
           $this->cust_end = $cust_end;
    }
    function getdescription() {
           return $this->description;
    }

    function setdescription ($description) {
           $this->description = $description;
    }
    function getroot_cause() {
           return $this->root_cause;
    }

    function setroot_cause ($root_cause) {
           $this->root_cause = $root_cause;
    }
    function setcorrective_action($corrective_action) {
           $this->corrective_action = $corrective_action;
    }
    function getcorrective_action() {
           $this->corrective_action = $corrective_action;
    }
    function setpreventive_action($preventive_action) {
           $this->preventive_action = $preventive_action;
    }
    function getpreventive_action() {
           $this->preventive_action = $preventive_action;
    }

    function geteffectiveness() {
           return $this->effectiveness;
    }

    function seteffectiveness($effectiveness) {
           $this->effectiveness = $effectiveness;
    }
    function getcofcnum() {
           return $this->cofcnum;
    }

    function setcofcnum($cofcnum) {
           $this->cofcnum = $cofcnum;
    }
    function setsuper($supername) {
           $this->super_name = $supername;
    }
    function setoper($opername) {
           $this->oper_name = $opername;
    }
    
    function setcust_nc($custncno) {
           $this->cust_nc_no = $custncno;
    }
    function setcust_date($custncdate) {
           $this->cust_ncdate = $custncdate;
    }
    function setremarks($remarks) {
           $this->remarks = $remarks;
    }

	function getrm_cost() {
           return $this->rm_cost;
    }
    function setrm_cost($rm_cost) {
           $this->rm_cost = $rm_cost;
    }

	function getcurrency() {
           return $this->currency;
    }
    function setcurrency($currency) {
           $this->currency = $currency;
    }
     function setstat($st) {
           $this->status = $st;
    }
    	function getaccepted() {
           return $this->accepted;
    }
    
     function setaccepted($accepted) {
           $this->accepted = $accepted;
    }
   	function getrejected() {
           return $this->rejected;
    }

     function setrejected($rejected) {
           $this->rejected = $rejected;
    }
   	function getquarantined() {
           return $this->quarantined;
    }

     function setquarantined($quarantined) {
           $this->quarantined = $quarantined;
    }
    

   	function getrework() {
           return $this->rework;
    }

     function setrework($rework) {
           $this->rework = $rework;
    }


  	function getwotype() {
           return $this->wotype;
    }

     function setwotype($wotype) {
           $this->wotype = $wotype;
    }


   	function getdnnum() {
           return $this->dnnum;
    }

     function setdnnum($dnnum) {
           $this->dnnum = $dnnum;
    }
     function setstagenum($stagenum) {
           $this->stagenum = $stagenum;
    }

	  function getmc_name() {
           return $this->mc_name;
    }

    function setmc_name ($mc_name) {
           $this->mc_name = $mc_name;
    }

	 function getcreated_by() {
           return $this->created_by;
    }

    function setcreated_by ($created_by) {
           $this->created_by = $created_by;
    }


     function addnc4qa() {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'nc4qa' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;		
        $refnum = "'" . $this->refnum . "'";
        $customer = "'" . $this->customer . "'";
        $partname= "'" . $this->partname . "'";
        $bachnum = "'" . $this->bachnum . "'";
        $partnum = "'" . $this->partnum . "'";
        $matl_spec = "'" . $this->matl_spec . "'";
        $issues_ps = "'" . $this->issues_ps . "'";
        $qty = $this->qty ? $this->qty : 0;
        $ponum = "'" . $this->ponum . "'";
        $part_sl_num = "'" . $this->part_sl_num . "'";
        $wonum = "'" . $this->wonum . "'";
        $dcnum= "'" . $this->dcnum . "'";
        $dcdate = $this->dcdate ? "'" . $this->dcdate  . "'" : '0000-00-00';
        //$dcdate = "'" . $this->dcdate . "'";
        $cr_date = "'" . $this->create_date . "'";
        $traceability_recnum = "'" . $this->traceability_recnum . "'";
        $dim_deviation= "'" . $this->dim_deviation . "'";
        $man= "'" . $this->man . "'";
        $inprocess = "'" . $this->inprocess . "'";
        $mat_deviation = "'" . $this->mat_deviation . "'";
        $machine = "'" . $this->machine . "'";
        $final_insp = "'" . $this->final_insp . "'";
        $other_deviation = "'" . $this->other_deviation . "'";
        $method = "'" . $this->method . "'";
        $cust_end = "'" . $this->cust_end . "'";
        $description = "'" . $this->description . "'";
        $root_cause = "'" . $this->root_cause . "'";
        $corrective_action = "'" . $this->corrective_action . "'";
        $preventive_action = "'" . $this->preventive_action . "'";
        $effectiveness = "'" . $this->effectiveness . "'";
        $cofcnum = "'" . $this->cofcnum . "'";
        $super = "'" . $this->super_name . "'";
        $oper = "'" . $this->oper_name . "'";
        $custncno = "'" . $this->cust_nc_no . "'";
        $custncdate =$this->cust_ncdate? "'" . $this->cust_ncdate . "'":'0000-00-00';
        $remarks = "'" . $this->remarks . "'";
		$rm_cost = $this->rm_cost?$this->rm_cost:0;
		$currency = "'" . $this->currency . "'";
        $st = "'" . $this->status . "'";
        $accepted = "'" . $this->accepted . "'";
		$rejected = "'" . $this->rejected . "'";
        $quarantined = "'" . $this->quarantined . "'";
		$rework = "'" . $this->rework . "'";
		$source="'".$this->source."'";
        $wotype = "'" . $this->wotype . "'";
        $dnnum = "'" . $this->dnnum . "'";
        $stagenum = "'".$this->stagenum."'"?"'".$this->stagenum."'":0;
		$mc_name = "'" . $this->mc_name . "'";

		$created_by = "'" . $this->created_by . "'";
    $siteid = "'" . $_SESSION['siteid'] . "'";



         //echo 'cofcnum='.$cofcnum;
        $sql = "select * from nc4qa where wonum=$wonum and cofcnum=$cofcnum and cofcnum != '' and cust_ncno = '$custncno'";
         $result = mysql_query($sql);
        if (!(mysql_fetch_row($result)))
        {
             $sql = "INSERT INTO
                        nc4qa
                            (recnum,
                             refnum,
                             customer,
                             partname,
                             bachnum,
                             partnum,
                             matl_spec,
                             issues_ps,
                             qty,
                             ponum,
                             part_sl_num,
                             wonum,
                             dcnum,
                             dcdate,
                             dim_deviation,
                             man,
                             inprocess,
                             mat_deviation,
                             machine,
                             final_insp,
                             other_deviation,
                             method,
                             cust_end,
                             description,
                             root_cause,
                             corrective_action,
                             preventive_action,
                             effectiveness,
                             cofcnum,
                             create_date,
                             super_name,
                             oper_name,
                             cust_ncno,
                             cust_ncdate,
                             remarks,
                             formatnum,
                             formatrev,
							 rm_cost,
							 currency,
							 status,
							 accepted,
							 rejected,
							 quarantined,
							 wotype,
							 dn_num,
							 stagenum,
							 rework,
							 mc_name,
							 created_by,
							 onsite,
               siteid
							 
                            )
                    VALUES
                            ($objid,
                             $refnum,
                             $customer,
                             $partname,
                             $bachnum,
                             $partnum,
                             $matl_spec,
                             $issues_ps,
                             $qty,
                             $ponum,
                             $part_sl_num,
                             $wonum,
                             $dcnum,
                             $dcdate,
                             $dim_deviation,
                             $man,
                             $inprocess,
                             $mat_deviation,
                             $machine,
                             $final_insp,
                             $other_deviation,
                             $method,
                             $cust_end,
                             $description,
                             $root_cause,
                             $corrective_action,
                             $preventive_action,
                             $effectiveness,
                             $cofcnum,
                             $cr_date,
                             $super,
                             $oper,
                             $custncno,
                             $custncdate,
                             $remarks,
                             'F8003-S',
                             'Rev 0 dt 8-1-2009',
			                 $rm_cost,
			                 $currency,
                             $st,
                             $accepted,
                             $rejected,
                             $quarantined,
                             $wotype,
                             $dnnum,
							 $stagenum,
							 $rework,
							 $mc_name,
							 $created_by,
							$source,
              $siteid
							 )";


         // echo $sql;
           $result = mysql_query($sql);
           if(!$result) die("Insert to nc4qa didn't work..Please report to Sysadmin. " . mysql_error());
           $sql = "commit";
           $result = mysql_query($sql);

       // Test to make sure query worked
           if(!$result) die("Insert to nc4qa didn't work..Please report to Sysadmin. " . mysql_error());

        $sql = "start transaction";
        $result = mysql_query($sql);
        
        $sql = "update seqnum set nxtnum = $objid where tablename = 'nc4qa'";
        $result = mysql_query($sql);
        
        $sql = "commit";
        $result = mysql_query($sql);
        
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
        //echo " <br>objid: $objid<br>";
         return $objid;
      }
      else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("WO#  " . $wonum . " with C Of C No " .$cofcnum. "  already exists. ");
       }
     }

     function getnc4qa($cond,$argoffset,$sort1,$arglimit) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $wcond = $cond;
        $offset= $argoffset;
        $limit= $arglimit;
        $siteid = $_SESSION['siteid'];
        $siteval = "siteid = '".$siteid."'";
        
        
         $sql = "select recnum,refnum,customer,partname,bachnum,partnum,wonum,cofcnum,create_date,status,mc_name,qty
                  FROM nc4qa 
                  where $wcond and $siteval
                  order by recnum
                  limit $offset, $limit";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;
     }


     function getqanc($nc4qarecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

       $sql = "       select recnum,
                             refnum,
                             customer,
                             partname,
                             bachnum,
                             partnum,
                             matl_spec,
                             issues_ps,
                             qty,
                             ponum,
                             part_sl_num,
                             wonum,
                             dcnum,
                             dcdate,
                             traceability_recnum,
                             dim_deviation,
                             man,
                             inprocess,
                             mat_deviation,
                             machine,
                             final_insp,
                             other_deviation,
                             method,
                             cust_end,
                             description,
                             root_cause,
                             corrective_action,
                             preventive_action,
                             effectiveness,
                             cofcnum,
                             create_date,
                             super_name,
                             oper_name,
                             cust_ncno,
                             cust_ncdate,
                             remarks,
                             formatnum,
                             formatrev,
			                 rm_cost,
			                 currency,
			                 status,
			                 accepted,
			                 rejected,
			                 quarantined,
			                 wotype,
			                 dn_num,
			                 stagenum,
							 rework,
							 mc_name,
							 created_by,
							onsite
            FROM nc4qa
            where recnum = $nc4qarecnum";
//echo $sql;
        $result = mysql_query($sql);

        return $result;
     }
     function updatenc4qa($nc4qarecnum)
	 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $refnum = "'" . $this->refnum . "'";
        $customer = "'" . $this->customer . "'";
        $partname= "'" . $this->partname . "'";
        $bachnum = "'" . $this->bachnum . "'";
        $partnum = "'" . $this->partnum . "'";
        $matl_spec = "'" . $this->matl_spec . "'";
        $issues_ps = "'" . $this->issues_ps . "'";
        $qty = $this->qty ? $this->qty : 0;
        $ponum = "'" . $this->ponum . "'";
        $part_sl_num = "'" . $this->part_sl_num . "'";
        $wonum = "'" . $this->wonum . "'";
        $dcnum= "'" . $this->dcnum . "'";
        $dcdate = $this->dcdate ? "'" . $this->dcdate  . "'" : '0000-00-00';
        $traceability_recnum = "'" . $this->traceability_recnum . "'";
        $dim_deviation= "'" . $this->dim_deviation . "'";
        $man= "'" . $this->man . "'";
        $inprocess = "'" . $this->inprocess . "'";
        $mat_deviation = "'" . $this->mat_deviation . "'";
        $machine = "'" . $this->machine . "'";
        $final_insp = "'" . $this->final_insp . "'";
        $other_deviation = "'" . $this->other_deviation . "'";
        $method = "'" . $this->method . "'";
        $cust_end = "'" . $this->cust_end . "'";
        $description = "'" . $this->description . "'";
        $root_cause = "'" . $this->root_cause . "'";
        $corrective_action = "'" . $this->corrective_action . "'";
        $preventive_action = "'" . $this->preventive_action . "'";
        $effectiveness = "'" . $this->effectiveness . "'";
        $cofcnum = "'" . $this->cofcnum . "'";
        $super = "'" . $this->super_name . "'";
        $oper = "'" . $this->oper_name . "'";
        $custncno = "'" . $this->cust_nc_no . "'";
        $custncdate = $this->cust_ncdate ? "'" . $this->cust_ncdate  . "'" : '0000-00-00';
        $remarks = "'" . $this->remarks . "'";
        $stagenum = "'".$this->stagenum."'"?"'".$this->stagenum."'":0;
		//$rm_cost = "'" . $this->rm_cost . "'";
		$rm_cost = $this->rm_cost ? $this->rm_cost : 0;
		$currency = "'" . $this->currency . "'";
        $st = "'" . $this->status . "'";
        $accepted = "'" . $this->accepted . "'";
		$rejected = "'" . $this->rejected . "'";
		$rework = "'" . $this->rework . "'";
		$source="'".$this->source."'";	
        $quarantined = "'" . $this->quarantined . "'";
        $wotype = "'" . $this->wotype . "'";
        $dnnum = "'" . $this->dnnum . "'";
       $stagenum = "'".$this->stagenum."'"?"'".$this->stagenum."'":0;
		$mc_name = "'" . $this->mc_name . "'";
        
        $sql = "select recnum from nc4qa where wonum=$wonum and cofcnum=$cofcnum and cofcnum != '' and cust_ncno = '$custncno'";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $recnum = $myrow[0];
        $rows = mysql_num_rows($result);           
        if($rows==1 && $recnum==$nc4qarecnum)
        {
           $sql = "UPDATE nc4qa SET
                             refnum=$refnum,
                             customer=$customer,
                             partname=$partname,
                             bachnum=$bachnum,
                             partnum=$partnum,
                             matl_spec=$matl_spec,
                             issues_ps=$issues_ps,
                             qty=$qty,
                             ponum=$ponum,
                             part_sl_num=$part_sl_num,
                             wonum=$wonum,
                             dcnum=$dcnum,
                             dcdate=$dcdate,
                             dim_deviation=$dim_deviation,
                             man=$man,
                             inprocess=$inprocess,
                             mat_deviation=$mat_deviation,
                             machine=$machine,
                             final_insp=$final_insp,
                             other_deviation=$other_deviation,
                             method=$method,
                             cust_end=$cust_end,
                             description=$description,
                             root_cause=$root_cause,
                             corrective_action=$corrective_action,
                             preventive_action=$preventive_action,
                             effectiveness=$effectiveness,
                             cofcnum=$cofcnum,
                             super_name=$super,
                             oper_name=$oper,
                             cust_ncno=$custncno,
                             cust_ncdate=$custncdate,
                             remarks=$remarks,
							 rm_cost = $rm_cost,
							 currency=$currency,
							 status=$st,
							 accepted=$accepted,
							 rejected=$rejected,
							 quarantined=$quarantined,
							 wotype=$wotype,
							 dn_num=$dnnum ,
							 stagenum=$stagenum,
							 rework=$rework,
							 mc_name=$mc_name,
							onsite=$source
        	WHERE
                    recnum = $nc4qarecnum ";
        //echo $sql;
        $result = mysql_query($sql);
        
        $sql = "commit";
        $result = mysql_query($sql);
        
        if(!$result) die("Nc for QA update failed...Please report to SysAdmin. " . mysql_error());
        }
        else if($rows == 0)
        {
           $sql = "UPDATE nc4qa SET
                             refnum=$refnum,
                             customer=$customer,
                             partname=$partname,
                             bachnum=$bachnum,
                             partnum=$partnum,
                             matl_spec=$matl_spec,
                             issues_ps=$issues_ps,
                             qty=$qty,
                             ponum=$ponum,
                             part_sl_num=$part_sl_num,
                             wonum=$wonum,
                             dcnum=$dcnum,
                             dcdate=$dcdate,
                             dim_deviation=$dim_deviation,
                             man=$man,
                             inprocess=$inprocess,
                             mat_deviation=$mat_deviation,
                             machine=$machine,
                             final_insp=$final_insp,
                             other_deviation=$other_deviation,
                             method=$method,
                             cust_end=$cust_end,
                             description=$description,
                             root_cause=$root_cause,
                             corrective_action=$corrective_action,
                             preventive_action=$preventive_action,
                             effectiveness=$effectiveness,
                             cofcnum=$cofcnum,
                             super_name=$super,
                             oper_name=$oper,
                             cust_ncno=$custncno,
                             cust_ncdate=$custncdate,
                             remarks=$remarks,
						     rm_cost = $rm_cost,
							 currency=$currency,
							 status=$st,
							 accepted=$accepted,
							 rejected=$rejected,
							 quarantined=$quarantined,
							 wotype=$wotype,
							 dn_num=$dnnum ,
							 stagenum=$stagenum,
							 rework=$rework,
							 mc_name=$mc_name,
							onsite=$source
        	WHERE
                    recnum = $nc4qarecnum ";
        //echo $sql;
        $result = mysql_query($sql);

        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Quote update failed...Please report to SysAdmin. " . mysql_error());        
        }
       else if($rows>=1 && $recnum!=$nc4qarecnum)
       {
         echo "<table border=1><tr><td><font color=#FF0000>";
         die("WO#  " .$wonum. " with C Of C No " .$cofcnum. "  already exists. ");
       }
	   return $nc4qarecnum;
    }
        
        function updatenc4qa_prodn($nc4qarecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $root_cause = "'" . $this->root_cause . "'";
        $corrective_action = "'" . $this->corrective_action . "'";
        
        $sql = "UPDATE nc4qa SET

                             root_cause=$root_cause,
                             corrective_action=$corrective_action
        	WHERE
                    recnum = $nc4qarecnum ";
    //echo $sql;
        $result = mysql_query($sql);

        if(!$result)
           {
	      $sql = "rollback";
	      $result = mysql_query($sql);
	      die("Update to NC QA for production failed ..Please report to Sysadmin. " . mysql_error());
           }
         $sql = "commit";
         $result = mysql_query($sql);
         if(!$result)
         {
	       $sql = "rollback";
	       $result = mysql_query($sql);
	       die("Commit Failed for NC QA for production..Please report to Sysadmin. " . mysql_errno());
         }
        }
        
     function getwo_nc4qa($wonum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

         $sql = "select wonum,effectiveness
                  FROM nc4qa where wonum='$wonum'";
         $result = mysql_query($sql);
         //echo $sql;
        if(!$result) die("get WO from NC QA failed ..Please report to Sysadmin. " . mysql_error());
        return $result;

     }

     function deleteQuote($id) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $sql = "delete from quote where id = '$id'";
        $result = mysql_query($sql);
        
        $sql = "commit";
        $result = mysql_query($sql);
        
        if(!$result) die("Delete for Quote failed...Please report to SysAdmin. " . mysql_error());
      }



 //Function for search/sort coded by Jerry George 30 Dec -04
  function getquotessearch($cond,$argoffset,$arglimit,$sort1,$quotecond,$quoteOperator,$quoteVal) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder = $sort1;

        $matchCond ='';
    if($quotecond != '' || $quotecond != null) {
          if($quoteOperator == 'equal') {
                $matchCond="and `quote`.".$quoteVal . "='" . $quotecond ."'";
          }else if($quoteOperator == 'like'){

                $matchCond="and `quote`.". $quoteVal . " LIKE '" . $quotecond ."%'";
          }
     }

                  $sql = "SELECT
                  `quote`.`id`,
                  `quote`.`company`,
                  `quote`.`descr`,
                  `quote`.`excelfile`,
                  `quote`.`rfqid`,
                  `quote`.`quote_date`,
                  `quote`.`recnum`,
                  `quote`.`quotetype`,
                  `quote`.`quote2type`,
                  `employee`.`fname`,
                  `employee`.`lname`,
                  `quote`.`convert2sales`,
                  `quote`.`quote_grosstotal`,
                  `quote`.`currency`,
                  `quote`.`mail2customer`,
                  `quote`.`tax`,
                  `quote`.`labor`,
                  `quote`.`shipping`,
                  `quote`.`misc`,
                  `bom`.`bomnum`,
                  `quote`.`lockstatus`

                FROM `quote`
                LEFT OUTER JOIN `bom` ON
                   (`quote`.`link2bom` = `bom`.`recnum`)
                LEFT OUTER JOIN `employee` ON
                (`quote`.`quote2employee` = `employee`.`recnum`)
                 where $wcond $matchCond
                ORDER by $sortorder limit $offset, $limit";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;
     }
   //Function for pagination coded by Jerry George 30 Dec -04
  function getncCount($cond,$argoffset,$arglimit)
    {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;


      $siteid = $_SESSION['siteid'];
      $siteval = "siteid = '".$siteid."'";
        $sql = "select count(recnum) as numrows
                                      from nc4qa where $wcond  and 
                                      $siteval limit $offset, $limit ";
       $newlogin = new userlogin;
       $newlogin->dbconnect();
//echo "$sql";
    $result  = mysql_query($sql) or die(' nc4qa count query failed');
    $row     = mysql_fetch_array($result, MYSQL_ASSOC);
    $numrows = $row['numrows'];
    return $numrows;
    }
    
    function getcofcs($wonum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
        $siteval = "d.siteid = '".$siteid."'";
        $sql = "select  d.relnotenum,
                        d.disp_date,
                        c.name,
                        d.crn,
                        dl.wonum
                  FROM dispatch d, dispatch_line_items dl, company c
                  where
                       d.recnum = dl.link2dispatch and
                       c.recnum = d.disp2customer and
                       dl.wonum = '$wonum' and $siteval
                  order by d.relnotenum";
        $result = mysql_query($sql);
       //echo "$sql";
        return $result;
     }   
     function geSupnOperNames()
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $sql = "select concat(fname,'(',lname,')') 
                 from employee where status='Active'
                 order by fname";
        $result = mysql_query($sql);        
        return $result;
     }
	  function getwostat($wonum)
     {

        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select `condition` from work_order where wonum='$wonum'";
        $result = mysql_query($sql);
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $wo_stat = $row['condition'];
        return $wo_stat;
     }
     
          function getdn_num($wonum,$dnnum)
     {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql="select wo_p.dn,w.wonum
               from work_order w,wo_part_status wo_p
                    where wo_p.link2wo=w.recnum and
                          w.wonum='$wonum' and
                          wo_p.dn='$dnnum'" ;
         //echo $sql;
         $result = mysql_query($sql) or die ('getdn_num query failed');
         return $result;
     }
     
     function updatewo_part_status($wonum,$qty,$ncnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql="update work_order w,wo_part_status wo_p
                                                 set wo_p.cust_nc='$ncnum',
                                                     wo_p.cust_rej=$qty,
													 w.cust_rej_qty=$qty
                                                     where w.wonum = '$wonum' and
                                                           wo_p.link2wo=w.recnum and
                                                           (wo_p.stage = 'final' or wo_p.stage = 'Final' or
                      wo_p.stage = 'FINAL' or wo_p.stage = 'fi' or
                      wo_p.stage = 'FI' or wo_p.stage = 'Fi' )";
        //echo $sql;
        $result  = mysql_query($sql) or die(' updatewo_part_status query failed');
        //$row     = mysql_num_rows($result);
        //$numrows = $row['numrows'];
        return $result;
     }

     function updatewo_p4tret($wonum,$qty,$ncnum,$dnnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql="update work_order w,wo_part_status wo_p
              set wo_p.cust_nc='$ncnum',
                  wo_p.cust_rej=$qty,
				  w.cust_rej_qty=$qty
             where w.wonum = '$wonum' and
                   wo_p.link2wo=w.recnum and
                   wo_p.dn='$dnnum'";
         //echo $sql;
        $result  = mysql_query($sql) or die('updatewo_p4tret query failed');
        //$row     = mysql_num_rows($result);
        //$numrows = $row['numrows'];
        return $result;
     }

// Added method to check duplicate NC for a WO.
// June 13, 2011
	 function getwo_check($wonum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select recnum,wonum from nc4qa where wonum='$wonum'";
       // echo $sql;
        $result = mysql_query($sql);
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $nc_recnum = $row['recnum'];
        return $nc_recnum;
     }
     
     function updatewo_pQty4treat($wonum,$qty,$ncnum,$dnnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql="update work_order w,wo_part_status wo_p
                                                 set wo_p.cust_nc='$ncnum',
                                                     wo_p.cust_rej='0',
													 w.cust_rej_qty='0'
                                                     where w.wonum = '$wonum' and
                                                           wo_p.link2wo=w.recnum and
                                                           wo_p.dn='$dnnum'";
        //echo $sql;
        $result  = mysql_query($sql) or die('updatewo_p4tret query failed');       
        return $result;
     }
     
     function updatewo_part_statusQty($wonum,$qty,$ncnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql="update work_order w,wo_part_status wo_p
                                                 set wo_p.cust_nc='$ncnum',
                                                     wo_p.cust_rej='0',
													 w.cust_rej_qty='0'
                                                     where w.wonum = '$wonum' and
                                                           wo_p.link2wo=w.recnum and
                                                           (wo_p.stage = 'final' or wo_p.stage = 'Final' or
                      wo_p.stage = 'FINAL' or wo_p.stage = 'fi' or
                      wo_p.stage = 'FI' or wo_p.stage = 'Fi' )";
        //echo $sql;
        $result  = mysql_query($sql) or die(' updatewo_part_status query failed');
        //$row     = mysql_num_rows($result);
        //$numrows = $row['numrows'];
        return $result;
     }
     //and op_mc.stage_num=$stage_num 
         function getwo_opnames($wonum,$stage_num)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select o.oper_name,o.wo_num
                       from operator o,oper_mc_usage op_mc
                            where o.wo_num='$wonum' and
                                  op_mc.stage_num like '$stage_num' and
                                  op_mc.link2operator=o.recnum
                                  group by oper_name";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
	function getEmployeeName()
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $sql = "select concat(fname,'(',lname,')') 
                 from employee 
				 where status='Active'
                 order by fname";
        $result = mysql_query($sql);        
        return $result;
    }
	function getnc4qaexport($cond) 
	{
		$newlogin = new userlogin;
        $newlogin->dbconnect();
        $wcond = $cond;          
        
         $sql = "select recnum,refnum,customer,
		                partname,bachnum,partnum,
		                wonum,cofcnum,create_date,
						status,mc_name
                 FROM nc4qa 
                 where $wcond 
                 order by recnum ";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }


    function updateassywoli($wonum,$qty,$type)
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql ="select recnum from assy_wo where assy_wonum = '$wonum'";
        $result = mysql_query($sql) ;
        if($result)
        {
          $row = mysql_fetch_assoc($result) ;
          $recnum = $row['recnum'] ;
        }


        $sql1 ="select qty,recnum from assywo_li where link2assywo = $recnum" ;
        $result1 = mysql_query($sql1) ;

        while($row1 = mysql_fetch_assoc($result1))
        {
            $totqty = 0;
            $assyqty    = $row1['qty'] ;
            $recnum1 = $row1['recnum'] ;

          $totqty = $qty * $assyqty ;

          if($type =='rework')
          {
            $sql2 = "Update assywo_li set custend_rew_qty = $totqty 
                              where recnum = $recnum1" ;

            $result2 = mysql_query($sql2) ;   
          }

          if($type =='rejected')
          {
            $sql3 = "Update assywo_li set custend_rej_qty = $totqty 
                              where recnum = $recnum1" ;
            $result3 = mysql_query($sql3) ;                          
          }        
       }   
    }


   function getassywostat($wonum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select status from assy_wo where assy_wonum='$wonum'";
        $result = mysql_query($sql);
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $wo_stat = $row['status'];
        return $wo_stat;
     }
      

 function updaterework4wo($wonum,$qty,$type)
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql ="select recnum from work_order where wonum = '$wonum'";
        $result = mysql_query($sql) ;
        if($result)
        {
          $row = mysql_fetch_assoc($result) ;
          $recnum = $row['recnum'] ;
        }


        if($type =='rework')
        {
          $sql2 = "update work_order set cust_rew_qty = $qty 
                            where wonum = $wonum and recnum = $recnum" ;
          $result2 = mysql_query($sql2) ;   
        }

        if($type =='reject')
        {
          $sql2 = "update work_order set cust_rej_qty = $qty 
                            where wonum = $wonum and recnum = $recnum" ;

                            // echo $sql2;
          $result2 = mysql_query($sql2) ;   
        }                 
    }      
} // End quoteclass definition
