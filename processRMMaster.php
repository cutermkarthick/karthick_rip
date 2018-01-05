<?php
//==============================================
// Author: FSI                                 =
// Date-written = Mar 20, 2007                 =
// Filename: processQualityplan.php            =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Process of Quality Plan                     =
//==============================================

   session_start();
   header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$pagename = $_SESSION['pagename'];
include('classes/rmmasterClass.php');
$newMD = new rmmaster;
//Reading from csv
//echo $pagename;
$recnum=$_REQUEST['masterdatarecnum'];
if($pagename=='rmmastersummary')
{
	 $sub=$_REQUEST['subfile'];
//echo $sub."mahi";
//echo $sub."mahi";
		if($sub=='upload')
		{
			$row = 1;
//echo $row;
			$handle = fopen("./upload/filename.csv", "r");
//$data=fgetcsv($handle, 1000, ",");
			$i=0;
			while ((($data = fgetcsv($handle, 1000, ",")) !== FALSE)){
//$num = count($data);
			$num=16;
//echo $num;
//echo "<p> $num fields in line $row: <br /></p>\n";
			$row++;
//echo $data[1];
//for ($c=0; $c < $num; $c++) {
//echo $data[$c] . "======";
				if($i==0)
					{
	//break;
        
	//echo "Inside if";
					}
			   else
					{
						$crnnum=$data[0];//echo "OPutside if";
						$rm_spec=$data[1];
						$rm_condition=$data[2];
						$rm_uom=$data[3];
						$rm_dia=$data[4];
						$rm_dim1=$data[5];
						$rm_dim2=$data[6];
						$rm_dim3=$data[7];
						$rm_grainflow=$data[8];
						$rm_lt=$data[9];
						$rm_st=$data[10];
						$rm_qty_perbill=$data[11];
						$rm_ruling_dim=$data[12];
						$rm_unitprize=$data[13];
						$rm_supplier=$data[14];
						$rm_altrm=$data[15];

						$rm_notes=$_REQUEST['rm_notes'];
						$rm_status=$_REQUEST["rm_status"];
//$vendrecnum=$_REQUEST["vendrecnum"];
						$vendrecnum=$newMD->getVendrecnum($rm_supplier);
//echo $vendrecnum;
                		$newMD->setrm_type($rm_type);
               		    $newMD->setrm_spec($rm_spec);
                		$newMD->setrm_dim1($rm_dim1);
                		$newMD->setrm_dim2($rm_dim2);
               		    $newMD->setrm_dim3($rm_dim3);
// $newMD->setrmcode($rmcode);
                		$newMD->setrm_dia($rm_dia);
                		$newMD->setruling_dim($rm_ruling_dim);
// $newMD->setpartnum($partnum);

 		                $newMD->setrm_crn($crnnum);
        	            $newMD->setrm_condition($rm_condition);
	                    $newMD->setrm_uom($rm_uom);
                 		$newMD->setrm_grainflow($rm_grainflow);
                 		$newMD->setrm_lt($rm_lt);
                		$newMD->setrm_st($rm_st);
                 		$newMD->setrm_billet($rm_qty_perbill);
                 		$newMD->setrm_mrs($rm_ruling_dim);
                 		$newMD->setrm_unitprice($rm_unitprize);
                 		$newMD->setrm_supplier($rm_supplier);
                 		$newMD->setrm_altspec($rm_altrm);
                 		$newMD->setlink2vendor($vendrecnum);
                		$newMD->setrm_notes($rm_notes);
                		$newMD->setrm_status($rm_status);
//echo $masterdatarecnum;
//if ($pagename == 'rmmasterentry') {
						$masterdatarecnum = $newMD->addrmmaster();
//$notedata=$newMD->addrmnotes();
//echo "<br>";

					}
					$i++;
				}
fclose($handle);
header("Location:rmmastersummary.php");
      }
     else
        {
//echo"in else";
	      $rmspec=$_REQUEST['rmspec'];
	      $crn_search=$_REQUEST['rmcode'];
//$crn_sort=$_REQUEST['sort1'];
//echo $crn_sort."in pro------";
	      header("Location:rmmastersummary.php?rmspec=$rmspec&rmcode=$crn_search");

   		}
}
if ($pagename == 'rmeditmaster')
	{
 	  		   $masterdatarecnum = $_REQUEST["masterdatarecnum"];
               $rmcode = $_REQUEST["rmcode"];
			   $partnum = $_REQUEST["partnum"];
               $rm_type = $_REQUEST["rm_type"];
               $rm_spec = $_REQUEST["rm_spec"];
			   $rm_dia = $_REQUEST["rm_dia"];
               $rm_dim1 = $_REQUEST["rm_dim1"];
               $rm_dim2 = $_REQUEST["rm_dim2"];
               $rm_dim3 = $_REQUEST["rm_dim3"];
               $rm_ruling_dim = $_REQUEST["rm_ruling_dim"];
               $crnnum = $_REQUEST["crnnum"];
               $rm_condition = $_REQUEST["rm_condition"];
               $rm_uom = $_REQUEST["rm_uom"];
               $rm_grainflow = $_REQUEST["rm_grainflow"];
               $rm_lt = $_REQUEST["rm_lt"];
               $rm_st = $_REQUEST["rm_st"];
               $rm_qty_perbill = $_REQUEST["rm_qty_perbill"];
               $rm_mrs = $_REQUEST["rm_mrs"];
               $rm_unitprize = $_REQUEST["rm_unitprize"];
               $rm_supplier = $_REQUEST["vendor"];
               $rm_altrm = $_REQUEST["spec_val"];
               $vendrecnum=$_REQUEST["vendrecnum"];
               $rm_notes=$_REQUEST["addnotes"];
               //$rm_status=$_REQUEST["rm_status"];
               $director_approved=$_REQUEST["director_app"];
               $dir_app_by=$_REQUEST["director_app_by"];
               $rm_remarks=$_REQUEST["rm_remarks"];
               $create_date=$_REQUEST["create_date"];
               $engg_app=$_REQUEST['eng_app'];
               $engg_app_by=$_REQUEST['eng_app_by'];
               $engg_app_date=$_REQUEST['eng_app_date'];
               $director_app_date=$_REQUEST['director_app_date'];
               $currency=$_REQUEST['currency'];
               $rm_bars_plates=$_REQUEST['rm_bars_plates'];
               $result_app=$newMD->getapp4rm($masterdatarecnum,$rm_altrm);
               $myrm_app=mysql_fetch_row($result_app);
               //echo $engg_app."-------".$_REQUEST["rm_status"];
               $rmcpystatus=$_REQUEST['status_copy'];
               //echo $rmcpystatus;
               if( $rmcpystatus!='copy_rm')
              {
              if($engg_app == '' ||$engg_app == 'no' )
              {
               if($myrm_app[0]=='yes' && $director_approved=='yes' && $myrm_app[2] == 'Pending')
               {
                 $rm_status = 'Active';
               }
               else if(($myrm_app[0]=='' ||$myrm_app[0]=='no' ) || ($director_approved=='' || $director_approved=='no' ) )
               {
                 if($_REQUEST["rm_status"]!='Inactive')
                 {
                  $rm_status = 'Pending';
                 }
                 else
                 {
                   $rm_status = 'Inactive';
                 }

               }
               else if($myrm_app[0]=='yes' && $director_approved=='yes' && $myrm_app[2] != 'Pending' )
               {
                 $rm_status = $_REQUEST["rm_status"];
               }
               else if(($myrm_app[0]=='' || $director_approved=='') && ($myrm_app[2] == 'Active'||$myrm_app[2] == '') && $_REQUEST["rm_status"]!='Inactive' )
               {
                 $rm_status = 'Pending';
               }
               else if($engg_app=='yes' && $director_approved=='yes' && $_REQUEST["rm_status"]=='Active')
               {
                 $rm_status = 'Active';
               }
               }

               else if($engg_app == 'yes' )
               {
                 if($engg_app=='yes' && $director_approved=='yes' && $_REQUEST["rm_status"]=='Active')
               {
                 $rm_status = 'Active';
               }
               else if(($engg_app=='' ||$engg_app=='no' ) || ($director_approved=='' || $director_approved=='no' ))
               {
                 $rm_status = 'Pending';
               }
               else if($engg_app=='yes' && $director_approved=='yes'&& $_REQUEST["rm_status"]=='Pending' )
               {
                 $rm_status = 'Active';
               }
               else if($engg_app=='yes' && $director_approved=='yes'&& $_REQUEST["rm_status"]!='Pending' )
               {
                 $rm_status = $_REQUEST["rm_status"];
               }
               else if($engg_app!='yes' && $director_approved!='yes' && $_REQUEST["rm_status"] =='Inactive' )
               {
                 $rm_status = 'Inactive';
               }
               else if(($engg_app=='' || $director_approved==''))
               {
                 $rm_status = 'Pending';
               }

               }
               }
               else
               {
                 $rm_status = 'Active';
               
               }
               //echo $engg_app."*-*-*-*-*-*-*".$rm_status;
               //echo $myrm_app[2]."*-*-*-*-*-*-*".$rm_status;
//echo $rm_status."in p";
//echo $rm_supplier."in p";
               $newlogin = new userlogin;
		       $newMD->setrm_type($rm_type);
               $newMD->setrm_spec($rm_spec);
               $newMD->setrm_dim1($rm_dim1);
               $newMD->setrm_dim2($rm_dim2);
               $newMD->setrm_dim3($rm_dim3);
               $newMD->setrmcode($rmcode);
               $newMD->setrm_dia($rm_dia);
               $newMD->setruling_dim($rm_ruling_dim);
               $newMD->setpartnum($partnum);
               $newMD->setrm_crn($crnnum);
               $newMD->setrm_condition($rm_condition);
               $newMD->setrm_uom($rm_uom);
               $newMD->setrm_grainflow($rm_grainflow);
               $newMD->setrm_lt($rm_lt);
               $newMD->setrm_st($rm_st);
               $newMD->setrm_billet($rm_qty_perbill);
               $newMD->setrm_mrs($rm_mrs);
               $newMD->setrm_unitprice($rm_unitprize);
               $newMD->setrm_supplier($rm_supplier);
               $newMD->setrm_altspec($rm_altrm);
               $newMD->setlink2vendor($vendrecnum);
               $newMD->setrm_notes($rm_notes);
//echo $pagename;
			   $newMD->setrm_status($rm_status);
			   $newMD->setdirectorsapproved($director_approved);
		       $newMD->setdirectorsapprovedby($dir_app_by);
		       $newMD->setrm_remarks($rm_remarks);
			   $newMD->setcreate_date($create_date);
			   $newMD->setenggapproved($engg_app);
               $newMD->setenggapprovedby($engg_app_by);
               $newMD->setenggapproved_date($engg_app_date);
               $newMD->setdirectorapproveddate($director_app_date);
               $newMD->setcurrency($currency);
               $newMD->setrm_bars_plates($rm_bars_plates);
               $newMD->updatermmaster($recnum);

      		   $newMD->addNotes($masterdatarecnum);
    header("Location:rmmastersummary.php");
	}
 if ($pagename == 'rmmasterentry')
	{
 			   $masterdatarecnum = $_REQUEST["masterdatarecnum"];
               $rmcode = $_REQUEST["rmcode"];
			   $partnum = $_REQUEST["partnum"];
               $rm_type = $_REQUEST["rm_type"];
               $rm_spec = $_REQUEST["rm_spec"];
			   $rm_dia = $_REQUEST["rm_dia"];
               $rm_dim1 = $_REQUEST["rm_dim1"];
               $rm_dim2 = $_REQUEST["rm_dim2"];
               $rm_dim3 = $_REQUEST["rm_dim3"];
               $rm_ruling_dim = $_REQUEST["rm_ruling_dim"];
               $crnnum = $_REQUEST["crnnum"];
               $rm_condition = $_REQUEST["rm_condition"];
               $rm_uom = $_REQUEST["rm_uom"];
               $rm_grainflow = $_REQUEST["rm_grainflow"];
               $rm_lt = $_REQUEST["rm_lt"];
               $rm_st = $_REQUEST["rm_st"];
               $rm_qty_perbill = $_REQUEST["rm_qty_perbill"];
               $rm_mrs = $_REQUEST["rm_mrs"];
               $rm_unitprize = $_REQUEST["rm_unitprize"];
               $rm_supplier = $_REQUEST["vendor"];
               $rm_altrm = $_REQUEST["spec_val"];
               $director_approved=$_REQUEST["director_app"];
               $dir_app_by=$_REQUEST["director_app_by"];
               $rm_remarks=$_REQUEST["rm_remarks"];
               $engg_app=$_REQUEST['eng_app'];
               $engg_app_by=$_REQUEST['eng_app_by'];
               $engg_app_date=$_REQUEST['eng_app_date'];
               $director_app_date=$_REQUEST['director_app_date'];
               $create_date = date('Y-m-d');
               $currency=$_REQUEST['currency'];
               $rm_bars_plates=$_REQUEST['rm_bars_plates'];
               //echo $director_approved."altr value in process";
               //$rm_status=$_REQUEST["rm_status"];

               $vendrecnum=$_REQUEST["vendrecnum"];

               $result_app=$newMD->getapp_rm4new($crnnum,$rm_altrm);
               $myrm_app=mysql_fetch_row($result_app);
               //echo $myrm_app[0].'*-*-*-*-*-'.$myrm_app[1]."<br>";
              if($engg_app == '' ||$engg_app == 'no' )
              {
               if($myrm_app[0]=='yes' && $director_approved=='yes' && $myrm_app[2] == 'Pending')
               {
                 $rm_status = 'Active';
               }
               else if(($myrm_app[0]=='' ||$myrm_app[0]=='no' ) || ($director_approved=='' || $director_approved=='no' ) )
               {
                 if($_REQUEST["rm_status"]!='Inactive')
                 {
                  $rm_status = 'Pending';
                 }
                 else
                 {
                   $rm_status = 'Inactive';
                 }

               }
               else if($myrm_app[0]=='yes' && $director_approved=='yes' && $myrm_app[2] != 'Pending' )
               {
                 $rm_status = $_REQUEST["rm_status"];
               }
               else if(($myrm_app[0]=='' || $director_approved=='') && ($myrm_app[2] == 'Active'||$myrm_app[2] == '') && $_REQUEST["rm_status"]!='Inactive' )
               {
                 $rm_status = 'Pending';
               }
               }

               else if($engg_app == 'yes' )
               {
                 if($engg_app=='yes' && $director_approved=='yes' && $_REQUEST["rm_status"]=='Active')
               {
                 $rm_status = 'Active';
               }
               else if(($engg_app=='' ||$engg_app=='no' ) || ($director_approved=='' || $director_approved=='no' ))
               {
                 $rm_status = 'Pending';
               }
               else if($engg_app=='yes' && $director_approved=='yes'&& $_REQUEST["rm_status"]=='Pending' )
               {
                 $rm_status = 'Active';
               }
               else if($engg_app=='yes' && $director_approved=='yes'&& $_REQUEST["rm_status"]!='Pending' )
               {
                 $rm_status = $_REQUEST["rm_status"];
               }
               else if($engg_app!='yes' && $director_approved!='yes' && $_REQUEST["rm_status"] =='Inactive' )
               {
                 $rm_status = 'Inactive';
               }
               else if(($engg_app=='' || $director_approved==''))
               {
                 $rm_status = 'Pending';
               }

               }
//echo $rm_altrm."altr value in process";echo $rm_supplier."supplier value in process";

               $newlogin = new userlogin;
		       $newMD->setrm_type($rm_type);
               $newMD->setrm_spec($rm_spec);
               $newMD->setrm_dim1($rm_dim1);
               $newMD->setrm_dim2($rm_dim2);
               $newMD->setrm_dim3($rm_dim3);
               $newMD->setrmcode($rmcode);
               $newMD->setrm_dia($rm_dia);
               $newMD->setruling_dim($rm_ruling_dim);
               $newMD->setpartnum($partnum);

               $newMD->setrm_crn($crnnum);
               $newMD->setrm_condition($rm_condition);
               $newMD->setrm_uom($rm_uom);
               $newMD->setrm_grainflow($rm_grainflow);
               $newMD->setrm_lt($rm_lt);
               $newMD->setrm_st($rm_st);
               $newMD->setrm_billet($rm_qty_perbill);
               $newMD->setrm_mrs($rm_mrs);
               $newMD->setrm_unitprice($rm_unitprize);
               $newMD->setrm_supplier($rm_supplier);
               $newMD->setrm_altspec($rm_altrm);
               $newMD->setrm_status($rm_status);
               $newMD->setlink2vendor($vendrecnum);
               $newMD->setdirectorsapproved($director_approved);
               $newMD->setdirectorsapprovedby($dir_app_by);
               $newMD->setrm_remarks($rm_remarks);
        	   $newMD->setcreate_date($create_date);
        	   $newMD->setenggapproved($engg_app);
               $newMD->setenggapprovedby($engg_app_by);
               $newMD->setenggapproved_date($engg_app_date);
               $newMD->setdirectorapproveddate($director_app_date);
               $newMD->setcurrency($currency);
               $newMD->setrm_bars_plates($rm_bars_plates);
               $masterdatarecnum = $newMD->addrmmaster();

    header("Location:rmmastersummary.php");
	}
if ($pagename == 'rmeditmaster4view')
{   //echo $_REQUEST['masterdatarecnum']."*******";
   $recnum=$_REQUEST['masterdatarecnum'];
   $engg_app=$_REQUEST['eng_app'];
   $engg_app_by=$_REQUEST['eng_app_by'];
   $rm_altrm = $_REQUEST["spec_val"];
   $engg_app_date=$_REQUEST['eng_app_date'];
   //$rm_status=$_REQUEST['rm_status'];
   //echo$engg_app_by."*****";

               $result_app=$newMD->getapp4rm($recnum,$rm_altrm);
               $myrm_app=mysql_fetch_row($result_app);
               //echo $engg_app.'*-*-*-*-*-'.$myrm_app[1]."<br>";
               if($engg_app=='yes' && $myrm_app[1]=='yes')
               {
                 $rm_status = 'Active';
               }
               else if(($engg_app=='' ||$engg_app=='no' ) || ($myrm_app[1]=='' || $myrm_app[1]=='no' ))
               {
                 $rm_status = 'Pending';
               }
               else if($engg_app=='yes' && $myrm_app[1]=='yes' && $myrm_app[2] == 'Active' )
               {
                 $rm_status = $_REQUEST["rm_status"];
               }
               else if(($engg_app=='' || $myrm_app[1]=='') && ($myrm_app[2] == 'Active'||$myrm_app[2] == '') )
               {
                 $rm_status = 'Pending';
               }
    //echo $rm_status;
   $newlogin = new userlogin;
   $newMD->setenggapproved($engg_app);
   $newMD->setenggapprovedby($engg_app_by);
   $newMD->setrm_status($rm_status);
   $newMD->setenggapproved_date($engg_app_date);
   $newMD->updatermmaster_engapp($recnum);
   header("Location:rmmastersummary.php");
}

if ($pagename == 'rmmasterdetails') {
    $masterdatarecnum = $_REQUEST["masterdatarecnum"];
    $spec_type = $_REQUEST["spec_type"];
    $crnnum = $_REQUEST["crnnum"];
    //$status = $_REQUEST["rm_status"];
//	echo "<br>in process Page recnum is $masterdatarecnum------$spec_type";
    $recnum4edit=$newMD->copyrmmaster($masterdatarecnum,$spec_type,$crnnum);
	header("Location:rmeditmaster.php?masterdatarecnum=$recnum4edit&status=copy_rm" );
}
?>
