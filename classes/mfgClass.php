<?
//====================================
// Author: FSI
// Date-written = June 17, 2005
// Filename: mfgClass.php
// Maintains the class for Manufaturing
// Revision: v1.0
//====================================

include_once('loginClass.php');

class mfg {

    var $mfg_id,
        $mfg_desc,
        $orderdate,
        $link2company,
        $link2contact,
        $createDate;

    // Constructor definition
    function mfg() {
        $this->mfg_id = '';
        $this->mfg_desc = '';
        $this->createDate = '';
        $this->orderdate = '';
        $this->link2company= '';
        $this->link2contact= '';


    }

    // Property get and set
    function getmfg_id() {
           return $this->mfg_id;
    }

    function setmfg_id ($reqmfg_id) {
           $this->mfg_id = $reqmfg_id;
    }

    function getcreatedate() {
           return $this->createDate;
    }

    function setcreatedate ($req_createdate) {
           $this->createDate = $req_createdate;
    }
    function getorderdate() {
           return $this->orderdate;
    }

    function setorderdate ($req_orderdate) {
           $this->orderdate = $req_orderdate;
    }

    function getmfg_desc() {
           return $this->mfg_desc;
    }

    function setmfg_desc ($reqmfg_desc) {
           $this->mfg_desc = $reqmfg_desc;
    }
    function getlink2company() {
           return $link2company;
    }

    function setlink2company ($reqlink2company) {
           $this->link2company = $reqlink2company;
    }
    function getlink2contact() {
           return $link2contact;
    }

    function setlink2contact ($reqlink2contact) {
           $this->link2contact = $reqlink2contact;
    }


    function addmfg() {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'mfg_order' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crdate = "'" . date("y-m-d") . "'";
        $orderdate = "'" . $this->orderdate . "'";
        $mfg_id = "'" . $this->mfg_id . "'";
        $mfg_desc = "'" . $this->mfg_desc . "'";
        $username = "'" . $_SESSION["user"] . "'";

        $link2company = $this->link2company;
        $link2contact = $this->link2contact;

        $sql = "select * from mfg_order where mfg_id = $mfg_id";

        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO mfg_order (recnum,mfg_id, mfg_desc,orderdate, link2company ,link2contact,create_date)
               VALUES ($objid, $mfg_id,  $mfg_desc,$orderdate,$link2company ,$link2contact,curdate())";
//echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to mfg_order dmfg_idn't work..Please report to Sysadmin. " . mysql_error());
         }
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("mfg_order  mfg_id " . $mfg_id . " already exists. ");
            echo "</td></tr></table>";
         }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'mfg_order'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for Quote Insert..Please report to Sysadmin. " . mysql_error());
        return $objid;
     }

    function getmfgs() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select mfg_id,mfg_desc,orderdate,recnum from mfg_order";
        $result = mysql_query($sql);
        return $result;

     }

     function getmfg($mfgrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select m.mfg_id, m.mfg_desc, m.orderdate ,m.recnum,m.link2company,m.link2contact,c.name,co.fname, co.lname, co.phone, co.email
                       from
		mfg_order m,company c, contact co
	       where
		m.link2company = c.recnum and
                                m.link2contact = co.recnum and
		m.recnum = $mfgrecnum";
//echo "$sql";
        $result = mysql_query($sql);
        return $result;
     }

     function updatemfg($mfgrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $mfg_id = "'" . $this->mfg_id . "'";
        $mfg_desc = "'" . $this->mfg_desc . "'";
        $orderdate = "'" . $this->orderdate . "'";
        $link2company = $this->link2company;
        $link2contact = $this->link2contact;

        $sql = "update mfg_order set
                                 mfg_desc = $mfg_desc,
                                 orderdate = $orderdate,
		 link2company=$link2company,
		 link2contact=$link2contact
                                   where recnum = $mfgrecnum";
//echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("mfg update failed...Please report to SysAdmin. " . mysql_error());
        }

     function deletemfg($mfgrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from mfg_order where recnum = $mfgrecnum";
        $result = mysql_query($sql);
        if(!$result) die("Delete for mfg_order failed...Please report to SysAdmin. " . mysql_error());
      }

   /*  function deletemfg($quotenum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $quotemfg_id = "'" . $quotenum . "'";
        $sql = "delete from mfg_order where mfg_id = $quotemfg_id";
        $result = mysql_query($sql);
        if(!$result) die("Delete for mfg_order failed...Please report to SysAdmin. " . mysql_error());
      }
    */

    function getwo4Mo($cond,$argoffset,$arglimit) {
        $wcond=$cond;
        $limit=$arglimit;
        $offset=$argoffset;
              $sql = "select w.wonum, w.wotype, c.name, w.po_num,w.quote_num,
                           w.status,w.condition, w.wo2type, emp.fname, emp.lname,
                           w.create_date, w.recnum, w.descr, u.initials,
                           date_format(w.sch_due_date,'%y-%m-%d'),
                           date_format(w.actual_ship_date,'%y-%m-%d')
                           from work_order w, company c, user u, employee emp
                           where $wcond and
	           w.wo2mfg is NULL and
                           w.wo2customer = c.recnum and
                           w.wo2employee = emp.recnum and
                           w.condition = 'Open' and
                           u.user2employee = emp.recnum
                           ORDER by w.wonum";
//echo "$sql";
        $result = mysql_query($sql) or die('Get wo for PO failed');
        return $result;
     }

     function getwo4Mocount($cond,$argoffset,$arglimit) {
        $wcond=$cond;
        $limit=$arglimit;
        $offset=$argoffset;
               $sql = "select max(w.recnum) as maxrecno
                           from work_order w, company c, user u, employee emp
                           where $wcond and
	           w.wo2mfg is NULL and
                           w.wo2customer = c.recnum and
                           w.wo2employee = emp.recnum and
                           w.condition = 'Open' and
                           u.user2employee = emp.recnum
";
//echo "$sql</br>";
        $result  = mysql_query($sql) or die('WO count query failed');
        return $result;

     }


    function addwo4mfg($cond,$mfgrecnum,$offset, $rowsPerPage) {
        $wcond=$cond;
       // $limit=$arglimit;
      //  $offset=$argoffset;
              $sql = "select w.wonum, w.wotype, c.name, w.po_num,w.quote_num,
                           w.status,w.condition, w.wo2type, emp.fname, emp.lname,
                           w.create_date, w.recnum, w.descr, u.initials,
                           date_format(w.sch_due_date,'%y-%m-%d'),
                           date_format(w.actual_ship_date,'%y-%m-%d')
                           from work_order w, company c, user u, employee emp
                           where $wcond and
	           w.wo2mfg is NULL and
                           w.wo2customer = c.recnum and
                           w.wo2employee = emp.recnum and
                           w.condition = 'Open' and
                           u.user2employee = emp.recnum
                           ORDER by w.wonum";
//echo "$sql";
        $result = mysql_query($sql) or die('Get wo for PO failed');
        return $result;
     }

     function getAddwocount4mfg($cond,$mfgrecnum,$argoffset,$arglimit) {
        $wcond=$cond;
        $limit=$arglimit;
        $offset=$argoffset;
               $sql = "select max(w.recnum) as maxrecno
                           from work_order w, company c, user u, employee emp
                           where $wcond and
	           w.wo2mfg is NULL and
                           w.wo2customer = c.recnum and
                           w.wo2employee = emp.recnum and
                           w.condition = 'Open' and
                           u.user2employee = emp.recnum
";
//echo "$sql</br>";
        $result  = mysql_query($sql) or die('WO count query failed');
        return $result;

     }



function getwo4mfg($mfgrecnum)
{
              $sql = "select w.wonum, w.wotype, c.name, w.po_num,w.quote_num,
                           w.status,w.condition, w.wo2type, emp.fname, emp.lname,
                           w.create_date, w.recnum, w.descr, u.initials,
                           date_format(w.sch_due_date,'%y-%m-%d'),
                           date_format(w.actual_ship_date,'%y-%m-%d')
                        from work_order w, company c, user u, employee emp
                        where
	                       w.wo2mfg =$mfgrecnum and
                           w.wo2customer = c.recnum and
                           w.wo2employee = emp.recnum and
                           u.user2employee = emp.recnum
                           ORDER by w.wonum";
//echo "$sql";
        $result = mysql_query($sql) or die('Get wo for MFG failed');
        return $result;
}

   function getwo4mfgcnt($mfgrecnum) {
              $sql = "select max(w.recnum) as maxrecno
                           from work_order w, company c, user u, employee emp
                           where
	           w.wo2mfg =$mfgrecnum and
                           w.wo2customer = c.recnum and
                           w.wo2employee = emp.recnum and
                           w.condition = 'Open' and
                           u.user2employee = emp.recnum
";
//echo "$sql</br>";
        $result  = mysql_query($sql) or die('WO count query failed');
        return $result;

     }
     function insertmfg($mfgrecnum,$worecnum)
   {
             $sql = "update work_order set
                                      wo2mfg = $mfgrecnum
                         where recnum = $worecnum";
          $result = mysql_query($sql);
//echo "$sql";
        // Test to make sure query worked
        if(!$result) die("Update of Work Order failed..Please report to Sysadmin " . mysql_error());

  }

function manageWo($argmodify,$argmfgrecnum,$argworecnum)
{
	$modify=$argmodify;
	$mfgrecnum=$argmfgrecnum;
	$worecnum=$argworecnum;
	$newlogin = new userlogin;
	$newlogin->dbconnect();
	if($modify=="LinkWO")
	{
	           $sql = "UPDATE  work_order SET wo2mfg=$mfgrecnum WHERE recnum=$worecnum";
	}
	else
	{
	           $sql = "UPDATE  work_order SET wo2mfg=NULL WHERE recnum=$worecnum";
	}
//echo "$sql";
      	$result = mysql_query($sql);
	if(!$result) die("Update of Work Order failed..Please report to Sysadmin " . mysql_error());

}

} // End mfg_order class definition
