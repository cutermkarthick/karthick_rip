<?php


session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
    header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'editempConfig';
$page="Employee";

include('classes/empconfigClass.php'); 
$newEmpconfig = new empconfig;

$recnum = $_REQUEST['recnum'];

$result = $newEmpconfig->getEmpConfig_details($recnum);
$myrow = mysql_fetch_row($result);

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
            <td><input type="text" name="company" id="company" style=";background-color:#DDDDDD;" readonly="readonly" size=30 value="<?php echo $myrow[6];?>">
            <input type="hidden" name="companyrecnum" id="companyrecnum" value="<?php echo $myrow[7];?>">
            </td>
            <td></td>
            <td></td>
        	</tr>

        	<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Shift</p></span></td>
            <td >
                <select name="shift_group" id="shift_group" >
                    <option value="general" <?php if($myrow[1] =="general"){ echo "selected='selected'"; }?> >General</option>
                    <option value="day" <?php if($myrow[1] =="day"){ echo "selected='selected'"; }?> >Day</option>
                    <option value="daynight" <?php if($myrow[1] =="daynight"){ echo "selected='selected'"; }?> >Day Night</option>
                    <option value="night" <?php if($myrow[1] =="night"){ echo "selected='selected'"; }?> >Night</option>
                </select>
            <td></td>
            <td></td>
        	</tr>	

        	<tr bgcolor="#FFFFFF">
            <td><span class="labeltext"><p align="left">Start Time</p></span></td>
           	<td >
           	<select name="start_hour" id="start_hour">
           		
           		<?php 
           			for ($i=0; $i < 24; $i++) { 
           				if ($i < 10) {
           					$start_hour = "0"+ $i;
           				}
           				?>
           				<option value="<?php echo $i; ?>" <?php if($myrow[2] == $i){ echo "selected='selected'"; }?>><?php echo $i; ?></option>
           			<?php 
           		}
           		?>
           		
           	</select>
           	<select name="start_min" id="start_min">
           		<?php 
           			for ($j=0; $j < 60; $j++) { 
           				if ($j < 10) {
           					$start_min = "0"+ $j;
           				}
           				?>
           				<option value="<?php echo $j; ?>" <?php if($myrow[3] == $j){ echo "selected='selected'"; }?>><?php echo $j; ?></option>
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
           		<?php 
           			for ($k=0; $k < 24; $k++) { 
           				if ($k < 10) {
           					$start_hour = "0"+ $k;
           				}
           				?>
           				<option value="<?php echo $k; ?>" <?php if($myrow[4] == $k){ echo "selected='selected'"; }?> ><?php echo $k; ?></option>
           			<?php 
           		}
           		?>
           		
           	</select>
           	<select name="end_min" id="end_min">
           		<?php 
           			for ($l=0; $l < 60; $l++) { 
           				if ($l < 10) {
           					$start_min = "0"+ $l;
           				}
           				?>
           				<option value="<?php echo $l; ?>" <?php if($myrow[5] == $l){ echo "selected='selected'"; }?> ><?php echo $l; ?></option>
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

          <input type="hidden" name="recnum" id="recnum" value="<?php echo $recnum; ?>">

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
