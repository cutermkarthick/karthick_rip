<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
@session_start();

$userid = $_SESSION['user'] ;
include('classes/taskEntryClass.php'); 
include('classes/newsEntryClass.php');
$newTask = new taskEntry;
$newNews = new NewsEntry;

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Menu page</title>
<link rel="stylesheet" href="./css/style1.css" type="text/css" />

<!--[if IE 9]>
<link rel="stylesheet" media="screen" href="css/ie9.css"/>
<![endif]-->

<!--[if IE 8]>
<link rel="stylesheet" media="screen" href="css/ie8.css"/>
<![endif]-->

<!--[if IE 7]>
<link rel="stylesheet" media="screen" href="css/ie7.css"/>
<![endif]-->
<script type="text/javascript" src="./js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="./js/plugins/jquery.flot.min.js"></script>
<script type="text/javascript" src="./js/plugins/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="./js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="./js/custom/general.js"></script>
<script type="text/javascript" src="./js/custom/dashboard.js"></script>
<script type="text/javascript" src="scripts/dashboard.js"></script>

<script type="text/javascript" src="./js/custom/tables.js"></script>
<!--[if lt IE 9]>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<meta charset="UTF-8"></head>
<style>
.stdtable tbody tr td{ padding:3px 5px !important;
}
 .calendar{ width:100% !important;
 }
</style>


<body class="loggedin">

<!-- START OF HEADER -->
<div class="header radius3">
<div class="headerinner">
<div style="float:left; margin-right:15px;">
<img style="width:142px" src="./images/fsi_logo.png" alt="" />
</div>
 <div style="float:left; margin-top:-25px;">
<img style="width:847px" src="./images/banner 2.png" alt="" />
</div>
<div class="headright">



<div id="userPanel" class="headercolumn">
<a href="" class="userinfo radius2">
<img src="./images/avatar.png" alt="" class="radius2" />
<span><strong><?php echo $userid ; ?></strong></span>
</a>
<div class="userdrop">
<ul>
<li><a href="">Profile</a></li>
<li><a href="">Account Settings</a></li>
<li><a href="./exit.php">Logout</a></li>
</ul>
</div><!--userdrop-->
</div><!--headercolumn-->
</div><!--headright-->

</div><!--headerinner-->
</div><!--header-->
<!-- END OF HEADER -->

<!-- START OF MAIN CONTENT -->
<div class="mainwrapper">
<div class="mainwrapperinner">

<div class="mainleft">
<div class="mainleftinner">

<div class="leftmenu">
<ul>
<li><a href="salesorder.php" class="widgets menudrop"><span>Sales</span></a>
<ul>
<li><a href="#"><span>Leads</span></a></li>
<li><a href="#"><span>Opportunity</span></a></li>
<li><a href="#"><span>Quote</span></a></li>
<li><a href="#"><span>Enquiry Stage</span></a></li>
<li><a href="#"><span>Cust Po</span></a></li>
<li><a href="#"><span>Competitor</span></a></li>
<li><a href="#"><span>Time Master</span></a></li>               

</ul>

</li>

<li><a href="delivery_schSummary.php" class="ppc menudrop"><span>PPC</span></a>
<ul>
<li><a href="#"><span>Prod Schedule </span></a></li>
<li><a href="#"><span>Planning </span></a></li>
</ul>           

</li>
<li><a href="po.php" class="purc menudrop"><span>Purchasing</span></a>
<ul>
<li><a href="#"><span>PO </span></a></li>
<li><a href="#"><span>SP PO </span></a></li>
<li><a href="#"><span>RM Master </span></a></li>
<li><a href="#"><span>Dispatch </span></a></li>               
<li><a href="#"><span>Part Master </span></a></li>                                
<li><a href="#"><span>SP Master </span></a></li>                                                
</ul>           

</li>
<li><a href="worderSummary.php" class="work menudrop"><span>Work Orders </span></a>
<ul><li><a href="#"><span>Reg WO</span></a></li>
<li><a href="#"><span>Assy WO</span></a></li>
</ul>           
</li>
<li><a href="dnSummary.php" class="post_process menudrop"><span> Post Process</span></a>
<ul>
<li><a href="#"><span>D Note </span></a></li>
</ul>           
</li>
<li><a href="bom.php" class="bom menudrop"><span> BOM</span></a>
<ul>
<li><a href="#"><span>BOM </span></a></li>
</ul>           
</li>
<li><a href="grn_summary.php" class="stores menudrop" ><span> Stores</span></a>
<ul>
<li><a href="#"><span>GRN </span></a></li>
<li><a href="#"><span>NC  </span></a></li>
</ul>           

</li>
<li><a href="nc4qa_summary.php" class="qa menudrop"><span>QA </span></a>
<ul>
<li><a href="#"><span>NC </span></a></li> 
<li><a href="#"><span>Final Insp</span></a></li>                                                
<li><a href="#"><span>FAIR</span></a></li>                                                                
</ul>         
</li>
<li><a href="dispatchSummary.php" class="dispatch menudrop"><span>Dispatch </span></a>
<ul>
<li><a href="#"><span>Dispatch </span></a></li>
</ul>     
</li>
<li><a href="account.php" class="account menudrop"><span>Accounts </span></a>
<ul>
<li><a href="#"><span>Contacts </span></a></li>
</ul>     
</li>
<li><a href="mtltrksummary.php" class="mtl_tracker menudrop"><span>Mtl Tracker</span></a>
<ul>
<li><a href="#"><span>Mtl Tracker</span></a></li>
</ul>     
</li>
<li><a href="masterSummary.php" class="master_data widgets"><span>Master Data</span></a></li>
<li><a href="operatorDetails.php" class="prodn menudrop"><span>Prodn </span></a>
<ul>
<li><a href="#"><span>Operator</span></a></li>
</ul>     
</li>
<li><a href="reports.php" class="reports widgets"><span> Reports </span></a></li>            
</ul>

</div><!--leftmenu-->
<div id="togglemenuleft"><a></a></div>
</div><!--mainleftinner-->
</div><!--mainleft-->

<div class="maincontent">
<div class="maincontentinner">

<!-- <ul class="maintabmenu">
<li class="current"><a href="">Dashboard</a></li>
</ul> -->

<div class="content">
 
<ul class="widgetlist">
<li><a href="salesorder.php" class="events">SALES</a></li>
<li><a href="production_sch.php" class="message">PPC </a></li>
<li><a href="po.php" class="upload">PURCHASING</a></li>
<li ><a href="worderSummary.php " class="work">WORKORDERS</a></li>
<li><a href="dnSummary.php " class="post">POSTPROCESS</a></li>
<li><a href="bom.php"  class="accont">BOM</a></li>
<li><a href="grn_summary.php" class="report">STORES</a></li>
<li><a href="nc4qa_summary.php" class="green">QA</a></li>           
<li><a href="dispatchSummary.php" class="disp">DISPATCH</a></li>
<li ><a href="account.php" class="blue">ACCOUNTS</a></li>  
<li><a href="Mtltrksummary.php" class="red">MTLTRACKER</a></li>              
<li><a href="masterSummary.php" class="maroon">MASTERDATA</a></li>
<li><a href="operatorDetails.php" class="prodn">PRODN</a></li>                         
<li><a href="reports.php" class="reports">REPORTS</a></li>              
</ul>




</ul>

<br clear="all" /><br />




<br clear="all" /><br />




</div><!--content-->

</div><!--maincontentinner-->

<!-- <div class="footer">
<p> &copy; 2013. All Rights Reserved.  : <a href="">isigntech.com</a></p>
</div> --><!--footer-->

</div><!--maincontent-->

<div class="mainright">
<div class="mainrightinner">

<div class="widgetbox">
<div class="title"><h2 class="calendar"><span>Tasks
 <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" value="New" onclick="javascript:addTask('task')"></span></h2></div>
<div class="widgetcontent padding0">
	
<table style="width:100%;" class="stdtable">
<tr>
<thead>
<th width="35%" ><span style="font-family:serif"><b>Task</span></b></td>
<th width="35%"><span style="font-family:serif"><b>Cre Date</span></b></td>
<th width="35%"><span style="font-family:serif"><b>Comp Date</span></b></td>
</tr>
</thead>
</table>
<div style="width:100%;height:97px;overflow-y:scroll;">
<table id="stdtable2" style="width:100%;" class=" stdtable">
  <?php 
  $results = $newTask->getTasks();
  while($row = mysql_fetch_array($results))
  {
if($row[3] != '0000-00-00' && $row[3] != '' && $row[3] != 'NULL')
{
$datearr = split('-', $row[3]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date=date("M j, Y",$x);
}
else
{
$date = '';
}
if($row[4] != '0000-00-00' && $row[4] != '' && $row[4] != 'NULL')
{
$datearr = split('-', $row[4]);
$d=$datearr[2];
$m=$datearr[1];
$y=$datearr[0];
$x=mktime(0,0,0,$m,$d,$y);
$date1=date("M j, Y",$x);
}
else
{
$date1= '';
}
if($row[4] == '0000-00-00')
{

  printf('<tr><td width="35%%" bgcolor="#FFFFFF" align="center"><span class="tabletext" style="font-family:serif;"><a href="javascript: editTask(taskrecnum=%s)">%s</a></td><td width="38%%" bgcolor="#FFFFFF" align="center"><span class="tabletext" style="font-family:serif;">%s</td>
<td width="35%%" bgcolor="#FFFFFF" align="center"><span class="tabletext" style="font-family:serif;">%s</td>
</tr>',$row[0],$row[1],$date,$date1);

    

}
else
{
printf('<tr><td width="35%%" bgcolor="#FFFFFF" align="center"><span class="tabletext" style="font-family:serif;">%s</td>
<td width="38%%" bgcolor="#FFFFFF" align="center"><span class="tabletext" style="font-family:serif;">%s</td>
<td width="35%%" bgcolor="#FFFFFF" align="center" style="font-family:serif;"><span class="tabletext">%s</td>
</tr>',$row[1],$date,$date1);
}

      }
       

	?>
 </table>	
 </div>
<!-- <p style="margin:10px">Create BOM <br />
Update PRN<br /> -->
<!-- <br />
<br /> -->

 
</div>
<!--widgetcontent-->
</div><!--widgetbox-->

<!--widgetbox-->

<div class="widgetbox">
<div class="title"><h2 class="calendar"><span>News
 <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" value="New" onclick="javascript:addNews('news')"></span></h2></div>
<div class="widgetcontent padding0" >
<table width=100% border=1>
<tr>
<!-- <th align="left"><span style="font-family:Georgia, serif"><b>News:</span></b></th> -->

</tr>
</table>
<div style="width:100%;height:130px; margin-bottom:10px; overflow-y:scroll;">
<table style="width:99%;" class="stdtable">
  <?php 
  $results = $newNews->getNews();
  while($row = mysql_fetch_array($results)){


    if($row[2] != '' && $row[2] != '0000-00-00')
{
$date = split('-', $row[2]);
$d=$date[2];
$m=$date[1];
$y=$date[0];
$x=mktime(0,0,0,$m,$d,$y);
$date=date("M j, Y",$x);
}
else
{
$date = '';
}

// $descr = wordwrap($row[3],20,"\n",true);
echo "<tr><td><span style=\"display:block;
    width:272px;
    word-wrap:break-word;font-family:serif;\"><b>$date</b></span></td></tr>";
    echo "<tr><td><span style=\"display:block;width:275px;
    word-wrap:break-word;text-indent:10px;font-family:serif;\">$row[3]</span></td></tr>";
// echo "<tr><td align=\"right\"><span style=\"font-family:Georgia, serif;\"><b>$date</b></span></td>";
      }
       

	?>
   </div>
	</table>	
 </div><!--widgetcontent-->
</div><!--widgetbox-->
<div style="margin-top:15px;" class="widgetbox">
<div class="title">

<div class="widgetcontent padding0">
<?php
include("calender.php");
?> 
<!-- <?php 
$pageval = $_SESSION['pageval'];
// echo $pageval;
?>
<input type="text" name="title1" id="title1" value=""> -->
<!-- <p style="margin:10px">Cim to be created in new template</p> -->
</div><!--widgetcontent-->
</div>

</div><!--mainrightinner-->
</div>
<!--mainright-->

</div><!--mainwrapperinner-->
</div><!--mainwrapper-->
<!-- END OF MAIN CONTENT -->


</body>
</html>
