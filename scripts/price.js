
function onSelectStatus(status)
{
    //alert("here");
	document.getElementById('status').value = status.value;

	//alert(status.value);

	a//lert(document.getElementById('status').value);
     return true;
}

function onSelectType(type)
{

	document.getElementById('type').value = type.value;

	//alert(type.value);

	//alert(document.getElementById('type').value);
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
function GetAllCustomers(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
alert("hello");
win1 = window.open("getcustomeraddress.php?reasontext=" + rt, "Customers", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetCustomer(customer,custaddress) {
var contdet = custaddress.split("|");
document.forms[0].company.value = customer;
document.forms[0].companyrecnum.value= contdet[12] ;
alert(document.forms[0].companyrecnum.value);

}
*/

function printprice(recnum) {
var winWidth = 680;
var winHeight = 500;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printPrice.php?recnum=" + recnum, "printprice",
+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}


function check_req_fields()
{
	//alert ('function working');
	//return false;
    var errmsg = '';
    if (document.forms[0].crnnum.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please Enter CIM Refnumber \n';
    }

   /* if (document.forms[0].invnum.value.length == 0)
    {
         //errmsg += 'Please enter invoice number\n';
    } */
    if (document.forms[0].cimpartname.value.length == 0)
    {
         errmsg += 'Please enter Part number\n';
    }

    if (document.forms[0].partname.value.length == 0)
    {
         errmsg += 'Please enter Part Name\n';
    }
   if ((document.getElementById('validf').value =="")||(document.getElementById('validf').value =="0000-00-00") || (document.getElementById('validt').value =="")||(document.getElementById('validt').value =="0000-00-00"))
    {
         errmsg += 'Please select valid(from & to) date\n';
    }

     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}

function GetAllCustomers(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getcustomeraddress.php?reasontext=" + rt, "Customers", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetCustomer(customer,custaddress) {
var contdet = custaddress.split("|");
//alert(custaddress);
//alert(contdet[12]);
document.forms[0].company.value = customer;
//document.getElementById("ba1").innerHTML= contdet[0] +" "+ contdet[1];
//document.getElementById("ba2").innerHTML= contdet[2]+" "+ contdet[3]+" "+ contdet[4];
//document.getElementById("ba3").innerHTML= contdet[5] ;
//document.getElementById("sa1").innerHTML= contdet[6] +" "+ contdet[7];
//document.getElementById("sa2").innerHTML= contdet[8]+" "+ contdet[9]+" "+ contdet[10];
//document.getElementById("sa3").innerHTML= contdet[11] ;
document.forms[0].companyrecnum.value= contdet[12] ;

}
