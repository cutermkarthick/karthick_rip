function check_req_fields()
{
    var errmsg = '';
var valid="0,1,2,3,4,5,6,7,8,9,.";
var valid1="0,1,2,3,4,5,6,7,8,9";
var ok="yes";
var temp;
var frm=document.forms[0];
var max=document.forms[0].index1.value;
var flag=0;
for(var i=0;i<frm.length;i++)
{
	for(var j=1;j<=max;j++)
	{
		carrier="carrier" + j;	
		carrierval="carrierval" +j;
		if(frm.elements[i].name==carrier)
		{
			var aind = frm.elements[i].selectedIndex;
			//alert(frm.elements[i][aind].text);
			for(var k=1;j<frm.length;k++)
			{
				if(frm.elements[k].name == carrierval)
				{
					frm.elements[k].value = frm.elements[i][aind].text;
					break;
				}
			}
		}
	}
}
flag=0;
for(var j=1;j<=max;j++)
{
	final="final" + j;
	if (document.forms[0].elements[final].checked == true)
	{
		if (flag==1)
		{
			errmsg = "You Have checked more than One final";
			break;
		}
		else
			flag=1;

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



function addRow(id,index){
var x=index;
prevseqnum="prevseqnum" + index;
shiprecnum="shiprecnum" + index;
seqnum="seqnum" + index;
desc="desc" + index;
carrier="carrier" + index;
final="final" + index;
tracking_num="tracking_num" + index;
carrierval="carrierval" + index;

var tbody = document.getElementById(id).getElementsByTagName("tbody")[0]; 
var row = document.createElement("TR"); 
row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD"); 
cell1.setAttribute("align","center"); 
var inp1 =  document.createElement("INPUT"); 
inp1.setAttribute("type","text"); 
inp1.setAttribute("size","5"); 
inp1.setAttribute("name",seqnum); 
cell1.appendChild(inp1); 

var cell2 = document.createElement("TD"); 
cell2.setAttribute("align","center"); 
var inp2 =  document.createElement("INPUT"); 
inp2.setAttribute("type","text"); 
inp2.setAttribute("size","1s0"); 
inp2.setAttribute("name",tracking_num); 
cell2.appendChild(inp2); 

var cell3 = document.createElement("TD"); 
cell3.setAttribute("align","center"); 
var inp3 =  document.createElement("INPUT"); 
inp3.setAttribute("type","text"); 
inp3.setAttribute("size","20"); 
inp3.setAttribute("name",desc); 
cell3.appendChild(inp3); 

var cell4= document.createElement("TD");
cell4.setAttribute("align","center"); 
var oSelect=document.createElement("select");
oSelect.setAttribute("name", carrier);
oSelect.setAttribute("size", 1);
cell4.appendChild(oSelect); 

var oOption = document.createElement("option");
var t0 = document.createTextNode("FedEx");
oOption.setAttribute("value", 0);
oOption.appendChild(t0);
oSelect.appendChild(oOption);

var oOption1 = document.createElement("option");
var t1 = document.createTextNode("UPS");
oOption1.setAttribute("value", 1);
oOption1.appendChild(t1);
oSelect.appendChild(oOption1);

var oOption2 = document.createElement("option");
var t2 = document.createTextNode("DHL");
oOption2.setAttribute("value", 2);
oOption2.appendChild(t2);
oSelect.appendChild(oOption2);

var cell5 = document.createElement("TD");
cell5.setAttribute("align","center"); 
var final1=document.createElement("input");
final1.type="checkbox";
final1.value='';
final1.name =final;	
cell5.appendChild(final1); 

var inp6 =  document.createElement("INPUT"); 
inp6.setAttribute("carrier","hidden"); 
inp6.setAttribute("value","FedEx"); 
inp6.setAttribute("name",carrierval); 

var inp7 =  document.createElement("INPUT"); 
inp7.setAttribute("type","hidden"); 
inp7.setAttribute("value",""); 
inp7.setAttribute("name",prevseqnum); 

var inp8 =  document.createElement("INPUT"); 
inp8.setAttribute("type","hidden"); 
inp8.setAttribute("value",""); 
inp8.setAttribute("name",shiprecnum); 

row.appendChild(cell1); 
row.appendChild(cell2); 
row.appendChild(cell3); 
row.appendChild(cell4); 
row.appendChild(cell5); 
row.appendChild(inp6); 
row.appendChild(inp7); 
row.appendChild(inp8); 

tbody.appendChild(row); 
x++;
document.forms[0].index1.value=x;
}

function GetDate4template(rt) {
//alert("i am here");
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getcal4template.php?index=" + rt, "DueDate", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight + 
",top="+winTop+",left="+winLeft);
}


function SetDate4template(dateval,index) {

date="date" + index;

document.forms[0].elements[date].value = dateval;

}