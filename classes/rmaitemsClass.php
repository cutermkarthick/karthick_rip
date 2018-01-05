<? 
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: rma_items_retClass.php
// Maintains the class for PO rma_items_retne items
// Revision: v1.0
//====================================

include_once('loginClass.php');  

class rmaitems { 

    var    
     $link2rma,
     $itemname,
     $partnum,
     $qty;
        
    // Constructor definition 
        function rmaitems() { 
        $this->link2rma = ''; 
        $this->itemname = ''; 
        $this->partnum = ''; 
        $this->qty = ''; 
     } 
     
    // Property get and set
    function getlink2rma() {
           return $this->link2rma;
    }

    function setlink2rma ($reqlink2rma) {

           $this->link2rma = $reqlink2rma;
    }

    function getpart() {
           return $this->partnum;
    }
    function setpart ($reqpartnum) {
           $this->partnum = $reqpartnum;
    }

    function getqty() {
           return $this->qty;
    }

    function setqty ($reqqty) {
           $this->qty = $reqqty;
    }
    function addrmaitems() { 
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'rmaitems' for update";
//echo "<br>$sql</br>";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum access failed for rmaitems..Please report to Sysadmin. " . mysql_error()); 
        }
        $myrow = mysql_fetch_row($result);

        $seqnum = $myrow[0];
	//echo "<br>seqnum   : $seqnum</br>";
        $objid = $seqnum + 1;
	//echo "<br>objectid   : $objid</br>";
        $link2rma = $this->link2rma;
        $partnum = "'" . $this->partnum . "'";
        $qty =  $this->qty ;
        $sql = "INSERT INTO rma_items (recnum, link2rma, partnum,qty) 
               VALUES ($objid,$link2rma ,$partnum,$qty)";
       //echo "</br>$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked 
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to rmaitems didn't work..Please report to Sysadmin. " . mysql_error()); 
        }
        $sql = "update seqnum set nxtnum = $objid where tablename = 'rmaitems'";
	//echo "<br>$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked 
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for RMA Items returned..Please report to Sysadmin. " . mysql_error()); 
        }
        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Commit failed for RMA Items returned Insert..Please report to Sysadmin. " . mysql_error()); 
        }
     } 

    function updatermaitems($recnum) { 
        $recnum = $recnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $link2rma = $this->link2rma;
        $partnum = "'" . $this->partnum . "'";
        $qty =  $this->qty;
        $sql = "update rma_items
                          set link2rma = $link2rma,
                              partnum = $partnum, 
                              qty = $qty
                       where recnum = $recnum";
                           
           $result = mysql_query($sql);
//echo "<br>$sql";
           // Test to make sure query worked 
           if(!$result) die("Update to PO didn't work..Please report to Sysadmin. " . mysql_error()); 

     } 


     function getrmaitems($inprmarecnum) {
        $rmarecnum =  $inprmarecnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select recnum,link2rma, partnum,
                       qty from rma_items where link2rma = $rmarecnum";
        $result = mysql_query($sql);
        return $result;
     }


     function deletermaitems($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $rmarecnum = $inprecnum;
        $sql = "delete from rma_items where recnum = $rmarecnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for rma_itemsne Items failed...Please report to SysAdmin. " . mysql_error()); 
      }

    function disprmaitems() {

        $userrole = $_SESSION['userrole'];
        $userid = $_SESSION['user'];
        $popage = $_SESSION['popage'];
        
        if ($popage == 'po') {
           echo '<a href="quote1.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'Image8\',\'\',\'images/quote_mo.gif\',1)"><img name="Image8" border="0" src="images/quote.gif"></a>';
           echo '<a href="worderSummary.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'Image9\',\'\',\'images/order_mo.gif\',1)"><img name="Image9" border="0" src="images/order.gif"></a>';
           echo '<img src="images/po_mo.gif">';
           echo '<a href="new_po.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'Image11\',\'\',\'images/newpo_mo.gif\',1)"><img name="Image11" border="0" src="images/newpo.gif"></a>';
        }
        else if ($popage == 'newpo') {
           echo '<a href="quote1.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'Image8\',\'\',\'images/quote_mo.gif\',1)"><img name="Image8" border="0" src="images/quote.gif"></a>';
           echo '<a href="worderSummary.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'Image9\',\'\',\'images/order_mo.gif\',1)"><img name="Image9" border="0" src="images/order.gif"></a>';
           echo '<a href="po.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'Image11\',\'\',\'images/po_mo.gif\',1)"><img name="Image11" border="0" src="images/po.gif"></a>';
           echo '<img src="images/newpo_mo.gif">';
       
        }
        else if ($popage == 'podetails') {
           echo '<a href="po.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'Image12\',\'\',\'images/po_mo.gif\',1)"><img name="Image12" border="0" src="images/po.gif"></a>'; 
           echo '<a href="poUpdate.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'Image11\',\'\',\'images/editpo_mo.gif\',1)"><img name="Image11" border="0" src="images/editpo.gif"></a>';
           
//         
        }
        else if ($popage == 'poupdate') {
           echo '<a href="po.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'Image10\',\'\',\'images/po_mo.gif\',1)"><img name="Image10" border="0" src="images/po.gif"></a>';
           echo '<img src="images/editpo.gif"></a>';
//         
        }
        else if ($popage == 'pormaitemsnk') {
           echo '<a href="quote1.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'Image8\',\'\',\'images/quote_mo.gif\',1)"><img name="Image8" border="0" src="images/quote.gif"></a>';
           echo '<a href="worderSummary.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'Image9\',\'\',\'images/order_mo.gif\',1)"><img name="Image9" border="0" src="images/order.gif"></a>';
           echo '<img src="images/po_mo.gif">';
           
        }
     }


} // End po class definition 


