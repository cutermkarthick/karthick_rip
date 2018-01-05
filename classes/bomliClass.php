<?
//====================================
// Author: FSI
// Date-written = May 25,2005
// Filename: bomliClass.php
// Maintains the class for BOM Line items
// Revision: v1.0
//====================================

include_once('loginClass.php');

class bomli {

    var
     $linenum,
     $itemname,
     $itemdesc,
     $itemvalue,
     $mfr,
     $mfrpn,
     $suppliedby,
     $qty,
     $rate,
     $amount,
     $comments,
     $link2bom,
     $workcenter,
     $status;


    // Constructor definition
    function bomli() {
        $this->linenum = '';
        $this->itemname = '';
        $this->itemdesc = '';
        $this->itemvalue = '';
        $this->mfr = '';
        $this->mfrpn = '';
        $this->suppliedby = '';
        $this->qty = '';
        $this->rate = '';
        $this->amount = '';
        $this->comments = '';
        $this->workcenter = '';
        $this->link2bom = '';
        $this->link2vendor = '';
        $this->link2parts = '';
     }

    // Property get and set
    function getlinenum() {
           return $this->linenum;
    }

    function setlinenum ($reqlinenum) {

           $this->linenum = $reqlinenum;
    }

    function getitemname() {
           return $this->itemname;
    }

    function setitemname ($reqitemname) {
           $this->itemname = $reqitemname;
    }
    function getitemvalue() {
           return $this->itemvalue;
    }
    function setitemvalue ($reqitemvalue) {
           $this->itemvalue = $reqitemvalue;
    }

    function getitemdesc() {
           return $this->itemdesc;
    }
    function setitemdesc ($reqitemdesc) {
           $this->itemdesc = $reqitemdesc;
    }
    function getmfr() {
           return $this->mfr;
    }
    function setmfr ($reqmfr) {
           $this->mfr = $reqmfr;
    }
    function getmfrpn() {
           return $this->mfrpn;
    }
    function setmfrpn ($reqmfrpn) {
           $this->mfrpn = $reqmfrpn;
    }
    function getqty() {
           return $this->qty;
    }

    function setqty ($reqqty) {
           $this->qty = $reqqty;
    }
    function getrate() {
           return $this->rate;
    }

    function setrate ($reqrate) {
           $this->rate = $reqrate;
    }
    function getamount() {
           return $this->amount;
    }

    function setamount ($reqamount) {
           $this->amount = $reqamount;
    }

    function getsuppliedby() {
           return $this->suppliedby;
    }

    function setsuppliedby ($reqsuppliedby) {
           $this->suppliedby = $reqsuppliedby;
    }
    function getlink2bom() {
           return $this->link2bom;
    }

    function setlink2bom ($reqlink2bom) {
           $this->link2bom = $reqlink2bom;
    }

    function getcomments() {
           return $this->comments;
    }

    function setcomments($reqcomments) {
           $this->comments = $reqcomments;
    }
    function getstatus() {
           return $this->status;
    }

    function setstatus($reqstatus) {
           $this->status = $reqstatus;
    }
    function getlink2vendor() {
           return $this->link2vendor;
    }

    function setlink2vendor ($reqlink2vendor) {
           $this->link2vendor = $reqlink2vendor;
    }
    function getlink2parts() {
           return $this->link2parts;
    }

    function setlink2parts ($reqlink2parts) {
           $this->link2parts = $reqlink2parts;
    }
    function getworkcenter() {
           return $this->workcenter;
    }
    function setworkcenter ($workcenter) {
           $this->workcenter = $workcenter;
    }

    function addLi() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'bom_line_items' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for LI..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crdate = "'" . date("y-m-d") . "'";
        $line_num = "'" . $this->linenum . "'";
        $item_name = "'" . $this->itemname . "'";
        $item_desc = "'" . $this->itemdesc . "'";
        $item_value = "'" . $this->itemvalue . "'";
        $mfr = "'" . $this->mfr . "'";
        $mfrpn =  "'" . $this->mfrpn . "'";
        $supplied_by = "'" . $this->suppliedby . "'";
        $qty = $this->qty;
        $rate = $this->rate;
        $amount = $this->amount;
        $comments = "'" . $this->comments . "'";
        $workcenter ="'" .$this->workcenter . "'";
        $link2bom = $this->link2bom;
        $link2vendor = $this->link2vendor;
        $link2parts = $this->link2parts;
        $status= "'" . $this->status . "'";

        $sql = "INSERT INTO bom_line_items (recnum, line_num, item_name, item_desc, item_value, mfr,
                                            mfr_pn,supplied_by, qty, rate, amount, link2bom,
                                            comments, creation_date,status,link2vendor,link2parts,workcenter)
                                    VALUES ($objid, $line_num, $item_name, $item_desc, $item_value, $mfr,
                                            $mfrpn,$supplied_by, $qty, $rate, $amount, $link2bom,
                                            $comments, $crdate,$status,$link2vendor,$link2parts,$workcenter)";
        //echo $sql;
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to BOM LI didn't work..Please report to Sysadmin. " . mysql_error());
        }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'bom_line_items'";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert didn't work for BOM LI..Please report to Sysadmin. " . mysql_error());
        }

        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Commit failed for BOM LI Insert..Please report to Sysadmin. " . mysql_error());
        }
     }

    function updateLI($recnum) {
        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $line_num = "'" . $this->linenum . "'";
        $item_name = "'" . $this->itemname . "'";
        $item_desc = "'" . $this->itemdesc . "'";
        $item_value = "'" . $this->itemvalue . "'";
        $mfr = "'" . $this->mfr . "'";
        $mfrpn =  "'" . $this->mfrpn . "'";
        $supplied_by = "'" . $this->suppliedby . "'";
        $qty = $this->qty;
        $rate = $this->rate;
        $amount = $this->amount;
        $comments = "'" . $this->comments . "'";
        $link2bom = $this->link2bom;
        $link2vendor = $this->link2vendor;
        $link2parts = $this->link2parts;
        $status= "'" . $this->status . "'";
        $workcenter = "'" . $this->workcenter . "'";

        $sql = "update bom_line_items
                set  line_num = $line_num,
                     item_name = $item_name,
                     item_desc = $item_desc,
                     qty = $qty,
                     item_value = $item_value,
                     supplied_by = $supplied_by,
                     mfr = $mfr,
                     mfr_pn = $mfrpn,
                     rate = $rate,
                     comments = $comments,
                     amount = $amount,
                     link2vendor = $link2vendor,
                     link2parts = $link2parts,
                     workcenter = $workcenter,
                     status = $status
                where recnum = $lirecnum";
           $result = mysql_query($sql);

           // Test to make sure query worked
           if(!$result) die("Update to BOM LI didn't work..Please report to Sysadmin. " . mysql_error());

     }


     function getLIprelim($inpbomrecnum) {
        $bomrecnum = $inpbomrecnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select line_num, item_name, item_desc, item_value,
                       supplied_by, mfr, mfr_pn, qty, rate, amount,
                       comments, recnum,item_name,link2vendor,link2parts,workcenter
                   from bom_line_items
                   where link2bom = $bomrecnum";
        $result = mysql_query($sql);
        return $result;
     }

  function getLIinitial($inpbomrecnum) {
        $bomrecnum = $inpbomrecnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select line_num, item_name, item_desc, item_value,
                       supplied_by, mfr, mfr_pn, qty, rate, amount,
                       comments, recnum,item_name,workcenter
                   from bom_line_items
                   where link2bom = $bomrecnum and status= 'Initial'";

        $result = mysql_query($sql);
        return $result;
     }
     function getLIfinal($inpbomrecnum) {
        $bomrecnum = $inpbomrecnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select line_num, item_name, item_desc, item_value,
                       supplied_by, mfr, mfr_pn, qty, rate, amount,
                       comments, recnum,item_name,workcenter
                   from bom_line_items
                   where link2bom = $bomrecnum and status ='Final'";
        $result = mysql_query($sql);
echo $sql;
        return $result;
     }

function getLIfinal4Compare($bomrecnum,$linenum)
{

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select line_num, item_name, item_desc, item_value,
                       supplied_by, mfr, mfr_pn, qty, rate, amount,
                       comments, recnum,item_name,workcenter
                   from bom_line_items
                   where link2bom = $bomrecnum and line_num='$linenum'  and status ='Initial'";

        $result = mysql_query($sql);
        return $result;
}

function getLI4prelim($bomrecnum)
{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql= "select line_num  from bom_line_items where  link2bom=$bomrecnum and status = 'Initial'";
        $result = mysql_query($sql);

        $list ="(";
        if ($myrow=mysql_fetch_row($result))
		$list=$list . $myrow[0] ;
        else
        $list= $list . 0;
        while ($myrow= mysql_fetch_row($result))
        {
		$list= $list . "," . $myrow[0];

        }
        $list =$list . ")";

        $sql = "select line_num, item_name, item_desc, item_value,
                       supplied_by, mfr, mfr_pn, qty, rate, amount,
                       comments, recnum,item_name,workcenter
                   from bom_line_items
                   where link2bom = $bomrecnum and
	         line_num not in $list  and status ='Prelim'";

        $result = mysql_query($sql);
        return $result;
}

function getLI4final($bomrecnum)
{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql= "select line_num  from bom_line_items where  link2bom=$bomrecnum and status = 'Prelim'";
        $result = mysql_query($sql);

        $list ="(";
        if ($myrow=mysql_fetch_row($result))
		$list=$list . $myrow[0] ;
        else
        $list= $list . 0;
        while ($myrow= mysql_fetch_row($result))
        {
		$list= $list . "," . $myrow[0];

        }
        $list =$list . ")";

        $sql = "select line_num, item_name, item_desc, item_value,
                       supplied_by, mfr, mfr_pn, qty, rate, amount,
                       comments, recnum,item_name,workcenter
                   from bom_line_items
                   where link2bom = $bomrecnum and
	         line_num not in $list  and status ='Final'";

        $result = mysql_query($sql);
        return $result;
}


function getLI4Initial($bomrecnum)
{
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql= "select line_num  from bom_line_items where  link2bom=$bomrecnum and status = 'Prelim'";
        $result = mysql_query($sql);

        $list ="(";
        if ($myrow=mysql_fetch_row($result))
		$list=$list . $myrow[0] ;
        else
        $list= $list . 0;
        while ($myrow= mysql_fetch_row($result))
        {
		$list= $list . "," . $myrow[0];

        }
        $list =$list . ")";

        $sql = "select line_num, item_name, item_desc, item_value,
                       supplied_by, mfr, mfr_pn, qty, rate, amount,
                       comments, recnum,item_name,workcenter
                   from bom_line_items
                   where link2bom = $bomrecnum and
	         line_num not in $list  and status ='Initial'";

        $result = mysql_query($sql);
        return $result;
}


     function deleteLI($inplirecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $lirecnum = $inplirecnum;
        $sql = "delete from bom_line_items where recnum = $lirecnum";

        $result = mysql_query($sql);
        if(!$result) die("Delete for BOM Line Items failed...Please report to SysAdmin. " . mysql_error());
      }


} // End bom class definition