<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: rmaClass.php
// Maintains the class for rmas
// Revision: v1.0 OWT
// Modifications History
// Jan 12, 05 - Modified for WO cost_to_us
//              Badari Mandyam
//====================================

include_once('loginClass.php');

class rma {

    var $recnum,
        $rmaid,
        $received_date,
        $sch_due_date,
        $act_complete_date,
        $reason_for_return,
        $our_mistake,
        $cust_mistake,
        $link2sol,
        $sol_desc,
        $cost_to_us,
        $cost_to_customer,
        $re_quote,
        $re_order,
        $design,
        $mfg,
        $assembly ,
        $corrective_act;

    // Constructor definition
    function rma() {
        $this->recnum = '';
        $this->rmaid = '';
        $this->received_date = '';
        $this-> sch_due_date = '';
        $this->act_complete_date = '';
        $this-> reason_for_return = '';
        $this->our_mistake = '';
        $this-> cust_mistake = '';
        $this->sol_desc = '';
        $this->cost_to_us = '';
        $this->cost_to_customer = '';
        $this->re_quote = '';
        $this->re_order = '';
        $this->design = '';
        $this->mfg = '';
        $this->assembly = '';
        $this->corrective_act = '';
    }

    // Property get and set
    function getrmaid() {
           return $this->rmaid;
    }

    function setrmaid ($reqrmaid) {
           $this->rmaid = $reqrmaid;
    }

    function getreceived_date() {
           return $this->received_date;
    }

    function setreceived_date ($reqreceived_date) {
           $this->received_date = $reqreceived_date;
    }

    function getsch_due_date() {
           return $this-> sch_due_date;
    }

    function setsch_due_date($reqdesc) {
           $this-> sch_due_date = $reqdesc;
    }

    function getact_complete_date () {
           return $this->act_complete_date;
    }

    function setact_complete_date ($reqact_complete_date) {
           $this->act_complete_date = $reqact_complete_date;
    }

    function getomistake() {
           return $this->our_mistake;
    }

    function setomistake ($reqour_mistake) {
           $this->our_mistake = $reqour_mistake;
    }

    function getreason_for_return () {
           return $this-> reason_for_return;
    }

    function setreason_for_return ($reqreason_for_return) {
           $this-> reason_for_return = $reqreason_for_return;
    }
    function getsol_desc() {
           return $this->sol_desc;
    }

    function setsol_desc ($req_sol_desc) {
           $this->sol_desc = $req_sol_desc;
    }

    function setcmistake($reqcust_mistake) {
           $this-> cust_mistake = $reqcust_mistake;
    }
    function gecmistake() {
           return $this->cust_mistake;
    }

    function getcost_to_customer() {
           return $this->cost_to_customer;
    }

    function setcost_to_customer ($req_cost_to_customer) {
           $this->cost_to_customer = $req_cost_to_customer;
    }
    function getcost_to_us() {
           return $this->cost_to_us;
    }

    function setcost_to_us ($cost_to_us) {
           $this->cost_to_us = $cost_to_us;
    }
    function getre_quote() {
           return $this->re_quote ;
    }

    function setre_quote  ($reqre_quote ) {
           $this->re_quote  = $reqre_quote ;
    }


    function getre_order() {
           return $this->re_order ;
    }

    function setre_order($reqre_order ) {
           $this->re_order  = $reqre_order ;
    }
    function getdesign  () {
           return $this->design ;
    }

    function setdesign  ($reqdesign ) {
           $this->design  = $reqdesign ;
    }
    function getmfg  () {
           return $this->mfg ;
    }

    function setmfg  ($reqmfg) {
           $this->mfg  = $reqmfg ;
    }
    function getassembly  () {
           return $this->assembly ;
    }

    function setassembly($reqassembly ) {
           $this->assembly  = $reqassembly ;
    }
   function getcorrective_act  () {
           return $this->corrective_act ;
    }

    function setcorrective_act  ($reqcorrective_act ) {
           $this->corrective_act  = $reqcorrective_act ;
    }


    function addrma() {

        $sql = "select nxtnum from seqnum where tablename = 'rma' for update";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $rmaid = "'" . $this->rmaid ."'" ;
        $received_date = "'" . $this->received_date . "'";
        $sch_due_date =  "'" . $this-> sch_due_date . "'";
        $act_complete_date = "'" . $this->act_complete_date . "'";
        $our_mistake = "'" . $this->our_mistake . "'";
        $cust_mistake = "'" . $this-> cust_mistake . "'";
        $reason_for_return = "'" . $this-> reason_for_return. "'";
        $sol_desc= "'" . $this->sol_desc . "'";
        $cost_to_us = $this->cost_to_us;
        $cost_to_customer= $this->cost_to_customer;
        $re_quote = "'" . $this->re_quote . "'";
        $re_order = "'" . $this->re_order . "'";
        $design = "'" . $this->design . "'";
        $mfg = "'" . $this->mfg . "'";
        $assembly  = "'" . $this->assembly . "'";
        $corrective_act= "'" . $this->corrective_act . "'";
        $sql = "select * from rma where rmaid = $rmaid";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO rma(recnum, rmaid, received_date,  sch_due_date, act_complete_date,
                   our_mistake  ,cust_mistake, reason_for_return ,
                   sol_desc,cost_to_us,cost_to_customer,re_quote,re_order,design,mfg,assembly,corrective_act)
               VALUES ($objid, $rmaid,$received_date,$sch_due_date,$act_complete_date,
                       $our_mistake,$cust_mistake ,$reason_for_return,$sol_desc
                       ,$cost_to_us,$cost_to_customer,$re_quote,$re_order,$design,$mfg,$assembly,$corrective_act)";
         }
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("RMA Number " . $rmaid . " already exists. ");
            echo "</td></tr></table>";
         }
//echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Insert of RMA failed. " . mysql_error());

        $sql = "update seqnum set nxtnum = $objid where tablename = 'rma'";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert for rma didn't work. " . mysql_error());
        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for RMA Insert..Please report to Sysadmin. " . mysql_error());
        return $objid;
     }

    function updaterma($inprmaid) {
        $rmarecnum =$inprmaid ;
        $received_date = "'" . $this->received_date . "'";
        $sch_due_date =  "'" . $this-> sch_due_date . "'";
        $act_complete_date = "'" . $this->act_complete_date . "'";
        $our_mistake = "'" . $this->our_mistake . "'";
        $cust_mistake = "'" . $this-> cust_mistake . "'";
        $reason_for_return = "'" . $this-> reason_for_return. "'";
        $sol_desc= "'" . $this->sol_desc . "'";
        $cost_to_us = $this->cost_to_us;
        $cost_to_customer= $this->cost_to_customer;
        $re_quote = "'" . $this->re_quote . "'";
        $re_order = "'" . $this->re_order . "'";
        $design = "'" . $this->design . "'";
        $mfg = "'" . $this->mfg . "'";
        $assembly  = "'" . $this->assembly . "'";
        $corrective_act= "'" . $this->corrective_act . "'";
        $sql = "update rma set
                                     received_date = $received_date,
                                      sch_due_date = $sch_due_date,
                                      act_complete_date = $act_complete_date,
                                      our_mistake = $our_mistake,
                                      cust_mistake = $cust_mistake ,
                                      reason_for_return  = $reason_for_return ,
                                      sol_desc = $sol_desc,
                                      cost_to_us = $cost_to_us,
		      cost_to_customer= $this->cost_to_customer,
                                      re_quote = $re_quote,
                                      re_order = $re_order,
                                      design = $design,
                                      mfg = $mfg,
                                      assembly= $assembly,
		      corrective_act=$corrective_act
                           where recnum = $rmarecnum";
//echo "</br>$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Update of rma failed..Please report to Sysadmin " . mysql_error());

     }

function getrmas($cond,$argsort1,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;
        if($sortorder=='')
        $sortorder="r.rmaid";

             $sql = "select r.recnum ,r.rmaid,date_format(r.received_date,'%y-%m-%d'),date_format(r.act_complete_date,'%y-%m-%d'),w.wonum,sol.solnum from rma r,work_order w,
	solution sol where  $wcond and r.link2wo=w.recnum and r.link2sol=sol.recnum ORDER by $sortorder limit $offset, $limit";
	//echo "$sql";
             $result = mysql_query($sql);
             return $result;
}

function getrmacount($cond,$argoffset, $arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
             $sql = "select count(*) as numrows from rma r,work_order w,
	solution sol where  $wcond and r.link2wo=w.recnum and r.link2sol=sol.recnum  limit $offset, $limit";
        $newlogin = new userlogin;
       $newlogin->dbconnect();
//echo "$sql";
$result  = mysql_query($sql) or die('Service Request count query failed');
$row     = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];
return $numrows;

}

function getrmas4prntUpd($argrmarecnum)
{
             $rmarecnum=$argrmarecnum;
             $sql = "select r.recnum ,r.rmaid,date_format(r.received_date,'%y-%m-%d'),date_format(r.sch_due_date,'%y-%m-%d'),date_format(r.act_complete_date,'%y-%m-%d'),
	r.reason_for_return,r.our_mistake,r.cust_mistake,r.sol_desc,r.cost_to_us,r.cost_to_customer,r.re_quote,r.re_order,
	r.design,r.mfg,r.assembly,r.corrective_act from rma r where r.recnum=$rmarecnum";
	//echo "$sql";
             $result = mysql_query($sql);
             return $result;
}

function getsolnum4rma($argsolrecnum)
{
   $solrecnum=$argsolrecnum;
             $sql = "select  solnum from solution where recnum=$solrecnum";
	//echo "$sql";
             $result = mysql_query($sql);
             return $result;
}


function getwonum4rma($argworecnum)
{
   $worecnum=$argworecnum;
             $sql = "select  distinct w.wonum, c.name,cont.fname,cont.lname,cont.email, emp.fname, emp.lname,
                           emp.email
                       from work_order w, company c, contact cont, employee emp
                       where w.recnum= $worecnum and
                             w.wo2customer = c.recnum and
                             w.wo2contact = cont.recnum and
                                w.wo2employee = emp.recnum and
                             w.condition = 'Open'";
//echo "<br>$sql";
             $result = mysql_query($sql);
             return $result;
}


     function getWorkOrders4rma($username,$cond,$sort1,$sort2,$argoffset,$arglimit) {
        $userid = "'" . $_SESSION['user'] . "'";
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        if ($sort1 == 'wo') {
           $sortorder1 = 'w.rmaid';
        }
        if ($sort1 == 'company') {
           $sortorder1 = 'c.name';
        }
        if ($sort2 == 'wo') {
           $sortorder2 = 'w.rmaid';
        }
        if ($sort2 == 'company') {
           $sortorder2 = 'c.name';
        }
        if ($sort1 != '' && $sort2 != '') {
            $sortorder = $sortorder1 . "," . $sortorder2;
        }
        else if ($sort1 != '') {
            $sortorder = $sortorder1;
        }
        else if ($sort2 != '') {
            $sortorder = $sortorder2;
        }
        else {$sortorder = 'w.rmaid';}
             $sql = "select  distinct w.rmaid, w.received_date, c.name, w.po_num,w.quote_num,
                            w.status,w.condition, w. reason_for_return,  emp.fname, emp.lname,
                            w.create_date, w.recnum, cont.contactid,cont.email
                       from work_order w, company c, contact cont, employee emp
                       where
                             w.  = c.recnum and
                             w.  = cont.recnum and
                                w.our_mistake = emp.recnum and
                             w.condition = 'Open' and
                             (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = '')
                             ORDER by $sortorder limit $offset, $limit";
//echo "$sql";
        $result = mysql_query($sql);
        return $result;

     }
     function getWOcount4rma($cond,$argoffset,$arglimit) {
        $userid = "'" . $_SESSION['user'] . "'";
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
   $sql = "select count(*) as numrows
                       from work_order w, company c, contact cont, user u, employee emp
                       where
                             w.  = c.recnum and
                             cont.contact2company = w.  and
                             u.user2contact = cont.recnum and

                             w.our_mistake = emp.recnum and
                             w.condition = 'Open' and
                             (w.actual_ship_date is NULL || w.actual_ship_date = '0000-00-00' || w.actual_ship_date = '')";
$result  = mysql_query($sql) or die('WO count query failed');
$row     = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];

        return $numrows;

     }

} // End work order class definition