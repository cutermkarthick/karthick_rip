/*
 * nc4stores.js
 * validation for qualityplan
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
*/

function GetDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getcalendar.php",param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetDate(dateval,fieldname) {

document.forms[0].elements[fieldname].value = dateval;
}

function check_req_fields()
{
    var errmsg = '';
    if (document.forms[0].refnum.value.length == 0)
    {
        errmsg += 'Please enter Ref No. \n';
    }

    if (document.forms[0].cdate.value.length == 0)
    {
         errmsg += 'Please enter Date.\n';
    }
    if (document.forms[0].supplier.value.length == 0)
    {
         errmsg += 'Please enter Supplier Name\n';
    }

    if (document.forms[0].rm_po_num.value.length == 0)
    {
         errmsg += 'Please enter RM PO No.\n';
    }

    if (document.forms[0].receipt_date.value.length == 0)
    {
         errmsg += 'Please enter Receipt Date.\n';
    }

     if (document.getElementById('dim1').checked == false && document.getElementById('dim2').checked == false)
    {
         errmsg += 'Please Select Yes/No for Dimensional Deviation.\n';
    }
	 if (document.getElementById('raw1').checked == false && document.getElementById('raw2').checked == false)
    {
         errmsg += 'Please Select Yes/No for Raw Material Docs.\n';
    }
	 if (document.getElementById('mat1').checked == false && document.getElementById('mat2').checked == false)
    {
         errmsg += 'Please Select Yes/No for Material Spec.Deviation\n';
    }
	 if (document.getElementById('spec1').checked == false && document.getElementById('spec2').checked == false)
    {
         errmsg += 'Please Select Yes/No for Specific Marking\n';
    }
	 if (document.getElementById('desc1').checked == false && document.getElementById('desc2').checked == false)
    {
         errmsg += 'Please Select Yes/No for Descrepancy in Quantity\n';
    }


     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}


function printnc4stores(nc4storesrecnum) {
var winWidth = 1000;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printnc4stores.php?recnum=" + nc4storesrecnum, "printnc4stores",
+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}