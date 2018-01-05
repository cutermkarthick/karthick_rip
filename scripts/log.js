function searchsort_fields()
{

    var ind = document.forms[0].log_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].logs_oper.value = document.forms[0].log_oper[ind].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;
   
}


function checkenter(event)
{

    var ind = document.forms[0].log_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    document.forms[0].logs_oper.value = document.forms[0].log_oper[ind].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[s1ind].text;

}


