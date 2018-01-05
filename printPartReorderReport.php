<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Dec 5 ,2006                  =
// Filename: vendpartReorderReport.php         =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Displays Vend Parts Reorder Report          =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
//////session_register('pagename');


$cond ='';
$worec='';
$oper='like';
$select='BOM #';
$sort1='v.partnum';
$bom_match='';
$where1='';
$part_match='';
$desc_match='';
$vend_match='';
$mfr_match='';
$rate_match='';
$part_oper='like';
$desc_oper='like';
$vend_oper='like';
$mfr_oper='like';
$rate_oper='like';

if ( isset ($_REQUEST['part_match']) ||  isset ($_REQUEST['desc_match']) ||  isset ($_REQUEST['vend_match']) ||  isset ($_REQUEST['mfr_match']))
{
	if ( isset ($_REQUEST['part_match']))
	{
		$part_match = $_REQUEST['part_match'];
		if ($part_match!='' || $part_match!= 1)
		{
		    	if ( isset ( $_REQUEST['part_oper'] ) )
			 {
       			   $part_oper = $_REQUEST['part_oper'];
			 }
		     	else
			 {
         				$part_oper = 'like';
			  }
			if ($part_oper == 'like')
			{
			             $part_match1 = "'" . $_REQUEST['part_match'] . "%" . "'";
			             $cond="v.partnum like" . $part_match1;
			}
			else
			{
		  	     	     $part_match1 = "'" . $_REQUEST['part_match'] . "'";
			             $cond="v.partnum = " . $part_match1;
			 }
		}
	}
	if(isset ($_REQUEST['desc_match']))
	{
		$desc_match=$_REQUEST['desc_match'];
		 if ($desc_match!='')
		 {
		    	if ( isset ( $_REQUEST['desc_oper'] ) )
			{
       				   $desc_oper = $_REQUEST['desc_oper'];
			 }
			else
			{
         				$desc_oper = 'like';
			 }
			  if ($desc_oper == 'like')
			{
			             $desc_match1 = "'" . $_REQUEST['desc_match'] . "%" . "'";
			             if ($cond=='')
				             $cond="v.part_desc like" . $desc_match1;
			              else
				             $cond=$cond . " and v.part_desc like" . $desc_match1;
	                                  }
	                                  else
			  {
	  	     		$desc_match1 = "'" . $_REQUEST['desc_match'] . "'";
			                if ($cond=='')
				             $cond="v.part_desc = " . $desc_match1;
			                else
				             $cond=$cond . " and v.part_desc = " . $desc_match1;
			  }
		}
	}
	if(isset ( $_REQUEST['vend_match'] ))
	{
		$vend_match=$_REQUEST['vend_match'];
		if ($vend_match!='')
		{
		    	if ( isset ( $_REQUEST['vend_oper'] ) )
			{
	       			   $vend_oper = $_REQUEST['vend_oper'];
			 }
		     	else
			{
		         		$vend_oper = 'like';
			 }
			  if ($vend_oper == 'like')
			 {
			             $vend_match1 = "'" . $_REQUEST['vend_match'] . "%" . "'";
			                if ($cond=='')
				             $cond="c.name like" . $vend_match1;
			                else
				             $cond=$cond . " and c.name like" . $vend_match1;

			  }
	               		 else
			 {
  	     			$vend_match1 = "'" . $_REQUEST['vend_match'] . "'";
			                if ($cond=='')
				             $cond="c.name = " . $vend_match1;
			                else
				             $cond=$cond . " and c.name = " . $vend_match1;
			}
		}
	}
	if(isset ( $_REQUEST['mfr_match'] ))
	{
		$mfr_match=$_REQUEST['mfr_match'];
	    	 if ($mfr_match!='')
		 {
		    	if ( isset ( $_REQUEST['mfr_oper'] ) )
			{
		       		   $mfr_oper = $_REQUEST['mfr_oper'];
			 }
		     	else
			{
		         		$mfr_oper = 'like';
			 }
			 if ($mfr_oper == 'like')
			{
			             $mfr_match1 = "'" . $_REQUEST['mfr_match'] . "%" . "'";
			                if ($cond=='')
				             $cond="v.mfr_partnum like" . $mfr_match1;
			                else
				             $cond=$cond . " and v.mfr_partnum like" . $mfr_match1;

			 }
			 else
			{
		  	     	$mfr_match1 = "'" . $_REQUEST['mfr_match'] . "'";
			                if ($cond=='')
				             $cond="v.mfr_partnum = " . $mfr_match1;
			                else
				             $cond=$cond . " and v.mfr_partnum = " . $mfr_match1;

			  }
		}
	}

	if(isset ( $_REQUEST['rate_match'] ))
	{
		$rate_match=$_REQUEST['rate_match'];
        		if ($rate_match!='' )
		{
		    	if ( isset ( $_REQUEST['rate_oper'] ) )
			{
		       		   $rate_oper = $_REQUEST['rate_oper'];
			 }
		     	else
			{
		         		$rate_oper = 'like';
			 }
			 if ($rate_oper == 'like')
			{
			             $rate_match1 = "'" . $_REQUEST['rate_match'] . "%" . "'";
			                if ($cond=='')
				             $cond="v.rate like" . $rate_match1;
			                else
				             $cond=$cond . " and v.rate like" . $rate_match1;

			 }
			 else
			{
		  	     	$rate_match1 = "'" . $_REQUEST['rate_match'] . "'";
			                if ($cond=='')
				             $cond="v.rate = " . $rate_match1;
			                else
				             $cond=$cond . " and v.rate = " . $rate_match1;

			 }
		}
	}



}
else
{
	$cond ="v.partnum like'%'";
}


if (isset($_REQUEST['sort1']))
{
    $sort1 = $_REQUEST['sort1'];
    if ($sort1=='part')
         $sort1= "v.partnum" ;
    else
         $sort1= "c.name" ;
}
include_once('classes/loginClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

// For paging - Added on Dec 6,04

// how many rows to show per page
$rowsPerPage = 6;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if (isset($_REQUEST['page']))
{
	//echo "i am set";
    $pageNum = $_REQUEST['page'];
}
if (isset($_REQUEST['totpages']))
{
    $totpages = $_REQUEST['totpages'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

// First include the class definition
include('classes/vendPartClass.php');
include('classes/displayClass.php');
$newVend = new vendPart;
$newdisplay = new display;
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/vendPart.js"></script>

<html>
<head>
<title>Vendor Parts Report</title>
</head>

<table width=650 border=0>
    <tr><td><font style="Arial" size=5 color="#000000"><center><b><A HREF="javascript:window.print()">Part Reordering Report</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>

   <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Part #</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Serial #</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Vendor</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Inv Count</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Min Qty</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Lead Time</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Rate </b></td>
            <td bgcolor="#EEEFEE" width= 20%><span class="heading"><b>Part Desc</b></td>
        </tr>

<?php
            $result = $newVend->Partsort4Report($cond,$sort1,$offset,$rowsPerPage);
        while ($myrow = mysql_fetch_row($result)) {
            printf('<tr><td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>',
                    $myrow[1],$myrow[4], $myrow[17],$myrow[12],$myrow[7]);

            if($myrow[9]=='y'){
               printf('<td  bgcolor="#FFFFFF" ><span class="tabletext">%s weeks</td>', $myrow[8]);
               }
            else{
               printf('<td  bgcolor="#FFFFFF" ><span class="tabletext">%s months</td>', $myrow[8]);
               }

            printf('<td bgcolor="#FFFFFF"><span class="tabletext">$%.2f</td>
                    <td bgcolor="#FFFFFF"><span class="tabletext">%s</td>',
	                $myrow[6],$myrow[10]);
          }

?>
</table>
</table>



</body>
</html>
