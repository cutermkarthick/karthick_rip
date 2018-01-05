<?
//====================================
// Author: FSI
// Date-written = June 9, 2005 by Jerry George
// Filename: solutionClass.php
// Maintains the class for Solution
// Revision: v1.0
//====================================

include_once('loginClass.php');

class solution {

    var $solnum,
        $title,
        $prob_desc,
        $sol_desc,
        $type,
        $sol_upload_file,
        $createdate;




    // Constructor definition
    function solution() {
        $this->solnum = '';
        $this->title = '';
        $this->prob_desc = '';
        $this->sol_desc = '';
        $this->type = '';
        $this->sol_upload_file = '';
        $this->createdate = '';

    }

    // Property get and set
    function getsolnum() {
           return $this->solnum;
    }

    function setsolnum ($reqsolnum) {
           $this->solnum = $reqsolnum;
    }

    function gettitle() {
           return $this->title;
    }

    function settitle ($req_title) {
           $this->title = $req_title;
    }
    function getprob_desc() {
           return $this->prob_desc;
    }

    function setprob_desc($req_prob_desc) {
           $this->prob_desc = $req_prob_desc;
    }

    function getsol_desc() {
           return $this->sol_desc;
    }

    function setsol_desc($reqsol_desc) {
           $this->sol_desc = $reqsol_desc;
    }

    function gettype() {
           return $this->type;
    }

    function settype ($reqtype) {
           $this->type = $reqtype;
    }

    function getsol_upload_file() {
           return $this->sol_upload_file;
    }

    function setsol_upload_file($reqsol_upload_file) {
           $this->sol_upload_file = $reqsol_upload_file;
    }

    function getcreatedate() {
           return $this->createdate;
    }
    function setcreatedate($createdate) {
           $this->createdate = $createdate;
    }



    function addsolution() {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'solution' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $createdate = "'" . date("y-m-d") . "'";
        $solnum = "'" . $this->solnum . "'";
        $title = "'" . $this->title . "'";
        $prob_desc = "'" . $this->prob_desc . "'";
        $sol_desc = "'" . $this->sol_desc . "'";
        $type = "'" . $this->type . "'";
        //echo "$sol_desc</br>";
        $sol_upload_file = "'" . $this->sol_upload_file . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $sql = "select * from solution where solnum = $solnum";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO solution (recnum,solnum,title,prob_desc,sol_desc,type,sol_upload_file)
               VALUES ($objid,$solnum,$title,$prob_desc,$sol_desc,$type,$sol_upload_file)";
              // echo "$sql";
               $result = mysql_query($sql);
              // Test to make sure query worked
              if(!$result) {die("Insert to Solution didn't work..Please report to Sysadmin. " . mysql_error()); }
         }
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Solution ID " . $solnum . " already exists. ");
            echo "</td></tr></table>";
         }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'solution'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for Solution Insert..Please report to Sysadmin. " . mysql_error());
     }

function getsols($cond,$argsort1,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;
        if($sortorder=='')
         $sortorder="s.solnum";

             $sql = "select s.recnum ,s.solnum,s.title,s.type,s.sol_upload_file,s.prob_desc,s.sol_desc from solution s where    $wcond  ORDER by $sortorder limit $offset, $limit";
	//echo "$sql";
             $result = mysql_query($sql);
             return $result;
}


function getsolcount($cond,$argoffset, $arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
             $sql = "select count(*) as numrows from solution s where  $wcond  limit $offset, $limit";
        $newlogin = new userlogin;
       $newlogin->dbconnect();
//echo "$sql";
$result  = mysql_query($sql) or die('Solution count query failed');
$row     = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];
return $numrows;

}


function getsols4prntUpd($argsolrecnum)
{
             $solrecnum=$argsolrecnum;
             $sql = "select recnum ,solnum,title,type,prob_desc,sol_desc,sol_upload_file from solution where recnum=$solrecnum";
	//echo "$sql";
             $result = mysql_query($sql);
             return $result;
}


     function updatesolution($solnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $createdate = "'" . date("y-m-d") . "'";
        $solnum = "'" . $this->solnum . "'";
        $title = "'" . $this->title . "'";
        $prob_desc = "'" . $this->prob_desc . "'";
        $sol_desc = "'" . $this->sol_desc . "'";
        $type = "'" . $this->type . "'";
        //echo "$sol_desc</br>";
        $sol_upload_file = "'" . $this->sol_upload_file . "'";
        $sql = "update solution set
                                 title = $title,
                                 prob_desc = $prob_desc,
		 sol_desc=$sol_desc,type= $type, sol_upload_file= $sol_upload_file
		where solnum = $solnum";
//echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Solution update failed...Please report to SysAdmin. " . mysql_error());
        }

     function deleteSolution($solrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from solution where recnum = $solrecnum";
        $result = mysql_query($sql);
        if(!$result) die("Delete for solution failed...Please report to SysAdmin. " . mysql_error());
      }




} // End quoteclass definition