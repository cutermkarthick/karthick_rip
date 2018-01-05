<?php

session_start();
header("Cache-control: private");
//============================================
// Author: FSI
// Date-written = March 20, 2007
// Filename: reviewClass.php
// Maintains the class for Contract Review
// Revision: v1.0  OMS
//============================================

include_once('classes/loginClass.php');

class review {
    var
    $recnum,
    $refno,
    $date,
    $name,
    $quoterefnum,
    $ordernum,
    $orderfor,
    $ordertype,
    $numofparts,
    $attachment1,
    $rawmaterial,
    $source,
    $parts_class,
    $resources,
    $qualityreq,
    $saliant,
    $aditional_resources,
    $investment,
    $subcontract,
    $special_process,
    $delivery_req,
    $person,
    $enq_answeredby,
    $quotation,
    $data_for_quote,
    $data_store,
    $path,
    $quote_path,
    $enquiry_path,
    $quotation_det_store,
    $data_for_enquiry,
    $risk_factors,
    $requirements,
    $quote_date,
    $quote_sentby,
    $orddate,
    $due_date,
    $amendment_num,
    $amendment_date,
	$special_instrns,
    $orderstatus,
    $val_status,
    $create_date,
    $created_by,
    $qa_approved,
    $engineering_approved,
    $qa_app_by,
    $eng_app_by,
	$prodn_app,
	$prodn_app_by;

    // Constructor definition
    function review() {
        $this->recnum = '';
        $this->refno = '';
        $this->ordernum = '';
        $this->quoterefnum = '';
        $this->orddate = '';
        $this->name = '';
        $this->orderfor = '';
        $this->numofparts = '';
        $this->attachment1 = '';
        $this->attachment2 = '';
        $this->rawmaterial = '';
        $this->source = '';
        $this->parts_class= '';
        $this->resources= '';
        $this->qualityreq = '';
        $this->saliant = '';
        $this->aditional_resources = '';
        $this->investment = '';
        $this->subcontract = '';
        $this->special_process = '';
        $this->delivery_req = '';
        $this->person = '';
        $this->enq_answeredby = '';
        $this->quotation = '';
        $this->data_for_quote = '';
        $this->data_store = '';
        $this->path = '';
        $this->quotation_det_store= '';
        $this->risk_factors= '';
        $this->requirements= '';
        $this->explain_risk_factors = '';
        $this->quote_sentby = '';
        $this->due_date = '';
        $this->quote_date = '';
        $this->data_for_enquiry;
        $this->quote_path = '';
        $this->enquiry_path = '';
        $this->amendment_num= '';
        $this->amendment_date = '';
		$this->special_instrns = '';
		$this->orderstatus = '';
		$this->val_status = '';
		$this->create_date = '';
		$this->created_by = '';
		$this->qa_approved = '';
		$this->engineering_approved = '';
		$this->qa_app_by = '';
		$this->eng_app_by = '';
		$this->prodn_app='';
		$this->prodn_app_by='';
    }


    function getrecnum() {
           return $this->recnum;
    }
    function setrecnum ($e_recnum) {
           $this->recnum = $e_recnum;
    }

    function getrefno() {
           return $this->refno;
    }
    function setrefno($e_refno) {
           $this->refno = $e_refno;
    }

    function getordernum() {
           return $this->ordernum;
    }
    function setordernum($e_ordernum) {
           $this->ordernum = $e_ordernum;
    }

    function getname() {
           return $this->name;
    }
    function setname($e_name) {
           $this->name = $e_name;
    }


    function getquoterefnum() {
           return $this->quoterefnum;
    }
    function setquoterefnum($e_quoterefnum) {
           $this->quoterefnum = $e_quoterefnum;
    }

    function getorderfor() {
           return $this->orderfor;
    }
    function setorderfor($e_orderfor) {
           $this->orderfor = $e_orderfor;
    }

    function getordertype() {
           return $this->ordertype;
    }
    function setordertype($e_ordertype) {
           $this->ordertype = $e_ordertype;
    }

    function getnumofparts() {
           return $this->numofparts;
    }
    function setnumofparts($e_numofparts) {
           $this->numofparts= $e_numofparts;
    }

    function getattachment1() {
           return $this->attachment1;
    }
    function setattachment1($e_attachment1) {
           $this->attachment1= $e_attachment1;
    }


    function getrawmaterial() {
           return $this->rawmaterial;
    }
    function setrawmaterial($e_rawmaterial) {
           $this->rawmaterial = $e_rawmaterial;
    }

    function getsource() {
           return $this->source;
    }
    function setsource($e_source) {
           $this->source = $e_source;
    }

    function getparts_class() {
           return $this->parts_class;
    }
    function setparts_class($e_parts_class) {
           $this->parts_class = $e_parts_class;
    }

    function getresources() {
           return $this->resources;
    }
    function setresources ($e_resources) {
           $this->resources = $e_resources;
    }

    function getqualityreq() {
           return $this->qualityreq;
    }
    function setqualityreq($e_qualityreq) {
           $this->qualityreq = $e_qualityreq;
    }

    function getsaliant() {
           return $this->saliant;
    }
    function setsaliant($e_saliant) {
           $this->saliant = $e_saliant;
    }

    function getaditional_resources() {
           return $this->aditional_resources;
    }
    function setaditional_resources($e_aditional_resources) {
           $this->aditional_resources = $e_aditional_resources;
    }


    function getsubcontract() {
           return $this->subcontract;
    }
    function setsubcontract($e_subcontract) {
           $this->subcontract = $e_subcontract;
    }

    function getspecial_process() {
           return $this->special_process;
    }
    function setspecial_process($e_special_process) {
           $this->special_process = $e_special_process;
    }

    function getdelivery_req() {
           return $this->delivery_req;
    }
    function setdelivery_req($e_delivery_req) {
           $this->delivery_req = $e_delivery_req;
    }

    function getperson() {
           return $this->person;
    }
    function setperson($e_person) {
           $this->person= $e_person;
    }

    function getenq_answeredby() {
           return $this->enq_answeredby;
    }
    function setenq_answeredby($e_enq_answeredby) {
           $this->enq_answeredby= $e_enq_answeredby;
    }

    function getquotation() {
           return $this->quotation;
    }
    function setquotation($e_quotation) {
           $this->quotation= $e_quotation;
    }

    function getdata_for_quote() {
           return $this->data_for_quote;
    }
    function setdata_for_quote($e_data_for_quote) {
           $this->data_for_quote = $e_data_for_quote;
    }

    function getdata_store() {
           return $this->data_store;
    }
    function setdata_store($e_data_store) {
           $this->data_store = $e_data_store;
    }

    function getpath() {
           return $this->path;
    }
    function setpath($e_path) {
           $this->path = $e_path;
    }

    function getquotation_det_store() {
           return $this->quotation_det_store;
    }
    function setquotation_det_store($e_quotation_det_store) {
           $this->quotation_det_store = $e_quotation_det_store;
    }
    
    
    function getrisk_factors() {
           return $this->risk_factors;
    }
    function setrisk_factors($e_risk_factors) {
           $this->risk_factors = $e_risk_factors;
    }

    function getrequirements() {
           return $this->requirements;
    }
    function setrequirements($e_requirements) {
           $this->requirements = $e_requirements;
    }

    function getexplainrisk_factors() {
           return $this->explainrisk_factors;
    }
    function setexplainrisk_factors($e_explain_risk_factors) {
           $this->explain_risk_factors = $e_explain_risk_factors;
    }

    function getquote_sentby() {
           return $this->quote_sentby;
    }
    function setquote_sentby($e_quote_sentby) {
           $this->quote_sentby = $e_quote_sentby;
    }

    function getorddate() {
           return $this->orddate;
    }
    function setorddate($e_orddate) {
           $this->orddate = $e_orddate;
    }

    function getquote_date() {
           return $this->quote_date;
    }
    function setquote_date($e_quote_date) {
           $this->quote_date = $e_quote_date;
    }

    function getquote_path() {
           return $this->quote_path;
    }
    function setquote_path($e_quote_path) {
           $this->quote_path = $e_quote_path;
    }
    function getenquiry_path() {
           return $this->enquiry_path;
    }
    function setenquiry_path($e_enquiry_path) {
           $this->enquiry_path = $e_enquiry_path;
    }
    function getdata_for_enquiry() {
           return $this->data_for_enquiry;
    }
    function setdata_for_enquiry($e_data_for_enquiry) {
           $this->data_for_enquiry = $e_data_for_enquiry;
    }
    
    function setamendment_num($amendment_num) {
           $this->amendment_num = $amendment_num;
    }
    
    function setamendment_date($amendment_date) {
           $this->amendment_date = $amendment_date;
    }
    function setspecial_instrns($special_instrns) {
           $this->special_instrns = $special_instrns;
    }
     function getorderstatus() {
           return $this->orderstatus;
    }
    function setorderstatus($orderstatus) {
           $this->orderstatus = $orderstatus;
    }
    function getvalstatus() {
           return $this->val_status;
    }
    function setvalstatus($valstatus) {
           $this->val_status = $valstatus;
    }
     function getengineering_approved() {
           return $this->engineering_approved;
    }
    function setengineering_approved($engineering_approved) {
           $this->engineering_approved = $engineering_approved;
    }
     function getcreate_date() {
           return $this->create_date;
    }
    function setcreate_date($create_date) {
           $this->create_date = $create_date;
    }
     function getcreated_by() {
           return $this->created_by;
    }
    function setcreated_by($created_by) {
           $this->created_by = $created_by;
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
	function getprodn_app() {
           return $this->prodn_app;
    }
    function setprodn_app($prodn_app) {
           $this->prodn_app = $prodn_app;
    }

	function getprodn_app_by() {
           return $this->prodn_app_by;
    }
    function setprodn_app_by ($prodn_app_by) {
           $this->prodn_app_by = $prodn_app_by;
    }


    function addreview($inrefno) {
        //echo $inrefno;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'contract_review' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed for Review..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        if($inrefno == '')
          $refno = $objid;
        else
        {
          $refno  = "'" .   $inrefno . "'";
        }
        $quoterefnum = "'" . $this->quoterefnum . "'";
        $orddate = "'" . ($this->orddate ? $this->orddate : '0000-00-00') . "'";
        $ordernum = "'" . $this->ordernum . "'";
        $orderfor = "'" . $this->orderfor . "'";
        $ordertype = "'" . $this->ordertype . "'";
        $name = "'" . $this->name . "'";
        $numofparts = "'" . $this->numofparts . "'";
        $attachment1 = "'" . $this->attachment1 . "'";
        $rawmaterial = "'" . $this->rawmaterial . "'";
        $source="'" . $this->source . "'";
        $parts_class = "'" . $this->parts_class . "'";
        $resources = "'" . $this->resources . "'";
        $qualityreq = "'" . $this->qualityreq . "'";
        $saliant = "'" . $this->saliant . "'";
        $aditional_resources = "'" . $this->aditional_resources . "'";
        $investment = "'" . $this->investment . "'";
        $subcontract = "'" . $this->subcontract . "'";
        $special_process= "'" . $this->special_process . "'";
        $delivery_req = "'" . $this->delivery_req. "'";
        $person = "'" . $this->person . "'";
        $enq_answeredby = "'" . $this->enq_answeredby . "'";
        $quotation = "'" . $this->quotation . "'";
        $data_for_quote = "'" . $this->data_for_quote . "'";
        $data_store = "'" . $this->data_store . "'";
        $path = "'" . $this->path . "'";
        $quotation_det_store = "'" . $this->quotation_det_store . "'";
        $risk_factors = "'" . $this->risk_factors . "'";
        $requirements="'" . $this->requirements . "'";
        $quote_sentby = "'" . $this->quote_sentby . "'";
        $explain_risk_factors ="'" . $this->explain_risk_factors . "'";
        $due_date = "'" . ($this->due_date ? $this->due_date : '0000-00-00') . "'";
        $quote_date = "'" . ($this->quote_date ? $this->quote_date : '0000-00-00') . "'";
        $quote_path = "'" . $this->quote_path . "'";
        $data_for_enquiry = "'" . $this->data_for_enquiry . "'";
        $enquiry_path = "'" . $this->enquiry_path . "'";
        $amendment_num = "'" . $this->amendment_num . "'";
        //$amendment_date = "'" . $this->amendment_date . "'";
        $amendment_date = "'" . ($this->amendment_date ? $this->amendment_date : '0000-00-00') . "'";
        $create_date = "'" . $this->create_date . "'";
        $created_by = "'" . $this->created_by . "'";
        $qa_approved = "'" . $this->qa_approved . "'";
        $engineering_approved = "'" . $this->engineering_approved . "'";
        $special_instrns = "'" . $this->special_instrns . "'";
        $qa_app = "'" . $this->qa_app_by . "'";
        $eng_app = "'" . $this->eng_app_by . "'";
        $status = "'Open'";
        $validation_status = "'NO'";
		    $prodn_app = "'" . $this->prodn_app . "'";
        $prodn_app_by = "'" . $this->prodn_app_by . "'";

             $sql = "INSERT INTO
                        contract_review
                            (
                            recnum,refno,order_date, name,ordernum, ordertype,
                            numofparts,attachment1,quoterefnum,
                            rawmaterial,source,class,resources,qualityreq,saliant,
                            aditional_resources,investment,subcontract,
                            special_process,delivery_req,person,enq_answeredby,quotation,
                            data_for_quote,data_store,path,
                            quotation_det_store,risk_factors,requirements, quote_sentby,
                            explain_risk_factors, due_date, quote_date,
                            quote_path, enquiry_path,data_for_enquiry,orderfor,formrev,
                            amendment_num,amendment_date,special_instrns,status,val_status,create_date,created_by,qa_approved,engineering_approved,qa_app_by,engg_app_by,prodn_approved,prodn_app_by
                            )
                    VALUES
                            (
                            $objid,$refno,$orddate,$name,$ordernum,$ordertype,
                            $numofparts,$attachment1, $quoterefnum,
                            $rawmaterial,$source,$parts_class,$resources,$qualityreq,$saliant,
                            $aditional_resources,$investment,$subcontract,
                            $special_process,$delivery_req,$person,$enq_answeredby,$quotation,
                            $data_for_quote,$data_store,$path,
                            $quotation_det_store,$risk_factors,$requirements,$quote_sentby,
                            $explain_risk_factors, $due_date, $quote_date,
                            $quote_path, $enquiry_path, $data_for_enquiry,$orderfor, 'F3003-Rev No.:1',
                            $amendment_num,$amendment_date,$special_instrns,$status,$validation_status,$create_date,$created_by,$qa_approved,$engineering_approved,$qa_app,$eng_app,$prodn_app,$prodn_app_by
                            )";

              // echo $sql;exit;
              $result = mysql_query($sql);

             // Test to make sure query worked
               if(!$result) die("Insert to review didn't work..Please report to Sysadmin. " . mysql_error());
            $sql = "update seqnum set nxtnum = $objid where tablename = 'contract_review'";
            $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work for Review..Please report to Sysadmin. " . mysql_error());

        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum commit failed for Review Insert..Please report to Sysadmin. " . mysql_error());
        return $objid;
     }
     


     function getreviews() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $wcond = $cond;
        $sort = $sort1;
        $offset= $argoffset;
        $limit= $arglimit;
         $sql = "select recnum,refno,name,ordernum,order_date,ordertype,
                      attachment1,risk_factors,person,quoterefnum,
					  special_instrns, amendment_num, amendment_date,
					  ordertype
                  FROM contract_review
                  where val_status = 'Yes'
                  and qa_approved = 'yes'
                  and engineering_approved = 'yes'
                  and status = 'Open'
                  order by recnum";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;

     }
     
     function getordercount($ordernumber) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select count(*) from contract_review where ordernum like'$ordernumber%'";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;
     }
     
     function getrefcount($refnumber) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select count(*) from contract_review where refno like'$refnumber%'";
        $result = mysql_query($sql);
       // echo "$sql";
        return $result;

     }

     function getreviewsummary($cond,$argoffset,$sort1,$arglimit) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $wcond = $cond;
        $sort = $sort1;
        $offset= $argoffset;
        $limit= $arglimit;
         $sql = "select recnum,refno,name,ordernum,order_date,ordertype,
                      attachment1,risk_factors,person,quoterefnum,
					  special_instrns, amendment_num, amendment_date,
					  ordertype,status
                  FROM contract_review
				  where $wcond 
				  order by refno limit $offset, $limit";
		//echo "$sql";
        $result = mysql_query($sql);
        
        return $result;

     }


     function getgoodrich() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $wcond = $cond;
        $sort = $sort1;
        $offset= $argoffset;
        $limit= $arglimit;
         $sql = "select recnum,refno,name,ordernum,order_date,ordertype,
                      attachment1,risk_factors,person,quoterefnum,
		      special_instrns, amendment_num, amendment_date,
		      ordertype
                  FROM contract_review where name like 'Goodrich%'";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;

     }



     function getreview($reviewrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

       $sql = " select c.recnum,c.refno,c.ordernum, c.order_date,c.name,c.quoterefnum,
                       c.numofparts,c.attachment1,c.orderfor,c.ordertype,
                            c.rawmaterial,c.source,c.class,c.resources,c.qualityreq,c.saliant,
                            c.aditional_resources,c.investment,c.subcontract,
                            c.special_process,c.delivery_req,c.person,c.enq_answeredby,c.quotation,
                            c.data_for_quote,c.data_store,c.path,c.quotation_det_store,c.risk_factors,
                            c.requirements, c.quote_sentby, c.explain_risk_factors,
                            c.due_date, c.quote_date, c.quote_path, c.enquiry_path,c.data_for_enquiry,c.formrev,
                            c.amendment_num,c.amendment_date,c.special_instrns,c.status,c.val_status,c.create_date,c.created_by,
							c.qa_approved,c.engineering_approved,c.qa_app_by,c.engg_app_by,e.fname,prodn_approved,prodn_app_by
            FROM contract_review c left join user u on (u.userid=c.created_by) left join employee e on (u.user2employee=e.recnum)
            where  c.recnum = $reviewrecnum";
        // echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("Select failed for getreview..Please report to Sysadmin. " . mysql_error());
        return $result;
     }

     function updatereview($reviewrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $quoterefnum = "'" . $this->quoterefnum . "'";
        $orddate = "'" . ($this->orddate ? $this->orddate : '0000-00-00') . "'";
        $ordernum = "'" . $this->ordernum . "'";
        $orderfor = "'" . $this->orderfor . "'";
        $ordertype = "'" . $this->ordertype . "'";
        $name = "'" . $this->name . "'";
        $numofparts = "'" . $this->numofparts . "'";
        $attachment1 = "'" . $this->attachment1 . "'";
        $rawmaterial = "'" . $this->rawmaterial . "'";
        $source="'" . $this->source . "'";
        $parts_class = "'" . $this->parts_class . "'";
        $resources = "'" . $this->resources . "'";
        $qualityreq = "'" . $this->qualityreq . "'";
        $saliant = "'" . $this->saliant . "'";
        $aditional_resources = "'" . $this->aditional_resources . "'";
        $investment = "'" . $this->investment . "'";
        $subcontract = "'" . $this->subcontract . "'";
        $special_process= "'" . $this->special_process . "'";
        $delivery_req = "'" . $this->delivery_req. "'";
        $person = "'" . $this->person . "'";
        $enq_answeredby = "'" . $this->enq_answeredby . "'";
        $quotation = "'" . $this->quotation . "'";
        $data_for_quote = "'" . $this->data_for_quote . "'";
        $data_store = "'" . $this->data_store . "'";
        $path = "'" . $this->path . "'";
        $quotation_det_store = "'" . $this->quotation_det_store . "'";
        $risk_factors = "'" . $this->risk_factors . "'";
        $requirements="'" . $this->requirements . "'";
        $quote_sentby = "'" . $this->quote_sentby . "'";
        $explain_risk_factors ="'" . $this->explain_risk_factors . "'";
        $due_date = "'" . ($this->due_date ? $this->due_date : '0000-00-00') . "'";
        $quote_date = "'" . ($this->quote_date ? $this->quote_date : '0000-00-00') . "'";
        $quote_path = "'" . $this->quote_path . "'";
        $data_for_enquiry = "'" . $this->data_for_enquiry . "'";
        $enquiry_path = "'" . $this->enquiry_path . "'";
        $amendment_num = "'" . $this->amendment_num . "'";
        $amendment_date = "'" . ($this->amendment_date ? $this->amendment_date : '0000-00-00') . "'";
        $special_instrns = "'" . $this->special_instrns . "'";
        $status = "'" . $this->orderstatus . "'";
        $validation_status = "'" . $this->val_status . "'";
        $create_date = "'" . $this->create_date . "'";
        $created_by = "'" . $this->created_by . "'";
        $qa_approved = "'" . $this->qa_approved . "'";
        $qa_app = "'" . $this->qa_app_by . "'";
        $eng_app = "'" . $this->eng_app_by . "'";
        $engineering_approved = "'" . $this->engineering_approved . "'";
 
          $sql = "UPDATE contract_review SET
                    order_date = $orddate,
                    name = $name,
               	    quoterefnum =$quoterefnum,
                    ordernum =$ordernum,
                    ordertype =$ordertype,
            	    orderfor=$orderfor,
                    numofparts = $numofparts,
                    attachment1 = $attachment1,
                    rawmaterial=$rawmaterial,
                    source=$source,
                    class=$parts_class,
                    resources=$resources,
                    qualityreq = $qualityreq,
                    saliant = $saliant,
                    aditional_resources = $aditional_resources,
            	    investment = $investment,
            	    subcontract =$subcontract ,
            	    special_process =$special_process,
            	    delivery_req=$delivery_req,
                    person = $person ,
                    enq_answeredby = $enq_answeredby,
                    quotation = $quotation,
                    data_for_quote= $data_for_quote ,
                    data_store=$data_store,
                    path=$path,
                    quotation_det_store=$quotation_det_store,
                    risk_factors=$risk_factors,
                    requirements=$requirements,
                    quote_date=$quote_date,
                    explain_risk_factors=$explain_risk_factors,
                    due_date=$due_date,
                    quote_path=$quote_path,
                    enquiry_path=$enquiry_path,
                    quote_sentby=$quote_sentby,
                    quote_date=$quote_date,
                    data_for_enquiry = $data_for_enquiry,
                    amendment_num = $amendment_num,
                    amendment_date = $amendment_date,
					special_instrns = $special_instrns,
					status = $status,
					val_status = $validation_status,
					create_date=$create_date,
					created_by=$created_by,
					qa_approved=$qa_approved,
					engineering_approved=$engineering_approved,
					qa_app_by=$qa_app,
					engg_app_by=$eng_app
        	WHERE
                    recnum = $reviewrecnum";
           //echo $sql;
           $result = mysql_query($sql);

           if(!$result)
           {
                     //header("Location:errorMessage.php?validate=Inv5");
                     die("Review update failed...Please report to SysAdmin. " . mysql_error());
           }
    }
    
    function upQaApp($reviewrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $qa_approved = "'" . $this->qa_approved . "'";
        $qa_app = "'" . $this->qa_app_by . "'";
        $eng_app = "'" . $this->eng_app_by . "'";
        $engineering_approved = "'" . $this->engineering_approved . "'";
		$prodn_app = "'" . $this->prodn_app . "'";
		$prodn_app_by = "'" . $this->prodn_app_by . "'";

        $sql = "UPDATE contract_review SET
					qa_approved=$qa_approved,
					engineering_approved=$engineering_approved,
					qa_app_by=$qa_app,
					engg_app_by=$eng_app,
                    prodn_approved=$prodn_app,
					prodn_app_by=$prodn_app_by

        	WHERE   recnum = $reviewrecnum";
           //echo $sql;
           $result = mysql_query($sql);

           if(!$result)
           {
                     //header("Location:errorMessage.php?validate=Inv5");
                     die("Review update failed...Please report to SysAdmin. " . mysql_error());
           }
    }
    
    function updateval_status($reviewrecnum)
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "update contract_review set val_status='Yes' where recnum = $reviewrecnum";
       $result = mysql_query($sql);
      // echo $sql;
       if(!$result)
       {
            die("Validation update failed...Please report to SysAdmin. " . mysql_error());
       }
    
    }


    function deleteenquiry($enquiryrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from contract_enquiry where recnum = $enquiryrecnum";
        $result = mysql_query($sql);
        if(!$result)
        {
         //header("Location:errorMessage.php?validate=Inv6");
         die("Delete for enquiry failed...Please report to SysAdmin. " . mysql_error());
        }
      }

 function ftp_copy($source_file,$destination_file)
 {
	$ftp_server='ftp.fluentsoft.com';
	$ftp_user='bmandyam@fluentsoft.com';
	$ftp_password='dci1034';
	$conn_id=ftp_connect($ftp_server);
	$login_result=ftp_login($conn_id,$ftp_user,$ftp_password);
	if (( !$conn_id ) || ( !$login_result ))
	{
		die("FTP connection Failed");
	}
	$upload=ftp_put($conn_id,$destination_file,$source_file,FTP_BINARY);
	ftp_close($conn_id);
	if(!$upload)
	{
		die("FTP copy has failed");
	}
 }
   
 function getreviewCount($cond,$argoffset,$arglimit)
 {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $wcond = $cond;
       $offset = $argoffset;
       $limit = $arglimit;
       $sql = "select count(recnum) as numrows
               from contract_review where $wcond 
			   limit $offset, $limit";
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       //echo "$sql";
       $result  = mysql_query($sql) or die(' contract_review count query failed');
       $row     = mysql_fetch_array($result, MYSQL_ASSOC);
       $numrows = $row['numrows'];
       return $numrows;
  }
//--------------------------------------------------Add Notes------------------------------------------------------------------
function addNotes($reviewrecnum,$notes)
{
        $newlogin = new userlogin;
        $newlogin->dbconnect();        
        $userid = $_SESSION['user'];
        $user2notes = "'" . $userid . "'";      
        $review_notes = "'" . $notes . "'";
		
        if($_SESSION[department] == 'Sales')
	    {
		   $dept='NULL';
     	}
		if($_SESSION[department] == 'QA')
	    {
		   $dept='qa';
     	} 
		if($_SESSION[department] == 'CAD' || $_SESSION[department] == 'ENGAPP')
	    {
		   $dept='eng';
     	}
		if($_SESSION[department] == 'Production')
	    {
		   $dept='prodn';
     	}
		if($_SESSION[department] == 'PPC' || $_SESSION[department] == 'PPC1' || $_SESSION[department] == 'PPC2')
	    {
		   $dept='ppc';
     	}
		if( $_SESSION[department] == 'PRODNAPP')
	    {
			$dept='prodnapp';
		}

        $sql = "INSERT INTO review_notes (notes,notes2review,stamp_created,stamp_updated,notes2user,dept)
               VALUES ($review_notes,$reviewrecnum,now(),now(),$user2notes,'$dept')";
       // echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Insert of Review Notes didn't work. " . mysql_error());
}
function getNotes_old($reviewrecnum)
{
        //Connect to database
        $newlogin = new userlogin;
       $newlogin->dbconnect();
        $sql = "select notes,stamp_created,notes2user from review_notes
                where notes2review=$reviewrecnum
                order by stamp_created";
        //echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Get Review Notes didn't work. " . mysql_error());
       return $result;
}
//with date add function--
function getNotes($reviewrecnum)
{
        //Connect to database
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select r.notes, DATE_ADD(r.stamp_created, INTERVAL '13:00' HOUR_MINUTE),
                        e.fname
                from review_notes r, employee e, user u
                where notes2review=$reviewrecnum and
                      u.userid = r.notes2user and
                      u.user2employee = e.recnum and 
                      (r.dept='NULL' or r.dept = '' or r.dept = 'Sales')
                order by stamp_created";
       //echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Get Review Notes didn't work. " . mysql_error());
       return $result;
} 
function getNotes_type($reviewrecnum,$depts)
{
        //Connect to database
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select r.notes, DATE_ADD(r.stamp_created, INTERVAL '13:00' HOUR_MINUTE),
                        e.fname
                from review_notes r, employee e, user u
                where notes2review=$reviewrecnum and
                      u.userid = r.notes2user and
                      u.user2employee = e.recnum and
					    r.dept like '$depts'
                order by stamp_created";
       //echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Get Review Notes didn't work. " . mysql_error());
       return $result;
} 
//without dateadd function---
/*
function getNotes($reviewrecnum)
{
        //Connect to database
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select r.notes, r.stamp_created,
                        e.fname
                from review_notes r, employee e, user u
                where notes2review=$reviewrecnum and
                      u.userid = r.notes2user and
                      u.user2employee = e.recnum
                order by stamp_created";
        //echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Get Review Notes didn't work. " . mysql_error());
       return $result;
}
*/

} // End invoice class definition

