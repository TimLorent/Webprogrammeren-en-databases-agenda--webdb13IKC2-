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
$titel = $_POST['titel'];
$begindatum = $_POST['begindatum'];
$einddatum = $_POST['einddatum'];
$ac_details = $_POST['activiteitdetails']; 
$target_group = $_POST['doelgroep'];
$start_time = $_POST['begintijd'];
$end_time = $_POST['eindtijd'];
$repeat_ac = $_POST['herhaal'];

/* echo 'Bedankt voor het toevoegen van een activiteit.';
echo 'Uw activiteit is als volgd toegevoegd: ';
echo 'Titel: ' . $titel . '.' ;
echo 'Datum: ' . $begindatum . ' & ' . $einddatum . '.' ;
echo 'Details: ' . $ac_details . '.' ;
echo 'Doelgroep: ' . $target_group . '.' ;
echo 'Tijd: ' . $start_time . ' & ' . $end_time . '.' ;
echo 'Herhaal afspraak: ' . $repeat_ac . '.' ; */
?> 

<?php

// Ervoor zorgen dat er geen vreemde tekens worden ingevoerd
$titel = htmlspecialchars($titel);
$begindatum = htmlspecialchars($begindatum);
$einddatum = htmlspecialchars($einddatum);
$ac_details = htmlspecialchars($ac_details);
$target_group = htmlspecialchars($target_group);
$start_time = htmlspecialchars($start_time);
$end_time = htmlspecialchars($end_time);
$repeat_ac = htmlspecialchars($repeat_ac);


// Connectie met database maken
$db = new PDO("mysql:host=localhost;dbname=webproject-ik", "root", "root");

// Aanmaken en voorbereiden van de query
$query = "INSERT INTO events SET event_title=:et, event_start=:es, event_end=:ee, event_desc=:ed, event_target_group=:etg, 
event_time_start=:ets, event_time_end=:ete, event_repeat=:er";

$stmt = $db->prepare($query);

// Try catch is om fouten op te vangen.
// Try dan wordt er geprobeerd de code in het try-blok uit te voeren
// Krijg je dan fouten, dan vang je deze op en vang je 'exceptions' op.
try {

// Query uitvoeren
// bindParam is om de waarden van de variabelen aan de 'named parameters' te binden.
$stmt->bindParam(':et', $titel, PDO::PARAM_STR);
$stmt->bindParam(':es', $begindatum, PDO::PARAM_STR);
$stmt->bindParam(':ee', $einddatum, PDO::PARAM_STR);
$stmt->bindParam(':ed', $ac_details, PDO::PARAM_STR);
$stmt->bindParam(':etg', $target_group, PDO::PARAM_STR);
$stmt->bindParam(':ets', $start_time, PDO::PARAM_STR);
$stmt->bindParam(':ete', $end_time, PDO::PARAM_STR);
$stmt->bindParam(':er', $repeat_ac, PDO::PARAM_STR);
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
