<? 
//====================================
// Author: FSI
// Date-written = July 20, 2005 Jerry George
// Filename: shipmentClass.php
// Maintains the class for SR Shipments
// Revision: v1.0
//====================================

include_once('loginClass.php');  

class shipment{ 

    var    
     $desc,
     $seqnum,
     $carrier,
     $tracking_num,
     $final,
     $date,
     $link2wo;
        
        
    // Constructor definition 
    function shipment() { 
        $this->seqnum= ''; 
        $this->desc = ''; 
        $this->carrier= ''; 
        $this->tracking_num = ''; 
        $this->final = '';
        $this->date = '';
        $this->link2wo = '';

     } 
     
    // Property get and set

    function getseqnum() {
           return $this->seqnum;
    }

    function setseqnum($reqseqnum) {

           $this->seqnum = $reqseqnum;
    }

    function getdesc() {
           return $this->ship_desc;
    }

    function setdesc ($reqdesc) {

           $this->desc = $reqdesc;
    }
    function getdate() {
           return $this->date;
    }

    function setdate ($reqdate) {
	echo "i am in class   :$reqdate<br>";
           $this->date = $reqdate;
    }

    function getcarrier() {
           return $this->carrier;
    }

    function setcarrier ($reqcarrier) {
           $this->carrier = $reqcarrier;
    }
 
    function gettracking_num() {
           return $this->tracking_num;
    }

    function settracking_num ($reqtracking_num) {
echo "tracking_num :$reqtracking_num<br>";

           $this->tracking_num = $reqtracking_num;
    }
    function getfinal() {
           return $this->final;
    }

    function setfinal ($reqfinal) {
           $this->final = $reqfinal;
    }

    function getlink2wo() {
           return $this->link2wo;
    }

    function setlink2wo ($reqlink2wo) {
           $this->link2wo = $reqlink2wo;
    }


    function addSHP() { 
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'shipment' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("desc access failed for Shipment ..Please report to Sysadmin. " . mysql_error()); 
        }
        $myrow = mysql_fetch_row($result);
        $desc = $myrow[0];
        $objid = $desc + 1;
        $crdate = "'" . date("y-m-d") . "'";
        $seqnum= "'" . $this->seqnum. "'";
        $desc = "'" . $this->desc . "'";
        $carrier = "'" . $this->carrier . "'";
        $tracking_num = "'" . $this->tracking_num . "'";
        $final = "'" . $this->final . "'";
        $link2wo = $this->link2wo;
        $date = "'" . $this->date . "'";
echo "tracking_num :$tracking_num";
        $sql = "INSERT INTO shipment(recnum, seqnum,ship_desc,carrier,tracking_num, final, link2wo,date) 
	  VALUES ($objid,$seqnum,$desc,$carrier,$tracking_num,$final, $link2wo,$date)";
//echo "$sql";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to Shipment didn't work..Please report to Sysadmin. " . mysql_error()); 
        }
        $sql = "update seqnum set nxtnum = $objid where tablename = 'shipment'";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("desc insert query didn't work for Shipment.Please report to Sysadmin. " . mysql_error()); 
        }
     } 

    function updateSHP($recnum) { 
        $birecnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $seqnum= "'" . $this->seqnum. "'";
        $desc = "'" . $this->desc . "'";
        $carrier = "'" . $this->carrier . "'";
        $tracking_num = "'" . $this->tracking_num . "'";
        $final = "'" . $this->final . "'";
        $link2wo = $this->link2wo;
        $date = "'" . $this->date . "'";
        $sql = "update shipment
                          set 
		seqnum=$seqnum,
		ship_desc = $desc,
	              carrier=$carrier,
                              tracking_num = $tracking_num,
		date=$date,
                              final = $final
                        where recnum = $birecnum";
//echo "$sql<br>";
           $result = mysql_query($sql);
           // Test to make sure query worked 
           if(!$result) die("Update to Shipment didn't work..Please report to Sysadmin. " . mysql_error()); 

     } 



     function getShipments()
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $worecnum=$_SESSION['worecnum'];
         $sql = "select * from shipment where link2wo=$worecnum"; 
//echo "$sql";
             $result = mysql_query($sql);
             return $result;
     }

     function getGroups($argrecnum)
     {
        $sql="select distinct f. from m_shipment f  where f.link2wo=$argrecnum";
//echo "$sql";
             $result = mysql_query($sql);
             return $result;
     }

     function getPname($argrecnum)
     {
        $sql="select pname,parent from m_pagename  where recnum=$argrecnum";
//echo "$sql";
             $result = mysql_query($sql);
             return $result;
     }





     function deleteFD($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $recnum =$inprecnum;
        $sql = "delete from fields where recnum = $recnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Shipment Items failed...Please report to SysAdmin. " . mysql_error()); 
      }

} // End shipment class definition 


