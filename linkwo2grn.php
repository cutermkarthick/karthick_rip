<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Dec 19, 2007                 =
// Filename: linkwo2grn.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Link WO to GRN                              =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$qty=$_REQUEST['qty'];
$rmtype=$_REQUEST['rmtype'];
$rmspec=$_REQUEST['rmspec'];
$rmdim1=$_REQUEST['rmdim1'];
$rmdim2=$_REQUEST['rmdim2'];
$rmdim3=$_REQUEST['rmdim3'];

include('classes/workorderClass.php');
$newWO = new workorder;
?>

<html>
<head>
    <title>Link WO and GRN</title>
</head>
<body onload=self.focus()>




<form>

<br>
<b>GRN Allocation</b>
<br>
<?php
  $result = $newWO->linkWO2GRN($qty,$rmtype,$rmspec,$rmdim1,$rmdim2,$rmdim3,0,'');

?>

        <tr>&nbsp</tr>
        <tr>
            
            <td><input type="text" name="grns" size=12 value="<?php echo $result ?>">
                    
            </td>
        </tr>
<script language=javascript>
function SubmitGRN(etype) {
   var grns = document.forms[0].grns.value;
   window.opener.SetGRN(grns);
   self.close();
}

</script>

<input type=button value="Ok" onclick=" javascript: return SubmitGRN(window.name)">
</form>
</body>
</html>

