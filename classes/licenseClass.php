<? 

//====================================
// Author: FSI
// Date-written = May 30, 2005
// Filename:licenseClass.php
// Maintains the class for Vendor Parts
// Revision: v1.0
//====================================

include_once('loginClass.php');

class license{ 

    var $app_name, 
        $maxlicense_num_name,
        $license_reg;
 
    // Constructor definition 

    function license() { 
        $this->app_name = ''; 
        $this->maxlicense_num= '';
        $this->license_reg = '';
        
    } 

    function getapp_name () {
           return $this->app_name;
    }
    function setapp_name ($reqapp_name) {
           $this->app_name = $reqapp_name;
    }

    function getlicense_reg () {
           return $this->license_reg;
    }
    function setlicense_reg ($reqlicense_reg) {
           $this->license_reg = $reqlicense_reg;
    }

    function getmaxlicense_num () {
           return $this->maxlicense_num;
    }
    function setmaxlicense ($reqmaxlicense_num) {
           $this->maxlicense_num = $reqmaxlicense_num;
    }
     
  
function maxLicense()
{
        $query = "select maxlicense_num as max from app_license";
        $result = mysql_query($query); 
        $row     = mysql_fetch_array($result, MYSQL_ASSOC); 
        $max = $row['max']; 
        return $max;

}

} // End Part class definition 


