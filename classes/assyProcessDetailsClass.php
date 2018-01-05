<?
//==================================================
// Author: FSI                                     =
// Date-written = August 28,2012                   =
// Filename: assyProcessDetailsClass.php           =
// Maintains the class for assy wo process details =
// Revision: v1.0                                  =
//==================================================

include_once('loginClass.php');

class assywoprocessdetails
{
   var $seqnumber,
       $process,
       $st_date_time,
       $end_date_time,
       $remarks,
       $link2assywo;
       
   function assywoprocessdetails()
   {
        $this->seqnumber = '';
        $this->process = '';
        $this->st_date_time = '';
        $this->end_date_time = '';
        $this->remarks = '';
        $this->link2assywo = '';
   }
   
   function setseqnumber($seqnumber)
   {
     $this->seqnumber = $seqnumber;
   }
   function setprocess($process)
   {
     $this->process = $process;
   }
   function setst_date_time($st_date_time)
   {
     $this->st_date_time = $st_date_time;
   }
   function setend_date_time($end_date_time)
   {
     $this->end_date_time = $end_date_time;
   }
   function setremarks_pdets($remarks)
   {
     $this->remarks = $remarks;
   }
   function setlink2assywo($link2assywo)
   {
     $this->link2assywo = $link2assywo;
   }

   
   function addassywoProcessdets()
   {
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     
     $st_date_time=$this->st_date_time? "'" . $this->st_date_time . "'":'0000-00-00 00:00:00';
     $end_date_time= $this->end_date_time?"'" . $this->end_date_time . "'":'0000-00-00 00:00:00';
     $seqnumber= "'" . $this->seqnumber . "'";
     $remarks="'". $this->remarks ."'";
     $process="'". $this->process ."'";
     $link2assywo = $this->link2assywo;

     $sql = "INSERT INTO assy_processdetails
                        (line_num, process, st_date_time, end_date_time, other_details, link2assywo)
                         VALUES
			             ($seqnumber,$process, $st_date_time, $end_date_time, $remarks,$link2assywo)";
              //echo $sql;
              $result = mysql_query($sql);

           // Test to make sure query worked
              if(!$result) die("Insert to Assy processdetails didn't work..Please report to Sysadmin. " . mysql_error());
   
   }
   

    function getAssyWoprdet($recnum)
    {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select apd.recnum,apd.line_num,apd.process,apd.st_date_time,apd.end_date_time,
                       apd.other_details,apd.link2assywo
                FROM assy_processdetails apd
                where apd.link2assywo=$recnum";
       // echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("getAssyWoprdet failed...Please report to SysAdmin. " . mysql_error());
       // echo $result;
        return $result;
     }
     
      function updateAssywo_processdets($inrecnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        
        $st_date_time=$this->st_date_time? "'" . $this->st_date_time . "'":'0000-00-00 00:00:00';
        $end_date_time= $this->end_date_time?"'" . $this->end_date_time . "'":'0000-00-00 00:00:00';
        $seqnumber= "'" . $this->seqnumber . "'";
        $remarks="'". $this->remarks ."'";
        $process="'". $this->process ."'";
        $link2assywo = $this->link2assywo;

        $sql = "update assy_processdetails set
                  line_num = $seqnumber,
                  st_date_time = $st_date_time,
                  end_date_time = $end_date_time,
                  process = $process,
                  other_details = $remarks
               where recnum = $inrecnum";
           //echo $sql;
           $result = mysql_query($sql);

           // Test to make sure query worked
           if(!$result) die("Update to Assy WO Process details didn't work..Please report to Sysadmin. " . mysql_error());
     }
     
     function deleteprocessdets($assyrecnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from assy_processdetails where link2assywo = $assyrecnum";
        //echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("Delete for Assy Process details failed...Please report to SysAdmin. " . mysql_error());
      }

    function deleteprodetLI($recnum)
     {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from assy_processdetails where recnum = $recnum";
        //echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("Delete for Assy Process details failed...Please report to SysAdmin. " . mysql_error());
      }



}
?>
