<?php

    // Clé secrète pour l'encryption
    define("CLE_ENCRYPTION", "ceci_est_une_cle_secrete");

    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Obtenir les données POST
        $doneesJSON = file_get_contents("php://input");

        // Décoder les données
        $donees = json_decode($doneesJSON, true);

        if (preg_match('/\/api\/encryption\.php\/encrypter$/', $_SERVER['REQUEST_URI'], $matches)) {

            if (isset($donees['valeur'])) {

                // Récupérer le mot de passe qui n'est pas encore encrypté
                $valeur = $donees['valeur'];
    
                // Encrypter le mot de passe
                $valeur_encryptee = AES256CBC_encrypter($valeur, CLE_ENCRYPTION);
    
                // Retourner le mot de passe encrypté
                echo json_encode(['valeur_encryptee' => $valeur_encryptee]);
    
            } else {
                
                // Code HTTP 400 - Bad Request  
                echo json_encode(['erreur' => 'Aucun mot de passe reçu.',
                                'code' => 400]);
                
            }
        
        } else if (preg_match('/\/api\/encryption\.php\/decrypter$/', $_SERVER['REQUEST_URI'], $matches)) { 

            if (isset($donees['valeur'])) {

                // Récupérer le mot de passe qui n'est pas encore encrypté
                $valeur = $donees['valeur'];
    
                // Encrypter le mot de passe
                $valeur_decrypte = AES256CBC_decrypter($valeur, CLE_ENCRYPTION);
    
                // Retourner le mot de passe encrypté
                echo json_encode(['valeur_decrypte' => $valeur_decrypte]);
    
            } else {
                
                // Code HTTP 400 - Bad Request  
                echo json_encode(['erreur' => 'Aucun mot de passe reçu.',
                                'code' => 400]);
                
            }

        } else { 

            // Code HTTP 404 - Not Found
            echo json_encode(['erreur' => 'Mauvaise route.',
                            'code' => 404]);

        }

    } else {

        // Code HTTP 405 - Method Not Allowed
        echo json_encode(['erreur' => 'Méthode non autorisée.',
                        'code' => 405]);

    }

    /*

        Les fonctions suivantes servent à encrypter et décrypter des valeurs en utilisant l'algorithme AES-256-CBC.

        Référence : https://fr.wikipedia.org/wiki/Advanced_Encryption_Standard
    
    */


    function AES256CBC_encrypter($valeur, $cle) {
        
        // Vecteur d'initialisation
        $vect = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        
        // Encrypter la valeur
        $valeurEncryptee = openssl_encrypt($valeur, 'aes-256-cbc', $cle, 0, $vect);
        
        // Retourner la valeur encryptée encodée en base64 (c.-à-d. en format texte)
        return base64_encode($valeurEncryptee . '::' . $vect);

    }


    function AES256CBC_decrypter($valeur, $cle) {
        
        // Décoder la valeur
        list($valeurEncryptee, $vect) = array_pad(explode('::', base64_decode($valeur), 2), 2, null);
        
        // Décrypter la valeur
        return openssl_decrypt($valeurEncryptee, 'aes-256-cbc', $cle, 0, $vect);

    }
    
?>