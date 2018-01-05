/*
 * qualityplan.js
 * validation for qualityplan
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
*/

function ConfirmDelete() {
     document.forms[0].deleteflag.value = "y";
     return true;
}

function checkValue(qty,advqty,element) {
   // alert('hi');
   //  alert(qty)
   //  alert(advqty)

     if(advqty > qty)
     {
       alert('Adv lic Qty is greater than qty')
       element.value=''
       element.focus()
     }
     else
     {
       return true;
     }
}
function chkInvDate(date1,date2)
{
   alert('hi')
    alert(date1)
    alert(date2)

}


function addRow(id,index,mtllink,deldate,ms){
//alert(id);
//alert(index);
//alert(mtllink);
//alert(deldate);

ms1 = document.getElementById(ms);
ms2 = ms1.value;
//alert(ms2);
var x=index;
var link = mtllink;
//alert(mtllink);

if(ms2 ==1)
{
invnum="invnum" +index;
invdate="invdate" +index;
invqty="invqty" +index;
supdel_date="supdel_date" +index;
paydue_date="paydue_date" +index;
partnum="partnum" +index;
payexp_date="payexp_date" +index;
pick_date="pick_date" +index;
sail_date="sail_date" +index;
eda="eda" +index;
aad="aad" +index;
expclr_date="expclr_date" +index;
cfdel_date="cfdel_date" +index;
link2mtltracker="link2mtltracker" +index;
packnum = 'packnum' + index;
bill_lading_num ='bill_lading_num' + index;
bil_lading_date ='bil_lading_date' + index;
docket_num ='docket_num' + index;
boe_num ='boe_num' + index;


//alert(qty);
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");
var inp13 =  document.createElement("INPUT");
inp13.setAttribute("type","hidden");
inp13.setAttribute("size","7");
inp13.setAttribute("name",partnum);
inp13.setAttribute("id",partnum);
cell1.appendChild(inp13);

var cell2 = document.createElement("TD");
var inp14 =  document.createElement("INPUT");
inp14.setAttribute("type","hidden");
inp14.setAttribute("size","7");
inp14.setAttribute("name",link2mtltracker);
inp14.setAttribute("id",link2mtltracker);
inp14.setAttribute("value",mtllink);
cell2.appendChild(inp14);
//alert(link2mtltracker);

var cell3 = document.createElement("TD");

var cell4 = document.createElement("TD");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","4");
inp1.setAttribute("name",invnum);
//inp1.onfocus = function(){alert(invnum);};
cell4.appendChild(inp1);

var cell5 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","8");
inp2.setAttribute("name",invdate);
inp2.setAttribute("id",invdate);
inp2.onfocus = function(){fPopCalendar1(invdate,invdate);};
cell5.appendChild(inp2);

var cell6 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","3");
inp3.setAttribute("name",invqty);
cell6.appendChild(inp3);

var cell7 = document.createElement("TD");
var inp4 =  document.createElement("hidden");
inp4.setAttribute("type","text");
inp4.setAttribute("size","8");
inp4.setAttribute("name",supdel_date);
inp4.setAttribute("value",deldate);
inp4.setAttribute("IsReadOnly","true");
inp4.setAttribute("id",supdel_date);
//inp4.onfocus = function(){fPopCalendar1(supdel_date,supdel_date);};
cell7.appendChild(inp4);

var cell8 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","8");
inp5.setAttribute("name",paydue_date);
inp5.setAttribute("id",paydue_date);
inp5.onfocus = function(){fPopCalendar1(paydue_date,paydue_date);};
cell8.appendChild(inp5);

var cell9 = document.createElement("TD");

var cell10 = document.createElement("TD");
/*
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","7");
inp6.setAttribute("name",payexp_date);
inp6.setAttribute("id",payexp_date);
inp6.onfocus = function(){fPopCalendar1(payexp_date,payexp_date);};
cell10.appendChild(inp6);        */

var cell11 = document.createElement("TD");
/*
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","7");
inp7.setAttribute("name",pick_date);
inp7.setAttribute("id",pick_date);
inp7.onfocus = function(){fPopCalendar1(pick_date,pick_date);};
cell11.appendChild(inp7);     */

var cell12 = document.createElement("TD");
/*
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","7");
inp8.setAttribute("name",sail_date);
inp8.setAttribute("id",sail_date);
inp8.onfocus = function(){fPopCalendar1(sail_date,sail_date);};
cell12.appendChild(inp8);     */

var cell13 = document.createElement("TD");
/*
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","7");
inp9.setAttribute("name",eda);
inp9.setAttribute("id",eda);
inp9.onfocus = function(){fPopCalendar1(eda,eda);};
cell13.appendChild(inp9);       */

var cell14 = document.createElement("TD");
/*
var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","7");
inp10.setAttribute("name",aad);
inp10.setAttribute("id",aad);
inp10.onfocus = function(){fPopCalendar1(aad,aad);};
cell14.appendChild(inp10); */

var cell15 = document.createElement("TD");
/*
var inp11 =  document.createElement("INPUT");
inp11.setAttribute("type","text");
inp11.setAttribute("size","7");
inp11.setAttribute("name",expclr_date);
inp11.setAttribute("id",expclr_date);
inp11.onfocus = function(){fPopCalendar1(expclr_date,expclr_date);};
cell15.appendChild(inp11);   */

var cell16 = document.createElement("TD");
/*
var inp12 =  document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","7");
inp12.setAttribute("name",cfdel_date);
inp12.setAttribute("id",cfdel_date);
inp12.onfocus = function(){fPopCalendar1(cfdel_date,cfdel_date);};
cell16.appendChild(inp12);  */




/*
var cell10 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","7");
inp6.setAttribute("name",payexp_date);
cell10.appendChild(inp6);

var cell11 = document.createElement("TD");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","7");
inp7.setAttribute("name",pick_date);
cell11.appendChild(inp7);

var cell12 = document.createElement("TD");
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","7");
inp8.setAttribute("name",sail_date);
cell12.appendChild(inp8);

var cell13 = document.createElement("TD");
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","7");
inp9.setAttribute("name",eda);
cell13.appendChild(inp9);

var cell14 = document.createElement("TD");
var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","7");
inp10.setAttribute("name",aad);
cell14.appendChild(inp10);

var cell15 = document.createElement("TD");
var inp11 =  document.createElement("INPUT");
inp11.setAttribute("type","text");
inp11.setAttribute("size","7");
inp11.setAttribute("name",expclr_date);
cell15.appendChild(inp11);

var cell16 = document.createElement("TD");
var inp10 =  document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","7");
inp12.setAttribute("name",cfdel_date);
cell16.appendChild(inp12);   */


var cell17 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","8");
inp6.setAttribute("name",packnum);
inp6.setAttribute("id",packnum);
//inp6.onfocus = function(){fPopCalendar1(packnum,packnum);};
cell17.appendChild(inp6);

var cell18 = document.createElement("TD");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","8");
inp7.setAttribute("name",bill_lading_num);
inp7.setAttribute("id",bill_lading_num);
//inp7.onfocus = function(){fPopCalendar1(bill_lading_num,bill_lading_num);};
cell18.appendChild(inp7);

var cell19 = document.createElement("TD");
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","8");
inp8.setAttribute("name",bil_lading_date);
inp8.setAttribute("id",bil_lading_date);
inp8.onfocus = function(){fPopCalendar1(bil_lading_date,bil_lading_date);};
cell19.appendChild(inp8);

var cell20 = document.createElement("TD");
var cell21 = document.createElement("TD");

row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell7);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell6);
row.appendChild(cell17);
row.appendChild(cell18);
row.appendChild(cell19);
row.appendChild(cell8);
row.appendChild(cell9);
row.appendChild(cell10);
row.appendChild(cell11);
row.appendChild(cell12);
row.appendChild(cell13);
row.appendChild(cell14);
row.appendChild(cell15);
row.appendChild(cell16);
row.appendChild(cell20);
row.appendChild(cell21)
tbody.appendChild(row);
x++;
document.forms[0].index.value=x;

document.getElementById(ms).value=0;
//alert( document.getElementById(ms).value);
}
else
{
  alert('Please submit current row before adding another row');
}
}
function toggleValue_dir(divid,chk,val)
{
 if(chk.checked)
 {
	  if(document.getElementById(val).value == '0000-00-00' || document.getElementById(val).value == '' )
	  {
		  if(divid.charAt( divid.length-2 ) == '1')
		  {
		        alert("Due1 Date should be entered");
				var id=divid.slice(-2);
				document.getElementById('cim_due'+id).checked=false;
		  }
		  else
		  {
			    alert("Due2 Date should be entered");
			  	var id=divid.slice(-2);
				document.getElementById('cim_due'+id).checked=false;
		  }
		  return false;
	  }
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
	    document.getElementById('dir_approval').value="no";   
}


function GetDate(rt) 
{
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
function check_req_fields1()
{
	//alert ('function working');
	//return false;
    var errmsg = '';
    if (document.forms[0].opnrefnum.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please enter Opn ref No. \n';
    }

    if (document.forms[0].drgissue.value.length == 0)
    {
         errmsg += 'Please enter drgissue\n';
    }
    if (document.forms[0].workcentre.value.length == 0)
    {
         errmsg += 'Please enter Workcentre\n';
    }



     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}


function displayActivityLog(ponum) {
var winWidth = 650;
var winHeight = 550;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("mtl_act_log.php?ponum="+ponum, "Shipment", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}

function printmtltrk(mtltrkrecnum) {

//alert('hi');
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printmtltrk.php?mtltrkrecnum=" + mtltrkrecnum, "printmtltrk",
+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}

function printmtltrkrow(mtltrkrecnum, lirecnum) {

//alert('hi'+lirecnum);
var winWidth = 810;
var winHeight = 400;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printmtltrkrow.php?mtltrkrecnum=" + mtltrkrecnum +"&lirecnum="+lirecnum, "printmtltrk",
+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}
function check_req_fields()
{
    var index=document.getElementById('index').value;
	var errmsg = '';var status_flag=0;
    var i=1,duedate,duedate1,duedate2,accepted_date,inv_flag=0;
    while(i< index)
	{
		linenum=document.getElementById('linenum'+i).value;
		duedate=document.getElementById('due_date'+i).value;
		duedate1=document.getElementById('due_datef'+i).value;
		duedate2=document.getElementById('due_dates'+i).value;
		accepted_date=document.getElementById('accepted_date'+i).value;
		//alert();
//.......................................
		//invdate=document.getElementById('invdate'+i).value;
		//alert(new Date(duedate));
		//if(new Date(accepted_date)<(new Date(duedate)))
		//{
			
			//errmsg+='Invoice date must be greater than delivery date for line# '+linenum+'\n';
		//}
		if(new Date(duedate) > (new Date(duedate1) || new Date(duedate2) ))
		{
			errmsg += 'Due should be < Due1 & Due 2 for line# '+linenum+'\n';
		}
		if(new Date(duedate1) > new Date(duedate2))
		{
			errmsg += 'Due1 should be < Due2  for line# '+linenum+'\n';
		}	
		
		if(document.getElementById('usertype').value == 'EMPL')
		{
			//alert();
			if((duedate1 !=  '0000-00-00' && duedate1 !='') && 
				document.getElementById('cim_due1'+i).checked == false)
			{
				errmsg += 'CIM Due1 Approval should be done  for line# '+linenum+'\n';
			}
			if((duedate2 !=  '0000-00-00' && duedate2 !='') && 
			document.getElementById('cim_due2'+i).checked == false)
		    {
             errmsg += 'CIM Due2 Approval should be done  for line# '+linenum+'\n';
		    }			
	    }
		if((document.getElementById('cim_due2'+i).checked == false &&
				document.getElementById('cim_due1'+i).checked == false)&&
			(document.getElementById('invdate'+i).value != '0000-00-00' && 
			document.getElementById('invdate'+i).value != '' || 
			document.getElementById('invnum'+i).value != ''))
			{
				status_flag=1; 
			}

		/*if(document.getElementById('invdate'+i).value != '0000-00-00' && 
			document.getElementById('invdate'+i).value != '' || 
			document.getElementById('invnum'+i).value != '')
		{
			inv_flag=1;
			
		}*/
		//alert(inv_flag);
		//if(document.getElementById('invdate1'+i).value)
		
			if(document.getElementById('cim_due2'+i).checked == true && 
				document.getElementById('invdate'+i).value > duedate2 )
			{
				 errmsg += 'Inv Date Cannot be greater than Due Date2  for line# '+linenum+'\n';
			}
			else if(document.getElementById('cim_due1'+i).checked == true && 
				document.getElementById('invdate'+i).value > duedate1 )
			{
				 errmsg += 'Inv Date Cannot be greater than Due Date1  for line# '+linenum+'\n';
			}	    
	  i++;
	}
	if(document.getElementById('usertype').value == 'VEND')
	{
		if(status_flag == 1)
		{
			errmsg += 'CIM has to Aprrove before entering Inv Details\n';
		}
	}

	//alert();
		 

		 if(document.getElementById('usertype').value == 'VEND')
		{
			var supp_notes = document.getElementById('notes2').value;
			supp_notes= supp_notes.replace(/^\s+|\s+$/, '');
			  if(supp_notes == '')
			  {
				 errmsg +='Please enter Supplier Notes\n';
			  }
		}else{
			var StrToCheck = document.getElementById('notes').value;
			StrToCheck= StrToCheck.replace(/^\s+|\s+$/, '');
			   
			  if(StrToCheck == '')
			  {
				 errmsg +='Please enter CIM Notes\n';
			  } 
		}


		   


	 if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }

}
function GetDueDate(rt) 
{
	var param = rt;
	var winWidth = 300;
	var winHeight = 300;
	var winLeft = (screen.width-winWidth)/2;
	var winTop = (screen.height-winHeight)/2;
	//alert('hi1');
	win1 = window.open("getcalendar.php", param, +
	"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
	",width=" + winWidth + ",height=" + winHeight +
	",top="+winTop+",left="+winLeft);
}
function dateAddDays( /*string dd/mm/yyyy*/ datstr, /*int*/ ndays){
  var dattmp = datstr.split('/').reverse().join('/'),
      nwdate =  new Date(dattmp);
  nwdate.setDate(nwdate.getDate()+ndays||1);
  return [ zeroPad(nwdate.getDate(),10)
          ,zeroPad(nwdate.getMonth()+1,10)
          ,nwdate.getFullYear() ].join('/');
}
function zeroPad(nr,base){
  var len = (String(base).length - String(nr).length)+1;
  return len > 0? new Array(len).join('0')+nr : nr;
}

function SetDate(dateval,fieldname) 
{
	//alert(fieldname);
if(fieldname.indexOf('bil_lading_date') == 0){
	 var arr=fieldname.split("date");
	 var delv_by=document.getElementById('delv_by'+arr[1]).value;
	 //alert(delv_by);
	 
	 if(delv_by == 'SEA')
	{
var datearr=dateval.split('-');
var res_date=datearr[2]+'/'+datearr[1]+'/'+datearr[0];
		 var dd=dateAddDays(res_date,70);
		 var datearr1=dd.split('/');
var out_date=datearr1[2]+'-'+datearr1[1]+'-'+datearr1[0];
		   document.getElementById('recd_date'+arr[1]).value=out_date;

	}
	else
	{
var datearr=dateval.split('-');
var res_date=datearr[2]+'/'+datearr[1]+'/'+datearr[0];
		 var dd=dateAddDays(res_date,21);
		 var datearr1=dd.split('/');
var out_date=datearr1[2]+'-'+datearr1[1]+'-'+datearr1[0];
		   document.getElementById('recd_date'+arr[1]).value=out_date;
	}
}

    var text= document.getElementById(fieldname);
    text.value=dateval;
}
function show_graph_ontime(ponum,po)
{
	//alert();
		var ajaxRequest;  // The variable that makes Ajax possible!

		try{
			// Opera 8.0+, Firefox, Safari
			ajaxRequest = new XMLHttpRequest();
		} 
		catch (e)
		{
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
		ajaxRequest.onreadystatechange = function()
		{
				if(ajaxRequest.readyState == 4)
				{
				  if(ajaxRequest.status == 200)
				  {
					 //alert(crnnum);
					 //alert( ajaxRequest.responseText);
					 document.getElementById('poontime').innerHTML = ajaxRequest.responseText;
				  }
				}
		}
		ajaxRequest.open("POST", "poontime_report_chart.php?ponum="+ponum+"&po="+po,true);
		ajaxRequest.send(null);
}






function show_graph_ondate()
{



		var from=document.getElementById('from').value;
		var to=document.getElementById('to').value;
		if(from=='' || to=='')
		{
			alert("Enter from and To Date");
		}
		var ajaxRequest;  // The variable that makes Ajax possible!

		try{
			// Opera 8.0+, Firefox, Safari
			ajaxRequest = new XMLHttpRequest();
		} 
		catch (e)
		{
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
		ajaxRequest.onreadystatechange = function()
		{

			if(ajaxRequest.readyState == 4)
				{

														 
			 if(ajaxRequest.status == 200)
				  {
					 // alert(crnnum);
					 // alert( ajaxRequest.responseText);
					 document.getElementById('poontime').innerHTML = ajaxRequest.responseText;
				  }
				}
		}
		ajaxRequest.open("POST", "poontime_report_chart_date.php?from="+from+"&to="+to,true);
		ajaxRequest.send(null);
}