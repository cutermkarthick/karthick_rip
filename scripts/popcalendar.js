var gdCtrl = new Object();
var goSelectTag = new Array();
var date= new Date();
var gcGray = "#808080";
var gcToggle = "#ffff00";
var gcBG = "#cccccc";

var gdCurDate = new Date();
var giYear = gdCurDate.getFullYear();
var giMonth = gdCurDate.getMonth()+1;
var giDay = gdCurDate.getDate();

function fSetDate(iYear, iMonth, iDay){
  VicPopCal.style.visibility = "hidden";
  //gdCtrl.value = iMonth+"/"+iDay+"/"+iYear; //Here, you could modify the locale as you need !!!!
  //gdCtrl.value = iDay+"/"+iMonth+"/"+iYear;
  //alert(iMonth);
  iMonth = iMonth - 1;
  date.setDate(iDay);
  date.setMonth(iMonth);
  date.setFullYear(iYear);
  //alert(date);
 var date1 = date.toString();
 var datearr = date1.split(' ');
   day = datearr[2];
  // alert(day);
   mon = datearr[1];
   year = datearr[5];
   gdCtrl.value = day + ' ' + mon + ' ' + year;
 //gdCtrl.value = iYear+"-"+iMonth+"-"+iDay;
  for (i in goSelectTag)
  	goSelectTag[i].style.visibility = "visible";
  goSelectTag.length = 0;
}

function fSetSelected(aCell){
  var iOffset = 0;
  var iYear = parseInt(tbSelYear.value);
  var iMonth = parseInt(tbSelMonth.value);

  self.event.cancelBubble = true;
  aCell.bgColor = gcBG;
	with(aCell)
	{
		var iDay = parseInt(innerText);
	}
	fSetDate(iYear, iMonth, iDay);
}

function Point(iX, iY){
	this.x = iX;
	this.y = iY;
}

function fBuildCal(iYear, iMonth) {
  var aMonth=new Array();
  for(i=1;i<7;i++)
  	aMonth[i]=new Array(i);

  var dCalDate=new Date(iYear, iMonth-1, 1);
  var iDayOfFirst=dCalDate.getDay();
  var iDaysInMonth=new Date(iYear, iMonth, 0).getDate();
  var iOffsetLast=new Date(iYear, iMonth-1, 0).getDate()-iDayOfFirst+1;
  var iDate = 1;
  var iNext = 1;

  for (d = 0; d < 7; d++)
  {
		if(d<iDayOfFirst)
		{
			aMonth[1][d]="";
		}
		else
		{
			aMonth[1][d]=iDate++;
		}
	}
  for (w = 2; w < 7; w++)
  {
  	for (d = 0; d < 7; d++)
  	{
  		if(iDate<=iDaysInMonth)
  		{
  			aMonth[w][d]=iDate++;
  		}
  		else
  		{
  			aMonth[w][d]="";
  		}
		}
	}
  return aMonth;
}

function fDrawCal(iYear, iMonth, iCellHeight, iDateTextSize) 
{
  var WeekDay = new Array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
  with (document) {
	write("<tr>");
	for(i=0; i<7; i++)
		write("<td class='stext'><div align=center style='border:solid 1;background=#ebffed;color:#006332;width:25px'><b>" + WeekDay[i] + "</b></div></td>");
	write("</tr>");

  	for (w = 1; w < 7; w++) 
  	{
		write("<tr>");
		for (d = 0; d < 7; d++) 
		{
			write("<td class='stext' id='calCell' align='center'>");
			write("<div id=cellText></div>");
			write("</td>")
		}
		write("</tr>");
	}
  }
}

function fUpdateCal(iYear, iMonth) {
  myMonth = fBuildCal(iYear, iMonth);
  var i = 0;
  for (w = 0; w < 6; w++)
  {
		for (d = 0; d < 7; d++)
		{
			with (cellText[(7*w)+d]) 
			{
				Victor = i++;
				cellText[(7*w)+d].innerHTML = "<div></div>";
				if(myMonth[w+1][d]!="")
				{
					if(d==0 && myMonth[w+1][d]!=giDay)
					{
						var st="<div style='border:solid 1;cursor:hand;background:#f0f0f0;Color:red;width:25px' onclick='fSetSelected(this)'>";		
					}
					else if(myMonth[w+1][d]==giDay)
					{
						var st="<div style='border:solid 1;cursor:hand;background:#b2cc7f;Color:#006331;width:25px' onclick='fSetSelected(this)'>";
					}
					else
					{
						var st="<div style='border:solid 1;cursor:hand;background:#f0f0f0;Color:blue;width:25px' onclick='fSetSelected(this)'>";
					}
					cellText[(7*w)+d].innerHTML = st+""+myMonth[w+1][d]+"</div>"
				}
			}
		}
	}
}

function fSetYearMon(iYear, iMon){
  tbSelMonth.options[iMon-1].selected = true;
  for (i = 0; i < tbSelYear.length; i++)
	if (tbSelYear.options[i].value == iYear)
		tbSelYear.options[i].selected = true;
  fUpdateCal(iYear, iMon);
}

function fPrevMonth(){
  var iMon = tbSelMonth.value;
  var iYear = tbSelYear.value;

  if (--iMon<1) {
	  iMon = 12;
	  iYear--;
  }

  fSetYearMon(iYear, iMon);
}

function fNextMonth(){
  var iMon = tbSelMonth.value;
  var iYear = tbSelYear.value;

  if (++iMon>12) {
	  iMon = 1;
	  iYear++;
  }

  fSetYearMon(iYear, iMon);
}

function fToggleTags(){
  with (document.all.tags("SELECT")){
 	for (i=0; i<length; i++)
 		if ((item(i).Victor!="Won")&&fTagInBound(item(i))){
 			item(i).style.visibility = "hidden";
 			goSelectTag[goSelectTag.length] = item(i);
 		}
  }
}

function fTagInBound(aTag){
  with (VicPopCal.style){
  	var l = parseInt(left);
  	var t = parseInt(top);
  	var r = l+parseInt(width);
  	var b = t+parseInt(height);
	var ptLT = fGetXY(aTag);
	return !((ptLT.x>r)||(ptLT.x+aTag.offsetWidth<l)||(ptLT.y>b)||(ptLT.y+aTag.offsetHeight<t));
  }
}

function fGetXY(aTag){
  var oTmp = aTag;
  var pt = new Point(0,0);
  do {
  	pt.x += oTmp.offsetLeft;  	
  	pt.y += oTmp.offsetTop;
  	oTmp = oTmp.offsetParent;  	
  } while(oTmp.tagName!="BODY"); 
 
  return pt;
  }
function fGetXY1(aTag){
  var oTmp = document.getElementById(aTag);	
  var pt = new Point(0,0);
  do {
  	pt.x += oTmp.offsetLeft;  	
  	pt.y += oTmp.offsetTop;
  	oTmp = oTmp.offsetParent;  	
  } while(oTmp.tagName!="BODY");   
  return pt;
}
function fPopCalendar(popCtrl, dateCtrl){
	gdCtrl =  dateCtrl;
	fSetYearMon(giYear, giMonth);
	var point = fGetXY(popCtrl);	
	with (VicPopCal.style) {
  	left = point.x;  	
	top  = point.y+popCtrl.offsetHeight+1;
	width = VicPopCal.offsetWidth;
	height = VicPopCal.offsetHeight;	
	fToggleTags(point);
	visibility = 'visible';
  }
	VicPopCal.focus();
  
	//alert("Here"+popCtrl.value);

}
//
function fPopCalendar1(popCtrl, dateCtrl){
	gdCtrl =  document.getElementById(dateCtrl);	
	 popCtrl=dateCtrl;
  fSetYearMon(giYear, giMonth);
 var point = fGetXY1(dateCtrl);  
  with (VicPopCal.style) {
  	left = point.x;  
	top  = point.y+gdCtrl.offsetHeight+1;
	width = VicPopCal.offsetWidth;
	height = VicPopCal.offsetHeight;	
	fToggleTags(point);
	visibility = 'visible';
  }
	VicPopCal.focus();  
}
function fHideCal(){
  var oE = window.event; 
  if ((oE.clientX>0)&&(oE.clientY>0)&&(oE.clientX<document.body.clientWidth)&&(oE.clientY<document.body.clientHeight)) {
	var oTmp = document.elementFromPoint(oE.clientX,oE.clientY);
	 while ((oTmp.tagName!="BODY") && (oTmp.id!="VicPopCal"))
        oTmp = oTmp.offsetParent;
	if (oTmp.id=="VicPopCal")
		return;
  }
  VicPopCal.style.visibility = 'hidden';
  for (i in goSelectTag)
	goSelectTag[i].style.visibility = "visible";
  goSelectTag.length = 0;
}

var gMonths = new Array("January","February","March","April","May","June","July","August","September","October","November","December");

with (document) {
write("<Div id='VicPopCal' onblur='fHideCal()' onclick='focus()' style='POSITION:absolute;visibility:hidden;border:1px solid'>");
write("<table border='0' bgcolor='#e0e0e0'>");
write("<TR>");
write("<td valign='middle' align='center'>");
write("&nbsp;<select name='tbSelMonth' onChange='fUpdateCal(tbSelYear.value, tbSelMonth.value)' Victor='Won' onclick='self.event.cancelBubble=true' onblur='fHideCal()'>");
for (i=0; i<12; i++)
	write("<option value='"+(i+1)+"'>"+gMonths[i]+"</option>");
write("</SELECT>");
write("&nbsp;&nbsp;<SELECT name='tbSelYear' onChange='fUpdateCal(tbSelYear.value, tbSelMonth.value)' Victor='Won' onclick='self.event.cancelBubble=true' onblur='fHideCal()'>");
for(i=2000;i<=giYear+1;i++)
	write("<OPTION value='"+i+"'>&nbsp;&nbsp;"+i+"&nbsp;&nbsp;</OPTION>");
write("</SELECT>");
write("&nbsp;");
write("</td>");
write("</TR><TR>");
write("<td align='center'>");
write("<DIV style='background-color:#e0e0e0;'><table width='100%' border='0'>");
fDrawCal(giYear, giMonth, 18, 16);
write("</table></DIV>");
write("</td>");
write("</TR>");
write("</TD></TR>");
write("</TABLE></Div>");
}
