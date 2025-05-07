<?php

require_once(__DIR__ . '/../models/AntecedenteLaboral.php');

class AntecedenteLaboralController {
    private $model;

    public function __construct() {
        $this->model = new AntecedenteLaboral();
    }

    public function create($data) {
        if ($this->model->create($data)) {
            echo json_encode(['mensaje' => 'Antecedente laboral creado exitosamente']);
        } else {
            http_response_code(500);
            echo json_encode(['mensaje' => 'Error al crear el antecedente laboral']);
        }
    }

    public function getAll() {
        $result = $this->model->getAll();
        echo json_encode($result);
    }

    public function getById($id) {
        $antecedente = $this->model->getById($id);
        if ($antecedente) {
            echo json_encode($antecedente);
        } else {
            http_response_code(404);
            echo json_encode(['mensaje' => 'Antecedente laboral no encontrado']);
        }
    }

    public function update($id, $data) {
        if ($this->model->update($id, $data)) {
            echo json_encode(['mensaje' => 'Antecedente laboral actualizado']);
        } else {
            http_response_code(500);
            echo json_encode(['mensaje' => 'Error al actualizar el antecedente laboral']);
        }
    }

    public function delete($id) {
        if ($this->model->delete($id)) {
            echo json_encode(['mensaje' => 'Antecedente laboral eliminado']);
        } else {
            http_response_code(500);
            echo json_encode(['mensaje' => 'Error al eliminar el antecedente laboral']);
        }
    }
}
