<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: liClass.php
// Maintains the class for PO Line items
// Revision: v1.0
//====================================

include_once('loginClass.php');

class soli {

    var
     $item_num,
     $item_desc,
     $partnum,
     $rmtype,
     $rmspec,
	 $uom,
	 $dia,
	 $length,
	 $width,
	 $thickness,
	 $gf,
	 $maxruling,
	 $altspec,
     $partiss,
     //$hcpartiss,
     $po_cos,
    // $hc_cos,
     $model_iss,
     $drgiss,
     $cos_iss,
    // $hcdrgiss,
     $qty,
     $price,
     $amount,
     $rmprice,
     $rmamount,
     $mcprice,
     $mcamount,
     $link2salesorder,
     $crn_num,
     $link2so,
     $condition,
     $ponum;

    // Constructor definition
    function soli() {
        $this->item_num = '';
        $this->item_desc = '';
        $this->partnum = '';
        $this->rmtype = '';
        $this->rmspec  = '';
        $this->partiss = '';
       // $this->hcpartiss = '';
        $this->po_cos = '';
        $this->cos_iss = '';
       // $this->hc_cos = '';
        $this->model_iss = '';
        $this->drgiss = '';
       // $this->hcdrgiss = '';
        $this->qty = '';
        $this->price = '';
        $this->amount = '';
        $this->rmprice = '';
        $this->rmamount = '';
        $this->mcprice = '';
        $this->mcamount = '';
        $this->link2so = '';
        $this->link2salesorder = '';
        $this->crn_num = '';
        $this->condition = '';
        $this->ponum = '';
     }
    function getitem_num() {
           return $this->item_num;
    }

    function setitem_num ($item_num) {

           $this->item_num = $item_num;
    }
     function getcrn_num() {
           return $this->crn_num;
    }

    function setcrn_num ($crn_num) {

           $this->crn_num = $crn_num;
    }

    function getitem_desc() {
           return $this->item_desc;
    }

    function setitem_desc ($item_desc) {
           $this->item_desc = $item_desc;
    }
    function getpartnum() {
           return $this->partnum;
    }

    function setpartnum ($partnum) {
           $this->partnum = $partnum;
    }
    function getrmtype() {
           return $this->rmtype;
    }

    function setrmtype ($rmtype) {
           $this->rmtype = $rmtype;
    }
    function getrmspec() {
           return $this->rmtype;
    }

    function setrmspec ($rmspec) {
           $this->rmspec = $rmspec;
    }
    function getdrgiss() {
           return $this->drgiss;
    }

    function setdrgiss ($drgiss) {
           $this->drgiss = $drgiss;
    }
    
  /*  function gethcdrgiss() {
           return $this->hcdrgiss;
    }

    function sethcdrgiss ($hcdrgiss) {
           $this->hcdrgiss = $hcdrgiss;
    }    */
    
    function getpartiss() {
           return $this->partnum;
    }
    
        function setpartiss ($partiss) {
           $this->partiss = $partiss;
    }
   /*
    function sethcpartiss ($hcpartiss) {
           $this->hcpartiss = $hcpartiss;
    }
         */
    function setpo_cos($po_cos) {
           $this->po_cos = $po_cos;
    }
    function setcos_iss($cos_iss) {
           $this->cos_iss = $cos_iss;
    }
    
   /* function sethc_cos($hc_cos) {
           $this->hc_cos = $hc_cos;
    }     */
    
    function setmodel_iss($model_iss) {
           $this->model_iss = $model_iss;
    }
    
    function getqty() {
           return $this->qty;
    }

    function setqty ($reqqty) {
           $this->qty = $reqqty;
    }
    function getprice() {
           return $this->price;
    }

    function setprice ($price) {
           $this->price = $price;
    }
    function getamount() {
           return $this->amount;
    }

    function setamount ($reqamount) {
           $this->amount = $reqamount;
    }
    function getrmprice() {
           return $this->rmprice;
    }

    function setrmprice ($rmprice) {
           $this->rmprice = $rmprice;
    }
    function getrmamount() {
           return $this->rmamount;
    }

    function setrmamount ($reqrmamount) {
           $this->rmamount = $reqrmamount;
    }
    function getmcprice() {
           return $this->mcprice;
    }

    function setmcprice ($mcprice) {
           $this->mcprice = $mcprice;
    }
    function getmcamount() {
           return $this->mcamount;
    }

    function setmcamount ($reqmcamount) {
           $this->mcamount = $reqmcamount;
    }
    function getlink2salesorder() {
           return $this->link2salesorder;
    }

    function setlink2salesorder ($link2salesorder) {
           $this->link2salesorder = $link2salesorder;
    }

    function getlink2so() {
           return $this->link2so;
    }

    function setlink2so ($reqlink2so) {
           $this->link2so = $reqlink2so;
    }
    function getuom() {
           return $this->uom;
    }

    function setuom ($requom) {
           $this->uom = $requom;
    }
	function getdia() {
           return $this->dia;
    }

    function setdia ($reqdia) {
           $this->dia = $reqdia;
    }

    function getlength() {
           return $this->length;
    }

    function setlength ($reqlength) {
           $this->length = $reqlength;
    }
	function getwidth() {
           return $this->width;
    }

    function setwidth ($reqwidth) {
           $this->width = $reqwidth;
    }

    function getthickness() {
           return $this->thickness;
    }

    function setthickness ($reqthickness) {
           $this->thickness = $reqthickness;
    }
    function getgf() {
           return $this->gf;
    }

    function setgf ($reqgf) {
           $this->gf = $reqgf;
    }
    function getmaxruling() {
           return $this->maxruling;
    }

    function setmaxruling ($reqmaxruling) {
           $this->maxruling = $reqmaxruling;
    }
    function getaltspec() {
           return $this->altspec;
    }

    function setaltspec ($reqaltspec) {
           $this->altspec = $reqaltspec;
    }
    function getcondition() {
           return $this->condition;
    }

    function setcondition ($cond) {
           $this->condition = $cond;
    }

    function getlink2review() {
           return $this->link2review;
    }
     function getponum() {
           return $this->ponum;
    }

    function setponum ($ponum) {
           $this->ponum = $ponum;
    }

    function addQI() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'so_line_items' for update";
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
        $item_num = "'" . $this->item_num . "'";
        $item_desc = "'" . $this->item_desc . "'";    
        $partnum = "'" . $this->partnum . "'";
        $rmtype = "'" . $this->rmtype . "'";
        $rmspec = "'" . $this->rmspec  . "'";
        $uom = "'" . $this->uom  . "'";
	$dia = "'" . $this->dia . "'";
	$length = "'" . $this->length  . "'";
	$width = "'" . $this->width  . "'";
	$thickness = "'" . $this->thickness  . "'";
	$gf = "'" . $this->gf  . "'";
	$maxruling = "'" . $this->maxruling  . "'";
	$altspec = "'" . $this->altspec  . "'";
        $partiss = "'" . $this->partiss . "'";
       // $hcpartiss = "'" . $this->hcpartiss . "'";
        $po_cos = "'" . $this->po_cos . "'";
        $cos_iss = "'" . $this->cos_iss . "'";
       // $hc_cos = "'" . $this->hc_cos . "'";
        $model_iss = "'" . $this->model_iss . "'";
        $drgiss = "'" . $this->drgiss . "'";
       // $hcdrgiss = "'" . $this->hcdrgiss . "'";
        $qty = "'" . $this->qty . "'";
        $price = "'" . $this->price . "'";
        $amount = $this->amount;
        $rmprice = "'" . $this->rmprice . "'";
        $rmamount = $this->rmamount;
        $mcprice = "'" . $this->mcprice . "'";
        $mcamount = $this->mcamount;
        $link2so = $this->link2so;
        $link2salesorder = $this->link2salesorder;
        $crn_num = "'" . $this->crn_num . "'";
        $condition =  "'" . $this->condition . "'";
        $ponum =  "'" . $this->ponum . "'";
        $sql = "INSERT INTO so_line_items (recnum, line_num, item_desc, qty, price,
                                           amount, link2so, partnum,rmtype, rmspec, 
                                           partiss, drgiss, rmprice, rmamount,
                                           mcprice,mcamount,po_cos,
                                           model_iss,uom, dia, length, width,
					   thickness, grainflow, maxruling, altspec,cos_iss,crn_num,`condition`,po_num)
                                    VALUES ($objid, $item_num, $item_desc, $qty,  $price,
                                            $amount, $link2so, $partnum, $rmtype, $rmspec,
                                            $partiss, $drgiss, $rmprice, $rmamount,
                                            $mcprice,$mcamount,$po_cos,
                                            $model_iss,	$uom, $dia, $length, $width,
					    $thickness, $gf, $maxruling, $altspec,$cos_iss,$crn_num,$condition,$ponum)";
       // echo $sql;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to SO LI didn't work..Please report to Sysadmin. " . mysql_error());
        }
         $sql = "update seqnum set nxtnum = $objid where tablename = 'so_line_items'";
   // echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for SO..Please report to Sysadmin. " . mysql_error());
        }
     }

    function updateQI($recnum) {
        $lirecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $item_num = "'" . $this->item_num . "'";
        $item_desc = "'" . $this->item_desc . "'";
        $partnum = "'" . $this->partnum . "'";
        $rmtype = "'" . $this->rmtype . "'";
        $rmspec = "'" . $this->rmspec  . "'";
        $uom = "'" . $this->uom  . "'";
	    $dia = "'" . $this->dia . "'";
	    $length = "'" . $this->length  . "'";
		$width = "'" . $this->width  . "'";
	    $thickness = "'" . $this->thickness  . "'";
		$gf = "'" . $this->gf  . "'";
	    $maxruling = "'" . $this->maxruling  . "'";
		$altspec = "'" . $this->altspec  . "'";

        $partiss = "'" . $this->partiss . "'";
        //$hcpartiss = "'" . $this->hcpartiss . "'";
        $po_cos = "'" . $this->po_cos . "'";
        $cos_iss = "'" . $this->cos_iss . "'";
       // $hc_cos = "'" . $this->hc_cos . "'";
        $model_iss = "'" . $this->model_iss . "'";
        $drgiss = "'" . $this->drgiss . "'";
        $condition = "'" . $this->condition . "'";
        $qty = "'" . $this->qty . "'";
        $crn_num = "'" . $this->crn_num . "'";
        $price = $this->price ? $this->price : 0;
        $link2so = "'" . $this->link2so. "'";
        $link2salesorder = "'" . $this->link2salesorder. "'";
        $amount = $this->amount ? $this->amount : 0;
        $rmprice = $this->rmprice ? $this->rmprice : 0;
        $rmamount = $this->rmamount ? $this->rmamount : 0;
        $mcprice = $this->mcprice ? $this->mcprice : 0;
        $mcamount = $this->mcamount ? $this->mcamount : 0;
         $ponum = "'" . $this->ponum . "'";
        $sql = "update so_line_items
                          set line_num = $item_num,
                              item_desc = $item_desc,
                              partnum = $partnum,
                              rmtype = $rmtype,
                              rmspec = $rmspec,
                              partiss = $partiss,
                              po_cos = $po_cos,
                              cos_iss = $cos_iss,
                              model_iss = $model_iss,
                              drgiss = $drgiss,
                              qty = $qty,
                              link2so= $link2so,
                              price = $price,
                              amount = $amount,
                              rmprice = $rmprice,
                              rmamount = $rmamount,
                              mcprice = $mcprice,
                              mcamount = $mcamount,
							  uom = $uom,
							  dia = $dia,
							  length = $length,
							  width = $width,
							  thickness = $thickness,
							  grainflow = $gf,
							  maxruling = $maxruling,
							  altspec = $altspec,
							  crn_num= $crn_num,
							  `condition`=$condition,
							   po_num= $ponum
                        where recnum = $lirecnum";
          //echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to SO LI didn't work..Please report to Sysadmin. " . mysql_error());

     }
     function getQI($salesorderrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select line_num, item_desc,
                       qty, price, amount, recnum,
                       partnum,rmtype, rmspec, 
                       partiss,drgiss,
                       rmprice,rmamount,
                       mcprice,mcamount,
                       po_cos,model_iss,
		       uom, dia, length, width,
		       thickness, grainflow, maxruling,
		       altspec, cos_iss,crn_num,`condition`
                   from so_line_items
                   where link2so = $salesorderrecnum";
       // echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
     
     function getCrn4po($crn) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
        $siteval = "sales_order.siteid = '".$siteid."'";
        $sql = "SELECT crn_num,rmspec,rmtype,
                       uom,dia,length,width,thickness,grainflow,`condition`,maxruling,sales_order.po_num ,altspec,price
                from so_line_items,sales_order
                where so_line_items.link2so=sales_order.recnum 
                      and crn_num='$crn'
                      and sales_order.status = 'Open' 
                      and crn_num is not NULL and $siteval 
                limit 1";
       //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

    function deleteLI($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $recnum =$inprecnum;
        $sql = "delete from so_line_items where recnum = $recnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Line Items failed...Please report to SysAdmin. " . mysql_error());
      }

 }// End so class definition
