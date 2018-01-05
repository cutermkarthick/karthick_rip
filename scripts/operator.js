/*
 * operator.js
 * validation for operator
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
*/

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

function SetDate(dateval,fieldname) 
{
var today = new Date();
//alert(today);
year=today.getFullYear();
month=today.getMonth()+1;

var date=today.getDate();
if(date >0 && date<10)
{
var thisday='0'+date;
}
else
{
var thisday=date;
}

if(month >0 && month<10)
{
var thismonth='0'+month;
}
else
{
var thismonth=month;
}
//alert(thismonth+"today mon");
todaysdate=String(year)+String(thismonth)+String(thisday);


//inputdate=dateval.replace(/-/g,'');
var date1=dateval.split('-');
//alert(date1[2]+"****************"+date1[2]);
if(date1[2] >0 && date1[2]<10)
{
var inpday='0'+date1[2];
}
else
{
var inpday=date1[2];
}

inpyear=date1[0];
inpmonth=date1[1];
date1=new Date(date1[0],date1[1],inpday);
//alert(inpmonth+"----------------------");
inputdate=String(inpyear)+String(inpmonth)+String(inpday);
//alert(inputdate+"------"+todaysdate);
if(parseInt(inputdate)>parseInt(todaysdate))
{
alert('Date cannot be in the future');
//document.forms[1].elements['st_date'].value = "";
return false;
}
if(fieldname == 'st_date')
{
 document.forms[1].elements[fieldname].value = dateval;
 document.getElementById('crn').value = "";
 document.getElementById('wo_num').value = "";
}
else if(fieldname == '')
{
 document.forms[0].st_date.value = dateval;
 document.getElementById('crn').value = "";
 document.getElementById('wo_num').value = "";
}
else
{
document.forms[0].elements[fieldname].value = dateval;
}
}
function searchsort_fields()
{


    var s1ind = document.forms[0].oper_oper.selectedIndex;
    var s2ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].quotecritval.value = document.forms[0].quotecrit[ind].text;
    document.forms[0].quoteoperval.value = document.forms[0].quote_oper[s1ind].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s2ind].text;
}

function Getwo_crn4new(rt) {
var param = rt;
var operator = document.getElementById('oper_name').value;
//alert(operator);
var mcname = document.getElementById('mc_name').value;
//alert(mcname);
var entdate = document.getElementById('st_date').value;
var entshift = document.getElementById('shift').value;
//alert(date);
var winWidth = 600;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var url = "getwo_crn4prodn.php?mcname=" + mcname + "&entdate=" + entdate + "&shift=" + entshift+ "&operator=" + operator;
//alert(url);
win1 = window.open(url,param,
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}


function Getwo_crn(rt) {
//alert(rt);
var param = rt;
var winWidth = 600;
var winHeight = 300;
var operator = document.forms[0].oper_name.value;
//alert(operator);
var mcname = document.forms[0].mc_name.value;
//alert(mcname);
var entdate = document.forms[0].st_date1.value;
//alert(entdate);
var entshift = document.forms[0].shift.value;
//alert(entshift);

var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var url = "getwo4prodn.php?mcname=" + mcname + "&entdate=" + entdate + "&shift=" + entshift+ "&operator=" + operator;

win1 = window.open(url,param,+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function Setwo_crn(CIM,fieldname,oper_flag,total_prev_mins) {
//alert(document.forms[0].elements[fieldname + "recnum"]);
var CIM = CIM.split("|");
// alert(CIM);
document.getElementById('total_prev_mins').value=total_prev_mins;
// alert(CIM[5]);
if(CIM[5] == '')

{
	alert('WO: '+CIM[0]+' is not approved for production \n');
  
    document.forms[1].wo_num.value = "";
	return false;


}
if(fieldname == 'wo_num')
 {
   if(document.getElementById('st_date').value.length == 0)
   {
    alert('Please enter the Date before selecting WO#');
    document.forms[1].elements[fieldname].value = "";
    document.forms[1].crn.value = "";
    document.forms[1].wo_qty.value = "";
   }
  
   else if(oper_flag == 0)
   {	 
    //document.forms[1].elements[fieldname].value = CIM[0];
     document.getElementById('wo_num').value = CIM[0];
    document.getElementById('crn').value = CIM[1];
    document.getElementById('wo_qty').value = CIM[4];   
   }
   else
   {
    alert('Previous entry for selected machine is not equal to 8 hours.Please correct it and continue');
    document.forms[1].elements[fieldname].value = "";
    document.getElementById('crn').value = "";
    document.getElementById('wo_qty').value = "";
   }
}
else
 {  
   document.forms[0].elements[fieldname].value = CIM[0];
   document.getElementById('crn').value = CIM[1];
   document.getElementById('wo_qty').value = CIM[4];  
   document.getElementById('wo_num').value = CIM[0]; 

   //alert(document.forms[0].wo_qty.value);
 } 
}

function getWO()
{
 //alert('Please Select WO#');
 document.getElementById('crn').value ="";
 document.getElementById('wo_num').value = "";
}
function getoperName() {
//alert('666');
//alert(document.getElementById('oper_no')[opindex].text;);
var opindex =  document.getElementById('oper_no').selectedIndex;
operText=document.getElementById('oper_no')[opindex].value;
var operName = operText.split("|");
document.getElementById('oper_name').value = operName[0];

}

function getNext(x) 
{
//alert(x);
document.getElementById(x).onclick();
if(document.getElementById('wo_num').value.length != 0)
{
document.getElementById('wo_num').value="";
}
}

function getsetting_time(x)
{
document.getElementById(x).focus();
}

function getchangewo()
{
if(document.getElementById('wo_num').value.length != 0)
{
document.getElementById('wo_num').value="";
document.getElementById('crn').value="";
}
}

function getchangewo4crn()
{
if(document.getElementById('crn').value.length != 0)
{
document.getElementById('wo_num').value="";
}
}

function getNextfield(x,y) {
if(document.getElementById(x).value.length==2)
{
  document.getElementById(y).focus();
}
}

function Getwo_crnprodn(rt)
{
 //alert('iii');
if(document.getElementById('crn').value == '' )
{
      alert ('Please Enter PRN Before Selecting WO#\n');
      return false;
}
var param = rt;
var crn=document.getElementById('crn').value;
var mcname = document.getElementById('mc_name').value;
//alert(mcname);
var entdate = document.getElementById('st_date').value;
var entshift = document.getElementById('shift').value;
//alert(date);
var winWidth = 1000;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var url = "getwo4prodn.php?mcname=" + mcname + "&entdate=" + entdate + "&shift=" + entshift+ "&crn=" + crn;

win1 = window.open(url,param,
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function check_req_fields()
{
    var errmsg = '';
    var opindex =  document.getElementById('oper_no').selectedIndex;
     operText=document.getElementById('oper_no')[opindex].value;
     var wo_qty = parseFloat(document.getElementById('wo_qty').value);
     total_mins = 0;
   // var qty_validation = 0;
    //var qty = parseInt(document.getElementById(disp_qty).value);
    
        if (document.getElementById('oper_no')[opindex].text == "please select")
        {
    //alert ('function working inside');
         errmsg += 'Please select Operator No. \n';
        }
        
         if (document.getElementById('st_date').value.length == 0)
        {
         errmsg += 'Please enter Date\n';
        }
        
        if (document.getElementById('wo_num').value.length == 0)
        {
         errmsg += 'Please enter WO#\n';
        }
        
        if (document.getElementById('crn').value.length == 0)
        {
    //alert ('function working inside');
         errmsg += 'Please enter PRN \n';
        }


        if (document.getElementById('shift').value.length == 0)
        {
         errmsg += 'Please enter shift\n';
        }        
        if(document.getElementById('setting_time').value == '0' && document.getElementById('running_time').value == '0' && 
			document.getElementById('setting_time_mins').value == '0' && document.getElementById('running_time_mins').value == '0')
        {
         errmsg += 'Please enter Either Setting Time Or Running Time\n';
        }   
        

       if(document.getElementById('setting_time').value.length == 0)
       {
         var settingtime  = 0;
       }
      else
      {
        var settingtime = parseInt(document.getElementById('setting_time').value);
      }
      //alert('settingtime--' + settingtime);
       if(document.getElementById('setting_time_mins').value.length == 0)
       {
         var settingtimemins = 0;
       }
       else
       {
         var settingtimemins = parseInt(document.getElementById('setting_time_mins').value);
       }
      //alert('settingmins--' + settingtimemins);
      if(document.getElementById('running_time').value.length == 0)
       {
         var runningtime = 0;
       }
       else
       {
         var runningtime = parseInt(document.getElementById('running_time').value);
       }
     //var runningtime = parseInt(document.getElementById(running_time).value);
      //alert('runningtime--' + runningtime);
       if(document.getElementById('running_time_mins').value.length == 0)
       {
         var runningtimemins = 0;
       }
       else
       {
         var runningtimemins = parseInt(document.getElementById('running_time_mins').value);
       }
      //alert('runningtimemins--' + runningtimemins);
      if(document.getElementById('idle_time').value.length == 0)
       {
        var idletime = 0;
       }
       else
       {
        var idletime = parseInt(document.getElementById('idle_time').value);
       }

      //alert('idle--' + idletime);
       if(document.getElementById('idle_time_mins').value.length == 0)
       {
        var idletimemins = 0;
       }
       else
       {
        var idletimemins = parseInt(document.getElementById('idle_time_mins').value);
       }
      //alert('idletimemins--' + idletimemins);

	  if(document.getElementById('breakdown_time').value.length == 0)
       {
        var breakdown_time = 0;
       }
       else
       {
        var breakdown_time = parseInt(document.getElementById('breakdown_time').value);
       }

      //alert('idle--' + idletime);
       if(document.getElementById('breakdown_time_mins').value.length == 0)
       {
        var breakdowntimemins = 0;
       }
       else
       {
        var breakdowntimemins = parseInt(document.getElementById('breakdown_time_mins').value);
       }

     var total_cur_mins = ((settingtime * 60) + settingtimemins + (runningtime * 60) + runningtimemins + (idletime * 60) + idletimemins+ (breakdown_time * 60) + breakdowntimemins);		
	 var total_prev_mins = (document.getElementById('total_prev_mins').value == '')?'0':parseInt(document.getElementById('total_prev_mins').value);
	 var total=total_cur_mins + total_prev_mins;
     //alert('Cur===='+total_cur_mins);
	// alert('Prev===='+total_prev_mins);
	 //alert('total===='+total);
    if(total > 480)
    {
         errmsg += 'Total Hours should not exceed 8 hours per shift\n';
    }
     var idle_flag = 0;

     if(document.getElementById('idle_time').value.length != 0 && document.getElementById('idle_time').value != '0')
     {
       idle_flag = 1;
     }
     if(document.getElementById('idle_time_mins').value.length != 0 && document.getElementById('idle_time_mins').value != '0')
     {check_req_fields
       idle_flag = 1;
     }

     if(idle_flag != 0 && document.getElementById('remarks').value.length == 0)
     {
       //alert(document.getElementById(remarks).value);
       errmsg += 'Please enter Remarks \n';
     }
        
        var quantity = parseFloat(document.getElementById('qty').value);
       if(quantity > wo_qty )
       {
         errmsg += 'Qty.Produced should not be greater than WO Qty \n';
       }
     qty_acc = (document.getElementById('qty_acc').value == '')?0:parseFloat(document.getElementById('qty_acc').value);
	 qty_rej = (document.getElementById('qty_rej').value == '')?0:parseFloat(document.getElementById('qty_rej').value);
     qty_rew = (document.getElementById('qty_rew').value == '')?0:parseFloat(document.getElementById('qty_rew').value);

      

       var totalqty=qty_acc+qty_rew+qty_rej;
	   
	   if(totalqty < quantity || totalqty > quantity)
	   {
		  errmsg += 'Sum Of Qty Acc,Qty Rew,Qty Rej Should be Equal to Qty Produced \n';
	   }
	   if(document.getElementById('qty_acc').value == '' && document.getElementById('qty_rew').value == '' && 
		   document.getElementById('qty_rej').value == '')
	   {
		 errmsg += 'Please Enter Either Qty Accepted Or Qty Rejected Or Qty Rework\n';
	   }
	   if(document.getElementById('qty').value  == '')
	  {
		 errmsg += 'Please Enter Data For QTY Produced \n';
	  }
	   
     
   if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}

function edit_check_req_fields()
{
    var errmsg = '';
    
     var wo_qty = parseFloat(document.getElementById('wo_qty').value);
     total_mins = 0;
     //alert(document.getElementById('approval_flag').value);
     // var qty_validation = 0;
     //var qty = parseInt(document.getElementById(disp_qty).value);
             
        if (document.getElementById('approval_flag').value == '1')
        {
           errmsg += 'WO: '+document.getElementById('wo_num').value+' is not approved for production \n';
        }  
              
        if (document.getElementById('st_date').value.length == 0)
        {
         errmsg += 'Please enter Date\n';
        }
        
        if (document.getElementById('wo_num').value.length == 0)
        {
         errmsg += 'Please enter WO#\n';
        }
        
        if (document.getElementById('crn').value.length == 0)
        {
    //alert ('function working inside');
         errmsg += 'Please enter PRN \n';
        }


        if (document.getElementById('shift').value.length == 0)
        {
         errmsg += 'Please enter shift\n';
        }        
        if(document.getElementById('setting_time').value == '0' && document.getElementById('running_time').value == '0' && 
			document.getElementById('setting_time_mins').value == '0' && documentgetElementById('running_time_mins').value == '0')
        {
         errmsg += 'Please enter Either Setting Time Or Running Time\n';
        }   
        

       if(document.getElementById('setting_time').value.length == 0)
       {
         var settingtime  = 0;
       }
      else
      {
        var settingtime = parseInt(document.getElementById('setting_time').value);
      }
      //alert('settingtime--' + settingtime);
       if(document.getElementById('setting_time_mins').value.length == 0)
       {
         var settingtimemins = 0;
       }
       else
       {
         var settingtimemins = parseInt(document.getElementById('setting_time_mins').value);
       }
      //alert('settingmins--' + settingtimemins);
      if(document.getElementById('running_time').value.length == 0)
       {
         var runningtime = 0;
       }
       else
       {
         var runningtime = parseInt(document.getElementById('running_time').value);
       }
     //var runningtime = parseInt(document.getElementById(running_time).value);
      //alert('runningtime--' + runningtime);
       if(document.getElementById('running_time_mins').value.length == 0)
       {
         var runningtimemins = 0;
       }
       else
       {
         var runningtimemins = parseInt(document.getElementById('running_time_mins').value);
       }
      //alert('runningtimemins--' + runningtimemins);
      if(document.getElementById('idle_time').value.length == 0)
       {
        var idletime = 0;
       }
       else
       {
        var idletime = parseInt(document.getElementById('idle_time').value);
       }

      //alert('idle--' + idletime);
       if(document.getElementById('idle_time_mins').value.length == 0)
       {
        var idletimemins = 0;
       }
       else
       {
        var idletimemins = parseInt(document.getElementById('idle_time_mins').value);
       }
      //alert('idletimemins--' + idletimemins);

	  if(document.getElementById('breakdown_time').value.length == 0)
       {
        var breakdown_time = 0;
       }
       else
       {
        var breakdown_time = parseInt(document.getElementById('breakdown_time').value);
       }

      //alert('idle--' + idletime);
       if(document.getElementById('breakdown_time_mins').value.length == 0)
       {
        var breakdowntimemins = 0;
       }
       else
       {
        var breakdowntimemins = parseInt(document.getElementById('breakdown_time_mins').value);
       }

     var total_cur_mins = ((settingtime * 60) + settingtimemins + (runningtime * 60) + runningtimemins + (idletime * 60) + idletimemins+ (breakdown_time * 60) + breakdowntimemins);		
	 var total_prev_mins = (document.getElementById('total_prev_mins').value == '')?'0':parseInt(document.getElementById('total_prev_mins').value);
	 var total=total_cur_mins + total_prev_mins;
    // alert('Cur===='+total_cur_mins);
	// alert('Prev===='+total_prev_mins);
	// alert('total===='+total);
    if(total > 480)
    {
         errmsg += 'Total Hours should not exceed 8 hours per shift\n';
    }
     var idle_flag = 0;

     if(document.getElementById('idle_time').value.length != 0 && document.getElementById('idle_time').value != '0')
     {
       idle_flag = 1;
     }
     if(document.getElementById('idle_time_mins').value.length != 0 && document.getElementById('idle_time_mins').value != '0')
     {
       idle_flag = 1;
     }

     if(idle_flag != 0 && document.forms[0].remarks.value.length == 0)
     {
       //alert(document.getElementById(remarks).value);
       errmsg += 'Please enter Remarks \n';
     }
        
        var quantity = parseFloat(document.getElementById('qty').value);
       if(quantity > wo_qty )
       {
         errmsg += 'Qty.Produced should not be greater than WO Qty \n';
       }
     qty_acc = (document.getElementById('qty_acc').value == '')?0:parseFloat(document.getElementById('qty_acc').value);
	 qty_rej = (document.getElementById('qty_rej').value == '')?0:parseFloat(document.getElementById('qty_rej').value);
     qty_rew = (document.getElementById('qty_rew').value == '')?0:parseFloat(document.getElementById('qty_rew').value);

      

       var totalqty=qty_acc+qty_rew+qty_rej;
	   
	   if(totalqty < quantity || totalqty > quantity)
	   {
		  errmsg += 'Sum Of Qty Acc,Qty Rew,Qty Rej Should be Equal to Qty Produced \n';
	   }
	   if(document.getElementById('qty_acc').value == '' && document.getElementById('qty_rew').value == '' && 
		   document.getElementById('qty_rej').value == '')
	   {
		 errmsg += 'Please Enter Either Qty Accepted Or Qty Rejected Or Qty Rework\n';
	   }
	   if(document.getElementById('qty').value  == '')
	  {
		 errmsg += 'Please Enter Data For QTY Produced \n';
	  }
	   
     
   if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}
