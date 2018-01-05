function putfocus()
{
   document.forms[0].company.focus();
}

function GetAllCustomers(rt)
{
 var param = rt;
 var winWidth = 300;
 var winHeight = 300;
 var winLeft = (screen.width-winWidth)/2;
 var winTop = (screen.height-winHeight)/2;
  var x=1;
      var max=document.forms[0].index.value;
       while (x < max)
    {
            ponum = "ponum_li" + x;

          document.getElementById(ponum).value="";

          x++;
     }
 //document.getElementById('ponum').value="";
 document.getElementById('cim_invoice').value="";
 win1 = window.open("getcustomeraddress.php?reasontext=" + rt, "Customers", +
 "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
 ",width=" + winWidth + ",height=" + winHeight +
 ",top="+winTop+",left="+winLeft);
}

function SetCustomer(customer,custaddress) {
var contdet = custaddress.split("|");
document.forms[0].company.value = customer;
//document.getElementById("ba1").innerHTML= contdet[0] +" "+ contdet[1];
//document.getElementById("ba2").innerHTML= contdet[2]+" "+ contdet[3]+" "+ contdet[4];
//document.getElementById("ba3").innerHTML= contdet[5] ;
//document.getElementById("sa1").innerHTML= contdet[6] +" "+ contdet[7];
//document.getElementById("sa2").innerHTML= contdet[8]+" "+ contdet[9]+" "+ contdet[10];
//document.getElementById("sa3").innerHTML= contdet[11] ;
document.forms[0].companyrecnum.value= contdet[12] ;
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

function addRow4int(id,index){

var index=parseInt(index);
 //alert(index+"*-------");
linenum="line_num" + index;
len ="length" + index;
width_po="width_po" + index;
thickness="thickness" + index;
net_weight ="net_weight" + index;
tot_weight = "tot_weight" + index;
numboxes = "numboxes" + index;
prevlinenum = "prevlinenum" + index;
lirecnum = "lirecnum" + index;

var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");

row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","4");
inp1.setAttribute("name",linenum);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","5");
inp2.setAttribute("name",len);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","5");
inp3.setAttribute("name",width_po);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","5");
inp4.setAttribute("name",thickness);
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","5");
inp5.setAttribute("name",net_weight);
cell5.appendChild(inp5);

var cell6 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","5");
inp6.setAttribute("name",tot_weight);
cell6.appendChild(inp6);

var cell7 = document.createElement("TD");
var inp7 = document.createElement("INPUT");
inp7.setAttribute("type","hidden");
inp7.setAttribute("value","");
inp7.setAttribute("name",prevlinenum);
cell7.appendChild(inp7);

var cell8 = document.createElement("TD");
var inp8 = document.createElement("INPUT");
inp8.setAttribute("type","hidden");
inp8.setAttribute("value","");
inp8.setAttribute("name",lirecnum);
cell8.appendChild(inp8) ;

var cell9 = document.createElement("TD");
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","5");
inp9.setAttribute("name",numboxes);
cell9.appendChild(inp9);

row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell6);
row.appendChild(cell9);

tbody.appendChild(row);

index++;

document.forms[0].index.value=index;
document.forms[0].curindex.value=index;
}

function addRow(id,index){

var x=parseInt(index);

linenum="line_num"+x;
  //alert(linenum+"*-------");
len="length"+x;
  //alert(len+"^^^^^^-------");
width_po="width_po"+x;
thickness="thickness"+x;
net_weight="net_weight"+x;
tot_weight="tot_weight"+x;
numboxes="numboxes"+x;

var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");

row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","4");
inp1.setAttribute("name",linenum);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","5");
inp2.setAttribute("name",len);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","5");
inp3.setAttribute("name",width_po);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","5");
inp4.setAttribute("name",thickness);
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","5");
inp5.setAttribute("name",net_weight);
cell5.appendChild(inp5);

var cell6 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","5");
inp6.setAttribute("name",tot_weight);
cell6.appendChild(inp6);

var cell9 = document.createElement("TD");
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","5");
inp9.setAttribute("name",numboxes);
cell9.appendChild(inp9);

row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell6);
row.appendChild(cell9);
tbody.appendChild(row);

x++;
document.forms[0].index.value=x;
document.forms[0].curindex.value=x;
}


function printpacking(recnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("packingPrint.php?recnum=" + recnum, "printpacking",
+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}
function GetCustpo(index)
{
//alert(index+"here----");
if(document.forms[0].company.value.length==0)
{
  alert("Please Select A Customer");
  return false;
}
else
{
var recnum4company=document.getElementById('companyrecnum').value;
//alert("here1111111"+recnum4company);
var winWidth = 400;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getcustpo4packing.php?companyrecnum="+recnum4company+"&index="+index, "CustPo", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft+",dependent=yes");
}
}
function setcustpo(custpo,custpoarr,index)
{   //alert(index);
  //alert(custpo+"-----------------------"+custpoarr);
  var custdet = custpoarr.split("|");
  if(index !='this')
  {
     var id16="ponum_li"+ index;
     var text16= document.getElementById(id16);
     text16.value=custpo;
  }
  else
  {
    document.forms[0].ponum.value = custpo;
    //document.forms[0].custporecnum.value = custdet[1];
    document.forms[0].podate.value = custdet[2];
  }


}

function GetInvoice()
{
if(document.forms[0].company.value.length==0)
{
  alert("Please Select A Customer");
  return false;
}
else
{
var recnum4company=document.getElementById('companyrecnum').value;
//alert("here1111111"+recnum4company);
var winWidth = 400;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getpackinginvoice.php?companyrecnum="+recnum4company, "CustPo", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft+",dependent=yes");
}
}
function setInvoice(custinvoice)
{
  //alert(custinvoice+"in JS");
  //var invoicedet = custinvoicearr.split("|");
  document.forms[0].cim_invoice.value = custinvoice;
  //document.forms[0].ciminvoicerecnum.value = invoicedet[1];
  //document.forms[0].podate.value = invoicedet[2];
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
     if (document.forms[0].cim_invoice.value.length == 0)
    {
         errmsg += 'Please enter invoice number\n';
    }
     if (document.forms[0].ponum.value.length == 0)
    {
         errmsg += 'Please enter customer PO# \n';
    }
    if (document.forms[0].packingnum.value.length == 0)
    {
         errmsg += 'Please enter Packing No. \n';
    }
/*
    if ((document.getElementById('podate').value =="")||(document.getElementById('podate').value =="0000-00-00"))
    {
         errmsg += 'Please enter po date\n';
    }
*/
    if ((document.getElementById('order_qty').value.length ==0)||(document.getElementById('qty_disp').value.length ==0) || (document.getElementById('qty_bal').value.length ==0))
    {
         errmsg += 'Please Enter Order Qty,Qty for Shipment\nand Qty Balance(dispatch) \n';
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
            len = "length" + x;
            width_po= "width_po"+ x;
            thickness="thickness"+x;

       if ((document.getElementById(ln).value.length ==0)&& (document.getElementById(len).value.length ==0)&&(document.getElementById(width_po).value.length ==0)&&(document.getElementById(thickness).value.length ==0))
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
            if  ((document.getElementById(len).value ==""))
             {
                errmsg += 'Please enter length for Seq # '  + lnv + '\n';
             }
              if (document.getElementById(width_po).value =="")
             {
             errmsg += 'Please enter width for Seq # '  + lnv + '\n';
             }
             if (document.getElementById(thickness).value =="")
             {
             errmsg += 'Please enter thickness for Seq # '  + lnv + '\n';
             }
              if ((document.getElementById(ln).value.length ==0 ) &&(document.getElementById(len).value.length != 0 ||document.getElementById(width_po).value.length != 0 ))
              {
                          errmsg += 'Please enter Seq # \n';
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

function onSelectType(packingtype)
{
    if(packingtype.value=='')
    {
      alert("Please select a Box Type\n");
      return false;
    }else
    {
	document.getElementById('type_packing').value = packingtype.value;
	return true;
    }

}

function ConfirmDelete() {
//alert("HERE----");
     document.forms[0].deleteflag.value = "y";
     return true;
}


