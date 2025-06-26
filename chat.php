<?php

// ¡IMPORTANTE! NUNCA uses tu clave API directamente en el código de producción.
// Para uso personal y de prueba, está bien por ahora, pero busca alternativas
// como variables de entorno o archivos de configuración no accesibles públicamente.
$apiKey = 'AIzaSyDImtnxsmIrGdgpy0XbmBq0u96fS7_fzYo'; // <<< REEMPLAZA ESTO CON TU CLAVE API REAL DE GOOGLE AI STUDIO

header('Content-Type: application/json');

// Decodifica la entrada JSON del frontend
$input = json_decode(file_get_contents('php://input'), true);
$userMessage = $input['message'] ?? '';

// --- Manejo básico de errores de entrada ---
if (!$userMessage) {
    echo json_encode(['reply' => 'Error: Mensaje vacío recibido.']);
    exit;
}

// --- Configuración de la solicitud a la API de Gemini ---
$ch = curl_init();

// *** CORRECCIÓN CLAVE AQUÍ: Usando 'v1beta' y 'gemini-1.5-flash' ***
// Si 'gemini-1.5-flash' no funciona, prueba con 'gemini-1.5-pro' o verifica
// los modelos disponibles en Google AI Studio como se explicó antes.
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $apiKey;

// Aquí es donde agregarías la lógica para el historial de conversación si la implementas.
// Por ahora, solo enviamos el mensaje actual.
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

$response = curl_exec($ch);      // Ejecuta la solicitud cURL
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Obtiene el código de estado HTTP
$error = curl_error($ch);        // Captura cualquier error de cURL
curl_close($ch);                 // Cierra la sesión cURL

// --- Manejo de errores de la API y de red ---
if (!$response) {
    // Error si cURL no pudo conectar o hubo un problema de red
    echo json_encode(['reply' => "Error de red o cURL: $error"]);
    exit;
}

$result = json_decode($response, true); // Decodifica la respuesta JSON de Gemini

// Verifica el código HTTP y si la estructura de la respuesta es la esperada
if ($httpCode !== 200 || !isset($result['candidates'][0]['content']['parts'][0]['text'])) {
    $errorMsg = $result['error']['message'] ?? 'Error desconocido de la API';
    echo json_encode(['reply' => "Error API ($httpCode): $errorMsg"]);
    exit;
}

// --- Extrae y devuelve la respuesta de Gemini ---
$reply = $result['candidates'][0]['content']['parts'][0]['text'];
echo json_encode(['reply' => $reply]);

?>