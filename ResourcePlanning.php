<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = April 06, 2010               =
// Filename: project_Summary.php               =
// Copyright of Fluent Technologies            =
// Revision: v1.0 Project_management           =
// Displays list of Projects.                  =
//==============================================

session_start();
header("Cache-control:private");

if ( !isset ( $_SESSION['user'] ) )
{
	header ( "Location: login.php" );
}

$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'project_Summary';
$page="ELM: ResourcePlanning";
include_once('classes/CompanyClass.php');
$companyCls = new Company;
$customerList=$companyCls->getAllCustomers();

?>

<link rel="stylesheet" href="style.css">

<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/project.js"></script>

<style type="text/css">
	.fc-event {
    top: 10px !important;
    background: transparent !important;
    border: 1px  #ffffff !important;
    color: #000 !important;
	}
	.fc-event-icons {
	    float: left;
	    margin-right: 5px;
	}
	.fc-event-inner {
	    width: 20px;
	}
	.fc-icons li{
		margin-left: 10px;
		color: white;
	}

	.fc-widget-content{
		height: 68px !important;
	}

.tralign{
	display:table;
width:100%;
table-layout:fixed;
}
	

</style>





<html>
	<head>
		<title>Project Summary</title>
	</head>

	<link href='assets/css/jquery-ui.css' rel='stylesheet' />
	<link href='assets/css/fullcalendar.css' rel='stylesheet' />
	<link href='assets/css/bootstrap.min.css' rel='stylesheet' />
	<link href='assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />


	<script language="javascript" src='assets/js/moment.min.js'></script>
	<script language="javascript" src='assets/js/jquery.min.js'></script>
	<script language="javascript" src='assets/js/jquery-ui.min.js'></script>
	<script language="javascript" src='assets/js/bootstrap.min.js'></script>
	
	
	<script language="javascript" src='assets/js/fullcalendar.min.js'></script>
	<script type="text/javascript" src="scripts/resource.js"></script>
	
	<script type="text/javascript">
	$(document).ready(function() {
	
	var cid=document.getElementById("sel").value;
	var date = new Date();
    var year = date.getFullYear();
    var month = date.getMonth()+parseInt(1);

    var firstDay = new Date(year, month, 1);
    var lastDay = new Date(year, month + 1, 0);

    if (month < 9) 
    {
      var month = "0" + month;
    }

    var month_first = year + "-" + month +  "-" + firstDay.getDate() ;
    var month_last =  year + "-" + month +  "-" + lastDay.getDate() ;

	    $.ajax({
	      url: 'ProcessResourcePlanning.php',
        type: 'POST', 
        data: 'type=fetch&firstday='+month_first+'&lastday='+month_last+'&cid='+cid,
        async: false,
        dataType: "json",
        success: function(res){
          var events_map = [];
       		$.each(res, function (i, value) {
       			events_map.push(value);

					});
			    loadfullcalendar(events_map,month_first,true);

        },
       	error: function(e) {
          console.log(e.message);
      	}
	    });


	     	
	    var loadFunction=function()
	    {
	    	var moment = $('#calendar').fullCalendar('getDate');

		    monthdate = moment.toDate();

		    getdatamonthclick(monthdate);
	    }
	   	$('.fc-prev-button').click(loadFunction);

		$('.fc-next-button').click(loadFunction);
		$('#sel').change(loadFunction);
		function getdatamonthclick(monthdate) 
		{
			var date = new Date(monthdate);
	    var year = date.getFullYear();
	    var month = date.getMonth()+parseInt(1);

	    var firstDay = new Date(year, month, 1);
	    var lastDay = new Date(year, month + 1, 0);

	    if (month < 9) 
	    {
	       var month = "0" + month;
	    }

	    var month_first = year + "-" + month +  "-" + firstDay.getDate() ;
	    var month_last =  year + "-" + month +  "-" + lastDay.getDate() ;
	    var cid=document.getElementById("sel").value;
	    console.log("date "+ month_first);

	    $.ajax({
	      url: 'ProcessResourcePlanning.php',
        type: 'POST', 
        data: 'type=fetch&firstday='+month_first+'&lastday='+month_last+'&cid='+cid,
        async: false,
        dataType: "json",
        success: function(res){
          var events_map = [];
       		$.each(res, function (i, value) {
       			events_map.push(value);

					});
			    loadfullcalendar(events_map,month_first,false);

			    
		     	
        },
       	error: function(e) {
          console.log(e.message);
      	}
	    });

	
		}

			function loadfullcalendar(events_map,currentDate,isfst)
	    	{

	    	// console.log('currentDate ' + currentDate);
	    	if(isfst){

		    	$('#calendar').fullCalendar({

		    		events:  events_map,
	          ditable: true,
	          selectable: true,
	         	weekMode: 'variable',
	          eventRender: function (event, element) {
	          	
	          	if (typeof event.shift != 'undefined'){

	          		var tbl="<table style='margin-top:-35px; width:90%'>"+
								"<tr style='background-color:{{bgcolor}}; color:{{fgcolor}}'>"+
									"<td>Shift</td>"+
									"<td>Req</td>"+
									"<td>Assi</td>"+
								"</tr>"+
								"<tr>"+
									"<td>Day</td>"+
									"<td >{{dreq}}</td>"+
									"<td >{{dass}}</td>"+
								"</tr>"+
								"<tr>"+
									"<td>DNight</td>"+
									"<td >{{dnreq}}</td>"+
									"<td >{{dnass}}</td>"+
								"</tr>"+
								"<tr>"+
									"<td>Night</td>"+
									"<td>{{nreq}}</td>"+
									"<td>{{nass}}</td>"+
								"</tr>"+
							"</table>";


	  	        	
	  	        	var assigned=0;
	  	        	var required=0;
		           	$.each(event.shift, function(ind, value) {
		           		
		           		if (ind == "day") {
		           			
		           			tbl=tbl.replace("{{dass}}",value)

		           		}else if(ind == "day night"){
		           			tbl=tbl.replace("{{dnass}}",value)
		           		}else if(ind == "night"){
		           			tbl=tbl.replace("{{nass}}",value)
		           		}
		           	
		           		assigned+=parseInt(value);
		           		
		           	
		              
		        
		            });

					$.each(event.requirements, function(ind, value) {
						if (ind == "day") {
							tbl=tbl.replace("{{dreq}}",value)
						}else if(ind == "day night"){
							tbl=tbl.replace("{{dnreq}}",value)
						}else if(ind == "night"){
							tbl=tbl.replace("{{nreq}}",value)
						}

						required+=parseInt(value);

					});
					tbl = tbl.replace("{{dass}}","").replace("{{dnass}}","").replace("{{nass}}","").replace("{{dreq}}","").replace("{{dnreq}}","").replace("{{nreq}}","")
					
					if(assigned==0)
						tbl = tbl.replace("{{bgcolor}}","red").replace("{{fgcolor}}","white");
					else if(required<=assigned)
						tbl = tbl.replace("{{bgcolor}}","green").replace("{{fgcolor}}","white");
					else if(required>=assigned)
						tbl = tbl.replace("{{bgcolor}}","yellow").replace("{{fgcolor}}","black");
		            
		            element.append(tbl);


		          }



						},

		        eventClick: function(event, jsEvent, view) {
		        	console.log("event" + JSON.stringify(event.start));
		        	var cid=document.getElementById("sel").value;
		        	var date = new Date(event.start);
		        	date = date.getFullYear()+"-"+(date.getMonth()+parseInt(1))+"-"+date.getDate();
		        	$.ajax({
				      url: 'ProcessResourcePlanning.php',
			        type: 'POST', 
			        data: 'type=getevent&date='+date+'&cid='+cid,
			        async: false,
			        dataType: "html",
			        success: function(res){

			         $("#listemployee").html(res);
			         $("#schdate").html("Date "+date);
			         $('#calendarModal').modal();


			        },
			       	error: function(e) {
			          console.log(e.message);
			      	}
				    });

		        },

		        viewRender: function(view, element) {


				    },

				    dayClick: function(date, jsEvent, view) {


			        var date = date.format();
			        $.ajax({
					      url: 'ProcessResourcePlanning.php',
				        type: 'POST', 
				        data: 'type=addevent&date='+date,
				        async: false,
				        dataType: "html",
				        success: function(res){

				         $("#AddEvent").html(res);
				         $("#event_title").html(date);
				         $("#shiftdate").val(date);
				         $('#AddEventModal').modal();

				        },
				       	error: function(e) {
				          console.log(e.message);
				      	}
					    });


				    }




		    	});
		    }
		    else{

		    	$('#calendar').fullCalendar( 'removeEvents' );
		    	$('#calendar').fullCalendar( 'addEventSource', events_map, true );
		    }
	    	
	    }



	    
	    $("button#submitForm").click(function(e){
    		var shiftdate = $("#shiftdate").val();
	    	var shift = $("#shift").val();
	    	var shift = $("#shift").val();
	    	var secondary_company = $("#secondary_company").val();
	    	var custrecnum = $("#custrecnum").val();
	    	var userid = $("#userid").val();
	    	var empid = $("#empid").val();
	    	var cid=document.getElementById("sel").value;
	    	$.ajax({
            url: 'ProcessResourcePlanning.php',
            type: "POST",
            data: "type=SubmitSchevent&shiftdate="+ shiftdate +"&shift="+shift+"&custrecnum="+cid+"&empid="+empid,
            success: function(response) {

            	if (response.trim() == "Already Exits") 
            	{
            		$("#errormsg").html("You cannot Assign. Already Exits");
            		return false;
            	}
            	else
            	{
            		$('#AddEventModal').modal('hide');
            		getdatamonthclick(shiftdate);
            	}
            	
            },
            error: function(jqXHR, status, error) {
                console.log(status + ": " + error);
            }
        });
        e.preventDefault();

	    });


		});

		
		


		// $("#submitForm").on('click', function() {
		// 	alert("test");
        // $("#EventForm").submit();
    // });

    


	</script>


	<body leftmargin="0" topmargin="0" marginwidth="0">
	<form action='project_Summary.php' method='GET' enctype='multipart/form-data'>
	<?php
		include('header.html');
	?>

		<div style="margin-bottom: 10px; ">
			<label for="sel" style="font-size: 16px; color: black;"><b>Select Customer</b></label>
			<select id="sel" style="width: 500px; height: 25px;" >
				<?php
				while($row=mysql_fetch_assoc($customerList))
				{
					echo "<option value='".$row['id']."'>".$row['name']."</option>";
				}
				?>
			</select>
			<div style="float:right; width: 100%; margin-top: -30px;">
				<div style='color:black;height:5px; background-color:red;float:right; padding: 5px; '>Not assigned</div>
				<div style='color:black;height:5px; background-color:green;float:right; padding: 5px;'>Fullfilled</div>
				<div style='color:black;height:5px; background-color:yellow;float:right; padding: 5px;'>Partial</div>

			</div>
		</div>

		<div id='calendar'></div>
		<div id="calendarModal" class="modal fade">
		<div class="modal-dialog">
		    <div class="modal-content">
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
		            <h4 id="modalTitle" class="modal-title"></h4>

		        </div>

		        <div id="modalBody" class="modal-body" >
		        	 <center><b><span id="schdate"></span></b></center>
		        	<div id="listemployee"> 
			        	
		        	</div>
		        </div>
		        <div class="modal-footer">
		            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        </div>
		    </div>
		</div>
		</div>

		<div id="AddEventModal" class="modal fade">
		<div class="modal-dialog">
		    <div class="modal-content">
		        <div class="modal-header">
		        	<center><h5 class="modal-title" id="event_title"></h5></center>
		            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>

		        </div>

		        <div id="modalBody" class="modal-body" >
		        	 <center><b><span id="errormsg" style="color: red;"></span></b></center>
		        	<div id="AddEvent"> 
			        	
		        	</div>
		        </div>
		        <div class="modal-footer">
		        		<button type="button" class="btn btn-default" id="submitForm" >Submit</button>
		            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		        </div>
		    </div>
		</div>
		</div>


	</form>
	</body>
</html>