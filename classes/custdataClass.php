<?
//====================================
// Author: FSI
// Date-written = March 20, 2007
// Filename: qualityplanClass.php
// Maintains the class for quality plan
// Revision: v1.0  OWT
//====================================

include_once('loginClass.php');

class custdata {
    var

    $partnum,
    $cust_ref_num,
    $partname,
    $cust_rev_num,
    $sup_mod_format,
    $translated_to,
    $approved_by,
    $prepared_by,
    $Issue,
    $Date,
    $note;

    // Constructor definition
    function custdata() {

        $this->partnum = '';
        $this->cust_ref_num = '';
        $this->partname = '';
        $this->cust_rev_num = '';
        $this->sup_mod_format = '';
        $this->translated_to = '';
        $this->approved_by = '';
        $this->prepared_by = '';
        $this->Issue = '';
        $this->Date = '';
        $this->note = '';

    }



    function getpartnum() {
           return $this->partnum;
    }
    function setpartnum ($reqpartnum) {
           $this->partnum = $reqpartnum;
    }

    function getcust_ref_num() {
           return $this->cust_ref_num;
    }
    function setcust_ref_num($custrefnum) {
           $this->cust_ref_num = $custrefnum;
    }

    function getpartname() {
           return $this->partname;
    }
    function setpartname ($partname) {
           $this->partname = $partname;
    }

    function getcust_rev_num() {
           return $this->cust_rev_num;
    }
    function setcust_rev_num($custrevnum) {
           $this->cust_rev_num = $custrevnum;
    }

    function getsup_mod_format() {
           return $this->sup_mod_format;
    }
    function setsup_mod_format($supmodformat) {
           $this->sup_mod_format = $supmodformat;
    }

    function gettranslated_to() {
           return $this->translated_to;
    }
    function settranslated_to($translatedto) {
           $this->translated_to = $translatedto;
    }
    
    function getnote() {
           return $this->note;
    }
    function setnote($note) {
           $this->note = $note;
    }

    function getapproved_by() {
           return $this->approved_by;
    }
    function setapproved_by($approvedby) {
           $this->approved_by = $approvedby;
    }

    function getprepared_by() {
           return $this->prepared_by;
    }
    function setprepared_by($preparedby) {
           $this->prepared_by = $preparedby;
    }

    function getIssue() {
           return $this->Issue;
    }
    function setIssue($Issue) {
           $this->Issue= $Issue;
    }

    function getDate() {
           return $this->Date;
    }
    function setDate($Date) {
           $this->Date= $Date;
    }




    function addcustdata() {
       //echo "I am here in cust data add";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'cust_data_validation' for update";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv1");
                     die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
                     }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        

        $partnum = "'" . $this->partnum . "'";
        $cust_ref_num = "'" . $this->cust_ref_num . "'";
        $partname = "'" . $this->partname . "'";
        $cust_rev_num= "'" . $this->cust_rev_num . "'";
        $sup_mod_format = "'" . $this->sup_mod_format. "'";
        $translated_to = "'" . $this->translated_to . "'";
        $approved_by = "'" . $this->approved_by . "'";
        $prepared_by = "'" . $this->prepared_by . "'";
        $Issue = "'" . $this->Issue . "'";
        $Date = "'" . $this->Date . "'" ;
        $note = "'" . $this->note . "'" ;

        $sql = "select * from cust_data_validation where recnum = $objid";
        // echo $sql;
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        cust_data_validation
                            (
                            recnum,partnum,cust_ref_num,partname,cust_rev_num,sup_mod_format,translated_to,
                            approved_by,prepared_by,Issue,Date,note
                            )
                    VALUES
                            (
                            $objid,$partnum,$cust_ref_num,$partname,$cust_rev_num,$sup_mod_format,$translated_to,
                            $approved_by,$prepared_by,$Issue,$Date,$note
                            )";
        // echo  $sql;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Insert to Cust Data Validation didn't work..Please report to Sysadmin. " . mysql_error());
                        }
         }
         else {
              //header("Location:errorMessage.php?validate=Inv3");
              die("Cust Data ID " . $refnum . " already exists. ");
              }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'cust_data_validation'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result)
                     {
                       //header("Location:errorMessage.php?validate=Inv4");
                       die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
                     }
        return $objid;
     }


     function getcustdatas() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,partnum,cust_ref_num,partname,cust_rev_num,sup_mod_format,translated_to,
                        approved_by,prepared_by,Issue,Date
                 FROM cust_data_validation";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;

     }


     function getcustdata($custdatarecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

       $sql = " select recnum,partnum,cust_ref_num,partname,cust_rev_num,sup_mod_format,translated_to,note,
                       approved_by,prepared_by,Issue,Date
                FROM cust_data_validation
            where  cust_data_validation.recnum = $custdatarecnum";
//echo $sql;
        $result = mysql_query($sql);

        return $result;
     }

     function updatecustdata($custdatarecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $partnum = "'" . $this->partnum . "'";
        $cust_ref_num = "'" . $this->cust_ref_num . "'";
        $partname = "'" . $this->partname . "'";
        $cust_rev_num= "'" . $this->cust_rev_num . "'";
        $sup_mod_format = "'" . $this->sup_mod_format. "'";
        $translated_to = "'" . $this->translated_to . "'";
        $approved_by = "'" . $this->approved_by . "'";
        $prepared_by = "'" . $this->prepared_by . "'";
        $Issue = "'" . $this->Issue . "'";
        $Date = "'" . $this->Date . "'";
        $note = "'" . $this->note . "'";
        

       $sql = "UPDATE cust_data_validation SET
                    partnum = $partnum,
                    cust_ref_num = $cust_ref_num,
                    partname = $partname,
            	    cust_rev_num = $cust_rev_num,
            	    sup_mod_format =$sup_mod_format ,
            	    translated_to=$translated_to,
            	    approved_by=$approved_by,
                    prepared_by = $prepared_by ,
                    Issue = $Issue,
                    Date = $Date,
                    note =  $note
             	WHERE
                    recnum = $custdatarecnum";
 //echo $sql;
        $result = mysql_query($sql);

        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv5");
                     die("Cust data update failed...Please report to SysAdmin. " . mysql_error());
                     }
        }


    function deletecustdata($custdatarecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from cust_data_validation where recnum = $custdatarecnum";
        $result = mysql_query($sql);
        if(!$result)
                     {
                      //header("Location:errorMessage.php?validate=Inv6");
                      die("Delete for cust data failed...Please report to SysAdmin. " . mysql_error());
                     }
      }
      
          function getcustdataCount($cond,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
             $sql = "select count(*) as numrows
                     from cust_data_validation where  $wcond limit $offset, $limit";
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
} // End invoice class definition

