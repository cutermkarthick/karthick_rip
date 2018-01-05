/*
 * invoice.js
 * validation for invoice
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
 */

function putfocus()
{
   document.forms[0].company.focus();
}

function getInvoice(rt)
{
  var param = rt;
 var winWidth = 800;
 var winHeight = 400;
 var winLeft = (screen.width-winWidth)/2;
 var winTop = (screen.height-winHeight)/2;
 var invnum = document.forms[0].invnum.value;
 win1 = window.open("getinvoice4shipper.php?reasontext=" + rt , "invoice4shipping", +
 "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
 ",width=" + winWidth + ",height=" + winHeight +
 ",top="+winTop+",left="+winLeft);
 
}
function SetInvoice(invoice,invoicearr)
{

  var invdet = invoicearr.split("|");
  //document.forms[0].elements[fieldname].value = CIMdet[1];
  //alert(invoice+"************"+invdet[11]);
  document.forms[0].invnum.value = invdet[1];
  document.forms[0].consignee_name.value = invdet[3];
 
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

function searchsort_fields()
{
    var ind1 = document.forms[0].salesorder.selectedIndex;
    var ind2 = document.forms[0].salesorder_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].salesorderfl.value = document.forms[0].salesorder[ind1].text;
    document.forms[0].salesorder_oper.value = document.forms[0].salesorder_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}


function check_req_fields()
{
	//alert ('function working');
	//return false;
    var errmsg = '';
    if (document.forms[0].company.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please select customer name \n';
    }

    if (document.forms[0].currency.value.length == 0)
    {
         //errmsg += 'Please enter a value for currency\n';
    }
    if (document.forms[0].invdate.value.length == 0)
    {
         errmsg += 'Please enter invoice date\n';
    }

        if (document.forms[0].fobcf.value.length == 0)
    {
        // errmsg += 'Please enter FOB/C&F value  \n';
    }
    

if((document.getElementById('duedate').value !="")&&(document.getElementById('duedate').value !="0000-00-00") && (document.getElementById('invdate').value !="")&&(document.getElementById('invdate').value !="0000-00-00"))
{
var date1=document.getElementById('duedate').value.split('-');
if(date1[2] >0 && date1[2]<10)
{
var dueday='0'+date1[2];
}
else
{
var dueday=date1[2];
}
dueyear=date1[0];
duemonth=date1[1];
due_date=String(dueyear)+String(duemonth)+String(dueday);

var date2=document.forms[0].invdate.value.split('-');
if(date2[2] >0 && date2[2]<10)
{
var invday='0'+date2[2];
}
else
{
var invday=date2[2];
}
invyear=date2[0];
invmonth=date2[1];
inv_date=String(invyear)+String(invmonth)+String(invday);

if(inv_date>due_date)
{
alert('Invoice Date cannot be Greater Than Due Date');
return false;
}
}
      var x=1;
      var max=document.forms[0].index.value;
      var seq_num=new Array();
      var seqlist = {};
      var lipresent = 0;
      while (x < max)
    {
        ln ="line_num" + x;

        lnv = document.getElementById(ln).value;
            crn = "crn" + x;
            qty= "qty"+ x;
            po_qty= "po_qty"+ x;


       if ((document.getElementById(ln).value.length ==0)&& (document.getElementById(crn).value.length ==0)&&(document.getElementById(qty).value.length ==0))
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
            if  ((document.getElementById(crn).value ==""))
             {
                errmsg += 'Please enter CRN for Seq # '  + lnv + '\n';
             }
              if (document.getElementById(qty).value =="")
             {
             errmsg += 'Please enter quantity for Seq # '  + lnv + '\n';
             }
              if ((document.getElementById(ln).value.length ==0 ) &&(document.getElementById(crn).value.length != 0 ||document.getElementById(qty).value.length != 0 ))
              {
                          errmsg += 'Please enter Seq # \n';
              }
              lnpoqty=parseInt(document.getElementById(po_qty).value);
              lnqty=parseInt(document.getElementById(qty).value);
              if (lnpoqty < lnqty)
              {
                        //  errmsg += 'The entered qty is greater than the available PO qty ' + lnpoqty +' for Seq # '  + lnv + '\n';
              }
              lipresent = 1;
        }
          x++;
    }
    if (lipresent == 0)
       {
             errmsg += 'At least one line item must be present\n';
       }

     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}


function printshipperloi(shipperloirecnum) {
//printinvoice(w/o raw mtl &tarrif)----printinvoiceDetails
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
//alert("Please Select Bypass Tray\n");
win1 = window.open("shipperPrint.php?shipperrecnum=" + shipperloirecnum, "PrintShipperloi",

+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}

function onSelectData(fieldvalue,fieldname)
{ // alert(fieldname+"in loop");

	document.getElementById(fieldname).value = fieldvalue.value;

//	alert(fieldvalue.value);

	//alert(document.getElementById(fieldname).value);
     return true;
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

}
function Setpack4ship(a)
{
  //alert(a+"-----------------");
  var str_di="";
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
    str_di=mrknum[y]+"\n"+str_di;
    y++;
  }
  //alert(str_di+"-----------");
  document.getElementById('dimension').value=str_di;
  while(x<tot_wt.length)
  {
  document.getElementById('nettwt').value=tot_wt[0];
  document.getElementById('grosstwt').value=tot_wt[1];
  document.getElementById('nmpkgs').value=tot_wt[2];

  x++;
  }

}

