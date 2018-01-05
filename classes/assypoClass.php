<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: assypoClass.php
// Application: WMS
// Revision: v1.0
//====================================
session_start();
header("Cache-control: private");
include_once('loginClass.php');
class assyPo {

    var $assyPoNum,
        $podate,
        $link2host,
        $link2vend,
        $currency,
        $create_date,
        $modified_date,
        $formatnum,
        $formatrev,
        $approval,
        $appdate,
        $remarks,
        $terms,
        $amnddate,
        $amndno,
        $amndnotes,
        $shipping,
        $tax,
        $labour,
        $total_due,
        $poamount,
        $podesc,
        $type,
        $status;
        


    // Constructor definition
    function assyPo() {
        $this->assyPoNum = '';
        $this->podate = '';
        $this->link2host = '';
        $this->link2vend = '';
        $this->currency = '';
        $this->create_date = '';
        $this->modified_date = '';
        $this->formatnum = '';
        $this->formatrev = '';
        $this->approval = '';
        $this->appdate = '';
        $this->remarks = '';
        $this->terms = '';
        $this->amnddate = '';
        $this->amndno = '';
        $this->amndnotes = '';
        $this->shipping = '';
        $this->tax = '';
        $this->labour = '';
        $this->total_due = '';
        $this->poamount = '';
        $this->podesc = '';
        $this->status = '';
        $this->type = '';
        
    }

    // Property get and set
    function getassyPoNum() {
           return $this->assyPoNum;
    }
    function setassyPoNum($ponum) {
           $this->assyPoNum= $ponum;
    }
    function getdate() {
           return $this->podate;
    }
    function setpodate($dt) {
           $this->podate= $dt;
    }
    function gethost() {
           return $this->link2host;
    }
    function sethost ($host) {
           $this->link2host = $host;
    }
    function getvend() {
           return $this->link2vend;
    }
    function setvend ($vend) {
           $this->link2vend = $vend;
    }
    function getcur() {
           return $this->currency;
    }
    function setcur($cur) {
           $this->currency = $cur;
    }
    function setterms($ter) {
           $this->terms = $ter;
    }
    function setapproval($app) {
           $this->approval = $app;
    }
    function setapprovaldate($appdate) {
           $this->appdate = $appdate;
    }
    function setamnd_num($amndnum) {
           $this->amndno = $amndnum;
    }
    function setamnd_date($amddate) {
           $this->amnddate = $amddate;
    }
    function setamnd_notes($amndnote) {
           $this->amndnotes = $amndnote;
    }
    function setremarks($rem) {
           $this->remarks = $rem;
    }
     function setshipping($ship) {
           $this->shipping = $ship;
    }
     function settax($ta) {
           $this->tax = $ta;
    }
     function setlabour($lab) {
           $this->labour = $lab;
    }
     function settotaldue($due) {
           $this->total_due = $due;
    }
    function setpoamount($poam) {
           $this->poamount = $poam;
    }
    function setpodesc($pd) {
           $this->podesc = $pd;
    }
    
    function getstatus() {
           return $this->status;
    }

    function setstatus ($reqstatus) {
           $this->status = $reqstatus;
    }

    function gettype() {
           return $this->type;
    }

    function settype ($reqtype) {
           $this->type = $reqtype;
    }

     function addassyPo() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'assypo' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $assynum="'" . $this->assyPoNum . "'";
        $host= $this->link2host;
        $vendor= $this->link2vend;
        $currency= "'" . $this->currency . "'";
        $podate="'" . $this->podate . "'";
        $amnd_no="'" . $this->amndno . "'";
        $amnd_date=$this->amnddate?"'" . $this->amnddate . "'":'0000-00-00';
        $ter="'" . $this->terms . "'";
        $rem="'" . $this->remarks . "'";
        $amnd_notes="'" . $this->amndnotes . "'";
        $crdate = "'" . date("Y-m-d") . "'";
        $ship=$this->shipping?$this->shipping:0;
        $labour=$this->labour?$this->labour:0;
        $tax=$this->tax?$this->tax:0;
        $totdue=$this->total_due?$this->total_due:0;
        $pa=$this->poamount?$this->poamount:0;
        $pd="'" . $this->podesc . "'";
        $status = "'Pending'";
        $type="'" . $this->type . "'";

		
        $sql = "select * from assypo where assyPonum = $assynum";
        $result = mysql_query($sql);
        //echo $sql;
        if (!(mysql_fetch_row($result))) {
        $sql = "INSERT INTO assypo (recnum,
                                assyPonum,
                                podate,
                                link2host,
                                link2vend,
                                currency,
                                create_date,
                                amnd_no,
                                amnd_date,
                                amnd_notes,
                                terms,
                                remarks,
                                formatnum,
                                formatrev,
                                shipping,
                                tax,
                                labour,
                                total_due,
                                poamount,
                                po_desc,
                                status,
                                type,
								approval_by
                                )
                        VALUES ($objid,
                                $assynum,
                                $podate,
                                $host,
                                $vendor,
                                $currency,
                                $crdate,
                                $amnd_no,
                                $amnd_date,
                                $amnd_notes,
                                $ter,
                                $rem,
                                'F7003-1',
                                'Rev 0',
                                $ship,
                                $tax,
                                $labour,
                                $totdue,
                                $pa,
                                $pd,
                                $status,
                                $type,
								''
                                )";
          // echo "$sql";
          $result = mysql_query($sql);
          // Test to make sure query worked
          if(!$result) die("Insert to AssyPo didn't work..Please report to Sysadmin. " . mysql_error());

          }
          else {
                echo "<table border=1><tr><td><font color=#FF0000>";
               die("AssyPoNum " . $assynum . " already exists. ");
               echo "</td></tr></table>";
          }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'assypo'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work for assypo..Please report to Sysadmin. " . mysql_error());
        $sql = "commit";
        $result = mysql_query($sql);
        if(!$result) die("Commit failed for assypo Insert..Please report to Sysadmin. " . mysql_error());
        return $objid;
     }


function getPartDetails($crn,$custpotype,$company) {
        //echo'Company is '.$company;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
		$assycrn = substr($crn,2,2);
		//echo "assycrn is $assycrn<br>";
		if ($custpotype == 'Regular')
	    {
             $sql = "SELECT soli.crn_num,m.partnum as pripart,
			                     m.secondary_partname as secpart,
			                     soli.item_desc,soli.partiss,
                                 soli.drgiss,soli.rmspec,
								 soli.rmtype,
								 soli.cos_iss,
								 spm.price
                        FROM sales_order so,
						           so_line_items soli,
								    master_data m,
									spmaster spm,
									company c
                           
                      where so.recnum = soli.link2so and
                              so.status = 'Open' and
                              soli.crn_num = '$crn' and
                              m.CIM_refnum = '$crn' and
                              soli.crn_num is not NULL and
                               m.status = 'Active' and
							   spm.crnnum = '$crn' and
							   spm.status = 'Active' and
							   spm.link2vendor = c.recnum and
							   c.recnum = $company";
		}
		else	
	    {
              $sql = "SELECT bmi.crn,m.partnum as pripart,
			                 m.secondary_partname as secpart,
			                 bmi.partname,bmi.partiss,
                             bmi.drgiss,rm.rm_spec,rm.rm_type,m.cos,
                             spm.price
                         FROM bom_mfg_items bmi,
			                  assy_review_li arli,
			                  master_data m,
			                  bom b, 
			                  spmaster spm,
                              assy_review ar,
                              company c,
							  rmmaster rm
                          where ar.recnum = arli.link2assyreview and
                                (ar.status = 'Open' || ar.status = '' or ar.status is null) and
                                arli.crn = bmi.crn and
                                arli.crn='$crn' and
                                m.CIM_refnum = '$crn' and
                                m.status = 'Active' and
                                bmi.crn = '$crn' and
	                            bmi.link2bom = b.recnum and
                                b.`status`='Active' and
                                spm.crnnum = '$crn' and
							   spm.status = 'Active' and
							   spm.link2vendor = c.recnum and
							   rm.crnnum='$crn' and 
							   c.recnum = $company";
		}    
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("........getPartDetails....... failed...Please report to SysAdmin. " . mysql_error());
        return $result;
     }

 function getPartDetails_old($crn,$custpotype,$company) {
        //echo'Company is '.$company;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
		$assycrn = substr($crn,2,2);
		//echo "assycrn is $assycrn<br>";
		if ($custpotype == 'Regular')
	    {
             $sql = "SELECT soli.crn_num,m.partnum as pripart,
			                     m.secondary_partname as secpart,
			                     soli.item_desc,soli.partiss,
                                 soli.drgiss,soli.rmspec,
								 soli.rmtype,
								 soli.cos_iss,
								 spm.price
                        FROM sales_order so,
						           so_line_items soli,
								    master_data m,
									spmaster spm,
									company c
                           
                        where so.recnum = soli.link2so and
                              so.status = 'Open' and
                              soli.crn_num = '$crn' and
                              m.CIM_refnum = '$crn' and
                              soli.crn_num is not NULL and
                               m.status = 'Active' and
							   spm.crnnum = '$crn' and
							   spm.status = 'Active' and
							   spm.link2vendor = c.recnum and
							   c.recnum = $company
                       ";
		}
		else 
	    {
              $sql = "SELECT bmi.crn,m.partnum as pripart,
			                 m.secondary_partname as secpart,
			                 bmi.partname,bmi.partiss,
                             bmi.drgiss,m.rm_spec,m.rm_type,m.cos,
                             spm.price
                         FROM bom_mfg_items bmi,
			                  assy_review_li arli,
			                  master_data m,
			                  bom b, 
			                  spmaster spm,
                              assy_review ar,
                              company c
                          where ar.recnum = arli.link2assyreview and
                                (ar.status = 'Open' || ar.status = '' or ar.status is null) and
                                arli.crn = bmi.crn and
                                arli.crn='$crn' and
                                m.CIM_refnum = '$crn' and
                                m.status = 'Active' and
                                bmi.crn = '$crn' and
	                            bmi.link2bom = b.recnum and
                                b.`status`='Active' and
                                spm.crnnum = '$crn' and
							   spm.status = 'Active' and
							   spm.link2vendor = c.recnum and
							   c.recnum = $company";
		}
        //echo '+++++++++++++++++'.$sql;
        $result = mysql_query($sql);
        if(!$result) die("........getPartDetails....... failed...Please report to SysAdmin. " . mysql_error());
        return $result;
     }


     function getPartDetails_prev($crn,$custpotype,$company) {
        //echo'Company is '.$company;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
		$assycrn = substr($crn,2,2);
		//echo "assycrn is $assycrn<br>";
		if ($custpotype == 'Regular')
	    {
             $sql = "SELECT soli.crn_num,m.partnum as pripart,
			                     m.secondary_partname as secpart,
			                     soli.item_desc,soli.partiss,
                                 soli.drgiss,soli.rmspec,
								 soli.rmtype,
								 soli.cos_iss,
								 spm.price
                        FROM sales_order so,
						           so_line_items soli,
								    master_data m,
									spmaster spm,
									company c
                           
                        where so.recnum = soli.link2so and
                              so.status = 'Open' and
                              soli.crn_num = '$crn' and
                              m.CIM_refnum = '$crn' and
                              soli.crn_num is not NULL and
                               m.status = 'Active' and
							   spm.crnnum = '$crn' and
							   spm.status = 'Active' and
							   spm.link2vendor = c.recnum and
							   c.recnum = $company
                       ";
		}
		else 
	    {
              $sql = "SELECT bmi.crn,m.partnum as pripart,
			                 m.secondary_partname as secpart,
			                 bmi.partname,bmi.partiss,
                             bmi.drgiss,m.rm_spec,m.rm_type,m.cos,
                             ar.cust_ponum
                         FROM bom_mfg_items bmi,
			                  assy_review_li arli,
			                  master_data m,
			                  bom b, 
                              assy_review ar
                          where ar.recnum = arli.link2assyreview and
                                (ar.status = 'Open' || ar.status = '' or ar.status is null) and
                                arli.crn = b.crn and
                                m.CIM_refnum = '$crn' and
                                m.status = 'Active' and
                                bmi.crn = '$crn' and
	                            bmi.link2bom = b.recnum";
		}
        //echo '+++++++++++++++++'.$sql;
        $result = mysql_query($sql);
        if(!$result) die("........getPartDetails....... failed...Please report to SysAdmin. " . mysql_error());
        return $result;
     }

    function updateAssypo($delrecnum) {

         //echo 'in updateclass';
        //$porecnum = "'" . $inpporecnum . "'";
        $delrecnum = "'" . $delrecnum . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $host=$this->link2host;
        $vendor=$this->link2vend;
        //$assynum="'" . $this->assyPoNum . "'";
        $podate="'" . $this->podate . "'";
        $cur="'" . $this->currency . "'";
        $amnd_no="'" . $this->amndno . "'";
        $amnd_date="'" . $this->amnddate . "'";
        $ter="'" . $this->terms . "'";
        $rem="'" . $this->remarks . "'";
        $amnd_notes="'" . $this->amndnotes . "'";
        $mddate = "'" . date("y-m-d") . "'";
        $app = "'" . $this->approval . "'";
        $appdate =  $this->appdate?"'" . $this->appdate . "'":'0000-00-00';
        $ship=$this->shipping?$this->shipping:0;
        $labour=$this->labour?$this->labour:0;
        $tax=$this->tax?$this->tax:0;
        $totdue=$this->total_due?$this->total_due:0;
        $pa=$this->poamount?$this->poamount:0;
        $pd="'" . $this->podesc . "'";
        $status = "'" . $this->status . "'";
        $type = "'" . $this->type . "'";
		if($this->approval == 'no' || $this->approval == '')
		{
			$user='';
		}
		else
		{
			$user=$_SESSION[department];
		}		
      
        $sql = "update assypo set
                              podate = $podate,
                              currency = $cur,
                              amnd_no = $amnd_no,
                              amnd_date = $amnd_date,
                              amnd_notes = $amnd_notes,
                              approval = $app,
                              approval_date = $appdate,
                              modified_date = $mddate,
                              terms = $ter,
                              remarks = $rem,
                              shipping =  $ship,
                              tax = $tax,
                              labour = $labour,
                              total_due = $totdue,
                              poamount = $pa,
                              po_desc = $pd,
                              status = $status,
                              type = $type,
							  approval_by='$user'
                        where recnum = $delrecnum";

           //echo "$sql";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update assypo didn't work..Please report to Sysadmin. " . mysql_error());

     }

     function getassyPoDetails($rec) {
         $newlogin = new userlogin;
         $newlogin->dbconnect();


         $sql = "select a.recnum,
                        a.assyPonum,
                        a.podate,
                        a.link2vend,
                        a.link2host,
                        c.name,
                        c.addr1,
                        c.addr2,
                        c.city,
                        c.state,
                        c.country,
                        c.zipcode,
                        a.currency,
                        c.fax,
                        a.amnd_no,
                        a.amnd_date,
                        a.amnd_notes,
                        a.approval,
                        a.approval_date,
                        a.terms,
                        a.remarks,
                        a.modified_date,
                        a.create_date,
                        a.formatnum,
                        a.formatrev,
                        a.shipping,
                        a.tax,
                        a.labour,
                        a.total_due,
                        a.poamount,
                        a.po_desc,
                        a.status,
                        a.type,
						a.approval_by
                  FROM assypo a,company c
                  where c.recnum=a.link2vend and
                  a.recnum=$rec";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("getassyPoDetails failed..Please report to Sysadmin. " . mysql_error());
        return $result;
     }
     

function getassypoSummary_old($cond,$argoffset,$arglimit) {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $offset= $argoffset;
         $limit= $arglimit;
         $wcond = $cond;
      
         $sql = "select a.recnum,a.assyPonum,a.podate,c.name,ali.crnNum,
                        ali.priPartNum,ali.partName,a.status,ali.qty,dl.dnnum,dl.qty
                    FROM company c,assypo a,assypo_line_items ali
					left join delivery_note dl on dl.crn=ali.crnNum and ((ali.lineNum !=  '' and
                          ali.lineNum is not null and
                          ali.lineNum =  dl.poline_num) or
                          (ali.lineNum =  '' or ali.lineNum is null))
                    where a.recnum=ali.link2assyPo and
                          c.recnum=a.link2vend and
                          $wcond
                   order by a.recnum,ali.crnNum,dl.dnnum limit $offset,$limit";
     // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("get assypo Summary failed..Please report to Sysadmin. " . mysql_error());
        return $result;

     }
     
    function getassypoCount_old($cond,$argoffset,$arglimit)
	{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;

        $sql = "select count(*) as numrows
                    FROM assypo a,assypo_line_items ali,company c
				left join delivery_note dl on dl.crn=ali.crnNum and ((ali.lineNum !=  '' and
                          ali.lineNum is not null and
                          ali.lineNum =  dl.poline_num) or
                          (ali.lineNum =  '' or ali.lineNum is null)) 
                    where a.recnum=ali.link2assyPo and
                          c.recnum=a.link2vend and
                          $wcond
                     order by a.recnum,ali.crnNum,dl.dnnum limit $offset,$limit";
		echo $sql;
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $result  = mysql_query($sql) or die('assypo count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;

	}

    function getassypoSummary($cond,$argoffset,$arglimit) {
         $newlogin = new userlogin;
         $newlogin->dbconnect();
         $offset= $argoffset;
         $limit= $arglimit;
         $wcond = $cond;
      
         /*$sql = "select a.recnum,a.assyPonum,a.podate,c.name,ali.crnNum,
                        ali.priPartNum,ali.partName,a.status,ali.qty,dl.dnnum,dl.qty
                    FROM assypo a,assypo_line_items ali,company c
					left join delivery_note dl on dl.crn=ali.crnNum and ((ali.lineNum !=  '' and
                          ali.lineNum is not null and
                          ali.lineNum =  dl.poline_num) or
                          (ali.lineNum =  '' or ali.lineNum is null)) and a.assyPonum=SUBSTRING_INDEX(dl.ponum,' ',1)
                    where a.recnum=ali.link2assyPo and
                          c.recnum=a.link2vend and
                          $wcond
                   order by a.recnum,ali.crnNum,dl.dnnum limit $offset,$limit";*/
				   $sql ="(select a.recnum as recnum,a.assyPonum,a.podate,c.name,ali.crnNum as crnNum, ali.priPartNum,ali.partName,a.status,ali.qty,
								dl.dnnum as dnnum,dl.qty,dl.poline_num,a.amnd_no
								FROM assypo a,assypo_line_items ali,company c,delivery_note dl
						where a.recnum=ali.link2assyPo and c.recnum=a.link2vend  and dl.crn=ali.crnNum and $wcond and a.assyPonum=SUBSTRING_INDEX(dl.ponum,' ',1) and ((ali.lineNum !=  '' and
                          ali.lineNum is not null and
                          ali.lineNum =  dl.poline_num) or
                          (ali.lineNum =  '' or ali.lineNum is null)))
				        UNION
						(select a.recnum as recnum,a.assyPonum,a.podate,c.name,ali.crnNum as crnNum, ali.priPartNum,ali.partName,a.status,ali.qty,
								dl.dnnum as dnnum,dl.qty,dl.poline_num, a.amnd_no
								FROM company c,assypo_line_items ali,assypo a
						left join delivery_note dl on a.assyPonum=SUBSTRING_INDEX(dl.ponum,' ',1) 
						where dl.ponum is  null  and 
							 a.recnum=ali.link2assyPo and c.recnum=a.link2vend and
						     $wcond)
						order by recnum,crnNum,dnnum
						limit $offset,$limit";
        // echo "$sql";exit;
        $result = mysql_query($sql);
        if(!$result) die("get assypo Summary failed..Please report to Sysadmin. " . mysql_error());
        return $result;

     }
     
    function getassypoCount($cond,$argoffset,$arglimit)
	{
        $wcond = $cond; $wcond1= $cond1;
        $offset = $argoffset;
        $limit = $arglimit;

        /*$sql = "select count(*) as numrows
                    FROM assypo a,assypo_line_items ali,company c
				left join delivery_note dl on dl.crn=ali.crnNum and ((ali.lineNum !=  '' and
                          ali.lineNum is not null and
                          ali.lineNum =  dl.poline_num) or
                          (ali.lineNum =  '' or ali.lineNum is null)) and a.assyPonum=SUBSTRING_INDEX(dl.ponum,' ',1)
                    where a.recnum=ali.link2assyPo and
                          c.recnum=a.link2vend and
                          $wcond
                     order by a.recnum,ali.crnNum,dl.dnnum limit $offset,$limit";*/
					 $sql ="(select count(*) as numrows
					    FROM assypo a,assypo_line_items ali,company c,delivery_note dl
						where a.recnum=ali.link2assyPo and c.recnum=a.link2vend  and dl.crn=ali.crnNum and $wcond  and a.assyPonum=SUBSTRING_INDEX(dl.ponum,' ',1)
						order by a.recnum,ali.crnNum,dl.dnnum)
				        UNION
						(select count(*) as numrows
						FROM company c,assypo_line_items ali,assypo a
						left join delivery_note dl on a.assyPonum=SUBSTRING_INDEX(dl.ponum,' ',1) 
						where dl.dnnum is  null  and 
							 a.recnum=ali.link2assyPo and c.recnum=a.link2vend and
						     $wcond		 			
							 order by a.recnum,ali.crnNum,dl.dnnum)
						limit $offset,$limit";
				//echo $sql;
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $result  = mysql_query($sql) or die('assypo count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;
    
    }




    
    function getMasterdata($crn) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

       $sql = " select m.recnum,m.partnum,m.secondary_partname,m.partname,m.attachments,m.drg_issue,
            rmm.rm_spec,rmm.rm_type,m.cos
            FROM master_data m, rmmaster rmm
            where m.CIM_refnum = '$crn' and
                  rmm.crnnum = '$crn' and
                  rmm.rm_status = 'Active' and
                  status = 'Active'";
// echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
 }

