<?php


session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
    header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'newempConfig';
$page="Employee";

include('classes/empClass.php');
$newEmp = new emp;

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/emp.js"></script>


<html>
<head>
<title>Edit Employee</title>
</head>
<body leftmargin="0"topmargin="0" marginwidth="0">
     <form action='processEmpConfig.php' method='post' enctype='multipart/form-data'>
<?php
include('header.html');
?>

    <table width=100% border=0>
        <tr>
          <td><span class="pageheading"><b>Employee</b></td>
        </tr>
   	</table>

		</td></tr>
		<tr>
    <td>

    <table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
      <tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td></tr>
     	<tr bgcolor="#FFFFFF"  >
    		<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" class="stdtable1">
          
    			<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Company</p></span></td>
            <td><input type="text" name="company" id="company" style=";background-color:#DDDDDD;" readonly="readonly" size=30 value="">
             <img src="images/bu-getcompany.gif" alt="Get Company" onclick="GetComp4Empconfig()"><input type="hidden" name="companyrecnum">
            </td>
            <td></td>
            <td></td>
        	</tr>

        	<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Shift</p></span></td>
            <td >
                <select name="shift_group" id="shift_group" >
                    <option value="please select" >please select</option>
                    <option value="general" >General</option>
                    <option value="day" >Day</option>
                    <option value="daynight" >Day Night</option>
                    <option value="night" >Night</option>
                </select>
            <td></td>
            <td></td>
        	</tr>	

        	<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Start Time</p></span></td>
           	<td >
           	<select name="start_hour" id="start_hour">
           		<option value="please select" selected>Select Hour</option>
           		<?php 
           			for ($i=0; $i < 24; $i++) { 
           				if ($i < 10) {
           					$start_hour = "0"+ $i;
           				}
           				?>
           				<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
           			<?php 
           		}
           		?>
           		
           	</select>
           	<select name="start_min" id="start_min">
           		<option value="please select" selected>Select Min</option>
           		<?php 
           			for ($j=0; $j < 60; $j++) { 
           				if ($j < 10) {
           					$start_min = "0"+ $j;
           				}
           				?>
           				<option value="<?php echo $j; ?>"><?php echo $j; ?></option>
           			<?php 
           		}
           		?>
           		
           	</select>
           	<!-- <select name="start_meridian" name="start_meridian">
           		<option value="am">AM</option>
           		<option value="pm">PM</option>
           	</select> -->
           </td>

           	<td><span class="labeltext"><p align="left">End Time</p></span></td>
           	<td >
           	<select name="end_hour" id="end_hour">
           		<option value="please select" selected>Select Hour</option>
           		<?php 
           			for ($k=0; $k < 24; $k++) { 
           				if ($k < 10) {
           					$start_hour = "0"+ $k;
           				}
           				?>
           				<option value="<?php echo $k; ?>"><?php echo $k; ?></option>
           			<?php 
           		}
           		?>
           		
           	</select>
           	<select name="end_min" id="end_min">
           		<option value="please select" selected>Select Min</option>
           		<?php 
           			for ($l=0; $l < 60; $l++) { 
           				if ($l < 10) {
           					$start_min = "0"+ $l;
           				}
           				?>
           				<option value="<?php echo $l; ?>"><?php echo $l; ?></option>
           			<?php 
           		}
           		?>
           		
           	</select>
           	<!-- <select name="end_meridian" name="end_meridian">
           		<option value="am">AM</option>
           		<option value="pm">PM</option>
           	</select> -->
           	</td>
        	</tr>


        </table>
      </td>
    </tr>
    </table>
    </td>
  </table>
                        
    <table border = 0 cellpadding=0 cellspacing=0 width=100% >
      <tr>
          <td align=left>
          </td>
      </tr>
  	</table>

    	<span class="tabletext">
    	<input type="submit"   value="Submit" name="submit"  onClick="javascript: return check_req_field4EmpConfig()">
    	<input TYPE="reset" style="color=#0066CC;background-color:#DDDDDD;width=130;" VALUE="Reset" onclick="javascript: putfocus()">

    	</form>
  </body>
</html>
