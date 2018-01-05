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
$partnum = $_REQUEST['partnum'];
$crn = $_REQUEST['cim_refnum'];
$woclassif= $_REQUEST['woclassif'];

include('classes/workorderClass.php');
$newwo = new workorder;
?>

<html>
<head>
  <title>All all POs</title>

<link rel="stylesheet" href="style.css">
</head>
<body onload=self.focus()>

<form>
<br>
Please select Cust PO No</b>
<br>
<?php
$ncflag4crn='0';
   $result = $newwo->getpos($crn,$partnum);
?>

<table style="table-layout: fixed;width:100%" border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=5% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>Cust PO#</b></td>
            <td width=20% bgcolor="#EEEFEE"><span class="tabletext"><b>PO Date</b></td>
            <td width=15% bgcolor="#EEEFEE"><span class="tabletext"><b>Customer</b></td>
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>PO Qty</b></td>

       </tr>

      <!--   <tr>&nbsp</tr>
        <tr>
            <br>
            <td><span class="tabletext"><select name="po" size="1">
             <option value=" " selected>Please Specify -->
             <?php
                 $ncresults=$newwo->getncdetails4crn($crn);
                 //echo $ncresults."in---PO";
                 if($ncresults !='')
                 {  $ncflag4crn='1';

                 }
                 while ($myrow = mysql_fetch_row($result)) {
                  //echo"this".$myrow[11];
				  $resultwoqty =  $newwo->getwoqty4custpo($myrow[0],$myrow[10],$myrow[11]);
                  $myrow4woqty =  mysql_fetch_row($resultwoqty);
                  $totwoqty = $myrow4woqty[0];
                 // echo"tot".$totwoqty;
		// get rej qty by passing ponum and crnnum
                  $reult4rejqty =  $newwo->getrejqty4custpo($myrow[0],$myrow[10],$myrow[11]);
                  $myrow4rejqty =  mysql_fetch_row($reult4rejqty);
                  $rejqty = $myrow4rejqty[0];
                 // echo"rej ".$rejqty;
                  $retqty = $myrow4rejqty[1];
                  $cust_rej=  $myrow4rejqty[2];
                  //echo"rej ".$cust_rej;
		// Cust po balance is soli qty - totwoqty + rejqty
                  $qty = $myrow[2]-$totwoqty+$rejqty+$retqty+$cust_rej;
                 //echo"balance".$qty;
                   $po_2=htmlentities($myrow[0]);
                   $po_4=htmlentities($myrow[3]);
                   $po_5=htmlentities($myrow[4]);
                   $po_6=htmlentities($myrow[5]);
                   $po_7=htmlentities($myrow[6]);
                   $po_8=htmlentities($myrow[7]);
                   $po_9=htmlentities($myrow[8]);
                   $po_10=htmlentities($myrow[2]);
				   ?>
                 
       <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=5%><input type="radio" name="po"  id="po" value=" <?php echo $myrow[11]."|".$po_2."|".$myrow[1]."|".$qty." | ".$po_4 ." | ".$po_5."|".$po_6." | ".$po_7 ." | ".$po_8." | ".$po_9 . "|" . $po_10. "|" . $myrow[11]."|".$myrow[0]."|".$myrow[1]."|".$qty." | ".$myrow[3]." | ".$myrow[4]."|".$myrow[5]." | ".$myrow[6] ." | ".$myrow[7]." | ".$myrow[8]. "|" . $myrow[2]. "|" . $rejqty?>"></td>

        <td width=8% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[0] ?></td>
                          <td width=20%><span class="tabletext"><?php echo $myrow[1] ?></td>
                          <td width=15%><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td width=8%><span class="tabletext"><?php echo $myrow[2] ?></td>

            </td></tr>

             <?php

               
                 }

             ?>
          
            </td>
        </tr>
</table>
<script language=javascript>
function Submitpo(etype,ncflag,ncnum) {
  //alert('hi');
   var flag=0;
 var user_input;
 //alert(document.forms[0].custpo.length);
//alert(user_input);
//alert(ctype);
 // alert(document.forms[0].po.length);
if(document.forms[0].po.length)
{

 for (i=0;i<document.forms[0].po.length;i++) {
  if (document.forms[0].po[i].checked) {
    user_input = document.forms[0].po[i].value;
    // alert(user_input);
    flag=1;
  }
}
}
else if(document.forms[0].po.checked)
{
  user_input = document.forms[0].po.value;
  flag = 1;
}
if(flag == 0)
{
  alert('Please select appropriate PO before submitting');
  self.close();
}
 window.opener.Setpo(document.forms[0].po.value,document.forms[0].po.text,etype,ncflag,ncnum);
   self.close();

/*
 if (ind == 0)
{ alert("Please select a Cust PO");
  return false;
}

  // alert(ncflag);
   window.opener.Setpo(document.forms[0].po[ind].value,document.forms[0].po[ind].text,etype,ncflag,ncnum);
   self.close();*/
}
</script>
<input type=button value="Submit" onclick=" javascript: return Submitpo(window.name,'<?php echo $ncflag4crn ?>','<?php echo $ncresults ?>')">
</form>
</body>
</html>

