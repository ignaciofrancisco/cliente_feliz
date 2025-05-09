<?php

// Importa el modelo 'AntecedenteLaboral', que contiene la lógica para interactuar con la base de datos.
require_once(__DIR__ . '/../models/AntecedenteLaboral.php');

// Define la clase 'AntecedenteLaboralController' que maneja las operaciones CRUD para los antecedentes laborales.
class AntecedenteLaboralController {
    // Atributo privado para acceder al modelo.
    private $model;

    // Constructor que instancia el modelo 'AntecedenteLaboral'.
    public function __construct() {
        $this->model = new AntecedenteLaboral();
    }

    // Método para crear un nuevo antecedente laboral.
    public function create($data) {
        // Intenta crear un nuevo registro usando el modelo.
        if ($this->model->create($data)) {
            // Si tiene éxito, responde con un mensaje JSON indicando éxito.
            echo json_encode(['mensaje' => 'Antecedente laboral creado exitosamente']);
        } else {
            // Si falla, devuelve un código HTTP 500 y un mensaje de error.
            http_response_code(500);
            echo json_encode(['mensaje' => 'Error al crear el antecedente laboral']);
        }
    }

    // Método para obtener todos los antecedentes laborales.
    public function getAll() {
        // Obtiene todos los registros desde el modelo y los retorna en formato JSON.
        $result = $this->model->getAll();
        echo json_encode($result);
    }

    // Método para obtener un antecedente laboral específico por su ID.
    public function getById($id) {
        // Busca el registro por ID.
        $antecedente = $this->model->getById($id);
        if ($antecedente) {
            // Si se encuentra, lo devuelve en JSON.
            echo json_encode($antecedente);
        } else {
            // Si no se encuentra, devuelve un 404 con un mensaje.
            http_response_code(404);
            echo json_encode(['mensaje' => 'Antecedente laboral no encontrado']);
        }
    }

    // Método para actualizar un antecedente laboral existente.
    public function update($id, $data) {
        // Intenta actualizar el registro con los datos proporcionados.
        if ($this->model->update($id, $data)) {
            // Si tiene éxito, responde con un mensaje JSON de confirmación.
            echo json_encode(['mensaje' => 'Antecedente laboral actualizado']);
        } else {
            // Si falla, devuelve un código 500 y un mensaje de error.
            http_response_code(500);
            echo json_encode(['mensaje' => 'Error al actualizar el antecedente laboral']);
        }
    }

    // Método para eliminar un antecedente laboral.
    public function delete($id) {
        // Intenta eliminar el registro.
        if ($this->model->delete($id)) {
            // Si tiene éxito, responde con un mensaje de confirmación.
            echo json_encode(['mensaje' => 'Antecedente laboral eliminado']);
        } else {
            // Si falla, devuelve un 500 y un mensaje de error.
            http_response_code(500);
            echo json_encode(['mensaje' => 'Error al eliminar el antecedente laboral']);
        }
    }
}

