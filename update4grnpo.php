<?php
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
include('classes/grnclass.php');
$newgrn = new grn;

$result=$newgrn->getgrnpodetails();
echo "Start";
while($myrow=mysql_fetch_row($result))
{
	 echo "Here";
     $resultpo=$newgrn->getrmpoDetails4update($myrow[4],$myrow[1],$myrow[0]);
	 $mypo=mysql_fetch_assoc($resultpo);

     if   ( $mypo['grn_num'] == $myrow[0] )
    {
            	 $newgrn->updatePOli($myrow[1],$myrow[4],$mypo['line_num'] ,
						 $myrow[3],$myrow[5],$myrow[0],$mypo['recnum']);
    }
	else
    {
		         $resultpo=$newgrn->getrmpoDetails4nullgrn($myrow[4],$myrow[1],'');
				 $num = mysql_num_rows($resultpo);
				 $mypo1=mysql_fetch_assoc($resultpo);
                 if   ( $num > 0)
                 {
            	       $newgrn->updatePOli($myrow[1],$myrow[4],$mypo1['line_num'] ,
						 $myrow[3],$myrow[5],$myrow[0],$mypo['recnum']);
                 }
               else
                {
				     $resultpo=$newgrn->getrmpoDetails4nlinenum($myrow[4],$myrow[1],$myrow[2]);
					 $mypo2=mysql_fetch_assoc($resultpo);
					// echo $mypo2['recnum']."--------<br>";
					 if(mysql_num_rows($resultpo)>0)
					 {
					   $newgrn->update_newPOli($myrow[1],$myrow[4],$myrow[2],$myrow[3],$myrow[5],
						    $myrow[0],$mypo2['recnum']);
					 }

                }
    }
}
?>
