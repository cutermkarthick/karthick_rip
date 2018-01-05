<?

//====================================
// Author: FSI
// Date-written = May 27, 2005
// Filename: vendPartClass.php
// Maintains the class for Vendor Parts
// Revision: v1.0
//====================================

include_once('loginClass.php');

class newsEntry {

    var $created_by,
        $date,
        $descr;
       

    // Constructor definition

    function taskEntry() {
        $this->created_by = '';
        $this->date = '';
        $this->descr = '';
        // $this->taskcompleted_date = '';
        
    }

    function getcreated_by () {
           return $this->created_by;
    }
    function setcreated_by ($reqcreated_by) {
           $this->created_by = $reqcreated_by;
    }

    function getdate () {
           return $this->date;
    }
    function setdate ($reqdate) {
           $this->date = $reqdate;
    }

   function getdescr () {
           return $this->descr;
    }
    function setdescr ($reqdescr) {
           $this->descr = $reqdescr;
    }

   function addNews()
    {

      echo $taskcreate_date;exit;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);

        $sql = "select nxtnum from seqnum where tablename = 'News' for update";
        $result = mysql_query($sql);

        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);

        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $created_by = "'" . $this->created_by . "'";
        $date = "'" . $this->date . "'";
        $descr = "'" . $this->descr . "'";
        $sql = "INSERT INTO
		      news (recnum, created_by, date ,descr)
                  VALUES
		          ($objid, $created_by, $date,$descr)";
// echo "$sql";
              $result = mysql_query($sql);

        // Test to make sure query worked
         if(!$result) die("Task Entry query didn't work for task..Please report to Sysadmin. " . mysql_error());
           }
            
        $sql = "update seqnum set nxtnum = $objid where tablename = 'News'";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work for vend_part_master..Please report to Sysadmin. " . mysql_error());
        $sql = "commit";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Commit failed for vend_part_master Insert..Please report to Sysadmin. " . mysql_error());
        return $objid;
     }

//     function updatePart($inppartrecnum) {
//         $partrecnum =$inppartrecnum;
//         $newlogin = new userlogin;
//         $newlogin->dbconnect();
//         $sql = "start transaction";

//         $partnum = "'" . $this->partnum . "'";
//         $mfr_partnum = "'" . $this->mfr_partnum . "'";
//         $digikey_partnum = "'" . $this->digikey_partnum . "'";
//         $serial ="'" . $this->serial . "'";
//         $mfr = "'" . $this->mfr . "'";
//         $rate = $this->rate;
//         $min_qty = $this->min_qty;
//         $lead_time=$this->lead_time;
//         $lead_unit= "'" . $this->lead_unit . "'";
//         $part_desc= "'" . $this->part_desc . "'";
//         $value= "'" . $this->value . "'";
//         $inventory_cnt= $this->inventory_cnt;
//         $link2vendor=$this->link2vendor;
//         $ptype= "'" . $this->ptype . "'";
//         $drgnum= "'" . $this->drgno . "'";
//         $drgiss= "'" . $this->drgiss . "'";
//         $partiss= "'" . $this->partiss . "'";

//         $sql = "UPDATE vend_part_master SET
// 	              partnum =$partnum,
//                               mfr_partnum = $mfr_partnum,
//                               digikey_partnum = $digikey_partnum,
//                               serial = $serial,
//                               mfr = $mfr,
//                               rate = $rate,
//                               min_qty = $min_qty,
//                               lead_time = $lead_time,
// 	                          lead_unit=$lead_unit,
// 	                          part_desc= $part_desc,
// 	                          value=$value,
// 	                          inventory_cnt=$inventory_cnt,
// 	                          link2vendor=$link2vendor,
// 	                          ptype=$ptype,
// 	                          part_iss=$partiss,
// 	                          drg_no=$drgnum,
// 	                          drg_iss=$drgiss
//                    WHERE
// 	             recnum = $partrecnum";
//           $result = mysql_query($sql);
//            //   echo "$sql<br>";
//            // Test to make sure query worked
//            if(!$result) die("Update to vend_part_master didn't work..Please report to Sysadmin. " . mysql_error());

//      }


//      function getParts($vendrecnum) {
//         $newlogin = new userlogin;
//         $newlogin->dbconnect();
//         $sql = "SELECT
// 		 p.*,c.name
//                    FROM
//                    vend_part_master p, company c
//                    WHERE
// 		           c.recnum = p.link2vendor  and
//                    p.link2vendor=" . $vendrecnum;
// //echo "$sql";
//         $result = mysql_query($sql);
//         // Test to make sure query worked
//         if(!$result) die("Access to vend_part_master failed...Please report to SysAdmin. " . mysql_error());
//         return $result;
//      }

// //9-11-2006 bom2parts
//      function getbom2Parts() {
//         $newlogin = new userlogin;
//         $newlogin->dbconnect();
//         $sql = "SELECT
// 		           b.*
//                    FROM bom b";
//         // echo "$sql";
//         $result = mysql_query($sql);
//         // Test to make sure query worked
//         if(!$result) die("Access to vend_part_master failed...Please report to SysAdmin. " . mysql_error());
//         return $result;
//      }

// //1-12-2006 function for whereusedparts

//      function whereusedparts($partrecnum) {
//         $newlogin = new userlogin;
//         $newlogin->dbconnect();
//         $sql = "SELECT  distinct bomnum,bomdescr
//                 FROM bom b,bom_line_items bli, vend_part_master p
//                 where bli.link2parts = p.recnum and
//                       bli.link2bom = b.recnum and
//                       p.recnum=" . $partrecnum;
//        //echo "$sql";
//         $result = mysql_query($sql);
//         // Test to make sure query worked
//         if(!$result) die("Access to vend_part_master failed...Please report to SysAdmin. " . mysql_error());
//         return $result;
//      }

//     function getPartsort($cond,$argsort1,$argoffset,$arglimit)
//     {
//         $wcond = $cond;
//         $offset = $argoffset;
//         $limit = $arglimit;
//         $sortorder = $argsort1;
//       //  if($sortorder=='')
//             $sortorder=$argsort1;

//        $sql = "SELECT
// 		 v.*,c.name
//                   FROM
// 		vend_part_master v, company c
//                   WHERE
// 		$wcond and c.recnum = v.link2vendor
// 	  ORDER BY
// 		 $sortorder limit $offset, $limit";
// // echo "$sql";
//        $result = mysql_query($sql);
//        return $result;
//     }

// //6-12-2006 function for Report
// function Partsort4Report($cond,$argsort1,$argoffset,$arglimit)
//     {
//         $wcond = $cond;
//         $offset = $argoffset;
//         $limit = $arglimit;
//         $sortorder = $argsort1;
//         if($sortorder=='')
//             $sortorder=$argsort1;

//        $sql = "SELECT
// 		 v.*,c.name
//                   FROM
// 		vend_part_master v, company c
//                   WHERE
// 		$wcond and c.recnum = v.link2vendor and
// 		v.inventory_cnt < v.min_qty

//       ORDER BY
// 		 $sortorder limit $offset, $limit";
// //echo "$sql";
//        $result = mysql_query($sql);
//        return $result;
//     }

//     function getPartcount($cond,$argoffset, $arglimit)
//     {
//         $wcond = $cond;
//         $offset = $argoffset;
//         $limit = $arglimit;

//         $sql = "SELECT
// 	               count(*) as numrows
// 	   FROM
// 	              vend_part_master v, company c
//                    WHERE
// 	              $wcond and c.recnum = v.link2vendor";
// //echo "$sql";
//         $newlogin = new userlogin;
//         $newlogin->dbconnect();
//         $result  = mysql_query($sql) or die(' Vend Part count query failed');
//         $row     = mysql_fetch_array($result, MYSQL_ASSOC);
//         $numrows = $row['numrows'];
//         return $numrows;

// }


//     function getPartDetails($inppartrecnum)
//     {
//         $partrecnum =$inppartrecnum;
//         $newlogin = new userlogin;
//         $newlogin->dbconnect();
//         $sql = "SELECT
// 		 b.*,c.name
//                    FROM
// 		 vend_part_master b, company c
//                    WHERE
// 		 c.recnum = b.link2vendor
// 	       and b.recnum=$partrecnum";
// 	    // echo $sql;exit;
//         $result = mysql_query($sql);
//         if(!$result) die("Access to vend_part_master details failed...Please report to SysAdmin. " . mysql_error());
//         return $result;
//     }
//     function getPart()
//     {
//         $newlogin = new userlogin;
//         $newlogin->dbconnect();
//         $sql = "SELECT v.partnum,v.part_iss,v.part_desc,v.drg_no,v.drg_iss,c.name
//                 from vend_part_master v,company c
//                 where c.recnum=v.link2vendor";
// 	    //echo $sql;
//         $result = mysql_query($sql);
//         if(!$result) die("Access to vend_part_master details failed...Please report to SysAdmin. " . mysql_error());
//         return $result;
//     }
    
//     function increaseInv($qty)
//     {
//         $partrecnum=$_SESSION['partrecnum'];
//         $newlogin = new userlogin;
//         $newlogin->dbconnect();
//         $sql = "SELECT inventory_cnt FROM vend_part_master WHERE recnum=$partrecnum";
//         $result = mysql_query($sql);
//         $myrow = mysql_fetch_row($result);
//         $qty=$myrow[0]+$qty;
//         $sql = "UPDATE vend_part_master SET inventory_cnt=$qty WHERE recnum=$partrecnum";
//         $result = mysql_query($sql);
//         if(!$result) die("Access to vend_part_master details failed...Please report to SysAdmin. " . mysql_error());
//         return $result;

//     }
//  function decreaseInv($qty)
//     {
//         $partrecnum=$_SESSION['partrecnum'];
//         $newlogin = new userlogin;
//         $newlogin->dbconnect();
//         $sql = "SELECT inventory_cnt FROM vend_part_master WHERE recnum=$partrecnum";
//         $result = mysql_query($sql);
//         $myrow = mysql_fetch_row($result);
//         $qty=$myrow[0]-$qty;
//         $sql = "UPDATE vend_part_master SET inventory_cnt=$qty WHERE recnum=$partrecnum";
//         $result = mysql_query($sql);
//         if(!$result) die("Access to vend_part_master details failed...Please report to SysAdmin. " . mysql_error());
//         return $result;
//        }

//  function addinventory()
//  {
//         $ref_type="'" . $this->ref_type . "'";
//         $ref_num="'" . $this->ref_num . "'";
//         $type1= $this->type1 ;
//         $inv_date="'" . $this->inv_date . "'";
//         $inv_num="'" . $this->inv_num . "'";
//         $rece_date="'" . $this->rece_date . "'";
//         $rece_by="'" . $this->rece_by . "'";
//         $inv_value="'" . $this->inv_value . "'";
//         $crn="'" . $this->crn . "'";
//         $mc_name="'" . $this->mc_name . "'";
//         $status="'" . $this->status . "'";
//         $cl_date="'" . $this->cl_date . "'";
//         $qty= $this->qty ;
//         $partrecnum=$_SESSION['partrecnum'];
//         $newlogin = new userlogin;
//         $newlogin->dbconnect();
//         $sql = "start transaction";
//         $result = mysql_query($sql);
//         $sql = "select nxtnum from seqnum where tablename = 'inventory'";
//         $result = mysql_query($sql);
//         if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
//         $myrow = mysql_fetch_row($result);
//         $seqnum = $myrow[0];

//         $objid = $seqnum + 1;
//         $sql = "select inventory_cnt from vend_part_master where recnum = $partrecnum";
//         // echo $sql;
//         $result = mysql_query($sql);
//         if(!$result) die("Inventory cnt access failed..Please report to Sysadmin. " . mysql_error());
//         $myrow = mysql_fetch_row($result);
//         $invcnt = $myrow[0];
//         $opbal = $invcnt;



// // echo $type1;exit;
//        if ($type1 == 'Receipts')
//         {
     
//             $clbal = $invcnt + $qty;
       
//         }
//         else if($type1 == 'Issues' && $invcnt >0)
//         {
//             $clbal = $invcnt - $qty;
        
//          }
//           $type1="'". $this->type1."'" ;
 
      
//        $sql = "INSERT INTO
//        inventory (recnum,type,qty,ref_type,ref_num,link2vendpart,create_date,invoice_date,invoice_no,receive_date,received_by,opbal,clbal,invoice_value,crn,mc_name,status,closing_date)
//                           VALUES
//       ($objid,$type1,$qty,$ref_type,$ref_num,$partrecnum,curdate(),$inv_date,$inv_num,$rece_date,$rece_by,$opbal,$clbal,$inv_value,$crn,$mc_name,$status,$cl_date)";

// // echo $sql;exit;
//         $result = mysql_query($sql);

//         // Test to make sure query worked
//         if(!$result) die("Vend part insert query didn't work for Inventory..Please report to Sysadmin. " . mysql_error());

//         $sql = "UPDATE seqnum SET nxtnum = $objid WHERE tablename = 'inventory'";
//         $result = mysql_query($sql);
//         $sql = "commit";
//         $result = mysql_query($sql);

//         // Test to make sure query worked
//       if(!$result) die("Seqnum insert query didn't work for equip_part_master..Please report to Sysadmin. " . mysql_error());

// }

// function getInventory($recnum)
//   {
//   $newlogin = new userlogin;
//         $newlogin->dbconnect();
//         $sql = "select 
//                 i.recnum,
//                 i.receive_date,
//                 i.type,
//                 i.qty,
//                 i.ref_num,
//                 i.ref_type,
//                 i.invoice_date,
//                 i.invoice_no,
//                 i.clbal,
//                 i.create_date,
//                 i.received_by,
//                 i.invoice_value,
//                 i.crn,
//                 i.mc_name,
//                 i.status,
//                 i.closing_date
//                 from inventory i
//                 where
//                 i.link2vendpart = $recnum order by create_date";
    

//       // echo $sql;
//         $result = mysql_query($sql);
//         if(!$result) die("Access to Inventory failed...Please report to SysAdmin. " . mysql_error());
//         return $result;
//   }





//   function getInventoryIssues($recnum)
//   {
//   $newlogin = new userlogin;
//   $newlogin->dbconnect();
//         $sql = "select 
//                 i.recnum,
//                 i.receive_date,
//                 i.type,
//                 i.qty,
//                 i.ref_num,
//                 i.ref_type,
//                 i.invoice_date,
//                 i.invoice_no,
//                 i.clbal,
//                 i.create_date,
//                 i.received_by,
//                 i.invoice_value,
//                 i.crn,
//                 i.mc_name,
//                 i.status,
//                 i.closing_date
//                 from inventory i
//                 where
//                 i.recnum = $recnum order by create_date";
    

//       // echo $sql;
//         $result = mysql_query($sql);
//         if(!$result) die("Access to Inventory failed...Please report to SysAdmin. " . mysql_error());
//         return $result;
//   }

//     function updateinventory($recnum) {

//         $newlogin = new userlogin;
//         $newlogin->dbconnect();
//         $sql = "start transaction";

//         $ref_type="'" . $this->ref_type . "'";
//         $ref_num="'" . $this->ref_num . "'";
//         $type1="'". $this->type1."'" ;
//         $rece_by="'" . $this->rece_by . "'";
//         $crn="'" . $this->crn . "'";
//         $mc_name="'" . $this->mc_name . "'";
//         $status= $this->status;
//         $clbal = $this->clbal;
//         $qty= $this->qty ;
//         $date ="'" . date('Y-m-d') . "'"; 

       
//       if($status == 'Active')
// {

//   $status = "'". $this->status."'";
//    $clbal = $qty + $clbal;

//         $sql = "UPDATE inventory SET
//                 ref_type =$ref_type,
//                               ref_num = $ref_num,
//                               type = $type1,
//                               received_by = $rece_by,
//                               qty=$qty,
//                               crn = $crn,
//                               mc_name = $mc_name,
                           
//                               status = $status,
//                             clbal=$clbal,
//                             closing_date = $date
                            
//                    WHERE
//                recnum = $recnum";
//                // echo $sql;exit;
//           $result = mysql_query($sql);


//         }else 
//         {

//   $status = "'". $this->status."'";

//    $sql = "UPDATE inventory SET
//                 ref_type =$ref_type,
//                               ref_num = $ref_num,
//                               type = $type1,
//                               received_by = $rece_by,
//                               qty=$qty,
//                               crn = $crn,
//                               mc_name = $mc_name,
//                              status = $status,
//                             clbal=$clbal,
//                             closing_date = $date
                            
//                    WHERE
//                recnum = $recnum";
//                // echo $sql;exit;
//           $result = mysql_query($sql);
//        }
//            //   echo "$sql<br>";
//            // Test to make sure query worked
//            if(!$result) die("Update to vend_part_master didn't work..Please report to Sysadmin. " . mysql_error());

//      }
} // End Part class definition
