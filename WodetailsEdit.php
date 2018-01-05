<?php


//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: boardwoEntry.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Allows Board WO entry.                      =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];
$userrole = $_SESSION['userrole'];

//echo "dept is $dept";
$_SESSION['pagename'] = 'wodetailsEdit';
$page = "WO: Reg WO";
//////session_register('pagename');


// First include the class definition
include_once('classes/loginClass.php');
include('classes/workorderClass.php');
include('classes/displayClass.php');
include('classes/datesClass.php');
include('classes/approvalClass.php');
include('classes/nc4qaclass.php');

 //include('classes/mmClass.php');
   include('classes/inClass.php');
   include('classes/mmClass.php');
   include('classes/fidClass.php');
   include('classes/irmClass.php');
   include('classes/siClass.php');
   include('classes/masterdataClass.php');
   include('classes/ddClass.php');

   $newmm = new mm;
   $newfid = new fid;
   $newirm = new irm;
   $newsi = new stage_insp;
   $newMD = new masterdata;
   $newdd = new dd;
   $newin = new in;

if (isset($_REQUEST['typenum']))
{
	$typenum=$_REQUEST['typenum'];
	$_SESSION['typenum'] = $typenum;
	//////session_register('typenum');
}
if (isset($_REQUEST['wotype']))
{
	$wotype=$_REQUEST['wotype'];
	$_SESSION['wotype'] = $wotype;
	//////session_register('wotype');

}
if (isset($_REQUEST['worecnum']))
{
	$worecnum=$_REQUEST['worecnum'];
	$_SESSION['worecnum'] = $worecnum;
	//////session_register('worecnum');
}
$typenum =$_SESSION['typenum'] ;
$wotype =$_SESSION['wotype'] ;
$worecnum =$_SESSION['worecnum'] ;
$userid = $_SESSION['user'];
$newlogin = new userlogin;
$newlogin->dbconnect();

$newwo = new workOrder;
$newnc4qa = new nc4qa;
$newapproval = new approval;
$newdisp = new display;

$newmm = new mm;

//echo "typenum:$typenum<br>";

$result = $newwo->getGenInfo($worecnum);
$myrow = mysql_fetch_row($result);
$result = $newwo->getAddrInfo($worecnum);
$myaddr = mysql_fetch_row($result);
$result = $newwo->getwoDetails2($wotype,$myrow[6]);
//$myWo = mysql_fetch_row($result);
$result = $newwo->getParts($typenum);
$myParts = mysql_fetch_row($result);
$newDates = new dates;
$timeline = $newDates->getdates('WO', $worecnum,$wotype);
$result1 = $newwo->attachments($worecnum);
$attachedfile = mysql_fetch_assoc($result1);

  //echo $myrow[30]."in ed".$dept."---//-**";
  
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/WorkOrderAerowings.js"></script>
<script language="javascript" src="scripts/woentry.js"></script>
<html>
<head>
<title><?php echo $wotype?>  Wo Edit</title>
<script language="javascript" type="text/javascript">
function Disable(form) {
if (document.getElementById) {
for (var i = 0; i < form.length; i++) {
if (form.elements[i].type.toLowerCase() == "submit")
form.elements[i].disabled = true;
}
}
return true;
}
</script>

</head>

<body leftmargin="0" topmargin="0" marginwidth="0" rightmargin="0" onload="javascript:clearPo()" >
<form action='processGenericWO.php' method='post' enctype='multipart/form-data' onSubmit='Disable(this);'>
<input type="hidden" name="hidpname" id="hidpname" value="WodetailsEdit">

<?php
include('header.html');
?>
<!-- <table width=100% cellspacing="0" cellpadding="0" border="0">
<table width=100% cellspacing="0" cellpadding="6" border="0">
<input type="hidden" id="prevgrnnum" name="prevgrnnum" size=12 value="<?php echo $myrow[26]?>" >
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;
    <a href="exit.php" onMouseOut="MM_swapImgRestore()"
    onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0"  src="images/logout.gif"></a>
</td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td>
</td></tr>
<tr>
<td>
<?php $newdisp->dispLinks(''); ?>
</td></tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td> -->
<td bgcolor="#FFFFFF">

<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>
   <td><span class="pageheading"><b>Edit Work Order</b></td>
 </tr>

<?php if($userrole == 'SU' || $dept == 'Purchasing')
    {
?>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 id="tablemd" class="stdtable1">

 <tr bgcolor="#DDDEDD">
            <td colspan=8><span class="heading"><center><b>Work Order Information</b></center></td>
      </tr>
      <tr bgcolor="#FFFFFF">
              <td colspan=2><span class="labeltext"><p align="left">Work Order</p></td>
              <?php
       if($myrow[0] != ''&& $myrow[0] != 'NULL')
      {
              $wonumarr = split('-', $myrow[0]);
              $wonum_suff=$wonumarr[1];
              if($wonum_suff != ''&& $wonum_suff != 'NULL')
              {
              $wonum_suf='-'.$wonumarr[1];
              }
              else
              {
               $wonum_suf =$wonum_suff;
              }
              $wonum_mod=$wonumarr[0];

      }
              ?>
            <td colspan=2><span class="tabletext"><input type="text" name="wonum" size=12 value="<?php printf  ("%05d%s",$myrow[0],$wonum_suf) ?>"  style="background-color:#DDDDDD;" readonly='readonly'></td>

      <td colspan=2><span class="labeltext"><p align="left">Work Order Qty</p></td>
             <?php
			if($myrow[38] > 0)
				{
					$woqty = $myrow[38];
                    $amndqty = $myrow[27];
				}
                if($myrow[38]  == 0 || $myrow[38] == 'null' || $myrow[38] == '')
				{
					$woqty = $myrow[27];
                    $amndqty = 0;
				}

            if($dept != 'Purchasing')
            {
            ?>
            <td colspan=2><span class="tabletext"><input type="text" id="qty" name="qty" size=12 style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $woqty  ?>"></td>
             <?php
            }
            else
            {
            ?>
             <td colspan=2><span class="tabletext"><input type="text" id="qty" name="qty" style="background-color:#DDDDDD;" readonly="readonly" size=12 value="<?php echo $woqty ?>"></td>
             <?php
            }
            ?>
            <input type="hidden" id="pwoqty" name="pwoqty" size=20 value="">
      </tr>
      <tr bgcolor="#FFFFFF">
       <td colspan=2><span class="labeltext"><p align="left">Work Order Type</p></font></td>
       <?php
        if($dept != 'Sales' && $dept != 'PPC')
        {
        ?>
             <td colspan=2><span class="tabletext"><input type="text" name="woclassif" id="woclassif" size=12 value="<?php echo $myrow[30]  ?>" style="background-color:#DDDDDD;" readonly='readonly'>
		<?php
        }
        else
        {
       ?>
           	<td colspan=2><span class="labeltext"><input type="text" name="woclassif" id="woclassif" size="15" value="<?php echo $myrow[30]?>"
			    style="background-color:#DDDDDD;" readonly='readonly'>
            <span class="tabletext"><select name="classiftype" id="classiftype" size="1" width="100" onchange="onSelectclassif()">
            <option selected value="Regular">Regular</option>
            <option value="Rework">Rework </option>
            <option value="Split">Split</option>
 	        <option value="Assembly">Assembly</option>
	        <option value="Split Assembly">Split Assembly</option>
            <option value="Migrate">Migrate</option>
           	</select>
		    </td>
        <?php
        }
        ?>
       <!-- <td colspan=2><span class="labeltext"><p align="left">Treatment</p></font></td>
	     	<td colspan=2><span class="labeltext"><input type="text" name="treatment" id="treatment" size="15" value="<?php echo $myrow[40]?>"
			    style="background-color:#DDDDDD;" readonly='readonly'>
            <span class="tabletext"><select name="treattype" size="1" width="100" onchange="onSelecttreat()">
            <option selected>Manufacture Only
            <option value>With Treatment
           	</select>
		   </td>

       </tr>-->
	   <td colspan=4>&nbsp</td>
       <tr bgcolor="#FFFFFF" id="wo_status">
         <td colspan=2><span class="labeltext">Stage</font></td>
         <?php
               if($dept =='Sales' || $dept =='PPC')
               {
               ?>
                  	    <td colspan=5><input type="text" id="stage_split" name="stage_split" size=20 value="<?php echo $myrow[43] ?>"></td>
                <?php
                  }
                  else
                  {
                ?>
   	    <td colspan=5><input type="text" id="stage_split" name="stage_split" size=20 style="background-color:#DDDDDD;" readonly='readonly' value="<?php echo $myrow[43] ?>"></td>
        <?php
          }
        ?>
        </tr>

               <input type="hidden" name="partrecnum" value="<?php echo $myParts[1] ?>">
               <input type="hidden" name="reordercb" value="<?php echo $myrow[21] ?>"

            </td>

        </tr>
   <tr  bgcolor="#FFFFFF">
   <td colspan=2><span class="tabletext"><p align="left"><b>Work Order Date</b></p></font></td>
            <td colspan=2><input type="text" name="book_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php echo $myrow[19] ?>">
            <?php
            if($dept != 'Purchasing')
            {
            ?>
             <img src="images/bu-getdate.gif" alt="Get BookDate" onClick="GetDate('book_date')">
             <?php
            }
            else
            {
            ?>
            </td>
             <?php
            }
            ?>
			<input type="hidden" name="descr" size=95 value="<?php echo $myrow[7] ?>">
			<td colspan=2><span class="labeltext"><p align="left">Work Order Ref#</p></font></td>
            <td colspan=2><input type="text" id="worefnum"  name="worefnum" size=20 value="<?php echo $myrow[31] ?>" style="background-color:#DDDDDD;" readonly="readonly">
             <input type="hidden" id="worefnumrecnum" name="worefnumrecnum" size=12 style="background-color:#DDDDDD;">
             <?php
            if($dept != 'Purchasing')
            {
            ?>
            <img src="images/bu_getwo.gif" alt="Get Wo" onclick="Getwo_crn()">
            <?php
            }
            else
            {
            ?>
            </td>
            <?php
            }?>

   </tr>
   <tr bgcolor="#FFFFFF">
   <?php
	        if ($myrow[47] == 1)
		    {
	           $printapproval = "Y";
		    }
		    else {
				$printapproval = "N";
		    }
            if($dept != 'Sales' && $dept != 'PPC')
            {
?>

                           <td colspan=2><span class="tabletext"><b>Print Approval</b></td>
                          <td colspan=2><input type="text" name="printapproval"
                           style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php echo $printapproval ?>"></td>
                    <td colspan=2><span class="tabletext"><b>Work Order Priority</b></td>
                          <td colspan=2><input type="text" name="priority"
                           style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php echo $myrow[54]  ?>"></td>
<?php
			}
            else
            {
?>

                           <td colspan=2><span class="tabletext"><b>Print Approval(Y/N)</b></td>
                          <td colspan=2><input type="text" id="printapproval"  name="printapproval"
                           size=10 value="<?php echo $printapproval ?>"></td>
                            <td colspan=2><span class="tabletext"><b>Work Order Priority</b></td>
                          <td colspan=2><input type="text" name="priority" size=12 value="<?php echo $myrow[54]  ?>"></td>
<?php
			}

?>
                         <!-- <td   colspan=2><span class="tabletext"><b>&nbsp</b></td>
                          <td colspan=2></td> -->
                      </tr>
      <?php

         $result = $newwo->getlink2masterdata($worecnum);
         $myrec =  mysql_fetch_row($result);
         $link2masterdata = $myrec[0];

         //echo $link2masterdata;

         include("mdedit.php");

      ?>


      <tr bgcolor="#DDDEDD">
            <td colspan=8><span class="heading"><center><b>General Information</b></center></td>
      </tr>
      


      <tr bgcolor="#FFFFFF">

            <td colspan=2><span class="labeltext"><p align="left">Customer PO#</p></font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="ponum" id="ponum" size=12 value="<?php echo $myrow[3]  ?>" style="background-color:#DDDDDD;" readonly='readonly'>
          <?php
            if($dept == 'Sales')
            {
            ?>
            <img src="images/bu-getpo.gif" onClick="Getpo('ponum')" id='poimg'></td>
            <?php
            }
            else
            {
            ?>
            </td>
            <?php
            }
          ?>
	     <input type="hidden" name="companyrecnum" id="companyrecnum" value="<?php echo $myrow[14]  ?>">
         <input type="hidden" name="cust_po_line_num" id="cust_po_line_num" value="<?php echo $myrow[39]  ?>"></td>

         <td colspan=2><span class="labeltext"><p align="left">Customer</p></font></td>
            <td colspan=2><input type="text" name="company" id="company"
                    style=";background-color:#DDDDDD;"
                    readonly="readonly" size=25 value="<?php echo $myrow[2] ?>">
            <?php
             if($dept != 'Purchasing')
             {
             ?>
               <img src="images/bu-getcustomer.gif" alt="Get Customer" onClick="GetAllCustomers()">
            </td>
            <?php
             }
            else
            {
            ?>
            </td>
            <?php
            }
            ?>

          </tr>

          <tr  bgcolor="#FFFFFF">
           
            <td colspan=2><span class="labeltext"><p align="left">Customer PO Date</p></font></td>
            <td colspan=2><input type="text" name="po_date" id="po_date" style="background-color:#DDDDDD;" readonly="readonly" size=18 value="<?php echo $myrow[4] ?>">

             <td colspan=2><span class="labeltext"><p align="left">Customer PO Qty(Balance)</p></font></td>
            <td colspan=2><input type="text" name="po_qty" id="po_qty"
                           
                   size=18 value="<?php echo $myrow[28]?>" style="background-color:#DDDDDD;" readonly='readonly'>
            
            </td>           


        </tr>
		
        <tr bgcolor="#FFFFFF" id="grn_img">
           <td colspan=2><span class="labeltext"><p align="left">GRN#&nbsp;</p></font></td>
            <td colspan=2><input type="text" id="grnnum" name="grnnum" size=12 value="<?php echo $myrow[26]?>" style="background-color:#DDDDDD;" readonly='readonly'>
             <?php
            if($dept != 'Purchasing')
            {
            ?>
            <img src="images/bu-get.gif" alt="Get Grn" onClick="Getgrns('grnnum')">
             <?php
            }
            else
            {
            ?>
            </td>
             <?php
            }
            ?>
            <td colspan=2><span class="labeltext"><p align="left">Batch Num&nbsp;</p></font></td>
             <?
            if($dept != 'Purchasing')
            {
           ?>
            <td colspan=2><input type="text" id="batchnum" name="batchnum" size=12 value="<?php echo $myrow[29]?>" style="background-color:#DDDDDD;" readonly="readonly">
            <?php
            }
            else
            {
            ?>
             <td colspan=2><input type="text" id="batchnum" name="batchnum" size=12 value="<?php echo $myrow[29]?>" style="background-color:#DDDDDD;" readonly="readonly">
             <?php
            }
            ?>
        </tr>
        <tr bgcolor="#FFFFFF" id="grn_img_rm_spec">
            <td colspan=2><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td colspan=2><input type="text" name="rm_type" id="rm_type" style="background-color:#DDDDDD;" size=20 value="<?php echo $myrow[49]?>" readonly='readonly'></td>
            <td colspan=2><span class="labeltext"><p align="left">RM Specification</p></font></td>
            <td colspan=2><input type="text" name="rm_spec" id="rm_spec" style="background-color:#DDDDDD;" size=20 value="<?php echo $myrow[48]?>" readonly='readonly'></td>
        </tr>
        <tr bgcolor="#FFFFFF" id="grn_noimg">
           <td colspan=2><span class="labeltext"><p align="left">GRN#&nbsp;</p></font></td>
            <td colspan=2><input type="text" id="grnnum_split" name="grnnum_split" size=12 value="<?php echo $myrow[26]?>" style="background-color:#DDDDDD;" readonly='readonly'>
             <?php
            if($dept != 'Purchasing')
            {
            ?>

             <?php
            }
            else
            {
            ?>
            </td>
             <?php
            }
            ?>
            <td colspan=2><span class="labeltext"><p align="left">Batch Num&nbsp;</p></font></td>
             <?
            if($dept != 'Purchasing')
            {
           ?>
            <td colspan=2><input type="text" id="batchnum_split" name="batchnum_split" size=12 value="<?php echo $myrow[29]?>" style="background-color:#DDDDDD;" readonly="readonly">
            <?php
            }
            else
            {
            ?>
             <td colspan=2><input type="text" id="batchnum" name="batchnum" size=12 value="<?php echo $myrow[29]?>" style="background-color:#DDDDDD;" readonly="readonly">
             <?php
            }
            ?>
        </tr>
         <tr bgcolor="#FFFFFF" id="grn_noimg_rm_spec">
            <td colspan=2><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td colspan=2><input type="text" name="rm_type_split" id="rm_type_split" style="background-color:#DDDDDD;" size=20 value="<?php echo $myrow[49]?>" readonly='readonly'></td>
            <td colspan=2><span class="labeltext"><p align="left">RM Specification</p></font></td>
            <td colspan=2><input type="text" name="rm_spec_split" id="rm_spec_split" style="background-color:#DDDDDD;" size=20 value="<?php echo $myrow[48]?>" readonly='readonly'></td>
        </tr>
		<tr bgcolor="#FFFFFF">
        <td colspan=2><span class="labeltext"><p align="left">Amendment Qty</p></font></td>
        <?php
          if($amndqty >0)
          {
          ?>
            <td colspan=2><input type="text" name="amendqty" id="amendqty"
                   size=18 style="background-color:#DDDDDD;"  readonly='readonly' value="<?php echo $amndqty?>"> </td>
        <?php
          }else
          {
        ?>
        <td colspan=2><input type="text" name="amendqty" id="amendqty"
                   size=18 value="<?php echo $amndqty?>"> </td>
        <?php
        }
        ?>
        <input type="hidden" name="prevamendqty" id="prevamendqty"
                   size=18 style="background-color:#DDDDDD;"  readonly='readonly' value="<?php echo $amndqty?>">


		<td colspan=2><span class="labeltext">
            <p align="left">Amendment Date</p></font></td>

           <td colspan=2><input type="text" id="amenddate"  name="amenddate" style="background-color:#DDDDDD;" readonly="readonly"
           size="10%" value="<?echo $myrow[36]?>">
           <?php
            if($dept !='Purchasing')
            {
            ?>
           <img src="images/bu-getdateicon.gif" alt="GetDate"
           onclick="GetDate('amenddate')">
           <?php
           }
           ?></td>
		 </tr>
         <?$finalqty=($myrow[37] == '')?'0':$myrow[37];
		  ?>
		  
	  	<tr bgcolor="#FFFFFF">
        <td colspan=2><span class="labeltext"><p align="left">Type</p></font></td>
         <td colspan=2><input type="text" name="fai" id="fai" style="background-color:#DDDDDD;" readonly="readonly"
                   size=12 value="<?php echo $myrow[41]?>"></td>
         <td colspan=2><span class="labeltext"><p align="left">WO Status</p></font></td>

         <td colspan=2><input type="text" name="condition" id="condition" size=8
                        style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow[22]?>">
      <?php
         if($dept == 'QA')
         {
      ?>
            <span class="tabletext"><select name="condtype" size="1" width="100" onchange="onSelectcond()">
            <option selected value="Open">Open
            <option value="Closed">Closed
            <option value="Cancelled">Cancelled
           	</select>
           	<?php
           	}
           if($dept == 'PPC4' || $dept == 'PPC5')         
		   {
      ?>
            <span class="tabletext"><select name="condtype" size="1" width="100" onchange="onSelectcond()">
            <option value="WO Cancelled">WO Cancelled
            <option value="Cancelled">Cancelled
           	</select>
           	<?php
           	}

	     if($dept == 'Sales')
         {
         ?>
            <span class="tabletext"><select name="condtype" size="1" width="100" onchange="onSelectcond()">
            <option selected value="Open">Open
            <option value="Closed">Closed
            <option value="Cancelled">Cancelled
            <option value="WO Cancelled">WO Cancelled
            <option value="Migrated">Migrated
           	</select>
           	<?php
           	}
           	?>
               <input type="hidden" name="prevcondition" id="prevcondition" size=8
                        style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow[22]?>"></td>
         </tr>
		<tr bgcolor="#FFFFFF">		
           <td bgcolor="#FFFFFF" colspan=2><span class="heading"><b>Amendment Notes</b></td>
           <?php
         if($dept == 'PPC4' || $dept == 'PPC5')
         {
         ?>
          <td colspan=2><textarea name="amendnotes" rows=2 cols=30 ><?php echo $myrow[37]?></textarea></td>
           </td>
         <?php
         }
         else
         {
         ?>
           <td colspan=2><textarea name="amendnotes" rows=2 cols=30 style="background-color:#DDDDDD;" readonly="readonly"><?php echo $myrow[37]?></textarea></td>
         <?php
         }
         ?>

		
         <td bgcolor="#FFFFFF" colspan=2><span class="heading"><b>Remarks</b></td>
         <?php
		 $remark = wordwrap($myrow[33],90,"\n");
         if($dept != 'Purchasing')
         {
         ?>
          <td colspan=2><textarea name="remarks" id="remarks" rows=3 cols=45><?php echo $remark?></textarea>
           </td>
         <?php
         }
         else
         {
         ?>
           <td colspan=2><textarea name="remarks"  id="remarks" rows=3 cols=45 style="background-color:#DDDDDD;" readonly="readonly"><?php echo $remark?></textarea></td>
         <?php
         }
         ?>
        </tr>
         <tr bgcolor="#FFFFFF">
        <?php
         // echo $myrow[57]."in ed".$dept."----**";
if($myrow[30] == 'Rework' && $dept =='Purchasing')
	{
            $checked="checked";
        ?>

            <td colspan=2><span class="labeltext">Approval</td>
            <td colspan=2bgcolor="#FFFFFF" ><input type="checkbox" <?php echo $myrow[56] == 'yes'?$checked:"" ?>  id="approved_wo" name="approved_wo" onclick="JavaScript:toggleValue('approved_re_wo',this);">
                         <input type="hidden" name="approved_re_wo" value="<?php echo $myrow[56]?>" id="approved_re_wo">
                         <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
                         <input type="hidden" name="approved_by" id="approved_by" value="<?php echo $myrow[55]?>"></td>
           <td colspan=2><span class="labeltext">Approved Date</td>
          <td colspan=2><span class="tabletext"><input type="text" name="approval_date" id="approval_date"
                style="background-color:#DDDDDD;" readonly="readonly"  value="<?php echo $myrow[57] ?>"></td>

<?php
	} else
	{
     ?>
        <input type="hidden" name="approved_re_wo" value="<?php echo $myrow[56]?>" id="approved_re_wo">
        <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
        <input type="hidden" name="approved_by" id="approved_by" value="<?php echo $myrow[55]?>">
        <input type="hidden" name="approval_date" id="approval_date" value="<?php echo $myrow[57] ?>">

     <?php
     }
     ?>
          </tr>
     <?php
            printf('<tr  bgcolor="#DDDEDD"><td colspan=12><span class="heading"><center><b>WO Notes for '. $myrow[0] .'</b></center></td></tr>');
            $result = $newwo->getNotes4wo($worecnum);
            printf('<tr bgcolor="#FFFFFF"><td colspan=12><textarea rows="6" cols="89" readonly="readonly">');
            while ($mynotes4wo = mysql_fetch_row($result)) {
                  printf("\n");
                  printf("********Added by $mynotes4wo[2] on $mynotes4wo[0]*******");
                  printf("\n");
                  printf($mynotes4wo[1]);
                  printf("   \n");
            }

?>
      </textarea></td>
      </tr>
     <?php printf('<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Add Notes</b></center></td></tr>'); ?>
      <tr bgcolor="#FFFFFF">
       <td colspan=8><textarea name="notes" id="notes" rows="3" cols="89" value=""></textarea>
       </td> </tr>

        
       <input type="hidden" name="owner"
                            style=";background-color:#DDDDDD;"
                    readonly="readonly" size=18 value='xyz'>
            

    <input type="hidden" name="quoterecnum">
    <input type="hidden" name="sorecnum">
    <!--<input type="hidden" name="bomrecnum" value="<?php /*echo $myrow[25] */?>">-->
    <input type="hidden" name="reorder" value="<?php echo $myrow[21] ?>">
	<input type="hidden" name="emprecnum" value="<?php echo $myrow[16] ?>">

         <div id="fair">
         <input type="hidden" id="fair_stat" name="fair_stat" value="<?php echo '0'?>">
         <input type="hidden" id="prev_fairs" name="prev_fairs" value="<?php echo '0'?>">
         </div>
           <input type="hidden" name="contact"
                           style="background-color:#DDDDDD;"
                    readonly="readonly" size=25 value="xyz">
	<input type="hidden" name="contactrecnum" value="<?php echo $myrow[15] ?>">


            <input type="hidden" name="phone" style="background-color:#DDDDDD;"
                              readonly="readonly" size=25 value="12345">

            
           <input type="hidden" name="email" style="background-color:#DDDDDD;"
                         readonly="readonly" size=30 value="<?php echo $myrow[11]?>">
        
<input type="hidden" name="wotype" value="<?php echo $wotype?>">
<input type="hidden" name="deptname" id="deptname" value="<?php echo $dept?>">
<input type="hidden" name="action" value="edit">

</table>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

 <!--<tr bgcolor="#DDDEDD">
            <td colspan=8><span class="heading"><center><b>Attachments</b></center></td>
        </tr>
           <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext"><p align="left">File1</p></font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="filename1" value="<?php //echo $attachedfile["filename1"] ?>"></td>
            <td colspan=2><span class="labeltext"><p align="left">File2</p></font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="filename2" value="<?php //echo $attachedfile["filename2"] ?>"></td>
         </tr>
           <tr bgcolor="#FFFFFF">
            <td colspan=2><span class="labeltext"><p align="left">File3</p></font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="filename3" value="<?php //echo $attachedfile["filename3"] ?>"></td>
            <td colspan=2><span class="labeltext"><p align="left">File4</p></font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="filename4" value="<?php //echo $attachedfile["filename4"] ?>"></td>
        </tr>-->
  </table>

<?php
  }
  else
  {
?>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 id="tablemd">
<tr bgcolor="#DDDEDD">
            <td colspan=8><span class="heading"><center><b>Work Order Information</b></center></td>
      </tr>
      <tr bgcolor="#FFFFFF">
       <td colspan=2><span class="labeltext"><p align="left">Work Order</p></td>
       <td colspan=2><span class="tabletext"><input type="text" name="wonum" size=12 value="<?php printf  ("%05d",$myrow[0]) ?>"  style="background-color:#DDDDDD;" readonly='readonly'></td>
        <td colspan=2><span class="labeltext"><p align="left">Work Order Qty</p></td>
             <?php
			if($myrow[38] > 0)
				{
					$woqty = $myrow[38];
                    $amndqty = $myrow[27];
				}
                if($myrow[38]  == 0 || $myrow[38] == 'null' || $myrow[38] == '')
				{
					$woqty = $myrow[27];
                    $amndqty = 0;
				}

            if($dept != 'QA' && $dept != 'PPC5'&&$dept != 'PPC4' && $dept != 'Purchasing')
            {
            ?>
            <td colspan=2><span class="tabletext"><input type="text" id="qty" name="qty" size=12 style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $woqty  ?>"></td>
             <?php
            }
            else
            {
            ?>
             <td colspan=2><span class="tabletext"><input type="text" id="qty" name="qty" style="background-color:#DDDDDD;" readonly="readonly" size=12 value="<?php echo $woqty ?>"></td>
             <?php
            }
            ?>
      </tr>
      <tr bgcolor="#FFFFFF">
       <td colspan=2><span class="labeltext"><p align="left">Work Order Type</p></font></td>
       <?php
        if($dept != 'Sales' && $dept != 'PPC')
         {
        ?>
             <td colspan=2><span class="tabletext"><input type="text" name="woclassif" id="woclassif" size=12 value="<?php echo $myrow[30]  ?>" style="background-color:#DDDDDD;" readonly='readonly'>
		<?php
        }
        else
        {
       ?>
           	<td colspan=2><span class="labeltext"><input type="text" name="woclassif" id="woclassif" size="15" value="<?php echo $myrow[30]?>"
			    style="background-color:#DDDDDD;" readonly='readonly'>
            <span class="tabletext"><select name="classiftype" id="classiftype" size="1" width="100" onchange="onSelectclassif()">
            <option selected>Regular
            <option value>Rework
            <option value>Split
           	</select>
		   </td>
        <?php
        }
        ?>
        <td colspan=4></td>
       <!-- <td colspan=2><span class="labeltext"><p align="left">Treatment</p></font></td>-->
       <?php
       // if($dept != 'Sales' && $dept != 'PPC')
      //  {
        ?>
        <!--     <td colspan=2><span class="tabletext"><input type="text" name="treatment" id="treatment" size=15 value="<?php echo $myrow[40]  ?>" style="background-color:#DDDDDD;" readonly='readonly'>-->
		<?php
      //  }
       // else
      //  {
       ?>

	   <!--  	<td colspan=2><span class="labeltext"><input type="text" name="treatment" id="treatment" size="15" value="<?php echo $myrow[40]?>"
			    style="background-color:#DDDDDD;" readonly='readonly'>
            <span class="tabletext"><select name="treattype" size="1" width="100" onchange="onSelecttreat()">
            <option selected>Manufacture Only
            <option value>With Treatment
           	</select>
		   </td>-->
        <?php
       // }
        ?>
       </tr>
        <tr bgcolor="#FFFFFF" id="wo_status">
         <td colspan=2><span class="labeltext">Stage</font></td>
         <?php
               if($dept !='Sales' && $dept !='PPC' && $dept != 'QA' && $dept != 'PPC5' && $dept != 'PPC4'&& $dept != 'Purchasing')
               {
               ?>
                  	    <td colspan=18><input type="text" id="stage_split" name="stage_split" size=20 value="<?php echo $myrow[43] ?>"></td>
                <?php
                  }
                  else
                  {
                ?>
   	    <td colspan=18><input type="text" id="stage_split" name="stage_split" size=20 style="background-color:#DDDDDD;" readonly='readonly' value="<?php echo $myrow[43] ?>"></td>
        <?php
          }
        ?>
       <tr bgcolor="#FFFFFF">
        <td colspan=2><span class="tabletext"><p align="left"><b>Work Order Date</b></p></font></td>
            <td colspan=2><input type="text" name="book_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php echo $myrow[19] ?>">
            <?php
            if($dept != 'QA' && $dept != 'PPC4' && $dept != 'PPC5' && $dept != 'Purchasing')
            {
            ?>
             <img src="images/bu-getdate.gif" alt="Get BookDate" onClick="GetDate('book_date')">
             <?php
            }
            else
            {
            ?>
            </td>
             <?php
            }
            ?>
            <td colspan=2><span class="labeltext"><p align="left">Work Order Ref#</p></font></td>
            <td colspan=2><input type="text" id="worefnum"  name="worefnum" size=20 value="<?php echo $myrow[31] ?>" style="background-color:#DDDDDD;" readonly="readonly">
             <?php
            if($dept != 'QA' && $dept != 'PPC4' && $dept != 'PPC5' && $dept != 'Purchasing')
            {
            ?>
            <img src="images/bu_getwo.gif" alt="Get Wo" onclick="Getwo_crn()">
            <?php
            }
            else
            {
            ?>
            </td>
            <?php
            }?>
       </tr>

      <?php

         $result = $newwo->getlink2masterdata($worecnum);
         $myrec =  mysql_fetch_row($result);
         $link2masterdata = $myrec[0];

         // echo $link2masterdata;

         include("mdedit.php");

      ?>

<?php
/*if ($userrole == 'RU' ) {
 $ctrls=$newwo->createctrls4SU($worecnum) ;
 echo "$ctrls";
}
else if ($userrole == 'DESG_B')
{
 $ctrls=$newwo->createctrls4RU($worecnum) ;
 echo "$ctrls";
}
else if ($userrole == 'CUST') {
 $ctrls=$newwo->createctrls4CUST($worecnum) ;
 echo "$ctrls";
}

else if ($userrole == 'SALES') {
 $ctrls=$newwo->createctrls4CUST($worecnum) ;
 echo "$ctrls";
}
else if ($userrole == 'SALES PERSON') {
 $ctrls=$newwo->createctrls4CUST($worecnum) ;
 echo "$ctrls";
}
else if ($userrole == 'SALES MANAJER') {
 $ctrls=$newwo->createctrls4CUST($worecnum) ;
 echo "$ctrls";
}*/
?>
      <tr bgcolor="#DDDEDD">
            <td colspan=8><span class="heading"><center><b>General Information</b></center></td>
      </tr>


       <tr bgcolor="#FFFFFF">

            <td colspan=2><span class="labeltext"><p align="left">Customer PO#</p></font></td>
            <td colspan=2><span class="tabletext"><input type="text" name="ponum" id="ponum" size=12 value="<?php echo $myrow[3]  ?>" style="background-color:#DDDDDD;" readonly='readonly'>
          <?php
            if($dept == 'Sales')
            {
            ?>
            <img src="images/bu-getpo.gif" onClick="Getpo('ponum')" id='poimg'></td>
            <?php
            }
            else
            {
            ?>
            </td>
            <?php
            }
          ?>
           <input type="hidden" name="companyrecnum" value="<?php echo $myrow[14]  ?>">
         <input type="hidden" name="cust_po_line_num" id="cust_po_line_num" value="<?php echo $myrow[39]  ?>"></td>

         <td colspan=2><span class="labeltext"><p align="left">Customer</p></font></td>
            <td colspan=2><input type="text" name="company" id="company"
                    style=";background-color:#DDDDDD;"
                    readonly="readonly" size=25 value="<?php echo $myrow[2] ?>">
            <?php
             if($dept != 'QA'&& $dept != 'PPC4' && $dept != 'PPC5'&& $dept != 'Purchasing')
             {
             ?>
               <img src="images/bu-getcustomer.gif" alt="Get Customer" onClick="GetAllCustomers()">
            </td>
            <?php
             }
            else
            {
            ?>
            </td>
            <?php
            }
            ?>

			<input type="hidden" name="descr" size=95 value="<?php echo $myrow[7] ?>">

          <tr  bgcolor="#FFFFFF">

            <td colspan=2><span class="labeltext"><p align="left">Customer PO Date</p></font></td>
            <td colspan=2><input type="text" name="po_date" id="po_date" style="background-color:#DDDDDD;" readonly="readonly" size=18 value="<?php echo $myrow[4] ?>">

             <td colspan=2><span class="labeltext"><p align="left">Customer PO Qty(Balance)</p></font></td>
            <td colspan=2><input type="text" name="po_qty" id="po_qty"

                   size=18 value="<?php echo $myrow[28]?>" style="background-color:#DDDDDD;" readonly='readonly'>

            </td>


        </tr>
        <tr bgcolor="#FFFFFF">
           <td colspan=2><span class="labeltext"><p align="left">GRN#&nbsp;</p></font></td>
            <td colspan=2><input type="text" id="grnnum" name="grnnum" size=12 value="<?php echo $myrow[26]?>" style="background-color:#DDDDDD;" readonly='readonly'>
             <?php
            if($dept != 'QA'&& $dept != 'PPC4' && $dept != 'PPC5'&& $dept != 'Purchasing')
            {
            ?>
            <img src="images/bu-get.gif" alt="Get Grn" onClick="Getgrns('grnnum')">
             <?php
            }
            else
            {
            ?>
            </td>
             <?php
            }
            ?>
            <td colspan=2><span class="labeltext"><p align="left">Batch Num&nbsp;</p></font></td>
             <?
            if($dept != 'QA'&& $dept != 'PPC4' && $dept != 'PPC5' && $dept != 'Purchasing')
            {
           ?>
            <td colspan=2><input type="text" id="batchnum" name="batchnum" size=12 value="<?php echo $myrow[29]?>" style="background-color:#DDDDDD;" readonly="readonly">
            <?php
            }
            else
            {
            ?>
           <td colspan=2><input type="text" id="batchnum" name="batchnum" size=12 value="<?php echo $myrow[29]?>" style="background-color:#DDDDDD;" readonly="readonly">
             <?php
            }
            ?>

        </tr>
        <tr bgcolor="#FFFFFF">
        <td colspan=2><span class="labeltext"><p align="left">RM Type</p></font></td>
            <td colspan=2><input type="text" name="rm_type" id="rm_type" style="background-color:#DDDDDD;" size=20 value="<?php echo $myrow[49]?>" readonly='readonly'></td>
            <td colspan=2><span class="labeltext"><p align="left">RM Specification</p></font></td>
            <td colspan=2><input type="text" name="rm_spec" id="rm_spec" style="background-color:#DDDDDD;" size=20 value="<?php echo $myrow[48]?>" readonly='readonly'></td>
        </tr>
        <tr bgcolor="#FFFFFF">
        <?php
        if($dept != 'PPC4' && $dept != 'PPC5' && $dept != 'Purchasing')
        {
        ?>
        <td colspan=2><span class="labeltext"><p align="left">Amendment Qty</p></font></td>
         <td colspan=2><input type="text" name="amendqty" id="amendqty"
                   size=18 style="background-color:#DDDDDD;"
                              readonly="readonly" value="<?php echo $amndqty?>"> </td>

		<td colspan=2><span class="labeltext">
            <p align="left">Amendment Date</p></font></td>
           <td colspan=2><input type="text" id="amenddate"  name="amenddate" style="background-color:#DDDDDD;" readonly="readonly"
           size="10%" value="<?echo $myrow[36]?>"> </td>
        <?php
        }else
        {
        ?>

         <td colspan=2><span class="labeltext"><p align="left">Amendment Qty</p></font></td>
         <?php
          if($amndqty >0)
          {
          ?>
            <td colspan=2><input type="text" name="amendqty" id="amendqty"
                   size=18 style="background-color:#DDDDDD;"  readonly='readonly' value="<?php echo $amndqty?>"> </td>
        <?php
          }else
          {
        ?>
        <td colspan=2><input type="text" name="amendqty" id="amendqty"
                   size=18 value="<?php echo $amndqty?>"> </td>
        <?php
        }
        ?>
		<td colspan=2><span class="labeltext">
            <p align="left">Amendment Date</p></font></td>
           <td colspan=2><input type="text" id="date"  name="amenddate" style="background-color:#DDDDDD;" readonly="readonly"
           size="10%" value="<?echo $myrow[36]?>"> <img src="images/bu-getdateicon.gif" alt="GetDate"
           onclick="GetDate('amenddate')"> </td>

        <?php
        }
        ?>
        <input type="hidden" name="prevamendqty" id="prevamendqty"
                   size=18 style="background-color:#DDDDDD;"  readonly='readonly' value="<?php echo $amndqty?>">
		 </tr>
         <?$finalqty=($myrow[37] == '')?'0':$myrow[37];
		  ?>

	  	<tr bgcolor="#FFFFFF">
        <td colspan=2><span class="labeltext"><p align="left">Type</p></font></td>
         <td colspan=2><input type="text" name="fai" id="fai" style="background-color:#DDDDDD;" readonly="readonly"
                   size=8 value="<?php echo $myrow[41]?>"></td>
         <td colspan=2><span class="labeltext"><p align="left">WO Status</p></font></td>
         <td colspan=2><input type="text" name="condition" id="condition"
                   size=8 style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow[22]?>">
         <?php
           if($dept == 'PPC4' || $dept == 'PPC5' )
         {
         ?>
                   <span class="tabletext">
                   <select name="condtype" size="1" width="100" onchange="onSelectcond()">
            <option value="Cancelled">Cancelled
            <option value="WO Cancelled">WO Cancelled
           	</select>
               <?php
               }
           if($dept == 'QA' )
         {
         ?>
                   <span class="tabletext">
                   <select name="condtype" size="1" width="100" onchange="onSelectcond()">
                   <option value="Closed">Closed
            <option value="Cancelled">Cancelled
           	</select>
               <?php
               }
               ?>
               <input type="text" name="prevcondition" id="prevcondition" size=8
                        style="background-color:#DDDDDD;" readonly="readonly" value="<?php echo $myrow[22]?>"></td>
         </tr>
		<tr bgcolor="#FFFFFF">
           <td bgcolor="#FFFFFF" colspan=2><span class="heading"><b>Amendment Notes</b></td>
           <td colspan=2><textarea name="amendnotes" rows=2 cols=30 style="background-color:#DDDDDD;"
                              readonly="readonly" ><?php echo $myrow[37]?></textarea>

         <td bgcolor="#FFFFFF" colspan=2><span class="heading"><b>Remarks</b></td>
         <?php
		 $remark = wordwrap($myrow[33],90,"\n");
         if($dept != 'QA'&& $dept != 'Purchasing')
         {
         ?>
          <td colspan=2><textarea name="remarks" rows=3 cols=45><?php echo $remark?></textarea>
           </td>
         <?php
         }
         else
         {
         ?>
           <td colspan=2><textarea name="remarks" rows=3 cols=45 style="background-color:#DDDDDD;" readonly="readonly"><?php echo $remark?></textarea>
         <?php
         }
         ?>
        </tr>

        <input type="hidden" name="approved_re_wo" value="<?php echo $myrow[56]?>" id="approved_re_wo">
        <input type="hidden" name="userid" id="userid" value="<?php echo $userid;?>">
        <input type="hidden" name="approved_by" id="approved_by" value="<?php echo $myrow[55]?>">
        <input type="hidden" name="approval_date" id="approval_date" value="<?php echo $myrow[57] ?>">

     <?php

            printf('<tr  bgcolor="#DDDEDD"><td colspan=12><span class="heading"><center><b>WO Notes for '. $myrow[0] .'</b></center></td></tr>');
            $result = $newwo->getNotes4wo($worecnum);
            printf('<tr bgcolor="#FFFFFF"><td colspan=12><textarea  rows="6" cols="89" style="background-color:#DDDDDD;" readonly="readonly">');
            while ($mynotes4wo = mysql_fetch_row($result)) {
                  printf("\n");
                  printf("********Added by $mynotes4wo[2] on $mynotes4wo[0]*******");
                  printf("\n");
                  printf($mynotes4wo[1]);
                  printf("   \n");
            }

?>
      </textarea></td>
      </tr>
     <?php printf('<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b>Add Notes</b></center></td></tr>'); ?>
      <tr bgcolor="#FFFFFF">
       <td colspan=8><textarea name="notes" id="notes" rows="3" cols="89" value=""></textarea>
       </td> </tr>
               <input type="hidden" name="partrecnum" value="<?php echo $myParts[1] ?>">
               <input type="hidden" name="reordercb" value="<?php echo $myrow[21] ?>"

            </td>

        </tr>

       <input type="hidden" name="owner"
                            style=";background-color:#DDDDDD;"
                    readonly="readonly" size=18 value='xyz'>


    <input type="hidden" name="quoterecnum">
    <input type="hidden" name="sorecnum">
    <!--<input type="hidden" name="bomrecnum" value="<?php /*echo $myrow[25] */?>">-->
    <input type="hidden" name="reorder" value="<?php echo $myrow[21] ?>">
	<input type="hidden" name="emprecnum" value="<?php echo $myrow[16] ?>">

         <div id="fair">
         <input type="hidden" id="fair_stat" name="fair_stat" value="<?php echo '0'?>">
         <input type="hidden" id="prev_fairs" name="prev_fairs" value="<?php echo '0'?>">
         </div>
           <input type="hidden" name="contact"
                           style="background-color:#DDDDDD;"
                    readonly="readonly" size=25 value="xyz">
	<input type="hidden" name="contactrecnum" value="<?php echo $myrow[15] ?>">


            <input type="hidden" name="phone" style="background-color:#DDDDDD;"
                              readonly="readonly" size=25 value="12345">


           <input type="hidden" name="email" style="background-color:#DDDDDD;"
                         readonly="readonly" size=30 value="<?php echo $myrow[11]?>">

<input type="hidden" name="wotype" value="<?php echo $wotype?>">
<input type="hidden" name="deptname" id="deptname" value="<?php echo $dept?>">
<input type="hidden" name="action" value="edit">

</table>


<?php
 /*$result = $newwo->getlink2masterdata($worecnum);
 $myrec =  mysql_fetch_row($result);
 $link2masterdata = $myrec[0];
include("mddetails.php"); */
?>

<table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=4>
 <tr bgcolor="#DDDEDD">
           <!-- <td colspan=6><span class="heading"><center><b>Attachments</b></center></td>-->
 </tr>
           <tr bgcolor="#FFFFFF">
            <td><span class="labeltext" width=25%><p align="left">File1</p></font></td>
            <td><span class="tabletext" width=25%><input type="text" name="filename1" style="background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $attachedfile["filename1"] ?>"></td>
            <td><span class="labeltext" width=25%><p align="left">File2</p></font></td>
            <td><span class="tabletext" width=25%><input type="text" name="filename2" style="background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $attachedfile["filename2"] ?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">File3</p></font></td>
            <td><span class="tabletext"><input type="text" name="filename3" style="background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $attachedfile["filename3"] ?>"></td>
            <td><span class="labeltext"><p align="left">File4</p></font></td>
            <td><span class="tabletext"><input type="text" name="filename4" style="background-color:#DDDDDD;"
                    readonly="readonly" value="<?php echo $attachedfile["filename4"] ?>"></td>
        </tr>

</table>

<!--<input type="hidden" name="wotype" value="<?php echo $wotype?>">
<input type="hidden" name="action" value="edit">
<input type="hidden" name="company" id="company">
<input type="hidden" name="companyrecnum" value="<?php echo $myrow[14]  ?>">
<input type="hidden" name="cust_po_line_num" value="<?php echo $myrow[39]  ?>">
<input type="hidden" name="contactrecnum">
<input type="hidden" name="contact">
<input type="hidden" name="phone">
<input type="hidden" name="email">
<input type="hidden" name="wonum">
<input type="hidden" name="ponum">
<input type="hidden" name="quotenum">
<input type="hidden" name="descr">
<input type="hidden" name="reorder">
<input type="hidden" name="emprecnum">
<input type="hidden" name="book_date">
<input type="hidden" name="grnnum"> -->

<?php
  }   

        /*if($client =='yes')
        {
           if( $userrole == 'SU' || ($userrole == 'RU' && $dept == 'Stores'))
           {
              include("irmEdit.php");
           }
           else
           {
              include("irmDetails.php");
           }

            if( $userrole == 'SU' || ($userrole == 'RU' && $dept == 'Production'))
           {
             include("mmedit.php");
            if($userrole == 'RU')
            {
             include("siEdit.php");
            }
           }

            else
           {
             include("mmdetails.php");

           }


            if( $userrole == 'SU' || ($userrole == 'RU' && $dept == 'QA'))
           {
              include("siEdit.php");
              include("fidEdit.php");
              include("ddEdit.php");
           }
           else
           {

               include("siDetails.php");
               include("fidDetails.php");
               include("ddDetails.php");
           }

        }
    
    
      /*  if($mm==1)
       {
           include("client/irmEdit.php");
           include("client/mmedit.php");
           include("client/fidedit.php");
        }  */
		include("inedit.php");
	?>

  <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable1">

        <tr bgcolor="#DDDEDD">
            <td colspan=13><span class="heading"><center><b>Timeline & Owner</b></center></td>
        </tr>


      <tr bgcolor="#FFFFFF">
            <td><span class="tabletext"><p align="left"><b>Sch Due Date</b></p></font></td>
            <td><input type="text" name="sch_due_date" id="sch_due_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php echo $myrow[17]?>">
              <?php
            if($dept != 'QA' && $dept != 'Purchasing'&& $dept != 'PPC4'&& $dept != 'PPC5')
            {
            ?>
             <img src="images/bu-getdate.gif" alt="Get SchDueDate" onClick="GetSch()">
             <?php
            }
            else
            {
            ?>
             </td>
            <?php
            }
            ?>
             <input type="hidden" name="prev_rev_ship_date" value="<?php echo $myrow[20] ?>">
            <td><span class="tabletext"><p align="left"><b>Revised Completed Date</b></p></font></td>
            <td><input type="text" name="rev_ship_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php echo $myrow[20]?>">
            <?php
            if($dept != 'QA'&& $dept != 'Purchasing'&& $dept != 'PPC4'&& $dept != 'PPC5')
            {
            ?>
             <img src="images/bu-getdate.gif" alt="Get RevShipDate"  onclick="GetDate('rev_ship_date')">
              <?php
            }
            else
            {
            ?>
             </td>
            <?php
             }
			 ?>
            <td><span class="tabletext"><p align="left"><b>Actual Completion Date</b></p></font></td>
            <td><input type="text" id="act_ship_date" name="act_ship_date"
                    style="background-color:#DDDDDD;"
                    readonly="readonly" size=12 value="<?php echo $myrow[18]?>">
                    <?php
            if($_SESSION['department'] == 'QA' || $_SESSION['department'] == 'Sales')
            {
            ?>
             <img src="images/bu-getdate.gif" alt="Get RevShipDate"  onclick="GetDate('act_ship_date')">
              <?php
            }
            else
            {
            ?>
             </td>
            <?php
             }
            ?>

             </td>
<?php
/*
if ($myrow[18] != '0000-00-00' && $myrow[18] != '')
	$link=$myrow[18];
else
	//$link='View Shipment'
	$link='<span class="tabletext"><p align="left"><b>View Shipment</b></p></font>  '  */
?>
       <!--     <td><a href ="javascript:enterShipment()"><?php echo $link?></a>
            </td>    -->

      </tr>
     </table>
<!--<input type="hidden" name="act_ship_date" value="<?php// echo $myrow[18]?>">-->



	<table border=0 bgcolor="#" width=100% cellspacing=1 cellpadding=3>
    <?php if($userrole != 'RU')
          {

    ?>
        <!--<tr bgcolor="#FFFFFF">
			<td colspan="6"><a href="javascript:editRow('mytable',document.forms[0].msdynamic.value)"> <img src="images/bu-addrow.gif" border="0"></a></td>
		</tr>-->
    <?php
          }
    ?>
     <table border=0 bgcolor="#000000" width=100% cellspacing=1 cellpadding=3 id="mytable" class="stdtable1">

        <tr  bgcolor="#FFFFFF">
          <td width=8% bgcolor="#EEEFEE"><span class="heading"><b>Department</b></span></td>
          <td width=4% bgcolor="#EEEFEE"><span class="heading"><b>Stage#</b></span></td>
          <td width=15% bgcolor="#EEEFEE"><span class="heading"><b>Milestone</b></span></td>
          <td width=4% bgcolor="#EEEFEE"><span class="heading"><b>Dep#</b></span></td>
	        <td width=9% bgcolor="#EEEFEE"><span class="heading"><b>Sch Date</b></span></td>
         

          <td width=10% bgcolor="#EEEFEE"><span class="heading"><b>Completed Date</b></span></td>
	        <td width=11% bgcolor="#EEEFEE"><span class="heading"><b><center>Primary <br>Responsibility</center></b></span></td>
          <td width=12% bgcolor="#EEEFEE"><span class="heading"><b><center>Approved by</center></b></span></td>

          <td width=11% bgcolor="#EEEFEE"><span class="heading"><b><center>Secondary <br> Responsibility</center></b></td>
          <td width=11% bgcolor="#EEEFEE"><span class="heading"><b><center>Process</center></b></td>
          <td width=20% bgcolor="#EEEFEE"><span class="heading"><b><center>ETA</center></b></td>
          
        </tr>


        <input type="hidden" name="max" value="<?php echo "$wfcnt";?>">
        <input type="hidden" name="recnum" size=15 value="<?php echo $myrow[6] ?>">
        <input type="hidden" name="worecnum" value="<?php echo $worecnum ?>">
        <input type="hidden" name="deleteflag" value="">
        <input type="hidden" name="msdynamic" value="0">
        <input type="hidden" name="deptname" id="deptname" size=15 value="<?php echo $dept?>">
        <input type="hidden" name="wotype" size=15 value="<?php echo $wotype?>">
<!-- </table>

<div style="width:1000px height:100; overflow:auto;border:">
   <table border=0 bgcolor="#000000" width=100% cellspacing=1 cellpadding=3  class="stdtable1"> -->
      <?php
      if($userrole == 'SU' && $dept != 'PPC' && $dept != 'Purchasing')
      {
        $j=1;
        $department = "";
        $i=0;

        $t=0;
        $x=0;

        while ($mytl = mysql_fetch_row($timeline)) 
        {
      
          $dates="dates" . $j;
          $dater="dater" . $j;
          $datec="datec" . $j;

          if($mytl[28] != $department)
          {
            $t++;
            if($i == 1)
            {
              $i = 0;
            }
            else if ($i == 0)
            {
             $i = 1;
            }
          }

         ?>

          <tr <?php if ($i == 1){echo "class='bgcolor3'";} else{echo "class='bgcolor4'";}?> id="mytable<?php echo $t ?>">
            <td width=8%><span class="heading"><b><i>
            <?php
              if($mytl[28] != $department){
            ?>
              <span><!-- <a href="javascript:showTable('mytable<?php  echo $t+1; ?>')"> + </a>/ <a href="javascript:hideTable('mytable<?php  echo ++$t; ?>')">-</a> --></span>
              <?php echo $mytl[28];
              } 
            ?></i></b></span></td>

            <td width=4%><span class="heading"><?php  echo $mytl[31] ?></td>
            <td width=15%><span class="heading"><?php echo $mytl[30] ?></td>
            <input type="hidden" name="seqnum<?php echo $j?>" id="seqnum<?php echo $j?>" value="<?php echo $mytl[30] ?>"></td>
            <td width=4%><span class="heading"><?php echo $mytl[34] ?></td>

            <?php
            
            if($mytl[2] != '' && $mytl[2] != '0000-00-00' && $mytl[2] != 'NULL')
            {
              $d=substr($mytl[2],8,2);
              $m=substr($mytl[2],5,2);
              $y=substr($mytl[2],0,4);
              $x=mktime(0,0,0,$m,$d,$y);
              $date1=date("M j, Y",$x);
            }
            else
            {
              $date1 = '';
            }
            ?>


            <td width=9%><input type="text" id="<?php echo $dates ?>" name="<?php echo $dates ?>" style="background-color:#FFF8C6;" readonly="readonly" size=10 value="<?php if ($mytl[2] != '0000-00-00') echo $mytl[2] ?>"></td>



            <td WIDTH=10% nowrap><input type="text" id="<?php echo $datec ?>" name="<?php echo $datec ?>" style="background-color:#ECE5B6;" readonly="readonly" size=12 value="<?php if ($mytl[4] != '0000-00-00') echo $mytl[4] ?>">
              <img src="images/bu-getdateicon.gif" alt="Get Date" onclick='GetDate("<?php echo $datec; ?>")'>
            </td>


            <?php
            if ($mytl[10] != 'Cust') 
            {
            ?>

            <td width=11% nowrap><input type="text" name="<?php echo $mytl[30],'_owner' ?>" style=";background-color:#FAF8CC;" readonly=" 
              readonly" size=15 value="<?php echo $mytl[38] ?>">
             <!--  <img src="images/bu-ownericon.gif" alt="Get Owner" onclick='GetOwner("<?php echo $mytl[30],'_owner' ?>")'> -->
            </td>

            <?php
            }
            else 
            {
            ?>
            <td WIDTH=11% nowrap><span class="heading"><input type="text" name="<?php echo $mytl[30],'_owner' ?>" style=";background-color:#FAF8CC;" readonly="readonly" size=15 value="<?php echo $mytl[14] ?>">
            </td>

            <?php
            }
            if ($mytl[10] != 'Cust') 
            {
            ?>
              <td WIDTH=12% nowrap><span class="heading"><input type="text" name="<?php echo $mytl[30],'_appr' ?>" style=";background-color:#FAF8CC;"  readonly="readonly" size=15 value="<?php echo $mytl[16] ?>">
                <img src="images/bu-ownericon.gif" alt="Get Owner" onclick='GetApprUser("<?php echo $mytl[30],'_appr' ?>")'>
                <?php //echo $mytl[16] ?>
              </td>

              <input type="hidden" name="<?php echo $mytl[30],'_ownerrecnum' ?>" value="<?php echo $mytl[6] ?>">
              <input type="hidden" name="<?php echo $mytl[30],'_apprrecnum' ?>" value="<?php echo $mytl[19] ?>">

              
            <?php
            }
            else 
            {
              if ($mytl[18] != '')
              {
              ?>
              <td WIDTH=9%><span class="heading"><?php echo $mytl[18] ?></td>
              <?php
              }
              else
              {
              ?>
              <td WIDTH=9%><span class="heading"><?php echo $mytl[16] ?></td>
              <?php
              }
            }
            ?>

                <td width=4%><input type="text" name="secs_respose" 
                id="secs_respose"  readonly="readonly"  style="background-color: #DDDDDD;" size="10" value=" <?php echo $mytl[35] ?>">
          </td>

          <td width=4%>
            <textarea name="process" rows=2 cols=10 readonly="readonly" style="background-color: #DDDDDD; overflow-y: scroll;"> <?php echo $mytl[36] ?></textarea>
        
          </td>

          <td width=4%>
               <textarea name="when_process"  rows=2 cols=10 readonly="readonly" style="background-color: #DDDDDD; overflow-y: scroll;"> <?php echo $mytl[37] ?></textarea>

          </td>

            <!-- <td width=4%><input type="text" name="secs_respose"
                          style="background-color:#DDDDDD;"readonly="readonly" size=12 value="<?php echo $mytl[35] ?>"></td>
            <td width=4%><input type="text" name="process"
                          style="background-color:#DDDDDD;"readonly="readonly" size=12 value="<?php echo $mytl[36] ?>"></td>

           <td width=4%><input type="text" name="when_process"
                          style="background-color:#DDDDDD;"readonly="readonly" size=12 value="<?php echo $mytl[37] ?>"> --></td>

          </tr>

          <?php
          $j++;
          $department= $mytl[28];
        }
      }
  
      else if($userrole='RU' || ($userrole='SU' && $dept=='PPC'))
      {
        $j=1;
        $department = "";
        $i=0;
        $t=0;
        $x=0;
        while ($mytl = mysql_fetch_row($timeline)) 
        {
        
          $dates="dates" . $j;
          $dater="dater" . $j;
          $datec="datec" . $j;

          if($mytl[28] != $department)
          {
            $t++;
            if($i == 1)
            {
              $i = 0;
            }
            else if ($i == 0)
            {
              $i = 1;
            }
          }
          ?>

          <tr  <?php if ($i == 1){echo "class='bgcolor3'";} else{
             echo "class='bgcolor4'";}?> ID="mytable<?php echo $t ?>">

            <td WIDTH=13%><span class="heading"><b><i>
            <?php
            if($mytl[28] != $department)
            { 
            ?>
              <span><a href="javascript:showTable('mytable<?php  echo $t+1; ?>')"> + </a>/ <a href="javascript:hideTable('mytable<?php  echo ++$t; ?>')">-</a></span>
                <?php echo $mytl[28]; 
            } ?></i></b>
            </td>

            <td WIDTH=4%><span class="heading"><?php  echo $mytl[31] ?></td>
            <td WIDTH=21%><span class="heading"><?php echo $mytl[30] ?></td>
            <input type="hidden" name="seqnum<?php echo $j?>" id="seqnum<?php echo $j?>" value="<?php echo $mytl[30] ?>"></td>
            <td WIDTH=4%><span class="heading"><?php echo $mytl[34] ?></td>

            <?php
            if($mytl[2] != '' && $mytl[2] != '0000-00-00' && $mytl[2] != 'NULL')
            {
              $d=substr($mytl[2],8,2);
              $m=substr($mytl[2],5,2);
              $y=substr($mytl[2],0,4);
              $x=mktime(0,0,0,$m,$d,$y);
              $date1=date("M j, Y",$x);
              // echo "$date";
            }
            else
            {
              $date1 = '';
            }
            ?>

            <td WIDTH=9%><span class="heading"><?php if ($mytl[2] != '0000-00-00') echo $date1 ?></td>

            <td WIDTH=9%><span class="heading"><?php if ($mytl[4] != '0000-00-00') echo $mytl[4] ?></td>


          <?php
          if ($mytl[10] != 'Cust') 
          {
          ?>
          <td WIDTH=9%><span class="heading"><?php echo $mytl[12] ?></td>
          <?php
          }
          else 
          {
          ?>
          <td WIDTH=9%><span class="heading"><?php echo $mytl[14] ?></td>
          <?php
          }
          if ($mytl[10] != 'Cust') 
          {
          ?>
          <td WIDTH=11%><span class="heading">
            <?php 
            if($mytl[29] == '' & $mytl[16] == '' & $mytl[32] == 'SU') 
            {
            ?>
            <a href="processApproval.php?worecnum=<?php echo $worecnum ?>&wfrecnum=<?php echo $mytl[9] ?>&drecnum=<?php echo $mytl[8] ?>&typerecnum=<?php echo $typenum ?>&nextstatus=<?php echo $mytl[30] ?>&stagenum=<?php echo $mytl[31] ?>">
            <img src="images/bu_approval.gif" border=0> </a>
            <?php 
            }
            else if($mytl[29] == '' & $mytl[16] == '' & $mytl[32] == 'RU') 
            {
              if($mytl[28] == 'Sales' & $mytl[33] == 'Sales')
              {
              ?>
              <a href="processApproval.php?worecnum=<?php echo $worecnum ?>&wfrecnum=<?php echo $mytl[9] ?>&drecnum=<?php echo $mytl[8] ?>&typerecnum=<?php echo $typenum ?>&nextstatus=<?php echo $mytl[30] ?>&stagenum=<?php echo $mytl[31] ?>">
              <img src="images/bu_approval.gif" border=0></a>
              <?php
              }
              if($mytl[28] == 'Stores' & $mytl[33] == 'Stores' ) 
              {
              ?>
              <a href="processApproval.php?worecnum=<?php echo $worecnum ?>&wfrecnum=<?php echo $mytl[9] ?>&drecnum=<?php echo $mytl[8] ?>&typerecnum=<?php echo $typenum ?>&nextstatus=<?php echo $mytl[30] ?>&stagenum=<?php echo $mytl[31] ?>">
              <img src="images/bu_approval.gif" border=0> </a>
              <?php
              }
              if($mytl[28] == 'PPC' & $mytl[33] == 'PPC') 
              {
              ?>
              <a href="processApproval.php?worecnum=<?php echo $worecnum ?>&wfrecnum=<?php echo $mytl[9] ?>&drecnum=<?php echo $mytl[8] ?>&typerecnum=<?php echo $typenum ?>&nextstatus=<?php echo $mytl[30] ?>&stagenum=<?php echo $mytl[31] ?>">
              <img src="images/bu_approval.gif" border=0></a>
              <?php
              }
              if($mytl[28] == 'CAD/CAM' & $mytl[33] == 'CAD/CAM') 
              {
              ?>
              <a href="processApproval.php?worecnum=<?php echo $worecnum ?>&wfrecnum=<?php echo $mytl[9] ?>&drecnum=<?php echo $mytl[8] ?>&typerecnum=<?php echo $typenum ?>&nextstatus=<?php echo $mytl[30] ?>&stagenum=<?php echo $mytl[31] ?>">
              <img src="images/bu_approval.gif" border=0> </a>
              <?php
              }
              if($mytl[28] == 'Production' & $mytl[33] == 'Production') 
              {
              ?>
              <a href="processApproval.php?worecnum=<?php echo $worecnum ?>&wfrecnum=<?php echo $mytl[9] ?>&drecnum=<?php echo $mytl[8] ?>&typerecnum=<?php echo $typenum ?>&nextstatus=<?php echo $mytl[30] ?>&stagenum=<?php echo $mytl[31] ?>">
              <img src="images/bu_approval.gif" border=0> </a>
              <?php
              }
              if($mytl[28] == 'QA' & $mytl[33] == 'QA') 
              {
              ?>
              <a href="processApproval.php?worecnum=<?php echo $worecnum ?>&wfrecnum=<?php echo $mytl[9] ?>&drecnum=<?php echo $mytl[8] ?>&typerecnum=<?php echo $typenum ?>&nextstatus=<?php echo $mytl[30] ?>&stagenum=<?php echo $mytl[31] ?>">
              <img src="images/bu_approval.gif" border=0>  </a>
              <?php
              }
              else if($mytl[28] != $mytl[33])
              {
              ?>
              <?php echo $mytl[28], $mytl[33] ?>
              <img src="images/bu_approval.gif" border=0>
              <?php
              }
            }
            ?>
            <?php echo $mytl[16] ?>
          </td>


          <input type="hidden" name="<?php echo $dates ?>" style="background-color:#DDDDDD;" readonly="readonly" size=10 value="<?php if ($mytl[2] != '0000-00-00') echo $mytl[2] ?>">

          <input type="hidden" name="<?php echo $dater ?>" style="background-color:#DDDDDD;" readonly="readonly" size=12 value="<?php if ($mytl[3] != '0000-00-00') echo $mytl[3] ?>">
          
          <input type="hidden" name="<?php echo $datec ?>"  id="<?php echo $datec ?>" style="background-color:#DDDDDD;" readonly="readonly" size=12 value="<?php if ($mytl[4] != '0000-00-00') echo $mytl[4] ?>">


          
          <?php
          }
          else 
          {
            if ($mytl[18] != '')
            {
            ?>
              <td WIDTH=9%><span class="heading"><?php echo $mytl[18] ?></td>
            <?php
            }
            else
            {
            ?>
            <td WIDTH=9%><span class="heading"><?php echo $mytl[16] ?></td>
            <?php
            }
          }
          ?>
          <td width=4%><textarea name="secs_respose" rows=2 cols=10 readonly="readonly" style="background-color: #DDDDDD"> <?php echo $mytl[35] ?></textarea>
          </td>

          <td width=4%>
            <textarea name="process" rows=2 cols=10 readonly="readonly" style="background-color: #DDDDDD"> <?php echo $mytl[36] ?></textarea>
        
          </td>

          <td width=4%>
               <textarea name="when_process"  rows=2 cols=10 readonly="readonly" style="background-color: #DDDDDD"> <?php echo $mytl[37] ?></textarea>
       </tr>


        <?php
          $j++;
          $department= $mytl[28];
      }
    }
 ?>
 
   <input type="hidden" id="approval_index" name="approval_index" value="<?php echo $j; ?>">
   <input type="hidden" name="pagename_ol" id="pagename_ol" size=15 value="boardwoEdit">
   <input type="hidden" name="pagename" id="pagename" size=15 value="woEdit">
</table>

</td>

</table>

<input type="hidden" name="parent" value="WorkOrder">
<span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onClick="javascript: return check_req_fields()">
                    <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onClick="javascript: putfocus()">

					</FORM>
		</body>
</html>
