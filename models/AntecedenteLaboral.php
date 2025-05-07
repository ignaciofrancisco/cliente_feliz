<?php
include_once('../config/database.php'); // Asegúrate de que este archivo esté en la ruta correcta

class AntecedenteLaboral {

    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function create($data) {
        $sql = "INSERT INTO antecedentelaboral (candidato_id, empresa, cargo, funciones, fecha_inicio, fecha_termino) 
                VALUES (:candidato_id, :empresa, :cargo, :funciones, :fecha_inicio, :fecha_termino)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':candidato_id', $data['candidato_id']);
        $stmt->bindParam(':empresa', $data['empresa']);
        $stmt->bindParam(':cargo', $data['cargo']);
        $stmt->bindParam(':funciones', $data['funciones']);
        $stmt->bindParam(':fecha_inicio', $data['fecha_inicio']);
        $stmt->bindParam(':fecha_termino', $data['fecha_termino']);

        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Antecedente laboral creado exitosamente'];
        } else {
            return ['status' => 'error', 'message' => 'Error al crear el antecedente laboral'];
        }
    }

    public function getAll() {
        $sql = "SELECT * FROM antecedentelaboral";
        $stmt = $this->pdo->query($sql);
        return ['status' => 'success', 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)];
    }

    public function getById($id) {
        $sql = "SELECT * FROM antecedentelaboral WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? ['status' => 'success', 'data' => $row] : ['status' => 'error', 'message' => 'No encontrado'];
    }

    public function update($id, $data) {
        $sql = "UPDATE antecedentelaboral SET 
                    candidato_id = :candidato_id,
                    empresa = :empresa,
                    cargo = :cargo,
                    funciones = :funciones,
                    fecha_inicio = :fecha_inicio,
                    fecha_termino = :fecha_termino
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':candidato_id', $data['candidato_id']);
        $stmt->bindParam(':empresa', $data['empresa']);
        $stmt->bindParam(':cargo', $data['cargo']);
        $stmt->bindParam(':funciones', $data['funciones']);
        $stmt->bindParam(':fecha_inicio', $data['fecha_inicio']);
        $stmt->bindParam(':fecha_termino', $data['fecha_termino']);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Actualizado exitosamente'];
        } else {
            return ['status' => 'error', 'message' => 'Error al actualizar'];
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM antecedentelaboral WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Eliminado correctamente'];
        } else {
            return ['status' => 'error', 'message' => 'Error al eliminar'];
        }
    }
}
