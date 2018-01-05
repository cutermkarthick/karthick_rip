/*
function Getwo4del(rt) {

  //alert('Getwo4del');
  var param = rt;
  var winWidth = 1000;
  var winHeight = 300;
  var winLeft = (screen.width-winWidth)/2;
  var winTop = (screen.height-winHeight)/2;
  win1 = window.open("getwo4del.php", rt, +
  "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
  ",width=" + winWidth + ",height=" + winHeight +
  ",top="+winTop+",left="+winLeft);
}

function Setwo4del(CIM,fieldname) {
   //alert(CIM);
   //alert(fieldname);
   var CIM = CIM.split("|");

   var id1="wonum"+ fieldname;
   var text1= document.getElementById(id1);
   text1.value=CIM[0];

   var id2="mfg_partnum"+ fieldname;
   var text2= document.getElementById(id2);
   text2.value=CIM[1];

   var id3="treat_partnum"+ fieldname;
   var text3= document.getElementById(id3);
   text3.value=CIM[2];

   var id4="rmspec"+ fieldname;
   var text4= document.getElementById(id4);
   text4.value=CIM[8];

   var id6="partiss"+ fieldname;
   var text6= document.getElementById(id6);
   text6.value=CIM[3];

   var id7="drgiss"+ fieldname;
   var text7= document.getElementById(id7);
   text7.value=CIM[4];

   var id8="batch_no"+ fieldname;
   var text8= document.getElementById(id8);
   text8.value=CIM[7];

   /*var id9="itemnum"+ fieldname;
   var text9= document.getElementById(id9);
   var disp_qty="disp_qty"+fieldname;
   var dq = document.getElementById(disp_qty).value;
   text9.value=CIM[8]-dq;

   var id10="qty"+ fieldname;
   var text10= document.getElementById(id10);
   text10.value=CIM[9];

   var id11="dateCode"+ fieldname;
   var text11= document.getElementById(id11);
   text11.value=CIM[6];

   var id15="cos"+ fieldname;
   var text15 = document.getElementById(id15);
   text15.value=CIM[5];
   
   var id16="grn"+ fieldname;
   var text16= document.getElementById(id16);
   text16.value=CIM[10];
}*/

function GetDate(rt) {
//alert('hi');
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

fn = document.getElementById(fieldname);
//alert(fn);
fn.value = dateval;
}

function printCofc(delrecnum) {
//alert(disprecnum);
var winWidth = 1200;
var winHeight = 1200;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("dnPrint.php?delrecnum="+delrecnum, "PrintCofcDeliver", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function addRow(id,index){
//alert(index);
var x = index;
var y = index;
line_num="line_num"+index;
dn_stage="dn_stage"+index;
cofc_num="cofc_num"+index;
cofc_date="cofc_date"+index;
qty_recd="qty_recd"+index;
qty_acc="qty_acc"+index;
qty_rej="qty_rej"+index;
//qty_rew="qty_rew"+index;
insp_stamp="insp_stamp"+index;
supp_wo="supp_wo"+index;
datecode="datecode"+index;
nc_num="nc_num"+index;
disp_qty="dispatch_qty"+index;
cost="cost"+index;
//qty_rej4stores="qty_rej4stores"+index ;
qty_rewqa="qty_rewqa"+index;

var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

prevlinenum = "prev_line_num" + index;
lirecnum = "lirecnum" + index;


var cell1 = document.createElement("TD");
cell1.setAttribute("align","left");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","3");
inp1.setAttribute("name",line_num);
inp1.setAttribute("id",line_num);
cell1.appendChild(inp1);
 
 /*var cell15 = document.createElement("TD");
cell15.setAttribute("align","left");
var inp15 =  document.createElement("INPUT");
inp15.setAttribute("type","text");
inp15.setAttribute("size","5");
inp15.setAttribute("name",dn_stage);
inp15.setAttribute("id",dn_stage);
cell15.appendChild(inp15);*/

var cell2 = document.createElement("TD");
cell2.setAttribute("align","left");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","15");
inp2.setAttribute("name",cofc_num);
inp2.setAttribute("id",cofc_num);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
cell3.setAttribute("align","left");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("readOnly","true");
inp3.setAttribute("size","10");
inp3.setAttribute("name",cofc_date);
inp3.setAttribute("id",cofc_date);
inp3.style.backgroundColor = "#DDDDDD";
cell3.appendChild(inp3);

var cell3image = document.createElement("img");
cell3image.setAttribute("src","images/bu-getdateicon.gif");
cell3image.onclick= function() {
GetDate("cofc_date"+y);
};
cell3.appendChild(cell3image);

var inp10 = document.createElement("INPUT");
inp10.setAttribute("type","hidden");
inp10.setAttribute("value","");
inp10.setAttribute("name",prevlinenum);
inp10.setAttribute("id",prevlinenum);
cell3.appendChild(inp10);

var inp11 = document.createElement("INPUT");
inp11.setAttribute("type","hidden");
inp11.setAttribute("value","");
inp11.setAttribute("name",lirecnum);
inp11.setAttribute("id",lirecnum);
cell3.appendChild(inp11);


var cell4 = document.createElement("TD");
cell4.setAttribute("align","left");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","10");
inp4.setAttribute("name",qty_recd);
inp4.setAttribute("id",qty_recd);
cell4.appendChild(inp4);

var cell8 = document.createElement("TD");
cell8.setAttribute("align","left");
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","10");
inp8.setAttribute("name",supp_wo);
inp8.setAttribute("id",supp_wo);
cell8.appendChild(inp8);

var cell9 = document.createElement("TD");
cell9.setAttribute("align","left");
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("readOnly","true");
inp9.setAttribute("size","10");
inp9.setAttribute("name",datecode);
inp9.setAttribute("id",datecode);
inp9.style.backgroundColor = "#DDDDDD";
cell9.appendChild(inp9);

var cell9image = document.createElement("img");
cell9image.setAttribute("src","images/bu-getdateicon.gif");
cell9image.onclick= function() {
GetDate("datecode"+y);
};
cell9.appendChild(cell9image);


var cell5 = document.createElement("TD");
cell5.setAttribute("align","left");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","10");
inp5.setAttribute("name",qty_acc);
inp5.setAttribute("id",qty_acc);
cell5.appendChild(inp5);


var cell6 = document.createElement("TD");
cell6.setAttribute("align","left");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","10");
inp6.setAttribute("name",qty_rej);
inp6.setAttribute("id",qty_rej);
cell6.appendChild(inp6);

var cell7 = document.createElement("TD");
cell7.setAttribute("align","left");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","10");
inp7.setAttribute("name",insp_stamp);
inp7.setAttribute("id",insp_stamp);
cell7.appendChild(inp7);

var cell10 = document.createElement("TD");
cell10.setAttribute("align","left");
var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","10");
inp10.setAttribute("name",nc_num);
inp10.setAttribute("id",nc_num);
cell10.appendChild(inp10);



var cell11 = document.createElement("TD");
cell11.setAttribute("align","left");
var inp11 =  document.createElement("INPUT");
inp11.setAttribute("type","text");
inp11.setAttribute("readOnly","true");
inp11.setAttribute("size","10");
inp11.setAttribute("name",disp_qty);
inp11.setAttribute("id",disp_qty);
inp11.style.backgroundColor = "#DDDDDD";
cell11.appendChild(inp11);


/*var cell11 = document.createElement("TD");
cell11.setAttribute("align","left");
var inp11 =  document.createElement("INPUT");
inp11.setAttribute("type","text");
inp11.setAttribute("size","10");
inp11.setAttribute("name",qty_rew);
inp11.setAttribute("id",qty_rew);
cell11.appendChild(inp11);*/

var cell12 = document.createElement("TD");
cell12.setAttribute("align","left");
var inp12 =  document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","10");
inp12.setAttribute("name",cost);
inp12.setAttribute("id",cost);
cell12.appendChild(inp12);

/*var cell13 = document.createElement("TD");
cell13.setAttribute("align","left");
var inp13 =  document.createElement("INPUT");
inp13.setAttribute("type","text");
inp13.setAttribute("size","10");
inp13.setAttribute("name",qty_rej4stores);
inp13.setAttribute("id",qty_rej4stores);
cell13.appendChild(inp13);  */

var cell14 = document.createElement("TD");
cell14.setAttribute("align","left");
var inp14 =  document.createElement("INPUT");
inp14.setAttribute("type","text");
inp14.setAttribute("size","10");
inp14.setAttribute("name",qty_rewqa);
inp14.setAttribute("id",qty_rewqa);
cell14.appendChild(inp14);




row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell12);
row.appendChild(cell4);
//row.appendChild(cell13);
// row.appendChild(cell11);
row.appendChild(cell8);
row.appendChild(cell9);
row.appendChild(cell5);
row.appendChild(cell14);
row.appendChild(cell6);
row.appendChild(cell10);
row.appendChild(cell11);
row.appendChild(cell7);
// row.appendChild(cell15);



tbody.appendChild(row);
x++;

document.forms[0].index.value = x;
}

function addRow4new(id,index){
// alert(index);
var x = index;
var y = index;
line_num="line_num"+index;
cofc_num="cofc_num"+index;
cofc_date="cofc_date"+index;
qty_recd="qty_recd"+index;
qty_acc="qty_acc"+index;
qty_rej="qty_rej"+index;
//qty_rew="qty_rew"+index;
insp_stamp="insp_stamp"+index;
supp_wo="supp_wo"+index;
datecode="datecode"+index;
nc_num="nc_num"+index;
cost="cost"+index;
disp_qty="disp_qty"+index;
//qty_rej4stores="qty_rej4stores"+index ;
qty_rewqa="qty_rewqa"+index ;

var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

prevlinenum = "prev_line_num" + index;
lirecnum = "lirecnum" + index;


var cell1 = document.createElement("TD");
cell1.setAttribute("align","left");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","3");
inp1.setAttribute("name",line_num);
inp1.setAttribute("id",line_num);
cell1.appendChild(inp1);


var cell2 = document.createElement("TD");
cell2.setAttribute("align","left");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","15");
inp2.setAttribute("name",cofc_num);
inp2.setAttribute("id",cofc_num);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
cell3.setAttribute("align","left");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("readOnly","true");
inp3.setAttribute("size","10");
inp3.setAttribute("name",cofc_date);
inp3.setAttribute("id",cofc_date);
inp3.style.backgroundColor = "#DDDDDD";
cell3.appendChild(inp3);

var cell3image = document.createElement("img");
cell3image.setAttribute("src","images/bu-getdateicon.gif");
cell3image.onclick= function() {
GetDate("cofc_date"+y);
};
cell3.appendChild(cell3image);

var inp10 = document.createElement("INPUT");
inp10.setAttribute("type","hidden");
inp10.setAttribute("value","");
inp10.setAttribute("name",prevlinenum);
inp10.setAttribute("id",prevlinenum);
cell3.appendChild(inp10);

var inp11 = document.createElement("INPUT");
inp11.setAttribute("type","hidden");
inp11.setAttribute("value","");
inp11.setAttribute("name",lirecnum);
inp11.setAttribute("id",lirecnum);
cell3.appendChild(inp11);


var cell4 = document.createElement("TD");
cell4.setAttribute("align","left");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","10");
inp4.setAttribute("name",qty_recd);
inp4.setAttribute("id",qty_recd);
cell4.appendChild(inp4);

var cell8 = document.createElement("TD");
cell8.setAttribute("align","left");
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","10");
inp8.setAttribute("name",supp_wo);
inp8.setAttribute("id",supp_wo);
cell8.appendChild(inp8);

var cell9 = document.createElement("TD");
cell9.setAttribute("align","left");
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("readOnly","true");
inp9.setAttribute("size","10");
inp9.setAttribute("name",datecode);
inp9.setAttribute("id",datecode);
inp9.style.backgroundColor = "#DDDDDD";
cell9.appendChild(inp9);

var cell9image = document.createElement("img");
cell9image.setAttribute("src","images/bu-getdateicon.gif");
cell9image.onclick= function() {
GetDate("datecode"+y);
};
cell9.appendChild(cell9image);


var cell5 = document.createElement("TD");
cell5.setAttribute("align","left");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","10");
inp5.setAttribute("name",qty_acc);
inp5.setAttribute("id",qty_acc);
cell5.appendChild(inp5);


var cell6 = document.createElement("TD");
cell6.setAttribute("align","left");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","10");
inp6.setAttribute("name",qty_rej);
inp6.setAttribute("id",qty_rej);
cell6.appendChild(inp6);

var cell7 = document.createElement("TD");
cell7.setAttribute("align","left");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","10");
inp7.setAttribute("name",insp_stamp);
inp7.setAttribute("id",insp_stamp);
cell7.appendChild(inp7);

var cell10 = document.createElement("TD");
cell10.setAttribute("align","left");
var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","15");
inp10.setAttribute("name",nc_num);
inp10.setAttribute("id",nc_num);
cell10.appendChild(inp10);


var cell11 = document.createElement("TD");
cell11.setAttribute("align","left");
var inp11=  document.createElement("INPUT");
inp11.setAttribute("type","text");
inp11.setAttribute("readOnly","true");
inp11.setAttribute("size","15");
inp11.setAttribute("name",disp_qty);
inp11.setAttribute("id",disp_qty);
inp11.style.backgroundColor = "#DDDDDD";
cell11.appendChild(inp11);

/*var cell11 = document.createElement("TD");
cell11.setAttribute("align","left");
var inp11 =  document.createElement("INPUT");
inp11.setAttribute("type","text");
inp11.setAttribute("size","10");
inp11.setAttribute("name",qty_rew);
inp11.setAttribute("id",qty_rew);
//inp11.setAttribute("value",'qty_rew');
cell11.appendChild(inp11); */

/*var cell12 = document.createElement("TD");
cell12.setAttribute("align","left");
var inp12 =  document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","10");
inp12.setAttribute("name",cost);
inp12.setAttribute("id",cost);
cell12.appendChild(inp12); */

/*var cell13 = document.createElement("TD");
cell13.setAttribute("align","left");
var inp13 =  document.createElement("INPUT");
inp13.setAttribute("type","text");
inp13.setAttribute("size","10");
inp13.setAttribute("name",qty_rej4stores);
inp13.setAttribute("id",qty_rej4stores);
cell13.appendChild(inp13);*/

var cell14 = document.createElement("TD");
cell14.setAttribute("align","left");
var inp14 =  document.createElement("INPUT");
inp14.setAttribute("type","text");
inp14.setAttribute("size","10");
inp14.setAttribute("name",qty_rewqa);
inp14.setAttribute("id",qty_rewqa);
cell14.appendChild(inp14);


row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
//row.appendChild(cell12);
row.appendChild(cell4);
//row.appendChild(cell13);
//row.appendChild(cell11);
row.appendChild(cell8);
row.appendChild(cell9);
row.appendChild(cell5);
row.appendChild(cell14);
row.appendChild(cell6);
row.appendChild(cell10);
row.appendChild(cell11);
row.appendChild(cell7);


tbody.appendChild(row);
x++;

document.forms[0].index.value = x;
}


function check_req_fields()
{

  // alert(current_qty);
    //return false;
    var lipresent = 0;
    var errmsg = '';
    var x = 1;
    // var index = document.forms[0].index.value;
    //alert(index);
    index = 6;
    var page =  document.forms[0].page.value;
    var dept =  document.forms[0].dept.value;

  if(page == 'new')
  {
    var treatmentindex =  document.getElementById('treat_to').selectedIndex;
    if(treatmentindex == 0)
    {
       errmsg +='Please Select Treatment To.\n';
    }
    var deliverindex =  document.getElementById('treat_deliver').selectedIndex;
    if(deliverindex == 0)
    {
       errmsg +='Please Select Deliver To.\n';
    }
  // }
 // alert('aaa');
    if (document.forms[0].crn.value.length == 0)
    {
         errmsg += 'Please enter CRN#.\n';
    }
    if (document.forms[0].deliver_date.value.length == 0)
    {
         errmsg += 'Please enter Deliver Date.\n';
    }
	// if (document.forms[0].ponum.value.length == 0)
 //    {
 //         errmsg += 'Please enter PO No.\n';
 //    }
	 if (document.forms[0].wonum.value.length == 0)
    {
         errmsg += 'Please enter WO#.\n';
    }
  }
  //  var header_qty= parseInt(document.forms[0].qty.value);

  //  var total_qtyrecd=0;
  // // if(page == 'new')
  // {
  //   while (x < index)
  //   {
      
	 //  var sum_acc_rej=0;
  //     var qty_received=0;
  //      ln = "line_num" + x;
  //      lnv = document.getElementById(ln).value;
  //      if (document.getElementById(ln).value.length != 0)
  //      {
  //          cofc_num="cofc_num" +x;
  //          if (document.getElementById(cofc_num).value.length == 0)
  //          {
  //            //alert('crn');
  //              errmsg += 'Please enter CofC#  for line item ' + lnv + '\n';
  //          }
	 //       cofc_date="cofc_date" +x;
  //          if (document.getElementById(cofc_date).value.length == 0)
  //          {
  //            //alert('crn');
  //              errmsg += 'Please enter CofC Date  for line item ' + lnv + '\n';
  //          }
	 //   qty_recd="qty_recd" +x;
	 //   qty_rej4store="qty_rej4stores" +x;
	 //   qty_rew="qty_rew" +x;

	 //   qty_received = parseInt(document.getElementById(qty_recd).value);
	 //   //qty_rejected4st=parseInt(document.getElementById(qty_rej4store).value);
  //      //qty_rework=parseInt(document.getElementById(qty_rew).value);
  //    total_qtyrecd += (qty_received);
	 //   qty_acc="qty_acc" +x;
	 //   qty_rej="qty_rej" +x;
	 //   qty_rewqa="qty_rewqa" +x;
	 //   nc_num="nc_num" +x;

	 //   sum_acc_rej = parseInt(document.getElementById(qty_acc).value)+parseInt(document.getElementById(qty_rej).value)+parseInt(document.getElementById(qty_rewqa).value);

  //     if(dept == 'QA')
  //     {
	 //   if(sum_acc_rej != qty_received)
	 //   {
		// errmsg += 'Qty Received in line# '+ lnv +' should be equal to the sum of Qty Acc + Qty Rej \n';
	 //   }
	 //  }
  //        if(document.getElementById(qty_rej).value != 0 && document.getElementById(nc_num).value.length == 0)
  //      {
  //         errmsg += "Please Enter NC number line# "+ lnv + "\n" ;
  //      }
  //          lipresent = 1;
  //      }
  //      x++;
  //    }

  //     if(dept == 'Sales' || dept == 'Stores')
  //     {
  //      if(total_qtyrecd > header_qty )
  //      {
	 //     errmsg += 'QTY(WO) should be equal to sum of Qty Recd , Qty Rej(stores) & Qty Rew in Line Items \n';
  //      }
  //     }
  //      wo_qty = document.getElementById('wo_qty').value;
  //      sum_dnqty = document.getElementById('sum_dnqty').value;
	 //   //alert("sum of dn qty is " + parseInt(wo_qty))
	 //   if (sum_dnqty == '')
	 //   {
		//    sum_dnqty = wo_qty
	 //   }
  //      current_qty = document.getElementById('qty').value;
	 //   // alert("current_qty is " + current_qty);
  //   //  alert(wo_qty);
  //      if(parseInt(current_qty) > parseInt(wo_qty))
  //      {


  //        errmsg += 'DN qty should be less than or equal to WO qty(Acc) for Work Order #'+document.getElementById('wonum').value+'\n';
  //      }
  //      totaldn_po = 0;
  //      if(document.getElementById('totaldn4po').value != 0)
  //      {
  //        totaldn_po = parseInt(document.getElementById('totaldn4po').value);
  //      }
  //      // alert(totaldn_po);
  //      poqty = parseInt(document.getElementById('poqty').value);
  //      // alert(poqty);
  //      current_qty = parseInt(current_qty);
  //      // alert(cur_qty);
  //     // alert('poqty='+poqty+'cur='+current_qty+'totaldn='+totaldn_po);
  //      // if((current_qty+totaldn_po) > poqty)
  //      // {
  //      //   errmsg += 'Total DN Qty for the PO Num and Line Num should be less or eual to PO Qty\n';
  //      // }

  //   }
    else if (page == 'edit')
   {
          var sumqty_recd = 0;
          var sumqtyrecd1 = 0; 
           dnqty = document.getElementById("qty").value;
     while (x < index)
     {
	  var sum_acc_rej=0;
      var qty_received=0;

      var qty_recd = 0;
      
     // var total_qtyrecd = 0;
       ln = "line_num" + x;
       lnv = document.getElementById(ln).value;
      


       if (document.getElementById(ln).value.length != 0)
       {
           cofc_num="cofc_num" +x;
           if (document.getElementById(cofc_num).value.length == 0)
           {
             //alert('crn');
               errmsg += 'Please enter CofC#  for line item ' + lnv + '\n';
           }
	   cofc_date="cofc_date" +x;
           if (document.getElementById(cofc_date).value.length == 0)
           {
             //alert('crn');
               errmsg += 'Please enter CofC Date  for line item ' + lnv + '\n';
           }
        supp_wonum = "supp_wo" +x;
  if (document.getElementById(supp_wonum).value.length == 0)
           {
             //alert('crn');
               errmsg +='Enter Supplier WO in Line#'+lnv+'\n';
           }

		   cost="cost" +x;
		   dnprice=document.getElementById(cost).value;
		   rmprice=document.forms[0].unitprice.value;
           if (dnprice != rmprice)
           {
            // errmsg += 'SP PO unit price and entered price do not match for the PO/CRN' + lnv + '\n';
           }
       qty_recd="qty_recd" +x;
       // alert(qty_recd);
       qty_rej4store="qty_rej4stores" +x;
       qty_rew="qty_rew" +x;
	     qty_received = parseInt(document.getElementById(qty_recd).value);
	   //qty_rejected4st=parseInt(document.getElementById(qty_rej4store).value);
	   //qty_rework=parseInt(document.getElementById(qty_rew).value);
	      totalqty4store=(qty_received);
        //total_qtyrecd += totalqty4store;
      // alert(total_qtyrecd+"-----------");
	     qty_acc="qty_acc" +x;
	     qty_rej="qty_rej" +x;
	     qty_rewqa="qty_rewqa" +x;
	     nc_num="nc_num" +x;
  
    if(document.getElementById(qty_rej).value  == '')
    {
      var qty_rej_val = 0;

    }
    else
    {
      var qty_rej_val = document.getElementById(qty_rej).value;
    }

    if(document.getElementById(qty_rewqa).value  == '')
    {
      var qty_rewqa_val = 0;

    }
    else
    {
      var qty_rewqa_val = document.getElementById(qty_rewqa).value;
    }

    qty_recd1 =document.getElementById(qty_recd).value;

  sum_acc_rej = parseInt(document.getElementById(qty_acc).value)+parseInt(qty_rej_val)+parseInt(qty_rewqa_val);
  sumqtyrecd1 = parseInt(qty_recd1);
  sumqty_recd+=sumqtyrecd1;
  // alert("qty_rej " +qty_rej);
  // alert("qty_rewqa " +qty_rewqa);
  

      if(dept == 'Sales' || dept == 'QA')
      {
    	   if(sum_acc_rej != qty_received)
    	   {
    		errmsg += 'QtyRecd by Stores in line# '+ lnv +' should be equal to the sum of Qty Acc + Qty Rej by QA\n';
    	   }
      }
      if((document.getElementById(qty_rej).value != 0 && document.getElementById(qty_rej).value != '')&& document.getElementById(nc_num).value == 0)
       {
          errmsg += 'Please Enter NC number for line# '+lnv+ '\n' ;
       }
           lipresent = 1;
       }


       x++;
      
     }
     if(sumqty_recd > dnqty)
     {

         errmsg += 'Sum of Qty Recived should not be greater than DN Qty';
     

     }
      // if(dept == 'Sales' || dept == 'Stores')
      // {


      // //  if(total_qtyrecd > header_qty )
      // //  {
	     // // errmsg += 'QTY(WO) should be equal to sum of Qty Recd , Qty Rej(stores) & Qty Rew in Line Items \n';
      // //  }
      // }
       wo_qty = parseInt(document.getElementById('wo_qty').value);
       cur_qty = document.getElementById('cur_qty').value;
       // alert(cur_qty);
       //sum_dnqty = document.getElementById('sum_dnqty').value;
       //utd_qty = (parseInt(sum_dnqty)-parseInt(cur_qty));
       // document.getElementById('wo_qty') = wo_qty;
       current_qty = parseInt(document.getElementById('qty').value);
       // alert(wo_qty+"********************"+current_qty);
       // if((current_qty) > wo_qty)
       // {
       //   errmsg += 'DN qty should be less than or equal to WO qty(Acc) for Work Order #'+document.getElementById('wonum').value+'\n';
       // }
       totaldn_po = 0;
       if(document.getElementById('totaldn4po').value != '')
       {
         totaldn_po = parseInt(document.getElementById('totaldn4po').value);
       }
       poqty = parseInt(document.getElementById('poqty').value);
       current_qty = parseInt(current_qty);
       utd_dn4po = (totaldn_po-parseInt(cur_qty));
       // alert('poqty='+poqty+'cur='+current_qty+'totaldn='+totaldn_po+'utdpo='+utd_dn4po);
       // if((current_qty) > poqty)
       // {
       //   errmsg += 'Total DN Qty for the PO Num and Line Num should be less or eual to PO Qty\n';
       // }

    }
     //alert('aaa');

     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}



function Getwo_dn() {
//alert('working');
var winWidth = 1000;
var winHeight = 350;
//alert(screen.width)
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var crn=document.forms[0].crn.value;
if(crn !='')
{
win1 = window.open("getwo4dn.php?crn="+crn,"aa", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
else
{
	  alert('Please Enter CRN#');
	  return false;
}
}

function Setwo_dn(CIMarr,fieldname)
{
// alert(CIMarr);
  // alert(CIM);
// alert(fieldname);
//alert(document.forms[0].elements[fieldname + "recnum"]);
var page =  document.forms[0].page.value;
var CIM = CIMarr.split("|");


if((CIM[10] == 0 || CIM[10] < 0) && (CIM[10] != ''))
{
// alert(CIM[10]);
alert('Balance is 0,please select different WO');

return false;
}
else
{

  // alert(CIM);
document.getElementById('wonum').value = CIM[0];
document.getElementById('untreated_partnum').value = CIM[16];
document.getElementById('treated_partnum').value = CIM[3];
document.getElementById('part_iss').value = CIM[4];
document.getElementById('drg_iss').value = CIM[5];
document.getElementById('cos').value = CIM[6];
document.getElementById('mtl_spec').value = CIM[15];
document.getElementById('grn_num').value = CIM[8];
document.getElementById('batch_num').value = CIM[9];
document.getElementById('qty').value = CIM[1];
document.getElementById('wo_qty').value = CIM[1];
if(page == 'new')
{
  document.getElementById('sum_dnqty').value = CIM[10];
}
else
{
  document.getElementById('sum_dnqty').value = CIM[11];
}
}
}

function Getpo_num() {

//alert('working');
var winWidth = 500;
var winHeight = 300;
//alert(screen.width)
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var crn=document.forms[0].crn.value;
if(crn !='')
{
win1 = window.open("getpo_num.php?crn="+crn,"aa", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
else
{
	  alert('Please Enter CRN#');
	  return false;
}

}
function Setpo_num(sppo,sppoarr,fieldname) 
{

  // alert(sppo);
var sppo = sppoarr.split("|");
if(sppo[5] != '')
{
document.getElementById('ponum').value = sppo[0]+' Amnd '+sppo[5];
}
else
{
document.getElementById('ponum').value = sppo[0];
}
document.getElementById('poline_num').value = sppo[1];
document.getElementById('podate').value = sppo[2];
document.getElementById('poqty').value = sppo[3];
document.getElementById('pur_qty').value = sppo[3];
document.getElementById('totaldn4po').value = sppo[4];

}

function resetpo_wo() 
{
document.getElementById('ponum').value='';
document.getElementById('wonum').value='';
}

function checkqty_recd(qty_acc) 
{
  // alert("reached");
  var x = 1;
  var errmsg = '';
     index = 6;
var qty_recd = 0;
var sumrecd_qty = 0;
var totqty_recd =0;
  while(x < index)
  {
      ln = "line_num" + x;
       lnv = document.getElementById(ln).value;
      
        qty_recd = "qty_recd" +x;
       qty_acc = "qty_acc" +x;
      if(qty_acc!='')
      {

        qty_acc1  = document.getElementById(qty_acc).value; 

      }
      acc_qty = parseInt(qty_acc1);
      if(qty_recd!='')
      {
         qty_recd1 = document.getElementById(qty_recd).value;

      }
      recd_qty = parseInt(qty_recd1);
      
  x++;
  if(acc_qty > recd_qty)
  {
      errmsg += "The Accepted Qty should not be greater than Received Qty"
   
  }


  } 

if(errmsg=='')
{
   return true;
}else
{
  alert(errmsg);
  return false;
}



}


function Getwo_dn() {
//alert('working');
var winWidth = 1000;
var winHeight = 350;
//alert(screen.width)
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var crn=document.forms[0].crn.value;
if(crn !='')
{
win1 = window.open("getwo4dn.php?crn="+crn,"aa", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}
else
{
    alert('Please Enter CRN#');
    return false;
}
}

function Getwocrn(rt) {
//alert(rt);
var param = rt;
var winWidth = 300;
var winHeight = 400;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getwocrn4dn.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function Setwocrn_dn(CIMarr,fieldname)
{
// alert(CIMarr);
var CIM = CIMarr.split("|");
document.getElementById("crn").value = CIM[0];
document.getElementById("wonum").value ='';
  // alert(CIM);
// alert(fieldname);
//alert(document.forms[0].elements[fieldname + "recnum"]);
//var page =  document.forms[0].page.value;
}