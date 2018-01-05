<?php
//
//==============================================
// Author: FSI                                 =
// Date-written: June 20, 2004                 =
// Filename: printBoardWO.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Printing Board WO                           =
//==============================================
session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}


// Includes
include_once('classes/loginClass.php');
include('classes/solutionClass.php');
include('classes/workorderClass.php');

$solrecnum = $_REQUEST['solrecnum'];
if ( !isset ( $solrecnum) )
{
     header ( "Location: login.php" );
    
}
$_SESSION['solrecnum'] = $solrecnum; 
$userid = $_SESSION['user'];

$newlogin = new userlogin;
$newlogin->dbconnect();

$newsol = new solution; 

	$result=$newsol->getsols4prntUpd($solrecnum);
	$myrow = mysql_fetch_row($result);

?>
<link rel="stylesheet" href="style.css">

<html>
<head>
<title></title>
</head>

<table width=630 border=0>
<tr><td><font style="Arial" size=5><center><b><A HREF="javascript:window.print()">Solution</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>
  
<table width=500 border=1 rules=none align="center">

        <tr >
            <td colspan=4><span class="heading"><center><b>Solution Request  :<?php echo "$solrecnum";?></b></center></td>
        </tr>
        
        <tr>
            <td ><span class="labeltext"><p align="left">Solution Num</p></font></td>
            <td ><span class="tabletext"><p align="left"><?php echo "$myrow[1]";?></p></font></td>

        </tr>
        <tr>
       
            <td><span class="labeltext"><p align="left">Solution Title</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[2]";?></p></font></td>
        <tr>
            <td><span class="labeltext"><p align="left">Solution Type</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[3]";?></p></font></td>
        </tr>
        <tr>
            <td><span class="labeltext"><p align="left">Solution Upload File</p></font></td>
            <td><span class="tabletext"><p align="left"><?php echo "$myrow[6]";?></p></font></td>
        </tr>

        <tr >
           <td colspan=4><span class="heading"><center><b>Problem Description</b></center></td></tr><tr>
      <td colspan=4><span class="tabletext"><p align="left"><?php echo  "$myrow[4]";?> </p></font></td>

        </tr>
         <tr >
           <td colspan=4><span class="labeltext"><center><b>Solution Description</b></center></td></tr><tr>
          <td colspan=4><span class="tabletext"><p align="left"><?php echo  "$myrow[5]";?></p></font></td>
        </tr>
        <tr>

            
        </tr>
        </table>


      </FORM>



     </table>
    </td>
</tr>
</table>



</body>
</html>
