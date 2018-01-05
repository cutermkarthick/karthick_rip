/*
 * qualityplan.js
 * validation for qualityplan
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
*/

function putfocus()
{
   document.forms[0].company.focus();
}


function ConfirmDelete() {
     document.forms[0].deleteflag.value = "y";
     return true;
}

function onSelectStatus()
{

   var aind = document.forms[0].ordstat.selectedIndex;
   if (aind == 0)
   {
      alert ("Please select a valid Status");
      return false;
   }
   document.forms[0].status.value = document.forms[0].ordstat[aind].text;
   document.forms[0].activeval.value = document.forms[0].ordstat[aind].text;

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

function checkenter(event)
{
    var ind1 = document.forms[0].salesorder.selectedIndex;
    var ind2 = document.forms[0].salesorder_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].salesorderfl.value = document.forms[0].salesorder[ind1].text;
    document.forms[0].salesorder_oper.value = document.forms[0].salesorder_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

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
document.forms[0].name.value = customer;
//document.forms[0].companyrecnum.value=custrecnum;
}

function check_req_fields(page)
{
  //alert(page);
    //	alert ('function working');
	//return false;
    var errmsg = "";
    var liflag = 0;
    var pagename = page;
    if (document.forms[0].name.value.length == 0)
    {
    //alert ('function working inside1');
         errmsg += 'Please enter Customer Name \n';
    }

    if (document.forms[0].ordernum.value.length == 0)
    {
    //alert ('function working inside2');
         errmsg += 'Please enter Customer Order Number\n';
    }
    if (document.forms[0].person.value.length == 0)
    {
   //alert ('function working inside3');
         errmsg += 'Please enter Contact Person\n';
    }

    if (document.forms[0].quoterefnum.value.length == 0)
    {
    //alert ('function working inside4');
         errmsg += 'Please enter Quote Reference\n';
       // return false;
    }
    if (document.forms[0].orderdate.value.length == 0)
    {
    //alert ('function working inside4');
         errmsg += 'Please enter Order Date\n';
       // return false;
    }
    if (document.forms[0].amendment_num.value.length == 0)
    {
    //alert ('function working inside4');
         errmsg += 'Please enter Amendment Num\n';
       // return false;
    }
    if (document.forms[0].amendment_date.value.length == 0)
    {
    //alert ('function working inside4');
         errmsg += 'Please enter Amendment Date\n';
       // return false;
    }

    if (document.forms[0].special_instrns.value.length == 0)
    {
    //alert ('function working inside4');
         errmsg += 'Please enter Special Instructions\n';
       // return false;
    }
   if(pagename == 'edit_review')
   {
    if (document.forms[0].notes.value.length == 0)
    {
    //alert ('function working inside4');
         errmsg += 'Please enter Notes\n';
       // return false;
    }
   }
    var ind = document.forms[0].index.value;
    
    for(i=1; i<ind; i++)
    {
      //alert(ind);
      ln="line_num" +i;
	  lnv = document.getElementById(ln).value;
      if (document.getElementById(ln).value.length != 0)
      {
           pn = "partnum" + i;
           if (document.getElementById(pn).value.length == 0)
           {
               errmsg += 'Please enter Part Number for line item ' + lnv + '\n';
           }  
           pname = "item_desc" + i;
           if (document.getElementById(pname).value.length == 0)
           {
               errmsg += 'Please enter Part Name for line item ' + lnv + '\n';
           }  
	   rmt = "rmtype" + i;
           if (document.getElementById(rmt).value.length == 0)
           {
               errmsg += 'Please enter RM Type for line item ' + lnv + '\n';
           }         
	   rms = "rmspec" + i;
           if (document.getElementById(rms).value.length == 0)
           {
               errmsg += 'Please enter RM Spec for line item ' + lnv + '\n';
           }       
	   unit = "uom" + i;
           if (document.getElementById(unit).value.length == 0)
           {
               errmsg += 'Please enter UOM for line item ' + lnv + '\n';
           }    
	   di = "dia" + i;
           if (document.getElementById(di).value.length == 0)
           {
               errmsg += 'Please enter Dia for line item ' + lnv + '\n';
           }      
		   len = "length" + i;
           if (document.getElementById(len).value.length == 0)
           {
               errmsg += 'Please enter Length for line item ' + lnv + '\n';
           }  
	   wid = "width" + i;
           if (document.getElementById(wid).value.length == 0)
           {
           errmsg += 'Please enter Width for line item ' + lnv + '\n';
           }      
		   thick = "thickness" + i;
           if (document.getElementById(thick).value.length == 0)
           {
               errmsg += 'Please enter Thickness for line item ' + lnv + '\n';
           }      
	   grain = "gf" + i;
           if (document.getElementById(grain).value.length == 0)
           {
               errmsg += 'Please enter Grainflow for line item ' + lnv + '\n';
           }    
	   mr = "maxruling" + i;
           if (document.getElementById(mr).value.length == 0)
           {
               errmsg += 'Please enter Max Ruling for line item ' + lnv + '\n';
           }         
	   di = "drgiss" + i;
           if (document.getElementById(di).value.length == 0)
           {
               errmsg += 'Please enter Drawing Iss for line item ' + lnv + '\n';
           }         
	   pi = "partiss" + i;
           if (document.getElementById(pi).value.length == 0)
           {
               errmsg += 'Please enter Part Iss for line item ' + lnv + '\n';
           }         
	   mi = "model_iss" + i;
           if (document.getElementById(mi).value.length == 0)
           {
               errmsg += 'Please enter Model Iss for line item ' + lnv + '\n';
           }         

	   alt = "altspec" + i;
           if (document.getElementById(alt).value.length == 0)
           {
               errmsg += 'Please enter Alt Spec for line item ' + lnv + '\n';
           }         
	   quantity = "qty" + i;
           if (document.getElementById(quantity).value.length == 0 || document.getElementById(quantity).value == 0)
           {
               errmsg += 'Please enter Quantity for line item ' + lnv + '\n';
           }     
		  
         liflag = 1;
      }
 
    }
     if (liflag < 1)
     {
            errmsg += 'At least one line item must be present ' + '\n';
     }
     //alert("Valid Flag is " + valid);
  /*   if(valid == 'n')
     {
       alert('Please click Validate before submitting')
       return false;
     }*/
     if (errmsg == '')
        return true;
     else
     {
       alert (errmsg);
       return false;
     }
}


function printreviewDetails(reviewrecnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printreviewDetails.php?reviewrecnum=" + reviewrecnum, "PrintReview",

+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}

function addRow(id,index){

var x=index;
//alert("Here index is "+ x);
prevlinenum="prev_line_num"+index;
lirecnum="lirecnum"+index;
line_num="line_num"+index;
qty="qty"+index;
itemdesc="item_desc"+index;
partnum="partnum"+index;
rmtype="rmtype"+index;
rmspec="rmspec"+index;
drgiss="drgiss"+index;
uom="uom"+index;
partiss="partiss"+index;
dia="dia"+index;
width="width"+index;
length="length"+index;
model_iss="model_iss"+index;
price="price"+index;
amount="amount"+index;
rmprice="rmprice"+index;
rmamount="rmamount"+index;
mcprice="mcprice"+index;
mcamount="mcamount"+index;
crn_num="crn_num"+index;
grain_flow="gf"+index;
altspec="altspec"+index;
maxruling="maxruling"+index;
thickness="thickness"+index;
cos_iss="cos_iss"+index;

var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","10");
inp1.setAttribute("name",line_num);
inp1.setAttribute("id",line_num);
cell1.appendChild(inp1);

var cell20 = document.createElement("TD");
var inp20 =  document.createElement("INPUT");
inp20.setAttribute("type","text");
inp20.setAttribute("size","15");
inp20.setAttribute("name",crn_num);
inp20.setAttribute("id",crn_num);
cell20.appendChild(inp20);

var cell21 = document.createElement("TD");
var inp21 =  document.createElement("INPUT");
inp21.setAttribute("type","text");
inp21.setAttribute("size","10");
inp21.setAttribute("name",grain_flow);
inp21.setAttribute("id",grain_flow);
cell21.appendChild(inp21);

var cell22 = document.createElement("TD");
var inp22 =  document.createElement("INPUT");
inp22.setAttribute("type","text");
inp22.setAttribute("size","10");
inp22.setAttribute("name",altspec);
inp22.setAttribute("id",altspec);
cell22.appendChild(inp22);

var cell23 = document.createElement("TD");
var inp23 =  document.createElement("INPUT");
inp23.setAttribute("type","text");
inp23.setAttribute("size","10");
inp23.setAttribute("name",maxruling);
inp23.setAttribute("id",maxruling);
cell23.appendChild(inp23);

 var cell24 = document.createElement("TD");
var inp24 =  document.createElement("INPUT");
inp24.setAttribute("type","text");
inp24.setAttribute("size","10");
inp24.setAttribute("name",uom);
inp24.setAttribute("id",uom);
cell24.appendChild(inp24);

var cell25 = document.createElement("TD");
var inp25 =  document.createElement("INPUT");
inp25.setAttribute("type","text");
inp25.setAttribute("size","10");
inp25.setAttribute("name",dia);
inp25.setAttribute("id",dia);
cell25.appendChild(inp25);

var cell26 = document.createElement("TD");
var inp26 =  document.createElement("INPUT");
inp26.setAttribute("type","text");
inp26.setAttribute("size","10");
inp26.setAttribute("name",length);
inp26.setAttribute("id",length);
cell26.appendChild(inp26);

var cell27 = document.createElement("TD");
var inp27 =  document.createElement("INPUT");
inp27.setAttribute("type","text");
inp27.setAttribute("size","10");
inp27.setAttribute("name",thickness);
inp27.setAttribute("id",thickness);
cell27.appendChild(inp27);

var cell28 = document.createElement("TD");
var inp28 =  document.createElement("INPUT");
inp28.setAttribute("type","text");
inp28.setAttribute("size","10");
inp28.setAttribute("name",width);
inp28.setAttribute("id",width);
cell28.appendChild(inp28);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","10");
inp2.setAttribute("name",qty);
inp2.setAttribute("id",qty);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","10");
inp3.setAttribute("name",itemdesc);
inp3.setAttribute("id",itemdesc);
cell3.appendChild(inp3);

var cell6 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","15");
inp6.setAttribute("name",partnum);
inp6.setAttribute("id",partnum);
cell6.appendChild(inp6);

var cell7 = document.createElement("TD");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","10");
inp7.setAttribute("name",rmtype);
inp7.setAttribute("id",rmtype);
cell7.appendChild(inp7);

var cell8 = document.createElement("TD");
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","10");
inp8.setAttribute("name",rmspec);
inp8.setAttribute("id",rmspec);
cell8.appendChild(inp8);

var cell9 = document.createElement("TD");
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","10");
inp9.setAttribute("name",drgiss);
inp9.setAttribute("id",drgiss);
cell9.appendChild(inp9);

var cell10 = document.createElement("TD");
var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","10");
inp10.setAttribute("name",partiss);
inp10.setAttribute("id",partiss);
cell10.appendChild(inp10);

/*var cell13 = document.createElement("TD");
var inp13 =  document.createElement("INPUT");
inp13.setAttribute("type","text");
inp13.setAttribute("size","10");
inp13.setAttribute("name",hcdrgiss);
inp13.setAttribute("id",hcdrgiss);
//inp13.setAttribute("value",hcdrgiss);
cell13.appendChild(inp13);

var cell14 = document.createElement("TD");
var inp14 =  document.createElement("INPUT");
inp14.setAttribute("type","text");
inp14.setAttribute("size","10");
inp14.setAttribute("name",hcpartiss);
inp14.setAttribute("id",hcpartiss);
//inp14.setAttribute("value",hcpartiss);
cell14.appendChild(inp14); */

var cell15 = document.createElement("TD");
var inp15 =  document.createElement("INPUT");
inp15.setAttribute("type","text");
inp15.setAttribute("size","10");
inp15.setAttribute("name",cos_iss);
inp15.setAttribute("id",cos_iss);
//inp15.setAttribute("value",po_cos);
cell15.appendChild(inp15);

/*var cell16 = document.createElement("TD");
var inp16 =  document.createElement("INPUT");
inp16.setAttribute("type","text");
inp16.setAttribute("size","10");
inp16.setAttribute("name",hc_cos);
inp16.setAttribute("id",hc_cos);
//inp16.setAttribute("value",hc_cos);
cell16.appendChild(inp16);*/

var cell17 = document.createElement("TD");
var inp17 =  document.createElement("INPUT");
inp17.setAttribute("type","text");
inp17.setAttribute("size","10");
inp17.setAttribute("name",model_iss);
inp17.setAttribute("id",model_iss);
//inp17.setAttribute("value",model_iss);
cell17.appendChild(inp17);

var inp11 =  document.createElement("INPUT");
inp11.setAttribute("type","hidden");
inp11.setAttribute("value","");
inp11.setAttribute("id",prevlinenum);
inp11.setAttribute("name",prevlinenum);

var inp12 =  document.createElement("INPUT");
inp12.setAttribute("type","hidden");
inp12.setAttribute("value","");
inp12.setAttribute("id",lirecnum);
inp12.setAttribute("name",lirecnum);


row.appendChild(cell1);
row.appendChild(cell20);
//row.appendChild(cell3);
row.appendChild(cell6);
row.appendChild(cell3);
row.appendChild(cell7);
row.appendChild(cell8);
row.appendChild(cell24);
row.appendChild(cell25);
row.appendChild(cell26);
row.appendChild(cell28);
row.appendChild(cell27);
row.appendChild(cell21);
row.appendChild(cell23);
row.appendChild(cell22);
row.appendChild(cell9);
//row.appendChild(cell13);
row.appendChild(cell10);
//row.appendChild(cell14);
row.appendChild(cell15);
//row.appendChild(cell16);
row.appendChild(cell17);
row.appendChild(cell2);
row.appendChild(inp11);
row.appendChild(inp12);
tbody.appendChild(row);
x++;
//alert("i am here");
document.forms[0].index.value=x;

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

