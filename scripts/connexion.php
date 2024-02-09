<?php
/*
function connexionPDO($prenom, $nom, $couriel, $psw) {

      try {

            // Établir la connexion avec PDO
            $conn = new PDO("mysql:host=$prenom;dbname=$nom", $courielle, $psw);

            // Activer le mode d'erreur
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      } catch(PDOException $e) {

      // Retourner une valeur vide en cas d'échec de la connexion
      return null;

      }

}

*/
/*
// Paramètres de connexion à la base de données
$hostname = "localhost";
$identifiant = "admin";
$mot_de_passe = "admin";
$database = "tch056_projet_integrateur";

try {
    // Établir la connexion avec PDO
    $conn = new PDO("mysql:host=$hostname;dbname=$database", $identifiant, $mot_de_passe);

    // Activer le mode d'erreur
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Afficher un message si la connexion est réussie
    echo "Connexion réussie avec PDO!";

    // Perform a test query
    $test = "SELECT * FROM utilisateurs";
    $resultTest = $conn->query($test);

    // Check if the query was successful
    if ($resultTest !== false) {
        // Fetch and print the results
        $rows = $resultTest->fetchAll(PDO::FETCH_ASSOC);
        print_r($rows);
    } else {
        // Print an error message if the query failed
        die("Erreur lors de l'exécution de la requête: " . $conn->errorInfo()[2]);
    }

} catch(PDOException $e) {
    // Arrêter le script si la connexion échoue
    die("Connexion échouée: " . $e->getMessage());
}

*/


// Paramètres de connexion à la base de données
//this works well
$hostname = "localhost";
$username = "admin";
$password = "admin";
$database = "tch056_projet_integrateur";
try {
    // Établir la connexion avec PDO
    $conn = new PDO("mysql:host=$hostname;dbname=$database",
                    $username,
                    $password);

    // Activer le mode d'erreur
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Afficher un message si la connexion est réussie
    echo "Connexion réussie avec PDO!";


    /*
// Perform a test query
    $test = "SELECT * FROM utilisateurs";
    $resultTest = $conn->query($test);

    
    //test to see if queury worked
    if ($resultTest !== false) {
        // Fetch and print the results
        $rows = $resultTest->fetchAll(PDO::FETCH_ASSOC);
        print_r($rows);
    } else {
        // Print an error message if the query failed
        die("Erreur lors de l'exécution de la requête: " . $conn->errorInfo()[2]);
    }
*/

}   catch(PDOException $e) {// Arrêter le script si la connexion échoue
    die("Connexion échouée: " . $e->getMessage());
}

?>

