/*
 * master_data.js
 * validation for qualityplan
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
*/

function searchsort_fields()
{
    var s1ind = document.forms[0].sort1.selectedIndex;
    
    //alert('sortby' +  s1ind)

    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}

function putfocus()
{
   document.forms[0].CIM_refnum.focus();
}

function ConfirmDelete() {
     document.forms[0].deleteflag.value = "y";
     return true;
}

function check_req_fields()
{

  // alert(document.getElementById("pagename"));
	//alert ('function working');
	//return false;
    var errmsg = '';
    if (document.forms[0].CIM_refnum.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please enter PRN Refnum\n';
    }

    if (document.forms[0].partname.value.length == 0)
    {
         errmsg += 'Please enter Partname\n';
    }
    if (document.forms[0].partnum.value.length == 0)
    {
         errmsg += 'Please enter Partnum\n';
    }

    // alert(document.getElementById("page_name").value);

//    if (document.forms[0].wonum.value.length == 0)
//    {
//         errmsg += 'Please enter Wonum\n';
//    }
  //  if(document.getElementById("page_name").value =='edit_master_data')
  //  {
  // if (document.forms[0].crnstatus.value == "Inactive" && document.forms[0].crnremarks.value.length ==0)
  //   {
  //        errmsg += 'Please enter Remarks\n';
  //   }
  // }
    /* if (document.forms[0].crnremarks.value.length == 0)
    {
         errmsg += 'Please enter Remarks\n';
    } */
      var x=1;
      var max=document.forms[0].index.value;
      var seq_num=new Array();
      var seqlist = {};

    //alert('before4');
    while (x < max)
    {
        ln ="line_num"+x;
         //alert("??"+ document.forms[0].ln.value);
        lnv = document.getElementById(ln).value;
        
            mps_revision = "mps_revision" + x;
            control= "control"+ x;
            
          if ((document.getElementById(ln).value.length ==0)&& (document.getElementById(mps_revision).value =="")&&(document.getElementById(control).value ==""))
        {
          if(lnv+x ==0)
          {
          break;
          }
        }

        else if (seqlist[lnv] != undefined)
        {
            errmsg +='Duplicate Seq Number '+ lnv + '\n';

        }
        else
           {
           seqlist[lnv] = lnv;
           if ((document.getElementById(ln).value.length ==0 ) )
           {
                errmsg += 'Please enter Seq Number \n';
           }
            if  ((document.getElementById(mps_revision).value ==""))
             {
                errmsg += 'Please enter Mps Revision for Seq Number '  + lnv + '\n';
             }
              if (document.getElementById(control).value =="")
             {
                errmsg += 'Please enter Control(Machine Name) for Seq Number '  + lnv + '\n';
             }

           

     }
     x++
   }
     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}


function printmaster_data(masterdatarecnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printmaster_data.php?masterdatarecnum=" + masterdatarecnum, "PrintMaster_Data",

+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}
function GetDate(rt) {

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

	function SetDate(dateval,fieldname) {
	fn = document.getElementById(fieldname);
	fn.value = dateval;
}


function addRow(id,index){
var x=index;
var y=index;
line_num="line_num"+index;
mps_revision="mps_revision"+index;
control="control"+index;
remarks="remarks"+index;
rev_date="rev_date"+index;
rev_status="rev_status"+index;
//alert(qty_to_make);
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

prevlinenum = "prevlinenum" + index;
lirecnum = "lirecnum" + index;


var cell1 = document.createElement("TD");
cell1.setAttribute("align","center");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","6");
inp1.setAttribute("name",line_num);
inp1.setAttribute("id",line_num);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
cell2.setAttribute("align","center");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","10");
inp2.setAttribute("name",mps_revision);
inp2.setAttribute("id",mps_revision);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
cell3.setAttribute("align","center");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","12");
inp3.setAttribute("name",control);
inp3.setAttribute("id",control);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
cell4.setAttribute("align","center");
inp4.setAttribute("size","50");
inp4.setAttribute("name",remarks);
inp4.setAttribute("id",remarks);
cell4.appendChild(inp4);

//Date
var cell12 = document.createElement("TD");

var inp12 = document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","10");
inp12.setAttribute("name",rev_date);
inp12.setAttribute("id",rev_date);
inp12.setAttribute("readonly","readonly");
inp12.style.backgroundColor = "#DDDDDD";

var img1 = document.createElement("img");
img1.setAttribute("src","images/bu-getdateicon.gif");
img1.setAttribute("alt","GetDate");
img1.onclick = function(){GetDate(rev_date);};
cell12.appendChild(inp12);
cell12.appendChild(img1);
///////////////////////
var cell5 = document.createElement("TD");
var inp5 =  document.createElement("select");
//inp5.setAttribute("type","select");
inp5.options[0]=new Option("Active", "Active")
inp5.options[inp5.length]=new Option("Obsolete", "Obsolete")
cell5.setAttribute("align","center");
inp5.setAttribute("size","1");
inp5.setAttribute("name",rev_status);
inp5.setAttribute("id",rev_status);
cell5.appendChild(inp5);



row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell5);
row.appendChild(cell12);
row.appendChild(cell3);
row.appendChild(cell4);
tbody.appendChild(row);
x++;
//alert("i am here");
document.forms[0].index.value=x;
document.forms[0].curindex.value=x;

}

function onChangeTreat()
{
var treat=document.getElementById("treattype").value;
//alert(treat);
document.getElementById("treat").value=document.getElementById("treattype").value;

}

function toggleValue(divid,chk)
{
 //alert(chk+"---"+divid+"-**********"+document.getElementById(divid).value);
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
   document.getElementById('eng_app_by').value=document.getElementById('userid').value;
   document.getElementById('eng_app_date').value=DD;
  }
 }
 else
 {
   document.getElementById(divid).value="no";
   document.getElementById('eng_app_date').value="";
   if(divid == "eng_app")
 { //alert(divid+"------");
    document.getElementById('eng_app_by').value="";
 }
 }



}

function onSelectType(type)
{

	document.getElementById('type').value = type.value;

	//alert(status.value);

	//alert(document.getElementById('status').value);
     return true;
}


