<?
//============================================
// Author: FSI
// Date-written = Jan 29, 2010
// Filename: delivery_schClass.php
// Maintains the class for wms
// Revision: v1.0  OMS
//============================================

include_once('classes/loginClass.php');

class deliverye_sch
{
	 var $crnnum,
         $schedule_date,
         $schedule_qty,
		 $remarks,
		 $time_required,
		 $status,
		 $disputd,
      $custcode,
         $partnum,
         $type,
         $parent_crnnum;

 function deliverye_sch()
{
    $this->crnnum = '';
    $this->schedule_date = '';	
    $this->schedule_qty = '';	
	$this->remarks = '';
	$this->time_required = '';
	$this->status = '';
	$this->disputd = '';
	$this->partnum = '';
    $this->custcode = '';
    $this->type = '';
    $this->parent_crnnum = '';
}

function getcrnnum()
{
  return $this->crnnum;
}
function setcrnnum($reqcrnnum)
{
  $this->crnnum = $reqcrnnum;
}

function getschedule_date()
{
  return $this->schedule_date;
}
function setschedule_date($reqschedule_date)
{
  $this->schedule_date = $reqschedule_date;
}

function getschedule_qty()
{
  return $this->schedule_qty;
}
function setschedule_qty($reqschedule_qty)
{
  $this->schedule_qty = $reqschedule_qty;
}
function getremarks()
{
  return $this->remarks;
}
function setremarks($reqremarks)
{
  $this->remarks = $reqremarks;
}
function gettime_required()
{
  return $this->time_required;
}
function settime_required($reqtime_required)
{
  $this->time_required = $reqtime_required;
}
function getstatus()
{
  return $this->status;
}
function setstatus($reqstatus)
{
  $this->status = $reqstatus;
}
function setpartnum($partnum)
{
  $this->partnum = $partnum;
}
function setdisputd($disputd)
{
	$this->disputd = $disputd;
}
function getcustcode()
{
  return $this->custcode;
}
function setcustcode($reqcustcode)
{
  $this->custcode = $reqcustcode;
}
function gettype()
{
  return $this->type;
}
function settype($type)
{
  $this->type = $type;
}
function getparent_crnnum()
{
  return $this->parent_crnnum;
}
function setparent_crnnum($parent_crnnum)
{
  $this->parent_crnnum = $parent_crnnum;
}

function getdelivery_sch_summary($cond,$argoffset,$arglimit)
{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $offset = $argoffset;
        $limit =  $arglimit;
        $siteid = $_SESSION['siteid'];
        $siteval = "siteid ='" .$siteid."'";
         $sql = "select recnum,
              					crnnum,
              					schedule_date,
              					schedule_qty,
              					remarks,
              					time_required,
              					status,
              					custcode,
              					disp_qty,
              					wo_issue_qty
                  FROM delivery_sch
		               $cond and $siteval
                   and schedule_qty > 0
                  order by crnnum limit $offset, $limit";
                   // echo "$sql";
        $result = mysql_query($sql);
       
        return $result;
}

function getdelivery_schCount($cond,$argoffset,$arglimit)
{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $offset = $argoffset;
        $limit =  $arglimit;
        $siteid = $_SESSION['siteid'];
        $siteval = "siteid ='" .$siteid."'";
         $sql = "select count(recnum) as numrows
                  FROM delivery_sch
		               $cond
                   and schedule_qty > 0 and $siteval
                  order by crnnum limit $offset,$limit";
        $result = mysql_query($sql);
        //echo "$sql";
        $result  = mysql_query($sql) or die('getdelivery_schCount query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
       return $numrows;
}

 function adddelivery_sch()
 {

      $newlogin = new userlogin;
      $newlogin->dbconnect();
        
        $crnnum ="'" .$this->crnnum . "'";
    $schedule_date ="'" .$this->schedule_date . "'";
    $schedule_qty ="'" .$this->schedule_qty . "'";
    $remarks ="'" .$this->remarks . "'";
    $time_required =$this->time_required?"'" .$this->time_required . "'":0.0;
    $partnum ="'" .$this->partnum . "'";
    $dispuptodate ="'" .$this->disputd . "'";
    //$type ="'" .$this->type . "'";
    $parent_crnnum ="'" .$this->parent_crnnum . "'";
    $custcode ="'" .$this->custcode. "'";
    $siteid ="'".$_SESSION['siteid']."'";
    

    $status ='Open';
    $res1=array();
    $today = date("Y-m-d");
    
  
        $sql = "select * from delivery_sch 
            where crnnum = $crnnum and
              schedule_date=$schedule_date
            and (status = 'Open' || status='Closed')";
        $result = mysql_query($sql);
    $num_rows=mysql_num_rows($result);      
    
        if ($num_rows == 0) 
    { 
    
          $sql = "INSERT INTO delivery_sch                          
                            (crnnum,
              schedule_date,schedule_qty,remarks,time_required,status,partnum,disp_qty,parent_crnnum,custcode,siteid)
                           VALUES 
                     ($crnnum,$schedule_date,$schedule_qty,$remarks,
                       $time_required,'$status',$partnum,$dispuptodate,$parent_crnnum,$custcode,$siteid)";
// echo $sql;exit;
      }
    else
    {
       $row=mysql_fetch_array($result);
       // echo "$schedule_qty"."</br>";
       // echo "<pre>"; print_r($row['disp_qty']);
     
       if($this->schedule_qty < $row['disp_qty'] )
      { 
      
        //echo "<table border=1><tr><td><font color=#FF0000>";
        //echo "Schedule qty  " . $this->schedule_qty . " should be greater than dispatch qty ".$row['disp_qty'];
        //echo "</td></tr></table>";

          
        $res1= Array ($this->schedule_qty, $row['disp_qty'],$this->crnnum,$this->schedule_date);          
      }
      else
      {

         $sql = "update delivery_sch      
                    set schedule_qty=$schedule_qty,
                             partnum=$partnum
                           where crnnum=$crnnum and 
                               schedule_date=$schedule_date  ";
        // echo $sql;
      }
        } 
        $result = mysql_query($sql);
        // echo $result;
         // Test to make sure query worked
        if(!$result) die("Insert to delivery Schedule didn't work..Please report to Sysadmin. " . mysql_error());
    return $res1;
  }

   function Updatedelivery_sch($recnum)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();        
        $crnnum ="'" .$this->crnnum . "'";
  			$schedule_date ="'" .$this->schedule_date . "'";
  			$schedule_qty ="'" .$this->schedule_qty . "'";
  			$remarks ="'" .$this->remarks . "'";
  			$time_required =$this->time_required ?"'" .$this->time_required . "'":0.0;
  			$partnum ="'" .$this->partnum . "'";
        $custcode ="'" .$this->custcode . "'";
  			$dispuptodate ="'" .$this->disputd . "'";
  			$status ="'" .$this->status . "'";        
		    $sql = "update delivery_sch set 		         
				        crnnum=$crnnum,
                        schedule_date=$schedule_date,
                        schedule_qty=$schedule_qty,
                        partnum=$partnum,
                        time_required=$time_required,
                        remarks=$remarks,
                        custcode=$custcode,
						            disp_qty = $dispuptodate
			                  where recnum=$recnum";
		//	 echo $sql;      
		$result = mysql_query($sql);
 		// Test to make sure query worked
		if(!$result) die("Update to delivery Schedule didn't work..Please report to Sysadmin. " . mysql_error());
    }
	function gettime_required4crn($crnnum) 
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select sum(ms.setting_time*60+ms.setting_time_mins) as SettingTime,sum(ms.running_time*60+ms.running_time_mins) as RunningTime
		from mc_master m,mc_stage_master ms
		 where ms.link2mc_master=m.recnum and m.crn_num='$crnnum'
		 group by m.crn_num";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
   }
    function getAllSchs($crnnum)
	{
       $newlogin = new userlogin;
       $newlogin->dbconnect(); 
       $siteid = $_SESSION['siteid'];
       $siteval = "siteid = '".$siteid."'";
       $sql = "select recnum,
	                  crnnum, 
					  schedule_date, 
					  schedule_qty, 
	                  remarks, 
					  status, 
					  time_required,
	                  partnum, 
					  disp_qty,
					  wo_issue_qty
                      from delivery_sch
	             where crnnum = '$crnnum' and
					   status = 'Open' and
                       (schedule_qty - wo_issue_qty) > 0
                       and $siteval
					 order by schedule_date asc";
		// echo $sql;
        $result  = mysql_query($sql) or die('getallschs query failed');
		return $result;
	}
	
	function getdelivery_sch_dets($cond)
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $offset = $argoffset;
        $limit =  $arglimit;
         $sql = "select recnum,
						crnnum,
						schedule_date,
						schedule_qty,
						remarks,
						time_required,
						status,
						partnum,
						disp_qty,
            custcode
                  FROM delivery_sch
		               $cond
                  ";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
    }

	function check_schedule($crn,$schdate)
	{
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select recnum
			   from work_order
               where sch_due_date='$schdate' and crn_num='$crn'
               UNION
               select recnum
               from dispatch
               where schdate='$schdate' and crn='$crn'";
		//echo $sql;
        $result  = mysql_query($sql) or die('check_schedule query failed');
		return $result;
	}

   function delete_old_sch($crnnum,$inpdate)
  {
       $newlogin = new userlogin;
       $newlogin->dbconnect(); 
       $sql = "delete 
                 from delivery_sch
               where crnnum = '$crnnum' and
                   disp_qty > 0 and
             schedule_date >= '$inpdate'
                       ";
  // echo $sql;
        $result  = mysql_query($sql1);
  }

    function getsubcrn($crn)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect(); 

        $sql =" select distinct(bm.crn), bm.qpa, b.crn,bm.partnum  from
                 bom b, bom_mfg_items bm
                 where b.recnum = bm.link2bom and
                 b.status ='Active' and
                 b.crn = '$crn' ";
                 // echo $sql;
          $result = mysql_query($sql);
          return $result;

  }
function getpartnumboughtout($crn)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect(); 

        $sql =" select distinct(bmi.partnum), bmi.qpa, b.crn  from
                 bom b, bom_bought_items bmi
                where b.recnum = bmi.link2bom and 
                b.status ='Active' and
                b.crn = '$crn'" ;
                // echo $sql;exit;
          $result = mysql_query($sql);
          return $result;

  }

  function getsubcrnforkit($crn)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect(); 

        $sql =" select distinct(bs.crn), bs.qpa, b.crn,bs.partnum  from
                 bom b, bom_subassy_items bs
                 where b.recnum = bs.link2bom and
                 b.status ='Active' and
                 b.crn = '$crn' ";
                 // echo $sql;exit;
          $result = mysql_query($sql);
          return $result;

  }
    function getcrntype($crn)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect(); 

        $sql ="select m.recnum,m.type,m.treat,m.Cim_refnum
                      from master_data m
                      where m.status = 'Active'  and
                            m.Cim_refnum = '$crn' ";
                           // echo $sql;exit;
          $result = mysql_query($sql);
         $myrow = mysql_fetch_row($result);
          $type = $myrow[1];
          return $type;

  }
function getsubcrn4treated($crn)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect(); 

        $sql =" select distinct(bt.crn), bt.qpa, b.crn,bt.partnum  from
                 bom b, bom_treated_items bt
                 where b.recnum = bt.link2bom and
                 b.status ='Active' and
                 b.crn = '$crn' ";
                // echo $sql;exit;
          $result = mysql_query($sql);
          return $result;

  }
}