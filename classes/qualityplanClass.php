<?
//====================================
// Author: FSI
// Date-written = March 20, 2007
// Filename: qualityplanClass.php
// Maintains the class for quality plan
// Revision: v1.0  OWT
//====================================

include_once('loginClass.php');

class qualityplan {
    var
    $recnum,
    $opnrefno,
    $operationnumber,
    $partnumber,
    $revnumber,
    $partname,
    $revdate,
    $parttype,
    $drgissue,
    $approvedby,
    $preparedby,
    $issuesnumber,
    $sheet,
    $attachments,
    $note;

    // Constructor definition
    function invoice() {
        $this->recnum = '';
        $this->opnrefno = '';
        $this->operationnumber = '';
        $this->partnumber = '';
        $this->revnumber = '';
        $this->partname = '';
        $this->revdate = '';
        $this->parttype = '';
        $this->drgissue = '';
        $this->approvedby = '';
        $this->preparedby = '';
        $this->issuesnumber = '';
        $this->sheet = '';
        $this->attachments= '';
        $this->note= '';
    }



    function getrecnum() {
           return $this->getrecnum;
    }
    function setrecnum ($req_recnum) {
           $this->recnum = $req_recnum;
    }

    function getopnrefno() {
           return $this->opnrefno;
    }
    function setopnrefno($opnrefno) {
           $this->opnrefno = $opnrefno;
    }

    function getoperationnumber() {
           return $this->operationnumber;
    }
    function setoperationnumber ($operationnumber) {
           $this->operationnumber = $operationnumber;
    }

    function getpartnumber() {
           return $this->partnumber;
    }
    function setpartnumber($partnumber) {
           $this->partnumber = $partnumber;
    }

    function getrevnumber() {
           return $this->revnumber;
    }
    function setrevnumber($revnumber) {
           $this->revnumber = $revnumber;
    }

    function getpartname() {
           return $this->partname;
    }
    function setpartname($partname) {
           $this->partname = $partname;
    }

    function getrevdate() {
           return $this->revdate;
    }
    function setrevdate($revdate) {
           $this->revdate = $revdate;
    }

    function getparttype() {
           return $this->parttype;
    }
    function setparttype($parttype) {
           $this->parttype = $parttype;
    }

    function getdrgissue() {
           return $this->drgissue;
    }
    function setdrgissue($drgissue) {
           $this->drgissue= $drgissue;
    }

    function getapprovedby() {
           return $this->approvedby;
    }
    function setapprovedby($approvedby) {
           $this->approvedby= $approvedby;
    }

    function getpreparedby() {
           return $this->preparedby;
    }
    function setpreparedby($preparedby) {
           $this->preparedby= $preparedby;
    }

    function getissuesnumber() {
           return $this->issuesnumber;
    }
    function setissuesnumber($issuesnumber) {
           $this->issuesnumber = $issuesnumber;
    }

    function getsheet() {
           return $this->sheet;
    }
    function setsheet($sheet) {
           $this->sheet = $sheet;
    }

    function getattachments() {
           return $this->attachments;
    }
    function setattachments($attachments) {
           $this->attachments = $attachments;
    }

    function getnote() {
           return $this->note;
    }
    function setnote($note) {
           $this->note = $note;
    }



    function addQualityplan() {
       //echo "I am here";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'quality_plan' for update";
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
        $opnrefno = "'" . $this->opnrefno . "'";
        $operationnumber = "'" . $this->operationnumber . "'";
        $partnumber = "'" . $this->partnumber . "'";
        $revnumber= "'" . $this->revnumber . "'";
        $partname = "'" . $this->partname. "'";
        $revdate = "'" . $this->revdate . "'";
        $parttype = "'" . $this->parttype . "'";
        $drgissue = "'" . $this->drgissue . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $approvedby = "'" . $this->approvedby . "'";
        $preparedby = "'" . $this->preparedby . "'";
        $issuesnumber = "'" . $this->issuesnumber . "'";
        $sheet="'" . $this->sheet . "'";
        $attachments = "'" . $this->attachments . "'";
        $note = "'" . $this->note . "'";

        $sql = "select * from quality_plan where opnrefno = $opnrefno";
       // echo $sql;
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        quality_plan
                            (
                            recnum,opnrefno,operationnumber,partnumber,revnumber,partname,revdate,
                            parttype,drgissue,approvedby,preparedby,issuesnumber,sheet,attachments,note
                            )
                    VALUES
                            (
                            $objid,$opnrefno,$operationnumber,$partnumber,$revnumber,$partname,$revdate,
                            $parttype,$drgissue,$approvedby,$preparedby,$issuesnumber,$sheet,$attachments,$note
                            )";
       //echo $sql;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Insert to quality plan didn't work..Please report to Sysadmin. " . mysql_error());
                        }
         }
         else {
              //header("Location:errorMessage.php?validate=Inv3");
              die("Quality Plan ID " . $objid . " already exists. ");
              }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'quality_plan'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv4");
                     die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
                     }
        return $objid;
     }


     function getQualityplans() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,opnrefno,operationnumber,partnumber,revnumber,partname,revdate,
                 parttype,drgissue,approvedby,preparedby,issuesnumber,sheet,attachments,note
            FROM quality_plan";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;

     }


     function getQualityplan($qualityplanrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

       $sql = " select recnum,opnrefno,operationnumber,partnumber,revnumber,partname,revdate,
                parttype,drgissue,approvedby,preparedby,issuesnumber,sheet,attachments,note
            FROM quality_plan
            where  quality_plan.recnum = $qualityplanrecnum";
//echo $sql;
        $result = mysql_query($sql);

        return $result;
     }

     function updateQualityplan($qualityplanrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $opnrefno = "'" . $this->opnrefno . "'";
        $operationnumber = "'" . $this->operationnumber . "'";
        $partnumber = "'" . $this->partnumber . "'";
        $revnumber= "'" . $this->revnumber . "'";
        $partname = "'" . $this->partname. "'";
        $revdate = "'" . $this->revdate . "'";
        $parttype = "'" . $this->parttype . "'";
        $drgissue = "'" . $this->drgissue . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $approvedby = "'" . $this->approvedby . "'";
        $preparedby = "'" . $this->preparedby . "'";
        $issuesnumber = "'" . $this->issuesnumber . "'";
        $sheet="'" . $this->sheet . "'";
        $attachments = "'" . $this->attachments . "'";
        $note = "'" . $this->note . "'";

       $sql = "UPDATE quality_plan SET
                    opnrefno = $opnrefno,
                    operationnumber = $operationnumber,
                    partnumber = $partnumber,
            	    revnumber = $revnumber,
            	    partname =$partname ,
            	    revdate=$revdate,
            	    parttype=$parttype,
                    drgissue = $drgissue ,
                    approvedby = $approvedby,
                    preparedby = $preparedby,
                    issuesnumber= $issuesnumber ,
                    sheet=$sheet,
                    attachments=$attachments,
                    note=$note
        	WHERE
                    recnum = $qualityplanrecnum";
 //echo $sql;
        $result = mysql_query($sql);

        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv5");
                     die("Invoice update failed...Please report to SysAdmin. " . mysql_error());
                     }
        }


    function deleteQualityplan($qualityplanrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from quality_plan where recnum = $qualityplanrecnum";
        $result = mysql_query($sql);
        if(!$result)
                     {
                      //header("Location:errorMessage.php?validate=Inv6");
                      die("Delete for Invoice failed...Please report to SysAdmin. " . mysql_error());
                     }
      }
      

     function getqualityplanCount($cond,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
             $sql = "select count(*) as numrows
                     from quality_plan q where  $wcond limit $offset, $limit";
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

