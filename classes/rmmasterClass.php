<?
//====================================
// Author: FSI
// Date-written = June 14, 2008
// Filename: rmmasterClass.php
// Maintains the class for review
// Revision: v1.0  WMS
//====================================

$pagename = $_SESSION['pagename'];

include_once('classes/loginClass.php');


class rmmaster {
    var
        $rmcode,
        $rm_ref,
        $rm_spec,
        $rm_dim1,
        $rm_dim2,
        $rm_dim3,
        $ruling_dim,
		$rm_dia,
        $partnum,
        $crnnum,
        $rm_condition,
        $rm_uom,
        $rm_grainflow,
        $rm_lt,
        $rm_st,
        $rm_qty_perbill,
        $rm_mrs,
        $rm_unitprice,
        $rm_supplier,
        $rm_altrm,
        $vendrecnum,
        $rm_notes,
        $rm_status,
	    $rm_type,
        $enggapproved,
        $directorsapproved,
        $directorsapprovedby,
        $enggapprovedby,
        $rm_remarks,
        $create_date,
        $engg_app_date,
        $director_app_date,
        $currency ,$rm_bars_plates
        ;

    // Constructor definition
    function rmmaster() {
		$this->rmcode = '';
        $this->partnum = '';
        $this->rm_ref = '';
        $this->rm_spec = '';
        $this->rm_dim1 = '';
        $this->rm_dim2 = '';
        $this->rm_dim3 = '';
		$this->rm_dia ='';
		$this->ruling_dim = '';
		//
		$this->crnnum = '';
		$this->rm_condition = '';
		$this->rm_uom = '';
		$this->rm_grainflow = '';
		$this->rm_lt = '';
		$this->rm_st = '';
		$this->rm_qty_perbill = '';
		$this->rm_mrs = '';
		$this->rm_unitprice = '';
		$this->rm_supplier = '';
		$this->rm_altrm = '';
		$this->vendrecnum = '';
		$this->rm_notes = '';
		$this->rm_status = '';
		$this->rm_type = '';
		$this->enggapproved = '';
		$this->directorsapproved = '';
		$this->directorsapprovedby = '';
		$this->enggapprovedby = '';
		$this->rm_remarks = '';
		$this->create_date = '';
		$this->engg_app_date = '';
		$this->director_app_date = '';
    	$this->currency = '';
    	$this->rm_bars_plates='';
    }
    function getrmcode() {
           return $this->rmcode;
    }
    function setrmcode($rmcode) {
           $this->rmcode = $rmcode;
    }

    function getpartnum() {
           return $this->partnum;
    }
    function setpartnum($partnum) {
           $this->partnum = $partnum;
    }

    function getrm_type() {
           return $this->rm_type;
    }
    function setrm_type($rm_type) {
           $this->rm_type= $rm_type;
    }

    function getrm_spec() {
           return $this->rm_spec;
    }
    function setrm_spec($rm_spec) {
           $this->rm_spec = $rm_spec;
    }
    function getrm_dia() {
           return $this->rm_dia;
    }
    function setrm_dia($rm_dia) {
           $this->rm_dia = $rm_dia;
    }

    function getrm_dim1() {
           return $this->rm_dim1;
    }
    function setrm_dim1($rm_dim1) {
           $this->rm_dim1 = $rm_dim1;
    }

    function getrm_dim2() {
           return $this->rm_dim2;
    }
    function setrm_dim2($rm_dim2) {
           $this->rm_dim2 = $rm_dim2;
    }

    function getrm_dim3() {
           return $this->rm_dim3;
    }
    function setrm_dim3($rm_dim3) {
           $this->rm_dim3 = $rm_dim3;
    }
    
    function getruling_dim() {
           return $this->ruling_dim;
    }
    function setruling_dim($ruling_dim) {
           $this->ruling_dim = $ruling_dim;
    }
 /////////////////////////   
    function getrm_crn() {
           return $this->crnnum;
    }
    function setrm_crn($crnnum) {
           $this->crnnum = $crnnum;
    }
    function getrm_condition() {
           return $this->rm_condition;
    }
    function setrm_condition($rm_condition) {
           $this->rm_condition = $rm_condition;
    }
    function getrm_uom() {
           return $this->rm_uom;
    }
    function setrm_uom($rm_uom) {
           $this->rm_uom = $rm_uom;
    }
    function getrm_grainflow() {
           return $this->rm_grainflow;
    }
    function setrm_grainflow($rm_grainflow) {
           $this->rm_grainflow = $rm_grainflow;
    }
    function getrm_lt() {
           return $this->rm_lt;
    }
    function setrm_lt($rm_lt) {
           $this->rm_lt = $rm_lt;
    }
    function getrm_st() {
           return $this->rm_st;
    }
    function setrm_st($rm_st) {
           $this->rm_st = $rm_st;
    }
    function getrm_billet() {
           return $this->rm_qty_perbill;
    }
    function setrm_billet($rm_qty_perbill) {
           $this->rm_qty_perbill = $rm_qty_perbill;
    }
    function getrm_mrs() {
           return $this->rm_mrs;
    }
    function setrm_mrs($rm_mrs) {
           $this->rm_mrs = $rm_mrs;
    }
    function getrm_unitprice() {
           return $this->rm_unitprize;
    }
    function setrm_unitprice($rm_unitprize) {
           $this->rm_unitprize = $rm_unitprize;
    }
    function getrm_supplier() {
           return $this->rm_supplier;
    }
    function setrm_supplier($rm_supplier) {
           $this->rm_supplier = $rm_supplier;
    }
    function getrm_altspec() {
           return $this->rm_altrm;
    }
    function setrm_altspec($rm_altrm) {
           $this->rm_altrm = $rm_altrm;
    }
    function getlink2vendor () {
           return $this->vendrecnum;
    }
    function setlink2vendor ($vendrecnum) {
           $this->link2vendor = $vendrecnum;
    }
     function getrm_notes () {
           return $this->rm_notes;
    }
    function setrm_notes ($rm_notes) {
           $this->rm_notes = $rm_notes;
    }
    function getrm_status () {
           return $this->rm_status;
    }
    function setrm_status ($rm_status) {
           $this->rm_status = $rm_status;
    }

    function getenggapproved () {
           return $this->enggapproved;
    }
    function setenggapproved ($enggapproved) {
           $this->enggapproved = $enggapproved;
    }
    function getdirectorsapproved () {
           return $this->directorsapproved;
    }
    function setdirectorsapproved($directorsapproved) {
           $this->directorsapproved = $directorsapproved;
    }
    
    function getdirectorsapprovedby () {
           return $this->directorsapprovedby;
    }
    function setdirectorsapprovedby($directorsapprovedby) {
           $this->directorsapprovedby = $directorsapprovedby;
    }
    
     function getenggapprovedby () {
           return $this->enggapprovedby;
    }
    function setenggapprovedby($enggapprovedby) {
           $this->enggapprovedby = $enggapprovedby;
    }
    
    function getrm_remarks () {
           return $this->rm_remarks;
    }
    function setrm_remarks ($rm_remarks) {
           $this->rm_remarks = $rm_remarks;
    }

    function getcreate_date () {
           return $this->create_date;
    }
    function setcreate_date ($create_date) {
           $this->create_date = $create_date;
    }
    
    function geenggapproved_date () {
           return $this->engg_app_date;
    }
    function setenggapproved_date ($engg_app_date) {
           $this->engg_app_date = $engg_app_date;
    }
    
    function getdirectorapproveddate () {
           return $this->director_app_date;
    }
    function setdirectorapproveddate ($director_app_date) {
           $this->director_app_date = $director_app_date;
    }

    function setcurrency ($currency) {
           $this->currency = $currency;
    }
    function setrm_bars_plates ($rm_bars_plates) {
           $this->rm_bars_plates = $rm_bars_plates;
    }
    

   function addrmmaster() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select nxtnum from seqnum where tablename = 'rmmaster' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $rm_type = "'" . $this->rm_type . "'";
        $rm_spec = "'" . $this->rm_spec . "'";
        $rmcode = "'" . $this->rmcode . "'";
        $ruling_dim = "'" . $this->ruling_dim . "'";
        $rm_dia = "'" . $this->rm_dia . "'";
        $rm_dim1 = "'" . $this->rm_dim1 . "'";
        $rm_dim2 = "'" . $this->rm_dim2 . "'";
        $rm_dim3 = "'" . $this->rm_dim3 . "'";
		$partnum = "'" . $this->partnum . "'";
		
		$crnnum= "'" . $this->crnnum . "'";
        $rm_condition= "'" . $this->rm_condition . "'";
        $rm_uom= "'" . $this->rm_uom . "'";
        $rm_grainflow= "'" . $this->rm_grainflow . "'";
        $rm_lt= "'" . $this->rm_lt . "'";
        $rm_st= "'" . $this->rm_st . "'";
        $rm_qty_perbill= "'" . $this->rm_qty_perbill . "'";
        $rm_mrs= "'" . $this->rm_mrs . "'";
        $rm_unitprize= "'" . $this->rm_unitprize . "'";
        $rm_supplier= "'" . $this->rm_supplier . "'";
        $rm_altrm= "'" . $this->rm_altrm . "'"; 
        $rm_status= "'" . $this->rm_status . "'";
       
        $link2vendor = $this->link2vendor;
        $directorsapproved= "'" . $this->directorsapproved . "'";
        $directorsapprovedby= "'" . $this->directorsapprovedby . "'";
        $rm_remarks= "'" . $this->rm_remarks . "'";
        $eng_app_date = $this->engg_app_date ? "'" . $this->engg_app_date  . "'" : '0000-00-00';
        $director_app_date = $this->director_app_date ? "'" . $this->director_app_date  . "'" : '0000-00-00';
        $enggapproved= "'" . $this->enggapproved . "'";
        $enggapprovedby= "'" . $this->enggapprovedby . "'";
        $currency= "'" . $this->currency . "'";
        $rm_bars_plates= "'" . $this->rm_bars_plates . "'";
        $siteid= "'" . $_SESSION['siteid'] . "'";
       // $rm_status = $this->rm_status;
  //   $link2vendor=26;
//echo $rm_status."=status in process";echo "<br>";
//echo $rm_condition."=cond in process";echo "<br>";
//echo $rm_grainflow."=grain in process";echo "<br>";
//echo $rm_lt."=lt in process";echo "<br>";
//echo $rm_st."=st in process";echo "<br>";
//echo $rm_qty_per_billet."=billet in process";echo "<br>";
//echo $link2vendor."=link2 in process";echo "<br>";
       $sql = "select count(*) as numrow from rmmaster where crnnum = $crnnum and rm_altrm = $rm_altrm
               and rm_status= $rm_status";
       		// echo $sql;
           $result = mysql_query($sql);
         //  echo $result;
           $num=mysql_fetch_row($result);
           $numcrn=$num[0];
           //echo $numcrn;
           if ($numcrn==0)
           {
            $sql = "INSERT INTO
                        rmmaster
                            (
                            recnum,rmcode,rm_type,rm_spec,rm_dia,length,width,thickness,rm_ruling_dim,partnum,crnnum,rm_condition,rm_uom,rm_grainflow,
                            rm_lt,rm_st,rm_qty_perbill,rm_mrs,rm_unitprize,rm_supplier,rm_altrm,link2vendor,rm_status,directorsapproved,directorsapprovedby,rm_remarks
                            ,createdate,eng_app_date,director_app_date,enggapproved,engapprovedby,currency,rm_bars_plates,siteid)
                    VALUES
                            (
                            $objid,$rmcode,$rm_type,$rm_spec,$rm_dia,$rm_dim1,$rm_dim2,$rm_dim3,$ruling_dim,$partnum,$crnnum,
                            $rm_condition,$rm_uom,$rm_grainflow,$rm_lt,$rm_st,$rm_qty_perbill,$rm_mrs,$rm_unitprize,
                            $rm_supplier,$rm_altrm,$link2vendor,$rm_status,$directorsapproved,$directorsapprovedby,
                            $rm_remarks,curdate(),$eng_app_date,$director_app_date,$enggapproved,$enggapprovedby,$currency,$rm_bars_plates,$siteid)";
              $result = mysql_query($sql);
            // echo $sql;exit;
           // Test to make sure query worked
              if(!$result) die("Insert to RM Master didn't work..Please report to Sysadmin. " . mysql_error());
            }
            else
            {
               echo "<table border=1><tr><td><font color=#FF0000>";
               die($rm_altrm ." for PRN " . $crnnum . " Already Exists ");
               echo "</td></tr></table>";
            }
            $sql = "update seqnum set nxtnum = $objid where tablename = 'rmmaster'";
            $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work for RM Master.Please repport to Sysadmin. " . mysql_error());
       
     }
     function addNotes($masterdatarecnum)
     {

        // Connect to database
        $userid = $_SESSION['user'];
      //  $userrecnum = $_SESSION['userrecnum'];
        $sql = "select nxtnum from seqnum where tablename = 'rmm_notes'";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $rm_notes = "'" . $this->rm_notes . "'";
        if($rm_notes!="''")
        {
        $sql = "INSERT INTO rmm_notes (recnum, notes,create_date,notes2rmm )
               VALUES ($objid, $rm_notes,curdate(),$masterdatarecnum)";
        }
             // echo $sql;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Insert of Notes didn't work. " . mysql_error());

        $sql = "update seqnum set nxtnum = $objid where tablename = 'rmm_notes'";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert for notes table didn't work. " . mysql_error());

     }
     function getNotes($recnum)
     {
     	 $newlogin = new userlogin;
         $newlogin->dbconnect();
     	 $sql = "select create_date,notes from rmm_notes where notes2rmm='$recnum'";
     	// echo $sql;
     	  $result =mysql_query($sql);
     	  return $result;
     }
function getVendrecnum($inpcompany)
{
	$newlogin = new userlogin;
        $newlogin->dbconnect();
        $company = str_replace(";",",",$inpcompany);
        $sql = "select recnum from company where name='$company' and type = 'VEND'";
        $result =mysql_query($sql);
        $vrownum=mysql_fetch_row($result);
        $v_recnum=$vrownum[0];
        echo $sql."<br>".$v_recnum;
        return $v_recnum;
        
}
function getrmmaster($cond,$argsort1,$argoffset,$arglimit) {
     
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;
        $siteid = $_SESSION['siteid'];
        $siteval = "siteid ='".$siteid."'";

        if($sortorder=='')
          $sortorder="rmcode asc";
          
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,rmcode,partnum,rm_type,rm_spec,length,width,thickness,rm_dia,rm_ruling_dim,crnnum,
         rm_condition,rm_uom,rm_grainflow,rm_lt,rm_st,rm_qty_perbill,rm_mrs,rm_unitprize,rm_supplier,rm_altrm,link2vendor,
         rm_status,rm_remarks,createdate,enggapproved,directorsapproved,directorsapprovedby,engapprovedby,currency,rm_bars_plates
                 FROM rmmaster
                       where $wcond and $siteval ORDER by $sortorder limit $offset, $limit";
        $result = mysql_query($sql);
      //echo "$sql";//ORDER by $sortorder
        return $result;

     }
     
     
     function getcrncount($cond,$argoffset, $arglimit)
     {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $siteid = $_SESSION['siteid'];
        $siteval = "siteid ='".$siteid."'";

             $sql = "select count(*) as numrows from rmmaster 
                      where $wcond and $siteval limit $offset, $limit";
		//echo $sql;
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $result  = mysql_query($sql) or die('RM Master count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;

     }


     function getrmmasterdata($rmmasterrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

       $sql = "select r.recnum,
       		r.rmcode,
       		r.partnum,
       		r.rm_type,
       		r.rm_spec,
       		r.length,
       		r.width,
       		r.thickness,
       		r.rm_dia,
       		r.rm_ruling_dim,
       		r.crnnum,
       		r.rm_condition,
       		r.rm_uom,
       		r.rm_grainflow,
       		r.rm_lt,
       		r.rm_st,
       		r.rm_qty_perbill,
       		r.rm_mrs,
       		r.rm_unitprize,
       		r.rm_supplier,
       		r.rm_altrm,
       		r.link2vendor,
       		r.rm_status,		
       		c.name,
       		r.enggapproved,
       		r.directorsapproved,
       		r.directorsapprovedby ,
       		r.engapprovedby,
       		r.rm_remarks,
       		r.createdate,
       		r.eng_app_date,
       		r.director_app_date,
       		r.currency,
            r.rm_bars_plates
            FROM rmmaster r, company c
            where  r.recnum = $rmmasterrecnum and c.recnum=r.link2vendor";
      // echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
     
     function getAllRMMs()
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select recnum,rmcode, rm_type, rm_spec,length,width,
	              thickness,rm_dia, rm_ruling_dim
                      from rmmaster order by rmcode";
       $result = mysql_query($sql);
       return $result;

     }

  function updatermmaster($masterdatarecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $rm_type = "'" . $this->rm_type . "'";
        $rm_spec = "'" . $this->rm_spec . "'";
        $rmcode = "'" . $this->rmcode . "'";
        $ruling_dim = "'" . $this->ruling_dim . "'";
        $rm_dia = "'" . $this->rm_dia . "'";
        $rm_dim1 = "'" . $this->rm_dim1 . "'";
        $rm_dim2 = "'" . $this->rm_dim2 . "'";
        $rm_dim3 = "'" . $this->rm_dim3 . "'";
		$partnum = "'" . $this->partnum . "'";

        $crnnum= "'" . $this->crnnum . "'";
        $rm_condition= "'" . $this->rm_condition . "'";
        $rm_uom= "'" . $this->rm_uom . "'";
        $rm_grainflow= "'" . $this->rm_grainflow . "'";
        $rm_lt= "'" . $this->rm_lt . "'";
        $rm_st= "'" . $this->rm_st . "'";
        $rm_qty_perbill= "'" . $this->rm_qty_perbill . "'";
        $rm_mrs= "'" . $this->rm_mrs . "'";
        $rm_unitprize= "'" . $this->rm_unitprize . "'";
        $rm_supplier= "'" . $this->rm_supplier . "'";
        $rm_altrm= "'" . $this->rm_altrm . "'";
        $link2vendor = $this->link2vendor;
        $rm_status= "'" . $this->rm_status . "'";
        $directorsapproved="'" . $this->directorsapproved . "'";
        $directorsapprovedby="'" . $this->directorsapprovedby . "'";
        $create_date = $this->create_date ? "'" . $this->create_date  . "'" : '0000-00-00';
        $rm_remarks= "'" . $this->rm_remarks . "'";
        $eng_app_date = $this->engg_app_date ? "'" . $this->engg_app_date  . "'" : '0000-00-00';
        $director_app_date = $this->director_app_date ? "'" . $this->director_app_date  . "'" : '0000-00-00';
        $enggapproved= "'" . $this->enggapproved . "'";
        $enggapprovedby= "'" . $this->enggapprovedby . "'";
        $currency= "'" . $this->currency . "'";
        $rm_bars_plates= "'" . $this->rm_bars_plates . "'";
       // $rm_status = $this->rm_status;  
       // echo "Supplier=".$rm_supplier;
      //  echo "status=".$rm_status;
        $sql = "UPDATE rmmaster SET
                       partnum = $partnum,
                       rm_type = $rm_type,
                       rm_spec = $rm_spec,
                       length = $rm_dim1,
                       width = $rm_dim2,
                       thickness = $rm_dim3,
                       rmcode = $rmcode,
                       rm_dia = $rm_dia,
                       rm_ruling_dim = $ruling_dim,
                       crnnum=$crnnum,
                       rm_condition=$rm_condition,
                       rm_uom=$rm_uom,
                       rm_grainflow=$rm_grainflow,
                       rm_lt=$rm_lt,
                       rm_st=$rm_st,
                       rm_qty_perbill=$rm_qty_perbill,
                       rm_mrs=$rm_mrs,
                       rm_unitprize=$rm_unitprize,
                       rm_supplier=$rm_supplier,
                       rm_altrm=$rm_altrm,
                       link2vendor=$link2vendor,
                       rm_status=$rm_status,
                       directorsapproved=$directorsapproved,
                       directorsapprovedby=$directorsapprovedby,
                       rm_remarks=$rm_remarks,
                       createdate=$create_date,
                       eng_app_date=$eng_app_date,
                       director_app_date=$director_app_date,
                       enggapproved=$enggapproved,
                       engapprovedby=$enggapprovedby,
                       modifieddate=now(),
                       currency=$currency,
                       rm_bars_plates=$rm_bars_plates
        	    WHERE
                       recnum = $masterdatarecnum";
      // echo $sql;exit;
        $result = mysql_query($sql) or die("masterdata update failed...Please report to SysAdmin. " . mysql_error());

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
    function getrm_check($crn_num,$cur_status,$spec) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select crnnum,rm_altrm,rm_status,recnum
               FROM rmmaster
                     where  crnnum='$crn_num' and 
					 rm_status != 'Inactive' and 
					 rm_altrm='$spec'";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
     
     function updatermmaster_engapp($recnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $enggapproved= "'" . $this->enggapproved . "'";
        $enggapprovedby= "'" . $this->enggapprovedby . "'";
        $rm_status= "'" . $this->rm_status . "'";
        $eng_app_date = $this->engg_app_date ? "'" . $this->engg_app_date  . "'" : '0000-00-00';
        //echo $enggapprovedby."class";
        $sql = "update rmmaster set enggapproved=$enggapproved,
                                    engapprovedby=$enggapprovedby,
                                    rm_status=$rm_status,
                                    eng_app_date=$eng_app_date
                                     where recnum=$recnum";
        //echo $sql;
        $result = mysql_query($sql) or die("updatermmaster_engapp failed...Please report to SysAdmin. " . mysql_error());

     }
     
     function getapp4rm($recnum,$spec_type)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select enggapproved,directorsapproved,rm_status
               FROM rmmaster
                     where  recnum=$recnum and rm_altrm='$spec_type'";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
     function getapp_rm4new($crnnum,$spec_type)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select enggapproved,directorsapproved,rm_status
               FROM rmmaster
                     where  crnnum='$crnnum' and rm_altrm='$spec_type' and rm_status !='Inactive'";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
     
     function getrm_check4pending($crn_num,$spec,$cur_status,$pend_stat) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select crnnum,rm_altrm,rm_status,recnum
               FROM rmmaster
                     where  crnnum='$crn_num' and (rm_status='$cur_status' ||rm_status='$pend_stat')  and rm_altrm='$spec'";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

     function getrmmaster4export($cond) {

        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;

        if($sortorder=='')
          $sortorder="rmcode asc";

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select recnum,rmcode,partnum,rm_type,
                        rm_spec,length,width,thickness,
                        rm_dia,rm_ruling_dim,crnnum,
                        rm_condition,rm_uom,rm_grainflow,
                        rm_lt,rm_st,rm_qty_perbill,rm_mrs,
                        rm_unitprize,rm_supplier,rm_altrm,
                        link2vendor,
                        rm_status,rm_remarks,createdate,
                        enggapproved,directorsapproved,
                        directorsapprovedby,engapprovedby ,currency,rm_bars_plates
                 FROM rmmaster
                       where crnnum like'$wcond%' ORDER by crnnum";

                       // echo $sql;
        $result = mysql_query($sql);
      //echo "$sql";//ORDER by $sortorder
        return $result;

     }
     
     function getrmpodetails4rm($rmspec,$recnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select count(*) as numrows
                from po_line_items pli,rmmaster rm
                where pli.crn=rm.crnnum and rm.recnum=$recnum
                and (pli.spec_type='$rmspec' || pli.spec_type='' || pli.spec_type is null)
                 ";
        $result = mysql_query($sql);
        //echo "$sql";//ORDER by $sortorder
        $result  = mysql_query($sql) or die('Po count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows ;
     
     }
     
     function copyrmmaster($masterdatarecnum,$spec_type,$crnnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        	$sql = "select nxtnum from  seqnum where tablename = 'rmmaster'";
            $result = mysql_query($sql);
		    if(!$result) {
                  die("Copy seqnum error.Please report to Sysadmin. " . mysql_error());
             }
		    $myrow = mysql_fetch_row($result);
            $objid4rm = $myrow[0] + 1;
            $sql = "select * from  rmmaster where crnnum = '$crnnum' and rm_altrm='$spec_type' and rm_status !='Inactive'";
           // echo $sql."------";
            $result = mysql_query($sql);
		    if(!$result) {
                  die("RM Master Copy error.Please report to Sysadmin. " . mysql_error());
             }

            $num_rows = mysql_num_rows($result);
            if ($num_rows > 0)
	        {
				  die ("A PRN (Active/Pending) with spec type $spec_type already exists");
            }
           // echo $objid4rm."-----";
            $sql = "begin transaction";
            $result = mysql_query($sql);
            $sql = "INSERT INTO
                        rmmaster
                            (
                            recnum, crnnum, rmcode, rm_type, rm_spec, rm_ruling_dim, rm_dia,
                            length, width, thickness, partnum, rm_condition, rm_uom, rm_grainflow,
                            rm_lt, rm_st, rm_qty_perbill, rm_mrs, rm_unitprize, rm_supplier, rm_altrm,
                            link2vendor, rm_status, createdate, modifieddate, rm_remarks, enggapproved,
                            directorsapproved, directorsapprovedby, engapprovedby, eng_app_date, director_app_date,
                            currency,rm_bars_plates)
                            select $objid4rm,crnnum, rmcode, rm_type, rm_spec, rm_ruling_dim, rm_dia,
                            length, width, thickness, partnum, rm_condition, rm_uom, rm_grainflow,
                            rm_lt, rm_st, rm_qty_perbill, rm_mrs, rm_unitprize, rm_supplier, rm_altrm,
                            link2vendor, 'Active', createdate, modifieddate, rm_remarks, enggapproved,
                            directorsapproved, directorsapprovedby, engapprovedby, eng_app_date, director_app_date,
                            currency,rm_bars_plates from rmmaster where recnum=$masterdatarecnum ";
                          //  echo $sql;
             $result = mysql_query($sql);
	     if(!$result)
	     {
			  echo "Insert failed for Copy for RM Master $masterdatarecnum ....Please report to sysadmin" . mysql_errno();
		      $sql = "rollback";
		      $result = mysql_query($sql);
    	 }
    	$sql = "update seqnum set nxtnum = $objid4rm where tablename = 'rmmaster'";
    //	echo $sql."u====pseq";
       $result = mysql_query($sql);
       if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv4");
                     die("Seqnum insert for RM Master  didn't work..Please report to Sysadmin. " . mysql_error());
                     }

		$sql = "commit";
        $result = mysql_query($sql);
        return $objid4rm;

     
     }
} // End RM Master class definition

