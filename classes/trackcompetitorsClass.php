<?
//====================================
// Author: FSI
// Date-written = July 05, 2006
// Filename: leadsClass.php
// Maintains the class for Leads
// Revision: v1.0  OWT
//====================================

include_once('loginClass.php');

class competitor {

    var $recnum,
        $companyname,
        $revenue,
        $industrysegment,
        $product,
        $notes,
        $guid,
        $phone,
        $email,
        $address1,
        $address2,
        $city,
        $state,
        $zip,
        $country;

    // Constructor definition
   function competitor() {
        $this->recnum = '';
        $this->companyname = '';
        $this->revenue = '';
        $this->industrysegment = '';
        $this->product = '';
        $this->notes = '';
        $this->guid = '';
        $this->phone = '';
        $this->email = '';
        $this->address1 = '';
        $this->address2 = '';
        $this->city = '';
        $this->state = '';
        $this->zip = '';
        $this->country = '';
    }

    // Property get and set

   function getrecnum() {
           return $this->getrecnum;
    }

    function setrecnum ($req_recnum) {
           $this->recnum = $req_recnum;
    }

    function getcompanyname() {
           return $this->companyname;
    }

    function setcompanyname ($reqcompanyname) {
           $this->companyname = $reqcompanyname;
    }

    function getrevenue() {
           return $this->revenue;
    }

    function setrevenue ($reqrevenue) {
           $this->revenue = $reqrevenue;
    }

    function getindustrysegment() {
           return $this->industrysegment;
    }

    function setindustrysegment ($reqindustrysegment) {
           $this->industrysegment = $reqindustrysegment;
    }
    function getproduct() {
           return $this->product;
    }

    function setproduct ($reqproduct) {
           $this->product = $reqproduct;
    }
    function getnotes() {
           return $this->notes;
    }

    function setnotes ($reqnotes) {
           $this->notes = $reqnotes;
    }
    function getguid() {
           return $this->guid;
    }

    function setguid ($reqguid) {
           $this->guid = $reqguid;
    }


    function getaddress1() {
           return $this->address1;
    }

    function setaddress1 ($reqaddress1) {
           $this->address1 = $reqaddress1;
    }
    function getaddress2() {
           return $this->address2;
    }

    function setaddress2 ($reqaddress2) {
           $this->address2 = $reqaddress2;
    }
    function getcity() {
           return $this->city;
    }

    function setcity ($reqcity) {
           $this->city = $reqcity;
    }
    function getstate() {
           return $this->state;
    }

    function setstate ($reqstate) {
           $this->state = $reqstate;
    }
    function getzip() {
           return $this->zip;
    }

    function setzip ($reqzip) {
           $this->zip = $reqzip;
    }
    function getcountry() {
           return $this->country;
    }

    function setcountry ($reqcountry) {
           $this->country = $reqcountry;
    }
    function getemail() {
           return $this->email;
    }

    function setemail ($reqemail) {
           $this->email = $reqemail;
    }
    function getphone() {
           return $this->phone;
    }

    function setphone ($reqphone) {
           $this->phone = $reqphone;
    }



     function addcompetitors(){
       //echo "I am here";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'competitor' for update";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $companyname = "'" . $this->companyname . "'";
        $revenue = "'" . $this->revenue . "'";
        $industrysegment = "'" . $this->industrysegment . "'";
        $phone = "'" . $this->phone . "'";
        $email = "'" . $this->email . "'";
        $product = "'" . $this->product . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $notes = "'" . $this->notes . "'";
        $guid = "'" . $this->guid . "'";
        $address1="'" . $this->address1 . "'";
        $address2 = "'" . $this->address2 . "'";
        $city = "'" . $this->city . "'";
        $state = "'" . $this->state . "'";
        $zip = "'" . $this->zip . "'";
        $country = "'" . $this->country . "'";
        $sql = "select * from competitor where recnum = $objid";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO
                        competitor
                            (
                            recnum,
                            companyname,
                            revenue,
                            industrysegment,
                            product,
                            phone,
                            email,
                            notes,
                            guid,
                            address1,
                            address2,
                            city,
                            state,
                            zip,
                            country
                            )
                    VALUES
                            ( $objid,
                              $companyname,
                              $revenue,
                              $industrysegment,
                              $product,
                              $phone,
                              $email,
                              $notes,
                              $guid,
                              $address1,
                              $address2,
                              $city,
                              $state,
                              $zip,
                              $country)";
       //echo "I am here";
           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to competitor didn't work..Please report to Sysadmin. " . mysql_error());
         }
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("competitor ID " . $objid . " already exists. ");
         }

        $sql = "update seqnum set nxtnum = $objid where tablename = 'competitor'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
//echo " <br>objid: $objid<br>";
return $objid;
     }

     function getcompetitors() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "SELECT
                            recnum,
                            companyname,
                            revenue,
                            industrysegment,
                            product,
                            phone,
                            email,
                            notes,
                            guid,
                            address1,
                            address2,
                            city,
                            state,
                            zip,
                            country
                FROM competitor";
        $result = mysql_query($sql);
//echo "$sql";
        return $result;

     }
     function getcompetitor($competitorrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select
                            recnum,
                            companyname,
                            revenue,
                            industrysegment,
                            product,
                            phone,
                            email,
                            notes,
                            guid,
                            address1,
                            address2,
                            city,
                            state,
                            zip,
                            country
                FROM `competitor`
                  where  competitor.recnum = $competitorrecnum";
        $result = mysql_query($sql);

        return $result;
     }

     function updatecompetitor($competitorrecnum)  {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $companyname = "'" . $this->companyname . "'";
        $revenue = "'" . $this->revenue . "'";
        $industrysegment = "'" . $this->industrysegment . "'";
        $phone = "'" . $this->phone . "'";
        $email = "'" . $this->email . "'";
        $product = "'" . $this->product . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $notes = "'" . $this->notes . "'";
        $guid = "'" . $this->guid . "'";
        $address1 = "'" . $this->address1 . "'";
        $address2 = "'" . $this->address2 . "'";
        $city = "'" . $this->city . "'";
        $state = "'" . $this->state . "'";
        $zip = "'" . $this->zip . "'";
        $country = "'" . $this->country . "'";

        $sql = "UPDATE competitor SET
                    companyname = $companyname,
                    revenue = $revenue,
                    industrysegment = $industrysegment,
            	    product=$product,
            	    phone =$phone ,
            	    email=$email,
            	    notes=$notes,
                    guid = $guid ,
                    address1=$address1,
                    address2= $address2,
                    city= $city,
                    state=$state,
                    zip= $zip,
                    country= $country
        	WHERE
                    recnum = $competitorrecnum";
//echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("competitor update failed...Please report to SysAdmin. " . mysql_error());
        }

     function deletecompetitor($competitorrecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $competitorid = "'" . $competitornum . "'";
        $sql = "delete from competitor where recnum = $competitorrecnum";
        $result = mysql_query($sql);
        if(!$result) die("Delete for competitor failed...Please report to SysAdmin. " . mysql_error());
      }

//Function for search/sort coded by Jerry George 30 Dec -04
function getcompetitorsearch($cond,$argsort1,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;
        $sql = "recnum,
                  source,
                  name,
                  title,
                  phone,
                  email,
                  company,
                  industry_segment,
                  product_interest,
                  primary_lead,
                  rating,
                  comments,
                  creation_date
                from competitor where  $wcond ORDER by $sortorder limit $offset, $limit";
//echo "$sql";
       $result = mysql_query($sql);
       return $result;
}

//Function for pagination coded by Jerry George 30 Dec -04
function getcompetitorCount($cond,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
             $sql = "select count(*) as numrows
                     from competitor where  $wcond limit $offset, $limit";
       $newlogin = new userlogin;
       $newlogin->dbconnect();
//echo "$sql";
$result  = mysql_query($sql) or die('competitor count query failed');
$row     = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];
return $numrows;
}

} // End leads class definition