<?
//====================================
// Author: FSI
// Date-written = July 05, 2006
// Filename: leadsClass.php
// Maintains the class for Leads
// Revision: v1.0  OWT
//====================================

include_once('loginClass.php');

class leads {

    var
        $recnum,
        $oppnum,
        $leadsnum,
        $source,
        $name,
        $title,
        $phone,
        $email,
        $company,
        $industry_segment,
        $product_interest,
        $primary_lead,
        $rating,
        $comments,
        $createDate,
        $convert2contact,
        $addr1,
        $addr2,
        $city,
        $state,
        $zip,
        $country,
        $stage,
        $percent,
        $stagenum,
        $contacted_date,
        $meeting_date;

    // Constructor definition
    function leads() {
        $this->recnum = '';
        $this->leadsnum = '';
        $this->oppnum = '';
        $this->source = '';
        $this->name = '';
        $this->title = '';
        $this->phone = '';
        $this->email = '';
        $this->company = '';
        $this->industry_segment = '';
        $this->product_interest = '';
        $this->primary_lead = '';
        $this->rating = '';
        $this->comments = '';
        $this->createDate= '';
        $this->addr1 = '';
        $this->addr2 = '';
        $this->city = '';
        $this->state = '';
        $this->zip = '';
        $this->country = '';
        $this->convert2contact = '';
        $this->stage = '';
        $this->percent = '';
        $this->stagenum='';
        $this->contacted_date='';
        $this->meeting_date='';
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

    function getcreatedate() {
           return $this->createDate;
    }

    function setcreatedate ($req_createdate) {
           $this->createDate = $req_createdate;
    }
    function getname() {
           return $this->name;
    }

    function setname ($req_name) {
           $this->name = $req_name;
    }

    function getsource() {
           return $this->source;
    }

    function setsource ($reqsource) {
           $this->source = $reqsource;
    }

    function gettitle() {
           return $this->title;
    }

    function settitle ($reqtitle) {
           $this->title = $reqtitle;
    }

    function getphone() {
           return $this->phone;
    }

    function setphone ($reqphone) {
           $this->phone = $reqphone;
    }

    function getemail() {
           return $this->email;
    }

    function setemail ($reqemail) {
           $this->email = $reqemail;
    }

    function getcompany() {
           return $this->company;
    }

    function setcompany ($company) {
           $this->company = $company;
    }
    function getindustry_segment() {
           return $this->industry_segment;
    }

    function setindustry_segment ($reqindustry_segment) {
           $this->industry_segment= $reqindustry_segment;
    }
    function getproduct_interest() {
           return $this->product_interest;
    }

    function setproduct_interest ($product_interest) {
           $this->product_interest= $product_interest;
    }
    function getprimary_lead() {
           return $this->primary_lead;
    }

    function setprimary_lead ($primary_lead) {
           $this->primary_lead = $primary_lead;
    }
    function getrating() {
           return $this->rating;
    }

    function setrating ($rating) {
           $this->rating = $rating;
    }

    function getcomments() {
           return $this->comments;
    }

    function setcomments ($comments) {
           $this->comments = $comments;
    }

    function getconvert2contact() {
           return $this->convert2contact;
    }

    function setconvert2contact ($convert2contact) {
           $this->convert2contact = $convert2contact;
    }

  function getaddr1() {
           return $this->addr1;
    }

    function setaddr1 ($reqaddr1) {
           $this->addr1 = $reqaddr1;
    }
    function getaddr2() {
           return $this->addr2;
    }

    function setaddr2 ($reqaddr2) {
           $this->addr2 = $reqaddr2;
    }
    function getcity() {
           return $this->city;
    }

    function setcity ($reqcity) {
           $this->city = $reqcity;
    }
    function getstate() {
           return $this->state;
    }

    function setstate ($reqstate) {
           $this->state = $reqstate;
    }
    function getzip() {
           return $this->zip;
    }

    function setzip ($reqzip) {
           $this->zip = $reqzip;
    }
    function getcountry() {
           return $this->country;
    }

    function setcountry ($reqcountry) {
           $this->country = $reqcountry;
    }
     function getstage() {
           return $this->stage;
    }

    function setstage ($reqstage) {
           $this->stage = $reqstage;
    }

     function getpercent() {
           return $this->percent;
    }

    function setpercent ($reqpercent) {
           $this->percent = $reqpercent;
    }
     function getstagenum() {
           return $this->stagenum;
    }

    function setstagenum ($stagenum) {
           $this->stagenum = $stagenum;
    }
    function getcontacteddate() {
           return $this->contacted_date;
    }

    function setcontacteddate ($contacted_date) {
           $this->contacted_date = $contacted_date;
    }
    function getmeetingdate() {
           return $this->meeting_date;
    }

    function setmeetingdate ($meeting_date) {
           $this->meeting_date = $meeting_date;
    }

     function addLeads() {
       //echo "I am here";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'sales_leads' for update";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $oppnum = "'" . $this->oppnum . "'";
        $leadsnum = "'" . $this->leadsnum . "'";
        $createDate = "'" . date("y-m-d") . "'";
        $name = "'" . $this->name . "'";
        $source = "'" . $this->source . "'";
        $title = "'" . $this->title . "'";
        $phone = "'" . $this->phone . "'";
        $email = "'" . $this->email . "'";
        $company = "'" . $this->company . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $industry_segment = "'" . $this->industry_segment . "'";
        $product_interest = "'" . $this->product_interest . "'";
        $primary_lead="'" . $this->primary_lead . "'";
        $rating = "'" . $this->rating . "'";
        $comments = "'" . $this->comments . "'";
        $addr1="'" . $this->addr1 . "'";
        $addr2 = "'" . $this->addr2 . "'";
        $city = "'" . $this->city . "'";
        $state = "'" . $this->state . "'";
        $zip = "'" . $this->zip . "'";
        $country = "'" . $this->country . "'";
        $convert2contact = "'" . $this->convert2contact . "'";
        $stage= "'" . $this->stage . "'";
        $percent = "'" . $this->percent . "'";
        $contacted_date = "'" . $this->contacted_date . "'";
        $meeting_date = "'" . $this->meeting_date . "'";

        $sql = "select * from sales_leads where name = $name";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        sales_leads
                            (
                            recnum,
                            leadsnum,
                            oppnum,
                            source,
                            name,
                            title,
                            phone,
                            email,
                            company,
                            industry_segment,
                            product_interest,
                            primary_lead,
                            addr1,
                            addr2,
                            city,
                            state,
                            zip,
                            country,
                            convert2contact,
                            stage,
                            percent,
                            stage_num,
                            contacted_date,
                            meeting_date,
                            creation_date
                            )
                    VALUES
                            ( $objid,
                              $leadsnum,
                              $oppnum,
                              $source,
                              $name,
                              $title,
                              $phone,
                              $email,
                              $company,
                              $industry_segment,
                              $product_interest,
                              $primary_lead,
                              $addr1,
                              $addr2,
                              $city,
                              $state,
                              $zip,
                              $country,
                              $convert2contact,
                              $stage,
                              $percent,
                              '10',
                              $contacted_date,
                              $meeting_date,
                              now())";
      // echo  $sql; exit;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to leads didn't work..Please report to Sysadmin. " . mysql_error());
         }
         else 
         {
                 echo "<table border=1><tr><td><font color=#FF0000>";
                 die("Lead Name " . $name . " already exists. ");
                  echo "</td></tr></table>";
            
            
         }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'sales_leads'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
//echo " <br>objid: $objid<br>";
return $objid;
     }

     function getLeads($cond,$offset,$rowsPerPage) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT
                  recnum,
                  source,
                  name,
                  title,
                  phone,
                  email,
                  company,
                  industry_segment,
                  product_interest,
                  primary_lead,
                  rating,
                  comments,
                  creation_date,
                  addr1,
                  addr2,
                  city,
                  state,
                  zip,
                  country,
                  convert2contact,
                  leadsnum,
                  oppnum,
                  stage,
                  percent
                FROM sales_leads 
                     where $cond limit $offset, $rowsPerPage";
        $result = mysql_query($sql);
// echo "$sql";
        return $result;

     }
     function getLead($leadsrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select
                    recnum,
                    source,
                    name,
                    title,
                    phone,
                    email,
                    company,
                    industry_segment,
                    product_interest,
                    primary_lead ,
                    rating,
                    comments,
                    creation_date,
                    addr1,
                    addr2,
                    city,
                    state,
                    zip,
                    country,
                    convert2contact,
                    leadsnum,
                    oppnum,
                    stage,
                    percent,
                    stage_num,
                    contacted_date,
                    meeting_date
                FROM `sales_leads`
                  where  sales_leads.recnum = $leadsrecnum";
        //echo $sql;
        $result = mysql_query($sql);

        return $result;
     }

     function updateLeads($leadsrecnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $name = "'" . $this->name . "'";
        $source = "'" . $this->source . "'";
        $title = "'" . $this->title . "'";
        $phone = "'" . $this->phone . "'";
        $email = "'" . $this->email . "'";
        $company = "'" . $this->company . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $industry_segment = "'" . $this->industry_segment . "'";
        $product_interest = "'" . $this->product_interest . "'";
        $rating = "'" . $this->rating . "'";
        $primary_lead = "'" . $this->primary_lead . "'";
        $comments = "'" . $this->comments . "'";
        $addr1 = "'" . $this->addr1 . "'";
        $addr2 = "'" . $this->addr2 . "'";
        $city = "'" . $this->city . "'";
        $state = "'" . $this->state . "'";
        $zip = "'" . $this->zip . "'";
        $country = "'" . $this->country . "'";
        $convert2contact = "'" . $this->convert2contact . "'";
        $leadsnum = "'" . $this->leadsnum . "'";
        $oppnum = "'" . $this->oppnum . "'";
        $stage = "'" . $this->stage . "'";
        $percent = "'" . $this->percent . "'";
        $stagenum = "'" . $this->stagenum . "'";
         $contacted_date = "'" . $this->contacted_date . "'";
        $meeting_date = "'" . $this->meeting_date . "'";

        $sql = "UPDATE sales_leads SET
                    company = $company,
                    name = $name,
                    source = $source,
            	    title=$title,
            	    phone =$phone ,
            	    email=$email,
            	    industry_segment=$industry_segment,
                    product_interest = $product_interest ,
                    comments=$comments,
                    primary_lead= $primary_lead,
                    addr1=$addr1,
                    addr2= $addr2,
                    city= $city,
                    state=$state,
                    zip= $zip,
                    country= $country,
                    convert2contact=$convert2contact,
                    leadsnum=$leadsnum,
                    oppnum=$oppnum,
                    stage= $stage,
                    percent = $percent,
                    stage_num=$stagenum,
                    contacted_date=$contacted_date,
                    meeting_date=$meeting_date
        	WHERE
                    recnum = $leadsrecnum ";
//echo "$sql";exit;
        $result = mysql_query($sql);
        if(!$result) die("Leads update failed...Please report to SysAdmin. " . mysql_error());
        }

//Function for deleting a perticular lead

     function deleteLead($leadsrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from sales_leads where recnum = $leadsrecnum";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Lead failed...Please report to SysAdmin. " . mysql_error());
      }

//Function for search/sort coded by Jerry George 30 Dec -04
function getleadssearch($cond,$argsort1,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;
        $sql = "select recnum,
                  source,
                  name,
                  title,
                  phone,
                  email,
                  company,
                  industry_segment,
                  product_interest,
                  primary_lead,
                  rating,
                  comments,
                  creation_date,
                  convert2contact,
                  leadsnum,
                  oppnum
                from sales_leads where  $wcond ORDER by $sortorder limit $offset, $limit";
//echo "$sql";
       $result = mysql_query($sql);
       return $result;
}

//Function for pagination coded by Jerry George 30 Dec -04
function getleadsCount($cond,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
             $sql = "select count(*) as numrows
                     from sales_leads where  $wcond limit $offset, $limit";
       $newlogin = new userlogin;
       $newlogin->dbconnect();
//echo "$sql";
$result  = mysql_query($sql) or die('Leads count query failed');
$row     = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];
return $numrows;
}

 //---------------------------------------add notes--------------------------------------------------------------------------------------------------
//Function for addnotes coded by Suresh

function getNotes($inpleadsrecnum){
$userrole = $_SESSION['userrole'];
$userid = $_SESSION['user'];
  $userrecnum = $_SESSION['userrecnum'];

        $leadsrecnum = $inpleadsrecnum;
        $sql = "select n.create_date, n.notes, u.userid
                     from leads_notes n, user u, sales_leads l
                     where n.notes2leads = l.recnum and
                           n.notes2user = u.recnum and
                           l.recnum = $leadsrecnum";
// echo "$sql";
        $result = mysql_query($sql);
        return $result;

     }



 function updNotes($leadsrecnum,$pagename)
     {
        $userrole = $_SESSION['userrole'];
        $userid = $_SESSION['user'];
        $usertype = $_SESSION['usertype'];
        if ($usertype == 'EMPL') {
           //echo'<a href="addNotes4leads.php?type=' . $pagename . '&leadsrecnum=' . $leadsrecnum . '" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'Image118\',\'\',\'images/addnotes_mo.gif\',1)"><img name="Image118" border="0" src="images/addnotes.gif" hspace=4></a>';
           //echo '</td></tr><tr width=100% bgcolor="DEDEDF"><td height="10"><img width="50" src="images/spacer.gif" height="1"><td align="right"><img src="images/box-right-top.gif"></td></td></tr>';
        }
    }


 function addNotes($leadsrecnum,$notes)
    {
        // Connect to database
        $create_date = "'" . date("y-m-d") . "'";
        $userid = $_SESSION['user'];
        $userrecnum = $_SESSION['userrecnum'];
        $sql = "select nxtnum from seqnum where tablename = 'leads_notes'";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $specinstrns = "'" . $notes . "'";
        $sql = "INSERT INTO leads_notes (recnum, notes,notes2leads, notes2user,create_date )
               VALUES ($objid, $specinstrns, $leadsrecnum, $userrecnum, $create_date)";
// echo "$sql";exit;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Insert of Notes didn't work. " . mysql_error());

        $sql = "update seqnum set nxtnum = $objid where tablename = 'leads_notes'";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert for notes table didn't work. " . mysql_error());

     }
//----------------------------------------------------------------------------------------

// function to find out leads related to specific opportunity coded by Suresh

    function getleads4opportunity($leadrecnum) {
        //$opportunityrecnum=$argworec;
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select  l.name, l.company, l.source,l.industry_segment,
                        l.product_interest,l.primary_lead,l.creation_date
                       
                  from sales_leads l
                  where
	               
	               l.recnum=$leadrecnum ";

                  // echo $sql;exit;
        $result = mysql_query($sql);
        return $result;
     }


// function to add and delete links in mtm_leads_opportunity table coded by Jerry George

 function modifyMtm($argmodify,$arglrecnum,$argorecnum)
  {
	$modify=$argmodify;
	$leadsrecnum=$arglrecnum;
	$opportunityrecnum=$argorecnum;
	if($modify=="LinkOpportunity")
	{
	           $sql = "INSERT INTO mtm_leads_opportunity VALUES ($leadsrecnum,$opportunityrecnum)";
	}
	else
	{
	           $sql = "DELETE FROM mtm_leads_opportunity WHERE  leads_recnum=$leadsrecnum AND opportunity_recnum=$opportunityrecnum";
	}
//echo " qury is    " . $sql;
      	$result = mysql_query($sql);
	if(!$result) die("Update of Opportunity failed..Please report to Sysadmin " . mysql_error());

}

    function getOpp4Leads($arglrecnum) {
        $leadsrecnum=$arglrecnum;

            $sql = "select o.oppnum,o.opp_name, o.acc_name, o.leadsnum,o.lead_source,
                           o.expected_close_date,o.sales_stage, o.type, o.create_date,
                           o.amount_currency,o.assigned_to,o.recnum
                           from sales_opportunity o,sales_leads l,mtm_leads_opportunity m
                           where
	           l.recnum=$leadsrecnum and
	           o.recnum=m.opportunity_recnum and
	           m.leads_recnum=l.recnum
               ORDER by o.oppnum";
    // echo $sql;exit;
        $result = mysql_query($sql) or die('Get wo for PO failed');
        return $result;
     }

  function getlinkedOppcount4Leads($arglrecnum)
     {
        $leadsrecnum=$arglrecnum;
        $sql = "select max(o.recnum) as maxrecno
                           from sales_opportunity o, sales_leads l,mtm_leads_opportunity m
                           where
	           l.recnum=$leadsrecnum and
	           o.recnum=m.opportunity_recnum and
	           m.leads_recnum=l.recnum
               ORDER by o.oppnum";

//echo "$sql</br>";
        $result  = mysql_query($sql) or die('Opportunity count query failed');
        return $result;

     }


// function to add opportunity related to specific lead coded by Suresh Devadiga Oct-06

   function addOpp4Leads($arglrecnum) {

        $leadsrecnum=$arglrecnum;
        $sql= "select opportunity_recnum  from mtm_leads_opportunity where  leads_recnum=$leadsrecnum";
        // echo $sql;exit;
        $result = mysql_query($sql);

        $list ="(";
        if ($myrow=mysql_fetch_row($result))
		    $list=$list . $myrow[0] ;
        else
        $list= $list . 0;
        while ($myrow= mysql_fetch_row($result))
        {
		    $list= $list . "," . $myrow[0];

        }
        $list =$list . ")";

        $sql1 = "select DISTINCT o.oppnum,o.opp_name,o.acc_name,o.leadsnum,o.lead_source,
                           o.expected_close_date,o.sales_stage, o.type, o.create_date,
                           o.amount_currency,o.assigned_to, o.recnum
                         from sales_opportunity o
                    where
	                     o.recnum not in $list
                         ORDER by o.oppnum";
       // echo $sql1;exit;
        $result1 = mysql_query($sql1);
        return $result1;
     }

     function getAddOppcount4Leads($arglrecnum) {

        $leadsrecnum=$arglrecnum;
        $sql= "select opportunity_recnum  from mtm_leads_opportunity where  leads_recnum=$leadsrecnum";
        $result = mysql_query($sql);

        $list ="(";
        if ($myrow=mysql_fetch_row($result))
		$list=$list . $myrow[0] ;
        else
        $list= $list . 0;
        while ($myrow= mysql_fetch_row($result))
        {
		$list= $list . "," . $myrow[0];

        }
        $list =$list . ")";

        $sql = "select max(o.recnum) as maxrecno
                           from sales_opportunity o
                           where
	                      o.recnum not in $list
                         ORDER by o.oppnum";
//echo $sql;
        $result  = mysql_query($sql) or die('Opportunity count query failed');
        return $result;

     }


     function getWocount4Po($arglrecnum) {
        $leadsrecnum = $arglrecnum;
               $sql = "select count(*) as numrows
                       from mtm_leads_opportunity where  leads_recnum=$leadsrecnum";
//echo "$sql</br>";
        $result  = mysql_query($sql) or die('Opportunity count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;

     }

     function getAllcountry() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT 
                   distinct(country)
                    FROM sales_leads 
                    ";


        $result = mysql_query($sql);
// echo "$sql";
        return $result;

     }


         function getAllindustry() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT 
                      distinct(industry_segment)
                    FROM sales_leads 
                    ";


        $result = mysql_query($sql);
// echo "$sql";
        return $result;

     }
     function getAllproduct() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT 
                       distinct(product_interest)
                    FROM sales_leads 
                    ";


        $result = mysql_query($sql);
// echo "$sql";
        return $result;

     }


      function getLeadsExport($cond) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT
                  recnum,
                  source,
                  name,
                  title,
                  phone,
                  email,
                  company,
                  industry_segment,
                  product_interest,
                  primary_lead,
                  rating,
                  comments,
                  creation_date,
                  addr1,
                  addr2,
                  city,
                  state,
                  zip,
                  country,
                  convert2contact,
                  leadsnum,
                  oppnum,
                  stage,
                  percent
                FROM sales_leads 
                     where $cond";
        $result = mysql_query($sql);
// echo "$sql";
        return $result;

     }

     function getAllleads() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT 
                   l.recnum,l.name,l.stage,o.sales_stage,l.stage_num,o.opp_stagenum,
				   l.contacted_date,
				   l.meeting_date,o.create_date,o.proposal_date,o.negotiate_date 
                    FROM sales_leads l 
					left join sales_opportunity o on l.recnum=o.link2lead  
					order by o.opp_stagenum,l.stage_num desc; 
                    ";
        //echo $sql; 
        $result = mysql_query($sql);
        // echo "$sql";
        return $result;

     }
function getAllcontactedleads() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT 
                   name 
                    FROM sales_leads
                    where name NOT IN(select name from sales_leads where (stage='' or stage like'Not contacted%') 
                    )order by name asc
                    ";

//echo $sql; exit;
        $result = mysql_query($sql);
// echo "$sql";
        return $result;

     }


} // End leads class definition