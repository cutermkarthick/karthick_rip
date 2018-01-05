var valid = 'n';
function urlencode( str ) {
    // http://kevin.vanzonneveld.net
    // +   original by: Philip Peterson
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: AJ
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // %          note: info on what encoding functions to use from: http://xkr.us/articles/javascript/encode-compare/
    // *     example 1: urlencode('Kevin van Zonneveld!');
    // *     returns 1: 'Kevin+van+Zonneveld%21'
    // *     example 2: urlencode('http://kevin.vanzonneveld.net/');
    // *     returns 2: 'http%3A%2F%2Fkevin.vanzonneveld.net%2F'
    // *     example 3: urlencode('http://www.google.nl/search?q=php.js&ie=utf-8&oe=utf-8&aq=t&rls=com.ubuntu:en-US:unofficial&client=firefox-a');
    // *     returns 3: 'http%3A%2F%2Fwww.google.nl%2Fsearch%3Fq%3Dphp.js%26ie%3Dutf-8%26oe%3Dutf-8%26aq%3Dt%26rls%3Dcom.ubuntu%3Aen-US%3Aunofficial%26client%3Dfirefox-a'
                                     
    var histogram = {}, histogram_r = {}, code = 0, tmp_arr = [];
    var ret = str.toString();
    
    var replacer = function(search, replace, str) {
        var tmp_arr = [];
        tmp_arr = str.split(search);
        return tmp_arr.join(replace);
    };
    
    // The histogram is identical to the one in urldecode.
    histogram['!']   = '%21';
    histogram['%20'] = '+';
    
    // Begin with encodeURIComponent, which most resembles PHP's encoding functions
    ret = encodeURIComponent(ret);
    
    for (search in histogram) {
        replace = histogram[search];
        ret = replacer(search, replace, ret) // Custom replace. No regexing
    }
    
    // Uppercase for full PHP compatibility
    return ret.replace(/(\%([a-z0-9]{2}))/g, function(full, m1, m2) {
        return "%"+m2.toUpperCase();
    });
    
    return ret;
}
/*function validate(ponum)
{
  //alert('function working' + ponum);
  var customer = "";
  customer = document.forms[0].name.value;;
  var partstr = customer;
  var ind = document.forms[0].index.value;
  //alert(ind);

  for(i=1; i<ind; i++)
  {

      //alert(ind);
     var ln="line_num" +i;
	  //var lnv = document.getElementById(ln).value;
	 //alert(lnv);
      if (document.getElementById(ln).value.length != 0)
      {
        pn = "partnum" + i;
        grain = "gf" + i;
        mr = "maxruling" + i;
        alt = "altspec" + i;
        di = "drgiss" + i;
        pi = "partiss" + i;
        cos = "cos_iss" + i;
        mi = "model_iss" + i;

        partstr = partstr + "|" + document.getElementById(pn).value;
        partstr = partstr + ";" + document.getElementById(grain).value;
        partstr = partstr + ";" + document.getElementById(mr).value;
        partstr = partstr + ";" + document.getElementById(alt).value;
        partstr = partstr + ";" + document.getElementById(di).value;
        partstr = partstr + ";" + document.getElementById(pi).value;
        partstr = partstr + ";" + document.getElementById(cos).value;
        partstr = partstr + ";" + document.getElementById(mi).value;
        partstr = partstr + ";" + document.getElementById(ln).value;
      }
   }

var winWidth = 1200;
var winHeight = 600;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
partstr1 = urlencode(partstr);
win1 = window.open("getpartnum.php?ponum=" +  ponum +"&partstr=" + partstr1, "Partvalidation",

+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}*/
function SetRetval(retval) {
//alert(retval);
if(retval=='Ok')
{
  valid = 'y';
  return true;
}
else
  return false;
}

function validate4newpo()
{
  //alert('function working in validate4newpo');
  var customer = "";
  customer = document.forms[0].name.value;;
  var partstr = customer;
  var ind = document.forms[0].index.value;
  //alert(ind);

  for(i=1; i<ind; i++)
  {

      //alert(ind);
     var ln="line_num" +i;
	  //var lnv = document.getElementById(ln).value;
	 //alert(lnv);
      if (document.getElementById(ln).value.length != 0)
      {
        pn = "partnum" + i;
        grain = "gf" + i;
        mr = "maxruling" + i;
        alt = "altspec" + i;
        di = "drgiss" + i;
        pi = "partiss" + i;
        cos = "cos_iss" + i;
        mi = "model_iss" + i;
        partstr = partstr + "|" + document.getElementById(pn).value;
        partstr = partstr + ";" + document.getElementById(grain).value;
        partstr = partstr + ";" + document.getElementById(mr).value;
        partstr = partstr + ";" + document.getElementById(alt).value;
        partstr = partstr + ";" + document.getElementById(di).value;
        partstr = partstr + ";" + document.getElementById(pi).value;
        partstr = partstr + ";" + document.getElementById(cos).value;
        partstr = partstr + ";" + document.getElementById(mi).value;
        partstr = partstr + ";" + document.getElementById(ln).value;
      }



   }

var winWidth = 1200;
var winHeight = 800;
var winLeft = (screen.width-winWidth)/2;
var winTop = (screen.height-winHeight)/2;
partstr1 = urlencode(partstr);
win1 = window.open("getpartnum4new_review.php?&partstr=" + partstr1, "Partvalidation4newpo",

+
"menubar=0,toolbar=0,resizable=1,scrollbars=1" +
",width=" + winWidth + ",height=" + winHeight +
",top="+winTop+",left="+winLeft);

}

        
  
