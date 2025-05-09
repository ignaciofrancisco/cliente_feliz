<?php
// Se incluye el modelo que contiene la lógica para gestionar los antecedentes académicos.
include_once('../models/AntecedenteAcademico.php');

class AntecedenteAcademicoController {
    // Atributo privado para manejar el modelo.
    private $model;

    // Constructor que instancia el modelo.
    public function __construct() {
        $this->model = new AntecedenteAcademico();
    }

    // Método para crear un nuevo antecedente académico.
    public function create($data) {
        if ($this->model->create($data)) {
            // Si se crea correctamente, se responde con código 201 (Created).
            http_response_code(201);
            echo json_encode(['mensaje' => 'Antecedente académico creado exitosamente']);
        } else {
            // Si hay un error al crear, se responde con código 500 (Error interno del servidor).
            http_response_code(500);
            echo json_encode(['mensaje' => 'Error al crear el antecedente académico']);
        }
    }

    // Método para obtener todos los antecedentes académicos.
    public function getAll() {
        $response = $this->model->getAll();
        // Se responde con código 200 (OK) y se envían los resultados en formato JSON.
        http_response_code(200);
        echo json_encode($response);
    }

    // Método para obtener un antecedente académico específico por ID.
    public function getById($id) {
        $response = $this->model->getById($id);
        if ($response) {
            // Si se encuentra el registro, se devuelve con código 200.
            http_response_code(200);
            echo json_encode($response);
        } else {
            // Si no se encuentra, se responde con código 404.
            http_response_code(404);
            echo json_encode(['mensaje' => 'Antecedente académico no encontrado']);
        }
    }

    // Método para actualizar un antecedente académico.
    public function update($id, $data) {
        if ($this->model->update($id, $data)) {
            // Si se actualiza correctamente, se responde con código 200.
            http_response_code(200);
            echo json_encode(['mensaje' => 'Antecedente académico actualizado']);
        } else {
            // Si falla la actualización, se responde con código 500.
            http_response_code(500);
            echo json_encode(['mensaje' => 'Error al actualizar el antecedente académico']);
        }
    }

    // Método para eliminar un antecedente académico.
    public function delete($id) {
        if ($this->model->delete($id)) {
            // Si se elimina correctamente, se responde con código 200.
            http_response_code(200);
            echo json_encode(['mensaje' => 'Antecedente académico eliminado']);
        } else {
            // Si falla la eliminación, se responde con código 500.
            http_response_code(500);
            echo json_encode(['mensaje' => 'Error al eliminar el antecedente académico']);
        }
    }
}
