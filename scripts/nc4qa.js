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


function addRow(id,index){
//alert(index)
var x=index;
linenum="linenum" +index;
tool_details="tool_details" +index;
tool_length="tool_length" +index;
speed="speed" +index;
feed="feed" +index;
opn_desc="opn_desc" +index;
cnc_pgm_name="cnc_pgm_name" +index;

//alert(qty);
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";


var cell1 = document.createElement("TD");

var inp1 = document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","15");
inp1.setAttribute("name",linenum);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 = document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","15");
inp2.setAttribute("name",tool_details);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","15");
inp3.setAttribute("name",tool_length);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","15");
inp4.setAttribute("name",speed);
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","15");
inp5.setAttribute("name",feed);
cell5.appendChild(inp5);

var cell6 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","15");
inp6.setAttribute("name",opn_desc);
cell6.appendChild(inp6);

var cell7 = document.createElement("TD");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","15");
inp7.setAttribute("name",cnc_pgm_name);
cell7.appendChild(inp7);

row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell6);
row.appendChild(cell7);
tbody.appendChild(row);
x++;
document.forms[0].index.value=x;
document.forms[0].curindex.value=x;
}

function addRow4edit(id,index){
var x=index;
prevlinenum="prevlinenum"+index;
lirecnum="lirecnum"+index;

sl_num="sl_num" +index;
drawing_dim="drawing_dim" +index;
measuring_istrument="measuring_istrument" +index;
samplesize="samplesize" +index;
remarks="remarks" +index;

var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.setAttribute("bgcolor","#FFFFFF");

var cell1 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","10");
inp1.setAttribute("name",sl_num);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","20");
inp2.setAttribute("name",drawing_dim);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","20");
inp3.setAttribute("name",measuring_istrument);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","20");
inp4.setAttribute("name",samplesize);
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","20");
inp5.setAttribute("name",remarks);
cell5.appendChild(inp5);

var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","hidden");
inp6.setAttribute("value","");
inp6.setAttribute("name",prevlinenum);

var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","hidden");
inp7.setAttribute("value","");
inp7.setAttribute("name",lirecnum);

row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(inp6);
row.appendChild(inp7);
tbody.appendChild(row);
x++;
document.forms[0].index.value=x;
document.forms[0].curindex.value=x;
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
function IsNumeric(strString)
   //  check for valid numeric strings
{
   var strValidChars = "0123456789.";
   var strChar;
   var blnResult = true;

   if (strString.length == 0) return false;

   //  test strString consists of valid characters listed above
   for (i = 0; i < strString.length && blnResult == true; i++)
      {
      strChar = strString.charAt(i);
      if (strValidChars.indexOf(strChar) == -1)
         {
         blnResult = false;
         }
      }
   return blnResult;
}

function check_req_fields()
{
	//alert ('function working');
	//return false;
    var errmsg = '';
     err_type = 0;
     cause = 0;
     stage = 0;
     disposition=0;
    // alert(document.forms[0].chk1.value)
    if (document.getElementById('wonum').value == '')
    {
       errmsg += 'Please enter WO No. \n';
    }
    // if (document.getElementById('bachnum').value == '')
    // {
       // errmsg += 'Please enter Batch No. \n';
    // }
    if (document.getElementById('qty').value == '')
    {
       errmsg += 'Please enter Qty.\n';
    }
    else
    {
         var chk = IsNumeric(document.getElementById('qty').value);
         if (!chk)
         {
             errmsg += "Qty should be numbers only .\n";
         }
    }
	 if(document.getElementById('sup_name').value == '')
     {
       errmsg += 'Please Select Supervisor Name.\n';
     }
    if(document.getElementById('op_name').value == '')
     {
       errmsg += 'Please Select Operator Name. \n';
     }

	  if(document.forms[0].sup_name.value == 'select')
     {
       errmsg += 'Please Select Supervisor Name.\n';
     }
    if(document.getElementById('op_name').value == 'select')
     {
       errmsg += 'Please Select Operator Name. \n';
     }  
	 
	  if(document.forms[0].created_by.value == 'select')
     {
       errmsg += 'Please Select Created By.\n';
     }


    if(document.getElementById('chk9').checked == true)
    {
     if(document.getElementById('cofcnum').value == '')
     {
       errmsg += 'Please enter C of C No. \n';
     }
     if(document.getElementById('cust_ncno').value == '')
     {
       errmsg += 'Please enter Cust NC#. \n';
     }
     if(document.getElementById('cust_ncdate').value == '')
     {
       errmsg += 'Please enter Cust NC Date. \n';
     }
   }

    if(document.getElementById('cofcnum').value.length != 0 && document.getElementById('chk9').checked == false)
    {
      errmsg += 'Please select CUSTOMER END. \n';
    }
	if (document.getElementById('status').value == '')
    {
       errmsg += 'Please select Status \n';
    }
	  if (document.getElementById('mc_name').value == 'select')
    {
       errmsg += 'Please Select Machine Name. \n';
    }
	document.getElementById('mc_name1').value=document.getElementById('mc_name').value;
		document.getElementById('op_name1').value=document.getElementById('op_name').value;
   /* if(document.forms[0].description.value=='')
    {
     errmsg += 'Please enter Brief Discription \n';
    }
    if(document.forms[0].root_cause.value=='')
    {
     errmsg += 'Please enter Root Cause \n';
    }

     if(document.getElementById('wotype').value == 'With Treatment' && document.getElementById('dnnum').value.length==0)
     {
       errmsg += 'Please Enter a valid DN number.\n';
     }
   */
   // alert('Here');
    for(i=1;i<=13;i++)
   {
    chk = "chk"+i;
    //alert(chk);
    if(i==1 || i==4 || i==7 )
    {
     if(document.getElementById(chk).checked == true)
     {
        err_type++;
     }
    }
    else if(i==2 || i==5 || i==8)
    {
     if(document.getElementById(chk).checked== true)
     {
        cause++;
     }
    }
    else if(i==3 || i==6 || i==9)
    {
      if(document.getElementById(chk).checked == true)
      {
        stage++;
      }
    }
    else if(i==10 || i==11 || i==12 || i==13)
    {
	  //alert("inside disp "+i);
      if(document.getElementById(chk).checked == true)
      {
		
        disposition++;
      }
    }
   }
  // alert(document.getElementById('department').value+"*-*-*--*-*-**-"+document.getElementById('chk3').checked);
/*
    if(document.getElementById('department').value == 'QA' && document.getElementById('chk3').checked == true)
   {
      errmsg += "Select Either Customer End or Final Inspection(Stage).\n";
   }
*/

    /*alert("err="+err_type);
    alert("cau="+cause);
    alert("stage="+stage);*/
 //if(document.getElementById('wo_status').value != 'Closed')
 //{
  if(parseInt(err_type) > 1)
    {
      errmsg += "Only one should be selected from ERROR TYPE .\n";
    }
    else if(parseInt(err_type) == 0)
    {
      errmsg += "Please Select an ERROR TYPE .\n";
    }
    if(parseInt(cause) > 1)
    {
      errmsg += "Only one should be selected from CAUSE .\n";
    }
    else if(parseInt(cause) == 0)
    {
      errmsg += "Please Select a CAUSE .\n";
    }
    if(parseInt(stage) > 1)
    {
      errmsg += "Only one should be selected from STAGE .\n";
    }
    else if(parseInt(stage) == 0)
    {
      errmsg += "Please Select a STAGE .\n";
    }
   if(parseInt(disposition) > 1)
    {
      errmsg += "Only one should be selected from DISPOSITION .\n";
    }
     else if(parseInt(disposition) == 0)
    {
      errmsg += "Please Select a DISPOSITION .\n";
    }
   //}
      //alert(document.getElementById('wo_status').value);
   /* if(document.getElementById('wo_status').value=='Closed' && (parseInt(err_type) != 0 || parseInt(cause) !=0))
    {
          errmsg += "Please Select (only) CUSTOMER END .\n";
    }
    else if(document.getElementById('wo_status').value == 'Closed' && document.getElementById('chk9').checked == false)
    {
      errmsg += "Please Select CUSTOMER END .\n";
    }*/  
	
  if (errmsg == '')
       return true;
    else
    {
       alert (errmsg);
       return false;
    }
}


function printnc4qa(nc4qarecnum) {

  
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printnc4qa.php?nc4qarecnum=" + nc4qarecnum, "printnc4qa",
+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}
function Getwo_qa() {

//alert('working');
var winWidth = 1000;
var winHeight = 300;
//alert(screen.width)
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
crn=document.getElementById('refnum').value;
stagenum=document.getElementById('stagenum').value;
//alert(crn+"1212121212");
if(crn=='')
{
   alert("Please Enter PRN  \n");
   return false;
}
if(stagenum=='')
{
  alert("Please Enter Stage number \n");
   return false;
}
else
{
   win1 = window.open("getwo4qa.php?crn="+crn,"aa", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}


}
function Setwo_qa(CIM,CIMarr,fieldname) {

//alert(document.forms[0].elements[fieldname + "recnum"]);
var CIM = CIM.split("|");
document.getElementById('wonum').value = CIM[0];
document.getElementById('refnum').value = CIM[1];
document.getElementById('customer').value = CIM[2];
document.getElementById('ponum').value = CIM[3];
document.getElementById('partnum').value = CIM[4];
document.getElementById('partname').value = CIM[5];
document.getElementById('bachnum').value = CIM[6];
document.getElementById('matl_spec').value = CIM[7];
document.getElementById('issues_ps').value = CIM[8];
document.getElementById('wo_status').value = CIM[10];
document.getElementById('wotype').value = CIM[9];
stagenum=document.getElementById('stagenum').value;
var refnum=document.getElementById('refnum').value
//alert(stagenum);
check_wo(CIM[0]);
getopnames(CIM[0],stagenum);
get_mcname(CIM[0],refnum,stagenum);
}


function toggleValue(divid,chk)
{
dept=document.getElementById('department').value;
//alert(dept+"---"+divid);
 if(chk.checked)
 {
  if(document.getElementById(divid).value == "yes")
  {
   document.getElementById(divid).value="no";
   if(dept=='Production' && divid=='cust_end')
   {    //alert("HERE999999999999999");
     document.forms[0].description.removeAttribute("readOnly","true");
     document.forms[0].description.style.backgroundColor = "#FFFFFF";

     document.forms[0].root_cause.removeAttribute("readOnly","true");
     document.forms[0].root_cause.style.backgroundColor = "#FFFFFF";

     document.forms[0].corrective_action.removeAttribute("readOnly","true");
     document.forms[0].corrective_action.style.backgroundColor = "#FFFFFF";

     document.forms[0].preventive_action.removeAttribute("readOnly","true");
     document.forms[0].preventive_action.style.backgroundColor = "#FFFFFF";

   }
   if(dept=='QA' && divid=='cust_end')
   {   // alert("HERE");

     //document.forms[0].description.removeAttribute("readOnly","true");
     //document.forms[0].description.style.backgroundColor = "#DDDDDD";

     document.forms[0].root_cause.setAttribute("readOnly","true");
     document.forms[0].root_cause.style.backgroundColor = "#DDDDDD";

     document.forms[0].corrective_action.setAttribute("readOnly","true");
     document.forms[0].corrective_action.style.backgroundColor = "#DDDDDD";

     document.forms[0].preventive_action.setAttribute("readOnly","true");
     document.forms[0].preventive_action.style.backgroundColor = "#DDDDDD";



   }
     
    chk.checked=false;

  }
  else
  {
   document.getElementById(divid).value="yes";
   if(dept=='Production' && divid=='cust_end')
   {   // alert("HERE");

     document.forms[0].description.setAttribute("readOnly","true");
     document.forms[0].description.style.backgroundColor = "#DDDDDD";
     
     document.forms[0].root_cause.setAttribute("readOnly","true");
     document.forms[0].root_cause.style.backgroundColor = "#DDDDDD";
     
     document.forms[0].corrective_action.setAttribute("readOnly","true");
     document.forms[0].corrective_action.style.backgroundColor = "#DDDDDD";
     
     document.forms[0].preventive_action.setAttribute("readOnly","true");
     document.forms[0].preventive_action.style.backgroundColor = "#DDDDDD";
     

   
   }
   if(dept=='QA' && divid=='cust_end')
   {    //alert("HEREqa");

     //document.forms[0].description.removeAttribute("readOnly","true");
     //document.forms[0].description.style.backgroundColor = "#DDDDDD";

     document.forms[0].root_cause.removeAttribute("readOnly","true");
     document.forms[0].root_cause.style.backgroundColor = "#FFFFFF";

     document.forms[0].corrective_action.removeAttribute("readOnly","true");
     document.forms[0].corrective_action.style.backgroundColor = "#FFFFFF";

     document.forms[0].preventive_action.removeAttribute("readOnly","true");
     document.forms[0].preventive_action.style.backgroundColor = "#FFFFFF";



   }
  }
 }
 else
 {
   document.getElementById(divid).value="no";
 }
//alert(document.getElementById(divid).value);
}

function Getcofc(rt) {
//alert(rt);
var param = rt;
var wo_num=document.getElementById('wonum').value;
var winWidth = 700;
var winHeight = 400;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getcofcs.php?wonum="+wo_num, param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function Setcofc(cofc,fieldname) {
   //alert(CIM);
    document.getElementById('cofcnum').value = cofc;
}

function onSelectsecretary()
{
    var sup = document.forms[0].sup_name1.selectedIndex;
    document.forms[0].sup_name.value = document.forms[0].sup_name1[sup].text;	
}

function onSelectOperator()
{
    var op = document.forms[0].op_name1.selectedIndex;
    document.forms[0].op_name.value = document.forms[0].op_name1[op].text;	
}
function onSelectStatus(status)
{
	
	document.getElementById('status').value = status.value;
 
	//alert(status.value);
     
	//alert(document.getElementById('status').value);
     return true;
}

function check_wo(wo_num)
{
  //alert(wo_num);
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
		                  //Something went wrong
		                  alert("Your browser broke!");
		                  return false;
		                 }
		          }
		      }

		      //Create a function that will receive data sent from the server
		      ajaxRequest.onreadystatechange = function()
		      {
		              if(ajaxRequest.readyState == 4)
		              {
		                if(ajaxRequest.status == 200)
		                   {
		                  //  alert(ajaxRequest.responseText);
		                      document.getElementById('nc_wocheck').innerHTML = ajaxRequest.responseText;
		                   }
		              }
		      }
		      ajaxRequest.open("POST", "wo_nc_check.php?wo_num="+wo_num,true);

		      ajaxRequest.send(null);
}

function getopnames(wo_num,stagenum)
{
 // alert(wo_num);
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
		                  //Something went wrong
		                  alert("Your browser broke!");
		                  return false;
		                 }
		          }
		      }

		      //Create a function that will receive data sent from the server
		      ajaxRequest.onreadystatechange = function()
		      {
		              if(ajaxRequest.readyState == 4)
		              {
		                if(ajaxRequest.status == 200)
		                   {
		                   // alert(ajaxRequest.responseText);
		                      document.getElementById('wo_opnames').innerHTML = ajaxRequest.responseText;
		                   }
		              }
		      }
		      ajaxRequest.open("POST", "wo_opnames.php?wo_num="+wo_num+"&stagenum="+stagenum,true);

		      ajaxRequest.send(null);
}

function get_mcname(wo_num,crn,stagenum)
{
 // alert(wo_num);
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
		                  //Something went wrong
		                  alert("Your browser broke!");
		                  return false;
		                 }
		          }
		      }

		      //Create a function that will receive data sent from the server
		      ajaxRequest.onreadystatechange = function()
		      {
		              if(ajaxRequest.readyState == 4)
		              {
		                if(ajaxRequest.status == 200)
		                   {	         
							//alert(ajaxRequest.responseText);
						
		                      document.getElementById('machine_name').innerHTML = ajaxRequest.responseText;
		                   }
		              }
		      }
		      ajaxRequest.open("POST", "get_mcname4nc.php?wo_num="+wo_num+"&stagenum="+stagenum+"&crn="+crn,true);

		      ajaxRequest.send(null);
}
function resetWO()
{
document.getElementById("wonum").value="";
document.getElementById("wotype").value="";
document.getElementById("customer").value="";
document.getElementById("ponum").value="";
document.getElementById("partnum").value="";
document.getElementById("partnum").value="";
document.getElementById("partname").value="";
document.getElementById("bachnum").value="";
document.getElementById("matl_spec").value="";
document.getElementById("issues_ps").value="";
}
