<?php
//==============================================
// Author: FSI                                 =
// Date-written = May  27, 2015                =
// Filename:woimport.php                       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =       
//==============================================
@session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'leads_import';




// First include the class definition
include_once('classes/loginClass.php');
include('classes/leadsClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$newlead = new leads;

$submit = $_REQUEST['submit'];
if($submit == 'Submit')
{
	
	$import_text=$_POST['import_text'];

	
	if($import_text!= '')
	{
	  $datearr = split('\*',$import_text);
       $counter=count($datearr)-1;
      
     for($i=0;$i<$counter;$i++)
	{

        $e=$datearr[$i]; 		
		$datearr1 = split('\,',$e);	
	
         $name = trim($datearr1[0]);
         $company_name = $datearr1[1];
         $source = $datearr1[2];
         $title = $datearr1[3];
         $email = $datearr1[4];
         $phone_no = $datearr1[5];
         $industry_segment = $datearr1[6];
         $product_interest = $datearr1[7];
         $city = $datearr1[8];
         $state = $datearr1[9];
         $country = $datearr1[10];
         $zip = $datearr1[11];
         
// echo "<pre>";
// print_r($datearr1);


    $crdate = date("Y-m-d");
  
    $newlead->setsource($source);
	$newlead->setname($name);
	$newlead->settitle($title);
	$newlead->setphone($phone_no);
	$newlead->setemail($email);
	$newlead->setcompany($company_name);
	$newlead->setindustry_segment($industry_segment);
	$newlead->setproduct_interest($product_interest);
	$newlead->setcity($city);
	$newlead->setstate($state);
	$newlead->setzip($zip);
	$newlead->setcountry($country);
   
    $leadsrecnum =  $newlead->addleads();

	
		
        $sql = "commit";
                    $result = mysql_query($sql);
                    if(!$result)
                    {
                         $sql = "rollback";
                         $result = mysql_query($sql);
                         die("Commit failed PO Insert..Please report to Sysadmin. " . mysql_errno());
                    }
	


}
}


header("Location:leadssummary.php");
}

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/master_process.js"></script>

<html>
<head>
<title>Sale Leads Sheet Import Items</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">

<form action='import_salesleads.php' method='POST' enctype='multipart/form-data'>
<table style="table-layout: fixed"  width=60%  align='center' border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#B0C4DE" align='center'><span class="pageheading">
<b>Import Leads(Copy Paste data from exported csv file with * as delimiter for each record
<br>Column titles are - Name,Company,Lead Source,Title , Email, Phone No,Industry Segment,Product Interest,City,State,Country,Zip 
</b>
<a href ="leadssummary.php?masterdatarecnum=<?php echo $masterdatarecnum ?>" ><img name="Image8" border="0" src="images/arrow_left.png" height='25' title="Back To MPS Summary" align='right'></a></td> 
</tr>
<tr>
<td bgcolor="#FFFFFF" align='center'><textarea name="import_text" rows=30 cols=100 value="<?echo $import_text?>"><?echo $import_text?></textarea>
<br/>
<span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=80;"
                     value="Submit" name="submit" onclick="javascript:return check_import()"  >
                    <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=80;"
                     VALUE="Reset" onClick="javascript: putfocus()">
</td>
</table>
</td></tr>
</table>
</td></tr>
</table>
</form>
</body>
</html>
