<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2004                 =
// Filename: board.php                         =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Board details                               =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}


// Includes
include_once('classes/loginClass.php');
//include('classes/pageClass.php');
//include('classes/pagefieldsClass.php');
include('classes/workorderClass.php');
include('classes/displayClass.php');
include('classes/datesClass.php');
include('classes/approvalClass.php');

        include('classes/mmClass.php');

        $newmm = new mm;


         include('classes/inClass.php');
//		include('classes/fidClass.php');
//        include('classes/irmClass.php');
//        include('classes/siClass.php');
         include('classes/masterdataClass.php');
//        include('classes/ddClass.php');

//        $newfid = new fid;
//        $newirm = new irm;
//        $newsi = new stage_insp;
        $newMD = new masterdata;
//        $newdd = new dd;
		$newin = new in;

$typenum = $_SESSION['typenum'];
if ( !isset ( $typenum ) )
{
     header ( "Location: login.php" );

}
$worecnum = $_SESSION['worecnum'];
if ( !isset ( $worecnum ) )
{
     header ( "Location: login.php" );

}
$wotype = $_SESSION['wotype'];
//echo "worecnum:$worecnum<br>";

if ( !isset ( $_REQUEST['dept'] ) )
{
      $dept='';
}
else

    $dept=$_REQUEST['dept'];

$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'woDetails';
//////session_register('pagename');
$newlogin = new userlogin;
$newlogin->dbconnect();
//$newpage = new page;
$newwo = new workOrder;
$newapproval = new approval;
$newdisplay = new display;
//$newgen = new genericWO;

//echo "worecnum:$worecnum<br>";
//$result = $newgen->getGenInfo($worecnum);
//$myrow = mysql_fetch_row($result);
//$result = $newgen->getAddrInfo($worecnum);
//$myaddr = mysql_fetch_row($result);
//$result = $newpage->getwoDetails($wotype,$worecnum);
//$myWo = mysql_fetch_row($result);
//$result = $newgen->getParts($typenum);
//$myParts = mysql_fetch_row($result);
$newDates = new dates;
$timeline = $newDates->getdates('WO', $worecnum,$wotype);

 $result1 = $newwo->attachments($worecnum);
 $myrow1 = mysql_fetch_assoc($result1);
?>

<link rel="stylesheet" href="style.css">

<html>
<style type="text/css">
<!--
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.style6 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #000000;
	font-size: 12px;
}
.style14 {font-size: 12; font-weight: bold; }
.style16 {font-size: 16; font-weight: bold; }
-->
</style>
<head>
<title></title>
</head>
<script script language="javascript" type="text/javascript">
function checkradio()
{   //alert(document.getElementById('rmcim').value+"-----"+document.getElementById('rmcust').value);
  if(document.getElementById('rmcim').value=='yes' && document.getElementById('rmcust').value=='checked')
  {
    alert("Please select either RM by Host or RM by Cust");
    parent.focus();
  
  }
  else if(document.getElementById('rmcim').value=='checked' && document.getElementById('rmcust').value=='yes')
  {
    alert("Please select either RM by Host or RM by Cust");
    parent.focus();

  }
  else if(document.getElementById('rmcim').value=='yes' && document.getElementById('rmcust').value=='yes')
  {
    alert("Please select either RM by Host or RM by Cust");
    parent.focus();

  }
  else
  {
    window.print()
  
  }

}


</script>





<?php

$newlogin = new userlogin;
$newlogin->dbconnect();
$newwo = new workOrder;

$result = $newwo->getGenInfo($worecnum);
$myrow = mysql_fetch_row($result);
$result = $newwo->getAddrInfo($worecnum);
$myaddr = mysql_fetch_row($result);
// Added to update print flag
$newwo->updprintflag($worecnum);

      if($myrow[19] != '0000-00-00' && $myrow[19] != '' && $myrow[19] != 'NULL')
      {
              $datearr = split('-', $myrow[19]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
       $x=mktime(0,0,0,$m,$d,$y);
       $date1=date("M j, Y",$x);
      }
      else
      {
        $date1 = '';
      }
      if($myrow[4] != '0000-00-00' && $myrow[4] != '' && $myrow[4] != 'NULL')
      {
              $datearr = split('-', $myrow[4]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
       $x=mktime(0,0,0,$m,$d,$y);
       $date2=date("M j, Y",$x);
      }
      else
      {
        $date2 = '';
      }
//echo "i am here";
        $html =''; ?>


<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=5>

<tr bgcolor="#DFDEDF" class="style6">
<?php
$wo = 'WORK ORDER';
if($myrow[40] != '' && $myrow[40] != 'NULL')
{
 $wo = 'WORK ORDER'.'('.$myrow[40].')';
}
?>
  <td width="30%"><span class="style14"><A HREF="javascript:checkradio();" ><?php echo $wo?></span></span></td>
   <td width="2%">&nbsp;</td>
   <td width="10%" align="left"><span class="style14">WO DATE</span></td>
   <td width="15%"><span class="style14"><?php echo $date1?></span></td>
  <td width="3%" >&nbsp;</td>
  <td width="18%"><span class="style14">WO NO</span>. </span></td>
  <td width="16%" align="right"><span class="style16"><?php printf ("%05d",$myrow[0]) ?></span></td>

</tr>
</table>
</br>
<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=0>
 <tr><td width=40%%><table border="1" width="100%" bgcolor="#FFFFFF" rules="all" cellspacing="0">
   <tr>
     <td class="style6" >CUSTOMER</td>
     <td class="style6" ><?php echo$myrow[2]?></td>
   </tr>
   <tr>
     <td><span class="style6">GRN # </span></td>
     <td  class="style6"><?php echo $myrow[26]?></td>
   </tr>
   <tr>
     <td><span class="style6">Batch Num </span></td>
     <td  class="style6"><?php echo $myrow[29]?></td>
   </tr>
   <tr>
       <td>
           <span class="style6">RM SPEC</span></td>
       <td class="style6"><?php echo $myrow[48] ?></td>
     </tr>
     <tr>
       <td><span class="style6">RM TYPE</span> </td>
       <td class="style6"><?php echo $myrow[49] ?></td>
 </table></td>
   <td width=2%>&nbsp;</td>
   <td width=35%><table border="1" width="100%" bgcolor="#FFFFFF" rules="all" cellspacing="0">
     <tr>
       <td><span class="style6">CUST PO # </span></td>
       <td class="style6"><?php echo $myrow[3]?></td>
     </tr>
     <tr>
       <td><span class="style6">CUST PO DATE </span></td>
       <td class="style6"><?php echo $date2?></td>
     </tr>
   </table></td>
   <td width=2%>&nbsp;</td>
   <td width=20%><table border="1" width="100%" bgcolor="#FFFFFF" rules="all" cellspacing="0">
     <tr>
       <td width="42%"><span class="style6"> PO QTY</span></td>
       <td width="58%" class="style6"><?php echo $myrow[28]?></td>
     </tr>
     <tr>
       <td><span class="style6">WO QTY</span></td>
       <td class="style6"><?php echo $myrow[27]?></td>
     </tr>
     <tr>
       <td><span class="style6">Type</span></td>
       <td class="style6"><?php echo $myrow[41]?></td>
     </tr>
   </table></td>
     <tr bgcolor="#FFFFFF">
       <td><span class="style6"><b>Remarks:</b>
       <span class="style6"><?php echo $myrow[42]?></td>
</table>


 <?php
 $grn_num=$myrow[26];
// echo $grn_num."******";
 $result = $newwo->getlink2masterdata($worecnum);
 $myrec =  mysql_fetch_row($result);
 $link2masterdata = $myrec[0];

 if($link2masterdata != '')
 {
    include("printmddetails.php");
 }


        include("printindetails.php");
		//include("irmDetails.php");
        //include("mmdetails.php");
        //include("siDetails.php");
       //include("fidDetails.php");
        //include("ddDetails.php");
	echo "</table><table width=100% border=1 cellspacing=0 cellpadding=0 rules=\"none\">";
    echo "<tr bordercolor=#FFFFFF><td colspan=13><span class=\"tabletext\"><b>Remarks:";
    $remarks = wordwrap($myrow[33],130,"<br />\n");
    echo "<td><span class=\"tabletext\">$remarks</td></tr></table>";
    list($format,$rev) = split(" ",$myrow[32],2);
?>
<table border=3 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#FFFFFF">
            <td colspan=4><span class="labeltext"><?php echo $format ?></td>
            <td colspan=2><span class="labeltext"><?php echo "$rev" ?></td>
            
        </tr>

</table>

     <!--   <tr bgcolor="#EEE0E5">
            <td colspan=12 class="bgcolor4"><span class="heading"><center><b>Timeline & Owner</b></center></td>
        </tr>
 <tr><td colspan=12>
        <table width=100% border=1 cellpadding=0 cellspacing=0  >

        <tr class="bgcolor4"  border=0>

            <td><span class="tabletext"><p align="left"><b>Sch Due Date</b></p></font></td>
            <td><input type="text" name="sch_due_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php if ($myrow[17] != '0000-00-00') echo $myrow[17] ?>">
            </td>
            <td><span class="tabletext"><p align="left"><b>Revised Ship Date</b></p></font></td>
            <td><input type="text" name="rev_ship_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php if ($myrow[20] != '0000-00-00') echo $myrow[20] ?>">
            </td>
            <td><span class="tabletext"><p align="left"><b>Actual Ship Date</b></p></font></td>
            <td><input type="text" name="act_ship_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php if ($myrow[18] != '0000-00-00') echo $myrow[18] ?>">
            </td>

        </tr>
       </table>
 </tr></td>
        <tr class="bgcolor4">
           <td WIDTH=13%><span class="heading"><b>Department</b></td>
            <td WIDTH=4%><span class="heading"><b>Seq#</b></td>
            <td WIDTH=21%><span class="heading"><b>Milestone</b></td>
            <td WIDTH=4%><span class="heading"><b>Dep#</b></td>
	        <td WIDTH=9%><span class="heading"><b>Sch Date</b></td>
            <td WIDTH=9%><span class="heading"><b>Revised Date</b></td>

            <td WIDTH=9%><span class="heading"><b>Completed Date</b></td>
	        <td WIDTH=9%><span class="heading"><b><center>Owner</center></b></td>
            <td WIDTH=11%><span class="heading"><b><center>Approved by</center></b></td>
            <td WIDTH=6%><span class="heading"><b><center>Notes</center></b></td>
            <td WIDTH=9%><span class="heading"><b><center>Ref Num.</center></b></td>
        </tr>
<?php
        $department = "";
        $i=0;
        while ($mytl = mysql_fetch_row($timeline)) {

             if($mytl[28] != $department)
             {


               if($i == 1)
               {
                $i = 0;
               }
               else if ($i == 0)
               {
                $i = 1;
               }


             }
?>
          <tr  <?php if ($i == 1){ echo "class='bgcolor3'";} else { echo "class='bgcolor4'";}?> ID="mytable<?php echo $t ?>">
            <td WIDTH=13%><span class="heading"><b><i><?php

                                      if($mytl[28] != $department){

                                                         ?>



                                                        <?php echo $mytl[28];


                                                        } ?></i></b></td>

            <td WIDTH=4%><span class="heading"><?php  echo $mytl[31] ?></td>
            <td WIDTH=21%><span class="heading"><?php echo $mytl[1] ?></td>
            <td WIDTH=4%><span class="heading"><?php echo $mytl[29] ?></td>

            <?php
            $d=substr($mytl[2],8,2);
            $m=substr($mytl[2],5,2);
            $y=substr($mytl[2],0,4);
            $x=mktime(0,0,0,$m,$d,$y);
            //$date1=date("M j, Y",$x);
           // echo "$date";
          ?>


            <td WIDTH=9%><span class="heading"><?php if ($mytl[2] != '0000-00-00') echo $date1 ?></td>
            <td WIDTH=9%><span class="heading"><?php if ($mytl[3] != '0000-00-00') echo $mytl[3] ?></td>

            <td WIDTH=9%><span class="heading"><?php if ($mytl[4] != '0000-00-00') echo $mytl[4] ?></td>


<?php
            if ($mytl[10] != 'Cust') {
?>
                <td WIDTH=9%><span class="heading"><?php echo $mytl[12] ?></td>

<?php
            }
            else {
?>
                <td WIDTH=9%><span class="heading"><?php echo $mytl[14] ?></td>

<?php
            }
?>
<?php
            if ($mytl[10] != 'Cust') {
?>
                <td WIDTH=11%><span class="heading"><?php if($mytl[29] == '' & $mytl[16] == '' & $mytl[32] == 'SU') {
                                          ?>
                                          <?php echo $mytl[32] ?> <a href="processApproval.php?worecnum=<?php echo $worecnum ?>&wfrecnum=<?php echo $mytl[9] ?>&drecnum=<?php echo $mytl[8] ?>&typerecnum=<?php echo $typenum ?>&nextstatus=<?php echo $mytl[30] ?>&stagenum=<?php echo $mytl[31] ?>"><img src="images/bu_approval.gif" border=0>  </a>

                                          <?php }
                                               else if($mytl[29] == '' & $mytl[16] == '' & $mytl[32] == 'RU') {
                                          ?>

                                          <?php
                                                   if($mytl[28] == 'Sales' & $mytl[33] == 'Sales')
                                                   {
                                          ?>

                                          <a href="processApproval.php?worecnum=<?php echo $worecnum ?>&wfrecnum=<?php echo $mytl[9] ?>&drecnum=<?php echo $mytl[8] ?>&typerecnum=<?php echo $typenum ?>&nextstatus=<?php echo $mytl[30] ?>&stagenum=<?php echo $mytl[31] ?>"><img src="images/bu_approval.gif" border=0>  </a>

                                          <?php
                                                 }
                                                 if($mytl[28] == 'Stores' & $mytl[33] == 'Stores' ) {
                                          ?>
                                           <a href="processApproval.php?worecnum=<?php echo $worecnum ?>&wfrecnum=<?php echo $mytl[9] ?>&drecnum=<?php echo $mytl[8] ?>&typerecnum=<?php echo $typenum ?>&nextstatus=<?php echo $mytl[30] ?>&stagenum=<?php echo $mytl[31] ?>"><img src="images/bu_approval.gif" border=0>  </a>
                                          <?php
                                                 }
                                                 if($mytl[28] == 'PPC' & $mytl[33] == 'PPC') {
                                          ?>
                                           <a href="processApproval.php?worecnum=<?php echo $worecnum ?>&wfrecnum=<?php echo $mytl[9] ?>&drecnum=<?php echo $mytl[8] ?>&typerecnum=<?php echo $typenum ?>&nextstatus=<?php echo $mytl[30] ?>&stagenum=<?php echo $mytl[31] ?>"><img src="images/bu_approval.gif" border=0>  </a>
                                          <?php
                                                 }
                                                 if($mytl[28] == 'CAD/CAM' & $mytl[33] == 'CAD/CAM') {
                                          ?>
                                            <a href="processApproval.php?worecnum=<?php echo $worecnum ?>&wfrecnum=<?php echo $mytl[9] ?>&drecnum=<?php echo $mytl[8] ?>&typerecnum=<?php echo $typenum ?>&nextstatus=<?php echo $mytl[30] ?>&stagenum=<?php echo $mytl[31] ?>"><img src="images/bu_approval.gif" border=0>  </a>

                                          <?php
                                                 }
                                                 if($mytl[28] == 'Production' & $mytl[33] == 'Production') {
                                          ?>
                                            <a href="processApproval.php?worecnum=<?php echo $worecnum ?>&wfrecnum=<?php echo $mytl[9] ?>&drecnum=<?php echo $mytl[8] ?>&typerecnum=<?php echo $typenum ?>&nextstatus=<?php echo $mytl[30] ?>&stagenum=<?php echo $mytl[31] ?>"><img src="images/bu_approval.gif" border=0>  </a>

                                           <?php
                                                 }
                                                 if($mytl[28] == 'QA' & $mytl[33] == 'QA') {
                                          ?>
                                            <a href="processApproval.php?worecnum=<?php echo $worecnum ?>&wfrecnum=<?php echo $mytl[9] ?>&drecnum=<?php echo $mytl[8] ?>&typerecnum=<?php echo $typenum ?>&nextstatus=<?php echo $mytl[30] ?>&stagenum=<?php echo $mytl[31] ?>"><img src="images/bu_approval.gif" border=0>  </a>

                                          <?php
                                               }else if($mytl[28] != $mytl[33]){
                                          ?>
                                            <?php //echo $mytl[28], $mytl[33] ?><img src="images/bu_approval.gif" border=0>
                                          <?php
                                               }
                                                }

                                          ?>

                                          <?php echo $mytl[16] ?></td>



                <td  WIDTH=6%><span class="tabletext"><a href ="woDetails.php?wonum=<?php echo $wonum ?>&position=bottom&worecnum=<?php echo $worecnum?>&dept=<?php echo $mytl[1]?>&rownum=<?php echo $id?>" TITLE="Add Notes">Add Notes</td>
                 <td><span class="heading"><? //php echo $mytl[29] ?></td>
<?php
            }
            else {
                    if ($mytl[18] != '')
                    {
?>
                    <td WIDTH=9%><span class="heading"><?php echo $mytl[18] ?></td>

<?php
                    }
                    else
                    {
?>
                        <td WIDTH=9%><span class="heading"><?php echo $mytl[16] ?></td>
<?php
                    }
            }
?>
        </tr>
<?php

      $department= $mytl[28];
          }
?>

</table>
</td>

    <td><img src="images/spacer.gif " height="6"></td>


      <table width=100% border=0 cellpadding=0 cellspacing=0  >
							<tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/spacer.gif " width="6"></td>
								<td bgcolor="#FFFFFF">

           <table width=100% border=0 cellpadding=6 cellspacing=0  >
			  <tr><td>


        <?php
                  if($dept=='')
                    {

                    }

                      else
                      {

                            $dept=$_REQUEST['dept'];


                     ?>

										 <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

                                        <?php
                                                   printf('<tr  bgcolor="#DDDEDD"><td colspan=8><span class="heading"><b>Notes for %s Milestone</b></center></td></tr>',$dept);
                                                   $result = $newwo->getNotes4milestone($worecnum,$dept);
                                                   printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes" rows="6" cols="88"  readonly="readonly">');
                                                   while ($mynotes = mysql_fetch_row($result)) {
                                                         printf("\n");
                                                         printf("********Added by $mynotes[2] on $mynotes[0] *********** ");
                                                         printf("\n");
                                                         printf($mynotes[1]);
                                                         printf("   \n");
                                                         }
                                         ?>
                                                         </tr>
                                       </textarea></td>

			 </table>

                                    	</td></tr>

										<tr>
											<td>
  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
												       <tr bgcolor="#EEEFEE"><span class="heading"><td colspan=4><b>Add Notes</b></center></td></tr>
                                                       <tr bgcolor="#FFFFFF"  >
                                                           <td colspan=4><textarea name="spec_instrns" rows="3" cols="88%" value=""></textarea>
             	                                           <input type="hidden" name="worecnum" value="<?php echo $worecnum ?>" >
             	                                           <input type="hidden" name="dept" value="<?php echo $dept ?>" >
             	                                           <input type="hidden" name="wonum" value="<?php echo $wonum ?>" >
                                                           <input type="hidden" name="position" value="<?php echo "bottom" ?>" >
                                                        </td> </tr>
            									</table>
 											</td>
			 </tr>
                           <?php
                        }
                       ?>
         </table>

<!--</div>-->
</body>
