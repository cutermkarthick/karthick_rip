<?php

/*
  | -------------------------------------------
  | Author: FSI                                 
  | Date-written = Oct 31, 2017                 
  | Filename: GetEmployeeResource.php           
  | Copyright (C) FluentSoft Inc.               
  | Contact bmandyam@fluentsoft.com             
  | Revision: v1.0 OMS                          
  | Popup for selecting customers               
  | ------------------------------------------
*/


  session_start();
  header("Cache-control: private"); 

  if ( !isset ( $_SESSION['user'] ) )
  {
    header ( "Location: login.php" );  
  }
  $userid = $_SESSION['user'];
  include_once('classes/ResourcePlanningClass.php');
  $newRP = new ResourcePlanning;

  $shiftdate = $_REQUEST['shiftdate'];
  $cid=$_REQUEST['cid'];
?>

<body onLoad="self.focus()">
  <form>
  <br><b>Please select appropriate Employee</b><br>

  <tr>&nbsp</tr>

  <?php
    $result = $newRP->GetEmployeeUnderSubsidaryCompany($shiftdate,$cid);
  ?>

  <tr>&nbsp</tr>

  <tr>
  <br>
    <td><span class="tabletext">
      <select name="user" size="1">
        <option selected>Please Specify
        <?php 
        while ($myrow = mysql_fetch_row($result)) 
        {
          printf('<option value= %s|%s|%s|%s>%s %s', 
                  $myrow[0],$myrow[1],$myrow[2],$myrow[3],$myrow[2],$myrow[3]);
        }
        ?>
      </select>
    </td>
  </tr>

  <script language=javascript>
  function SubmitCust() 
  {
    var ind = document.forms[0].user.selectedIndex;
    window.opener.SetEmployee(document.forms[0].user[ind].text,document.forms[0].user[ind].value);
    
    if (ind == 0) 
    { 
      alert("Please select a User");
      return false;
    }
    self.close();
  }
  </script>
  <input type=button value="Submit" onclick=" javascript: return SubmitCust()">
  </form>
</body>
</html>

