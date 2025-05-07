<?php
include_once('../config/database.php'); // Ajusta la ruta según tu estructura

class Postulacion {

    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Crear nueva postulación
    public function create($data) {
        $sql = "INSERT INTO postulacion (candidato_id, oferta_laboral_id, estado_postulacion, comentario, fecha_postulacion, fecha_actualizacion) 
                VALUES (:candidato_id, :oferta_laboral_id, :estado_postulacion, :comentario, :fecha_postulacion, :fecha_actualizacion)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':candidato_id', $data['candidato_id']);
        $stmt->bindParam(':oferta_laboral_id', $data['oferta_laboral_id']);
        $stmt->bindParam(':estado_postulacion', $data['estado_postulacion']);
        $stmt->bindParam(':comentario', $data['comentario']);
        $stmt->bindParam(':fecha_postulacion', $data['fecha_postulacion']);
        $stmt->bindParam(':fecha_actualizacion', $data['fecha_actualizacion']);
    
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Postulacion creada exitosamente'];
        } else {
            return ['status' => 'error', 'message' => 'Error al crear la postulacion'];
        }
    }
    

    // Obtener todas las postulaciones
    public function getAll() {
        $sql = "SELECT * FROM postulacion";
        $stmt = $this->pdo->query($sql);
        $postulaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ['status' => 'success', 'data' => $postulaciones];
    }

    // Obtener una postulación por ID
    public function getById($id) {
        $sql = "SELECT * FROM postulacion WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $postulacion = $stmt->fetch(PDO::FETCH_ASSOC);
        return $postulacion ? ['status' => 'success', 'data' => $postulacion] : ['status' => 'error', 'message' => 'Postulación no encontrada'];
    }

    // Actualizar una postulación
    public function update($id, $data) {
        $sql = "UPDATE postulacion SET 
                    candidato_id = :candidato_id,
                    oferta_laboral_id = :oferta_laboral_id,
                    estado_postulacion = :estado_postulacion,
                    comentario = :comentario,
                    fecha_postulacion = :fecha_postulacion,
                    fecha_actualizacion = :fecha_actualizacion
                WHERE id = :id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':candidato_id', $data['candidato_id']);
        $stmt->bindParam(':oferta_laboral_id', $data['oferta_laboral_id']);
        $stmt->bindParam(':estado_postulacion', $data['estado_postulacion']);
        $stmt->bindParam(':comentario', $data['comentario']);
        $stmt->bindParam(':fecha_postulacion', $data['fecha_postulacion']);
        $stmt->bindParam(':fecha_actualizacion', $data['fecha_actualizacion']);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return ["status" => "success", "message" => "Postulación actualizada exitosamente"];
        } else {
            return ["status" => "error", "message" => "Error al actualizar la postulación"];
        }
    }

    // Eliminar una postulación
    public function delete($id) {
        $sql = "DELETE FROM postulacion WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return ["status" => "success", "message" => "Postulación eliminada correctamente"];
        } else {
            return ["status" => "error", "message" => "Error al eliminar la postulación"];
        }
    }
}
?>


