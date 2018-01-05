<?php
session_start();
header("Cache-control: private"); 

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
    
}
$userid = $_SESSION['user'];
//$_SESSION['srpage'] = 'solutionsummary'; 
////session_register('srpage');

$cond = "s.solnum like '%'";
$worec='';
$oper='like';
$select='sol';
$sort1='sol';
$sol_match='';
$where1='';
if ( isset ( $_REQUEST['solcritval'] ) )
	$select=$_REQUEST['solcritval'];
if ( isset ( $_REQUEST['sol'] ) )
{
		$sol_match = $_REQUEST['sol']  ;
         		$cond = "s.prob_desc like" . " " .  "'" . "%" . $_REQUEST['sol'] . "%" . "'" . " " . "||" . " " . "s.sol_desc like" . " " .  "'" . "%" . $_REQUEST['sol'] . "%" . "'" ;
}
else
{$sol_match = '';
}

$sort1='';

/*if ( isset ( $_REQUEST['solutions'] ) ) {
		$i=$_REQUEST['solutions'];
	}*/


if ( isset ( $_REQUEST['sortfld1'] ) ) {
    $sort1 = $_REQUEST['sortfld1'];
$sort1='s.solnum';
}

include_once('classes/userClass.php'); 
include_once('classes/loginClass.php'); 
include('classes/solutionClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
//$username = $_SESSION['user'];
$newsol = new solution; 
// For paging - Added on Dec 6,04
 
// how many rows to show per page 
$rowsPerPage =15; 

// by default we show first page 
$pageNum = 1; 

// if $_GET['page'] defined, use it as page number 
if (isset($_REQUEST['page'])) 
{ 
    $pageNum = $_REQUEST['page']; 
} 
if (isset($_REQUEST['totpages'])) 
{ 
    $totpages = $_REQUEST['totpages']; 
} 

// counting the offset 
$offset = ($pageNum - 1) * $rowsPerPage; 
 
?>

<html>
<head>
<title>Solution </title>
</head>

<link rel="stylesheet" href="style.css">

<table width=100% cellspacing="2" cellpadding="5" border="0">
  <tr><td>
		<table width=100%  cellspacing="2" cellpadding="0" border=0>
    			<tr>
 		       		 <td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
            			 </tr>
			<tr><td colspan=3><span class="labeltext"><b>Select Solution No By Clicking:</b></td></tr>
		</table>
	<tr><td>
	<form action='srSolution.php' method='post' enctype='multipart/form-data'>
		<?php 
			// Following HTML added to implement search and sort mechanism on Dec 29 -04?>
		<table border=1 >
		 <tr><td>
			<table border=1>
    				<tr>
      					  <td colspan=3><span class="heading"><b><center> Key Word Search </center></b></td>
    				</tr>
  				  <tr>
 					    <td><input type="text" name="sol" size=15 value="<?php echo $sol_match ?>" onkeypress="javascript: return checkenter(event)">
        					    </td>
        				  </tr>
		                 </table>
		</td>
		<td>
		<table border=1>
   		 	<tr>
       				 <td colspan=5><span class="heading"><b><center>Sort Criteria</center></b></td>
    			</tr>
    			<tr>
       				<td><span class="labeltext"><b>Sort by</b></td>
      				<td><span class="tabletext"><select name="sort1" size="1" width="100">
					<?php if($sort1=='sol'){?>
             					<option selected>sol
             					<option value>Company<?php }else {?>
             					<option selected>Company
					<option value>sol<?php }?>
             					 </select>
             					<input type="hidden" name="sortfld1">
         		 		</td>
     			 </tr>
		</table>
		</td>
		 <td>
		 	<table border=1>
				<tr>
       					 <td><span class="tabletext"><input type="submit" 
                    				 style="color=#0066CC;background-color:#DDDDDD;width=90;"
                     				  value="Get" name="submit" onclick="javascript: return searchsort_fields()"></td>
        					 </td>
				</tr>
			</table>
		</td>
</table>
</table>
<?php 
	// End of HTML addition?>
<table>

    	    <tr>
        		<td><span class="pageheading"><b>List of Service Requests</b></td>
    	    </tr>
</table>
 <div style="overflow: scroll; width: 400px; height: 200px;">
<table width=430 border=1  RULES=ALL FRAME=BOX>
        <tr bgcolor="#EEEFEE">
            	<td width="5"><span class="heading"><b>Select </b></td>
            	<td width="25"><span class="heading"><b>Sol ID </b></td>
           	<td width="55"><span class="heading"><b>Type</b></td>
            	<td width="100"><span class="heading"><b>Title</b></td></tr> 
	   <input type="hidden" name="solnumval">
	   <input type="hidden" name="solnum">
         <?php
            $result = $newsol->getsols($cond,$sort1,$offset,$rowsPerPage); 

          while ($myrow = mysql_fetch_row($result)) {
			$radbx=$myrow[0];
	?>                           <tr><td><span class="tabletext"><input type="radio" name="solutions"  value=<?php echo $radbx;?>
			 onclick="javascript :setsolnum(<?php echo $radbx;?>,'<?php echo $myrow[1];?>')"></td>
                           <td><span class="tabletext"><?php echo $myrow[1] ?></td>
                           <td><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td><span class="tabletext"><?php echo $myrow[2] ?></td>
           <?php
	}
              ?>
        <tr>
        </tr>
</table>
 </div>
<table>
       <tr>
        	<br> 
        </tr>


    <script language=javascript>
function setsolnum(inpsol,inpnum)
{
var sol=inpsol;
var num=inpnum;
document.forms[0].solnumval.value=sol;
document.forms[0].solnum.value=num;
}
function SubmitReason(ctype) {
window.opener.SetSolNo(document.forms[0].solnumval.value , document.forms[0].solnum.value);
self.close();}
</script>
      
<input type=button value="Submit" onclick=" javascript: return SubmitReason(window.name)">
  </FORM>
</table>

</body>
</html>
