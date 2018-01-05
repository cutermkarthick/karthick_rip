<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2004                 =
// Filename: printAssywo.php                   =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// print Assywo details                        =
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
include('classes/assywoClass.php');
include('classes/displayClass.php');
include('classes/assywoliClass.php');
include('classes/assywoli_operClass.php');
include('classes/inassyClass.php');

$worecnum = $_REQUEST['rec'];

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
$newassywo = new assywo;
$newli = new assywo_li;
$newli_oper = new assywo_oper;
$newdisplay = new display;

?>

<link rel="stylesheet" href="style.css">

<html>
<style type="text/css">
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
</style>
<head>
<title></title>
</head>
<?php
$newlogin = new userlogin;
$newlogin->dbconnect();

$result = $newassywo->getAssyWos($worecnum);
$myrow_assywo = mysql_fetch_row($result);

      if($myrow_assywo[2] != '0000-00-00' && $myrow_assywo[2] != '' && $myrow_assywo[2] != 'NULL')
      {
              $datearr = split('-', $myrow_assywo[2]);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
             $wodate=date("M j, Y",$x);
      }
      else
      {
        $wodate = '';
      }
?>
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=5>
<tr bgcolor="#DFDEDF" class="style6">
<?php
if($myrow_assywo[32] == 'Rework')
$wo = "ASSY WORK ORDER($myrow_assywo[32])";
else
$wo = "ASSY WORK ORDER";
?>
  <td width="30%"><span class="style14"><A HREF="javascript:window.print()" ><?php echo $wo?></span></span></td>
   <td width="10%" align="center"><span class="style14">ASSY WO DATE</span></td>
   <td align="center" width="15%"><span class="style14"><?php echo $wodate?></span></td>
  <td width="15%"><span class="style14">ASSY WO#</span></span></td>
  <td width="16%" align="center"><span class="style16"><?php echo $myrow_assywo[1]?></span></td>
</tr>
</table>
</br>
<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=0>
 <tr><td width=30% valign="top"><table border="1" width="100%" bgcolor="#FFFFFF" rules="all" cellspacing="0">
   <tr>
     <td class="style6" >CUSTOMER</td>
     <td class="style6" ><?php echo$myrow_assywo[5]?></td>
   </tr>
   <tr>
     <td><span class="style6">PRN</span></td>
     <td  class="style6"><?php echo $myrow_assywo[3]?></td>
   </tr>
   <tr>
     <td><span class="style6">CUST PO#</span></td>
     <td  class="style6"><?php echo $myrow_assywo[6]?></td>
   </tr>
    <tr>
       <td><span class="style6">CUST PO QTY</span></td>
       <td class="style6"><?php echo $myrow_assywo[7]?></td>
     </tr>
	 <?
	 if($myrow_assywo[32] == 'Rework')
	 {?>
	  <tr>
       <td><span class="style6">REWORK GRN</span></td>
       <td class="style6"><?php echo $myrow_assywo[33]?></td>
     </tr>
	 <?}?>
 </table></td>
   <td width=2%>&nbsp;</td>
   <td width=25% valign="top"><table border="1" width="100%" bgcolor="#FFFFFF" rules="all" cellspacing="0">
     <tr>
       <td><span class="style6">BOM# </span></td>
       <td class="style6"><?php echo $myrow_assywo[11]?></td>
     </tr>
     <tr>
       <td><span class="style6">BOM ISS</span></td>
       <td class="style6"><?php echo $myrow_assywo[12]?></td>
     </tr>
     <tr>
       <td><span class="style6">ASSY PART# </span></td>
       <td class="style6"><?php echo $myrow_assywo[8]?></td>
     </tr>
     <tr>
       <td><span class="style6">ASSY PART ISS</span></td>
       <td class="style6"><?php echo $myrow_assywo[9]?></td>
     </tr>

   </table></td>
   <td width=2%>&nbsp;</td>
   <td width=25% valign="top"><table border="1" width="100%" bgcolor="#FFFFFF"  cellspacing="0">
     <tr>
       <tr>
       <td><span class="style6">ASSY WO QTY</span></td>
       <td class="style6"><?php echo $myrow_assywo[10]?></td>
     </tr>
      <tr>
       <td><span class="style6">DESCRIPTION</span></td>
       <td class="style6"><?php echo $myrow_assywo[17]?></td>
     </tr>
     <tr>
       <td><span class="style6">MPS/A.P.S #</span></td>
       <td class="style6"><?php echo $myrow_assywo[27]?></td>
     </tr>
       <tr>
       <td><span class="style6">MPS/A.P.S Rev</span></td>
       <td class="style6"><?php echo $myrow_assywo[28]?></td>
     </tr>
   </table></td>
   <td width=2%>&nbsp;</td>
   <td width=25% valign="top"><table border="1" width="100%" bgcolor="#FFFFFF"  cellspacing="0">
     <tr>
     <tr>
       <td><span class="style6">DWG #</span></td>
       <td class="style6"><?php echo $myrow_assywo[16]?></td>
     </tr>
       <tr>
       <td><span class="style6">DRG ISS</span></td>
       <td class="style6"><?php echo $myrow_assywo[18]?></td>
     </tr>

     <tr>
       <td><span class="style6">COS</span></td>
       <td class="style6"><?php echo $myrow_assywo[15]?></td>
     </tr>
   </table></td>
</table>
 
 <table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rules=all bordercolor="#000000">
 <tr bgcolor="#DDDEDD">
 <td bgcolor="#DDDEDD" colspan=12><span class="heading"><center><b>Part Details</b></center></td>
 </tr>
         <tr>
             <td width=1%><p align="center"><span class="tabletext"><strong>Line</strong></p></td>
             <td width=1%><p align="center"><span class="tabletext"><strong>Item No</strong></p></td>
             <td width=1%><p align="center"><span class="tabletext"><strong>Part#</strong></p></td>
             <td width=1%><p align="center"><span class="tabletext"><strong>Issue</strong></p></td>
             <td width=1%><p align="center"><span class="tabletext"><strong>Description</strong></p></td>
             <td width=1%><p align="center"><span class="tabletext"><strong>Qty/Assy<strong></p></td>
             <td width=1%><p align="center"><span class="tabletext"><strong>UOM</strong></p></td>
             <td width=1%><p align="center"><span class="tabletext"><strong>Qty For WO</strong></p></td>
             <td width=1%><p align="center"><span class="tabletext"><strong>GRN</strong></p></td>
             <td width=1%><p align="center"><span class="tabletext"><strong>Expiry Date</strong></p></td>
             <td width=1%><p align="center"><span class="tabletext"><strong>Remarks</strong></p></td>
          </tr>

       <?
           $result_li = $newli->get_assy_Li($worecnum);
           while($myrow_li = mysql_fetch_assoc($result_li))
           {
                 printf('<tr>');
                 $linenumber=$myrow_li["linenum"]?$myrow_li["linenum"]:'&nbsp';
                 //echo $myrow_li["itemno"]."---**----";
                 if($myrow_li["itemno"]!=0)
                 {
                    $itemno=$myrow_li["itemno"]?$myrow_li["itemno"]:'&nbsp';
                 }else
                 {
                    $itemno=$myrow_li["itemno"];
                 }

                 $partnum=$myrow_li["partnum"];
                 $issue=$myrow_li["issue"]?$myrow_li["issue"]:'&nbsp';
                 $descr=$myrow_li["descr"]?$myrow_li["descr"]:'&nbsp';
                 $qty=$myrow_li["qty"]?$myrow_li["qty"]:'&nbsp';
                 $uom=$myrow_li["uom"]?$myrow_li["uom"]:'&nbsp';
                 $qty_wo=$myrow_li["qty_wo"]?$myrow_li["qty_wo"]:'&nbsp';
                 $grn=$myrow_li["grn"]?$myrow_li["grn"]:'&nbsp';
                 $exp_date=$myrow_li["exp_date"]?$myrow_li["exp_date"]:'&nbsp';
                 $remarks=$myrow_li["remarks"]?$myrow_li["remarks"]:'&nbsp';

                     //echo $myrow1['stage_num'];
                    echo "<td align=\"center\"><span class=\"tabletext\">$linenumber</td>";
                    echo"<td align=\"center\"><span class=\"tabletext\">$itemno</td>" ;
                    echo"<td align=\"center\"><span class=\"tabletext\">$partnum</td>" ;
                    echo"<td align=\"center\"><span class=\"tabletext\">$issue</td>" ;
                    echo"<td align=\"center\"><span class=\"tabletext\">$descr</td>";
                    echo"<td align=\"center\"><span class=\"tabletext\">$qty</td>";
                    echo"<td align=\"center\"><span class=\"tabletext\">$uom</td>";
                    echo"<td align=\"center\"><span class=\"tabletext\">$qty_wo</td>";
                    echo"<td align=\"center\"><span class=\"tabletext\">$grn</td>";
                    echo"<td align=\"center\"><span class=\"tabletext\">$exp_date</td>";
                    echo"<td align=\"center\"><span class=\"tabletext\">$remarks</td>";
           }

  ?>
         <tr>
       </table>
       
 <!-- <table width=100% border=1  cellspacing=0 rows=all cols=all>
 <tr bgcolor="#DDDEDD">
 <td bgcolor="#DDDEDD" colspan=12><span class="heading"><center><b>Operation Details</b></center></td>
 </tr>
         <tr>
            <td width=1%><p align="center"><span class="tabletext"><strong>Opn #</strong></p></td>
            <td width=1%><p align="center"><span class="tabletext"><strong>Stn</strong></p></td>
            <td width=1%><p align="center"><span class="tabletext"><strong>Operation Desc</strong></p></td>
            <td width=1%><p align="center"><span class="tabletext"><strong>Sign Off</strong></p></td>
            <td width=1%><p align="center"><span class="tabletext"><strong>Remarks</strong></p></td>
         </tr>
          <tr>
    //   <?
      //    $result_assyoper = $newli_oper->get_assy_oper($worecnum);
        //   while($myrow_oper = mysql_fetch_assoc($result_assyoper))
          // {
            //     printf('<tr>');
              //   $oppn_num=$myrow_oper["opnnum"];
                // $stn_num=$myrow_oper["stn"];
              //   $operation_descr=$myrow_oper["oper_descr"];
                // $sign=$myrow_oper["signoff"];
                 //$remarks=$myrow_oper["remarks"];

                     //echo $myrow1['stage_num'];
                   // echo "<td align=\"center\"><span class=\"tabletext\">$oppn_num</td>";
                   // echo"<td align=\"center\"><span class=\"tabletext\">$stn_num</td>" ;
                   // echo"<td align=\"center\"><span class=\"tabletext\">$operation_descr</td>" ;
                    //echo"<td align=\"center\"><span class=\"tabletext\">$sign</td>" ;
                    //echo"<td align=\"center\"><span class=\"tabletext\">$remarks</td>";
           //}

  ?>
         <tr>
       </table> -->
 <!-- <table border=1 bgcolor="#000000" width=100% cellspacing=1 cellpadding=4>
        <tr class="bgcolor2">
            <td colspan=14><span class="heading"><center><b>Part Status</b></center></td>
        </tr>

       <tr class="bgcolor2">
<td><span class="heading" width="4%" ><b><center> Seq</center></b></td>
<td><span class="heading" width="4%"><b><center>Stage</center></b></td>
<td><span class="heading" width="4%"><b><center>From Sl.No</center></b></td>
<td><span class="heading" width="4%"><b><center>To Sl.No</center></b></td>
<td><span class="heading" width="4%"><b><center>Sampling<br>Sl.No.</center></b></td>
<td><span class="heading" width="4%"><b><center>Accept</center></b></td>
<td><span class="heading" width="4%"><b><center>Rework</center></b></td>

<td><span class="heading" width="4%"><b><center>Reject</center></b></td>
<td><span class="heading" width="4%"><b><center>Returns</center></b></td>
<td><span class="heading" width="10%"><b><center>Date</center></b></td>
<td><span class="heading" width="15%"><b><center>Insp No</center></b></td>

<td><span class="heading" width="15%"><b><center>Signoff</center></b></td>
<td><span class="heading" width="40%"><b><center>Remarks</center></b></td>

</tr> -->
<table border=1 bgcolor="#FFFFFF" width=100% cellspacing=0 cellpadding=6 rules=all bordercolor="#000000">
<tr class="bgcolor2" bordercolor="#CCCCCC" > 
            <td colspan=14 bgcolor="#DDDEDD"><span class="heading"><center><b>Part Status</b></center></td>
        </tr>

<td><span class="heading" width="4%"><b><center>Seq</center></b></td>
<td><span class="heading" width="4%"><b><center>Stage</center></b></td>
<td><span class="heading" width="4%"><b><center>From Sl.No</center></b></td>
<td><span class="heading" width="4%"><b><center>To Sl.No</center></b></td>
<td><span class="heading" width="4%"><b><center>Samp.<br>Sl.No.</center></b></td>
<td><span class="heading" width="4%"><b><center>Accept<br />
 </center></b></td>
<td><span class="heading" width="4%"><b><center>Rework<br />
</center></b></td>

<td><span class="heading" width="4%"><b><center>Reject<br />
</center></b></td>
<td><span class="heading" width="4%"><b><center>
  Returns<br />
 </center></b></td>
 <td><span class="heading" width="4%"><b><center>Date</center></b></td>
<td><span class="heading" width="4%"><b><center>Insp No</center></b></td>

<td><span class="heading" width="15%"><b><center>Signoff</center></b></td>
<td><span class="heading" width="40%"><b><center>Remarks</center></b></td>
</tr>
<?php
     $newinassy=new inassy();
	 $resultin = $newinassy->getinassy($worecnum);
	 $row=mysql_fetch_object($resultin);
	 $c=1;
	 $count=8;
	 while($row!=NULL)
	 {
		 $from=$row->fromsl;
		 $seq=$row->line_num;
		 if($seq==0)
		 {
			 $seq="";
		 }
		 if($row->st_date != '' && $row->st_date != '0000-00-00')
		 {
			 $datearr = split('-', $row->st_date);
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
		   echo ("<tr class=bgcolor2>
		   <td width=4%><span class=tabletext> $seq </td>
		   <td width=4%><span class=tabletext>$row->stage</td>
		   <td width=4%><span class=tabletext> $from </td>
		   <td width=4%><span class=tabletext>$row->tosl</td>
		   <td width=4%><span class=tabletext>$row->samplingsl</td>
		   <td width=4%><span class=tabletext>$row->acc</td>
		   <td width=4%><span class=tabletext>$row->rework</td>
		   <td width=4%><span class=tabletext>$row->rej</td>
		   <td width=4%><span class=tabletext>$row->ret</td>
		   <td width=10%><span class=tabletext>$date1</td>
		   <td width=15%><span class=tabletext>$row->inspnum</td>
		   <td width=15%><span class=tabletext>$row->signoff</td>
		   <td width=40%><span class=tabletext>$row->remarks</td>");
		   printf('</tr>');
		   $c=$c+1;
		   $row=mysql_fetch_object($resultin);
	  }
	
$count=$count-$c;
$count=$count+1;
while($count!=0)
{
   echo ('<tr class=bgcolor2 bordercolor=#CCCCCC >

		<td width=4% ><span class=tabletext>&nbsp;<br></td>
			<td width=4% ><span class=tabletext>&nbsp; </td>
			<td width=4% ><span class=tabletext>&nbsp;</td>
			<td width=4% ><span class=tabletext>&nbsp;</td>
			<td width=4% ><span class=tabletext>&nbsp;</td>
			<td width=4% ><span class=tabletext>&nbsp;</td>
			<td width=4% ><span class=tabletext>&nbsp;</td>
			<td width=4% ><span class=tabletext>&nbsp;</td>
			<td width=4% ><span class=tabletext>&nbsp;</td> 
			<td width=10% ><span class=tabletext>&nbsp;</td>
			<td width=20% ><span class=tabletext>&nbsp;</td>
			<td width=20% ><span class=tabletext>&nbsp;</td>
			<td width=30% ><span class=tabletext>&nbsp;</td>');
	         printf('</tr>');
	
	$count=$count-1;
}
	?>
</table>
<table border=3 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#FFFFFF">
        <td colspan=2><span class="labeltext"><?php echo $myrow_assywo[23] ?></td>
            <td colspan=4><span class="labeltext"><?php echo $myrow_assywo[24] ?></td>
            
            <td colspan=2><span class="labeltext">FLUENTWMS</td>
        </tr>
 
</table>



