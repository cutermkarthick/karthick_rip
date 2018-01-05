<?php
session_start();

include('classes/workflowClass.php');

$newWF = new workflow;
$crn = $_REQUEST['crn'];
// echo $crn."*-*--**-*-";
$wf = $newWF->getWF4crn($crn,'WO');
$wfcnt=$newWF->getcountWF4crn($crn,'WO');

if($wfcnt >0)
{

   // echo "reached";
?>
  <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 id="mytable" class="stdtable1">

    <tr  bgcolor="#FFFFFF">
            <td bgcolor="#EEEFEE"><span class="heading"><b>Select</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Department</b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b>Milestone</b></td>
           <td bgcolor="#EEEFEE"><span class="heading"><b>Scheduled Date</b></td>
          <td bgcolor="#EEEFEE"><span class="heading"><b><center>Owner</center></b></td>
          <td bgcolor="#EEEFEE"><span class="heading"><b><center>Secs <br>Resposibility</center></b></td>
          <td bgcolor="#EEEFEE"><span class="heading"><b><center>Primary<br>Resposibility</center></b></td>
          <td bgcolor="#EEEFEE"><span class="heading"><b><center>Process</center></b></td>
           <td bgcolor="#EEEFEE"><span class="heading"><b><center>ETA</center></b></td>
       </tr>
    <input type="hidden" name="max" value="<?php echo "$wfcnt";?>">
   <input type="hidden" name="max1" value="0">
<?php
$i=1;


        while ($myrow = mysql_fetch_row($wf)) 
        {
// echo "<pre>";
// print_r($myrow);

        $crn_dates="crn_dates" . $i;
        $crn_est="crn_est" . $i;
        $crn_chknm="crn_ckbo".$i;
        $crn_dependency="crn_dependency" . $i;
        $crn_stagename="crn_stagename" . $i;
        $crn_stagenum="crn_stagenum" . $i;
        $crn_dept="crn_dept" . $i;
        $crn_secs_respose="crn_secs_respose" . $i;
        $crn_process="crn_process" . $i;
        $crn_when_process="crn_when_process" . $i;
        $crn_email = "crn_email" .$i;
        $crn_owner = "crn_owner" .$i;
        $crn_ownerrecnum = "crn_ownerrecnum" .$i;
        $crn_primary_respose="crn_primary_respose" . $i;
?>


          <tr bgcolor="#FFFFFF">
            <td  bgcolor=#FFFFFF><span class=tabletext><input type=checkbox name=<?php echo "$crn_chknm";?> value=""  onclick="Setmax(<?php echo "$i";?>)" checked></td>
            <td><span class="heading"><?php echo $myrow[2] ?></td>
            <td><span class="heading"><?php echo $myrow[3] ?></td>
           <input type="hidden" name="<?php echo "$crn_est";?>" value="<?php echo "$myrow[9]";?>">

            <td><input type="text" name="<?php echo $crn_dates ?>" id="<?php echo $crn_dates ?>" style="background-color:#DDDDDD;" readonly="readonly" size=10 value="">
              <img src="images/bu-getdate.gif" alt="Get Date" onclick='GetDate1("<?php echo $crn_dates ?>")'>
            </td>

<?php
          if ($myrow[2] != 'Cust') 
          {
            
?>
            <td><input type="text" id="<?php echo $myrow[3]."".$crn_owner ?>" name="<?php echo $myrow[3]."".$crn_owner ?>" style=";background-color:#DDDDDD;" readonly="readonly" size=20 value="">
              <img src="images/bu-getowner.gif" alt="Get Owner" onclick='GetOwner("<?php echo $myrow[3]."".$crn_owner ?>")'>
            </td>
                <input type="hidden" name="<?php echo $myrow[3]."".$crn_ownerrecnum ?>" 
                id="<?php echo $myrow[3]."".$crn_owner.'recnum' ?>" value="">
                 <input type="hidden" name="<?php echo $crn_secs_respose ?>" value="<?php echo $myrow[11] ?>">
                 <input type="hidden" name="<?php echo $crn_stagename ?>" value="<?php echo $myrow[3] ?>">
                 <input type="hidden" name="<?php echo $crn_process ?>" value="<?php echo $myrow[12] ?>">
                 <input type="hidden" name="<?php echo $crn_when_process ?>" value="<?php echo $myrow[13] ?>">
                 <input type="hidden" name="<?php echo $crn_stagenum ?>" value="<?php echo $myrow[15] ?>">
                 <input type="hidden" name="<?php echo $crn_dept ?>" value="<?php echo $myrow[2] ?>">
                 <input type="hidden" name="<?php echo $crn_dependency ?>" value="<?php echo $myrow[10] ?>">
                  <input type="hidden" name="<?php echo $crn_email ?>" value="<?php echo $myrow[14] ?>">
                    <input type="hidden" name="<?php echo $crn_primary_respose ?>" value="<?php echo $myrow[16] ?>">

<?php

          }
          else {

?>
            <td colspan=3>&nbsp
            </td>
<?php
          }

?>        
           <td><input type="text" name="<?php echo $secs_respose ?>" 
           id="<?php echo $secs_respose ?>" readonly="readonly" style="background-color: #DDDDDD;" size="15" value="<?php echo $myrow[11] ?>"> 
          </td>

           <td><input type="text" name="<?php echo $crn_primary_respose ?>" id="<?php echo $crn_primary_respose ?>" readonly="readonly" style="background-color: #DDDDDD;" size="15" value="<?php echo $myrow[16] ?>"> 
          </td>

          <td>
            <textarea name="<?php echo $process ?>" rows=2 cols=15 readonly="readonly" style="background-color: #DDDDDD; overflow-y: scroll;"> <?php echo $myrow[12] ?></textarea>
        
          </td>

          <td>
               <textarea name="<?php echo $when_process ?>" rows=2 cols=15 readonly="readonly" style="background-color: #DDDDDD; overflow-y: scroll;"> <?php echo $myrow[13] ?></textarea>

          </td>
          </td>

          </tr>

<?php
         $i++;
        }
        echo '</table>';

     }

?>

