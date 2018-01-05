<?
//====================================
// Author: FSI
// Date-written = March 21, 2007
// Filename: processdeviationClass.php
// Maintains the class for quality plan
// Revision: v1.0  OWT
//====================================

include_once('loginClass.php');

class procdeviation {
    var
    $recnum,
    $partnumber,
    $drgissue,
    $procdev2customer,
    $partname,
    $matltype,
    $matlspec,
    $project,
    $refno,
    $attachments;

    // Constructor definition
    function invoice() {
        $this->recnum = '';
        $this->partnumber = '';
        $this->drgissue = '';
        $this->procdev2customer = '';
        $this->partname = '';
        $this->matltype = '';
        $this->matlspec = '';
        $this->project = '';
        $this->refno = '';
        $this->attachments= '';
    }



    function getrecnum() {
           return $this->getrecnum;
    }
    function setrecnum ($req_recnum) {
           $this->recnum = $req_recnum;
    }

     function getpartnumber() {
           return $this->partnumber;
    }
    function setpartnumber($partnumber) {
           $this->partnumber = $partnumber;
    }
    function getdrgissue() {
           return $this->drgissue;
    }
    function setdrgissue($drgissue) {
           $this->drgissue= $drgissue;
    }
    function getprocdev2customer() {
           return $this->procdev2customer;
    }
    function setprocdev2customer($procdev2customer) {
           $this->procdev2customer = $procdev2customer;
    }
    function getpartname() {
           return $this->partname;
    }
    function setpartname($partname) {
           $this->partname = $partname;
    }

    function getmatltype() {
           return $this->matltype;
    }
    function setmatltype($matltype) {
           $this->matltype = $matltype;
    }

    function getmatlspec() {
           return $this->matlspec;
    }
    function setmatlspec($matlspec) {
           $this->matlspec = $matlspec;
    }
    function getproject() {
           return $this->project;
    }
    function setproject($project) {
           $this->project= $project;
    }

    function getrefno() {
           return $this->refno;
    }
    function setrefno($refno) {
           $this->refno= $refno;
    }
    function getattachments() {
           return $this->attachments;
    }
    function setattachments($attachments) {
           $this->attachments = $attachments;
    }

    function addProcdeviation() {
       //echo "I am here";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'proc_deviation' for update";
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
        $partnumber = "'" . $this->partnumber . "'";
        $partname = "'" . $this->partname. "'";
        $drgissue = "'" . $this->drgissue . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $procdev2customer = "'" . $this->procdev2customer . "'";
        $matltype = "'" . $this->matltype . "'";
        $matlspec = "'" . $this->matlspec . "'";
        $project="'" . $this->project . "'";
        $attachments = "'" . $this->attachments . "'";
        $refno = "'" . $this->refno . "'";

        $sql = "select * from proc_deviation where recnum = $objid";
       // echo $sql;
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        proc_deviation
                            (
                            recnum,partnumber,partname,drgissue,procdev2customer,
                            matltype,matlspec,project,attachments,refno
                            )
                    VALUES
                            (
                            $objid,$partnumber,$partname,$drgissue,$procdev2customer,
                            $matltype,$matlspec,$project,$attachments,$refno
                            )";
       // echo "\n" . $sql;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Insert to process deviation didn't work..Please report to Sysadmin. " . mysql_error());
                        }
         }
         else {
              //header("Location:errorMessage.php?validate=Inv3");
              die("Proc Deviation ID " . $objid . " already exists. ");
              }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'proc_deviation'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv4");
                     die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
                     }
        return $objid;
     }


     function getProcdeviations() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = " select p.recnum,p.partnumber,p.partname,p.drgissue,p.procdev2customer,
                            p.matltype,p.matlspec,p.project,p.attachments,p.refno,c.name
            FROM proc_deviation p, company c
            where  c.recnum = p.procdev2customer";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;

     }


     function getProcdeviation($procdevrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

       $sql = " select p.recnum,p.partnumber,p.partname,p.drgissue,p.procdev2customer,
                            p.matltype,p.matlspec,p.project,p.attachments,p.refno,c.name
            FROM proc_deviation p, company c
            where  c.recnum = p.procdev2customer
             and   p.recnum = $procdevrecnum";
//echo $sql;
        $result = mysql_query($sql);

        return $result;
     }

     function updateProcdeviation($procdevrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $partnumber = "'" . $this->partnumber . "'";
        $partname = "'" . $this->partname. "'";
        $drgissue = "'" . $this->drgissue . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $procdev2customer = "'" . $this->procdev2customer . "'";
        $matltype = "'" . $this->matltype . "'";
        $matlspec = "'" . $this->matlspec . "'";
        $project="'" . $this->project . "'";
        $attachments = "'" . $this->attachments . "'";
        $refno = "'" . $this->refno . "'";

       $sql = "UPDATE proc_deviation SET
                    partnumber = $partnumber,
                    partname = $partname,
                    drgissue = $drgissue,
            	    procdev2customer = $procdev2customer,
            	    matltype =$matltype ,
            	    matlspec=$matlspec,
            	    project=$project,
                    drgissue = $drgissue ,
                    attachments = $attachments,
                    refno = $refno
        	WHERE
                    recnum = $procdevrecnum";
 //echo $sql;
        $result = mysql_query($sql);

        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv5");
                     die("Invoice update failed...Please report to SysAdmin. " . mysql_error());
                     }
        }


    function deleteProcdeviation($procdevrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from proc_deviation where recnum = $procdevrecnum";
        $result = mysql_query($sql);
        if(!$result)
                     {
                      //header("Location:errorMessage.php?validate=Inv6");
                      die("Delete for process deviation failed...Please report to SysAdmin. " . mysql_error());
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
} // End invoice class definition

