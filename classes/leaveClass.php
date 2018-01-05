<? 
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: workOrderClass.php
// Maintains the class for ecos
// Revision: v1.0
// Modifications History
// Jan 12, 05 - Modified for WO layer
//              Badari Mandyam
//====================================

include_once('loginClass.php');

class leave { 

   

    function myLeaves($userRecnum) { 
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT * FROM leave_mgt where link2user='$userRecnum'";
        
        $result = mysql_query($sql);
        return $result;
     } 
     function emplLeaves(){
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = $_SESSION['userrecnum'];
        //$sql = "SELECT * FROM leave_mgt where link2user in(select recnum from user where type!='EMPL')";
        $sql = "SELECT * FROM leave_mgt where link2user!='$userid'";
        $result = mysql_query($sql);
        //echo $sql;
        return $result;
     }
     function updateStatus($recnum,$statusLbl)
     {
        $status='Rejected';
        if($statusLbl==1) $status='Approved';
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "update leave_mgt set status='$status' where recnum=$recnum";
        //echo $sql;
        mysql_query($sql);
     }
     function leaveDetails($recnum){
      $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT * FROM leave_mgt where recnum='$recnum'";
        //echo $sql;
        $result = mysql_query($sql);
        return mysql_fetch_assoc($result);
     }
     function newLeave($recnum,$from,$to,$reason,$status,$siteid)
     {
       $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "insert into  leave_mgt(`from`,`to`,reason,status,link2user,empid,created_date,siteid)
          values('$from','$to','$reason','$status','$recnum','E$recnum',NOW(),'$siteid')";
        //echo $sql;
              mysql_query($sql);
     }
     function newEmplLeave($recnum,$from,$to,$reason,$status,$siteid)
     {
        $emprecnum = substr($recnum, 1);
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "insert into  leave_mgt(`from`,`to`,reason,status,link2user,empid,created_date,siteid)
          values('$from','$to','$reason','$status','$emprecnum','$recnum',NOW(),'$siteid')";
        //echo $sql;
              mysql_query($sql);
     }



    
} // End work order class definition 
