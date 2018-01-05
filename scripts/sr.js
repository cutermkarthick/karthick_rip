/*
 * opportunity.js
 * validation for quotes
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
 */

function putfocus()
{
   document.forms[0].company.focus();
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

function GetQuoteDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "QuoteDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetQuoteDate(duedate) {
document.forms[0].quotedate.value = duedate;
}
function ConfirmDelete() {
     document.forms[0].deleteflag.value = "y";
     return true;
}

function setquotetype()
{
	var aind = document.forms[0].quotetype.selectedIndex;
	document.forms[0].quotetypeval.value = document.forms[0].quotetype[aind].text;
	return true;
}

function addRow(id,index){

var x=index;

item1="item"+index;
qty="quantity"+index;
itemdesc="item_desc"+index;
rate="rate"+index;
amount="amount"+index;
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","10");
inp1.setAttribute("name",item1);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","60");
inp2.setAttribute("name",itemdesc);

cell2.appendChild(inp2);
var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","10");
inp3.setAttribute("name",qty);

cell3.appendChild(inp3);
var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","10");
inp4.setAttribute("name",rate);
cell4.appendChild(inp4);
var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","10");
inp5.setAttribute("readonly",'readonly');
inp5.style.backgroundColor = "#DDDDDD";
inp5.setAttribute("name",amount);
cell5.appendChild(inp5);

row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
tbody.appendChild(row);
x++;
//alert("i am here");
document.forms[0].index.value=x;
}

function addRow4edit(id,index){

var x=index;
item1="item"+index;
qty="qty"+index;
itemdesc="item_desc"+index;
rate="rate"+index;
amount="amount"+index;
previtem="previtem"+index;
birecnum="birecnum"+index;
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.setAttribute("bgcolor","#FFFFFF");
var cell1 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","10");
inp1.setAttribute("name",item1);

cell1.appendChild(inp1);
var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","10");
inp2.setAttribute("name",qty);

cell2.appendChild(inp2);
var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","50");
inp3.setAttribute("name",itemdesc);

cell3.appendChild(inp3);
var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","10");
inp4.setAttribute("name",rate);
cell4.appendChild(inp4);
var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","20");
inp5.setAttribute("style","'background-color:#DDDDDD;' readonly='readonly'");
inp5.setAttribute("name",amount);
cell5.appendChild(inp5);

var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","hidden");
inp6.setAttribute("value","");
inp6.setAttribute("name",previtem);

var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","hidden");
inp7.setAttribute("value","");
inp7.setAttribute("name",birecnum);

row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(inp6);
row.appendChild(inp7);

tbody.appendChild(row);
x++;
document.forms[0].index.value=x;
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

function GetAllEmps(rt)
		{

		var param = rt;
		var winWidth = 300;
		var winHeight = 300;
		var winLeft = (screen.width-winWidth)/2;
		var winTop = (screen.height-winHeight)/2;
		win1 = window.open("getallemps.php?reasontext=" + rt, "Employees", +
			"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
			",width=" + winWidth + ",height=" + winHeight +
			",top="+winTop+",left="+winLeft);
		}
	function SetEmp(emp,emprecnum)
		{
		document.forms[0].salesperson.value = emp;
		document.forms[0].salespersonrecnum.value = emprecnum;

		}




function searchsort_fields()
{
    var ind1 = document.forms[0].opportunity1.selectedIndex;
    var ind2 = document.forms[0].opportunity_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].opportunityfl.value = document.forms[0].opportunity1[ind1].text;
    document.forms[0].opportunity_oper.value = document.forms[0].opportunity_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}

function check_req_fields()
{
    var errmsg = '';
   if (document.forms[0].srnum.value.length == 0)
   {
       errmsg +="Service Request is not entered\n";

   }
   if (document.forms[0].wonum.value.length == 0)
   { errmsg +="Work Order # must be entered\n";

   }
   if (document.forms[0].title.value.length == 0)
   { errmsg +="Title must be entered";

   }
   if (document.forms[0].company.value.length == 0)
   { errmsg +="Customer must be entered\n";

   }
   if (document.forms[0].contact1.value.length == 0)
   { errmsg +="Employee must be entered\n";

   }
  if (document.forms[0].contact.value.length == 0)
   { errmsg +="Contact must be entered\n";
   }


     if (errmsg == '')
    {
    var ind2 = document.forms[0].repoted.selectedIndex;
    var ind3 = document.forms[0].priority.selectedIndex;
    var ind4 = document.forms[0].srstatus.selectedIndex;
    document.forms[0].reportedval.value = document.forms[0].repoted[ind2].text;
    document.forms[0].priorityval.value = document.forms[0].priority[ind3].text;
    document.forms[0].srstatusval.value = document.forms[0].srstatus[ind4].text;
        return true;
    }
    else
    {
       alert (errmsg);
       return false;
    }

}

function putfocus()
{
   document.forms[0].srnum.focus();
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
document.forms[0].phone.value = contdet[1];
document.forms[0].email.value = contdet[2];
document.forms[0].contactrecnum.value = contdet[0];

}

function GetSolNo() {

var winWidth =425;
var winHeight = 475;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("srSolution.php","link", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetSolNo(solnum,solval) {
var sol1=solnum;
var sol2=solval;
document.forms[0].solnum.value = solval;
document.forms[0].solrecnum.value = solnum;
}

function GetWoNo() {

var winWidth = 575;
var winHeight = 375;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getWo.php","link", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}



function SetWoNo(inpworecnum,inpwonum,inpcomp,inpcont,inpemail,inpfname) {
var worecnum=inpworecnum;
var wonum=inpwonum;
var comp=inpcomp;
var cont=inpcont;
var email=inpemail;
document.forms[0].worecnum.value= worecnum;
document.forms[0].wonum.value=wonum;
document.forms[0].company1.value=comp;
document.forms[0].con.value=cont;
document.forms[0].em.value=email;
}


function GetAllEmps(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getallemps.php?reasontext=" + rt, "Employees", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetEmp(emp,emparr) {
document.forms[0].contact1.value = emp;
var empdet = emparr.split("|");
document.forms[0].phone1.value =empdet[1];
document.forms[0].email1.value = empdet[2];
document.forms[0].empnum.value = empdet[0];
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

function GetDueDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "DueDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetDueDate(desdate) {
document.forms[0].due_date.value = desdate;
}

function GetRecDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "RecDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetRecDate(desdate) {
document.forms[0].rec_date.value = desdate;
}

function GetDocDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "DocDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetDocDate(desdate) {
document.forms[0].doc_date.value = desdate;
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

function printSR(srrecnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printSr.php?srrecnum=" + srrecnum, "PrintSR", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}

function searchsort_fields(event)
{
    var ind1 = document.forms[0].srcrit.selectedIndex;
    var ind2 = document.forms[0].sr_oper.selectedIndex;
    var ind3 = document.forms[0].sort1.selectedIndex;
    document.forms[0].srcritval.value = document.forms[0].srcrit[ind1].text;
    document.forms[0].sroperval.value = document.forms[0].sr_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[ind3].text;
}

function checkenter(event)
{
    var ind1 = document.forms[0].srcrit.selectedIndex;
    var ind2 = document.forms[0].sr_oper.selectedIndex;
    var ind3 = document.forms[0].sort1.selectedIndex;
    document.forms[0].srcritval.value = document.forms[0].srcrit[ind1].text;
    document.forms[0].sroperval.value = document.forms[0].sr_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[ind3].text;
    document.forms[0].submit();

}

