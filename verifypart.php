<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: verifypart.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Part verification                           =
// Modifications History                       =
// Jan 12,05 - For Reordering Work Orders      =
//             By Badarinarayan Mandyam        =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
?>
<script language=javascript>
function ClearRes() {
   document.forms[0].res.value = '';
   return true;
}
function SubmitPart(winname) {
var res = document.forms[0].res.value;
var match = 'Success for ' + document.forms[0].part.value;
if (res == match) {
if(document.forms[0].type.value== 'partqty')
{
     window.opener.SetPartNumQty(document.forms[0].part.value,document.forms[0].index.value);
     self.close()
}
else
{
     window.opener.SetPartNum(document.forms[0].part.value,document.forms[0].index.value);
     self.close()
}

}
else { alert("Please try again");}

}
function reorder_check()
{
   document.forms[0].reorder.value = "N";
   if (document.forms[0].reordercb.checked == 1)
   { 
        document.forms[0].reorder.value = "Y";
   }
     
}
function selectreorder()
{
   document.forms[0].reordercb.checked = 1;
     
}
</script>

<?php
$userid = $_SESSION['user'];
include('classes/partClass.php'); 
$newpart = new part; 
$partnum = '';
$result='';
$reorder="N";
if ( isset ( $_REQUEST['reorder'] ) )
{
   $reorder = $_REQUEST['reorder'];
}
if ( isset ( $_REQUEST['index'] ) )
{
   $index = $_REQUEST['index'];
//echo "$index";
}
if ( isset ( $_REQUEST['type'] ) )
{
   $type = $_REQUEST['type'];
//echo "$type";
}
if ( isset ( $_REQUEST['part']) && $_REQUEST['part'] != '' ) {
   $partnum = $_REQUEST['part'];
   $outcome = $newpart->VerifyPart($partnum);
   if ($reorder == 'N') {
      if ($outcome == 'No') {
          $result = 'Success for ' . $partnum;
      }
      else 
      { 
         $result = 'Part Exists...Try again';
      }
   }
   else {
         if ($outcome == 'No') {
            $result = 'Part should exist for Reorder';
         }
         else 
         { 
            $result = 'Success for ' . $partnum;
         }
   }
}

?>


<body onload=self.focus()>
<form action='verifypart.php?part="<?php echo $partnum ?>"&reorder=<?php echo $reorder ?>'method='post' enctype='multipart/form-data'>

<b>Part Verification</b>
<br>

        <tr><td><span class="labeltext"><p align="left">Reorder</td><td>&nbsp</td><td><input type="radio" name="reordercb"  
                            <?php if ($reorder == "Y") echo "checked"; ?> onclick="reorder_check()"></td>
        </tr>

       <td><input type="hidden" name="reorder" value="<?php echo $reorder ?>">
<input type="hidden" name="index" value="<?php echo $index ?>">
</td>
<input type="hidden" name="type" value="<?php echo $type ?>">

        <tr>
            
            <td><span class="labeltext"><p align="left">Part num</b></p></font></td>
            <td colspan=3><input type="text" name="part" size=30 value="<?php echo $partnum ?>"</td>
            <td><input type="submit" value="Submit" name="submit" onclick=" javascript:ClearRes()"></td>
            <td><span class="labeltext"><p align="left">Result</b></p></font></td>
            <td colspan=3><input type="text" name="res" style=";background-color:#DDDDDD;" 
                    readonly="readonly" size=30 value="<?php echo $result ?>"</td>
            <td><input type=button value="Close" onclick=" javascript:SubmitPart(window.name)"></td>
        </tr>
</form>
</html>

