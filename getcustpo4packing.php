<?php
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$companyrecnum=$_REQUEST['companyrecnum'];
$crn_num=$_REQUEST['crn_num'];
$index=$_REQUEST['index'];
//echo$companyrecnum."----------";
echo "index is $index";
include('classes/invoiceClass.php');
$newinv = new invoice;
$balance=0;
?>

<body onLoad="self.focus()">
</body>
<form>
<br>
Please select appropriate CustPO</b>
<br>
<tr>&nbsp</tr>
<?php
   $result = $newinv->getallcustpo4packing($companyrecnum);
   //fetch PO's
?>

        <tr>&nbsp</tr>
        <tr>
            <br>
            <td><span class="tabletext"><select name="custpo" size="1">
             <option selected value="Please Specify" width=80>Please Specify
             <?php
                         while ($myrow = mysql_fetch_row($result)) {
                         //$result_qty=$newinv->getcustpoqty4invoice($crn_num,$companyrecnum,$myrow[0]);
                         //$myqty=mysql_fetch_row($result_qty);
                         //echo$balance;
                         //$balance=$myrow[3]-($myqty[0]+$balance);
                         //echo $myrow[3]."***********--------".$myqty[0];
                         $balance=0;
                         //echo "<br>************".$balance."----------";

                 ?>
                 <option value="<?php echo $myrow[0]."|".$myrow[1]."|".$myrow[2]."|".$balance?>" >
                 <?php echo $myrow[0]?></option>
            <?php
                 }
             ?>
             </select>
            </td>
        </tr>

<script language=javascript>
function Submitcustpo(etype,index) {
var ind = document.forms[0].custpo.selectedIndex;
window.opener.setcustpo(document.forms[0].custpo[ind].text,document.forms[0].custpo[ind].value,index);
if (ind == 0)
{ alert("Please select a Custpo");
  return false;
}
self.close();
}
</script>

<input type=button value="Submit" onclick=" javascript: return Submitcustpo(window.name,'<?php echo $index ?>')">
</form>

</html>
