function GetAllCustomers(rt) {
//	alert("All customers");
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
//alert(custaddress);
var contdet = custaddress.split("|");
document.forms[0].company.value = customer;
document.getElementById("ba1").innerHTML= contdet[0] +" "+ contdet[1];
document.getElementById("ba2").innerHTML= contdet[2]+" "+ contdet[3]+" "+ contdet[4];
document.getElementById("ba3").innerHTML= contdet[5] ;
document.forms[0].companyrecnum.value= contdet[12] ;
//alert("companyrecnum="+contdet[12]);
}

function printappendixc(appendixcrecnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("appendixcPrint.php?appendixcrecnum=" + appendixcrecnum, "PrintInvoice",

+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}

function check_req_fields()
{

    if (document.forms[0].expinvnum.value.length == 0)
    {
         alert('Please enter invoice numbers\n');
		 return false;
    }

    if (document.forms[0].totnumpkgs.value.length == 0)
    {
         alert('Please enter packages\n');
		 return false;
    }
    if (document.forms[0].company.value.length == 0)
    {
         alert('Please select a customer\n');
		 return false;
    }

}
