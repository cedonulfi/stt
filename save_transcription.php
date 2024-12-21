<?php
// Enable CORS for cross-origin requests (optional)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json');

// Read the incoming JSON data
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['text'])) {
    // Save the transcription to a file
    $file = 'transcriptions.txt';
    $text = $data['text'] . "\n";

    // Append to file
    if (file_put_contents($file, $text, FILE_APPEND | LOCK_EX)) {
        echo json_encode(['status' => 'success', 'message' => 'Transcription saved']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to save transcription']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No text received']);
}
