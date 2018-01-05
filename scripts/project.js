function check_req_fields()
{

	var errmsg = '';	
	if (document.forms[0].project.value.length == 0) 
    {
         errmsg += 'Please Enter Project Name\n';
    }
	if (document.forms[0].start_date.value.length == 0) 
    {
         errmsg += 'Please Enter Start Date\n';
    }
	//if (document.forms[0].closed_date.value.length == 0) 
   // {
   //      errmsg += 'Please Enter Closed Date\n';
  //  }
	if (document.forms[0].manager.value.length == 0) 
    {
         errmsg += 'Please Enter Manager Name\n';
    }
	if (document.forms[0].technology.value.length == 0) 
    {
         errmsg += 'Please Enter Technology \n';
    }
if (document.forms[0].company.value.length == 0) 
    {
         // errmsg += 'Please Enter Customer \n';
    }    
	if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
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

function SetDate(dateval,fieldname)
{
fn = document.getElementById(fieldname);
fn.value = dateval;
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
  document.forms[0].company.value = customer;
  document.forms[0].siteid.value=custrecnum;
  document.forms[0].companyrecnum.value=custrecnum;
}


