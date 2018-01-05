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

function GetCustomer(rt) {
  var param = rt;
  var winWidth = 300;
  var winHeight = 300;
  var winLeft = (screen.width-winWidth)/2;
  var winTop = (screen.height-winHeight)/2;
  win1 = window.open("getcustomers.php?reasontext=" + rt, "Employers", +
  "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
  ",width=" + winWidth + ",height=" + winHeight + 
  ",top="+winTop+",left="+winLeft);
}
function GetContractCompanies(rt) {
  var param = rt;
  var winWidth = 300;
  var winHeight = 300;
  var winLeft = (screen.width-winWidth)/2;
  var winTop = (screen.height-winHeight)/2;
  win1 = window.open("getcontractcompanies.php?reasontext=" + rt, "Employers", +
  "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
  ",width=" + winWidth + ",height=" + winHeight + 
  ",top="+winTop+",left="+winLeft);
}
function SetCustomer(company,custrecnum) {
  document.forms[0].secondary_company.value = company;
  document.forms[0].custrecnum.value = custrecnum;
}


function GetEmployeeResource(rt) {
  var shiftdate = document.getElementById('shiftdate') .value;
  var param = rt;
  var winWidth = 300;
  var winHeight = 300;
  var winLeft = (screen.width-winWidth)/2;
  var winTop = (screen.height-winHeight)/2;
  win1 = window.open("GetEmployeeResource.php?shiftdate="+shiftdate+"&reasontext=" + rt, "Employers", +
  "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
  ",width=" + winWidth + ",height=" + winHeight + 
  ",top="+winTop+",left="+winLeft);
}
function GetEmployeeUnderSubsidiary(rt) {
  var shiftdate = document.getElementById('shiftdate') .value;
  var cid = document.forms[0].custrecnum.value ;
  var param = rt;
  var winWidth = 300;
  var winHeight = 300;
  var winLeft = (screen.width-winWidth)/2;
  var winTop = (screen.height-winHeight)/2;
  win1 = window.open("getemployeeundersubsidiary.php?shiftdate="+shiftdate+"&cid="+cid+"&reasontext=" + rt, "Employers", +
  "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
  ",width=" + winWidth + ",height=" + winHeight + 
  ",top="+winTop+",left="+winLeft);
}
function GetAllEmployeeUnderSubsidiary(rt) {
  
  var cid = document.forms[0].custrecnum.value ;
  var param = rt;
  var winWidth = 300;
  var winHeight = 300;
  var winLeft = (screen.width-winWidth)/2;
  var winTop = (screen.height-winHeight)/2;
  win1 = window.open("getemployeeundersubsidiary.php?cid="+cid+"&reasontext=" + rt, "Employers", +
  "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
  ",width=" + winWidth + ",height=" + winHeight + 
  ",top="+winTop+",left="+winLeft);
}
function SetEmployee(company,compvalue) {
  var com =compvalue.split('|');
  document.forms[0].empname.value = company;
  document.forms[0].empid.value = com[1];
}