<?php
include_once('../config/database.php'); // o la ruta correcta si está en otro directorio

class OfertaLaboral {

    private $pdo;
    private $conn;
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Método para crear una oferta laboral
    public function create($data) {
        // Depuración para ver el contenido de $data
        error_log(print_r($data, true));  // Ver los datos que recibes
        
        $sql = "INSERT INTO ofertalaboral (titulo, descripcion, ubicacion, salario, tipo_contrato, fecha_publicacion, fecha_cierre, estado, reclutador_id) 
                VALUES (:titulo, :descripcion, :ubicacion, :salario, :tipo_contrato, :fecha_publicacion, :fecha_cierre, :estado, :reclutador_id)";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindParam(':titulo', $data['titulo']);
        $stmt->bindParam(':descripcion', $data['descripcion']);
        $stmt->bindParam(':ubicacion', $data['ubicacion']);
        $stmt->bindParam(':salario', $data['salario']);
        $stmt->bindParam(':tipo_contrato', $data['tipo_contrato']);
        $stmt->bindParam(':fecha_publicacion', $data['fecha_publicacion']);
        $stmt->bindParam(':fecha_cierre', $data['fecha_cierre']);
        $stmt->bindParam(':estado', $data['estado']);
        $stmt->bindParam(':reclutador_id', $data['reclutador_id']);
        
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Oferta laboral creada exitosamente'];
        } else {
            return ['status' => 'error', 'message' => 'Error al crear la oferta laboral'];
        }
    }
    
    
    

    // Método para obtener todas las ofertas laborales
    public function getAll() {
        $sql = "SELECT * FROM ofertalaboral";
        $stmt = $this->pdo->query($sql);
        $ofertas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ['status' => 'success', 'data' => $ofertas];
    }

    // Método para obtener una oferta laboral por ID
    public function getById($id) {
        $sql = "SELECT * FROM ofertalaboral WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $oferta = $stmt->fetch(PDO::FETCH_ASSOC);
        return $oferta ? ['status' => 'success', 'data' => $oferta] : ['status' => 'error', 'message' => 'Oferta no encontrada'];
    }

    // Método para actualizar una oferta laboral
    public function update($id, $data) {
        $sql = "UPDATE ofertalaboral SET 
                    titulo = :titulo,
                    descripcion = :descripcion,
                    ubicacion = :ubicacion,
                    salario = :salario,
                    tipo_contrato = :tipo_contrato,
                    fecha_publicacion = :fecha_publicacion,
                    fecha_cierre = :fecha_cierre,
                    estado = :estado
                WHERE id = :id";
    
        $stmt = $this->conn->prepare($sql);
    
        $stmt->bindParam(':titulo', $data['titulo']);
        $stmt->bindParam(':descripcion', $data['descripcion']);
        $stmt->bindParam(':ubicacion', $data['ubicacion']);
        $stmt->bindParam(':salario', $data['salario']);
        $stmt->bindParam(':tipo_contrato', $data['tipo_contrato']);
        $stmt->bindParam(':fecha_publicacion', $data['fecha_publicacion']);
        $stmt->bindParam(':fecha_cierre', $data['fecha_cierre']);
        $stmt->bindParam(':estado', $data['estado']);
        $stmt->bindParam(':id', $id);
    
        $stmt->execute();
    
        return ["status" => "success", "message" => "Oferta laboral actualizada exitosamente"];
    }
    

    // Método para eliminar una oferta laboral
    public function delete($id) {
        $sql = "UPDATE ofertalaboral SET estado = 'Inactiva' WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    
        return ["status" => "success", "message" => "Oferta laboral desactivada"];
    }
    
}
?>
