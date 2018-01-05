<?php
//==============================================
// Author: FSI                                 =
// Date-written = Nov 07, 2013                 =
// Filename: getallemps.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
//==============================================
session_start();
header("Cache-control: private"); 
if ( !isset($_SESSION['user'] ) )
{
   header("Location: login.php");    
}
$userid = $_SESSION['user'];
include('classes/grnclass.php'); 
$newgrn = new grn;   
$crn=$_REQUEST['crn'];
$crn=trim($crn);
$cond=" crn='$crn' ";
$result = $newgrn->getparent_grn($cond);
?>
<span class="tabletext"><select name="parentgrnnum" id="parentgrnnum"  size="1" onchange='getparentrecnum(this)'>
<option selected value=''>Please Specify
<?php 
while ($myrow = mysql_fetch_row($result)) 
{
     printf('<option value=%s|%s|%s>%s',
            $myrow[0],$myrow[1],$myrow[2],$myrow[1]);
}
?>
</select>
