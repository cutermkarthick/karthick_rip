<? 
//====================================
// Author: FSI
// Date-written = June 20, 2004 Jerry George
// Filename: pagefieldsClass.php
// Maintains the class for SR Billitems
// Revision: v1.0
//====================================

include_once('loginClass.php');  

class pagefields{ 

    var    
     $seqnum,
     $lname,
     $fname,
     $type,
     $link2pname,
     $mandatory,
     $pgroup,
     $status;
        
    // Constructor definition 
    function pagefields() { 
        $this->seqnum = ''; 
        $this->lname= ''; 
        $this->fname = ''; 
        $this->type = '';
        $this->link2pname = '';
        $this->mandatory = '';
     $this->pgroup= '';
     $this->status= '';


     } 
     
    // Property get and set
    function getseqnum() {
           return $this->seqnum;
    }

    function setseqnum ($reqseqnum) {

           $this->seqnum = $reqseqnum;
    }

    function getlname() {
           return $this->lname;
    }

    function setlname ($reqlname) {
           $this->lname = $reqlname;
    }
 
    function getfname() {
           return $this->fname;
    }

    function setfname ($reqfname) {
           $this->fname = $reqfname;
    }
    function gettype() {
           return $this->type;
    }

    function settype ($reqtype) {
           $this->type = $reqtype;
    }

    function getlink2pname() {
           return $this->link2pname;
    }

    function setlink2pname ($reqlink2pname) {
           $this->link2pname = $reqlink2pname;
    }
    function getmandatory() {
           return $this->mandatory;
    }

    function setmandatory ($reqmandatory) {
           $this->mandatory = $reqmandatory;
    }

    function getpgroup() {
           return $this->pgroup;
    }

    function setpgroup ($reqpgroup) {
           $this->pgroup = $reqpgroup;
    }

    function getstatus() {
           return $this->status;
    }

    function setstatus ($reqstatus) {
           $this->status = $reqstatus;
    }


    function addFI() { 
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'm_pagefields' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for Page Fields ..Please report to Sysadmin. " . mysql_error()); 
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crdate = "'" . date("y-m-d") . "'";
        $seqnum = "'" . $this->seqnum . "'";
        $lname = "'" . $this->lname . "'";
        $fname = "'" . $this->fname . "'";
        $type = "'" . $this->type . "'";
        $link2pname = $this->link2pname;
        $mandatory = "'" . $this->mandatory . "'";
        $pgroup = "'" . $this->pgroup . "'";
        $status = "'" . $this->status . "'";
        $siteid = "'" . $_SESSION['siteid'] . "'";

        $sql = "INSERT INTO m_pagefields(recnum, seqnum,lname,fname, type, link2pname,mandatory,pgroup,status,siteid) 
	  VALUES ($objid, $seqnum,$lname,$fname,$type, $link2pname,$mandatory,$pgroup,$status,$siteid)";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to Page Fields didn't work..Please report to Sysadmin. " . mysql_error()); 
        }
        $sql = "update seqnum set nxtnum = $objid where tablename = 'm_pagefields'";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for Page Fields.Please report to Sysadmin. " . mysql_error()); 
        }
     } 

    function updateFI($recnum) { 
        $birecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $seqnum = "'" . $this->seqnum . "'";
        $lname = "'" . $this->lname . "'";
        $fname = "'" . $this->fname . "'";
        $type = "'" . $this->type . "'";
        $link2pname = $this->link2pname;
        $mandatory = "'" . $this->mandatory . "'";
        $pgroup = "'" . $this->pgroup . "'";
        $status = "'" . $this->status . "'";

        $sql = "update m_pagefields
                          set seqnum = $seqnum,
	              lname=$lname,
                              fname = $fname,
                              type = $type,
	              mandatory=$mandatory,
	              pgroup =$pgroup ,
	              status=$status
                        where recnum = $birecnum";
                        

           $result = mysql_query($sql);
           // Test to make sure query worked 
           if(!$result) die("Update to Page Fields didn't work..Please report to Sysadmin. " . mysql_error()); 

     } 



     function getFields($argrecnum)
     {
         $sql = "select pf.*,p.pname from m_pagefields pf,m_pagename p where link2pname=$argrecnum and pf.link2pname=p.recnum and pf.type <> 'Qty' ORDER By pf.recnum"; 
//echo "$sql";
             $result = mysql_query($sql);
             return $result;
     }

     function getGroups($argrecnum)
     {
        $sql="select distinct f.pgroup from m_pagefields f  where f.link2pname=$argrecnum";
//echo "$sql";
             $result = mysql_query($sql);
             return $result;
     }

     function getPname($argrecnum)
     {
        $sql="select pname,parent from m_pagename  where recnum=$argrecnum";
//echo "$sql";
             $result = mysql_query($sql);
             return $result;
     }





     function deleteFD($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $recnum =$inprecnum;
        $sql = "delete from fields where recnum = $recnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Page Fields Items failed...Please report to SysAdmin. " . mysql_error()); 
      }

} // End pageFields class definition 


