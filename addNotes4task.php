<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Jan 24, 2007                 =
// Filename: addNotes4task.php                 =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Allows the addition of Notes for task.      =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];

$userrecnum = $_SESSION['userrecnum'];
$_SESSION['pagename'] = 'addnotes4task';
//////session_register('pagename');

// First include the class definition

include('classes/tasklistClass.php');
include('classes/displayClass.php');

if (isset($_REQUEST['tasklistrecnum']))
{
	$tasklistrecnum=$_REQUEST['tasklistrecnum'];
	$_SESSION['tasklistrecnum'] = $tasklistrecnum;
	//////session_register('tasklistrecnum');
}


if ( !isset ( $_REQUEST['task'] ) )
{
     $task='';
}
else
   $task=$_REQUEST['task'];

if ( !isset ( $_REQUEST['date'] ) )
{
      $date=date("dd-mm-yyyy");
}
else

    $date=$_REQUEST['date'];
if ( !isset ( $_REQUEST['id'] ) )
{
      $id='';
}
else

    $id=$_REQUEST['id'];

$newdisp = new display;
$newtask= new tasklist;

$result = $newtask->getasklist($tasklistrecnum);
$myrow = mysql_fetch_row($result);

 ?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/tasklist.js"></script>

<html>
<head>
<title>Task Details</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0" onLoad="javascript:setColor('<?php echo $id ?>');">
<FORM ACTION = "processNotes4task.php" METHOD = "POST">
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
<?php  $newdisp->dispLinks('');   ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
	    <td bgcolor="#FFFFFF">
      <table width=100% border=0 cellpadding=6 cellspacing=0  >
  <tr><td><span class="heading"><i></i></td></tr>
<tr>
<td>

    <table width=100% border=0 cellspacing="1" cellpadding="6">
    <tr>
        <td align="left"><span class="pageheading"><b>Task Details for <?php echo $myrow[10]?></b></td>
        <td colspan=50>&nbsp;</td>
        <td bgcolor="#FFFFFF" rowspan=2 align="right"><a href ="edit_tasklist.php?tasklistrecnum=<?php echo $tasklistrecnum ?>" ><img name="Image8" border="0" src="images/edittask.gif" ></a></td>
    </tr>

    <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
     <tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b><i>General Information</i></b></td></tr>
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="center">Task#</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[0]?></td>
            <td><span class="labeltext"><p align="center">User Id</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[1]?></td>
       </tr>
       <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="center">Task Due</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[10]?></td>
            <td><span class="labeltext"><p align="center">Created on</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[11]?></td>
       </tr>
    <tr bgcolor="#DDDEDD"><td colspan=4><span class="heading"><b><i>Primary Information<b></b></td></tr>
    <tr bgcolor="#FFFFFF">
            <td bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="center">10.00</p></font></td>
            <td id="a1"><span class="tabletext"><a href ="addNotes4task.php?tasklistrecnum=<?php echo $tasklistrecnum ?>&task=<?php echo $myrow[2]?>&date=<?php echo $myrow[10]?>&id=a1" TITLE="Add Notes"><?php echo $myrow[2]?></td>
            <td bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="center">11.00</p></font></td>
            <td id="a2"><span class="tabletext"><a href ="addNotes4task.php?tasklistrecnum=<?php echo $tasklistrecnum ?>&task=<?php echo $myrow[3]?>&date=<?php echo $myrow[10]?>&id=a2" TITLE="Add Notes"><?php echo $myrow[3]?></td>
        </tr>
    <tr bgcolor="#FFFFFF">
            <td bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="center">12.00</p></font></td>
            <td id="a3"><span class="tabletext"><a href ="addNotes4task.php?tasklistrecnum=<?php echo $tasklistrecnum ?>&task=<?php echo $myrow[4]?>&date=<?php echo $myrow[10]?>&id=a3" TITLE="Add Notes"><?php echo $myrow[4]?></td>
            <td bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="center">13.00</p></font></td>
            <td id="a4"><span class="tabletext"><a href ="addNotes4task.php?tasklistrecnum=<?php echo $tasklistrecnum ?>&task=<?php echo $myrow[5]?>&date=<?php echo $myrow[10]?>&id=a4" TITLE="Add Notes"><?php echo $myrow[5]?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="center">14.00</p></font></td>
            <td id="a5"><span class="tabletext"><a href ="addNotes4task.php?tasklistrecnum=<?php echo $tasklistrecnum ?>&task=<?php echo $myrow[6]?>&date=<?php echo $myrow[10]?>&id=a5" TITLE="Add Notes"><?php echo $myrow[6]?></td>
            <td bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="center">15.00</p></font></td>
            <td id="a6"><span class="tabletext"><a href ="addNotes4task.php?tasklistrecnum=<?php echo $tasklistrecnum ?>&task=<?php echo $myrow[7]?>&date=<?php echo $myrow[10]?>&id=a6" TITLE="Add Notes"><?php echo $myrow[7]?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
            <td bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="center">16.00</p></font></td>
            <td id="a7"><span class="tabletext"><a href ="addNotes4task.php?tasklistrecnum=<?php echo $tasklistrecnum ?>&task=<?php echo $myrow[8]?>&date=<?php echo $myrow[10]?>&id=a7" TITLE="Add Notes"><?php echo $myrow[8]?></td>
            <td bgcolor="#EEEFEE" width=10%><span class="labeltext"><p align="center">17.00</p></font></td>
            <td id="a8"><span class="tabletext"><a href ="addNotes4task.php?tasklistrecnum=<?php echo $tasklistrecnum ?>&task=<?php echo $myrow[9]?>&date=<?php echo $myrow[10]?>&id=a8" TITLE="Add Notes"><?php echo $myrow[9]?></td>

    </table>

            <tr>
                  <td>

                  <?php
                  if($task=''||$date==''||$id=='')
                    {

                    }

                      else
                      {

                            $task=$_REQUEST['task'];
                            $date=$_REQUEST['date'];
                            $id=$_REQUEST['id'];

                     ?>


                                    <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#EEEFEE" >
							            <tr bgcolor="#DDDEDD"><td><span class="heading"><b><i>Task Notes for <?php echo $task?> <b></b></td></tr>

                                        <?php
                                              $result = $newtask->getNotes($tasklistrecnum,$task);
                                                   printf('<tr bgcolor="#FFFFFF"><td colspan=8><textarea name="notes" rows="6" cols="88" readonly="readonly">');
                                                   while ($mynotes = mysql_fetch_row($result)) {
                                                         printf("\n");
                                                         printf("********Added by $mynotes[2] on $mynotes[0] *********** ");
                                                         printf("\n");
                                                         printf($mynotes[1]);
                                                         printf("   \n");
                                                         }
                                         ?>
                                                         </textarea></td>
                                                         </tr>

            								</table>



                                    	</td></tr>

										<tr>
											<td>
  												<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
												       <tr bgcolor="#DDDEDD"><span class="heading"><td colspan=4><b><i>Add Notes</i></b></center></td></tr>
                                                       <tr bgcolor="#FFFFFF"  >
					     								   <td colspan=4><textarea name="spec_instrns" rows="3" cols="88%" value=""></textarea>
             	                                           <input type="hidden" name="tasklistrecnum" value="<?php echo $tasklistrecnum ?>" >
                                                           <input type="hidden" name="task" value="<?php echo $task ?>" >
                                                           <input type="hidden" name="date" value="<?php echo $date ?>" >
                                                           <input type="hidden" name="id" value="<?php echo $id ?>" >
													    </td> </tr>
            									</table>

                        <?php
                        }
                       ?>

         </table>

		                 <td width="6"><img src="images/spacer.gif " width="6"></td>
                           <tr bgcolor="DEDFDE">
  								<td width="6"><img src="images/box-left-bottom.gif"></td>
								<td><img src="images/spacer.gif " height="6"></td>
								<td width="6"><img src="images/box-right-bottom.gif"></td>
							</tr>
      </table>
  </table>

              <?php
                  if($task ==''||$date ==''||$id =='')
                    {
                    ?>

                   <?php

                   }
                   else{
                 ?>
                     <span class="labeltext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Submit" name="submit" onclick="javascript: return check_req_fields4notes()">
                   <?php
                  }
                  ?>

</FORM>
</body>
</html>