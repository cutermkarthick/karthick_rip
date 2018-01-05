<?php
//==============================================
// Author: FSI                                 =
// Date-written = Aug 27, 2008                 =
// Filename: getmccost                         =
// Copyright (C) FluentSoft Inc.               =
// Revision: v1.0                              =
//==============================================
include_once('classes/valpartClass.php');
       $partstr = $_REQUEST['partstr'];
       //$ponum = $_REQUEST['ponum'];
       //$partstr = 'Magellan Aerospace Wrexham' . '|' . 'D123456';
       //echo $partstr;
       //$partnum = 'D123456';
       //$tblid = $_REQUEST['tblid'];
       //$divid = $_REQUEST['divid'];

       $newvalpart = new valpart;
?>
 <link rel="stylesheet" href="style.css">
<html>
<head>
    <title>Part Number Validation</title>
</head>
<body onLoad="self.focus()">
</body>



<form>
<input type=button value="Ok" onclick=" javascript: return SubmitCust('Ok')">
<input type=button value="Cancel" onclick=" javascript: return SubmitCust('Cancel')">

<?php
   echo '<span class="heading"><b>Part Number Validation<b>';
   //$result = $newreport->get_mccost($mcname,$cond);
   echo "<div style=\"width:1200px;height:800px;overflow:auto;\">";
   echo "<table id=\"$tblid\" width=100% border=1 cellpadding=3 cellspacing=1 bgcolor=\"#DFDEDF\">";

   echo' <tr>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Cust PO <br>Number</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Cust PO<br>Date</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Line Num</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Part Num</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>GrainFlow</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Max Ruling</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Alt Spec</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Drg Iss</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Part<br>Iss/Attach</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>COS<br>Issue</b></td>
            <td bgcolor="#FFFFFF" width=20%><span class="heading"><b>Model<br>Issue</b></td>

        </tr>';
         $partarr1 = split("\|" ,$partstr,2);
         $cname = $partarr1[0];
         //echo $cname;
         $partarr = split("\|" ,$partarr1[1]);
         //echo $cname;
         //print_r($partarr);
         $partcount=count($partarr);
         //echo $partcount;
         for($i=0;$i<$partcount;$i++)
         {
            $curpartarr = split(";" ,$partarr[$i]);
            //print_r($curpartarr);
            $curpartcount = count($curpartarr);
            $cur_partnum = $curpartarr[0];
            //echo $latest_partnum;
            $j=1;
            $gf = $curpartarr[$j++];
            //echo $gf;
            $mr = $curpartarr[$j++];
            //echo $mr;
            $altspec = $curpartarr[$j++];
            $drgiss = $curpartarr[$j++];
            $partiss = $curpartarr[$j++];
            $cosiss = $curpartarr[$j++];
            $modiss = $curpartarr[$j++];
            $ln = $curpartarr[$j++];
            //echo $modiss;
           $partfound = 0;
           $res_partnum = $newvalpart->getpartnum_details4neworder($cname,$cur_partnum);
           while ($myrow1 = mysql_fetch_row($res_partnum)) {
           if($myrow1[1] == $cur_partnum)
           {
            echo "<tr>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[11]</td>";
            if($myrow1[2] != '' && $myrow1[2] != '0000-00-00')
               {
                 $datearr = split('-', $myrow1[2]);
                 $d=$datearr[2];
                 $m=$datearr[1];
                 $y=$datearr[0];
                 $x=mktime(0,0,0,$m,$d,$y);
                 $orddate=date("M j, Y",$x);
               }
               else
               {
                 $orddate = '';
               }
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$orddate</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[10]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[1](prev)</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[3]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[4]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[5]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[6]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[7]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[8]</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$myrow1[9]</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$ln</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cur_partnum (cur)</td>";
            if($myrow1[3] == $gf)
              echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$gf</td>";
            else
              echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$gf</td>";
            if($myrow1[4] == $mr)
              echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$mr</td>";
            else
              echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$mr</td>";
            if($myrow1[5] == $altspec)
              echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$altspec</td>";
            else
              echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$altspec</td>";
            if($myrow1[6] == $drgiss)
              echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$drgiss</td>";
            else
              echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$drgiss</td>";
            if($myrow1[7] == $partiss)
              echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$partiss</td>";
            else
              echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$partiss</td>";
            if($myrow1[8] == $cosiss)
              echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cosiss</td>";
            else
              echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$cosiss</td>";
            if($myrow1[9] == $modiss)
              echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$modiss</td>";
            else
              echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$modiss</td>";
            echo "</tr>";
            $partfound = 1;
           }
          }
          if($partfound != 1)
           {
            echo "<tr>";
            echo "<td colspan=11 bgcolor=\"#FFFFFF\"><span class=\"tabletext\">No Previous Part</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">&nbsp</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$ln</td>";
            echo "<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$cur_partnum (cur)</td>";
            echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$gf</td>";
            echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$mr</td>";
            echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$altspec</td>";
            echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$drgiss</td>";
            echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$partiss</td>";
            echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$cosiss</td>";
            echo "<td bgcolor=\"#FF0000\"><span class=\"tabletext\">$modiss</td>";
            echo "</tr>";
           }
         }
         echo '</table>';
         echo '</div>';

?>
<script language=javascript>
function SubmitCust(param) {
//alert('here1');
window.opener.SetRetval(param);
self.close();
}
</script>

</form>
</body>
</html>
