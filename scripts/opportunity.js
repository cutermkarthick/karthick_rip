/*
 * opportunity.js
 * validation for opportunity
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
 */

function putfocus()
{
   document.forms[0].company.focus();
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
",top="+winTop+",left="+winLeft);
}
function SetCustomer(customer,custrecnum) {
document.forms[0].company.value = customer;
document.forms[0].companyrecnum.value = custrecnum;
}

function GetQuoteDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "QuoteDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetQuoteDate(duedate) {
document.forms[0].quotedate.value = duedate;
}
function ConfirmDelete() {
     document.forms[0].deleteflag.value = "y";
     return true;
}

function setquotetype()
{
	var aind = document.forms[0].quotetype.selectedIndex;
	document.forms[0].quotetypeval.value = document.forms[0].quotetype[aind].text;
	return true;
}

function printopportunityDetails(opportunityrecnum) {
var winWidth = 680;
var winHeight = 500;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printopportunityDetails.php?opportunityrecnum=" + opportunityrecnum, "PrintOpportunity", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

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
//alert(dateval);
//alert(fieldname);
document.forms[0].elements[fieldname].value = dateval;

}
function GetAllEmps(rt)
		{

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
	function SetEmp(emp,emprecnum)
		{
		document.forms[0].salesperson.value = emp;
		document.forms[0].salespersonrecnum.value = emprecnum;

		}


function onSelectSalesstage()
{
  var stage_split =document.getElementById('sales_stage1').value.split("|");
   document.getElementById('sales_stage').value =stage_split[0];
  document.getElementById('opp_stagenum').value=stage_split[1];   

}
function onSelectType()
{

   var aind = document.forms[0].type1.selectedIndex;
   document.forms[0].type.value = document.forms[0].type1[aind].text;
   //document.forms[0].roleval.value = document.forms[0].type1[aind].text;

}
function onSelectSource()
{

   var aind = document.forms[0].lead_source1.selectedIndex;
   document.forms[0].lead_source.value = document.forms[0].lead_source1[aind].text;
   //document.forms[0].salval.value = document.forms[0].lead_source1[aind].text;

}

function onSelectcurrency()
{

   var stage_split =document.getElementById('sales_stage1').value.split("|");
   document.getElementById('sales_stage').value =stage_split[0];
  document.getElementById('opp_stagenum').value=stage_split[1];
}

function searchsort_fields()
{
    var ind1 = document.forms[0].opportunity1.selectedIndex;
    var ind2 = document.forms[0].opportunity_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].opportunityfl.value = document.forms[0].opportunity1[ind1].text;
    document.forms[0].opportunity_oper.value = document.forms[0].opportunity_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}

function checkenter(event)
{
    var ind1 = document.forms[0].opportunity1.selectedIndex;
    var ind2 = document.forms[0].opportunity_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].opportunityfl.value = document.forms[0].opportunity1[ind1].text;
    document.forms[0].opportunity_oper.value = document.forms[0].opportunity_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}


function check_req_fields1()
{
	//alert ('function working');
	//return false;
    var errmsg = '';
    if (document.forms[0].opp_name.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please enter Opportunity Name \n';
    }

    if (document.forms[0].acc_name.value.length == 0)
    {
         errmsg += 'Please enter Account Name\n';
    }
    if (document.forms[0].expected_close_date.value.length == 0)
    {
         errmsg += 'Please enter Expected Close Date\n';
    }

    if (document.forms[0].create_date.value.length == 0)
    {
         errmsg += 'Please enter Create Date\n';
    }

   if  ( IsNumeric(document.forms[0].amount_currency.value)=='')
    {
         errmsg += 'Please enter amount\n';
    }
    if  ( IsNumeric(document.forms[0].probability.value)=='')
    {
         errmsg += 'Probability value must be numeric\n';
    }
     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}

function IsNumeric(strString)
   //  check for valid numeric strings
   {
   var strValidChars = "0123456789.-";
   var strChar;
   var blnResult = true;

   if (strString.length == 0) return false;

   //  test strString consists of valid characters listed above
   for (i = 0; i < strString.length && blnResult == true; i++)
      {
      strChar = strString.charAt(i);
      if (strValidChars.indexOf(strChar) == -1)
         {
         blnResult = false;
         }
      }
   return blnResult;
   }


function check_req_fields4notes()
{
    var errmsg = '';
    if (document.forms[0].spec_instrns.value.length == 0 )
    {
         errmsg = 'Please Add Notes';
    }

    if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }

}


function Getleads(rt) 
{
    var param = rt;
    var winWidth = 300;
    var winHeight = 300;
    var winLeft = (screen.width-winWidth)/2;
    var winTop = (screen.height-winHeight)/2;
    win1 = window.open("getleads4opp.php?reasontext=" + rt, "Customers", +
    "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
    ",width=" + winWidth + ",height=" + winHeight +
    ",top="+winTop+",left="+winLeft);
}


function Setlead(leaddata,etype) 
{

  var leadarr = leaddata.split("|");

  document.getElementById('leadname').value   = leadarr[1];
  document.getElementById('acc_name').value   = leadarr[2];
  document.getElementById('link2lead').value  = leadarr[0];
  
    
}


function GetAllEmps(rt) 
{
    var param = rt;
    var winWidth = 300;
    var winHeight = 300;
    var winLeft = (screen.width-winWidth)/2;
    var winTop = (screen.height-winHeight)/2;
    win1 = window.open("getallemps4opp.php?reasontext=" + rt, "Customers", +
    "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
    ",width=" + winWidth + ",height=" + winHeight +
    ",top="+winTop+",left="+winLeft);
}


function SetEmp(empname,empval) 
{

  document.getElementById("assigned_to").value = empname;
    
}