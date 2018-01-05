<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: supportClass.php
// Maintains the class for support
// Revision: v1.0  OWT
// Modifications History
// Jan 12, 05 - Modified for WO Reorder
//              Badari Mandyam
//====================================

include_once('loginClass.php');

class support {

    var $recnum,
        $type,
        $status,
        $condition,
        $supp2wo,
        $supp2customer,
        $supp2contact,
        $supp2employee,
        $supp2type,
        $supp2solution,
        $received_date,
        $createdate;

    // Constructor definition
    function support() {
        $this->recnum = '';
        $this->type = '';
        $this->status = '';
        $this->condition = '';
        $this->supp2wo = '';
        $this->supp2customer = '';
        $this->supp2contact = '';
        $this->supp2employee = '';
        $this->supp2type = '';
        $this->supp2solution = '';
        $this->createdate= '';
        $this->received_date='';
    }

    // Property get and set
    function getstatus() {
           return $this->status;
    }

    function setstatus ($reqstatus) {
           $this->status = $reqstatus;
    }
    function gettype() {
           return $this->type;
    }

    function settype ($reqtype) {
           $this->type = $reqtype;
    }

    function getcondition() {
           return $this->condition;
    }

    function setcondition($reqcondition) {
           $this->condition = $reqcondition;
    }
    function getsupp2wo () {
           return $this->supp2wo;
    }

    function setsupp2wo ($supp2wo) {
           $this->supp2wo = $supp2wo;
    }

    function setsupp2customer ($reqsupp2customer) {
           $this->supp2customer = $reqsupp2customer;
    }
    function getsupp2customer () {
           return $this->supp2customer;
    }

    function setsupp2contact ($reqsupp2contact) {
           $this->supp2contact = $reqsupp2contact;
    }
    function getsupp2contact () {
           return $this->supp2contact;
    }

    function setsupp2employee ($reqsupp2employee) {
           $this->supp2employee = $reqsupp2employee;
    }
    function getsupp2employee () {
           return $this->supp2employee;
    }

    function setsupp2type ($reqsupp2type) {
           $this->supp2type = $reqsupp2type;
    }

    function getsupp2type () {
           return $this->supp2type;
    }

    function setsupp2solution ($reqsupp2solution) {
           $this->supp2solution = $reqsupp2solution;
    }
    function getsupp2solution () {
           return $this->supp2solution;
    }

    function getcreatedate() {
           return $this->createDate;
    }

    function setcreatedate ($req_createdate) {
           $this->createDate = $req_createdate;
    }

    function getreceived_date() {
           return $this->received_date;
    }

    function setreceived_date ($received_date) {
           $this->received_date = $received_date;
    }

    function addsupport() {

        $sql = "select nxtnum from seqnum where tablename = 'support' for update";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $status= "'" .  $this->status ."'" ;
       // $createdate= "'" .  $this->createdate ."'" ;
        $type= "'" .  $this->type ."'" ;
        $condition= "'" .  $this->condition ."'" ;
        $supp2type= $this->supp2type;
        $supp2wo= $this->supp2wo;
        $supp2customer= $this->supp2customer;
        $supp2contact= $this->supp2contact;
        $supp2employee= $this->supp2employee;
        $supp2solution= $this->supp2solution;
        $received_date="'" . $this->received_date . "'";

/*echo "wo :$supp2wo</br>";
echo "sol :$received_date</br>";
echo "cust :$supp2customer</br>";
echo "cont :$supp2contact</br>";
echo "emp :$supp2employee</br>";
echo "sol :$supp2solution</br>";*/

           $sql = "INSERT INTO support (recnum, status,type, condition,supp2wo,supp2customer,supp2contact,supp2employee,supp2type,supp2solution,create_date)
               VALUES ($objid,$status,$type,$condition,$supp2wo,$supp2customer,$supp2contact,$supp2employee,$supp2type,$supp2solution,$received_date)";
//echo "<br>$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Insert ofSupportfailed. " . mysql_error());

        $sql = "update seqnum set nxtnum = $objid where tablename = 'support'";
//echo "$sql";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert for support didn't work. " . mysql_error());

     }

    function updatesupport($inpsupp2type,$inptype) {
//echo "<br>i am inside the class";
        $supp2type= $inpsupp2type;
        $type="'" . $inptype . "'";
        $supp2wo = $this->supp2wo;
        $supp2customer = $this->supp2customer;
        $supp2employee = $this->supp2employee;
        $supp2contact = $this->supp2contact;
        $supp2solution = $this->supp2solution;
        $received_date="'" . $this->received_date . "'";
        $sql = "update support set supp2customer = $supp2customer,create_date=$received_date,
			    supp2wo = $supp2wo,supp2employee = $supp2employee,
                supp2contact = $supp2contact,supp2solution = $supp2solution
        where supp2type = $supp2type and type=$type";
//echo "<br>$sql<br>";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Update of Support failed..Please report to Sysadmin " . mysql_error());

     }


 function updNotes($srrecnum) {

        $userrole = $_SESSION['userrole'];
        $userid = $_SESSION['user'];
        $usertype = $_SESSION['usertype'];
      //  if ($usertype == 'EMPL' && $userrole != 'SALES') {

             echo '<a href=addNotes4support.php?recnum=' . $srrecnum .
                     ' onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'Image14\',\'\',\'images/addnotes_mo.gif\',1)"><img name="Image14" border="0" src="images/addnotes.gif"></a>';

      //  }
    }

//-----------------------------------------------------------------------------------------------------------------------------------------------------------

    function addNotes($inprecnum,$notes,$type) {

        // Connect to database
        $userid = $_SESSION['user'];
        $userrecnum = $_SESSION['userrecnum'];
        $sql = "select nxtnum from seqnum where tablename = 'support_notes'";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $specinstrns = "'" . $notes . "'";
        $type = "'" . $type . "'";
        $renum=$inprecnum;
//echo "<br>$inprecnum";
        $sql = "INSERT INTO support_notes (recnum,type, notes,notes2support, notes2user,create_date )
               VALUES ($objid,$type,$specinstrns,$inprecnum,$userrecnum,curdate())";
//echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Insert of Notes didn't work. " . mysql_error());

        $sql = "update seqnum set nxtnum = $objid where tablename = 'support_notes'";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert for notes table didn't work. " . mysql_error());

     }


function getNotes($inprecnum,$inptype){
$userrole = $_SESSION['userrole'];
$userid = $_SESSION['user'];
  $userrecnum = $_SESSION['userrecnum'];
        $recnum = $inprecnum;
//echo "$recnum";
        $type = $inptype;
        $sql = "select s.create_date, s.notes, u.userid
                     from support_notes s, user u where s.notes2support = $recnum and s.type='$type' and
                           notes2user = u.recnum";
//echo "$sql";
        $result = mysql_query($sql);
        return $result;

     }


    function cancelWorkOrder($inpwonum) {
        $wonum = "'" . $inpwonum ."'" ;
        $status = "'WO cancelled'";
        $condition = "'Cancelled'";
        $sql = "update support set
                status = $status,
                condition = $condition
            where wonum = $wonum";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Cancel of Work Order failed..Please report to Sysadmin " . mysql_error());

    }

function getsupports($cond,$argsort1,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;
        if($sortorder=='')
        $sortorder="s.recnum";

             $sql = "select s.recnum,s.supp2type,s.type,s.status,s.condition,TO_DAYS(CURDATE())-TO_DAYS(s.create_date),create_date from  support s where  $wcond ORDER by $sortorder limit $offset, $limit";
	//echo "$sql";
             $result = mysql_query($sql);
             return $result;
}

function getSrid($argsupp2type)
{
             $supp2type=$argsupp2type;
             $sql = "select srnum from serv_req where recnum=$supp2type";
             //echo "$sql";
             $result = mysql_query($sql);
             return $result;
}

function getRmaid($argsupp2type)
{
             $supp2type=$argsupp2type;
             $sql = "select rmaid from rma where recnum=$supp2type";
             //echo "$sql";
             $result = mysql_query($sql);
             return $result;
}

function getEcoid($argsupp2type)
{
             $supp2type=$argsupp2type;
             $sql = "select econum from eco where recnum=$supp2type";
             //echo "$sql";
             $result = mysql_query($sql);
             return $result;
}


function getcontacts4support($argsupp2type,$argtype)
{
   $supp2type=$argsupp2type;
   $type=$argtype;
    $sql = "select  distinct c.name,c.phone,cont.fname,cont.lname,cont.phone,cont.email,e.fname,e.lname,e.phone,e.email,s.supp2customer,s.supp2contact,s.supp2employee
            from  company c, contact cont, employee e,support s
            where s.supp2type =$supp2type and
 	              s.type ='$type' and
                  s.supp2customer = c.recnum and
                  s.supp2contact = cont.recnum and
                  s.supp2employee = e.recnum ";
//echo "<br>$sql</br>";
             $result = mysql_query($sql);
             return $result;
}

function getwonum4support($argsupp2type,$argtype)
{
   $supp2type=$argsupp2type;
   $type=$argtype;
   $sql = "select  supp2wo from support where supp2type =$supp2type and
 	             type ='$type'";
	//echo "<br>$sql<br>";
             $result = mysql_query($sql);
             return $result;
}


function getsolnum4support($argsupp2type,$argtype)
{
      $supp2type=$argsupp2type;
      $type=$argtype;
             $sql = "select  supp2solution from support where supp2type =$supp2type and
 	             type ='$type'";
	        //echo "<br>$sql<br>";
             $result = mysql_query($sql);
             $myrow = mysql_fetch_row($result);
             $sql1 = "select  recnum,solnum from solution where recnum=$myrow[0]";
             $result1 = mysql_query($sql1);
             return $result1;
}
//-----------------------------------------------------------------------------------------------------------------------------------------------
function getsupportCount($cond,$argoffset, $arglimit)
{
       $wcond = $cond;
       $offset = $argoffset;
       $limit = $arglimit;
             $sql = "select count(*) as numrows from  support s where  $wcond limit $offset, $limit";
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       //echo "</br >$sql<br>";
       $result  = mysql_query($sql) or die('Service Request count query failed');
       $row     = mysql_fetch_array($result, MYSQL_ASSOC);
       $numrows = $row['numrows'];
       return $numrows;
}
// function to find out work orders related to specific Purchse Order coded by Jerry George Jan-05
} // End Support class definition
