<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = Dec 1,2006                   =
// Filename: viewWherePartUsed.php             =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$userrole = $_SESSION['userrole'];
$partrecnum="'" . $_REQUEST['partrecnum'] . "'";
$partnum="'" . $_REQUEST['partnum'] . "'";

// First include the class definition
include('classes/vendPartClass.php');
include('classes/displayClass.php');
$newVend = new vendPart;
$newdisplay = new display;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/bom.js"></script>

<html>
<head>
<title>View Where Parts Used</title>
</head>

<table width=350 border=0>

<?php
    echo "<tr><td><font style=\"Arial\" size=2><center><b>Part#=" . $partnum . "  used in</b></center></td</tr>";
?>

</table>
<table width=400 border=1 rules=none>
    <tr  bgcolor="#FFCC00">
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>BOM#</b></td>
            <td  bgcolor="#EEEFEE"><span class="tabletext"><b>BOM Desc</b></td>
<?php
            $result = $newVend ->whereusedparts($partrecnum);
            while ($myrow=mysql_fetch_row($result)) {
              printf('<tr bgcolor="#FFFFFF"><td><span class="tabletext">%s</td>
                     <td><span class="tabletext">%s</td>', $myrow[0], $myrow[1] );
              printf('</td></tr>');
            }
?>

</table>
</table>
</body>
</html>