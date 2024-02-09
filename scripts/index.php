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








?>