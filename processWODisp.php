<html>
<head>
<link rel="stylesheet" href="style.css">
<body leftmargin="0"topmargin="0" marginwidth="0">
<div id="woDisp">

<?php

include('classes/loginClass.php');

$pagename = $_SESSION['pagename'];
$dept = $_SESSION['department'];
$userid = $_SESSION['user'];
$wonum=$_REQUEST['wo_num'];
//echo $wonum;
$res_disp_check=getDispdetails($wonum);
//echo mysql_num_rows($res_disp_check);
if(mysql_num_rows($res_disp_check)>1)
{
$result_wo=getInfo($wonum);

//while ($myrow=mysql_fetch_assoc($result_wo))
//{  //echo"$wonum//*/*/*/*/*";
$myrow=mysql_fetch_assoc($result_wo);
//while($myrow=mysql_fetch_assoc($result_wo))
//{
$worecnum=$myrow['recnum'];
$wotype=$myrow['wotype'];
$descr=$myrow['descr'];
$ponum=$myrow['po_num'];
$podate=$myrow['po_date'];
$wo2customer=$myrow['wo2customer'];
$wo2contact=$myrow['wo2contact'];
$wo2employee=$myrow['wo2employee'];
$status=$myrow['status'];
$condition=$myrow['condition'];
$schduedate=$myrow['sch_due_date'];
$reorder=$myrow['reorder'];
$bookdate=$myrow['book_date'];
$partnum=$myrow['partnum'];
$revshipdate=$myrow['revised_ship_date'];
$bomnum=$myrow['bomnum'];
$filename1=$myrow['filename1'];
$filename2=$myrow['filename2'];
$filename3=$myrow['filename3'];
$actshipdate=$myrow['actual_ship_date'];
$batchnum=$myrow['batchnum'];
$woclassif=$myrow['woclassif'];
$worefnum=$myrow['worefnum'];
$remarks=$myrow['remarks'];
$link2mps=$myrow['link2mps'];
$amenddate=$myrow['amendment_date'];
$original_qty=$myrow['original_qty'];
$qty=$myrow['qty'];
$cust_po_line_num=$myrow['cust_po_line_num'];
$treat=$myrow['treatment'];
$type=$myrow['$fai'];
$type_remarks=$myrow['type_remarks'];
$crn=$myrow['crn_num'];
$stage_split=$myrow['stage_split'];
$app=$myrow['approval'];
$app_date=$myrow['approval_date'];
$amendnotes=$myrow['amendment_notes'];
$link2masterdata=$myrow['link2masterdata'];
$grnnum =$myrow['grnnum'];
$poqty =$myrow['po_qty'];



$new_recnum=insertwodisp($wonum,$wotype,$descr,$ponum,$podate,$wo2customer,$wo2employee,$wo2contact,$wo2type,$reorder,
$actshipdate,$schduedate,$status,$bookdate,$revshipdate,$grnnum,$batchnum,$qty,$poqty,$cust_po_line_num,$original_qty,
$treat,$crn,$stage_split,$app,$partnum,$link2masterdata,$woclassif,$worefnum,$amenddate,$amendnotes,$remarks,$stage_split,
$type_remarks,$type,$cust_po_line_num,$condition);
//insertwopart();
//}

$wo4disp = split("\|",$new_recnum);
//echo $worecnum;
$date_info_res=getdateinfo($worecnum);
while($my_date=mysql_fetch_assoc($date_info_res))
{
$doctype=$my_date['doctype'];
$sch_due=$my_date['sch_due'];
$revised=$my_date['revised'];
$completed=$my_date['completed'];
$timetaken=$my_date['timetaken'];
$link2doc=$my_date['link2doc'];
$link2wo=$my_date['link2wo'];
$link2wfconfig=$my_date['link2wfconfig'];
$link2owner=$my_date['link2owner'];
$link2contact=$my_date['link2contact'];
$link2approvedbyowner=$my_date['link2approvedbyowner'];
$link2approvedbycontact=$my_date['link2approvedbycontact'];
$hold_date=$my_date['hold_date'];
$release_date=$my_date['release_date'];
$condition=$my_date['condition'];
$dependency=$my_date['dependency'];
$stagename=$my_date['stagename'];
$stagenum=$my_date['stagenum'];
$dept=$my_date['dept'];
$stagedependency=$my_date['stagedependency'];
//echo"<br>".$link2wo."***---***".$link2doc;

adddates($wo4disp[0],'Aerowings',$doctype,$sch_due,$revised,$completed,$timetaken,$link2doc,$link2wo,$link2wfconfig,$link2owner,
             $link2contact,$link2approvedbyowner,$link2approvedbycontact,$hold_date,$release_date,$condition,$dependency,
             $stagename,$stagenum,$dept,$stagedependency);
}

$result_part=getPartinfo($worecnum);

while($myrow_part=mysql_fetch_assoc($result_part))
{
     $line_num= $myrow_part['line_num'];
	 $from=$myrow_part['fromsl'];
	 $to=$myrow_part['tosl'];
	 $sampling=$myrow_part['samplingsl'];
	 $rework=$myrow_part['rework'];
	 $acc=$myrow_part['acc'];
	 $rej=$myrow_part['rej'];
	 $ret=$myrow_part['ret'];
	 $inspnum=$myrow_part['inspnum'];
	 $stage=$myrow_part['stage'];
	 $signoff=$myrow_part['signoff'];
	 $remarks=$myrow_part['remarks'];
	 $dn=$myrow_part['dn'];
	 $dn_sent=$myrow_part['dn_sent'];
	 $dn_recv=$myrow_part['dn_recv'];
     $cofc_num=$myrow_part['cofc_num'];
	 $supplier_wo=$myrow_part['supplier_wo'];
     $ncnum=$myrow_part['ncnum'];
     $link2wo=$wo4disp[0];
     $st_date=$myrow_part['st_date'];
     //echo"***<br>".$accept.'****<br>'.$reject[1];


insertpart($from, $to, $samplings, $rework, $acc, $rej, $ret, $stage, $inspnum, $signoff, $remarks, $link2wo,
$line_num, $recno, $st_date, $dn, $dn_sent, $dn_recv, $ncnum, $cofc_num, $cofc_date, $supplier_wo);
}


updateCofc($wonum,$wo4disp[1]);
}
else
{
  echo"<tr><td align=\"left\"><a href =\"wo_update4disp.php\" >BACK</a></td></tr>";
  echo"<br>";
  echo "<table border=1><tr><td><font color=#FF0000>";
  die("Work Order Number " . $wonum . " is not dispatched as both Manufacture Only & With Treatment ");
  echo "</td></tr></table>";

}
function getInfo($wonum)
{
  $newlogin = new userlogin;
  $newlogin->dbconnect();
  $sql="select * from work_order where wonum='$wonum'";
  //echo $sql;
  $result=mysql_query($sql);
  return $result;
}
function insertwodisp($wonum,$wotype,$descr,$ponum,$podate,$wo2customer,$wo2employee,$wo2contact,$wo2type,$reorder,
$actshipdate,$schduedate,$status,$bookdate,$revshipdate,$grnnum,$batchnum,$qty,$poqty,$cust_po_line_num,$original_qty,
$treat,$crn,$stage_split,$app,$partnum,$link2masterdata,$woclassif,$worefnum,$amenddate,$amendnotes,$remarks,$stage_split,
$type_remarks,$type,$cust_po_line_num,$condition)
  {
    $newlogin = new userlogin;
    $newlogin->dbconnect();
    $sql = "select nxtnum from seqnum where tablename = 'work_order' for update";
        //echo $sql;
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $sufix = "-A";
		//$strrecnum=sprintf("%03d",$dnrecnum);
		$wo_num=$wonum.$sufix;
		$userid = "'" . $_SESSION['user'] . "'";
        $bomnum = "'".$bomnum."'" ? "'".$bomnum."'" : '0';
        $wonum=$wonumber;
        $wotype = "'" . $wotype . "'";
        $descr =  "'" . $descr . "'";
        $ponum = "'" . $ponum . "'";
        $podate = $podate ? "'" . $podate  . "'" : '0000-00-00';
        $wo2customer ="'". $wo2customer."'"? "'".$wo2customer."'" : 0;
        $wo2employee = "'".$wo2employee."'" ? "'".$wo2employee."'" : 0;
        $wo2contact = "'" .$wo2contact."'";
        $wo2type = "'".$wo2type."'";
        $reorder = "'" . $reorder . "'";
        $actshipdate = $actshipdate ? "'" . $actshipdate  . "'" : '0000-00-00';
        $schduedate = $schduedate ? "'" . $schduedate  . "'" : '0000-00-00';
        $status = "'" . $status . "'";
        $condition = "'" . $condition . "'";
        $bookdate = $bookdate  ? "'" . $bookdate . "'" : '0000-00-00';
        $revshipdate = $revshipdate ? "'" . $revshipdate  . "'" : '0000-00-00';
        $filename1 = "'" . $filename1 . "'";
        $filename2 = "'" . $filename2 . "'";
        $filename3 = "'" . $filename3 . "'";
        $filename4 = "'" . $filename4 . "'";
        $grnnum = "'" . $grnnum . "'";
        $batchnum = "'" . $batchnum . "'";
        $qty = $qty ? $qty : 0;
        $poqty = $poqty?$poqty:0;
        $link2masterdata = "'" . $link2masterdata . "'";
        $partnum = "'" . $partnum . "'";
        $woclassif = "'" . $woclassif . "'";
        $worefnum = "'" . $worefnum . "'";
        $amenddate = $amenddate ? "'" . $amenddate  . "'" : '0000-00-00';
		$amendnotes = "'" . $amendnotes . "'";
        $remarks = "'" . $remarks . "'";
        $link2mps = $link2mps ? $link2mps : 0;
		$original_qty = "'" . $original_qty . "'";
        $cust_po_line_num = "'" . $cust_po_line_num . "'";
        $treat = "'Manufacture Only'";
        $crn =  "'" . $crn . "'";
        $type =  "'" . $fai_type . "'";
        $type_remarks =  "'" . $type_remarks . "'";
        $stage_split =  "'" . $stage_split . "'";
        $app = "'" . $approval . "'";
        $app_date = $approval_date ? "'" . $approval_date . "'" : '0000-00-00';
		        //echo $wo_num."***".$wotype;
        $sql = "select * from work_order where wonum = '$wo_num'";
        //echo $sql;
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
        $sql = "INSERT INTO work_order (
           recnum,
           wonum,
           wotype,
           descr,
           po_num,
           po_date,
           wo2customer,
           status,
           `condition`,
           sch_due_date,
           create_date,
           reorder,
           book_date,
           revised_ship_date,
           bomnum,
           filename1,
           filename2,
           filename3,
           filename4,
           link2masterdata,
           grnnum,
           qty,
           po_qty,
           partnum,
           actual_ship_date,
           batchnum,
           woclassif,
           worefnum,
           remarks,
           formrev,
           link2mps,
		   amendment_date,
		   amendment_notes,
		   original_qty,
		   cust_po_line_num,
		   treatment,
		   fai,
           type_remarks,
           crn_num,
           stage_split,
           approval,
            approval_date)
               VALUES (
               '$objid',
                '$wo_num',
                 $wotype,
                 $descr,
                 $ponum,
                 $podate,
                 $wo2customer,
                 $status,
                 $condition,
                 $schduedate,
                 curdate(),
                 $reorder,
                 $bookdate,
                 $revshipdate,
                 $bomnum,
                 $filename1,
                 $filename2,
                 $filename3,
                 $filename4,
                 $link2masterdata,
                 $grnnum,
                 '$qty',
                 '$poqty',
                 $partnum,
                 $actshipdate,
                 $batchnum,
                 $woclassif,
                 $worefnum,
                 $remarks,
                 'F7000 Rev 04 dt Sep 6, 2010; FAI',
                 $link2mps,
				 $amenddate,
				 $amendnotes,
				 $original_qty,
				 $cust_po_line_num,
				 $treat,
                 $type,
                 $type_remarks,
                 $crn,
                 $stage_split,
                 $app,
                $app_date
               )";
          }
          else {
             echo"<tr><td align=\"left\"><a href =\"wo_update4disp.php\" >BACK</a></td></tr>";
             echo"<br>";
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Work Order Number " . $wonum . " already exists. ");
            echo "</td></tr></table>";
         }
               //echo $sql;
             $result=mysql_query($sql);
            //$row = mysql_fetch_array($result, MYSQL_ASSOC);
           	if(!$result)
	{
		// $sql = "rollback";
		 //$result = mysql_query($sql);
		 die("Insert of Work Order failed...Please report to Sysadmin. " . mysql_error());
	}
	    $sql = "update seqnum set nxtnum = $objid where tablename = 'work_order'";
        $result = mysql_query($sql);
	if(!$result)
	{
		 $sql = "rollback";
		 $result = mysql_query($sql);
		 die("Seqnum insert for work order didn't work...Please report to Sysadmin. " . mysql_error());
	}

        $wo_recnum = $objid;
        $new_wonum = $wo_num;
        return $wo_recnum.'|'.$new_wonum;
  }
  function getPartinfo($worecnum)
  {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql="select * from wo_part_status where link2wo='$worecnum' and (stage='FI'||stage='Final'||stage='final'||stage='fi'||stage='FINAL')";
     // echo $sql;
      $result=mysql_query($sql);
      return $result;

  }
  function insertpart($from, $to, $samplings, $rework, $acc, $rej, $ret, $stage, $inspnum, $signoff, $remarks, $link2wo,
                       $line_num, $recno, $st_date, $dn, $dn_sent, $dn_recv, $ncnum, $cofc_num, $cofc_date, $supplier_wo)
  {
    $from="'".$from."'";
	 $to="'".$to."'";
     $sampling="'".$sampling."'";
     $rework="'".$rework."'";
	 $accept="'".$acc."'";
     $reject="'".$rej."'";
     $returns="'".$ret."'";
     $date = $st_date ? "'" . $st_date  . "'" : '0000-00-00';
	 $inspno="'".$inspnum."'";
	 $stage="'".$stage."'";
     $signoff="'".$signoff."'";
     $remarks="'".$remarks."'";
	 $link2wo=$link2wo;
     $mmline_num=$line_num ? $line_num : 0;
     $dn="'".$dn."'" ? "'".$dn."'" : 0;
     $dn_sent=$dn_sent ? $dn_sent : 0;
     $dn_recv=$dn_recv ? $dn_recv : 0;
     $cofc_num = "'" . $cofc_num . "'";
     $supplier_wo = "'" . $supplier_wo  . "'";
     $ncnum = "'" . $ncnum  . "'";

 $sql="insert into `wo_part_status` (
  `fromsl`,
  `tosl` ,
  `samplingsl` ,
  `rework`,
  `acc` ,
  `rej`,
  `ret`,
  `stage` ,
  `st_date` ,
  `inspnum`,
  `signoff` ,
  `remarks`,
  `link2wo`,
  `line_num` ,
  `dn`,
  `dn_sent`,
  `dn_recv`,
  `cofc_num`,
  `supplier_wo`,
  `ncnum`
)values($from,
$to,
$sampling,
 $rework,
 $accept,
 $reject,
 $returns,
 $stage,
 $date,
 $inspno,
 $signoff,
 $remarks,$link2wo, $mmline_num,$dn,$dn_sent,$dn_recv,$cofc_num,$supplier_wo,$ncnum)";
 //echo $sql;
 $result = mysql_query($sql);
 if(!$result) die("Insert of Part Status failed..Please report to Sysadmin " . mysql_error());
  updatewo_comp_qty($link2wo,$accept);
  }
  function updateCofc($wonum,$new_wonum)
  {
     $newlogin = new userlogin;
     $newlogin->dbconnect();
     $sql="update dispatch d,dispatch_line_items dli
                                                 set dli.wonum='$new_wonum'
                                                 where dli.wonum='$wonum' and
                                                       (d.type='Manufacture Only'||d.type=''||d.type='null') and dli.link2dispatch=d.recnum";
     //echo $sql;
     $result = mysql_query($sql);

  }

   function adddates($inpworecnum,$wotype,$doctype,$sch_due,$revised,$completed,$timetaken,$link2doc,$link2wo,$link2wfconfig,$link2owner,
             $link2contact,$link2approvedbyowner,$link2approvedbycontact,$hold_date,$release_date,$condition,$dependency,
             $stagename,$stagenum,$dept,$stagedependency) {
        $userid = "'" . $_SESSION['user'] . "'";
        $worecnum = $inpworecnum;
        //echo"0000".$inpworecnum;
        $sql = "select nxtnum from seqnum where tablename = 'dates' for update";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum access for Dates didn't work. " . mysql_error());
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;
        $crdate = "'" . date("y-m-d") . "'";
        $type = "'Aerowings'";
        $doctype = "'" . $doctype . "'";
        $schdue = $schduedate = $schdue ? "'" . $schdue  . "'" : '0000-00-00';
        $link2doc = $worecnum;
        $link2wo= $worecnum;
        $link2wfconfig = $link2wfconfig;
        $link2owner = $link2owner? $link2contact : 0;
        $link2contact = $link2contact? $link2contact : 0;
        $condition = "'" . "NA" . "'";
        $link2dwfconfig = $link2dwfconfig;
        $dependency = "'" . $dependency . "'";
        $stagename = "'" . $stagename . "'";
        $stagenum = $stagenum;
        $dept = "'" . $dept . "'";
        $completed=$completed ? "'" . $completed  . "'" : '0000-00-00';
        $link2approvedbyowner=$link2approvedbyowner? $link2approvedbyowner : 0;
        $link2approvedbycontact=$link2approvedbycontact? $link2approvedbycontact : 0;;
       // $stagedependancy = "'" . $this->dependency . "'";

        $sql = "INSERT INTO dates
                         (recnum, type, doctype, sch_due,
                          link2wo, link2doc, link2wfconfig, link2owner,
                          link2contact,`condition`, dependency,
                          stagename, stagenum, dept,
                          stagedependency,completed,link2approvedbyowner,link2approvedbycontact)
                        VALUES
                             ($objid, $type, $doctype, $schdue,
                              $worecnum, $link2doc, $link2wfconfig, $link2owner, $link2contact,$condition,$dependency,$stagename,$stagenum, $dept,
                              $dependency,$completed,$link2approvedbyowner,$link2approvedbycontact
                        )";
       // echo "<br>$sql<br>";
        $result = mysql_query($sql);
           // Test to make sure query worked
        if(!$result) die("Insert to Dates didn't work. " . mysql_error());

         $sql = "update seqnum set nxtnum = $objid where tablename = 'dates'";
         $result = mysql_query($sql);
         // Test to make sure query worked
         if(!$result) die("Seqnum update for Dates didn't work. " . mysql_error());
         return $objid;
     }

 function getPart_info($worecnum)
 {
     $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql="select * from wo_part_status where link2wo='$worecnum'";
      //echo $sql;
      $result=mysql_query($sql);
      return $result;
 }
 function getdisp4wo($wonum)
 {

      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql="select dli.wonum,dli.dispatch_qty,d.relnotenum,d.type
           from dispatch d,dispatch_line_items dli where dli.wonum='$wonum' and
                                                       (d.type = '' or d.type = 'Manufacture Only' or d.type is null) and dli.link2dispatch=d.recnum";
      //echo $sql;
      $result=mysql_query($sql);
      return $result;
 }
 function getdateinfo($worecnum)
 {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql="select * from dates where link2wo=$worecnum";
      //echo $sql;
      $result=mysql_query($sql);
      return $result;
 }
 function getDispdetails($wonum)
 {
     $newlogin = new userlogin;
      $newlogin->dbconnect();
      $sql="select distinct d.type,dli.wonum
                   from dispatch d,dispatch_line_items dli
                   where dli.wonum='$wonum' and dli.link2dispatch=d.recnum";
      //echo $sql;
      $result=mysql_query($sql);
      return $result;
 }
 function updatewo_comp_qty($link2wo,$acc)
 {
      $newlogin = new userlogin;
      $newlogin->dbconnect();
     if($acc == '')
        {
           $comp_qty = 0;
		}
        else
	    {
           $comp_qty = $acc;
		}

        $sql = "update work_order set comp_qty = $comp_qty
                where recnum = $link2wo";
         //echo $sql;
        $result = mysql_query($sql);

        if(!$result) die("Update of wo_comp_qty failed..Please report to Sysadmin " . mysql_error());

 }
?>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<tr>
<td align="left"><a href ="wo_update4disp.php" >BACK</a>
    </tr>
<tr class="bgcolor2">
<td colspan=2><span class="labeltext"><p align="left">Work Order</p></td>
<td colspan=3><span class="tabletext"><?php echo $wo4disp[1] ?></td>

<td colspan=2><span class="labeltext"><p align="left">CIM Ref No.</p></font></td>
<td colspan=3><span class="tabletext"><?php echo $crn ?>

</tr>

<tr  bgcolor="#DDDEDD"><td colspan=20>
<table border=1 bgcolor="#000000" width=100% cellspacing=1 cellpadding=4>

        <tr class="bgcolor2">
            <td colspan=20><span class="heading"><center><b>Part Status</b></center></td>
        </tr>
<tr class="bgcolor2">

<td><span class="heading" width="4%" ><b><center> Seq</center></b></td>
<td><span class="heading" width="4%"><b><center>Stage</center></b></td>
<td><span class="heading" width="4%"><b><center>COFC#</center></b></td>
<td><span class="heading" width="4%"><b><center>SuppWO</center></b></td>
<td><span class="heading" width="4%"><b><center>DN</center></b></td>
<td><span class="heading" width="4%"><b><center>DN Qty Sent</center></b></td>
<td><span class="heading" width="4%"><b><center>DN Qty Recv</center></b></td>
<td><span class="heading" width="4%"><b><center>From Sl.No</center></b></td>
<td><span class="heading" width="4%"><b><center>To Sl.No</center></b></td>
<td><span class="heading" width="4%"><b><center>Sampling<br>Sl.No.</center></b></td>
<td><span class="heading" width="4%"><b><center>Accept</center></b></td>
<td><span class="heading" width="4%"><b><center>Rework</center></b></td>
<td><span class="heading" width="4%"><b><center>Reject</center></b></td>
<td><span class="heading" width="4%"><b><center>NC</center></b></td>
<td><span class="heading" width="4%"><b><center>Returns</center></b></td>
<td><span class="heading" width="10%"><b><center>Date</center></b></td>
<td><span class="heading" width="15%"><b><center>Insp No</center></b></td>
<td><span class="heading" width="15%"><b><center>Signoff</center></b></td>
<td><span class="heading" width="40%"><b><center>Remarks</center></b></td>

</tr>
<tr>
<?php
$resultin=getPart_info($wo4disp[0]);
$row=mysql_fetch_object($resultin);
$c=1;
$count=15;
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
			<td width=4%><span class=tabletext>$row->cofc_num</td>
			<td width=4%><span class=tabletext>$row->supplier_wo</td>
			<td width=4%><span class=tabletext>$row->dn</td>
			<td width=4%><span class=tabletext>$row->dn_sent</td>
			<td width=4%><span class=tabletext>$row->dn_recv</td>
			<td width=4%><span class=tabletext> $from </td>
			<td width=4%><span class=tabletext>$row->tosl</td>
			<td width=4%><span class=tabletext>$row->samplingsl</td>

			<td width=4%><span class=tabletext>$row->acc</td>
			<td width=4%><span class=tabletext>$row->rework</td>
			<td width=4%><span class=tabletext>$row->rej</td>
			<td width=4%><span class=tabletext>$row->ncnum</td>
			<td width=4%><span class=tabletext>$row->ret</td>
			<td width=10%><span class=tabletext>$date1</td>

			<td width=15%><span class=tabletext>$row->inspnum</td>
			<td width=15%><span class=tabletext>$row->signoff</td>
			<td width=40%><span class=tabletext>$row->remarks</td>");
	         printf('</tr>');

	$c=$c+1;
	$row=mysql_fetch_object($resultin);
	}
    ?>
</tr>
</table>
</td></tr>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#DDDEDD">
<td colspan=15><span class="heading"><center><b>Dispatch Line Items</b></center></td>
</tr>
           <td  align=center bgcolor="#EEEFEE"><span class="heading"><b>COFC #</b></td>
            <td  align=center bgcolor="#EEEFEE"><span class="heading"><b>WO#</b></td>
            <td  align=center bgcolor="#EEEFEE"><span class="heading"><b>Disp Qty</b></td>
            <td  align=center bgcolor="#EEEFEE"><span class="heading"><b>Type</b></td>
</tr>
<?php
$i = 0;
$result = getdisp4wo($wo4disp[1]);
        while ($myLI = mysql_fetch_assoc($result)) {
        $wonum = $myLI["wonum"];
        $dispatchqty = $myLI["dispatch_qty"];
        $relnotenum= $myLI["relnotenum"];
        $type=$myLI["type"];

             echo"<tr><td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$relnotenum</td>";
			 echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$wonum</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$dispatchqty</td>";
             echo"<td bgcolor=\"#FFFFFF\"><span class=\"tabletext\">$type</td>";
             $i = $i + 1;
        }
?>
</tr>
</table>
</table>
</div>
</body>
</html>
