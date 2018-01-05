function check_req_fields()
{
    //alert(document.getElementById('time_required').value);
    document.getElementById('time').value=document.getElementById('time_required').value;
    //alert(document.forms[0].time_required.value);
    var errmsg = '';	
	var lipresent = 0;
    if (document.forms[0].crnnum.value.length == 0 )
    {
         errmsg += 'Please Select PRN#\n';
    }
    if (document.forms[0].schedule_qty.value.length == 0 )
    {
         errmsg += 'Please Enter Scheduled Qty \n';
    }
	if (document.forms[0].schedule_date.value.length == 0 )
    {
         errmsg += 'Please Enter Scheduled Date \n';
    }


     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
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

function SetDate(dateval,fieldname)
{
document.forms[0].elements[fieldname].value = dateval;	
}

function GetCIM(rt) {
//alert(rt);
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

function SetCIM(CIMarr,fieldname)
{
if(CIMarr != '')
{
var CIMdet = CIMarr.split("|");
document.forms[0].crnnum.value = CIMdet[9];
// alert(document.forms[0].crnnum.value);
document.forms[0].partnum.value = CIMdet[4];
// alert(document.forms[0].partnum.value);
}
//alert(document.forms[0].crnnum.value);
var sch_qty=document.getElementById('schedule_qty').value;
       if(sch_qty == '')
       {
          alert('Please Enter Schedule Qty');
          document.forms[0].time_required.value='';
          return false;
       }
	//alert(recnum);
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
		      if(ajaxRequest.status == 200){
                  //alert(ajaxRequest.responseText);
	          document.getElementById('details').innerHTML = ajaxRequest.responseText;	
		      }
	        }
	}
	ajaxRequest.open("POST", "time_required.php?crnnum="+document.forms[0].crnnum.value+"&schedule_qty="+sch_qty,true);
	ajaxRequest.send(null);
}
function printdelivery_sch() {
var winWidth = 700;
var winHeight = 1000;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printdelivery_sch.php", "printdelivery_sch",
+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}
function resetcrn()
{
	document.forms[0].crnnum.value='';
	document.getElementById('time_required').value='';
}
function check_req_fields_import()
{
    var errmsg = '';
    if (document.forms[0].import_text.value.length == 0)
    {
		errmsg += 'Please Copy and Paste the Imported data \n';
    }

	var str=document.forms[0].import_text.value;
	var str1=str.split(",");
	if(str != '')
	{
	if(str1.length != '4' )
	{
       errmsg += 'Imported data should be count of 4 fileds \n';
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



