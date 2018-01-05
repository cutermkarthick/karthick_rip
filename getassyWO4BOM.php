<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Jan 04, 2018                 =
// Filename: getassyWO4BOM.php                 =
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

include('classes/bomClass.php');
$newbom = new bom;

?>


<html>
  <head>
    <title>Assembly Wo's</title>
    <link rel="stylesheet" href="style.css">
  </head>

  <body onload="self.focus()">
    <form action='getassyWO4BOM.php' method='post' enctype='multipart/form-data'>
      <table width=100% border=0 cellpadding=0 cellspacing=0>
        <tr>
          <td><span class="pageheading"><b>Assembly Wo's</b></span></td>
        </tr>
        <tr>
          <td>
            <table style="table-layout: fixed" width=800px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
              <tr  bgcolor="#FFCC00">
                <td width=4% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></span></td>
                <td width=10% bgcolor="#EEEFEE"><span class="heading"><b>Assy Wo</b></span></td>
                <td width=6% bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></span></td>
                <td width=12% bgcolor="#EEEFEE"><span class="tabletext"><b>Assy<br>Part #</b></span></td>
                <td width=7% bgcolor="#EEEFEE"><span class="tabletext"><b>Drg #</b></span></td>
                <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Drg<br>Iss</b></span></td>
                <td width=5% bgcolor="#EEEFEE"><span class="tabletext"><b>COS</b></span></td>
                <td width=5% bgcolor="#EEEFEE"><span class="tabletext"><b>Type</b></span></td>
                <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Part Iss<br>Attachments</b></span></td>
                <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></span></td>
              </tr>
            </table>

            <div style="width:820px; height:200; overflow:auto;border:" id="dataList">
              <table style="table-layout: fixed" width=800px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
              <?php
                $result = $newbom->getassywo4bom();
                while ($myrow = mysql_fetch_row($result)) {
              ?>

              <tr bgcolor="#FFFFFF">
                <td bgcolor="#FFFFFF" width=4%><input type="radio" id="crn"  name="crn"   value="<?php echo $myrow[0]."|".$myrow[1]."|".$myrow[2]."|".$myrow[3]."|".$myrow[4]."|".$myrow[5] ."|".$myrow[6] ."|".$myrow[7] ."|".$myrow[8] ."|".$myrow[9]?>"></td>
                <td width=10% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
                <td width=6% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
                <td width=12%><span class="tabletext"><?php echo $myrow[8] ?></td>
                <td width=7%><span class="tabletext"><?php echo $myrow[3] ?></td>
                <td width=10%><span class="tabletext"><?php echo $myrow[4] ?></td>
                <td width=5%><span class="tabletext"><?php echo $myrow[5] ?></td>
                <td width=5%><span class="tabletext"><?php echo $myrow[6] ?></td>
                <td width=10%><span class="tabletext"><?php echo wordwrap($myrow[7],15,"<br>\n",true) ?></td>
                <td width=10%><span class="tabletext"><?php echo $myrow[9]; ?></td>
              </tr>
              <?php
              }
              ?>
              </table>
            </div>
            <input type=button value="Submit" onclick=" javascript: return SubmitCIM(window.name)">
          </td>
        </tr>

    </form>
  </body>
</html>

<script language=javascript>
  function SubmitCIM(ctype){
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
    window.opener.SetAssyWonum4Bom(user_input,ctype);
    self.close();
  }

</script>