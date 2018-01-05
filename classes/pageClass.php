<?
//====================================
// Author: FSI
// Date-written = June 20, 2005 by Jerry George
// Filename: pageClass.php
// Revision: v1.0
//====================================
include_once('loginClass.php');
//include('classes/workorderClass.php');
//include('classes/genericWOClass.php');

class page
{
    var $recnum,
        $pname,
        $parent;

     function page()
     {
        $this->recnum = '';
        $this->pname = '';
        $this->parent = '';
        $this->date_requested='';
    }


    function getpname () {
           return $this->pname;
    }

    function setpname  ($reqpname ) {
           $this->pname  = $reqpname ;
    }

    function getparent  () {
           return $this->parent ;
    }

    function setparent  ($reqparent ) {
           $this->parent  = $reqparent ;
    }

        function addPage() {
        $newlogin = new userlogin;
        $newlogin->dbconnect();

        $sql = "select nxtnum from seqnum where tablename = 'm_pagename' for update";
        $result = mysql_query($sql);
        $myrow = mysql_fetch_row($result);
        $seqnum = $myrow[0];
        $objid = $seqnum + 1;

        $pname= "'" . $this->pname . "'";
        $parent = "'" . $this->parent  . "'";
        $siteid = "'" . $_SESSION['siteid']  . "'";

        $sql = "select * from m_pagename where pname = $pname and parent =$parent ";
        $result = mysql_query($sql);
        if (!(mysql_fetch_row($result))) {
           $sql = "INSERT INTO m_pagename
                          (recnum,pname,parent ,create_date,siteid)
                     VALUES ($objid,$pname,$parent ,curdate(),$siteid)";
//echo "$sql";
         }
         else {
            echo "<table border=1><tr><td><font color=#FF0000>";
            die("Page Name " . $pname . " already exists. ");
            echo "</td></tr></table>";
         }
        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Insert of Page Name failed. " . mysql_error());
        $sql = "update seqnum set nxtnum = $objid where tablename = 'm_pagename'";
        $result = mysql_query($sql);
        if(!$result) die("Seqnum insert for Service Request didn't work. " . mysql_error());
        $result = mysql_query($sql);
        if(!$result) die("Seqnum insert for Page Name didn't work. " . mysql_error());

        // Test to make sure query worked
       return $objid;
     }

   /* function updatePage($inp pagerecnum) {
          $pagename=$this->pagename;

        $sql = "update pagename
                   set  pagename=$pagename

                    where recnum = $pagerecnum";

        $result = mysql_query($sql);
        // Test to make sure query worked
        if(!$result) die("Update of Page Name failed..Please report to Sysadmin " . mysql_error());

     }





     function getPages($argoffset,$arglimit)
     {
        $offset = $argoffset;
        $limit = $arglimit;

         $sql = "select .recnum ,pname,parent,
                        date_format(create_date,'%y-%m-%d'),
                    from m_pagename
                    limit $offset, $limit";
//echo "$sql";
             $result = mysql_query($sql);
             return $result;
     }



     function getPagecount($argoffset, $arglimit)
     {
        $wcond = $cond;
        $offset = $argoffset;
        $limit = $arglimit;
        $sql = "select count(*) as numrows from   m_pagename ";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
//echo "$sql";
        $result  = mysql_query($sql) or die('Pages count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;

     }*/



     function getPages($argoffset,$arglimit)
     {
        $offset = $argoffset;
        $limit = $arglimit;
        $siteid = $_SESSION['siteid'];
		$siteval = "siteid = '".$siteid."'";
         $sql = "select recnum ,pname,parent,
                        date_format(create_date,'%y-%m-%d')
                    from m_pagename where $siteval
                    limit $offset, $limit";
//echo "$sql";
             $result = mysql_query($sql);
             return $result;
     }

     function getPages4parent($argparent)
     {
        $sql = "select recnum ,pname
                    from m_pagename
                    where parent='$argparent'";
//echo "hell i am here   :$sql<br>";
             $result = mysql_query($sql);
             return $result;
     }

     function getPagecount($argoffset, $arglimit)
     {
        $offset = $argoffset;
        $limit = $arglimit;
        $sql = "select count(*) as numrows from   m_pagename ";
        $newlogin = new userlogin;
        $newlogin->dbconnect();
//echo "$sql";
        $result  = mysql_query($sql) or die('Pages count query failed');
        $row     = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];
        return $numrows;

     }

function createjs($parent,$pname)
{
        $sql = "select pf.recnum,pf.seqnum, pf.lname,pf.fname,pf.type,pf.link2pname,pf.mandatory
	     from   m_pagefields  pf,m_pagename p
	     where p.pname='$pname' and
		 p.parent='$parent' and
	      pf.link2pname=p.recnum";
	$js='';
//  echo "creating newpage  :$sql<br>";
            $result = mysql_query($sql);
      //echo "i am here  :$parent";
       $i=0;
        while ($myrow = mysql_fetch_row($result))
       {
	$cntrls=$myrow[2];
	if($cntrls == '')
	$cntrls='Qty';
	if($myrow[6] == 'y' )
	{
	   $js=$js . "if (document.forms[0].$myrow[3].value.length == 0)
   		{
			 errmsg+=\"Please enter $cntrls \\n\";
		}";
	}
          }
 $js=$js . "var i=1;
	var flag=0;
	var frm=document.forms[0];
	var max=document.forms[0].max.value;
	for(var i=0;i<frm.length;i++)
	{
		for(var j=1;j<max;j++)
		{
			number=\"number\"+j;
			var k=i;
			if(frm.elements[i].name==number  && frm.elements[i].value.length != '')
			{
			          var valid=\"0,1,2,3,4,5,6,7,8,9\";
			          var ok=\"yes\";
			          var temp;
		   	          for (var k=0;k < frm.elements[i].value.length;k++)
		                          {
				temp= \"\" + frm.elements[i].value.substring(k,k+1);
				if(valid.indexOf(temp)== \"-1\")
				ok=\"no\";
			           }
		                           if(ok==\"no\")
	  	                          {
				errmsg +=\"Enter Numeric Values instead of  \" + frm.elements[i].value + \" \\n\";
				flag=1;
				break;
		 	           }
			}
			floatval=\"floatval\"+j;
			var k=i;
			if(frm.elements[i].name==floatval  && frm.elements[i].value.length != '')
			{
			          var valid=\"0,1,2,3,4,5,6,7,8,9,.\";
			          var ok=\"yes\";
			          var temp;
		   	          for (var k=0;k < frm.elements[i].value.length;k++)
		                          {
				temp= \"\" + frm.elements[i].value.substring(k,k+1);
				if(valid.indexOf(temp)== \"-1\")
				ok=\"no\";
			           }
		                           if(ok==\"no\")
	  	                          {
				errmsg +=\"Enter Decimal Values  instead of  \" + frm.elements[i].value + \" \\n\";
				flag=1;
				break;
		 	           }
			}
			qty=\"qty\"+j;
			var k=i;
			if(frm.elements[i].name==qty  && frm.elements[i].value.length != '')
			{

			          var valid=\"0,1,2,3,4,5,6,7,8,9\";
			          var ok=\"yes\";
			          var temp;
		   	          for (var k=0;k < frm.elements[i].value.length;k++)
		                          {
				temp= \"\" + frm.elements[i].value.substring(k,k+1);
				if(valid.indexOf(temp)== \"-1\")
				ok=\"no\";
			           }
		                           if(ok==\"no\")
	  	                          {
				errmsg +=\"Enter numeric value  instead of  \" + frm.elements[i].value + \" \\n\";
				flag=1;
				break;
		 	           }
			}
			var partqty=\"partqty\"+j;
			if(frm.elements[i].name==partqty  && frm.elements[i].value.length != '')
			{
				 if(frm.elements[i+1].value.length == '')
			         {
				errmsg +=\"You should enter qty for this Part#\\n\";
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
	          datec=\"dates\" + j;
	if (flag == 1 && document.forms[0].elements[datec].value!='')
	{
		   errmsg+=\"Previous milestone is not completed\\n\";

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
	          datec=\"datec\" + j;
	if (flag == 1 && document.forms[0].elements[datec].value!='')
	{
		   errmsg+=\"Previous milestone is not completed\\n\";

	}

	if (document.forms[0].elements[datec].value=='')
	  {
	   flag=1;
	  }
              }
}

 ";

	$fp = fopen("scripts/" . $parent . $pname . ".js", "w");
	fwrite($fp, "
	function check_req_fields(){
	    var errmsg='';
  	    if (document.forms[0].company.value == 'Please Specify')
	   {
		 errmsg+=\"Customer cannot be Please Specify\\n\";
	   }
	   if (document.forms[0].wonum.value.length == 0)
	   {
		errmsg+=\"Work Order # must be entered\\n\";
	   }
	   if (document.forms[0].ponum.value.length == 0)
	   {
		errmsg+=\"PO # must be entered\\n\";
	   }
	   if (document.forms[0].quotenum.value.length == 0)
	   {
		 errmsg+=\"Quote # must be entered\\n\";
	   }
	   if (document.forms[0].contact.value.length == 0)
	   {
		 errmsg+=\"Contact must be present\\n\";
	   }
	   if (document.forms[0].contact.value == 'Please Specify')
	   {
		 errmsg+=\"Contact cannot be Please Specify\\n\";
	   }
	   if (document.forms[0].owner.value.length == 0)
	   {
		 errmsg+=\"Designer must be entered\\n\";
	   }
		   if (document.forms[0].owner.value == 'Please Specify')
	   {
		errmsg+=\"Designer cannot be Please Specify\\n\";
	   }
	   $js
	   if (errmsg == '')
    	  {
        		return true;
    	   }
    	   else
    	  {
	       alert (errmsg);
	       return false;
	   }
	}");
}

function createjs4quote($parent,$pname)
{
        $sql = "select pf.recnum,pf.seqnum, pf.lname,pf.fname,pf.type,pf.link2pname,pf.mandatory
	     from   m_pagefields  pf,m_pagename p
	     where p.pname='$pname' and
		 p.parent='$parent' and
	      pf.link2pname=p.recnum";
	$js='';
//  echo "creating newpage  :$sql<br>";
            $result = mysql_query($sql);
       $i=0;
        while ($myrow = mysql_fetch_row($result))
       {
	if($myrow[6] == 'y' )
	{
	   $js=$js . "if (document.forms[0].$myrow[3].value.length == 0)
   		{
			 errmsg+=\"Please enter $myrow[2] \\n\";
		}";
	}
          }

	$fp = fopen("scripts/" . $parent . $pname . ".js", "w");
	fwrite($fp, "
	function check_req_fields()
	{
	    var errmsg='';
	var valid=\"0,1,2,3,4,5,6,7,8,9,.\";
	var valid1=\"0,1,2,3,4,5,6,7,8,9\";
	var ok=\"yes\";
	var temp;
	var frm=document.forms[0];
	var max=document.forms[0].index.value;
	var frm=document.forms[0];
	var flag=0;
  	    if (document.forms[0].company.value.length == 0)
	    {
	         errmsg += \"Please select Customer\\n\";
	    }
	    if (document.forms[0].quoteid.value.length == 0)
	    {
	         errmsg += \"Please enter Quote Id\\n\";
	    }

	    if (document.forms[0].desc.value.length == 0)
	    {
	         errmsg +=  \"Please enter Quote Description\\n\";
	    }

	    if (document.forms[0].excelfile.value.length == 0)
	    {
	         errmsg +=  \"Please enter Excel File name\\n\";
	    }

	for(var i=0;i<frm.length;i++)
	{
		for(var j=1;j<max;j++)
		{
			item1=\"item_desc\"+j;
			var k=i;

			if(frm.elements[i].name==item1  && frm.elements[i].value.length != 0 &&  frm.elements[k+1].value.length == 0 && frm.elements[k+2].value.length == 0)
			{
				errmsg +=\"Rate and Qty should be present \\n\";
				flag=1;
				break;
			}
			if(frm.elements[i].name==item1  && frm.elements[i].value.length != 0 &&  frm.elements[k+1].value.length == 0 )
			{
				errmsg +=\"Qty should be present\\n\";
				flag=1;
				break;
			}
			if(frm.elements[i].name==item1  && frm.elements[i].value.length != 0 &&  frm.elements[k+3].value.length == 0 )
			{
				errmsg +=\"Rate should be present\\n\";
				flag=1;
				break;
			}
		}
		if (flag==1)
		break;
	}

 	for(var i=0;i<frm.length;i++)
	{
		for(var j=1;j<max;j++)
		{
			item1=\"rate\"+j;
			var k=i;
			if(frm.elements[i].name==item1)
			{
				x=frm.elements[i].value.length;
				for (var k=0;k<x;k++)
				{
        				temp= \"\" + document.forms[0].elements[i].value.substring(k,k+1);
					if(valid.indexOf(temp) == -1)
					{
						errmsg +=\"Rate should be numbers only\\n\";
                                               break;
					}
				}
			}
			item1=\"quantity\"+j;
			var k=i;

			if(frm.elements[i].name==item1)
			{
				x=frm.elements[i].value.length;
				for (var k=0;k<x;k++)
				{
        				temp= \"\" + document.forms[0].elements[i].value.substring(k,k+1);
					if(valid.indexOf(temp) == -1)
					{
						errmsg +=\"Quantiy should be numbers only\\n\";
                                               break;
					}
				}
			}

		}
	}
	   $js
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
");
}


function createctrls4SU($worecnum)
{
$newgen = new genericWO;
$newlogin = new userlogin;
$newlogin->dbconnect();
$newwo = new workOrder;

$result = $newgen->getGenInfo($worecnum);
$myrow = mysql_fetch_row($result);
$result = $newgen->getAddrInfo($worecnum);
$myaddr = mysql_fetch_row($result);

        if($myrow[19] != '0000-00-00' && $myrow[19] != '' && $myrow[19] != 'NULL')
      {
       $d=substr($myrow[19],8,2);
       $m=substr($myrow[19],5,2);
       $y=substr($myrow[19],0,4);
       $x=mktime(0,0,0,$m,$d,$y);
       $date1=date("M j, Y",$x);
      }
      else
      {
        $date1 = '';
      }

//echo "i am here";
        $html ='';
	        $html = $html . "<tr bgcolor=\"#DDDEDD\"><td colspan=4><span class=\"heading\"><center><b>General Information</b></center></td></tr>
                      <tr bgcolor=\"#FFFFFF\"><td width=25%><span class=\"tabletext\"><b>Customer</b></td>
                          <td width=25%><span class=\"tabletext\">$myrow[2]</td>
                          <td width=25%><span class=\"tabletext\"><b>Work Order</b></td>
                          <td width=25%><span class=\"tabletext\">$myrow[0]</td>
                      </tr>

	                  <tr bgcolor=\"#FFFFFF\">
                          <td><span class=\"tabletext\"><b>Cust PO#</b></td>
                          <td ><span class=\"tabletext\">$myrow[3]</td>
                          <td><span class=\"tabletext\"><b>Quote #</b></td>
                          <td ><span class=\"tabletext\">$myrow[4]</td>
                      </tr>

                      <tr  bgcolor=\"#FFFFFF\"><td><span class=\"tabletext\"><b>GRN#</b></td>
                          <td ><span class=\"tabletext\">$myrow[26]</td>
                          <td><span class=\"tabletext\"><b>Book Date</b></td>
                          <td ><span class=\"tabletext\">$date1</td>

                      </tr>

                      <tr  bgcolor=\"#FFFFFF\">
                          <td><span class=\"tabletext\"><b>Description</b></td>
                          <td colspan=3><span class=\"tabletext\">$myrow[7]</td>
                      </tr>

                      <tr bgcolor=\"#FFFFFF\">
                          <td><span class=\"tabletext\"><b>Sales Order</b></td>
                          <td><span class=\"tabletext\">$myrow[28]</td>
                          <td><span class=\"tabletext\"><b>Qty</b></td>
                          <td><span class=\"tabletext\">$myrow[27]</td>
                      </tr>

                      <tr bgcolor=\"#FFFFFF\">
                          <td><span class=\"tabletext\"><b>Designer</b></td>
                          <td colspan=3><span class=\"tabletext\">$myrow[12]$myrow[13]</td>
              </tr>
  </table>
    <table border=0 bgcolor=\"#DFDEDF\" width=100% cellspacing=1 cellpadding=3>

                    <tr  bgcolor=\"#DDDEDD\">
                        <td ><span class=\"heading\"><center><b>Billing Address</b></center></td>
                        <td><span class=\"heading\"><b><center>Shipping Address</center></b></td>
                     </tr>
                      <tr  bgcolor=\"#FFFFFF\">
                          <td  ><span class=\"tabletext\">$myaddr[6] $myaddr[7]</td>
                          <td ><span class=\"tabletext\">$myaddr[12] $myaddr[13]</td>
                      </tr>
                      <tr  bgcolor=\"#FFFFFF\">
                          <td ><span class=\"tabletext\">$myaddr[8] $myaddr[9]</td>
                          <td  ><span class=\"tabletext\">$myaddr[14] $myaddr[15]</td>

                      </tr>
                      <tr  bgcolor=\"#FFFFFF\">
                          <td><span class=\"tabletext\">$myaddr[10] $myaddr[11]</td>
                          <td><span class=\"tabletext\">$myaddr[16]$myaddr[17]</td>
                      </tr>
</table>
    <table border=0 bgcolor=\"#DFDEDF\" width=100% cellspacing=1 cellpadding=3>

<tr bgcolor=\"#DDDEDD\"><td colspan=4><span class=\"heading\"><center><b>Contact Details</b></center></td></tr>
                      <tr bgcolor=\"#FFFFFF\"><td width=25%><span class=\"tabletext\"><b>Contact</b></td>
                          <td width=25%><span class=\"tabletext\">$myrow[8]$myrow[9]<br>$myrow[11]</td>
                          <td width=25%><span class=\"tabletext\"><b>Phone</b></td>
                          <td width=25%><span class=\"tabletext\">$myrow[10]</td>
                      </tr>
</table>";
return $html;
}

function createctrls4RU($worecnum)
{
$newgen = new genericWO;
$newlogin = new userlogin;
$newlogin->dbconnect();
$newwo = new workOrder;

$result = $newgen->getGenInfo($worecnum);
$myrow = mysql_fetch_row($result);
$result = $newgen->getAddrInfo($worecnum);
$myaddr = mysql_fetch_row($result);

//echo "i am here";
        $html ='';
	        $html = $html . "<tr bgcolor=\"#DDDEDD\"><td colspan=4><span class=\"heading\"><center><b>General Information</b></center></td></tr>
                      <tr bgcolor=\"#FFFFFF\"><td><span class=\"tabletext\"><b>Customer</b></td>
                          <td ><span class=\"tabletext\">$myrow[2]</td>
                          <td><span class=\"tabletext\"><b>Work Order</b></td>
                          <td ><span class=\"tabletext\">$myrow[0]</td>
                      </tr>
                      <tr  bgcolor=\"#FFFFFF\"><td><span class=\"tabletext\"><b>Description</b></td>
                          <td ><span class=\"tabletext\">$myrow[4]</td>
                           <td><span class=\"tabletext\"><b>Designer</b></td>
                          <td ><span class=\"tabletext\">$myrow[12]$myrow[13]</td>

                      </tr>
</table>

    <table border=0 bgcolor=\"#DFDEDF\" width=100% cellspacing=1 cellpadding=3>

<tr  bgcolor=\"#DDDEDD\"><td colspan=4><span class=\"heading\"><center><b>Contact Details</b></center></td></tr>
                      <tr bgcolor=\"#FFFFFF\"><td ><span class=\"tabletext\"><b>Contact</b></td>
                          <td ><span class=\"tabletext\">$myrow[8]$myrow[9]<br>$myrow[11]</td>
                          <td><span class=\"tabletext\"><b>Phone</b></td>
                          <td ><span class=\"tabletext\">$myrow[10]</td>
                      </tr>
</table>";
return $html;
}

function createctrls4CUST($worecnum)
{
$newgen = new genericWO;
$newlogin = new userlogin;
$newlogin->dbconnect();
$newwo = new workOrder;

$result = $newgen->getGenInfo($worecnum);
$myrow = mysql_fetch_row($result);
$result = $newgen->getAddrInfo($worecnum);
$myaddr = mysql_fetch_row($result);

//echo "i am here";
        $html ='';
	        $html = $html . "<tr bgcolor=\"#DDDEDD\"><td colspan=4><span class=\"heading\"><center><b>General Information</b></center></td></tr>
                      <tr bgcolor=\"#FFFFFF\"><td><span class=\"tabletext\"><b>Customer</b></td>
                          <td ><span class=\"tabletext\">$myrow[2]</td>
                          <td><span class=\"tabletext\"><b>Work Order</b></td>
                          <td ><span class=\"tabletext\">$myrow[0]</td>
                      </tr>
                      <tr  bgcolor=\"#FFFFFF\"><td><span class=\"tabletext\"><b>Description</b></td>
                          <td ><span class=\"tabletext\">$myrow[4]</td>
                           <td><span class=\"tabletext\"><b>Designer</b></td>
                          <td ><span class=\"tabletext\">$myrow[12]$myrow[13]</td>

                      </tr>
</table>
    <table border=0 bgcolor=\"#DFDEDF\" width=100% cellspacing=1 cellpadding=3>

<tr  bgcolor=\"#DDDEDD\"><td colspan=4><span class=\"heading\"><center><b>Contact Details</b></center></td></tr>
                      <tr bgcolor=\"#FFFFFF\"><td ><span class=\"tabletext\"><b>Contact</b></td>
                          <td ><span class=\"tabletext\">$myrow[8]$myrow[9]<br>$myrow[11]</td>
                          <td><span class=\"tabletext\"><b>Phone</b></td>
                          <td ><span class=\"tabletext\">$myrow[10]</td>
                      </tr>
</table>";
return $html;
}


function createctrls($parent,$pname)
{
//echo "i am here";
        $html ='';
        $sqlgrp="select distinct f.pgroup from m_pagefields f,m_pagename p where p.pname='$pname' and p.parent='$parent' and link2pname=p.recnum";
        //echo "$sqlgrp";
        $resultgrp = mysql_query($sqlgrp);
        $partqtyindex=1;
        $partindex=1;
        $qtyindex=1;
        $dateindex=1;

        while ($myrowgrp = mysql_fetch_row($resultgrp))
        {
	        $i=0;
	        $html = $html . "<tr bgcolor=\"#DDDEDD\"><td colspan=4><span class=\"heading\"><center><b>$myrowgrp[0]</b></center></td>
	        </tr>";
	        $sql = "select pf.recnum,pf.seqnum, pf.lname,pf.fname,pf.type,pf.link2pname,pf.mandatory
		     from   m_pagefields  pf,m_pagename p
		     where p.pname='$pname' and
		      pf.status='Active' and
		      pf.link2pname=p.recnum
		     and pgroup='$myrowgrp[0]'";
	        $result = mysql_query($sql);
			$x=$i%2;
			//echo " group :$myrowgrp[0]    :$i  :$x<br>";
	        while ($myrow = mysql_fetch_row($result))
	       {
			$x=$i%2;
			//echo "$myrow[2]   :$i  :$x          ";
//echo "$myrow[4] <br>";
		if($i%2 == 0 )
		{
			$html = $html . "<tr bgcolor=\"#FFFFFF\" width=100%>";

		}
		if($myrow[4] == 'Text')
		{

			$html = $html . "<td><span class=\"labeltext\"><p align=\"left\">$myrow[2] </p></td>
	  		         <td ><input type=\"text\" size=30  name=\"$myrow[3]\" maxlength=\"50\"></td>";
			$i++;
		}
		if($myrow[4] == 'Numeric' || $myrow[4] == 'Decimal')
		{

			$html = $html . "<td><span class=\"labeltext\"><p align=\"left\">$myrow[2] </p></td>
	  		         <td ><input type=\"text\" size=30  name=\"$myrow[3]\" ></td>";
			$i++;
		}

		else if($myrow[4] == 'Desc Text')
		{
		       if( $i % 2 != 0 )
		       {
			$html = $html . "<td colspan=2>&nbsp;</td></tr><tr bgcolor=\"#FFFFFF\" width=100%>";
			$i++;
	 	        }

			$html = $html . "<td><span class=\"labeltext\"><p align=\"left\">$myrow[2] </p></td>
	  		         <td colspan=3 ><input type=\"text\" size=80 name=\"$myrow[3]\" ></td>";
		       $i+=2;
		}

		else if($myrow[4] == 'Long')
		{
		       if( $i % 2 != 0 )
		       {
			$html = $html . "<td colspan=2>&nbsp;</td></tr><tr bgcolor=\"#DDDEDD\" width=100%>";
			$i++;
		      }

			$html = $html . "
				        <td ><span class=\"heading\"><center><b>$myrow[2]</b></center></td>
				        <td colspan=3><textarea name=\"$myrow[3]\" rows=\"6\" cols=\"50\" value=\"\"></textarea></td>";
		        $i+=2;
		}
		else if($myrow[4] == 'Date')
		{
		            $html = $html . "<td><span class=\"labeltext\"><p align=\"left\">$myrow[2]</p></font></td>
			    <td><input type=\"text\" name=\"$myrow[3]\"
                    			style=\"background-color:#DDDDDD;\"
                   			 readonly=\"readonly\" size=12 >
             				<img src=\"images/bu-getdate.gif\" alt=\"$myrow[3]\" onclick=\"GetDate4template($dateindex)\">
			     </td>";
			$dateindex++;
			$i++;
		}
		if($myrow[4] == 'Check Box')
		{
				$html = $html . "<td><span class=\"labeltext\"><p align=\"left\">$myrow[2]</p></font></td>
				<td><span class=\"tabletext\"><input type=\"checkbox\" name=\"$myrow[3]\"  size=13 value=\"\" ></td>";
			$i++;
		}
		else if($myrow[4] == 'Part' )
		{
			$html = $html . "<td><span class=\"labeltext\"><p align=\"left\">$myrow[2]</p></font></td>
	            				<td><input type=\"text\" name=\"$myrow[3]\"
                    				style=\";background-color:#DDDDDD;\"
                   				readonly=\"readonly\" size=20 >
					<img src=\"images/bu-setpartnum.gif\" alt=\"$myrow[3]\"  onclick=\"VerifyPart($partindex,'part')\">
            				</td>";
			$i++;
			$partindex++;
		}
		else if($myrow[4] == 'Part With Qty' )
		{
		       $qty="qty" . $qtyindex;
		       $qtyindex++;
		       if( $i % 2 != 0 )
		       {
			$html = $html . "<td colspan=2>&nbsp;</td></tr><tr bgcolor=\"#FFFFFF\" width=100%>";
			$i++;
	 	        }

			$html = $html . "<td><span class=\"labeltext\"><p align=\"left\">$myrow[2]</p></font></td>
            				<td><input type=\"text\" name=\"$myrow[3]\"
                    				style=\";background-color:#DDDDDD;\"
                    				readonly=\"readonly\" size=20 >
             					<img src=\"images/bu-setpartnum.gif\" alt=\"$myrow[3]\"  onclick=\"VerifyPart($partqtyindex,'partqty')\"></td>
					<td><span class=\"labeltext\"><b>Qty</b></td>
					<td><input type=\"text\" name=\"$qty\" size=30 ></td>";
		         $i+=2;
		         $partqtyindex++;
		}
		if($i%2 == 0)
		{
			$html = $html . "</tr>";
		}

		//$i++;
	     	}
	                $j=$i;
		$j--;
		if( $j % 2 == 0 )
	               {
			$html = $html . "<td colspan=2>&nbsp;</td></tr>";
	               	}

          }
return $html;
}

function createctrls4template($parent,$pname)
{
        $html ='';
        $sqlgrp="select distinct f.pgroup from m_pagefields f,m_pagename p where p.pname='$pname' and p.parent='$parent' and link2pname=p.recnum";
        //echo "$sqlgrp";
        $resultgrp = mysql_query($sqlgrp);
        $partqtyindex=1;
        $partindex=1;
        $qtyindex=1;
        $dateindex=1;

        while ($myrowgrp = mysql_fetch_row($resultgrp))
        {
	        $i=0;
	        $html = $html . "<tr bgcolor=\"#DDDEDD\"><td colspan=4><span class=\"heading\"><center><b>$myrowgrp[0]</b></center></td>
	        </tr>";
	        $sql = "select pf.recnum,pf.seqnum, pf.lname,pf.fname,pf.type,pf.link2pname,pf.mandatory
		     from   m_pagefields  pf,m_pagename p
		     where p.pname='$pname' and
		      pf.status='Active' and
		      pf.link2pname=p.recnum
		     and pgroup='$myrowgrp[0]'";
	//echo "$sql";
	        $result = mysql_query($sql);
			//$x=$i%2;
			//echo " group :$myrowgrp[0]    :$i  :$x<br>";
	        while ($myrow = mysql_fetch_row($result))
	       {
		if($i%2 == 0 )
		{
			$html = $html . "<tr bgcolor=\"#FFFFFF\" width=100%>";
//echo "$myrow[2] <br>";
		}
		if($myrow[4] == 'Text')
		{

			$html = $html . "<td><span class=\"labeltext\"><p align=\"left\">$myrow[2] </p></td>
	  		         <td ><input type=\"text\" size=15  name=\"$myrow[3]\" maxlength=\"50\":></td>";
			$i++;
		}
		if($myrow[4] == 'Numeric' || $myrow[4] == 'Decimal')
		{

			$html = $html . "<td><span class=\"labeltext\"><p align=\"left\">$myrow[2] </p></td>
	  		         <td ><input type=\"text\" size=15  name=\"$myrow[3]\" ></td>";
			$i++;
		}

		else if($myrow[4] == 'Desc Text')
		{
		       if( $i % 2 != 0 )
		       {
			$html = $html . "<td colspan=2>&nbsp;</td></tr><tr bgcolor=\"#FFFFFF\" width=100%>";
			$i++;
	 	        }

			$html = $html . "<td><span class=\"labeltext\"><p align=\"left\">$myrow[2] </p></td>
	  		         <td colspan=3 ><input type=\"text\" size=80 name=\"$myrow[3]\" ></td>";
		       $i+=2;
		}

		else if($myrow[4] == 'Long')
		{
		       if( $i % 2 != 0 )
		       {
			$html = $html . "<td colspan=2>&nbsp;</td></tr><tr bgcolor=\"#DDDEDD\" width=100%>";
			$i++;
		      }

			$html = $html . "
				        <td ><span class=\"heading\"><center><b>$myrow[2]</b></center></td>
				        <td colspan=3><textarea name=\"$myrow[3]\" rows=\"6\" cols=\"50\" value=\"\"></textarea></td>";
		        $i+=2;
		}
		else if($myrow[4] == 'Date')
		{
		            $html = $html . "<td><span class=\"labeltext\"><p align=\"left\">$myrow[2]</p></font></td>
			    <td><input type=\"text\" name=\"$myrow[3]\"
                    			style=\"background-color:#DDDDDD;\"
                   			 readonly=\"readonly\" size=12 >
             				<img src=\"images/bu-getdate.gif\" alt=\"$myrow[3]\" onclick=\"GetDate4template($dateindex)\">
			     </td>";
			$dateindex++;
			$i++;
		}
		if($myrow[4] == 'Check Box')
		{
				$html = $html . "<td><span class=\"labeltext\"><p align=\"left\">$myrow[2]</p></font></td>
				<td><span class=\"tabletext\"><input type=\"checkbox\" name=\"$myrow[3]\"  size=13 value=\"\" ></td>";
			$i++;
		}
		else if($myrow[4] == 'Part' )
		{
			$html = $html . "<td><span class=\"labeltext\"><p align=\"left\">$myrow[2]</p></font></td>
	            				<td><input type=\"text\" name=\"$myrow[3]\"
                    				style=\";background-color:#DDDDDD;\"
                   				readonly=\"readonly\" size=15 >
					<img src=\"images/bu-setpartnum.gif\" alt=\"$myrow[3]\"  onclick=\"VerifyPart($partindex,'part')\">
            				</td>";
			$i++;
			$partindex++;
		}
		else if($myrow[4] == 'Part With Qty' )
		{
		       $qty="qty" . $qtyindex;
		       $qtyindex++;
		       if( $i % 2 != 0 )
		       {
			$html = $html . "<td colspan=2>&nbsp;</td></tr><tr bgcolor=\"#FFFFFF\" width=100%>";
			$i++;
	 	        }

			$html = $html . "<td><span class=\"labeltext\"><p align=\"left\">$myrow[2]</p></font></td>
            				<td><input type=\"text\" name=\"$myrow[3]\"
                    				style=\";background-color:#DDDDDD;\"
                    				readonly=\"readonly\" size=10 >
             					<img src=\"images/bu-setpartnum.gif\" alt=\"$myrow[3]\"  onclick=\"VerifyPart($partqtyindex,'partqty')\"></td>
					<td><span class=\"labeltext\"><b>Qty</b></td>
					<td><input type=\"text\" name=\"$qty\" size=15 ></td>";
		         $i+=2;
		         $partqtyindex++;
		}
		if($i%2 == 0)
		{
			$html = $html . "</tr>";
		}

		//$i++;
	     	}
	                $j=$i;
		$j--;
		if( $j % 2 == 0 )
	               {
			$html = $html . "<td colspan=2>&nbsp;</td></tr>";
	               	}

          }
return $html;
}

function getwoDetails($pname,$recnum)
{
	        $sql = "select pf.recnum,pf.seqnum, pf.lname,pf.fname,pf.type,pf.link2pname,pf.mandatory
		     from   m_pagefields  pf,m_pagename p
		     where p.pname='$pname' and
		      pf.status='Active' and
		      pf.link2pname=p.recnum";
	        $result = mysql_query($sql);
	        $fieldname='';
	        $flag=0;
	        while ($myrow = mysql_fetch_row($result))
	       {
		       if($flag==0)
		       {
			       $fieldname = $myrow[3];
			       $flag=1;
		        }
		       else
			       $fieldname = $fieldname . "," . $myrow[3];
	       }
	       $sql = "select $fieldname from generic_tbl where recnum=$recnum";
	       $result = mysql_query($sql);
	       return $result;
}




function createctrls4edit($parent,$pname,$recnum)
{
        //echo "recnum is $recnum <br>";

        $html ='';
          $sqlgrp="select distinct f.pgroup from m_pagefields f,m_pagename p where p.pname='$pname' and
        p.parent='$parent' and link2pname=p.recnum";
        $resultgrp = mysql_query($sqlgrp);
        $partqtyindex=1;
        $partindex=1;
        $qtyindex=1;
        $dateindex=1;
        if($parent == 'Quote')
        	$table='generic_quote';
        else
        	$table='generic_wo';

        while ($myrowgrp = mysql_fetch_row($resultgrp))
        {
	        $html = $html . "<tr bgcolor=\"#DDDEDD\"><td colspan=4><span class=\"heading\"><center><b>$myrowgrp[0]</b></center></td>
	        </tr>";
	        $sql = "select pf.recnum,pf.seqnum, pf.lname,pf.fname,pf.type,pf.link2pname,pf.mandatory
		     from   m_pagefields  pf,m_pagename p
		     where p.pname='$pname' and
		     pf.status='Active' and
		     pf.link2pname=p.recnum
		     and pgroup='$myrowgrp[0]'";
		   //  echo("<br>$sql");
	        $result = mysql_query($sql);
	        $labelname='';
	        $fieldname='';
	        $flag=0;
	        while ($myrow = mysql_fetch_row($result))
	       {
	       
	        // echo "flag is" . $flag . "<br>";
	    	  if($flag==0)
		      {
		       $fieldname = $myrow[3];
		       $flag=1;
		      }
		      else
		       $fieldname = $fieldname . "," . $myrow[3];
             //echo $fieldname . "<br>";
	       }
         	      $sql1 = "select $fieldname from $table where recnum=$recnum";
              //  echo "$sql1 <br>";

	      $result1 = mysql_query($sql1);
	      $i=0;$k=0;
	      while ($myrow1=mysql_fetch_array($result1,MYSQL_ASSOC))
	      {
		$i=0;
		$result = mysql_query($sql);
		 while ($myrow = mysql_fetch_row($result))
		 {

		if($i%2 == 0 )
		{
			$html = $html . "<tr bgcolor=\"#FFFFFF\" width=100%>";
//echo "$myrow[2] <br>";
		}
		if($myrow[4] == 'Text')
		{

			$html = $html . "<td><span class=\"labeltext\"><p align=\"left\">$myrow[2] </p></td>
	  		         <td ><input type=\"text\" size=30  name=\"$myrow[3]\" maxlength=\"50\" value=\"" . $myrow1[$myrow[3]] . "\"></td>";
			$i++;
		}
		if($myrow[4] == 'Numeric' || $myrow[4] == 'Decimal')
		{

			$html = $html . "<td><span class=\"labeltext\"><p align=\"left\">$myrow[2] </p></td>
	  		         <td ><input type=\"text\" size=30  name=\"$myrow[3]\" value=\"" . $myrow1[$myrow[3]] . "\"></td>";
			$i++;
		}

		else if($myrow[4] == 'Desc Text')
		{
		       if( $i % 2 != 0 )
		       {
			$html = $html . "<td colspan=2>&nbsp;</td></tr><tr bgcolor=\"#FFFFFF\" width=100%>";
			$i++;
	 	        }

			$html = $html . "<td><span class=\"labeltext\"><p align=\"left\">*$myrow[2] #</p></td>
	  		         <td colspan=3 ><input type=\"text\" size=80 name=\"$myrow[3]\" value=\"" . $myrow1[$myrow[3]] . "\"></td>";
		       $i+=2;
		}

		else if($myrow[4] == 'Long')
		{
		       if( $i % 2 != 0 )
		       {
			$html = $html . "<td colspan=2>&nbsp;</td></tr><tr bgcolor=\"#DDDEDD\" width=100%>";
			$i++;
		      }

			$html = $html . "
				        <td ><span class=\"heading\"><center><b>$myrow[2]</b></center></td>
				        <td colspan=3><textarea name=\"$myrow[3]\" rows=\"6\" cols=\"50\" value=\"\"></textarea></td>";
		        $i+=2;
		}
		else if($myrow[4] == 'Date')
		{
		            $html = $html . "<td><span class=\"labeltext\"><p align=\"left\">$myrow[2]</p></font></td>
			    <td><input type=\"text\" name=\"$myrow[3]\"
                    			style=\"background-color:#DDDDDD;\"
                   			 readonly=\"readonly\" size=12 value=\"" . $myrow1[$myrow[3]] . "\">
             				<img src=\"images/bu-getdate.gif\" alt=\"$myrow[3]\" onclick=\"GetDate4template($dateindex)\">
			     </td>";
			$dateindex++;
			$i++;
		}
		if($myrow[4] == 'Check Box')
		{
			if ($myrow1[$myrow[3]] == 'y')
	   		{
				$html = $html . "<td><span class=\"labeltext\"><p align=\"left\">$myrow[2]</p></font></td>
				<td><span class=\"tabletext\"><input type=\"checkbox\" name=\"$myrow[3]\" size=13 value=\"\" checked></td>";
			}
			else
			{
				$html = $html . "<td><span class=\"labeltext\"><p align=\"left\">$myrow[2]</p></font></td>
				<td><span class=\"tabletext\"><input type=\"checkbox\" name=\"$myrow[3]\"  size=13 value=\"\" ></td>";
			 }
			$i++;
		}
		else if($myrow[4] == 'Part' )
		{
			$html = $html . "<td><span class=\"labeltext\"><p align=\"left\">$myrow[2]</p></font></td>
	            				<td><input type=\"text\" name=\"$myrow[3]\"
                    				style=\";background-color:#DDDDDD;\"
                   				readonly=\"readonly\" size=20 value=\"" . $myrow1[$myrow[3]] . "\">
					<img src=\"images/bu-setpartnum.gif\" alt=\"$myrow[3]\"  onclick=\"VerifyPart($partindex,'part')\">
            				</td>";
			$i++;
			$partindex++;
		}
		else if($myrow[4] == 'Part With Qty' )
		{
		       $qty="qty" . $qtyindex;

		       $qtyindex++;
		       if( $i % 2 != 0 )
		       {
			$html = $html . "<td colspan=2>&nbsp;</td></tr><tr bgcolor=\"#FFFFFF\" width=100%>";
			$i++;
	 	        }
			$html = $html . "<td><span class=\"labeltext\"><p align=\"left\">$myrow[2]</p></font></td>
            				<td><input type=\"text\" name=\"$myrow[3]\"
                    				style=\";background-color:#DDDDDD;\"
                    				readonly=\"readonly\" size=20 value=\"" . $myrow1[$myrow[3]] . "\">
             					<img src=\"images/bu-setpartnum.gif\" alt=\"$myrow[3]\"  onclick=\"VerifyPart($partqtyindex,'partqty')\"></td>
					<td><span class=\"labeltext\"><b>Qty</b></td>
					<td><input type=\"text\" name=\"$qty\" size=30 value=\"" . $myrow1[$qty] . "\"></td>";
		         $i+=2;
		         $partqtyindex++;
		}
		if($i%2 == 0)
		{
			$html = $html . "</tr>";
		}

		//$i++;
	     	}
	                $j=$i;
		$j--;
		if( $j % 2 == 0 )
	               {
			$html = $html . "<td colspan=2>&nbsp;</td></tr>";
	               	}
          	        }
          }
return $html;
}

function createctrls4display($parent,$pname,$recnum)
{
        $html ='';
        $sqlgrp="select distinct f.pgroup from m_pagefields f,m_pagename p where p.pname='$pname' and
         p.parent='$parent' and  link2pname=p.recnum";
        $resultgrp = mysql_query($sqlgrp);

        $partqtyindex=1;
        $partindex=1;
        $qtyindex=1;
        $dateindex=1;
        $i=0;$k=0;
        if($parent == 'Quote')
	$table='generic_quote';
        else
	$table='generic_wo';
        while ($myrowgrp = mysql_fetch_row($resultgrp))
        {
	        $html = $html . "<tr bgcolor=\"#DDDEDD\"><td colspan=4><span class=\"heading\"><center><b>$myrowgrp[0]</b></center></td>
         </tr>";
	        $sql = "select pf.recnum,pf.seqnum, pf.lname,pf.fname,pf.type,pf.link2pname,pf.mandatory
		     from   m_pagefields  pf,m_pagename p
		     where p.pname='$pname' and
		      pf.status='Active' and
		      pf.link2pname=p.recnum
		     and pgroup='$myrowgrp[0]'";
	        $result = mysql_query($sql);
	        $labelname='';
	        $fieldname='';
	        $flag=0;
	        while ($myrow = mysql_fetch_row($result))
	       {
		if($flag==0)
		{
		       $fieldname = $myrow[3];
		       $flag=1;
		}
		else
		       $fieldname = $fieldname . "," . $myrow[3];
	      }
         	      $sql1 = "select $fieldname from $table where recnum=$recnum";

//echo "<br>$sql1<br>";
	      $result1 = mysql_query($sql1);



	      while ($myrow1=mysql_fetch_array($result1,MYSQL_BOTH))
	      {
		$result = mysql_query($sql);
		 while ($myrow = mysql_fetch_row($result))
		 {
			//$x=$i%2;
			//echo " group :$myrowgrp[0] :    :$myrow[4]  :   :$i  <br>";

			if($i%2 == 0)
			{
				$html = $html . "<tr bgcolor=\"#FFFFFF\" width=100%>";
			}
			if($myrow[4] == 'Text' || $myrow[4] == 'Numeric' || $myrow[4] == 'Decimal')
			{
				$html = $html . "<td width=25%><span class=\"labeltext\"><p align=\"left\">$myrow[2] </p></td>
	  			         <td width=25%><span class=\"tabletext\">" . $myrow1[$myrow[3]] ."</td>";
				$i++;
			}
			else if($myrow[4] == 'Desc Text')
			{
			       if( $i % 2 != 0 )
			       {
				$html = $html . "<td colspan=2>&nbsp;</td></tr><tr bgcolor=\"#FFFFFF\" width=100%>";
				$i++;
		 	        }
				$html = $html . "<td width=25%><span class=\"labeltext\"><p align=\"left\">$myrow[2] </p></td>
		  		         <td width=25%><span class=\"tabletext\">" . $myrow1[$myrow[3]] ."</td>";
			       $i+=2;
			}
			else if($myrow[4] == 'Long')
			{
			       if( $i % 2 != 0 )
			       {
				$html = $html . "<td colspan=2 width=25%>&nbsp;</td></tr><tr bgcolor=\"#DDDEDD\" width=100%>";
				$i++;
			      }
				$html = $html . "
				        <td width=25%><span class=\"heading\"><b>$myrow[2]</b></td>
				         <td colspan=3 ><span class=\"tabletext\">" . $myrow1[$myrow[3]] ."</td>";
			        $i+=2;
			}

			else if($myrow[4] == 'Date')
			{
			            $html = $html . "<td width=25%><span class=\"labeltext\"><p align=\"left\">$myrow[2]</p></font></td>
				    <td width=25%><span class=\"tabletext\">" . $myrow1[$myrow[3]] . "
				     </td>";
				$i++;
				$dateindex++;
			}
			if($myrow[4] == 'Check Box')
			{
				if ($myrow1[$myrow[3]] == 'y')
		   		{
					$html = $html . "<td width=25%><span class=\"labeltext\"><p align=\"left\">$myrow[2]</p></font></td>
					<td width=25%><span class=\"tabletext\"><input type=\"checkbox\" name=\"$myrow[3]\" disabled size=13 value=\"\" checked></td>";
				}
				else
				{
					$html = $html . "<td width=25%><span class=\"labeltext\"><p align=\"left\">$myrow[2]</p></font></td>
					<td width=25%><span class=\"tabletext\"><input type=\"checkbox\" name=\"$myrow[3]\"  disabled size=13 value=\"\" ></td>";
				 }
				$i++;
			}
			else if($myrow[4] == 'Part' )
			{
				$html = $html . "<td width=25%><span class=\"labeltext\"><p align=\"left\">$myrow[2]</p></font></td>
	            				<td width=25%><span class=\"tabletext\">" . $myrow1[$myrow[3]] . "<td>";
				$i++;
			}
			else if($myrow[4] == 'Part With Qty' )
			{
			       $qty = "qty" . $partqtyindex;
			       if( $i % 2 != 0 )
			       {
				$html = $html . "<td width=25%>&nbsp;</td></tr><tr bgcolor=\"#FFFFFF\" width=100%>";
				$i++;

		 	        }
				$html = $html . "<td width=25%><span class=\"labeltext\"><p align=\"left\">$myrow[2]</p></font></td>
	            				<td width=25%><span class=\"tabletext\">" . $myrow1[$myrow[3]] . "</td>
					<td width=25%><span class=\"labeltext\"><b>Qty</b></td>
				 	<td width=25%><span class=\"tabletext\">" . $myrow1[$qty] . "</td>
					";
			     //  echo "qty1 =$qty ";echo "$myrow1[$qty]";
			       $i+=2;
			       $partqtyindex++;
			}
			/*else if($myrow[4] == 'Qty' )
			{
				$i--;
			}*/
			if($i%2 == 0)
			{
				$html = $html . "</tr>";
			}
			//$i++;
	     	}
	                $j=$i;
		$j--;
		if( $j % 2 == 0 )
	               {
			$html = $html . "<td colspan=2>&nbsp;</td></tr>";
			$i++;
	               	}
          	        }
          }
return $html;
}


function gettypes($argparent)
{
//        $newlogin = new userlogin;
//        $newlogin->dbconnect();
        $sql = "select type,type_limit from m_generic_limit where parent = '$argparent'";
//echo "<br>$sql<br>";
        $result = mysql_query($sql);

        // Test to make sure query worked
        if(!$result) die("Update of Page Name failed..Please report to Sysadmin " . mysql_error());
        return $result;
}

//==================================End of class====================================================================

}
