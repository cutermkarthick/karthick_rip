/*
 * wo.js
 * validation for users
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
 */

function searchsort_fields()
{

    var ind = document.forms[0].comp_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    var s2ind = document.forms[0].sort2.selectedIndex;
    document.forms[0].company_oper.value = document.forms[0].comp_oper[ind].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;
    document.forms[0].sortfld2.value = document.forms[0].sort2[s2ind].text;
}
function searchsort_fields1()
{

    var ind = document.forms[0].comp_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    var s2ind = document.forms[0].sort2.selectedIndex;
    document.forms[0].company_oper.value = document.forms[0].comp_oper[ind].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;
    document.forms[0].sortfld2.value = document.forms[0].sort2[s2ind].text;
    document.forms[0].posubmit.value ='Get';

}

function checkenter(event)
{

    var ind = document.forms[0].comp_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    var s2ind = document.forms[0].sort2.selectedIndex;
    document.forms[0].company_oper.value = document.forms[0].comp_oper[ind].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;
    document.forms[0].sortfld2.value = document.forms[0].sort2[s2ind].text;

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
function printBordreport(rt) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printBoardWOreport.php", "PrintBWOreport", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function printSocketreport(rt) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printSocketWOreport.php", "PrintSWOreport", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function printPcbareport(rt) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printPcbaWOreport.php", "PrintSWOreport", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function printwoDetails() {
var winWidth = 850;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printwoDetails.php", "PrintBWO", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}

/* Added for bomdetails view on october 31,2006   */

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

function doscroll()
{
var winWidth = (document.body.clientWidth);
var winHeight = (document.body.clientHeight);
window.scrollTo(winWidth*0,winHeight*100000);
}

 function setColor(id)
    {
        el=document.getElementById(id);
        el.style.backgroundColor='#FAF0E6';
    }


    
    
 function showTable(theTable)
{
     obj = document.getElementsByTagName('TR');

      for (i=0; i<obj.length; i++)
     {
          if (obj[i].id == theTable)
          {
           if (document.all)
                obj[i].style.display = 'block';
            else
             obj[i].style.display = 'table-row';

          }
     }
}

function hideTable(theTable)
{
     obj = document.getElementsByTagName('TR');
      for (i=0; i<obj.length; i++)
     {
          if (obj[i].id == theTable)
          {
          obj[i].style.display = 'none';

          }


     }
}



function act_log(r,t) {
var winWidth = 680;
var winHeight = 400;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("dept_act_log.php?worecnum="+r+"&wotype='"+t+"'", "Activity Log", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}

