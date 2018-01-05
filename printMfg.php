<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 18, 2005                =
// Filename: printMfg.php                 =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OMS                          =
// Coded by Jerry George
	//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$cond = "c.name like '%'";
$mfgrecnum=$_REQUEST['recnum'];
$_SESSION['mfgrecnum'] = $mfgrecnum; 
//////session_register('mfgrecnum');
$add='';
$_SESSION['pagename'] = 'mfgDetails'; 
//////session_register('pagename');

// First include the class definition 

include_once('classes/userClass.php'); 
include_once('classes/loginClass.php'); 
include('classes/mfgClass.php');
include('classes/displayClass.php'); 
$newmfg = new mfg; 
$newlogin = new userlogin;
$newlogin->dbconnect();
$username = $_SESSION['user'];
$newdisplay = new display; 

?>

<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/mfg.js"></script>

<html>
<head>
<title>Print MFG Orders</title>
</head>

<?php 
$result = $newmfg ->getmfg($mfgrecnum);
$myrow=mysql_fetch_row($result);
 ?>
<table width=650 border=0>
<tr><td><font style=\"Arial\" size=5><center><b><A HREF="javascript:window.print()">MFG Order</A></b></center></td</tr>
</table>

<table border=0 bgcolor="#FFFFFF" width=100% cellspacing=1 cellpadding=3>
   <tr><td>&nbsp; </td> </tr>
</table>
   
<table width=660 border=1 rules=none>
      <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>General Information</b></center></td>
        </tr>

<tr bgcolor="#FFFFFF" width=100%>
<td><span class="labeltext"><p align="left">*Mfg ID #</p></td>
<td ><span class="tabletext"><?php echo $myrow[0] ?></td>
<td><span class="labeltext"><p align="left">*Order Date</p></font></td>
<td ><span class="tabletext"><?php echo $myrow[2] ?>	
</td>
</tr>

<tr bgcolor="#FFFFFF">
<td><span class="labeltext"><p align="left">Mfg Desc</p></font></td>
<td colspan=3><span class="tabletext"><?php echo $myrow[1] ?></td>
</tr>
        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Company</p></font></td>
           
            <td  colspan=3><span class="tabletext"><?php echo $myrow[6] ?> </td>
  
</tr>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>*Contact Information</b></center></td>
        </tr>
<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Contact</p></font></td>
           
            <td colspan=3><span class="tabletext"><?php echo "$myrow[7]  $myrow[8] "?>
            </td>
        </tr>

        <tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Phone</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[9] ?></td>
 
            <td><span class="labeltext"><p align="left">Email</p></font></td>
            <td><span class="tabletext"><?php echo $myrow[10] ?></td>
        </tr>
</table>

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
						
<tr>
            <td bgcolor="#EEEFEE"><span class="heading"><b>WO</b></td>
           <td bgcolor="#EEEFEE"><span class="heading"><b><center>Company</center></b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b><center>Designer</center></b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b><center>Type</center></b></td>
           <td bgcolor="#EEEFEE"><span class="heading"><b><center>Cust PO</center></b></td>
           <td bgcolor="#EEEFEE"><span class="heading"><b>Quote</b></td>  
            <td bgcolor="#EEEFEE"><span class="heading"><b><center>Status</center></b></td>    
           <td bgcolor="#EEEFEE"><span class="heading"><b><center>Sch Due Date(yymmdd)</center></b></td>
            <td bgcolor="#EEEFEE"><span class="heading"><b><center>Actual Ship Date(yymmdd)</center></b></td>  
                 
        </tr>


        
<?php


            $result = $newmfg->getwo4mfg($mfgrecnum); 
            $flag = 0;
        while ($myrow = mysql_fetch_row($result)) {
            if ($flag == 0)
 {
              	      printf('<tr><td  bgcolor="#FFFFFF"><span class="tabletext">%s</td>',
		        $myrow[0] 
                        );

              $flag = 1;
?>              <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
                         <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[13] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[4] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[5] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow[14] != '00-00-00') echo $myrow[14] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow[15] != '00-00-00') echo $myrow[15] ?></td></tr>
        </tr>
<?php
        }

            else {
              	      printf('<tr><td  bgcolor="#FFFFFF"><span class="tabletext">%s</td>',
		        $myrow[0] 
                        );
                     $flag = 0;
?>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[2] ?></td>
                         <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[13] ?></td>
                         <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[1] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[4] ?></td>
                          <td bgcolor="#FFFFFF"><span class="tabletext"><?php echo $myrow[5] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow[14] != '00-00-00') echo $myrow[14] ?></td>
               <td bgcolor="#FFFFFF"><span class="tabletext"><?php if ($myrow[15] != '00-00-00') echo $myrow[15] ?></td></tr>
        </tr>
<?php
        }
    }
?>


   
<tr>
</tr>



     </table>
    </td>
</tr>
</table>



</body>
</html>
