<?
//================================================
// Author: FSI
// Date-written = April 27,2010
// Filename: bomClass.php
// Maintains the class for BOMs
// Revision: v1.0
//================================================

include_once('loginClass.php');

class assywo_oper {

    var $opnnum,
        $stn,
        $operation,
        $signoff,
        $remarks;

    // Constructor definition
    function assywo_oper() {
        $this->opnnum = '';
        $this->stn = '';
        $this->operation = '';
        $this->signoff = '';
        $this->remarks = '';
        $this->link2assywo = '';

     }

    // Property get and set
    function getopnnum() {
           return $this->opnnum;
    }

    function setopnnum($reqopnnum) {
           $this->opnnum = $reqopnnum;
    }
    function getstn() {
           return $this->stn;
    }

    function setstn($reqstn) {
           $this->stn = $reqstn;
    }

    function getoperation() {
           return $this->operation;
    }

    function setoperation($reqoperation) {
           $this->operation = $reqoperation;
    }

    function getsignoff() {
           return $this->signoff;
    }
    function setsignoff($reqsignoff) {
           $this->signoff = $reqsignoff;
    }
    function getremarks() {
           return $this->remarks ;
    }
    function setremarks($reqremarks) {
           $this->remarks = $reqremarks;
    }
    function getlink2assywo() {
           return $this->link2assywo ;
    }
    function setlink2assywo($reqlink2assywo) {
           $this->link2assywo = $reqlink2assywo;
    }





    function addAssywoOper()
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $opnnum = "'" . $this->opnnum . "'";
        $stn = "'" . $this->stn . "'";
        $operation = "'" . $this->operation . "'";
        $signoff = "'" . $this->signoff . "'";
        $remarks ="'" . $this->remarks . "'";
        $link2assywo = $this->link2assywo;

         $sql = "INSERT INTO
		  	          operation(opnnum, stn, oper_descr, signoff, remarks,link2assywo)
                         VALUES
			         ($opnnum, $stn, $operation, $signoff,$remarks,$link2assywo)";
         //echo $sql;
         $result = mysql_query($sql);

           // Test to make sure query worked
         if(!$result) die("Insert to Assy WO Oper LI didn't work..Please report to Sysadmin. " . mysql_error());

        // Test to make sure query worked
        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for Assy WO Oper LI Insert..Please report to Sysadmin. " . mysql_error());
     }

    function updateAssywo_oper($inrecnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $opnnum = "'" . $this->opnnum . "'";
        $stn = "'" . $this->stn . "'";
        $operation = "'" . $this->operation . "'";
        $signoff = "'" . $this->signoff . "'";
        $remarks ="'" . $this->remarks . "'";

        $sql = "update operation set
                  opnnum = $opnnum,
                  stn = $stn,
                  oper_descr = $operation,
                  signoff = $signoff,
                  remarks = $remarks
               where recnum = $inrecnum";
           //echo $sql;
           $result = mysql_query($sql);

           // Test to make sure query worked
           if(!$result) die("Update to Assy WO Oper LI didn't work..Please report to Sysadmin. " . mysql_error());
     }

    function get_assy_oper($linkassypo)
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select recnum,opnnum,stn,oper_descr,signoff,remarks
                FROM operation
                where link2assywo=$linkassypo
                order by recnum";
       //echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("Access to Assy WO Oper LI failed...Please report to SysAdmin. " . mysql_error());
       // echo $result;
        return $result;
     }

//function to get only BOMs where bomnum=partnum
    function getBOM4parts()
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select b.recnum,b.bomnum, b.bomdate,c.name,b.bomdescr, b.type, b.bomamount
                  from bom b, company c
                  where
	            c.recnum = b.bom2customer and
                b.bomnum=b.partnum";
        $result = mysql_query($sql);
        if(!$result) die("Access to BOM failed...Please report to SysAdmin. " . mysql_error());
        // echo $result;
        return $result;
     }

    function getBOM_summary($cond,$argoffset,$arglimit)
    {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;

       $sql = "select b.recnum,b.bomnum,b.bom_issue,b.crn,b.assy_partnum
                 from bom b where $wcond limit $offset, $limit";
      //echo "$sql";
       $result = mysql_query($sql);
       return $result;
    }

    function getBOMcount($cond,$argoffset, $arglimit)
    {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;

        $sql = "select count(*) as numrows from bom b
                        where $wcond limit $offset, $limit";
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $result  = mysql_query($sql) or die('BOM count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;

    }


    function getBOMDetails($inpbomrecnum)
    {
        $bomrecnum = "'" . $inpbomrecnum . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select b.bomnum, b.type, b.bomdescr,
                   b.bomdate, b.bomamount,b.status,c.name, e1.fname,e2.fname,b.recnum,b.bom2customer,b.bom2aeowner,b.bom2seowner,b.link2wo,w.wonum,b.link2quote,q.id,e1.lname,e2.lname,b.makebuy,b.workcenter
                     from bom b, company c,employee e1,employee e2
                       left join quote q on
                           b.link2quote = q.recnum
                       left join work_order w on
                           b.link2wo = w.recnum

               where c.recnum = b.bom2customer
                    and   e1.recnum = b.bom2aeowner
	                and  e2.recnum=b.bom2seowner
	                and b.recnum=$bomrecnum";
        $result = mysql_query($sql);
        if(!$result) die("Access to BOM details failed...Please report to SysAdmin. " . mysql_error());
        return $result;

    }

     function ftp_copy($source_file,$destination_file)
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

    }

    function deleteOperli($assyrecnum) 
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from operation where link2assywo = $assyrecnum";
        //echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("Delete for Operation failed...Please report to SysAdmin. " . mysql_error());
      }

    function deleteLI($recnum) 
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from operation where recnum = $recnum";
        //echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("Delete for Operation failed...Please report to SysAdmin. " . mysql_error());
      }


} // End bom class definition
