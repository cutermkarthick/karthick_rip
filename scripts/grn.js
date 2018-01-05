/*
 * grn.js
 * validation for qualityplan
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
*/
var grnvalidate = 0;
var grnvalidatecopy = 0;

function putfocus()
{
   document.forms[0].company.focus();
}
function searchsort_fields()
{
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;
}
function ConfirmDelete() 
{
     document.forms[0].deleteflag.value = "y";
     return true;
}
function multiply()
{
     num1 = document.forms[0].num_of_lengths.value;
     num2 = document.forms[0].num_of_pieces.value;
     
     product =num1 * num2;
     document.forms[0].total_qty.value = product;
}
function GetDate(rt) 
{	
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

function SetDate(dateval,fieldname) 
{
fn = document.getElementById(fieldname);
//alert(fn);
fn.value = dateval;
}

/*function GetCIM(rt) {
//alert(rt);
var param = rt;
var winWidth = 600;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getCIM.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetCIM(CIM,CIMarr,fieldname) {

//alert(document.forms[0].elements[fieldname]);
//alert(document.forms[0].elements[fieldname + "recnum"]);
var CIM = CIM.split("|");
document.forms[0].elements[fieldname].value = CIM[0];
//alert(CIMarr);
//document.forms[0].elements[fieldname + "recnum"].value = CIMrecnum;
/*var CIMdet = CIMarr.split("|");
//alert(CIMdet[13]);
//alert(CIMdet[14]);
//alert(CIMdet[15]);
document.forms[0].link2masterdata.value = CIMdet[0];
// alert(CIMdet[0]);
document.forms[0].partname.value = CIMdet[1];
// alert(CIMdet[1]);
document.forms[0].partnum.value = CIMdet[4];
// alert(CIMdet[4]);
document.forms[0].RM_by_CIM.value = CIMdet[5];
//s alert(CIMdet[5]);
document.forms[0].project.value = CIMdet[6];
document.forms[0].attachments.value = CIMdet[7];
document.forms[0].RM_by_customer.value = CIMdet[8];
document.forms[0].drg_issue.value = CIMdet[10];
document.forms[0].rm_type.value = CIMdet[11];
document.forms[0].rm_spec.value = CIMdet[12];
document.forms[0].rm_dim1.value = CIMdet[13];
document.forms[0].rm_dim2.value = CIMdet[14];
document.forms[0].rm_dim3.value = CIMdet[15];
document.forms[0].mps_rev.value = CIMdet[16];
document.forms[0].mps_num.value = CIMdet[17];
document.forms[0].drawing_num.value = CIMdet[18];
document.getElementById('poimg').value = CIMdet[4];

}*/

function GetAllVendors(rt) {
var param = rt;
var winWidth = 400;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getallvendors.php?reasontext=" + rt, "Vendors", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft+",dependent=yes");
}
function SetVendor(vendor,vendrecnum) {
document.forms[0].vendor.value = vendor;
document.forms[0].vendrecnum.value = vendrecnum;
}


function GetInvXsaction()
{
var winWidth = 650;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("activitylog.php", "Vendors", +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft+",dependent=yes");
}

function onSelectStatus()
{
   var aind = document.forms[0].grnstat.selectedIndex;
   if (aind == 0)
   {
      alert ("Please select a valid Status");
      return false;
   }
   document.forms[0].status.value = document.forms[0].grnstat[aind].text;
   //document.forms[0].activeval.value = document.forms[0].postat[aind].text;

}

function check_req_fields()
{
	//alert ('function working');
	//return false;
    var errmsg = '';
    var lipresent = 0;
    var po_approval = 0;
    var po_approval_sales=0;
	
	if (document.forms[0].wotype.value == "")
    {
         errmsg += 'Please enter GRN Classification.\n';
    }
    var grnindex =  document.getElementById('grntype').selectedIndex;

	if (grnvalidate == 0 && document.getElementById('parentgrnnum').value.length==0 )
	{ 
	 // alert(document.getElementById('pagename').value);
		if(document.getElementById('pagename').value == 'edit_grn' )
		{
		   if((document.getElementById('approved_grn').value == "" && 
			   document.getElementById('approved_grn').value != "yes" )&&
			  (document.getElementById('cad_approved_grn').value == "" && 
			   document.getElementById('cad_approved_grn').value != "yes" ))
		   {
			  alert("You should run validation before submission");
			  // return false;
		   }
		}
		else
		{
		 alert("You should run validation before submission");
			// return false;
		}
	}	
	if(grnvalidatecopy==0 && document.getElementById('parentgrnnum').value.length!=0)
	{
    if(document.getElementById('pagename').value == 'edit_grn')
	{
	  // alert(document.getElementById('approved_grn').value+'------'+document.getElementById('cad_approved_grn').value);
	  if((document.getElementById('approved_grn').value == "" && document.getElementById('approved_grn').value != "yes" )&&
(document.getElementById('cad_approved_grn').value == "" && document.getElementById('cad_approved_grn').value != "yes" ))
       {
         alert("You should run validation before submission");
		// return false;
       }
	}
	else if(document.getElementById('pagename').value !='grn_swap')
	{
	 alert("You should run validation before submission");
		// return false;
	}
	}
	//alert(document.forms[0].grnnum.value+'-------------'+document.forms[0].grnnum.value.length);
    if (document.forms[0].grnnum.value.length == 0)
    {
         errmsg += 'Please enter GRN No.\n';
    }

if (document.forms[0].wotype.value == 'Regular')
{
    if (document.forms[0].batch_num.value == "")
    {
         errmsg += 'Please enter Batch No.\n';
    }	
 
}
    if (document.forms[0].vendor.value.length == 0)
    {
         errmsg += 'Please enter Supplier name.\n';
    }


	 if (document.forms[0].grntype.value != 'Rework' && document.forms[0].wo_ref.value != '')
    {
         errmsg += 'Please select GRN Type:Rework for WO Ref.\n';
    }

    if (document.forms[0].invoice_num.value.length == 0)
    {
         errmsg += 'Please enter Invoice No.\n';
    }
    if (document.forms[0].invoice_date.value.length == 0)
    {
         errmsg += 'Please enter Invoice Date.\n';
    }
    if (document.forms[0].recieved_date.value.length == 0)
    {
         errmsg += 'Please enter Received Date.\n';
    }


    if(document.forms[0].wotype.value == 'Assy' && document.forms[0].grntype.value != 'Rework' )
	{
         errmsg += 'Please Select Rework GRN Type for Assy Classification.\n';
	}

	if(document.forms[0].wotype.value == 'Assy')
	{
      if (document.forms[0].nc_refnum.value == "")
      {
         errmsg += 'Please enter QA NC Ref#.\n';
      }	
	  if (document.forms[0].status.value == "")
      {
         errmsg += 'Please enter Status.\n';
      }
	  if (document.forms[0].coc_refnum.value == "")
      {
         errmsg += 'Please enter Cofc Refnum.\n';
      }
	   if(document.getElementById('rmbycim').value != '' || document.getElementById('rmbycust').value != '' )
    {
      errmsg += 'RM by Host,RM by Cust not required for Assy Classification.\n';
    }
	  if (document.forms[0].raw_mat_spec.value != "")
      {
          errmsg += 'Raw Mat Spec not required for Assy Classification.\n';
      }
	  if (document.forms[0].raw_mat_type.value != "")
      {
          errmsg += 'Raw Mat Type not required for Assy Classification.\n';
      }
	  if (document.forms[0].raw_mat_code.value != "")
      {
         errmsg += 'Raw Mat Code not required for Assy Classification.\n';
      }
	    if (document.forms[0].mgp_num.value == "")
      {
         errmsg += 'Please enter MGP/DC #.\n';
      }	

	  if (document.forms[0].batch_num.value != "")
      {
          errmsg += 'Batch Num not required for Assy Classification.\n';
      }	
	  if (document.forms[0].cimponum.value != "")
      {
         errmsg += 'Host PONum not required for Assy Classification.\n';
      }
	}

   // if (document.forms[0].shipping_date.value.length == 0)
    //{
        // errmsg += 'Please enter Shipping Date.\n';
    //}
      if (document.forms[0].raw_mat_spec.value == "")
      {
          errmsg += 'Please Enter Raw Mat Spec .\n';
      }
    if (document.forms[0].raw_mat_type.value == "")
      {
          errmsg += 'Please Enter Raw Mat Type.\n';
      }

    // if (document.forms[0].grntype.value != 'Consummables' && document.forms[0].grntype.value != 'Boughtout')
    // {
    //      errmsg += 'Please enter PRN.\n';
    // }
	if(document.forms[0].grntype.value == '')
    {
       errmsg +='Please select valid GRN Type.\n';
    }
    if(document.forms[0].grntype.value == 'Rework' && document.getElementById('nc_refnum').value == '')
    {
       errmsg +='Enter QA NC Ref#.\n';
    }
    
    if(document.forms[0].grntype.value != 'Rework' && document.getElementById('nc_refnum').value != '')
    {
       errmsg +='QA NC Ref# Not Required.\n';
    }

    if(document.forms[0].grntype.value != 'Quarantined' && document.forms[0].prevgrntype.value != 'Quarantined' &&
		document.getElementById('ncref').value != '')
    {
       errmsg +='NC Ref# not required.\n';
    }
	if(document.forms[0].grntype.value == 'Quarantined' && document.getElementById('ncref').value == '')
    {
       errmsg +='Please enter NC number.\n';
    }
    if(document.forms[0].grntype.value == 'Quarantined' && document.getElementById('quarremarks').value == '')
    {
       errmsg +='Please enter Quarantine Remarks.\n';
    }
	
	if (document.forms[0].prevgrntype.value == 'Quarantined' &&
		document.forms[0].grntype.value == 'Regular' &&
		(document.forms[0].conversion_date.value == '0000-00-00' || document.forms[0].conversion_date.value == ''))
    {
       errmsg +='Please enter Conversion Date.\n';
    }

	if((document.forms[0].grntype.value != 'Quarantined' && document.forms[0].prevgrntype.value != 'Quarantined')
		&& document.getElementById('quarremarks').value != '')
    {
       errmsg +='Quarantine Remarks only if GRN Type is Quarantined.\n';
    }
	
	 if(document.forms[0].grntype.value == "Quarantined" && 
		 (document.forms[0].Quarantined_date.value.length  == 0 || document.forms[0].Quarantined_date.value == "0000-00-00"))
	{
		errmsg += 'Please enter Quarantined_date for  GRN Type is Quarantined \n';
	}
	if(document.forms[0].prevgrntype.value != 'Quarantined' && document.forms[0].grntype.value != "Quarantined" && 
		(document.forms[0].Quarantined_date.value.length >= 1 &&
		 document.forms[0].Quarantined_date.value != "0000-00-00"))
	{
		errmsg += 'Quarantined date Should Not Be present \n';
	}
	
if (document.forms[0].wotype.value == 'Regular')
{
    if(document.getElementById('rmbycim').value == '' && document.getElementById('rmbycust').value == '' )
    {
       errmsg +='Please enter either RM by Host or RM by Cust\n';
    }

    if(document.getElementById('rmbycim').value != '' && document.getElementById('rmbycust').value != '' )
    {
       errmsg +='Please enter either RM by Host or RM by Cust\n';
    }
    if(document.getElementById('rmbycim').value != '' && document.getElementById('cimponum').value == '' )
    {
       errmsg +='Host PO Num required if RM by Host is present\n';
    }
    if(document.getElementById('rmbycust').value != '' && document.getElementById('cimponum').value != '' )
    {
       errmsg +='Host PO Num not required if RM by Cust is present\n';
    }
    
    if(document.getElementById('rmbycust').value != '' && document.getElementById('cimponum').value != '' && document.getElementById('rmpoline_num').value == '')
    {
       errmsg +='Please enter RMPO LINE#\n';
    }
    if(document.getElementById('status').value == '')
    {
       //errmsg +='Please enter Status\n';
    }
    /*if(document.getElementById('validate_flag').value == '1')
    {
       //errmsg +='Validation Failed Please Correct & Proceed\n';
    }  */
    if(document.getElementById('rmempcode').value.length == 0 ||document.getElementById('rmcheckdate').value.length == 0  )
    {
       //errmsg +='Please enter RM Checked By and RM Checked Date\n';
    }
}

    if(document.getElementById('pagename').value == 'edit_grn')
    { 	
		//alert(document.forms[0].approved_grn.value +'------------'+ document.forms[0].approval_remarks.value );
   	  if(document.forms[0].cad_approved_grn.value == 'yes' && document.getElementById('approval_remarks').value.length == 0
        && document.getElementById('department').value != "Stores" && document.getElementById('department').value != "Purchasing")
      {        
         errmsg +='Please enter Approval Remarks.\n';
      }
      var StrToCheck = document.getElementById('notes').value;
	  
      StrToCheck= StrToCheck.replace(/^\s+|\s+$/, '');
      if(StrToCheck == '')
      {
         errmsg +='Please enter Notes\n';
      }    
    }

	 if(document.forms[0].grntype.value == 'Rework' && document.forms[0].wo_ref.value =='')
	 {
		 errmsg +='Please Select Wo Ref.\n';
		 errmsg +='Wo Ref. required if Wo Type:REWORK \n';
	 }

if(document.getElementById('pagename').value == 'edit_grn')
{  
	var po_mater_ref=document.getElementById('material_ref').value;
	var po_mater_spec=document.getElementById('material_spec').value;
	var po_length=document.getElementById('length').value;
	var po_width=document.getElementById('width').value;
	var po_thick=document.getElementById('thick').value;
}
if ((document.getElementById('pagename').value == 'grn_swap' ||
	document.getElementById('pagename').value == 'newcopy_grn') && 
	 document.getElementById('parentgrnnum').value =='' )
{
	 errmsg += 'Please Enter Parent GRN No.\n';
}  

    var ind = document.forms[0].index.value;
    var seq_num=new Array();
    var seqlist = {};

    for(i=1;i<ind;i++)
    {	
       ln = "line_num" + i;
       amend_line_num = "amend_line_num" + i;
       noofpieces="noofpieces"+i;
       
       lnv = document.getElementById(ln).value;
       amendlnv = document.getElementById(amend_line_num).value;	   
	   
       if (document.getElementById(ln).value.length != 0)
       {	          
		   uom = "uom" + i;
           if (document.getElementById(uom).value.length == 0)
           {
               errmsg += 'Please enter UOM for line item ' + lnv + '\n';
           }
           qty = "qty" + i;
           if (document.getElementById(qty).value.length == 0)
           {
               errmsg += 'Please enter Qty for line item ' + lnv + '\n';
           }
           dim1 = "dim1" + i;
           if (document.getElementById(dim1).value.length == 0)
           {
               errmsg += 'Please enter Dim1(Length) for line item ' + lnv + '\n';
           }
           dim2 = "dim2" + i;
           if (document.getElementById(dim2).value.length == 0 && document.getElementById(noofpieces).value.length ==0)
           {
               //errmsg += 'Please enter Dim2(Width/ID) for line item ' + lnv + '\n';
           }
           dim3 = "dim3" + i;
           if (document.getElementById(dim3).value.length == 0)
           {
               errmsg += 'Please enter Dim3(Thickness/OD) for line item ' + lnv + '\n';
           }
           qty4billet = "qty4billet" + i;
           if (document.getElementById(qty4billet).value.length == 0)
           {
               errmsg += 'Please enter Qty Per Billet for line item ' + lnv + '\n';
           }
           qty_to_make = "qty_to_make" + i;
		   liqtm = document.getElementById(qty_to_make).value;
           if (document.getElementById(qty_to_make).value.length == 0)
           {
               errmsg += 'Please enter Qty to make for line item ' + lnv + '\n';
           }		
		 
      if(document.getElementById('pagename').value == 'newcopy_grn')
      {
           billetsreq= "billetsreq" + i;		   
           if (document.getElementById(billetsreq).value.length == 0)
           {
               errmsg += ' Please enter Billets req for line item ' + lnv + '\n';
           }
	  }		   
      var layoutref= "layout_ref" + i;
      var layout_ref = document.getElementById(layoutref).value

	  if(document.getElementById('grntype').value == 'Consummables')
	  {
          expdate = "expdate" + i;
		  if (document.getElementById(expdate).value.length == 0)
		  {
			  errmsg += 'Please enter expdate for line item ' + lnv + '\n';
		  }
	  }

	  
var raw_mat_type=document.getElementById('raw_mat_type').value;
var raw_mat_spec=document.getElementById('raw_mat_spec').value;
dim_1 = "dim1" + i;
dim_2 = "dim2" + i;
dim_3 = "dim3" + i;
var dim1=document.getElementById(dim_1).value;
var dim2=document.getElementById(dim_2).value;
var dim3=document.getElementById(dim_3).value;
if(document.getElementById('department').value == 'CAD')
{  
if(raw_mat_type != po_mater_ref || raw_mat_spec != po_mater_spec || dim1 != po_length || dim2 != po_width || dim3 != po_thick)
{
  po_approval=1;
} 
}

if(document.getElementById('department').value != 'CAD' && document.getElementById('userid_app_cad').value =='Auto Approved' && document.getElementById('pagename').value == 'edit_grn' )
{
//alert(raw_mat_type+' !='+ po_mater_ref+' ||'+ raw_mat_spec+' !='+ po_mater_spec+' ||'+ dim1 +'!='+ po_length+' ||'+ dim2 +'!='+ po_width+' ||'+ dim3+' !='+ po_thick);
if( (raw_mat_type != po_mater_ref || raw_mat_spec != po_mater_spec || dim1 != po_length || dim2 != po_width || dim3 != po_thick))
{
   po_approval_sales=1;
} 
}
lipresent = 1;

if(document.getElementById('pagename').value == 'grn_swap' ||
	document.getElementById('pagename').value == 'newcopy_grn' )
{
		  var qtm_req=parseFloat(document.getElementById('qtm_req').value);
		  var qty4billet=parseFloat(document.getElementById('qty4billet1').value);
		  //var layout_ref=document.getElementById('mlayout_ref').value;
          var layout_flag=0;
		  var rm_length_f = parseFloat(document.getElementById('rm_length').value);
		  var rm_width_f = parseFloat(document.getElementById('rm_width').value);
		  var rm_thickness_f = parseFloat(document.getElementById('rm_thickness').value);
		  var rm_type_f=document.getElementById('rm_type').value;
		  var rm_spec_f=document.getElementById('rm_spec').value;
		  
		  rm_length_f=(isNaN(rm_length_f)?'':rm_length_f);
		  rm_width_f=(isNaN(rm_width_f)?'':rm_width_f);
		  rm_thickness_f=(isNaN(rm_thickness_f)?'':rm_thickness_f);
		  rm_type_f=(isNaN(rm_type_f)?'':rm_type_f);
		  rm_spec_f=(isNaN(rm_spec_f)?'':rm_spec_f);	  


		  var rm_length_t=parseFloat(document.getElementById('rm_length_to').value);
		  var rm_width_t=parseFloat(document.getElementById('rm_width_to').value);
		  var rm_thickness_t=parseFloat(document.getElementById('rm_thickness_to').value);
		  var rm_type_t=document.getElementById('rm_type_to').value;
		  var rm_spec_t=document.getElementById('rm_spec_to').value;

		  rm_length_t=(isNaN(rm_length_t)?'':rm_length_t);
		  rm_width_t=(isNaN(rm_width_t)?'':rm_width_t);
		  rm_thickness_t=(isNaN(rm_thickness_t)?'':rm_thickness_t);
		  rm_type_t=(isNaN(rm_type_t)?'':rm_type_t);
		  rm_spec_t=(isNaN(rm_spec_t)?'':rm_spec_t);

		  var num_rows_f=document.getElementById('num_rows_f').value;
		  var num_rows_t=document.getElementById('num_rows_t').value;

		  var crn=document.getElementById('altcrn').value;
		  var to_crn=document.getElementById('crn').value;

		  var layout_db=document.getElementById('layout_db').value;

          //Added by BM on Dec 8, 2013 to crosscheck avail vs req
          var qtybal = parseFloat(document.getElementById('qtm_bal').value);
		  //alert("Avail qty is "+qtybal);
		  //alert("qty req is "+qtm_req);
/*
		  alert("qty to make in line item is "+liqtm);
		  if (liqtm != qtm_req)
		  {
			  //alert("Computed QTM is not equal to QTM Req");
			  //errmsg += 'Computed QTM is not equal to QTM Req  \n';
		  }
*/

		  if (layout_ref == '' && qtybal < qtm_req)
		  {
			  //alert("Qty available is less than req qty");
			  errmsg += 'Qty available is less than req qty  \n';
		  }	  

		  if(layout_ref == '' && qtm_req < qty4billet)
		  {
			  errmsg += 'QTM Req should be greater than QTY/Billet.\n';
		  }
		  var remainder = (qtm_req%qty4billet);
		  //alert(qtm_req +'>'+ qty4billet +'&&'+ qtm_req+'%%%'+ qty4billet);
		  if(layout_ref == '' && qtm_req > qty4billet && remainder > 0)
		  {
			  errmsg += 'QTM Req is not valid.\n';
		  }
	
		  if(layout_ref == '')
	      {
			 /* alert(rm_length_f+'--ln--len--'+rm_length_t+'---wid'+rm_width_f+'---wid---'+rm_width_t+
				  '---thic--'+rm_thickness_f+'---thick---'+rm_thickness_t+'--type--'+rm_type_f+'---type---'+rm_type_t+
				  '---spec--'+rm_spec_f+'---spec--'+rm_spec_t);*/

			  if(num_rows_f == 0)
			  {
                 errmsg += 'From PRN: '+ crn +'  not in RM Master \n';
			  }
			  if(num_rows_t == 0)
			  {
                 errmsg += 'TO PRN: '+ to_crn +'  not in RM Master \n';
			  }
			  if(num_rows_f > 0 && num_rows_t > 0)
			  {
				  if(rm_length_f != rm_length_t)
				  {
					errmsg += 'RM Length(From PRN) not matching with RM Length(To PRN) \n';
				  }
				  if(rm_width_f != rm_width_t)
				  {
					errmsg += 'RM Width(From PRN) not matching with RM Width(To PRN) \n';
				  }
				  if(rm_thickness_f != rm_thickness_t)
				  {
					errmsg += 'RM Thickness(From PRN) not matching with RM Thickness(To PRN) \n';
				  }	
				  if(rm_type_f != rm_type_t)
				  {
					errmsg += 'RM Type(From CRN) not matching with RM Type(To CRN) \n';
				  }
				  if(rm_spec_f != rm_spec_t)
				  {
					errmsg += 'RM Spec(From PRN) not matching with RM Spec(To PRN) \n';
				  }
			  }
		  }
		  else
	      {
			  if(num_rows_f == 0)
			  {
                 errmsg += 'From PRN '+ crn +'  not in RM Master \n';
			  }
			  if(num_rows_t == 0)
			  {
                 errmsg += 'TO PRN '+ to_crn +'  not in RM Master \n';
			  }
			  if(num_rows_f > 0 && num_rows_t > 0)
			  {
				  if(rm_type_f != rm_type_t)
				  {
					errmsg += 'RM Type(From PRN) not matching with RM Type(To PRN) \n';
				  }
				   if(rm_spec_f != rm_spec_t)
				  {
					errmsg += 'RM Spec(From PRN) not matching with RM Spec(To PRN) \n';
				  }
			  }
	      }		  
		  var lay_db_res = layout_db.split("|");
		  var count=lay_db_res.length;
          for(var j=0;j<count;j++)
          {		
            if(lay_db_res[j] == layout_ref)
			{
				layout_flag=1;
			}
          }
		  if(layout_flag == 1 && layout_ref != '')
	      {
            errmsg += 'Layout Ref already present ,Please Enter different Layout Ref# \n';
	      }

  }

 }
}	 

if(document.getElementById('pagename').value == 'newcopy_grn')
{
   var remain_qty=parseFloat(document.getElementById('remain_qty').value);
   var qtm_req=parseFloat(document.getElementById('qtm_req').value);
  
   if(qtm_req > remain_qty && layout_ref == '')
	   errmsg += ' QTM Req should be less than or equal to Balance Qty   \n';
}

if(document.getElementById('total_qty_make').value == '0.00' || 
		 document.getElementById('total_qty_make').value == '0')
{
		// errmsg += 'QTM should not be 0\n';
}

if (lipresent == 0)
{        
             errmsg += 'Atleast one line item must be present\n';
}
if (po_approval == 0  && document.getElementById('department').value == 'CAD')
{             
       document.getElementById('userid_app_cad').value ='Auto Approved';
}
//alert(po_approval_sales+'------');
if (po_approval_sales == 1  && document.getElementById('department').value != 'CAD')
{             
          document.getElementById('userid_app_cad').value ='CAD';
}

if (errmsg == '')
{
        return true;
}
    else
    {
       alert (errmsg);
	   grnvalidate = 0;
	   grnvalidatecopy = 0;
       return false;
    }


}

function printgrn(grnrecnum) {
var winWidth = 680;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("printgrn.php?grnrecnum=" + grnrecnum, "printgrn",
+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}

function GetCIM(rt)
{
var param = rt;
var winWidth = 500;
var winHeight = 400;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var pocrn=document.getElementById('pocrn').value;
var ponum=document.getElementById('cimponum').value;
var temp=(ponum.replace(/&+/g,"and")) ;
// alert(temp);
var polinenum=document.getElementById('rmpoline_num').value;
var wotype=document.getElementById('wotype').value;

if(document.getElementById('pagename').value == 'grn_swap' && document.getElementById('qtm_req').value == '')
{
	 alert("Please Enter QTM Req");
	 return false;
}

if(document.getElementById('pagename').value == 'newcopy_grn' && document.getElementById('qtm_req').value == '')
{
	 alert("Please Enter QTM Req");
	 return false;
}

if(pocrn=="")
{
  if(document.getElementById('rmbycim').value.length !=0 || document.getElementById('rmbycim').value.length!='' )
  {
    if(document.getElementById('cimponum').value.length==0)
    {
     alert("Please enter RM PO #");
     return false;
    }
    if(document.getElementById('rmpoline_num').value.length==0)
    {
       alert("Please enter RM PO Line #");
       return false;
    }
  }

  if(document.getElementById('wotype').value == '' && 
  	document.getElementById('pagename').value == 'new_grn')
  {
     alert(" Please Select GRN Classification");
     return false;
  }
  if(document.getElementById('grntype').value == '' && 
  	document.getElementById('pagename').value == 'new_grn')
  {
     alert("Please Select GRN Type");
     return false;
  }
  win1 = window.open("getcim4grn.php?ponum="+temp+"&polinenum="+polinenum+"&wotype="+wotype, param, +
  "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
  ",width=" + winWidth + ",height=" + winHeight +
  ",top="+winTop+",left="+winLeft);
}
else
{
  var ponum="";
  if(document.getElementById('grntype').value == '' && 
  	document.getElementById('pagename').value == 'new_grn')
  {
     alert(" Please Select GRN Type");
     return false;
  }
  if(document.getElementById('wotype').value == '' && 
  	document.getElementById('pagename').value == 'new_grn')
  {
     alert(" Please Select GRN Classification");
     return false;
  }

  var polinenum="";
  win1 = window.open("getcim4grn.php?ponum="+ponum+"&polinenum="+polinenum+"&wotype="+wotype, param, +
  "menubar=0,toolbar=0,resizable=1,scrollbars=1" +
  ",width=" + winWidth + ",height=" + winHeight +
  ",top="+winTop+",left="+winLeft);
}
}

function GetCIM4altcrn(rt) {
//alert(rt);
var param = rt;
var winWidth = 500;
var winHeight = 400;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var ponum="";
//var temp=(ponum.replace(/&+/g,"and")) ;
   // alert(temp);
var polinenum="";
win1 = window.open("getcim4grn.php?ponum="+ponum+"&polinenum="+polinenum, param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function GetCIM4pocrn(rt) 
{
//alert(rt);
var param = rt;
var winWidth = 500;
var winHeight = 400;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
var ponum=document.getElementById('cimponum').value;
var wotype=document.getElementById('wotype').value;
var temp=(ponum.replace(/&+/g,"and")) ;
   // alert(temp);
var polinenum=document.getElementById('rmpoline_num').value;
if(document.getElementById('rmbycim').value.length ==0 && document.getElementById('wotype').value =='Regular' )
	{
alert("Please enter RM by Host");
 return false;
	}
if(document.getElementById('rmbycim').value.length !=0 ||document.getElementById('rmbycim').value.length!='' )
{
if(document.getElementById('cimponum').value.length==0)
{
 alert("Please enter RM PO #");
 return false;
}
if(document.getElementById('rmpoline_num').value.length==0)
{
 alert("Please enter RM PO Line #");
 return false;
}
}

if(document.getElementById('wotype').value == '' && 
	document.getElementById('pagename').value == 'new_grn')
{
   alert(" Please Select GRN Classification");
   return false;
}
if(document.getElementById('grntype').value == '' && 
	document.getElementById('pagename').value == 'new_grn')
{
   alert("Please Select GRN Type");
   return false;
}



//alert(temp+"-----------"+polinenum);
win1 = window.open("getcim4grn.php?ponum="+temp+"&polinenum="+polinenum+"&wotype="+wotype, param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}


function SetCIM(CIM,fieldname)
{
	var CIMarr = CIM.split("|");
	document.forms[0].elements[fieldname].value = CIMarr[0];
	if(document.getElementById('pocrn').value == '')
	{
	  document.getElementById('pocrn').value = CIMarr[0];
	}

	document.getElementById('rm_qty_perbill').value = CIMarr[1];	
	document.getElementById('rm_length').value = CIMarr[2];	
	document.getElementById('rm_dia').value = CIMarr[3];	
	document.getElementById('rm_uom').value = CIMarr[4];
	document.getElementById('rm_width').value = CIMarr[5];
	document.getElementById('rm_thickness').value = CIMarr[6];
	index = document.getElementById('index').value;
	
    if(document.getElementById('pagename').value == 'new_grn' && fieldname == 'crn' && 
	  document.getElementById('grntype').value == 'Regular')
    {
	    var dia=CIMarr[3];
		var length=CIMarr[2];
		var width=CIMarr[5];
		var thickness=CIMarr[6];
		var qty_perbill=CIMarr[1];	

		if(qty_perbill == '' || qty_perbill == '-' || qty_perbill == 'NA')
		{
			   alert('Please Enter Qty/Billet in RMMaster');
			   document.getElementById('crn').value='';			   
			   return false;
		}
	    if(dia != '' &&  dia != '-' && dia != 'NA')
		{			
			/*if(length == '' || length == '-' || length == 'NA')
			{
			   alert('Please Enter Correct Length in RMMaster for Bars/Rod');

			   document.getElementById('crn').value='';			   
			   return false;
			}*/
		}
		else if(dia == '' ||  dia == '-' || dia != 'NA')
		{			
			if(length == '' || length == '-' || length == 'NA')
			{
			   alert('Please Enter Correct Length in RMMaster for Sheet');	
			   document.getElementById('crn').value='';		
			   return false;
			}
			if(width == '' || width == '-' || width == 'NA')
			{
			   alert('Please Enter Correct Width in RMMaster for Sheet');
			   document.getElementById('crn').value='';	
			   return false;
			}
			if(thickness == '' || thickness == '-' || thickness == 'NA')
			{
			   alert('Please Enter Correct Thickness in RMMaster for Sheet');
			   document.getElementById('crn').value='';		
			   return false;
			}
		}
		var um=CIMarr[4].toLowerCase();
		
		for(j=1;j<index;j++)
        {	
		   document.getElementById("qty4billet"+j).readOnly = true;
		   document.getElementById('qty4billet'+j).style.backgroundColor='#DFDFDF';

           //document.getElementById("qty_to_make"+j).readOnly = true;
	       //document.getElementById('qty_to_make'+j).style.backgroundColor='#DFDFDF';

			var qty = 'qty' + j;
			var qty=document.getElementById('qty'+j).value;	
		
			if(dia == '' || dia == '-' || dia == 'NA' )
			{ 				
				if(qty == '')
					 var qtm=''; 
				else
				{
					var qtm=parseInt(qty_perbill)*parseInt(qty);	 
					qtm=parseFloat(qtm).toFixed(2);	
				}
					document.getElementById('qty_to_make'+j).value=qtm;
					document.getElementById('qty4billet'+j).value = qty_perbill;					
					
				if(um == 'mm')		        
					 document.getElementById('uom'+j).value='Meters';		        
				else if(um == 'inches' || um == 'inch')		        
					document.getElementById('uom'+j).value='FEET';		
				else	
					document.getElementById('uom'+j).value='';									
			}
			else
		    {
		         if(qty == '')
			       qtm='';
			     else	
			     {                 
					var new_qty = parseInt(qty)*parseInt(qty_perbill);				
					qtm = (parseInt(document.getElementById('dim1' + j).value)* parseInt(new_qty));					
					qtm=parseFloat(qtm).toFixed(2);
				 }
					document.getElementById('qty_to_make'+j).value=qtm;
					document.getElementById('qty4billet'+j).value = qty_perbill;

					if(um == 'mm')		        
					 document.getElementById('uom'+j).value='Meters';		        
				else if(um == 'inches' || um == 'inch')		        
					document.getElementById('uom'+j).value='FEET';		
				else	
					document.getElementById('uom'+j).value='';			
		    }
		}		
   }

if(document.getElementById('pagename').value == 'grn_swap')
{
var crn=document.getElementById('crn').value;
var to_crn=document.getElementById('altcrn').value;


if(crn !='' && to_crn !='' )
{
  if(crn == to_crn)
	 var diff_crn=crn;
  else
	var diff_crn=to_crn;


    var ajaxRequest;  // The variable that makes Ajax possible!
	try
        {
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	    } 
        catch (e)
        {
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			   }
            catch (e)
               {
				//Something went wrong
				alert("Your browser broke!");
				return false;
		}
		}
	}
//	Create a function that will receive data sent from the server
	 ajaxRequest.onreadystatechange = function(){
	        if(ajaxRequest.readyState == 4)
            {
		      if(ajaxRequest.status == 200)
                      {
		          //alert(crnnum);
		          //alert( ajaxRequest.responseText);
                          document.getElementById('parent_grn').innerHTML = ajaxRequest.responseText;
		      }
	        }
	}
	//alert("Here1");
	ajaxRequest.open("POST", "getparent_grns.php?crn= "+diff_crn,true);
	ajaxRequest.send(null);
	}
}
    if(document.getElementById('pagename').value == 'new_grn' && fieldname == 'crn' && 
	  document.getElementById('grntype').value != 'Regular')
	{
        for(i=1;i<index;i++)
        {
           document.getElementById("qty4billet"+i).readOnly = false;
		   document.getElementById('qty4billet'+i).style.backgroundColor='#FFFFFF';
           document.getElementById("qty_to_make"+i).readOnly = false;
	       document.getElementById('qty_to_make'+i).style.backgroundColor='#FFFFFF';	
		}
	}

	if(document.getElementById('pagename').value == 'newcopy_grn')
    {
		var crn=document.getElementById('crn').value;
		var to_crn=document.getElementById('altcrn').value;
		if(crn !='' && to_crn !='' )
		{
		  if(crn == to_crn)
			 var diff_crn=crn;
		  else
			var diff_crn=to_crn;


			var ajaxRequest;  // The variable that makes Ajax possible!
			try
				{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
				} 
				catch (e)
				{
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					   }
					catch (e)
					   {
						//Something went wrong
						alert("Your browser broke!");
						return false;
				}
				}
			}
		//	Create a function that will receive data sent from the server
			 ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
					  if(ajaxRequest.status == 200)
							  {
						  //alert(crnnum);
						  //alert( ajaxRequest.responseText);
								  document.getElementById('parent_grn').innerHTML = ajaxRequest.responseText;
					  }
					}
			}
			//alert("Here1");
			ajaxRequest.open("POST", "getparent_grns.php?crn= "+diff_crn,true);
			ajaxRequest.send(null);
			}
      }
}

function addRow(id,index,in_d)
{
//alert(in_d);
var x=index;
line_num="line_num"+index;
partnum="partnum"+index;
partdesc="partdesc"+index;
uom="uom"+index;
batchnum="batchnum"+index;
expdate="expdate"+index;
qty="qty"+index;
dim1="dim1"+index;
dim2="dim2"+index;
dim3="dim3"+index;
qty4billet="qty4billet"+index;
qty_rej="qty_rej"+index;
qty_to_make="qty_to_make"+index;
amend_line_num="amend_line_num"+index;
layout_ref="layout_ref"+index;
amendstatus="amendstatus"+index;
noofpieces="noofpieces"+index;
//alert(qty);
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

prevlinenum = "prevlinenum" + index;
lirecnum = "lirecnum" + index;


var cell1 = document.createElement("TD");
cell1.setAttribute("align","center");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","2");
inp1.setAttribute("name",line_num);
inp1.setAttribute("id",line_num);
cell1.appendChild(inp1);

var cell12 = document.createElement("TD");
cell12.setAttribute("align","center");
var inp12 =  document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","6");
inp12.setAttribute("name",partnum);
inp12.setAttribute("id",partnum);
cell12.appendChild(inp12);

var cell13 = document.createElement("TD");
cell13.setAttribute("align","center");
var inp13 =  document.createElement("INPUT");
inp13.setAttribute("type","text");
inp13.setAttribute("size","25");
inp13.setAttribute("name",partdesc);
inp13.setAttribute("id",partdesc);
cell13.appendChild(inp13);

var cell14 = document.createElement("TD");
cell14.setAttribute("align","center");
var inp14 =  document.createElement("INPUT");
inp14.setAttribute("type","text");
inp14.setAttribute("size","6");
inp14.setAttribute("name",batchnum);
inp14.setAttribute("id",batchnum);
cell14.appendChild(inp14);

var cell15 = document.createElement("TD");
cell15.setAttribute("align","center");
var inp15 =  document.createElement("INPUT");
inp15.setAttribute("type","text");
inp15.setAttribute("size","5");
inp15.setAttribute("name",uom);
inp15.setAttribute("id",uom);
cell15.appendChild(inp15);

var cell16 = document.createElement("TD");
cell16.setAttribute("align","center");
var inp16 =  document.createElement("INPUT");
inp16.setAttribute("type","text");
inp16.setAttribute("size","10");
inp16.setAttribute("name",expdate);
inp16.setAttribute("id",expdate);
cell16.appendChild(inp16);

var cell2 = document.createElement("TD");
cell2.setAttribute("align","center");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","3");
inp2.setAttribute("name",qty);
inp2.setAttribute("id",qty);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
cell3.setAttribute("align","center");
inp3.setAttribute("size","5");
inp3.setAttribute("name",dim1);
inp3.setAttribute("id",dim1);
inp3.onblur=function(){getQty(this);};
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
cell4.setAttribute("align","center");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","5");
inp4.setAttribute("name",dim2);
inp4.setAttribute("id",dim2);
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
cell5.setAttribute("align","center");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","5");
inp5.setAttribute("name",dim3);
inp5.setAttribute("id",dim3);
cell5.appendChild(inp5);

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

var cell9 = document.createElement("TD");
cell9.setAttribute("align","center");
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","5");
inp9.setAttribute("name",qty4billet);
inp9.setAttribute("id",qty4billet);
cell9.appendChild(inp9);

var cell6 = document.createElement("TD");
cell6.setAttribute("align","center");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","5");
inp6.setAttribute("name",qty_rej);
inp6.setAttribute("id",qty_rej);
cell6.appendChild(inp6);

var cell8 = document.createElement("TD");
cell8.setAttribute("align","center");
var inp8 = document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","5");
inp8.setAttribute("name",qty_to_make);
inp8.setAttribute("id",qty_to_make);
inp8.onblur = function() {get_total(this);};
cell8.appendChild(inp8);

var cell17 = document.createElement("TD");
cell17.setAttribute("align","center");
var inp17 = document.createElement("INPUT");
inp17.setAttribute("type","text");
inp17.setAttribute("size","2");
inp17.setAttribute("name",amend_line_num);
inp17.setAttribute("id",amend_line_num);
inp17.onblur=function(){getstat(this,index);};
cell17.appendChild(inp17);

var cell18 = document.createElement("TD");
cell18.setAttribute("align","center");
var inp18 = document.createElement("INPUT");
inp18.setAttribute("type","text");
inp18.setAttribute("size","8");
inp18.setAttribute("name",layout_ref);
inp18.setAttribute("id",layout_ref);
cell18.appendChild(inp18);

/*var inp19 = document.createElement("INPUT");
inp19.setAttribute("type","text");
inp19.setAttribute("value","");
inp19.setAttribute("name",amendstatus);
inp19.setAttribute("id",amendstatus);
cell18.appendChild(inp19); */

/*var cell19 = document.createElement("TD");
var inp19 =  document.createElement("select");
inp19.options[0]=new Option("Active", "Active")
inp19.options[inp19.length]=new Option("Inactive", "Inactive")
cell19.setAttribute("align","center");
inp19.setAttribute("size","1");
inp19.setAttribute("name",amendstatus);
inp19.setAttribute("id",amendstatus);
inp19.onblur = function() {get_total(this);};
cell19.appendChild(inp19);*/

var cell20 = document.createElement("TD");
cell20.setAttribute("align","center");
var inp20 = document.createElement("INPUT");
inp20.setAttribute("type","text");
inp20.setAttribute("size","3");
inp20.setAttribute("name",noofpieces);
inp20.setAttribute("id",noofpieces);
inp20.onblur=function(){getQty(this);};
cell20.appendChild(inp20);


/*var cell20 = document.createElement("TD");
var img1 = document.createElement("img");
img1.setAttribute("src","images/bu-getdateicon.gif");
img1.setAttribute("alt","Amend");
img1.onclick = function(){addRow4amend('myTable',index,index);set_req_fields(index);};
//img1.href ("addRow4amend('myTable',document.forms[0].index.value,"+in_d)");
cell20.appendChild(img1); */



row.appendChild(cell1);
row.appendChild(cell17);
row.appendChild(cell18);
row.appendChild(cell12);
row.appendChild(cell13);
row.appendChild(cell14);
row.appendChild(cell15);
row.appendChild(cell16);
row.appendChild(cell20);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell2);
row.appendChild(cell9);
row.appendChild(cell6);
row.appendChild(cell8);
//row.appendChild(cell19);

tbody.appendChild(row);
x++;
//alert("i am here");
document.forms[0].index.value=x;
}

function addRow4grn_issue(id,index){
//alert(index);

var x=index;

line_num="line_no"+index;
iss_date="issdate"+index;
iss_qty="issqty"+index;
iss4wo="iss4wo"+index;
accqty="accqty"+index;
rejqty="rejqty"+index;
retqty="retqty"+index;
balance="balance"+index;

fields =  iss4wo + '_' + iss_date + '_' + iss_qty;

//alert(qty);
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

prevlinenum = "prevlineno" + index;
lirecnum = "lirecno" + index;


var cell1 = document.createElement("TD");
cell1.setAttribute("align","center");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","8");
inp1.setAttribute("name",line_num);
cell1.appendChild(inp1);

var cell4 = document.createElement("TD");
cell4.setAttribute("align","center");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","8");
inp4.setAttribute("name",iss4wo);
inp4.setAttribute("id",iss4wo);
inp4.style.backgroundColor = "#DDDDDD";
inp4.setAttribute("readonly",'readonly');

var img=document.createElement("img");
img.setAttribute("src","images/getwo.gif");
img.setAttribute("value",index)
img.onclick= function() {GetWo('iss4wo'+this.value+'_'+'issdate'+this.value+'_'+'issqty'+this.value);};
cell4.appendChild(inp4);
cell4.appendChild(img);

var cell2 = document.createElement("TD");
cell2.setAttribute("align","center");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","8");
inp2.setAttribute("name",iss_date);
inp2.setAttribute("id",iss_date);
inp2.style.backgroundColor = "#DDDDDD";
inp2.setAttribute("readonly",'readonly');
cell2.appendChild(inp2);


var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
cell3.setAttribute("align","center");
inp3.setAttribute("size","8");
inp3.setAttribute("name",iss_qty);
inp3.setAttribute("id",iss_qty);
inp3.style.backgroundColor = "#DDDDDD";
inp3.setAttribute("readonly",'readonly');
cell3.appendChild(inp3);

var cell5 = document.createElement("TD");
cell5.setAttribute("align","center");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","8");
inp5.setAttribute("name",accqty);

inp5.onblur= function() {getbalance(this,index);};

cell5.appendChild(inp5);

var cell6 = document.createElement("TD");
cell6.setAttribute("align","center");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","8");
inp6.setAttribute("name",rejqty);
cell6.appendChild(inp6);

var cell7 = document.createElement("TD");
cell7.setAttribute("align","center");
var inp7 =  document.createElement("INPUT");
inp7.setAttribute("type","text");
inp7.setAttribute("size","8");
inp7.setAttribute("name",retqty);
inp7.onblur= function() {getbalance1(this,index);};
cell7.appendChild(inp7);

var cell8 = document.createElement("TD");
cell8.setAttribute("align","center");
var inp8 =  document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","8");
inp8.setAttribute("name",balance);
inp8.setAttribute("id",balance);
inp8.style.backgroundColor = "#DDDDDD";
inp8.setAttribute("readonly",'readonly');
cell8.appendChild(inp8);

var inp10 = document.createElement("INPUT");
inp10.setAttribute("type","hidden");
inp10.setAttribute("value","");
inp10.setAttribute("name",prevlinenum);
cell8.appendChild(inp10);

var inp11 = document.createElement("INPUT");
inp11.setAttribute("type","hidden");
inp11.setAttribute("value","");
inp11.setAttribute("name",lirecnum);
cell8.appendChild(inp11)

row.appendChild(cell1);
row.appendChild(cell4);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell5);
row.appendChild(cell6);
row.appendChild(cell7);
row.appendChild(cell8);
tbody.appendChild(row);
x++;
//alert("i am here");
document.forms[0].grniss_index.value=x;
}

function get_total(qty)
{

    total_qty = document.getElementById('total_qty_make');
    index = document.getElementById('index');
    //alert(index.value);
    //total = parseInt(total_qty . value);
     total = 0; total_amend=0;
    for(i=1;i<index.value;i++)
    {//  alert(i);
       //alert('hi');
       var qty_to_make = 'qty_to_make' + i;
       var amend_line_num = 'amend_line_num' + i;
       var amendstatus = 'amendstatus' + i;
       var line_num = 'line_num' + i;
       // alert(qty_to_make);
       qty = document.getElementById(qty_to_make);
       //alert(document.getElementById(amend_line_num).value);
      if(qty.value != '')
       {
         total += parseInt(qty.value);
       }
       if(document.getElementById(amend_line_num).value != '')
       {
          total_amend += parseInt(qty.value);
       }

    }
    
    total_qty.value = (total-total_amend);
   // alert(total_qty.value);
  /*
    if(total_qty.value != '')
      total_qty.value = parseInt(total_qty.value) + parseInt(qty.value);
    else
      total_qty.value = parseInt(qty.value); */
}

function getbalance(qty_acc,index)
{
  // alert(index);
    total_qty = document.getElementById('total_qty_make');
    balance = 'balance' + index;
    retqty = 'retqty' + index;
    bal = document.getElementById(balance);
    ret_qty = document.getElementById(retqty);
    
    if(qty_acc.value == '')
    {
          qty_acc.value == 0;
    }

    if(index == 1)
    {
       if(total_qty.value == '')
       {
          total_qty.value == 0;
       }

       bal.value = parseInt(total_qty.value) - parseInt(qty_acc.value);

    }

    else
    {
       index = index-1;
       newbalance= 'balance' + index;
       newbal = document.getElementById(newbalance);

       if(newbal.value == '')
       {
          newbal.value == 0;
       }

        bal.value = parseInt(newbal.value) - parseInt(qty_acc.value);

    }
     
}


function getbalance1(ret_qty,index)
{
    if(ret_qty.value == '')
    {
          ret_qty.value == 0;
    }

       newbalance= 'balance' + index;
       newbal = document.getElementById(newbalance);

       if(newbal.value == '')
       {
          newbal.value == 0;
       }
    newbal.value = parseInt(newbal.value) + parseInt(ret_qty.value);
}

function GetWo(rt) 
{
//alert(rt);
var param = rt;
var winWidth = 600;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("get_wos.php", param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetWO(wo,woarr,fieldname) 
{
//alert('hi');
//alert(document.forms[0].elements[fieldname]);
//alert(document.forms[0].elements[fieldname + "recnum"]);
var wo = wo.split("|");
var fields = fieldname.split("_");
field1 = fields[0];
field2 = fields[1];
field3 = fields[2];

//alert(field1);
//alert(field2);
//alert(field3);

document.getElementById(field1).value = wo[0];

document.getElementById(field2).value = wo[1];

document.getElementById(field3).value = wo[2];

}
function validate_grn()
{
	if(document.getElementById('wotype').value == 'Regular' || document.getElementById('wotype').value == '')
	{
	liitems = 0;
    //alert("in validate");
	var winWidth = 500;
    var winHeight = 300;
    var winLeft = (screen.width-winWidth)/2;
    var winTop = (screen.height-winHeight)/2;
    var x=1; var count_loop=1;
    var max=document.forms[0].index.value;
    var param = 'Grn';
	grnvalidate = 1;
    total_qty = document.getElementById('total_qty_make');
    index = document.getElementById('index');
    //alert(index.value);
    //total = parseInt(total_qty . value);
     total = 0; total_amend=0;
    for(i=1;i<index.value;i++)
    {
       var qty_to_make = 'qty' + i;
       var amend_line_num = 'amend_line_num' + i;
       var amendstatus = 'amendstatus' + i;
       var line_num = 'line_num' + i;
       qty = document.getElementById(qty_to_make);

      if(qty.value != '')
       {
         total += parseInt(qty.value);
       }
       if(document.getElementById(amend_line_num).value != '')
       {
          total_amend += parseInt(qty.value);
       }

    }
    total_qtyvalue = (total-total_amend);
    
    if(polinenum=='' && document.getElementById('rmbycust').value == '')
{
  alert("Please Enter RM PO Line#");
  return false;
}
      var crn4cmp="";
      var po_num=document.getElementById('cimponum').value;
      var crn_num= document.getElementById('crn').value;
      var pocrn_num= document.getElementById('pocrn').value;
      if(pocrn_num != '')
      {
       crn4cmp=pocrn_num;
      }
      else
      {
       crn4cmp=crn_num;
      }
      //var crn_num= document.getElementById('crn').value;
      var vendrecnum= document.getElementById('vendrecnum').value;
      var rm_spec=document.getElementById('raw_mat_spec').value;
      var rm_type=document.getElementById('raw_mat_type').value;
      var currency=document.getElementById('currency').value;
      var grn_type=document.getElementById('grntype').value;
      var grn_num=document.getElementById('grnnum').value;
      var polinenum=document.getElementById('rmpoline_num').value;
      var maxindex=document.getElementById('index').value;
   // alert(crn4cmp);

    while(x < max)
    {   //alert();
      var linenum= 'line_num'+x;
      var length_po= 'dim1'+x;
      var width_po= 'dim2'+x;
      var thickness= 'dim3'+x;
      var partnum='partnum'+x;
      var amend_linenum='amend_line_num'+x;
      var rm_cost= document.getElementById('rm_cost').value;
      var qty_grn= 'qty'+x;
      var uom='uom'+x;


	if (document.getElementById(linenum).value!="" && document.getElementById(amend_linenum).value =="")
	{
	liitems = 1;
    var temp=(po_num.replace(/&+/g,"and")) ;
    //alert(temp);

       win1 = window.open("getvalidategrn.php?crn=" +crn4cmp+"&po_num="+temp+"&po_line_num="+polinenum+"&grn_qty="+total_qtyvalue+"&length="+document.getElementById(length_po).value+
                         "&width="+document.getElementById(width_po).value+"&thickness="+document.getElementById(thickness).value+"&rm_cost="+rm_cost+"&uom="+document.getElementById(uom).value+
                         "&vendrecnum="+vendrecnum+"&rm_spec="+rm_spec+"&rm_type="+rm_type+"&currency="+currency+"&line_num="+document.getElementById(linenum).value
                         +"&maxnum="+maxindex+"&grntype="+grn_type+"&partnum="+document.getElementById(partnum).value+"&grn_num="+grn_num+"&amendline"+document.getElementById(amend_linenum).value, param,"toolbar=no, location=yes, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width="+winWidth+", height="+winHeight+",left="+winLeft+",top="+winTop);
       /*win1 =window.open("getvalidategrn.php?crn=" +crn_num+"&po_num="+po_num+"&po_line_num="+polinenum+"&grn_qty="+total_qtyvalue+"&length="+document.getElementById(length_po).value+
                         "&width="+document.getElementById(width_po).value+"&thickness="+document.getElementById(thickness).value+"&rm_cost="+rm_cost+"&uom="+document.getElementById(uom).value+
                         "&vendrecnum="+vendrecnum+"&rm_spec="+rm_spec+"&rm_type="+rm_type+"&currency="+currency+"&line_num="+document.getElementById(linenum).value
                         +"&maxnum="+maxindex+"&grntype="+grn_type+"&partnum="+document.getElementById(partnum).value+"&grn_num="+grn_num,"_blank","toolbar=no, location=yes, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width=400, height=300,left="+winLeft+",top="+winTop);  */
							 

    }
	x++;

	}
	//}
	if (liitems == 0)
	{
		alert("At least one line item must be present for validation");
		return false;
	}
	}

}

function Setvalidate_flag(value_flag)
{
   //alert("Val flag is "+value_flag);
   document.getElementById("validate_flag").value=value_flag;
}

function show_diff(grnrecnum)
{
    var winWidth = 820;
    var winHeight = 500;
    var winLeft = (screen.width-winWidth)/2;
    var winTop = (screen.height-winHeight)/2;
    param='grn' ;
	//alert("Here1"+grnrecnum);
	win1 = window.open("rm_grncompare.php?grnrecnum=" +grnrecnum ,param, +
							"toolbar=no, location=yes, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=yes" +
							",width=" + winWidth + ",height=" + winHeight +
							 ",top="+winTop+",left="+winLeft);


}

		function toggleValue(divid,chk)
{
 //alert(chk+"---"+divid);
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
    grnvalidate =1;
    var currentDate = new Date();
   var month =currentDate.getMonth() + 1 ;
   if(month>0 && month < 10)
   {
    var mon_th="0"+month;
    //alert(mon_th);
   }
   else
   {
    var mon_th=month;
   }
   var day = currentDate.getDate() ;
   if(day >1 && day<10)
   {
      var days="0"+day;
      //alert(days);
   }
   else
   {
      var days=day;
   }
   var year = currentDate.getFullYear() ;
   //alert(currentDate.format("yyyy-mm-dd"));
   var DD=year + "-" + mon_th + "-" + days;
   //alert(DD);

   document.getElementById('approval_date').value=DD;
    document.getElementById('userid_app').value=document.getElementById('userid').value;	
  }
 }
 else
 {
   document.getElementById(divid).value="no";
   document.getElementById('approval_date').value="";
    document.getElementById('userid_app').value="";
 }


}

function set_req_fields(in_d,index)
{
  //alert(in_d+"in");
  amendstatus="amendstatus"+in_d;
  amend_line_num="amend_line_num"+in_d;
  document.getElementById(amendstatus).value="Inactive";
  document.getElementById(amend_line_num).value=in_d;
  
}

function addRow4amend(id,index,in_d){
//alert(in_d+"amend");
var x=index;
line_num="line_num"+index;
partnum="partnum"+index;
partdesc="partdesc"+index;
uom="uom"+index;
batchnum="batchnum"+index;
expdate="expdate"+index;
qty="qty"+index;
dim1="dim1"+index;
dim2="dim2"+index;
dim3="dim3"+index;
qty4billet="qty4billet"+index;
qty_rej="qty_rej"+index;
qty_to_make="qty_to_make"+index;
amend_line_num="amend_line_num"+index;
layout_ref="layout_ref"+index;
amendstatus="amendstatus"+index;
//alert(qty);
var tbody = document.getElementById(id).getElementsByTagName("tbody")[0];
var row = document.createElement("TR");
row.style.backgroundColor = "#FFFFFF";

prevlinenum = "prevlinenum" + index;
lirecnum = "lirecnum" + index;


var cell1 = document.createElement("TD");
cell1.setAttribute("align","center");
var inp1 =  document.createElement("INPUT");
inp1.setAttribute("type","text");
inp1.setAttribute("size","2");
inp1.setAttribute("name",line_num);
inp1.setAttribute("id",line_num);
cell1.appendChild(inp1);

var cell12 = document.createElement("TD");
cell12.setAttribute("align","center");
var inp12 =  document.createElement("INPUT");
inp12.setAttribute("type","text");
inp12.setAttribute("size","6");
inp12.setAttribute("name",partnum);
inp12.setAttribute("id",partnum);
cell12.appendChild(inp12);

var cell13 = document.createElement("TD");
cell13.setAttribute("align","center");
var inp13 =  document.createElement("INPUT");
inp13.setAttribute("type","text");
inp13.setAttribute("size","25");
inp13.setAttribute("name",partdesc);
inp13.setAttribute("id",partdesc);
cell13.appendChild(inp13);

var cell14 = document.createElement("TD");
cell14.setAttribute("align","center");
var inp14 =  document.createElement("INPUT");
inp14.setAttribute("type","text");
inp14.setAttribute("size","6");
inp14.setAttribute("name",batchnum);
inp14.setAttribute("id",batchnum);
cell14.appendChild(inp14);

var cell15 = document.createElement("TD");
cell15.setAttribute("align","center");
var inp15 =  document.createElement("INPUT");
inp15.setAttribute("type","text");
inp15.setAttribute("size","5");
inp15.setAttribute("name",uom);
inp15.setAttribute("id",uom);
cell15.appendChild(inp15);

var cell16 = document.createElement("TD");
cell16.setAttribute("align","center");
var inp16 =  document.createElement("INPUT");
inp16.setAttribute("type","text");
inp16.setAttribute("size","10");
inp16.setAttribute("name",expdate);
inp16.setAttribute("id",expdate);
cell16.appendChild(inp16);

var cell2 = document.createElement("TD");
cell2.setAttribute("align","center");
var inp2 =  document.createElement("INPUT");
inp2.setAttribute("type","text");
inp2.setAttribute("size","3");
inp2.setAttribute("name",qty);
inp2.setAttribute("id",qty);
cell2.appendChild(inp2);

var cell3 = document.createElement("TD");
var inp3 =  document.createElement("INPUT");
inp3.setAttribute("type","text");
cell3.setAttribute("align","center");
inp3.setAttribute("size","5");
inp3.setAttribute("name",dim1);
inp3.setAttribute("id",dim1);
cell3.appendChild(inp3);

var cell4 = document.createElement("TD");
cell4.setAttribute("align","center");
var inp4 =  document.createElement("INPUT");
inp4.setAttribute("type","text");
inp4.setAttribute("size","5");
inp4.setAttribute("name",dim2);
inp4.setAttribute("id",dim2);
cell4.appendChild(inp4);

var cell5 = document.createElement("TD");
cell5.setAttribute("align","center");
var inp5 =  document.createElement("INPUT");
inp5.setAttribute("type","text");
inp5.setAttribute("size","5");
inp5.setAttribute("name",dim3);
inp5.setAttribute("id",dim3);
cell5.appendChild(inp5);

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

var cell9 = document.createElement("TD");
cell9.setAttribute("align","center");
var inp9 =  document.createElement("INPUT");
inp9.setAttribute("type","text");
inp9.setAttribute("size","5");
inp9.setAttribute("name",qty4billet);
inp9.setAttribute("id",qty4billet);
cell9.appendChild(inp9);

var cell6 = document.createElement("TD");
cell6.setAttribute("align","center");
var inp6 =  document.createElement("INPUT");
inp6.setAttribute("type","text");
inp6.setAttribute("size","5");
inp6.setAttribute("name",qty_rej);
inp6.setAttribute("id",qty_rej);
cell6.appendChild(inp6);

var cell8 = document.createElement("TD");
cell8.setAttribute("align","center");
var inp8 = document.createElement("INPUT");
inp8.setAttribute("type","text");
inp8.setAttribute("size","5");
inp8.setAttribute("name",qty_to_make);
inp8.setAttribute("id",qty_to_make);
inp8.onblur = function() {get_total(this);};
cell8.appendChild(inp8);

var cell17 = document.createElement("TD");
cell17.setAttribute("align","center");
var inp17 = document.createElement("INPUT");
inp17.setAttribute("type","text");
inp17.setAttribute("size","2");
inp17.setAttribute("value",in_d);
inp17.setAttribute("name",amend_line_num);
inp17.setAttribute("id",amend_line_num);
//inp17.onblur=function(){setAmendstat(in_d,index);}
cell17.appendChild(inp17);

var cell18 = document.createElement("TD");
cell18.setAttribute("align","center");
var inp18 = document.createElement("INPUT");
inp18.setAttribute("type","text");
inp18.setAttribute("size","8");
inp18.setAttribute("name",layout_ref);
inp18.setAttribute("id",layout_ref);
cell18.appendChild(inp18);

var inp19 = document.createElement("INPUT");
inp19.setAttribute("type","text");
inp19.setAttribute("value","");
inp19.setAttribute("name",amendstatus);
inp19.setAttribute("id",amendstatus);
cell18.appendChild(inp19);


var cell20 = document.createElement("TD");
var img1 = document.createElement("img");
img1.setAttribute("src","images/bu-getdateicon.gif");
img1.setAttribute("alt","Amend");
img1.onclick = function(){addRow4amend('myTable',index,in_d);set_req_fields(in_d,index);};
//img1.href ("addRow4amend('myTable',document.forms[0].index.value,"+in_d)");
cell20.appendChild(img1);



row.appendChild(cell1);
row.appendChild(cell17);
row.appendChild(cell18);
row.appendChild(cell12);
row.appendChild(cell13);
row.appendChild(cell14);
row.appendChild(cell15);
row.appendChild(cell16);
row.appendChild(cell2);
row.appendChild(cell3);
row.appendChild(cell4);
row.appendChild(cell5);
row.appendChild(cell9);
row.appendChild(cell6);
row.appendChild(cell8);
row.appendChild(cell20);
tbody.appendChild(row);
x++;
//alert("i am here");
document.forms[0].index.value=x;
}
 function getstat(amend_line_num,index)
 {
  amend_line_num="amend_line_num"+index;
  ln = "line_num" + index;
       //alert(document.getElementById(amend_line_num).value+"-----------");
  lnv = document.getElementById(ln).value;
       //alert(document.getElementById(amend_line_num).value+"-----------");
  amendlnv = document.getElementById(amend_line_num).value;
  //alert(amend_line_num+"-------------"+index);   == '1'
  //alert(document.getElementById('validate_flag').value);
  if(document.getElementById(amend_line_num).value == document.getElementById(ln).value)
  {
    document.getElementById(amend_line_num).value ="";
    alert("Cannot Amend The Same Line\n");

  }
  else
  {
  /*if(document.getElementById(amend_line_num).value !=''&& document.getElementById('status').value != 'Pending' && document.getElementById('validate_flag').value != '1')
  {
    alert("Please set the parent linenum "+document.getElementById(amend_line_num).value+" amend stat to inactive and proceed\n");
  }*/
   if(document.getElementById('status').value == 'Pending' && document.getElementById(amend_line_num).value !='')
  {

    document.getElementById(amend_line_num).value ="";
    //alert("Cannot Amend A pending GRN\n");

  }
  else if (document.getElementById('validate_flag').value == '1')
  {
    document.getElementById(amend_line_num).value ="";
    alert("Cannot Amend A pending GRN\n");
  }
  }
 }
function setAmendstat(in_d,index)
{  //alert();
  amend_line_num="amend_line_num"+in_d;
  amen_line_num4ad="amend_line_num"+index;
  //alert(amen_line_num4ad+"------");
  amendstatus="amendstatus"+in_d;
   // alert(in_d+"inset****************" +document.getElementById(amen_line_num4ad).value.length+"------------"+document.getElementById(amendstatus).value);

  if(document.getElementById(amend_line_num).value != ''&& document.getElementById(amendstatus).value == 'Active')
  {   //alert("HERE====");
   document.getElementById(amendstatus).value="Inactive";

  }
  if(document.getElementById(amend_line_num).value == ''&& document.getElementById(amendstatus).value == 'Inactive')
  {  //alert("HERE====-----------------");
   document.getElementById(amendstatus).value="Active";

  }
  if(document.getElementById(amen_line_num4ad).value == ''&& document.getElementById(amendstatus).value == 'Inactive')
  {  //alert("HERE====-----------------ad3333");
   document.getElementById(amendstatus).value="Active";

  }
   if(document.getElementById(amen_line_num4ad).value != ''&& document.getElementById(amendstatus).value == 'Active')
  {  //alert("HERE====-----------------ad4444");
   document.getElementById(amendstatus).value="Inactive";

  }
  else
  {
    document.getElementById(amendstatus).value="Active";
  }


}

function getQty(dim1)
{
    index = document.getElementById('index').value;
	crn   =   document.getElementById('crn').value; 	
	if(crn == '')
	{
      alert('Please Enter CRN#');
     return false;
	}
	var total_qtm=0;

  if(document.getElementById('grntype').value == 'Regular')
  {
    for(j=1;j<index;j++)
    { 	
       var qty = 'qty' + j;
	   var uom = "uom" + j;    
       var line_num = 'line_num' + j;
       var leng_dim = 'dim1' + j;
       var noofpieces = 'noofpieces' + j;	
	   var qty4bil='qty4billet' +j;
	   var qty_make='qty_to_make' +j;

	   var qty_billet=document.getElementById('rm_qty_perbill').value;
	   var length=document.getElementById('rm_length').value;
	   var uom=document.getElementById('rm_uom').value;
	   var dia=document.getElementById('rm_dia').value;
	   var width=document.getElementById('rm_width').value;
	   var thickness=document.getElementById('rm_thickness').value;

       length_val = document.getElementById(leng_dim);
       nopieces_val = document.getElementById(noofpieces);
       total_qty = document.getElementById(qty);
	   inp_uom = document.getElementById("uom" + j).value;
	   dim11=document.getElementById('dim1'+j);
	   noofpieces1=document.getElementById('noofpieces'+j);	   	

       dim11.value=dim11.value.replace(/[^0-9]/ig,""); 
       noofpieces1.value=noofpieces1.value.replace(/[^0-9]/ig,"");
	   
	   if( (document.getElementById('qty'+j).value != '' || 
		   document.getElementById('dim1'+j).value != '' ) &&
		   document.getElementById('pagename').value == 'edit_grn')
	   {	  
		   document.getElementById('qty4billet'+j).value=qty_billet;
	   } 
	   else if(  document.getElementById('pagename').value == 'new_grn' && 
		   document.getElementById('dim1'+j).value != '')
	   {		 
		   document.getElementById('qty4billet'+j).value=qty_billet;
	   }
	   if((nopieces_val.value == '' || nopieces_val.value == 0) && length_val.value != '')
	   {
		   if(inp_uom == '')
	       {
		     alert("Please Enter UOM for Line# "+j);
			 document.getElementById("uom" + j).focus();	
		     return false;
	       }
		   //total_qty.value='';
		   document.getElementById("qty"+j).readOnly = false;
	       document.getElementById('qty'+j).style.backgroundColor='#FFFFFF';		 
	   }	   
       if((nopieces_val.value != '' && nopieces_val.value != 0) && length_val.value != '')
       {		   
         if(inp_uom == '')
	     {
		    alert("Please Enter UOM for Line# "+j);
			document.getElementById("uom" + j).focus();
		    //document.getElementById(leng_dim).value='';
		    return false;
	     }	   
		 if(document.getElementById('pagename').value == 'grn_swap' || 
			 document.getElementById('pagename').value == 'newcopy_grn')
		 {		
            if(document.getElementById('pagename').value == 'grn_swap')
			 {
                 swap_removereadonly('');				
			 }
			 var qty_billet=document.getElementById('qty4billet'+j).value;			
		 }	
         document.getElementById("qty"+j).readOnly = true;
	     document.getElementById('qty'+j).style.backgroundColor='#DDDDDD';	  
         qty_line = (parseInt(nopieces_val.value)* parseInt(length_val.value));
         total_qty.value = (qty_line);		 
	   }
	   if(nopieces_val.value != '' ||  length_val.value != '')
       {			
		if(dia == '' || dia == '-' || dia == 'NA' )
		{						
			var u=document.getElementById('uom' +j).value;
			var qty=document.getElementById('qty'+j).value;	
			var um=u.toLowerCase();
			var um_rm=uom.toLowerCase();	
	
			if(um_rm == 'mm' &&  um.charAt(0) != 'm')
			{
				 alert('Please provide UOM in Meters');
				 document.getElementById('uom' +j).value='';				
				 document.getElementById('uom' +j).focus();
				 return false;
			}
			else if((um_rm == 'inches' || um_rm == 'inch')&&  um.charAt(0) != 'f')
			{
				 alert('Please provide UOM in FEET');
				 document.getElementById('uom' +j).value='';				
				 document.getElementById('uom' +j).focus();
				 return false;
			}
			if(qty == '')
				 var qtm=0; 
			else
			{				
		        var qtm=parseInt(qty_billet)*parseInt(qty);	 
		        qtm=parseFloat(qtm).toFixed(2);	 
			}
		    document.getElementById('qty_to_make'+j).value=qtm;		  	
		    total_qtm += parseInt(qtm);   
		}
		else
		{ 				
			 var u=document.getElementById('uom' +j).value;
			 var um=u.toLowerCase();
			 var um_rm=uom.toLowerCase();
			 var qty=document.getElementById('qty'+j).value;			
			 
			if(um_rm == 'mm' &&  um.charAt(0) != 'm')
			{
				 alert('Please provide UOM in Meters');
				 document.getElementById('uom' +j).value='';				
				  document.getElementById('uom' +j).focus();
				 return false;
			}
			else if((um_rm == 'inches' || um_rm == 'inch') &&  um.charAt(0) != 'f')
			{
				 alert('Please provide UOM in FEET');
				 document.getElementById('uom' +j).value='';			
				 document.getElementById('uom' +j).focus();
				 return false;
			}	
			 if(qty == '')
				qtm=0;
			 else	
			 {						
			    var new_qty;			
				if(nopieces_val.value != '' && nopieces_val.value != 0)
				 {
					 /*alert("qty per billetis "+qty_billet+'-------'
					 +(parseInt(qty)/1000)+'*'+parseInt(qty_billet));*/
					new_qty = (parseInt(qty)/1000)*parseInt(qty_billet);
					 //alert("new qty is "+new_qty);
					qtyinmtrs = (parseInt(qty)/1000);
					 //alert("qty in mtrs "+qtyinmtrs);
					qtm=new_qty;
					 
				 }
				 else
				 {
					new_qty = parseInt(qty)*parseInt(qty_billet);					
			        qtyinmtrs = (parseInt(qty));
					// qtm = (parseInt(document.getElementById('dim1' + j).value)* parseInt(new_qty));
					qtm=new_qty;
				 }
				qtm=parseFloat(qtm).toFixed(2);
			 }			
			 document.getElementById('qty_to_make'+j).value=qtm;			 
			 document.getElementById('qty'+j).value=qtyinmtrs;
			 total_qtm += parseInt(qtm); 
         

               }
    }
	}
	 document.getElementById('total_qty_make').value=total_qtm;
}
}



function validate_copygrn()
{
	if(document.getElementById('wotype').value == 'Regular' || document.getElementById('wotype').value == '')
	{
	liitemscopy = 0;
    //alert("in validate copy"+liitemscopy);
	var winWidth = 400;
    var winHeight = 300;
    var winLeft = (screen.width-winWidth)/2;
    var winTop = (screen.height-winHeight)/2;
    var x=1; var count_loop=1;
    var max=document.forms[0].index.value;
    var param = 'Grn';
	grnvalidatecopy = 1;
    index = document.getElementById('index');

      var po_num=document.getElementById('cimponum').value;
      var crn_num= document.getElementById('crn').value;
      var vendrecnum= document.getElementById('vendrecnum').value;
      var rm_spec=document.getElementById('raw_mat_spec').value;
      var rm_type=document.getElementById('raw_mat_type').value;
      var currency=document.getElementById('currency').value;
      var grn_type=document.getElementById('grntype').value;
      var grn_num=document.getElementById('grnnum').value;
      var polinenum=document.getElementById('rmpoline_num').value;
      var maxindex=document.getElementById('index').value;
    //alert(x);
   if(crn_num =='')
   {
      alert("Please Enter CRN \n");
      return false;
   }
    while(x < max)
    {   //alert();
      var linenum= 'line_num'+x;
      var length_po= 'dim1'+x;
      var width_po= 'dim2'+x;
      var thickness= 'dim3'+x;
      var partnum='partnum'+x;
      var amend_linenum='amend_line_num'+x;
      var rm_cost= document.getElementById('rm_cost').value;
      var qty_grn= 'qty'+x;
      var uom='uom'+x;
      var amendstatus = 'amendstatus' + x;

     //alert(document.getElementById(linenum).value+"---------------"+document.getElementById(amendstatus).value);
	if (document.getElementById(linenum).value!='' && document.getElementById(amend_linenum).value == '')
	{
	liitemscopy = 1;
    var temp=(po_num.replace(/&+/g,"and")) ;
    //alert("liitemscopy"+liitemscopy);
	win1 = window.open("getvalidatecopygrn.php?crn=" +crn_num+"&po_num="+temp+"&po_line_num="+polinenum+"&length="+document.getElementById(length_po).value+
                         "&width="+document.getElementById(width_po).value+"&thickness="+document.getElementById(thickness).value+"&rm_cost="+rm_cost+"&uom="+document.getElementById(uom).value+
                         "&vendrecnum="+vendrecnum+"&rm_spec="+rm_spec+"&rm_type="+rm_type+"&currency="+currency+"&line_num="+document.getElementById(linenum).value
                         +"&maxnum="+maxindex+"&grntype="+grn_type+"&partnum="+document.getElementById(partnum).value+"&grn_num="+grn_num, param,"toolbar=no, location=yes, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width="+winWidth+", height="+winHeight+",left="+winLeft+",top="+winTop);
       /*win1 =window.open("getvalidategrn.php?crn=" +crn_num+"&po_num="+po_num+"&po_line_num="+polinenum+"&grn_qty="+total_qtyvalue+"&length="+document.getElementById(length_po).value+
                         "&width="+document.getElementById(width_po).value+"&thickness="+document.getElementById(thickness).value+"&rm_cost="+rm_cost+"&uom="+document.getElementById(uom).value+
                         "&vendrecnum="+vendrecnum+"&rm_spec="+rm_spec+"&rm_type="+rm_type+"&currency="+currency+"&line_num="+document.getElementById(linenum).value
                         +"&maxnum="+maxindex+"&grntype="+grn_type+"&partnum="+document.getElementById(partnum).value+"&grn_num="+grn_num,"_blank","toolbar=no, location=yes, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width=400, height=300,left="+winLeft+",top="+winTop);  */


    }
	x++;

	}
	//}
	if (liitemscopy == 0)
	{
		alert("At least one line item must be present for validation");
		return false;
	}
}

}
function Get_all_wo(rt)
{
	if(document.getElementById('grntype').value !='Rework')
	{
		alert("Please select GRN Type :Rework");
		return false;
	}
var wotype=document.getElementById('wotype').value;
var param = rt;
var winWidth = 500;
var winHeight = 400;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getreworkwos4grn.php?wotype="+wotype, param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function Set_woref(wo,woarr,fieldname) 
{
  var wo = wo.split("|");
  document.getElementById('wo_ref').value = wo[0];
  document.getElementById('grnnum').value = wo[2];
  document.getElementById('vendor').value = wo[3];
  document.getElementById('vendrecnum').value = wo[35];

  document.getElementById('raw_mat_spec').value = wo[4];
  document.getElementById('raw_mat_type').value = wo[5];
  document.getElementById('raw_mat_code').value = wo[6]; 
  document.getElementById('coc_refnum').value = wo[7];
  document.getElementById('invoice_num').value = wo[8];
  document.getElementById('invoice_date').value = wo[9];
  document.getElementById('test_report').value = wo[10];
  document.getElementById('recieved_date').value = wo[11];
  document.getElementById('mgp_num').value = wo[12];
  document.getElementById('batch_num').value = wo[13];

  document.getElementById('rmbycim').value = wo[14];
  document.getElementById('rmbycust').value = wo[15];
  document.getElementById('cimponum').value = wo[16];
  document.getElementById('rmpoline_num').value = wo[17];

  document.getElementById('nc_refnum').value = wo[36];
  document.getElementById('pocrn').value = wo[19];
  document.getElementById('crn').value = wo[20];

  document.getElementById('rmempcode').value = wo[21];
  document.getElementById('rmcheckdate').value = wo[22];
  document.getElementById('rm_cost').value = wo[23];
  document.getElementById('remarks').value = wo[24];

  document.getElementById('grnempcode').value = wo[25];
  document.getElementById('grncheckdate').value = wo[26];
  document.getElementById('Quarantined_date').value = wo[27];
  document.getElementById('status').value = wo[28];
  document.getElementById('quarremarks').value = wo[29];
  document.getElementById('conversion_date').value = wo[30];
  document.getElementById('conversion_rate').value = wo[31];
  document.getElementById('balance').value = wo[32];

  var index=document.getElementById('index').value ;
  for(j=1;j<index;j++)
  {
  
  //document.getElementById('qty4billet'+j).value = 1;
  document.getElementById('qty4billet'+j).value = 1;
  document.getElementById('uom'+j).value = wo[34];
  }

          
  var wotype =  wo[37] ;

  if(wotype == 'Assy')
  {

  //var woref = wo[0] +"/" + wo[40];
  var woref = wo[0];
  document.getElementById('wo_ref').value = woref ;
  document.getElementById('assywo_ref').value = wo[52] ;
  document.getElementById('raw_mat_spec').value =wo[4];
  document.getElementById('raw_mat_type').value =wo[5];
  document.getElementById('raw_mat_code').value = '';
  document.getElementById('cimponum').value = '' ;
  document.getElementById('rmbycim').value = '';
  document.getElementById('rmbycust').value = '';
  document.getElementById('vendrecnum').value = wo[38]; 
  document.getElementById('assywoli_recnum').value = wo[39];  
  document.getElementById('manufacturer').value = wo[47];

  var index=document.getElementById('index').value ;
  for(j=1;j<=1;j++)
  {
  document.getElementById('line_num'+j).value = wo[42];
  document.getElementById('partnum'+j).value = wo[43];
  document.getElementById('partdesc'+j).value = wo[44];
  document.getElementById('layout_ref'+j).value = wo[45]; 
  document.getElementById('batchnum'+j).value = wo[46];
  document.getElementById('dim1'+j).value = wo[48];
  document.getElementById('dim2'+j).value = wo[49];
  document.getElementById('dim3'+j).value = wo[50];
  document.getElementById('noofpieces'+j).value = wo[51];
    

  //document.getElementById('qty4billet'+j).value = wo[33];
  document.getElementById('qty4billet'+j).value = 1;
  document.getElementById('uom'+j).value = wo[34];
    if(wo[53] > 0)
    {
    document.getElementById('qty'+j).value = wo[53];
    document.getElementById('qty_to_make'+j).value = wo[53] ; 

    }
  else
    {
    document.getElementById('qty'+j).value = wo[41];
    document.getElementById('qty_to_make'+j).value = wo[41] ;
    }   
  }


  }
}


function onSelectWOType(grn)
{

   var aind = document.forms[0].wotype1.selectedIndex;
   if (aind == 0)
   {
      alert ("Please select a valid WO Type");
      return false;
   }
   document.forms[0].wotype.value = document.forms[0].wotype1[aind].text;
  //document.forms[0].pocrn.value='';
  // document.forms[0].crn.value='';
}



function toggleValue_cad(divid,chk)
{
 //alert(chk+"---"+divid);
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
    grnvalidate =1;
    var currentDate = new Date();
   var month =currentDate.getMonth() + 1 ;
   if(month>0 && month < 10)
   {
    var mon_th="0"+month;
    //alert(mon_th);
   }
   else
   {
    var mon_th=month;
   }
   var day = currentDate.getDate() ;
   if(day >1 && day<10)
   {
      var days="0"+day;
      //alert(days);
   }
   else
   {
      var days=day;
   }
   var year = currentDate.getFullYear() ;
   //alert(currentDate.format("yyyy-mm-dd"));
   var DD=year + "-" + mon_th + "-" + days;
   //alert(DD);

   document.getElementById('cad_approval_date').value=DD;
    document.getElementById('userid_app_cad').value=document.getElementById('userid').value;
  }
 }
 else
 {
   document.getElementById(divid).value="no";
   document.getElementById('cad_approval_date').value="";
    document.getElementById('userid_app_cad').value="";
 }
}

function getparentrecnum(grnarr)
{
	var pagename=document.getElementById('pagename').value;
	var grnarr=grnarr.value;
	var grndet = grnarr.split("|");
	crn=document.getElementById('crn').value;
	to_crn=document.getElementById('altcrn').value;
	if(crn =='')
	{
		alert("Please Enter From CRN");	
		document.location.href = "grn_swap.php";
		return 0;
	}
	if(to_crn =='')
	{
		alert("Please Enter TO CRN");	
		document.location.href = "grn_swap.php";
		return 0;
	}
	if(crn !='' && to_crn != '')
	{
		//alert("in getting parentgrn");
		parentgrnnum=document.getElementById('parentgrnnum').value;
		pocrn=document.getElementById('pocrn').value;
		var parr = parentgrnnum.split("|");
		qtm_req=document.getElementById('qtm_req').value;
		wotype=document.getElementById('wotype').value;
		if(pagename == 'newcopy_grn')
		{
			document.location.href = "newcopy_grn.php?grnrecnum="+grndet[0]+
			"&crn="+crn+"&grnnum="+parr[1]+"&pocrn="+pocrn+'&qtm_req='+qtm_req+'&wotype='+wotype+'&altcrn='+to_crn+'&bal='+grndet[2];
		}
		else
		{
		document.location.href = "grn_swap.php?grnrecnum="+grndet[0]+
			"&crn="+crn+"&grnnum="+parr[1]+"&pocrn="+pocrn+'&qtm_req='+qtm_req+'&wotype='+wotype+'&altcrn='+to_crn+'&bal='+grndet[2];
		}
	}
}

function onchange_qty(i)
{	
	var qty="qty" + i;
	var qty4billet="qty4billet" + i;
	var qty_to_make="qty_to_make" + i;	

	qty1=document.getElementById(qty).value;
	qty4billet1=document.getElementById(qty4billet).value;
	qty_to_make1=document.getElementById(qty_to_make).value;	

	if((qty1 *qty4billet1) > qty_to_make1)
	{
		alert(' (Qty*Qty/Billet)  cannot be greater than QTM');
                document.getElementById(qty).value='';
		return false;
	}
	else
	{

		   var qtm=parseInt(qty1) *parseInt(qty4billet1);
		   document.getElementById(qty_to_make).value=qtm;		
		   document.getElementById('total_qty_make').value=qtm;
	}
}

function getqtm_reqdetails()
{
	if(document.getElementById('parent_grnnum').value != '')
	{
		qtm_req=document.getElementById('qtm_req').value;
		crn=document.getElementById('crn').value;
		grnrecnum=document.getElementById('grnrecnum').value;	
		pocrn=document.getElementById('pocrn').value;	
		wotype=document.getElementById('wotype').value;
		to_crn=document.getElementById('altcrn').value;

        document.location.href = "grn_swap.php?grnrecnum="+grnrecnum+"&crn="+crn+"&pocrn="+pocrn+'&qtm_req='+qtm_req+
			'&grnnum='+document.getElementById('parent_grnnum').value+'&wotype='+wotype+'&altcrn='+to_crn;
	}
}

function getuom(uom)
{
	index = document.getElementById('index').value;
 for(j=1;j<index;j++)
    { 
      var uom1 = document.getElementById('uom'+j);
	  uom1.value=uom1.value.replace(/[^\a-z]/ig,""); 
    }
}

function getqtm_value(j)
{
 index = document.getElementById('index').value;
 if(document.getElementById('grntype').value == 'Regular')
 {
	  
	  var qty_line1=document.getElementById('qty'+j);	  
	  qty_line1.value=qty_line1.value.replace(/[^0-9]/ig,"");
	  var qty_line=document.getElementById('qty'+j).value;

	  var qty_billet=document.getElementById('rm_qty_perbill').value;
	  var length=document.getElementById('rm_length').value;
	  var dia=document.getElementById('rm_dia').value;
	  var uom=document.getElementById('rm_uom').value;
	  var qty4billet=document.getElementById('qty4billet'+j).value;
	  var total_qtm=0;
	  if(document.getElementById('pagename').value =='grn_swap' || 
		  document.getElementById('pagename').value =='newcopy_grn')
      {
		  var qty_billet=document.getElementById('qty4billet'+j).value;
	  }	
	  if(qty4billet == '')
	  {
        alert('Please Enter Qty/Billet');
		document.getElementById('qty4billet'+j).value='';
		document.getElementById('qty_to_make'+j).value='';
		return false;		
	  }
	 
	  if(dia == '' || dia == '-' || dia == 'NA' )
      {		
			var u=document.getElementById('uom' +j).value;
			var um=u.toLowerCase();
			var um_rm=uom.toLowerCase();				
			if(um_rm == 'mm' &&  um.charAt(0) != 'm')
			{
				 alert('Please provide UOM in Meters');
				 document.getElementById('uom' +j).value='';				
				 document.getElementById('uom' +j).focus();
				 return false;
			}
			else if(um_rm == 'inches' &&  um.charAt(0) != 'f')
			{
				 alert('Please provide UOM in FEET');
				 document.getElementById('uom' +j).value='';				
				 document.getElementById('uom' +j).focus();
				 return false;
			}

			if(qty_line == '')
				var qtm=0;
			else
	        {			
		       var qtm=parseInt(qty_billet)*parseInt(qty_line);		
		       qtm=parseFloat(qtm).toFixed(2);
			}
		   document.getElementById('qty_to_make'+j).value=qtm;			  
      }
      else
      { 		
			 var u=document.getElementById('uom' +j).value;
			 var um=u.toLowerCase();
			 var um_rm=uom.toLowerCase();	
			 var qty=document.getElementById('qty'+j).value;			
			if(um_rm == 'mm' &&  um.charAt(0) != 'm')
			{
				 alert('Please provide UOM in Meters');

				 document.getElementById('uom' +j).value='';				 
				 document.getElementById('uom' +j).focus();
				 return false;
			}
			else if(um_rm == 'inches' &&  um.charAt(0) != 'f')
			{
				 alert('Please provide UOM in FEET');
				 document.getElementById('uom' +j).value='';				 
				 document.getElementById('uom' +j).focus();
				 return false;
			}		
			if(qty == '')				
                qtm=0;
			else
	        {  
			  var new_qty;
			  if(document.getElementById('noofpieces' +j).value == '' || 
				  document.getElementById('noofpieces' +j).value == '0')					 
			  {
				  new_qty = parseInt(qty)*parseInt(qty_billet);
				  qtyinmtrs = (parseInt(qty));				
			      //qtm = (parseInt(document.getElementById('dim1' + j).value)* parseInt(new_qty));
				  qtm=new_qty;
			  }
			  else
			  {
				  //new_qty = (parseInt(qty)/1000)*parseInt(qty_billet);
				  //qtyinmtrs = (parseInt(qty)/1000);
				   new_qty = parseInt(qty)*parseInt(qty_billet);
				  qtm=new_qty;
			  }

	          qtm=parseFloat(qtm).toFixed(2);
			}		
			
			document.getElementById('qty_to_make'+j).value=qtm;		
		    document.getElementById('qty'+j).value=qty;	
      }
	  for(j=1;j<index;j++)
      {
        var qty_make='qty_to_make' +j;	
        var qtm=document.getElementById(qty_make).value;		
	    if( parseInt(qtm) != 'NaN' && parseInt(qtm) >0 )
		  {
		   total_qtm += parseInt(qtm);		
		  }
		  else
		  {
			  total_qtm=total_qtm;
		  }

      }	   
	  document.getElementById('total_qty_make').value=total_qtm;
  }

  if(document.getElementById('pagename').value == 'newcopy_grn' )
  {
      for(j=1;j<index;j++)
      {
        var qty_parent='qty_parent' +j;
		var qty='qty' +j;
		var qty4billet='qty4billet' +j;
		var qty4billet_parent='qty4billet_parent' +j;

		var qty_parent1=parseFloat(document.getElementById(qty_parent).value);
		var qty1=parseFloat(document.getElementById(qty).value);
		var qty4billet1=parseFloat(document.getElementById(qty4billet).value);
		var qty4billet_parent1=parseFloat(document.getElementById(qty4billet_parent).value);
/*
		if(qty1 > qty_parent1)
		  {
             alert('Qty should not be greater than original Qty');
			 document.getElementById(qty).value='';

			 return false;
		  }
		  if(qty4billet1 > qty4billet_parent1)
		  {
             alert('Qty/Billet should not be greater ');
			 document.getElementById(qty4billet).value='';
			 return false;
		  }
*/

	  }
  }

}

function swap_removereadonly(ind)
{ 
	   var j = ind;
	   var layoutref = 'layout_ref'+j;
   	   var layout = document.getElementById(layoutref).value;
	   if(layout != '')
	   {
		   document.getElementById('uom'+j ).readOnly =false;
		   document.getElementById('dim1'+j).readOnly =false;
		   document.getElementById('dim2'+j).readOnly =false;
		   document.getElementById('dim3'+j).readOnly =false; 	   
		   document.getElementById('uom'+j ).style.backgroundColor  = '#FFFFFF';
		   document.getElementById('dim2'+j ).style.backgroundColor  = '#FFFFFF';
		   document.getElementById('dim1' +j).style.backgroundColor  = '#FFFFFF';
		   document.getElementById('dim3'+j ).style.backgroundColor  = '#FFFFFF';
		   document.getElementById('qty4billet'+j).readOnly =false; 
		   document.getElementById('qty4billet'+j ).style.backgroundColor  = '#FFFFFF';
	   }
	   else
	   {	
		   document.getElementById('uom'+j ).readOnly =true;
		   document.getElementById('dim1'+j).readOnly =true;
		   document.getElementById('dim2'+j).readOnly =true;
		   document.getElementById('dim3'+j).readOnly =true; 
		   document.getElementById('uom'+j ).style.backgroundColor  = '#DFDFDF';
		   document.getElementById('dim2'+j ).style.backgroundColor  = '#DFDFDF';
		   document.getElementById('dim1'+j ).style.backgroundColor  = '#DFDFDF';
		   document.getElementById('dim3'+j ).style.backgroundColor  = '#DFDFDF';
		   document.getElementById('qty4billet'+j).readOnly =true; 
		   document.getElementById('qty4billet'+j ).style.backgroundColor  = '#DFDFDF';
	   }
}

function check_req_fields4cofc_edit()
{
    //alert ('function working');
	//return false;
	var lipresent = 0;
	var x = 1;
    var errmsg = "";
	var totdispqty = 0
    
    /*if (document.getElementById('relnotenum').value == '')
    {
         errmsg += 'Please enter Rel Note#.\n';
    }*/
    //alert ('inside');
    if (document.forms[0].invnum.value.length == 0)
    {
         errmsg += 'Please enter Invoice #.\n';
    }
    if (document.forms[0].invdate.value.length == 0)
    {
         errmsg += 'Please enter Invoice Date.\n';
    }
 if(isNaN(document.getElementById('numpackages').value) == true)
		{
		   alert('Please Enter number for Packages');
		   document.getElementById('numpackages').value='';
		   return false;
		}
		if(isNaN(document.getElementById('boxnum').value) == true)
		{
		   alert('Please Enter number for BOX');
		   document.getElementById('boxnum').value='';
		   return false;
		}
	

 if (errmsg == '')
        return true;
     else
     {
       alert (errmsg);
       return false;
     }
}


function onSelectGRNType(grn)
{
   var aind = document.forms[0].grntype1.selectedIndex;
   if (aind == 0)
   {
      alert ("Please select a valid Type");
      return false;
   }
   document.forms[0].grntype.value = document.forms[0].grntype1[aind].text;
   // document.getElementById('crn').value='';
   if(document.forms[0].grntype.value == 'Rework' || document.forms[0].grntype.value == 'Rework/BOI')
   {

     if(document.forms[0].wotype.value =='Assy')
     {
      // document.getElementById('crn').style.backgroundColor = "#FFFFFF"; 
      // document.getElementById('crn').readOnly = false;
 
     }
       document.getElementById("supplier").style.visibility = "hidden";
    document.getElementById('raw_mat_spec').style.backgroundColor = "#DFDFDF";  
    document.getElementById('raw_mat_spec').readOnly = true;

    document.getElementById('raw_mat_type').style.backgroundColor = "#DFDFDF";
     document.getElementById('raw_mat_type').readOnly = true;

    document.getElementById('raw_mat_code').style.backgroundColor = "#DFDFDF";
     document.getElementById('raw_mat_code').readOnly = true;

    document.getElementById('coc_refnum').style.backgroundColor = "#DFDFDF";
     document.getElementById('coc_refnum').readOnly = true;

    document.getElementById('invoice_num').style.backgroundColor = "#DFDFDF";
     document.getElementById('raw_mat_spec').readOnly = true;

    document.getElementById("invoice_date1").style.visibility = "hidden";

    document.getElementById('test_report').style.backgroundColor = "#DFDFDF";
     document.getElementById('test_report').readOnly = true;

    document.getElementById("recieved_date1").style.visibility = "hidden";

    document.getElementById('mgp_num').style.backgroundColor = "#DFDFDF";
     document.getElementById('mgp_num').readOnly = true;

    document.getElementById('batch_num').style.backgroundColor = "#DFDFDF";
     document.getElementById('raw_mat_spec').readOnly = true;

    document.getElementById('rmbycim').style.backgroundColor = "#DFDFDF";
     document.getElementById('rmbycim').readOnly = true;

    document.getElementById('rmbycust').style.backgroundColor = "#DFDFDF";
     document.getElementById('raw_mat_spec').readOnly = true;

    document.getElementById('cimponum').style.backgroundColor = "#DFDFDF";
     document.getElementById('cimponum').readOnly = true;

    document.getElementById('rmpoline_num').style.backgroundColor = "#DFDFDF";
     document.getElementById('raw_mat_spec').readOnly = true;

    //document.getElementById('nc_refnum').style.backgroundColor = "#DFDFDF";
    // document.getElementById('nc_refnum').readOnly = true;

    document.getElementById('pocrn').style.backgroundColor = "#DFDFDF";
     document.getElementById('pocrn').readOnly = true;

    document.getElementById("cim").style.visibility = "hidden";

    document.getElementById('rmempcode').style.backgroundColor = "#DFDFDF";
     document.getElementById('raw_mat_spec').readOnly = true;

    document.getElementById('rmcheckdate').style.backgroundColor = "#DFDFDF";
     document.getElementById('rmcheckdate').readOnly = true;

    document.getElementById('rm_cost').style.backgroundColor = "#DFDFDF";
     document.getElementById('raw_mat_spec').readOnly = true;

    document.getElementById("currency").style.visibility = "hidden";

     document.getElementById('remarks').style.backgroundColor = "#FFFFFF";
     document.getElementById('remarks').readOnly = false;

     document.getElementById('grnempcode').style.backgroundColor = "#DFDFDF";
     document.getElementById('grnempcode').readOnly = true;

     document.getElementById("grncheckdate1").style.visibility = "hidden";
     document.getElementById("Quarantined_date1").style.visibility = "hidden";
      document.getElementById("grnstat").style.visibility = "hidden";
      document.getElementById("rmcheckdate1").style.visibility = "hidden";
 document.getElementById("pocrn1").style.visibility = "hidden";

     document.getElementById('quarremarks').style.backgroundColor = "#DFDFDF";
     document.getElementById('quarremarks').readOnly = true;

    document.getElementById("conversion_date1").style.visibility = "hidden";

     document.getElementById('conversion_rate').style.backgroundColor = "#DFDFDF";
    document.getElementById('conversion_rate').readOnly = true;
   }  
   else
  {

  document.getElementById("supplier").style.visibility = "visible";

    document.getElementById('raw_mat_spec').style.backgroundColor = "#FFFFFF";  
    document.getElementById('raw_mat_spec').readOnly = false;

    document.getElementById('raw_mat_type').style.backgroundColor = "#FFFFFF";
     document.getElementById('raw_mat_type').readOnly = false;

    document.getElementById('raw_mat_code').style.backgroundColor = "#FFFFFF";
     document.getElementById('raw_mat_code').readOnly = false;

    document.getElementById('coc_refnum').style.backgroundColor = "#FFFFFF";
     document.getElementById('coc_refnum').readOnly = false;

    document.getElementById('invoice_num').style.backgroundColor = "#FFFFFF";
     document.getElementById('raw_mat_spec').readOnly = false;

    document.getElementById("invoice_date1").style.visibility = "visible";

    document.getElementById('test_report').style.backgroundColor = "#FFFFFF";
     document.getElementById('test_report').readOnly = false;

    document.getElementById("recieved_date1").style.visibility = "visible";

    document.getElementById('mgp_num').style.backgroundColor = "#FFFFFF";
     document.getElementById('mgp_num').readOnly = false;

    document.getElementById('batch_num').style.backgroundColor = "#FFFFFF";
     document.getElementById('raw_mat_spec').readOnly = false;

    document.getElementById('rmbycim').style.backgroundColor = "#FFFFFF";
     document.getElementById('rmbycim').readOnly = false;

    document.getElementById('rmbycust').style.backgroundColor = "#FFFFFF";
     document.getElementById('raw_mat_spec').readOnly = false;

    document.getElementById('cimponum').style.backgroundColor = "#FFFFFF";
     document.getElementById('cimponum').readOnly = false;

    document.getElementById('rmpoline_num').style.backgroundColor = "#DFDFDF";
     document.getElementById('raw_mat_spec').readOnly = false;

    document.getElementById('nc_refnum').style.backgroundColor = "#FFFFFF";
     document.getElementById('nc_refnum').readOnly = false;

    document.getElementById('pocrn').style.backgroundColor = "#FFFFFF";
     document.getElementById('pocrn').readOnly = false;

    // document.getElementById("cim").style.visibility = "visible";

    document.getElementById('rmempcode').style.backgroundColor = "#FFFFFF";
     document.getElementById('raw_mat_spec').readOnly = false;

    document.getElementById('rmcheckdate').style.backgroundColor = "#FFFFFF";
     document.getElementById('rmcheckdate').readOnly = false;

    document.getElementById('rm_cost').style.backgroundColor = "#FFFFFF";
     document.getElementById('raw_mat_spec').readOnly = false;

    document.getElementById("currency").style.visibility = "visible";

     document.getElementById('remarks').style.backgroundColor = "#FFFFFF";
     document.getElementById('remarks').readOnly = false;

     document.getElementById('grnempcode').style.backgroundColor = "#FFFFFF";
     document.getElementById('grnempcode').readOnly = false;

     document.getElementById("grncheckdate1").style.visibility = "visible";
     document.getElementById("Quarantined_date1").style.visibility = "visible";
     document.getElementById("grnstat").style.visibility = "visible";
     document.getElementById("rmcheckdate1").style.visibility = "visible";
       document.getElementById("pocrn1").style.visibility = "visible";

     document.getElementById('quarremarks').style.backgroundColor = "#FFFFFF";
     document.getElementById('quarremarks').readOnly = false;

     document.getElementById("conversion_date1").style.visibility = "visible";

     document.getElementById('conversion_rate').style.backgroundColor = "#FFFFFF";
    document.getElementById('conversion_rate').readOnly = false;
  }
}
