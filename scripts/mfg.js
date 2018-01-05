/*
 * mfg.js
 * validation for MFG_order
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
 */

function check_req_fields()
{
    var errmsg = '';
    if (document.forms[0].mfg_id.value.length == 0)
    {
         errmsg += 'Please enter MFG  #\n';
    }

    if (document.forms[0].orderdate.value.length == 0)
    {
         errmsg += 'Please enter MFG Date\n';
    }
    if (document.forms[0].company.value.length == 0)
    {
         errmsg += 'Please enter Company Name\n';
    }
    if (document.forms[0].contact.value.length == 0)
    {
         errmsg += 'Please enter Contact Name\n';
    }
     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}

function checkenter(event)
{

  /*  var ind = document.forms[0].comp_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    var s2ind = document.forms[0].sort2.selectedIndex;
    document.forms[0].company_oper.value = document.forms[0].comp_oper[ind].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;
    document.forms[0].sortfld2.value = document.forms[0].sort2[s2ind].text;*/

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


function printMfg(rt) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printMfg.php?recnum=" + rt, "PrintBWOreport", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function GetAllCustomers(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getcustomers.php?reasontext=" + rt, "Customers", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft+",dependent=yes");
}

function SetCustomer(customer,custrecnum) {
document.forms[0].company.value = customer;
document.forms[0].companyrecnum.value = custrecnum;
}

function GetContact(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var customerrecnum = document.forms[0].companyrecnum.value;
var customer = document.forms[0].company.value;
if (document.forms[0].company.value == '')
{ alert("Please select a customer before selecting a contact");
  return false;
}
win1 = window.open("contact.php?reasontext=" + customerrecnum + "&customer=" + customer,"Contact", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetContact(contact,contarr) {
document.forms[0].contact.value = contact;
var contdet = contarr.split("|");
document.forms[0].contactrecnum.value = contdet[0];
document.forms[0].phone.value = contdet[1];
document.forms[0].email.value = contdet[2];
}

function ConfirmDelete() {
     document.forms[0].deleteflag.value = "y";
     return true;
}