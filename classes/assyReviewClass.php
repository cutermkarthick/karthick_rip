<?
//================================================
// Author: FSI
// Date-written = April 30,2010
// Filename: assyReviewClass.php
// Maintains the class for BOMs/Partlists
// Revision: v1.0
//================================================

include_once('loginClass.php');

class assyReview 
{
    var $cust_ponum,
        $customer ,
        $po_date,
        $quote_ref,
        $po_line,
        $amendment_num,
        $amendment_date,
        $review_ref,
        $review_date,
        $ord_type,
        $order_for,
        $contact,
        $email,
        $agreement,
        $project,
        $technical_requirements,
        $quality_requirements,
        $controlled,
        $doc_req,
        $spec_req,
        $outsourcing_activities,
        $cust_agr,
        $app_cust,
	    $act_out,
        $source_mfg,
	    $item_req,
	    $item_app,
	    $sup_item,
        $delivery,
        $risk,
        $resources,
        $env,
        $others,
        $special_instruction,
        $qa_approved,
        $engineering_approved,
        $qa_app_by,
        $eng_app_by,$status;

    // Constructor definition
    function assyReview() {
        $this->cust_ponum= '';
        $this->customer = '';
        $this->po_date= '';
        $this->quote_ref= '';
        $this->po_line= '';
        $this->amendment_num= '';
        $this->amendment_date= '';
        $this->review_ref= '';
        $this->review_date= '';
        $this->ord_type= '';
        $this->order_for= '';
        $this->contact= '';
        $this->email= '';
        $this->agreement= '';
        $this->project= '';
        $this->technical_requirements= '';
        $this->quality_requirements= '';
        $this->controlled= '';
        $this->doc_req= '';
        $this->spec_req= '';
        $this->outsourcing_activities= '';
        $this->cust_agr= '';
        $this->app_cust= '';
        $this->act_out= '';
        $this->source_mfg= '';
        $this->item_req= '';
        $this->item_app= '';
        $this->sup_item= '';
	    $this->delivery= '';
        $this->risk = '';
	    $this->resources= '';
	    $this->env= '';
	    $this->others= '';
	    $this->special_instruction='';
	    $this->qa_approved = '';
		$this->engineering_approved = '';
		$this->qa_app_by = '';
		$this->eng_app_by = '';
		$this->status = '';
     }

    // Property get and set
    function getcust_ponum() {
           return $this->cust_ponum;
    }

    function setcust_ponum($reqcust_ponum) {
           $this->cust_ponum = $reqcust_ponum;
    }
    function getcustomer() {
           return $this->customer;
    }

    function setcustomer($reqcustomer) {
           $this->customer = $reqcustomer;
    }


    function getpo_date() {
           return $this->po_date;
    }

    function setpo_date($reqpo_date) {
           $this->po_date = $reqpo_date;
    }
 function getquote_ref() {
           return $this->quote_ref;
    }

    function setquote_ref($reqquote_ref) {
           $this->quote_ref = $reqquote_ref;
    }
 function getpo_line() {
           return $this->po_line;
    }

    function setpo_line($reqpoline) {
           $this->po_line = $reqpoline;
    }
 function getamnd_num() {
           return $this->amendment_num;
    }

    function setamnd_num($reqamnd_num) {
           $this->amendment_num = $reqamnd_num;
    }
 function getamnd_date() {
           return $this->amendment_date;
    }

    function setamnd_date($reqamnd_date) {
           $this->amendment_date = $reqamnd_date;
    }
 function getreview_ref() {
           return $this->review_ref;
    }

    function setreview_ref ($reqreview_ref) {
           $this->review_ref = $reqreview_ref;
    }
 function getreview_date() {
           return $this->review_date;
    }

    function setreview_date ($reqreview_date) {
           $this->review_date = $reqreview_date;
    }
 function getord_type() {
           return $this->ord_type ;
    }

    function setord_type($reqord_type) {
           $this->ord_type  = $reqord_type;
    }
 function getcontact() {
           return $this->contact;
    }

    function setcontact($reqcontact) {
           $this->contact = $reqcontact;
    }
 function getorder_for() {
           return $this->order_for;
    }

    function setorder_for ($reqorder_for) {
           $this->order_for = $reqorder_for;
    }
 function getmail() {
           return $this->email;
    }

    function setmail($reqmail) {
           $this->email = $reqmail;
    }
 function getagreement() {
           return $this->agreement;
    }

    function setagreement($reqagreement) {
           $this->agreement = $reqagreement;
    }
    
    function getproject() {
           return $this->project;
    }

    function setproject($reqproject) {
           $this->project = $reqproject;
    }
    
 function gettechnical_requirements() {
           return $this->technical_requirements;
    }

    function settechnical_requirements ($reqtechnical_requirements) {
           $this->technical_requirements = $reqtechnical_requirements;
    }
 function getquality_requirements() {
           return $this->quality_requirements;
    }

    function setquality_requirements($reqquality_requirements) {
           $this->quality_requirements = $reqquality_requirements;
    }
 function getcontrol() {
           return $this->controlled;
    }

    function setcontrol($reqcontrol) {
           $this->controlled = $reqcontrol;
    }
 function getdoc_req() {
           return $this->doc_req;
    }

    function setdoc_req($reqdoc_req) {
           $this->doc_req = $reqdoc_req;
    }
 function getspec_req() {
           return $this->spec_req;
    }

    function setspec_req($reqspec_req) {
           $this->spec_req = $reqspec_req;
    }
 function getcust_agr() {
           return $this->cust_agr;
    }

    function setcust_agr($reqcust_agr) {
           $this->cust_agr = $reqcust_agr;
    }
 function getapp_cust() {
           return $this->app_cust;
    }

    function setapp_cust($reqapp_cust) {
           $this->app_cust = $reqapp_cust;
    }

 function getoutsourcing_activities() {
           return $this->outsourcing_activities ;
    }

    function setoutsourcing_activities ($reqoutsourcing_activities) {
           $this->outsourcing_activities  = $reqoutsourcing_activities;
    }
 function getsource_mfg() {
           return $this->source_mfg;
    }

    function setsource_mfg($reqsource_mfg) {
           $this->source_mfg = $reqsource_mfg;
    }
  function getitem_req() {
           return $this->item_req;
    }

    function setitem_req($reqitem_req) {
           $this->item_req = $reqitem_req;
    }
 function getitem_app() {
           return $this->item_app;
    }

    function setitem_app($reqitem_app) {
           $this->item_app = $reqitem_app;
    }
 function getdelivery_schedules() {
           return $this->delivery;
    }

    function setdelivery_schedules ($reqdelivery_schedules) {
           $this->delivery = $reqdelivery_schedules;
    }

 function getsup_item() {
           return $this->sup_item;
    }

    function setsup_item($reqsup_item) {
           $this->sup_item = $reqsup_item;
    }

 function getrisk() {
           return $this->risk;
    }

    function setrisk($reqrisk_requirement) {
           $this->risk = $reqrisk_requirement;
    }

    function getresources() {
           return $this->resources;
    }

    function setresources($reqadditional_resources) {
           $this->resources = $reqadditional_resources;
    }
    
    function getenv() {
           return $this->env;
    }

    function setenv($reqenv) {
           $this->env = $reqenv;
    }
    
    function getothers() {
           return $this->others;
    }

    function setothers($reqothers) {
           $this->others = $reqothers;
    }
    
    function getact_out() {
           return $this->act_out;
    }

    function setact_out($reqactout) {
           $this->act_out = $reqactout;
    }
    function setspecial_instruction($special_instruction) {
           $this->special_instruction = $special_instruction;
    }
    
    function getqa_approved() {
           return $this->qa_approved;
    }
    function setqa_approved($qa_approved) {
           $this->qa_approved = $qa_approved;
    }
    function getqa_app_by() {
           return $this->qa_app_by;
    }
    function setqa_app_by($qa_app) {
           $this->qa_app_by = $qa_app;
    }
    function geteng_app_by() {
           return $this->eng_app_by;
    }
    function seteng_app_by($eng_app) {
           $this->eng_app_by = $eng_app;
    }
    
     function getengineering_approved() {
           return $this->engineering_approved;
    }
    function setengineering_approved($engineering_approved) {
           $this->engineering_approved = $engineering_approved;
    }
     function setstatus($status) {
           $this->status = $status;
    }

    
    function addAssyReview()
    { 
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select nxtnum from seqnum where tablename = 'assy_review' for update";
         $result = mysql_query($sql);
         if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
         $myrow = mysql_fetch_row($result);
         $seqnum = $myrow[0];
         $objid = $seqnum + 1;
         $cust_ponum ="'" .$this->cust_ponum . "'";
         $customer = "'" . $this->customer . "'";         
	     $po_date =  "'".$this->po_date ."'";
	     $quote_ref = "'" .$this->quote_ref . "'";
	     $poline = "'" .$this->po_line . "'";
	     $amendment_num =  "'".$this->amendment_num ."'";
	     $amendment_date =  $this->amendment_date?"'".$this->amendment_date ."'":'0000-00-00';
	     $review_ref ="'" .$this->review_ref . "'";
	     $review_date= $this->review_date?"'".$this->review_date ."'":'0000-00-00';
         $order_for = "'" . $this->order_for . "'";
         $order_type = "'" . $this->ord_type . "'";
	     $contact =  "'".$this->contact ."'";
	     $email ="'" .$this->email . "'";
         $aggr = "'" . $this->agreement . "'";
         $project = "'" . $this->project . "'";
	     $technical_requirements ="'" .$this->technical_requirements. "'";
         $quality_requirements = "'" . $this->quality_requirements . "'";    
	     $controlled = "'" . $this->controlled . "'";
	     $doc_req = "'" . $this->doc_req . "'";
	     $spec_req =  "'".$this->spec_req ."'";
	     $cust_agr = "'" . $this->cust_agr . "'";
	     $app_cust = "'" . $this->app_cust . "'";
	     $outsourcing_activities =  "'". $this->outsourcing_activities ."'";
         $act_out =  "'". $this->act_out ."'";
	     $source_mfg = "'" . $this->source_mfg . "'";
	     $item_req =  "'".$this->item_req ."'";
         $sup_item = "'". $this->sup_item ."'";
         $delivery= "'" . $this->delivery. "'";
	     $item_app = "'" . $this->item_app . "'";
	     $risk = "'" . $this->risk . "'";
	     $resources =  "'". $this->resources ."'";
	     $env =  "'".$this->env ."'";
	     $others =  "'".$this->others ."'";
	     $special_instruction= "'".$this->special_instruction ."'";
	     $qa_approved = "'" . $this->qa_approved . "'";
        $engineering_approved = "'" . $this->engineering_approved . "'";
        $qa_app = "'" . $this->qa_app_by . "'";
        $eng_app = "'" . $this->eng_app_by . "'";
        $siteid = "'" . $_SESSION['siteid']. "'";

         $sql = "select * from assy_review	po_num where cust_ponum = $cust_ponum";
         $result = mysql_query($sql);
         if (!(mysql_fetch_row($result))) {
		 $sql = "INSERT INTO assy_review
               (recnum,
               cust_ponum,
        	   customer ,
        	   po_date,
        	   quote_ref,
       	       poline,
        	   source_raw_material,
        	   amendment_num,
        	   amendment_date,
        	   review_ref,
        	   review_date,
        	   ord_type,
        	   order_for,
        	   contact,
           	   email,
        	   agreement,
        	   project,
        	   technical_requirement,
        	   quality_requirement,
        	   controlled,
       	       doc_req,
       	 	   spec_req,
       	 	   cust_agr,
        	   app_cust,
        	   item_req,
        	   outsourcing_activities,
        	   act_out,
        	   item_app,
        	   sup_item,
		       delivery,
	           risk,
		       resources,
		       env,
		       others,
               formatnum,
               formatrev,
               status,
               special_instruction,qa_approved,engineering_approved,qa_app_by,engg_app_by,siteid)
               VALUES 
		    ($objid,
             $cust_ponum,
  	         $customer ,
  	         $po_date,
        	 $quote_ref,
        	 $poline,
        	 $source_mfg,
        	 $amendment_num,
        	 $amendment_date,
        	 $review_ref,
        	 $review_date,
        	 $order_type,
       	 	 $order_for,
        	 $contact,
        	 $email,
        	 $aggr,
        	 $project,
        	 $technical_requirements,
        	 $quality_requirements,
        	 $controlled,
        	 $doc_req,
        	 $spec_req,
        	 $cust_agr,
        	 $app_cust,
        	 $item_req,
        	 $outsourcing_activities,
        	 $act_out,
        	 $item_app,
        	 $sup_item,
		     $delivery,
             $risk,
		     $resources,
		     $env,
		     $others,
             'F3004',
             'Rev:01',
             'Open',
             $special_instruction,$qa_approved,$engineering_approved,$qa_app,$eng_app,$siteid)";

		 }
           else
	     {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Assembly PO# " . $cust_ponum . " already exists. ");
            echo "</td></tr></table>";
         }

         $result = mysql_query($sql);
         if(!$result) die("Insert to Assy Review  didn't work..Please report to Sysadmin. " . mysql_error());
         
         $sql = "update seqnum set nxtnum = $objid where tablename = 'assy_review'";
         $result = mysql_query($sql);
         if(!$result) die("Seqnum insert query didn't work for Review Entry..Please report to Sysadmin. " . mysql_error());
        return  $objid;
     }	

    function updateAssyReview($recnum)
    { 
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "start transaction";

         $cust_ponum ="'" .$this->cust_ponum . "'";
         $customer = "'" . $this->customer . "'";
	     $po_date =  "'".$this->po_date ."'";

	     $quote_ref ="'" .$this->quote_ref . "'";
	     $poline ="'" .$this->po_line . "'";

	     $amendment_num =  "'". $this->amendment_num ."'";
	     $amendment_date =  $this->amendment_date?"'".$this->amendment_date ."'":'0000-00-00';
	     $review_ref ="'" .$this->review_ref . "'";
	     $review_date= $this->review_date?"'".$this->review_date ."'":'0000-00-00';
         $order_for = "'" . $this->order_for . "'";
         $order_type = "'" . $this->ord_type . "'";
	     $contact =  "'".$this->contact ."'";
	     $email ="'" .$this->email . "'";
         $aggr = "'" . $this->agreement . "'";
         $project = "'" . $this->project . "'";
	     $technical_requirements ="'" .$this->technical_requirements. "'";
         $quality_requirements = "'" . $this->quality_requirements . "'";

	     $controlled = "'" . $this->controlled . "'";
	     $doc_req = "'" . $this->doc_req . "'";
	     $spec_req =  "'".$this->spec_req ."'";
         $act_out =  "'". $this->act_out ."'";
	     $cust_agr = "'" . $this->cust_agr . "'";
	     $app_cust = "'" . $this->app_cust . "'";
         $sup_item = "'". $this->sup_item ."'";
	     $outsourcing_activities =  "'".$this->outsourcing_activities ."'";
	     $source_mfg = "'" . $this->source_mfg . "'";
	     $item_req =  "'".$this->item_req ."'";

         $delivery= "'" . $this->delivery. "'";
	     $item_app = "'" . $this->item_app . "'";
	     $risk= "'" . $this->risk . "'";
	     $resources =  "'".$this->resources ."'";
	     $env =  "'".$this->env ."'";
	     $others =  "'".$this->others ."'";
         $special_instruction= "'".$this->special_instruction ."'";
         $qa_approved = "'" . $this->qa_approved . "'";
        $qa_app = "'" . $this->qa_app_by . "'";
        $eng_app = "'" . $this->eng_app_by . "'";
        $engineering_approved = "'" . $this->engineering_approved . "'";
        $status = "'" . $this->status . "'";

        $sql = "update assy_review set
            cust_ponum=$cust_ponum ,
    	    customer=$customer,
        	po_date=$po_date,
        	quote_ref=$quote_ref,
        	poline=$poline,
        	source_raw_material=$source_mfg,
        	amendment_num=$amendment_num,
        	amendment_date=$amendment_date,
        	review_ref=$review_ref,
        	review_date=$review_date,
        	ord_type=$order_type,
        	order_for=$order_for,
        	contact=$contact,
        	email=$email,
        	agreement=$aggr,
        	project=$project,
        	technical_requirement=$technical_requirements,
        	quality_requirement=$quality_requirements,
        	controlled=$controlled,
        	doc_req=$doc_req,
       	 	spec_req=$spec_req,
       	 	cust_agr=$cust_agr,
        	app_cust=$app_cust,
        	item_req=$item_req,
        	outsourcing_activities=$outsourcing_activities,
        	act_out = $act_out,
        	item_app=$item_app,
        	sup_item=$sup_item,
		    delivery=$delivery,
		    risk=$risk,
		    resources=$resources,
		    env=$env,
		    others=$others,
		    status=$status,
		    special_instruction=$special_instruction,
		    qa_approved=$qa_approved,
            engineering_approved=$engineering_approved,
            qa_app_by=$qa_app,
            engg_app_by=$eng_app
               where recnum = $recnum";
           //echo $sql;
           $result = mysql_query($sql);

           // Test to make sure query worked
           if(!$result) die("Update to assyReview didn't work..Please report to Sysadmin. " . mysql_error());
     }

    function getassyReviewSummary($cond)
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $siteid = $_SESSION['siteid'];
        $siteval = "r.siteid ='" .$siteid."'";
       // $offset = $argoffset;
        //$limit = $arglimit;

       $sql = " SELECT r.recnum as rec, company.name, '', r.po_date,
                             r.cust_ponum,'', '', '',
                             r.contact,'',r.review_date, rli.assy_partnum, rli.qty,
                             aw.assyqty,aw.assy_wonum as wo_number, aw.comp_qty,rli.total_price,rli.unit_price,r.status,''
                             '',aw.recnum as worec,rli.crn as crn,rli.line_num as ln,'','',aw.assy_wonum as wonum,rli.pcrn as pcrn,r.qa_approved,r.engineering_approved,aw.assy_type
                             FROM assy_review r, company, assy_review_li rli,assy_wo aw
                                where
                                     aw.crn = rli.crn  and
                                     aw.status != 'Cancelled' and
                                     ((aw.cust_po_line_num !=  '' and
                                     aw.cust_po_line_num is not null and
                                     aw.cust_po_line_num =  rli.line_num) or
                                     (aw.cust_po_line_num =  '' or aw.cust_po_line_num is null)) and
                                      aw.ponum=rli.ponum and
                                r.customer = company.recnum and
                                r.recnum = rli.link2assyreview and
                                $cond and $siteval

                       UNION
                      SELECT r.recnum as rec, company.name, '', r.po_date,
                             r.cust_ponum,'', '', '',
                             r.contact,'',r.review_date, rli.assy_partnum, rli.qty,
                             ali.qty_wo,ali.grn , ali.qty_acc,rli.total_price,rli.unit_price,r.status,''
                             '',aw.recnum as worec,rli.crn as crn,rli.line_num as ln,ali.qty_rej,ali.qty_ret,aw.assy_wonum as wonum,rli.pcrn as pcrn,r.qa_approved,r.engineering_approved,aw.assy_type
                             FROM assy_review r, company, assywo_li ali,assy_review_li rli ,assy_wo aw

                              where ((ali.linenum !=  '' and
                                     ali.linenum is not null and
                                     ali.linenum =  rli.line_num)) and
                                      aw.status != 'Cancelled' and
                                      aw.ponum=rli.ponum and
                                      ali.link2assywo=aw.recnum and
                                      r.customer = company.recnum and
                                      r.recnum = rli.link2assyreview and
                                      ali.pcustponum=rli.ponum and
                                $cond and $siteval
                                   UNION
                   SELECT r.recnum as rec, company.name, '', r.po_date,
                             r.cust_ponum,'', '', '',
                             r.contact,'',r.review_date, rli.assy_partnum, rli.qty,
                             aw.assyqty,aw.assy_wonum as wo_number, aw.comp_qty,rli.total_price,rli.unit_price,r.status,''
                             '',aw.recnum as worec,rli.crn as crn,rli.line_num as ln,'','',aw.assy_wonum as wonum,rli.pcrn as pcrn,r.qa_approved,r.engineering_approved,aw.assy_type
                             FROM assy_review r, company, assy_review_li rli
                                  left join assy_wo aw on
                                     aw.crn = rli.crn  and
                                     aw.status != 'Cancelled' and
                                     ((aw.cust_po_line_num !=  '' and
                                     aw.cust_po_line_num is not null and
                                     aw.cust_po_line_num =  rli.line_num) or
                                     (aw.cust_po_line_num =  '' or aw.cust_po_line_num is null)) and
                                      aw.ponum=rli.ponum
                               left join assywo_li ali on
                                    ((ali.linenum !=  '' and
                                     ali.linenum is not null and
                                     ali.linenum =  rli.line_num)) and ali.pcustponum=rli.ponum
               where
               r.customer = company.recnum and
               r.recnum = rli.link2assyreview and
               aw.assy_wonum is null and ali.pcustponum is null and $cond and $siteval
                                order by rec,pcrn,wonum,ln";
       // echo  $sql;
        $result = mysql_query($sql);
        if(!$result) die("Access to assyReview failed...Please report to SysAdmin. " . mysql_error());
        return $result;
     }
       
    function getassyReviewDetails($recnum)
    {
        $recnum = "'" . $recnum . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select r.recnum,
            r.cust_ponum,
    	    c.name,
    	    r.customer,
        	r.po_date,
        	r.quote_ref,
        	r.poline,
        	r.source_raw_material,
        	r.amendment_num,
        	r.amendment_date,
        	r.review_ref,
        	r.review_date,
        	r.ord_type,
        	r.order_for,
        	r.contact,
        	r.email,
        	r.agreement,
        	r.project,
        	r.technical_requirement,
        	r.quality_requirement,
        	r.controlled,
        	r.doc_req,
       	 	r.spec_req,
       	 	r.cust_agr,
        	r.app_cust,
        	r.item_req,
        	r.outsourcing_activities,
        	r.act_out,
        	r.item_app,
        	r.sup_item,
		    r.delivery,
		    r.risk,
		    r.resources,
		    r.env,
		    r.others,
            r.formatnum,
            r.formatrev,r.special_instruction,r.qa_approved,r.engineering_approved,r.qa_app_by,r.engg_app_by,r.status,r.val_status ,r.customer
            from  assy_review r,company c
               where r.recnum=$recnum and
                     c.recnum=r.customer";

        $result = mysql_query($sql);
        if(!$result) die("Access to Review Assembly details failed...Please report to SysAdmin. " . mysql_error());
        return $result;
    }
    
   function getassyReviewSummaryCount($cond,$argoffset,$arglimit) {

        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;

        $sql = "select count(*) as numrows
                  FROM assy_review
                  where $wcond
                  order by recnum limit $offset,$limit";
        //echo $sql;
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $result  = mysql_query($sql) or die('assypo count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;

    }
    
   function getassyReview()
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select recnum,
                       cust_ponum,
                       bom_refnum,
                       bom_iss
               from assy_review";
        //echo  $sql;
        $result = mysql_query($sql);
        if(!$result) die("Get assyReview failed...Please report to SysAdmin. " . mysql_error());
        return $result;
  }
  
   function getrej_qty4assy($wonum)
     {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select sum(wps.rej),sum(wps.ret),'' from assy_part_status wps,assy_wo wo
                     where  wo.recnum=wps.link2assywo
                            and (wps.stage = 'final' or wps.stage = 'Final' or
                            wps.stage = 'FINAL' or wps.stage = 'fi' or
                            wps.stage = 'FI' or wps.stage = 'Fi')
                            and wo.assy_wonum='$wonum'
                            group by wo.assy_wonum";
			 //echo $sql;
      $result = mysql_query($sql);
      if(!$result) die("Query failed for rejqty . " . mysql_error());
      return $result;
     }
     
     function getcrn4review()
     {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $siteid = $_SESSION['siteid'];
      $siteval = "siteid = '".$siteid."'";
      $sql = "select recnum,CIM_refnum,partnum,type,partname,status 
	           from master_data 
             where status='Active' and type='Assembly' and 
                   $siteval
	           order by CIM_refnum ";
			// echo $sql;
      $result = mysql_query($sql);
      if(!$result) die("Query failed for getcrn4review ... " . mysql_error());
      return $result;
     }
     
      function getchildcrns4review($crn,$bomnum)
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "
               select  bom_subassy.item_no as itn,bom_subassy.partnum,bom_subassy.partname, bom_subassy.partiss,'Sub Assembly',
                       bom_subassy.crn,bom_subassy.qpa,bom_subassy.crn_type,'',''
                   from bom b,bom_subassy_items bom_subassy
                    where b.bomnum = '$bomnum' and b.crn='$crn'
                         and bom_subassy.link2bom=b.recnum  and b.status ='Active'
                         group by bom_subassy.crn
                   UNION
                   select  bom_mfg.item_no as itn,bom_mfg.partnum,bom_mfg.partname, bom_mfg.partiss,'Manufactured',
                       bom_mfg.crn,bom_mfg.qpa,bom_mfg.crn_type, bom_mfg.drgiss, bom_mfg.cos
                   from bom b,bom_mfg_items bom_mfg
                   where b.bomnum = '$bomnum' and b.crn='$crn'
                         and bom_mfg.link2bom=b.recnum  and b.status ='Active'
                         group by bom_mfg.crn
                UNION
               select  bom_bo.item_no as itn,bom_bo.partnum,bom_bo.descr, bom_bo.partiss,'Bought Out',
			           bom_bo.partnum,bom_bo.qpa,'','',''
                   from bom b,bom_bought_items bom_bo
                   where bom_bo.link2bom=b.recnum and b.crn='$crn' and b.status ='Active' and b.bomnum = '$bomnum'
                UNION
               select  bom_co.item_no as itn,bom_co.spec as partnum,bom_co.descr,'','Consume',bom_co.descr,
			           bom_co.qpa,'','',''
                   from bom b,bom_consume bom_co
                    where bom_co.link2bom=b.recnum and b.crn='$crn' and b.status ='Active'  and b.bomnum = '$bomnum'";
        //echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("getchildcrns4review failed...Please report to SysAdmin. " . mysql_error());
        return $result;
    }
    
     function updatereview4app($recnum)
       {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $qa_approved = "'" . $this->qa_approved . "'";
        $qa_app = "'" . $this->qa_app_by . "'";
        $eng_app = "'" . $this->eng_app_by . "'";
        $engineering_approved = "'" . $this->engineering_approved . "'";
        $status = "'" . $this->status . "'";

          $sql = "UPDATE assy_review SET
					qa_approved=$qa_approved,
					engineering_approved=$engineering_approved,
					qa_app_by=$qa_app,
					engg_app_by=$eng_app,
					status=$status
        	WHERE
                    recnum = $recnum";
          // echo $sql;
           $result = mysql_query($sql);

           if(!$result)
           {
                     //header("Location:errorMessage.php?validate=Inv5");
                     die("Assembly Review Approval update failed...Please report to SysAdmin. " . mysql_error());
           }
        }
        

    function updateval_status($recnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "update assy_review set val_status='Yes' where recnum = $recnum";
       $result = mysql_query($sql);
      // echo $sql;
       if(!$result)
       {
            die("Validation update failed...Please report to SysAdmin. " . mysql_error());
       }

    }

} // End bom class definition
