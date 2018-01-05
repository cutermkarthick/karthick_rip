<?
//====================================
// Author: FSI
// Date-written = Jan 6, 2005 by Jerry George
// Filename: srClass.php
// Maintains the class for Solution request
// Revision: v1.0  OWT
//====================================

include_once('loginClass.php');

class sr {

    var $recnum,
        $srnum,
        $drawing_rev,
        $title,
        $reportedby,
        $status,
        $priority,
        $error_desc,
        $createdate,
        $docdate,
        $received_date,
        $duedate;


    // Constructor definition
    function sr() {
        $this->recnum = '';
        $this->srnum = '';
        $this->drawing_rev='';
        $this->title='';
        $this->reportedby='';
        $this->status='';
        $this->priority='';
        $this->error_desc='';
        $this->createdate='';
        $this->docdate='';
        $this->received_date='';
        $this->duedate='';
    }

    // Property get and set
    function getsrnum() {
           return $this->srnum;
    }

    function setsrnum ($reqsrnum) {
           $this->srnum = $reqsrnum;
    }

    function getdrawing_rev () {
           return $this->drawing_rev;
    }

    function setdrawing_rev ($reqdrawing_rev) {
           $this->drawing_rev = $reqdrawing_rev;
    }

    function getpriority () {
           return $this->priority;
    }

    function setpriority ($reqpriority) {
           $this->priority = $reqpriority;
    }

    function gettitle () {
           return $this->title;
    }

    function settitle ($reqtitle) {
           $this->title = $reqtitle;
    }


    function gereportedby() {
           return $reportedby->reportedby;
    }

    function setreportedby ($reportedby) {
           $this->reportedby = $reportedby;
    }

    function geterror_desc () {
           return $this->error_desc;
    }

    function seterror_desc ($reqerror_desc) {
           $this->error_desc = $reqerror_desc;
    }


    function getstatus () {
           return $this->status;
    }

    function setstatus ($reqstatus) {
           $this->status = $reqstatus;
    }


    function getcreatedate () {
           return $this->createdate;
    }
    function setcreatedate ($reqcreatedate) {
           $this->createdate = $reqcreatedate;
    }

    function getdocdate () {
           return $this->docdate;
    }
    function setdocdate ($reqdocdate) {
           $this->docdate = $reqdocdate;
    }
    function getreceived_date () {
           return $this->received_date;
    }
    function setreceived_date ($reqreceived_date) {
           $this->received_date = $reqreceived_date;
    }
    function getdueddate () {
           return $this->duedate;
    }
    function setdueddate ($reqdueddate) {
           $this->duedate = $reqdueddate;
    }

    function addsr() {

        $sql = "select nxtnum from seqnum where tablename = 'serv_req' for update";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

        $srnum = "'" . $this->srnum ."'" ;
        $drawing_rev="'" . $this->drawing_rev . "'";
        $title="'" . $this->title . "'";
        $reportedby="'" . $this->reportedby . "'";
        $status = "'" . $this->status . "'";
        $priority="'" . $this->priority . "'";
        $error_desc="'" . $this->error_desc . "'";
        //$createdate="'" . $this->createdate . "'";
        $docdate="'" . $this->docdate . "'";
        $received_date="'" . $this->received_date . "'";
        $duedate="'" . $this->duedate . "'";
        $sql = "select * from serv_req where srnum = $srnum";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO serv_req (recnum, srnum,drawing_rev,title,error_desc,reportedby,status,priority,docdate,received_date,duedate)
               VALUES ($objid, $srnum,$drawing_rev,$title,$error_desc,$reportedby,$status,$priority,$docdate,$received_date,$duedate)";
//echo "$sql";
         }
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Service Request Number " . $srnum . " already exists. ");
            echo "</td></tr></table>";
         }
//echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Insert of Service Request  failed. " . mysql_error());

        $sql = "update seqnum set nxtnum = $objid where tablename = 'serv_req'";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert for Service Request didn't work. " . mysql_error());
return $objid;
     }

    function updatesr($inpsrnum) {
       $srrecnum= $inpsrnum;
        $srnum = "'" . $this->srnum ."'" ;
        $drawing_rev="'" . $this->drawing_rev . "'";
        $title="'" . $this->title . "'";
        $status = "'" . $this->status . "'";
        $priority="'" . $this->priority . "'";
        $error_desc="'" . $this->error_desc . "'";
        $createdate="'" . $this->createdate . "'";
        $docdate="'" . $this->docdate . "'";
        $received_date="'" . $this->received_date . "'";
        $duedate="'" . $this->duedate . "'";
        $sql = "update serv_req set  drawing_rev=$drawing_rev,
        		title=	$title,
		        status=$status,
		        priority=$priority,
		        error_desc=$error_desc,
                docdate=$docdate,
		        received_date=$received_date,
		        duedate=$duedate
                        where recnum = $srrecnum";
//echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Update of Service Request  failed..Please report to Sysadmin " . mysql_error());

     }

    function cancelsr($inpsrnum) {
        $srnum = "'" . $inpsrnum ."'" ;
        $status = "'Sr cancelled'";
        $sql = "update serv_req set
                status = $status,
                where srnum = $srnum";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Cancel of Service Request failed..Please report to Sysadmin " . mysql_error());

    }

 // End of function addition


function getwonum4sr($argworecnum)
{
   $worecnum=$argworecnum;
             $sql = "select  distinct w.wonum, c.name,cont.fname,cont.lname,cont.email, emp.fname, emp.lname,emp.email
                       from work_order w, company c, contact cont, employee emp
                       where w.recnum= $worecnum and
                             w.wo2customer = c.recnum and
                             w.wo2contact = cont.recnum and
                             w.wo2employee = emp.recnum and
                             w.condition = 'Open'";
//echo "<br>$sql";
             $result = mysql_query($sql);
             return $result;
}

//-------------------------------------------------------------------------------------------------------------------------------


function getsrs($cond,$argsort1,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;
        if($sortorder=='')
        $sortorder="s.srnum";

             $sql = "select s.recnum ,s.srnum,c.name,s.srtype,e.fname,s.priority,s.status,date_format(s.received_date,'%y-%m-%d'),s.title,TO_DAYS(CURDATE())-TO_DAYS(s.received_date) from company c,employee e,
	serv_req s where  $wcond and s.sr2customer =c.recnum and s.sr2employee=e.recnum ORDER by $sortorder limit $offset, $limit";
	//echo "$sql";
             $result = mysql_query($sql);
             return $result;
}
//-----------------------------------------------------------------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------------------------------------------------------
function getsrs4prntUpd($argsrrrecnum)
{
             $srrecnum=$argsrrrecnum;
             $sql = "select s.recnum ,s.srnum,s.title,s.drawing_rev,s.reportedby,date_format(s.duedate,'%y-%m-%d'),date_format(s.received_date,'%y-%m-%d'),s.priority,s.status,date_format(s.docdate,'%y-%m-%d'),
	s.error_desc from serv_req s where s.recnum= $srrecnum";
	//echo "$sql";
             $result = mysql_query($sql);
             return $result;
}
//------------------------------------------------------------------------------------------------------------------------------------------------------
function getsolnum4sr($argsolrecnum)
{
   $solrecnum=$argsolrecnum;
             $sql = "select  solnum from solution where recnum=$solrecnum";
	//echo "$sql";
             $result = mysql_query($sql);
             return $result;
}

//-------------------------------------------------------------------------------------------------------------------------------------------------------

function getsrType4sr() {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
      $sql = "select type from srtype
                  where status='a'";
       $result = mysql_query($sql);
       return $result;
     }
//------------------------------------------------------------------------------------------------------------------------------------------------------

function getSrcount($cond,$argoffset, $arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
             $sql = "select count(*) as numrows from company c,employee e,
      serv_req s where  $wcond and s.sr2customer =c.recnum and s.sr2employee=e.recnum limit $offset, $limit";
        $newlogin = new userlogin;
       $newlogin->dbconnect();
//echo "$sql";
$result  = mysql_query($sql) or die('Service Request count query failed');
$row     = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];
return $numrows;

}



//-----------------------------------------------------------------------------------------------------------------------------------------------------

function getNotes($inpsrrecnum){
$userrole = $_SESSION['userrole'];
$userid = $_SESSION['user'];
  $userrecnum = $_SESSION['userrecnum'];
        $srrecnum = $inpsrrecnum;
        $sql = "select n.create_date, n.notes, u.userid
                     from srnotes n, user u, serv_req w
                     where n.notes2sr = w.recnum and
                           notes2user = u.recnum and
                           w.recnum = $srrecnum";
//echo "$sql";
        $result = mysql_query($sql);
        return $result;

     }

//---------------------------------------------------------------------------------------------------------------------------------------------------------

    function updNotes($srrecnum) {

        $userrole = $_SESSION['userrole'];
        $userid = $_SESSION['user'];
        $usertype = $_SESSION['usertype'];
      //  if ($usertype == 'EMPL' && $userrole != 'SALES') {

             echo '<a href=addNotes4sr.php?recnum=' . $srrecnum .
                     ' onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'Image14\',\'\',\'images/addnotes_mo.gif\',1)"><img name="Image14" border="0" src="images/addnotes.gif"></a>';

      //  }
    }

//-----------------------------------------------------------------------------------------------------------------------------------------------------------

    function addNotes($srrecnum,$notes) {

        // Connect to database
        $userid = $_SESSION['user'];
        $userrecnum = $_SESSION['userrecnum'];
        $sql = "select nxtnum from seqnum where tablename = 'srnotes'";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $specinstrns = "'" . $notes . "'";
        $sql = "INSERT INTO srnotes (recnum, notes,notes2sr, notes2user,create_date )
               VALUES ($objid, $specinstrns, $srrecnum, $userrecnum, curdate())";
//echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Insert of Notes didn't work. " . mysql_error());

        $sql = "update seqnum set nxtnum = $objid where tablename = 'srnotes'";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert for notes table didn't work. " . mysql_error());

     }

//-----------------------------------------------------------------------------------------------------------------------------------------------------
} // End SR class definition
