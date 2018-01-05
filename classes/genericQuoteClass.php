<? 
//====================================
// Author: FSI
// date1,date2,date3,date4,date5-written = June 21, 2005 Jerry George
// Filename: genericClass.php
// Revision: v1.0
//====================================

include_once('loginClass.php');  

class genericQuote{ 

	var    
	$string1,
	$string2,
	$string3,
	$string4,
	$string5,
	 $string6 ,
	 $string7 ,
	 $string8 ,
	 $string9 ,
	 $string10 ,
	 $string11 ,
	 $string12 ,
	 $string13 ,
	 $string14 ,
	 $string15 ,
	 $string16 ,
	 $string17 ,
	 $string18 ,
	 $string19 ,
	 $string20 ,
	 $string21 ,
	 $string22 ,
	 $string23 ,
	 $string24 ,
	 $string25 ,
	 $char1 ,
	 $char2 ,
	 $char3 ,
	 $char4 ,
	 $char5 ,
	 $char6 ,
	 $char7 ,
	 $char8 ,
	 $char9 ,
	 $char10 ,
	 $char11 ,
	 $char12 ,
	 $char13 ,
	 $char14 ,
	 $char15 ,
	 $char16 ,
	 $char17 ,
	 $char18 ,
	 $char19 ,
	 $char20 ,
	 $checkbox1 ,
	 $checkbox2 ,
	 $checkbox3 ,
	 $checkbox4 ,
	 $checkbox5 ,
	 $checkbox6 ,
	 $checkbox7 ,
	 $checkbox8 ,
	 $checkbox9 ,
	 $checkbox10 ,
	 $long1 ,
	 $long2 ,
	 $long3 ,
	 $long4 ,
	 $long5 ,
	 $number1 ,
	 $number2 ,
	 $number3 ,
	 $number4 ,
	 $number5 ,
	 $number6 ,
	 $number7 ,
	 $number8 ,
	 $number9 ,
	 $number10 ,
	 $floatval1 ,
	 $floatval2 ,
	 $floatval3 ,
	 $floatval4 ,
	 $floatval5 ,
	 $floatval6 ,
	 $floatval7 ,
	 $floatval8 ,
	 $floatval9 ,
	 $floatval10 ,
	 $date1 ,
	 $date2 ,
	 $date3 ,
	 $date4 ,
	 $date5 ,
	 $date6 ,
	 $date7 ,
	 $date8 ,
	 $date9 ,
	 $date10 ,
	 $partqty1 ,
	 $partqty2 ,
	 $partqty3 ,
	 $partqty4 ,
	 $partqty5 ,
	 $partqty6 ,
	 $partqty7 ,
	 $partqty8 ,
	 $partqty9 ,
	 $partqty10 ,
	 $part1 ,
	 $part2 ,
	 $part3 ,
	 $part4 ,
	 $part5 ,
	 $part6 ,
	 $part7 ,
	 $part8 ,
	 $part9 ,
	 $part10 ,
	 $qty1 ,
	 $qty2 ,
	 $qty3 ,
	 $qty4 ,
	 $qty5 ,
	 $qty6 ,
	 $qty7 ,
	 $qty8 ,
	 $qty9 ,
	 $qty10 ,
  	 $type;
     
     
        
    // Constructor definition 
    function genericQuote() { 
	$this->string1 = '';
	$this->string2 = '';
	$this->string3 = '';
	$this->string4 = '';
	$this->string5 = ''; 
	 $this->string6 = ''; 
	 $this->string7 = ''; 
	 $this->string8 = ''; 
	 $this->string9 = ''; 
	 $this->string10 = ''; 
	 $this->string11 = ''; 
	 $this->string12 = ''; 
	 $this->string13 = ''; 
	 $this->string14 = ''; 
	 $this->string15 = ''; 
	 $this->string16 = ''; 
	 $this->string17 = ''; 
	 $this->string18 = ''; 
	 $this->string19 = ''; 
	 $this->string20 = ''; 
	 $this->string21 = ''; 
	 $this->string22 = ''; 
	 $this->string23 = ''; 
	 $this->string24 = ''; 
	 $this->string25 = ''; 
	 $this->char1 = ''; 
	 $this->char2 = ''; 
	 $this->char3 = ''; 
	 $this->char4 = ''; 
	 $this->char5 = ''; 
	 $this->char6 = ''; 
	 $this->char7 = ''; 
	 $this->char8 = ''; 
	 $this->char9 = ''; 
	 $this->char10 = ''; 
	 $this->char11 = ''; 
	 $this->char12 = ''; 
	 $this->char13 = ''; 
	 $this->char14 = ''; 
	 $this->char15 = ''; 
	 $this->char16 = ''; 
	 $this->char17 = ''; 
	 $this->char18 = ''; 
	 $this->char19 = ''; 
	 $this->char20 = ''; 
	 $this->checkbox1 = ''; 
	 $this->checkbox2 = ''; 
	 $this->checkbox3 = ''; 
	 $this->checkbox4 = ''; 
	 $this->checkbox5 = ''; 
	 $this->checkbox6 = ''; 
	 $this->checkbox7 = ''; 
	 $this->checkbox8 = ''; 
	 $this->checkbox9 = ''; 
	 $this->checkbox10 = ''; 
	 $this->long1 = ''; 
	 $this->long2 = ''; 
	 $this->long3 = ''; 
	 $this->long4 = ''; 
	 $this->long5 = ''; 
	 $this->number1 = ''; 
	 $this->number2 = ''; 
	 $this->number3 = ''; 
	 $this->number4 = ''; 
	 $this->number5 = ''; 
	 $this->number6 = ''; 
	 $this->number7 = ''; 
	 $this->number8 = ''; 
	 $this->number9 = ''; 
	 $this->number10 = ''; 
	 $this->floatval1 = ''; 
	 $this->floatval2 = ''; 
	 $this->floatval3 = ''; 
	 $this->floatval4 = ''; 
	 $this->floatval5 = ''; 
	 $this->floatval6 = ''; 
	 $this->floatval7 = ''; 
	 $this->floatval8 = ''; 
	 $this->floatval9 = ''; 
	 $this->floatval10 = ''; 
	 $this->date1 = ''; 
	 $this->date2 = ''; 
	 $this->date3 = ''; 
	 $this->date4 = ''; 
	 $this->date5 = ''; 
	 $this->date6 = ''; 
	 $this->date7 = ''; 
	 $this->date8 = ''; 
	 $this->date9 = ''; 
	 $this->date10 = ''; 
	 $this->partqty1 = ''; 
	 $this->partqty2 = ''; 
	 $this->partqty3 = ''; 
	 $this->partqty4 = ''; 
	 $this->partqty5 = ''; 
	 $this->partqty6 = ''; 
	 $this->partqty7 = ''; 
	 $this->partqty8 = ''; 
	 $this->partqty9 = ''; 
	 $this->partqty10 = ''; 
	 $this->part1 = ''; 
	 $this->part2 = ''; 
	 $this->part3 = ''; 
	 $this->part4 = ''; 
	 $this->part5 = ''; 
	 $this->part6 = ''; 
	 $this->part7 = ''; 
	 $this->part8 = ''; 
	 $this->part9 = ''; 
	 $this->part10 = ''; 
	 $this->qty1 = ''; 
	 $this->qty2 = ''; 
	 $this->qty3 = ''; 
	 $this->qty4 = ''; 
	 $this->qty5 = ''; 
	 $this->qty6 = ''; 
	 $this->qty7 = ''; 
	 $this->qty8 = ''; 
	 $this->qty9 = ''; 
	 $this->qty10 = ''; 

                $this->type = '';
     } 
     
    // Property get and set
    function getstring1() {
           return $this->string1;
    }

    function setstring1($reqstring1) {

           $this->string1 = $reqstring1;
    }

    function getstring2() {
           return $this->string2;
    }

    function setstring2 ($reqstring2) {

           $this->string2 = $reqstring2;
    }

    function getstring3() {
           return $this->string3;
    }

    function setstring3 ($reqstring3) {

           $this->string3 = $reqstring3;
    }
    function getstring4() {
           return $this->string4;
    }

    function setstring4 ($reqstring4) {

           $this->string4 = $reqstring4;
    }

    function getstring5() {
           return $this->string5;
    }

    function setstring5 ($reqstring5) {

           $this->string5 = $reqstring5;
    }
    function getstring6() {
           return $this->string6;
    }

    function setstring6($reqstring6) {

           $this->string6 = $reqstring6;
    }

    function getstring7() {
           return $this->string7;
    }

    function setstring7 ($reqstring7) {

           $this->string7 = $reqstring7;
    }

    function getstring8() {
           return $this->string8;
    }

    function setstring8 ($reqstring8) {

           $this->string8 = $reqstring8;
    }
    function getstring9() {
           return $this->string9;
    }

    function setstring9 ($reqstring9) {

           $this->string9 = $reqstring9;
    }

    function getstring10() {
           return $this->string10;
    }

    function setstring10 ($reqstring10) {

           $this->string10 = $reqstring10;
    }

    function setstring11($reqstring11) {

           $this->string11 = $reqstring11;
    }

    function getstring12() {
           return $this->string12;
    }

    function setstring12 ($reqstring12) {

           $this->string12 = $reqstring12;
    }

    function getstring13() {
           return $this->string13;
    }

    function setstring13 ($reqstring13) {

           $this->string13 = $reqstring13;
    }
    function getstring14() {
           return $this->string4;
    }

    function setstring14 ($reqstring14) {

           $this->string14 = $reqstring14;
    }

    function getstring15() {
           return $this->string15;
    }

    function setstring15 ($reqstring15) {

           $this->string15 = $reqstring15;
    }
    function getstring16() {
           return $this->string16;
    }

    function setstring16($reqstring16) {

           $this->string16 = $reqstring16;
    }

    function getstring17() {
           return $this->string17;
    }

    function setstring17 ($reqstring17) {

           $this->string17 = $reqstring17;
    }

    function getstring18() {
           return $this->string18;
    }

    function setstring18 ($reqstring18) {

           $this->string18 = $reqstring18;
    }
    function getstring19() {
           return $this->string19;
    }

    function setstring19 ($reqstring19) {

           $this->string19 = $reqstring19;
    }

    function getstring20() {
           return $this->string20;
    }

    function setstring20 ($reqstring20) {

           $this->string20 = $reqstring20;
    }

    function getstring21() {
           return $this->string21;
    }

    function setstring21($reqstring21) {

           $this->string21 = $reqstring21;
    }

    function getstring22() {
           return $this->string22;
    }

    function setstring22 ($reqstring22) {

           $this->string22 = $reqstring22;
    }

    function getstring23() {
           return $this->string23;
    }

    function setstring23 ($reqstring23) {

           $this->string23 = $reqstring23;
    }
    function getstring24() {
           return $this->string24;
    }

    function setstring24 ($reqstring24) {

           $this->string24 = $reqstring24;
    }

    function getstring25() {
           return $this->string25;
    }

    function setstring25 ($reqstring25) {

           $this->string25 = $reqstring25;
    }


    function getchar1() {
           return $this->char1;
    }

    function setchar1($reqchar1) {

           $this->char1 = $reqchar1;
    }

    function getchar2() {
           return $this->char2;
    }

    function setchar2 ($reqchar2) {

           $this->char2 = $reqchar2;
    }

    function getchar3() {
           return $this->char3;
    }

    function setchar3 ($reqchar3) {

           $this->char3 = $reqchar3;
    }
    function getchar4() {
           return $this->char4;
    }

    function setchar4 ($reqchar4) {

           $this->char4 = $reqchar4;
    }

    function getchar5() {
           return $this->char5;
    }

    function setchar5 ($reqchar5) {

           $this->char5 = $reqchar5;
    }
    function getchar6() {
           return $this->char6;
    }

    function setchar6($reqchar6) {

           $this->char6 = $reqchar6;
    }

    function getchar7() {
           return $this->char7;
    }

    function setchar7 ($reqchar7) {

           $this->char7 = $reqchar7;
    }

    function getchar8() {
           return $this->char8;
    }

    function setchar8 ($reqchar8) {

           $this->char8 = $reqchar8;
    }
    function getchar9() {
           return $this->char9;
    }

    function setchar9 ($reqchar9) {

           $this->char9 = $reqchar9;
    }

    function getchar10() {
           return $this->char10;
    }

    function setchar10 ($reqchar10) {

           $this->char10 = $reqchar10;
    }

    function setchar11($reqchar11) {

           $this->char11 = $reqchar11;
    }

    function getchar12() {
           return $this->char12;
    }

    function setchar12 ($reqchar12) {

           $this->char12 = $reqchar12;
    }

    function getchar13() {
           return $this->char13;
    }

    function setchar13 ($reqchar13) {

           $this->char13 = $reqchar13;
    }
    function getchar14() {
           return $this->char4;
    }

    function setchar14 ($reqchar14) {

           $this->char14 = $reqchar14;
    }

    function getchar15() {
           return $this->char15;
    }

    function setchar15 ($reqchar15) {

           $this->char15 = $reqchar15;
    }
    function getchar16() {
           return $this->char16;
    }

    function setchar16($reqchar16) {

           $this->char16 = $reqchar16;
    }

    function getchar17() {
           return $this->char17;
    }

    function setchar17 ($reqchar17) {

           $this->char17 = $reqchar17;
    }

    function getchar18() {
           return $this->char18;
    }

    function setchar18 ($reqchar18) {

           $this->char18 = $reqchar18;
    }
    function getchar19() {
           return $this->char19;
    }

    function setchar19 ($reqchar19) {

           $this->char19 = $reqchar19;
    }

    function getchar20() {
           return $this->char20;
    }

    function setchar20 ($reqchar20) {

           $this->char20 = $reqchar20;
    }


    function getnumber1() {
           return $this->number1;
    }

    function setnumber1 ($reqnumber1) {
           $this->number1 = $reqnumber1;
    }
     function getnumber2() {
           return $this->number2;
    }

    function setnumber2 ($reqnumber2) {
           $this->number2 = $reqnumber2;
    }
    function getnumber3() {
           return $this->number3;
    }

    function setnumber3 ($reqnumber3) {
           $this->number3 = $reqnumber3;
    }
    function getnumber4() {
           return $this->number4;
    }

    function setnumber4 ($reqnumber4) {
           $this->number4 = $reqnumber4;
    }
    function getnumber5() {
           return $this->number5;
    }

    function setnumber5 ($reqnumber5) {
           $this->number5 = $reqnumber5;
    }
   function setnumber6 ($reqnumber6) {
           $this->number6 = $reqnumber6;
    }
     function getnumber7() {
           return $this->number7;
    }

    function setnumber7 ($reqnumber7) {
           $this->number7 = $reqnumber7;
    }
    function getnumber8() {
           return $this->number8;
    }

    function setnumber8 ($reqnumber8) {
           $this->number8 = $reqnumber8;
    }
    function getnumber9() {
           return $this->number9;
    }

    function setnumber9 ($reqnumber9) {
           $this->number9 = $reqnumber9;
    }
    function getnumber10() {
           return $this->number10;
    }

    function setnumber10 ($reqnumber10) {
           $this->number10 = $reqnumber10;
    }

    function getfloatval1() {
           return $this->floatval1;
    }

    function setfloatval1 ($reqfloatval1) {
           $this->floatval1 = $reqfloatval1;
    }
     function getfloatval2() {
           return $this->floatval2;
    }

    function setfloatval2 ($reqfloatval2) {
           $this->floatval2 = $reqfloatval2;
    }
    function getfloatval3() {
           return $this->floatval3;
    }

    function setfloatval3 ($reqfloatval3) {
           $this->floatval3 = $reqfloatval3;
    }
    function getfloatval4() {
           return $this->floatval4;
    }

    function setfloatval4 ($reqfloatval4) {
           $this->floatval4 = $reqfloatval4;
    }
    function getfloatval5() {
           return $this->floatval5;
    }

    function setfloatval5 ($reqfloatval5) {
           $this->floatval5 = $reqfloatval5;
    }
   function setfloatval6 ($reqfloatval6) {
           $this->floatval6 = $reqfloatval6;
    }
     function getfloatval7() {
           return $this->floatval7;
    }

    function setfloatval7 ($reqfloatval7) {
           $this->floatval7 = $reqfloatval7;
    }
    function getfloatval8() {
           return $this->floatval8;
    }

    function setfloatval8 ($reqfloatval8) {
           $this->floatval8 = $reqfloatval8;
    }
    function getfloatval9() {
           return $this->floatval9;
    }

    function setfloatval9 ($reqfloatval9) {
           $this->floatval9 = $reqfloatval9;
    }
    function getfloatval10() {
           return $this->floatval10;
    }

    function setfloatval10 ($reqfloatval10) {
           $this->floatval10 = $reqfloatval10;
    }

    function setcheckbox1 ($reqcheckbox1) {
           $this->checkbox1 = $reqcheckbox1;
    }
     function getcheckbox2() {
           return $this->checkbox2;
    }

    function setcheckbox2 ($reqcheckbox2) {
           $this->checkbox2 = $reqcheckbox2;
    }
    function getcheckbox3() {
           return $this->checkbox3;
    }

    function setcheckbox3 ($reqcheckbox3) {
           $this->checkbox3 = $reqcheckbox3;
    }
    function getcheckbox4() {
           return $this->checkbox4;
    }

    function setcheckbox4 ($reqcheckbox4) {
           $this->checkbox4 = $reqcheckbox4;
    }
    function getcheckbox5() {
           return $this->checkbox5;
    }

    function setcheckbox5 ($reqcheckbox5) {
           $this->checkbox5 = $reqcheckbox5;
    }
   function setcheckbox6 ($reqcheckbox6) {
           $this->checkbox6 = $reqcheckbox6;
    }
     function getcheckbox7() {
           return $this->checkbox7;
    }

    function setcheckbox7 ($reqcheckbox7) {
           $this->checkbox7 = $reqcheckbox7;
    }
    function getcheckbox8() {
           return $this->checkbox8;
    }

    function setcheckbox8 ($reqcheckbox8) {
           $this->checkbox8 = $reqcheckbox8;
    }
    function getcheckbox9() {
           return $this->checkbox9;
    }

    function setcheckbox9 ($reqcheckbox9) {
           $this->checkbox9 = $reqcheckbox9;
    }
    function getcheckbox10() {
           return $this->checkbox10;
    }

    function setcheckbox10 ($reqcheckbox10) {
           $this->checkbox10 = $reqcheckbox10;
    }


    function setdate1 ($reqdate1) {
           $this->date1 = $reqdate1;
    }
     function getdate2() {
           return $this->date2;
    }

    function setdate2 ($reqdate2) {
           $this->date2 = $reqdate2;
    }
    function getdate3() {
           return $this->date3;
    }

    function setdate3 ($reqdate3) {
           $this->date3 = $reqdate3;
    }
    function getdate4() {
           return $this->date4;
    }

    function setdate4 ($reqdate4) {
           $this->date4 = $reqdate4;
    }
    function getdate5() {
           return $this->date5;
    }

    function setdate5 ($reqdate5) {
           $this->date5 = $reqdate5;
    }
   function setdate6 ($reqdate6) {
           $this->date6 = $reqdate6;
    }
     function getdate7() {
           return $this->date7;
    }

    function setdate7 ($reqdate7) {
           $this->date7 = $reqdate7;
    }
    function getdate8() {
           return $this->date8;
    }

    function setdate8 ($reqdate8) {
           $this->date8 = $reqdate8;
    }
    function getdate9() {
           return $this->date9;
    }

    function setdate9 ($reqdate9) {
           $this->date9 = $reqdate9;
    }
    function getdate10() {
           return $this->date10;
    }

    function setdate10 ($reqdate10) {
           $this->date10 = $reqdate10;
    }

    function setlong1 ($reqlong1) {
           $this->long1 = $reqlong1;
    }
     function getlong2() {
           return $this->long2;
    }

    function setlong2 ($reqlong2) {
           $this->long2 = $reqlong2;
    }
    function getlong3() {
           return $this->long3;
    }

    function setlong3 ($reqlong3) {
           $this->long3 = $reqlong3;
    }
    function getlong4() {
           return $this->long4;
    }

    function setlong4 ($reqlong4) {
           $this->long4 = $reqlong4;
    }
    function getlong5() {
           return $this->long5;
    }

    function setlong5 ($reqlong5) {
           $this->long5 = $reqlong5;
    }

  function gettype() {
           return $this->type;
    }

    function settype ($reqtype) {
           $this->type = $reqtype;
    }
    function setpartqty1 ($reqpartqty1) {
           $this->partqty1 = $reqpartqty1;
    }
     function getpartqty2() {
           return $this->partqty2;
    }

    function setpartqty2 ($reqpartqty2) {
           $this->partqty2 = $reqpartqty2;
    }
    function getpartqty3() {
           return $this->partqty3;
    }

    function setpartqty3 ($reqpartqty3) {
           $this->partqty3 = $reqpartqty3;
    }
    function getpartqty4() {
           return $this->partqty4;
    }

    function setpartqty4 ($reqpartqty4) {
           $this->partqty4 = $reqpartqty4;
    }
    function getpartqty5() {
           return $this->partqty5;
    }

    function setpartqty5 ($reqpartqty5) {
           $this->partqty5 = $reqpartqty5;
    }
   function setpartqty6 ($reqpartqty6) {
           $this->partqty6 = $reqpartqty6;
    }
     function getpartqty7() {
           return $this->partqty7;
    }

    function setpartqty7 ($reqpartqty7) {
           $this->partqty7 = $reqpartqty7;
    }
    function getpartqty8() {
           return $this->partqty8;
    }

    function setpartqty8 ($reqpartqty8) {
           $this->partqty8 = $reqpartqty8;
    }
    function getpartqty9() {
           return $this->partqty9;
    }

    function setpartqty9 ($reqpartqty9) {
           $this->partqty9 = $reqpartqty9;
    }
    function getpartqty10() {
           return $this->partqty10;
    }

    function setpartqty10 ($reqpartqty10) {
           $this->partqty10 = $reqpartqty10;
    }

    function setqty1 ($reqqty1) {
           $this->qty1 = $reqqty1;
    }
     function getqty2() {
           return $this->qty2;
    }

    function setqty2 ($reqqty2) {
           $this->qty2 = $reqqty2;
    }
    function getqty3() {
           return $this->qty3;
    }

    function setqty3 ($reqqty3) {
           $this->qty3 = $reqqty3;
    }
    function getqty4() {
           return $this->qty4;
    }

    function setqty4 ($reqqty4) {
           $this->qty4 = $reqqty4;
    }
    function getqty5() {
           return $this->qty5;
    }

    function setqty5 ($reqqty5) {
           $this->qty5 = $reqqty5;
    }
   function setqty6 ($reqqty6) {
           $this->qty6 = $reqqty6;
    }
     function getqty7() {
           return $this->qty7;
    }

    function setqty7 ($reqqty7) {
           $this->qty7 = $reqqty7;
    }
    function getqty8() {
           return $this->qty8;
    }

    function setqty8 ($reqqty8) {
           $this->qty8 = $reqqty8;
    }
    function getqty9() {
           return $this->qty9;
    }

    function setqty9 ($reqqty9) {
           $this->qty9 = $reqqty9;
    }
    function getqty10() {
           return $this->qty10;
    }

    function setqty10 ($reqqty10) {
           $this->qty10 = $reqqty10;
    }
    function setpart1 ($reqpart1) {
           $this->part1 = $reqpart1;
    }
     function getpart2() {
           return $this->part2;
    }

    function setpart2 ($reqpart2) {
           $this->part2 = $reqpart2;
    }
    function getpart3() {
           return $this->part3;
    }

    function setpart3 ($reqpart3) {
           $this->part3 = $reqpart3;
    }
    function getpart4() {
           return $this->part4;
    }

    function setpart4 ($reqpart4) {
           $this->part4 = $reqpart4;
    }
    function getpart5() {
           return $this->part5;
    }

    function setpart5 ($reqpart5) {
           $this->part5 = $reqpart5;
    }
   function setpart6 ($reqpart6) {
           $this->part6 = $reqpart6;
    }
     function getpart7() {
           return $this->part7;
    }

    function setpart7 ($reqpart7) {
           $this->part7 = $reqpart7;
    }
    function getpart8() {
           return $this->part8;
    }

    function setpart8 ($reqpart8) {
           $this->part8 = $reqpart8;
    }
    function getpart9() {
           return $this->part9;
    }

    function setpart9 ($reqpart9) {
           $this->part9 = $reqpart9;
    }
    function getpart10() {
           return $this->part10;
    }

    function setpart10 ($reqpart10) {
           $this->part10 = $reqpart10;
    }


    function addgenericQuote() { 
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";
        $result = mysql_query($sql);
        $sql = "select nxtnum from seqnum where tablename = 'generic_quote' for update";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("seqnum access failed for genericQuote  ..Please report to Sysadmin. " . mysql_error()); 
        }
        $myrow = mysql_fetch_row($result);
        $seqnum= $myrow[0];
        $objid = $seqnum + 1;

        $string1="'" . $this->string1. "'";
        $string2="'" . $this->string2. "'";
        $string3="'" . $this->string3. "'";
        $string4="'" . $this->string4. "'";
        $string5="'" . $this->string5. "'";
        $string6="'" . $this->string6. "'";
        $string7="'" . $this->string7. "'";
        $string8="'" . $this->string8. "'";
        $string9="'" . $this->string9. "'";
        $string10="'" . $this->string10. "'";
        $string11="'" . $this->string11. "'";
        $string12="'" . $this->string12. "'";
        $string13="'" . $this->string13. "'";
        $string14="'" . $this->string14. "'";
        $string15="'" . $this->string15. "'";
        $string16="'" . $this->string16. "'";
        $string17="'" . $this->string17. "'";
        $string18="'" . $this->string18. "'";
        $string19="'" . $this->string19. "'";
        $string20="'" . $this->string20. "'";
        $string21="'" . $this->string21. "'";
        $string22="'" . $this->string22. "'";
        $string23="'" . $this->string23. "'";
        $string24="'" . $this->string24. "'";
        $string25="'" . $this->string25. "'";

        $char1="'" . $this->char1. "'";
        $char2="'" . $this->char2. "'";
        $char3="'" . $this->char3. "'";
        $char4="'" . $this->char4. "'";
        $char5="'" . $this->char5. "'";
        $char6="'" . $this->char6. "'";
        $char7="'" . $this->char7. "'";
        $char8="'" . $this->char8. "'";
        $char9="'" . $this->char9. "'";
        $char10="'" . $this->char10. "'";
        $char11="'" . $this->char11. "'";
        $char12="'" . $this->char12. "'";
        $char13="'" . $this->char13. "'";
        $char14="'" . $this->char14. "'";
        $char15="'" . $this->char15. "'";
        $char16="'" . $this->char16. "'";
        $char17="'" . $this->char17. "'";
        $char18="'" . $this->char18. "'";
        $char19="'" . $this->char19. "'";
        $char20="'" . $this->char20. "'";

        $number1=$this->number1;
        $number2=$this->number2;
        $number3=$this->number3;
        $number4=$this->number4;
        $number5=$this->number5;
        $number6=$this->number6;
        $number7=$this->number7;
        $number8=$this->number8;
        $number9=$this->number9;
        $number10=$this->number10;

        $floatval1=$this->floatval1;
        $floatval2=$this->floatval2;
        $floatval3=$this->floatval3;
        $floatval4=$this->floatval4;
        $floatval5=$this->floatval5;
        $floatval6=$this->floatval6;
        $floatval7=$this->floatval7;
        $floatval8=$this->floatval8;
        $floatval9=$this->floatval9;
        $floatval10=$this->floatval10;

        $checkbox1="'" . $this->checkbox1. "'";
        $checkbox2="'" . $this->checkbox2. "'";
        $checkbox3="'" . $this->checkbox3. "'";
        $checkbox4="'" . $this->checkbox4. "'";
        $checkbox5="'" . $this->checkbox5. "'";
        $checkbox6="'" . $this->checkbox6. "'";
        $checkbox7="'" . $this->checkbox7. "'";
        $checkbox8="'" . $this->checkbox8. "'";
        $checkbox9="'" . $this->checkbox9. "'";
        $checkbox10="'" . $this->checkbox10. "'";

        $date1="'" . $this->date1. "'";
        $date2="'" . $this->date2. "'";
        $date3="'" . $this->date3. "'";
        $date4="'" . $this->date4. "'";
        $date5="'" . $this->date5. "'";
        $date6="'" . $this->date6. "'";
        $date7="'" . $this->date7. "'";
        $date8="'" . $this->date8. "'";
        $date9="'" . $this->date9. "'";
        $date10="'" . $this->date10. "'";

        $long1="'" . $this->long1. "'";
        $long2="'" . $this->long2. "'";
        $long3="'" . $this->long3. "'";
        $long4="'" . $this->long4. "'";
        $long5="'" . $this->long5. "'";

	 $partqty1="'" . $this->partqty1. "'";
	 $partqty2="'" . $this->partqty2. "'";
	 $partqty3="'" . $this->partqty3. "'";
	 $partqty4="'" . $this->partqty4. "'";
	 $partqty5="'" . $this->partqty5. "'";
	 $partqty6="'" . $this->partqty6. "'";
	 $partqty7="'" . $this->partqty7. "'";
	 $partqty8="'" . $this->partqty8. "'";
	 $partqty9="'" . $this->partqty9. "'";
	 $partqty10="'" . $this->partqty10. "'";
	 $part1="'" . $this->part1. "'";
	 $part2="'" . $this->part2. "'";
	 $part3="'" . $this->part3. "'";
	 $part4="'" . $this->part4. "'";
	 $part5="'" . $this->part5. "'";
	 $part6="'" . $this->part6. "'";
	 $part7="'" . $this->part7. "'";
	 $part8="'" . $this->part8. "'";
	 $part9="'" . $this->part9. "'";
	 $part10="'" . $this->part10. "'";
	 $qty1=$this->qty1;
	 $qty2=$this->qty2;
	 $qty3=$this->qty3;
	 $qty4=$this->qty4;
	 $qty5=$this->qty5;
	 $qty6=$this->qty6;
	 $qty7=$this->qty7;
	 $qty8=$this->qty8;
	 $qty9=$this->qty9;
	 $qty10=$this->qty10;
        $type="'" . $this->type . "'";
        $sql = "INSERT INTO generic_quote(recnum,	
	string1,
	string2,
	string3,
	string4,
	string5,
	 string6 ,
	 string7 ,
	 string8 ,
	 string9 ,
	 string10 ,
	 string11 ,
	 string12 ,
	 string13 ,
	 string14 ,
	 string15 ,
	 string16 ,
	 string17 ,
	 string18 ,
	 string19 ,
	 string20 ,
	 string21 ,
	 string22 ,
	 string23 ,
	 string24 ,
	 string25 ,
	 char1 ,
	 char2 ,
	 char3 ,
	 char4 ,
	 char5 ,
	 char6 ,
	 char7 ,
	 char8 ,
	 char9 ,
	 char10 ,
	 char11 ,
	 char12 ,
	 char13 ,
	 char14 ,
	 char15 ,
	 char16 ,
	 char17 ,
	 char18 ,
	 char19 ,
	 char20 ,
	 checkbox1 ,
	 checkbox2 ,
	 checkbox3 ,
	 checkbox4 ,
	 checkbox5 ,
	 checkbox6 ,
	 checkbox7 ,
	 checkbox8 ,
	 checkbox9 ,
	 checkbox10 ,
	 long1 ,
	 long2 ,
	 long3 ,
	 long4 ,
	 long5 ,
	 number1 ,
	 number2 ,
	 number3 ,
	 number4 ,
	 number5 ,
	 number6 ,
	 number7 ,
	 number8 ,
	 number9 ,
	 number10 ,
	 floatval1 ,
	 floatval2 ,
	 floatval3 ,
	 floatval4 ,
	 floatval5 ,
	 floatval6 ,
	 floatval7 ,
	 floatval8 ,
	 floatval9 ,
	 floatval10 ,
	 date1 ,
	 date2 ,
	 date3 ,
	 date4 ,
	 date5 ,
	 date6 ,
	 date7 ,
	 date8 ,
	 date9 ,
	 date10 ,
	 partqty1 ,
	 partqty2 ,
	 partqty3 ,
	 partqty4 ,
	 partqty5 ,
	 partqty6 ,
	 partqty7 ,
	 partqty8 ,
	 partqty9 ,
	 partqty10 ,
	 part1 ,
	 part2 ,
	 part3 ,
	 part4 ,
	 part5 ,
	 part6 ,
	 part7 ,
	 part8 ,
	 part9 ,
	 part10 ,
	 qty1 ,
	 qty2 ,
	 qty3 ,
	 qty4 ,
	 qty5 ,
	 qty6 ,
	 qty7 ,
	 qty8 ,
	 qty9 ,
	 qty10 ,

	type
 ) 
	  VALUES ($objid, 	
	$string1,
	$string2,
	$string3,
	$string4,
	$string5,
	 $string6 ,
	 $string7 ,
	 $string8 ,
	 $string9 ,
	 $string10 ,
	 $string11 ,
	 $string12 ,
	 $string13 ,
	 $string14 ,
	 $string15 ,
	 $string16 ,
	 $string17 ,
	 $string18 ,
	 $string19 ,
	 $string20 ,
	 $string21 ,
	 $string22 ,
	 $string23 ,
	 $string24 ,
	 $string25 ,
	 $char1 ,
	 $char2 ,
	 $char3 ,
	 $char4 ,
	 $char5 ,
	 $char6 ,
	 $char7 ,
	 $char8 ,
	 $char9 ,
	 $char10 ,
	 $char11 ,
	 $char12 ,
	 $char13 ,
	 $char14 ,
	 $char15 ,
	 $char16 ,
	 $char17 ,
	 $char18 ,
	 $char19 ,
	 $char20 ,
	 $checkbox1 ,
	 $checkbox2 ,
	 $checkbox3 ,
	 $checkbox4 ,
	 $checkbox5 ,
	 $checkbox6 ,
	 $checkbox7 ,
	 $checkbox8 ,
	 $checkbox9 ,
	 $checkbox10 ,
	 $long1 ,
	 $long2 ,
	 $long3 ,
	 $long4 ,
	 $long5 ,
	 $number1 ,
	 $number2 ,
	 $number3 ,
	 $number4 ,
	 $number5 ,
	 $number6 ,
	 $number7 ,
	 $number8 ,
	 $number9 ,
	 $number10 ,
	 $floatval1 ,
	 $floatval2 ,
	 $floatval3 ,
	 $floatval4 ,
	 $floatval5 ,
	 $floatval6 ,
	 $floatval7 ,
	 $floatval8 ,
	 $floatval9 ,
	 $floatval10 ,
	 $date1 ,
	 $date2 ,
	 $date3 ,
	 $date4 ,
	 $date5 ,
	 $date6 ,
	 $date7 ,
	 $date8 ,
	 $date9 ,
	 $date10 ,
	 $partqty1 ,
	 $partqty2 ,
	 $partqty3 ,
	 $partqty4 ,
	 $partqty5 ,
	 $partqty6 ,
	 $partqty7 ,
	 $partqty8 ,
	 $partqty9 ,
	 $partqty10 ,
	 $part1 ,
	 $part2 ,
	 $part3 ,
	 $part4 ,
	 $part5 ,
	 $part6 ,
	 $part7 ,
	 $part8 ,
	 $part9 ,
	 $part10 ,
	 $qty1 ,
	 $qty2 ,
	 $qty3 ,
	 $qty4 ,
	 $qty5 ,
	 $qty6 ,
	 $qty7 ,
	 $qty8 ,
	 $qty9 ,
	 $qty10 ,
	$type
 )";

        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("Insert to genericQuote didn't work..Please report to Sysadmin. " . mysql_error()); 
        }
        $sql = "update seqnum set nxtnum = $objid where tablename = 'generic_quote'";
        $result = mysql_query($sql);
        if(!$result) {
           $sql = "rollback";
           $result = mysql_query($sql);
           die("seqnum insert query didn't work for genericQuote.Please report to Sysadmin. " . mysql_error()); 
        }
        return $objid;
     } 

    function UpdategenericQuote($argrecnum) { 
        $recnum = $argrecnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "start transaction";

        $string1="'" . $this->string1. "'";
        $string2="'" . $this->string2. "'";
        $string3="'" . $this->string3. "'";
        $string4="'" . $this->string4. "'";
        $string5="'" . $this->string5. "'";
        $string6="'" . $this->string6. "'";
        $string7="'" . $this->string7. "'";
        $string8="'" . $this->string8. "'";
        $string9="'" . $this->string9. "'";
        $string10="'" . $this->string10. "'";
        $string11="'" . $this->string11. "'";
        $string12="'" . $this->string12. "'";
        $string13="'" . $this->string13. "'";
        $string14="'" . $this->string14. "'";
        $string15="'" . $this->string15. "'";
        $string16="'" . $this->string16. "'";
        $string17="'" . $this->string17. "'";
        $string18="'" . $this->string18. "'";
        $string19="'" . $this->string19. "'";
        $string20="'" . $this->string20. "'";
        $string21="'" . $this->string21. "'";
        $string22="'" . $this->string22. "'";
        $string23="'" . $this->string23. "'";
        $string24="'" . $this->string24. "'";
        $string25="'" . $this->string25. "'";

        $char1="'" . $this->char1. "'";
        $char2="'" . $this->char2. "'";
        $char3="'" . $this->char3. "'";
        $char4="'" . $this->char4. "'";
        $char5="'" . $this->char5. "'";
        $char6="'" . $this->char6. "'";
        $char7="'" . $this->char7. "'";
        $char8="'" . $this->char8. "'";
        $char9="'" . $this->char9. "'";
        $char10="'" . $this->char10. "'";
        $char11="'" . $this->char11. "'";
        $char12="'" . $this->char12. "'";
        $char13="'" . $this->char13. "'";
        $char14="'" . $this->char14. "'";
        $char15="'" . $this->char15. "'";
        $char16="'" . $this->char16. "'";
        $char17="'" . $this->char17. "'";
        $char18="'" . $this->char18. "'";
        $char19="'" . $this->char19. "'";
        $char20="'" . $this->char20. "'";

        $number1=$this->number1;
        $number2=$this->number2;
        $number3=$this->number3;
        $number4=$this->number4;
        $number5=$this->number5;
        $number6=$this->number6;
        $number7=$this->number7;
        $number8=$this->number8;
        $number9=$this->number9;
        $number10=$this->number10;

        $floatval1=$this->floatval1;
        $floatval2=$this->floatval2;
        $floatval3=$this->floatval3;
        $floatval4=$this->floatval4;
        $floatval5=$this->floatval5;
        $floatval6=$this->floatval6;
        $floatval7=$this->floatval7;
        $floatval8=$this->floatval8;
        $floatval9=$this->floatval9;
        $floatval10=$this->floatval10;

        $checkbox1="'" . $this->checkbox1. "'";
        $checkbox2="'" . $this->checkbox2. "'";
        $checkbox3="'" . $this->checkbox3. "'";
        $checkbox4="'" . $this->checkbox4. "'";
        $checkbox5="'" . $this->checkbox5. "'";
        $checkbox6="'" . $this->checkbox6. "'";
        $checkbox7="'" . $this->checkbox7. "'";
        $checkbox8="'" . $this->checkbox8. "'";
        $checkbox9="'" . $this->checkbox9. "'";
        $checkbox10="'" . $this->checkbox10. "'";

        $date1="'" . $this->date1. "'";
        $date2="'" . $this->date2. "'";
        $date3="'" . $this->date3. "'";
        $date4="'" . $this->date4. "'";
        $date5="'" . $this->date5. "'";
        $date6="'" . $this->date6. "'";
        $date7="'" . $this->date7. "'";
        $date8="'" . $this->date8. "'";
        $date9="'" . $this->date9. "'";
        $date10="'" . $this->date10. "'";

        $long1="'" . $this->long1. "'";
        $long2="'" . $this->long2. "'";
        $long3="'" . $this->long3. "'";
        $long4="'" . $this->long4. "'";
        $long5="'" . $this->long5. "'";

	 $partqty1="'" . $this->partqty1. "'";
	 $partqty2="'" . $this->partqty2. "'";
	 $partqty3="'" . $this->partqty3. "'";
	 $partqty4="'" . $this->partqty4. "'";
	 $partqty5="'" . $this->partqty5. "'";
	 $partqty6="'" . $this->partqty6. "'";
	 $partqty7="'" . $this->partqty7. "'";
	 $partqty8="'" . $this->partqty8. "'";
	 $partqty9="'" . $this->partqty9. "'";
	 $partqty10="'" . $this->partqty10. "'";
	 $part1="'" . $this->part1. "'";
	 $part2="'" . $this->part2. "'";
	 $part3="'" . $this->part3. "'";
	 $part4="'" . $this->part4. "'";
	 $part5="'" . $this->part5. "'";
	 $part6="'" . $this->part6. "'";
	 $part7="'" . $this->part7. "'";
	 $part8="'" . $this->part8. "'";
	 $part9="'" . $this->part9. "'";
	 $part10="'" . $this->part10. "'";
	 $qty1=$this->qty1;
	 $qty2=$this->qty2;
	 $qty3=$this->qty3;
	 $qty4=$this->qty4;
	 $qty5=$this->qty5;
	 $qty6=$this->qty6;
	 $qty7=$this->qty7;
	 $qty8=$this->qty8;
	 $qty9=$this->qty9;
	 $qty10=$this->qty10;

        $type="'" . $this->type . "'";
        $wosqladd = "status = 'Work Order Received'";

        $sql = "update generic_quote
                          set  
		string1 = $string1,
        string1=$string1,
        string2=$string2,
        string3=$string3,
        string4=$string4,
        string5=$string5,
        string6=$string6,
        string7=$string7,
        string8=$string8,
        string9=$string9,
        string10=$string10,
        string11=$string11,
        string12=$string12,
        string13=$string13,
        string14=$string14,
        string15=$string15,
        string16=$string16,
        string17=$string17,
        string18=$string18,
        string19=$string19,
        string20=$string20,
        string21=$string21,
        string22=$string22,
        string23=$string23,
        string24=$string24,
        string25=$string25,

        char1=$char1,
        char2=$char2,
        char3=$char3,
        char4=$char4,
        char5=$char5,
        char6=$char6,
        char7=$char7,
        char8=$char8,
        char9=$char9,
        char10=$char10,
        char11=$char11,
        char12=$char12,
        char13=$char13,
        char14=$char14,
        char15=$char15,
        char16=$char16,
        char17=$char17,
        char18=$char18,
        char19=$char19,
        char20=$char20,

        number1=$number1,
        number2=$number2,
        number3=$number3,
        number4=$number4,
        number5=$number5,
        number6=$number6,
        number7=$number7,
        number8=$number8,
        number9=$number9,
        number10=$number10,

        floatval1=$floatval1,
        floatval2=$floatval2,
        floatval3=$floatval3,
        floatval4=$floatval4,
        floatval5=$floatval5,
        floatval6=$floatval6,
        floatval7=$floatval7,
        floatval8=$floatval8,
        floatval9=$floatval9,
        floatval10=$floatval10,

        checkbox1=$checkbox1,
        checkbox2=$checkbox2,
        checkbox3=$checkbox3,
        checkbox4=$checkbox4,
        checkbox5=$checkbox5,
        checkbox6=$checkbox6,
        checkbox7=$checkbox7,
        checkbox8=$checkbox8,
        checkbox9=$checkbox9,
        checkbox10=$checkbox10,

        date1=$date1,
        date2=$date2,
        date3=$date3,
        date4=$date4,
        date5=$date5,
        date6=$date6,
        date7=$date7,
        date8=$date8,
        date9=$date9,
        date10=$date10,

        long1=$long1,
        long2=$long2,
        long3=$long3,
        long4=$long4,
        long5=$long5,

	 partqty1=$partqty1,
	 partqty2=$partqty2,
	 partqty3=$partqty3,
	 partqty4=$partqty4,
	 partqty5=$partqty5,
	 partqty6=$partqty6,
	 partqty7=$partqty7,
	 partqty8=$partqty8,
	 partqty9=$partqty9,
	 partqty10=$partqty10,
	 part1=$part1,
	 part2=$part2,
	 part3=$part3,
	 part4=$part4,
	 part5=$part5,
	 part6=$part6,
	 part7=$part7,
	 part8=$part8,
	 part9=$part9,
	 part10=$part10,
	 qty1=$qty1,
	 qty2=$qty2,
	 qty3=$qty3,
	 qty4=$qty4,
	 qty5=$qty5,
	 qty6=$qty6,
	 qty7=$qty7,
	 qty8=$qty8,
	 qty9=$qty9,
	 qty10=$qty10,

                                type = $type
                        where recnum = $recnum";
//echo "$sql";
           $result = mysql_query($sql);

           // Test to make sure query worked 
           if(!$result) die("Update to genericQuote didn't work..Please report to Sysadmin. " . mysql_error()); 
        return $wosqladd;
     } 


     function getFD($inprecnum) {
        $recnum =$inprecnum;
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $sql = "select recnum,string1,string2,string3,string4,string5,item_desc,
                       date1,date2,date3,date4,date5,type,
                   from fields
                   where  = $recnum";
        $result = mysql_query($sql);
        return $result;
     }


     function deleteFD($inprecnum) {
        $newlogin = new userlogin;
        $newlogin->dbconnect();
        $recnum =$inprecnum;
        $sql = "delete from fields where recnum = $recnum";
        // echo "$sql";
        $result = mysql_query($sql);
        if(!$result) die("Delete for Page Fields Items failed...Please report to SysAdmin. " . mysql_error()); 
      }

     function getGenInfo($inpworecnum) {
        $worecnum = $inpworecnum;
//echo "worecnum:$worecnum<br>";
        $sql = "select w.wonum, w.wotype, c.name, w.po_num,w.quote_num, w.status, w.wo2type,
                       w.descr,co.fname, co.lname, co.phone, co.email, emp.fname, emp.lname,
                       w.wo2customer, w.wo2contact, w.wo2employee, 
                       w.sch_due_date, w.actual_ship_date,
                       w.book_date, w.revised_ship_date,
                       w.reorder
                    from work_order w, company c, contact co, employee emp
                    where w.wo2customer = c.recnum and
                             w.wo2contact = co.recnum and
                             w.wo2employee = emp.recnum and
                             w.recnum = $worecnum";

//echo "<br>$sql<br>";
        $result = mysql_query($sql);
        if(!$result) {
           echo "Query failed for Board General Info.. " . mysql_error(); 
           die("Please report to Sysadmin. ");
        }
        return $result;

     }


     function getAddrInfo($inpworecnum) {
        $worecnum = $inpworecnum;
        $sql = "select         c.addr1, c.addr2, c.city, c.state, c.zipcode, c.country,
                               c.baddr1, c.baddr2, c.bcity, c.bstate, c.bzipcode, c.bcountry,
                               c.saddr1, c.saddr2, c.scity, c.sstate, c.szipcode, c.scountry
                       from work_order w, company c
                       where w.wo2customer = c.recnum and
                             w.recnum = $worecnum";
        $result = mysql_query($sql);
        if(!$result) {
           echo "Query failed for Board Address Info.. " . mysql_error(); 
           die("Please report to Sysadmin. ");
        }
        return $result;

     }

     function getParts($typenum) {

        $typrecnum = "'" . $typenum . "'";

        $sql = "select part_used_num,recnum from part_used where
                          part_used2type = $typenum and
                          type = 'Board'";
//echo "$sql";
        $result = mysql_query($sql);
        if(!$result) {
           echo "Query failed for Board Parts.. " . mysql_error(); 
           die("Please report to Sysadmin. ");
        }
        return $result;

     }  


} // End pageFields class definition 


