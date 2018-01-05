<?
//====================================
// Author: FSI
// Date-written = Aug 9, 2008
// Filename: custpoverifyClass.php
// Class for verifying Cust PO & Order Stage
// Revision: v1.0
//====================================

include_once('loginClass.php');

class custpoverify {

     function getrevLI($ponum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select rli.line_num,rli.item_desc,
                       rli.qty,rli.id,
                       rli.partnum,rli.rmtype, rli.rmspec,
                       rli.partiss,rli.drgiss,rli.hcdrgiss,
		       rli.hcpartiss,rli.po_cos,rli.hc_cos,
		       rli.cos_iss, rli.uom, rli.dia, rli.length,
		       rli.width, rli.thickness, rli.grainflow,
		       rli.maxruling, rli.altspec, rli.model_iss                       
                   from review_line_items rli, contract_review cr
                   where cr.ordernum = '$ponum' and
                         rli.link2review = cr.recnum";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
     function getrevlicount($ponum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select count(*)                        
                   from review_line_items rli, contract_review cr
                   where cr.ordernum = '$ponum' and
                         rli.link2review = cr.recnum";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

     function getpoLI($ponum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select soli.line_num, soli.item_desc,
                       soli.qty, soli.price, soli.amount, soli.recnum,
                       soli.partnum,soli.rmtype, soli.rmspec, 
                       soli.partiss,soli.drgiss,
                       soli.rmprice,soli.rmamount,
                       soli.mcprice,soli.mcamount,
                       soli.po_cos,soli.model_iss,
		       soli.uom, soli.dia, soli.length, soli.width,
		       soli.thickness, soli.grainflow, soli.maxruling,
		       soli.altspec, soli.cos_iss
                   from so_line_items soli, sales_order so
                   where so.po_num = '$ponum' and
                         soli.link2so = so.recnum";
    
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
     function getpolicount($ponum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select count(*)
                   from so_line_items soli, sales_order so
                   where so.po_num = '$ponum' and
                         soli.link2so = so.recnum";
    
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
     function sohdr($ponum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select amendment_num, amendment_date, special_instruction
                   from sales_order so
                   where so.po_num = '$ponum'";
    
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
     function revhdr($ponum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select amendment_num, amendment_date, special_instrns
                   from contract_review
                   where ordernum = '$ponum'";
    
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
 }// End so class definition
