<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: getboarddes.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Popup for selecting board designers         =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

$userid = $_SESSION['user'];

include('classes/arformClass.php');
$newarform = new arform;
$invnum=$_REQUEST['invnum'];
$exrate=$_REQUEST['exchange_rate'];
$companyname=$_REQUEST['companyname'];
$companyname1=$_REQUEST['companyname1'];
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>Invoice Number</title>
</head>
<body onLoad="self.focus()">
</body>
<form action='getInvDet4ar.php' method='post' enctype='multipart/form-data'>

<?php
   $result = $newarform->getinvlidet4ar($invnum);

?>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<table>
<tr><td><span class="pageheading"><b>Invoice</b></td></tr>
<tr><td>
<table style="table-layout: fixed" width=200 border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=5px bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>Invnum</b></td>
		<!--	<td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Currency</b></td>
			<td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Price</b></td>
		    <td width=20% bgcolor="#EEEFEE"><span class="tabletext"><b>Valid From</b></td>
            <td width=20% bgcolor="#EEEFEE"><span class="tabletext"><b>Valid To</b></td>
            <td width=20% bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></td> -->

       </tr>
</table>
<div style="width:250px; height:200; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=200 border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

             <?php
             $user_input=""; $total_amt=0; $qty_tot=0; $tot_amtpayable=0;
                while ($myrow = mysql_fetch_row($result))
                 {

                     $user_input =$myrow[0]."|".$myrow[1]."|".$myrow[2]."|".$myrow[4]."|".$myrow[5]."||" .$user_input;

                   if($companyname == 'MAHINDRA AEROSTRUCTURES PVT. LTD' || $companyname == 'Aerostructures Assemblies India Pvt.Ltd') 
                      {

                       $total_amt  = $myrow[4] ; 
                       $total_amt1 = $myrow[5] ; 
                       
                       }                   
                      else
                      {
                         $total_amt = $myrow[4] ; 
                         $total_amt1 = $myrow[4] ;
                      }  

                   //  $total_amt += $myrow[2];
                     $qty_tot += $myrow[1];


                 }
                 //$pos = stripos( $companyname, "Tara Aerospace Systems Ltd." );
                 //echo $total_amt."----<br>";
                 //echo $category."--**---";
                 if(preg_match("/\Tara Aerospace\b/i",$companyname))
                 {
                    //echo "HERE-----";
                    $tot_ex=round(($total_amt),2);
                 }else 
                 {
                    //echo "HRTRR";
                   $tot_ex=round(($exrate*$total_amt),2);
                 }
                 //echo $tot_ex."<br>";
                 $totamt1= round(($tot_ex*0.05),2);
                 $totamt2= round((($totamt1+ $tot_ex)*0.125),2);
                 $totamt3= round(($totamt2*0.0),2);
                 //$totamt4= round((($totamt1+ $totamt2)*0.03),2);
                 $totamt5= round((($totamt1+ $totamt2+$totamt3+ $tot_ex)*0.04),2);
                 $total_payamt= $totamt1."*".$totamt2."*".$totamt3."*".$totamt5;
                 $tot_amtpayable= $totamt1+$totamt2+$totamt3+$totamt5;
                 
                 $total_amt_word=$newarform->convert_number($total_amt);
           
                 $tot_amtpayable_word=$newarform->convert_number($tot_amtpayable);
                 //echo $total_amt_word."*-*-*-*-".$tot_ex_word."*-*-*-".$tot_amtpayable_word;
                // echo $tot_amtpayable."<br>";

                 if(preg_match("/\Tara Aerospace\b/i",$companyname))
                 {
                    //echo "HERE-----";
                    $tot_ex1=round(($total_amt),2);
                    $tot_ex_word=$newarform->convert_number($tot_ex1);
                 }
                 else if($companyname == 'MAHINDRA AEROSTRUCTURES PVT. LTD' || $companyname ='Aerostructures Assemblies India Pvt.Ltd')
                 {
                  $tot_ex1=round(($exrate*$total_amt1),2);
                  $tot_ex_word=$newarform->convert_number($tot_ex1);
                 }
                 else
                 {
                  $tot_ex1=round(($exrate*$total_amt),2);
                  $tot_ex_word=$newarform->convert_number($tot_ex1);
                 } 

             ?>
                   <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=5px><input type="radio" name="crn"   id="crn" value="<?php echo $user_input ?>"></td>
                   <td width=10px><span class="tabletext"><?php echo $invnum ?>
                   <input type="hidden" size=5  name="tot_amt" id="tot_amt" value="<?php echo $total_amt ?>">
                   <input type="hidden" size=5  name="tot_amt1" id="tot_amt1" value="<?php echo $total_amt1 ?>">                   
                   <input type="hidden" size=5  name="tot_qty" id="tot_qty" value="<?php echo $qty_tot ?>">
                   <input type="hidden" size=5  name="tot_amt_ex" id="tot_amt_ex" value="<?php echo $tot_ex1 ?>">
                   <input type="hidden" size=5  name="tot_pay_amt" id="tot_pay_amt" value="<?php echo $total_payamt ?>">
                   <input type="hidden" size=5  name="tot_payableamt" id="tot_payableamt" value="<?php echo $tot_amtpayable ?>"></td>
                   <input type="hidden" size=5  name="tot_amt_ex_word" id="tot_amt_ex_word" value="<?php echo $tot_ex_word ?>">
                   <input type="hidden" size=5  name="tot_pay_amt_word" id="tot_pay_amt_word" value="<?php echo $total_amt_word ?>">
                   <input type="hidden" size=5  name="tot_payableamt_word" id="tot_payableamt_word" value="<?php echo $tot_amtpayable_word ?>"></td>

            </td>
        </tr>
        </table>
 </div>

<script language=javascript>
function Submitinvoice(etype) {
 var flag=0;
 var user_input;  var tot_amt=0;var tot_qty=0; var tot_amt_ex=0;
 var tot_pay_amt=0; var tot_amtpayable=0;var tot_amt1=0;
if(document.forms[0].crn.length)
{
 for (i=0;i<document.forms[0].crn.length;i++) {
	if (document.forms[0].crn[i].checked) {
		user_input = document.forms[0].crn[i].value;
		flag=1;
	}
}
}
else if(document.forms[0].crn.checked)
{
  user_input = document.forms[0].crn.value;
  flag = 1;
}
tot_amt  = document.forms[0].tot_amt.value;
tot_amt1 = document.forms[0].tot_amt1.value;
tot_qty = document.forms[0].tot_qty.value;
tot_amt_ex = document.forms[0].tot_amt_ex.value;
tot_pay_amt= document.forms[0].tot_pay_amt.value;
tot_amtpayable=document.forms[0].tot_payableamt.value;
tot_amt_ex_word = document.forms[0].tot_amt_ex_word.value;
tot_pay_amt_word= document.forms[0].tot_pay_amt_word.value;
tot_amtpayable_word=document.forms[0].tot_payableamt_word.value;
if(flag == 0)
{
  alert('Please select appropriate CRN before submitting');
  //self.close();
}
window.opener.SetInvoice4pack(user_input,tot_amt,tot_qty,tot_amt_ex,tot_pay_amt,tot_amtpayable,tot_amt_ex_word,tot_amtpayable_word,tot_amt1);
self.close();
}


</script>

<input type=button value="Submit" onclick=" javascript: return Submitinvoice(window.name,'<?php echo $user_input ?>')">
</form>

</html>
