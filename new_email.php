<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = September 18, 2006           =
// Filename: email.php                         =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Displays list of Leads.                     =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'newemail';
$page = "Utillities: Email";
//session_register('pagename');
//Following code added to implement search,sort  and Pagination on Dec 29-04 by Jerry George


// First include the class definition
include_once('classes/userClass.php');
include_once('classes/emailClass.php');
include_once('classes/displayClass.php');
$newemail = new email;
$newdisplay = new display;
?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/leads.js"></script>
<html>
<head>
<title>Email</title>
</head>
<?php
include('header.html');
?>
<form action='processemail.php' method='post' >
<!-- <table width=100% cellspacing="0" cellpadding="6" border="0">
	<tr>
		<td>

			<table width=100% border=0 cellspacing="0" cellpadding="0">
   				<tr>
        		<td colspan=2><span class="welcome"><b>Welcome <?php echo $userid?></b></td>
        		<td align="right">&nbsp;
       			<a href="exit.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image16','','images/logout_mo.gif',1)"><img name="Image16" border="0" src="images/logout.gif"></a></td>
        		</tr>
			</table>
			<table width=100% border=0 cellpadding=0 cellspacing=0  >
    <tr><td></td></tr>
				<tr>
					<td>
<?php $newdisplay->dispLinks(''); ?>
</td></tr>
<table width=100% border=0 cellpadding=0 cellspacing=0  >
  <tr bgcolor="DEDFDE"><td width="6"><img src="images/spacer.gif " width="6"></td>
 -->	    <td bgcolor="#FFFFFF">
      <table width=100% border=0 cellpadding=6 cellspacing=0 class="stdtable1"  >
<tr>
<td>

    <table width=100% border=0 cellpadding=3 cellspacing=1  >
     <tr>
        <td><span class="pageheading"><b>   Compose Email:  </b></td>
     </tr>
    <td> <HR align="left" width=100% size=2 >
    </table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabForm">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
                   <tr>
				</tr>
				<tr>
				<tr valign="top">
					<td class="labeltext"><slot>To: </slot></td>
					<td colspan="4" class="dataField" NOWRAP="NOWRAP"><slot>
						<table cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>
									<textarea id="to_addrs_field" name='to_addrs' tabindex='3' cols="80" rows="1" style="height: 1.6.em; overflow-y:auto; font-family:sans-serif,monospace; font-size:inherit;" value=""></textarea>
									<input type="hidden" id="to_addrs_ids" name="to_addrs_ids" value="" />
									<input type="hidden" id="to_addrs_emails" name="to_addrs_emails" value="" />
									<input type="hidden" id="to_addrs_names" name="to_addrs_names" value="" />
								</td>
								<td style="padding-left: 4px;">
							</tr>
						</table>
					</slot></td>
				</tr>
				<tr>
					<td class="labeltext"><slot>Cc:</slot></td>
					<td class="dataField" colspan="4" NOWRAP="NOWRAP"><slot>
						<table cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>
									<textarea id="cc_addrs_field" name='cc_addrs' tabindex='3' cols="80" rows="1" style="height: 1.6.em; overflow-y:auto; font-family:sans-serif,monospace; font-size:inherit;" value=""></textarea>
									<input type="hidden" id="cc_addrs_ids" name="cc_addrs_ids" value="" />
									<input type="hidden" id="cc_addrs_emails" name="cc_addrs_emails" value="" />
									<input type="hidden" id="cc_addrs_names" name="cc_addrs_names" value="" />
								</td>
                             <td style="padding-left: 4px;">
                            </td>
							</tr>
						</table>
					</slot></td>
				</tr>

				<tr valign="top">
					<td class="labeltext"><slot>Bcc:</slot></td>
					<td class="dataField" colspan="4" NOWRAP="NOWRAP"><slot>
						<table cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>
									<textarea id="bcc_addrs_field" name='bcc_addrs' tabindex='3' cols="80" rows="1" style="height: 1.6.em; overflow-y:auto; font-family:sans-serif,monospace; font-size:inherit;" value=""></textarea>
									<input type="hidden" id="bcc_addrs_ids" name="bcc_addrs_ids" value="" />
									<input type="hidden" id="bcc_addrs_emails" name="bcc_addrs_emails" value="" />
									<input type="hidden" id="bcc_addrs_names" name="bcc_addrs_names" value="" />
								</td>
								<td style="padding-left: 4px;">
							</tr>
						</table>
					</td>
				</tr>
				<tr valign="top">
					<td class="labeltext"><slot>
						From:
					</slot></td>
					<td class="dataField" colspan="4" NOWRAP="NOWRAP"><slot>
						<table cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td>
								<textarea id="from_addr_field" name='from_addr' tabindex='3' cols="80" rows="1" style="height: 1.6.em; overflow-y:auto; font-family:sans-serif,monospace; font-size:inherit;" value=" "></textarea>

								<input type="hidden" id="from_addr_email" name="from_addr_email" />
								<input type="hidden" id="from_addr_name" name="from_addr_name" />
								</td>
							</tr>
						</table>
					</slot></td>
				</tr>
				<tr>
					<td colspan=5>&nbsp;</td>
				</tr>
				<tr>
					<td class="labeltext"><slot>Subject:</slot></td>
					<td colspan=4><slot>
						<textarea name="subject" tabindex='4' cols="80" rows="1" style="height: 1.6.em; overflow-y:auto; font-family:sans-serif,monospace; font-size:inherit;" id="subjectfield" value=""></textarea>
					</slot></td>
				</tr>
				<tr>

        <tr valign="top">
            <td><span class="labeltext">Body</font></td>
             <td colspan=10><textarea name="body" rows="15" cols="60" value=""></textarea></td>
             </tr>
				</tr>
				<tr>
				</tr>
			</table>
		</td>
	</tr>
</table>
      <input type="hidden" name="deleteflag" value="">




      </table>
        <!--  <td width="6"><img src="images/spacer.gif " width="6"></td>
			</tr>
                <tr bgcolor="DEDFDE">
  				<td width="6"><img src="images/box-left-bottom.gif"></td>
				<td><img src="images/spacer.gif " height="6"></td>
				<td width="6"><img src="images/box-right-bottom.gif"></td>
			</tr>
         --></table>
<table border = 0 cellpadding=0 cellspacing=0 width=100% >
<tr>
</td>
</tr></table>
                    <span class="tabletext"><input type="submit"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     value="Send" name="submit" onclick="javascript: return check_req_fields()">
                    <INPUT TYPE="RESET"
                     style="color=#0066CC;background-color:#DDDDDD;width=130;"
                     VALUE="Reset" onclick="javascript: putfocus()">
</FORM>
</body>
</html >