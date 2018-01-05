<?
//====================================
// Author: FSI
// Date-written = Dec 04, 2007
// Filename: operatorClass.php
// Maintains the class for review
// Revision: v1.0  OWT
// Modification:
//====================================

include_once('loginClass.php');

class operator {
    var
    $oper_id,
    $oper_name,
    $shift,
    $crn,
    $wo_num,
    $qty,
    $st_date,
    $end_date,
    $qty_rej,
    $qty_with_dev,
    $qty_accepted,
    $mc_id,
    $mc_name,
    $setting_time,
    $running_time,
    $markup_time,
    $markdown_time,
    $idle_time,
    $setting_time_mins,
    $running_time_mins,
    $markup_time_mins,
    $markdown_time_mins,
    $idle_time_mins,
    $sl_from,
    $sl_to,
    $stage_num,
    $link2operator,
    $remarks,
    $qty_rejected,
	$status,
	$qty_acc,
	$qty_rew,
	$breakdown_time,
	$breakdown_time_mins;
    

    // Constructor definition
    function operator() {
        $this->oper_id = '';
        $this->oper_name = '';
        $this->shift = '';
        $this->crn = '';
        $this->wo_num = '';
        $this->qty = '';
        $this->st_date = '';
        $this->end_date = '';
        $this->qty_rej = '';
        $this->qty_with_dev = '';
        $this->qty_accepted = '';
        $this->mc_id = '';
        $this->mc_name = '';
        $this->setting_time = '';
        $this->running_time = '';
        $this->markup_time = '';
        $this->markdown_time = '';
        $this->idle_time = '';
        $this->setting_time_mins = '';
        $this->running_time_mins = '';
        $this->markup_time_mins = '';
        $this->markdown_time_mins = '';
        $this->idle_time_mins = '';
        $this->sl_from = '';
        $this->sl_to = '';
        $this->stage_num = '';
        $this->status = '';
        $this->remarks = '';
        $this->qty_rejected = '';
        $this->link2operator= '';
		$this->breakdown_time= '';
		$this->breakdown_time_mins= '';
     }

    function getoper_id() {
           return $this->oper_id;
    }
    function setoper_id ($oper_id) {
           $this->oper_id = $oper_id;
    }

    function getoper_name() {
           return $this->oper_name;
    }
    function setoper_name($oper_name) {
           $this->oper_name = $oper_name;
    }

    function getshift() {
           return $this->shift;
    }
    function setshift ($shift) {
           $this->shift = $shift;
    }

    function getcrn() {
           return $this->crn;
    }
    function setcrn($crn) {
           $this->crn = $crn;
    }
    
    function getwo_num() {
           return $this->wo_num;
    }
    function setwo_num($wo_num) {
           $this->wo_num = $wo_num;
    }

    function getqty() {
           return $this->qty;
    }
    function setqty($qty) {
           $this->qty = $qty;
    }
    
    function getqty_rejected() {
           return $this->qty_rejected;
    }
    function setqty_rejected($qty_rej) {
           $this->qty_rejected = $qty_rej;
    }

    function getst_date() {
           return $this->st_date;
    }
    function setst_date($st_date) {
           $this->st_date = $st_date;
    }

    function getend_date() {
           return $this->end_date;
    }
    function setend_date($end_date) {
           $this->end_date = $end_date;
    }

    function getqty_rej() {
           return $this->qty_rej;
    }
    function setqty_rej($qty_rej) {
           $this->qty_rej = $qty_rej;
    }

    function getqty_with_dev() {
           return $this->qty_with_dev;
    }
    function setqty_with_dev($qty_with_dev) {
           $this->qty_with_dev= $qty_with_dev;
    }

    function getqty_accepted() {
           return $this->qty_accepted;
    }
    function setqty_accepted($qty_accepted) {
           $this->qty_accepted= $qty_accepted;
    }

    function getmc_id() {
           return $this->mc_id;
    }
    function setmc_id($mc_id) {
           $this->mc_id= $mc_id;
    }

    function getmc_name() {
           return $this->mc_name;
    }
    function setmc_name($mc_name) {
           $this->mc_name = $mc_name;
    }
    function getremarks() {
           return $this->remarks;
    }
    function setremarks($remarks) {
           $this->remarks = $remarks;
    }
    
    function getsetting_time() {
           return $this->setting_time;
    }
    function setsetting_time($setting_time) {
           $this->setting_time = $setting_time;
    }

    function getrunning_time() {
           return $this->running_time;
    }
    function setrunning_time($running_time) {
           $this->running_time = $running_time;
    }
    function getmarkup_time() {
           return $this->markup_time;
    }
    function setmarkup_time($markup_time) {
           $this->markup_time = $markup_time;
    }
    function getmarkdown_time() {
           return $this->markdown_time;
    }
    function setmarkdown_time($markdown_time) {
           $this->markdown_time = $markdown_time;
    }
	function getbreakdown_time() {
           return $this->breakdown_time;
    }
    function setbreakdown_time($breakdown_time) {
           $this->breakdown_time = $breakdown_time;
    }

    
    function getidle_time() {
           return $this->idle_time;
    }
    function setidle_time($idle_time) {
           $this->idle_time = $idle_time;
    }
    
    function getsl_from() {
           return $this->sl_from;
    }
    function setsl_from($sl_from) {
           $this->sl_from = $sl_from;
    }
    
    function getsl_to() {
           return $this->sl_to;
    }
    function setsl_to($sl_to) {
           $this->sl_to = $sl_to;
    }

    function getstage_num() {
           return $this->stage_num;
    }
    function setstage_num($stage_num) {
           $this->stage_num = $stage_num;
    }

    function getlink2operator() {
           return $this->link2operator;
    }
    function setlink2operator($link2operator) {
           $this->link2operator = $link2operator;
    }
    
    
    
    function getsetting_time_mins() {
           return $this->setting_time_mins;
    }
    function setsetting_time_mins($setting_time_mins) {
           $this->setting_time_mins = $setting_time_mins;
    }

    function getrunning_time_mins() {
           return $this->running_time_mins;
    }
    function setrunning_time_mins($running_time_mins) {
           $this->running_time_mins = $running_time_mins;
    }
    
    function getmarkup_time_mins() {
           return $this->markup_time_mins;
    }
    function setmarkup_time_mins($markup_time_mins) {
           $this->markup_time_mins = $markup_time_mins;
    }
    
    function getmarkdown_time_mins() {
           return $this->markdown_time_mins;
    }
    function setmarkdown_time_mins($markdown_time_mins) {
           $this->markdown_time_mins = $markdown_time_mins;
    }

	 function getbreakdown_time_mins() {
           return $this->breakdown_time_mins;
    }
    function setbreakdown_time_mins($breakdown_time_mins) {
           $this->breakdown_time_mins = $breakdown_time_mins;
    }


    function getidle_time_mins() {
           return $this->idle_time_mins;
    }
    function setidle_time_mins($idle_time_mins) {
           $this->idle_time_mins = $idle_time_mins;
    }

	 function getstatus() {
           return $this->status;
    }
    function setstatus($status) {
           $this->status = $status;
    }

	function getqty_acc() {
           return $this->qty_acc;
    }
    function setqty_acc($qty_acc) {
           $this->qty_acc = $qty_acc;
    }

	function getqty_rew() {
           return $this->qty_rew;
    }
    function setqty_rew($qty_rew) {
           $this->qty_rew = $qty_rew;
    }


   function addoperator() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
       /* $sql = "select nxtnum from seqnum where tablename = 'contract_review' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1; */

        $oper_id  = "'" . $this->oper_id . "'";
        $oper_name = "'" . $this->oper_name . "'";
        $shift = "'" . $this->shift . "'";
        $crn = "'" . $this->crn . "'";
        $remarks = "'" . $this->remarks . "'";
        $wo_num = "'" . $this->wo_num . "'";
        $st_date = "'" . $this->st_date . "'";
        $end_date = "'" . $this->end_date . "'";
		    $status = "'" . $this->status . "'";
        $qty_rej = $this->qty_rej;      
        $siteid = "'" . $_SESSION['siteid'] . "'"; 

        if ($qty_rej == "") 
        {
            $qty_rej =0;
        }
        $qty_with_dev = $this->qty_with_dev;
        if ($qty_with_dev == "") 
        {
            $qty_with_dev =0;
        }
        $qty_accepted = $this->qty_accepted;
        if ($qty_accepted == "") 
        {
            $qty_accepted = 0;
        }
        $mc_name = "'" . $this->mc_name . "'";


     //   $sql = "select * from operator where oper_name = $oper_name and mc_name=$mc_name and st_date=$st_date and shift=$shift";
        //echo $sql;
      //     $result = mysql_query($sql);
      /*     if (!(mysql_fetch_row($result)))
           {  */
            $sql = "INSERT INTO
                        operator
                            (
                             oper_id,oper_name,shift,crn,st_date,
                             qty_rej,qty_with_dev,
                             qty_accepted,mc_name,wo_num,remarks,status,siteid
                            )
                    VALUES
                            (
                             $oper_id,$oper_name,$shift,$crn,$st_date,
                             $qty_rej,$qty_with_dev,
                             $qty_accepted,$mc_name,$wo_num,$remarks,$status,$siteid
                            )";

         //echo $sql;
              $result = mysql_query($sql);

           // Test to make sure query worked
             if(!$result) die("Insert to operator didn't work..Please report to Sysadmin. " . mysql_error());
         /*  }
            else
            {
                echo "<table border=1><tr><td><font color=#FF0000>";
               die("Operator " . $oper_name . " with " . $mc_name.', '.$st_date.', '.$shift." already exists. ");
               echo "</td></tr></table>";
            }     */
        /*    $sql = "update seqnum set nxtnum = $objid where tablename = 'contract_review'";
            $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work for Enquiry..Please report to Sysadmin. " . mysql_error());
       */ $sql = 'select max(recnum) from operator';
        $result = mysql_query($sql);
        $operrecnum = mysql_fetch_row($result);

        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for operator Insert..Please report to Sysadmin. " . mysql_error());
        return $operrecnum[0];
     }
     
     
     function addstage_data() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
       /* $sql = "select nxtnum from seqnum where tablename = 'contract_review' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1; */

        $mc_id  = "'" . $this->mc_id . "'";
        $mc_name = "'" . $this->mc_name . "'";

        $setting_time =  $this->setting_time;
        if($setting_time == '')
        {
           $setting_time =0;
        }
        $running_time = $this->running_time;
        if($running_time == '')
        {
           $running_time =0;
        }
        $markup_time = $this->markup_time;
        if($markup_time == '')
        {
           $markup_time = 0;
        }
        $markdown_time = $this->markdown_time;
        if($markdown_time == '')
        {
           $markdown_time = 0;
        }

		$breakdown_time = $this->breakdown_time;
        if($breakdown_time == '')
        {
           $breakdown_time = 0;
        }

        $idle_time = $this->idle_time;
        if($idle_time == '')
        {
           $idle_time = 0;
        }
        
        $qty = $this->qty;
        if($qty == '')
        {
          $qty = 0;
        }
        $qty_rej = $this->qty_rejected;
        if($qty_rej == '')
        {
          $qty_rej = 0;
        }
        $sl_from = $this->sl_from;
        if($sl_from == '')
        {
           $sl_from = 0;
        }
        $sl_to = $this->sl_to;
        if($sl_to == '')
        {
           $sl_to = 0;
        }

		$qty_acc = $this->qty_acc;
        if($qty_acc == '')
        {
          $qty_acc = 0;
        }

		$qty_rew= $this->qty_rew;
        if($qty_rew == '')
        {
          $qty_rew = 0;
        }
        
        $setting_time_mins = $this->setting_time_mins? $this->setting_time_mins : 0;
        $running_time_mins = $this->running_time_mins? $this->running_time_mins : 0;
        $markup_time_mins = $this->markup_time_mins? $this->markup_time_mins : 0;
        $markdown_time_mins = $this->markdown_time_mins? $this->markdown_time_mins : 0;
        $idle_time_mins = $this->idle_time_mins? $this->idle_time_mins : 0;
        $breakdown_time_mins = $this->breakdown_time_mins? $this->breakdown_time_mins : 0;

        $stage_num = $this->stage_num;
        $link2operator = $this->link2operator;
        $oper_name = "'" . $this->oper_name . "'";

    /*    $sql = "select * from operator where recnum = $objid";
           $result = mysql_query($sql);
           if (!(mysql_fetch_row($result)))
           {  */
            $sql = "INSERT INTO
                        oper_mc_usage
                            (
                             mc_id,mc_name,running_time,stage_num,link2operator,oper_name,
                             setting_time,idle_time,qty,sl_from,sl_to,setting_time_mins,
                             running_time_mins,idle_time_mins,qty_rej,markup_time,markdown_time,
                             markup_time_mins,markdown_time_mins,qty_acc,qty_rew,breakdown_time,
							 breakdown_time_mins
                            )
                    VALUES
                            (
                             $mc_id,$mc_name,$running_time,$stage_num,$link2operator,$oper_name,
                             $setting_time,$idle_time,$qty,$sl_from,$sl_to,$setting_time_mins,
                             $running_time_mins,$idle_time_mins,$qty_rej,$markup_time,$markdown_time,
                             $markup_time_mins,$markdown_time_mins,$qty_acc,$qty_rew,$breakdown_time,
							 $breakdown_time_mins
                            )";
                            
			  //echo $sql;
              $result = mysql_query($sql);

           // Test to make sure query worked
              if(!$result) die("Insert to oper_mc_usage didn't work..Please report to Sysadmin. " . mysql_error());
        /*    }
            else
            {
                echo "<table border=1><tr><td><font color=#FF0000>";
               die("Enquiry ID " . $objid . " already exists. ");
               echo "</td></tr></table>";
            }
            $sql = "update seqnum set nxtnum = $objid where tablename = 'contract_review'";
            $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work for Enquiry..Please report to Sysadmin. " . mysql_error());  */

        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for oper_mc_usage Insert..Please report to Sysadmin. " . mysql_error());
        return $link2operator;
     }

     function getoperators() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select distinct
                        oper_name,
                        crn,
                        mc_name,
						shift,
						qty,
						wo_num,
						remarks,
						status,
						st_date
                  FROM operator order by oper_name,mc_name";
        $result = mysql_query($sql);
		//echo "$sql";
        return $result;
     }
     
     function getoperator_data($oper_name,$mc_name,$crn) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,
                        oper_name,
                        shift,
                        crn,
                        st_date,
                        end_date,
                        qty_rej,
                        qty_with_dev,
                        qty_accepted,
                        mc_name,
						status
                  FROM operator where oper_name='$oper_name' and
                       mc_name='$mc_name' and
                       crn='$crn'";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;

     }
     

     function getoperator_data1($cond,$argoffset,$arglimit,$sort1) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder = $sort1;
        $siteid = $_SESSION['siteid'];
        $siteval = "o.siteid = '".$siteid."'";
        //echo $sortorder;
        $matchCond ='';

        /*if($opercond != '' || $opercond != null) {
          if($oper_oper == 'equal') {
                $matchCond="and `o`.oper_name='" . $opercond ."'";
          }else if($oper_oper == 'like'){

                $matchCond="and `o`.oper_name LIKE '" . $opercond ."%'";
          }
        }*/
       // echo $matchCond . '<br>' . $oper_oper . '<br>';
         $sql = "select o.recnum,
                        o.oper_name,
                        o.shift,
                        o.crn,
                        o.st_date,
                        o.end_date,
                        o.qty_rej,
                        o.qty_with_dev,
                        o.qty_accepted,
                        o.mc_name,
                        op_mc.stage_num,
                        op_mc.setting_time,
                        op_mc.running_time,
                        op_mc.idle_time,
                        op_mc.qty,
                        op_mc.sl_from,
                        op_mc.sl_to,
                        o.wo_num,
                        op_mc.setting_time_mins,
                        op_mc.running_time_mins,
                        op_mc.idle_time_mins,
					            	o.status,
                        op_mc.breakdown_time,
                        op_mc.breakdown_time_mins
                        FROM operator o
                        left join oper_mc_usage op_mc on op_mc.link2operator=o.recnum
                        where $wcond and $siteval
                        order by st_date,o.shift,mc_name,crn,$sortorder
                        limit $offset, $limit";
                        $result = mysql_query($sql);
                       // echo "$sql"; 
                        return $result;

     }
     

     
     function getoper_data_4_edit($operatorrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,
                        oper_name,
                        shift,
                        crn,
                        st_date,
                        end_date,
                        qty_rej,
                        qty_with_dev,
                        qty_accepted,
                        mc_name,
                        wo_num,
                        remarks,
						status
                  FROM operator where recnum='$operatorrecnum'";
        $result = mysql_query($sql);
       // echo "$sql";
        return $result;

     }
     
    function getmcs() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select mc_name
                  FROM mc_master";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;

     }
   function getwo_qty($wonum)
   {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select qty
               FROM work_order where wonum = '$wonum'";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;
   }

     
function getstage_data($operatorrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,
                        running_time,
                        stage_num,
                        setting_time,
                        idle_time,
            						qty,
            						qty_acc,
            						qty_rej,
            						qty_rew,
            						sl_from,
            						sl_to,						
                        setting_time_mins,
            						running_time_mins,
            						idle_time_mins,
            						breakdown_time,
            						breakdown_time_mins
                        FROM oper_mc_usage where link2operator=$operatorrecnum";
                        $result = mysql_query($sql);
                       // echo "$sql";
                        return $result;

     }     

      function getrunning_time1($operatorrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,
                        running_time,
                        stage_num
                  FROM oper_mc_usage where link2operator=$operatorrecnum";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;

     }

     function getsetting_time1($operatorrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,
                        setting_time,
                        stage_num
                  FROM oper_mc_usage where link2operator=$operatorrecnum";
        $result = mysql_query($sql);
        //echo "$sql";                  \

        return $result;

     }

     function getidle_time1($operatorrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,
                        idle_time,
                        stage_num
                  FROM oper_mc_usage where link2operator=$operatorrecnum";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;

     }
     
     function getmarktime($operatorrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,
                        markup_time,
                        markup_time_mins,
                        markdown_time,
                        markdown_time_mins,
                        stage_num,
						breakdown_time,
						breakdown_time_mins
                  FROM oper_mc_usage where link2operator=$operatorrecnum  group by stage_num order by stage_num
                 ";
        //echo $sql;
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;

     }
     
     function getqty1($operatorrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,
                        qty,
                        stage_num
                  FROM oper_mc_usage where link2operator=$operatorrecnum";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;

     }
     
     function getqty_rej1($operatorrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,
                        qty_rej,
                        stage_num,
						qty_acc,
						qty_rew
                  FROM oper_mc_usage where link2operator=$operatorrecnum";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;

     }
     
     function getsl_from1($operatorrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,
                        sl_from,
                        stage_num
                  FROM oper_mc_usage where link2operator=$operatorrecnum";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;

     }
     
     function getsl_to1($operatorrecnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,
                        sl_to,
                        stage_num
                  FROM oper_mc_usage where link2operator=$operatorrecnum";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }
     
     function getops()
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
        $siteval = "siteid = '".$siteid."'";
         $sql = "select fname,lname
                  FROM employee where role='op'
                                 and $siteval
                  order by fname";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;
     }
     


     function getoperator($i,$operatorrecnum)
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select *
                  FROM oper_mc_usage where link2operator=$operatorrecnum
                       and stage_num=$i";
        $result = mysql_query($sql);
       //echo "$sql";
        return $result;

    }

     function updateoperator($operatorrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $mc_name = "'" . $this->mc_name . "'";
        $shift = "'" . $this->shift . "'";
        $crn = "'" . $this->crn . "'";
        $wo_num = "'" . $this->wo_num . "'";
        $remarks = "'" . $this->remarks . "'";
        $st_date = "'" . $this->st_date . "'";
        $status = "'" . $this->status . "'";

       $sql = "UPDATE operator SET
                    mc_name = $mc_name,
                    shift = $shift,
                    crn = $crn,
                    wo_num = $wo_num,
                    st_date = $st_date,
                    remarks = $remarks,
					status= $status
                    
        	WHERE
                    recnum = $operatorrecnum";
        // echo $sql;
        $result = mysql_query($sql);

        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv5");
                     die("operator update failed...Please report to SysAdmin. " . mysql_error());
                     }
        }
        
    function updatestage_data($link2operator) {
    
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);

        if($this->running_time == '')
        {
           $running_time = 0;
        }
        else
        {
           $running_time = $this->running_time;
        }

        if($this->setting_time == '')
        {
           $setting_time = 0;
        }
        else
        {
           $setting_time = $this->setting_time;
        }
        
        if($this->markup_time == '')
        {
           $markup_time = 0;
        }
        else
        {
           $markup_time = $this->markup_time;
        }
        
        if($this->markdown_time == '')
        {
           $markdown_time = 0;
        }
        else
        {
           $markdown_time = $this->markdown_time;
        }

		if($this->breakdown_time == '')
        {
           $breakdown_time = 0;
        }
        else
        {
           $breakdown_time = $this->breakdown_time;
        }


        if($this->idle_time == '')
        {
           $idle_time = 0;
        }
        else
        {
           $idle_time = $this->idle_time;
        }
        
        if($this->qty == '')
        {
           $qty = 0;
        }
        else
        {
           $qty = $this->qty;
        }
        
        if($this->qty_rejected == '')
        {
           $qty_rej = 0;
        }
        else
        {
           $qty_rej = $this->qty_rejected;
        }
        
        if($this->sl_from == '')
        {
           $sl_from = 0;
        }
        else
        {
           $sl_from = $this->sl_from;
        }

         if($this->sl_to == '')
        {
           $sl_to = 0;
        }
        else
        {
           $sl_to = $this->sl_to;
        }


        if($this->qty_acc == '')
        {
           $qty_acc = 0;
        }
        else
        {
           $qty_acc = $this->qty_acc;
        }

		 if($this->qty_rew== '')
        {
           $qty_rew = 0;
        }
        else
        {
           $qty_rew = $this->qty_rew;
        }

        $setting_time_mins = $this->setting_time_mins ? $this->setting_time_mins : 0;
        $running_time_mins = $this->running_time_mins ? $this->running_time_mins : 0;
        $markup_time_mins = $this->markup_time_mins ? $this->markup_time_mins : 0;
        $markdown_time_mins = $this->markdown_time_mins ? $this->markdown_time_mins : 0;
        $idle_time_mins = $this->idle_time_mins ? $this->idle_time_mins : 0;
        $breakdown_time_mins = $this->breakdown_time_mins ? $this->breakdown_time_mins : 0;
        $stage_num = $this->stage_num;

        $sql = "UPDATE oper_mc_usage SET
                    running_time = $running_time,
                    setting_time = $setting_time,
                    markup_time = $markup_time,
                    markdown_time = $markdown_time,
                    idle_time = $idle_time,
                    qty = $qty,
                    qty_rej = $qty_rej,
                    sl_from = $sl_from,
                    sl_to = $sl_to,
                    running_time_mins = $running_time_mins,
                    setting_time_mins = $setting_time_mins,
                    markup_time_mins = $markup_time_mins,
                    markdown_time_mins = $markdown_time_mins,
                    idle_time_mins = $idle_time_mins,
					qty_acc = $qty_acc,
					qty_rew = $qty_rew,
                    breakdown_time = $breakdown_time,
                    breakdown_time_mins = $breakdown_time_mins
         	    WHERE
                    link2operator = $link2operator and
                    stage_num =$stage_num";

              //echo $sql;
              $result = mysql_query($sql);

           // Test to make sure query worked
              if(!$result) die("update to oper_mc_usage didn't work..Please report to Sysadmin. " . mysql_error());

        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for oper_mc_usage Insert..Please report to Sysadmin. " . mysql_error());
        //return $objid;
     }
     
     
     function getoperCount($cond,$argoffset,$arglimit)
    {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $matchCond ='';
        $siteid = $_SESSION['siteid'];
        $siteval = "o.siteid = '".$siteid."'";
        
        /*if($opercond != '' || $opercond != null) {
          if($oper_oper == 'equal') {
                $matchCond="and `o`.oper_name='" . $opercond ."'";
          }else if($oper_oper == 'like'){

                $matchCond="and `o`.oper_name LIKE '" . $opercond ."%'";
          }
        }*/
             $sql = "select count(*) as numrows
                  FROM operator o
                  left join oper_mc_usage op_mc on op_mc.link2operator=o.recnum
                  where $wcond and $siteval
                  limit $offset, $limit";
       $newlogin = new userlogin;
       $newlogin->dbconnect();
//echo "$sql";
    $result  = mysql_query($sql) or die('quote count query failed');
    $row     = mysql_fetch_array($result, MYSQL_ASSOC);
    $numrows = $row['numrows'];
    return $numrows;
    }
    
    function getrunning_time_mins1($operatorrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,
                        running_time_mins,
                        stage_num
                  FROM oper_mc_usage where link2operator=$operatorrecnum";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;

     }

     function getsetting_time_mins1($operatorrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,
                        setting_time_mins,
                        stage_num
                  FROM oper_mc_usage where link2operator=$operatorrecnum";
        $result = mysql_query($sql);
        //echo "$sql";                  \

        return $result;

     }

     function getidle_time_mins1($operatorrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,
                        idle_time_mins,
                        stage_num
                  FROM oper_mc_usage where link2operator=$operatorrecnum";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;

     }
     
     function get_prev_rec($mcname,$entdate,$shift)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
	   $fordate = $entdate;
	  
	   if ($shift == '2')
		   $forshift = 1;
	   if ($shift == '3') 
		   $forshift = 2;
           if ($shift == '1') 
		{
		     $forshift = 3;
             $sql = "select max(st_date) 
			from operator 
                        where mc_name = '$mcname'  and
			 shift = '3' and status != 'Cancelled'";
			  //echo $sql;
              $result = mysql_query($sql);
			  $myrow4date = mysql_fetch_row($result);
              $fordate = $myrow4date[0];
		}
       $sql = "  select op.st_date,op.shift,sum(setting_time),sum(setting_time_mins),
	                        sum(running_time),
					        sum(running_time_mins),sum(idle_time),sum(idle_time_mins),
							sum(breakdown_time),sum(breakdown_time_mins)
                    from oper_mc_usage opmc,operator op
                    where opmc.link2operator=op.recnum and
                               op.mc_name='$mcname' and
							   op.st_date = '$fordate' and
							   op.shift = '$forshift'
                   group by op.mc_name,op.st_date,op.shift
                   order by op.st_date desc,op.shift";
       //echo "$sql";
       $result = mysql_query($sql);      
       return $result;
    }

  function getcurrenttime($mcname,$st_date,$shift)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select op.st_date,op.shift,sum(setting_time),sum(setting_time_mins),
	                        sum(running_time),
					        sum(running_time_mins),sum(idle_time),sum(idle_time_mins),
							sum(breakdown_time),sum(breakdown_time_mins)
				from oper_mc_usage opmc,operator op
				where  opmc.link2operator=op.recnum and
					   op.mc_name='$mcname' and
					   op.st_date = '$st_date' and
					   op.shift = '$shift'
				group by op.mc_name,op.st_date,op.shift
                order by op.st_date desc,op.shift";
				$result = mysql_query($sql);
				//echo "$sql";
				return $result;
  }

  function getEditcurrenttime($mcname,$st_date,$shift,$recnum)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select op.st_date,op.shift,sum(setting_time),sum(setting_time_mins),
	                        sum(running_time),
					        sum(running_time_mins),sum(idle_time),sum(idle_time_mins)
				from oper_mc_usage opmc,operator op
				where  opmc.link2operator=op.recnum and
					   op.mc_name='$mcname' and
					   op.st_date = '$st_date' and
					   op.shift = '$shift'  and op.recnum!=$recnum
				group by op.mc_name,op.st_date,op.shift
                order by op.st_date desc,op.shift";
				$result = mysql_query($sql);
				//echo "$sql";
				return $result;

  }

   function getPrevQTy($wonum)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "SELECT sum(op.qty) 
		         FROM oper_mc_usage op,operator o
				 where o.wo_num='$wonum' and
					   o.recnum=op.link2operator
				 group by o.wo_num";
				$result = mysql_query($sql);
			   //echo "$sql";
				return $result;
  }
   function getwonum4CIM($crn)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
        $siteval = "w.siteid = '".$siteid."'";
        $sql = "select m.recnum,m.partname,m.wonum,m.customer,m.partnum,
                      m.CIM_refnum,w.wonum,w.qty,w.po_num,c.name,w.batchnum,m.rm_spec,m.attachments,d.link2approvedbyowner
                      from master_data m,company c,
                      work_order w left join dates d on (w.recnum=d.link2wo and d.stagenum = 50)
                      where w.link2masterdata = m.recnum and
                            w.wo2customer=c.recnum and
                            w.condition = 'Open' and m.CIM_refnum='$crn' and $siteval
                order by w.wonum";
				$result = mysql_query($sql);
			    // echo "$sql";
				return $result;
  }
   function getprevtime($mcname,$st_date,$shift)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select op.st_date,op.shift,sum(setting_time),sum(setting_time_mins),
	                        sum(running_time),
					        sum(running_time_mins),sum(idle_time),sum(idle_time_mins),
							sum(breakdown_time),sum(breakdown_time_mins)
				from oper_mc_usage opmc,operator op
				where  opmc.link2operator=op.recnum and
					   op.mc_name='$mcname' and
					   op.st_date = '$st_date' and
					   op.shift = '$shift' and op.status='Pending'
				group by op.mc_name,op.st_date,op.shift
                order by op.st_date desc,op.shift";
				$result = mysql_query($sql);
				//echo "$sql";
				return $result;
  }
   function getmachine_data($machine)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select o.oper_name,
                        o.crn,
                        o.mc_name,
						o.shift,
						op.qty,
						o.wo_num,
						o.remarks,
						o.status,
						o.st_date,
						op.setting_time,
						op.setting_time_mins,
						op.running_time,
						op.running_time_mins,
						op.idle_time,
						op.idle_time_mins,
                        op.qty_rej,
						op.stage_num,
                        mc.running_time,
						mc.running_time_mins,
						op.breakdown_time,
						op.breakdown_time_mins
                  FROM operator o,oper_mc_usage op,mc_master m,mc_stage_master mc
				  where o.recnum=op.link2operator and o.mc_name='$machine' and
                        m.crn_num = o.crn and m.recnum=mc.link2mc_master and
                        mc.stage_num=op.stage_num
				  order by o.st_date DESC,o.shift DESC limit 10";
        $result = mysql_query($sql);
	    //echo $sql;
        return $result;
     }



  function getmachine_details4graph($opmcobjid)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select op.oper_name,
		               op.mc_name,
			           o.st_date,
					   o.shift,
					   op.setting_time,
					   op.setting_time_mins,
					   op.running_time,
					   op.running_time_mins,
					   op.qty,
					   op.idle_time,
					   op.idle_time_mins,
					   op.breakdown_time,
					   op.breakdown_time_mins,
					   mc.running_time,
					   mc.running_time_mins,
					   o.crn,
					   op.stage_num,
					   o.wo_num,
					   op.qty_rej,
					   op.qty_acc,
					   op.qty_rew,
					   o.remarks
			from oper_mc_usage op, mc_master m,
			     operator o, 
			     mc_stage_master mc
		where op.link2operator=o.recnum and		
		      m.crn_num = o.crn and
			  m.recnum=mc.link2mc_master and
			  op.stage_num = mc.stage_num and
              op.link2operator = $opmcobjid";
		//echo $sql;
		$result = mysql_query($sql);
        return $result;
  }
 function getselectedOperName($oper_name) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select fname, lname, empcode
                 from employee where
                 role='OP' and fname ='$oper_name'";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;
 }

 function wo_approval($wo)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select * from dates d,work_order w 
                 where d.link2wo=w.recnum and
                 d.stagenum=50 and
                 d.link2approvedbyowner is NOT NULL and
                 w.wonum='$wo'";
        $result = mysql_query($sql);
	//echo "$sql";
	return $result;
 }

 function getwoqty4stage($stage,$wonum)
 {
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $sql = "select sum(op.qty)
                from oper_mc_usage op,operator o
                     where o.wo_num='$wonum' and
                           op.stage_num=$stage and
                           op.link2operator=o.recnum
                           group by o.wo_num ";
    $result = mysql_query($sql);
	//echo "$sql";
	return $result;
 }
 function getncdetails($ncrecnum)
 {
   $newlogin = new userlogin;
    $newlogin->dbconnect();
    $sql = "select recnum,create_date from nc4qa where recnum=$ncrecnum ";
    $result = mysql_query($sql);
//	echo "$sql";
	return $result;
 }

} // End invoice class definition
