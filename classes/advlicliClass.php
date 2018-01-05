<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: advlicliClass.php
// Maintains the class for PO Line items
// Revision: v1.0
//====================================

include_once('loginClass.php');

class advlic_line_items {

    var
     $linenum,
    //$itemnum,
     $partnum,
     $partname,
     $rm_size,
     $rm_spec,
     $crn,
     $link2adv,
     $qty2make,
     $qtyimp,
     $beno,
     $assessmnt_value,
     $cif_value,
     $rate,
     $expbal,
     $tariff,
     $wastage;

    // Constructor definition
    function advlic_line_items() {
        $this->linenum = '';
        //$this->itemnum = '';
        $this->partnum = '';
        $this->partname = '';
        $this->rm_size = '';
        $this->rm_spec = '';
        $this->crn = '';
        $this->link2adv = '';
        $this->qty2make = '';
        $this->qtyimp = '';
        $this->beno = '';
        $this->assessmnt_value = '';
        $this->cif_value = '';
        $this->rate = '';
        $this->tariff = '';
        $this->wastage = '';

     }

    // Property get and set
    function getlinenum() {
           return $this->linenum;
    }

    function setlinenum($reqlinenum) {

           $this->linenum = $reqlinenum;
    }

    function getrmspec() {
           return $this->rm_spec;
    }

    function setrmspec($reqrmspec) {
           $this->rm_spec = $reqrmspec;
    }
    
    function getrmsize() {
           return $this->rm_size;
    }

    function setrmsize($reqrmsize) {
           $this->rm_size = $reqrmsize;
    }

    function getpartnum() {
           return $this->partnum;
    }
    function setpartnum($reqpartnum) {
           $this->partnum = $reqpartnum;
    }

    function getpartname() {
           return $this->partname;
    }

    function setpartname ($reqpartname) {
           $this->partname = $reqpartname;
    }

    function getcrn() {
           return $this->crn;
    }

    function setcrn ($reqcrn) {
           $this->crn = $reqcrn;
    }

    function getqty2make() {
           return $this->qty2make;
    }

    function setqty2make($reqqty2make) {
           $this->qty2make = $reqqty2make;
    }
    function getqtyimp() {
           return $this->qtyimp;
    }

    function setqtyimp ($reqqtyimp) {
           $this->qtyimp = $reqqtyimp;
    }

    function getimpbal() {
           return $this->impbal;
    }

    function setimpbal ($reqqtyimp) {
           $this->impbal = $reqqtyimp;
    }

    function getexpbal() {
           return $this->expbal;
    }

    function setexpbal($reqexpbal) {
           $this->expbal = $reqexpbal;
    }
    function getlink2advlic() {
           return $this->link2adv;
    }
    function setlink2advlic($reqlink2adv) {
           $this->link2adv = $reqlink2adv;
    }

    function getbeno() {
           return $this->beno;
    }
    function setbeno($beno) {
            $this->beno = $beno;
     }
     function getasmntval() {
           return $this->assessmnt_value;
    }
    function setasmntval($assmntval) {
            $this->assessmnt_value = $assmntval;
     }
    function getcifval() {
           return $this->cif_value;
    }
    function setcifval($cifval) {
            $this->cif_value = $cifval;
    }
    
    function getrate() {
           return $this->rate;
    }
    function setrate($rate) {
            $this->rate = $rate;
    }

   function gettariff() {
           return $this->tariff;
    }

    function settariff($reqtariff) {
           $this->tariff = $reqtariff;
    }
    function getwastage() {
           return $this->wastage;
    }

    function setwastage($wastage) {
           $this->wastage = $wastage;
    }


    function addLI() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'advlic_li' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for adv LI..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        //$crdate = "'" . date("y-m-d") . "'";
        $line_num = "'" . $this->linenum . "'";
        //$item_num = "'" . $this->itemnum . "'";
        $part_num = "'" . $this->partnum . "'";
        $part_name = "'" . $this->partname. "'";
        $rmsize = "'" . $this->rm_size. "'";
        $rmspec = "'" . $this->rm_spec. "'";
        $crn_num = "'" . $this->crn . "'";
        $link2adv = "'" . $this->link2adv. "'";
        $beno = "'" . $this->beno . "'";
        $assmntval = "'" . $this->assessmnt_value . "'";
        $cifval =  "'" . $this->cif_value . "'";
        $rate =    "'" . $this->rate . "'";
        //echo'LINK@ADV'.$link2adv;
        if($this->qty2make != '' && $this->qty2make != 'NULL')
        {
          $qty2make = "'" . $this->qty2make . "'";
        }
        else
        {
          $qty2make = 'NULL';
        }
        
        if($this->qtyimp != '' && $this->qtyimp != 'NULL')
        {
          $qtyimp = "'" . $this->qtyimp . "'";
        }
        else
        {
          $qtyimp = 'NULL';
        }
        
        if($this->impbal != '' && $this->impbal != 'NULL')
        {
          $impbal = "'" . $this->impbal . "'";
        }
        else
        {
          $impbal = 'NULL';
        }
        
        if($this->expbal != '' && $this->expbal != 'NULL')
        {
          $expbal = "'" . $this->expbal . "'";
        }
        else
        {
          $expbal = 'NULL';
        }
        $tariff = "'" . $this->tariff . "'";

        if($this->wastage != '' && $this->wastage != 'NULL')
        {
          $wastage = "'" . $this->wastage . "'";
        }
        else
        {
          $wastage = 'NULL';
        }

        $sql = "INSERT INTO advlic_li (recnum, line_num, partnum, partname,
                                           crn, link2adv,qty2make,qty_imp,be_no,assessmnt_value,tariff,rm_spec,rm_size,wastage,cif_value,rate)
               VALUES ($objid, $line_num, $part_num, $part_name, $crn_num, $link2adv, $qty2make,
                       $qtyimp, $beno, $assmntval,$tariff,$rmspec,$rmsize,$wastage,$cifval,$rate)";
        //echo "$sql";
        $result = mysql_query($sql) or die("Insert to adv LI didn't work..Please report to Sysadmin. " . mysql_error()); ;
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to LI didn't work..Please report to Sysadmin. " . mysql_error());
        }
        $sql = "update seqnum set nxtnum = $objid where tablename = 'advlic_li'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for adv li..Please report to Sysadmin. " . mysql_error());
        }
        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Commit failed for adv LI Insert..Please report to Sysadmin. " . mysql_error());
        }


     }

    function updateLI($advlirecnum) {
        $lirecnum = $advlirecnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $line_num = "'" . $this->linenum . "'";
        //$item_num = "'" . $this->itemnum . "'";
        $part_num = "'" . $this->partnum . "'";
        $part_name = "'" . $this->partname. "'";
        $rmspec = "'" . $this->rm_spec . "'";
        $rmsize = "'" . $this->rm_size . "'";
        $crn_num = "'" . $this->crn . "'";
        $link2adv = "'" . $this->link2adv. "'";
        $beno =  "'" . $this->beno. "'";
        $assmntval = "'" . $this->assessmnt_value . "'";
        $cifval =  "'" . $this->cif_value . "'";
        $rate =    "'" . $this->rate . "'";
        if($this->qty2make != '' && $this->qty2make != 'NULL')
        {
          $qty2make = "'" . $this->qty2make . "'";
        }
        else
        {
          $qty2make = 'NULL';
        }

        if($this->qtyimp != '' && $this->qtyimp != 'NULL')
        {
          $qtyimp = "'" . $this->qtyimp . "'";
        }
        else
        {
          $qtyimp = 'NULL';
        }

        if($this->impbal != '' && $this->impbal != 'NULL')
        {
          $impbal = "'" . $this->impbal . "'";
        }
        else
        {
          $impbal = 'NULL';
        }

        if($this->expbal != '' && $this->expbal != 'NULL')
        {
          $expbal = "'" . $this->expbal . "'";
        }
        else
        {
          $expbal = 'NULL';
        }
        $tariff = "'" . $this->tariff . "'";
        
        if($this->wastage != '' && $this->wastage != 'NULL')
        {
          $wastage = "'" . $this->wastage . "'";
        }
        else
        {
          $wastage = 'NULL';
        }


        $sql = "update advlic_li
                          set line_num = $line_num,
                              partnum = $part_num,
                              partname = $part_name,
                              rm_spec = $rmspec,
                              rm_size = $rmsize,
                              crn = $crn_num,
                              link2adv = $link2adv,
                              qty2make = $qty2make,
                              qty_imp = $qtyimp,
                              be_no = $beno,
                              assessmnt_value = $assmntval,
                              cif_value =  $cifval,
                              rate = $rate,
                              tariff = $tariff,
                              wastage = $wastage
                         where recnum = $lirecnum";
           //echo $sql;

           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to advli didn't work..Please report to Sysadmin. " . mysql_error());

     }


     function getLI($inrecnum) {
        $recnum = "'" . $inrecnum . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select line_num,partnum,
                       partname,rm_spec,rm_size, crn, qty2make, qty_imp, imp_bal, exp_bal,
                       tariff,recnum,wastage,be_no,assessmnt_value,cif_value,rate from advlic_li
                   where link2adv = $recnum ";
        //echo $sql;

        $result = mysql_query($sql);
        return $result;
     }
     
      function getAdvlic() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select adv_license,partnum,partname,rm_spec,rm_size,crn,qty2make
            from adv_lic,advlic_li
            where adv_lic.recnum=advlic_li.link2adv ";
        //echo $sql;

        $result = mysql_query($sql);
        return $result;
     }



     function deleteLI($inalirecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $lirecnum = "'" . $inalirecnum . "'";
        $sql = "delete from advlic_li where recnum = $lirecnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Line Items failed...Please report to SysAdmin. " . mysql_error());
      }

} // End po class definition


