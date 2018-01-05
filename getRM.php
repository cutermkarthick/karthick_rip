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
include('classes/rmmasterClass.php');
$newRM = new rmmaster;
?>

<html>
<head>
    <title>All RM Code</title>
</head>
<body onload=self.focus()>




<form>

<br>
Please select appropriate RM Code</b>
<br>
<?php
   $result = $newRM->getAllRMMs();

?>

        <tr>&nbsp</tr>
        <tr>
            <br>
            <td><span class="tabletext"><select name="CIM" size="1">
             <option value="aaa bbb" selected>Please Specify
             <?php
                 while ($myrow = mysql_fetch_row($result)) {  ?>
                 <option value='<?php echo $myrow[0]."|".$myrow[1]."|".$myrow[2]."|".$myrow[3]."|".$myrow[4]."|".$myrow[5]."|".
                           $myrow[6]."|".$myrow[7] ?>' ><?php echo $myrow[1]."|".$myrow[2]."|".$myrow[3]; ?></option>
             <?php
                    }
             ?>

             </select>
            </td>
        </tr>

<script language=javascript>
function SubmitCIM(etype) {
 //alert('hi');
   var ind = document.forms[0].CIM.selectedIndex;
 //  alert(ind);
 //  alert(document.forms[0].CIM[ind].value);
   window.opener.SetRMcode(document.forms[0].CIM[ind].text,document.forms[0].CIM[ind].value,etype);
   self.close();
}

</script>

<input type=button value="Submit" onclick=" javascript: return SubmitCIM(window.name)">
</form>
</body>
</html>

