/*
 * dispatch.js
 * validation for dispatch
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
*/

function putfocus()
{
   document.forms[0].company.focus();
}
function searchsort_fields()
{
    /*var ind1 = document.forms[0].salesorder.selectedIndex;
    var ind2 = document.forms[0].salesorder_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].salesorderfl.value = document.forms[0].salesorder[ind1].text;
    document.forms[0].salesorder_oper.value = document.forms[0].salesorder_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;*/
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
function onSelectStatus()
{
   var aind = document.forms[0].dispstat.selectedIndex;
   if (aind == 0)
   {
      alert ("Please select a valid Status");
      return false;
   }
   document.forms[0].status.value = document.forms[0].dispstat[aind].text;
//   document.forms[0].activeval.value = document.forms[0].dispstat[aind].text;
}
function printCofc(disprecnum)
{
//alert(disprecnum);
var winWidth = 1200;
var winHeight = 1200;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printCofc.php?disprecnum="+disprecnum, "PrintCofc", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}



function printlabel(disprecnum)
{
//alert(disprecnum);
var winWidth = 400;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printCofc_label.php?disprecnum="+disprecnum, "PrintCofc_label", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function GetDate(rt) 
{
//alert('hi');
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
function SetDate(dateval,fieldname) 
{
fn = document.getElementById(fieldname);
//alert(fn);
fn.value = dateval;
}
function Getwo4dc(rt)
{

  if (document.forms[0].crnnum.value.length == 0)
  {
      alert('Please enter PRN\n');
	    return false;
  }
  if (document.forms[0].companyrecnum.value.length == 0)
  {
      alert('Please enter Customer name.\n');
	    return false;
  }  
  var crn = document.forms[0].crnnum.value;
  var type = document.forms[0].type.value;

  var companyrecnum = document.forms[0].companyrecnum.value;
  //alert('Getwo4dc');
  var param = rt;
  var winWidth = 1000;
  var winHeight = 350;
  var winLeft = (screen.width-winWidth)/2;
  var winTop = (screen.height-winHeight)/2;
  win1 = window.open("getwo4dc.php?crn="+crn+"&crecnum="+companyrecnum+"&type="+type,rt, +
  "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
  ",width=" + winWidth + ",height=" + winHeight +
  ",top="+winTop+",left="+winLeft);
}
function Setwo4dc(CIM,fieldname) 
{
   // alert(CIM);
   //alert(fieldname);
    CIM = CIM.split("|");
   var id1="wonum"+ fieldname;
   var text1= document.getElementById(id1);
   text1.value=CIM[0];
 if(CIM.length == 20)
 {
 
     batch=CIM[17];
     supwo=CIM[19];  
 }

 else 
 {
 
     batch=CIM[18];
     supwo=CIM[17];
 }
   //alert('supp_wo='+CIM[17]);
   var id16="supplier_wonum"+ fieldname;
   var text16= document.getElementById(id16);
   text16.value=supwo;

   var id2="partnum"+ fieldname;
   var text2= document.getElementById(id2);
   text2.value=CIM[1];

   var id3="grnnum"+ fieldname;
   var text3= document.getElementById(id3);
   text3.value=CIM[2];

   var id4="custpo_num"+ fieldname;
   var text4= document.getElementById(id4);
   text4.value=CIM[3];

   var id6="custpo_date"+ fieldname;
   var text6= document.getElementById(id6);
   text6.value=CIM[5];

   var id7="wo_qty"+ fieldname;
   var text7= document.getElementById(id7);
   text7.value=CIM[6];

   var id8="comp_qty"+ fieldname;
   var text8= document.getElementById(id8);
   text8.value=CIM[7];

   var id9="disp_update"+ fieldname;
   var text9= document.getElementById(id9);
   var disp_qty="disp_qty"+fieldname;
   var dq = document.getElementById(disp_qty).value;
   text9.value=CIM[8]-dq;

   var id10="partname"+ fieldname;
   var text10= document.getElementById(id10);
   text10.value=CIM[10];

   var id11="rmspec"+ fieldname;
   var text11= document.getElementById(id11);
   text11.value=CIM[11];

   var id12="drgiss"+ fieldname;
   var text12 = document.getElementById(id12);
   text12.value=CIM[12];

   var id13="partiss"+ fieldname;
   var text13 = document.getElementById(id13);
   text13.value=CIM[13];

   var id14="itemnum"+ fieldname;
   var text14 = document.getElementById(id14);
   text14.value=CIM[15];

   var id15="cos"+ fieldname;
   var text15 = document.getElementById(id15);
   text15.value=CIM[16];
   
   var id16="batchnum"+ fieldname;
   var text16 = document.getElementById(id16);
   text16.value=batch;

    var id17="dnnum"+ fieldname;
   var text17 = document.getElementById(id17);
   text17.value=CIM[18];
}

function GetCIM(rt) 
{
// alert(rt);
var param = rt;
var winWidth = 1000;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getCIM.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetCIM(CIM,fieldname)
{
//alert(document.forms[0].elements[fieldname]);
//alert(document.forms[0].elements[fieldname + "recnum"]);
   var CIM = CIM.split("|");
   document.forms[0].crnnum.value = CIM[9];
    for(i=1; i<6; i++)
    { 
       wonum = "wonum" + i;
       document.getElementById(wonum).value ='';
       disp_update = "disp_update" + i;
       document.getElementById(disp_update).value ='';
       custpo_num = "custpo_num" + i;
       document.getElementById(custpo_num).value ='';
       grnnum = "grnnum" + i;
       document.getElementById(grnnum).value ='';
       comp_qty = "comp_qty" + i;
       document.getElementById(comp_qty).value ='';
       partname="partname"+i;
       document.getElementById(partname).value ='';
       drgiss="drgiss"+i;
       document.getElementById(drgiss).value ='';
       partiss="partiss"+i;
       document.getElementById(partiss).value ='';
       itemnum="itemnum"+i;
       document.getElementById(itemnum).value ='';
       rmspec="rmspec"+i;
       document.getElementById(rmspec).value ='';
       partnum="partnum"+i;
       document.getElementById(partnum).value ='';
       custpo_date="custpo_date"+i;
       document.getElementById(custpo_date).value = '';
       wo_qty="wo_qty"+i;
       document.getElementById(wo_qty).value = '';
       line_num="line_num"+i;
       document.getElementById(line_num).value = '';
       disp_qty="disp_qty"+i;
       document.getElementById(disp_qty).value = '';
    }
}

function check_req_fields1()
{
  
     	//alert ('function working');
	//return false;
	var lipresent = 0;
	var x = 1;
    var errmsg = "";
	var totdispqty = 0
    
    /*if (document.getElementById('relnotenum').value == '')
    {
         errmsg += 'Please enter Rel Note#.\n';
    }*/
    //alert ('inside');
    if (document.forms[0].disp_date.value.length == 0)
    {
         errmsg += 'Please enter Dispatch Date.\n';
    }
    if (document.forms[0].disp2company.value.length == 0)
    {
         errmsg += 'Please enter Company name.\n';
    }
    if (document.forms[0].crnnum.value.length == 0)
    {
         errmsg += 'Please enter PRN.\n';
    }
 //   var ind = document.forms[0].index.value;
    var woarray = new Array(6);
    for(i=1; i<7; i++)
    { 
       ln = "line_num" + i;
       lnv = document.getElementById(ln).value;
       if (document.getElementById(ln).value.length != 0)
       {
           wonum = "wonum" + i;
           if (document.getElementById(wonum).value.length == 0)
           {
               errmsg += 'Please enter WO# for line item ' + lnv + '\n';
           }
           else 
           {
              wo=document.getElementById(wonum).value;
              for (j=1; j<7;j++) 
              {
                 if (wo == woarray[j])
                 {

                    errmsg += 'Duplicate WO at line item ' + lnv + '\n';
                 }
              }
              woarray[i] = wo;
           }
	        partnum = "partnum" + i;
           if (document.getElementById(partnum).value.length == 0)
           {
               errmsg += 'Please enter Part# for line item ' + lnv + '\n';
           }
           
	   wo_qty = "wo_qty" + i;
	   if (document.getElementById(wo_qty).value.length == 0)
           {
               errmsg += 'Please enter WO Qty for line item ' + lnv + '\n';
           }

	   comp_qty = "comp_qty" + i;
	   if (document.getElementById(comp_qty).value.length == 0)
           {
               errmsg += 'Please enter Acc Qty for line item ' + lnv + '\n';
           }

           disp_update = "disp_update" + i;
           grnnum = "grnnum" + i;
	   if (document.getElementById(grnnum).value.length == 0)
           {
               errmsg += 'Please enter GRN Num for line item ' + lnv + '\n';
           }

    //        custpo_num = "custpo_num" + i;
	   // if (document.getElementById(custpo_num).value.length == 0)
    //        {
    //            errmsg += 'Please enter Custpo Num for line item ' + lnv + '\n';
    //        }

	   custpo_date = "custpo_date" + i;
	   if (document.getElementById(custpo_date).value.length == 0)
           {
               errmsg += 'Please enter Custpo Date for line item ' + lnv + '\n';
           }

           disp_qty = "disp_qty" + i;
           if (document.getElementById(disp_qty).value.length == 0 || document.getElementById(disp_qty).value.length == 'NULL')
           {
               errmsg += 'Please enter Dispatch Qty for line item ' + lnv + '\n';
           }
           

          var dispatch = parseInt(document.getElementById(disp_qty).value);
	  if (document.getElementById(disp_update).value.length == 0)
          {
              disp2dt = 0;
          }
          else 
		  {
              var disp2dt = parseInt(document.getElementById(disp_update).value);
          }
          var comqty = parseInt(document.getElementById(comp_qty).value);
          var currqty = parseInt(document.getElementById(disp_qty).value);
          // alert("comp qty is "+comqty);
          // alert("curr qty is "+currqty);
          // alert("Disp UTD "+disp2dt);

          qtyallowed = comqty - disp2dt;
		      totdispqty = totdispqty + currqty;
      
          // alert("Allowed qty "+qtyallowed);    
		// alert(parseInt(currqty)+'---++++++'+parseInt(qtyallowed));
          if(currqty > qtyallowed) 
          {
               errmsg += 'Curr Dispatch Qty is invalid for line item ' + lnv + '\n';
          }
          lipresent = 1;
          exp_invnum="exp_invnum"+i;
          //document.getElementById(exp_invnum).value = document.getElementById("expinvnum").value
		  disp_custpo_no="disp_custpo_no"+i;
		  disp_custpo_item="disp_custpo_item"+i;
       
		  if(document.getElementById(disp_custpo_no).value == '' || document.getElementById(disp_custpo_item).value == '')
		   {
				if(document.getElementById(disp_custpo_no).value != '' || document.getElementById(disp_custpo_item).value != '')	
			   {
					errmsg += 'Please Enter both Dispatch Custpo No. & Dispatch Custpo Item ';
			   }
		   }

       }
       x++;
     }
	     if(document.forms[0].pagename.value == 'newdispatch')
	 {
	    var schqty = document.forms[0].schqty.value;

      // alert(document.getElementById("crnnum").value);
	 }
	 else
	 {
         var schqty = document.forms[0].delivery_sch_qty.value;
	 }
	   //alert(totdispqty+"---***---"+schqty);
	  //return false;
       if (totdispqty > parseInt(schqty))
       {
             errmsg += 'Total disp qty > Schedule Qty\n';
       }
       document.forms[0].totdispqty.value  = totdispqty
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

function GetCompany(rt) 
{
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
function SetCustomer(company,companyrecnum)
{
document.forms[0].disp2company.value = company;
document.forms[0].companyrecnum.value = companyrecnum;
}

function addRow(id,index)
{
var x=index;
//alert("Here index is "+ x);
prevlinenum="prev_line_num"+index;
lirecnum="lirecnum"+index;
line_num="line_num"+index;
wonum="wonum"+index;
//alert(qty);
grnnum="grnnum"+index;
partnum="partnum"+index;
wo_qty="wo_qty"+index;
comp_qty="comp_qty"+index;
custpo_num="custpo_num"+index;
custpo_qty="custpo_qty"+index;
custpo_date="custpo_date"+index;
disp_qty="disp_qty"+index;

//alert('here');
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","10");
inp1.setAttribute("name",line_num);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","10");
inp2.setAttribute("name",wonum);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","10");
inp3.setAttribute("name",partnum);
cell3.appendChild(inp3);

var cell12 = document.createElement("TD");
var inp12 =  document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","10");
inp12.setAttribute("name",wo_qty);
cell12.appendChild(inp12);

var cell13 = document.createElement("TD");
var inp13 =  document.createElement("INPUT");
inp13.setAttribute("type","text");
inp13.setAttribute("size","10");
inp13.setAttribute("name",comp_qty);
cell13.appendChild(inp13);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","10");
inp4.setAttribute("name",grnnum);
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","10");
inp5.setAttribute("name",custpo_num);
cell5.appendChild(inp5);

var cell6 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","10");
inp6.setAttribute("name",custpo_qty);
cell6.appendChild(inp6);

var cell7= document.createElement("TD");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","10");
inp7.setAttribute("name",custpo_date);
cell7.appendChild(inp7);

var cell8 = document.createElement("TD");
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","10");
inp8.setAttribute("name",disp_qty);
cell8.appendChild(inp8);



var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","hidden");
inp9.setAttribute("value","");
inp9.setAttribute("id",prevlinenum);
inp9.setAttribute("name",prevlinenum);

var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","hidden");
inp10.setAttribute("value","");
inp10.setAttribute("id",lirecnum);
inp10.setAttribute("name",lirecnum);

var cell11 = document.createElement("TD");
var img =  document.createElement("img");
img.src="images/bu-getwo.gif";
img.onclick=function(){Getwo4dc(index);};
cell11.appendChild(img);


row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell11);
row.appendChild(cell3);
row.appendChild(cell12);
row.appendChild(cell13);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell8);
row.appendChild(cell9);
row.appendChild(cell10);
tbody.appendChild(row);
x++;
//alert('i am here');
document.forms[0].index.value=x;
}
function onchagetype()
{
 //alert('Please Select WO#');
 document.getElementById('disp2company').value ="";
 document.getElementById('crnnum').value = "";
}

function GetSch(rt) {
//alert(rt);
var param = rt;
var winWidth = 1000;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
crnnum = document.getElementById('crnnum').value;
//alert(crnnum);
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

function SetSch(CIMarr,fieldname) {
//alert(document.forms[0].elements[fieldname]);
//alert(document.forms[0].elements[fieldname + "recnum"]);
//alert(CIMarr);
//document.forms[0].elements[fieldname + "recnum"].value = CIMrecnum;
//alert(CIMarr);
var CIMdet = CIMarr.split("|");
crn = CIMdet[0];
document.forms[0].sch_date.value = CIMdet[2];
document.forms[0].schqty.value = CIMdet[3];
var remain_qty=CIMdet[3]-CIMdet[8];
document.forms[0].schqty.value = remain_qty;
document.forms[0].delivery_sch_qty.value=CIMdet[3];
}

function export_dispatch()
{
	if(document.getElementById('ddate1').value == '' || document.getElementById('ddate2').value == '')
	{
		alert("Please Select From & To Date");
		return false;
	}
	else
	{
    crnnum=document.getElementById('final_crn').value;
    from_date=document.getElementById('ddate1').value;
    to_date=document.getElementById('ddate2').value;	
	document.getElementById('myLink').href='export_cofc.php?crnnum='+crnnum+
		'&from_date='+from_date+'&to_date='+to_date;	
	}
}

function resetsch_date()
{
  document.getElementById('sch_date').value = '';
}