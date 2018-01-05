<?
//====================================
// Author: FSI
// Date-written = March 15, 2005
// Filename: copyClass.php
// Maintains the class for all reports
// Revision: v1.0
// Modifications History
//====================================

include_once('loginClass.php');

class valpart {

  
  function getpartnum_details($ponum)
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $sql = "select name,partnum,order_date,grainflow,maxruling,
                   altspec,drgiss,partiss,cos_iss,model_iss,
                   li.line_num,ordernum
             from contract_review r,
                  review_line_items li
            where li.link2review = r.recnum and
                  r.ordernum= '$ponum'";
    //echo $sql;
    $result = mysql_query($sql);
    if(!$result) die("getpartnum_details failed. " . mysql_error());
    return $result;
  }
  
  function old_getpartnum_details4neworder($cname,$partnum)
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $sql = "select name,partnum,order_date,grainflow,maxruling,
            altspec,drgiss,partiss,cos_iss,model_iss,
            line_num,ordernum
            from contract_review r,review_line_items li
        where li.link2review = r.recnum and r.name = '$cname'
            and li.partnum = '$partnum'
            and r.val_status = 'Yes'
        order by r.order_date desc limit 1";
    //echo $sql;
    $result = mysql_query($sql);
    if(!$result) die("getpartnum_details4neworder failed. " . mysql_error());
    return $result;
  }
  function getpartnum_details4neworder($cname,$crnnum)
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $sql = "select c.name,soli.crn_num,so.order_date,soli.grainflow,
                   soli.maxruling,soli.altspec,soli.drgiss,soli.partiss,
                   soli.cos_iss,soli.model_iss,soli.line_num,so.po_num
                   from sales_order so,so_line_items soli,contract_review contract,company c
                   where so.recnum=soli.link2so and
                         c.recnum=so.so2customer and
                         soli.crn_num='$crnnum' and
                         contract.val_status = 'Yes' and
                         contract.recnum = so.link2review and
                         c.recnum='$cname'
                  order by so.order_date desc,soli.line_num asc limit 1";
    //echo $sql;
    $result = mysql_query($sql);
    if(!$result) die("getpartnum_details4neworder failed. " . mysql_error());
    return $result;
  }
  function getpartnum_details4newassyorder($cname,$crnnum)
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $sql = "select c.name,soli.crn,so.po_date,'',
                   '','',soli.drg_iss,soli.pi_attachments,
                   soli.cos_iss,soli.model_iss,soli.line_num,so.cust_ponum
                   from assy_review so,assy_review_li soli,company c
                   where so.recnum=soli.link2assyreview and
                         c.recnum=so.customer and
                         soli.crn='$crnnum' and
                         so.val_status = 'Yes' and
                         c.recnum='$cname'
                  order by so.review_date desc,soli.line_num asc limit 1";
    //echo $sql;
    $result = mysql_query($sql);
    if(!$result) die("getpartnum_details4neworder failed. " . mysql_error());
    return $result;
  }

} // End copy class definition
