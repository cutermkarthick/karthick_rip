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

include('classes/assywoClass.php');
$newwo = new assywo;
?>

<html>
  <head>
    <title>All POs</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body onload=self.focus()>
    
    <br>
    Please select Cust PO No</b>
    <br>
    <?php
      $result = $newwo->getpos($crn,$partnum,$woclassif);
    ?>
    <form action='getCIM.php' method='post' enctype='multipart/form-data'>


      <table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr  bgcolor="#FFCC00">
          <td width=5% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
          <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>PO#</b></td>
          <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>PO Date</b></td>
          <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>PO QTY(Bal)</b></td>
          <td width=15% bgcolor="#EEEFEE"><span class="tabletext"><b>Company</b></td>
          <td width=8% bgcolor="#EEEFEE"><span class="tabletext"><b>Ln #</b></td>
          <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>PRN #</b></td>
          <td width=15% bgcolor="#EEEFEE"><span class="tabletext"><b>BOM #</b></td>
          <td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>BOM Iss</b></td>
			   <!--<td width=10% bgcolor="#EEEFEE"><span class="tabletext"><b>Treatment</b></td>-->
        </tr>
      </table>

      <div style="width:987px; height:200; overflow:auto;border:" id="dataList">
        <table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
          <?php

            while ($myrow = mysql_fetch_row($result)) 
            {
                                                 
				      $resultwoqty =  $newwo->getwoqty4custpo($myrow[0],$myrow[10],$myrow[11]);
              $myrow4woqty =  mysql_fetch_row($resultwoqty);

              $totwoqty = $myrow4woqty[0];

              $reult4rejqty =  $newwo->getrejqty4custpo($myrow[0],$myrow[10],$myrow[11]);
              $myrow4rejqty =  mysql_fetch_row($reult4rejqty);
              $rejqty = $myrow4rejqty[0];
              $retqty = $myrow4rejqty[1];

              $qty = $myrow[2]-$totwoqty+$rejqty+$retqty;

              $po_2=htmlentities($myrow[0]);
              $po_4=htmlentities($myrow[3]);
              $po_5=htmlentities($myrow[4]);
              $po_6=htmlentities($myrow[5]);
              $po_7=htmlentities($myrow[6]);
              $po_8=htmlentities($myrow[7]);
              $po_9=htmlentities($myrow[8]);
              $po_10=htmlentities($myrow[2]);
              
              if($qty>0)
              {
              ?>
                <tr bgcolor="#FFFFFF">
                  <td bgcolor="#FFFFFF" width=5%><input type="radio" name="po"   value="<?php echo $myrow[11]."|".$po_2."|".$myrow[1]."|".$qty." | ".$po_4 ." | ".$po_5."|".$po_6." | ".$po_7 ." | ".$po_8." | ".$po_9 . "|" . $po_10  ?>"></td>
          	      <td width=8% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[0] ?></td>
          	      <td width=10% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
                  <td width=8%><span class="tabletext"><?php echo $qty ?></td>
                  <td width=15%><span class="tabletext"><?php echo wordwrap($myrow[3],20,"<br>\n",true) ?></td>
                  <td width=8%><span class="tabletext"><?php echo $myrow[11] ?></td>
                  <td width=10%><span class="tabletext"><?php echo $myrow[5]  ?></td>
                  <td width=15%><span class="tabletext"><?php echo $myrow[13] ?></td>
                  <td width=10%><span class="tabletext"><?php echo $myrow[12] ?></td>
                </tr>
              <?php
              }
            }
            ?>
        </table>
      </div>
      <input type=button value="Submit" onclick=" javascript: return Submitpo(window.name,'<?php echo $woclassif ?>')">
    </form>
  </body>
</html>


<script language=javascript>
  function Submitpo(etype) 
  {
    var flag=0;
    var user_input;  
    if(document.forms[0].po.length)
    {
      for (i=0;i<document.forms[0].po.length;i++) {
	      if (document.forms[0].po[i].checked) {
		      user_input = document.forms[0].po[i].value;
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
    window.opener.Setpo(user_input,etype);
    self.close();
  }
</script>



