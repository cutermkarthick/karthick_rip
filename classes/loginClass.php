<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: loginClass.php
// Maintains the login class
// Revision: v1.0
//====================================


class userlogin {

    var $dbHost,
        $dbUser,
        $dbName,
        $dbPass,
        $dbLink,
        $dbUserTable;


    // Constructor definition
    function userlogin () {

        // $this->dbHost = 'localhost';
        // $this->dbUser = 'cimtools_nimda';
        // $this->dbName = 'cimtools_fluentwms';
        // $this->dbPass = 'nim%$D45a';
        // $this->dbUserTable = 'user';

        $this->dbHost = 'localhost';
        $this->dbUser = 'root';
        $this->dbName = 'ripple';
        $this->dbPass = '';
        $this->dbUserTable = 'user';
    }

    // Property get and set
    function getdbhost() {
           return $this->dbHost;
    }

    function setdbhost ($reqdbhost) {
           $this->dbHost = $reqdbhost;
    }

    function getdbuser() {
           return $this->dbUser;
    }

    function setdbName ($reqdbname) {
           $this->dbName = $reqdbname;
    }

    function getdbPass () {
           return $this->dbPass;
    }

    function setdbpass ($reqdbpass) {
           $this->dbPass = $reqdbpass;
    }

    function dbconnect () {
        // Added the following line to prevent showing error details
        //error_reporting(0);

        $this->dbLink = mysql_connect($this->dbHost,$this->dbUser,$this->dbPass);

         if(!$this->dbLink) die("Could not connect to database. " . mysql_errno());
         mysql_select_db($this->dbName,$this->dbLink) or die("Could not connect to database");
    }

    function dbdisconnect () {
         mysql_close($this->dbLink);

    }


    function verifyPassword($inpuserName, $inpuserPassword, $siteid) {
        // Remember, by the time this method is called, your main script will have already
        // put the userName and userPassword variables equal to the ones the user typed in

        $username = "'" . $inpuserName . "'";
        $userpwd = "'" . $inpuserPassword . "'";
        // Connect to database

         $this->dbconnect();
        // Select database
        mysql_select_db($this->dbName);

        // Get data
        // $query = "select userid,password,type, user2contact, user2employee from user
        //             where userid = $username and password = md5($userpwd)";
        $query = "select userid,password,type, user2contact, user2employee from user
                   where userid = $username and password = $userpwd";
                   // echo $query;exit;
        $result = mysql_query($query);
        $myrow = mysql_fetch_row($result);

        // Test to make sure query worked
        if(!$result) die("Login failed. " . mysql_error());

        // Get the password from the database
        $actualUserid = $myrow[0];
        $actualPassword = $myrow[1];

        if($myrow[0] != '')
           { }
        else {
                 // die("Incorrect UserName or Password.");
                header("Location:login.php?validate=false");
        }

        $usertype = $myrow[2];
        $usercompany = $myrow[3];
        $employee = $myrow[4];
        
       // echo $employee;

        if ($usertype == 'EMPL' || $usertype == 'MOBILE') {
           $query = "select c.id from employee e, company c
                       where e.recnum = $employee and
                             e.employee2company = c.recnum";
                             // echo $query;
        }

        else {
           $query = "select c.id from contact cont, company c
                       where cont.recnum = $usercompany and
                             cont.contact2company = c.recnum";
                             // echo $query;exit;
        }
        // echo "$query"; exit;
        $result = mysql_query($query);
        $myrow = mysql_fetch_row($result);
        if(!$result) die("Login2 failed. " . mysql_error());


    // echo "usertype $usertype <br>"; exit;
        // Verify that they match
     if ($siteid != $myrow[0]) die("Incorrect Password.");
        return $usertype;
    } // End verifyPassword()


    function getUserRecnum($userName) {

        // Connect to database
         $this->dbconnect();

        // Select database
        mysql_select_db($this->dbName);

        // Get data
        $query = "select recnum from user where userid = \"$userName\"";
        $result = mysql_query($query);
        $myrow = mysql_fetch_row($result);
        $userrecnum = $myrow[0];
        return $userrecnum;
    }

    function getLog() {

        // Connect to database
         $this->dbconnect();

        // Select database
        mysql_select_db($this->dbName);

        // Get data
        $query = "select userid, start_time, end_time from log";
        $result = mysql_query($query);
        if(!$result) die("Access to Log table failed. " . mysql_error());
        return $result;
    }

    function startingPage ($userName)
    {
         $this->dbconnect();

        // Select database
        mysql_select_db($this->dbName);

       // Get type from table user
        $query = "select type, user2employee, user2contact
                    from user where userid = '$userName'";

        $result = mysql_query($query);
        $myrow = mysql_fetch_row($result);


        // Test to make sure query worked
        if(!$result) die("Query didn't work. " . mysql_error());

        // Get type
        $type = $myrow[0];
        $u2e = $myrow[1];
        $u2c = $myrow[2];


        if ($u2e != '') {
           $query = "select role from employee where recnum = '$u2e'";

           $result = mysql_query($query);
           $myrow = mysql_fetch_row($result);

           $role = $myrow[0];

        }
        else if ($u2c != '') {
           $query = "select role from contact where recnum = '$u2c'";
           $result = mysql_query($query);
           $myrow = mysql_fetch_row($result);
           $role = $myrow[0];
        }


        return $role;

    }


  /* this function will be used on every single page, to check the user.
  * if they're not logged in, send them to the login page. This keeps your other
  * pages private. This function can be used anywhere in the directory structure
  * of your site. */

  function checkuser ($userName)
  {

    $loginpage = 'login.php';
    if ( !isset ( $_SESSION["user"] ) )
    {
     header ( "Location: $loginpage" );
    echo "Error";
     }
   }

    function displayUserInfo() {
        echo '<b>User ID: </b>' . $this->dbUser . '<br>';
        echo '<b>User Password: </b>' . $this->dbPass . '<br>';
    } // End displayUserInfo()

} // End User class definition
