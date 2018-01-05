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

function GetPartDetails(rt) {

  //alert('Getwo4del');
  var crn = document.getElementById("crn"+rt).value;
  var custpotype = document.getElementById("type").value;
  if(document.getElementById("page_name").value=='edit_assypo')
  {
   var order_to = document.forms[0].order_to.value;
  }
  else
  {
    var ind1 = document.forms[0].order_to.selectedIndex;
    var order_to = document.forms[0].order_to[ind1].value;
  }


  //alert("order to is :"+order_to);
  if (crn == '')
  {
    alert('Please Enter CRN No.');
    return false;
  }
  var param = rt;
  var winWidth = 1000;
  var winHeight = 200;
  var winLeft = (screen.width-winWidth)/2;
  var winTop = (screen.height-winHeight)/2;
  win1 = window.open("getPartDetails.php?crn="+crn+"&company="+order_to+"&custpotype="+custpotype, rt, +
  "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
  ",width=" + winWidth + ",height=" + winHeight +
  ",top="+winTop+",left="+winLeft);
}

function Setwo4det(CIM,fieldname,flag,spec_flag) {
   // alert(flag);
   //alert(fieldname);
   if(flag == 1)
   {
     alert('Cust Po is not Matching with Master Data');
     return false;
   }
   if(spec_flag == 1)
   {
     alert('Special Characters Are Present');
     //return false;
   }
   var CIM = CIM.split("|");

   var id1="pri_partnum"+ fieldname;
   var text1= document.getElementById(id1);
   text1.value=CIM[2];

   var id2="sec_partnum"+ fieldname;
   var text2= document.getElementById(id2);
   text2.value=CIM[1];

   var id3="partname"+ fieldname;
   var text3= document.getElementById(id3);
   text3.value=CIM[3];

   var id4="partiss"+ fieldname;
   var text4= document.getElementById(id4);
   text4.value=CIM[4];

   var id6="drgiss"+ fieldname;
   var text6= document.getElementById(id6);
   text6.value=CIM[5];

   var id7="mtlspec"+ fieldname;
   var text7= document.getElementById(id7);
   text7.value=CIM[6];

   var id8="mtltype"+ fieldname;
   var text8= document.getElementById(id8);
   text8.value=CIM[7];

   var id10="cos"+ fieldname;
   var text10= document.getElementById(id10);
   text10.value=CIM[8];
   
   var id11="price"+ fieldname;
   var text11= document.getElementById(id11);
   text11.value=CIM[9];

}

function GetDate(rt) {

//alert(rt);
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

fn = document.getElementById(fieldname);
//alert(fn);
fn.value = dateval;
}

function onSelectCurr()
{

   var aind = document.forms[0].pocurr.selectedIndex;
   if (aind == 0)
   {
      alert ("Please select a valid Currency");
      return false;
   }
   document.forms[0].currency.value = document.forms[0].pocurr[aind].text;
}

function onSelecttype()
{
        var aind = document.forms[0].type1.selectedIndex;
        document.forms[0].type.value = document.forms[0].type1[aind].text;
}

function printCofc(delrecnum) {
//alert(delrecnum);
var winWidth = 1400;
var winHeight = 1200;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printassypo.php?rec="+delrecnum, "PrintAssypo", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}

function toggleValue(divid,chk,approve_date)
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
  }
 }
 else
 {
   document.getElementById(divid).value="no";
 }
   if(document.getElementById('approval').value=="yes"){
  document.getElementById('approvaldate').value = approve_date;
  }
  else if(document.getElementById('approval').value=="no"){
    document.getElementById('approvaldate').value = '';
  }

}

function check_req_fields()
{

	//return false;
    var lipresent = 0;
    var errmsg = '';
    var x = 1;
    var index = document.forms[0].index.value;
    //alert(index);
    var page =  document.forms[0].page.value;
  
  if(page == 'new')
  {
    var supplierindex =  document.getElementById('order_to').selectedIndex;
    if(supplierindex == 0)
    {
       errmsg +='Please Select Order To.\n';
    }
    var hostindex =  document.getElementById('from').selectedIndex;
    if(hostindex == 0)
    {
       errmsg +='Please Select Host.\n';
    }
  }
    if (document.forms[0].po_num.value.length == 0)
    {
         errmsg += 'Please enter Assembly PO #.\n';
    }
    if (document.forms[0].podate.value.length == 0)
    {
         errmsg += 'Please enter PO Date\n';
    }
    if (document.forms[0].podesc.value.length == 0)
    {
         errmsg += 'Please enter PO Desc.\n';
    }
    if (document.forms[0].amendment_num.value.length != 0 && (document.forms[0].amendmentdate.value.length == 0 ||document.forms[0].amendmentdate.value == '0000-00-00' ))
    {
         errmsg += 'Please enter Amendment Date\n';
    }
     if (document.forms[0].amendment_num.value.length != 0 && document.forms[0].amendment_notes.value.length == 0 )
    {
         errmsg += 'Please enter Notes For Amendment \n';
    }
    if (document.forms[0].terms.value.length == 0)
    {
         errmsg += 'Please enter Header.\n';
    }
    if (document.forms[0].remarks.value.length == 0)
    {
         errmsg += 'Please enter Remarks.\n';
    }
   /* if((dept =='Purchasing' ||dept =='Sales') && noedit =="" ){
    if (document.getElementById("approval").value == "yes" && document.getElementById("status").value!= "Open" )
    {
         errmsg += 'Please Change Status to Open\n';
    }
    if (document.getElementById("approval").value != "yes" && document.getElementById("status").value == "Open" )
    {
         errmsg += 'Status Cannot be Open\n';
    }
    }*/
    
    if (page == 'edit')
    {
     if(document.getElementById("approvaldate").value != '0000-00-00')
     {
       var str1 = document.getElementById("approvaldate").value;
       var date1 = str1.split("-");
       var dt1  = date1[2];
       var mon1 = date1[1];
       var yr1  = date1[0];

       var str2 = document.getElementById("podate").value;
       var date2 = str2.split("-");
       var dt2  = date2[2];
       var mon2 = date2[1];
       var yr2  = date2[0];
       
       var apdate = new Date(yr1, (mon1-1), dt1);
       var pdate = new Date(yr2, (mon2-1), dt2);

      if(apdate < pdate)
      {
         errmsg += "Approval Date should be greater than or equal to PO Date.\n";
      }
     }
   /* if((dept =='Purchasing' ||dept =='Sales') && noedit =="" ){
    if (document.getElementById("approval").value == "yes" && document.getElementById("status").value!= "Open" )
    {
         errmsg += 'Please Change Status to Open\n';
    }
    if (document.getElementById("approval").value != "yes" && document.getElementById("status").value == "Open" )
    {
         errmsg += 'Status Cannot be Open\n';
    }
    }*/

    if (document.getElementById("approval").value == "yes" &&
        document.getElementById("status").value != "Open" &&
        document.getElementById("prevstatus").value != "Open")
    {
         errmsg += 'Please Change Status to Open\n';
    }
    if (document.getElementById("approval").value != "yes" && document.getElementById("status").value == "Open" )
    {
         errmsg += 'Status Cannot be Open\n';
    }
 }

    while (x < index)
    {

       ln = "line_num" + x;
       //alert('value='+document.getElementById(ln).value);
       lnv = document.getElementById(ln).value;
       if (document.getElementById(ln).value.length != 0)
       {
        //alert('inside');

           crn = "crn" + x;
           if (document.getElementById(crn).value.length == 0)
           {
             //alert('crn');
               errmsg += 'Please enter CRN Ref for line item ' + lnv + '\n';
           }
           qty = "qty" + x;
           if (document.getElementById(qty).value.length == 0)
           {
             //alert('crn');
               errmsg += 'Please enter Qty for line item ' + lnv + '\n';
           }
           price = "price" + x;
           if (document.getElementById(price).value.length == 0)
           {
             //alert('crn');
               errmsg += 'Please enter Price for line item ' + lnv + '\n';
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

function onSelectStatus()
{

   var aind = document.forms[0].postat.selectedIndex;
   if (aind == 0)
   {
      alert ("Please select a valid Status");
      return false;
   }
   document.forms[0].status.value = document.forms[0].postat[aind].text;
   document.forms[0].activeval.value = document.forms[0].postat[aind].text;

}


function addRow(id,index){
//alert(index);
var x = index;
var y = index;
line_num="line_num"+index;
crn="crn"+index;
pri_partnum="pri_partnum"+index;
sec_partnum="sec_partnum"+index;
partname="partname"+index;
partiss="partiss"+index;
drgiss="drgiss"+index;
mtlspec="mtlspec"+index;
mtltype="mtltype"+index;
//rate="rate"+index;
cos="cos"+index;
qty="qty"+index;
price="price"+index;
ext_price="ext_price"+index;
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

prevlinenum = "prev_line_num" + index;
lirecnum = "lirecnum" + index;


var cell1 = document.createElement("TD");
cell1.setAttribute("align","left");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","3");
inp1.setAttribute("name",line_num);
inp1.setAttribute("id",line_num);
cell1.appendChild(inp1);

/*var cell2 = document.createElement("TD");
cell2.setAttribute("align","left");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","10");
inp2.setAttribute("name",itemnum);
inp2.setAttribute("id",itemnum);
cell2.appendChild(inp2);*/

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("readOnly","true");
cell3.setAttribute("align","left");
inp3.setAttribute("size","20");
inp3.setAttribute("name",pri_partnum);
inp3.setAttribute("id",pri_partnum);
inp3.style.backgroundColor = "#DDDDDD";
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
cell4.setAttribute("align","left");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("readOnly","true");
inp4.setAttribute("size","15");
inp4.setAttribute("name",sec_partnum);
inp4.setAttribute("id",sec_partnum);
inp4.style.backgroundColor = "#DDDDDD";
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
cell5.setAttribute("align","left");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","10");
inp5.setAttribute("name",crn);
inp5.setAttribute("id",crn);
cell5.appendChild(inp5);


var cell5image = document.createElement("img");
cell5image.setAttribute("src","images/bu-get.gif");
cell5image.onclick= function() {
GetPartDetails(y);
};
cell5.appendChild(cell5image);

var inp10 = document.createElement("INPUT");
inp10.setAttribute("type","hidden");
inp10.setAttribute("value","");
inp10.setAttribute("name",prevlinenum);
inp10.setAttribute("id",prevlinenum);
cell5.appendChild(inp10);

var inp11 = document.createElement("INPUT");
inp11.setAttribute("type","hidden");
inp11.setAttribute("value","");
inp11.setAttribute("name",lirecnum);
inp11.setAttribute("id",lirecnum);
cell5.appendChild(inp11)

var cell9 = document.createElement("TD");
cell9.setAttribute("align","left");
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("readOnly","true");
inp9.setAttribute("type","text");
inp9.setAttribute("size","10");
inp9.setAttribute("name",partname);
inp9.setAttribute("id",partname);
inp9.style.backgroundColor = "#DDDDDD";
cell9.appendChild(inp9);

var cell6 = document.createElement("TD");
cell6.setAttribute("align","left");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("readOnly","true");
inp6.setAttribute("type","text");
inp6.setAttribute("size","3");
inp6.setAttribute("name",partiss);
inp6.setAttribute("id",partiss);
inp6.style.backgroundColor = "#DDDDDD";
cell6.appendChild(inp6);

var cell7 = document.createElement("TD");
cell7.setAttribute("align","left");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("readOnly","true");
inp7.setAttribute("type","text");
inp7.setAttribute("size","3");
inp7.setAttribute("name",drgiss);
inp7.setAttribute("id",drgiss);
inp7.style.backgroundColor = "#DDDDDD";
cell7.appendChild(inp7);

var cell8 = document.createElement("TD");
cell8.setAttribute("align","left");
var inp8 = document.createElement("INPUT");
inp8.setAttribute("readOnly","true");
inp8.setAttribute("type","text");
inp8.setAttribute("size","10");
inp8.setAttribute("name",cos);
inp8.setAttribute("id",cos);
inp8.style.backgroundColor = "#DDDDDD";
cell8.appendChild(inp8);

var cell12 = document.createElement("TD");
cell12.setAttribute("align","left");
var inp12 = document.createElement("INPUT");
inp12.setAttribute("readOnly","true");
inp12.setAttribute("type","text");
inp12.setAttribute("size","8");
inp12.setAttribute("name",mtlspec);
inp12.setAttribute("id",mtlspec);
inp12.style.backgroundColor = "#DDDDDD";
cell12.appendChild(inp12);

var cell15 = document.createElement("TD");
cell15.setAttribute("align","left");
var inp15 = document.createElement("INPUT");
inp15.setAttribute("readOnly","true");
inp15.setAttribute("type","text");
inp15.setAttribute("size","10");
inp15.setAttribute("name",mtltype);
inp15.setAttribute("id",mtltype);
inp15.style.backgroundColor = "#DDDDDD";
cell15.appendChild(inp15);

var cell16 = document.createElement("TD");
cell16.setAttribute("align","left");
var inp16 = document.createElement("INPUT");
inp16.setAttribute("type","text");
inp16.setAttribute("size","5");
inp16.setAttribute("name",qty);
inp16.setAttribute("id",qty);
cell16.appendChild(inp16);

var cell17 = document.createElement("TD");
cell17.setAttribute("align","left");
var inp17 = document.createElement("INPUT");
inp17.setAttribute("type","text");
inp17.setAttribute("size","6");
inp17.setAttribute("name",price);
inp17.setAttribute("id",price);
cell17.appendChild(inp17);


var cell13 = document.createElement("TD");
cell13.setAttribute("align","left");
var inp13 = document.createElement("INPUT");
inp13.setAttribute("readOnly","true");
inp13.setAttribute("type","text");
inp13.setAttribute("size","6");
inp13.setAttribute("name",ext_price);
inp13.setAttribute("id",ext_price);
inp13.style.backgroundColor = "#DDDDDD";
cell13.appendChild(inp13);

/*var cell14 = document.createElement("TD");
cell14.setAttribute("align","left");
var inp14 = document.createElement("INPUT");
inp14.setAttribute("type","text");
inp14.setAttribute("readOnly","true");
inp14.setAttribute("size","16");
inp14.setAttribute("name",rm_spec);
inp14.setAttribute("id",rm_spec);
inp14.style.backgroundColor = "#DDDDDD";
cell14.appendChild(inp14);*/


row.appendChild(cell1);
row.appendChild(cell5);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell9);
row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell12);
row.appendChild(cell15);
row.appendChild(cell8);
row.appendChild(cell16);
row.appendChild(cell17);
row.appendChild(cell13);

tbody.appendChild(row);
x++;
//alert("i am here");
document.forms[0].index.value = x;
}

function onSelectType()
{

   var aind = document.forms[0].potype.selectedIndex;

   document.forms[0].type.value = document.forms[0].potype[aind].text;

}

