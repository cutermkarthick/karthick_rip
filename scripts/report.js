/*
 * report.js
 * validation for users
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
 */

var httpObject = null;
var divid;
var tblid;
var month=new Array(12);
month[0]="Jan";
month[1]="Feb";
month[2]="Mar";
month[3]="Apr";
month[4]="May";
month[5]="Jun";
month[6]="Jul";
month[7]="Aug";
month[8]="Sep";
month[9]="Oct";
month[10]="Nov";
month[11]="Dec";

function searchsort_fields()
{
/*
    var ind = document.forms[0].comp_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    var s2ind = document.forms[0].sort2.selectedIndex;
    document.forms[0].company_oper.value = document.forms[0].comp_oper[ind].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;
    document.forms[0].sortfld2.value = document.forms[0].sort2[s2ind].text;
	alert(document.forms[0].sortfld2.value);
	alert(document.forms[0].sortfld1.value);
*/
    if (document.forms[0].crn.value.length == 0) {
        alert('Oper Name Entry must be present');
        return false;
   }

}

function searchsort_forcrn()
{
    var ind = document.forms[0].company_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    var s2ind = document.forms[0].sort2.selectedIndex;
    document.forms[0].company_oper.value = document.forms[0].comp_oper[ind].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;
    document.forms[0].sortfld2.value = document.forms[0].sort2[s2ind].text;
	alert(document.forms[0].sortfld2.value);
	alert(document.forms[0].sortfld1.value);
}
function searchsort_prodperf()
{
    var ind = document.forms[0].comp_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    var s2ind = document.forms[0].sort2.selectedIndex;
    document.forms[0].company_oper.value = document.forms[0].comp_oper[ind].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;
    document.forms[0].sortfld2.value = document.forms[0].sort2[s2ind].text;
	alert(document.forms[0].sortfld2.value);
	alert(document.forms[0].sortfld1.value);
}
function searchsort_stockgrn()
{
    var ind = document.forms[0].comp_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    var s2ind = document.forms[0].sort2.selectedIndex;
    document.forms[0].company_oper.value = document.forms[0].comp_oper[ind].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;
    document.forms[0].sortfld2.value = document.forms[0].sort2[s2ind].text;
	alert(document.forms[0].sortfld2.value);
	alert(document.forms[0].sortfld1.value);
}
function checkenter()
{

    var ind = document.forms[0].nctype.selectedIndex;
   // var s1ind = document.forms[0].sort1.selectedIndex;
    //var s2ind = document.forms[0].sort2.selectedIndex;
    document.forms[0].nctype.value = document.forms[0].nctype[ind].text;
    //document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;
    //document.forms[0].sortfld2.value = document.forms[0].sort2[s2ind].text;
	//alert(document.forms[0].sortfld2.value);
	//alert(document.forms[0].sortfld1.value);

}
function GetDate(rt) {
var param = rt;

var winWidth = 300;
var winHeight = 350;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
//alert(param);
win1 = window.open("getcalendar.php",param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}


function SetDate(dateval,fieldname) {
//alert(fieldname);
document.getElementById(fieldname).value = dateval;

}

// Get the HTTP Object
function getHTTPObject(){
if (window.ActiveXObject) return new ActiveXObject("Microsoft.XMLHTTP");
else if (window.XMLHttpRequest) return new XMLHttpRequest();
else {
alert("Your browser does not support AJAX.");
return null;
}
} 
// Change the value of the outputText field
function setOutput(){

//  alert(httpObject.status+"inside"+httpObject.readyState);
     if(httpObject.readyState == 4){
           //alert(divid+"---"+httpObject.responseText);
          document.getElementById(divid).innerHTML = httpObject.responseText;
//          alert(document.getElementById('tQ').innerHTML);
//	alert(document.getElementById('mc').value);
gettotal_quantity();
//alert(document.getElementById('machinename').value);

       }
}
//function getTotalQuantity()
function gettotal_quantity()
{
//	array machineID[]="";
	var machineID=["BMV 60-1","BMV 60-2","BMV 45-1","BMV 45-2","BMV 50","VMC 70L","DMG 360L","HMC 440","DX 200-1","DX 200-2","DX 200-3","HAAS","MakinoF3","MakinoF5","HAASVF2SS","VR11","ST20","HAASVF2SS-2","MAKINOF5-2","MAKINOF5-3","MAKINOF5-4","EMAG-1","A51nx-1"];
for(var i=0;i<23;i++)
{
//alert("inside for"+machineID[i]);
var ID="tQ"+machineID[i];
//alert(ID);
var ellement=document.getElementById(ID);
//alert(ellement);
if(ellement!=null)
{
var quantity=ellement.innerHTML;
//alert(ID+"====="+quantity);
//alert("xxxxx"+"val"+machineID[i]+"\n");
var elem1=document.getElementById("val"+machineID[i]);
//alert(elem1+"00000000000000000"+elem1.innerHTML);
elem1.innerHTML = quantity;
}
//total Quantity rejected

var rID="tq1"+machineID[i];
var ellementr=document.getElementById(rID);
if(ellementr!=null)
{
quantityr=ellementr.innerHTML;
var e=document.getElementById("val1"+machineID[i]);
e.innerHTML = quantityr;
}




}

var dateMID=["bmv601","bmv602","bmv451","bmv452","bmv50","vmc70l","dmg360l","hmc440","dx2001","dx2002","dx2003","hass","makinof3","makinof5","haasvf2ss","vr11","st20","haasvf2ss2","makinof52","makinof53","makinof54","emag1","a51nx1"];
for(var i=0;i<23;i++)
{
var fID="f"+dateMID[i];
var tID="t"+dateMID[i];
//for display
var tfID="tf"+dateMID[i];
var ttID="tt"+dateMID[i];
var ellement1=document.getElementById(fID);
var ellement2=document.getElementById(tID);
//alert(fID+"*-*-*-*-*"+tID+"\n"+tfID+"*-*-*-*-*"+ttID+"\n");
//alert(ellement1+"--*-*-*"+ellement2);
if(ellement1!=null && ellement2!=null)
{
var q1=ellement1.value;
var q2=ellement2.value;

//alert(tfID+"----------"+ttID);
var fdate=document.getElementById(tfID);
var tdate=document.getElementById(ttID);
//alert(fdate);

var d1=q1.split('-');
var d2=q2.split('-');
if(d1[2] > 0 && d1[2] < 10)
{
  var dy= '0'+d1[2]
}
else
{
 var dy= d1[2]
}
if(d2[2] > 0 && d2[2] < 10)
{
  var dy2= '0'+d2[2]
}
else
{
 var dy2= d2[2]
}
date1=new Date(parseInt(d1[0]),parseInt(d1[1],10)-1,parseInt(dy,10));
date2=new Date(parseInt(d2[0]),parseInt(d2[1],10)-1,parseInt(dy2,10));


//date2=new Date(d2[0],d2[1],d2[2]);
//alert(date2+"!!!!!!!!!!!"+d2[0]+"************"+d2[1]+"----------------"+d2[2]);
//var myDate = new Date(parseInt(YYYY, d1[0]), parseInt(MM, d1[1]) - 1, parseInt(DD, 10));
//var myDate = new Date(parseInt(YYYY, 10), parseInt(MM, 10) - 1, parseInt(DD, 10));
//alert('y'+date1.getFullYear());
//alert(month[date1.getMonth()-1]);
fd=month[date1.getMonth()]+' '+date1.getDate()+','+date1.getFullYear();
td=month[date2.getMonth()]+' '+date2.getDate()+','+date2.getFullYear();
//alert(fd+"-----"+fID+"----------"+td+"***********"+tID);
//alert('new date'+q);
//alert('new date'+fd+'*********'+td);
fdate.innerHTML=fd;
tdate.innerHTML=td;
}
}


//alert(document.getElementById("fbmv601").value);

}

// Implement business logic 
function getcost(mcname,individ,intblid,instdate,inenddate)
{ 
//alert(mcname);   
   stdate = document.getElementById(instdate).value;
   enddate = document.getElementById(inenddate).value;
   if (document.getElementById(instdate).value == '') {
        alert('Start and End dates must be present');
        return false;
   }
   if (document.getElementById(inenddate).value == '') {
        alert('Start and End dates must be present');
        return false;
   }
   httpObject = getHTTPObject();
   divid = individ;
   tblid = intblid;

//alert("here");
   if (httpObject != null) {
      httpObject.open("POST", "getmccost.php?mcname="+mcname+"&tblid="+tblid+"&divid="+divid+"&stdate="+stdate+"&enddate="+enddate,true);

      httpObject.onreadystatechange = setOutput;
      httpObject.send(null); 
   }
}

function getmc_eff(mcname,individ,intblid,instdate,inenddate){
//alert(mcname);
   stdate = document.getElementById(instdate).value;
   enddate = document.getElementById(inenddate).value;
   if (document.getElementById(instdate).value == '') {
        alert('Start and End dates must be present');
        return false;
   }
   if (document.getElementById(inenddate).value == '') {
        alert('Start and End dates must be present');
        return false;
   }
   httpObject = getHTTPObject();
   divid = individ;
   tblid = intblid;

//alert("here");
   if (httpObject != null) {
      httpObject.open("POST", "getmceff.php?mcname="+mcname+"&tblid="+tblid+"&divid="+divid+"&stdate="+stdate+"&enddate="+enddate,true);

      httpObject.onreadystatechange = setOutput;
      httpObject.send(null);
   }
}
// Implement business logic 
function getprodrec(mcname,individ,intblid,instdate,inenddate,incrn,instage,inshift){ 
   stdate = document.getElementById(instdate).value;
   enddate = document.getElementById(inenddate).value;
   var crn = document.getElementById(incrn).value;
   var shiftno = document.getElementById(inshift).value;
   var stagenum = document.getElementById(instage).value;
   if (document.getElementById(instdate).value == '') {
        alert('Start and End dates must be present');
        return false;
   }
   if (document.getElementById(inenddate).value == '') {
        alert('Start and End dates must be present');
        return false;
   }
   httpObject = getHTTPObject();
   divid = individ;
   tblid = intblid;
   //alert(divid+"----------");
   if (httpObject != null) {
	  mc=mcname;
      httpObject.open("POST", "getprodrec.php?mcname="+mcname+"&tblid="+tblid+
		  "&divid="+divid+"&stdate="+stdate+"&enddate="+enddate+
		  "&crn="+crn+"&shift="+shiftno+"&stage="+stagenum,true);

      httpObject.onreadystatechange = setOutput;
      httpObject.send(mc); 
   }
}

function display_crrchart(cond)
{

 //alert('cond');
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
//	Create a function that will receive data sent from the server
	 ajaxRequest.onreadystatechange = function(){
	        if(ajaxRequest.readyState == 4)
            {
		      if(ajaxRequest.status == 200){
		      //alert(crnnum);
		    //alert( ajaxRequest.responseText);

                 document.getElementById('crr').innerHTML = ajaxRequest.responseText;

		      }
	        }
	}
	//alert("Here1");
	ajaxRequest.open("POST", "crr_report_chart.php",true);
	ajaxRequest.send(null);

}

function show_graph_ontime(crn)
{

 //alert('cond');
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
//	Create a function that will receive data sent from the server
	 ajaxRequest.onreadystatechange = function(){
	        if(ajaxRequest.readyState == 4)
            {
		      if(ajaxRequest.status == 200){
		      //alert(crnnum);
		    //alert( ajaxRequest.responseText);

                 document.getElementById('crrontime').innerHTML = ajaxRequest.responseText;

		      }
	        }
	}
	//alert("Here1");
	ajaxRequest.open("POST", "ontime_report_chart.php?crnnum="+crn,true);
	ajaxRequest.send(null);
}

function show_graph_cofcs(crn)
{

 //alert('cond');
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
//	Create a function that will receive data sent from the server
	 ajaxRequest.onreadystatechange = function(){
	        if(ajaxRequest.readyState == 4)
            {
		      if(ajaxRequest.status == 200){
		      //alert(crnnum);
		    //alert( ajaxRequest.responseText);

                 document.getElementById('crrontime').innerHTML = ajaxRequest.responseText;

		      }
	        }
	}
	//alert("Here1");
	ajaxRequest.open("POST", "cofc_report_chart.php?crnnum="+crn,true);
	ajaxRequest.send(null);
}


function show_graph_ontime(crn)
{

 //alert('cond');
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
//	Create a function that will receive data sent from the server
	 ajaxRequest.onreadystatechange = function(){
	        if(ajaxRequest.readyState == 4)
            {
		      if(ajaxRequest.status == 200){
		      //alert(crnnum);
		    //alert( ajaxRequest.responseText);

                 document.getElementById('crrontime').innerHTML = ajaxRequest.responseText;

		      }
	        }
	}
	//alert("Here1");
	ajaxRequest.open("POST", "ontime_report_chart.php?crnnum="+crn,true);
	ajaxRequest.send(null);
}

function show_otif()
{

 //alert(month_year);
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
//	Create a function that will receive data sent from the server
	 ajaxRequest.onreadystatechange = function(){
	        if(ajaxRequest.readyState == 4)
            {
		      if(ajaxRequest.status == 200){
		      //alert(crnnum);
		    //alert( ajaxRequest.responseText);

                 document.getElementById('crrontime').innerHTML = ajaxRequest.responseText;

		      }
	        }
	}
	//alert("Here1");
	ajaxRequest.open("POST", "otif_report_chart.php",true);
	ajaxRequest.send(null);
}

function show_cofc()
{
 //alert(month_year);
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
//	Create a function that will receive data sent from the server
	 ajaxRequest.onreadystatechange = function(){
	        if(ajaxRequest.readyState == 4)
            {
		      if(ajaxRequest.status == 200){
		      //alert(crnnum);
		    //alert( ajaxRequest.responseText);

                 document.getElementById('crrontime').innerHTML = ajaxRequest.responseText;

		      }
	        }
	}
	//alert("Here1");
	ajaxRequest.open("POST", "cofc_report_4crn_chart.php",true);
	ajaxRequest.send(null);
}

function ShowDetails(element) 
{     
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
				// Something went wrong
				alert("Your browser broke!");
				return false;
			   }
		}
	}
	// Create a function that will receive data sent from the server
	 ajaxRequest.onreadystatechange = function(){		 
	        if(ajaxRequest.readyState ==4)
            {		
				if(ajaxRequest.status == 200)
				{
				  document.getElementById('cust').innerHTML = ajaxRequest.responseText;
		        }
	        }
	}
	//alert("Here1");
	ajaxRequest.open("POST", "getcrnDetails.php?crn="+element, true);	
	ajaxRequest.send(null);

}
function getmc_eff_performance(mcname,individ,intblid,instdate,inenddate,i)
{
   stdate = document.getElementById(instdate).value;
   enddate = document.getElementById(inenddate).value;
   if (document.getElementById(instdate).value == '') {
        alert('Start and End dates must be present');
        return false;
   }
   if (document.getElementById(inenddate).value == '') {
        alert('Start and End dates must be present');
        return false;
   }
   httpObject = getHTTPObject();
   divid = individ;
   tblid = intblid;

//alert("here");
   if (httpObject != null) {
	 //alert("getmceff.php?mcname="+mcname+"&tblid="+tblid+"&divid="+divid+"&stdate="+stdate+"&enddate="+enddate+"&i="+i);
      httpObject.open("POST", "getmceff_performance.php?mcname="+mcname+"&tblid="+tblid+"&divid="+divid+"&stdate="+stdate+"&enddate="+enddate+"&i="+i,true);

      httpObject.onreadystatechange = setOutput;
      httpObject.send(null);
   }
}
function grn_stock_export()
{	  
	var errmsg = '';	
	var url="excel_stockgrn4dir.php";
	document.getElementById("excel").href=url;	
}

function searchsort_fields_production()
{    if (document.forms[0].crn.value.length == 0)
	{
        alert('Please Enter PRN#');
        return false;
    }
	
}

function Getcim_no() {
var param = '';
var winWidth = 1000;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getCIM.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetCIM(Setordering_code,fieldname)
{
  var Setordering_code = Setordering_code.split("|"); 
  document.forms[0].crn.value = Setordering_code[9]; 
}


function show_prodn_shift(wo)
{
  //alert (wo);
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
//	Create a function that will receive data sent from the server
	 ajaxRequest.onreadystatechange = function(){
	        if(ajaxRequest.readyState == 4)
            {
		      if(ajaxRequest.status == 200){
		      //alert(crnnum);
		    //alert( ajaxRequest.responseText);

                 document.getElementById('prodn').innerHTML = ajaxRequest.responseText;


		      }
	        }
	}
	//alert("Here1");
	ajaxRequest.open("POST", "add_shift_record.php?wonum=" +wo ,true);
	ajaxRequest.send(null);
}
function crn_cost_export()
{	  
	var errmsg = '';	
    var crn_num=document.forms[0].crn_num.value;
	var url="excel_crncost.php?crn="+crn_num;
	document.getElementById("excel").href=url;	
}
function getsupp_crn_details() 
{
    var errmsg = '';
    if (document.forms[0].treat_to.value == 'select' && document.forms[0].crnnum.value.length == 0)
    {
         errmsg += 'Please Enter either CRN# or Supplier #.\n';
    }  
    if (errmsg == '')
    { 
        document.forms[0].submit();    
        //return true;
    }
    else
    {
       alert (errmsg);
       return false;
    }

}
function ongetdetails(crn_num)
{
  	var ajaxRequest;  // The variable that makes Ajax possible!
    //alert(crn_num+"******");
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
//	Create a function that will receive data sent from the server
		      //alert(crn_num);
	 ajaxRequest.onreadystatechange = function(){
          if(ajaxRequest.readyState == 4)
            {
		      if(ajaxRequest.status == 200){
		      //alert(crn_num);
		    //alert( ajaxRequest.responseText);

                 document.getElementById('dispatchQty').innerHTML = ajaxRequest.responseText;

		      }
	        }
	}
	//alert("Here1");
	ajaxRequest.open("POST", "getdispatchQty.php?crn=" +crn_num ,true);
	ajaxRequest.send(null);
}
function ongethidedetails(crn_num)
{
  	var ajaxRequest;  // The variable that makes Ajax possible!
    //alert(crn_num+"******");
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
//	Create a function that will receive data sent from the server
	 ajaxRequest.onreadystatechange = function(){
          if(ajaxRequest.readyState == 4)
            {
		      if(ajaxRequest.status == 200){
		      //alert(crn_num);
		    //alert( ajaxRequest.responseText);

                 document.getElementById('dispatchQty').innerHTML = ajaxRequest.responseText;

		      }
	        }
	}
	//alert("Continue");
	ajaxRequest.open("POST", "getDispatchQty_hide.php?crn=" +crn_num ,true);
	ajaxRequest.send(null);
}
function ongetgrndetails(crn_num)
{
  	var ajaxRequest;  // The variable that makes Ajax possible!
    //alert(crn_num+"******");
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
//	Create a function that will receive data sent from the server
	 ajaxRequest.onreadystatechange = function(){
         if(ajaxRequest.readyState == 4)
            {
		      if(ajaxRequest.status == 200){
		      //alert(crn_num);
		    //alert( ajaxRequest.responseText);

                 document.getElementById('grnQty').innerHTML = ajaxRequest.responseText;

		      }
	        }
	}
	//alert("Here1");
	ajaxRequest.open("POST", "getgrnQty.php?crn=" +crn_num ,true);
	ajaxRequest.send(null);
}
function hidegrndetails(crn_num)
{
  	var ajaxRequest;  // The variable that makes Ajax possible!
    //alert(crn_num+"******");
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
//	Create a function that will receive data sent from the server
	 ajaxRequest.onreadystatechange = function(){
         if(ajaxRequest.readyState == 4)
            {
		      if(ajaxRequest.status == 200){
		      //alert(crn_num);
		    //alert( ajaxRequest.responseText);

                 document.getElementById('grnQty').innerHTML = ajaxRequest.responseText;

		      }
	        }
	}
	//alert("Here1");
	ajaxRequest.open("POST", "getgrnQty_hide.php?crn=" +crn_num ,true);
	ajaxRequest.send(null);
}


function searchsort_fields()
{
    //var ind1 = document.forms[0].salesorder.selectedIndex;
    var ind2 = document.forms[0].nc_type.selectedIndex;
    //var s1ind = document.forms[0].sort1.selectedIndex;
    //document.forms[0].salesorderfl.value = document.forms[0].salesorder[ind1].text;
    document.forms[0].nc_type.value = document.forms[0].nc_type[ind2].text;
    //document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}

function searchsort_fields4cons()
{

    var ind2 = document.forms[0].status_val.selectedIndex;

    document.forms[0].status_val.value = document.forms[0].status_val[ind2].text;


}

function onSelectStatus(status)
{

	document.getElementById('status').value = status.value;

	//alert(status.value);

	//alert(document.getElementById('status').value);
     return true;
}

function getprod_rec(mcname,individ,intblid,instdate,inenddate,incrn,inopername,inwo){
//alert(inopername+"HERE---");
   stdate = document.getElementById(instdate).value;
   enddate = document.getElementById(inenddate).value;
   var crn = document.getElementById(incrn).value;
   var wonum = document.getElementById(inwo).value;
   var opername = document.getElementById(inopername).value;
   
   if (document.getElementById(instdate).value == '') {
        alert('Start and End dates must be present');
        return false;
   }
   if (document.getElementById(inenddate).value == '') {
        alert('Start and End dates must be present');
        return false;
   }
   httpObject = getHTTPObject();
   divid = individ;
   tblid = intblid;
   ///alert(divid+"----------");
   if (httpObject != null) {
	  mc=mcname;
      httpObject.open("POST", "getprod_rec.php?mcname="+mcname+"&tblid="+tblid+
		  "&divid="+divid+"&stdate="+stdate+"&enddate="+enddate+
		  "&crn="+crn+"&wonum="+wonum+"&opername="+opername,true);

      httpObject.onreadystatechange = setOutput_prodrec;
      httpObject.send(mc);
   }
}

function setOutput_prodrec(){

//  alert(httpObject.status+"inside"+httpObject.readyState);
     if(httpObject.readyState == 4){
           //alert(divid+"---"+httpObject.responseText);
          document.getElementById(divid).innerHTML = httpObject.responseText;

       }
}

function getmachinerec(){

   stdate = document.getElementById('fromdate').value;
   enddate = document.getElementById('todate').value;
   var crn = document.getElementById('crn').value;
   var wonum = document.getElementById('WO').value;
   var opername = document.getElementById('operno').value;
   var mcname=document.getElementById('mc_name').value;;
   //alert(stdate+"--------"+enddate+"///////////"+mcname);
  if (document.getElementById('fromdate').value == '') {
        alert('Start and End dates must be present');
        return false;
   }
   if (document.getElementById('todate').value == '') {
        alert('Start and End dates must be present');
        return false;
   }
   httpObject = getHTTPObject();
   divid = "mcname";
   tblid = "tmcname";

   if (httpObject != null) {
	mc=mcname;
      httpObject.open("POST", "getprod_rec.php?mcname="+mcname+"&tblid="+mcname+
		  "&divid="+divid+"&stdate="+stdate+"&enddate="+enddate+
		  "&crn="+crn+"&wonum="+wonum+"&opername="+opername,true);

      httpObject.onreadystatechange = setOutput_prodrec;
      httpObject.send(mc);
   }
}


function getcrn_globalreport()
{
  var crn_global=document.getElementById('crn_global').value;
  var from_global=document.getElementById('frm_global').value;
  var to_global=document.getElementById('to_global').value;
  //alert(crn_global);
  if(crn_global!='')
 {
  document.getElementById('crn').value=crn_global;
  document.getElementById('crn_schedule').value=crn_global;
  document.getElementById('crn_rmpo').value=crn_global;
  document.getElementById('crn_disp').value=crn_global;
 }
  document.getElementById('frm').value=from_global;
  document.getElementById('to').value=to_global;
  document.getElementById('start_date_wo').value=from_global;
  document.getElementById('end_date_wo').value=to_global;

   getcrn_report('customerdiv');
   getwo_performance('wo_performance');
   getschedule_report('schedule');
   getrmschedule_report('rmposchedule');
   getthis_week_disp_report('this_week_disp');
}

function getcrn_report()
{   //alert("HERE");
   var errmsg = '';
   if (document.getElementById('crn').value == '') 
   {
        errmsg += 'PRN must be present.\n';       
   }
   if (document.getElementById('frm').value == '')
   {
        errmsg += 'From Date must be present.\n';
       
   }
   if (document.getElementById('to').value == '') 
   {
        errmsg += 'To Date must be present.\n';
       
   }
   if(errmsg=='')
	{
	    crn = document.forms[0].crn.value;
	   frm = document.forms[0].frm.value;
	   to = document.forms[0].to.value;
	   
  $.ajax({
      url : "crn_report.php",
      type : "POST",
      dataType: "html",
      data : "crn="+crn+"&frm="+frm+"&to="+to,
      success : function (msg){
     //alert(msg);
              $('#customerdiv').html(msg);
              }
         })
    }else
	{
         alert (errmsg);
         return false;
	}
}


function getwo_performance()
{   //alert("HERE");
   var errmsg = '';
  if (document.getElementById('start_date_wo').value == '')
   {
        errmsg += 'From Date must be present.\n';
       
   }
   if (document.getElementById('end_date_wo').value == '') 
   {
        errmsg += 'To Date must be present.\n';
       
   }
   start_date_wo=document.getElementById('start_date_wo').value;
   end_date_wo=document.getElementById('end_date_wo').value;
  if(errmsg=='')
	{
  $.ajax({
      url : "wo_chart.php",
      type : "POST",
      dataType: "html",
      data : "start_date_wo="+start_date_wo+"&end_date_wo="+end_date_wo,
      success : function (msg){
     //alert(msg);
              $('#wo_performance').html(msg);
              }
         })
	}
		 else
	{
			 alert(errmsg);
			 return false
	}
}

function getschedule_report()
{   //alert("HERE");
   var errmsg ='';
 if (document.forms[0].crn_schedule.value == '')
   {
        errmsg += 'PRN must be present.\n';       
   }
   
  if(errmsg=='')
	{
       var crn_schedule= document.forms[0].crn_schedule.value;
  $.ajax({
      url : "crn_schedule.php",
      type : "POST",
      dataType: "html",
      data : "crn_schedule="+crn_schedule,
      success : function (msg){
     //alert(msg);
              $('#schedule').html(msg);
              }
         })
	}
		 else
	{
		alert(errmsg);
		 return false;
	}
}

function getrmschedule_report()
{   //alert("HERE");
   var errmsg ='';
 if (document.getElementById('crn_rmpo').value == '')
   {
        errmsg += 'PRN must be present.\n';       
   }  
   
  if(errmsg=='')
	{
       var crn_rmpo= document.getElementById('crn_rmpo').value;
	   //alert("HERE---");
	 // $("#LoadingImage").show();
	  $.ajax({
	  url : "rmposchedule.php",
      type : "POST",
      dataType: "html",
      data : "crn_rmpo="+crn_rmpo,
		  //beforeSend: function(){
      //  $('#image').show();
    //},
    //complete: function(){
        //$('#image').hide();
    //},
      success : function (msg)
	  {
          $('#rmposchedule').html(msg);
		  //$("#LoadingImage").hide();
       }
	   
     });
 }
		 else
	{
		alert(errmsg);
		 return false;
	}
}

function getthis_week_disp_report()
{   //alert("HERE");
   var errmsg ='';
 if (document.forms[0].crn_disp.value == '')
   {
        errmsg += 'PRN must be present.\n';       
   }
   
  if(errmsg=='')
	{
       var crn_disp= document.getElementById('crn_disp').value;
  $.ajax({
	  url : "week_dispatch.php",
      type : "POST",
      dataType: "html",
      data : "crn_disp="+crn_disp,
      success : function (msg){
     //alert(msg);
              $('#this_week_disp').html(msg);
              }
         })
	}
		 else
	{
		alert(errmsg);
		 return false;
	}
}

function getboi_sch_report()
{   //alert("HERE");
   var errmsg ='';
  if (document.forms[0].partnum.value == '')
   {
        errmsg += 'PartNum must be present.\n';       
   }
   
  if(errmsg=='')
	{
       var partnum= document.getElementById('partnum').value;
  $.ajax({
	  url : "boi_Sch.php",
      type : "POST",
      dataType: "html",
      data : "partnum="+partnum,
      success : function (msg){
     //alert(msg);
              $('#boischedule').html(msg);
              }
         })
	}
		 else
	{
		alert(errmsg);
		 return false;
	}
}


function get4weekspendingdisp()
{ 
	// alert("HERE");
   var errmsg ='';

 if (document.getElementById('prn_disp').value == '')
   {
        errmsg += 'CRN must be present.\n';       
   }
   
  if(errmsg=='')
	{
	   disp_loader.innerHTML = "<img width='20' height='20' id='loaderimg1' alt='loading' title='loading' src='images/loader.gif' />" ;
       var prnnum= document.getElementById('prn_disp').value;
       
       
  $.ajax({
      url : "fourweeks_dispatch.php",
      type : "POST",
      dataType: "html",
      data : "prn="+prnnum,
      success : function (msg){
     //alert(msg);
              $('#pending_dispatch').html(msg);
     
              }
         })
	}
		 else
	{
		alert(errmsg);
		 return false;
	}
}


function getprn_outlook()
{
	// alert("HERE");
   var errmsg ='';
// alert(document.getElementById('prn_outlook').value);
 if (document.forms[0].prn_outlook.value == '')
   {
        errmsg += 'CRN must be present.\n';       
   }
   
  if(errmsg=='')
	{
		 crn_loader.innerHTML = "<img width='20' height='20' id='loaderimg1' alt='loading' title='loading' src='images/loader.gif' />" ;
       var prn_outlook= document.forms[0].prn_outlook.value;
       var ftrigger= document.forms[0].ftrigger.value;
       
  $.ajax({
      url : "prn_outlook4db.php",
      type : "POST",
      dataType: "html",
      data : "prn="+prn_outlook+"&ftrigger="+ftrigger,
      success : function (msg){
     //alert(msg);
              $('#outlook').html(msg);
     
              }
         })
	}
		 else
	{
		alert(errmsg);
		 return false;
	}
}