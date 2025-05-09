<?php
// Configuración de conexión a la base de datos
$host = 'localhost';         // Servidor de base de datos (usualmente 'localhost' en desarrollo)
$db = 'cliente_feliz';       // Nombre de la base de datos
$user = 'root';              // Usuario de la base de datos
$pass = '12345678';          // Contraseña del usuario (ajústala según tu entorno)

// Intentar establecer conexión con la base de datos usando PDO
try {
    // Crear una nueva instancia PDO para conectarse a MySQL
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);

    // Configurar el modo de error de PDO para lanzar excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En caso de error, devolver mensaje JSON y terminar el script
    echo json_encode(['error' => 'Conexión fallida: ' . $e->getMessage()]);
    exit;
}
?>
