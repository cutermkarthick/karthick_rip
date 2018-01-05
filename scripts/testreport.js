/*
 * qualityplan.js
 * validation for qualityplan
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
*/

function putfocus()
{
   document.forms[0].company.focus();
}


function ConfirmDelete() {
     document.forms[0].deleteflag.value = "y";
     return true;
}

function addRowchem(id,index){
var x=index;

cc_lineno="cc_lineno" +index;
cc_constituents="cc_constituents" +index;
cc_standard_min="cc_standard_min" +index;
cc_standard_max="cc_standard_max" +index;
cc_supplier_min="cc_supplier_min" +index;
cc_supplier_max="cc_supplier_max" +index;
cc_report_lab="cc_report_lab" +index;
cc_remarks="cc_remarks" +index;

//alert(qty);
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";


var cell1 = document.createElement("TD");

var inp1 = document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","10");
inp1.setAttribute("name",cc_lineno);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","20");
inp2.setAttribute("name",cc_constituents);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","20");
inp3.setAttribute("name",cc_standard_min);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 = document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","20");
inp4.setAttribute("name",cc_standard_max);
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","20");
inp5.setAttribute("name",cc_supplier_min);
cell5.appendChild(inp5);

var cell6 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","20");
inp6.setAttribute("name",cc_supplier_max);
cell6.appendChild(inp6);

var cell7 = document.createElement("TD");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","20");
inp7.setAttribute("name",cc_report_lab);
cell7.appendChild(inp7);

var cell8 = document.createElement("TD");
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","20");
inp8.setAttribute("name",cc_remarks);
cell8.appendChild(inp8);

row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell8);
tbody.appendChild(row);
x++;
document.forms[0].index.value=x;
document.forms[0].curindex.value=x;
}

function addRow4editchem(id,index){
var x=index;

prevlinenum="cc_prevlineno"+index;
lirecnum="cc_lirecnum"+index;

cc_lineno="cc_lineno" +index;
cc_constituents="cc_constituents" +index;
cc_standard_min="cc_standard_min" +index;
cc_standard_max="cc_standard_max" +index;
cc_supplier_min="cc_supplier_min" +index;
cc_supplier_max="cc_supplier_max" +index;
cc_report_lab="cc_report_lab" +index;
cc_remarks="cc_remarks" +index;

//alert(qty);
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";


var cell1 = document.createElement("TD");

var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","10");
inp1.setAttribute("name",cc_lineno);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","20");
inp2.setAttribute("name",cc_constituents);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","20");
inp3.setAttribute("name",cc_standard_min);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","20");
inp4.setAttribute("name",cc_standard_max);
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","20");
inp5.setAttribute("name",cc_supplier_min);
cell5.appendChild(inp5);

var cell6 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","20");
inp6.setAttribute("name",cc_supplier_max);
cell6.appendChild(inp6);

var cell7 = document.createElement("TD");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","20");
inp7.setAttribute("name",cc_report_lab);
cell7.appendChild(inp7);

var cell8 = document.createElement("TD");
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","20");
inp8.setAttribute("name",cc_remarks);
cell8.appendChild(inp8);

var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","hidden");
inp9.setAttribute("value","");
inp9.setAttribute("name",prevlinenum);

var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","hidden");
inp10.setAttribute("value","");
inp10.setAttribute("name",lirecnum);


row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell8);
row.appendChild(inp9);
row.appendChild(inp10);
tbody.appendChild(row);
x++;
document.forms[0].index.value=x;
document.forms[0].curindex.value=x;
}



function addRowmach(id,mpindex){
//alert(mpindex)
var x=mpindex;

mp_lineno="mp_lineno" +mpindex;
mp_constituents="mp_constituents" +mpindex;
mp_standard_min="mp_standard_min" +mpindex;
mp_standard_max="mp_standard_max" +mpindex;
mp_supplier_min="mp_supplier_min" +mpindex;
mp_supplier_max="mp_supplier_max" +mpindex;
mp_report_lab="mp_report_lab" +mpindex;
mp_remarks="mp_remarks" +mpindex;

//alert(qty);
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";


var cell1 = document.createElement("TD");

var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","10");
inp1.setAttribute("name",mp_lineno);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","20");
inp2.setAttribute("name",mp_constituents);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","20");
inp3.setAttribute("name",mp_standard_min);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","20");
inp4.setAttribute("name",mp_standard_max);
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","20");
inp5.setAttribute("name",mp_supplier_min);
cell5.appendChild(inp5);

var cell6 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","20");
inp6.setAttribute("name",mp_supplier_max);
cell6.appendChild(inp6);

var cell7 = document.createElement("TD");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","20");
inp7.setAttribute("name",mp_report_lab);
cell7.appendChild(inp7);

var cell8 = document.createElement("TD");
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","20");
inp8.setAttribute("name",mp_remarks);
cell8.appendChild(inp8);

row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell8);

tbody.appendChild(row);
x++;
document.forms[0].mpindex.value=x;
document.forms[0].curindex.value=x;
}


function addRow4editmach(id,mpindex){
var x=mpindex;

prevlinenum="mp_prevlineno"+mpindex;
lirecnum="mp_lirecnum"+mpindex;

mp_lineno="mp_lineno" +mpindex;
mp_constituents="mp_constituents" +mpindex;
mp_standard_min="mp_standard_min" +mpindex;
mp_standard_max="mp_standard_max" +mpindex;
mp_supplier_min="mp_supplier_min" +mpindex;
mp_supplier_max="mp_supplier_max" +mpindex;
mp_report_lab="mp_report_lab" +mpindex;
mp_remarks="mp_remarks" +mpindex;

//alert(qty);
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";


var cell1 = document.createElement("TD");

var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","10");
inp1.setAttribute("name",mp_lineno);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","20");
inp2.setAttribute("name",mp_constituents);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","20");
inp3.setAttribute("name",mp_standard_min);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","20");
inp4.setAttribute("name",mp_standard_max);
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","20");
inp5.setAttribute("name",mp_supplier_min);
cell5.appendChild(inp5);

var cell6 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","20");
inp6.setAttribute("name",mp_supplier_max);
cell6.appendChild(inp6);

var cell7 = document.createElement("TD");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","20");
inp7.setAttribute("name",mp_report_lab);
cell7.appendChild(inp7);

var cell8 = document.createElement("TD");
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","20");
inp8.setAttribute("name",mp_remarks);
cell8.appendChild(inp8);

var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","hidden");
inp9.setAttribute("value","");
inp9.setAttribute("name",prevlinenum);

var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","hidden");
inp10.setAttribute("value","");
inp10.setAttribute("name",lirecnum);


row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell8);
row.appendChild(inp9);
row.appendChild(inp10);
tbody.appendChild(row);

x++;
document.forms[0].mpindex.value=x;
document.forms[0].curindex.value=x;
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

document.forms[0].elements[fieldname].value = dateval;

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

function check_req_fields1()
{
	//alert ('function working');
	//return false;
    var errmsg = '';
    if (document.forms[0].refno.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please enter ref No. \n';
    }

    if (document.forms[0].partno.value.length == 0)
    {
         errmsg += 'Please enter Part no.\n';
    }
    if (document.forms[0].customer.value.length == 0)
    {
         errmsg += 'Please enter Customer\n';
    }
    
    if (document.forms[0].inv_date.value.length == 0)
    {
         errmsg += 'Please enter Inv Date.\n';
    }
    
    if (document.forms[0].rm_receipt_date.value.length == 0)
    {
         errmsg += 'Please enter RM Receipt date.\n';
    }



     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}


function printtestreport(trrecnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printtestreport.php?trrecnum=" + trrecnum, "printtestreport",

+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}
