/*
 * vendPart.js
 * validation for Parts
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
 */
function check_req_fields()
{
    var errmsg = '';

    if (document.forms[0].partnum.value.length == 0)
    {
         errmsg += 'Please enter Part #\n';
    }

    if (document.forms[0].vendor.value.length == 0)
    {
         errmsg += 'Please enter Vendor \n';
    }
    if (document.forms[0].part_desc.value.length == 0)
    {
         errmsg += 'Please enter Description\n';
    }
    if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
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
 if(ok=="no")
{
	alert("Enter Numbers Only");
	field.value='';
	field.focus();
	field.select();

}
}


function GetDueDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("pocalendar.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetPODate(duedate) {
document.forms[0].podate.value = duedate;
}
function SetPODueDate1(duedate) {
document.forms[0].due_date1.value = duedate;
}
function SetPODueDate2(duedate) {
document.forms[0].due_date2.value = duedate;
}
function SetPODueDate3(duedate) {
document.forms[0].due_date3.value = duedate;
}
function SetPODueDate4(duedate) {
document.forms[0].due_date4.value = duedate;
}
function SetPODueDate5(duedate) {
document.forms[0].due_date5.value = duedate;
}
function SetPODueDate6(duedate) {
document.forms[0].due_date6.value = duedate;
}
function SetPODueDate7(duedate) {
document.forms[0].due_date7.value = duedate;
}
function SetPODueDate8(duedate) {
document.forms[0].due_date8.value = duedate;
}
function SetPODueDate9(duedate) {
document.forms[0].due_date9.value = duedate;
}
function SetPODueDate10(duedate) {
document.forms[0].due_date10.value = duedate;
}
function SetPODueDate11(duedate) {
document.forms[0].due_date11.value = duedate;
}
function SetPODueDate12(duedate) {
document.forms[0].due_date12.value = duedate;
}
function SetPODueDate13(duedate) {
document.forms[0].due_date13.value = duedate;
}
function SetPODueDate14(duedate) {
document.forms[0].due_date14.value = duedate;
}
function SetPODueDate15(duedate) {
document.forms[0].due_date15.value = duedate;
}
function GetPODate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "PODate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function GetAllVendors(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getallvendors.php?reasontext=" + rt, "Vendors", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft+",dependent=yes");
}
function SetVendor(vendor,vendrecnum) {
document.forms[0].vendor.value = vendor;
document.forms[0].vendrecnum.value = vendrecnum;
}
function GetHost(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("gethosts.php?reasontext=" + rt, "Vendors", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft+",dependent=yes");
}
function SetHost(host,hostrecnum) {
document.forms[0].host.value = host;
document.forms[0].hostrecnum.value = hostrecnum;
}
function onSelectStatus()
{

   var aind = document.forms[0].postat.selectedIndex;
   document.forms[0].status.value = document.forms[0].postat[aind].text;
   document.forms[0].activeval.value = document.forms[0].postat[aind].text;

}
function putfocus()
{
   document.forms[0].ponum.focus();
}

function ConfirmDelete() {
   document.forms[0].deleteflag.value = "y";
   return true;
}
function printvendPart(partnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printvendPart.php?partrecnum=" + partnum, "PrintPart", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function updateinvCountinc(rt) {
var param = rt;
var winWidth = 400;
var winHeight = 500;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var invtcount = document.getElementById('invent_cnt').value;
win1 = window.open("updateinvCount.php?reasontext=" + rt +"&invtcount=" +invtcount, "Vendors", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft+",dependent=yes");
}

function updateinvCountdec(rt) {
var param = rt;
var winWidth = 400;
var winHeight = 400;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var invtcount = document.getElementById('invent_cnt').value;
win1 = window.open("updateinvCount.php?reasontext=" + rt +"&invtcount=" +invtcount, "Vendors", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft+",dependent=yes");
}

function GetInvXsaction()
{
var winWidth = 650;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("activitylog.php", "Vendors", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft+",dependent=yes");
}
function selecttype()
{
   var aind = document.forms[0].ptype1.selectedIndex;
   document.forms[0].ptype.value = document.forms[0].ptype1[aind].text;
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
  // alert(contdet[1]);
var contdet = bomrecnum.split("|");

document.forms[0].bomnum.value = bomnum;
document.forms[0].partnum.value = bomnum;
// document.forms[0].part_desc.value = contdet[1];
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

/*function enableField()
{
    if(document.forms[0].ptype.value =='Yes')
    {
    document.forms[0].partnum.readonly="readonly";
    document.forms[0].partnum.disabled=true;
    }
    else
    {
    document.forms[0].partnum.disabled=false;
    }
}*/

function viewbom(a) {
var winWidth = 680;
var winHeight = 400;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("viewBOM.php?bomrecnum="+a, "ViewBOM", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}

function viewWherePartUsed(a,b) {
var winWidth = 450;
var winHeight = 400;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("viewWherePartUsed.php?partrecnum="+a+"&partnum="+b, "viewWherePartUsed", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function printPartReorderReport(rt) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printPartReorderReport.php", "PrintPartReorderReport", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}



function GetDate(rt) {

  // alert(rt);
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
// alert(dateval);
// alert(fieldname);
document.forms[0].elements[fieldname].value = dateval;
}


function check_Reciept_req_fields() {



  var errmsg = '';
  var type=  document.getElementById("type1").value;
    // alert(type);
 if(type == 'Receipts')
    {
    if (document.forms[0].ref_type.value.length == 0)
    {
         errmsg += 'Please enter Reference type #\n';
    }

    if (document.forms[0].ref_num.value.length == 0)
    {
         errmsg += 'Please enter Reference Number \n';
    }
    if (document.forms[0].qty.value.length == 0)
    {
         errmsg += 'Please enter qty\n';
    }
     
          if (document.forms[0].inv_date.value.length == 0)
    {
         errmsg += 'Please enter Invoice Date\n';
    }
       if (document.forms[0].inv_num.value.length == 0)
    {
         errmsg += 'Please enter Invoice Number\n';
    }
       if (document.forms[0].rece_date.value.length == 0)
    {
         errmsg += 'Please enter Receive Date\n';
    }
       if (document.forms[0].rece_by.value.length == 0)
    {
         errmsg += 'Please enter Employee Number\n';
    }
  } 
  else if(type == 'Issues'){

    var invcnt = document.getElementById("invent_cnt").value;
   if(invcnt > 0)
   {
 if (document.forms[0].ref_type.value.length == 0)
    {
         errmsg += 'Please enter Reference type #\n';
    }

    if (document.forms[0].ref_num.value.length == 0)
    {
         errmsg += 'Please enter Reference Number \n';
 
    }
    if (document.forms[0].qty.value.length == 0)
    {
         errmsg += 'Please enter qty\n';

    }
    if (document.forms[0].rece_by.value.length == 0)
    {
         errmsg += 'Please enter Employee Number\n';
    }
  }
      if(invcnt == 0)
      {
        errmsg += 'Please enter Receipts before entering Issues\n';
             }
  }

  
    if (errmsg == '') {
            return true;
      }
    else


    {
       alert (errmsg);
        if(invcnt == 0){
          self.close();
        }
       return false;
    }
}


function onSelectIssStatus()
{

    var aind = document.forms[0].iss_status.selectedIndex;
        document.forms[0].issStatus.value = document.forms[0].iss_status[aind].text;

}