
function check_req_fields()
{
    var errmsg = '';
    var opindex =  document.getElementById('oper_no').selectedIndex;
    operText=document.getElementById('oper_no')[opindex].value;
    var wo_qty = parseFloat(document.forms[0].wo_qty.value);
    total_mins = 0;
    //var qty_validation = 0;
    //var qty = parseInt(document.getElementById(disp_qty).value);

        if (document.getElementById('oper_no')[opindex].text == "please select")
        {
    //alert ('function working inside');
         errmsg += 'Please select Operator No. \n';
        }

         if (document.forms[0].st_date.value.length == 0)
        {
         errmsg += 'Please enter Date\n';
        }

        if (document.forms[0].wo_num.value.length == 0)
        {
         errmsg += 'Please enter WO#\n';
        }

        if (document.forms[0].crn.value.length == 0)
        {
    //alert ('function working inside');
         errmsg += 'Please enter crn \n';
        }


        if (document.forms[0].shift.value.length == 0)
        {
         errmsg += 'Please enter shift\n';
        }
/*       if(document.forms[0].setting_time.value == '0' && document.forms[0].running_time.value == '0' &&
			document.forms[0].setting_time_mins.value == '0' && document.forms[0].running_time_mins.value == '0' &&
			document.forms[0].setting_time_mins.value == '0' && document.forms[0].running_time_mins.value == '0' &&
			document.forms[0].setting_time_mins.value == '0' && document.forms[0].running_time_mins.value == '0')
        {
         errmsg += 'Please enter Either Setting Time Or Running Time\n';
        } */
        if(document.getElementById('setting_time').value == '0' && document.getElementById('running_time').value == '0' && document.getElementById('idle_time').value == '0' &&
			document.getElementById('setting_time_mins').value == '0' && document.getElementById('running_time_mins').value == '0' && document.getElementById('idle_time_mins').value == '0')
        {
         errmsg += 'Please enter Either Setting Time Or Running Time Or Idle Time\n';
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
	//alert('Prev===='+total_prev_mins);
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
 	if((parseInt(document.getElementById('qty_rej').value )!= 0 && (document.getElementById('qty_rej').value )!= '') && document.getElementById('brief_desc').value == 0)
   {
        errmsg += 'Please Enter Brief Discription For Non Conformance \n';
   }

   if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}


function toggle_visibility(){
if((parseInt(document.getElementById('qty_rej').value )!= 0 )&& ((document.getElementById('qty_rej').value )!= ''))
{
document.getElementById('description').style.display='block';
}
else{
document.getElementById('description').style.display='none';
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

if(document.forms[0].crn.value == '' )
{
      alert ('Please Enter CRN Before Selecting WO#\n');
      return false;
}
var param = rt;
var crn=document.forms[0].crn.value;
var mcname = document.forms[0].mc_name.value;
//alert(mcname);
var entdate = document.forms[0].st_date.value;
var entshift = document.forms[0].shift.value;
//alert(date);
var winWidth = 600;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var url = "getwo_prodn.php?mcname=" + mcname + "&entdate=" + entdate + "&shift=" + entshift+ "&crn=" + crn;

win1 = window.open(url,param,
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function getNext(x)
{
//alert(x);
document.getElementById(x).onclick();
if(document.forms[0].wo_num.value.length != 0)
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
if(document.forms[0].wo_num.value.length != 0)
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

function Getwo_crn(rt) {
//alert(rt);
var param = rt;
var winWidth = 600;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getwo_prodn.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function Setwo_crn(CIM,fieldname,oper_flag,total_prev_mins)
{
var CIM = CIM.split("|");
document.getElementById('total_prev_mins').value=total_prev_mins;
if(CIM[10] == '')
{
  alert('WO: '+CIM[0]+' is not approved for production \n');
  document.forms[0].wo_num.value = "";
  return false;

}
if(fieldname == 'wo_num')
 {
   if(document.forms[0].st_date.value.length == 0)
   {
    alert('Please enter the Date before selecting WO#');
    document.forms[0].elements[fieldname].value = "";
    document.forms[0].crn.value = "";
    document.forms[0].wo_qty.value = "";
   }
   else if(oper_flag == 0)
   {
    document.forms[0].elements[fieldname].value = CIM[0];
    document.forms[0].crn.value = CIM[1];
    document.forms[0].wo_qty.value = CIM[4];
   //alert(document.forms[1].wo_qty.value);
   }
   else
   {
    alert('Previous entry for selected machine is not equal to 8 hours.Please correct it and continue');
    document.forms[0].elements[fieldname].value = "";
    document.forms[0].crn.value = "";
    document.forms[0].wo_qty.value = "";
  }
 }
else
 {
   //alert('edit');
   document.forms[0].elements[fieldname].value = CIM[0];
   document.forms[0].crn.value = CIM[1];
   document.forms[0].wo_qty.value = CIM[4];
   //alert(document.forms[0].wo_qty.value);
  /* document.getElementById('refnum').value = CIM[1]; */

 }
document.getElementById('customer').value = CIM[6];
document.getElementById('ponum').value = CIM[5];
document.getElementById('partnum').value = CIM[3];
document.getElementById('partname').value = CIM[2];
document.getElementById('bachnum').value = CIM[7];
document.getElementById('rm_spec').value = CIM[8];
document.getElementById('attachments').value = CIM[9];
}
function onSelectStatus()
{
   var aind = document.forms[0].active.selectedIndex;
   document.forms[0].status.value = document.forms[0].active[aind].text;
   //document.forms[0].activeval.value = document.forms[0].active[aind].text;

}

function Getoper(rt) {
//alert(rt);
var param = rt;
var winWidth = 300;
var winHeight = 200;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getoper_name.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetOp(CIM,fieldname)
{
 var CIM = CIM.split("|");
 document.forms[0].oper_no.value = CIM[0];
 document.forms[0].oper_name.value = CIM[1];
}

function getoperName() {
//alert('666');
//alert(document.getElementById('oper_no')[opindex].text;);
var opindex =  document.getElementById('oper_no').selectedIndex;
operText=document.getElementById('oper_no')[opindex].value;
var operName = operText.split("|");
document.getElementById('oper_name').value = operName[0];

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
if(fieldname == 'st_date')
{

var today = new Date();
//alert(today);
var year  = today.getFullYear();
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

var date1=dateval.split('-');
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
inputdate=String(inpyear)+String(inpmonth)+String(inpday);

if(parseInt(inputdate)>parseInt(todaysdate))
{
alert('Date cannot be in the future');
return false;
}
 document.forms[0].elements[fieldname].value = dateval;
 document.getElementById('wo_num').value = "";
}
}
