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

function setBom() {
//alert('666');
//alert(document.getElementById('oper_no')[opindex].text;);
var bomindex =  document.getElementById('bom_refnum').selectedIndex;
bomText=document.getElementById('bom_refnum')[bomindex].value;
var BOM = bomText.split("|");
document.getElementById('bom_refnum')[bomindex].value = BOM[0];
//alert(BOM[0]);
document.getElementById('bom_iss').value = BOM[1];
}


function SetDate(dateval,fieldname)
{
 document.forms[0].elements[fieldname].value = dateval;
}


function printassyReview(recnum)
{
var winWidth = 1200;
var winHeight = 1200;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printassyReview.php?recnum="+recnum, "PrintassyReview", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function check_req_fields()
{
    var errmsg = '';	
	var lipresent = 0;
    var index = document.forms[0].maxrecnum.value;
    if (document.forms[0].cust_ponum.value.length == 0 )
    {
         errmsg += 'Please Enter Assembly Review#\n';
    }
    if (document.forms[0].customer.value.length == 0 )
    {
         errmsg += 'Please Enter Customer Name\n';
    }
    if (document.forms[0].po_date.value.length == 0 )
    {
         errmsg += 'Please Select PO Date\n';
    }
    if (document.forms[0].special_instruction.value.length == 0 )
    {
         errmsg += 'Please Enter Special Instruction\n';
    }
    
    for(i=0; i<index; i++)
    {
       ln = "line_num" + i;
       lnv = document.getElementById(ln).value;
       if (document.getElementById(ln).value.length != 0)
       {

           crn = "crn" + i;
           crn_check = "crn_check" + i;
           bomnum = "bomnum" + i;
           bom = "bom" + i;
           bomindex = document.getElementById(bom).selectedIndex;
           if(document.getElementById(crn).value.length == 0)
           {
             errmsg += 'Please enter PRN at Line' + lnv + '\n';
           }
          /* if(document.getElementById(bom)[bomindex].text == '')
           {
             errmsg += 'Please select BOM ref at Line' + lnv + '\n';
           }*/
          /* if ((document.getElementById(crn_check).value.length != 0 && document.getElementById(crn).value.length != 0) && 
			   (document.getElementById(crn).value != document.getElementById(crn_check).value))
           {
               errmsg += 'Please enter valid CRN for BOM: ' + document.getElementById(bomnum).value + ' at Line '+lnv+'\n'+'valid CRN: '+document.getElementById(crn_check).value+'\n';
           }*/
           lipresent = 1;
       }

     }
    if(lipresent==0)
    {
      errmsg += "Atleast One Line Item Sholud Be Present \n";
    }
    if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}

function getbom(index) {
//alert(index);
bom_iss = "bom_iss" + index;
bom = "bom" + index;
bomnum = "bomnum" + index;
crn_check = "crn_check" + index;
var bomindex =  document.getElementById(bom).selectedIndex;
bomText=document.getElementById(bom)[bomindex].value;
//alert(bomText);
var bomarr = bomText.split("|");
document.getElementById(bom_iss).value = bomarr[1];
document.getElementById(bomnum).value = bomarr[0];
document.getElementById(crn_check).value = bomarr[2];
}

function addRow(id,index){
//alert('AI='+index);
var bomDetails = document.getElementById('bom_details').value;
bomArr=bomDetails.split("*");

var x = index;
var y = index;
// alert(y+"i--n---d---");
linenumber="line_num"  + index;
crn="crn" + index;
crn_check="crn_check" + index;
assy_partnum="assy_partnum" + index;
assy_desc="assy_desc" + index;
bom="bom" + index;
bomnum="bomnum" + index;
bom_iss="bom_iss" + index;
qty="qty" + index;
price="price" + index;
tot_price="tot_price" + index;
pcrn="pcrn"+x;
partnum="partnum" + index;
description="description" + index;
part_iss="part_iss" + index;
cos_iss="cos_iss" + index;
model_iss="model_iss" + index;
drg_iss="drg_iss" + index;
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

prevlinenum = "prev_line_num" + index;
lirecnum = "lirecnum" + index;


var cell1 = document.createElement("TD");
cell1.setAttribute("align","left");
var inp1 =  document.createElement("INPUT");
inp1.type="text";
inp1.name=linenumber;
inp1.id=linenumber;
inp1.size="3";
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.type="text";
inp2.name=crn;
inp2.id=crn;
inp2.size="10";
inp2.style.backgroundColor = "#DDDDDD";
inp2.readOnly = true;
var img1 = document.createElement("img");
img1.setAttribute("src","images/bu-get.gif");
img1.setAttribute("alt","GetCIM");
img1.onclick = function(){GetCrn4asyrevli(y);};
cell2.appendChild(inp2);
cell2.appendChild(img1);

var inp3 =  document.createElement("INPUT");
inp3.type="hidden";
inp3.name=crn_check;
inp3.id=crn_check;
inp3.value="";
cell2.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.type="text";
inp4.name=assy_partnum;
inp4.id=assy_partnum;
inp4.size="22";
inp4.style.backgroundColor = "#DDDDDD";
inp4.readOnly = true;
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.type="text";
inp5.name=assy_desc;
inp5.id=assy_desc;
inp5.size="30";
inp5.style.backgroundColor = "#DDDDDD";
inp5.readOnly = true;
cell5.appendChild(inp5);

/*var cell6 = document.createElement("TD");
cell6.setAttribute("align","left");
var inp6 =  document.createElement("select");
inp6.name=bom;
inp6.id=bom;
var inp6_op = document.createElement("option");
inp6_op.text="";
inp6.options.add(inp6_op);
for(i=0;i<bomArr.length;i++)
{
 bomINArr = bomArr[i].split("|");
 var inp6_op=document.createElement("option");
 inp6_op.text=bomINArr[0];
 inp6_op.value=bomINArr[0]+'|'+bomINArr[1]+'|'+bomINArr[2];
 inp6.options.add(inp6_op);
}
inp6.onchange = function() {
getbom(y);
}
cell6.appendChild(inp6); */

var cell6 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.type="text";
inp6.name=bom;
inp6.id=bom;
inp6.size="20";
inp6.style.backgroundColor = "#DDDDDD";
inp6.readOnly = true;
cell6.appendChild(inp6);


var cell7 = document.createElement("TD");
var inp7 =  document.createElement("INPUT");
inp7.type="text";
inp7.name=bom_iss;
inp7.id=bom_iss;
inp7.size="10";
inp7.style.backgroundColor = "#DDDDDD";
inp7.readOnly = true;
cell7.appendChild(inp7);

var cell8 = document.createElement("TD");
var inp8 =  document.createElement("INPUT");
inp8.type="text";
inp8.name=qty;
inp8.id=qty;
inp8.size="5";
cell8.appendChild(inp8);

var cell9 = document.createElement("TD");
var inp9 =  document.createElement("INPUT");
inp9.type="text";
inp9.name=price;
inp9.id=price;
inp9.size="6";
cell9.appendChild(inp9);

var cell10 = document.createElement("TD");
var inp10 =  document.createElement("INPUT");
inp10.type="text";
inp10.name=tot_price;
inp10.id=tot_price;
inp10.size="8";
inp10.readOnly=true;
inp10.style.backgroundColor = "#DDDDDD";
cell10.appendChild(inp10);


var inp11 =  document.createElement("INPUT");
inp11.type="hidden";
inp11.name=bomnum;
inp11.id=bomnum;
cell10.appendChild(inp11);

var inp12 =  document.createElement("INPUT");
inp12.type="hidden";
inp12.name=prevlinenum;
inp12.id=prevlinenum;
inp12.value="";
cell10.appendChild(inp12);

var cell13 = document.createElement("TD");
var inp13 =  document.createElement("INPUT");
inp13.type="hidden";
inp13.name=lirecnum;
inp13.id=lirecnum;
inp13.value="";
cell10.appendChild(inp13);

var cell14 = document.createElement("TD");
var inp14 =  document.createElement("INPUT");
inp14.type="hidden";
inp14.name=pcrn;
inp14.id=pcrn;
inp14.size="8";
inp14.readOnly=true;
inp14.style.backgroundColor = "#DDDDDD";
//inp14.value=CIM[0];
cell10.appendChild(inp14);

var cell15 = document.createElement("TD");
var inp15 =  document.createElement("INPUT");
inp15.type="text";
inp15.name=partnum;
inp15.id=partnum;
inp15.size="22";
inp15.readOnly=true;
inp15.style.backgroundColor = "#DDDDDD";
inp15.value="";
cell15.appendChild(inp15);

var cell16 = document.createElement("TD");
var inp16 =  document.createElement("INPUT");
inp16.type="text";
inp16.name=description;
inp16.id=description;
inp16.size="30";
inp16.readOnly=true;
inp16.style.backgroundColor = "#DDDDDD";
inp16.value="";
cell16.appendChild(inp16);

var cell17 = document.createElement("TD");
var inp17 =  document.createElement("INPUT");
inp17.type="text";
inp17.name=part_iss;
inp17.id=part_iss;
inp17.size="8";
//inp17.readOnly=true;
//i/np17.style.backgroundColor = "#DDDDDD";
inp17.value="";
cell17.appendChild(inp17);


var cell19 = document.createElement("TD");
var inp19 =  document.createElement("INPUT");
inp19.type="text";
inp19.name=cos_iss;
inp19.id=cos_iss;
inp19.size="8";
//inp19.readOnly=true;
//inp19.style.backgroundColor = "#DDDDDD";
inp19.value="";
cell19.appendChild(inp19);

var cell20 = document.createElement("TD");
var inp20 =  document.createElement("INPUT");
inp20.type="text";
inp20.name=model_iss;
inp20.id=model_iss;
inp20.size="8";
//inp20.readOnly=true;
//inp20.style.backgroundColor = "#DDDDDD";
inp20.value="";
cell20.appendChild(inp20);

var cell21 = document.createElement("TD");
var inp21 =  document.createElement("INPUT");
inp21.type="text";
inp21.name=drg_iss;
inp21.id=drg_iss;
inp21.size="8";
//inp21.readOnly=true;
//inp21.style.backgroundColor = "#DDDDDD";
inp21.value="";
cell21.appendChild(inp21);


row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell15);
row.appendChild(cell16);
row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell17);
row.appendChild(cell19);
row.appendChild(cell20);
row.appendChild(cell21);
row.appendChild(cell8);
row.appendChild(cell9);
row.appendChild(cell10);
tbody.appendChild(row);
x++;
//alert("i am here");
 document.getElementById('maxrecnum').value=x;
}

function printAssyRevDetails(assyrec)
{
 var winWidth = 1400;
 var winHeight = 700;
 var winLeft = (screen.width-winWidth)/2;
 var winTop = (screen.height-winHeight)/2;
 win1 = window.open("assyReviewPrint.php?assyrec=" + assyrec, "PrintAR", +
 "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
 ",width=" + winWidth + ",height=" + winHeight +
 ",top="+winTop+",left="+winLeft);
}

function printAssyRevDetails4View(assyrec)
{
 var winWidth = 1400;
 var winHeight = 700;
 var winLeft = (screen.width-winWidth)/2;
 var winTop = (screen.height-winHeight)/2;
 win1 = window.open("assyReviewPrint4View.php?assyrec=" + assyrec, "PrintAR", +
 "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
 ",width=" + winWidth + ",height=" + winHeight +
 ",top="+winTop+",left="+winLeft);
}

function GetCrn4asyrevli(rt) {
//alert(rt);
var param = rt;
var winWidth = 1000;
var winHeight = 300;
//var lnv=0;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var x=rt;
x++
var n=parseInt(rt)+3;

       index=document.getElementById("maxrecnum").value;
       ln = "line_num" + rt;
       qty = "qty" + rt;
       crn = "crn" + rt;
       lnv = document.getElementById(ln).value;
       qty_ln = document.getElementById(qty).value;
       crn_num = document.getElementById(crn).value;

       if (document.getElementById(ln).value.length == 0)
       {
         alert("Please enter line number");
         return false;
       }else if(qty_ln == 0 || qty_ln =="")
       {
         alert("Please enter Qty");
         return false;
       }
if(document.getElementById("page").value=='edit')
{
   if(crn_num!="")
   {
      while(x<index)
      {
          ln_num = "line_num" + x;
          //alert(x+"----"+ln_num);
      if(!document.getElementById(ln_num).value)
          {
          
          }else
          {
         lnv_num = document.getElementById(ln_num).value;
          //alert(lnv_num+"ln num---"+lnv);
          ln_arr=lnv.split("-");
          lnarr= document.getElementById(ln_num).value.split("-");   //&& (ln_arr[1]!=undefined)
          //alert(ln_arr[0]+"------arr---"+ln_arr[1]+"first----");
         if(ln_arr[1]==undefined)
         {
           var ptable = document.getElementById('myTable');
           var lastElement = ptable.rows.length;
           //alert(lnv+"---**----"+lnarr[0]+"-------"+x+"-----dv---"+n);

          if ((lnv==lnarr[0]) )
          {   plnnum = "line_num" + x;
              //alert(plnnum+"in loop");
              //alert(document.getElementById(plnnum).value);
              document.getElementById(plnnum).value="";
              //alert(document.getElementById(plnnum).value);
              ptable.deleteRow(n);
          }

      }
      }
      x++;
    }
  }
}

win1 = window.open("getCIM4review.php?&lnnum="+lnv+"&pqty="+qty_ln, param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function Setcrn_assyrev(CIM,fieldname,lnnum,pqty)
{

   var CIM = CIM.split("|");
   var id2="crn"+ fieldname;
   var text2= document.getElementById(id2);
   text2.value=CIM[1];

   var id3="assy_partnum"+ fieldname;
   var text3= document.getElementById(id3);
   text3.value=CIM[2];

   var id7="assy_desc"+ fieldname;
   var text7= document.getElementById(id7);
   text7.value=CIM[4];

}

function toggleValue(divid,chk)
{
 //alert(chk+"---"+divid);
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
 if(divid == "qa_app")
 {
   document.getElementById('qa_app_by').value=document.getElementById('userid').value;
 }
 if(divid == "eng_app")
 {
   document.getElementById('eng_app_by').value=document.getElementById('userid').value;
 }
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
/* if (document.forms[0].notes.value.length == 0)
 {
        errmsg += 'Please enter Notes.\n';
 } */
  if (document.forms[0].dept.value == 'QAAPP' && document.getElementById('qa_app').value == "no" && document.getElementById('eng_app').value == "yes")
  {
         errmsg += 'QA Approval should be done.\n';
  }
  if (document.forms[0].dept.value == 'ENGAPP' && document.getElementById('eng_app').value == "no")
  {
        errmsg += 'Engg Approval should be done.\n';
  }

 if (errmsg == '')
     return true;
 else
 {
     alert (errmsg);
     return false;
 }
}

function onSelectStatus()
{
   var aind = document.forms[0].active.selectedIndex;
   document.forms[0].status.value = document.forms[0].active[aind].text;
   document.forms[0].activeval.value = document.forms[0].active[aind].text;

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
  document.forms[0].customer.value = customer;
  document.forms[0].companyrecnum.value = custrecnum;
}