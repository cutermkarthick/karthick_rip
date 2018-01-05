<?php 
include_once('classes/pagerClass.php');  
if (!isset ( $_REQUEST['page'] ) )
{
  $page = 1;
}
else { 
   $page = $_REQUEST['page'];
}
 
$limit = 1; 
$dbLink = mysql_connect("localhost","fsi1776","bm1547");
if(!$dbLink) die("Could not connect to database. " . mysql_errno()); 
mysql_select_db("dci"); 
$result = mysql_query("select count(*) from work_order order by wonum"); 
$total = mysql_result($result, 0, 0); 

// work out the pager values 
$pager = Pager::getPagerData($total, $limit, $page); 
$offset = $pager->offset; 
$limit = $pager->limit; 
$page = $pager->page; 

// use pager values to fetch data 
$query = "select * from work_order limit $offset, $limit"; 
$result = mysql_query($query); 
?>


    <table width=780>
    <tr><td>&nbsp</td></tr>
    <tr>
        <td><span class="pageheading"><b>List of Work Orders</b></td>
    </tr>
 
        <table width=780 border=1 bordercolor="#FFCC00" RULES=ALL FRAME=BOX>

        <tr bgcolor="#FFCC00">
            <td width="40"><span class="heading"><b>WO</b></td>
            <td width="60"><span class="heading"><b><center>Company</center></b></td>
            <td width="70"><span class="heading"><b><center>Designer</center></b></td>
            <td width="55"><span class="heading"><b><center>Type</center></b></td>
            <td width="60"><span class="heading"><b><center>Cust PO</center></b></td>
            <td width="60"><span class="heading"><b>Quote</b></td>  
            <td width="140"><span class="heading"><b><center>Status</center></b></td>    
            <td width="85"><span class="heading"><b><center>Sch Due Date(yymmdd)</center></b></td>
            <td width="85"><span class="heading"><b><center>Actual Ship Date(yymmdd)</center></b></td>  
                 
        </tr>


        
<?php

            
            $flag = 0;
        while ($myrow = mysql_fetch_row($result)) {
            if ($flag == 0) {
	      printf('<tr><td rowspan=2><span class="tabletext"><a href="worder_det.php?typenum=%s&wotype=%s&worecnum=%s">%s</td>
                      ',
		         $myrow[7],$myrow[1],$myrow[11],$myrow[0] 
                        );
              $flag = 1;
?>
                          <td><span class="tabletext"><?php echo $myrow[2] ?></td>
                          <td><span class="tabletext"><?php echo $myrow[13] ?></td>
                          <td><span class="tabletext"><?php echo $myrow[1] ?></td>
                          <td><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td><span class="tabletext"><?php echo $myrow[4] ?></td>
                          <td><span class="tabletext"><?php echo $myrow[5] ?></td>
               <td><span class="tabletext"><?php if ($myrow[14] != '00-00-00') echo $myrow[14] ?></td>
               <td><span class="tabletext"><?php if ($myrow[15] != '00-00-00') echo $myrow[15] ?></td></tr>
             <tr><td colspan=8><span class="heading">Description:<span class="tabletext"><?php echo $myrow[12] ?></td></tr>
        </tr>
<?php
        }

            else {
                     printf('<tr bgcolor="#EEEEEE"><td rowspan=2><span class="tabletext"><a href="worder_det.php?typenum=%s&wotype=%s&worecnum=%s">%s</td>
                      ',
		         $myrow[7],$myrow[1],$myrow[11],$myrow[0] 
                        );
                     $flag = 0;
?>
                          <td><span class="tabletext"><?php echo $myrow[2] ?></td>
                          <td><span class="tabletext"><?php echo $myrow[13] ?></td>
                          <td><span class="tabletext"><?php echo $myrow[1] ?></td>
                          <td><span class="tabletext"><?php echo $myrow[3] ?></td>
                          <td><span class="tabletext"><?php echo $myrow[4] ?></td>
                          <td><span class="tabletext"><?php echo $myrow[5] ?></td>
               <td><span class="tabletext"><?php if ($myrow[14] != '00-00-00') echo $myrow[14] ?></td>
               <td><span class="tabletext"><?php if ($myrow[15] != '00-00-00') echo $myrow[15] ?></td></tr>
             <tr bgcolor="#EEEEEE"><td colspan=8><span class="heading">Description:<span class="tabletext"><?php echo $myrow[12] ?></td></tr>
        </tr>
<?php
        }
    }
?>

        </tr>


        <tr>

            
        </tr>
        </table>


<?php
if ($page == 1) // this is the first page - there is no previous page 
echo "Previous"; 
else // not the first page, link to the previous page 
echo "<a href=\"paging.php?page=" . ($page - 1) . "\">Previous</a>"; 

for ($i = 1; $i <= $pager->numPages; $i++) { 
echo " | "; 
if ($i == $pager->page) 
echo "Page $i"; 
else 
echo "<a href=\"paging.php?page=$i\">Page $i</a>"; 
} 

if ($page == $pager->numPages) // this is the last page - there is no next page 
echo " | Next"; 
else // not the last page, link to the next page 
echo "<a href=\"paging.php?page=" . ($page + 1) . "\"> | Next</a>"; 
?> 
