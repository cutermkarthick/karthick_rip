<?
//====================================
// Author: FSI
// Date-written = June 20, 2004
// Filename: companyClass.php
// Maintains/Provides company info.
// Revision: v1.0
//====================================


include_once('loginClass.php');

class company {

    var $recnum,
        $id,
        $name,
        $phone,
        $website,
        $fax,
        $tsymbol,
        $email,
        $employees,
        $rating,
        $ownership,
        $annual_revenue,
        $industry,
        $stccode,
        $type,
        $address1,
        $address2,
        $city,
        $state,
        $zip,
        $country,
        $bill2address,
        $baddress1,
        $baddress2,
        $bcity,
        $bstate,
        $bzip,
        $bcountry,
        $ship2address,
        $saddress1,
        $saddress2,
        $scity,
        $sstate,
        $szip,
        $scountry,
        $company2parent_company,
		$status,
      $user_name,
      $how_created,
      $lat,
      $lon;

    // Constructor definition
    function company() {
        $this->recnum = '';
        $this->id = '';
        $this->name = '';
        $this->phone = '';
        $this->website = '';
        $this->fax = '';
        $this->tsymbol = '';
        $this->employees = '';
        $this->rating = '';
        $this->ownership = '';
        $this->annual_revenue = '';
        $this->industry = '';
        $this->stccode = '';
        $this->type = '';
        $this->address1 = '';
        $this->address2 = '';
        $this->city = '';
        $this->state = '';
        $this->zip = '';
        $this->country = '';
        $this->bill2address = '';
        $this->baddress1 = '';
        $this->baddress2 = '';
        $this->bcity = '';
        $this->bstate = '';
        $this->bzip = '';
        $this->bcountry = '';
        $this->ship2address = '';
        $this->saddress1 = '';
        $this->saddress2 = '';
        $this->scity = '';
        $this->sstate = '';
        $this->szip = '';
        $this->scountry = '';
        $this->company2parent_company = '';
		    $this->status = '';
        $this->user_name = '';
        $this->how_created= '';
        $this->lat= '';
        $this->lon= '';

    }

    // Property get and set
     function getid() {
           return $this->id;
    }

    function setid ($reqid) {
           $this->id = $reqid;
    }
    function getname() {
           return $this->name;
    }

    function setname ($reqname) {
           $this->name = $reqname;
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

    function getwebsite() {
           return $this->website;
    }

    function setwebsite ($reqwebsite) {
           $this->website = $reqwebsite;
    }
    function getfax() {
           return $this->fax;
    }

    function setfax ($reqfax) {
           $this->fax = $reqfax;
    }
    function gettsymbol() {
           return $this->tsymbol;
    }

    function settsymbol ($reqtsymbol) {
           $this->tsymbol = $reqtsymbol;
    }
    function getemployees() {
           return $this->employees;
    }

    function setemployees ($reqemployees) {
           $this->employees = $reqemployees;
    }
    function getrating() {
           return $this->rating;
    }

    function setrating ($reqrating) {
           $this->rating = $reqrating;
    }
    function getownership() {
           return $this->ownership;
    }

    function setownership ($reqownership) {
           $this->ownership = $reqownership;
    }

     function getannual_revenue() {
           return $this->annual_revenue;
    }

    function setannual_revenue ($reqannual_revenue) {
           $this->annual_revenue = $reqannual_revenue;
    }

     function getindustry() {
           return $this->industry;
    }

    function setindustry ($reqindustry) {
           $this->industry = $reqindustry;
    }

     function getstccode() {
           return $this->stccode;
    }

    function setstccode ($reqstccode) {
           $this->stccode = $reqstccode;
    }

     function gettype() {
           return $this->type;
    }

    function settype ($reqtype) {
           $this->type = $reqtype;
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

    function getbaddress1() {
           return $this->baddress1;
    }

    function setbaddress1 ($reqbaddress1) {
           $this->baddress1 = $reqbaddress1;
    }
    function getbaddress2() {
           return $this->baddress2;
    }

    function setbaddress2 ($reqbaddress2) {
           $this->baddress2 = $reqbaddress2;
    }
    function getbcity() {
           return $this->bcity;
    }

    function setbcity ($reqbcity) {
           $this->bcity = $reqbcity;
    }
    function getbstate() {
           return $this->bstate;
    }

    function setbstate ($reqbstate) {
           $this->bstate = $reqbstate;
    }
    function getbzip() {
           return $this->bzip;
    }

    function setbzip ($reqbzip) {
           $this->bzip = $reqbzip;
    }
    function getbcountry() {
           return $this->bcountry;
    }

    function setbcountry ($reqbcountry) {
           $this->bcountry = $reqbcountry;
    }
    function getsaddress1() {
           return $this->saddress1;
    }

    function setsaddress1 ($reqsaddress1) {
           $this->saddress1 = $reqsaddress1;
    }
    function getsaddress2() {
           return $this->saddress2;
    }

    function setsaddress2 ($reqsaddress2) {
           $this->saddress2 = $reqsaddress2;
    }
    function getscity() {
           return $this->scity;
    }

    function setscity ($reqscity) {
           $this->scity = $reqscity;
    }
    function getsstate() {
           return $this->sstate;
    }

    function setsstate ($reqsstate) {
           $this->sstate = $reqsstate;
    }
    function getszip() {
           return $this->szip;
    }

    function setszip ($reqszip) {
           $this->szip = $reqszip;
    }
    function getscountry() {
           return $this->scountry;
    }

    function setscountry ($reqscountry) {
           $this->scountry = $reqscountry;
    }

    function getrecnum() {
           return $this->getrecnum;
    }

    function setrecnum ($req_recnum) {
           $this->recnum = $req_recnum;
    }
    function getstatus() {
           return $this->status;
    }

    function setstatus ($req_status) {
           $this->status = $req_status;
    }

    function getuser_name() {
           return $this->user_name;
    }

    function setuser_name($requser_name) {
           $this->user_name = $requser_name;
    }


  function gethow_created() {
           return $this->how_created;
    }

    function sethow_created ($reqhow_created) {
           $this->how_created = $reqhow_created;
    }
    function setlatitude ($lat) {
           $this->lat = $lat;
    }
     function setlongitude ($lon) {
           $this->lon = $lon;
    }

    function addAccount() {
        $userid = "'" . $_SESSION['user'] . "'";
         $newlogin = new userlogin;
       $newlogin->dbconnect();
        $sql = "select nxtnum from seqnum where tablename = 'company' for update";

        // echo $sql;
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access for Company didn't work. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crdate = "'" . date("y-m-d") . "'";
        $name = "'" . $this->name . "'";
        $id = "'" . "A" . $objid . "'";
        $website = "'" . $this->website . "'";
        $type = "'" . $this->type . "'";
        $phone = "'" . $this->phone . "'";
        $email = "'" . $this->email . "'";
        $fax = "'" . $this->fax . "'";
        $tsymbol = "'" . $this->tsymbol . "'";
        $employees = "'" . $this->employees . "'";
        $ownership = "'" . $this->ownership . "'";
        $annual_revenue = "'" . $this->annual_revenue . "'";
        $industry = "'" . $this->industry . "'";
        $stccode = "'" . $this->stccode . "'";
        $rating = "'" . $this->rating . "'";

        $address1 = "'" . $this->address1 . "'";
        $address2 = "'" . $this->address2 . "'";
        $city = "'" . $this->city . "'";
        $state = "'" . $this->state . "'";
        $zip = "'" . $this->zip . "'";
        $country = "'" . $this->country . "'";

        $baddress1 = "'" . $this->baddress1 . "'";
        $baddress2 = "'" . $this->baddress2 . "'";
        $bcity = "'" . $this->bcity . "'";
        $bstate = "'" . $this->bstate . "'";
        $bzip = "'" . $this->bzip . "'";
        $bcountry = "'" . $this->bcountry . "'";

        $saddress1 = "'" . $this->saddress1 . "'";
        $saddress2 = "'" . $this->saddress2 . "'";
        $scity = "'" . $this->scity . "'";
        $sstate = "'" . $this->sstate . "'";
        $szip = "'" . $this->szip . "'";
        $scountry = "'" . $this->scountry . "'";
        $user_name = "'" . $this->user_name . "'";
        $how_created = "'" . $this->how_created . "'";
        $siteid = "'" . $_SESSION['siteid'] . "'";
        if(isset($_REQUEST['status']))
        {
          $status = "'".$this->status."'";
        }else
        {

          $status = "'Inactive'"; 
        }

          $sql = "select * from company where id = $id";

        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO company
                         (recnum, name, id, type, phone,website,fax,tsymbol,email,
                          employees,rating,ownership,annual_revenue,industry,stccode,
                          addr1, addr2, city, state,zipcode,country,
                          baddr1, baddr2, bcity, bstate,bzipcode,bcountry,
                          saddr1, saddr2, scity, sstate,szipcode,scountry,
                          create_date,status,siteid,user_name,how_created)
                        VALUES
                             ($objid, $name, $id, $type, $phone,$website,$fax,$tsymbol,$email,
                              $employees,$rating,$ownership,$annual_revenue,$industry,$stccode,
                              $address1, $address2, $city, $state, $zip, $country,
                              $baddress1, $baddress2, $bcity, $bstate, $bzip, $bcountry,
                              $saddress1, $saddress2, $scity, $sstate,$szip, $scountry,
                              $crdate, $status,$siteid,$user_name,$how_created
                   )";
                   // echo $sql;exit;

           $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result) die("Insert to Company didn't work. " . mysql_error());
         }
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Account ID " . $userid . " already exists. ");
            echo "</td></tr></table>";
         }
         $sql = "update seqnum set nxtnum = $objid where tablename = 'company'";
         $result = mysql_query($sql);
         // Test to make sure query worked
         if(!$result) die("Seqnum update for Company didn't work. " . mysql_error());


     }

    function updateAccount($accountrecnum)  {
        $userid = "'" . $_SESSION['user'] . "'";
        $name = "'" . $this->name . "'";
        $id = "'" . $accountrecnum . "'";
        $website = "'" . $this->website . "'";
        $type = "'" . $this->type . "'";
        $phone = "'" . $this->phone . "'";
        $email = "'" . $this->email . "'";
        $fax = "'" . $this->fax . "'";
        $tsymbol = "'" . $this->tsymbol . "'";
        $rating = "'" . $this->rating . "'";
        $employees = "'" . $this->employees . "'";
        $ownership = "'" . $this->ownership . "'";
        $annual_revenue = "'" . $this->annual_revenue . "'";
        $industry = "'" . $this->industry . "'";
        $stccode = "'" . $this->stccode . "'";
        $status = $this->status;
        $address1 = "'" . $this->address1 . "'";
        $address2 = "'" . $this->address2 . "'";
        $city = "'" . $this->city . "'";
        $state = "'" . $this->state . "'";
        $zip = "'" . $this->zip . "'";
        $country = "'" . $this->country . "'";
        $baddress1 = "'" . $this->baddress1 . "'";
        $baddress2 = "'" . $this->baddress2 . "'";
        $bcity = "'" . $this->bcity . "'";
        $bstate = "'" . $this->bstate . "'";
        $bzip = "'" . $this->bzip . "'";
        $bcountry = "'" . $this->bcountry . "'";
        $saddress1 = "'" . $this->saddress1 . "'";
        $saddress2 = "'" . $this->saddress2 . "'";
        $scity = "'" . $this->scity . "'";
        $sstate = "'" . $this->sstate . "'";
        $szip = "'" . $this->szip . "'";
        $scountry = "'" . $this->scountry . "'";
        $lat = "'" . $this->lat . "'";
        $lon = "'" . $this->lon . "'";

        $sql = "update company set
                                name = $name,
                                type = $type,
                                phone = $phone,
                                email = $email,
                                website = $website,
                                fax = $fax,
                                tsymbol = $tsymbol,
                                employees = $employees,
                                rating = $rating,
                                ownership = $ownership,
                                annual_revenue = $annual_revenue,
                                industry = $industry,
                                stccode = $stccode,
                                addr1 = $address1,
                                addr2 = $address2,
                                city = $city,
                                state = $state,
                                zipcode = $zip,
                                country = $country,
                                baddr1 = $baddress1,
                                baddr2 = $baddress2,
                                bcity = $bcity,
                                bstate = $bstate,
                                bzipcode = $bzip,
                                bcountry = $bcountry,
                                saddr1 = $saddress1,
                                saddr2 = $saddress2,
                                scity = $scity,
                                sstate = $sstate,
                                szipcode = $szip,
                                scountry = $scountry,
                                lat = $lat,
                                lon = $lon,
								                status = '$status'
                        where id = $id ";
 // echo "$sql";exit;
           $result = mysql_query($sql);
           // Test to make sure query worked
            if(!$result) die("Update to Company didn't work. " . mysql_error());
     }

   function getAccount($accountrecnum) {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $id = "'" . $accountrecnum . "'";
       $sql = "select name, id, type, phone, fax,website,szipcode,tsymbol,email,
               employees,rating,ownership,annual_revenue,industry,stccode,
               addr1, addr2, city, state,zipcode,country,
               baddr1, baddr2, bcity, bstate,bzipcode,bcountry,
               saddr1, saddr2, scity, sstate, szipcode,scountry,status
               FROM `company`
                  where  id = $id";

        //echo "$sql";
       $result = mysql_query($sql);
       if(!$result) die("Access to Accounts info didn't work. " . mysql_error());
       return $result;
     }

//Function for deleting a perticular account

     function deleteAccount($id) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "delete from company where id = '$id' ";
        $result = mysql_query($sql);
        if(!$result) die("Delete for account failed...Please report to SysAdmin. " . mysql_error());
      }


    function getAllHosts($emp_type)
    { 
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $siteid = $_SESSION['siteid'];
       $siteval = "siteid = '".$siteid."'";

       if (!empty($emp_type)){
          if ($emp_type == "Contract") {
            $sql = "select recnum, name from contract";
          }else {
            $sql = "select recnum, name, id, type, phone, city, state, zipcode, country
                 from company where type = 'HOST' and $siteval";
          }
         
       }else {
        
        $sql = "select recnum, name, id, type, phone, city, state, zipcode, country
                 from company where type = 'HOST' and $siteval";
       }

       // $sql = "select recnum, name, id, type, phone, city, state, zipcode, country
       //           from company where type = 'HOST' and $siteval";
       $result = mysql_query($sql);
       if(!$result) die("Access to host company didn't work. " . mysql_error());
       return $result;

    }

    function getAllCustomers()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $siteid = $_SESSION['siteid'];
       $siteval = "siteid = '".$siteid."'";
       $sql = "select recnum, name, id, type, phone, city, state, zipcode, country
                 from company 
				 where type in ('CUST') and status = 'Active'
               and $siteval
				 order by name";
         // echo $sql;
       $result = mysql_query($sql);
       if(!$result) die("Access to Customer companies didn't work. " . mysql_error());
       return $result;

    }
    function getcustomers4billshipadrs()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select  recnum, name,
               baddr1, baddr2, bcity, bstate,bzipcode,bcountry,
               saddr1, saddr2, scity, sstate, szipcode,scountry
                 from company 
				 where type in ('CUST') 
				 order by name";
         // echo $sql;
       $result = mysql_query($sql);
       if(!$result) die("Access to Customer companies didn't work. " . mysql_error());
       return $result;

    }
   function getAllVendors()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $siteid = $_SESSION['siteid'];
       $siteval = "siteid ='".$siteid."'";
       $sql = "select recnum, name, id, type, phone, city, state, zipcode, country
                 from company 
				 where type = 'VEND'  and status = 'Active'
               and $siteval
				 order by name";
         // echo $sql;
       $result = mysql_query($sql);
       if(!$result) die("Access to Vendor companies didn't work. " . mysql_error());
       return $result;

    }

function getAccounts($cond,$argsort1,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sortorder=$argsort1;
        $siteid = $_SESSION['siteid'];
        $siteval = " and siteid = '".$siteid."'";
        $user = $_SESSION['user'];
         if ($user == "sa") {
           $siteval = "";
         }
       $sql = "select id, name,type,industry, phone, city, state, zipcode, country,recnum
                   from company where  $wcond  $siteval ORDER by $sortorder limit $offset, $limit";
//echo "$sql";
       $result = mysql_query($sql);
       return $result;
}

//Function for pagination coded by Jerry George 30 Dec -04
function getcompCount($cond,$argoffset,$arglimit)
{
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $siteid = $_SESSION['siteid'];
        $siteval = "siteid = '".$siteid."'";
             $sql = "select count(*) as numrows
                     from company where  $wcond and $siteval limit $offset, $limit";
       $newlogin = new userlogin;
       $newlogin->dbconnect();
//echo "$sql";
       $result  = mysql_query($sql) or die('Emp count query failed');
       $row     = mysql_fetch_array($result, MYSQL_ASSOC);
       $numrows = $row['numrows'];
       return $numrows;
}

function getCompanies1()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select id, name,type, phone, city, state, zipcode, country
                   from account";
       $result = mysql_query($sql);
       return $result;

    }
    function getCos4contact()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $siteid = $_SESSION['siteid'];
       $siteval = "siteid ='".$siteid."'";
       $sql = "select recnum, name, id, type, phone, city, state, zipcode, country
                 from company where type in ('CUST','VEND') 
                      and $siteval
                 order by name";
                 // echo $sql;
       $result = mysql_query($sql);
       if(!$result) die("Access to Customer companies didn't work. " . mysql_error());
       return $result;

    }
      function getallcustomers4aradrs()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select  recnum, name,
               baddr1, baddr2, bcity, bstate,bzipcode,bcountry,
               saddr1, saddr2, scity, sstate, szipcode,scountry,remarks,terms
                 from company where type in ('CUST') order by name";
       $result = mysql_query($sql);
       if(!$result) die("Access to Customer companies didn't work. " . mysql_error());
       return $result;

    }

     function getcustomers4aradrs()
    {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       // and category='Local Export'
       $sql = "select  recnum, name,
               baddr1, baddr2, bcity, bstate,bzipcode,bcountry,
               saddr1, saddr2, scity, sstate, szipcode,scountry,remarks,terms
                 from company where type in ('CUST') order by name";
                 // echo $sql;exit;
       $result = mysql_query($sql);
       if(!$result) die("Access to Customer companies didn't work. " . mysql_error());
       return $result;

    }
} // End company class definition
