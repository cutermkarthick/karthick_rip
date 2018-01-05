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
$type=$_REQUEST['type'];

//echo$companyrecnum."----------";
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
   $result = $newinv->getallcustpo($companyrecnum,$type,$crn_num);
   //fetch PO's
?>

        <tr>&nbsp</tr>
        <tr>
            <br>
            <td><span class="tabletext"><select name="custpo" size="1">
             <option selected value="Please Specify" width=80>Please Specify
             <?php
                         while ($myrow = mysql_fetch_row($result)) {
                           
                         
                         $result_qty=$newinv->getcustpoqty4invoice($crn_num,$companyrecnum,$myrow[0],$type);
                         $myqty=mysql_fetch_row($result_qty);
                         $num_rows = mysql_num_rows($result_qty);
                            
                         if ($num_rows > 0) {


                             $balance = ($myrow[3] - $myqty[0]);
                         }
						 else
						 {
                            $balance = $myrow[3];
                         }

                        // $balance=$myrow[3]-($myqty[0]+$balance);
                  
                  //echo $myqty[0]."***********--------".$myrow[3]."---------------------".$balance;

                  if($balance > 0)
                  {

                    
                 ?>
                 <option value="<?php echo $myrow[0]."|".$myrow[1]."|".$myrow[2]."|".$balance?>" >
                 <?php echo $myrow[0]?></option>
                <?php
            }
                 }
                 
             ?>
             </select>
            </td>
        </tr>

<script language=javascript>
function Submitcustpo(etype,index) {
//alert("Here");
var ind = document.forms[0].custpo.selectedIndex;
//alert("index is "+ind);
window.opener.setcustpo(document.forms[0].custpo[ind].text,document.forms[0].custpo[ind].value,index);
if (ind == 0)
{ 
    alert("Please select a Custpo");
    return false;
}
self.close();
}
</script>

<input type=button value="Submit" onclick=" javascript: return Submitcustpo(window.name,<?php echo $index ?>)">
</form>

</html>
