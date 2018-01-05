	function GetAllEmps(rt) 
		{
		
		var param = rt;
		var winWidth = 300;
		var winHeight = 300;
		var winLeft = (screen.width-winWidth)/2;
		var winTop = (screen.height-winHeight)/2;
		win1 = window.open("getallemps.php?reasontext=" + rt, "Employees", +
			"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
			",width=" + winWidth + ",height=" + winHeight + 
			",top="+winTop+",left="+winLeft);
		}
	function SetEmp(emp,emprecnum) 
		{
		document.forms[0].salesperson.value = emp;
		document.forms[0].salespersonrecnum.value = emprecnum;
		}




	function check_req_fields()
	{
	var errmsg='';
	var valid="0,1,2,3,4,5,6,7,8,9,.";
	var valid1="0,1,2,3,4,5,6,7,8,9";
	var ok="yes";
	var temp;
	var frm=document.forms[0];
	var max=document.forms[0].index.value;
	var frm=document.forms[0];
	var flag=0;
  	    if (document.forms[0].company.value.length == 0) 
		{
	        errmsg += "Please select Customer\n";
	    	}
	    else
		{
		if(document.forms[0].company.value=='Please Specify')
			{
			errmsg += "Please Specify is not allowed for Customer\n";
			}
		}
	    if (document.forms[0].quoteid.value.length == 0) 
	    {
	         errmsg += "Please enter Quote Id\n";
	    }
	
	    if (document.forms[0].desc.value.length == 0) 
	    {
	         errmsg +=  "Please enter Quote Description\n";
	    }
	
	    if (document.forms[0].salesperson.value.length == 0) 
	    {
	         errmsg +=  "Please enter Sales Person\n";
	    }
	    else
		{
		if(document.forms[0].salesperson.value=='Please Specify')
			{
			errmsg += "Please Specify is not allowed for Sales Person\n";
			}
		}


	    if (document.forms[0].excelfile.value.length == 0) 
	    {
	         errmsg +=  "Please enter Excel File name\n";
	    }



	for(var i=0;i<frm.length;i++)
	{
		for(var j=1;j<max;j++)
		{
			item1="item"+j;
			var k=i;
			if(frm.elements[i].name==item1  && frm.elements[i].value.length != 0 &&  frm.elements[k+1].value.length == 0 && frm.elements[k+2].value.length == 0)
			{

				errmsg +="Rate and Qty should be present \n";
				flag=1;
				break;
			}
			if(frm.elements[i].name==item1  && frm.elements[i].value.length != 0 &&  frm.elements[k+1].value.length == 0 )
			{

				errmsg +="Qty should be present\n";
				flag=1;
				break;
			}
			if(frm.elements[i].name==item1  && frm.elements[i].value.length != 0 &&  frm.elements[k+3].value.length == 0 )
			{

				errmsg +="Rate should be present\n";
				flag=1;
				break;
			}
		}

		if (flag==1)
		break;
	}
	  
    for (var i=1;i<max;i++)
	{
	rate="rate"+i;

	qty="quantity"+i;
	for (var j=0;j<document.forms[0].elements[rate].value.length;j++)
	{


        		temp= "" + document.forms[0].elements[rate].value.substring(j,j+1);
		if(valid.indexOf(temp) == -1)
		{
			errmsg +="Rate should be numbers only\n";
                                                break;
		}
	}

	for (var j=0;j<document.forms[0].elements[qty].value.length;j++)
	{
       		temp= "" + document.forms[0].elements[qty].value.substring(j,j+1);
		if(valid1.indexOf(temp) == -1)
		{
			errmsg +="Quantiy should be numbers only\n";
                                                break;
		}
	}


	}


	  /* if (document.forms[0].long1.value.length == 0)
   		{

			 errmsg+="Please enter pppppppp \n";
		}if (document.forms[0].qty1.value.length == 0)
   		{
			 errmsg+="Please enter  \n";
		}  */


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
