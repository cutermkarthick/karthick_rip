<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: getwo4del.php                         =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Popup for selecting RM                      =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$crn = $_REQUEST['crn'];
$custpotype = $_REQUEST['custpotype'];
$company = $_REQUEST['company'];
//echo "Company is $company";
include('classes/assypoClass.php');
$newassyPo = new assyPo;
$spec_char=array ('$','&','*','\"','\'','+','-','.',':');
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>All CIM for assy po</title>
</head>
<body onload=self.focus()>




<form action='getPartDetails.php' method='post' enctype='multipart/form-data'>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >

<table>
<tr><td><span class="pageheading"><b></b></td></tr>
<tr><td>
<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
       <tr  bgcolor="#FFCC00">
            <td width=5% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td width=6% bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
            <td width=16% bgcolor="#EEEFEE"><span class="tabletext"><b>Pri Part #</b></td>
            <td width=17% bgcolor="#EEEFEE"><span class="tabletext"><b>Sec Part #</b></td>
            <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Part Name</b></td>
            <td width=7% bgcolor="#EEEFEE"><span class="tabletext"><b>Part Iss</b></td>
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>Drg</b></td>
            <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>Mtl Spec</b></td>
            <td width=7% bgcolor="#EEEFEE"><span class="tabletext"><b>Mtl Type</b></td>
            <td width=12% bgcolor="#EEEFEE"><span class="tabletext"><b>COS</b></td>
            <td width=16% bgcolor="#EEEFEE"><span class="tabletext"><b>Price</b></td>
       </tr>
</table>
<div style="width:987px; height:100; overflow:auto;border:" id="dataList">
<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<?php
       $match_flag = 0;
       $match_flag_spec = 0;
       $result = $newassyPo->getPartDetails($crn,$custpotype,$company);
       
         
        while ($myrow = mysql_fetch_row($result)) {


        $priPart =(preg_replace("/[$&*\"\',+-\s\.+\:]/","", $myrow[1]));
        $secPart =(preg_replace("/[$&*\"\',+-\s\.+\:]/","", $myrow[2]));
        $partname =(preg_replace("/[$&*\"\',+-\s\.+\:]/","", $myrow[3]));
        $partiss =(preg_replace("/[$&*\"\',+-\s\.+\:]/","", $myrow[4]));
        $drg =(preg_replace("/[$&*\"\',+-\s\.+\:]/","", $myrow[5]));
        $mspec =(preg_replace("/[$&*\"\',+-\s\.+\:]/","", $myrow[6]));
        $mtype =(preg_replace("/[$&*\"\',+-\s\.+\:]/","", $myrow[7]));
        $co = (preg_replace("/[$&*\"\',+-\s\.+\:]/","", $myrow[8]));
?>

    <tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF" width=5%><input type="radio" name="partdet" value="<?php echo htmlentities($myrow[0])."|".htmlentities($myrow[1])."|".htmlentities($myrow[2])."|".htmlentities($myrow[3])."|".htmlentities($myrow[4])."|".htmlentities($myrow[5])."|".htmlentities($myrow[6])."|".htmlentities($myrow[7])."|".htmlentities($myrow[8])."|".($myrow[9])?>"></td>
	      <td width=6% bgcolor="#FFFFFF" ><span class="tabletext"><?php echo $myrow[0] ?></td>
                          <td width=16%><span class="tabletext"><?php echo $myrow[1] ?></td>
                          <td width=17%><span class="tabletext"><?php echo $myrow[2] ?></td>
                          <td width=10%><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td width=7%><span class="tabletext"><?php echo $myrow[4] ?></td>
                          <td width=8%><span class="tabletext"><?php echo $myrow[5] ?></td>
                          <td width=8%><span class="tabletext"><?php echo $myrow[6] ?></td>
                          <td width=7%><span class="tabletext"><?php echo $myrow[7] ?></td>
                          <td width=12%><span class="tabletext"><?php echo $myrow[8] ?></td>
                          <td width=16%><span class="tabletext"><?php echo $myrow[9] ?></td>

         </td></tr>
<?php
        }
      $result4master = $newassyPo->getMasterdata($crn);
      $myrow4master = mysql_fetch_row($result4master);

          echo"<tr><td colspan=11 align=\"center\" bgcolor=\"#FFFFFF\"><span class=\"heading\"><b>Master Data Details</b></td></tr>";
          echo"<tr><td bgcolor=\"#FFFFFF\">";
          echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp;</td>";
          if(trim(strtoupper((preg_replace("/[$&*\"\',+-\s\.+\:]/","", $myrow4master[1])))) != trim(strtoupper($priPart)))
          {
             echo"<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$myrow4master[1]</td>";
             $match_flag = 1;
          }
          else
          {
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow4master[1]</td>";

          }
          if(trim(strtoupper((preg_replace("/[$&*\"\',+-\s\.+\:]/","", $myrow4master[2])))) != trim(strtoupper($secPart)))
          {
             echo"<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$myrow4master[2]</td>";
             $match_flag = 1;
          }
          else
          {
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow4master[2]</td>";

          }
          if(trim(strtoupper((preg_replace("/[$&*\"\',+-\s\.+\:]/","", $myrow4master[3])))) != trim(strtoupper($partname)))
          {
             echo"<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$myrow4master[3]</td>";
             $match_flag = 1;
          }
          else
          {
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow4master[3]</td>";

          }
         if(trim(strtoupper((preg_replace("/[$&*\"\',+-\s\.+\:]/","", $myrow4master[4])))) != trim(strtoupper($partiss)))
          {
             echo"<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$myrow4master[4]</td>";
             $match_flag = 1;
          }
          else
          {
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow4master[4]</td>";

          }
          if(trim(strtoupper((preg_replace("/[$&*\"\',+-\s\.+\:]/","", $myrow4master[5])))) != trim(strtoupper($drg)))
          {
             echo"<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$myrow4master[5]</td>";
             $match_flag = 1;
          }
          else
          {
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow4master[5]</td>";

          }
          //echo $custpotype."--**---";

         // {
          if(trim(strtoupper((preg_replace("/[$&*\"\',+-\s\.+\:]/","", $myrow4master[6])))) != trim(strtoupper($mspec)))
          {
             echo"<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$myrow4master[6]</td>";
             if($custpotype !='Assembly')
             {
               $match_flag = 1;
             }
          }
          else
          {
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow4master[6]</td>";

          }
         if(trim(strtoupper((preg_replace("/[$&*\"\',+-\s\.+\:]/","", $myrow4master[7])))) != trim(strtoupper($mtype)))
          {
             echo"<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$myrow4master[7]</td>";
             if($custpotype !='Assembly')
             {
               $match_flag = 1;
             }
          }
          else
          {
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow4master[7]</td>";

          }
         // }
          if(trim(strtoupper((preg_replace("/[$&*\"\',+-\s\.+\:]/","", $myrow4master[8])))) != trim(strtoupper($co)))
          {
             echo"<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$myrow4master[8]</td>";
             $match_flag = 1;
          }
          else
          {
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow4master[8]</td>";

          }
          echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp;</td>";
          

          if(preg_match('/[$&*\"\',+-\s\.+\:]/',$myrow[1])||preg_match('/[$&*\"\',+-\s\.+\:]/',$myrow4master[1]))
     {
         $match_flag_spec = 1;
     }
     if(preg_match('/[$&*\"\',+-\s\.+\:]/',$myrow[2])||preg_match('/[$&*\"\',+-\s\.+\:]/',$myrow4master[2]))
     {
         $match_flag_spec = 1;
     }
     if(preg_match('/[$&*\"\',+-\s\.+\:]/',$myrow[3])||preg_match('/[$&*\"\',+-\s\.+\:]/',$myrow4master[3]))
     {
         $match_flag_spec = 1;
     }
     if(preg_match('/[$&*\"\',+-\s\.+\:]/',$myrow[4])||preg_match('/[$&*\"\',+-\s\.+\:]/',$myrow4master[4]))
     {
        $match_flag_spec = 1;
     }
     if(preg_match('/[$&*\"\',+-\s\.+\:]/',$myrow[5])||preg_match('/[\$\&*\"\',+-\s\.+\:]/',$myrow4master[5]))
     {
        $match_flag_spec = 1;
     }
     if(preg_match('/[$&*\"\',+-\s\.+\:]/',$myrow[6])||preg_match('/[$&*\"\',+-\s\.+\:]/',$myrow4master[6]))
     {
        $match_flag_spec = 1;
     }
     if(preg_match('/[$&*\"\',+-\s\.+\:]/',$myrow[7])||preg_match('/[$&*\"\',+-\s\.+\:]/',$myrow4master[7]))
     {
        $match_flag_spec = 1;
     }
     if(preg_match('/[$&*\"\',+-\s\.+\:]/',$myrow[8])||preg_match('/[$&*\"\',+-\s\.+\:]/',$myrow4master[8]))
     {
        $match_flag_spec = 1;
     }

          echo"</tr>";


?>

</table>
 </div>

<script language=javascript>
function SubmitDet(ctype){
 var flag=0;
 var user_input;
 //alert(document.forms[0].partdet.length);
//alert(user_input);
//alert(ctype);
if(document.forms[0].partdet.length)
{
 for (i=0;i<document.forms[0].partdet.length;i++) {
	if (document.forms[0].partdet[i].checked) {
		user_input = document.forms[0].partdet[i].value;
		flag=1;
	}
}
}
else if(document.forms[0].partdet.checked)
{
  user_input = document.forms[0].partdet.value;
  flag = 1;
}
if(flag == 0)
{
  alert('Please select appropriate CRN before submitting');
  self.close();
}
window.opener.Setwo4det(user_input,ctype,'<?php echo $match_flag?>','<?php echo $match_flag_spec?>');
self.close();}

</script>

<input type=button value="Submit" onclick=" javascript: return SubmitDet(window.name)">
</form>
</body>
</html>

