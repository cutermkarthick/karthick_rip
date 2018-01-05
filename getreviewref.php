<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Jan 2, 2008                  =
// Filename: getreviewref.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Popup for selecting Contract Reviews        =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$salesrecnum = $_REQUEST['salesrecnum'];

include('classes/reviewClass.php');
$newreview = new review; 
?>

<body onLoad="self.focus()">
</body>
<form>

<br>
Please select appropriate Contract Review Ref No.</b>
<br>

        <tr>&nbsp</tr>

<?php
   $result = $newreview->getreviews();

?>

        <tr>&nbsp</tr>
        <tr>
            <br>
            <td><span class="tabletext"><select name="reviewref" size="1">
             <option selected>Please Specify
             <option value=" " selected>Please Specify
             <?php
                 while ($myrow = mysql_fetch_row($result)) {  ?>
                 <option value="<?php echo $myrow[0]."|".$myrow[1]."|".$myrow[2]."|"
		                      .$myrow[3]."|".$myrow[4]."|".$myrow[9]."|".htmlspecialchars($myrow[10])
				  ."|".$myrow[11]."|".$myrow[12]."|".$myrow[13]?>" ><?php echo $myrow[1]; ?></option>
             <?php
                 }
             ?>
             </select>
            </td>
        </tr>

<script language=javascript>
function SubmitReview() {
var ind = document.forms[0].reviewref.selectedIndex;
window.opener.SetReviewref(document.forms[0].reviewref[ind].value,'<?php echo $salesrecnum?>');
if (ind == 0) 
{ alert("Please select a Contract Review Ref");
  return false;
}
self.close();
}
</script>

<input type=button value="Submit" onclick=" javascript: return SubmitReview()">
</form>

</html>

