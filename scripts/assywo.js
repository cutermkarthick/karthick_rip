

function GetDate(rt) {

//alert(rt);

if(rt == 'act_ship_date')
{
  var j=1;
  var closing_flag = 0; var close_final=0;
  var index_close = document.forms[0].index.value;
  //alert(index_close+"\n");
  while(j<index_close)
  {
    grn = "grn"+j;
    //alert(document.getElementById(datec).value.length+"********\n");
    if(document.getElementById(grn).value.length == 0)
    {
      closing_flag = 1;
      //alert(closing_flag+"&&&&&&&&&&&&&&\n");
    }
    j++;
  }
 //  alert(closing_flag+"----"+close_final);
   var x=1;
  var max=document.forms[0].indexmm.value;
  //alert(x+"****"+max);
  while (x < max)
    {
        stagenum = "stage" + x;


           if((document.getElementById(stagenum).value == "fi"||document.getElementById(stagenum).value ==  "final"||document.getElementById(stagenum).value == "FINAL"||document.getElementById(stagenum).value == "FI"||document.getElementById(stagenum).value == "Final"||document.getElementById(stagenum).value == "Fi"))
           {
              close_final=1;
              //alert(close_final+"^^^^^^^^^^^^^^^^^^^\n");
           }

           x++;
    }
    
 if(closing_flag == 1 )
 {
   alert('To close this WO'+'\n'+'All the GRN/WO must be entered');
   return false;
 }
 if(close_final ==0)
 {
   alert('To close this WO'+'\n'+'Final stage has to be entered');
   return false;

 }


 
 sum=0;
var str_woqty = document.getElementById('assy_woqty').value;
var woqty = parseInt(str_woqty);
        var y=1;
  var maxv=document.forms[0].indexmm.value;
  //alert(x+"****"+max);
  while (y < maxv)
    {       stagenum = "stage" + y;
           accpt= "accept"+ y;
            date="date"+y;
            rework="rework"+y;
            reject="reject"+y;
            returns="returns"+y;

//          if(document.getElementById('act_ship_date').value.length !=0 && document.getElementById('act_ship_date').value != '0000-00-00')
//          {
           if((document.getElementById(stagenum).value == "fi"||document.getElementById(stagenum).value ==  "final"||document.getElementById(stagenum).value == "FINAL"||document.getElementById(stagenum).value == "FI"||document.getElementById(stagenum).value == "Final"||document.getElementById(stagenum).value == "Fi"))
           {

            final_flag = 1;
            if(document.getElementById(accpt).value.length !=0)
            {
              acc= document.getElementById(accpt).value;
            }
            else
            {
              acc=0;
            }
            if(document.getElementById(reject).value.length !=0)
           {
            rej=document.getElementById(reject).value;
           }
           else
           {
            rej=0;
           }
            if(document.getElementById(rework).value.length !=0)
           {
            rew=document.getElementById(rework).value;
           }
           else
           {
            rew=0;
           }
            if(document.getElementById(returns).value.length !=0)
           {
            ret=document.getElementById(returns).value;
           }
           else
           {
            ret=0;
           }

            sum += parseInt(acc)+ parseInt(rej)+ parseInt(rew)+ parseInt(ret);
            //alert(sum);

          }
          y++;
          }
  if(woqty != sum)
 {
   alert( 'Total of Accept,Rework,Reject,Ret'+'\n'+'should be equal to Qty');
   return false;
 }

}
var param = rt;
var winWidth = 300;
var winHeight = 350;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getcalendar.php",param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetDate(dateval,fieldname) {
//alert(fieldname);
fn = document.getElementById(fieldname);
fn.value = dateval;
}

function getBom() {
//alert('666');
//alert(document.getElementById('oper_no')[opindex].text;);
var bomindex =  document.getElementById('bomnum').selectedIndex;
bomText=document.getElementById('bomnum')[bomindex].value;
var bom = bomText.split("|");
document.getElementById('bomiss').value = bomText[1];
}

function getbomDetails(bomnum,bomiss,recnum)
{
  assy_qty=document.getElementById('assy_woqty').value;
  assy_type=document.getElementById('assy_type').value;

 //if(document.getElementById('page').value == "new")
 //{
	  // alert('here');

        var ajaxRequest;  // The variable that makes Ajax possible!

	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			   }
            catch (e)
               {
				// Something went wrong
				alert("Your browser broke!");
				return false;
			   }
		}
	}
	// Create a function that will receive data sent from the server
	 ajaxRequest.onreadystatechange = function(){
	        if(ajaxRequest.readyState == 4)
                {
		      if(ajaxRequest.status == 200){
                           // alert(ajaxRequest.responseText);
			    document.getElementById('bomli').innerHTML = ajaxRequest.responseText;
		      }
	        }
	}
	//alert("Here1");
	ajaxRequest.open("POST", "getbomDetails.php?bom="+bomnum+"&assy_qty="+assy_qty+"&assy_type="+assy_type+"&bomiss="+bomiss+"&recnum="+recnum, true);
	ajaxRequest.send(null);
  //}
}

function check_req_fields()
{
    var errmsg = '';
	var lipresent = 0;
	//var custindex =  document.getElementById('customer').selectedIndex;
	var index = document.forms[0].index.value;
	var line_flag = 0;
	  var str_poqty = document.getElementById('po_qty').value;
        var str_woqty = document.getElementById('assy_woqty').value;

        var poqty = parseInt(str_poqty);
        var woqty = parseInt(str_woqty);
        // alert(woqty);

    /*if (document.forms[0].assy_wonum.value.length == 0 )
    {
         errmsg += 'Please Enter Assembly WO#\n';
    }*/
    if (document.forms[0].wo_date.value.length == 0 )
    {
         errmsg += 'Please Enter WO Date\n';
    }

         assyQty = document.forms[0].assy_woqty.value;

    if(document.getElementById('crn').value == '')
    {
         errmsg += 'Please Select PRN\n';
    }
    if(document.getElementById('cust_ponum').value == '')
    {
         errmsg += 'Please Select PO #\n';
    }
     if(document.getElementById('assy_woqty').value == '')
    {
         errmsg += 'Please Enter Assy Qty\n';
    }
      if(document.getElementById('companyname').value == '')
    {
         errmsg += 'Please Enter Customer\n';
    }
        
    if(poqty < woqty)
         {
           errmsg +='WO qty should be less than Cust PO qty.\n';
         }

   if(document.getElementById('pagename').value=='new_assywo')
{
     if((document.getElementById("sch_due_date").value == '' || document.getElementById("sch_due_date").value == '0000-00-00') && document.getElementById('pagename').value =='new_assywo')
     {
      errmsg += 'Please enter Schedule Due Date\n';
     } 
   }


    var sum4bomdet=0;
        var i=1;
        var qtyWO=0;
        var prev_crn='';
        var map = {};
        var map1={};
        var crn_arr=new Array(); 
        var qtyforwo=new Array();
        var totalqty=new Array();
        var crnarray=[];
        var arraylen=1;

    while(i<index)
    {
       ln = "line_num" + i;
       //alert(ln);
       itemno = "itemno" + i;
       type="type"+i;
       grn="grn"+i;
       qty_accpt= "qty_acc"+ i;
       qty_rework="qty_rew"+i;
       qty_reject="qty_rej"+i;
       qty_returns="qty_ret"+i;
       qty_wo="qty_wo"+i;
       crn="crn_num4li"+i;
       avail_qty = "avail_qty" + i;


       //stagenum="stage"+i;
       lnv = document.getElementById(ln).value;
        crnarray[i]=document.getElementById(crn).value;
       if(document.getElementById(ln).value.length == 0 && document.getElementById(type).value.length != 0)
       {
             errmsg += 'Please enter Line# at line '+i+'\n';
             //line_flag=1;
       }
       // alert(document.getElementById("pagename").value);
       if(document.getElementById("pagename").value=="edit_assywo" && document.getElementById("dept").value!="QA")
       {
         if(document.getElementById(type).value=='Non Assembly' && document.getElementById(grn).value.length==0)
         {
           errmsg += 'Please enter WO Num at line '+i+'\n';
         }
          if(document.getElementById(type).value!='Non Assembly' && document.getElementById(grn).value.length==0)
         {
           errmsg += 'Please enter GRN Num at line '+i+'\n';
         }
       }



         if(document.getElementById(type).value=='Non Assembly' && 
       document.getElementById(grn).value !='' && 
       document.getElementById('pagename').value != 'edit_assywo')
       {
           qty_wo="qty_wo"+i;
           avail_qty="avail_qty"+i;
         if(document.getElementById(qty_wo).value != '' &&
         parseInt(document.getElementById(qty_wo).value) >  
         parseInt(document.getElementById(avail_qty).value) &&
         document.getElementById('assy_type').value != 'Kit' )
       {
               errmsg += 'WO Qty ' + document.getElementById(qty_wo).value+' is greater than Avail Qty '+
           document.getElementById(avail_qty).value+' at line '+i+'\n';
       }
     }
	   descr="descr"+i;
	   exp_date="exp_date"+i;
	   var descr1=document.getElementById(descr).value;	
	   descr2=descr1.toLowerCase();
	   var d=new Date();
	   var day = d.getDate();
       var year = d.getFullYear();
       var month=d.getMonth()+1;
	   if (month < 10) {
          month = '0' + month;
       }
	    if (day < 10) {
          day = '0' + day;
       }
	
       var current_date=(year+'-'+month+'-'+day);

	   	var  wo_date=document.getElementById('wo_date').value;
		
	   if(descr2.indexOf('sealant') != -1)
	   {   
if(document.getElementById(exp_date).value=='' ||  document.getElementById(exp_date).value=='0000-00-00'  )
      {
       errmsg += 'Please enter Expiry Date for Sealant at line '+i+'\n';
      } 
    
      if(document.getElementById('pagename').value == 'new_assywo')
       {
      if(document.getElementById(exp_date).value!='' &&  document.getElementById(exp_date).value!='0000-00-00'  )
      {    
          if(document.getElementById(exp_date).value <  current_date  )
          {
                 errmsg += 'Expiry Date should be greater than Current Date for Sealant at line '+i+'\n';
          document.getElementById(exp_date).value='';
          }
        if(document.getElementById(exp_date).value <  wo_date  )
          {
                 errmsg += 'Expiry Date should be greater than Assy WO Date for Sealant at line '+i+'\n';
          document.getElementById(exp_date).value='';
           }

      }

      }
      else if(document.getElementById('pagename').value == 'edit_assywo')
       {
    
        if(document.getElementById(exp_date).value!='' &&  document.getElementById(exp_date).value!='0000-00-00'  )
        {    
           if(document.getElementById(exp_date).value <  wo_date)
           {
                  errmsg += 'Expiry Date should be greater than Assy WO Date for Sealant at line '+i+'\n';
            document.getElementById(exp_date).value='';
           }
        }
      } 
    }
     type="type"+i;

            if(document.getElementById('pagename').value == 'edit_assywo' && 
        parseInt(document.getElementById(qty_wo).value)  > 
        parseInt(document.getElementById(avail_qty).value) &&
        document.getElementById(type).value != 'Consummables' &&
        document.getElementById('assy_type').value != 'Kit' )
       {
                        //errmsg += 'Qty for WO  is greater than Avail Qty: '+  document.getElementById(avail_qty).value +
          ' at line '+i+'\n';
       }
       tot_qty=parseInt(document.getElementById('qty'+i).value)*parseInt(document.getElementById('assy_woqty').value);

     if(parseInt(document.getElementById(qty_wo).value)  > tot_qty)
    {
             errmsg += 'Qty for WO  is greater than Assy WO Qty: '+  tot_qty +
          ' at line '+i+'\n';
    }
     
     crn="crn_num4li"+i;
         crn_num= document.getElementById(crn).value;
      if(document.getElementById(type).value=='Consummables' && 
       document.getElementById(grn).value.length!=0 &&
       document.getElementById('pagename').value == 'edit_assywo' )
    {
       crn_arr.push(crn_num);
    }
    
      var k=0;

      //new_assywo

if((document.getElementById(type).value=='Non Assembly') && (document.getElementById(grn).value.length!=0)
 &&
       (document.getElementById('pagename').value == 'edit_assywo')) 
       {     

        qtyWO =parseInt(document.getElementById(qty_wo).value) ;


       

           if(document.getElementById(qty_accpt).value.length !=0)
           {
              qty_acc= document.getElementById(qty_accpt).value;
           }
           else
           {
              qty_acc=0;
           }
            if(document.getElementById(qty_reject).value.length !=0)
           {
            qty_rej=document.getElementById(qty_reject).value;
           }
           else
           {
            qty_rej=0;
           }
            if(document.getElementById(qty_rework).value.length !=0)
           {
            qty_rew=document.getElementById(qty_rework).value;
           }
           else
           {
            qty_rew=0;
           }
            if(document.getElementById(qty_returns).value.length !=0)
           {
              qty_ret=document.getElementById(qty_returns).value;
           }
           else
           {
               qty_ret=0;
           }  
/* alert("qtywo " +qtyWO);
  alert("qty_acc " +qty_acc);
   alert("qty_rej " +qty_rej);
    alert("qty_rew " +qty_rew);
     alert("qty_ret " +qty_ret);*/
 // alert("qty_acc " +qty_acc);
       var qty4wo = map[crn_num];

       if (qty4wo)
       {
         qty4wo += qtyWO;
       }
       else 
       {
         qty4wo = qtyWO;
       }
       var sum_tot= map1[crn_num];
       sum4bomdet = parseInt(qty_acc)+ parseInt(qty_rej)+ parseInt(qty_rew)+ parseInt(qty_ret);

       if (sum_tot)
       {
         sum_tot  += sum4bomdet;
       }
       else 
       {
         sum_tot = sum4bomdet;
       }
        map[crn_num]=qty4wo;
        map1[crn_num]=sum_tot;
/* 
 alert(sum4bomdet);
    alert(sum_tot);*/
         k++;
     }


     /* if(document.getElementById(grn).value.length!=0 &&
       document.getElementById('pagename').value == 'edit_assywo')
       { 

         if(document.getElementById(qty_reject).value.length !=0)
           {
            qty_rej=document.getElementById(qty_reject).value;
           }
           else
           {
            qty_rej=0;
           }

          var nc_num = document.getElementById(nc_num).value ;
          if(qty_rej !='0' && qty_rej !=''  && (nc_num =='' || nc_num =='0'))
          {
          errmsg += 'Please enter NC for line '+i+'\n'; ;
          }

       }*/

      i++;

        
 }

		for(i=1;i<index;i++)
{
  for(j=i+1;j<index;j++)
  {
    if(crnarray[i]==crnarray[j] && crnarray[i] !='' && crnarray[j] != '')
    {
  
      var sum1= (parseInt(document.getElementById("qty_acc"+j).value)) + (parseInt(document.getElementById("qty_rew"+j).value)) + (parseInt(document.getElementById("qty_rej"+j).value)) + (parseInt(document.getElementById("qty_ret"+j).value));  

      var qtyaccptd=parseInt(document.getElementById("qty_acc"+i).value);

      var qtywo=parseInt(document.getElementById("qty_wo"+i).value);


      if((sum1+qtyaccptd)!=qtywo)
      {

        //errmsg+="Check the quantities entered for CRN#"+crnarray[i]+'\n';
      }
    }
  }
}

if(document.getElementById('pagename').value == 'edit_assywo')
{
// alert("reached");
 for (var z in map)
{
   if(map[z] != map1[z])
  {  
      console.log(map[z]);
      console.log(map1[z]);
      errmsg += 'Total of Accept,Rework,Reject,Ret'+'\n'+'should equal to Qty for WO for CRN#  '+z+'\n';
  }
}

}


 


/* if(document.getElementById(type).value=='Manufactured' && document.getElementById(grn).value.length!=0)

       {
       //alert("HERE");qtyWO=document.getElementById(qty_wo).value ;
          if(document.getElementById(qty_accpt).value.length !=0)
            {
              qty_acc= document.getElementById(qty_accpt).value;
            }
            else
            {
              qty_acc=0;
            }
            if(document.getElementById(qty_reject).value.length !=0)
           {
            qty_rej=document.getElementById(qty_reject).value;
           }
           else
           {
            qty_rej=0;
           }
            if(document.getElementById(qty_rework).value.length !=0)
           {
            qty_rew=document.getElementById(qty_rework).value;
           }
           else
           {
            qty_rew=0;
           }
            if(document.getElementById(qty_returns).value.length !=0)
           {
            qty_ret=document.getElementById(qty_returns).value;
           }
           else
           {
            qty_ret=0;
           }
         sum4bomdet += parseInt(qty_acc)+ parseInt(qty_rej)+ parseInt(qty_rew)+ parseInt(qty_ret);
            //alert(sum4bomdet);

            if(sum4bomdet != qtyWO )
            {
               errmsg += 'Total of Accept,Rework,Reject,Ret'+'\n'+'should equal to Qty for WO for line '+i+'\n';
            }

         }
       }*/

       var x=1;
      var max=document.forms[0].indexmm.value;
      var seq_num=new Array();
      var seqlist = {};
      sum=0;
      spsum=0;dnsum=0;seqnum=0;
       var final_flag=0;

    //alert(max+"----------"+x);
    while (x < max)
    {
        //ln ="mmline_num" + x;
        // alert(ln);
        //lnv = document.getElementById(ln).value;
            stagenum = "stage" + x;
            accpt= "accept"+ x;
            date="date"+x;
            rework="rework"+x;
            reject="reject"+x;
            returns="returns"+x;

//          if(document.getElementById('act_ship_date').value.length !=0 && document.getElementById('act_ship_date').value != '0000-00-00')
//          {
           if((document.getElementById(stagenum).value == "fi"||document.getElementById(stagenum).value ==  "final"||document.getElementById(stagenum).value == "FINAL"||document.getElementById(stagenum).value == "FI"||document.getElementById(stagenum).value == "Final"||document.getElementById(stagenum).value == "Fi"))
           {

            final_flag = 1;
            if(document.getElementById(accpt).value.length !=0)
            {
              acc= document.getElementById(accpt).value;
            }
            else
            {
              acc=0;
            }
            if(document.getElementById(reject).value.length !=0)
           {
            rej=document.getElementById(reject).value;
           }
           else
           {
            rej=0;
           }
            if(document.getElementById(rework).value.length !=0)
           {
            rew=document.getElementById(rework).value;
           }
           else
           {
            rew=0;
           }
            if(document.getElementById(returns).value.length !=0)
           {
            ret=document.getElementById(returns).value;
           }
           else
           {
            ret=0;
           }

            sum += parseInt(acc)+ parseInt(rej)+ parseInt(rew)+ parseInt(ret);
            //alert(sum);

          }
          x++;
       }

if(document.getElementById('pagename').value == 'edit_assywo')
{
       if(final_flag == 1)
    {
      if(sum != assyQty)
      {
        errmsg += 'Total of Accept,Rework,Reject,Ret,Hold'+'\n'+'should equal to Assembly WO Qty\n';
      }

    }
}
    if(document.getElementById("pagename").value == 'edit_assywo')
    {

      var status = document.getElementById('status').value;
      if(status == 'Closed')
      {
        if(document.getElementById('act_ship_date').value =='' || document.getElementById('act_ship_date').value =='0000-00-00' )
        {
          errmsg += 'Please enter the Actual Shipment Date before Closing the Assembly work order\n';
        }

      }

    }

    if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}

function printAssyWo(recnum)
{
//alert(delrecnum);
var winWidth = 1000;
var winHeight = 850;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printAssywo.php?rec="+recnum, "PrintAssywo", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function addRow(id,index){
//alert('AI='+index);
//var bomDetails = document.getElementById('bom_details').value;
//bomArr=bomDetails.split("*");

var x = index;
var y = index;

linenumber="line_num"  + index;
itemno="itemno" + index;
partnum="partnum" + index;
issue="issue" + index;
descr="descr" + index;
qty="qty" + index;
uom="uom" + index;
qty_wo="qty_wo" + index;
grn="grn" + index;
exp_date="exp_date" + index;
qty_acc="qty_acc" + index;
qty_rew="qty_rew" + index;
qty_rej="qty_rej" + index;
qty_ret="qty_ret" + index;
remarks_li="remarks_li" + index;
//alert(remarks_li);
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

prevlinenum = "prev_line_num" + index;
lirecnum = "lirecnum" + index;


var cell1 = document.createElement("TD");
cell1.setAttribute("align","left");
var inp1 =  document.createElement("INPUT");
inp1.type="text";
inp1.name=linenumber;
inp1.id=linenumber;
inp1.size="3";
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.type="text";
inp2.name=itemno;
inp2.id=itemno;
inp2.size="10";
cell2.appendChild(inp2);

var inp3 =  document.createElement("INPUT");
inp3.type="hidden";
inp3.name=partnum;
inp3.id=partnum;
inp3.value="";
cell2.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 =  document.createElement("INPUT");
inp4.type="text";
inp4.name=issue;
inp4.id=issue;
inp4.size="22";
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.type="text";
inp5.name=descr;
inp5.id=descr;
inp5.size="30";
cell5.appendChild(inp5);

var cell6 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.type="text";
inp6.name=qty;
inp6.id=qty;
inp6.size="10";
inp6.style.backgroundColor = "#DDDDDD";
inp6.readOnly = true;
cell6.appendChild(inp6);


var cell7 = document.createElement("TD");
var inp7 =  document.createElement("INPUT");
inp7.type="text";
inp7.name=uom;
inp7.id=uom;
inp7.size="10";
inp7.style.backgroundColor = "#DDDDDD";
inp7.readOnly = true;
cell7.appendChild(inp7);

var cell8 = document.createElement("TD");
var inp8 =  document.createElement("INPUT");
inp8.type="text";
inp8.name=qty_wo;
inp8.id=qty_wo;
inp8.size="5";
cell8.appendChild(inp8);

var cell9 = document.createElement("TD");
var inp9 =  document.createElement("INPUT");
inp9.type="text";
inp9.name=grn;
inp9.id=grn;
inp9.size="6";
cell9.appendChild(inp9);

var cell10 = document.createElement("TD");
var inp10 =  document.createElement("INPUT");
inp10.type="text";
inp10.name=exp_date;
inp10.id=exp_date;
inp10.size="8";
inp10.readOnly=true;
inp10.style.backgroundColor = "#DDDDDD";
cell10.appendChild(inp10);

var cell11 = document.createElement("TD");
var inp11 =  document.createElement("INPUT");
inp11.type="text";
inp11.name=remarks_li;
inp11.id=remarks_li;
inp11.size="8";
inp11.readOnly=true;
inp11.style.backgroundColor = "#DDDDDD";
cell11.appendChild(inp11);

var inp100 = document.createElement("INPUT");
inp100.setAttribute("type","hidden");
inp100.setAttribute("size","");
inp100.setAttribute("name",lirecnum);
inp100.setAttribute("id",lirecnum);
cell10.appendChild(inp100);
//recno

var inp102 = document.createElement("INPUT");
inp102.setAttribute("type","hidden");
inp102.setAttribute("size","");
inp102.setAttribute("name",prevlinenum);
inp102.setAttribute("id",prevlinenum);
cell10.appendChild(inp102);


row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell8);
row.appendChild(cell9);
row.appendChild(cell10);
row.appendChild(cell11);

tbody.appendChild(row);
x++;
//alert("i am here"+x);
 document.getElementById('index').value=x;
}

function Getcim(rt)
{

  var param = rt;
  var winWidth =1100;
  var winHeight = 300;
  var winLeft = (screen.width-winWidth)/2;
  var winTop = (screen.height-winHeight)/2;
  if(document.getElementById('assy_woqty').value==0 || document.getElementById('assy_woqty').value=='')
  {
    alert("Please enter assy qty\n");
    return false;
  }
  if(document.getElementById('assy_type').value=='')
  {
    alert("Please select an Assy Type\n");
    return false;
  }
  
  // document.getElementById("cust_ponum").value="";
  // document.getElementById("po_qty").value="";
  // document.getElementById("companyname").value="";
  var assy_type=document.getElementById('assy_type').value;
  win1 = window.open("getAssy_cim_bom.php?assy_type="+assy_type, param, +
  "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
  ",width=" + winWidth + ",height=" + winHeight +
  ",top="+winTop+",left="+winLeft);
}

function Setcrn_assy(CIM,fieldname)
{

   var CIM = CIM.split("|");

   // var id2="crn";
   // var text2= document.getElementById(id2);
   // text2.value=CIM[0];

   // var id3="assy_partno";
   // var text3= document.getElementById(id3);
   // text3.value=CIM[3];

   // var id4="drg_iss";
   // var text4= document.getElementById(id4);
   // text4.value=CIM[6];

   // var id6="cos_num";
   // var text6= document.getElementById(id6);
   // text6.value=CIM[7];

   // var id7="drg_no";
   // var text7= document.getElementById(id7);
   // text7.value=CIM[5];

   // var id8="assy_partiss";
   // var text8= document.getElementById(id8);
   // text8.value=CIM[4];

  var id9="bomnum";
  var text9= document.getElementById(id9);
  text9.value=CIM[1];

  var id10="bomiss";
  var text10= document.getElementById(id10);
  text10.value=CIM[2];
   
   

   // var id11="mpsnumber";
   // var text11= document.getElementById(id11);
   // text11.value=CIM[9];

   // var id12="mpsrev";
   // var text12= document.getElementById(id12);
   // text12.value=CIM[10];

   //  var id13="link2mps";
   // var text13= document.getElementById(id13);
   // text13.value=CIM[11];

  /* var id14="bomrevnum";
   var text14= document.getElementById(id14);
   text14.value=CIM[12]; */
   
   // var id14="descr";
   // var text14= document.getElementById(id14);
   // text14.value=CIM[12];

   // var id15="rework_grn";
   // var text15= document.getElementById(id15);
   // text15.value=CIM[14];
   
   getbomDetails(CIM[1],CIM[2],CIM[13]);

}

function GetAllCustomers(rt) {
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getcustomers.php?reasontext=" + rt, "Customers", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft+",dependent=yes");
}
function SetCustomer(customer,custrecnum) {
document.forms[0].companyname.value = customer;
document.forms[0].customer.value = custrecnum;
}

function GetPO_old(rt)
{
//alert(rt);
var param = rt;
var winWidth = 400;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getpo_assy.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function  Setcustpo(PO,fieldname)
{

 var PO = PO.split("|");

 var id1="cust_ponum";
 var text1= document.getElementById(id1);
 text1.value=PO[0];

 var id2="po_qty";
 var text2= document.getElementById(id2);
 text2.value=PO[1];
}

function addRow4int(id,ind1){
	// things to add
	ind1= parseInt(ind1);
	//alert(ind1);
	var y = ind1;
	mmline_num="mmline_num"+ind1;
	stage="stage"+ind1;
	from= "from" + ind1;
	to="to"+ind1;
	sampling="sampling"+ind1;
	rework="rework"+ind1;
	accept="accept"+ind1;
	reject="reject"+ind1;
	returns="returns"+ind1;
	date="date"+ind1;
	inspno="inspno"+ind1;

	signoff="signoff"+ind1;
	remarks="remarks"+ind1;
	intlirecnum="intlirecnum"+ind1;
	recno="recno"+ind1;
	var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];

	var row = document.createElement("TR");
	row.style.backgroundColor = "#FFFFFF";

//intline_num
var cell0 = document.createElement("TD");

var inp0 = document.createElement("INPUT");
inp0.setAttribute("type","text");
inp0.setAttribute("size","4");
inp0.setAttribute("name",mmline_num);
inp0.setAttribute("id",mmline_num);
//inp1.setAttribute("value",irmline_num);
cell0.appendChild(inp0);

//stage
var cell8 = document.createElement("TD");

var inp8 = document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","4");
inp8.setAttribute("name",stage);
inp8.setAttribute("id",stage);
//inp1.setAttribute("value",irmline_num);
cell8.appendChild(inp8);

//mmlirecnum
var inp100 = document.createElement("INPUT");
inp100.setAttribute("type","hidden");
inp100.setAttribute("size","");
inp100.setAttribute("name",intlirecnum);
inp100.setAttribute("id",intlirecnum);
cell0.appendChild(inp100);
//recno
var inp101 = document.createElement("INPUT");
inp101.setAttribute("type","hidden");
inp101.setAttribute("size","");
inp101.setAttribute("name",recno);
inp101.setAttribute("id",recno);
cell0.appendChild(inp101);
//from
var cell1 = document.createElement("TD");

var inp1 = document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","4");
inp1.setAttribute("name",from);
inp1.setAttribute("id",from);
//inp1.setAttribute("value",irmline_num);
cell1.appendChild(inp1);
//to
var cell2 = document.createElement("TD");

var inp2 = document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","4");
inp2.setAttribute("name",to);
inp2.setAttribute("id",to);
//inp1.setAttribute("value",irmline_num);
cell2.appendChild(inp2);

//sampling
var cell3 = document.createElement("TD");

var inp3 = document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","8");
inp3.setAttribute("name",sampling);
inp3.setAttribute("id",sampling);
//inp1.setAttribute("value",irmline_num);
cell3.appendChild(inp3);
//accept
var cell5 = document.createElement("TD");

var inp5 = document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","4");
inp5.setAttribute("name",accept);
inp5.setAttribute("id",accept);
//inp1.setAttribute("value",irmline_num);
cell5.appendChild(inp5);
//rework
var cell4 = document.createElement("TD");

var inp4 = document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","4");
inp4.setAttribute("name",rework);
inp4.setAttribute("id",rework);
//inp1.setAttribute("value",irmline_num);
cell4.appendChild(inp4);

//reject
var cell6 = document.createElement("TD");

var inp6 = document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","4");
inp6.setAttribute("name",reject);
inp6.setAttribute("id",reject);
//inp1.setAttribute("value",irmline_num);
cell6.appendChild(inp6);
//returns
var cell7 = document.createElement("TD");

var inp7 = document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","4");
inp7.setAttribute("name",returns);
inp7.setAttribute("id",returns);
//inp1.setAttribute("value",irmline_num);
cell7.appendChild(inp7);
 //date
var cell12 = document.createElement("TD");

var inp12 = document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","10");
inp12.setAttribute("name",date);
inp12.setAttribute("id",date);
inp12.setAttribute("readonly","readonly");
inp12.style.backgroundColor = "#DDDDDD";

var img1 = document.createElement("img");
img1.setAttribute("src","images/bu-getdateicon.gif");
img1.setAttribute("alt","GetDate");
img1.onclick = function(){GetDate("date"+y);};
cell12.appendChild(inp12);
cell12.appendChild(img1);
//inspno
var cell17 = document.createElement("TD");

var inp17 = document.createElement("INPUT");
inp17.setAttribute("type","text");
inp17.setAttribute("size","20");
inp17.setAttribute("name",inspno);
inp17.setAttribute("id",inspno);
//inp1.setAttribute("value",irmline_num);
cell17.appendChild(inp17);


//signoff
var cell9 = document.createElement("TD");

var inp9 = document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","20");
inp9.setAttribute("name",signoff);
inp9.setAttribute("id",signoff);
//inp1.setAttribute("value",irmline_num);
cell9.appendChild(inp9);
//remarks
var cell10 = document.createElement("TD");

var inp10 = document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","50");
inp10.setAttribute("name",remarks);
inp10.setAttribute("id",remarks);
//inp1.setAttribute("value",irmline_num);
cell10.appendChild(inp10);

row.appendChild(cell0);
row.appendChild(cell8);
row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell5);
row.appendChild(cell4);

row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell12);

row.appendChild(cell17);

row.appendChild(cell9);
row.appendChild(cell10);
tbody.appendChild(row);

ind1++;
document.forms[0].indexmm.value=ind1;
document.forms[0].curindex.value=ind1;

}

function getgrn_wo(rt)
{
   //alert(rt);
   param=rt;
   var index = document.forms[0].index.value;
   var i=1;
    //while(i<=index)
    //{
      // ln = "line_num" + rt;
       itemno = "itemno" + rt;
       
         type="type"+rt;
      // lnv = document.getElementById(ln).value;
       //alert(document.getElementById(type).value+"b4if");	  
       if(document.getElementById(type).value=='Non Assembly' ||document.getElementById(type).value=='Assembly')
       {
         crn="crn_num4li"+rt;

         crn_num= document.getElementById(crn).value;

         crn_type="crn_type"+rt;
         crn_type=document.getElementById(crn_type).value;
              type=document.getElementById(type).value;
         var winWidth = 880;
         var winHeight = 500;
         var winLeft = (screen.width-winWidth)/2;
         var winTop = (screen.height-winHeight)/2;
         var crn= document.getElementById('crn').value;
                      win1 = window.open("getallwo4assy.php?cim_refnum="+crn_num+"&type="+type+"&crn_type="+crn_type, param, +
                  "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
                  ",width=" + winWidth + ",height=" + winHeight +
                  ",top="+winTop+",left="+winLeft);
       }
       else
       {
          //alert(document.getElementById(type).value);
         partnum="partnum"+rt;
         part_num= document.getElementById(partnum).value;
         var winWidth = 880;
         var winHeight = 300;
         var winLeft = (screen.width-winWidth)/2;
         var winTop = (screen.height-winHeight)/2;
         var crn= document.getElementById('crn').value;
                  win1 = window.open("getgrns4assywo.php?partnum="+part_num+"&type="+document.getElementById(type).value, param, +
                  "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
                  ",width=" + winWidth + ",height=" + winHeight +
                  ",top="+winTop+",left="+winLeft);

       }
      //i++;
    //}
}
function Getpo(rt)
{
//alert(rt + 'hiii');
var param = rt;
var winWidth = 1000;
var winHeight = 400;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var crn= document.getElementById('crn').value;
var assy_partno= document.getElementById('assy_partno').value;
if(crn=='')
{
  alert("Please select a CRN\n");
  return false;
}
win1 = window.open("getpo4assywo.php?cim_refnum="+crn+"&partnum="+assy_partno+"&woclassif="+'Assembly', param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function Setpo(po,custrecnum) 
{

  // alert(po);
var po = po.split("|");
document.getElementById('cust_po_line_num').value = po[0];

document.getElementById('cust_ponum').value = po[1];

document.getElementById('po_qty').value = po[3];

document.getElementById('companyname').value = po[4];

document.forms[0].customer.value = po[5];
var index=document.forms[0].index.value;
//alert(index)
var i=1;
while(i<index)
{ //document.getElementById(line_num).value
  line_num="line_num"+i;
  document.getElementById(line_num).value=po[0]+"-"+i;
  // alert(ln);
  i++;
}


}

function SetWo4assy(woarr,fieldname)
 {    //alert(woarr+"*******"+fieldname);
   var data4wo = woarr.split("|");
    // alert(data4wo);

   var id1="grn"+ fieldname;
   var id2 = "qty_wo" +fieldname;
  // alert(id1);
   var text1= document.getElementById(id1);
   text1.value=data4wo[0];
   
   var id3="remarks_li"+ fieldname;
    var id4="dnrecnum"+ fieldname;
  if(data4wo[4] < parseInt(document.getElementById(id2).value))
  {
      alert(" Available Qty is less than Qty for WO \n ");
      return false;
  }

   document.getElementById(id3).value=data4wo[2];
   document.getElementById(id4).value=data4wo[5];



}

function SetGRN(grns,grnvalue,fieldname)
{
// alert(document.getElementById('avail_qty'+fieldname).value);
   var data4wo = grns.split("|");
   var id2="qty_wo"+fieldname;
// alert(data4wo);
  // alert(document.getElementById(id2).value+"----qty----"+data4wo[2]);
   if(parseInt(document.getElementById(id2).value) > parseInt(data4wo[2]))
   {
    alert("QTY for WO cannot be greater than GRN qty");
    return false;
   }
   var id1="grn"+ fieldname;
   var text1= document.getElementById(id1);
   document.getElementById('avail_qty'+fieldname).value= parseInt(data4wo[2]);
   
   
var d=new Date();
var day = d.getDate();
var year = d.getFullYear();
var month=d.getMonth()+1;
if (month < 10) {
    month = '0' + month;
}
var current_date=(year+'-'+month+'-'+day);
exp_date="exp_date"+ fieldname;
if(data4wo[6] >= current_date)
{
	document.getElementById(exp_date).value=data4wo[6];
}
else
{
    if(data4wo[6]!= '0000-00-00')
	{
	   alert("Expiry Date should be greater than Current Date");
    document.getElementById('rmponum_li'+fieldname).value = "";
    document.getElementById('rmponum_linum'+fieldname).value = "";
    document.getElementById('cost_li'+fieldname).value = "";
	}
document.getElementById(exp_date).value='';
}
text1.value=data4wo[0];

//document.forms[0].grnnum.value = grns;
  
  // var bomli_type = document.getElementById('type'+fieldname).value;

  // if (bomli_type == "Bought Out" || bomli_type == "Consummables") 
  // {
  //   document.getElementById('rmponum_li'+fieldname).value = data4wo[7];
  //   document.getElementById('rmponum_linum'+fieldname).value = data4wo[8];
  //   document.getElementById('cost_li'+fieldname).value= parseInt(document.getElementById(id2).value)*parseFloat(data4wo[9]);
  // }



}

function addRow4intassy(id,ind1){
	// things to add
	ind1= parseInt(ind1);
	//alert(ind1);
	var y = ind1;
	mmline_num="line_num"+ind1;
	type="type"+ind1;
	itemno= "itemno" + ind1;
	crn_num4li="crn_num4li"+ind1;
	crn_type="crn_type"+ind1;
	partnum="partnum"+ind1;
	issue="issue"+ind1;
	descr="descr"+ind1;
	qty="qty"+ind1;
	uom="uom"+ind1;
	qty_wo="qty_wo"+ind1;
	qty_acc="qty_acc"+ind1;
	qty_rew="qty_rew"+ind1;
	qty_ret="qty_ret"+ind1;
	qty_rej="qty_rej"+ind1;
	grn="grn"+ind1;
	exp_date="exp_date"+ind1;
	prevlinenum="prevlinenum"+ind1;
	lirecnum="lirecnum"+ind1;
  pcrn_num= "pcrn_num" + ind1;
  remarks="remarks_li"+ind1;

  rmponum_li = "rmponum_li"+ ind1;
  cost_li = "cost_li"+ ind1;
  rmponum_linum = "rmponum_linum"+ ind1;
  avail_qty = "avail_qty" + ind1;
  rmpoimg = "rmpoimg" + ind1;

	var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
	var row = document.createElement("TR");
	row.style.backgroundColor = "#FFFFFF";

//intline_num
var cell0 = document.createElement("TD");
var inp0 = document.createElement("INPUT");
inp0.setAttribute("type","text");
inp0.setAttribute("size","3");
inp0.setAttribute("name",mmline_num);
inp0.setAttribute("id",mmline_num);
//inp0.setAttribute("value","1");
cell0.appendChild(inp0);

//stage
var cell8 = document.createElement("TD");

var inp8 = document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","13");
inp8.setAttribute("name",type);
inp8.setAttribute("id",type);
inp8.style.backgroundColor = "#DDDDDD";
inp8.readOnly = true;
//inp8.setAttribute("value","2");
cell8.appendChild(inp8);

//mmlirecnum
var inp100 = document.createElement("INPUT");
inp100.setAttribute("type","hidden");
inp100.setAttribute("size","");
inp100.setAttribute("name",lirecnum);
inp100.setAttribute("id",lirecnum);
cell0.appendChild(inp100);
//recno
var inp101 = document.createElement("INPUT");
inp101.setAttribute("type","hidden");
inp101.setAttribute("size","");
inp101.setAttribute("name",pcrn_num);
inp101.setAttribute("id",pcrn_num);
cell0.appendChild(inp101);

var inp102 = document.createElement("INPUT");
inp102.setAttribute("type","hidden");
inp102.setAttribute("size","");
inp102.setAttribute("name",prevlinenum);
inp102.setAttribute("id",prevlinenum);
cell0.appendChild(inp102);

var inp103 = document.createElement("INPUT");
inp103.setAttribute("type","hidden");
inp103.setAttribute("size","");
inp103.setAttribute("name",avail_qty);
inp103.setAttribute("id",avail_qty);
cell0.appendChild(inp103);



//from
var cell1 = document.createElement("TD");

var inp1 = document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","6");
inp1.setAttribute("name",itemno);
inp1.setAttribute("id",itemno);
inp1.style.backgroundColor = "#DDDDDD";
inp1.readOnly = true;
//inp1.setAttribute("value","3");
cell1.appendChild(inp1);
//to
var cell2 = document.createElement("TD");

var inp2 = document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","6");
inp2.setAttribute("name",crn_num4li);
inp2.setAttribute("id",crn_num4li);
inp2.style.backgroundColor = "#DDDDDD";
inp2.readOnly = true;
//inp2.setAttribute("value","4");
//cell2.appendChild(inp2);

var img2 = document.createElement("img");
img2.setAttribute("src","images/getcim.gif");
img2.setAttribute("alt","Get CRN");
img2.onclick = function(){getcrndet4li(y);};
cell2.appendChild(inp2);
cell2.appendChild(img2);

//sampling
var cell3 = document.createElement("TD");

var inp3 = document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","13");
inp3.setAttribute("name",crn_type);
inp3.setAttribute("id",crn_type);
inp3.style.backgroundColor = "#DDDDDD";
inp3.readOnly = true;
//inp3.setAttribute("value","5");
cell3.appendChild(inp3);
//accept
var cell5 = document.createElement("TD");

var inp5 = document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","20");
inp5.setAttribute("name",partnum);
inp5.setAttribute("id",partnum);
inp5.style.backgroundColor = "#DDDDDD";
inp5.readOnly = true;
//inp5.setAttribute("value","6");
cell5.appendChild(inp5);
//rework
var cell4 = document.createElement("TD");

var inp4 = document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","15");
inp4.setAttribute("name",issue);
inp4.setAttribute("id",issue);
inp4.style.backgroundColor = "#DDDDDD";
inp4.readOnly = true;
//inp4.setAttribute("value","7");
cell4.appendChild(inp4);

//reject
var cell6 = document.createElement("TD");

var inp6 = document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","23");
inp6.setAttribute("name",descr);
inp6.setAttribute("id",descr);
inp6.style.backgroundColor = "#DDDDDD";
inp6.readOnly = true;
//inp6.setAttribute("value","8");
cell6.appendChild(inp6);
//returns
var cell7 = document.createElement("TD");

var inp7 = document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","5");
inp7.setAttribute("name",qty);
inp7.setAttribute("id",qty);
inp7.style.backgroundColor = "#DDDDDD";
inp7.readOnly = true;
//inp7.setAttribute("readOnly","true");
//inp7.style.backgroundColor = "#DDDDDD";
//inp7.setAttribute("value","9");
cell7.appendChild(inp7);
 //date
var cell12 = document.createElement("TD");

var inp12 = document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","8");
inp12.setAttribute("name",exp_date);
inp12.setAttribute("id",exp_date);
inp12.setAttribute("readonly","readonly");
inp12.style.backgroundColor = "#DDDDDD";


//inp12.setAttribute("value","10");
var img1 = document.createElement("img");
img1.setAttribute("src","images/bu-getdateicon.gif");
img1.setAttribute("alt","GetDate");
img1.onclick = function(){GetDate("exp_date"+y);};
cell12.appendChild(inp12);
cell12.appendChild(img1);
//inspno
var cell17 = document.createElement("TD");

var inp17 = document.createElement("INPUT");
inp17.setAttribute("type","text");
inp17.setAttribute("size","8");
inp17.setAttribute("name",uom);
inp17.setAttribute("id",uom);
//inp17.setAttribute("value","11");
cell17.appendChild(inp17);


//signoff
var cell9 = document.createElement("TD");

var inp9 = document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","4");
inp9.setAttribute("name",qty_wo);
inp9.setAttribute("id",qty_wo);
//inp9.setAttribute("value","12");
cell9.appendChild(inp9);
//remarks
var cell10 = document.createElement("TD");

var inp10 = document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","4");
inp10.setAttribute("name",qty_acc);
inp10.setAttribute("id",qty_acc);
//inp10.setAttribute("value","13");
cell10.appendChild(inp10);

var cell18 = document.createElement("TD");
var inp18 = document.createElement("INPUT");
inp18.setAttribute("type","text");
inp18.setAttribute("size","4");
inp18.setAttribute("name",qty_rew);
inp18.setAttribute("id",qty_rew);
//inp18.setAttribute("value","14");
cell18.appendChild(inp18);

var cell19 = document.createElement("TD");
var inp19 = document.createElement("INPUT");
inp19.setAttribute("type","text");
inp19.setAttribute("size","4");
inp19.setAttribute("name",qty_rej);
inp19.setAttribute("id",qty_rej);
//inp19.setAttribute("value","15");
cell19.appendChild(inp19);

var cell20 = document.createElement("TD");
var inp20 = document.createElement("INPUT");
inp20.setAttribute("type","text");
inp20.setAttribute("size","4");
inp20.setAttribute("name",qty_ret);
inp20.setAttribute("id",qty_ret);
//inp20.setAttribute("value","16");
cell20.appendChild(inp20);
//alert(ind1);
var cell21 = document.createElement("TD");
var inp21 = document.createElement("INPUT");
inp21.setAttribute("type","text");
inp21.setAttribute("size","10");
inp21.setAttribute("name",grn);
inp21.setAttribute("id",grn);
//inp21.setAttribute("value","17");
inp21.setAttribute("readOnly",true);
inp21.style.backgroundColor = "#DDDDDD";

var img2 = document.createElement("img");
img2.setAttribute("src","images/bu-get.gif");
img2.onclick = function(){getgrn_wo(y);};
cell21.appendChild(inp21);
cell21.appendChild(img2);

var cell22 = document.createElement("TD");

var inp22 = document.createElement("INPUT");
inp22.setAttribute("type","text");
inp22.setAttribute("size","27");
inp22.setAttribute("name",remarks);
inp22.setAttribute("id",remarks);
cell22.appendChild(inp22);

var cell23 = document.createElement("TD");
var inp23 = document.createElement("INPUT");
inp23.setAttribute("type","text");
inp23.setAttribute("size","10");
inp23.setAttribute("name",rmponum_li);
inp23.setAttribute("id",rmponum_li);
inp23.setAttribute("readonly","readonly");
inp23.style.backgroundColor = "#DDDDDD";

var img3 = document.createElement("img");
img3.setAttribute("src","images/bu-get.gif");
img3.setAttribute("id",rmpoimg);
img3.onclick = function(){GetRmpoNum4BOI('',y);};
img3.style.display = "none";
cell23.appendChild(inp23);
cell23.appendChild(img3);



var cell24 = document.createElement("TD");
var inp24 = document.createElement("INPUT");
inp24.setAttribute("type","text");
inp24.setAttribute("size","10");
inp24.setAttribute("name",rmponum_linum);
inp24.setAttribute("id",rmponum_linum);
inp24.setAttribute("readonly","readonly");
inp24.style.backgroundColor = "#DDDDDD";
cell24.appendChild(inp24);

var cell25 = document.createElement("TD");
var inp25 = document.createElement("INPUT");
inp25.setAttribute("type","text");
inp25.setAttribute("size","10");
inp25.setAttribute("name",rmponum_linum);
inp25.setAttribute("id",rmponum_linum);
inp25.setAttribute("readonly","readonly");
inp25.style.backgroundColor = "#DDDDDD";
cell25.appendChild(inp25);

//inp22.setAttribute("value","18");
//inp1.setAttribute("value",irmline_num);


row.appendChild(cell0);
row.appendChild(cell8);
row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell5);
row.appendChild(cell4);
row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell17);

row.appendChild(cell9);
row.appendChild(cell10);
row.appendChild(cell18);
row.appendChild(cell19);
row.appendChild(cell20);

row.appendChild(cell23);
row.appendChild(cell24);
row.appendChild(cell25);

row.appendChild(cell21);

row.appendChild(cell12);
row.appendChild(cell22);
row.appendChild(inp100);
row.appendChild(inp101);
row.appendChild(inp102);


tbody.appendChild(row);

ind1++;
document.forms[0].index.value=ind1;
//document.forms[0].curindex.value=ind1;

}


/*function addRow4intassy(id,ind1){
	// things to add
	ind1= parseInt(ind1);
	//alert(ind1+"assy");
	var y = ind1;
	mmline_num="line_num"+ind1;
	type="type"+ind1;
	itemno= "itemno" + ind1;
	crn_num4li="crn_num4li"+ind1;
	crn_type="crn_type"+ind1;
	partnum="partnum"+ind1;
	issue="issue"+ind1;
	descr="descr"+ind1;
	qty="qty"+ind1;
	uom="uom"+ind1;
	qty_wo="qty_wo"+ind1;
	qty_acc="qty_acc"+ind1;
	qty_rew="qty_rew"+ind1;
	qty_ret="qty_ret"+ind1;
	qty_rej="qty_rej"+ind1;
	grn="grn"+ind1;
	exp_date="exp_date"+ind1;
	prevlinenum="prevlinenum"+ind1;
	lirecnum="lirecnum"+ind1;
     pcrn_num= "pcrn_num" + ind1;
     remarks="remarks"+ind1;
     
	var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
	var row = document.createElement("TR");
	row.style.backgroundColor = "#FFFFFF";

//intline_num
var cell0 = document.createElement("TD");
var inp0 = document.createElement("INPUT");
inp0.setAttribute("type","text");
inp0.setAttribute("size","3");
inp0.setAttribute("name",mmline_num);
inp0.setAttribute("id",mmline_num);
//inp0.setAttribute("value","1");
cell0.appendChild(inp0);

//stage
var cell8 = document.createElement("TD");

var inp8 = document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","13");
inp8.setAttribute("name",type);
inp8.setAttribute("id",type);
//inp8.setAttribute("value","2");
cell8.appendChild(inp8);

//mmlirecnum
var inp100 = document.createElement("INPUT");
inp100.setAttribute("type","hidden");
inp100.setAttribute("size","");
inp100.setAttribute("name",lirecnum);
inp100.setAttribute("id",lirecnum);
cell0.appendChild(inp100);
//recno
var inp101 = document.createElement("INPUT");
inp101.setAttribute("type","hidden");
inp101.setAttribute("size","");
inp101.setAttribute("name",pcrn_num);
inp101.setAttribute("id",pcrn_num);
cell0.appendChild(inp101);

var inp102 = document.createElement("INPUT");
inp102.setAttribute("type","hidden");
inp102.setAttribute("size","");
inp102.setAttribute("name",prevlinenum);
inp102.setAttribute("id",prevlinenum);
cell0.appendChild(inp102);
//from
var cell1 = document.createElement("TD");

var inp1 = document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","6");
inp1.setAttribute("name",itemno);
inp1.setAttribute("id",itemno);
//inp1.setAttribute("value","3");
cell1.appendChild(inp1);
//to
var cell2 = document.createElement("TD");

var inp2 = document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","6");
inp2.setAttribute("name",crn_num4li);
inp2.setAttribute("id",crn_num4li);
//inp2.setAttribute("value","4");
cell2.appendChild(inp2);

//sampling
var cell3 = document.createElement("TD");

var inp3 = document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","13");
inp3.setAttribute("name",crn_type);
inp3.setAttribute("id",crn_type);
//inp3.setAttribute("value","5");
cell3.appendChild(inp3);
//accept
var cell5 = document.createElement("TD");

var inp5 = document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","20");
inp5.setAttribute("name",partnum);
inp5.setAttribute("id",partnum);
//inp5.setAttribute("value","6");
cell5.appendChild(inp5);
//rework
var cell4 = document.createElement("TD");

var inp4 = document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","15");
inp4.setAttribute("name",issue);
inp4.setAttribute("id",issue);
//inp4.setAttribute("value","7");
cell4.appendChild(inp4);

//reject
var cell6 = document.createElement("TD");

var inp6 = document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","23");
inp6.setAttribute("name",descr);
inp6.setAttribute("id",descr);
//inp6.setAttribute("value","8");
cell6.appendChild(inp6);
//returns
var cell7 = document.createElement("TD");

var inp7 = document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","5");
inp7.setAttribute("name",qty);
inp7.setAttribute("id",qty);
//inp7.setAttribute("readOnly","true");
//inp7.style.backgroundColor = "#DDDDDD";
//inp7.setAttribute("value","9");
cell7.appendChild(inp7);
 //date
var cell12 = document.createElement("TD");

var inp12 = document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","8");
inp12.setAttribute("name",exp_date);
inp12.setAttribute("id",exp_date);
inp12.setAttribute("readonly","readonly");
inp12.style.backgroundColor = "#DDDDDD";
//inp12.setAttribute("value","10");
var img1 = document.createElement("img");
img1.setAttribute("src","images/bu-getdateicon.gif");
img1.setAttribute("alt","GetDate");
img1.onclick = function(){GetDate("exp_date"+y);};
cell12.appendChild(inp12);
cell12.appendChild(img1);
//inspno
var cell17 = document.createElement("TD");

var inp17 = document.createElement("INPUT");
inp17.setAttribute("type","text");
inp17.setAttribute("size","8");
inp17.setAttribute("name",uom);
inp17.setAttribute("id",uom);
//inp17.setAttribute("value","11");
cell17.appendChild(inp17);


//signoff
var cell9 = document.createElement("TD");

var inp9 = document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","4");
inp9.setAttribute("name",qty_wo);
inp9.setAttribute("id",qty_wo);
//inp9.setAttribute("value","12");
cell9.appendChild(inp9);
//remarks
var cell10 = document.createElement("TD");

var inp10 = document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","4");
inp10.setAttribute("name",qty_acc);
inp10.setAttribute("id",qty_acc);
//inp10.setAttribute("value","13");
cell10.appendChild(inp10);

var cell18 = document.createElement("TD");
var inp18 = document.createElement("INPUT");
inp18.setAttribute("type","text");
inp18.setAttribute("size","4");
inp18.setAttribute("name",qty_rew);
inp18.setAttribute("id",qty_rew);
//inp18.setAttribute("value","14");
cell18.appendChild(inp18);

var cell19 = document.createElement("TD");
var inp19 = document.createElement("INPUT");
inp19.setAttribute("type","text");
inp19.setAttribute("size","4");
inp19.setAttribute("name",qty_rej);
inp19.setAttribute("id",qty_rej);
//inp19.setAttribute("value","15");
cell19.appendChild(inp19);

var cell20 = document.createElement("TD");
var inp20 = document.createElement("INPUT");
inp20.setAttribute("type","text");
inp20.setAttribute("size","4");
inp20.setAttribute("name",qty_ret);
inp20.setAttribute("id",qty_ret);
//inp20.setAttribute("value","16");
cell20.appendChild(inp20);
//alert(ind1);
var cell21 = document.createElement("TD");
var inp21 = document.createElement("INPUT");
inp21.setAttribute("type","text");
inp21.setAttribute("size","10");
inp21.setAttribute("name",grn);
inp21.setAttribute("id",grn);
//inp21.setAttribute("value","17");
inp21.setAttribute("readOnly",true);
inp21.style.backgroundColor = "#DDDDDD";
var img2 = document.createElement("img");
img2.setAttribute("src","images/bu-get.gif");
img2.onclick = function(){getgrn_wo(y);};
cell21.appendChild(inp21);
cell21.appendChild(img2);

var cell22 = document.createElement("TD");

var inp22 = document.createElement("INPUT");
inp22.setAttribute("type","text");
inp22.setAttribute("size","27");
inp22.setAttribute("name",remarks);
inp22.setAttribute("id",remarks);
//inp22.setAttribute("value","18");
//inp1.setAttribute("value",irmline_num);
cell22.appendChild(inp22);

row.appendChild(cell0);
row.appendChild(cell8);
row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell5);
row.appendChild(cell4);
row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell17);

row.appendChild(cell9);
row.appendChild(cell10);
row.appendChild(cell18);
row.appendChild(cell19);
row.appendChild(cell20);
row.appendChild(cell21);
row.appendChild(cell12);
row.appendChild(cell22);
row.appendChild(inp100);
row.appendChild(inp101);
row.appendChild(inp102);


tbody.appendChild(row);

ind1++;
document.forms[0].index.value=ind1;
//document.forms[0].curindex.value=ind1;

} */

function addRowprtstat(id,ind1){
//alert("HERE");
	// things to add
	ind1= parseInt(ind1);
	//alert(ind1);
	var y = ind1;
	mmline_num="mmline_num"+ind1;
	stage="stage"+ind1;
	from= "from" + ind1;
	to="to"+ind1;
	sampling="sampling"+ind1;
	rework="rework"+ind1;
	accept="accept"+ind1;
	reject="reject"+ind1;
	returns="returns"+ind1;
	date="date"+ind1;
	inspno="inspno"+ind1;

	signoff="signoff"+ind1;
	remarks="remarks"+ind1;
	intlirecnum="intlirecnum"+ind1;
	recno="recno"+ind1;
	var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];

	var row = document.createElement("TR");
	row.style.backgroundColor = "#FFFFFF";

//intline_num
var cell0 = document.createElement("TD");

var inp0 = document.createElement("INPUT");
inp0.setAttribute("type","text");
inp0.setAttribute("size","4");
inp0.setAttribute("name",mmline_num);
inp0.setAttribute("id",mmline_num);
//inp1.setAttribute("value",irmline_num);
cell0.appendChild(inp0);

//stage
var cell8 = document.createElement("TD");

var inp8 = document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","4");
inp8.setAttribute("name",stage);
inp8.setAttribute("id",stage);
//inp1.setAttribute("value",irmline_num);
cell8.appendChild(inp8);

//mmlirecnum
var inp100 = document.createElement("INPUT");
inp100.setAttribute("type","hidden");
inp100.setAttribute("size","");
inp100.setAttribute("name",intlirecnum);
inp100.setAttribute("id",intlirecnum);
cell0.appendChild(inp100);
//recno
var inp101 = document.createElement("INPUT");
inp101.setAttribute("type","hidden");
inp101.setAttribute("size","");
inp101.setAttribute("name",recno);
inp101.setAttribute("id",recno);
cell0.appendChild(inp101);
//from
var cell1 = document.createElement("TD");

var inp1 = document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","4");
inp1.setAttribute("name",from);
inp1.setAttribute("id",from);
//inp1.setAttribute("value",irmline_num);
cell1.appendChild(inp1);
//to
var cell2 = document.createElement("TD");

var inp2 = document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","4");
inp2.setAttribute("name",to);
inp2.setAttribute("id",to);
//inp1.setAttribute("value",irmline_num);
cell2.appendChild(inp2);

//sampling
var cell3 = document.createElement("TD");

var inp3 = document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","8");
inp3.setAttribute("name",sampling);
inp3.setAttribute("id",sampling);
//inp1.setAttribute("value",irmline_num);
cell3.appendChild(inp3);
//accept
var cell5 = document.createElement("TD");

var inp5 = document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","4");
inp5.setAttribute("name",accept);
inp5.setAttribute("id",accept);
//inp1.setAttribute("value",irmline_num);
cell5.appendChild(inp5);
//rework
var cell4 = document.createElement("TD");

var inp4 = document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","4");
inp4.setAttribute("name",rework);
inp4.setAttribute("id",rework);
//inp1.setAttribute("value",irmline_num);
cell4.appendChild(inp4);

//reject
var cell6 = document.createElement("TD");

var inp6 = document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","4");
inp6.setAttribute("name",reject);
inp6.setAttribute("id",reject);
//inp1.setAttribute("value",irmline_num);
cell6.appendChild(inp6);
//returns
var cell7 = document.createElement("TD");

var inp7 = document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","4");
inp7.setAttribute("name",returns);
inp7.setAttribute("id",returns);
//inp1.setAttribute("value",irmline_num);
cell7.appendChild(inp7);
 //date
var cell12 = document.createElement("TD");

var inp12 = document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","10");
inp12.setAttribute("name",date);
inp12.setAttribute("id",date);
inp12.setAttribute("readonly","readonly");
inp12.style.backgroundColor = "#DDDDDD";

var img1 = document.createElement("img");
img1.setAttribute("src","images/bu-getdateicon.gif");
img1.setAttribute("alt","GetDate");
img1.onclick = function(){GetDate("date"+y);};
cell12.appendChild(inp12);
cell12.appendChild(img1);
//inspno
var cell17 = document.createElement("TD");

var inp17 = document.createElement("INPUT");
inp17.setAttribute("type","text");
inp17.setAttribute("size","20");
inp17.setAttribute("name",inspno);
inp17.setAttribute("id",inspno);
//inp1.setAttribute("value",irmline_num);
cell17.appendChild(inp17);


//signoff
var cell9 = document.createElement("TD");

var inp9 = document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","20");
inp9.setAttribute("name",signoff);
inp9.setAttribute("id",signoff);
//inp1.setAttribute("value",irmline_num);
cell9.appendChild(inp9);
//remarks
var cell10 = document.createElement("TD");

var inp10 = document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","50");
inp10.setAttribute("name",remarks);
inp10.setAttribute("id",remarks);
//inp1.setAttribute("value",irmline_num);
cell10.appendChild(inp10);

row.appendChild(cell0);
row.appendChild(cell8);
row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell5);
row.appendChild(cell4);

row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell12);

row.appendChild(cell17);

row.appendChild(cell9);
row.appendChild(cell10);
tbody.appendChild(row);

ind1++;
document.forms[0].indexmm.value=ind1;
document.forms[0].curindex.value=ind1;

}

function onSelectType(assy_type)
{

	document.getElementById('assy_type').value = assy_type.value;
document.getElementById('crn').value ='';
document.getElementById('assy_partno').value ='';
document.getElementById('assy_partiss').value ='';
document.getElementById('drg_no').value ='';
document.getElementById('drg_iss').value ='';
document.getElementById('bomnum').value ='';
document.getElementById('bomiss').value ='';
document.getElementById('mpsnumber').value ='';
document.getElementById('mpsrev').value ='';

	//alert(status.value);

	//alert(document.getElementById('status').value);
     return true;
}

function getcrndet4li(rt)
{
//alert(rt);
var bom_num=document.getElementById('bomnum').value;
var assy_qty=document.getElementById('assy_woqty').value;
var winWidth = 1000;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getcim4assywoli.php?bomnum="+bom_num+"&assy_qty="+assy_qty+"&index="+rt, "PrintAssywo", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function Setcrn_assy4li(crnarr,fieldname)
{
   //alert(crnarr+"----"+fieldname);
   var CIM = crnarr.split("|");

   var id2="type"+ fieldname;
   var text2= document.getElementById(id2);
   text2.value=CIM[0];

   var id3="itemno"+ fieldname;
   var text3= document.getElementById(id3);
   text3.value=CIM[1];

   var id4="crn_num4li"+ fieldname;
   var text4= document.getElementById(id4);
   text4.value=CIM[2];

   var id5="crn_type"+ fieldname;
   var text5= document.getElementById(id5);
   text5.value=CIM[3];

   var id6="partnum"+ fieldname;
   var text6= document.getElementById(id6);
   text6.value=CIM[4];

   var id7="issue"+ fieldname;
   var text7= document.getElementById(id7);
   text7.value=CIM[5];

   var id8="descr"+ fieldname;
   var text8= document.getElementById(id8);
   text8.value=CIM[6];

   var id9="qty"+ fieldname;
   var text9= document.getElementById(id9);

	  if(CIM[7] == '')
		  var qty=0;
	  else
		  var qty=CIM[7];	
	 
   text9.value=qty;

   var id10="qty_wo"+ fieldname;
   var text10= document.getElementById(id10);

   text10.value=CIM[8];


   if (CIM[0] == "Bought Out" || CIM[0] == "Consummables") {
    document.getElementById('rmpoimg'+fieldname).style.display='block'; 
   }
   else{
    document.getElementById('rmpoimg'+fieldname).style.display='none'; 
   }
   

}

function addRowprodets(id,ind1){
//alert("HERE");
	// things to add
	ind1= parseInt(ind1);
	//alert(ind1);
	var y = ind1;
	seqnumber="seqnumber"+ind1;
	process="process"+ind1;
	st_date_time= "st_date_time" + ind1;
	end_date_time="end_date_time"+ind1;
	remarks_pdets="remarks_pdets"+ind1;

 	prevlinenum_prdet="prevlinenum_prdet"+ind1;
	linerecnum_prdet="linerecnum_prdet"+ind1;
	
	var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];

	var row = document.createElement("TR");
	row.style.backgroundColor = "#FFFFFF";

//intline_num
var cell0 = document.createElement("TD");

var inp0 = document.createElement("INPUT");
inp0.setAttribute("type","text");
inp0.setAttribute("size","4");
inp0.setAttribute("name",seqnumber);
inp0.setAttribute("id",seqnumber);
//inp1.setAttribute("value",irmline_num);
cell0.appendChild(inp0);

//stage
var cell8 = document.createElement("TD");

var inp8 = document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","15");
inp8.setAttribute("name",process);
inp8.setAttribute("id",process);
//inp1.setAttribute("value",irmline_num);
cell8.appendChild(inp8);

//mmlirecnum
var inp100 = document.createElement("INPUT");
inp100.setAttribute("type","hidden");
inp100.setAttribute("size","");
inp100.setAttribute("name",prevlinenum_prdet);
inp100.setAttribute("id",prevlinenum_prdet);
cell0.appendChild(inp100);
//recno
var inp101 = document.createElement("INPUT");
inp101.setAttribute("type","hidden");
inp101.setAttribute("size","");
inp101.setAttribute("name",linerecnum_prdet);
inp101.setAttribute("id",linerecnum_prdet);
cell0.appendChild(inp101);
//from
var cell1 = document.createElement("TD");

var inp1 = document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","30");
inp1.setAttribute("name",st_date_time);
inp1.setAttribute("id",st_date_time);
inp1.style.backgroundColor = "#DDDDDD";
inp1.readOnly = true;
//inp1.setAttribute("value",irmline_num);
var img1 = document.createElement("img");
img1.setAttribute("src","images/bu-getdateicon.gif");
img1.setAttribute("alt","GetDate");
img1.onclick = function(){ NewCssCal("st_date_time"+y,'yyyyMMdd','dropdown',true,'24',true); };
cell1.appendChild(inp1);
cell1.appendChild(img1);
//to
var cell2 = document.createElement("TD");

var inp2 = document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","30");
inp2.setAttribute("name",end_date_time);
inp2.setAttribute("id",end_date_time);
inp2.style.backgroundColor = "#DDDDDD";
inp2.readOnly = true;
//inp1.setAttribute("value",irmline_num);
cell2.appendChild(inp2);
var img2 = document.createElement("img");
img2.setAttribute("src","images/bu-getdateicon.gif");
img2.setAttribute("alt","GetDate");
img2.onclick = function(){ NewCssCal("end_date_time"+y,'yyyyMMdd','dropdown',true,'24',true); };
cell2.appendChild(inp2);
cell2.appendChild(img2);

//sampling
var cell3 = document.createElement("TD");

var inp3 = document.createElement("TEXTAREA");
//inp3.setAttribute("type","text");
inp3.setAttribute("rows","2");
inp3.setAttribute("cols","30");
inp3.setAttribute("name",remarks_pdets);
inp3.setAttribute("id",remarks_pdets);
//inp1.setAttribute("value",irmline_num);
cell3.appendChild(inp3);
//accept

row.appendChild(cell0);
row.appendChild(cell8);
row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);

tbody.appendChild(row);

ind1++;
document.forms[0].index_pdets.value=ind1;
document.forms[0].cur_index_pdets.value=ind1;

}


var winCal;
var dtToday;
var Cal;
var MonthName;
var WeekDayName1;
var WeekDayName2;
var exDateTime;//Existing Date and Time
var selDate;//selected date. version 1.7
var calSpanID = "calBorder"; // span ID
var domStyle = null; // span DOM object with style
var cnLeft = "0";//left coordinate of calendar span
var cnTop = "0";//top coordinate of calendar span
var xpos = 0; // mouse x position
var ypos = 0; // mouse y position
var calHeight = 0; // calendar height
var CalWidth = 208;// calendar width
var CellWidth = 30;// width of day cell.
var TimeMode = 24;// TimeMode value. 12 or 24
var StartYear = 2000; //First Year in drop down year selection
var EndYear = 5; // The last year of pickable date. if current year is 2011, the last year that still picker will be 2016 (2011+5)
var CalPosOffsetX = -1; //X position offset relative to calendar icon, can be negative value
var CalPosOffsetY = 0; //Y position offset relative to calendar icon, can be negative value

//Configurable parameters start
var SpanBorderColor = "#000000";//span border color
var SpanBgColor = "#FFFFFF"; //span background color
var MonthYearColor = "#cc0033"; //Font Color of Month and Year in Calendar header.
var WeekHeadColor = "#1E90FF"; //var WeekHeadColor="#18861B";//Background Color in Week header.
var SundayColor = "#FFEDA6"; //var SundayColor="#C0F64F";//Background color of Sunday.
var SaturdayColor = "#FFEDA6"; //Background color of Saturday.
var WeekDayColor = "#FFEDA6"; //Background color of weekdays.
var FontColor = "blue"; //color of font in Calendar day cell.
var TodayColor = "#ffbd35"; //var TodayColor="#FFFF33";//Background color of today.
var SelDateColor = "#8DD53C"; //var SelDateColor = "#8DD53C";//Backgrond color of selected date in textbox.
var YrSelColor = "#cc0033"; //color of font of Year selector.
var MthSelColor = "#cc0033"; //color of font of Month selector if "MonthSelector" is "arrow".
var HoverColor = "#E0FF38"; //color when mouse move over.
var DisableColor = "#999966"; //color of disabled cell.
var CalBgColor = "#ffffff"; //Background color of Calendar window.

var WeekChar = 2;//number of character for week day. if 2 then Mo,Tu,We. if 3 then Mon,Tue,Wed.
var DateSeparator = "-";//Date Separator, you can change it to "-" if you want.
var ShowLongMonth = true;//Show long month name in Calendar header. example: "January".
var ShowMonthYear = true;//Show Month and Year in Calendar header.
var ThemeBg = "";//Background image of Calendar window.
var PrecedeZero = true;//Preceding zero [true|false]
var MondayFirstDay = true;//true:Use Monday as first day; false:Sunday as first day. [true|false]  //added in version 1.7
var UseImageFiles = true;//Use image files with "arrows" and "close" button
var imageFilesPath = "images/";
//Configurable parameters end

//use the Month and Weekday in your preferred language.
var MonthName = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var WeekDayName1 = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
var WeekDayName2 = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];


//end Configurable parameters

//end Global variable


// Calendar prototype
function Calendar(pDate, pCtrl)
{
	//Properties
	this.Date = pDate.getDate();//selected date
	this.Month = pDate.getMonth();//selected month number
	this.Year = pDate.getFullYear();//selected year in 4 digits
	this.Hours = pDate.getHours();

	if (pDate.getMinutes() < 10)
	{
		this.Minutes = "0" + pDate.getMinutes();
	}
	else
	{
		this.Minutes = pDate.getMinutes();
	}

	if (pDate.getSeconds() < 10)
	{
		this.Seconds = "0" + pDate.getSeconds();
	}
	else
	{
		this.Seconds = pDate.getSeconds();
	}
	this.MyWindow = winCal;
	this.Ctrl = pCtrl;
	this.Format = "ddMMyyyy";
	this.Separator = DateSeparator;
	this.ShowTime = false;
	this.Scroller = "DROPDOWN";
	if (pDate.getHours() < 12)
	{
		this.AMorPM = "AM";
	}
	else
	{
		this.AMorPM = "PM";
	}
	this.ShowSeconds = false;
	this.EnableDateMode = ""
}

Calendar.prototype.GetMonthIndex = function (shortMonthName)
{
	for (var i = 0; i < 12; i += 1)
	{
		if (MonthName[i].substring(0, 3).toUpperCase() === shortMonthName.toUpperCase())
		{
			return i;
		}
	}
};

Calendar.prototype.IncYear = function () {
    if (Cal.Year <= dtToday.getFullYear()+EndYear)
	    Cal.Year += 1;
};

Calendar.prototype.DecYear = function () {
    if (Cal.Year > StartYear)
	    Cal.Year -= 1;
};

Calendar.prototype.IncMonth = function() {
    if (Cal.Year <= dtToday.getFullYear() + EndYear) {
        Cal.Month += 1;
        if (Cal.Month >= 12) {
            Cal.Month = 0;
            Cal.IncYear();
        }
    }
};

Calendar.prototype.DecMonth = function() {
    if (Cal.Year >= StartYear) {
        Cal.Month -= 1;
        if (Cal.Month < 0) {
            Cal.Month = 11;
            Cal.DecYear();
        }
    }
};

Calendar.prototype.SwitchMth = function (intMth)
{
	Cal.Month = parseInt(intMth, 10);
};

Calendar.prototype.SwitchYear = function (intYear)
{
	Cal.Year = parseInt(intYear, 10);
};

Calendar.prototype.SetHour = function(intHour) {
    var MaxHour,
	MinHour,
	HourExp = new RegExp("^\\d\\d"),
	SingleDigit = new RegExp("^\\d{1}$");

    if (TimeMode === 24) {
        MaxHour = 23;
        MinHour = 0;
    }
    else if (TimeMode === 12) {
        MaxHour = 12;
        MinHour = 1;
    }
    else {
        alert("TimeMode can only be 12 or 24");
    }

    if ((HourExp.test(intHour) || SingleDigit.test(intHour)) && (parseInt(intHour, 10) > MaxHour)) {
        intHour = MinHour;
    }

    else if ((HourExp.test(intHour) || SingleDigit.test(intHour)) && (parseInt(intHour, 10) < MinHour)) {
        intHour = MaxHour;
    }

    intHour = parseInt(intHour, 10);
    if (SingleDigit.test(intHour)) {
        intHour = "0" + intHour;
    }

    if (HourExp.test(intHour) && (parseInt(intHour, 10) <= MaxHour) && (parseInt(intHour, 10) >= MinHour)) {
        if ((TimeMode === 12) && (Cal.AMorPM === "PM")) {
            if (parseInt(intHour, 10) === 12) {
                Cal.Hours = 12;
            }
            else {
                Cal.Hours = parseInt(intHour, 10) + 12;
            }
        }

        else if ((TimeMode === 12) && (Cal.AMorPM === "AM")) {
            if (intHour === 12) {
                intHour -= 12;
            }

            Cal.Hours = parseInt(intHour, 10);
        }

        else if (TimeMode === 24) {
            Cal.Hours = parseInt(intHour, 10);
        }
    }

};

Calendar.prototype.SetMinute = function (intMin)
{
	var MaxMin = 59,
	MinMin = 0,

	SingleDigit = new RegExp("\\d"),
	SingleDigit2 = new RegExp("^\\d{1}$"),
	MinExp = new RegExp("^\\d{2}$"),

	strMin = 0;

	if ((MinExp.test(intMin) || SingleDigit.test(intMin)) && (parseInt(intMin, 10) > MaxMin))
	{
		intMin = MinMin;
	}

	else if ((MinExp.test(intMin) || SingleDigit.test(intMin)) && (parseInt(intMin, 10) < MinMin))
	{
		intMin = MaxMin;
	}

	strMin = intMin + "";
	if (SingleDigit2.test(intMin))
	{
		strMin = "0" + strMin;
	}

	if ((MinExp.test(intMin) || SingleDigit.test(intMin)) && (parseInt(intMin, 10) <= 59) && (parseInt(intMin, 10) >= 0))
	{
		Cal.Minutes = strMin;
	}
};

Calendar.prototype.SetSecond = function (intSec)
{
	var MaxSec = 59,
	MinSec = 0,

	SingleDigit = new RegExp("\\d"),
	SingleDigit2 = new RegExp("^\\d{1}$"),
	SecExp = new RegExp("^\\d{2}$"),

	strSec = 0;

	if ((SecExp.test(intSec) || SingleDigit.test(intSec)) && (parseInt(intSec, 10) > MaxSec))
	{
		intSec = MinSec;
	}

	else if ((SecExp.test(intSec) || SingleDigit.test(intSec)) && (parseInt(intSec, 10) < MinSec))
	{
		intSec = MaxSec;
	}

	strSec = intSec + "";
	if (SingleDigit2.test(intSec))
	{
		strSec = "0" + strSec;
	}

	if ((SecExp.test(intSec) || SingleDigit.test(intSec)) && (parseInt(intSec, 10) <= 59) && (parseInt(intSec, 10) >= 0))
	{
		Cal.Seconds = strSec;
	}

};

Calendar.prototype.SetAmPm = function (pvalue)
{
	this.AMorPM = pvalue;
	if (pvalue === "PM")
	{
		this.Hours = parseInt(this.Hours, 10) + 12;
		if (this.Hours === 24)
		{
			this.Hours = 12;
		}
	}

	else if (pvalue === "AM")
	{
		this.Hours -= 12;
	}
};

Calendar.prototype.getShowHour = function() {
    var finalHour;

    if (TimeMode === 12) {
        if (parseInt(this.Hours, 10) === 0) {
            this.AMorPM = "AM";
            finalHour = parseInt(this.Hours, 10) + 12;
        }

        else if (parseInt(this.Hours, 10) === 12) {
            this.AMorPM = "PM";
            finalHour = 12;
        }

        else if (this.Hours > 12) {
            this.AMorPM = "PM";
            if ((this.Hours - 12) < 10) {
                finalHour = "0" + ((parseInt(this.Hours, 10)) - 12);
            }
            else {
                finalHour = parseInt(this.Hours, 10) - 12;
            }
        }
        else {
            this.AMorPM = "AM";
            if (this.Hours < 10) {
                finalHour = "0" + parseInt(this.Hours, 10);
            }
            else {
                finalHour = this.Hours;
            }
        }
    }

    else if (TimeMode === 24) {
        if (this.Hours < 10) {
            finalHour = "0" + parseInt(this.Hours, 10);
        }
        else {
            finalHour = this.Hours;
        }
    }

    return finalHour;
};

Calendar.prototype.getShowAMorPM = function ()
{
	return this.AMorPM;
};

Calendar.prototype.GetMonthName = function (IsLong)
{
	var Month = MonthName[this.Month];
	if (IsLong)
	{
		return Month;
	}
	else
	{
		return Month.substr(0, 3);
	}
};

Calendar.prototype.GetMonDays = function() { //Get number of days in a month

    var DaysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    if (Cal.IsLeapYear()) {
        DaysInMonth[1] = 29;
    }

    return DaysInMonth[this.Month];
};

Calendar.prototype.IsLeapYear = function ()
{
	if ((this.Year % 4) === 0)
	{
		if ((this.Year % 100 === 0) && (this.Year % 400) !== 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	else
	{
		return false;
	}
};

Calendar.prototype.FormatDate = function (pDate)
{
	var MonthDigit = this.Month + 1;
	if (PrecedeZero === true)
	{
		if ((pDate < 10) && String(pDate).length===1) //length checking added in version 2.2
		{
			pDate = "0" + pDate;
		}
		if (MonthDigit < 10)
		{
			MonthDigit = "0" + MonthDigit;
		}
	}

	switch (this.Format.toUpperCase())
	{
		case "DDMMYYYY":
		return (pDate + DateSeparator + MonthDigit + DateSeparator + this.Year);
		case "DDMMMYYYY":
		return (pDate + DateSeparator + this.GetMonthName(false) + DateSeparator + this.Year);
		case "MMDDYYYY":
		return (MonthDigit + DateSeparator + pDate + DateSeparator + this.Year);
		case "MMMDDYYYY":
		return (this.GetMonthName(false) + DateSeparator + pDate + DateSeparator + this.Year);
		case "YYYYMMDD":
		return (this.Year + DateSeparator + MonthDigit + DateSeparator + pDate);
		case "YYMMDD":
		return (String(this.Year).substring(2, 4) + DateSeparator + MonthDigit + DateSeparator + pDate);
		case "YYMMMDD":
		return (String(this.Year).substring(2, 4) + DateSeparator + this.GetMonthName(false) + DateSeparator + pDate);
		case "YYYYMMMDD":
		return (this.Year + DateSeparator + this.GetMonthName(false) + DateSeparator + pDate);
		default:
		return (pDate + DateSeparator + (this.Month + 1) + DateSeparator + this.Year);
	}
};

// end Calendar prototype

function GenCell(pValue, pHighLight, pColor, pClickable)
{ //Generate table cell with value
	var PValue,
	PCellStr,
	PClickable,
	vTimeStr;

	if (!pValue)
	{
		PValue = "";
	}
	else
	{
		PValue = pValue;
	}

	if (pColor === undefined)
	    pColor = CalBgColor;

	if (pClickable !== undefined){
		PClickable = pClickable;
	}
	else{
		PClickable = true;
	}

	if (Cal.ShowTime)
	{
		vTimeStr = ' ' + Cal.Hours + ':' + Cal.Minutes;
		if (Cal.ShowSeconds)
		{
			vTimeStr += ':' + Cal.Seconds;
		}
		if (TimeMode === 12)
		{
			vTimeStr += ' ' + Cal.AMorPM;
		}
	}

	else
	{
		vTimeStr = "";
	}

	if (PValue !== "")
	{
		if (PClickable === true) {
		    if (Cal.ShowTime === true)
		    { PCellStr = "<td id='c" + PValue + "' class='calTD' style='text-align:center;cursor:pointer;background-color:"+pColor+"' onmousedown='selectDate(this," + PValue + ");'>" + PValue + "</td>"; }
		    else { PCellStr = "<td class='calTD' style='text-align:center;cursor:pointer;background-color:" + pColor + "' onmouseover='changeBorder(this, 0);' onmouseout=\"changeBorder(this, 1, '" + pColor + "');\" onClick=\"javascript:callback('" + Cal.Ctrl + "','" + Cal.FormatDate(PValue) + "');\">" + PValue + "</td>"; }
		}
		else
		{ PCellStr = "<td style='text-align:center;background-color:"+pColor+"' class='calTD'>"+PValue+"</td>"; }
	}
	else
	{ PCellStr = "<td style='text-align:center;background-color:"+pColor+"' class='calTD'>&nbsp;</td>"; }

	return PCellStr;
}

function RenderCssCal(bNewCal)
{
	if (typeof bNewCal === "undefined" || bNewCal !== true)
	{
		bNewCal = false;
	}
	var vCalHeader,
	vCalData,
	vCalTime = "",
	vCalClosing = "",
	winCalData = "",
	CalDate,

	i,
	j,

	SelectStr,
	vDayCount = 0,
	vFirstDay,

	WeekDayName = [],//Added version 1.7
	strCell,

	showHour,
	ShowArrows = false,
	HourCellWidth = "35px", //cell width with seconds.

	SelectAm,
	SelectPm,

	funcCalback,

	headID,
	e,
	cssStr,
	style,
	cssText,
	span;

	calHeight = 0; // reset the window height on refresh

	// Set the default cursor for the calendar

	winCalData = "<span style='cursor:auto;'>";
	vCalHeader = "<table style='background-color:"+CalBgColor+";width:200px;padding:0;margin:5px auto 5px auto'><tbody>";

	//Table for Month & Year Selector

	vCalHeader += "<tr><td colspan='7'><table border='0' width='200px' cellpadding='0' cellspacing='0'><tr>";
	//******************Month and Year selector in dropdown list************************

	if (Cal.Scroller === "DROPDOWN")
	{
	    vCalHeader += "<td align='center'><select name='MonthSelector' onChange='javascript:Cal.SwitchMth(this.selectedIndex);RenderCssCal();'>";
		for (i = 0; i < 12; i += 1)
		{
			if (i === Cal.Month)
			{
				SelectStr = "Selected";
			}
			else
			{
				SelectStr = "";
			}
			vCalHeader += "<option " + SelectStr + " value=" + i + ">" + MonthName[i] + "</option>";
		}

		vCalHeader += "</select></td>";
		//Year selector

		vCalHeader += "<td align='center'><select name='YearSelector' size='1' onChange='javascript:Cal.SwitchYear(this.value);RenderCssCal();'>";
		for (i = StartYear; i <= (dtToday.getFullYear() + EndYear); i += 1)
		{
			if (i === Cal.Year)
			{
				SelectStr = 'selected="selected"';
			}
			else
			{
				SelectStr = '';
			}
			vCalHeader += "<option " + SelectStr + " value=" + i + ">" + i + "</option>\n";
		}
		vCalHeader += "</select></td>\n";
		calHeight += 30;
	}

	//******************End Month and Year selector in dropdown list*********************

	//******************Month and Year selector in arrow*********************************

	else if (Cal.Scroller === "ARROW")
	{
		if (UseImageFiles)
		{
			vCalHeader += "<td><img onmousedown='javascript:Cal.DecYear();RenderCssCal();' src='"+imageFilesPath+"cal_fastreverse.gif' width='13px' height='9' onmouseover='changeBorder(this, 0)' onmouseout='changeBorder(this, 1)' style='border:1px solid white'></td>\n";//Year scroller (decrease 1 year)
			vCalHeader += "<td><img onmousedown='javascript:Cal.DecMonth();RenderCssCal();' src='" + imageFilesPath + "cal_reverse.gif' width='13px' height='9' onmouseover='changeBorder(this, 0)' onmouseout='changeBorder(this, 1)' style='border:1px solid white'></td>\n"; //Month scroller (decrease 1 month)
			vCalHeader += "<td width='70%' class='calR' style='color:"+YrSelColor+"'>"+ Cal.GetMonthName(ShowLongMonth) + " " + Cal.Year + "</td>"; //Month and Year
			vCalHeader += "<td><img onmousedown='javascript:Cal.IncMonth();RenderCssCal();' src='" + imageFilesPath + "cal_forward.gif' width='13px' height='9' onmouseover='changeBorder(this, 0)' onmouseout='changeBorder(this, 1)' style='border:1px solid white'></td>\n"; //Month scroller (increase 1 month)
			vCalHeader += "<td><img onmousedown='javascript:Cal.IncYear();RenderCssCal();' src='" + imageFilesPath + "cal_fastforward.gif' width='13px' height='9' onmouseover='changeBorder(this, 0)' onmouseout='changeBorder(this, 1)' style='border:1px solid white'></td>\n"; //Year scroller (increase 1 year)
			calHeight += 22;
		}
		else
		{
			vCalHeader += "<td><span id='dec_year' title='reverse year' onmousedown='javascript:Cal.DecYear();RenderCssCal();' onmouseover='changeBorder(this, 0)' onmouseout='changeBorder(this, 1)' style='border:1px solid white; color:" + YrSelColor + "'>-</span></td>";//Year scroller (decrease 1 year)
			vCalHeader += "<td><span id='dec_month' title='reverse month' onmousedown='javascript:Cal.DecMonth();RenderCssCal();' onmouseover='changeBorder(this, 0)' onmouseout='changeBorder(this, 1)' style='border:1px solid white'>&lt;</span></td>\n";//Month scroller (decrease 1 month)
			vCalHeader += "<td width='70%' class='calR' style='color:" + YrSelColor + "'>" + Cal.GetMonthName(ShowLongMonth) + " " + Cal.Year + "</td>\n"; //Month and Year
			vCalHeader += "<td><span id='inc_month' title='forward month' onmousedown='javascript:Cal.IncMonth();RenderCssCal();' onmouseover='changeBorder(this, 0)' onmouseout='changeBorder(this, 1)' style='border:1px solid white'>&gt;</span></td>\n";//Month scroller (increase 1 month)
			vCalHeader += "<td><span id='inc_year' title='forward year' onmousedown='javascript:Cal.IncYear();RenderCssCal();'  onmouseover='changeBorder(this, 0)' onmouseout='changeBorder(this, 1)' style='border:1px solid white; color:" + YrSelColor + "'>+</span></td>\n";//Year scroller (increase 1 year)
			calHeight += 22;
		}
	}

	vCalHeader += "</tr></table></td></tr>";

	//******************End Month and Year selector in arrow******************************

	//Calendar header shows Month and Year
	if (ShowMonthYear && Cal.Scroller === "DROPDOWN")
	{
	    vCalHeader += "<tr><td colspan='7' class='calR' style='color:" + MonthYearColor + "'>" + Cal.GetMonthName(ShowLongMonth) + " " + Cal.Year + "</td></tr>";
		calHeight += 19;
	}

	//Week day header

	vCalHeader += "<tr><td colspan=\"7\"><table style='border-spacing:1px;border-collapse:separate;'><tr>";
	if (MondayFirstDay === true)
	{
		WeekDayName = WeekDayName2;
	}
	else
	{
		WeekDayName = WeekDayName1;
	}
	for (i = 0; i < 7; i += 1)
	{
	    vCalHeader += "<td style='background-color:"+WeekHeadColor+";width:"+CellWidth+"px;color:#FFFFFF' class='calTD'>" + WeekDayName[i].substr(0, WeekChar) + "</td>";
	}

	calHeight += 19;
	vCalHeader += "</tr>";
	//Calendar detail
	CalDate = new Date(Cal.Year, Cal.Month);
	CalDate.setDate(1);

	vFirstDay = CalDate.getDay();

	//Added version 1.7
	if (MondayFirstDay === true)
	{
		vFirstDay -= 1;
		if (vFirstDay === -1)
		{
			vFirstDay = 6;
		}
	}

	//Added version 1.7
	vCalData = "<tr>";
	calHeight += 19;
	for (i = 0; i < vFirstDay; i += 1)
	{
		vCalData = vCalData + GenCell();
		vDayCount = vDayCount + 1;
	}

	//Added version 1.7
	for (j = 1; j <= Cal.GetMonDays(); j += 1)
	{
		if ((vDayCount % 7 === 0) && (j > 1))
		{
			vCalData = vCalData + "<tr>";
		}

		vDayCount = vDayCount + 1;
		//added version 2.1.2
		if (Cal.EnableDateMode === "future" && ((j < dtToday.getDate()) && (Cal.Month === dtToday.getMonth()) && (Cal.Year === dtToday.getFullYear()) || (Cal.Month < dtToday.getMonth()) && (Cal.Year === dtToday.getFullYear()) || (Cal.Year < dtToday.getFullYear())))
		{
			strCell = GenCell(j, false, DisableColor, false); //Before today's date is not clickable
        }
        else if (Cal.EnableDateMode === "past" && ((j >= dtToday.getDate()) && (Cal.Month === dtToday.getMonth()) && (Cal.Year === dtToday.getFullYear()) || (Cal.Month > dtToday.getMonth()) && (Cal.Year === dtToday.getFullYear()) || (Cal.Year > dtToday.getFullYear()))) {
            strCell = GenCell(j, false, DisableColor, false); //After today's date is not clickable
        }
		//if End Year + Current Year = Cal.Year. Disable.
		else if (Cal.Year > (dtToday.getFullYear()+EndYear))
		{
		    strCell = GenCell(j, false, DisableColor, false);
		}
		else if ((j === dtToday.getDate()) && (Cal.Month === dtToday.getMonth()) && (Cal.Year === dtToday.getFullYear()))
		{
			strCell = GenCell(j, true, TodayColor);//Highlight today's date
		}
		else
		{
			if ((j === selDate.getDate()) && (Cal.Month === selDate.getMonth()) && (Cal.Year === selDate.getFullYear())){
			     //modified version 1.7
				strCell = GenCell(j, true, SelDateColor);
            }
			else
			{
				if (MondayFirstDay === true)
				{
					if (vDayCount % 7 === 0)
					{
						strCell = GenCell(j, false, SundayColor);
					}
					else if ((vDayCount + 1) % 7 === 0)
					{
						strCell = GenCell(j, false, SaturdayColor);
					}
					else
					{
						strCell = GenCell(j, null, WeekDayColor);
					}
				}
				else
				{
					if (vDayCount % 7 === 0)
					{
						strCell = GenCell(j, false, SaturdayColor);
					}
					else if ((vDayCount + 6) % 7 === 0)
					{
						strCell = GenCell(j, false, SundayColor);
					}
					else
					{
						strCell = GenCell(j, null, WeekDayColor);
					}
				}
			}
		}

		vCalData = vCalData + strCell;

		if ((vDayCount % 7 === 0) && (j < Cal.GetMonDays()))
		{
			vCalData = vCalData + "</tr>";
			calHeight += 19;
		}
	}

	// finish the table proper

	if (vDayCount % 7 !== 0)
	{
		while (vDayCount % 7 !== 0)
		{
			vCalData = vCalData + GenCell();
			vDayCount = vDayCount + 1;
		}
	}

	vCalData = vCalData + "</table></td></tr>";


	//Time picker
	if (Cal.ShowTime === true)
	{
		showHour = Cal.getShowHour();

		if (Cal.ShowSeconds === false && TimeMode === 24)
		{
			ShowArrows = true;
			HourCellWidth = "10px";
		}

		vCalTime = "<tr><td colspan='7' style=\"text-align:center;\"><table border='0' width='199px' cellpadding='0' cellspacing='0'><tbody><tr><td height='5px' width='" + HourCellWidth + "'>&nbsp;</td>";

		if (ShowArrows && UseImageFiles) //this is where the up and down arrow control the hour.
		{
		    vCalTime += "<td style='vertical-align:middle;'><table cellspacing='0' cellpadding='0' style='line-height:0pt;width:100%;'><tr><td style='text-align:center;'><img onclick='nextStep(\"Hour\", \"plus\");' onmousedown='startSpin(\"Hour\", \"plus\");' onmouseup='stopSpin();' src='" + imageFilesPath + "cal_plus.gif' width='13px' height='9px' onmouseover='changeBorder(this, 0)' onmouseout='changeBorder(this, 1)' style='border:1px solid white'></td></tr><tr><td style='text-align:center;'><img onclick='nextStep(\"Hour\", \"minus\");' onmousedown='startSpin(\"Hour\", \"minus\");' onmouseup='stopSpin();' src='" + imageFilesPath + "cal_minus.gif' width='13px' height='9px' onmouseover='changeBorder(this, 0)' onmouseout='changeBorder(this, 1)' style='border:1px solid white'></td></tr></table></td>\n";
		}

		vCalTime += "<td width='22px'><input type='text' name='hour' maxlength=2 size=1 style=\"WIDTH:22px\" value=" + showHour + " onkeyup=\"javascript:Cal.SetHour(this.value)\">";
		vCalTime += "</td><td style='font-weight:bold;text-align:center;'>:</td><td width='22px'>";
		vCalTime += "<input type='text' name='minute' maxlength=2 size=1 style=\"WIDTH: 22px\" value=" + Cal.Minutes + " onkeyup=\"javascript:Cal.SetMinute(this.value)\">";

		if (Cal.ShowSeconds)
		{
		    vCalTime += "</td><td style='font-weight:bold;'>:</td><td width='22px'>";
			vCalTime += "<input type='text' name='second' maxlength=2 size=1 style=\"WIDTH: 22px\" value=" + Cal.Seconds + " onkeyup=\"javascript:Cal.SetSecond(parseInt(this.value,10))\">";
		}

		if (TimeMode === 12)
		{
			SelectAm = (Cal.AMorPM === "AM") ? "Selected" : "";
			SelectPm = (Cal.AMorPM === "PM") ? "Selected" : "";

			vCalTime += "</td><td>";
			vCalTime += "<select name=\"ampm\" onChange=\"javascript:Cal.SetAmPm(this.options[this.selectedIndex].value);\">\n";
			vCalTime += "<option " + SelectAm + " value=\"AM\">AM</option>";
			vCalTime += "<option " + SelectPm + " value=\"PM\">PM<option>";
			vCalTime += "</select>";
		}

		if (ShowArrows && UseImageFiles) //this is where the up and down arrow to change the "Minute".
		{
		    vCalTime += "</td>\n<td style='vertical-align:middle;'><table cellspacing='0' cellpadding='0' style='line-height:0pt;width:100%'><tr><td style='text-align:center;'><img onclick='nextStep(\"Minute\", \"plus\");' onmousedown='startSpin(\"Minute\", \"plus\");' onmouseup='stopSpin();' src='" + imageFilesPath + "cal_plus.gif' width='13px' height='9px' onmouseover='changeBorder(this, 0)' onmouseout='changeBorder(this, 1)' style='border:1px solid white'></td></tr><tr><td style='text-align:center;'><img onmousedown='startSpin(\"Minute\", \"minus\");' onmouseup='stopSpin();' onclick='nextStep(\"Minute\",\"minus\");' src='" + imageFilesPath + "cal_minus.gif' width='13px' height='9px' onmouseover='changeBorder(this, 0)' onmouseout='changeBorder(this, 1)' style='border:1px solid white'></td></tr></table>";
		}

		vCalTime += "</td>\n<td align='right' valign='bottom' width='" + HourCellWidth + "px'></td></tr>";
		vCalTime += "<tr><td colspan='8' style=\"text-align:center;\"><input style='width:60px;font-size:12px;' onClick='javascript:closewin(\"" + Cal.Ctrl + "\");'  type=\"button\" value=\"OK\">&nbsp;<input style='width:60px;font-size:12px;' onClick='javascript: winCal.style.visibility = \"hidden\"' type=\"button\" value=\"Cancel\"></td></tr>";
	}
	else //if not to show time.
	{
	    vCalTime += "\n<tr>\n<td colspan='7' style=\"text-align:right;\">";
	    //close button
	    if (UseImageFiles) {
	        vCalClosing += "<img onmousedown='javascript:closewin(\"" + Cal.Ctrl + "\"); stopSpin();' src='"+imageFilesPath+"cal_close.gif' width='16px' height='14px' onmouseover='changeBorder(this,0)' onmouseout='changeBorder(this, 1)' style='border:1px solid white'></td>";
	    }
	    else {
	        vCalClosing += "<span id='close_cal' title='close'onmousedown='javascript:closewin(\"" + Cal.Ctrl + "\");stopSpin();' onmouseover='changeBorder(this, 0)'onmouseout='changeBorder(this, 1)' style='border:1px solid white; font-family: Arial;font-size: 10pt;'>x</span></td>";
	    }
	    vCalClosing += "</tr>";
	}
	vCalClosing += "</tbody></table></td></tr>";
	calHeight += 31;
	vCalClosing += "</tbody></table>\n</span>";

	//end time picker
	funcCalback = "function callback(id, datum) {";
	funcCalback += " var CalId = document.getElementById(id);if (datum=== 'undefined') { var d = new Date(); datum = d.getDate() + '/' +(d.getMonth()+1) + '/' + d.getFullYear(); } window.calDatum=datum;CalId.value=datum;";
	funcCalback += " if(Cal.ShowTime){";
	funcCalback += " CalId.value+=' '+Cal.getShowHour()+':'+Cal.Minutes;";
	funcCalback += " if (Cal.ShowSeconds)  CalId.value+=':'+Cal.Seconds;";
	funcCalback += " if (TimeMode === 12)  CalId.value+=''+Cal.getShowAMorPM();";
	funcCalback += "}if(CalId.onchange!=undefined) CalId.onchange();CalId.focus();winCal.style.visibility='hidden';}";


	// determines if there is enough space to open the cal above the position where it is called
	if (ypos > calHeight)
	{
		ypos = ypos - calHeight;
	}

	if (!winCal)
	{
		headID = document.getElementsByTagName("head")[0];

		// add javascript function to the span cal
		e = document.createElement("script");
		e.type = "text/javascript";
		e.language = "javascript";
		e.text = funcCalback;
		headID.appendChild(e);
		// add stylesheet to the span cal

		cssStr = ".calTD {font-family: verdana; font-size: 12px; text-align: center; border:0; }\n";
		cssStr += ".calR {font-family: verdana; font-size: 12px; text-align: center; font-weight: bold;}";

		style = document.createElement("style");
		style.type = "text/css";
		style.rel = "stylesheet";
		if (style.styleSheet)
		{ // IE
			style.styleSheet.cssText = cssStr;
		}

		else
		{ // w3c
			cssText = document.createTextNode(cssStr);
			style.appendChild(cssText);
		}

		headID.appendChild(style);
		// create the outer frame that allows the cal. to be moved
		span = document.createElement("span");
		span.id = calSpanID;
		span.style.position = "absolute";
		span.style.left = (xpos + CalPosOffsetX) + 'px';
		span.style.top = (ypos - CalPosOffsetY) + 'px';
		span.style.width = CalWidth + 'px';
		span.style.border = "solid 1pt " + SpanBorderColor;
		span.style.padding = "0";
		span.style.cursor = "move";
		span.style.backgroundColor = SpanBgColor;
		span.style.zIndex = 100;
		document.body.appendChild(span);
		winCal = document.getElementById(calSpanID);
	}

	else
	{
		winCal.style.visibility = "visible";
		winCal.style.Height = calHeight;

		// set the position for a new calendar only
		if (bNewCal === true)
		{
			winCal.style.left = (xpos + CalPosOffsetX) + 'px';
			winCal.style.top = (ypos - CalPosOffsetY) + 'px';
		}
	}

	winCal.innerHTML = winCalData + vCalHeader + vCalData + vCalTime + vCalClosing;
	return true;
}


function NewCssCal(pCtrl, pFormat, pScroller, pShowTime, pTimeMode, pShowSeconds, pEnableDateMode)
{
  
	// get current date and time
  if(pCtrl == 'act_ship_date')
  {
    var j=1;
    var closing_flag = 0; var close_final=0;
    var index_close = document.forms[0].index.value;

    while(j<index_close)
    {
      grn = "grn"+j;
      if(document.getElementById(grn).value.length == 0)
      {
        closing_flag = 1;
      }
      j++;
    }

    var x=1;
    var max=document.forms[0].indexmm.value;
  
    while (x < max)
    {
      stagenum = "stage" + x;
      if((document.getElementById(stagenum).value == "fi"||document.getElementById(stagenum).value ==  "final"||document.getElementById(stagenum).value == "FINAL"||document.getElementById(stagenum).value == "FI"||document.getElementById(stagenum).value == "Final"||document.getElementById(stagenum).value == "Fi"))
      {
        close_final=1;  
      }
      x++;
    }

  if(closing_flag == 1 )
  {
    alert('To close this WO'+'\n'+'All the GRN/WO must be entered');
    return false;
  }
  if(close_final ==0)
  {
    alert('To close this WO'+'\n'+'Final stage has to be entered');
    return false;
  }

  var k = 1;
  var assywo_cnt = document.getElementById('assywo_flow_cnt').value;
  var approve_flag = 0;
  errmsg = "";
  while(k < assywo_cnt)
  {

    assywo_flow_approve = document.getElementById('assywo_flow_approve'+ k).value;
    if (assywo_flow_approve.trim() == "" ) 
    {
      approve_flag = 1;
    }
    k++;
  }

  if (approve_flag == 1) 
  {
    errmsg += "To Close the Assy Wo, All the Work flow process should get Complete \n";
  }

  if (errmsg != "") 
  {
    alert(errmsg);
    return false;
  }


 sum=0;
var str_woqty = document.getElementById('assy_woqty').value;
var woqty = parseInt(str_woqty);
        var y=1;
  var maxv=document.forms[0].indexmm.value;
  //alert(x+"****"+max);
  while (y < maxv)
    {       stagenum = "stage" + y;
           accpt= "accept"+ y;
            date="date"+y;
            rework="rework"+y;
            reject="reject"+y;
            returns="returns"+y;

//          if(document.getElementById('act_ship_date').value.length !=0 && document.getElementById('act_ship_date').value != '0000-00-00')
//          {
           if((document.getElementById(stagenum).value == "fi"||document.getElementById(stagenum).value ==  "final"||document.getElementById(stagenum).value == "FINAL"||document.getElementById(stagenum).value == "FI"||document.getElementById(stagenum).value == "Final"||document.getElementById(stagenum).value == "Fi"))
           {

            final_flag = 1;
            if(document.getElementById(accpt).value.length !=0)
            {
              acc= document.getElementById(accpt).value;
            }
            else
            {
              acc=0;
            }
            if(document.getElementById(reject).value.length !=0)
           {
            rej=document.getElementById(reject).value;
           }
           else
           {
            rej=0;
           }
            if(document.getElementById(rework).value.length !=0)
           {
            rew=document.getElementById(rework).value;
           }
           else
           {
            rew=0;
           }
            if(document.getElementById(returns).value.length !=0)
           {
            ret=document.getElementById(returns).value;
           }
           else
           {
            ret=0;
           }

            sum += parseInt(acc)+ parseInt(rej)+ parseInt(rew)+ parseInt(ret);
            //alert(sum);

          }
          y++;
          }
  if(woqty != sum)
 {
   alert( 'Total of Accept,Rework,Reject,Ret'+'\n'+'should be equal to Qty');
   return false;
 }

}
	dtToday = new Date();
	Cal = new Calendar(dtToday);

	if (pShowTime !== undefined)
	{
	    if (pShowTime) {
	        Cal.ShowTime = true;
	    }
	    else {
	        Cal.ShowTime = false;
	    }

		if (pTimeMode)
		{
			pTimeMode = parseInt(pTimeMode, 10);
		}
		if (pTimeMode === 12 || pTimeMode === 24)
		{
			TimeMode = pTimeMode;
		}
		else
		{
			TimeMode = 24;
		}

		if (pShowSeconds !== undefined)
		{
			if (pShowSeconds)
			{
				Cal.ShowSeconds = true;
			}
			else
			{
				Cal.ShowSeconds = false;
			}
		}
		else
		{
			Cal.ShowSeconds = false;
		}

	}

	if (pCtrl !== undefined)
	{
		Cal.Ctrl = pCtrl;
	}

	if (pFormat!== undefined && pFormat !=="")
	{
		Cal.Format = pFormat.toUpperCase();
	}
	else
	{
		Cal.Format = "MMDDYYYY";
	}

	if (pScroller!== undefined && pScroller!=="")
	{
		if (pScroller.toUpperCase() === "ARROW")
		{
			Cal.Scroller = "ARROW";
		}
		else
		{
			Cal.Scroller = "DROPDOWN";
		}
    }

    if (pEnableDateMode !== undefined && (pEnableDateMode === "future" || pEnableDateMode === "past")) {
        Cal.EnableDateMode= pEnableDateMode;
    }

	exDateTime = document.getElementById(pCtrl).value; //Existing Date Time value in textbox.

	if (exDateTime)
	{ //Parse existing Date String
		var Sp1 = exDateTime.indexOf(DateSeparator, 0),//Index of Date Separator 1
		Sp2 = exDateTime.indexOf(DateSeparator, parseInt(Sp1, 10) + 1),//Index of Date Separator 2
		tSp1,//Index of Time Separator 1
		tSp2,//Index of Time Separator 2
		strMonth,
		strDate,
		strYear,
		intMonth,
		YearPattern,
		strHour,
		strMinute,
		strSecond,
		winHeight,
		offset = parseInt(Cal.Format.toUpperCase().lastIndexOf("M"), 10) - parseInt(Cal.Format.toUpperCase().indexOf("M"), 10) - 1,
		strAMPM = "";
		//parse month

		if (Cal.Format.toUpperCase() === "DDMMYYYY" || Cal.Format.toUpperCase() === "DDMMMYYYY")
		{
			if (DateSeparator === "")
			{
				strMonth = exDateTime.substring(2, 4 + offset);
				strDate = exDateTime.substring(0, 2);
				strYear = exDateTime.substring(4 + offset, 8 + offset);
			}
			else
			{
				if (exDateTime.indexOf("D*") !== -1)
				{   //DTG
					strMonth = exDateTime.substring(8, 11);
					strDate  = exDateTime.substring(0, 2);
					strYear  = "20" + exDateTime.substring(11, 13);  //Hack, nur für Jahreszahlen ab 2000
				}
				else
				{
					strMonth = exDateTime.substring(Sp1 + 1, Sp2);
					strDate = exDateTime.substring(0, Sp1);
					strYear = exDateTime.substring(Sp2 + 1, Sp2 + 5);
				}
			}
		}

		else if (Cal.Format.toUpperCase() === "MMDDYYYY" || Cal.Format.toUpperCase() === "MMMDDYYYY"){
			if (DateSeparator === ""){
				strMonth = exDateTime.substring(0, 2 + offset);
				strDate = exDateTime.substring(2 + offset, 4 + offset);
				strYear = exDateTime.substring(4 + offset, 8 + offset);
			}
			else{
				strMonth = exDateTime.substring(0, Sp1);
				strDate = exDateTime.substring(Sp1 + 1, Sp2);
				strYear = exDateTime.substring(Sp2 + 1, Sp2 + 5);
			}
		}

		else if (Cal.Format.toUpperCase() === "YYYYMMDD" || Cal.Format.toUpperCase() === "YYYYMMMDD")
		{
			if (DateSeparator === ""){
				strMonth = exDateTime.substring(4, 6 + offset);
				strDate = exDateTime.substring(6 + offset, 8 + offset);
				strYear = exDateTime.substring(0, 4);
			}
			else{
				strMonth = exDateTime.substring(Sp1 + 1, Sp2);
				strDate = exDateTime.substring(Sp2 + 1, Sp2 + 3);
				strYear = exDateTime.substring(0, Sp1);
			}
		}

		else if (Cal.Format.toUpperCase() === "YYMMDD" || Cal.Format.toUpperCase() === "YYMMMDD")
		{
			if (DateSeparator === "")
			{
				strMonth = exDateTime.substring(2, 4 + offset);
				strDate = exDateTime.substring(4 + offset, 6 + offset);
				strYear = exDateTime.substring(0, 2);
			}
			else
			{
				strMonth = exDateTime.substring(Sp1 + 1, Sp2);
				strDate = exDateTime.substring(Sp2 + 1, Sp2 + 3);
				strYear = exDateTime.substring(0, Sp1);
			}
		}

		if (isNaN(strMonth)){
			intMonth = Cal.GetMonthIndex(strMonth);
		}
		else{
			intMonth = parseInt(strMonth, 10) - 1;
		}
		if ((parseInt(intMonth, 10) >= 0) && (parseInt(intMonth, 10) < 12))	{
			Cal.Month = intMonth;
		}
		//end parse month

		//parse year
		YearPattern = /^\d{4}$/;
		if (YearPattern.test(strYear)) {
		    if ((parseInt(strYear, 10)>=StartYear) && (parseInt(strYear, 10)<= (dtToday.getFullYear()+EndYear)))
		        Cal.Year = parseInt(strYear, 10);
		}
		//end parse year

		//parse Date
		if ((parseInt(strDate, 10) <= Cal.GetMonDays()) && (parseInt(strDate, 10) >= 1)) {
			Cal.Date = strDate;
		}
		//end parse Date

		//parse time

		if (Cal.ShowTime === true)
		{
			//parse AM or PM
			if (TimeMode === 12)
			{
				strAMPM = exDateTime.substring(exDateTime.length - 2, exDateTime.length);
				Cal.AMorPM = strAMPM;
			}

			tSp1 = exDateTime.indexOf(":", 0);
			tSp2 = exDateTime.indexOf(":", (parseInt(tSp1, 10) + 1));
			if (tSp1 > 0)
			{
				strHour = exDateTime.substring(tSp1, tSp1 - 2);
				Cal.SetHour(strHour);

				strMinute = exDateTime.substring(tSp1 + 1, tSp1 + 3);
				Cal.SetMinute(strMinute);

				strSecond = exDateTime.substring(tSp2 + 1, tSp2 + 3);
				Cal.SetSecond(strSecond);

			}
			else if (exDateTime.indexOf("D*") !== -1)
			{   //DTG
				strHour = exDateTime.substring(2, 4);
				Cal.SetHour(strHour);
				strMinute = exDateTime.substring(4, 6);
				Cal.SetMinute(strMinute);

			}
		}

	}
	selDate = new Date(Cal.Year, Cal.Month, Cal.Date);//version 1.7
	RenderCssCal(true);
}

function closewin(id) {
    if (Cal.ShowTime === true) {
        var MaxYear = dtToday.getFullYear() + EndYear;
        var beforeToday =
                    (Cal.Date < dtToday.getDate()) &&
                    (Cal.Month === dtToday.getMonth()) &&
                    (Cal.Year === dtToday.getFullYear())
                    ||
                    (Cal.Month < dtToday.getMonth()) &&
                    (Cal.Year === dtToday.getFullYear())
                    ||
                    (Cal.Year < dtToday.getFullYear());

        if ((Cal.Year <= MaxYear) && (Cal.Year >= StartYear) && (Cal.Month === selDate.getMonth()) && (Cal.Year === selDate.getFullYear())) {
            if (Cal.EnableDateMode === "future") {
                if (beforeToday === false) {
                    callback(id, Cal.FormatDate(Cal.Date));
                }
            }
            else
                callback(id, Cal.FormatDate(Cal.Date));
        }
    }

	var CalId = document.getElementById(id);
	CalId.focus();
	winCal.style.visibility = 'hidden';
}

function changeBorder(element, col, oldBgColor)
{
	if (col === 0)
	{
		element.style.background = HoverColor;
		element.style.borderColor = "black";
		element.style.cursor = "pointer";
	}

	else
	{
		if (oldBgColor)
		{
			element.style.background = oldBgColor;
		}
		else
		{
			element.style.background = "white";
		}
		element.style.borderColor = "white";
		element.style.cursor = "auto";
	}
}

function selectDate(element, date) {
    Cal.Date = date;
    selDate = new Date(Cal.Year, Cal.Month, Cal.Date);
    element.style.background = SelDateColor;
    RenderCssCal();
}

function pickIt(evt)
{
	var objectID,
	dom,
	de,
	b;
	// accesses the element that generates the event and retrieves its ID
	if (document.addEventListener)
	{ // w3c
		objectID = evt.target.id;
		if (objectID.indexOf(calSpanID) !== -1)
		{
			dom = document.getElementById(objectID);
			cnLeft = evt.pageX;
			cnTop = evt.pageY;

			if (dom.offsetLeft)
			{
				cnLeft = (cnLeft - dom.offsetLeft);
				cnTop = (cnTop - dom.offsetTop);
			}
		}

		// get mouse position on click
		xpos = (evt.pageX);
		ypos = (evt.pageY);
	}

	else
	{ // IE
		objectID = event.srcElement.id;
		cnLeft = event.offsetX;
		cnTop = (event.offsetY);

		// get mouse position on click
		de = document.documentElement;
		b = document.body;

		xpos = event.clientX + (de.scrollLeft || b.scrollLeft) - (de.clientLeft || 0);
		ypos = event.clientY + (de.scrollTop || b.scrollTop) - (de.clientTop || 0);
	}

	// verify if this is a valid element to pick
	if (objectID.indexOf(calSpanID) !== -1)
	{
		domStyle = document.getElementById(objectID).style;
	}

	if (domStyle)
	{
		domStyle.zIndex = 100;
		return false;
	}

	else
	{
		domStyle = null;
		return;
	}
}



function dragIt(evt)
{
	if (domStyle)
	{
		if (document.addEventListener)
		{ //for IE
			domStyle.left = (event.clientX - cnLeft + document.body.scrollLeft) + 'px';
			domStyle.top = (event.clientY - cnTop + document.body.scrollTop) + 'px';
		}
		else
		{  //Firefox
			domStyle.left = (evt.clientX - cnLeft + document.body.scrollLeft) + 'px';
			domStyle.top = (evt.clientY - cnTop + document.body.scrollTop) + 'px';
		}
	}
}

// performs a single increment or decrement
function nextStep(whatSpinner, direction)
{
	if (whatSpinner === "Hour")
	{
		if (direction === "plus")
		{
			Cal.SetHour(Cal.Hours + 1);
			RenderCssCal();
		}
		else if (direction === "minus")
		{
			Cal.SetHour(Cal.Hours - 1);
			RenderCssCal();
		}
	}
	else if (whatSpinner === "Minute")
	{
		if (direction === "plus")
		{
			Cal.SetMinute(parseInt(Cal.Minutes, 10) + 1);
			RenderCssCal();
		}
		else if (direction === "minus")
		{
			Cal.SetMinute(parseInt(Cal.Minutes, 10) - 1);
			RenderCssCal();
		}
	}

}

// starts the time spinner
function startSpin(whatSpinner, direction)
{
	document.thisLoop = setInterval(function ()
	{
		nextStep(whatSpinner, direction);
	}, 125); //125 ms
}

//stops the time spinner
function stopSpin()
{
	clearInterval(document.thisLoop);
}

function dropIt()
{
	stopSpin();

	if (domStyle)
	{
		domStyle = null;
	}
}

// Default events configuration

document.onmousedown = pickIt;
document.onmousemove = dragIt;
document.onmouseup = dropIt;


function onSelectcond()
{

        var aind = document.forms[0].condtype.selectedIndex;
        document.forms[0].status.value = document.forms[0].condtype[aind].text;
       // alert(document.forms[0].condtype[aind].text+"-----------------------");
        if(document.forms[0].condtype[aind].text=='Open')
        {
         document.forms[0].act_ship_date.value='0000-00-00';
        }
}


function GetRmpoNum4BOI(type,index) {
 
  var partnum = document.getElementById("partnum"+index).value;
  var winWidth = 880;
  var winHeight = 300;
  var winLeft = (screen.width-winWidth)/2;
  var winTop = (screen.height-winHeight)/2;

  if (type.trim() == "") {
    var type = document.getElementById("type"+index).value;
  }

  win1 = window.open("GetRmpoNum4BOI.php?partnum="+partnum+"&type="+type, index, +
  "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
  ",width=" + winWidth + ",height=" + winHeight +
  ",top="+winTop+",left="+winLeft);

}

function SetRMPO(rmpos,fieldname)
{

  var data4rmpo = rmpos.split("|");
  
  document.getElementById('rmponum_li'+fieldname).value= data4rmpo[0];
  document.getElementById('rmponum_linum'+fieldname).value= data4rmpo[6];
  var wo_qty = parseInt(document.getElementById("qty_wo"+fieldname).value);

  document.getElementById('cost_li'+fieldname).value= wo_qty*parseFloat(data4rmpo[5]);
  
}

function GetOwner(rt){

var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getowner.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetOwner(emp,emprecnum,fieldname){
document.getElementById(fieldname).value = emp;
document.getElementById(fieldname + "recnum").value = emprecnum;
}


function qains_check(index,appdate) 
{
    if (document.getElementById('qainsp_app'+index).checked){
      document.getElementById('qainsp_appdate'+index).value = appdate;
      document.getElementById('qainsp_app'+index).value = 'yes';
    }else{
      document.getElementById('qainsp_appdate'+index).value = "";
      document.getElementById('qainsp_app'+index).value = 'no';
    } 
}

function milestoneApproval(assyworecnum,wfrecnum,stagenum,logindept,milestone) {

    $.ajax({
          async : false,
          global : false,
          url : "AssyProcessApproval.php",
          type : "POST",
          dataType: "html", 
          data : "assyworecnum="+assyworecnum+"&wfrecnum="+wfrecnum+"&stagenum="+stagenum+"&logindept="+logindept+"&milestone="+milestone,
          success : function (response){
            // console.log(response);
            
            if (response != 'success') 
            {
              alert(response); return false;
              
            }
            else
            {
              window.location.href = 'assywoDetails.php?worecnum='+assyworecnum;
            }


          }

      });

  
}




