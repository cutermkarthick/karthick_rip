<?php
@session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$userid = $_SESSION['user'];
include_once('classes/userClass.php');
include_once('classes/loginClass.php');

$newlogin = new userlogin;
$newlogin->dbconnect();
$username = $_SESSION['user'];

$sql = "select d.crn, dli.partnum, 
                          dli.dispatch_qty, 
                          d.disp_date
                 from dispatch d, dispatch_line_items dli 
                 where d.recnum = dli.link2dispatch and
				              d.type = 'With Treatment' and
                             d.crn between '35-100' and '35-177' 
				 order by d.crn, d.disp_date
               ";
 $result = mysql_query($sql);
 ?>
 <link rel="stylesheet" href="style.css">
<table width=100% border=0 cellpadding=3 cellspacing=1 bgcolor="#DFDEDF">
<thead>
<tr>
<th bgcolor="#EEEFEE" align="center"><span class='tabletext'><b>PRN</b></th>
<th bgcolor="#EEEFEE" align="center"><span class='tabletext'><b>Part #</b></th>
<th bgcolor="#EEEFEE" align="center"><span class='tabletext'><b>First Disp Date</b></th>
<th bgcolor="#EEEFEE" align="center"><span class='tabletext'><b>First Disp Qty</b></th>
<th bgcolor="#EEEFEE" align="center"><span class='tabletext'><b>Qty Disp <br>Till Feb 2012</b></th>
<th bgcolor="#EEEFEE" align="center"><span class='tabletext'><b>Qty Disp <br>Mar - Aug 2012</b></th>
<th bgcolor="#EEEFEE" align="center"><span class='tabletext'><b>Last Disp Date</b></th>
<th bgcolor="#EEEFEE" align="center"><span class='tabletext'><b>Last Disp Qty</b></th>
<th bgcolor="#EEEFEE" align="center"><span class='tabletext'><b>Total Disp Qty</b></th>
</tr>
</thead>
<tbody>

<?php
$firsttime = 1;
$qtydispuptofeb2012 = 0;
$qtydispfeb2mar2012 = 0;
$totdispqty = 0;

while($myrow=mysql_fetch_row($result))
{
         if ($firsttime == 1) 
	    {
			  $prevcrn = $myrow[0];
		       if($myrow[3] != '0000-00-00' && $myrow[3] != '' && $myrow[3] != 'NULL')
              {
                   $datearr = split('-', $myrow[3]);
                   $d=$datearr[2];
                   $m=$datearr[1];
                   $y=$datearr[0];
                   $x=mktime(0,0,0,$m,$d,$y);
                   $firstdate=date("M j, Y",$x);
               }
              else
              {
                   $firstdate = '';
               }

?>
                <tr>
               <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $myrow[0] ?></td>
               <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $myrow[1] ?></td>
               <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $firstdate ?></td>
               <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $myrow[2] ?></td>

<?php
		}
         if ($firsttime == 0 && $myrow[0] != $prevcrn)
	     {
			  if($lastdispdate != '0000-00-00' && $lastdispdate != '' && $lastdispdate != 'NULL')
              {
                   $datearr = split('-', $lastdispdate);
                   $d=$datearr[2];
                   $m=$datearr[1];
                   $y=$datearr[0];
                   $x=mktime(0,0,0,$m,$d,$y);
                   $latestdate=date("M j, Y",$x);
               }
              else
              {
                   $latestdate = '';
               }
		       if($myrow[3] != '0000-00-00' && $myrow[3] != '' && $myrow[3] != 'NULL')
              {
                   $datearr = split('-', $myrow[3]);
                   $d=$datearr[2];
                   $m=$datearr[1];
                   $y=$datearr[0];
                   $x=mktime(0,0,0,$m,$d,$y);
                   $firstdate=date("M j, Y",$x);
               }
              else
              {
                   $firstdate = '';
               }

?>
               <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $qtydispuptofeb2012 ?></td>
			   <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $qtydispmar2aug2012 ?></td>
               <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $latestdate ?></td>
               <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $lastdispqty ?></td>
               <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $totdispqty ?></td>
			   </tr>
			   <tr>
               <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $myrow[0] ?></td>
               <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $myrow[1] ?></td>
               <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $firstdate ?></td>
               <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $myrow[2] ?></td>

<?php
	            $totdispqty = 0;
                $qtydispuptofeb2012 = 0;
                $qtydispmar2aug2012 = 0;
                $prevcrn = $myrow[0];
		 }
         $lastdispdate = $myrow[3];
         $lastdispqty = $myrow[2];
		 if ($myrow[3] < '2012-03-01')
	     {
                  $qtydispuptofeb2012 += $myrow[2];
	     }
		 if ($myrow[3] > '2012-02-29' && $myrow[3] < '2012-09-01')
	     {
                  $qtydispmar2aug2012 += $myrow[2];
	     }

		 $totdispqty += $myrow[2];
		 $firsttime = 0;
}
if ($lastdispdate != '0000-00-00' && $lastdispdate != '' && $lastdispdate != 'NULL')
{
       $datearr = split('-', $lastdispdate);
       $d=$datearr[2];
       $m=$datearr[1];
       $y=$datearr[0];
       $x=mktime(0,0,0,$m,$d,$y);
       $latestdate=date("M j, Y",$x);
}
else
{
        $latestdate = '';
}

?>
               <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $qtydispuptofeb2012 ?></td>
			   <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $qtydispmar2aug2012 ?></td>
               <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $latestdate ?></td>
               <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $lastdispqty ?></td>
               <td bgcolor="#FFFFFF" align="center"><span class="tabletext"><?php echo $totdispqty ?></td>
</tr>
</table>
</body>
</html>
