<?php
	//Démarrage de la session
	session_start();

	//Récupération des positions
	include('datas.php');
?><!DOCTYPE html>
<html>
<head>
	<title>Lecture des informations du GPS</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>

	<!-- jQuery -->
	<script src="external/jquery/jquery.min.js"></script>
	<script src="external/jquery/jquery.mobile-1.4.5.min.js"></script>

	<!-- Leaflet -->
	<script src="external/leaflet/leaflet.js"></script>
	<link rel="stylesheet" href="external/leaflet/leaflet.css">

	<!-- CSS -->
	<link rel="stylesheet" href="css/global.css">

	<!-- JavaScript -->
	<script type="text/javascript">
		// Position du GPS
		var currentPos = {
			latitude: <?php echo $lat; ?>,
			longitude: <?php echo $long; ?>
		};

	</script>
	<script type="text/javascript" src="js/map.js"></script>
</head>
<body>

	<div class="info">
		<div class="titre">
			Informations g&eacute;n&eacute;riques
		</div>
		Latitude : <?php echo $lat; ?><br />
		Longitude : <?php echo $long; ?><br />
		Altitude : <?php echo $altitude; ?><br />
		Vitesse : <?php echo $speed; ?><br />
		<?php
			if($time_rec == time()) echo "A jour";
			elseif(time()-$time_rec == 1) echo "Il y a une seconde";
			else { echo "Il y a "; echo time()-$time_rec." secondes."; }
		?><br />
	</div>

	<div class="ui-content"><div id="levelMap" class="flex"></div></div>

	<!-- Rafraîchissement automatique de la page -->
	<meta http-equiv="refresh" content="3" />
</body>
</html>

