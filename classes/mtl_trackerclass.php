<?
//====================================
// Author: FSI
// Date-written = June 20, 2007
// Filename: mtl_trackerClass.php
// Maintains the class for Quotes
// Revision: v1.0
//====================================

include_once('loginClass.php');

class mtl_trk {

    var  $adv_license_qty,
         $invnum,
         $invdate,
         $invqty,
         $supdel_date,
         $paydue_date,
         $payexp_date,
         $pick_date,
         $sail_date,
         $eda,
         $aad,
         $expclr_date,
         $cfdel_date,
         $link2mtltracker,
         $ldate,
         $userid,
         $usertype,
         $description,
         $ffpaydue_date,
         $ffpayexp_date,
         $cfpaydue_date,
         $cfpayexp_date,
         $packnum,
         $bill_lading_num,
         $bil_lading_date,
         $docket_num,
         $boe_num,
		 $recd_date,
		 $credit_note;

    // Constructor definition
    function mtl_trk() {
        $this->adv_license_qty = '';
        $this->invnum = '';
        $this->invdate = '';
        $this->invqty = '';
        $this->supdel_date = '';
        $this->paydue_date = '';
        $this->payexp_date = '';
        $this->pick_date = '';
        $this->sail_date = '';
        $this->eda = '';
        $this->aad = '';
        $this->expclr_date = '';
        $this->cfdel_date = '';
        $this->link2mtltracker = '';
        $this->ffpaydue_date = '';
        $this->ffpayexp_date = '';
        $this->cfpaydue_date = '';
        $this->cfpayexp_date = '';
        $this->packnum = '';
        $this->bill_lading_num = '';
        $this->bil_lading_date = '';
        $this->docket_num = '';
        $this->boe_num = '';        
        $this->ldate = '';
        $this->userid = '';
        $this->usertype = '';
        $this->description = '';
		$this->recd_date='';
    }

    // Property get and set
	function getcredit_note()
	{
		return $this->credit_note;
	}
	function setcredit_note($credit_note)
	{
		$this->credit_note=$credit_note;
	}
    function getadv_license_qty() {
           return $this->adv_license_qty;
    }
	  function setrecd_date($recd_date) {
		  echo $recd_date.'in class';
           $this->recd_date = $recd_date;
    }

    function setadv_license_qty ($adv_license_qty) {
           $this->adv_license_qty = $adv_license_qty;
    }
    function getinvnum() {
           return $this->invnum;
    }

    function setinvnum ($invnum) {
           $this->invnum = $invnum;
    }

    function getinvdate() {
           return $this->invdate;
    }

    function setinvdate ($invdate) {
           $this->invdate = $invdate;
    }
    function getinvqty() {
           return $this->invqty;
    }

    function setinvqty ($invqty) {
           $this->invqty = $invqty;
    }
    function getsupdel_date() {
           return $this->supdel_date;
    }

    function setsupdel_date ($supdel_date) {
           $this->supdel_date = $supdel_date;
    }
    function getpaydue_date() {
           return $this->paydue_date;
    }

    function setpaydue_date ($paydue_date) {
           $this->paydue_date = $paydue_date;
    }
    
    function getpayexp_date() {
           return $this->payexp_date;
    }

    function setpayexp_date ($payexp_date) {
           $this->payexp_date = $payexp_date;
    }
    function getpick_date() {
           return $this->pick_date;
    }

    function setpick_date ($pick_date) {
           $this->pick_date = $pick_date;
    }
    function getsail_date() {
           return $this->sail_date;
    }

    function setsail_date($sail_date) {
           $this->sail_date = $sail_date;
    }

    function geteda() {
           return $this->eda;
    }

    function seteda ($eda) {
           $this->eda = $eda;
    }

    function getaad() {
           return $this->aad;
    }

    function setaad ($aad) {
           $this->aad = $aad;
    }

    function getexpclr_date() {
           return $this->expclr_date;
    }

    function setexpclr_date ($expclr_date) {
           $this->expclr_date = $expclr_date;
    }

    function getcfdel_date() {
           return $this->cfdel_date;
    }

    function setcfdel_date ($cfdel_date) {
           $this->cfdel_date = $cfdel_date;
    }
    
    function getlink2mtltracker() {
           return $this->link2mtltracker;
    }

    function setlink2mtltracker ($link2mtltracker) {
           $this->link2mtltracker = $link2mtltracker;
    }


    function getuserid() {
           return $this->userid;
    }

    function setuserid ($userid) {
           $this->userid = $userid;
    }

    function getusertype() {
           return $this->usertype;
    }

    function setusertype ($usertype) {
           $this->usertype = $usertype;
    }

    function getdescription() {
           return $this->description;
    }

    function setdescription ($description) {
           $this->description = $description;
    }


    function getffpaydue_date() {
           return $this->ffpaydue_date;
    }

    function setffpaydue_date ($ffpaydue_date) {
           $this->ffpaydue_date = $ffpaydue_date;
    }
    
    function getffpayexp_date() {
           return $this->ffpayexp_date;
    }

    function setffpayexp_date ($ffpayexp_date) {
           $this->ffpayexp_date = $ffpayexp_date;
    }
    
    function getcfpaydue_date() {
           return $this->cfpaydue_date;
    }

    function setcfpaydue_date ($cfpaydue_date) {
           $this->cfpaydue_date = $cfpaydue_date;
    }
    
    function getcfpayexp_date() {
           return $this->cfpayexp_date;
    }

    function setcfpayexp_date ($cfpayexp_date) {
           $this->cfpayexp_date = $cfpayexp_date;
    }
    
    
    function setpacknum ($packnum) {
           $this->packnum = $packnum;
    }
    
    function setbill_lading_num ($bill_lading_num) {
           $this->bill_lading_num = $bill_lading_num;
    }
    
    function setbil_lading_date ($bil_lading_date) {
           $this->bil_lading_date = $bil_lading_date;
    }    
    function setdocket_num($docket_num) {
           $this->docket_num = $docket_num;
    }    
    function setboe_num ($boe_num) {
           $this->boe_num = $boe_num;
    }
    
 /*   function getmonth1($m)
        {
         // echo "month is $m<br>";
           $montharr = array('Jan'=>01,
                             'Feb'=>02,
                             'Mar'=>03,
                             'Apr'=>04,
                             'May'=>05,
                             'Jun'=>06,
                             'Jul'=>07,
                             'Aug'=>08,
                             'Sep'=>09,
                             'Oct'=>10,
                             'Nov'=>11,
                             'Dec'=>12);
                while(list($index,$value)=each($montharr))
                {
                  // echo $index . '-' . $value . '<br>';
                   if($index == $m)
                     break;
                }
              //  echo "value is $value";
                return $value;
        }    */

    
    function convert_date($date, $i)
    {
        $space='            ';
        $montharr = array('Jan'=>1,'Feb'=>2,'Mar'=>3,'Apr'=>4,'May'=>5,'Jun'=>6,'Jul'=>7,'Aug'=>8,'Sep'=>9,'Oct'=>10,'Nov'=>11,'Dec'=>12);
        if ($date != '')
        {
            $datearr = preg_split('/\s+/', $date);
            $d=trim($datearr[0]);
            $m=trim($datearr[1]);
            $y=trim($datearr[2]);
         
            $month = $montharr[$m];
            $fd1=mktime(0,0,0,$month,$d,$y);
            $fd = date('Y-m-d',$fd1);
            return $fd;
        }
        else
		{
              $fd = '';
              return $fd;
		}
    }
    function addLI($inpponum) 
	{    
        $ponum = "'" . $inpponum . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'mtl_tracker_li' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        //echo $objid;

         $invnum = "'" . $this->invnum . "'";
         $invdate = "'" . $this->invdate . "'";
         $invqty = "'" . $this->invqty . "'";
         $supdel_date = "'" . $this->supdel_date . "'";
         $paydue_date = "'" . $this->paydue_date . "'";
         $payexp_date = "'" . $this->payexp_date . "'";
         $pick_date = "'" . $this->pick_date . "'";
         $sail_date = "'" . $this->sail_date . "'";
         $eda = "'" . $this->eda . "'";
         $aad = "'" . $this->aad . "'";
         $expclr_date = "'" . $this->expclr_date . "'";
         $cfdel_date = "'" . $this->cfdel_date . "'";
         $link2mtltracker = "'" . $this->link2mtltracker . "'";
         $ffpaydue_date = "'" . $this->ffpaydue_date . "'";
         $ffpayexp_date = "'" . $this->ffpayexp_date . "'";
         $cfpaydue_date = "'" . $this->cfpaydue_date . "'";
         $cfpayexp_date = "'" . $this->cfpayexp_date . "'";

         $packnum = "'" . $this->packnum . "'";
         $bill_lading_num = "'" . $this->bill_lading_num . "'";
         $bil_lading_date = "'" . $this->bil_lading_date . "'";
         $docket_num = "'" . $this->docket_num . "'";
         $boe_num = "'" . $this->boe_num . "'";

       // $sql = "select * from mtl_tracker_li where invnum = $invnum";
       // $result = mysql_query($sql);
       // if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        mtl_tracker_li
                           (recnum,
                            invnum,
                            invdate,
                            invqty,
                            supdel_date,
                            paydue_date,
                            payexp_date,
                            pick_date,
                            sail_date,
                            eda,
                            aad,
                            expclr_date,
                            cfdel_date,
                            link2mtltracker,
                            ffpaydue_date,
                            ffpayexp_date,
                            cfpaydue_date,
                            cfpayexp_date,
                            packnum,
                            bill_lading_num,
                            bill_lading_date,
                            docket_num,
                            boe_num)
                         VALUES
                           ($objid,
                            $invnum,
                            $invdate,
                            $invqty,
                            $supdel_date,
                            $paydue_date,
                            $payexp_date,
                            $pick_date,
                            $sail_date,
                            $eda,
                            $aad,
                            $expclr_date,
                            $cfdel_date,
                            $link2mtltracker,
                            $ffpaydue_date,
                            $ffpayexp_date,
                            $cfpaydue_date,
                            $cfpayexp_date,
                            $packnum,
                            $bill_lading_num,
                            $bil_lading_date,
                            $docket_num,
                            $boe_num)";
       // echo $sql;
           $result = mysql_query($sql);

           $sql = 'commit';
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to mtl_tracker_li didn't work..Please report to Sysadmin. " . mysql_error());
      //   }
   // else {
   //         echo "<table border=1><tr><td><font color=#FF0000>";
   //         die("invnum " . $invnum . " already exists. ");
  //       }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'mtl_tracker_li'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
        //echo " <br>objid: $objid<br>";
         return $objid;
     }
     
     
     function addact_log($ponum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'mtl_act_log' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        //echo $objid;

         $ldate = "'" . date("y-m-d") . "'";
         $userid = "'" . $this->userid . "'";
         $usertype = "'" . $this->usertype . "'";
         $description = "'" . $this->description . "'";
         $link2mtltrk = "'". $ponum . "'";

        $sql = "select * from mtl_act_log where recnum = $objid";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        mtl_act_log
                           (recnum,
                            ldate,
                            userid,
                            usertype,
                            description,
                            link2mtltrk)
                         VALUES
                           ($objid,
                            $ldate,
                            $userid,
                            $usertype,
                            $description,
                            $link2mtltrk)";
        //echo $sql;
           $result = mysql_query($sql);

           $sql = 'commit';
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to mtl_act_log didn't work..Please report to Sysadmin. " . mysql_error());
         }
    else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("recnum " . $objid . " already exists. ");
         }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'mtl_act_log'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
        //echo " <br>objid: $objid<br>";
         return $objid;
     }
     
     function getact_logs($ponum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();


           $sql= "select a.recnum, a.ldate, a.userid , a.usertype,
		                 a.description, a.link2mtltrk
                    from mtl_act_log a, mtl_tracker m,
					     po p
				    where p.ponum = m.ponum and
					      a.link2mtltrk = p.recnum and
						  p.recnum = $ponum
				  ";

        // echo $sql;exit;
        $result = mysql_query($sql);
        return $result;
     }
     
     function updateadvqty($ponum, $partnum) {
     
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $adv_license_qty = "'" . $this->adv_license_qty . "'";
       
       $sql="update mtl_tracker set adv_license_qty = $adv_license_qty where ponum = '$ponum'
                        and partnum = '$partnum'";
       // echo $sql;
       $result = mysql_query($sql);
       return $result;     
     }

    function getmtltrks4vend($userid,$cond) 
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
        $siteval= "p.siteid ='".$siteid."'";
       $sql= "select p.recnum, p.ponum,li.material_ref,
                                  li.no_of_lengths, c.name, li.no_of_meterages,
								  p.podate,li.accepted_date,datediff(curdate(),p.podate),
								  li.line_num,li.duedate,li.due_date1,li.due_date2,
								  li.order_qty,li.qty_recd,li.status,mli.bill_lading_date
                       from  po p, contact co, user u, company c,
					         po_line_items li
                       left join mtl_tracker_li mli on mli.link2mtltracker = li.recnum
                       where
                             li.link2po = p.recnum and
                             c.recnum = p.link2vendor and
                             u.user2contact = co.recnum and
                             co.contact2company = c.recnum and
                             u.userid = '$userid' and
                             (p.approvaldate !='0000-00-00' && p.approvaldate !='') and
                             p.approval = 'yes' and
                             p.status = 'open' and
						                 $cond 
                       order by p.ponum,(li.line_num+0)";
      	   // echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
	     function getmtltrks4vend4disp($userid,$cond) 
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
        $siteval = "p.siteid = '".$siteid."'";

       $sql= "select p.recnum, p.ponum,li.material_ref,
                                  li.no_of_lengths, c.name, li.no_of_meterages,
								  p.podate,li.accepted_date,datediff(curdate(),p.podate),
								  li.line_num,li.duedate,li.due_date1,li.due_date2,
								  li.order_qty,li.qty_recd
                       from po_line_items li, po p, contact co, user u, company c
                       where
                             li.link2po = p.recnum and
                             c.recnum = p.link2vendor and
                          u.user2contact = co.recnum and
                          co.contact2company = c.recnum and
                          u.userid = '$userid' and
                          (p.approvaldate !='0000-00-00' && p.approvaldate !='') and
                          p.approval = 'yes' and p.status = 'open' and
						  $cond 
                       order by p.ponum,(li.line_num+0) limit 1";
    // echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
     
     function getmtltrks($userid,$cond) 
	 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
        $siteval = "p.siteid ='".$siteid."'";
           $sql= "select  p.recnum, p.ponum,li.material_ref,
                                  li.no_of_lengths, c.name, li.no_of_meterages,
								  p.podate,li.accepted_date,datediff(curdate(),p.podate),
								  li.line_num,li.duedate,li.due_date1,li.due_date2,
								  li.order_qty,li.qty_recd,
								  li.status,mli.bill_lading_date,li.crn
                       from  po p,company c,
                       po_line_items li
                       left join mtl_tracker_li mli on mli.link2mtltracker = li.recnum

                         where li.link2po = p.recnum and
                             c.recnum = p.link2vendor and
                             (p.approvaldate !='0000-00-00' && p.approvaldate !='') and
                             p.approval = 'yes' and
                             p.status = 'open' and                      
							          $cond and $siteval                   
                       order by p.ponum,li.line_num";
          // echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
	 function getmtltrks4disp($userid,$cond) 
	 {
        //left join mtl_tracker_li mli on mli.link2mtltracker = li.recnum
    // p.status ='Open' and
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
        $siteval = "p.siteid = '".$siteid."'";

           $sql= "select p.recnum, p.ponum,li.material_ref,
                  li.no_of_lengths, c.name, li.no_of_meterages,
								  p.podate,li.accepted_date,datediff(curdate(),p.podate),
								  li.line_num,li.duedate,li.due_date1,li.due_date2,
								  li.order_qty,li.qty_recd
                  from po_line_items li, company c, po p
                   where
                   li.link2po = p.recnum and
                   c.recnum = p.link2vendor and
							     $cond and $siteval
                   order by p.ponum,li.line_num limit 1";
        // echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
     

     function getmtltrk_details($inpponum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $ponum = "'" . $inpponum . "'";

           $sql= "select po.recnum, po.ponum, po.link2vendor,
                         c.name, c.city, c.state, c.country, c.zipcode, c.phone,
						 po.podate
                    from po po,company c
                    where c.recnum = po.link2vendor and
                          po.recnum=$ponum";

      // echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
     
      function getmtltrk_li($inpponum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $ponum = $inpponum;
       //echo $ponum;
           $sql= "select mli.recnum, mli.invnum, mli.invdate, mli.invqty,
                         date_format(mli.supdel_date,'%d %b %Y'),
                         date_format(mli.paydue_date,'%d %b %Y'), date_format(mli.payexp_date,'%d %b %Y'),
                         date_format(mli.pick_date,'%d %b %Y'), 
                         date_format(mli.sail_date,'%d %b %Y'), date_format(mli.eda,'%d %b %Y'),
                         date_format(mli.aad,'%d %b %Y'), 
                         date_format(mli.expclr_date,'%d %b %Y'), date_format(mli.cfdel_date,'%d %b %Y'),
                         mli.link2mtltracker,
                         po.ponum, m.item_name, m.no_of_meterages, m.recnum, m.no_of_lengths,
                         date_format(mli.ffpaydue_date,'%d %b %Y'),date_format(mli.ffpayexp_date,'%d %b %Y'),
                          mli.cfpaydue_date,
                         date_format(mli.cfpayexp_date,'%d %b %Y'),
                         date_format(m.duedate,'%d %b %Y'),
                         m.line_num,
                         packnum,
                         bill_lading_num,
                          bill_lading_date,
                         docket_num,
                         boe_num, m.material_spec,
            						 m.accepted_date,
            						 m.delv_by,
            						 m.qty_recd,
            						 m.qty_rej,
            						 m.crn,
            						 mli.credit_note_no,
            						 po.status,
            						 po.remarks
                    from po po, po_line_items m
                    left join mtl_tracker_li mli on  mli.link2mtltracker = m.recnum
                    where
                         m.link2po = po.recnum and
                         m.link2po = $ponum
                         order by m.recnum";


          // echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
     
     function getmtltrk_li_row($inpponum,$lirecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $ponum = $inpponum;
       //echo $ponum;
           $sql= "select mli.recnum, mli.invnum, date_format(mli.invdate,'%d %b %Y'), mli.invqty,
                         date_format(mli.supdel_date,'%d %b %Y'),
                         date_format(mli.paydue_date,'%d %b %Y'), date_format(mli.payexp_date,'%d %b %Y'),
                         date_format(mli.pick_date,'%d %b %Y'),
                         date_format(mli.sail_date,'%d %b %Y'), date_format(mli.eda,'%d %b %Y'),
                         date_format(mli.aad,'%d %b %Y'),
                         date_format(mli.expclr_date,'%d %b %Y'), date_format(mli.cfdel_date,'%d %b %Y'),
                         mli.link2mtltracker,
                         po.ponum, m.item_name, m.no_of_meterages, m.recnum, m.no_of_meterages,
                         date_format(mli.ffpaydue_date,'%d %b %Y'),date_format(mli.ffpayexp_date,'%d %b %Y'),
                         date_format(mli.cfpaydue_date,'%d %b %Y'),
                         date_format(mli.cfpayexp_date,'%d %b %Y'),
                         date_format(m.duedate,'%d %b %Y'),
                         m.line_num,
                         packnum,
                         bill_lading_num,
                         date_format(bill_lading_date,'%d %b %Y'),
                         docket_num,
                         boe_num

                    from po_line_items m, po po
                         left join mtl_tracker_li mli on  mli.link2mtltracker = m.recnum
                    where
                         m.link2po = po.recnum and
                         m.link2po = $ponum and
                         mli.recnum = $lirecnum
                          order by m.line_num";


       //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }     

     function updateLI($recnum) 
	 {
         $newlogin = new userlogin;
         $newlogin->dbconnect();

         $invnum = "'" . $this->invnum . "'";
         $invdate = "'" . $this->invdate . "'";
         $invqty = "'" . $this->invqty . "'";
         $supdel_date = "'" . $this->supdel_date . "'";
         $paydue_date = "'" . $this->paydue_date . "'";
         $payexp_date = "'" . $this->payexp_date . "'";
         $pick_date = "'" . $this->pick_date . "'";
         $sail_date = "'" . $this->sail_date . "'";
         $eda = "'" . $this->eda . "'";
         $aad = "'" . $this->aad . "'";
         $expclr_date = "'" . $this->expclr_date . "'";
         $cfdel_date = "'" . $this->cfdel_date . "'";
         $ffpaydue_date = "'" . $this->ffpaydue_date . "'";
         $ffpayexp_date = "'" . $this->ffpayexp_date . "'";
         $cfpaydue_date = "'" . $this->cfpaydue_date . "'";
         $cfpayexp_date = "'" . $this->cfpayexp_date . "'";
         
         $packnum = "'" . $this->packnum . "'";
         $bill_lading_num = "'" . $this->bill_lading_num . "'";
         $bil_lading_date = "'" . $this->bil_lading_date . "'";
         $docket_num = "'" . $this->docket_num . "'";
         $boe_num = "'" . $this->boe_num . "'";
		 $recd_date = "'" . $this->recd_date . "'";
		 $credit_note=$this->credit_note;



        //$sql = "select date_format($invdate,'%d %b %y') from mtl_tracker_li";
        
       $sql = "UPDATE mtl_tracker_li SET
                     invnum=$invnum,
                     invdate=$invdate,
                     invqty=$invqty,
                     supdel_date=$supdel_date,
                     paydue_date=$paydue_date,
                     payexp_date=$payexp_date,
                     pick_date=$pick_date,
                     sail_date=$sail_date,
                     eda=$eda,
                     aad=$aad,
                     expclr_date=$expclr_date,
                     cfdel_date=$cfdel_date,
                     ffpaydue_date=$ffpaydue_date,
                     ffpayexp_date=$ffpayexp_date,
                     cfpaydue_date=$cfpaydue_date,
                     cfpayexp_date=$cfpayexp_date,
                     packnum=$packnum,
                     bill_lading_num=$bill_lading_num,
                     bill_lading_date=$bil_lading_date,
                     docket_num=$docket_num,
                     boe_num=$boe_num,
					 recd_date=$recd_date,
					 credit_note_no='$credit_note'
        	   WHERE
                    recnum = $recnum ";
        // echo $sql. '<br>';
        $result = mysql_query($sql);
        $sql = 'commit';
        $result1 = mysql_query($sql);
        if(!$result1) die("final_insp_report update failed...Please report to SysAdmin. " . mysql_error());
        }
	 function getpo_linetems($ponum) 
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();

           $sql= "select li.recnum,li.line_num,li.duedate,li.due_date1,li.due_date2,li.accepted_date
                       from po_line_items li, company c, po p
                       where
                             li.link2po = p.recnum and
                             c.recnum = p.link2vendor and
							 p.recnum='$ponum'
                       order by p.ponum,li.line_num";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
    }
	 function getpo_linetems4chart($ponum) 
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();

           $sql= "select li.recnum,
		                      li.line_num,
							  li.duedate,
							  li.due_date1,
							  li.due_date2,
							  li.accepted_date,
		                      li.order_qty,
							  li.qty_recd
                       from po_line_items li, company c, po p
                       where
                             li.link2po = p.recnum and
                             c.recnum = p.link2vendor and
							 p.recnum='$ponum' and
							 (accepted_date !='0000-00-00' && accepted_date !='')
                       order by p.ponum,li.line_num";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
    }
	function getncDetails($supplier) 
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql= "select recnum,
		               refnum,
		               date,
      					   supplier,
      					   rm_po_num,
      					   receipt_date,
      					   invoice_num,
      					   bol_num,
      					   cofcnum,
      					   qty,
      					   status,
                   due_date,
                   root_cause,
                   corrective_action,
                   preventive_action,
                   supplier_answer
		from nc4stores where supplier = '$supplier'
		order by  date";
        // echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
	 function getnc($ln,$po,$su)
	 {
		    $su;
			$newlogin = new userlogin;
			$newlogin->dbconnect();
			if(isset($_SESSION['supplier']))
				$sup=$_SESSION['supplier'];
			else
				$sup=$su;
			$query="select nc.refnum,nc.qty
					from  po_line_items poli, po po, nc4stores nc
					where po.recnum=poli.link2po and
						  poli.grn_num=nc.grnnum and
						  poli.line_num='$ln' and
						  po.ponum='$po' and
						  nc.supplier='$sup'
						  ";
              // echo $query;
			$re=mysql_query($query);
			$rowx=mysql_fetch_array($re);
			return $rowx;

	 }
	 function getQuar($ponum,$line)
	{
			$qry="select *from grn where cimponum='$ponum' and
			rmpolinenum=$line and
			grntype='Quarantined'";

			$stat=mysql_query($qry);
			$flg=0;
			if($rw=mysql_fetch_array($stat))
			{
				
				
					$flg=1;
				
			}
			return flag;
	}
	function getLi($recnum)
	{
		$query="select * from mtl_tracker_li WHERE
                    recnum = $recnum";
		$res=mysql_query($query);
		return $res;
	}


  function get_first_nc($supplier){
      $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql= "select 
                   date              
              from nc4stores where supplier =  '$supplier'
              order by  recnum asc limit 1";
        // echo $sql;
        $result = mysql_query($sql);
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);

        return $row;
  }

  function addponotes($porecnum,$ponotes)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        //Connect to database
        $userid = $_SESSION['user'];
        $link2user = "'" . $userid . "'";

        $ponotes = "'" . $ponotes . "'";
        $sql = "INSERT INTO po_notes (ponotes,link2po,create_date,modified_date,link2user)
               VALUES ($ponotes,$porecnum,now(),now(),$link2user)";
        //echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Insert of PO Notes didn't work. " . mysql_error());
  }

  function get_sup_id($supp_name){
    $newlogin = new userlogin;
    $newlogin->dbconnect();

    $sql = "select recnum from company where name='$supp_name'";
    //  echo $sql;
    $result = mysql_query($sql);
     if(!$result) die("Get Supplier  didn't work. " . mysql_error());
     $row=mysql_fetch_row($result);
       return $row[0];
}


  function add_supplier_notes($porecnum,$suppliernotes,$supp_id)
  {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        //Connect to database
        $userid = $_SESSION['user'];
        $link2user = "'" . $userid . "'";
        $supp_id = "'" . $supp_id . "'";

        $suppliernotes = "'" . $suppliernotes . "'";
        $sql = "INSERT INTO mtl_supplier_notes (suppliernotes,link2po,create_date,modified_date,link2user,link2supplier)
               VALUES ($suppliernotes,$porecnum,now(),now(),$link2user,$supp_id)";
        //echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Insert of PO Notes didn't work. " . mysql_error());
  }


   function get_mtl_supplier_notes($recnum)
     {
        //Connect to database
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select mtl.suppliernotes, DATE_ADD(mtl.create_date, INTERVAL '13:00' HOUR_MINUTE),u.userid
                        
                from mtl_supplier_notes mtl, user u
                where link2po=$recnum and
                      u.userid = mtl.link2user
                order by mtl.create_date";
         // echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Get PO Notes didn't work. " . mysql_error());
       return $result;
}

  function getNotes($recnum)
     {

        //Connect to database
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select po.ponotes, DATE_ADD(po.create_date, INTERVAL '13:00' HOUR_MINUTE),
                        u.userid
                from po_notes po, user u
                where link2po=$recnum and
                      u.userid = po.link2user
                order by po.create_date";
         // echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Get PO Notes didn't work. " . mysql_error());
       return $result;
}



  

} // End quoteclass definition
