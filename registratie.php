<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <title>Registratie</title>
</head>

<body>

<?php

// Variabelen aanmaken waar de gegevens in worden opgeslagen.
$u_firstname = $_POST['voornaam'];
$u_lastname = $_POST['achternaam'];
$u_email = $_POST['email'];
$u_password = $_POST['wachtwoord'];

echo 'Welkom ' . $u_firstname . ' ' . $u_lastname . '.';
echo 'U staat geregistreerd onder dit email adres: ' . $u_email . 'en met het volgende wachtwoord: ' $u_password . '.';

?>

<?php

// Ervoor zorgen dat er geen vreemde tekens worden ingevoerd
$u_firstname = htmlspecialchars($u_firstname);
$u_lastname = htmlspecialchars($u_lastname);
$u_email = htmlspecialchars($u_email);
$u_password = htmlspecialchars($u_password);

// Connectie met database maken
$db = new PDO("mysql:host=localhost;dbname=webproject-ik", "root", "root");

// Aanmaken en voorbereiden van de query
$query = "INSERT INTO users SET user_firstname=:ufn, user_lastname=:uln, user_email=:uem, user_pass=:upass";
$stmt = $db->prepare($query);

// Try catch is om fouten op te vangen.
// Try dan wordt er geprobeerd de code in het try-blok uit te voeren
// Krijg je dan fouten, dan vang je deze op en vang je 'exceptions' op.
try {

// Query uitvoeren
// bindParam is om de waarden van de variabelen aan de 'named parameters' te binden.
$stmt->bindParam(':ufn', $u_firstname, PDO::PARAM_STR);
$stmt->bindParam(':uln', $u_lastname, PDO::PARAM_STR);
$stmt->bindParam(':uem', $u_email, PDO::PARAM_STR);
$stmt->bindParam(':upass', $u_password, PDO::PARAM_STR);
$stmt->execute();

// Verbinding met database sluiten
$stmt->closeCursor();

}
catch (Exception $e)
{
	die ($e->getMessage());
}

?>

</body>

</html>
