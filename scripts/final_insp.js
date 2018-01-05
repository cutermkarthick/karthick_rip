/*
 * final_insp.js
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
var x=index;

slno="slno" +index;
sheet="sheet" +index;
map="map" +index;
main_view="main_view" +index;
actual_dim1="actual_dim1" +index;
actual_dim2="actual_dim2" +index;
actual_dim3="actual_dim3" +index;
accpt_reject="accpt_reject" +index;

//alert(qty);
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";


var cell1 = document.createElement("TD");

var inp1 = document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size",'10');
inp1.setAttribute("name",slno);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","10");
inp2.setAttribute("name",sheet);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","15");
inp3.setAttribute("name",map);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 = document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","10");
inp4.setAttribute("name",main_view);
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","10");
inp5.setAttribute("name",actual_dim1);
cell5.appendChild(inp5);

var cell6 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","10");
inp6.setAttribute("name",actual_dim2);
cell6.appendChild(inp6);

var cell7 = document.createElement("TD");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","10");
inp7.setAttribute("name",actual_dim3);
cell7.appendChild(inp7);

var cell8 = document.createElement("TD");
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","10");
inp8.setAttribute("name",accpt_reject);
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

function check_req_fields()
{
	//alert ('function working');
	//return false;
    var errmsg = '';
    if (document.forms[0].refnum.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please enter ref No. \n';
    }

    if (document.forms[0].wonum.value.length == 0)
    {
         errmsg += 'Please enter WO No.\n';
    }
    if (document.forms[0].customer.value.length == 0)
    {
         errmsg += 'Please enter Customer\n';
    }

    if (document.forms[0].billdate.value.length == 0)
    {
         errmsg += 'Please enter Bill Date.\n';
    }

    if (document.forms[0].billnum.value.length == 0)
    {
         errmsg += 'Please enter Bill Num.\n';
    }

     if (document.forms[0].ponum.value.length == 0)
    {
         errmsg += 'Please enter PO Num.\n';
    }
    if(document.getElementById('slnum1').value == '')
    {
         errmsg += 'Please enter Sl No.\n';
    }
     if (document.forms[0].slno1.value.length == 0)
    {
         //alert("working");
         errmsg += 'Please enter at least one Final Inspection  line Item.\n';
    }



    if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}


function printfinal_insp(final_insprecnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printfinal_insp.php?final_insprecnum=" + final_insprecnum, "printfinal_insp",
+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}



function Getwo_qa() {

//alert('working');
var winWidth = 700;
var winHeight = 300;
//alert(screen.width)
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getwo4qa.php","aa", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}
function Setwo_qa(CIM,CIMarr,fieldname) {

//alert(fieldname);
//alert(document.forms[0].elements[fieldname + "recnum"]);
var CIM = CIM.split("|");
document.getElementById('wonum').value = CIM[0];
document.getElementById('refnum').value = CIM[1];
document.getElementById('customer').value = CIM[2];
document.getElementById('ponum').value = CIM[3];
document.getElementById('partnum').value = CIM[4];
document.getElementById('partname').value = CIM[5];

}

