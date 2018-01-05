/*
 * chpassword.js
 * validation for chPassword.php
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam 
 * bmandyam@fluentsoft.com
 */


function check_req_fields()
{
    var errmsg = '';
    if (document.forms[0].userPassword.value.length == 0 ||
        document.forms[0].newpassword.value.length == 0) 
    {
         errmsg = 'Missing Password/New Password\n';
    }
    document.forms[0].userPassword.value = calcMD5(document.forms[0].userPassword.value);
    document.forms[0].newpassword.value = calcMD5(document.forms[0].newpassword.value);

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
   document.forms[0].userName.focus();
}

