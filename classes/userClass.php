<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: userClass.php
// Maintains the class for Quotes
// Revision: v1.0
//====================================

include_once('loginClass.php');

class user {

    var $initials,
        $loginid,
        $password,
        $type,
        $user2contact,
        $user2employee,
        $status,
        $creation_date;

    // Constructor definition
    function user() {
        $this->initials = '';
        $this->loginid = '';
        $this->password = '';
        $this->type = '';
        $this->user2contact = '';
        $this->user2employee = '';
        $this->creation_date = '';
        $this->status = '';
    }

    // Property get and set
    function getloginid() {
           return $this->loginid;
    }

    function setloginid ($reqloginid) {
           $this->loginid = $reqloginid;
    }

    function getpassword() {
           return $this->password;
    }

    function setpassword ($reqpassword) {
           $this->password = $reqpassword;
    }

    function gettype() {
           return $this->type;
    }

    function settype ($reqtype) {
           $this->type = $reqtype;
    }
    function getinitials() {
           return $this->initials;
    }

    function setinitials ($reqinitials) {
           $this->initials = $reqinitials;
    }
    function getstatus() {
           return $this->status;
    }

    function setstatus ($reqstatus) {
           $this->status = $reqstatus;
    }
    function getuser2contact() {
           return $this->user2contact;
    }

    function setuser2contact ($requser2contact) {
           $this->user2contact = $requser2contact;
    }
    function getuser2employee() {
           return $this->user2employee;
    }

    function setuser2employee ($requser2employee) {
           $this->user2employee = $requser2employee;
    }


    function addUser() {


       $newlogin = new userlogin;
        $newlogin->dbconnect();
        $userid = "'" . $_SESSION['user'] . "'";
        $siteid= "'" . $_SESSION['siteid'] . "'";
        $sql = "select nxtnum from seqnum where tablename = 'user' for update";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crdate = "'" . date("y-m-d") . "'";
        $loginid = "'" . $this->loginid . "'";
        $password = "'" . $this->password . "'";
        $initials = "'" . $this->initials . "'";
        $type = "'" . $this->type . "'";
        $status = "'" . $this->status . "'";

        $user2contact = "'".$this->user2contact."'";
        $user2employee = "'" . $this->user2employee ."'";
        $sql = "select * from user where userid = $loginid";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO user (recnum, userid, password, type, initials, status, user2contact, user2employee,creation_date,siteid)
               VALUES ($objid, $loginid, $password, $type, $initials, $status, $user2contact, $user2employee,curdate(),$siteid)";
// echo $sql;exit;
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to User didn't work. " . mysql_error());
         }
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("User ID " . $loginid . " already exists. ");
            echo "</td></tr></table>";
         }

           $sql = "update seqnum set nxtnum = $objid where tablename = 'user'";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Seqnum insert query for user didn't work. " . mysql_error());

     }

    function updateUser($login) {
        $loginid = "'" . $login . "'";
        $password = "'" . $this->password . "'";
        $initials = "'" . $this->initials . "'";
        $status = "'" . $this->status . "'";
        $sql = "update user set
                                initials = $initials,
                                status = $status
                            where userid = $loginid";

           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to User didn't work. " . mysql_error());
     }

    function deleteUser($login) {
        $loginid = "'" . $login . "'";
        $sql = "delete from user where userid = $loginid";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Update to User didn't work. " . mysql_error());
     }


    function updatePassword($login, $oldpassword, $newpassword)
    {
        $loginid = "'" . $login . "'";
        $opassword = "'" . $oldpassword . "'";
        $npassword = "'" . $newpassword . "'";

        $newlogin = new userlogin;
        $newlogin->dbconnect();

        // Get data
        $query = "select userid,password from user
                   where userid = $loginid and password = $opassword";

        $result = mysql_query($query);
        $myrow = mysql_fetch_row($result);

        // Test to make sure query worked
        if(!$result) die("Please report to Sysadmin. " . mysql_error());

        $actualUserid = "'" . $myrow[0] . "'";
        $actualPassword = "'" . $myrow[1] . "'";

        if($actualPassword == $opassword && $actualUserid == $loginid)
        {
             $sql = "update user set password = $npassword
                          where userid = $loginid";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to User didn't work. " . mysql_error());
        }


        else {
                  die("Incorrect UserName or Password.");

        }
     }


//Function for search/sort coded by Jerry George 30 Dec -04
     function getEmpUsers($cond,$argsort1,$argsort2,$argoffset,$arglimit)
     {
    //  $userid = "'" . $_SESSION['user'] . "'";
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
         $sort1=$argsort1;
         $sort2=$argsort2;
         $siteid = $_SESSION['siteid'];
         $siteval = " and u.siteid = '".$siteid."'";
         $user = $_SESSION['user'];
         if ($user == "sa") {
           $siteval = "";
         }
        if ($sort1 == 'userid') {
           $sortorder1 = 'u.userid';
        }
        if ($sort1 == 'initials') {
           $sortorder1 = 'u.initials';
        }
        if ($sort2 == 'userid') {
           $sortorder2 = 'u.userid';
        }
        if ($sort2 == 'initials') {
           $sortorder2 = 'u.initials';
        }
        if ($sort1 != '' && $sort2 != '') {
            $sortorder = $sortorder1 . "," . $sortorder2;
        }
        else if ($sort1 != '') {
            $sortorder = $sortorder1;
        }
        else if ($sort2 != '') {
            $sortorder = $sortorder2;
        }
        else {$sortorder = 'u.userid';}

        $sql = "select u.userid, u.type, e.phone, e.title, e.role, e.email,
                   u.status, u.initials,c2.name
                  from user u, employee e ,company c2
                  where $wcond and e.employee2company=c2.recnum and
            	u.user2employee = e.recnum  $siteval
            	  ORDER by $sortorder limit $offset, $limit";
        // echo "$sql <br>";
        $result = mysql_query($sql);
        if(!$result) die("GetUsers failed. " . mysql_error());
        return $result;
    }
//Function for pagination coded by Jerry George 30 Dec -04
    function getEmpusersCount($cond,$argoffset,$arglimit)
    {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $siteid = $_SESSION['siteid'];
        $siteval = "u.siteid = '".$siteid."'";
               $sql = "select count(*) as numrows
                       from user u, employee e ,company c2
                       where      $wcond and e.employee2company=c2.recnum and
                                  u.user2employee = e.recnum
                                  and $siteval
                                  limit $offset, $limit";

        $result  = mysql_query($sql) or die('Empusers count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;
    }

//Function for search/sort coded by Jerry George 30 Dec -04
    function getContactUsers($cond,$argsort1,$argsort2,$argoffset,$arglimit)
    {
     // $userid = "'" . $_SESSION['user'] . "'";
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
         $sort1=$argsort1;
         $sort2=$argsort2;
         $siteid = $_SESSION['siteid'];
         $siteval = "u.siteid = '".$siteid."'";
        if ($sort1 == 'userid') {
           $sortorder1 = 'u.userid';
        }
        if ($sort1 == 'initials') {
           $sortorder1 = 'u.initials';
        }
        if ($sort2 == 'userid') {
           $sortorder2 = 'u.userid';
        }
        if ($sort2 == 'initials') {
           $sortorder2 = 'u.initials';
        }
        if ($sort1 != '' && $sort2 != '') {
            $sortorder = $sortorder1 . "," . $sortorder2;
        }
        else if ($sort1 != '') {
            $sortorder = $sortorder1;
        }
        else if ($sort2 != '') {
            $sortorder = $sortorder2;
        }
        else {$sortorder = 'u.userid';}

        $sql = "select u.userid, u.type, c.phone, c.title, c.role, c.email,
                       u.status, u.initials,c2.name
                  from user u, contact c ,company c2
                  where $wcond and c.contact2company=c2.recnum and
	  u.user2contact = c.recnum and $siteval
	  ORDER by $sortorder limit $offset, $limit";
        $result = mysql_query($sql);
        if(!$result) die("GetUsers failed. " . mysql_error());
        return $result;
     }

//Function for pagination coded by Jerry George 30 Dec -04
     function getContactusersCount($cond,$argoffset,$arglimit)
     {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $siteid = $_SESSION['siteid'];
        $siteval = "u.siteid = '".$siteid."'";
               $sql = "select count(*) as numrows
                       from user u, contact c ,company c2
                       where      $wcond and c.contact2company=c2.recnum and
                                  u.user2contact = c.recnum
                                  and $siteval
                                  limit $offset, $limit";

       $result  = mysql_query($sql) or die('Empusers count query failed');
       $row     = mysql_fetch_array($result, MYSQL_ASSOC);
       $numrows = $row['numrows'];
       return $numrows;
     }



     function getUser($userid,$type) {

        $loginid = "'" . $userid . "'";
        if ($type == 'EMPL' || $type == 'MOBILE') {
           $sql = "select u.userid, u.password, u.type, e.title, e.role,
                          u.status, u.initials
                  from user u, employee e
                  where u.user2employee = e.recnum and u.userid = $loginid LOCK IN SHARE MODE";
        }
        if ($type == 'CUST') {
                $sql = "select u.userid, u.password, u.type, c.title, c.role,
                               u.status, u.initials
                  from user u, contact c
                  where u.user2contact = c.recnum and u.userid = $loginid LOCK IN SHARE MODE";
        }
        if ($type == 'VEND') {
                $sql = "select u.userid, u.password, u.type, c.title, c.role,
                               u.status, u.initials
                  from user u, contact c
                  where u.user2contact = c.recnum and u.userid = $loginid LOCK IN SHARE MODE";
        }
        
        if ($type == 'CF') {
           $sql = "select u.userid, u.password, u.type, e.title, e.role,
                          u.status, u.initials
                  from user u, employee e
                  where u.user2employee = e.recnum and u.userid = $loginid LOCK IN SHARE MODE";
        }
        if ($type == 'FF') {
           $sql = "select u.userid, u.password, u.type, e.title, e.role,
                          u.status, u.initials
                  from user u, employee e
                  where u.user2employee = e.recnum and u.userid = $loginid LOCK IN SHARE MODE";
        }
        $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("GetUser failed. " . mysql_error());

        return $result;

     }

 function getLog($cond,$argsort1,$argoffset,$arglimit) {
     // $userid = "'" . $_SESSION['user'] . "'";
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sort1=$argsort1;
        $sql= "select userid, session,date_format(logtime,'%Y %M %d %r'),activity from log where userid $wcond
                  ORDER by $sort1 limit $offset, $limit";
        $result = mysql_query($sql);
        if(!$result) die("GetUsers failed. " . mysql_error());
        return $result;
}

 function getlogCount($cond,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
               $sql = "select count(*) as numrows
                       from  log where userid $wcond
                                   limit $offset, $limit";
        $result  = mysql_query($sql) or die('Empusers count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;
}


    function insertLog($inpuserid, $inpsession, $inpactivity) {

        $userid = "'" . $inpuserid . "'";
        $session = "'" . $inpsession . "'";
        $activity = "'" . $inpactivity . "'";
        $query = "insert into log set userid = $userid,
                                      session = $session,
                                      logtime = now(),
                                      activity = $activity";
        $result = mysql_query($query);
        if(!$result) die("Insert into Log failed. " . mysql_error());
    }

  function userCount() {
        $query = "select count(*) as numrows from activeusers_log";
        $result = mysql_query($query);
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;
}

    function addactiveLog($inpuserid, $inpsession, $inpactivity) {

        $userid = "'" . $inpuserid . "'";
        $session = "'" . $inpsession . "'";
        $activity = "'" . $inpactivity . "'";

        $query = "insert into activeusers_log set userid = $userid,
                                      session = $session,
                                      logtime = now(),
                                      activity = $activity";
        $result = mysql_query($query);
        if(!$result) die("Insert into Log failed. " . mysql_error());
    }

    function deleteactiveLog($inpuserid) {
        $userid = "'" . $inpuserid . "'";
        $query = "delete from activeusers_log where userid = $userid";
        $result = mysql_query($query);
        if(!$result) die("delete from activeusers_log failed. " . mysql_error());
    }

    function isLogged($inpuserid) {
        $userid = "'" . $inpuserid . "'";
        $query = "select * from activeusers_log where userid = $userid";
        $result = mysql_query($query);
        if($myrow = mysql_fetch_row($result))
	return "logged";
        else
	return "notlogged";
}

 function getAllaeEmps()
{
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select u.recnum,u.userid
                  from user u, employee e
                  where u.user2employee = e.recnum and e.role =  'AE'";
        $result = mysql_query($sql);
        if(!$result) die("GetUsers failed. " . mysql_error());
        return $result;
}

  public function GetUsers4Task()
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $siteid = "'".$_SESSION['siteid']."'";

    $sql = "select u.recnum,u.userid,u.type,u.status
            from user u
            where u.status='Active' and
                  u.siteid = $siteid";

    $result = mysql_query($sql);
    if(!$result) die("GetUsers for Task Entry failed. " . mysql_error());
    return $result;
  }

} // End user class definition

