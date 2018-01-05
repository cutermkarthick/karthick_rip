function check_req_fields()
{  
    var errmsg = '';  
    if (document.forms[0].mc_name.value == 'select' )
    {
         errmsg += 'Please Enter Machine Name \n';
    }
	if(document.forms[0].mc_name.value!='select')
	{
       document.forms[0].mc_id.value=document.forms[0].mc_name.value;
	}
	var avail_capacity=parseInt(document.forms[0].avail_capacity.value);  
	if(isNaN(avail_capacity)) 
	{
           errmsg += 'Please Enter correct Avail Capacity \n';
	}
	if (document.forms[0].month.value =='select' )
    {
         errmsg += 'Please Enter Month \n';
    }
	if (document.forms[0].year.value =='select' )
    {
         errmsg += 'Please Enter Year \n';
    }
	if (document.forms[0].mc_series.value =='' )
    {
         errmsg += 'Please Enter M/C Series \n';
    }

     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}

function GetCIM(rt) 
{
	//alert(rt);
	var param = rt;
	var winWidth = 1000;
	var winHeight = 300;
	var winLeft = (screen.width-winWidth)/2;
	var winTop = (screen.height-winHeight)/2;
	win1 = window.open("getCIM.php", param, +
	"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
	",width=" + winWidth + ",height=" + winHeight +
	",top="+winTop+",left="+winLeft);
}
function SetCIM(CIMarr,fieldname)
{
	var CIMdet = CIMarr.split("|");
	document.forms[0].crnnum.value = CIMdet[9];
	document.forms[0].partnum.value = CIMdet[4];
}

function Getmachine(rt) 
{
	var param = rt;
	var winWidth = 600;
	var winHeight = 300;
	var winLeft = (screen.width-winWidth)/2;
	var winTop = (screen.height-winHeight)/2;
	win1 = window.open("get_machine.php", param, +
	"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
	",width=" + winWidth + ",height=" + winHeight +
	",top="+winTop+",left="+winLeft);
}

function Set_machine(CIMarr,fieldname)
{
	var CIMdet = CIMarr.split("|");
	document.forms[0].mc_id.value = CIMdet[1];
	document.forms[0].mc_name.value = CIMdet[2];
	document.forms[0].mc_series.value = CIMdet[3];
}

function check_req_import()
{
    if (document.forms[0].import_text.value == '' )
    {
         alert('Please Import some data\n');
		 return false;
    }
}

function check_req_fields_prodn_sch()
{
    var errmsg = '';	
	var lipresent = 0;	
    if (document.forms[0].mc_id.value.length == 0 )
    {
         errmsg += 'Please Enter Machine ID\n';
		  document.forms[0].mc_id.value='';
    }
	 if (document.forms[0].month.value =='select' )
    {
         errmsg += 'Please Enter Month \n';
    }
	 if (document.forms[0].year.value =='select' )
    {
         errmsg += 'Please Enter Year \n';
    }
    if (document.forms[0].crnnum.value.length == 0 )
    {
         errmsg += 'Please Enter CRN \n';
		 document.forms[0].crnnum.value='';
    }
	var runtime=parseInt(document.forms[0].runtime.value);  
	if(isNaN(runtime)) 
	{
           errmsg += 'Please Enter correct Runtime.Hr \n';
		   document.forms[0].runtime.value='';

	}
    if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}

function fetch_cap_req(inparg)
{
 var errmsg = '';
 var subval = ''
 if (inparg == 'getschedule')
 {
	 subval = 'Get_Schedule';
 }
 if (document.forms[0].mc_series.value == 'select' )
    {
         errmsg += 'Please Enter M/C Series\n';		 
    }
    if (document.forms[0].frm.value == '' )
    {
         errmsg += 'Please Enter Start Dare \n';		
    }
	 if (document.forms[0].to.value == '' )
    {
         errmsg += 'Please Enter End Date \n';		
    }
	if (errmsg == '') {
        //document.forms[0].Submit.value = subval;
	    //alert(subval);
		//document.forms[0].submit();
		return true;
	}
    else
    {
       alert (errmsg);
       return false;
    }
}
function getmc_series(element) 
{
	document.forms[0].mc_series.value=element.value;
}
function calbal_qty(i)
{	
	
	var req_rt_perunit =  0;
	var balance_crn_hrs = 0;
	var ff_qty_hrs = 0 ;
	var req_crn_qty1 = 0;
	var req_crn_qty=0;
	var mc_avail_hrs = 0;
	var mc_avail_hrs=  parseInt(document.getElementById('mc_avail_hrs'+i).value);
	var req_crn_hrs=0;
	var prev_mc = document.getElementById('mc_name'+i).value;
	var currmc = '';
	var flag = 0;
	var ftflag = 0;
	var p=i;
	var q=i+1;
	var crn_arr =new Array();
	var prev_bal_crn_qty='';
	var prev_crn = ''; 

	var pre_crn = document.getElementById('crn_'+i).value;	
	var mc_n =new Array(); 
	var max_val= document.getElementById('max_val').value;
	var end_date = '';
	var end_time1 = '';
	var meridian = 'am';
	var end_time = '';
	var start_date = '';
	var start_time = '';

	while (flag == 0)
	{
		if(document.getElementById('mc_name'+i) ==  undefined)
			break;

		if((prev_mc == document.getElementById('mc_name'+i).value))
		{

			if((end_date != '' && end_date != '0000-00-00') && end_time1 != '')
			{
				// console.log('inside if '+ i);
				// console.log('meridian '+ i + " " + meridian);

				document.getElementById('start_date'+i).value =end_date;
			    document.getElementById('time_sel'+i).value = end_time;
			    document.getElementById('time'+i).value = end_time1;
			    
			    
			}
			
				

			var crn=document.getElementById('crn_'+i).value;	

		    if(ftflag == 1)
		    {
			    mc_avail_hrs=balance_mc_hrs;
			    // alert(balance_mc_hrs)
			    // document.getElementById('mc_avail_hrs'+i).value=balance_mc_hrs;
		    }

		    req_rt_perunit=  (document.getElementById('req_rt_perunit'+i).value);
		    blank=  (document.getElementById('blank'+i).value);
		    blank_hrs = parseFloat(req_rt_perunit) / parseInt(blank);
		    // console.log("blank_hrs " + blank_hrs);


	        req_crn_qty1= parseInt(document.getElementById('req_crn_qty'+i).value);
	        if(isNaN(document.getElementById('req_crn_qty'+i).value) == true)
			{
			    alert('Please Enter number only');
			    document.getElementById('req_crn_qty'+i).value='';
			    return false;
			}



			ff_qty_hrs=parseInt(document.getElementById('ff_qty_hrs'+i).value);
			balance_crn_hrs=parseInt(document.getElementById('balance_crn_hrs'+i).value);
	        req_crn_qty=((document.getElementById('req_crn_qty'+i).value) == '')?'0':req_crn_qty1;

	        document.getElementById('req_crn_hrs'+i).value=Math.round(blank_hrs*req_crn_qty);

	        req_crn_hrs=parseInt(document.getElementById('req_crn_hrs'+i).value);
	        currmc = document.getElementById('mc_name'+i).value;

	        if(pre_crn == document.getElementById('crn_'+i).value)
		    {

		    	if(mc_avail_hrs >= req_rt_perunit)
			    {			
				    if(req_rt_perunit>0)
	                var possible_qty=Math.round(mc_avail_hrs/blank_hrs);
				    else
				    var possible_qty=0;		
	   
				    if(possible_qty > req_crn_qty)
				    {
					    var balance_crn_qty=0;
					    var balance_mc_hrs=Math.round(mc_avail_hrs-(req_crn_qty*blank_hrs));				
					    var balance_crn_hrs=0;
				    }			  
				    else if(possible_qty <= req_crn_qty)
				    {
					    var balance_crn_qty=req_crn_qty-possible_qty;				
					    var balance_mc_hrs=Math.round(mc_avail_hrs-(possible_qty*blank_hrs));
					    var balance_crn_hrs=Math.round(req_crn_hrs-(possible_qty*blank_hrs));
				    }	

			    }
			    else if(mc_avail_hrs < req_rt_perunit)
			    {
				    var balance_crn_hrs=req_crn_hrs;		
				    var balance_crn_qty=req_crn_qty;
				    var balance_mc_hrs=mc_avail_hrs;
			    }

		    }
		    else
			{  
			    var balance_crn_hrs=req_crn_hrs;		
				var balance_crn_qty=req_crn_qty;
				var balance_mc_hrs=mc_avail_hrs;
			}

			if(req_crn_qty ==  balance_crn_qty)
	        {
				var str = '<ul><li style="color: red"  type=square></li></ul>';			
	        }
		    else if(balance_crn_qty == 0)
	        {
	            var str = '<ul><li style="color: green"  type=square></li></ul>';		
	        }
		    else if(req_crn_qty-balance_crn_qty> 0)
	        {
	            var str = '<ul><li style="color: orange"  type=square></li></ul>';		
	        }
		    // document.getElementById('status'+i).innerHTML=str;
		    // document.getElementById('balance_crn_qty'+i).value=balance_crn_qty;
		    // document.getElementById('balance_crn_hrs'+i).value=Math.abs(balance_crn_hrs);
	     //    document.getElementById('balance_mc_hrs'+i).value=Math.abs(balance_mc_hrs);

	        start_date= document.getElementById('start_date'+i).value;
		    start_time=document.getElementById('time_sel'+i).value;	
		    

		    if(document.getElementById('time'+i).value  == 0)
		    document.getElementById('time'+i).value=document.getElementById('time_sel'+p).value;

		    start_time1=document.getElementById('time'+i).value;
		    console.log("start time " + start_time1);
		    var start_timearr = start_time1.split(" ");

		  // alert(start_time1);  

		    var meridian =start_time1.substr(start_time1.length-2).toLowerCase();
		    var hrs    = start_time1.substring(0, start_time1.indexOf(' '));



	        document.getElementById('time_sel'+i).innerHTML = "";
	        var select = document.getElementById('time_sel'+i) ;

	        for(se = 0; se < 24 ; se++) 
	        {	
	        	if (start_timearr[1] == 'PM' && start_timearr[0] != 12) 
	        	{	
	        		start_time = parseInt(start_timearr[0])+parseInt(12);
	        	}
	        	else if(start_timearr[1] == 'AM' && start_timearr[0] == 12)
	        	{
	        		start_time = 0;
	        	}
			        var opt = document.createElement('option');
			        
                    if(se == 0){ 
                    	opt.value = se;
                    	opt.text = ' 12 AM';
                    	select.appendChild(opt);
                    	if (se == start_time) 
	               		{
	               			opt.setAttribute('selected','selected');
	               		}
                    }
                    else if(se == 12)
                    {
                    	opt.value = se;
                    	opt.text =  ' 12 PM';
                    	select.appendChild(opt);
                    	if (se == start_time) 
	               		{
	               			opt.setAttribute('selected','selected');
	               		}
                   	}
                   	else if(se < 13){
                   		
                    	opt.value = se;
                    	opt.text = se + ' AM';
                    	select.appendChild(opt);
                    	if (se == start_time) 
	               		{
	               			opt.setAttribute('selected','selected');
	               		}
                    }
                    else if(se > 12){
                    	
                    	opt.value = se;
                    	opt.text = (parseInt(se) - 12) + ' PM';
                    	select.appendChild(opt);
                    	if (se == start_time) 
	               		{
	               			opt.setAttribute('selected','selected');
	               		}
                   	}
	        }


			var orderDate=new Date(start_date);
		
			var endDate= new Date(start_date);
			var hours=Math.round(document.getElementById('req_crn_hrs'+i).value);
			var avail_units=document.getElementById('units'+i).value;
			var avail_shift=document.getElementById('shift'+i).value;

			
			// var convert_days = hours/6000;
   			// var convert_hrs = Math.floor(convert_days*24*60*60) / (60*60);
   			

   			if (avail_units == "strokes") {

   				if (avail_shift == 1) {
   					// stores_per_shift = 2000;
   					t_hrs = mc_avail_hrs/24;
   					shift_hr = 8;
   				}else if(avail_shift == 2){
   					// stores_per_shift = 4000;
   					t_hrs = mc_avail_hrs/24;
   					shift_hr = 16;
   				}else if(avail_shift == 3){
   					// stores_per_shift = 6000;
   					t_hrs = mc_avail_hrs/24;
   					shift_hr = 24;
   				}

   				// per_hr = t_hrs/shift_hr;
       			// total_hrs = ff_qty_hrs/per_hr;
       			// days=parseInt(total_hrs/shift_hr);
   				// hours1=total_hrs%shift_hr;

   				per_hr=parseInt(mc_avail_hrs/(24*shift_hr));
   				storesperreq = parseInt(ff_qty_hrs/per_hr)
				days=parseInt(storesperreq/shift_hr);
				hours=storesperreq%shift_hr;



   			}
   			else
   			{
   				days=parseInt(ff_qty_hrs/24);
			 	hours=ff_qty_hrs%24;
   			}


   			ff_qty_hrs1 = parseInt(start_timearr[0])+parseInt(ff_qty_hrs);
			// echo "time ".$time. "req ".$req_crn_hrs."<br>";
			console.log("ff qty hrs " + ff_qty_hrs1);


			

   			// else{
   				// console.log("if four")
   	// 			var hours1 = hours%24;	
				// var days = parseInt(ff_qty_hrs/24);
   			// }
			
	           
	        var total_hrs=parseInt(hours)+parseInt(start_time);
	        
	        
	        // console.log("days " + days);
	        console.log("total hrs " + total_hrs);

	        if(total_hrs >= 24)
	        {		
				days = days + 1;
				endDate.setDate(orderDate.getDate() + days);
				//end_time = hours1 - 24;
				end_time = total_hrs - 24;
	        }
			else
		    {				
	            endDate.setDate(orderDate.getDate() + days);
				end_time = total_hrs;

				// console.log("end time " + end_time);
	        }

	        var suffex = (end_time >= 12 )? 'PM' : 'AM';
	        // if (end_time == 24) 
	        // {
	        // 	suffex = 'AM';
	        // }
	        // console.log("end time " + end_time);

			var month1 = endDate.getMonth()+1;
			if(month1 <=9)
				month1='0'+month1;
			else
				month1=month1;

			var days1   = endDate.getDate();
		
			if(days1 <=9)
				days1='0'+days1;
			else
				days1=days1;

			var year1  = endDate.getFullYear();	

			if(start_date !='' && start_date != '0000-00-00')
			{
				end_date=year1+'-'+month1+'-'+days1;	
			    	
				end_time =parseInt((end_time + 11) % 12 + 1);			
				end_time = (end_time == '00')? 12 : end_time;
				end_time1=end_time+' '+suffex;
				end_suff=suffex;

			}
			else
			{
				end_date='';
				end_time1='';
			}



			document.getElementById('end_date'+i).value=end_date;			
			document.getElementById('ed_time'+i).value=end_time1;

			if(prev_crn == crn && prev_crn != '')
		    {		
	           document.getElementById('req_crn_qty'+i).value= prev_bal_crn_qty;
			   crn_arr[crn]=prev_bal_crn_qty;			
			}
			else
			{
				crn_arr[crn]=balance_crn_qty;				
			}

			ftflag = 1;

			prev_crn=document.getElementById('crn_'+i).value;
			prev_bal_crn_qty=document.getElementById('balance_crn_qty'+i).value;
			mc_n[document.getElementById('mc_name'+i).value]=crn;


		}
		else if((prev_mc != document.getElementById('mc_name'+i).value) )
		{
			flag = 1;
		}

		i = i + 1;

	}


}


function GetDate(rt) 
{
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

function SetDate(dateval,fieldname)
{	
	// var chunks = dateval.split("-");
	// if(chunks[2] < 10)
	// 	chunks_day='0'+chunks[2];
	// else
	// 	chunks_day=chunks[2];
	// dateval=chunks[0]+'-'+chunks[1]+'-'+chunks_day;
    document.forms[0].elements[fieldname].value = dateval;	
	win1.close();
	calling_start_date(fieldname);	
}

// function SetDate(dateval,fieldname) {

// document.forms[0].elements[fieldname].value = dateval;

// }


function calling_start_date(fieldname)
{
	var chunks = fieldname.split("start_date");	
	calbal_qty_select_date(parseInt(chunks[1]));
	window.close();
}
function fetch_month_year(mcseries)
{
	 var errmsg = '';
	 var series = mcseries;
	 var planmonth = document.forms[0].plan_month.value;
	 var planyear = document.forms[0].plan_year.value;
    if (document.forms[0].plan_month.value == 'select')
    {
         errmsg += 'Please select Month \n';		
    }
	 if (document.forms[0].plan_year.value == 'select')
    {
         errmsg += 'Please select Year \n';		
    }
	if (errmsg == '')
	{			
		if(confirm("Are You Sure you want to Delete plan for "+mcseries))
		{			
          return true;
		}
		else
		{
			return false;
		}
	}
    else
    {
       alert (errmsg);
       return false;
    }
}

function onSelecttime(i)
{ 
		var aind =document.getElementById('time_sel'+i).selectedIndex;		
        document.getElementById('time'+i).value = document.getElementById('time_sel'+i)[aind].text;		
		calbal_qty(i);
 }


function calbal_qty_select_date(i)
{
	var mc_avail_hrs = 0;
	var req_rt_perunit =  0;
	var ff_qty_hrs = 0 ;
	var req_crn_qty1 = 0;
	var balance_crn_hrs = 0;
	var req_crn_qty=0;
	var mc_avail_hrs=  parseInt(document.getElementById('mc_avail_hrs'+i).value);
	var req_crn_hrs=0
	var flag = 0;
	var prev_mc = document.getElementById('mc_name'+i).value;
	var currmc = '';
	var ftflag = 0;
	var p=i; 
	var q=i+1;
	var  max_val= document.getElementById('max_val').value;
	var crn_arr =new Array();    
	var prev_crn = document.getElementById('crn_'+i).value; 
	var end_date = '';
	var end_time1 = '';
	var end_time = '';
	var pre_crn = ''; 


	while (flag == 0)
    {		
    	if(document.getElementById('mc_name'+i) ==  undefined)
			break;

		if((prev_mc == document.getElementById('mc_name'+i).value)  )
		{
			if((end_date != '' && end_date != '0000-00-00') && end_time1 != '')
			{
				document.getElementById('start_date'+i).value =end_date;
			    // document.getElementById('time_sel'+i).value = '0';
			    // document.getElementById('time'+i).value = end_time1;
			}

			var crn=document.getElementById('crn_'+i).value;

		    if(ftflag == 1)
		    {
			    mc_avail_hrs=balance_mc_hrs;
			    // document.getElementById('mc_avail_hrs'+i).value=balance_mc_hrs;
			    
		    }

		    req_rt_perunit=  (document.getElementById('req_rt_perunit'+i).value);	 
		    blank=  (document.getElementById('blank'+i).value);
		    blank_hrs = parseFloat(req_rt_perunit) / parseInt(blank);

	        req_crn_qty1= parseInt(document.getElementById('req_crn_qty'+i).value);
	        if(isNaN(document.getElementById('req_crn_qty'+i).value) == true)
			{
			    alert('Please Enter number only');
			    document.getElementById('req_crn_qty'+i).value='';
			    return false;
			}


			ff_qty_hrs=parseInt(document.getElementById('ff_qty_hrs'+i).value);
	        balance_crn_hrs=parseInt(document.getElementById('balance_crn_hrs'+i).value);
	        req_crn_qty=((document.getElementById('req_crn_qty'+i).value) == '')?'0':req_crn_qty1;

	        document.getElementById('req_crn_hrs'+i).value=Math.round(blank_hrs*req_crn_qty);

	        req_crn_hrs=parseInt(document.getElementById('req_crn_hrs'+i).value);
		    currmc = document.getElementById('mc_name'+i).value;

		    if(prev_crn == document.getElementById('crn_'+i).value)
		    {
	            if(mc_avail_hrs >= req_rt_perunit)
			    {			
				    if(req_rt_perunit>0)
	                    var possible_qty=Math.round(mc_avail_hrs/blank_hrs);
				    else
				        var possible_qty=0;		
	  		   
				    if(possible_qty > req_crn_qty)
				    {
					   var balance_crn_qty=0;
					   var balance_mc_hrs=Math.round(mc_avail_hrs-(req_crn_qty*blank_hrs));				
					   var balance_crn_hrs=0;
				    }			  
				    else if(possible_qty <= req_crn_qty)
				    {
					    var balance_crn_qty=req_crn_qty-possible_qty;
					    var balance_mc_hrs=Math.round(mc_avail_hrs-(possible_qty*blank_hrs));				   
					    var balance_crn_hrs=Math.round(req_crn_hrs-(possible_qty*blank_hrs));
				    }			   
			    }	
			    else if(mc_avail_hrs < req_rt_perunit)
			    {
				    var balance_crn_hrs=req_crn_hrs;		
				    var balance_crn_qty=req_crn_qty;
				    var balance_mc_hrs=mc_avail_hrs;
			    }
			}
			else
			{
				var balance_crn_hrs=req_crn_hrs;		
				var balance_crn_qty=req_crn_qty;
				var balance_mc_hrs=mc_avail_hrs;
			}

			if(req_crn_qty ==  balance_crn_qty)
	        {
				var str = '<ul><li style="color: red"  type=square></li></ul>';			
	        }
		    else if(balance_crn_qty == 0)
	        {
               var str = '<ul><li style="color: green"  type=square></li></ul>';		
	        }
		    else if(req_crn_qty-balance_crn_qty> 0)
	        {
               var str = '<ul><li style="color: orange"  type=square></li></ul>';		
	        }

	        // document.getElementById('status'+i).innerHTML=str;
		    // document.getElementById('balance_crn_qty'+i).value=balance_crn_qty;
		    // document.getElementById('balance_crn_hrs'+i).value=balance_crn_hrs;
      //       document.getElementById('balance_mc_hrs'+i).value=balance_mc_hrs;

		    start_date= document.getElementById('start_date'+i).value;
		    start_time=document.getElementById('time_sel'+i).value;

		    // if(document.getElementById('time'+i).value  == 0)
		    // document.getElementById('time'+i).value=document.getElementById('time_sel'+p).value;  

			start_time1=document.getElementById('time'+i).value;
		    // console.log("start time " + start_time1);
		    var start_timearr = start_time1.split(" ");

		    var meridian =start_time1.substr(start_time1.length-2).toLowerCase();
		    var hrs    = start_time1.substring(0, start_time1.indexOf(' '));

		    var orderDate=new Date(start_date);			
		    var endDate= new Date(start_date);

		    var hours=Math.round(document.getElementById('req_crn_hrs'+i).value);
			var avail_units=document.getElementById('units'+i).value;
			var avail_shift=document.getElementById('shift'+i).value;

			// var convert_days = hours/6000;
   			// var convert_hrs = Math.floor(convert_days*24*60*60) / (60*60);
   			if (avail_units == "strokes") {

   				if (avail_shift == 1) {
   					// stores_per_shift = 2000;
   					t_hrs = mc_avail_hrs/24;
   					shift_hr = 8;
   				}else if(avail_shift == 2){
   					// stores_per_shift = 4000;
   					t_hrs = mc_avail_hrs/24;
   					shift_hr = 16;
   				}else if(avail_shift == 3){
   					// stores_per_shift = 6000;
   					t_hrs = mc_avail_hrs/24;
   					shift_hr = 24;
   				}

   				// per_hr = t_hrs/shift_hr;
		       	// total_hrs = ff_qty_hrs/per_hr;
		       	// days=parseInt(total_hrs/shift_hr);
		       	// hours1=total_hrs%shift_hr;

   				per_hr=parseInt(mc_avail_hrs/(24*shift_hr));
   				storesperreq = parseInt(ff_qty_hrs/per_hr)
				days=parseInt(storesperreq/shift_hr);
				hours=storesperreq%shift_hr;


                // console.log("days " + days);
                // console.log("hours " + hours1);
   			}
   			else
   			{
   				var hours1 = ff_qty_hrs%24;	
				var days = parseInt(ff_qty_hrs/24);
   			}

		    var total_hrs=parseInt(hours1)+parseInt(start_time);         

            if (total_hrs > 24)
            {
			    days = days + 1;
				endDate.setDate(orderDate.getDate() + days);
				end_time = total_hrs - 24;
				// end_time_ref = end_time;
            }
			else
		    {
                endDate.setDate(orderDate.getDate() + days);
				end_time = total_hrs;
				// end_time_ref = total_hrs;
            }

            var month1 = endDate.getMonth()+1;
			if(month1 <=9)
				month1='0'+month1;
			else
				month1=month1;
			var days1   = endDate.getDate();
			if(days1 <=9)
				days1='0'+days1;
			else
				days1=days1;

			var year1  = endDate.getFullYear();			
			if(start_date !='' && start_date != '0000-00-00')
			{
				end_date=year1+'-'+month1+'-'+days1;	
			    var suffex = (end_time >= 12)? 'PM' : 'AM';	
				end_time = parseInt((end_time + 11) % 12 + 1);
				end_time = (end_time == '00')? 12 : end_time;
				end_time1=end_time+' '+suffex;
			}
			else
			{
				end_date='';
				end_time1='';
			}
			
			document.getElementById('end_date'+i).value=end_date;			
			// document.getElementById('ed_time'+i).value=end_time1;

			if(pre_crn == crn && pre_crn != '')
		    {		
	           document.getElementById('req_crn_qty'+i).value= prev_bal_crn_qty;
			   crn_arr[crn]=prev_bal_crn_qty;			
			}
			else
			{
				crn_arr[crn]=balance_crn_qty;				
			}

					
			ftflag = 1;

		}
		else if((prev_mc != document.getElementById('mc_name'+i).value) ) 
		{
			flag = 1;
		}
		i = i + 1;

	}
}