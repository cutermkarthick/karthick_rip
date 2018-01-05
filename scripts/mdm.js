/*
 * qualityplan.js
 * validation for qualityplan
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
*/

function putfocus()
{
   document.forms[0].company.focus();
}


function ConfirmDelete() {
     document.forms[0].deleteflag.value = "y";
     return true;
}


function check_req_fields()
{
	//alert ('function working');
	//return false;
    var errmsg = '';
    if (document.forms[0].refnum.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please enter ref No. \n';
    }

    if (document.forms[0].partnum.value.length == 0)
    {
         errmsg += 'Please enter partnum\n';
    }

    if (document.forms[0].partname.value.length == 0)
    {
         errmsg += 'Please enter partname\n';
    }
    if (document.forms[0].customer.value.length == 0)
    {
         errmsg += 'Please enter Customer\n';
    }


     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}


function printmdm(mdmrecnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printmdm.php?mdmrecnum=" + mdmrecnum, "printmdm",
+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}

