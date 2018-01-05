<?php
include('classes/mc_masterClass.php');
$newmc_master = new mc_master;
    		$row = 1;
    		$notime=0;
//echo $row;
			$handle = fopen("./upload/UpdationofTimemaster.csv", "r");
//$data=fgetcsv($handle, 1000, ",");
			$i=0;
			while ((($data = fgetcsv($handle, 1000, ",")) !== FALSE)){
//$num = count($data);
			$num=16;
//echo $num;
//echo "<p> $num fields in line $row: <br /></p>\n";
			$row++;
//echo $data[1];
//for ($c=0; $c < $num; $c++) {
//echo $data[$c] . "======";
				if($i==0 || $i==1)
					{
	//break;     .$data[0]."<br>"
	//echo "Inside if $data[0]-----$data[1]----------$data[2]<br>";
					}
			   else
					{
					
					 echo $data[0]."---in loop<br>";
					 $newmc_master->setcrn_num($data[0]);
                    $recnum= $newmc_master->check_crn_data($data[0]);
                    if($recnum=="")
                    {
                    $mc_masterrecnum = $newmc_master->addmc_master4upload();

                     $link2mc_master = $mc_masterrecnum;
					//echo  $data[0]."-------".$data[16]."----------".$data[17]."<br>";
					//print_r($data);
					$stagenum=array("1","3","5","7","9","11","13","15");

                    for($z=0;$z<24;$z++)
                    {
                      //echo "STAGENUM:$stagenum[$z] <br>";
                      if($stagenum[$z]==1)
                      {

                         if($data[3]>=60)
                          {
                            $hours = floor($data[3]/60);
                            $minutes = $data[3]%60;
                            //echo $hours."--**---".$minutes."<br>";
                            $newmc_master->setrunning_time($hours);
                            $newmc_master->setrunning_time_mins($minutes);
                          }else
                          {
                            $newmc_master->setrunning_time($notime);
                            $newmc_master->setrunning_time_mins($data[3]);
                          }
                          if($data[2]>=60)
                          {
                            $sethours = floor($data[2]/60);
                            $setminutes = $data[2]%60;
                            //echo $sethours."--**---".$setminutes."<br>";
                            $newmc_master->setsetting_time($sethours);
                            $newmc_master->setsetting_time_mins($setminutes);
                          }else
                          {
                            $newmc_master->setsetting_time($notime);
                            $newmc_master->setsetting_time_mins($data[2]);
                          }
  	                      $newmc_master->setstage_num($stagenum[$z]);
                          $newmc_master->setlink2mc_master($link2mc_master);
                          $newmc_master->addstage_data();
                      }
                      if($stagenum[$z]==3)
                      {     //echo $data[5]."--in l<br>";
                          if($data[5]>=60)
                          {
                            $hours = floor($data[5]/60);
                            $minutes = $data[5]%60;
                            //echo $hours."--**---".$minutes."<br>";
                            $newmc_master->setrunning_time($hours);
                            $newmc_master->setrunning_time_mins($minutes);
                          }else
                          {
                            $newmc_master->setrunning_time($notime);
                            $newmc_master->setrunning_time_mins($data[5]);
                          }
                          if($data[4]>=60)
                          {
                            $sethours = floor($data[4]/60);
                            $setminutes = $data[4]%60;
                            //echo $sethours."--**---".$setminutes."<br>";
                            $newmc_master->setsetting_time($sethours);
                            $newmc_master->setsetting_time_mins($setminutes);
                          }else
                          {
                            $newmc_master->setsetting_time($notime);
                            $newmc_master->setsetting_time_mins($data[4]);
                          }
  	                      $newmc_master->setstage_num($stagenum[$z]);
                          $newmc_master->setlink2mc_master($link2mc_master);
                          $newmc_master->addstage_data();
                      }
                      if($stagenum[$z]==5)
                      {
                         if($data[7]>=60)
                          {
                            $hours = floor($data[7]/60);
                            $minutes = $data[7]%60;
                            //echo $hours."--**---".$minutes."<br>";
                            $newmc_master->setrunning_time($hours);
                            $newmc_master->setrunning_time_mins($minutes);
                          }else
                          {
                            $newmc_master->setrunning_time($notime);
                            $newmc_master->setrunning_time_mins($data[7]);
                          }
                          if($data[6]>=60)
                          {
                            $sethours = floor($data[6]/60);
                            $setminutes = $data[6]%60;
                            //echo $sethours."--**---".$setminutes."<br>";
                            $newmc_master->setsetting_time($sethours);
                            $newmc_master->setsetting_time_mins($setminutes);
                          }else
                          {
                            $newmc_master->setsetting_time($notime);
                            $newmc_master->setsetting_time_mins($data[6]);
                          }
  	                      $newmc_master->setstage_num($stagenum[$z]);
                          $newmc_master->setlink2mc_master($link2mc_master);
                          $newmc_master->addstage_data();
                      }
                      if($stagenum[$z]==7)
                      {
                          if($data[9]>=60)
                          {
                            $hours = floor($data[9]/60);
                            $minutes = $data[9]%60;
                            //echo $hours."--**---".$minutes."<br>";
                            $newmc_master->setrunning_time($hours);
                            $newmc_master->setrunning_time_mins($minutes);
                          }else
                          {
                            $newmc_master->setrunning_time($notime);
                            $newmc_master->setrunning_time_mins($data[9]);
                          }
                          if($data[8]>=60)
                          {
                            $sethours = floor($data[8]/60);
                            $setminutes = $data[8]%60;
                            //echo $sethours."--**---".$setminutes."<br>";
                            $newmc_master->setsetting_time($sethours);
                            $newmc_master->setsetting_time_mins($setminutes);
                          }else
                          {
                            $newmc_master->setsetting_time($notime);
                            $newmc_master->setsetting_time_mins($data[8]);
                          }

  	                      $newmc_master->setstage_num($stagenum[$z]);
                          $newmc_master->setlink2mc_master($link2mc_master);
                         $newmc_master->addstage_data();
                      }
                       if($stagenum[$z]==9)
                      {
                          if($data[11]>=60)
                          {
                            $hours = floor($data[11]/60);
                            $minutes = $data[11]%60;
                            //echo $hours."--**---".$minutes."<br>";
                            $newmc_master->setrunning_time($hours);
                            $newmc_master->setrunning_time_mins($minutes);
                          }else
                          {
                            $newmc_master->setrunning_time($notime);
                            $newmc_master->setrunning_time_mins($data[11]);
                          }
                          if($data[10]>=60)
                          {
                            $sethours = floor($data[10]/60);
                            $setminutes = $data[10]%60;
                            //echo $sethours."--**---".$setminutes."<br>";
                            $newmc_master->setsetting_time($sethours);
                            $newmc_master->setsetting_time_mins($setminutes);
                          }else
                          {
                            $newmc_master->setsetting_time($notime);
                            $newmc_master->setsetting_time_mins($data[10]);
                          }
   	                      $newmc_master->setstage_num($stagenum[$z]);
                          $newmc_master->setlink2mc_master($link2mc_master);
                          $newmc_master->addstage_data();
                      }
                      if($stagenum[$z]==11)
                      {
                          if($data[13]>=60)
                          {
                            $hours = floor($data[13]/60);
                            $minutes = $data[13]%60;
                            //echo $hours."--**---".$minutes."<br>";
                            $newmc_master->setrunning_time($hours);
                            $newmc_master->setrunning_time_mins($minutes);
                          }else
                          {
                            $newmc_master->setsetting_time($notime);
                            $newmc_master->setrunning_time_mins($data[13]);
                          }
                          if($data[12]>=60)
                          {
                            $sethours = floor($data[12]/60);
                            $setminutes = $data[12]%60;
                            //echo $sethours."--**---".$setminutes."<br>";
                            $newmc_master->setsetting_time($sethours);
                            $newmc_master->setsetting_time_mins($setminutes);
                          }else
                          {
                            $newmc_master->setsetting_time($notime);
                            $newmc_master->setsetting_time_mins($data[12]);
                          }
   	                      $newmc_master->setstage_num($stagenum[$z]);
                          $newmc_master->setlink2mc_master($link2mc_master);
                          $newmc_master->addstage_data();
                      }
                      if($stagenum[$z]==13)
                      {
                          if($data[15]>=60)
                          {
                            $hours = floor($data[15]/60);
                            $minutes = $data[15]%60;
                            //echo $hours."--**---".$minutes."<br>";
                            $newmc_master->setrunning_time($hours);
                            $newmc_master->setrunning_time_mins($minutes);
                          }else
                          {
                            $newmc_master->setrunning_time($notime);
                            $newmc_master->setrunning_time_mins($data[15]);
                          }
                          if($data[14]>=60)
                          {
                            $sethours = floor($data[14]/60);
                            $setminutes = $data[14]%60;
                            //echo $sethours."--**---".$setminutes."<br>";
                            $newmc_master->setsetting_time($sethours);
                            $newmc_master->setsetting_time_mins($setminutes);
                          }else
                          {
                            $newmc_master->setsetting_time($notime);
                            $newmc_master->setsetting_time_mins($data[14]);
                          }
  	                      $newmc_master->setstage_num($stagenum[$z]);
                          $newmc_master->setlink2mc_master($link2mc_master);
                          $newmc_master->addstage_data();
                      }
                      if($stagenum[$z]==15)
                      {
                          if($data[17]>=60)
                          {
                            $hours = floor($data[17]/60);
                            $minutes = $data[17]%60;
                            //echo $hours."--**---".$minutes."<br>";
                            $newmc_master->setrunning_time($hours);
                            $newmc_master->setrunning_time_mins($minutes);
                          }else
                          {
                            $newmc_master->setrunning_time($notime);
                            $newmc_master->setrunning_time_mins($data[17]);
                          }
                          if($data[16]>=60)
                          {
                            $sethours = floor($data[16]/60);
                            $setminutes = $data[16]%60;
                            //echo $sethours."--**---".$setminutes."<br>";
                            $newmc_master->setsetting_time($sethours);
                            $newmc_master->setsetting_time_mins($setminutes);
                          }else
                          {
                            $newmc_master->setsetting_time($notime);
                            $newmc_master->setsetting_time_mins($data[16]);
                          }
  	                      $newmc_master->setstage_num($stagenum[$z]);
                          $newmc_master->setlink2mc_master($link2mc_master);
                          $newmc_master->addstage_data();
                      }


                    }
                  }else
                  {
                     $link2mc_master = $recnum;
                     $stagenum=array("1","3","5","7","9","11","13","15");

                    for($z=0;$z<24;$z++)
                    {
                      //echo "STAGENUM:$stagenum[$z] <br>";
                      if($stagenum[$z]==1)
                      {

                         if($data[3]>=60)
                          {
                            $hours = floor($data[3]/60);
                            $minutes = $data[3]%60;
                            //echo $hours."--**---".$minutes."<br>";
                            $newmc_master->setrunning_time($hours);
                            $newmc_master->setrunning_time_mins($minutes);
                          }else
                          {
                            $newmc_master->setrunning_time($notime);
                            $newmc_master->setrunning_time_mins($data[3]);
                          }
                          if($data[2]>=60)
                          {
                            $sethours = floor($data[2]/60);
                            $setminutes = $data[2]%60;
                            //echo $sethours."--**---".$setminutes."<br>";
                            $newmc_master->setsetting_time($sethours);
                            $newmc_master->setsetting_time_mins($setminutes);
                          }else
                          {
                            $newmc_master->setsetting_time($notime);
                            $newmc_master->setsetting_time_mins($data[2]);
                          }
  	                      $newmc_master->setstage_num($stagenum[$z]);
                          $newmc_master->setlink2mc_master($link2mc_master);
                          $newmc_master->updatestage_data($link2mc_master);
                      }
                      if($stagenum[$z]==3)
                      {     //echo $data[5]."--in l<br>";
                          if($data[5]>=60)
                          {
                            $hours = floor($data[5]/60);
                            $minutes = $data[5]%60;
                            //echo $hours."--**---".$minutes."<br>";
                            $newmc_master->setrunning_time($hours);
                            $newmc_master->setrunning_time_mins($minutes);
                          }else
                          {
                            $newmc_master->setrunning_time($notime);
                            $newmc_master->setrunning_time_mins($data[5]);
                          }
                          if($data[4]>=60)
                          {
                            $sethours = floor($data[4]/60);
                            $setminutes = $data[4]%60;
                            //echo $sethours."--**---".$setminutes."<br>";
                            $newmc_master->setsetting_time($sethours);
                            $newmc_master->setsetting_time_mins($setminutes);
                          }else
                          {
                            $newmc_master->setsetting_time($notime);
                            $newmc_master->setsetting_time_mins($data[4]);
                          }
  	                      $newmc_master->setstage_num($stagenum[$z]);
                          $newmc_master->setlink2mc_master($link2mc_master);
                          $newmc_master->updatestage_data($link2mc_master);
                      }
                      if($stagenum[$z]==5)
                      {
                         if($data[7]>=60)
                          {
                            $hours = floor($data[7]/60);
                            $minutes = $data[7]%60;
                            //echo $hours."--**---".$minutes."<br>";
                            $newmc_master->setrunning_time($hours);
                            $newmc_master->setrunning_time_mins($minutes);
                          }else
                          {
                            $newmc_master->setrunning_time($notime);
                            $newmc_master->setrunning_time_mins($data[7]);
                          }
                          if($data[6]>=60)
                          {
                            $sethours = floor($data[6]/60);
                            $setminutes = $data[6]%60;
                            //echo $sethours."--**---".$setminutes."<br>";
                            $newmc_master->setsetting_time($sethours);
                            $newmc_master->setsetting_time_mins($setminutes);
                          }else
                          {
                            $newmc_master->setsetting_time($notime);
                            $newmc_master->setsetting_time_mins($data[6]);
                          }
  	                      $newmc_master->setstage_num($stagenum[$z]);
                          $newmc_master->setlink2mc_master($link2mc_master);
                          $newmc_master->updatestage_data($link2mc_master);
                      }
                      if($stagenum[$z]==7)
                      {
                          if($data[9]>=60)
                          {
                            $hours = floor($data[9]/60);
                            $minutes = $data[9]%60;
                            //echo $hours."--**---".$minutes."<br>";
                            $newmc_master->setrunning_time($hours);
                            $newmc_master->setrunning_time_mins($minutes);
                          }else
                          {
                            $newmc_master->setrunning_time($notime);
                            $newmc_master->setrunning_time_mins($data[9]);
                          }
                          if($data[8]>=60)
                          {
                            $sethours = floor($data[8]/60);
                            $setminutes = $data[8]%60;
                            //echo $sethours."--**---".$setminutes."<br>";
                            $newmc_master->setsetting_time($sethours);
                            $newmc_master->setsetting_time_mins($setminutes);
                          }else
                          {
                            $newmc_master->setsetting_time($notime);
                            $newmc_master->setsetting_time_mins($data[8]);
                          }

  	                      $newmc_master->setstage_num($stagenum[$z]);
                          $newmc_master->setlink2mc_master($link2mc_master);
                         $newmc_master->updatestage_data($link2mc_master);
                      }
                       if($stagenum[$z]==9)
                      {
                          if($data[11]>=60)
                          {
                            $hours = floor($data[11]/60);
                            $minutes = $data[11]%60;
                            //echo $hours."--**---".$minutes."<br>";
                            $newmc_master->setrunning_time($hours);
                            $newmc_master->setrunning_time_mins($minutes);
                          }else
                          {
                            $newmc_master->setrunning_time($notime);
                            $newmc_master->setrunning_time_mins($data[11]);
                          }
                          if($data[10]>=60)
                          {
                            $sethours = floor($data[10]/60);
                            $setminutes = $data[10]%60;
                            //echo $sethours."--**---".$setminutes."<br>";
                            $newmc_master->setsetting_time($sethours);
                            $newmc_master->setsetting_time_mins($setminutes);
                          }else
                          {
                            $newmc_master->setsetting_time($notime);
                            $newmc_master->setsetting_time_mins($data[10]);
                          }
   	                      $newmc_master->setstage_num($stagenum[$z]);
                          $newmc_master->setlink2mc_master($link2mc_master);
                          $newmc_master->updatestage_data($link2mc_master);
                      }
                      if($stagenum[$z]==11)
                      {
                          if($data[13]>=60)
                          {
                            $hours = floor($data[13]/60);
                            $minutes = $data[13]%60;
                            //echo $hours."--**---".$minutes."<br>";
                            $newmc_master->setrunning_time($hours);
                            $newmc_master->setrunning_time_mins($minutes);
                          }else
                          {
                            $newmc_master->setsetting_time($notime);
                            $newmc_master->setrunning_time_mins($data[13]);
                          }
                          if($data[12]>=60)
                          {
                            $sethours = floor($data[12]/60);
                            $setminutes = $data[12]%60;
                            //echo $sethours."--**---".$setminutes."<br>";
                            $newmc_master->setsetting_time($sethours);
                            $newmc_master->setsetting_time_mins($setminutes);
                          }else
                          {
                            $newmc_master->setsetting_time($notime);
                            $newmc_master->setsetting_time_mins($data[12]);
                          }
   	                      $newmc_master->setstage_num($stagenum[$z]);
                          $newmc_master->setlink2mc_master($link2mc_master);
                          $newmc_master->updatestage_data($link2mc_master);
                      }
                      if($stagenum[$z]==13)
                      {
                          if($data[15]>=60)
                          {
                            $hours = floor($data[15]/60);
                            $minutes = $data[15]%60;
                            //echo $hours."--**---".$minutes."<br>";
                            $newmc_master->setrunning_time($hours);
                            $newmc_master->setrunning_time_mins($minutes);
                          }else
                          {
                            $newmc_master->setrunning_time($notime);
                            $newmc_master->setrunning_time_mins($data[15]);
                          }
                          if($data[14]>=60)
                          {
                            $sethours = floor($data[14]/60);
                            $setminutes = $data[14]%60;
                            //echo $sethours."--**---".$setminutes."<br>";
                            $newmc_master->setsetting_time($sethours);
                            $newmc_master->setsetting_time_mins($setminutes);
                          }else
                          {
                            $newmc_master->setsetting_time($notime);
                            $newmc_master->setsetting_time_mins($data[14]);
                          }
  	                      $newmc_master->setstage_num($stagenum[$z]);
                          $newmc_master->setlink2mc_master($link2mc_master);
                          $newmc_master->updatestage_data($link2mc_master);
                      }
                      if($stagenum[$z]==15)
                      {
                          if($data[17]>=60)
                          {
                            $hours = floor($data[17]/60);
                            $minutes = $data[17]%60;
                            //echo $hours."--**---".$minutes."<br>";
                            $newmc_master->setrunning_time($hours);
                            $newmc_master->setrunning_time_mins($minutes);
                          }else
                          {
                            $newmc_master->setrunning_time($notime);
                            $newmc_master->setrunning_time_mins($data[17]);
                          }
                          if($data[16]>=60)
                          {
                            $sethours = floor($data[16]/60);
                            $setminutes = $data[16]%60;
                            //echo $sethours."--**---".$setminutes."<br>";
                            $newmc_master->setsetting_time($sethours);
                            $newmc_master->setsetting_time_mins($setminutes);
                          }else
                          {
                            $newmc_master->setsetting_time($notime);
                            $newmc_master->setsetting_time_mins($data[16]);
                          }
  	                      $newmc_master->setstage_num($stagenum[$z]);
                          $newmc_master->setlink2mc_master($link2mc_master);
                          $newmc_master->updatestage_data($link2mc_master);
                      }


                    }
                  }
                    /*echo $data[0]."-----".$data[2]."in looop------".$data[3]."in looop------".$data[4]."in looop------".$data[5].
                       "in looop------".$data[6]."in looop------".$data[7]."in looop------".$data[8]."in looop------".$data[9].
                       "in looop------".$data[10]."in looop------".$data[11]."in looop------".$data[12]."in looop------".$data[13].
                       "in looop------".$data[14]."in looop------".$data[15]."in looop------".$data[16]." <br>";   */




//echo "<br>";

					}
					$i++;
				}
fclose($handle);
header("Location:mc_master_summary.php");
?>
