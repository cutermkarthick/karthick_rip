<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = June 20, 2004                =
// Filename: errorMessage.php                  =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Displys Error Messages                      =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}

?>

<table border=1  bgcolor="#E2E2E2" cellpadding="6" cellspacing="1" align="center" width="300" Height="100">
 <tr>
    <td bgcolor="E2E2E2" align=center colspan="2"><span class="heading"><b><font color="FF0000" >Error Messages</font></b></tr>
        <tr bgcolor="#F5F6F5"><td colspan=2 align=center>

     <?php

          $val=$_REQUEST['validate'];

          printf("<tr bgcolor=\"#E2E2E2\">
                <td align=center>Error - <span class=\"labletext\">%s <span class=\"tabletext\">
                  : Please report to SysAdmin</td> </tr>", $val);


     ?>
     </td></tr>
