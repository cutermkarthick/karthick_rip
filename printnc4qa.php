<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 21, 2007                 =
// Filename: printqualityplanDetails.php       =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// print Quality Plan Details                  =
//==============================================

   session_start();
   header("Cache-control: private");

   if ( !isset ( $_SESSION['user'] ) )
   {
     header ( "Location: login.php" );

   }
   $userid = $_SESSION['user'];

   $_SESSION['pagename'] = 'ds_details';
   //////session_register('pagename');

// First include the class definition

   include('classes/nc4qaclass.php');
   include('classes/displayClass.php');

   $newlogin = new userlogin;
   $newlogin->dbconnect();
   $userid = $_SESSION['user'];

   $newdisplay = new display;

   $newnc = new nc4qa;

   $nc4qarecnum = $_REQUEST['nc4qarecnum'];

   $result = $newnc->getqanc($nc4qarecnum);

  $myrow = mysql_fetch_row($result);
  if($myrow[34] != '0000-00-00' && $myrow[34] != '' && $myrow[34] != 'NULL')
  {
      $datearr = split('-', $myrow[34]);
      $d=$datearr[2];
      $m=$datearr[1];
      $y=$datearr[0];
      $x=mktime(0,0,0,$m,$d,$y);
      $custncdate=date("M j, Y",$x);      
   }
   else
   {
       $custncdate = '';
   }
  if($myrow[13] != '0000-00-00' && $myrow[13] != '' && $myrow[13] != 'NULL')
  {
      $datearr = split('-', $myrow[13]);
      $d=$datearr[2];
      $m=$datearr[1];
      $y=$datearr[0];
      $x=mktime(0,0,0,$m,$d,$y);
      $dcdate=date("M j, Y",$x);      
   }
   else
   {
       $dcdate = '';
   }
?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>
<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b>
   <A HREF="javascript:window.print()">NC:  <?php printf("%05d", $myrow[0]) ?></A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
 <tr>
    <td><img src="images/masthead.jpg" alt="CIM Tools" width="137" height="35" class="Masthead" /></td>
<tr>
</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>

<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" rules=all>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">CIM Ref Num.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[1] ?></td>
            <td><span class="labeltext"><p align="left">Customer</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[2] ?></td>
        </tr>
		<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Stage #</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[46] ?></td>
			<td><span class="labeltext"><p align="left">Create Date</p></font></td>
             <?php
             if($myrow[30] != '0000-00-00' && $myrow[30] != '' && $myrow[30] != 'NULL')
            {
              $datearr = split('-', $myrow[30]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $cr_date=date("M j, Y",$x);
            }
           else
           {
              $cr_date = '';
           }
          // echo  $myrow[30];
          ?>

             <td><span class="tabletext"><?php echo $cr_date ?></td>
			 </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Part Name</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[3] ?></td>
			 <td><span class="labeltext"><p align="left">Part No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[5] ?></td>          
        </tr>
		   <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">WO Type</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[44] ?></td>
            <td><span class="labeltext"><p align="left">DN #</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[45] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">Batch No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[4] ?>
            </td>
            <td><span class="labeltext"><p align="left">Matl. Spec</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[6] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Issue & PS</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[7] ?></td>
            <td><span class="labeltext"><p align="left">Qty</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[8] ?></td>
        </tr>
         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">PO No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[9] ?></td>
            <td><span class="labeltext"><p align="left">Part Sl No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[10] ?></td>
        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">WO No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[11] ?></td>
            <td><span class="labeltext"><p align="left">DC No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[12] ?></td>
        </tr>

         <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">DC Date</p></font></td>
            <td><span class="tabletext"><?php echo $dcdate ?></td>
            <td><span class="labeltext"><p align="left">C of C No.</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[29] ?></td>
        </tr>
		<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Supervisor Name</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[31] ?></td>
            <td><span class="labeltext"><p align="left">Operator Name</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[32] ?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Cust NC#</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[33] ?></td>
            <td><span class="labeltext"><p align="left">Cust NC Date</p></font></td>
            <td><span class="tabletext"><?php echo $custncdate ?></td>
        </tr>
		 <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Machine Name</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[48] ?></td>
			<td><span class="labeltext"><p align="left">Status</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[40]?></td>
		</tr>
		<tr bgcolor="#FFFFFF">
       <td bgcolor="#FFFFFF" colspan=6><span class="heading"><b>Remarks/Attachments:</b><br>
       <span class="tabletext"><?php echo wordwrap($myrow[35],40,"<br />\n"); ?>
       </td>
       </tr>



<?php
 //echo "quotetype:$quotetype";
//$wotype="test2";
// $ctrls=$newpage->createjs4quote("Quote",$quotetype) ;
 //$ctrls=$newpage->createctrls("Quote",$quotetype) ;
//echo "$ctrls";
?>

<!--<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>-->
<tr bgcolor="#FFFFFF">


<table id="myTable" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<tr>
 <tr bgcolor="#DDDEDD">
    <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">ERROR TYPE</td>
    <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">CAUSE</td>
     <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">STAGE</td>
	   <td bgcolor="#FFFFF" width=20% colspan=2 align="center"><span class="labeltext">DISPOSITION</td>
   </tr>
   <td bgcolor="#FFFFFF" width=20%><span class="labeltext">DIMENSIONAL DEVIATION</td>
   <?php

   $checked1="";
   
   if($myrow[15] == 'yes'){
   $checked1="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked1 ?> name="dim_deviation" disabled></td>
   <td bgcolor="#FFFFFF" width=20%><span class="labeltext">MAN</td>
    <?php

   $checked2="";

   if($myrow[16] == 'yes'){
   $checked2="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked2 ?>  name="man" disabled></td>
   <td bgcolor="#FFFFFF"  width=20%><span class="labeltext">IN PROCESS</td>
   <?php

   $checked3="";

   if($myrow[17] == 'yes'){
   $checked3="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked3 ?> name="inprocess" disabled></td>

      <td bgcolor="#FFFFFF"><span class="labeltext">ACCEPTED</td>
   <?php

   $checked10="";

   if($myrow[41] == 'yes'){
   $checked10="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked10 ?> name="accepted" disabled></td>


</tr>
<tr>
  <td bgcolor="#FFFFFF"><span class="labeltext">MATERIAL DEVIATION</td>
  <?php

   $checked4="";

   if($myrow[18] == 'yes'){
   $checked4="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked4 ?>  name="mat_deviation" disabled></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">MACHINE</td>
   <?php

   $checked5="";

   if($myrow[19] == 'yes'){
   $checked5="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked5 ?> name="machine" disabled></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">FINAL INSPECTION</td>
   <?php

   $checked6="";

   if($myrow[20] == 'yes'){
   $checked6="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked6 ?> name="final_insp" disabled></td>

   <td bgcolor="#FFFFFF"  width=20%><span class="labeltext">REJECTED</td>
   <?php

   $checked11="";

   if($myrow[42] == 'yes'){
   $checked11="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked11 ?> name="rejected" disabled></td>

</tr>
<tr>
  <td bgcolor="#FFFFFF"><span class="labeltext">OTHER DEVIATION</td>
  <?php

   $checked7="";

   if($myrow[21] == 'yes'){
   $checked7="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked7 ?> name="other_deviation" disabled></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">METHOD</td>
   <?php

   $checked8="";

   if($myrow[22] == 'yes'){
   $checked8="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked8 ?> name="method" disabled></td>
   <td bgcolor="#FFFFFF"><span class="labeltext">CUSTOMER END</td>
   <?php

   $checked9="";

   if($myrow[23] == 'yes'){
   $checked9="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked9 ?> name="cust_end" disabled></td>

   <td bgcolor="#FFFFFF"  width=20%><span class="labeltext">QUARANTINED</td>
   <?php

   $checked12="";

   if($myrow[43] == 'yes'){
   $checked12="checked";
   }
   ?>
   <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked12 ?> name="quarantined" disabled></td>

</tr>
<tr>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
<td bgcolor="#FFFFFF">&nbsp</td>
 <td bgcolor="#FFFFFF"  width=20%><span class="labeltext">REWORK</td>
   <?php

   $checked13="";

   if($myrow[47] == 'yes'){
   $checked13="checked";
   }
   ?>
  <td bgcolor="#FFFFFF"><input type="radio" <?php echo $checked13 ?> name="rework" disabled></td>
</tr>

<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Brief Description of Non Conformance:</b><br>
    <span class="tabletext"> <?php echo wordwrap($myrow[24],100,"<br />\n"); ?>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Root Cause:</b><br>
    <span class="tabletext"> <?php echo wordwrap($myrow[25],100,"<br />\n"); ?>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Corrective Action:</b><br>
    <span class="tabletext"><?php echo wordwrap($myrow[26],100,"<br />\n"); ?>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Preventive Action:</b><br>
    <span class="tabletext"><?php echo wordwrap($myrow[27],100,"<br />\n"); ?>
    </td>
</tr>
<tr bgcolor="#FFFFFF">
    <td bgcolor="#FFFFFF" colspan=8><span class="heading"><b>Effectiveness:</b><br>
    <span class="tabletext"> <?php echo wordwrap($myrow[28],100,"<br />\n"); ?>
    </td>
</tr>
</table>
<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 rules=all>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext"><?php echo $myrow[36] ?></td>
            <td colspan=2><span class="labeltext"><?php echo $myrow[37] ?></td>
            <td colspan=2><span class="labeltext"></td>
        </tr>
 
</table>
</body>
</html>
