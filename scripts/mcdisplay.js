/*
 * mcdisplay.js
 * validation for operator
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
*/



function ShowDetails() 
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
	 ajaxRequest.onreadystatechange = function()
	 {
		 if(ajaxRequest.readyState == 4)
		 {
	        if(ajaxRequest.status == 200)
            {				
			  document.getElementById('machine').innerHTML = ajaxRequest.responseText;				  			 
					$('#news').innerfade({
						animationtype: 'slide',
						speed: 5000,
						timeout: 12000,
						type: 'sequence',
						containerheight: '150px'
					});					

			
		
			$('#news').innerfade({
				animationtype: 'slide',
				speed: 5000,
				timeout: 12000,
				type: 'sequence',
				containerheight: '150px'
			});			
		
		 }
	  }
	 }
	//alert("Here1");
	ajaxRequest.open("POST", "getmachineDetails.php?", true);	
	ajaxRequest.send(null);

}
 
}




