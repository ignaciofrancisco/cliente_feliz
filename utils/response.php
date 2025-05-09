<?php
// Clase auxiliar para estandarizar respuestas JSON desde la API
class Response {
    
    // Método estático para enviar una respuesta JSON
    public static function json($data, $statusCode = 200) {
        // Establece el tipo de contenido como JSON
        header('Content-Type: application/json');
        
        // Establece el código de estado HTTP
        http_response_code($statusCode);
        
        // Codifica y envía los datos en formato JSON
        echo json_encode($data);
        
        // Finaliza la ejecución del script
        exit();
    }
}
?>
