<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Dec23, 2004                =
// Filename: po_link_unlink.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Coded by Jerry George
// For adding and deleting Wos for specific Pos
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$_SESSION['pagename'] = 'po_link_unlink'; 
//////session_register('pagename');

$userid = $_SESSION['user'];
$porecnum=$_REQUEST['porecnum'];
$add =$_REQUEST['submit'];
$i=0;
$max=0;
$cond = "c.name like '%'";
$worec='';

if ( isset ( $_REQUEST['scomp'] ) )
{
     $company_match = $_REQUEST['scomp'];
     if ( isset ( $_REQUEST['company_oper'] ) ) {
          $oper = $_REQUEST['company_oper'];
     }
     else {
         $oper = 'like';
     }
     if ($oper == 'like') {
         $scomp = "'" . $_REQUEST['scomp'] . "%" . "'";
     }
     else {
         $scomp = "'" . $_REQUEST['scomp'] . "'";
     }

     $cond = "c.name " . $oper . " " . $scomp;
    
}
else {
     $company_match = '';
}
$sort1='wo';
$sort2='wo';
if ( isset ( $_REQUEST['sortfld1'] ) ) {

    $sort1 = $_REQUEST['sortfld1'];
}
if ( isset ( $_REQUEST['sortfld2'] ) ) {
    $sort2 = $_REQUEST['sortfld2'];
}
// First include the class definition 

include_once('classes/userClass.php'); 
include_once('classes/loginClass.php'); 
include('classes/workorderClass.php');
include('classes/poClass.php');
include('classes/displayClass.php');
$newlogin = new userlogin;
$newlogin->dbconnect();
$username = $_SESSION['user'];
$newworkOrder = new workOrder; 
$newpo= new po;
$newdisplay = new display;
// For paging - Added on Dec 6,04
 
// how many rows to show per page 
$rowsPerPage = 1; 

// by default we show first page 
$pageNum = 1; 

// if $_GET['page'] defined, use it as page number 
if (isset($_REQUEST['page'])) 
{ 
    $pageNum = $_REQUEST['page']; 
} 
if (isset($_REQUEST['totpages'])) 
{ 
    $totpages = $_REQUEST['totpages']; 
} 

// counting the offset 
$offset = ($pageNum - 1) * $rowsPerPage; 
 
// End additions on Dec 6,04
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/wo.js"></script>

<html>
<head>
<title>Work Order</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
    <form action="processwo.php?porecnum=<?php echo "$porecnum";?>" method='post' enctype='multipart/form-data'>

<?php
include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">

<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
    <tr>
 
        <td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td colspan=125>&nbsp;</td>

        <td align="right"><a href="chPassword.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/chpwd_mo.gif',1)"><img name="Image15" border="0" src="images/chpwd.gif"></a>
        <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
       
    </tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr><td>
	
	</td></tr>
	<tr>
	<td>
<input type=hidden name=posubmit value="<?php echo "$add";?>">
<input type=hidden name=submit value="<?php echo "$add";?>">
<?php $newdisplay->dispLinks($porecnum); ?>
<?php
if($add =="LinkWO")
{
?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

		

			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF">

					<table width=100% border=0 cellpadding=6 cellspacing=0  >
						
						<tr><td><span class="pageheading"><b>Add Work Orders By Selecting Check Boxes</b></td></tr>

						<tr><td>

<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
						
						<tr>
							<td bgcolor="#F5F6F5" colspan="3"><span class="heading"><b><center>Search Criteria</center></b></td>
							
							<td bgcolor="#F5F6F5"  colspan="4"><span class="heading"><b><center>Sort Criteria</center></b></td>
							
							<td bgcolor="#FFFFFF" rowspan=2 align="center"><span class="tabletext"><input type= "image" name="Get" src="images/bu-get.gif" value="Get" onclick="javascript: return searchsort_fields1()"></td>
</tr>

						<tr>
							<td bgcolor="#FFFFFF"><span class="labeltext"><b>Company</b></td>
							<td bgcolor="#FFFFFF"><span class="tabletext"><select name="comp_oper" size="1" width="100">
      						<?php if($oper=='like'){?>
            						<option selected>like
						<option value>=<?php }else {?>
             						<option selected>=
						<option value>like<?php }?>
            						</select>
              			 	</td>
							<td bgcolor="#FFFFFF"><input type="text" name="scomp" size=20 value="<?php echo $company_match ?>" onkeypress="javascript: return checkenter(event)">
        			 	</td>
							<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
							<td bgcolor="#FFFFFF"><span class="tabletext"><select name="sort1" size="1" width="100">
				
				<?php if($sort1=='wo'){?>
				<option selected>wo
				<option value>company<?php }else {?>
				<option selected>company 
				<option value>wo<?php }?>
             		         		</select></td>
							<td bgcolor="#FFFFFF"><span class="labeltext"><b>Sort by</b></td>
							<td bgcolor="#FFFFFF"><span class="tabletext"><select name="sort2" size="1" width="100">
				<?php if($sort2=='wo'){?>
				<option selected>wo
				<option value>company<?php }else {?>
				<option selected>company 
				<option value>wo<?php }?>
             		         		</select>
<input type="hidden" name="sortfld1">
<input type="hidden" name="sortfld2">
<input type="hidden" name="company_oper">
</td>
							
</tr>
</table>

<?php
} else {?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

		

			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF">

					<table width=100% border=0 cellpadding=6 cellspacing=0  >
						
						<tr><td><span class="pageheading"><b>Delete Work Orders By Selecting Check Boxes</b></td></tr>

						
<?php }?>

<tr><td>
 <div style="overflow: scroll; width: '100%'; height: '60%';"> 
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
						
						<tr>
           		 <td bgcolor="#EEEFEE"><span class="heading"><b>Add</b></td>
            		<td bgcolor="#EEEFEE"><span class="heading"><b>WO</b></td>
            		<td bgcolor="#EEEFEE"><span class="heading"><b><center>Company</center></b></td>
            		<td bgcolor="#EEEFEE"><span class="heading"><b><center>Designer</center></b></td>
            		<td bgcolor="#EEEFEE"><span class="heading"><b><center>Type</center></b></td>
            		<td bgcolor="#EEEFEE"><span class="heading"><b><center>Cust PO</center></b></td>
            		<td bgcolor="#EEEFEE"><span class="heading"><b>Quote</b></td>  
            		<td bgcolor="#EEEFEE"><span class="heading"><b><center>Status</center></b></td>    
            		<td bgcolor="#EEEFEE"><span class="heading"><b><center>Sch Due Date(yymmdd)</center></b></td>
            		<td bgcolor="#EEEFEE"><span class="heading"><b><center>Actual Ship Date(yymmdd)</center></b></td>  
                 	</tr>
<?php
	if ($add=="LinkWO")
	 {
		   $result =$newpo->addwo4Po($cond,$porecnum,$offset, $rowsPerPage);
		  $result1 =$newpo->getAddwocount4Po($cond,$porecnum,$offset, $rowsPerPage);
		  $row     = mysql_fetch_array($result1, MYSQL_ASSOC); 
		  $maxrecno = $row['maxrecno']; 
	}
	else if($add =="UnlinkWO")
	{
	  	   $result = $newpo->getwo4Po($cond,$porecnum,$offset, $rowsPerPage); 
		  $result1 =$newpo->getlinkedwocount4Po($cond,$porecnum,$offset, $rowsPerPage);
		  $row     = mysql_fetch_array($result1, MYSQL_ASSOC); 
		  $maxrecno = $row['maxrecno']; 
	}
                $flag = 0;
	$flag4max=0;
             // $maxrecs=0;
                while ($myrow = mysql_fetch_row($result)) 
	{	
		$flag4max=1;
	     	//$maxrecs=$maxrecs + 1;
		if ($flag == 0)
		{
			$chknm="ckbo" . $myrow[11];
			//echo "$chknm</br>";
	     		printf('<tr><td rowspan=2 bgcolor="#FFFFFF"><span class="tabletext"><input type="checkbox" name=%s value=""></td>',$chknm);
			$val="val". $myrow[11];
			echo "<input type =\"hidden\" name=$val value=$myrow[11]>";
	               		$i++;
	                  	      printf('<td rowspan=2 bgcolor="#FFFFFF"><span class="tabletext">%s</td>',
		                     $myrow[0]); 
	               		$flag = 1;
		?>
                          		<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
                         		<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[13] ?></td>
                          		<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
                        		<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
                          		<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[4] ?></td>
                          		<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[5] ?></td>
               	          		<td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow[14] != '00-00-00') echo $myrow[14] ?></td>
               	         		<td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow[15] != '00-00-00') echo $myrow[15] ?></td></tr>
                          		<tr><td colspan=8 bgcolor="#FFFFFF"><span class="heading">Description:<span class="tabletext"><?php echo $myrow[12] ?></td></tr>
                         		</tr>
		<?php
        		}
                	else
		{
			$chknm="ckbo".$myrow[11];
	                	printf('<tr bgcolor="#EEEEEE"><td rowspan=2 bgcolor="#FFFFFF"><span class="tabletext"><input type="checkbox" name=%s value="" ></td>',$chknm);
			$val="val".$myrow[11];
			echo "<input type =\"hidden\" name=$val value=$myrow[11]>";
              	                                printf('<td rowspan=2 bgcolor="#FFFFFF"><span class="tabletext">%s</td>',
		                $myrow[0]); 
                                	$flag = 0;
		?>
                          		<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
                          		<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[13] ?></td>
                          		<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
                          		<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
                          		<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[4] ?></td>
                          		<td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[5] ?></td>
               	          		<td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow[14] != '00-00-00') echo $myrow[14] ?></td>
                          		<td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow[15] != '00-00-00') echo $myrow[15] ?></td></tr>
                          		<tr bgcolor="#EEEEEE"><td colspan=8 bgcolor="#FFFFFF"><span class="heading">Description:<span class="tabletext"><?php echo $myrow[12] ?></td></tr>
                          		</tr>
		<?php
                	}
    	}

	if ($flag4max==0)
	{
                  	echo "<input type =\"hidden\" name=\"max\" value=0>";
	}
	else
 	{         printf('<input type="hidden" name="max" value=%s>',$maxrecno);
                }

?>


</table>
</div>

</td></tr>



					</table>

				</td>
				<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>

		</table>


<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
	<td align=left>   
</td>
</tr></table>
<input type="submit" name="submit1" style="font=bold;color=#0066CC;background-color:#DDDDDD;height=25;width=85;"
  value="<?php echo "$add";?>">

</form>
</body>
</html>

