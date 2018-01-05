<?php
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}

include_once('classes/userClass.php');
include_once('classes/loginClass.php');
include('classes/workorderClass.php');
$newworkOrder = new workOrder;
$newlogin = new userlogin;
$newlogin->dbconnect();
//$username = $_SESSION['user'];
$header='';
$data='';

$username=$_SESSION['username'] ;
$cond=$_SESSION['cond'] ;
$sort1=$_SESSION['sort1'] ;
$sort2=$_SESSION['sort2'];
$offset=$_SESSION['offset'] ;
$rowsPerPage=$_SESSION['rowsPerPage'] ;
$str='';
$result = $newworkOrder->getWorkOrders($username,$cond,$sort1,$sort2,$offset, $rowsPerPage);
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
   	       $data .= '<table width=100% border=1 cellpadding=3 cellspacing=1 >';
   	       $data .= '<tr><td><span class="pageheading"><center><b>List of Work Orders</b></center></td></tr>';
   	       $data .= '<tr><td>';
   	       $data .= '<table width=100% border=1 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >';
   	       $data .= '<tr><td bgcolor="#C0C0C0"><span class="heading"><b>WO</b></td>';
   	       $data .= '<td bgcolor="#C0C0C0"><span class="heading"><b><center>Company</center></b></td>';
   	       $data .= '<td bgcolor="#C0C0C0"><span class="heading"><b><center>Designer</center></b></td>';
   	       $data .= '<td bgcolor="#C0C0C0"><span class="heading"><b><center>Type</center></b></td>';
   	       $data .= '<td bgcolor="#C0C0C0"><span class="heading"><b><center>Cust PO</center></b></td>';
   	       $data .= '<td bgcolor="#C0C0C0"><span class="heading"><b>Quote</b></td>';
           $data .= '<td bgcolor="#C0C0C0"><span class="heading"><b>Book Date</b></td>';
   	       $data .= '<td bgcolor="#C0C0C0"><span class="heading"><b>BOM#</b></td>';
   	       $data .= '<td bgcolor="#C0C0C0"><span class="heading"><b><center>Stage</center></b></td>';
   	       $data .= '<td bgcolor="#C0C0C0"><span class="heading"><b><center>Sch Due</center></b></td>';
   	       $data .= '<td bgcolor="#C0C0C0"><span class="heading"><b><center>Rev. Ship</center></b></td>';
   	       $data .= '<td bgcolor="#C0C0C0"><span class="heading"><b><center>Act. Ship</center></b></td></tr>';


	$flag=0;
	while ($myrow = mysql_fetch_row($result))
		{
		if ($flag == 0)
			{
   	       $data .= '<tr><td rowspan=3 bgcolor="#FFFFFF"><span class="tabletext">' .$myrow[0]. '</td>';
               $flag = 1;
	       $data .= '<td bgcolor="#FFFFFF"><span class="tabletext">' .$myrow[2]. '</td>';
	       $data .= '<td bgcolor="#FFFFFF"><span class="tabletext">' .$myrow[13]. '</td>';
	       $data .= '<td bgcolor="#FFFFFF"><span class="tabletext">' .$myrow[1]. '</td>';
	       $data .= '<td bgcolor="#FFFFFF"><span class="tabletext">' .$myrow[3]. '</td>';
	       $data .= '<td bgcolor="#FFFFFF"><span class="tabletext">' .$myrow[4]. '</td>';
	       $data .= '<td bgcolor="#FFFFFF"><span class="tabletext">' .$myrow[16]. '</td>';
           $data .= '<td bgcolor="#FFFFFF"><span class="tabletext">' .$myrow[19]. '</td>';
           $worecnum=$myrow[11];
	       //$data .= '<td bgcolor="#FFFFFF"><span class="tabletext"><a href="wo2po.php?worecnum=' .$worecnum. '&wonum=' .$myrow[0]. '">View Po</td>';
		if ($myrow[5]=='')
			$str="&nbsp;";
		else
			$str=$myrow[5];
	       $data .= '<td bgcolor="#FFFFFF"><span class="tabletext">' .$str. ' </td>';
	       if ($myrow[14] != '00-00-00')
			$str= $myrow[14];
		if ($str=='')
			$str="&nbsp;";
	       $data .= '<td bgcolor="#FFFFFF"><span class="tabletext">' .$str. '</td>';
		if ($myrow[17] != '00-00-00')
			$str= $myrow[17];
		if ($str=='')
			$str="&nbsp;";

	       $data .= '<td bgcolor="#FFFFFF"><span class="tabletext">' .$str. '</td>';
		if ($myrow[15] != '00-00-00')
			$str= $myrow[15];
		if ($str=='')
			$str="&nbsp;";

	       $data .= '<td bgcolor="#FFFFFF"><span class="tabletext">' .$str. '</td></tr>';
	       $data .= '<tr><td colspan=11 bgcolor="#FFFFFF"><span class="heading">Description:<span class="tabletext">' .$myrow[12]. '</td></tr></tr>';

             $data .= '<td colspan=2 bgcolor="#FFFFFF"><span class="heading">Attachments:- </td>';
             $data .= '<td bgcolor="#FFFFFF" ><span class="tabletext">File1: <span class="tabletext">' .$myrow[21]. '</td>';
		     $data .= '<td bgcolor="#FFFFFF" ><span class="tabletext">File2: <span class="tabletext">' .$myrow[22]. '</td>';
		     $data .= '<td bgcolor="#FFFFFF" ><span class="tabletext">File3: <span class="tabletext">' .$myrow[23]. '</td>';
		     $data .= '<td bgcolor="#FFFFFF" ><span class="tabletext">File4: <span class="tabletext">' .$myrow[24]. '</td>';
             $data .= '<td bgcolor="#FFFFFF" colspan=5>';
             /*
             $result1 = $newworkOrder->getAttachedfile($myrow[11]);
	            while ( $myrow1 = mysql_fetch_assoc($result1)) {
	                    if($myrow[11]==$myrow1["link2wo"]){
                       $data .='<tr><td bgcolor="#FFFFFF" ><span class="heading">Attachments:<td bgcolor="#FFFFFF" ><span class="tabletext">' . $myrow1["filename1"] . '</td><td bgcolor="#FFFFFF" >' . $myrow1["filename2"] . '</td><td bgcolor="#FFFFFF" >' . $myrow1["filename3"] . '<td bgcolor="#FFFFFF">' . $myrow1["filename4"] . '</td><td bgcolor="#FFFFFF" colspan=5>';
		                }
		                else
                       $data .= '<td colspan=13  bgcolor="#FFFFFF" ></td>';}
               */
             }

             else
             {
	       $data .= '<tr bgcolor="#FFFFCC"><td rowspan=3><span class="tabletext">' .$myrow[0]. '</td>';
                $flag = 0;

	       $data .= '<td><span class="tabletext">' .$myrow[2]. '</td>';
	       $data .= '<td><span class="tabletext">' .$myrow[13]. '</td>';
	       $data .= '<td><span class="tabletext">' .$myrow[1]. '</td>';
	       $data .= '<td><span class="tabletext">' .$myrow[3]. '</td>';
	       $data .= '<td><span class="tabletext">' .$myrow[4]. '</td>';
		   $data .= '<td><span class="tabletext">' .$myrow[16]. '</td>';
           $data .= '<td><span class="tabletext">' .$myrow[19]. '</td>';
        $worecnum=$myrow[11];
	       //$data .= '<td><span class="tabletext"><a href="wo2po.php?worecnum=' .$worecnum. '&wonum=' .$myrow[0]. '">View Po</td>';
		if ($myrow[5]=='')
			$str="&nbsp;";
		else
			$str=$myrow[5];

	       $data .= '<td><span class="tabletext">' .$str. '</td>';
		if ($myrow[14] != '00-00-00')
			$str= $myrow[14];
		if ($str=='')
			$str="&nbsp;";

	       $data .= '<td><span class="tabletext">' .$str. '</td>';
		if ($myrow[17] != '00-00-00')
			$str= $myrow[17];
		if ($str=='')
			$str="&nbsp;";

	       $data .= '<td><span class="tabletext">' .$str. '</td>';
		if ($myrow[15] != '00-00-00')
			$str=$myrow[15];
		if ($str=='')
			$str="&nbsp;";

        $data .= '<td><span class="tabletext">' .$str. '</td></tr>';
	       $data .= '<tr bgcolor="#FFFFCC"><td colspan=11><span class="heading">Description:<span class="tabletext">' .$myrow[12]. '</td></tr></tr>';

             $data .= '<td colspan=2 bgcolor="#FFFFCC"><span class="heading">Attachments:- </td>';
             $data .= '<td bgcolor="#FFFFCC" ><span class="tabletext">File1: <span class="tabletext">' .$myrow[21]. '</td>';
		     $data .= '<td bgcolor="#FFFFCC" ><span class="tabletext">File2: <span class="tabletext">' .$myrow[22]. '</td>';
		     $data .= '<td bgcolor="#FFFFCC" ><span class="tabletext">File3: <span class="tabletext">' .$myrow[23]. '</td>';
		     $data .= '<td bgcolor="#FFFFCC" ><span class="tabletext">File4: <span class="tabletext">' .$myrow[24]. '</td>';
             $data .= '<td bgcolor="#FFFFCC" colspan=5>';

            /*
             $result1 = $newworkOrder->getAttachedfile($myrow[11]);
	            while ( $myrow1 = mysql_fetch_assoc($result1)) {
	                    if($myrow[11]==$myrow1["link2wo"]){
                       $data .='<tr><td bgcolor="#FFFFCC" ><span class="heading">Attachments:<td bgcolor="#FFFFCC" ><span class="tabletext">' . $myrow1["filename1"] . '</td><td bgcolor="#FFFFCC" >' . $myrow1["filename2"] . '</td><td bgcolor="#FFFFCC" >' . $myrow1["filename3"] . '<td bgcolor="#FFFFCC">' . $myrow1["filename4"] . '</td><td bgcolor="#FFFFCC" colspan=5>';
		                }
		                else
                       $data .= '<td colspan=13  bgcolor="#FFFFCC" ></td>';}
                */
             }

       }

		header("Content-type: application/x-msdownload",true);
		header("Content-Disposition: attachment; filename=extraction.xls",false);
		header("Pragma: no-cache");
		header("Expires: 0");
		print "$header\n$data";

?>
