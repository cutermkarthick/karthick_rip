<?php
//==============================================
// Author: FSI                                 =
// Date-written = Nov 29, 2017                 =
// Filename: GetRmpoNum4BOI.php                =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Popup for selecting GRN                     =
//==============================================

session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
include('classes/assywoClass.php');
$newassywo = new assywo;

$partnum=$_REQUEST['partnum'];
$type=$_REQUEST['type'];

$result = $newassywo->GetBOIRmpoNum4AssyWo($partnum,$type);


?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>All RMPO</title>
</head>
<body onload=self.focus()>
<form>

<table width=100% border=0	 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td><span class="pageheading"><b>RMPO</b></td></tr>
<tr><td>

	<table style="table-layout: fixed" width=800px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
    <tr  bgcolor="#FFCC00">
      <td width=4% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
      <td width=6% bgcolor="#EEEFEE"><span class="tabletext"><b>PO Num</b></td>
      <td width=12% bgcolor="#EEEFEE"><span class="tabletext"><b>PO Date<br>#</b></td>
      <td width=6% bgcolor="#EEEFEE"><span class="tabletext"><b>Line Num</b></td>
      <td width=7% bgcolor="#EEEFEE"><span class="tabletext"><b>Type</b></td>
      <td width=7% bgcolor="#EEEFEE"><span class="tabletext"><b>PRN<br>Num</b></td>
      <td width=5% bgcolor="#EEEFEE"><span class="tabletext"><b>Raw Mat<br>Spec</b></td>
      <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Rate</b></td>
    </tr>
  </table>


  <div style="width:820px; height:200; overflow:auto;border:" id="dataList">
  <table style="table-layout: fixed" width=800px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
  <?  
    while ($myrow = mysql_fetch_row($result) )
    {					  
  ?>

      <tr bgcolor="#FFFFFF">
        <td bgcolor="#FFFFFF" width=4%><input type="radio" id="rmpo"  name="rmpo"   value="<?php echo $myrow[1] . "|" . $myrow[2] .  "|" . $myrow[3]. "|" . $myrow[4]. "|" . $myrow[5]. "|" . $myrow[6] . "|" . $myrow[7] ?>"></td>
	      <td width=6% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
        <td width=12%><span class="tabletext"><?php echo $myrow[2] ?></td>
        <td width=6%><span class="tabletext"><?php echo $myrow[7] ?></td>
        <td width=7%><span class="tabletext"><?php echo wordwrap($myrow[3],10,"<br>\n",true) ?></td>
        <td width=7%><span class="tabletext"><?php echo wordwrap($myrow[4],10,"<br>\n",true) ?></td>
        <td width=5%><span class="tabletext"><?php echo wordwrap($myrow[5],8,"<br>\n",true) ?></td>
        <td width=10%><span class="tabletext"><?php echo $myrow[6]; ?></td>
      </tr>       
  <?php
   }
  ?>

  </table>
  </div>


  <script language=javascript>
    function Submitgrn(etype) 
    {
      var flag=0;
      var user_input;

      if(document.forms[0].rmpo.length)
      {
        for (i=0;i<document.forms[0].rmpo.length;i++) 
        {
	        if (document.forms[0].rmpo[i].checked) 
          {
		        user_input = document.forms[0].rmpo[i].value;		
		        flag=1;
	        }
        }
      }

      else if(document.forms[0].rmpo.checked)
      {
        user_input = document.forms[0].rmpo.value;
        flag = 1;
      }

      if(flag == 0)
      {
        alert('Please select appropriate CRN before submitting');
        self.close();
      }
      
      window.opener.SetRMPO(user_input,etype);
      self.close();
    }
  </script>
  
</table>
<br/>
<input type=button value="Submit" onclick="javascript: return Submitgrn(window.name)">
</form>
</html>