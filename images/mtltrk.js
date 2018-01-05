/*
 * qualityplan.js
 * validation for qualityplan
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
*/

function ConfirmDelete() {
     document.forms[0].deleteflag.value = "y";
     return true;
}


function addRow(id,index,mtllink){
//alert(index)
var x=index;
var link = mtllink;
//alert(mtllink);

invnum="invnum" +index;
invdate="invdate" +index;
invqty="invqty" +index;
supdel_date="supdel_date" +index;
paydue_date="paydue_date" +index;
partnum="partnum" +index;
payexp_date="payexp_date" +index;
pick_date="pick_date" +index;
sail_date="sail_date" +index;
eda="eda" +index;
aad="aad" +index;
expclr_date="expclr_date" +index;
cfdel_date="cfdel_date" +index;
link2mtltracker="link2mtltracker" +index;

//alert(qty);
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");
var inp13 =  document.createElement("INPUT");
inp13.setAttribute("type","hidden");
inp13.setAttribute("size","7");
inp13.setAttribute("name",partnum);
inp13.setAttribute("id",partnum);
cell1.appendChild(inp13);

var cell2 = document.createElement("TD");
var inp14 =  document.createElement("INPUT");
inp14.setAttribute("type","hidden");
inp14.setAttribute("size","7");
inp14.setAttribute("name",link2mtltracker);
inp14.setAttribute("id",link2mtltracker);
inp14.setAttribute("value",mtllink);
cell2.appendChild(inp14);
//alert(link2mtltracker);

var cell3 = document.createElement("TD");

var cell4 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","7");
inp1.setAttribute("name",invnum);
cell4.appendChild(inp1);

var cell5 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","7");
inp2.setAttribute("name",invdate);
inp2.setAttribute("id",invdate);
inp2.onfocus = function(){fPopCalendar1(invdate,invdate);};
cell5.appendChild(inp2);

var cell6 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","7");
inp3.setAttribute("name",invqty);
cell6.appendChild(inp3);

var cell7 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","7");
inp4.setAttribute("name",supdel_date);
inp4.setAttribute("id",supdel_date);
inp4.onfocus = function(){fPopCalendar1(supdel_date,supdel_date);};
cell7.appendChild(inp4);

var cell8 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","7");
inp5.setAttribute("name",paydue_date);
inp5.setAttribute("id",paydue_date);
inp5.onfocus = function(){fPopCalendar1(paydue_date,paydue_date);};
cell8.appendChild(inp5);

var cell9 = document.createElement("TD");

var cell10 = document.createElement("TD");
/*
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","7");
inp6.setAttribute("name",payexp_date);
inp6.setAttribute("id",payexp_date);
inp6.onfocus = function(){fPopCalendar1(payexp_date,payexp_date);};
cell10.appendChild(inp6);        */

var cell11 = document.createElement("TD");
/*
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","7");
inp7.setAttribute("name",pick_date);
inp7.setAttribute("id",pick_date);
inp7.onfocus = function(){fPopCalendar1(pick_date,pick_date);};
cell11.appendChild(inp7);     */

var cell12 = document.createElement("TD");
/*
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","7");
inp8.setAttribute("name",sail_date);
inp8.setAttribute("id",sail_date);
inp8.onfocus = function(){fPopCalendar1(sail_date,sail_date);};
cell12.appendChild(inp8);     */

var cell13 = document.createElement("TD");
/*
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","7");
inp9.setAttribute("name",eda);
inp9.setAttribute("id",eda);
inp9.onfocus = function(){fPopCalendar1(eda,eda);};
cell13.appendChild(inp9);       */

var cell14 = document.createElement("TD");
/*
var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","7");
inp10.setAttribute("name",aad);
inp10.setAttribute("id",aad);
inp10.onfocus = function(){fPopCalendar1(aad,aad);};
cell14.appendChild(inp10); */

var cell15 = document.createElement("TD");
/*
var inp11 =  document.createElement("INPUT");
inp11.setAttribute("type","text");
inp11.setAttribute("size","7");
inp11.setAttribute("name",expclr_date);
inp11.setAttribute("id",expclr_date);
inp11.onfocus = function(){fPopCalendar1(expclr_date,expclr_date);};
cell15.appendChild(inp11);   */

var cell16 = document.createElement("TD");
/*
var inp12 =  document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","7");
inp12.setAttribute("name",cfdel_date);
inp12.setAttribute("id",cfdel_date);
inp12.onfocus = function(){fPopCalendar1(cfdel_date,cfdel_date);};
cell16.appendChild(inp12);  */




/*
var cell10 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","7");
inp6.setAttribute("name",payexp_date);
cell10.appendChild(inp6);

var cell11 = document.createElement("TD");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","7");
inp7.setAttribute("name",pick_date);
cell11.appendChild(inp7);

var cell12 = document.createElement("TD");
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","7");
inp8.setAttribute("name",sail_date);
cell12.appendChild(inp8);

var cell13 = document.createElement("TD");
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","7");
inp9.setAttribute("name",eda);
cell13.appendChild(inp9);

var cell14 = document.createElement("TD");
var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","7");
inp10.setAttribute("name",aad);
cell14.appendChild(inp10);

var cell15 = document.createElement("TD");
var inp11 =  document.createElement("INPUT");
inp11.setAttribute("type","text");
inp11.setAttribute("size","7");
inp11.setAttribute("name",expclr_date);
cell15.appendChild(inp11);

var cell16 = document.createElement("TD");
var inp10 =  document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","7");
inp12.setAttribute("name",cfdel_date);
cell16.appendChild(inp12);   */

row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell8);
row.appendChild(cell9);
row.appendChild(cell10);
row.appendChild(cell11);
row.appendChild(cell12);
row.appendChild(cell13);
row.appendChild(cell14);
row.appendChild(cell15);
row.appendChild(cell16);
tbody.appendChild(row);
x++;
document.forms[0].index.value=x;

}



function GetDate(rt) {
alert(rt);
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
//alert('hi');
win1 = window.open("getcalendar.php",param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
//alert('hai');
}

function SetDate(dateval,fieldname) {
//alert(document.forms[0].elements[fieldname]);
//name=document.getElementById(fieldname);
var text= document.getElementById(fieldname);
text.value=dateval;
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


function displayActivityLog() {
var winWidth = 650;
var winHeight = 550;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("mtl_act_log.php", "Shipment", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}

function printmtltrk(mtltrkrecnum) {

alert('hi');
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printmtltrk.php?mtltrkrecnum=" + mtltrkrecnum, "printmtltrk",
+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}
