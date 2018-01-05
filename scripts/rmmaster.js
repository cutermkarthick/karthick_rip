/*
 * rmmaster.js
 * Validation for RM Master
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
*/

function check_req_fields()
{
	var errmsg = '';
if(document.getElementById("pagename").value =='new_entry')
{
      if (document.forms[0].crnnum.value.length == 0)
    {
         errmsg += 'Please enter PRN\n';
    }
    
     if (document.forms[0].rm_spec.value.length == 0)
    {
         errmsg += 'Please enter RM Spec\n';
    }

    	if (document.forms[0].spec_val.value.length == 0 || document.forms[0].spec_val.value == 'Please Specify')
    {
         errmsg += 'Please Select Spec Type\n';
    }

    	if (document.forms[0].vendor.value.length == 0)
    {
         errmsg += 'Please Select a Supplier\n';
    }
     	if (document.forms[0].rm_qty_perbill.value.length == 0)
    {
         errmsg += 'Please Enter a Qty/Billet\n';
    }

   }
    //alert(document.forms[0].rm_status.value);
    if(document.getElementById("pagename").value =='edit_rmentry')
    {
    if(document.forms[0].addnotes.value.length==0)
    {
          errmsg += 'Please Enter RM Notes\n';
    }
    }
   if(document.getElementById("rm_curstat").value==1)
       {
         errmsg += 'Active PRN with this Spec Type already Exists\n';
       }
    //alert(document.getElementById("rm_curstat").value);


 	if (document.forms[0].rm_dia.value == '' || document.forms[0].rm_dia.value == '-')
    {
       
   	
         if(document.forms[0].rm_dim1.value == '' || document.forms[0].rm_dim1.value == '-')
               errmsg += 'Please Enter Min Length \n';
		 if(document.forms[0].rm_dim2.value == '' || document.forms[0].rm_dim2.value == '-')
               errmsg += 'Please Enter Min Width \n';
		 if(document.forms[0].rm_dim3.value == '' || document.forms[0].rm_dim3.value == '-')
               errmsg += 'Please Enter Min Thickness \n';
		
	}
	/*
    if(document.getElementById("pagename").value !='new_entry' && 
		document.getElementById("rm_status").value !='Pending')
    {
       if(document.getElementById("rm_curstat").value==1)
       {
         errmsg += 'Active CRN with this Spec Type already Exists\n';
       }
       if(document.getElementById("rm_curstat_pending").value==1)
       {
            errmsg += 'CRN exists\n';
       }
    }
 */
 /* if(document.getElementById("rm_remarks").value.length==0)
    {
         errmsg += 'Please enter remarks.\n';
    }*/
     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}
function searchsort_fields()
{
    var s1ind = document.forms[0].sort1.selectedIndex;
    
    //alert('sortby' +  s1ind)

    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}
/*function forUpload()
{   alert("hai");
	if(document.getElementById('upload').value.length==0)
		{
		alert("hai");
		document.getElementById('subfile').style.display='none';
		}
	else {
		alert("1234");
		document.getElementById('subfile').style.display='block';
		}
}*/
function GetAllVendors(rt) {
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
	function SetVendor(vendor,vendrecnum) {
	document.forms[0].vendor.value = vendor;
	document.forms[0].vendrecnum.value = vendrecnum;
	}
	function printgrn(grnrecnum) {
		var winWidth = 680;
		var winHeight = 800;
		var winLeft = (screen.width-winWidth)/2;
		var winTop = (screen.height-winHeight)/2;
		win1 = window.open("printgrn.php?grnrecnum=" + grnrecnum, "printgrn",
		+
		"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
		",width=" + winWidth + ",height=" + winHeight +
		",top="+winTop+",left="+winLeft);

		}
	function GetDate(rt) {
		var param = rt;
		var winWidth = 300;
		var winHeight = 300;
		var winLeft = (screen.width-winWidth)/2;
		var winTop = (screen.height-winHeight)/2;
		//alert(rt);
		win1 = window.open("getcalendar.php",param, +
		"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
		",width=" + winWidth + ",height=" + winHeight +
		",top="+winTop+",left="+winLeft);
		}
	function printrmmasterDetail(masterdatarecnum) {
		var winWidth = 680;
		var winHeight = 800;
		var winLeft = (screen.width-winWidth)/2;
		var winTop = (screen.height-winHeight)/2;
		win1 = window.open("printrmmasterDetail.php?masterdatarecnum=" + masterdatarecnum, "PrintFeedback",

		+
		"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
		",width=" + winWidth + ",height=" + winHeight +
		",top="+winTop+",left="+winLeft);

		}


		function SetDate(dateval,fieldname) {
		//alert(fieldname);
		document.getElementById(fieldname).value = dateval;

		}
		function getHTTPObject(){
			if (window.ActiveXObject) return new ActiveXObject("Microsoft.XMLHTTP");
			else if (window.XMLHttpRequest) return new XMLHttpRequest();
			else {
			alert("Your browser does not support AJAX.");
			return null;
			}
			} 
		function getspec(crn_spec)
		{
		//alert("here");
		var specvalue=document.getElementById('spec_val').value;
		var crn=document.getElementById('crnnum').value;
		if(document.getElementById("pagename").value !='new_entry')
		{
		  var rm_status=document.getElementById('rm_status').value;
		}
		else
		{
          var rm_status='Pending';
		}
		var rec_num=document.getElementById('masterdatarecnum').value;
		//alert(rec_num);
		//alert(specvalue);
		//alert(crn+"123456"+crn_spec);
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
		                if(ajaxRequest.status == 200)
		                   {   
		                  //  alert(ajaxRequest.responseText);
		                      document.getElementById('crn_spec').innerHTML = ajaxRequest.responseText;
		                   }
		              }
		      }   
		      ajaxRequest.open("POST", "rmmastercheck_crn.php?spec="+specvalue+"&crnnum="+crn+"&rm_status="+rm_status+"&rec_num="+rec_num,true);

		      ajaxRequest.send(null); 
		      //document.getElementById('getfiles4master_data').innerHTML=
		          //'<img name="progress" id="progress" height="130" width="130" border=0 src="images/progressbar.gif">';
		}
		
		function change_spec_type()
		{
		  var aind = document.forms[0].spec_val_type.selectedIndex;
          document.forms[0].spec_val.value = document.forms[0].spec_val_type[aind].text;
		}
		
function toggleValue(divid,chk)
{
 // alert(chk+"---"+divid);
 if(chk.checked)
 {
  if(document.getElementById(divid).value == "yes")
  {

  	document.getElementById(divid).value="no";
    chk.checked=false;
  }
  else
  {
   document.getElementById(divid).value="yes";
   var currentDate = new Date();
   var month =currentDate.getMonth() + 1 ;
   // alert(month);
   if(month>0 && month < 10)
   {
    var mon_th="0"+month;
    // alert(mon_th);
   }
   else
   {
    var mon_th=month;
   }
   var day = currentDate.getDate() ;
   if(day >1 && day<10)
   {
      var days="0"+day;
      //alert(days);
   }
   else
   {
      var days=day;
   }
   var year = currentDate.getFullYear() ;
   //alert(currentDate.format("yyyy-mm-dd"));
   var DD=year + "-" + mon_th + "-" + days;
   //alert(DD);


    if(divid == "eng_app")
 {
 //alert(divid+"****");
   document.getElementById('eng_app_by').value=document.getElementById('userid').value;
   document.getElementById('eng_app_date').value=DD;
 }
 if(divid == "director_app")
 { //alert(divid+"------");
   document.getElementById('director_app_by').value=document.getElementById('userid').value;
   document.getElementById('director_app_date').value=DD;
 }

  }
 }
 else
 {
   document.getElementById(divid).value="no";
    if(divid == "eng_app")
 {
 //alert(divid+"****");
   document.getElementById('eng_app_by').value="";

    document.getElementById('eng_app_date').value="";
 }
 if(divid == "director_app")
 { //alert(divid+"------");
   document.getElementById('director_app_by').value="";
   document.getElementById('director_app_date').value="";

 }

 }

}

function onSelectStat()
{

        var aind = document.forms[0].rm_status_togle.selectedIndex;
        //alert(document.forms[0].rm_status_togle.selectedIndex+"here"+document.forms[0].rm_status_togle[aind].text);
        document.forms[0].rm_status.value = document.forms[0].rm_status_togle[aind].text;
}

function onSelectrmtype()
{

   var aind = document.forms[0].rm_bars_platessel.selectedIndex;
   document.forms[0].rm_bars_plates.value = document.forms[0].rm_bars_platessel[aind].text;
   //document.forms[0].activeval.value = document.forms[0].postat[aind].text;

}
function onSelectrm_UOM()
{

   var aind = document.forms[0].rm_uom1.selectedIndex;
   document.forms[0].rm_uom.value = document.forms[0].rm_uom1[aind].text;
   //document.forms[0].activeval.value = document.forms[0].postat[aind].text;

}
		
