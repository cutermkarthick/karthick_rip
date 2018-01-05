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
$newwo = new workorder;
?>

<html>
<head>
    <title>All CIM Ref Nos</title>
</head>
<body onload=self.focus()>




<form>

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
   window.opener.Setwo_crn(document.forms[0].CIM[ind].text,document.forms[0].CIM[ind].value,etype);
   self.close();
}

</script>

<input type=button value="Submit" onclick=" javascript: return SubmitCIM(window.name)">
</form>
</body>
</html>

