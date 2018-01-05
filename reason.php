<?php 
$custname=$_REQUEST['reasontext'];
include('contactClass.php'); 
$newContact = new contact; 
?>


<body onload=self.focus()>
<form>

<br>
Please select appropriate contact for  <b><?php echo $_REQUEST['reasontext'] ?></b>
<br>
<?php
   $result = $newContact->getContact($custname);
?>

        <tr>&nbsp</tr>
        <tr>
            
            <td><span class="tabletext"><select name="contact" size="1">
             <option selected>Please Specify
             <?php 
                 while ($myrow = mysql_fetch_row($result)) {
	             printf('<option value= %s|%s|%s>%s %s',
                            $myrow[2],$myrow[3],$myrow[4],$myrow[0],$myrow[1]);
                 }
             ?>
             </select>
            </td>
        </tr>

<script language=javascript>
function SubmitReason() {
var ind = document.forms[0].contact.selectedIndex;
window.opener.SetReason(document.forms[0].contact[ind].text,document.forms[0].contact[ind].value);
if (ind == 0) 
{ alert("Please select a contact");
  return false;
}
self.close();
}
</script>

<input type=button value="Submit" onclick=" javascript: return SubmitReason()">
</form>
</html>

