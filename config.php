<?php
try
{
	$bdd = new PDO('mysql:host=localhost:3306;dbname=projet_annuel' , 'root' , '' , array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());
}
?>
