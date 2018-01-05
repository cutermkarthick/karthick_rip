<?php
include('classes/nc4qaclass.php');

$newnc = new nc4qa;

$wo_num=$_REQUEST['wo_num'];
$stagenum=$_REQUEST['stagenum'];
$opernames='';
if($stagenum == "fi" || $stagenum ==  "final" || $stagenum == "FINAL" || $stagenum == "FI" || $stagenum == "Final" || $stagenum == "Fi")
{
 $stagenum='%';
}
$result=$newnc->getwo_opnames($wo_num,$stagenum);

$resultop = $newnc->geSupnOperNames();
while($myrow=mysql_fetch_row($result))
{
 $opernames=$myrow[0].",".$opernames;
}

if($opernames!="")
{
  echo "<td><textarea name=\"op_name\" id=\"op_name\" rows=3 cols=35 style=\";background-color:#DDDDDD;\" readonly=\"readonly\">$opernames</textarea></td>";
 }
 else
 {  ?>
    <td>
        <select name="op_name" id="op_name">
		<option value="select">Select</option>
		<?php
		while ($myrow1 = mysql_fetch_row($resultop))
		{?>
		<option value="<? echo $myrow1[0]?>">
		<?echo $myrow1[0];?></option>
		<?}?>
        </select>
</td>
<?
 }
?>

