<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: contactClass.php
// Maintains the class for Contacts
// Revision: v1.0
//====================================

include_once('loginClass.php');
class contact {

    var $recnum,
        $contactid,
        $salutation,
        $fname,
        $lname,
        $role,
        $title,
        $status,
        $phone,
        $email,
        $address1,
        $address2,
        $city,
        $state,
        $country,
        $zipcode,
        $contact2company;



    // Constructor definition
    function contact() {
        $this->recnum = '';
        $this->contactid = '';
        $this->fname = '';
        $this->lname = '';
        $this->role = '';
        $this->salutation = '';
        $this->title = '';
        $this->status = '';
        $this->phone = '';
        $this->email = '';
        $this->address1 = '';
        $this->address2 = '';
        $this->city = '';
        $this->state = '';
        $this->country = '';
        $this->zipcode = '';
        $this->contact2company = '';
    }

    // Property get and set
    function getcontactid() {
           return $this->contactid;
    }

    function setcontactid ($reqcontactid) {
           $this->contactid = $reqcontactid;
    }

    function getfname() {
           return $this->fname;
    }

    function setfname ($reqfname) {
           $this->fname = $reqfname;
    }
    function getrole() {
           return $this->role;
    }

    function setrole ($reqrole) {
           $this->role = $reqrole;
    }
    function getsalutation() {
           return $this->salutation;
    }

    function setsalutation ($reqsalutation) {
           $this->salutation = $reqsalutation;
    }
    function getlname() {
           return $this->lname;
    }
    function setlname ($reqlname) {
           $this->lname = $reqlname;
    }
    function getstatus () {
           return $this->status;
    }
    function setstatus ($reqstatus) {
           $this->status = $reqstatus;
    }

    function gettitle() {
           return $this->title;
    }
    function settitle ($reqtitle) {
           $this->title = $reqtitle;
    }
    function getemail () {
           return $this->email;
    }
    function setemail ($reqemail) {
           $this->email = $reqemail;
    }
    function setaddress1 ($reqaddress1) {
           $this->address1 = $reqaddress1;
    }
    function getaddress1 () {
           return $this->address1;
    }
    function setaddress2 ($reqaddress2) {
           $this->address2 = $reqaddress2;
    }
    function getaddress2 () {
           return $this->address2;
    }
    function getcity () {
           return $this->city;
    }
    function setcity ($reqcity) {
           $this->city = $reqcity;
    }
    function getstate () {
           return $this->state;
    }
    function setstate ($reqstate) {
           $this->state = $reqstate;
    }
    function getcountry () {
           return $this->country;
    }
    function setcountry ($reqcountry) {
           $this->country = $reqcountry;
    }
    function getzip () {
           return $this->zipcode;
    }
    function setzip ($reqzipcode) {
           $this->zipcode = $reqzipcode;
    }

    function getphone () {
           return $this->phone;
    }
    function setphone ($reqphone) {
           $this->phone = $reqphone;
    }

    function getcontact2company() {
           return $this->contact2company;
    }
    function setcontact2company($reqcontact2company) {
           $this->contact2company = $reqcontact2company;
    }



     function getContact($inpcontactid) {

       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $contactid = "'" . $inpcontactid . "'";
       $sql = "select co.fname, co.lname, co.recnum, co.role,
                      co.contactid, co.title, co.phone, co.email,
                      co.address1, co.address2, co.city, co.state,
                      co.zipcode,co.status, co.country, c.name,
                      co.salutation, c.recnum
                  from contact co, company c
                  where contactid = $contactid and contact2company = c.recnum
                  for update";
       $result = mysql_query($sql);
       return $result;

     }

     function getContact4company($companyrecnum) {

       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $comrecnum = "'" . $companyrecnum . "'";
       $sql = "select fname, lname, recnum, phone,
                      email
                  from contact
                  where contact2company = $comrecnum and
                     status = 'Active'
                  for update ";
       $result = mysql_query($sql);
       return $result;

     }

    function getAllContacts()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select c1.fname, c1.lname, c1.recnum, c1.role,
                      c1.contactid, c1.title, c1.phone, c1.email,
                      c1.address1, c1.address2, c1.city, c1.state,
                      c1.zipcode,c1.status, c2.name
               from contact c1, company c2
               where c1.contact2company = c2.recnum and
                     c1.status = 'Active'";
       $result = mysql_query($sql);
       return $result;

    }
//Function for search/sort coded by Jerry George 30 Dec -04
    function getContacts4sa($cond,$argsort1,$argoffset,$arglimit)
    {
       $wcond = $cond;
       $offset = $argoffset;
       $limit = $arglimit;
       $sortorder=$argsort1;
       $siteid = $_SESSION['siteid'];
      $siteval = "c1.siteid = '".$siteid."'";
       if($sortorder=='')
           $sortorder="c2.name";
       $sql = "select c1.fname, c1.lname, c1.recnum, c1.role,
                      c1.contactid cid, c1.title, c1.phone, c1.email,
                      c1.address1, c1.address2, c1.city, c1.state,
                      c1.zipcode,c1.status, c2.name,c2.type
               from contact c1, company c2
               where  $wcond  and c1.contact2company = c2.recnum
                              and $siteval
                ORDER by $sortorder limit $offset, $limit";
       $result = mysql_query($sql);
       return $result;

     }

//Function for pagination coded by Jerry George 30 Dec -04

    function getcontCount($cond,$argoffset,$arglimit)
    {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $siteid = $_SESSION['siteid'];
        $siteval = "c1.siteid = '".$siteid."'";
        $sql = "select count(*) as numrows
                                      from contact c1, company c2
               where  $wcond  and c1.contact2company = c2.recnum and $siteval  limit $offset, $limit";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $result  = mysql_query($sql) or die('Emp count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;
    }


    function addContact() {
        $userid = "'" . $_SESSION['user'] . "'";
        $sql = "select nxtnum from seqnum where tablename = 'contact' for update";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crdate = "'" . date("y-m-d") . "'";
        $contactid = "'" . "C" . $objid . "'";
        $status = "'" . $this->status . "'";
        $fname = "'" . $this->fname . "'";
        $lname = "'" . $this->lname . "'";
        $salutation = "'" . $this->salutation . "'";
        $role = "'" . $this->role . "'";
        $title = "'" . $this->title . "'";
        $phone = "'" . $this->phone . "'";
        $email = "'" . $this->email . "'";
        $state = "'" . $this->state . "'";
        $zipcode = "'" . $this->zipcode . "'";
        $country = "'" . $this->country . "'";
        $address1 = "'" . $this->address1 . "'";
        $address2 = "'" . $this->address2 . "'";
        $city = "'" . $this->city . "'";
        $state = "'" . $this->state . "'";
        $zipcode = "'" . $this->zipcode . "'";
        $country = "'" . $this->country . "'";
        $siteid = "'" . $_SESSION['siteid']. "'";
        $contact2company = $this->contact2company;
        $sql = "select * from contact where contactid = $contactid";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO contact
                     (recnum, contactid, salutation, fname, lname,
                      role, title, phone, email,
                      address1, address2, city, state, zipcode,
                      country, status, contact2company,create_date,siteid)
                   VALUES ($objid, $contactid, $salutation, $fname, $lname,
                          $role, $title, $phone, $email,
                          $address1, $address2, $city, $state, $zipcode,
                          $country, $status, $contact2company,$crdate,$siteid)";

           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to Contact didn't work. " . mysql_error());
         }
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Contact ID " . $contactid . " already exists. ");
            echo "</td></tr></table>";
         }

           $sql = "update seqnum set nxtnum = $objid where tablename = 'contact'";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Seqnum insert query for contact didn't work. " . mysql_error());

     }

    function updateContact($inpcontactid) {
        $userid = "'" . $_SESSION['user'] . "'";
        $contactid = "'" . $inpcontactid . "'";
        $status = "'" . $this->status . "'";
        $fname = "'" . $this->fname . "'";
        $lname = "'" . $this->lname . "'";
        $salutation = "'" . $this->salutation . "'";
        $role = "'" . $this->role . "'";
        $title = "'" . $this->title . "'";
        $phone = "'" . $this->phone . "'";
        $email = "'" . $this->email . "'";
        $state = "'" . $this->state . "'";
        $zipcode = "'" . $this->zipcode . "'";
        $country = "'" . $this->country . "'";
        $address1 = "'" . $this->address1 . "'";
        $address2 = "'" . $this->address2 . "'";
        $city = "'" . $this->city . "'";
        $state = "'" . $this->state . "'";
        $zipcode = "'" . $this->zipcode . "'";
        $country = "'" . $this->country . "'";

        $contact2company = $this->contact2company;

        $sql = "update contact set
                                fname = $fname,
                                lname = $lname,
                                salutation = $salutation,
                                role = $role,
                                status = $status,
                                title = $title,
                                phone = $phone,
                                email = $email,
                                address1 = $address1,
                                address2 = $address2,
                                city = $city,
                                state = $state,
                                zipcode = $zipcode,
                                country = $country,
                                contact2company = $contact2company
                        where contactid = $contactid";

           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Update to Contact didn't work. " . mysql_error());
     }

 //Function for deleting a perticular contact

     function deleteContact($contactid) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from contact where contactid = '$contactid' ";
        $result = mysql_query($sql);
        if(!$result) die("Delete for contact failed...Please report to SysAdmin. " . mysql_error());
      }

} // End Contact class definition