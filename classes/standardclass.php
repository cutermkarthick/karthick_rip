<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: quoteClass.php
// Maintains the class for Quotes
// Revision: v1.0
//====================================

include_once('loginClass.php');

class standard {

    var  $name,
         $description,
         $file;

    // Constructor definition
    function standard() {
        $this->name = '';
        $this->description = '';
        $this->file = '';

    }

    // Property get and set
    function getname() {
           return $this->name;
    }

    function setname ($name) {
           $this->name = $name;
    }

    function getdescription() {
           return $this->description;
    }

    function setdescription ($description) {
           $this->description = $description;
    }
    function getfile() {
           return $this->file;
    }

    function setfile ($file) {
           $this->file = $file;
    }

    function addstandard() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'standard' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

         $name = "'" . $this->name . "'";
         $description = "'" . $this->description . "'";
         $file = "'" . $this->file . "'";

        $sql = "select * from standard where name = $name";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        standard
                           (recnum,
                            name,
                            description,
                            file)
                     VALUES
                           ($objid,
                            $name,
                            $description,
                            $file)";
        //echo $sql;
           $result = mysql_query($sql);
           
           $sql = 'commit';
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to standard didn't work..Please report to Sysadmin. " . mysql_error());
         }
    else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Name " . $name . " already exists. ");
         }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'standard'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
        //echo " <br>objid: $objid<br>";
         return $objid;
     }

     function getstandards() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();


           $sql= "select recnum, name, description, file
                    from standard";

       //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }
     
     function getstandard($standardsrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();


           $sql= "select recnum, name, description, file
                    from standard where recnum=$standardsrecnum";

       //echo $sql;
        $result = mysql_query($sql);
        return $result;
     }


     function updatestandard($standardrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

         $name = "'" . $this->name . "'";
         $description = "'" . $this->description . "'";
         $file = "'" . $this->file . "'";

        $sql = "UPDATE standard SET
                     name=$name,
                     description=$description,
                     file=$file
        	   WHERE
                    recnum = $standardrecnum ";
   // echo $sql;
        $result = mysql_query($sql);
        
        $sql = 'commit';
        $result = mysql_query($sql);
        if(!$result) die("final_insp_report update failed...Please report to SysAdmin. " . mysql_error());
        }



} // End quoteclass definition

