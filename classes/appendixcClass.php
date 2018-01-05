<?php

include_once('loginClass.php');
class appendixc
{
 var
   $expinvnum,
   $totnumpkgs,
   $create_date,
   $link2customer;

   function appendixc() {

   $this->expinvnum =  '';
   $this->totnumpkgs = '';
   $this->create_date =  '';
   $this->link2customer =  '';

   }

    function setexpinvnum($expinvnum) {
           $this->expinvnum = $expinvnum;
    }

   function settotnumpkgs($totnumpkgs) {
           $this->totnumpkgs = $totnumpkgs;
    }

    function setcreate_date($create_date) {
           $this->create_date = $create_date;
    }

     function setlink2customer($link2customer) {
           $this->link2customer = $link2customer;
    }




     function addAppendixc()
     {
        $sql = "select nxtnum from seqnum where tablename = 'appendixc' for update";
        //echo "$sql";
        $result = mysql_query($sql);
        if(!$result)
                     {
                      $sql = "rollback";
                      $result = mysql_query($sql);
                      die("Seqnum access failed..Please report to Sysadmin. " . mysql_error());
                     }
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
         $expinvnum = "'" . $this->expinvnum . "'";
         $totnumpkgs =  "'" . $this->totnumpkgs . "'";
        $create_date = $this->create_date?"'" . $this->create_date . "'":'0000-00-00';
       $link2customer =$this->link2customer;

           $sql = "INSERT INTO
                        appendixc
                            (
                            recnum,
							exportinvnum,
							totnumpkgs,
							create_date,
                           link2customer)
                            VALUES
                            (
                            $objid,
                            $expinvnum,
							$totnumpkgs,
							$create_date,
                           $link2customer
                           )";
                          //echo $sql;
             $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("Insert to appendixc didn't work..Please report to Sysadmin. " . mysql_error());
                        }


        $sql = "update seqnum set nxtnum = $objid where tablename = 'appendixc'";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result)
                     {
                     //header("Location:errorMessage.php?validate=Inv4");
                     die("Seqnum insert query didn't work..Please report to Sysadmin. " . mysql_error());
                     }
        return $objid;
     }

     function updateAppendixc($recnum)
     {

        $expinvnum = "'" . $this->expinvnum . "'";
         $totnumpkgs =  "'" . $this->totnumpkgs . "'";
        $create_date = $this->create_date?"'" . $this->create_date . "'":'0000-00-00';
       $link2customer =$this->link2customer;

           $sql = "UPDATE appendixc SET
                     		exportinvnum=$expinvnum,
							totnumpkgs=$totnumpkgs,
							create_date=$create_date,
                            modified_date=now(),
                            link2customer=$link2customer
                            where recnum=$recnum";
                           //echo $sql;
             $result = mysql_query($sql);
           // Test to make sure query worked
           if(!$result)
                        {
                        //header("Location:errorMessage.php?validate=Inv2");
                        die("update to appendixc didn't work..Please report to Sysadmin. " . mysql_error());
                        }

     }

     function getappendixc4summary($argoffset,$arglimit) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $offset = $argoffset;
        $limit = $arglimit;
        $sql = "select a.*,c.name
                        from appendixc a ,company c
                        where  c.recnum=a.link2customer
                        order by recnum desc
                        limit $offset,$limit
						 ";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;

     }
     function getappendixc4summarycount($argoffset,$arglimit) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select a.*,c.name
                        from appendixc a ,company c
                        where c.recnum=a.link2customer

						order by recnum ";
        //echo $sql;
        $result = mysql_query($sql);
        return $result;

     }
     
     function getappendixcdetails($recnum) {

        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select a.*
                        from appendixc a
                        where a.recnum= $recnum ";
       // echo $sql;
        $result = mysql_query($sql);
        return $result;

     }
     
      function customeraddress($apprecnum) {
       $newlogin = new userlogin;
       $newlogin->dbconnect();
       $sql = "select c.name, c.id,
               c.baddr1, c.baddr2, c.bcity, c.bstate,c.bzipcode,c.bcountry
               FROM appendixc a, company c
            where c.recnum = a.link2customer
            and   a.recnum = $apprecnum";

       //echo "$sql";
       $result = mysql_query($sql);
       if(!$result) die("Failed to get customer address...Please report to SysAdmin. " . mysql_error());
       return $result;
     }


}
?>
