<?
//====================================
// Author: FSI
// Date-written = April 27,2010
// Filename: bomli_consumeClass.php
// Maintains the class for BOM Consumables Line items
// Revision: v1.0
//====================================

include_once('loginClass.php');

class bomli_consume_items {

    var
     $linenum,
     $itemno,
     $descr,
     $spec,
     $issue,
     $supplier,
     $qpa,
     $link2bom,
	 $partnum;


    // Constructor definition
    function bomli_consume_items() {
        $this->linenum = '';
        $this->itemno = '';
        $this->descr = '';
        $this->spec = '';
        $this->issue = '';
        $this->supplier = '';
        $this->qpa = '';
        $this->link2bom = '';
		$this->partnum = '';
     }

    // Property get and set
    function getlinenum() {
           return $this->linenum;
    }

    function setlinenum ($reqlinenum) {
           $this->linenum = $reqlinenum;
    }

    function getitemno() {
           return $this->itemno;
    }

    function setitemno ($reqitemno) {
           $this->itemno = $reqitemno;
    }

    function getdescr() {
           return $this->descr;
    }
    function setdescr ($reqdescr) {
           $this->descr = $reqdescr;
    }

    function getspec() {
           return $this->spec;
    }
    
    function setspec($reqspec) {
           $this->spec = $reqspec;
    }
    function getissue() {
           return $this->issue;
    }
    function setissue ($reqissue) {
           $this->issue = $reqissue;
    }
    function getsupplier() {
           return $this->supplier;
    }
    function setsupplier ($reqsupplier) {
           $this->supplier = $reqsupplier;
    }
    function getqpa() {
           return $this->qpa;
    }

    function setqpa ($reqqpa) {
           $this->qpa = $reqqpa;
    }

    function getlink2bom() {
           return $this->link2bom;
    }

    function setlink2bom ($reqlink2bom) {
           $this->link2bom = $reqlink2bom;
    }

	  function getpartnum() {
           return $this->partnum;
    }

    function setpartnum($partnum) {
           $this->partnum = $partnum;
    }

    function addLi() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'bom_consume' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for LI..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $line_num = "'" . $this->linenum . "'";
        $itemno = "'" . $this->itemno . "'";
        $descr = "'" . $this->descr . "'";
        $spec = "'" . $this->spec . "'";
        $issue = "'" . $this->issue . "'";
        $supplier =  "'" . $this->supplier . "'";
        $qpa = "'" . $this->qpa . "'";
        $link2bom = $this->link2bom;
		$partnum =  "'". $this->partnum . "'";

        $sql = "INSERT INTO bom_consume (recnum, line_num, item_no, descr, spec, issue,
                                            supplier, qpa, link2bom,partnum)
                                    VALUES ($objid, $line_num, $itemno, $descr, $spec, $issue,
                                            $supplier, $qpa, $link2bom,$partnum)";
        //echo $sql;
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to BOM Consume Items didn't work..Please report to Sysadmin. " . mysql_error());
        }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'bom_consume'";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert didn't work for BOM Consume Items..Please report to Sysadmin. " . mysql_error());
        }

        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Commit failed for BOM Consume Items LI Insert..Please report to Sysadmin. " . mysql_error());
        }
     }

    function updateLI($recnum) {
        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $line_num = "'" . $this->linenum . "'";
        $itemno = "'" . $this->itemno . "'";
        $descr = "'" . $this->descr . "'";
        $spec = "'" . $this->spec . "'";
        $issue = "'" . $this->issue . "'";
        $supplier =  "'" . $this->supplier . "'";
        $qpa =  "'" . $this->qpa . "'";
		$partnum =  "'". $this->partnum . "'";

        $sql = "update bom_consume
                set  line_num = $line_num,
                     item_no = $itemno,
                     descr = $descr,
                     spec = $spec,
                     issue = $issue,
                     supplier = $supplier,
                     qpa = $qpa,
					 partnum=$partnum
                where recnum = $lirecnum";
           //echo $sql;
           $result = mysql_query($sql);

           // Test to make sure query worked
           if(!$result) die("Update to BOM Bought Items LI didn't work..Please report to Sysadmin. " . mysql_error());

     }


     function getLI($inpbomrecnum) {
        $bomrecnum = $inpbomrecnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select recnum,line_num, item_no, descr, spec,
                       issue, supplier, qpa, link2bom,partnum
                   from bom_consume
                   where link2bom = $bomrecnum";
				  // echo $sql;
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
        //echo $sql;
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
