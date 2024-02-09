<?php

    // Clé secrète pour l'encryption
    define("CLE_ENCRYPTION", "ceci_est_une_cle_secrete");

    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Obtenir les données POST
        $doneesJSON = file_get_contents("php://input");

        // Décoder les données
        $donees = json_decode($doneesJSON, true);

        if (preg_match('/\/api\/postMessage\.php\/postMessage$/', $_SERVER['REQUEST_URI'], $matches)) {

            if (isset($donees['valeur'])) {

                $valeur = $donees['valeur'];
    
                //if the connection is valid, insert the value into the data base and return a succhess response
                if ($conn != null) {
                    $requete = "INSERT INTO message (auteur, contenu, date_de_publication)
                    VALUES ('$valeurUser', '$valeur', '" . date("Y/m/d") . "');";
        
                }

                echo json_encode(['Success' => $reponse]);
    
            } else {
                
                // Code HTTP 400 - Bad Request  
                echo json_encode(['erreur' => 'Aucun mot de passe reçu.',
                                'code' => 400]);
                
            }
        
        } 
        else { 

            // Code HTTP 404 - Not Found
            echo json_encode(['erreur' => 'Mauvaise route.',
                            'code' => 404]);

        }

    } else {

        // Code HTTP 405 - Method Not Allowed
        echo json_encode(['erreur' => 'Méthode non autorisée.',
                        'code' => 405]);

    }


    ?>