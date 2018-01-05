<? 
class rfq { 

    var $Id, 
        $Desc, 
        $createDate, 
        $Company,
        $owner;


    // Constructor definition 
    function rfq() { 
        $this->Id = ''; 
        $this->Desc = ''; 
        $this->createDate = ''; 
        $this->owner = '';
    } 
     
    // Property get and set
    function getid() {
           return $this->Id;
    }

    function setid ($reqid) {
           $this->Id = $reqid;
    }

    function getcreatedate() {
           return $this->createDate;
    }

    function setcreatedate ($req_createdate) {
           $this->createDate = $req_createdate;
    }

    function getdesc() {
           return $this->Desc;
    }

    function setdesc ($reqdesc) {
           $this->Desc = $reqdesc;
    }


    function addRFQ() { 
        $db = mysql_connect("localhost", "root");
        mysql_select_db("dci",$db);
        $sql = "select nxtnum from seqnum where tablename = 'rfq'";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crdate = "'" . date("y-m-d") . "'";
        $company = "'" . $this->Company . "'";
        $rfqid = "'" . $this->rfqId . "'";
        $id = "'" . $this->Id . "'";
        $desc = "'" . $this->Desc . "'";
        $excelfile = "'" . $this->excel_file . "'";
        $username = "'" . $_SESSION["user"] . "'";
        $sql = "INSERT INTO rfq (recnum, id, company, descr,owner_userid,creation_date) 
               VALUES ($objid, $id, $company, $desc,$username, $crdate)";
        $result = mysql_query($sql);
        // Test to make sure query worked 
        if(!$result) die("Insert to Quote didn't work. " . mysql_error()); 

        $sql = "update seqnum set nxtnum = $objid where tablename = 'rfq'";
        $result = mysql_query($sql);
                 
        // Test to make sure query worked 
        if(!$result) die("Seqnum insert query didn't work. " . mysql_error()); 

     } 

     function getRFQ() {

        $db = mysql_connect("localhost", "root");
        mysql_select_db("dci",$db);
        $sql = "select rfqid, create_date,company, descr from rfq";
        $result = mysql_query($sql);
//        while ($myrow = mysql_fetch_row($result)) {
//	      printf("<tr><td><a href=%s>%s</a></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
//		$myrow[3],$myrow[0],$myrow[5], $myrow[1],$myrow[2],$myrow[3],$myrow[4]);
//        }
        return $result;

     }

} // End rfqclass definition 


