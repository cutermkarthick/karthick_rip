function addRow(id,index,cofc)
{

var x = index;
var y = index;

cofcnum = "cofcnum" + index;
ponum = "ponum" + index;
wo = "wo" + index;
partnum = "partnum" + index;
batchno = "batchno" + index;
box = "box" + index;
qty = "qty" + index;
psn = "psn" + index;

var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

prev_wo = "prev_wo" + index;
lirecnum = "lirecnum" + index;



var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.type="text";
inp2.name=wo;
inp2.id=wo;
inp2.size="8";
cell2.appendChild(inp2);


var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.type="text";
inp5.name=box;
inp5.id=box;
inp5.size="5";
cell5.appendChild(inp5);

var cell6 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.type="text";
inp6.name=qty;
inp6.id=qty;
inp6.size="4";
cell6.appendChild(inp6);


var cell7 = document.createElement("TD");
var inp7 =  document.createElement("INPUT");
inp7.type="text";
inp7.name=psn;
inp7.id=psn;
inp7.size="6";
inp7.readOnly="true";
inp7.style.backgroundColor = "#DDDDDD";
cell7.appendChild(inp7);

var inp0 =  document.createElement("INPUT");
inp0.type="hidden";
inp0.name=cofcnum;
inp0.id=cofcnum;
inp0.size="8";
inp0.value=cofc;
cell7.appendChild(inp0);

var inp1 =  document.createElement("INPUT");
inp1.type="hidden";
inp1.name=ponum;
inp1.id=ponum;
inp1.size="8";
cell7.appendChild(inp1);


var inp3 =  document.createElement("INPUT");
inp3.type="hidden";
inp3.name=partnum;
inp3.id=partnum;
inp3.size="18";
cell7.appendChild(inp3);


var inp4 =  document.createElement("INPUT");
inp4.type="hidden";
inp4.name=batchno;
inp4.id=batchno;
inp4.size="8";
cell7.appendChild(inp4);

var inp8 =  document.createElement("INPUT");
inp8.type="hidden";
inp8.name=prev_wo;
inp8.id=prev_wo;
cell7.appendChild(inp8);

var inp9 =  document.createElement("INPUT");
inp9.type="hidden";
inp9.name=lirecnum;
inp9.id=lirecnum;
cell7.appendChild(inp9);


row.appendChild(cell2);
row.appendChild(cell5);
row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell6);
row.appendChild(cell7);
tbody.appendChild(row);
x++;
//alert("i am here");
document.forms[0].index.value=x;
}

function check_req_fields()
{
 var errmsg = "";
 ind = document.forms[0].index.value;
 //alert(ind);
 var wo_arr = new Array();
 flag = 0;
 var prev_box = "#";
 var boxarray = new Array(10);
 //alert(ind);
 for(i=1;i<ind;i++)
 {
   cofcnum = "cofcnum"+i;
   ponum = "ponum"+i;
   wo = "wo"+i;
   partnum = "partnum"+i;
   batchno = "batchno"+i;
   box = "box"+i;
   qty = "qty"+i;
   psn = "psn"+i;
   
   var wonum = (document.getElementById(wo).value);
  if(document.getElementById(wonum) != undefined)
  {
   if(document.getElementById(wo).value.length != 0)
   {
     li_qty = (document.getElementById(qty).value);
     disp_qty= (document.getElementById(wonum).value);
     
     if (document.getElementById(box).value.length == 0)
     {
         errmsg += "Please enter Box for WO:"+wonum+ " at line:"+i+"\n";
     }
     else if (document.getElementById(box).value.length != 0)
     {
         box_flag=0;       
          boxnum=document.getElementById(box).value;
          for(k=1;k<=boxnum.length;k++)
          {
            if(boxnum.charAt(k) == '-')
            {
              box_flag=1;
            }
          }
          if(box_flag != 1)
          {
            errmsg += 'Please enter - for the Box at line '+i+'\n';
          }
          else
          {
             BOX = boxnum.split("-");
             if(BOX[0] != wonum)
             {
                errmsg += 'Please enter valid Box at line '+i+'\n';               
             }             
          }
          //alert(box_flag);
          for (j=1; j<ind;j++) 
          {
            if (boxnum == boxarray[j])
            {
              errmsg += 'Duplicate Box at line ' + i + '\n';
            }
          }
              boxarray[i] = boxnum;
     }
     if (document.getElementById(qty).value.length == 0)
     {
         errmsg += "Please enter Qty for WO:"+wonum+ " at line:"+i+"\n"
     }

     if(parseInt(li_qty) > parseInt(disp_qty))
     {
        errmsg += "Qty should be less than or equal to Dispatch Qty for WO:"+wonum+"\n";;
     }
     
     
      if(flag == 0)
      {
        wo_arr[wonum] = parseInt(li_qty);
        flag=1;
      }
      else
      {
       if(wo_arr[wonum])
       {
         wo_arr[wonum] =  (parseInt(wo_arr[wonum]) + parseInt(li_qty));
       }
       else
       {
         wo_arr[wonum] = parseInt(li_qty);
       }
      }
     prev_box = document.getElementById(box).value; 
     }
    }
    else if(wonum != '')
    {
      errmsg += "Please enter valid WO# at line:"+i+"\n"
    }
  }

  for (key in wo_arr)
  {
     //alert('key='+key+'value='+wo_arr[key]);
    if(parseInt(wo_arr[key]) > parseInt(document.getElementById(key).value))
    {
       errmsg += "Total Box Qty for WO:"+key+" should be lesser or equal to Cofc Qty \n";

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
