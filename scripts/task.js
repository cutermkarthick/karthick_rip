function check_req_fields()
{

	var errmsg = '';	
	if (document.forms[0].task_id.value.length == 0) 
    {
         errmsg += 'Please Enter Task ID\n';
    }
	if (document.forms[0].task_name.value.length == 0) 
    {
         errmsg += 'Please Enter Task Name\n';
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
  // alert("fieldname " + fieldname);
  fn = document.getElementById(fieldname);
  fn.value = dateval;
}

function GetUsers4Task(rt) {
  var param = rt;
  var winWidth = 300;
  var winHeight = 300;
  var winLeft = (screen.width-winWidth)/2;
  var winTop = (screen.height-winHeight)/2;
  win1 = window.open("GetUsers4Task.php?reasontext=" + rt, "Customers", +
  "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
  ",width=" + winWidth + ",height=" + winHeight +
  ",top="+winTop+",left="+winLeft);
}

function SetUsers4Task(userid,userrecnum) {
  document.forms[0].userid.value = userid;
  document.forms[0].userrecnum.value=userrecnum;
}
