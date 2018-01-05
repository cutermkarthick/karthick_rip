<?
//====================================
// Author: FSI
// Date-written = July 12, 2006
// Filename: opportunityClass.php
// Maintains the class for Sales
// Revision: v1.0
//====================================

include_once('loginClass.php');

class opportunity {

    var
        $recnum,
        $oppnum,
        $leadsnum,
        $opp_name,
        $acc_name,
        $expected_close_date,
        $sales_stage,
        $type,
        $link2lead,
        $amount_currency,
        $assigned_to,
        $probability,
        $next_step,
        $link2salesnotes,
        $lead_source,
        $currency,
        $create_date,
        $opp_stagenum,
        $proposal_date,
        $negotiate_date;

    // Constructor definition
    function opportunity() {
        $this->recnum = '';
        $this->leadsnum = '';
        $this->oppnum = '';
        $this->opp_name = '';
        $this->acc_name = '';
        $this->expected_close_date = '';
        $this->sales_stage = '';
        $this->type = '';
        $this->link2lead = '';
        $this->amount_currency = '';
        $this->assigned_to = '';
        $this->probability = '';
        $this->next_step = '';
        $this->link2salesnotes = '';
        $this->lead_source = '';
        $this->create_date= '';
        $this->currency= '';
        $this->opp_stagenum='';
        $this->proposal_date='';
        $this->negotiate_date='';
    }

    // Property get and set

   function getrecnum() {
           return $this->getrecnum;
    }

    function setrecnum ($req_recnum) {
           $this->recnum = $req_recnum;
    }
    function getleadsnum() {
           return $this->getleadsnum;
    }

    function setleadsnum ($req_leadsnum) {
           $this->leadsnum = $req_leadsnum;
    }
    function getoppnum() {
           return $this->getoppnum;
    }

    function setoppnum ($req_oppnum) {
           $this->oppnum = $req_oppnum;
    }

    function getcreate_date() {
           return $this->create_date;
    }

    function setcreate_date ($req_create_date) {
           $this->create_date = $req_create_date;
    }
    function getopp_name() {
           return $this->opp_name;
    }

    function setopp_name ($req_opp_name) {
           $this->opp_name = $req_opp_name;
    }

    function getacc_name() {
           return $this->acc_name;
    }

    function setacc_name ($reqacc_name) {
           $this->acc_name = $reqacc_name;
    }

    function getexpected_close_date() {
           return $this->expected_close_date ;
    }

    function setexpected_close_date($reqexpected_close_date) {
           $this->expected_close_date = $reqexpected_close_date;
    }

    function getsales_stage() {
           return $this->sales_stage;
    }

    function setsales_stage ($reqsales_stage) {
           $this->sales_stage= $reqsales_stage;
    }

    function gettype() {
           return $this->type;
    }

    function settype ($reqtype) {
           $this->type = $reqtype;
    }

    function getlink2lead() {
           return $this->link2lead;
    }

    function setlink2lead ($link2lead) {
           $this->link2lead = $link2lead;
    }
    function getamount_currency() {
           return $this->amount_currency;
    }

    function setamount_currency ($reqamount_currency) {
           $this->amount_currency= $reqamount_currency;
    }
    function getassigned_to() {
           return $this->assigned_to;
    }

    function setassigned_to ($assigned_to) {
           $this->assigned_to= $assigned_to;
    }
    function getprobability() {
           return $this->probability;
    }

    function setprobability($probability) {
           $this->probability = $probability;
    }
    function getnext_step() {
           return $this->next_step;
    }

    function setnext_step ($next_step) {
           $this->next_step = $next_step;
    }

    function getlink2salesnotes() {
           return $this->link2salesnotes;
    }

    function setlink2salesnotes($link2salesnotes) {
           $this->link2salesnotes = $link2salesnotes;
    }
   function getlead_source() {
           return $this->lead_source;
    }

    function setlead_source($lead_source) {
           $this->lead_source = $lead_source;
    }

    function getcurrency() {
           return $this->currency;
    }

    function setcurrency ($reqcurrency) {
           $this->currency= $reqcurrency;
    }
    function getoppstagenum() {
           return $this->opp_stagenum;
    }

    function setoppstagenum ($opp_stagenum) {
           $this->opp_stagenum= $opp_stagenum;
    }
    function getproposaldate() {
           return $this->proposal_date;
    }

    function setproposaldate ($proposal_date) {
           $this->proposal_date= $proposal_date;
    }
    function getnegotiatedate() {
           return $this->negotiate_date;
    }

    function setnegotiatedate ($negotiate_date) {
           $this->negotiate_date= $negotiate_date;
    }

     function addOpportunity() {
       //echo "I am here";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'sales_opportunity' for update";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result)
            {
              //header("Location:errorMessage.php?validate=Opp1" );
              die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
            }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $oppnum = "'" . $this->oppnum . "'";
        $leadsnum = "'" . $this->leadsnum . "'";
        $create_date = "'" . $this->create_date . "'";
        //$create_date = "'" . date("y-m-d") . "'";
        $opp_name = "'" . $this->opp_name . "'";
        $acc_name = "'" . $this->acc_name . "'";
        $expected_close_date = "'" . $this->expected_close_date . "'";
        $sales_stage = "'" . $this->sales_stage . "'";
        $type= "'" . $this->type . "'";
        $link2lead = "'" . $this->link2lead . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $amount_currency = "'" . $this->amount_currency . "'";
        $currency = "'" . $this->currency . "'";
        $assigned_to="'" . $this->assigned_to . "'";
        $probability = "'" . $this->probability . "'";
        $next_step = "'" . $this->next_step . "'";
        $link2salesnotes = "'" . $this->link2salesnotes . "'";
        $lead_source = "'" . $this->lead_source . "'";
        $opp_stagenum ="'" . $this->opp_stagenum . "'";
        $proposal_date ="'" . $this->proposal_date . "'";
        $negotiate_date ="'" . $this->negotiate_date . "'";
        $sql = "select * from sales_opportunity where opp_name = $opp_name";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {

           $sql = "INSERT INTO
                        sales_opportunity
                            (
                           recnum,
                           leadsnum,
                           oppnum,
                           opp_name,
                           acc_name,
                           expected_close_date,
                           sales_stage,
                           type,
                           link2lead,
                           amount_currency,
                           assigned_to,
                           probability,
                           next_step,
                           link2salesnotes,
                           lead_source,
                           create_date,
                           currency,
                           opp_stagenum,
                           proposal_date,
                           negotiate_date
                            )
                    VALUES
                            ($objid,
                             $leadsnum,
                             $oppnum,
                             $opp_name,
                             $acc_name,
                             $expected_close_date,
                             $sales_stage,
                             $type,
                             $link2lead,
                             $amount_currency,
                             $assigned_to,
                             $probability,
                             $next_step,
                             $link2salesnotes,
                             $lead_source,
                             $create_date,
                             $currency,
                             $opp_stagenum,
                             $proposal_date,
                             $negotiate_date)";
// echo $sql;exit;
         $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                {
                //header("Location:errorMessage.php?validate=Opp2" );
                die("Insert to opportunity didn't work..Please report to Sysadmin. " . mysql_error());
                }
         }
         else {
                   echo "<table border=1><tr><td><font color=#FF0000>";
                  die("Opportunity Name " . $opp_name . " already exists. ");
                  echo "</td></tr></table>";
                
              }

       $sql = "update seqnum set nxtnum = $objid where tablename = 'sales_opportunity'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result)
           {
           //header("Location:errorMessage.php?validate=Opp4" );
           die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
           }
//echo " <br>objid: $objid<br>";
return $objid;
     }

     function getOpportunity() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT
                  recnum,
                  opp_name,
                  acc_name,
                  expected_close_date,
                  sales_stage,
                  type,
                  link2lead,
                  amount_currency,
                  assigned_to,
                  probability,
                  next_step,
                  link2salesnotes,
                  lead_source,
                  create_date,
                  currency,
                  leadsnum,
                  oppnum
                FROM sales_opportunity";
          // echo "$sql";
        $result = mysql_query($sql);
        return $result;

     }
     function getOpp($opportunityrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select
                    recnum,
                    opp_name,
                    acc_name,
                    expected_close_date,
                    sales_stage,
                    type,
                    link2lead,
                    amount_currency,
                    assigned_to,
                    probability,
                    next_step,
                    link2salesnotes,
                    lead_source,
                    create_date,
                    currency,
                    leadsnum,
                    oppnum,
                    proposal_date,
                    negotiate_date
                FROM `sales_opportunity`
                  where  sales_opportunity.recnum = $opportunityrecnum";

                  // echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

     function updateOpportunity($opportunityrecnum) {
        $recnum=$opportunityrecnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $opp_name = "'" . $this->opp_name . "'";
        $acc_name = "'" . $this->acc_name . "'";
        $expected_close_date = "'" . $this->expected_close_date . "'";
        $sales_stage = "'" . $this->sales_stage . "'";
        $type = "'" . $this->type . "'";
        $link2lead = "'" . $this->link2lead . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $amount_currency = "'" . $this->amount_currency . "'";
        $currency = "'" . $this->currency . "'";
        $assigned_to = "'" . $this->assigned_to . "'";
        $probability=$this->probability;
        $next_step = "'" . $this->next_step . "'";
        $link2salesnotes = "'" . $this->link2salesnotes . "'";
        $lead_source = "'" . $this->lead_source . "'";
        $create_date = "'" . $this->create_date . "'";
        $leadsnum = "'" . $this->leadsnum . "'";
        $oppnum = "'" . $this->oppnum . "'";
        $opp_stagenum="'" . $this->opp_stagenum . "'";
        $proposal_date ="'" . $this->proposal_date . "'";
        $negotiate_date ="'" . $this->negotiate_date . "'";

        $sql = "UPDATE sales_opportunity SET
                    recnum= $recnum,
                    opp_name = $opp_name,
                    acc_name = $acc_name,
                    expected_close_date = $expected_close_date,
            	    sales_stage=$sales_stage,
            	    type =$type ,
            	    link2lead =$link2lead ,
            	    amount_currency=$amount_currency,
            	    currency=$currency,
            	    assigned_to=$assigned_to,
                    probability = $probability ,
            	    next_step=$next_step,
                    link2salesnotes= $link2salesnotes ,
                    lead_source=$lead_source,
                    create_date=$create_date,
                    leadsnum=$leadsnum,
                    oppnum=$oppnum,
                    opp_stagenum=$opp_stagenum,
                    proposal_date=$proposal_date,
                    negotiate_date=$negotiate_date

        	WHERE
                    recnum = $opportunityrecnum ";
                    //echo $sql; exit;
        $result = mysql_query($sql);
        if(!$result) die("Opportunity update failed...Please report to SysAdmin. " . mysql_error());
        }

     function deleteOpportunity($opportunityrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from sales_opportunity where recnum = $opportunityrecnum";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Opportunity failed...Please report to SysAdmin. " . mysql_error());
      }



 //Function for search/sort coded by Jerry George 30 Dec -04
function getAccounts($cond,$argsort1,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;
       $sql = "select
                  recnum,
                  opp_name,
                  acc_name,
                  expected_close_date,
                  sales_stage,

                FROM sales_opportunity
                   where  $wcond ORDER by $sortorder limit $offset, $limit";
//echo "$sql";
       $result = mysql_query($sql);
       return $result;
}

//Function for pagination coded by Jerry George 30 Dec -04
function getoppCount($cond,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
             $sql = "select count(*) as numrows
                     from sales_opportunity where  $wcond limit $offset, $limit";
       $newlogin = new userlogin;
       $newlogin->dbconnect();
//echo "$sql";
$result  = mysql_query($sql) or die('Opportunity count query failed');
$row     = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];
return $numrows;
}

 //-----------------------------------------------------------------------------------------------------------------------------------------------------
function getNotes($inpoprecnum) {
        $userrole = $_SESSION['userrole'];
        $userid = $_SESSION['user'];
        $userrecnum = $_SESSION['userrecnum'];
        $opportunityrecnum = $inpoprecnum;
        $sql = "select n.create_date, n.notes, u.userid
                     from opportunity_notes n, user u, sales_opportunity o
                     where n.notes2opportunity = o.recnum and
                           notes2user = u.recnum and
                           o.recnum = $opportunityrecnum";
        $result = mysql_query($sql);
        return $result;
     }

//---------------------------------------------------------------------------------------------------------------------------------------------------------

    function updNotes($opportunityrecnum,$pagename) {

        $userrole = $_SESSION['userrole'];
        $userid = $_SESSION['user'];
        $usertype = $_SESSION['usertype'];
        if ($usertype == 'EMPL') {
            //echo'<a href="addNotes4opportunity.php?type=' . $pagename . '&opportunityrecnum=' . $opportunityrecnum . '" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'Image118\',\'\',\'images/addnotes_mo.gif\',1)"><img name="Image118" border="0" src="images/addnotes.gif" hspace=4></a>';
            // echo '</td></tr><tr width=100% bgcolor="DEDEDF"><td height="28"><img width="50" src="images/spacer.gif" height="1"><td align="right"><img src="images/box-right-top.gif"></td></td></tr>';
        }
    }

 function addNotes($opportunityrecnum,$notes) {

        // Connect to database
        $create_date = "'" . date("y-m-d") . "'";
        $userid = $_SESSION['user'];
        $userrecnum = $_SESSION['userrecnum'];
        $sql = "select nxtnum from seqnum where tablename = 'opportunity_notes'";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $specinstrns = "'" . $notes . "'";
        $sql = "INSERT INTO opportunity_notes (recnum, notes,notes2opportunity, notes2user,create_date )
               VALUES ($objid, $specinstrns, $opportunityrecnum, $userrecnum, $create_date)";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Insert of Notes didn't work. " . mysql_error());

        $sql = "update seqnum set nxtnum = $objid where tablename = 'opportunity_notes'";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert for notes table didn't work. " . mysql_error());

     }


     function getAllleads()
     {

         $newlogin = new userlogin;
         $newlogin->dbconnect();
 
        $sql = "select recnum,name,company
                       from sales_leads 
                       order by recnum";
        $result = mysql_query($sql);
        return $result;
     }




} // End opportunity class definition