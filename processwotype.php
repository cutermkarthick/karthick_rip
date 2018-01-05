<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2005    Jerry George           =
// Filename: processWotype.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
//==============================================

session_start();
header("Cache-control: private"); 
$pagename = $_SESSION['pagename'];

include('classes/pageClass.php'); 
include('classes/pagefieldsClass.php'); 

// Next, create an instance of the classes required

$newpage = new page; 
$newFI= new pagefields; 

$pagename=$_SESSION['pagename'];

if ($pagename == 'new_wotype' ) 
{

	   $parent = $_REQUEST['parentval'];
	   $pname = $_REQUEST['pname'];
	   $group1 = $_REQUEST['grp1'];
	   $group2 = $_REQUEST['grp2'];
	   $group3 = $_REQUEST['grp3'];
	   $group4 = $_REQUEST['grp4'];
	   $index=$_REQUEST['index1'];

	   $newpage->setpname($pname);
	   $newpage->setparent($parent);

	   $precnum = $newpage->addPage();
	   $i=1;
	   $c=1;$s=1;$l=1;$n=1;$f=1;$dt=1;$cb=1;$pq=1;$p=1;$q=1;
	   while($i<$index)
	   {
		$seqnum="seqnum" . $i;
		$lname="lname" . $i;
		$type="typeval" . $i;
		$mandatory="mandatory" . $i;
		$groupval="groupval" . $i;
		$status="statusval" . $i;
		$seqnum1 = $_REQUEST[$seqnum];
		$type1 = $_REQUEST[$type];

		if($type1=='Text')
		{
		       $fname1="char" . $c;
		       $c++;
		}
		if($type1=='Desc Text')
		{
		       $fname1="string" . $s;
		       $s++;
		}
		if($type1=='Long')
		{
		       $fname1="long" . $l;
		       $l++;
		}
		if($type1=='Numeric')
		{
		       $fname1="number" . $n;
		       $n++;
		}
		if($type1=='Decimal')
		{
		       $fname1="floatval" . $f;
		       $f++;
		}
		if($type1=='Date')
		{
		       $fname1="date" . $dt;
		       $dt++;
		}
		if($type1=='Check Box')
		{
		       $fname1="checkbox" . $cb;
		       $cb++;
		}
		if($type1=='Part')
		{
		       $fname1="part" . $p;
		       $p++;
		}
	               $lname1 = $_REQUEST[$lname];
	               if(isset($_REQUEST[$mandatory]))
	              		$mandatory1 ="y";
	               else
	               		$mandatory1 ="n";
		$group = $_REQUEST[$groupval];
		if($group == 'Group1')
			$actgroup=$group1;
		else if($group == 'Group2')
			$actgroup=$group2;
		else if($group == 'Group3')
			$actgroup=$group3;
		else if($group == 'Group4')
			$actgroup=$group4;
		$status1 = $_REQUEST[$status];
		if($type1=='Part With Qty')
		{
		       $fname1="partqty" . $pq;
          		       $mandatory1 ="n";
		       $pq++;
		       $qname="qty" . $q;
		       $q++;
			$newFI->setseqnum($seqnum1);
			$newFI->setlink2pname($precnum);
			$newFI->setlname('');
			$newFI->setfname($qname);
			$newFI->settype("Qty");
			$newFI->setmandatory($mandatory1);
			$newFI->setpgroup($actgroup);
			$newFI->setstatus($status1);
			$newFI->addFI();
		}
		if ($seqnum1 != '') 
		{
			$newFI->setseqnum($seqnum1);
			$newFI->setlink2pname($precnum);
			$newFI->setlname($lname1);
			$newFI->setfname($fname1);
			$newFI->settype($type1);
			$newFI->setmandatory($mandatory1);
			$newFI->setpgroup($actgroup);
			$newFI->setstatus($status1);
			$newFI->addFI();
			$sql = "commit";
			$result = mysql_query($sql);
			if(!$result) 
			{
				 $sql = "rollback";
				 $result = mysql_query($sql);
				 die("Commit failed for Page Field Insert.Please rreportrt to Sysadmin. " . mysql_errno()); 
			 }
		}
	$i++;
      }
if($parent == 'WorkOrder')
	$newpage->createjs($parent,$pname) ;
else
	$newpage->createjs4quote($parent,$pname) ;
}

$i=1;
if ($pagename == 'edit_wotype') 
{
	   $parent = $_REQUEST['parent'];
	   $pname = $_REQUEST['pname'];
	   $group1 = $_REQUEST['grp1'];
	   $group2 = $_REQUEST['grp2'];
	   $group3 = $_REQUEST['grp3'];
	   $group4 = $_REQUEST['grp4'];
	   $index=$_REQUEST['index1'];
	   $precnum = $_REQUEST['recnum'];
	   $i=1;
	   $c=1;$s=1;$l=1;$n=1;$f=1;$dt=1;$cb=1;$pq=1;$p=1;$q=1;
	   while($i<$index)
	   {

		$prevseqnum="prevseqnum" . $i;
		$typerecnum="typerecnum" . $i;
		$seqnum="seqnum" . $i;
		$lname="lname" . $i;
		$type="typeval" . $i;
		$mandatory="mandatory" . $i;
		$groupval="groupval" . $i;
		$status="statusval" . $i;
		$prevseqnum1 = $_REQUEST[$prevseqnum];
		$typerecnum1 = $_REQUEST[$typerecnum];
		$seqnum1 = $_REQUEST[$seqnum];
		$type1 = $_REQUEST[$type];
		if($type1=='Text')
		{
		       $fname1="char" . $c;
		       $c++;
		}
		if($type1=='Desc Text')
		{
		       $fname1="string" . $s;
		       $s++;
		}
		if($type1=='Long')
		{
		       $fname1="long" . $l;
		       $l++;
		}
		if($type1=='Numeric')
		{
		       $fname1="number" . $n;
		       $n++;
		}
		if($type1=='Decimal')
		{
		       $fname1="floatval" . $f;
		       $f++;
		}
		if($type1=='Date')
		{
		       $fname1="date" . $dt;
		       $dt++;
		}
		if($type1=='Check Box')
		{
		       $fname1="checkbox" . $cb;
		       $cb++;
		}
		if($type1=='Part')
		{
		       $fname1="part" . $p;
		       $p++;
		}
		$lname1 = $_REQUEST[$lname];
	               if(isset($_REQUEST[$mandatory]))
	              		$mandatory1 ="y";
	               else
	               		$mandatory1 ="n";
		$group = $_REQUEST[$groupval];
		if($group == 'Group1')
			$actgroup=$group1;
		else if($group == 'Group2')
			$actgroup=$group2;
		else if($group == 'Group3')
			$actgroup=$group3;
		else if($group == 'Group4')
			$actgroup=$group4;
		$status1 = $_REQUEST[$status];
		if ($seqnum1 != '') 
		{
            if($prevseqnum1!='')
			{
				if($type1=='Part With Qty')
				{
				                $fname1="partqty" . $pq;
				                $qname="qty" . $pq;
					$mandatory1 ="n";
					$pq++;
					$newFI->setseqnum($seqnum1);
					$newFI->setlink2pname($precnum);
					$newFI->setlname('');
					$newFI->setfname($qname);
					$newFI->settype("Qty");
					$newFI->setmandatory('y');
					$newFI->setpgroup($actgroup);
					$newFI->setstatus($status1);
    			 	$newFI->updateFI($typerecnum1-1);
				}
				
				$newFI->setseqnum($seqnum1);
				$newFI->setlink2pname($precnum);
				$newFI->setlname($lname1);
				$newFI->setfname($fname1);
				$newFI->settype($type1);
				$newFI->setmandatory($mandatory1);
				$newFI->setpgroup($actgroup);
				$newFI->setstatus($status1);
			 	$newFI->updateFI($typerecnum1);
			}
			else
			{
             	if($type1=='Part With Qty')
				{
				                $fname1="partqty" . $pq;
					$mandatory1 ="n";
				                
				                $qname="qty" . $pq;
				                $pq++;
				                $q++;
					$newFI->setseqnum($seqnum1);
					$newFI->setlink2pname($precnum);
					$newFI->setlname('');
					$newFI->setfname($qname);
					$newFI->settype("Qty");
					$newFI->setmandatory('y');
					$newFI->setpgroup($actgroup);
					$newFI->setstatus($status1);
					$newFI->addFI();
				}
				
                $newFI->setseqnum($seqnum1);
				$newFI->setlink2pname($precnum);
				$newFI->setlname($lname1);
				$newFI->setfname($fname1);
				$newFI->settype($type1);
				$newFI->setmandatory($mandatory1);
				$newFI->setpgroup($actgroup);
				$newFI->setstatus($status1);
				$newFI->addFI();

			}
			$sql = "commit";
			$result = mysql_query($sql);
			if(!$result) 
			{
				 $sql = "rollback";
				 $result = mysql_query($sql);
				 die("Commit failed for Page Field Insert.Please 				rreportrt to Sysadmin. " . mysql_errno()); 
			 }
		}
	$i++;
      }
if($parent == 'WorkOrder')
	$newpage->createjs($parent,$pname) ;
else
	$newpage->createjs4quote($parent,$pname) ;
}
header("Location:wotypeDetails.php?recnum=$precnum");
?> 
