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

	document.forms[0].elements[fieldname].value = dateval;

}


function getpayroll_name()
{
	var empindex =  document.getElementById('empid').selectedIndex;
	empText=document.getElementById('empid')[empindex].value;
	var empName = empText.split("|");
	document.getElementById('emp_name').value = empName[2];
	document.getElementById('link2paymaster').value = empName[0];
	document.getElementById('emp_id').value = empName[1];
}

function GetCIM(rt) 
{
	var param = rt;
	var winWidth = 1000;
	var winHeight = 350;
	var winLeft = (screen.width-winWidth)/2;
	var winTop = (screen.height-winHeight)/2;
	var wonum='';

	win1 = window.open("getEmployee.php", param, +
	"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
	",width=" + winWidth + ",height=" + winHeight +
	",top="+winTop+",left="+winLeft);
}

function SetEmployee(Emparr,etype) 
{
	var Emp = Emparr.split("|");
	
	document.forms[0].empid.value = Emp[1];
	document.forms[0].name.value = Emp[2];
	document.forms[0].emprecnum.value = Emp[0];
}
