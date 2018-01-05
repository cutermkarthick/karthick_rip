/*
 * user.js
 * validation for users
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
function DeleteUser()
{
     document.forms[0].deleteflag.value = "y";
}
function check_req_fields()
{
   var ind = document.forms[0].type.selectedIndex;
   var aind = document.forms[0].active.selectedIndex;

   if (document.forms[0].loginid.value.length == 0) {
        alert('Userid must be enetered');
        return false;
   }
   if (document.forms[0].password.value.length == 0) {
        alert('Password must be present');
        return false;
   }
   if (document.forms[0].initials.value.length == 0) {
        alert('Initials name cannot be blanks');
        return false;
   }

   if (ind == 0 && document.forms[0].employee.value == '')
   { alert("Employee must be selected if type is EMPL");
         return false;
   }
   if ((ind == 1 || ind == 2|| ind == 3|| ind == 4) && document.forms[0].company.value == '')
   { alert("Company must be selected if type is CUST , VEND,SALES PERSON,SALES MANAJOR");
         return false;
   }
   if ((ind == 1 || ind == 2|| ind == 3|| ind == 4) && document.forms[0].contact.value == '')
   { alert("Contact must be selected if type is CUST , VEND,SALES PERSON,SALES MANAJOR");
         return false;
   }
   document.forms[0].activeval.value = document.forms[0].active[aind].text;
   document.forms[0].typeval.value = document.forms[0].type[ind].text;
   document.forms[0].password.value = calcMD5(document.forms[0].password.value);
   return true;
}
function check_req_fields4upd()
{
   var aind = document.forms[0].active.selectedIndex;
   if (document.forms[0].password.value.length == 0) {
        alert('Password must be present');
        return false;
   }
   if (document.forms[0].initials.value.length == 0) {
        alert('Initials name cannot be blanks');
        return false;
   }

   document.forms[0].activeval.value = document.forms[0].active[aind].text;
   return true;
}
function putfocus()
{
   document.forms[0].loginid.value = '';
   document.forms[0].loginid.focus();
}
function GetAllCustomers(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var ind = document.forms[0].type.selectedIndex;
if (ind != 1 && ind != 2 && ind != 5 && ind != 6)
{ alert("Type must be CUST/VEND/CF/FF");
  return false;
}
if (document.forms[0].employee.value != '')
{ alert("Employee should be blanks");
  return false;
}
win1 = window.open("getallcompanies.php?reasontext=" + rt, "Customers", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
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
var customer = document.forms[0].company.value;
var companyrecnum = document.forms[0].companyrecnum.value;
var ind = document.forms[0].type.selectedIndex;
if (ind != 1 && ind != 2 && ind != 5 && ind != 6)
{ alert("Type must be CUST or VEND");
  return false;
}
if (document.forms[0].company.value == '')
{ alert("Please select a customer before selecting a contact");
  return false;
}

win1 = window.open("contact.php?reasontext=" + companyrecnum + "&customer=" + customer,"NewUser", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetNewUserContact(contact,contarr) {
document.forms[0].contact.value = contact;
var contdet = contarr.split("|");
document.forms[0].contactrecnum.value = contdet[0];
}

function GetAllEmps(rt) {
var param = 'user';
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var ind = document.forms[0].type.selectedIndex;
if (ind != 0)
{ alert("Type must be EMPL");
  return false;
}
if (document.forms[0].company.value != '')
{ alert("Customer should be blanks");
  return false;
}
win1 = window.open("getallemps.php?reasontext=" + param, "Employees", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetEmp(emp,emparr) {
var empdet = emparr.split("|");
document.forms[0].employee.value = emp;
document.forms[0].emprecnum.value = empdet[0];

}

function searchsort_fields()
{

    var ind1 = document.forms[0].use_oper.selectedIndex;
    var ind2 = document.forms[0].use1.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].user_oper.value = document.forms[0].use_oper[ind1].text;
    document.forms[0].user2.value = document.forms[0].use1[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;
   }

function checkenter(event)
{

    var ind1 = document.forms[0].use_oper.selectedIndex;
    var ind2 = document.forms[0].use1.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].user_oper.value = document.forms[0].use_oper[ind1].text;
    document.forms[0].user2.value = document.forms[0].use1[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;


   }
