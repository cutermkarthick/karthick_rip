/*
 * salesorder.js
 * validation for quotes
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
 */
function getLIs(reviewrecnum,salesorderrecnum)
{
    //alert('hi');
	var ajaxRequest;  // The variable that makes Ajax possible!

	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			   }
            catch (e)
               {
				// Something went wrong
				alert("Your browser broke!");
				return false;
			   }
		}
	}
	// Create a function that will receive data sent from the server
	 ajaxRequest.onreadystatechange = function(){
	        if(ajaxRequest.status == 200)
            {
		      if(ajaxRequest.readyState == 4){
			    document.getElementById('myLI').innerHTML = ajaxRequest.responseText;
		      }
	        }
	}
	//alert("Here1");
	ajaxRequest.open("POST", "addLIs.php?reviewrecnum="+reviewrecnum + "&salesorderrecnum=" + salesorderrecnum, true);
	ajaxRequest.send(null);
}
function GetReviewRef(rt,ind) {
var param = rt;
//alert(param);
//alert(document.forms[0].index.value);
/*if (param == 'editso' && document.forms[0].index.value != 1)
{
	 alert("Please delete all line items before Getting Contract Review Ref");
	 return false;
}*/
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getreviewref.php?reasontext=" + rt + "&salesrecnum=" + ind, "Review",+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetReviewref(reviewref,salesrecnum) {
//alert(reviewref);
var salesorderrecnum = salesrecnum;
var rev = reviewref.split("|");
document.forms[0].reviewref.value = rev[1];
document.forms[0].reviewrefrecnum.value=rev[0];
document.forms[0].rscustomer.value=rev[2];
document.forms[0].order_date.value=rev[4];
document.forms[0].po_num.value=rev[3];
document.forms[0].quote_num.value=rev[5];
document.forms[0].special_instruction.value=rev[6];
document.forms[0].amendmentnum.value=rev[7];
document.forms[0].amendmentdate.value=rev[8];
document.forms[0].description.value=rev[9];
reviewrecnum=rev[0];
getLIs(reviewrecnum,salesorderrecnum);
//document.forms[0].index.value = document.forms[0].index1.value;
}

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
document.forms[0].companyrecnum.value=custrecnum;
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
document.forms[0].quote_date.value = duedate;
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
//hcdrgiss="hcdrgiss"+index;
partiss="partiss"+index;
//hcpartiss="hcpartiss"+index;
po_cos="po_cos"+index;
//hc_cos="hc_cos"+index;
model_iss="model_iss"+index;
price="price"+index;
amount="amount"+index;
rmprice="rmprice"+index;
rmamount="rmamount"+index;
mcprice="mcprice"+index;
mcamount="mcamount"+index;


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
inp6.setAttribute("size","10");
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

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","10");
inp4.setAttribute("name",price);
inp4.setAttribute("id",price);
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","10");
inp5.setAttribute("readonly",'readonly');
inp5.style.backgroundColor = "#DDDDDD";
inp5.setAttribute("name",amount);
inp5.setAttribute("id",amount);
cell5.appendChild(inp5);

var cell13 = document.createElement("TD");
var inp13 =  document.createElement("INPUT");
inp13.setAttribute("type","text");
inp13.setAttribute("size","10");
inp13.setAttribute("name",rmprice);
inp13.setAttribute("id",rmprice);
cell13.appendChild(inp13);

var cell14 = document.createElement("TD");
var inp14 =  document.createElement("INPUT");
inp14.setAttribute("type","text");
inp14.setAttribute("size","10");
inp14.setAttribute("readonly",'readonly');
inp14.style.backgroundColor = "#DDDDDD";
inp14.setAttribute("name",rmamount);
inp14.setAttribute("id",rmamount);
cell14.appendChild(inp14);

var cell15 = document.createElement("TD");
var inp15 =  document.createElement("INPUT");
inp15.setAttribute("type","text");
inp15.setAttribute("size","10");
inp15.setAttribute("name",mcprice);
inp15.setAttribute("id",mcprice);
cell15.appendChild(inp15);

var cell16 = document.createElement("TD");
var inp16 =  document.createElement("INPUT");
inp16.setAttribute("type","text");
inp16.setAttribute("size","10");
inp16.setAttribute("readonly",'readonly');
inp16.style.backgroundColor = "#DDDDDD";
inp16.setAttribute("name",mcamount);
inp16.setAttribute("id",mcamount);
cell16.appendChild(inp16);

/*
var cell17 = document.createElement("TD");
var inp17 =  document.createElement("INPUT");
inp17.setAttribute("type","text");
inp17.setAttribute("size","10");
inp17.setAttribute("name",hcdrgiss);
inp17.setAttribute("id",hcdrgiss);
cell17.appendChild(inp17);

var cell18 = document.createElement("TD");
var inp18 =  document.createElement("INPUT");
inp18.setAttribute("type","text");
inp18.setAttribute("size","10");
inp18.setAttribute("name",hcpartiss);
inp18.setAttribute("id",hcpartiss);
cell18.appendChild(inp18);

var cell20 = document.createElement("TD");
var inp20 =  document.createElement("INPUT");
inp20.setAttribute("type","text");
inp20.setAttribute("size","10");
inp20.setAttribute("name",hc_cos);
inp20.setAttribute("id",hc_cos);
cell20.appendChild(inp20);      */

var cell19 = document.createElement("TD");
var inp19 =  document.createElement("INPUT");
inp19.setAttribute("type","text");
inp19.setAttribute("size","10");
inp19.setAttribute("name",po_cos);
inp19.setAttribute("id",po_cos);
cell19.appendChild(inp19);



var cell21 = document.createElement("TD");
var inp21 =  document.createElement("INPUT");
inp21.setAttribute("type","text");
inp21.setAttribute("size","10");
inp21.setAttribute("name",model_iss);
inp21.setAttribute("id",model_iss);
cell21.appendChild(inp21);

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
row.appendChild(cell3);
row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell8);
row.appendChild(cell9);
//row.appendChild(cell17);
row.appendChild(cell10);
//row.appendChild(cell18);
row.appendChild(cell19);
//row.appendChild(cell20);
row.appendChild(cell21);
row.appendChild(cell2);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell13);
row.appendChild(cell14);
row.appendChild(cell15);
row.appendChild(cell16);
row.appendChild(inp11);
row.appendChild(inp12);
tbody.appendChild(row);
x++;
//alert("i am here");
document.myForm.index.value=x;

}



function GetDueDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 350;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "duedateDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetDueDate(due_date) {
document.forms[0].delivarydate.value = due_date;
}

function GetDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 350;
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
		document.forms[0].so2employee.value = emp;
		document.forms[0].salespersonrecnum.value = emprecnum;
		}

function GetContact(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var customerrecnum = document.forms[0].companyrecnum.value;
var customer = document.forms[0].company.value;
if (document.forms[0].company.value == '')
{ alert("Please select a customer before selecting a contact");
  return false;
}
win1 = window.open("contact.php?reasontext=" + customerrecnum + "&customer=" + customer,"Contact", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetContact(contact,contarr) {
document.forms[0].contact.value = contact;
var contdet = contarr.split("|");
document.forms[0].phone.value = contdet[1];
document.forms[0].email.value = contdet[2];
document.forms[0].contactrecnum.value = contdet[0];

}
function GetQuoteNo() {
var winWidth = 575;
var winHeight = 375;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getQuote.php","link", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetQuoteNo(inpquoterecnum,inpquotenum) {
var quoterecnum=inpquoterecnum;
var quotenum=inpquotenum;

document.forms[0].quoterecnum.value= quoterecnum;
document.forms[0].quote_num.value=quotenum;
 //alert(document.forms[0].quoterecnum.value);
}

function GetPONo() {
var winWidth = 575;
var winHeight = 375;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getpo.php","link", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetPONo(inpporecnum,inpponum) {
var porecnum=inpporecnum;
var po_num=inpponum;
document.forms[0].porecnum.value=porecnum;
document.forms[0].po_num.value=po_num;
//alert(document.forms[0].porecnum.value);
}

function onSelectcurrency()
        {
        var aind = document.forms[0].currency1.selectedIndex;
        document.forms[0].currency.value = document.forms[0].currency1[aind].text;
        document.forms[0].salval.value = document.forms[0].currency1[aind].text;

        }
function searchsort_fields()
{
/*    var ind1 = document.forms[0].cname.selectedIndex;
    var ind2 = document.forms[0].salesorder_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].salesorderfl.value = document.forms[0].salesorder[ind1].text;
    document.forms[0].salesorder_oper.value = document.forms[0].salesorder_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;
*/
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
function check_req_fields1(page,type)
{
    var x = 1;
    var errmsg = '';
    var cntrl = '';
    var liflag = 0;
    var licount = document.getElementById('index').value;
    //document.getElementById('stype').value = type;
    //alert (document.getElementById('index').value);
    if (document.forms[0].company.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please select Customer\n';
    }
    if (document.forms[0].po_num.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please enter Po Num\n';
    }
    if (document.forms[0].order_date.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please enter Order Date.\n';
    }
    if (document.forms[0].quote_num.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please enter Order/Quote Ref.\n';
    }
    if (document.forms[0].special_instruction.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please enter special instructions\n';
    }

    if (document.forms[0].contact.value.length == 0)
    {
         errmsg += 'Please Enter Customer Contact\n';
    }
    if (document.forms[0].phone.value.length == 0)
    {
         errmsg += 'Please Enter Customer phone\n';
    }
    if (document.forms[0].email.value.length == 0)
    {
         errmsg += 'Please enter Customer Email\n';
    }
    if (document.forms[0].amendmentnum.value.length == 0)
    {
         errmsg += 'Please enter Amendment.\n';
    }
    if (document.forms[0].amendmentdate.value.length == 0)
    {
         errmsg += 'Please enter Amendment Date.\n';
    }
    // if (document.forms[0].person.value.length == 0)
    // {
    //      errmsg += 'Please enter Contact Perrson.\n';
    // }
    // if (document.forms[0].create_date.value.length == 0 || document.forms[0].create_date.value == '0000-00-00')
    // {
    //      errmsg += 'Please enter Create Date.\n';
    // }
    if(page == 'edit_so')
    {

       if (document.forms[0].eng_app.value=='yes' && 
		  
		   document.forms[0].status.value=='Pending')
      {
         errmsg += 'Please change the status to Open.\n';
      }
	  if (document.forms[0].eng_app.value=='no'  
		  && document.forms[0].status.value=='Open')
      {
         errmsg += 'Cannot change status to Open with Approval pending.\n';
      }	  
      if(type != 'save')
      {
        if (document.forms[0].notes.value.length == 0 &&
			(document.forms[0].eng_app.value=='yes' ||
			document.forms[0].qa_app.value=='yes' ||
			document.forms[0].prodn_app.value=='yes'))
       {
          errmsg += 'Please enter Notes.\n';
       }
      }

    }

    var seq_num=new Array();
    var seqlist = {};
    while (x < licount)
    {

       ln = "line_num" + x;
       lnv = document.getElementById(ln).value;
      // alert(document.getElementById(ln).value);
      if(seqlist[lnv] != undefined && seqlist[lnv] != '')
       { //alert("here");
               errmsg +='Duplicate Seq Number '+ lnv + '\n';
       }
      else {
        seqlist[lnv] = lnv;
      if (document.getElementById(ln).value.length != 0)
       {
           pn = "partnum" + x;
           if (document.getElementById(pn).value.length == 0)
           {
               errmsg += 'Please enter Part Number for line item ' + lnv + '\n';
           }
           crn = "crn_num" + x;
           if (document.getElementById(crn).value.length == 0)
           {
               errmsg += 'Please enter PRN for line item ' + lnv + '\n';
           }
           pd = "item_desc" + x;
           if (document.getElementById(pd).value.length == 0)
           {
               errmsg += 'Please enter Part Desc for line item ' + lnv + '\n';
           }
           rt = "rmtype" + x;
           if (document.getElementById(rt).value.length == 0)
           {
               //errmsg += 'Please enter RM Type for line item ' + lnv + '\n';
           }
           rm = "rmspec" + x;
           if (document.getElementById(rm).value.length == 0)
           {
               errmsg += 'Please enter RM Spec for line item ' + lnv + '\n';
           }
           partiss = "partiss" + x;
           if (document.getElementById(partiss).value.length == 0)
           {
               errmsg += 'Please enter Partiss for line item ' + lnv + '\n';
           }
           drgiss = "drgiss" + x;
           if (document.getElementById(drgiss).value.length == 0)
           {
               errmsg += 'Please enter Drgiss for line item ' + lnv + '\n';
           }
           qty = "qty" + x;
           if (document.getElementById(qty).value.length == 0)
           {
               errmsg += 'Please enter Qty for line item ' + lnv + '\n';
           }else if(document.getElementById(qty).value == 0)
           {
              errmsg += 'Qty cant be zero for line item ' + lnv + '\n';
           }
                            
           price = "price" + x;
           if (document.getElementById(price).value.length == 0)
           {
               errmsg += 'Please enter Price for line item ' + lnv + '\n';
           }

        liflag = 1;
       }
      }
       x++;
     }
     if (liflag == 0)
     {
            errmsg += 'At least one line item must be present ' + '\n';
     }

     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}
/*function save_alert()
{
  setTimeOut('sss',5000);
}*/

function printsoDetails(salesorderrecnum)
{
var winWidth = 1400;
var winHeight = 700;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printsoDetails.php?salesorderrecnum=" + salesorderrecnum, "PrintSO", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}
function printviewsoDetails(salesorderrecnum) {
var winWidth = 1200;
var winHeight = 700;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printviewsoDetails.php?salesorderrecnum=" + salesorderrecnum, "PrintSO", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}
function onSelectStatus()
{
   var aind = document.forms[0].active.selectedIndex;
   document.forms[0].status.value = document.forms[0].active[aind].text;
   document.forms[0].activeval.value = document.forms[0].active[aind].text;

}
function toggleValue(divid,chk)
{
 // alert(chk+"---"+divid);
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
 // if(divid == "qa_app" && cond==true)
 // {	 
 //   document.getElementById('qa_app_by').value=document.getElementById('userid').value;  
 // }
 if(divid == "eng_app" && chk.checked ==true)
 {
    // alert(document.getElementById('userid').value);
   document.getElementById('eng_app_by').value=document.getElementById('userid').value; 
   // alert(document.getElementById('eng_app_by').value);
 } 
 // else if(divid == "prodn_app" && chk.checked == true)
 // {	 
 //   document.getElementById('prodn_app_by').value=document.getElementById('userid').value; 
 // }
 // else if(divid == "qa_app" && cond==false)
 // {	 
 //   document.getElementById('qa_app_by').value='';   
 // }
 // else if(divid == "eng_app" && chk.checked ==false)
 // {
 //   document.getElementById('eng_app_by').value=''; 
 // } 
 // else if(divid == "prodn_app" && chk.checked == false)
 // {	 
 //   document.getElementById('prodn_app_by').value='';
 // }
}

function check_status()
{
 var errmsg = '';
 if(document.getElementById('qa_app').value == "yes" && document.getElementById('eng_app').value == "yes")
 {
    if(document.forms[0].status.value != 'Open')
    {
      errmsg += 'Status Should be Open.\n';
    }
 }
 else if(document.getElementById('qa_app').value == "no" || document.getElementById('eng_app').value == "no")
 {
    if(document.forms[0].status.value == 'Open')
    {
        errmsg += 'Status cannot be Open.\n';
    }
 }
 if (document.forms[0].notes.value.length == 0)
 {
        errmsg += 'Please enter Notes.\n';
 }
  if (document.forms[0].dept.value == 'QAAPP' && document.getElementById('qa_app').value == "no" && document.getElementById('eng_app').value == "yes")
  {
         errmsg += 'QA Approval should be done.\n';
  }
  if (document.forms[0].dept.value == 'ENGAPP' && document.getElementById('eng_app').value == "no")
  {
        errmsg += 'Engg Approval should be done.\n';
  }
    if (document.forms[0].dept.value == 'PRODNAPP' && document.getElementById('prodn_app').value == "no")
  {
        errmsg += 'Prodn Approval should be done.\n';
  }
  
 if (errmsg == '')
     return true;
 else
 {
     alert (errmsg);
     return false;
 }
}

function GetCrn4Soli(rt) {
var param = rt;

var cim = "crn_num"+rt;
var crnnum = document.getElementById(cim).value;
/*if(document.getElementById(cim).value.length==0)
{
 alert('Please enter CRN');
 return false;

}  */
//alert(crnnum+"in js");
var winWidth = 1250;
var winHeight = 400;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getcrn4soli.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetCIM(CIMarr,fieldname) {

var CIM = CIMarr.split("|");

var id1="crn_num"+ fieldname;
   //alert(id1);
   var text1= document.getElementById(id1);
   text1.value=CIM[0];


var id2="item_desc"+ fieldname;
   //alert(id2);
   var text2= document.getElementById(id2);
   text2.value=CIM[2];

   var id3="partnum"+ fieldname;
   var text3= document.getElementById(id3);
   text3.value=CIM[1];

   var id4="uom"+ fieldname;
   var text4= document.getElementById(id4);
   text4.value=CIM[6];

   var id5="dia"+ fieldname;
   var text5= document.getElementById(id5);
   text5.value=CIM[7];

   var id6="length"+ fieldname;
   var text6= document.getElementById(id6);
   text6.value=CIM[8];

   var id7="width"+ fieldname;
   var text7= document.getElementById(id7);
   text7.value=CIM[9];

   var id8="thickness"+ fieldname;
   var text8= document.getElementById(id8);
   text8.value=CIM[10];

   var id9="gf"+ fieldname;
   var text9= document.getElementById(id9);
   text9.value=CIM[11];

   var id10="maxruling"+ fieldname;
   var text10= document.getElementById(id10);
   text10.value=CIM[12];

   var id11="altspec"+ fieldname;
   var text11= document.getElementById(id11);
   text11.value=CIM[13];

   var id12="rmtype"+ fieldname;
   var text12= document.getElementById(id12);
   text12.value=CIM[3];

    var id13="rmspec"+ fieldname;
   var text13= document.getElementById(id13);
   text13.value=CIM[4];
   
  /* var id14="drgiss"+ fieldname;
   var text14= document.getElementById(id14);
   text14.value=CIM[14];
   
   var id15="partiss"+ fieldname;
   var text15= document.getElementById(id15);
   text15.value=CIM[15];
   
   var id16="cos_iss"+ fieldname;
   var text16= document.getElementById(id16);
   text16.value=CIM[16];*/
   

   var id18="condition"+ fieldname;
   var text18= document.getElementById(id18);
   text18.value=CIM[5];
   
   var id19="rmprice"+ fieldname;
   var text19= document.getElementById(id19);
   text19.value=CIM[17];
   

}
function custpoedit_notes(pagename)
{
	if(document.forms[0].notes.value == '')
	{
		alert("Please Enter Notes");
		return false;
	}
}



function printOrderDetails(salesorderrecnum)
{
var winWidth = 1400;
var winHeight = 700;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printOrderDetails.php?salesorderrecnum=" + salesorderrecnum, "PrintSO", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}