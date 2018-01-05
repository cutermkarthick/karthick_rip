
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
	   if (document.forms[0].char1.value.length == 0)
   		{
			 errmsg+="Please enter WO# \n";
		}if (document.forms[0].string1.value.length == 0)
   		{
			 errmsg+="Please enter Desc \n";
		}var i=1;	
	var flag=0;
	var frm=document.forms[0];
	var max=document.forms[0].max.value;
	for(var i=0;i<frm.length;i++)
	{
		for(var j=1;j<max;j++)
		{
			number="number"+j;
			var k=i;
			if(frm.elements[i].name==number  && frm.elements[i].value.length != '')
			{
			          var valid="0,1,2,3,4,5,6,7,8,9";
			          var ok="yes";
			          var temp;
		   	          for (var k=0;k < frm.elements[i].value.length;k++)
		                          {
				temp= "" + frm.elements[i].value.substring(k,k+1);
				if(valid.indexOf(temp)== "-1")
				ok="no";
			           }
		                           if(ok=="no")
	  	                          {
				errmsg +="Enter Numeric Values instead of  " + frm.elements[i].value + " \n";
				flag=1;
				break;
		 	           }
			}
			floatval="floatval"+j;
			var k=i;
			if(frm.elements[i].name==floatval  && frm.elements[i].value.length != '')
			{
			          var valid="0,1,2,3,4,5,6,7,8,9,.";
			          var ok="yes";
			          var temp;
		   	          for (var k=0;k < frm.elements[i].value.length;k++)
		                          {
				temp= "" + frm.elements[i].value.substring(k,k+1);
				if(valid.indexOf(temp)== "-1")
				ok="no";
			           }
		                           if(ok=="no")
	  	                          {
				errmsg +="Enter Decimal Values  instead of  " + frm.elements[i].value + " \n";
				flag=1;
				break;
		 	           }
			}
			qty="qty"+j;
			var k=i;
			if(frm.elements[i].name==qty  && frm.elements[i].value.length != '')
			{
			         
			          var valid="0,1,2,3,4,5,6,7,8,9";
			          var ok="yes";
			          var temp;
		   	          for (var k=0;k < frm.elements[i].value.length;k++)
		                          {
				temp= "" + frm.elements[i].value.substring(k,k+1);
				if(valid.indexOf(temp)== "-1")
				ok="no";
			           }
		                           if(ok=="no")
	  	                          {
				errmsg +="Enter numeric value  instead of  " + frm.elements[i].value + " \n";
				flag=1;
				break;
		 	           }
			}
			var partqty="partqty"+j;
			if(frm.elements[i].name==partqty  && frm.elements[i].value.length != '')
			{
				 if(frm.elements[i+1].value.length == '')
			         {
				errmsg +="You should enter qty for this Part#\n";
			         }
		                          

			}

		}
		if (flag==1)
		break;
	}
 	var max=document.forms[0].max.value;

if (document.forms[0].hidpname.value=='WoEntry'){
	flag=0;
	for(var j=1;j<max;j++)
	{
	          k=j;
	          datec="dates" + j;
	if (flag == 1 && document.forms[0].elements[datec].value!='')
	{
		   errmsg+="Previous milestone is not completed\n";		 

	}

	if (document.forms[0].elements[datec].value=='')
	  {
	   flag=1;
	  }
              }

}

if (document.forms[0].hidpname.value=='WodetailsEdit'){

	flag=0;
	for(var j=1;j<max;j++)
	{
	          k=j;
	          datec="datec" + j;
	if (flag == 1 && document.forms[0].elements[datec].value!='')
	{
		   errmsg+="Previous milestone is not completed\n";		 

	}

	if (document.forms[0].elements[datec].value=='')
	  {
	   flag=1;
	  }
              }
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