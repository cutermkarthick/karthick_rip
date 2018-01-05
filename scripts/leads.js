/*
 * leads.js
 * validation for leads
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
/*
function GetDueDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "DueDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetDueDate(desdate) {
document.forms[0].delivarydate.value = desdate;
}    */
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

function onSelectsource()
{

   var aind = document.forms[0].source1.selectedIndex;
   document.forms[0].source.value = document.forms[0].source1[aind].text;
   //document.forms[0].roleval.value = document.forms[0].source1[aind].text;

}
function onSelectconvert2contact()
{

   var aind = document.forms[0].convert2contact1.selectedIndex;
   document.forms[0].convert2contact.value = document.forms[0].convert2contact1[aind].text;
   //document.forms[0].roleval.value = document.forms[0].convert2contact1[aind].text;

}

function searchsort_fields()
{
    var ind1 = document.forms[0].leads.selectedIndex;
    var ind2 = document.forms[0].leads_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].sleadsfl.value = document.forms[0].leads[ind1].text;
    document.forms[0].leads_oper.value = document.forms[0].leads_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}

function checkenter(event)
{

    // alert(event);
    var ind1 = document.forms[0].leads.selectedIndex;
    var ind2 = document.forms[0].leads_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].sleadsfl.value = document.forms[0].leads[ind1].text;
    document.forms[0].leads_oper.value = document.forms[0].leads_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}

function check_req_fields()
{
	//alert ('function working');
	//return false;
    var errmsg = '';
    // alert(document.forms[0].name.value.length);
    if (document.forms[0].name.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please enter leads Name \n';
    }

    if (document.forms[0].company.value.length == 0)
    {
         errmsg += 'Please enter company Name\n';
    }

 /*   if (document.forms[0].leadsnum.value.length == 0)
    {
         errmsg += 'Please enter Lead#\n';
    }*/
/*
    if (document.forms[0].oppnum.value.length == 0)
    {
         errmsg += 'Please enter Opportunity#\n';
    }*/
// alert(document.forms[0].title.value.length)
    if (document.forms[0].title.value.length == 0)
    {
         errmsg += 'Please enter title\n';
    }

    if (document.forms[0].phone.value.length == 0)
    {
         errmsg += 'Please enter phone\n';
    }

    if (document.forms[0].industry_segment.value.length == 0)
    {
         errmsg += 'Please select industry_segment\n';
    }

        if (document.forms[0].stage.value == '')
    {
         errmsg += 'Please select Stage\n';
    }

    if (document.forms[0].email.value == '')
    {
         errmsg += 'Please Enter Email\n';
    }
    else
    {
        var email = document.getElementById('email').value;
        var reg = /^([\w-\.]+@(?!gmail.com)(?!yahoo.com)(?!hotmail.com)([\w-]+\.)+[\w-]{2,4})?$/

      // alert(reg.test(email));
         if (reg.test(email) == false)
         {
            alert("Please Enter Valid Email Address");
            return false;
         }
         
    }


     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}

function printleadsDetails(leadsrecnum) {
var winWidth = 680;
var winHeight = 500;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printleadsDetails.php?leadsrecnum=" + leadsrecnum, "PrintLeads", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

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


function Getstage()
{
 var stage_split= document.getElementById('stage_val').value.split("|");
 document.getElementById('stage').value= stage_split[0];
 document.getElementById('stagenum').value=stage_split[1];
}

function Getpercent()
{
document.getElementById('percent').value = document.getElementById('percent_val').value;

}



function Getproduct()
{
    document.getElementById('product_interest').value = document.getElementById('product').value;

}