/*
 * invoice.js
 * validation for invoice
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
 */

function putfocus()
{
   document.forms[0].company.focus();
}

function GetAllCustomers(rt) {
//	alert("All customers");
var param = rt;
var winWidth = 300;
var winHeight = 300;

      var x=1;
      var max=document.forms[0].index.value;
      var seq_num=new Array();
      var seqlist = {};
      var lipresent = 0;
      while (x < max)
    {
            ln ="line_num" + x;

            lnv = document.getElementById(ln).value;
            crn = "crn" + x;
            qty= "qty"+ x;
            partnum = "partnum" + x;
            item_desc= "item_desc"+ x;
            cofc = "cofc" + x;
            ponum= "ponum"+ x;
            rawmtl = "rawmtl" + x;
            tariffsch= "tariffsch"+ x;
            type= "type"+ x;
            rate = "rate" + x;
            amount = "amount" + x;

          document.getElementById(ln).value="";
          document.getElementById(crn).value="";
          document.getElementById(qty).value="";
          document.getElementById(partnum).value="";
          document.getElementById(item_desc).value="";
          document.getElementById(cofc).value="";
          document.getElementById(ponum).value="";
          document.getElementById(rawmtl).value="";
          document.getElementById(tariffsch).value="";
          document.getElementById(type).value="";
          document.getElementById(rate).value="";
          document.getElementById(amount).value="";
          x++;
     }
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getcustomeraddress.php?reasontext=" + rt, "Customers", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetCustomer(customer,custaddress) {
//alert(custaddress);
var contdet = custaddress.split("|");
document.forms[0].company.value = customer;
document.getElementById("ba1").innerHTML= contdet[0] +" "+ contdet[1];
document.getElementById("ba2").innerHTML= contdet[2]+" "+ contdet[3]+" "+ contdet[4];
document.getElementById("ba3").innerHTML= contdet[5] ;
// Following shipping address moved to a separate function
//document.getElementById("sa1").innerHTML= contdet[6] +" "+ contdet[7];
//document.getElementById("sa2").innerHTML= contdet[8]+" "+ contdet[9]+" "+ contdet[10];
//document.getElementById("sa3").innerHTML= contdet[11] ;
document.forms[0].companyrecnum.value= contdet[12] ;
//alert("companyrecnum="+contdet[12]);
document.forms[0].countryoffinaldest.value= contdet[11];
document.forms[0].portofdischarge.value= contdet[8] ;
document.forms[0].remarks.value = contdet[13];
document.forms[0].terms.value = contdet[14];
//document.forms[0].badr2.value = contdet[2]+" "+ contdet[3]+" "+ contdet[4];
//document.forms[0].badr3.value = contdet[5] ;
//document.forms[0].sadr1.value = contdet[6] +" "+ contdet[7];
//document.forms[0].sadr2.value = contdet[8]+" "+ contdet[9]+" "+ contdet[10];
//document.forms[0].sadr3.value = contdet[11] ;
}

function GetCust4Shipping(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;

var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getcust4shipping.php?reasontext=" + rt, "Customers", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetCust4Shipping(customer,custaddress) {
var contdet = custaddress.split("|");
// alert(customer+"------------"+contdet[12]);
document.forms[0].shippingcompany.value = customer;
document.getElementById("sa1").innerHTML= contdet[0] +" "+ contdet[1];
document.getElementById("sa2").innerHTML= contdet[2]+" "+ contdet[3]+" "+ contdet[4];
document.getElementById("sa3").innerHTML= contdet[5] ;
document.forms[0].shippingcompanyrecnum.value = contdet[12];
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
document.forms[0].quote_date.value = duedate;
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
var x=parseInt(index);
var y=index;
//alert(x+"first---");

line_num="line_num"+x;
cofc = "cofc"+x;
crn="crn"+x;
partnum="partnum"+x;
item_desc ="item_desc"+x;
rawmtl = "rawmtl"+x;
tariffsch="tariffsch"+x;
packaging="packaging"+x;
ponum="ponum"+x;
qty="qty"+x;
rate="rate"+x;
amount="amount"+x;
type="type"+x;
po_qty="po_qty"+x;
custporecnum="custporecnum"+x;
polinenum="polinenum"+x;
schpo="schpo"+x;
//alert(crn+"--------------");

var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");

row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","2");
inp1.setAttribute("name",line_num);
inp1.setAttribute("id",line_num);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","5");
inp2.setAttribute("name",cofc);
inp2.setAttribute("id",cofc);
inp2.setAttribute("id",cofc);
//inp2.setAttribute("readOnly",true);
inp2.style.backgroundColor = "#DDDDDD";
cell2.appendChild(inp2);

var img10 = document.createElement("img");
img10.setAttribute("src","images/bu-get.gif");
img10.setAttribute("width","80px");
img10.setAttribute("alt","Get CofC");
img10.onclick = function(){getcofc(y);};
cell2.appendChild(img10);


var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","10");
inp3.setAttribute("name",crn);
inp3.setAttribute("id",crn);
inp3.setAttribute("readOnly",true);
inp3.style.backgroundColor = "#DDDDDD";
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","25");
inp4.setAttribute("name",partnum);
inp4.setAttribute("id",partnum);
inp4.setAttribute("readOnly",true);
inp4.style.backgroundColor = "#DDDDDD";
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","25");
inp5.setAttribute("readOnly",true);
inp5.style.backgroundColor = "#DDDDDD";
inp5.setAttribute("name",item_desc);
inp5.setAttribute("id",item_desc);
cell5.appendChild(inp5);

var cell6 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","15");
inp6.setAttribute("name",rawmtl);
inp6.setAttribute("id",rawmtl);
cell6.appendChild(inp6);

var cell7 = document.createElement("TD");
var inp7=  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","10");
inp7.setAttribute("name",tariffsch);
cell7.appendChild(inp7);

var cell8 = document.createElement("TD");
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","10");
inp8.setAttribute("name",packaging);
inp8.setAttribute("id",packaging);
cell8.appendChild(inp8);

var cell9 = document.createElement("TD");
var inp9=  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","10");
inp9.setAttribute("name",ponum);
inp9.setAttribute("id",ponum);
inp9.setAttribute("readOnly",true);
inp9.style.backgroundColor = "#DDDDDD";
cell9.appendChild(inp9);

var img2 = document.createElement("img");
img2.setAttribute("src","images/bu-getpo.gif");
img2.setAttribute("width","80px");
img2.setAttribute("alt","Get Custpo");
img2.onclick = function(){GetCustpo(y);};
cell9.appendChild(inp9);
cell9.appendChild(img2);

var cell10 = document.createElement("TD");
cell10.setAttribute("align","center");
var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","3");
inp10.setAttribute("name",qty);
inp10.setAttribute("id",qty);
//inp10.setAttribute("readOnly",true);
inp10.style.backgroundColor = "#DDDDDD";
cell10.appendChild(inp10);

var cell11 = document.createElement("TD");
var inp11=  document.createElement("INPUT");
inp11.setAttribute("type","text");
inp11.setAttribute("size","9");
inp11.setAttribute("readOnly",true);
inp11.style.backgroundColor = "#DDDDDD";
inp11.setAttribute("name",rate);
inp11.setAttribute("id",rate);
cell11.appendChild(inp11);

var cell12 = document.createElement("TD");
var inp12 =  document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","15");
inp12.setAttribute("readOnly",true);
inp12.style.backgroundColor = "#DDDDDD";
inp12.setAttribute("name",amount);
inp12.setAttribute("id",amount);
cell12.appendChild(inp12);

var img1 = document.createElement("img");
img1.setAttribute("src","images/bu-get.gif");
img1.setAttribute("width","80px");
img1.setAttribute("alt","Get CIM");
img1.onclick = function(){GetCRN4invoice(y);};
cell3.appendChild(inp3);
cell3.appendChild(img1);

var cell15 = document.createElement("TD");
var inp15 =  document.createElement("INPUT");
inp15.setAttribute("type","text");
inp15.setAttribute("size","8");
inp15.setAttribute("readOnly",true);
inp15.style.backgroundColor = "#DDDDDD";
inp15.setAttribute("name",type);
inp15.setAttribute("id",type);
cell15.appendChild(inp15);

var cell18 = document.createElement("TD");
var inp18 =  document.createElement("INPUT");
inp18.setAttribute("type","text");
inp18.setAttribute("size","5");
//inp18.setAttribute("readOnly",true);
//inp18.style.backgroundColor = "#DDDDDD";
inp18.setAttribute("name",polinenum);
inp18.setAttribute("id",polinenum);
cell18.appendChild(inp18);

var cell19 = document.createElement("TD");
var inp19 =  document.createElement("INPUT");
inp19.setAttribute("type","text");
inp19.setAttribute("size","10");
//inp18.setAttribute("readOnly",true);
//inp18.style.backgroundColor = "#DDDDDD";
inp19.setAttribute("name",schpo);
inp19.setAttribute("id",schpo);
cell19.appendChild(inp19);

var inp16 =  document.createElement("INPUT");
inp16.setAttribute("type","hidden");
inp16.setAttribute("value","");
inp16.setAttribute("name",custporecnum);
inp16.setAttribute("id",custporecnum);

//var cell25 = document.createElement("TD");
var inp17 =  document.createElement("INPUT");
inp17.setAttribute("type","hidden");
inp17.setAttribute("value","");
inp17.setAttribute("name",po_qty);
inp17.setAttribute("id",po_qty);
//cell25.appendChild(inp17);

row.appendChild(cell1);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell2);
row.appendChild(cell9);
row.appendChild(cell18);
row.appendChild(cell19);

row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell8);
row.appendChild(cell10);
row.appendChild(cell15);
row.appendChild(cell11);
row.appendChild(cell12);
row.appendChild(inp16);
row.appendChild(inp17);

tbody.appendChild(row);
x++;
//alert(x+"end---");
document.forms[0].index.value=x;
document.forms[0].curindex.value=x;
}

function addRow4edit(id,index){

var xe=parseInt(index);
var ye=parseInt(index);

prevlinenum="prevlinenum"+xe;
lirecnum="lirecnum"+xe;

line_num="line_num"+xe;
cofc = "cofc"+xe;
crn="crn"+xe;
partnum="partnum"+xe;
item_desc ="item_desc"+xe;
rawmtl = "rawmtl"+xe;
tariffsch="tariffsch"+xe;
packaging="packaging"+xe;
ponum="ponum"+xe;
qty="qty"+xe;
rate="rate"+xe;
amount="amount"+xe;
type="type"+xe;
po_qty="po_qty"+xe;
custporecnum="custporecnum"+xe;
polinenum="polinenum"+xe;
schpo="schpo"+xe;

var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");

row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","2");
inp1.setAttribute("name",line_num);
inp1.setAttribute("id",line_num);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","5");
inp2.setAttribute("name",cofc);
inp2.setAttribute("id",cofc);
//inp2.setAttribute("readOnly",true);
inp2.style.backgroundColor = "#DDDDDD";
cell2.appendChild(inp2);

var img10 = document.createElement("img");
img10.setAttribute("src","images/bu-get.gif");
img10.setAttribute("width","80px");
img10.setAttribute("alt","Get CofC");
img10.onclick = function(){getcofc_edit(index);};
cell2.appendChild(img10);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","10");
inp3.setAttribute("name",crn);
inp3.setAttribute("id",crn);
inp3.setAttribute("readOnly",true);
inp3.style.backgroundColor = "#DDDDDD";
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","25");
inp4.setAttribute("name",partnum);
inp4.setAttribute("id",partnum);
inp4.setAttribute("readOnly",true);
inp4.style.backgroundColor = "#DDDDDD";
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","30");
inp5.setAttribute("readOnly",true);
inp5.style.backgroundColor = "#DDDDDD";
inp5.setAttribute("name",item_desc);
inp5.setAttribute("id",item_desc);
cell5.appendChild(inp5);

var cell6 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","15");
inp6.setAttribute("name",rawmtl);
inp6.setAttribute("id",rawmtl);
cell6.appendChild(inp6);

var cell7 = document.createElement("TD");
var inp7=  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","10");
inp7.setAttribute("name",tariffsch);
cell7.appendChild(inp7);

var cell8 = document.createElement("TD");
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","10");
inp8.setAttribute("name",packaging);
inp8.setAttribute("id",packaging);
cell8.appendChild(inp8);

var cell9 = document.createElement("TD");
var inp9=  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","10");
inp9.setAttribute("name",ponum);
inp9.setAttribute("id",ponum);
inp9.setAttribute("readOnly",true);
inp9.style.backgroundColor = "#DDDDDD";
cell9.appendChild(inp9);

var img2 = document.createElement("img");
img2.setAttribute("src","images/bu-getpo.gif");
img2.setAttribute("width","80px");
img2.setAttribute("alt","Get Custpo");
img2.onclick = function(){GetCustpo(index);};
cell9.appendChild(inp9);
cell9.appendChild(img2);

var cell10 = document.createElement("TD");
cell10.setAttribute("align","center");
var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","3");
inp10.setAttribute("name",qty);
inp10.setAttribute("id",qty);
//inp10.setAttribute("readOnly",true);
inp10.style.backgroundColor = "#DDDDDD";
cell10.appendChild(inp10);

var cell11 = document.createElement("TD");
var inp11=  document.createElement("INPUT");
inp11.setAttribute("type","text");
inp11.setAttribute("size","9");
inp11.setAttribute("readOnly",true);
inp11.style.backgroundColor = "#DDDDDD";
inp11.setAttribute("name",rate);
inp11.setAttribute("id",rate);
cell11.appendChild(inp11);

var cell12 = document.createElement("TD");
var inp12 =  document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","15");
inp12.setAttribute("readOnly",true);
inp12.style.backgroundColor = "#DDDDDD";
inp12.setAttribute("name",amount);
inp12.setAttribute("id",amount);
cell12.appendChild(inp12);

var inp13 =  document.createElement("INPUT");
inp13.setAttribute("type","hidden");
inp13.setAttribute("value","");
inp13.setAttribute("name",prevlinenum);
inp13.setAttribute("id",prevlinenum);

var inp14 =  document.createElement("INPUT");
inp14.setAttribute("type","hidden");
inp14.setAttribute("value","");
inp14.setAttribute("name",lirecnum);
inp14.setAttribute("id",lirecnum);

var img1 = document.createElement("img");
img1.setAttribute("src","images/bu-get.gif");
img1.setAttribute("width","80px");
img1.setAttribute("alt","Get CIM");
img1.onclick = function(){GetCRN4invoice(index);};
cell3.appendChild(inp3);
cell3.appendChild(img1);

var cell15 = document.createElement("TD");
var inp15 =  document.createElement("INPUT");
inp15.setAttribute("type","text");
inp15.setAttribute("size","8");
inp15.setAttribute("readOnly",true);
inp15.style.backgroundColor = "#DDDDDD";
inp15.setAttribute("name",type);
inp15.setAttribute("id",type);
cell15.appendChild(inp15);

var inp16 =  document.createElement("INPUT");
inp16.setAttribute("type","hidden");
inp16.setAttribute("value","");
inp16.setAttribute("name",custporecnum);
inp16.setAttribute("id",custporecnum);

var cell20 = document.createElement("TD");
var inp17 =  document.createElement("INPUT");
inp17.setAttribute("type","hidden");
//inp17.setAttribute("value","");
inp17.setAttribute("name",po_qty);
inp17.setAttribute("id",po_qty);
cell20.appendChild(inp17);

var cell18 = document.createElement("TD");
var inp18 =  document.createElement("INPUT");
inp18.setAttribute("type","text");
inp18.setAttribute("size","5");
//inp18.setAttribute("readOnly",true);
//inp18.style.backgroundColor = "#DDDDDD";
inp18.setAttribute("name",polinenum);
inp18.setAttribute("id",polinenum);
cell18.appendChild(inp18);

var cell19 = document.createElement("TD");
var inp19 =  document.createElement("INPUT");
inp19.setAttribute("type","text");
inp19.setAttribute("size","5");
//inp18.setAttribute("readOnly",true);
//inp18.style.backgroundColor = "#DDDDDD";
inp19.setAttribute("name",schpo);
inp19.setAttribute("id",schpo);
cell19.appendChild(inp19);

row.appendChild(cell1);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell2);
row.appendChild(cell9);
row.appendChild(cell18);
row.appendChild(cell19);

row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell8);
row.appendChild(cell10);
row.appendChild(cell15);
row.appendChild(cell11);
row.appendChild(cell12);
row.appendChild(inp13);
row.appendChild(inp14);
row.appendChild(inp16);
row.appendChild(inp17);


tbody.appendChild(row);

xe++;
ye++;

document.forms[0].index.value=xe;
document.forms[0].curindex.value=xe;
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
function SetDueDate(due_date) {
document.forms[0].delivarydate.value = due_date;
}

function GetDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 350;
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
		document.forms[0].so2employee.value = emp;
		document.forms[0].salespersonrecnum.value = emprecnum;
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

win1 = window.open("contact.php?reasontext=" + customerrecnum + "&customer=" +

customer,"Contact", +
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
document.forms[0].quote_num.value=quotenum;
 //alert(document.forms[0].quoterecnum.value);
}

function onSelectcurrency()
        {

        var aind = document.forms[0].currency1.selectedIndex;
        document.forms[0].currency.value = document.forms[0].currency1[aind].text;
        document.forms[0].salval.value = document.forms[0].currency1[aind].text;

        }
function searchsort_fields()
{
    var ind1 = document.forms[0].salesorder.selectedIndex;
    var ind2 = document.forms[0].salesorder_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].salesorderfl.value = document.forms[0].salesorder[ind1].text;
    document.forms[0].salesorder_oper.value = document.forms[0].salesorder_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}

function checkenter(event)
{
    var ind1 = document.forms[0].salesorder.selectedIndex;
    var ind2 = document.forms[0].salesorder_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].salesorderfl.value = document.forms[0].salesorder[ind1].text;
    document.forms[0].salesorder_oper.value = document.forms[0].salesorder_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}
function GetCRN(rt) {
//alert(rt);
var param = rt;
var winWidth = 1000;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getCIM.php?index="+rt, param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function GetCRN4invoice(ivalue) {

var param = ivalue;
var winWidth = 1000;
var winHeight = 320;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;

var companyrecnum=document.getElementById('companyrecnum').value;
if(document.getElementById('companyrecnum').value.length==0)
{
alert("Please Select A Customer");
  return false;
}
if(document.getElementById('invdate').value.length==0)
{
alert("Please Enter Invoice Date");
  return false;
}
else
{
//alert(companyrecnum);
ponum= "ponum"+ ivalue;
po_qty= "po_qty"+ ivalue;
crn= "crn"+ ivalue;
document.getElementById(po_qty).value=" ";
document.getElementById(ponum).value=" ";
document.getElementById(crn).value=" ";
invdate=document.getElementById('invdate').value;
win1 = window.open("getcim4invoice.php?index="+ivalue+"&companyrecnum="+companyrecnum+"&invdate="+invdate, param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
}
function SetCRNdet(CIMarr,fieldname)
{
 //alert("-********"+CIMarr);
 //alert(document.getElementById('index').value);
var CIMdet = CIMarr.split("|");
var crn = CIMdet[0];
var crnfld = "crn" + fieldname;
//alert(crnfld+"----");
//alert(document.forms[0].elements['crn5'].value);
document.forms[0].elements[crnfld].value = crn

var partnum = CIMdet[1];
var partnumfld = "partnum" + fieldname;
document.forms[0].elements[partnumfld].value = partnum

var rate = CIMdet[3];
var ratefld = "rate" + fieldname;
document.forms[0].elements[ratefld].value = rate

var item_desc = CIMdet[2];
var item_descfld = "item_desc" + fieldname;
document.forms[0].elements[item_descfld].value = item_desc

var type = CIMdet[4];
var typefld = "type" + fieldname;
document.forms[0].elements[typefld].value = type

}


function check_req_fields()
{
	var cofc_num={};	
    var errmsg = '';
    if (document.forms[0].company.value.length == 0)
    { 
         errmsg += 'Please select Customer\n';
    } 
    if (document.forms[0].shippingcompany.value.length == 0)
    {  
         errmsg += 'Please select Customer for Shipping Address \n';
    }
    if (document.forms[0].currency.value.length == 0)
    {
         //errmsg += 'Please enter a value for currency\n';
    }
    if (document.forms[0].invdate.value.length == 0)
    {
         errmsg += 'Please enter invoice date\n';
    }
    if (document.forms[0].fobcf.value.length == 0)
    {
        // errmsg += 'Please enter FOB/C&F value  \n';
    }
	if((document.getElementById('duedate').value !="")&&(document.getElementById('duedate').value !="0000-00-00") && (document.getElementById('invdate').value !="")&&(document.getElementById('invdate').value !="0000-00-00"))
	{
	var date1=document.getElementById('duedate').value.split('-');
	if(date1[2] >0 && date1[2]<10)
	{
	var dueday='0'+date1[2];
	}
	else
	{
	var dueday=date1[2];
	}
	dueyear=date1[0];
	duemonth=date1[1];
	due_date=String(dueyear)+String(duemonth)+String(dueday);

	var date2=document.forms[0].invdate.value.split('-');
	if(date2[2] >0 && date2[2]<10)
	{
	var invday='0'+date2[2];
	}
	else
	{
	var invday=date2[2];
	}
	invyear=date2[0];
	invmonth=date2[1];
	inv_date=String(invyear)+String(invmonth)+String(invday);

	if(inv_date>due_date)
	{
	alert('Invoice Date cannot be Greater Than Due Date');
	return false;
	}
	}
      var x=1;
      var max=document.forms[0].index.value;
      var seq_num=new Array();
	  
      var seqlist = new Array();
      var lipresent = 0;
	
      var ponumArray= [];
      var ponumarr=[];
	  var crnarr =  new Array();
	  var poarr =[];
	  var purcarr  =[];
	  var ponumVal =[] ;

      // var ponumArray= {};

      while (x < max)
	  {		
        ln ="line_num" + x;
        lnv = document.getElementById(ln).value;
		if(lnv == '')
		{
			x++;
			continue;
		}	
        crn = "crn" + x;
        qty= "qty"+ x;
        po_qty = "po_qty" + x;
  		ponum="ponum"+x;
		cofc="cofc"+x;
			  
	 if ((document.getElementById(ln).value =="")&&(document.getElementById(crn).value !=""))
			  {
					//errmsg +='Please enter line number\n';
			  }
           //alert(document.getElementById(po_qty).value+"-------------"+document.getElementById(qty).value);
       if ((document.getElementById(ln).value.length ==0)&& (document.getElementById(crn).value.length ==0)&&(document.getElementById(qty).value.length ==0))
       {
          if(lnv+x ==0)
          {
          break;
          }
       }
	  

       else if (seqlist[lnv] != undefined )
       {
            errmsg +='Duplicate Seq # '+ lnv + '\n';
       }
       else
       {
         
            seqlist[lnv] = lnv;
            var crnval= " ";
            var po_val = " ";
            var purc_qty = " ";

            if  ((document.getElementById(crn).value == "") || (document.getElementById(crn).value == " "))
             {
              
                errmsg += 'Please enter CRN for Seq # '  + lnv + '\n';
             }else{

                 var  crnval = document.getElementById(crn).value;
                
             }
			  // alert(document.getElementById(ponum).value);
		      // if  ((document.getElementById(ponum).value =="") || (document.getElementById(ponum).value ==" "))
        //      {
        //         errmsg += 'Please enter PO No.for Seq # '  + lnv + '\n';
        //      }else{
        //         var po_val = document.getElementById(ponum).value;
             
        //      }
           if ((document.getElementById(qty).value =="") || (document.getElementById(qty).value ==" "))
           {
           errmsg += 'Please enter quantity for Seq # '  + lnv + '\n';
           } else{
              var purc_qty = parseInt(document.getElementById(qty).value);
           
                 
           }     

           if ((document.getElementById(po_qty).value =="") || (document.getElementById(po_qty).value ==" "))
           {
           
           } else{
              var po_qty = parseInt(document.getElementById(po_qty).value);
            
                 
           }   
 
 
     
			 
	   
		 //  array.push(crnarr[lnv]) ;
		 
             // lnpoqty=parseInt(document.getElementById(po_qty).value);
             // lnqty=parseInt(document.getElementById(qty).value);
             lipresent = 1;
             

          if ((crnval != " " )  && (po_val != " " )  && (purc_qty !=" " ) )
           {
      
              // var lnqty=parseInt(document.getElementById(qty).value);
               ponumArray[x]=po_val;
               ponumVal[x]=purc_qty;
         
           }

        }
		
	  crnarr[lnv-1]   = crnval ;  //crnval
	  ponumarr[lnv-1] = po_val   ; //po num 
	  poarr[lnv-1]    = po_qty   ; //po balance quantity value
	  purcarr[lnv-1]  = purc_qty ; //po qty


		var cofcval = document.getElementById(cofc).value;
	
		//alert("cofcval in array is "+cofc_num[cofcval]+'============'+cofcval);
		if(cofcval!='') 
		{
			if (cofcval in cofc_num)
			{
				errmsg += "Duplicate Cofc not allowed";				
			}
			else
		    {
			    cofc_num[cofcval] = cofcval;
		    }
		}
        x++;
    }

		  var porcaddval =0;
		  var flag = 0;
 			for(k=0;k<crnarr.length;k++)
			   {
				 for(j=k+1;j<crnarr.length;j++)  
				 {
					if(crnarr[k] == crnarr[j])
					{
						if(ponumarr[k] == ponumarr[j])
						{		
							porcaddval = purcarr[k] +purcarr[j] ;
							if(porcaddval > poarr[k])
							{
								flag = 1 ;
								errmsg += "Qty should not be Greater than the PO Qty "  + "\n" ;
								break;
							}	
													 
						}	
					}
 				}
					
				if((purcarr[k] > poarr[k]) && flag !=1)
				{
					var l = k + 1 ;
					errmsg += "Qty should not be Greater than the PO Qty for SEQ #" + document.getElementById("line_num" + l).value + "\n"  ;
					break;	
				}
			
			  }
			   
			   
     if (lipresent == 0)
     {
           errmsg += 'At least one line item must be present\n';
     }

   
    var poqty1 = 0;

     if (errmsg == ''){
        return true;
     }
    else
    {
       alert (errmsg);
       return false;
    }
}

function compressArray(original) 
{
	alert(original);
var compressed = [];
// make a copy of the input array
var copy = original.slice(0);
// first loop goes over every element
for (var i = 0; i < original.length; i++) {
var myCount = 0;	
// loop over every element in the copy and see if it's the same
for (var w = 0; w < copy.length; w++) {
	//alert(original[i]+' == '+copy[w]);
if (original[i] == copy[w])
{
// increase amount of times duplicate is found
myCount++;
// sets item to undefined
//delete copy[w];
}
}
/*if (myCount > 0) {
//var a = new Object();
//a.value = original[i];
//a.count = myCount;
//compressed.push(a);
alert("Don't allow Duplicated Cofc");
return false;
}*/
}
return myCount;
}


function printinvoiceDetails(invoicerecnum) {
//printinvoice(w/o raw mtl &tarrif)----printinvoiceDetails
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printinvoice.php?invoicerecnum=" + invoicerecnum, "PrintInvoice",

+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}

function printinvoiceDetails4goodrich(invoicerecnum) {
//printinvoice(w/o raw mtl &tarrif)----printinvoiceDetails
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printinvoiceDetails.php?invoicerecnum=" + invoicerecnum, "PrintInvoice",

+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}


function printInvoicePaymentReport() {
var winWidth = 1200;
var winHeight = 500;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printInvoicePaymentReport.php", "PrintInvoicePaymentReport", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function GetInvXsaction(recno)
{
var winWidth = 650;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("activitylog4InvoicePayment.php?invoicerecnum="+recno, "Payment", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft+",dependent=yes");
}
function GetCustpo(index)
{
//alert("here----");
var recnum4company=document.getElementById('companyrecnum').value;
//alert(recnum4company);

if(document.getElementById('companyrecnum').value.length==0)
{
  alert("Please Select A Customer");
  return false;
}
else
{
        crn = "crn" + index;
        type = "type" + index;
        var crn_num=document.getElementById(crn).value;
  //alert(crn_num);
        var type=document.getElementById(type).value;
  //alert(type);
       // alert("here1111111"+crn_num);
        var winWidth = 400;
        var winHeight = 300;
        var winLeft = (screen.width-winWidth)/2;
        var winTop = (screen.height-winHeight)/2;
        win1 = window.open("getcustpo.php?companyrecnum="+recnum4company+"&index="+index+"&crn_num="+crn_num+"&type="+type, "CustPo", +
        "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
        ",width=" + winWidth + ",height=" + winHeight +
        ",top="+winTop+",left="+winLeft+",dependent=yes");


}
}


function setcustpo(custpo,custpoarr,fieldname)
{

  //alert(fieldname+"-----------------------"+custpoarr);
var custdet = custpoarr.split("|");
  /*document.forms[0].customerponum.value = custpo;
  document.forms[0].custporecnum.value = custdet[1];*/
var customerponum = custpo;
var customerponumfld = "ponum" + fieldname;
document.forms[0].elements[customerponumfld].value = customerponum

var custporecnum = custdet[1];
var custporecnumfld = "custporecnum" + fieldname;
document.forms[0].elements[custporecnumfld].value = custporecnum
//alert(custdet[3]+"-----------");
var custpo_qty = custdet[3];
var custpo_qtyfld = "po_qty" + fieldname;
document.forms[0].elements[custpo_qtyfld].value = custpo_qty



}

function setpo4invoice(index)
{
  ponum= "ponum"+ index;
  po_qty= "po_qty"+ index;
 document.getElementById(po_qty).value=" ";
 document.getElementById(ponum).value=" ";

}

function onSelectfob(fobcf)
{

	document.getElementById('fobcf').value = fobcf.value;

	//alert(fobcf.value);

	//alert(document.getElementById('fobcf').value);
     return true;
}

function onSelectcur(currency)
{

	document.getElementById('currency').value = currency.value;

	//alert(status.value);

	//alert(document.getElementById('currency').value);
     return true;
}

function entercustinv()
{  //alert("HERE");
 var winWidth = 650;
 var winHeight = 300;
 var winLeft = (screen.width-winWidth)/2;
 var winTop = (screen.height-winHeight)/2;
 win1 = window.open("getcustinv4inv.php", "CustInv", +
 "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
 ",width=" + winWidth + ",height=" + winHeight +
 ",top="+winTop+",left="+winLeft+",dependent=yes");
}

function check4invnum()
{  //alert("HERE");
  if(document.getElementById('custinvnum').value.length==0)
  {
     alert("Please Enter A Cust Invoice Number.");
     return false;
  }
}

function printcustinvoiceDetails(invoicerecnum) {
//printinvoice(w/o raw mtl &tarrif)----printinvoiceDetails
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("custinvoicePrint.php?invoicerecnum=" + invoicerecnum, "PrintCustInvoice",

+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}

function check_req_fields_new()
{
	 var cofc_num={};	
    var errmsg = '';
     if (document.forms[0].company.value.length == 0)
    { 
         errmsg += 'Please select Customer\n';
    } 
    if (document.forms[0].shippingcompany.value.length == 0)
    {  
         errmsg += 'Please select Customer for Shipping Address \n';
    } 

    if (document.forms[0].currency.value.length == 0)
    {
         //errmsg += 'Please enter a value for currency\n';
    }
    if (document.forms[0].invdate.value.length == 0)
    {
         errmsg += 'Please enter invoice date\n';
    }

        if (document.forms[0].fobcf.value.length == 0)
    {
        // errmsg += 'Please enter FOB/C&F value  \n';
    }
    

if((document.getElementById('duedate').value !="")&&(document.getElementById('duedate').value !="0000-00-00") && (document.getElementById('invdate').value !="")&&(document.getElementById('invdate').value !="0000-00-00"))
{
var date1=document.getElementById('duedate').value.split('-');
if(date1[2] >0 && date1[2]<10)
{
var dueday='0'+date1[2];
}
else
{
var dueday=date1[2];
}
dueyear=date1[0];
duemonth=date1[1];
due_date=String(dueyear)+String(duemonth)+String(dueday);

var date2=document.forms[0].invdate.value.split('-');
if(date2[2] >0 && date2[2]<10)
{
var invday='0'+date2[2];
}
else
{
var invday=date2[2];
}
invyear=date2[0];
invmonth=date2[1];
inv_date=String(invyear)+String(invmonth)+String(invday);

if(inv_date>due_date)
{
alert('Invoice Date cannot be Greater Than Due Date');
return false;
}
}
      var x=1;
      var max=document.forms[0].index.value;
      var seq_num=new Array();
	  
      var seqlist = {};
      var lipresent = 0;
	
      while (x < max)
	  {		
        ln ="line_num" + x;

        lnv = document.getElementById(ln).value;
        crn = "crn" + x;
        qty= "qty"+ x;
        po_qty= "po_qty"+ x;
  		num="ponum"+x;
   	    cofc="cofc"+x;

		
         if ((document.getElementById(ln).value.length ==0)&& (document.getElementById(crn).value.length ==0)&&(document.getElementById(qty).value.length ==0))
         {
            if(lnv+x ==0)
            {
            break;
            }
         }

       else if (seqlist[lnv] != undefined )
       {
            errmsg +='Duplicate Seq # '+ lnv + '\n';
       }
       else
       {
           seqlist[lnv] = lnv;
            if  ((document.getElementById(crn).value ==""))
             {
                errmsg += 'Please enter CRN for Seq # '  + lnv + '\n';
             }
		     if  ((document.getElementById(ponum).value ==''))
             {
                errmsg += 'Please enter PO No.for Seq # '  + lnv + '\n';
             }
             if (document.getElementById(qty).value =="")
             {
             errmsg += 'Please enter quantity for Seq # '  + lnv + '\n';
             }          
             lnpoqty = parseInt(document.getElementById(po_qty).value);
             lnqty = parseInt(document.getElementById(qty).value);
             lipresent = 1;
        }

   


		var cofcval = document.getElementById(cofc).value;
		
		//alert("cofcval in array is "+cofc_num[cofcval]+'============'+cofcval);
		if(cofcval !='')
		{
		if (cofcval in cofc_num)
		{
			errmsg += "Duplicate Cofc not allowed";				
		}
		else
		{
			cofc_num[cofcval] = cofcval;
		}
		 }
          x++;
    }	


    if (lipresent == 0)
       {
             errmsg += 'At least one line item must be present\n';
       }

     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}

function getcofc(index)
{
        crn = "crn" + index;
        type = "type" + index;
        var crn_num=document.getElementById(crn).value;
        //alert(crn_num);
        var cofctype=document.getElementById(type).value;
		//var invnum=document.getElementById('invoicerecnum').value;
       //alert("cofc type is "+cofctype);
       // alert("here1111111"+crn_num);
	   if(crn_num=="")
	{
       alert("Please Enter CRN");
	   return false;
	}else
	{
        var winWidth = 400;
        var winHeight = 300;
        var winLeft = (screen.width-winWidth)/2;
        var winTop = (screen.height-winHeight)/2;
        win1 = window.open("getcofc.php?crn_num="+crn_num+"&index="+index+"&cofctype="+cofctype, "Cofc", +
        "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
        ",width=" + winWidth + ",height=" + winHeight +
        ",top="+winTop+",left="+winLeft+",dependent=yes");

	}

}

function setcofc(cofc,cofcarr,fieldname)
{
  //alert(fieldname+"-----------------------"+custpoarr);
var cofcdet = cofcarr.split("|");
  /*document.forms[0].customerponum.value = custpo;
  document.forms[0].custporecnum.value = custdet[1];*/
var cofcnum = cofcdet[0];
var cofcnumfld = "cofc" + fieldname;
document.forms[0].elements[cofcnumfld].value = cofcnum

var disp_qty = cofcdet[1];
var cofc_qtyfld = "qty" + fieldname;
document.forms[0].elements[cofc_qtyfld].value = disp_qty
}

function getcofc_edit(index)
{
        crn = "crn" + index;
        type = "type" + index;
        var crn_num=document.getElementById(crn).value;
      // alert(crn_num);
        var cofctype=document.getElementById(type).value;
		var invnum=document.getElementById('invoicerecnum').value;
  //alert(type);+"&invnum="+invnum
       // alert("here1111111"+crn_num);
	   if(crn_num=="")
	{
       alert("Please Enter CRN");
	   return false;
	}else
	{
        var winWidth = 400;
        var winHeight = 300;
        var winLeft = (screen.width-winWidth)/2;
        var winTop = (screen.height-winHeight)/2;
        win1 = window.open("getcofc_edit.php?crn_num="+crn_num+"&index="+index
			+"&invnum="+invnum+"&cofctype="+cofctype, "Cofc", +
        "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
        ",width=" + winWidth + ",height=" + winHeight +
        ",top="+winTop+",left="+winLeft+",dependent=yes");

	}

}