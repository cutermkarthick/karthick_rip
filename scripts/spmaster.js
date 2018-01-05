
function onSelectStatus(status)
{
    //alert("here");
	document.getElementById('status').value = status.value;

     return true;
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
//alert(dateval);
//alert(fieldname);
document.forms[0].elements[fieldname].value = dateval;

}

function GetAllCustomers(rt) {
var param = rt;
var winWidth = 500;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getvendors4spmaster.php?reasontext=" + rt, "Customers", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
function SetCustomer(customer,custaddress) {
var contdet = custaddress.split("|");
document.forms[0].company.value = customer;
document.forms[0].companyrecnum.value= contdet[12] ;

}

function printspmaster(recnum) {
var winWidth = 680;
var winHeight = 500;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printPrice.php?recnum=" + recnum, "printprice",
+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}


function check_req_fields()
{
	//alert ('function working');
	//return false;
    var errmsg = '';
    if (document.forms[0].crnnum.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please Enter CIM Refnumber \n';
    }

     if (document.forms[0].company.value.length == 0)
    {
         errmsg += 'Please Select A Customer\n';
    }
     if (document.forms[0].partnum.value.length == 0)
    {
         errmsg += 'Please enter Part Number\n';
    {
         errmsg += 'Please enter Total Cost\n';
    }
    }
   // alert(document.forms[0].status.value);
   /* if (document.forms[0].status.value== 'Active' )
    {
    if (document.forms[0].saabpartnum.value.length == 0)
    {
         errmsg += 'Please enter SAAB Part Number\n';
    }
     if (document.forms[0].aukpartnum.value.length == 0)
    {
         errmsg += 'Please enter AUK Part Number\n';
    }
    }*/
    if (document.forms[0].qty.value.length == 0)
    {
         errmsg += 'Please enter a Quantity\n';
    }
    if (document.forms[0].price.value.length == 0)
    {
         errmsg += 'Please enter Price\n';
    }
    if (document.forms[0].totalcost.value.length == 0)
    {
         errmsg += 'Please enter Total Cost\n';
    }
   if ((document.getElementById('qty_valid_from').value =="")||(document.getElementById('qty_valid_from').value =="0000-00-00") || (document.getElementById('qty_valid_upto').value =="")||(document.getElementById('qty_valid_upto').value =="0000-00-00"))
    {
         errmsg += 'Please select valid(from & to) date for Qty \n';
    }
    if ((document.getElementById('price_valid_from').value =="")||(document.getElementById('price_valid_from').value =="0000-00-00") || (document.getElementById('price_valid_upto').value =="")||(document.getElementById('price_valid_upto').value =="0000-00-00"))
    {
         errmsg += 'Please select valid(from & to) date for Price \n';
    }
    if ((document.getElementById('totalcost_valid_from').value =="")||(document.getElementById('totalcost_valid_from').value =="0000-00-00") || (document.getElementById('totalcost_valid_upto').value =="")||(document.getElementById('totalcost_valid_upto').value =="0000-00-00"))
    {
         errmsg += 'Please select valid(from & to) date for Total Cost \n';
    }
    //alert(document.getElementById('spstaflag').value);
    if(document.getElementById('pagename').value == 'editspmaster')
    {   // alert("HERE----");
    if (document.getElementById('spstaflag').value == '1')
    {
       errmsg += 'An Active CRN already exists!\n';
    }
   // alert(document.forms[0].status.value);
      if (document.forms[0].status.value== 'Active' )
    {
    if (document.forms[0].saabpartnum.value.length == 0)
    {
         errmsg += 'Please enter SAAB Part Number\n';
    }
     if (document.forms[0].aukpartnum.value.length == 0)
    {
         errmsg += 'Please enter AUK Part Number\n';
    }
    }
    } else
    {
    
      if (document.forms[0].saabpartnum.value.length == 0)
    {
         errmsg += 'Please enter SAAB Part Number\n';
    }
     if (document.forms[0].aukpartnum.value.length == 0)
    {
         errmsg += 'Please enter AUK Part Number\n';
    }
    }
    



     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}

	function getHTTPObject(){
			if (window.ActiveXObject) return new ActiveXObject("Microsoft.XMLHTTP");
			else if (window.XMLHttpRequest) return new XMLHttpRequest();
			else {
			alert("Your browser does not support AJAX.");
			return null;
			}
			}
		function getmaststat()
		{
		//alert("here");
		var crn=document.getElementById('crnnum').value;
    	var status=document.getElementById('status').value;
    	var link2customer= document.getElementById('companyrecnum').value;
    	var recnum=document.getElementById('recnum').value;
		//alert(link2customer);
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
		                      document.getElementById('spmasterstatus').innerHTML = ajaxRequest.responseText;
		                   }
		              }
		      }
		      ajaxRequest.open("POST", "spmastercheck_stat.php?crn="+crn+"&status="+status+"&companyrecnum="+link2customer+"&recnum="+recnum,true);

		      ajaxRequest.send(null);
		      //document.getElementById('getfiles4master_data').innerHTML=
		          //'<img name="progress" id="progress" height="130" width="130" border=0 src="images/progressbar.gif">';
		}

		function change_spec_type()
		{
		  var aind = document.forms[0].spec_val_type.selectedIndex;
          document.forms[0].spec_val.value = document.forms[0].spec_val_type[aind].text;
		}



