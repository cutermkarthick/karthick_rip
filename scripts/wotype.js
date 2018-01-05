/*
 *wotype.js
 * validation for woEntry.php
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
 */

function putfocus()
{
   document.forms[0].company.focus();
}

function onSelecttype(rt)
{
	type="type" + rt;
	typeval="typeval" + rt;
	var aind = document.forms[0].elements[type].selectedIndex;
	//alert(document.forms[0].elements[type][aind].text);
	document.forms[0].elements[typeval].value = document.forms[0].elements[type][aind].text;
	//alert(document.forms[0].elements[typeval].value);
}

function onSelectbut(rt)
{
	getbut="getbut" + rt;
	getbutval="getbutval" + rt;
	var aind = document.forms[0].elements[getbut].selectedIndex;
	//alert(document.forms[0].elements[getbut][aind].text);
	document.forms[0].elements[getbutval].value = document.forms[0].elements[getbut][aind].text;
	//alert(document.forms[0].elements[getbutval].value);
}

function onSelectparent()
{
	var aind = document.forms[0].parent.selectedIndex;
	//alert(document.forms[0].elements[getbut][aind].text);
	document.forms[0].parentval.value = document.forms[0].parent[aind].text;
	alert(document.forms[0].parentval.value);
}

function addRow(id,index){

var x=index;
seqnum="seqnum" + index;
lname="lname" + index;
type="type" + index;
mandatory="mandatory" + index;
group="group" + index;
status="status" + index;
typeval="typeval" + index;
groupval="groupval" + index;
statusval="statusval" + index;

var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");
cell1.setAttribute("align","center");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","5");
inp1.setAttribute("name",seqnum);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
cell2.setAttribute("align","center");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","20");
inp2.setAttribute("name",lname);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
cell3.setAttribute("align","center");
var oSelect=document.createElement("select");
oSelect.setAttribute("name", type);
oSelect.setAttribute("size", 1);
cell3.appendChild(oSelect);

var oOption = document.createElement("option");
var t0 = document.createTextNode("Text");
oOption.setAttribute("value", 0);
oOption.appendChild(t0);
oSelect.appendChild(oOption);

var oOption1 = document.createElement("option");
var t1 = document.createTextNode("Desc Text");
oOption1.setAttribute("value", 1);
oOption1.appendChild(t1);
oSelect.appendChild(oOption1);

var oOption2 = document.createElement("option");
var t2 = document.createTextNode("Long");
oOption2.setAttribute("value", 2);
oOption2.appendChild(t2);
oSelect.appendChild(oOption2);

var oOption3 = document.createElement("option");
var t3 = document.createTextNode("Numeric");
oOption3.setAttribute("value", 3);
oOption3.appendChild(t3);
oSelect.appendChild(oOption3);

var oOption4 = document.createElement("option");
var t4 = document.createTextNode("Decimal");
oOption4.setAttribute("int", 4);
oOption4.appendChild(t4);
oSelect.appendChild(oOption4);

var oOption5 = document.createElement("option");
var t5 = document.createTextNode("Date");
oOption5.setAttribute("int", 5);
oOption5.appendChild(t5);
oSelect.appendChild(oOption5);

var oOption6 = document.createElement("option");
var t6 = document.createTextNode("Check Box");
oOption6.setAttribute("int", 6);
oOption6.appendChild(t6);
oSelect.appendChild(oOption6);

var oOption7 = document.createElement("option");
var t7 = document.createTextNode("Part With Qty");
oOption7.setAttribute("int", 7);
oOption7.appendChild(t7);
oSelect.appendChild(oOption7);

var oOption8 = document.createElement("option");
var t8 = document.createTextNode("Part");
oOption8.setAttribute("int", 8);
oOption8.appendChild(t8);
oSelect.appendChild(oOption8);

var cell4 = document.createElement("TD");
cell4.setAttribute("align","center");
var mandatory1=document.createElement("input");
mandatory1.type="checkbox";
mandatory1.value='';
mandatory1.name =mandatory;
cell4.appendChild(mandatory1);

var cell5 = document.createElement("TD");
cell5.setAttribute("align","center");
var oSelect1g=document.createElement("select");
oSelect1g.setAttribute("name", group);
oSelect1g.setAttribute("size", 1);
cell5.appendChild(oSelect1g);

var oOption1g = document.createElement("option");
var t0 = document.createTextNode("Group1");
oOption1g.setAttribute("value", 0);
oOption1g.appendChild(t0);
oSelect1g.appendChild(oOption1g);

var oOption1g1 = document.createElement("option");
var t1 = document.createTextNode("Group2");
oOption1g1.setAttribute("value", 1);
oOption1g1.appendChild(t1);
oSelect1g.appendChild(oOption1g1);

var oOption1g2 = document.createElement("option");
var t2 = document.createTextNode("Group3");
oOption1g2.setAttribute("value", 2);
oOption1g2.appendChild(t2);
oSelect1g.appendChild(oOption1g2);

var oOption1g3 = document.createElement("option");
var t3 = document.createTextNode("Group4");
oOption1g3.setAttribute("value", 3);
oOption1g3.appendChild(t3);
oSelect1g.appendChild(oOption1g3);

var cell6 = document.createElement("TD");
cell6.setAttribute("align","center");
var oSelect1s=document.createElement("select");
oSelect1s.setAttribute("name", status);
oSelect1s.setAttribute("size", 1);
cell6.appendChild(oSelect1s);

var oOption1s = document.createElement("option");
var t0 = document.createTextNode("Active");
oOption1s.setAttribute("value", 0);
oOption1s.appendChild(t0);
oSelect1s.appendChild(oOption1s);

var oOption1s1 = document.createElement("option");
var t1 = document.createTextNode("InActive");
oOption1s1.setAttribute("value", 1);
oOption1s1.appendChild(t1);
oSelect1s.appendChild(oOption1s1);

var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","hidden");
inp6.setAttribute("value","Text");
inp6.setAttribute("name",typeval);

var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","hidden");
inp7.setAttribute("value","Group1");
inp7.setAttribute("name",groupval);

var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","hidden");
inp8.setAttribute("value","Active");
inp8.setAttribute("name",statusval);

row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell6);
row.appendChild(inp6);
row.appendChild(inp7);
row.appendChild(inp8);

tbody.appendChild(row);
x++;
document.forms[0].index1.value=x;
}


function addRow4edit(id,index){
var x=index;

prevseqnum="prevseqnum" + index;
typerecnum="typerecnum" + index;
seqnum="seqnum" + index;
lname="lname" + index;
type="type" + index;
mandatory="mandatory" + index;
group="group" + index;
status="status" + index;
typeval="typeval" + index;
groupval="groupval" + index;
statusval="statusval" + index;

var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");
cell1.setAttribute("align","center");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","5");
inp1.setAttribute("name",seqnum);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
cell2.setAttribute("align","center");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","20");
inp2.setAttribute("name",lname);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
cell3.setAttribute("align","center");
var oSelect=document.createElement("select");
oSelect.setAttribute("name", type);
oSelect.setAttribute("size", 1);
cell3.appendChild(oSelect);

var oOption = document.createElement("option");
var t0 = document.createTextNode("Text");
oOption.setAttribute("value", 0);
oOption.appendChild(t0);
oSelect.appendChild(oOption);

var oOption1 = document.createElement("option");
var t1 = document.createTextNode("Desc Text");
oOption1.setAttribute("value", 1);
oOption1.appendChild(t1);
oSelect.appendChild(oOption1);

var oOption2 = document.createElement("option");
var t2 = document.createTextNode("Long");
oOption2.setAttribute("value", 2);
oOption2.appendChild(t2);
oSelect.appendChild(oOption2);

var oOption3 = document.createElement("option");
var t3 = document.createTextNode("Numeric");
oOption3.setAttribute("value", 3);
oOption3.appendChild(t3);
oSelect.appendChild(oOption3);

var oOption4 = document.createElement("option");
var t4 = document.createTextNode("Decimal");
oOption4.setAttribute("int", 4);
oOption4.appendChild(t4);
oSelect.appendChild(oOption4);

var oOption5 = document.createElement("option");
var t5 = document.createTextNode("Date");
oOption5.setAttribute("int", 5);
oOption5.appendChild(t5);
oSelect.appendChild(oOption5);

var oOption6 = document.createElement("option");
var t6 = document.createTextNode("Check Box");
oOption6.setAttribute("int", 6);
oOption6.appendChild(t6);
oSelect.appendChild(oOption6);

var oOption7 = document.createElement("option");
var t7 = document.createTextNode("Part With Qty");
oOption7.setAttribute("int", 7);
oOption7.appendChild(t7);
oSelect.appendChild(oOption7);

var oOption8 = document.createElement("option");
var t8 = document.createTextNode("Part");
oOption8.setAttribute("int", 8);
oOption8.appendChild(t8);
oSelect.appendChild(oOption8);

var cell4 = document.createElement("TD");
cell4.setAttribute("align","center");
var mandatory1=document.createElement("input");
mandatory1.type="checkbox";
mandatory1.value='';
mandatory1.name =mandatory;
cell4.appendChild(mandatory1);

var cell5 = document.createElement("TD");
cell5.setAttribute("align","center");
var oSelect1g=document.createElement("select");
oSelect1g.setAttribute("name", group);
oSelect1g.setAttribute("size", 1);
cell5.appendChild(oSelect1g);

var oOption1g = document.createElement("option");
var t0 = document.createTextNode("Group1");
oOption1g.setAttribute("value", 0);
oOption1g.appendChild(t0);
oSelect1g.appendChild(oOption1g);

var oOption1g1 = document.createElement("option");
var t1 = document.createTextNode("Group2");
oOption1g1.setAttribute("value", 1);
oOption1g1.appendChild(t1);
oSelect1g.appendChild(oOption1g1);

var oOption1g2 = document.createElement("option");
var t2 = document.createTextNode("Group3");
oOption1g2.setAttribute("value", 2);
oOption1g2.appendChild(t2);
oSelect1g.appendChild(oOption1g2);

var oOption1g3 = document.createElement("option");
var t3 = document.createTextNode("Group4");
oOption1g3.setAttribute("value", 3);
oOption1g3.appendChild(t3);
oSelect1g.appendChild(oOption1g3);

var cell6 = document.createElement("TD");
cell6.setAttribute("align","center");
var oSelect1s=document.createElement("select");
oSelect1s.setAttribute("name", status);
oSelect1s.setAttribute("size", 1);
cell6.appendChild(oSelect1s);

var oOption1s = document.createElement("option");
var t0 = document.createTextNode("Active");
oOption1s.setAttribute("value", 0);
oOption1s.appendChild(t0);
oSelect1s.appendChild(oOption1s);

var oOption1s1 = document.createElement("option");
var t1 = document.createTextNode("InActive");
oOption1s1.setAttribute("value", 1);
oOption1s1.appendChild(t1);
oSelect1s.appendChild(oOption1s1);

var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","hidden");
inp6.setAttribute("value","Text");
inp6.setAttribute("name",typeval);

var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","hidden");
inp7.setAttribute("value","Group1");
inp7.setAttribute("name",groupval);

var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","hidden");
inp8.setAttribute("value","Active");
inp8.setAttribute("name",statusval);

var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","hidden");
inp9.setAttribute("value","");
inp9.setAttribute("name",prevseqnum);

var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","hidden");
inp10.setAttribute("value","");
inp10.setAttribute("name",typerecnum);

row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell6);
row.appendChild(inp6);
row.appendChild(inp7);
row.appendChild(inp8);
row.appendChild(inp9);
row.appendChild(inp10);

tbody.appendChild(row);
x++;
document.forms[0].index1.value=x;
}


function viewTemplate(rt,rt1) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("template.php?parent=" +rt + "&pname=" + rt1, "PrintPCBAWO", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function GetDate(rt) {

var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getcalendar.php",param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=0" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
