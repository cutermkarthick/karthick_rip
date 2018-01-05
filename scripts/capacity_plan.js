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


function addRow(id,index){
//alert(index)
var x=index;
linenum="linenum" +index;
tool_details="tool_details" +index;
tool_length="tool_length" +index;
speed="speed" +index;
feed="feed" +index;
opn_desc="opn_desc" +index;
cnc_pgm_name="cnc_pgm_name" +index;

//alert(qty);
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";


var cell1 = document.createElement("TD");

var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","15");
inp1.setAttribute("name",linenum);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","15");
inp2.setAttribute("name",tool_details);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","15");
inp3.setAttribute("name",tool_length);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","15");
inp4.setAttribute("name",speed);
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","15");
inp5.setAttribute("name",feed);
cell5.appendChild(inp5);

var cell6 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","15");
inp6.setAttribute("name",opn_desc);
cell6.appendChild(inp6);

var cell7 = document.createElement("TD");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","15");
inp7.setAttribute("name",cnc_pgm_name);
cell7.appendChild(inp7);

row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell6);
row.appendChild(cell7);
tbody.appendChild(row);
x++;
document.forms[0].index.value=x;
document.forms[0].curindex.value=x;
}

function addRow4edit(id,index){
var x=index;
prevlinenum="prevlinenum"+index;
lirecnum="lirecnum"+index;

sl_num="sl_num" +index;
drawing_dim="drawing_dim" +index;
measuring_istrument="measuring_istrument" +index;
samplesize="samplesize" +index;
remarks="remarks" +index;

var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.setAttribute("bgcolor","#FFFFFF");

var cell1 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","10");
inp1.setAttribute("name",sl_num);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","20");
inp2.setAttribute("name",drawing_dim);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","20");
inp3.setAttribute("name",measuring_istrument);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","20");
inp4.setAttribute("name",samplesize);
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","20");
inp5.setAttribute("name",remarks);
cell5.appendChild(inp5);

var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","hidden");
inp6.setAttribute("value","");
inp6.setAttribute("name",prevlinenum);

var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","hidden");
inp7.setAttribute("value","");
inp7.setAttribute("name",lirecnum);

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
    if (document.forms[0].opnrefnum.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please enter Opn ref No. \n';
    }

    if (document.forms[0].drgissue.value.length == 0)
    {
         errmsg += 'Please enter drgissue\n';
    }
    if (document.forms[0].workcentre.value.length == 0)
    {
         errmsg += 'Please enter Workcentre\n';
    }



     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}


function printcapacity_plan(capacity_planrecnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printcapacity_plan.php?capacity_planrecnum=" + capacity_planrecnum, "printcapacity_plan",
+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}
