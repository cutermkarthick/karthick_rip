/*
 * qa4efficiency.js
 * Validation for RM Master
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
*/

function putfocus()
{
   document.forms[0].company.focus();
}

function check_req_fields()
{
	var errmsg = '';
    if (document.forms[0].crn.value.length == 0)
    {
         errmsg += 'Please enter PRN.\n';
    }

	if (document.forms[0].release_note.value.length == 0)
    {
         errmsg += 'Please enter Release Note.\n';
    }
    if (document.forms[0].wonum.value.length == 0)
    {
         errmsg += 'Please enter WO#.\n';
    }
    if (document.forms[0].qadate.value.length == 0)
    {
         errmsg += 'Please enter QA Date.\n';
    }
    if (document.forms[0].qty_disp.value.length == 0)
    {
         errmsg += 'Please enter Quantity Dispatched.\n';
    }
    if (document.forms[0].insp_by.value.length == 0)
    {
         errmsg += 'Please enter Inspected By.\n';
    }
    if (document.forms[0].qty_accp.value.length == 0)
    {
         errmsg += 'Please enter Quantity Accepted.\n';
    }
    var quantityAccepted = parseInt(document.forms[0].qty_accp.value);
    var quantityDispatched = parseInt(document.forms[0].qty_disp.value);
    
    if (quantityAccepted > quantityDispatched)
    {
         errmsg += 'Quantity Accepted should be less than or equal to Quantity Dispatched.\n';
    }
    

   if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}

function Getwo4qaeff() {

  if (document.forms[0].crn.value.length == 0)
  {
      alert('Please enter PRN.\n');
  }
  var crn = document.forms[0].crn.value;
  //alert('Getwo4dc');
  var param = 'aa';
  var winWidth = 500;
  var winHeight = 300;
  var winLeft = (screen.width-winWidth)/2;
  var winTop = (screen.height-winHeight)/2;
  win1 = window.open("getwo4qaefficiency.php?crn="+crn,param,  +
  "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
  ",width=" + winWidth + ",height=" + winHeight +
  ",top="+winTop+",left="+winLeft);
}

function Setwo4qaeffncy(CIM,fieldname) {
   //alert(CIM);
   //alert(fieldname);
   var CIM = CIM.split("|");

  document.forms[0].wonum.value = CIM[0]
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
