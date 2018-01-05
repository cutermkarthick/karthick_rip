
function check_req_fields()
{
  	var errmsg='';
   // alert('before');
        var wo_num = document.getElementById('wo_num').value;
        if(document.getElementById('wo_num').value == 0 || document.getElementById('wo_num').value =='')
       {

           errmsg +='Please Enter A WO#\n';

       }
       if (errmsg == '')
    {
  		return true;
    }
    else
    {
        alert (errmsg);
        return false;
    }
}

function display_details()
{
  var wo_num = document.getElementById('wo_num').value;
 alert(wo_num+'here');
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

                 document.getElementById('woDisp').innerHTML = ajaxRequest.responseText;

		      }
	        }
	}
	//alert("Here1");
	ajaxRequest.open("POST", "processWoDisp.php?wo_num="+wo_num,true);
	ajaxRequest.send(null);

}

 function putfocus()
{
   document.forms[0].company.focus();
}



