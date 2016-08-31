<?php
	if(isset($_SERVER['argv'][1]))
	{
		echo " \n Traitement PHP \n Ouverture de l'URL :".$_SERVER['argv'][1]." \n\n";
		echo file_get_contents($_SERVER['argv'][1]);
		echo " \n Traitement PHP termine \n\n";
	}
	else
		echo "\n Erreur (PHP) : aucune URL specifiee. \n";
