/*
 * emp.js
 * validation for employee
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam 
 * bmandyam@fluentsoft.com
 */


function onSelectStatus()
{

   var aind = document.forms[0].active.selectedIndex;
   document.forms[0].status.value = document.forms[0].active[aind].text;
   document.forms[0].activeval.value = document.forms[0].active[aind].text;

}
function onSelectRole()
{

   var aind = document.forms[0].role.selectedIndex;
   document.forms[0].rolename.value = document.forms[0].role[aind].text;
   document.forms[0].roleval.value = document.forms[0].role[aind].text;

}
function onSelectSal()
{

   var aind = document.forms[0].sal.selectedIndex;
   document.forms[0].salu.value = document.forms[0].sal[aind].text;
   document.forms[0].salval.value = document.forms[0].sal[aind].text;

}
function putfocus()
{
   document.forms[0].fname.focus();
}

function putfocus1()
{
   document.forms[0].empid.focus();
}

function GetEmployer(rt) {
  var emp_type = document.getElementById("emp_type").value;
  if (emp_type.trim() == "") 
  {
    alert("Please Select Employee Type \n");
    return false;
  }
  var param = rt;
  var winWidth = 300;
  var winHeight = 300;
  var winLeft = (screen.width-winWidth)/2;
  var winTop = (screen.height-winHeight)/2;
  win1 = window.open("getemployer.php?emp_type="+emp_type+"&reasontext=" + rt, "Employers", +
  "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
  ",width=" + winWidth + ",height=" + winHeight + 
  ",top="+winTop+",left="+winLeft);
}
function SetCompany(company,companyrecnum) {
  document.forms[0].company.value = company;
  document.forms[0].companyrecnum.value = companyrecnum;
}

function DeleteEmp()
{
     document.forms[0].deleteflag.value = "y";
}

function check_req_fields()
{   
   var sind = document.forms[0].salutation.selectedIndex;
   var aind = document.forms[0].active.selectedIndex;
   var rind = document.forms[0].role.selectedIndex;
   var errmsg = '';
 
  if (document.forms[0].company.value.length == 0) {
        errmsg += 'Company must be present\n';
   }
   if (document.forms[0].fname.value.length == 0) {
        errmsg += 'First name cannot be blanks\n';
   }
/*
   if (document.forms[0].lname.value.length == 0) {
        errmsg += 'Last name cannot be blanks\n';
   }
*/
   if (document.forms[0].email.value.length == 0) {
        errmsg += 'Email must be entered\n';
   }
    if (document.forms[0].department.value.length == 0) {
        errmsg += 'Department must be entered\n';
   }
    if (errmsg == '')
   {
   document.forms[0].activeval.value = document.forms[0].active[aind].text;
   document.forms[0].roleval.value = document.forms[0].role[rind].text;
   document.forms[0].salval.value = document.forms[0].salutation[sind].text;
       return true;
   }
   else
    {
       alert (errmsg);
       return false;
    }



}

function searchsort_fields()
{
    var ind1 = document.forms[0].sem.selectedIndex;
    var ind2 = document.forms[0].use_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].semprl.value = document.forms[0].sem[ind1].text;
    document.forms[0].emp_oper.value = document.forms[0].use_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}

function  checkenter(event)
{
    var ind1 = document.forms[0].sem.selectedIndex;
    var ind2 = document.forms[0].use_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].semprl.value = document.forms[0].sem[ind1].text;
    document.forms[0].emp_oper.value = document.forms[0].use_oper[ind2].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}


function GetComp4Empconfig(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getemployer.php?reasontext=" + rt, "Employers", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}
function SetCompany(company,companyrecnum) {
  document.forms[0].company.value = company;
  document.forms[0].companyrecnum.value = companyrecnum;
}

function check_req_field4EmpConfig() 
{
  var errmsg = "";

  var sthind = document.forms[0].start_hour.selectedIndex;
  var sthval = document.forms[0].start_hour[sthind].value;
  if (sthval == "please select") 
  {
    errmsg += "Please Select Start Time Hour \n";
  }
  
  

  var stmind = document.forms[0].start_min.selectedIndex;
  var stmval = document.forms[0].start_min[stmind].value;
  if (stmval == "please select") 
  {
    errmsg += "Please Select Start Time Min \n";
  }



  var edhind = document.forms[0].end_hour.selectedIndex;
  var edmval = document.forms[0].end_hour[edhind].value;
  if (edmval == "please select") 
  {
    errmsg += "Please Select End Time Hour \n";
  }


  var edmind = document.forms[0].end_min.selectedIndex;
  var edmval = document.forms[0].end_min[edmind].value;
  if (edmval == "please select") 
  {
    errmsg += "Please Select End Time Min \n";
  }



  if (document.getElementById("company").value =="") 
  {
    errmsg += "Please Select Company \n";
  }

  var sgind = document.forms[0].shift_group.selectedIndex;
  var sgval = document.forms[0].shift_group[sgind].value;
  if (sgval == "please select") 
  {
    errmsg += "Please Select Shift \n";
  }

  if (errmsg == "") {
    return true;
  }else{
    alert(errmsg);
    return false;
  }

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
function getAllSubsidiaries(rt) {
  var param = rt;
  var winWidth = 300;
  var winHeight = 300;
  var winLeft = (screen.width-winWidth)/2;
  var winTop = (screen.height-winHeight)/2;
  win1 = window.open("getallsubsidiaries.php?reasontext=" + rt, "Employers", +
  "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
  ",width=" + winWidth + ",height=" + winHeight + 
  ",top="+winTop+",left="+winLeft);
}
function SetCustomer(company,custrecnum) {
  document.forms[0].secondary_company.value = company;
  document.forms[0].custrecnum.value = custrecnum;
}

function EmpTypeSelection() 
{
  var emp_type = document.getElementById("emp_type_sel").value;
  // alert("emp type" + emp_type);
  document.getElementById("emp_type").value = emp_type;
  if (emp_type == "Contract") {
    document.getElementById( 'contractdiv' ).style.display = 'block';
    document.getElementById( 'contractdiv' ).style.widthw = '100%';
  }else{
    document.getElementById( 'contractdiv' ).style.display = 'none';
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