<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 10, 2010                 =
// Filename: dnPrint.php                      =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Print Salesorder Details                    =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'cofcDeliveryDetails';
//////session_register('pagename');
$delrecnum = $_REQUEST['delrecnum'];

// First include the class definition

include('classes/dnClass.php');
include('classes/dnliClass.php');
include('classes/displayClass.php');
$newDeliver = new dn;
$newdisplay = new display;
$newLI = new dnli;
$result = $newDeliver->getdeliverDetails($delrecnum);
$myrow = mysql_fetch_row($result);

//Fetch the to address 
$toaddrresult = $newDeliver->getaddress($myrow[2]);
$myrowtoaddr = mysql_fetch_row($toaddrresult);

//Fetch the from address
$fromaddrresult = $newDeliver->getaddress($myrow[3]);
$myrowfromaddr = mysql_fetch_row($fromaddrresult);


?>
<link rel="stylesheet" href="style.css">

<html>
<style type="text/css">
<!--
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.style6 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #000000;
	font-size: 12px;
}
.style14 {font-size: 12; font-weight: bold; }
.style16 {font-size: 16; font-weight: bold; }
-->
</style>
<head>
<title></title>
</head>
  <body>
<table width=100% border=0>
<tr>
<td align="center"><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Delivery Note</A></b></center></td</tr>
</table>
<table width=100%>
<tr>
    <td><img src="images/fsi_logo.png" alt="Fluent soft" width="137" height="35" class="Masthead" /></td>
<tr>
    <td align="center"><span class="heading"><b>Fluentsoft Inc.</b></td>
</tr>
<tr>
    <td align="center"><span class="heading">472 , Keer Plaza, Basaveswaranagar, Bangalore 560079.  INDIA</b></td>
</tr>
<tr>

    <td align="center"><span class="heading">Phone: 91-80-41171382/83   FAX: 91-80-41171381    email:info@fluentsoft.com</b></td>
</tr>
</table>
<table width=100% border=1 cellspacing=0 cellpadding=0>
<tr bordercolor=##777777>
<td>
<table>
<pre>
<b><span class="heading">Sent for treatment To:</b>
<tr><span class="tabletext"><?php echo $myrow[2] ?></tr>
<tr><span class="tabletext"><?php echo $myrowtoaddr[0] ?></tr>
<?php
   if ($myrowtoaddr[1] != '')
   {
     echo '<tr><span class="tabletext"><?php echo $myrowtoaddr[1] ?></tr>';
   }
?>
<tr><span class="tabletext"><?php echo $myrowtoaddr[2] ?></tr>
<tr><span class="tabletext"><?php echo $myrowtoaddr[3] ?></tr>
<tr><span class="tabletext"><?php echo $myrowtoaddr[4] ?></tr>
<tr><span class="tabletext"><?php echo $myrowtoaddr[5] ?></tr>
</table>
</td>
<td>
<table>
<pre>
<b><span class="heading">After treatment deliver To:</b>
<tr><span class="tabletext"><?php echo $myrow[3] ?></tr>
<tr><span class="tabletext"><?php echo $myrowfromaddr[0] ?></tr>
<?php
   if ($myrowtoaddr[1] != '')
   {
     echo '<tr><span class="tabletext"><?php echo $myrowfromaddr[1] ?></tr>';
   }
?>

<tr><span class="tabletext"><?php echo $myrowfromaddr[2] ?></tr>
<tr><span class="tabletext"><?php echo $myrowfromaddr[3] ?></tr>
<tr><span class="tabletext"><?php echo $myrowfromaddr[4] ?></tr>
<tr><span class="tabletext"><?php echo $myrowfromaddr[5] ?></tr>
</table>
</td>
<td>
<table>
<pre>
<?php

              if($myrow[7] != '0000-00-00' && $myrow[7] != '' && $myrow[7] != 'NULL')
              {
                $datearr = split('-', $myrow[7]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $podate=date("M j, Y",$x);
	      }
	      else
              {
                $podate="";
	      }
	      if($myrow[5] != '0000-00-00' && $myrow[5] != '' && $myrow[5] != 'NULL')
              {
                $datearr = split('-', $myrow[5]);
                $d=$datearr[2];
                $m=$datearr[1];
                $y=$datearr[0];
                $x=mktime(0,0,0,$m,$d,$y);
                $deldate=date("M j, Y",$x);
	      }
	      else
              {
                $deldate="";
	      }
?>
<tr><td><span class="labeltext">DN #: <span class="tabletext"><?php echo $myrow[1] ?></td></tr>
<tr><td><span class="labeltext">PO No : <span class="tabletext"><?php echo $myrow[6] ?></td></tr>
<tr><td><span class="labeltext">PO Date : <span class="tabletext"><?php echo $podate ?></td></tr>
<tr><td><span class="labeltext">Delivery Date : <span class="tabletext"><?php echo $deldate ?></td></tr>
</pre>
</table>
</td>
</tr>
</table>
<br>
<table width=100% border=1 cellspacing=0 cellpadding=4 rules="all">
       <tr bordercolor=#777777>
	        <td align="center" width=2%><span class="tabletext"><b>PRN</b></td>
			<td align="center" width=4%><span class="tabletext"><b>PO Ln</b></td>
            <td align="center" width=3%><span class="tabletext"><b>Qty</b></td>
            <td align="center" width=5%><span class="tabletext"><b>WO#</b></td>
            <td align="center" width=9%><span class="tabletext"><b>Untreated<br>Part #</b></td>
            <td align="center" width=9%><span class="tabletext"><b>Treated<br>Part #</b></td>
            <td align="center" width=2%><span class="tabletext"><b>Part Iss</b></td>
            <td align="center" width=3%><span class="tabletext"><b>Drg Iss</b></td>
            <td align="center" width=7%><span class="tabletext"><b>COS</b></td>
            <td align="center" width=4%><span class="tabletext"><b>RM Spec</b></td>
            <td align="center" width=4%><span class="tabletext"><b>GRN</b></td>
			<td align="center" width=4%><span class="tabletext"><b>Batch #</b></td>			
            <td align="center" width=4%><span class="tabletext"><b>Insp<br>Stamp</b></td>
       </tr>

<?php
        
             $i = $i + 1;
             $partiss = wordwrap($myrow["12"], 15, "<br />\n"); 
	     $drgiss = wordwrap($myrow["13"], 15, "<br />\n"); 
	     $cos = wordwrap($myrow["14"], 15, "<br />\n"); 
	     $rmspec = wordwrap($myrow["15"], 15, "<br />\n"); 
             echo "<tr bordercolor=#777777>";
	     echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[4]</td>";
	     echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[8]</td>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[18]</td>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[9]</td>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[10]</td>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[11]</td>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partiss</td>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$drgiss</td>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cos</td>";
             //echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[15]</td>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$rmspec</td>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[16]</td>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow[17]</td>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$inp</td>";         

        while ($i < 4)
        {
             echo "<tr bordercolor=#777777>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
             echo"<td align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";          
             $i++;

        }
        echo "</table><table width=100% border=1 cellspacing=0 cellpadding=0 rules=\"none\">";
        echo "<tr bordercolor=#FFFFFF><td colspan=13><span class=\"tabletext\"><b>Remarks:</b>$cos</td></tr><nobr>";
        echo "<tr bordercolor=#FFFFFF><td valign=top><pre><span class=\"tabletext\">$myrow[21]</pre></td></tr>";
?>
</td>
</tr>
</table>
<br>
<table width=100% cellspacing=0 cellpadding=0 rules="all" border=1>
<tr bordercolor=#CCCCCC>
<td>
<span class="tabletext">
Certified that the whole of the materials and/or parts detailed here in have been<br>
manufactured, tested and inspected and unless otherwise stated above, conform to the<br>
requirements of the appropriate contacts and drawings.<br>
</td>
<td>
<span class="tabletext">
AS9100 C Cert No.: 130952.01<br>
AIR BUS REGISTRATION NUMBER 228169<br>
</td>
</tr>
</table>
<br>
<table width=100% border=0>
<tr rowspan=5 bordercolor=#CCCCCC>
<td>
<table width=75% border=1 rules=none cellspacing=0 cellpadding=0>
<tr bordercolor=#CCCCCC><td>&nbsp</td></tr>
<tr bordercolor=#CCCCCC><td>&nbsp</td></tr>
<tr bordercolor=#CCCCCC><td>&nbsp</td></tr>
<tr bordercolor=#CCCCCC><td>&nbsp</td></tr>
<tr bordercolor=#CCCCCC><td>&nbsp</td></tr>
<tr bordercolor=#CCCCCC7><td><span class="tabletext">Signed:.............................Quality Manager;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbspStamp.........................Date:.......................</td></tr>
<tr bordercolor=#CCCCCC><td>&nbsp</td></tr>
</table>
<?php
   if (preg_match("/Magellan Aerospace/", $myrow[4]))
   {
?>
<td>
<table border=1 cellspacing=0 cellpadding=0 rules=none>
<tr bordercolor=#CCCCCC><td valign="top">
<span class="tabletext">
Mag/OFSPG/0012&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ISS B
<br>
May-08
</td</tr>
<tr bordercolor=#CCCCCC><td>&nbsp</td></tr>
<tr bordercolor=#CCCCCC><td>&nbsp</td></tr>
</table>
<?php
    }
?>
<table border=3 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext"><?php echo $myrow[19] ?></td>
            <td colspan=2><span class="labeltext"><?php echo $myrow[20] ?></td>
            <td colspan=2><span class="labeltext">FLUENTWMS</td>
        </tr>
 
</table>
</table>
</table>
</body>
</html>
