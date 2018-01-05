<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Mar 10, 2010                 =
// Filename: getpo_num.php                      =
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
include('classes/dnClass.php');
$newdn = new dn;
$crn=$_REQUEST['crn'];
?>

<html>
<head>
    <title>All CIM Ref Nos</title>
</head>
<body onload=self.focus()>
<form>
<br>
Please select appropriate PONUM</b>
<br>
<?php
   $result = $newdn->getpo_num($crn);

?>

        <tr>&nbsp</tr>
        <tr>
            <br>
            <td><span class="tabletext"><select name="CIM" size="1">
             <option value="aaa bbb" selected>Please Specify
             <?php
                 while ($myrow = mysql_fetch_row($result)) {
   
                  
                 $totaldn = 0;
                 $result4dnsum = $newdn->getdnsum4po($myrow[0],$myrow[1]);
                 $myrow4dnsum_po = mysql_fetch_row($result4dnsum);
                 $totaldn = $myrow4dnsum_po[0];
             ?>
                  <option value="<?php echo $myrow[0]."|".$myrow[1]."|".$myrow[2]."|".$myrow[3]."|".$totaldn."|".$myrow[4]?>"><?php echo $myrow[0]."|".$myrow[1]."|".$myrow[2]."|".$myrow[3]."|".$totaldn."|".$myrow[4]?></option>
             <?php             
                 }
             ?>
             </select>
            </td>
        </tr>

<script language=javascript>
function SubmitPO(etype) {
 //alert('hi');
   var ind = document.forms[0].CIM.selectedIndex;
 //  alert(ind);
 //  alert(document.forms[0].CIM[ind].value);
   window.opener.Setpo_num(document.forms[0].CIM[ind].text,document.forms[0].CIM[ind].value,etype);
   self.close();
}

</script>

<input type=button value="Submit" onclick=" javascript: return SubmitPO(window.name)">
</form>
</body>
</html>

