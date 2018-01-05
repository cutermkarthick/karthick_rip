<?
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
include_once('classes/loginClass.php');
$newlogin = new userlogin;
$newlogin->dbconnect();
$fp = fopen("RMPrices_jan2013.csv","r");
$objid = 2060;
while (!(feof($fp)))
{
    $line = fgets($fp);
    echo "<br>$line";
	$inprec = explode("|", $line);
	//($seqnum,$crn,$spec,	$supp,$inpprice) = explode("\|", $line);
	$crn = $inprec[1];
	$spec = $inprec[2];
	$supp = $inprec[3];
	$price = trim(substr($inprec[4],1));
	//echo "<br>spec is $spec";
	//echo "<br>price is $price";
	
	if ($supp == 'ThyssenKrupp Aerospace, Birmingham, UK Limited')
	{
		$link2vendor = 45;
	}
	if ($supp == 'All Metals Services')
	{
		$link2vendor = 11;
	}
	if ($supp == 'ThyssenKrupp Aerospace, Milton Keynes, UK Limited')
	{
		$link2vendor = 46;
	}


    $objid = $objid + 1;
   // $sql = "select count(*) as numrow from rmmaster where 
//	                      crnnum = '$crnnum' and 
//						  rm_altrm = '$spec' and
//                          rm_supplier = '$supp'";
       	//	echo $sql;
       //    $result = mysql_query($sql);
         //  echo $result;
         //  $num=mysql_fetch_row($result);
         //  $numcrn=$num[0];
           //echo $numcrn;
               $sql = "INSERT INTO rmmaster
                            (
                            recnum,
							rmcode,
							rm_type,
							rm_spec,
							rm_dia,
							length,
							width,
							thickness,
							rm_ruling_dim,
							partnum,
							crnnum,
							rm_condition,
							rm_uom,
							rm_grainflow,
                            rm_lt,rm_st,
							rm_qty_perbill,
							rm_mrs,
							rm_unitprize,
							rm_supplier,
							rm_altrm,
							link2vendor,
							rm_status,
							directorsapproved,
							directorsapprovedby,
							rm_remarks,
                            createdate,
							eng_app_date,
							director_app_date,
							enggapproved,
							engapprovedby,
							currency,
							rm_bars_plates)
          select 
                            $objid,
							rmcode,
							rm_type,
							rm_spec,
							rm_dia,length,
							width,
							thickness,
							rm_ruling_dim,
							partnum,
							'$crn',
							rm_condition,rm_uom,
							rm_grainflow,
                            rm_lt,rm_st,
							rm_qty_perbill,
							rm_mrs,
							'$price',
							'$supp',
							'$spec',
							$link2vendor,
							'Pending',
							'',
							'',
							'',
                            '2013-01-06',
							'',
							'',
							'',
							'',
							'$',
							rm_bars_plates 
						from rmmaster
						where crnnum = '$crn' limit 1";
		//echo "<br>$sql";
        $result = mysql_query($sql);
        if(!$result) die("Insert failed for rmm $sql " . mysql_error());
		echo "<br>Insert successful for $crn";
}
fclose($fp);
