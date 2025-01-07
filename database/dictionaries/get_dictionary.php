<?php
require '../database.php';

if (isset($_GET['dictionary_name'])) {
    $dictionary_name = $_GET['dictionary_name'];

    // Vyhledání dat slovníku v databázi
    $sql = "SELECT dictionary_data FROM dictionaries WHERE dictionary_name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $dictionary_name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        header('Content-Type: application/json');
        echo json_encode(json_decode($row['dictionary_data'])); // Předpokládáme, že je uložen validní JSON
    } else {
        echo json_encode(['error' => 'Dictionary not found.']);
    }
} else {
    echo json_encode(['error' => 'No dictionary name provided.']);
}
mysqli_close($conn);
?>
