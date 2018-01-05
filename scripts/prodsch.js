/*
 * prodsch.js
 * validation for Production Sch
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam
 * bmandyam@fluentsoft.com
*/

function check_req_fields()
{
	var errmsg = '';
    if (document.forms[0].crnnum.value.length == 0)
    {
    //alert ('function working inside');
         errmsg += 'Please enter CRN No. \n';
    }

    if (document.forms[0].quantity.value.length == 0)
    {
         errmsg += 'Please enter quantity\n';
    }
    if (errmsg == '')
        return true;
    else
    {
       alert (errmsg);
       return false;
    }
}
function putfocus()
{
   document.forms[0].crnnum.focus();
}

