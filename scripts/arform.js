function getInvoice(rt)
{
  var param = rt;
 var winWidth = 1000;
 var winHeight = 400;
 var winLeft = (screen.width-winWidth)/2;
 var winTop = (screen.height-winHeight)/2;
 var invnum = document.forms[0].invnum.value;
  var customer = document.forms[0].companyrecnum.value;
  var category=document.forms[0].ship2companycategory.value;
  if(customer=='')
  {
   alert("Please select a Customer");
   return false;
  }
 //alert(invnum);
 win1 = window.open("getinvoice4ar.php?reasontext=" + rt + "&invnum="+invnum+"&customer="+customer+"&category="+category, "invoice4shipping", +
 "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
 ",width=" + winWidth + ",height=" + winHeight +
 ",top="+winTop+",left="+winLeft);

 var x=1;
var max=document.forms[0].index.value;
while(x<max)
{
statnum="statnum"+x;
qty="qty"+x;
usd="usd"+x;
amtusd="amtusd"+x;
    document.getElementById(statnum).value="";
    document.getElementById(qty).value="";
    document.getElementById(usd).value="";
    document.getElementById(amtusd).value="";
x++;
}
document.getElementById('tot_qty').value="";
document.getElementById('tot_amt').value="";
document.getElementById('tot_amt_rs').value="";

}
function SetInvoice(invoice,invoicearr)
{
  // alert(invoice+"************"+invoicearr);
  var invdet = invoice.split("|");
  //document.forms[0].elements[fieldname].value = CIMdet[1];

  document.forms[0].invnum.value = invdet[1];
  document.forms[0].invdate.value = invdet[2];
 // document.forms[0].company.value = invdet[3];
 // document.forms[0].shipcompany.value = invdet[4];

  //document.forms[0].ship2customer.value = invdet[11];

  document.forms[0].pre_carriage.value = invdet[5];
  //document.forms[0].place_receipt.value = invdet[6];
  //document.forms[0].port_loading.value = invdet[9];
        //document.forms[0].rm_type.value = CIMdet[12];
  //document.forms[0].port_discharge.value = invdet[10];
  //document.forms[0].country_desti.value = invdet[7];
  document.forms[0].invrecnum.value = invdet[0];
  //document.forms[0].vesselnum.value = invdet[8];
  document.forms[0].currency_in.value = invdet[12];

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

function toggleValue(divid,chk)
{
//alert(chk.checked+"---"+divid);
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
//alert(document.getElementById(divid).value);
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

function printarform(recnum,invrecnum) {
//printShipping
var winWidth = 1000;
var winHeight = 1000;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;

win1 = window.open("printar3aform.php?arrecnum=" + recnum+"&invrecnum="+invrecnum, "printShipping",
+
"menubar=0,toolbar=0,resizable=0,scrollbars=0" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}

function check_req_fields()
{
	//alert ('function working');
	//return false;
    var errmsg = '';
    /*if (document.forms[0].company.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please select customer name \n';
    } */
    
    var str=document.forms[0].ship2company.value;
    var patt=/tara aerospace/gi;
    var result=patt.test(str);
     //alert(result);
    if (document.forms[0].invnum.value.length == 0 || document.forms[0].invnum.value=='undefined')
    {
         errmsg += 'Please select a valid invoice number\n';
    }
	if (document.forms[0].exchange_rate.value.length == 0 && !(result))
    {
         errmsg += 'Please enter a number for exchange rate\n';
    }

    if (document.forms[0].ar3adate.value.length == 0)
    {
         errmsg += 'Please enter AR3A date\n';
    }
     if (document.forms[0].ship2company.value.length == 0)
    {
         errmsg += 'Please enter Ship To Details\n';
    }
    /*if (document.forms[0].duedate.value.length == 0)
    {
         errmsg += 'Please enter due date\n';
    }
    if (document.forms[0].customerponum.value.length == 0)
    {
         errmsg += 'Please customer PO# \n';
    } */

      var x=1;
      var max=document.forms[0].index.value;
      var seq_num=new Array();
      var seqlist = {};
      var lipresent = 0;
      //alert(max+"here"+x);
      while (x < max)
    {
        ln ="linenum" + x;
        marknum="marknum"+x;
        statnum="statnum"+x;
       rate="rate"+x;
       amtusd="amtusd"+x;
        lnv = document.getElementById(ln).value;
       // alert(document.getElementById(rate).value+"*-*-*-\n");

       if ((document.getElementById(ln).value.length ==0)&& (document.getElementById(marknum).value.length ==0)&&(document.getElementById(statnum).value.length ==0)&&(document.getElementById(amtusd).value.length==0 ))
        {
          if(lnv+x ==0)
          {
          break;
          }
        }

        else if (seqlist[lnv] != undefined )
        {
            errmsg +='Duplicate Seq # '+ lnv + '\n';

        }
        else
        {
           seqlist[lnv] = lnv;
           //alert(document.getElementById(rate).value+"*-*-*-\n");
           //+document.getElementById(statnum).value+"*-*"   &&
                    //(document.getElementById(amtusd).value != "" && document.getElementById(rate).value != "")
              //alert(document.getElementById(rate).value+"==="+document.getElementById('tot_amt_rs').value);
              if ((document.getElementById(ln).value.length ==0 ) &&(document.getElementById(marknum).value != "" && document.getElementById(statnum).value != ""))
              {                        //alert(document.getElementById(marknum).value+"==="+document.getElementById('tot_amt_rs').value);

                          errmsg += 'Please enter Seq # \n';
              }
             if ((document.getElementById(ln).value.length ==0 ) &&((document.getElementById(amtusd).value != "" && document.getElementById(rate).value != "") ))
              {
                    errmsg += 'Please enter Seq # \n';
              }

              lipresent = 1;
        }
          x++;
    }

     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}

function GetPacking()
{
 // var param = rt;
 //alert("tHERE++++");
var winWidth = 400;
var winHeight =400;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getPacking4ar.php", "Packing", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
var x=1;
var max=document.forms[0].index.value;
while(x<max)
{
marknum="marknum"+x;
document.getElementById(marknum).value ="";
x++;
}
}
function GetInvoicedet4shipping()
{    //alert("HERE++++");
  var exchangerate=document.getElementById('exchange_rate').value;
    var str=document.forms[0].ship2company.value;
    var comp=document.forms[0].company.value;
    var patt=/tara aerospace/gi;
    var result=patt.test(str);
  if(exchangerate==''&& !(result))
  {
    alert("Please enter Exchange Rate");
    return false;
  }

  var winWidth = 200;
  var winHeight = 400;
  var winLeft = (screen.width-winWidth)/2;
  var winTop = (screen.height-winHeight)/2;
  var invnum= document.forms[0].invnum.value;
  win1 = window.open("getinvdet4ar.php?invnum="+invnum+"&exchange_rate="+exchangerate+"&companyname="+str+"&companyname1="+comp, "Packing", +
  "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
  ",width=" + winWidth + ",height=" + winHeight +
  ",top="+winTop+",left="+winLeft);

var x=1;
var max=document.forms[0].index.value;
while(x<max)
{
statnum="statnum"+x;
qty="qty"+x;
usd="usd"+x;
amtusd="amtusd"+x;

    document.getElementById(statnum).value="";
    document.getElementById(qty).value="";
    document.getElementById(usd).value="";
    document.getElementById(amtusd).value="";
    
x++;
}
document.getElementById('tot_qty').value="";
document.getElementById('tot_amt').value="";
document.getElementById('tot_amt_rs').value="";

}

function SetInvoice4pack(a,totamt,totqty,totexamt,totpayamt,totaypayamt,totexamtword,totaypayamtword,totamt1)
{ // alert(totamt+"*-*-*-*-*"+totqty+"----"+totexamt);
  ar=a.split("||");

;
i=0; j=1;
for(x=1;x<ar.length;x++)
{
  //alert(ar[i]+"in loop");
    ardet=ar[i].split("|");

    //alert(ardet[y]+"in sec loop");
    statnum="statnum"+j;
    qty="qty"+j;
    usd="usd"+j;


    document.getElementById(statnum).value=ardet[0];
    document.getElementById(qty).value=ardet[1];
    document.getElementById(usd).value=ardet[2];
    //alert(statnum+"----------"+qty+"----------"+vfob);
  j++;
  i++;
}
tot_pamt= totpayamt.split("*");
var n=1;
for(y=0;y<tot_pamt.length;y++)
{//alert(tot_pamt[y]);
  amtusd="amtusd"+n;
  //alert(amtusd+"\n"+tot_pamt[y]);
  document.getElementById(amtusd).value=tot_pamt[y];
  n++;
}

document.getElementById('tot_qty').value=totqty;
document.getElementById('tot_amt').value=totamt;
document.getElementById('vatsubtotal').value=totamt1;
document.getElementById('tot_amt_rs').value=totexamt;
document.getElementById('tot_payableamt').value=totaypayamt;
document.getElementById('fob_inwords').value=totexamtword;
document.getElementById('duty_inwords').value=totaypayamtword;
}

function Setpack4ship(a)
{
  //alert(a+"-----------------");
  var adet = new Array();
  var mrknum = new Array();
  adet = a.split("*");
  //alert(adet);
  var x=0;
  var i=1;var j=1;var y=0;

  mark_num=adet[0];

  mrknum=mark_num.split("|");
  wt= adet[1];
  tot_wt=wt.split("||");
  while(y<mrknum.length)
  {
  marknum="marknum"+j;
  document.getElementById(marknum).value=mrknum[y];
  j++;
  y++;
  }

  while(x<tot_wt.length)
  {
  document.getElementById('nopackage').value=tot_wt[0];
  document.getElementById('gross_weight').value=tot_wt[1];
  //j++;
  //y++;
  x++;
  }

}

function getcustomsagent()
{
  var aind = document.forms[0].custome_house_agent_sel.selectedIndex;
  document.forms[0].custome_house_agent.value = document.forms[0].custome_house_agent_sel[aind].text;
}


function GetAllShip2Customers(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getcustomeraddress4ar.php?reasontext=" + rt, "Customers", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetShip2Customer(customer,custaddress) {
//alert(custaddress);
var contdet = custaddress.split("|");
//alert(contdet[12]);
document.forms[0].ship2company.value = customer;
//document.getElementById("ba1").innerHTML= contdet[0] +" "+ contdet[1];
//document.getElementById("ba2").innerHTML= contdet[2]+" "+ contdet[3]+" "+ contdet[4];
//document.getElementById("ba3").innerHTML= contdet[5] ;
//document.getElementById("sa1").innerHTML= contdet[6] +" "+ contdet[7];
//document.getElementById("sa2").innerHTML= contdet[8]+" "+ contdet[9]+" "+ contdet[10];
//document.getElementById("sa3").innerHTML= contdet[11] ;
document.forms[0].ship2companyrecnum.value= contdet[12] ;
//document.forms[0].ship2companycategory.value = contdet[15];
    var str=document.forms[0].ship2company.value;
    var patt=/tara aerospace/gi;
    var result=patt.test(str);
if(result)
  {
    document.getElementById('currchange').innerHTML ='Rupees';
    document.getElementById('change_curr').innerHTML ='Amt Payable Rupees';
    document.getElementById('total_currchange').innerHTML ='Total Rupees';
    document.getElementById('total_curr_change').innerHTML ='Total Rupees';
  } else
  {
    document.getElementById('currchange').innerHTML ='USD';
    document.getElementById('change_curr').innerHTML ='Amt Payable USD';
    document.getElementById('total_currchange').innerHTML ='Total USD';
    document.getElementById('total_curr_change').innerHTML ='Total USD';
  
  }
}

function GetAllCustomers(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getallcustomeraddress4ar.php?reasontext=" + rt, "Customers", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetCustomer(customer,custaddress) {
//alert(custaddress);
var contdet = custaddress.split("|");
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
