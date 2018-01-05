<?php 
	
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'payrollsummary';
$page="ELM: Monthly";
	

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

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

include_once('classes/payrollmonthlyClass.php');
$newpayroll = new payroll_monthly;
$recnum = $_REQUEST['recnum'];

$empid = $_REQUEST['empid'];
$month = $_REQUEST['month'];
$year = $_REQUEST['year'];



$result = $newpayroll->getpayroll_monthly_details($empid);
// $result = $newpayroll->getpayroll_master_details($empid, $month, $year);
$myrow = mysql_fetch_assoc($result);
?>

<html>
<head>
<title>Pay Roll Monthly</title>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/payroll.js"></script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0">
<form action='process_payroll.php' method='post' enctype='multipart/form-data'>
<?php

 include('header.html');

?>

<table width=100% border=0 cellpadding=6 cellspacing=0  >
    <tr>
        <td><span class="pageheading"><b>Payroll Monthly</b></span></td>
    </tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
  	<tr bgcolor="#DDDEDD">
    	<td colspan=4><span class="heading"><center><b>Payroll Monthly</b></center></span></td>
        <!-- <input type="button" class="stdbtn btn_blue" style="float:right;padding:2px;margin-right:5px;" onClick="location.href='edit_payrollmaster.php?recnum=<?php echo $myrow['recnum']?>'" value="Edit Payroll Master" >   -->
    </tr>


    <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">ID</p></span></td>
        <td><span class="tabletext"><?php echo $myrow['id']?></span></td>
         <td><span class="labeltext"><p align="left">Hrs Worked</p></span></td>
        <td><span class="tabletext"><?php echo $myrow['hrs_worked']?></span></td>
    </tr>

    <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">OT</p></span></td>
        <td><span class="tabletext"><?php echo $myrow['ot']?></span></td>
         <td><span class="labeltext"><p align="left">Gross Salary</p></span></td>
        <td><span class="tabletext"><?php echo $myrow['gross_salary']?></span></td>
    </tr>

    <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">TDS</p></span></td>
        <td><span class="tabletext"><?php echo $myrow['tds']?></span></td>
         <td><span class="labeltext"><p align="left">Net  Salary</p></span></td>
        <td><span class="tabletext"><?php echo $myrow['net_salary']?></span></td>
    </tr>

    <tr bgcolor="#FFFFFF">
        <td><span class="labeltext"><p align="left">Process Date</p></span></td>
        <td><span class="tabletext"><?php echo $myrow['date']?></span></td>
        <td colspan = 2></td>
         
    </tr>

</table>
    

<?php 
    
    
    $result_payroll_trans = $newpayroll->getpayroll_trans_monthly_details($empid,$month,$year);
    $numrows = mysql_num_rows($result_payroll_trans);
    if ($numrows > 0) 
    {
        // &month='$month'&year='$year'
        echo "<br>
            <a href=\"processpayroll_monthly.php?empid=$empid&month=$month&year=$year\" style=\"float:right;padding:2px;margin-right:5px;\" class=\"stdbtn btn_blue\">Compute</a>
            

        ";
    }

?>
    

    <table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable" >
        <thead>
            <tr>
                <th  class="head0"><b>Seq #</b></th>
                <th  class="head1"><b>Empid</b></th>
                <th  class="head1"><b>TaskId</b></th>
                <th  class="head0"><b>Lat</b></th>
                <th  class="head1"><b>Lang</b></th>
                <th  class="head0"><b>Address</b></th>
                <th  class="head1"><b>Date</b></th>
                <th  class="head0"><b>Stage</b></th>
                <th  class="head1"><b>Duration</b></th>
            </tr>
        </thead>

        <tbody>
            <?php
                $i = 1;
                $prev_time = '';
                $val_arr = array();
                while ($myptli = mysql_fetch_row($result_payroll_trans)) 
                {
                    if ($myptli[4] == 1) {
                        $checkInOut = 'In';
                    }else if ($myptli[4] == 0) {
                        $checkInOut = 'Out';
                    }else if ($myptli[4] == 2) {
                        $checkInOut = 'Break';
                    }

                    if ($prev_time != "") {
                      $datetime1 = new DateTime($prev_time);
                      $datetime2 = new DateTime($myptli[2]);
                      $interval = $datetime1->diff($datetime2);
                      $elapsed = $interval->format('%h:%i:%s');
                    }
                    else{
                      $elapsed = "0:0:0";
                    }

                


                    if (empty($val_arr)) {
                        $val_arr = array('seqnum' => $i,
                                    'empid' => $myptli[1],
                                    'date' => $myptli[2],
                                    'stage' => $checkInOut,
                                    'elapsed' => $elapsed,
                                    'lat' => $myptli[5],
                                    'lan' => $myptli[6],
                                    'address' => "fluent tech",
                                    'taskid'=>$myptli[7]);

                        $location[$i] = $val_arr;

                    }
                    else
                    {

                    ?>
                        <tr>
                            <td align="center"><span class="tabletext"><?php echo $val_arr['seqnum'];  ?></span></td>
                            <td align="center"><span class="tabletext"><?php echo $val_arr['empid'];  ?></span></td>
                            <td align="center"><span class="tabletext"><?php echo $val_arr['taskid'];  ?></span></td>
                            <td align="center"><span class="tabletext"><?php echo $val_arr['lat'];  ?></span></td>
                            <td align="center"><span class="tabletext"><?php echo $val_arr['lan'];  ?></span></td>
                            <td align="center"><span class="tabletext"><?php echo $val_arr['address'];  ?></span></td>
                            <td align="center"><span class="tabletext"><?php echo $val_arr['date'];  ?></span></td>
                            <td align="center"><span class="tabletext"><?php echo $val_arr['stage'];  ?></span></td>
                            <td align="center"><span class="tabletext"><?php echo $elapsed;  ?></span></td>

                          </tr>
                    <?php
                        $val_arr = array('seqnum' => $i,
                                'empid' => $myptli[1],
                                'date' => $myptli[2],
                                'stage' => $checkInOut,
                                'elapsed' => $elapsed,
                                'lat' => $myptli[5],
                                'lan' => $myptli[6],
                                'address' => "fluent tech",
                                'taskid'=>$myptli[7]);

                        $location[$i] = $val_arr;

                    }
                    $i++;
                    $prev_time = $myptli[2];
                }

            ?>

                <tr>
                    <td align="center"><span class="tabletext"><?php echo $val_arr['seqnum'];  ?></span></td>
                    <td align="center"><span class="tabletext"><?php echo $val_arr['empid'];  ?></span></td>
                    <td align="center"><span class="tabletext"><?php echo $val_arr['taskid'];  ?></span></td>
                    <td align="center"><span class="tabletext"><?php echo $val_arr['lat'];  ?></span></td>
                    <td align="center"><span class="tabletext"><?php echo $val_arr['lan'];  ?></span></td>
                    <td align="center"><span class="tabletext"><?php echo $val_arr['address'];  ?></span></td>
                    <td align="center"><span class="tabletext"><?php echo $val_arr['date'];  ?></span></td>
                    <td align="center"><span class="tabletext"><?php echo $val_arr['stage'];  ?></span></td>
                    <td align="center"><span class="tabletext"></span></td>
                </tr>

        </tbody>

    </table>


