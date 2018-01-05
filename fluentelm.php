<?php 
	
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
 	header ( "Location: login.php" );
}

$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'Fluent ELM';
$page="ELM: Summary";

?>


<!DOCTYPE html>
<html>
<head>
	<title>Fluent ELM</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <link href="fluentelm/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- styles -->
  <link href="fluentelm/css/styles.css" rel="stylesheet">
  <link rel="stylesheet" href="fluentelm/css/angular-material.min.css">
  <link rel="stylesheet" href="fluentelm/css/md-data-table.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>


<body leftmargin="0" topmargin="0" marginwidth="0">
<?php
 include('header.html');
?>

	<div ng-app="fluent" >

		<header ng-controller="HeaderController">
			<!-- <div style="height:5em;"></div> -->
			<md-toolbar style="background-color: #34495E; height: 21px !important; min-height: 39px !important; ">
				<div class="md-toolbar-tools">
					<h2>
						<span ng-if="NavObject.Position>0" style="color: white !important;"><a href="fluentelm.php#!/summary">Home</a></span>
						<span ng-if="NavObject.Position>1" style="color: white !important;"><a href="fluentelm.php{{NavObject.ListingURL}}"><i class="material-icons md-light">swap_horiz</i>{{NavObject.ListingName}}</a></span>
						<span ng-if="NavObject.Position>2" style="color: white !important;"><a href="fluentelm.php{{NavObject.DetailsURL}}"><i class="material-icons md-light">swap_horiz</i>{{NavObject.DetailsName}}</a></span>
					</h2>
					<span flex></span>
					
				</div>
			</md-toolbar>
		</header>

		<main  style="text-align: center;margin-left: 2%;margin-right: 2%">
			<div class="page-content">
				<ui-view></ui-view>
				<!-- <div ng-view>
					content goes <header></header>
				</div> -->
			</div>
		</main>


		<div class="navbar navbar-default navbar-fixed-bottom">
			<footer >
				<div class="container ">
					<div class="text-center">
					&copy; <a href='#'>FluentSoft</a>&nbsp 2017
					</div>

				</div>
			</footer>
		</div>


		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="fluentelm/js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="fluentelm/js/angular.min.js"></script>
    <script src="fluentelm/js/angular-resource.min.js">
    </script>
    <script src="fluentelm/js/angular-route.min.js">   </script>
    <script src="fluentelm/js/angular-ui-router.js"></script>
    <script src="fluentelm/js/firebase.js"></script>
    <script src="fluentelm/js/angularfire.min.js"></script>
		<script src="fluentelm/js/angular-animate.min.js"></script>
		<script src="fluentelm/js/angular-sanitize.min.js"></script>
		<script src="fluentelm/js/angular-aria.min.js"></script>
		<script src="fluentelm/js/angular-messages.min.js"></script>
		<script src="fluentelm/js/angular-material.min.js"></script>
    <script src="fluentelm/bootstrap/js/bootstrap.min.js"></script>
    <script src="fluentelm/js/md-data-table.min.js"></script>
    <script src="fluentelm/js/custom.js"></script>
    <script type="text/javascript" src="fluentelm/js/app/app.js" ></script>
    <script type="text/javascript" src="fluentelm/js/app/controllers/HomeController.js" ></script>
    <script type="text/javascript" src="fluentelm/js/app/controllers/LandingController.js" ></script>
    <script type="text/javascript" src="fluentelm/js/app/controllers/ListingController.js" ></script>
	<script type="text/javascript" src="fluentelm/js/app/controllers/payrollController.js" ></script>
    <script type="text/javascript" src="fluentelm/js/app/services/HeaderService.js" ></script>

  </div>
</body>

</html>