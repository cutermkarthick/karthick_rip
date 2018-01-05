<?
//====================================
// Author: FSI
// Date-written = oct 23, 2009
// Filename: nc4storesClass.php
// Maintains the class for Stores
// Revision: v1.0
//====================================

include_once('loginClass.php');

class nc4stores {

    var   $refnum,
          $cdate,
          $supplier,
          $rm_po_num,
          $receipt_date,
          $invoice_num,
          $bol_num,
          $cofcnum,
          $dim_deviaion,
          $mat_deviation,
          $descrepancy_quantity,
          $raw_material_docs,
          $specific_marking,
          $other_deviation,
          $descreption,
          $root_cause,
          $corrective_action,
          $preventive_action,
          $nc_created_by,
          $nc_supplied_by,
          $due_date,
          $effectiveness;

    // Constructor definition
    function nc4stores() {
        $this->refnum = '';
        $this->cdate = '';
        $this->supplier = '';
        $this->rm_po_num = '';
        $this->receipt_date = '';
        $this->invoice_num = '';
        $this->bol_num = '';
        $this->dim_deviaion = '';
        $this->mat_deviation = '';
        $this->descrepancy_quantity = '';
        $this->raw_material_docs = '';
        $this->specific_marking = '';
        $this->other_deviation = '';

        $this->descreption = '';      
        $this->root_cause= '';
        $this->corrective_action= '';
        $this->preventive_action= '';
		$this->nc_created_by= '';
		$this->nc_supplied_by= '';
		$this->due_date= '';
        $this->effectiveness= '';
       
    }

    // Property get and set
    function getrefnum() {
           return $this->refnum;
    }

    function setrefnum ($refnum) {
           $this->refnum = $refnum;
    }

    function getcdate() {
           return $this->cdate;
    }
	function setcdate ($cdate) {
           $this->cdate = $cdate;
    }

	function getsupplier() {
           return $this->supplier;
    }
    function setsupplier ($supplier) {
           $this->supplier = $supplier;
    }

    function getrm_po_num() {
           return $this->rm_po_num;
    }
    function setrm_po_num ($rm_po_num) {
           $this->rm_po_num = $rm_po_num;
    }


    function getreceipt_date() {
           return $this->receipt_date;
    }

    function setreceipt_date ($receipt_date) {
           $this->receipt_date = $receipt_date;
    }

    function getinvoice_num() {
           return $this->invoice_num;
    }

    function setinvoice_num ($invoice_num) {
           $this->invoice_num = $invoice_num;
    }

    function getbol_num() {
           return $this->bol_num;
    }

    function setbol_num ($bol_num) {
           $this->bol_num = $bol_num;
    }

    function getcofcnum() {
           return $this->cofcnum;
    }

    function setcofcnum($cofcnum) {
           $this->cofcnum = $cofcnum;
    }

	function getdim_deviation() {
           return $this->dim_deviation;
    }

    function setdim_deviation ($dim_deviation) {
           $this->dim_deviation = $dim_deviation;
    }


    function getmat_deviation() {
           return $this->mat_deviation;
    }

    function setmat_deviation ($mat_deviation) {
           $this->mat_deviation = $mat_deviation;
    }

    function getdescrepancy_quantity() {
           return $this->descrepancy_quantity;
    }

    function setdescrepancy_quantity($descrepancy_quantity) {
           $this->descrepancy_quantity= $descrepancy_quantity;
    }

    function getraw_material_docs() {
           return $this->raw_material_docs;
    }

    function setraw_material_docs ($raw_material_docs) {
           $this->raw_material_docs = $raw_material_docs;
    }


    function getspecific_marking() {
           return $this->specific_marking;
    }

    function setspecific_marking ($specific_marking) {
           $this->specific_marking = $specific_marking;
    }

    function getother_deviation() {
           return $this->other_deviation;
    }

    function setother_deviation ($other_deviation) {
           $this->other_deviation = $other_deviation;
    }

	function getdescription() {
           return $this->description;
    }
    function setdescription ($description) {
           $this->description = $description;
    }

    function getroot_cause() {
           return $this->root_cause;
    }
	function setroot_cause ($root_cause) {
           $this->root_cause = $root_cause;
    }

	function getcorrective_action() {
           $this->corrective_action = $corrective_action;
    }
    function setcorrective_action($corrective_action) {
           $this->corrective_action = $corrective_action;
    }
    function getpreventive_action() {
           $this->preventive_action = $preventive_action;
    }
   
    function setpreventive_action($preventive_action) {
           $this->preventive_action = $preventive_action;
    }

	 function getnc_created_by() {
           $this->nc_created_by = $nc_created_by;
    }
   
    function setnc_created_by($nc_created_by) {
           $this->nc_created_by = $nc_created_by;
    }

   	 function getnc_supplied_by() {
           $this->nc_supplied_by = $nc_supplied_by;
    }
   
    function setnc_supplied_by($nc_supplied_by) {
           $this->nc_supplied_by = $nc_supplied_by;
    }
	 function getdue_date() {
           $this->due_date = $due_date;
    }
   
    function setdue_date($due_date) {
           $this->due_date = $due_date;
    }
    function geteffectiveness() {
           return $this->effectiveness;
    }

    function seteffectiveness($effectiveness) {
           $this->effectiveness = $effectiveness;
    }
  

    function addnc4stores() 
	{
        $newlogin = new userlogin;
        $newlogin->dbconnect();      
      
        $refnum = "'" . $this->refnum . "'";
        $cdate = "'" . $this->cdate . "'";
        $supplier= "'" . $this->supplier . "'";
        $rm_po_num = "'" . $this->rm_po_num . "'";
        $receipt_date = "'" . $this->receipt_date . "'";
        $invoice_num = "'" . $this->invoice_num . "'";
        $bol_num = "'" . $this->bol_num . "'";        
        $cofcnum = "'" . $this->cofcnum . "'";
		$dim_deviation= "'" . $this->dim_deviation . "'";
        $mat_deviation = "'" . $this->mat_deviation . "'";
        $descrepency_quantity = "'" . $this->descrepancy_quantity . "'";
        $raw_material_docs= "'" . $this->raw_material_docs . "'";
        $specific_marking = "'" . $this->specific_marking . "'";
        $other_deviation = "'" . $this->other_deviation . "'";
		$description = "'" . $this->description . "'";

		$root_cause = "'" . $this->root_cause . "'";
        $corrective_action = "'" . $this->corrective_action . "'";
        $preventive_action = "'" . $this->preventive_action . "'";

        $nc_supplied_by = "'" . $this->nc_supplied_by . "'";
       $nc_created_by = "'" . $this->nc_created_by . "'";
	    $due_date = "'" . $this->due_date . "'";
        $effectiveness = "'" . $this->effectiveness . "'";
        $siteid= "'" . $_SESSION['siteid']. "'";   

		$sql = "select * from nc4stores where refnum = $refnum";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {       
        $sql = "INSERT INTO
                        nc4stores
                            (
							 refnum,
                             date,
                             supplier,
                             rm_po_num,
                             receipt_date,
                             invoice_num,
                             bol_num,
                             cofcnum,
                             dim_deviation,
                             mat_deviation,
                             descrepancy_quantity,
                             raw_material_docs,
                             specific_marking,
                             other_deviation,
                             description,
                             root_cause,
                             corrective_action,
                             preventive_action,
							 nc_created_by,
							 nc_supplied_by,
							 due_date,
                             effectiveness,
							 formatnum,
							 formatrev,
               siteid
                            )
                    VALUES
                            (
                             $refnum,
                             $cdate,
                             $supplier,
                             $rm_po_num,
                             $receipt_date,
                             $invoice_num,
                             $bol_num,
                             $cofcnum,
                             $dim_deviation,
                             $mat_deviation,
                             $descrepency_quantity,
                             $raw_material_docs,
                             $specific_marking,
                             $other_deviation,
                             $description,
                             $root_cause,
                             $corrective_action,
                             $preventive_action,
							 $nc_created_by,
							 $nc_supplied_by,
							 $due_date,
                             $effectiveness,
							 'F7533',
							 'Rev. No.0',
               $siteid)";   
		}
		else {
        echo "<table border=1><tr><td><font color=#FF0000>";
        die("Ref No " . $refnum . " already exists. ");
        echo "</td></tr></table>";
        } 
        

      // echo $sql;
           $result = mysql_query($sql);
           if(!$result) die("Insert to nc4qa didn't work..Please report to Sysadmin. " . mysql_error());
           $sql = "commit";
           $result = mysql_query($sql); 
           if(!$result) die("Insert to nc4qa didn't work..Please report to Sysadmin. " . mysql_error());       
     }

    
     function updatenc4stores($recnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();       
      
        $cdate = "'" . $this->cdate . "'";
        $supplier= "'" . $this->supplier . "'";
        $rm_po_num = "'" . $this->rm_po_num . "'";
        $receipt_date = "'" . $this->receipt_date . "'";
        $invoice_num = "'" . $this->invoice_num . "'";
        $bol_num = "'" . $this->bol_num . "'";        
        $cofcnum = "'" . $this->cofcnum . "'";
		$dim_deviation= "'" . $this->dim_deviation . "'";
        $mat_deviation = "'" . $this->mat_deviation . "'";
        $descrepancy_quantity = "'" . $this->descrepancy_quantity . "'";	
        $raw_material_docs= "'" . $this->raw_material_docs . "'";
        $specific_marking = "'" . $this->specific_marking . "'";
        $other_deviation = "'" . $this->other_deviation . "'";
		$description = "'" . $this->description . "'";

		$root_cause = "'" . $this->root_cause . "'";
        $corrective_action = "'" . $this->corrective_action . "'";
        $preventive_action = "'" . $this->preventive_action . "'";

        $nc_supplied_by = "'" . $this->nc_supplied_by . "'";
        $nc_created_by = "'" . $this->nc_created_by . "'";
	    $due_date = "'" . $this->due_date . "'";

        $effectiveness = "'" . $this->effectiveness . "'";         		
   
       
          $sql = "UPDATE nc4stores SET                           
                             date=$cdate,
                             supplier=$supplier,
                             rm_po_num=$rm_po_num,
                             receipt_date=$receipt_date,
                             invoice_num=$invoice_num,
                             bol_num=$bol_num,
                             cofcnum=$cofcnum,
                             dim_deviation=$dim_deviation,
                             mat_deviation=$mat_deviation,
                             descrepancy_quantity=$descrepancy_quantity,
                             raw_material_docs=$raw_material_docs,
                             specific_marking=$specific_marking,
                             other_deviation=$other_deviation,
                             description=$description,
                             root_cause=$root_cause,
                             corrective_action=$corrective_action,
                             preventive_action=$preventive_action,
							 nc_created_by=$nc_created_by,
							 nc_supplied_by=$nc_supplied_by,
							 due_date=$due_date,
                             effectiveness=$effectiveness
        	WHERE
                    recnum = $recnum ";
       // echo $sql;
        $result = mysql_query($sql);   
       	if(!$result)
	   {
		 $sql = "rollback";
		 $result = mysql_query($sql);
		 die("Insert of Nc Stores Table failed...Please report to Sysadmin. " . mysql_errno());
	   }
      
    }        
       
     function get_nc4stores($cond) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $siteid = $_SESSION['siteid'];
        $siteval = "siteid = '".$siteid."'";

         $sql = "select recnum,
		               refnum,
		               date,
					   supplier,
					   rm_po_num,
					   receipt_date,
					   invoice_num,
					   bol_num,
					   cofcnum
                  FROM nc4stores
				  where $cond and $siteval";
                               // echo $sql;
         $result = mysql_query($sql);
         
        if(!$result) die("get WO from NC Stores failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
     }   
	 function getnc4storesDetails($recnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

         $sql = "select recnum,
		               refnum,
		               date,
					   supplier,
					   rm_po_num,
					   receipt_date,
					   invoice_num,
					   bol_num,
					   cofcnum,
					   dim_deviation,
					   mat_deviation,
					   descrepancy_quantity,
					   raw_material_docs,
					   specific_marking,
					   other_deviation,
					   description,
					   root_cause,
					   corrective_action,
					   preventive_action,
					   nc_created_by,
					   nc_supplied_by,
					   due_date,
					   effectiveness,
					   formatnum,
					   formatrev
                  FROM nc4stores

				  where recnum=$recnum";
         $result = mysql_query($sql);
         // echo $sql."<br>";
        if(!$result) die("get WO from NC Stores failed ..Please report to Sysadmin. " . mysql_error());
        return $result;
     } 	 
} 
