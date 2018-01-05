<?
//====================================
// Author: FSI
// Date-written = April 04, 2007
// Filename: mc_masterClass.php
// Maintains the class for mc_master
// Revision: v1.0  OWT
//====================================

include_once('loginClass.php');

class mc_master {
    var
   // $mc_id,
   // $mc_name,
    $crn_num,
  //  $mc_cost_per_hour,
    $qty,
    $setup_time_hrs,
    $setup_time_mins,
    $fitting_time_hrs,
    $fitting_time_mins,
    $insp_time_hrs,
    $insp_time_mins,
    $running_time,
    $setting_time,
    $running_time_mins,
    $setting_time_mins,
    $stage_cost,
    $valperpart,
	$mps_revision,
    $fromdate,$todate;

    // Constructor definition
    function mc_master() {
     //   $this->mc_id = '';
    //    $this->mc_name = '';
        $this->crn_num = '';
    //    $this->mc_cost_per_hour = '';
        $this->qty = '';
        $this->setup_time_hrs = '';
        $this->setup_time_mins = '';
        $this->fitting_time_hrs = '';
        $this->fitting_time_mins = '';
        $this->insp_time_hrs = '';
        $this->insp_time_mins = '';
        $this->running_time = '';
        $this->setting_time = '';
        $this->running_time_mins = '';
        $this->setting_time_mins = '';
        $this->stage_cost = '';
        $this->valperpart = '';
		$this->mps_revision = '';
		$this->fromdate = '';
		$this->todate = '';
     }

   /* function getmc_id() {
           return $this->mc_id;
    }
    function setmc_id ($mc_id) {
           $this->mc_id = $mc_id;
    }

    function getmc_name() {
           return $this->mc_name;
    }
    function setmc_name($mc_name) {
           $this->mc_name = $mc_name;
    }
      */
    function getcrn_num() {
           return $this->crn_num;
    }
    function setcrn_num($crn_num) {
           $this->crn_num = $crn_num;
    }

	function getmps_revision() {
           return $this->mps_revision;
    }
    function setmps_revision($mps_revision) {
           $this->mps_revision = $mps_revision;
    }

  /*  function getmc_cost_per_hour() {
           return $this->mc_cost_per_hour;
    }
    function setmc_cost_per_hour ($mc_cost_per_hour) {
           $this->mc_cost_per_hour = $mc_cost_per_hour;
    }      */
    
    function getqty() {
           return $this->qty;
    }
    function setqty ($qty) {
           $this->qty = $qty;
    }
    function getsetup_time_mins() {
           return $this->setup_time_mins;
    }
    function setsetup_time_mins ($setup_time_mins) {
           $this->setup_time_mins = $setup_time_mins;
    }

    function getsetup_time_hrs() {
           return $this->setup_time_hrs;
    }
    function setsetup_time_hrs ($setup_time_hrs) {
           $this->setup_time_hrs = $setup_time_hrs;
    }
    function getfitting_time_hrs() {
           return $this->fitting_time_hrs;
    }
    function setfitting_time_hrs ($fitting_time_hrs) {
           $this->fitting_time_hrs = $fitting_time_hrs;
    }
    function getfitting_time_mins() {
           return $this->fitting_time_mins;
    }
    function setfitting_time_mins ($fitting_time_mins) {
           $this->fitting_time_mins = $fitting_time_mins;
    }

    function getinsp_time_hrs() {
           return $this->insp_time_hrs;
    }
    function setinsp_time_hrs ($insp_time_hrs) {
           $this->insp_time_hrs = $insp_time_hrs;
    }
    function getinsp_time_mins() {
           return $this->insp_time_mins;
    }
    function setinsp_time_mins($insp_time_mins) {
           $this->insp_time_mins = $insp_time_mins;
    }

	 function getstage_num() {
           return $this->stage_num;
    }
    function setstage_num ($stage_num) {
           $this->stage_num = $stage_num;
    }
    
    function getrunning_time() {
           return $this->running_time;
    }
    function setrunning_time ($running_time) {
           $this->running_time = $running_time;
    }
    
    function getlink2mc_master() {
           return $this->link2mc_master;
    }
    function setlink2mc_master ($link2mc_master) {
           $this->link2mc_master = $link2mc_master;
    }
    
    function getsetting_time() {
           return $this->setting_time;
    }
    function setsetting_time ($setting_time) {
           $this->setting_time = $setting_time;
    }
    
    function getrunning_time_mins() {
           return $this->running_time_mins;
    }
    function setrunning_time_mins($running_time_mins) {
           $this->running_time_mins = $running_time_mins;
    }
    
    function getsetting_time_mins() {
           return $this->setting_time_mins;
    }
    function setsetting_time_mins($setting_time_mins) {
           $this->setting_time_mins = $setting_time_mins;
    }
    function getsstage_cost() {
           return $this->stage_cost;
    }
    function setstage_cost($stage_cost) {
           $this->stage_cost = $stage_cost;
    }
    function getvalpart() {
           return $this->valperpart;
    }
    function setvalpart($valperpart) {
           $this->valperpart = $valperpart;
    }
    function setfromdate($fromdate) {
           $this->fromdate = $fromdate;
    }
    function settodate($todate) {
           $this->todate = $todate;
    }
   function addmc_master() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);

       // $mc_id  = "'" . $this->mc_id . "'";
       // $mc_name = "'" . $this->mc_name . "'";
        $crn_num = "'" . $this->crn_num . "'";
      //  $mc_cost_per_hour = "'" . $this->mc_cost_per_hour . "'";
        $qty = "'" . $this->qty . "'";
        $valpart = "'" . $this->valperpart . "'";
        $setup_time_hrs = $this->setup_time_hrs ? $this->setup_time_hrs :0;
        $setup_time_mins = $this->setup_time_mins ? $this->setup_time_mins : 0;
        $fitting_time_hrs = $this->fitting_time_hrs ? $this->fitting_time_hrs : 0;
        $fitting_time_mins = $this->fitting_time_mins ? $this->fitting_time_mins : 0;
        $insp_time_hrs = $this->insp_time_hrs ? $this->insp_time_hrs : 0;
        $insp_time_mins = $this->insp_time_mins ?$this->insp_time_mins : 0;
        $mps_revision = $this->mps_revision ?$this->mps_revision : 0;
        $fromdate= $this->fromdate ? "'". $this->fromdate ."'"  : "0000-00-00";
        $todate= $this->todate ? "'". $this->todate ."'"  : "0000-00-00";
        $siteid = "'" . $_SESSION['siteid'] . "'";
        
        $sql = "select * from mc_master where crn_num = $crn_num and mps_revision= '$mps_revision'
        and from_date=$fromdate and to_date=$todate";
		//echo 'mps=='.$sql.'===';
           $result = mysql_query($sql);
           if (!(mysql_fetch_row($result)))
           {
            $sql = "INSERT INTO
                        mc_master
                            (
                              crn_num,qty,setup_time,setup_time_mins,
			      fitting_time_hrs,fitting_time_mins,
			      insp_time_hrs,insp_time_mins,val_per_part,mps_revision,from_date,to_date,siteid
                            )
                    VALUES
                            (
                              $crn_num,$qty,$setup_time_hrs,$setup_time_mins,
			      $fitting_time_hrs,$fitting_time_mins,$insp_time_hrs,
			      $insp_time_mins,$valpart,'$mps_revision',$fromdate,$todate,$siteid
                            )";

         //echo $sql;
              $result = mysql_query($sql);

           // Test to make sure query worked
              if(!$result) die("Insert to mc_master didn't work..Please report to Sysadmin. " . mysql_error());
            }
            else
            {
               echo "<table border=1><tr><td><font color=#FF0000>";
               die("crn_num= " . $crn_num . " and MPS Revision= ".$mps_revision." already exists. ");
               echo "</td></tr></table>";
            }

        $sql = 'select max(recnum) from mc_master';
        $result = mysql_query($sql);
        $mc_masterrecnum = mysql_fetch_row($result);

        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for mc_master Insert..Please report to Sysadmin. " . mysql_error());
        return $mc_masterrecnum[0];
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


        $running_time = $this->running_time ? $this->running_time : 0;
        $setting_time = $this->setting_time ? $this->setting_time : 0;
        
        $running_time_mins = $this->running_time_mins ? $this->running_time_mins : 0;
        $setting_time_mins = $this->setting_time_mins ? $this->setting_time_mins : 0;
	    $stage_cost  = $this->stage_cost ? $this->stage_cost : 0;
        $stage_num = $this->stage_num;
        $link2mc_master = $this->link2mc_master;

        $sql = "INSERT INTO
                        mc_stage_master
                            (
                             stage_num,running_time,link2mc_master,setting_time,
                             setting_time_mins,running_time_mins,cost
                            )
                    VALUES
                            (
                             $stage_num,$running_time,$link2mc_master,$setting_time,
                             $setting_time_mins,$running_time_mins,$stage_cost
                            )";

        //  echo $sql;
              $result = mysql_query($sql);

           // Test to make sure query worked
              if(!$result) die("Insert to mc_stage_master didn't work..Please report to Sysadmin. " . mysql_error());

        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for oper_mc_usage Insert..Please report to Sysadmin. " . mysql_error());
        //return $objid;
     }

      function getmc_masters($argoffset,$arglimit,$cond)
      {
        $offset = $argoffset;
        $limit = $arglimit;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
        $siteval = "siteid = '" .$siteid."'";
        $sql = "select recnum,
                        mc_id,
                        mc_name,
                        mc_cost_per_hour,
                        qty,
                        setup_time,
                        crn_num,
			            setup_time_mins,
			            fitting_time_hrs,
			            fitting_time_mins,
			            insp_time_hrs,
			            insp_time_mins,
			            val_per_part,
			            sum(setup_time) as tot_settime,
			            sum(setup_time_mins) as tot_setmins,
			            sum(insp_time_hrs) as tot_insphrs,
			            sum(insp_time_mins) as tot_inspmins,
						mps_revision ,
						from_date,
						to_date
                  FROM mc_master
                  WHERE $cond and $siteval
                  group by recnum
		          order by crn_num,mps_revision
                  limit $offset, $limit";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }
     
     function getmc_mastercount($argoffset,$arglimit,$cond) {
       $offset = $argoffset;
        $limit = $arglimit;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $siteid = $_SESSION['siteid'];
        $siteval = "siteid = '" .$siteid."'";
         $sql = "select count(*) as numrows
                  FROM mc_master
                  WHERE $cond and $siteval
                  limit $offset, $limit";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;
     }

     function getmc_master_data($mc_masterrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,
                        mc_id,
                        mc_name,
                        mc_cost_per_hour,
                        qty,
                        setup_time,
                        crn_num,
						setup_time_mins,
						fitting_time_hrs,
						fitting_time_mins,
						insp_time_hrs,
						insp_time_mins,
						val_per_part,
						mps_revision,
						from_date,
						to_date
                  FROM mc_master where recnum=$mc_masterrecnum";
        $result = mysql_query($sql);
//   echo "$sql";
        return $result;
     }
     
     
     function getmc_master_data1() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select m.recnum,
                        m.mc_id,
                        m.mc_name,
                        m.mc_cost_per_hour,
                        m.qty,
                        m.setup_time,
                        m.setup_time_mins,
						m.fitting_time_hrs,
						m.fitting_time_mins,
						m.insp_time_hrs,
						m.insp_time_mins,
                        m.crn_num,
                        msm.running_time,
                        msm.stage_num,
                        msm.setting_time,
                        msm.running_time_mins,
                        msm.setting_time_mins,m.from_date,m.to_date
                 from mc_master m, mc_stage_master msm
                 where msm.link2mc_master = m.recnum
                 order by m.crn_num, msm.stage_num;";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;
     }
     
     function getstage_data($mc_masterrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,
                        running_time,
                        stage_num,
                        setting_time,
                        running_time_mins,
                        setting_time_mins,
						cost
					FROM mc_stage_master
				  where link2mc_master=$mc_masterrecnum
				  order by stage_num";
        $result = mysql_query($sql);
       //echo "$sql";
        return $result;
    }
    
    function getstage_data4total_hrs($mc_masterrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,
						sum(setting_time) as tot_settime,
						sum(setting_time_mins) as tot_settime_mins,
						sum(running_time) as tot_runtime,
						sum(running_time_mins) as tot_runtime_mins
					FROM mc_stage_master
				  where link2mc_master=$mc_masterrecnum
				  group by link2mc_master
				  order by stage_num";
        $result = mysql_query($sql);
       //echo "$sql";
        return $result;
    }
    function getstage($i,$mc_masterrecnum)
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select *
                  FROM mc_stage_master where link2mc_master=$mc_masterrecnum
                       and stage_num=$i";
        $result = mysql_query($sql);
       // echo "$sql";
        return $result;
    
    }
     
    function updatemc_master($mc_masterrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);

      //  $mc_id  = "'" . $this->mc_id . "'";
      //  $mc_name = "'" . $this->mc_name . "'";
	    $crn_num = "'" . $this->crn_num . "'";
        //$mc_cost_per_hour = "'" . $this->mc_cost_per_hour . "'";
        $qty = "'" . $this->qty . "'";
        $qty = "'" . $this->qty . "'";
        $valpart = "'" . $this->valperpart . "'";
        $setup_time_hrs = $this->setup_time_hrs ? $this->setup_time_hrs :0;
        $setup_time_mins = $this->setup_time_mins ? $this->setup_time_mins : 0;
        $fitting_time_hrs = $this->fitting_time_hrs ? $this->fitting_time_hrs : 0;
        $fitting_time_mins = $this->fitting_time_mins ? $this->fitting_time_mins : 0;
        $insp_time_hrs = $this->insp_time_hrs ? $this->insp_time_hrs : 0;
        $insp_time_mins = $this->insp_time_mins ? $this->insp_time_mins : 0;
        $mps_revision = $this->mps_revision ? $this->mps_revision : 0;
        $fromdate= $this->fromdate ? "'". $this->fromdate ."'"  : "0000-00-00";
        $todate= $this->todate ? "'". $this->todate ."'"  : "0000-00-00";
         $sql = "select * from mc_master where crn_num = $crn_num and mps_revision= '$mps_revision'";
		//echo $sql.'----';
           $result = mysql_query($sql);
          if (mysql_fetch_row($result))
           {
             $sql = "UPDATE mc_master SET
                    qty = $qty,
                    setup_time = $setup_time_hrs,
					setup_time_mins = $setup_time_mins,
                    fitting_time_hrs = $fitting_time_hrs,
					fitting_time_mins = $fitting_time_mins,
					insp_time_hrs = $insp_time_hrs,
					insp_time_mins = $insp_time_mins,
					val_per_part = $valpart,
					mps_revision = '$mps_revision',
					from_date=$fromdate,
					to_date=$todate
			   	  WHERE
                    recnum = $mc_masterrecnum";
       // echo $sql;
        $result = mysql_query($sql);

             if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv5");
                     die("mc_master update failed...Please report to SysAdmin. " . mysql_error());
                     }
           }
            else
            {
                echo "<table border=1><tr><td><font color=#FF0000>";
                die("crn_num= " . $crn_num . " and MPS Revision= ".$mps_revision." already exists. ");
               echo "</td></tr></table>";
            }
     }
     
   function updatestage_data($mc_masterrecnum) {
   
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);

        $running_time = $this->running_time? $this->running_time : 0;
        $setting_time = $this->setting_time? $this->setting_time : 0;
        
        $running_time_mins = $this->running_time_mins? $this->running_time_mins : 0;
        $setting_time_mins = $this->setting_time_mins? $this->setting_time_mins : 0;

	    $stage_cost  = $this->stage_cost ? $this->stage_cost : 0;
        $stage_num = $this->stage_num;
       // $link2mc_master = $this->link2mc_master;

        $sql = "UPDATE mc_stage_master SET
                    running_time = $running_time,
                    setting_time = $setting_time,
                    running_time_mins = $running_time_mins,
                    setting_time_mins = $setting_time_mins,
		            cost = $stage_cost
        	 WHERE
                    link2mc_master = $mc_masterrecnum and
                    stage_num = $stage_num";
        //echo $sql;
        $result = mysql_query($sql);
        
        mysql_query('commit');

        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv5");
                     die("mc_stage_master update failed...Please report to SysAdmin. " . mysql_error());
                     }
     }
    
     function getcrns()
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
        $siteval = "siteid = '".$siteid."'";
         $sql = "select recnum,CIM_refnum from master_data where $siteval order by CIM_refnum";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;
     }
     
     function gettime_master4woprint($crn,$mprev,$wodate)
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select crn_num,stage_num,setting_time,setting_time_mins,running_time,running_time_mins
                        from mc_master,mc_stage_master
                             where mc_master.recnum=mc_stage_master.link2mc_master
                                   and crn_num='$crn' and mps_revision='$mprev'
                                   and '$wodate' between from_date and to_date";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;

    }
    
     function addmc_master4upload() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);

       // $mc_id  = "'" . $this->mc_id . "'";
       // $mc_name = "'" . $this->mc_name . "'";
        $crn_num = "'" . $this->crn_num . "'";
      //  $mc_cost_per_hour = "'" . $this->mc_cost_per_hour . "'";
        $qty = $this->qty?"'" . $this->qty . "'":0;
        $valpart = $this->valperpart?"'" . $this->valperpart . "'":0.0;
        $setup_time_hrs = $this->setup_time_hrs ? $this->setup_time_hrs :0;
        $setup_time_mins = $this->setup_time_mins ? $this->setup_time_mins : 0;
        $fitting_time_hrs = $this->fitting_time_hrs ? $this->fitting_time_hrs : 0;
        $fitting_time_mins = $this->fitting_time_mins ? $this->fitting_time_mins : 0;
        $insp_time_hrs = $this->insp_time_hrs ? $this->insp_time_hrs : 0;
        $insp_time_mins = $this->insp_time_mins ?$this->insp_time_mins : 0;
        $mps_revision = $this->mps_revision ?$this->mps_revision : 0;
        $fromdate= "'2012-08-01'" ;
        $todate= "'2020-08-31'" ;

        $sql = "select * from mc_master where crn_num = $crn_num and from_date=$fromdate and to_date=$todate";
		//echo 'mps=='.$sql.'===';
           $result = mysql_query($sql);
           //if (!(mysql_fetch_row($result)))
           //{
            $sql = "INSERT INTO
                        mc_master
                            (
                              crn_num,qty,setup_time,setup_time_mins,
			      fitting_time_hrs,fitting_time_mins,
			      insp_time_hrs,insp_time_mins,val_per_part,mps_revision,from_date,to_date
                            )
                    VALUES
                            (
                              $crn_num,$qty,$setup_time_hrs,$setup_time_mins,
			      $fitting_time_hrs,$fitting_time_mins,$insp_time_hrs,
			      $insp_time_mins,$valpart,'$mps_revision',$fromdate,$todate
                            )";

        // echo $sql;
              $result = mysql_query($sql);

           // Test to make sure query worked
              if(!$result) die("Insert to mc_master didn't work..Please report to Sysadmin. " . mysql_error());
            //}
           /* else
            {
               echo "<table border=1><tr><td><font color=#FF0000>";
               die("crn_num= " . $crn_num . " and MPS Revision= ".$mps_revision." already exists. ");
               echo "</td></tr></table>";
            } */

        $sql = 'select max(recnum) from mc_master';
        $result = mysql_query($sql);
        $mc_masterrecnum = mysql_fetch_row($result);

        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for mc_master Insert..Please report to Sysadmin. " . mysql_error());
        return $mc_masterrecnum[0];
     }
     
     function check_crn_data($crn_num)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select recnum as recnum from mc_master where crn_num = '$crn_num' and
                from_date='2012-08-01' and to_date='2020-08-31'";
		//echo 'mps=='.$sql.'===';
         $result = mysql_query($sql);
         $row     = mysql_fetch_array($result, MYSQL_ASSOC);
         $recnum = $row['recnum'];
          return $recnum;
     }
	
} // End invoice class definition
