function getInvoice(rt)
{
  var param = rt;
 var winWidth = 1000;
 var winHeight = 400;
 var winLeft = (screen.width-winWidth)/2;
 var winTop = (screen.height-winHeight)/2;
 var invnum = document.forms[0].invnum.value;
 //alert(invnum);
 win1 = window.open("getinvoice4shipping.php?reasontext=" + rt + "&invnum="+invnum, "invoice4shipping", +
 "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
 ",width=" + winWidth + ",height=" + winHeight +
 ",top="+winTop+",left="+winLeft);
 
 var x=1;
var max=document.forms[0].index.value;
while(x<max)
{
statnum="statnum"+x;
qty="qty"+x;
vfob="vfob"+x;
    document.getElementById(statnum).value="";
    document.getElementById(qty).value="";
    document.getElementById(vfob).value="";
x++;
}
}
function SetInvoice(invoice,invoicearr)
{
  // alert(invoice+"************"+invoicearr);
  var invdet = invoice.split("|");
  //document.forms[0].elements[fieldname].value = CIMdet[1];

  document.forms[0].invnum.value = invdet[1];
  document.forms[0].invdate.value = invdet[2];
  document.forms[0].company.value = invdet[3];
  document.forms[0].shipcompany.value = invdet[4];
  
  document.forms[0].ship2customer.value = invdet[11];
  
  document.forms[0].pre_carriage.value = invdet[5];
  document.forms[0].place_receipt.value = invdet[6];
  document.forms[0].port_loading.value = invdet[9];
        //document.forms[0].rm_type.value = CIMdet[12];
  document.forms[0].port_discharge.value = invdet[10];
  document.forms[0].country_desti.value = invdet[7];
  document.forms[0].invrecnum.value = invdet[0];
  document.forms[0].vesselnum.value = invdet[8];
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

function printshipping(recnum) {
//printShipping
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
alert("Please Select Bypass Tray\n");
win1 = window.open("shippingPrint.php?shiprecnum=" + recnum, "printShipping",
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

    if (document.forms[0].invnum.value.length == 0 || document.forms[0].invnum.value=='undefined')
    {
         errmsg += 'Please select a valid invoice number\n';
    }
	if (document.forms[0].exchange_rate.value.length == 0)
    {
         errmsg += 'Please enter a number for exchange rate\n';
    }

    if (document.forms[0].sbdate.value.length == 0)
    {
         errmsg += 'Please enter SB date\n';
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
      //alert(max+"here");
      while (x < max)
    {
        ln ="linenum" + x;
        marknum="marknum"+x;
        statnum="statnum"+x;

        lnv = document.getElementById(ln).value;


       if ((document.getElementById(ln).value.length ==0)&& (document.getElementById(marknum).value.length ==0)&&(document.getElementById(statnum).value.length ==0))
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

              if ((document.getElementById(ln).value.length ==0 ) &&(document.getElementById(marknum).value.length != 0 ||document.getElementById(statnum).value.length != 0 ))
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
win1 = window.open("getPacking4shipping.php", "Packing", +
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
  var winWidth = 200;
  var winHeight = 400;
  var winLeft = (screen.width-winWidth)/2;
  var winTop = (screen.height-winHeight)/2;
  var invnum= document.forms[0].invnum.value;
  win1 = window.open("getInvDet4shipping.php?invnum="+invnum, "Packing", +
  "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
  ",width=" + winWidth + ",height=" + winHeight +
  ",top="+winTop+",left="+winLeft);
  
var x=1;
var max=document.forms[0].index.value;
while(x<max)
{
statnum="statnum"+x;
qty="qty"+x;
vfob="vfob"+x;
    document.getElementById(statnum).value="";
    document.getElementById(qty).value="";
    document.getElementById(vfob).value="";
x++;
}

}

function SetInvoice4pack(a)
{
  ar=a.split("||");

var y=0;
i=0; j=1;
for(x=1;x<ar.length;x++)
{
  //alert(ar[i]+"in loop");
  ardet=ar[i].split("|");
  
    //alert(ardet[y]+"in sec loop");
    statnum="statnum"+j;
    qty="qty"+j;
    vfob="vfob"+j;


    document.getElementById(statnum).value=ardet[0];
    document.getElementById(qty).value=ardet[1];
    document.getElementById(vfob).value=ardet[2];
    //alert(statnum+"----------"+qty+"----------"+vfob);
  j++;
  i++;
}
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
  document.getElementById('net_weight').value=tot_wt[0];
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

