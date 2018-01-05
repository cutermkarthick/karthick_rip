<?
//================================================
// Author: FSI
// Date-written = April 30,2010
// Filename: assyReviewClass.php
// Maintains the class for BOMs/Partlists
// Revision: v1.0
//================================================

include_once('loginClass.php');

class assyReview_li
{
    var $linenum,
        $crn,
        $assypart,
        $assydesc,
        $bomref,
        $bomiss,
        $qty,
        $unit_price,
        $link2assyreview,
        $totalprice,$pcrn,$partnum,$description,$part_iss,$cos_iss,$model_iss,$drg_iss,
        $assydate;

    // Constructor definition
    function assyReview() {
        $this->linenum= '';
        $this->crn = '';
        $this->assypart= '';
        $this->assydesc= '';
        $this->bomref= '';
        $this->bomiss= '';
        $this->qty= '';
        $this->unit_price= '';
        $this->link2assyreview= '';
        $this->totalprice= '';
        $this->pcrn='';
        $this->partnum='';
        $this->description='';
        $this->part_iss='';
        $this->cos_iss='';
        $this->model_iss='';
        $this->drg_iss='';
        $this->assydate='';

     }

    // Property get and set
    function getlinenum() {
           return $this->linenum;
    }

    function setlinenum($linenum) {
           $this->linenum = $linenum;
    }
    function getcrn() {
           return $this->crn;
    }

    function setcrn($reqcrn) {
           $this->crn = $reqcrn;
    }


    function getassypart() {
           return $this->assypart;
    }

    function setassypart($reqassypart) {
           $this->assypart = $reqassypart;
    }
 function getassydesc() {
           return $this->assydesc;
    }

    function setassydesc($reqassydesc) {
           $this->assydesc = $reqassydesc;
    }
 function getbomref() {
           return $this->bomref;
    }

    function setbomref($reqbomref) {
           $this->bomref = $reqbomref;
    }
  function getbomiss() {
           return $this->bomiss;
    }

    function setbomiss($reqbomiss) {
           $this->bomiss = $reqbomiss;
    }
  function getqty() {
           return $this->qty;
    }

    function setqty($bomiss) {
           $this->qty = $bomiss;
    }
   function getprice() {
           return $this->unit_price;
    }

    function setprice($reqprice) {
           $this->unit_price = $reqprice;
    }
    function getlink2review() {
           return $this->link2assyreview;
    }

    function setlink2review($reqlink2review) {
           $this->link2assyreview = $reqlink2review;
    }
    
    function gettotalprice() {
           return $this->totalprice;
    }

    function settotalprice($reqtotprice) {
           $this->totalprice = $reqtotprice;
    }
     function setpcrn($pcrn) {
           $this->pcrn = $pcrn;
    }
    function setpartnum($partnum) {
           $this->partnum = $partnum;
    }

    function setdescription($description) {
           $this->description = $description;
    }

    function setpart_iss($part_iss) {
           $this->part_iss = $part_iss;
    }

    function setcos_iss($cos_iss) {
           $this->cos_iss = $cos_iss;
    }
function setmodel_iss($model_iss) {
           $this->model_iss = $model_iss;
    }
function setdrg_iss($drg_iss) {
           $this->drg_iss = $drg_iss;
    }
    
    function setassydate($assydate) {
      $this->assydate = $assydate;
    }


    function addAssyReview_li($ponum)
    {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "select nxtnum from seqnum where tablename = 'assy_review_li' for update";
         $result = mysql_query($sql);
         if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
         $myrow = mysql_fetch_row($result);
         $seqnum = $myrow[0];
         $objid = $seqnum + 1;
         $linenum ="'" .$this->linenum . "'";
         $crn = "'" . $this->crn . "'";
  	     $assypart =  "'".$this->assypart ."'";
  	     $assydesc ="'" .$this->assydesc . "'";
  	     $bomref =  "'".$this->bomref ."'";
  	     $bomiss =  "'".$this->bomiss ."'";
  	     $link2review = $this->link2assyreview;
  	     $qty =$this->qty?$this->qty:0;
  	     $unit_price= $this->unit_price?$this->unit_price:0.00;
  	     $total_price= $this->totalprice?$this->totalprice:0.00;
         $partnum ="'" .$this->partnum . "'";
         $description ="'" .$this->description . "'";
         $part_iss ="'" .$this->part_iss . "'";
         $cos_iss ="'" .$this->cos_iss . "'";
         $model_iss ="'" .$this->model_iss . "'";
         $drg_iss ="'" .$this->drg_iss . "'";
         $pcrn ="'" .$this->pcrn . "'";

		 $sql = "INSERT INTO assy_review_li
               (recnum,
               line_num,
        	   crn,
        	   assy_partnum,
        	   assy_desc,
        	   bomref,
        	   bomiss,
        	   qty,
        	  unit_price,
              link2assyreview,
              total_price,pcrn,ponum,part_num,description,pi_attachments,drg_iss,cos_iss,model_iss)
               VALUES
		     ($objid,
              $linenum,
        	  $crn,
        	  $assypart,
        	  $assydesc,
        	  $bomref,
        	  $bomiss,
        	  $qty,
        	  $unit_price,
              $link2review,
              $total_price,$pcrn,'$ponum',$partnum,$description,$part_iss,$drg_iss,$cos_iss,$model_iss)";

         $result = mysql_query($sql);
         if(!$result) die("Insert to review_assembly_li  didn't work..Please report to Sysadmin. " . mysql_error());
         
         $sql = "update seqnum set nxtnum = $objid where tablename = 'assy_review_li'";
         $result = mysql_query($sql);
         if(!$result) die("Seqnum insert query didn't work for Review li Entry..Please report to Sysadmin. " . mysql_error());
     }

    function updateAssyReview_li($recnum,$ponum)
    {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $sql = "start transaction";

         $linenum ="'" .$this->linenum . "'";
         $crn = "'" . $this->crn . "'";
	     $assypart =  "'".$this->assypart ."'";
	     $assydesc ="'" .$this->assydesc . "'";
	     $bomref =  "'".$this->bomref ."'";
	     $bomiss =  "'".$this->bomiss ."'";
	     $qty =$this->qty?$this->qty:0;
	     $unit_price= $this->unit_price?$this->unit_price:0.00;
	     $total_price= $this->totalprice?$this->totalprice:0.00;
          $pcrn ="'" .$this->pcrn . "'";
          $partnum ="'" .$this->partnum . "'";
         $description ="'" .$this->description . "'";
         $part_iss ="'" .$this->part_iss . "'";
         $cos_iss ="'" .$this->cos_iss . "'";
         $model_iss ="'" .$this->model_iss . "'";
         $drg_iss ="'" .$this->drg_iss . "'";

        $sql = "update assy_review_li set
              line_num=$linenum,
    	      crn=$crn,
        	  assy_partnum=$assypart,
        	  assy_desc=$assydesc,
        	  bomref=$bomref,
        	  bomiss=$bomiss,
        	  qty=$qty,
        	  unit_price=$unit_price,
        	  total_price=$total_price,
        	  pcrn=$pcrn,
        	  ponum='$ponum',
        	  part_num=$partnum,
        	  description=$description,
        	  pi_attachments=$part_iss,
              drg_iss=$drg_iss,
              cos_iss=$cos_iss,
              model_iss=$model_iss
              where recnum = $recnum";
           //echo $sql;
           $result = mysql_query($sql);

           // Test to make sure query worked
           if(!$result) die("Update to assyReview LI didn't work..Please report to Sysadmin. " . mysql_error());
     }

    function getLI($recnum)
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select arli.recnum,
            arli.line_num as line_num,
    	    arli.crn,
        	arli.assy_partnum,
        	arli.assy_desc,
        	arli.bomref,
        	arli.bomiss,
        	arli.qty,
        	arli.unit_price,
        	arli.total_price,
            arli.pcrn,
            arli.part_num,
            arli.description,
            arli.pi_attachments,
            arli.drg_iss,
            arli.cos_iss,
            arli.model_iss
            from  assy_review_li arli
            where arli.link2assyreview=$recnum
            order by (0+line_num) asc,line_num ASC";
       //echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("Access to Review Assembly Li details failed...Please report to SysAdmin. " . mysql_error());
        return $result;
    }
    
    function deleteassyreviewli($lnrecnum)
    {
       $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from assy_review_li where recnum=$lnrecnum";
       //echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("Delete For Assy Review Li failed...Please report to SysAdmin. " . mysql_error());
        //return $result;
    }
    
     function deleteassyreviewlichild($crnnum)
    {
       $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from assy_review_li where pcrn='$crnnum'";
    //echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("Delete For Assy Review Li failed...Please report to SysAdmin. " . mysql_error());
        //return $result;
    }

    public function addAssywo4AssySOLI($ponum,$link2customer)
    {
      $newlogin = new userlogin;
      $newlogin->dbconnect();

      $sql = "select nxtnum from seqnum where tablename = 'assywo' for update";
      $result = mysql_query($sql);
      if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
      $myrow = mysql_fetch_row($result);
      $seqnum = $myrow[0];
      $objid = $seqnum + 1;
      $assy_type= "Assembly";
      $assywonum = str_pad($objid, 5, '0', STR_PAD_LEFT);
      $assywonum='A'.$assywonum;

      $linenum ="'" .$this->linenum . "'";
      $crn = "'" . $this->crn . "'";
      $assypart =  "'".$this->assypart ."'";
      $assydesc ="'" .$this->assydesc . "'";
      $link2review = $this->link2assyreview;
      $qty =$this->qty?$this->qty:0;
      $part_iss ="'" .$this->part_iss . "'";
      $cos_iss ="'" .$this->cos_iss . "'";
      $drg_iss ="'" .$this->drg_iss . "'";
      $assydate ="'" .$this->assydate . "'";
      $siteid="'". $_SESSION['siteid'] ."'";

      $sql = "select * from assy_wo where assy_wonum = $assywonum";
      $result = mysql_query($sql);
      if (!(mysql_fetch_row($result)))
      {
        $sql = "INSERT INTO assy_wo 
                  (recnum,assy_wonum,assydate, crn, link2cust,ponum,poqty,assypartnum,assypartiss,
                  cosno,descr,drgiss,format_num,format_rev,  cust_po_line_num,
                  status,assy_type,assyqty, siteid)
                VALUES
                  ($objid,'$assywonum',$assydate, $crn, $link2customer,'$ponum',$qty,$assypart,
                  $part_iss,$cos_iss,$assydesc,$drg_iss, 'F7035',
                  'Rev 1 dt 04 January, 2017 Process Details',$linenum, 'Pending',
                  '$assy_type',$qty,$siteid)";

        $result = mysql_query($sql);
        if(!$result) die("Insert to Assy WO didn't work..Please report to Sysadmin. " . mysql_error());
      }
      else
      {
        echo "<table border=1><tr><td><font color=#FF0000>";
        die("Assy WO# " . $assywonum . " already exists. ");
        echo "</td></tr></table>";
      }
      $sql = "update seqnum set nxtnum = $objid where tablename = 'assywo'";
      $result = mysql_query($sql);
      return $objid;
    }


} // End bom class definition
