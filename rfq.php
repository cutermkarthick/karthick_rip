<?php

session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'rfq'; 
//////session_register('pagename');
// First include the class definition 
include('rfqClass.php'); 
include('mouseover.inc'); 
$newRFQ = new rfq; 
?>
<html>
<head>
<title>RFQ</title>
</head>

    <body  link="#003366" vlink="#333366" alink="#003366">
    
<table width="780" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td align="left" valign="top" bgcolor="#000033" height="566">
        <img src="top_dci.gif" width="138" height="171" border="0" alt="Dimensions Consulting Inc."><br>

  
-->

    </td>
    <td align="left" valign="top">
        <img src="top_tagline.gif" width="417" height="112" border="0" alt=""><img src="top_end.gif" width="225" height="112" border="0" alt="">

        <!-- end header -->

        <!-- content goes here-->


<table cellspacing="2" cellpadding="20" border="0">

<tr><td>
<table width=600 border=0>
    <tr>
        <td colspan=2><span class="heading"><b>Welcome <?php echo $userid?></b></td>
        <td colspan=9 align="right" width="7%"><a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image10','','images/logout_mo.gif',1)"><img name="Image10" border="0" src="images/logout.gif" width="90" height="30"></a></td>
    </tr>
<tr><td>&nbsp</td></tr>

<?php $newRFQ->dispLinks(); ?>
</tr>
</table>


    <table>
    <tr>
        <td><span class="heading"><b>List of RFQ</b></p></td>
    </tr>

        <table border=2 BORDERCOLOR="#FFCC00">


        <tr bgcolor="#FFCC00">
            <td><span class="tabletext"><b>RFQ #</b></td>
            <td><span class="tabletext"><b>Date</b></td>
            <td><span class="tabletext"><b>Company Name</b></td>
            <td><span class="tabletext"><b>Description</b></td>
                             
        </tr>

        
<?php
            $newRFQ = new rfq; 
            $result = $newRFQ->getRFQ(); 
        while ($myrow = mysql_fetch_row($result)) {
	      printf('<tr><td><span class="tabletext"><a href=%s>%s</a></td><td><span class="tabletext">%s</td><td><span class="tabletext">%s</td><td><span class="tabletext">%s</td>',
		$myrow[0],$myrow[0],$myrow[1],$myrow[2],$myrow[3]);
        }
?>

        </tr>


        <tr>

            
        </tr>
        </table>
 
       <table>
       <tr>
        <br> 
        
        </tr>
      </FORM>



     </table>
    </td>
</tr>
</table>



</body>
</html>
