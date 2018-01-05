/*
 * crn.js
 * validation for CRN mc master 
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
*/
function Getcrns(rt) {
 var param = rt;
 var winWidth = 300;
 var winHeight = 300;
 var winLeft = (screen.width-winWidth)/2;
 var winTop = (screen.height-winHeight)/2;
 win1 = window.open("getcrns.php?reasontext=" + rt, "Customers", +
 "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
 ",width=" + winWidth + ",height=" + winHeight +
 ",top="+winTop+",left="+winLeft+",dependent=yes");
}

function Setcrn(crn,crnrecnum) {
 document.forms[0].crn_num.value = crn;
 //document.forms[0].crnrecnum.value = crnrecnum;
}

function check_req_fields()
{
    var errmsg = '';
    //alert('function working');
    if (document.forms[0].crn_num.value.length == 0)
    {
         errmsg += 'Please enter PRN No.\n';
    }
    if (document.forms[0].qty.value.length == 0)
    {
         errmsg += 'Please enter Qty\n';
    }
    /*if (document.forms[0].setup_time_hrs.value.length == 0 && document.forms[0].setup_time_mins.value.length == 0)
    {
         errmsg += 'Please enter Setup time.\n';
    }*/
    if (document.forms[0].fitting_time_hrs.value.length == 0 && document.forms[0].fitting_time_mins.value.length == 0)
    {
         errmsg += 'Please enter Bench time.\n';
    }
    if (document.forms[0].insp_time_hrs.value.length == 0 && document.forms[0].insp_time_mins.value.length == 0)
    {
         errmsg += 'Please enter Inspection time.\n';
    }
    if (document.forms[0].valperpart.value.length == 0)
    {
         errmsg += 'Please enter Val/pc\n';
    }
    //alert('before return');

    if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}


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
    //alert(dateval+"---***---"+fieldname);
document.forms[0].elements[fieldname].value = dateval;

}
