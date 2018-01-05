<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: assypoliClass.php
// Maintains the class for Assypo Line items
// Revision: v1.0
//====================================

include_once('loginClass.php');

class assypo_line_items {

    var
     $linenum,
     $crn,
     $pri_partnum,
     $sec_partnum,
     $partname,
     $qty,
     $partiss,
     $drgiss,
     $mtlspec,
     $mtltype,
     $rmcond,
     $link2assypo,
     $price,
     $extprice,
     $cos;

    // Constructor definition
    function assypo_line_items() {
        $this->linenum = '';
        $this->crn = '';
        $this->pri_partnum = '';
        $this->sec_partnum = '';
        $this->partname = '';
        $this->qty = '';
        $this->partiss= '';
        $this->drgiss = '';
        $this->mtlspec = '';
        $this->mtltype = '';
        $this->rmcond = '';
        $this->link2assypo = '';
        $this->price = '';
        $this->extprice = '';
        $this->cos = '';
     }

    // Property get and set
    function getlinenum() {
           return $this->linenum;
    }

    function setlinenum ($reqlinenum) {
           $this->linenum = $reqlinenum;
    }

    function getcrn() {
           return $this->crn;
    }

    function setcrn ($reqcrn) {
           $this->crn = $reqcrn;
    }

    function getpri_partnum() {
           return $this->pri_partnum;
    }
    function setpri_partnum ($reqpri_partnum) {
           $this->pri_partnum = $reqpri_partnum;
    }

    function getsec_partnum() {
           return $this->sec_partnum;
    }
    function setsec_partnum ($reqsec_partnum) {
           $this->sec_partnum = $reqsec_partnum;
    }

    function getpartname() {
           return $this->partname;
    }
    function setpartname ($reqpartname) {
           $this->partname = $reqpartname;
    }

    function getqty() {
           return $this->qty;
    }

    function setqty ($reqqty) {
           $this->qty = $reqqty;
    }

    function getpartiss() {
           return $this->partiss;
    }

    function setpartiss ($reqpartiss) {
           $this->partiss = $reqpartiss;
    }

    function getdrgiss() {
           return $this->drgiss;
    }

    function setdrgiss ($reqdrgiss) {
           $this->drgiss = $reqdrgiss;
    }
    function getmtlspec() {
           return $this->mtlspec;
    }

    function setmtlspec ($reqmtlspec) {
           $this->mtlspec = $reqmtlspec;
    }

    function getmtltype() {
           return $this->mtltype;
    }

    function setmtltype ($reqmtltype) {
           $this->mtltype = $reqmtltype;
    }
    function getcos() {
           return $this->cos;
    }

    function setcos ($cos1) {
           $this->cos = $cos1;
    }
    function getlink2assypo() {
           return $this->link2assypo;
    }

    function setlink2assypo($reqlink2assypo) {
           $this->link2assypo = $reqlink2assypo;
    }
    function getprice() {
           return $this->price;
    }

    function setprice ($reqprice) {
           $this->price = $reqprice;
    }
    function getextprice() {
           return $this->extprice;
    }

    function setextprice ($reqextprice) {
           $this->extprice = $reqextprice;
    }



    function addLi() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'assypo_line_items' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for LI..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        //$crdate = "'" . date("y-m-d") . "'";
        $line_num = "'" . $this->linenum . "'";
        $crn = "'" . $this->crn . "'";
        $pri_partnum = "'" . $this->pri_partnum . "'";
        $sec_partnum = "'" . $this->sec_partnum  . "'";
        $partname = "'" . $this->partname  . "'";
        $rmcond = "'" . $this->rmcond  . "'";
        $partiss = "'" . $this->partiss  . "'";
        $drgiss = "'" . $this->drgiss  . "'";
        $qty = $this->qty?$this->qty:0;
        $link2assypo =  $this->link2assypo;
        $mtlspec = "'" . $this->mtlspec  . "'";
        $mtltype = "'" . $this->mtltype  . "'";
        $price =  $this->price?$this->price:0;
        $extprice = $this->extprice?$this->extprice:0;
        $cos = "'" . $this->cos  . "'";

        //$delvby = "'" . $this->delvby . "'";

        $sql = "INSERT INTO assypo_line_items (recnum, lineNum,
                            crnNum, pripartNum, secpartNum,link2assyPo,qty,
                            drg, partIss,partName, mtlSpec, mtlType,rmCondition,price,extPrice,cos)
                      VALUES ($objid, $line_num, $crn, $pri_partnum, $sec_partnum,
                              $link2assypo, $qty, $drgiss,
                              $partiss, $partname, $mtlspec,
                              $mtltype, $rmcond,$price,$extprice,$cos)";
        //echo "$sql";
        $result = mysql_query($sql) or die("Insert to Assypo LI didn't work..Please report to Sysadmin. " . mysql_error()); ;
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to LI didn't work..Please report to Sysadmin. " . mysql_error());
        }
         $sql = "update seqnum set nxtnum = $objid where tablename = 'assypo_line_items'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for Assypo LI..Please report to Sysadmin. " . mysql_error());
        }

        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Commit failed for Assypo LI Insert..Please report to Sysadmin. " . mysql_error());
        }
 }

function getwos4delivery()
{
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select w.recnum,w.wonum,soli.partnum,w.po_num,
                      w.actual_ship_date,w.qty,
                      c.name,
                      m.partname, m.rm_spec, m.drg_issue,
                      m.attachments,
                      soli.line_num, m.cos,g.batch_num
                 from sales_order so,
                      so_line_items soli,
                      company c,
                      master_data m,
                      work_order w,
                      grn g
                 where w.wo2customer = c.recnum and
                       w.po_num = so.po_num and
                       soli.link2so = so.recnum and
                       soli.crn_num = m.CIM_refnum and
                       m.recnum = w.link2masterdata and
                       w.grnnum = g.grnnum and
                       (so.status = 'Open' || so.status = 'Closed')
                 group by w.wonum";
       //echo $sql;
       $result = mysql_query($sql);
       return $result;
}

    function getLI($indelrecnum) {
        $indelrecnum = "'" . $indelrecnum . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select recnum,lineNum,crnNum,priPartNum,
                       secPartNum,partName,partIss,
                       drg,mtlSpec,
                       mtlType,rmCondition,qty,
                       price,extPrice,cos
                 from assypo_line_items
                 where link2assyPo = $indelrecnum
                order by recnum";
        //echo "<br>$sql";

        $result = mysql_query($sql);
        return $result;
     }


    function updateLI($recnum) {
        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $line_num = "'" . $this->linenum . "'";
        $crn = "'" . $this->crn . "'";
        $pri_partnum = "'" . $this->pri_partnum . "'";
        $sec_partnum = "'" . $this->sec_partnum  . "'";
        $partname = "'" . $this->partname  . "'";
        $rmcond = "'" . $this->rmcond  . "'";
        $partiss = "'" . $this->partiss  . "'";
        $drgiss = "'" . $this->drgiss  . "'";
        $qty = $this->qty?$this->qty:0;
        $mtlspec = "'" . $this->mtlspec  . "'";
        $mtltype = "'" . $this->mtltype  . "'";
        $price =  $this->price?$this->price:0;
        $extprice = $this->extprice?$this->extprice:0;
        $cos = "'" . $this->cos  . "'";

        //$link2dispatch = $this->link2dispatch;
        //$delvby = "'" . $this->delvby . "'";

       $sql = "update assypo_line_items
                          set lineNum = $line_num,
                              crnNum = $crn,
                              priPartNum = $pri_partnum,
                              secPartNum = $sec_partnum,
                              partName = $partname,
                              partiss = $partiss,
                              drg = $drgiss,
                              mtlSpec = $mtlspec,
                              mtlType = $mtltype,
                              rmCondition = $rmcond,
                              qty = $qty,
                              price = $price,
                              extPrice = $extprice,
                              cos =  $cos
                        where recnum = $lirecnum";
          // echo '--------'.$sql;

           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to assypo LI didn't work..Please report to Sysadmin. " . mysql_error());
     }
     
      function deleteLI($inplirecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $lirecnum = "'" . $inplirecnum . "'";
        $sql = "delete from assypo_line_items where recnum = $lirecnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Line Items failed...Please report to SysAdmin. " . mysql_error());
      }

}
