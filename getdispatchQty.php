<?
include_once('classes/reportClass.php');
$newreport = new report;
$crn=$_REQUEST['crn'];
?>
<div id="dispatchQty">
 <table width="70px" align="center" style="border:1px solid #000000;" cellpadding=4 cellspacing=2 border=1 rules=all class="stdtable">
 <tr bgcolor="#F5F6F5">
 <thead>
 <td align="center" colspan=4><span class="pageheading"><b>Dispatch Details</b></span></td>
     <td align="center"><a href="javascript:ongethidedetails('<?php echo $crn ?>')"><img src="images/Arrow-double-up.png" alt="Hide Details" border=0></a></td>
 </tr>
 <tr>
 <th class="head0"><span class="tabletext"><b>CofC #</b></th>
 <th class="head1"><span class="tabletext"><b>WO #</b></th>
 <th class="head0"><span class="tabletext"><b>WO Process</b></th>
 <th class="head1"><span class="tabletext"><b>Acc Qty</b></th>
 <th class="head0"><span class="tabletext"><b>Disp Qty</b></th>
</tr>
<?

//echo $crn;
$result1 = $newreport->getallDispatchqty4Details($crn);
while($myrow4disp = mysql_fetch_row($result1))
{
   if ($myrow4disp[3] == '' || $myrow4disp[3] == 'NULL'|| $myrow4disp[3] =='Manufacture Only')
   {
      $woprocess = 'Manufacture Only';
   }
   else
    {
       $woprocess = $myrow4disp[3];
    }
    //if($myrow4disp[4] != $myrow4disp[1])
    //{
?>
    <td valign="top"><span class="tabletext"><?echo $myrow4disp[0];?></td>
    <td><span class="tabletext"><?echo $myrow4disp[2];?></td>
    <td><span class="tabletext"><?echo $woprocess;?></td>
    <td><span class="tabletext"><?echo $myrow4disp[4];?></td>
    <td><span class="tabletext"><?echo $myrow4disp[1];?></td>
    </tr>
<?
    //}
 }
?>
</table>
</div>


