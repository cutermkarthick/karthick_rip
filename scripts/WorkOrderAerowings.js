function addRow4irm(id,ind1)
{
// things to add
ind1= parseInt(ind1);
//ind1++;
//alert(id+"****"+ind1);
irmline_num = "irmline_num" + ind1; //text box
po_num = "po_num" + ind1; //text box;
po_qty = "po_qty" + ind1; //text box
mgp_num = "mgp_num" + ind1; //text box
mgp_date="mgp_date"+ind1;
rm_dim1 = "rm_dim1" + ind1;
rm_dim2 = "rm_dim2" + ind1;
rm_dim3 = "rm_dim3" + ind1;
rm_qty = "rm_qty" + ind1;
qty_to_make="qty_to_make"+ind1;
cust_batch_num = "cust_batch_num" + ind1;
cust_wo_num = "cust_wo_num" + ind1;
irmremarks="irmremarks"+ind1;

prevlinenum = "prevlinenum" + ind1;
lirecnum = "lirecnum" + ind1;

var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];

var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");
var inp1 = document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","4");
inp1.setAttribute("name",irmline_num);
//inp1.setAttribute("value",irmline_num);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","10");
inp2.setAttribute("name",po_num);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","6");
inp3.setAttribute("name",po_qty);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 = document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","10");
inp4.setAttribute("name",mgp_num);
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","10");
inp5.setAttribute("readonly","readonly");
inp5.setAttribute("name",mgp_date);
inp5.setAttribute("id",mgp_date);
//inp5.setAttribute("value",mgp_date);
inp5.style.backgroundColor = "#DDDDDD";

var img1 = document.createElement("img");
img1.setAttribute("src","images/bu-getdateicon.gif");
img1.setAttribute("alt","Get BookDate");
//img.setAttribute("onClick","alert('Hi');");
img1.onclick = function(){GetDate(mgp_date);};
cell5.appendChild(inp5);
cell5.appendChild(img1);

var cell6 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","5");
inp6.setAttribute("name",rm_dim1);
cell6.appendChild(inp6);

var cell7 = document.createElement("TD");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","5");
inp7.setAttribute("name",rm_dim2);
cell7.appendChild(inp7);

var cell8 = document.createElement("TD");
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","5");
inp8.setAttribute("name",rm_dim3);
cell8.appendChild(inp8);

var cell9 = document.createElement("TD");
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","5");
inp9.setAttribute("name",rm_qty);
cell9.appendChild(inp9);

var cell10 = document.createElement("TD");
var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","7");
inp10.setAttribute("name",qty_to_make);
cell10.appendChild(inp10);

var cell11 = document.createElement("TD");
var inp11 =  document.createElement("INPUT");
inp11.setAttribute("type","text");
inp11.setAttribute("size","10");
inp11.setAttribute("name",cust_batch_num);
cell11.appendChild(inp11);

var cell12 = document.createElement("TD");
var inp12 =  document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","10");
inp12.setAttribute("name",cust_wo_num);
cell12.appendChild(inp12);

var cell13 = document.createElement("TD");
var inp13 =  document.createElement("INPUT");
inp13.setAttribute("type","text");
inp13.setAttribute("size","10");
inp13.setAttribute("name",irmremarks);
cell13.appendChild(inp13);


var inp14 = document.createElement("INPUT");
inp14.setAttribute("type","hidden");
inp14.setAttribute("value","");
inp14.setAttribute("name",prevlinenum);
cell13.appendChild(inp14);

var inp15 = document.createElement("INPUT");
inp15.setAttribute("type","hidden");
inp15.setAttribute("value","");
inp15.setAttribute("name",lirecnum);
cell13.appendChild(inp15)

row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell8);
row.appendChild(cell9);
row.appendChild(cell10);
row.appendChild(cell11);
row.appendChild(cell12);
row.appendChild(cell13);

tbody.appendChild(row);

ind1++;
document.forms[0].indexirm.value=ind1;
document.forms[0].curindex.value=ind1;

}


function addRow4mm(id,ind1){
	// things to add
 ind1= parseInt(ind1);
//	ind1++;
      // alert(id+"***"+ind1);
    mmline_num = "mmline_num" + ind1;
  //  alert(mmline_num);
   	qty_drawn = "qty_drawn" + ind1; //text box;
    drawn_by = "drawn_by" + ind1; //text box
	drawn_date = "drawn_date" + ind1; //text box
    issued_by = "issued_by" + ind1;
    issued_date = "issued_date" + ind1;
	recd_by = "recd_by" + ind1;
	sl_from = "sl_from" + ind1;
	sl_to = "sl_to" + ind1;
    accepted = "accepted" + ind1;
    rejected = "rejected" + ind1;
	returned = "returned" + ind1;
    notes = "notes" + ind1;

    prevlinenum = "mmprevlinenum" + ind1;
	lirecnum = "mmlirecnum" + ind1;

	var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];

	var row = document.createElement("TR");
	row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");

var inp1 = document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","5");
inp1.setAttribute("name",mmline_num);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","6");
inp2.setAttribute("name",qty_drawn);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","10");
inp3.setAttribute("name",drawn_by);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 = document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","10");
inp4.setAttribute("name",drawn_date);
inp4.setAttribute("id",drawn_date);
//inp4.setAttribute("value",drawn_date);
inp4.style.backgroundColor = "#DDDDDD";

var img1 = document.createElement("img");
img1.setAttribute("src","images/bu-getdateicon.gif");
img1.setAttribute("alt","Get DrawnDate");
img1.onclick = function(){GetDate2(drawn_date);};

cell4.appendChild(inp4);
cell4.appendChild(img1);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","10");
inp5.setAttribute("name",issued_by);
cell5.appendChild(inp5);

var cell6 = document.createElement("TD");
var inp6 = document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","10");
inp6.setAttribute("name",issued_date);
inp6.setAttribute("id",issued_date);
//inp6.setAttribute("value",issued_date);
inp6.style.backgroundColor = "#DDDDDD";

var img2 = document.createElement("img");
img2.setAttribute("src","images/bu-getdateicon.gif");
img2.setAttribute("alt","Get IssuedDate");
img2.onclick = function(){GetDate2(issued_date);};

cell6.appendChild(inp6);
cell6.appendChild(img2);

var cell7 = document.createElement("TD");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","10");
inp7.setAttribute("name",recd_by);
cell7.appendChild(inp7);

var cell8 = document.createElement("TD");
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","5");
inp8.setAttribute("name",sl_from);
cell8.appendChild(inp8);

var cell9 = document.createElement("TD");
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","5");
inp9.setAttribute("name",sl_to);
cell9.appendChild(inp9);

var cell10 = document.createElement("TD");
var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","5");
inp10.setAttribute("name",accepted);
cell10.appendChild(inp10);

var cell11 = document.createElement("TD");
var inp11 =  document.createElement("INPUT");
inp11.setAttribute("type","text");
inp11.setAttribute("size","5");
inp11.setAttribute("name",rejected);
cell11.appendChild(inp11);

var cell12 = document.createElement("TD");
var inp12 =  document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","5");
inp12.setAttribute("name",returned);
cell12.appendChild(inp12);

var cell13 = document.createElement("TD");
var inp13 =  document.createElement("INPUT");
inp13.setAttribute("type","text");
inp13.setAttribute("size","10");
inp13.setAttribute("name",notes);
cell13.appendChild(inp13);


var inp14 = document.createElement("INPUT");
inp14.setAttribute("type","hidden");
inp14.setAttribute("value","");
inp14.setAttribute("name",prevlinenum);
cell13.appendChild(inp14);


var inp15 = document.createElement("INPUT");
inp15.setAttribute("type","hidden");
inp15.setAttribute("value","");
inp15.setAttribute("name",lirecnum);
cell13.appendChild(inp15)


row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell8);
row.appendChild(cell9);
row.appendChild(cell10);
row.appendChild(cell11);
row.appendChild(cell12);
row.appendChild(cell13);
tbody.appendChild(row);

ind1++;
document.forms[0].indexmm.value=ind1;
document.forms[0].curindex.value=ind1;

}

function addRow4fid(id,ind1){
	// things to add
	ind1= parseInt(ind1);
	//ind1++;

    fidline_num = "fidline_num" + ind1; //text box
	qty_recd = "qty_recd" + ind1; //text box;
	qty_accp = "qty_accp" + ind1; //text box
	cim_num = "cim_num" + ind1; //text box
    cim_date="cim_date"+ind1;
    dc_qty = "dc_qty" + ind1;
	insp_report_num = "insp_report_num" + ind1;
	cust_information = "cust_information" + ind1;
	fidremarks = "fidremarks" + ind1;

	prevlinenum = "fidprevlinenum" + ind1;
	lirecnum = "fidlirecnum" + ind1;

	var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];

	var row = document.createElement("TR");
	row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");

var inp1 = document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","4");
inp1.setAttribute("name",fidline_num);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","10");
inp2.setAttribute("name",qty_recd);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","5");
inp3.setAttribute("name",qty_accp);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 = document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","10");
inp4.setAttribute("name",cim_num);
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","10");
inp5.setAttribute("readonly","readonly");
inp5.setAttribute("name",cim_date);
inp5.setAttribute("id",cim_date);
inp5.style.backgroundColor = "#DDDDDD";

var img1 = document.createElement("img");
img1.setAttribute("src","images/bu-getdateicon.gif");
img1.setAttribute("alt","Get BookDate");
img1.onclick = function(){GetDate(cim_date);};
cell5.appendChild(inp5);
cell5.appendChild(img1);

var cell6 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","5");
inp6.setAttribute("name",dc_qty);
cell6.appendChild(inp6);

var cell7 = document.createElement("TD");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","20");
inp7.setAttribute("name",insp_report_num);
cell7.appendChild(inp7);

var cell8 = document.createElement("TD");
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","20");
inp8.setAttribute("name",cust_information);
cell8.appendChild(inp8);

var cell9 = document.createElement("TD");
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","20");
inp9.setAttribute("name",fidremarks);
cell9.appendChild(inp9);

var inp10 = document.createElement("INPUT");
inp10.setAttribute("type","hidden");
inp10.setAttribute("value","");
inp10.setAttribute("name",prevlinenum);
cell9.appendChild(inp10);

var inp11 = document.createElement("INPUT");
inp11.setAttribute("type","hidden");
inp11.setAttribute("value","");
inp11.setAttribute("name",lirecnum);
cell9.appendChild(inp11)

row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell8);
row.appendChild(cell9);
tbody.appendChild(row);

ind1++;
document.forms[0].indexfid.value=ind1;
document.forms[0].curindex.value=ind1;

}


function addRow4dd(id,ind1){
	// things to add
	ind1= parseInt(ind1);
	//ind1++;

    line_num = "line_num" + ind1; //text box
	pur_ord_num = "pur_ord_num" + ind1; //text box;
	comp_ser_num = "comp_ser_num" + ind1; //text box
	batch_num = "batch_num" + ind1; //text box
    qty="qty"+ind1;
    gate_pass_num = "gate_pass_num" + ind1;
	gate_pass_date = "gate_pass_date" + ind1;
	dc_num = "dc_num" + ind1;
	dc_date = "dc_date" + ind1;
    inspn_report = "inspn_report"+ind1;
    insp_approval = "insp_approval" + ind1;
	qchead_approval = "qchead_approval" + ind1;

	prevlinenum = "ddprevlinenum" + ind1;
	lirecnum = "ddlirecnum" + ind1;

	var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];

	var row = document.createElement("TR");
	row.style.backgroundColor = "#FFFFFF";

var cell1 = document.createElement("TD");

var inp1 = document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","4");
inp1.setAttribute("name",line_num);
cell1.appendChild(inp1);

var cell2 = document.createElement("TD");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","10");
inp2.setAttribute("name",pur_ord_num);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
inp3.setAttribute("size","10");
inp3.setAttribute("name",comp_ser_num);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
var inp4 = document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","5");
inp4.setAttribute("name",batch_num);
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","5");
inp5.setAttribute("name",qty);

cell5.appendChild(inp5);

var cell6 = document.createElement("TD");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","6");
inp6.setAttribute("name",gate_pass_num);
cell6.appendChild(inp6);

var cell7 = document.createElement("TD");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","10");
inp7.setAttribute("readonly","readonly");
inp7.setAttribute("name",gate_pass_date);
inp7.setAttribute("id",gate_pass_date);
inp7.style.backgroundColor = "#DDDDDD";

var img1 = document.createElement("img");
img1.setAttribute("src","images/bu-getdateicon.gif");
img1.setAttribute("alt","Get BookDate");
img1.onclick = function(){GetDate1(gate_pass_date);};

cell7.appendChild(inp7);
cell7.appendChild(img1);

var cell8 = document.createElement("TD");
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","6");
inp8.setAttribute("name",dc_num);
cell8.appendChild(inp8);

var cell9 = document.createElement("TD");
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","10");
inp9.setAttribute("readonly","readonly");
inp9.setAttribute("name",dc_date);
inp9.setAttribute("id",dc_date);
inp9.style.backgroundColor = "#DDDDDD";

var img2 = document.createElement("img");
img2.setAttribute("src","images/bu-getdateicon.gif");
img2.setAttribute("alt","Get BookDate");
img2.onclick = function(){GetDate1(dc_date);};
cell9.appendChild(inp9);
cell9.appendChild(img2);

var cell10 = document.createElement("TD");
var inp10 =  document.createElement("INPUT");
inp10.setAttribute("type","text");
inp10.setAttribute("size","10");
inp10.setAttribute("name",inspn_report);
cell10.appendChild(inp10);

var cell11 = document.createElement("TD");
var inp11 =  document.createElement("INPUT");
inp11.setAttribute("type","text");
inp11.setAttribute("size","10");
inp11.setAttribute("name",insp_approval);
cell11.appendChild(inp11);

var cell12 = document.createElement("TD");
var inp12 =  document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","10");
inp12.setAttribute("name",qchead_approval);
cell12.appendChild(inp12);

var inp13 = document.createElement("INPUT");
inp13.setAttribute("type","hidden");
inp13.setAttribute("value","");
inp13.setAttribute("name",prevlinenum);
cell12.appendChild(inp13);

var inp14 = document.createElement("INPUT");
inp14.setAttribute("type","hidden");
inp14.setAttribute("value","");
inp14.setAttribute("name",lirecnum);
cell12.appendChild(inp14)

row.appendChild(cell1);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell8);
row.appendChild(cell9);
row.appendChild(cell10);
row.appendChild(cell11);
row.appendChild(cell12);
tbody.appendChild(row);

ind1++;
document.forms[0].indexdd.value=ind1;
document.forms[0].curindex.value=ind1;
}



function check_req_fields()
{

	// alert('test');
 	var errmsg='';             
	var lipresent=0;
 	var cancelledremarks='';
   // alert('before');
        var woindex =  document.getElementById('woclassif').selectedIndex;
        var str_poqty = document.getElementById('po_qty').value;
        var str_woqty = document.getElementById('qty').value;
        var approval_index = document.getElementById("approval_index").value;
         // alert(approval_index);
        var poqty = parseInt(str_poqty);
        var woqty = parseInt(str_woqty);
        
        var amendqty1 = document.forms[0].amendqty.value;
        var amend_qty = parseInt(amendqty1);

        if(document.getElementById("qty").value == 0)
        {
        	errmsg+='WO Qty Should Be Greater than Zero\n';
        }

         if (amendqty1 == 0 || amendqty1 == '' || amendqty1 == 'null')
         {
                 finalqty = woqty
         }
         else
        {
                 finalqty = amendqty1
         }

        //alert(numvalue1+"---"+numvalue2);
       //alert(document.forms[0].woclassif.value);

  	    if (document.forms[0].company.value == 'Please Specify' || document.forms[0].company.value == '')
	   {
		 errmsg+='Customer must be entered\n';
	   }
	   /*if (document.forms[0].wonum.value.length == 0)
	   {
		errmsg+='Work Order # must be entered\n';
       }*/
      if(document.forms[0].woclassif.value != 'TR' && document.forms[0].woclassif.value != 'TR Assembly')
     {
	   if (document.forms[0].ponum.value.length == 0)
	   {
		errmsg+='PO # must be entered\n';
	   }
	   if(document.getElementById('amendqty').value == 0 || document.getElementById('amendqty').value =='')
       {
	     if(poqty < woqty)
         {
           errmsg +='WO qty should be less than Cust PO qty.\n';
         }
       }
       else
        {
         if(poqty < amend_qty)
         {
           errmsg +='Amendment qty should be less than Cust PO qty.\n';
         }
       }
	 }
	 if((document.forms[0].woclassif.value == 'TR' || document.forms[0].woclassif.value == 'TR Assembly')&& document.forms[0].ponum.value.length != 0)
	 {
       errmsg+='PO # not required if Work Order Type is TR or TR Assembly\n';
	 }
	   if (document.forms[0].qty.value.length == 0)
	   {
		errmsg+='Qty must be entered\n';
	   }
         if (document.getElementById('grnnum').value.length == 0 && document.getElementById('grnnum_split').value.length == 0 )
           {
                 errmsg+='GRN Number must be present\n';
           }
           if (document.forms[0].contact.value.length == 0)
	   {
		 errmsg+='Contact must be present\n';
	   }
	   if (document.forms[0].contact.value == 'Please Specify')
	   {
		 errmsg+='Contact cannot be Please Specify\n';
	   }
	   if (document.forms[0].CIM_refnum.value.length == 0)
	   {
		 errmsg+='PRN in Master Details should be present\n';
	   }
	   if (document.forms[0].book_date.value.length == 0)
	   {
		 errmsg+='Work Order Date should be present\n';
	   }

	   //alert('before1');
       if(document.getElementById('woclassif').value == 'Rework' && document.getElementById('worefnum').value == '')
       {
       errmsg +='Enter Work Order Ref#.\n';
       }
	   if(((document.getElementById('woclassif').value == 'Split') ||(document.getElementById('woclassif').value == 'Split Assembly'))&& document.getElementById('worefnum').value == '')
       {
       errmsg +='Enter Work Order Ref#.\n';
       }

       if(document.getElementById('woclassif').value == 'Regular' && document.getElementById('worefnum').value != '')
       {   //alert(document.getElementById('amendqty').value);
         if(document.getElementById('amendqty').value == 0 || document.getElementById('amendqty').value == '')
         {
           errmsg +='Work Order Ref# not required.\n';
         }
       }
	   if (parseInt(document.forms[0].amendqty.value) > document.forms[0].qty.value)
	   {
		 errmsg+='Amendment Qty Should be less than Work Order QTY\n';
	   }

      if(((document.getElementById('woclassif').value == 'Split') ||(document.getElementById('woclassif').value == 'Split Assembly')) && document.getElementById('stage_split').value == '')
       {
       errmsg +='Please Enter WO Stage.\n';
       }
       if(((document.getElementById('woclassif').value == 'Split') ||(document.getElementById('woclassif').value == 'Split Assembly')) && document.getElementById('remarks').value == '')
       {
       errmsg +='Please Enter Remarks.\n';
       }

        if(document.getElementById('mps_num').value.length == 0 )
       {
       errmsg +='MPS number must be present.\n';
       }
       if (document.getElementById('mps_rev').value.length == 0)
           {
                 errmsg+='MPS Rev must be present\n';
           }

       if (document.getElementById('batchnum').value.length == 0 && document.getElementById('batchnum_split').value.length == 0)
           {
                 errmsg+='GRN Batch Number must be present\n';
           }
      if(document.forms[0].woclassif.value != 'Split'  && document.forms[0].woclassif.value != 'Split Assembly' && document.forms[0].stage_split.value.length != 0)
	   {
         errmsg+='Stage number not required\n';
	   }
	   if(document.getElementById('pagename').value == 'woEntry')
	   {
	       if (document.forms[0].sch_due_date.value.length == 0 || document.forms[0].sch_due_date.value == '0000-00-00')
	   {
		 errmsg+='Schedule Date should be present\n';
	   }
	   
	   }
	   // alert(document.getElementById('condition').value +"-------------------");
       if(document.getElementById('pagename').value == 'woEdit')
	   {	

	   // alert('test'); 
	   // alert(document.getElementById('pagename').value);
       if(document.getElementById('notes').value.length == 0 )
       {

     	   errmsg +='Please Enter Notes.\n';
       }  

	   if(document.getElementById('condition').value == 'Closed' && 
	(document.getElementById('act_ship_date').value == '0000-00-00' || 
	document.getElementById('act_ship_date').value == ''))
		{
           errmsg +='Please Enter the Date Code.\n';
		}



         if(document.getElementById('condition').value == 'Cancelled')
         {
           cancelledremarks = prompt ("Please enter reason for Cancellation of the WO\nComments entered here will be appended to remarks","")
           //alert("Hello there, " + reason) ;
           if(cancelledremarks)
           {
           if(document.getElementById('remarks').value == '')
           {
              document.getElementById('remarks').value = cancelledremarks ;
           }
           else
           {
             document.getElementById('remarks').value = document.getElementById('remarks').value + cancelledremarks ;
           }

           //alert(document.getElementById('remarks').value+"*-*-*-*-*-*-*");

           }
           else
           {
              errmsg+='Reason For Cancellation Not Entered\n';
           
           }

         }
 	   }

       //alert('before3');
      var final_flag=0;
      // ,dn_flag=0;
	  var sp_flag=0;
      var final_stage=0;

      var x=1;
      var max=document.forms[0].indexmm.value;
      var seq_num=new Array();
      var seqlist = {};
       sum=0;
	   spsum=0;seqnum=0;

// dnsum=0;
    // alert('before4 '+max);
    while (x < max)
    {

    	// alert("reached");
            ln ="mmline_num" + x;

            lnv = document.getElementById(ln).value;
            stagenum = "stage" + x;
            accpt= "accept"+ x;
            date="date"+x;
            rework="rework"+x;
            reject="reject"+x;
            returns="returns"+x;
            cofc_num="cofc_num"+x;
            supplier_wo="supplier_wo"+x;
            // dn="dn"+x;
            // dn_sent="dn_sent"+x;
            // dn_recv="dn_recv"+x;
            ncnum="ncnum"+x;
            hold="hold"+x;
//          if(document.getElementById('act_ship_date').value.length !=0 && document.getElementById('act_ship_date').value != '0000-00-00')
//          {
           if((document.getElementById(stagenum).value == "fi"||document.getElementById(stagenum).value ==  "final"||document.getElementById(stagenum).value == "FINAL"||document.getElementById(stagenum).value == "FI"||document.getElementById(stagenum).value == "Final"||document.getElementById(stagenum).value == "Fi"))
           {
            final_stage++;
            // dn_flag=0;
            //alert(final_stage);
            if(final_stage == 1 )
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
           //  if(document.getElementById(dn_sent).value.length !=0)
           // {
           //  dnsent=document.getElementById(dn_sent).value;
           // }
           // else
           // {
           //  dnsent=0;
           // }
            if(document.getElementById(hold).value.length !=0)
           {
            hold_qty=document.getElementById(hold).value;
           }
           else
           {
            hold_qty=0;
           }
            sum += parseInt(acc)+ parseInt(rej)+ parseInt(rew)+ parseInt(ret)+ parseInt(hold_qty);
            //alert(sum);
          }
          else
          {
            errmsg += 'There Is More Than One Final Stage.Please Correct And Proceed\n';

          }
          }
          // if((document.getElementById(stagenum).value == "dn"||document.getElementById(stagenum).value ==  "DN"||document.getElementById(stagenum).value == "Dn"||document.getElementById(stagenum).value == "dN")
          // &&(document.getElementById(stagenum).value != "fi"&&document.getElementById(stagenum).value !=  "final"&&document.getElementById(stagenum).value != "FINAL"&&document.getElementById(stagenum).value != "FI"&&document.getElementById(stagenum).value != "Final"&&document.getElementById(stagenum).value != "Fi"))
          // {
          //   dn_flag=1;
          //   if(document.getElementById(accpt).value.length !=0)
          //   {
          //     acc= document.getElementById(accpt).value;
          //   }
          //   else
          //   {
          //     acc=0;
          //   }
          //   if(document.getElementById(reject).value.length !=0)
          //  {
          //   rej=document.getElementById(reject).value;
          //  }
          //  else
          //  {
          //   rej=0;
          //  }
          //   if(document.getElementById(rework).value.length !=0)
          //  {
          //   rew=document.getElementById(rework).value;
          //  }
          //  else
          //  {
          //   rew=0;
          //  }
          //   if(document.getElementById(returns).value.length !=0)
          //  {
          //   ret=document.getElementById(returns).value;
          //  }
          //  else
          //  {
          //   ret=0;
          //  }
          //   if(document.getElementById(dn_sent).value.length !=0)
          //  {
          //   dnsent=document.getElementById(dn_sent).value;
          //  }
          //  else
          //  {
          //   dnsent=0;
          //  }
          //   if(document.getElementById(hold).value.length !=0)
          //  {
          //   hold_qty=document.getElementById(hold).value;
          //  }
          //  else
          //  {
          //   hold_qty=0;
          //  }
          //   dnsum += parseInt(acc)+ parseInt(rej)+ parseInt(rew)+ parseInt(ret)+ parseInt(hold_qty);
          //  //alert(dnsum);
          // }
//         }

		 // Check if the stage is SP
           if((document.getElementById(stagenum).value == "SP" || document.getElementById(stagenum).value ==  "sp"))
           {
             sp_flag = 1;
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

            spsum += parseInt(acc)+ parseInt(rej)+ parseInt(rew)+ parseInt(ret);
          }

		 // End SP stage check


       if ((document.getElementById(ln).value.length ==0)&& (document.getElementById(stagenum).value =="")&&(document.getElementById(accpt).value ==""))
        {
          if(lnv+x ==0)
          {
          break;
          }
        }

        else if ((seqlist[lnv] != undefined )&&(document.getElementById(stagenum).value != "PostDN"))
        {
            errmsg +='Duplicate Seq # '+ lnv + '\n';

        }
        else
        {
           seqlist[lnv] = lnv;
            if  ((document.getElementById(stagenum).value ==""))
             {
                errmsg += 'Please enter stage for Seq # '  + lnv + '\n';
             }
              if (document.getElementById(accpt).value =="")
             {
             errmsg += 'Please enter accept quantity for Seq # '  + lnv + '\n';
             }
                if (document.getElementById(accpt).value !="")
             {
                   if ((document.getElementById(ln).value.length ==0 ) &&(document.getElementById(stagenum).value != "PostDN"))
                      {
                          errmsg += 'Please enter Seq # \n';
                      }
            }
            if (((document.getElementById(date).value =="")||(document.getElementById(date).value =="0000-00-00"))&&(document.getElementById(stagenum).value != "PostDN"))
           {
              errmsg += 'Please enter valid date for Seq #'+ lnv + '\n';
           }

            if( (document.getElementById(stagenum).value.length !=0 ))
            {
               //alert('inside stagenum');
               inspno="inspno"+x;
               signoff="signoff"+x;

                 if((document.getElementById(stagenum).value == "fi"||document.getElementById(stagenum).value == "Fi"||document.getElementById(stagenum).value ==  "final"||document.getElementById(stagenum).value == "FINAL"||document.getElementById(stagenum).value == "FI"||document.getElementById(stagenum).value == "Final") && ((document.getElementById(inspno).value=="") && (document.getElementById(signoff).value=="")))
                   {

                       errmsg += 'Please enter Insp no. or '+'\n'+' Signoff for Seq # ' + lnv + '\n';
                   }
                 if((document.getElementById(stagenum).value == "SP"||document.getElementById(stagenum).value == "sp"||document.getElementById(stagenum).value ==  "Sp"||document.getElementById(stagenum).value == "sP") && ((document.getElementById(inspno).value=="") && (document.getElementById(signoff).value=="")))
                   {

                       errmsg += 'Please enter Insp no. or '+'\n'+' Signoff for Seq # ' + lnv + '\n';
                   }

                   if ((document.getElementById(ln).value.length ==0 )&&(document.getElementById(stagenum).value != "PostDN"))
                       {
                          errmsg += 'Please enter Seq # \n';
                       }
           }
           //alert(document.getElementById(reject).value+"al1") ;
            if ((document.getElementById(reject).value !=" " && document.getElementById(reject).value !=0 )&& document.getElementById(ncnum).value =="")
             {
             errmsg += 'Please enter NC for Seq #'+ lnv + '\n';
             }
             // alert(document.forms[0].woclassif.value+"===---===");

             // if ((document.getElementById(stagenum).value == "dn"||document.getElementById(stagenum).value ==  "DN"||document.getElementById(stagenum).value == "Dn"||document.getElementById(stagenum).value == "dN")&&(document.getElementById('treatment').value!='With Treatment'))
             // {
             //     errmsg += 'DN cannot be entered for Manufacture Only WO \n';
             // }
              /* if ((document.getElementById(stagenum).value == "dn"||document.getElementById(stagenum).value ==  "DN"||document.getElementById(stagenum).value == "Dn"||document.getElementById(stagenum).value == "dN")&&(document.forms[0].woclassif.value == 'TR'))
             {
                 errmsg += 'DN cannot be entered for TR type WO \n';
             } */
            // return false;
             if((document.getElementById(stagenum).value == "fi"||document.getElementById(stagenum).value ==  "final"||document.getElementById(stagenum).value == "FINAL"||document.getElementById(stagenum).value == "FI"||document.getElementById(stagenum).value == "Final"||document.getElementById(stagenum).value == "Fi")&&(document.forms[0].woclassif.value == 'TR'))
             {     //alert("HRRE--");
                 errmsg += 'Final Stage Cannot be entered for TR type WO \n';
             }
            // return false;
/*
             if(document.forms[0].woclassif.value == 'Split' && (document.getElementById(stagenum).value == "dn"||document.getElementById(stagenum).value ==  "DN"||document.getElementById(stagenum).value == "Dn"||document.getElementById(stagenum).value == "dN"))
             {
                errmsg += 'Cannot Split This WO \n';
             }
*/
if(document.getElementById('pagename').value == 'woEdit')
	   {
           //alert(lipresent);
        if(document.getElementById('condition').value == 'Cancelled' && ((document.getElementById(rework).value.length !=0 && document.getElementById(accpt).value.length !=0 && document.getElementById(reject).value.length !=0 )&& (document.getElementById(returns).value.length !=0)))
         {
            errmsg +="Only Return Qty has to be entered\n";
         }
        if(document.getElementById('condition').value == 'Cancelled' && document.getElementById(returns).value.length ==0 )

         {
            errmsg +="Return Qty has to be entered\n";
         }
      }
            lipresent=1;
         }
          var datec_flag =0;
          for(z=1;z<approval_index;z++)
            {
              seqnum="seqnum"+z;
              datec="datec"+z;
              
        if(((document.getElementById(stagenum).value == "fi"||document.getElementById(stagenum).value ==  "final"||document.getElementById(stagenum).value == "FINAL"||
        	document.getElementById(stagenum).value == "FI"||document.getElementById(stagenum).value == "Final"||document.getElementById(stagenum).value == "Fi"))
             && ((document.getElementById(datec).value=='0000-00-00'|| document.getElementById(datec).value=='')))
             {

             	 datec_flag=1;
                 //alert("HERE+++++");
                 // errmsg += 'Milestone  '+'\n has to be approved before Final stage\n';

             }
             else if(((document.getElementById(stagenum).value == "fi"||document.getElementById(stagenum).value ==  "final"||document.getElementById(stagenum).value == "FINAL"||document.getElementById(stagenum).value == "FI"||document.getElementById(stagenum).value == "Final"||document.getElementById(stagenum).value == "Fi"))
             && ((document.getElementById(seqnum).value=="FI_Completed") && (document.getElementById(datec).value=='0000-00-00'|| document.getElementById(datec).value=='')))
             {
                 errmsg += 'Milestone "FI_Completed" '+'\n has to be approved before Final stage\n';

             }

            }

              if(datec_flag == 1)
             {
                 //alert("HERE+++++");
                errmsg += 'Milestone has to be approved before Final stage\n';

             }
             x++;

        }
     //alert(spsum);
    // alert(woqty);
    if(document.getElementById('pagename').value == 'woEdit')
	   {
           //alert(lipresent);
        if(document.getElementById('condition').value == 'Cancelled' && lipresent==0 )
         {
            errmsg +="Atleast one line item with only ret qty must be present\n";
         }
      }
    if(document.getElementById('act_ship_date').value.length !=0 && document.getElementById('act_ship_date').value != '0000-00-00')
    {
     if(final_flag == 0)
     {
       errmsg += 'Stage should be Fi before closing WO';
     }
    }
    if(final_flag == 1)
    {
      if(sum != finalqty)
      {
        errmsg += 'Total of Accept,Rework,Reject,Ret,Hold'+'\n'+'should equal to Qty/AmendQty\n';
      }

    }
    //    if(dn_flag == 1)
    // { // alert(finalqty+"D---------N-----"+dnsum);
    //   if(dnsum > finalqty)
    //   {
    //     errmsg += 'Total of Accept,Rework,Reject,Ret,Hold'+'\n'+'should equal to Qty/AmendQty \n';
    //   }

    // }

    if(sp_flag == 1)
    {
 	  if(finalqty < spsum)
      {
        errmsg += 'Total of Accept,Rework,Reject,Ret,Hold for SP stage '+'\n'+'should be <= Qty/AmendQty\n';
      }
    }
     //alert('before5');
    //alert('functiom working');

    var i=1;
	var flag=0;
	var frm=document.forms[0];
	var max=document.forms[0].max.value;
	for(var i=0;i<frm.length;i++)
	{
		for(var j=1;j<max;j++)
		{
			number="number"+j;
			var k=i;
			if(frm.elements[i].name==number  && frm.elements[i].value.length != '')
			{
			          var valid="0,1,2,3,4,5,6,7,8,9";
			          var ok="yes";
			          var temp;
		   	          for (var k=0;k < frm.elements[i].value.length;k++)
		                          {
				temp= "" + frm.elements[i].value.substring(k,k+1);
				if(valid.indexOf(temp)== "-1")
				ok="no";
			           }
		                           if(ok=="no")
	  	                          {
				errmsg +="Enter Numeric Values instead of  " + frm.elements[i].value + " \n";
				flag=1;
				break;
		 	           }
			}
			floatval="floatval"+j;
			var k=i;
			if(frm.elements[i].name==floatval  && frm.elements[i].value.length != '')
			{
			          var valid="0,1,2,3,4,5,6,7,8,9,.";
			          var ok="yes";
			          var temp;
		   	          for (var k=0;k < frm.elements[i].value.length;k++)
		                          {
				temp= "" + frm.elements[i].value.substring(k,k+1);
				if(valid.indexOf(temp)== "-1")
				ok="no";
			           }
		                           if(ok=="no")
	  	                          {
				errmsg +="Enter Decimal Values  instead of  " + frm.elements[i].value + " \n";
				flag=1;
				break;
		 	           }
			}
			qty="qty"+j;
			var k=i;
			if(frm.elements[i].name==qty  && frm.elements[i].value.length != '')
			{

			          var valid="0,1,2,3,4,5,6,7,8,9";
			          var ok="yes";
			          var temp;
		   	          for (var k=0;k < frm.elements[i].value.length;k++)
		                          {
				temp= "" + frm.elements[i].value.substring(k,k+1);
				if(valid.indexOf(temp)== "-1")
				ok="no";
			           }
		                           if(ok=="no")
                              {
				errmsg +="Enter numeric value  instead of  " + frm.elements[i].value + " \n";
				flag=1;
				break;
		 	           }
			}
  	var partqty="partqty"+j;
  	if(frm.elements[i].name==partqty  && frm.elements[i].value.length != '')
			{
     if(frm.elements[i+1].value.length == '')
			         {
				errmsg +="You should enter qty for this Part#\n";
			         }


			}

		}
		if (flag==1)
		break;
	}
 	var max=document.forms[0].max.value;

if (document.forms[0].hidpname.value=='WoEntry'){
	flag=0;
	for(var j=1;j<max;j++)
	{
          k=j;
	          datec="dates" + j;
	if (flag == 1 && document.forms[0].elements[datec].value!='')
	{
		   errmsg+="Previous milestone is not completed\n";

	}

	if (document.forms[0].elements[datec].value=='')
	  {
	   flag=1;
	  }
    }

}

if (document.forms[0].hidpname.value=='WodetailsEdit'){

	flag=0;
	for(var j=1;j<max;j++)
	{
	          k=j;
	          datec="datec" + j;
	if (flag == 1 && document.forms[0].elements[datec].value!='')
	{
		   errmsg+="Previous milestone is not completed\n";

	}

	if (document.forms[0].elements[datec].value=='')
 	 {
	   flag=1;
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


