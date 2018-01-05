<?php
//
//==============================================
// Author: FSI                                 =
// Date-modified Nov 8, 2006                   =
// Filename: printvendPart.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Prints Vend parts                           =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'vendPartDetails';
//////session_register('pagename');
$partrecnum=$_REQUEST['partrecnum'];
//////session_register('partrecnum');
// First include the class definition

include('classes/vendPartClass.php');
include('classes/displayClass.php');
$newVend = new vendPart;
$newdisplay = new display;
$result = $newVend->getPartDetails($partrecnum);
$myrow=mysql_fetch_row($result);

?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>

<table width=635border=0>
<tr><td><font style="Arial" size=5 color="#000000"><center><b><A HREF="javascript:window.print()">Vendor Part</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>

<table width=630 border=1 rules=none>
  	<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr bgcolor="#FFFFFF">
            <td  width=25%><span class="labeltext"><p align="left">Part #</p></font></td>
            <td  width=25%><span class="tabletext"><?php echo "$myrow[1]";?></td>
            <td  width=25%><span class="labeltext"><p align="left">Manufacturer Part #</p></font></td>
            <td  width=25%><span class="tabletext"><?php echo "$myrow[2]";?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">DigiKey Part #</p></font></td>
            <td><span class="tabletext"><?php echo "$myrow[3]";?></td>
            <td><span class="labeltext"><p align="left">Serial #</p></font></td>
            <td><span class="tabletext"><?php echo "$myrow[4]";?></td>

        </tr>
            <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Manufacturer</p></font></td>
            <td><span class="tabletext"><?php echo "$myrow[5]";?></td>
            <td><span class="labeltext"><p align="left">Min Qty</p></font></td>
            <td><span class="tabletext"><?php echo "$myrow[7]";?></td>
         </tr>

<?php
	     if ($myrow[9] == 'y')
	     {
	$html=  "<td ><span class=\"labeltext\"><p align=\"left\">Lead Time</p></font></td>
                <td  colspan=3><span class=\"tabletext\">$myrow[8]
	<span class=\"tabletext\">Weeks&nbsp
	<input type=\"radio\" disabled name=\"lead_unit\" value=\"yes\" checked>
	<span class=\"tabletext\">Months&nbsp
	<input type=\"radio\" disabled name=\"lead_unit\" value=\"no\"></td>";
	     }
	     else
	     {
	$html=  "<td ><span class=\"labeltext\"><p align=\"left\">Lead Time</p></font></td>
                <td  colspan=3><span class=\"tabletext\">$myrow[8]
 	<span class=\"tabletext\">Weeks&nbsp
	<input type=\"radio\" disabled name=\"lead_unit\" value=\"yes\" >
	<span class=\"tabletext\">Months&nbsp
	<input type=\"radio\" disabled name=\"lead_unit\" value=\"no\" checked></td>";
	     }
?>
        <tr bgcolor="#FFFFFF">
        <?php echo $html;?>
        </tr>
            <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Description</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo "$myrow[10]";?></td>
           </tr>

           <tr bgcolor="#FFFFFF">
            <td width=25%><span class="labeltext"><p align="left">Inventory Count</p></font></td>
            <td colspan=3><span class="tabletext"><?php echo "$myrow[12]";?></td>
           </tr>
            <tr bgcolor="#FFFFFF">
            <td  width=25% ><span class="labeltext"><p align="left">Value</p></font></td>
            <td  width=25%><span class="tabletext"><?php echo "$myrow[11]";?></td>
            <td   width=25%><span class="labeltext">Rate</font></td>
            <td><span class="tabletext">$<?php echo "$myrow[6]";?></td>
          </tr>

           </tr>
            <tr bgcolor="#FFFFFF">
            <td   width=25%><span class="labeltext">Vendor</td>
            <td><span class="tabletext"><?php echo "$myrow[20]";?></td>
            <td   width=25%><span class="labeltext">Type</font></td>
            <td><span class="tabletext"><?php echo "$myrow[15]";?></td>
           </tr>
        <input type="hidden" name="vendrecnum" value="">
     </tr>

     <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">   
 <tr bgcolor="#DDDEDD"><td colspan=6><span class="heading"><center><b>Issues/Receipts Log</b></center></td></tr>

 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="000000">
     <td bgcolor="#EEEFEE"><span class="heading"><b>Date</b></td>
     <td bgcolor="#EEEFEE"><span class="heading"><b>Type</b></td>
     <td bgcolor="#EEEFEE"><span class="heading"><b>Reference Type</b></td>
     <td bgcolor="#EEEFEE"><span class="heading"><b>Reference #</b></td>
     <td bgcolor="#EEEFEE"><span class="heading"><b>Qty</b></td>
     <td bgcolor="#EEEFEE"><span class="heading"><b>Balance</b></td>
     <td bgcolor="#EEEFEE"><span class="heading"><b>Invoice #</b></td>
     <td bgcolor="#EEEFEE"><span class="heading"><b>Invoice Date</b></td>
     <td bgcolor="#EEEFEE"><span class="heading"><b>Issues/Receipts<br>Emp #</b></td>
     <td bgcolor="#EEEFEE"><span class="heading"><b>PRN</b></td>
     <td bgcolor="#EEEFEE"><span class="heading"><b>M/C Name</b></td>
     <td bgcolor="#EEEFEE"><span class="heading"><b>Invoice Value</b></td>
     <td bgcolor="#EEEFEE"><span class="heading"><b>Status</b></td>
     <td bgcolor="#EEEFEE"><span class="heading"><b>Closing Date</b></td>
  </tr>

<?php
$result = $newVend->getInventory($partrecnum);
while ($myrow = mysql_fetch_row($result)) {
if($myrow[2] == "Receipts")
{
       if($myrow[9] != '0000-00-00' && $myrow[9] != '' && $myrow[9] != 'NULL')
            {
              $datearr = split('-', $myrow[9]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $date=date("M j, Y",$x);
            }
            else
            {
               $date = '';
            }
             if($myrow[6] != '0000-00-00' && $myrow[6] != '' && $myrow[6] != 'NULL')
            {
              $datearr = split('-', $myrow[6]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $date1=date("M j, Y",$x);
            }
            else
            {
               $date1= '';
            }

          

            // Added for po2Wo link enhancement on Dec 20
        
            printf('<td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td></tr>',
                      $date,$myrow[2], $myrow[5],$myrow[4],$myrow[3],$myrow[8],$myrow[7],$date1,$myrow[10],$myrow[12],$myrow[13],$myrow[11],'','','');
  
        }
    

}

?>

<?php
            $result = $newVend->getInventory($partrecnum);
             while ($myrow = mysql_fetch_row($result))
              {

if($myrow[2] == "Issues")
{
        if($myrow[9] != '0000-00-00' && $myrow[9] != '' && $myrow[9] != 'NULL')
            {
              $datearr = split('-', $myrow[9]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $date=date("M j, Y",$x);
            }
            else
            {
               $date = '';
            }
if($myrow[15] != '0000-00-00' && $myrow[15] != '' && $myrow[15] != 'NULL')
            {
              $datearr = split('-', $myrow[15]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $date1=date("M j, Y",$x);
            }
            else
            {
               $date1 = '';
            }
          
        
            // Added for po2Wo link enhancement on Dec 20
        
            printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext"></td>
                      <td bgcolor="#FFFFFF"><span class="tabletext"></td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext"></td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                      <td bgcolor="#FFFFFF"><span class="tabletext">%s</td></tr>',
                     $date,$myrow[2], $myrow[5],$myrow[4],$myrow[3],$myrow[8],$myrow[10],$myrow[12],$myrow[13],$myrow[14],$date1);
        }
}

?>

      </table>
     </table>
    </td>
</tr>
</table>
</body>
</html>
