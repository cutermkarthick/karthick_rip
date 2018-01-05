<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: custEmail.php                     =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OMS                          =
// Allows for customer email                   =
//==============================================

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
if ( !isset ( $_REQUEST['wonum'] ) )
{
     header ( "Location: login.php" );
    
}
$_SESSION['pagename'] = 'custemail'; 
//session_register('pagename');
$wonum = $_REQUEST['wonum'];

// First include the class definition 
include('classes/workorderClass.php');
include('classes/displayClass.php');
$newwo = new workOrder; 
$newdisp = new display; 

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<html>
<head>
<title>Customer Email</title>
</head>

<body leftmargin="0"topmargin="0" marginwidth="0">
<?php
include('header.html');
?>


<table width=100% cellspacing="0" cellpadding="6" border="0">

<tr><td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
    <tr>
        <td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        <td colspan=9 align="right" width="7%"><a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/logout_mo.gif',1)"><img name="Image15" border="0" src="images/logout.gif"></a></td>

        
    </tr>
</table>


<table width=100% border=0 cellpadding=0 cellspacing=0  >
	<tr><td>
	
	</td></tr>
	<tr>
	<td>
<?php $newdisp->dispLinks(''); ?>


</table>
<table width=100% border=0 cellpadding=0 cellspacing=0  >

		

			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/spacer.gif " width="6"></td>
				<td bgcolor="#FFFFFF">

<table width=100% border=0 cellspacing="1" cellpadding="6">
    <tr>
        <td align="left"><span class="heading"><b>Email Text</b></td>
    </tr>
<FORM ACTION = "processCustEmail.php" METHOD = "POST">
 <table border=0 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3>
        <tr bgcolor="#DDDEDD">
            <td colspan=4><span class="heading"><center><b>Email Text</b></center></td>
        </tr>
        <tr bgcolor="FFFFFF">
             <td colspan=4><textarea name="email" rows="3" cols="72" value=""></textarea></td>
        </tr> 
            <tr><td><input type="hidden" name="wonum" value="<?php echo $wonum ?>" /></td></tr>
        </tr> 
            
        </table>
				</td>


				<td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
			<tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td ><img src="images/spacer.gif" height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>

	 
 
       <table>
       <tr>
 
        <span class="tabletext"><input type="submit" value="Submit" name="submit">
        
      </FORM>

</td></tr>


					</table>






</body>
</html>
