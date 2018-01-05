<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2006                =
// Filename: leadsDetails.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Leads Details                               =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$dept = $_SESSION['department'];
$_SESSION['pagename'] = 'leadsDetails';
$page = "CRM: Leads";
//session_register('pagename');

// First include the class definition
include('classes/userClass.php');
include('classes/companyClass.php');
include('classes/quoteClass.php');
include('classes/quoteliClass.php');
include('classes/displayClass.php');
include('classes/pageClass.php');
include('classes/leadsClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();

$newpage = new page;
$newLead = new leads;
$newdisplay = new display;
$newCustomer = new company;

if (isset($_REQUEST['leadsrecnum']))
{
	$leadsrecnum=$_REQUEST['leadsrecnum'];
}

$userid = $_SESSION['user'];
$result = $newLead->getLead($leadsrecnum);
$myrow = mysql_fetch_assoc($result);
if($myrow['contacted_date']!='0000-00-00'||$myrow['contacted_date']!='')
{
  $d=substr($myrow['contacted_date'],8,2);
    $m=substr($myrow['contacted_date'],5,2);
    $y=substr($myrow['contacted_date'],0,4);
    $x=mktime(0,0,0,$m,$d,$y);
    $contacted_date=date("M j, Y",$x);

}
else
{
  $contacted_date='';
}
if($myrow['meeting_date']!='0000-00-00'||$myrow['meeting_date']!='')
{
  $d=substr($myrow['meeting_date'],8,2);
    $m=substr($myrow['meeting_date'],5,2);
    $y=substr($myrow['meeting_date'],0,4);
    $x=mktime(0,0,0,$m,$d,$y);
    $meeting_date=date("M j, Y",$x);

}
else
{
  $meeting_date='';
}

//$myrow = mysql_fetch_row($result);
?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/quote.js"></script>
<script language="javascript" src="scripts/leads.js"></script>

<html>
<head>
<title>Lead Details</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr><td>
</td></tr>
<tr>
<td>
<?php
         // $newdisplay->dispLinks('');
         $newLead->UpdNotes($leadsrecnum,'leadsDetails');
 ?>
</td></tr>
</table>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellspacing="1" cellpadding="6">
<tr>

<td><span class="pageheading"><b>Lead Details for <?php echo $myrow["name"]?></b><td colspan=50>&nbsp;</td>
 <td bgcolor="#FFFFFF" rowspan=2 align="right">
 <?php if($myrow['stage_num']<90)
 { ?>
  <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;" onClick="location.href='edit_leads.php?leadsrecnum=<?php echo $leadsrecnum ?>'" value="Edit Lead" >
  <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;" onClick="location.href='addNotes4leads.php?leadsrecnum=<?php echo $leadsrecnum ?>'" value="Add Notes" >
<?} ?>
        <!-- <a href ="edit_leads.php?leadsrecnum=<?php echo $leadsrecnum ?>" ><img name="Image8" border="0" src="images/el.gif" ></a>
        <a href ="addNotes4leads.php?leadsrecnum=<?php echo $leadsrecnum ?>" ><img name="Image88" border="0" src="images/bu_addnotes.gif" ></a> -->
    <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:2px;" onClick="javascript: printleadsDetails(<?php echo $leadsrecnum ?>)" value="Print" >    
        <!-- <input type= "image" src="images/bu-print.gif" onclick="javascript: printleadsDetails(<?php echo $leadsrecnum ?>)"> -->
 </td>

  </tr>
 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 class="stdtable1">
<tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><center><b>Lead Details</b></center></td></tr>

    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Lead Name</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["name"]?></td>
             <td><span class="labeltext"><p align="left">Company Name </p></font></td>
            <td ><span class="tabletext" style="font-size: 12px"><b><?php echo $myrow["company"]?></b></td>

        </tr>
        <!--<tr bgcolor="#FFFFFF">
             <td><span class="labeltext"><p align="left">Leads#</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["leadsnum"]?></td>    
           <td><span class="labeltext"><p align="left">Opportunity# </p></font></td>
            <td colspan=3><span class="tabletext"><?php echo $myrow["oppnum"]?></td>-->

        </tr>
    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Lead Source</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["source"]?></td>
             <td><span class="labeltext"><p align="left">Title </p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["title"]?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Email</p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["email"]?></td>
             <td><span class="labeltext"><p align="left">Phone </p></font></td>
            <td ><span class="tabletext"><?php echo $myrow["phone"]?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Industry Segment</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["industry_segment"]?></td>
            <td><span class="labeltext"><p align="left">Product Interest</p></font></td>
            <td><span class="tabletext" style="font-size: 12px"><b><?php echo $myrow["product_interest"]?></b></td>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Primary</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["primary_lead"]?></td>
            <td><span class="labeltext"><p align="left">Converted to Contact</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["convert2contact"]?></td></tr>

              <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Stage</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["stage"]?></td>
            <td><span class="labeltext"><p align="left">Percentage</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["percent"]?></td></tr>
            <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Contacted Date</p></font></td>
            <td ><span class="tabletext"><?php echo $contacted_date?></td>
             <td><span class="labeltext"><p align="left">Meeting Date </p></font></td>
            <td ><span class="tabletext"><?php echo $meeting_date?></td>
        </tr>


            <tr bgcolor="#FFFFFF">
        <input type="hidden" name="primary_lead">
    <tr bgcolor="#EEEEEE"><td colspan=4><span class="heading"><center><b>Address</b></center></td></tr>
     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Address1</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["addr1"]?></td>
            <td><span class="labeltext"><p align="left">Address2</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["addr2"]?></td>
     </tr>
     <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">City</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["city"]?></td>
            <td><span class="labeltext"><p align="left">State</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["state"]?></td>
    </tr>
    <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Zip</p></font></td>
            <td><span class="tabletext"><?php echo $myrow["zip"]?></td>
            <td><span class="labeltext"><p align="left">Country</p></font></td>
            <td><span class="tabletext" style="font-size: 12px"><b><?php echo $myrow["country"]?></b></td>
    </tr>
      <?php
            printf('<tr  bgcolor="#DDDEDD"><td colspan=8><span class="heading"><center><b>Interaction Notes</b></center></td></tr>');
            $result = $newLead->getNotes($leadsrecnum);
            printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes" rows="10" cols="89">');
            while ($mynotes = mysql_fetch_row($result)) {
                  printf("\n");
                  printf("********Added by $mynotes[2] on $mynotes[0]*******");
                  printf("\n");
                  printf($mynotes[1]);
                  printf("   \n");
            }

?>
   </textarea></td>
        </tr>
</table>
    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>

        <tr>
       </tr>
        </table>
</td>

		</table>

      </FORM>

</table>

</body>
</html>