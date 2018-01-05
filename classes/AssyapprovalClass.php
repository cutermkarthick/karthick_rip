<?php

//====================================
// Author: FSI
// Date-written = Dec 06, 2017
// Filename: approvalClass.php
// Maintains the Approval Class.
// Revision: v1.0
//====================================

include_once('loginClass.php');

class Assyapproval 
{

	function updSignOff($assyworecnum, $wfrecnum, $stagenum) 
	{

	  $usertype = $_SESSION['usertype'];
	  $userrecnum = $_SESSION['userrecnum'];

    $newlogin = new userlogin;
    $newlogin->dbconnect();

    $sql="update dates assywo_flow dependency='' 
    			where dependency = $stagenum and 
    						link2wo=$assyworecnum" ;
    $result=mysql_query($sql);

    if ($usertype == 'EMPL')
    {

      $sql = "update assywo_flow set
                		 completed = NOW(),
                		 link2approvedbyowner = $userrecnum,
                		 app_flag = 1
           		where  link2doc = $assyworecnum and
                 		 recnum = $wfrecnum";
    }
    else if ($usertype == 'CUST')
    {
         $sql = "update assywo_flow  set
                      completed = NOW(),
                      link2approvedbycontact = $userrecnum,
                		  app_flag = 1
                 where link2doc = $assyworecnum and
                       recnum = $wfrecnum ";
    }

    // echo "$sql <br>"; exit;

    $result = mysql_query($sql);
    if(!$result) {
    	echo "<br>hi4<br>";
      echo "Update on Assywo flow in Approval failed.. " . mysql_error();
      $sql = "rollback";
      $result = mysql_query($sql);
      die("Please report to Sysadmin. ");
    }
    else
    {
    	return;
    }

 	}

  public function GetAssywo_QAApproval($assyworecnum)
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $sql = "select ali.recnum,ali.linenum,ali.itemno,ali.partnum,ali.issue,ali.grn,ali.link2assywo,
                   ali.qaapproved_by,ali.qaapproved_date
            FROM assywo_li ali
            where ali.link2assywo=$assyworecnum
            order by ali.recnum";
    // echo $sql;
    $result = mysql_query($sql);
    if(!$result) die("Access to Assy WO failed...Please report to SysAdmin. " . mysql_error());
    return $result;
  }


}


?>
