function GetAllVendors(rt) 
{
	var param = rt;
	var winWidth = 300;
	var winHeight = 300;
	var winLeft = (screen.width-winWidth)/2;
	var winTop = (screen.height-winHeight)/2;
	win1 = window.open("getallvendors.php?reasontext=" + rt, "Vendors", +
	"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
	",width=" + winWidth + ",height=" + winHeight +
	",top="+winTop+",left="+winLeft+",dependent=yes");
}

function SetVendor(vendor,vendrecnum) 
{
	document.forms[0].supp_name.value = vendor;
	document.forms[0].vendrecnum.value = vendrecnum;
}

function selectcheckbox(appdate,userid) {
		// alert('test');
		if(document.getElementById("chckb").checked){
			document.getElementById("approved").value = "Yes";
			document.getElementById("approved_date").value = appdate;
			document.getElementById("approved_by").value = userid;
		}else{
			document.getElementById("approved").value = "No";
			document.getElementById("approved_date").value = "";
			document.getElementById("approved_by").value = "";
		}
}

function check_req_fields() {
	var pagename = document.getElementById('pagename').value;
	var supp_name = document.getElementById('supp_name').value;
	var ctname = document.getElementById('ctname').value;
	var ctemail = document.getElementById('ctemail').value;
	var errmsg = "";

	if (supp_name == "") {
		errmsg += "Please Enter Supplier Name \n";
	}
	if (ctname == "") {
		errmsg += "Please Enter Contact Name \n";
	}
	if (ctemail == "") {
		errmsg += "Please Enter Contatct Email \n";
	}

	if (pagename== "suppmasteredit") {
		var status = document.getElementById('status').value;
		var approved = document.getElementById('approved').value;
		if (approved =="Yes" && status != 'Active') {
			errmsg += "Status Should be Active \n";
		}
	}

	if (errmsg !="") {
		alert(errmsg); return false;
	}else{
		return true;
	}

}