<?
//====================================
// Author: FSI
// Date-written = Feb 26, 2007
// Filename:mmClass.php
// Maintains the class for material movements
// Revision: v1.0
//====================================

include_once('loginClass.php');

class inassy
{
  var
        $from,
	$to,
	$sampling,
	$rework,
	$accept,
	$reject,
	$ncnum,
	$returns,
	$inspno,
	$stage,
	$signoff,
	$remarks,
	$link2assywo,
	$mmline_num,
	$date;
  function inassy()
	{
	   $this->mmline_num='';
	   $this->link2assywo='';
	   $this->from='';
	   $this->to='';
	   $this->sampling='';
	   $this->rework='';
	   $this->accept='';
	   $this->reject='';
	   $this->ncnum='';
	   $this->returns='';
	   $this->date='';
	   $this->inspno='';
	   $this->stage='';
	   $this->signoff='';
	   $this->remarks='';
	}
	
	function setline_num($mmline_num)
	{
 	$this->mmline_num=$mmline_num;
	}
	
	function set_link2assywo($worecnum)
	{
	$this->link2assywo=$worecnum;
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
	
	function set_ncnum($ncnum)
	{
	  $this->ncnum=$ncnum;
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
	
function updatewo_comp_qty($link2wo)
 {
   // echo $link2wo;

      $sql = "select sum(acc) from assy_part_status
                where (stage = 'final' or stage = 'Final' or
                      stage = 'FINAL' or stage = 'fi' or
                      stage = 'FI' or stage = 'Fi') and
                      link2assywo = $link2wo";
     
        $result = mysql_query($sql);

        $myrow = mysql_fetch_row($result);
        if($myrow[0] == '')
        {
           $comp_qty = 0;
		}
        else
	    {
           $comp_qty = $myrow[0];
		}

        $sql = "update assy_wo set comp_qty = $comp_qty
                where recnum = $link2wo";

        $result = mysql_query($sql);

        if(!$result) die("Update of assy_comp_qty failed..Please report to Sysadmin " . mysql_error());

// March 12, 2010
// Modified by BM
// CIM has a new stage called SP - so had to modify
// the check here to allow for SP to update the 
// comp_qty because CofC can be raised for SP stage
// also (earlier only FI stage was allowed for CofC).

		$sql = "select sum(acc) from assy_part_status
                         where (stage = 'SP' or stage = 'sp') and
                         link2assywo = $link2wo";
     //  echo $sql;
           $result = mysql_query($sql);
           $myrow = mysql_fetch_row($result);
		   if($myrow[0] == '')
           {
              $comp_qty = 0;
           }
		   else
		   {
              $comp_qty = $myrow[0];
			  $sql = "update assy_wo set comp_qty = $comp_qty
                where recnum = $link2wo";

              $result = mysql_query($sql);

              if(!$result) die("Update of assywo_comp_qty failed..Please report to Sysadmin " . mysql_error());
	       }
 }


function addmmassy() 
{ 
 $from="'".$this->from."'";
 $to="'".$this->to."'";
 $sampling="'".$this->sampling."'";
 $rework="'".$this->rework."'";
 $accept="'".$this->accept."'";
 $reject="'".$this->reject."'";
 $returns="'".$this->returns."'";
 $date=$this->date?"'".$this->date."'":'0000-00-00';
 $inspno="'".$this->inspno."'";
 $stage="'".$this->stage."'";
 $signoff="'".$this->signoff."'";
 $remarks="'".$this->remarks."'";
 $link2assywo=$this->link2assywo;
 $mmline_num=$this->mmline_num ? $this->mmline_num : 0;
 // $ncnum="'".$this->ncnum."'";
 $sql="insert into `assy_part_status` (
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
  `link2assywo`,
  `line_num`
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
 $remarks,$link2assywo, $mmline_num)";
//echo $sql;
 $result = mysql_query($sql);
 if(!$result) die("Insert of Part Status failed..Please report to Sysadmin " . mysql_error());
 //updatewo_comp_qty();
 }
    function getinassy($worecnum) {
        //$worecnum = $inprecnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select * from assy_part_status where link2assywo='$worecnum'";
      // echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
 function updateinassy($recno)
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
 $date=$this->date?"'".$this->date."'":'0000-00-00';
 $signoff="'".$this->signoff."'";
 $remarks="'".$this->remarks."'";
 $link2assywo="'".$this->link2assywo."'";
 $mmline_num= $this->mmline_num ? $this->mmline_num : 0;
 $ncnum="'".$this->ncnum."'";
 $sql="update assy_part_status set
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
             `line_num`=$mmline_num
   where recno='$recno'";
  // echo $sql;
 $result = mysql_query($sql);
 if(!$result) die("Update of Part Status failed..Please report to Sysadmin " . mysql_error());
 //updatewo_comp_qty();
 } 


function getnc_qa(){
    $newlogin = new userlogin;
    $newlogin->dbconnect();
	$worecnum = $this->link2assywo;
	$stage = $this->stage;
	$rework = $this->rework;
	$reject = $this->reject;
	if (preg_match("/fi/i", $stage ))
        {
		   $cond = " nc.stagenum like '%' ";
		          $sql = "select nc.recnum as recnum,nc.wonum,nc.stagenum
		    from nc4qa nc, assy_wo w 
		    where w.assy_wonum = nc.wonum and
		         $cond and
		         w.recnum = $worecnum and
			 (nc.accepted is NULL or nc.accepted = '' or nc.accepted = 'no')
                        and (nc.cust_end is null or nc.cust_end ='' or nc.cust_end ='no')";

                  // echo $sql; exit;
                  $result  = mysql_query($sql) or die('getnc_qa failed');
                  $row     = mysql_fetch_array($result, MYSQL_ASSOC);
                  $ncrecnum = $row['recnum'];
		//echo "<br>recnum of nc is $ncrecnum";
                  return $ncrecnum;
	  }
	  else if (($rework > 0 || $reject > 0) && preg_match("/DN/i", $stage ))
	  {
                $cond = " (nc.stagenum like '%') ";
		        $sql = "select nc.recnum as recnum,nc.wonum,nc.stagenum
		    from nc4qa nc, assy_wo w 
		    where w.assy_wonum = nc.wonum and
		         $cond and
		         w.recnum = $worecnum and
			 (nc.accepted is NULL or nc.accepted = '' or nc.accepted = 'no')
                        and (nc.cust_end is null or nc.cust_end ='' or nc.cust_end ='no')";

            //echo $sql;
            $result  = mysql_query($sql) or die('getnc_qa failed');
            $row     = mysql_fetch_array($result, MYSQL_ASSOC);
            $ncrecnum = $row['recnum'];
		//echo "<br>recnum of nc is $ncrecnum";
            return $ncrecnum;
	  }

	  else if ($rework > 0 || $reject > 0)
	  {
                $cond = " (nc.stagenum = '$stage') ";
		        $sql = "select nc.recnum as recnum,nc.wonum,nc.stagenum
		    from nc4qa nc, assy_wo w 
		    where w.assy_wonum = nc.wonum and
		         $cond and
		         w.recnum = $worecnum and
			 (nc.accepted is NULL or nc.accepted = '' or nc.accepted = 'no')
                        and (nc.cust_end is null or nc.cust_end ='' or nc.cust_end ='no')";

              //echo $sql;
              $result  = mysql_query($sql) or die('getnc_qa failed');
              $row     = mysql_fetch_array($result, MYSQL_ASSOC);
              $ncrecnum = $row['recnum'];
		//echo "<br>recnum of nc is $ncrecnum";
              return $ncrecnum;
	   }
	   else
	   {
			return '';
	   }


 }


 function getnc_details($worecnum,$ncnum){
        $newlogin = new userlogin;
        $newlogin->dbconnect();
		//echo "<br>ncnum in class is $ncnum";
	    $ncnum = str_replace(",", "','", $ncnum);
		//echo "<br>ncnum in class after replace is  $ncnum";
        $sql = "select sum(nc.qty) as qty
		            from nc4qa nc, assy_wo w
		         where w.recnum='$worecnum' and 
				       w.assy_wonum = nc.wonum and
					   nc.recnum in ('$ncnum') and
				      (nc.accepted is NULL or nc.accepted = '' or nc.accepted = 'no')
                      and (nc.cust_end is null or nc.cust_end ='' or nc.cust_end ='no')";
        //echo "<br>$sql";
        $result  = mysql_query($sql) or die('getnc_qa failed');
        //$row     = mysql_fetch_array($result, MYSQL_ASSOC);
       //$ncrecnum = $row['recnum'];
        return $result;
 }

 function getncstat($worecnum)
 {

    $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select nc.status as status,nc.wonum from nc4qa nc, assy_wo w
		           where w.assy_wonum=nc.wonum and
		                 w.recnum = $worecnum and
				         (nc.accepted is NULL or nc.accepted = '' or nc.accepted = 'no')
				         and (nc.cust_end is null or nc.cust_end ='' or nc.cust_end ='no')
				         and nc.status='Pending'";

        // echo $sql;
        $result  = mysql_query($sql) or die('getnc_qa failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $ncstat = $row['status'];
		//echo "<br>recnum of nc is $ncrecnum";
        return $ncstat;
 }


	function getretforassywo($worecnum)
	{
 		$newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select ret_qty from assy_wo 
        			where recnum = '$worecnum'" ;
        $result  = mysql_query($sql) or die('could not get ret qty from assywo');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $retqty = $row['ret_qty'];
		//echo "<br>recnum of nc is $ncrecnum";
        return $reqty;


	}

	function updateretqtyforAssywo($worecnum, $retqty)
	{
 		$newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "update assy_wo set ret_qty = $retqty 
        			where recnum = '$worecnum'" ;

        			// echo $sql;

        $result  = mysql_query($sql) or die('could not update ret qty from assywo');
        return $result;


	}


	

 }
