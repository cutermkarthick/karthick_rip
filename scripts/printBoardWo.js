/*
 * board.js
 * validation for boardwoEntry.php
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam 
 * bmandyam@fluentsoft.com
 */


function check_req_fields()
{
   if (document.forms[0].company.value.length == 0)
   { alert("Customer must be selected");
        return false;
   }
   if (document.forms[0].company.value == 'Please Specify')
   { alert("Customer cannot be Please Specify");
        return false;
   }
   if (document.forms[0].wonum.value.length == 0)
   { alert("Work Order # must be selected");
        return false;
   }
   if (document.forms[0].ponum.value.length == 0)
   { alert("PO # must be selected");
        return false;
   }
   if (document.forms[0].quotenum.value.length == 0)
   { alert("Quote # must be selected");
        return false;
   }
   if (document.forms[0].contact.value.length == 0)
   { alert("Contact must be selected");
        return false;
   }
   if (document.forms[0].contact.value == 'Please Specify')
   { alert("Contact cannot be Please Specify");
        return false;
   }
   if (document.forms[0].owner.value.length == 0)
   { alert("Designer must be selected");
        return false;
   }
   if (document.forms[0].owner.value == 'Please Specify')
   { alert("Designer cannot be Please Specify");
        return false;
   }
        
   return true;
}
function putfocus()
{
   document.forms[0].company.focus();
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
function GetAllEmps(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getboarddes.php?reasontext=" + rt, "Employees", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetEmp(emp,emprecnum) {
document.forms[0].owner.value = emp;
document.forms[0].emprecnum.value = emprecnum;
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
",top="+winTop+",left="+winLeft);
}
function SetCustomer(customer,custrecnum) {
document.forms[0].company.value = customer;
document.forms[0].companyrecnum.value = custrecnum;
}

function GetDesDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "DesDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetDesDate(desdate) {
document.forms[0].des_due.value = desdate;
}

function GetAssyDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var ind = document.forms[0].assyrequired.selectedIndex;
var assyreqd = document.forms[0].assyrequired[ind].text;
if (assyreqd == 'No') 
  { alert("Assembly Required must be yes");
    return false;
  }
win1 = window.open("allcalendar.php", "AssyDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetAssyDate(assydate) {
document.forms[0].assy_due.value = assydate;
}
function GetFabDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "FabDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetFabDate(fabdate) {
document.forms[0].fab_due.value = fabdate;
}

function GetSchDueDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "SchDue", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetSchDueDate(schduedate) {
alert("The sch due date is " + schduedate);
document.forms[0].sch_due_date.value = schduedate;
}
function VerifyPart(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("verifypart.php?partnum=" + "rt", "BoardPart", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);

}
function SetPartNum(partnum) {
document.forms[0].part.value = partnum;
}