/*
 * qualityplan.js
 * validation for qualityplan
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
*/

function comp_values()
{
 var diff='';

 var val1=document.forms[0].qty_assigned.value;
 var val2=document.forms[0].qty_produced.value;
 diff=val1-val2;
 if(diff<0)
 {
  alert('qty produced is greater than assigned');
  document.forms[0].qty_produced.value = '';
  document.forms[0].qty_produced.focus();
 }
 return;

}

function comp_values1()
{
 var diff='';
 var val1=document.forms[0].qty_produced.value;
 var val2=document.forms[0].rejection.value;
 diff=val1-val2;
 if(diff<0)
 {
  alert('qty produced is greater than assigned');
  document.forms[0].rejection.value = '';
 }
 return;

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

function check_req_fields()
{
	//alert ('function working');
	//return false;
    var errmsg = '';
    if (document.forms[0].date.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please enter date \n';
    }

    if (document.forms[0].shift.value.length == 0)
    {
         errmsg += 'Please enter Shift\n';
    }
    if (document.forms[0].time_per_piece.value.length == 0)
    {
         errmsg += 'Please enter assigned time per piece\n';
    }

    if (document.forms[0].qty_assigned.value.length == 0)
    {
         errmsg += 'Please enter assigned qty\n';
    }

     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}

