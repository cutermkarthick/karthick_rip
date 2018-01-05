function GetDate(rt) {

//alert(rt);
var param = rt;
var winWidth = 300;
var winHeight = 300;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
win1 = window.open("getcalendar.php",param, +
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);
}

function SetDate(dateval,fieldname) {

fn = document.getElementById(fieldname);
fn.value = dateval;

}

function check_req_fields()
{
 var errmsg='';
 if (document.forms[0].stat_flag.value == '0')
 {
      var statindex =  document.getElementById('stat').selectedIndex;
      if(document.getElementById('stat')[statindex].value == 'NC')
      {
        if (document.forms[0].nc.value.length == 0)
        {
             errmsg += 'Please enter NC.\n';
        }
      }
      if(document.getElementById('stat')[statindex].value == 'CUST APPROVED')
      {
        if (document.forms[0].remarks.value.length == 0)
        {
             errmsg += 'Please enter Remarks.\n';
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
