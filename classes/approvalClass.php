<?php

//====================================
// Author: FSI
// Date-written = Feb 25, 2005
// Filename: approvalClass.php
// Maintains the Approval Class.
// Revision: v1.0
//====================================

include_once('loginClass.php');
include_once('datesClass.php');
include_once('helperClass.php');
class approval {


    function dispApprSignOff($inpdoctype, $inpdocrecnum, $inptype, $inptypenum) {

        $userrole = $_SESSION['userrole'];
        $userid = $_SESSION['user'];
        $usertype = $_SESSION['usertype'];
        $user = "'" . $userid . "'";
        $doctype = "'" . $inpdoctype . "'";
        $docrecnum = $inpdocrecnum;
        $type = "'" . $inptype . "'";
        $typenum = $inptypenum;

        $newlogin = new userlogin;
        $newlogin->dbconnect();



        $sql = "select wf.stage, wo.recnum,wo.wo2wfconfig
                     from work_order wo, work_flow_config wf
                     where wo.recnum = $docrecnum and
                           wo.wo2wfconfig = wf.recnum
               ";
        $wores = mysql_query($sql);
        // Test to make sure query worked
        if(!$wores) die("Work Order Access failed in Approval. Please report to sysadmin" . mysql_error());
        $wostage = 0;
        while ($mywo = mysql_fetch_row($wores)) {
            $wostage = $mywo[0];
        }

/*        $sql = "select wf.recnum, wf.stage, wf.type, wf.dept, wf.doc_type,
                       wf.status, d.recnum, wf.appr_type
                       from dates d right join work_flow_config wf on
                                   wf.recnum = d.link2wfconfig and
                                   d.link2wo = $docrecnum
                             where  wf.type = $type and
                                    wf.doc_type = $doctype
                             ORDER by stage";
*/
$sql = "select wf.recnum, wf.stage, wf.type, wf.dept, wf.doc_type,
                       wf.status, d.recnum, wf.appr_type
                       from dates d,work_flow_config wf 
                       where
                                   wf.recnum = d.link2wfconfig and
                                   d.link2wo = $docrecnum and
                                   wf.type = $type and
                                   wf.doc_type = $doctype
                             ORDER by stage";
        $wfconfigres = mysql_query($sql);
         // Test to make sure query worked
        if(!$wfconfigres) die("WF config access failed in Approval...... Please report to sysadmin" . mysql_error());
        $matchfound = 0;
        while ($mywfc = mysql_fetch_row($wfconfigres)) {
               if ($mywfc[1] > $wostage) {
                   $nextstage = $mywfc[1];
                   $nextstatus = $mywfc[5];
                   $wfrecnum = $mywfc[0];
                   $drecnum = $mywfc[6];
                   $appr_type = $mywfc[7];
                   $matchfound = 1;
                   break;
               }
        }


//             echo '</td></tr><tr width=100% bgcolor="DEDEDF"><td height="28"><img width="50" src="images/spacer.gif" height="1"><img src="images/direction.gif" border="0" height=20>';

        if ($matchfound == 1)
        {
         /*   if ($usertype == 'EMPL' && $userrole == 'SU')

            {
                echo '<a href=approval.php?' .
                               'type=' . $type .
                               '&typerecnum=' . $typenum .
                               '&wfrecnum=' . $wfrecnum .
                               '&drecnum=' . $drecnum .
                               '&nextstage=' . $nextstage .
                               '&nextstatus=' . $nextstatus .
                               
                               ' onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'Image21\',\'\',\'images/approval_mo.gif\',1)"><img name="Image21" border="0" src="images/approval.gif"></a>';
            }

            else
            {
                if ($usertype == 'CUST')
                {
                  if ($appr_type == 'E')
                  {
                      echo '</td></tr><tr width=100% bgcolor="DEDEDF"><td height="28"><img width="50" src="images/spacer.gif" height="2"><img src="images/direction.gif" border="0" height=20>';
                      echo '<a href=approval.php?' .
                               'type=' . $type .
                               '&typerecnum=' . $typenum .
                               '&wfrecnum=' . $wfrecnum .
                               '&drecnum=' . $drecnum .
                               '&nextstage=' . $nextstage .
                               '&nextstatus=' . $nextstatus .
                               ' onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage(\'Image21\',\'\',\'images/approval_mo.gif\',1)"><img name="Image21" border="0" src="images/approval.gif"></a>';


                  }
                  else
                  {
                             echo '</td></tr><tr width=100% bgcolor="DEDEDF"><td height="28"><img width="50" src="images/spacer.gif" height="1"><td align="right"><img src="images/box-right-top.gif"></td></td></tr>';
                  }
                }
            } */
        }

    }


    function updSignOff($worecnum, $wfrecnum, $nextstatus, $drecnum, $stagenum) {

        $userrole = $_SESSION['userrole'];
        $userid = $_SESSION['user'];
        $usertype = $_SESSION['usertype'];
        $userrecnum = $_SESSION['userrecnum'];
        $status = "'" . $nextstatus . "'";
        $user = "'" . $userid . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $newDates = new dates;

        $sql = "select * from work_order where recnum = $worecnum for update";
        $result = mysql_query($sql);
        if(!$result) {
           echo "Access to Work Order for Approval failed.. " . mysql_error();
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Please report to Sysadmin. ");
        }

        $sql="update dates set dependency='' where dependency = $stagenum and link2wo=$worecnum" ;
       // echo $sql;
        $result=mysql_query($sql);
        
      /* $sql = "update work_order set wo2wfconfig = $wfrecnum,
                                      status = $status
                                  where recnum = $worecnum";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
             echo "<br>hi1<br>";
           echo "Update of Work Order in Approval failed.. " . mysql_error();
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Please report to Sysadmin. ");
        }   */
        if ($drecnum == NULL || $drecnum == '') {
            $newDates->setschdue('');
            $newDates->setlink2wfconfig($wfrecnum);
            $newDates->setlink2owner('NULL');
            $newDates->setlink2contact('NULL');
            $drecnum = $newDates->adddates($worecnum);
        }
        $newHelper = new helper;
        $completed_date=$newHelper->getdate4Timezone();
        
        if ($usertype == 'EMPL')
        {
             /*$sql = "update dates
                          set
                              completed = curdate(),
                              link2approvedbyowner = $userrecnum
                         where link2doc = $worecnum and
                               recnum = $drecnum and
                               link2wfconfig = $wfrecnum";  */
             $sql = "update dates
                          set
                              completed = '$completed_date',
                              link2approvedbyowner = $userrecnum
                         where link2doc = $worecnum and
                               recnum = $drecnum";
        }
        else if ($usertype == 'CUST')
        {
             $sql = "update dates
                          set
                              completed = '$completed_date',
                              link2approvedbycontact = $userrecnum
                         where link2doc = $worecnum and
                               recnum = $drecnum and
                               link2wfconfig = $wfrecnum";
        }


        $result = mysql_query($sql);
           // Test to make sure query worked
        if(!$result) {
        echo "<br>hi4<br>";
           echo "Update on Dates in Approval failed.. " . mysql_error();
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Please report to Sysadmin. ");
        }

     }

function updSignOff1($worecnum, $wfrecnum, $nextstatus, $drecnum,$comdate,$x) {
        $userrole = $_SESSION['userrole'];
        $userid = $_SESSION['user'];
        $usertype = $_SESSION['usertype'];
        $userrecnum = $_SESSION['userrecnum'];
        $status = "'" . $nextstatus . "'";
        $user = "'" . $userid . "'";
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $newDates = new dates;

        $sql = "select * from work_order where recnum = $worecnum for update";
        $result = mysql_query($sql);
        if(!$result) {
           echo "Access to Work Order for Approval failed.. " . mysql_error();
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Please report to Sysadmin. ");
        }
      /*  $sql = "update work_order set wo2wfconfig = $wfrecnum,
                                      status = $status
                                  where recnum = $worecnum";
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) {
          echo "<br>hi2<br>";
           echo "Update of Work Order in Approval failed.. " . mysql_error();
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Please report to Sysadmin. ");
        }       */
        if ($drecnum == NULL || $drecnum == '') {
            $newDates->setschdue('');
            $newDates->setlink2wfconfig($wfrecnum);
            $newDates->setlink2owner('NULL');
            $newDates->setlink2contact('NULL');
            $drecnum = $newDates->adddates($worecnum);
        }
        if ($usertype == 'EMPL')
        {
           /*  $sql = "update dates
                          set
                              completed = '$comdate',
                              link2approvedbyowner = $x
                         where link2doc = $worecnum and
                               recnum = $drecnum and
                               link2wfconfig = $wfrecnum"; */
              $sql = "update dates
                          set
                              completed = '$comdate',
                              link2approvedbyowner = $x
                         where link2doc = $worecnum and
                               recnum = $drecnum";
        }
        else if ($usertype == 'CUST')
        {
             $sql = "update dates
                          set
                              completed = curdate(),
                              link2approvedbycontact = $userrecnum
                         where link2doc = $worecnum and
                               recnum = $drecnum and
                               link2wfconfig = $wfrecnum";
        }


        $result = mysql_query($sql);
           // Test to make sure query worked
        if(!$result) {
        
        echo "<br>hi3<br>";
        
           echo "Update on Dates in Approval failed.. " . mysql_error();
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Please report to Sysadmin. ");
        }

     }
} // End approval class definition

