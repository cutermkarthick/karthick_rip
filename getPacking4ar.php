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
$newinv = new arform;

?>

<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>Packing List</title>
</head>
<body onLoad="self.focus()">
</body>
<form action='getPacking4ar.php' method='post' enctype='multipart/form-data'>

<?php
   $result = $newinv->getpackingslip();

?>
        <table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<table>
<tr><td><span class="pageheading"><b>Packing List</b></td></tr>
<tr><td>
<table style="table-layout: fixed" width=200 border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=5px bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=10px bgcolor="#EEEFEE"><span class="tabletext"><b>Packing List</b></td>
		<!--	<td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Currency</b></td>
			<td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Price</b></td>
		    <td width=20% bgcolor="#EEEFEE"><span class="tabletext"><b>Valid From</b></td>
            <td width=20% bgcolor="#EEEFEE"><span class="tabletext"><b>Valid To</b></td>
            <td width=20% bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></td> -->

       </tr>
</table>
<div style="width:250px; height:300; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=200 border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

             <?php
                         while ($myrow = mysql_fetch_row($result))
                 {       $user_input="";  $weight="";
                         $resultpli= $newinv->getpackinglidet($myrow[0]);
                         $i=1;
                         //$myrowli= mysql_fetch_row($resultpli) ;
                         while($myrowli= mysql_fetch_row($resultpli))
                         {// echo $myrowli[8]."------".$myrowli[6];
                          $weight= $myrowli[7] . "   " . $myrowli[8]. "||" . $myrowli[6];
                          $user_input =$myrowli[1]."x".$myrowli[2]."x".$myrowli[3] ."|" .$user_input;

                          $i++;
                         }
                         $fianl_arg=$user_input . "*" . $weight;

             ?>
                   <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=5px><input type="radio" name="crn"   id="crn" value="<?php echo $fianl_arg?>"></td>
                   <td width=10px><span class="tabletext"><?php echo $myrow[0] ?></td>


            <?php
                 }

               ?>
            </td>
        </tr>
        </table>
 </div>
<script language=javascript>
function Submitinvoice(etype) {
 var flag=0;
 var user_input;
if(document.forms[0].crn.length)
{
 for (i=0;i<document.forms[0].crn.length;i++) {
	if (document.forms[0].crn[i].checked) {
		user_input = document.forms[0].crn[i].value;
		flag=1;
	}
}
//alert(user_input);
}
else if(document.forms[0].crn.checked)
{
  user_input = document.forms[0].crn.value;
  flag = 1;
}
if(flag == 0)
{
  alert('Please select appropriate CRN before submitting');
  self.close();
}

window.opener.Setpack4ship(user_input);
self.close();
}
</script>

<input type=button value="Submit" onclick=" javascript: return Submitinvoice(window.name)">
</form>

</html>
