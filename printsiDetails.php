<table border=1 bgcolor="#DFDEDF" width=100% cellspacing=1 cellpadding=3 rules=all>

<tr  bgcolor="#DDDEDD" width=100%><td colspan=13 width=100%>
<table border=1 bgcolor="#000000" width=100% cellspacing=1 cellpadding=4 rules=all>
        <tr class="bgcolor1">
            <td colspan=17><span class="heading"><center><b>Stage Inspection Details</b></center></td>
        </tr>
<tr class="bgcolor1">
<td><span class="heading"><b><center>Operation No.</center></b></td>
<td ><span class="heading"><b><center>1</center></b></td>
<td><span class="heading"><b><center>2</center></b></td>
<td><span class="heading"><b><center>3</center></b></td>
<td><span class="heading"><b><center>4</center></b></td>
<td><span class="heading"><b><center>5</center></b></td>
<td><span class="heading"><b><center>6</center></b></td>
<td><span class="heading"><b><center>7</center></b></td>
<td><span class="heading"><b><center>8</center></b></td>
<td><span class="heading"><b><center>9</center></b></td>
<td><span class="heading"><b><center>10</center></b></td>
<td><span class="heading"><b><center>11</center></b></td>
<td><span class="heading"><b><center>12</center></b></td>
<td><span class="heading"><b><center>13</center></b></td>
<td><span class="heading"><b><center>14</center></b></td>
<td><span class="heading"><b><center>15</center></b></td>
<td><span class="heading"><b><center>Remarks</center></b></td>
</tr>

<tr class="bgcolor1">
   <td><span class="heading"><b><center>First off QC.</center></b></td>
     <?php

          $resultsi = $newsi->getsi($worecnum);

          	while ($mysi = mysql_fetch_row($resultsi))
        {
            printf('<td><span class="heading">%s</td>',$mysi[2]);
            $fremarks = $mysi[3];
        }
        printf('<td><span class="heading"><b><center>%s</center></b></td>',$fremarks);
     ?>
</tr>
	        
	        
	        
<tr class="bgcolor1">
   <td><span class="heading"><b><center>Production.</center></b></td>
    <?php

          $resultsi = $newsi->getsi($worecnum);

          	while ($mysi = mysql_fetch_row($resultsi))
        {
            printf('<td><span class="heading">%s</td>',$mysi[4]);
            $premarks = $mysi[5];
        }
        printf('<td><span class="heading"><b><center>%s</center></b></td>',$premarks);
    ?>
</tr>



<tr class="bgcolor1">
  <td><span class="heading"><b><center>QC Sign.</center></b></td>
   <?php

          $resultsi = $newsi->getsi($worecnum);

          	while ($mysi = mysql_fetch_row($resultsi))
        {
            printf('<td><span class="heading">%s</td>',$mysi[0]);
            $remarks = $mysi[1];
        }
        printf('<td><span class="heading"><b><center>%s</center></b></td>',$remarks);
   ?>
</tr>




<!--
<tr bgcolor="#E0EEE0">
<td><span class="heading"><b><center>QC Sign.</center></b></td>
<td><span class="heading"><b><center> </center></b></td>
<td><span class="heading"><b><center></center></b></td>
<td><span class="heading"><b><center></center></b></td>
<td><span class="heading"><b><center></center></b></td>
<td><span class="heading"><b><center></center></b></td>
<td><span class="heading"><b><center></center></b></td>
<td><span class="heading"><b><center></center></b></td>
<td><span class="heading"><b><center></center></b></td>
<td><span class="heading"><b><center></center></b></td>
<td><span class="heading"><b><center></center></b></td>
<td><span class="heading"><b><center></center></b></td>
<td><span class="heading"><b><center></center></b></td>
<td><span class="heading"><b><center></center></b></td>
<td><span class="heading"><b><center></center></b></td>
<td><span class="heading"><b><center></center></b></td>
<td><span class="heading"><b><center></center></b></td>
</tr>-->

</table>
</td></tr>

