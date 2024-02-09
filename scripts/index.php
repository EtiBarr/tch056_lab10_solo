<?php

require_once('connexion.php');

// login verify start
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

    // validate that the connection has been established
    if ($conn != null) {

        // Get POST data
        $donneesJSON = file_get_contents("php://input");

        if (!empty($donneesJSON)) {
            $donnees = json_decode($donneesJSON, true);

            if (isset($donnees['valeurUser']) && isset($donnees['valeurPsw'])) {

                // Get username and password
                $valeurUser = $donnees['valeurUser'];
                $valeurPsw = $donnees['valeurPsw'];

                // SQL query
                $requete = "SELECT * FROM utilisateurs WHERE username = :username";
                // Execute the query
                $stmt = $conn->prepare($requete);
                $stmt->bindParam(':username', $valeurUser);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    $hash = $row['password'];

                    // Verify password
                    if (password_verify($valeurPsw, $hash)) {
                        echo json_encode(['success' => $success]);
                        session_start();
                        $_SESSION['identifiants'] = $valeurUser;
                        header("Location: forum.html");
                        exit();
                    } else {
                        echo json_encode(['erreur' => 'Mauvais mot de passe', 'code' => 400]);
                    }
                } else {
                    echo json_encode(['erreur' => 'Utilisateur non trouvé', 'code' => 404]);
                }

            } else {
                // HTTP 400 - Bad Request
                echo json_encode(['erreur' => 'Aucun nom d\'utilisateur ou mot de passe reçu.', 'code' => 400]);
            }

        } else {
            // HTTP 400 - Bad Request
            echo json_encode(['erreur' => 'Aucune donnée reçue.', 'code' => 400]);
        }

    } else {
        // HTTP 404 - Not Found
        echo json_encode(['erreur' => 'Mauvaise route.', 'code' => 404]);
    }
} else {
    echo json_encode(['erreur' => 'Requête non autorisée.', 'code' => 403]);
}

//login verification ends









/*




session_start();
require_once('connexion.php');

if ($conn == null) {
    die("Connexion échouée avec PDO : " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"));

$valeurUser = $data->valeurUser;
$valeurPsw = $data->valeurPsw;

// Perform your SQL query here to retrieve the user information based on the provided username
$requete = $conn->prepare("SELECT * FROM utilisateurs WHERE username = ?");
$requete->execute([$valeurUser]);

// Fetch user data
$userData = $requete->fetch();

if ($userData) {
    // Validate the password using password_verify
    if (password_verify($valeurPsw, $userData['hashed_password'])) {
        // Password is valid
        $success = true;
        $_SESSION['identifiants'] = $userData['identifiants']; 

        header('Location: forum.html'); //move user to the forum page

        } else {
        // Invalid password
        alert("wrong login");
        $success = false;
        $message = 'Mot de passe incorrect';
    }
} else {
    // User not found
    $success = false;
    $message = 'Utilisateur non trouvé';
}

$response = array('success' => $success, 'message' => $message);
echo json_encode($response);
*/
?>




































<?php
/*
        include 'en-tete.html';

        //require rather then include because the file is mandetory to run the 
        require('connexion.php');

            if ($conn == null) {
                die("Connexion échouée avec PDO : " . $conn->connect_error);
            } else {
                echo "Connexion réussie avec PDO!<br>";
            }

            // Requête SQL
            $requete = "SELECT * FROM utilisateurs WHERE courriel = :courielle";

            // Exécuter la requête
            $resultat = $conn->query($requete);

            // Afficher le nombre de résultats
            echo "Nombre de résultats: " . $resultat->rowCount() . "<br>";

            // Afficher les résultats ligne par ligne
            while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
                echo $ligne["prenom"] . $ligne["nom"] .$ligne["courriel"]. $ligne["mot_de_passe"] . "<br>";
            }

        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST'){

        $erreurs = array();

        //erreur 1
        if(($_POST['prenom']) && !ctype_alpha($_POST['prenom'])) {
            $erreurs[] = "le prenom est vide!<br>";
        } else{
            $prenom = trim($_POST['prenom']);
        }
        //erreur 2
        if(($_POST['nom']) && !ctype_alpha($_POST['nom'])) {
            $erreurs[] = "le nom est vide!<br>";
        }else{
            $nom = trim($_POST['nom']);
        }

        if(($_POST['courriel']) && (str_contains(($_POST['courriel']), '@'))) {
            $erreurs[] = "le couriel est vide!<br>";
        }else{
            $courriel = trim($_POST['courriel']);
        }
        //erreur 4
        if($_POST['psw'] != $_POST['psw2']){
            $erreurs[] = "Les mot de passe ne sont pas egale!<br>";
        } else{
            $mot_de_passe = trim($_POST['psw']);
        }
        //erreur 5

        $comp = $conn->prepare("SELECT courriel FROM tch056_labo_8 WHERE courriel LIKE :courriel");
        $comp->bindParam(':courriel', $courriel_in);
        $comp->execute();

        if ($comp->rowCount() > 0) {
        $erreurs[] = "Le courriel est déjà dans la base!<br>";
    }

    if(count($erreurs) != 0){ 

        foreach($erreurs as $erreur){
        echo "<p style='color:red;>". $erreurs."</p><br>";
        }
        exit();
        include 'pied.html';
    }

        }
        

        if(empty($erreurs)) {
            $prenom = $conn->quote($prenom);
            $nom = $conn->quote($nom);
            $courriel = $conn->quote($courriel);
            $psw = $conn->quote($psw);

            $query = "SELECT * FROM utilisateurs WHERE courriel = '$courriel'";
            $result = $conn->query($query);
            if (!$result) {
                die("requete echouee: " . $conn->errorInfo());
            }

            if ($result->rowCount() > 0) {
                echo "Un compte est déjà associé à cet email.";
            } else {
                $hash = password_hash($psw, PASSWORD_DEFAULT);
        
                $query_insert = $conn->prepare("INSERT INTO utilisateurs (prenom, nom, courriel, mot_de_passe) VALUES (:prenom, :nom, :courriel, :mot_de_passe)");
                $query_insert->bindParam(':prenom', $prenom);
                $query_insert->bindParam(':nom', $nom);
                $query_insert->bindParam(':courriel', $courriel);
                $query_insert->bindParam(':mot_de_passe', $psw);
                $result_insert = $query_insert->execute();
        
                if (!$result_insert) {
                    die("requete d'insertion echouee: " .$conn->errorInfo()[2]);
                }
            }
        }
        ?>

        <?php

        include 'pied.html';
*/
        ?>