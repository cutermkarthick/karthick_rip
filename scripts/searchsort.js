/*
 * searchsort.js
 * SearchSort for worderSummary.php
 * Copyright (C) FluentSoft Inc.
 * Please contact Badari Mandyam 
 * bmandyam@fluentsoft.com
 */


function searchsort_fields()
{

    var ind = document.forms[0].comp_oper.selectedIndex;
    var s1ind = document.forms[0].sort1.selectedIndex;
    var s2ind = document.forms[0].sort2.selectedIndex;
    document.forms[0].company_oper.value = document.forms[0].comp_oper[ind].text;
    document.forms[0].sortfld1.value = document.forms[0].sort1[ind].text;
    document.forms[0].sortfld2.value = document.forms[0].sort2[ind].text;

}
