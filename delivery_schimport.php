<?php
//==============================================
// Author: FSI                                 =
// Date-written = July  02, 2010               =
// Filename:import.php                         =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =       
//==============================================
@session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'import';
// //////session_register('pagename');

// First include the class definition
include_once('classes/loginClass.php');
include('classes/delivery_schClass.php');;

$newlogin = new userlogin;
$newlogin->dbconnect();
$newdelivery_sh = new deliverye_sch;
$submit = $_REQUEST['submit'];
if($submit == 'Submit')
{
	$import_text=$_POST['import_text'];
	$datearr = split('\*',$import_text);
    $counter=count($datearr)-1;

     $first_array=array();
     $arr[]=$datearr[0];	


	for($i=0;$i<count($arr);$i++)
	{
        $e=$arr[$i]; 		
		$datearr1 = split('\,',$e);		
        for($j=3;$j<=(count($datearr1)-1);$j++)
		{
           $sch_date[]=$datearr1[$j];		 
		}
	}

	
	$inp_start_date = split('/',$sch_date[0]); 	
	    
	    // echo $sch_date[0] ;
	$m=$inp_start_date[0];
	$d=$inp_start_date[1];
	$y=$inp_start_date[2];
	$x=mktime(0,0,0,$m,$d,$y);
	$start_date=date("Y-m-d",$x);	
    // echo "<br>$start_date"; exit;

    $res=array();
    for($i=1;$i<$counter;$i++)
	{
	   $each_row=$datearr[$i];	
       $datearr1 = split('\,',$each_row);	  
	   $k=3;
	   $crnnum=trim($datearr1[0]);	 
	   $partnum=trim($datearr1[1]);
	   $custcode=trim($datearr1[2]);
	   // $start_date = $sch_date[0];
       $newdelivery_sh->delete_old_sch($crnnum,$start_date);
       $crntype=$newdelivery_sh->getcrntype($crnnum);
       // echo $crntype;
	       
        foreach($sch_date as $sch_d)
		{	
         
			$dd = split('/',$sch_d); 	     
			$m=$dd[0];
			$d=$dd[1];
			$y=$dd[2];
			$x=mktime(0,0,0,$m,$d,$y);
			$sch_date1=date("Y-m-d",$x);	
			

			$schedule_qty=trim($datearr1[$k]);
			$schedule_date=trim($sch_date1);
			        
			$typeval ='Auto' ;
			$parent_crnnum = '';
			  $newdelivery_sh->setcustcode($custcode);
            $newdelivery_sh->setcrnnum($crnnum);
		    $newdelivery_sh->setpartnum($partnum);
		    $newdelivery_sh->setschedule_date($schedule_date);
		    $newdelivery_sh->setschedule_qty($schedule_qty);
		    $newdelivery_sh->settype($typeval);		  
		    $newdelivery_sh->setparent_crnnum($parent_crnnum);		  
  		    $result=$newdelivery_sh->adddelivery_sch();	


       	    $assy_crn = substr($crnnum,2,2);

			if($crntype =='Kit')
				{	

               	 
		            $result5=$newdelivery_sh->getsubcrnforkit($crnnum);
		            while($row5 = mysql_fetch_row($result5))
		            {	
		            	$crnnum3 = trim($row5[0]) ;
		            	$qpaval2 = $row5[1] ;
						$partnum2 = $row5[3] ;

		            	//$typeval ='Auto' ;	
		            	$schedule_qty3 = $qpaval2 * $schedule_qty ;
		            	$parent_crnnum3 = $crnnum ;
		            	$subcrnnum2 = $crnnum ."/".$crnnum3  ;
		            	$newdelivery_sh->setcustcode($custcode);
					    $newdelivery_sh->setcrnnum($subcrnnum2);
					    $newdelivery_sh->setpartnum($partnum2);
					    $newdelivery_sh->setschedule_date($schedule_date);
					    $newdelivery_sh->setschedule_qty($schedule_qty3);
					    $newdelivery_sh->setparent_crnnum($parent_crnnum3);
					    $result6=$newdelivery_sh->adddelivery_sch();	


						$result8=$newdelivery_sh->getsubcrn($crnnum3);
			            while($row8 = mysql_fetch_row($result8))
			            {	
			               $crnnum4  = $row8[0] ;	
			               $qpaval5   = $row8[1] ;	
			               $partnum4 = trim($row8[3]) ;	
			             //  $typeval ='Auto' ;
			               $parent_crnnum5 = $crnnum ;
			               $subcrnnum5 = $crnnum ."/".$crnnum4 ;
			               $schedule_qty5 = $qpaval5 * $schedule_qty ;
			               $newdelivery_sh->setcustcode($custcode);
						   $newdelivery_sh->setcrnnum($subcrnnum5);
						   $newdelivery_sh->setpartnum($partnum4);
						   $newdelivery_sh->setschedule_date($schedule_date);
						   $newdelivery_sh->setschedule_qty($schedule_qty5);
						   $newdelivery_sh->setparent_crnnum($parent_crnnum5);	
						   //$newdelivery_sh->settype($typeval);
						  
						  $result9=$newdelivery_sh->adddelivery_sch();	
						}


			            $result10=$newdelivery_sh->getpartnumboughtout($crnnum3);
			            while($row10 = mysql_fetch_row($result10))
			            {	
			            	$crnnum5 = trim($row10[0]) ;
			            	$qpaval6 = $row10[1] ;
			            	//$typeval ='Auto' ;	
			            	$schedule_qty6 = $qpaval6 * $schedule_qty ;
			            	$parent_crnnum6 = $crnnum ;
			            	$subcrnnum6 = $crnnum ."/".$crnnum3 ."/". $crnnum5."/BOI" ;

			            	  $newdelivery_sh->setcustcode($custcode);
						    $newdelivery_sh->setcrnnum($subcrnnum6);
						    $newdelivery_sh->setpartnum($crnnum5);
						    $newdelivery_sh->setschedule_date($schedule_date);
						    $newdelivery_sh->setschedule_qty($schedule_qty6);
						    //$newdelivery_sh->settype($typeval);
						    $newdelivery_sh->setparent_crnnum($parent_crnnum6);
						    $result11=$newdelivery_sh->adddelivery_sch();	
						} 	
					} 	

	 				$result6=$newdelivery_sh->getsubcrn($crnnum);
		            while($row6 = mysql_fetch_row($result6))
		            {	
		               $crnnum4  = $row6[0] ;	
		               $qpaval4   = $row6[1] ;	
		               $partnum3 = trim($row6[3]) ;	
		             //  $typeval ='Auto' ;
		               $parent_crnnum4 = $crnnum ;
		               $subcrnnum4 = $crnnum ."/".$crnnum4 ;
		               $schedule_qty4 = $qpaval4 * $schedule_qty ;
		               $newdelivery_sh->setcustcode($custcode);
					   $newdelivery_sh->setcrnnum($subcrnnum4);
					   $newdelivery_sh->setpartnum($partnum3);
					   $newdelivery_sh->setschedule_date($schedule_date);
					   $newdelivery_sh->setschedule_qty($schedule_qty4);
					   $newdelivery_sh->setparent_crnnum($parent_crnnum4);	
					   //$newdelivery_sh->settype($typeval);
					  
					  $result7=$newdelivery_sh->adddelivery_sch();	
					}
				  $resulttreat=$newdelivery_sh->getsubcrn4treated($crnnum);
			      while($rowtreat = mysql_fetch_row($resulttreat))
	            {	
	               $crnnumtreat  = $rowtreat[0] ;	
	               $qpavaltreat   = $rowtreat[1] ;	
	               $partnumtreat = trim($rowtreat[3]) ;	
	             //  $typeval ='Auto' ;
	               $parent_crnnumtr = $crnnum ;
	               $subcrnnum = $crnnum ."/".$crnnumtreat ;
	               $schedule_qty10 = $qpavaltreat * $schedule_qty ;
	               $newdelivery_sh->setcustcode($custcode);
				   $newdelivery_sh->setcrnnum($subcrnnum);
				   $newdelivery_sh->setpartnum($partnumtreat);
				   $newdelivery_sh->setschedule_date($schedule_date);
				   $newdelivery_sh->setschedule_qty($schedule_qty10);
				   $newdelivery_sh->setparent_crnnum($parent_crnnumtr);	
				   //$newdelivery_sh->settype($typeval);
				  
				  $resulttreat=$newdelivery_sh->adddelivery_sch();	
				}

				}		

       	    if($crntype == 'Assembly')
       	    {
	            $result2=$newdelivery_sh->getsubcrn($crnnum);
	           
	            while($row2 = mysql_fetch_row($result2))
	            {	
	               $crnnum1  = $row2[0] ;	
	               $qpaval   = $row2[1] ;	
	               $partnum1 = trim($row2[3]) ;	
	             //  $typeval ='Auto' ;
	               $parent_crnnum1 = $crnnum ;
	               $subcrnnum = $crnnum ."/".$crnnum1 ;
	               $schedule_qty1 = $qpaval * $schedule_qty ;
	               $newdelivery_sh->setcustcode($custcode);
				   $newdelivery_sh->setcrnnum($subcrnnum);
				   $newdelivery_sh->setpartnum($partnum1);
				   $newdelivery_sh->setschedule_date($schedule_date);
				   $newdelivery_sh->setschedule_qty($schedule_qty1);
				   $newdelivery_sh->setparent_crnnum($parent_crnnum1);	
				   //$newdelivery_sh->settype($typeval);
				  
				  $result3=$newdelivery_sh->adddelivery_sch();	
				}
		    $result5=$newdelivery_sh->getsubcrn4treated($crnnum);
			while($row5 = mysql_fetch_row($result5))
	            {	
	               $crnnum3  = $row5[0] ;	
	               $qpaval3   = $row5[1] ;	
	               $partnum3 = trim($row5[3]) ;	
	             //  $typeval ='Auto' ;
	               $parent_crnnum3 = $crnnum ;
	               $subcrnnum = $crnnum ."/".$crnnum3 ;
	               $schedule_qty3 = $qpaval3 * $schedule_qty ;
	               $newdelivery_sh->setcustcode($custcode);
				   $newdelivery_sh->setcrnnum($subcrnnum);
				   $newdelivery_sh->setpartnum($partnum3);
				   $newdelivery_sh->setschedule_date($schedule_date);
				   $newdelivery_sh->setschedule_qty($schedule_qty3);
				   $newdelivery_sh->setparent_crnnum($parent_crnnum3);	
				   //$newdelivery_sh->settype($typeval);
				  
				  $result6=$newdelivery_sh->adddelivery_sch();	
				}

	            $result1=$newdelivery_sh->getpartnumboughtout($crnnum);
	            while($row1 = mysql_fetch_row($result1))
	            {	
	            	$crnnum2 = trim($row1[0]) ;
	            	$qpaval1 = $row1[1] ;
	            	//$typeval ='Auto' ;	
	            	$schedule_qty2 = $qpaval1 * $schedule_qty ;
	            	$parent_crnnum2 = $crnnum ;
	            	$subcrnnum1 = $crnnum ."/".$crnnum2."/BOI" ;
	            	$newdelivery_sh->setcustcode($custcode);
				    $newdelivery_sh->setcrnnum($subcrnnum1);
				    $newdelivery_sh->setpartnum($crnnum2);
				    $newdelivery_sh->setschedule_date($schedule_date);
				    $newdelivery_sh->setschedule_qty($schedule_qty2);
				    //$newdelivery_sh->settype($typeval);
				    $newdelivery_sh->setparent_crnnum($parent_crnnum2);
				    $result4=$newdelivery_sh->adddelivery_sch();	
				} 	
						
			}					

								
					

		  if(!empty($result) )
			  array_push($res,$result);	
		   $status='Insert';
		   $k++;
		}		
   }

if(count($res) >0)
{
	for($i=0;$i<count($res);$i++)
	{
		    $datearr = split('-', $res[$i][3]);
			$d=$datearr[2];
			$m=$datearr[1];
			$y=$datearr[0];
			$x=mktime(0,0,0,$m,$d,$y);
			$dispdate=date("M j, Y",$x);

			echo  ("<font color='red'>Schedule qty  " . $res[$i][0]. " should be greater than dispatch qty ".$res[$i][1]." for CRN#: ".$res[$i][2]." and Sch date: ".$dispdate."<br/>");  
			
	}
}
else
{
header("Location:delivery_schSummary.php?status=import");
}
}
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/delivery_sch.js"></script>

<html>
<head>
<title>Import Delivery Sch</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">

<form action='delivery_schimport.php' method='POST' enctype='multipart/form-data'>
<table style="table-layout: fixed"  width=60%  align='center' border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr>
<td bgcolor="#B0C4DE" align='center'><span class="pageheading">
<b>Import Planning (Copy Paste data from exported csv file with * as delimiter for each record
<br>Column titles are - prn, partnum,customername,mm/dd/yy, mm/dd/yy.......
<br>Data Columns are prn,partnum,customer,qty(for each date)
</b>
<a href ="delivery_schSummary.php" ><img name="Image8" border="0" src="images/arrow_left.png" height='25' title="Back To Delivery Schedule Summary" align='right'></a></td> 
</tr>
<tr>
<td bgcolor="#FFFFFF" align='center'><textarea name="import_text" rows=30 cols=100 value="<?echo $import_text?>"><?echo $import_text?></textarea>
<br/>
<span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=80;"
                     value="Submit" name="submit">
                    <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=80;"
                     VALUE="Reset" onClick="javascript: putfocus()">
</td>
</table>
</td></tr>
</table>
</td></tr>
</table>
</form>
</body>
</html>
