<?php

 include_once('classes/dnClass.php');
 include_once('classes/dnliClass.php');

 $newLI = new dnli;

 $result = $newLI->getdeliver_restore();

            while ($myrow = mysql_fetch_assoc($result))
          {
               $dn_qty_accepted=$newLI->getcomp_qty4wo($myrow['wonum']);
               $newLI->updateWO_comp($dn_qty_accepted,$myrow['wonum']);
               echo "<br>WO comp qty updated for wonum".  $myrow['wonum'] ."<br>";

          }

?>
