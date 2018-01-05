function makeChart(strStudent,strScore,chart)
{

	IE4=(document.all)?1:0;
	NS4=(document.layers)?1:0;
	DOM=(document.getElementById)?1:0;
	NS6=((DOM)&&(!IE4))?1:0;
	ver4=(IE4||DOM||NS4)?1:0;
	nav=navigator.appVersion;
	nav=nav.toLowerCase();
	isMac=(nav.indexOf("mac")!=-1)?1:0;
	IEmac=((document.all)&&(isMac))?1:0;

	imRed = new Image();
	imYellow = new Image();
	imRed.src = "red.gif";
	imYellow.src = "yellow.gif";
	strImage = "";
	strToWrite = "";



	var strScores=strScore;
	var strStudents=strStudent;
	var arScores = new Array();
	var arStudents1 = new Array();
	var arStudents = new Array();
	arScores=strScore.split(',');
	arStudents1=strStudent.split(',');
	j=0
	for (i=0;i<arStudents1.length;i++)
	   {
		arStudents[j]=arStudents1[i];
		j++;
		arStudents[j]="";
		j++;
	   }



//------------------------------------



	var arScoresToChart = new Array();
	var arStudentsToChart = new Array();

	chartHeight = 175;
	maxHeight = 0;


	for(i = 0; i < arScores.length; i++)
	    {
		 if(arScores[i] > maxHeight)
			maxHeight = arScores[i];
	     }




   	if(!ver4) return;
	strToWrite = "<table boarder=0><tr align='center'>";
	for(i = 0; i < arScores.length; i++)
	   {
		  if(i % 2 == 0)
		   {
			 strImage = "red.gif";
			 strToWrite += "<td valign=bottom bgcolor=\"FFFFFF\"><font size=1 face=Arial>" + arScores[i] + "<br>";
			 strToWrite += "<img src='images/Red.jpg' height=" + parseInt((arScores[i] / maxHeight) * chartHeight) + " width=30>";
		    }
		  else
		   {
			 strImage = "red.gif";
			 strToWrite += "<td valign=bottom bgcolor=\"FFFFFF\"><font size=1 face=Arial>" + arScores[i] + "<br>";
			 strToWrite += "<img src='images/Blue.jpg' height=" + parseInt((arScores[i] / maxHeight) * chartHeight) + " width=30 hspace=2></font></td>";
		  }
	   }


	strToWrite += "</tr><tr>";
	for(i = 0; i<arStudents.length; i++)
	   {
		 if(i % 2 == 0)
			strToWrite += "<td width=16 colspan=2  bgcolor=\"FFFFFF\"><font size=1 style=\"Bold\" face=Verdana>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + arStudents[i] + "</font></td>";
	   }
	strToWrite += "</tr></table>";



	// now show it!
                if (chart == 'theChart')
	{
		if(IE4)
		   {
			 if((IEmac) && (DOM)) return;
			winInnerWidth = document.body.clientWidth;
			winInnerHeight = document.body.clientHeight;
			screenWidth = screen.availWidth;
			screenHeight = screen.availHeight;
			window.offscreenBuffering = true;
			theChart.innerHTML=strToWrite;
			theChart.innerHTML=strToWrite;
		   }
	}
                if (chart == 'theChart1')
	{
		if(IE4)
		   {
			 if((IEmac) && (DOM)) return;
			winInnerWidth = document.body.clientWidth;
			winInnerHeight = document.body.clientHeight;
			screenWidth = screen.availWidth;
			screenHeight = screen.availHeight;
			window.offscreenBuffering = true;
			theChart1.innerHTML=strToWrite;
			theChart1.innerHTML=strToWrite;
		   }
	}

	if(NS4)
	  {
		with(document.elements[chart])
		   {
			document.open();
			document.write(strToWrite);
			document.close();
		   }
	}


	if(NS6)
	  {
		document.getElementById(chart).innerHTML=strToWrite;
	  }

   }

function parentChart(strStudent1,strScore1,strStudent2,strScore2)
{
	makeChart(strStudent1,strScore1,'theChart') ;
	//makeChart(strStudent2,strScore2,'theChart1') ;

}

function GetDate(rt) {

  // alert(rt);
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
// alert(dateval);
// alert(fieldname);
document.forms[0].elements[fieldname].value = dateval;
}


function addTask(rt)
{
	// alert("reached");
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("taskEntry.php?reasontext=" + rt, "Vendors", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft+",dependent=yes");
}

function addNews(rt)
{
	// alert("reached");
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("newsEntry.php?reasontext=" + rt, "Vendors", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft+",dependent=yes");
}

function editTask(rt)
{
	// alert("reached");
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("editTask.php?taskrecnum=" + rt, "Vendors", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft+",dependent=yes");
}

function check_req_fields()
{
	
    var errmsg = "";
 if(document.getElementById("pagename").value == 'taskentry')
  {
   
    if (document.forms[0].task_name.value.length == 0)
    {
         errmsg += 'Please enter Task Name.\n';
    }
    if (document.forms[0].taskcreate_date.value.length == 0)
    {
         errmsg += 'Please enter Created Date.\n';
    }
}

  if(document.getElementById("pagename").value == 'taskedit')
    {
         if (document.forms[0].taskcomp_date.value.length == 0)
       {
         errmsg += 'Please enter Completed Date.\n';
       }
   }
 //   var ind = document.forms[0].index.value;
    

    if (errmsg == '')
        return true;
     else
     {
       alert (errmsg);
       return false;
     }
 }
function trimfield(str)
{

	return str.replace(/^\s+|\s+$/g,'');
}

 function check_req_fields_news()

{
	
    var errmsg = "";

   var desc =  document.forms[0].descr.value;
   
    if (document.forms[0].created_by.value.length == 0)
    {
         errmsg += 'Please enter Name.\n';
    }
    if (document.forms[0].Date.value.length == 0)
    {
         errmsg += 'Please enter Date.\n';
    }
    if (trimfield(desc) == '')
    {
         errmsg += 'Please enter Description.\n';
    }



    if (errmsg == '')
        return true;
     else
     {
       alert (errmsg);
       return false;
     }
 }