<? 
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: workOrderClass.php
// Maintains the class for ecos
// Revision: v1.0
// Modifications History
// Jan 12, 05 - Modified for WO layer
//              Badari Mandyam
//====================================

include_once('loginClass.php');

class eco { 

    var $recnum, 
        $econum , 
        $doc_date, 
        $sch_due_date,
        $act_complete_date,
        $tester_type,
        $tester_model,
        $our_mistake,
        $cust_chg_req,
        $gerber,
        $schematic,
        $layer,
        $sheet,
        $remake_board,
        $footprint,
        $drawing,
        $eror_desc,
        $short_sol_desc ,
        $short_eng_app,
        $short_appr_date,
        $long_sol_desc ,
        $long_eng_app,
        $long_appr_date;
        

    // Constructor definition 
    function eco() { 
        $this->recnum = ''; 
        $this->econum  = ''; 
        $this->doc_date = ''; 
        $this-> sch_due_date = ''; 
        $this->act_complete_date = ''; 
        $this-> tester_type = '';
        $this->tester_model='';
        $this-> resn_4return = ''; 
        $this->our_mistake = ''; 
        $this->cust_chg_req = '';
        $this->gerber = '';
        $this->schematic = '';
        $this->layer = '';
        $this->sheet = '';
        $this->remake_board = '';
        $this->footprint = '';
        $this->drawing = '';
        $this->eror_desc = '';
        $this->short_sol_desc = '';
        $this->short_eng_app = '';
        $this->short_appr_date = '';
        $this->long_sol_desc = '';
        $this->long_eng_app = '';
        $this->long_appr_date = '';
    } 
     
    // Property get and set
    function geteconum () {
           return $this->econum ;
    }

    function seteconum  ($reqeconum ) {
           $this->econum  = $reqeconum ;
    }

    function getdoc_date() {
           return $this->doc_date;
    }

    function setdoc_date ($reqdoc_date) {
           $this->doc_date = $reqdoc_date;
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
    function getcust_chg_req () {
           return $this->cust_chg_req;
    }

    function setcust_chg_req ($reqcust_chg_req) {
           $this->cust_chg_req = $reqcust_chg_req;
    }


    function gettester_type () {
           return $this-> tester_type;
    }

    function settester_type ($reqtester_type) {
           $this-> tester_type = $reqtester_type;
    }
    function gettester_model() {
           return $this->tester_model;
    }

    function settester_model($reqtester_model) {
           $this->tester_model = $reqtester_model;
    }

    function getomistake() {
           return $this->our_mistake;
    }

    function setomistake ($reqour_mistake) {
           $this->our_mistake = $reqour_mistake;
    }
    function getgerber() {
           return $this->gerber;
    }

    function setgerber($req_gerber) {
           $this->gerber = $req_gerber;
    }

    function getschematic() {
           return $this->schematic;
    }

    function setschematic ($req_schematic) {
           $this->schematic = $req_schematic;
    }

    function getsheet() {
           return $this->sheet;
    }

    function setsheet ($req_sheet) {
           $this->sheet = $req_sheet;
    }
    function getlayer() {
           return $this->layer;
    }

    function setlayer ($layer) {
           $this->layer = $layer;
    }
    function getremake_board() {
           return $this->remake_board ;
    }

    function setremake_board  ($reqremake_board ) {
           $this->remake_board  = $reqremake_board ;
    }


    function getfootprint() {
           return $this->footprint ;
    }

    function setfootprint($reqfootprint ) {
           $this->footprint  = $reqfootprint ;
    }
    function getdrawing  () {
           return $this->drawing ;
    }

    function setdrawing  ($reqdrawing ) {
           $this->drawing  = $reqdrawing ;
    }
    function geterror_desc  () {
           return $this->eror_desc ;
    }

    function seterror_desc  ($reqeror_desc) {
           $this->eror_desc  = $reqeror_desc ;
    }
    function getshort_sol_desc  () {
           return $this->short_sol_desc ;
    }

    function setshort_sol_desc($reqshort_sol_desc ) {
           $this->short_sol_desc  = $reqshort_sol_desc ;
    } 
   function getshort_eng_app  () {
           return $this->short_eng_app ;
    }

    function setshort_eng_app  ($reqshort_eng_app ) {
           $this->short_eng_app  = $reqshort_eng_app ;
    }
   function getshort_appr_date  () {
           return $this->short_appr_date ;
    }

    function setshort_appr_date  ($reqshort_appr_date ) {
           $this->short_appr_date  = $reqshort_appr_date ;
    }
    function getlong_sol_desc  () {
           return $this->long_sol_desc ;
    }

    function setlong_sol_desc($reqlong_sol_desc ) {
           $this->long_sol_desc  = $reqlong_sol_desc ;
    } 
   function getlong_eng_app  () {
           return $this->long_eng_app ;
    }

    function setlong_eng_app  ($reqlong_eng_app ) {
           $this->long_eng_app  = $reqlong_eng_app ;
    }
   function getlong_appr_date  () {
           return $this->long_appr_date ;
    }

    function setlong_appr_date  ($reqlong_appr_date ) {
           $this->long_appr_date  = $reqlong_appr_date ;
    }
    function addeco() { 

        $sql = "select nxtnum from seqnum where tablename = 'eco' for update";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $econum  = "'" . $this->econum  ."'" ;
        $doc_date = "'" . $this->doc_date . "'";
        $sch_due_date =  "'" . $this-> sch_due_date . "'";
        $act_complete_date = "'" . $this->act_complete_date . "'";
        $tester_type =  "'" . $this->tester_type. "'";
        $tester_model =  "'" . $this->tester_model. "'";
        $our_mistake = "'" . $this->our_mistake . "'";
        $cust_chg_req = "'" . $this-> cust_chg_req . "'";
        $gerber= "'" . $this-> gerber . "'";
        $schematic= "'" . $this->schematic . "'";
        $layer = "'" . $this->layer . "'";
        $sheet= "'" . $this->sheet . "'";
        $remake_board = "'" . $this->remake_board . "'";
        $footprint = "'" . $this->footprint . "'";
        $drawing = "'" . $this->drawing . "'";
        $eror_desc = "'" . $this->eror_desc . "'";
        $short_sol_desc  = "'" . $this->short_sol_desc . "'";
        $short_eng_app= "'" . $this->short_eng_app . "'";
        $short_appr_date = "'" . $this->short_appr_date . "'";
        $long_sol_desc  = "'" . $this->long_sol_desc . "'";
        $long_eng_app= "'" . $this->long_eng_app . "'";
        $long_appr_date = "'" . $this->long_appr_date . "'";

        $sql = "select * from eco where econum  = $econum ";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO eco(recnum, econum , doc_date,  sch_due_date, act_complete_date, 
                   tester_type,our_mistake  ,cust_chg_req,gerber, 
                   schematic,layer,sheet,remake_board,footprint,drawing,eror_desc,short_sol_desc,short_eng_app,short_appr_date,long_sol_desc,long_eng_app,long_appr_date,tester_model) 
               VALUES ($objid, $econum ,$doc_date,$sch_due_date,$act_complete_date, 
                       $tester_type,$our_mistake,$cust_chg_req , $gerber, $schematic,$layer,$sheet,$remake_board,
	      $footprint,$drawing,$eror_desc,$short_sol_desc,$short_eng_app,$short_appr_date,
	      $long_sol_desc,$long_eng_app,$long_appr_date,$tester_model)";
         }           
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("eco Number " . $econum  . " already exists. ");
            echo "</td></tr></table>";
         }
//echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked 
        if(!$result) die("Insert of eco failed. " . mysql_error()); 

        $sql = "update seqnum set nxtnum = $objid where tablename = 'eco'";
        $result = mysql_query($sql);
                 
        // Test to make sure query worked 
        if(!$result) die("Seqnum insert for eco didn't work. " . mysql_error()); 
        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for eco Insert..Please report to Sysadmin. " . mysql_error()); 
        return $objid;
     } 

    function updateeco($inpeconum ) { 
        $ecorecnum =$inpeconum  ;
        $doc_date = "'" . $this->doc_date . "'";
        $sch_due_date =  "'" . $this-> sch_due_date . "'";
        $act_complete_date = "'" . $this->act_complete_date . "'";
        $tester_type =  "'" . $this-> tester_type . "'";
        $tester_model =  "'" . $this->tester_model. "'";
        $our_mistake = "'" . $this->our_mistake . "'";
        $cust_chg_req = "'" . $this-> cust_chg_req . "'";
        $gerber=  "'" . $this->gerber . "'";
        $schematic= "'" . $this->schematic . "'";
        $layer = "'" . $this->layer . "'";
        $sheet= "'" . $this->sheet . "'";
        $remake_board = "'" . $this->remake_board . "'";
        $footprint = "'" . $this->footprint . "'";
        $drawing = "'" . $this->drawing . "'";
        $eror_desc = "'" . $this->eror_desc . "'";
        $short_sol_desc  = "'" . $this->short_sol_desc . "'";
        $short_eng_app= "'" . $this->short_eng_app . "'";
        $short_appr_date = "'" . $this->short_appr_date . "'";
        $long_sol_desc  = "'" . $this->long_sol_desc . "'";
        $long_eng_app= "'" . $this->long_eng_app . "'";
        $long_appr_date = "'" . $this->long_appr_date . "'";

        $sql = "update eco set
                                     doc_date = $doc_date,
                                      sch_due_date = $sch_due_date, 
                                      act_complete_date = $act_complete_date, 
                                      tester_type= $tester_type,
                                      tester_model = $tester_model,
                                      our_mistake = $our_mistake,
                                      cust_chg_req = $cust_chg_req , 
                                      schematic = $schematic,
                                      gerber = $gerber,
                                      layer = $layer,
		      sheet= $sheet,
                                      remake_board = $remake_board,
                                      footprint = $footprint,
                                      drawing = $drawing,
                                      eror_desc = $eror_desc,
                                      short_sol_desc= $short_sol_desc,
		      short_eng_app=$short_eng_app,
		      short_appr_date=$short_appr_date,
                                      long_sol_desc= $long_sol_desc,
		      long_eng_app=$long_eng_app,
		     long_appr_date=$long_appr_date
                             where recnum = $ecorecnum";
//echo "</br>$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked 
        if(!$result) die("Update of eco failed..Please report to Sysadmin " . mysql_error()); 

     } 

function getecos($cond,$argsort1,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;
        if($sortorder=='')
        $sortorder="e.econum ";

             $sql = "select e.recnum ,e.econum ,date_format(e.doc_date,'%y-%m-%d'),date_format(e.act_complete_date,'%y-%m-%d'),w.wonum from eco e,work_order w
	where  $wcond and e.tester_type=w.recnum  ORDER by $sortorder limit $offset, $limit"; 
	//echo "$sql";
             $result = mysql_query($sql);
             return $result;
}

function getecocount($cond,$argoffset, $arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
             $sql = "select count(*) as numrows from eco e,work_order w
	where  $wcond and e.tester_type=w.recnum limit $offset, $limit"; 
        $newlogin = new userlogin;
       $newlogin->dbconnect();
//echo "<br>$sql";
$result  = mysql_query($sql) or die('Service Request count query failed'); 
$row     = mysql_fetch_array($result, MYSQL_ASSOC); 
$numrows = $row['numrows']; 
return $numrows;

}

function getecos4prntUpd($argecorecnum)
{
             $ecorecnum=$argecorecnum;
             $sql = "select r.recnum ,r.econum ,date_format(r.doc_date,'%y-%m-%d'),date_format(r.sch_due_date,'%y-%m-%d'),date_format(r.act_complete_date,'%y-%m-%d'),
	r.tester_type,r.tester_model,r.our_mistake,r.cust_chg_req,r. gerber,r.schematic,r.layer,r.sheet,r.remake_board,r.footprint,
	r.drawing,r.eror_desc,r.short_sol_desc,r.short_eng_app,r.short_appr_date,r.long_sol_desc,r.long_eng_app,r.long_appr_date  from eco r where r.recnum=$ecorecnum"; 
	//echo "$sql";
             $result = mysql_query($sql);
             return $result;
}


function getwonum4eco($argworecnum)
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


     function getWorkOrders4eco($username,$cond,$sort1,$sort2,$argoffset,$arglimit) {
        $userid = "'" . $_SESSION['user'] . "'";
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        if ($sort1 == 'wo') {
           $sortorder1 = 'w.econum ';
        }
        if ($sort1 == 'company') {
           $sortorder1 = 'c.name';
        }
        if ($sort2 == 'wo') {
           $sortorder2 = 'w.econum ';
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
        else {$sortorder = 'w.econum ';}
             $sql = "select  distinct w.econum , w.doc_date, c.name, w.po_num,w.quote_num, 
                            w.status,w.condition, w. resn_4return,  emp.fname, emp.lname,
                            w.tester_model, w.recnum, cont.contactid,cont.email
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
     function getWOcount4eco($cond,$argoffset,$arglimit) {
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
