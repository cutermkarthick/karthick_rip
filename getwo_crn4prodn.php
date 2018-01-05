<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: getboarddes.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Popup for selecting board designers         =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
include('classes/workorderClass.php');
include('classes/operatorClass.php');
$newwo = new workorder;
$newoperator = new operator;
$mcname = $_REQUEST['mcname'];
//echo 'Oper name='.$oper_name;
$entdate = $_REQUEST['entdate'];
//echo 'Entered Date='.$entdate;
$shift = $_REQUEST['shift'];
?>

<html>
<head>
    <title>All CIM Ref Nos</title>
</head>
<body onload=self.focus()>

<form>
<?php
//echo "Ent date:$entdate shift:$shift mcname:$mcname";
$result = $newoperator->get_prev_rec($mcname,$entdate,$shift);
$myrow = mysql_fetch_row($result);
$numrows = mysql_num_rows($result);
$total_time = ($myrow[2] * 60) + $myrow[3] + ($myrow[4] * 60) + $myrow[5] + ($myrow[6] * 60) + $myrow[7];
//echo 'Total time='.$total_time;
if($numrows > 0)
{
 if($total_time != 480)
 {
  $valid_flag = 1;
 }
 else
 {
  $valid_flag = 0;
 }
}
else
{
 $valid_flag = 0;
}

$flag = $valid_flag;
//echo 'Flag=' .$flag;

//echo $valid_flag;
?>

<br>
Please select appropriate Work Order No.</b>
<br>
<?php
   $result = $newwo->getAllCIMs();

?>

        <tr>&nbsp</tr>
        <tr>
            <br>
            <td><span class="tabletext"><select name="CIM" size="1">
             <option value="aaa bbb" selected>Please Specify
             <?php
                 while ($myrow = mysql_fetch_row($result)) {  ?>
                 <option value="<?php echo $myrow[6]."|".$myrow[5];?>" ><?php echo $myrow[6]."|".$myrow[5]."|".$myrow[1]."|".$myrow[4]."|".$myrow[7]; ?></option>
             <?php
                //printf('<option value= %s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s|%s>%s  |  %s  |  %s',
                  //          $myrow[0]."|".$myrow[1]."|".$myrow[2]."|".$myrow[3]."|".$myrow[4]."|".$myrow[5]."|".
                    //        $myrow[6]."|".$myrow[7]."|".$myrow[8]."|".$myrow[9]."|".$myrow[10]."|".$myrow[11]."|".$myrow[12]."|".
                      //      $myrow[13]."|".$myrow[14]."|".$myrow[15]."|".$myrow[16]."|".$myrow[17]."|".$myrow[18]."|".$myrow[9]."|".$myrow[1]."|".$myrow[4]);

                 }
             ?>
             </select>
            </td>
        </tr>

<script language=javascript>
function SubmitCIM(etype) {
 //alert('hi');

   var ind = document.forms[0].CIM.selectedIndex;
   //alert(ind);
   //alert(document.forms[0].CIM[ind].value);
   //alert(document.forms[0].CIM[ind].text);
   //alert(document.forms[0].CIM[ind].value);
   //alert(etype);
   window.opener.Setwo_crn(document.forms[0].CIM[ind].text,document.forms[0].CIM[ind].value,etype,'<?php echo $flag?>');
   self.close();
}

</script>

<input type=button value="Submit" onclick=" javascript: return SubmitCIM(window.name)">
</form>
</body>
</html>

