<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: deliverliClass.php
// Maintains the class for Dispatch Line items
// Revision: v1.0
//====================================

include_once('loginClass.php');

class dnli {  
	var
     $line_num,
     $cofc_num,
     $cofc_date,
     $qty_recd,
     $qty_acc,
     $qty_rej,
     $insp_stamp,
     $link2deliver,
     $nc_num,
     $disp_qty,
     $cost,
     $qty_rej4stores,
     $qty_rew,$qty_rewqa,
     $dn_stage;

    // Constructor definition
    function dnli() {
        $this->line_num = '';
        $this->cofc_num = '';
        $this->cofc_date = '';
        $this->qty_recd = '';
        $this->qty_acc = '';
        $this->qty_rej = '';
        $this->insp_stamp= '';
        $this->link2deliver = '';
        $this->supp_wo = '';
        $this->datecode = '';
        $this->nc_num = '';
        $this->cost = '';
        $this->qty_recj4stores = '';
        $this->qty_rew = '';
        $this->qty_rewqa = '';
         $this->disp_qty = '';
         $this->dn_stage = '';
     }

    // Property get and set
    function getline_num() {
           return $this->line_num;
    }

    function setline_num ($reqline_num) {
           $this->line_num = $reqline_num;
    }

    function getcofc_num() {
           return $this->cofc_num;
    }

    function setcofc_num ($reqcofc_num) {
           $this->cofc_num = $reqcofc_num;
    }

    function getcofc_date() {
           return $this->cofc_date;
    }
    function setcofc_date ($reqcofc_date) {
           $this->cofc_date = $reqcofc_date;
    }

    function getqty_recd() {
           return $this->qty_recd;
    }
    function setqty_recd ($reqqty_recd) {
           $this->qty_recd = $reqqty_recd;
    }

    function getqty_acc() {
           return $this->qty_acc;
    }
    function setqty_acc($reqqty_acc) {
           $this->qty_acc = $reqqty_acc;
    }

    function getqty_rej() {
           return $this->qty_rej;
    }

    function setqty_rej ($reqqty_rej) {
           $this->qty_rej = $reqqty_rej;
    }

    function getinsp_stamp() {
           return $this->insp_stamp;
    }

    function setinsp_stamp ($reqinsp_stamp) {
           $this->insp_stamp = $reqinsp_stamp;
    }

    function getlink2deliver() {
           return $this->link2deliver;
    }

    function setlink2deliver ($reqlink2deliver) {
           $this->link2deliver = $reqlink2deliver;
    }   

    function getsupp_wo() {
           return $this->supp_wo;
    }

    function setsupp_wo ($reqsupp_wo) {
           $this->supp_wo = $reqsupp_wo;
    }
    
    function getdatecode() {
           return $this->datecode;
    }

    function setdatecode ($reqdatecode) {
           $this->datecode = $reqdatecode;
    }
    
     function getnc_num() {
           return $this->nc_num;
    }

    function setnc_num ($nc_num) {
           $this->nc_num = $nc_num;
    }
    
    function getcost() {
           return $this->cost;
    }
    function setcost($cost) {
           $this->cost = $cost;
    }
    function setqty_rej4stores($qty_rej4stores) {
           $this->qty_rej4stores = $qty_rej4stores;
    }
    
     function setqty_rew($qty_rew) {
           $this->qty_rew = $qty_rew;
    }
    
     function setqty_rewqa($qty_rewqa) {
           $this->qty_rewqa = $qty_rewqa;
    }


    function getdisp_qty() {
           return $this->disp_qty;
    }
    function setdisp_qty($reqdisp_qty) {
           $this->disp_qty = $reqdisp_qty;
    }
    function getdn_stage() {
           return $this->dn_stage;
    }

    function setdn_stage ($reqdn_stage) {
           $this->dn_stage = $reqdn_stage;
    }
    
    function addLI() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();        
        $sql = "select nxtnum from seqnum where tablename = 'delivery_note_li' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

        $line_num = "'" . $this->line_num . "'";
        $dn_stage = "'" . $this->dn_stage . "'";
        $qty_recd = $this->qty_recd ? $this->qty_recd : 0;
        $qty_acc = $this->qty_acc ? $this->qty_acc : 0;
        $qty_rej = $this->qty_rej ? $this->qty_rej : 0;
        $qty_rewqa = $this->qty_rewqa ? $this->qty_rewqa : 0;
        $cofc_num = "'" . $this->cofc_num . "'";
        $cofc_date = $this->cofc_date ? "'" . $this->cofc_date  . "'" : '0000-00-00';
        $insp_stamp = "'" . $this->insp_stamp  . "'";     
    		$link2deliver =  $this->link2deliver;
    		$suppwo = "'" . $this->supp_wo  . "'";
    		//$dc = "'" . $this->datecode  . "'";
    		$dc = $this->datecode ? "'" . $this->datecode  . "'" : '0000-00-00';
    		$nc_num = "'" . $this->nc_num  . "'";
    		$cost=$this->cost ? $this->cost : 0;
    		$qty_rej4stores = $this->qty_rej4stores ? $this->qty_rej4stores : 0;
        $qty_rew = $this->qty_rew ? $this->qty_rew : 0;
     
        $sql = "INSERT INTO delivery_note_li (recnum,line_num,
                            cofc_num, cofc_date, qty_recd,qty_acc,qty_rej,
                            insp_stamp, link2delivery, supplier_wo,datecode,ncnum,cost,qtyrej4store,qty_rew,qty_rewqa,dn_stage)
                      VALUES ($objid,$line_num, $cofc_num, $cofc_date, $qty_recd,
                              $qty_acc, $qty_rej, $insp_stamp,
                              $link2deliver,$suppwo,$dc,$nc_num,$cost,$qty_rej4stores,$qty_rew,$qty_rewqa,$dn_stage)";
        // echo "$sql";exit;
		$result = mysql_query($sql);
        if(!$result) die("Insert to Delivery LI didn't work..Please report to Sysadmin. " . mysql_error()); 
		$sql = "update seqnum set nxtnum = $objid where tablename = 'delivery_note_li'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work for DN LI..Please report to Sysadmin. " . mysql_error());


 }
 
function getwos4delivery()
{
       $newlogin = new userlogin;
       $newlogin->dbconnect();

       $sql = "select w.recnum,w.wonum,m.secondary_partname,w.po_num,
                      w.actual_ship_date,w.qty,
                      c.name,
                      m.partname, m.rm_spec, m.drg_issue,
                      m.attachments,
                      soli.line_num, m.cos,g.batch_num,g.grnnum
                 from sales_order so,
                      so_line_items soli,
                      company c,
                      master_data m,
                      work_order w,
                      grn g
                 where w.wo2customer = c.recnum and
                       w.po_num = so.po_num and
                       soli.link2so = so.recnum and
                       soli.crn_num = m.CIM_refnum and
                       m.recnum = w.link2masterdata and
                       w.grnnum = g.grnnum and
                       (so.status = 'Open' || so.status = 'Closed') and
					   w.treatment = 'With Treatment'
                 group by w.wonum";
      // echo $sql;
       $result = mysql_query($sql);
       return $result;
}

    function getLI($indelrecnum) {
        $indelrecnum = "'" . $indelrecnum . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select dnl.recnum,
		              dnl.line_num,
					  dnl.cofc_num,
					   dnl.cofc_date,
					   dnl.qty_recd,
					   dnl.qty_acc,
					   dnl.qty_rej,
					   dnl.insp_stamp,
					   dnl.link2delivery,
					   dnl.supplier_wo,
					   dnl.datecode,
					   dnl.ncnum,
					   dnl.cost,
					   dnl.qtyrej4store,
					   dnl.qty_rew,
					   dnl.qty_rewqa,
             dnl.disp_qty,
             dnl.dn_stage
                 from delivery_note dn,delivery_note_li dnl
                 where dn.recnum = dnl.link2delivery and dnl.link2Delivery = $indelrecnum 
                order by dnl.line_num";
         // echo "<br>$sql";  

        $result = mysql_query($sql);
        return $result;
     }
     

    function updateLI($recnum) {
        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $line_num = "'" . $this->line_num . "'";
        $dn_stage = "'" . $this->dn_stage . "'";
        $qty_recd = $this->qty_recd ? $this->qty_recd : 0;
        $qty_acc = $this->qty_acc ? $this->qty_acc : 0;
        $qty_rej = $this->qty_rej ? $this->qty_rej : 0;
        $cofc_num = "'" . $this->cofc_num . "'";
        $cofc_date = $this->cofc_date ? "'" . $this->cofc_date  . "'" : '0000-00-00';
        $insp_stamp = "'" . $this->insp_stamp  . "'";
       	$suppwo = "'" . $this->supp_wo  . "'";
	//	$dc = "'" . $this->datecode  . "'";
		    $dc = $this->datecode ? "'" . $this->datecode  . "'" : '0000-00-00';
        $nc_num = "'" . $this->nc_num  . "'";
        $disp_qty = "'" . $this->disp_qty  . "'";
   	    $cost=$this->cost?$this->cost:0;
   	    $qty_rej4stores = $this->qty_rej4stores ? $this->qty_rej4stores : 0;
        $qty_rew = $this->qty_rew ? $this->qty_rew : 0;
        $qty_rewqa = $this->qty_rewqa ? $this->qty_rewqa : 0;
        $sql = "update delivery_note_li
                          set line_num = $line_num,
                              cofc_num = $cofc_num,
                              cofc_date = $cofc_date,
                              qty_recd = $qty_recd,
                              qty_acc = $qty_acc,
                              qty_rej = $qty_rej,
                              insp_stamp = $insp_stamp,
                              supplier_wo = $suppwo,
                              datecode = $dc,
                              ncnum= $nc_num,
                              disp_qty= $disp_qty,
                              cost=$cost,
                              qtyrej4store=$qty_rej4stores,
                              qty_rew=$qty_rew,
                              qty_rewqa=$qty_rewqa,
                              dn_stage = $dn_stage
                where recnum = $lirecnum";
          // echo '--------'.$sql;exit;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to Deliver LI didn't work..Please report to Sysadmin. " . mysql_error());
     }
     
     function deleteLI($inplirecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $lirecnum = "'" . $inplirecnum . "'";
        $sql = "delete from delivery_note_li where recnum = $lirecnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Line Items failed...Please report to SysAdmin. " . mysql_error());
      }
      
  //     function updateWoLI($wonum,$dnrecnum,$qty) {

  //       $newlogin = new userlogin;
  //       $newlogin->dbconnect();
  //       $sql = "start transaction";

  //       $qty_recd = $this->qty_recd ? $this->qty_recd : 0;
  //       $qty_acc = $this->qty_acc ? $this->qty_acc : 0;
  //       $qty_rej = $this->qty_rej ? $this->qty_rej : 0;
  //       $cofc_num = "'" . $this->cofc_num . "'";
  //       $cofc_date = $this->cofc_date ? "'" . $this->cofc_date  . "'" : '0000-00-00';
  //       $suppwo = "'" . $this->supp_wo  . "'";
  //       $nc_num = "'" . $this->nc_num  . "'";
  //       $qty_rewqa = $this->qty_rewqa ? $this->qty_rewqa : 0;
  //       $prefix = "DN";
		// $strrecnum=sprintf("%03d",$dnrecnum);
		// $dnnum=$prefix.$strrecnum;
		
  //     $sql="update wo_part_status wo_p ,work_order wo set
  //            wo_p.stage='PostDN',
  //            wo_p.acc =$qty_acc,
  //            wo_p.rej=$qty_rej,
  //            wo_p.dn='$dnnum',
  //            wo_p.dn_sent=$qty ,
  //            wo_p.dn_recv=$qty_recd,
  //            wo_p.cofc_date=$cofc_date,
  //            wo_p.supplier_wo=$suppwo,
  //            wo_p.ncnum=$nc_num,
  //            wo_p.rework=$qty_rewqa
  //            where wo_p.link2wo=wo.recnum and wo.wonum=$wonum and wo_p.cofc_num=$cofc_num";
  //          //echo $sql;
  //          $result = mysql_query($sql);
  //          // Test to make sure query worked
  //          if(!$result) die("Update to Deliver LI didn't work..Please report to Sysadmin. " . mysql_error());
           
  //    }
     
     function checkWoLI($wonum){
       $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $sql="select recnum as rec from work_order where wonum='$wonum'";
        //echo $sql;
        $result  = mysql_query($sql) or die('checkWoLI failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $linkWo = $row['rec'];
        return $linkWo;
           
     }
     
  //    function addWoLI($recnum,$dnrecnum,$qty) {
  //        //echo$recnum."in class";
  //       $newlogin = new userlogin;
  //       $newlogin->dbconnect();
  //       $sql = "start transaction";

  //       $qty_recd = $this->qty_recd ? $this->qty_recd : 0;
  //       $qty_acc = $this->qty_acc ? $this->qty_acc : 0;
  //       $qty_rej = $this->qty_rej ? $this->qty_rej : 0;
  //       $cofc_num = "'" . $this->cofc_num . "'";
  //       $cofc_date = $this->cofc_date ? "'" . $this->cofc_date  . "'" : '0000-00-00';
  //       $suppwo = "'" . $this->supp_wo  . "'";
  //       $nc_num = "'" . $this->nc_num  . "'";
  //       $qty_rewqa = $this->qty_rewqa ? $this->qty_rewqa : 0;
  //       $prefix = "DN";
		// $strrecnum=sprintf("%03d",$dnrecnum);
		// $dnnum=$prefix.$strrecnum;

  //     $sql="insert into `wo_part_status` (
  //                        `acc` ,
  //                        `rej`,
  //                        `stage` ,
  //                        `link2wo`,
  //                         `dn`,
  //                        `dn_sent`,
  //                        `dn_recv`,
  //                         `cofc_num`,
  //                         `cofc_date`,
  //                         `supplier_wo`,
  //                         `ncnum`,
  //                         `rework`
  //                          )
  //          values(
  //                         $qty_acc,
  //                         $qty_rej,
  //                         'PostDN',
  //                         $recnum,
  //                         '$dnnum',
  //                         $qty,
  //                         $qty_recd,
  //                         $cofc_num,
  //                         $cofc_date,
  //                         $suppwo,
  //                         $nc_num,
  //                         $qty_rewqa)";
  //          //echo $sql;
  //          $result = mysql_query($sql);
  //          if(!$result) die("Insert of Part Status failed..Please report to Sysadmin " . mysql_error());
  //    }

     function checkCofc($cofcnum,$wonum){
       $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql="select count(*) as cofc
              from wo_part_status wo_p,work_order wo
              where wo_p.cofc_num='$cofcnum'
              and wo_p.link2wo=wo.recnum
              and wo.wonum=$wonum";
        //echo $sql;
        $result  = mysql_query($sql) or die('checkWoLI failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $linkWo = $row['cofc'];
        return $linkWo;

     }  //
     
      function getDn($dnrecnum,$wonum){
       $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql="select( sum(dli.qty_recd)+ sum(dli.qtyrej4store))as dn_qty_recd,sum(dli.qtyrej4store) as dn_qty_rej4st
              from delivery_note_li dli,delivery_note dn
              where dli.link2delivery=dn.recnum and dn.wonum='$wonum'
              group by dn.wonum";
        //echo $sql;
        $result  = mysql_query($sql) or die('getDn failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $tot_dnrecd = $row['dn_qty_recd'];
        $tot_dnrej = $row['dn_qty_rej4st'];
        return $tot_dnrecd;
     }
     
      function getDnAcc($dnrecnum,$wonum){
       $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql="select sum(dli.qty_acc) as dn_qty_acc
              from delivery_note_li dli,delivery_note dn
              where dli.link2delivery=dn.recnum and dn.wonum='$wonum'
              group by dn.wonum ";
        //echo $sql;
        $result  = mysql_query($sql) or die('getDnacc failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $tot_dn = $row['dn_qty_acc'];
        return $tot_dn;

     }


   //replace method

     // function updateWO_DN($dn_qty_acc,$dn_qty_recd,$wonum,$qty){
     //    $newlogin = new userlogin;
     //    $newlogin->dbconnect();

     //    $sql="update work_order set   dn_qty_sent = $qty,
     //                                  dn_qty_recd = $dn_qty_recd,
     //                                  comp_qty = $dn_qty_acc
     //                                  where wonum = $wonum";
     //    //echo "<br>$sql";
     //    $result  = mysql_query($sql) or die('updateWO_DN failed');
     //    return $result;

     // }

	 function updateWO_acc4dnrestore($dn_qty_acc,$dn_qty_recd,$wonum,$qty)
	{
	    $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql="update work_order set   acc4dn = $qty,
		                                  dn_qty_sent = $qty,
                                      dn_qty_recd = $dn_qty_recd,
                                      comp_qty = $dn_qty_acc
                                      where wonum = $wonum";
        //echo "<br>$sql";
        $result  = mysql_query($sql) or die('updateWO_DN failed');
        return $result;

     }

     function deleteWOLI($cofc_num,$wonum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete wo_p.*
                from wo_part_status wo_p,work_order wo
                     where
                          wo_p.cofc_num ='$cofc_num' and
                          wo_p.link2wo=wo.recnum and
                          wo.wonum=$wonum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Line Items failed...Please report to SysAdmin. " . mysql_error());
      }
      
      function getdeliver_restore()
     {
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $sql = "select d.recnum,
                        d.dnnum,
                        d.crn,
                        d.wonum,
                        d.qty,
                        dl.cofc_num,
                        dl.qty_acc,
                        dl.qty_rej,
                        dl.supplier_wo,
                        dl.qty_recd,
                        dl.cofc_date
                FROM    delivery_note d,delivery_note_li dl
                        where dl.link2delivery=d.recnum
					order by (d.wonum+0) limit 100";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getdeliverSummary query failed..Please report to Sysadmin. " . mysql_error());
        return $result;

     }
      function addWoLI_restore($recnum,$dnrecnum,$qty,$qty_recd,$qty_acc,$qty_rej,$suppwo,$cofc_num,$cofc_date) {
         //echo$recnum."in class";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
       // $sql = "start transaction";
        $prefix = "DN";
		$strrecnum=sprintf("%03d",$dnrecnum);
		$dnnum=$prefix.$strrecnum;

      $sql="insert into `wo_part_status` (
                         `acc` ,
                         `rej`,
                         `stage` ,
                         `link2wo`,
                          `dn`,
                         `dn_sent`,
                         `dn_recv`,
                          `cofc_num`,
                          `supplier_wo`
                           )
           values(
                          $qty_acc,
                          $qty_rej,
                          'PostDN',
                          $recnum,
                          '$dnnum',
                          $qty,
                          $qty_recd,
                          '$cofc_num',
                          '$suppwo')";
      //echo $sql;
           $result = mysql_query($sql);
           if(!$result) die("Insert of Part Status failed..Please report to Sysadmin " . mysql_error());
     }
     
      function updateWoLI_restore($wonum,$dnrecnum,$qty,$qty_recd,$qty_acc,$qty_rej,$cofc_num,$cofc_date,$suppwo) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
       // $sql = "start transaction";

        $qty_recd = $this->qty_recd ? $this->qty_recd : 0;
        $qty_acc = $this->qty_acc ? $this->qty_acc : 0;
        $qty_rej = $this->qty_rej ? $this->qty_rej : 0;
        $cofc_num = "'" . $this->cofc_num . "'";
        $cofc_date = $this->cofc_date ? "'" . $this->cofc_date  . "'" : '0000-00-00';
        $suppwo = "'" . $this->supp_wo  . "'";
        $prefix = "DN";
		$strrecnum=sprintf("%03d",$dnrecnum);
		$dnnum=$prefix.$strrecnum;

      $sql="update wo_part_status wo_p ,work_order wo set
             wo_p.stage='PostDN',
             wo_p.acc =$qty_acc,
             wo_p.rej=$qty_rej,
             wo_p.dn='$dnnum',
             wo_p.dn_sent=$qty ,
             wo_p.dn_recv=$qty_recd,
             wo_p.cofc_date=$cofc_date,
             wo_p.supplier_wo=$suppwo
             where wo_p.link2wo=wo.recnum and wo.wonum=$wonum and wo_p.cofc_num=$cofc_num";
           //echo $sql;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to Deliver LI didn't work..Please report to Sysadmin. " . mysql_error());

     }
//add method

    function updateWO_comp($dn_qty_accepted,$wonum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql="update work_order set comp_qty = $dn_qty_accepted
                                      where wonum = '$wonum'";
        //echo $sql;
        $result  = mysql_query($sql) or die('update work order failed');
        return $result;

     }
     function getcomp_qty4wo_old($dnrecnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql="select sum(dli.qty_acc) as wo_comp_qty from delivery_note_li dli 
		            where link2delivery='$dnrecnum'";
        //echo $sql;
        $result  = mysql_query($sql) or die('getDn failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $tot_dn_accp = $row['wo_comp_qty'];
        return $tot_dn_accp;
     }
     function getcomp_qty4wo($dnwonum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql="select sum(dli.qty_acc) as wo_comp_qty
		        from delivery_note d, delivery_note_li dli 
				where d.wonum ='$dnwonum' and
				      d.recnum = dli.link2delivery
			    group by d.wonum";
        //echo $sql;
        $result  = mysql_query($sql) or die('getDn failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $tot_dn_accp = $row['wo_comp_qty'];
        return $tot_dn_accp;
     }

  //    function update_new_WODN_qty($qty,$wonum,$dnrecnum)
  //     {
  //       $newlogin = new userlogin;
  //       $newlogin->dbconnect();
  //       $prefix = "DN";
		// $strrecnum=sprintf("%03d",$dnrecnum);
		// $dnnum=$prefix.$strrecnum;
		
  //       $sql="update work_order w,wo_part_status wo_p set
  //                               w.dn_qty_sent = $qty,
  //                               wo_p.dn_sent= $qty,
  //                               wo_p.dn='$dnnum'
  //                               where w.wonum = '$wonum'
  //                               and wo_p.link2wo=w.recnum
  //                               and (wo_p.stage = 'DN' || wo_p.stage = 'dn' || wo_p.stage = 'Dn')
  //                               and (wo_p.dn='0') ";
  //       //echo $sql;
  //       $result  = mysql_query($sql) or die('update work order part status failed');
  //       return $result;

  //    }
  //     function updateWODN_qty($qty,$wonum,$dnrecnum)
  //     {
  //       $newlogin = new userlogin;
  //       $newlogin->dbconnect();
  //       $prefix = "DN";
		// $strrecnum=sprintf("%03d",$dnrecnum);
		// $dnnum=$prefix.$strrecnum;

  //       $sql="update work_order w,wo_part_status wo_p set
  //                               w.dn_qty_sent = $qty,
  //                               wo_p.dn_sent= $qty,
  //                               wo_p.dn='$dnnum'
  //                               where w.wonum = '$wonum'
  //                               and wo_p.link2wo=w.recnum
  //                               and (wo_p.stage = 'DN' || wo_p.stage = 'dn' || wo_p.stage = 'Dn')";

  //       //echo $sql;
  //       $result  = mysql_query($sql) or die('update work order part status failed');
  //       return $result;

  //    }

    function getwoqty_info($wonum,$dnrecnum)
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $prefix = "DN";
		$strrecnum=sprintf("%03d",$dnrecnum);
		$dnnum=$prefix.$strrecnum;
        $sql="select sum(dl.qty_acc),sum(dl.qty_recd),sum(d.qty)  FROM delivery_note d,delivery_note_li dl
                        where dl.link2delivery=d.recnum and d.wonum='$wonum' and d.dnnum='$dnnum'" ;
        //echo $sql;
        $result  = mysql_query($sql) or die('getwoqty_info failed');
        return $result;
    
    }
	//add
     function checkCofc_sec($wonum){
       $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql="select count(*) as cofc
              from wo_part_status wo_p,work_order wo
                  where  wo_p.link2wo=wo.recnum and wo.wonum='$wonum'
                         and wo_p.stage ='DN'";
        //echo $sql;
        $result  = mysql_query($sql) or die('checkWoLI failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $linkWo = $row['cofc'];
        return $linkWo;

     }


      function addWoLI_DNrestore($recnum,$dnrecnum,$qty,$qty_recd,$qty_acc,$qty_rej,$suppwo,$cofc_num,$cofc_date) {
         //echo$recnum."in class";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
       // $sql = "start transaction";
        $prefix = "DN";
		$strrecnum=sprintf("%03d",$dnrecnum);
		$dnnum=$prefix.$strrecnum;

      $sql="insert into `wo_part_status` (
                         `acc` ,
                         `rej`,
                         `stage` ,
                         `link2wo`,
                          `dn`,
                         `dn_sent`
                           )
           values(
                          $qty_acc,
                          $qty_rej,
                          'DN',
                          $recnum,
                          '$dnnum',
                          $qty)";
      echo "<br>$sql";
           $result = mysql_query($sql);
           if(!$result) die("Insert of Part Status failed..Please report to Sysadmin " . mysql_error());
     }


     
     function checkdn_wo($wonum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql="select count(*) as cofc
              from wo_part_status wo_p,work_order wo
                  where  wo_p.link2wo=wo.recnum and wo.wonum='$wonum'
                         and wo_p.stage ='DN'";
        //echo $sql;
        $result  = mysql_query($sql) or die('checkWoLI failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $linkWo = $row['cofc'];
        return $linkWo;

     }
     function getallDn4wo($wonum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql="select sum(qty) as to_qty from delivery_note where wonum='$wonum' group by wonum";
        // echo $sql;
        $result  = mysql_query($sql) or die('getallDn4wo failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $tot_dnqty = $row['to_qty'];
        return $tot_dnqty;
     }
     
     function getnc4dn($nc_num,$qty_rej,$wonum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $sql="select recnum,qty from nc4qa where recnum='$nc_num' and qty='$qty_rej' and wonum='$wonum'";

       // echo $sql;
        $result  = mysql_query($sql) or die('getnc4dn failed');
        return $result;
     }
     
     function deleteDN_WO($cofc_num,$wonum,$dnrecnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $prefix = "DN";
		$strrecnum=sprintf("%03d",$dnrecnum);
		$dnnum=$prefix.$strrecnum;
		
        $sql="delete wo_p.*
                from wo_part_status wo_p,work_order wo
                     where
                          wo_p.dn='$dnnum' and
                          wo_p.link2wo=wo.recnum and
                          wo.wonum=$wonum ";

        //echo $sql;
        $result  = mysql_query($sql) or die('deleteDN_WO failed');
        return $result;
     
     }

     function updatecompqty4dn($delrecnum,$dn_qty_acc){
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql="update delivery_note set comp_qty = comp_qty+$dn_qty_acc
                                       where recnum = $delrecnum";
        // echo "<br>$sql";exit;  
        $result  = mysql_query($sql) or die('updatecompqty4dn failed');
        return $result;

     }
     // function updateWO_DN_QTY($wonum)
     // {
     //    $newlogin = new userlogin;
     //    $newlogin->dbconnect();

     //    $sql="update work_order w
     //                            set w.dn_qty_sent=0,
     //                                w.dn_qty_recd=0,
     //                                w.acc4dn=0
     //                      where
     //                            w.wonum=$wonum";

     //    // echo $sql;
     //    $result  = mysql_query($sql) or die('updateWO_DN_QTY failed');
     //    return $result;

     // }


}
