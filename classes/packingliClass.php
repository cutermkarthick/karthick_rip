<?php

include_once('loginClass.php');

class packingli
{
var
     $line_num,
	 $length,
	 $width,
	 $thickness,
	 $net_weight,
	 $tot_weight,
     $link2packing,
     $ponum_li,
     $order_qty,
     $this_shipment,
     $bal_dispatch;
	 
	 function packingli() {
        $this->line_num = '';
        $this->length = '';
        $this->width = '';
        $this->thickness = '';
        $this->tot_weight = '';
        $this->net_weight = '';
        $this->link2packing = '';
		$this->numboxes = '';
		$this->ponum_li = '';
        $this->order_qty = '';
        $this->this_shipment = '';
        $this->bal_dispatch = '';
     }
     
     
     function getline_num() {
           return $this->line_num;
    }
    function setline_num ($line_num) {
           $this->line_num = $line_num;
    }

    function getlength() {
           return $this->length;
    }
    function setlength ($length) {
           $this->length = $length;
    }

    function getwidth() {
           return $this->width;
    }
    function setwidth ($width) {
           $this->width = $width;
    }

    function getthickness() {
           return $this->thickness;
    }
    function setthickness ($thickness) {
           $this->thickness = $thickness;
    }

    function gettot_weight() {
           return $this->tot_weight;
    }
    function settot_weight($tot_weight) {
           $this->tot_weight = $tot_weight;
    }

    function getnet_weight() {
           return $this->net_weight;
    }
    function setnet_weight ($net_weight) {
           $this->net_weight = $net_weight;
    }
    
    function getlink2packing() {
           return $this->link2packing;
    }
    function setlink2packing ($link2packing) {
           $this->link2packing = $link2packing;
    }
    function getnumboxes() {
           return $this->numboxes;
    }
    function setnumboxes($numboxes) {
           $this->numboxes = $numboxes ? $numboxes : 0;
    }

    function setponum_li($ponum_li)
    {
        $this->ponum_li = $ponum_li;

    }

    function setorder_qty($order_qty)
    {
        $this->order_qty = $order_qty;

    }

    function setthis_shipment($this_shipment)
    {
        $this->this_shipment = $this_shipment;

    }

    function setbal_dispatch($bal_dispatch)
    {
       $this->bal_dispatch = $bal_dispatch;

    }

     function addpackingli() {
       //echo "I am here";
         $sql = "select nxtnum from seqnum where tablename = 'packingli' for update";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv1");
                     die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
                     }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $line_num = $this->line_num?$this->line_num:0;
        $length =$this->length?$this->length:0.0;
        $width = $this->width?$this->width:0.0;
        $thickness = $this->thickness?$this->thickness:0.0;
		$net_weight = $this->net_weight?$this->net_weight:0.0;
        $tot_weight = $this->tot_weight?$this->tot_weight:0.0;
        $link2packing = $this->link2packing;
		$numboxes = $this->numboxes;
        
         $sql = "INSERT INTO packingli (
		                        recnum,
								line_num,
								length,
								width,
								thickness,
								net_weight,
								tot_weight,
                                link2packing,
								numboxes)
                            VALUES (
							   $objid,
							   $line_num,
							   $length,
							   $width,
							   $thickness,
							   $net_weight,
							   $tot_weight,
                               $link2packing,
							   $numboxes)";
        //echo $sql;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to LI didn't work..Please report to Sysadmin. " . mysql_error());
        }
         $sql = "update seqnum set nxtnum = $objid where tablename = 'packingli'";
         //echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for invoice line items..Please report to Sysadmin. " . mysql_error());
        }
     }
 function getpackinglidetails($recnum)
 {
      $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql="select * from packingli pli ,packing p 
	                  where p.recnum=pli.link2packing and 
					              p.recnum=$recnum";
       //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;
 }
 

     function updatepackingli($recnum) {
        $line_num = $this->line_num?$this->line_num:0;
        $length =$this->length?$this->length:0.0;
        $width = $this->width?$this->width:0.0;
        $thickness = $this->thickness?$this->thickness:0.0;
		$net_weight = $this->net_weight?$this->net_weight:0.0;
        $tot_weight = $this->tot_weight?$this->tot_weight:0.0;
        $link2packing = $this->link2packing;
		$numboxes = $this->numboxes;
        
        $sql = "UPDATE packingli SET
                    line_num = $line_num,
                    length = $length,
                    width = $width,
                    thickness = $thickness,
                    net_weight = $net_weight,
                    tot_weight = $tot_weight,
                    link2packing = $link2packing,
					numboxes = $numboxes
        	WHERE
                    recnum = $recnum";
        //echo $sql;
        $result = mysql_query($sql);
          if(!$result)
           {
	      $sql = "rollback";
	      $result = mysql_query($sql);
	      die("Update to packingli failed ..Please report to Sysadmin. " . mysql_error());
           }
         $sql = "commit";
         $result = mysql_query($sql);
         if(!$result)
         {
	       $sql = "rollback";
	       $result = mysql_query($sql);
	       die("Commit Failed for packingli..Please report to Sysadmin. " . mysql_errno());
         }
}
function addpacking_qtyli()
{
         $sql = "select nxtnum from seqnum where tablename = 'packing_qtyli' for update";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv1");
                     die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
                     }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
       $ponum_li = "'" . $this->ponum_li ."'";
        $order_qty = "'" . $this->order_qty ."'";
        $this_shipment = "'" . $this->this_shipment ."'";
        $bal_dispatch = "'" . $this->bal_dispatch ."'";

         $link2packing = $this->link2packing;
          //echo $seqnum."************".$objid;
         $sql = "INSERT INTO packing_qtyli (
		                        recnum,
								ponum,
								order_qty,
								qty_shipment,
								balqty_dispatch,
                                link2packing
								)
                            VALUES (
							   $objid,
							   $ponum_li,
							   $order_qty,
							   $this_shipment,
							   $bal_dispatch,
                               $link2packing)";
        //echo $sql;
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
                    die("Insert to LI didn't work..Please report to Sysadmin. " . mysql_error());
        }
         $sql = "update seqnum set nxtnum = $objid where tablename = 'packing_qtyli'";
         //echo "$sql";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Seqnum insert query didn't work for invoice line items..Please report to Sysadmin. " . mysql_error());
        }
}

function updatepackingqtyli($recnum) {

        $ponum_li = "'" . $this->ponum_li ."'";
        $order_qty = "'" . $this->order_qty ."'";
        $this_shipment = "'" . $this->this_shipment ."'";
        $bal_dispatch = "'" . $this->bal_dispatch ."'";
        $link2packing = $this->link2packing;

        $sql = "UPDATE packing_qtyli SET
                    ponum= $ponum_li,
                    order_qty = $order_qty,
                    qty_shipment = $this_shipment,
                    balqty_dispatch = $bal_dispatch,
                    link2packing = $link2packing
        	WHERE
                    recnum = $recnum";
        //echo $sql;
        $result = mysql_query($sql);
          if(!$result)
           {
	      $sql = "rollback";
	      $result = mysql_query($sql);
	      die("Update to packingli failed ..Please report to Sysadmin. " . mysql_error());
           }
         $sql = "commit";
         $result = mysql_query($sql);
         if(!$result)
         {
	       $sql = "rollback";
	       $result = mysql_query($sql);
	       die("Commit Failed for packingli..Please report to Sysadmin. " . mysql_errno());
         }
}

function getpackingqtylidetails($recnum)
 {
      $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql="select * from packing_qtyli pqli ,packing p
	                  where p.recnum=pqli.link2packing and
					              p.recnum=$recnum";
       //echo "\n" . $sql;
        $result = mysql_query($sql);
        return $result;
 }

}
?>
