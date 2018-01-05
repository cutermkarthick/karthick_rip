<?php 

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
  header ( "Location: login.php" );
}

$userid = $_SESSION['user'];

include('classes/empClass.php');
$newEmp = new emp;

$result = $newEmp->getEmployee4Payroll();

?>



<html>
	<head>
	  <title>All Employees</title>
	  <link rel="stylesheet" href="style.css">
	</head>

	<body>
		<form action='getEmployee.php' method='post' enctype='multipart/form-data'>

			<table width=100% border=0 cellpadding=4 cellspacing=1 bgcolor="#DFDEDF" >
				<tr><td><span class="pageheading"><b>Employees Lists</b></span></td></tr>
			</table>

			<table style="table-layout: fixed" width=970px border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

				<tr  bgcolor="#FFCC00">
        	<td width=5% bgcolor="#EEEFEE"><span class="heading"><b>Select</b></span></td>
        	<td width=5% bgcolor="#EEEFEE"><span class="heading"><b>Empid</b></span></td>
        	<td width=5% bgcolor="#EEEFEE"><span class="heading"><b>First Name</b></span></td>
        	<td width=5% bgcolor="#EEEFEE"><span class="heading"><b>Last Name</b></span></td>
        	<td width=5% bgcolor="#EEEFEE"><span class="heading"><b>Status</b></span></td>
        </tr>
        <?php
        while ($myrow = mysql_fetch_row($result)) 
	  		{
	  			$recnum = $myrow[0];
	  			$empid = htmlspecialchars($myrow[1]);
	  			$fname = htmlspecialchars($myrow[2]);
	  			$lname = htmlspecialchars($myrow[3]);
	  			$status = htmlspecialchars($myrow[4]);
	  		?>
	  			<tr bgcolor="#FFFFFF">
	  				<td bgcolor="#FFFFFF" width=5%><input type="radio" name="emp"   value="<?php echo $myrow[0]."|".$myrow[1]."|".$myrow[2]."|".$myrow[3]."|".$myrow[4] ?>" />
	  				</td>
	  				<td width=8% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $empid ?></td>
	  				<td width=8% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $fname ?></td>
	  				<td width=8% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $lname ?></td>
	  				<td width=8% bgcolor="#FFFFFF"><span class="tabletext"><?php echo $status ?></td>


	  		<?php
	  		}
	  		?>
			</table>

		<script language=javascript>
			function SubmitEmp(etype)
			{

			 	var flag=0;
			 	var user_input;
				if(document.forms[0].emp.length)
				{
				 	for (i=0;i<document.forms[0].emp.length;i++) {
						if (document.forms[0].emp[i].checked) {
							user_input = document.forms[0].emp[i].value;
							flag=1;
						}
					}
				}

				else if(document.forms[0].emp.checked)
				{
				  user_input = document.forms[0].emp.value;
				  flag = 1;
				}
				
				if(flag == 0)
				{
				  alert('Please select appropriate Employee before submitting');
				  self.close();
				}
			
				window.opener.SetEmployee(user_input,etype);
				self.close();
			}
		</script>

		<input type=button value="Submit" onclick=" javascript: return SubmitEmp(window.name)">

		</form>
	</body>