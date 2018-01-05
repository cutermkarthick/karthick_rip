<?php
// First include the class definition
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}

include('classes/reportClass.php');

$newnc = new report;

//$nc4qarecnum = $_REQUEST['nc4qarecnum'];


//echo $nc4qarecnum."***-*-*";
//$myrow = mysql_fetch_row($result);
$header='';
$data='';
$username=trim($_SESSION['username']);
$crnnum = trim($_REQUEST['crnum']);
$wonum = trim($_REQUEST['wonum']);
$nctype = trim($_REQUEST['nctype']);
$stage = trim($_REQUEST['stage']);
$cause = trim($_REQUEST['cause']);
$error_type = trim($_REQUEST['error_type']);
$disposition = trim($_REQUEST['disposition']);
$fdate = trim($_REQUEST['fdate']);
$tdate = trim($_REQUEST['tdate']);
$str='';

	if($fdate !='')
	{
 $fromdate=$fdate;
 $datearr = split('-',$fromdate);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $dfdate=date("M j, Y",$x);
	}
	else
	{
 $fromdate='0000-00-00';
 $dfdate='';
	}
	if($tdate !='')
	{
 $todate= $tdate;
 $datearr = split('-',$todate);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $dtdate=date("M j, Y",$x);
	}
	else
	{
 $todate='0000-00-00';
 $dtdate='';
	}
//echo $cause."-------";
$data .='<html><head><style type="text/css">
			.Heading {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9pt; font-style: normal; line-height: normal;
font-weight: font-variant: normal; text-transform: none; color: #000000}

.pageheading {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9pt; font-style: normal; line-height: normal;
font-weight: font-variant: normal; text-transform: none; color: #000000}

.labeltext {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pt; font-style: normal;
line-height: normal; font-weight: bold; font-variant: normal; text-transform: none; color: #000000}

.tabletext {  font-family: Verdana, sans-serif; font-size: 8pt; font-style: normal;
line-height: normal; font-weight: normal; font-variant: normal; text-transform: none; color: #000000}

.linktext {  font-family: Verdana, sans-serif; font-size: 9pt; font-style: normal;
line-height: normal; font-weight: normal; font-variant: normal; text-transform: none; color: #0066CC}

.welcome {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10pt; font-style: normal;
line-height: normal; font-weight: normal; font-variant: normal; text-transform: none; color: #000000}

.customer {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10pt; font-style: normal;
line-height: normal; font-weight: normal; font-variant: normal; text-transform: none; color: #00FFCC}

.ptext {  font-family: Verdana, sans-serif; font-size: 9pt; font-style: normal;
line-height: normal; font-weight: bold; font-variant: normal; text-transform: none; color: #000000}

			</style></head>';
$data.='<body>';
$curdate = date("Y-m-d");
$datearr = split('-',$curdate);
              $d=$datearr[2];
              $m=$datearr[1];
              $y=$datearr[0];
              $x=mktime(0,0,0,$m,$d,$y);
              $cur_date=date("M j, Y",$x);
if($dfdate=='' && $dtdate=='')
{
 $title="NC4QA Export";
}
else if($dfdate!='' && $dtdate=='')
{
 $title="NC4QA Export From ".$dfdate ." To Till Date ";
}
else
{
 $title="NC4QA Export From ".$dfdate ." To ". $dtdate;
}
$data.='<table border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" rules="all">';
$data.='<tr bgcolor="#FFFFFF">';
$data.='<td colspan=15 bgcolor="#00DDFF" align="center"><span class="tabletext"><font size="2" ><b>';
$data.=$title.'</b></font>';
$data.='</td>';
$data.='</tr>';
$data.='</table>';
$data.='<br>';

date_default_timezone_set('Asia/Calcutta');
$todate1 = date("Y-m-d");
$today = split('-',$todate1);
$days = $today[2]-1;
$fromdate1 = date("Y-m-d",strtotime("-$days days"));
$cond0 = "nc.refnum like '".$crnnum."%'";
$cond1 = "nc.wonum like '".$wonum."%'";

if ( $fdate!='' || $tdate!='' )
{
     $date1_match = $fdate;
     $date2_match = trim($tdate);
     if ( $fdate!='' )
     {
          $date1 = $fdate;
          $cond01 = "to_days(nc.create_date) " . "> to_days('" . $date1 . "')";
     }
     else
     {
          $cond01 = "(to_days(nc.create_date)-to_days('1582-01-01') > 0 || nc.create_date is NULL || nc.create_date = '0000-00-00')";
     }

     if (trim($tdate!=''))
     {
          $date2 = trim($tdate);
         // echo"H--e---e--r--";
          $cond02 = "to_days(nc.create_date) " . "< to_days('" . $date2 . "')";
     }
     else
     {   //echo"H--e---e-999-r--";
          $cond02 = "(to_days(nc.create_date)-to_days('2050-12-31') < 0 || nc.create_date is NULL || nc.create_date = '0000-00-00')";
     }
     $cond4 = $cond01 . ' and ' . $cond02;
    //echo $cond02."---";
}
else
{
/*$cond01 = "to_days(create_date) " . ">= to_days('" . $fromdate1 . "')";
$cond02 = "to_days(create_date) " . "<= to_days('" . $todate1 . "')";
$cond4 = $cond01 . ' and ' . $cond02;*/
$cond4 = "(to_days(nc.create_date)-to_days('1582-01-01') > 0 ||
                    nc.create_date is NULL ||
                    nc.create_date ='0000-00-00') and
          (to_days(nc.create_date)-to_days('2050-12-31') < 0 ||
                   nc.create_date = '0000-00-00' ||
                 nc.create_date is NULL)";
}
if($nctype !='')
{
      $sval = $nctype;

      if ($sval== 'Cust NC')
      {
         $cond6 = "nc.cust_end = 'yes'";
      }
     else if ($sval == 'CIM NC')
      {
         $cond6 =  "(nc.cust_end = 'no' || nc.cust_end = 'null' || nc.cust_end = '')";
      }
     else if ($sval == 'All')
      {
         $cond6 = "nc.recnum like '%'";
      }

}
else
{
     $sval = 'All';
     $cond6 = "nc.recnum like '%'";
}

if($stage !=''  )
{
     $svalst = $stage;

      if ($svalst== 'In Process')
      {
         $cond7 = "nc.inprocess = 'yes'";
      }
     else if ($svalst == 'Final Inspection')
      {
         $cond7 =  "nc.final_insp = 'yes'";
      }
      else if ($svalst == 'Customer End')
      {
         $cond7 =  "nc.cust_end = 'yes'";
      }
     else if ($svalst == 'All')
      {
         $cond7 = "nc.recnum like '%'";
      }

}
else
{
     $svalst = 'All';
     $cond7 = "nc.recnum like '%'";
}
if($disposition !=''  )
{
     $svaldi = trim($disposition);

      if ($svaldi== 'Accepted')
      {
         $cond8 = "nc.accepted = 'yes'";
      }
     else if ($svaldi == 'Rejected')
      {
         $cond8 =  "nc.rejected = 'yes'";
      }
      else if ($svaldi == 'Quarantined')
      {
         $cond8 =  "nc.quarantined = 'yes'";
      }
      else if ($svaldi == 'Rework')
      {
         $cond8 =  "rework = 'yes'";
      }

     else if ($svaldi == 'All')
      {
         $cond8 = "nc.recnum like '%'";
      }

}
else
{
     $svaldi = 'All';
     $cond8 = "nc.recnum like '%'";
}
if($cause !='' )
{      //echo"HERE--999--";
     $svalc = trim($cause);
      // echo"HERE--$svalc---999--";
      if ($svalc== 'Man')
      {
         $cond9 = "man = 'yes'";
      }
     else if ($svalc == 'Machine')
      {
         $cond9 =  "nc.machine = 'yes'";
      }
      else if ($svalc == 'Method')
      {
         $cond9 =  "nc.method = 'yes'";
      }
     else if ($svalc=='All')
      {
         $cond9 = "nc.recnum like '%'";
          //echo "c--a--u--s--e---- $cond9";
      }

}
else
{  //echo"here";
     $svalc = 'All';
     $cond9 = "nc.recnum like '%'";
}
if($error_type !='' )
{
     $svaler = $error_type;

      if ($svaler== 'Dimensional Deviation')
      {
         $cond10 = "nc.dim_deviation = 'yes'";
      }
     else if ($svaler == 'Material Deviation')
      {
         $cond10 =  "nc.mat_deviation = 'yes'";
      }
      else if ($svaler == 'Other')
      {
         $cond10 =  "nc.other_deviation = 'yes'";
      }
     else if ($svaler == 'All')
      {
         $cond10 = "nc.recnum like '%'";
      }

}
else
{
     $svaler = 'All';
     $cond10 = "nc.recnum like '%'";
}


if(isset ($_REQUEST['status_val'] ) )
{
     $status_val = $_REQUEST['status_val'];

      if ($status_val== 'Open')
      {
         $cond11 = "(nc.status = '" . $status_val . "' || nc.status is NULL ||nc.status = '')";
      }
     else if ($status_val == 'Closed')
      {
         $cond11 = "nc.status = '" . $status_val . "'" ;
      }
     else if ($status_val == 'All')
      {
         $cond11 = "(nc.status like '%' || nc.status is NULL)";
      }
     else if ($status_val == 'Pending')
      {
         $cond11 = "nc.status = '" . $status_val . "'" ;
      }
}
else
{
     $status_val = 'Open';
     $cond11 = "(nc.status = '" . $status_val . "' || nc.status is NULL || nc.status = '')";
}


$cond = $cond0 . ' and ' . $cond1 .' and ' . $cond4 . ' and ' . $cond6 . ' and ' . $cond7 . ' and ' . $cond8 . ' and ' . $cond9 . ' and ' . $cond10. ' and ' . $cond11;


//$cond = $cond0 . ' and ' . $cond1 . ' and ' . $cond4 . ' and ' . $cond6;

 $data.='

<table width=800px border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF"  rules="all">
<tr  bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>NC No.</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>PRN</b></td>  
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>M/C Name</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Stage</b></td>

			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Operator</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Supervisor<br>Name</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>RM Cost</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Cust NC Date</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>DC.No</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>DC Date</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Cofc No.</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Customer</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>PO No.</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>PartName</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Batch No.</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Part No.</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Matl Spec.</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Part SI.No</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Issue & PS</b></td>

            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Cause</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Error Type</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Disposition</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Status</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>WO No.</b></td>

			 <td  bgcolor="#EEEFEE"><span class="tabletext"><b>WO<br/>Qty</b></td>

			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>WO Type.</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>DN #</b></td>


            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Rej<br>Qty</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Rew<br>Qty</b></td>                 
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Create Date</b></td>           
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Description</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Root Cause</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Corrective Action</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Preventive Action</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>Effectiveness</b></td>
			<td  bgcolor="#EEEFEE"><span class="tabletext"><b>Remarks</b></td>
			</tr>';
			$months=array( 'Jan','Feb','Mar','April','May','June','July','Aug','Sept','Oct','Nov','Dec' );
$result = $newnc->getqanc4excel($cond);
     $i = 1;
      while ($myrow = mysql_fetch_row($result))
      {       $data.='<tr bgcolor="#FFFFFF">';
				$datearr1 = split('-', $myrow[5]);
				$month=$datearr1[1];
                $year=$datearr1[0];
                $day=$datearr1[2];
				if($myrow[5]!='')
				{
                $cdate=$months[$month-1].' '.$day.','.$year;
				}
				else{
				$cdate='';
				}
              $desc = wordwrap($myrow[7],15,"\n");
              $rootcause = wordwrap($myrow[10],15,"\n");
              $correctiveaction = wordwrap($myrow[11],15,"\n");
              $preventiveaction = wordwrap($myrow[12],15,"\n");
              $effectiveness = wordwrap($myrow[9],15,"\n");
			  $status = $myrow['status'];
			
              if($myrow[13]=='yes')
              {
                $stage='In Process';
              }
              else if($myrow[14]=='yes')
              {
                 $stage='Final Inspection';
              }
              else if($myrow[15]=='yes')
              {
                 $stage='Customer End';
              }
              
              if($myrow[17]=='yes')
              {
                $disposition='Accepted';
              }
              else if($myrow[18]=='yes')
              {
                 $disposition='Rejected';
              }
              else if($myrow[19]=='yes')
              {
                 $disposition='Quarantined';
              }			
			   else if($myrow[28]=='yes')
              {
                 $disposition='Rework';
              }
              else
              {
                 $disposition='';
              }
              if($myrow[20]=='yes')
              {
                $cause='Man';
              }
              else if($myrow[21]=='yes')
              {
                 $cause='Machine';
              }
              else if($myrow[22]=='yes')
              {
                 $cause='Method';
              }
              else
              {
                 $cause='';
              }
               if($myrow[23]=='yes')
              {
                $errtype='Dimensional Deviation';
              }
              else if($myrow[24]=='yes')
              {
                 $errtype='Material Deviation';
              }
              else if($myrow[25]=='yes')
              {
                 $errtype='Other Deviation';
              }
              else
              {
                 $errtype='';
              }
           $rejqty = 0;
		   $rewqty = 0;		
           if ($disposition == 'Rejected')
		   {
			   $rejqty = $myrow[8];
		   }
		   if ($disposition == 'Rework')
			{
				$rewqty = $myrow[8];
		    }
		
			$str = ltrim($myrow[27], ',');
			$var=split(',',$str);
		
		    $v1=implode(',<br/> ',$var);	
			$wotype=wordwrap($myrow[29],11,"<br/>\n",true);

			$datearr = split('-', $myrow[34]);
				$month=$datearr[1];
                $year=$datearr[0];
                $day=$datearr[2];

			
				
				if($myrow[34]!='' && $myrow[34]!='0000-00-00')
				{
                $cust_nc_date=$months[$month-1].' '.$day.','.$year;
				}
				else{
				$cust_nc_date='';
				}

					$datearr = split('-', $myrow[36]);
				$month=$datearr[1];
                $year=$datearr[0];
                $day=$datearr[2];
				
				if($myrow[36]!='' && $myrow[36]!='0000-00-00')
				{
                $dc_date=$months[$month-1].' '.$day.','.$year;
				}
				else{
				$dc_date='';
				}
				$oper_name=wordwrap($myrow[31],11,"<br/>\n",false);
				$super_name=wordwrap($myrow[32],11,"<br />\n",false);

		

				$ponum=wordwrap($myrow[39],10,"<br/>\n",true);
				$partname=wordwrap($myrow[40],10,"<br/>\n",true);
				$batch_num=wordwrap($myrow[41],10,"<br  />\n",true);
				$customer=wordwrap($myrow[38],10,"<br  />\n",false);

				$partnum=wordwrap($myrow[42],10,"<br />\n",true);
				$matl_spec=wordwrap($myrow[43],10,"<br />\n",true);
				$issue_ps=wordwrap($myrow[45],10,"<br />\n",true);
				$errtype1=wordwrap($errtype,11,"<br  />\n",true);
				$remarks=wordwrap($myrow[46],15,"<br  />\n",true);



	$data.='<td bgcolor="#EEEFEE" >'. $myrow[0].'</td>';
	$data.='<td bgcolor="#EEEFEE" >'. $myrow[2].'</td>';
	$data.='<td bgcolor="#EEEFEE">'.$v1.'</td>';
	$data.='<td bgcolor="#EEEFEE">'.$stage.'</td>';
	$data.='<td bgcolor="#EEEFEE" >'.$oper_name.'</td>';
	$data.='<td bgcolor="#EEEFEE" >'.$super_name.'</td>';
	$data.='<td bgcolor="#EEEFEE" >'.$myrow[33].'</td>';
 	$data.='<td bgcolor="#EEEFEE">'.$cust_nc_date.'</td>';
	$data.='<td bgcolor="#EEEFEE" >'.$myrow[35].'</td>';
	$data.='<td bgcolor="#EEEFEE" >'.$dc_date.'</td>';
    $data.='<td bgcolor="#EEEFEE" >'.$myrow[37].'</td>';
	$data.='<td  bgcolor="#EEEFEE" >'.$customer .'</td>';
	$data.='<td  bgcolor="#EEEFEE"><pre>'.$ponum.'</pre></td>
           <td bgcolor="#EEEFEE"><pre>'.$partname.'</pre></td>
           <td bgcolor="#EEEFEE"><pre>'.$batch_num.'</pre></td>
           <td  bgcolor="#EEEFEE"><pre>'.$partnum.'</pre></td>
           <td  bgcolor="#EEEFEE"><pre>'.$matl_spec.'</pre></td>';

		   	$data.='<td  bgcolor="#EEEFEE"><pre>'.$myrow[44].'</pre></td>
           <td bgcolor="#EEEFEE"><pre>'.$issue_ps.'</pre></td>
           <td bgcolor="#EEEFEE"><pre>'.$cause.'</pre></td>
		    <td bgcolor="#EEEFEE"><pre>'.$errtype1.'</pre></td>
           <td  bgcolor="#EEEFEE"><pre>'.$disposition.'</pre></td>
           <td  bgcolor="#EEEFEE"><pre>'.$status.'</pre></td>';

		   $data.='<td  bgcolor="#EEEFEE"><pre>'.$myrow[1].'</pre></td>
           <td bgcolor="#EEEFEE"><pre>'.$myrow[47].'</pre></td>
           <td bgcolor="#EEEFEE"><pre>'.$wotype.'</pre></td>
           <td  bgcolor="#EEEFEE"><pre>'.$myrow[30].'</pre></td>
           <td  bgcolor="#EEEFEE"><pre>'.$rejqty.'</pre></td>';

		   $data.='<td  bgcolor="#EEEFEE"><pre>'.$rewqty.'</pre></td>
           <td bgcolor="#EEEFEE"><pre>'.$cdate.'</pre></td>
           <td bgcolor="#EEEFEE"><pre>'.$desc.'</pre></td>
           <td  bgcolor="#EEEFEE"><pre>'.$rootcause.'</pre></td>
           <td  bgcolor="#EEEFEE"><pre>'.$correctiveaction.'</pre></td>';
		   $data.='<td bgcolor="#EEEFEE" >'. $preventiveaction.'</td>';
		   $data.='<td bgcolor="#EEEFEE" >'. $effectiveness.'</td>';
		   $data.='<td bgcolor="#EEEFEE" >'. $remarks.'</td>';
	$data.='</tr>';
	$data.='</tr>';
	$i++;
    }
$data.='
    </table>
</form>
</body>
</html>';

header("Content-type: application/x-msdownload",true);
header("Content-Disposition: attachment; filename=nc4qaDetails.xls",false);
header("Pragma: no-cache");
header("Expires: 0");

print "$header\n$data";

?>