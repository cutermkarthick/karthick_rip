/*
 * woentry.js
 * validation for boardwoEntry.php
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
 */

function addRow4int(id,ind1){
	// things to add
	ind1= parseInt(ind1);
	//alert(ind1);
	var y = ind1;
	mmline_num="mmline_num"+ind1;
	stage="stage"+ind1;
	from= "from" + ind1;
	to="to"+ind1;
	sampling="sampling"+ind1;
	rework="rework"+ind1;
	accept="accept"+ind1;
	reject="reject"+ind1;
	returns="returns"+ind1;
	date="date"+ind1;
	inspno="inspno"+ind1;

	signoff="signoff"+ind1;
	remarks="remarks"+ind1;
	intlirecnum="intlirecnum"+ind1;
	recno="recno"+ind1;
	dn="dn"+ind1;
	dn_sent="dn_sent"+ind1;
	dn_recv="dn_recv"+ind1;
	cofcnum="cofcnum"+ind1;
	suppwo="suppwo"+ind1;
	ncnum="ncnum"+ind1;
	hold="hold"+ind1;
	var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];

	var row = document.createElement("TR");
	row.style.backgroundColor = "#FFFFFF";

//intline_num
var cell0 = document.createElement("TD");

var inp0 = document.createElement("INPUT");
inp0.setAttribute("type","text");
inp0.setAttribute("size","4");
inp0.setAttribute("name",mmline_num);
inp0.setAttribute("id",mmline_num);
//inp1.setAttribute("value",irmline_num);
cell0.appendChild(inp0);

//stage
var cell8 = document.createElement("TD");

var inp8 = document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","5");
inp8.setAttribute("name",stage);
inp8.setAttribute("id",stage);
//inp1.setAttribute("value",irmline_num);
cell8.appendChild(inp8);

//mmlirecnum
var inp100 = document.createElement("INPUT");
inp100.setAttribute("type","hidden");
inp100.setAttribute("size","");
inp100.setAttribute("name",intlirecnum);
inp100.setAttribute("id",intlirecnum);
cell0.appendChild(inp100);
//recno
var inp101 = document.createElement("INPUT");
inp101.setAttribute("type","hidden");
inp101.setAttribute("size","");
inp101.setAttribute("name",recno);
inp101.setAttribute("id",recno);
cell0.appendChild(inp101);
//from
var cell1 = document.createElement("TD");

var inp1 = document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","4");
inp1.setAttribute("name",from);
inp1.setAttribute("id",from);
//inp1.setAttribute("value",irmline_num);
cell1.appendChild(inp1);
//to
var cell2 = document.createElement("TD");

var inp2 = document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","4");
inp2.setAttribute("name",to);
inp2.setAttribute("id",to);
//inp1.setAttribute("value",irmline_num);
cell2.appendChild(inp2);

//sampling
var cell3 = document.createElement("TD");

var inp3 = document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","8");
inp3.setAttribute("name",sampling);
inp3.setAttribute("id",sampling);
//inp1.setAttribute("value",irmline_num);
cell3.appendChild(inp3);
//accept
var cell5 = document.createElement("TD");

var inp5 = document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","4");
inp5.setAttribute("name",accept);
inp5.setAttribute("id",accept);
//inp1.setAttribute("value",irmline_num);
cell5.appendChild(inp5);
//rework
var cell4 = document.createElement("TD");

var inp4 = document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","4");
inp4.setAttribute("name",rework);
inp4.setAttribute("id",rework);
//inp1.setAttribute("value",irmline_num);
cell4.appendChild(inp4);

//reject
var cell6 = document.createElement("TD");

var inp6 = document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","4");
inp6.setAttribute("name",reject);
inp6.setAttribute("id",reject);
//inp1.setAttribute("value",irmline_num);
cell6.appendChild(inp6);
//returns
var cell7 = document.createElement("TD");

var inp7 = document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","4");
inp7.setAttribute("name",returns);
inp7.setAttribute("id",returns);
//inp7.setAttribute("readOnly","true");
//inp7.style.backgroundColor = "#DDDDDD";
//inp1.setAttribute("value",irmline_num);
cell7.appendChild(inp7);
 //date
var cell12 = document.createElement("TD");

var inp12 = document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","10");
inp12.setAttribute("name",date);
inp12.setAttribute("id",date);
inp12.setAttribute("readonly","readonly");
inp12.style.backgroundColor = "#DDDDDD";

var img1 = document.createElement("img");
img1.setAttribute("src","images/bu-getdateicon.gif");
img1.setAttribute("alt","GetDate");
img1.onclick = function(){GetDate("date"+y);};
cell12.appendChild(inp12);
cell12.appendChild(img1);
//inspno
var cell17 = document.createElement("TD");

var inp17 = document.createElement("INPUT");
inp17.setAttribute("type","text");
inp17.setAttribute("size","20");
inp17.setAttribute("name",inspno);
inp17.setAttribute("id",inspno);
//inp1.setAttribute("value",irmline_num);
cell17.appendChild(inp17);


//signoff
var cell9 = document.createElement("TD");

var inp9 = document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","20");
inp9.setAttribute("name",signoff);
inp9.setAttribute("id",signoff);
//inp1.setAttribute("value",irmline_num);
cell9.appendChild(inp9);
//remarks
var cell10 = document.createElement("TD");

var inp10 = document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","50");
inp10.setAttribute("name",remarks);
inp10.setAttribute("id",remarks);
//inp1.setAttribute("value",irmline_num);
cell10.appendChild(inp10);

// var cell18 = document.createElement("TD");
// var inp18 = document.createElement("INPUT");
// inp18.setAttribute("type","text");
// inp18.setAttribute("size","5");
// inp18.setAttribute("name",dn);
// inp18.setAttribute("id",dn);
// inp18.setAttribute("readOnly","true");
// inp18.style.backgroundColor = "#DDDDDD";
// cell18.appendChild(inp18);

// var cell19 = document.createElement("TD");
// var inp19 = document.createElement("INPUT");
// inp19.setAttribute("type","text");
// inp19.setAttribute("size","3");
// inp19.setAttribute("name",dn_sent);
// inp19.setAttribute("id",dn_sent);
// inp19.setAttribute("readOnly","true");
// inp19.style.backgroundColor = "#DDDDDD";
// cell19.appendChild(inp19);

// var cell20 = document.createElement("TD");
// var inp20 = document.createElement("INPUT");
// inp20.setAttribute("type","text");
// inp20.setAttribute("size","3");
// inp20.setAttribute("name",dn_recv);
// inp20.setAttribute("id",dn_recv);
// inp20.setAttribute("readOnly","true");
// inp20.style.backgroundColor = "#DDDDDD";
// cell20.appendChild(inp20);

var cell21 = document.createElement("TD");
var inp21 = document.createElement("INPUT");
inp21.setAttribute("type","text");
inp21.setAttribute("size","5");
inp21.setAttribute("name",cofcnum);
inp21.setAttribute("id",cofcnum);
inp21.setAttribute("readOnly","true");
inp21.style.backgroundColor = "#DDDDDD";
cell21.appendChild(inp21);

// var cell22 = document.createElement("TD");
// var inp22 = document.createElement("INPUT");
// inp22.setAttribute("type","text");
// inp22.setAttribute("size","5");
// inp22.setAttribute("name",suppwo);
// inp22.setAttribute("id",suppwo);
// inp22.setAttribute("readOnly","true");
// inp22.style.backgroundColor = "#DDDDDD";
// cell22.appendChild(inp22);

var cell23 = document.createElement("TD");
var inp23 = document.createElement("INPUT");
inp23.setAttribute("type","text");
inp23.setAttribute("size","4");
inp23.setAttribute("name",ncnum);
inp23.setAttribute("id",ncnum);
cell23.appendChild(inp23);

var cell24 = document.createElement("TD");
var inp24 = document.createElement("INPUT");
inp24.setAttribute("type","text");
inp24.setAttribute("size","4");
inp24.setAttribute("name",hold);
inp24.setAttribute("id",hold);
cell24.appendChild(inp24);

row.appendChild(cell0);
row.appendChild(cell8);
// row.appendChild(cell21);
// row.appendChild(cell22);
// row.appendChild(cell18);
// row.appendChild(cell19);
// row.appendChild(cell20);
row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell5);
row.appendChild(cell4);
row.appendChild(cell6);
row.appendChild(cell23);
row.appendChild(cell7);
row.appendChild(cell24);
row.appendChild(cell12);
row.appendChild(cell17);
row.appendChild(cell9);
row.appendChild(cell10);
tbody.appendChild(row);

ind1++;
document.forms[0].indexmm.value=ind1;
document.forms[0].curindex.value=ind1;

}

function setwotype()
{
	var aind = document.forms[0].wotype.selectedIndex;
	document.forms[0].wotypeval.value = document.forms[0].wotype[aind].text;
	return true;
}

function settrackingStatus()
{
	var aind = document.forms[0].track_status.selectedIndex;
	document.forms[0].tstatusval.value = document.forms[0].track_status[aind].text;
	//alert(document.forms[0].tstatusval.value);
}

function setshippingCarrier()
{
	var aind = document.forms[0].ship_carrier.selectedIndex;
	document.forms[0].ship_carrier_val.value = document.forms[0].ship_carrier[aind].text;
	//alert(document.forms[0].ship_carrier_val.value);
}
function setholdStatus(rt)
{
	hold="hold" + rt
	holdval="holdval" +rt;
	var aind = document.forms[0].elements[hold].selectedIndex;
	document.forms[0].elements[holdval].value =document.forms[0].elements[hold][aind].text;
}

function putfocus()
{
   document.forms[0].company.focus();
}

function GetOwner(rt){
//alert(rt);
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getowner.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetOwner(emp,emprecnum,fieldname){

// alert(fieldname);
//alert(document.forms[0].elements[fieldname]);
// alert(document.forms[0].elements[fieldname + "recnum"]);
// document.forms[0].elements[fieldname].value = emp;
// document.forms[0].elements[fieldname + "recnum"].value = emprecnum;
// alert(fieldname+"recnum");
// alert(document.getElementById(fieldname+"recnum").value);
document.getElementById(fieldname).value = emp;
document.getElementById(fieldname + "recnum").value = emprecnum;
// document.getElementById()
// alert(document.getElementById(fieldname+"recnum").value);



}

function GetCIM(rt) {
//alert(rt);
var param = rt;
var winWidth = 1000;
var winHeight = 350;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var wo_classif=document.getElementById('woclassif').value;
var wonum='';
if(wo_classif=='Migrate')
{
  if(document.getElementById('worefnum').value!='')
  {
    wonum=document.getElementById('worefnum').value;
  }else
  {
    alert("Please select WO Ref# \n");
    return false;
  }

 // settimeline(wonum,'Aerowings');

}
win1 = window.open("getCIM.php?wonum="+wonum, param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetCIM(CIMarr,fieldname,wostage) 
{
// alert(document.forms[0].elements[fieldname]);
//alert(document.forms[0].elements[fieldname + "recnum"]);
//alert(CIMarr);
//document.forms[0].elements[fieldname + "recnum"].value = CIMrecnum;
// alert(CIMarr);
// alert(CIMdet);
var CIMdet = CIMarr.split("|");
crn = CIMdet[9];
if(document.getElementById('mdproc').value=='mdentry')
{
setFair(crn) ;
getworkflow(crn);
}

//alert("here"+wostage);
//getCrnDetails(crn);
// alert(CIMdet);
//alert(CIMdet[13]);
//alert(CIMdet[14]);
//alert(CIMdet[15]);
document.forms[0].elements[fieldname].value = CIMdet[9];

document.forms[0].link2masterdata.value = CIMdet[0];
// alert(CIMdet[0]);
document.forms[0].partname.value = CIMdet[1];
// alert(CIMdet[1]);
document.forms[0].partnum.value = CIMdet[4];
// alert(CIMdet[4]);
document.forms[0].RM_by_CIM.value = CIMdet[5];
//s alert(CIMdet[5]);
document.forms[0].project.value = CIMdet[6];
document.forms[0].attachments.value = CIMdet[7];
document.forms[0].RM_by_customer.value = CIMdet[8];
document.forms[0].drg_issue.value = CIMdet[10];
//document.forms[0].rm_type.value = CIMdet[11];
//document.forms[0].rm_spec.value = CIMdet[12];
document.forms[0].rm_dim1.value = CIMdet[13];
document.forms[0].rm_dim2.value = CIMdet[14];
document.forms[0].rm_dim3.value = CIMdet[15];
document.forms[0].mps_rev.value = CIMdet[16];
document.forms[0].mps_num.value = CIMdet[17];
document.forms[0].drawing_num.value = CIMdet[18];
document.getElementById('poimg').value = CIMdet[4];
document.forms[0].cos.value = CIMdet[19];
document.forms[0].link2mps.value = CIMdet[20];
document.forms[0].ponum.value = '';
document.forms[0].po_qty.value = '';
document.forms[0].po_date.value = '';
document.forms[0].company.value = '';
document.forms[0].grnnum.value = '';


      

/*
if(wostage!='')
{
 document.forms[0].stage_split.value = wostage;
 document.forms[0].stage_split.setAttribute("readOnly",true);
 document.forms[0].stage_split.style.backgroundColor = "#DDDDDD";
}
*/

if(document.getElementById('mdproc').value=='mdentry' || 
	document.getElementById('mdproc').value=='mdedit'  )
{
	
    if(CIMdet[21] == "Treated" || CIMdet[21] == "Untreated" )
	{
    

        document.forms[0].treatment.value = CIMdet[21];
		document.forms[0].treatmentsel.style.backgroundColor = "#DDDDDD"; 
		document.forms[0].treatmentsel.disabled = true;
		return;
	}
	else if(CIMdet[21] == "")
	{
		document.forms[0].treatment.value = CIMdet[21];
		document.forms[0].treatmentsel.style.backgroundColor = "white";
		document.forms[0].treatmentsel.style.borderColor = "#b7c4f5";
		document.forms[0].treatmentsel.disabled = false;
	}

}


        
//document.forms[0].treatmentvalue =
//alert(document.getElementById('fair_stat').value);

}

function GetTreatment()
{
    // alert("hi");
	// alert(document.forms[0].treatment.value);
	document.forms[0].treatment.value = document.forms[0].treatmentsel.value ;
}


function setFair(crn)
{
     // alert(crn);
    $.ajax({
      url : "getFair_stat.php",
      type : "POST",
      dataType: "html",
      data : "crn="+crn,
      success : function (msg){
              $('#fair').html(msg);
              }
          })
}


function LinkGRN() {
//alert(rt);
var qty = document.forms[0].qty.value;
if (document.forms[0].qty.value == '')
{ alert("Please enter qty for Verification");
  return false;
}
var rmtype = document.forms[0].rm_type.value;
if (document.forms[0].rm_type.value == '')
{ alert("Please enter rm_type for Verification");
  return false;
}
var rmspec = document.forms[0].rm_spec.value;
if (document.forms[0].rm_spec.value == '')
{ alert("Please enter rm_spec for Verification");
  return false;
}
var rmdim1 = document.forms[0].rm_dim1.value;
if (document.forms[0].rm_dim1.value == '')
{ alert("Please enter rm_dim1 for Verification");
  return false;
}
var rmdim2 = document.forms[0].rm_dim2.value;
if (document.forms[0].rm_dim2.value == '')
{ alert("Please enter rm_dim2 for Verification");
  return false;
}
var rmdim3 = document.forms[0].rm_dim3.value;
if (document.forms[0].rm_dim3.value == '')
{ alert("Please enter rm_dim3 for Verification");
  return false;
}
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("linkwo2grn.php?qty=" + qty + "&rmtype=" + rmtype + "&rmspec=" + rmspec
+ "&rmdim1=" + rmdim1 + "&rmdim2=" + rmdim2 + "&rmdim3=" + rmdim3,"Linkwo2grn", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetGRN1(grns) {
document.forms[0].grnnum.value = grns;
}


function GetContact(rt)
{
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
function SetContact(contact,contarr)
{
document.forms[0].contact.value = contact;
var contdet = contarr.split("|");
document.forms[0].contactrecnum.value = contdet[0];
document.forms[0].phone.value = contdet[1];
document.forms[0].email.value = contdet[2];
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
function SetEmp(emp,emprecnum) {
document.forms[0].owner.value = emp;
document.forms[0].emprecnum.value = emprecnum;
}
function GetAllCustomers(rt) {
if(document.forms[0].woclassif.value != 'TR' && document.forms[0].woclassif.value != 'TR Assembly')
{
 alert('Get Customer not required if Work Order type is Regular or Rework');
 return false;
}else if(document.forms[0].woclassif.value == 'TR'||document.forms[0].woclassif.value == 'TR Assembly')
{ //alert("H==E==R==E=="+document.forms[0].woclassif.value);
  if(document.getElementById('mdproc').value=='mdentry')
{   //alert(document.getElementById('red_flag').value+"-----");
 if(document.getElementById('red_flag').value == '1')
 {
    alert('Please close red-highlighted work orders for this PRN \n');
    return false;
 }
/* if(document.getElementById('rework_flag').value == '1')
{
    alert('Rework \n');
    return false;
}*/
}
}
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getcustomers.php?reasontext=" + rt, "Customers", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft+",dependent=yes");
}
function SetCustomer(customer,custrecnum) {
document.forms[0].company.value = customer;
document.forms[0].companyrecnum.value = custrecnum;
}

function GetDate(rt) {


if(rt == 'act_ship_date')
{
  var j=1;
  var closing_flag = 0; var close_final=0; var close_post=0; var ncflag=0;
  var index_close = document.getElementById('approval_index').value;

  // alert(document.getElementById("approval_index").value);
  while(j<index_close)
  {
    datec = "datec"+j;


    if(document.getElementById(datec).value.length == 0)
    {
    	 // alert(document.getElementById(datec).value);
      closing_flag = 1;
    }
    j++;
  }
 // alert(document.getElementById('condition').value);
  if(document.getElementById('condition').value !='Closed')
  {
     alert("Please Change The Status to Closed");
     return;
  }
  var x=1;
  var max=document.forms[0].indexmm.value;
  while (x < max)
    {
        stagenum = "stage" + x;
        ncstat= "ncstat" +x;
        ncnum="ncnum"+x;
       if((document.getElementById('treatment').value=='Untreated') ||
           (document.getElementById('treatment').value=='Treated' && document.getElementById('woclassif').value == 'Rework'))
       {
/* Commented the following DN check line to allow for changing a Treatment part to Mfr
             if(document.getElementById(stagenum).value == "PostDN" || document.getElementById(stagenum).value == "DN")
               
                 alert("DN or PostDN not allowed For Manufacture ");
                 return;
               }
*/
           if((document.getElementById(stagenum).value == "fi"||document.getElementById(stagenum).value ==  "final"||document.getElementById(stagenum).value == "FINAL"||document.getElementById(stagenum).value == "FI"||document.getElementById(stagenum).value == "Final"||document.getElementById(stagenum).value == "Fi"))
           {
              close_final=1;
             //alert(close_final+"^^^^^^^^^^^^^^^^^^^\n");
           }
       }
       else if(document.getElementById('treatment').value=='Treated')
       {


         //  if(document.getElementById(stagenum).value == "PostDN")
         // {
         //   close_post=1;
         //   //alert(close_post+"%%%%%%%%%%%%%%%%%%%%%\n");
         // }
       }
/*
       if(document.getElementById(ncstat).value == 'Pending')
       {
          ncflag=1;
       }
*/
           x++;
    }
   // alert(document.getElementById('ncstat').value+"------------");
    if(document.getElementById('ncstat').value == 'Pending')
       {   alert('NC Is Pending Cannot Close The Wo');
           return false;
       }

 //alert(document.getElementById('approval_index').value);
 // alert(document.getElementById('treatment').value);
if(document.getElementById('treatment').value=='Untreated'||document.getElementById('treatment').value==''||document.getElementById('treatment').value=='null')
{
  if(closing_flag == 1 || close_final ==0)
 {
   alert('To close this WO'+'\n'+'All the stages has to be Approved before closing  and '+'\n'+'Final stage has to be entered');
   return false;

 }
}

else if(document.getElementById('treatment').value=='Treated' && 
	    document.getElementById('woclassif').value != 'Rework')
{
 if(closing_flag == 1)
  {
   alert('To close this WO'+'\n'+'All the stages has to be Approved before closing'+'\n');
   return false;
  }
}
// Added the following checks to allow for a Rework WO w/Treatment and without PostDN or DN entries
else if(document.getElementById('treatment').value=='Treated' && 
	    document.getElementById('woclassif').value == 'Rework')
{
 if(close_final == 0)
  {
   alert('To close this WO'+'\n'+'All the stages has to be Approved before closing');
   return false;
  }
}
/*if(closing_flag == 1 || ncflag==1)
{
  alert('NC: '+ document.getElementById(ncnum).value  + ' Is Pending Cannot Close The Wo');
   //return false;
} */

var y=1;
var mac=document.forms[0].indexmm.value;
sum=0;
var str_woqty = document.getElementById('qty').value;
var woqty = parseInt(str_woqty);
var amendqty1 = document.forms[0].amendqty.value;
 if (amendqty1 == 0 || amendqty1 == '' || amendqty1 == 'null')
 {
	 finalqty = woqty
 }
 else
{
	 finalqty = amendqty1
 }
 while (y < mac)
 {
  stagenum = "stage" + y;
  accpt= "accept"+ y;
            //date="date"+x;
  rework="rework"+y;
  reject="reject"+y;
  returns="returns"+y;
  hold="hold"+y;

  if((document.getElementById(stagenum).value == "fi"||document.getElementById(stagenum).value ==  "final"||document.getElementById(stagenum).value == "FINAL"||document.getElementById(stagenum).value == "FI"||document.getElementById(stagenum).value == "Final"||document.getElementById(stagenum).value == "Fi"))
 {   //alert("HERE");
  if(document.getElementById(accpt).value.length !=0)
  {
   acc= document.getElementById(accpt).value;

  }
  else
  {
              acc=0;
  }
  if(document.getElementById(reject).value.length !=0)
  {
   rej=document.getElementById(reject).value;
  }
  else
  {
   rej=0;
  }
  if(document.getElementById(rework).value.length !=0)
  {
   rew=document.getElementById(rework).value;
  }
  else
  {
   rew=0;
  }
  if(document.getElementById(returns).value.length !=0)
  {
   ret=document.getElementById(returns).value;
  }
  else
  {
    ret=0;
  }

  if(document.getElementById(hold).value.length !=0)
  {
   hol=document.getElementById(hold).value;
  }
  else
  {
    hol=0;
  }

  sum += parseInt(acc)+ parseInt(rej)+ parseInt(rew)+ parseInt(ret)+ parseInt(hol);

  }
  y++;
 }

  if(finalqty != sum)
 {
   alert( 'Total of Accept,Rework,Reject,Ret,Hold'+'\n'+'should be equal to Qty/AmendQty');
   return false;
 }


}
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

function GetDate1(rt) {


	// alert(rt);
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


function GetDate2(rt) {
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
// alert(dateval);
// alert(fieldname);
// alert(document.getElementById("dates1").value);
document.getElementById(fieldname).value = dateval;
// alert(dateval);
//text.value=dateval;
}

function GetDate4template(rt) {
//alert("i am here");
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getcal4template.php?index=" + rt, "DueDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetDate4template(dateval,index) {
//alert(dateval);
//alert(fieldname);
date="date" + index
document.forms[0].elements[date].value = dateval;
}

function GetwfDate(rt1) {
var max=document.forms[0].max.value;
var param = rt1;
flag=0;

for (var i=1;i<=max;i++)
{
	chknm="ckbo" + i;
	if ( document.forms[0].elements[chknm].checked == true )
	{
		flag=1;
		break;
	}
}
if(rt1==i)
{
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getwfcalendar.php?reasontext=" + rt1,"NewDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
else
{
alert("You Have Another Milestone Before This Milestone");
}
}


function addDays(mydate,days)
{
	return new Date(mydate.getTime() + days*24*60*60*1000);
}

function SetwfDate(dateval,index)
{
//alert(dateval);
//alert(index);
	var max=document.forms[0].max.value;
//alert(max);
	var day=dateval.substring(10,8);
	var month=dateval.substring(7,5);
	var year=dateval.substring(4,0);
	var inc=0;
	flag=1;
	for (var i=index;i<=max;i++)
	{

		if (flag==1)
		{
			dates="dates" + i;
			document.forms[0].elements[dates].value = dateval;
			flag=0;

		}
		else
		{
			chknm="ckbo" + i;
//alert("i am here" + chknm);
			if ( document.forms[0].elements[chknm].checked == true )
			{

			est="est" + i;
			var inc = inc + parseInt(document.forms[0].elements[est].value);
			var d = addDays(new Date(year,month,day),inc);
			day1=d.getDate();
			month1=d.getMonth();
			year1=d.getFullYear();
		                var d1=year1 + "-" + month1 + "-" + day1;
			dates="dates" + i;
			document.forms[0].elements[dates].value = d1;
			}
		 }
	}
}


function GetwfDate4Edit(rt1) {
var param = rt1;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getwfcalendar.php?reasontext=" + rt1,"EditDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}


function SetwfDate4Edit(dateval,index)
{
//alert(dateval);
//alert(index);
	var max=document.forms[0].max.value;
//alert(max);
	var day=dateval.substring(10,8);
	var month=dateval.substring(7,5);
	var year=dateval.substring(4,0);
	var inc=0;
	flag=1;
	for (var i=index;i<=max;i++)
	{

		if (flag==1)
		{
			dates="dates" + i;
			document.forms[0].elements[dates].value = dateval;
			flag=0;

		}
		else
		{
//alert("i am here" + chknm);
			est="est" + i;
			var inc = inc + parseInt(document.forms[0].elements[est].value);
			var d = addDays(new Date(year,month,day),inc);
			day1=d.getDate();
			month1=d.getMonth();
			year1=d.getFullYear();
		                var d1=year1 + "-" + month1 + "-" + day1;
			dates="dates" + i;
			document.forms[0].elements[dates].value = d1;
		 }
	}
}

function Setmax(index)
{
chknm="ckbo" + index;
if ( document.forms[0].elements[chknm].checked == true )
{
document.forms[0].max1.value=parseInt(document.forms[0].max1.value) + 1;
}
}


function GetApprUser(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getappruser.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetApprUser(emp,emprecnum,fieldname)
{
document.forms[0].elements[fieldname].value = emp;
document.forms[0].elements[fieldname + "recnum"].value = emprecnum;
}

function GetC1(rt)
{
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
win1 = window.open("getc1.php?reasontext=" + customerrecnum + "&customer=" + customer,param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}


function GetC(rt)
{
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
win1 = window.open("getc.php?reasontext=" + customerrecnum + "&customer=" + customer,param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetC(contact,contarr,fieldname)
{
var contdet = contarr.split("|");
document.forms[0].contact.value = contact;
document.forms[0].elements[fieldname].value = contact;
document.forms[0].elements[fieldname + "recnum"].value = contdet[0];
}


function GetDesDate(rt)
{
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "DesDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetDesDate(desdate)
{
document.forms[0].des_due.value = desdate;
}

function GetAssyDate(rt)
{
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var ind = document.forms[0].assyrequired.selectedIndex;
var assyreqd = document.forms[0].assyrequired[ind].text;
if (assyreqd == 'No')
  { alert("Assembly Required must be yes");
    return false;
  }
win1 = window.open("allcalendar.php", "AssyDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetAssyDate(assydate)
{
document.forms[0].assy_due.value = assydate;
}

function GetUpdAssyDate(rt)
{
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "AssyDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function GetFabDate(rt)
{
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "FabDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetFabDate(fabdate)
{
document.forms[0].fab_due.value = fabdate;
}

function GetSchDueDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "SchDue", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetSchDueDate(schduedate) {
document.forms[0].sch_due_date.value = schduedate;
}

function GetAssyCompDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "AssyComp", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetAssyComp(assydate) {
document.forms[0].assy_comp.value = assydate;
}
function GetFabCompDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "FabComp", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetFabComp(fabdate) {
document.forms[0].fab_comp.value = fabdate;
}
function DesCompDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "DesComp", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetDesComp(descomp) {
document.forms[0].des_comp.value = descomp;
}
function GetActShipDate(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "ActShipDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetActShipDate(actshipdate) {
document.forms[0].act_ship_date.value = actshipdate;
}
function GetCustSignoff(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", "CustSignoff", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetCustSignoff(custsignoff) {
document.forms[0].cust_signoff.value = custsignoff;
}
function VerifyPart(rt,rt1) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("verifypart.php?index=" + rt + "&type=" + rt1, "BoardPart", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}
function SetPartNumQty(partnum,index) {
part= "partqty" + index;
document.forms[0].elements[part].value = partnum;
}

function SetPartNum(partnum,index) {
part= "part" + index;
document.forms[0].elements[part].value = partnum;
}
function CancelWO()
{
     document.forms[0].deleteflag.value = "y";
}

function GetCustSignoffBy(rt) {
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

win1 = window.open("contact.php?reasontext=" + customerrecnum + "&customer=" + customer,"CustSignoffBy", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetCustSignoffBy(contact,contarr) {
document.forms[0].cust_signoff_by.value = contact;
}
function GetDesSignoffEmp(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getallemps.php?reasontext=" + rt, "DesSignoff", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetDesSignoffEmp(emp,emprecnum) {
document.forms[0].des_signoff_by.value = emp;
}
function GetAssySignoffEmp(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getallemps.php?reasontext=" + rt, "AssySignoff", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetAssySignoffEmp(emp,emprecnum) {
document.forms[0].assy_signoff_by.value = emp;
}
function GetFabSignoffEmp(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getallemps.php?reasontext=" + rt, "FabSignoff", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetFabSignoffEmp(emp,emprecnum) {
document.forms[0].fab_signoff_by.value = emp;
}
function printBWO(typenum,worecnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printBoardWO.php?typenum=" + typenum + "&worecnum=" + worecnum, "PrintBWO", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}
function printPCBAWO(typenum,worecnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printPCBAWO.php?typenum=" + typenum + "&worecnum=" + worecnum, "PrintPCBAWO", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}

function enterShipment() {
var winWidth = 850;
var winHeight = 550;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("enterShipment.php", "Shipment", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}

function displayShipment() {
var winWidth = 850;
var winHeight = 550;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("dispShipment.php", "Shipment", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}


function GetBOMNo() {
var winWidth = 575;
var winHeight = 375;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getbom.php","link", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetBOMNo(inpbomrecnum,inpbomnum) {

var bomrecnum=inpbomrecnum;
var bomnum=inpbomnum;

document.forms[0].bomrecnum.value= bomrecnum;
document.forms[0].bomnum.value=bomnum;

}


function ConfirmDelete() {
     document.forms[0].deleteflag.value = "y";
     return true;
}


function GetOwnerDyna(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getownerdyna.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetOwnerDyna(emp,emprecnum,fieldname) {
var id1="ownerdyna"+ fieldname;
var id2="emprecnumdyna"+ fieldname;
var text1= document.getElementById(id1);
text1.value=emp;
var text2= document.getElementById(id2);
text2.value=emprecnum;
}

function GetDateDyna(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getcalendardyna.php",param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetDateDyna(dateval,fieldname) {
var id="datedyna"+ fieldname;
var text= document.getElementById(id);
text.value=dateval;
}

function addRow(id,ind1){
	// things to add
	ind1= parseInt(ind1);
	ind1++;

    dept = "deptdyna" + ind1; //text box
	ms = "msdyna" + ind1; //text box;
	dates = "datedyna" + ind1; //text box
	owner = "ownerdyna" + ind1; //text box
    emprecnum="emprecnumdyna"+ind1;

	var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];

	var row = document.createElement("TR");
	row.style.backgroundColor = "#FFFFFF";

	var cell1 = document.createElement("TD");  // cell1

	var cell2 = document.createElement("TD");  //cell2

    var cell3 = document.createElement("TD");  //cell3

	var inp1 =  document.createElement("INPUT");  //department
	inp1.setAttribute("type","text");
	inp1.setAttribute("name",dept);
	cell2.appendChild(inp1);

	var inp2 =  document.createElement("INPUT");  //milestones
	inp2.setAttribute("type","text");
	inp2.setAttribute("name",ms);
	cell3.appendChild(inp2);


	var cell4 = document.createElement("TD");  //cell4
	var inp3 =  document.createElement("INPUT"); //dates
	inp3.setAttribute("type","text");
	inp3.setAttribute("name",dates);
	inp3.setAttribute("id",dates);
	inp3.style.backgroundColor = "#DDDDDD";
	inp3.setAttribute("readonly","readonly");
	inp3.setAttribute("size",10);
	cell4.appendChild(inp3);

	//var br = document.createElement("br");
	//cell4.appendChild(br);

	var img1 =  document.createElement("img");
	img1.setAttribute("src","images/bu-getdate.gif");
	img1.setAttribute("alt","Get Date");
	img1.onclick=function(){GetDateDyna(ind1);};
	cell4.appendChild(img1);

	var cell5 = document.createElement("TD");  //cell 5
	var inp4 =  document.createElement("INPUT"); //owner
	inp4.setAttribute("type","text");
	inp4.style.backgroundColor = "#DDDDDD";
	inp4.setAttribute("name",owner);
	inp4.setAttribute("id",owner);
	inp4.setAttribute("readonly","readonly");
	inp4.setAttribute("size",20);
	cell5.appendChild(inp4);

	//var br2 = document.createElement("br");
	//cell5.appendChild(br2);

	var img2 =  document.createElement("img");
	img2.setAttribute("src","images/bu-getemployee.gif");
	img2.setAttribute("alt","Get Owner");
	img2.onclick=function(){GetOwnerDyna(ind1);};
	cell5.appendChild(img2);

    var inp6 =  document.createElement("INPUT");
    inp6.setAttribute("type","hidden");
    inp6.setAttribute("value","");
    inp6.setAttribute("name",emprecnum);
    inp6.setAttribute("id",emprecnum);

	row.appendChild(cell1);
	row.appendChild(cell2);
	row.appendChild(cell3);
	row.appendChild(cell4);
    row.appendChild(cell5);
    row.appendChild(inp6);
	tbody.appendChild(row);

	document.forms[0].msdynamic.value=ind1;
	//alert("Added compnents\n"+dept+"\n"+ms+"\n"+dates+"\n"+owner);
}

function editRow(id,ind1)
{
	// things to add
	ind1= parseInt(ind1);
	ind1++;

    dept = "deptdyna" + ind1; //text box
	ms = "msdyna" + ind1; //text box;
	dates = "datedyna" + ind1; //text box
	owner = "ownerdyna" + ind1; //text box
	emprecnum="emprecnumdyna"+ind1;

	var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];

	var row = document.createElement("TR");
	row.style.backgroundColor = "#FFFFFF";

    var cell1 = document.createElement("TD");  // cell1
    var inp1 =  document.createElement("INPUT");  //department
	inp1.setAttribute("type","text");
	inp1.setAttribute("name",dept);
	cell1.appendChild(inp1);

	var cell2 = document.createElement("TD");  //cell2
    var inp2 =  document.createElement("INPUT");  //milestones
	inp2.setAttribute("type","text");
	inp2.setAttribute("name",ms);
	cell2.appendChild(inp2);

    var cell3 = document.createElement("TD");  //cell3
	var inp3 =  document.createElement("INPUT"); //dates
	inp3.setAttribute("type","text");
	inp3.setAttribute("name",dates);
	inp3.setAttribute("id",dates);
	inp3.style.backgroundColor = "#DDDDDD";
	inp3.setAttribute("readonly","readonly");
	inp3.setAttribute("size",10);
	cell3.appendChild(inp3);

    var cell4 = document.createElement("TD");  //cell4
	var img1 =  document.createElement("img");
	img1.setAttribute("src","images/bu-getdateicon.gif"); //date function
	img1.setAttribute("alt","Get Date");
	img1.onclick=function(){GetDateDyna(ind1);};
	cell4.appendChild(img1);

    var cell5 = document.createElement("TD");  //cell5 for free space
    var cell6 = document.createElement("TD");  //cell6 for free space

    var cell7 = document.createElement("TD");  //cell 7
	var inp4 =  document.createElement("INPUT"); //owner
	inp4.setAttribute("type","text");
	inp4.setAttribute("name",owner);
	inp4.setAttribute("id",owner);
	inp4.style.backgroundColor = "#DDDDDD";
	inp4.setAttribute("readonly","readonly");
	inp4.setAttribute("size",15);
	cell7.appendChild(inp4);

    var cell8 = document.createElement("TD");  //cell8   for free space

    var img2 =  document.createElement("img");
	img2.setAttribute("src","images/bu-ownericon.gif");
	img2.setAttribute("alt","Get Owner");
	img2.onclick=function(){GetOwnerDyna(ind1);};
	cell7.appendChild(img2);

    var inp5 =  document.createElement("INPUT");
    inp5.setAttribute("type","hidden");
    inp5.setAttribute("value","");
    inp5.setAttribute("name",emprecnum);
    inp5.setAttribute("id",emprecnum);

	row.appendChild(cell1);
	row.appendChild(cell2);
	row.appendChild(cell3);
	row.appendChild(cell4);
    row.appendChild(cell5);
    row.appendChild(cell6);
    row.appendChild(cell7);
    row.appendChild(cell8);
    row.appendChild(inp5);
	tbody.appendChild(row);

	document.forms[0].msdynamic.value=ind1;
	//alert("Added compnents\n"+dept+"\n"+ms+"\n"+dates+"\n"+owner);
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
document.forms[0].quotenum.value=quotenum;
 //alert(document.forms[0].quoterecnum.value);
}

function GetSONo() {
var winWidth = 575;
var winHeight = 375;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getsalesorder.php","link1", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetSONo(inpsorecnum,inpsonum) {
var sorecnum=inpsorecnum;
var sonum=inpsonum;

document.forms[0].sorecnum.value= sorecnum;
document.forms[0].sonum.value=sonum;
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
var ponum=inpponum;
document.forms[0].porecnum.value=porecnum;
document.forms[0].ponum.value=ponum;
//alert(document.forms[0].porecnum.value);
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

function onSelectstatus1(chk, opn, userid)
 {
        //alert(chk);
        //alert(opn);
         var chk = document.getElementById(chk);
         var opn = document.getElementById(opn);

        //alert(chk);
        //alert(opn);

        if(chk.checked == true)
        {
          opn.value = userid;
        }
        else
        {
          opn.value = ' ';
        }
       // alert('Hi');
       // alert(opn.value);
        return true;
 }

 function onSelectstatus2(chk, opn, fchk, fopn, userid)
 {
        //alert(chk);
        //alert(opn);
        //alert(fchk);
        //alert(fopn);

         var chk = document.getElementById(chk);
         var opn = document.getElementById(opn);

         var fchk = document.getElementById(fchk);
         var fopn = document.getElementById(fopn);

        //alert(chk);
        //alert(opn);
        //alert(fchk);
        //alert(fopn);

        if(fchk.checked == false && chk.checked == true)
        {
          alert('corresponding First off QC is not checked')
          chk.checked = false;
          return false;

        }
        else
        {
           if(chk.checked == true)
           {
              opn.value = userid;
           }
           else
           {
              opn.value = '';
           }
           return true;
        }
       // alert('Hi');
       // alert(opn.value);

 }

 function onSelectstatus3(chk, opn, fchk, fopn, pchk, popn, userid)
 {
        //alert(chk);
        //alert(opn);
        //alert(fchk);
        //alert(fopn);
        //alert(pchk);
        //alert(popn);

         var chk = document.getElementById(chk);
         var opn = document.getElementById(opn);

         var fchk = document.getElementById(fchk);
         var fopn = document.getElementById(fopn);

         var pchk = document.getElementById(pchk);
         var popn = document.getElementById(popn);

        //alert(chk);
        //alert(opn);
        //alert(fchk);
        //alert(fopn);
        //alert(pchk);
        //alert(popn);

        if(fchk.checked == false && pchk.checked == false && chk.checked == true)
        {
          alert('corresponding First off QC and Production are not checked')
          chk.checked = false;
          return false;

        }
        else if(pchk.checked == false && chk.checked == true)
        {
          alert('corresponding Production is not checked')
          chk.checked = false;
          return false;

        }
        else
        {
           if(chk.checked == true)
           {
              opn.value = userid;
           }
           else
           {
              opn.value = '';
           }
           return true;
        }
       // alert('Hi');
       // alert(opn.value);

 }

function Getpo(rt) {
if(document.getElementById('fair_stat').value == '1')
{
    alert('Please enter Status for previous WO for PRN:'+document.forms[0].CIM_refnum.value+' in FAIR \n');
    return false;
}
if(document.getElementById('stage_split').value == 'Inprocess')
{
    alert('Cannot migrate Inprocess WO.Please Enter FI or PostDN stage in Parent WO \n');
    return false;
}


/*if(document.getElementById('prev_fairs').value == '1')
{
    //alert('Work Orders with FAIR already exists for the CIM:'+document.forms[0].CIM_refnum.value+'\n');
    alert('Wo has to be Approved \n');
    document.getElementById('wo_det_prev_fair').value = document.getElementById('prev_fairs').value;
    //return false;
} */
/*if(document.getElementById('app_flag').value == '1')
{
    alert('Wo for the CIM:'+document.forms[0].CIM_refnum.value+ ' has to be Approved \n');
    return false;
}*/


if(document.getElementById('mdproc').value=='mdentry')
{   //alert(document.getElementById('red_flag').value+"-----");
 //if(document.getElementById('red_flag').value == '1' && 
//	 document.getElementById('woclassif').value != 'Rework' )
 //{
 //   alert('Please close red-highlighted work orders for this CRN \n');
 //   return false;
//}
// if(document.getElementById('rework_flag').value == '1')
//{
//    alert('This CRN has an Open Work Order With Rework Qty older than 21 Days \n');
//    return false;
//}
}



var cim_refnum=document.forms[0].CIM_refnum.value;
var partnum = document.getElementById('partnum').value;
if(document.forms[0].CIM_refnum.value == '')
{
     alert('Please select proper PRN num');
     return false;
}
var woclassif = document.forms[0].woclassif.value
if(document.forms[0].woclassif.value == 'TR')
{
     alert('Cust PO # not required if Work Order Type is TR');
     return false;
}

//alert(partnum + 'hiii');
var param = rt;
var winWidth = 800;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("get_po.php?cim_refnum="+cim_refnum+"&partnum="+partnum+"&woclassif="+woclassif, param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function Setpo(po,poarr,custrecnum,nc4crn,ncnum) {
// alert('hi'+nc4crn);
//alert(document.forms[0].elements[fieldname]);
//alert(document.forms[0].elements[fieldname + "recnum"]);
var po = po.split("|");
// alert(po);
// alert(po[0]);
//alert(po[1]);
//alert(po[2]);
//alert(po[4]);
//alert("CRN Attachments is "+document.getElementById('attachments').value);
var woclassif=document.getElementById('woclassif').value;
 //alert(po[7]+"---"+document.getElementById('attachments').value);
//if(woclassif !='Assembly')
//{
if(po[7].replace(/[^a-zA-Z0-9]+/g,"").toLowerCase() !=  (document.getElementById('attachments').value).replace(/[^a-zA-Z0-9]+/gi,"").toLowerCase())
{
      alert("PI/Attachments is not matching");
      //return false;
}
if(po[8].replace(/[^a-zA-Z0-9]+/gi,"").toLowerCase() !=  (document.getElementById('drg_issue').value).replace(/[^a-zA-Z0-9]+/gi,"").toLowerCase() )
{
   alert("Drg Iss is not matching");
   //return false;
}
if(po[9].replace(/[^a-zA-Z0-9]+/gi,"").toLowerCase() !=  (document.getElementById('cos').value).replace(/[^a-zA-Z0-9]+/gi,"").toLowerCase() )
{
      alert("Cos Iss is not matching");
      return false;
}
//}
if(nc4crn=='1')
{
      alert("An Open NC: "+ncnum+" greater than 12 weeks old \n exists for the PRN. Please Close it\n");
      return false;
}
document.getElementById('cust_po_line_num').value = po[0];

document.getElementById('ponum').value = po[1];

document.getElementById('po_date').value = po[2];

document.getElementById('po_qty').value = po[3];

document.getElementById('company').value = po[4];
document.forms[0].companyrecnum.value = po[5];

//document.getElementById(field3).value = wo[2];

}


function Getgrns(rt) {
//alert("In getgrns");
var partnum=document.forms[0].partnum.value;
if(document.forms[0].CIM_refnum.value == '')
{
     alert('Please select CIM ref num');
     return false;
}
var crn=document.forms[0].CIM_refnum.value;
//alert(crn);
var rm_type=document.forms[0].rm_type.value;
var rm_spec=document.forms[0].rm_spec.value;
var woclassif=document.forms[0].woclassif.value;
//alert(woclassif);
//var partnum=document.forms[0].partnum.value;
//var partnum = document.getElementById('partnum').value;

var param = rt;
var winWidth = 1000;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getgrns.php?rm_type="+rm_type+"&rm_spec="+rm_spec+
	"&crn="+crn+"&woclassif="+woclassif, param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

//function Setgrn(grnn,grnrecnum,older_grn) 
function Setgrn(grnn,grnrecnum) 
{
	
// alert("In setrgrn");
// alert(grnn);
var str_woqty;
var woqty;
var grn = grnn.split("|");
// alert(grn);

if (document.forms[0].qty.value.length != 0 &&  document.forms[0].qty.value.trim() != '')
{

   str_woqty = document.getElementById('qty').value;
   woqty = parseInt(str_woqty);


}
else
{
   woqty = 0;
}
//alert(woqty);
// alert("GRN qty "+grn[2]);
if (woqty == 0)
{
   alert("WO Qty should be present");
   return false;
}
if (woqty > grn[2])
{
   alert("WO qty cannot be > GRN qty");
   return false;
}
//alert(grn[4]+"--------------"+grn[5]);

// alert(document.getElementById('pagename').value)
if(document.getElementById('pagename').value =='woEdit')
{
    // older_grn=grn[7];
	
	   	var aind = document.forms[0].classiftype.selectedIndex;


   	// alert(document.forms[0].classiftype[aind].text+"88888888888888");
if(document.forms[0].classiftype[aind].text == 'Split' || document.forms[0].classiftype[aind].text == 'Split Assembly')
{

  document.getElementById('grnnum_split').value = grn[0];
  // document.getElementById('qty_split').value = grn[2];
  document.getElementById('batchnum_split').value = grn[1];
  document.getElementById('rm_type_split').value = grn[4];
  document.getElementById('rm_spec_split').value = grn[5];
}
else
{
document.getElementById('grnnum').value = grn[0];
// document.getElementById('qty').value = grn[2];
document.getElementById('batchnum').value = grn[1];
document.getElementById('rm_type').value = grn[4];
document.getElementById('rm_spec').value = grn[5];
}
}
else if(document.getElementById('pagename').value =='woEntry')
{
// alert(grn);
/*
	if(grn[0] != older_grn)
	{
		alert("Please Select the Older Grn: "+older_grn);
		return false;
	}
*/
  var aindE = document.forms[0].woclassif.selectedIndex;

 if(document.forms[0].woclassif[aindE].text == 'Split' || document.forms[0].woclassif[aindE].text == 'Split Assembly')
{

	
  document.getElementById('grnnum_split').value = grn[0];
  document.getElementById('qtm').value = grn[2];
  document.getElementById('batchnum_split').value = grn[1];
  document.getElementById('rm_type_split').value = grn[4];
  document.getElementById('rm_spec_split').value = grn[5];
}
else
{

	// alert(document.getElementById('qty').value);

document.getElementById('grnnum').value = grn[0];
document.getElementById('qtm').value = grn[2];
document.getElementById('batchnum').value = grn[1];
document.getElementById('rm_type').value = grn[4];
document.getElementById('rm_spec').value = grn[5];
}
}
}
function Setgrn_old(grnn,grnrecnum) {
//alert('hi');
//alert(document.forms[0].elements[fieldname]);
//alert(document.forms[0].elements[fieldname + "recnum"]);
//var po = po.split("|");
//alert(grnnum);
//alert(po[0]);
//alert(po[1]);
//alert(po[2]);

//document.getElementById('grnnum').value = grnnum;
var str_woqty;
var woqty;
var grn = grnn.split("|");
//alert(grnn);

if (document.forms[0].qty.value.length != 0)
{
   str_woqty = document.getElementById('qty').value;
   woqty = parseInt(str_woqty);
}
else
{
   woqty = 0;
}
//alert(woqty);
//alert("GRN qty "+grn[2]);
if (woqty == 0)
{
   alert("WO Qty should be present");
   return false;
}
if (woqty > grn[2])
{
   alert("WO qty cannot be > GRN qty");
   return false;
}
//alert(grn[4]+"--------------"+grn[5]);
if(document.getElementById('pagename').value =='woEdit')
{
 var aind = document.forms[0].classiftype.selectedIndex;
   // alert(document.forms[0].classiftype[aind].text+"88888888888888");
if(document.forms[0].classiftype[aind].text == 'Split' || document.forms[0].classiftype[aind].text == 'Split Assembly')
{
  document.getElementById('grnnum_split').value = grn[0];
  document.getElementById('batchnum_split').value = grn[1];
  document.getElementById('rm_type_split').value = grn[4];
  document.getElementById('rm_spec_split').value = grn[5];
}
else
{
document.getElementById('grnnum').value = grn[0];
document.getElementById('batchnum').value = grn[1];
document.getElementById('rm_type').value = grn[4];
document.getElementById('rm_spec').value = grn[5];
}
}
else if(document.getElementById('pagename').value =='woEntry')
{
  var aindE = document.forms[0].woclassif.selectedIndex;
 if(document.forms[0].woclassif[aindE].text == 'Split' || document.forms[0].woclassif[aindE].text == 'Split Assembly')
{
  document.getElementById('grnnum_split').value = grn[0];
  document.getElementById('batchnum_split').value = grn[1];
  document.getElementById('rm_type_split').value = grn[4];
  document.getElementById('rm_spec_split').value = grn[5];
}
else
{
document.getElementById('grnnum').value = grn[0];
document.getElementById('batchnum').value = grn[1];
document.getElementById('rm_type').value = grn[4];
document.getElementById('rm_spec').value = grn[5];
}

}

}
function Getwo_crn() {
var winWidth = 600;
var winHeight = 300;
//alert(screen.width)
if(document.forms[0].qty.value == '' && document.getElementById('woclassif').value != 'Migrate')
{
  alert("Please Select Work Order Qty before Selecting Work Order Ref# .");
  return false;
}
var CIM_refnum=document.forms[0].CIM_refnum.value;
var woref_num=document.forms[0].worefnum.value;
if(document.getElementById('woclassif').value == 'Split' || document.getElementById('woclassif').value == 'Split Assembly')
{
 var winLeft = (screen.width-winWidth)/2;
 var winTop = (screen.height-winHeight)/2;

win1 = window.open("getwo_crn4split.php?CIM_refnum=" +CIM_refnum,"CIM_refnum", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}else if(document.getElementById('woclassif').value == 'Migrate')
{
  var winLeft = (screen.width-winWidth)/2;
  var winTop = (screen.height-winHeight)/2;

win1 = window.open("getwo_crn4migrate.php?woclass=" +document.getElementById('woclassif').value,"CIM_refnum", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
else
{
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getwo_crn.php","aa", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
}


function Setwo_crn(CIM,CIMarr,fieldname)
{  // alert(CIMarr);
    var CIM = CIM.split("|");
    var CIMdet = CIMarr.split("|");
    //alert(fieldname);
    var woqty=parseInt(document.forms[0].qty.value);
    document.getElementById('worefnum').value = CIM[0];
    //alert(CIM[0]+"===---==="+CIMdet[2]+"----------"+document.forms[0].woclassif.value);
/*
    if(CIM1[4] == '')
    {
     alert ('Please Select Wo Qty .');
     return false;
    }
*/
    if((document.forms[0].woclassif.value == 'Split') || (document.forms[0].woclassif.value == 'Split Assembly'))
    {

       document.getElementById('grnnum_split').value = CIM[6];
       document.getElementById('batchnum_split').value = CIM[7];
       document.getElementById('rm_type_split').value = CIMdet[12];
       document.getElementById('rm_spec_split').value = CIMdet[13];
       //getCrnDetails(CIMdet[1]);
       setFair(CIMdet[1]) ;
//alert(CIMdet[1]);
       if(woqty > CIMdet[3])
       {
        alert ('For Split WO, Qty should be <= balance of Amended Qty.');
        return false;
       }

        document.forms[0].elements[fieldname].value = CIMdet[1];
        document.forms[0].link2masterdata.value = CIMdet[24];
        document.forms[0].partname.value = CIMdet[7];
        document.forms[0].partnum.value = CIMdet[8];
        document.forms[0].RM_by_CIM.value = CIMdet[9];
        document.forms[0].project.value = CIMdet[10];
        document.forms[0].attachments.value = CIMdet[11];
        document.forms[0].RM_by_customer.value = CIMdet[18];
        document.forms[0].drg_issue.value = CIMdet[17];
        //document.forms[0].rm_type.value = CIMdet[12];
        //document.forms[0].rm_spec.value = CIMdet[13];
        document.forms[0].rm_dim1.value = CIMdet[20];
        document.forms[0].rm_dim2.value = CIMdet[21];
        document.forms[0].rm_dim3.value = CIMdet[22];
        document.forms[0].mps_rev.value = CIMdet[15];
        document.forms[0].mps_num.value = CIMdet[14];
        document.forms[0].drawing_num.value = CIMdet[16];
        document.getElementById('poimg').value = CIMdet[8];
        document.forms[0].cos.value = CIMdet[19];
        document.forms[0].link2mps.value = CIMdet[23];

    } else if(document.forms[0].woclassif.value =='Migrate')
    {     // alert("HERE---"+CIMdet[6]);
       document.getElementById('worefnum').value = CIMdet[0];
       document.forms[0].qty.value = CIMdet[1];
       document.forms[0].pwoqty.value = CIMdet[1];
       document.getElementById('grnnum_split').value = CIMdet[2];
       document.getElementById('batchnum_split').value = CIMdet[3];
       document.getElementById('rm_type_split').value = CIMdet[4];
       document.getElementById('rm_spec_split').value = CIMdet[5];
       document.getElementById('worefnumrecnum').value = CIMdet[6];
       settimeline(CIMdet[6]);
    }
}


function clearPo()
{
	//alert('in clearPo');
	if(document.getElementById('hidpname').value=="woEntry")
	{


     //alert('in clearPo******--------'+document.getElementById('woclassif')[woindex].value);
	  var woindex =  document.getElementById('woclassif').selectedIndex;
	 if (document.getElementById('woclassif')[woindex].value == 'Rework')
	 {
        document.getElementById("wo_status").style.display = 'table-row';

	 } 
	 else
	 {
          document.getElementById("wo_status").style.display = 'none';	 	
	 }
     if (document.getElementById('woclassif')[woindex].value == 'TR')
     {
        document.getElementById('ponum').value="";
        document.getElementById('po_qty').value="";
        document.getElementById('po_date').value="";
     }
     else if((document.getElementById('woclassif')[woindex].value == 'Split') || (document.getElementById('woclassif')[woindex].value == 'Split Assembly'))
     {
       //document.getElementById('wo_status').style.display='in-line';
       document.getElementById('grn_noimg').style.display='in-line';
       document.getElementById('grn_noimg_rm_spec').style.display='in-line';
       document.getElementById('grn_img').style.display='none';
       document.getElementById('grn_img_rm_spec').style.display='none';

       document.getElementById("amendments").style.display="table-row";
       document.getElementById("amendment_notes").style.display="table-cell";
       document.getElementById("amendment_text").style.display="table-cell";
       document.getElementById("extratd").style.display="none";

     }
     else
     {
     //alert('in clearPo******%%%%%%%%%%%');
       //document.getElementById('wo_status').style.display='none';
       document.getElementById('grn_noimg').style.display='none';
       document.getElementById('grn_noimg_rm_spec').style.display='none';
       document.getElementById('grn_img').style.display='in-line';
       document.getElementById('grn_img_rm_spec').style.display='in-line';

       document.getElementById("amendments").style.display="none";
       document.getElementById("amendment_notes").style.display="none";
       document.getElementById("amendment_text").style.display="none";
       document.getElementById("extratd").style.display="table-cell";

     }
   }
	else if(document.getElementById('hidpname').value=="WodetailsEdit" && document.getElementById('deptname').value!="QA" && document.getElementById('deptname').value!="PPC4" && document.getElementById('deptname').value!="PPC5")
	{
     //alert('in clearPo******');
	     var woindex =  document.getElementById('classiftype').selectedIndex;
	      if (document.getElementById('classiftype')[woindex].value == 'TR')
     {
      document.getElementById('ponum').value="";
      document.getElementById('po_qty').value="";
      document.getElementById('po_date').value="";
     }
    //alert(document.getElementById('woclassif').value+"-------------------");
    if(document.getElementById('woclassif').value == 'Split' || document.getElementById('woclassif').value == 'Split Assembly')
    {    //alert(document.getElementById('woclassif').value+"-------------------");
        //document.getElementById('wo_status').style.display='in-line';
        document.getElementById('grn_noimg').style.display='in-line';
       document.getElementById('grn_noimg_rm_spec').style.display='in-line';
       document.getElementById('grn_img').style.display='none';
       document.getElementById('grn_img_rm_spec').style.display='none';

    }
    else
    {
    //alert(document.getElementById('woclassif').value+"-------------------");
       //document.getElementById('wo_status').style.display='none';
       document.getElementById('grn_noimg').style.display='none';
       document.getElementById('grn_noimg_rm_spec').style.display='none';
       document.getElementById('grn_img').style.display='in-line';
       document.getElementById('grn_img_rm_spec').style.display='in-line';
       //document.getElementById('grnnum').value="";
       //document.getElementById('batchnum').value="";
       //document.getElementById('worefnum').value="";
     }
   }



   if(document.getElementById("hidpname").value == "WodetailsEdit")
   {

   	if (document.getElementById('woclassif')[woindex].value == 'Rework')
	 {
        document.getElementById("wo_status").style.display = 'table-row';
        document.getElementById("work_ref").style.display = 'table-cell';

	 } 
	 else
	 {
          document.getElementById("wo_status").style.display = 'none';	 	
          document.getElementById("work_ref").style.display = 'none';
	 }
   }
}

function onSelectclassif()
{
    var aind = document.forms[0].classiftype.selectedIndex;
    //alert(document.forms[0].classiftype[aind].text+"88888888888888");
    if((document.forms[0].classiftype[aind].text == 'Split') || (document.forms[0].classiftype[aind].text  == 'Split Assembly')
    ||(document.forms[0].classiftype[aind].text == 'Migrate') )
    {

        document.getElementById('wo_status').style.display='in-line';
        document.getElementById('grn_noimg').style.display='in-line';
       document.getElementById('grn_noimg_rm_spec').style.display='in-line';
       document.getElementById('grn_img').style.display='none';
       document.getElementById('grn_img_rm_spec').style.display='none';
   }
   else
   {
       //document.getElementById('wo_status').style.display='none';
       document.getElementById('grn_noimg').style.display='none';
       document.getElementById('grn_noimg_rm_spec').style.display='none';
       document.getElementById('grn_img').style.display='in-line';
       document.getElementById('grn_img_rm_spec').style.display='in-line';
       document.getElementById('grnnum').value="";
       document.getElementById('batchnum').value="";
       document.getElementById('worefnum').value="";
       document.getElementById('stage_split').removeAttribute("readOnly",true);
       document.getElementById('stage_split').style.backgroundColor="#FFFFFF";
       document.getElementById('stage_split').value="";
    }
        document.forms[0].woclassif.value = document.forms[0].classiftype[aind].text;
 // var woindex =  document.getElementById('classiftype').selectedIndex;

}
function onSelect_classif()
{
    var aind = document.forms[0].woclassif.selectedIndex;
   // alert(document.forms[0].woclassif[aind].text+"88888888888888");
    if((document.forms[0].woclassif[aind].text == 'Split') || (document.forms[0].woclassif[aind].text  == 'Split Assembly')
    ||(document.forms[0].woclassif[aind].text == 'Migrate') )
    {

       //document.getElementById('wo_status').style.display='in-line';
        document.getElementById('grn_noimg').style.display='in-line';
       document.getElementById('grn_noimg_rm_spec').style.display='in-line';
       document.getElementById('grn_img').style.display='none';
       document.getElementById('grn_img_rm_spec').style.display='none';
   }
   else
   {
       //document.getElementById('wo_status').style.display='none';
       document.getElementById('grn_noimg').style.display='none';
       document.getElementById('grn_noimg_rm_spec').style.display='none';
       document.getElementById('grn_img').style.display='in-line';
       document.getElementById('grn_img_rm_spec').style.display='in-line';
       document.getElementById('grnnum').value="";
       document.getElementById('batchnum').value="";
       document.getElementById('worefnum').value="";
       document.getElementById('stage_split').removeAttribute("readOnly",true);
       document.getElementById('stage_split').style.backgroundColor="#FFFFFF";
       document.getElementById('stage_split').value="";
    }

        //document.forms[0].woclassif.value = document.forms[0].classiftype[aind].text;
 // var woindex =  document.getElementById('classiftype').selectedIndex;

}
function onSelecttreat()
{

        var aind = document.forms[0].treattype.selectedIndex;
        document.forms[0].treatment.value = document.forms[0].treattype[aind].text;
}

function onSelectcond()
{

        var aind = document.forms[0].condtype.selectedIndex;
        document.forms[0].condition.value = document.forms[0].condtype[aind].text;
       // alert(document.forms[0].condtype[aind].text+"-----------------------");
        if(document.forms[0].condtype[aind].text=='Open')
        {
         document.forms[0].act_ship_date.value='0000-00-00';
        }
}

function toggleValue(divid,chk)
{
 //alert(approve_date);
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
   var currentDate = new Date();
   var month =currentDate.getMonth() + 1 ;
   if(month>0 && month < 10)
   {
    var mon_th="0"+month;
    //alert(mon_th);
   }
   else
   {
    var mon_th=month;
   }
   var day = currentDate.getDate() ;
   if(day >1 && day<10)
   {
      var days="0"+day;
      //alert(days);
   }
   else
   {
      var days=day;
   }
   var year = currentDate.getFullYear() ;
   //alert(currentDate.format("yyyy-mm-dd"));
   var DD=year + "-" + mon_th + "-" + days;
   //alert(DD);
  }
 }
 else
 {
   document.getElementById(userid).value="no";
 }
 //alert(document.getElementById('userid').value);
   if(document.getElementById('approved_re_wo').value=="yes"){
  document.getElementById('approval_date').value = DD;
  document.getElementById('approved_by').value=document.getElementById('userid').value;
  }
  else if(document.getElementById('approved_re_wo').value=="no"){
    document.getElementById('approval_date').value = '';
    document.getElementById('approved_by').value='';
  }

}




function getCrnDetails(crn)
{
   //alert(crn);
   var ajaxRequest;  // The variable that makes Ajax possible!
    //alert(crn_num+"******");
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
				//Something went wrong
				alert("Your browser broke!");
				return false;
			   }
		}
	}
//	Create a function that will receive data sent from the server
	 ajaxRequest.onreadystatechange = function(){
	        if(ajaxRequest.readyState == 4)
            {
		      if(ajaxRequest.status == 200)
              {
		      //alert(crn_num);
		    //alert( ajaxRequest.responseText);

                 document.getElementById('crn_prev_stat').innerHTML = ajaxRequest.responseText;

		      }
	        }
	}
	//alert("Here1");
	ajaxRequest.open("POST", "getCrnprevDetails.php?crn="+crn ,true);
	ajaxRequest.send(null);

}

function settimeline(wonum)
{  //alert("HERE--");
   $.ajax({
      url : "wotimeline_migrate.php",
      type : "POST",
      dataType: "html",
      data : "wonum="+wonum,
      success : function (msg){
      //alert(msg);
              $('#timeline').html(msg);
              }
          })

}

function GetSch()
{
	//alert(rt);
	var param = 'CRN';
	var winWidth = 1000;
	var winHeight = 300;
	var winLeft = (screen.width-winWidth)/2;
	var winTop = (screen.height-winHeight)/2;
	crnnum = document.getElementById('CIM_refnum').value;
	if (crnnum == '')
	{
		alert("Please enter a PRN number");
	}
    else
	{
       win1 = window.open("getSch.php?crnnum=" + crnnum, "Customers", +
          "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
     ",width=" + winWidth + ",height=" + winHeight +
     ",top="+winTop+",left="+winLeft);
	}
}
function SetSch(CIMarr,fieldname) 
{
	var CIMdet = CIMarr.split("|");
	crn = CIMdet[0];
	document.forms[0].sch_due_date.value = CIMdet[2];
}


function getworkflow(crn)
{
document.getElementById('workflow').style.display = "block";		
 //if(document.getElementById('page').value == "new")
 //{
	  // alert('here');

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

	 	// alert(ajaxRequest.status);
	        if(ajaxRequest.readyState == 4)
                {
		      if(ajaxRequest.status == 200)
		      {
                var success= ajaxRequest.responseText;

               if(success.trim() != '')
               {

				    document.getElementById('workflow').innerHTML = ajaxRequest.responseText;
				    document.getElementById('prevworkflow').style.display = "none";
				 }
				 else
				 {
				   document.getElementById('workflow').style.display = "none";	
				    document.getElementById('prevworkflow').style.display = "block";	
				 }
		      }
		      
	        }
	}
	//alert("Here1");
	ajaxRequest.open("POST", "getworkflow.php?crn="+crn, true);
	ajaxRequest.send(null);
  //}
}




// function check_req_fields(){
// 	// alert('test');
// 	    var errmsg='';
// 	    if(document.getElementById('pagename').value == 'woEntry')
// 	    {
//   	    if (document.forms[0].company.value == 'Please Specify')
// 	   {
	   
// 		 errmsg+="Customer cannot be Please Specify\n";
// 	   }
// 	 //   if (document.forms[0].worefnum.value.length == 0)
// 	 //   { 
		
// 		// errmsg+="Work Order # must be entered\n";
// 	 //   }
// 	   if (document.forms[0].ponum.value.length == 0)
// 	   { 

// 		errmsg+="PO # must be entered\n";
// 	   }
// 	}

// 	    if(document.getElementById('pagename').value == 'woEdit')
// 	   {	

// 	   // alert('test'); 
// 	   // alert(document.getElementById('pagename').value);
//        if(document.getElementById('notes').value.length == 0 )
//        {

//      	   errmsg +='Please Enter Notes.\n';
//        }  

// 	   if(document.getElementById('condition').value == 'Closed' && 
// 	(document.getElementById('act_ship_date').value == '0000-00-00' || 
// 	document.getElementById('act_ship_date').value == ''))
// 		{
//            errmsg +='Please Enter the Date Code.\n';
// 		}



//          if(document.getElementById('condition').value == 'Cancelled')
//          {
//            cancelledremarks = prompt ("Please enter reason for Cancellation of the WO\nComments entered here will be appended to remarks","")
//            //alert("Hello there, " + reason) ;
//            if(cancelledremarks)
//            {
//            if(document.getElementById('remarks').value == '')
//            {
//               document.getElementById('remarks').value = cancelledremarks ;
//            }
//            else
//            {
//              document.getElementById('remarks').value = document.getElementById('remarks').value + cancelledremarks ;
//            }

//            //alert(document.getElementById('remarks').value+"*-*-*-*-*-*-*");

//            }
//            else
//            {
//               errmsg+='Reason For Cancellation Not Entered\n';
           
//            }

//          }
//  	   }
// 	 //   if (document.forms[0].quotenum.value.length == 0)
// 	 //   {

// 	 //   		 errmsg+="Quote # must be entered\n";
// 	 //   }
// 	 //   if (document.forms[0].contact.value.length == 0)
// 	 //   {
// 		//  errmsg+="Contact must be present\n";
// 	 //   }
// 	 //   if (document.forms[0].contact.value == 'Please Specify')
// 	 //   {
// 		//  errmsg+="Contact cannot be Please Specify\n";
// 	 //   }
// 	 //   if (document.forms[0].owner.value.length == 0)
// 	 //   {
// 		//  errmsg+="Designer must be entered\n";
// 	 //   }
// 		//    if (document.forms[0].owner.value == 'Please Specify')
// 	 //   { 
// 		// errmsg+="Designer cannot be Please Specify\n";
// 	 //   }
// 	 //   if (document.forms[0].qty1.value.length == 0)
//   //  		{
// 		// 	 errmsg+="Please enter  \n";
// 		// }  
// 	   if (errmsg == '')
//     	  {

//         		return true;      
//     	   }
//     	   else
//     	  {
// 	       alert (errmsg);
// 	       return false;
// 	   }
// 	}