/*
 * bom.js
 * validation for new_bom.php
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
 */

 
/*$(document).ready(function(){
  $("input").keydown(function(){
    $("input").css("background-color","#FFFFCC");
  });
  $("input").keyup(function(){
    $("input").css("background-color","#D6D6FF");
  });
});  */

//alert(b.val());

function check_req_fields()
{

var errmsg = '';


if(document.forms[0].pagename.value!='editbomviewpage')
{ //alert("HERE-----222");
if (document.forms[0].bomnum.value=='')
{
  errmsg +="Please Enter BOM Ref #\n";
}

if (document.forms[0].crn.value=='')
{
  errmsg +="Please Select Assembly CRN\n";
}
if(document.forms[0].pagename.value=='editbompage')
{
 if (document.forms[0].notes.value=='')
{     //alert("HERE---");
  errmsg +="Please Enter Notes\n";
}
}
  var x=1; var y=1;
  var z=1;
      var max=document.forms[0].index_assy.value;
      var max_mfr=document.forms[0].index.value;
      var max_treat=document.forms[0].index_treated.value;

      var seqlist = {};
      var seq_list = {};
      var assli_item=0;
      var mfr_lineitem=0;
      var tr_lineitem=0;
      while(x<max)
      {
        ln ="as_linenum" + x;
        as_qpa="as_qpa"+x;
        as_crn="as_crn"+x;

    master_partiss="master_partiss"+x;
    master_drgiss="master_drgiss"+x;
    master_cos="master_cos"+x;

    as_partiss="as_partiss"+x;
    as_drgiss="as_drgiss"+x;
    as_cos="as_cos"+x;    

        lnv = document.getElementById(ln).value;
        if(document.getElementById(ln).value!='')
       {
        if ((seqlist[lnv] != undefined ))
        {
            errmsg +='Duplicate Seq # '+ lnv + ' (Assembly) \n';

        }
        else
        {
           seqlist[lnv] = lnv;
           if(document.getElementById(as_crn).value =="")
           {
              errmsg += 'Please enter CRN (Assembly) for seq#'+ lnv +'\n';
           }
           if(document.getElementById(as_qpa).value =="")
           {
              errmsg += 'Please enter QPA (Assembly) for seq#'+ lnv +'\n';
           }    



    /*       alert(document.getElementById("ass" + as_partiss).value);
           alert(document.getElementById("master" + master_partiss).value); */     
           if((document.getElementById(as_partiss).value).replace(/[^a-zA-Z0-9]+/g,"").toLowerCase() != (document.getElementById(master_partiss).value).replace(/[^a-zA-Z0-9]+/g,"").toLowerCase() )
       {
              errmsg += 'Part Issue/Attachments(Assembly) not matching with Masterdata for seq#'+ lnv +'\n';
           }
       if(document.getElementById(as_drgiss).value != document.getElementById(master_drgiss).value )
       {
              errmsg += 'DRG Iss(Assembly) not matching with Masterdata DRG Iss for seq#'+ lnv +'\n';
           }
/*           alert(document.getElementById(as_cos).value);
           alert(document.getElementById(master_cos).value);*/
           
        if(document.getElementById(as_cos).value != document.getElementById(master_cos).value )
       {
              errmsg += 'COS(Assembly) not matching with Masterdata COS for seq#'+ lnv +'\n';
           }  
        }
        assli_item = 1;
        }
        x++;
      }
       while(y<max_mfr)
      {

        // alert(max_mfr);

        lnmfr ="linenum" + y;
        qpa="qpa"+y;
        crn="crn"+y;

    partiss="partiss"+y;
    drgiss="drgiss"+y;
    cos="cos"+y;

    maf_partiss="maf_partiss"+y;
    maf_drgiss="maf_drgiss"+y;
    maf_cos="maf_cos"+y;

        lnv_mfr = document.getElementById(lnmfr).value;
        if(document.getElementById(lnmfr).value!='')
       {
       
        if ((seq_list[lnv_mfr] != undefined ))
        {
                  errmsg +='Duplicate Seq # '+ lnv_mfr + ' (Untreated) \n';

        }
        else
        {
           seq_list[lnv_mfr] = lnv_mfr;

           if(document.getElementById(crn).value =="")
           {
              errmsg += 'Please enter CRN (Untreated) for seq#'+ lnv_mfr +'\n';
           }
           if(document.getElementById(qpa).value =="")
           {
              errmsg += 'Please enter QPA (Untreated) for seq#'+ lnv_mfr +'\n';
           }

       if((document.getElementById(partiss).value).replace(/[^a-zA-Z0-9]+/g,"").toLowerCase() != 
                        (document.getElementById(maf_partiss).value ).replace(/[^a-zA-Z0-9]+/g,"").toLowerCase())
       {
              errmsg += 'Part Issue/Attachments(Untreated) not matching with Masterdata for seq#'+ lnv_mfr +'\n';
           }
       if(document.getElementById(drgiss).value != document.getElementById(maf_drgiss).value )
       {
              errmsg += 'DRG Iss(Untreated) not matching with Masterdata DRG Iss for seq#'+ lnv_mfr +'\n';
           }
      if(document.getElementById(cos).value != document.getElementById(maf_cos).value )
     {
              //alert("BOM COs is ="+document.getElementById(cos).value+"*CRN cos is ="+document.getElementById(maf_cos).value+"*");
              errmsg += 'COS(Untreated) not matching Masterdata COS for seq#'+ lnv_mfr +'\n';
           }

        }
        mfr_lineitem = 1;
        }
        y++;
      }

      while(z<max_treat)
      {

         // alert(z);
        // alert(max_treat);
        lntreat ="tr_linenum"+z;
        tr_qpa="tr_qpa"+z;
        tr_crn="tr_crn"+z;
        tr_partiss="tr_partiss"+z;
        tr_drgiss="tr_drgiss"+z;
        tr_cos="tr_cos"+z;
         partiss_tr="partiss_tr"+z;
         drgiss_tr="drgiss_tr"+z;
         cos_tr="cos_tr"+z;
       ln_treat = document.getElementById(lntreat).value;
        
        // alert(ln_treat);
        // alert(document.getElementById(partiss_tr).value);
        if(document.getElementById(lntreat).value!='')
       {
        // alert("Reached");

        if ((seq_list[lntreat] != undefined ))
        {
          // alert(seq_list[lntreat]);
            errmsg +='Duplicate Seq # '+ ln_treat + ' (Treated) \n';

        }
        else
        {

          // alert("reached");
           seq_list[ln_treat] = ln_treat;

           if(document.getElementById(tr_crn).value =="")
           {
              errmsg += 'Please enter CRN (Treated) for seq#'+ ln_treat +'\n';
           }
           if(document.getElementById(tr_qpa).value =="")
           {
              errmsg += 'Please enter QPA (Treated) for seq#'+ ln_treat +'\n';
           }

       if((document.getElementById(tr_partiss).value).replace(/[^a-zA-Z0-9]+/g,"").toLowerCase() != 
                        (document.getElementById(partiss_tr).value ).replace(/[^a-zA-Z0-9]+/g,"").toLowerCase())
       {
              errmsg += 'Part Issue/Attachments(Treated) not matching with Masterdata for seq#'+ ln_treat +'\n';
           }
       if(document.getElementById(tr_drgiss).value != document.getElementById(drgiss_tr).value )
       {
              errmsg += 'DRG Iss(Treated) not matching with Masterdata DRG Iss for seq#'+ ln_treat +'\n';
           }
      if(document.getElementById(tr_cos).value != document.getElementById(cos_tr).value )
     {
              //alert("BOM COs is ="+document.getElementById(cos).value+"*CRN cos is ="+document.getElementById(maf_cos).value+"*");
              errmsg += 'COS(Treated) not matching Masterdata COS for seq#'+ ln_treat +'\n';
           }

        }
        tr_lineitem = 1;
        }
        z++;
      }
}else
{  //alert("HERE---");
  if (document.forms[0].notes.value=='')
{
  errmsg +="Please Enter Notes\n";
}
}

      if (assli_item == 0 && mfr_lineitem ==0 && tr_lineitem ==0 )
    {
         //errmsg += 'At least one line item must be present\n';
    }

     if (errmsg == '')
    {
       // document.forms[0].upload.value = 'database';
        return true;
    }
    else
    {
       alert (errmsg);
       return false;
    }
}


function checkfile()
{
//alert("i am here");
var errmsg = '';
if(document.forms[0].attach.value == '')
{
  errmsg +="File should be selected\n";
}
     if (errmsg == '')
    {
        document.forms[0].upload.value = 'database';
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
   document.forms[0].company.focus();
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
document.forms[0].phone.value = contdet[1];
document.forms[0].email.value = contdet[2];
}

function GetAllEmps(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getboarddes.php?reasontext=" + rt, "Employees", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetEmp(emp,emprecnum) {
document.forms[0].owner.value = emp;
document.forms[0].emprecnum.value = emprecnum;
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

function GetAllaeEmps(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getAllaeEmps.php?reasontext=" + rt, "Employees", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
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
document.forms[0].ae.value = emp;
var empdet = emparr.split("|");
document.forms[0].aerecnum.value = empdet[0];
//alert(document.forms[0].aerecnum.value);
}

function GetAllEmps1(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getallemps.php?reasontext=" + rt, "Employees1", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetEmp1(emp,emparr) {
document.forms[0].se.value = emp;
var empdet = emparr.split("|");
document.forms[0].serecnum.value = empdet[0];
//alert(document.forms[0].serecnum.value);
}

function GetOwner(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getowner.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetOwner(emp,emprecnum,fieldname) {
document.forms[0].elements[fieldname].value = emp;
document.forms[0].elements[fieldname + "recnum"].value = emprecnum;
}

function GetC(rt) {
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
win1 = window.open("getc.php?reasontext=" + customerrecnum + "&customer=" + customer,param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetC(contact,contarr,fieldname) {
var contdet = contarr.split("|");
document.forms[0].contact.value = contact;
document.forms[0].elements[fieldname].value = contact;
document.forms[0].elements[fieldname + "recnum"].value = contdet[0];
}

var inpvendrecnum='';

function addRow(id,index)
{
var x=index;
var y=index;

linenumber="linenum"+index;
itemno="itemno"+index;
partno="partno"+index;
crn="crn"+index;
partname="partname"+index;
partiss="partiss"+index;
drgiss="drgiss"+index;
mpsnum="mpsnum"+index;
mpsrev="mpsrev"+index;
attach="attach"+index;
qpa="qpa"+index;
crn_type="crn_type"+index;
cos="cos"+index;

maf_partiss="maf_partiss"+index;
maf_drgiss="maf_drgiss"+index;
maf_cos="maf_cos"+index;
/*alert(document.getElementById(id).getElementsByTagName("tbody")[0].value);*/

var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
alert(tbody);
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","2");
inp1.setAttribute("name",linenumber);
inp1.setAttribute("id",linenumber);
cell1.appendChild(inp1);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","5");
inp3.setAttribute("name",itemno);
inp3.setAttribute("id",itemno);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","18");
inp4.setAttribute("name",partno);
inp4.setAttribute("id",partno);
inp4.setAttribute("readOnly","true");
inp4.style.backgroundColor = "#DDDDDD";
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","10");
inp5.setAttribute("readOnly","true");
inp5.setAttribute("name",crn);
inp5.setAttribute("id",crn);
inp5.style.backgroundColor = "#DDDDDD";
cell5.appendChild(inp5);

var cell5image = document.createElement("img");
cell5image.setAttribute("src","images/get.gif");
cell5image.onclick= function() {
GetCIM(y);
};
cell5.appendChild(cell5image);



var cell9 = document.createElement("TD");
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","18");
inp9.setAttribute("name",partname);
inp9.setAttribute("id",partname);
inp9.setAttribute("readOnly","true");
inp9.style.backgroundColor = "#DDDDDD";
cell9.appendChild(inp9);

var cell10 = document.createElement("TD");
var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","15");
inp10.setAttribute("name",partiss);
inp10.setAttribute("id",partiss);
//inp10.setAttribute("readOnly","true");
//inp10.style.backgroundColor = "#DDDDDD";
cell10.appendChild(inp10);

var cell11 = document.createElement("TD");
var inp11 =  document.createElement("INPUT");
inp11.setAttribute("type","text");
inp11.setAttribute("size","12");
inp11.setAttribute("name",drgiss);
inp11.setAttribute("id",drgiss);
//inp11.setAttribute("readOnly","true");
//inp11.style.backgroundColor = "#DDDDDD";
cell11.appendChild(inp11);

var cell12 = document.createElement("TD");
var inp12 =  document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","12");
inp12.setAttribute("name",attach);
inp12.setAttribute("id",attach);
cell12.appendChild(inp12);

var cell13 = document.createElement("TD");
var inp13 =  document.createElement("INPUT");
inp13.setAttribute("type","text");
inp13.setAttribute("size","3");
inp13.setAttribute("name",qpa);
inp13.setAttribute("id",qpa);
cell13.appendChild(inp13);

var cell14 = document.createElement("TD");
var inp14 =  document.createElement("INPUT");
inp14.setAttribute("type","text");
inp14.setAttribute("size","9");
inp14.setAttribute("name",mpsnum);
inp14.setAttribute("id",mpsnum);
inp14.setAttribute("readOnly","true");
inp14.style.backgroundColor = "#DDDDDD";
cell14.appendChild(inp14);

var cell15 = document.createElement("TD");
var inp15 =  document.createElement("INPUT");
inp15.setAttribute("type","text");
inp15.setAttribute("size","9");
inp15.setAttribute("name",mpsrev);
inp15.setAttribute("id",mpsrev);
inp15.setAttribute("readOnly","true");
inp15.style.backgroundColor = "#DDDDDD";
cell15.appendChild(inp15);

/*var cell19 = document.createElement("TD");
cell19.setAttribute("align","center");
var inp19 =  document.createElement("INPUT");
inp19.setAttribute("name",crn_type);
inp19.setAttribute("id",crn_type);

if(id=='myTable_subassy')
{
inp19.setAttribute("size","8");
inp19.setAttribute("value","Assembly");
}else
{
inp19.setAttribute("size","10");
inp19.setAttribute("value","Manufacture");
}
inp19.setAttribute("readOnly","true");
inp19.style.backgroundColor = "#DDDDDD";
cell19.appendChild(inp19);*/

var cell20 = document.createElement("TD");
var inp20 =  document.createElement("INPUT");
inp20.setAttribute("type","text");
inp20.setAttribute("size","15");
inp20.setAttribute("name",cos);
inp20.setAttribute("id",cos);
//inp11.setAttribute("readOnly","true");
//inp11.style.backgroundColor = "#DDDDDD";
cell20.appendChild(inp20);

var inp23 = document.createElement("INPUT");
inp23.setAttribute("type","hidden");
inp23.setAttribute("name",maf_partiss);
inp23.setAttribute("id",maf_partiss);

var inp24 = document.createElement("INPUT");
inp24.setAttribute("type","hidden");
inp24.setAttribute("name",maf_drgiss);
inp24.setAttribute("id",maf_drgiss);

var inp25 = document.createElement("INPUT");
inp25.setAttribute("type","hidden");
inp25.setAttribute("name",maf_cos);
inp25.setAttribute("id",maf_cos);

/*var inp14 =  document.createElement("INPUT");
inp14.setAttribute("type","hidden");
inp14.setAttribute("value","");
inp14.setAttribute("name",vendrecnum);
inp14.setAttribute("id",vendrecnum);

var inp15 =  document.createElement("INPUT");
inp15.setAttribute("type","hidden");
inp15.setAttribute("value","");
inp15.setAttribute("name",partrecnum);
inp15.setAttribute("id",partrecnum); */
row.appendChild(cell1);
row.appendChild(cell3);
// row.appendChild(cell19);
row.appendChild(cell5);
row.appendChild(cell4);
//row.appendChild(cell6);
//row.appendChild(cell7);
//row.appendChild(cell8);
row.appendChild(cell9);
row.appendChild(cell10);

row.appendChild(cell20);

row.appendChild(cell11);
row.appendChild(cell14);
row.appendChild(cell15);
//row.appendChild(cell12);
row.appendChild(cell13);

row.appendChild(inp23);
row.appendChild(inp24);
row.appendChild(inp25);

tbody.appendChild(row);
/*row.appendChild(inp14);
row.appendChild(inp15);
tbody.appendChild(row);*/
x++;
document.forms[0].index.value=x;
document.forms[0].curindex.value=x;
}

function addRow_treated(id,index)
{

var x=index;
var y=index;

tr_linenumber="tr_linenum"+index;
tr_itemno="tr_itemno"+index;
tr_partno="tr_partno"+index;
tr_crn="tr_crn"+index;
tr_partname="tr_partname"+index;
tr_partiss="tr_partiss"+index;
tr_drgiss="tr_drgiss"+index;
tr_mpsnum="tr_mpsnum"+index;
tr_mpsrev="tr_mpsrev"+index;
tr_attach="tr_attach"+index;
tr_qpa="tr_qpa"+index;
tr_crn_type="tr_crn_type"+index;
tr_cos="tr_cos"+index;

tr_maf_partiss="tr_maf_partiss"+index;
tr_maf_drgiss="tr_maf_drgiss"+index;
tr_maf_cos="tr_maf_cos"+index;


var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];

var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","2");
inp1.setAttribute("name",tr_linenumber);
inp1.setAttribute("id",tr_linenumber);
cell1.appendChild(inp1);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","5");
inp3.setAttribute("name",tr_itemno);
inp3.setAttribute("id",tr_itemno);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","18");
inp4.setAttribute("name",tr_partno);
inp4.setAttribute("id",tr_partno);
inp4.setAttribute("readOnly","true");
inp4.style.backgroundColor = "#DDDDDD";
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","10");
inp5.setAttribute("readOnly","true");
inp5.setAttribute("name",tr_crn);
inp5.setAttribute("id",tr_crn);
inp5.style.backgroundColor = "#DDDDDD";
cell5.appendChild(inp5);

var cell5image = document.createElement("img");
cell5image.setAttribute("src","images/get.gif");
cell5image.onclick= function() {
GetCIM(y);
};
cell5.appendChild(cell5image);



var cell9 = document.createElement("TD");
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","18");
inp9.setAttribute("name",tr_partname);
inp9.setAttribute("id",tr_partname);
inp9.setAttribute("readOnly","true");
inp9.style.backgroundColor = "#DDDDDD";
cell9.appendChild(inp9);

var cell10 = document.createElement("TD");
var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","15");
inp10.setAttribute("name",tr_partiss);
inp10.setAttribute("id",tr_partiss);
//inp10.setAttribute("readOnly","true");
//inp10.style.backgroundColor = "#DDDDDD";
cell10.appendChild(inp10);

var cell11 = document.createElement("TD");
var inp11 =  document.createElement("INPUT");
inp11.setAttribute("type","text");
inp11.setAttribute("size","12");
inp11.setAttribute("name",tr_drgiss);
inp11.setAttribute("id",tr_drgiss);
//inp11.setAttribute("readOnly","true");
//inp11.style.backgroundColor = "#DDDDDD";
cell11.appendChild(inp11);

var cell12 = document.createElement("TD");
var inp12 =  document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","12");
inp12.setAttribute("name",tr_attach);
inp12.setAttribute("id",tr_attach);
cell12.appendChild(inp12);

var cell13 = document.createElement("TD");
var inp13 =  document.createElement("INPUT");
inp13.setAttribute("type","text");
inp13.setAttribute("size","3");
inp13.setAttribute("name",tr_qpa);
inp13.setAttribute("id",tr_qpa);
cell13.appendChild(inp13);

var cell14 = document.createElement("TD");
var inp14 =  document.createElement("INPUT");
inp14.setAttribute("type","text");
inp14.setAttribute("size","9");
inp14.setAttribute("name",tr_mpsnum);
inp14.setAttribute("id",tr_mpsnum);
inp14.setAttribute("readOnly","true");
inp14.style.backgroundColor = "#DDDDDD";
cell14.appendChild(inp14);

var cell15 = document.createElement("TD");
var inp15 =  document.createElement("INPUT");
inp15.setAttribute("type","text");
inp15.setAttribute("size","9");
inp15.setAttribute("name",tr_mpsrev);
inp15.setAttribute("id",tr_mpsrev);
inp15.setAttribute("readOnly","true");
inp15.style.backgroundColor = "#DDDDDD";
cell15.appendChild(inp15);

/*var cell19 = document.createElement("TD");
cell19.setAttribute("align","center");
var inp19 =  document.createElement("INPUT");
inp19.setAttribute("name",crn_type);
inp19.setAttribute("id",crn_type);

if(id=='myTable_subassy')
{
inp19.setAttribute("size","8");
inp19.setAttribute("value","Assembly");
}else
{
inp19.setAttribute("size","10");
inp19.setAttribute("value","Manufacture");
}
inp19.setAttribute("readOnly","true");
inp19.style.backgroundColor = "#DDDDDD";
cell19.appendChild(inp19);*/

var cell20 = document.createElement("TD");
var inp20 =  document.createElement("INPUT");
inp20.setAttribute("type","text");
inp20.setAttribute("size","15");
inp20.setAttribute("name",tr_cos);
inp20.setAttribute("id",tr_cos);
//inp11.setAttribute("readOnly","true");
//inp11.style.backgroundColor = "#DDDDDD";
cell20.appendChild(inp20);

var inp23 = document.createElement("INPUT");
inp23.setAttribute("type","hidden");
inp23.setAttribute("name",tr_maf_partiss);
inp23.setAttribute("id",tr_maf_partiss);

var inp24 = document.createElement("INPUT");
inp24.setAttribute("type","hidden");
inp24.setAttribute("name",tr_maf_drgiss);
inp24.setAttribute("id",tr_maf_drgiss);

var inp25 = document.createElement("INPUT");
inp25.setAttribute("type","hidden");
inp25.setAttribute("name",tr_maf_cos);
inp25.setAttribute("id",tr_maf_cos);

/*var inp14 =  document.createElement("INPUT");
inp14.setAttribute("type","hidden");
inp14.setAttribute("value","");
inp14.setAttribute("name",vendrecnum);
inp14.setAttribute("id",vendrecnum);

var inp15 =  document.createElement("INPUT");
inp15.setAttribute("type","hidden");
inp15.setAttribute("value","");
inp15.setAttribute("name",partrecnum);
inp15.setAttribute("id",partrecnum); */
row.appendChild(cell1);
// alert("reachde");
row.appendChild(cell3);
// row.appendChild(cell19);
row.appendChild(cell5);
row.appendChild(cell4);
//row.appendChild(cell6);
//row.appendChild(cell7);
//row.appendChild(cell8);
row.appendChild(cell9);
row.appendChild(cell10);

row.appendChild(cell20);

row.appendChild(cell11);
row.appendChild(cell14);
row.appendChild(cell15);
//row.appendChild(cell12);
row.appendChild(cell13);

row.appendChild(inp23);
row.appendChild(inp24);
row.appendChild(inp25);

tbody.appendChild(row);
/*row.appendChild(inp14);
row.appendChild(inp15);
tbody.appendChild(row);*/
x++;
document.forms[0].index_treated.value=x;
document.forms[0].curindex_treated.value=x;
}

function addRow_bo(id,index){
var x=index;
var y=index;

bo_linenumber="bo_linenum"+index;
bo_itemno="bo_itemno"+index;
bo_desc="bo_desc"+index;
bo_partnum="bo_partnum"+index;
bo_partiss="bo_partiss"+index;
bo_drgno="bo_drgno"+index;
bo_issue="bo_issue"+index;
bo_supp="bo_supp"+index;
bo_qpa="bo_qpa"+index;


var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];

var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","3");
inp1.setAttribute("name",bo_linenumber);
inp1.setAttribute("id",bo_linenumber);
cell1.appendChild(inp1);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","5");
inp3.setAttribute("name",bo_itemno);
inp3.setAttribute("id",bo_itemno);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","18");
inp4.setAttribute("name",bo_desc);
inp4.setAttribute("id",bo_desc);
inp4.setAttribute("readOnly","true");
inp4.style.backgroundColor = "#DDDDDD";
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","12");
inp5.setAttribute("readOnly","true");
inp5.setAttribute("name",bo_partnum);
inp5.setAttribute("id",bo_partnum);
inp5.style.backgroundColor = "#DDDDDD";
cell5.appendChild(inp5);

var cell5image = document.createElement("img");
cell5image.setAttribute("src","images/get.gif");
cell5image.onclick= function() {
GetPart(y,'Bought Out');
};
cell5.appendChild(cell5image);

/*var cell6 = document.createElement("TD");
cell6.innerHTML='<td><input type=text size=8 style=\"background-color:#DDDDDD;\" id='+itemname+' name='+itemname+'><img src=images/bu-get.gif onclick=javascript:GetAllparts(itemname,inpvendrecnum);></td>'
//var cell7 = document.createElement("TD");
//cell7.innerHTML='<td><input type=text size=11 style=\"background-color:#DDDDDD;\" name='+mfrpn+'><img src=images/bu_mfrpn.gif onclick=javascript:GetAllparts(mfrpn,inpvendrecnum);></td>'*/

/*var cell8 = document.createElement("TD");
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","8");
inp8.setAttribute("readonly",'readonly');
inp8.style.backgroundColor = "#DDDDDD";
inp8.setAttribute("name",itemname);
inp8.setAttribute("id",itemname);
cell8.appendChild(inp8);*/

var cell9 = document.createElement("TD");
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","12");
inp9.setAttribute("name",bo_partiss);
inp9.setAttribute("id",bo_partiss);
inp9.setAttribute("readOnly","true");
inp9.style.backgroundColor = "#DDDDDD";
cell9.appendChild(inp9);

var cell10 = document.createElement("TD");
var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","10");
inp10.setAttribute("name",bo_drgno);
inp10.setAttribute("id",bo_drgno);
inp10.setAttribute("readOnly","true");
inp10.style.backgroundColor = "#DDDDDD";
cell10.appendChild(inp10);

var cell11 = document.createElement("TD");
var inp11 =  document.createElement("INPUT");
inp11.setAttribute("type","text");
inp11.setAttribute("size","10");
inp11.setAttribute("name",bo_issue);
inp11.setAttribute("id",bo_issue);
inp11.setAttribute("readOnly","true");
inp11.style.backgroundColor = "#DDDDDD";
cell11.appendChild(inp11);

var cell12 = document.createElement("TD");
var inp12 =  document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","15");
inp12.setAttribute("name",bo_supp);
inp12.setAttribute("id",bo_supp);
inp12.setAttribute("readOnly","true");
inp12.style.backgroundColor = "#DDDDDD";
cell12.appendChild(inp12);

var cell13 = document.createElement("TD");
var inp13 =  document.createElement("INPUT");
inp13.setAttribute("type","text");
inp13.setAttribute("size","5");
inp13.setAttribute("name",bo_qpa);
inp13.setAttribute("id",bo_qpa);
cell13.appendChild(inp13);
/*var inp14 =  document.createElement("INPUT");
inp14.setAttribute("type","hidden");
inp14.setAttribute("value","");
inp14.setAttribute("name",vendrecnum);
inp14.setAttribute("id",vendrecnum);

var inp15 =  document.createElement("INPUT");
inp15.setAttribute("type","hidden");
inp15.setAttribute("value","");
inp15.setAttribute("name",partrecnum);
inp15.setAttribute("id",partrecnum); */
row.appendChild(cell1);
row.appendChild(cell3);
row.appendChild(cell5);
//row.appendChild(cell6);
//row.appendChild(cell7);
//row.appendChild(cell8);
row.appendChild(cell4);
row.appendChild(cell9);

row.appendChild(cell10);
row.appendChild(cell11);
row.appendChild(cell12);
row.appendChild(cell13);
tbody.appendChild(row);
/*row.appendChild(inp14);
row.appendChild(inp15);
tbody.appendChild(row);*/
x++;
document.forms[0].boindex.value=x;
document.forms[0].bocurindex.value=x;
}

function addRow_co(id,index)
{
var x=index;
var y=index;

co_linenumber="co_linenum"+index;
co_itemno="co_itemno"+index;
co_desc="co_desc"+index;
co_spec="co_spec"+index;
co_issue="co_issue"+index;
co_supp="co_supp"+index;
co_qpa="co_qpa"+index;
co_partnum="co_partnum"+index;

var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];

var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","3");
inp1.setAttribute("name",co_linenumber);
inp1.setAttribute("id",co_linenumber);
cell1.appendChild(inp1);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","11");
inp3.setAttribute("name",co_itemno);
inp3.setAttribute("id",co_itemno);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","25");
inp4.setAttribute("name",co_desc);
inp4.setAttribute("id",co_desc);
inp4.setAttribute("readOnly","true");
inp4.style.backgroundColor = "#DDDDDD";
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","13");
inp5.setAttribute("name",co_spec);
inp5.setAttribute("id",co_spec);
cell5.appendChild(inp5);

var cell9 = document.createElement("TD");
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","8");
inp9.setAttribute("name",co_issue);
inp9.setAttribute("id",co_issue);
inp9.setAttribute("readOnly","true");
inp9.style.backgroundColor = "#DDDDDD";
cell9.appendChild(inp9);

var cell10 = document.createElement("TD");
var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","17");
inp10.setAttribute("name",co_supp);
inp10.setAttribute("id",co_supp);
inp10.setAttribute("readOnly","true");
inp10.style.backgroundColor = "#DDDDDD";

cell10.appendChild(inp10);

var cell11 = document.createElement("TD");
var inp11 =  document.createElement("INPUT");
inp11.setAttribute("type","text");
inp11.setAttribute("size","6");
inp11.setAttribute("name",co_qpa);
inp11.setAttribute("id",co_qpa);
cell11.appendChild(inp11);

var cell12 = document.createElement("TD");
var inp12 =  document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","12");
inp12.setAttribute("readOnly","true");
inp12.setAttribute("name",co_partnum);
inp12.setAttribute("id",co_partnum);
inp12.style.backgroundColor = "#DDDDDD";
cell12.appendChild(inp12);

var cell12image = document.createElement("img");
cell12image.setAttribute("src","images/get.gif");
cell12image.onclick= function() {
GetPart(y,'Consummables');
};
cell12.appendChild(cell12image);

row.appendChild(cell1);
row.appendChild(cell3);
row.appendChild(cell12);
row.appendChild(cell4);
row.appendChild(cell9);
row.appendChild(cell10);
row.appendChild(cell5);
row.appendChild(cell11);
tbody.appendChild(row);
x++;
document.forms[0].coindex.value=x;
document.forms[0].cocurindex.value=x;
}

function addRow_op(id,index){
var x=index;
   opn="opn" + index;
   stn="stn" + index;
   desc="desc" + index;
   signoff="signoff" + index;
   remarks="remarks"  + index;


var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];

var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.type="text";
inp1.size="3";
inp1.name=opn;
inp1.id=opn;
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.type="text";
inp2.size="15";
inp2.name=stn;
inp2.id=stn;
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.type="text";
inp3.size="48";
inp3.name=desc;
inp3.id=desc;
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.type="text";
inp4.size="16";
inp4.name=signoff;
inp4.id=signoff;
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.type="text";
inp5.size="42";
inp5.name=remarks;
inp5.id=remarks;
cell5.appendChild(inp5);

row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
tbody.appendChild(row);
x++;
document.forms[0].opindex.value=x;
document.forms[0].opcurindex.value=x;
}

function addRow4edit(id,index){
var x=index;
prevlinenum="prevlinenum"+index;
lirecnum="lirecnum"+index;
linenum="linenum"+index;
itemdesc="itemdesc"+index;
itemname="itemname"+index;
value="value"+index;
supplier="supplier"+index;
comments="comments"+index;
qty="qty"+index;
rate="rate"+index;
amount="amount"+index;
vendrecnum="vendrecnum"+index;
partrecnum="partrecnum"+index;
workcenter="workcenter"+index;

var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];

var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";
var cell1 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","3");
inp1.setAttribute("name",linenum);
cell1.appendChild(inp1);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","11");
inp3.setAttribute("name",itemdesc);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","11");
inp4.setAttribute("name",workcenter);
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","11");
inp5.setAttribute("name",value);
cell5.appendChild(inp5);

/*var cell6 = document.createElement("TD");
cell6.innerHTML='<td><input type=text size=11 style=\"background-color:#DDDDDD;\" name='+mfr+'><img src=images/bu_mfr.gif onclick=javascript:AllVendors(mfr);></td>'
var cell7 = document.createElement("TD");
cell7.innerHTML='<td><input type=text size=11 style=\"background-color:#DDDDDD;\" name='+mfrpn+'><img src=images/bu_mfrpn.gif onclick=javascript:GetAllparts(mfrpn,inpvendrecnum);></td>'
//newdiv.innerHTML = 'Element Number '+num+' has been added! <a href='#' onclick='removeElement('+divIdName+')'>Remove the div "'+divIdName+'"</a>';*/


var cell8 = document.createElement("TD");
cell8.innerHTML='<td><input type=text size=8% style=\"background-color:#DDDDDD;\" name='+itemname+'><img src=images/bu-get.gif onclick=javascript:GetAllparts(itemname);></td>'
/*inp8.setAttribute("type","text");
inp8.setAttribute("size","8");
inp8.setAttribute("readonly",'readonly');
inp8.style.backgroundColor = "#DDDDDD";
inp8.setAttribute("name",itemname);
inp8.setAttribute("id",itemname);
cell8.appendChild(inp8);*/

/*var cell9 = document.createElement("TD");
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","11");
inp9.setAttribute("name",supplier);
cell9.appendChild(inp9);*/

var cell10 = document.createElement("TD");
var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","6");
inp10.setAttribute("name",qty);
inp10.setAttribute("id",qty);
cell10.appendChild(inp10);

var cell11 = document.createElement("TD");
var inp11 =  document.createElement("INPUT");
inp11.setAttribute("type","text");
inp11.setAttribute("size","6");
inp11.setAttribute("name",rate);
inp11.setAttribute("id",rate);
cell11.appendChild(inp11);

var cell12 = document.createElement("TD");
var inp12 =  document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","6");
inp12.setAttribute("readonly",'readonly');
inp12.style.backgroundColor = "#DDDDDD";
inp12.setAttribute("name",amount);
cell12.appendChild(inp12);

var cell13 = document.createElement("TD");
var inp13 =  document.createElement("INPUT");
inp13.setAttribute("type","text");
inp13.setAttribute("size","11");
inp13.setAttribute("name",comments);
cell13.appendChild(inp13);

var inp14 =  document.createElement("INPUT");
inp14.setAttribute("type","hidden");
inp14.setAttribute("value","");
inp14.setAttribute("name",prevlinenum);

var inp15 =  document.createElement("INPUT");
inp15.setAttribute("type","hidden");
inp15.setAttribute("value","");
inp15.setAttribute("name",lirecnum);

var inp16 =  document.createElement("INPUT");
inp16.setAttribute("type","hidden");
inp16.setAttribute("value","0");
inp16.setAttribute("name",vendrecnum);
inp16.setAttribute("id",vendrecnum);

var inp17 =  document.createElement("INPUT");
inp17.setAttribute("type","hidden");
inp17.setAttribute("value","0");
inp17.setAttribute("name",partrecnum);
inp17.setAttribute("id",partrecnum);

row.appendChild(cell1);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(inp16);
row.appendChild(cell8);
row.appendChild(inp17);
row.appendChild(cell10);
row.appendChild(cell11);
row.appendChild(cell12);
row.appendChild(cell13);
row.appendChild(inp14);
row.appendChild(inp15);


tbody.appendChild(row);
x++;
document.forms[0].index.value=x;
document.forms[0].curindex.value=x;
}

function addRow4eng(id,index){
var x=index;
prevlinenum="prevlinenum"+index;
lirecnum="lirecnum"+index;
linenum="linenum"+index;
itemdesc="itemdesc"+index;
itemname="itemname"+index;
value="value"+index;
//mfr="mfr"+index;
//mfrpn="mfrpn"+index;
supplier="supplier"+index;
comments="comments"+index;
qty="qty"+index;
rate="rate"+index;
amount="amount"+index;

var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];

var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";
var cell1 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","3");
inp1.setAttribute("name",linenum);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","11");
inp2.setAttribute("name",itemdesc);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","8");
inp3.setAttribute("name",itemname);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","6");
inp4.setAttribute("name",value);
cell4.appendChild(inp4);


var cell7 = document.createElement("TD");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","6");
inp7.setAttribute("name",qty);
cell7.appendChild(inp7);

var cell8 = document.createElement("TD");
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","11");
inp8.setAttribute("name",comments);
cell8.appendChild(inp8);

var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","hidden");
inp9.setAttribute("value","");
inp9.setAttribute("name",supplier);

var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","hidden");
inp10.setAttribute("value","0");
inp10.setAttribute("name",rate);

var inp11 =  document.createElement("INPUT");
inp11.setAttribute("type","hidden");
inp11.setAttribute("value","0");
inp11.setAttribute("name",amount);

var inp12 =  document.createElement("INPUT");
inp12.setAttribute("type","hidden");
inp12.setAttribute("value","");
inp12.setAttribute("name",prevlinenum);

var inp13 =  document.createElement("INPUT");
inp13.setAttribute("type","hidden");
inp13.setAttribute("value","");
inp13.setAttribute("name",lirecnum);

row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell7);
row.appendChild(cell8);
row.appendChild(inp9);
row.appendChild(inp10);
row.appendChild(inp11);
row.appendChild(inp12);
row.appendChild(inp13);
tbody.appendChild(row);
x++;
document.forms[0].index.value=x;
document.forms[0].curindex.value=x;
}



function onSelectStatus()
{
   var aind = document.forms[0].statusval.selectedIndex;
   document.forms[0].status.value = document.forms[0].statusval[aind].text;
}

function onSelectStatus1()
{
   var aind = document.forms[0].makebuy1.selectedIndex;
   document.forms[0].makebuy.value = document.forms[0].makebuy1[aind].text;
}

function checkenter(event)
{
 document.forms[0].upload.value = 'database';
 document.forms[0].submit();
}

function Setupload()
{
var errmsg = '';
document.forms[0].uploadval.value=document.forms[0].attach.value;
if(document.forms[0].attach.value == '')
{
  errmsg +="File should be selected\n";
}
if (errmsg == '')
{
        document.forms[0].upload.value = 'upload';
        //alert(document.forms[0].upload.value);
        return true;
}
else
{
      alert (errmsg);
       return false;
    }
}

function printBom(bomrecnum) {
var winWidth = 1000;
var winHeight = 900;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printBOM.php?bomrecnum=" + bomrecnum, "PrintBOM", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}

function printComparebom() {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printCompare_bom.php" , "PrintBOM", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

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


function searchsort_fields()
{

    var ind = document.forms[0].bomcrit.selectedIndex;
    var s1ind = document.forms[0].bom_oper.selectedIndex;
    var s2ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].bomcritval.value = document.forms[0].bomcrit[ind].text;
    document.forms[0].bomoperval.value = document.forms[0].bom_oper[s1ind].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s2ind].text;
}

function checkenter(event)
{

    var ind = document.forms[0].bomcrit.selectedIndex;
    var s1ind = document.forms[0].bom_oper.selectedIndex;
    var s2ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].bomcritval.value = document.forms[0].bomcrit[ind].text;
    document.forms[0].bomoperval.value = document.forms[0].bom_oper[s1ind].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s2ind].text;

}

// Added to get mfr on october 28,2006
function AllVendors(v) {
var param = v;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allvendors.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetVendor(mfr) {
var contdet = mfr.split("|");
document.forms[0].mfr.value= contdet[0] ;
document.forms[0].vendrecnum.value = contdet[1] ;
inpvendrecnum=contdet[1] ;
}
function SetVendor1(mfr) {
var contdet = mfr.split("|");
document.forms[0].mfr1.value= contdet[0] ;
document.forms[0].vendrecnum1.value = contdet[1] ;
inpvendrecnum=contdet[1] ;
}
function SetVendor2(mfr) {
var contdet = mfr.split("|");
document.forms[0].mfr2.value= contdet[0] ;
document.forms[0].vendrecnum2.value = contdet[1] ;
inpvendrecnum=contdet[1] ;
}
function SetVendor3(mfr) {
var contdet = mfr.split("|");
document.forms[0].mfr3.value= contdet[0] ;
document.forms[0].vendrecnum3.value = contdet[1] ;
inpvendrecnum=contdet[1] ;
}
function SetVendor4(mfr) {
var contdet = mfr.split("|");
document.forms[0].mfr4.value= contdet[0] ;
document.forms[0].vendrecnum4.value = contdet[1] ;
inpvendrecnum=contdet[1] ;
//var el=document.getElementById("vendrecnum4")
//el.value = contdet[1] ;
//alert(contdet[1]);
}
function SetVendor5(mfr) {
var contdet = mfr.split("|");
document.forms[0].mfr5.value= contdet[0] ;
document.forms[0].vendrecnum5.value = contdet[1] ;
inpvendrecnum=contdet[1] ;
}
function SetVendor6(mfr) {
var contdet = mfr.split("|");
document.forms[0].mfr6.value= contdet[0] ;
document.forms[0].vendrecnum6.value = contdet[1] ;
inpvendrecnum=contdet[1] ;
}
function SetVendor7(mfr) {
var contdet = mfr.split("|");
document.forms[0].mfr7.value= contdet[0] ;
document.forms[0].vendrecnum7.value = contdet[1] ;
inpvendrecnum=contdet[1] ;
}
function SetVendor8(mfr) {
var contdet = mfr.split("|");
document.forms[0].mfr8.value= contdet[0] ;
document.forms[0].vendrecnum8.value = contdet[1] ;
asd=contdet[1] ;
}
function SetVendor9(mfr) {
var contdet = mfr.split("|");
document.forms[0].mfr9.value= contdet[0] ;
document.forms[0].vendrecnum9.value = contdet[1] ;
inpvendrecnum=contdet[1] ;
}
function SetVendor10(mfr) {
var contdet = mfr.split("|");
document.forms[0].mfr10.value= contdet[0] ;
document.forms[0].vendrecnum10.value = contdet[1] ;
inpvendrecnum=contdet[1] ;
}
function SetVendor11(mfr) {
var contdet = mfr.split("|");
document.forms[0].mfr11.value= contdet[0] ;
document.forms[0].vendrecnum11.value = contdet[1] ;
inpvendrecnum=contdet[1] ;
}
function SetVendor12(mfr) {
var contdet = mfr.split("|");
document.forms[0].mfr12.value= contdet[0] ;
document.forms[0].vendrecnum12.value = contdet[1] ;
inpvendrecnum=contdet[1] ;
}
function SetVendor13(mfr) {
var contdet = mfr.split("|");
document.forms[0].mfr13.value= contdet[0] ;
document.forms[0].vendrecnum13.value = contdet[1] ;
inpvendrecnum=contdet[1] ;
}
function SetVendor14(mfr) {
var contdet = mfr.split("|");
document.forms[0].mfr14.value= contdet[0] ;
document.forms[0].vendrecnum14.value = contdet[1] ;
inpvendrecnum=contdet[1] ;
}
function SetVendor15(mfr) {
var contdet = mfr.split("|");
document.forms[0].mfr15.value= contdet[0] ;
document.forms[0].vendrecnum15.value = contdet[1] ;
inpvendrecnum=contdet[1] ;
}

// Added to get mfr P/N on october 28,2006
function GetAllparts(p,r) {
var param = p;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;

win1 = window.open("getallpartnum.php?vendrecnum=" + r, param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function Setparts(partarr,partnum) {
//alert(partnum);
var contdet = partarr.split("|");
//document.forms[0].mfrpn.value= contdet[0] ;
//document.forms[0].partrecnum.value = contdet[1] ;
document.getElementById(partnum).value = contdet[2] ;
}

/*function Setparts1(mfrpn) {
if (document.forms[0].mfr1.value == '')
{ alert("Please select a Mfr before selecting a Mfr P/N");
  return false;
}
var contdet = mfrpn.split("|");
document.forms[0].mfrpn1.value= contdet[0] ;
document.forms[0].partrecnum1.value = contdet[1] ;
document.forms[0].itemname1.value = contdet[2] ;
}

function Setparts2(mfrpn) {
if (document.forms[0].mfr2.value == '')
{ alert("Please select a Mfr before selecting a Mfr P/N");
  return false;
}
var contdet = mfrpn.split("|");
document.forms[0].mfrpn2.value= contdet[0] ;
document.forms[0].partrecnum2.value = contdet[1] ;
document.forms[0].itemname2.value = contdet[2] ;
}

function Setparts3(mfrpn) {
if (document.forms[0].mfr3.value == '')
{ alert("Please select a Mfr before selecting a Mfr P/N");
  return false;
}
var contdet = mfrpn.split("|");
document.forms[0].mfrpn3.value= contdet[0] ;
document.forms[0].partrecnum3.value = contdet[1] ;
document.forms[0].itemname3.value = contdet[2] ;
}

function Setparts4(mfrpn) {
if (document.forms[0].mfr4.value == '')
{ alert("Please select a Mfr before selecting a Mfr P/N");
  return false;
}

var contdet = mfrpn.split("|");
var el=document.getElementById("itemname4")
document.forms[0].mfrpn4.value= contdet[0] ;
el.value = contdet[2] ;
}

function Setparts5(mfrpn) {
if (document.forms[0].mfr5.value == '')
{ alert("Please select a Mfr before selecting a Mfr P/N");
  return false;
}
var contdet = mfrpn.split("|");
document.forms[0].mfrpn5.value= contdet[0] ;
document.forms[0].partrecnum5.value = contdet[1] ;
document.forms[0].itemname5.value = contdet[2] ;
}

function Setparts6(mfrpn) {
if (document.forms[0].mfr6.value == '')
{ alert("Please select a Mfr before selecting a Mfr P/N");
  return false;
}
var contdet = mfrpn.split("|");
document.forms[0].mfrpn6.value= contdet[0] ;
document.forms[0].partrecnum6.value = contdet[1] ;
document.forms[0].itemname6.value = contdet[2] ;
}

function Setparts7(mfrpn) {
if (document.forms[0].mfr7.value == '')
{ alert("Please select a Mfr before selecting a Mfr P/N");
  return false;
}
var contdet = mfrpn.split("|");
document.forms[0].mfrpn7.value= contdet[0] ;
document.forms[0].partrecnum7.value = contdet[1] ;
document.forms[0].itemname7.value = contdet[2] ;
}

function Setparts8(mfrpn) {
if (document.forms[0].mfr8.value == '')
{ alert("Please select a Mfr before selecting a Mfr P/N");
  return false;
}
var contdet = mfrpn.split("|");
document.forms[0].mfrpn8.value= contdet[0] ;
document.forms[0].partrecnum8.value = contdet[1] ;
document.forms[0].itemname8.value = contdet[2] ;
}

function Setparts9(mfrpn) {
if (document.forms[0].mfr9.value == '')
{ alert("Please select a Mfr before selecting a Mfr P/N");
  return false;
}
var contdet = mfrpn.split("|");
document.forms[0].mfrpn9.value= contdet[0] ;
document.forms[0].partrecnum9.value = contdet[1] ;
document.forms[0].itemname9.value = contdet[2] ;
}

function Setparts10(mfrpn) {
if (document.forms[0].mfr10.value == '')
{ alert("Please select a Mfr before selecting a Mfr P/N");
  return false;
}
var contdet = mfrpn.split("|");
document.forms[0].mfrpn10.value= contdet[0] ;
document.forms[0].partrecnum10.value = contdet[1] ;
document.forms[0].itemname10.value = contdet[2] ;
}

function Setparts11(mfrpn) {
if (document.forms[0].mfr11.value == '')
{ alert("Please select a Mfr before selecting a Mfr P/N");
  return false;
}
var contdet = mfrpn.split("|");
document.forms[0].mfrpn11.value= contdet[0] ;
document.forms[0].partrecnum11.value = contdet[1] ;
document.forms[0].itemname11.value = contdet[2] ;
}

function Setparts12(mfrpn) {
if (document.forms[0].mfr12.value == '')
{ alert("Please select a Mfr before selecting a Mfr P/N");
  return false;
}
var contdet = mfrpn.split("|");
document.forms[0].mfrpn12.value= contdet[0] ;
document.forms[0].partrecnum12.value = contdet[1] ;
document.forms[0].itemname12.value = contdet[2] ;
}

function Setparts13(mfrpn) {
if (document.forms[0].mfr13.value == '')
{ alert("Please select a Mfr before selecting a Mfr P/N");
  return false;
}
var contdet = mfrpn.split("|");
document.forms[0].mfrpn13.value= contdet[0] ;
document.forms[0].partrecnum13.value = contdet[1] ;
document.forms[0].itemname13.value = contdet[2] ;
}

function Setparts14(mfrpn) {
if (document.forms[0].mfr14.value == '')
{ alert("Please select a Mfr before selecting a Mfr P/N");
  return false;
}
var contdet = mfrpn.split("|");
document.forms[0].mfrpn14.value= contdet[0] ;
document.forms[0].partrecnum14.value = contdet[1] ;
document.forms[0].itemname14.value = contdet[2] ;
}

function Setparts15(mfrpn) {
if (document.forms[0].mfr15.value == '')
{ alert("Please select a Mfr before selecting a Mfr P/N");
  return false;
}
var contdet = mfrpn.split("|");
document.forms[0].mfrpn15.value= contdet[0] ;
document.forms[0].partrecnum15.value = contdet[1] ;
document.forms[0].itemname15.value = contdet[2] ;
}*/

function ConfirmDelete() {
     document.forms[0].deleteflag.value = "y";
     return true;
}

function GetInvXsaction()
{
var winWidth = 650;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("activitylog4bom.php", "BOM", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft+",dependent=yes");
}

function GetCIM(rt)
{
//alert(rt);
var param = rt;
var winWidth = 1000;
var winHeight = 400;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var ind = document.forms[0].index.value;
var crn_type = "crn_type"+param;
// var crn_treat = "crn_treat"+param;
var mtreat=document.getElementById(crn_type).value;
// var mtreat=document.getElementById(crn_treat).value;

win1 = window.open("getCIM4Bom.php?mtreat="+mtreat, param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function GetCIM_sassy(rt)
{
//alert(rt);
var param = rt;
var winWidth = 1000;
var winHeight = 400;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var ind = document.forms[0].index.value;
var crn_type = "as_crn_type"+param;
// var crn_treat = "as_crn_treat"+param;
var mtreat=document.getElementById(crn_type).value;
// var mtreat=document.getElementById(crn_treat).value;
win1 = window.open("getCIM4Bom.php?mtreat="+mtreat, param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function GetCIM_treated(rt)
{
// alert(rt);
var param = rt;
var winWidth = 1000;
var winHeight = 400;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var ind = document.forms[0].index.value;
var tr_crn_type = "tr_crn_type"+param;
// var tr_crn_treat = "tr_crn_treat"+param;
var mtreat=document.getElementById(tr_crn_type).value;
// var mtreat=document.getElementById(tr_crn_treat).value;
win1 = window.open("getCIM4Bom.php?mtreat="+mtreat, param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function Setcrn(CIM,fieldname)
{
  //alert(CIM);
   //alert(fieldname);
   var CIM = CIM.split("|");

   var id2="crn"+ fieldname;
   var text2= document.getElementById(id2);
   text2.value=CIM[0];

   var id3="partno"+ fieldname;
   var text3= document.getElementById(id3);
   text3.value=CIM[1];

   var id4="partname"+ fieldname;
   var text4= document.getElementById(id4);
   text4.value=CIM[2];

   var id6="maf_partiss"+ fieldname;
   var text6= document.getElementById(id6);
   text6.value=CIM[3];

   var id7="maf_drgiss"+ fieldname;
   var text7= document.getElementById(id7);
   text7.value=CIM[4];
   

   var id8="mpsnum"+ fieldname;
   var text8= document.getElementById(id8);
   text8.value=CIM[5];
   
   var id9="mpsrev"+ fieldname;
   var text9= document.getElementById(id9);
   text9.value=CIM[6];

      var id10="maf_cos"+ fieldname;
   var text10= document.getElementById(id10);
   text10.value=CIM[7];  

    var partiss="partiss"+ fieldname;
   var drgiss="drgiss"+ fieldname;
    var cos="cos"+ fieldname;

   if(document.forms[0].pagename.value == 'editbompage')
{
     document.getElementById(partiss).removeAttribute("readOnly","true");
     document.getElementById(partiss).style.backgroundColor = "#FFFFFF";
   document.getElementById(partiss).value = "";

    document.getElementById(drgiss).removeAttribute("readOnly","true");
    document.getElementById(drgiss).style.backgroundColor = "#FFFFFF";
  document.getElementById(drgiss).value = "";

   document.getElementById(cos).removeAttribute("readOnly","true");
     document.getElementById(cos).style.backgroundColor = "#FFFFFF";
   document.getElementById(cos).value = "";

}
}

function Setcrn4treated(CIM,fieldname)
{
  // alert(CIM);
   //alert(fieldname);
   var CIM = CIM.split("|");

   var id2="tr_crn"+ fieldname;
   var text2= document.getElementById(id2);
   text2.value=CIM[0];

   var id3="tr_partno"+ fieldname;
   var text3= document.getElementById(id3);
   text3.value=CIM[1];

   var id4="tr_partname"+ fieldname;
   var text4= document.getElementById(id4);
   text4.value=CIM[2];

   var id6="partiss_tr"+ fieldname;
   var text6= document.getElementById(id6);
   text6.value=CIM[3];

   var id7="drgiss_tr"+ fieldname;
   var text7= document.getElementById(id7);
   text7.value=CIM[4];
   

   var id8="tr_mpsnum"+ fieldname;
   var text8= document.getElementById(id8);
   text8.value=CIM[5];
   
   var id9="tr_mpsrev"+ fieldname;
   var text9= document.getElementById(id9);
   text9.value=CIM[6];

      var id10="cos_tr"+ fieldname;
   var text10= document.getElementById(id10);
   text10.value=CIM[7];  

    var tr_partiss="tr_partiss"+ fieldname;
   var tr_drgiss="tr_drgiss"+ fieldname;
    var tr_cos="tr_cos"+ fieldname;

   if(document.forms[0].pagename.value == 'editbompage')
{
     document.getElementById(tr_partiss).removeAttribute("readOnly","true");
     document.getElementById(tr_partiss).style.backgroundColor = "#FFFFFF";
   document.getElementById(tr_partiss).value = "";

    document.getElementById(tr_drgiss).removeAttribute("readOnly","true");
    document.getElementById(tr_drgiss).style.backgroundColor = "#FFFFFF";
  document.getElementById(tr_drgiss).value = "";

   document.getElementById(tr_cos).removeAttribute("readOnly","true");
     document.getElementById(tr_cos).style.backgroundColor = "#FFFFFF";
   document.getElementById(tr_cos).value = "";

}
}

function Setcrn4assy(CIM,fieldname)
{
   // alert(CIM);
  //alert(fieldname);
   var CIM = CIM.split("|");


//alert(CIM[3]) ;
   var id2="as_crn"+ fieldname;
   var text2= document.getElementById(id2);
   text2.value=CIM[0];

   var id3="as_partno"+ fieldname;
   var text3= document.getElementById(id3);
   text3.value=CIM[1];

   var id4="as_partname"+ fieldname;
   var text4= document.getElementById(id4);
   text4.value=CIM[2];

   var id6="master_partiss"+ fieldname;
   var text6= document.getElementById(id6);
   text6.value=CIM[3];
   


   var id7="master_drgiss"+ fieldname;
   var text7= document.getElementById(id7);
   text7.value=CIM[4];  

   var id8="as_mpsnum"+ fieldname;
   var text8= document.getElementById(id8);
   text8.value=CIM[5];

   var id9="as_mpsrev"+ fieldname;
   var text9= document.getElementById(id9);
   text9.value=CIM[6];

   var id10="master_cos"+ fieldname;
   var text10= document.getElementById(id10);
   text10.value=CIM[7];  

    var as_partiss="as_partiss"+ fieldname;
   var as_drgiss="as_drgiss"+ fieldname;
    var as_cos="as_cos"+ fieldname;


   // var id12="as_bomrevnum"+ fieldname;
   // var text12= document.getElementById(id12);
   // text12.value=CIM[8];  




   if(document.forms[0].pagename.value == 'editbompage')
{
     document.getElementById(as_partiss).removeAttribute("readOnly","true");
     document.getElementById(as_partiss).style.backgroundColor = "#FFFFFF";
   document.getElementById(as_partiss).value = "";

    document.getElementById(as_drgiss).removeAttribute("readOnly","true");
    document.getElementById(as_drgiss).style.backgroundColor = "#FFFFFF";
  document.getElementById(as_drgiss).value = "";

   document.getElementById(as_cos).removeAttribute("readOnly","true");
     document.getElementById(as_cos).style.backgroundColor = "#FFFFFF";
   document.getElementById(as_cos).value = "";
}
}


function Getcim_bom(rt)
{
//alert(rt);
var param = rt;
var winWidth = 900;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getassyCIM.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function Setcrn_assy(CIM,fieldname)
{
  //alert(CIM);
   //alert(fieldname);
   var CIM = CIM.split("|");

   var id2="crn";
   var text2= document.getElementById(id2);
   text2.value=CIM[0];

   var id3="assy_part";
   var text3= document.getElementById(id3);
   text3.value=CIM[1];

   var id4="issue";
   var text4= document.getElementById(id4);
   text4.value=CIM[3];

   var id6="cos_no";
   var text6= document.getElementById(id6);
   text6.value=CIM[4];

   var id7="drg_no";
   var text7= document.getElementById(id7);
   text7.value=CIM[2];
   
    var id8="partiss";
   var text8= document.getElementById(id8);
   text8.value=CIM[5];
   
   /* var id9="title";
   var text9= document.getElementById(id9);
   text9.value=CIM[6];*/

   var bomnum='BBOM/'+CIM[0];
   document.getElementById('bomnum').value=bomnum;



}

function GetPart(rt,type)
{

var param = rt;
var winWidth = 1000;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getPart.php?type="+type, param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function Setpart(PART,fieldname)
{
   //alert(CIM);
   //alert(fieldname);
   var PART = PART.split("|");

   var id2="bo_partnum"+ fieldname;
   var text2= document.getElementById(id2);
   text2.value=PART[0];

   var id3="bo_partiss"+ fieldname;
   var text3= document.getElementById(id3);
   text3.value=PART[1];

   var id4="bo_desc"+ fieldname;
   var text4= document.getElementById(id4);
   text4.value=PART[2];

   var id6="bo_drgno"+ fieldname;
   var text6= document.getElementById(id6);
   text6.value=PART[3];

   var id7="bo_issue"+ fieldname;
   var text7= document.getElementById(id7);
   text7.value=PART[4];
   
   var id7="bo_supp"+ fieldname;
   var text7= document.getElementById(id7);
   text7.value=PART[5];
}

function Setpart_cons(PART,fieldname)
{  
   var PART = PART.split("|");   
   var id1="co_partnum"+ fieldname;
   var text1= document.getElementById(id1);
   text1.value=PART[0];

   var id2="co_desc"+ fieldname;
   var text2= document.getElementById(id2);
   text2.value=PART[2];

   var id3="co_issue"+ fieldname;
   var text3= document.getElementById(id3);
   text3.value=PART[4];

    var id4="co_supp"+ fieldname;
   var text4= document.getElementById(id4);
   text4.value=PART[5];
}


function addRow4subassy(id,index){
var x=index;
var y=index;
//alert(index+"-------------"+id);
linenumber="as_linenum"+index;
itemno="as_itemno"+index;
partno="as_partno"+index;
crn="as_crn"+index;
partname="as_partname"+index;

partiss="as_partiss"+index;
drgiss="as_drgiss"+index;
cos="as_cos"+index;

mpsnum="as_mpsnum"+index;
mpsrev="as_mpsrev"+index;
attach="as_attach"+index;

master_partiss="master_partiss"+index;
master_drgiss="master_drgiss"+index;
master_cos="master_cos"+index;




qpa="as_qpa"+index;
// crn_type="as_crn_type"+index;
prev_line_num_assy="prev_line_num_assy"+index;
lirecnum_assy="lirecnum_assy"+index;


var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];

var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","2");
inp1.setAttribute("name",linenumber);
inp1.setAttribute("id",linenumber);
cell1.appendChild(inp1);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","5");
inp3.setAttribute("name",itemno);
inp3.setAttribute("id",itemno);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","18");
inp4.setAttribute("name",partno);
inp4.setAttribute("id",partno);
inp4.setAttribute("readOnly","true");
inp4.style.backgroundColor = "#DDDDDD";
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","10");
inp5.setAttribute("readOnly","true");
inp5.setAttribute("name",crn);
inp5.setAttribute("id",crn);
inp5.style.backgroundColor = "#DDDDDD";
cell5.appendChild(inp5);

var cell5image = document.createElement("img");
cell5image.setAttribute("src","images/get.gif");
cell5image.onclick= function() {
GetCIM_sassy(y);
};
cell5.appendChild(cell5image);



var cell9 = document.createElement("TD");
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","18");
inp9.setAttribute("name",partname);
inp9.setAttribute("id",partname);
inp9.setAttribute("readOnly","true");
inp9.style.backgroundColor = "#DDDDDD";
cell9.appendChild(inp9);

var cell10 = document.createElement("TD");
var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","15");
inp10.setAttribute("name",partiss);
inp10.setAttribute("id",partiss);
//inp10.setAttribute("readOnly","true");
//inp10.style.backgroundColor = "#DDDDDD";
cell10.appendChild(inp10);

var cell11 = document.createElement("TD");
var inp11 =  document.createElement("INPUT");
inp11.setAttribute("type","text");
inp11.setAttribute("size","12");
inp11.setAttribute("name",drgiss);
inp11.setAttribute("id",drgiss);
//inp11.setAttribute("readOnly","true");
//inp11.style.backgroundColor = "#DDDDDD";
cell11.appendChild(inp11);

var cell12 = document.createElement("TD");
var inp12 =  document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","12");
inp12.setAttribute("name",attach);
inp12.setAttribute("id",attach);
cell12.appendChild(inp12);

var cell13 = document.createElement("TD");
var inp13 =  document.createElement("INPUT");
inp13.setAttribute("type","text");
inp13.setAttribute("size","3");
inp13.setAttribute("name",qpa);
inp13.setAttribute("id",qpa);
cell13.appendChild(inp13);

var cell14 = document.createElement("TD");
var inp14 =  document.createElement("INPUT");
inp14.setAttribute("type","text");
inp14.setAttribute("size","9");
inp14.setAttribute("name",mpsnum);
inp14.setAttribute("id",mpsnum);
inp14.setAttribute("readOnly","true");
inp14.style.backgroundColor = "#DDDDDD";
cell14.appendChild(inp14);

var cell15 = document.createElement("TD");
var inp15 =  document.createElement("INPUT");
inp15.setAttribute("type","text");
inp15.setAttribute("size","9");
inp15.setAttribute("name",mpsrev);
inp15.setAttribute("id",mpsrev);
inp15.setAttribute("readOnly","true");
inp15.style.backgroundColor = "#DDDDDD";
cell15.appendChild(inp15);

/*var cell19 = document.createElement("TD");
var inp19 =  document.createElement("INPUT");
inp19.setAttribute("name",crn_type);
inp19.setAttribute("id",crn_type);
if(id=='myTable_subassy')
{
inp19.setAttribute("size","8");
inp19.setAttribute("value","Assembly");
}else
{
inp19.setAttribute("size","20");
inp19.setAttribute("value","Manufacture");
}
inp19.setAttribute("readOnly","true");
inp19.style.backgroundColor = "#DDDDDD";
cell19.appendChild(inp19);*/

var inp20 = document.createElement("INPUT");
inp20.setAttribute("type","hidden");
inp20.setAttribute("name",prev_line_num_assy);
inp20.setAttribute("id",prev_line_num_assy);


var inp21 = document.createElement("INPUT");
inp21.setAttribute("type","hidden");
inp21.setAttribute("name",lirecnum_assy);
inp21.setAttribute("id",lirecnum_assy);

var cell20 = document.createElement("TD");
var inp22 =  document.createElement("INPUT");
inp22.setAttribute("type","text");
inp22.setAttribute("size","12");
inp22.setAttribute("name",cos);
inp22.setAttribute("id",cos);
cell20.appendChild(inp22);

var inp23 = document.createElement("INPUT");
inp23.setAttribute("type","hidden");
inp23.setAttribute("name",master_partiss);
inp23.setAttribute("id",master_partiss);

var inp24 = document.createElement("INPUT");
inp24.setAttribute("type","hidden");
inp24.setAttribute("name",master_drgiss);
inp24.setAttribute("id",master_drgiss);

var inp25 = document.createElement("INPUT");
inp25.setAttribute("type","hidden");
inp25.setAttribute("name",master_cos);
inp25.setAttribute("id",master_cos);




row.appendChild(cell1);
row.appendChild(cell3);
// row.appendChild(cell19);
row.appendChild(cell5);
row.appendChild(cell4);
//row.appendChild(cell6);
//row.appendChild(cell7);
//row.appendChild(cell8);
row.appendChild(cell9);
row.appendChild(cell10);

row.appendChild(cell20);

row.appendChild(cell11);
row.appendChild(cell14);
row.appendChild(cell15);
//row.appendChild(cell12);
row.appendChild(cell13);
row.appendChild(inp20);
row.appendChild(inp21);

row.appendChild(inp23);
row.appendChild(inp24);
row.appendChild(inp25);

tbody.appendChild(row);
/*row.appendChild(inp14);
row.appendChild(inp15);
tbody.appendChild(row);*/
x++;
document.forms[0].index_assy.value=x;
document.forms[0].curindex_assy.value=x;
}




function toggleValue(divid,chk)
{
 // alert(chk+"---"+divid);
 if(chk.checked)
 {
  if(document.getElementById(divid).value == "yes")
  {

    document.getElementById(divid).value="no";
    chk.checked=false;
  }
  else
  {

  //  alert(document.getElementById(divid).value);

   document.getElementById(divid).value="yes";

   var currentDate = new Date();
   var month =currentDate.getMonth() + 1 ;
   // alert(month);
   if(month>0 && month < 10)
   {
    var mon_th="0"+month;
    // alert(mon_th);
   }
   else
   {
    var mon_th=month;
   }
   var day = currentDate.getDate() ;
   if(day >1 && day<10)
   {
      var days="0"+day;
      // alert(days);
   }
   else
   {
      var days=day;
   }
   var year = currentDate.getFullYear() ;

   // alert(year);
   // alert(currentDate.format("yyyy-mm-dd"));
   var DD=year + "-" + mon_th + "-" + days;
   // alert(DD);


    if(divid == "eng_app_1")
 {
// alert(divid+""+DD);
 // alert(divid+"****");
   document.getElementById('eng_app_by').value=document.getElementById('userid').value;
   document.getElementById('eng_app_date').value=DD;

 }
 }
 }
 else
 {
   document.getElementById(divid).value="no";
    if(divid == "eng_app_1")
 {
 // alert(divid+"****");
   document.getElementById('eng_app_by').value="";

    document.getElementById('eng_app_date').value="";
  
 }
 

 }

}
// function toggleValue(divid,chk)
// {
//  // alert(chk+"---"+divid+"-**********"+document.getElementById(divid).value);
//  if(chk.checked)
//  {

//   if(document.getElementById(divid).value == "yes")
//   {

//     document.getElementById(divid).value="no";
//     chk.checked=false;
//   }
//   else
//   {

//     document.getElementById(divid).value="yes";
//   var currentDate = new Date();
//    var month =currentDate.getMonth() + 1 ;
//    if(month>0 && month < 10)
//    {
//     var mon_th="0"+month;
//     //alert(mon_th);
//    }
//    else
//    {
//     var mon_th=month;
//    }
//    var day = currentDate.getDate() ;
//    if(day >1 && day<10)
//    {
//       var days="0"+day;
//       //alert(days);
//    }
//    else
//    {
//       var days=day;
//    }
//    var year = currentDate.getFullYear() ;
//    //alert(currentDate.format("yyyy-mm-dd"));
//    var DD=year + "-" + mon_th + "-" + days;
//    // alert(DD);
//    document.getElementById('eng_app_by').value=document.getElementById('userid').value;
//    document.getElementById('eng_app_date').value=DD;
//   }
//  }
//  else
//  {//alert("HERE---");
//    document.getElementById(divid).value="no";
//    document.getElementById('eng_app_date').value="";
//    if(divid == "eng_app")
//  { //alert(divid+"------");
//     document.getElementById('eng_app_by').value="";
//  }
//  }
// }
function onSelectStatus()
{

   var aind = document.forms[0].status_sel.selectedIndex;
   document.forms[0].status.value = document.forms[0].status_sel[aind].text;
}

function getassyWO4BOM(rt)
{
  var param = rt;
  var winWidth = 900;
  var winHeight = 300;
  var winLeft = (screen.width-winWidth)/2;
  var winTop = (screen.height-winHeight)/2;
  win1 = window.open("getassyWO4BOM.php", param, +
  "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
  ",width=" + winWidth + ",height=" + winHeight +
  ",top="+winTop+",left="+winLeft);
}

function SetAssyWonum4Bom(CIM,fieldname)
{

  var CIM = CIM.split("|");

  var bomnum='BBOM/'+CIM[2];
  document.getElementById('bomnum').value=bomnum;
  document.getElementById('link2assywo').value=CIM[0];
  document.getElementById('assywonum').value=CIM[1];
  document.getElementById('crn').value=CIM[2];
  document.getElementById('assy_part').value=CIM[8];
  document.getElementById('cos_no').value=CIM[5];
  document.getElementById('drg_no').value=CIM[3];
  document.getElementById('partiss').value=CIM[7];
  document.getElementById('issue').value=CIM[4];

}
