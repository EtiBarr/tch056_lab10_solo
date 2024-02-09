<?php

require_once('connexion.php');

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'GET') {


    if (preg_match('/\/api\/getMessage\.php\/getMessage$/', $_SERVER['REQUEST_URI'], $matches)) {

    try {
        // validate that the connection has been established
        if ($conn != null) {
            $requete = "SELECT * FROM messages";
            $stmt = $conn->prepare($requete);
            $stmt->execute();
    
            $messages = array(); // Initialize an array to store messages
    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $messageData = [
                    'username' => $row['auteur'], // Assuming 'username' is the column name in the messages table
                    'message' => $row['contenue'],   // Adjust accordingly based on your table structure
                    'date' => $row['date_publication'],
                ];
    
                $messages[] = $messageData; // Add each row to the messages array
            }
    
            echo json_encode(['messages' => $messages]);
            
        } else {
            echo json_encode(['erreur' => 'Pas de connection au serveur', 'code' => 400]);
        }
    } catch (PDOException $e) {
        echo json_encode(['erreur' => 'Erreur de la base de données', 'code' => 500]);
    }

} else {

    // Code HTTP 405 - Method Not Allowed
    echo json_encode(['erreur' => 'Méthode non autorisée.',
                    'code' => 405]);

}} else { 

    // Code HTTP 404 - Not Found
    echo json_encode(['erreur' => 'Mauvaise route.',
                    'code' => 404]);

}
?>