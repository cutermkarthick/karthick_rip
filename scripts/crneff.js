/*
 * crneff.js
 * validation for crn efficiency
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
*/

function display_graph(crnnum,qty_acc,qty_ret,qty_rej,wo_qty,date1,date2,qty_rew)
{

    //alert ('qty Rew='+qty_rew);
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
	        if(ajaxRequest.status == 200)
            {
		      if(ajaxRequest.readyState == 4){
		      //alert(crnnum);
		    //alert( ajaxRequest.responseText);

                 document.getElementById('layer1').innerHTML = ajaxRequest.responseText;


		      }
	        }
	}
	//alert("Here1");
	ajaxRequest.open("POST", "crn_efficiency_chart1.php?qtyacc="+qty_acc + "&qtyrej=" + qty_rej + "&qtyret=" + qty_ret + "&crnnum=" + crnnum + "&woqty=" + wo_qty + "&bdate1=" + date1 + "&bdate2=" + date2 +"&qty_rew="+qty_rew,true);
	ajaxRequest.send(null);
}
function show_graph(crn_num,qty_acc,qty_ret,qty_rej,wo_qty,qty_rew)
{
 var crnnum = crn_num;
 var qtyacc = qty_acc;
 var qtyret = qty_ret;
 var qtyrej = qty_rej;
 var woqty = wo_qty;
 var qty_rew = qty_rew;
 var date1 = document.forms[0].bdate1.value;
 var date2 = document.forms[0].bdate2.value;
//alert(crn_num+"--"+qtyacc+"--"+qtyret+"--"+qtyrej);
//alert (qty_rew);
 display_graph(crn_num,qtyacc,qtyret,qtyrej,woqty,date1,date2,qty_rew);
 }
function hide_graph(crn_num){
  var crnnum = crn_num;
  //alert(crnnum);
    document.getElementById('layer1' + crnnum).style.display="none";
     document.getElementById('layer' + crnnum).style.display="none";
}

function GetDate(rt) {
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

function SetDate(dateval,fieldname) {

fn = document.getElementById(fieldname);
//alert(fn);
fn.value = dateval;
}
