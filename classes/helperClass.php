<?

//====================================
// Author: FSI
// Date-written = April 13, 2009
// Filename: helperClass.php
// Revision: v1.0
// Modifications History
// getwos4qa - Modified on Apr 28,2009 to show all WOs instead of only Open WOs.
// As per CIM request
//====================================


include_once('loginClass.php');

class helper {

/*function getwos4qa()
{
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select m.recnum,m.partname,w.wonum,m.partnum,
                      m.CIM_refnum,w.wonum,w.po_num,c.name,w.batchnum,m.rm_spec,m.attachments,w.recnum as rec,w.treatment
                      from master_data m, work_order w ,company c
                      where
                           w.wo2customer=c.recnum and
                           w.link2masterdata = m.recnum              
		UNION             
		select aw.recnum,aw.descr,aw.assy_wonum,aw.assypartnum,
                      aw.crn,aw.assy_wonum,aw.ponum,co.name,'','',aw.assypartiss,aw.recnum as rec,'Assembly'
                      from  assy_wo aw ,company co
                      where                       
		      aw.link2cust=co.recnum
               order by rec asc";
       echo $sql;
       $result = mysql_query($sql);
       return $result;

} */
/*function getwos4qa4assy($crn)
{
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select aw.recnum,aw.descr,aw.assy_wonum,aw.assypartnum,
                      aw.crn,aw.assy_wonum,aw.ponum,co.name,'','',aw.assypartiss,aw.recnum as rec,'Assembly',
                      aw.status
                      from  assy_wo aw ,company co
                      where
		                   aw.link2cust=co.recnum and
		                   aw.crn='$crn'
                           order by rec asc";
       echo $sql;
       $result = mysql_query($sql);
       return $result;

} */

function getwos4qa($crn)
{
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $siteid = $_SESSION['siteid'];
       $siteval = "w.siteid = '".$siteid."'";
       $sql = "select m.recnum,m.partname,w.wonum,m.partnum,
                      m.CIM_refnum,w.wonum,w.po_num,c.name,w.batchnum,m.rm_spec,m.attachments,w.recnum as rec,
                      w.treatment,w.`condition`
                      from master_data m, work_order w ,company c
                      where
                           w.wo2customer=c.recnum and
                           w.link2masterdata = m.recnum and
                           m.CIM_refnum='$crn' and
			   w.`condition` != 'Cancelled' and $siteval
                order by rec asc";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;

}

function dateDiff($dformat, $endDate, $beginDate)
{
           $date_parts1=explode($dformat, $beginDate);
           $date_parts2=explode($dformat, $endDate);

           
           if($beginDate !='')
           {
           $start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
           }
           if($end_date !='' || $end_date !='0000-00-00')
           {
           $end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
           }
           return $end_date - $start_date;
}
function getdate4Timezone()
{
   $myTimezone = new DateTimeZone('Asia/Calcutta');
   $date_t = new DateTime($curdate,$myTimezone);
   $converted_date=$date_t->format('Y-m-d');
   return $converted_date;
}

function getwos4qa4assy($crn)
{
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $siteid = $_SESSION['siteid'];
       $siteval = "aw.siteid = '".$siteid."'";
       $sql = "select aw.recnum,aw.descr,aw.assy_wonum,aw.assypartnum,
                      aw.crn,aw.assy_wonum,aw.ponum,co.name,'','',aw.assypartiss,aw.recnum as rec,'Assembly'
              from assy_wo aw ,company co
              where
		                   aw.link2cust=co.recnum and
		                   aw.crn='$crn' and $siteval
                           order by rec asc";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
}
function getmc_name4nc($wonum,$crn,$stagenum)
{
	 $newlogin = new userlogin;
       $newlogin->dbconnect();
	 $sql = "select o.oper_name,                    
                    o.mc_name
			FROM operator o,oper_mc_usage op
			where o.recnum=op.link2operator and  
			      op.stage_num like '$stagenum' and				
				  o.wo_num='$wonum' and o.crn='$crn'
			group by o.mc_name
			order by o.st_date";
			//echo $sql;
       $result = mysql_query($sql);
       return $result;
}

function getall_wo()
 {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $siteid = $_SESSION['siteid'];
      $siteval = "g.siteid = '".$siteid."'";
       $sql = "select wonum,wotype,w.grnnum,
                           g.refnum,
                        g.partnum,
                        g.partname,
                        g.raw_mat_type,
                        g.raw_mat_spec,
                        g.dim1,
                        g.dim2,
                        g.dim3,
                        g.dim4,
                        g.num_of_lengths,
                        g.num_of_pieces,
                        g.raw_mat_code,
                        g.invoice_num,
                        g.invoice_date,
                        g.recieved_date,
                        g.test_report,
                        g.batch_num,
                        g.mgp_num,
                        g.rate,
                        g.lead_time,
                        g.lead_unit,
                        g.inventory_cnt,
                        c.name as supplier,
                        g.link2vendor,
                        g.grnnum,
                        g.coc_refnum,
                        g.total_qty,
                        g.rmbycim,
                        g.rmbycust,
                        g.cimponum,
                        g.fmtnum,
                        g.fmtrev,
                        g.remarks,
                        g.nc_refnum,
                        g.grntype,
                        g.crn,
                        g.status,
                        g.shipping_date,
            g.conversion_date,
            g.quarantine_remarks,
            g.grndateQuar,
                        g.rmpo_empcode,
            g.rmpo_date,
            g.grn_empcode,
            g.grn_date,
            g.rm_cost,
            g.rm_currency,
            g.approved,
            g.rmpolinenum,
            g.altcrn,
            g.parentgrnnum,
            g.pocrn,
            g.approval_remarks,
            g.approval_date,
            g.approved_by,
            g.stdrev,
            g.wo_ref,
            g.grn_classif,
            g.cad_approved,
            g.cad_approved_by,
            g.cad_approval_date,
            g.qtm_req,
            (g.qtm-g.qty_used+g.qty_ret) as balance,
            g.conversion_rate,
            gli.qty4billet,
            gli.uom,
            c.recnum as id
             from work_order w,grn g  , company c,grn_li gli
         where (w.rework_qty > 0 or cust_rew_qty > 0) and
                  w.grnnum=g.grnnum and
               g.grntype='Regular' and
            w.`condition` = 'Closed' and
            g.link2vendor = c.recnum  and 
            g.recnum = gli.link2grn and
            gli.linenum = '1' and $siteval 
                order by (wonum+0)";  
        // echo $sql;
       mysql_query('SET SQL_BIG_SELECTS=1');
       $result = mysql_query($sql);
       return $result;
}
function getAssy_wo()
 {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $siteid = $_SESSION['siteid'];
       $siteval = "a.siteid = '".$siteid."'";
       $sql ="select a.assy_wonum,
                       a.crn,
                       ali.bom_type,
                       ali.linenum,
                       ali.custend_rew_qty,
                       ali.grn,ali.qty_rew,
                       w.grnnum,
                       ali.recnum 
                       from assy_wo a, assywo_li ali, work_order w 
                       where  a.recnum = ali.link2assywo and
                        ali.grn = w.wonum and
                        (ali.custend_rew_qty > 0 || ali.qty_rew > 0 )
                        and ali.bom_type  ='Manufactured' and ali.custend_rew_flag != 1
                        UNION 
                        select a.assy_wonum,
                        a.crn,
                        ali.bom_type,
                        ali.linenum,
                        ali.custend_rew_qty,
                        ali.grn,
                        ali.qty_rew,
                        '',
                         ali.recnum  
                        from assy_wo a, assywo_li ali
                        where  a.recnum = ali.link2assywo and
                        (ali.custend_rew_qty > 0 || ali.qty_rew > 0 )
                        and ali.bom_type  ='Bought Out' and ali.custend_rew_flag != 1 and $siteval" ;
                //echo $sql;
       mysql_query('SET SQL_BIG_SELECTS=1');
       $result = mysql_query($sql);
       return $result;
}


    function getAssy_wogrn($grnnum)
    {

       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $siteid = $_SESSION['siteid'];
       $siteval = "g.siteid = '".$siteid."'";

       $sql ="select 
              g.refnum,
              g.partnum,
              g.partname,
              g.raw_mat_type,
              g.raw_mat_spec,
              g.dim1,
              g.dim2,
              g.dim3,
              g.dim4,
              g.num_of_lengths,
              g.num_of_pieces,
              g.raw_mat_code,
              g.invoice_num,
              g.invoice_date,
              g.recieved_date,
              g.test_report,
              g.batch_num,
              g.mgp_num,
              g.rate,
              g.lead_time,
              g.lead_unit,
              g.inventory_cnt,
              c.name as supplier,
              g.link2vendor,
              g.grnnum,
              g.coc_refnum,
              g.total_qty,
              g.rmbycim,
              g.rmbycust,
              g.cimponum,
              g.fmtnum,
              g.fmtrev,
              g.remarks,
              g.nc_refnum,
              g.grntype,
              g.crn,
              g.status,
              g.shipping_date,
              g.conversion_date,
              g.quarantine_remarks,
              g.grndateQuar,
              g.rmpo_empcode,
              g.rmpo_date,
              g.grn_empcode,
              g.grn_date,
              g.rm_cost,
              g.rm_currency,
              g.approved,
              g.rmpolinenum,
              g.altcrn,
              g.parentgrnnum,
              g.pocrn,
              g.approval_remarks,
              g.approval_date,
              g.approved_by,
              g.stdrev,
              g.wo_ref,
              g.grn_classif,
              g.cad_approved,
              g.cad_approved_by,
              g.cad_approval_date,
              g.qtm_req,
              (g.qtm-g.qty_used+g.qty_ret) as balance,
              g.conversion_rate,
              gli.qty4billet,
              gli.uom,
              gli.partnum,
              gli.partdesc,
              gli.linenum,
              gli.layoutrefnum,
              gli.batchnum,
              g.mfr_name,
              gli.dim1,
              gli.dim2,
              gli.dim3,
              gli.noofpieces 
              from 
              grn g, grn_li gli,
              company c 
              where 
              g.recnum = gli.link2grn and
              c.recnum = g.link2vendor and g.grnnum ='$grnnum' and $siteval";
             
       mysql_query('SET SQL_BIG_SELECTS=1');
       $result = mysql_query($sql);
       return $result;
    }
    
}/*end of the class*/