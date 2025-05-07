<?php
include_once('../config/database.php'); // Ajusta según tu estructura

class AntecedenteAcademico {

    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function create($data) {
        $sql = "INSERT INTO antecedenteacademico (candidato_id, institucion, titulo_obtenido, anio_ingreso, anio_egreso) 
                VALUES (:candidato_id, :institucion, :titulo_obtenido, :anio_ingreso, :anio_egreso)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':candidato_id', $data['candidato_id']);
        $stmt->bindParam(':institucion', $data['institucion']);
        $stmt->bindParam(':titulo_obtenido', $data['titulo_obtenido']);
        $stmt->bindParam(':anio_ingreso', $data['anio_ingreso']);
        $stmt->bindParam(':anio_egreso', $data['anio_egreso']);

        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Antecedente académico creado exitosamente'];
        } else {
            return ['status' => 'error', 'message' => 'Error al crear el antecedente académico'];
        }
    }

    public function getAll() {
        $sql = "SELECT * FROM antecedenteacademico";
        $stmt = $this->pdo->query($sql);
        return ['status' => 'success', 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)];
    }

    public function getById($id) {
        $sql = "SELECT * FROM antecedenteacademico WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? ['status' => 'success', 'data' => $row] : ['status' => 'error', 'message' => 'No encontrado'];
    }

    public function update($id, $data) {
        $sql = "UPDATE antecedenteacademico SET 
                    candidato_id = :candidato_id,
                    institucion = :institucion,
                    titulo_obtenido = :titulo_obtenido,
                    anio_ingreso = :anio_ingreso,
                    anio_egreso = :anio_egreso
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':candidato_id', $data['candidato_id']);
        $stmt->bindParam(':institucion', $data['institucion']);
        $stmt->bindParam(':titulo_obtenido', $data['titulo_obtenido']);
        $stmt->bindParam(':anio_ingreso', $data['anio_ingreso']);
        $stmt->bindParam(':anio_egreso', $data['anio_egreso']);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Actualizado exitosamente'];
        } else {
            return ['status' => 'error', 'message' => 'Error al actualizar'];
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM antecedenteacademico WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Eliminado correctamente'];
        } else {
            return ['status' => 'error', 'message' => 'Error al eliminar'];
        }
    }
}

