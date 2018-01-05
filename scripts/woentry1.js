
	function check_req_fields(){
	    var errmsg='';
  	    if (document.forms[0].company.value == 'Please Specify')
	   {
		 errmsg+="Customer cannot be Please Specify\n";
	   }
	   if (document.forms[0].wonum.value.length == 0)
	   { 
		errmsg+="Work Order # must be entered\n";
	   }
	   if (document.forms[0].ponum.value.length == 0)
	   { 
		errmsg+="PO # must be entered\n";
	   }
	   if (document.forms[0].quotenum.value.length == 0)
	   {
		 errmsg+="Quote # must be entered\n";
	   }
	   if (document.forms[0].contact.value.length == 0)
	   {
		 errmsg+="Contact must be present\n";
	   }
	   if (document.forms[0].contact.value == 'Please Specify')
	   {
		 errmsg+="Contact cannot be Please Specify\n";
	   }
	   if (document.forms[0].owner.value.length == 0)
	   {
		 errmsg+="Designer must be entered\n";
	   }
		   if (document.forms[0].owner.value == 'Please Specify')
	   { 
		errmsg+="Designer cannot be Please Specify\n";
	   }
	   if (document.forms[0].qty1.value.length == 0)
   		{
			 errmsg+="Please enter  \n";
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