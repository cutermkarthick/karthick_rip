<?
//====================================
// Author: FSI
// Date-written = March 15, 2005
// Filename: reportClass.php
// Maintains the class for all reports
// Revision: v1.0
// Modifications History
//====================================

include_once('loginClass.php');

class report {

     function getWFstages ($inptype) {
        $userid = "'" . $_SESSION['user'] . "'";
        $type = "'" . $inptype . "'";
        if ($_SESSION['usertype'] == 'EMPL')
        {
           if ($_SESSION['userrole'] == 'SU' || $_SESSION['userrole'] == 'SALES')
           {

              $sql = "select status
                       from work_flow_config
                       where type = $type and
                             allow_report_disp = 'Y'
                       order by stage asc
                     ";


           }
        }
        $result = mysql_query($sql);
        return $result;
     }


     function getdates4WO($inpworecnum) {
        $worecnum = $inpworecnum;
        $userid = "'" . $_SESSION['user'] . "'";

        if ($_SESSION['usertype'] == 'EMPL')
        {
           if ($_SESSION['userrole'] == 'SU' || $_SESSION['userrole'] == 'SALES')
           {

             $sql = "select date_format(d.completed,'%d %b %y')
                        from dates d, work_flow_config wf
                       where
                            d.link2wo = $worecnum and
                            d.link2wfconfig = wf.recnum and
                            wf.allow_report_disp = 'Y'
                       order by wf.stage asc";
           }
        }
        $result = mysql_query($sql);
        return $result;

     }

     function getWOs ($inptype,$argcond,$argoffset,$arglimit) {
        $userid = "'" . $_SESSION['user'] . "'";
        $offset = $argoffset;
        $limit = $arglimit;
        $cond=$argcond;
        $type = "'" . $inptype . "'";

        if ($_SESSION['usertype'] == 'EMPL')
        {
           if ($_SESSION['userrole'] == 'SU' || $_SESSION['userrole'] == 'SALES')
           {

               $sql = "select w.wonum,c.name, date_format(w.sch_due_date,'%d %b %y'),w.recnum
                        from work_order w, company c
                        where $cond and
		                w.wotype = $type and
                              w.`condition` = 'Open' and
                              w.wo2customer = c.recnum and
                             (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = '')
                       order by w.wonum asc limit $offset, $limit";
           }
        }
//echo "$sql";
        $result  = mysql_query($sql) or die('WO query for report failed');
        return $result;

     }

     function getWOs4print ($inptype,$argcond) {
        $userid = "'" . $_SESSION['user'] . "'";
        $cond=$argcond;
        $type = "'" . $inptype . "'";

        if ($_SESSION['usertype'] == 'EMPL')
        {
           if ($_SESSION['userrole'] == 'SU' || $_SESSION['userrole'] == 'SALES')
           {

               $sql = "select w.wonum,c.name, date_format(w.sch_due_date,'%d %b %y'),w.recnum
                        from work_order w, company c
                        where $cond and
		w.wotype = $type and
                              w.`condition` = 'Open' and
                              w.wo2customer = c.recnum and
                             (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = '')
                       order by w.wonum asc";
           }
        }
//echo "$sql";
        $result  = mysql_query($sql) or die('WO query for report failed');
        return $result;

     }

     function getWOcount ($argoffset,$arglimit,$inptype) {
        $userid = "'" . $_SESSION['user'] . "'";
        $offset = $argoffset;
        $limit = $arglimit;
        $type = "'" . $inptype . "'";

        if ($_SESSION['usertype'] == 'EMPL')
        {
           if ($_SESSION['userrole'] == 'SU' || $_SESSION['userrole'] == 'SALES')
           {

               $sql = "select count(*) as numrows
                        from work_order
                        where wotype = $type and
                              `condition` = 'Open' and
                             (actual_ship_date is NULL || actual_ship_date = '0000-00-00' || actual_ship_date = '')
                       limit $offset, $limit";
           }
        }

        $result  = mysql_query($sql) or die('WO count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];

        return $numrows;

     }

function getbookdates($argmonth,$argyear)
{
	//echo "argmonth:$argmonth<br>";
        $sql="select count(book_date),date_format(book_date,'%b %Y') from work_order where date_format(book_date,'%b') = '$argmonth' && date_format(book_date,'%Y') = '$argyear' group by date_format(book_date,'%b')";
     // echo "<br>$sql<br>";
        $result = mysql_query($sql);
        if(!$result) die("Selet of book date Failed. " . mysql_error());
        return $result;
}


function getbookdates4year($argyears)
{
	//echo "argyears:$argyears<br>";
        $sql="select count(book_date),date_format(book_date,'%Y') from work_order where date_format(book_date,'%Y') = '$argyears' group by date_format(book_date,'%Y')";
       //echo "<br>$sql<br>";
        $result = mysql_query($sql);
        if(!$result) die("Selet of book date Failed. " . mysql_error());
        return $result;
}



 function getCountbookdates()
{
    // $sql="select count(*) as numrows from work_order group by date_format(book_date,'%b')";
    // $sql="select recnum,wonum,book_date from work_order ";

         $sql="select count(*) as numrows from work_order group by date_format(book_date,'%b')";
       // echo "<br>$sql<br>";
       $result  = mysql_query($sql) or die('sbookdates count query failed');
       $row     = mysql_fetch_array($result, MYSQL_ASSOC);
       $numrows = $row['numrows'];
       return $numrows;
}
 function getsheduledates($argmonth,$argyear)
{
        $sql="select count(actual_ship_date),date_format(actual_ship_date,'%b %Y') from work_order where date_format(actual_ship_date,'%b') = '$argmonth' && date_format(actual_ship_date,'%Y') = '$argyear' group by date_format(actual_ship_date,'%b')";
       // echo "<br>$sql<br>";
        $result = mysql_query($sql);
        if(!$result) die("Selet of book date Failed. " . mysql_error());
        return $result;
}
 function getCountsheduledates()
{
        $sql="select count(*) as numrows from work_order group by date_format(book_date,'%b')";
        //echo "<br>$sql<br>";
       $result  = mysql_query($sql) or die('sheduledates count query failed');
       $row     = mysql_fetch_array($result, MYSQL_ASSOC);
       $numrows = $row['numrows'];
       return $numrows;
}

 function getmonths()
{
        $sql="select distinct date_format(book_date,'%b') from work_order group by date_format(book_date,'%b')";
       //echo "<br>$sql<br>";
        $result = mysql_query($sql);
        if(!$result) die("Selet of book date Failed. " . mysql_error());
        return $result;
}

function getyear()
{
        $sql="select distinct date_format(book_date,'%Y') from work_order group by date_format(book_date,'%Y')";
        //$sql="select count(*) as numrows from work_order group by date_format(book_date,'%Y')";
       // $sql="select distinct date_format(book_date,'%Y') from work_order group by date_format(book_date,'%Y')";
       //echo "<br>$sql<br>";
        $result = mysql_query($sql);
        if(!$result) die("Selet of book date Failed. " . mysql_error());
        return $result;
}

function getopenBoards($argmonth)
{
        $sql="select count(wotype),date_format(book_date,'%b') from work_order where wotype='Board' and date_format(book_date,'%b') = '$argmonth' group by date_format(book_date,'%b')";
     //echo "<br>$sql<br>";
        $result = mysql_query($sql);
        if(!$result) die("Selet of book date Failed. " . mysql_error());
        return $result;
}
function getopenSockets($argmonth)
{
        $sql="select count(wotype),date_format(book_date,'%b') from work_order where wotype='Socket' and date_format(book_date,'%b') = '$argmonth' group by date_format(book_date,'%b')";
       // echo "<br>$sql<br>";
        $result = mysql_query($sql);
        if(!$result) die("Selet of book date Failed. " . mysql_error());
        return $result;
}

function getop_crns() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select mc_name,crn,oper_name
                  FROM operator order by oper_name";
        $result = mysql_query($sql);
   //echo "$sql";
        return $result;
     }
 
     function getops($cond)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select fname,lname
                  FROM employee where 
		   $cond and 
		   role='op'
                    order by fname, lname";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;
     }

function getcrns($op) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select mc_name,crn,oper_name,wo_num
                  FROM operator op
				where op.oper_name = '$op'";
        $result = mysql_query($sql);
       // echo "$sql";
        return $result;
     }

     
function getmcmins($mc,$op,$crn,$cond)
    {
    //echo $mc;
    // echo $op;
      $newlogin = new userlogin;
        $newlogin->dbconnect();
       $sql="select recnum from operator where oper_name='$op' and crn='$crn'";
       $result=mysql_query($sql);
       $operrecnum=mysql_fetch_row($result);
       
       $sql="select recnum from mc_master where crn_num='$crn'";
       $result1=mysql_query($sql);
       $mcrecnum=mysql_fetch_row($result1);
      // echo 'hii ' . $operrecnum[0];
               
    $sql = "select wo.wonum,oper_mc_usage.oper_name as oper_name,
                      sum(oper_mc_usage.running_time),
                      sum(mc_stage_master.running_time*oper_mc_usage.qty),
                      sum(oper_mc_usage.setting_time),
                      sum(mc_stage_master.setting_time*oper_mc_usage.qty),
                      sum(oper_mc_usage.running_time_mins),
                      sum(mc_stage_master.running_time_mins*oper_mc_usage.qty),
                      sum(oper_mc_usage.setting_time_mins),
                      sum(mc_stage_master.setting_time_mins*oper_mc_usage.qty)
               from work_order wo,master_data md,operator op,mc_master,mc_stage_master
                      left outer join oper_mc_usage on oper_mc_usage.stage_num=mc_stage_master.stage_num
               where  $cond and
		      oper_mc_usage.link2operator=op.recnum and
                      op.crn = md.CIM_refnum
                      and mc_stage_master.link2mc_master=mc_master.recnum
                      and wo.link2masterdata = md.recnum
                      and op.wo_num = wo.wonum
                      and op.crn = mc_master.crn_num
		      and op.oper_name = '$op'
                group by op.oper_name";

 
     //echo $sql;
                  
        $result = mysql_query($sql);
//echo "$sql";

        return $result;
    }
    
   function getcrn_details()
    {

  //  echo $mc;
  //  echo $op;
      $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select crn,wo_num
                from operator
                group by wo_num";

       //echo $sql;

        $result = mysql_query($sql);

        return $result;
    }
    
     function getact_time()
    {

  //  echo $mc;
  //  echo $op;
      $newlogin = new userlogin;
        $newlogin->dbconnect();

       /* $sql = "select op.crn,sum(running_time) as time,op.recnum
                from operator op,oper_mc_usage mc
                where op.recnum=mc.link2operator
                group by op.crn"; */

        $sql=  "select op.crn,sum(mc.running_time) as time,sum(mc_stage_master.running_time * mc.qty) as time1,
                        mc.mc_name,op.wo_num,
                        sum(mc.running_time_mins) as mins1,sum(mc_stage_master.running_time_mins * mc.qty) as mins2
                from operator op,mc_master m, oper_mc_usage mc
                left outer join mc_stage_master on mc_stage_master.stage_num=mc.stage_num
                where op.recnum=mc.link2operator and
                      m.recnum=mc_stage_master.link2mc_master and
                      op.crn = m.crn_num
                group by op.wo_num";
       //echo $sql;

        $result = mysql_query($sql);

        return $result;
    }
    
    
    function get_qtys($wonum)
    {

  //  echo $mc;
  //  echo $op;
      $newlogin = new userlogin;
        $newlogin->dbconnect();

       /* $sql = "select op.crn,sum(running_time) as time,op.recnum
                from operator op,oper_mc_usage mc
                where op.recnum=mc.link2operator
                group by op.crn"; */

        $sql=  "select sum(wps.rework) as rework_qty,sum(wps.rej) as rej_qty
                from wo_part_status wps,work_order w, operator op
                where w.wonum='$wonum' and
                      op.wo_num=w.wonum and
                      wps.link2wo = w.recnum
                group by op.wo_num";
       //echo $sql;

        $result = mysql_query($sql);

        return $result;
    }
    
    function calc_mins($ideal,$actual,$ideal_mins,$actual_mins)
    {
        $ideal = ($ideal * 60) + $ideal_mins;
        $actual = ($actual * 60) + $actual_mins;
        $mins = $actual - $ideal;
        return $mins;
    }
    
    function calc_efficiency($ideal,$actual,$ideal_mins,$actual_mins)
    {

        $totideal = ($ideal * 60) + $ideal_mins;
        $totactual = ($actual * 60) + $actual_mins;
        $eff = ($totideal/$totactual)*100;
        return $eff;
    }
/*    
// Modofied on Aug 26, 08;
// Query modified to user op.oper_name in where clause instead of
//  oper_mc_usage.oper_name
    function getopdrilldown($op,$cond)
    {
      //echo '$cond'.$cond;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select
                     op.crn,
                     op.st_date,
                     op.shift,
                     sum((oper_mc_usage.running_time*60)+oper_mc_usage.running_time_mins),
                     sum((mc_stage_master.running_time*oper_mc_usage.qty*60)+(mc_stage_master.running_time_mins*oper_mc_usage.qty)),
                     sum((mc_stage_master.running_time*oper_mc_usage.qty*60)+(mc_stage_master.running_time_mins*oper_mc_usage.qty))-sum((oper_mc_usage.running_time*60)+oper_mc_usage.running_time_mins),
                     op.wo_num,
                     sum((oper_mc_usage.setting_time*60)+oper_mc_usage.setting_time_mins),
                     sum((mc_stage_master.setting_time*oper_mc_usage.qty*60)+(mc_stage_master.setting_time_mins*oper_mc_usage.qty)),
                     sum((mc_stage_master.setting_time*oper_mc_usage.qty*60)+(mc_stage_master.setting_time_mins*oper_mc_usage.qty))-sum((oper_mc_usage.setting_time*60)+oper_mc_usage.setting_time_mins),
                     sum(oper_mc_usage.running_time_mins),
                     sum(mc_stage_master.running_time_mins*oper_mc_usage.qty),
                     sum(oper_mc_usage.running_time_mins)-sum(mc_stage_master.running_time_mins*oper_mc_usage.qty),
                     sum(oper_mc_usage.setting_time_mins),
                     sum(mc_stage_master.setting_time_mins*oper_mc_usage.qty),
                     sum(oper_mc_usage.setting_time_mins)-sum(mc_stage_master.setting_time_mins*oper_mc_usage.qty),
                     oper_mc_usage.stage_num,oper_mc_usage.qty, op.mc_name,
                     (oper_mc_usage.idle_time*60+oper_mc_usage.idle_time_mins),
                     oper_mc_usage.qty_rej,
                     sum((oper_mc_usage.markup_time*60)+oper_mc_usage.markup_time_mins),
                     sum((oper_mc_usage.markdown_time*60)+oper_mc_usage.markdown_time_mins)
               from operator op,  mc_master,work_order wo,mc_stage_master
               left outer join oper_mc_usage on oper_mc_usage.stage_num=mc_stage_master.stage_num
               where $cond and
                    op.oper_name='$op' and
                    mc_master.crn_num = op.crn and
                    mc_stage_master.link2mc_master=mc_master.recnum and
                    op.recnum = oper_mc_usage.link2operator and
                    op.wo_num = wo.wonum
               group by op.st_date,op.shift,oper_mc_usage.stage_num,op.crn,wo.wonum
               order by op.st_date,op.shift,oper_mc_usage.stage_num";
             // echo $sql;
             // echo'-----';
               $result = mysql_query($sql);
       if(!$result) die("Query failed for Drilldown Operator eff. " . mysql_error());
       return $result;
     }
*/

// Developed by BM on July 1,2008
// Used by WO Status report
// March 30, 2010 - Stored wopartstatus as prev because temporarily we
// had to remove the Cust PO match for wopartstatus so that CIM can get
// their stock correctly...will have to revert back to this after correction.
function wopartstatus_prev ($cond,$argoffset,$arglimit)
     {
         $wcond = $cond;
         $offset= $argoffset;
         $limit= $arglimit;
         $sql = "select c.name,
                        s.po_num, s.order_date,
                        s.order_date,s.order_date,
                        m.CIM_refnum,
                        w.wonum,
                        w.qty,
			w.comp_qty,
			w.actual_ship_date,
			w.book_date,
                        sum(wps.acc),
                        sum(wps.rework),
                        sum(wps.rej),
                        sum(wps.ret)
                   from company c, 
                       sales_order s,
                       master_data m,
                       work_order w,      
                       wo_part_status wps
                  where wps.link2wo = w.recnum and
                       (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi') and
                       $wcond and
                       c.recnum = s.so2customer and
                       w.po_num = s.po_num and
                       w.recnum = wps.link2wo and 
                       w.link2masterdata = m.recnum and
					   w.`condition` != 'Cancelled'
                  group by w.wonum
                  order by (w.wonum+0) limit $offset,$limit";
		//echo $sql;
        $result = mysql_query($sql);
       if(!$result) die("Query failed for wopartstatus . " . mysql_error());
       return $result;
  
     }

function wopartstatus ($cond,$argoffset,$arglimit)
     {
         $wcond = $cond;
         $offset= $argoffset;
         $limit= $arglimit;
         $sql = "select c.name,
                       m.CIM_refnum,
					   m.CIM_refnum,
					   m.CIM_refnum,
					   m.CIM_refnum,
                        m.CIM_refnum,
                        w.wonum,
                        w.qty,
			w.comp_qty,
			w.actual_ship_date,
			w.book_date,
                        sum(wps.acc),
                        sum(wps.rework),
                        sum(wps.rej),
                        sum(wps.ret)
                   from company c, 
                       master_data m,
                       work_order w,      
                       wo_part_status wps
                  where wps.link2wo = w.recnum and
                       (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi') and
                       $wcond and
                       w.recnum = wps.link2wo and 
					   w.wo2customer = c.recnum and 
                       w.link2masterdata = m.recnum  and
					   w.`condition` != 'Cancelled'
                  group by w.wonum
                  order by (w.wonum+0) limit $offset,$limit";
		//echo $sql;
        $result = mysql_query($sql);
       if(!$result) die("Query failed for wopartstatus . " . mysql_error());
       return $result;
  
     }
function wopartstatuscount ($cond)
     {
         $wcond = $cond;
         $sql = "select c.name,
                        s.po_num, s.order_date,
                        s.order_date,s.order_date,
                        m.CIM_refnum,
                        w.wonum,
                        w.qty,
			w.comp_qty,
			w.actual_ship_date,
			w.book_date,
                        sum(wps.acc),
                        sum(wps.rework),
                        sum(wps.rej),
                        sum(wps.ret)
                   from company c, 
                       sales_order s,
                       master_data m,
                       work_order w,      
                       wo_part_status wps
                   where wps.link2wo = w.recnum and
                       (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi') and
                       $wcond and
                       c.recnum = s.so2customer and
                       w.po_num = s.po_num and
                       w.recnum = wps.link2wo and 
                       w.link2masterdata = m.recnum
                       group by w.wonum
                  order by w.wonum";
		//echo $sql;
        $result = mysql_query($sql);
        $numrows = mysql_num_rows($result);
       if(!$result) die("Query failed for count . " . mysql_error());
       //echo $numrows;
       return $numrows;

     }       



// Developed by BM on Sep 16,2008
// Used by WO Status Report
     function get_disp4worep($inpwo)
     {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select d.relnotenum, dli.dispatch_qty
               from dispatch d, dispatch_line_items dli
               where  d.recnum = dli.link2dispatch and 
                      dli.wonum = '$inpwo'";
      // echo $sql;
       $result = mysql_query($sql);
       return $result;
    }

// Developed by BM on July 7,2008
// Used by Product Performance report
     function get_closed_wos($cond)
     {
      $wcond= $cond;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select w.wonum, crn.CIM_refnum, w.comp_qty,
	                 sum(wps.rework) as rework_qty,
	                 sum(wps.rej) as rej_qty
                from wo_part_status wps,work_order w, 
                     master_data crn, company c
                where $wcond and
                      w.link2masterdata = crn.recnum and
                      c.recnum = w.wo2customer and 
                      wps.link2wo = w.recnum and
		      (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi')					   
                group by w.wonum";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }

// Developed by BM on July 7,2008
// Used by Product Performance report
     function get_est_time($inpcrn,$inpqty)
     {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
	  $qty = (int)$inpqty;
	  $sql=  "select
	            sum(msm.running_time*60*$qty + msm.running_time_mins*$qty + msm.setting_time*60 + msm.setting_time_mins)
               from mc_master m, mc_stage_master msm
               where  msm.link2mc_master = m.recnum and 
                      m.crn_num = '$inpcrn'";
      // echo $sql;
       $result = mysql_query($sql);
       return $result;
    }

// Developed by BM on July 7,2008
// Used by Product Performance report
   function get_act_time($inpwo)
   {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
	  $sql=  "select sum(opmc.running_time*60 + opmc.running_time_mins + 
                         opmc.setting_time*60 + opmc.setting_time_mins +
						 opmc.idle_time*60 + opmc.idle_time_mins) 
                from operator op, oper_mc_usage opmc
                where op.recnum=opmc.link2operator and
                      op.wo_num = '$inpwo'";
      // echo $sql;
       $result = mysql_query($sql);
       return $result;
   }
/*
// Developed by BM on July 7,2008
// Used by Stock GRN Status report
     function get_stockbygrn($cond,$argoffset,$arglimit)
     {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select grn.grnnum, grn.recieved_date, 
                     grn.raw_mat_type, grn.raw_mat_spec, 
                     sum(grnli.qty_to_make), grn.crn ,grn.rmbycim
               from grn_li grnli, grn grn
               where $wcond and
                     grn.recnum = grnli.link2grn and
                     grn.rmbycim != '' and
                     grn.rmbycust = ''
               group by grn.grnnum 
               order by grn.grnnum 
               limit $offset,$limit ";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }
    function getstockgrn_count($cond,$argoffset,$arglimit)
    {
     $wcond = $cond;
     $offset = $argoffset;
     $limit = $arglimit;
      $sql=  "select count(grn.recnum) as
               numrows from grn grn
              where $wcond
              and grn.rmbycim != '' and grn.rmbycust = '' and grn.status = 'Approved'";
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     // echo $sql;
     $result  = mysql_query($sql) or die('stockgrn count query failed');
     $row     = mysql_fetch_array($result, MYSQL_ASSOC);
     $numrows = $row['numrows'];
    // echo $numrows;
     return $numrows;
   }
*/
    function getrmprice($crnnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select soli.partnum,soli.rmprice,soli.rmprice,soli.rmprice,so.currency 
                      from sales_order so, so_line_items soli
                       where
                        so.recnum = soli.link2so and
                        soli.crn_num = '$crnnum' 
			limit 1";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
   }


     function get_woqty4stock_grn($grnnum) 
     {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select w.wonum,(w.qty),sum(wps.ret) from work_order w
                        left join wo_part_status wps on (wps.link2wo=w.recnum)
                 where w.grnnum='$grnnum'
                 group by wps.link2wo
                 order by w.wonum";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Get woqty4stock grn query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }

     function get_stockbygrn4totalcost($cond)
     {
      $wcond = $cond;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select grn.grnnum, grn.recieved_date, 
                     grn.raw_mat_type, grn.raw_mat_spec, 
                     sum(grnli.qty_to_make), grn.crn ,grn.rmbycim
               from grn_li grnli, grn grn
               where $wcond and
                     grn.recnum = grnli.link2grn and
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
                     grn.status = 'Approved'
               group by grn.grnnum";
      // echo $sql;
       $result = mysql_query($sql);
       return $result;
     }

    
     function get_stockbygrn4totalcost_bak($cond)
     {
      $wcond = $cond;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select grn.grnnum, grn.recieved_date, grn.raw_mat_type, grn.raw_mat_spec,
                    sum(gli.qty_to_make),grn.crn,grn.rmbycim,sum(wo.qty),sum(wps.ret)
                 from grn_li gli,
                 grn grn left join work_order wo on grn.grnnum = wo.grnnum
                 left join wo_part_status wps on wps.link2wo = wo.recnum
                   and (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi') 
                 where $wcond and 
                       gli.link2grn = grn.recnum and
                       grn.rmbycim != '' and
                       grn.rmbycust = ''
                 group by grn.grnnum";
       echo $sql;
       $result = mysql_query($sql);
       return $result;
    }


// Developed by BM on Aug 21,2008
// Used by Stock GRN Status report
    function get_woqty($grnnum) {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select wo.grnnum,sum(wo.qty)
                 from work_order wo
                 where
                      wo.grnnum = '$grnnum'
                 group by wo.grnnum";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Get MI details query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }
// Developed by BM on Aug 21,2008
// Used by Stock GRN Status report
    function get_woretqty($grnnum) {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select wo.grnnum,sum(wps.ret)
                       from work_order wo
                       left join wo_part_status wps on wps.link2wo = wo.recnum
                       where
                           wo.grnnum = '$grnnum'
                 group by wo.grnnum";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Get MI details query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }
// Developed by BM on Aug 26,2008
// Used by CRN Cost report
     function get_mccost($mc,$cond)
     {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select op.mc_name,op.crn,op.st_date,op.shift,
                     sum((mc_stage_master.cost * mc.qty)),
                      mc_stage_master.cost, sum(mc.qty)
                 from operator op,mc_master m, oper_mc_usage mc
                 left outer join mc_stage_master on mc_stage_master.stage_num=mc.stage_num
                 where  $cond and
                      op.recnum=mc.link2operator and
                      m.recnum=mc_stage_master.link2mc_master and
                      op.crn = m.crn_num and
                      op.mc_name = '$mc'
                group by op.mc_name, op.st_date,op.crn,op.shift
                order by op.mc_name, op.st_date, op.shift";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Get MC Cost query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }

// Developed by BM on Sep 5,2008
// Used by Production Shiftwise Record
     function get_prodrecord($mc,$cond)
     {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select op.mc_name,
                        op.st_date,
                        op.shift,
                        op.oper_name,
                        op.crn,
                        op.wo_num,
                        op_mc.qty,
                        op_mc.stage_num,
                        op_mc.setting_time,
                        op_mc.setting_time_mins,
                        op_mc.running_time,
                        op_mc.running_time_mins,
                        op_mc.idle_time,
                        op_mc.idle_time_mins,
                        op.remarks
                  FROM operator op, oper_mc_usage op_mc
                  where $cond and
                        op.mc_name = '$mc' and
                        op_mc.link2operator=op.recnum
                  order by op.st_date,op.shift,op.oper_name,op_mc.stage_num";
       // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Get Production Record query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }
     
     function getqasummary4status($cond,$argsort1,$argoffset,$arglimit) {

        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;

        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,crn,relase_note,qa_date,qty_disp,inspected_by,qty_accp,wonum
                 FROM accp_rating
                 where $wcond order by crn,wonum  limit $offset, $limit";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;

     }


     function getqacount4status($cond,$argoffset, $arglimit)
     {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;

             $sql = "select count(*) as numrows from accp_rating
                      where $wcond limit $offset, $limit";
		//echo $sql;
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $result  = mysql_query($sql) or die('accp_rating count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;

     }
     function getcrn4effncy($cond) {
    // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select wo.create_date,wo.wonum,(wo.qty),m.CIM_refnum,sum(wps.acc),
                 sum(wps.rej),sum(wps.ret),wo.recnum,sum(wps.rework)
          from work_order wo,master_data m,wo_part_status wps
          where  wo.link2masterdata = m.recnum and wo.recnum = wps.link2wo
          and (wps.stage = 'final' or wps.stage = 'Final' or wps.stage = 'FINAL'
          or wps.stage = 'fi' or  wps.stage = 'FI' or wps.stage = 'Fi')
          and (wo.wo2customer != 0 or wo.wo2customer is not NULL)
          and wo.grnnum != '' and wo.`condition`='Closed' and $cond
          group by m.CIM_refnum";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }
     
function getwoqty4crneff($crn,$cond) {
        // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select sum(wo.qty),wo.wonum 
                from work_order wo, 
                     master_data md 
                where wo.link2masterdata=md.recnum and
                      md.CIM_refnum='$crn' and
                      wo.`condition`='Closed' and
                      $cond
                 group by md.CIM_refnum;";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }

     
    function getwodetails4crn_eff($crnnum,$cond) {
        // echo "----".$cond;
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select wo.wonum,wo.qty,sum(wps.acc),sum(wps.rej),sum(wps.ret),
                        wo.`condition`,wo.book_date,sum(wps.rework)
                   from master_data md,
                        work_order wo 
                   left join wo_part_status wps on (wo.recnum=wps.link2wo  and 
                        (wps.stage = 'final' or wps.stage = 'Final' or wps.stage = 'FINAL'
                         or wps.stage = 'fi' or  wps.stage = 'FI' or wps.stage = 'Fi'))
                   where wo.link2masterdata = md.recnum and 
                       md.CIM_refnum like '$crnnum' and
                       wo.`condition` = 'Closed' and
                       $cond
                 group by wo.wonum
                 order by wo.wonum";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }
/*     
     function getsettime4eff($operator,$cond) {
    // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select sum(mcsm.setting_time*60 + mcsm.setting_time_mins),
                        sum(opmc.setting_time*60 + opmc.setting_time_mins)
       from operator op,oper_mc_usage opmc,mc_stage_master mcsm,mc_master mcm
             where $cond
             and op.crn=mcm.crn_num
             and opmc.stage_num=mcsm.stage_num
             and op.recnum = opmc.link2operator
             and (opmc.setting_time >0 or opmc.setting_time_mins>0)
             and mcm.recnum=mcsm.link2mc_master
             and op.oper_name='$operator'
             group by op.oper_name
             order by op.oper_name ";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }
*/
/*
     function geteffdetails($operator,$cond)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select op.crn,opmc.stage_num,opmc.qty,
       sum((opmc.setting_time * 60)+opmc.setting_time_mins),
       sum((((mcsm.setting_time * 60) + mcsm.setting_time_mins)) * opmc.qty),
       sum(((opmc.running_time * 60)+opmc.running_time_mins)+((opmc.markup_time * 60)+opmc.markup_time_mins)-((opmc.markdown_time * 60)+opmc.markdown_time_mins)),
       sum((((mcsm.running_time * 60) + mcsm.running_time_mins)) * opmc.qty)
           from operator op,oper_mc_usage opmc,
       mc_master mc,mc_stage_master mcsm
    where  $cond and op.crn = mc.crn_num and
          opmc.link2operator = op.recnum and
          mcsm.link2mc_master = mc.recnum and
          op.oper_name = '$operator' and
          opmc.stage_num = mcsm.stage_num and
          op.crn = mc.crn_num
    group by op.crn,opmc.stage_num";
        $result = mysql_query($sql);
     //echo "$sql";
        return $result;
     }
*/
     function getstagenum($oper_name,$cond) {
    // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select op.oper_name,op.crn,opmc.stage_num,opmc.qty_rej
             from oper_mc_usage opmc,operator op
             where $cond and
             opmc.qty_rej != 0 and
             op.recnum=opmc.link2operator and
             op.oper_name='$oper_name'";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }

	 /*
      function getmaster_rejtime($crn,$stagenum,$qty_rej) {
    // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select mc.crn_num,mcsm.stage_num,sum((mcsm.running_time*60) + mcsm.running_time_mins )*$qty_rej
             from mc_master mc,mc_stage_master mcsm
             where mc.crn_num ='$crn'
             and mc.recnum=mcsm.link2mc_master
             and mcsm.stage_num <= $stagenum
             and (mcsm.stage_num % 2 != 0)
             group by mc.crn_num";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }
*/     
 /*    function getmaster_rejtime4prodn_eff_tab($crn,$stagenum,$qty_rej) {
    // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select mc.crn_num,mcsm.stage_num,sum(((mcsm.running_time*60) + mcsm.running_time_mins )*$qty_rej)
             from mc_master mc,mc_stage_master mcsm
             where mc.crn_num ='$crn'
             and $qty_rej != 0
             and mc.recnum=mcsm.link2mc_master
             and mcsm.stage_num = $stagenum
             group by mc.crn_num,mcsm.stage_num";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }
 */
     function getmaster_rejtime4prodn_eff($crn,$stagenum,$qty_rej) {
    // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select mc.crn_num,mcsm.stage_num,(((mcsm.running_time*60) + mcsm.running_time_mins )*$qty_rej)
             from mc_master mc,mc_stage_master mcsm
             where mc.crn_num ='$crn'
             and mc.recnum=mcsm.link2mc_master
             and mcsm.stage_num = $stagenum
             group by mc.crn_num";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }
/*     
      function getsettime4row($op,$cond)
      {
        //echo $cond;

      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select op.st_date,
                     op.crn,
                     op.wo_num,
                     op.shift,
                     sum(mcsm.setting_time*60 + mcsm.setting_time_mins),
                     sum(opmc.setting_time*60 + opmc.setting_time_mins),
                     opmc.stage_num
                from operator op,oper_mc_usage opmc,mc_stage_master mcsm,mc_master mcm
                where $cond
                      and op.crn=mcm.crn_num
                      and opmc.stage_num=mcsm.stage_num
                      and op.recnum = opmc.link2operator
                      and (opmc.setting_time >0 or opmc.setting_time_mins>0)
                      and mcm.recnum=mcsm.link2mc_master
                      and op.oper_name='$op'
               group by op.oper_name,op.st_date, op.shift,opmc.stage_num,op.crn,op.wo_num
               order by op.st_date";
              //echo $sql;
               $result = mysql_query($sql);
       if(!$result) die("Query failed for operator row settime. " . mysql_error());
       return $result;
     }
*/     
     function gettime4prodn_eff_tab($mc_name,$cond) {
    // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select op.mc_name,op.crn,opmc.stage_num,sum(opmc.qty),
                sum((mcsm.setting_time*60+mcsm.setting_time_mins)*
                    ((opmc.setting_time+opmc.setting_time_mins)/(opmc.setting_time+opmc.setting_time_mins))) as master_settime,
                sum(opmc.setting_time*60 + opmc.setting_time_mins) as oper_settime,
                sum(((opmc.running_time * 60)+opmc.running_time_mins)+((opmc.markup_time * 60)+opmc.markup_time_mins)-((opmc.markdown_time * 60)+opmc.markdown_time_mins)) as oper_runtime,
                sum((((mcsm.running_time * 60) + mcsm.running_time_mins)) * (opmc.qty)) as master_runtime,
                sum(opmc.qty_rej)
             from operator op,oper_mc_usage opmc,
             mc_master mc,mc_stage_master mcsm
          where $cond and op.crn = mc.crn_num and
          opmc.link2operator = op.recnum and
          mcsm.link2mc_master = mc.recnum and
          op.mc_name = '$mc_name' and
          opmc.stage_num = mcsm.stage_num
          group by op.crn,opmc.stage_num";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }
     
     function gettime4prodn_eff($mc_name,$cond) {
    // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select op.mc_name,op.crn,opmc.stage_num,opmc.qty,
                ((mcsm.setting_time*60+mcsm.setting_time_mins)*
                    ((opmc.setting_time+opmc.setting_time_mins)/(opmc.setting_time+opmc.setting_time_mins))) as master_settime,
                (opmc.setting_time*60 + opmc.setting_time_mins) as oper_settime,
                (((opmc.running_time * 60)+opmc.running_time_mins)+((opmc.markup_time * 60)+opmc.markup_time_mins)-((opmc.markdown_time * 60)+opmc.markdown_time_mins)) as oper_runtime,
                ((((mcsm.running_time * 60) + mcsm.running_time_mins)) * opmc.qty) as master_runtime,
                opmc.qty_rej
             from operator op,oper_mc_usage opmc,
             mc_master mc,mc_stage_master mcsm
          where $cond and op.crn = mc.crn_num and
          opmc.link2operator = op.recnum and
          mcsm.link2mc_master = mc.recnum and
          op.mc_name = '$mc_name' and
          opmc.stage_num = mcsm.stage_num and
          op.crn = mc.crn_num
          order by op.crn,opmc.stage_num";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }
     

 function get_fggoods($cond,$argoffset,$arglimit)
     {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select m.CIM_refnum,wo.po_num,sum(wps.acc),(dli.dispatch_qty)
                     from master_data m,wo_part_status wps,work_order wo
             left join dispatch_line_items dli on (dli.wonum=wo.wonum)
                      where $wcond
                      and m.recnum=wo.link2masterdata
                      and wo.recnum=wps.link2wo
                      and (wps.stage = 'final' or wps.stage = 'Final' or
                      wps.stage = 'FINAL' or wps.stage = 'fi' or
                      wps.stage = 'FI' or wps.stage = 'Fi')
                      and wo.`condition`='Closed'
                      group by m.CIM_refnum
             order by m.CIM_refnum limit $offset,$limit";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }



function get_fggoods_totalcost($cond)
     {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select m.CIM_refnum,wo.po_num,sum(wps.acc),(dli.dispatch_qty)
                     from master_data m,wo_part_status wps,work_order wo
             left join dispatch_line_items dli on (dli.wonum=wo.wonum)
                      where $wcond
                      and m.recnum=wo.link2masterdata
                      and wo.recnum=wps.link2wo
                      and (wps.stage = 'final' or wps.stage = 'Final' or
                      wps.stage = 'FINAL' or wps.stage = 'fi' or
                      wps.stage = 'FI' or wps.stage = 'Fi')
                      and wo.`condition`='Closed'
                      group by m.CIM_refnum
             order by m.CIM_refnum";
      // echo $sql;
       $result = mysql_query($sql);
       return $result;
    }

function getunit_price($ponum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select soli.price,so.currency from so_line_items soli,sales_order so
                        where so.recnum=soli.link2so
                        and so.po_num = '$ponum'
                        and soli.price != 0
                        limit 1;";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
   }

function get_fggoods_count($cond,$argoffset,$arglimit)
  {
     $wcond = $cond;
     $offset = $argoffset;
     $limit = $arglimit;
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     $sql = "select m.CIM_refnum,wo.po_num,sum(wps.acc),(dli.dispatch_qty)
                     from master_data m,wo_part_status wps,work_order wo
             left join dispatch_line_items dli on (dli.wonum=wo.wonum)
                      where $wcond
                      and m.recnum=wo.link2masterdata
                      and wo.recnum=wps.link2wo
                      and (wps.stage = 'final' or wps.stage = 'Final' or
                      wps.stage = 'FINAL' or wps.stage = 'fi' or
                      wps.stage = 'FI' or wps.stage = 'Fi')
                      and wo.`condition`='Closed'
                      group by m.CIM_refnum
             order by m.CIM_refnum";

      //echo $sql;
     $result  = mysql_query($sql);
     $numrows = mysql_num_rows($result);
     return $numrows;
 }

// Added on April2,09 as per CIM requirements
 function getworkinprogress($cond,$argoffset,$arglimit) {
        $wcond = $cond;
        $offset = $argoffset;
        $limit =  $arglimit; 
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select w.grnnum,
		        m.CIM_refnum,
			w.wonum,
			w.qty,
			sl.price,
			(w.qty*sl.price),
                        sl.rmprice,
			(sl.rmprice*w.qty),
			s.currency

                 from work_order w,sales_order s,so_line_items sl,master_data m
                 where w.po_num=s.po_num and sl.link2so=s.recnum and
                        replace(replace(sl.partnum,'-',''),' ','')like replace(replace(w.partnum,'-',''),' ','')
                        and w.`condition`='Open' and m.recnum=w.link2masterdata $wcond
                 group by w.wonum,w.grnnum 
				 limit $offset,$limit";
        // echo $sql;
        $result = mysql_query($sql);         
        return $result;
}

// Added on Apri2,09 as per CIM requirements
function getworkinprogress_count($cond,$offset,$rowsPerPage)
  {
	$wcond = $cond;
    $offset = $argoffset;
    $limit =  $arglimit; 

     $sql = "select count(wonum) as numrows
                  FROM work_order $wcond ";
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     //echo $sql;
     $result  = mysql_query($sql) or die('WorkOrder count query failed');
     $row     = mysql_fetch_array($result, MYSQL_ASSOC);
     $numrows = $row['numrows'];
     return $numrows;
 }
// Added on Apri 3,09 as per CIM requirements
function getcrn_details4report() {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select pal.crn,
                        po.ponum,
                        poli.material_spec,
                       case when (poli.no_of_lengths) = 0 then (poli.no_of_meterages) else (poli.no_of_lengths) end as poqty,
                       grn.grnnum,
                       sum(grn_li.qty_to_make)
               from purchasing_alloc pal,
               po_line_items poli,
              (po left join grn on grn.cimponum=po.ponum and grn.crn = pal.crn)
              left join grn_li on grn_li.link2grn=grn.recnum
               where po.recnum=poli.link2po
               and pal.link2poli=poli.recnum
               group by poli.material_spec
               order by po.ponum";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
   }
function getwo4crn_details($crnnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select wo.wonum,
                        sum(wps.acc),
                        dli.dispatch_qty
                        from work_order wo,wo_part_status wps,master_data m
                        left join dispatch_line_items dli on (dli.wonum=wo.wonum)
                        where m.CIM_refnum = '$crnnum'
                        and wo.link2masterdata=m.recnum
                        and wo.recnum=wps.link2wo
                        and (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi')
                       and wo.`condition`='Closed'
                       group by wo.wonum";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
   }

   function getqanc4report($cond,$argoffset,$arglimit) 
   {

        $offset = $argoffset;
        $limit =  $arglimit;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,
                        wonum,
                        refnum,
                        customer,
                        partnum,
                        create_date,
                        dcdate,
                        description,
                        qty,
                        effectiveness,
                        root_cause,
                        corrective_action,
                        preventive_action
                from nc4qa
                 where (status != 'Pending' || status is NULL) and
                 $cond
                order by recnum
                limit $offset,$limit;";
          //echo "$sql";
        $result = mysql_query($sql);
          if(!$result) die("Query failed for operator row settime. " . mysql_error());
        return $result;
   }
   
  function getqanc_count($cond,$argoffset,$arglimit)
  {
	$wcond = $cond;
    $offset = $argoffset;
    $limit =  $arglimit;

     $sql = "select count(recnum) as numrows
                  FROM nc4qa
                  where (status != 'Pending' || status is NULL) and
                   $wcond
                  limit $offset,$limit";
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     //echo $sql;
     $result  = mysql_query($sql) or die('nc4qa count query failed');
     $row     = mysql_fetch_array($result, MYSQL_ASSOC);
     $numrows = $row['numrows'];
     return $numrows;
 }
 
 function getnc4qa_graph($cond)
 {
         $offset = $argoffset;
         $limit = $arglimit;
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select recnum,refnum,wonum,dim_deviation,man,inprocess,mat_deviation,machine,final_insp,method,cust_end,create_date,other_deviation
                  FROM nc4qa where (status != 'Pending' || status is NULL) and $cond";
         $result = mysql_query($sql);
         //echo $sql;
        if(!$result) die("get QA NC for Chart ..Please report to Sysadmin. " . mysql_error());
        return $result;

 }
 
 function getnc4qa_chart($cond,$argoffset,$arglimit)
 {
         $offset = $argoffset;
         $limit = $arglimit;
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select recnum,refnum,wonum,dim_deviation,man,inprocess,mat_deviation,machine,final_insp,method,cust_end,create_date,other_deviation,super_name,oper_name
                  FROM nc4qa where (status != 'Pending' || status is NULL) and $cond limit $offset,$limit";
         $result = mysql_query($sql);
         //echo $sql;
        if(!$result) die("get QA NC for Chart ..Please report to Sysadmin. " . mysql_error());
        return $result;

 }
 
 function nc_chartCount($cond,$argoffset,$arglimit)
  {
     $wcond = $cond;
     $offset = $argoffset;
     $limit = $arglimit;
     $sql=  "select count(recnum) as numrows from nc4qa
                    where (status != 'Pending' || status is NULL) and $wcond  limit $offset,$limit";
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     // echo $sql;
     $result  = mysql_query($sql) or die('nc chart count query failed');
     $row     = mysql_fetch_array($result, MYSQL_ASSOC);
     $numrows = $row['numrows'];
    // echo $numrows;
     return $numrows;
 }
 
function getcrr_report($cond,$argoffset,$arglimit)
 {
         $offset = $argoffset;
         $limit = $arglimit;
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "SELECT d.crn,d.relnotenum,d.disp_date,dli.dispatch_qty,dli.wonum,dli.recnum
                        from dispatch d,dispatch_line_items dli
                where $cond and d.status !='cancelled'
                      and d.recnum=dli.link2dispatch
                  order by d.relnotenum,dli.recnum
                 limit $offset,$limit";
         $result = mysql_query($sql);
        //echo $sql;
        if(!$result) die("get CRR report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
 }

 function getcrr_report4chart($cond)
 {
         $offset = $argoffset;
         $limit = $arglimit;
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "SELECT d.crn,d.relnotenum,d.disp_date,sum(dli.dispatch_qty),dli.wonum,dli.recnum
                        from dispatch d,dispatch_line_items dli
                where $cond and d.status !='cancelled'
                      and d.recnum=dli.link2dispatch
                group by d.crn
                order by d.crn";
        $result = mysql_query($sql);
        //echo $sql;
        if(!$result) die("get CRR report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
 }


 function getnc4dispatch($cofcnum,$dliwonum)
 {

         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select nc.recnum,nc.qty,nc.wonum,nc.cust_end,nc.cust_ncno
                        from dispatch d
                        left join nc4qa nc on nc.cofcnum=d.relnotenum
                        WHERE nc.wonum='$dliwonum' and
                         nc.cofcnum='$cofcnum' and
                         nc.cust_end='yes'";

         $result = mysql_query($sql);
        //echo $sql;
        if(!$result) die("get NC for dispatch for report Failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
 }



 function getnc4dispatch4chart($crn)
 {

         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select d.crn,nc.recnum,sum(nc.qty),nc.wonum,nc.cust_end,nc.cust_ncno
                        from dispatch d
                        left join nc4qa nc on nc.cofcnum=d.relnotenum
                 WHERE  d.crn='$crn' and
                        nc.cust_end='yes'
                 group by d.crn
                 order by d.crn       ";

         $result = mysql_query($sql);
        //echo $sql;
        if(!$result) die("get NC for dispatch for chart failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
 }
 
/*
 function getcrr_report($cond,$argoffset,$arglimit)
 {
         $offset = $argoffset;
         $limit = $arglimit;
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select d.crn,d.relnotenum,dli.dispatch_qty,
                        nc.qty,nc.cust_ncno,
                        d.disp_date,nc.recnum
                        from  dispatch_line_items dli,dispatch d
                        left join nc4qa nc on nc.cofcnum = d.relnotenum and
                                    nc.cust_end = 'yes' and dli.wonum = nc.wonum
                        where $cond and
                              d.recnum=dli.link2dispatch and 
                              d.status != 'Cancelled'
                 order by d.relnotenum,d.crn
                 limit $offset,$limit";
         $result = mysql_query($sql);
         //echo $sql;
        if(!$result) die("get CRR report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
 }
 
 function getcrr_report4chart($cond)
 {
         $offset = $argoffset;
         $limit = $arglimit;
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select d.crn,d.relnotenum,sum(dli.dispatch_qty),
                        sum(nc.qty),nc.cust_ncno,
                        d.disp_date
                        from dispatch d, dispatch_line_items dli
                        left join nc4qa nc on (nc.cofcnum = d.relnotenum and dli.wonum = nc.wonum and
                                    nc.cust_end = 'yes')
                        where $cond and
                              d.recnum=dli.link2dispatch and 
                              d.status != 'Cancelled'
                 group by d.crn
                 order by d.crn";
         $result = mysql_query($sql);
         //echo $sql;
        if(!$result) die("Get CRR report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
 }
*/ 
 function getcrr_Count($cond,$argoffset,$arglimit)
  {
     $wcond = $cond;
     $offset = $argoffset;
     $limit = $arglimit;
     $sql=  "select count(nc.refnum) as numrows from nc4qa nc,
                    dispatch d,dispatch_line_items dli
             where $cond and d.recnum=dli.link2dispatch and nc.cofcnum=d.relnotenum
             limit $offset,$limit";
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     // echo $sql;
     $result  = mysql_query($sql) or die('nc chart count query failed');
     $row     = mysql_fetch_array($result, MYSQL_ASSOC);
     $numrows = $row['numrows'];
    // echo $numrows;
     return $numrows;
 }
 
 function getcrn_ontime($cond)
 {
         $offset = $argoffset;
         $limit = $arglimit;
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         
         $sql = "select d.crn,d.disp_date,d.schdate,d.schqty,sum(dli.dispatch_qty) 
		         from dispatch d,dispatch_line_items dli 
				 where $cond
                 and d.recnum=dli.link2dispatch
                 and (d.schdate != '0000-00-00')
                 group by dli.link2dispatch
                 order by d.crn,d.disp_date";
         $result = mysql_query($sql);
         //echo $sql;
        if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
 }
 
 function getontime_report4chart($cond)
 {
         $offset = $argoffset;
         $limit = $arglimit;
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select d.crn,d.disp_date,d.schdate,d.schqty,sum(dli.dispatch_qty) from dispatch d,dispatch_line_items dli
                 where d.recnum=dli.link2dispatch
                 and $cond
                 and (d.schdate != '0000-00-00')
                 group by dli.link2dispatch
                 order by d.disp_date";
         $result = mysql_query($sql);
         //echo $sql;
        if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
 }
 function getcofc_report4chart($cond)
 {
         $offset = $argoffset;
         $limit = $arglimit;
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select d.relnotenum,d.disp_date,d.schdate,d.schqty,sum(dli.dispatch_qty) from dispatch d,dispatch_line_items dli
                 where d.recnum=dli.link2dispatch
                 and $cond
                 and d.schdate != '0000-00-00'
                 group by dli.link2dispatch
                 order by d.relnotenum,d.disp_date";
         $result = mysql_query($sql);
         //echo $sql;
        if(!$result) die("get Cofc for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
 }
 
 function getmachine_summary()
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select mcid,mcname,mcmake,recnum from machine_master";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
   function getmachinename()
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select mcname from machine_master order by mcname";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
  function getmachineDetails($recnum)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select mm.date,mm.category,mm.details,mm.link2machine_master,m.mcname,mm.recnum
		        from machine_master m,machine_maintenence mm
				where m.recnum=mm.link2machine_master and m.recnum=$recnum";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
   function editMainteneceDetails($recnum)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select date,category,details,link2machine_master,recnum
		        from machine_maintenence
				where recnum=$recnum";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

   function updatemachine_metainenence($date,$category,$details,$link2master,$recnum)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "update machine_maintenence mm,machine_master m
		        set mm.date='$date',
				mm.category='$category',
				mm.details='$details'
				where link2machine_master='$link2master' and
				     mm.link2machine_master=m.recnum and mm.recnum=$recnum";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
   function selectmachine_masterdata($id,$name,$make,$cdate)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select recnum 
		        from machine_master
				where mcid='$id' and mcname='$name' and mcmake='$make' and create_date='$cdate'";
	//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }  

  function insertmachine_masterdata($id,$name,$make,$cdate)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "insert into machine_master(mcid,mcname,mcmake,create_date)
		        values('$id','$name','$make','$cdate')";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

   function insertmachine_maintenenece($masterrecnum,$mdate,$category,$details)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "insert into machine_maintenence(date,category,details,link2machine_master)
		        values('$mdate','$category','$details','$masterrecnum')";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
  
  function getallCRN4open($crn,$proc)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

		if ($proc == 'Manufacture Only')
	    {
			$proc = 'and (w.treatment = "" or w.treatment = "Manufacture Only" or w.treatment is null)';
        }
        else {
            $proc = 'and w.treatment = "With Treatment"';
	    }
		$cond=" where m.CIM_refnum ='".$crn."'";
        $oldsql = "select m.recnum,m.CIM_refnum,sum(w.qty)
				from master_data m, work_order w
				   left join wo_part_status wps on  wps.link2wo=w.recnum 
					and (wps.stage = 'final' or wps.stage = 'Final' or
     				wps.stage = 'FINAL' or wps.stage = 'fi' or
					wps.stage = 'FI' or wps.stage = 'Fi' or wps.stage = 'SP'
					or wps.stage = 'sp') 
				   $cond
				   $proc and
				   m.recnum= w.link2masterdata and
				   w.`condition`='Open' and
				   m.recnum=w.link2masterdata and
				   wps.link2wo is null 
				group by m.CIM_refnum";

        // Replaced with this sql to take Open even if part status has FI
        $sql = "select m.recnum,m.CIM_refnum,sum(w.qty)
				from master_data m, work_order w
    			   $cond
				   $proc and
				   m.recnum= w.link2masterdata and
				   w.`condition`='Open' and
				   m.recnum=w.link2masterdata
				group by m.CIM_refnum";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("getallcrn4open report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
   function getallCRN4closed($crn,$proc)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
		if ($proc == 'Manufacture Only')
	    {
			$proc = 'and (w.treatment = "" or w.treatment = "Manufacture Only" or w.treatment is null)';
        }
        else {
            $proc = 'and w.treatment = "With Treatment"';
	    }
		$cond=" where m.CIM_refnum ='".$crn."'";
        $sql = "select m.CIM_refnum,w.wonum,sum(wps.acc),sum(wps.ret)
				   from master_data m, wo_part_status wps, work_order w
				   $cond
				   $proc and
				   m.recnum= w.link2masterdata and
				    wps.link2wo=w.recnum 
					and (wps.stage = 'final' or wps.stage = 'Final' or
     				wps.stage = 'FINAL' or wps.stage = 'fi' or
					wps.stage = 'FI' or wps.stage = 'Fi') and
					w.`condition` != 'Cancelled'
				group by m.CIM_refnum";
        //echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("getallCRN4closed report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

  function getallCRN4all($cond)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select m.recnum,m.CIM_refnum,sum(w.qty)
				from master_data m
				left join work_order w on m.recnum=w.link2masterdata
				$cond
				group by m.CIM_refnum";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("getallCRN4all report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
 function getallCRNDetails($crn,$qty,$proc)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
		if ($proc == 'Manufacture Only')
	    {
			$proc = 'and (w.treatment = "" or w.treatment = "Manufacture Only" or w.treatment is null)';
        }
        else {
            $proc = 'and w.treatment = "With Treatment"';
	    }

        $sql = "select $qty-sum(dl.dispatch_qty)
				from dispatch d,
				     dispatch_line_items dl,
					 work_order w
				where dl.link2dispatch = d.recnum and 
				      d.crn='$crn' and
					  w.wonum = dl.wonum
					  $proc
				group by d.crn
				order by d.crn";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
   function getallGRNDetails($crn,$qty)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select g.grnnum,sum(gli.qty_to_make)-'$qty'
				from grn g,grn_li gli
				where g.recnum = gli.link2grn and g.crn='$crn'
				group by g.crn
				order by g.crn";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

   function getallCRN4Details($crn)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select w.wonum,w.qty,w.treatment
				from master_data m
				left join work_order w on m.recnum=w.link2masterdata
				where m.CIM_refnum='$crn' and w.`condition`='open'
				order by w.wonum";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("getallCRN4details report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
   function getallDispatch4Details($crn)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select d.relnotenum,dl.dispatch_qty,
		               dl.wonum, w.treatment, w.comp_qty
		        from dispatch d,
				     dispatch_line_items dl,
					 work_order w
		        where dl.link2dispatch = d.recnum and
				      d.crn='$crn' and
					  w.wonum = dl.wonum";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("getallDispatch4Details report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

   function getCRNNo($cond)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select g.grnnum,sum(w.qty),g.crn
				from grn g
				left join work_order w on w.grnnum = g.grnnum				
				$cond
				group by g.grnnum";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

 function getallGRN4Details($crn,$grn,$qty)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select g.grnnum,sum(gli.qty_to_make),sum(gli.qty_to_make)-'$qty'
				from grn g,grn_li gli
				where g.recnum = gli.link2grn and g.crn='$crn' and g.grnnum='$grn'
				group by g.grnnum
				order by g.grnnum";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
  function getCRN($crn,$cond)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select g.grnnum,sum(w.qty),g.crn
				from grn g
				left join work_order w on w.grnnum = g.grnnum				
				where g.crn='$crn' 
				group by g.grnnum";
		//echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
 function gettime4mu_eff_tab($mc_name,$cond) {
    // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select op.mc_name,op.crn,opmc.stage_num,sum(opmc.qty),
                sum((mcsm.setting_time*60+mcsm.setting_time_mins)*
                    ((opmc.setting_time+opmc.setting_time_mins)/(opmc.setting_time+opmc.setting_time_mins))) as master_settime,
                sum(opmc.setting_time*60 + opmc.setting_time_mins) as oper_settime,
                sum(((opmc.running_time * 60)+opmc.running_time_mins)+((opmc.markup_time * 60)+opmc.markup_time_mins)-((opmc.markdown_time * 60)+opmc.markdown_time_mins)) as oper_runtime,
                sum((((mcsm.running_time * 60) + mcsm.running_time_mins)) * (opmc.qty)) as master_runtime,
                sum(opmc.qty_rej),				
               sum((opmc.idle_time * 60)+opmc.idle_time_mins),
               sum((opmc.breakdown_time * 60)+opmc.breakdown_time_mins),
			   sum((opmc.running_time * 60)+opmc.running_time_mins)
              from operator op,oper_mc_usage opmc,
             mc_master mc,mc_stage_master mcsm
          where $cond and op.crn = mc.crn_num and
          opmc.link2operator = op.recnum and
          mcsm.link2mc_master = mc.recnum and
          op.mc_name = '$mc_name' and
          opmc.stage_num = mcsm.stage_num
          group by op.crn,opmc.stage_num";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }
 function get_stockbygrn_excel($cond)
     {
      $wcond = $cond;    
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select grn.grnnum, grn.recieved_date, 
                     grn.raw_mat_type, grn.raw_mat_spec, 
                     sum(grnli.qty_to_make), grn.crn ,grn.rmbycim
               from grn_li grnli, grn grn
               where $wcond and
                     grn.recnum = grnli.link2grn and
                     grn.rmbycim != '' and
                     grn.rmbycust = ''
               group by grn.grnnum 
               order by grn.grnnum ";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }

function get_prod_shift($wonum)
    {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select op.mc_name,
                        op.st_date,
                        op.shift,
                        op.oper_name,
                        op.crn,
                        op.wo_num,
                        op_mc.qty,
                        op_mc.stage_num,
                        op_mc.setting_time,
                        op_mc.setting_time_mins,
                        op_mc.running_time,
                        op_mc.running_time_mins,
                        op_mc.idle_time,
                        op_mc.idle_time_mins,
                        op.remarks
                FROM operator op, oper_mc_usage op_mc
                        where
                             op.wo_num = '$wonum' and
                             op_mc.link2operator=op.recnum
                        order by op.st_date,op.shift,op.oper_name,op_mc.stage_num";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Get Production Record shift for performance query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }

	 function getprice4crn($crnnum)
     {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select soli.partnum,soli.price,so.currency
                      from sales_order so, so_line_items soli
                       where
                        so.recnum = soli.link2so and
                        soli.crn_num = '$crnnum'
						order by soli.price desc
						limit 1";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
   }

   function getrate4crn($crnnum)
   {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select poli.rate,po.currency
                from po po, po_line_items poli
                where  po.recnum = poli.link2po and
                       poli.crn = '$crnnum' and
                       poli.rate != 0 and
                       poli.rate is not NULL
					   order by poli.rate desc
					   limit 1";
        //echo "$sql";
        $result = mysql_query($sql);
        return $result;
   }


  function getqua_rating($cond,$qtr,$m,$year,$supp)
  {
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select sum(no_of_meterages),sum(no_of_lengths),sum(qty_rej)
                        from po po,po_line_items poli
                 where po.recnum=poli.link2po
                 and MONTH(po.podate) = $m
                 and YEAR(podate) = $year
                 and po.link2vendor = $supp
                 and $cond
                 and po.status != 'Closed'
                 group by MONTH(po.podate)";
         $result = mysql_query($sql);
        //echo $sql;
        if(!$result) die("get Quality rating failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
  
  function getdel_rating($cond,$qtr,$m,$year,$supp)
  {
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select avg(poli.delivery_time) from po po,po_line_items poli
                     where po.recnum=poli.link2po
                     and MONTH(po.podate) = $m
                     and YEAR(podate) = $year
                     and po.link2vendor = $supp
                     and $cond
                     and po.status != 'Closed'
                 group by MONTH(po.podate)";
         $result = mysql_query($sql);
        //echo $sql;
        if(!$result) die("get Delivery rating failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
  
function getSupp($cond)
  {
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select distinct(po.link2vendor),c.name from po po,company c
                        where c.recnum=po.link2vendor
                              and $cond
                 order by c.name";
         $result = mysql_query($sql);
        //echo $sql;
        if(!$result) die("get Supplier  failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

function get_rating($qtr,$year,$supp)
{
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select c.name,po.ponum,po.podate,sum(poli.no_of_lengths),sum(no_of_meterages),sum(poli.qty_rej),
                        sum(poli.delivery_time),MONTH(po.podate) from po po,po_line_items poli,company c
                        where c.recnum = po.link2vendor
                        and po.recnum=poli.link2po
                        and po.link2vendor = $supp
                        and YEAR(po.podate)= $year
                        and QUARTER(po.podate)= $qtr
                        group by c.name,QUARTER(po.podate)
                 order by c.name";
         $result = mysql_query($sql);
        //echo $sql;
        if(!$result) die("get Quality rating failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
}


 function get_com_rating($qtr,$year,$supp)
  {
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select c.name,po.ponum,po.podate,
                        sum(po.communication),MONTH(po.podate)
                        from po po,company c where c.recnum = po.link2vendor
                        and po.link2vendor = $supp
                        and YEAR(po.podate)= $year
                        and QUARTER(po.podate)= $qtr
                      group by c.name,QUARTER(po.podate)
                      order by c.name";
         $result = mysql_query($sql);
        //echo $sql;
        if(!$result) die("get com rating failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }


  function get_numRows($cur,$year,$supp)
  {
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select count(*) as numrows from po po,po_line_items poli,company c
                        where c.recnum = po.link2vendor
                        and po.recnum=poli.link2po
                        and po.link2vendor = $supp
                        and YEAR(po.podate)= $year
                        and QUARTER(po.podate)= $cur
                        and (poli.delivery_time != 0 && poli.delivery_time is not NULL)";
         $result = mysql_query($sql);
        //echo $sql;
        if(!$result) die("get numrows rating failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
  
  function get_numRows_com($cur,$year,$supp)
  {
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select count(*) as numrows from po po
                     where QUARTER(po.podate) = $cur
                     and YEAR(po.podate) = $year
                     and po.link2vendor = $supp
                     and (po.communication != 0 && po.communication is not NULL)";
         $result = mysql_query($sql);
        //echo $sql;
        if(!$result) die("get numrows for com rating failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

  function getdeliverDetails($cond,$argoffset,$arglimit) {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $offset= $argoffset;
         $limit= $arglimit;
         $wcond = $cond;
         //echo $wcond;

         $sql = "select d.recnum,    
		        d.dnnum,
                        d.deliver_date,
			d.crn,
			d.treated_partnum,
			d.ponum,
                        d.qty,			
			sum(dli.qty_recd)                            
                  FROM delivery_note d
				  left join delivery_note_li dli on d.recnum = dli.link2Delivery 
				  where 
				  (d.status='Open' || d.status is null || d.status='') and                      
                  $wcond
				  group by d.recnum
                  order by d.deliver_date limit $offset,$limit";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getdeliverSummary query failed..Please report to Sysadmin. " . mysql_error());
        return $result;

     }

		 function getdeliverDetailsCount($cond,$argoffset,$arglimit) {

        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;

         $sql = "select d.recnum,    
		           d.dnnum,
                   d.deliver_date,
			       d.crn,
			       d.treated_partnum,
			       d.ponum,
                   d.qty,			
			       sum(dli.qty_recd)         
                  FROM delivery_note d
				  left join delivery_note_li dli on d.recnum = dli.link2Delivery 
				  where 
				  (d.status='Open' || d.status is null || d.status='') and                      
                  $wcond
				  group by d.recnum
                  order by d.deliver_date";
				 //echo $sql;
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $result  = mysql_query($sql) or die('assypo count query failed');
		$numrows=mysql_num_rows($result); 
		//echo "number of rows is : $numrows";
        return $numrows;

    }
 function getVendors() {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $offset= $argoffset;
         $limit= $arglimit;
         $wcond = $cond;
         //echo $wcond;

         $sql = "select recnum, name
                 from company where type = 'VEND' order by name";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getVendors query failed..Please report to Sysadmin. " . mysql_error());
        return $result;

     }

function getrev_crn($op,$cond) {
    // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select op.crn,op.wo_num,md.mps_rev,mps.mps_revision,mc.recnum,wo.link2mps
                    from operator op,mc_master mc,master_data md,work_order wo
                    left join mps mps on (wo.link2mps=mps.recnum)
                    where op.wo_num = wo.wonum
                    and op.crn = md.CIM_refnum
                    and wo.link2masterdata=md.recnum
                    and mc.crn_num = op.crn
                    and (mc.mps_revision=mps.mps_revision OR mc.mps_revision = md.mps_rev OR mc.mps_revision = '00')
                    and  op.oper_name = '$op'
                    and $cond
                 group by op.crn
                 order by op.crn";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }

/*
 function geteffdetails($operator,$cond,$rec_arr)
     {
        $mc_recnum = implode(",",$rec_arr);
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select op.crn,opmc.stage_num,opmc.qty,
       sum((opmc.setting_time * 60)+opmc.setting_time_mins),
       sum((((mcsm.setting_time * 60) + mcsm.setting_time_mins)) * opmc.qty),
       sum(((opmc.running_time * 60)+opmc.running_time_mins)+((opmc.markup_time * 60)+opmc.markup_time_mins)-((opmc.markdown_time * 60)+opmc.markdown_time_mins)),
       sum((((mcsm.running_time * 60) + mcsm.running_time_mins)) * opmc.qty),
       (((mcsm.setting_time * 60) + mcsm.setting_time_mins)),
       (((mcsm.running_time * 60) + mcsm.running_time_mins)),
       sum(((opmc.running_time * 60) + opmc.running_time_mins)),
       sum(opmc.qty)
           from operator op,oper_mc_usage opmc,
       mc_master mc,mc_stage_master mcsm
       where  $cond and op.crn = mc.crn_num and
          opmc.link2operator = op.recnum and
          mcsm.link2mc_master = mc.recnum and
          op.oper_name = '$operator' and
          mc.recnum in ($mc_recnum) and
          opmc.stage_num = mcsm.stage_num
      group by op.crn,opmc.stage_num";
      $result = mysql_query($sql);
      //echo "$sql";
      return $result;
     }
*/
// modified query - please replace
function geteffdetails($operator,$cond,$rec_arr)
{
        $mc_recnum = implode(",",$rec_arr);
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select op.crn,opmc.stage_num,opmc.qty,
       sum((opmc.setting_time * 60)+opmc.setting_time_mins),
       sum((((mcsm.setting_time * 60) + mcsm.setting_time_mins)) * opmc.qty),
       sum(((opmc.running_time * 60)+opmc.running_time_mins)+((opmc.markup_time * 60)+opmc.markup_time_mins)-((opmc.markdown_time * 60)+opmc.markdown_time_mins)),
       sum((((mcsm.running_time * 60) + mcsm.running_time_mins)) * opmc.qty),
       (((mcsm.setting_time * 60) + mcsm.setting_time_mins)),
       (((mcsm.running_time * 60) + mcsm.running_time_mins)),
       sum(((opmc.running_time * 60) + opmc.running_time_mins)),
       sum(opmc.qty),sum(opmc.qty_rej)
           from operator op,oper_mc_usage opmc,
       mc_master mc,mc_stage_master mcsm
       where  $cond and op.crn = mc.crn_num and
          opmc.link2operator = op.recnum and
          mcsm.link2mc_master = mc.recnum and
          op.oper_name = '$operator' and
          mc.recnum in ($mc_recnum) and
          opmc.stage_num = mcsm.stage_num
      group by op.crn,opmc.stage_num";
      $result = mysql_query($sql);
      //echo "$sql";
      return $result;
}

// new query
function getallops()
{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select fname,lname,empid
                  FROM employee where
					   role='op'";
        $result = mysql_query($sql);
      //echo "$sql";
        return $result;
 }
function getNo_of_days($op,$cond) {
    // echo "----".$cond;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select distinct(op.st_date) from operator op
                     where $cond
                     and op.oper_name = '$op'";
      $result  = mysql_query($sql);
      $numrows = mysql_num_rows($result);
      return $numrows;
     }

function getmaster_rejtime($crn,$stagenum,$qty_rej,$rec_arr) {
      
        $mc_recnum = implode(",",$rec_arr);
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select mc.crn_num,mcsm.stage_num,sum((mcsm.running_time*60) + mcsm.running_time_mins )*$qty_rej
             from mc_master mc,mc_stage_master mcsm
             where mc.crn_num ='$crn'
             and mc.recnum=mcsm.link2mc_master
             and mcsm.stage_num <= $stagenum
             and (mcsm.stage_num % 2 != 0)
             and mc.recnum in ($mc_recnum)
             group by mc.crn_num";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }

 function getsettime4eff($operator,$cond,$rec_arr) {
     
        //print_r($rec_arr);
        $mc_recnum = implode(",",$rec_arr);
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select sum(mcsm.setting_time*60 + mcsm.setting_time_mins),
                        sum(opmc.setting_time*60 + opmc.setting_time_mins)
             from operator op,oper_mc_usage opmc,mc_stage_master mcsm,mc_master mcm
             where $cond
             and op.crn=mcm.crn_num
             and opmc.stage_num=mcsm.stage_num
             and op.recnum = opmc.link2operator
             and (opmc.setting_time >0 or opmc.setting_time_mins>0)
             and mcm.recnum=mcsm.link2mc_master
             and op.oper_name='$operator'
             and mcm.recnum in ($mc_recnum)
             group by op.oper_name
             order by op.oper_name ";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }

function getopdrilldown($op,$cond,$rec_arr)
    {
      //echo '$cond'.$cond;
      $mc_recnum = implode(",",$rec_arr);
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select
                     op.crn,
                     op.st_date,
                     op.shift,
                     sum((oper_mc_usage.running_time*60)+oper_mc_usage.running_time_mins),
                     sum((mc_stage_master.running_time*oper_mc_usage.qty*60)+(mc_stage_master.running_time_mins*oper_mc_usage.qty)),
                     sum((mc_stage_master.running_time*oper_mc_usage.qty*60)+(mc_stage_master.running_time_mins*oper_mc_usage.qty))-sum((oper_mc_usage.running_time*60)+oper_mc_usage.running_time_mins),
                     op.wo_num,
                     sum((oper_mc_usage.setting_time*60)+oper_mc_usage.setting_time_mins),
                     sum((mc_stage_master.setting_time*oper_mc_usage.qty*60)+(mc_stage_master.setting_time_mins*oper_mc_usage.qty)),
                     sum((mc_stage_master.setting_time*oper_mc_usage.qty*60)+(mc_stage_master.setting_time_mins*oper_mc_usage.qty))-sum((oper_mc_usage.setting_time*60)+oper_mc_usage.setting_time_mins),
                     sum(oper_mc_usage.running_time_mins),
                     sum(mc_stage_master.running_time_mins*oper_mc_usage.qty),
                     sum(oper_mc_usage.running_time_mins)-sum(mc_stage_master.running_time_mins*oper_mc_usage.qty),
                     sum(oper_mc_usage.setting_time_mins),
                     sum(mc_stage_master.setting_time_mins*oper_mc_usage.qty),
                     sum(oper_mc_usage.setting_time_mins)-sum(mc_stage_master.setting_time_mins*oper_mc_usage.qty),
                     oper_mc_usage.stage_num,oper_mc_usage.qty, op.mc_name,
                     (oper_mc_usage.idle_time*60+oper_mc_usage.idle_time_mins),
                     oper_mc_usage.qty_rej,
                     sum((oper_mc_usage.markup_time*60)+oper_mc_usage.markup_time_mins),
                     sum((oper_mc_usage.markdown_time*60)+oper_mc_usage.markdown_time_mins)
               from operator op,  mc_master,work_order wo,mc_stage_master
               left outer join oper_mc_usage on oper_mc_usage.stage_num=mc_stage_master.stage_num
               where $cond and
                    op.oper_name='$op' and
                    mc_master.crn_num = op.crn and
                    mc_stage_master.link2mc_master=mc_master.recnum and
                    op.recnum = oper_mc_usage.link2operator and
                    op.wo_num = wo.wonum  and
                    mc_master.recnum in ($mc_recnum)
               group by op.st_date,op.shift,oper_mc_usage.stage_num,op.crn,wo.wonum
               order by op.st_date,op.shift,oper_mc_usage.stage_num";
              //echo $sql;
             // echo'-----';
               $result = mysql_query($sql);
       if(!$result) die("Query failed for Drilldown Operator eff. " . mysql_error());
       return $result;
     }

 function getsettime4row($op,$cond,$rec_arr)
      {
        //echo $cond;
        $mc_recnum = implode(",",$rec_arr);
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select op.st_date,
                     op.crn,
                     op.wo_num,
                     op.shift,
                     sum(mcsm.setting_time*60 + mcsm.setting_time_mins),
                     sum(opmc.setting_time*60 + opmc.setting_time_mins),
                     opmc.stage_num
                from operator op,oper_mc_usage opmc,mc_stage_master mcsm,mc_master mcm
                where $cond
                      and op.crn=mcm.crn_num
                      and opmc.stage_num=mcsm.stage_num
                      and op.recnum = opmc.link2operator
                      and (opmc.setting_time >0 or opmc.setting_time_mins>0)
                      and mcm.recnum=mcsm.link2mc_master
                      and op.oper_name='$op'
                      and mcm.recnum in ($mc_recnum)
               group by op.oper_name,op.st_date, op.shift,opmc.stage_num,op.crn,op.wo_num
               order by op.st_date";
              //echo $sql;
               $result = mysql_query($sql);
       if(!$result) die("Query failed for operator row settime. " . mysql_error());
       return $result;
     }
function get_stockbygrn($cond,$argoffset,$arglimit)
    {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select grn.grnnum, grn.recieved_date,
                     grn.raw_mat_type, grn.raw_mat_spec,
                     sum(grnli.qty_to_make), grn.crn ,grn.rmbycim
               from grn_li grnli, grn grn
               where $wcond and
                     grn.recnum = grnli.link2grn and
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
                     grn.grntype != 'Quarantined'
               group by grn.grnnum
               order by grn.grnnum
               limit $offset,$limit ";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }

    function get_stockbygrn_quar($cond,$argoffset,$arglimit)
     {
      $wcond = $cond;
      $offset = $argoffset;
      $limit =  $arglimit;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql=  "select grn.grnnum, grn.recieved_date,
                     grn.raw_mat_type, grn.raw_mat_spec,
                     sum(grnli.qty_to_make), grn.crn ,grn.rmbycim
               from grn_li grnli, grn grn
               where $wcond and
                     grn.recnum = grnli.link2grn and
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
                     grn.grntype = 'Quarantined'
               group by grn.grnnum
               order by grn.grnnum
               limit $offset,$limit ";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }

    function getstockgrn_count($cond,$argoffset,$arglimit)
    {
     $wcond = $cond;
     $offset = $argoffset;
     $limit = $arglimit;
      $sql=  "select count(grn.recnum) as
               numrows from grn grn
              where $wcond
              and grn.rmbycim != '' and grn.rmbycust = ''
              and grn.grntype != 'Quarantined'";
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     // echo $sql;
     $result  = mysql_query($sql) or die('stockgrn count query failed');
     $row     = mysql_fetch_array($result, MYSQL_ASSOC);
     $numrows = $row['numrows'];
    // echo $numrows;
     return $numrows;
   }

  }// End report class definition
