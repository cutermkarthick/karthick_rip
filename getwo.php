<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: worderSummary.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Displays WO Summary for SU                  =
// Modifications History                       =
// Dec 6,04 - Paging Enhancements              =
// Dec20,04 - Wo2Po link enhancements          =
//            Coded By  Jerry George           =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
/*$cond = "c.name like '%'";
$worec='';
$oper='like';
$sort1='wo';
$sort2='company';
$sess=session_id();
if ( isset ( $_REQUEST['scomp'] ) )
{
     $company_match = $_REQUEST['scomp'];
     if ( isset ( $_REQUEST['company_oper'] ) ) {
          $oper = $_REQUEST['company_oper'];
     }
     else {
         $oper = 'like';
     }
     if ($oper == 'like') {
         $scomp = "'" . $_REQUEST['scomp'] . "%" . "'";
     }
     else {
         $scomp = "'" . $_REQUEST['scomp'] . "'";
     }

     $cond = "c.name " . $oper . " " . $scomp;
    
}
else {
     $company_match = '';
}

if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
}

   */

// First include the class definition 

include_once('../classes/userClass.php');
include_once('../classes/loginClass.php');
include('../classes/workOrderClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$username = $_SESSION['user'];
$newworkOrder = new workOrder; 

$offset=0;
$rowsPerPage=-1;

?>

<link rel="stylesheet" href="style.css">


<html>
<head>
<title>Work Order</title>

</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

     <form action='getwo.php' method='post' enctype='multipart/form-data'>

<table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			
<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr><td>
	
	</td></tr>
	<tr>
	<td>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

						
						

						<tr><td>

<!--<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
						
						<tr>
							<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
							
							<td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></td>
							
							<td bgcolor="#FFFFFF" rowspan=2 colspan=4 align="center"><span class="tabletext">
             
<input type="image" name="Submit" src="images/bu-get.gif" value="Get" 
            onclick="javascript: return searchsort_fields()">

<input type="hidden" name="company_oper">
</td>

</tr>

						<tr>
							<td bgcolor="#FFFFFF"><span class="labeltext"><b>Company</b></td>
							<td bgcolor="#FFFFFF"><span class="tabletext"><select name="comp_oper" size="1" width="100">
          						<?php// if($oper=='like'){?>
            						<option selected>like
						<option value>=<?php// }else {?>
             						<option selected>=
						<option value>like<?php// }?>
            						</select>
              			 	</td>
							<td bgcolor="#FFFFFF"><input type="text" name="scomp" size=20 value="<?php// echo $company_match ?>" onkeypress="javascript: return checkenter(event)">
        			 	</td>
        
							<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
							<td bgcolor="#FFFFFF" colspan=3><span class="tabletext"><select name="sort1" size="1" width="100">
				<?php// if($sortl=='wo'){?>
				<option selected>wo
				<option selected>company<?php// }else {?>
				<option selected>company 
				<option selected>wo<?php// }?>
             		         		</select></td>
							
	<input type="hidden" name="sortfld1">
       			
</tr>
</table>   -->
	
</td></tr>
	

<table>


<tr><td><span class="pageheading"><b>List of Work Orders</b></td></tr>

<tr><td>


<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
						
						<tr>
							<td bgcolor="#EEEFEE" width=5><span class="heading"><b>Select</b></td>
							<td bgcolor="#EEEFEE" width=10><span class="heading"><b>WO</b></td>
							<td bgcolor="#EEEFEE" width=30><span class="heading"><b><center>Company</center></b></td>
							<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Designer</center></b></td>
							<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Type</center></b></td>
							<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Cust PO</center></b></td>
							<td bgcolor="#EEEFEE" width=10%><span class="heading"><b>Quote</b></td>
							<td bgcolor="#EEEFEE" width=10%><span class="heading"><b><center>Status</center></b></td>
							
</tr>
</table>
 <div style="overflow: scroll; width: 670px; height: 345px;">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
	   <input type="hidden" name="wonumval">
	   <input type="hidden" name="worecval">
	   <input type="hidden" name="comval">
	   <input type="hidden" name="contval">
	   <input type="hidden" name="emailval">
       <input type="hidden" name="fnameval">

<?php
//$result = $newworkOrder->getWorkOrders4rma($username,$cond,$sort1,$sort2,$offset, $rowsPerPage);
$result = $newworkOrder->getWorkOrders4QA($username,$offset, $rowsPerPage);
 while ($myrow = mysql_fetch_row($result)) {
//$radbx=$myrow[11];
//echo "$myrow[0]";
?>
                      <tr><td rowspan=2 bgcolor="#FFFFFF"   width=5><input type="radio" name="solutions"   value=<?php echo $myrow[0] ;?> onclick="javascript :setvalues(<?php echo "$myrow[11],'$myrow[0]','$myrow[1]','$myrow[12]','$myrow[13]','$myrow[8]'";?>)"></td>
	                      <td rowspan=2 bgcolor="#FFFFFF" width=10><span class="tabletext"><?php echo $myrow[0] ;?></td>
                          <td bgcolor="#FFFFFF" width=30><span class="tabletext"><?php echo $myrow[2] ?></td>
                          <td bgcolor="#FFFFFF" width=20%><span class="tabletext"><?php echo $myrow[13] ?></td>
                          <td bgcolor="#FFFFFF" width=10%><span class="tabletext"><?php echo $myrow[1] ?></td>
                          <td bgcolor="#FFFFFF" width=10%><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td bgcolor="#FFFFFF" width=10%><span class="tabletext"><?php echo $myrow[4] ?></td>
                          <td bgcolor="#FFFFFF" width=10%><span class="tabletext"><?php echo $myrow[5] ?></td></tr>
             <tr><td colspan=9 bgcolor="#FFFFFF"><span class="heading">Description:<span class="tabletext"><?php echo $myrow[12] ?></td></tr>


<?php
    }
?>

</table>
 </div>
<script langauge="javascript">
function setvalues(inpworecnum,inpwonum,inpcomp,inpcont,inpemail,inpfname)
{
var worecnum=inpworecnum;
var wonum=inpwonum;
var comp=inpcomp;
var cont=inpcont;
var email=inpemail;
var inpfname=inpfname;

document.forms[0].worecval.value=worecnum;
document.forms[0].wonumval.value=wonum;
document.forms[0].comval.value=comp;
document.forms[0].contval.value=cont;
document.forms[0].emailval.value=email;
document.forms[0].fnameval.value=inpfname;
}

function SubmitReason(ctype) {

window.opener.SetWoNo(document.forms[0].worecval.value,document.forms[0].wonumval.value,document.forms[0].comval.value,document.forms[0].contval.value,document.forms[0].emailval.value,document.forms[0].fnameval.value);
self.close();}

function searchsort_fields()
{

    var ind = document.forms[0].comp_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    var s2ind = document.forms[0].sort2.selectedIndex;
    document.forms[0].company_oper.value = document.forms[0].comp_oper[ind].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;
    document.forms[0].sortfld2.value = document.forms[0].sort2[s2ind].text;

}
function checkenter(event)
{

    var ind = document.forms[0].comp_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    var s2ind = document.forms[0].sort2.selectedIndex;
    document.forms[0].company_oper.value = document.forms[0].comp_oper[ind].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;
    document.forms[0].sortfld2.value = document.forms[0].sort2[s2ind].text;

}
</script>
<input type=button value="Submit" onclick=" javascript: return SubmitReason(window.name)">
      </FORM>
</td></tr>



					</table>
		</table>


<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
	<td align=left>   


</td>
</tr></table>
</body>
</html>
