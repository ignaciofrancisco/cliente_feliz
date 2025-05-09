<?php
include_once('../config/database.php'); // Ajusta la ruta según tu estructura

class Postulacion {

    private $pdo;

    // Constructor
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo; // Usamos la conexión PDO global.
    }

    // Crear nueva postulación
    public function create($data) {
        // Consulta SQL para insertar una nueva postulación
        $sql = "INSERT INTO postulacion (candidato_id, oferta_laboral_id, estado_postulacion, comentario, fecha_postulacion, fecha_actualizacion) 
                VALUES (:candidato_id, :oferta_laboral_id, :estado_postulacion, :comentario, :fecha_postulacion, :fecha_actualizacion)";
        
        $stmt = $this->pdo->prepare($sql);
        
        // Vinculamos los parámetros de la consulta con los datos proporcionados.
        $stmt->bindParam(':candidato_id', $data['candidato_id']);
        $stmt->bindParam(':oferta_laboral_id', $data['oferta_laboral_id']);
        $stmt->bindParam(':estado_postulacion', $data['estado_postulacion']);
        $stmt->bindParam(':comentario', $data['comentario']);
        $stmt->bindParam(':fecha_postulacion', $data['fecha_postulacion']);
        $stmt->bindParam(':fecha_actualizacion', $data['fecha_actualizacion']);
    
        // Ejecutamos la consulta y verificamos si se realizó correctamente.
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Postulacion creada exitosamente'];
        } else {
            return ['status' => 'error', 'message' => 'Error al crear la postulacion'];
        }
    }

    // Obtener todas las postulaciones
    public function getAll() {
        $sql = "SELECT * FROM postulacion"; // Consulta para obtener todas las postulaciones.
        $stmt = $this->pdo->query($sql);
        
        // Obtenemos todos los resultados y los retornamos.
        $postulaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ['status' => 'success', 'data' => $postulaciones];
    }

    // Obtener una postulación por ID
    public function getById($id) {
        $sql = "SELECT * FROM postulacion WHERE id = :id"; // Consulta para obtener una postulación por ID.
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        // Obtenemos el resultado de la consulta
        $postulacion = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Si se encuentra la postulación, la retornamos; si no, un mensaje de error.
        return $postulacion ? ['status' => 'success', 'data' => $postulacion] : ['status' => 'error', 'message' => 'Postulación no encontrada'];
    }

    // Actualizar una postulación existente
    public function update($id, $data) {
        $sql = "UPDATE postulacion SET 
                    candidato_id = :candidato_id,
                    oferta_laboral_id = :oferta_laboral_id,
                    estado_postulacion = :estado_postulacion,
                    comentario = :comentario,
                    fecha_postulacion = :fecha_postulacion,
                    fecha_actualizacion = :fecha_actualizacion
                WHERE id = :id"; // Consulta para actualizar una postulación por su ID.
        
        $stmt = $this->pdo->prepare($sql);
        
        // Vinculamos los parámetros con los valores de los datos proporcionados y el ID de la postulación.
        $stmt->bindParam(':candidato_id', $data['candidato_id']);
        $stmt->bindParam(':oferta_laboral_id', $data['oferta_laboral_id']);
        $stmt->bindParam(':estado_postulacion', $data['estado_postulacion']);
        $stmt->bindParam(':comentario', $data['comentario']);
        $stmt->bindParam(':fecha_postulacion', $data['fecha_postulacion']);
        $stmt->bindParam(':fecha_actualizacion', $data['fecha_actualizacion']);
        $stmt->bindParam(':id', $id); // Vinculamos el ID de la postulación a actualizar.
        
        // Ejecutamos la consulta y verificamos si la actualización fue exitosa.
        if ($stmt->execute()) {
            return ["status" => "success", "message" => "Postulación actualizada exitosamente"];
        } else {
            return ["status" => "error", "message" => "Error al actualizar la postulación"];
        }
    }

    // Eliminar una postulación
    public function delete($id) {
        $sql = "DELETE FROM postulacion WHERE id = :id"; // Consulta para eliminar una postulación.
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id); // Vinculamos el ID de la postulación a eliminar.
        
        // Ejecutamos la consulta y verificamos si se ejecutó correctamente.
        if ($stmt->execute()) {
            return ["status" => "success", "message" => "Postulación eliminada correctamente"];
        } else {
            return ["status" => "error", "message" => "Error al eliminar la postulación"];
        }
    }
}
?>



