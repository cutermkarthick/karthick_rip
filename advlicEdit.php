<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Oct 2004                     =
// Filename: advlicEdit.php                    =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 WMS                          =
// Displays Adv lic for update                 =
//==============================================

    session_start();
    header("Cache-control: private");
    if ( !isset ( $_SESSION['user'] ) )
    {
       header ( "Location: login.php" );
    }
    $userid = $_SESSION['user'];
    if ( !isset ( $_SESSION['advlicrecnum'] ) )
    {
     header ( "Location: login.php" );
    }

    $advlicrecnum = $_SESSION['advlicrecnum'];

   //echo 'ADVLICINEDIT='.$advlicrecnum;
   $_SESSION['pagename'] = 'advlicEdit';
    //////session_register('pagename');

// First include the class definition

    include('classes/advlicClass.php');
    include('classes/advlicliClass.php');
    include('classes/displayClass.php');
    $newdisp = new display;
    $newadv = new advlic;
    $newLI = new advlic_line_items;
    
    $advlicrecnum = $_REQUEST['advlicrecnum'];
    $result = $newadv->getadvlicDetails($advlicrecnum);
    $myrow = mysql_fetch_assoc($result);

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/advlic.js"></script>

<html>
<head>
<title>Adv License Update</title>
</head>
<body leftmargin="0"topmargin="0" margin width="0">
<form action='processAdvlic.php' method='post' enctype='multipart/form-data'>

<?php
    include('header.html');
?>
<table width=100% cellspacing="0" cellpadding="6" border="0">
<tr>
<td>
<table width=100% border=0 cellspacing="0" cellpadding="0">
<tr>
<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
<td align="right">&nbsp;
<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
</tr>
</table>
<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td></td></tr>
<tr>
<td>
<?php
	$newdisp->dispLinks('');
?>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/spacer.gif " width="6"></td>
<td bgcolor="#FFFFFF">
<table width=100% border=0 cellpadding=6 cellspacing=0>
<tr><td>
<table width=100% border=0>
<tr>
<td colspan=2><span class="pageheading"><b>Adv License Update</b></td>
<td colspan=20>&nbsp;</td>
</tr>
</table>
</td></tr>
<tr>
<td>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#EEEFEE"><td colspan=4><span class="heading"><center><b>General Information</b></center></td>
</tr>  </table>
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >

<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF" >
<tr bgcolor="#FFFFFF" >
<td width=15%><span class="labeltext"><p align="left">Adv License #</p></font></td>
 <td width=20%><span class="tabletext"><input type="text"  name="adv_lic_no" value="<?php echo $myrow["adv_license"] ?>" style="background-color:#DDDDDD;" readonly="readonly" ></td>
<td width=20%><span class="labeltext"><p align="left">Adv license Date</p></font></td>
<td width=40% ><input type="text" name="licdate" style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["lic_date"] ?>">
	<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetlicDate('licdate')"></td>
</tr>
<tr bgcolor="#FFFFFF" >
<td width=15%><span class="labeltext"><p align="left">From</p></font></td>
 <td width=20%><span class="tabletext"><input type="text"  name="from_date" value="<?php echo $myrow["from_date"] ?>" style="background-color:#DDDDDD;" readonly="readonly">
 <img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetlicDate('from_date')"></td>
<td width=20%><span class="labeltext"><p align="left">To</p></font></td>
<td width=40% ><input type="text" name="to_date" style="background-color:#DDDDDD;" readonly="readonly" size=10% value="<?php echo $myrow["to_date"] ?>">
	<img src="images/bu-getdate.gif" alt="Get Date"  onclick="GetlicDate('to_date')"></td>
</tr>
<br>
</table>
<tr bgcolor="#FFFFFF"><td colspan=5><a href="javascript:addRow('myTable',document.forms[0].index.value)"><img name="Image7" border="0" src="images/bu-addrow.gif"></a></td></tr>
<table id="myTable" width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<td colspan=11><span class="heading"><center><b>Line Items</b></center></td>
<tr bgcolor="#FFFFFF">
<td colspan=15 bgcolor="#FFFFFF"><span class="tabletext">To delete line items - blankout line number</td></tr>
<tr>
<td bgcolor="#EEEFEE" width=3%><span class="heading"><b>Line</b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b>Partnum</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>Partname</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>R.M Spec</b></td>
<td bgcolor="#EEEFEE" width=8%><span class="heading"><b>PRN</b></td>
<td bgcolor="#EEEFEE" width=6%><span class="heading"><b>R.M Size</b></td>
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Qty to Make</b></td>
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Qty to Import</b></td>
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>BE No</b></td>
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Assessment Value</b></td>
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>CIF Value</b></td>
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Rate</b></td>
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Tariff</b></td>
<td bgcolor="#EEEFEE" width=4%><span class="heading"><b>Wastage</b></td>

<?php
  		$result = $newLI->getLI($advlicrecnum);
		$i=1;$flag=0;
		while($i<=5)
		{
			if($flag==0)
			{
				while ($myLI = mysql_fetch_row($result))
	  	 		{
					//echo "i am inside inner while loop";
					printf('<tr bgcolor="#FFFFFF">');
					$linenumber="line_num" . $i;
					//$itemnum="itemnum" . $i;
					$partnum="partnum" . $i;
					$partname="partname" . $i;
					$rm_spec="rm_spec" . $i;
					$rm_size="rm_size" . $i;
					$crn="crn" . $i;
					$qtytomake="qtytomake" . $i;
					$qtyimported="qtyimported" . $i;
                    $be_no="be_no" . $i;
                    $assesmnt_value="assesmnt_value" . $i;
                    $cif_value="cif_value" . $i;
                    $rate="rate" . $i;
					$tariff="tariff" . $i;
					$wastage="wastage" . $i;
					$prevlinenum="prev_line_num" . $i;
					$lirecnum="lirecnum" . $i;


                    echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"$myLI[0]\">";
					echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"$myLI[11]\">";
					
					echo "<td ><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\"  name=\"$linenumber\"  value=\"$myLI[0]\" size=\"2%\"></td>";
				   // echo "<td><input type=\"text\" id=\"$itemnum\" name=\"$itemnum\" size=\"10%\" value=\"$myLI[1]\"></td>";
   		            echo "<td><input type=\"text\" id=\"$partnum\" name=\"$partnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"18%\" value=\"$myLI[1]\"></td>";
					echo "<td><input type=\"text\" id=\"$partname\" name=\"$partname\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"18%\" value=\"$myLI[2]\"></td>";
					echo "<td><input type=\"text\" id=\"$rm_spec\" name=\"$rm_spec\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"16%\" value=\"$myLI[3]\"></td>";
					echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"10%\" value=\"$myLI[5]\"><img src=\"images/getcim.gif\" alt=\"Get CIM\"  onclick=\"GetCIM( '$i')\"></td>";
                    echo "<td><input type=\"text\" id=\"$rm_size\" name=\"$rm_size\"  size=\"10%\" value=\"$myLI[4]\"></td>";
					echo "<td><input type=\"text\" id=\"$qtytomake\" name=\"$qtytomake\" size=\"5%\" value=\"$myLI[6]\"></td>";
                    echo "<td><input type=\"text\" id=\"$qtyimported\" name=\"$qtyimported\" size=\"5%\" value=\"$myLI[7]\"></td>";
                    echo "<td><input type=\"text\" id=\"$be_no\" name=\"$be_no\" size=\"5%\"  value=\"$myLI[13]\"></td>";
                    echo "<td><input type=\"text\" id=\"$assesmnt_value\" name=\"$assesmnt_value\" size=\"5%\"  value=\"$myLI[14]\"></td>";
                    echo "<td><input type=\"text\" id=\"$cif_value\" name=\"$cif_value\" size=\"5%\" value=\"$myLI[15]\"></td>";
                    echo "<td><input type=\"text\" id=\"$rate\" name=\"$rate\" size=\"5%\" value=\"$myLI[16]\"></td>";
					echo "<td><input type=\"text\" id=\"$tariff\" name=\"$tariff\" size=\"5%\" value=\"$myLI[10]\"></td>";
					echo "<td><input type=\"text\" id=\"$wastage\" name=\"$wastage\" size=\"5%\" value=\"$myLI[12]\"></td>";

					printf('</tr>');
					$i++;
				}
				$flag=1;
			}

			//echo "i am in outside while loop";
			printf('<tr bgcolor="#FFFFFF">');
                    $linenumber="line_num" . $i;
				//	$itemnum="itemnum" . $i;
					$partnum="partnum" . $i;
					$partname="partname" . $i;
					$rm_spec="rm_spec" . $i;
					$rm_size="rm_size" . $i;
					$crn="crn" . $i;
					$qtytomake="qtytomake" . $i;
					$qtyimported="qtyimported" . $i;
                    $be_no="be_no" . $i;
                    $assesmnt_value="assesmnt_value" . $i;
                    $cif_value="cif_value" . $i;
                    $rate="rate" . $i;
					$tariff="tariff" . $i;
					$wastage="wastage" . $i;
					$prevlinenum="prev_line_num" . $i;
					$lirecnum="lirecnum" . $i;

            echo "<input type=\"hidden\" name=\"$prevlinenum\" value=\"\">";
			echo "<input type=\"hidden\" name=\"$lirecnum\" value=\"\">";
			
			
		    echo "<td ><span class=\"tabletext\"><input type=\"text\" id=\"$linenumber\" name=\"$linenumber\"  value=\"\" size=\"2%\"></td>";
	        //echo "<td><input type=\"text\" id=\"$itemnum\" name=\"$itemnum\" size=\"10%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$partnum\" name=\"$partnum\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"18%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$partname\" name=\"$partname\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"18%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$rm_spec\" name=\"$rm_spec\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\" size=\"16%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$crn\" name=\"$crn\" style=\"background-color:#DDDDDD;\" readonly=\"readonly\"  size=\"10%\" value=\"\"><img src=\"images/getcim.gif\" alt=\"Get CIM\"  onclick=\"GetCIM('$i')\"></td>";


            echo "<td><input type=\"text\" id=\"$rm_size\" name=\"$rm_size\"  size=\"10%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$qtytomake\" name=\"$qtytomake\" size=\"5%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$qtyimported\" name=\"$qtyimported\" size=\"5%\"  value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$be_no\" name=\"$be_no\" size=\"5%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$assesmnt_value\" name=\"$assesmnt_value\" size=\"5%\"  value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$cif_value\" name=\"$cif_value\" size=\"5%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$rate\" name=\"$rate\" size=\"5%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$tariff\" name=\"$tariff\" size=\"5%\" value=\"\"></td>";
            echo "<td><input type=\"text\" id=\"$wastage\" name=\"$wastage\" size=\"5%\" value=\"\"></td>";
            printf('</tr>');
			$i++;
          }

          echo "<input type=\"hidden\" name=\"index\" value=$i>";
?>
</td></tr>
</table>
</td>
<td width="6"><img src="images/spacer.gif " width="6"></td>
</tr>
<tr bgcolor="DEDFDE">
<td width="6"><img src="images/box-left-bottom.gif"></td>
<td><img src="images/spacer.gif " height="6"></td>
<td width="6"><img src="images/box-right-bottom.gif"></td>
</tr>
</table>
<table border = 0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align=left>
</td>
</tr>
</table>
<span class="tabletext">
   <input type="submit"
   style="color=#0066CC;background-color:#DDDDDD;width=130;"
   value="Submit" name="submit" onclick="javascript: return check_req_fields1()">
   <INPUT TYPE="RESET"
   style="color=#0066CC;background-color:#DDDDDD;width=130;"
   VALUE="Reset" onclick="javascript: putfocus()">
</FORM>
</body>
</html>
