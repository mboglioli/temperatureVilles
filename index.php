<?php
// Connexion
$user = "root";
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=bdd_temperaturevilles', $user, $pass);
$dbh->query("SET lc_time_names = 'fr_FR'");

// Récupération
$sth = $dbh->prepare('SELECT ville FROM temperaturevilles');
$sth->execute();
?>

<html>
<head>
</head>

<body>

	<form action="affichage_temperature.php" method="get">
		<label for="pet-select">Choisissez une ville:</label>
		<select name="ville" id="city-select">
			
			<!-- Affichage -->
			<?php while($data = $sth->fetch()) { ?>
				<option value="<?php echo $data['ville'] ?>"><?php echo ucfirst($data['ville']) ?></option>
			<?php } ?>
		</select>
		<input type="submit" value="OK">
	</form>
	
	<?php
	if (isset($_GET['temperature']) && isset($_GET['ville']) && isset($_GET['last_update'])) {
		$texte = ("Le " . $_GET['last_update'] . " il faisait " . $_GET['temperature'] . "°C à " . $_GET['ville']);
		echo htmlspecialchars($texte, ENT_QUOTES, 'UTF-8');
	}
	?>
	
</body>
</html>
