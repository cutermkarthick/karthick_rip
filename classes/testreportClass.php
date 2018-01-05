<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: quoteClass.php
// Maintains the class for Quotes
// Revision: v1.0
//====================================

include_once('classes/loginClass.php');

class testreport {

    var $refno,
        $partno,
        $customer,
        $partname,
        $cust_standard,
        $rm_inv_no,
        $material_type,
        $inv_date,
        $material_spec,
        $rm_receipt_date,
        $rm_supplier;

    // Constructor definition
    function testreport() {
        $this->refno = '';
        $this->partno = '';
        $this->customer = '';
        $this->partname = '';
        $this->cust_standard = '';
        $this->rm_inv_no = '';
        $this->material_type = '';
        $this->inv_date = '';
        $this->material_spec = '';
        $this->rm_receipt_date = '';
        $this->rm_supplier = '';


    }

    // Property get and set
    function getrefno() {
           return $this->refno;
    }

    function setrefno ($reqrefno) {
           $this->refno = $reqrefno;
    }

    function getpartno() {
           return $this->partno;
    }

    function setpartno ($req_partno) {
           $this->partno = $req_partno;
    }
    function getcustomer() {
           return $this->customer;
    }

    function setcustomer ($req_customer) {
           $this->customer = $req_customer;
    }

    function getpartname() {
           return $this->partname;
    }

    function setpartname ($reqpartname) {
           $this->partname = $reqpartname;
    }

    function getcust_standard() {
           return $this->cust_standard;
    }

    function setcust_standard ($reqcust_standard) {
           $this->cust_standard = $reqcust_standard;
    }

    function getrm_inv_no() {
           return $this->rm_inv_no;
    }

    function setrm_inv_no ($reqrm_inv_no) {
           $this->rm_inv_no = $reqrm_inv_no;
    }

    function getmaterial_type() {
           return $this->material_type;
    }

    function setmaterial_type ($reqmaterial_type) {
           $this->material_type = $reqmaterial_type;
    }

    function getinv_date() {
           return $this->inv_date;
    }

    function setinv_date ($inv_date) {
           $this->inv_date = $inv_date;
    }
    function getmaterial_spec() {
           return $this->material_spec;
    }

    function setmaterial_spec ($material_spec) {
           $this->material_spec= $material_spec;
    }
    function getrm_receipt_date() {
           return $this->rm_receipt_date;
    }

    function setrm_receipt_date ($rm_receipt_date) {
           $this->rm_receipt_date = $rm_receipt_date;
    }
    function getrm_supplier() {
           return $this->rm_supplier;
    }

    function setrm_supplier ($rm_supplier) {
           $this->rm_supplier = $rm_supplier;
    }


     function addTestreport() {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'test_report' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

        $refno = "'" . $this->refno . "'";
        $partno= "'" . $this->partno . "'";
        $customer = "'" . $this->customer . "'";
        $partname = "'" . $this->partname . "'";
        $cust_standard = "'" . $this->cust_standard . "'";
        $rm_inv_no = "'" . $this->rm_inv_no . "'";
        $material_type = "'" . $this->material_type . "'";
        $inv_date = "'" . $this->inv_date . "'";
        $material_spec = "'" . $this->material_spec . "'";
        $rm_receipt_date = "'" . $this->rm_receipt_date . "'";
        $rm_supplier = "'" . $this->rm_supplier . "'";

        $sql = "select * from test_report where refno = $refno";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        test_report
                            (
                             recno,
                             refno,
                             partno,
                             customer,
                             partname,
                             cust_standard,
                             rm_inv_no,
                             material_type,
                             inv_date,
                             material_spec,
                             rm_receipt_date,
                             rm_supplier
                            )
                    VALUES
                            (
                             $objid,
                             $refno,
                             $partno,
                             $customer,
                             $partname,
                             $cust_standard,
                             $rm_inv_no,
                             $material_type,
                             $inv_date,
                             $material_spec,
                             $rm_receipt_date,
                             $rm_supplier
                            )";
        //echo $sql;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to test_report didn't work..Please report to Sysadmin. " . mysql_error());
         }
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Ref No. " . $refno . " already exists. ");
         }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'test_report'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
        //echo " <br>objid: $objid<br>";
         return $objid;
     }

     function gettestreports($cond,$argsort1,$argoffset,$arglimit) {
         $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;
        if($sortorder=='')
         $sortorder="refno desc";
        $sql = "SELECT
                  recno,
                  refno,
                  partno,
                  customer,
                  partname,
                  cust_standard,
                  rm_inv_no,
                  material_type,
                  inv_date,
                  material_spec,
                  rm_receipt_date,
                  rm_supplier
                FROM test_report where $wcond ORDER by $sortorder limit $offset, $limit";
      // echo $sql;
        $result = mysql_query($sql);
        return $result;

     }
     

     function gettestreport($trrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select
                  refno,
                  partno,
                  customer,
                  partname,
                  cust_standard,
                  rm_inv_no,
                  material_type,
                  inv_date,
                  material_spec,
                  rm_receipt_date,
                  rm_supplier
                FROM test_report
                 where  recno = $trrecnum";
//echo "$sql";
        $result = mysql_query($sql);
        return $result;
     }
     function updatetestreport($trrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $refno = "'" . $this->refno . "'";
        $partno = "'" . $this->partno . "'";
        $customer = "'" . $this->customer . "'";
        $partname = "'" . $this->partname . "'";
        $cust_standard = "'" . $this->cust_standard . "'";
        $rm_inv_no = "'" . $this->rm_inv_no . "'";
        $material_type= "'" . $this->material_type . "'";
        $inv_date = "'" . $this->inv_date . "'";
        $material_spec = "'" . $this->material_spec . "'";
        $rm_receipt_date = "'" . $this->rm_receipt_date . "'";
        $rm_supplier= "'" .$this->rm_supplier. "'";

        $sql = "UPDATE test_report SET
                    refno = $refno,
                    partno = $partno,
                    customer = $customer,
            	    partname=$partname,
            	    cust_standard =$cust_standard,
            	    rm_inv_no = $rm_inv_no ,
                    material_type = $material_type,
            	    inv_date=$inv_date,
            	    material_spec=$material_spec,
            	    rm_receipt_date=$rm_receipt_date,
                    rm_supplier=$rm_supplier

            	WHERE
                    recno = $trrecnum ";
    //echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("testreport update failed...Please report to SysAdmin. " . mysql_error());
        }



     function deleteQuote($refno) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from quote where refno = '$refno'";
        $result = mysql_query($sql);
        if(!$result) die("Delete for testreport failed...Please report to SysAdmin. " . mysql_error());
      }


     function gettestreportCount($cond,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
             $sql = "select count(*) as numrows
                     from test_report where  $wcond limit $offset, $limit";
       $newlogin = new userlogin;
       $newlogin->dbconnect();
//echo "$sql";
$result  = mysql_query($sql) or die('Emp count query failed');
$row     = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];
//echo $numrows;
return $numrows;
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
 //Function for search/sort coded by Jerry George 30 Dec -04
  function getquotessearch($cond,$argoffset,$arglimit,$sort1,$quotecond,$quoteOperator,$quoteVal) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder = $sort1;

        $matchCond ='';
    if($quotecond != '' || $quotecond != null) {
          if($quoteOperator == 'equal') {
                $matchCond="and `quote`.".$quoteVal . "='" . $quotecond ."'";
          }else if($quoteOperator == 'like'){

                $matchCond="and `quote`.". $quoteVal . " LIKE '" . $quotecond ."%'";
          }
     }

                  $sql = "SELECT
                  `quote`.`id`,
                  `quote`.`company`,
                  `quote`.`descr`,
                  `quote`.`excelfile`,
                  `quote`.`rfqid`,
                  `quote`.`quote_date`,
                  `quote`.`recnum`,
                  `quote`.`quotetype`,
                  `quote`.`quote2type`,
                  `employee`.`fname`,
                  `employee`.`lname`,
                  `quote`.`convert2sales`,
                  `quote`.`quote_grosstotal`,
                  `quote`.`currency`,
                  `quote`.`mail2customer`,
                  `quote`.`tax`,
                  `quote`.`labor`,
                  `quote`.`shipping`,
                  `quote`.`misc`,
                  `bom`.`bomnum`,
                  `quote`.`lockstatus`

                FROM `quote`
                LEFT OUTER JOIN `bom` ON
                   (`quote`.`link2bom` = `bom`.`recnum`)
                LEFT OUTER JOIN `employee` ON
                (`quote`.`quote2employee` = `employee`.`recnum`)
                 where $wcond $matchCond
                ORDER by $sortorder limit $offset, $limit";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;
     }
   //Function for pagination coded by Jerry George 30 Dec -04
  function getquoteCount($cond,$argoffset,$arglimit)
    {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
             $sql = "select count(*) as numrows
                                      from quote where  $wcond limit $offset, $limit";
       $newlogin = new userlogin;
       $newlogin->dbconnect();
//echo "$sql";
    $result  = mysql_query($sql) or die('quote count query failed');
    $row     = mysql_fetch_array($result, MYSQL_ASSOC);
    $numrows = $row['numrows'];
    return $numrows;
    }

} // End quoteclass definition

