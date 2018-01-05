/*
 * advlic.js
 * validation for Advance License
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
*/

function GetlicDate(rt) {

//alert('hi');
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

fn = document.getElementById(fieldname);
//alert(fn);
fn.value = dateval;
}

function GetCIM(rt) {
//alert(rt);
var param = rt;
var winWidth = 1000;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getCIM.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}


function SetCIM(CIM,fieldname) {
   //alert(CIM);
   //var fieldname=6;
   //alert(fieldname);
   var CIM = CIM.split("|");

   var id1="partnum"+ fieldname;
   var text1= document.getElementById(id1);
   text1.value=CIM[4];

   var id2="partname"+ fieldname;
   var text2= document.getElementById(id2);
   text2.value=CIM[1];

   var id3="crn"+ fieldname;
   var text3= document.getElementById(id3);
   text3.value=CIM[9];
   
   var id4="rm_spec"+ fieldname;
   var text4= document.getElementById(id4);
   text4.value=CIM[12];

}

function addRow(id,index){
//alert(index);
var x=index;
var y = index;
//alert(y);
line_num="line_num"+index;
//itemnum="itemnum"+index;
partnum="partnum"+index;
partname="partname"+index;
crn="crn"+index;
qtytomake="qtytomake"+index;
qtyimported="qtyimported"+index;
beno="be_no"+index;
assmnt_val="assesmnt_value"+index;
cif_val="cif_value"+index;
rate="rate"+index;
tariff="tariff"+index;
wastage="wastage"+index;
rm_size="rm_size"+index;
rm_spec="rm_spec"+index;
//alert(qty);
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

prevlinenum = "prev_line_num" + index;
lirecnum = "lirecnum" + index;


var cell1 = document.createElement("TD");
cell1.setAttribute("align","left");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","2");
inp1.setAttribute("name",line_num);
inp1.setAttribute("id",line_num);
cell1.appendChild(inp1);

/*var cell2 = document.createElement("TD");
cell2.setAttribute("align","left");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","10");
inp2.setAttribute("name",itemnum);
inp2.setAttribute("id",itemnum);
cell2.appendChild(inp2);*/

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("readOnly","true");
cell3.setAttribute("align","left");
inp3.setAttribute("size","18");
inp3.setAttribute("name",partnum);
inp3.setAttribute("id",partnum);
inp3.style.backgroundColor = "#DDDDDD";
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
cell4.setAttribute("align","left");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("readOnly","true");
inp4.setAttribute("size","18");
inp4.setAttribute("name",partname);
inp4.setAttribute("id",partname);
inp4.style.backgroundColor = "#DDDDDD";
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
cell5.setAttribute("align","left");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("readOnly","true");
inp5.setAttribute("size","10");
inp5.setAttribute("name",crn);
inp5.setAttribute("id",crn);
inp5.style.backgroundColor = "#DDDDDD";
cell5.appendChild(inp5);


var cell5image = document.createElement("IMAGE");
cell5image.setAttribute("src","images/bu-get.gif");
cell5image.onclick= function() {
GetCIM(y);
};
cell5.appendChild(cell5image);

var inp10 = document.createElement("INPUT");
inp10.setAttribute("type","hidden");
inp10.setAttribute("value","");
inp10.setAttribute("name",prevlinenum);
inp10.setAttribute("id",prevlinenum);
cell5.appendChild(inp10);

var inp11 = document.createElement("INPUT");
inp11.setAttribute("type","hidden");
inp11.setAttribute("value","");
inp11.setAttribute("name",lirecnum);
inp11.setAttribute("id",lirecnum);
cell5.appendChild(inp11)

var cell9 = document.createElement("TD");
cell9.setAttribute("align","left");
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","5");
inp9.setAttribute("name",assmnt_val);
inp9.setAttribute("id",assmnt_val);
cell9.appendChild(inp9);

var cell6 = document.createElement("TD");
cell6.setAttribute("align","left");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","5");
inp6.setAttribute("name",qtytomake);
inp6.setAttribute("id",qtytomake);
cell6.appendChild(inp6);

var cell7 = document.createElement("TD");
cell7.setAttribute("align","left");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","5");
inp7.setAttribute("name",qtyimported);
inp7.setAttribute("id",qtyimported);
cell7.appendChild(inp7);

var cell8 = document.createElement("TD");
cell8.setAttribute("align","left");
var inp8 = document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","5");
inp8.setAttribute("name",beno);
inp8.setAttribute("id",beno);
cell8.appendChild(inp8);

var cell12 = document.createElement("TD");
cell12.setAttribute("align","left");
var inp12 = document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","5");
inp12.setAttribute("name",tariff);
inp12.setAttribute("id",tariff);
cell12.appendChild(inp12);

var cell15 = document.createElement("TD");
cell15.setAttribute("align","left");
var inp15 = document.createElement("INPUT");
inp15.setAttribute("type","text");
inp15.setAttribute("size","5");
inp15.setAttribute("name",wastage);
inp15.setAttribute("id",wastage);
cell15.appendChild(inp15);

var cell16 = document.createElement("TD");
cell16.setAttribute("align","left");
var inp16 = document.createElement("INPUT");
inp16.setAttribute("type","text");
inp16.setAttribute("size","5");
inp16.setAttribute("name",cif_val);
inp16.setAttribute("id",cif_val);
cell16.appendChild(inp16);

var cell17 = document.createElement("TD");
cell17.setAttribute("align","left");
var inp17 = document.createElement("INPUT");
inp17.setAttribute("type","text");
inp17.setAttribute("size","5");
inp17.setAttribute("name",rate);
inp17.setAttribute("id",rate);
cell17.appendChild(inp17);


var cell13 = document.createElement("TD");
cell13.setAttribute("align","left");
var inp13 = document.createElement("INPUT");
inp13.setAttribute("type","text");
inp13.setAttribute("size","10");
inp13.setAttribute("name",rm_size);
inp13.setAttribute("id",rm_size);
cell13.appendChild(inp13);

var cell14 = document.createElement("TD");
cell14.setAttribute("align","left");
var inp14 = document.createElement("INPUT");
inp14.setAttribute("type","text");
inp14.setAttribute("readOnly","true");
inp14.setAttribute("size","16");
inp14.setAttribute("name",rm_spec);
inp14.setAttribute("id",rm_spec);
inp14.style.backgroundColor = "#DDDDDD";
cell14.appendChild(inp14);


row.appendChild(cell1);
//row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell14);
row.appendChild(cell5);
row.appendChild(cell13);
row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell8);
row.appendChild(cell9);
row.appendChild(cell16);
row.appendChild(cell17);
row.appendChild(cell12);
row.appendChild(cell15);
tbody.appendChild(row);
x++;
//alert("i am here");
document.forms[0].index.value = x;
}


function check_req_fields1()
{

	//return false;
    var lipresent = 0;
    var errmsg = '';
    var x = 1;

    if (document.forms[0].adv_lic_no.value.length == 0)
    {
         errmsg += 'Please enter Advance License No.\n';
    }

    if (document.forms[0].licdate.value.length == 0)
    {
         errmsg += 'Please enter License Date\n';
    }
    var ind = document.forms[0].index.value;
    //alert(ind);
    for(i=1; i<ind; i++)
    {

       ln = "line_num" + x;
       lnv = document.getElementById(ln).value;
       if (document.getElementById(ln).value.length != 0)
       {

           //itemnum = "itemnum" + x;
          // if (document.getElementById(itemnum).value.length == 0)
           //{
             //  errmsg += 'Please enter Item Num for line item ' + lnv + '\n';
           //}
           partnum = "partnum" + x;
           if (document.getElementById(partnum).value.length == 0)
           {
               errmsg += 'Please enter Partnum for line item ' + lnv + '\n';
           }
	       partname = "partname" + x;
	       if (document.getElementById(partname).value.length == 0)
           {
               errmsg += 'Please enter Partname for line item ' + lnv + '\n';
           }
           rm_spec = "rm_spec" + x;
           if (document.getElementById(rm_spec).value.length == 0)
           {
               errmsg += 'Please enter R.M Spec for line item ' + lnv + '\n';
           }
           crn = "crn" + x;
	       if (document.getElementById(crn).value.length == 0)
           {
               errmsg += 'Please enter CRN for line item ' + lnv + '\n';
           }
           rm_size = "rm_size" + x;
           if (document.getElementById(rm_size).value.length == 0)
           {
               errmsg += 'Please enter R.M Size for line item ' + lnv + '\n';
           }
           qtytomake = "qtytomake" + x;
	       if (document.getElementById(qtytomake).value.length == 0)
           {
               errmsg += 'Please enter Qty to Make for line item ' + lnv + '\n';
           }
           qtyimported = "qtyimported" + x;
	       if (document.getElementById(qtyimported).value.length == 0)
           {
               errmsg += 'Please enter Qty Imported for line item ' + lnv + '\n';
           }
           impbal = "impbal" + x;
	       if (document.getElementById(impbal).value.length == 0)
           {
               errmsg += 'Please enter Imported Bal for line item ' + lnv + '\n';
           }
           expbal = "expbal" + x;
	       if (document.getElementById(expbal).value.length == 0)
           {
               errmsg += 'Please enter Exported Bal for line item ' + lnv + '\n';
           }
           tariff = "tariff" + x;
	       if (document.getElementById(tariff).value.length == 0)
           {
               errmsg += 'Please enter Tariff for line item ' + lnv + '\n';
           }

          lipresent = 1;
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
