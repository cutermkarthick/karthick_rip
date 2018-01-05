/*
 * contact.js
 * validation for contacts
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
 */


function onSelectStatus()
{

   var aind = document.forms[0].active.selectedIndex;
   document.forms[0].status.value = document.forms[0].active[aind].text;
   document.forms[0].activeval.value = document.forms[0].active[aind].text;

}
function onSelectRole()
{

   var aind = document.forms[0].role.selectedIndex;
   document.forms[0].rolename.value = document.forms[0].role[aind].text;
   document.forms[0].roleval.value = document.forms[0].role[aind].text;

}
function onSelectSal()
{

   var aind = document.forms[0].sal.selectedIndex;
   document.forms[0].salu.value = document.forms[0].sal[aind].text;
   document.forms[0].salval.value = document.forms[0].sal[aind].text;

}
function putfocus()
{
   document.forms[0].contactid.focus();
}

function putfocus1()
{
   document.forms[0].fname.focus();
}

function GetEmployer(rt) {
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
function SetCompany(company,companyrecnum) {
document.forms[0].company.value = company;
document.forms[0].companyrecnum.value = companyrecnum;
}
function check_req_fields()
{
   var sind = document.forms[0].salutation.selectedIndex;
   var aind = document.forms[0].active.selectedIndex;
   var rind = document.forms[0].role.selectedIndex;


   if (document.forms[0].companyrecnum.value == 0) {
        alert('Company name must be selected');
        return false;
   }

   if (document.forms[0].fname.value.length == 0) {
        alert('First Name must be present');
        return false;
   }
   if (document.forms[0].lname.value.length == 0) {
        alert('Last Name name cannot be blanks');
        return false;
   }
   if (document.forms[0].email.value.length == 0) {
        alert('Email cannot be blanks');
        return false;
   }

   document.forms[0].activeval.value = document.forms[0].active[aind].text;
   document.forms[0].roleval.value = document.forms[0].role[rind].text;
   document.forms[0].salval.value = document.forms[0].salutation[sind].text;

}

function GetCompany(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getallcompanies.php?reasontext=" + rt, "Customers", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetCustomer(company,companyrecnum) {
document.forms[0].company.value = company;
document.forms[0].companyrecnum.value = companyrecnum;
}

function searchsort_fields(event)
{
    var ind1 = document.forms[0].scont.selectedIndex;
    var ind2 = document.forms[0].cont_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].scontactfl.value = document.forms[0].scont[ind1].text;
    document.forms[0].contact_oper.value = document.forms[0].cont_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}

function checkenter(event)
{
    var ind1 = document.forms[0].scont.selectedIndex;
    var ind2 = document.forms[0].cont_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].scontactfl.value = document.forms[0].scont[ind1].text;
    document.forms[0].contact_oper.value = document.forms[0].cont_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}

function setsubmit()
{
	document.forms[0].submit.value='New Contact';
}

function ConfirmDelete() {
     document.forms[0].deleteflag.value = "y";
     return true;
}