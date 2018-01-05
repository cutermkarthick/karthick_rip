<?

//====================================
// Author: FSI
// Date-written = Feb 26, 2007
// Filename:mmClass.php
// Maintains the class for material movements
// Revision: v1.0
//====================================


include_once('loginClass.php');

class in {
  var
    $from,
	$to,
	$sampling,
	$rework,
	$accept,
	$reject,
	$returns,
	$inspno,
	$stage,
	$signoff,
	$remarks,
	$link2wo,
	$mmline_num,
	$date,
	$dn,
	$dn_sent,
	$dn_recv,
    $cofc_num,
    $supplier_wo,
    $ncnum,
    $hold;
  function in()
	{
	   $this->mmline_num='';
	   $this->link2wo='';
	   $this->from='';
	   $this->to='';
	   $this->sampling='';
	   $this->rework='';
	   $this->accept='';
	   $this->reject='';
	   $this->returns='';
	   $this->date='';
	   $this->inspno='';
	   $this->stage='';
	   $this->signoff='';
	   $this->remarks='';
	   $this->dn='';
	   $this->dn_sent='';
	   $this->dn_recv='';
	   $this->cofc_num='';
	   $this->supplier_wo='';
	   $this->ncnum='';
	   $this->hold='';
	}
	
	function setline_num($mmline_num)
	{
    $this->mmline_num=$mmline_num;
	}
	
	function set_link2wo($worecnum)
	{
	$this->link2wo=$worecnum;
	}
	function set_from($from)
	{
	  $this->from=$from;
	}
	
	function set_to($to)
	{
	  $this->to=$to;
	}
	
	function set_sample($sampling)
	{
	  $this->sampling=$sampling;
	}
	
	function set_rework($rework)
	{
	  $this->rework=$rework;
	}
	
	function set_accept($accept)
	{
	  $this->accept=$accept;
	}
	
	function set_reject($reject)
	{
	  $this->reject=$reject;
	}
	
	function set_returns($returns)
	{
	  $this->returns=$returns;
	}
	 function set_date($date)
	{
	  $this->date=$date;
	}
	function set_inspno($inspno)
	{
	  $this->inspno=$inspno;
	}
	
	function set_stage($stage)
	{
	  $this->stage=$stage;
	}
	
	function set_signoff($signoff)
	{
	  $this->signoff=$signoff;
	}
	
	function set_remarks($remarks)
	{
	  $this->remarks=$remarks;
	}
	
	function set_dn($dn)
	{
	  $this->dn=$dn;
	}
	
	function set_dn_sent($dn_sent)
	{
	  $this->dn_sent=$dn_sent;
	}
	
	function set_dn_recv($dn_recv)
	{
	  $this->dn_recv=$dn_recv;
	}
	
	function set_cofc_num($cofc_num)
	{
	  $this->cofc_num=$cofc_num;
	}
	function set_supplier_wo($supplier_wo)
	{
	  $this->supplier_wo=$supplier_wo;
	}
	function set_ncnum($ncnum)
	{
	  $this->ncnum=$ncnum;
	}
	
	function set_hold($hold)
	{
	  $this->hold=$hold;
	}
	
function updatewo_comp_qty()
 {
     $rework=$this->rework ? $this->rework : 0;;
	 $accept=$this->accept ? $this->accept : 0;
     $reject=$this->reject ? $this->reject : 0;
     $returns=$this->returns ? $this->returns : 0;
	 $stage=$this->stage;
	 $link2wo=$this->link2wo;

     if ($stage == 'FINAL' or $stage == 'fi' or
                     $stage == 'FI' or $stage == 'Fi')
	 {
             $sql = "update work_order 
		            set rej_qty = '$reject',
					    ret_qty = '$returns',
						rework_qty = '$returns',
						comp_qty = '$accept'
					where recnum = $link2wo";
					// echo $sql;exit;
	   $result = mysql_query($sql);
           if(!$result) die("Update of WO qtys failed..Please report to Sysadmin " . mysql_error());
 	 }
         elseif ($stage == 'DN')
	 {
            $sql = "update work_order 
		            set rej_qty = '$reject',
					    ret_qty = '$returns',
						rework_qty = '$returns',
						acc4dn = '$accept'
					where recnum = $link2wo";
	   $result = mysql_query($sql);
           if(!$result) die("Update of WO qtys failed..Please report to Sysadmin " . mysql_error());
 	 }

 }
 function addmm() {
 
     $from="'".$this->from."'";
	 $to="'".$this->to."'";
     $sampling="'".$this->sampling."'";
     $rework="'".$this->rework."'";
	 $accept="'".$this->accept."'";
     $reject="'".$this->reject."'";
     $returns="'".$this->returns."'";
     $date = $this->date ? "'" . $this->date  . "'" : '0000-00-00';
	 $inspno="'".$this->inspno."'";
	 $stage="'".$this->stage."'";
     $signoff="'".$this->signoff."'";
     $remarks="'".$this->remarks."'";
	 $link2wo=$this->link2wo;
     $mmline_num=$this->mmline_num ? $this->mmline_num : 0;
     $dn=$this->dn ? $this->dn : 0;
     $dn_sent=$this->dn_sent ? $this->dn_sent : 0;
     $dn_recv=$this->dn_recv ? $this->dn_recv : 0;
     $cofc_num = "'" . $this->cofc_num . "'";
     $supplier_wo = "'" . $this->supplier_wo  . "'";
     $ncnum = "'" . $this->ncnum  . "'";
     $hold=$this->hold ? $this->hold : 0;
  
 $sql="insert into `wo_part_status` (
  `fromsl`,
  `tosl` ,
  `samplingsl` ,
  `rework`,
  `acc` ,
  `rej`,
  `ret`,
  `stage` ,
  `st_date` ,
  `inspnum`,
  `signoff` ,
  `remarks`,
  `link2wo`,
  `line_num` ,
  `dn`,
  `dn_sent`,
  `dn_recv`,
  `cofc_num`,
  `supplier_wo`,
  `ncnum`,
  `hold`
)values($from,
$to,
$sampling,
 $rework,
 $accept,
 $reject,
 $returns,
 $stage,
 $date,
 $inspno,
 $signoff,
 $remarks,$link2wo, $mmline_num,$dn,$dn_sent,$dn_recv,$cofc_num,$supplier_wo,$ncnum,$hold)";
 // echo $sql;exit;
 $result = mysql_query($sql);
 if(!$result) die("Insert of Part Status failed..Please report to Sysadmin " . mysql_error());
 //updatewo_comp_qty();
 }
    function getin($worecnum) {
        //$worecnum = $inprecnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select * from wo_part_status where link2wo='$worecnum'";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
 function updatein($recno)
 {
 $from="'".$this->from."'";
 $to="'".$this->to."'";
 $sampling="'".$this->sampling."'";
 $rework="'".$this->rework."'";
 $accept="'".$this->accept."'";
 $reject="'".$this->reject."'";
 $returns="'".$this->returns."'";
 $inspno="'".$this->inspno."'";
 $stage="'".$this->stage."'";
 $date = $this->date ? "'" . $this->date  . "'" : '0000-00-00';
 $signoff="'".$this->signoff."'";
 $remarks="'".$this->remarks."'";
 $link2wo="'".$this->link2wo."'";
 $mmline_num= $this->mmline_num ? $this->mmline_num : 0;
 $dn="'".$this->dn."'";
 $dn_sent=$this->dn_sent ? $this->dn_sent : 0;
 $dn_recv=$this->dn_recv ? $this->dn_recv : 0;
 $cofc_num = "'" . $this->cofc_num . "'";
 $supplier_wo = "'" . $this->supplier_wo  . "'";
 $ncnum = "'" . $this->ncnum  . "'";
 $hold=$this->hold ? $this->hold : 0;
 
 $sql="update wo_part_status set
             `fromsl`=$from,
             `tosl` =$to,
             `samplingsl`=$sampling,
             `rework`=$rework,
             `acc` =$accept,
             `rej`=$reject,
             `ret`=$returns,
             `stage` =$stage,
             `st_date` = $date,
             `inspnum`=$inspno,
             `signoff` =$signoff,
             `remarks`=$remarks,
             `line_num`=$mmline_num ,
             `dn`=$dn ,
             `dn_sent`=$dn_sent ,
             `dn_recv`=$dn_recv,
             `cofc_num`=$cofc_num,
             `supplier_wo`=$supplier_wo,
             `ncnum`=$ncnum,
             `hold`=$hold
   where recno='$recno'";
   //echo $sql;
 $result = mysql_query($sql);
 if(!$result) die("Update of Part Status failed..Please report to Sysadmin " . mysql_error());
 //updatewo_comp_qty();
 }
 
   function getnc_qa($worecnum,$stage){
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        if (preg_match("/fi/i", $stage ))
        {
		   $cond = " nc.stagenum like '%' ";
	    }
	    else
	    {
                $cond = " (nc.stagenum = '$stage' || nc.stagenum like '%') ";
	    }
        $sql = "select nc.recnum as recnum,nc.wonum,nc.stagenum
		    from nc4qa nc, work_order w 
		    where w.wonum=nc.wonum and
		         $cond and
		         w.recnum = $worecnum and
			 (nc.accepted is NULL or nc.accepted = '' or nc.accepted = 'no')
                        and (nc.cust_end is null or nc.cust_end ='' or nc.cust_end ='no')";

        // echo $sql;
        $result  = mysql_query($sql) or die('getnc_qa failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $ncrecnum = $row['recnum'];
		//echo "<br>recnum of nc is $ncrecnum";
        return $ncrecnum;
 }

 function getnc_details($worecnum,$ncnum){
        $newlogin = new userlogin;
        $newlogin->dbconnect();
		//echo "<br>ncnum in class is $ncnum";
	    $ncnum = str_replace(",", "','", $ncnum);
		//echo "<br>ncnum in class after replace is  $ncnum";
        $sql = "select sum(nc.qty) as qty
		            from nc4qa nc, work_order w
		         where w.recnum='$worecnum' and 
				       w.wonum = nc.wonum and
					   nc.recnum in ('$ncnum') and
				      (nc.accepted is NULL or nc.accepted = '' or nc.accepted = 'no')
                      and (nc.cust_end is null or nc.cust_end ='' or nc.cust_end ='no')";
        //echo "<br>$sql";
        $result  = mysql_query($sql) or die('getnc_qa failed');
        //$row     = mysql_fetch_array($result, MYSQL_ASSOC);
       //$ncrecnum = $row['recnum'];
        return $result;
 }
 // Added on Jan 15, 2012
  function getncstat($worecnum)
 {
    $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select nc.status as status,nc.wonum from nc4qa nc, work_order w
		           where w.wonum=nc.wonum and
		                 w.recnum = $worecnum and
				         (nc.accepted is NULL or nc.accepted = '' or nc.accepted = 'no')
				         and (nc.cust_end is null or nc.cust_end ='' or nc.cust_end ='no')
				         and nc.status='Pending'";

        //echo $sql;
        $result  = mysql_query($sql) or die('getnc_qa failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $ncstat = $row['status'];
		//echo "<br>recnum of nc is $ncrecnum";
        return $ncstat;
 }
 
  function getgrnretqty($grnnum){
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select g.qty_ret as qty_ret
		            from grn g
		         where g.grnnum='$grnnum'";
        //echo "<br>$sql";
        $result  = mysql_query($sql) or die('getgrnretqty failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $qty_ret = $row['qty_ret'];
        return $qty_ret;
 }
 function updategrn4retqty($retqty,$grn)
 {
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     $retqty=$retqty?$retqty:0;
     $sql1 = "update grn g
                   set g.qty_ret=$retqty
                        where g.grnnum='$grn' ";
                             // echo $sql1."<br>";
         $result1 = mysql_query($sql1);
         if(!$result1)
           {

	         die("Update return qty for GRN didn't work..Please report to Sysadmin. " . mysql_error());
           }
 }
 
  function getretqtydets4crn($grnnum)
   {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select sum(wps.ret) as woreturns
                     from wo_part_status wps,work_order w
                          where w.grnnum='$grnnum' and
                                wps.link2wo=w.recnum and
                                w.`condition` !='Hold' and
                                w.`condition` !='WO Cancelled'";
      // echo $sql;
       $result=mysql_query($sql);
       if(!$result) die(".......getretqtydets4crn....... failed...Please report to SysAdmin. " . mysql_error());
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $woreturns = $row['woreturns'];
     // echo "<br>$numrows<br>";
        return $woreturns;

   }
 }
