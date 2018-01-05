/*
 * competitor.js
 * validation for company
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
 */

function check_req_fields()
{
  /* var ind = document.forms[0].type.selectedIndex;
   document.forms[0].typeval.value = document.forms[0].type[ind].text;

   if (document.forms[0].cname.value.length == 0) {
        alert('Company name must be enetered');
        return false;
   }
   if (document.forms[0].cid.value == 0) {
        alert('Company ID must be selected');
        return false;
   }  */

   if (document.forms[0].address1.value.length == 0) {
        alert('Address1 cannot be blanks');
        return false;
   }
   if (document.forms[0].city.value.length == 0) {
        alert('City cannot be blanks');
        return false;
   }
   if (document.forms[0].state.value.length == 0) {
        alert('State cannot be blanks');
        return false;
   }
   if (document.forms[0].zip.value.length == 0) {
        alert('Zipcode cannot be blanks');
        return false;
   }
   if (document.forms[0].country.value.length == 0) {
        alert('Country cannot be blanks');
        return false;
   }
}

function upd_check_req_fields()
{

  /* if (document.forms[0].cname.value.length == 0) {
        alert('Company name must be enetered');
        return false;
   }
   if (document.forms[0].cid.value == 0) {
        alert('Company ID must be selected');
        return false;
   }  */

   if (document.forms[0].address1.value.length == 0) {
        alert('Address1 cannot be blanks');
        return false;
   }
   if (document.forms[0].city.value.length == 0) {
        alert('City cannot be blanks');
        return false;
   }
   if (document.forms[0].state.value.length == 0) {
        alert('State cannot be blanks');
        return false;
   }
   if (document.forms[0].zip.value.length == 0) {
        alert('Zipcode cannot be blanks');
        return false;
   }
   if (document.forms[0].country.value.length == 0) {
        alert('Country cannot be blanks');
        return false;
   }

}
function putfocus()
{
   document.forms[0].cname.focus();
}


function searchsort_fields()
{
    var ind1 = document.forms[0].competitor.selectedIndex;
    var ind2 = document.forms[0].competitor_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].competitorfl.value = document.forms[0].competitor[ind1].text;
    document.forms[0].competitor_oper.value = document.forms[0].competitor_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}

function checkenter(event)
{
    var ind1 = document.forms[0].competitor.selectedIndex;
    var ind2 = document.forms[0].competitor_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].competitorfl.value = document.forms[0].competitor[ind1].text;
    document.forms[0].competitor_oper.value = document.forms[0].competitor_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}
function ConfirmDelete() {
     document.forms[0].deleteflag.value = "y";
     return true;
}

function printcompetitorsDetails(competitorrecnum) {
var winWidth = 680;
var winHeight = 500;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printcompetitorsDetails.php?competitorrecnum=" + competitorrecnum, "PrintCompetitors", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}