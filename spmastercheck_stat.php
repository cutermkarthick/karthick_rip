<?php
include('classes/spmasterClass.php');
$newspmaster= new spmaster;
$crn_num=$_REQUEST['crn'];
$status=$_REQUEST['status'];
$comprecnum=$_REQUEST['companyrecnum'];
$recnum=$_REQUEST['recnum'];
//echo $recnum."--------".$comprecnum;
$staflag='0';
$result=$newspmaster->getspmasterdet4stat($crn_num,$status,$comprecnum);
$myrow=mysql_fetch_assoc($result);
//{     && $status=='Active'
  if($myrow['crnnum']==$crn_num && $myrow['status']=='Active' && $recnum !=$myrow['recnum'] )
  { $staflag='1';
    echo "<input type=\"hidden\" name=\"spstaflag\" id=\"spstaflag\" value=\"$staflag\">";
    echo "<table border=1><tr><td><font color=#FF0000>";
    die( "Active CRN " . $crn_num . " Already Exists ");
    echo "</td></tr></table>";
  }

//}
 echo "<input type=\"hidden\" name=\"spstaflag\" id=\"spstaflag\" value=\"$staflag\">";
?>
