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
   { alert("Work Order # must be entered");
        return false;
   }
   if (document.forms[0].ponum.value.length == 0)
   { alert("PO # must be entered");
        return false;
   }
   if (document.forms[0].quotenum.value.length == 0)
   { alert("Quote # must be entered");
        return false;
   }
   if (document.forms[0].contact.value.length == 0)
   { alert("Contact must be present");
        return false;
   }
   if (document.forms[0].contact.value == 'Please Specify')
   { alert("Contact cannot be Please Specify");
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
",top="+winTop+",left="+winLeft+",dependent=yes");
}
function SetCustomer(customer,custrecnum) {
document.forms[0].company.value = customer;
document.forms[0].companyrecnum.value = custrecnum;
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
//alert(dateval);
//alert(fieldname);
document.forms[0].elements[fieldname].value = dateval;

}

function GetwfDate(rt1) {
var max=document.forms[0].max.value;
var param = rt1;
flag=0;

for (var i=1;i<=max;i++)
{
	chknm="ckbo" + i;
	if ( document.forms[0].elements[chknm].checked == true )
	{
		flag=1;
		break;
	}
}
if(rt1==i)
{
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getwfcalendar.php?reasontext=" + rt1,"NewDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
else
{
alert("You Have Another Milestone Before This Milestone");
}
}


function addDays(mydate,days)
{
	return new Date(mydate.getTime() + days*24*60*60*1000);
}

function SetwfDate(dateval,index)
{
//alert(dateval);
//alert(index);
	var max=document.forms[0].max.value;
//alert(max);
	var day=dateval.substring(10,8);
	var month=dateval.substring(7,5);
	var year=dateval.substring(4,0);
	var inc=0;
	flag=1;
	for (var i=index;i<=max;i++)
	{

		if (flag==1)
		{
			dates="dates" + i;
			document.forms[0].elements[dates].value = dateval;
			flag=0;

		}
		else
		{
			chknm="ckbo" + i;
//alert("i am here" + chknm);
			if ( document.forms[0].elements[chknm].checked == true )
			{

			est="est" + i;
			var inc = inc + parseInt(document.forms[0].elements[est].value);
			var d = addDays(new Date(year,month,day),inc);
			day1=d.getDate();
			month1=d.getMonth();
			year1=d.getFullYear();
		                var d1=year1 + "-" + month1 + "-" + day1;
			dates="dates" + i;
			document.forms[0].elements[dates].value = d1;
			}
		 }
	}
}


function GetwfDate4Edit(rt1) {
var param = rt1;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getwfcalendar.php?reasontext=" + rt1,"EditDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}



function SetwfDate4Edit(dateval,index)
{
//alert(dateval);
//alert(index);
	var max=document.forms[0].max.value;
//alert(max);
	var day=dateval.substring(10,8);
	var month=dateval.substring(7,5);
	var year=dateval.substring(4,0);
	var inc=0;
	flag=1;
	for (var i=index;i<=max;i++)
	{

		if (flag==1)
		{
			dates="dates" + i;
			document.forms[0].elements[dates].value = dateval;
			flag=0;

		}
		else
		{
//alert("i am here" + chknm);
			est="est" + i;
			var inc = inc + parseInt(document.forms[0].elements[est].value);
			var d = addDays(new Date(year,month,day),inc);
			day1=d.getDate();
			month1=d.getMonth();
			year1=d.getFullYear();
		                var d1=year1 + "-" + month1 + "-" + day1;
			dates="dates" + i;
			document.forms[0].elements[dates].value = d1;
		 }
	}
}





function Setmax(index)
{
chknm="ckbo" + index;
if ( document.forms[0].elements[chknm].checked == true )
{
document.forms[0].max1.value=parseInt(document.forms[0].max1.value) + 1;
}
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
function GetUpdAssyDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "AssyDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
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
document.forms[0].sch_due_date.value = schduedate;
}




function GetAssyCompDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "AssyComp", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetAssyComp(assydate) {
document.forms[0].assy_comp.value = assydate;
}
function GetFabCompDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "FabComp", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetFabComp(fabdate) {
document.forms[0].fab_comp.value = fabdate;
}
function DesCompDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "DesComp", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetDesComp(descomp) {
document.forms[0].des_comp.value = descomp;
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
function CancelWO()
{
     document.forms[0].deleteflag.value = "y";
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
function GetDesSignoffEmp(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getallemps.php?reasontext=" + rt, "DesSignoff", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetDesSignoffEmp(emp,emprecnum) {
document.forms[0].des_signoff_by.value = emp;
}
function GetAssySignoffEmp(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getallemps.php?reasontext=" + rt, "AssySignoff", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetAssySignoffEmp(emp,emprecnum) {
document.forms[0].assy_signoff_by.value = emp;
}
function GetFabSignoffEmp(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getallemps.php?reasontext=" + rt, "FabSignoff", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetFabSignoffEmp(emp,emprecnum) {
document.forms[0].fab_signoff_by.value = emp;
}
function printBWO(typenum,worecnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printBoardWO.php?typenum=" + typenum + "&worecnum=" + worecnum, "PrintBWO", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);

}
function printPCBAWO(typenum,worecnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printPCBAWO.php?typenum=" + typenum + "&worecnum=" + worecnum, "PrintPCBAWO", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);

}
