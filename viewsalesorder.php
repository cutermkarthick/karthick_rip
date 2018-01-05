<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = July 10, 2006                =
// Filename: viewsalesorder.php                =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Displays list of Salesorder.                =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'viewsalesorder';
//session_register('pagename');
 $userrole = $_SESSION['userrole'];
 //echo   $userrole;
//Following code added to implement search,sort  and Pagination on Dec 29-04 by Jerry George

$wcond = '';
$sort1='name';
$select='name';
$worec='';
$where1='';
$oper='like';
if ( !isset ( $_SESSION['cname'] ) )
{
     $_SESSION[cname]=$_REQUEST['cname'];
}

if($_REQUEST['cname']=='' && $_REQUEST['partnumber']=='' && $_REQUEST['engapp']=='' && $_REQUEST['qaapp']==''&& $_REQUEST['crnnumber']=='')
{
	$wcond = "company.name like '". $_SESSION[cname]."'";
}

//echo $_SESSION[cname];
if ( isset ( $_REQUEST['cname'] ))
{
  $_SESSION[cname]=$_REQUEST['cname'];  
 $wcond = "company.name like '". $_SESSION[cname]."'";
}
if($_REQUEST['partnumber']!='')
{
if($wcond!='')
{
 $partnumber = "'" . $_REQUEST['partnumber'] . "%" . "'";
 $wcond .=  ' and '.' soli.partnum like '.$partnumber;
}
else
{	
$partnumber = "'" . $_REQUEST['partnumber'] . "%" . "'";
$wcond .= ' soli.partnum like '.$partnumber;
}
}

if($_REQUEST['engapp']!='select' && $_REQUEST['engapp']!='')
{
if($wcond!='')
{
 $engapp = "'" . $_REQUEST['engapp'] . "'"; 
 if($_REQUEST['engapp'] == 'No')
 {
   $wcond .= ' and (r.engineering_approved = "" or r.engineering_approved is null or r.engineering_approved = "no")';
 }
 else
 {
   $wcond .=  ' and r.engineering_approved = "yes"';
 }
}
else
{
 $engapp = "'" . $_REQUEST['engapp'] . "'";
 if($_REQUEST['engapp'] == 'No')
 {
   $wcond .=  ' and (r.engineering_approved = "" or r.engineering_approved is null or r.engineering_approved = "no")';
 }
 else
 {
  $wcond .= 'r.engineering_approved = "yes"';
 } 
}
}

if($_REQUEST['qaapp']!='select' && $_REQUEST['qaapp']!='')
{
if($wcond!='')
{
 $qaapp = "'" . $_REQUEST['qaapp'] . "'";
 if($_REQUEST['qaapp'] == 'No')
 {
   $wcond .=  ' and (r.qa_approved = "" or r.qa_approved is null or r.qa_approved = "no")';
 }
 else
 {
   $wcond .=  ' and '.'r.qa_approved = "yes"';
 }
}
else
{
 $qaapp = "'" . $_REQUEST['qaapp'] . "'";
 if($_REQUEST['qaapp'] == 'No')
 {
   $wcond .=  ' and (r.qa_approved = "" or r.qa_approved is null or r.qa_approved = "no")';
 }
 else
 {
   $wcond .=  'r.qa_approved = "yes"';
 } 
}
}

if(isset ($_REQUEST['status'] ) )
{
     $sval = $_REQUEST['status'];

      if ($sval== 'Open')
      {
         $wcond .= " and  (sales_order.status = '" . $sval . "' || sales_order.status is NULL || sales_order.status = '')";
      }    
      else if ($sval == 'Pending')
      {
         $wcond .= " and  sales_order.status = '" . $sval . "'" ;
      }
     else if ($sval == 'All')
      {
         $wcond .= " and  (sales_order.status like '%' || sales_order.status is NULL)";
      }     
}
else
{
     $sval = 'Pending';
     $wcond .= " and (sales_order.status = '" . $sval . "' || sales_order.status is NULL || sales_order.status = '')";
}
if ( isset ( $_REQUEST['final_ponum'] ) )
{
     $ponum_match = $_REQUEST['final_ponum'];
     if ( isset ( $_REQUEST['ponum_oper'] ) ) {
          $oper1 = $_REQUEST['ponum_oper'];
     }
     else {
         $oper1 = 'like';
     }
     if ($oper1 == 'like') {
         $final_ponum = "'" . $_REQUEST['final_ponum'] . "%" . "'";
     }
     else {
         $final_ponum = "'" . $_REQUEST['final_ponum'] . "'";
     }

     $wcond .= " and  sales_order.po_num " . $oper1 . " " . $final_ponum;
}
else
{
     $ponum_match = '';
}
if($_REQUEST['crnnumber']!='')
{
if($wcond!='')
{
 $crnnumber = "'" . $_REQUEST['crnnumber'] . "%" . "'";
 $wcond .=  ' and '.' soli.crn_num like '.$crnnumber;
}
else
{
$crnnumber = "'" . $_REQUEST['crnnumber'] . "%" . "'";
$wcond .= ' soli.crn_num like '.$crnnumber;
}
}
$partnumber=$_REQUEST['partnumber'];
$crnnum=$_REQUEST['crnnumber'];
$ponum=$_REQUEST['final_ponum'];
if($_SESSION[cname]=='select'  && ($partnumber!='' || $crnnum !='' || $ponum !=''))
{
//echo "am here";
$wcond="soli.partnum like '".$_REQUEST['partnumber']."%'and soli.crn_num like '".$_REQUEST['crnnumber']."%'and sales_order.po_num like '".$_REQUEST['final_ponum']."%' ";
}



//echo 'cond====='.$wcond;
// how many rows to show per page
$rowsPerPage = 100;

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

//echo $wcond;
// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

// First include the class definition
include_once('classes/userClass.php');
include_once('classes/salesorderClass.php');
include_once('classes/displayClass.php');
include('classes/quoteClass.php');
include('classes/quoteliClass.php');
$newsalesorder = new salesorder;
$newdisplay = new display;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/salesorder.js"></script>
<html>
<head>
<title>Customer PO</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
<form action='viewsalesorder.php?salesorder=$salesorder_match&salesorder_oper=$oper&sortfld1=$sort1&salesorderfl=$where1' method='get' enctype='multipart/form-data'>
<?php

include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>
			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr>
        					<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        					<td align="right">&nbsp;
       					    <a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        	    </tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
				<tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	    <td bgcolor="#FFFFFF">
   <table width=100% border=0 cellpadding=6 cellspacing=0  >
      <td><span class="heading"><i>Please click on Sales Order to Edit/Delete</i></td></tr>
      <tr> <td>
          <table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
<td bgcolor="#F5F6F5" colspan="2"><span class="heading"><b><center>Search Criteria</center></b></td>										
											<td width="6%" rowspan=5 align="center" bgcolor="#FFFFFF">
 <input type= "image" name="submit" src="images/bu-get.gif" value="Get" onClick="javascript: return searchsort_fields()">					  </td>
										</tr>
										<tr>
										  <td width="23%" align="left" bgcolor="#FFFFFF"><span class="Heading"><strong>Company: </span></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;




							<?
							$res=$newsalesorder->getcompany(
							)

							?>

							<select name="cname">

							  <option value="select">Select</option>
  <?

					$row1=mysql_fetch_object($res);
					while($row1!=NULL)
					{

				 $name=$row1->name;
					if($_SESSION[cname]==$row1->name)
					{
					$status="selected";
					}
					else
					{
					$status="false";
					}

					?>
							  <option value="<? echo $row1->name;?>" <?php echo $status?>><? echo $row1->name;?></option>
							  <?
					$row1=mysql_fetch_object($res);
					}
					?>
							          </select></td>
<td width="23%" align="left" bgcolor="#FFFFFF"><span class="labeltext"><span class="Heading"><strong>Part</strong></span><strong>#: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <label>
  <input name="partnumber" type="text" id="partnumber" size="15" value=<?echo $_REQUEST['partnumber'];?>>
  </label>
</strong></td>


						<input type="hidden" name="count" value="0">
												<input type="hidden" name="sortfld1">
												<input type="hidden" name="salesorderfl">
										  <input type="hidden" name="salesorder_oper">										  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	</td>
						</tr>
<tr>
<td width="23%" align="left" bgcolor="#FFFFFF"><span class="labeltext"><span class="Heading">Eng App</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<select name="engapp"   width=4>
<option value='select'>Select
<?
$eng=array('Yes','No');
for($i=0;$i<count($eng);$i++)
{
if($eng[$i] == $_REQUEST['engapp'])
{?>
<option selected value="<? echo $eng[$i] ?>"><?echo $eng[$i] ; ?> 
</option>
<?}
else
{?>
<option value="<? echo $eng[$i] ?>"><?echo $eng[$i] ; ?> 
</option>
<?}
}?>
</select>
</strong>
</td>

<td width="23%" align="left" bgcolor="#FFFFFF"><span class="labeltext"><span class="Heading">QA App</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<select name="qaapp" width=4>
<option value='select'>Select
<?
$qa=array('Yes','No');
for($j=0;$j<count($qa);$j++)
{
if($qa[$j] == $_REQUEST['qaapp'])
{
?>	
<option selected value="<? echo $qa[$j] ?>"><?echo $qa[$j] ; ?> 
</option>
<?}
else
{?>
<option value="<? echo $qa[$j]  ?>"><?echo $qa[$j] ; ?> 
</option>
<?}
}?>
</select>
</strong></td>
</tr>
<tr>
<td width="23" bgcolor="#FFFFFF"><span class="labeltext"><b>Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="tabletext">
<select name="status" size="1">
<?php
    if ($sval == 'Pending')
      {
?>
	<option selected value='Pending'>Pending
	<option value='Open'>Open	
	<option value='All'>All    
<?php
      }
    else  if ($sval == 'Open')
      {
?>
	<option selected value='Open'>Open
	<option value='Pending'>Pending
	<option value='All'>All	
<?php
      }
      
      else if ($sval == 'All')
      {
?>
	<option selected value='All'>All
	<option value='Open'>Open
	<option value='Pending'>Pending	
<?php
      }         
?>
</select>
</td>
<td bgcolor="#FFFFFF"><span class="labeltext"><b>Cust PO</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="tabletext"><select name="ponum_oper" size="1" width="15">
<?php
   if ( isset ( $_REQUEST['ponum_oper'] ) ){
          $check2 = $_REQUEST['ponum_oper'];

                   if ($check2 =='like'){
?>
    	            <option value>=
	                <option selected>like
<?php
                    }else{
?>
                    <option selected>=
	                <option value >like

 <?php
                    }
   }else{
?>
 	<option selected>like
	<option value>=
 <?PHP
  }
 ?>
</select>
<input type="text" name="final_ponum" size=10 value="<?php echo $ponum_match ?>" >
</tr>
<tr>
 <td width="23%" align="left" bgcolor="#FFFFFF"><span class="labeltext"><span class="Heading"><strong>CRN</strong></span><strong>#: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <label>
  <input name="crnnumber" type="text" id="crnnumber" size="15" value=<?echo $_REQUEST['crnnumber'];?>>
  </label>
</strong></td>
<td width="23%" align="left" bgcolor="#FFFFFF"></td>
</tr>
</table>
</td></tr>
<tr><td>
 <table width=100% border=0>
	<tr>
	<td><span class="pageheading"><b>List of Sales Order</b></td>
	<?
	if($_SESSION['department'] == 'PPC' || $_SESSION['department'] == 'PPC1' || $_SESSION['department'] == 'PPC2')
	{?>
	<td colspan=12>&nbsp;</td>
	<td align="right"><a href ="new_so.php"><img name="Image8" border="0" src="images/nso.gif" ></a>
	</td>
		<?}?>
	</tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
        <tr  bgcolor="#FFCC00">
            <td align="center" bgcolor="#EEEFEE" width=5%><span class="tabletext"><b>Sl.#</b></td>
             <td align="center" bgcolor="#EEEFEE" width=8%><span class="tabletext"><b>Company Name</b></td>
            <td align="center" bgcolor="#EEEFEE" width=6%><span class="tabletext"><b>Cust PO</b></td>
            <td align="center" bgcolor="#EEEFEE" width=6%><span class="tabletext"><b>Status</b></td>       
		    <td align="center" bgcolor="#EEEFEE" width=5%><span class="tabletext"><b>Eng<br>App</b></td>
            <td align="center" bgcolor="#EEEFEE" width=5%><span class="tabletext"><b>QA<br>App</b></td>
			<td align="center" bgcolor="#EEEFEE" width=5%><span class="tabletext"><b>Prodn<br>App</b></td>
            <td align="center" bgcolor="#EEEFEE" width=8%><span class="tabletext"><b>Order Date</b></td>
            <td align="center" bgcolor="#EEEFEE" width=8%><span class="tabletext"><b>Part No</b></td>
			<td align="center" bgcolor="#EEEFEE" width=70px><span class="tabletext"><b>PRN</b></td>
			<td align="center" bgcolor="#EEEFEE" width=30px><span class="tabletext"><b>Ln</b></td>
            <td align="center" bgcolor="#EEEFEE" width=8%><span class="tabletext"><b>PO Qty</b></td>
            <td align="center" bgcolor="#EEEFEE" width=8%><span class="tabletext"><b>WO No</b></td>
            <td align="center" bgcolor="#EEEFEE" width=8%><span class="tabletext"><b>WO Qty</b></td>
            <td align="center" bgcolor="#EEEFEE" width=8%><span class="tabletext"><b>Acc</b></td>  
            <td align="center" bgcolor="#EEEFEE" width=6%><span class="tabletext"><b>QA Rej</b></td>
            <td align="center" bgcolor="#EEEFEE" width=6%><span class="tabletext"><b>Cust Rej</b></td>
			<td align="center" bgcolor="#EEEFEE" width=6%><span class="tabletext"><b>Ret Qty</b></td>
            <td align="center" bgcolor="#EEEFEE" width=8%><span class="tabletext"><b>Balance<br>(Pre dispatch)</b></td>        

<?php
            $result = $newsalesorder->getSalesorders($wcond);
            //$result = $newsalesorder-> getso($cond,$sort1,$offset,$rowsPerPage);
            $prevnum = '';
            $prev_partnum = '';
            $prev_linenum = '';
            $tot=0;
		   $c=0;
		   $span = 1;
		   while ($myrow = mysql_fetch_row($result)) {
           if($prevnum != $myrow[0])
           {
           	$tot=$tot+$myrow[6];
           }
                    	$curr = $myrow[7] . " ";
	      		$c=+1;
              		$d=substr($myrow[10],8,2);
              		$m=substr($myrow[10],5,2);
              		$y=substr($myrow[10],0,4);
              		$x=mktime(0,0,0,$m,$d,$y);
              		$date=date("M j, Y",$x);

   	            printf('<tr bgcolor="#FFFFFF">');
   	            if($prevnum != $myrow[0])
   	            {
                        $statcolor = "#FFFFFF";
                        if ($myrow[18] == 'Open')
                        {
                           $statcolor = '"#00FF00"';
                        }                      
                        else 
                        {
                           $statcolor = '"#FF0000"';
                        }	
						
						if ($myrow[20] == 'yes' && $myrow[19] == 'yes' && $myrow[24] == 'yes')
                        {
						   $color = '"#00FF00"';
						}
						if ($myrow[20] == 'no' && $myrow[19] == 'no' && $myrow[24] == 'no')
                        {
						   $color = '"#FF0000"';
						}
						if ($myrow[20] == '' && $myrow[19] == '' && $myrow[24] == '')
                        {
						   $color = '"#FFFFFF"';
						}

						if ($myrow[20] == 'no' && $myrow[19] == 'yes' || $myrow[20] == 'yes' && $myrow[19] == 'no' )
                        {
						   $color = '"#FF0000"';
						}
						if ($myrow[20] == 'yes' && $myrow[19] == '' || $myrow[20] == '' && $myrow[19] == 'yes')
                        {
						   $color = '"#FF0000"';
						}  
						if ($myrow[20] == 'no' && $myrow[19] == '' || $myrow[20] == '' && $myrow[19] == 'no')
                        {
						   $color = '"#FF0000"';
						} 					
                        
						 $company_name=wordwrap($myrow[1],18,"<br/>\n",true);

                        printf("<td align=\"center\"><span class=\"tabletext\"><a href=\"viewsoDetails.php?salesorderrecnum=%s\">%s</td>
                          <td align=\"center\"><span class=\"tabletext\">%s</td>
                          <td align=\"center\"><span class=\"tabletext\">%s</td>
                          <td bgcolor=$statcolor align=\"left\"><span class=\"tabletext\">%s</td>
                          <td bgcolor=$color align=\"left\"><span class=\"tabletext\">%s</td>
						  <td bgcolor=$color align=\"left\"><span class=\"tabletext\">%s</td>
						  <td bgcolor=$color align=\"left\"><span class=\"tabletext\">%s</td>
                          <td align=\"left\"><span class=\"tabletext\">%s</td>",

                          $myrow[0],$myrow[0],
                          $company_name,
                          $myrow[4],
                          $myrow[18],
                          $myrow[20],
						  $myrow[19],
						  $myrow[24],
                          $date);
                      $span++;
                    }
                    else
                    {
                       printf('<td align="center"><span class="tabletext"><a href="viewsoDetails.php?salesorderrecnum="></td>
                          <td align="center"><span class="tabletext"></td>
                          <td align=\"center\"><span class=\"tabletext\"></td>
                          <td align="left"><span class="tabletext"></td>
						   <td align="left"><span class="tabletext"></td>
						    <td align="left"><span class="tabletext"></td>
							 <td align="left"><span class="tabletext"></td>
                          <td align="left"><span class="tabletext"></td>');
                    }
                    $wotype4rej=$newsalesorder->getwotype4rej($myrow[14]);
                    $cust_rejqty=0;$rejqty=0;$retqty=0;
                 if($wotype4rej=='With Treatment')
            {
                $result4rejqty4treat = $newsalesorder->getrej_qty4treat($myrow[14]);
                $myrow4rejqty4treat =  mysql_fetch_row($result4rejqty4treat);
                $cust_rejqty = $myrow4rejqty4treat[2];
                $result4rejqty = $newsalesorder->getrej_qty($myrow[14]);
                $myrow4rejqty =  mysql_fetch_row($result4rejqty);
                $rejqty = $myrow4rejqty[0];
			    $retqty=$myrow4rejqty[1];
			    $cust_rejqty = $myrow4rejqty[2];
            }
            else
            {
                $result4rejqty = $newsalesorder->getrej_qty($myrow[14]);
                $myrow4rejqty =  mysql_fetch_row($result4rejqty);
                $rejqty = $myrow4rejqty[0];
			    $retqty=$myrow4rejqty[1];
			    $cust_rejqty = $myrow4rejqty[2];
            }
                 if($prev_partnum != $myrow[11] || $prev_linenum != $myrow[23])
                 {
                   $fc="#ffffff";
                   if ($myrow[12]-$myrow[13] < 0)
                   {
                       $fc = "#ff0000";
                   }

                   printf("<td align=\"left\"><span class=\"tabletext\">%s</td>
                          <td align=\"left\"><span class=\"tabletext\">%s</td>
						  <td align=\"left\"><span class=\"tabletext\">%s</td>
                          <td align=\"left\"><span class=\"tabletext\">%s</td>
                          <td align=\"left\"><span class=\"tabletext\">%s</td>
                          <td align=\"left\"><span class=\"tabletext\">%s</td>
                          <td bgcolor=$fc align=\"left\"><span class=\"tabletext\">%s</td>
                          <td align=\"left\"><span class=\"tabletext\">%s</td>
						  <td align=\"left\"><span class=\"tabletext\">%s</td>
						  <td align=\"left\"><span class=\"tabletext\">%s</td>
                          <td align=\"left\"><span class=\"tabletext\"
						  >%s</td>
						  ",
                          $myrow[11],
						  $myrow[22],
						  $myrow[23],
                          $myrow[12],
                          $myrow[14],
                          $myrow[13],
                          $myrow[15],
                          $rejqty,
                          $cust_rejqty,
                          $retqty,
                          $myrow[12]-$myrow[13]+$rejqty+$retqty+$cust_rejqty
                          );

                          $nextpoqty = $myrow[12]-$myrow[13]+$rejqty+$retqty+$cust_rejqty;
                  }
                  else
                  {
                    if ($prevnum != $myrow[0])
                     {
                      $prevnum = $myrow[0];
                      $prev_partnum = $myrow[11];
                      $partnum = $myrow[11];
                      $pqty = $myrow[12];
                      $prev_linenum != $myrow[23];
                      //$totamount = $totamount + $myrow[16];

                    printf("<td  align=\"left\"><span class=\"tabletext\">%s</td>
					    <td  align=\"left\"><span class=\"tabletext\">%s</td>
						<td  align=\"left\"><span class=\"tabletext\">%s</td>
                        <td  align=\"left\"><span class=\"tabletext\">%s</td>
                        <td  align=\"left\"><span class=\"tabletext\">%s</td>
                        <td  align=\"left\"><span class=\"tabletext\">%s</td>
                        <td  bgcolor=$fc align=\"left\"><span class=\"tabletext\">%s</td>
                        <td  align=\"left\"><span class=\"tabletext\">%d</td>
						<td  align=\"left\"><span class=\"tabletext\">%s</td>
						<td  align=\"left\"><span class=\"tabletext\">%d</td>
                        <td  align=\"left\"><span class=\"tabletext\">%d</td>
                        ",
                        $myrow[11],
						$myrow[22],
						$myrow[23],
                        $myrow[12],
                        $myrow[14],
                        $myrow[13],
                        $myrow[15],
                        $rejqty,
                        $cust_rejqty,
						$retqty,
                        $myrow[12]-$myrow[13]+$rejqty+$retqty+$cust_rejqty
                        );
                       $nextpoqty = $myrow[12]-$myrow[13]+$rejqty+$retqty+$cust_rejqty;
                  
                  }
                  else
                  {
                   $fc="#ffffff";
                   if ($myrow[12]-$myrow[13] < 0)
                   {
                       $fc = "#ff0000";
                   }

                   printf("<td align=\"left\"><span class=\"tabletext\"></td>
                          <td align=\"left\"><span class=\"tabletext\"></td>    
						   <td align=\"left\"><span class=\"tabletext\"></td>
						   <td align=\"left\"><span class=\"tabletext\"></td>      
                          <td align=\"left\"><span class=\"tabletext\">%s</td>
                          <td align=\"left\"><span class=\"tabletext\">%s</td>
                          <td bgcolor=$fc align=\"left\"><span class=\"tabletext\">%s</td>
                          <td align=\"left\"><span class=\"tabletext\">%s</td>
						  <td align=\"left\"><span class=\"tabletext\">%s</td>
						  <td align=\"left\"><span class=\"tabletext\">%s</td>
                          <td align=\"left\"><span class=\"tabletext\">%s</td>",
                          $myrow[14],
                          $myrow[13],
                          $myrow[15],
                          $rejqty,
                          $cust_rejqty,
			              $retqty,
                          $nextpoqty-$myrow[13]+$rejqty+$retqty+$cust_rejqty
                          );

                          $nextpoqty =$nextpoqty-$myrow[13]+$rejqty+$retqty+$cust_rejqty;
                  }

              printf('</td></tr>');
             }
              $prevnum = $myrow[0];
              $prev_partnum = $myrow[11];
              $prev_linenum = $myrow[23];

        }
		//$tot=floatval($tot);
if($c!=0)
{
?>

<?php
}
?>
</table>
      </table>
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

<?php

//Additions on Dec 29 04 by Jerry George to implement pagination

//$numrows = $newsalesorder->getsoCount($cond,$offset,$rowsPerPage);
// how many pages we have when using paging?
$numrows=8;
$maxPage = ceil($numrows/$rowsPerPage);
//echo "$maxPage</br>";
if (!isset($_REQUEST['page']))
{
//   echo "page is set";
    $totpages = $maxPage;
}

//echo "total pages :$totpages</br>";
$self = $_SERVER['PHP_SELF'];

// creating 'previous' and 'next' link
// plus 'first page' and 'last page' link

// print 'previous' link only if we're not
// on page one
if ($pageNum > 1)
{
    $page = $pageNum - 1;
    $prev = " <a href=\"viewsalesorder.php?page=$page&totpages=$totpages&salesorder=$salesorder_match&salesorder_oper=$oper\">[Prev]</a> ";

    $first = " <a href=\"viewsalesorder.php?page=1&totpages=$totpages&salesorder=$salesorder_match&salesorder_oper=$oper\">[First Page]</a> ";
}
else
{
    $prev  = ' [Prev] ';       // we're on page one, don't enable 'previous' link
    $first = ' [First Page] '; // nor 'first page' link
}

// print 'next' link only if we're not
// on the last page
if ($pageNum < $totpages)
{
    $page = $pageNum + 1;
    $next = " <a href=\"viewsalesorder.php?page=$page&totpages=$totpages&salesorder=$salesorder_match&salesorder_oper=$oper\">[Next]</a> ";

    $last = " <a href=\"viewsalesorder.php?page=$totpages&totpages=$totpages&salesorder=$salesorder_match&salesorder_oper=$oper\">[Last Page]</a> ";
}
else
{
    $next = ' [Next] ';      // we're on the last page, don't enable 'next' link
    $last = ' [Last Page] '; // nor 'last page' link
}
if($totpages!=0)
{
//$pageNum=0;
// print the page navigation link
echo "<span class=\"labeltext\">" . $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$totpages</strong> pages " . $next . $last;
}
else
echo "<span class=\"labeltext\"><align=\"center\">No matching records found";
// End additions on Dec 29,04

?>
								</td>
							</tr>
						</table>
      </FORM>
</body>
</html>
