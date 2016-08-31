<?php

	//Fichier de réception des données de la Raspberry PI
	// URL d'exemple : http://192.168.1.5/divers/balise_gps/send.php?lat=45.648289178&long=4.273633996&altitude=369.641&speed=0.0

	print_r($_GET);

	//Contrôle des données
	if(!isset($_GET['lat']) OR !isset($_GET['long']) OR !isset($_GET['altitude']) OR !isset($_GET['speed']))
	{
		die('Donnees incompl&egraves;tes');
	}

	//Enregistrement des données
	if(file_put_contents('datas.php', ' <?php //Donnees du GPS
$lat = '.$_GET['lat'].'; //Latitude du GPS
$long = '.$_GET['long'].'; //Longitude du GPS
$altitude = '.$_GET['altitude'].'; //Altitude du GPS
$speed = '.$_GET['speed'].'; //Vitesse du GPS (en m/s)
$time_rec = '.time().'; //Date de l\'enregistrement'))

		//Enregistrement des données terminé
		echo "Fini (0 erreur)";

	else //Erreur
		die('L\'enregistrement des donnees a &eacute;chou&eacute;.');

