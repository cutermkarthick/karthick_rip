<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = September 25, 2006           =
// Filename: tasklistsummary.php               =
// Copyright of Badari Mandyam, FluentSoft     =
// Revision: v1.0 OWT                          =
// Displays list of tasks.                     =
//==============================================

session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'tasklistsummary';
//session_register('pagename');

$page = "Utillities: Calendar";

?>


<link rel="stylesheet" href="style.css">


<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/tasklist.js"></script>

<html>
<head>
<title>Tasklist Summary</title>
</head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href='assets/css/fullcalendar.css' rel='stylesheet' />
<link href='assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />

<script src='assets/js/moment.min.js'></script>
<script src='assets/js/jquery.min.js'></script>
<script src='assets/js/jquery-ui.min.js'></script>
<script src='assets/js/fullcalendar.min.js'></script>

<style type="text/css">
    .fc-event{
        cursor: pointer;
    }
</style>

<script type="text/javascript">
    
    $(document).ready(function() {

            $( "#datepicker" ).datepicker({
               showOn:"button",
               buttonImage: "images/bu-getdateicon.gif",
               buttonImageOnly: true,
               dateFormat: 'yy-mm-dd'
            });
        

        var date = new Date();
        var year = date.getFullYear();
        var month = date.getMonth();

        var firstDay = new Date(year, month, 1);
        var lastDay = new Date(year, month + 1, 0);

        if ((date.getMonth()+1) < 9) 
        {
           var month = "0" + (date.getMonth()+1);
        }

        var month_first = year + "-" + month +  "-" + firstDay.getDate() ;
        var month_last =  year + "-" + month +  "-" + lastDay.getDate() ;


        $.ajax({
          url: 'process_calendar.php',
              type: 'POST', // Send post data
              data: 'type=fetch&firstday='+month_first+'&lastday='+month_last,
              async: false,
              success: function(s){
                json_events = s;
              }
        });

        $('#calendar').fullCalendar({

            height: 500,
            events: JSON.parse(json_events),
            ditable: true,
            selectable: true,
            eventClick: function(event, jsEvent, view) {
                // Getnotes4event(event.recnum,event.start,event.userid)
                
                $("#dialog").dialog({
                    autoOpen: false,
                });


                document.getElementById("userid").innerHTML=event.userid;
                document.getElementById("event_date").innerHTML=event.create_date;
                document.getElementById("event_title").innerHTML=event.title;
                document.getElementById("event_notes").innerHTML=event.notes;
               

                $('#dialog').dialog('open');
            }  
            
            
        });

        $('.fc-prev-button').click(function(){
           // alert('prev is clicked, do something');
        });

        $('.fc-next-button').click(function(){
           // alert('nextis clicked, do something');
        });



    });

</script>



<?php
include('header.html');
$day=date('d');
$month= date('m');
$year= date('y');

?>



    <td bgcolor="#FFFFFF">
      <table width=100% border=0 cellpadding=6 cellspacing=0  >
  <tr><td><span class="heading"><i></i></td></tr>
<tr>
<td>



</td></tr>
<tr><td>
<table width=100% border=0>
<div class="contenttitle radiusbottom0">
<h2><span>Tasklist Summary
 
<!-- <a href ="new_account.php"><img name="Image8" style="float:right" border="0" src="images/na.gif"></a> -->
</h2>
</span>
</td>
</tr>

</td></tr>
</table>
    
    <form action='process_calendar.php' method='post'>
    <div style="width: 100%; ">
       <div style="float:left; width: 30%; margin-top:40px;">
            <table >

                <tr>
                    <td bgcolor="#FFFFFF"> 
                        <span class="labeltext">Event Date</span>
                        <input type="text" id="datepicker" name="event_date">
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#FFFFFF"> 
                        <span class="labeltext">Event Title</span>
                        <span class="tabletext">
                            <input type=text name="notes_label" size=40>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#FFFFFF"> 
                        <span class="labeltext">Event Notes</span>
                        <span class="tabletext">
                            <!-- <input type=text name=notes_label size=40> -->
                            <textarea rows="10" cols="50" name="event_notes"></textarea>
                        </span>
                    </td>
                </tr>

                <tr>
                    <td bgcolor="#FFFFFF"> 
                        <span class="labeltext"><input type="submit" name="add" value="ADD"  onclick="check_req_fields()"></span>
                        <span class="labeltext"><input type="button" name="button" value="RESET" onclick=ClrEntry()></span>
                    </td>
                </tr>


            </table>
       </div>
       <div style="float:right; width: 70%">
            <div id='calendar'></div>

            <div id="dialog" title="Event" style="display:none">
                
                    <fieldset>
                        <span class=labeltext>Name :</span>
                        <span class=labeltext name="userid" id="userid"></span>
                        <br>
                        <span class=labeltext>Date :</span>
                        <span class=labeltext name="event_date" id="event_date"></span>
                        <br>
                        <br>
                        <table  style="border: 1px solid;">
                            <tr>
                                <td width=700 bgcolor="#CCCCDD" align="center">
                                    <span class=labeltext id="event_title"></span> 
                                </td>
                            </tr>
                            <tr>
                                <td> 
                                    <span class=tabletext id="event_notes"></span>
                                </td>
                            </tr>
                        </table>
                      
                    </fieldset>
               
            </div>



       </div>
    </div>
    <div style="clear:both"></div>

     <input type="hidden" name="pagetype" id="pagetype" value="newevent"> 

    </form>

   

</body>
</html >
