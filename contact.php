<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: contact.php                       =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Displays contact popup                      =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$custrecnum=$_REQUEST['reasontext'];
$customer=$_REQUEST['customer'];
include('classes/contactClass.php'); 
$newContact = new contact; 
?>
<body onload=self.focus()>
<form>

<br>
Please select appropriate contact for  <b><?php echo $_REQUEST['customer'] ?></b>
<br>
<?php
   $result = $newContact->getContact4company($custrecnum);
?>

        <tr>&nbsp</tr>
        <tr>
            
            <td><span class="tabletext"><select name="contact" size="1">
             <option selected>Please Specify
             <?php 
                 while ($myrow = mysql_fetch_row($result)) {
	             printf('<option value= %s|%s|%s>%s %s',
                            $myrow[2],$myrow[3],$myrow[4],$myrow[0],$myrow[1]);
         // echo " $myrow[2]</br>";     echo " $myrow[3]</br>";     echo " $myrow[4]</br>";     echo " $myrow[0]</br>";     echo " $myrow[1]</br>";
                 }
             ?>
             </select>
            </td>
        </tr>

<script language=javascript>
function SubmitReason(ctype) {
var ind = document.forms[0].contact.selectedIndex;

if (ctype == 'CustSignoffBy') 
{
   window.opener.SetCustSignoffBy(document.forms[0].contact[ind].text,document.forms[0].contact[ind].value);
}
if (ctype == 'Contact') 
{
   window.opener.SetContact(document.forms[0].contact[ind].text,document.forms[0].contact[ind].value);
}
if (ctype == 'NewUser') 
{
   window.opener.SetNewUserContact(document.forms[0].contact[ind].text,document.forms[0].contact[ind].value);
}
if (ind == 0) 
{
  alert("Please select a contact");
  return false;
}
self.close();
}
</script>

<input type=button value="Submit" onclick=" javascript: return SubmitReason(window.name)">
</form>
</html>

