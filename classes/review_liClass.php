<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: liClass.php
// Maintains the class for PO Line items
// Revision: v1.0
//====================================

include_once('loginClass.php');

class review_li {

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
     $drgiss,
     $hcdrgiss,
     $partiss,
     $hcpartiss,
     $po_cos,
     $hc_cos,
	 $cos_iss,
     $model_iss,
     $qty,
     $link2review,
     $crn_num;

    // Constructor definition
    function review_li() {
        $this->item_num = '';
        $this->item_desc = '';
        $this->partnum = '';
        $this->rmtype = '';
        $this->rmspec  = '';
        $this->uom  = '';
        $this->dia = '';
        $this->length = '';
        $this->width  = '';
        $this->thickness = '';
        $this->gf = '';
        $this->maxruling  = '';
        $this->altspec = '';
        $this->drgiss = '';
        $this->hcdrgiss = '';
        $this->partiss = '';
        $this->hcpartiss = '';
        $this->po_cos = '';
        $this->hc_cos = '';
		$this->cos_iss = '';
        $this->model_iss = '';
        $this->qty = '';
        $this->link2review = '';
        $this->crn_num = '';
     }
    function getitem_num() {
           return $this->item_num;
    }

    function setitem_num ($item_num) {

           $this->item_num = $item_num;
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
    
    function gethcdrgiss() {
           return $this->hcdrgiss;
    }

    function sethcdrgiss ($hcdrgiss) {
           $this->hcdrgiss = $hcdrgiss;
    }
    
    function getpartiss() {
           return $this->partiss;
    }

    function setpartiss ($partiss) {
           $this->partiss = $partiss;
    }
    
    function gethcpartiss() {
           return $this->hcpartiss;
    }

    function sethcpartiss ($hcpartiss) {
           $this->hcpartiss = $hcpartiss;
    }
    
    function getpo_cos() {
           return $this->po_cos;
    }

    function setpo_cos ($po_cos) {
           $this->po_cos = $po_cos;
    }
    
    function gethc_cos() {
           return $this->hc_cos;
    }

    function sethc_cos ($hc_cos) {
           $this->hc_cos = $hc_cos;
    }
     function getcrn_num() {
           return $this->crn_num;
    }

    function setcrn_num ($crn_num) {
           $this->crn_num= $crn_num;
    }
    function getcos_iss() {
           return $this->cos_iss;
    }

    function setcos_iss ($cos_iss) {
           $this->cos_iss = $cos_iss;
    }
    
    function getmodel_iss() {
           return $this->model_iss;
    }

    function setmodel_iss ($model_iss) {
           $this->model_iss = $model_iss;
    }

    function getqty() {
           return $this->qty;
    }

    function setqty ($reqqty) {
           $this->qty = $reqqty;
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

    function getlink2review() {
           return $this->link2review;
    }

    function setlink2review ($link2review) {
           $this->link2review = $link2review;
    }


    function addLI() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);

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
        $drgiss = "'" . $this->drgiss . "'";
        $hcdrgiss = "'" . $this->hcdrgiss . "'";
        $partiss = "'" . $this->partiss . "'";
        $hcpartiss = "'" . $this->hcpartiss . "'";
        $po_cos = "'" . $this->po_cos . "'";
        $hc_cos = "'" . $this->hc_cos . "'";
        $model_iss = "'" . $this->model_iss . "'";
        $cos_iss = "'" . $this->cos_iss . "'";
        $qty = "'" . $this->qty . "'";
        $link2review = $this->link2review;
       	$crn_num = "'" . $this->crn_num  . "'";

        $sql = "INSERT INTO review_line_items (line_num, item_desc, qty,
                                           link2review, partnum,rmtype, rmspec,
                                           partiss, drgiss, hcdrgiss, hcpartiss, po_cos,
                                           hc_cos, model_iss,
										   uom, dia, length, width,
											thickness, grainflow, maxruling, 
											altspec,cos_iss,crn_num)
                VALUES ($item_num, $item_desc, $qty,
                        $link2review, $partnum, $rmtype, $rmspec,
                        $partiss, $drgiss, $hcdrgiss, $hcpartiss, 
						$po_cos, $hc_cos, $model_iss,
						$uom, $dia, $length, $width,
						$thickness, $gf, $maxruling, 
						$altspec,$cos_iss,$crn_num)";
       //echo $sql;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to Review LI didn't work..Please report to Sysadmin. " . mysql_error());
        }

     }

    function updateLI($recnum) {
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
		$crn_num = "'" . $this->crn_num  . "'";
	    $thickness = "'" . $this->thickness  . "'";
		$gf = "'" . $this->gf  . "'";
	    $maxruling = "'" . $this->maxruling  . "'";
		$altspec = "'" . $this->altspec  . "'";
        $drgiss = "'" . $this->drgiss . "'";
        $hcdrgiss = "'" . $this->hcdrgiss . "'";
        $partiss = "'" . $this->partiss . "'";
        $hcpartiss = "'" . $this->hcpartiss . "'";
        $po_cos = "'" . $this->po_cos . "'";
        $hc_cos = "'" . $this->hc_cos . "'";
        $cos_iss = "'" . $this->cos_iss . "'";
        $model_iss = "'" . $this->model_iss . "'";
        $qty =  $this->qty?$this->qty:0;
        $link2review = "'" . $this->link2review. "'";

        $sql = "update review_line_items
                          set line_num = $item_num,
                              item_desc = $item_desc,
                              partnum = $partnum,
                              rmtype = $rmtype,
                              rmspec = $rmspec,
                              partiss = $partiss,
                              drgiss = $drgiss,
                              hcdrgiss = $hcdrgiss,
                              hcpartiss = $hcpartiss,
                              po_cos = $po_cos,
                              hc_cos = $hc_cos,
                              model_iss = $model_iss,
                              qty = $qty,
							  uom = $uom,
							  dia = $dia,
							  length = $length,
							  width = $width,
							  thickness = $thickness,
							  grainflow = $gf,
							  maxruling = $maxruling,
							  altspec = $altspec,
							  cos_iss = $cos_iss,
							  crn_num = $crn_num
                        where id = $lirecnum";
           //echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to SO LI didn't work..Please report to Sysadmin. " . mysql_error());

     }
     
     function getLI($reviewrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select line_num,item_desc,
                       qty,id,
                       partnum,rmtype, rmspec,
                       partiss,drgiss,hcdrgiss,
		       hcpartiss,po_cos,hc_cos,
		       cos_iss, uom, dia, length,
		       width, thickness, grainflow,
		       maxruling, altspec, model_iss,crn_num
                   from review_line_items
                   where link2review = $reviewrecnum";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

    function deleteLI($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $recnum =$inprecnum;
        $sql = "delete from review_line_items where id = $recnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Line Items failed...Please report to SysAdmin. " . mysql_error());
      }
      
     function delete_old_LI($recnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $reviewrecnum =$recnum;
        $sql = "delete from so_line_items where link2so = $recnum";
         //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for old Line Items failed...Please report to SysAdmin. " . mysql_error());
     }

 }// End so class definition
