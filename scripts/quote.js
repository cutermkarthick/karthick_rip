/*
 * quote.js
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
//alert(rt);
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
/*
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
document.forms[0].delivarydate.value = desdate;
}    */
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
    function onSelectcurrency()
        {

        var aind = document.forms[0].currency1.selectedIndex;
        document.forms[0].currency.value = document.forms[0].currency1[aind].text;
        document.forms[0].salval.value = document.forms[0].currency1[aind].text;

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

}

function GetQuoteNo() {

var winWidth = 575;
var winHeight = 375;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getQuote.php","link", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetQuoteNo(inpquoterecnum,inpquotenum) {
var quoterecnum=inpquoterecnum;
var quotenum=inpquotenum;

document.forms[0].quoterecnum.value= quoterecnum;
document.forms[0].quotenum.value=quotenum;

}


function GetAllbom2parts(p) {
//alert(p);
var param = p;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var ind = document.forms[0].ptype.selectedIndex;
if (ind != 1)
{
alert("BOM type must be Yes");
  return false;
}
win1 = window.open("getallbom2partnum.php?reasontext=" + param, "Bom2parts", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function Setparts(bomnum,bomrecnum) {
var contdet = bomrecnum.split("|");
document.forms[0].bomnum.value = bomnum;
document.forms[0].partnum1.value = bomnum;
document.forms[0].part_desc.value = contdet[1];
//document.forms[0].vendor.value = contdet[0];

//document.forms[0].min_qty.value = contdet[1];
//document.forms[0].mfr_partnum.value = contdet[3];
document.forms[0].bomrecnum.value = bomrecnum;
//document.forms[0].vendrecnum.value = bomrecnum;

}

function GetBomNo() {
var winWidth = 650;
var winHeight = 375;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getbom4parts.php","link", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetBomNo(inpworecnum,inpwonum,inpcont,inpemail) {
var bomrecnum=inpworecnum;
var bomnum=inpwonum;
//var text=inpcomp;
var vendor=inpcont;
var value=inpemail;

document.forms[0].bomrecnum.value= bomrecnum;
document.forms[0].bomnum.value=bomnum;
//document.forms[0].text.value=text;
document.forms[0].vendor.value=vendor;
document.forms[0].value.value=value;

}

function searchsort_fields()
{

    var ind = document.forms[0].quotecrit.selectedIndex;
    var s1ind = document.forms[0].quote_oper.selectedIndex;
    var s2ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].quotecritval.value = document.forms[0].quotecrit[ind].text;
    document.forms[0].quoteoperval.value = document.forms[0].quote_oper[s1ind].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s2ind].text;
}

function checkenter(event)
{

    var ind = document.forms[0].quotecrit.selectedIndex;
    var s1ind = document.forms[0].quote_oper.selectedIndex;
    var s2ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].quotecritval.value = document.forms[0].quotecrit[ind].text;
    document.forms[0].quoteoperval.value = document.forms[0].quote_oper[s1ind].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s2ind].text;

}

function printquoteDetails(quoterecnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printquoteDetails.php?quoterecnum=" + quoterecnum, "PrintQuote", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}
