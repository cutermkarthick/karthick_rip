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

    var errmsg = '';

    if (document.forms[0].name.value.length == 0)
    {
         errmsg += 'Please enter Customer Name\n';
    }
    // if (document.forms[0].enq_date.value.length == 0)
    // {
    //      errmsg += 'Please enter Enquiry Date\n';
    // }
     if (document.forms[0].qty.value.length == 0)
    {
         errmsg += 'Please enter Qty\n';
    }

    if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}


function printSuppEnquiryDetails(enquiryrecnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printSuppEnquiryDetails.php?recnum=" + enquiryrecnum, "PrintEnquiry",

+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function searchsort_fields()
{

    var ind = document.forms[0].quotecrit.selectedIndex;
    var s1ind = document.forms[0].quote_oper.selectedIndex;
    var s2ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].quotecritval.value = document.forms[0].quotecrit[ind].text;
    document.forms[0].quoteoperval.value = document.forms[0].quote_oper[s1ind].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s2ind].text;
}


function selectstatus() {

document.getElementById('status').value = document.getElementById('status_val').value;

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

function toggleValue(divid,chk,approve_date,userid)
{
 //alert(approve_date);
 if(chk.checked)
 {
  if(document.getElementById(divid).value == "yes")
  {
    document.getElementById(divid).value="no";
    chk.checked=false;
  }
  else
  {
   document.getElementById(divid).value="yes";
  }
 }
 else
 {
   document.getElementById(divid).value="no";
 }
   if(document.getElementById('approval').value=="yes"){
  document.getElementById('app_date').value = approve_date;
  document.getElementById('approved_by').value = userid;
  }
  else if(document.getElementById('approval').value=="no"){
    document.getElementById('app_date').value = '';
    document.getElementById('approved_by').value = '';
  }

}


function getallpartnum4supplier(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getpartnum4supplier.php?reasontext=" + rt, "Partnum", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function Setpartnum(partval) 
{
  var part = partval.split('|');
  document.forms[0].partnum.value = part[0];
  document.forms[0].partdesc.value = part[1];

}