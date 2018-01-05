<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: boardwoEntry.php                  =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Allows editing of company details           =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

if (!isset($_SESSION['userrole']))
{
     header ( "Location: login.php" );
}

if ($_SESSION['userrole'] == 'SU'|| $_SESSION['userrole'] == 'SALES' || $_SESSION['userrole'] == 'RU')
{
    $_SESSION['pagename'] = 'editucompany';
}
else
{
    $_SESSION['pagename'] = 'editcompany';
}
//////session_register('pagename');
$dept = $_SESSION['department'];
$page = "Accounts";
// First include the class definition
include('classes/companyClass.php');
include('classes/displayClass.php');
$accountrecnum=$_REQUEST['id'];
$newlogin = new userlogin;
$newlogin->dbconnect();
$newCompany = new company;
$newdisplay = new display;
$result = $newCompany->getAccount($accountrecnum) ;
$myrow = mysql_fetch_row($result);
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/company.js"></script>
<html>
<head>
<title>Edit Accounts</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
    <form action='processAccount.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr>
        			<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        			<td align="right">&nbsp;
       				<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        		 </tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
				<td>
<?php $newdisplay->dispLinks(''); ?>
 <table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr bgcolor="DEDFDE">
	<td width="6"><img src="images/spacer.gif " width="6"></td> -->
 <td bgcolor="#FFFFFF">
 <table width=100% border=0 cellspacing=4  >
	<tr><td>
 <table width=100% border=0>
	<td width="100%"><span class="pageheading"><b>Edit Accounts</b></td>
    <td colspan=20>&nbsp;</td>
	<td bgcolor="#FFFFFF" align="right">
<input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;" onClick="javascript: return ConfirmDelete()" value="Delete" >
    <!-- <input type= "image" name="Delete" src="images/bu-delete.gif" value="Get" onclick="javascript: return ConfirmDelete()"> -->
	</td>
    </table>

  <tr>
<td>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=6>
      <tr bgcolor="#EEEFEE">
            <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
        </tr>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
       <tr bgcolor="#FFFFFF">
       <td height=30><span class="labeltext"><p align="left">Account Id</p></font></td>
        <td  colspan=3><span class="tabletext"><?php echo $myrow[1] ?></td>
        </tr>
            <input type="hidden" name="id" value="<?php echo $myrow[1] ?>">
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Account Name</p></font></td>
            <td><input type="text" name="name" size=30 value="<?php echo $myrow[0] ?>"</td>
            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><input type="text" name="phone" size=30 value="<?php echo $myrow[3] ?>"</td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Website</p></font></td>
            <td><input type="text" name="website" size=30 value="<?php echo $myrow[5] ?>"</td>
            <td><span class="labeltext"><p align="left">Fax</p></font></td>
            <td><input type="text" name="fax" size=30 value="<?php echo $myrow[4] ?>"</td>
        </tr>


         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Ticher Symbol</p></font></td>
            <td><input type="text" name="tsymbol" size=30 value="<?php echo $myrow[7] ?>"</td>
            <td><span class="labeltext"><p align="left">Email</p></font></td>
            <td><input type="text" name="email" size=30 value="<?php echo $myrow[8] ?>"</td>
        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Employees</p></font></td>
            <td><input type="text" name="employees" size=30 value="<?php echo $myrow[9] ?>"</td>
            <td><span class="labeltext"><p align="left">Rating</p></font></td>
            <td><input type="text" name="rating" size=30 value="<?php echo $myrow[10] ?>"</td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Ownership</p></font></td>
            <td><input type="text" name="ownership" size=30 value="<?php echo $myrow[11] ?>"</td>
            <td><span class="labeltext"><p align="left">Annual Revenue</p></font></td>
            <td><input type="text" name="annual_revenue" size=30 value="<?php echo $myrow[12] ?>"</td>        </tr>

          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Industry</p></font></td>
           	<td><span class="labeltext"><input type="text" name="industry" size="15" value="<?php echo $myrow[13]?>">
            <span class="tabletext"><select name="industry1" size="1" width="100" onchange="onSelectindustry()">
            <OPTION selected value=''>--None--</OPTION>
            <OPTION value='Aerospace'>Aerospace</OPTION>
            <OPTION value='RM Suppliers'>RM Suppliers</OPTION>
            <!--<OPTION value='Apparel'>Apparel</OPTION>
            <OPTION value='Banking'>Banking</OPTION>
            <OPTION value='Biotechnology'>Biotechnology</OPTION>
            <OPTION value='Chemicals'>Chemicals</OPTION>
            <OPTION value='Communications'>Communications</OPTION>
            <OPTION value='Construction'>Construction</OPTION>
            <OPTION value='Consulting'>Consulting</OPTION>
            <OPTION value='Education'>Education</OPTION>
            <OPTION value='Electronics'>Electronics</OPTION>
            <OPTION value='Energy'>Energy</OPTION>
            <OPTION value='Engineering'>Engineering</OPTION>
            <OPTION value='Entertainment'>Entertainment</OPTION>
            <OPTION value='Environmental'>Environmental</OPTION>
            <OPTION value='Finance'>Finance</OPTION>
            <OPTION value='Government'>Government</OPTION>
            <OPTION value='Healthcare'>Healthcare</OPTION>
            <OPTION value='Hospitality'>Hospitality</OPTION>
            <OPTION value='Insurance'>Insurance</OPTION>
            <OPTION value='Machinery'>Machinery</OPTION>
            <OPTION value='Manufacturing'>Manufacturing</OPTION>
            <OPTION value='Media'>Media</OPTION>
            <OPTION value='Not For Profit'>Not For Profit</OPTION>
            <OPTION value='Recreation'>Recreation</OPTION>
            <OPTION value='Retail'>Retail</OPTION>
            <OPTION value='Shipping'>Shipping</OPTION>
            <OPTION value='Technology'>Technology</OPTION>
            <OPTION value='Telecommunications'>Telecommunications</OPTION>
            <OPTION value='Transportation'>Transportation</OPTION>
            <OPTION value='Utilities'>Utilities</OPTION> -->
            <OPTION value='Other'>Other</OPTION>
           	</select>
            <td><span class="labeltext"><p align="left">STC Code</p></font></td>
            <td><input type="text" name="stccode" size=30 value="<?php echo $myrow[14] ?>"</td>
        </tr>

        <tr bgcolor="#FFFFFF"  >
            <td><span class="labeltext"><p align="left">Type</p></font></td>
           	<td><span class="labeltext"><input type="text" name="type" size="15" value="<?php echo $myrow[2]?>">
            <span class="tabletext"><select name="type1" size="1" width="100" onchange="onSelecttype()">
            <option value="CUST" selected>CUST
            <option value="HOST">HOST
            <option value="VEND">VEND
           	</select>
		    <td><span class="labeltext"><p align="left">Status</p></font></td>
           	<td><span class="labeltext"><input type="text" name="status" id="status" size="15" value="<?php echo $myrow[33]?>">
			<select name="status1" size="1" width="100" onchange="onSelectstatus()">
            <option value="Active" selected>Active
            <option value="Inactive">Inactive
           	</select>

     	</tr>
        <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Primary Address</b></center></td></tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Address 1</p></font></td>
            <td><input type="text" name="address1" size=30 value="<?php echo $myrow[15] ?>"</td>
            <td><span class="labeltext"><p align="left">Address2</p></font></td>
            <td><input type="text" name="address2" size=30 value="<?php echo $myrow[16] ?>"</td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">City</p></font></td>
            <td><input type="text" name="city" size=30 value="<?php echo $myrow[17] ?>"</td>
            <td><span class="labeltext"><p align="left">State</p></font></td>
            <td><input type="text" name="state" size=30 value="<?php echo $myrow[18] ?>"</td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Zip</p></font></td>
            <td><input type="text" name="zip" size=30 value="<?php echo $myrow[19] ?>"</td>
            <td><span class="labeltext"><p align="left">Country</p></font></td>
            <td><input type="text" name="country" size=30 value="<?php echo $myrow[20] ?>"</td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Lat</p></font></td>
            <td><input type="text" name="lat" id="lat" size=30 value=""</td>
            <td><span class="labeltext"><p align="left">Lon</p></font></td>
            <td><input type="text" name="lon" id="lon" size=30 value=""</td>
        </tr>

        <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Billing Address</b></center></td></tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Address1</p></font></td>
            <td><span class="labeltext"><input type="text" name="baddress1" size=30  value="<?php echo $myrow[21] ?>"></td>
            <td><span class="labeltext"><p align="left">Address2</p></font></td>
            <td><span class="labeltext"><input type="text" name="baddress2" size=30  value="<?php echo $myrow[22] ?>"></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">City</p></font></td>
            <td><span class="labeltext"><input type="text" name="bcity" size=30  value="<?php echo $myrow[23] ?>"></td>
            <td><span class="labeltext"><p align="left">State</p></font></td>
            <td><span class="labeltext"><input type="text" name="bstate" size=30  value="<?php echo $myrow[24] ?>"></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Zip</p></font></td>
            <td><span class="labeltext"><input type="text" name="bzip" size=30  value="<?php echo $myrow[25] ?>"></td>
            <td><span class="labeltext"><p align="left">Country</p></font></td>
            <td><span class="labeltext"><input type="text" name="bcountry" size=30  value="<?php echo $myrow[26] ?>"></td>
        </tr>
         <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>Shipping Address</b></center></td></tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Address1</p></font></td>
            <td><span class="labeltext"><input type="text" name="saddress1" size=30  value="<?php echo $myrow[27] ?>"></td>
            <td><span class="labeltext"><p align="left">Address2</p></font></td>
            <td><span class="labeltext"><input type="text" name="saddress2" size=30  value="<?php echo $myrow[28] ?>"></td>
        </tr>
          <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">City</p></font></td>
            <td><span class="labeltext"><input type="text" name="scity" size=30  value="<?php echo $myrow[29] ?>"></td>
            <td><span class="labeltext"><p align="left">State</p></font></td>
            <td><span class="labeltext"><input type="text" name="sstate" size=30  value="<?php echo $myrow[30] ?>"></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Zip</p></font></td>
            <td><span class="labeltext"><input type="text" name="szip" size=30  value="<?php echo $myrow[30] ?>"></td>
            <td><span class="labeltext"><p align="left">Country</p></font></td>
            <td><span class="labeltext"><input type="text" name="scountry" size=30  value="<?php echo $myrow[31] ?>"></td>
        </tr>
    </table>
             <input type="hidden" name="deleteflag" value="">
		</td>
 	</tr>
	</table>
	</td>
<!-- <td width="6"><img src="images/spacer.gif " width="6"></td>
		</tr>
			<tr bgcolor="DEDFDE">
				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr> -->
		</table>
			<table border = 0 cellpadding=0 cellspacing=0 width=100% >
				<tr>
					<td align=left>
						</td>
					</tr>
				</table>
                <span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: check_req_fields()">
                <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=100;"
                     VALUE="Reset" onclick="javascript: putfocus()">

        
    

    <script>
    
  

        function initMap() {

          var geocoder = new google.maps.Geocoder();
          var add1 = document.forms[0].address1.value;
          var add2 = document.forms[0].address2.value;
          var add3 = document.forms[0].city.value;
          var add4 = document.forms[0].state.value;
          var add5 = document.forms[0].country.value;
          var address = add1 + ", " + add2 + ", " + add3 + ", " + add4 ;
          geocoder.geocode( { 'address': address}, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
              var latitude = results[0].geometry.location.lat();
              var longitude = results[0].geometry.location.lng();
              document.getElementById("lat").value = latitude;
              document.getElementById("lon").value = longitude;
              // alert("lat " + latitude + " lon " + longitude);
            } 
          }); 

          
        }



      </script>
      <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAi4EqtVuQYCRg0rXz51CE4yDxE2ajGG40&callback=initMap">
      </script>



					</FORM>
		</body>
</html>
