<?
//====================================
// Author: FSI
// Date-written = Feb 26, 2007
// Filename:mmClass.php
// Maintains the class for material movements
// Revision: v1.0
//====================================


class irm {

var
    $line_num,
    $po_num,
    $po_qty,
    $mgp_num,
    $rm_dim1,
    $rm_dim2,
    $rm_dim3,
    $rm_qty,
    $qty_to_make,
    $cust_batch_num,
    $cust_wo_num,
    $remarks,
    $link2wo,
    $mgp_date;

    // Constructor definition
    function irm() {
        $this->line_num= '';
        $this->po_num = '';
        $this->po_qty = '';
        $this->mgp_num = '';
        $this->rm_dim1 = '';
        $this->rm_dim2 = '';
        $this->rm_dim3 = '';
        $this->rm_qty= '';
        $this->qty_to_make= '';
        $this->cust_batch_num= '';
        $this->cust_wo_num= '';
        $this->remarks = '';
        $this->link2wo = '';
        $this->mgp_date = '';
     }
    function getline_num() {
           return $this->line_num;
    }

    function setline_num($line_num) {

           $this->line_num = $line_num;
    }

    function getpo_num() {
           return $this->po_num;
    }

    function setpo_num($po_num) {
           $this->po_num = $po_num;
    }


    function getpo_qty() {
           return $this->po_qty;
    }

    function setpo_qty($po_qty) {
           $this->po_qty = $po_qty;
    }

    function getmgp_num() {
           return $this->mgp_num;
    }

    function setmgp_num($mgp_num) {
           $this->mgp_num = $mgp_num;
    }
    function getrm_dim1() {
           return $this->rm_dim1;
    }

    function setrm_dim1($rm_dim1) {
           $this->rm_dim1 = $rm_dim1;
    }



    function getrm_dim2() {
           return $this->rm_dim2;
    }

    function setrm_dim2($rm_dim2) {

           $this->rm_dim2 = $rm_dim2;
    }

    function getrm_dim3() {
           return $this->rm_dim3;
    }

    function setrm_dim3($rm_dim3) {
           $this->rm_dim3 = $rm_dim3;
    }


    function getrm_qty() {
           return $this->rm_qty;
    }

    function setrm_qty($rm_qty) {
           $this->rm_qty = $rm_qty;
    }

    function getqty_to_make() {
           return $this->qty_to_make;
    }

    function setqty_to_make ($qty_to_make) {
           $this->qty_to_make = $qty_to_make;
    }
    function getcust_batch_num() {
           return $this->cust_batch_num;
    }

    function setcust_batch_num($cust_batch_num) {
           $this->cust_batch_num = $cust_batch_num;
    }


	 function getcust_wo_num() {
           return $this->cust_wo_num;
    }

    function setcust_wo_num($cust_wo_num) {
           $this->cust_wo_num = $cust_wo_num;
    }

    function getremarks() {
           return $this->remarks;
    }

    function setremarks($remarks) {
           $this->remarks = $remarks;
    }

    function getlink2wo() {
           return $this->link2wo;
    }

    function setlink2wo($link2wo) {
           $this->link2wo = $link2wo;
    }
    
    function getmgp_date() {
           return $this->mgp_date;
    }

    function setmgp_date($mgp_date) {
           $this->mgp_date = $mgp_date;
    }

    function addirm() {

//        $sql = "start transaction";
//        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'irm' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for irm..Please report to Sysadmin. " . mysql_error());
        }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

        $line_num = $this->line_num ;
        
        $po_num = "'" . $this->po_num . "'";
        if($this->po_qty != '')
        {
          $po_qty = $this->po_qty;
        }
        else
        {
          $po_qty = 'NULL';
        }
        
        $mgp_num = "'" . $this->mgp_num . "'";

        if($this->rm_dim1 != '')
        {
          $rm_dim1 = $this->rm_dim1;
        }
        else
        {
           $rm_dim1 = 'NULL';
        }
        
        if($this->rm_dim2 != '')
        {
          $rm_dim2  = $this->rm_dim2;
        }
        else
        {
           $rm_dim2  = 'NULL';
        }
        
        if($this->rm_dim3 != '')
        {
          $rm_dim3  = $this->rm_dim3;
        }
        else
        {
           $rm_dim3  = 'NULL';
        }

        if($this->rm_qty != '')
        {
          $rm_qty = $this->rm_qty;
        }
        else
        {
          $rm_qty = 'NULL';
        }
        
        if($this->qty_to_make != '')
        {
          $qty_to_make  = $this->qty_to_make;
        }
        else
        {
          $qty_to_make  = 'NULL';
        }
        
        $cust_batch_num  = "'" . $this->cust_batch_num . "'";
        $cust_wo_num  = "'" . $this->cust_wo_num . "'";
        $remarks = "'" . $this->remarks . "'";
        $link2wo = $this->link2wo;
        
        if($this->mgp_date != '' || $this->mgp_date != '0000-00-00')
        {
          $mgp_date = "'" . $this->mgp_date . "'";
        }
        else
        {
          $mgp_date = 'NULL';
        }

        $sql = "INSERT INTO irm (recnum, line_num, po_num, po_qty, mgp_num,
                       rm_dim1,rm_dim2,rm_dim3,rm_qty,qty_to_make,cust_batch_num,cust_wo_num,remarks,link2wo,mgp_date)
               VALUES ($objid, $line_num, $po_num, $po_qty, $mgp_num,
                       $rm_dim1,$rm_dim2,$rm_dim3,$rm_qty,$qty_to_make,$cust_batch_num,$cust_wo_num,$remarks,$link2wo,$mgp_date)";
     //echo $sql;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to irm didn't work..Please report to Sysadmin. " . mysql_error());
        }
         $sql = "update seqnum set nxtnum = $objid where tablename = 'irm'";
   // echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for irm..Please report to Sysadmin. " . mysql_error());
        }
     }

    function updateirm($recnum) {



        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $line_num = $this->line_num ;
        $po_num = "'" . $this->po_num . "'";
        
        if($this->po_qty != '')
        {
          $po_qty = $this->po_qty;
        }
        else
        {
          $po_qty = 'NULL';
        }
        $mgp_num = "'" . $this->mgp_num . "'";
        
        if($this->rm_dim1 != '')
        {
          $rm_dim1 = $this->rm_dim1;
        }
        else
        {
          $rm_dim1 = 'NULL';
        }
        
        if($this->rm_dim2 != '')
        {
          $rm_dim2  = $this->rm_dim2;
        }
        else
        {
           $rm_dim2  = 'NULL';
        }
        
        if($this->rm_dim3 != '')
        {
          $rm_dim3  = $this->rm_dim3;
        }
        else
        {
          $rm_dim3  = 'NULL';
        }
        
        if($this->rm_qty != '')
        {
          $rm_qty = $this->rm_qty;
        }
        else
        {
           $rm_qty = 'NULL';
        }
        
        if($this->qty_to_make != '')
        {
          $qty_to_make  = $this->qty_to_make;
        }
        else
        {
          $qty_to_make  =  'NULL';
        }
        
        $cust_batch_num  = "'" . $this->cust_batch_num . "'";
        $cust_wo_num  = "'" . $this->cust_wo_num . "'";
        $remarks = "'" . $this->remarks . "'";
        
        if($this->mgp_date != '' || $this->mgp_date != '0000-00-00')
        {
          $mgp_date = "'" . $this->mgp_date . "'";
        }
        else
        {
          $mgp_date = 'NULL';
        }


        $sql = "update irm
                          set line_num = $line_num,
                              po_num = $po_num,
                              po_qty = $po_qty,
                              mgp_num= $mgp_num,
                              rm_dim1 = $rm_dim1,
                              rm_dim2 = $rm_dim2,
                              rm_dim3 = $rm_dim3,
                              rm_qty = $rm_qty,
                              qty_to_make = $qty_to_make,
                              cust_batch_num = $cust_batch_num,
                              cust_wo_num = $cust_wo_num,
                              remarks = $remarks,
                              mgp_date = $mgp_date
                        where recnum = $lirecnum";
  //echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to irm didn't work..Please report to Sysadmin. " . mysql_error());

     }

     function getirm($inprecnum) {
        $worecnum = $inprecnum;

        $sql = "select line_num, po_num, po_qty,
                       mgp_num, rm_dim1, rm_dim2, rm_dim3, rm_qty,
                       qty_to_make,cust_batch_num,cust_wo_num, remarks,recnum,mgp_date
                   from irm
                   where link2wo = $worecnum";
//echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

    function deleteirm($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $recnum =$inprecnum;
        $sql = "delete from irm where recnum = $recnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for irm  failed...Please report to SysAdmin. " . mysql_error());
      }

 }// End so class definition
