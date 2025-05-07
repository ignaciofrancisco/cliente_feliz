<?php
include_once('../models/AntecedenteAcademico.php');

class AntecedenteAcademicoController {

    private $model;

    public function __construct() {
        $this->model = new AntecedenteAcademico();
    }

    public function create($data) {
        $response = $this->model->create($data);
        echo json_encode($response);
    }

    public function getAll() {
        $response = $this->model->getAll();
        echo json_encode($response);
    }

    public function getById($id) {
        $response = $this->model->getById($id);
        echo json_encode($response);
    }

    public function update($id, $data) {
        $response = $this->model->update($id, $data);
        echo json_encode($response);
    }

    public function delete($id) {
        $response = $this->model->delete($id);
        echo json_encode($response);
    }
}
