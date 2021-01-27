<?php

// Connexion
$user = "root";
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=bdd_temperaturevilles', $user, $pass);
$dbh->query("SET lc_time_names = 'fr_FR'");

// Récupération
$ville = $_GET['ville'];
$sth = $dbh->prepare('SELECT ville, temperature, DATE_FORMAT(last_update, "%d %M à %Hh%i") AS last_update FROM temperaturevilles WHERE ville = ?');
$sth->execute(array($ville));

// Affichage
$r = [];
while($data = $sth->fetch()) {
	$r['temperature'] = $data['temperature'];
	$r['ville'] = ucfirst($data['ville']);
	$r['last_update'] = $data['last_update'];
}

// Redirection
header("Location: index.php?ville=".$r['ville']."&temperature=".$r['temperature']."&last_update=".$r['last_update']);

// Fin
$sth = null;
$dbh = null;

?>