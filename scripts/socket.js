/*
 * socket.js
 * validation for socket
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
if (document.forms[0].company.value == 'Please Specify')
 { alert("Customer cannot be Please Specify");
        return false;
 }

   if (document.forms[0].owner.value.length == 0)
   { alert("Designer must be entered");
        return false;
   }
   if (document.forms[0].owner.value == 'Please Specify')
   { alert("Designer cannot be Please Specify");
        return false;
   }
        
   return true;
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
win1 = window.open("getsocketdes.php?reasontext=" + rt, "Employees", +
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

function GetFPDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "FpDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetFpDate(fpdate) {
document.forms[0].fp_due.value = fpdate;
}

function GetMfgDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "MfgDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetMfgDate(mfgdate) {
document.forms[0].mfg_due.value = mfgdate;
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
document.forms[0].sch_due_date.value = schduedate;
}

function VerifySocketPart(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("verifypart.php", "SocketPN", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);

}
function VerifyLidPart(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("verifypart.php", "LidPN", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);

}
function VerifyOtherPN1(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("verifypart.php", "OtherPN1", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);

}
function VerifyOtherPN2(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("verifypart.php", "OtherPN2", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);

}
function VerifyOtherPN3(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("verifypart.php", "OtherPN3", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);

}
function VerifyContactPart(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("verifypart.php", "ContactPN", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);

}
function SetSocketPartNum(partnum) {
document.forms[0].socket_pn.value = partnum;
}
function SetLidPartNum(partnum) {
document.forms[0].lid_pn.value = partnum;
}
function SetOtherPN1PartNum(partnum) {
document.forms[0].other_pn1.value = partnum;
}
function SetOtherPN2PartNum(partnum) {
document.forms[0].other_pn2.value = partnum;
}
function SetOtherPN3PartNum(partnum) {
document.forms[0].other_pn3.value = partnum;
}
function SetContactPNPartNum(partnum) {
document.forms[0].contact_pn.value = partnum;
}
function printSWO(typenum,worecnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printSocketWO.php?typenum=" + typenum + "&worecnum=" + worecnum, "PrintSWO", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function GetFPComp(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "FpComp", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetFpComp(fpdate) {
document.forms[0].fp_comp.value = fpdate;
}
function GetMfgComp(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "MfgComp", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetMfgComp(mfgdate) {
document.forms[0].mfg_comp.value = mfgdate;
}
function GetCustSignoff(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "CustSignoff", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetCustSignoff(custsignoff) {
document.forms[0].cust_signoff.value = custsignoff;
}
function GetCustSignoffBy(rt) {
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

win1 = window.open("contact.php?reasontext=" + customerrecnum + "&customer=" + customer,"CustSignoffBy", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetCustSignoffBy(contact,contarr) {
document.forms[0].cust_signoff_by.value = contact;
}
function GetFPSignoffEmp(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getallemps.php?reasontext=" + rt, "FPSignoff", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetFPSignoffEmp(emp,emprecnum) {
document.forms[0].fp_signoff_by.value = emp;
}
function GetMfgSignoffEmp(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getallemps.php?reasontext=" + rt, "MfgSignoff", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetMfgSignoffEmp(emp,emprecnum) {
document.forms[0].mfg_signoff_by.value = emp;
}

function GetActShipDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "ActShipDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetActShipDate(actshipdate) {
document.forms[0].act_ship_date.value = actshipdate;
}
function GetDesDueDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "DesDueDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetDesDueDate(desduedate) {
document.forms[0].des_due.value = desduedate;
}
function GetDesCompDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "DesCompDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetDesCompDate(descompdate) {
document.forms[0].des_comp.value = descompdate;
}
function GetSchMfgStartDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "SchMfgStartDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetSchMfgStartDate(schmfgstartdate) {
document.forms[0].sch_mfg_start.value = schmfgstartdate;
}
function GetActMfgStartDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "ActMfgStartDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetActMfgStartDate(actmfgstartdate) {
document.forms[0].act_mfg_start.value = actmfgstartdate;
}
function CancelWO()
{
     document.forms[0].deleteflag.value = "y";
}
function GetOwner(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getowner.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetOwner(emp,emprecnum,fieldname) {

document.forms[0].elements[fieldname].value = emp;
document.forms[0].elements[fieldname + "recnum"].value = emprecnum;
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

function GetC(rt) {
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
win1 = window.open("getc.php?reasontext=" + customerrecnum + "&customer=" + customer,param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetC(contact,contarr,fieldname) {
var contdet = contarr.split("|");
document.forms[0].contact.value = contact;
document.forms[0].elements[fieldname].value = contact;
document.forms[0].elements[fieldname + "recnum"].value = contdet[0];
}

function SetDate(dateval,fieldname) {
document.forms[0].elements[fieldname].value = dateval;

}