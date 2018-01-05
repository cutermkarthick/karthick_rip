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


function searchsort_fields()
{
    var ind1 = document.forms[0].salesorder.selectedIndex;
    var ind2 = document.forms[0].salesorder_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].salesorderfl.value = document.forms[0].salesorder[ind1].text;
    document.forms[0].salesorder_oper.value = document.forms[0].salesorder_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}

function checkenter(event)
{
    var ind1 = document.forms[0].salesorder.selectedIndex;
    var ind2 = document.forms[0].salesorder_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].salesorderfl.value = document.forms[0].salesorder[ind1].text;
    document.forms[0].salesorder_oper.value = document.forms[0].salesorder_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}

function check_req_fields()
{
	//alert ('function working');
	//return false;
    var errmsg = '';
    if (document.forms[0].company.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please select customer name \n';
    }

    if (document.forms[0].invnum.value.length == 0)
    {
         errmsg += 'Please enter invoice number\n';
    }
    if (document.forms[0].invdate.value.length == 0)
    {
         errmsg += 'Please enter invoice date\n';
    }

    if (document.forms[0].duedate.value.length == 0)
    {
         errmsg += 'Please enter due date\n';
    }
    if (document.forms[0].customerponum.value.length == 0)
    {
         errmsg += 'Please customer PO# \n';
    }

     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}


function printfeedbackDetails(feedbackrecnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printfeedbackDetails.php?feedbackrecnum=" + feedbackrecnum, "PrintFeedback",

+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}
function onSelectprocess()
{

   var aind = document.forms[0].process1.selectedIndex;
   document.forms[0].process.value = document.forms[0].process1[aind].text;

}
function onSelectprogram()
{

   var aind = document.forms[0].program1.selectedIndex;
   document.forms[0].program.value = document.forms[0].program1[aind].text;

}
function onSelectfixture()
{

   var aind = document.forms[0].fixture1.selectedIndex;
   document.forms[0].fixture.value = document.forms[0].fixture1[aind].text;

}
function onSelecttools()
{

   var aind = document.forms[0].tools1.selectedIndex;
   document.forms[0].tools.value = document.forms[0].tools1[aind].text;

}