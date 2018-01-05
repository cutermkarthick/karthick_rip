<?php
include_once("classes/consumptionClass.php");

$newconsumption = new consumption;

/*$delgrns=$newconsumption->getallgrns4parentgrn();
while($mydelgrn=mysql_fetch_row($delgrns))
{
    echo $mydelgrn[0]."---with PGRN----- $mydelgrn[1]<br>";
    $newconsumption->updateconsumption4parentgrn($mydelgrn[0],$mydelgrn[1]);
   // $deleteresult=$newconsumption->deletegrns4consumption($mydelgrn[0]);
} */
$grnres=$newconsumption->getgrn4conspgrn();
while($mydelgrn=mysql_fetch_row($grnres))
{
    echo $mydelgrn[0]."---with PGRN----- $mydelgrn[1]<br>";
    $newconsumption->updateconsumption4parentgrn($mydelgrn[0],$mydelgrn[1]);
}
?>
