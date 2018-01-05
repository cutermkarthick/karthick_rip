<?php

//==============================================
// Author: FSI                                 =
// Date-written = April 06, 2010               =
// Filename: task.php                          =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =            
//==============================================

@session_start();
header("Cache-control: private");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'task_edit';
$page="CRM: Project";
//session_register('pagename');

// First include the class definition
include_once('classes/loginClass.php');
include('classes/taskClass.php');

//$newLogin= userlogin::singleton();

$newtask = new task;

$recnum=$_REQUEST['recnum'];
$cond='where t.recnum='.$recnum;
$result = $newtask->gettask_details($cond);
$myrow=mysql_fetch_row($result);

?>

<script language="javascript" src="scripts/task.js"></script>
<link rel="stylesheet" href="style.css">

<html>
  <head>
    <title>Edit Task</title>
  </head>

  <body leftmargin="0"topmargin="0" marginwidth="0" onload="javascript:createTab('project')">
    <form action='task_Process.php' method='GET' enctype='multipart/form-data'>
      <?php
       include('header.html');
      ?>
      <table width=100%  border=0 cellpadding=0 cellspacing=0 bgcolor="#DFDEDF">
        <tr bgcolor='#FFFFFF'>
          <td ><span class="pageheading"><b>Edit Task</b></td>  
        </tr>
        <tr></tr>
        <tr></tr>
      </table>


      <table width=100% align='center' border=1 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
        <tr bgcolor='#FFFFFF'>
          <td ><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Task Id</p></font></td>
          <td><span class="tabletext"><?php echo $myrow[1] ?></td>
          <input type="hidden" name="task_id" id="task_id"  size=15 value="<?echo $myrow[1]?>">

          <td><span class="labeltext"><p align="left"><span class='asterisk'>*</span>Task Name</p></font></td>
          <td><input type="text" name="task_name" id="task_name"  size=15 value="<?echo $myrow[2]?>"></td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">Category</p></font></td>
          <td><span class="tabletext"><?echo $myrow[3]?></td>
          <td><span class="labeltext"><p align="left">Description</p></font></td>
          <td><span class="tabletext"><?echo $myrow[4]?></td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">Est Time(Hours)</p></font></td>
          <td ><span class="tabletext"><?php echo $myrow[11];?>
          <input type="hidden" id="estimate_hours" name="estimate_hours" value="<?php  echo $myrow[11] ;?>">
          <td><span class="labeltext"><p align="left">Est Time(Mins)</p></font></td>
          <td><span class="tabletext"><?php echo $myrow[12];?>
          <input type="hidden" id="estimate_mins" name="estimate_mins" value="<?php  echo $myrow[12] ;?>">
          </td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">Status</p></font></td>
          <td ><span class="tabletext"><?php echo $myrow[5];?>
          <input type="hidden" id="status" name="status" value="<?php  echo $myrow[5] ;?>">
          <td><span class="labeltext"><p align="left">Priority</p></font></td>
          <td><span class="tabletext"><?php echo $myrow[6];?>
          <input type="hidden" id="priority" name="priority" value="<?php  echo $myrow[6] ;?>">
          </td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td><span class="labeltext"><p align="left">user</p></font></td>
          <td ><span class="tabletext"><?php echo $myrow[9];?>
          <input type="hidden" id="userrecnum" name="userrecnum" value="<?php  echo $myrow[10] ;?>">
          <td></td>
          <td></td>
        </tr>

        <?php 
        $usertype=$_SESSION['usertype'];
        $usertype1=strtolower($usertype);

        if($usertype !='cust')
        {
        ?>
        <tr bgcolor="#FFFFFF">
        <td ><span class="labeltext"><p align="left">Notes</p></font></td>
        <?
          printf('<td colspan=1><textarea name="notes" rows="6" cols="50" style="background-color:#DDDDDD;"
                    readonly="readonly">');
            $result1 = $newtask->getNote($recnum,$_REQUEST['link2project']);
            while ($mynotes1 = mysql_fetch_row($result1)) {
                  printf("\n");
                  printf("********Added by $mynotes1[2] on $mynotes1[0]*******");
                  printf("\n");
                  printf($mynotes1[1]);
                  printf("   \n");
            }
          }

          ?>
            </textarea>
          </td>

          <td ><span class="labeltext"><p align="left">Customer Notes</p></font></td>
          <?php
          printf('<td align="right" colspan=1><span class="labeltext"><a href=addCustNotes.php?recnum='.$recnum.'&link2project='.$_REQUEST["link2project"].'>Add Notes</span>
            <textarea name="customer_notes" rows="6" cols="50" style="background-color:#DDDDDD;"
                    readonly="readonly">');
            $result2 = $newtask->getCustNote($recnum,$_REQUEST['link2project']);
            while ($mynotes2 = mysql_fetch_row($result2)) {
                  printf("\n");
                  printf("********Added by $mynotes2[2] on $mynotes2[0]*******");
                  printf("\n");
                  printf($mynotes2[1]);
                  printf("   \n");
            }

            ?>
            </textarea>
          </td>
        </tr>

        <input type='hidden' name='recnum_task' value=<?echo $recnum?>>
        <input type='hidden' name='recnum_project' value=<?echo $_REQUEST['link2project']?>>

			</table>

       <table width=100% border=0 cellpadding=3 cellspacing=1 class="stdtable" >
        <thead>
            <tr>
                <th  class="head0"><b>Seq #</b></th>
                <th  class="head1"><b>Empid</b></th>
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
                $result1 = $newtask->gettaks_checkInOut($myrow[1]);
                $numrows = mysql_num_rows($result1);
                echo "numrows $numrows <br>";
                while ($myptli = mysql_fetch_row($result1)) 
                {
                    if ($myptli[4] == 1) {
                        $checkInOut = 'In';
                    }else if ($myptli[4] == 0) {
                        $checkInOut = 'Out';
                    }else if ($myptli[4] == 2) {
                        $checkInOut = 'Break';
                    }

                
                if ($i == $numrows) {
                   $elapsed = "";
                }
                else
                {
                  if ($prev_time != "") {
                  $datetime1 = new DateTime($prev_time);
                  $datetime2 = new DateTime($myptli[2]);
                  $interval = $datetime1->diff($datetime2);
                  $elapsed = $interval->format('%h:%i:%s');
                }
                else{
                  $elapsed = "0:0:0";
                }
                }
                

                if (empty($val_arr)) {
                    $val_arr = array('seqnum' => $i,
                                'empid' => $myptli[1],
                                'date' => $myptli[2],
                                'stage' => $checkInOut,
                                'elapsed' => $elapsed,
                                'lat' => $myptli[5],
                                'lan' => $myptli[6],
                                'address' => "fluent tech");

                }
                else
                { ?>
                  <tr>
                    <td align="center"><span class="tabletext"><?php echo $val_arr['seqnum'];  ?></span></td>
                    <td align="center"><span class="tabletext"><?php echo $val_arr['empid'];  ?></span></td>
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
                                'address' => "fluent tech");

                }

                  $i++;
                  $prev_time = $myptli[2];
                }

            ?>
        </tbody>

        </table>

        <table width=100% align='center' border=1 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1" >
          <tr bgcolor='#FFFFFF'>
            <td align='center' colspan=4><span class="tabletext">
              <input type="submit" style="color=#0066CC;background-color:#DDDDDD;width=130;" value="Update Task" name="submit" onclick="javascript: return check_req_fields()">
              <input type="RESET" style="color=#0066CC;background-color:#DDDDDD;width=130;" value="Reset" onclick="javascript: putfocus()">
            </td>
          </tr>
        </table>

    </form>
  </body>
</html>