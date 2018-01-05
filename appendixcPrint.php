<?php

// First include the class definition
include_once('classes/loginClass.php');
include('classes/appendixcClass.php');
include('classes/displayClass.php');
$newappendixc = new appendixc;
$newdisplay = new display;
$apprecnum= $_REQUEST['appendixcrecnum'];
$result4app= $newappendixc->getappendixcdetails($apprecnum);
$myappendix=mysql_fetch_assoc($result4app);
$resultadd =$newappendixc->customeraddress($apprecnum);
$myrow1= mysql_fetch_assoc($resultadd);
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
	font-size: 10px;
}
.style14 {font-size: 11; font-weight: bold; }
.style16 {font-size: 11; font-weight: bold; }
.style17 {font-size: 12; font-weight: bold; }
-->
</style>
<head>
<title></title>
</head>


<table border="0" width="100%" bgcolor="#DDDDDD" rules="all" cellspacing="0">

<tr bgcolor="#FFFFFF"><td colspan=4><span class="heading">
<center><b><A HREF="javascript:window.print()">APPENDIX-C1</A></b></center></td></tr>

 <?php

           // echo "$date";
            if($myappendix["create_date"] != '0000-00-00' && $myappendix["create_date"]!= '' && $myappendix["create_date"] != 'NULL')
                {
                    $datearr = split('-', $myappendix["create_date"]);
                    $d=$datearr[2];
                    $m=$datearr[1];
                    $y=$datearr[0];
                    $x=mktime(0,0,0,$m,$d,$y);
                    $create_date=date("M j, Y",$x);
               }
              else
              {
                   $create_date = '';
              }
              ?>
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=0 rule=all bordercolor="#000000">
 <tr bgcolor="#DDDEDD">
    <td colspan=4><span class="heading"><center><b>OFFICE OF THE SUPERINTENDENT OF CENTRAL EXCISE<br>Range Peenya II Division E2<br>Commisionerate Bangalore ll</b></center></td>
        </tr>

         <table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=0 rule=all bordercolor="#000000">

         <tr class="bgcolor2" bordercolor="#CCCCCC">
          <td><span class="style6"><p align="left">DC NO:</p></font></td>
          <td><span class="style6"><p align="left"><b>DC Date</b></p></font></td>
             	</tr>
     			 <tr class="bgcolor2" bordercolor="#CCCCCC">

            		<td><span class="style6"><p align="left"><b>Shipping Bill No:</b></p></font></td>
                       <td><span class="style6"><p align="left"><b>Shipping Date</b></p></font></td>
                   	</tr>

                  <tr class="bgcolor2" bordercolor="#CCCCCC">
              <td><span class="style6"><p align="left">1.Name of EOU:</font></td>
            <td><span class="style6"><b>CIM Tools Pvt. Ltd.</b></td>
            </tr>
            <tr class="bgcolor2" bordercolor="#CCCCCC">
		<td><span class="style6"><p align="left">2.IEC No.(of the EOU):</font></td>
            <td><span class="style6"><b>0797004271</b></td>

            </tr>
            <tr class="bgcolor2" bordercolor="#CCCCCC">
    <td><span class="style6"><p align="left">3.Factory Address:</font></td>
    <td ><span class="style6"><b>#467-469, 4th Phase, Peenya Industrial Area</b></td>

<tr class="bgcolor2" bordercolor="#CCCCCC">

    <td colspan=1></td><td ><span class="style6">Bangalore - 560058, INDIA.</font></td>
            </tr>
     			 <tr class="bgcolor2" bordercolor="#CCCCCC">
                 	<td><span class="style6"><p align="left">4.Date of Examination:</p></font></td>
            		<td colspan=3>
                    </td>
                   </tr>
                    <tr class="bgcolor2" bordercolor="#CCCCCC">
            		<td><span class="style6"><p align="left">5.Name and designation of the examining<br>Officer-Inspector/EO/PO:</p></font></td>
              <td colspan=3>&nbsp;</td>
                  </tr>
                  <tr class="bgcolor2" bordercolor="#CCCCCC" >
            	    <td><span class="style6"><p align="left">6.Name and designation of the supervision<br>Officer-Appraiser/Superintendent:</p></font></td>
            		<td colspan=3><span class="style6">&nbsp;</td>
                    </td>
                  </tr>
                  <tr class="bgcolor2" bordercolor="#CCCCCC" >
            	    <td><span class="style6"><p align="left">7.(a)Name of Commissionerate/Division/Range:</p></font></td>
            		<td colspan=3> <span class="style6">&nbsp;</td>
                    </td>
                  </tr>
                     <tr class="bgcolor2" bordercolor="#CCCCCC">
                    <td><span class="style6"><p align="left"> &nbsp;&nbsp;&nbsp;(b)Location Code:</p></font></td>
            		<td colspan=3> <span class="style6">&nbsp;</td>
                    </td>
                  </tr>
                 <tr class="bgcolor2" bordercolor="#CCCCCC" >
                    <td><span class="style6"><p align="left">8. Particulars of Export Invoice</p></font></td>
            		<td colspan=3 >&nbsp;</td>
                    </td>
                  </tr>
                     <tr class="bgcolor2" bordercolor="#CCCCCC" >
                    <td><span class="style6"><p align="left"> &nbsp;&nbsp;&nbsp;(a)Export Invoice No.:</p></font></td>
            		<td colspan=3><span class="style6"><?php echo $myappendix["exportinvnum"]?></td>
                    </td>
                  </tr>
                     <tr class="bgcolor2" bordercolor="#CCCCCC" >
                    <td><span class="style6"><p align="left"> &nbsp;&nbsp;&nbsp;(b)Total No. of packages:</p></font></td>
            		<td colspan=3><span class="style6"><?php echo $myappendix["totnumpkgs"]?></td>
                    </td>
                  </tr>
                     <tr class="bgcolor2" bordercolor="#CCCCCC">
                    <td><span class="style6"><p align="left"> &nbsp;&nbsp;&nbsp;(c)Name and address of the consignee abroad:</p></font></td>
            		<td colspan=3><span class="style6"><?php echo $myrow1["name"]?></td>
                    <input type="hidden" name="companyrecnum" id ="companyrecnum" value=""></td>
                    </td>
                  </tr>
                   <tr  class="bgcolor2" bordercolor="#CCCCCC">
                   <td colspan=1></td>
                          <td id="ba1" ><span class="style6"><?php echo $myrow1["baddr1"] . "," . $myrow1["baddr2"]?></td>
                      </tr>
                      <tr class="bgcolor2" bordercolor="#CCCCCC">
                      <td colspan=1></td>
                          <td id="ba2"><span class="style6"><?php echo $myrow1["bcity"] . "," . $myrow1["bstate"] . "," . $myrow1["bzipcode"] ?></td>

                      </tr>
                      <tr  class="bgcolor2" bordercolor="#CCCCCC">
                      <td colspan=1></td>
                          <td id="ba3"><span class="style6"><?php echo $myrow1["bcountry"]?></td>
                     </tr>
                     <tr class="bgcolor2" bordercolor="#CCCCCC">
                    <td><span class="style6"><p align="left">9.(a) Is the description of the goods,the Quantity and their value as:</p></font></td>
            		<td colspan=3><span class="style6">Yes/NO</span></td>
                    </td>
                  </tr>
                     <tr class="bgcolor2" bordercolor="#CCCCCC">
                    <td><span class="style6"><p align="left"> &nbsp;&nbsp;&nbsp;(b)Whether sample is drawn for being forwarded to port of export:</p></font></td>
            		<td colspan=3><span class="style6">Yes/NO</span></td>
                    </td>
                  </tr>
                   <tr class="bgcolor2" bordercolor="#CCCCCC" >
                    <td><span class="style6"><p align="left">10.(a) For Non-containerized cargo</p></font></td>
            		<td colspan=3></td>
                    </td>
                  </tr>
                     <tr class="bgcolor2" bordercolor="#CCCCCC" >
                    <td><span class="style6"><p align="left">Nos. of packages</p></font></td>
            		<td colspan=3><span class="style6">Seal Nos</span></td>
                    </td>
                  </tr>
                  <tr class="bgcolor2" bordercolor="#CCCCCC">
                    <td><span class="style6"><p align="left">&nbsp;&nbsp;&nbsp;(b) For Containerized cargo</p></font></td>
            		<td colspan=3></td>
                    </td>
                  </tr>
                  </table>
                 <table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=0 rule=all bordercolor="#000000">
                     <tr class="bgcolor2" bordercolor="#CCCCCC">
                    <td width=25%><span class="style6">Container No.</span></td>
            		<td width=25%><span class="style6">Size</span></td>
            		<td width=25%><span class="style6">Seal No.</span></td>
                    </td>
                  </tr>
                   <tr class="bgcolor2" bordercolor="#CCCCCC">
                    <td width=25%><span class="style6">Signature of Exporter</span></td>
            		<td width=25%><span class="style6">Signature of Examiner/Inspector</span></td>
            		<td width=25%><span class="style6">Signature of Appraiser/Superintendent</span></td>
                    </td>
                  </tr>
                  <tr class="bgcolor2" bordercolor="#CCCCCC">
                 	<td><span class="style6"><p align="left">Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________________</p></font></td>
                    <td><span class="style6"><p align="left">Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________________</p></font></td>
                    <td><span class="style6"><p align="left">Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________________</p></font></td>
                   </tr>
                    <tr class="bgcolor2" bordercolor="#CCCCCC">
            		<td><span class="style6"><p align="left">Designation:______________________</p></font></td>
                   <td><span class="style6"><p align="left">Designation:______________________</p></font></td>
                   <td><span class="style6"><p align="left">Designation:______________________</p></font></td>
                  </tr>
                  <tr class="bgcolor2" bordercolor="#CCCCCC">
            	    <td><span class="style6"><p align="left">Stamp:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________________</p></font></td>
            		<td><span class="style6"><p align="left">Stamp:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________________</p></font></td>
            		<td><span class="style6"><p align="left">Stamp:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______________________</p></font></td>
                    </td>
                  </tr>
                   <tr class="bgcolor2" bordercolor="#CCCCCC">
                    <td><span class="style6"><p align="left">Note:</p></font></td>
            		<td colspan=3></td>
                    </td>
                  </tr>
                  </table>
                    <table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=0 rule=all bordercolor="#000000">
                   <tr class="bgcolor2" bordercolor="#CCCCCC">
                    <td><span class="style6"><p align="left">1.The office supervising the examination should attest Invoice(s) and any other document accompanying this </p></font></td>

                    </td>
                  </tr>
                     <tr class="bgcolor2" bordercolor="#CCCCCC">
                    <td><span class="style6"><p align="left"> 2.* To be filled in by the exporter before filling this documnet at the time goods registration in the export shed.</p></font></td>

                    </td>
                  </tr>
                   <tr class="bgcolor2" bordercolor="#CCCCCC">
                    <td><span class="style6"><p align="left">3.* Revised 6 digit code as assigned by the directorate of S & I,XXYYZZ</p></font></td>

                    </td>
                  </tr>
                  <tr class="bgcolor2" bordercolor="#CCCCCC">
                    <td><span class="style6"><p align="left">Commissionerate </p></font></td>

                    </td>
                  </tr>
                     <tr class="bgcolor2" bordercolor="#CCCCCC">
                    <td><span class="style6"><p align="left"> Division</p></font></td>

                    </td>
                  </tr>
                   <tr class="bgcolor2" bordercolor="#CCCCCC">
                    <td><span class="style6"><p align="left">Range</p></font></td>

                    </td>
                  </tr>
        </table>
</table>
  </td>
 <td width="6"><img src="images/spacer.gif " width="6"></td>
	<tr bgcolor="DEDFDE">
  		<td width="6"><img src="images/box-left-bottom.gif"></td>
		<td><img src="images/spacer.gif " height="6"></td>
		<td width="6"><img src="images/box-right-bottom.gif"></td>
	</tr>
 </table>

</FORM>
</body>
</html>
