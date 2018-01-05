<?php
//====================================
// Author: FSI
// Date-written = March 06, 2012
// Filename: stockClass.php
// Maintains the class for all new stock Report
// Revision: v1.0
//====================================

include_once('loginClass.php');

class stockreport
{

   function getallwoqty4open($date,$crn)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

               $sql = "select sum(w.qty),sum(w.qty*(select min(replace(rm.rm_unitprize,'$','')/rm_qty_perbill)
               from rmmaster rm where rm.crnnum=w.crn_num and rm.rm_status='Active' and rm.rm_unitprize !='' )),sum(w.dn_qty_sent)
  		      from  work_order w
                where
              ((w.`condition` = 'Closed' and w.book_date <= '$date' and w.actual_ship_date > '$date' and (w.treatment ='' or w.treatment = 'Manufacture Only' or w.treatment is null)) or
              (w.`condition` = 'Open' and w.book_date <= '$date' and (w.comp_qty = 0 ||w.comp_qty = ''||w.comp_qty is null) and (w.dn_qty_sent=0 || w.dn_qty_sent='' || w.dn_qty_sent is null )))
              and w.crn_num like '$crn%' and
			  (w.crn_num not like '01-%' and w.crn_num not like '02-%' and w.crn_num not like '03-%'
			       and w.crn_num not like '04-%' and w.crn_num not like '05-%' and w.crn_num not like '06-%'
			       and w.crn_num not like '07-%' and w.crn_num  not like '29-%'  and w.crn_num not like '08-%'
				   and w.crn_num not like 'HAL%')
               ";

        // echo $sql;
        $result = mysql_query($sql);
		if(!$result) die("getallcrn4open report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
 /*  function getallwoqty4open4drilldown($cond,$date,$limit,$offset)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

               $sql = "select w.crn_num,w.wonum,sum(w.qty),sum(w.qty*(select min(replace(rm.rm_unitprize,'$',''))
               from rmmaster rm where rm.crnnum=w.crn_num and rm.rm_status='Active' and rm.rm_unitprize !='' )),
               sum(w.dn_qty_sent),sum(w.dn_qty_recd),w.grnnum ,sum(w.dn_qty_sent*(select min(replace(rm.rm_unitprize,'$',''))
               from rmmaster rm where rm.crnnum=w.crn_num and rm.rm_status='Active' and rm.rm_unitprize !='' ))
  		      from  work_order w
                where
              ((w.`condition` = 'Closed' and w.book_date <= '$date' and w.actual_ship_date > '$date' and (w.treatment ='' or w.treatment = 'Manufacture Only' or w.treatment is null)) or
              (w.`condition` = 'Open' and w.book_date <= '$date' and (w.comp_qty = 0 ||w.comp_qty = ''||w.comp_qty is null) and (w.dn_qty_sent=0 || w.dn_qty_sent='' || w.dn_qty_sent is null ))) and $cond
    		   group by w.wonum order by w.wonum limit $limit,$offset";

        //echo $sql."<br>";
        $result = mysql_query($sql);
		if(!$result) die("getallcrn4open report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  } */
  
   function getallwoqty4open4drilldown($cond,$date,$limit,$offset)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

               $sql = "select w.crn_num,w.wonum,w.wonum,w.wonum,w.wonum,w.rm_type,sum(w.qty)
  		      from  work_order w
                where
              ((w.`condition` = 'Closed' and w.book_date <= '$date' and w.actual_ship_date > '$date' and (w.treatment ='' or w.treatment = 'Manufacture Only' or w.treatment is null)) or
              (w.`condition` = 'Open' and w.book_date <= '$date' and (w.comp_qty = 0 ||w.comp_qty = ''||w.comp_qty is null) and (w.dn_qty_sent=0 || w.dn_qty_sent='' || w.dn_qty_sent is null ))) and 
			  (w.crn_num not like '01-%' and w.crn_num not like '02-%' and w.crn_num not like '03-%'
			       and w.crn_num not like '04-%' and w.crn_num not like '05-%' and w.crn_num not like '06-%'
			       and w.crn_num not like '07-%' and w.crn_num not like '08-%' and w.crn_num  not like '29-%' 
				   and w.crn_num not like 'HAL%')
			  and $cond
    		   group by w.wonum order by w.wonum limit $limit,$offset";

        //echo $sql."<br>";
        $result = mysql_query($sql);
		if(!$result) die("getallcrn4open report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
     function getallwoqty4open4totalcost($cond,$date)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

               $sql = "select w.crn_num,w.wonum,w.wonum,w.wonum,w.wonum,w.rm_type,sum(w.qty)
  		      from  work_order w
                 where
              ((w.`condition` = 'Closed' and w.book_date <= '$date' and w.actual_ship_date > '$date' and (w.treatment ='' or w.treatment = 'Manufacture Only' or w.treatment is null)) or
              (w.`condition` = 'Open' and w.book_date <= '$date' and (w.comp_qty = 0 ||w.comp_qty = ''||w.comp_qty is null) and (w.dn_qty_sent=0 || w.dn_qty_sent='' || w.dn_qty_sent is null ))) and 
			  (w.crn_num not like '01-%' and w.crn_num not like '02-%' and w.crn_num not like '03-%'
			       and w.crn_num not like '04-%' and w.crn_num not like '05-%' and w.crn_num not like '06-%'
			       and w.crn_num not like '07-%' and w.crn_num not like '08-%' and w.crn_num  not like '29-%' 
				   and w.crn_num not like 'HAL%')
			   and $cond
    		   group by w.wonum order by w.wonum";

        //echo $sql."<br>";
        $result = mysql_query($sql);
		if(!$result) die("getallcrn4open report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

  
   function getmasterdata4wo($masterdatarecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

       $sql = " select mps_rev,mps_num,drawing_num,cos,grainflow,maxruling
            FROM master_data
            where  master_data.recnum = $masterdatarecnum";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
  
    function getalloperatorDetails($wonum,$crn,$date)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

               $sql = "select max(op.stage_num),sum(op.qty)
                              from operator o,oper_mc_usage op,work_order w
                                    where op.link2operator=o.recnum and
                                          o.crn='$crn' and
                                          w.wonum='$wonum' and
                                          o.wo_num=w.wonum and
                                          o.st_date<='$date'
                                          group by op.stage_num order by op.stage_num desc limit 1";

        //echo $sql."<br>";
        $result = mysql_query($sql);
		if(!$result) die("getalloperatorDetails  failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
  
  function getallmcstageDetails_bak($crn,$mps_rev)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

               $sql = "select max(mcs.stage_num)
                              from mc_stage_master mcs,mc_master m
                                   where m.crn_num='$crn' and
                                         m.mps_revision='$mps_rev' and
                                         mcs.link2mc_master=m.recnum";

       // echo $sql."<br>";
        $result = mysql_query($sql);
		if(!$result) die("getallmcstageDetails  failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
  
  function getallmcstageDetails($crn,$mps_rev)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

               $sql = "select max(mcs.stage_num)
                              from mc_stage_master mcs,mc_master m
                                   where m.crn_num='$crn'  and
                                         mcs.link2mc_master=m.recnum";

        //echo $sql."<br>";
        $result = mysql_query($sql);
		if(!$result) die("getallmcstageDetails  failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

   function getsoliprice4crn($crnnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select soli.price,so.currency
                      from sales_order so, so_line_items soli
                       where
                        so.recnum = soli.link2so and
                        soli.crn_num = '$crnnum'
			limit 1";
        $result = mysql_query($sql);
        //echo "<br>getsoliprice4crn: $sql";
        return $result;
   }


  
  function getdnqty4wo($date,$crn)
  {
  
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     $sql = "select sum(dli.qty_recd) as dn_recd,sum(dli.qty_acc) as dn_acc,
     sum(dli.qty_recd*(select min(replace(rm.rm_unitprize,'$','')/rm_qty_perbill) from rmmaster rm where rm.crnnum=dn.crn and rm.rm_status='Active' and rm.rm_unitprize !='')),
     sum(dli.qty_acc*(select min(replace(rm.rm_unitprize,'$','')/rm_qty_perbill) from rmmaster rm where rm.crnnum=dn.crn and rm.rm_status='Active' and rm.rm_unitprize !='')),
     sum(dli.qtyrej4store)
                     from work_order w, delivery_note dn, delivery_note_li dli
                      where
                      w.`condition` = 'Open' and w.book_date <= '$date' and
                      w.comp_qty > 0 and
                      dn.recnum = dli.link2delivery and
                      dn.wonum = w.wonum  and
                      dli.cofc_date <= '$date' and dn.crn like '$crn%'
                      ";
        //echo $sql;
        $result  = mysql_query($sql) or die('getdnqty4wo failed');
        return $result;
  
  }
  function getdnqty4w4drilldown($date,$crn,$wonum)
  {

     $newlogin = new userlogin;
     $newlogin->dbconnect();
     $sql = "select dn.crn,(dli.qty_recd) as dn_recd,(dli.qty_acc) as dn_acc,
     (dli.qty_recd*(select min(replace(rm.rm_unitprize,'$','')/rm_qty_perbill) from rmmaster rm where rm.crnnum=dn.crn and rm.rm_status='Active' and rm.rm_unitprize !='')),
     (dli.qty_acc*(select min(replace(rm.rm_unitprize,'$','')/rm_qty_perbill) from rmmaster rm where rm.crnnum=dn.crn and rm.rm_status='Active' and rm.rm_unitprize !='')),
     (dli.qtyrej4store)
                     from work_order w, delivery_note dn, delivery_note_li dli
                      where
                      w.`condition` = 'Open' and w.book_date <= '$date' and
                      w.comp_qty > 0 and
                      dn.recnum = dli.link2delivery and
                      dn.wonum = w.wonum  and
                      dli.cofc_date <= '$date' and dn.crn='$crn'  and dn.wonum='$wonum'
                      group by dn.crn";
        //echo $sql."<br>";
        $result  = mysql_query($sql) or die('getdnqty4wo failed');
        return $result;

  }
  
  
  function getdn_qty($condw,$crn)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select sum(d.qty),sum(d.qty*(select min(replace(rm.rm_unitprize,'$','')/rm_qty_perbill)
                      from rmmaster rm where rm.crnnum=d.crn and rm.rm_status='Active' and rm.rm_unitprize !='' ))
                      from delivery_note d 
					  where d.deliver_date<='$condw' and 
					  d.deliver_date > '2011-05-22' and
					  d.crn like '$crn%' and 
					  d.status!='Cancelled'";
		//echo $sql;
        $result  = mysql_query($sql) or die('getdn_qty failed');
        return $result;
  }
  function getdnli_qty($condw,$crn)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select sum(dli.qty_recd),sum(dli.qty_recd*(select min(replace(rm.rm_unitprize,'$','')/rm_qty_perbill)
                       from rmmaster rm where rm.crnnum=d.crn and rm.rm_status='Active' and rm.rm_unitprize !='' )),sum(dli.qty_acc),sum(dli.qty_acc*(select min(replace(rm.rm_unitprize,'$','')/rm_qty_perbill)
                       from rmmaster rm where rm.crnnum=d.crn and rm.rm_status='Active' and rm.rm_unitprize !='' ))
                       from delivery_note_li dli,delivery_note d
                            where dli.link2delivery=d.recnum   and
                                  d.crn like '$crn%' and
                                  d.deliver_date<='$condw' and 
								  d.deliver_date > '2011-05-22' and
								  d.status!='Cancelled'";
		//echo $sql;
        $result  = mysql_query($sql) or die('getdn_qty failed');
        return $result;
  }
  
  function getrate4crn($crn)
   {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select min(replace(rm.rm_unitprize,'$','')/rm_qty_perbill),
		rm.currency,rm.crnnum
                       from rmmaster rm
                            where rm.rm_status='Active' and rm.rm_unitprize!=''
                            and rm.crnnum='$crn'
                            group by rm.crnnum
                            order by rm.crnnum";
        //echo "<br>getrate4crn: $sql";
        $result = mysql_query($sql);
        return $result;
   }
   
   
    function getcqty4closedwo($date,$crn)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select sum(w.comp_qty),
                       sum(w.comp_qty*(select min(replace(rm.rm_unitprize,'$','')/rm_qty_perbill) from rmmaster rm where rm.crnnum=w.crn_num and rm.rm_status='Active' and rm.rm_unitprize !=''))
				   from work_order w
                   where
				    w.actual_ship_date <= '$date' and
					w.actual_ship_date != '0000-00-00'  and
					w.actual_ship_date != '' and
					w.actual_ship_date is not null and
		            w.`condition` != 'Cancelled' and w.`condition` != 'Hold'  and 
					w.crn_num like '$crn%' and
					(w.crn_num not like '01-%' and w.crn_num not like '02-%' and w.crn_num not like '03-%'
				                  and w.crn_num not like '04-%' and w.crn_num not like '05-%' and w.crn_num not like '06-%'
				                  and w.crn_num not like '07-%' and w.crn_num not like '08-%' 
								  and w.crn_num  not like '29-%' 
								  and w.crn_num not like 'HAL%' 
								  and w.crn_num not in ('35-002' ,'35-003','35-004','35-005','35-006','35-007','35-008',
								                                             '35-009','35-010','35-011','35-012','35-013','35-014','35-015')	  
								  )
				   ";
        //echo "<br>getcqty4closedwo: $sql <br>";

        $result = mysql_query($sql);
		if(!$result) die("getallCRN4closed report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
  
   function getdispqtydetails($date,$crn)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

			 $sql = "select sum(dl.dispatch_qty),
             sum(dl.dispatch_qty*(select min(replace(rm.rm_unitprize,'$','')/rm_qty_perbill) 
			 from rmmaster rm where rm.crnnum=d.crn and rm.rm_status='Active' and rm.rm_unitprize !=''))
				from dispatch d,
				     dispatch_line_items dl,work_order w
				where dl.link2dispatch = d.recnum and
                      d.status != 'Cancelled' and w.wonum = dl.wonum and
					  w.condition != 'Cancelled' and w.`condition` != 'Hold'
					  and d.disp_date <= '$date' and 
					  w.actual_ship_date != '0000-00-00'  and
					   w.actual_ship_date != '' and
					  w.actual_ship_date is not null and
					  d.crn like '$crn%' and
					  (d.crn not like '01-%' and d.crn not like '02-%' and d.crn not like '03-%'
				                  and d.crn not like '04-%' and d.crn not like '05-%' and d.crn not like '06-%'
				                  and d.crn not like '07-%' and d.crn not like '08-%' and d.crn  not like '29-%' 
								  and d.crn not like 'HAL%')
					  and d.crn not in ('35-002' ,'35-003','35-004','35-005','35-006','35-007','35-008',
								                                             '35-009','35-010','35-011','35-012','35-013','35-014','35-015')	  
					  and w.actual_ship_date <='$date'";


	    //echo "<br>getdispqtydetails $sql <br>";
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
  
     function getdispqtydetails4drilldown($date,$crn,$limit,$offset)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

			 $sql = "select sum(dl.dispatch_qty),d.crn
				from dispatch d,
				     dispatch_line_items dl,work_order w
				where dl.link2dispatch = d.recnum and
                      d.status != 'Cancelled' and w.wonum = dl.wonum and
					  w.condition != 'Cancelled' and w.`condition` != 'Hold'
					  and d.disp_date <= '$date' and d.crn like '$crn%'
					  and w.actual_ship_date <='$date' and
					  (d.crn not like '01-%' and d.crn not like '02-%' and d.crn not like '03-%'
				                  and d.crn not like '04-%' and d.crn not like '05-%' and d.crn not like '06-%'
				                  and d.crn not like '07-%' and d.crn not like '08-%' and d.crn  not like '29-%' 
								  and d.crn not like 'HAL%')
					and d.crn not in ('35-002' ,'35-003','35-004','35-005','35-006','35-007','35-008',
								                                             '35-009','35-010','35-011','35-012','35-013','35-014','35-015')
				group by d.crn
				order by d.crn limit $limit,$offset";


	    //echo "getdispqtydetails4drilldown: $sql <br>";
        $result = mysql_query($sql);
		if(!$result) die("getdispqtydetails 4 drilldown failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
  
       function getdispqtydetails4tot($date,$crn)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

			 $sql = "select sum(dl.dispatch_qty),d.crn
				from dispatch d,
				     dispatch_line_items dl,work_order w
				where dl.link2dispatch = d.recnum and
                      d.status != 'Cancelled' and w.wonum = dl.wonum and
					  w.condition != 'Cancelled' and w.`condition` != 'Hold'
					  and d.disp_date <= '$date' and d.crn like '$crn%'
					  and w.actual_ship_date <='$date' and
					  (d.crn not like '01-%' and d.crn not like '02-%' and d.crn not like '03-%'
				                  and d.crn not like '04-%' and d.crn not like '05-%' and d.crn not like '06-%'
				                  and d.crn not like '07-%' and d.crn not like '08-%' and d.crn  not like '29-%' 
								  and d.crn not like 'HAL%')
						and d.crn not in ('35-002' ,'35-003','35-004','35-005','35-006','35-007','35-008',
								                                             '35-009','35-010','35-011','35-012','35-013','35-014','35-015')
				group by d.crn
				order by d.crn ";


	//	echo $sql."<br>";
        $result = mysql_query($sql);
		if(!$result) die("getdispqtydetails 4 drilldown failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }

  
     function getcqty4closedwo4drilldown($date,$crn)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select sum(w.comp_qty),
                       sum(w.comp_qty*(select min(replace(rm.rm_unitprize,'$','')/rm_qty_perbill)
                       from rmmaster rm where rm.crnnum=w.crn_num and rm.rm_status='Active' and rm.rm_unitprize !='')),w.rm_type
				       from work_order w
                            where
				                 w.actual_ship_date <= '$date' and
		                         w.`condition` != 'Cancelled' and
                                 w.`condition` != 'Hold'  and
                                 w.crn_num like '$crn%' and
                                 w.crn_num like '$crn%' and
								 (w.crn_num not like '01-%' and w.crn_num not like '02-%' and w.crn_num not like '03-%'
				                  and w.crn_num not like '04-%' and w.crn_num not like '05-%' and w.crn_num not like '06-%'
				                  and w.crn_num not like '07-%' and w.crn_num not like '08-%' 
								  and w.crn_num  not like '29-%' 
								  and w.crn_num not like 'HAL%')
								  and w.crn_num not in ('35-002' ,'35-003','35-004','35-005','35-006','35-007','35-008',
								                                             '35-009','35-010','35-011','35-012','35-013','35-014','35-015')
		                         group by w.crn_num";
        //echo "<br>getcqty4closedwo4drilldown: $sql <br>";
        $result = mysql_query($sql);
		if(!$result) die("getallCRN4closed report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }



  
 //               sum(w.qty*(select min(replace(rm.rm_unitprize,'$','')) from rmmaster rm where rm.crnnum=w.crn_num and rm.rm_status='Active' and rm.rm_unitprize !=''))

 function getwoqty4grn($date,$crn)
  {

        $type="!= 'Quarantined'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select sum(w.qty),sum(w.qty*(select min(replace(rm.rm_unitprize,'$','')/rm_qty_perbill)
		from rmmaster rm where rm.crnnum=w.crn_num and rm.rm_status='Active' and rm.rm_unitprize !=''))
				from work_order w ,grn g
				where w.`condition`!='Cancelled' and w.grnnum =g.grnnum and
				w.book_date<='$date' and  g.grntype !='Quarantined' and 
				g.status != 'Cancelled' and
				g.recieved_date<='$date' and
				g.recieved_date >= '2011-01-01' and
				g.crn like '$crn%' and
				(g.crn not like '01-%' and g.crn not like '02-%' and g.crn not like '03-%'
				  and g.crn not like '04-%' and g.crn not like '05-%' and g.crn not like '06-%'
				   and g.crn not like '07-%' and g.crn not like '08-%' and g.crn not like '29-%' 
				   and g.crn not like 'HAL%') and
                     g.rmbycim != '' and
                     g.rmbycust = ''" ;
		//echo $sql."<br>";
        $result = mysql_query($sql);
		if(!$result) die("get CRN for stock report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
//sum(gli.qty_to_make*(select min(replace(rm.rm_unitprize,'$','')) from rmmaster rm where rm.crnnum=g.crn and rm.rm_status='Active' and rm.rm_unitprize !=''))

  function getallGRN4Details($date,$crn)
 {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select sum(gli.qty_to_make)
                ,sum(gli.qty_to_make*(select min(replace(rm.rm_unitprize,'$','')/rm_qty_perbill)
                from rmmaster rm where rm.crnnum=g.crn and rm.rm_status='Active' and rm.rm_unitprize !=''))
				from grn_li gli,grn g
				where g.recnum = gli.link2grn and
                     (gli.amendlinenum = ''  or gli.amendlinenum is null or gli.amendlinenum = 0 ) and
                g.grntype !='Quarantined' and
				g.status != 'Cancelled' and
				g.recieved_date<= '$date' and
				g.recieved_date >= '2011-01-01' and
				g.crn like '$crn%' and
                     g.rmbycim != '' and
                     g.rmbycust = '' and
				(g.crn not like '01-%' and g.crn not like '02-%' and g.crn not like '03-%'
				  and g.crn not like '04-%' and g.crn not like '05-%' and g.crn not like '06-%'
				   and g.crn not like '07-%' and g.crn not like '08-%' and g.crn not like '29-%' 
				   and g.crn not like 'HAL%')
				";
        //echo $sql."<br>";
        $result = mysql_query($sql);
		if(!$result) die("get CRN for on time report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
//sum(wps.ret*(select min(replace(rm.rm_unitprize,'$','')) from rmmaster rm where rm.crnnum=wo.crn_num and rm.rm_status='Active' and rm.rm_unitprize !=''))
  function get_woretqty($date,$crn)
{
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select sum(wps.ret)
         ,sum(wps.ret*(select min(replace(rm.rm_unitprize,'$','')/rm_qty_perbill)
		 from rmmaster rm where rm.crnnum=wo.crn_num and rm.rm_status='Active' and rm.rm_unitprize !=''))
                       from work_order wo , grn g, wo_part_status wps
                       where  ((wps.link2wo = wo.recnum) and (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi')) and
					   wo.`condition` !='Cancelled' and
                       wo.book_date <= '$date' and
					   wo.grnnum = g.grnnum and
					   g.recieved_date > '2011-01-01' and
                       wo.grnnum !='' and wo.crn_num like '$crn%'";
        //echo $sql."<br>";
        $result = mysql_query($sql);
        if(!$result) die("Get MI details query failed..Please report to Sysadmin. " . mysql_error());
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
	                sum(dli.qty_recd),
		        (d.qty-(CASE when sum(dli.qty_recd) is null THEN 0 ELSE sum(dli.qty_recd) END)) as qrem,
                       d.wonum,sum(dli.qtyrej4store)
                  FROM delivery_note d
			  left join delivery_note_li dli on d.recnum = dli.link2Delivery
		  where
			     d.status !='Cancelled'  and
				 d.deliver_date > '2011-05-22' and
                          $wcond 
						  
				  group by d.recnum having qrem >0
                  order by d.deliver_date limit $offset,$limit";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getdeliverSummary query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
        //(d.status='Open' || d.status is null || d.status='')

     }
     
          function getdispqtydetails4drilldowncount($date,$crn)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

			 $sql = "select count(*) as numrows
				from dispatch d,
				     dispatch_line_items dl,work_order w
				where dl.link2dispatch = d.recnum and
                      d.status != 'Cancelled' and w.wonum = dl.wonum and
					  w.condition != 'Cancelled' and w.`condition` != 'Hold'
					  and d.disp_date <= '$date' and d.crn like '$crn%'
                      group by d.crn";


		//echo $sql."<br>";
         $result  = mysql_query($sql);
      $numrows = mysql_num_rows($result);
     return $numrows;
  }
  
  function get_woqty4stock_grn($grnnum,$date)
 {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select w.wonum,(w.qty),sum(wps.ret) from work_order w
                       left join wo_part_status wps on ((wps.link2wo = w.recnum) and 
					   (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi'))
                 where w.grnnum='$grnnum' and w.`condition` !='Cancelled'
                  and w.book_date<='$date'
                 group by wps.link2wo
                 order by w.wonum";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Get woqty4stock grn query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
 }
 
 function get_woqty($grnnum,$date) {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select wo.grnnum,sum(wo.qty)
                 from work_order wo
                 where
                      wo.grnnum = '$grnnum' 
					  and wo.`condition` !='Cancelled' 
					  and wo.book_date<='$date'
                 group by wo.grnnum";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Get MI details query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }
     

    function getcqty4closednodisp($date,$crn,$limit,$offset)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select sum(w.comp_qty),
                       sum(w.comp_qty*(select min(replace(rm.rm_unitprize,'$','')/rm_qty_perbill)
                       from rmmaster rm where rm.crnnum=w.crn_num and rm.rm_status='Active' and rm.rm_unitprize !='')),
                       w.crn_num,w.rm_type
				   from work_order w
                   where
				    w.actual_ship_date <= '$date' and
		            w.`condition` != 'Cancelled' and w.`condition` != 'Hold'  and w.crn_num like '$crn%'
		            group by w.crn_num limit $limit,$offset";
       // echo $sql."<br>";
        $result = mysql_query($sql);
		if(!$result) die("getallCRN4closed report failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
  }
  

    function getcqty4closednodispcount($date,$crn)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select sum(w.comp_qty),
                       sum(w.comp_qty*(select min(replace(rm.rm_unitprize,'$','')/rm_qty_perbill) from rmmaster rm where rm.crnnum=w.crn_num and rm.rm_status='Active' and rm.rm_unitprize !='')),
                       w.crn_num
				   from work_order w
                   where
				    w.actual_ship_date <= '$date' and
		            w.`condition` != 'Cancelled' and w.`condition` != 'Hold'  and w.crn_num like '$crn%'
		            group by w.crn_num";
       // echo $sql."<br>";
          $result  = mysql_query($sql);
         $numrows = mysql_num_rows($result);
         return $numrows;
  }
  
      function getoperdetails4wip($crn,$date)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

               $sql = "select max(op.stage_num),sum(op.qty)
                              from operator o,oper_mc_usage op
                                    where op.link2operator=o.recnum and
                                          o.crn='$crn' and
                                          o.st_date<='$date'";

        //echo $sql."<br>";
        $result = mysql_query($sql);
		if(!$result) die("getalloperatorDetails  failed ..Please report to Sysadmin. " . mysql_error());
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
                     (grnli.amendlinenum = ''  or grnli.amendlinenum is null or grnli.amendlinenum = 0 ) and
                     grn.grntype != 'Quarantined' and
					 grn.status != 'Cancelled' and
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
					 (grn.crn not like '01-%' and grn.crn not like '02-%' and grn.crn not like '03-%'
				      and grn.crn not like '04-%' and grn.crn not like '05-%' and grn.crn not like '06-%'
				      and grn.crn not like '07-%' and grn.crn not like '08-%' and grn.crn not like '29-%' 
					  and grn.crn not like 'HAL%')
					  and grn.recieved_date >= '2011-01-01'
               group by grn.grnnum
               order by grn.recieved_date
               limit $offset,$limit ";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
    }
    
     function get_stockbygrntot($cond)
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
                     (grnli.amendlinenum = ''  or grnli.amendlinenum is null or grnli.amendlinenum = 0 ) and
                     grn.grntype != 'Quarantined' and
					 grn.status != 'Cancelled' and
                     grn.rmbycim != '' and
                     grn.rmbycust = '' and
					 (grn.crn not like '01-%' and grn.crn not like '02-%' and grn.crn not like '03-%'
				     and grn.crn not like '04-%' and grn.crn not like '05-%' and grn.crn not like '06-%'
				     and grn.crn not like '07-%' and grn.crn not like '08-%' and grn.crn not like '29-%' 
					 and grn.crn not like 'HAL%')
					  and grn.recieved_date >= '2011-01-01'
               group by grn.grnnum
               order by grn.recieved_date";
       // echo $sql;
       $result = mysql_query($sql);
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
			       sum(dli.qty_recd),
				   (d.qty-(CASE when sum(dli.qty_recd) is null THEN 0 ELSE sum(dli.qty_recd) END)) as qrem
                  FROM delivery_note d
				  left join delivery_note_li dli on d.recnum = dli.link2Delivery
				  where
				  d.status !='Cancelled'and
                  $wcond
				  group by d.recnum having qrem > 0
                  order by d.deliver_date";
				 //echo $sql;
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $result  = mysql_query($sql) or die('getdeliverDetailsCount query failed');
		$numrows=mysql_num_rows($result);
		//echo "number of rows is : $numrows";
        return $numrows;

    }
    
    function getdeliverDetails4total($cond) {
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
	                sum(dli.qty_recd),
		       (d.qty-(CASE when sum(dli.qty_recd) is null THEN 0 ELSE sum(dli.qty_recd) END)) as qrem,
                       d.wonum,sum(dli.qtyrej4store)
                  FROM delivery_note d
			  left join delivery_note_li dli on d.recnum = dli.link2Delivery
		  where
			     d.status !='Cancelled'  and
				 d.deliver_date > '2011-05-22' and
                          $wcond
				  group by d.recnum having qrem > 0
                  order by d.deliver_date";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getdeliverSummary query failed..Please report to Sysadmin. " . mysql_error());
        return $result;
        //(d.status='Open' || d.status is null || d.status='')

     }

   function getclosedwo_dispatch($date,$crn)
   {
        $newlogin = new userlogin;
         $newlogin->dbconnect();
          $sql = "select w.comp_qty
                 from work_order w
                       left join dispatch_line_items dli on dli.wonum=w.wonum
                       where dli.wonum is null  and
                             w.`condition`='Closed' and
                             w.crn_num='$crn'  and
                             (w.actual_ship_date <= '$date' and   
                              w.actual_ship_date != '0000-00-00' and 
							  w.actual_ship_date is not null) 
                             group by w.crn_num
                           ";
		//echo "222222 $sql";
         $result  = mysql_query($sql) or die('getclosedwo_dispatch failed');
         return $result;
   }

}
?>
