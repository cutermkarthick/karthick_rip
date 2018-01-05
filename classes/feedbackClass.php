<?
//====================================
// Author: FSI
// Date-written = March 22, 2007
// Filename: feedbackClass.php
// Maintains the class for feedback
// Revision: v1.0  OWT
//====================================

include_once('loginClass.php');

class feedback {
    var
    $recnum,
    $crn,
    $refno,
    $partnumber,
    $requestedby,
    $partname,
    $docdate,
    $program,
    $process,
    $fixture,
    $tools,
    $description;

    // Constructor definition
    function invoice() {
        $this->recnum = '';
        $this->crn = '';
        $this->refno = '';
        $this->partnumber = '';
        $this->requestedby = '';
        $this->partname = '';
        $this->docdate = '';
        $this->program = '';
        $this->process = '';
        $this->fixture = '';
        $this->tools = '';
        $this->description = '';
    }



    function getrecnum() {
           return $this->getrecnum;
    }
    function setrecnum ($req_recnum) {
           $this->recnum = $req_recnum;
    }

    function getcrn() {
           return $this->crn;
    }
    function setcrn($crn) {
           $this->crn = $crn;
    }

    function getrefno() {
           return $this->refno;
    }
    function setrefno($refno) {
           $this->refno = $refno;
    }

    function getpartnumber() {
           return $this->partnumber;
    }
    function setpartnumber($partnumber) {
           $this->partnumber = $partnumber;
    }

    function getrequestedby() {
           return $this->requestedby;
    }
    function setrequestedby($requestedby) {
           $this->requestedby = $requestedby;
    }

    function getpartname() {
           return $this->partname;
    }
    function setpartname($partname) {
           $this->partname = $partname;
    }

    function getdocdate() {
           return $this->docdate;
    }
    function setdocdate($docdate) {
           $this->docdate = $docdate;
    }

    function getprogram() {
           return $this->program;
    }
    function setprogram($program) {
           $this->program = $program;
    }

    function getprocess() {
           return $this->process;
    }
    function setprocess($process) {
           $this->process= $process;
    }

    function getfixture() {
           return $this->fixture;
    }
    function setfixture($fixture) {
           $this->fixture= $fixture;
    }

    function gettools() {
           return $this->tools;
    }
    function settools($tools) {
           $this->tools= $tools;
    }

    function getdescription() {
           return $this->description;
    }
    function setdescription($description) {
           $this->description = $description;
    }

    function addFeedback() {
       //echo "I am here";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'feedback' for update";
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
        $crn = "'" . $this->crn . "'";
        $refno = "'" . $this->refno . "'";
        $partnumber = "'" . $this->partnumber . "'";
        $requestedby= "'" . $this->requestedby . "'";
        $partname = "'" . $this->partname. "'";
        $docdate = "'" . $this->docdate . "'";
        $program = "'" . $this->program . "'";
        $process = "'" . $this->process . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $fixture = "'" . $this->fixture . "'";
        $tools = "'" . $this->tools . "'";
        $description = "'" . $this->description . "'";

        $sql = "select * from feedback where recnum = $objid";
       // echo $sql;
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        feedback
                            (
                            recnum,crn,refno,partnumber,requestedby,partname,docdate,
                            program,process,fixture,tools,description
                            )
                    VALUES
                            (
                            $objid,$crn,$refno,$partnumber,$requestedby,$partname,$docdate,
                            $program,$process,$fixture,$tools,$description
                            )";
       // echo "\n" . $sql;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Insert to feedback didn't work..Please report to Sysadmin. " . mysql_error());
                        }
         }
         else {
              //header("Location:errorMessage.php?validate=Inv3");
              die("feedback ID " . $objid . " already exists. ");
              }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'feedback'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv4");
                     die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
                     }
        return $objid;
     }


     function getFeedbacks() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,crn,refno,partnumber,requestedby,partname,docdate,
                            program,process,fixture,tools,description
                FROM feedback";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;

     }


     function getFeedback($feedbackrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

       $sql = " select recnum,crn,refno,partnumber,requestedby,partname,docdate,
                            program,process,fixture,tools,description
            FROM feedback
            where  feedback.recnum = $feedbackrecnum";
//echo $sql;
        $result = mysql_query($sql);

        return $result;
     }

     function updateFeedback($feedbackrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $crn = "'" . $this->crn . "'";
        $refno = "'" . $this->refno . "'";
        $partnumber = "'" . $this->partnumber . "'";
        $requestedby= "'" . $this->requestedby . "'";
        $partname = "'" . $this->partname. "'";
        $docdate = "'" . $this->docdate . "'";
        $program = "'" . $this->program . "'";
        $process = "'" . $this->process . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $fixture = "'" . $this->fixture . "'";
        $tools = "'" . $this->tools . "'";
        $description = "'" . $this->description . "'";

       $sql = "UPDATE feedback SET
                    crn = $crn,
                    refno = $refno,
                    partnumber = $partnumber,
            	    requestedby = $requestedby,
            	    partname =$partname ,
            	    docdate=$docdate,
            	    program=$program,
                    process = $process ,
                    fixture = $fixture,
                    tools = $tools,
                    description= $description
        	WHERE
                    recnum = $feedbackrecnum";
 //echo $sql;
        $result = mysql_query($sql);

        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv5");
                     die("Feddback update failed...Please report to SysAdmin. " . mysql_error());
                     }
        }


    function deleteFeedback($feedbackrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from feedback where recnum = $feedbackrecnum";
        $result = mysql_query($sql);
        if(!$result)
                     {
                      //header("Location:errorMessage.php?validate=Inv6");
                      die("Delete for Feedback failed...Please report to SysAdmin. " . mysql_error());
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

