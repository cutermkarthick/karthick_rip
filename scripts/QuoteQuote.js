
	function check_req_fields()
	{
    alert("inside check");
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
        if (document.forms[0].quotedate.value.length == 0)
	    {
	         errmsg += "Please enter quote date\n";
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
	         errmsg +=  "Please enter Salesperson\n";
	    }
  /*   if (document.forms[0].excelfile.value.length == 0)
	    {
	         errmsg +=  "Please enter Excel File name\n";
	    }   */

	for(var i=0;i<frm.length;i++)
	{
 	for(var j=1;j<max;j++)
		{
   item1="item_desc"+j;
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
//alert(frm.elements[i].name);
		//	if(frm.elements[i].name==item1  && frm.elements[i].value.length != 0 &&  frm.elements[k+3].value.length == 0 )
		//	{
		//		errmsg +="Rate should be present\n";
		//		flag=1;
		//		break;
		//	}
		}
		if (flag==1)
		break;
	}

 	for(var i=0;i<frm.length;i++)
 {
		for(var j=1;j<max;j++)
		{
   item1="rate"+j;
			var k=i;
			if(frm.elements[i].name==item1)
			{
    x=frm.elements[i].value.length;
				for (var k=0;k<x;k++)
				{
        				temp= "" + document.forms[0].elements[i].value.substring(k,k+1);
					if(valid.indexOf(temp) == -1)
					{
						errmsg +="Rate should be numbers only\n";
                                               break;
					}
				}
			}
			item1="quantity"+j;
   var k=i;

			if(frm.elements[i].name==item1)
			{
				x=frm.elements[i].value.length;
				for (var k=0;k<x;k++)
				{
        				temp= "" + document.forms[0].elements[i].value.substring(k,k+1);
					if(valid.indexOf(temp) == -1)
					{
						errmsg +="Quantiy should be numbers only\n";
                                               break;
					}
				}
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