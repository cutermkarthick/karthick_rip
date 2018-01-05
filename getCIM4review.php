<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: getassyCIM.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Popup for selecting CRN                     =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];


include('classes/assyReviewClass.php');
$newassyReview = new assyReview;
$linenum=$_REQUEST['lnnum'];
$qtyln=$_REQUEST['pqty'];
?>
<link rel="stylesheet" href="style.css">
<html>
<head>
    <title>All Assembly CRN's</title>
</head>
<body onload=self.focus()>
<form action='getCIM4review.php' method='post' enctype='multipart/form-data'>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >

<table>
<tr><td><span class="pageheading"><b>PRN</b></td></tr>
<tr><td>
	<table style="table-layout: fixed" width=780px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
    <tr  bgcolor="#FFCC00">
      <td width=4% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
      <td width=6% bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>
      <td width=12% bgcolor="#EEEFEE"><span class="tabletext"><b>Assy<br>Part #</b></td>
      <td width=15% bgcolor="#EEEFEE"><span class="tabletext"><b>Assy<br>Name</b></td>
      <td width=12% bgcolor="#EEEFEE"><span class="tabletext"><b>Type </b></td>
      <td width=15% bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></td>
     </tr>
  </table>
  <div style="width:797px; height:200; overflow:auto;border:" id="dataList">
    <table style="table-layout: fixed" width=780px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
    <?php
      $result = $newassyReview->getcrn4review();
      while ($myrow = mysql_fetch_row($result)) 
      {
  	    $bom=wordwrap($myrow[2],8,"<br>\n",true); 
  	    $partnum=wordwrap($myrow[4],12,"<br>\n",true); 
      ?>

      <tr bgcolor="#FFFFFF">
        <td bgcolor="#FFFFFF" width=4%><input type="radio" id="crn"  name="crn"  value="<?php echo $myrow[0]."|".$myrow[1]."|".$myrow[2]."|".$myrow[3]."|".$myrow[4]."|".$myrow[4] ?>"></td>
	      <td width=6% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
        <td width=12%><span class="tabletext"><?php echo $myrow[2] ?></td>
        <td width=15%><span class="tabletext"><?php echo $myrow[4] ?></td>
        <td width=12%><span class="tabletext"><?php echo $myrow[3] ?></td>
        <td width=15%><span class="tabletext"><?php echo $myrow[5] ?></td>
      </tr>
      <?php
      }
      ?>
    </table>
  </div>

  <script language=javascript>
    function SubmitCIM(ctype)
    {
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
      window.opener.Setcrn_assyrev(user_input,ctype,'<?php echo $linenum ?>','<?php echo $qtyln ?>');
      self.close();
    }
  </script>

<input type=button value="Submit" onclick=" javascript: return SubmitCIM(window.name)">
</form>
</body>
</html>

