<?php
// First include the class definition
include('classes/rmmasterClass.php');
$newMD = new rmmaster;
$masterdatarecnum = $_REQUEST['rec_num'];
$crn_num=$_REQUEST['crnnum'];
$spec=$_REQUEST['spec'];
$cur_status=$_REQUEST['rm_status'];
$count=0; $recnum=0;
$result = $newMD->getrm_check($crn_num,$cur_status,$spec);
//echo$myrow["rm_status"]."<br>";
$num_row=mysql_num_rows($result);
//echo $masterdatarecnum."*-*-*-*-*";
while($myrow=mysql_fetch_assoc($result))
{

  if($cur_status=='Active' || $cur_status=='Pending')
  {
    //echo $myrow["recnum"]."*-*-*-*".$myrow["rm_status"]."*/*/*/*".$cur_status;
    if($myrow["crnnum"]==$crn_num && $myrow["rm_altrm"]== $spec && 
		($myrow["rm_status"]=='Active' || $cur_status=='Pending') && $myrow["recnum"]!= $masterdatarecnum)
	 {
               //echo $spec."<br>".$myrow["rm_altrm"]."<br>".$myrow["crnnum"]."<br>".$crn_num;
               $count=1;
               echo "<input type=\"hidden\" name=\"rm_curstat\" id=\"rm_curstat\" value=\"$count\">";
               echo "<table border=1><tr><td><font color=#FF0000>";
               die( $spec . " for CRN " . $crn_num . " Already Exists ");
               echo "</td></tr></table>";

	 }


  }
  else
  {
    echo "<input type=\"hidden\" name=\"rm_curstat\" id=\"rm_curstat\" value=\"$count\">";
  }
}

?>
