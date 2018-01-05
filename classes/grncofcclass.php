<?
//====================================
// Author: FSI
// Date-written = July 04, 2007
// Filename: grnClass.php
// Maintains the class for GRN
//====================================
// Modifications History
//
//====================================



include_once('classes/loginClass.php');

class cofc {
    var
      $dimension,
	  $ndt,
	  $visual,
	  $grain,
	  $mech,
	  $conductivity,
	  $chemical,
	  $hardness,
	  $quantity,
      $temper,
	  $cus,
	  $cim,
	  $not,
	  $from,
	  $to,
	  $con,
	  $ncref,
      $ncrdate,
      $comm,
      $dcomm,
      $anotes,
      $approval;

    // Constructor definition
    function cofc() {
     $this->dimension='';
	 $this->ndt='';
	 $this->visual='';
	 $this->grain='';
	 $this->mech='';
	 $this->conductivity='';
	 $this->chemical='';
	 $this->hardness='';
	 $this->quantity='';
     $this->temper='';
	 $this->cus='';
	 $this->cim='';
	 $this->not='';
	 $this->from='';
	 $this->to='';
     $this->con='';
	 $this->ncref='';
     $this->ncrdate='';
     $this->comm='';
     $this->dcomm='';
     $this->anotes='';
     $this->approval='';
	}
    function setcon($con) 
	{
	 $this->con=$con;
	}
    function setncref($ncref)
	{
	$this->ncref=$ncref;
	}
    function setncrdate($ncrdate)
	{
	$this->ncrdate=$ncrdate;
	}
	function setcomm($comm)
	{
	$this->comm=$comm;
	}
    function setdcomm($dcomm)
	{
	 $this->dcomm=$dcomm;
	}
	function  setanotes($anotes)
	{
	$this->anotes=$anotes;
	}
   function setdimension($dimension)
   {
   $this->dimension=$dimension;
   }
   function setndt($ndt)
   {
   $this->ndt=$ndt;
   }
   function setvisual($visual)
   {
   $this->visual=$visual;
   }
   function setgrain($grain)
   {
   $this->grain=$grain;
   }
   function setmech($mech)
   {
   $this->mech=$mech;
   }
   function setcon1($conductivity)
   {
   $this->conductivity=$conductivity;
   }
   function setchemical($chemical)
   {
   $this->chemical=$chemical;
   }
   function sethardness($hardness)
   {
   $this->hardness=$hardness;
   }
   function setquantity($quantity)
   {
   $this->quantity=$quantity;
   }
   function settemper($temper)
   {
   $this->temper=$temper;
   }
   function setcus($cus)
   {
    $this->cus=$cus;
   }
   function setcim($cim)
   {
   $this->cim=$cim;
   }
   function setnot($not)
   {
   $this->not=$not;
   }
   function setfrom($from)
   {
   $this->from=$from;
   }
   function setto($to)
   {
   $this->to=$to;
   }
   function setapproval($approval)
   {
   $this->approval=$approval;
   }
    function addcofc($grnrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
       
        $sql = "select nxtnum from seqnum where tablename = 'cofc' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
	    $dimension=$this->dimension;
        $ndt=$this->ndt;
	    $visual=$this->visual;
	    $grain=$this->grain;
	    $mech=$this->mech;
	    $conductivity=$this->conductivity;
	    $chemical=$this->chemical;
 	    $hardness=$this->hardness;
 	    $quantity=$this->quantity;
        $temper=$this->temper;
	    $cus=$this->cus;
        $cim=$this->cim;
	    $not=$this->not;
	    $from=$this->from;
 	    $to=$this->to;
	    $con=$this->con;
	    $ncref=$this->ncref;
        $ncrdate=$this->ncrdate ? $this->ncrdate : '0000-00-00';
        $comm=$this->comm;
        $dcomm=$this->dcomm;
        $anotes=$this->anotes;
        $approval=$this->approval;
         
		$sql="insert into cofc(
                `recno`,
                `dimensional`,
                `ndt`,
                `visual`,
                `grain`,
                `mech`,
                `conductivity`,
                `chemical`,
                `hardness`,
                `quantity`,
                `temper`,
                `cusserial`,
                `cimserial`,
                `notrequired`,
                `frmserial`,
                `toserial`,
                `noncon`,
                `ncref`,
                `ncdate`,
                `comm`,
                `dcomm`,
                `remarks`,
                `link2grn`,
                `approval`
                )values(
                '$objid',
	            '$dimension',
	            '$ndt',
	            '$visual',
	            '$grain',
	            '$mech',
	            '$conductivity',
	            '$chemical',
	            '$hardness',
	            '$quantity',
                '$temper',
	            '$cus',
	            '$cim',
	            '$not',
	            '$from',
	            '$to',
	            '$con',
	            '$ncref',
                '$ncrdate',
                '$comm',
                '$dcomm',
                '$anotes',
                '$grnrecnum',
                '$approval')";
		   
        // echo $sql .'<br>';
           $result = mysql_query($sql);
           // Test to make sure query worked 
           if(!$result) die("Insert query for cofc didn't work. " . mysql_error()); 
           
        $sql = "update seqnum set nxtnum = $objid where tablename = 'cofc'";
        
        //echo $sql;
              mysql_query($sql);        
 }
					 
 function getcofc($recno)
 {
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $sql="select * from cofc where link2grn='$recno'";

    //echo $sql;
    

    $result=mysql_query($sql);
	return ($result);
 }
 function updatecofc($recno)
 {
	$newlogin = new userlogin;
    $newlogin->dbconnect();
					//echo $recno;
					  $dimension=$this->dimension;
                      $ndt=$this->ndt;
	                  $visual=$this->visual;
	                  $grain=$this->grain;
	                  $mech=$this->mech;
	                  $conductivity=$this->conductivity;
	                  $chemical=$this->chemical;
 	                  $hardness=$this->hardness;
 	                  $quantity=$this->quantity;
                      $temper=$this->temper;
	                  $cus=$this->cus;
                      $cim=$this->cim;
	                  $not=$this->not;
	                  $from=$this->from;
 	                  $to=$this->to;
	                  $con=$this->con;
	                  $ncref=$this->ncref;
                      $ncrdate=$this->ncrdate;
                      $comm=$this->comm;
                      $dcomm=$this->dcomm;
                      $anotes=$this->anotes;
                      $approval=$this->approval;
	
	                  $sql="update cofc set
        
                      `dimensional`='$dimension',
                      `ndt`='$ndt',
                      `visual`='$visual',
                      `grain`='$grain',
                      `mech`='$mech',
                      `conductivity`='$conductivity',
                      `chemical`='$chemical',
                      `hardness`='$hardness',
                      `quantity`='$quantity',
                      `temper`='$temper',
                      `cusserial`='$cus',
                      `cimserial`='$cim',
                      `notrequired`='$not',
                      `frmserial`='$from',
                      `toserial`='$to',
                      `noncon`='$con',
                      `ncref`='$ncref',
                      `ncdate`='$ncrdate',
                      `comm`='$comm',
                      `dcomm`='$dcomm',
                      `remarks`='$anotes',
                      `approval`='$approval'

                      where link2grn='$recno'";

                    // echo $sql;
		   
                     mysql_query($sql);
	
	}
					  
					  
} // End grn class definition
