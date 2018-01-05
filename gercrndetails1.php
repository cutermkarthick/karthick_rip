<?php
//===================================================
// Author: Fluent Technologies                                
// Date-written: Feb 10, 2009            
// Filename: getcrnDetails.php         
// Copyright of Fluent Technologies, Bangalore,India.            
// Revision: v1.0 CJT                  
//===================================================

include_once('classes/reportClass.php');
$newreport = new report;
$crn=$_REQUEST['crn']; 

  $result = $newreport->getallCRN4Details($crn);
  $result1 = $newreport->getallDispatch4Details($crn);
  $cond="where g.crn='$crn'";
  $result3 = $newreport->getCRNNo($crn,'Regular');
  $result_crn_quar = $newreport->getCRN($crn,'Quarantined');
?>

 <table width="250px" style="border:1px solid #000000;" cellpadding=4 cellspacing=2 border=0 rules=all class="stdtable1">
 <tr bgcolor="#F5F6F5"> 
 <td align="center" colspan=7><span class="pageheading"><b>Details for CRN: <?echo $crn;?></b></td>
 </tr>
 <td valign="top">
 <table width="70px" align="center" style="border:1px solid #000000;" cellpadding=4 cellspacing=2 border=1 rules=all class="stdtable1">
 <tr bgcolor="#F5F6F5">
  <thead>
  <td align="center" colspan=7><span class="pageheading"><b>Work Order Details</b></td>
 </tr>
 <tr>

 <tr  bgcolor="#FFCC00">
 <td class="head0"  align="center"><span class="tabletext"><b>WO #</b></td>
 <td  class="head1" align="center"><span class="tabletext"><b>WO Qty</b></td>
 <td  class="head0" align="center"><span class="tabletext"><b>WO Rej</b></td>
 <td  class="head1" align="center"><span class="tabletext"><b>WO Process</b></td>
 
</tr>

<?

while($myrow = mysql_fetch_row($result))
{
  if ($myrow[2] == '' || $myrow[2] == 'NULL' || $myrow[2] == 'Manufacture Only')
  {
    $woprocess = 'Manufacture Only';

  }
  else 
  {
      $woprocess = $myrow[2];

  }
  if($myrow[2] !='With Treatment')
  {
   if($myrow[3]==''||$myrow[3]==0)
   {
      $rej_qty=0;
   }
   else
   {
     $rej_qty=$myrow[3];
   }
  } else
  {
    $mytreatrej=$newreport->getrejqtydetails($crn,$proc,$myrow[0]);
    //echo $mytreatrej."*--**--*-*-*";
    if($mytreatrej==''||$mytreatrej==0)
   {
      $rej_qty=0;
   }
   else
   {
     $rej_qty=$mytreatrej;
   }
    
  }
?>
 <tr bgcolor="#FFFFFF">  
 <td align="center"><span class="tabletext"><?echo $myrow[0];?></td>
 <td align="center"><span class="tabletext"><?echo $myrow[1];?></td>
 <td align="center"><span class="tabletext"><?echo $rej_qty;?></td>
 <td align="center"><span class="tabletext"><?echo $woprocess;?></td>
 </tr>
<?
}
?>
</table>
</td>

<td valign="top">
 <table width="70px" align="center" style="border:1px solid #000000;" cellpadding=4 cellspacing=2 border=1 rules=all>
 <tr bgcolor="#F5F6F5">
 <thead>
 <td align="center" colspan=7><span class="pageheading"><b>Closed WOs With<br>No/Pending Dispatch</b></td>
 </tr>
 <tr>
 <tr  bgcolor="#FFCC00">
 <td  class="head0" align="center" bgcolor="#EEEFEE"><span class="tabletext"><b>WO #</b></td>
 <td  class="head1" align="center" bgcolor="#EEEFEE"><span class="tabletext"><b>WO Qty</b></td>
 <td   class="head0" align="center" bgcolor="#EEEFEE"><span class="tabletext"><b>WO Process</b></td>
 <td   class="head1" align="center" bgcolor="#EEEFEE"><span class="tabletext"><b>Acc Qty</b></td>
 <td   class="head0" align="center" bgcolor="#EEEFEE"><span class="tabletext"><b>Dispatch Qty</b></td>
</tr>

<?
$result_disp=$newreport->getclosedwo_dispatch($crn);
while($myrow = mysql_fetch_row($result_disp))
{
  if($myrow[1]==''||$myrow[1]==0)
   {
      $qty=0;
   }
   else
   {
     $qty=$myrow[1];
   }
?>
 <tr bgcolor="#FFFFFF">
 <td align="center"><span class="tabletext"><?echo $myrow[0];?></td>
 <td align="center"><span class="tabletext"><?echo $myrow[4];?></td>
 <td align="center"><span class="tabletext"><?echo $myrow[2];?></td>
 <td align="center"><span class="tabletext"><?echo $qty ;?></td>
  <td align="center"><span class="tabletext"><?echo $myrow[3];?></td>
 </tr>
<?
}
?>
</table>
</td>
<td valign="top">
 <table width="70px" align="center" style="border:1px solid #000000;" cellpadding=4 cellspacing=2 border=1 rules=all>
 <tr bgcolor="#F5F6F5">
 <thead>
 <td align="center" colspan=7><span class="pageheading"><b>Used For Assembly</b></td>
 </tr>
 <tr>
 <tr  bgcolor="#FFCC00">
 <td  class="head0" align="center" bgcolor="#EEEFEE"><span class="tabletext"><b>WO #</b></td>
  <td  class="head1" align="center" bgcolor="#EEEFEE"><span class="tabletext"><b>Assy WO #</b></td>
  <td  class="head0" align="center" bgcolor="#EEEFEE"><span class="tabletext"><b>PRN #</b></td>
 <td  class="head1" align="center" bgcolor="#EEEFEE"><span class="tabletext"><b>WO Qty</b></td>
 <td  class="head0" align="center" bgcolor="#EEEFEE"><span class="tabletext"><b>Qty Used<br>for Assy WO</b></td>
</tr>

<?
$result_assywo=$newreport->getwo4assembly($crn);
while($myrow = mysql_fetch_row($result_assywo))
{
  if($myrow[1]==''||$myrow[1]==0)
   {
      $qty=0;
   }
   else
   {
     $qty=$myrow[1];
   }
?>
 <tr bgcolor="#FFFFFF">
 <td align="center"><span class="tabletext"><?echo $myrow[0];?></td>
 <td align="center"><span class="tabletext"><?echo $myrow[6];?></td>
  <td align="center"><span class="tabletext"><?echo $myrow[7];?></td>
 <td align="center"><span class="tabletext"><?echo $qty;?></td>
 <td align="center"><span class="tabletext"><?echo $myrow[5];?></td>
 </tr>
<?
}
?>
</table>
</td>
<td valign='top'>
<div id="dispatchQty">
 <table width="70px" align="center" style="border:1px solid #000000;" cellpadding=4 cellspacing=2 border=1 rules=all>
 <tr bgcolor="#F5F6F5">
 <thead>
 <td align="center" colspan=4><span class="pageheading"><b>Dispatch Details</b></span></td>
 <td align="center"><a href="javascript:ongetdetails('<?php echo $crn ?>')"><img src="images/Arrow-double-down.png" alt="Show Details" border=0></a></td>
 </tr>
 <tr  bgcolor="#FFCC00">
 <td  class="head0" align="center" bgcolor="#EEEFEE"><span class="tabletext"><b>CofC #</b></td>   
 <td class="head1" align="center" bgcolor="#EEEFEE"><span class="tabletext"><b>WO #</b></td>
 <td class="head0" align="center" bgcolor="#EEEFEE"><span class="tabletext"><b>WO Process</b></td>
 <td  class="head1" align="center" bgcolor="#EEEFEE"><span class="tabletext"><b>Acc Qty</b></td> 
 <td  class="head0" align="center" bgcolor="#EEEFEE"><span class="tabletext"><b>Disp Qty</b></td> 
</tr>

<?

//echo$myrow4disp[2]."wo-num----".$qty_wo;
while($myrow4disp = mysql_fetch_row($result1))
{
    //echo$myrow4disp[2]."#######".$myrow4disp[5]."****<br>";
   if ($myrow4disp[3] == '' || $myrow4disp[3] == 'NULL'|| $myrow4disp[3] =='Manufacture Only')
   {
      $woprocess = 'Manufacture Only';
   }
   else
    {
       $woprocess = $myrow4disp[3];
    }

    if($myrow4disp[5] != 0)
    {
      $result_disp_details=$newreport->getDispatchDetails4sum($crn,$myrow4disp[2]);
      while($my_disp=mysql_fetch_row($result_disp_details))
      {
?>
    <tr>
    <td valign="top"><span class="tabletext"><?echo $my_disp[0];?></td>
    <td align="center"><span class="tabletext"><?echo $my_disp[2];?></td>
    <td align="center"><span class="tabletext"><?echo $woprocess;?></td>
    <td align="center"><span class="tabletext"><?echo $my_disp[4];?></td>
    <td align="center"><span class="tabletext"><?echo $my_disp[1];?></td>
    </tr>
<?
}
    }
?>

<?
 }
 ?>

</table>
</div>
</td>

 <td valign='top'>
 <div id="grnQty">
 <table width="70px" align="center" style="border:1px solid #000000;" cellpadding=4 cellspacing=2 border=1 rules=all>
 <tr bgcolor="#F5F6F5">
 <thead>
 <td align="center" colspan=2><span class="pageheading"><b>GRN Details</b></span></td>
 <td align="center"><a href="javascript:ongetgrndetails('<?php echo $crn ?>')"><img src="images/Arrow-double-down.png" border=0 alt="Show Details"></a></td>
 </tr>
 <tr  bgcolor="#FFCC00">
 <td  class="head0" align="center" bgcolor="#EEEFEE"><span class="tabletext"><b>GRN #</b></td>
 <td  class="head1" align="center" bgcolor="#EEEFEE"><span class="tabletext"><b>Qty Make</b></td>
 <td  class="head0" align="center" bgcolor="#EEEFEE"><span class="tabletext"><b>Available <br>Qty</b></td>
 </tr>
 <?
 while($myrow4CRN = mysql_fetch_row($result3))
 {
 $result2 = $newreport->getallGRN4Details($crn,$myrow4CRN[0],$myrow4CRN[1],'Regular');
 while($myrow4grn = mysql_fetch_row($result2))
 {
 
 if($myrow4grn[2]!=0)
    {
 ?>

 <td align="center"><span class="tabletext"><?echo $myrow4CRN[0];?></td>
 <td align="center"><span class="tabletext"><?echo $myrow4grn[1];?></td>
 <td align="center"><span class="tabletext"><?echo $myrow4grn[2];?></td>
 </tr>
 <?
 }
 }
}?>
</table>
</div>
</td>
 <td valign='top'>
 <table width="70px" align="center" style="border:1px solid #000000;" cellpadding=4 cellspacing=2 border=1 rules=all>
 <tr bgcolor="#F5F6F5">
 <thead>
 <td align="center" colspan=7><span class="pageheading"><b>GRN Details<br>(Quarantined)</b></td>
 </tr>
 <tr  bgcolor="#FFCC00">
 <td class="head0" align="center"  bgcolor="#EEEFEE"><span class="tabletext"><b>GRN #</b></td>
 <td  class="head1" align="center" bgcolor="#EEEFEE"><span class="tabletext"><b>Qty Make</b></td>
 <td  class="head0" align="center" bgcolor="#EEEFEE"><span class="tabletext"><b>Available<br>Qty</b></td>
 </tr>
 <?
 while($myrow4CRN_quar = mysql_fetch_row($result_crn_quar))
 {
  $result_grn_quar = $newreport->getallGRN4Details($crn,$myrow4CRN_quar[0],$myrow4CRN_quar[1],'Quarantined');
  while($myrow4grn_quar = mysql_fetch_row($result_grn_quar))
  {
 
   if($myrow4grn_quar[2] !=0)
    {
    ?>
  
     <td align="center"><span class="tabletext"><?echo $myrow4CRN_quar[0];?></td>
     <td align="center"><span class="tabletext"><?echo $myrow4grn_quar[1];?></td>
     <td align="center"><span class="tabletext"><?echo $myrow4grn_quar[2];?></td>
     </tr>
  <?
   }
  }
 }
 ?>
 </table>
 </td></tr> 
 </table> 
 </body>
 </html>
