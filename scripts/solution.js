/*
 * solution.js 
 * Written on Jan 10 2005 by Jerry George
 * validation for solution
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam 
 * bmandyam@fluentsoft.com
 */

function check_req_fields()
{
    var errmsg = '';

    if (document.forms[0].solnum.value.length == 0) 
    {
         errmsg += 'Please Enter Solution ID\n';
    }
    if (document.forms[0].title.value.length == 0) 
    {
         errmsg += 'Please Title\n';
    }

    if (errmsg == '')
{
    var ind1 = document.forms[0].soltype.selectedIndex;
    document.forms[0].soltypeval.value = document.forms[0].soltype[ind1].text;

        return true;}
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


function ConfirmDelete() {
     document.forms[0].deleteflag.value = "y";
     return true;
}

function printSol(solrecnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printSol.php?solrecnum=" + solrecnum, "PrintSol", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);

}

