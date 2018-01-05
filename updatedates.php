<?php
include_once('classes/loginClass.php');
$newlogin = new userlogin;
$newlogin->dbconnect();
$ojectId="117647";
//$worecnum=array('10656','10655','10653','10652','10651');
for($value=10621;$value<=10656;$value++)
{

 
 $obj=$ojectId++;
$sql="INSERT INTO dates (recnum, type, doctype, sch_due, link2wo, link2doc, link2wfconfig, link2owner, link2contact,
                          `condition`,dependency, stagename, stagenum, dept, stagedependency)
                  VALUES ($obj, 'Aerowings', 'WO', 0000-00-00, $value, $value, 30, NULL, NULL,'NA','','WO_Recd',200,
                  'Stores', '' )" ;
//echo$sql;
mysql_query($sql);

   $obj++;

$sql="INSERT INTO dates (recnum, type, doctype, sch_due, link2wo, link2doc, link2wfconfig, link2owner, link2contact,
                         `condition`,dependency, stagename, stagenum, dept, stagedependency)
                  VALUES ($obj, 'Aerowings', 'WO', 0000-00-00, $value, $value, 40, NULL, NULL,'NA','200',
                  'Docs_Recd',210, 'Production', '200' )" ;
                  //echo$sql;
mysql_query($sql);
   $obj++;
$sql="INSERT INTO dates (recnum, type, doctype, sch_due, link2wo, link2doc, link2wfconfig, link2owner, link2contact,
                         `condition`, dependency, stagename, stagenum, dept, stagedependency)
                     VALUES ($obj, 'Aerowings', 'WO', 0000-00-00, $value, $value, 50, NULL, NULL,'NA','210','Recd_Material',220,
                            'Production', '210' )" ; //echo$sql;
                            mysql_query($sql);
    $obj++;
$sql="INSERT INTO dates (recnum, type, doctype, sch_due, link2wo, link2doc, link2wfconfig, link2owner, link2contact,
`condition`, dependency, stagename, stagenum, dept, stagedependency)
VALUES ($obj, 'Aerowings', 'WO', 0000-00-00, $value, $value, 60, NULL, NULL,'NA','220','Stage_Insp_Done',230,
'Production', '220' )";    //echo$sql;
   mysql_query($sql);
    $obj++;
$sql="INSERT INTO dates (recnum, type, doctype, sch_due, link2wo, link2doc, link2wfconfig, link2owner, link2contact,
`condition`, dependency, stagename, stagenum, dept, stagedependency)
 VALUES ($obj, 'Aerowings', 'WO', 0000-00-00, $value, $value, 70, NULL, NULL,'NA','230','Recd_Docs',240, 'PPC', '230' )"; //echo$sql;
     mysql_query($sql);
     $obj++;
$sql="INSERT INTO dates (recnum, type, doctype, sch_due, link2wo, link2doc, link2wfconfig, link2owner, link2contact,
`condition`, dependency, stagename, stagenum, dept, stagedependency)
VALUES ($obj, 'Aerowings', 'WO', 0000-00-00, $value, $value, 80, NULL, NULL,'NA','240','Recd_FG_For_FI',250, 'QA', '240' )"  ; //echo$sql;
      mysql_query($sql);
      $obj++;
$sql="INSERT INTO dates (recnum, type, doctype, sch_due, link2wo, link2doc, link2wfconfig, link2owner, link2contact,
`condition`, dependency, stagename, stagenum, dept, stagedependency)
VALUES ($obj, 'Aerowings', 'WO', 0000-00-00, $value, $value, 90, NULL, NULL,'NA','250','FI_Completed',260, 'QA', '250' )"; //echo$sql;
     mysql_query($sql);
     $obj++;
$sql="INSERT INTO dates (recnum, type, doctype, sch_due, link2wo, link2doc, link2wfconfig, link2owner, link2contact,
`condition`, dependency, stagename, stagenum, dept, stagedependency)
 VALUES ($obj, 'Aerowings', 'WO', 0000-00-00, $value, $value, 100, NULL, NULL,'NA','260','FG_Recd',270, 'Purchasing', '260' )" ;  //echo$sql;
     mysql_query($sql);
     $obj++;
$sql="INSERT INTO dates (recnum, type, doctype, sch_due, link2wo, link2doc, link2wfconfig, link2owner, link2contact,
`condition`, dependency, stagename, stagenum, dept, stagedependency)
 VALUES ($obj, 'Aerowings', 'WO', 0000-00-00, $value, $value, 110, NULL, NULL,'NA','270','WO_Closed',280, 'Purchasing', '270' )" ; //echo$sql;
mysql_query($sql);
echo "Processed work order recnum is $value<br>";
}

?>
