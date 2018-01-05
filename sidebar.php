
<?php 
	$userid = $_SESSION['user'];
	$role = $_SESSION['userrole'];
	$type = $_SESSION['usertype'];
	$dept = $_SESSION['department'];

	include('classes/menuClass.php'); 
	$newmenu = new menu;

	$result = $newmenu->GetMenus4Dept($dept,$userrole);
	$mymenu = mysql_fetch_assoc($result);
	

	$menus = json_decode($mymenu['menus']);
	
?>	

	<link rel="stylesheet" href="./css/style.css" type="text/css" />
	<script type="text/javascript" src="./js/plugins/jquery-1.7.min.js"></script>
	<script type="text/javascript" src="./js/plugins/jquery.flot.min.js"></script>
	<script type="text/javascript" src="./js/plugins/jquery.flot.resize.min.js"></script>
	<script type="text/javascript" src="./js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="./js/custom/general.js"></script>
	<script type="text/javascript" src="./js/custom/dashboard.js"></script>
	<script type="text/javascript" src="./js/custom/tables.js"></script>
	<script language="javascript" type="text/javascript"></script>

</head>
<body>

	<div class="header radius3">
		<div class="headerinner">
			<div style="float:left; margin-right:15px;">
				<img  style="width:142px" src="./images/fsi_logo.png" alt="" />
			</div>

			<div style="float:left; margin-top:-17px;">
				<img style="width:846px;height:72px" src="./images/banner 2.jpg" alt="" />
			</div>

			<div class="headright">
				<div id="userPanel" class="headercolumn">
					<a href="" class="userinfo radius2">
						<img src="./images/avatar.png" alt="" class="radius2" />
						<span><strong><?php echo $userid;?></strong></span>
					</a>
					<div class="userdrop">
						<ul>
							<li><a href="">Profile</a></li>
							<li><a href="">Account Settings</a></li>
							<li><a href="./exit.php">Logout</a></li>
						</ul>
					</div><!--userdrop-->
				</div><!--headercolumn-->
			</div><!--headright-->

		</div><!--headerinner-->
	</div><!--header-->
	<!-- END OF HEADER -->


	<!-- START OF MAIN CONTENT -->
	<div class="mainwrapper">
		<div class="mainwrapperinner">

			<div class="mainleft">
				<div class="mainleftinner">
				<?php



				// if($mymenu['dept'] == 'Sales')
				// {
				?>
					<div class="expand">
						<div class="leftmenu">
							<ul id="new1">

								<?php 
									foreach ($menus as $key => $mainmenu) 
									{
									
										echo"<li id=\"acc$mainmenu->seqnum\"><a id=\"href$mainmenu->seqnum\" href=\"$mainmenu->href\" class=\"$mainmenu->class\"><span style=\"font-size: 13px !important;\">".$mainmenu->text ." </span></a>";

										if (isset($mainmenu->children)) {
											echo "<ul class=\"acc$mainmenu->seqnum\" id=\"acc$mainmenu->seqnum\">";
											foreach ($mainmenu->children as $key => $submenu) 
											{ 
											
											echo "<li id=\"ul1\"><a href=\"$submenu->href\"><span>". $submenu->text ."</span></a>";

												if (isset($submenu->children)) {
													echo "<ul class=\"\" id=\"\">";
													foreach ($submenu->children as $key => $submenu1) 
													{ 
														echo "<li id=\"\"><a href=\"$submenu1->href\"><span>".$submenu1->text."</span></a></li>";
													}
													echo "</ul>";
												}
												echo "</li>";	
											}
											echo "</ul>";
										}
										echo "</li>";	
									}

								?>

							</ul> 



						</div>                       
					</div>
					<?php
					// }
					// echo "<pre>";
					// print_r($menus); exit;
					?>

					<!--leftmenu-->
					<div id="togglemenuleft"><a></a></div>
				</div><!--mainleftinner-->
			</div><!--mainleft-->

			<div class="maincontent">
				<div class="maincontentinner">

					<ul class="maintabmenu">
						<li style="float:right;">
						<?php 
							if($type != 'CUST' && $dept != 'Trail')
							{
						?>
								<input type="button" class="stdbtn btn_blue" onclick="location.href='menu.php'" value="Menu">
								<?}?>
								<input type="button" class="stdbtn btn_blue" onclick="location.href='exit.php'" value="Logout"><button class="stdbtn btn_lime" onclick="javascript:flow_window()">Help &nbsp; <span style="color:#FFF;">?</span></button>
						</li>
						<?php 
							$page1 = explode(":", $page) ;
							if($page1[1] == ""){
						?>
							<li class="current" style="width:15%"><a href=""  ><?php echo $page1[0]; ?></a></li>
						<?php 
							}
							else 
							{
						?>
								<li class="current" style="width:17%" id="title1" class="title1"><a href="" ><?php echo $page1[1]; ?></a>
						<?php
							}
						?>

								<li class="current1"><a href=""><?php echo $page1[0]; ?></a></li>
								<input type="hidden" name="title1" id="title1" value="<?php echo $page;?>" >

					</ul><!--maintabmenu-->
				<div class="content" ></div>
	
</body>
</html>