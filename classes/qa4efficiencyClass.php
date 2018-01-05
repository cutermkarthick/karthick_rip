<?
//====================================
// Author: FSI
// Date-written = June 14, 2008
// Filename: rmmasterClass.php
// Maintains the class for review
// Revision: v1.0  WMS
//====================================

$pagename = $_SESSION['pagename'];

include_once('classes/loginClass.php');


class qa4efficiency {
      var
        $crn,
        $rel_note,
        $wonum,
        $qadate,
        $qty_disp,
        $insp_by,
        $qty_accp;

    // Constructor definition
    function qa4efficiency() {
		$this->crn = '';
		$this->wonum = '';
        $this->rel_note = '';
        $this->qadate = '';
        $this->qty_disp = '';
        $this->insp_by = '';
        $this->qty_accp = '';
    }
    function getcrn() {
           return $this->crn;
    }
    function setcrn($crn) {
           $this->crn = $crn;
    }

    function getrelnote() {
           return $this->rel_note;
    }
    function setrelnote($rel_note) {
           $this->rel_note = $rel_note;
    }
    
    function getwonum() {
           return $this->wonum;
    }
    function setwonum($wonum) {
           $this->wonum = $wonum;
    }

    function getqadate() {
           return $this->qadate;
    }
    function setqadate($qadate) {
           $this->qadate= $qadate;
    }

    function getqty_disp() {
           return $this->qty_disp;
    }
    function setqty_disp($qty_disp) {
           $this->qty_disp = $qty_disp;
    }
    function getinsp_by() {
           return $this->insp_by;
    }
    function setinsp_by($insp_by) {
           $this->insp_by = $insp_by;
    }

    function getqty_accp() {
           return $this->qty_accp;
    }
    function setqty_accp($qty_accp) {
           $this->qty_accp = $qty_accp;
    }


   function addqa(){
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select nxtnum from seqnum where tablename = 'accp_rating' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $crn = "'" . $this->crn . "'";
        $wonum = "'" . $this->wonum . "'";
        $rel_note = "'" . $this->rel_note . "'";
        $qadate = "'" . $this->qadate . "'";
        $qty_disp = "'" . $this->qty_disp . "'";
        $inspected_by = "'" . $this->insp_by . "'";
        $qty_accp = "'" . $this->qty_accp . "'";

        $sql = "INSERT INTO
                accp_rating
                (
                  recnum,crn,relase_note,qa_date,qty_disp,inspected_by,qty_accp,wonum
                )
                VALUES
                (
                 $objid,$crn,$rel_note,$qadate,$qty_disp,$inspected_by,$qty_accp,$wonum
                )";

        //echo $sql;
        $result = mysql_query($sql);
        $sql = "commit";
        $result = mysql_query($sql);

           // Test to make sure query worked
        if(!$result) die("Insert to accp_rating didn't work..Please report to Sysadmin. " . mysql_error());
        
        $sql = "start transaction";
        $result = mysql_query($sql);

        $sql = "update seqnum set nxtnum = $objid where tablename = 'accp_rating'";
        $result = mysql_query($sql);
        
        $sql = "commit";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work for accp_rating.Please repport to Sysadmin. " . mysql_error());
        //echo " <br>objid: $objid<br>";
        return $objid;

     }



     function getqasummary($cond,$argsort1,$argoffset,$arglimit) {

        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;

        $newlogin = new userlogin;
        $newlogin->dbconnect();
         $sql = "select recnum,crn,relase_note,qa_date,qty_disp,inspected_by,qty_accp,wonum
                 FROM accp_rating
                 where $wcond order by crn,wonum  limit $offset, $limit";
        $result = mysql_query($sql);
        //echo "$sql";
        return $result;

     }


     function getqacount($cond,$argoffset, $arglimit)
     {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;

             $sql = "select count(*) as numrows from accp_rating
                      where $wcond limit $offset, $limit";
		//echo $sql;
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $result  = mysql_query($sql) or die('accp_rating count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;

     }


     function getqadata($qa4effrecnum) {
     
        $inqa4effrecnum = $qa4effrecnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();

       $sql = "select recnum,crn,relase_note,qa_date,qty_disp,
	            inspected_by,qty_accp,wonum
            FROM accp_rating
            where  recnum = $inqa4effrecnum";
      // echo $sql;
        $result = mysql_query($sql);
        return $result;
     }

     /*function getAllRMMs()
     {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select recnum,rmcode, rm_type, rm_spec,rm_dim1,rm_dim2,
	              rm_dim3,rm_dia, rm_ruling_dim
                      from rmmaster order by rmcode";
       $result = mysql_query($sql);
       return $result;

     }*/

  function updateqa($qa4effrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $crn = "'" . $this->crn . "'";
        $wonum = "'" . $this->wonum . "'";
        $rel_note = "'" . $this->rel_note . "'";
        $qadate = "'" . $this->qadate . "'";
        $qty_disp = "'" . $this->qty_disp . "'";
        $inspected_by = "'" . $this->insp_by . "'";
        $qty_accp = "'" . $this->qty_accp . "'";

        $sql = "UPDATE accp_rating SET
                       crn = $crn,
                       relase_note = $rel_note,
                       qa_date = $qadate,
                       qty_disp = $qty_disp,
                       inspected_by = $inspected_by,
                       qty_accp = $qty_accp,
                       wonum = $wonum

        	    WHERE
                       recnum = $qa4effrecnum";
        //echo $sql;
        $result = mysql_query($sql) or die("accp_rating update failed...Please report to SysAdmin. " . mysql_error());

 }
 
 
 function getwo4qaeffncy($crn) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();

       $sql = "select w.wonum,m.CIM_refnum from work_order w,master_data m
            where w.link2masterdata = m.recnum and
            m.CIM_refnum = '$crn' group by w.wonum";
      // echo $sql;
        $result = mysql_query($sql);
        return $result;
     }


 /*function ftp_copy($source_file,$destination_file)
     {
	$ftp_server='ftp.fluentsoft.com';
	$ftp_user='bmandyam@fluentsoft.com';
	$ftp_password='dci1034';
	$conn_id=ftp_connect($ftp_server);
	$login_result=ftp_login($conn_id,$ftp_user,$ftp_password);
	if (( !$conn_id ) || ( !$login_result ))
	{
		die("FTP connection Failed");
	}
	$upload=ftp_put($conn_id,$destination_file,$source_file,FTP_BINARY);
	ftp_close($conn_id);
	if(!$upload)
	{
		die("FTP copy has failed");
	}
   }*/
} // End RM Master class definition

