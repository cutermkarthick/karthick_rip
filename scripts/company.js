/*
 * company.js
 * validation for company
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
 */

function check_req_fields()
{
  
	//alert("Here");
   var ind = document.forms[0].type.selectedIndex;
   document.forms[0].typeval.value = document.forms[0].type[ind].text;
   var ind = document.forms[0].status.selectedIndex;
   document.forms[0].statusval.value = document.forms[0].status[ind].text;
	//	alert("status is "+document.forms[0].statusval.value);
	//	alert("type is "+document.forms[0].typeval.value);

    if (document.forms[0].statusval.value.length == 0) {
        alert('Status must be entered');
        return false;
   }
   if (document.forms[0].name.value.length == 0) {
        alert('Account name must be entered');
        return false;
   }
   if (document.forms[0].email.value == 0) {
        alert('Please enter email id');
        return false;
   }


   // initM ap();

/*
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
   }   */
}

function upd_check_req_fields()
{

   if (document.forms[0].cname.value.length == 0) {
        alert('Company name must be enetered');
        return false;
   }
   if (document.forms[0].cid.value == 0) {
        alert('Company ID must be selected');
        return false;
   }

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
    var ind1 = document.forms[0].scomp.selectedIndex;
    var ind2 = document.forms[0].comp_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].scompanyfl.value = document.forms[0].scomp[ind1].text;
    document.forms[0].company_oper.value = document.forms[0].comp_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}

function checkenter(event)
{
    var ind1 = document.forms[0].scomp.selectedIndex;
    var ind2 = document.forms[0].comp_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].scompanyfl.value = document.forms[0].scomp[ind1].text;
    document.forms[0].company_oper.value = document.forms[0].comp_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}

function ConfirmDelete() {
     document.forms[0].deleteflag.value = "y";
     return true;
}

function onSelectindustry()
        {
        var aind = document.forms[0].industry1.selectedIndex;
        document.forms[0].industry.value = document.forms[0].industry1[aind].text;
        }

function onSelecttype()
{
        //alert("Here");
        var aind = document.forms[0].type1.selectedIndex;
        document.forms[0].type.value = document.forms[0].type1[aind].text;
 }
function onSelectstatus()
{
        //alert("Here");
        var aind = document.forms[0].status1.selectedIndex;
        document.forms[0].status.value = document.forms[0].status1[aind].text;
 }