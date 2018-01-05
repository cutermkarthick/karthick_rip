/*
 * po.js
 * validation for POs
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
 */
 
function searchsort_fields()
{

    var s1ind = document.forms[0].sort1.selectedIndex;

    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}

function check_req_fields1()
{
	
	//return false;
    var lipresent = 0;
    var errmsg = '';
    var x = 1;
    var dept=  document.getElementById("deptname").value;
    var noedit= document.getElementById("noedit").value;
          //alert("+++"+noedit);
          //alert("___"+dept);
    if (document.forms[0].ponum.value.length == 0)
    {
         errmsg += 'Please enter PO #\n';
    }

    if (document.forms[0].desc.value.length == 0)
    {
         errmsg += 'Please enter PO description\n';
    }
    if (document.forms[0].podate.value.length == 0)
    {
         errmsg += 'Please enter PO Date\n';
    }

    if (document.forms[0].vendor.value.length == 0)
    {
         errmsg += 'Please enter Supplier Name\n';
    }
    if (document.forms[0].amendment_num.value.length != 0 && (document.forms[0].amendmentdate.value.length == 0 ||document.forms[0].amendmentdate.value == '0000-00-00' ))
    {
         errmsg += 'Please enter Amendment Date\n';
    }
     if (document.forms[0].amendment_num.value.length != 0 && document.forms[0].amendment_notes.value.length == 0 )
    {
         errmsg += 'Please enter Notes For Amendment \n';
    }

    if((dept =='Purchasing' || dept =='Sales') && noedit =="" ){
    if (document.getElementById("approval").value == "yes" 
		   && document.getElementById("status").value!= "Open" 
		   && document.getElementById("status").value!= "Closed")
    {
         errmsg += 'Please Change Status to Open\n';
    }


    if (document.getElementById("approval").value != "yes" && document.getElementById("status").value == "Open" )
    {
         errmsg += 'Status Cannot be Open\n';
    }
    }
    //alert(document.forms[0].communication.length);
    for (j=0;j<document.forms[0].communication.length;j++){
         //alert(document.forms[0].communication[j].value);
         if (document.forms[0].communication[j].checked==true){
              document.getElementById('comm').value = document.forms[0].communication[j].value;
              
           break //exist for loop, as target acquired.
          }
    }
    acc_flag=0; var stat_flag=0;  var stat_closeflag=0;   var close_flag=0;
     while (x <= 30)
     {

       ln = "line_num" + x;
       lnv = document.getElementById(ln).value;
       if (document.getElementById(ln).value.length != 0)
       {
          
           mr = "material_ref" + x;
           if (document.getElementById(mr).value.length == 0)
           {
               errmsg += 'Please enter Material Ref for line item ' + lnv + '\n';
           }
	       ms = "material_spec" + x;
           if (document.getElementById(ms).value.length == 0)
           {
               errmsg += 'Please enter Material Spec for line item ' + lnv + '\n';
           }
	       uom = "uom" + x;
	      if (document.getElementById(uom).value.length == 0 && document.getElementById("potype").value != "Bought Out")
           {
               errmsg += 'Please enter UOM for line item ' + lnv + '\n';
           }

            width = "width" + x;
            len = "len" + x;
            thick = "thick" + x;
            dia = "dia" + x;
            accepted_date=  "accepted_date" + x;
            orderQty="order_qty"+x;
            qty_recd="qty_recd"+x;
            li_status="li_status"+x;
            no_of_meterages="no_of_meterages"+x;
            no_of_lengths="no_of_lengths"+x;
           // alert((document.getElementById(no_of_meterages).value)+"----"+document.getElementById(li_status).value);
            //if((document.getElementById(orderQty).value.length) !=0 && (document.getElementById(qty_recd).value.length)!=0)
            //{
         if(document.getElementById("page").value!='new')
     {
        /*
          if(document.getElementById(no_of_meterages).value==0 && document.getElementById("page").value!='new')
          {  // alert("HERE--***----"+document.getElementById(no_of_lengths).value+"---**----"+(document.getElementById(qty_recd).value));
             if((parseInt(document.getElementById(no_of_lengths).value) != parseInt(document.getElementById(qty_recd).value))&& document.getElementById(li_status).value !='Amend Close')
            { // alert("454545");
              stat_flag=1;
            }
          }
          else
          {
             if((parseInt(document.getElementById(no_of_meterages).value) != parseInt(document.getElementById(qty_recd).value))&& document.getElementById(li_status).value !='Amend Close')
            {
              stat_flag=1;
            }

          }

     */

     /*


            if((parseInt(document.getElementById(orderQty).value) == parseInt(document.getElementById(qty_recd).value))&& document.getElementById(li_status).value !='Close')
            {
              stat_closeflag=1;
            }
            //}
            //alert(stat_flag);
           // alert(document.getElementById(accepted_date).value.length+"----");
            if (document.getElementById(li_status).value =='Close' &&
	       (document.getElementById(accepted_date).value=="0000-00-00" || 
		document.getElementById(accepted_date).value==""))
            {
                acc_flag=1;
            }
             if (document.getElementById(li_status).value=="Open" || document.getElementById(li_status).value=="")
            {
                close_flag=1;
            }
            if (document.getElementById("status").value == 'Closed' && stat_flag== 1)
           {
            errmsg += 'Cannot close the PO, Line item ' + lnv + ' Status is incorrect\n';
           // return false;

           }
             if (document.getElementById("status").value == 'Closed' && stat_closeflag== 1)
           {
            errmsg += 'Cannot close the PO, Line item ' + lnv + ' Status is incorrect\n';
           // return false;

           }
         if (document.getElementById("status").value == 'Closed' && acc_flag== 1)
           {
            errmsg += 'Cannot close the PO line item ' + lnv + ' not  accepted\n';
           // return false;
           
           }
           //alert(close_flag);
       */
      }

	   if (document.getElementById(width).value != '' && document.getElementById(len).value != '')
           {
               if(document.getElementById(thick).value == '')
               {
                 //errmsg += 'Please enter Thickness for line item ' + lnv + '\n';
               }
                if(document.getElementById(dia).value != '')
               {
                 //errmsg += 'Dia not required for line item ' + lnv + '\n';
               }
           }
       if (document.getElementById(width).value == '' || document.getElementById(len).value == '')
           {
               if (document.getElementById(dia).value == '' )
               {
                  //errmsg += 'Please enter Dia for line item ' + lnv + '\n';
               }
/*               if (document.getElementById(dia).value != '' &&  document.getElementById(thick).value != '')
               {
                  errmsg += 'Thickness not required for line item ' + lnv + '\n';
               }
*/
           }

/*	   thick = "thick" + x;
	   if (document.getElementById(thick).value.length == 0)
           {
               errmsg += 'Please enter Thickness(or Dia) for line item ' + lnv + '\n';
           }
	   width = "width" + x;
	   if (document.getElementById(width).value.length == 0)
           {
               errmsg += 'Please enter Length for line item ' + lnv + '\n';
           }

*/
	   grainflow = "grainflow" + x;
	   if (document.getElementById(grainflow).value.length == 0)
           {
               //errmsg += 'Please enter Grainflow for line item ' + lnv + '\n';
           }

	   no_of_meterages = "no_of_meterages" + x;
	   no_of_lengths = "no_of_lengths" + x;
	   //alert(document.getElementById(no_of_meterages).value+"test-----"+document.getElementById(no_of_lengths).value);
	  /* if (document.getElementById(no_of_meterages).value.length == 0)
           {
               //errmsg += 'No.of Meterages should be 0 or a valid number for line item' + lnv + '\n';
           }
	   if (document.getElementById(no_of_lengths).value.length == 0)
           {
               //errmsg += 'No.of Lengths should be 0 or a valid number for line item' + lnv + '\n';
           } */
       qty_rej = "qty_rej" + x;
       qty_rejected = parseInt((document.getElementById(qty_rej).value));
       qty_ordered = (parseInt(document.getElementById(no_of_meterages).value) + parseInt(document.getElementById(no_of_lengths).value))
      // alert(document.getElementById(no_of_lengths).value+"----------5896666");
       if(qty_rejected > qty_ordered)
       {
          errmsg += 'Qty Rej should be less than or equal to No of Meter Req or No of Length Req for line item ' + lnv + '\n';
       }
	   if (document.getElementById(no_of_meterages).value == '0' &&
               document.getElementById(no_of_lengths).value == '0')
           {
               //errmsg += 'Please enter No.of Meterages or No. of Lengths for line item ' + lnv + '\n';
           }
	   if ((document.getElementById(no_of_meterages).value != '0' &&
                document.getElementById(no_of_meterages).value != '')
              && (document.getElementById(no_of_lengths).value != '0' &&
                  document.getElementById(no_of_lengths).value != ''))
           {
               //errmsg += 'Both No. of Meterages and No. of Lengths cannot be present for line item' + lnv + '\n';
           }
         //alert(document.getElementById(no_of_meterages).value+"++++++++");
	   if (document.getElementById(no_of_meterages).value == '0.00'|| document.getElementById(no_of_meterages).value == '0')
           {
               document.getElementById(no_of_meterages).value = '0.00';
           }
           else
           {
               document.getElementById(no_of_lengths).value = '0.00';
           }
         dt = "delivery_time" + x;
         delivery = "delivery" + x;   
         elem=eval('document.forms[0].delivery_time'+x);
         for (j=0;j<elem.length;j++){
         if (elem[j].checked==true){
          
              document.getElementById(delivery).value = elem[j].value;
           break //exist for loop, as target acquired.
          }
         }

            lipresent = 1;
       }
     
       x++;
     }
     if(document.getElementById("page").value!='new')
     {
    if (document.getElementById("status").value == 'Closed' && close_flag== 1)
    {
            errmsg += 'Cannot close the PO line items are not closed \n';
           // return false;

    }
    }
    if (lipresent == 0)
    {
         errmsg += 'At least one line item must be present\n';
    }

     if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}


function GetDueDate(rt) 
{
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
//alert('hi1');
win1 = window.open("getcalendar.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetDate(dateval,fieldname) 
{
var text= document.getElementById(fieldname);
text.value=dateval;
}

function SetPODate(duedate) {
document.forms[0].podate.value = duedate;
}
function SetPODueDate1(duedate) {
document.forms[0].due_date1.value = duedate;
}
function SetPODueDate2(duedate) {
document.forms[0].due_date2.value = duedate;
}
function SetPODueDate3(duedate) {
document.forms[0].due_date3.value = duedate;
}
function SetPODueDate4(duedate) {
document.forms[0].due_date4.value = duedate;
}
function SetPODueDate5(duedate) {
document.forms[0].due_date5.value = duedate;
}
function SetPODueDate6(duedate) {
document.forms[0].due_date6.value = duedate;
}
function SetPODueDate7(duedate) {
document.forms[0].due_date7.value = duedate;
}
function SetPODueDate8(duedate) {
document.forms[0].due_date8.value = duedate;
}
function SetPODueDate9(duedate) {
document.forms[0].due_date9.value = duedate;
}
function SetPODueDate10(duedate) {
document.forms[0].due_date10.value = duedate;
}
function SetPODueDate11(duedate) {
document.forms[0].due_date11.value = duedate;
}
function SetPODueDate12(duedate) {
document.forms[0].due_date12.value = duedate;
}
function SetPODueDate13(duedate) {
document.forms[0].due_date13.value = duedate;
}
function SetPODueDate14(duedate) {
document.forms[0].due_date14.value = duedate;
}
function SetPODueDate15(duedate) {
document.forms[0].due_date15.value = duedate;
}
function SetPODueDate16(duedate) {
document.forms[0].due_date16.value = duedate;
}
function SetPODueDate17(duedate) {
document.forms[0].due_date17.value = duedate;
}
function SetPODueDate18(duedate) {
document.forms[0].due_date18.value = duedate;
}
function SetPODueDate19(duedate) {
document.forms[0].due_date19.value = duedate;
}
function SetPODueDate20(duedate) {
document.forms[0].due_date20.value = duedate;
}
function SetPODueDate21(duedate) {
document.forms[0].due_date21.value = duedate;
}
function SetPODueDate22(duedate) {
document.forms[0].due_date22.value = duedate;
}
function SetPODueDate23(duedate) {
document.forms[0].due_date23.value = duedate;
}
function SetPODueDate24(duedate) {
document.forms[0].due_date24.value = duedate;
}
function SetPODueDate25(duedate) {
document.forms[0].due_date25.value = duedate;
}
function SetPODueDate26(duedate) {
document.forms[0].due_date26.value = duedate;
}
function SetPODueDate27(duedate) {
document.forms[0].due_date27.value = duedate;
}
function SetPODueDate28(duedate) {
document.forms[0].due_date28.value = duedate;
}
function SetPODueDate29(duedate) {
document.forms[0].due_date29.value = duedate;
}
function SetPODueDate30(duedate) {
document.forms[0].due_date30.value = duedate;
}



function GetPODate(rt)
{
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("allcalendar.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function GetAllVendors(rt)
{
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getallvendors.php?reasontext=" + rt, "Vendors", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft+",dependent=yes");
}

function SetVendor(vendor,vendrecnum)
{
//alert(vendrecnum+"hhhhhhhhhhh");
document.forms[0].vendor.value = vendor;
document.forms[0].vendrecnum.value = vendrecnum;
}

function GetHost(rt) 
{
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("gethosts.php?reasontext=" + rt, "Vendors", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft+",dependent=yes");
}

function SetHost(host,hostrecnum)
{
document.forms[0].host.value = host;
document.forms[0].hostrecnum.value = hostrecnum;
}

function onSelectStatus()
{

   var aind = document.forms[0].postat.selectedIndex;
   if (aind == 0)
   {
      alert ("Please select a valid Status");
      return false;
   }
   document.forms[0].status.value = document.forms[0].postat[aind].text;
   document.forms[0].activeval.value = document.forms[0].postat[aind].text;

}

function onSelectCurr()
{

   var aind = document.forms[0].pocurr.selectedIndex;
   if (aind == 0)
   {
      alert ("Please select a valid Currency");
      return false;
   }
   document.forms[0].currency.value = document.forms[0].pocurr[aind].text;
   
}

function putfocus()
{
   //alert("Are You Sure You Want To Reset ?");
   document.forms[0].ponum.focus();
}

function allowReset()
{
    return window.confirm("Are You Sure You Want To Reset the form?");
}

function ConfirmDelete() 
{
   document.forms[0].deleteflag.value = "y";
   return true;
}

function printPO(ponum)
{
var winWidth = 1000;
var winHeight = 900;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printPO.php?ponum=" + ponum, "PrintPO", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function printPO4view(ponum)
{
var winWidth = 1000;
var winHeight = 900;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printPO4view.php?ponum=" + ponum, "PrintPO", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function GetRM(rt)
{
//alert(rt);
var param = rt;
var winWidth = 600;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getRM.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetRMcode(CIM,CIMarr,rownum)
{
//alert("Hi");
var CIM = CIM.split("|");
//document.forms[0].elements[fieldname].value = CIM[0];
var CIMdet = CIMarr.split("|");
//document.forms[0].link2rmmaster.value = CIMdet[0];
if (rownum == 1)
{
	  document.forms[0].rmcode1.value = CIMdet[1];
	  document.forms[0].material_ref1.value = CIMdet[2];
	  document.forms[0].material_spec1.value = CIMdet[3];
	  document.forms[0].thick1.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width1.value = CIMdet[4];
	  document.forms[0].length1.value = CIMdet[5]; 
}
if (rownum == 2)
{
	  document.forms[0].rmcode2.value = CIMdet[1];
	  document.forms[0].material_ref2.value = CIMdet[2];
	  document.forms[0].material_spec2.value = CIMdet[3];
	  document.forms[0].thick2.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width2.value = CIMdet[4];
	  document.forms[0].length2.value = CIMdet[5]; 
}
if (rownum == 3)
{
	  document.forms[0].rmcode3.value = CIMdet[1];
	  document.forms[0].material_ref3.value = CIMdet[2];
	  document.forms[0].material_spec3.value = CIMdet[3];
	  document.forms[0].thick3.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width3.value = CIMdet[4];
	  document.forms[0].length3.value = CIMdet[5]; 
}
if (rownum == 4)
{
	  document.forms[0].rmcode4.value = CIMdet[1];
	  document.forms[0].material_ref4.value = CIMdet[2];
	  document.forms[0].material_spec4.value = CIMdet[3];
	  document.forms[0].thick4.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width4.value = CIMdet[4];
	  document.forms[0].length4.value = CIMdet[5]; 
}
if (rownum == 5)
{
	  document.forms[0].rmcode5.value = CIMdet[1];
	  document.forms[0].material_ref5.value = CIMdet[2];
	  document.forms[0].material_spec5.value = CIMdet[3];
	  document.forms[0].thick5.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width5.value = CIMdet[4];
	  document.forms[0].length5.value = CIMdet[5]; 
}
if (rownum == 6)
{
	  document.forms[0].rmcode6.value = CIMdet[1];
	  document.forms[0].material_ref6.value = CIMdet[2];
	  document.forms[0].material_spec6.value = CIMdet[3];
	  document.forms[0].thick6.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width6.value = CIMdet[4];
	  document.forms[0].length6.value = CIMdet[5]; 
}
if (rownum == 7)
{
	  document.forms[0].rmcode7.value = CIMdet[1];
	  document.forms[0].material_ref7.value = CIMdet[2];
	  document.forms[0].material_spec7.value = CIMdet[3];
	  document.forms[0].thick7.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width7.value = CIMdet[4];
	  document.forms[0].length7.value = CIMdet[5]; 
}
if (rownum == 8)
{
	  document.forms[0].rmcode8.value = CIMdet[1];
	  document.forms[0].material_ref8.value = CIMdet[2];
	  document.forms[0].material_spec8.value = CIMdet[3];
	  document.forms[0].thick8.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width8.value = CIMdet[4];
	  document.forms[0].length8.value = CIMdet[5]; 
}
if (rownum == 9)
{
	  document.forms[0].rmcode9.value = CIMdet[1];
	  document.forms[0].material_ref9.value = CIMdet[2];
	  document.forms[0].material_spec9.value = CIMdet[3];
	  document.forms[0].thick9.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width9.value = CIMdet[4];
	  document.forms[0].length9.value = CIMdet[5]; 
}
if (rownum == 10)
{
	  document.forms[0].rmcode10.value = CIMdet[1];
	  document.forms[0].material_ref10.value = CIMdet[2];
	  document.forms[0].material_spec10.value = CIMdet[3];
	  document.forms[0].thick10.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width10.value = CIMdet[4];
	  document.forms[0].length10.value = CIMdet[5]; 
}
if (rownum == 11)
{
	  document.forms[0].rmcode11.value = CIMdet[1];
	  document.forms[0].material_ref11.value = CIMdet[2];
	  document.forms[0].material_spec11.value = CIMdet[3];
	  document.forms[0].thick11.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width11.value = CIMdet[4];
	  document.forms[0].length11.value = CIMdet[5]; 
}
if (rownum == 12)
{
	  document.forms[0].rmcode12.value = CIMdet[1];
	  document.forms[0].material_ref12.value = CIMdet[2];
	  document.forms[0].material_spec12.value = CIMdet[3];
	  document.forms[0].thick12.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width12.value = CIMdet[4];
	  document.forms[0].length12.value = CIMdet[5]; 
}
if (rownum == 13)
{
	  document.forms[0].rmcode13.value = CIMdet[1];
	  document.forms[0].material_ref13.value = CIMdet[2];
	  document.forms[0].material_spec13.value = CIMdet[3];
	  document.forms[0].thick13.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width13.value = CIMdet[4];
	  document.forms[0].length13.value = CIMdet[5]; 
}
if (rownum == 14)
{
	  document.forms[0].rmcode14.value = CIMdet[1];
	  document.forms[0].material_ref14.value = CIMdet[2];
	  document.forms[0].material_spec14.value = CIMdet[3];
	  document.forms[0].thick14.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width14.value = CIMdet[4];
	  document.forms[0].length14.value = CIMdet[5]; 
}

if (rownum == 15)
{
	  document.forms[0].rmcode15.value = CIMdet[1];	
	  document.forms[0].material_ref15.value = CIMdet[2];
	  document.forms[0].material_spec15.value = CIMdet[3];
	  document.forms[0].thick15.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width15.value = CIMdet[4];
	  document.forms[0].length15.value = CIMdet[5]; 
}
if (rownum == 16)
{
	  document.forms[0].rmcode16.value = CIMdet[1];	
	  document.forms[0].material_ref16.value = CIMdet[2];
	  document.forms[0].material_spec16.value = CIMdet[3];
	  document.forms[0].thick16.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width16.value = CIMdet[4];
	  document.forms[0].length16.value = CIMdet[5]; 
}
if (rownum == 17)
{
	  document.forms[0].rmcode17.value = CIMdet[1];	
	  document.forms[0].material_ref17.value = CIMdet[2];
	  document.forms[0].material_spec17.value = CIMdet[3];
	  document.forms[0].thick17.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width17.value = CIMdet[4];
	  document.forms[0].length17.value = CIMdet[5]; 
}
if (rownum == 18)
{
	  document.forms[0].rmcode18.value = CIMdet[1];	
	  document.forms[0].material_ref18.value = CIMdet[2];
	  document.forms[0].material_spec18.value = CIMdet[3];
	  document.forms[0].thick18.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width18.value = CIMdet[4];
	  document.forms[0].length18.value = CIMdet[5]; 
}
if (rownum == 19)
{
	  document.forms[0].rmcode19.value = CIMdet[1];	
	  document.forms[0].material_ref19.value = CIMdet[2];
	  document.forms[0].material_spec19.value = CIMdet[3];
	  document.forms[0].thick19.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width19.value = CIMdet[4];
	  document.forms[0].length19.value = CIMdet[5]; 
}
if (rownum == 20)
{
	  document.forms[0].rmcode20.value = CIMdet[1];	
	  document.forms[0].material_ref20.value = CIMdet[2];
	  document.forms[0].material_spec20.value = CIMdet[3];
	  document.forms[0].thick20.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width20.value = CIMdet[4];
	  document.forms[0].length20.value = CIMdet[5]; 
}
if (rownum == 21)
{
	  document.forms[0].rmcode21.value = CIMdet[1];	
	  document.forms[0].material_ref21.value = CIMdet[2];
	  document.forms[0].material_spec21.value = CIMdet[3];
	  document.forms[0].thick21.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width21.value = CIMdet[4];
	  document.forms[0].length21.value = CIMdet[5]; 
}
if (rownum == 22)
{
	  document.forms[0].rmcode22.value = CIMdet[1];	
	  document.forms[0].material_ref22.value = CIMdet[2];
	  document.forms[0].material_spec22.value = CIMdet[3];
	  document.forms[0].thick22.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width22.value = CIMdet[4];
	  document.forms[0].length22.value = CIMdet[5]; 
}
if (rownum == 23)
{
	  document.forms[0].rmcode23.value = CIMdet[1];	
	  document.forms[0].material_ref23.value = CIMdet[2];
	  document.forms[0].material_spec23.value = CIMdet[3];
	  document.forms[0].thick23.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width23.value = CIMdet[4];
	  document.forms[0].length23.value = CIMdet[5]; 
}
if (rownum == 24)
{
	  document.forms[0].rmcode24.value = CIMdet[1];	
	  document.forms[0].material_ref24.value = CIMdet[2];
	  document.forms[0].material_spec24.value = CIMdet[3];
	  document.forms[0].thick24.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width24.value = CIMdet[4];
	  document.forms[0].length24.value = CIMdet[5]; 
}
if (rownum == 25)
{
	  document.forms[0].rmcode25.value = CIMdet[1];	
	  document.forms[0].material_ref25.value = CIMdet[2];
	  document.forms[0].material_spec25.value = CIMdet[3];
	  document.forms[0].thick25.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width25.value = CIMdet[4];
	  document.forms[0].length25.value = CIMdet[5]; 
}
if (rownum == 26)
{
	  document.forms[0].rmcode26.value = CIMdet[1];	
	  document.forms[0].material_ref26.value = CIMdet[2];
	  document.forms[0].material_spec26.value = CIMdet[3];
	  document.forms[0].thick26.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width26.value = CIMdet[4];
	  document.forms[0].length26.value = CIMdet[5]; 
}
if (rownum == 27)
{
	  document.forms[0].rmcode27.value = CIMdet[1];	
	  document.forms[0].material_ref27.value = CIMdet[2];
	  document.forms[0].material_spec27.value = CIMdet[3];
	  document.forms[0].thick27.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width27.value = CIMdet[4];
	  document.forms[0].length27.value = CIMdet[5]; 
}
if (rownum == 28)
{
	  document.forms[0].rmcode28.value = CIMdet[1];	
	  document.forms[0].material_ref28.value = CIMdet[2];
	  document.forms[0].material_spec28.value = CIMdet[3];
	  document.forms[0].thick28.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width28.value = CIMdet[4];
	  document.forms[0].length28.value = CIMdet[5]; 
}
if (rownum == 29)
{
	  document.forms[0].rmcode29.value = CIMdet[1];	
	  document.forms[0].material_ref29.value = CIMdet[2];
	  document.forms[0].material_spec29.value = CIMdet[3];
	  document.forms[0].thick29.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width29.value = CIMdet[4];
	  document.forms[0].length29.value = CIMdet[5]; 
}
if (rownum == 30)
{
	  document.forms[0].rmcode30.value = CIMdet[1];	
	  document.forms[0].material_ref30.value = CIMdet[2];
	  document.forms[0].material_spec30.value = CIMdet[3];
	  document.forms[0].thick30.value = CIMdet[6] || CIMdet[7];
	  document.forms[0].width30.value = CIMdet[4];
	  document.forms[0].length30.value = CIMdet[5]; 
}
}
function onSelectDel(ind)
{
     //alert(ind+"check----");
     if (ind == 1)
     {
       // var del="del"+1;
        var aind = document.forms[0].del1.selectedIndex;
        //alert(aind+"check222");
        document.forms[0].delvby1.value = document.forms[0].del1[aind].text;
     }
     if (ind == 2)
     {
        var aind = document.forms[0].del2.selectedIndex;
        document.forms[0].delvby2.value = document.forms[0].del2[aind].text;
     }
     if (ind == 3)
     {
        var aind = document.forms[0].del3.selectedIndex;
        document.forms[0].delvby3.value = document.forms[0].del3[aind].text;
     }
     if (ind == 4)
     {
        var aind = document.forms[0].del4.selectedIndex;
        document.forms[0].delvby4.value = document.forms[0].del4[aind].text;
     }
     if (ind == 5)
     {
        var aind = document.forms[0].del5.selectedIndex;
        document.forms[0].delvby5.value = document.forms[0].del5[aind].text;
     }
     if (ind == 6)
     {
        var aind = document.forms[0].del6.selectedIndex;
        document.forms[0].delvby6.value = document.forms[0].del6[aind].text;
     }
     if (ind == 7)
     {
        var aind = document.forms[0].del7.selectedIndex;
        document.forms[0].delvby7.value = document.forms[0].del7[aind].text;
     }
     if (ind == 8)
     {
        var aind = document.forms[0].del8.selectedIndex;
        document.forms[0].delvby8.value = document.forms[0].del8[aind].text;
     }
     if (ind == 9)
     {
        var aind = document.forms[0].del9.selectedIndex;
        document.forms[0].delvby9.value = document.forms[0].del9[aind].text;
     }
     if (ind == 10)
     {
        var aind = document.forms[0].del10.selectedIndex;
        document.forms[0].delvby10.value = document.forms[0].del10[aind].text;
     }
     if (ind == 11)
     {
        var aind = document.forms[0].del11.selectedIndex;
        document.forms[0].delvby11.value = document.forms[0].del11[aind].text;
     }
     if (ind == 12)
     {
        var aind = document.forms[0].del12.selectedIndex;
        document.forms[0].delvby12.value = document.forms[0].del12[aind].text;
     }
     if (ind == 13)
     {
        var aind = document.forms[0].del13.selectedIndex;
        document.forms[0].delvby13.value = document.forms[0].del13[aind].text;
     }
     if (ind == 14)
     {
        var aind = document.forms[0].del14.selectedIndex;
        document.forms[0].delvby14.value = document.forms[0].del14[aind].text;
     }
     if (ind == 15)
     {
        var aind = document.forms[0].del15.selectedIndex;
        document.forms[0].delvby15.value = document.forms[0].del15[aind].text;
     }
     if (ind == 16)
     {
        var aind = document.forms[0].del16.selectedIndex;
        document.forms[0].delvby16.value = document.forms[0].del16[aind].text;
     }
     if (ind == 17)
     {
        var aind = document.forms[0].del17.selectedIndex;
        document.forms[0].delvby17.value = document.forms[0].del17[aind].text;
     }
     if (ind == 18)
     {
        var aind = document.forms[0].del18.selectedIndex;
        document.forms[0].delvby18.value = document.forms[0].del18[aind].text;
     }
     if (ind == 19)
     {
        var aind = document.forms[0].del19.selectedIndex;
        document.forms[0].delvby19.value = document.forms[0].del19[aind].text;
     }
     if (ind == 20)
     {
        var aind = document.forms[0].del20.selectedIndex;
        document.forms[0].delvby20.value = document.forms[0].del20[aind].text;
     }
     if (ind == 21)
     {
        var aind = document.forms[0].del21.selectedIndex;
        document.forms[0].delvby21.value = document.forms[0].del21[aind].text;
     }
     if (ind == 22)
     {
        var aind = document.forms[0].del22.selectedIndex;
        document.forms[0].delvby22.value = document.forms[0].del22[aind].text;
     }
     if (ind == 23)
     {
        var aind = document.forms[0].del23.selectedIndex;
        document.forms[0].delvby23.value = document.forms[0].del23[aind].text;
     }
     if (ind == 24)
     {
        var aind = document.forms[0].del24.selectedIndex;
        document.forms[0].delvby24.value = document.forms[0].del24[aind].text;
     }
     if (ind == 25)
     {
        var aind = document.forms[0].del25.selectedIndex;
        document.forms[0].delvby25.value = document.forms[0].del25[aind].text;
     }
     if (ind == 26)
     {
        var aind = document.forms[0].del26.selectedIndex;
        document.forms[0].delvby26.value = document.forms[0].del26[aind].text;
     }
     if (ind == 27)
     {
        var aind = document.forms[0].del27.selectedIndex;
        document.forms[0].delvby27.value = document.forms[0].del27[aind].text;
     }
     if (ind == 28)
     {
        var aind = document.forms[0].del28.selectedIndex;
        document.forms[0].delvby28.value = document.forms[0].del28[aind].text;
     }
     if (ind == 29)
     {
        var aind = document.forms[0].del29.selectedIndex;
        document.forms[0].delvby29.value = document.forms[0].del29[aind].text;
     }
     if (ind == 30)
     {
        var aind = document.forms[0].del30.selectedIndex;
        document.forms[0].delvby30.value = document.forms[0].del30[aind].text;
     }

}

function GetCIM(rt) {
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

function SetCIM(CIM,fieldname) {
   //alert(CIM);
   //var fieldname=6;
   //alert(fieldname);
   var CIM = CIM.split("|");
   var id1="crn"+ fieldname;
   var text1= document.getElementById(id1);
   text1.value=CIM[9];

}

function addRow(id,index){
//alert(index);
var x=index;
var y = index;
//alert(y);
linenum="linenum"+index;
crn="crn"+index;
qty_allocated="qty_allocated"+index;
mat_spec="mat_spec"+index;
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

prevlinenum = "prev_line_num" + index;
lirecnum = "lirecnum" + index;


var cell1 = document.createElement("TD");
cell1.setAttribute("align","left");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","4");
inp1.setAttribute("name",linenum);
inp1.setAttribute("id",linenum);
cell1.appendChild(inp1);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
cell3.setAttribute("align","left");
inp3.setAttribute("size","18");
inp3.setAttribute("name",mat_spec);
inp3.setAttribute("id",mat_spec);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
cell4.setAttribute("align","left");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","16");
inp4.setAttribute("name",qty_allocated);
inp4.setAttribute("id",qty_allocated);
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
cell5.setAttribute("align","left");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("readOnly","true");
inp5.setAttribute("size","10");
inp5.setAttribute("name",crn);
inp5.setAttribute("id",crn);
inp5.style.backgroundColor = "#DDDDDD";
cell5.appendChild(inp5);


var cell5image = document.createElement("IMAGE");
cell5image.setAttribute("src","images/bu-get.gif");
cell5image.onclick= function() {
GetCIM(y);
};
cell5.appendChild(cell5image);

var inp10 = document.createElement("INPUT");
inp10.setAttribute("type","hidden");
inp10.setAttribute("value","");
inp10.setAttribute("name",prevlinenum);
inp10.setAttribute("id",prevlinenum);
cell5.appendChild(inp10);

var inp11 = document.createElement("INPUT");
inp11.setAttribute("type","hidden");
inp11.setAttribute("value","");
inp11.setAttribute("name",lirecnum);
inp11.setAttribute("id",lirecnum);
cell5.appendChild(inp11)



row.appendChild(cell1);
row.appendChild(cell3);
row.appendChild(cell5);
row.appendChild(cell4);
tbody.appendChild(row);
x++;
//alert("i am here");
document.forms[0].index.value = x;
}

function GetCIM4Po(rt) {
//alert(rt);
var param = rt;
var cim = "crn"+rt;
var orderQty="order_qty"+rt;
var spec_type="spec_type"+rt;
var crnnum = document.getElementById(cim).value;
var order_qty=document.getElementById(orderQty).value;
var vendrecnum=document.getElementById("vendrecnum").value;
var spec_type=document.getElementById(spec_type).value;
var po_type=document.getElementById("potype").value;
//alert(po_type+"////////////////");
if(document.getElementById(cim).value.length==0)
{
 alert('Please enter CRN');
 return false;

}
if(document.getElementById(orderQty).value.length==0)
{
 alert('Please enter Order Quantity');
 return false;

}
if(document.getElementById("potype").value=="")
{
 alert('Please Select A Type');
 return false;

}
//alert(crnnum);
var winWidth = 1200;
var winHeight = 360;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getCrn4Po1.php?crn="+crnnum+"&order_qty="+order_qty+"&vendor="+vendrecnum+"&spec_type="+spec_type+"&potype="+po_type, param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetCrn(CIM,fieldname,flag,potype) {
  // alert(CIM+"-----------"+potype);
   //var fieldname=6;
   if(flag == 1)
   {
     alert('Special Characters Are Present');
     //return false;
   }
   if(potype!=='Bought Out')
   {
   var page=document.forms[0].page.value;
   var CIM = CIM.split("|");

   var id1="crn"+ fieldname;
   var text1= document.getElementById(id1);
   text1.value=CIM[0];

   var id2="material_ref"+ fieldname;
   var text2= document.getElementById(id2);
   text2.value=CIM[2];

   var id3="material_spec"+ fieldname;
   var text3= document.getElementById(id3);
   text3.value=CIM[1];

   var id4="uom"+ fieldname;
   var text4= document.getElementById(id4);
   text4.value=CIM[3];
   
   var id5="dia"+ fieldname;
   var text4= document.getElementById(id5);
   text4.value=CIM[4];
   
    if(page=='new')
   {
    var id7="width"+ fieldname;
    var text4= document.getElementById(id7);
    text4.value=CIM[5];
   
    var id8="len"+ fieldname;
    var text4= document.getElementById(id8);
    text4.value=CIM[6];
    
    var id6="thick"+ fieldname;
    var text4= document.getElementById(id6);
    text4.value=CIM[7];
   }
   else
   {
     var id7="width"+ fieldname;
    var text4= document.getElementById(id7);
    text4.value=CIM[5];

    var id8="len"+ fieldname;
    var text4= document.getElementById(id8);
    text4.value=CIM[6];
    
    var id6="thick"+ fieldname;
    var text4= document.getElementById(id6);
    text4.value=CIM[7];
   }
   var id9="grainflow"+ fieldname;
   var text4= document.getElementById(id9);
   text4.value=CIM[8];
   
   var id10="condition"+ fieldname;
   var text4= document.getElementById(id10);
   text4.value=CIM[9];
   
   var id11="maxruling"+ fieldname;
   var text4= document.getElementById(id11);
   text4.value=CIM[10];
   
   var id12="alt_spec"+ fieldname;
   //alert(id12+"\n");
   var text4= document.getElementById(id12);
   //alert(CIM[11]);
   text4.value=CIM[11];
   
   var id13="no_of_lengths"+ fieldname;
   //alert(id13+"test99999999999"+CIM[13]);
   var text4= document.getElementById(id13);
   text4.value=CIM[13];
   
   var id14="no_of_meterages"+ fieldname;
   //alert(id14+"test"+CIM[14]);
   var text4= document.getElementById(id14);
   text4.value=CIM[14];
   
   var id15="rate"+ fieldname;
   var text4= document.getElementById(id15);
   text4.value=CIM[12];
   //alert(CIM[12]+"test"+text4.value+"yyyy");
  }else
  {
   var CIM = CIM.split("|");

   var id1="crn"+ fieldname;
   var text1= document.getElementById(id1);
   text1.value=CIM[0];

   var id2="material_ref"+ fieldname;
   var text2= document.getElementById(id2);
   text2.value=CIM[3];

   var id3="material_spec"+ fieldname;
   var text3= document.getElementById(id3);
   text3.value=CIM[1];
   
   var id15="rate"+ fieldname;
   var text5= document.getElementById(id15);
   text5.value=CIM[2];
   
   var id13="no_of_lengths"+ fieldname;
   //alert(id13+"test"+CIM[4]);
   var text4= document.getElementById(id13);
   text4.value=CIM[4];
   
    var id14="no_of_meterages"+ fieldname;
   //alert(id14+"test"+CIM[14]);
   var text4= document.getElementById(id14);
   text4.value=CIM[5];
  }
}

function check_req_fields()
{
 var errmsg1 = '';
 var index = document.forms[0].index.value;
 var poliindex = document.forms[0].poli_index.value;
 //alert(index);
 //alert(poliindex);
 var i=1;
 while(i<index)
 {
   var flag=0;
   linenum = "linenum" + i;
   mat_spec = "mat_spec" + i;
   if(document.getElementById(linenum).value.length != 0)
   {
    linenumber=document.getElementById(linenum).value;
    //alert('linenum='+linenumber);
    if(document.getElementById(mat_spec).value.length==0)
    {
      errmsg1 += 'please enter material spec\n';
    }
    matspec=document.getElementById(mat_spec).value;
    //alert('matspec='+matspec);
    var k =1;
    while(k<poliindex)
    {
      line_num = "line_num" + k;
      material_spec = "material_spec" + k;
      //alert('liline='+document.getElementById(line_num).value);
      //alert('material spec='+document.getElementById(material_spec).value);
      if(linenumber == document.getElementById(line_num).value && matspec == document.getElementById(material_spec).value)
      {
       flag=1;
      }
     k++;
    }

   if(flag == 0)
   {
    errmsg1 += 'please enter valid line Num and Material Spec for line'+i+'\n';
   }
  }
   i++;

 }

 if (errmsg1 == '')
        return true;
    else
    {
       alert (errmsg1);
       return false;
    }
}

function toggleValue(divid,chk,approve_date)
{
 //alert(approve_date);
 if(chk.checked)
 {
  if(document.getElementById(divid).value == "yes")
  {
    document.getElementById(divid).value="no";
    chk.checked=false;
  }
  else
  {
   document.getElementById(divid).value="yes";
  }
 }
 else
 {
   document.getElementById(divid).value="no";
 }
   if(document.getElementById('approval').value=="yes"){
  document.getElementById('approvaldate').value = approve_date;
  }
  else if(document.getElementById('approval').value=="no"){
    document.getElementById('approvaldate').value = '';
  }

}

function onSelecttype()
{

   var aind = document.forms[0].potype_sel.selectedIndex;
   document.forms[0].potype.value = document.forms[0].potype_sel[aind].text;

}



