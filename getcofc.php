<?php
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$crn_num=$_REQUEST['crn_num'];
$index=$_REQUEST['index'];
$type=$_REQUEST['cofctype'];
//$invnum=$_REQUEST['invnum'];




include('classes/dispatchClass.php');
$newdispatch = new dispatch;
$balance=0;
?>

<body onLoad="self.focus()">
</body>
<form>
<br>
Please select appropriate CofC</b>
<br>
<tr>&nbsp</tr>
<?php
   $result = $newdispatch->getallcofc($crn_num,$type);
   //fetch PO's
?>

        <tr>&nbsp</tr>
        <tr>
            <br>
            <td><span class="tabletext"><select name="cofc" size="1">
             <option selected value="|" width=80>Please Specify
             <?php
                         while ($myrow = mysql_fetch_row($result)) {
                 ?>
                 <option value="<?php echo $myrow[0]."|".$myrow[7]?>" >
                 <?php echo $myrow[0]."|".$myrow[7]?></option>
            <?php
                 }
             ?>
             </select>
            </td>
        </tr>

<script language=javascript>
function Submitcofc(etype,index) {
//alert("Here");
var ind = document.forms[0].cofc.selectedIndex;
//alert("index is "+ind);
window.opener.setcofc(document.forms[0].cofc[ind].text,document.forms[0].cofc[ind].value,index);
if (ind == 0)
{ 
  alert("Please select a CofC");
  return false;
}
self.close();
}
</script>

<input type=button value="Submit" onclick=" javascript: return Submitcofc(window.name,<?php echo $index ?>)">
</form>

</html>
