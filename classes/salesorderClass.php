<?
//====================================
// Author: FSI
// Date-written = July 05, 2006
// Filename: salesorderClass.php
// Maintains the class for Quotes
// Revision: v1.0
//====================================
include_once('loginClass.php');
class salesorder 
{
    var
    $recnum,
    $so2customer,
    $so2contact,
    $description,
    $sales_order,
    $order_date,
    $due_date,
    $special_instruction,
    $phone,
    $email,
    $address,
    $city,
    $state,
    $zipcode,
    $country,
    $quote_num,
    $po_num,
    $grosstotal,
    $rmtotal,
    $mctotal,
    $tax,
    $shipping,
    $labor,
    $salesperson,
    $status,
    $total_due,
    $currency,
    $resellnum,
    $partnum,
    $partname,
    $partiss,
    $drgiss,
    $rmtype,
    $rmspec,
    $rmcode,
    $attach1,
    $attach2,
    $quotedate,
    $reviewrefrecnum,
    $contact,
    $amendment,
    $amendment_num,
    $amendment_date,
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
    function salesorder() {
        $this->recnum = '';
        $this->so2customer = '';
        $this->so2contact = '';
        $this->description = '';
        $this->sales_order = '';
        $this->order_date = '';
        $this->due_date = '';
        $this->special_instruction = '';
        $this->contact = '';
        $this->phone = '';
        $this->email = '';
        $this->address = '';
        $this->city= '';
        $this->state= '';
        $this->zipcode= '';
        $this->country= '';
        $this->quote_num= '';
        $this->ponum= '';
        $this->grosstotal= '';
        $this->rmtotal= '';
        $this->mctotal= '';
        $this->tax= '';
        $this->shipping= '';
        $this->labor= '';
        $this->total_due= '';
        $this->so2employee='';
        $this->status='';
        $this->currency='';
        $this->resellnum='';
        $this->partnum;
        $this->partname;
        $this->partiss;
        $this->drgiss;
        $this->rmspec;
        $this->rmtype;
        $this->rmcode;
        $this->attach1;
        $this->attach2;
        $this->reviewrefrecnum;
        $this->quotedate;
        $this->amendment;
        
        
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
           return $this->getrecnum;
    }

    function setrecnum ($req_recnum) {
           $this->recnum = $req_recnum;
    }

    function getso2customer() {
           return $this->so2customer;
    }

    function setso2customer ($req_so2customer) {
           $this->so2customer = $req_so2customer;
    }
    function getso2contact() {
           return $this->so2contact;
    }

    function setso2contact ($req_so2contact) {
           $this->so2contact = $req_so2contact;
    }

    function getso2employee() {
           return $this->so2employee;
    }

    function setso2employee ($reqso2employee) {
           $this->so2employee = $reqso2employee;
    }

    function getdescription() {
           return $this->description;
    }

    function setdescription ($reqdescription) {
           $this->description = $reqdescription;
    }
    function getcontact() {
           return $this->contact;
    }

    function setcontact ($reqcontact) {
           $this->contact = $reqcontact;
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

    function getsales_order() {
           return $this->sales_order;
    }

    function setsales_order ($sales_order) {
           $this->sales_order = $sales_order;
    }
    function getorder_date() {
           return $this->order_date;
    }

    function setorder_date ($reqorder_date) {
           $this->order_date= $reqorder_date;
    }
    function getdue_date() {
           return $this->due_date;
    }

    function setdue_date($due_date) {
           $this->due_date= $due_date;
    }
    function getspecial_instruction() {
           return $this->special_instruction;
    }

    function setspecial_instruction ($special_instruction) {
           $this->special_instruction = $special_instruction;
    }
    function getaddress() {
           return $this->address;
    }

    function setaddress ($address) {
           $this->address = $address;
    }

    function getcity() {
           return $this->city;
    }

    function setcity ($city) {
           $this->city = $city;
    }
     function getstate() {
           return $this->state;
    }

    function setstate ($state) {
           $this->state = $state;
    }

    function getzipcode() {
           return $this->zipcode;
    }

    function setzipcode ($zipcode) {
           $this->zipcode = $zipcode;
    }

    function getcountry() {
           return $this->country;
    }

    function setcountry ($country) {
           $this->country = $country;
    }

    function getquote_num() {
           return $this->quote_num;
    }

    function setquote_num ($quote_num) {
           $this->quote_num = $quote_num;
    }

    function getponum() {
           return $this->ponum;
    }

    function setponum ($ponum) {
           $this->ponum = $ponum;
    }

    function getgrosstotal() {
           return $this->grosstotal;
    }

    function setgrosstotal ($grosstotal) {
           $this->grosstotal = $grosstotal;
    }
    function getrmtotal() {
           return $this->rmtotal;
    }

    function setrmtotal ($rmtotal) {
           $this->rmtotal = $rmtotal;
    }
    function getmctotal() {
           return $this->mctotal;
    }

    function setmctotal ($mctotal) {
           $this->mctotal = $mctotal;
    }
    function gettax() {
           return $this->tax;
    }

    function settax ($tax) {
           $this->tax = $tax;
    }

    function getshipping() {
           return $this->shipping;
    }

    function setshipping ($shipping) {
           $this->shipping = $shipping;
    }

    function getlabor() {
           return $this->labor;
    }

    function setlabor ($labor) {
           $this->labor = $labor;
    }

    function gettotal_due() {
           return $this->total_due;
    }

    function settotal_due ($total_due) {
           $this->total_due = $total_due;
    }
    function getstatus() {
           return $this->status;
    }

    function setstatus ($status) {
           $this->status = $status;
    }

    function getcurrency() {
           return $this->currency;
    }

    function setcurrency ($reqcurrency) {
           $this->currency = $reqcurrency;
    }

    function getresellnum() {
           return $this->resellnum;
    }

    function setresellnum($resellnum) {
           $this->resellnum = $resellnum;
    }

    function setpartnum ($partnum) {
           $this->partnum = $partnum;
    }

    function getpartnum () {
           return $this->partnum;
    }

    function setpartname ($partname) {
           $this->partname = $partname;
    }

    function getpartname () {
           return $this->partname;
    }

    function setpartiss ($partiss) {
           $this->partiss = $partiss;
    }

    function getpartiss () {
           return $this->partiss;
    }

    function setdrgiss ($drgiss) {
           $this->drgiss = $drgiss;
    }

    function getdrgiss () {
           return $this->drgiss;
    }

    function setrmtype ($rmtype) {
           $this->rmtype = $rmtype;
    }

    function getrmtype () {
           return $this->rmtype;
    }
    function setrmspec ($rmspec) {
           $this->rmspec = $rmspec;
    }

    function getrmspec () {
           return $this->rmspec;
    }
    function setrmcode ($rmcode) {
           $this->rmcode = $rmcode;
    }

    function getrmcode () {
           return $this->rmcode;
    }
    function setattach1 ($attach1) {
           $this->attach1 = $attach1;
    }

    function getattach1 () {
           return $this->attach1;
    }
    function setattach2 ($attach2) {
           $this->attach2 = $attach2;
    }

    function getquotedate () {
           return $this->quotedate;
    }
    function setquotedate ($quotedate) {
           $this->quotedate = $quotedate;
    }
    function getreviewrefrecnum () {
           return $this->reviewrefrecnum;
    }
    function setreviewrefrecnum ($reviewrefrecnum) {
           $this->reviewrefrecnum = $reviewrefrecnum;
    }

    function getattach2 () {
           return $this->attach2;
    }
    
    function setamendment($amendment) {
           $this->amendment = $amendment;
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



     function addSalesorder() {
       //echo "I am here";

        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'sales_order' for update";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        // echo $objid;
        $order_date = "'" . $this->order_date . "'";
        $due_date = "'" . ($this->due_date ? $this->due_date : '0000-00-00') . "'";
        $so2contact = $this->so2contact ? $this->so2contact : 0;
        $so2customer= $this->so2customer ? $this->so2customer : 0; 
        $so2employee = $this->so2employee ? $this->so2employee :0;
        $phone = "'" . $this->phone . "'";
        $email = "'" . $this->email . "'";
        $description = "'" . $this->description . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $sales_order = "'" . $this->sales_order . "'";
        $special_instruction = "'" . $this->special_instruction . "'";
        $address="'" . $this->address . "'";
        $city = "'" . $this->city . "'";
        $state = "'" . $this->state . "'";
        $zipcode = "'" . $this->zipcode . "'";
        $country = "'" . $this->country . "'";
        $quote_num = "'" . $this->quote_num . "'";
        $ponum = "'" . $this->ponum . "'";
        $grosstotal = "'" . $this->grosstotal . "'";      
        $rmtotal = "'" . $this->rmtotal . "'";
        $mctotal = "'" . $this->mctotal . "'";
        $tax = "'" . $this->tax . "'";
        $labor = "'" . $this->labor . "'";
        $shipping = "'" . $this->shipping . "'";
        $total_due = "'" . $this->total_due . "'";
        $status = "'" . $this->status . "'";
        $currency = "'" . $this->currency . "'";
        $resellnum = "'" . $this->resellnum . "'";
        $attach1 = "'" . $this->attach1 . "'";
        $attach2 = "'" . $this->attach2 . "'";
        $quotedate = "'" . ($this->quotedate ? $this->quotedate : '0000-00-00') . "'";
        $contact = "'" . $this->contact . "'";
        $amendment_num = "'" . $this->amendment_num . "'";
        $amendment_date = "'" . $this->amendment_date . "'";
        // $reviewrefrecnum = $link2review;
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
        $siteid= "'" . $_SESSION['siteid'] . "'";
        // $sql = "select * from sales_order where recnum = $objid";
        $sql = "select * from sales_order where po_num = $ponum";
        //echo $sql;
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                   sales_order
                   (
                     recnum, so2customer, so2contact, so2employee, description,
                     sales_order, order_date, due_date, special_instruction,
                     phone, email, address, city, state, zipcode, country,
                     quote_num, po_num, grosstotal, tax,shipping,labor,total_due,
                     currency,resellnum, attach1,attach2, quote_date,contact, 
                     rmtotal,mctotal, amendment_num, amendment_date,formatnum,formatrev,
                     status,siteid,
                      name,ordernum, ordertype,
                            numofparts,attachment1,quoterefnum,
                            rawmaterial,source,class,resources,qualityreq,saliant,
                            aditional_resources,investment,subcontract,
                            special_process,delivery_req,person,enq_answeredby,quotation,
                            data_for_quote,data_store,path,
                            quotation_det_store,risk_factors,requirements, quote_sentby,
                            explain_risk_factors,  
                            quote_path, enquiry_path,data_for_enquiry,orderfor,formrev,
                            special_instrns,val_status,create_date,created_by,qa_approved,engineering_approved,qa_app_by,engg_app_by,prodn_approved,prodn_app_by
                   )
                   VALUES
                   (
                     $objid, $so2customer,$so2contact,$so2employee,$description,
                     $sales_order,$order_date,$due_date,$special_instruction,
                     $phone,$email,$address,$city,$state,$zipcode, $country,
                     $quote_num,$ponum,$grosstotal,$tax,$shipping,$labor,$total_due,
                     $currency,$resellnum,$attach1,$attach2,$quotedate,$contact,
                      $rmtotal, $mctotal, $amendment_num, $amendment_date,'F3003','Rev 1 dt Jul 10,2009',
                     'Pending',$siteid,$name,$ordernum,$ordertype,
                            $numofparts,$attachment1, $quoterefnum,
                            $rawmaterial,$source,$parts_class,$resources,$qualityreq,$saliant,
                            $aditional_resources,$investment,$subcontract,
                            $special_process,$delivery_req,$person,$enq_answeredby,$quotation,
                            $data_for_quote,$data_store,$path,
                            $quotation_det_store,$risk_factors,$requirements,$quote_sentby,
                            $explain_risk_factors, 
                            $quote_path, $enquiry_path, $data_for_enquiry,$orderfor, 'F3003-Rev No.:1',
                            $special_instrns,$validation_status,$create_date,$created_by,$qa_approved,$engineering_approved,$qa_app,$eng_app,$prodn_app,$prodn_app_by )";
          // echo "\n" . $sql;exit;
                             mysql_query('SET SQL_BIG_SELECTS=1');
           $result = mysql_query($sql) or die("Insert to SO didn't work..Please report to Sysadmin. " . mysql_error());
           // Test to make sure query worked
           if(!$result) {
              $sql = "rollback";
              $result = mysql_query($sql);
              die("Insert to SO didn't work..Please report to Sysadmin. " . mysql_error());
           }
         }
         else
         {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Sales order ID " . $ponum . " already exists. ");
         }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'sales_order'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result)
        {
           die("Update to seqnum for SO failed..Please report to Sysadmin. " . mysql_error());
        }
        $sql="commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed..Please report to Sysadmin. " . mysql_error());
        //echo " <br>objid: $objid<br>";
        return $objid;
     }
     
   function addamendment($sorecnum)
   {
     $amendment = "'" . $this->amendment . "'";
     $sql = "INSERT INTO amendment
               (
                 amendment, cr_date, link2so
               )
             VALUES
               (
                 $amendment, curdate(), $sorecnum
               )";
          // echo "\n" . $sql;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) {
              $sql = "rollback";
              $result = mysql_query($sql);
              die("Insert to amendment didn't work.. Please report to Sysadmin. " . mysql_error());
           }
           else
           {
              $sql = "commit";
              $result = mysql_query($sql);
           }
   }

 /*
   function getSalesorders($wcond){
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT sales_order.recnum, company.name, sales_order.description,  
                       sales_order.order_date, sales_order.po_num, sales_order.grosstotal,
                       sales_order.total_due, sales_order.currency, sales_order.contact,
                       sales_order.quote_num, sales_order.order_date, so_line_items.partnum,
                       so_line_items.qty, work_order.qty, work_order.wonum,
                       work_order.comp_qty,so_line_items.amount
                FROM company, so_line_items, sales_order
                left join so_line_items soli on sales_order.recnum = soli.link2so
                LEFT OUTER JOIN work_order ON
                replace(work_order.partnum,' ','') = replace(so_line_items.partnum,'-','')
                and sales_order.po_num = work_order.po_num
                where sales_order.so2customer = company.recnum and
                $wcond order by sales_order.recnum,so_line_items.partnum,work_order.wonum";
        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;
     }
	 */

   function getSalesorders($wcond){
     $newlogin = new userlogin;
        $newlogin->dbconnect();

        $siteid = $_SESSION['siteid'];
        $usertype = $_SESSION['usertype'];
        $role= $_SESSION['userrole'];
        $userid= $_SESSION['user'];
        $siteval = "sales_order.siteid = '" .$siteid. "'"; 
    	//echo "po num passed is $final_ponum";
        if($usertype == 'EMPL')
        {
          $sql ="SELECT sales_order.recnum as rec, company.name, sales_order.description, sales_order.order_date, sales_order.po_num, 
                        sales_order.grosstotal, sales_order.total_due, sales_order.currency, sales_order.contact, sales_order.quote_num, 
                        sales_order.order_date, soli.partnum, soli.qty, w.qty,w.wonum, w.comp_qty,soli.amount,soli.price, 
                        sales_order.status,w.recnum as worec,soli.crn_num,soli.line_num as ln
                  FROM sales_order, company, so_line_items soli
                  left join work_order w on 
                            w.po_num = soli.po_num and 
                            w.crn_num = soli.crn_num  and
                            w.`condition` != 'Cancelled' and
                            w.`condition` != 'WO Cancelled' and
                            ((w.cust_po_line_num !=  '' and
                            w.cust_po_line_num is not null and
                            w.cust_po_line_num =  soli.line_num) or 
                            (w.cust_po_line_num =  '' or w.cust_po_line_num is null))
                  where 
                           sales_order.so2customer = company.recnum and 
                           sales_order.recnum = soli.link2so and 
                           
                           $wcond and $siteval
                   order by rec,(ln+0),(worec+0)";

                   // echo $sql;

      }
      else
      {
        

            $sql="SELECT sales_order.recnum as rec,
                          company.name, sales_order.description, sales_order.order_date, sales_order.po_num, sales_order.grosstotal, sales_order.total_due, sales_order.currency, sales_order.contact, sales_order.quote_num, sales_order.order_date, soli.partnum, soli.qty, w.qty,w.wonum, w.comp_qty,soli.amount,soli.price, sales_order.status,w.recnum as worec,soli.crn_num,soli.line_num as ln 

              FROM sales_order, company,contact,user, so_line_items soli  left join work_order w on 
                            w.po_num = soli.po_num and 
                            w.crn_num = soli.crn_num  and
                            w.`condition` != 'Cancelled' and
                            w.`condition` != 'WO Cancelled' and
                            ((w.cust_po_line_num !=  '' and
                            w.cust_po_line_num is not null and
                            w.cust_po_line_num =  soli.line_num) or 
                            (w.cust_po_line_num =  '' or w.cust_po_line_num is null))
               where user.user2contact = contact.recnum and    
                     user.userid = '$userid' and 
                     sales_order.so2customer = company.recnum and 
                     sales_order.recnum = soli.link2so 
                     and company.recnum = contact.contact2company
                     and $wcond";
 // echo $sql;



      }

        // echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;

     }

    /* function getso4goodrich($wcond){
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql ="(SELECT sales_order.recnum as rec, company.name, sales_order.description,
                       sales_order.order_date, sales_order.po_num, sales_order.grosstotal,
                       sales_order.total_due, sales_order.currency, sales_order.contact,
                       sales_order.quote_num, sales_order.order_date, so_line_items.partnum as p,
                       so_line_items.qty, work_order.qty, work_order.wonum as wonum,
                       work_order.comp_qty,so_line_items.amount,so_line_items.price, sales_order.status,
		       r.qa_approved,r.engineering_approved,work_order.recnum as worec,so_line_items.crn_num,so_line_items.line_num as ln
                FROM sales_order, so_line_items, company,contract_review r, work_order, master_data m
                where (CASE WHEN (work_order.cust_po_line_num != '' && work_order.cust_po_line_num is not null) 
                            THEN work_order.cust_po_line_num = so_line_items.line_num 
                            ELSE work_order.link2masterdata = m.recnum and m.CIM_refnum = so_line_items.crn_num END) and 
		      sales_order.po_num = work_order.po_num and
                      sales_order.so2customer = company.recnum and
                      sales_order.recnum = so_line_items.link2so and
		      r.recnum=sales_order.link2review and

		      company.name like 'Goodrich Aero%' and
                      $wcond )
                UNION
                (SELECT sales_order.recnum, company.name, sales_order.description,
                       sales_order.order_date, sales_order.po_num, sales_order.grosstotal,
                       sales_order.total_due, sales_order.currency, sales_order.contact,
                       sales_order.quote_num, sales_order.order_date, so_line_items.partnum,
                       so_line_items.qty, work_order.qty, work_order.wonum,
                       work_order.comp_qty,so_line_items.amount,so_line_items.price, sales_order.status,
		       r.qa_approved,r.engineering_approved,work_order.recnum,so_line_items.crn_num,so_line_items.line_num as ln
                FROM company,contract_review r,so_line_items, sales_order
                LEFT JOIN work_order ON sales_order.po_num = work_order.po_num
                where
                work_order.po_num is null and
                sales_order.so2customer = company.recnum and
                sales_order.recnum = so_line_items.link2so and
		        r.recnum=sales_order.link2review and
		        company.name like 'Goodrich Aero%' and
                      $wcond )
				UNION
		        (SELECT sales_order.recnum as rec, company.name, sales_order.description,
                       sales_order.order_date, sales_order.po_num, sales_order.grosstotal,
                       sales_order.total_due, sales_order.currency, sales_order.contact,
                       sales_order.quote_num, sales_order.order_date, so_line_items.partnum as p,
                       so_line_items.qty, '','' as wonum,
                       '',so_line_items.amount,so_line_items.price, sales_order.status,
		        r.qa_approved,r.engineering_approved,'' as worec,so_line_items.crn_num,so_line_items.line_num as ln
                FROM sales_order, so_line_items, company,contract_review r
                where
                     so_line_items.partnum not in (select partnum from work_order w where w.po_num = sales_order.po_num) and
                     sales_order.so2customer = company.recnum and
                     sales_order.recnum = so_line_items.link2so and
		             r.recnum=sales_order.link2review and
		             company.name like 'Goodrich Aero%' and
                     $wcond )
                order by rec,(ln+0),(worec+0)";
        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;
     } */
     
     function getso4goodrich($wocond)
 {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql ="SELECT sales_order.recnum as rec, company.name, sales_order.description, sales_order.order_date, sales_order.po_num,
                       sales_order.grosstotal, sales_order.total_due, sales_order.currency, sales_order.contact, sales_order.quote_num,
                       sales_order.order_date, soli.partnum, soli.qty, w.qty,w.wonum, w.comp_qty,soli.amount,soli.price,
                       sales_order.status, r.qa_approved,r.engineering_approved,w.recnum as worec,soli.crn_num,soli.line_num as ln
                 FROM  sales_order, company,contract_review r, so_line_items soli
                 left join work_order w on
                           w.po_num = soli.po_num and
                           w.crn_num = soli.crn_num  and
                           ((w.cust_po_line_num !=  '' and
                           w.cust_po_line_num is not null and
                           w.cust_po_line_num =  soli.line_num) or
                           (w.cust_po_line_num =  '' or w.cust_po_line_num is null)) and
                           w.`condition` !='Cancelled' and w.`condition` != 'Hold'
                           and w.`condition` != 'WO Cancelled'
                where
                         sales_order.so2customer = company.recnum and
                         sales_order.recnum = soli.link2so and
                         r.recnum=sales_order.link2review and
                         company.name like 'Goodrich Aero%' and
                         $wocond
                 order by rec,(ln+0),(worec+0)";
        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;
 }

 function getSalesorder($salesorderrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT sales_order.recnum, company.name, sales_order.so2contact,
                  sales_order.description, sales_order.sales_order, sales_order.order_date,
                  sales_order.due_date, sales_order.special_instruction,
                  company.phone, company.email,
                  company.addr1, company.city, company.state, company.zipcode,
                  company.country, company.country, sales_order.po_num, 
                  sales_order.grosstotal,
                  sales_order.tax,sales_order.shipping,
                  sales_order.labor,sales_order.total_due,
                  company.country, company.country, sales_order.so2customer, 
                  sales_order.so2employee,
                  sales_order.quote_num,company.country, company.country,  
                  sales_order.email,sales_order.currency,
                  sales_order.po_num,company.country,resellnum,
                  sales_order.quote_date, sales_order.attach1, sales_order.attach2,
                  sales_order.contact, sales_order.phone, sales_order.quote_num,
                  sales_order.rmtotal, sales_order.mctotal, sales_order.amendment_num, sales_order.amendment_date,
                    sales_order.status,sales_order.link2review,sales_order.formatnum,sales_order.formatrev,
                    sales_order.ordernum,sales_order.quoterefnum,
                sales_order.numofparts,sales_order.attachment1,sales_order.orderfor,sales_order.ordertype,
                sales_order.rawmaterial,sales_order.source,sales_order.class,sales_order.resources,sales_order.qualityreq,sales_order.saliant,
                sales_order.aditional_resources,sales_order.investment,sales_order.subcontract,
                sales_order.special_process,sales_order.delivery_req,sales_order.person,sales_order.enq_answeredby,sales_order.quotation,
                sales_order.data_for_quote,sales_order.data_store,sales_order.path,sales_order.quotation_det_store,sales_order.risk_factors,
                sales_order.requirements, sales_order.quote_sentby, sales_order.explain_risk_factors,
                sales_order.due_date, sales_order.quote_date, sales_order.quote_path, sales_order.enquiry_path,sales_order.data_for_enquiry,sales_order.formrev,
                sales_order.amendment_num,sales_order.amendment_date,sales_order.special_instrns,sales_order.val_status,sales_order.create_date,sales_order.created_by,
                sales_order.qa_approved,sales_order.engineering_approved,sales_order.qa_app_by,sales_order.engg_app_by,sales_order.prodn_approved,sales_order.prodn_app_by
                FROM sales_order,company 
                where sales_order.so2customer = company.recnum and sales_order.recnum = $salesorderrecnum";
        // echo $sql;
                mysql_query('SET SQL_BIG_SELECTS=1');
        $result = mysql_query($sql);

        return $result;

     }
     
      function getamendment($salesorderrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "SELECT *
                FROM amendment
                where link2so = $salesorderrecnum";
        //echo $sql;
        $result = mysql_query($sql);

        return $result;

     }


     function updateSalesorder($salesorderrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $so2customer = "'" . $this->so2customer . "'";
        $so2employee = "'" . ($this->so2employee ? $this->so2employee : 0) . "'";
        $so2contact = "'" . ($this->so2contact ? $this->so2contact : 0) . "'";
        $phone = "'" . $this->phone . "'";
        $email = "'" . $this->email . "'";
        $description = "'" . $this->description . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $sales_order = "'" . $this->sales_order . "'";
        $order_date = "'" . $this->order_date . "'";
        $due_date = "'" . ($this->due_date ? $this->due_date : '0000-00-00') . "'";
        $quote_num="'" . $this->quote_num . "'";
        $po_num="'" . $this->po_num . "'";
        $grosstotal = "'" . $this->grosstotal. "'";
        $rmtotal = $this->rmtotal ? $this->rmtotal : 0;
        $mctotal = $this->mctotal ? $this->mctotal : 0;
        $tax = "'". $this->tax . "'"; 
        $total_due = "'" . $this->total_due . "'";
        $shipping = "'" . $this->shipping . "'";
        $labor = "'" . $this->labor . "'";
        $special_instruction = "'" . $this->special_instruction . "'";
        $address = "'" . $this->address . "'";
        $currency = "'" . $this->currency . "'";
        $resellnum = "'". $this->resellnum . "'";
        $ponum = "'" . $this->ponum . "'";
        $attach1 = "'" . $this->attach1 . "'";
        $attach2 = "'" . $this->attach2 . "'";
        $contact = "'" . $this->contact . "'";
        $quotedate = "'" . ($this->quotedate ? $this->quotedate : '0000-00-00') . "'";
        $reviewrefrecnum = "'".$this->reviewrefrecnum."'";
		$amendment_num = "'" . $this->amendment_num . "'";
        $amendment_date = "'" . $this->amendment_date . "'";
        $amendment = "'" . $this->amendment . "'";
		$status = "'" . $this->status . "'";
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
        
        $validation_status = "'" . $this->val_status . "'";
        $create_date = "'" . $this->create_date . "'";
        $created_by = "'" . $this->created_by . "'";
        $qa_approved = "'" . $this->qa_approved . "'";
        $qa_app = "'" . $this->qa_app_by . "'";
        $eng_app = "'" . $this->eng_app_by . "'";
        $engineering_approved = "'" . $this->engineering_approved . "'";


      
        $sql = "UPDATE sales_order SET
                    so2customer = $so2customer,
                    so2contact = $so2contact,
                    so2employee = $so2employee,
            	    description=$description,
            	    phone =$phone,
            	    email=$email,
            	    sales_order=$sales_order,
                    order_date = $order_date,
                    due_date = $due_date,
                    special_instruction= $special_instruction,
                    address=$address,
                    quote_num=$quote_num,
                    grosstotal = $grosstotal,
                    rmtotal = $rmtotal,
                    mctotal = $mctotal,
                    tax  = $tax,
                    total_due = $total_due,
                    shipping = $shipping,
                    labor = $labor,
                    resellnum = $resellnum,
                    attach1 = $attach1,
                    attach2 = $attach2,
                    quote_date = $quotedate,
                    contact = $contact,
                    link2review = $reviewrefrecnum,
					amendment_num = $amendment_num,
					amendment_date = $amendment_date,
					status = $status,
                    po_num = $ponum,
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
                   special_instrns = $special_instrns,
            val_status = $validation_status,
          create_date=$create_date,
          created_by=$created_by,

          qa_approved=$qa_approved,
          engineering_approved=$engineering_approved,
          qa_app_by=$qa_app,
          engg_app_by=$eng_app
        	WHERE
                    recnum = $salesorderrecnum";
        // echo $sql;exit;
                    mysql_query('SET SQL_BIG_SELECTS=1');
        $result = mysql_query($sql);

        if(!$result) die("Sales Order update failed...Please report to SysAdmin. " . mysql_error());
        }
        
        function updateSales4Status($salesorderrecnum)
       {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

		$status = "'" . $this->status . "'";
        $sql = "UPDATE sales_order SET
					status = $status
        	WHERE
                    recnum = $salesorderrecnum";
        //echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("Sales Order update failed...Please report to SysAdmin. " . mysql_error());
       }


     function deleteSalesorder($salesorderrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from sales_order where recnum = $salesorderrecnum";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Salesorder failed...Please report to SysAdmin. " . mysql_error());
      }

     //Function for search/sort coded by Jerry George 30 Dec -04
function getso($cond,$argsort1,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;
       $sql = "SELECT sales_order .recnum, company.name, so2contact,
                so2employee, description, sales_order, order_date,
                due_date, special_instruction,company.phone, company.email,
                company.addr1, company.city, company.state, company.zipcode,
                company.country, quote.id, po_num, grosstotal,
                tax,shipping,labor,total_due,employee.fname,employee.lname,sales_order .currency ,resellnum,
                sales_order.partnum, sales_order.partname, sales_order.partiss, 
                sales_order.drgiss,sales_order.rmtype, sales_order.rmspec, sales_order.rmcode, 
                sales_order.quote_date, sales_order.attach1, sales_order.attach2
        FROM sales_order
            LEFT OUTER JOIN employee ON (sales_order.so2employee = employee.recnum)
            LEFT OUTER JOIN company ON (sales_order.so2customer = company.recnum)
            LEFT OUTER JOIN contact ON (sales_order.so2contact = contact.recnum)
            LEFT OUTER JOIN quote ON (sales_order.quote_num = quote.recnum
                   where  $wcond ORDER by $sortorder limit $offset, $limit";
 //  echo "$sql";
       $result = mysql_query($sql);
       return $result;
}

//Function for pagination coded by Jerry George 30 Dec -04
   function getsoCount($cond,$argoffset,$arglimit)
   {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
             $sql = "select count(*) as numrows
                     from sales_order where  $wcond limit $offset, $limit";
       $newlogin = new userlogin;
       $newlogin->dbconnect();
   //echo "$sql";
   $result  = mysql_query($sql) or die('Emp count query failed');
   $row     = mysql_fetch_array($result, MYSQL_ASSOC);
   $numrows = $row['numrows'];
   //echo $numrows;
   return $numrows;
   }

   function getcompany()
   {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select  name
                 from company
                 where type = 'CUST' and
				      status = 'Active'
				 order by name ";
       $result = mysql_query($sql);
       return $result;
   }

   function getgoodrich()
   {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select  name
                 from company
                 where type = 'CUST' and
                       name = 'Goodrich Aerospace'";
       $result = mysql_query($sql);
       return $result;
   }
   function getso4cust($userid){
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['user'];
        $sql = "SELECT sales_order.recnum, company.name, sales_order.description,  
                       sales_order.order_date, sales_order.po_num, sales_order.grosstotal,
                       sales_order.total_due, sales_order.currency, sales_order.contact,
                       sales_order.quote_num, sales_order.currency
                FROM sales_order, company, user, contact
                where sales_order.so2customer = company.recnum and
                      user.userid = '$userid' and
                      user2contact = contact.recnum and
                      contact.contact2company = company.recnum";
        //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;
     }
// Added by Badari Mandyam
// Added to show disp qty in sales summary page
   function getdispatch_qty($wonum)
   {
      //echo $wonum;
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "SELECT wonum,sum(dispatch_qty)
              FROM dispatch_line_items
              where wonum = '$wonum' group by wonum";
      // echo $sql;
      $result = mysql_query($sql);
      return $result;
   }
   
   function getreviewDetails($orderno) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

       $sql = " select recnum,refno,ordernum,resources,
                       qualityreq,saliant,
                       aditional_resources,investment,subcontract,
                       special_process,delivery_req,person,enq_answeredby,quotation,
                       data_for_quote,data_store,path,quotation_det_store,risk_factors,
                       requirements, quote_sentby, explain_risk_factors
            FROM contract_review
            where  ordernum = '$orderno'";
        //echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("Get review Details failed..Please report to Sysadmin." . mysql_error());
        return $result;
     }
     
     function getrej_qty($wonum)
     {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select rej_qty,ret_qty,
                     cust_rej_qty
                 from work_order wo
                 where wo.wonum='$wonum' and
				 wo.`condition` != 'Cancelled' and
                 wo.`condition` != 'WO Cancelled'";
	  //echo $sql;
      $result = mysql_query($sql);
      if(!$result) die("Query failed for rejqty . " . mysql_error());
      return $result;
     }

     function getrej_qty_old($wonum)
   {
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     $sql = "select sum(wps.rej) from wo_part_status wps,work_order wo
             where  wo.recnum=wps.link2wo
                   and (wps.stage = 'final' or wps.stage = 'Final' or
                       wps.stage = 'FINAL' or wps.stage = 'fi' or
                       wps.stage = 'FI' or wps.stage = 'Fi')
                   and wo.wonum='$wonum'
             group by wo.wonum";
     $result = mysql_query($sql);
     if(!$result) die("Query failed for rejqty . " . mysql_error());
     return $result;
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

function getCRN4soli()
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
        $siteval = "md.siteid = '".$siteid."'";
        $sql ="select r.recnum,r.crnnum as crn_num,md.partnum,r.rm_spec,r.rm_dia,r.rm_ruling_dim,r.crnnum,
       		          r.rm_condition,r.rm_uom,r.rm_grainflow,r.rm_mrs,r.rm_unitprize,
       		          r.rm_supplier,r.rm_altrm,md.partname,r.length,
       		          r.width,r.thickness,md.drg_issue,md.cos,md.attachments,r.rm_unitprize,r.rm_type,r.rm_qty_perbill
              from rmmaster r ,master_data md
                  where r.rm_altrm='Primary Spec' and r.crnnum=md.CIM_refnum
                        and md.status = 'Active'
                        and rm_status='Active' and
                        r.siteid = md.siteid and $siteval

              UNION
                   select r.recnum,r.crnnum as crn_num,md.partnum,r.rm_spec,r.rm_dia,r.rm_ruling_dim,r.crnnum,
       		          r.rm_condition,r.rm_uom,r.rm_grainflow,r.rm_mrs,r.rm_unitprize,
       		          r.rm_supplier,r.rm_altrm,md.partname,r.length,
       		          r.width,r.thickness,md.drg_issue,md.cos,md.attachments,r.rm_unitprize,r.rm_type,r.rm_qty_perbill
                  from rmmaster r,master_data md
                        where r.rm_altrm='Alt Spec1' and r.crnnum=md.CIM_refnum
                        and md.status = 'Active'
                        and rm_status='Active' 
                        and r.siteid = md.siteid and $siteval

              UNION
                 select r.recnum,r.crnnum as crn_num,md.partnum,r.rm_spec,r.rm_dia,r.rm_ruling_dim,r.crnnum,
       		          r.rm_condition,r.rm_uom,r.rm_grainflow,r.rm_mrs,r.rm_unitprize,
       		          r.rm_supplier,r.rm_altrm,md.partname,r.length,
       		          r.width,r.thickness,md.drg_issue,md.cos,md.attachments,r.rm_unitprize,r.rm_type,r.rm_qty_perbill
                  from rmmaster r,master_data md
                       where r.rm_altrm='Alt Spec2' and r.crnnum=md.CIM_refnum
                        and md.status = 'Active'
                        and rm_status='Active' 
                        and r.siteid = md.siteid and $siteval

                order by crn_num";
        // echo $sql;
        $result = mysql_query($sql) or die("getCRN4soli failed...Please report to SysAdmin. " . mysql_error());
        return $result;

   }
   
   function getallcrn4soli()
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql="select so.crn_num,so.altspec,r.rm_qty_perbill,r.rm_unitprize,so.qty,sa.rmtotal
                     from so_line_items so,rmmaster r,sales_order sa
                          where
                          r.crnnum=so.crn_num and so.altspec=r.rm_altrm and sa.recnum=so.link2so";
        //echo $sql;
        $result=mysql_query($sql)or die("getallcrn4soli failed...Please report to SysAdmin. " . mysql_error());
        return $result;
   
   }
    function gettotrm_amount()
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql="select sum(so.rmamount) as total_rmamount,sa.recnum,sa.po_num
                     from so_line_items so,sales_order sa
                          where so.link2so=sa.recnum
                          group by sa.po_num";
        //echo $sql;
        $result=mysql_query($sql)or die("gettotrm_amount failed...Please report to SysAdmin. " . mysql_error());
        return $result;

   }
   
    function updateSoli_rmprice($rm_unit_price,$crn_num,$so_altspec,$rm_amount)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql="update so_line_items
                     set rmprice='$rm_unit_price',
                         rmamount= $rm_amount
                     where crn_num='$crn_num' and altspec='$so_altspec'";
        //echo $sql;
        $result=mysql_query($sql)or die("getallcrn4soli failed...Please report to SysAdmin. " . mysql_error());
        return $result;

   }
   

    function updateSo_rmamount($total_rm_amount,$po_num)
   {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql="update sales_order
                     set rmtotal='$total_rm_amount'
                     where po_num='$po_num'";
        //echo $sql;
        $result=mysql_query($sql)or die("getallcrn4soli failed...Please report to SysAdmin. " . mysql_error());
        return $result;

   }
   
   function getwotype4rej($wonum)
   {
       $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql="select w.treatment from work_order w where w.wonum='$wonum'";
        //echo $sql;
        $result=mysql_query($sql)or die("getwotype4rej failed...Please report to SysAdmin. " . mysql_error());
         $row     = mysql_fetch_array($result, MYSQL_ASSOC);
         $wo_type = $row['treatment'];
         //echo $numrows;
         return $wo_type;
   }

   function getrej_qty4treat($wonum)
     {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql = "select rej_qty,ret_qty,
                     cust_rej_qty
                 from work_order wo
                 where wo.wonum='$wonum'";
	  //echo "<br>".$sql."<br>";
      $result = mysql_query($sql);
      if(!$result) die("Query failed for rejqty . " . mysql_error());
      return $result;
     }


     function getNotes($salesorderrecnum)
{
        //Connect to database
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select s.notes, DATE_ADD(s.stamp_created, INTERVAL '13:00' HOUR_MINUTE),
                        e.fname
                from so_notes s, employee e, user u
                where notes2so=$salesorderrecnum and
                      u.userid = s.notes2user and
                      u.user2employee = e.recnum and 
                      (s.dept='NULL' or s.dept = '' or s.dept = 'Sales')
                order by stamp_created";
       // echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Get Review Notes didn't work. " . mysql_error());
       return $result;
} 


function getNotes_type($salesorderrecnum,$depts)
{
        //Connect to database
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select s.notes, DATE_ADD(s.stamp_created, INTERVAL '13:00' HOUR_MINUTE),
                        e.fname
                from so_notes s, employee e, user u
                where notes2so=$salesorderrecnum and
                      u.userid = s.notes2user and
                      u.user2employee = e.recnum and
              s.dept like '$depts'
                order by stamp_created";
       // echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Get Review Notes didn't work. " . mysql_error());
       return $result;
} 

function addNotes($salesorderrecnum,$notes)
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

        $sql = "INSERT INTO so_notes (notes,notes2so,stamp_created,stamp_updated,notes2user,dept)
               VALUES ($review_notes,$salesorderrecnum,now(),now(),$user2notes,'$dept')";
       // echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Insert of Review Notes didn't work. " . mysql_error());
}

   
} // End salesorder class definition
