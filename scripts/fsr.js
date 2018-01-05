
/*
 * srreport.js
 *  Written on March 30 2005 by Jerry George
 * validation for srreport.php
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam 
 * bmandyam@fluentsoft.com
 */



function check_req_fields()
{
    var errmsg = '';
var valid="0,1,2,3,4,5,6,7,8,9,.";
var valid1="0,1,2,3,4,5,6,7,8,9";
var ok="yes";
var temp;
var frm=document.forms[0];
var max=document.forms[0].index.value;
var frm=document.forms[0];
var flag=0;
for(var i=16;i<frm.length;i++)
{
	for(var j=6;j<max;j++)
	{
		part="partnum"+j;
		var k=i;

		if(frm.elements[i].name==part  && frm.elements[i].value.length != 0 &&  frm.elements[k+1].value.length == 0 && frm.elements[k+2].value.length == 0)
		{
			
			errmsg +="Rate and Qty should be present \n";
			flag=1;
			break;
		}
		if(frm.elements[i].name==part  && frm.elements[i].value.length != 0 &&  frm.elements[k+1].value.length == 0 )
		{
			errmsg +="Qty should be present\n";
			flag=1;
			break;
		}
		if(frm.elements[i].name==part  && frm.elements[i].value.length != 0 &&  frm.elements[k+3].value.length == 0 )
		{
			errmsg +="Rate should be present\n";
			flag=1;
			break;
		}

	}
	if (flag==1)
	break;
}
    if (document.forms[0].due_date.value == '')
    { 
       errmsg +="Date Requested is not entered\n";
     }
    if (document.forms[0].service.checked == false && document.forms[0].training.checked == false && document.forms[0].appdev.checked == false && document.forms[0].salessupp.checked == false)
    { 
       errmsg +="Service is not Mentioned\n";
     }
    if (document.forms[0].continuity.checked == false && document.forms[0].paramfunc.checked == false && document.forms[0].mechanical.checked == false && document.forms[0].others.checked == false)
    { 
       errmsg +="Description of Problem is not Mentioned\n";
     }
    for (var j=1;j<=5;j++)
   {
	part="partnum"+j;
	rate="rate"+j;
	qty="qty"+j;
	if(document.forms[0].elements[part].value.length > 0)
	{
		if(document.forms[0].elements[rate].value.length == 0)
   	    		errmsg +="Rate should be present \n";
		if(document.forms[0].elements[qty].value.length == 0)
   	   		errmsg +="Quantity should be present\n";

	}

   }

   for (var i=1;i<=max;i++)
   {
	rate="rate"+i;
	qty="qty"+i;
	for (var j=0;j<document.forms[0].elements[rate].value.length;j++)
	{
        		temp= "" + document.forms[0].elements[rate].value.substring(j,j+1);
		if(valid.indexOf(temp) == -1)
		{
			errmsg +="Rate should be numbers only\n";
                                                break;
		}
	}
	for (var j=0;j<document.forms[0].elements[qty].value.length;j++)
	{
        		temp= "" + document.forms[0].elements[qty].value.substring(j,j+1);
		if(valid1.indexOf(temp) == -1)
		{
			errmsg +="Quantiy should be numbers only\n";
                                                break;
		}
	}

}

     if (errmsg == '')
    {
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


function addRow(id,index){
var x=index;
seqnum="seqnum"+index;
fname="fname"+index;
type="type"+index;
length="length"+index;

var tbody = document.getElementById(id).getElementsByTagName("tbody")[0]; 
var row = document.createElement("TR"); 
row.style.backgroundColor = "#FFFFFF";
var cell1 = document.createElement("TD"); 
var inp1 =  document.createElement("INPUT"); 
inp1.setAttribute("type","text"); 
inp1.setAttribute("size","10"); 
inp1.setAttribute("name",seqnum); 

cell1.appendChild(inp1); 
var cell2 = document.createElement("TD"); 
var inp2 =  document.createElement("INPUT"); 
inp2.setAttribute("type","text"); 
inp2.setAttribute("size","10"); 
inp2.setAttribute("name",fname); 
cell2.appendChild(inp3); 

var cell3 = document.createElement("TD"); 
var inp3=  document.createElement("INPUT"); 
inp3.setAttribute("type","text"); 
inp3.setAttribute("size","10"); 
inp3.setAttribute("name",type); 
cell3.appendChild(inp3); 

var cell4 = document.createElement("TD"); 
var inp4 =  document.createElement("INPUT"); 
inp4.setAttribute("type","text"); 
inp4.setAttribute("size","20"); 
inp4.setAttribute("name",length); 
cell4.appendChild(inp4); 

row.appendChild(cell1); 
row.appendChild(cell2); 
row.appendChild(cell3); 
row.appendChild(cell4); 
tbody.appendChild(row); 
x++;
document.forms[0].index.value=x;
}

function addRow4edit(id,index){
var x=index;
partnum="partnum"+index;
qty="qty"+index;
itemdesc="item_desc"+index;
rate="rate"+index;
amount="amount"+index;
prevpartnum="prevpartnum"+index;
birecnum="birecnum"+index;
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0]; 
var row = document.createElement("TR"); 
row.setAttribute("bgcolor","#FFFFFF"); 
var cell1 = document.createElement("TD"); 
var inp1 =  document.createElement("INPUT"); 
inp1.setAttribute("type","text"); 
inp1.setAttribute("size","10"); 
inp1.setAttribute("name",partnum); 

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
inp6.setAttribute("name",prevpartnum); 

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
document.forms[0].owner.value = emp;
var empdet = emparr.split("|");
document.forms[0].emprecnum.value = empdet[0];
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
win1 = window.open("allcalendartime.php", "RecDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetRecDate(desdate) {
document.forms[0].startdate.value = desdate;
}

function GetDocDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendartime.php", "DocDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetDocDate(desdate) {
document.forms[0].enddate.value = desdate;
}

function GetDesDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendartime.php", "DesDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetDesDate(desdate) {
document.forms[0].totdate.value = desdate;
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

function printfsr(fsrrecnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printfsr.php?fsrrecnum=" + fsrrecnum, "PrintFSR", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}

function validate(field)
{
var valid="0,1,2,3,4,5,6,7,8,9";
var ok="yes";
var temp;
for (var i=0;i<field.value.length;i++)
{
temp= "" + field.value.substring(i,i+1);
if(valid.indexOf(temp)== "-1")
	ok="no";
}
}
