function SelectApproval(argument) {

	var App_checked = document.getElementById("approved_check").checked;
	if (App_checked) {
		
		var date = document.getElementById("today").value;
		var approved_by = document.getElementById("userid").value;
		document.getElementById("approved").value = 'yes';
		document.getElementById("approved_by").value = approved_by;
		document.getElementById("approved_date").value = date;
	}
	else{
		document.getElementById("approved").value = 'no';
		document.getElementById("approved_by").value = '';
		document.getElementById("approved_date").value = '';
	}
}

function SelectStatus() {
	document.getElementById("status").value = document.getElementById("select_status").value;
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