<?php
session_start();

// Zahrnutí souboru pro připojení k databázi
require_once '../database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (isset($data['dictionaryName'], $data['dictionary']) && is_array($data['dictionary'])) {
        $dictionary_name = $data['dictionaryName'];
        $dictionary_json = json_encode($data['dictionary']);
        $user_id = $_SESSION['user_id']; 

        // SQL dotaz pro vložení nebo aktualizaci slovníku
        $sql = "INSERT INTO dictionaries (user_id, dictionary_name, dictionary_data) 
                VALUES (?, ?, ?) 
                ON DUPLICATE KEY UPDATE dictionary_data = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('isss', $user_id, $dictionary_name, $dictionary_json, $dictionary_json);

        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(['message' => 'Dictionary saved successfully.']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Failed to save dictionary.']);
        }

        $stmt->close();
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Invalid data format.']);
    }

    $conn->close();
}
?>
