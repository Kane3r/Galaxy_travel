<?php

$apiKey = 'AIzaSyDImtnxsmIrGdgpy0XbmBq0u96fS7_fzYo'; // 

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$userMessage = $input['message'] ?? '';


if (!$userMessage) {
    echo json_encode(['reply' => 'Error: Mensaje vacío recibido.']);
    exit;
}


$ch = curl_init();


$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $apiKey;


$data = [
    'contents' => [[
        'parts' => [[ 'text' => $userMessage ]]
    ]]
];

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Devuelve la respuesta como string
curl_setopt($ch, CURLOPT_POST, true);           // Configura la solicitud como POST
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']); // Indica que enviamos JSON
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Adjunta los datos JSON

$response = curl_exec($ch);      
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
$error = curl_error($ch);        
curl_close($ch);                 


if (!$response) {
    
    echo json_encode(['reply' => "Error de red o cURL: $error"]);
    exit;
}

$result = json_decode($response, true); 


if ($httpCode !== 200 || !isset($result['candidates'][0]['content']['parts'][0]['text'])) {
    $errorMsg = $result['error']['message'] ?? 'Error desconocido de la API';
    echo json_encode(['reply' => "Error API ($httpCode): $errorMsg"]);
    exit;
}


$reply = $result['candidates'][0]['content']['parts'][0]['text'];
echo json_encode(['reply' => $reply]);

?>