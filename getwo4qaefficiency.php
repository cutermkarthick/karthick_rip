<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: getRM.php                         =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Popup for selecting RM                      =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$crn = $_REQUEST['crn'];
include('classes/qa4efficiencyClass.php');
$newqa = new qa4efficiency;
?>

<html>
<head>
    <title>All WO#</title>
</head>
<body onload=self.focus()>




<form>

<br>
Please select appropriate WO</b>
<br>
<?php
   $result = $newqa->getwo4qaeffncy($crn);

?>

        <tr>&nbsp</tr>
        <tr>
            <br>
            <td><span class="tabletext"><select name="CIM" size="1">
             <option value="aaa bbb" selected>Please Specify
             <?php
                 while ($myrow = mysql_fetch_row($result)) {  ?>
                 <option value='<?php echo $myrow[0]."|".$myrow[1] ?>'>
                  <?php echo $myrow[0]."|".$myrow[1] ?></option>
             <?php
                    }
             ?>

             </select>
            </td>
        </tr>

<script language=javascript>
function SubmitCIM(etype) {
 //alert('hi'+etype);
   var ind = document.forms[0].CIM.selectedIndex;
   //alert(ind);
   //alert(document.forms[0].CIM[ind].value);
   window.opener.Setwo4qaeffncy(document.forms[0].CIM[ind].value,etype);
   self.close();
}

</script>

<input type=button value="Submit" onclick=" javascript: return SubmitCIM(window.name)">
</form>
</body>
</html>

